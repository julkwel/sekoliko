<?php

namespace App\Repository;

use App\Entity\Trimestre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Trimestre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trimestre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trimestre[]    findAll()
 * @method Trimestre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrimestreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Trimestre::class);
    }

    // /**
    //  * @return Trimestre[] Returns an array of Trimestre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trimestre
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
