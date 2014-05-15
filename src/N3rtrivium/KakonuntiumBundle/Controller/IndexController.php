<?php

namespace N3rtrivium\KakonuntiumBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;

class IndexController extends FOSRestController
{
    
    /**
     * @Get("/")
     */ 
    public function indexAction()
    {
        $view = $this->view(new \stdClass(), 200);
        return $this->handleView($view);
    }
    
}
