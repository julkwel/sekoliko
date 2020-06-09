<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SchoolYearRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class SchoolYear
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
     *
     * @Assert\NotBlank()
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Assert\NotBlank()
     */
    private $endDate;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="schoolYear")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Scolarite", mappedBy="schoolYear")
     */
    private $scolarites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Administrator", mappedBy="schoolYear")
     */
    private $administrators;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="schoolYear")
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassSubject", mappedBy="schoolYear")
     */
    private $classSubjects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Session", mappedBy="schoolYear")
     */
    private $sessions;

    /**
     * SchoolYear constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->scolarites = new ArrayCollection();
        $this->administrators = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->classSubjects = new ArrayCollection();
        $this->sessions = new ArrayCollection();
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
     * @return SchoolYear
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
     * @return \DateTimeInterface|null
     */
    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * @param \DateTimeInterface|null $startDate
     *
     * @return SchoolYear
     */
    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * @param \DateTimeInterface|null $endDate
     *
     * @return SchoolYear
     */
    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /**
     * @param User $user
     *
     * @return SchoolYear
     */
    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setSchoolYear($this);
        }

        return $this;
    }

    /**
     * @param User $user
     *
     * @return SchoolYear
     */
    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getSchoolYear() === $this) {
                $user->setSchoolYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Scolarite[]
     */
    public function getScolarites(): Collection
    {
        return $this->scolarites;
    }

    /**
     * @param Scolarite $scolarite
     *
     * @return SchoolYear
     */
    public function addScolarite(Scolarite $scolarite): self
    {
        if (!$this->scolarites->contains($scolarite)) {
            $this->scolarites[] = $scolarite;
            $scolarite->setSchoolYear($this);
        }

        return $this;
    }

    /**
     * @param Scolarite $scolarite
     *
     * @return SchoolYear
     */
    public function removeScolarite(Scolarite $scolarite): self
    {
        if ($this->scolarites->contains($scolarite)) {
            $this->scolarites->removeElement($scolarite);
            // set the owning side to null (unless already changed)
            if ($scolarite->getSchoolYear() === $this) {
                $scolarite->setSchoolYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Administrator[]
     */
    public function getAdministrators(): Collection
    {
        return $this->administrators;
    }

    /**
     * @param Administrator $administrator
     *
     * @return SchoolYear
     */
    public function addAdministrator(Administrator $administrator): self
    {
        if (!$this->administrators->contains($administrator)) {
            $this->administrators[] = $administrator;
            $administrator->setSchoolYear($this);
        }

        return $this;
    }

    /**
     * @param Administrator $administrator
     *
     * @return SchoolYear
     */
    public function removeAdministrator(Administrator $administrator): self
    {
        if ($this->administrators->contains($administrator)) {
            $this->administrators->removeElement($administrator);
            // set the owning side to null (unless already changed)
            if ($administrator->getSchoolYear() === $this) {
                $administrator->setSchoolYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    /**
     * @param Reservation $reservation
     *
     * @return SchoolYear
     */
    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setSchoolYear($this);
        }

        return $this;
    }

    /**
     * @param Reservation $reservation
     *
     * @return SchoolYear
     */
    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getSchoolYear() === $this) {
                $reservation->setSchoolYear(null);
            }
        }

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
     * @return SchoolYear
     */
    public function addClassSubject(ClassSubject $classSubject): self
    {
        if (!$this->classSubjects->contains($classSubject)) {
            $this->classSubjects[] = $classSubject;
            $classSubject->setSchoolYear($this);
        }

        return $this;
    }

    /**
     * @param ClassSubject $classSubject
     *
     * @return SchoolYear
     */
    public function removeClassSubject(ClassSubject $classSubject): self
    {
        if ($this->classSubjects->contains($classSubject)) {
            $this->classSubjects->removeElement($classSubject);
            // set the owning side to null (unless already changed)
            if ($classSubject->getSchoolYear() === $this) {
                $classSubject->setSchoolYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Session[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    /**
     * @param Session $session
     *
     * @return SchoolYear
     */
    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setSchoolYear($this);
        }

        return $this;
    }

    /**
     * @param Session $session
     *
     * @return SchoolYear
     */
    public function removeSession(Session $session): self
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
            // set the owning side to null (unless already changed)
            if ($session->getSchoolYear() === $this) {
                $session->setSchoolYear(null);
            }
        }

        return $this;
    }
}
