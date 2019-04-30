<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 1:16 PM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkSalle.
 *
 * @ORM\Table(name="sk_salle")
 * @ORM\Entity
 */
class SkSalle
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
     * @ORM\Column(name="salle_nom", type="string", length=100, nullable=true)
     */
    private $salleNom;

    /**
     * @var string
     *
     * @ORM\Column(name="salle_numero", type="string", length=30, nullable=true)
     */
    private $salleNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="is_reserve", type="boolean", options={"default":"0"})
     */
    private $isReserve = false;

    /**
     * @var string
     *
     * @ORM\Column(name="deb_reserve", type="datetime", nullable=true)
     */
    private $debReserve;

    /**
     * @var string
     *
     * @ORM\Column(name="fin_reserve", type="datetime", nullable=true)
     */
    private $finReserve;

    /**
     * @var string
     *
     * @ORM\Column(name="motifs", type="string", length=200,nullable=true)
     */
    private $motifs;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_place", type="integer", length=200,nullable=true)
     */
    private $nombrePlace;

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
    public function getSalleNom()
    {
        return $this->salleNom;
    }

    /**
     * @param string $salleNom
     */
    public function setSalleNom($salleNom)
    {
        $this->salleNom = $salleNom;
    }

    /**
     * @return string
     */
    public function getSalleNumero()
    {
        return $this->salleNumero;
    }

    /**
     * @param string $salleNumero
     */
    public function setSalleNumero($salleNumero)
    {
        $this->salleNumero = $salleNumero;
    }

    /**
     * @return string
     */
    public function getisReserve()
    {
        return $this->isReserve;
    }

    /**
     * @param string $isReserve
     */
    public function setIsReserve($isReserve)
    {
        $this->isReserve = $isReserve;
    }

    /**
     * @return string
     */
    public function getDebReserve()
    {
        return $this->debReserve;
    }

    /**
     * @param string $debReserve
     */
    public function setDebReserve($debReserve)
    {
        $this->debReserve = $debReserve;
    }

    /**
     * @return string
     */
    public function getFinReserve()
    {
        return $this->finReserve;
    }

    /**
     * @param string $finReserve
     */
    public function setFinReserve($finReserve)
    {
        $this->finReserve = $finReserve;
    }

    /**
     * @return string
     */
    public function getMotifs()
    {
        return $this->motifs;
    }

    /**
     * @param string $motifs
     */
    public function setMotifs($motifs)
    {
        $this->motifs = $motifs;
    }

    /**
     * @return int
     */
    public function getNombrePlace()
    {
        return $this->nombrePlace;
    }

    /**
     * @param int $nombrePlace
     */
    public function setNombrePlace($nombrePlace)
    {
        $this->nombrePlace = $nombrePlace;
    }
}
