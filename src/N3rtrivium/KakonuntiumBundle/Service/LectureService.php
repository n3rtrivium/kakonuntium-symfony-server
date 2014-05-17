<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use N3rtrivium\KakonuntiumBundle\Repository\LectureRepository;
use Symfony\Component\Validator\ValidatorInterface;

class LectureService
{
    public function __construct(EntityManager $entityManager, ValidatorInterface $validator)
    {
        
    }
    
}
