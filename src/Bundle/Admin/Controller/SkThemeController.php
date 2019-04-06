<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/3/19
 * Time: 11:08 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkTheme;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkThemeController extends Controller
{
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

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
        $_theme = $this->getEntityService()->getAllListByEts(SkTheme::class);

        return $this->render('admin/theme.html.twig', array(
            'themes' => $_theme,
        ));
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
        $_theme = new SkTheme();

        $_sidebar = $request->get('sidebar');
        $_body = $request->get('body');
        $_header = $request->get('header');
        $_form = $this->createFormBuilder($_theme)->getForm();
        $_form->handleRequest($request);
        if ($_form->isSubmitted() && $_form->isValid()) {
            $_theme_list = $this->getEntityService()->getAllListByEts(SkTheme::class);
            if (count($_theme_list) >= 1) {
                $_theme_id = $_theme_list[0]->getId();
                $_theme_list = $this->getEntityService()->getEntityById(SkTheme::class, $_theme_id);
                $this->getEntityService()->deleteEntity($_theme_list, '');
            }
            $_theme->setBody($_body);
            $_theme->setHeader($_header);
            $_theme->setSidebar($_sidebar);

            $this->getEntityService()->saveEntity($_theme, 'new');

            return $this->redirectToRoute('dashboard_index');
        }

        return $this->render('@Admin/SkTheme/edit.html.twig', array(
            'method' => 'POST',
            'add' => true,
            'form' => $_form->createView(),
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function resetAction()
    {
        $_theme_list = $this->getEntityService()->getAllListByEts(SkTheme::class);
        if (count($_theme_list) >= 1) {
            $_theme_id = $_theme_list[0]->getId();
            $_theme_list = $this->getEntityService()->getEntityById(SkTheme::class, $_theme_id);
            $this->getEntityService()->deleteEntity($_theme_list, '');

            return $this->redirectToRoute('dashboard_index');
        } else {
            return $this->redirectToRoute('dashboard_index');
        }
    }
}
