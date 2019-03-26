<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 1:16 PM
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
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var SkEtablissement
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkEtablissement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etsNom", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $etsNom;

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
     * @return SkEtablissement
     */
    public function getEtsNom()
    {
        return $this->etsNom;
    }

    /**
     * @param SkEtablissement $etsNom
     */
    public function setEtsNom($etsNom)
    {
        $this->etsNom = $etsNom;
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
    public function setSalleNumero(string $salleNumero)
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
    public function setIsReserve(string $isReserve)
    {
        $this->isReserve = $isReserve;
    }
    
    
    
}