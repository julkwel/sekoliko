<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Repository;

use App\Entity\Administrator;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
        $parameters = [
            'ets' => $user->getEtsName(),
            'year' => $user->getSchoolYear(),
        ];

        if (!$user->getSchoolYear()) {
            $parameters = [
                'ets' => $user->getEtsName(),
            ];
        }

        return $this->createQueryBuilder('a')
            ->where('a.deletedAt is NULL')
            ->andWhere((!$user->getSchoolYear()) ? 'a.schoolYear IS NULL' : 'a.schoolYear = :year')
            ->andWhere('a.etsName = :ets')
            ->setParameters($parameters)
            ->getQuery()
            ->getResult();
    }
}
