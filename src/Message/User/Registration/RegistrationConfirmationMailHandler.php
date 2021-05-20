<?php

namespace App\Message\User\Registration;

use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationConfirmationMailHandler
{
    protected Swift_Mailer $mailer;
    protected EntityManagerInterface $em;
    private UrlGeneratorInterface $router;

    public function __construct(
        Swift_Mailer $mailer,
        EntityManagerInterface $em,
        UrlGeneratorInterface $router
    ) {
        $this->mailer = $mailer;
        $this->em = $em;
        $this->router = $router;
    }

    public function __invoke(RegistrationConfirmationMail $message)
    {

        $token = $this->em->getRepository(User::class)->find($message->getToken());

        // verifier que les données sont cohérantes

        dump($message);
        $message = (new \Swift_Message('Registration success'))
            ->setFrom('no-reply@example.com')
            ->setTo($message->getUser()->getEmail())
            ->setBody(
                "Please confirm your email address by the link below <br> 
                    <a href='{{$this->router->generate('registration_confirmation_email', [
                        'id' => $message->getUser()->getId(),
                        'token' => $message->getToken()
                    ])}}'>Confirmation email</a>"
            );

        $this->mailer->send($message);
    }
}
