<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/21/19
 * Time: 10:51 PM.
 */

namespace App\Shared\Repository;

use App\Shared\Entity\SkRole;
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
     * Ajouter un message flash.
     *
     * @param string $_type
     * @param string $_message
     *
     * @return mixed
     */
    public function setFlash($_type, $_message)
    {
        return $this->_container->get('session')->getFlashBag()->add($_type, $_message);
    }

    /**
     * Récuperer le repository rôle.
     *
     * @return array
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
     * Récuperer un rôle par identifiant.
     *
     * @param int $_id
     *
     * @return array
     */
    public function getSkRoleById($_id)
    {
        return $this->getRepository()->find($_id);
    }

    /**
     * Enregistrer un rôle.
     *
     * @param SkRole $_role
     * @param string  $_action
     *
     * @return bool
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
     * Supprimer un rôle.
     *
     * @param SkRole $_role
     *
     * @return bool
     */
    public function deleteSkRole($_role)
    {
        $this->_entity_manager->remove($_role);
        $this->_entity_manager->flush();

        return true;
    }

    /**
     * Suppression multiple d'un rôle.
     *
     * @param array $_ids
     *
     * @return bool
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
