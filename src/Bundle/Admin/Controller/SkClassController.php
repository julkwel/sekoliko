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
use App\Shared\Form\SkClasseType;
use App\Shared\Form\SkEtudiantType;
use App\Shared\Services\Utils\RoleName;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
            $_classe->setEtsNom($_user_ets);

            $_new_niveau = $this->getDoctrine()->getRepository(SkNiveau::class)->find($_niveau);
            $_classe->setNiveau($_new_niveau);

            $this->getEntityService()->saveEntity($_classe, 'new');
            $this->getEntityService()->setFlash('success', 'Classe ajouté avec success');

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
            $this->getEntityService()->setFlash('success', 'Classe maj avec success');

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
            $this->getEntityService()->setFlash('success', 'Classe supprimée avec success');

            return $this->redirectToRoute('classe_index');
        }
        $this->getEntityService()->setFlash('error', 'Un erreur se produite pendant la suppression niveau');
    }

    /**
     * @param Request  $request
     * @param SkClasse $skClasse
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getListeEtudiantAction(Request $request, SkClasse $skClasse)
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
     * @param Request  $request
     * @param SkClasse $skClasse
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * DONT TOUCH IF YOU DONT WANT TO DIE
     */
    public function createEtudianAction(Request $request, SkClasse $skClasse)
    {
        $_user = new User();
        $_etudiant = new SkEtudiant();
        $_user_role = RoleName::ROLE_ETUDIANT;
        $_user_ets = $this->container->get('security.token_storage')->getToken()->getUser()->getEtsNom();

        $_form = $this->createForm(UserType::class, $_user);
        $_form_etd = $this->createForm(SkEtudiantType::class);

        if ($request->isMethod('POST')) {
            try {
                $_form->handleRequest($request);
                $_form_etd->handleRequest($request);
                if ($_form->isSubmitted()) {
                    try {
                        $_user->setRoles(array($_user_role));
                        $_user->setEtsNom($_user_ets);
                        $_user->setEnabled(1);

                        $_etudiant->setClasse($skClasse);
                        $_etudiant->setEtsNom($_user_ets);
                        $_etudiant->setClasse($skClasse);
                        $_etudiant->setEtudiant($_user);

                        try {
                            $this->getEntityService()->saveEntity($_user, 'new');
                            $this->getEntityService()->setFlash('success', 'success add user');
                        } catch (\Exception $exception) {
                            $this->getEntityService()->setFlash('error', 'Utilisateur existe déjà email ou nom d\'utilisateur existe');

                            return $this->redirect($this->generateUrl('classe_etudiant_new', array('id' => $skClasse->getId())));
                        }
                        try {
                            $this->getEntityService()->saveEntity($_etudiant, 'new');
                            $this->getEntityService()->setFlash('success', 'success add etudiant');
                        } catch (\Exception $exception) {
                            $exception->getMessage();
                            $this->getEntityService()->setFlash('error', 'error'.$exception->getMessage());
                        }
                    } catch (\Exception $exception) {
                        $exception->getMessage();
                    }

                    return $this->redirect($this->generateUrl('etudiant_liste', array('id' => $skClasse->getId())));
                }
            } catch (\Exception $exception) {
                $exception->getMessage();
            }
        }

        return $this->render('@Admin/SkClasse/add.etudiant.html.twig', array(
            'form1' => $_form->createView(),
            'form2' => $_form_etd->createView(),
            'classe' => $skClasse,
        ));
    }
}
