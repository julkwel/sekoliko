<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 *
 * @UniqueEntity(fields={"username"}, message="Le login {{ value }} est déjà enregistrée")
 */
class User implements UserInterface
{
    use SekolikoEtablissementTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string",nullable=false)
     *
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank()
     */
    private $password;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Gedmo\Timestampable(on="create")
     */
    private $dateCreate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Gedmo\Timestampable(on="update")
     */
    private $dateUpdate;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Administrator", mappedBy="user", cascade={"persist", "remove"})
     */
    private $administrator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SchoolYear", inversedBy="users")
     */
    private $schoolYear;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Reservation", mappedBy="reservator")
     */
    private $reservations;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string",nullable=true)
     */
    private $imatriculation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassRoom", mappedBy="createdBy")
     */
    private $classRooms;
    /**
     * @var string|null
     *
     * @ORM\Column(type="string",nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\History", mappedBy="user", cascade={"persist", "remove"})
     */
    private $action;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\History", mappedBy="userAct")
     */
    private $histories;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $birthLocale;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->classRooms = new ArrayCollection();
        $this->histories = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): ?string
    {
        return (string) $this->username;
    }

    /**
     * @param string $username
     *
     * @return User
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): ?array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    /**
     * @param array $roles
     *
     * @return User
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     *
     * @return User
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSchoolYear()
    {
        return $this->schoolYear;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    /**
     * @param \DateTimeInterface|null $dateCreate
     *
     * @return User
     */
    public function setDateCreate(?\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return DateTime|null
     */
    public function getDateUpdate(): ?DateTime
    {
        return $this->dateUpdate;
    }

    /**
     * @param DateTime|null $dateUpdate
     *
     * @return User
     */
    public function setDateUpdate(?DateTime $dateUpdate): self
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * @return Administrator|null
     */
    public function getAdministrator(): ?Administrator
    {
        return $this->administrator;
    }

    /**
     * @param Administrator|null $administrator
     *
     * @return User
     */
    public function setAdministrator(?Administrator $administrator): self
    {
        $this->administrator = $administrator;

        // set (or unset) the owning side of the relation if necessary
        $newUser = null === $administrator ? null : $this;
        if ($newUser !== $administrator->getUser()) {
            $administrator->setUser($newUser);
        }

        return $this;
    }

    /**
     * @param SchoolYear|null $schoolYear
     *
     * @return User
     */
    public function setSchoolYear(?SchoolYear $schoolYear): self
    {
        $this->schoolYear = $schoolYear;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    /**
     * @param Reservation $reservation
     *
     * @return User
     */
    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->addReservator($this);
        }

        return $this;
    }

    /**
     * @param Reservation $reservation
     *
     * @return User
     */
    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            $reservation->removeReservator($this);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImatriculation(): ?string
    {
        return $this->imatriculation;
    }

    /**
     * @param string|null $imatriculation
     *
     * @return User
     */
    public function setImatriculation(?string $imatriculation): self
    {
        $this->imatriculation = $imatriculation;

        return $this;
    }

    /**
     * @return Collection|ClassRoom[]
     */
    public function getClassRooms(): Collection
    {
        return $this->classRooms;
    }

    /**
     * @param ClassRoom $classRoom
     *
     * @return User
     */
    public function addClassRoom(ClassRoom $classRoom): self
    {
        if (!$this->classRooms->contains($classRoom)) {
            $this->classRooms[] = $classRoom;
            $classRoom->setCreatedBy($this);
        }

        return $this;
    }

    /**
     * @param ClassRoom $classRoom
     *
     * @return User
     */
    public function removeClassRoom(ClassRoom $classRoom): self
    {
        if ($this->classRooms->contains($classRoom)) {
            $this->classRooms->removeElement($classRoom);
            // set the owning side to null (unless already changed)
            if ($classRoom->getCreatedBy() === $this) {
                $classRoom->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string|null $photo
     *
     * @return User
     */
    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * @param string|null $prenom
     *
     * @return User
     */
    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return History|null
     */
    public function getAction(): ?History
    {
        return $this->action;
    }

    /**
     * @param History $action
     *
     * @return User
     */
    public function setAction(History $action): self
    {
        $this->action = $action;

        // set the owning side of the relation if necessary
        if ($this !== $action->getUser()) {
            $action->setUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|History[]
     */
    public function getHistories(): Collection
    {
        return $this->histories;
    }

    /**
     * @param History $history
     *
     * @return User
     */
    public function addHistory(History $history): self
    {
        if (!$this->histories->contains($history)) {
            $this->histories[] = $history;
            $history->setUserAct($this);
        }

        return $this;
    }

    /**
     * @param History $history
     *
     * @return User
     */
    public function removeHistory(History $history): self
    {
        if ($this->histories->contains($history)) {
            $this->histories->removeElement($history);
            // set the owning side to null (unless already changed)
            if ($history->getUserAct() === $this) {
                $history->setUserAct(null);
            }
        }

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    /**
     * @param string|null $sexe
     *
     * @return User
     */
    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getBirthLocale(): ?string
    {
        return $this->birthLocale;
    }

    public function setBirthLocale(?string $birthLocale): self
    {
        $this->birthLocale = $birthLocale;

        return $this;
    }
}
