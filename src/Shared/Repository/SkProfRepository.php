<?php

namespace App\Shared\Repository;
use App\Shared\Entity\SkProfs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ClasseRepository
 * @package App\Shared\Repository
 */
class SkProfRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SkProfs::class);
    }
}
