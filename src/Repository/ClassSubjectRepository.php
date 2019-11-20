<?php

namespace App\Repository;

use App\Entity\ClassSubject;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ClassSubject|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassSubject|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassSubject[]    findAll()
 * @method ClassSubject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassSubjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassSubject::class);
    }

    /**
     * @param User $user
     * @param      $class
     *
     * @return mixed
     */
    public function findByClass(User $user, $class)
    {
        return $this->createQueryBuilder('sc')
            ->where('sc.deletedAt is NULL')
            ->andWhere('sc.classRoom = :class')
            ->andWhere('sc.schoolYear = :year')
            ->setParameter('year', $user->getSchoolYear())
            ->setParameter('class', $class)
            ->orderBy('sc.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
