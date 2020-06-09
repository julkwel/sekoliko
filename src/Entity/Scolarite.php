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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScolariteRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Scolarite
{
    use SekolikoEtablissementTrait;
    use EntityIdTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ScolariteType", inversedBy="scolarites")
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     *
     * @Assert\Valid()
     */
    private $user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreate;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank()
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @Assert\NotBlank()
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $salary;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SchoolYear", inversedBy="scolarites")
     */
    private $schoolYear;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $diplome;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCin;

    /**
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $lieuCin;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $numAe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $noteLibre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ClassSubject", mappedBy="profs")
     */
    private $classSubjects;

    /**
     * Scolarite constructor.
     */
    public function __construct()
    {
        $this->classSubjects = new ArrayCollection();
    }

    /**
     * @return ScolariteType|null
     */
    public function getType(): ?ScolariteType
    {
        return $this->type;
    }

    /**
     * @param ScolariteType|null $type
     *
     * @return Scolarite
     */
    public function setType(?ScolariteType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     *
     * @return Scolarite
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    /**
     * @param \DateTimeInterface|null $dateCreate
     *
     * @return Scolarite
     */
    public function setDateCreate(?\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     *
     * @return Scolarite
     */
    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * @param string|null $contact
     *
     * @return Scolarite
     */
    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSalary(): ?string
    {
        return $this->salary;
    }

    /**
     * @param string|null $salary
     *
     * @return Scolarite
     */
    public function setSalary(?string $salary): self
    {
        $this->salary = $salary;

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
     * @return SchoolYear|null
     */
    public function getSchoolYear(): ?SchoolYear
    {
        return $this->schoolYear;
    }

    /**
     * @param SchoolYear|null $schoolYear
     *
     * @return Scolarite
     */
    public function setSchoolYear(?SchoolYear $schoolYear): self
    {
        $this->schoolYear = $schoolYear;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    /**
     * @param string|null $diplome
     *
     * @return Scolarite
     */
    public function setDiplome(?string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCin(): ?string
    {
        return $this->cin;
    }

    /**
     * @param string|null $cin
     *
     * @return Scolarite
     */
    public function setCin(?string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateCin(): ?\DateTimeInterface
    {
        return $this->dateCin;
    }

    /**
     * @param \DateTimeInterface|null $dateCin
     *
     * @return Scolarite
     */
    public function setDateCin(?\DateTimeInterface $dateCin): self
    {
        $this->dateCin = $dateCin;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLieuCin(): ?string
    {
        return $this->lieuCin;
    }

    /**
     * @param string|null $lieuCin
     *
     * @return Scolarite
     */
    public function setLieuCin(?string $lieuCin): self
    {
        $this->lieuCin = $lieuCin;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumAe(): ?string
    {
        return $this->numAe;
    }

    /**
     * @param string|null $numAe
     *
     * @return Scolarite
     */
    public function setNumAe(?string $numAe): self
    {
        $this->numAe = $numAe;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNoteLibre(): ?string
    {
        return $this->noteLibre;
    }

    /**
     * @param string|null $noteLibre
     *
     * @return Scolarite
     */
    public function setNoteLibre(?string $noteLibre): self
    {
        $this->noteLibre = $noteLibre;

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
     * @return Scolarite
     */
    public function addClassSubject(ClassSubject $classSubject): self
    {
        if (!$this->classSubjects->contains($classSubject)) {
            $this->classSubjects[] = $classSubject;
            $classSubject->setProfs($this);
        }

        return $this;
    }

    /**
     * @param ClassSubject $classSubject
     *
     * @return Scolarite
     */
    public function removeClassSubject(ClassSubject $classSubject): self
    {
        if ($this->classSubjects->contains($classSubject)) {
            $this->classSubjects->removeElement($classSubject);
            // set the owning side to null (unless already changed)
            if ($classSubject->getProfs() === $this) {
                $classSubject->setProfs(null);
            }
        }

        return $this;
    }
}
