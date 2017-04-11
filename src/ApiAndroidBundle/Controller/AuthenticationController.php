<?php

namespace ApiAndroidBundle\Controller;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Swagger\Annotations as SWG;

class AuthenticationController extends FOSRestController
{
    /**
     * @Rest\Post("/authenticate")
     * @QueryParam(
     *     name="email",
     *     requirements={"rule" = "\d+", "error_message" = "DUPAAAAAA", "message" = "DUPAAAAAAmmmmmm"},
     *     description="DUPA BLADA NA WAS SPADA",
     *     nullable=false,
     *     allowBlank=true,
     *     strict=true,
     * )
     * @RequestParam(
     *     name="password",
     *     requirements={"rule" = "\d+", "error_message" = "DUPAAAAAA", "message" = "DUPAAAAAAmmmmmm"},
     *     nullable=false,
     *     allowBlank=true,
     *     strict=true,
     * )
     *
     * @SWG\Get(
     *   path="/authenticate",
     *   summary="used to authenticate user",
     *   tags={"authentication"},
     *   @SWG\Parameter(
     *     name="email",
     *     in="query",
     *     description="User email",
     *     required=true,
     *     minLength = 10,
     *     maxLength = 20,
     *     type="string",
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="query",
     *     description="User password",
     *     required=true,
     *     minLength = 9,
     *     maxLength = 20,
     *     type="string"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Supplied credentials are correct ",
     *     @SWG\Schema(ref="#/definitions/User")
     *   ),
     *     @SWG\Response(
     *     response=401,
     *     description="Supplied credentials are incorrect "
     *   ),
     *     @SWG\Response(
     *     response=400,
     *     description="There are no credentials in request, or credentials are not valid (i.e. too short field length)"
     *   )
     * )
     */
    public function authenticateAction(Request $request)
    {
        $requestEmail = $request->get('email');
        $requestPassword = $request->get('Password');
//        $entityManager = $this->getContainer()->get();
        $repositoryManager = $this->getDoctrine()->getManager();
        /** @var QueryBuilder $qb */
        $qb = $repositoryManager->createQueryBuilder();
        $row = $qb->select('u')
            ->from('CoreBundle:User', 'u')
            ->where("u.email = '" . $requestEmail . "'")
            ->andWhere("u.password = '" . $requestPassword . "'")
            ->getQuery()
            ->getOneOrNullResult();
        if (!is_null($row) && !empty($row) && is_object($row)) {
            return $row->getTargetUrl();
        }

        $view = $this->view(['status' => "you need to authenticate"]);
        return $this->handleView($view);
    }


}
