<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/9/19
 * Time: 9:37 AM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sk_trimestre")
 * @ORM\Entity
 * Class SkTrimestre
 */
class SkTrimestre
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
     * @var
     * @ORM\Column(name="name",type="string",length=100,nullable=false)
     */
    private $name;

    /**
     * @var
     * @ORM\Column(name="trim_debut",type="datetime",nullable=false)
     */
    private $trimDebut;

    /**
     * @var
     * @ORM\Column(name="trim_fin",type="datetime",nullable=false)
     */
    private $trimFin;

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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTrimDebut()
    {
        return $this->trimDebut;
    }

    /**
     * @param mixed $trimDebut
     */
    public function setTrimDebut($trimDebut)
    {
        $this->trimDebut = $trimDebut;
    }

    /**
     * @return mixed
     */
    public function getTrimFin()
    {
        return $this->trimFin;
    }

    /**
     * @param mixed $trimFin
     */
    public function setTrimFin($trimFin)
    {
        $this->trimFin = $trimFin;
    }
}
