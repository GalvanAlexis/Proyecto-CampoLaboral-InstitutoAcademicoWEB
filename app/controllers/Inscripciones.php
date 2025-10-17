<?php

namespace App\Controllers;

use App\Models\InscripcionModel;
use App\Models\AlumnoModel;
use App\Models\CarreraModel;
use App\Models\TurnoModel;

class Inscripciones extends BaseController
{
    public function index()
    {
        // Obtener inscripciones con información relacionada usando JOIN
        $db = \Config\Database::connect();
        $builder = $db->table('inscripciones i');
        $builder->select('i.ID_Alumno, i.ID_Carrera, i.ID_Turno, i.Fecha_Inscripcion, a.Nombre_Completo as Alumno_Nombre, c.Nombre_Carrera, t.Turno, p.Nombre_Completo as Profesor_Nombre');
        $builder->join('alumnos a', 'a.ID_Alumno = i.ID_Alumno', 'left');
        $builder->join('carreras c', 'c.ID_Carrera = i.ID_Carrera', 'left');
        $builder->join('turnos t', 't.ID_Turno = i.ID_Turno', 'left');
        $builder->join('profesores p', 'p.ID_Profesor = t.ID_Profesor', 'left');
        $builder->orderBy('i.Fecha_Inscripcion', 'DESC');
        
        $data['inscripciones'] = $builder->get()->getResultArray();

        return view('inscripciones/index', $data);
    }

    public function create()
    {
        $alumnoModel = new AlumnoModel();
        $carreraModel = new CarreraModel();

        $data['alumnos'] = $alumnoModel->findAll();
        $data['carreras'] = $carreraModel->findAll();
        
        // Obtener turnos con información de profesor y carrera
        $db = \Config\Database::connect();
        $builder = $db->table('turnos t');
        $builder->select('t.ID_Turno, t.Turno, t.ID_Carrera, t.ID_Profesor, p.Nombre_Completo as Profesor_Nombre, c.Nombre_Carrera');
        $builder->join('profesores p', 'p.ID_Profesor = t.ID_Profesor', 'left');
        $builder->join('carreras c', 'c.ID_Carrera = t.ID_Carrera', 'left');
        $builder->orderBy('c.Nombre_Carrera', 'ASC');
        $builder->orderBy('t.Turno', 'ASC');
        $data['turnos'] = $builder->get()->getResultArray();

        return view('inscripciones/create', $data);
    }

