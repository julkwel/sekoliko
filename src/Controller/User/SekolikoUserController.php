<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Controller\User;

use App\Controller\AbstractBaseController;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SekolikoUserController
 *
 * @package App\Controller\User
 *
 * @Route("/admin/user")
 */
class SekolikoUserController extends AbstractBaseController
{
    /**
     * @Route("/list",methods={"POST","GET"} ,name="user_list")
     *
     * @param UserRepository $repository
     *
     * @return Response
     */
    public function list(UserRepository $repository)
    {
        return $this->render(
            'admin/content/user/_user_list.html.twig',
            [
                'users' => $repository->findBy(['etsName' => $this->getUser()->getEtsName()]),
            ]
        );
    }

    /**
     * Ges
     * @Route("/manage/{id?}",name="user_management",methods={"POST","GET"})
     *
     * @param User|null $user
     */
    public function manageUser(User $user = null)
    {
        return $this->render(
            ''
        );
    }
}