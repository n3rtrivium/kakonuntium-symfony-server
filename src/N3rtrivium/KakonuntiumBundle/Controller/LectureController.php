<?php

namespace N3rtrivium\KakonuntiumBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations\Get;
use N3rtrivium\KakonuntiumBundle\Entity\Lecture;
use FOS\RestBundle\Controller\Annotations\View;

class LectureController extends FOSRestController
{

	/**
	 * @Get("/lectures")
	 * @View
	 */
	public function showAllLecturesAction()
	{
		$lectureService = $this->container->get('n3rtrivium_kakonuntium.lectures');
		return $lectureService->retrieveAllLectures();
	}

    /**
     * @Get("/lectures/future")
     * @View
     */ 
    public function showUpcomingLecturesAction()
    {
        $lectureService = $this->container->get('n3rtrivium_kakonuntium.lectures');
	    return $lectureService->retrieveUpcomingLectures();
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
