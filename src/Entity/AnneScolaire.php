<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnneScolaireRepository")
 */
trait AnneScolaire
{

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $asName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $asDateDebut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $asDateFin;

    /**
     * @return mixed
     */
    public function getAsName()
    {
        return $this->asName;
    }

    /**
     * @param mixed $asName
     */
    public function setAsName($asName): void
    {
        $this->asName = $asName;
    }

    /**
     * @return mixed
     */
    public function getAsDateDebut()
    {
        return $this->asDateDebut;
    }

    /**
     * @param mixed $asDateDebut
     */
    public function setAsDateDebut($asDateDebut): void
    {
        $this->asDateDebut = $asDateDebut;
    }

    /**
     * @return mixed
     */
    public function getAsDateFin()
    {
        return $this->asDateFin;
    }

    /**
     * @param mixed $asDateFin
     */
    public function setAsDateFin($asDateFin): void
    {
        $this->asDateFin = $asDateFin;
    }
}
