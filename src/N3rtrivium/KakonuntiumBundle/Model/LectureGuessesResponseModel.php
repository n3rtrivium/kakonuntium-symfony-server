<?php

namespace N3rtrivium\KakonuntiumBundle\Model;

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
	        $sortedGuesses[$userId] = array(
                'user_id' => $userId,
                'username' => $username,
                'guesses' => array()
            );
	    }
	    
	    $guessOn = new \stdClass();
	    $guessOn->guessOn = $which;
	    $guessOn->count = $count
	    
	    $sortedGuesses[$userId]['guesses'][] = $guessOn;
	}
}