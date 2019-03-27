<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 2:02 AM
 */

namespace App\Bundle\Admin\Controller;


use App\Shared\Entity\SkNiveau;
use App\Shared\Form\SkNiveauType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkNiveauController extends Controller
{
    /**
     * @return \App\Shared\Repository\SkEntityManager|object
     */
    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @throws \Exception
     */
    public function indexAction()
    {
        $niveau_list = $this->getEntityService()->getAllListByEts(SkNiveau::class);

        return $this->render('AdminBundle:SkNiveau:index.html.twig', array(
            'niveaux' => $niveau_list
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function newAction(Request $request)
    {
        $_niveau = new SkNiveau();
        $_form = $this->createForm(SkNiveauType::class, $_niveau);
        $_form->handleRequest($request);


        if ($_form->isSubmitted() && $_form->isValid()) {
            $_user_ets = $this->container->get('security.token_storage')->getToken()->getUser()->getEtsNom();
            $_niveau->setEtsNom($_user_ets);

            $this->getEntityService()->saveEntity($_niveau, 'new');
            return $this->redirectToRoute('niveau_index');
        }

        return $this->render('AdminBundle:SkNiveau:add.html.twig', array(
            'niveau' => $_niveau,
            'form' => $_form->createView()
        ));
    }

    /**
     * @param Request $request
     * @param SkNiveau $skNiveau
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateAction(Request $request,SkNiveau $skNiveau)
    {
        $_form = $this->createForm(SkNiveauType::class,$skNiveau);
        $_form->handleRequest($request);

        if($_form->isSubmitted() && $_form->isSubmitted())
        {
            $this->getEntityService()->saveEntity($skNiveau, 'update');
            return $this->redirectToRoute('niveau_index');
        }

        return $this->render('AdminBundle:SkNiveau:edit.html.twig', array(
            'niveau' => $skNiveau,
            'form' => $_form->createView()
        ));
    }

    /**
     * @param SkNiveau $skNiveau
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteAction(SkNiveau $skNiveau)
    {
        $_del_niveau = $this->getEntityService()->deleteEntity($skNiveau,'');
        if ($_del_niveau === true){
            return $this->redirectToRoute('niveau_index');
        }
    }
}