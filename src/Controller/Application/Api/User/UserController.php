<?php

namespace App\Controller\Application\Api\User;

use App\Entity\User\User;
use App\Serializer\User\UserArraySerializer;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @method User getUser()
 */
class UserController extends AbstractController
{
    private UserArraySerializer $userArraySerializer;

    public function __construct(
        UserArraySerializer $userArraySerializer
    ) {
        $this->userArraySerializer = $userArraySerializer;
    }

    /**
     * @Route(
     *     "/users/me/information",
     *     name="mnh_api_user_information",
     *     methods={"GET"},
     *     options={"expose" = true}
     * )
     * @return Exception|JsonResponse
     */
    public function userInformation()
    {
        if(!$this->getUser()) {
            return new JsonResponse('User must be logged', Response::HTTP_UNAUTHORIZED);
        }
        return $this->json([
            'data' => $this->userArraySerializer->toArray($this->getUser())
        ]);
    }

}
