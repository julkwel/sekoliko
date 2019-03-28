<?php
/**
 * Created by PhpStorm.
 * User: chrys
 * Date: 27/03/19
 * Time: 21:24
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * SkDisciplineList
 * @ORM\Table(name="sk_discipline_list")
 * @ORM\Entity
 */
class SkDisciplineList
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
     * @ORM\Column(name="name", type="string", length=80, nullable=false)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkDiscipline")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $discipline;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }

    /**
     * @param mixed $discipline
     */
    public function setDiscipline($discipline)
    {
        $this->discipline = $discipline;
    }


}