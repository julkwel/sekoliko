<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/21/19
 * Time: 10:51 PM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * SkEmailNewsletter.
 *
 * @ORM\Table(name="sk_email_newsletter")
 * @UniqueEntity(fields="nwsEmail", message="Email déjà existant")
 * @ORM\Entity
 */
class SkEmailNewsletter
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nws_email", type="string", length=45, unique=true)
     */
    private $nwsEmail;

    /**
     * @var bool
     *
     * @ORM\Column(name="nws_subscribed", type="boolean", options={"default" = 1}, nullable=true)
     */
    private $nwsSubscribed = true;

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
     * @return string
     */
    public function getNwsEmail()
    {
        return $this->nwsEmail;
    }

    /**
     * @param string $nwsEmail
     */
    public function setNwsEmail($nwsEmail)
    {
        $this->nwsEmail = $nwsEmail;
    }

    /**
     * @return bool
     */
    public function isNwsSubscribed()
    {
        return $this->nwsSubscribed;
    }

    /**
     * @param bool $nwsSubscribed
     */
    public function setNwsSubscribed($nwsSubscribed)
    {
        $this->nwsSubscribed = $nwsSubscribed;
    }
}
