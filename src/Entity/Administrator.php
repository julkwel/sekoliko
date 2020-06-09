<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdministratorRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Administrator
{
    use SekolikoEtablissementTrait;
    use EntityIdTrait;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $salary;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AdministrationType", inversedBy="administrators")
     *
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="administrator", cascade={"persist", "remove"})
     *
     * @Assert\Valid()
     */
    private $user;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SchoolYear", inversedBy="administrators")
     */
    private $schoolYear;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $diplome;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cin;

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCin;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $lieuCin;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $numAe;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $noteLibre;

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
     * @return Administrator
     */
    public function setSalary(?string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * @return AdministrationType|null
     */
    public function getType(): ?AdministrationType
    {
        return $this->type;
    }

    /**
     * @param AdministrationType|null $type
     *
     * @return Administrator
     */
    public function setType(?AdministrationType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateCreate(): ?DateTimeInterface
    {
        return $this->dateCreate;
    }

    /**
     * @param DateTimeInterface|null $dateCreate
     *
     * @return Administrator
     */
    public function setDateCreate(?DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

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
     * @return Administrator
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

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
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     *
     * @return Administrator
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
     * @return Administrator
     */
    public function setContact(?string $contact): self
    {
        $this->contact = $contact;

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
     * @return Administrator
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
     * @return Administrator
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
     * @return Administrator
     */
    public function setCin(?string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateCin(): ?DateTimeInterface
    {
        return $this->dateCin;
    }

    /**
     * @param DateTimeInterface|null $dateCin
     *
     * @return Administrator
     */
    public function setDateCin(?DateTimeInterface $dateCin): self
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
     * @return Administrator
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
     * @return Administrator
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
     * @return Administrator
     */
    public function setNoteLibre(?string $noteLibre): Administrator
    {
        $this->noteLibre = $noteLibre;

        return $this;
    }
}
