<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\User;

use App\Constant\MessageConstant;
use App\Constant\RoleConstant;
use App\Controller\AbstractBaseController;
use App\Entity\Scolarite;
use App\Entity\ScolariteType;
use App\Repository\ScolariteRepository;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ScolariteController.
 *
 * @Route("/admin/scolarite")
 */
class ScolariteController extends AbstractBaseController
{
    /**
     * @Route("/list/{type}",name="scolarite_list")
     *
     * @param ScolariteRepository $repository
     * @param ScolariteType       $type
     *
     * @return Response
     */
    public function list(ScolariteRepository $repository, ScolariteType $type)
    {
        return $this->render(
            'admin/content/Scolarite/scolarite/_list_scolarite.html.twig',
            [
                'scolarites' => $repository->findBySchoolYear($this->getUser(), $type),
                'types' => $type,
            ]
        );
    }

    /**
     * @param Request        $request
     * @param ScolariteType  $type
     * @param Scolarite|null $scolarite
     *
     * @return Response
     *
     * @Route("/manage/{type}/{id?}",name="scolarite_manage")
     */
    public function manage(Request $request, ScolariteType $type, Scolarite $scolarite = null)
    {
        $scolarite = $scolarite ?? new Scolarite();
        $form = $this->createForm(\App\Form\ScolariteType::class, $scolarite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $scolarite->setType($type);
            $this->beforeScolaritePersist($scolarite, $form, $type);
            
            if ($this->em->save($scolarite, $this->getUser(), $form)) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('scolarite_list', ['type' => $type->getId()]);
            }

            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);

            return $this->redirectToRoute('scolarite_manage', ['type' => $type->getId(), 'id' => $scolarite->getId() ?? null]);
        }

        return $this->render(
            'admin/content/Scolarite/scolarite/_scolarite_manage.html.twig',
            [
                'type' => $type,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @param Scolarite     $scolarite
     * @param FormInterface $form
     * @param ScolariteType $type
     *
     * @return Scolarite
     */
    public function beforeScolaritePersist(Scolarite $scolarite, FormInterface $form, ScolariteType $type)
    {
        if (RoleConstant::ROLE_PROFS === $type->getId()) {
            $scolarite->getUser()->setRoles([RoleConstant::ROLE_SEKOLIKO['Professeur']]);
        } else {
            $scolarite->getUser()->setRoles([RoleConstant::ROLE_SEKOLIKO['Scolarite']]);
        }
        
        $plainPassword = $this->passencoder->encodePassword($scolarite->getUser(), $form->get('user')->getData()->getPassword());
        $scolarite->getUser()->setPassword($plainPassword);

        return $scolarite;
    }

    /**
     * @param Scolarite $scolarite
     *
     * @Route("/remove/{id}",name="scolarite_remove")
     *
     * @return RedirectResponse
     */
    public function remove(Scolarite $scolarite)
    {
        $type = $scolarite->getType()->getId();
        if (true === $this->em->remove($scolarite)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);
        } else {
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);
        }

        return $this->redirectToRoute('scolarite_list', ['type' => $type]);
    }
}
