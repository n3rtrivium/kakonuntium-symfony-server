<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public function __construct(EntityManagerInterface $userRepository)
    {
        
    }
    
}
