<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;
use CoreBundle\Entity;
use CoreBundle\Constants;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
     *     description="Integer number with version of application(I.E. 1, 2, 3, etc...)",
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
            ->orderBy('a.version', 'ASC')
            ->getQuery()
            ->getOneOrNullResult();

        if (!is_null($row) && !empty($row) && is_object($row)) {
            $arrReturn = array('version' => $row->getVersion());
            return $arrReturn;
        }

        return new Response(
            'No application data found',
            Response::HTTP_NOT_FOUND,
            array('Content-type' => 'application/json')
        );
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
        $repositoryManager = $this->getDoctrine()->getManager();
        $qb = $repositoryManager->createQueryBuilder();
        $row = $qb->select('a')
            ->from('CoreBundle:Apk', 'a')
            ->orderBy('a.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult();
        if (!is_null($row) && !empty($row) && is_object($row)) {
            $file = Constants\Upload::APK_UPLOAD_DIR . '/' . $row->getFileName();
            $response = new BinaryFileResponse($file);
            return $response;
        }

        return new Response(
            'No application data found',
            Response::HTTP_NOT_FOUND,
            array('Content-type' => 'application/json')
        );
    }
}
