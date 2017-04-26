<?php

namespace ApiAndroidBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use CoreBundle\Entity;
use CoreBundle\Constants;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
    public function postTempAndHumidityAction(Request $request)
    {
        $requestTemp = $request->get('temperature');
        $requestHum = $request->get('humidity');
        $requestDhtNo = $request->get('dhtNo', 1);
        $requestDhtNo = $request->get('dateMicrocontroller', 1);
//        dump($requestTemp,$requestHum,$requestDhtNo);exit;
        $arrReturn = ['temperature' => $requestTemp, 'humidity' => $requestHum];
        $dht = new Entity\DhtSensor();
        $dht->setHumidity($requestHum);
        $dht->setTemp($requestTemp);
        $dht->setDhtNo($requestDhtNo);
        $em = $this->getDoctrine()->getManager();
        $em->persist($dht);
        try{
            $em->flush();
        }catch(Exception $e){
            var_dump($e->getMessage());
        }

        return new Response(
            json_encode($arrReturn),
            Response::HTTP_OK,
            array('Content-type' => 'application/json')
        );
    }
}
