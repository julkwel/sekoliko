<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 2:02 PM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkRole.
 *
 * @ORM\Table(name="sk_note")
 * @ORM\Entity
 */
class SkNote
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
     * @var SkEtudiant
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkEtudiant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etudiant", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $etudiant;

    /**
     * @var SkTrimestre
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkTrimestre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="trimestre", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $trimestre;

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
     * @ORM\Column(name="note_val", type="string", length=100, nullable=true)
     */
    private $noteVal;

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
    public function getNoteVal()
    {
        return $this->noteVal;
    }

    /**
     * @param string $noteVal
     */
    public function setNoteVal($noteVal)
    {
        $this->noteVal = $noteVal;
    }

    /**
     * @return SkEtudiant
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }

    /**
     * @param $etudiant
     */
    public function setEtudiant($etudiant)
    {
        $this->etudiant = $etudiant;
    }

    /**
     * @return SkTrimestre
     */
    public function getTrimestre()
    {
        return $this->trimestre;
    }

    /**
     * @param SkTrimestre $trimestre
     */
    public function setTrimestre($trimestre)
    {
        $this->trimestre = $trimestre;
    }
}
