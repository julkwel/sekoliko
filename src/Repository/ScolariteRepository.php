<?php

namespace App\Repository;

use App\Entity\Scolarite;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Scolarite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Scolarite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Scolarite[]    findAll()
 * @method Scolarite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScolariteRepository extends ServiceEntityRepository
{
    /**
     * ScolariteRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Scolarite::class);
    }

    /**
     * @param User $user
     * @param      $type
     *
     * @return mixed
     */
    public function findBySchoolYear(User $user, $type)
    {
        $list = $this->createQueryBuilder('s')
            ->where('s.deletedAt is NULL')
            ->andWhere('s.schoolYear = :year')
            ->andWhere('s.etsName = :ets')
            ->andWhere('s.type = :type')
            ->setParameter('ets', $user->getEtsName())
            ->setParameter('year', $user->getSchoolYear()->getId() ?? null)
            ->setParameter('type', $type)
            ->getQuery()
            ->getResult();

        return $list;
    }
}
