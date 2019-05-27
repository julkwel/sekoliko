<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfesseurRepository")
 */
class Professeur
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
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="professeur", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $profs;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCin;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $heuresParSemaines;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $numAe;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $datePriseService;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ClasseMatiere", mappedBy="professeur", cascade={"persist", "remove"})
     */
    private $classeMatiere;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfs(): ?User
    {
        return $this->profs;
    }

    public function setProfs(User $profs): self
    {
        $this->profs = $profs;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getDateCin(): ?\DateTimeInterface
    {
        return $this->dateCin;
    }

    public function setDateCin(\DateTimeInterface $dateCin): self
    {
        $this->dateCin = $dateCin;

        return $this;
    }

    public function getHeuresParSemaines(): ?string
    {
        return $this->heuresParSemaines;
    }

    public function setHeuresParSemaines(?string $heuresParSemaines): self
    {
        $this->heuresParSemaines = $heuresParSemaines;

        return $this;
    }

    public function getNumAe(): ?string
    {
        return $this->numAe;
    }

    public function setNumAe(?string $numAe): self
    {
        $this->numAe = $numAe;

        return $this;
    }

    public function getDatePriseService(): ?string
    {
        return $this->datePriseService;
    }

    public function setDatePriseService(?string $datePriseService): self
    {
        $this->datePriseService = $datePriseService;

        return $this;
    }

    public function getClasseMatiere(): ?ClasseMatiere
    {
        return $this->classeMatiere;
    }

    public function setClasseMatiere(?ClasseMatiere $classeMatiere): self
    {
        $this->classeMatiere = $classeMatiere;

        // set (or unset) the owning side of the relation if necessary
        $newProfesseur = $classeMatiere === null ? null : $this;
        if ($newProfesseur !== $classeMatiere->getProfesseur()) {
            $classeMatiere->setProfesseur($newProfesseur);
        }

        return $this;
    }
}
