<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/4/19
 * Time: 8:56 PM
 */

namespace App\Bundle\Admin\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SkPaiementController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:SkPaiement:index.html.twig');
    }

    public function newAction()
    {
        return $this->render('AdminBundle:SkPaiement:add.html.twig');
    }

    public function editAction()
    {
        return $this->render('AdminBundle:SkPaiement:edit.html.twig');
    }

    public function detailsAction()
    {
        return $this->render('AdminBundle:SkPaiement:details.html.twig');
    }

    public function deleteAction()
    {
        return $this->redirectToRoute('paiement_list');
    }
}