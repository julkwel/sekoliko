<?php

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Shared\Repository\SkClasseMatiereRepository")
 */
class SkClasseMatiere
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkMatiere", inversedBy="skClasseMatieres")
     */
    private $idMatiere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkClasse", inversedBy="skClasseMatieres")
     */
    private $idClasse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkProfs", inversedBy="skClasseMatieres")
     */
    private $idProf;

    /**
     * @ORM\Column(type="integer")
     */
    private $coefficient;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMatiere(): ?SkMatiere
    {
        return $this->idMatiere;
    }

    public function setIdMatiere(?SkMatiere $idMatiere): self
    {
        $this->idMatiere = $idMatiere;

        return $this;
    }

    public function getIdClasse(): ?SkClasse
    {
        return $this->idClasse;
    }

    public function setIdClasse(?SkClasse $idClasse): self
    {
        $this->idClasse = $idClasse;

        return $this;
    }

    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }

    public function setCoefficient(int $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getIdProf(): ?SkProfs
    {
        return $this->idProf;
    }

    public function setIdProf(?SkProfs $idProf): self
    {
        $this->idProf = $idProf;

        return $this;
    }

    

}
