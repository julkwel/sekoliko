<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 2:15 PM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkClasse.
 *
 * @ORM\Table(name="sk_classe")
 * @ORM\Entity
 */
class SkClasse
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
     * @var string
     *
     * @ORM\Column(name="classe_nom", type="string", length=100, nullable=false)
     */
    private $classeNom;

    /**
     * @var SkMatiere
     * @ORM\ManyToMany(targetEntity="App\Shared\Entity\SkMatiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matiere", referencedColumnName="id", onDelete="SET NULL")
     * })
     */
    private $matiere;

    /**
     * @var SkNiveau
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkNiveau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="niveau", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $niveau;

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
    public function getClasseNom()
    {
        return $this->classeNom;
    }

    /**
     * @param string $classeNom
     */
    public function setClasseNom($classeNom)
    {
        $this->classeNom = $classeNom;
    }

    /**
     * @return SkNiveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * @param SkNiveau $niveau
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
    }

    /**
     * @return SkMatiere
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param SkMatiere $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }
}
