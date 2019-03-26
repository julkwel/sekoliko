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
 * SkRole.
 *
 * @ORM\Table(name="sk_role")
 * @ORM\Entity
 */
class SkRole
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
     * @ORM\Column(name="rl_name", type="string", length=45, nullable=true)
     */
    private $rlName;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rlName.
     *
     * @param string $rlName
     *
     * @return SkRole
     */
    public function setRlName($rlName)
    {
        $this->rlName = $rlName;

        return $this;
    }

    /**
     * Get rlName.
     *
     * @return string
     */
    public function getRlName()
    {
        return $this->rlName;
    }
}
