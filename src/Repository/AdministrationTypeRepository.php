<?php

namespace App\Repository;

use App\Entity\AdministrationType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AdministrationType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdministrationType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdministrationType[]    findAll()
 * @method AdministrationType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdministrationTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdministrationType::class);
    }
}
