<?php

namespace N3rtrivium\KakonuntiumBundle\Model;

use JMS\Serializer\Annotation\PreSerialize;

/**
 * LectureGuessesResponseModel
 */
class LectureGuessesResponseModel
{
	private $guesses;

	public function __construct()
	{
		$this->guesses = array();
	}
	
	public function addGuess($userId, $username, $which, $count)
	{
	    if (!isset($this->guesses[$userId]))
	    {
		    $this->guesses[$userId] = array(
                'user_id' => $userId,
                'username' => $username,
                'guesses' => array()
            );
	    }
	    
	    $guessOn = new LectureGuessesDataResponseModel($which, $count);

		$this->guesses[$userId]['guesses'][] = $guessOn;
	}

	/**
	 * @PreSerialize
	 */
	public function onPreSerialize()
	{
		$this->guesses = array_values($this->guesses);
	}
}
