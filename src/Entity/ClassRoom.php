<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassRoomRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class ClassRoom
{
    use SekolikoEtablissementTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Section", inversedBy="classRooms")
     */
    private $section;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="classRooms")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassSubject", mappedBy="classRoom")
     */
    private $classSubjects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Student", mappedBy="classe")
     */
    private $students;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $ecolage;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EmploiDuTemps", mappedBy="classe")
     */
    private $emploiDuTemps;

    /**
     * ClassRoom constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->createdAt = new DateTime('now');
        $this->classSubjects = new ArrayCollection();
        $this->students = new ArrayCollection();
        $this->emploiDuTemps = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Section|null
     */
    public function getSection(): ?Section
    {
        return $this->section;
    }

    /**
     * @param Section|null $section
     *
     * @return ClassRoom
     */
    public function setSection(?Section $section): self
    {
        $this->section = $section;

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
     * @return ClassRoom
     */
    public function setDeletedAt(?DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    /**
     * @param User|null $createdBy
     *
     * @return ClassRoom
     */
    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface|null $createdAt
     *
     * @return ClassRoom
     */
    public function setCreatedAt(?DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
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
     * @return ClassRoom
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
     * @return ClassRoom
     */
    public function addClassSubject(ClassSubject $classSubject): self
    {
        if (!$this->classSubjects->contains($classSubject)) {
            $this->classSubjects[] = $classSubject;
            $classSubject->setClassRoom($this);
        }

        return $this;
    }

    /**
     * @param ClassSubject $classSubject
     *
     * @return ClassRoom
     */
    public function removeClassSubject(ClassSubject $classSubject): self
    {
        if ($this->classSubjects->contains($classSubject)) {
            $this->classSubjects->removeElement($classSubject);
            // set the owning side to null (unless already changed)
            if ($classSubject->getClassRoom() === $this) {
                $classSubject->setClassRoom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    /**
     * @param Student $student
     *
     * @return ClassRoom
     */
    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setClasse($this);
        }

        return $this;
    }

    /**
     * @param Student $student
     *
     * @return ClassRoom
     */
    public function removeStudent(Student $student): self
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
            // set the owning side to null (unless already changed)
            if ($student->getClasse() === $this) {
                $student->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEcolage(): ?string
    {
        return $this->ecolage;
    }

    /**
     * @param string|null $ecolage
     *
     * @return $this
     */
    public function setEcolage(?string $ecolage): self
    {
        $this->ecolage = $ecolage;

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
            $emploiDuTemp->setClasse($this);
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
            if ($emploiDuTemp->getClasse() === $this) {
                $emploiDuTemp->setClasse(null);
            }
        }

        return $this;
    }
}
