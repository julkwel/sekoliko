<?php
/**
 * Created by PhpStorm.
 * User: vony
 * Date: 3/30/19
 * Time: 1:31 PM
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkInformation;
use App\Shared\Form\SkInformationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkInformationController extends Controller
{
    /**
     *
     */
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    /**
     *
     */
    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $_user_ets = $this->getUserConnected()->getEtsNom();

        $_user_information = $this->getEntityService()->getAllListByEts(SkInformation::class);

        return $this->render('@Admin/SkInformation/index.html.twig', array(
            'information' => $_user_information
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }
        $_new_info = new SkInformation();
        $_user_ets = $this->getUserConnected()->getEtsNom();
        $_form = $this->createForm(SkInformationType::class, $_new_info);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_new_info->setDateAjout(new \DateTime('now'));
            $_new_info->setEtsNom($_user_ets);
            try {
                $this->getEntityService()->saveEntity($_new_info, 'new');
                $this->getEntityService()->setFlash('success', 'add information avec success');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'un erreur se produite');
            }
            return $this->redirectToRoute('info_index');
        }

        return $this->render('AdminBundle:SkInformation:add.html.twig', array(
            'form' =>$_form->createView(),
            'information'=>$_new_info
        ));
    }

    /**
     * @param Request $request
     * @param SkInformation $information
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
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
                $this->getEntityService()->setFlash('success', 'Information modifier avec success');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'Un erreur se produite'.$exception->getMessage());
            }

            return $this->redirectToRoute('info_index');
        }

        return $this->render('@Admin/SkInformation/edit.html.twig', array(
            'form'=>$_form->createView(),
            'information'=>$information
        ));
    }

    /**
     * @param SkInformation $skInformation
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(SkInformation $skInformation)
    {
        if (true === $this->getEntityService()->deleteEntity($skInformation, '')) {
            return $this->redirectToRoute('info_index');
        }
    }
}
