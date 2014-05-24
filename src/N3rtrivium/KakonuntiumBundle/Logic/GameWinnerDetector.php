<?php

namespace N3rtrivium\KakonuntiumBundle\Logic;

use Doctrine\Common\Collections\Collection;
use N3rtrivium\KakonuntiumBundle\Entity\User;

/**
 * GameWinnerDetector
 */
class GameWinnerDetector
{
	private $actualCountings;

	private $userGuesses;

	public function __construct(array $countings, Collection $guesses)
	{
		$this->actualCountings = $countings;
		$this->userGuesses = $guesses;
	}

	/**
	 * @return array<User>
	 */
	public function determineWinners()
	{
		// TODO: choose a winner
		return null;
	}
}