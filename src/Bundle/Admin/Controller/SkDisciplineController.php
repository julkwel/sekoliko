<?php
/**
 * Created by PhpStorm.
 * User: chrys
 * Date: 28/03/19
 * Time: 07:18.
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkDiscipline;
use App\Shared\Entity\SkDisciplineList;
use App\Shared\Form\SkPunitionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Shared\Form\SkDisciplineFormType;

class SkDisciplineController extends Controller
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
        $discipline_list = $this->getEntityService()->getAllListByEts(SkDiscipline::class);

        return $this->render('@Admin/SkDiscipline/index.html.twig', array(
            'discipline_list' => $discipline_list,
        ));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_user_ets = $this->getUserConnected()->getEtsNom();

        $_discipline = new SkDiscipline();
        $_form = $this->createForm(SkDisciplineFormType::class, $_discipline);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            try {
                $_discipline->setEtsNom($_user_ets);
                $this->getEntityService()->saveEntity($_discipline, 'new');
                $this->getEntityService()->setFlash('success', 'Ajout discipline avec success');
            } catch (\Exception $exception) {
                $exception->getMessage();
            }

            return $this->redirectToRoute('discipline_index');
        }

        return $this->render('@Admin/SkDiscipline/add.html.twig', array(
            'form' => $_form->createView(),
            'discipline' => $_discipline,
        ));
    }

    /**
     * @param Request      $request
     * @param SkDiscipline $_discipline
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, SkDiscipline $_discipline)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_form = $this->createForm(SkDisciplineFormType::class, $_discipline);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            try {
                $this->getEntityService()->saveEntity($_discipline, 'update');
                $this->getEntityService()->setFlash('success', 'Discipline modifié avec succes');
            } catch (\Exception $exception) {
                $exception->getMessage();
            }

            return $this->redirectToRoute('discipline_index');
        }

        return $this->render('@Admin/SkDiscipline/edit.html.twig', array('form' => $_form->createView()));
    }

    /**
     * @param SkDiscipline $_discipline
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkDiscipline $_discipline)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_discipline_delete = $this->getEntityService()->deleteEntity($_discipline, '');
        if (true === $_discipline_delete) {
            try {
                $this->getEntityService()->setFlash('success', 'suppression discipline réussie');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'un erreur se produite');
                $exception->getMessage();
            }
        }

        return $this->redirectToRoute('discipline_index');
    }

    /**
     * @param SkDiscipline $skDiscipline
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexPunitionAction(SkDiscipline $skDiscipline)
    {
        $_user_ets = $this->getUserConnected()->getEtsNom();
        $_array_search = array(
          'etsNom' => $_user_ets,
          'discipline' => $skDiscipline,
        );
        $_punition_list = $this->getDoctrine()->getRepository(SkDisciplineList::class)->findBy($_array_search, array('id' => 'DESC'));

        return $this->render('@Admin/SkDiscipline/punition.list.html.twig', array(
            'punition_list' => $_punition_list,
            'discipline' => $skDiscipline,
        ));
    }

    /**
     * @param Request      $request
     * @param SkDiscipline $skDiscipline
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newPunitionAction(Request $request, SkDiscipline $skDiscipline)
    {
        $_user_ets = $this->getUserConnected()->getEtsNom();
        $_punition = new SkDisciplineList();
        $_form = $this->createForm(SkPunitionType::class, $_punition);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_punition->setEtsNom($_user_ets);
            $_punition->setDiscipline($skDiscipline);
            try {
                $this->getEntityService()->saveEntity($_punition, 'new');
                $this->getEntityService()->setFlash('success', 'Ajout punition avec success');
            } catch (\Exception $exception) {
                $exception->getMessage();
            }

            return $this->redirect($this->generateUrl('punition_index', array('id' => $skDiscipline->getId())));
        }

        return $this->render('@Admin/SkDiscipline/punition.add.html.twig', array(
            'form' => $_form->createView(),
            'discipline' => $skDiscipline,
            'punition' => $_punition,
        ));
    }

    /**
     * @param Request          $request
     * @param SkDisciplineList $skDisciplineList
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editPunitionAction(Request $request, SkDisciplineList $skDisciplineList)
    {
        $_form = $this->createForm(SkPunitionType::class, $skDisciplineList);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $skDisciplineList->setDiscipline($skDisciplineList->getDiscipline());
            try {
                $this->getEntityService()->saveEntity($skDisciplineList, 'update');
                $this->getEntityService()->setFlash('success', 'Ajout punition avec success');
            } catch (\Exception $exception) {
                $exception->getMessage();
            }

            return $this->redirect($this->generateUrl('punition_index', array('id' => $skDisciplineList->getDiscipline()->getId())));
        }

        return $this->render('@Admin/SkDiscipline/punition.edit.html.twig', array(
            'form' => $_form->createView(),
            'punition' => $skDisciplineList,
        ));
    }

    /**
     * @param SkDisciplineList $skDisciplineList
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deletePunitionAction(SkDisciplineList $skDisciplineList)
    {
        $_punition_delete = $this->getEntityService()->deleteEntity($skDisciplineList, '');
        try {
            if (true === $_punition_delete) {
                $this->getEntityService()->setFlash('success', 'suppression punition réussie');

                return $this->redirectToRoute('discipline_index');
            }
        } catch (\Exception $exception) {
            $exception->getMessage();
        }
    }
}
