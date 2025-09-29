<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfesorModel extends Model
{
    protected $table            = 'profesores';
    protected $primaryKey       = 'ID_Profesor';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'Nombre_Completo',
        'DNI',
        'Email'
    ];


}



