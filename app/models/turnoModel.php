<?php

namespace App\Models;

use CodeIgniter\Model;

class TurnoModel extends Model
{
    protected $table            = 'turnos';
    protected $primaryKey       = 'ID_Turno';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'Turno',
        'ID_Profesor',
        'ID_Carrera'
    ];

    public function getTurnosConRelaciones()
{
    return $this->select('turnos.ID_Turno, turnos.Turno, profesores.Nombre_Completo, carreras.Nombre_Carrera')
                ->join('profesores', 'profesores.ID_Profesor = turnos.ID_Profesor')
                ->join('carreras', 'carreras.ID_Carrera = turnos.ID_Carrera')
                ->findAll();
}

}



