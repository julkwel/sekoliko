<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseMatiereRepository")
 */
class ClasseMatiere
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
     * @ORM\OneToOne(targetEntity="App\Entity\Matiere", inversedBy="classeMatiere", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $matieres;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Professeur", inversedBy="classeMatiere", cascade={"persist", "remove"})
     */
    private $professeur;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $coefficient;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Classe", inversedBy="classeMatiere", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $obs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatieres(): ?Matiere
    {
        return $this->matieres;
    }

    public function setMatieres(Matiere $matieres): self
    {
        $this->matieres = $matieres;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getCoefficient(): ?string
    {
        return $this->coefficient;
    }

    public function setCoefficient(?string $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(Classe $classe): self
    {
        $this->classe = $classe;

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
