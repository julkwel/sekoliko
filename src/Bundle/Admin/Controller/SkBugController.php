<?php
/**
 * Created by PhpStorm.
 * User: vony
 * Date: 3/30/19
 * Time: 4:09 PM
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkBug;
use App\Shared\Form\SkBugType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

class SkBugController extends Controller
{
    /**
     * @return mixed
     */
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @return \App\Shared\Repository\SkEntityManager|object
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
        $_bug_list = $this->getEntityService()->getAllList(SkBug::class);

        return $this->render('@Admin/SkBug/index.html.twig', array(
            'bug'=>$_bug_list
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_bug = new SkBug();
        $_form = $this->createForm(SkBugType::class, $_bug);
        $_form->handleRequest($request);
        $_user = $this->getUserConnected();

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_status = $request->request->get('status');
            if ($_status === "Important") {
                $_bug->setColor("green");
            } elseif ($_status === "Features") {
                $_bug->setColor("yellow");
            } elseif($_status === "En cours"){
                $_bug->setColor("orange");
            } elseif($_status === "Fix"){
                $_bug->setColor("blue");
            }else {
                $_bug->setColor("red");
            }


            $_bug->setStatus($_status);
            $_bug->setDateAjout(new \DateTime('now'));
            $_bug->setUser($_user);

            $_file = $_form['attachment']->getData();
            if ($_file) {
                $_extension = $_file->guessExtension();
                $_fileName = $this->generateUniqueFileName() . '.' . $_extension;
                try {
                    $_file->move($this->getParameter('bug_images_upload_directory'), $_fileName);
                    $_bug->setAttachment($_fileName);
                } catch (FileException $e) {
                    $this->getEntityService()->setFlash('error', 'Une erreur est survenue, veuillez réessayer');
                }
            }else{
                $_bug->setAttachment(null);
            }

            try {
                $this->getEntityService()->saveEntity($_bug, 'new');
                $this->getEntityService()->setFlash('success', 'Bug reporté avec succès');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuiller réessayez ultérieurement');
            }

            return $this->redirectToRoute('bug_index');
        }

        return $this->render('AdminBundle:SkBug:add.html.twig', array(
            'form'=>$_form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param SkBug $_bug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function updateAction(Request $request, SkBug $_bug)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_form = $this->createForm(SkBugType::class, $_bug);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_status = $request->request->get('status');
            if ($_status === "Important") {
                $_bug->setColor("green");
            } elseif ($_status === "Features") {
                $_bug->setColor("yellow");
            } elseif($_status === "Fix"){
                $_bug->setColor("blue");
            } elseif($_status === "En cours"){
                $_bug->setColor("orange");
            }else {
                $_bug->setColor("red");
            }
            $_bug->setStatus($_status);

            $_file = $_form['attachment']->getData();

            if ($_file) {
                $_extension = $_file->guessExtension();
                $_fileName = $this->generateUniqueFileName() . '.' . $_extension;
                try {
                    $_file->move($this->getParameter('bug_images_upload_directory'), $_fileName);
                    $_bug->setAttachment($_fileName);
                } catch (FileException $e) {
                    $this->getEntityService()->setFlash('error', 'Une erreur est survenue, veuillez réessayer');
                }
            }

            try {
                $this->getEntityService()->saveEntity($_bug, 'update');
                $this->getEntityService()->setFlash('success', 'Rapport du Bug mis à jour');
            } catch (\Exception $exception) {
                $this->getEntityService()->setFlash('error', 'Une erreur s\'est produite, veuillez réessayer ultérieurement');
            }

            return $this->redirectToRoute('bug_index');
        }

        return $this->render('AdminBundle:SkBug:edit.html.twig', array(
            'form'=>$_form->createView(),
            'bug'=>$_bug
        ));
    }

    /**
     * @param SkBug $skBug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkBug $skBug)
    {
        if (true === $this->getEntityService()->deleteEntity($skBug, '')) {
            $this->getEntityService()->setFlash('success', 'Suppression du Bug effectuée');
            return $this->redirectToRoute('bug_index');
        }
    }


    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

}
