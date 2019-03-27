<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/21/19
 * Time: 10:51 PM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkEtablissement
 *
 * @ORM\Table(name="ets")
 * @ORM\Entity
 */
trait SkEtablissement
{

    /**
     * @var string
     *
     * @ORM\Column(name="ets_nom", type="string", length=100, nullable=true)
     */
    private $etsNom;

    /**
     * @var string
     *
     * @ORM\Column(name="ets_adresse", type="text", nullable=true)
     */
    private $etsAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ets_responsable", type="string", length=100, nullable=true)
     */
    private $etsResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="ets_phone", type="string", length=100, nullable=true)
     */
    private $etsPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="ets_email", type="string", length=150, nullable=true)
     */
    private $etsEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="ets_logo", type="string", length=255, nullable=true)
     */
    private $etsLogo;


    /**
     * @return string
     */
    public function getEtsNom()
    {
        return $this->etsNom;
    }

    /**
     * @param string $etsNom
     */
    public function setEtsNom($etsNom)
    {
        $this->etsNom = $etsNom;
    }

    /**
     * @return string
     */
    public function getEtsAdresse()
    {
        return $this->etsAdresse;
    }

    /**
     * @param string $etsAdresse
     */
    public function setEtsAdresse(string $etsAdresse)
    {
        $this->etsAdresse = $etsAdresse;
    }

    /**
     * @return string
     */
    public function getEtsResponsable()
    {
        return $this->etsResponsable;
    }

    /**
     * @param string $etsResponsable
     */
    public function setEtsResponsable($etsResponsable)
    {
        $this->etsResponsable = $etsResponsable;
    }

    /**
     * @return string
     */
    public function getEtsPhone()
    {
        return $this->etsPhone;
    }

    /**
     * @param string $etsPhone
     */
    public function setEtsPhone($etsPhone)
    {
        $this->etsPhone = $etsPhone;
    }

    /**
     * @return string
     */
    public function getEtsEmail()
    {
        return $this->etsEmail;
    }

    /**
     * @param string $etsEmail
     */
    public function setEtsEmail($etsEmail)
    {
        $this->etsEmail = $etsEmail;
    }

    /**
     * @return string
     */
    public function getEtsLogo()
    {
        return $this->etsLogo;
    }

    /**
     * @param string $etsLogo
     */
    public function setEtsLogo($etsLogo)
    {
        $this->etsLogo = $etsLogo;
    }

    

}
