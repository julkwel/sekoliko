<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 2:48 PM
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * SkNiveau
 *
 * @ORM\Table(name="sk_niveau")
 * @ORM\Entity
 */
class SkNiveau
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_nom", type="string", length=100, nullable=false)
     */
    private $niveauNom;

    /**
     * @var SkEtablissement
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkEtablissement")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="etsNom", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $etsNom;
}