<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\SchoolYear;

use App\Constant\MessageConstant;
use App\Controller\AbstractBaseController;
use App\Entity\SchoolYear;
use App\Entity\User;
use App\Form\SchoolYearType;
use App\Repository\SchoolYearRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SekolikoSchoolYearController.
 *
 *
 * @Route("/{_locale}/admin/school/year")
 */
class SekolikoSchoolYearController extends AbstractBaseController
{
    /**
     * @param SchoolYearRepository $repository
     *
     * @Route("/list",methods={"GET","POST"},name="school_year_list")
     *
     * @return Response
     */
    public function list(SchoolYearRepository $repository)
    {
        return $this->render(
            'admin/content/SchoolYear/_list_school_year.html.twig',
            [
                'schoolYears' => $repository->findBy(['etsName' => $this->getUser()->getEtsName()]),
            ]
        );
    }

    /**
     * @Route("/manage/{id?}",methods={"GET","POST"},name="school_year_manage")
     *
     * @param Request         $request
     * @param SchoolYear|null $schoolYear
     *
     * @return RedirectResponse|Response
     */
    public function manage(Request $request, SchoolYear $schoolYear = null)
    {
        $schoolYear = $schoolYear ?: new SchoolYear();
        $form = $this->createForm(SchoolYearType::class, $schoolYear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->em->save($schoolYear, $this->getUser())) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('school_year_list');
            }

            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute('school_year_manage', ['id' => $schoolYear->getId() ?? null]);
        }

        return $this->render(
            'admin/content/SchoolYear/_manage_school_year.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/remove/{id}",name="school_year_remove")
     *
     * @param SchoolYear $schoolYear
     *
     * @return RedirectResponse
     */
    public function remove(SchoolYear $schoolYear)
    {
        $repos = $this->manager->getRepository(User::class)->findBy(['schoolYear' => $schoolYear]);

        if ($repos) {
            if ($this->em->remove($schoolYear)) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);
            } else {
                $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);
            }
        } else {
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_ASSOCIATION_MESSAGE);
        }

        return $this->redirectToRoute('school_year_list');
    }
}
