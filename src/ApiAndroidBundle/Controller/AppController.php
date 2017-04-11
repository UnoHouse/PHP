<?php

namespace ApiAndroidBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;


class AppController extends FOSRestController
{
    /**
     * @Rest\Get("/app/latest/version")
     * @Rest\View()
     *
     * @SWG\Get(
     *   path="/app/latest/version",
     *   summary="Latest application version",
     *   tags={"app"},
     *   @SWG\Response(
     *     response=200,
     *     description="version of application"
     *   )
     * )
     *
     */
    public function getLatestAppVersionAction()
    {
        $view = $this->view(['status' => "latest version is 1.0.1"]);
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/app/latest/app")
     * @Rest\View()
     *
     * @SWG\Get(
     *   path="/app/latest/app",
     *   summary="Latest application binary file",
     *   tags={"app"},
     *   @SWG\Response(
     *     response=200,
     *     description="binary file"
     *   )
     * )
     *
     */
    public function getLatestAppAction()
    {
        $view = $this->view(['status' => "get file"]);
        return $this->handleView($view);
    }
}
