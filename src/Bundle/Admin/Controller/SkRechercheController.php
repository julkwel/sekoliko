<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 7:46 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Bundle\User\Entity\User;
use App\Shared\Services\Utils\RoleName;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;

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
        $_form = $this->createFormBuilder()
            ->add('nom', TextType::class, array('required' => false))
            ->add('prenom', TextType::class, array('required' => false))
            ->add('username', TextType::class, array('required' => false))
            ->getForm();
        $_user_ets = $this->container->get('security.token_storage')->getToken()->getUser()->getEtsNom();

        $_form->handleRequest($request);
        $_nom = $_form['nom']->getData();
        $_usrFirstname = $_form['prenom']->getData();
        $_username = $_form['username']->getData();
        $_list = '';

        $_array_type = array(
            'etsNom' => $_user_ets,
        );

        if ($_form->isSubmitted()) {
            if (!is_null($_nom)) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy(array(
                    'usrLastname' => $_nom,
                    'etsNom' => $_user_ets,
                    'skRole' => array(
                        RoleName::ID_ROLE_ETUDIANT,
                    ),
                ));
            } elseif (!is_null($_usrFirstname)) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy(array(
                    'usrFirstname' => $_usrFirstname,
                    'etsNom' => $_user_ets,
                    'skRole' => array(
                        RoleName::ID_ROLE_ETUDIANT,
                    ),
                ));
            } elseif (!is_null($_username)) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy(array(
                    'username' => $_username,
                    'etsNom' => $_user_ets,
                    'skRole' => array(
                        RoleName::ID_ROLE_ETUDIANT,
                    ),
                ));
            } elseif (null === $_nom && null === $_usrFirstname && null === $_username) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy($_array_type, array('id' => 'DESC'));
            }

            return $this->render('@Admin/SkRecherche/resultat.html.twig', array(
                'form' => $_form->createView(),
                'users' => $_list,
            ));
        }

        return $this->render('@Admin/SkRecherche/resultat.html.twig', array(
            'form' => $_form->createView(),
            'users' => $_list,
        ));
    }

    public function detailsAction(User $user)
    {
        return $this->render('@Admin/SkRecherche/details.html.twig', array(
            'users' => $user,
        ));
    }
}
