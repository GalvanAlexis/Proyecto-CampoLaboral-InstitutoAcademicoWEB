<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
<<<<<<< HEAD
    public string $defaultGroup = 'alumno';
=======
    public string $defaultGroup = '';
>>>>>>> fac8b67554a14ff1fb799d323181c0e914832622

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
<<<<<<< HEAD
        'admin'    => [
            'title'       => 'Administrador',
            'description' => 'Acceso total al sistema.',
        ],
        'alumno'   => [
            'title'       => 'Alumno',
            'description' => 'Puede ver carreras e inscribirse.',
        ],
        'profesor' => [
            'title'       => 'Profesor',
            'description' => 'Puede ver inscripciones y carreras.',
        ],
    ];

=======
        'admin' => [
            'title'       => 'Administrador',
            'description' => 'Acceso completo al sistema, puede crear usuarios y administrar todos los datos.',
        ],
        'profesor' => [
            'title'       => 'Profesor',
            'description' => 'Puede ver listados de alumnos, profesores, carreras, categorías y turnos.',
        ],
        'alumno' => [
            'title'       => 'Alumno',
            'description' => 'Puede ver carreras e inscribirse en una.',
        ],
    ];


>>>>>>> fac8b67554a14ff1fb799d323181c0e914832622
    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
<<<<<<< HEAD
        // Admin
        'manage-users'      => 'Crear, editar y eliminar usuarios',
        'manage-cruds'      => 'Acceso total a los cruds',
        // Alumno
        'view-carreras'     => 'Ver carreras',
        'inscribirse'       => 'Inscribirse en carreras',
        // Profesor
        'ver-inscripciones' => 'Ver inscripciones',
        'ver-carreras'      => 'Ver carreras',
=======
        // General
        'crud.access',       // acceso general al panel
        'users.manage',      // crear, editar y borrar usuarios
        'profesores.view',
        'alumnos.view',
        'alumnos.enroll',    // inscribirse a una carrera
        'carreras.view',
        'categorias.view',
        'turnos.view',
>>>>>>> fac8b67554a14ff1fb799d323181c0e914832622
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
<<<<<<< HEAD
        'admin'    => [
            'manage-users',
            'manage-cruds',
            'view-carreras',
            'inscribirse',
            'ver-inscripciones',
            'ver-carreras',
        ],
        'alumno'   => [
            'view-carreras',
            'inscribirse',
        ],
        'profesor' => [
            'ver-inscripciones',
            'ver-carreras',
=======
        'admin' => [
            'crud.access',
            'users.manage',
            'profesores.view',
            'alumnos.view',
            'alumnos.enroll',
            'carreras.view',
            'categorias.view',
            'turnos.view',
        ],
        'profesor' => [
            'crud.access',
            'profesores.view',
            'alumnos.view',
            'carreras.view',
            'categorias.view',
            'turnos.view',
        ],
        'alumno' => [
            'crud.access',
            'carreras.view',
            'alumnos.enroll',
>>>>>>> fac8b67554a14ff1fb799d323181c0e914832622
        ],
    ];
}
