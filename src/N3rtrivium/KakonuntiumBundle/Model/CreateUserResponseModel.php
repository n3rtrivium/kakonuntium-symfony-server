<?php

namespace N3rtrivium\KakonuntiumBundle\Model;

/**
 * CreateUserResponseModel
 */
class CreateUserResponseModel
{
	private $publicId;

	public function __construct($userId)
	{
		$this->publicId = $userId;
	}
}