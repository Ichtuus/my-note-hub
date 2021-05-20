<?php

namespace App\Message\User\Registration;

use App\Entity\User\User;
use App\Message\Contracts\BaseMessengerInterface;
use App\Message\Contracts\SendersMessengerInterface;

class RegistrationConfirmationMail implements BaseMessengerInterface, SendersMessengerInterface
{
    private $token;
    private $newUser;

    public function __construct(string $token, User $newUser)
    {
        $this->token = $token;
        $this->newUser = $newUser;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getUser(): User
    {
        return $this->newUser;
    }

    public function getSenders(): ?array
    {
        return ['mnh-register-confirmation-email'];
    }
}
