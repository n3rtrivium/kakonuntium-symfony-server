<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\ValidatorInterface;
use N3rtrivium\KakonuntiumBundle\Entity\Lecture;
use Doctrine\ORM\EntityManager;
use N3rtrivium\KakonuntiumBundle\Repository\GuessRepository;
use Symfony\Component\Validator\ValidatorInterface;
use N3rtrivium\KakonuntiumBundle\Model\LectureGuessesResponseModel;

class GuessService
{
    /**
	 * @var EntityManager
	 */
	private $entityManager;
    
    /**
	 * @var GuessRepository
	 */
	private $guessRepository;
	
	/**
	 * @var ValidatorInterface
	 */
	private $validator;
    
    public function __construct(EntityManager $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->guessRepository = $entityManager->getRepository('N3rtriviumKakonuntiumBundle:Guess');
        $this->validator = $validator;
    }
    
    public function retrieveGuessesOfLecture(Lecture $lecture)
    {
        $result = new LectureGuessesResponseModel();
        $guesses = $this->guessRepository->findAllGuessesByLecture($lecture);
        
        $sortedGuesses = array();
        foreach ($guesses as $guess)
        {
            $result->addGuess($guess->getUser()->getId(), $guess->getUser()->getUsername(),
                $guess->getWhich(), $guess->getQuantity());
        }
        
        return $result;
    }
}
