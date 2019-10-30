<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
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

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->classRooms = new ArrayCollection();
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

    public function getAdministrator(): ?Administrator
    {
        return $this->administrator;
    }

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

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->addReservator($this);
        }

        return $this;
    }

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

    public function addClassRoom(ClassRoom $classRoom): self
    {
        if (!$this->classRooms->contains($classRoom)) {
            $this->classRooms[] = $classRoom;
            $classRoom->setCreatedBy($this);
        }

        return $this;
    }

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
}
