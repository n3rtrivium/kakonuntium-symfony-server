<?php

namespace N3rtrivium\KakonuntiumBundle\Repository;

use Doctrine\ORM\EntityRepository;
use N3rtrivium\KakonuntiumBundle\Entity\Lecture;

/**
 * LectureRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LectureRepository extends EntityRepository
{
	private function createUpcomingOrCurrentLecturesQueryBuilder()
	{
		$maxAllowedFutureDate = new \DateTime();
		$maxAllowedFutureDate->add(new \DateInterval('P2D'));

		$minAllowedEndedPastDate = new \DateTime();
		$minAllowedEndedPastDate->sub(new \DateInterval('PT90M'));

		// return only lectures where the beginTime is not too far in the future
		// OR phase is ENDED and they are not too old - otherwise, filter ENDED
		return $this->createQueryBuilder('l')
			->where('l.phase = :phaseEnded AND l.endTime >= :minPastTime')
			->orWhere('l.beginTime <= :maxFutureTime AND l.phase != :phaseEnded')
			->setParameter('phaseEnded', Lecture::PHASE_ENDED)
			->setParameter('maxFutureTime', $maxAllowedFutureDate)
			->setParameter('minPastTime', $minAllowedEndedPastDate)
			->orderBy('l.beginTime', 'DESC');
	}

	public function findAllDescending()
	{
		$query = $this->createQueryBuilder('l')
			->orderBy('l.beginTime', 'DESC')
			->getQuery();

		return $query->getResult();
	}

	public function findFutureUpcomingOrCurrentLectures()
	{
		return $this->createUpcomingOrCurrentLecturesQueryBuilder()->getQuery()->getResult();
	}

	public function findOneUpcomingOrCurrentLecture()
	{
		$builder = $this->createUpcomingOrCurrentLecturesQueryBuilder();
		$query = $builder->setMaxResults(1)
			->getQuery();

		return $query->getOneOrNullResult();
	}
}
