<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtablissementRepository")
 */
trait Etablissement
{

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $etsNom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $etsAddresse;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $etsContact;

    /**
     * @return mixed
     */
    public function getEtsNom()
    {
        return $this->etsNom;
    }

    /**
     * @param mixed $etsNom
     */
    public function setEtsNom($etsNom): void
    {
        $this->etsNom = $etsNom;
    }

    /**
     * @return mixed
     */
    public function getEtsAddresse()
    {
        return $this->etsAddresse;
    }

    /**
     * @param mixed $etsAddresse
     */
    public function setEtsAddresse($etsAddresse): void
    {
        $this->etsAddresse = $etsAddresse;
    }

    /**
     * @return mixed
     */
    public function getEtsContact()
    {
        return $this->etsContact;
    }

    /**
     * @param mixed $etsContact
     */
    public function setEtsContact($etsContact): void
    {
        $this->etsContact = $etsContact;
    }
}
