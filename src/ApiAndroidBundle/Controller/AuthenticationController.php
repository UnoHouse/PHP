<?php

namespace ApiAndroidBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;

class AuthenticationController extends FOSRestController
{
    /**
     * @Rest\Get("/authenticate")
     * @Rest\View()
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
    public function authenticateAction()
    {
        $view = $this->view(['status' => "you need to authenticate"]);
        return $this->handleView($view);
    }

}
