<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 2:15 PM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


/**
 * SkClasse.
 *
 * @ORM\Table(name="sk_classe")
 * @ORM\Entity(repositoryClass="App\Shared\Repository\SkClasseRepository")
 */
class SkClasse
{
    use SkEtablissement;

    use SkAnneScolaire;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="classe_nom", type="string", length=100, nullable=false)
     */
    private $classeNom;


    /**
     * @var SkMatiere
     * @ORM\ManyToMany(targetEntity="App\Shared\Entity\SkMatiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matiere", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $matiere;

    /**
     * @var SkNiveau
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkNiveau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="niveau", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $niveau;

    /**
     * @ORM\OneToMany(targetEntity="App\Shared\Entity\SkClasseMatiere", mappedBy="idClasse", cascade={"remove","persist"})
     */
    private $skClasseMatieres;

    public function __construct()
    {
        $this->matiere = new ArrayCollection();
        $this->skClasseMatieres = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getClasseNom()
    {
        return $this->classeNom;
    }

    /**
     * @param string $classeNom
     */
    public function setClasseNom($classeNom)
    {
        $this->classeNom = $classeNom;
    }

    /**
     * @return SkNiveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param SkNiveau $niveau
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }

    /**
     * @return SkMatiere
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param SkMatiere $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(SkMatiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->addClass($this);
        }

        return $this;
    }

    public function removeMatiere(SkMatiere $matiere): self
    {
        if ($this->matieres->contains($matiere)) {
            $this->matieres->removeElement($matiere);
            $matiere->removeClass($this);
        }

        return $this;
    }

    /**
     * @return Collection|SkClasseMatiere[]
     */
    public function getSkClasseMatieres(): Collection
    {
        return $this->skClasseMatieres;
    }

    public function addSkClasseMatiere(SkClasseMatiere $skClasseMatiere): self
    {
        if (!$this->skClasseMatieres->contains($skClasseMatiere)) {
            $this->skClasseMatieres[] = $skClasseMatiere;
            $skClasseMatiere->setIdClasse($this);
        }

        return $this;
    }

    public function removeSkClasseMatiere(SkClasseMatiere $skClasseMatiere): self
    {
        if ($this->skClasseMatieres->contains($skClasseMatiere)) {
            $this->skClasseMatieres->removeElement($skClasseMatiere);
            // set the owning side to null (unless already changed)
            if ($skClasseMatiere->getIdClasse() === $this) {
                $skClasseMatiere->setIdClasse(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->classeNom;
    }
}
