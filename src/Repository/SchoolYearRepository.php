<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Repository;

use App\Entity\SchoolYear;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SchoolYear|null find($id, $lockMode = null, $lockVersion = null)
 * @method SchoolYear|null findOneBy(array $criteria, array $orderBy = null)
 * @method SchoolYear[]    findAll()
 * @method SchoolYear[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolYearRepository extends ServiceEntityRepository
{
    /**
     * SchoolYearRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SchoolYear::class);
    }
}
