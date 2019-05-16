<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/4/19
 * Time: 8:56 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Bundle\User\Entity\User;
use App\Shared\Entity\SkClasse;
use App\Shared\Entity\SkEtudiant;
use App\Shared\Entity\SkPaiement;
use App\Shared\Form\SkPaiementType;
use App\Shared\Services\Utils\RoleName;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SkPaiementController extends Controller
{
    public function getAriaryNetPaiement()
    {
        return $this->get('sk.ariary.paiement');
    }

    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function indexAction()
    {
        $_paiement = $this->getEntityService()->getAllListByEts(SkPaiement::class);

        return $this->render('AdminBundle:SkPaiement:index.html.twig', array(
            'paiement' => $_paiement,
        ));
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        $_paiement = new SkPaiement();

        $_form = $this->createForm(SkPaiementType::class);
        $_form->handleRequest($request);
        $_classe_list = $this->getEntityService()->getAllListByEts(SkClasse::class);
        $_month_list = $this->getEntityService()->getMonthList();

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_montant = $request->request->get('montant');
            $_reference = $request->request->get('reference');
            $_user = $request->request->get('user');
            $_mois = $request->request->get('mois');
            $_date = $request->request->get('date');
            $_commentaire = $request->request->get('commentaire');

            $_user ? $_paiement->setUser($this->getDoctrine()->getRepository(User::class)->find($_user)) : '';
            $_paiement->setDate(new \DateTime($_date));
            $_paiement->setMontant($_montant);
            $_paiement->setReference($_reference);
            $_paiement->setCommentaire($_commentaire ? $_commentaire : $_mois);

            $this->getEntityService()->saveEntity($_paiement, 'new');
            $this->getEntityService()->setFlash('success', 'paiement ajouté');

            return $this->redirectToRoute('paiement_list');
        }

        return $this->render('AdminBundle:SkPaiement:add.html.twig', array(
            'form' => $_form->createView(),
            'classe' => $_classe_list,
            'month' => $_month_list,
        ));
    }

    /**
     * @param SkPaiement $skPaiement
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(SkPaiement $skPaiement)
    {
        return $this->render('AdminBundle:SkPaiement:details.html.twig', array(
            'paiement' => $skPaiement,
        ));
    }

    /**
     * @return JsonResponse
     */
    public function findUserAction()
    {
        $_array_type = array(
            'etsNom' => $this->getUserConnected()->getEtsNom(),
            'asName' => $this->getUserConnected()->getAsName(),
            'skRole' => array(
                RoleName::ID_ROLE_ADMIN,
                RoleName::ID_ROLE_PROFS,
            ),
        );
        $_user_list_item = [];

        $_user_list = $this->getDoctrine()->getRepository(User::class)->findBy($_array_type);

        foreach ($_user_list as $key => $value) {
            $_user_list_item[$key]['username'] = $value->getUsername();
            $_user_list_item[$key]['id'] = $value->getId();
        }

        return new JsonResponse($_user_list_item);
    }

    /**
     * @param $classe
     *
     * @return JsonResponse
     */
    public function findEtudiantAction($classe)
    {
        $_user_list_item = [];
        $_user_list = $this->getDoctrine()->getRepository(SkEtudiant::class)->findBy(array(
            'asName' => $this->getUserConnected()->getAsName(),
            'classe' => $this->getDoctrine()->getRepository(SkClasse::class)->find($classe),
            'etsNom' => $this->getUserConnected()->getEtsNom(),
        ));

        foreach ($_user_list as $key => $value) {
            $_user_list_item[$key]['username'] = $value->getEtudiant()->getUsername();
            $_user_list_item[$key]['id'] = $value->getEtudiant()->getId();
        }

        return new JsonResponse($_user_list_item);
    }

    /**
     * @param $_panie_id
     * @param $_montant
     * @param $_user_id
     * @param $_reference
     * @param $_addresse
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Exception
     */
    public function addPaiement($_panie_id, $_montant, $_user_id, $_reference, $_addresse)
    {
        $_add_paiement = $this->getAriaryNetPaiement()->initPayAriary($_panie_id, $_montant, $_user_id, $_reference, $_addresse);

        return $_add_paiement;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction()
    {
        return $this->render('AdminBundle:SkPaiement:edit.html.twig');
    }

//    /**
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function detailsAction()
//    {
//        return $this->render('AdminBundle:SkPaiement:details.html.twig');
//    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction()
    {
        return $this->redirectToRoute('paiement_list');
    }
}
