<?php

namespace App\Shared\Repository;
use App\Shared\Entity\SkClasse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ClasseRepository
 * @package App\Shared\Repository
 */
class SkClasseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SkClasse::class);
    }
}
 