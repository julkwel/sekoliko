<?php

namespace App\Repository;

use App\Entity\ClasseMatiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClasseMatiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClasseMatiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClasseMatiere[]    findAll()
 * @method ClasseMatiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseMatiereRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClasseMatiere::class);
    }

    // /**
    //  * @return ClasseMatiere[] Returns an array of ClasseMatiere objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClasseMatiere
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
