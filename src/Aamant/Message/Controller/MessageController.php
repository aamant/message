<?php namespace Aamant\Message\Controller;

use Aamant\Message\Model\Message;
use BaseController;
use User;
use View;
use Input;
use Auth;
use Event;
use Response;
use Exception;
use Log;

class MessageController extends BaseController
{
	public function show(User $current)
	{
		$user = Auth::user();
		$messages = $current->sent()
			->where('to_id', $user->id)
			->orWhere(function($query) use($current, $user){

				$query->where('to_id', $current->id)
					->where('from_id', $user->id);

			})
			->orderBy('created_at', 'desc')
			->get();

        return View::make('message::partials.message', compact('current', 'user', 'messages'));
	}

	public function send(User $current)
	{
		try {
			$user = Auth::user();

			$content = trim(Input::get('message', ''));
			if ($content == ''){
				return Response::json(array('error' => true, 'message' => 'Votre message est vide'));
			}

			$message = new \Aamant\Message\Model\Message();
			$message->to_id = $current->id;
			$message->content = $content;

			$user->sent()->save($message);

			Event::queue('message.sent', array('message' => $message));

			$view = View::make('message::mailbox.partials.message', compact('message', 'user'))->render();

			return Response::json(array('error' => false, 'message' => $view));

		} catch (Exception $e) {
			Log::alert($e->getMessage());
			return Response::json(array('error' => true, 'message' => 'Envoi du message impossible. Merci de ré-essayer plus tard'));
		}
	}
}
