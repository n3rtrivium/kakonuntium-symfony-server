<?php

namespace N3rtrivium\KakonuntiumBundle\Logic;

use Doctrine\Common\Collections\ArrayCollection;
use N3rtrivium\KakonuntiumBundle\Entity\User;

/**
 * GameWinnerDetector
 */
class GameWinnerDetector
{

	public function __construct(array $countings, ArrayCollection $guesses)
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