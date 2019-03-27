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

/**
 * SkMatiere.
 *
 * @ORM\Table(name="sk_matiere")
 * @ORM\Entity
 */
class SkMatiere
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
}
