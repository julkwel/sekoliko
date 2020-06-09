<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    use SekolikoEtablissementTrait;
    use EntityIdTrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Room", inversedBy="reservations")
     */
    private $room;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $start;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $end;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isValid;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean",nullable=true)
     */
    private $isFin;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="reservations")
     */
    private $reservator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SchoolYear", inversedBy="reservations")
     */
    private $schoolYear;

    /**
     * Reservation constructor.
     */
    public function __construct()
    {
        $this->reservator = new ArrayCollection();
    }

    /**
     * @return Room|null
     */
    public function getRoom(): ?Room
    {
        return $this->room;
    }

    /**
     * @param Room|null $room
     *
     * @return Reservation
     */
    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getStart(): ?DateTimeInterface
    {
        return $this->start;
    }

    /**
     * @param DateTimeInterface|null $start
     *
     * @return Reservation
     */
    public function setStart(?DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEnd(): ?DateTimeInterface
    {
        return $this->end;
    }

    /**
     * @param DateTimeInterface|null $end
     *
     * @return Reservation
     */
    public function setEnd(?DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return Reservation
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    /**
     * @param bool|null $isValid
     *
     * @return Reservation
     */
    public function setIsValid(?bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function isFin(): ?bool
    {
        return $this->isFin;
    }

    /**
     * @param bool $isFin
     *
     * @return Reservation
     */
    public function setIsFin(bool $isFin): self
    {
        $this->isFin = $isFin;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getReservator(): Collection
    {
        return $this->reservator;
    }

    /**
     * @param User $reservator
     *
     * @return Reservation
     */
    public function addReservator(User $reservator): self
    {
        if (!$this->reservator->contains($reservator)) {
            $this->reservator[] = $reservator;
        }

        return $this;
    }

    /**
     * @param User $reservator
     *
     * @return Reservation
     */
    public function removeReservator(User $reservator): self
    {
        if ($this->reservator->contains($reservator)) {
            $this->reservator->removeElement($reservator);
        }

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
     * @return Reservation
     */
    public function setSchoolYear(?SchoolYear $schoolYear): self
    {
        $this->schoolYear = $schoolYear;

        return $this;
    }
}
