<?php namespace Aamant\Message\Composer\Message;

use Aamant\Message\Composer\Mailbox\Base;

class Message extends Base
{
	public function compose($view)
	{
		$user = $view->current;

		$view->fullname = ($view->user->id == $user->id)?'Moi':$this->fullname($user);
	}
}