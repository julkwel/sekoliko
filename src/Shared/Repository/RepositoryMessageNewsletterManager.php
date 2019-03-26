<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/21/19
 * Time: 10:51 PM.
 */

namespace App\Shared\Repository;

use App\Shared\Entity\SkMessageNewsletter;
use Doctrine\ORM\EntityManager;
use App\Shared\Services\Utils\EntityName;
use Symfony\Component\DependencyInjection\Container;

class RepositoryMessageNewsletterManager
{
    private $_entity_manager;
    private $_container;

    public function __construct(EntityManager $_entity_manager, Container $_container)
    {
        $this->_entity_manager = $_entity_manager;
        $this->_container = $_container;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->_entity_manager;
    }

    /**
     * @param $_type
     * @param $_message
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function setFlash($_type, $_message)
    {
        return $this->_container->get('session')->getFlashBag()->add($_type, $_message);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return $this->_entity_manager->getRepository(EntityName::TZE_MESSAGE_NEWSLETTER);
    }

    /**
     * Récuperer tout les messages newsletter.
     *
     * @return array
     */
    public function getAllMessageNewsletter()
    {
        return $this->getRepository()->findBy(
            array(),
            array('id' => 'DESC')
        );
    }

    /**
     * Récuperer un message newsletter par identifiant.
     *
     * @param int $_id
     *
     * @return array
     */
    public function getMessageNewsletterById($_id)
    {
        return $this->getRepository()->find($_id);
    }

    /**
     * @param $_message_newsletter
     * @param $_action
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveMessageNewsletter($_message_newsletter, $_action)
    {
        if ('new' == $_action) {
            $this->_entity_manager->persist($_message_newsletter);
        }
        $this->_entity_manager->flush();

        return true;
    }

    /**
     * @param $_message_newsletter
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteMessageNewsletter($_message_newsletter)
    {
        $this->_entity_manager->remove($_message_newsletter);
        $this->_entity_manager->flush();

        return true;
    }

    /**
     * @param $_ids
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteGroupMessageNewsletter($_ids)
    {
        if (count($_ids)) {
            foreach ($_ids as $_id) {
                $_message_newsletter = $this->getMessageNewsletterById($_id);
                $this->deleteMessageNewsletter($_message_newsletter);
            }
        }

        return true;
    }

    /**
     * @param $_message
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertFrontMessageNewsletter($_message)
    {
        $_message_newsletter = $this->getRepository()->findBy(array(
            'nwsmessage' => $_message,
        ));

        if (!empty($_message_newsletter)) {
            return false;
        }

        $_message_newsletter = new SkMessageNewsletter();
        $_message_newsletter->setNwsmessage($_message);

        $this->saveMessageNewsletter($_message_newsletter, 'new');

        return true;
    }

    public function sendEmailNewsletter($_request, $_emails)
    {
        $_post = $_request->request->all();
        $_subject = $_post['sk_service_metiermanagerbundle_message_newsletter']['translations']['fr']['messageNewsletterTitle'];
        $_content = $_post['sk_service_metiermanagerbundle_message_newsletter']['translations']['fr']['messageNewsletterContent'];

        $_template = 'AdminBundle:SkMessageNewsletter:email.html.twig';

        $_from_email_address = $this->_container->getParameter('from_email_address');
        $_from_firstname = $this->_container->getParameter('from_firstname');

        foreach ($_emails as $_email) {
            if (true === $_email->isNwsSubscribed()) {
                $_to_email_address = $_email->getNwsEmail();

                $_email_body = $this->_container->get('templating')->renderResponse($_template, array(
                    'content' => $_content,
                ));

                $_email_body = implode("\n", array_slice(explode("\n", $_email_body), 4));
                $_message = (new \Swift_Message('TzEvent | '.$_subject))
                    ->setFrom(array($_from_email_address => $_from_firstname))
                    ->setTo($_to_email_address)
                    ->setBody($_email_body);

                $_message->setContentType('text/html');
                $this->_container->get('mailer')->send($_message);

                $_headers = $_message->getHeaders();
                $_headers->addIdHeader('Message-ID', uniqid().'@domain.com');
                $_headers->addTextHeader('MIME-Version', '1.0');
                $_headers->addTextHeader('X-Mailer', 'PHP v'.phpversion());
                $_headers->addParameterizedHeader('Content-type', 'text/html', ['charset' => 'utf-8']);
            }
        }

        return true;
    }
}
