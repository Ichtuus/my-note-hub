<?php

namespace App\Procedure\User;

use App\Builder\Hub\HubBuilder;
use App\Builder\User\UserBuilder;
use App\Entity\Hub\Hub;
use App\Entity\Hub\HubUserRole;
use App\Entity\User\User;
use App\Helper\Format\Hub\HubHelper;
use App\Model\User\AuthUserProcessResult;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class UserCreationProcedure
{

    private EntityManagerInterface $entityManager;
    private UserBuilder $userBuilder;
    private HubBuilder $hubBuilder;
    private TokenGeneratorInterface $tokenGenerator;
    private HubHelper $hubHelper;
    private UserPasswordEncoderInterface $encoder;


    public function __construct(
        EntityManagerInterface $entityManager,
        UserBuilder $userBuilder,
        HubBuilder $hubBuilder,
        TokenGeneratorInterface $tokenGenerator,
        HubHelper $hubHelper,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->entityManager = $entityManager;
        $this->userBuilder = $userBuilder;
        $this->hubBuilder = $hubBuilder;
        $this->tokenGenerator = $tokenGenerator;
        $this->hubHelper = $hubHelper;
        $this->encoder = $encoder;
    }

    /**
     * @param $data
     * @param string $role
     * @return User
     * @throws Exception
     */
    public function process($data, $role = 'ROLE_USER'): User
    {
        return $this->processForUser($data, $role);
    }

    /**
     * @param $data
     * @param string $role
     * @return User
     * @throws Exception
     */
    public function processForUser($data, string $role): User
    {
//        // TODO move in builder
//        $result = new AuthUserProcessResult();


        $user = $this->userBuilder->buildUser($data);
        $hub = $this->createHubForUser($user);
        $this->bindUserToHub($hub, $user, $role);

        return $user;
    }

    /**
     * @param User $user
     * @return Hub
     */
    private function createHubForUser(User $user)
    {
        return $this->hubBuilder->buildHub($user);
    }


    /**
     * @param Hub $hub
     * @param User $user
     * @param $role
     * @return HubUserRole
     */
    private function bindUserToHub(Hub $hub, User $user, $role): HubUserRole
    {
       return $this->userBuilder->bindHub($user, $hub, $role);

    }

    /**
     * @param User $user
     * @return User
     */
    public function save(User $user): User
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

}
