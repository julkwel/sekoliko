<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Repository;

use App\Entity\ClassRoom;
use App\Entity\Student;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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
