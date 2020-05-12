<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\User;

use App\Constant\MessageConstant;
use App\Constant\RoleConstant;
use App\Controller\AbstractBaseController;
use App\Entity\Administrator;
use App\Entity\SchoolYear;
use App\Entity\User;
use App\Form\AdministratorType;
use App\Repository\AdministratorRepository;
use Exception;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SekolikoAdministratorController.
 *
 * @Route("/{_locale}/admin/administrator")
 */
class SekolikoAdministratorController extends AbstractBaseController
{
    /**
     * @Route("/list",name="administrator_list",methods={"POST","GET"})
     *
     * @param AdministratorRepository $repository
     *
     * @return Response
     */
    public function list(AdministratorRepository $repository): Response
    {
        return $this->render(
            'admin/content/user/administrator_list.html.twig',
            [
                'admins' => $repository->findBySchoolYear($this->getUser()),
            ]
        );
    }

    /**
     * @param Administrator $administrator
     *
     * @Route("/details/{id}",name="administrator_details")
     *
     * @return Response
     */
    public function details(Administrator $administrator)
    {
        return $this->render('admin/content/user/_administration_details.html.twig', ['personel' => $administrator]);
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
        $admin = $administrator ?: new Administrator();
        $form = $this->createForm(AdministratorType::class, $admin, ['etsName' => $this->getUser()->getEtsName()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $this->em->save($admin, $this->getUser(), $form)) {
            if ($this->beforePersistAdmin($admin, $form)) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('administrator_list');
            }

            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute('administrator_manage', ['id' => $admin->getId() ?? null]);
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
    public function delete(Administrator $administrator): RedirectResponse
    {
        if ($this->em->remove($administrator)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);
        } else {
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);
        }

        return $this->redirectToRoute('administrator_list');
    }

    /**
     * @Route("/update/{id}/{year}", name="update_school_year", methods={"POST","GET"})
     *
     * @param User       $user
     * @param SchoolYear $year
     *
     * @return RedirectResponse
     */
    public function updateSchoolYear(User $user, SchoolYear $year)
    {
        $user->setSchoolYear($year);
        $this->manager->flush();

        return $this->redirectToRoute('school_year_list');
    }

    /**
     * @param Administrator $admin
     * @param FormInterface $form
     *
     * @return bool
     */
    public function beforePersistAdmin(Administrator $admin, FormInterface $form): bool
    {
        try {
            /** @var FormInterface $form */
            $pass = $form->getData()->getUser()->getPassword();

            /* @var Administrator $admin */
            $admin->getUser()->setPassword($this->passencoder->encodePassword($admin->getUser(), $pass));
            $admin->getUser()->setRoles([RoleConstant::ROLE_SEKOLIKO['Administrateur']]);
            $this->manager->flush();

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}
