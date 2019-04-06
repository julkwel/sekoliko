<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/6/19
 * Time: 12:23 AM
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
     * @var $debut
     * @ORM\Column(name="debut",type="datetime", nullable=true)
     */
    private $debut;

    /**
     * @var $fin
     * @ORM\Column(name="fin",type="datetime",nullable=true)
     */
    private $fin;

    /**
     * @return mixed
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * @param mixed $debut
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;
    }

    /**
     * @return mixed
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * @param mixed $fin
     */
    public function setFin($fin)
    {
        $this->fin = $fin;
    }


}