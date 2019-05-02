<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/29/19
 * Time: 9:47 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Bundle\User\Entity\User;
use App\Shared\Entity\SkConge;
use App\Shared\Form\SkCongeType;
use App\Shared\Services\Utils\RoleName;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkCongeController extends Controller
{
    /**
     * @return object|string
     */
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @return \App\Shared\Repository\SkEntityManager|object
     */
    public function getEntityManager()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function indexAction()
    {
        $_user_connected = $this->getUserConnected()->getEtsNom();
        $_user_asName = $this->getUserConnected()->getAsName();

        $this->setCongeFin();

        $_conge_list = $this->getDoctrine()->getRepository(SkConge::class)->findBy([
            'etsNom' => $_user_connected,
            'asName' => $_user_asName,
            'isFin' => false,
        ]);

        return $this->render('AdminBundle:SkConge:index.html.twig', ['congelist' => $_conge_list]);
    }

    /**
     * @param $type
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function findAction($type)
    {
        $_user_connected = $this->getUserConnected()->getEtsNom();
        $_user_asName = $this->getUserConnected()->getAsName();

        $_conge_list = $this->getDoctrine()->getRepository(SkConge::class)->findBy([
            'etsNom' => $_user_connected,
            'asName' => $_user_asName,
            'type' => $type,
        ]);

        return $this->render('AdminBundle:SkConge:index.html.twig', ['congelist' => $_conge_list]);
    }

    /**
     * @return bool
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function setCongeFin()
    {
        $_user_conge = $this->getDoctrine()->getRepository(SkConge::class)->findBy(['isFin' => false]);

        foreach ($_user_conge as $_user) {
            if ($_user->getDateFin() < new \DateTime('now')) {
                $_user->setIsFin(true);
                $_user->getUser()->setIsConge(false);
                $_user_en_conge = $this->getDoctrine()->getRepository(User::class)->find($_user->getUser()->getId());
                $_user_en_conge->setIsConge(false);

                $this->getEntityManager()->saveEntity($_user, 'update');
                $this->getEntityManager()->saveEntity($_user_en_conge, 'update');
            }
        }

        return true;
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
    public function newAction(Request $request)
    {
        $conge = new SkConge();
        $form = $this->createForm(SkCongeType::class, $conge);

        $_list_admin = $this->getDoctrine()->getRepository(User::class)->findBy([
            'skRole' => [RoleName::ID_ROLE_PROFS, RoleName::ID_ROLE_ADMIN],
            'etsNom' => $this->getUserConnected()->getEtsNom(),
            'asName' => $this->getUserConnected()->getAsName(),
        ]);

        $_date_deb = $request->request->get('debut');
        $_date_fin = $request->request->get('fin');
        $_user = $request->request->get('user');

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $_user = $this->getDoctrine()->getRepository(User::class)->find($_user);
            if (true === $_user->getIsConge()) {
                $this->getEntityManager()->setFlash('error', 'Ce personne et déjà en congé');

                return $this->redirectToRoute('conge_new');
            }
            if ($_date_deb > $_date_fin) {
                $this->getEntityManager()->setFlash('error', 'Vérifier la date');

                return $this->redirectToRoute('conge_new');
            } elseif (null === $_user) {
                $this->getEntityManager()->setFlash('error', 'L\utilisateur n\'existe pas');

                return $this->redirectToRoute('conge_new');
            }
            $_user->setIsConge(true);
            $conge->setDateDeb(new \DateTime($_date_deb));
            $conge->setDateFin(new \DateTime($_date_fin));
            $conge->setUser($_user);

            try {
                $this->getEntityManager()->saveEntity($_user, 'update');
                $this->getEntityManager()->saveEntity($conge, 'new');

                $this->getEntityManager()->setFlash('success', 'Conge ajouté pour '.$conge->getUser()->getUserName());
            } catch (\Exception $exception) {
                $this->getEntityManager()->setFlash('error', 'Une erreur se produite '.$exception->getMessage());
            } finally {
                return $this->redirectToRoute('conge_list');
            }
        }

        return $this->render('AdminBundle:SkConge:add.html.twig', [
            'form' => $form->createView(),
            'user' => $_list_admin,
        ]);
    }

    /**
     * @param Request $request
     * @param SkConge $skConge
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function editAction(Request $request, SkConge $skConge)
    {
        $form = $this->createForm(SkCongeType::class, $skConge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $_date_deb = $request->request->get('debut');
            $_date_fin = $request->request->get('fin');
            if ($_date_deb > $_date_fin) {
                $this->getEntityManager()->setFlash('error', 'Vérifier la date');

                return $this->redirectToRoute('conge_new');
            } elseif (null === $skConge->getUser()) {
                $this->getEntityManager()->setFlash('error', 'L\'utilisateur n\'existe pas');

                return $this->redirect($this->generateUrl('conge_edit', ['id' => $skConge->getId()]));
            }

            $this->getEntityManager()->saveEntity($skConge, 'update');
            $this->getEntityManager()->setFlash('success', 'modification conge réussie');

            return $this->redirectToRoute('conge_list');
        }

        return $this->render('AdminBundle:SkConge:edit.html.twig', ['form' => $form->createView(), 'conge' => $skConge]);
    }

    /**
     * @param SkConge $skConge
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Exception
     */
    public function deleteAction(SkConge $skConge)
    {
        try {
            $skConge->getUser()->setIsConge(false);
            $user = $skConge->getUser();
            if (true === $this->getEntityManager()->deleteEntity($skConge, '')) {
                $user->setIsConge(false);
                $this->getEntityManager()->saveEntity($user, 'update');
                $this->getEntityManager()->setFlash('success', 'suppression congé réussie');

                return $this->redirectToRoute('conge_list');
            }
        } catch (OptimisticLockException $e) {
            $e->getMessage();
        } catch (ORMException $e) {
            $e->getMessage();
        }
    }
}
