<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/26/19
 * Time: 8:25 PM
 */

namespace App\Bundle\Admin\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SkDashBoardController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@Admin/SkDashboard/index.html.twig',array(
            'hello' => 'Hello'
        ));
    }
}