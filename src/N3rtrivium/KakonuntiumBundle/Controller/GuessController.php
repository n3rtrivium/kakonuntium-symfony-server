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
        /* input: {
            “userId”: “player”, 
            “guesses”: [
                {‘guess_on’: ‘who to guess on’, “count”: 12},
            {‘guess_on’: ‘other guy’, “count”: 10}
            ]
        } */
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
        $guessService = $this->container->get('n3rtrivium_kakonuntium.guesses');
		return $guessService->addCount($lecture, $which);
    }
    
}
