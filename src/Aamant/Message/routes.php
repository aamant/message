<?php

Route::model('user', 'User');
Route::model('message', '\Aamant\Message\Model\Message');

Route::group(array('before' => 'auth'), function()
{
	/** Mailbox */
	Route::get('mailbox', array(
		'as'	=> 'mailbox.show',
		'uses'	=> '\Aamant\Message\Controller\MailboxController@view'
	));

	Route::get('mailbox/view/{user}', array(
		'as'	=> 'mailbox.detail',
		'uses'	=> '\Aamant\Message\Controller\MailboxController@view'
	));

	Route::post('mailbox/update/{message}', array(
		'as'	=> 'mailbox.update',
		'uses'	=> '\Aamant\Message\Controller\MailboxController@update'
	));
	/** End Mailbox */

	/** Gestion des messages */
	Route::get('message/send/{user}', array(
		'as' => 'message.send',
		'uses' => '\Aamant\Message\Controller\MessageController@show'
	));

	Route::put('message/send/{user}', array(
		'as' => 'message.send',
		'uses' => '\Aamant\Message\Controller\MessageController@send'
	));
	/** End Gestion des messages */
});