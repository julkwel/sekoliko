<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/29/19
 * Time: 10:31 AM.
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkBook;
use App\Shared\Form\SkBookType;
use App\Shared\Services\Utils\ServiceName;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkBookController extends Controller
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
     * @throws \Exception
     */
    public function indexAction()
    {
        $_book_list = $this->getEntityService()->getAllListByEts(SkBook::class);

        return $this->render('AdminBundle:SkBook:index.html.twig', array(
            '_book_list' => $_book_list,
        ));
    }

    public function newAction(Request $request)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_book = new SkBook();
        $_form = $this->createForm(SkBookType::class, $_book);
        $_ets_nom = $this->getUserConnected()->getEtsNom();
        $_form->handleRequest($request);
        if ($_form->isSubmitted() && $_form->isValid()) {
            try {
                $_book->setEtsNom($_ets_nom);
                $this->getEntityService()->saveEntity($_book, 'new');
                $this->getEntityService()->setFlash('success', 'Ajout livre avec succes');
            } catch (\Exception $exception) {
                try {
                    $this->getEntityService()->setFlash('error', 'Un erreur se produite'.$exception->getMessage());
                } catch (\Exception $e) {
                }
            }

            return $this->redirectToRoute('book_index');
        }

        return $this->render('AdminBundle:SkBook:add.html.twig', array(
            'form' => $_form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @param SkBook  $skBook
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, SkBook $skBook)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_form = $this->createForm(SkBookType::class, $skBook);
        $_form->handleRequest($request);
        if ($_form->isSubmitted() && $_form->isValid()) {
            try {
                $this->getEntityService()->saveEntity($skBook, 'update');
                $this->getEntityService()->setFlash('success', 'Ajout livre avec succes');
            } catch (\Exception $exception) {
                try {
                    $this->getEntityService()->setFlash('error', 'Un erreur se produite'.$exception->getMessage());
                } catch (\Exception $e) {
                }
            }

            return $this->redirectToRoute('book_index');
        }

        return $this->render('AdminBundle:SkBook:edit.html.twig', array(
            'form' => $_form->createView(),
            'book' => $skBook,
        ));
    }

    /**
     * @param SkBook $skBook
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkBook $skBook)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_delete_book = $this->getEntityService()->deleteEntity($skBook, '');
        if (true === $_delete_book) {
            $this->getEntityService()->setFlash('success', 'Ajout livre avec succes');
        } else {
            try {
                $this->getEntityService()->deleteEntity($skBook, '');
            } catch (\Exception $e) {
                $this->getEntityService()->setFlash('error', $e->getMessage());
            }
        }

        return $this->redirectToRoute('book_index');
    }

    /**
     * @param Request $request
     * @param SkBook  $skBook
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function reservationAction(Request $request, SkBook $skBook)
    {
        if (true === $skBook->getisReserved()) {
            $this->getEntityService()->setFlash('error', 'Ce livre et déjà réservée');

            return $this->redirectToRoute('book_index');
        } else {
            $_form = $this->createForm(SkBookType::class, $skBook);
            $_user_manager = $this->get(ServiceName::SRV_METIER_USER);
            $_form->handleRequest($request);
            $_date_debut = $request->request->get('debut');
            $_date_fin = $request->request->get('fin');
            $_user = $request->request->get('user');

            if ($_form->isSubmitted() && $_form->isValid()) {
                if (new \DateTime($_date_debut) > new \DateTime($_date_fin)) {
                    $this->getEntityService()->setFlash('error', 'Date debut > Date Fin');
                    return $this->redirect($this->generateUrl('book_reservation', array('id'=>$skBook->getId())));
                }
                $skBook->setIsReserved(true);
                $_user_s = $_user_manager->getUserById($_user);
                $skBook->setUser($_user_s);
                $skBook->setDateDebut(new \DateTime($_date_debut));
                $skBook->setDateFin(new \DateTime($_date_fin));
                try {
                    $this->getEntityService()->saveEntity($skBook, 'update');
                    $this->getEntityService()->setFlash('success', 'reservation ajouté avec success');
                } catch (\Exception $exception) {
                    $this->getEntityService()->setFlash('error', 'un erreur se produite'.$exception->getMessage());
                }

                return $this->redirectToRoute('book_index');
            }
        }

        return $this->render('AdminBundle:SkBook:reservation.html.twig', array(
            'book' => $skBook,
            'form' => $_form->createView(),
        ));
    }

    /**
     * @param SkBook $skBook
     *                       Details de réservations
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function findReservationAction(SkBook $skBook)
    {
        return $this->render('AdminBundle:SkBook:details.reservation.html.twig', array(
            'book' => $skBook,
        ));
    }

    /**
     * @param SkBook $skBook
     *                       Supprimer la réservation
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteReservationAction(SkBook $skBook)
    {
        if (true === $skBook->getisReserved()) {
            try {
                $skBook->setIsReserved(false);
                $this->getEntityService()->saveEntity($skBook, 'update');
            } catch (\Exception $exception) {
                try {
                    $this->getEntityService()->setFlash('error', 'un erreur se produite'.$exception->getMessage());
                } catch (\Exception $e) {
                }
            }

            return $this->redirectToRoute('book_index');
        } else {
            try {
                $this->getEntityService()->setFlash('error', 'Book is already reserved');
            } catch (\Exception $e) {
                $e->getMessage();
            }
        }

        return $this->redirectToRoute('book_index');
    }
}
