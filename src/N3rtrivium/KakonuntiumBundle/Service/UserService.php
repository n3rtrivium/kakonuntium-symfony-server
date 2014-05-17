<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use N3rtrivium\KakonuntiumBundle\Repository\UserRepository;
use N3rtrivium\KakonuntiumBundle\Entity\User;

class UserService
{
	/**
	 * @var EntityManager
	 */
	private $entityManager;

	/**
	 * @var UserRepository
	 */
	private $userRepository;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $entityManager->getRepository('N3rtriviumKakonuntiumBundle:User');
    }

	/**
	 * @param $username
	 *
	 * @return User
	 */
	public function createUser($username)
    {
        $user = new User();
        $user->setUsername($username);
        
        $this->entityManager->persist($user);
	    $this->entityManager->flush();

	    return $user;
    }
    
}
