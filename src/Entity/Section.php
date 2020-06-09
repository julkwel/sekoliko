<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SectionRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Section
{
    use SekolikoEtablissementTrait;
    use EntityIdTrait;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassRoom", mappedBy="section",orphanRemoval=true)
     */
    private $classRooms;

    /**
     * Section constructor.
     */
    public function __construct()
    {
        $this->classRooms = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Section
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTimeInterface|null $deletedAt
     *
     * @return Section
     */
    public function setDeletedAt(?DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return Collection|ClassRoom[]
     */
    public function getClassRooms(): Collection
    {
        return $this->classRooms;
    }

    /**
     * @param ClassRoom $classRoom
     *
     * @return Section
     */
    public function addClassRoom(ClassRoom $classRoom): self
    {
        if (!$this->classRooms->contains($classRoom)) {
            $this->classRooms[] = $classRoom;
            $classRoom->setSection($this);
        }

        return $this;
    }

    /**
     * @param ClassRoom $classRoom
     *
     * @return Section
     */
    public function removeClassRoom(ClassRoom $classRoom): self
    {
        if ($this->classRooms->contains($classRoom)) {
            $this->classRooms->removeElement($classRoom);
            // set the owning side to null (unless already changed)
            if ($classRoom->getSection() === $this) {
                $classRoom->setSection(null);
            }
        }

        return $this;
    }
}
