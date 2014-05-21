<?php

namespace N3rtrivium\KakonuntiumBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use N3rtrivium\KakonuntiumBundle\Entity\Lecture;
use N3rtrivium\KakonuntiumBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class GuessController extends FOSRestController
{

    /**
     * @Get("/lectures/{lecture}/guesses")
     * @ParamConverter("lecture", class="N3rtriviumKakonuntiumBundle:Lecture")
     * @View
     */ 
    public function showGuessesOfLectureAction(Lecture $lecture)
    {
        $guessService = $this->container->get('n3rtrivium_kakonuntium.guesses');
		return $guessService->retrieveGuessesOfLecture($lecture);
    }
    
    /**
     * @Put("/lectures/{lecture}/guesses")
     * @Post("/lectures/{lecture}/guesses")
     * @ParamConverter("lecture", class="N3rtriviumKakonuntiumBundle:Lecture")
     * @View
     */ 
    public function saveGuessesAction(Request $request, Lecture $lecture)
    {
        if (!$request->request->has('user_id'))
        {
		    throw new \Exception("missing user_id key");
	    }
	    
	    $userService = $this->container->get('n3rtrivium_kakonuntium.users');
		$user = $userService->retrieveUserByPublicId($request->request->get('user_id'));
		if ($user === null)
		{
		    throw new \Exception("user not found");
		}
	    
	    if (!$request->request->has('guesses'))
	    {
		    throw new \Exception("missing guesses key");
	    }
        
        $filteredGuesses = array();
        $guesses = $request->request->get('guesses');
        foreach ($guesses as $guess)
        {
            if (!isset($guess['guess_on']))
            {
                throw new \Exception("a guess is missing the guess_on key");
            }
            
            if (!isset($guess['count']))
            {
                throw new \Exception("a guess is missing the count key");
            }
            
            if (intval($guess['count']) < 0)
            {
                throw new \Exception("a guess is having a count smaller zero");
            }
            
            $which = strtolower($guess['guess_on']);
            $filteredGuesses[$which] = intval($guess['count']);
        }

	    // Check lecture as a status update may be needed
	    $lectureService = $this->container->get('n3rtrivium_kakonuntium.lectures');
	    $lectureService->doCheckPhaseForLecture($lecture);

        $guessService = $this->container->get('n3rtrivium_kakonuntium.guesses');
		return $guessService->addUserGuess($lecture, $user, $filteredGuesses);
    }
    
    /**
     * @Get("/lectures/{lecture}/guesses/{user}")
     * @ParamConverter("lecture", class="N3rtriviumKakonuntiumBundle:Lecture")
     * @ParamConverter("user", class="N3rtriviumKakonuntiumBundle:User", options={
     *     "repository_method"="findUserByPublicId"
     * })
     * @View
     */ 
    public function showGuessesOfUserAction(Lecture $lecture, User $user)
    {
	    $guessService = $this->container->get('n3rtrivium_kakonuntium.guesses');
		return $guessService->retrieveUserGuessOfLecture($lecture, $user);
    }
    
    /**
     * @Post("/lectures/{lecture}/guesses/admin/{which}")
     * @ParamConverter("lecture", class="N3rtriviumKakonuntiumBundle:Lecture")
     * @View
     */ 
    public function countActualAction(Lecture $lecture, $which)
    {
	    // Check lecture as a status update may be needed
	    $lectureService = $this->container->get('n3rtrivium_kakonuntium.lectures');
	    $lectureService->doCheckPhaseForLecture($lecture);

        $guessService = $this->container->get('n3rtrivium_kakonuntium.guesses');
		return $guessService->addCount($lecture, $which);
    }
    
}
