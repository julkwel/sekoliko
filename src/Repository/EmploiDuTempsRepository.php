<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Repository;

use App\Entity\EmploiDuTemps;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmploiDuTemps|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmploiDuTemps|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmploiDuTemps[]    findAll()
 * @method EmploiDuTemps[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmploiDuTempsRepository extends ServiceEntityRepository
{
    /**
     * EmploiDuTempsRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmploiDuTemps::class);
    }
}
