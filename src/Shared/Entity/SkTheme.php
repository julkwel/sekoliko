<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/3/19
 * Time: 11:13 PM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class SkTheme.
 *
 * @ORM\Table(name="sk_theme")
 * @ORM\Entity()
 */
class SkTheme
{
    use SkEtablissement;

    use SkAnneScolaire;

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
     * @ORM\Column(name="sidebar",type="string",length=100,nullable=true)
     */
    private $sidebar;

    /**
     * @var string
     * @ORM\Column(name="header",type="string",length=100,nullable=true)
     */
    private $header;

    /**
     * @var string
     * @ORM\Column(name="body",type="string",length=100,nullable=true)
     */
    private $body;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSidebar()
    {
        return $this->sidebar;
    }

    /**
     * @param mixed $sidebar
     */
    public function setSidebar($sidebar)
    {
        $this->sidebar = $sidebar;
    }

    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param mixed $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
}
