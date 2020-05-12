<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 */

namespace App\Controller\Documentation;

use App\Constant\MessageConstant;
use App\Controller\AbstractBaseController;
use App\Entity\Docs;
use App\Entity\User;
use App\Form\DocsType;
use App\Helper\HistoryHelper;
use App\Manager\SekolikoEntityManager;
use App\Repository\DocsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SekolikoDocsController.
 *
 * @Route("/{_locale}/admin/docs")
 */
class SekolikoDocsController extends AbstractBaseController
{
    /** @var DocsRepository */
    private $docsRepository;

    /**
     * SekolikoDocsController constructor.
     *
     * @param EntityManagerInterface       $manager
     * @param SekolikoEntityManager        $entityManager
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param DocsRepository               $docsRepository
     * @param HistoryHelper|null           $historyHelper
     */
    public function __construct(EntityManagerInterface $manager, SekolikoEntityManager $entityManager, UserPasswordEncoderInterface $passwordEncoder, DocsRepository $docsRepository, HistoryHelper $historyHelper = null)
    {
        parent::__construct($manager, $entityManager, $passwordEncoder, $historyHelper);
        $this->docsRepository = $docsRepository;
    }

    /**
     * @Route("/", name="docs_accueil", methods={"GET"})
     *
     * @return Response
     */
    public function docs()
    {
        $docs = $this->docsRepository->findAll();

        return $this->render('admin/content/Docs/_index.html.twig', ['docs' => $docs]);
    }

    /**
     * @Route("/manage/{id?}",name="create_docs",methods={"POST","GET"})
     *
     * @param Request   $request
     * @param Docs|null $docs
     *
     * @return RedirectResponse|Response
     */
    public function manage(Request $request, Docs $docs = null)
    {
        $docs = $docs ?? new Docs();
        $form = $this->createForm(DocsType::class, $docs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->em->save($docs, $this->getUser(), $form)) {
                $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::AJOUT_MESSAGE);

                return $this->redirectToRoute('docs_accueil');
            }

            return $this->redirectToRoute('create_docs', ['id' => $docs->getId()]);
        }

        return $this->render('admin/content/Docs/_manage.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/remove/{id}",name="remove_docs",methods={"POST","GET"})
     *
     * @param Docs $docs
     *
     * @return RedirectResponse
     */
    public function removeDocs(Docs $docs)
    {
        if ($this->em->remove($docs)) {
            $this->addFlash(MessageConstant::SUCCESS_TYPE, MessageConstant::SUPPRESSION_MESSAGE);
        } else {
            $this->addFlash(MessageConstant::ERROR_TYPE, MessageConstant::ERROR_MESSAGE);
        }

        return $this->redirectToRoute('docs_accueil');
    }
}
