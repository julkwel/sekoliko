<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\Student;

use App\Constant\MessageConstant;
use App\Constant\RoleConstant;
use App\Controller\AbstractBaseController;
use App\Entity\ClassRoom;
use App\Entity\Student;
use App\Form\StudentType;
use App\Helper\HistoryHelper;
use App\Manager\SekolikoEntityManager;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class StudentController.
 *
 * @Route("/admin/student")
 */
class StudentController extends AbstractBaseController
{
    /**
     * @var StudentRepository
     */
    private $repository;

    /**
     * @var HistoryHelper
     */
    private $historyHelper;

    /**
     * StudentController constructor.
     *
     * @param EntityManagerInterface       $manager
     * @param SekolikoEntityManager        $entityManager
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param StudentRepository            $repository
     */
    public function __construct(EntityManagerInterface $manager, SekolikoEntityManager $entityManager, UserPasswordEncoderInterface $passwordEncoder, StudentRepository $repository, HistoryHelper $historyHelper)
    {
        parent::__construct($manager, $entityManager, $passwordEncoder);
        $this->repository = $repository;
        $this->historyHelper = $historyHelper;
    }

    /**
     * @Route("/list/{id}",name="student_list",methods={"GET","POST"})
     *
     * @param ClassRoom $class
     *
     * @return Response
     */
    public function list(ClassRoom $class)
    {
        $studentList = $this->repository->findByClassSchoolYearField($this->getUser(), $class);

        return $this->render('admin/content/student/_student_list.html.twig', ['students' => $studentList, 'classe' => $class]);
    }

    /**
     * @Route("/manage/{classe}/{id?}",name="student_manage",methods={"GET","POST"})
     *
     * @param Request      $request
     * @param ClassRoom    $classe
     * @param Student|null $student
     *
     * @return Response
     */
    public function manage(Request $request, ClassRoom $classe, Student $student = null)
    {
        $student = $student ?? new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->beforeStudentPersist($classe, $student, $form);
            if ($this->em->save($student, $this->getUser(), $form)) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('student_list', ['id' => $classe->getId()]);
            }
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute('student_manage', ['classe' => $classe->getId(), 'id' => $student->getId()]);
        }

        return $this->render('admin/content/student/_student_manage.html.twig', ['form' => $form->createView(), 'classe' => $classe]);
    }

    /**
     * @param ClassRoom     $classe
     * @param Student       $student
     * @param FormInterface $form
     *
     * @return Student
     */
    public function beforeStudentPersist(ClassRoom $classe, Student $student, FormInterface $form): Student
    {
        $student->setClasse($classe);
        $student->getUser()->setPassword($this->passencoder->encodePassword($student->getUser(), $form->get('user')->get('password')->getData()));
        $student->getUser()->setRoles([RoleConstant::ROLE_SEKOLIKO['Etudiant']]);
        if (!$student->getId()) {
            $this->historyHelper->addHistory('Ajout ' . $student->getUser()->getUsername() . ' dans la classe ' . $classe->getName(), $student->getUser());
        }

        return $student;
    }

    /**
     * @Route("/remove/{id}",name="student_remove")
     *
     * @param Student $student
     *
     * @return RedirectResponse
     */
    public function remove(Student $student)
    {
        $classe = $student->getClasse()->getId();
        if ($this->em->remove($student)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);

            return $this->redirectToRoute('student_list', ['id' => $classe]);
        }
        $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

        return $this->redirectToRoute('student_list', ['id' => $classe]);
    }
}
