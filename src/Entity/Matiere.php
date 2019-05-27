<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatiereRepository")
 */
class Matiere
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
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ClasseMatiere", mappedBy="matieres", cascade={"persist", "remove"})
     */
    private $classeMatiere;


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

    public function getClasseMatiere(): ?ClasseMatiere
    {
        return $this->classeMatiere;
    }

    public function setClasseMatiere(ClasseMatiere $classeMatiere): self
    {
        $this->classeMatiere = $classeMatiere;

        // set the owning side of the relation if necessary
        if ($this !== $classeMatiere->getMatieres()) {
            $classeMatiere->setMatieres($this);
        }

        return $this;
    }
}
