<?php

namespace N3rtrivium\KakonuntiumBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
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
     * @View
     */ 
    public function showNextLectureAction()
    {
	    $lectureService = $this->container->get('n3rtrivium_kakonuntium.lectures');
	    return $lectureService->retrieveUpcomingLecture();
    }
    
    /**
     * @Get("/lectures/{lectureId}", requirements={"lectureId" = "\d+"})
     * @View
     */ 
    public function showLectureAction($lectureId)
    {
	    $lectureService = $this->container->get('n3rtrivium_kakonuntium.lectures');
	    return $lectureService->retrieveLectureById($lectureId);
    }
    
}
