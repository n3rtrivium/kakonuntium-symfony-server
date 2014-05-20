<?php

namespace N3rtrivium\KakonuntiumBundle\Model;

/**
 * LectureSingleGuessResponseModel
 */
class LectureSingleGuessResponseModel
{
	private $guesses;

	public function __construct()
	{
		$this->guesses = new \stdClass();
	}
	
	public function addGuess($which, $count)
	{
	    $this->guesses->{$which} = $count;
	}
}