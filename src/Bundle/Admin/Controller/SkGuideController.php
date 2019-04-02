<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/29/19
 * Time: 2:21 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkGuide;
use App\Shared\Form\SkGuideType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

class SkGuideController extends Controller
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $_list_guide = $this->getEntityService()->getAllList(SkGuide::class);

        return $this->render('AdminBundle:SkGuide:index.html.twig', array(
            'listguide' => $_list_guide,
        ));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        $guide = new SkGuide();
        $form = $this->createForm(SkGuideType::class, $guide);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $_file = $form['attachment']->getData();
            if ($_file) {
                $_extension = $_file->guessExtension();
                $_fileName = $this->generateUniqueFileName() . '.' . $_extension;
                try {
                    $_file->move($this->getParameter('guide_images_upload_directory'), $_fileName);
                    $guide->setAttachment($_fileName);
                } catch (FileException $e) {
                    $this->getEntityService()->setFlash('error', 'Une erreur est survenue, veuillez réessayer');
                }
            }else{
                $guide->setAttachment(null);
            }
            $this->getEntityService()->saveEntity($guide, 'new');
            $this->getEntityService()->setFlash('success', 'Ajout de guide effectué');

            return $this->redirectToRoute('guide_index');
        }

        return $this->render('AdminBundle:SkGuide:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @param SkGuide $skGuide
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function editAction(Request $request, SkGuide $skGuide)
    {
        $form = $this->createForm(SkGuideType::class, $skGuide);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $_file = $form['attachment']->getData();
            if ($_file) {
                $_extension = $_file->guessExtension();
                $_fileName = $this->generateUniqueFileName() . '.' . $_extension;
                try {
                    $_file->move($this->getParameter('guide_images_upload_directory'), $_fileName);
                    $skGuide->setAttachment($_fileName);
                } catch (FileException $e) {
                    $this->getEntityService()->setFlash('error', 'Une erreur est survenue, veuillez réessayer');
                }
            }
            $this->getEntityService()->saveEntity($skGuide, 'update');
            $this->getEntityService()->setFlash('success', 'Guide mis à jour');

            return $this->redirectToRoute('guide_index');
        }

        return $this->render('AdminBundle:SkGuide:edit.html.twig', array(
            'form' => $form->createView(),
            'data' => $skGuide,
        ));
    }

    /**
     * @param SkGuide $skGuide
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkGuide $skGuide)
    {
        if (!$skGuide) {
            $this->getEntityService()->setFlash('error', 'Guide non trouvé');

            return $this->redirectToRoute('guide_index');
        }

        $_delete_guide = $this->getEntityService()->deleteEntity($skGuide, '');
        if (true === $_delete_guide) {
            return $this->redirectToRoute('guide_index');
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
