<?php

namespace Ichtus\MyNoteHub\Domain\User\Request\Auth;

class RegistrationRequest
{
    public string $username;
    public string $email;
    public string $password;

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @return static
     */
    public static function create(string $username, string $email, string $password): self
    {
        return new self($username, $email, $password);
    }

    public function __construct(string $username, string $email, string $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}
