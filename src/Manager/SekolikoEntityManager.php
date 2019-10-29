<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Manager;

use App\Constant\EntityConstant;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

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
     * @param object $entity
     * @param User   $user
     *
     * @return bool
     */
    public function save($entity, User $user)
    {
        if (method_exists($entity, 'setEtsName')) {
            $entity->setEtsName($user->getEtsName());
        }
        if (method_exists($entity, 'setSchoolYear')) {
            $entity->setSchoolYear($user->getSchoolYear());
        }

        try {
            if (!$entity->getId()) {
                $this->em->persist($entity);
            }
            $this->em->flush();

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * @param $entity
     *
     * @return bool
     */
    public function remove($entity)
    {
        try {
            $this->em->remove($entity);
            $this->em->flush();

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}
