<?php


namespace App\Entity\Hub;

use App\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(
 *     name="my_note_hub_hub_user_role",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="unique_hub_user", columns={"user_id", "hub_id"})}
 *     )
 * @ORM\Entity(repositoryClass="App\Repository\Hub\HubUserRoleRepository")
 */
class HubUserRole
{
    /**
     *
     * @ORM\Column(name="id", type="guid", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private string $id;

    /**
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User\User", inversedBy="HubsUserRoles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private User $user;

    /**
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Hub\Hub", inversedBy="HubsUserRoles")
     * @ORM\JoinColumn(name="hub_id", referencedColumnName="id", nullable=false)
     */
    private Hub $hub;

    /**
     *
     * @Assert\NotBlank()
     * @Assert\Choice({"ROLE_USER", "ROLE_EDITOR", "ROLE_ADMIN"})
     *
     * @ORM\Column(type="string")
     */
    private string $role;

    /**
     *
     * @ORM\Column(type="datetime")
     */
    private \DateTime $creationDatetime;

    public function __construct()
    {
        $this->creationDatetime = new \DateTime();
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return HubUserRole
     */
    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set creationDatetime
     *
     * @param \DateTime $creationDatetime
     *
     * @return HubUserRole
     */
    public function setCreationDatetime(\DateTime $creationDatetime)
    {
        $this->creationDatetime = $creationDatetime;

        return $this;
    }

    /**
     * Get creationDatetime
     *
     * @return \DateTime
     */
    public function getCreationDatetime()
    {
        return $this->creationDatetime;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return HubUserRole
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set Hub
     *
     * @param Hub $hub
     *
     * @return HubUserRole
     */
    public function setHub(Hub $hub)
    {
        $this->hub = $hub;

        return $this;
    }

    /**
     * Get Hub
     *
     * @return Hub
     */
    public function getHub()
    {
        return $this->hub;
    }
}
