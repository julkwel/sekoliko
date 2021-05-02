<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    /**
     * SessionRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    /**
     * @param $schoolYear
     * @param $etsName
     *
     * @return mixed
     */
    public function findByScoolYear($schoolYear, $etsName)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.deletedAt IS NULL')
            ->andWhere('s.schoolYear = :year')
            ->andWhere('s.etsName = :etsName')
            ->setParameter('etsName', $etsName)
            ->setParameter('year', $schoolYear)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
