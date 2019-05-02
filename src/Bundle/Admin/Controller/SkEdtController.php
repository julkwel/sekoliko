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
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $_edt = $this->getDoctrine()->getRepository(SkEdt::class)->findBy(array(
            'edtClasse' => $skClasse,
            'asName' => $this->getUserConnected()->getAsName(), )
        );

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
            'asName' => $this->getUserConnected()->getAsName(),
        ));

        $_edt = $this->getDoctrine()->getRepository(SkEdt::class)->findBy(array(
            'edtClasse' => $_user_classe[0]->getClasse()->getId(),
            'asName' => $this->getUserConnected()->getAsName(),
        ));

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
            $_form = $this->createForm(SkEdtType::class, $_edt);
            $_form->handleRequest($request);
            $_mat_list = $this->getDoctrine()->getRepository(SkMatiere::class)->findBy(array(
                'matClasse' => $skClasse,
                'asName' => $this->getUserConnected()->getAsName(),
            ));

            if ($_form->isSubmitted() && $_form->isValid()) {
                try {
                    $_mat = $request->request->get('matiere');
                    $_date_debut = $request->request->get('debut');
                    $_date_fin = $request->request->get('fin');
                    if (new \DateTime($_date_debut) > new \DateTime($_date_fin)) {
                        $this->getEntityService()->setFlash('error', 'Date début > Date Fin');

                        return $this->redirect($this->generateUrl('edt_new', array('id' => $skClasse->getId())));
                    }
                    $_mat = $this->getDoctrine()->getRepository(SkMatiere::class)->find($_mat);
                    $_edt->setMatNom($_mat);
                    $_edt->setEdtClasse($skClasse);
                    $_edt->setEtdDateDeb(new \DateTime($_date_debut));
                    $_edt->setEtdDateFin(new \DateTime($_date_fin));
                    try {
                        $this->getEntityService()->saveEntity($_edt, 'new');
                    } catch (\Exception $exception) {
                        $exception->getMessage();
                    }
                    $this->getEntityService()->setFlash('success', 'Ajout de l\'emplois du temps effectué');
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
            'add' => true,
        ));
    }

    /**
     * @param Request $request
     * @param SkEdt   $skEdt
     *
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function editAction(Request $request, SkEdt $skEdt)
    {
        $_form = $this->createForm(SkEdtType::class, $skEdt);
        $_form->handleRequest($request);
        $_mat_list = $this->getDoctrine()->getRepository(SkMatiere::class)->findBy(array(
            'matClasse' => $skEdt->getEdtClasse()->getId(),
            'asName' => $this->getUserConnected()->getAsName(),
        ));

        if ('POST' == $request->getMethod()) {
            $_mat = $request->request->get('matiere');
            $_date_debut = $request->request->get('start');
            $_date_fin = $request->request->get('end');

            if (new \DateTime($_date_debut) > new \DateTime($_date_fin)) {
                $this->getEntityService()->setFlash('error', 'Date début > Date Fin');
            }
            $_mat = $this->getDoctrine()->getRepository(SkMatiere::class)->find($_mat);
            $skEdt->setMatNom($_mat);
            $skEdt->setEtdDateDeb(new \DateTime($_date_debut));
            $skEdt->setEtdDateFin(new \DateTime($_date_fin));
            try {
                $this->getEntityService()->saveEntity($skEdt, 'update');
            } catch (\Exception $exception) {
                $exception->getMessage();
            }

            return new JsonResponse('ok', 200);
        }

        return $this->render('@Admin/SkClasse/edt.edit.html.twig', array(
            'matieres' => $_mat_list,
            'edt' => $skEdt,
            'classe' => $skEdt->getEdtClasse(),
            'form' => $_form->createView(),
            'add' => true,
        ));
    }
}
