<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 5:14 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkEtudiant;
use App\Shared\Entity\SkMatiere;
use App\Shared\Entity\SkNote;
use App\Shared\Form\SkNoteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SkNoteController extends Controller
{
    /**
     * @return \App\Shared\Repository\SkEntityManager|object
     */
    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @return mixed
     */
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @param Request    $request
     * @param SkEtudiant $skEtudiant
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, SkEtudiant $skEtudiant)
    {
        $_note_liste = $this->getDoctrine()->getRepository(SkNote::class)->findBy(array('etudiant' => $skEtudiant));

        return $this->render('@Admin/SkEtudiant/listnote.html.twig', array(
            'note_liste' => $_note_liste,
            'etudiant' => $skEtudiant,
        ));
    }

    /**
     * @param Request    $request
     * @param SkEtudiant $etudiant
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addNoteAction(Request $request, SkEtudiant $etudiant)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        /*
         * Check if profs is connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_PROFS')) {
            $_profs = $this->getUserConnected();
            $_matiere_liste = $this->getDoctrine()->getRepository(SkMatiere::class)->findBy(array(
                'matProf'=>$_profs,
                'etsNom' => $_ets_nom,
            ));
        } else {
            $_ets_nom = $this->getUserConnected()->getEtsNom();
            $_etudiant_classe = $etudiant->getClasse()->getId();
            $_matiere_liste = $this->getDoctrine()->getRepository(SkMatiere::class)->findBy(array(
                'etsNom' => $_ets_nom,
                'matClasse' => $_etudiant_classe,
            ));
        }

        $_note = new SkNote();

        $_form = $this->createForm(SkNoteType::class, $_note);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_matiere = $request->request->get('matiere');
            $_valeur = $request->request->get('noteVal');
            $_matiere = $this->getDoctrine()->getRepository(SkMatiere::class)->find($_matiere);
            $_note->setEtudiant($etudiant);
            $_note->setMatNom($_matiere);
            $_note->setEtsNom($_ets_nom);
            $_note->setNoteVal($_valeur);
            try {
                $this->getEntityService()->saveEntity($_note, 'new');
                $this->getEntityService()->setFlash('success', 'Note ajouté avec success');
            } catch (\Exception $exception) {
                $exception->getMessage();
            }

            return $this->redirect($this->generateUrl('etudiant_note', array('id' => $etudiant->getId())));
        }

        return $this->render('@Admin/SkEtudiant/note.html.twig', array(
            'form' => $_form->createView(),
            'user' => $etudiant,
            'matiere' => $_matiere_liste,
            'etudiant' => $etudiant,
        ));
    }

    /**
     * @param Request $request
     * @param SkNote  $skNote
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, SkNote $skNote)
    {

        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_ets_nom = $this->getUserConnected()->getEtsNom();
        $_etudiant_classe = $skNote->getEtudiant()->getClasse()->getId();

        /*
         * Check if profs is connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_PROFS')) {
            $_profs = $this->getUserConnected();
            $_matiere_liste = $this->getDoctrine()->getRepository(SkMatiere::class)->findBy(array(
                'matProf'=>$_profs,
                'etsNom' => $_ets_nom,
            ));
        } else {
            $_matiere_liste = $this->getDoctrine()->getRepository(SkMatiere::class)->findBy(array(
                'etsNom' => $_ets_nom,
                'matClasse' => $_etudiant_classe,
            ));
        }
        $_form = $this->createForm(SkNoteType::class, $skNote);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_matiere = $request->request->get('matiere');
            $_valeur = $request->request->get('noteVal');
            $_matiere = $this->getDoctrine()->getRepository(SkMatiere::class)->find($_matiere);
            try {
                $skNote->setEtudiant($skNote->getEtudiant());
                $skNote->setMatNom($_matiere);
                $skNote->setNoteVal($_valeur);
                $this->getEntityService()->saveEntity($skNote, 'update');
            } catch (\Exception $exception) {
                $exception->getMessage();
            }

            return $this->redirect($this->generateUrl('etudiant_note', array('id' => $skNote->getEtudiant()->getId())));
        }

        return $this->render('@Admin/SkEtudiant/editnote.html.twig', array(
           'form' => $_form->createView(),
            'note' => $skNote,
            'matiere' => $_matiere_liste,
        ));
    }

    /**
     * @param SkNote $skNote
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkNote $skNote)
    {

        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }
        $_etudiant_classe = $skNote->getEtudiant()->getClasse()->getId();
        $_delete_note = $this->getEntityService()->deleteEntity($skNote, '');
        if (true === $_delete_note) {
            $this->getEntityService()->setFlash('success', 'suppression avec success');

            return $this->redirect($this->generateUrl('etudiant_note', array('id' => $skNote->getEtudiant()->getId())));
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function etudiantNoteAction()
    {
        $_user_classe = $this->getDoctrine()->getRepository(SkEtudiant::class)->findBy(array(
            'etsNom' => $this->getUserConnected()->getEtsNom(),
            'etudiant' => $this->getUserConnected(),
        ));

        $_note_liste = $this->getDoctrine()->getRepository(SkNote::class)->findBy(array(
           'etudiant' => $_user_classe[0],
        ));

        return $this->render('@Admin/SkEtudiant/etudiant.note.html.twig', array(
            'note_liste' => $_note_liste,
        ));
    }
}
