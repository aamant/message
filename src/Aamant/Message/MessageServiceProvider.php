<?php namespace Aamant\Message;

use Illuminate\Support\ServiceProvider;

class MessageServiceProvider extends ServiceProvider {

	public function boot()
	{
		$this->package('aamant/message');

		// if (! in_array('Aamant\Message\MessageInterface', class_implements('User') )) {
		// 	throw new Exception('The User class must be implement Aamant\Message\MessageInterface');
		// }

		include __DIR__.'/routes.php';

		\View::composers(array(
    		'\Aamant\Message\Composer\Receive' => 'message::partials.receive',
    		'\Aamant\Message\Composer\Mailbox\User' => 'message::mailbox.partials.user',
    		'\Aamant\Message\Composer\Mailbox\Message' => array('message::mailbox.partials.message'),
    		'\Aamant\Message\Composer\Message\Message' => 'message::partials.message',
 		));
	}

	public function register()
	{
	}
}