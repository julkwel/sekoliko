<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 2:20 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Bundle\User\Entity\User;
use App\Shared\Entity\SkClasse;
use App\Shared\Entity\SkEtudiant;
use App\Shared\Form\SkEtudiantType;
use App\Shared\Services\Utils\RoleName;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SkEtudiant.
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
        $_user_as = $this->container->get('security.token_storage')->getToken()->getUser()->getAsName();

        $_form->handleRequest($request);
        $_nom = $_form['nom']->getData();
        $_usrFirstname = $_form['prenom']->getData();
        $_username = $_form['username']->getData();
        $_list = '';

        $_array_type = array(
            'skRole' => array(
                RoleName::ID_ROLE_ETUDIANT,
            ),
            'etsNom' => $_user_ets,
        );

        if ($_form->isSubmitted()) {
            if (!is_null($_nom)) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy(array(
                    'usrLastname' => $_nom,
                    'etsNom' => $_user_ets,
                    'asName' => $_user_as,
                    'skRole' => array(
                        RoleName::ID_ROLE_ETUDIANT,
                    ),
                ));
            } elseif (!is_null($_usrFirstname)) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy(array(
                    'usrFirstname' => $_usrFirstname,
                    'etsNom' => $_user_ets,
                    'asName' => $_user_as,
                    'skRole' => array(
                        RoleName::ID_ROLE_ETUDIANT,
                    ),
                ));
            } elseif (!is_null($_username)) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy(array(
                    'username' => $_username,
                    'etsNom' => $_user_ets,
                    'asName' => $_user_as,
                    'skRole' => array(
                        RoleName::ID_ROLE_ETUDIANT,
                    ),
                ));
            } elseif (null === $_nom && null === $_usrFirstname && null === $_username) {
                $_list = $this->getDoctrine()->getRepository(User::class)->findBy($_array_type, array('id' => 'DESC'));
            }

            return $this->render('@Admin/SkEtudiant/resultat.html.twig', array(
                'form' => $_form->createView(),
                'users' => $_list,
            ));
        }

        return $this->render('@Admin/SkEtudiant/resultat.html.twig', array(
            'form' => $_form->createView(),
            'users' => $_list,
        ));
    }

    /**
     * @param Request $request
     * @param User    $user
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, User $user)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        try {
            $_ets = $this->getUserConnected()->getEtsNom();
            $_classe_list = $this->getDoctrine()->getRepository(SkClasse::class)->findBy(array(
                'etsNom' => $_ets,
                'asName' => $this->getUserConnected()->getAsName(),
            ));

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
                    $this->getEntityService()->setFlash('success', 'Ajout de l\'etudiant(e) effectué(e)');
                } catch (\Exception $exception) {
                    $exception->getMessage();
                }

                return $this->redirectToRoute('etudiant_search');
            }
        } catch (\Exception $exception) {
            $exception->getMessage();
        }

        return $this->render('AdminBundle:SkEtudiant:add.html.twig', array(
            'user' => $user,
            'classe' => $_classe_list,
            'form' => $_form->createView(),
            'etudiant' => $_etudiant,
        ));
    }

    /**
     * @param Request    $request
     * @param SkEtudiant $skEtudiant
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, SkEtudiant $skEtudiant)
    {
//        dump($skEtudiant->getClasse());die();
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        $_ets = $this->getUserConnected()->getEtsNom();
        $_classe_list = $this->getDoctrine()->getRepository(SkClasse::class)->findBy(array('etsNom' => $_ets));

        $_form = $this->createForm(SkEtudiantType::class, $skEtudiant);
        $_form->handleRequest($request);

        if ($_form->isSubmitted() && $_form->isValid()) {
            $_class = $request->request->get('classe');
            $_class = $this->getDoctrine()->getRepository(SkClasse::class)->find($_class);

            $skEtudiant->setClasse($_class);
            try {
                $this->getEntityService()->saveEntity($skEtudiant, 'update');
                $this->getEntityService()->setFlash('success', 'Etudiant(e) mis à jour');
            } catch (\Exception $exception) {
                $exception->getMessage();
            }

            return $this->redirect($this->generateUrl('etudiant_liste', array('id' => $skEtudiant->getClasse()->getId())));
        }

        return $this->render('@Admin/SkEtudiant/edit.etudiant.html.twig', array(
            'form' => $_form->createView(),
            'etudiant' => $skEtudiant,
            'classe' => $skEtudiant->getClasse(),
        ));
    }

    /**
     * @param SkEtudiant $skEtudiant
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailsAction(SkEtudiant $skEtudiant)
    {
        return $this->render('@Admin/SkEtudiant/details.html.twig', [
            'etudiant' => $skEtudiant,
        ]);
    }

    /**
     * generate pdf fiche etudiant
     * @param SkEtudiant $skEtudiant
     * @return PdfResponse
     */
    public function fichePdfAction(SkEtudiant $skEtudiant){
        $html =  $this->renderView('pdf/ficheEtudiant.html.twig',[
           'etudiant' => $skEtudiant
        ]);

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'fiche_etudiant'
        );
    }

    /**
     * Renvoie un étudiant.
     *
     * @param Request    $request
     * @param SkEtudiant $skEtudiant
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function renvoieAction(Request $request, SkEtudiant $skEtudiant)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            if (true === $skEtudiant->getEtudiant()->isEnabled()) {
                if ($request->isMethod('POST')) {
                    $skEtudiant->setMotifRenvoie($request->request->get('motif'));
                    $skEtudiant->getEtudiant()->setEnabled(0);
                    $skEtudiant->setDateRenvoie(new \DateTime('now'));
                    $skEtudiant->setIsRenvoie(1);
                    $this->getEntityService()->saveEntity($skEtudiant, 'update');
                    if ($skEtudiant->getEtudiant()->setEnabled(0)) {
                        return $this->redirect($this->generateUrl('etudiant_liste', array('id' => $skEtudiant->getClasse()->getId())));
                    }
                }

                return $this->render('@Admin/SkEtudiant/confirmation.renvoie.html.twig', [
                    'etudiant' => $skEtudiant,
                ]);
            }
            $this->getEntityService()->setFlash('error', 'l\'utilisateur est déja renvoyé');

            return $this->redirect($this->generateUrl('etudiant_liste', array('id' => $skEtudiant->getClasse()->getId())));
        }

        return $this->redirectToRoute('fos_user_security_logout');
    }

    /**
     * @param SkEtudiant $skEtudiant
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function restoreUserAction(SkEtudiant $skEtudiant)
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            $skEtudiant->getEtudiant()->setEnabled(1);
            $skEtudiant->setIsRenvoie(false);
            $this->getEntityService()->saveEntity($skEtudiant, 'update');
            if ($skEtudiant->getEtudiant()->setEnabled(1)) {
                return $this->redirect($this->generateUrl('etudiant_liste', array('id' => $skEtudiant->getClasse()->getId())));
            }
        }

        return $this->redirectToRoute('fos_user_security_logout');
    }

    /**
     * Liste des étudiants dans la classe de l'étudiant connecté.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function myCollegueAction()
    {
        $_user_classe = $this->getDoctrine()->getRepository(SkEtudiant::class)->findBy(array(
            'etsNom' => $this->getUserConnected()->getEtsNom(),
            'etudiant' => $this->getUserConnected(),
            'asName' => $this->getUserConnected()->getAsName(),
        ));

        $_user_col = $this->getDoctrine()->getRepository(SkEtudiant::class)->findBy(array(
            'etsNom' => $this->getUserConnected()->getEtsNom(),
            'classe' => $_user_classe[0]->getClasse(),
            'asName' => $this->getUserConnected()->getAsName(),
        ));

        return $this->render('@Admin/SkEtudiant/collegue.html.twig', array(
            'user' => $_user_col,
            'classe' => $_user_classe[0]->getClasse(),
        ));
    }
}
