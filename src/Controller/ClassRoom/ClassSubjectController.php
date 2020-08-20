<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\ClassRoom;

use App\Constant\MessageConstant;
use App\Controller\AbstractBaseController;
use App\Entity\ClassRoom;
use App\Entity\ClassSubject;
use App\Entity\Subject;
use App\Form\ClassSubjectType;
use App\Repository\ClassSubjectRepository;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ClassSubjectController.
 *
 * @Route("/{_locale}/admin/class/subject")
 */
class ClassSubjectController extends AbstractBaseController
{
    /**
     * @Route("/list/{id}",name="class_subject_list")
     *
     * @param ClassSubjectRepository $repository
     * @param ClassRoom              $classRoom
     *
     * @return Response
     */
    public function list(ClassSubjectRepository $repository, ClassRoom $classRoom)
    {
        return $this->render(
            'admin/content/ClassRoom/_class_subject_list.html.twig',
            [
                'subjects' => $repository->findByClass($this->getUser(), $classRoom),
                'class' => $classRoom,
            ]
        );
    }

    /**
     * @Route("/manage/{classe}/{id?}",name="class_subject_manage")
     *
     * @param Request           $request
     * @param ClassRoom         $classe
     * @param ClassSubject|null $subject
     *
     * @return Response
     */
    public function manage(Request $request, ClassRoom $classe, ClassSubject $subject = null)
    {
        $subject = $subject ?? new ClassSubject();
        $form = $this->createForm(ClassSubjectType::class, $subject, ['user' => $this->getUser()]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $subject->setClassRoom($classe);
            try {
                if ($this->em->save($subject, $this->getUser(), $form)) {
                    $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                    return $this->redirectToRoute(
                        'class_subject_list',
                        [
                            'id' => $subject->getClassRoom()->getId(),
                        ]
                    );
                }
                $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

                return $this->redirectToRoute(
                    'class_subject_manage',
                    [
                        'classe' => $classe->getId(),
                        'id' => $subject->getId() ?? null,
                    ]
                );
            } catch (Exception $exception) {
                $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

                return $this->redirectToRoute(
                    'class_subject_manage',
                    [
                        'classe' => $classe->getId(),
                        'id' => $subject->getId() ?? null,
                    ]
                );
            }
        }

        return $this->render(
            'admin/content/ClassRoom/_class_subject_manage.html.twig',
            [
                'form' => $form->createView(),
                'classe' => $classe,
            ]
        );
    }

    /**
     * @param ClassSubject $subject
     *
     * @Route("/remove/{id}",name="class_subject_remove")
     *
     * @return RedirectResponse
     */
    public function remove(ClassSubject $subject)
    {
        $classe = $subject->getClassRoom();
        $subjectTemp = $subject;
        if ($this->em->remove($subject)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);

            return $this->redirectToRoute(
                'class_subject_list',
                [
                    'id' => $subjectTemp->getClassRoom()->getId(),
                ]
            );
        }
        $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

        return $this->redirectToRoute(
            'class_subject_manage',
            [
                'classe' => $classe->getId(),
                'id' => $subjectTemp->getId() ?? null,
            ]
        );
    }
}
