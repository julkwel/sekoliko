<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/6/19
 * Time: 12:23 AM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="sk_anne")
 * @ORM\Entity
 */
trait SkAnneScolaire
{
    /**
     * @var
     * @ORM\Column(name="anne_scolaire_debut",type="datetime", nullable=true)
     */
    private $anneScolaireDebut;

    /**
     * @var
     * @ORM\Column(name="anne_scolaire_fin",type="datetime",nullable=true)
     */
    private $anneScolaireFin;

    /**
     * @return mixed
     */
    public function getAnneScolaireDebut()
    {
        return $this->anneScolaireDebut;
    }

    /**
     * @param mixed $anneScolaireDebut
     */
    public function setAnneScolaireDebut($anneScolaireDebut)
    {
        $this->anneScolaireDebut = $anneScolaireDebut;
    }

    /**
     * @return mixed
     */
    public function getAnneScolaireFin()
    {
        return $this->anneScolaireFin;
    }

    /**
     * @param mixed $anneScolaireFin
     */
    public function setAnneScolaireFin($anneScolaireFin)
    {
        $this->anneScolaireFin = $anneScolaireFin;
    }
}
