<?php

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkEtudiant;
use App\Shared\Entity\SkMatiere;
use App\Shared\Entity\SkClasseMatiere;
use App\Shared\Form\SkMatiereType;
use App\Shared\Repository\SkClasseMatiereRepository;
use App\Shared\Repository\SkClasseRepository;
use App\Shared\Repository\SkMatiereRepository;
use App\Shared\Repository\SkProfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SkMatiereController
 * @package App\Bundle\Admin\Controller
 * @author Max
 */
class SkMatiereController extends Controller
{
    /**
     * @var SkMatiereRepository
     */
    private $matiereRepository;
    /**
     * @var ClasseRepository
     */
    private $classeRepository;

    public function __construct(SkMatiereRepository $matiereRepository,
                                SkClasseRepository $classeRepository)
    {
        $this->matiereRepository = $matiereRepository;
        $this->classeRepository = $classeRepository;
    }

    /**
     * @return \App\Shared\Repository\SkEntityManager|object
     */
    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }


    public function indexAction()
    {
        if(in_array('ROLE_PROFS', $this->getUser()->getRoles())) {
            $subjects = $this->matiereRepository->findBy(['matProf' => $this->getUser()]);
            if($subjects) {
                return $this->render('AdminBundle:SkMatiere:index.html.twig', array(
                    'subjects' => $subjects,
                ));
            }
        }

        $subjects = $this->getEntityService()->getAllListByEts(SkMatiere::class);
        return $this->render('AdminBundle:SkMatiere:index.html.twig', array(
            'subjects' => $subjects,
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function matiereEtudiantAction()
    {
        $_user_classe = $this->getDoctrine()->getRepository(SkEtudiant::class)->findBy(array(
            'etsNom' => $this->getUserConnected()->getEtsNom(),
            'etudiant' => $this->getUserConnected(),
        ));

        $_matiere_list = $this->getDoctrine()->getRepository(SkMatiere::class)->findBy(array(
            'etsNom' => $this->getUserConnected()->getEtsNom(),
            'matClasse' => $_user_classe[0]->getClasse(),
        ));

        return $this->render('@Admin/SkMatiere/etudiant.matiere.html.twig', array(
            'classe' => $_user_classe[0]->getClasse(),
            'matiere_liste' => $_matiere_list,
        ));
    }

    /**
     * @param Request $request
     *
     * @param SkProfRepository $profRepository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, SkProfRepository $profRepository)
    {
        /**
         * Access denied for student
         */
        if(in_array('ROLE_ETUDIANT', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('sk_login');
        }

        $subject = new SkMatiere();
        $form = $this->createForm(SkMatiereType::class, $subject, [
            'user' => $this->getUser()->getEtsNom()
        ]);
        $form->handleRequest($request);

        $classes = $this->classeRepository->findBy([
            'etsNom' => $this->getUser()->getEtsNom()
        ]);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $em */
            $em = $this->getDoctrine()->getManager();

            $merge = [];
            $coef = $request->request->get('coefficient');
            $classId = $request->request->get('classId');

            if(empty($classId)) {
                $this->getEntityService()->setFlash('error', 'Veuillez choisir une classe');
                return $this->redirectToRoute('matiere_new');
            }

            $i = 0;
            foreach ($classId as $class) {
                $merge[$class] = $coef[$i];
                $i++;
            }

            try 
            {
                if (!$this->subjectExist($subject->getMatNom(), $subject->getMatProf())) {
                    foreach ($merge as $classId => $coef) {
                        $classSubject = new SkClasseMatiere();
                        $classSubject->setIdMatiere($subject);
                        $class = $this->classeRepository->find($classId);
                        $classSubject->setIdClasse($class);
                        $classSubject->setCoefficient($coef);
                        $prof = $profRepository
                                ->findOneBy(['profs' => $form->getData()->getMatProf()]);
                        $classSubject->setIdProf($prof);
                        $em->persist($classSubject);
                    }
                    $subject->setEtsNom($this->getUser()->getEtsNom());
                    $em->persist($subject);
                    $em->flush();
                    $this->getEntityService()->setFlash('success', 'Matiere ajouté ave success');

                    return $this->redirectToRoute('matiere_index');
                } else {
                    $this->getEntityService()->setFlash('error', 'Ce matiere existe deja pour le prof ' . $subject->getMatProf()->getUsrFirstname());
                    return $this->redirectToRoute('matiere_index');
                }

            } catch (\Exception $e) {
                $this->getEntityService()->setFlash('error', $e->getMessage());
            }

        } else {
            $this->redirectToRoute('matiere_new');
        }
        return $this->render('@Admin/SkMatiere/add.html.twig', array(
            'form' => $form->createView(),
            'classe' => $classes
        ));
    }

    /**
     * @param $name
     * @param $prof
     * @return bool
     */
    private function subjectExist($name,$prof)
    {
        $matiere = $this->matiereRepository
            ->findBy(['matNom' => $name, 'matProf' => $prof]);
        return $matiere ? true : false;
    }

    /**
     * @param Request $request
     * @param SkMatiere $skMatiere
     *
     * @param SkClasseMatiereRepository $classeMatiereRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, SkMatiere $skMatiere,
                                 SkClasseMatiereRepository $classeMatiereRepository)
    {
        /**
         * Access denied for student
         */
        if(!$this->getUser()) {
            return $this->redirectToRoute('sk_login');
        }
        if(in_array('ROLE_ETUDIANT', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('sk_login');
        }

        $data = [];
        $collectionClassSubject = $classeMatiereRepository->findBy([
            'idMatiere' => $skMatiere
        ]);

        /** check if param idClass exist */
        if(!empty($request->query->get('idClass'))) {
            $idClass = $request->query->get('idClass');
            $collectionClassSubject = $classeMatiereRepository->findBy([
                'idMatiere' => $skMatiere,
                'idClasse' => $idClass
            ]);
        }

        $classes = $this->classeRepository->findBy(array('etsNom' => $this->getUser()->getEtsNom()));

        foreach ($collectionClassSubject as $collection) {
            $class = $collection->getIdClasse();
            $coefficient = $collection->getCoefficient();
            $classRepository = $this->classeRepository->find($class);
            $data[] = array(
                'id' => $classRepository->getId(),
                'optionName' => $classRepository->getClasseNom(),
                'coefficient' => $coefficient,
            );
        }

        $form = $this->createForm(SkMatiereType::class, $skMatiere, [
            'user' => $this->getUser()->getEtsNom()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $em */
            $em = $this->getDoctrine()->getManager();

            $merge = [];
            $coef = $request->request->get('coefficient');
            $classId = $request->request->get('classId');

            $i = 0;
            foreach ($classId as $class) {
                $merge[$class] = $coef[$i];
                $i++;
            }

            $oldCollection = new ArrayCollection();
            foreach ($skMatiere->getSkClasseMatieres() as $skSubject) {
                $oldCollection->add($skSubject);
            }

            $newCollection = new ArrayCollection();
            foreach ($merge as $classId => $coef) {
                $skSubject = new SkClasseMatiere();
                $class = $this->classeRepository->find($classId);
                $skSubject->setIdMatiere($skMatiere);
                $skSubject->setIdClasse($class);
                $skSubject->setCoefficient($coef);

                $newCollection->add($skSubject);
            }

            $i = 0;
            while(count($oldCollection) > $i) {
                $clsId = $request->query->get('idClass');
                if(empty($clsId)) {
                    if(false === $newCollection->contains($oldCollection[$i])) {
                        $em->remove($oldCollection[$i]);
                    }
                } else {
                    if($oldCollection[$i]->getIdClasse()->getId() == $clsId) {
                        $em->remove($oldCollection[$i]);
                    }
                }
                $i++;
            }
            

            $skMatiere->setSkClasseMatieres($newCollection);

            try{
                $em->flush();
                $this->getEntityService()->setFlash('success', 'Matiere edité avec success');

                if(!empty($idClass)) {
                    return $this->redirectToRoute('classe_matiere_liste', array('id' => $idClass));
                }

                return $this->redirectToRoute('matiere_index');

            }catch (\Exception $exception){
                $this->getEntityService()->setFlash('error', $exception->getMessage());
            }
        } else {
            $this->redirectToRoute('matiere_new');
        }

        return $this->render('@Admin/SkMatiere/edit.html.twig', array(
            'form' => $form->createView(),
            'data' => $data,
            'classes' => $classes,
        ));
    }

    /**
     * @param SkMatiere $skMatiere
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkMatiere $skMatiere)
    {
        /**
         * Access denied for student
         */
        if(in_array('ROLE_ETUDIANT', $this->getUser()->getRoles())) {
            return $this->redirectToRoute('sk_login');
        }

        if(!$skMatiere) {
            return $this->createNotFoundException("Aucun matiere trouvé!");
        } else {
            try{
                $statusDelete = $this->getEntityService()->deleteEntity($skMatiere, '');
                $this->getEntityService()->setFlash('success', 'Matiere supprimé avec success');
                if($statusDelete) {
                    return $this->redirectToRoute('matiere_index');
                }
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', $exception->getMessage());
            }
        }

    }

    public function deleteSubjectGroupAction(Request $request)
    {
        $ids = $request->request->get('delete');
        $subjects = $this->matiereRepository->findGroupById($ids);

        if(!$subjects) {
            $this->createNotFoundException('Aucun matiere selectionner');
        }

        $isDeleted = false;
        foreach ($subjects as $subject) {
            $this->getEntityService()->deleteEntity($subject, '');
            $isDeleted = true;
        }

        if($isDeleted) {
            $this->getEntityService()->setFlash('success', 'Matiere supprimé');
            return $this->redirectToRoute('matiere_index');
        }

    }

    public function getAllSubjectsAction()
    {
        $subjects = $this->matiereRepository->allSubject();
        $data = [];
        $i = 0;

        while (count($subjects) > $i) {
            $data[] = $subjects[$i]->getMatNom();
            $i++;
        }

        return new JsonResponse($data, 200);
    }
}
