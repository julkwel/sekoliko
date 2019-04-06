<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/4/19
 * Time: 11:27 PM.
 */

namespace App\Shared\Entity;

use App\Bundle\User\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * SkPaiement.
 *
 * @ORM\Table(name="sk_paiement")
 * @ORM\Entity
 */
class SkPaiement
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
     * @var User
     * @ORM\ManyToMany(targetEntity="App\Bundle\User\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=150, nullable=false)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="montant", type="string", length=45, nullable=false)
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text",nullable=true)
     */
    private $commentaire;

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
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param string $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }
}
