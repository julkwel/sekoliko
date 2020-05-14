<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\ClassRoom;

use App\Constant\MessageConstant;
use App\Controller\AbstractBaseController;
use App\Entity\ClassRoom;
use App\Entity\EmploiDuTemps;
use App\Form\EmploiDuTempsType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EmploiDuTempsController.
 *
 * @Route("/{_locale}/admin/class/edt")
 */
class EmploiDuTempsController extends AbstractBaseController
{
    /**
     * @Route("/manage/{classe}/{id?}", name="edt_manage", methods={"GET","POST"})
     *
     * @param Request            $request
     * @param ClassRoom          $classe
     * @param EmploiDuTemps|null $duTemps
     *
     * @return Response
     */
    public function manageEdt(Request $request, ClassRoom $classe, EmploiDuTemps $duTemps = null)
    {
        $duTemps = $duTemps ?? new EmploiDuTemps();
        $form = $this->createForm(EmploiDuTempsType::class, $duTemps);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $duTemps->setClasse($classe);

            if ($this->em->save($duTemps, $this->getUser(), $form)) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('list_edt', ['id' => $classe->getId()]);
            }
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute('edt_manage', ['classe' => $classe->getId(), 'id' => $duTemps->getId()]);
        }

        return $this->render(
            'admin/content/ClassRoom/_emploi_du_temps_manage.html.twig',
            [
                'form' => $form->createView(),
                'class' => $classe,
            ]
        );
    }

    /**
     * @Route("/list/{id}", name="list_edt", methods={"POST","GET"})
     *
     * @param ClassRoom $classRoom
     *
     * @return Response
     */
    public function listEdt(ClassRoom $classRoom)
    {
        return $this->render(
            'admin/content/ClassRoom/_emploi_du_temps.html.twig',
            ['edt' => $classRoom->getEmploiDuTemps(), 'class' => $classRoom]
        );
    }

    /**
     * @Route("/remove/{id}", name="remove_edt", methods={"POST","GET"})
     *
     * @param EmploiDuTemps $duTemps
     *
     * @return RedirectResponse
     */
    public function removeEdt(EmploiDuTemps $duTemps)
    {
        $classe = $duTemps->getClasse()->getId();
        if ($this->em->remove($duTemps)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);
        } else {
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);
        }

        return $this->redirectToRoute('list_edt', ['id' => $classe]);
    }
}
