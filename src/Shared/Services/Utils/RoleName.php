<?php

namespace App\Shared\Services\Utils;

/**
 * Class RoleName.
 */
class RoleName
{
    // Nom rôle
    const ROLE_SUPER_ADMINISTRATEUR = 'ROLE_SUPERADMIN';
    const ROLE_ADMINISTRATEUR = 'ROLE_ADMIN';
    const ROLE_ETUDIANT = 'ROLE_ETUDIANT';
    const ROLE_PROFS = 'ROLE_PROFS';
    const ROLE_PERSONEL = 'ROLE_PERSONEL';
    const ROLE_PARENT = 'ROLE_PARENT';

    // Identifiant rôle
    const ID_ROLE_SUPERADMIN = 1;
    const ID_ROLE_ADMIN = 3;
    const ID_ROLE_ETUDIANT = 2;
    const ID_ROLE_PROFS = 4;
    const ID_ROLE_PERSONEL = 5;
    const ID_ROLE_PARENT = 6;

    public static $ROLE_TYPE = array(
        'Admin' => 'ROLE_ADMIN',
        'Superadmin' => 'ROLE_SUPERADMIN',
        'Etudiant' => 'ROLE_ETUDIANT',
        'Profs' => 'ROLE_PROFS',
        'Personel' => 'ROLE_PERSONEL',
        'Parent' => 'ROLE_PARENT',
    );
}
