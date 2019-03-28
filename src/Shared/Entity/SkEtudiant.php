<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 4:37 PM.
 */

namespace App\Shared\Entity;

use App\Bundle\User\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * SkClasse.
 *
 * @ORM\Table(name="sk_etudiant")
 * @ORM\Entity
 */
class SkEtudiant
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
     * @ORM\OneToOne(targetEntity="App\Shared\Entity\SkClasse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="niveau", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $classe;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="App\Bundle\User\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etudiant", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $etudiant;

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
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * @param User $etudiant
     */
    public function setEtudiant($etudiant)
    {
        $this->etudiant = $etudiant;
    }
}
