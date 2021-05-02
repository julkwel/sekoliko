<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Repository;

use App\Entity\Ecolage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ecolage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ecolage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ecolage[]    findAll()
 * @method Ecolage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EcolageRepository extends ServiceEntityRepository
{
    /**
     * EcolageRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ecolage::class);
    }
}
