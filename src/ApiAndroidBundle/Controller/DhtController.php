<?php

namespace ApiAndroidBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use CoreBundle\Entity;
use CoreBundle\Constants;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DhtController extends FOSRestController
{
    /**
     * @Rest\Get("/dht/temp-and-hum")
     * @Rest\View()
     *
     */
    public function getTempAndHumidityAction()
    {
        return new Response(
            'No application data found',
            Response::HTTP_NOT_FOUND,
            array('Content-type' => 'application/json')
        );
    }

    /**
     * @Rest\Post("/dht/temp-and-hum")
     * @Rest\View()
     *
     */
    public function postTempAndHumidityAction()
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        dump($request);exit;
    }
}
