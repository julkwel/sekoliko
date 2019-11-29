<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Subject
{
    use SekolikoEtablissementTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassSubject", mappedBy="subject")
     */
    private $classSubjects;

    /**
     * Subject constructor.
     */
    public function __construct()
    {
        $this->classSubjects = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return Subject
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return Collection|ClassSubject[]
     */
    public function getClassSubjects(): Collection
    {
        return $this->classSubjects;
    }

    /**
     * @param ClassSubject $classSubject
     *
     * @return Subject
     */
    public function addClassSubject(ClassSubject $classSubject): self
    {
        if (!$this->classSubjects->contains($classSubject)) {
            $this->classSubjects[] = $classSubject;
            $classSubject->setSubject($this);
        }

        return $this;
    }

    /**
     * @param ClassSubject $classSubject
     *
     * @return Subject
     */
    public function removeClassSubject(ClassSubject $classSubject): self
    {
        if ($this->classSubjects->contains($classSubject)) {
            $this->classSubjects->removeElement($classSubject);
            // set the owning side to null (unless already changed)
            if ($classSubject->getSubject() === $this) {
                $classSubject->setSubject(null);
            }
        }

        return $this;
    }
}
