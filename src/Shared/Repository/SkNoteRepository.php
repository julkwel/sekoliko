<?php

namespace App\Shared\Repository;
use App\Shared\Entity\SkNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ClasseRepository
 * @package App\Shared\Repository
 */
class SkNoteRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SkNote::class);
    }

    public function findAllMarksById(array $ids = [])
    {
        return $this->createQueryBuilder('n')
                    ->where('n.id IN (:markId)')
                    ->setParameter('markId', $ids)
                    ->getQuery()
                    ->getResult();
    }
}
 