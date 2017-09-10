<?php

namespace ApiBundle\Controller;

use Doctrine\ORM\QueryBuilder;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Swagger\Annotations as SWG;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends FOSRestController
{
    /**
     * @Rest\Post("/authentication")
     * @QueryParam(
     *     name="email",
     *     nullable=false,
     *     allowBlank=true,
     *     strict=true,
     * )
     * @RequestParam(
     *     name="password",
     *     nullable=false,
     *     allowBlank=true,
     *     strict=true,
     * )
     *
     * @SWG\Post(
     *   path="/authentication",
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
        $requestUsername = $request->get('email');
        $requestPassword = $request->get('password');

        if (is_null($requestUsername) || is_null($requestPassword)) {
            return new Response(
                'Please verify all your inputs.',
                Response::HTTP_UNAUTHORIZED,
                array('Content-type' => 'application/json')
            );
        }

        /** @var UserManager $userManager */
        $userManager = $this->get('fos_user.user_manager');
        /** @var EncoderFactory $factory */
        $factory = $this->get('security.encoder_factory');

        $user = $userManager->findUserByUsernameOrEmail($requestUsername);
        $encoder = $factory->getEncoder($user);
        $salt = $user->getSalt();
        if ($encoder->isPasswordValid($user->getPassword(), $requestPassword, $salt)) {
            $response = new Response(
                'Welcome ' . $user->getUsername(),
                Response::HTTP_OK,
                array('Content-type' => 'application/json')
            );
        } else {
            $response = new Response(
                'Username or Password not valid.',
                Response::HTTP_UNAUTHORIZED,
                array('Content-type' => 'application/json')
            );
        }
        return $response;
    }

}
