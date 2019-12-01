<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Controller\Student;

use App\Constant\MessageConstant;
use App\Controller\AbstractBaseController;
use App\Entity\Session;
use App\Entity\Student;
use App\Entity\StudentNote;
use App\Form\StudentNoteType;
use App\Helper\HistoryHelper;
use App\Manager\SekolikoEntityManager;
use App\Repository\StudentNoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * This controller will manage student note ,
 * List : Student note MUST HAVE session and student in parameters
 * Manage(Edit or New) : Require student and session in parameters with id of note on edit
 *
 * @Route("/{_locale}/admin/note")
 *
 * Class NoteController
 */
class NoteController extends AbstractBaseController
{
    private $repository;

    /**
     * NoteController constructor.
     *
     * @param EntityManagerInterface       $manager
     * @param SekolikoEntityManager        $entityManager
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param HistoryHelper|null           $historyHelper
     * @param StudentNoteRepository        $repository
     */
    public function __construct(EntityManagerInterface $manager, SekolikoEntityManager $entityManager, UserPasswordEncoderInterface $passwordEncoder, HistoryHelper $historyHelper = null, StudentNoteRepository $repository)
    {
        parent::__construct($manager, $entityManager, $passwordEncoder, $historyHelper);
        $this->repository = $repository;
    }

    /**
     * @Route("/{student}/{session}",name="student_note_list")
     *
     * @param Student $student
     * @param Session $session
     *
     * @return Response
     */
    public function listNote(Student $student, Session $session)
    {
        $notes = $this->repository->findBySession($student, $session);

        return $this->render(
            'admin/content/student/_student_note.html.twig',
            [
                'notes' => $notes,
                'student' => $student,
                'session' => $session,
            ]
        );
    }

    /**
     * @Route("/manage/{student}/{session}/{id?}",name="student_note_manage")
     *
     * @param Request          $request
     * @param Student          $student
     * @param Session          $session
     * @param StudentNote|null $note
     *
     * @return Response
     */
    public function manage(Request $request, Student $student, Session $session, StudentNote $note = null)
    {
        $note = $note ?? new StudentNote();

        $form = $this->createForm(
            StudentNoteType::class,
            $note,
            [
                'user' => $this->getUser(),
                'classe' => $student->getClasse(),
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note->setSession($session);
            $note->setStudent($student);

            if ($this->em->save($note, $this->getUser(), $form)) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute(
                    'student_note_list',
                    [
                        'student' => $student->getId(),
                        'session' => $session->getId(),
                    ]
                );
            }
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute(
                'student_note_manage',
                [
                    'student' => $student->getId(),
                    'session' => $session->getId(),
                    'id' => $note->getId(),
                ]
            );
        }

        return $this->render(
            'admin/content/student/_student_note_manage.html.twig',
            [
                'form' => $form->createView(),
                'student' => $student->getId(),
                'session' => $session->getId(),
            ]
        );
    }

    /**
     * @Route("/student/remove/{id}",name="student_note_remove")
     *
     * @param StudentNote $studentNote
     *
     * @return RedirectResponse
     */
    public function remove(StudentNote $studentNote)
    {
        $session = $studentNote->getSession()->getId();
        $student = $studentNote->getStudent()->getId();

        if ($this->em->remove($studentNote)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);

            return $this->redirectToRoute('student_note_list', ['session' => $session, 'student' => $student]);
        }
        $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

        return $this->redirectToRoute('student_note_list', ['session' => $session, 'student' => $student]);
    }
}
