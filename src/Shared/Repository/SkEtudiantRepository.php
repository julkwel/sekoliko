<?php

namespace App\Shared\Repository;
use App\Shared\Entity\SkEtudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ClasseRepository
 * @package App\Shared\Repository
 */
class SkEtudiantRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SkEtudiant::class);
    }
}
