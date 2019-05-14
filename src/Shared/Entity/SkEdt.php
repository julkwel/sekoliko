<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 2:11 PM.
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
     * @var SkClasseMatiere
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkClasseMatiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matNom", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $matNom;

    /**
     * @var SkClasse
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkClasse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edtClasse", referencedColumnName="id", onDelete="CASCADE",nullable=true)
     * })
     */
    private $edtClasse;

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
     * @return SkClasseMatiere
     */
    public function getMatNom()
    {
        return $this->matNom;
    }

    /**
     * @param SkClasseMatiere $matNom
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

    /**
     * @return SkClasse
     */
    public function getEdtClasse()
    {
        return $this->edtClasse;
    }

    /**
     * @param SkClasse $edtClasse
     */
    public function setEdtClasse($edtClasse)
    {
        $this->edtClasse = $edtClasse;
    }
}
