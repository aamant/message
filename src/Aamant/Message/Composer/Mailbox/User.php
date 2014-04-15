<?php namespace Aamant\Message\Composer\Mailbox;

class User extends Base
{
	public function compose($view)
	{
		$sender = $view->sender;
		$user = $view->user;

		$view->fullname = $this->fullname($sender);
		$view->counter = $sender->sent()->where('to_id', $user->id)->where('status', 'new')->count();
	}
}