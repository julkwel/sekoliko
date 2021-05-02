<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Repository;

use App\Entity\Docs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Docs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Docs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Docs[]    findAll()
 * @method Docs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocsRepository extends ServiceEntityRepository
{
    /**
     * DocsRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Docs::class);
    }
}
