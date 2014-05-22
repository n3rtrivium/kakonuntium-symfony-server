<?php


namespace N3rtrivium\KakonuntiumBundle\Model;

/**
 * LectureGuessesDataResponseModel
 */
class LectureGuessesDataResponseModel
{
	private $guessOn;

	private $count;

	public function __construct($guessOn, $count)
	{
		$this->guessOn = $guessOn;
		$this->count = $count;
	}
}