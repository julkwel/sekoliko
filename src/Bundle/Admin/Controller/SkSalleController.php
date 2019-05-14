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
        foreach ($_salle_list as $salle) {
            if ($salle->getFinReserve() < new \DateTime()) {
                $this->annuleAction($salle);
            }
        }

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
        $_salle = new SkSalle();
        $_form = $this->createForm(SkSalleType::class, $_salle);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_verif = $_salle->getSalleNom();

            $_salle_exist = $this->getDoctrine()->getRepository(SkSalle::class)->findBy(array(
                'salleNom' => $_verif,
                'etsNom' => $this->getUser()->getEtsNom(),
                'asName' => $this->getUserConnected()->getAsName(),
            ));

            if ($_salle_exist) {
                $this->getEntityService()->setFlash('error', 'ce salle existe déjà! ');

                return $this->redirectToRoute('salle_new');
            }
            $this->getEntityService()->saveEntity($_salle, 'new');
            try {
                $this->getEntityService()->setFlash('success', 'Ajout du salle effectuée');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuiller réessayez ultérieurement');
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
                    $this->getEntityService()->setFlash('success', 'Salle mis à jour');
                } catch (\Exception $exception) {
                    $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuiller réessayez ultérieurement');
                    $exception->getMessage();
                }
            }

            return $this->redirectToRoute('salle_index');
        }

        return $this->render('AdminBundle:SkSalle:add.html.twig', array(
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
                $this->getEntityService()->setFlash('success', 'Suppression du salle effectuée');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuiller réessayez ultérieurement');
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
     *
     * @throws \Exception
     */
    public function reservationAction(Request $request, SkSalle $skSalle)
    {
        if (true === $skSalle->getisReserve()) {
            try {
                $this->getEntityService()->setFlash('error', 'Ce salle est déja réservé');
            } catch (\Exception $e) {
            }

            return $this->redirectToRoute('salle_index');
        } else {
            $_form = $this->createForm(SkSalleType::class, $skSalle);
            $_form->handleRequest($request);

            if ($_form->isSubmitted() && $_form->isValid()) {
                try {
                    $debut_reservation = $request->request->get('debut');
                    $fin_reservation = $request->request->get('fin');
                    $motif_reservation = $request->request->get('motif');
                    $_nombre = $request->request->get('nombre');

                    if ($_nombre > $skSalle->getNombrePlace()) {
                        $this->getEntityService()->setFlash('error', 'Ce salle ne supporte pas les nombres des personnes');

                        return $this->redirect($this->generateUrl('salle_reservation', array(
                            'id' => $skSalle->getId(),
                        )));
                    } elseif (new \DateTime($debut_reservation) > new \DateTime($fin_reservation)) {
                        $this->getEntityService()->setFlash('error', 'Date debut > Date Fin');

                        return $this->redirect($this->generateUrl('salle_reservation', array(
                            'id' => $skSalle->getId(),
                        )));
                    }

                    $skSalle->setIsReserve(true);
                    $skSalle->setDebReserve(new \DateTime($debut_reservation));
                    $skSalle->setFinReserve(new \DateTime($fin_reservation));
                    $skSalle->setMotifs($motif_reservation);

                    $this->getEntityService()->saveEntity($skSalle, 'update');
                    $this->getEntityService()->setFlash('success', 'reservation ajouté');

                    return $this->redirectToRoute('salle_index');
                } catch (\Exception $exception) {
                    $this->getEntityService()->setFlash('error', 'Une erreur se produite');
                }
            }
        }

        return $this->render('@Admin/SkSalle/reservation.html.twig', array(
            'form' => $_form->createView(),
            'salle' => $skSalle,
        ));
    }

    public function detailsReservationAction(SkSalle $skSalle)
    {
        return $this->render('@Admin/SkSalle/details.reservation.html.twig', [
            'reservation' => $skSalle,
        ]);
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
