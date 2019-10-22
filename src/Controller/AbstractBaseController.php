<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 */

namespace App\Controller;

use App\Manager\SekolikoEntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AbstractBaseController
 *
 * @package App\Controller
 */
abstract class AbstractBaseController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $manager;

    /**
     * @var SekolikoEntityManager
     */
    protected $em;

    /**
     * AbstractBaseController constructor.
     *
     * @param EntityManagerInterface $manager
     * @param SekolikoEntityManager  $entityManager
     */
    public function __construct(EntityManagerInterface $manager, SekolikoEntityManager $entityManager)
    {
        $this->manager = $manager;
        $this->em = $entityManager;
    }
}
