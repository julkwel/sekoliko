<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 2:11 PM
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkRole.
 *
 * @ORM\Table(name="sk_edt")
 * @ORM\Entity
 */
class SkEdt
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
     * @var SkMatiere
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkMatiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matNom", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $matNom;

    /**
     * @var string
     *
     * @ORM\Column(name="etd_date_deb", type="datetime", nullable=true)
     */
    private $etdDateDeb;

    /**
     * @var string
     *
     * @ORM\Column(name="etd_date_fin", type="datetime", nullable=true)
     */
    private $etdDateFin;
}