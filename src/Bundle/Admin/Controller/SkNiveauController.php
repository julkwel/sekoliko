<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 2:02 AM.
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkNiveau;
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
            $_user_ets = $this->container->get('security.token_storage')->getToken()->getUser()->getEtsNom();
            $_niveau->setEtsNom($_user_ets);
            try {
                $this->getEntityService()->saveEntity($_niveau, 'new');
                $this->getEntityService()->setFlash('success', 'niveau ajouté avec success');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'une erreur se produite');
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
                $this->getEntityService()->setFlash('success', 'niveau ajouté avec success');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'une erreur se produite');
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
            $this->getEntityService()->setFlash('success', 'Niveau supprimée avec success');

            return $this->redirectToRoute('niveau_index');
        }
        $this->getEntityService()->setFlash('error', 'Un erreur se produite pendant la suppression niveau');
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
}
