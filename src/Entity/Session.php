<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Session
{
    use SekolikoEtablissementTrait;
    use EntityIdTrait;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SchoolYear", inversedBy="sessions")
     */
    private $schoolYear;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\StudentNote", mappedBy="session")
     */
    private $studentNotes;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->studentNotes = new ArrayCollection();
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
     * @return Session
     */
    public function setName(string $name): self
    {
        $this->name = $name;

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
     * @return Session
     */
    public function setSchoolYear(?SchoolYear $schoolYear): self
    {
        $this->schoolYear = $schoolYear;

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
     * @return Session
     */
    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

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
     * @return Session
     */
    public function addStudentNote(StudentNote $studentNote): self
    {
        if (!$this->studentNotes->contains($studentNote)) {
            $this->studentNotes[] = $studentNote;
            $studentNote->setSession($this);
        }

        return $this;
    }

    /**
     * @param StudentNote $studentNote
     *
     * @return Session
     */
    public function removeStudentNote(StudentNote $studentNote): self
    {
        if ($this->studentNotes->contains($studentNote)) {
            $this->studentNotes->removeElement($studentNote);
            // set the owning side to null (unless already changed)
            if ($studentNote->getSession() === $this) {
                $studentNote->setSession(null);
            }
        }

        return $this;
    }
}
