<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\ValidatorInterface;
use N3rtrivium\KakonuntiumBundle\Entity\Lecture;
use N3rtrivium\KakonuntiumBundle\Entity\User;
use N3rtrivium\KakonuntiumBundle\Entity\Count;
use N3rtrivium\KakonuntiumBundle\Entity\Guess;
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
    
    public function addUserGuess(Lecture $lecture, User $user, array $guesses)
    {
	    if ($lecture->getPhase() !== $lecture::PHASE_OPEN)
	    {
		    throw new \RuntimeException('submitting of guesses not allowed in current lecture phase');
	    }

        $alreadySubmittedGuesses = $this->guessRepository->findAllGuessesOfUserByLecture($lecture, $user);

        // if there is a guess for a item already submitted, overwrite the already existing guess
        foreach ($alreadySubmittedGuesses as $alreadySubmittedGuess)
        {
            if (array_key_exists($alreadySubmittedGuess->getWhich(), $guesses))
            {
                $alreadySubmittedGuess->setQuantity($guesses[$alreadySubmittedGuess->getWhich()]);
                unset($guesses[$alreadySubmittedGuess->getWhich()]);
            }
        }
        
        // otherwise: create a new guess and save that
        foreach ($guesses as $guessWhich => $guessCount)
        {
            $guess = new Guess();
            $guess->setLecture($lecture);
            $guess->setUser($user);
            $guess->setWhich($guessWhich);
            $guess->setQuantity($guessCount);
            
            $this->entityManager->persist($guess);
        }
        
        $this->entityManager->flush();
    }
    
    public function addCount(Lecture $lecture, $which)
    {
	    if ($lecture->getPhase() !== $lecture::PHASE_RUNNING)
	    {
		    throw new \RuntimeException('submitting of countings not allowed in current lecture phase');
	    }

        $count = new Count();
        $count->setLecture($lecture);
        $count->setWhich($which);
        
        $this->entityManager->persist($count);
        $this->entityManager->flush($count);
    }
}
