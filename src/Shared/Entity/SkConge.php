<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/29/19
 * Time: 9:10 PM.
 */

namespace App\Shared\Entity;

use  Doctrine\ORM\Mapping as ORM;

/**
 * Class SkConge.
 *
 * @ORM\Table(name="sk_conge")
 * @ORM\Entity
 */
class SkConge
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
     * @var
     * @ORM\ManyToOne(targetEntity="App\Bundle\User\Entity\User")
     */
    private $user;

    /**
     * @var
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $dateDeb;

    /**
     * @var
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $dateFin;

    /**
     * @var
     * @ORM\Column(type="text",nullable=true)
     */
    private $motif;

    /**
     * @var
     * @ORM\Column(type="text",nullable=false)
     */
    private $type;

    /**
     * @var
     * @ORM\Column(name="is_fin",type="boolean",options={"default"= 0})
     */
    private $isFin;

    public function __construct()
    {
        $this->isFin = 0;
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
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getDateDeb()
    {
        return $this->dateDeb;
    }

    /**
     * @param mixed $dateDeb
     */
    public function setDateDeb($dateDeb)
    {
        $this->dateDeb = $dateDeb;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return mixed
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * @param mixed $motif
     */
    public function setMotif($motif)
    {
        $this->motif = $motif;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getisFin()
    {
        return $this->isFin;
    }

    /**
     * @param mixed $isFin
     */
    public function setIsFin($isFin)
    {
        $this->isFin = $isFin;
    }
}
