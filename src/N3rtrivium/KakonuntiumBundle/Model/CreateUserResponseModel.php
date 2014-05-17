<?php

namespace N3rtrivium\KakonuntiumBundle\Model;

use N3rtrivium\KakonuntiumBundle\Entity\User;

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