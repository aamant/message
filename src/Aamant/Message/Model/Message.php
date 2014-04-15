<?php namespace Aamant\Message\Model;

use Eloquent;

class Message extends Eloquent
{
	protected $guarded = array();
	protected $table = 'message_messages';

	public function to()
	{
		return $this->belongsTo('User', 'to_id');
	}

	public function from()
	{
		return $this->belongsTo('User', 'from_id');
	}
}
