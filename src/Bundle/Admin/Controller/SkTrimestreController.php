<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/9/19
 * Time: 11:54 AM.
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkTrimestre;
use App\Shared\Form\SkTrimestreType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkTrimestreController extends Controller
{
    /**
     * @return mixed
     */
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @return \App\Shared\Repository\SkEntityManager|object
     */
    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function indexAction()
    {
        $_trim_list = $this->getEntityService()->getAllListByEts(SkTrimestre::class);

        return $this->render('AdminBundle:SkTrimestre:index.html.twig', ['trimestre' => $_trim_list]);
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        $_trim = new SkTrimestre();
        $_form = $this->createForm(SkTrimestreType::class, $_trim);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_date_debut = $request->request->get('debut');
            $_date_fin = $request->request->get('fin');

            $_trim->setTrimDebut(new \DateTime($_date_debut));
            $_trim->setTrimFin(new \DateTime($_date_fin));
            if (true === $this->getEntityService()->saveEntity($_trim, 'new')) {
                $this->getEntityService()->setFlash('success', 'ajout trimestre avec success');
            }

            return $this->redirectToRoute('trim_index');
        }

        return $this->render('AdminBundle:SkTrimestre:add.html.twig', ['form' => $_form->createView(), 'trim' => $_trim]);
    }

    /**
     * @param Request     $request
     * @param SkTrimestre $skTrimestre
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function editAction(Request $request, SkTrimestre $skTrimestre)
    {
        $_form = $this->createForm(SkTrimestreType::class, $skTrimestre);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_date_debut = $request->request->get('debut');
            $_date_fin = $request->request->get('fin');
            $skTrimestre->setTrimDebut(new \DateTime($_date_debut));
            $skTrimestre->setTrimFin(new \DateTime($_date_fin));

            if (true === $this->getEntityService()->saveEntity($skTrimestre, 'update')) {
                $this->getEntityService()->setFlash('success', 'Modification trimestre réussi');
            }

            return $this->redirectToRoute('trim_index');
        }

        return $this->render('AdminBundle:SkTrimestre:edit.html.twig', ['form' => $_form->createView(), 'trim' => $skTrimestre]);
    }

    /**
     * @param SkTrimestre $skTrimestre
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function deleteAction(SkTrimestre $skTrimestre)
    {
        if (true === $this->getEntityService()->deleteEntity($skTrimestre, '')) {
            $this->getEntityService()->setFlash('success', 'suppression trimestre réussie');
        }

        return $this->redirectToRoute('trim_index');
    }
}
