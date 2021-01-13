<?php


namespace App\Entity\Note;

use App\Entity\Hub\Hub;
use App\Entity\User\User;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="my_note_hub_note",
 *     indexes={@ORM\Index(name="creation_datetime", columns={"creation_datetime"})}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\Note\NoteRepository")
 * @UniqueEntity(
 *     fields={"noteTitle"},
 *     errorPath="noteTitle",
 *     message="This note name is already in use."
 * )
 */
class Note
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private string $id;
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=70)
     *
     * @ORM\Column(type="string", length=70, nullable=false,  unique=true)
     */
    private string $noteTitle;
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=250)
     *
     * @ORM\Column(type="string", length=250, nullable=false,  unique=true)
     */
    private string $noteContent;
    /**
     * @var string
     *
     * @Assert\Length(max=150)
     *
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private string $note_first_link;
    /**
     * @var string
     *
     * @Assert\Length(max=150)
     *
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private string $note_second_link;
    /**
     * @var string
     *
     * @Assert\Length(max=150)
     *
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private string $note_third_link;
    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $creationDatetime;
    /**
     * @var Hub
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Hub\Hub")
     * @ORM\JoinColumn(name="hub_id", referencedColumnName="id", nullable=false)
     */
    private Hub $hub;
    /**
     * @var User
     *
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $creator;

    /**
     * Note constructor.
     */
    public function __construct()
    {
        $this->creationDatetime = new \DateTime();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getNoteTitle(): string
    {
        return $this->noteTitle;
    }

    /**
     * @param string $noteTitle
     */
    public function setNoteTitle(string $noteTitle): void
    {
        $this->noteTitle = $noteTitle;
    }

    /**
     * @return string
     */
    public function getNoteContent(): string
    {
        return $this->noteContent;
    }

    /**
     * @param string $noteContent
     */
    public function setNoteContent(string $noteContent): void
    {
        $this->noteContent = $noteContent;
    }

    /**
     * @return string
     */
    public function getNoteFirstLink(): string
    {
        return $this->note_first_link;
    }

    /**
     * @param string $note_first_link
     */
    public function setNoteFirstLink(string $note_first_link): void
    {
        $this->note_first_link = $note_first_link;
    }

    /**
     * @return string
     */
    public function getNoteSecondLink(): string
    {
        return $this->note_second_link;
    }

    /**
     * @param string $note_second_link
     */
    public function setNoteSecondLink(string $note_second_link): void
    {
        $this->note_second_link = $note_second_link;
    }

    /**
     * @return string
     */
    public function getNoteThirdLink(): string
    {
        return $this->note_third_link;
    }

    /**
     * @param string $note_third_link
     */
    public function setNoteThirdLink(string $note_third_link): void
    {
        $this->note_third_link = $note_third_link;
    }

    /**
     * @return DateTime
     */
    public function getCreationDatetime(): DateTime
    {
        return $this->creationDatetime;
    }

    /**
     * @param DateTime $creationDatetime
     */
    public function setCreationDatetime(DateTime $creationDatetime): void
    {
        $this->creationDatetime = $creationDatetime;
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
    public function setHub(Hub $hub): void
    {
        $this->hub = $hub;
    }

    /**
     * @return User
     */
    public function getCreator(): User
    {
        return $this->creator;
    }

    /**
     * @param User $creator
     */
    public function setCreator(User $creator): void
    {
        $this->creator = $creator;
    }
}
