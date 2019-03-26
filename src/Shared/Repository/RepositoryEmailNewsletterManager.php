<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/21/19
 * Time: 10:51 PM.
 */

namespace App\Shared\Repository;

use App\Shared\Entity\SkEmailNewsletter;
use Doctrine\ORM\EntityManager;
use App\Shared\Services\Utils\EntityName;
use Symfony\Component\DependencyInjection\Container;

class RepositoryEmailNewsletterManager
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
        return $this->_entity_manager->getRepository(EntityName::TZE_EMAIL_NEWSLETTER);
    }

    /**
     * Récuperer tout les emails newsletter.
     *
     * @return array
     */
    public function getAllEmailNewsletter()
    {
        return $this->getRepository()->findBy(
            array(),
            array('id' => 'DESC')
        );
    }

    /**
     * Récuperer un email newsletter par identifiant.
     *
     * @param int $_id
     *
     * @return array
     */
    public function getEmailNewsletterById($_id)
    {
        return $this->getRepository()->find($_id);
    }

    /**
     * @param $_email_newsletter
     * @param $_action
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveEmailNewsletter($_email_newsletter, $_action)
    {
        if ('new' == $_action) {
            $this->_entity_manager->persist($_email_newsletter);
        }
        $this->_entity_manager->flush();

        return true;
    }

    /**
     * @param $_email_newsletter
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteEmailNewsletter($_email_newsletter)
    {
        $this->_entity_manager->remove($_email_newsletter);
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
    public function deleteGroupEmailNewsletter($_ids)
    {
        if (count($_ids)) {
            foreach ($_ids as $_id) {
                $_email_newsletter = $this->getEmailNewsletterById($_id);
                $this->deleteEmailNewsletter($_email_newsletter);
            }
        }

        return true;
    }

    /**
     * @param $_email
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function insertFrontEmailNewsLetter($_email)
    {
        $_email_newsletter = $this->getRepository()->findBy(array(
            'nwsEmail' => $_email,
        ));
        if (!empty($_email_newsletter)) {
            return false;
        }
        $_email_newsletter = new SkEmailNewsletter();
        $_email_newsletter->setNwsEmail($_email);

        $this->saveEmailNewsletter($_email_newsletter, 'new');

        return true;
    }

    /**
     * @param SkEmailNewsletter $_email_newsletter
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function unsubscriberById(SkEmailNewsletter $_email_newsletter)
    {
        $_email_newsletter->setNwsSubscribed(0);

        return $this->saveEmailNewsletter($_email_newsletter, 'update');
    }
}
