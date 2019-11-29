<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

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

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
}
