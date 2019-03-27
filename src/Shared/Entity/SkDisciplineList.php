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
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkDiscipline", inversedBy="$disciplineList")
     * @ORM\JoinColumn(nullable=false)
     */
    private $discipline;

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
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSkDiscipline(): ?SkDiscipline
    {
        return $this->discipline;
    }

    public function setSkDiscipline(?SkDiscipline $discipline): self
    {
        $this->discipline = $discipline;

        return $this;
    }

}