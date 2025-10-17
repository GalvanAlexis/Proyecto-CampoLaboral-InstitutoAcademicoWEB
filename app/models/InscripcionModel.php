<?php

namespace App\Models;

use CodeIgniter\Model;

class InscripcionModel extends Model
{
    protected $table            = 'Inscripciones';
    // Tabla con clave primaria compuesta (ID_Alumno, ID_Turno).
    // No usar primaryKey / autoIncrement en el modelo para evitar conflictos.
    protected $primaryKey       = '';
    protected $useAutoIncrement = false;
    protected $allowedFields    = [
        'ID_Alumno',
        'ID_Carrera',
        'ID_Turno',
        'Fecha_Inscripcion'
    ];
    protected $returnType       = 'array';
    protected $useTimestamps    = false;
}
