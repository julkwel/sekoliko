<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\ClassRoom;

use App\Constant\MessageConstant;
use App\Controller\AbstractBaseController;
use App\Entity\ClassRoom;
use App\Entity\Section;
use App\Form\ClassRoomType;
use App\Repository\ClassRoomRepository;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClassRoomController.
 *
 * @Route("/{_locale}/admin/class/room")
 */
class ClassRoomController extends AbstractBaseController
{
    /**
     * @Route("/list/{id}",name="class_room_list")
     *
     * @param ClassRoomRepository $repository
     * @param Section             $section
     *
     * @return Response
     */
    public function list(ClassRoomRepository $repository, Section $section)
    {
        return $this->render(
            'admin/content/ClassRoom/_class_room_list.html.twig',
            [
                'classes' => $repository->findBySchoolName($this->getUser(), $section),
                'section' => $section,
            ]
        );
    }

    /**
     * @Route("/manage/{section}/{id?}",name="class_room_manage")
     *
     * @param Request   $request
     * @param Section   $section
     * @param ClassRoom $classRoom
     *
     * @return Response
     *
     * @throws Exception
     */
    public function manage(Request $request, Section $section, ClassRoom $classRoom = null): Response
    {
        $classRoom = $classRoom ?? new ClassRoom();

        $form = $this->createForm(ClassRoomType::class, $classRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $classRoom->setSection($section);
            $classRoom->setCreatedBy($this->getUser());

            if ($this->em->save($classRoom, $this->getUser())) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('class_room_list', ['id' => $section->getId()]);
            }
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute(
                'class_room_manage',
                [
                    'section' => $section->getId(),
                    'id' => $classRoom->getId(),
                ]
            );
        }

        return $this->render(
            'admin/content/ClassRoom/_class_room_manage.html.twig',
            [
                'form' => $form->createView(),
                'section' => $section,
            ]
        );
    }

    /**
     * @param ClassRoom $classRoom
     *
     * @Route("/remove/{id}",name="class_room_remove")
     *
     * @return RedirectResponse
     */
    public function remove(ClassRoom $classRoom)
    {
        $section = $classRoom->getSection()->getId();

        if ($this->em->remove($classRoom)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);
        } else {
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);
        }

        return $this->redirectToRoute('class_room_list', ['id' => $section]);
    }
}
