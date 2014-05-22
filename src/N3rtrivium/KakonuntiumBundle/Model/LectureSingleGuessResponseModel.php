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
		$this->guesses = array();
	}
	
	public function addGuess($which, $count)
	{
	    $this->guesses[] = new LectureGuessesDataResponseModel($which, $count);
	}
}
