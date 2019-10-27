<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>
 **/

namespace App\Constant;

/**
 * Class RoleConstant
 *
 * @package App\Constant
 */
class RoleConstant
{
    public const ROLE_SEKOLIKO = [
        'Administrateur' => 'ROLE_ADMIN',
        'Professeur' => 'ROLE_PROFS',
        'Etudiant' => 'ROLE_ETUDIANT',
        'Direction' => 'ROLE_DIRECTION',
        'SuperAdmin' => 'ROLE_SUPER_ADMIN',
        'Scolarite' => 'ROLE_SCOLARITE',
    ];
}
