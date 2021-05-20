<?php

namespace App\Builder\User;

use App\Entity\Hub\Hub;
use App\Entity\Hub\HubUserRole;
use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class UserBuilder
{
    private EntityManagerInterface $entityManager;
    private TokenGeneratorInterface $tokenGenerator;
    private UserPasswordEncoderInterface $encoder;


    public function __construct(
        EntityManagerInterface $entityManager,
        TokenGeneratorInterface $tokenGenerator,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->entityManager = $entityManager;
        $this->tokenGenerator = $tokenGenerator;
        $this->encoder = $encoder;
    }

    public function buildUser(User $data)
    {
        $user = new User();

        // Catch current user information
        $username = $data->getUsername();
        $email = $data->getEmail();
        $password = $data->getPassword();

        // Build current user
        $password ? $user->setPassword($this->encoder->encodePassword($user, $password)) : null;
        $email ? $user->setEmail($email) : null;
        $username ? $user->setUsername($username) : null;

        // Create an unique random token
        $user->setRegistrationToken(md5(uniqid(rand(), true)));

        return $user;
    }

    public function bindHub(User $user, Hub $hub, $role)
    {
        // Create user role to current user in hub
        $hubUserRole = new HubUserRole();
        $hubUserRole->setRole($role);
        $hubUserRole->setUser($user);
        $hubUserRole->setHub($hub);

        // Connect hub to user
        $user->setHub($hub);
        $user->addHubsUserRoles($hubUserRole);
        $hub->addHubsUserRoles($hubUserRole);

        return $hubUserRole;
    }
}
