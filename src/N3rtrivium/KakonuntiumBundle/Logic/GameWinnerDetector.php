<?php

namespace N3rtrivium\KakonuntiumBundle\Logic;

use N3rtrivium\KakonuntiumBundle\Entity\User;

/**
 * GameWinnerDetector
 */
class GameWinnerDetector
{

	public function __construct(array $countings, array $guesses)
	{

	}

	/**
	 * @return User|null
	 */
	public function determineWinner()
	{
		// TODO: choose a winner
		return null;
	}
}