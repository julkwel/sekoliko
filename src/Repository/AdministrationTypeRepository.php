<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Repository;

use App\Entity\AdministrationType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdministrationType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdministrationType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdministrationType[]    findAll()
 * @method AdministrationType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdministrationTypeRepository extends ServiceEntityRepository
{
    /**
     * AdministrationTypeRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdministrationType::class);
    }

    /**
     * @param string $ets
     *
     * @return mixed
     */
    public function findByEts(string $ets)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.etsName = :etsName')
            ->setParameter('etsName', $ets)
            ->getQuery()->getResult();
    }
}
