<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/25/19
 * Time: 6:13 PM.
 */

namespace App\Shared\Repository;

use App\Shared\Entity\SkConge;
use App\Shared\Services\Utils\PathName;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\DependencyInjection\Container;

class SkEntityManager
{
    private $_entity_manager;
    private $_container;
    private $_web_root;

    /**
     * ServiceMetierSkParticipants constructor.
     *
     * @param EntityManager $_entity_manager
     * @param Container     $_container
     * @param $_root_dir
     *
     * @throws ORMException
     */
    public function __construct(EntityManager $_entity_manager, Container $_container, $_root_dir)
    {
        $this->_entity_manager = $_entity_manager;
        $this->_container = $_container;
        $this->_web_root = realpath($_root_dir.'/../public');

        $_user_conge = $_entity_manager->getRepository(SkConge::class)->findBy(['isFin' => false]);
        foreach ($_user_conge as $_user) {
            if ($_user->getDateFin() < new \DateTime('now')) {
                $_user->setIsFin(true);
                $_user->getUser()->setIsConge(false);
                try {
                    $this->saveEntity($_user, 'update');
                } catch (OptimisticLockException $e) {
                    $e->getMessage();
                }
            }
        }
    }

    /**
     * Get Month List.
     *
     * @return array
     */
    public function getMonthList()
    {
        $_month = [];
        for ($m = 1; $m <= 12; ++$m) {
            array_push($_month, date('F', mktime(0, 0, 0, $m, 1)));
        }

        return $_month;
    }

    /**
     * @param $_entity_name
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public function getRepository($_entity_name)
    {
        return $this->_entity_manager->getRepository($_entity_name);
    }

    /**
     * @param $_entity_name
     *
     * @return array
     */
    public function getAllList($_entity_name)
    {
        return $this->getRepository($_entity_name)->findBy(array(), array('id' => 'DESC'));
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
     * @return mixed
     *
     * @throws \Exception
     */
    public function getUserConnected()
    {
        return $this->_container->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @param $_entity_name
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getAllListByEts($_entity_name)
    {
        $_user_ets = $this->getUserConnected()->getEtsNom();
        $_as_nom = $this->getUserConnected()->getAsName();
        $_array_find = [];

        if (is_callable($_entity_name, 'getEtsNom')) {
            $_array_find['etsNom'] = $_user_ets;
        }
        if (is_callable($_entity_name, 'getAsName')) {
            $_array_find['asName'] = $_as_nom;
        }

        return $this->getRepository($_entity_name)->findBy($_array_find, array('id' => 'DESC'));
    }

    /**
     * @param $_entity_name
     *
     * @return array
     */
    public function getAllListASC($_entity_name)
    {
        return $this->getRepository($_entity_name)->findBy(array(), array('id' => 'ASC'));
    }

    /**
     * @param $_entity_name
     * @param $_id
     *
     * @return object|null
     */
    public function getEntityById($_entity_name, $_id)
    {
        return $this->getRepository($_entity_name)->find($_id);
    }

    /**
     * @param $_data
     * @param $_action
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function saveEntity($_data, $_action)
    {
        if ($this->_container->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->_container->get('router')->generate('sk_login');
        }

        if ('new' == $_action) {
            try {
                $_ann_scolaire_debut = $this->getUserConnected()->getAnneScolaireDebut();
                $_ann_scolaire_fin = $this->getUserConnected()->getAnneScolaireFin();
                $_as_name = $this->getUserConnected()->getAsName();
                $_user_ets = $this->getUserConnected()->getEtsNom();
            } finally {
                if ($_ann_scolaire_debut || $_ann_scolaire_fin || $_user_ets || $_as_name) {
                    if ($_ann_scolaire_debut) {
                        if (method_exists($_data, 'setAnneScolaireDebut')) {
                            $_data->setAnneScolaireDebut($_ann_scolaire_debut);
                        }
                    }
                    if ($_ann_scolaire_fin) {
                        if (method_exists($_data, 'setAnneScolaireFin')) {
                            $_data->setAnneScolaireFin($_ann_scolaire_fin);
                        }
                    }
                    if ($_user_ets) {
                        if (method_exists($_data, 'setEtsNom')) {
                            $_data->setEtsNom($_user_ets);
                        }
                    }
                    if ($_as_name) {
                        if (method_exists($_data, 'setAsName')) {
                            $_data->setAsName($_as_name);
                        }
                    }
                }
            }

            $this->_entity_manager->persist($_data);
        }
        $this->_entity_manager->flush();

        return true;
    }

    /**
     * @param $_data
     * @param $_image
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addEntity($_data, $_image)
    {
        if ($_image) {
            $this->deleteOnlyImage($_data);
            $this->addImage($_data, $_image);
        }

        $this->saveEntity($_data, 'new');
    }

    /**
     * @param $_data
     * @param $_image
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateEntity($_data, $_image)
    {
        // S'il y a un nouveau image ajouté, on supprime l'ancien puis on enregistre ce nouveau
        if ($_image) {
            $this->deleteOnlyImage($_data);
            $this->addImage($_data, $_image);
        }

        $this->saveEntity($_data, 'update');
    }

    /**
     * @param $_data
     * @param $_image
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteEntity($_data, $_image)
    {
        if (!'' === $_image) {
            $this->deleteImage($_data);
        }
        $this->_entity_manager->remove($_data);
        $this->_entity_manager->flush();

        return true;
    }

    /**
     * @param $_entity_name
     * @param $_ids
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteEntityGroup($_entity_name, $_ids)
    {
        if (count($_ids)) {
            foreach ($_ids as $_id) {
                $_slide = $this->getEntityById($_entity_name, $_id);
                $this->deleteEntity($_slide, '');
                $this->deleteImage($_slide);
            }
        }

        return true;
    }

    /**
     * @param $_data
     * @param $_image object
     */
    public function addImage($_data, $_image)
    {
        // Récupérer le répertoire image spécifique
        $_directory_image = PathName::UPLOAD_IMAGE;
        // Upload image
        $_file_name_image = md5(uniqid()).'.'.$_image->guessExtension();
        $_uri_file = $_directory_image.$_file_name_image;
        $_dir = $this->_web_root.$_directory_image;
        $_image->move(
            $_dir,
            $_file_name_image
        );

        $_data->setImgUrl($_uri_file);
    }

    /**
     * @param $_data
     *
     * @return bool
     */
    public function deleteOnlyImage($_data)
    {
        if ($_data) {
            $_path = $this->_web_root.$_data->getImgUrl();

            // Suppression du fichier
            @unlink($_path);

            return true;
        }
    }

    /**
     * @param $_data
     *
     * @return array
     */
    public function deleteImage($_data)
    {
        if ($_data) {
            try {
                $_path = $this->_web_root.$_data->getImgUrl();

                // Suppression du fichier
                @unlink($_path);

                // Suppression dans la base
                $this->_entity_manager->remove($_data);
                $this->_entity_manager->flush();

                return array(
                    'success' => true,
                );
            } catch (\Exception $_exc) {
                return array(
                    'success' => false,
                    'message' => $_exc->getTraceAsString(),
                );
            }
        } else {
            return array(
                'success' => false,
                'message' => 'Image not found in database',
            );
        }
    }
}
