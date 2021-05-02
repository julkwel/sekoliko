<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Repository;

use App\Entity\Session;
use App\Entity\Student;
use App\Entity\StudentNote;
use App\Entity\Subject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudentNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentNote[]    findAll()
 * @method StudentNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentNoteRepository extends ServiceEntityRepository
{
    /**
     * StudentNoteRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentNote::class);
    }

    /**
     * @param Student $student
     * @param Session $session
     *
     * @return StudentNote[] Returns an array of StudentNote objects
     */
    public function findBySession(Student $student, Session $session)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.session = :session')
            ->andWhere('s.student = :student')
            ->setParameter('session', $session)
            ->setParameter('student', $student)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