    public function store()
    {
        $idAlumno = $this->request->getPost('ID_Alumno');
        $idCarrera = $this->request->getPost('ID_Carrera');
        $idTurno = $this->request->getPost('ID_Turno');

        if (!$idAlumno || !$idCarrera || !$idTurno) {
            return redirect()->back()->with('error', 'Todos los campos son obligatorios.')->withInput();
        }

        // Validar que el turno pertenece a la carrera
        $turnoModel = new TurnoModel();
        $turno = $turnoModel->find($idTurno);
        if (!$turno || $turno['ID_Carrera'] != $idCarrera) {
            return redirect()->back()->with('error', 'El turno seleccionado no corresponde a la carrera elegida.')->withInput();
        }

        // Verificar si ya existe la inscripción
        $db = \Config\Database::connect();
        $existing = $db->table('inscripciones')
            ->where('ID_Alumno', $idAlumno)
            ->where('ID_Carrera', $idCarrera)
            ->get()
            ->getRowArray();

        if ($existing) {
            return redirect()->back()->with('error', 'Este alumno ya está inscrito en esta carrera.')->withInput();
        }

        try {
            $inserted = $db->table('inscripciones')->insert([
                'ID_Alumno' => $idAlumno,
                'ID_Carrera' => $idCarrera,
                'ID_Turno' => $idTurno,
                'Fecha_Inscripcion' => date('Y-m-d H:i:s')
            ]);

            if (!$inserted) {
                return redirect()->back()->with('error', 'No se pudo crear la inscripción.')->withInput();
            }

            return redirect()->to('/inscripciones')->with('message', 'Inscripción creada correctamente.');
        } catch (\Exception $e) {
            log_message('error', 'Inscripciones::store - ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al crear la inscripción: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($idAlumno, $idCarrera, $idTurno)
    {
        $db = \Config\Database::connect();
        
        // Obtener inscripción actual
        $inscripcion = $db->table('inscripciones')
            ->where('ID_Alumno', $idAlumno)
            ->where('ID_Carrera', $idCarrera)
            ->where('ID_Turno', $idTurno)
            ->get()
            ->getRowArray();

        if (!$inscripcion) {
            return redirect()->to('/inscripciones')->with('error', 'Inscripción no encontrada.');
        }

        // Obtener datos para los selects
        $alumnoModel = new AlumnoModel();
        $carreraModel = new CarreraModel();

        $data['inscripcion'] = $inscripcion;
        $data['alumnos'] = $alumnoModel->findAll();
        $data['carreras'] = $carreraModel->findAll();
        
        // Obtener turnos con información
        $builder = $db->table('turnos t');
        $builder->select('t.ID_Turno, t.Turno, t.ID_Carrera, t.ID_Profesor, p.Nombre_Completo as Profesor_Nombre, c.Nombre_Carrera');
        $builder->join('profesores p', 'p.ID_Profesor = t.ID_Profesor', 'left');
        $builder->join('carreras c', 'c.ID_Carrera = t.ID_Carrera', 'left');
        $builder->orderBy('c.Nombre_Carrera', 'ASC');
        $builder->orderBy('t.Turno', 'ASC');
        $data['turnos'] = $builder->get()->getResultArray();

        return view('inscripciones/edit', $data);
    }

    public function update($idAlumno, $idCarrera, $idTurno)
    {
        $newIdTurno = $this->request->getPost('ID_Turno');

        if (!$newIdTurno) {
            return redirect()->back()->with('error', 'El turno es obligatorio.')->withInput();
        }

        // Validar que el nuevo turno pertenece a la misma carrera
        $turnoModel = new TurnoModel();
        $turno = $turnoModel->find($newIdTurno);
        if (!$turno || $turno['ID_Carrera'] != $idCarrera) {
            return redirect()->back()->with('error', 'El turno seleccionado no corresponde a la carrera.')->withInput();
        }

        $db = \Config\Database::connect();

        try {
            // Si el turno cambió, verificar que no exista ya esa combinación
            if ($newIdTurno != $idTurno) {
                $existing = $db->table('inscripciones')
                    ->where('ID_Alumno', $idAlumno)
                    ->where('ID_Carrera', $idCarrera)
                    ->where('ID_Turno', $newIdTurno)
                    ->get()
                    ->getRowArray();

                if ($existing) {
                    return redirect()->back()->with('error', 'Ya existe una inscripción con ese turno.')->withInput();
                }

                // Eliminar registro antiguo e insertar nuevo (porque la PK incluye ID_Turno)
                $db->table('inscripciones')
                    ->where('ID_Alumno', $idAlumno)
                    ->where('ID_Carrera', $idCarrera)
                    ->where('ID_Turno', $idTurno)
                    ->delete();

                $db->table('inscripciones')->insert([
                    'ID_Alumno' => $idAlumno,
                    'ID_Carrera' => $idCarrera,
                    'ID_Turno' => $newIdTurno,
                    'Fecha_Inscripcion' => date('Y-m-d H:i:s')
                ]);
            }

            return redirect()->to('/inscripciones')->with('message', 'Inscripción actualizada correctamente.');
        } catch (\Exception $e) {
            log_message('error', 'Inscripciones::update - ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al actualizar la inscripción: ' . $e->getMessage())->withInput();
        }
    }

    public function delete($idAlumno, $idCarrera, $idTurno)
    {
        $db = \Config\Database::connect();

        try {
            $deleted = $db->table('inscripciones')
                ->where('ID_Alumno', $idAlumno)
                ->where('ID_Carrera', $idCarrera)
                ->where('ID_Turno', $idTurno)
                ->delete();

            if ($deleted) {
                return redirect()->to('/inscripciones')->with('message', 'Inscripción eliminada correctamente.');
            } else {
                return redirect()->to('/inscripciones')->with('error', 'No se pudo eliminar la inscripción.');
            }
        } catch (\Exception $e) {
            log_message('error', 'Inscripciones::delete - ' . $e->getMessage());
            return redirect()->to('/inscripciones')->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}
