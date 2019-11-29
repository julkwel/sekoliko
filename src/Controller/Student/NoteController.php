<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Controller\Student;

use App\Controller\AbstractBaseController;
use App\Entity\Session;
use App\Entity\Student;
use App\Entity\Subject;
use App\Helper\HistoryHelper;
use App\Manager\SekolikoEntityManager;
use App\Repository\StudentNoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
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
     * @Route("/{student}/{session}/{mat}",name="note_list")
     *
     * @param Student $student
     * @param Session $session
     * @param Subject $mat
     *
     * @return Response
     */
    public function listNote(Student $student, Session $session, Subject $mat)
    {
        $notes = $this->repository->findBySession($student, $session, $mat);

        return $this->render('admin/content/student/_student_note.html.twig', ['notes' => $notes]);
    }
}
