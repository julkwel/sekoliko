<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Controller\User;

use App\Constant\EntityConstant;
use App\Controller\AbstractBaseController;
use App\Entity\User;
use App\Form\UserType;
use App\Manager\SekolikoEntityManager;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/manage/{id?}",name="user_management",methods={"POST","GET"})
     *
     * @param Request   $request
     * @param User|null $user
     *
     * @return Response
     */
    public function manageUser(Request $request, User $user = null)
    {
        $user = $user ?: new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $method = $user->getId() ? EntityConstant::UPDATE : EntityConstant::NEW;
            if (true === $this->em->save($user, $this->getUser(), $method)) {
                return $this->redirectToRoute('user_list');
            }

            return $this->redirectToRoute('user_management');
        }

        return $this->render(
            'admin/content/user/_user_manage.html.twig',
            [
                'user' => $user,
                'form' => $form->createView(),
            ]
        );
    }
}