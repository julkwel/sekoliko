<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/28/19
 * Time: 10:41 PM.
 */

namespace App\Bundle\Admin\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SkProfsController extends Controller
{
    /**
     * @return mixed
     */
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    public function getClasseList()
    {
    }

    public function indexAction()
    {
    }

    public function newAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}
