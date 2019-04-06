<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/6/19
 * Time: 11:09 PM
 */

namespace App\Bundle\Front\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * Render FrontOffice Page
     */
    public function indexAction()
    {
        return $this->render('FrontBundle::index.html.twig');
    }
}