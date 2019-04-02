<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/21/19
 * Time: 10:51 PM.
 */

namespace App\Shared\Repository;

use Doctrine\ORM\EntityManager;
use App\Shared\Services\Utils\EntityName;
use Symfony\Component\DependencyInjection\Container;

class RepositorySkRoleManager
{
    private $_entity_manager;
    private $_container;

    public function __construct(EntityManager $_entity_manager, Container $_container)
    {
        $this->_entity_manager = $_entity_manager;
        $this->_container = $_container;
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
        return $this->_entity_manager->getRepository(EntityName::TZE_USER_ROLE);
    }

    /**
     * Récuperer tout les rôles.
     *
     * @return array
     */
    public function getAllSkRole()
    {
        return $this->getRepository()->findBy(array(), array('id' => 'ASC'));
    }

    /**
     * @param $_id
     *
     * @return object|null
     */
    public function getSkRoleById($_id)
    {
        return $this->getRepository()->find($_id);
    }

    /**
     * @param $_role
     * @param $_action
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveSkRole($_role, $_action)
    {
        if ('new' == $_action) {
            $this->_entity_manager->persist($_role);
        }
        $this->_entity_manager->flush();

        return true;
    }

    /**
     * @param $_role
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteSkRole($_role)
    {
        $this->_entity_manager->remove($_role);
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
    public function deleteGroupSkRole($_ids)
    {
        if (count($_ids)) {
            foreach ($_ids as $_id) {
                $_role = $this->getSkRoleById($_id);
                $this->deleteSkRole($_role);
            }
        }

        return true;
    }
}
