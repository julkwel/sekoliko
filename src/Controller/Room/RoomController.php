<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\Room;

use App\Constant\MessageConstant;
use App\Controller\AbstractBaseController;
use App\Entity\Reservation;
use App\Entity\Room;
use App\Form\ReservationType;
use App\Form\RoomType;
use App\Repository\RoomRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RoomController.
 *
 * @Route("/{_locale}/admin/room")
 */
class RoomController extends AbstractBaseController
{
    /**
     * @Route("/list",name="room_list")
     *
     * @param RoomRepository $repository
     *
     * @return Response
     */
    public function list(RoomRepository $repository)
    {
        return $this->render(
            'admin/content/Room/_room_list.html.twig',
            [
                'rooms' => $repository->findBySchoolYear($this->getUser(), false),
            ]
        );
    }

    /**
     * @Route("/list/reservation/{id}",name="room_reservations_list")
     *
     * @param Room $room
     *
     * @return Response
     */
    public function resList(Room $room)
    {
        $list = $this->manager->getRepository(Reservation::class)->findBy(['room' => $room]);

        return $this->render(
            'admin/content/Room/room_reservation_list.html.twig',
            [
                'reservations' => $list,
                'room' => $room,
            ]
        );
    }

    /**
     * @param Reservation $reservation
     *
     * @Route("/reservation/valid/{id}",name="reservation_room_valid")
     *
     * @return RedirectResponse
     */
    public function validation(Reservation $reservation)
    {
        $reservation->setIsValid(true);
        $this->manager->flush();

        return $this->redirectToRoute('room_reservations_list', ['id' => $reservation->getRoom()->getId()]);
    }

    /**
     * @param Reservation $reservation
     *
     * @Route("/reservation/end/{id}",name="reservation_room_end")
     *
     * @return RedirectResponse
     */
    public function endReservation(Reservation $reservation)
    {
        $reservation->getRoom()->setIsReserved(false);
        $reservation->setIsFin(true);
        $this->manager->flush();

        return $this->redirectToRoute('room_reservations_list', ['id' => $reservation->getRoom()->getId()]);
    }

    /**
     * @Route("/manage/{id?}",name="room_manage")
     *
     * @param Request   $request
     * @param Room|null $room
     *
     * @return Response
     */
    public function manage(Request $request, Room $room = null)
    {
        $room = $room ?? new Room();
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->em->save($room, $this->getUser())) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('room_list');
            }

            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute('room_manage', ['id' => $room->getId() ?? null]);
        }

        return $this->render(
            'admin/content/Room/_room_manage.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/reservation/{id}/room/{res?}",name="room_reservation")
     *
     * @param Request $request
     * @param Room    $id
     *
     * @return Response
     */
    public function reservation(Request $request, Room $id)
    {
        $reservation = $res ?? new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setRoom($id);
            $reservation->addReservator($this->getUser());
            $id->setIsReserved(true);

            if ($this->em->save($reservation, $this->getUser())) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('room_reservations_list', ['id' => $id->getId()]);
            }

            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute(
                'room_reservation',
                ['id' => $id->getId(), 'res' => $reservation->getId() ?? null]
            );
        }

        return $this->render(
            'admin/content/Room/_room_reservation.html.twig',
            [
                'form' => $form->createView(),
                'room' => $id,
            ]
        );
    }

    /**
     * @Route("/reservation/update/{id}",name="room_reservation_update")
     *
     * @param Request     $request
     * @param Reservation $reservation
     *
     * @return Response
     */
    public function reservationUpdate(Request $request, Reservation $reservation)
    {
        $reservations = $reservation;
        $form = $this->createForm(ReservationType::class, $reservations);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->em->save($reservations, $this->getUser())) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('room_reservations_list', ['id' => $reservation->getRoom()->getId()]);
            }

            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute(
                'room_reservation',
                ['id' => $reservation->getRoom()->getId()]
            );
        }

        return $this->render('admin/content/Room/_room_reservation.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/remove/{id}",name="remove_room")
     *
     * @param Room $room
     *
     * @return RedirectResponse
     */
    public function remove(Room $room)
    {
        if ($this->em->remove($room)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);
        } else {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::ERROR_MESSAGE);
        }

        return $this->redirectToRoute('room_list');
    }
}
