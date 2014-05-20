<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\ValidatorInterface;
use N3rtrivium\KakonuntiumBundle\Entity\Lecture;
use N3rtrivium\KakonuntiumBundle\Entity\User;
use N3rtrivium\KakonuntiumBundle\Repository\GuessRepository;
use N3rtrivium\KakonuntiumBundle\Model\LectureGuessesResponseModel;
use N3rtrivium\KakonuntiumBundle\Model\LectureSingleGuessResponseModel;

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
    
    public function retrieveUserGuessOfLecture(Lecture $lecture, User $user)
    {
        $result = new LectureSingleGuessResponseModel();
        $guesses = $this->guessRepository->findAllGuessesOfUserByLecture($lecture, $user);
        
        foreach ($guesses as $guess)
        {
            $result->addGuess($guess->getWhich(), $guess->getQuantity());
        }
        
        return $result;
    }
}
