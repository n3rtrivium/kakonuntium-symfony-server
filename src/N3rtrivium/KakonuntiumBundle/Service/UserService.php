<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use N3rtrivium\KakonuntiumBundle\Repository\UserRepository;
use N3rtrivium\KakonuntiumBundle\Entity\User;

class UserService
{
    private $entityManager;
    
    private $userRepository;
    
    public function __construct(EntityManager $entityManager, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }
    
    public function createUser($username)
    {
        $user = new User();
        $user->setUsername($username);
        
        $this->entityManager->persist($user);
        return $user;
    }
    
}
