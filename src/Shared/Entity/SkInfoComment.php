<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 5/2/19
 * Time: 12:08 AM
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class SkInfoComment
 * @package App\Shared\Entity
 * @ORM\Table(name="sk_info_comment")
 * @ORM\Entity
 */
class SkInfoComment
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
     * @var
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkInformation", cascade={"persist", "remove"},inversedBy="comment")
     * @ORM\JoinColumn(name="comment_id",referencedColumnName="id")
     */
    private $info;

    /**
     * @var
     * @ORM\Column(type="text",nullable=false)
     */
    private $comment;

    /**
     * @var
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="App\Bundle\User\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    private $user;

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
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param mixed $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}