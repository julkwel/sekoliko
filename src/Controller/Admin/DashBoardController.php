<?php


namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DashBoardController extends AbstractController
{
    /**
     * @Route("/admin",name="dashboard_index")
     */
    public function index()
    {
        return $this->render('admin/DashBoard/index.html.twig');
    }
}