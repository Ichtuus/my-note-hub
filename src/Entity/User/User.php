<?php

namespace App\Entity\User;

use App\Entity\Hub\Hub;
use App\Entity\Hub\HubUserRole;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="my_note_hub_user")
 * @ORM\Entity(repositoryClass="App\Repository\User\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(name="id", type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 25,
     *      minMessage = "Your username must be at least {{ limit }} characters long",
     *      maxMessage = "Your username cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     */
    private string $username;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private string $password;
    /**
     * @ORM\Column(type="string", length=45, unique=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @Assert\NotBlank
     */
    private $email;
    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $apiToken;
    /**
     * @var array
     */
    private $roles;
    /**
     * @var Hub
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Hub\Hub", cascade={"persist"})
     * @ORM\JoinColumn(name="hub_id", referencedColumnName="id", nullable=false)
     */
    private Hub $hub;
    /**
     * @var HubUserRole[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Hub\HubUserRole", mappedBy="user", fetch="EAGER", cascade={"persist"})
     * @ORM\OrderBy({"creationDatetime" = "DESC"})
     */
    private $hubsUserRoles;
    /**
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    private $registrationToken;
    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->hubsUserRoles = new ArrayCollection();
        $this->roles = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return array|string[]
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return mixed
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param $apiToken
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * @return string
     */
    public function getRegistrationToken()
    {
        return $this->registrationToken;
    }

    /**
     * @param $registrationToken
     */
    public function setRegistrationToken($registrationToken)
    {
        $this->registrationToken = $registrationToken;
    }

    /**
     * @return Hub
     */
    public function getHub(): Hub
    {
        return $this->hub;
    }

    /**
     * @param Hub $hub
     */
    public function setHub(Hub $hub)
    {
        $this->hub = $hub;
    }

    /**
     * Get HubUserRole
     *
     * @return \Doctrine\Common\Collections\Collection|HubUserRole[]
     */
    public function getHubsUserRoles()
    {
        return $this->hubsUserRoles;
    }

    /**
     * Add hubsUserRoles
     *
     * @param HubUserRole $hubsUserRoles
     *
     * @return User
     */
    public function addHubsUserRoles(HubUserRole $hubsUserRoles)
    {
        $this->hubsUserRoles[] = $hubsUserRoles;

        return $this;
    }

    /**
     * Remove hubsUserRoles
     *
     * @param HubUserRole $hubsUserRoles
     */
    public function removeHubsUserRoles(HubUserRole $hubsUserRoles)
    {
        $this->hubsUserRoles->removeElement($hubsUserRoles);
    }

    /**
     * @param HubUserRole[] $hubsUserRoles
     * @return $this
     */
    public function setHubsUserRoles(array $hubsUserRoles)
    {
        $this->hubsUserRoles = $hubsUserRoles;
        return $this;
    }

    /**
     * @return ArrayCollection|User[]
     */
    public function getHubsUsers()
    {
        return $this->hubsUserRoles;
    }
}
