<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 */

namespace App\Controller;

use App\Helper\HistoryHelper;
use App\Manager\SekolikoEntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AbstractBaseController.
 */
abstract class AbstractBaseController extends AbstractController
{
    protected EntityManagerInterface $manager;

    protected UserPasswordEncoderInterface $passencoder;

    protected SekolikoEntityManager $em;

    protected ?HistoryHelper $history;

    /**
     * AbstractBaseController constructor.
     *
     * @param EntityManagerInterface       $manager
     * @param SekolikoEntityManager        $entityManager
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param HistoryHelper|null           $historyHelper
     */
    public function __construct(EntityManagerInterface $manager, SekolikoEntityManager $entityManager, UserPasswordEncoderInterface $passwordEncoder, HistoryHelper $historyHelper = null)
    {
        $this->manager = $manager;
        $this->em = $entityManager;
        $this->passencoder = $passwordEncoder;
        $this->history = $historyHelper;
    }
}
