<?php namespace Aamant\Message;

trait MessageTrait
{
	/**
	 * Message received
	 *
	 * @return \User
	 */
	public function received()
	{
		return $this->hasMany('\Aamant\Message\Model\Message', 'to_id');
	}

	/**
	 * Message sent
	 *
	 * @return \User
	 */
	public function sent()
	{
		return $this->hasMany('\Aamant\Message\Model\Message', 'from_id');
	}
}