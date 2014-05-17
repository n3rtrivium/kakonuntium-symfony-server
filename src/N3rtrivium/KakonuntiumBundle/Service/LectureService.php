<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use N3rtrivium\KakonuntiumBundle\Entity\Lecture;
use N3rtrivium\KakonuntiumBundle\Logic\GameAdminChooser;
use N3rtrivium\KakonuntiumBundle\Logic\GameWinnerDetector;
use N3rtrivium\KakonuntiumBundle\Repository\CountRepository;
use N3rtrivium\KakonuntiumBundle\Repository\GuessRepository;
use N3rtrivium\KakonuntiumBundle\Repository\LectureRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\ValidatorInterface;

class LectureService
{
	/**
	 * @var EntityManager
	 */
	private $entityManager;

	/**
	 * @var LectureRepository
	 */
	private $lectureRepository;

	/**
	 * @var GuessRepository
	 */
	private $guessRepository;

	/**
	 * @var CountRepository
	 */
	private $countRepository;

	/**
	 * @var ValidatorInterface
	 */
	private $validator;

    public function __construct(EntityManager $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
	    $this->lectureRepository = $entityManager->getRepository('N3rtriviumKakonuntiumBundle:Lecture');
	    $this->guessRepository = $entityManager->getRepository('N3rtriviumKakonuntiumBundle:Guess');
	    $this->countRepository = $entityManager->getRepository('N3rtriviumKakonuntiumBundle:Count');
	    $this->validator = $validator;
    }

	/**
	 * Updates the Lecture's details, if necessary.
	 *
	 * @param Lecture $lecture
	 */
	private function updateLecturePhase(Lecture $lecture)
	{
		$now = new \DateTime();

		// lecture has begun, change status to RUNNING
		if ($lecture->getPhase() === Lecture::PHASE_OPEN && $now >= $lecture->getBeginTime())
		{
			// look at the guesses and choose a game admin
			// if there are no guesses, the game immediately changes to phase ENDED
			$guessers = $this->guessRepository->findGuessingUsersByLecture($lecture);

			try
			{
				$adminChooser = new GameAdminChooser($lecture, $guessers);
				$user = $adminChooser->chooseAdminUser();

				$lecture->setAdminUser($user);
				$lecture->setPhase(Lecture::PHASE_RUNNING);
			}
			catch (\LengthException $e)
			{
				$lecture->setAdminUser(null);
				$lecture->setWinnerUser(null);
				$lecture->setPhase(Lecture::PHASE_ENDED);
			}
		}
		// lecture ended, change status to ENDED
		else if ($lecture->getPhase() === Lecture::PHASE_RUNNING && $now >= $lecture->getEndTime())
		{
			// look at the counts and guesses.. then choose a winner
			$countings = $this->countRepository->findCountingsByLecture($lecture);
			$guesses = $lecture->getGuesses();

			$winningDetector = new GameWinnerDetector($countings, $guesses);
			$winner = $winningDetector->determineWinner();

			$lecture->setWinnerUser($winner);
			$lecture->setPhase(Lecture::PHASE_ENDED);
		}

		$this->entityManager->flush($lecture);
	}

	public function retrieveAllLectures()
	{
		return $this->lectureRepository->findAllDescending();
	}

	public function retrieveUpcomingLectures()
	{
		$lectures = $this->lectureRepository->findFutureUpcomingOrCurrentLectures();
		foreach ($lectures as $lecture)
		{
			$this->updateLecturePhase($lecture);
		}

		return $lectures;
	}

	public function retrieveUpcomingLecture()
	{
		$lecture = $this->lectureRepository->findOneUpcomingOrCurrentLecture();

		$this->updateLecturePhase($lecture);
		return $lecture;
	}

	public function retrieveLectureById($id)
	{
		$lecture = $this->lectureRepository->find($id);
		if ($lecture === null)
		{
			throw new NotFoundHttpException('Lecture object not found');
		}

		$this->updateLecturePhase($lecture);
		return $lecture;
	}
    
}
