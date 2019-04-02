<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 10:13 AM.
 */

namespace App\Bundle\Admin\Controller;

use App\Bundle\User\Entity\User;
use App\Shared\Entity\SkClasse;
use App\Shared\Entity\SkEtudiant;
use App\Shared\Entity\SkMatiere;
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
     * @return mixed
     */
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @throws \Exception
     */
    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_PROFS')) {
            $_profs = $this->getUserConnected();
            $_matier_liste = $this->getDoctrine()->getRepository(SkMatiere::class)->findBy(array('matProf'=>$_profs));

            return $this->render('AdminBundle:SkMatiere:index.html.twig', array(
                'matiere_liste' => $_matier_liste,
            ));
        }

        $_matier_liste = $this->getEntityService()->getAllListByEts(SkMatiere::class);

        return $this->render('AdminBundle:SkMatiere:index.html.twig', array(
            'matiere_liste' => $_matier_liste,
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function matiereEtudiantAction()
    {
        $_user_classe = $this->getDoctrine()->getRepository(SkEtudiant::class)->findBy(array(
            'etsNom' => $this->getUserConnected()->getEtsNom(),
            'etudiant' => $this->getUserConnected(),
        ));

        $_matiere_list = $this->getDoctrine()->getRepository(SkMatiere::class)->findBy(array(
            'etsNom' => $this->getUserConnected()->getEtsNom(),
            'matClasse' => $_user_classe[0]->getClasse(),
        ));

        return $this->render('@Admin/SkMatiere/etudiant.matiere.html.twig', array(
            'classe' => $_user_classe[0]->getClasse(),
            'matiere_liste' => $_matiere_list,
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
                $_user_ets,
            ),
        );

        return $this->getDoctrine()->getRepository(User::class)->findBy($_array_type, array('id' => 'DESC'));
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
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_user_ets = $this->getUserConected()->getEtsNom();
        $_profs_list = $this->getProfs();
        $_classe_list = $this->getDoctrine()->getRepository(SkClasse::class)->findBy(array('etsNom' => $_user_ets));

        $_matiere = new SkMatiere();
        $_form = $this->createForm(SkMatiereType::class, $_matiere);
        $_form->handleRequest($request);
        if ($_form->isSubmitted() && $_form->isValid()) {
            $_profs_user = $request->request->get('profs');
            $_classe = $request->request->get('classe');

            $_profs_user = $this->getDoctrine()->getRepository(User::class)->find($_profs_user);
            $_classe = $this->getDoctrine()->getRepository(SkClasse::class)->find($_classe);
            $_matiere->setMatProf($_profs_user);
            $_matiere->setMatClasse($_classe);
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
            'matiere' => $_matiere,
            'classe' => $_classe_list,
        ));
    }

    /**
     * @param Request   $request
     * @param SkMatiere $skMatiere
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function updateAction(Request $request, SkMatiere $skMatiere)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_profs_liste = $this->getProfs();
        $_user_ets = $this->getUserConected()->getEtsNom();
        $_classe_list = $this->getDoctrine()->getRepository(SkClasse::class)->findBy(array('etsNom' => $_user_ets));

        $_form = $this->createForm(SkMatiereType::class, $skMatiere);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_profs_user = $request->request->get('profs');
            $_classe = $request->request->get('classe');

            $_profs_user = $this->getDoctrine()->getRepository(User::class)->find($_profs_user);
            $_classe = $this->getDoctrine()->getRepository(SkClasse::class)->find($_classe);
            $skMatiere->setMatProf($_profs_user);
            $skMatiere->setMatClasse($_classe);
            $this->getEntityService()->saveEntity($skMatiere, 'update');
            $this->getEntityService()->setFlash('success', 'Mise a jour matiere réussie');

            return $this->redirectToRoute('matiere_index');
        } else {
            $this->redirectToRoute('matiere_new');
        }

        return $this->render('@Admin/SkMatiere/edit.html.twig', array(
            'form' => $_form->createView(),
            'profs' => $_profs_liste,
            'matiere' => $skMatiere,
            'classe' => $_classe_list,
        ));
    }

    /**
     * @param SkMatiere $skMatiere
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkMatiere $skMatiere)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_del_matiere = $this->getEntityService()->deleteEntity($skMatiere, '');

        if (true === $_del_matiere) {
            $this->getEntityService()->setFlash('success', 'suppression matiere réussie');

            return $this->redirectToRoute('matiere_index');
        } else {
            $this->getEntityService()->setFlash('error', 'un erreur se produite');
        }
    }
}
