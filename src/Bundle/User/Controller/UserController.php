<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 2/21/19
 * Time: 10:51 PM.
 */

namespace App\Bundle\User\Controller;

use App\Shared\Services\Utils\RoleName;
use App\Shared\Services\Utils\ServiceName;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Bundle\User\Entity\User;
use App\Bundle\User\Form\UserType;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @return mixed
     */
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @return mixed
     */
    public function getUserRole()
    {
        return $this->getUserConnected()->getSkRole()->getId();
    }

    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @return \App\Bundle\User\Repository\UserManager|object
     */
    public function getUserMetier()
    {
        return $this->get(ServiceName::SRV_METIER_USER);
    }

    /**
     * @return \App\Bundle\User\Repository\UploadManager|object
     */
    public function getUserUpload()
    {
        return $this->get(ServiceName::SRV_METIER_USER_UPLOAD);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function indexAction()
    {
        $_user_manager = $this->getUserMetier();
        $_user_ets = $this->container->get('security.token_storage')->getToken()->getUser()->getEtsNom();

        $_array_type = array(
            'skRole' => array(
                RoleName::ID_ROLE_ADMIN,
            ),
            'etsNom' => $_user_ets,
        );

        $_users = $this->getDoctrine()->getRepository(User::class)->findBy($_array_type, array('id' => 'DESC'));

        return $this->render('UserBundle:User:index.html.twig', array(
            'users' => $_users,
        ));
    }

    /**
     * @param User $_user
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(User $_user)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT') ||
            $this->get('security.authorization_checker')->isGranted('ROLE_PROFS')) {
            if ($this->getUserConnected()->getId() !== $_user->getId()) {
                return $this->redirectToRoute('fos_user_security_logout');
            }
        }
        $_id_user = $this->getUserConnected()->getId();
        $_user_role = $this->getUserRole();

        if (!$_user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }
        if ((RoleName::ID_ROLE_ADMIN !== $_user_role) && (RoleName::ID_ROLE_SUPERADMIN !== $_user_role)) {
            if ($_user->getId() !== $_id_user) {
                return $this->redirectToRoute('user_edit', array(
                    'id' => $_id_user,
                ));
            }
        }

        $_esk_form = $this->createEditForm($_user);

        $_template = 'UserBundle:User:edit.html.twig';
        if (RoleName::ID_ROLE_ETUDIANT === $_user_role) {
            $_template = 'UserBundle:User:edit_member.html.twig';
        }

        return $this->render($_template, array(
            'user' => $_user,
            'esk_form' => $_esk_form->createView(),
        ));
    }

    /**
     * @param Request $_request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function newAction(Request $_request)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('fos_user_security_logout');
        }

        $_user_manager = $this->getUserMetier();

        $_user = new User();
        $_form = $this->createCreateForm($_user);
        $_form->handleRequest($_request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_user_ets = $this->getUserConnected()->getEtsNom();

            if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPERADMIN')) {
                $_ets_nom = $_request->request->get('etsNom');
                $_ann_deb = $_request->request->get('annDebut');
                $_ann_fin = $_request->request->get('annFin');

                $_user->setAnneScolaireDebut(new \DateTime($_ann_deb));
                $_user->setAnneScolaireFin(new \DateTime($_ann_fin));
                $_user->setEtsNom($_ets_nom);
            } else {
                try {
                    $_ann_scolaire_debut = $this->getUserConnected()->getAnneScolaireDebut();
                    $_ann_scolaire_fin = $this->getUserConnected()->getAnneScolaireFin();
                } finally {
                    if ($_ann_scolaire_debut || $_ann_scolaire_fin || $_user_ets) {
                        if ($_ann_scolaire_debut) {
                            $_user->setAnneScolaireDebut($_ann_scolaire_debut);
                        }
                        if ($_ann_scolaire_fin) {
                            $_user->setAnneScolaireFin($_ann_scolaire_fin);
                        }
                        if ($_user_ets) {
                            $_user->setEtsNom($_user_ets);
                        }
                    }
                }
            }
            $_user_manager->addUser($_user, $_form);
            $_user_manager->setFlash('success', 'Utilisateur ajouté');

            if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPERADMIN')) {
                return $this->redirect($this->generateUrl('dashboard_index'));
            }

            return $this->redirect($this->generateUrl('user_index'));
        }

        return $this->render('UserBundle:User:add.html.twig', array(
            'user' => $_user,
            'form' => $_form->createView(),
        ));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function newUserEtsAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPERADMIN')) {
            $_srv_entity = $this->get('sk.repository.entity');
            $_user = new User();
            $_form = $this->createCreateForm($_user);
            $_form->handleRequest($request);

            if ($_form->isSubmitted() && $_form->isValid()) {
                $_ann_deb = $request->request->get('annDebut');
                $_ann_fin = $request->request->get('annFin');

                $_user->setAnneScolaireDebut(new \DateTime($_ann_deb));
                $_user->setAnneScolaireFin(new \DateTime($_ann_fin));
                $_ets_nom = $request->request->get('etsNom');
                $_user->setEtsNom($_ets_nom);
                $_srv_entity->saveEntity($_user, 'new');
                $_srv_entity->setFlash('success', 'Utilisateur et établissement ajouté');

                return $this->redirectToRoute('dashboard_index');
            }

            return $this->render('UserBundle:User:add.html.twig', array(
                'user' => $_user,
                'form' => $_form->createView(),
            ));
        }
    }

    /**
     * @param Request $_request
     * @param User $_user
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function updateAction(Request $_request, User $_user)
    {
        $_user_role = $this->getUserRole();
        $_user_manager = $this->getUserMetier();

        /*
         * Secure to etudiant and profs connected
         */
        if (
            $this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT') || $this->get('security.authorization_checker')->isGranted('ROLE_PROFS')) {
            if ($this->getUserConnected()->getId() !== $_user->getId()) {
                return $this->redirectToRoute('fos_user_security_logout');
            }
        }

        if (50 === $_user->getId() || 48 === $_user->getId() || 144 === $_user->getId()) {
            $_user_manager->setFlash('error', 'Vous n\'avez pas le droit pour modifier cette utilisateur test');

            return $this->redirectToRoute('user_index');
        }

        if (!$_user) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $_esk_form = $this->createEditForm($_user);
        $_esk_form->handleRequest($_request);

        if ($_esk_form->isValid()) {
            // Mise à jour utilisateur
            $_user_manager->updateUser($_user, $_esk_form);

            $_user_manager->setFlash('success', 'Utilisateur modifié');
            if (RoleName::ID_ROLE_ETUDIANT === $_user_role) {
                return $this->redirectToRoute('dashboard_index');
            }

            return $this->redirect($this->generateUrl('user_index'));
        }

        return $this->render('UserBundle:User:edit.html.twig', array(
            'user' => $_user,
            'esk_form' => $_esk_form->createView(),
        ));
    }

    /**
     * @param User $_user
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createCreateForm(User $_user)
    {
        $_user_role = $this->getUserRole();

        $_form = $this->createForm(UserType::class, $_user, array(
            'action' => $this->generateUrl('user_new'),
            'method' => 'POST',
            'user_role' => $_user_role,
        ));

        return $_form;
    }

    /**
     * @param User $_user
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createEditForm(User $_user)
    {
        $_user_role = $this->getUserRole();

        $_form = $this->createForm(UserType::class, $_user, array(
            'action' => $this->generateUrl('user_update', array('id' => $_user->getId())),
            'method' => 'PUT',
            'user_role' => $_user_role,
        ));

        return $_form;
    }

    /**
     * @param Request $_request
     * @param User $_user
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Exception
     */
    public function deleteAction(Request $_request, User $_user)
    {
        /*
         * Secure to etudiant and profs connected
         */
        if (
            $this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT') ||
            $this->get('security.authorization_checker')->isGranted('ROLE_PROFS')
        ) {
            if ($this->getUserConnected()->getId() !== $_user->getId()) {
                return $this->redirectToRoute('sk_login');
            }
        }

        // Récupérer manager
        $_user_manager = $this->getUserMetier();
        if (50 === $_user->getId() || 48 === $_user->getId() || 144 === $_user->getId()) {
            $_user_manager->setFlash('error', 'Vous n\'avez pas le droit pour supprimer cette utilisateur');

            return $this->redirectToRoute('user_index');
        }
        $_form = $this->createDeleteForm($_user);
        $_form->handleRequest($_request);

        if ($_request->isMethod('GET') || ($_form->isSubmitted() && $_form->isValid())) {
            // Suppression utilisateur
            $_user_manager->deleteUser($_user);
            $_user_manager->setFlash('success', 'Utilisateur supprimé');
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * @param User $_user
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(User $_user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $_user->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Ajax suppression fichier image utilisateur.
     *
     * @param Request $_request
     *
     * @return JsonResponse
     */
    public function deleteImageAjaxAction(Request $_request)
    {
        // Récupérer manager
        $_user_upload_manager = $this->getUserUpload();

        // Récuperation identifiant fichier
        $_data = $_request->request->all();
        $_id = $_data['id'];

        // Suppression fichier image
        $_response = $_user_upload_manager->deleteImageById($_id);

        return new JsonResponse($_response);
    }

    /**
     * @param Request $_request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Exception
     */
    public function deleteGroupAction(Request $_request)
    {
        // Récupérer manager
        $_user_manager = $this->getUserMetier();

        if (null !== $_request->request->get('_group_delete')) {
            $_ids = $_request->request->get('delete');
            if (null === $_ids) {
                $_user_manager->setFlash('error', 'Veuillez sélectionner un élément à supprimer');

                return $this->redirect($this->generateUrl('user_index'));
            }
            $_user_manager->deleteGroupUser($_ids);
        }

        $_user_manager->setFlash('success', 'Eléments sélectionnés supprimés');

        return $this->redirect($this->generateUrl('user_index'));
    }

    /**
     * @param Request $_request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function resettingPasswordAction(Request $_request)
    {
        // Récupérer manager
        $_user_manager = $this->getUserMetier();

        if ($_request->isMethod('POST')) {
            // Récuperer les données formulaire
            $_post = $_request->request->all();
            $_user_email = $_post['user-email'];

            $_resetting_password = $_user_manager->resettingPassword($_user_email);

            $_status = 'success';
            $_message = 'Récupération mot de passe a été envoyée au mail';
            if (!$_resetting_password) {
                $_status = 'error';
                $_message = 'Utilisateur non identifié';
            }

            $_user_manager->setFlash($_status, $_message);

            return $this->redirect($this->generateUrl('sk_resetting_password'));
        }

        return $this->render('UserBundle:Security:resetting_password.html.twig');
    }
}
