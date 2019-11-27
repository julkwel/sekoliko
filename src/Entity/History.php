<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoryRepository")
 */
class History
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="action", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $action;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Gedmo\Timestampable(on="create")
     */
    private $dateCreated;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="histories")
     */
    private $userAct;

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
     * @param User $user
     *
     * @return History
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * @param string|null $action
     *
     * @return History
     */
    public function setAction(?string $action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTimeInterface|null $dateCreated
     *
     * @return History
     */
    public function setDateCreated(?\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUserAct(): ?User
    {
        return $this->userAct;
    }

    /**
     * @param User|null $userAct
     *
     * @return History
     */
    public function setUserAct(?User $userAct): self
    {
        $this->userAct = $userAct;

        return $this;
    }
}
