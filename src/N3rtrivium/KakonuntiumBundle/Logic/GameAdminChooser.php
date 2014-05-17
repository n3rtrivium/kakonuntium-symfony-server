<?php

namespace N3rtrivium\KakonuntiumBundle\Logic;

use N3rtrivium\KakonuntiumBundle\Entity\Lecture;
use N3rtrivium\KakonuntiumBundle\Entity\User;

/**
 * GameAdminChooser
 */
class GameAdminChooser
{
	private $lecture;

	private $guessers;

	public function __construct(Lecture $lecture, array $guessers)
	{
		$this->lecture = $lecture;
		$this->guessers = $guessers;
	}

	/**
	 * @throws \LengthException
	 * @return User
	 */
	public function chooseAdminUser()
	{
		if (!count($this->guessers))
		{
			throw new \LengthException('no users, therefore no game');
		}

		$randomKey = array_rand($this->guessers, 1);
		return $this->guessers[$randomKey];
	}
}