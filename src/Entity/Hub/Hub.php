<?php


namespace App\Entity\Hub;


use App\Entity\User\User;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package App\Entity
 *
 * @ORM\Table(name="my_note_hub_hub",indexes={
 *     @ORM\Index(name="name", columns={"name"})
 * })
 * @ORM\Entity(repositoryClass="App\Repository\Hub\HubRepository")
 */
class Hub
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="guid", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     *
     */
    private $id;

    /**
     * @var DateTime
     *
     * @Assert\NotBlank()
     * @Assert\DateTime()
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $creationDatetime;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;


    /**
     * @var User
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User\User", inversedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private $creator;

    /**
     * @var HubUserRole[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Hub\HubUserRole", mappedBy="hub", fetch="EAGER")
     * @ORM\OrderBy({"creationDatetime" = "DESC"})
     */
    private $hubsUserRoles;

    public function __construct()
    {
        $this->creationDatetime = new DateTime();
        $this->hubsUserRoles = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getCreationDatetime()
    {
        return $this->creationDatetime;
    }

    /**
     * @param DateTime $creationDatetime
     */
    public function setCreationDatetime(DateTime $creationDatetime)
    {
        $this->creationDatetime = $creationDatetime;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Add hubsUserRoles
     *
     * @param HubUserRole $hubsUserRoles
     *
     * @return Hub
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
     * Get hubssUserRoles
     *
     * @return \Doctrine\Common\Collections\Collection|HubUserRole[]
     */
    public function getHubsUserRoles()
    {
        return $this->hubsUserRoles;
    }

    /**
     * @return ArrayCollection|User[]
     */
    public function getHubUsers()
    {
        $users = [];
        foreach ($this->getHubsUserRoles() as $hubUserRole) {
            $users[] = $hubUserRole->getUser();
        }

        return new ArrayCollection($users);
    }

    /**
     * Set user
     *
     * @param User $creator
     * @return Hub
     */
    public function setCreator(User $creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

}
