<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $role
     * @param string $etsName
     *
     * @return User[] Returns an array of User objects
     */
    public function findByRoles(string $role,string $etsName)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.roles = :val')
            ->andWhere('u.etsName = :etsName')
            ->setParameter('val', '%"'.$role.'"%')
            ->setParameter('etsName', $etsName)
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
