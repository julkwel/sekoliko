<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/21/19
 * Time: 10:51 PM.
 */

namespace App\Shared\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * SkMessageNewsletterTranslation.
 *
 * @ORM\Table(name="sk_message_newsletter_translation")
 * @ORM\Entity
 */
class SkMessageNewsletterTranslation
{
    use ORMBehaviors\Translatable\Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="message_newsletter_title", type="string", length=255)
     */
    private $messageNewsletterTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="message_newsletter_content", type="text")
     */
    private $messageNewsletterContent;

    /**
     * @return string
     */
    public function getMessageNewsletterTitle()
    {
        return $this->messageNewsletterTitle;
    }

    /**
     * @param string $messageNewsletterTitle
     */
    public function setMessageNewsletterTitle($messageNewsletterTitle)
    {
        $this->messageNewsletterTitle = $messageNewsletterTitle;
    }

    /**
     * @return string
     */
    public function getMessageNewsletterContent()
    {
        return $this->messageNewsletterContent;
    }

    /**
     * @param string $messageNewsletterContent
     */
    public function setMessageNewsletterContent($messageNewsletterContent)
    {
        $this->messageNewsletterContent = $messageNewsletterContent;
    }
}
