<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Student
{
    use SekolikoEtablissementTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\Column(type="boolean",options={"default":0})
     */
    private $isRenvoie;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClassRoom", inversedBy="students")
     */
    private $classe;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $contactParent;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $adresseParent;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $noteLibre;

    /**
     * Student constructor.
     */
    public function __construct()
    {
        $this->isRenvoie = false;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     *
     * @return Student
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsRenvoie(): ?bool
    {
        return $this->isRenvoie;
    }

    /**
     * @param bool $isRenvoie
     *
     * @return Student
     */
    public function setIsRenvoie(bool $isRenvoie): self
    {
        $this->isRenvoie = $isRenvoie;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTimeInterface|null $deletedAt
     *
     * @return Student
     */
    public function setDeletedAt(?DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return ClassRoom|null
     */
    public function getClasse(): ?ClassRoom
    {
        return $this->classe;
    }

    /**
     * @param ClassRoom|null $classe
     *
     * @return Student
     */
    public function setClasse(?ClassRoom $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     *
     * @return Student
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * @param string|null $contact
     *
     * @return Student
     */
    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string|null $adresse
     *
     * @return Student
     */
    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContactParent(): ?string
    {
        return $this->contactParent;
    }

    /**
     * @param string|null $contactParent
     *
     * @return Student
     */
    public function setContactParent(?string $contactParent): self
    {
        $this->contactParent = $contactParent;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdresseParent(): ?string
    {
        return $this->adresseParent;
    }

    /**
     * @param string|null $adresseParent
     *
     * @return Student
     */
    public function setAdresseParent(?string $adresseParent): self
    {
        $this->adresseParent = $adresseParent;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNoteLibre(): ?string
    {
        return $this->noteLibre;
    }

    /**
     * @param string|null $noteLibre
     *
     * @return Student
     */
    public function setNoteLibre(?string $noteLibre): self
    {
        $this->noteLibre = $noteLibre;

        return $this;
    }
}
