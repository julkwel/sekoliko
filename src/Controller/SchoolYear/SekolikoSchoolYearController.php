<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Controller\SchoolYear;

use App\Constant\EntityConstant;
use App\Controller\AbstractBaseController;
use App\Entity\SchoolYear;
use App\Form\SchoolYearType;
use App\Repository\SchoolYearRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SekolikoSchoolYearController
 *
 * @package App\Controller\SchoolYear
 *
 * @Route("/admin/school/year")
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
                'schoolYears' => $repository->findBy(['etsName' => $this->getUser()->getEtsName(),]),
            ]
        );
    }

    /**
     *
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
            if (true === $this->em->save($schoolYear, $this->getUser())) {
                return $this->redirectToRoute('school_year_list');
            }
        }

        return $this->render(
            'admin/content/SchoolYear/_manage_school_year.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
