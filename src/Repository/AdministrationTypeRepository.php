<?php

namespace App\Repository;

use App\Entity\AdministrationType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AdministrationType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdministrationType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdministrationType[]    findAll()
 * @method AdministrationType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdministrationTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdministrationType::class);
    }
    // /**
    //  * @return AdministrationType[] Returns an array of AdministrationType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdministrationType
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
