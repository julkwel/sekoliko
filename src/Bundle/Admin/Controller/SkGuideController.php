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
            $this->getEntityService()->saveEntity($guide, 'new');
            $this->getEntityService()->setFlash('success', 'Ajouter avec succes');

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
            $this->getEntityService()->saveEntity($skGuide, 'update');
            $this->getEntityService()->setFlash('success', 'Modifier avec succes');

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
            $this->getEntityService()->setFlash('error', 'guide not found');

            return $this->redirectToRoute('guide_index');
        }

        $_delete_guide = $this->getEntityService()->deleteEntity($skGuide, '');
        if (true === $_delete_guide) {
            return $this->redirectToRoute('guide_index');
        }
    }
}
