<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Repository;

use App\Entity\Scolarite;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

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
        return $this->createQueryBuilder('s')
            ->where('s.deletedAt is NULL')
            ->andWhere('s.schoolYear = :year')
            ->andWhere('s.etsName = :ets')
            ->andWhere('s.type = :type')
            ->setParameter('ets', $user->getEtsName())
            ->setParameter('year', $user->getSchoolYear())
            ->setParameter('type', $type)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param User      $user
     * @param bool|null $profs
     *
     * @return mixed
     */
    public function findProfs(User $user, ?bool $profs = true)
    {
        $qb = $this->createQueryBuilder('c');

        return count(
            $qb
                ->innerJoin('c.user', 'u', Join::WITH, 'u.roles LIKE :role')
                ->andWhere('c.deletedAt IS NULL')
                ->andWhere('c.etsName = :etsName')
                ->setParameter('role', '%"'.$profs ? 'ROLE_PROFS' : 'ROLE_DIRECTION'.'"%')
                ->setParameter('etsName', $user->getEtsName())->getQuery()->getResult()
        );
    }
}
