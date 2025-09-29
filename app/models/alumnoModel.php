<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumnoModel extends Model
{
    protected $table            = 'alumnos';
    protected $primaryKey       = 'ID_Alumno';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'Nombre_Completo',
        'DNI',
        'Email'
    ];


}



