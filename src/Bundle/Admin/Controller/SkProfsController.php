<?php

namespace App\Bundle\Admin\Controller;

use App\Shared\Repository\SkClasseMatiereRepository;
use App\Shared\Repository\SkEtudiantRepository;
use App\Shared\Repository\SkNoteRepository;
use App\Shared\Repository\SkProfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Shared\Entity\SkClasse;
use App\Shared\Entity\SkEtudiant;
use App\Shared\Entity\SkNote;
use App\Shared\Entity\SkMatiere;
use App\Shared\Form\SkNoteType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package App\Bundle\Admin\Controller
 * @author Max
 */
class SkProfsController extends Controller
{
    /**
     * @var SkProfRepository
     */
    private $profRepository;
    /**
     * @var SkClasseMatiereRepository
     */
    private $classeMatiereRepository;
    /**
     * @var SkNoteRepository
     */
    private $noteRepository;

    public function __construct(SkProfRepository $profRepository,
                                SkClasseMatiereRepository $classeMatiereRepository,
                                SkNoteRepository $noteRepository)
    {
        $this->profRepository = $profRepository;
        $this->classeMatiereRepository = $classeMatiereRepository;
        $this->noteRepository = $noteRepository;
    }

    /**
     * Get instance of prof
     */
    private function getProfConnected()
    {
        return $this->profRepository->findOneBy(['profs' => $this->getUser()]);
    }

    /**
     * Get all class professor 
     */
    public function listsAction()
    {
        $prof = $this->getProfConnected();
        $listClass = $this->classeMatiereRepository
                          ->findBy(['idProf' => $prof]);
        return $this->render('@Admin/SkProf/lists-profClass.html.twig', compact('listClass'));
    }

    /**
     * Get all students by class
     * @param SkClasse $skClasse
     * @param SkEtudiantRepository $etudiantRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listStudentsAction(SkClasse $skClasse, SkEtudiantRepository $etudiantRepository)
    {
        $students = $etudiantRepository->findBy(['classe' => $skClasse]);
        
        return $this->render('@Admin/SkProf/lists-students.html.twig', array(
            'students' => $students,
            'prof' => $this->getProfConnected()
        ));
    }

    /**
     * Lists all marks
     */
    public function listProfMarksAction()
    {
        if(in_array('ROLE_PROFS', $this->getUser()->getRoles())) {
            $marks = $this->noteRepository
                        ->findBy(['prof' => $this->getProfConnected()]);
        } else {
            $marks = $this->noteRepository->findAll();

        }
        
        return $this->render('@Admin/SkProf/lists-marks.html.twig',compact('marks'));
    }

    /**
     * manage marks student
     * @param Request $request
     * @param SkClasse $id_class
     * @param SkMatiere $id_matiere | SkMatiere
     * @param SkEtudiant $id_etudiant | SkEtudiant
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function manageMarksAction(Request $request, SkClasse $id_class, SkMatiere $id_matiere, SkEtudiant $id_etudiant)
    {
        /**
         * Access denied for role student
         */
        if(in_array('ROLE_ETUDIANT', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        $marks = new SkNote();
        $form = $this->createForm(SkNoteType::class, $marks, [
            'userProf' => $this->getUser(),
            'student' => $id_etudiant->getEtudiant()->getUsrFirstname(),
        ]);
        $form->handleRequest($request);

        $coef = null;
        $skClassMatiere = $this->classeMatiereRepository->findOneBy([
                'idMatiere' => $id_matiere,
                'idClasse' => $id_class
            ]);

        if($skClassMatiere) { 
            $coef = $skClassMatiere->getCoefficient();
        }

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $marks->setEtudiant($id_etudiant);
            $marks->setCoef($coef);
            $marks->setClasse($id_class);
            $marks->setProf($this->getProfConnected());
            $marksExist = $this->noteRepository->findBy([
                    'matNom' => $id_matiere,
                    'etudiant' => $id_etudiant,
                    'examType' => $form->getData()->getExamType()
                ]);
            if(count($marksExist)) {
                $this->addFlash('error', 'Cette etudiant a deja un note!');
            } else {
                try {
                    $em->persist($marks);
                    $em->flush();
                    $this->addFlash('success', 'Note ajouté avec success!');

                    return $this->redirectToRoute('list_marks');

                }catch(\Exception $e) {
                    $this->addFlash('error', $e->getMessage());
                }
                
            }
           
        }

        return $this->render('@Admin/SkProf/manage-marks.html.twig', array(
            'form' => $form->createView()
        )); 
    }

    /**
     * update marks student
     * @param $request | Request
     * @param $marks | SkNote
     * @return mixed
     */
    public function updateMarksStudentAction(Request $request, SkNote $marks)
    {
        /**
         * Access denied for role student
         */
        if(in_array('ROLE_ETUDIANT', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('fos_user_security_login');
        }

        if($marks->accessDenied($this->getUser(), $marks)) {
            $this->addFlash('error', "Vous n'avez pas le droit de modifier cette note!");
            return $this->redirectToRoute('list_marks');
        }

        $form = $this->createForm(SkNoteType::class, $marks, [
            'userProf' => $this->getUser(),
            'student' => $marks->getEtudiant()->getEtudiant()->getUsrFirstname(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            try {
                $em->persist($marks);
                $em->flush();
                $this->addFlash('success', 'Note modifié avec success!');

                return $this->redirectToRoute('list_marks');

            }catch(\Exception $e) {
                $this->addFlash('error', $e->getMessage());
            }
           
        }

        return $this->render('@Admin/SkProf/edit-marks.html.twig', array(
            'form' => $form->createView()
        )); 
    }

    /**
     * delete marks student
     * @param $marks | SkNote
     * @return mixed
     */
    public function deleteMarksStudentAction(SkNote $marks)
    {
        if(!$marks) {
            $this->createNotFoundException('Aucun note trouvé pour cette id!');
        }

        if($marks->accessDenied($this->getUser(), $marks)) {
            $this->addFlash('error', "Vous n'avez pas le droit d'effacer cette note!");
            return $this->redirectToRoute('list_marks');
        }

        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($marks);
            $em->flush();

            $this->addFlash('success', 'Note supprimé avec success');
            return $this->redirectToRoute('list_marks');
        }catch(\Exception $e) {
            $this->addFlash('error', $e->getMessage());
        }
    }

    /**
     * Delete group marks
     * @param Request $request
     * @return mixed
     */
    public function deleteGroupMarksAction(Request $request)
    {
        $ids = $request->request->get('deleteMarks');
        $em = $this->getDoctrine()->getManager();
        $isDeleted = false;

        if(null == $ids) {
            $this->addFlash('error', 'Veuillez selectioner une note a supprimer');
        } else {
            $marks = $this->noteRepository->findAllMarksById($ids);
            if($marks) {
                foreach($marks as $mark) {
                    try {
                        $em->remove($mark);
                        $em->flush();
                        $isDeleted = true;
                    } catch(\Exception $e) {
                        $this->addFlash('success', 'Note supprimé!');
                    }
                }
            }
        }

        if($isDeleted) {
            $this->addFlash('success', 'Note supprimé!');
        }

        return $this->redirectToRoute('list_marks');

    }

}
