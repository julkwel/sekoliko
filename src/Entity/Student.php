<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
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
     * @return \DateTimeInterface|null
     */
    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTimeInterface|null $deletedAt
     *
     * @return Student
     */
    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
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
}
