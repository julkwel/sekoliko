<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 10:13 AM
 */

namespace App\Bundle\Admin\Controller;


use App\Bundle\User\Entity\User;
use App\Shared\Entity\SkMatiere;
use App\Shared\Entity\SkProfs;
use App\Shared\Form\SkMatiereType;
use App\Shared\Services\Utils\RoleName;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkMatiereController extends Controller
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
        $_matier_liste = $this->getEntityService()->getAllListByEts(SkMatiere::class);

        return $this->render('AdminBundle:SkMatiere:index.html.twig', array(
            'matiere_liste' => $_matier_liste
        ));
    }

    /**
     * @return mixed
     */
    public function getUserConected()
    {
        return $this->container->get('security.token_storage')->getToken()->getUser();
    }

    public function getProfs()
    {
        $_user_ets = $this->getUserConected()->getEtsNom();

        $_array_type = array(
            'skRole' => array(
                RoleName::ID_ROLE_PROFS,
            ),
            'etsNom' => array(
                $_user_ets
            )
        );

        return $this->getDoctrine()->getRepository(User::class)->findBy($_array_type, array('id' => 'DESC'));
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        $_user_ets = $this->getUserConected()->getEtsNom();
        $_profs_list = $this->getProfs();

        $_matiere = new SkMatiere();
        $_form = $this->createForm(SkMatiereType::class, $_matiere);
        $_form->handleRequest($request);
        if ($_form->isSubmitted() && $_form->isValid()) {
            $_profs_user = $request->request->get('profs');

            $_profs_user = $this->getDoctrine()->getRepository(User::class)->find($_profs_user);
            $_matiere->setMatProf($_profs_user);
            $_matiere->setEtsNom($_user_ets);
            $this->getEntityService()->saveEntity($_matiere, 'new');
            $this->getEntityService()->setFlash('success', 'Ajout Matiere avec success');

            return $this->redirectToRoute('matiere_index');
        } else {
            $this->redirectToRoute('matiere_new');
        }

        return $this->render('@Admin/SkMatiere/add.html.twig', array(
            'form' => $_form->createView(),
            'profs' => $_profs_list,
            'matiere' => $_matiere
        ));
    }

    /**
     * @param Request $request
     * @param SkMatiere $skMatiere
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function updateAction(Request $request,SkMatiere $skMatiere)
    {
        $_profs_liste = $this->getProfs();

        $_form = $this->createForm(SkMatiereType::class,$skMatiere);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()){
            $_profs_user = $request->request->get('profs');
            $_profs_user = $this->getDoctrine()->getRepository(User::class)->find($_profs_user);
            $skMatiere->setMatProf($_profs_user);
            $this->getEntityService()->saveEntity($skMatiere,'update');
            $this->getEntityService()->setFlash('success','Mise a jour matiere réussie');

            return $this->redirectToRoute('matiere_index');
        } else{
            $this->redirectToRoute('matiere_new');
        }

        return $this->render('@Admin/SkMatiere/edit.html.twig',array(
            'form' => $_form->createView(),
            'profs'=> $_profs_liste,
            'matiere'=> $skMatiere
        ));
    }

    /**
     * @param SkMatiere $skMatiere
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkMatiere $skMatiere)
    {
        $_del_matiere = $this->getEntityService()->deleteEntity($skMatiere,'');

        if ($_del_matiere === true){
            $this->getEntityService()->setFlash('success','suppression matiere réussie');
            return $this->redirectToRoute('matiere_index');
        } else{
            $this->getEntityService()->setFlash('error','un erreur se produite');
        }
    }
}