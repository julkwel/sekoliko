<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe
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
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Niveau", inversedBy="classes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveau;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ClasseMatiere", mappedBy="classe", cascade={"persist", "remove"})
     */
    private $classeMatiere;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Etudiant", mappedBy="classe", cascade={"persist", "remove"})
     */
    private $etudiant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(?Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getClasseMatiere(): ?ClasseMatiere
    {
        return $this->classeMatiere;
    }

    public function setClasseMatiere(ClasseMatiere $classeMatiere): self
    {
        $this->classeMatiere = $classeMatiere;

        // set the owning side of the relation if necessary
        if ($this !== $classeMatiere->getClasse()) {
            $classeMatiere->setClasse($this);
        }

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        // set the owning side of the relation if necessary
        if ($this !== $etudiant->getClasse()) {
            $etudiant->setClasse($this);
        }

        return $this;
    }
}
