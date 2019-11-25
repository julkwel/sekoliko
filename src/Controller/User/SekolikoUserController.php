<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\User;

use App\Constant\MessageConstant;
use App\Constant\RoleConstant;
use App\Controller\AbstractBaseController;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SekolikoUserController.
 *
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
    public function list(UserRepository $repository): Response
    {
        return $this->render(
            'admin/content/user/_user_list.html.twig',
            [
                'users' => $repository->findByRoles('ROLE_ADMIN', $this->getUser()->getEtsName()),
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
    public function manageUser(Request $request, User $user = null): Response
    {
        $user = $user ?: new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->uploadPhotoEts($request->files->get('etsphoto'), $this->getUser());
            $this->em->uploadUserPhoto($form->get('photo')->getData(), $this->getUser());
            $this->beforePersistUser($user, $form);

            if ($this->em->save($user, $this->getUser(), $form)) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('user_list');
            }

            $this->addFlash(MessageConstant::ERROR_MESSAGE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute('user_management', ['id' => $user->getId() ?? null]);
        }

        return $this->render(
            'admin/content/user/_user_manage.html.twig',
            [
                'user' => $user,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/delete/{id}",name="user_delete",methods={"POST","GET"})
     *
     * @param User|null $user
     *
     * @return RedirectResponse
     */
    public function delete(User $user): RedirectResponse
    {
        if ($this->em->remove($user)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);
        } else {
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);
        }

        return $this->redirectToRoute('user_list');
    }

    /**
     * Action before manager flush.
     *
     * @param User          $user
     * @param FormInterface $form
     *
     * @return User
     */
    public function beforePersistUser(User $user, FormInterface $form): User
    {
        $pass = $form->get('password')->getData();
        $user->setRoles([RoleConstant::ROLE_SEKOLIKO['Administrateur']]);
        $user->setPassword($this->passencoder->encodePassword($user, $pass));

        return $user;
    }
}
