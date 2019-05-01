<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 5/1/19
 * Time: 8:09 PM
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class SkBugComment
 * @package App\Shared\Entity
 * @ORM\Entity
 * @ORM\Table(name="sk_bug_comment")
 */
class SkBugComment
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
     * @ORM\ManyToOne(targetEntity="App\Shared\Entity\SkBug", cascade={"persist", "remove"},inversedBy="comment")
     * @ORM\JoinColumn(name="comment_id",referencedColumnName="id")
     */
    private $bug;

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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getBug()
    {
        return $this->bug;
    }

    /**
     * @param mixed $bug
     */
    public function setBug($bug)
    {
        $this->bug = $bug;
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
}