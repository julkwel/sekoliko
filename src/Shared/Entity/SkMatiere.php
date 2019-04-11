<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/16/19
 * Time: 3:38 PM.
 */

namespace App\Shared\Entity;

use App\Bundle\User\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * SkMatiere.
 *
 * @ORM\Table(name="sk_matiere")
 * @ORM\Entity(repositoryClass="App\Shared\Repository\SkMatiereRepository")
 */
class SkMatiere
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
     * @ORM\Column(name="mat_nom", type="string", length=100, nullable=true)
     */
    private $matNom;

    /**
     * @var string
     *
     * @ORM\Column(name="mat_coeff", type="string", length=100, nullable=true)
     */
    private $matCoeff;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Bundle\User\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matProf", referencedColumnName="id", onDelete="CASCADE",nullable=true)
     * })
     */
    private $matProf;

    /**
     * @var SkClasse
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkClasse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matClasse", referencedColumnName="id", onDelete="CASCADE",nullable=true)
     * })
     */
    private $matClasse;

    /**
     * @ORM\OneToMany(targetEntity="App\Shared\Entity\SkClasseMatiere", mappedBy="idMatiere", cascade={"remove","persist"})
     */
    private $skClasseMatieres;

    public function __construct()
    {
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
    public function getMatNom()
    {
        return $this->matNom;
    }

    /**
     * @param string $matNom
     */
    public function setMatNom($matNom)
    {
        $this->matNom = $matNom;
    }

    /**
     * @return string
     */
    public function getMatCoeff()
    {
        return $this->matCoeff;
    }

    /**
     * @param string $matCoeff
     */
    public function setMatCoeff($matCoeff)
    {
        $this->matCoeff = $matCoeff;
    }

    /**
     * @return User
     */
    public function getMatProf()
    {
        return $this->matProf;
    }

    /**
     * @param User $matProf
     */
    public function setMatProf($matProf)
    {
        $this->matProf = $matProf;
    }

    /**
     * @return SkClasse
     */
    public function getMatClasse()
    {
        return $this->matClasse;
    }

    /**
     * @param SkClasse $matClasse
     */
    public function setMatClasse($matClasse)
    {
        $this->matClasse = $matClasse;
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
            $skClasseMatiere->setIdMatiere($this);
        }

        return $this;
    }

    public function removeSkClasseMatiere(SkClasseMatiere $skClasseMatiere): self
    {
        if ($this->skClasseMatieres->contains($skClasseMatiere)) {
            $this->skClasseMatieres->removeElement($skClasseMatiere);
            // set the owning side to null (unless already changed)
            if ($skClasseMatiere->getIdMatiere() === $this) {
                $skClasseMatiere->setIdMatiere(null);
            }
        }

        return $this;
    }

    /**
     * @param mixed $skClasseMatieres
     */
    public function setSkClasseMatieres($skClasseMatieres)
    {
        $this->skClasseMatieres = $skClasseMatieres;
    }

}
