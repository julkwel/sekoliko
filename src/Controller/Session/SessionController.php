<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Controller\Session;

use App\Constant\MessageConstant;
use App\Controller\AbstractBaseController;
use App\Entity\Session;
use App\Entity\Student;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SessionController
 *
 * @Route("/{_locale}/admin/session")
 */
class SessionController extends AbstractBaseController
{
    /**
     * @param SessionRepository $repository
     *
     * @Route("/list",name="session_list")
     *
     * @return Response
     */
    public function list(SessionRepository $repository)
    {
        $session = $repository->findByScoolYear($this->getUser()->getSchoolYear(), $this->getUser()->getEtsName());

        return $this->render('admin/content/EtsSession/_session_list.html.twig', ['sessions' => $session]);
    }

    /**
     * @param SessionRepository $repository
     *
     * @param Student           $user
     *
     * @return Response
     */
    public function renderTemplate(SessionRepository $repository, Student $user)
    {
        $session = $repository->findByScoolYear($this->getUser()->getSchoolYear(), $this->getUser()->getEtsName());

        return $this->render(
            'admin/content/student/_session_template.html.twig',
            [
                'sessions' => $session,
                'student' => $user,
            ]
        );
    }

    /**
     * @Route("/manage/{id?}",name="session_manage")
     *
     * @param Request $request
     * @param Session $session
     *
     * @return RedirectResponse|Response
     */
    public function manage(Request $request, Session $session = null)
    {
        $session = $session ?? new Session();

        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->em->save($session, $this->getUser(), $form)) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('session_list');
            }
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute('session_manage', ['id' => $session->getId()]);
        }

        return $this->render(
            'admin/content/EtsSession/_session_manage.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/remove/{id}",name="session_delete")
     *
     * @param Session $session
     *
     * @return RedirectResponse
     */
    public function remove(Session $session)
    {
        $id = $session->getId();
        if ($this->em->remove($session)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);

            return $this->redirectToRoute('session_list');
        }
        $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

        return $this->redirectToRoute('session_manage', ['id' => $id]);
    }
}
