<?php namespace Aamant\Message\Composer\Mailbox;

class Message extends Base
{
	public function compose($view)
	{
		$user = $view->message->from;

		$view->fullname = ($view->user->id == $user->id)?'Moi':$this->fullname($user);
	}
}