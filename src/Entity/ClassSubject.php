<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassSubjectRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class ClassSubject
{
    use SekolikoEtablissementTrait;
    use EntityIdTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClassRoom", inversedBy="classSubjects")
     */
    private $classRoom;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $coefficient;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SchoolYear", inversedBy="classSubjects")
     */
    private $schoolYear;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Scolarite", inversedBy="classSubjects")
     */
    private $profs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="classSubjects")
     */
    private $subject;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StudentNote", mappedBy="matiere")
     */
    private $studentNotes;

    /**
     * ClassSubject constructor.
     */
    public function __construct()
    {
        $this->studentNotes = new ArrayCollection();
    }

    /**
     * @return ClassRoom|null
     */
    public function getClassRoom(): ?ClassRoom
    {
        return $this->classRoom;
    }

    /**
     * @param ClassRoom|null $classRoom
     *
     * @return ClassSubject
     */
    public function setClassRoom(?ClassRoom $classRoom): self
    {
        $this->classRoom = $classRoom;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCoefficient(): ?string
    {
        return $this->coefficient;
    }

    /**
     * @param string|null $coefficient
     *
     * @return ClassSubject
     */
    public function setCoefficient(?string $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTimeInterface|null $deletedAt
     *
     * @return ClassSubject
     */
    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return SchoolYear|null
     */
    public function getSchoolYear(): ?SchoolYear
    {
        return $this->schoolYear;
    }

    /**
     * @param SchoolYear|null $schoolYear
     *
     * @return ClassSubject
     */
    public function setSchoolYear(?SchoolYear $schoolYear): self
    {
        $this->schoolYear = $schoolYear;

        return $this;
    }

    /**
     * @return Scolarite|null
     */
    public function getProfs(): ?Scolarite
    {
        return $this->profs;
    }

    /**
     * @param Scolarite|null $profs
     *
     * @return ClassSubject
     */
    public function setProfs(?Scolarite $profs): self
    {
        $this->profs = $profs;

        return $this;
    }

    /**
     * @return Subject|null
     */
    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject|null $subject
     *
     * @return ClassSubject
     */
    public function setSubject(?Subject $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return Collection|StudentNote[]
     */
    public function getStudentNotes(): Collection
    {
        return $this->studentNotes;
    }

    /**
     * @param StudentNote $studentNote
     *
     * @return ClassSubject
     */
    public function addStudentNote(StudentNote $studentNote): self
    {
        if (!$this->studentNotes->contains($studentNote)) {
            $this->studentNotes[] = $studentNote;
            $studentNote->setMatiere($this);
        }

        return $this;
    }

    /**
     * @param StudentNote $studentNote
     *
     * @return ClassSubject
     */
    public function removeStudentNote(StudentNote $studentNote): self
    {
        if ($this->studentNotes->contains($studentNote)) {
            $this->studentNotes->removeElement($studentNote);
            // set the owning side to null (unless already changed)
            if ($studentNote->getMatiere() === $this) {
                $studentNote->setMatiere(null);
            }
        }

        return $this;
    }
}
