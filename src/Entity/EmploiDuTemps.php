<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmploiDuTempsRepository")
 */
class EmploiDuTemps
{
    use SekolikoEtablissementTrait;
    use EntityIdTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClassRoom", inversedBy="emploiDuTemps")
     */
    private $classe;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $heure;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="emploiDuTemps")
     */
    private $matiere;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $remarque;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $jour;

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
     * @return $this
     */
    public function setClasse(?ClassRoom $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHeure(): ?string
    {
        return $this->heure;
    }

    /**
     * @param string|null $heure
     *
     * @return $this
     */
    public function setHeure(?string $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    /**
     * @return Subject|null
     */
    public function getMatiere(): ?Subject
    {
        return $this->matiere;
    }

    /**
     * @param Subject|null $matiere
     *
     * @return $this
     */
    public function setMatiere(?Subject $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRemarque(): ?string
    {
        return $this->remarque;
    }

    /**
     * @param string|null $remarque
     *
     * @return $this
     */
    public function setRemarque(?string $remarque): self
    {
        $this->remarque = $remarque;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getJour(): ?string
    {
        return $this->jour;
    }

    /**
     * @param string|null $jour
     *
     * @return $this
     */
    public function setJour(?string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }
}
