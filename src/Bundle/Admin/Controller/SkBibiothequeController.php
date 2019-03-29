<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/29/19
 * Time: 3:15 AM
 */

namespace App\Bundle\Admin\Controller;


use App\Shared\Services\Utils\ServiceName;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SkBibiothequeController extends Controller
{

    /**
     * @return Response
     */
    public function searchUserAction()
    {
        return $this->render('AdminBundle:SkBook:reservation.html.twig', array());
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function searchAction(Request $request)
    {
        $requestString = $request->get('q');
        $entities = $this->get(ServiceName::SRV_METIER_USER)->findEntitiesByString($requestString);
        if (!$entities) {
            $result['entities']['error'] = "Aucun correspondance";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }

        return new Response(json_encode($result));
    }

    /**
     * @param $entities
     * @return mixed
     */
    public function getRealEntities($entities)
    {
        foreach ($entities as $entity) {
            $realEntities[$entity->getId()] = $entity->getUserName();
        }
        return $realEntities;
    }
}