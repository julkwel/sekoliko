<?php

namespace App\Repository;

use App\Entity\Administrator;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Administrator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Administrator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Administrator[]    findAll()
 * @method Administrator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdministratorRepository extends ServiceEntityRepository
{
    /**
     * AdministratorRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Administrator::class);
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function findBySchoolYear(User $user)
    {
        $list = $this->createQueryBuilder('a')
            ->where('a.deletedAt is NULL')
            ->andWhere('a.schoolYear = :year')
            ->andWhere('a.etsName = :ets')
            ->setParameter('ets', $user->getEtsName())
            ->setParameter('year', $user->getSchoolYear()->getId() ?? null)
            ->getQuery()
            ->getResult();

        return $list;
    }
}
