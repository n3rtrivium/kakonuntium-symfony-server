<?php

namespace N3rtrivium\KakonuntiumBundle\Model;

use N3rtrivium\KakonuntiumBundle\Entity\User;

/**
 * CreateUserResponseModel
 */
class CreateUserResponseModel
{
	private $publicId;

	public function __construct(User $user)
	{
		$this->publicId = $user->getPublicId();
	}
}