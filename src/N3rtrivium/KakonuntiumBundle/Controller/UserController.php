<?php

namespace N3rtrivium\KakonuntiumBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;

class UserController extends FOSRestController
{
    
    /**
     * @Post("/users")
     */ 
    public function createUserAction()
    {
        $userService = $this->container->get('n3rtrivium_kakonuntium.service.users');
        $userService->createUser();
    }
    
}
