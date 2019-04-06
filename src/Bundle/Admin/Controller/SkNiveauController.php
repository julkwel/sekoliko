<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 2:02 AM.
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkClasse;
use App\Shared\Entity\SkNiveau;
use App\Shared\Form\SkClasseType;
use App\Shared\Form\SkNiveauType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkNiveauController extends Controller
{
    /**
     * @return \App\Shared\Repository\SkEntityManager|object
     */
    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @throws \Exception
     */
    public function indexAction()
    {
        $niveau_list = $this->getEntityService()->getAllListByEts(SkNiveau::class);

        return $this->render('AdminBundle:SkNiveau:index.html.twig', array(
            'niveaux' => $niveau_list,
        ));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
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
        $_niveau = new SkNiveau();
        $_form = $this->createForm(SkNiveauType::class, $_niveau);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_add_class = $request->request->get('classe');

            try {
                $this->getEntityService()->saveEntity($_niveau, 'new');

                if ('on' === $_add_class) {
                    return $this->redirect($this->generateUrl('niveau_add_class', array('id' => $_niveau->getId())));
                }

                $this->getEntityService()->setFlash('success', 'Ajout de niveau effectué');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuiller réessayez ultérieurement');
                $exception->getMessage();
            }

            return $this->redirectToRoute('niveau_index');
        }

        return $this->render('AdminBundle:SkNiveau:add.html.twig', array(
            'niveau' => $_niveau,
            'form' => $_form->createView(),
        ));
    }

    /**
     * @param Request  $request
     * @param SkNiveau $skNiveau
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function updateAction(Request $request, SkNiveau $skNiveau)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_form = $this->createForm(SkNiveauType::class, $skNiveau);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isSubmitted()) {
            try {
                $this->getEntityService()->saveEntity($skNiveau, 'new');
                $this->getEntityService()->setFlash('success', 'Niveau mis à jour');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuiller réessayez ultérieurement');
                $exception->getMessage();
            }

            return $this->redirectToRoute('niveau_index');
        }

        return $this->render('AdminBundle:SkNiveau:edit.html.twig', array(
            'niveau' => $skNiveau,
            'form' => $_form->createView(),
        ));
    }

    /**
     * @param SkNiveau $skNiveau
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkNiveau $skNiveau)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_del_niveau = $this->getEntityService()->deleteEntity($skNiveau, '');
        if (true === $_del_niveau) {
            $this->getEntityService()->setFlash('success', 'Suppression de niveau effectué');

            return $this->redirectToRoute('niveau_index');
        }
        $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuiller réessayez ultérieurement');
    }

    /**
     * @param Request  $_request
     * @param SkNiveau $skNiveau
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteGroupeAction(Request $_request, SkNiveau $skNiveau)
    {
        // Récupérer manager
        $_entity_service = $this->getEntityService();

        if (null !== $_request->request->get('_group_delete')) {
            $_ids = $_request->request->get('delete');
            if (null === $_ids) {
                $_entity_service->setFlash('error', 'Veuillez sélectionner un élément à supprimer');

                return $this->redirect($this->generateUrl('niveau_index'));
            }
            $_entity_service->deleteEntityGroup($skNiveau, $_ids);
        }

        $_entity_service->setFlash('success', 'Eléments sélectionnés supprimés');

        return $this->redirect($this->generateUrl('niveau_index'));
    }

    /**
     * Other fonction.
     */

    /**
     * @param Request  $request
     * @param SkNiveau $skNiveau
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function addClassForNiveauAction(Request $request, SkNiveau $skNiveau)
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

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_classe->setEtsNom($_user_ets);
            $_classe->setNiveau($skNiveau);

            $this->getEntityService()->saveEntity($_classe, 'new');
            $this->getEntityService()->setFlash('success', 'Niveau et classe ajoutée avec succès');

            return $this->redirectToRoute('niveau_index');
        }

        return $this->render('@Admin/SkNiveau/class.html.twig', array(
            'form' => $_form->createView(),
            'niveau' => $skNiveau,
        ));
    }

    /**
     * @param SkNiveau $skNiveau
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllNiveauClassAction(SkNiveau $skNiveau)
    {
        $_list_class = $this->getDoctrine()->getRepository(SkClasse::class)->findBy(array('niveau' => $skNiveau));

        return $this->render('@Admin/SkNiveau/list.html.twig', array(
            'class_list' => $_list_class,
            'niveau' => $skNiveau,
        ));
    }
}
