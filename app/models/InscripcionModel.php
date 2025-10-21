<?php

namespace App\Models;

use CodeIgniter\Model;

class InscripcionModel extends Model
{
    protected $table            = 'Inscripciones';
    // Tabla con clave primaria compuesta (ID_Alumno, ID_Turno).
    // Usamos ID_Alumno como primaryKey para que el modelo funcione correctamente
    protected $primaryKey       = 'ID_Alumno';
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
