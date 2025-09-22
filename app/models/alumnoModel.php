<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumnoModel extends Model
{
    // Nombre de la tabla
    protected $table = 'alumnos';

    // Clave primaria de la tabla
    protected $primaryKey = 'ID_Alumno';

    // Campos que se pueden modificar (CORREGIDO)
    protected $allowedFields = ['Nombre_Completo', 'DNI', 'Email', 'created_at', 'updated_at', 'deleted_at'];

    // Habilita los campos de auditoría (created_at, updated_at)
    protected $useTimestamps = true;

    // Formato de fecha
    protected $dateFormat = 'datetime';

    // Habilita la eliminación suave (soft delete)
    protected $useSoftDeletes = true;

    // Nombre del campo para soft delete
    protected $deletedField = 'deleted_at';
}