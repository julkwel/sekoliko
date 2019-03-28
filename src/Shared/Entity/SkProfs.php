<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 4:49 PM.
 */

namespace App\Shared\Entity;

use App\Bundle\User\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * SkClasse.
 *
 * @ORM\Table(name="sk_profs")
 * @ORM\Entity
 */
class SkProfs
{
    use SkEtablissement;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var SkClasse
     * @ORM\OneToMany(targetEntity="App\Shared\Entity\SkClasse",mappedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="niveau", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $classe;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="App\Bundle\User\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profs", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $profs;

    /**
     * @var SkMatiere
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkMatiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matiere", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $matiere;

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
     * @return SkClasse
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param SkClasse $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

    /**
     * @return User
     */
    public function getProfs()
    {
        return $this->profs;
    }

    /**
     * @param User $profs
     */
    public function setProfs($profs)
    {
        $this->profs = $profs;
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
}
