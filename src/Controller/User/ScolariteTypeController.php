<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\User;

use App\Constant\MessageConstant;
use App\Controller\AbstractBaseController;
use App\Entity\Scolarite;
use App\Entity\ScolariteType;
use App\Form\ScolariteTypeType;
use App\Repository\ScolariteTypeRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ScolariteTypeController.
 *
 * @Route("/{_locale}/admin/scolarite/type")
 */
class ScolariteTypeController extends AbstractBaseController
{
    /**
     * @param ScolariteTypeRepository $repository
     *
     * @Route("/list",name="scolarite_type_list")
     *
     * @return Response
     */
    public function list(ScolariteTypeRepository $repository)
    {
        $list = $repository->findBy(['etsName' => $this->getUser()->getEtsName()]);

        return $this->render(
            'admin/content/Scolarite/type/_list_type_scolarite.html.twig',
            [
                'types' => $list,
            ]
        );
    }

    /**
     * @Route("/manage/{id?}",name="scolarite_type_manage")
     *
     * @param Request            $request
     * @param ScolariteType|null $scolariteType
     *
     * @return RedirectResponse|Response
     */
    public function manage(Request $request, ScolariteType $scolariteType = null)
    {
        $type = $scolariteType ?? new ScolariteType();
        $form = $this->createForm(ScolariteTypeType::class, $type);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->em->save($type, $this->getUser(), $form)) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('scolarite_type_list');
            }

            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute('scolarite_type_manage', ['id' => $type->getId() ?? null]);
        }

        return $this->render(
            'admin/content/Scolarite/type/_type_manage.html.twig',
            [
                'form' => $form->createView(),
                'type' => $type,
            ]
        );
    }

    /**
     * @param ScolariteType $scolariteType
     *
     * @Route("/remove/{id}",name="scolarite_type_remove")
     *
     * @return RedirectResponse
     */
    public function remove(ScolariteType $scolariteType)
    {
        $repos = $this->manager->getRepository(Scolarite::class)->findBy(['type' => $scolariteType]);

        if ($repos) {
            if ($this->em->remove($scolariteType)) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);
            } else {
                $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);
            }
        } else {
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_ASSOCIATION_MESSAGE);
        }

        return $this->redirectToRoute('scolarite_type_list');
    }
}
