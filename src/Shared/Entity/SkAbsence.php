<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 2:52 PM
 */

namespace App\Shared\Entity;


use App\Bundle\User\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkRole.
 *
 * @ORM\Table(name="sk_abs")
 * @ORM\Entity
 */
class SkAbsence
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
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Bundle\User\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     * })
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="abs_motif", type="string", length=200, nullable=false)
     */
    private $absMotif;

    /**
     * @var string
     *
     * @ORM\Column(name="abs_date_deb", type="datetime", nullable=true)
     */
    private $absDateDeb;

    /**
     * @var string
     *
     * @ORM\Column(name="abs_date_fin", type="datetime", nullable=true)
     */
    private $absDateFin;

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
    public function getAbsMotif()
    {
        return $this->absMotif;
    }

    /**
     * @param string $absMotif
     */
    public function setAbsMotif($absMotif)
    {
        $this->absMotif = $absMotif;
    }

    /**
     * @return string
     */
    public function getAbsDateDeb()
    {
        return $this->absDateDeb;
    }

    /**
     * @param string $absDateDeb
     */
    public function setAbsDateDeb($absDateDeb)
    {
        $this->absDateDeb = $absDateDeb;
    }

    /**
     * @return string
     */
    public function getAbsDateFin()
    {
        return $this->absDateFin;
    }

    /**
     * @param string $absDateFin
     */
    public function setAbsDateFin($absDateFin)
    {
        $this->absDateFin = $absDateFin;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}