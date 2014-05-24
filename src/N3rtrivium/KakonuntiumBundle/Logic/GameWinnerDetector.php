<?php

namespace N3rtrivium\KakonuntiumBundle\Logic;

use Doctrine\Common\Collections\Collection;
use N3rtrivium\KakonuntiumBundle\Entity\Guess;
use N3rtrivium\KakonuntiumBundle\Entity\User;

/**
 * GameWinnerDetector
 */
class GameWinnerDetector
{
	private $actualCountings;

	private $userGuesses;

	private $usersById;

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
		$result = array();
		$countingsPerUser = $this->doCountings();

		foreach ($this->actualCountings as $which => $actualCount)
		{
			if (!isset($countingsPerUser[$which]))
			{
				$result[$which] = null;
				continue;
			}

			// if there are no countings, there is no winner!
			if (!$actualCount)
			{
				$result[$which] = null;
				continue;
			}

			$smallestDiff = null;
			$currentWinnerUserId = null;
			foreach ($countingsPerUser[$which] as $userId => $guessNumberOfUser)
			{
				$diff = abs($actualCount - $guessNumberOfUser);
				if ($smallestDiff === null || $diff < $smallestDiff)
				{
					$smallestDiff = $diff;
					$currentWinnerUserId = $userId;
				}
			}

			if ($currentWinnerUserId !== null)
			{
				$currentWinnerUserId = $this->usersById[$currentWinnerUserId];
			}

			$result[$which] = $currentWinnerUserId;
		}

		return $result;
	}

	private function doCountings()
	{
		$separatedGuessingNumbers = array();

		foreach ($this->userGuesses as $guess)
		{
			/** @var $guesses Guess */

			// fill usersById array to find users again later
			if (!isset($this->usersById[$guess->getUser()->getId()]))
			{
				$this->usersById[$guess->getUser()->getId()] = $guess->getUser();
			}

			if (!isset($separatedGuessingNumbers[$guess->getWhich()]))
			{
				$separatedGuessingNumbers[$guess->getWhich()] = array();
			}

			if (!isset($separatedGuessingNumbers[$guess->getWhich()][$guess->getUser()->getId()]))
			{
				$separatedGuessingNumbers[$guess->getWhich()][$guess->getUser()->getId()] = 0;
			}

			$separatedGuessingNumbers[$guess->getWhich()][$guess->getUser()->getId()]++;
		}

		return $separatedGuessingNumbers;
	}
}