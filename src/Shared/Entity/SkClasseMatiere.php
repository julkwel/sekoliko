<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 5/2/19
 * Time: 11:16 PM
 */

namespace App\Shared\Entity;


use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User;

/**
 * Class SkClasseMatiere
 * @package App\Shared\Entity
 * @ORM\Table(name="sk_classe_matiere")
 * @ORM\Entity
 */
class SkClasseMatiere
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
     * @ORM\Column(name="mat_coeff", type="string", length=100, nullable=true)
     */
    private $matCoeff;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkMatiere",inversedBy="matclass")
     */
    private $matiere;

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
     * @return mixed
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param mixed $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
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
    public function setMatProf(User $matProf)
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
    public function setMatClasse(SkClasse $matClasse)
    {
        $this->matClasse = $matClasse;
    }
}