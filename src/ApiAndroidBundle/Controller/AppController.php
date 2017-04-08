<?php

namespace ApiAndroidBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class AppController extends FOSRestController
{
    /**
     * @Rest\Get("/app/latest/version")
     * @Rest\View()
     */
    public function getLatestAppVersionAction()
    {
        $view = $this->view(['status' => "latest version is 1.0.1"]);
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/app/latest/app")
     */
    public function getLatestAppAction()
    {
        $view = $this->view(['status' => "get file"]);
        return $this->handleView($view);
    }
}
