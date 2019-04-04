<?php

namespace App\Shared\Repository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserRepository
 * @package App\Shared\Repository
 * @author Max
 */
class UserRepository extends EntityRepository
{
    public function findByFilterQuery(Request $request, string $user)
    {
        $qb = $this->createQueryBuilder('u')
                   ->leftJoin('u.skRole','r')
                   ->addSelect('r');

        // Username
        if(!empty($request->query->get('username'))) {
            $qb->where('u.username = :username')
                ->andWhere('u.etsNom = :etsNom')
                ->setParameters([
                    'username' => $request->query->get('username'),
                    'etsNom' => $user
                ]);
        }

        // UserFirstName
        if(!empty($request->query->get('userFirstName'))) {
            $qb->where('u.usrFirstname = :userFirstName')
                ->andWhere('u.etsNom = :etsNom')
                ->setParameters([
                    'userFirstName' => $request->query->get('userFirstName'),
                    'etsNom' => $user
                ]);
        }

        // UserFirstName
        if(!empty($request->query->get('userLastName'))) {
            $qb->where('u.usrLastname = :userLastName')
                ->andWhere('u.etsNom = :etsNom')
                ->setParameters([
                    'userLastName' => $request->query->get('userLastName'),
                    'etsNom' => $user
                ]);
        }

        if(!empty($request->query->get('userLastNameSearch'))) {
            $qb->where('u.usrLastname = :userLastNameSearch')
                ->andWhere('u.etsNom = :etsNom')
                ->setParameters([
                    'userLastNameSearch' => $request->query->get('userLastNameSearch'),
                    'etsNom' => $user
                ]);
        }

        return $qb->getQuery()
                  ->getArrayResult();
    }

}