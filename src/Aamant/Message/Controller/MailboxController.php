<?php namespace Aamant\Message\Controller;

use BaseController;
use Aamant\Message\Model\Message;
use View;

class MailboxController extends BaseController
{
	public function view(\User $current = null)
	{
		$user = \Auth::user();
		$users = array();
		$messages = array();

		$senders = \User::whereHas('sent', function($query) use ($user) {
			$query->where('to_id', $user->id);
		})
			->orderBy('created_at', 'desc')
			->get();

		if (!$current && $senders->count()){
			$current = $senders->first();
		}

		if ($current){
			$messages = $current->sent()
				->where('to_id', $user->id)
				->orWhere(function($query) use($current, $user){

					$query->where('to_id', $current->id)
						->where('from_id', $user->id);

				})
				->orderBy('created_at', 'desc')
				->get();
		}

		return View::make('message::mailbox.mailbox', compact('user', 'senders', 'messages', 'current'));
	}

	public function update(Message $message)
	{
		try {

			if ($message->to_id == \Auth::user()->id){
				$message->update(array('status' => 'read'));
				return \Response::json(array('delete' => true));
			}

			return \Response::json(array('delete' => false));

		} catch (\Exception $e) {
			return \Response::json(array('delete' => false));
		}
	}
}
