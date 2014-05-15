<?php

namespace N3rtrivium\KakonuntiumBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations\Get;
use N3rtrivium\KakonuntiumBundle\Entity\Lecture;

class LectureController extends FOSRestController
{

    /**
     * @Get("/lectures")
     */ 
    public function showUpcomingLecturesAction()
    {
        
    }
    
    /**
     * @Get("/lectures/next")
     */ 
    public function showNextLectureAction()
    {
        
    }
    
    /**
     * @Get("/lectures/{lecture}")
     * @ParamConverter("lecture", class="N3rtriviumKakonuntiumBundle:Lecture")
     */ 
    public function showLectureAction(Lecture $lecture)
    {
        
    }
    
}
