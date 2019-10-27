<?php

namespace App\Repository;

use App\Entity\ScolariteType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ScolariteType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScolariteType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScolariteType[]    findAll()
 * @method ScolariteType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScolariteTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ScolariteType::class);
    }

    // /**
    //  * @return ScolariteType[] Returns an array of ScolariteType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ScolariteType
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
