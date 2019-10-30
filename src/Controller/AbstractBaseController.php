<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 */

namespace App\Controller;

use App\Manager\SekolikoEntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AbstractBaseController.
 */
abstract class AbstractBaseController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $manager;

    /**
     * @var UserPasswordEncoderInterface
     */
    protected $passencoder;

    /**
     * @var SekolikoEntityManager
     */
    protected $em;

    /**
     * AbstractBaseController constructor.
     *
     * @param EntityManagerInterface       $manager
     * @param SekolikoEntityManager        $entityManager
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(EntityManagerInterface $manager, SekolikoEntityManager $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->manager = $manager;
        $this->em = $entityManager;
        $this->passencoder = $passwordEncoder;
    }
}
