<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/28/19
 * Time: 10:41 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Bundle\User\Entity\User;
use App\Bundle\User\Form\UserType;
use App\Shared\Entity\SkRole;
use App\Shared\Services\Utils\RoleName;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkProfsController extends Controller
{
    /**
     * @return mixed
     */
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    public function getClasseList()
    {
    }

    public function indexAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $_profs_list = $this->getDoctrine()->getRepository(User::class)->findBy(array(
                'skRole' => [RoleName::ID_ROLE_PROFS],
                'etsNom' => $this->getUserConnected()->getEtsNom()
            ));

            return $this->render('AdminBundle:SkProfs:index.html.twig', [
                'profs' => $_profs_list,
                'ets' => $this->getUserConnected()->getEtsNom()
            ]);
        }

        return $this->redirectToRoute('fos_user_security_logout');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $_user = new User();
            $_user_role = RoleName::ROLE_PROFS;

            $_form = $this->createForm(UserType::class, $_user);
            $_role = $this->getDoctrine()->getRepository(SkRole::class)->find(RoleName::ID_ROLE_PROFS);
            $_pass = $_user->setPlainPassword('123456');

            if ($request->isMethod('POST')) {
                $_form->handleRequest($request);
                if ($_form->isSubmitted()) {
                    $_user->setskRole($_role);
                    $_user->setRoles(array($_user_role));
                    $_user->setEnabled(1);
                    $_user->setPassword($_pass);
                    $this->getEntityService()->saveEntity($_user, 'new');
                    $this->getEntityService()->setFlash('success', 'Ajout profs réussie');

                    return $this->redirectToRoute('profs_index');
                }
            }

            return $this->render('@Admin/SkProfs/add.html.twig', array(
                'form' => $_form->createView(),
            ));
        }

        return $this->redirectToRoute('fos_user_security_logout');
    }

    /**
     * @param Request $request
     * @param User $_user
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function editAction(Request $request,User $_user)
    {
        $_form = $this->createForm(UserType::class, $_user);
        $_form->handleRequest($request);
        if ($_form->isSubmitted() && $_form->isValid()){
            $this->getEntityService()->saveEntity($_user,'update');
            $this->getEntityService()->setFlash('success', 'Modification profs réussie');

            return $this->redirectToRoute('profs_index');
        }

        return $this->render('@Admin/SkProfs/edit.html.twig', array(
            'form' => $_form->createView(),
        ));
    }

    /**
     * @param User $user
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(User $user)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            if (true === $this->getEntityService()->deleteEntity($user, $user->getImgUrl())) {
                $this->getEntityService()->setFlash('success', 'Suppression profs réussie');
                return $this->redirectToRoute('profs_index');
            }
        }

        return $this->redirectToRoute('fos_user_security_logout');
    }
}
