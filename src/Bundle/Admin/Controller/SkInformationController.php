<?php
/**
 * Created by PhpStorm.
 * User: vony
 * Date: 3/30/19
 * Time: 1:31 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkInfoComment;
use App\Shared\Entity\SkInformation;
use App\Shared\Form\SkInfoCommentType;
use App\Shared\Form\SkInformationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkInformationController extends Controller
{
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function indexAction(Request $request)
    {
        $_user_information = $this->getEntityService()->getAllListByEts(SkInformation::class);

        $_new_info = new SkInformation();

        $_form = $this->createForm(SkInformationType::class, $_new_info);
        $_form->handleRequest($request);

        if ('POST' === $request->getMethod()) {
            if ($_form->isSubmitted() && $_form->isValid()) {
                $this->newAction($_new_info);

                return $this->redirect($request->getUri());
            }
        }

        return $this->render('@Admin/SkInformation/index.html.twig', array(
            'information' => $_user_information,
            'form' => $_form->createView(),
            'etablissement' => $this->getUserConnected()->getEtsNom(),
        ));
    }

    /**
     * @param $_new_info
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function newAction($_new_info)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return false;
        }

        $_new_info->setDateAjout(new \DateTime('now'));
        try {
            $this->getEntityService()->saveEntity($_new_info, 'new');
            $this->getEntityService()->setFlash('success', 'Ajout d\'information effectuée');
        } catch (\Exception $exception) {
            $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuillez réessayez');
        }

        return true;
    }

    /**
     * @param Request       $request
     * @param SkInformation $skInformation
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function commentAction(Request $request, SkInformation $skInformation)
    {
        $_comment = new SkInfoComment();

        $_form = $this->createForm(SkInfoCommentType::class, $_comment);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_comment->setUser($this->getUserConnected());
            $_comment->setInfo($skInformation);
            $_comment->setDate(new \DateTime());

            try {
                $this->getEntityService()->saveEntity($_comment, 'new');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', $exception->getMessage());
            }

            return $this->redirect($request->getUri());
        }

        return $this->render('AdminBundle:SkInformation:comment.html.twig', ['form' => $_form->createView()]);
    }

    /**
     * @param Request       $request
     * @param SkInformation $information
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function updateAction(Request $request, SkInformation $information)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_form = $this->createForm(SkInformationType::class, $information);
        $_form->handleRequest($request);
        if ($_form->isSubmitted() && $_form->isValid()) {
            try {
                $this->getEntityService()->saveEntity($information, 'update');
                $this->getEntityService()->setFlash('success', 'Information mis à jour');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuillez réessayez'.$exception->getMessage());
            }

            return $this->redirectToRoute('info_index');
        }

        return $this->render('@Admin/SkInformation/edit.html.twig', array(
            'form' => $_form->createView(),
            'information' => $information,
        ));
    }

    /**
     * @param SkInformation $skInformation
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteAction(SkInformation $skInformation)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }
        if (true === $this->getEntityService()->deleteEntity($skInformation, '')) {
            return $this->redirectToRoute('info_index');
        }
    }
}
