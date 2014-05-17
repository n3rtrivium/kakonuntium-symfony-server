<?php

namespace N3rtrivium\KakonuntiumBundle\Service;

use Doctrine\ORM\EntityManager;
use N3rtrivium\KakonuntiumBundle\Repository\LectureRepository;
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

	public function retrieveAllLectures()
	{
		return $this->lectureRepository->findAll();
	}

	public function retrieveUpcomingLectures()
	{
		return $this->lectureRepository->findFutureUpcomingOrCurrentLectures();
	}
    
}
