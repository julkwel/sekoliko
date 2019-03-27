<?php
/**
 * Created by PhpStorm.
 * User: chrys
 * Date: 27/03/19
 * Time: 21:16
 */

namespace App\Shared\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * SkDiscipline
 * @ORM\Table(name="sk_discipline")
 * @ORM\Entity
*/

class SkDiscipline
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
     * @var string
     *
     * @ORM\Column(name="descritpion", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Shared\Entity\SkDisciplineList", mappedBy="$discipline", orphanRemoval=true)
     */
    private $disciplineList;

    public function __construct()
    {
        $this->disciplineList = new ArrayCollection();
    }

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

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Collection|SkDisciplineList[]
     */
    public function getDisciplineList(): Collection
    {
        return $this->disciplineList;
    }

    public function addDisciplineList(SkDisciplineList $disciplineList): self
    {
        if (!$this->disciplineList->contains($disciplineList)) {
            $this->disciplineList[] = $disciplineList;
            $disciplineList->setSkDiscipline($this);
        }

        return $this;
    }

    public function removeDisciplineList(SkDisciplineList $disciplineList): self
    {
        if ($this->disciplineList->contains($disciplineList)) {
            $this->disciplineList->removeElement($disciplineList);
            // set the owning side to null (unless already changed)
            if ($disciplineList->getSkDiscipline() === $this) {
                $disciplineList->setSkDiscipline(null);
            }
        }

        return $this;
    }

}