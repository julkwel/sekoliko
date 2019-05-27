<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonnelRepository")
 */
class Personnel
{
    /**
     * @uses AnneScolaire
     */
    use AnneScolaire;

    /**
     * @uses Etablissement
     */
    use Etablissement;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $indice;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $grade;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $noteService;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cisco;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $obs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(?string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getIndice(): ?string
    {
        return $this->indice;
    }

    public function setIndice(?string $indice): self
    {
        $this->indice = $indice;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(?string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getNoteService(): ?string
    {
        return $this->noteService;
    }

    public function setNoteService(?string $noteService): self
    {
        $this->noteService = $noteService;

        return $this;
    }

    public function getCisco(): ?string
    {
        return $this->cisco;
    }

    public function setCisco(?string $cisco): self
    {
        $this->cisco = $cisco;

        return $this;
    }

    public function getObs(): ?string
    {
        return $this->obs;
    }

    public function setObs(?string $obs): self
    {
        $this->obs = $obs;

        return $this;
    }
}
