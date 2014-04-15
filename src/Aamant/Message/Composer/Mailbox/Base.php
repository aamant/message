<?php namespace Aamant\Message\Composer\Mailbox;

class Base
{
	public function fullname($user)
	{
		$format = \Config::get('message::config.fullname');
		$attributes = \Config::get('message::config.fullname_attributes');

		foreach ($attributes as $key => $value) $attributes[$key] = $user->$value;
		array_unshift($attributes, $format);

		return call_user_func_array('sprintf', $attributes);
	}
}