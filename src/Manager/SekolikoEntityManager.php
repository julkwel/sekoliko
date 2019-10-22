<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Manager;

use App\Constant\EntityConstant;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class SekolikoEntityManager
 *
 * @package App\Manager
 */
class SekolikoEntityManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * SekolikoEntityManager constructor.
     *
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->em = $manager;
    }

    /**
     * @param object      $entity
     * @param User        $user
     * @param string|null $method
     *
     * @return bool
     */
    public function save($entity, User $user, $method = null)
    {
        if (method_exists($entity, 'setEtsName')) {
            $entity->setEtsName($user->getEtsName());
        }

        if (EntityConstant::NEW === $method) {
            $this->em->persist($entity);
        }
        $this->em->flush();

        return true;
    }
}
