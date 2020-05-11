<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Repository;

use App\Entity\Docs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Docs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Docs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Docs[]    findAll()
 * @method Docs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Docs::class);
    }

    // /**
    //  * @return Docs[] Returns an array of Docs objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Docs
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
