<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EcolageRepository")
 */
class Ecolage
{
    use Timestampable;
    use EntityIdTrait;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $month;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPaid;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="ecolages")
     */
    private $student;

    /**
     * @return string|null
     */
    public function getMonth(): ?string
    {
        return $this->month;
    }

    /**
     * @param string $month
     *
     * @return $this
     */
    public function setMonth(string $month): self
    {
        $this->month = $month;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    /**
     * @param bool $isPaid
     *
     * @return $this
     */
    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param string|null $price
     *
     * @return $this
     */
    public function setPrice(?string $price): self
    {
        $this->price = $price;

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
     * @return $this
     */
    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }
}
