<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 2:01 AM.
 */

namespace App\Bundle\Admin\Controller;

use App\Bundle\User\Entity\User;
use App\Bundle\User\Form\UserType;
use App\Shared\Entity\SkClasse;
use App\Shared\Entity\SkEtudiant;
use App\Shared\Entity\SkMatiere;
use App\Shared\Entity\SkNiveau;
use App\Shared\Entity\SkRole;
use App\Shared\Form\SkClasseType;
use App\Shared\Form\SkEtudiantType;
use App\Shared\Form\SkMatiereType;
use App\Shared\Services\Utils\RoleName;
use App\Shared\Services\Utils\ServiceName;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;

class SkClassController extends Controller
{
    /**
     * @return \App\Shared\Repository\SkEntityManager|object
     */
    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @return mixed
     */
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function indexAction()
    {
        $_class_list = $this->getEntityService()->getAllListByEts(SkClasse::class);

        return $this->render('AdminBundle:SkClasse:index.html.twig', array(
            'class_list' => $_class_list,
        ));
    }

    /**
     * @param Request $request
     *
     * @return bool|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_classe = new SkClasse();
        $_form = $this->createForm(SkClasseType::class, $_classe);
        $_form->handleRequest($request);

        $_user_ets = $this->container->get('security.token_storage')->getToken()->getUser()->getEtsNom();
        $_niveau_list = $this->getDoctrine()->getRepository(SkNiveau::class)->findBy(array('etsNom' => $_user_ets));

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_niveau = $request->get('niveau');

            $_new_niveau = $this->getDoctrine()->getRepository(SkNiveau::class)->find($_niveau);
            $_classe->setNiveau($_new_niveau);

            $this->getEntityService()->saveEntity($_classe, 'new');
            $this->getEntityService()->setFlash('success', 'Classe ajoutée avec succès');

            return $this->redirectToRoute('classe_index');
        }

        return $this->render('AdminBundle:SkClasse:add.html.twig', array(
            'classe' => $_classe,
            'form' => $_form->createView(),
            'niveau' => $_niveau_list,
        ));
    }

    /**
     * @param Request  $request
     * @param SkClasse $skClasse
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function updateAction(Request $request, SkClasse $skClasse)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_form = $this->createForm(SkClasseType::class, $skClasse);
        $_form->handleRequest($request);

        $_user_ets = $this->container->get('security.token_storage')->getToken()->getUser()->getEtsNom();
        $_niveau_list = $this->getDoctrine()->getRepository(SkNiveau::class)->findBy(array('etsNom' => $_user_ets));

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_niveau = $request->get('niveau');
            $_new_niveau = $this->getDoctrine()->getRepository(SkNiveau::class)->find($_niveau);
            $skClasse->setNiveau($_new_niveau);
            $this->getEntityService()->saveEntity($skClasse, 'update');
            $this->getEntityService()->setFlash('success', 'Mise à jour du classe efféctuée');

            return $this->redirectToRoute('classe_index');
        }

        return $this->render('AdminBundle:SkClasse:edit.html.twig', array(
            'classe' => $skClasse,
            'form' => $_form->createView(),
            'niveau' => $_niveau_list,
        ));
    }

    /**
     * @param SkClasse $skClasse
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkClasse $skClasse)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_del_classe = $this->getEntityService()->deleteEntity($skClasse, '');
        if (true === $_del_classe) {
            $this->getEntityService()->setFlash('success', 'Classe supprimée avec succès');

            return $this->redirectToRoute('classe_index');
        }
        $this->getEntityService()->setFlash('error', "Une erreur s'est produite, veuillez réessayer ultérieurement");
    }

    /**
     * @param SkClasse $skClasse
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getListeEtudiantAction(SkClasse $skClasse)
    {
        $_etudiant_liste = $this->getDoctrine()->getRepository(SkEtudiant::class)->findBy(array(
            'classe' => $skClasse,
        ));

        return $this->render('@Admin/SkClasse/etudiant.html.twig', array(
            'etudiant_liste' => $_etudiant_liste,
            'classe' => $skClasse,
        ));
    }

    /**
     * @param SkClasse $skClasse
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMatiereAction(SkClasse $skClasse)
    {
        $_matiere_liste = $this->getDoctrine()->getRepository(SkMatiere::class)->findBy(array('matClasse' => $skClasse));

        return $this->render('@Admin/SkClasse/class.mat.html.twig', array(
            'liste_matiere' => $_matiere_liste,
            'classe' => $skClasse,
        ));
    }

    /**
     * @param Request  $_request
     * @param SkClasse $skClasse
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteGroupeAction(Request $_request, SkClasse $skClasse)
    {
        // Récupérer manager
        $_entity_service = $this->getEntityService();

        if (null !== $_request->request->get('_group_delete')) {
            $_ids = $_request->request->get('delete');
            if (null === $_ids) {
                $_entity_service->setFlash('error', 'Veuillez sélectionner un élément à supprimer');

                return $this->redirect($this->generateUrl('classe_index'));
            }
            $_entity_service->deleteEntityGroup($skClasse, $_ids);
        }

        $_entity_service->setFlash('success', 'Eléments sélectionnés supprimés');

        return $this->redirect($this->generateUrl('classe_index'));
    }

    /**
     * @return User[]|SkClasse[]|SkEtudiant[]|SkMatiere[]|SkNiveau[]|array
     */
    public function getProfs()
    {
        $_user_ets = $this->getUserConnected()->getEtsNom();

        $_array_type = array(
            'skRole' => array(
                RoleName::ID_ROLE_PROFS,
            ),
            'etsNom' => array(
                $_user_ets,
            ),
        );

        return $this->getDoctrine()->getRepository(User::class)->findBy($_array_type, array('id' => 'DESC'));
    }

