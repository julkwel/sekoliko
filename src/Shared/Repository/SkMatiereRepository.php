<?php

namespace App\Shared\Repository;

use App\Entity\Matiere;
use App\Shared\Entity\SkMatiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Matiere|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matiere|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matiere[]    findAll()
 * @method Matiere[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkMatiereRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SkMatiere::class);
    }

    /**
     * @param array $ids
     * @return SkMatiere[] Returns an array of Matiere objects
     */
    public function findGroupById(array $ids)
    {
        $qb = $this->createQueryBuilder('m')
            ->andWhere('m.id IN (:id)')
            ->setParameter('id', $ids)
            ->getQuery()
            ->getResult()
        ;

        if(count($qb)) {
            return $qb;
        }
    }

    public function allSubject()
    {
        return $this->createQueryBuilder('m')
                    ->groupBy('m.matNom')
                    ->getQuery()
                    ->getResult();
    }

}
