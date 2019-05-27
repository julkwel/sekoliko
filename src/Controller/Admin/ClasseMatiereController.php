<?php

namespace App\Controller\Admin;

use App\Entity\ClasseMatiere;
use App\Form\ClasseMatiereType;
use App\Repository\ClasseMatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/classe/matiere")
 */
class ClasseMatiereController extends AbstractController
{
    /**
     * @Route("/", name="classe_matiere_index", methods={"GET"})
     * @param ClasseMatiereRepository $classeMatiereRepository
     * @return Response
     */
    public function index(ClasseMatiereRepository $classeMatiereRepository): Response
    {
        return $this->render('admin/classe_matiere/index.html.twig', [
            'classe_matieres' => $classeMatiereRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="classe_matiere_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $classeMatiere = new ClasseMatiere();
        $form = $this->createForm(ClasseMatiereType::class, $classeMatiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classeMatiere);
            $entityManager->flush();

            return $this->redirectToRoute('classe_matiere_index');
        }

        return $this->render('admin/classe_matiere/new.html.twig', [
            'classe_matiere' => $classeMatiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="classe_matiere_show", methods={"GET"})
     * @param ClasseMatiere $classeMatiere
     * @return Response
     */
    public function show(ClasseMatiere $classeMatiere): Response
    {
        return $this->render('admin/classe_matiere/show.html.twig', [
            'classe_matiere' => $classeMatiere,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="classe_matiere_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ClasseMatiere $classeMatiere
     * @return Response
     */
    public function edit(Request $request, ClasseMatiere $classeMatiere): Response
    {
        $form = $this->createForm(ClasseMatiereType::class, $classeMatiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('classe_matiere_index', [
                'id' => $classeMatiere->getId(),
            ]);
        }

        return $this->render('admin/classe_matiere/edit.html.twig', [
            'classe_matiere' => $classeMatiere,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="classe_matiere_delete", methods={"DELETE"})
     * @param Request $request
     * @param ClasseMatiere $classeMatiere
     * @return Response
     */
    public function delete(Request $request, ClasseMatiere $classeMatiere): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classeMatiere->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($classeMatiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('classe_matiere_index');
    }
}
