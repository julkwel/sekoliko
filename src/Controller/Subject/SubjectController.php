<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\Subject;

use App\Constant\MessageConstant;
use App\Controller\AbstractBaseController;
use App\Entity\Subject;
use App\Form\SubjectType;
use App\Repository\SubjectRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SubjectController.
 *
 * @Route("/{_locale}/admin/subject")
 */
class SubjectController extends AbstractBaseController
{
    /**
     * @param SubjectRepository $repository
     *
     * @Route("/list",name="subject_list")
     *
     * @return Response
     */
    public function list(SubjectRepository $repository)
    {
        $subjects = $repository->findByEtsName($this->getUser());

        return $this->render('admin/content/Subject/_subject_list.html.twig', ['subjects' => $subjects]);
    }

    /**
     * @Route("/manage/{id?}",name="subject_manage")
     *
     * @param Request      $request
     * @param Subject|null $subject
     *
     * @return RedirectResponse|Response
     */
    public function manage(Request $request, Subject $subject = null)
    {
        $subject = $subject ?? new Subject();
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->em->save($subject, $this->getUser())) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('subject_list');
            }
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute('subject_manage', ['id' => $subject->getId() ?? null]);
        }

        return $this->render(
            'admin/content/Subject/_subject_manage.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param Subject $subject
     *
     * @Route("remove/{id}",name="subject_remove")
     *
     * @return RedirectResponse
     */
    public function remove(Subject $subject)
    {
        if ($this->em->remove($subject)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);
        } else {
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);
        }

        return $this->redirectToRoute('subject_list');
    }
}
