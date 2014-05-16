<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use N3rtrivium\KakonuntiumBundle\Repository\GuessRepository;

class GuessService
{
    public function __construct(EntityManager $entityManager, GuessRepository $guessRepository)
    {
        
    }
    
}
