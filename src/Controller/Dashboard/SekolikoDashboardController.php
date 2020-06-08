<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 */

namespace App\Controller\Dashboard;

use App\Controller\AbstractBaseController;
use App\Entity\Administrator;
use App\Entity\User;
use App\Helper\HistoryHelper;
use App\Manager\SekolikoEntityManager;
use App\Repository\AdministratorRepository;
use App\Repository\RoomRepository;
use App\Repository\ScolariteRepository;
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

    /** @var ScolariteRepository */
    private $profsRepository;

    /** @var AdministratorRepository */
    private $adminRepository;

    /**
     * SekolikoDashboardController constructor.
     *
     * @param EntityManagerInterface       $manager
     * @param SekolikoEntityManager        $entityManager
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param StudentRepository            $studentRepository
     * @param RoomRepository               $roomRepository
     * @param ScolariteRepository          $scolariteRepository
     * @param AdministratorRepository      $administratorRepository
     * @param HistoryHelper|null           $historyHelper
     */
    public function __construct(EntityManagerInterface $manager, SekolikoEntityManager $entityManager, UserPasswordEncoderInterface $passwordEncoder, StudentRepository $studentRepository, RoomRepository $roomRepository, ScolariteRepository $scolariteRepository, AdministratorRepository $administratorRepository, HistoryHelper $historyHelper = null)
    {
        parent::__construct($manager, $entityManager, $passwordEncoder, $historyHelper);
        $this->roomRepository = $roomRepository;
        $this->studentRepository = $studentRepository;
        $this->profsRepository = $scolariteRepository;
        $this->adminRepository = $administratorRepository;
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
        /** @var User $user */
        $user = $this->getUser();
        return $this->render(
            'admin/content/_dashboard_admin.html.twig',
            [
                'data' => 'Hello',
                'students' => $this->studentRepository->findAllBySchool($user),
                'profs' => $this->profsRepository->findProfs($user),
                'rooms' => $this->roomRepository->findBySchoolYear($user, true),
                'admins' => count($this->adminRepository->findBySchoolYear($user)),
            ]
        );
    }
}
