<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 2:20 PM
 */

namespace App\Bundle\Admin\Controller;


use App\Bundle\User\Entity\User;
use App\Shared\Entity\SkClasse;
use App\Shared\Entity\SkEtudiant;
use App\Shared\Form\SkEtudiantType;
use App\Shared\Services\Utils\RoleName;
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
        $_nom = $_form['nom']->getData();
        $_usrFirstname = $_form['prenom']->getData();
        $_username = $_form['username']->getData();
        $_list = '';

        $_array_type = array(
            'skRole' => array(
                RoleName::ID_ROLE_ETUDIANT,
            ),
        );

        if ($_form->isSubmitted()) {
            if (!is_null($_nom)) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy(array(
                    'usrLastname' => $_nom,
                    'etsNom' => $_user_ets,
                    'skRole' => array(
                        RoleName::ID_ROLE_ETUDIANT
                    )
                ));
            }
            elseif (!is_null($_usrFirstname)) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy(array(
                    'usrFirstname' => $_usrFirstname,
                    'etsNom' => $_user_ets,
                    'skRole' => array(
                        RoleName::ID_ROLE_ETUDIANT,
                    )
                ));
            }
            elseif (!is_null($_username)) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy(array(
                    'username' => $_username,
                    'etsNom' => $_user_ets,
                    'skRole' => array(
                        RoleName::ID_ROLE_ETUDIANT,
                    )
                ));
            }
            elseif ($_nom === null && $_usrFirstname === null && $_username === null) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy($_array_type, array('id' => 'DESC'));
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

    public function newAction(Request $request, User $user)
    {
        $_ets = $this->getUserConnected()->getEtsNom();
        $_classe_list = $this->getDoctrine()->getRepository(SkClasse::class)->findBy(array('etsNom' => $_ets));

        $_etudiant = new SkEtudiant();
        $_form = $this->createForm(SkEtudiantType::class, $_etudiant);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_class = $request->request->get('classe');
            $_class = $this->getDoctrine()->getRepository(SkClasse::class)->find($_class);

            $_etudiant->setClasse($_class);
            $_etudiant->setEtudiant($user);
            try {
                $this->getEntityService()->saveEntity($_etudiant, 'new');
                $this->getEntityService()->setFlash('success', 'Ajout etudiant avec success');
            } catch (\Exception $exception) {
                $exception->getMessage();
            }
            return $this->redirectToRoute('etudiant_search');
        }

        return $this->render('AdminBundle:SkEtudiant:add.html.twig', array(
            'user' => $user,
            'classe' => $_classe_list,
            'form' => $_form->createView(),
            'etudiant' => $_etudiant
        ));
    }
}