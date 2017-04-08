<?php

namespace ApiAndroidBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class AuthenticationController extends FOSRestController
{
    /**
     * @Rest\Get("/authenticate")
     * @Rest\View()
     */
    public function authenticateAction()
    {
        $view = $this->view(['status' => "you need to authenticate"]);
        return $this->handleView($view);
    }

}
