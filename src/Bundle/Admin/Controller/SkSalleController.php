<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 12:07 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkSalle;
use App\Shared\Form\SkSalleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkSalleController extends Controller
{
    /**
     * @return \App\Shared\Repository\SkEntityManager|object
     */
    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

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
        $_salle_list = $this->getEntityService()->getAllListByEts(SkSalle::class);

        return $this->render('AdminBundle:SkSalle:index.html.twig', array(
            'salle_list' => $_salle_list,
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
    public function newAction(Request $request)
    {
        $_user_connected = $this->getUserConnected()->getEtsNom();

        $_salle = new SkSalle();
        $_form = $this->createForm(SkSalleType::class, $_salle);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_salle->setEtsNom($_user_connected);
            $this->getEntityService()->saveEntity($_salle, 'new');
            try {
                $this->getEntityService()->setFlash('success', 'salle ajouter avec success');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'Un erreur se produite');
                $exception->getMessage();
            }

            return $this->redirectToRoute('salle_index');
        }

        return $this->render('AdminBundle:SkSalle:add.html.twig', array(
            'form' => $_form->createView(),
            'salle' => $_salle,
        ));
    }

    /**
     * @param Request $request
     * @param SkSalle $salle
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function updateAction(Request $request, SkSalle $salle)
    {
        $_form = $this->createForm(SkSalleType::class, $salle);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_add_salle = $this->getEntityService()->saveEntity($salle, 'update');
            if (true === $_add_salle) {
                try {
                    $this->getEntityService()->setFlash('success', 'modification salle avec success');
                } catch (\Exception $exception) {
                    $this->getEntityService()->setFlash('success', 'modification salle avec success');
                    $exception->getMessage();
                }
            }

            return $this->redirectToRoute('salle_index');
        }

        return $this->render('AdminBundle:SkSalle:edit.html.twig', array(
            'form' => $_form->createView(),
            'salle' => $salle,
        ));
    }

    /**
     * @param SkSalle $skSalle
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkSalle $skSalle)
    {
        $_delete_salle = $this->getEntityService()->deleteEntity($skSalle, '');
        if (true === $_delete_salle) {
            try {
                $this->getEntityService()->setFlash('success', 'suppression salle réussie');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'un erreur se produite');
                $exception->getMessage();
            }

            return $this->redirectToRoute('salle_index');
        }
    }

    /**
     * @param Request $request
     * @param SkSalle $skSalle
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function reservationAction(Request $request, SkSalle $skSalle)
    {
        if (true === $skSalle->getisReserve()) {
            try {
                $this->getEntityService()->setFlash('error', 'Ce salle et déja réservé');
            } catch (\Exception $e) {
            }

            return $this->redirectToRoute('salle_index');
        } else {
            $_form = $this->createForm(SkSalleType::class, $skSalle);
            $_form->handleRequest($request);

            if ($_form->isSubmitted() && $_form->isValid()) {
                $debut_reservation = $request->request->get('debut');
                $fin_reservation = $request->request->get('fin');
                $motif_reservation = $request->request->get('motif');
                if (new \DateTime($debut_reservation) > new \DateTime($fin_reservation)) {
                    $this->getEntityService()->setFlash('error', 'Date debut > Date Fin');
                    return $this->redirect($this->generateUrl('salle_reservation', array(
                        'id'=>$skSalle->getId()
                    )));
                }
                $skSalle->setIsReserve(true);
                $skSalle->setDebReserve(new \DateTime($debut_reservation));
                $skSalle->setFinReserve(new \DateTime($fin_reservation));
                $skSalle->setMotifs($motif_reservation);
                try {
                    $this->getEntityService()->saveEntity($skSalle, 'update');
                    $this->getEntityService()->setFlash('success', 'reservation ajouté');
                } catch (\Exception $exception) {
                    $exception->getMessage();
                }

                return $this->redirectToRoute('salle_index');
            }
        }

        return $this->render('@Admin/SkSalle/reservation.html.twig', array(
            'form' => $_form->createView(),
            'salle' => $skSalle,
        ));
    }

    /**
     * @param SkSalle $skSalle
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function annuleAction(SkSalle $skSalle)
    {
        try {
            $skSalle->setIsReserve(false);
            $skSalle->setMotifs(null);
            $this->getEntityService()->saveEntity($skSalle, 'update');
        } catch (\Exception $exception) {
            $exception->getMessage();
        }

        return $this->redirectToRoute('salle_index');
    }
}
