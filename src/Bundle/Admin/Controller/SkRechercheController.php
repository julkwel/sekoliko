<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 7:46 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Bundle\User\Entity\User;
use App\Shared\Form\FilterUserType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SkRechercheController
 * @package App\Bundle\Admin\Controller
 * @author Max
 */
class SkRechercheController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function searchAction(Request $request)
    {
        $filter = $this->createForm(FilterUserType::class, [], ['router' => $this->get('router')]);
        $filter->handleRequest($request);

        return $this->render('@Admin/SkRecherche/resultat.html.twig', array(
            'filter' => $filter->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return JsonResponse|Response|void
     */
    public function searchResultAjaxAction(Request $request)
    {
        if($request->isXmlHttpRequest()) {
            if(!$this->getUser()) {
                $this->addFlash('danger', "Merci de vous connecter!", Response::HTTP_FORBIDDEN);
            } else {
                $users = $this->getDoctrine()->getRepository(User::class)
                    ->findByFilterQuery($request, $this->getUser()->getEtsNom());
                $userLastNameSearch = $request->query->get('userLastNameSearch');

                if($userLastNameSearch) {
                     return new JsonResponse($users, 200);
                }else{
                    return $this->render('@Admin/SkRecherche/search_result_ajax.html.twig', array(
                        'users' => $users
                    ));
                }

            }
        }
    }

    public function detailsAction(User $user)
    {
        return $this->render('@Admin/SkRecherche/details.html.twig', array(
            'users' => $user,
        ));
    }
}
