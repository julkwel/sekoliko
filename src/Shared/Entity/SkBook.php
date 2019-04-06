<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/29/19
 * Time: 10:19 AM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkBook.
 *
 * @ORM\Table(name="sk_book")
 * @ORM\Entity
 */
class SkBook
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
     * @ORM\Column(name="book_name", type="string", length=200, nullable=false)
     */
    private $bookName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Bundle\User\Entity\User")
     * @ORM\JoinColumn(nullable=true,onDelete="SET NULL")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="date_debut", type="datetime",nullable=true)
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="datetime",nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="is_reserved", type="boolean", options={"default":"0"}, nullable=true)
     */
    private $isReserved;

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
    public function getBookName()
    {
        return $this->bookName;
    }

    /**
     * @param string $bookName
     */
    public function setBookName($bookName)
    {
        $this->bookName = $bookName;
    }

    /**
     * @return string
     */
    public function getisReserved()
    {
        return $this->isReserved;
    }

    /**
     * @param string $isReserved
     */
    public function setIsReserved($isReserved)
    {
        $this->isReserved = $isReserved;
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
     * @return string
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param string $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return string
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param string $dateFin
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }
}
