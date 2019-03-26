<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 2:11 PM
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkRole.
 *
 * @ORM\Table(name="sk_edt")
 * @ORM\Entity
 */
class SkEdt
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
     * @var SkMatiere
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkMatiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matNom", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $matNom;

    /**
     * @var string
     *
     * @ORM\Column(name="etd_date_deb", type="datetime", nullable=true)
     */
    private $etdDateDeb;

    /**
     * @var string
     *
     * @ORM\Column(name="etd_date_fin", type="datetime", nullable=true)
     */
    private $etdDateFin;

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
     * @return SkMatiere
     */
    public function getMatNom()
    {
        return $this->matNom;
    }

    /**
     * @param SkMatiere $matNom
     */
    public function setMatNom($matNom)
    {
        $this->matNom = $matNom;
    }

    /**
     * @return string
     */
    public function getEtdDateDeb()
    {
        return $this->etdDateDeb;
    }

    /**
     * @param string $etdDateDeb
     */
    public function setEtdDateDeb($etdDateDeb)
    {
        $this->etdDateDeb = $etdDateDeb;
    }

    /**
     * @return string
     */
    public function getEtdDateFin()
    {
        return $this->etdDateFin;
    }

    /**
     * @param string $etdDateFin
     */
    public function setEtdDateFin($etdDateFin)
    {
        $this->etdDateFin = $etdDateFin;
    }



}