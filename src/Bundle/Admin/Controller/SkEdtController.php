<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 11:01 PM
 */

namespace App\Bundle\Admin\Controller;


use App\Shared\Entity\SkClasse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkEdtController extends Controller
{
    /**
     * @param SkClasse $skClasse
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(SkClasse $skClasse)
    {
        dump($skClasse);
        die();
        return $this->render('@Admin/SkClasse/edt.html.twig', array());
    }

    public function addEdtAction(Request $request, SkClasse $skClasse)
    {

    }
}