    /**
     * @param Request  $request
     * @param SkClasse $skClasse
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function addMatiereAction(Request $request, SkClasse $skClasse)
    {
        $_matiere = new SkMatiere();
        $_prof_list = $this->getProfs();
        $_form = $this->createForm(SkMatiereType::class, $_matiere);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_prof = $request->request->get('prof');

            if (!($_prof)) {
                $this->getEntityService()->setFlash('error', 'Veuillez sélectionner un prof');

                return $this->redirectToRoute('classe_add_matiere', array('id' => $skClasse->getId()));
            }

            $_prof = $this->getDoctrine()->getRepository(User::class)->find($_prof);

            $_matiere->setMatProf($_prof);
            $_matiere->setMatClasse($skClasse);

            $_save_data = $this->getEntityService()->saveEntity($_matiere, 'new');
            if (true === $_save_data) {
                $this->getEntityService()->setFlash('success', 'Ajout matiere pour'.$skClasse->getClasseNom().'a réussi');

                return $this->redirect($this->generateUrl('classe_matiere_liste', array('id' => $skClasse->getId())));
            }

            return $this->redirectToRoute('classe_add_matiere', array('id' => $skClasse->getId()));
        }

        return $this->render('@Admin/SkClasse/add.mat.html.twig', array(
            'form' => $_form->createView(),
            'classe' => $skClasse,
            'prof' => $_prof_list,
        ));
    }

    /**
     * @param SkClasse  $skClasse
     * @param SkMatiere $skMatiere
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     * @ParamConverter("skClasse", options={"id" = "id_class"})
     * @ParamConverter("skMatiere", options={"id" = "id_mat"})
     */
    public function deleteClassMatiereAction(SkClasse $skClasse, SkMatiere $skMatiere)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_del_matiere = $this->getEntityService()->deleteEntity($skMatiere, '');

