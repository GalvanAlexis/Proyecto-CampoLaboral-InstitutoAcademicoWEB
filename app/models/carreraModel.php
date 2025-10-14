<?php

namespace App\Models;

use CodeIgniter\Model;

class CarreraModel extends Model
{
    protected $table            = 'carreras';
    protected $primaryKey       = 'ID_Carrera';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'ID_Carrera',
        'Nombre_Carrera',
        'ID_Categoria'
    ];


}



