<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Controller\User;

use App\Constant\EntityConstant;
use App\Controller\AbstractBaseController;
use App\Entity\Administrator;
use App\Form\AdministratorType;
use App\Repository\AdministratorRepository;
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
    public function list(AdministratorRepository $repository)
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
    public function new(Request $request, Administrator $administrator=null)
    {
        $admin = $administrator ?: new Administrator();
        $form = $this->createForm(AdministratorType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $method = $admin->getId() ? EntityConstant::UPDATE : EntityConstant::NEW;
            if (true === $this->em->save($admin, $this->getUser(), $method)) {
                return $this->redirectToRoute('user_list');
            };
        }

        return $this->render('admin/content/user/_administrator_manage.html.twig', ['form' => $form->createView()]);
    }
}