<?php
/**
 * Created by PhpStorm.
 * User: julkwel
 * Date: 3/27/19
 * Time: 11:01 PM.
 */

namespace App\Bundle\Admin\Controller;

use App\Shared\Entity\SkClasse;
use App\Shared\Entity\SkEdt;
use App\Shared\Entity\SkEtudiant;
use App\Shared\Entity\SkMatiere;
use App\Shared\Form\SkEdtType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkEdtController extends Controller
{
    public function getUserConnected()
    {
        return $this->get('security.token_storage')->getToken()->getUser();
    }

    public function getEntityService()
    {
        return $this->get('sk.repository.entity');
    }

    /**
     * @param SkClasse $skClasse
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(SkClasse $skClasse)
    {
        $_edt = $this->getDoctrine()->getRepository(SkEdt::class)->findBy(array('edtClasse' => $skClasse));

        return $this->render('@Admin/SkClasse/edt.html.twig', array(
            'classe' => $skClasse,
            'edt' => $_edt,
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function etudiantEdtAction()
    {
        $_user_classe = $this->getDoctrine()->getRepository(SkEtudiant::class)->findBy(array(
            'etsNom' => $this->getUserConnected()->getEtsNom(),
            'etudiant' => $this->getUserConnected(),
        ));

        $_edt = $this->getDoctrine()->getRepository(SkEdt::class)->findBy(array('edtClasse' => $_user_classe[0]->getClasse()->getId()));

        return $this->render('@Admin/SkClasse/etudiant.edt.html.twig', array(
            'classe' => $_user_classe,
            'edt' => $_edt,
        ));
    }

    /**
     * @param Request  $request
     * @param SkClasse $skClasse
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addEdtAction(Request $request, SkClasse $skClasse)
    {
        /*
         * Secure to etudiant connected
         */
        if ($this->get('security.authorization_checker')->isGranted('ROLE_ETUDIANT')) {
            return $this->redirectToRoute('sk_login');
        }

        try {
            $_edt = new SkEdt();
            $_user_ets = $this->getUserConnected()->getEtsNom();
            $_form = $this->createForm(SkEdtType::class, $_edt);
            $_form->handleRequest($request);
            $_mat_list = $this->getDoctrine()->getRepository(SkMatiere::class)->findBy(array('matClasse' => $skClasse));

            if ($_form->isSubmitted() && $_form->isValid()) {
                try {
                    $_mat = $request->request->get('matiere');
                    $_date_debut = $request->request->get('debut');
                    $_date_fin = $request->request->get('fin');
                    if (new \DateTime($_date_debut) > new \DateTime($_date_fin)) {
                        $this->getEntityService()->setFlash('error', 'Date debut > Date Fin');
                        return $this->redirect($this->generateUrl('edt_new', array('id'=>$skClasse->getId())));
                    }
                    $_mat = $this->getDoctrine()->getRepository(SkMatiere::class)->find($_mat);
                    $_edt->setEtsNom($_user_ets);
                    $_edt->setMatNom($_mat);
                    $_edt->setEdtClasse($skClasse);
                    $_edt->setEtdDateDeb(new \DateTime($_date_debut));
                    $_edt->setEtdDateFin(new \DateTime($_date_fin));
                    try {
                        $this->getEntityService()->saveEntity($_edt, 'new');
                    } catch (\Exception $exception) {
                        $exception->getMessage();
                    }
                    $this->getEntityService()->setFlash('success', 'Emploi du temps ajouté avec success');
                } catch (\Exception $exception) {
                    $exception->getMessage();
                }

                return $this->redirect($this->generateUrl('classe_edt', array('id' => $skClasse->getId())));
            }
        } catch (\Exception $exception) {
            $exception->getMessage();
        }

        return $this->render('@Admin/SkClasse/template.html.twig', array(
            'matieres' => $_mat_list,
            'edt' => $_edt,
            'classe' => $skClasse,
            'form' => $_form->createView(),
        ));
    }
}
