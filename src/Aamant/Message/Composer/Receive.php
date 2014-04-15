<?php namespace Aamant\Message\Composer;

class Receive
{
	public function compose($view)
	{
		$mailbox_counter = \Auth::user()
			->received()
			->where('status', 'new')
			->count();
		$mailbox_url = \URL::route('mailbox.show');

		$view->with('mailbox_counter', $mailbox_counter);
		$view->with('mailbox_url', $mailbox_url);
	}
}