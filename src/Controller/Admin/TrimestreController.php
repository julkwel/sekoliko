<?php

namespace App\Controller\Admin;

use App\Entity\Trimestre;
use App\Form\TrimestreType;
use App\Repository\TrimestreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/trimestre")
 */
class TrimestreController extends AbstractController
{
    /**
     * @Route("/", name="trimestre_index", methods={"GET"})
     */
    public function index(TrimestreRepository $trimestreRepository): Response
    {
        return $this->render('admin/trimestre/index.html.twig', [
            'trimestres' => $trimestreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="trimestre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $trimestre = new Trimestre();
        $form = $this->createForm(TrimestreType::class, $trimestre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trimestre);
            $entityManager->flush();

            return $this->redirectToRoute('trimestre_index');
        }

        return $this->render('admin/trimestre/new.html.twig', [
            'trimestre' => $trimestre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="trimestre_show", methods={"GET"})
     */
    public function show(Trimestre $trimestre): Response
    {
        return $this->render('admin/trimestre/show.html.twig', [
            'trimestre' => $trimestre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="trimestre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Trimestre $trimestre): Response
    {
        $form = $this->createForm(TrimestreType::class, $trimestre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trimestre_index', [
                'id' => $trimestre->getId(),
            ]);
        }

        return $this->render('admin/trimestre/edit.html.twig', [
            'trimestre' => $trimestre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="trimestre_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Trimestre $trimestre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trimestre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trimestre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('trimestre_index');
    }
}
