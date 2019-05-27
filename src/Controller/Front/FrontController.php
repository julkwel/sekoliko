<?php


namespace App\Controller\Front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @return Response
     *
     * @Route("/",name="front_index")
     */
    public function index()
    {
        return $this->render('front/index.html.twig');
    }
}