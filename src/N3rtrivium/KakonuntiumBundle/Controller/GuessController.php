<?php

namespace N3rtrivium\KakonuntiumBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Post;
use N3rtrivium\KakonuntiumBundle\Entity\Lecture;
use N3rtrivium\KakonuntiumBundle\Entity\User;

class GuessController extends FOSRestController {

    /**
     * @Get("/lectures/{lecture}/guesses")
     * @ParamConverter("lecture", class="N3rtriviumKakonuntiumBundle:Lecture")
     */ 
    public function showGuessesOfLectureAction(Lecture $lecture) {
        
    }
    
    /**
     * @Put("/lectures/{lecture}/guesses")
     * @Post("/lectures/{lecture}/guesses")
     * @ParamConverter("lecture", class="N3rtriviumKakonuntiumBundle:Lecture")
     */ 
    public function saveGuessesAction(Lecture $lecture) {
        
    }
    
    /**
     * @Get("/lectures/{lecture}/guesses/{user}")
     * @ParamConverter("lecture", class="N3rtriviumKakonuntiumBundle:Lecture")
     * @ParamConverter("user", class="N3rtriviumKakonuntiumBundle:User")
     */ 
    public function showGuessesOfUser(Lecture $lecture, User $user) {
        
    }
    
    /**
     * @Post("/lectures/{lecture}/guesses/admin/{which}")
     * @ParamConverter("lecture", class="N3rtriviumKakonuntiumBundle:Lecture")
     */ 
    public function countActualAction(Lecture $lecture, $which) {
        
    }
    
}
