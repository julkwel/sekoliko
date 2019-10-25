<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Controller\User;

use App\Constant\EntityConstant;
use App\Constant\RoleConstant;
use App\Controller\AbstractBaseController;
use App\Entity\Administrator;
use App\Form\AdministratorType;
use App\Repository\AdministratorRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SekolikoAdministratorController
 * @Route("/admin/administrator")
 *
 * @package App\Controller\User
 */
class SekolikoAdministratorController extends AbstractBaseController
{
    /**
     *
     * @Route("/list/{id?}",name="administrator_list",methods={"POST","GET"})
     *
     * @param AdministratorRepository $repository
     *
     * @return Response
     */
    public function list(AdministratorRepository $repository) : Response
    {
        return $this->render(
            'admin/content/user/administrator_list.html.twig',
            [
                'admins' => $repository->findBy([
                    'etsName' => $this->getUser()->getEtsName(),
                ]),
            ]
        );
    }

    /**
     * @Route("/manage/{id?}",name="administrator_manage",methods={"POST","GET"})
     *
     * @param Request       $request
     * @param Administrator $administrator
     *
     * @return RedirectResponse|Response
     */
    public function new(Request $request, Administrator $administrator = null)
    {
        $admin = $administrator ? : new Administrator();
        $form = $this->createForm(AdministratorType::class, $admin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() &&
            true === $this->em->save($admin, $this->getUser(),
                $admin->getId() ? EntityConstant::UPDATE : EntityConstant::NEW)
        ) {
            $this->beforePersistAdmin($admin, $form);
            $this->manager->flush();

            return $this->redirectToRoute('administrator_list');
        }

        return $this->render('admin/content/user/_administrator_manage.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param Administrator $administrator
     *
     * @Route("/delete/{id}",name="administrator_delete",methods={"POST","GET"})
     *
     * @return RedirectResponse
     */
    public function delete(Administrator $administrator) : RedirectResponse
    {
        $this->manager->remove($administrator);
        $this->manager->flush();

        return $this->redirectToRoute('administrator_list');
    }

    /**
     * @param Administrator $admin
     * @param FormInterface $form
     *
     * @return Administrator
     */
    public function beforePersistAdmin(Administrator $admin, FormInterface $form) : Administrator
    {
        /** @var FormInterface $form */
        $pass = $form->getData()->getUser()->getPassword();
        /** @var Administrator $admin */
        $admin->getUser()->setPassword($this->passencoder->encodePassword($admin->getUser(), $pass));
        $admin->getUser()->setRoles([RoleConstant::ROLE_SEKOLIKO['Administrateur']]);

        return $admin;
    }
}
