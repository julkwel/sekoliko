<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Repository;

use App\Entity\ClassRoom;
use App\Entity\Student;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    /**
     * StudentRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    /**
     * @param User $user
     *
     * @return mixed
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findAllBySchool(User $user)
    {
        return $this->createQueryBuilder('s')
            ->select('count(s.id)')
            ->andWhere('s.etsName = :etsName')
            ->setParameter('etsName', $user->getEtsName())
            ->getQuery()->getSingleScalarResult();
    }


    /**
     * @param User      $user
     * @param ClassRoom $classRoom
     *
     * @return Student[] Returns an array of Student objects
     */
    public function findByClassSchoolYearField(User $user, ClassRoom $classRoom)
    {
        return $this->createQueryBuilder('s')
            ->where('s.deletedAt is NULL')
            ->andWhere('s.etsName = :etsName')
            ->andWhere('s.classe = :classRoom')
            ->andWhere('s.isRenvoie = :status')
            ->setParameter('status', false)
            ->setParameter('etsName', $user->getEtsName())
            ->setParameter('classRoom', $classRoom)
            ->getQuery()
            ->getResult();
    }
}