        if (true === $_del_matiere) {
            $this->getEntityService()->setFlash('success', 'Suppression du matière effectuée');

            return $this->redirectToRoute('classe_matiere_liste', array('id' => $skClasse->getId()));
        } else {
            $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuiller réessayez ultérieurement');
        }
    }

    /**
     * @param SkClasse $skClasse
     * @param User     $user
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @ParamConverter("skClasse", options={"id" = "id_class"})
     * @ParamConverter("user", options={"id" = "id_user"})
     *
     * @throws \Exception
     */
    public function deleteEtudiantAction(SkClasse $skClasse, User $user)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $_user_service = $this->get(ServiceName::SRV_METIER_USER);
            $_delete_etudiant = $_user_service->deleteUser($user);
            if (true === $_delete_etudiant) {
                $this->getEntityService()->setFlash('success', 'Suppression étudiant effectuée');

                return $this->redirectToRoute('etudiant_liste', array('id' => $skClasse->getId()));
            }
        }

        return $this->redirectToRoute('fos_user_security_logout');
    }

    /**
     * @param Request  $request
     * @param SkClasse $skClasse
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * DONT TOUCH IF YOU DONT WANT TO DIE
     *
     * @throws \Exception
     */
    public function createEtudianAction(Request $request, SkClasse $skClasse)
    {
        $_form_upload = $this->createFormBuilder()->add('file', FileType::class)->getForm();

        $_form_upload->handleRequest($request);
        if ($_form_upload->isSubmitted() && $_form_upload->isValid()) {
            $_file = $_form_upload['file']->getData();
            $the_big_array = [];
            if (false !== ($h = fopen("{$_file}", 'r'))) {
                while (false !== ($data = fgetcsv($h, 1000, ','))) {
                    $the_big_array[] = $data;
                }

                array_shift($the_big_array);
                foreach ($the_big_array as $value) {
                    $_etudiant_data = new User();
                    $_etudiant = new SkEtudiant();

                    $_user_role = RoleName::ROLE_ETUDIANT;
                    $_role = $this->getDoctrine()->getRepository(SkRole::class)->find(2);
                    $_pass = $_etudiant_data->setPlainPassword('123456');
                    $_etudiant_data->setRoles(array($_user_role));
                    $_etudiant_data->setskRole($_role);
                    $_etudiant_data->setUsrLastname($value[0] ? $value[0] : 'Null');
                    $_etudiant_data->setEnabled(true);
                    $_etudiant_data->setUsrFirstname($value[1] ? $value[1] : 'Null');
                    $_etudiant_data->setEmail($value[2] ? $value[2] : 'Null');
                    $_etudiant_data->setUsername($value[3]);
                    $_etudiant_data->setUsrAddress($value[4] ? $value[4] : 'Null');
                    $_etudiant_data->setUsrPhone($value[5] ? $value[5] : 'Null');
                    $_etudiant_data->setPassword($_pass);

                    $_etudiant->setClasse($skClasse);
                    $_etudiant->setClasse($skClasse);
                    $_etudiant->setEtudiant($_etudiant_data);
                    $_etudiant->setIsRenvoie(false);

                    for ($a = 0; $a < count($the_big_array); ++$a) {
                        try {
                            $this->getEntityService()->saveEntity($_etudiant_data, 'new');
                        } catch (\Exception $exception) {
                            $exception->getMessage();

                            return $this->redirect($this->generateUrl('classe_etudiant_new', array('id' => $skClasse->getId())));
                        }
                        try {
                            $this->getEntityService()->saveEntity($_etudiant, 'new');
                        } catch (\Exception $exception) {
                            $exception->getMessage();
                            $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuiller réessayez ultérieurement'.$exception->getMessage());
                        }
                    }
                }
                $this->getEntityService()->setFlash('success', 'Ajout de l\'étudiant(e) dans la classe '.$skClasse->getClasseNom().' effectuée');

                return $this->redirect($this->generateUrl('etudiant_liste', array('id' => $skClasse->getId())));
            }
        } else {
            $_user = new User();
            $_etudiant = new SkEtudiant();
            $_user_role = RoleName::ROLE_ETUDIANT;

            $_form = $this->createForm(UserType::class, $_user);
            $_form_etd = $this->createForm(SkEtudiantType::class);
            $_role = $this->getDoctrine()->getRepository(SkRole::class)->find(2);


            if ($request->isMethod('POST')) {
                try {
                    $_form->handleRequest($request);
                    $_form_etd->handleRequest($request);
                    if ($_form->isSubmitted()) {
                        try {
                            $_pass = $_user->setPlainPassword('123456');
                            $_user->setPassword($_pass);
                            $_user->setskRole($_role);
                            $_user->setRoles(array($_user_role));
                            $_user->setEnabled(1);

                            $_etudiant->setClasse($skClasse);
                            $_etudiant->setClasse($skClasse);
                            $_etudiant->setEtudiant($_user);
                            $_etudiant->setIsRenvoie(false);

                            try {
                                $this->getEntityService()->saveEntity($_user, 'new');
                            } catch (\Exception $exception) {
                                $this->getEntityService()->setFlash('error', 'Email ou nom d\'utilisateur déjà prise'.$exception->getMessage());

                                return $this->redirect($this->generateUrl('classe_etudiant_new', array('id' => $skClasse->getId())));
                            }
                            try {
                                $this->getEntityService()->saveEntity($_etudiant, 'new');
                            } catch (\Exception $exception) {
                                $this->getEntityService()->setFlash('error', 'error'.$exception->getMessage());

                                return $this->redirect($this->generateUrl('classe_etudiant_new', array('id' => $skClasse->getId())));
                            }
                        } catch (\Exception $exception) {
                            $exception->getMessage();
                        }

                        $this->getEntityService()->setFlash('success', 'Ajout de l\'étudiant(e) dans la classe '.$skClasse->getClasseNom().' effectuée');

                        return $this->redirect($this->generateUrl('etudiant_liste', array('id' => $skClasse->getId())));
                    }
                } catch (\Exception $exception) {
                    $exception->getMessage();
                }
            }
        }

        return $this->render('@Admin/SkClasse/add.etudiant.html.twig', array(
            'form1' => $_form->createView(),
            'form2' => $_form_etd->createView(),
            'classe' => $skClasse,
            'form_upload' => $_form_upload->createView(),
        ));
    }
}
