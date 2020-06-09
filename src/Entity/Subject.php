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
    use EntityIdTrait;

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
     * @ORM\OneToMany(targetEntity="App\Entity\EmploiDuTemps", mappedBy="matiere")
     */
    private $emploiDuTemps;

    /**
     * Subject constructor.
     */
    public function __construct()
    {
        $this->classSubjects = new ArrayCollection();
        $this->emploiDuTemps = new ArrayCollection();
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

    /**
     * @return Collection|EmploiDuTemps[]
     */
    public function getEmploiDuTemps(): Collection
    {
        return $this->emploiDuTemps;
    }

    /**
     * @param EmploiDuTemps $emploiDuTemp
     *
     * @return $this
     */
    public function addEmploiDuTemp(EmploiDuTemps $emploiDuTemp): self
    {
        if (!$this->emploiDuTemps->contains($emploiDuTemp)) {
            $this->emploiDuTemps[] = $emploiDuTemp;
            $emploiDuTemp->setMatiere($this);
        }

        return $this;
    }

    /**
     * @param EmploiDuTemps $emploiDuTemp
     *
     * @return $this
     */
    public function removeEmploiDuTemp(EmploiDuTemps $emploiDuTemp): self
    {
        if ($this->emploiDuTemps->contains($emploiDuTemp)) {
            $this->emploiDuTemps->removeElement($emploiDuTemp);
            // set the owning side to null (unless already changed)
            if ($emploiDuTemp->getMatiere() === $this) {
                $emploiDuTemp->setMatiere(null);
            }
        }

        return $this;
    }
}
