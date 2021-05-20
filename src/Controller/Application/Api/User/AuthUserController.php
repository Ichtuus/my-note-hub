<?php

namespace App\Controller\Application\Api\User;

use App\Entity\User\User;
use App\Exception\ValidationException;
use App\Helper\Exception\ExceptionHelper;
use App\Message\User\Registration\RegistrationConfirmationMail;
use App\Procedure\User\UserCreationProcedure;
use App\Serializer\User\UserArraySerializer;
use Exception;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthUserController extends AbstractController
{
    private MessageBusInterface $bus;
    private UserCreationProcedure $userCreationProcedure;
    private UserArraySerializer $userArraySerializer;
    private ValidatorInterface $validator;
    private ExceptionHelper $exceptionHelper;

    public function __construct(
        MessageBusInterface $bus,
        UserCreationProcedure $userCreationProcedure,
        UserArraySerializer $userArraySerializer,
        ValidatorInterface $validator,
        ExceptionHelper $exceptionHelper
    ) {
        $this->bus = $bus;
        $this->userCreationProcedure = $userCreationProcedure;
        $this->validator = $validator;
        $this->exceptionHelper = $exceptionHelper;
        $this->userArraySerializer = $userArraySerializer;
    }


    /**
     * @Route("/user/register",
     *     name="mnh_user_register",
     *     options={"expose": true},
     *     methods={"POST"})
     *
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return JsonResponse
     * @throws Exception
     */
    public function register(
        Request $request,
        SerializerInterface $serializer
    ) {
        $data = $serializer->deserialize($request->getContent(),User::class, 'json');

        $user = $this->userCreationProcedure->process($data);

        $errors = $this->validator->validate($user);

        if (count($errors) > 0) {
            throw new ValidationException($this->exceptionHelper->createErrorMessage($errors), Response::HTTP_BAD_REQUEST);
        }

        $this->userCreationProcedure->save($user);

        $this->bus->dispatch(new RegistrationConfirmationMail($user->getRegistrationToken(), $user));

        // TODO Use symfony serializer
        return $this->json([
            'data' => $this->userArraySerializer->toArray($user)
        ]);
    }

    /**
     * @Route("/user/{id}/token/{token}",
     *     name="registration_confirmation_email",
     *     options={"expose": true})
     *
     * @param User $user
     */
    public function registerConfirmEmail(User $user)
    {
        die("GG");
    }

    /**
     * @Route("/user/me/login",
     *     name="mnh_user_login",
     *     methods={"POST"},
     *     options={"expose": true})
     */
    public function login()
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('/');
        }

        return new JsonResponse('An error occured', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @throws RuntimeException
     *
     * @Route("/user/me/logout",
     *     name="mnh_user_logout",
     *     options={"expose": true},
     *     methods={"GET"})
     */
    public function logoutAction(): void
    {
        throw new RuntimeException('This should not be reached!');
    }

}
