<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use N3rtrivium\KakonuntiumBundle\Entity\Lecture;
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
	 * @var ValidatorInterface
	 */
	private $validator;

    public function __construct(EntityManager $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
	    $this->lectureRepository = $entityManager->getRepository('N3rtriviumKakonuntiumBundle:Lecture');
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

		// lecture has begun, change status to running
		if ($lecture->getPhase() === Lecture::PHASE_OPEN && $now >= $lecture->getBeginTime())
		{
			$lecture->setPhase(Lecture::PHASE_RUNNING);
			// TODO: look at the guesses and choose a game admin
		}
		// lecture ended, change status to ended
		else if ($lecture->getPhase() === Lecture::PHASE_RUNNING && $now >= $lecture->getEndTime())
		{
			$lecture->setPhase(Lecture::PHASE_ENDED);
			// TODO: look at the counts and guesses and choose a winner
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
