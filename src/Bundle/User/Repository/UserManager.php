<?php

namespace App\Bundle\User\Repository;

use App\Bundle\User\Entity\User;
use Doctrine\ORM\EntityManager;
use App\Shared\Services\Utils\EntityName;
use App\Shared\Services\Utils\ServiceName;
use App\Shared\Services\Utils\RoleName;
use Symfony\Component\DependencyInjection\Container;

class UserManager
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
        return $this->_entity_manager->getRepository(EntityName::USER);
    }

    /**
     * @return mixed
     *
     * @throws \Exception
     */
    public function getAllUser()
    {
        // Récupérer l'utilisateur connecté
        $_user_connected = $this->_container->get('security.token_storage')->getToken()->getUser();
        $_id_user = $_user_connected->getId();
        $_user_role = $_user_connected->getSkRole()->getId();

        // Rôle superadmin
        $_array_type = array(
            'skRole' => array(
                RoleName::ID_ROLE_SUPERADMIN,
                RoleName::ID_ROLE_ADMIN,
                RoleName::ID_ROLE_ETUDIANT,
            ),
        );

        // Rôle admin
        if (RoleName::ID_ROLE_ADMIN == $_user_role) {
            $_array_type = array(
                'skRole' => array(
                    RoleName::ID_ROLE_ADMIN,
                    RoleName::ID_ROLE_ETUDIANT,
                ),
            );
        }

        return $this->getRepository()->findBy($_array_type, array('id' => 'DESC'));
    }

    /**
     * @param $_nom
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getUserByNom($_nom)
    {
        $_user_ets = $this->_container->get('security.token_storage')->getToken()->getUser()->getEtsNom();

        $_array_params = array(
            'usrFirstname' => $_nom,
            'etsNom' => $_user_ets,
        );

        return $this->getRepository()->findBy($_array_params, array('id' => 'DESC'));
    }

    /**
     * @return array
     *
     * @throws \Exception
     */
    public function getUserByEts()
    {
        $_user_ets = $this->_container->get('security.token_storage')->getToken()->getUser()->getEtsNom();

        return $this->getRepository()->findBy(array('etsNom' => $_user_ets), array('id' => 'DESC'));
    }

    /**
     * Récuperer tout les utilisateurs par ordre.
     *
     * @param array $_order
     *
     * @return array
     */
    public function getAllUserByOrder($_order)
    {
        return $this->getRepository()->findBy(array(), $_order);
    }

    /**
     * @param $_id
     *
     * @return object|null
     */
    public function getUserById($_id)
    {
        return $this->getRepository()->find($_id);
    }

    /**
     * Tester l'existence username.
     *
     * @param string $_username
     *
     * @return bool
     */
    public function isUsernameExist($_username)
    {
        $_exist = $this->getRepository()->findByUsername($_username);
        if ($_exist) {
            return true;
        }

        return false;
    }

    /**
     * Tester l'existence email.
     *
     * @param string $_email
     *
     * @return bool
     */
    public function isEmailExist($_email)
    {
        $_exist = $this->getRepository()->findByEmail($_email);
        if ($_exist) {
            return true;
        }

        return false;
    }

    /**
     * @param $_user
     * @param $_form
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addUser($_user, $_form)
    {
        // Activer par défaut
        $_user->setEnabled(1);

        // Traitement rôle utilisateur
        $_type = $_form['skRole']->getData();
        $_user_role = RoleName::$ROLE_TYPE[$_type->getRlName()];
        $_user->setRoles(array($_user_role));

        // Traitement du photo
        $_img_photo = $_form['imgUrl']->getData();
        if ($_img_photo) {
            $_user_upload_manager = $this->_container->get(ServiceName::SRV_METIER_USER_UPLOAD);
            $_user_upload_manager->upload($_user, $_img_photo);
        }

        $this->saveUser($_user, 'new');
    }

    /**
     * @param $_user
     * @param $_form
     *
     * @throws \Exception
     */
    public function updateUser($_user, $_form)
    {
        // Traitement photo
        $_img_photo = $_form['imgUrl']->getData();
        // S'il y a un nouveau fichier ajouté, on supprime l'ancien fichier puis on enregistre ce nouveau
        if ($_img_photo) {
            $_user_upload_manager = $this->_container->get(ServiceName::SRV_METIER_USER_UPLOAD);
            $_user_upload_manager->deleteOnlyImageById($_user->getId());
            $_user_upload_manager->upload($_user, $_img_photo);
        }

        // Traitement rôle utilisateur
        $_type = $_form['skRole']->getData();
        $_user_role = RoleName::$ROLE_TYPE[$_type->getRlName()];
        $_user->setRoles(array($_user_role));

        $_user->setUsrDateUpdate(new \DateTime());

        // Mise à jour mot de passe
        $_fos_user_manager = $this->_container->get('fos_user.user_manager');
        $_fos_user_manager->updatePassword($_user);

        $this->saveUser($_user, 'update');
    }

    /**
     * @param $_user
     * @param $_action
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveUser($_user, $_action)
    {
        if ('new' == $_action) {
            $this->_entity_manager->persist($_user);
        }
        $this->_entity_manager->flush();

        return $_user;
    }

    /**
     * @param $_user
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteUser($_user)
    {
        $this->_entity_manager->remove($_user);
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
     * @throws \Exception
     */
    public function deleteGroupUser($_ids)
    {
        $_user_upload_manager = $this->_container->get(ServiceName::SRV_METIER_USER_UPLOAD);

        if (count($_ids)) {
            foreach ($_ids as $_id) {
                // Suppression fichier image
                $_user_upload_manager->deleteImageById($_id);

                // Suppression utilisateur
                $_user = $this->getUserById($_id);
                $this->deleteUser($_user);
            }
        }

        return true;
    }

    /**
     * @param $_email
     *
     * @return bool
     */
    public function getUserByEmail($_email)
    {
        $_user = $this->getRepository()->findByEmail($_email);

        if ($_user) {
            return $_user[0];
        }

        return false;
    }

    /**
     * @param $_email
     *
     * @return bool
     */
    public function isUserNotClient($_email)
    {
        $_user = $this->getRepository()->findByEmail($_email);

        $_is_user_admin = false;
        if ($_user) {
            $_id_role = $_user[0]->getSkRole()->getId();
            if (RoleName::ID_ROLE_MEMBER != $_id_role) {
                $_is_user_admin = true;
            }
        }

        return $_is_user_admin;
    }

    /**
     * @param $_user_email
     *
     * @return bool
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig\Error\Error
     */
    public function resettingPassword($_user_email)
    {
        // Récupérer l'utilisateur
        $_entity_user = $this->getRepository()->findBy(array('email' => $_user_email));

        if (0 == count($_entity_user)) {
            return false;
        }

        // Générer un mot de passe
        $_generated_password = $this->generatePassword(9);
        $_entity_user[0]->setPlainPassword($_generated_password);

        // Mise à jour mot de passe
        $_user_manager = $this->_container->get('fos_user.user_manager');
        $_user_manager->updatePassword($_entity_user[0]);

        $this->saveUser($_entity_user, 'update');

        // Envoyer un email contenant le lien validation compte
        $this->sendEmailUserResettingPassword(
            array(
                'username' => $_user_email,
                'password' => $_generated_password,
            ),
            $_user_email,
            $_entity_user[0]
        );

        return true;
    }

    /**
     * @param array $_data
     * @param $_mail_to
     * @param null $_user
     *
     * @return bool
     *
     * @throws \Twig\Error\Error
     * @throws \Exception
     */
    public function sendEmailUserResettingPassword(array $_data, $_mail_to, $_user = null)
    {
        $_template = 'UserBundle:Email:email_resetting_password.html.twig';
        $_email_body = $this->_container->get('templating')->renderResponse($_template, array(
            'data' => $_data,
            'user' => $_user,
        ));

        $_from_email_address = $this->_container->getParameter('from_email_address');
        $_from_firstname = $this->_container->getParameter('from_firstname');

        $_email_body = implode("\n", array_slice(explode("\n", $_email_body), 4));
        $_message = (new \Swift_Message('Skvent: Récupération mot de passe oublié'))
            ->setFrom(array($_from_email_address => $_from_firstname))
            ->setTo($_mail_to)
            ->setBody($_email_body);

        $_message->setContentType('text/html');
        $_result = $this->_container->get('mailer')->send($_message);

        $_headers = $_message->getHeaders();
        $_headers->addIdHeader('Message-ID', uniqid().'@domain.com');
        $_headers->addTextHeader('MIME-Version', '1.0');
        $_headers->addTextHeader('X-Mailer', 'PHP v'.phpversion());
        $_headers->addParameterizedHeader('Content-type', 'text/html', ['charset' => 'utf-8']);

        if ($_result) {
            return true;
        }

        return false;
    }

    /**
     * Génération mot de passe.
     *
     * @param int $_length
     *
     * @return string
     */
    public function generatePassword($_length)
    {
        $_caracter = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789');
        $_special_caracter = str_split('!/\@#$^&*()?');

        shuffle($_caracter);
        shuffle($_special_caracter);

        $_rand = '';
        $_merged_caracter = array();
        foreach (array_rand($_caracter, ($_length - 1)) as $_k) {
            $_merged_caracter[] = $_caracter[$_k];
        }
        $_merged_caracter[] = $_special_caracter[array_rand($_special_caracter, 1)];
        shuffle($_merged_caracter);
        foreach (array_rand($_merged_caracter, $_length) as $_i) {
            $_rand .= $_merged_caracter[$_i];
        }

        return $_rand;
    }

    /**
     * @param $str
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function findEntitiesByString($str)
    {
        $_user_ets = $this->_container->get('security.token_storage')->getToken()->getUser()->getEtsNom();

        return $this->_entity_manager->createQuery(
            "SELECT e FROM UserBundle:User e WHERE e.username LIKE :str AND e.etsNom='".$_user_ets."'"
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findEtsList()
    {
        return $this->getRepository()->createQueryBuilder('q')->select('DISTINCT(q.etsNom)');
    }
}
