<?php

namespace ApiAndroidBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use CoreBundle\Entity;

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
        $repositoryManager = $this->getDoctrine()->getManager();
        $qb = $repositoryManager->createQueryBuilder();
        $row = $qb->select('a')
            ->from('CoreBundle:Apk', 'a')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult();
        if (!is_null($row) && !empty($row) && is_object($row)) {
            $arrReturn = array('version' =>$row->getVersion());
            return $arrReturn;
        }
        return false;

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
