<?php

namespace N3rtrivium\KakonuntiumBundle\Model;

/**
 * CreateUserResponseModel
 */
class CreateUserResponseModel
{
	private $userId;

	public function __construct($userId)
	{
		$this->userId = $userId;
	}
}