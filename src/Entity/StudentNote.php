<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentNoteRepository")
 */
class StudentNote
{
    use EntityIdTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ClassSubject", inversedBy="studentNotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiere;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $note;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="studentNotes")
     */
    private $student;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Session", inversedBy="studentNotes")
     */
    private $session;

    /**
     * @return ClassSubject|null
     */
    public function getMatiere(): ?ClassSubject
    {
        return $this->matiere;
    }

    /**
     * @param ClassSubject|null $matiere
     *
     * @return StudentNote
     */
    public function setMatiere(?ClassSubject $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNote(): ?string
    {
        return $this->note;
    }

    /**
     * @param string $note
     *
     * @return StudentNote
     */
    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObservation(): ?string
    {
        return $this->observation;
    }

    /**
     * @param string|null $observation
     *
     * @return StudentNote
     */
    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * @return Student|null
     */
    public function getStudent(): ?Student
    {
        return $this->student;
    }

    /**
     * @param Student|null $student
     *
     * @return StudentNote
     */
    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    /**
     * @return Session|null
     */
    public function getSession(): ?Session
    {
        return $this->session;
    }

    /**
     * @param Session|null $session
     *
     * @return StudentNote
     */
    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }
}
