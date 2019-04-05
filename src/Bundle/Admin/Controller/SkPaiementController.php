<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 4/4/19
 * Time: 8:56 PM
 */

namespace App\Bundle\Admin\Controller;


use App\Bundle\User\Entity\User;
use App\Shared\Entity\SkPaiement;
use App\Shared\Form\SkPaiementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @throws \Exception
     */
    public function indexAction()
    {
        $_paiement = $this->getEntityService()->getAllListByEts(SkPaiement::class);
        return $this->render('AdminBundle:SkPaiement:index.html.twig', array(
            'paiement' => $_paiement
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function newAction(Request $request)
    {
        $_user_ets = $this->getUserConnected()->getEtsNom();
        $_paiement = new SkPaiement();

        $_form = $this->createForm(SkPaiementType::class);
        $_form->handleRequest($request);
        $_user_list = $this->getEntityService()->getAllListByEts(User::class);

        if ($_form->isSubmitted() && $_form->isValid()) {

            $_panie_id = rand(100, 100000);
            $_user_id = $request->request->get('user');
            $_find_user = $this->getEntityService()->getEntityById(User::class, $_user_id);
            $_montant = $request->request->get('montant');
            $_reference = $request->request->get('reference');
            $_date = $request->request->get('date');

            $_paiement->setDate(new  \DateTime($_date));
            $_paiement->setMontant($_montant);
            $_paiement->setReference($_reference);
            $_paiement->setEtsNom($_user_ets);
            $_paiement->setUser(array($_find_user));
            $_addresse = '104.236.254.239';

            return $this->addPaiement($_panie_id, $_montant, $_user_id, $_reference, $_addresse);
        }

        return $this->render('AdminBundle:SkPaiement:add.html.twig', array(
            'form' => $_form->createView(),
            'user' => $_user_list
        ));
    }

    /**
     * @param $_panie_id
     * @param $_montant
     * @param $_user_id
     * @param $_reference
     * @param $_addresse
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */

    public function addPaiement($_panie_id, $_montant, $_user_id, $_reference, $_addresse){

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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailsAction()
    {
        return $this->render('AdminBundle:SkPaiement:details.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction()
    {
        return $this->redirectToRoute('paiement_list');
    }
}