<?php

namespace N3rtrivium\KakonuntiumBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use N3rtrivium\KakonuntiumBundle\Model\CreateUserResponseModel;

class UserController extends FOSRestController
{
    
    /**
     * @Post("/users")
     * @View()
     */ 
    public function createUserAction(Request $request)
    {
	    if (!$request->request->has('username')) {
		    throw new \Exception("missing username key");
	    }

        $userService = $this->container->get('n3rtrivium_kakonuntium.service.users');
        $user = $userService->createUser($request->request->get('username'));

	    return new CreateUserResponseModel($user->getPublicId());
    }
    
}
