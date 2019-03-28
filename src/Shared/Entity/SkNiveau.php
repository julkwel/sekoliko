<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 2:48 PM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkNiveau.
 *
 * @ORM\Table(name="sk_niveau")
 * @ORM\Entity
 */
class SkNiveau
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
     * @ORM\Column(name="niveau_nom", type="string", length=100, nullable=false)
     */
    private $niveauNom;

    /**
     * @return int
     */
    public function getId(): int
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
    public function getNiveauNom()
    {
        return $this->niveauNom;
    }

    /**
     * @param string $niveauNom
     */
    public function setNiveauNom($niveauNom)
    {
        $this->niveauNom = $niveauNom;
    }
}
