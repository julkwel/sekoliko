<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 4:37 PM.
 */

namespace App\Shared\Entity;

use App\Bundle\User\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * SkClasse.
 *
 * @ORM\Table(name="sk_etudiant")
 * @ORM\Entity
 */
class SkEtudiant
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
     * @var SkClasse
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkClasse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="niveau", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $classe;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="App\Bundle\User\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etudiant", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $etudiant;

    /**
     * @var string
     * @ORM\Column(name="is_renvoie",type="boolean", options={"default":"0"},nullable=true)
     */
    private $isRenvoie;

    /**
     * @var string
     * @ORM\Column(name="date_renvoie",type="datetime",nullable=true)
     */
    private $dateRenvoie;

    /**
     * @var string
     * @ORM\Column(name="motif_renvoie",type="text",nullable=true)
     */
    private $motifRenvoie;

    /**
     * @var string
     * @ORM\Column(name="date_de_naissance",type="string",length=200,nullable=true)
     */
    private $dateDeNaissance;

    /**
     * @var string
     * @ORM\Column(name="mere",type="string",length=200,nullable=true)
     */
    private $mere;

    /**
     * @var string
     * @ORM\Column(name="pere",type="string",length=200,nullable=true)
     */
    private $pere;

    /**
     * @var string
     * @ORM\Column(name="contact_parent",type="string",length=100,nullable=true)
     */
    private $contactParent;

    /**
     * @var string
     * @ORM\Column(name="sexe",type="string",length=100,nullable=true)
     */
    private $sexe;

    /**
     * @var string
     * @ORM\Column(name="addition",type="string",length=100, nullable=true)
     */
    private $addition;

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
     * @return SkClasse
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param SkClasse $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

    /**
     * @return User
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * @param User $etudiant
     */
    public function setEtudiant($etudiant)
    {
        $this->etudiant = $etudiant;
    }

    /**
     * @return string
     */
    public function getisRenvoie()
    {
        return $this->isRenvoie;
    }

    /**
     * @param string $isRenvoie
     */
    public function setIsRenvoie($isRenvoie)
    {
        $this->isRenvoie = $isRenvoie;
    }

    /**
     * @return string
     */
    public function getDateRenvoie()
    {
        return $this->dateRenvoie;
    }

    /**
     * @param string $dateRenvoie
     */
    public function setDateRenvoie($dateRenvoie)
    {
        $this->dateRenvoie = $dateRenvoie;
    }

    /**
     * @return string
     */
    public function getMotifRenvoie()
    {
        return $this->motifRenvoie;
    }

    /**
     * @param string $motifRenvoie
     */
    public function setMotifRenvoie($motifRenvoie)
    {
        $this->motifRenvoie = $motifRenvoie;
    }

    /**
     * @return string
     */
    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    /**
     * @param string $dateDeNaissance
     */
    public function setDateDeNaissance($dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;
    }

    /**
     * @return string
     */
    public function getMere()
    {
        return $this->mere;
    }

    /**
     * @param string $mere
     */
    public function setMere($mere)
    {
        $this->mere = $mere;
    }

    /**
     * @return string
     */
    public function getPere()
    {
        return $this->pere;
    }

    /**
     * @param string $pere
     */
    public function setPere($pere)
    {
        $this->pere = $pere;
    }

    /**
     * @return string
     */
    public function getContactParent()
    {
        return $this->contactParent;
    }

    /**
     * @param string $contactParent
     */
    public function setContactParent($contactParent)
    {
        $this->contactParent = $contactParent;
    }

    /**
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param string $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return string
     */
    public function getAddition()
    {
        return $this->addition;
    }

    /**
     * @param string $addition
     */
    public function setAddition($addition)
    {
        $this->addition = $addition;
    }
}
