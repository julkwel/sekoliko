<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 2:59 PM
 */

namespace App\Shared\Entity;


use App\Bundle\User\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkRole.
 *
 * @ORM\Table(name="sk_retard")
 * @ORM\Entity
 */
class SkRetard
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
     *   @ORM\JoinColumn(name="user", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="abs_motif", type="string", length=200, nullable=false)
     */
    private $retardMotif;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_deb", type="datetime", nullable=true)
     */
    private $heureDeb;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_fin", type="datetime", nullable=true)
     */
    private $heureFin;

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

    /**
     * @return string
     */
    public function getRetardMotif()
    {
        return $this->retardMotif;
    }

    /**
     * @param string $retardMotif
     */
    public function setRetardMotif($retardMotif)
    {
        $this->retardMotif = $retardMotif;
    }

    /**
     * @return string
     */
    public function getHeureDeb()
    {
        return $this->heureDeb;
    }

    /**
     * @param string $heureDeb
     */
    public function setHeureDeb($heureDeb)
    {
        $this->heureDeb = $heureDeb;
    }

    /**
     * @return string
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * @param string $heureFin
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;
    }

}