<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/16/19
 * Time: 3:38 PM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkMatiere.
 *
 * @ORM\Table(name="sk_matiere")
 * @ORM\Entity
 */
class SkMatiere
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
     * @ORM\Column(name="mat_nom", type="string", length=100, nullable=true)
     */
    private $matNom;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="App\Shared\Entity\SkClasseMatiere",mappedBy="matiere")
     */
    private $matclass;

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
    public function getMatNom()
    {
        return $this->matNom;
    }

    /**
     * @param string $matNom
     */
    public function setMatNom($matNom)
    {
        $this->matNom = $matNom;
    }

    /**
     * @return mixed
     */
    public function getMatclass()
    {
        return $this->matclass;
    }

    /**
     * @param mixed $matclass
     */
    public function setMatclass($matclass)
    {
        $this->matclass = $matclass;
    }
}
