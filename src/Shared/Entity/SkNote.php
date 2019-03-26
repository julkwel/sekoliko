<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 2:02 PM
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
    
    
}