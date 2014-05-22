<?php

namespace N3rtrivium\KakonuntiumBundle\Logic;

use Doctrine\Common\Collections\Collection;
use N3rtrivium\KakonuntiumBundle\Entity\User;

/**
 * GameWinnerDetector
 */
class GameWinnerDetector
{

	public function __construct(array $countings, Collection $guesses)
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