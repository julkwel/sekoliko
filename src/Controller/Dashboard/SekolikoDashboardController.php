<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 */

namespace App\Controller\Dashboard;

use App\Controller\AbstractBaseController;
use App\Helper\HistoryHelper;
use App\Manager\SekolikoEntityManager;
use App\Repository\RoomRepository;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class SekolikoDashboardController.
 *
 * @Route("/{_locale}/admin")
 */
class SekolikoDashboardController extends AbstractBaseController
{
    /** @var StudentRepository */
    private $studentRepository;

    /** @var RoomRepository */
    private $roomRepository;

    /** @var  */
    private $profsRepository;

    /**
     * SekolikoDashboardController constructor.
     *
     * @param EntityManagerInterface       $manager
     * @param SekolikoEntityManager        $entityManager
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param StudentRepository            $studentRepository
     * @param RoomRepository               $roomRepository
     * @param HistoryHelper|null           $historyHelper
     */
    public function __construct(EntityManagerInterface $manager, SekolikoEntityManager $entityManager, UserPasswordEncoderInterface $passwordEncoder, StudentRepository $studentRepository, RoomRepository $roomRepository, HistoryHelper $historyHelper = null)
    {
        parent::__construct($manager, $entityManager, $passwordEncoder, $historyHelper);
        $this->roomRepository = $roomRepository;
        $this->studentRepository = $studentRepository;
    }

    /**
     * @Route("/dashboard",name="admin_dashboard",methods={"POST","GET"})
     *
     * @return Response
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function dashboardController(): Response
    {
        $students = $this->studentRepository->findAllBySchool($this->getUser());

        return $this->render(
            'admin/content/_dashboard_admin.html.twig',
            [
                'data' => 'Hello',
                'students' => $students,
            ]
        );
    }
}
