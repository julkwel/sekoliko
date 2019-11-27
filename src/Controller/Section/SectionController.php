<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\Section;

use App\Constant\MessageConstant;
use App\Controller\AbstractBaseController;
use App\Entity\Section;
use App\Form\SectionType;
use App\Repository\SectionRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SectionController.
 *
 * @Route("/{_locale}/admin/section")
 */
class SectionController extends AbstractBaseController
{
    /**
     * @param SectionRepository $repository
     *
     * @return Response
     *
     * @Route("/list",name="section_list")
     */
    public function list(SectionRepository $repository): Response
    {
        return $this->render(
            'admin/content/Section/_section_list.html.twig',
            [
                'sections' => $repository->findBySchoolName($this->getUser()),
            ]
        );
    }

    /**
     * @Route("/manage/{id?}",name="section_manage")
     *
     * @param Request      $request
     * @param Section|null $section
     *
     * @return Response
     */
    public function manage(Request $request, Section $section = null): Response
    {
        $section = $section ?? new Section();
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->em->save($section, $this->getUser())) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('section_list');
            }

            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute('section_manage', ['id' => $section->getId() ?? null]);
        }

        return $this->render('admin/content/Section/_section_manage.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param Section $section
     *
     * @Route("/remove/{id}",name="section_remove")
     *
     * @return RedirectResponse
     */
    public function remove(Section $section)
    {
        if ($this->em->remove($section)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);
        } else {
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);
        }

        return $this->redirectToRoute('section_list');
    }
}
