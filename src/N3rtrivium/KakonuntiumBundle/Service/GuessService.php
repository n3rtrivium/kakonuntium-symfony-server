<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\ValidatorInterface;

class GuessService
{
    public function __construct(EntityManager $entityManager, ValidatorInterface $validator)
    {
        
    }
    
}
