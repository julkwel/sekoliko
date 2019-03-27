<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 2:20 PM
 */

namespace App\Bundle\Admin\Controller;


use App\Bundle\User\Entity\User;
use App\Shared\Services\Utils\ServiceName;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SkEtudiant
 * @package App\Bundle\Admin\Controller
 */
class SkEtudiantController extends Controller
{
    /**
     * @return \App\Shared\Repository\SkEntityManager|object
     */
    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @return mixed
     */
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
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
        $_nom           = $_form['nom']->getData();
        $_usrFirstname  = $_form['prenom']->getData();
        $_username      = $_form['username']->getData();
        $_list = '';
        if ($_form->isSubmitted()){
            if (!is_null($_nom)) {
                $_list = $this->get(ServiceName::SRV_METIER_USER)->getUserByNom($_nom);
            } elseif (!is_null($_usrFirstname)) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy(array('usrFirstname' => $_usrFirstname, 'etsNom' => $_user_ets));
            } elseif (!is_null($_username)) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy(array('username' => $_username, 'etsNom' => $_user_ets));
            }
            return $this->render('@Admin/SkEtudiant/resultat.html.twig', array(
                'form' => $_form->createView(),
                'users' => $_list
            ));
        }

        return $this->render('@Admin/SkEtudiant/resultat.html.twig', array(
            'form' => $_form->createView(),
            'users' => $_list
        ));
    }

    public function addEtudiant(Request $request)
    {

    }
}