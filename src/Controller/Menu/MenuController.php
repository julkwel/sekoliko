<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Controller\Menu;

use App\Controller\AbstractBaseController;
use App\Repository\ScolariteTypeRepository;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MenuController.
 */
class MenuController extends AbstractBaseController
{
    /**
     * @param ScolariteTypeRepository $repository
     *
     * @return Response
     */
    public function list(ScolariteTypeRepository $repository)
    {
        $list = $repository->findBy(['etsName' => $this->getUser()->getEtsName()]);

        return $this->render('admin/menu/scolarite_type_list.html.twig', ['scolarites' => $list]);
    }
}
