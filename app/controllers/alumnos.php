<?php

namespace App\Controllers;

use App\Models\AlumnoModel;
use CodeIgniter\Controller;

class Alumnos extends Controller
{
    public function index()
    {
        $model = new AlumnoModel();
        $data['alumnos'] = $model->findAll();

        return view('alumnos/index', $data);
    }

    public function create()
    {
        return view('alumnos/create');
    }

    public function store()
    {
        $model = new AlumnoModel();

        $model->insert([
            'Nombre_Completo' => $this->request->getPost('Nombre_Completo'),
            'DNI' => $this->request->getPost('DNI'),
            'Email'  => $this->request->getPost('email')
        ]);

        return redirect()->to('/alumnos');
    }

    public function edit($id)
    {
        $model = new AlumnoModel();
        $data['alumno'] = $model->find($id);

        return view('alumnos/edit', $data);
    }

    public function update($id)
    {
        $model = new AlumnoModel();

        $model->update($id, [
            'Nombre_Completo' => $this->request->getPost('Nombre_Completo'),
            'DNI' => $this->request->getPost('DNI'),
            'Email'  => $this->request->getPost('email')
        ]);

        return redirect()->to('/alumnos');
    }

    public function delete($id)
    {
        $model = new AlumnoModel();
        $model->delete($id);

        return redirect()->to('/alumnos');
    }

    /**
     * Completar perfil para alumnos: crea la fila en Alumnos y enlaza user_id
     */
    public function completarPerfil()
    {
        // Sólo alumnos autenticados
        if (! auth()->loggedIn()) {
            return redirect()->to('/login');
        }
        $userId = auth()->id();

        // Intentar mapear auth()->id() al id de auth_identities (el FK en alumnos.user_id)
        $identityId = null;
        try {
            $db = \Config\Database::connect();
            $identityRow = $db->table('auth_identities')->where('user_id', $userId)->get()->getRow();
            if ($identityRow && isset($identityRow->id)) {
                $identityId = $identityRow->id;
            }
        } catch (\Exception $e) {
            log_message('error', 'completarPerfil: error querying auth_identities on method entry - ' . $e->getMessage());
        }

        $model = new AlumnoModel();

        // Si ya existe alumno con este user_id (identityId), redirigir
        $existing = null;
        if ($identityId !== null) {
            $existing = $model->where('user_id', $identityId)->first();
        }
        
        if ($existing) {
            // Guardar en sesión y redirigir a inscribirse
            session()->set('ID_Alumno', (int) $existing['ID_Alumno']);
            return redirect()->to('/alumnos/inscribirse');
        }

        if (strtolower($this->request->getMethod()) === 'post') {
            // Validación básica
            $rules = [
                'Nombre_Completo' => 'required|min_length[3]',
                'DNI' => 'required',
                'Email' => 'required|valid_email'
            ];

            if (! $this->validate($rules)) {
                $data = [
                    'Nombre_Completo' => old('Nombre_Completo'),
                    'Email' => old('Email'),
                    'DNI' => old('DNI'),
                    'validation' => $this->validator,
                ];

                return view('alumnos/completar_perfil', $data);
            }

            $data = [
                'Nombre_Completo' => $this->request->getPost('Nombre_Completo'),
                'DNI' => $this->request->getPost('DNI'),
                'Email' => $this->request->getPost('Email'),
                'user_id' => $identityId, // Ya mapeado al inicio del método
            ];

            // Insertar y guardar ID_Alumno en sesión
            try {
                $inserted = $model->insert($data);
                if ($inserted === false || ! $inserted) {
                    log_message('error', 'completarPerfil: insert returned false');
                    return redirect()->back()->with('error', 'No se pudo guardar el perfil.')->withInput();
                }

                $id = is_int($inserted) ? $inserted : $model->getInsertID();
                session()->set('ID_Alumno', (int) $id);

                return redirect()->to('/alumnos/inscribirse')->with('message', 'Perfil completado correctamente.');
            } catch (\Exception $e) {
                log_message('error', 'completarPerfil: exception during insert - ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error al guardar el perfil: ' . $e->getMessage())->withInput();
            }
        }

        // Prefill desde auth()->user() si es posible
        $user = auth()->user();
        $data = [
            'Nombre_Completo' => $user->username ?? '',
            'Email' => $user->email ?? '',
            'DNI' => ''
        ];

        return view('alumnos/completar_perfil', $data);
    }

    /**
     * Editar perfil de alumno: permite modificar datos personales
     */
    public function editarPerfil()
    {
        // Solo alumnos autenticados
        if (! auth()->loggedIn()) {
            return redirect()->to('/login');
        }

        $session = session();
        $idAlumno = $session->get('ID_Alumno');

        // Si no tiene ID_Alumno en sesión, redirigir a completar perfil
        if (! $idAlumno) {
            return redirect()->to('/alumnos/completarPerfil');
        }

        $model = new AlumnoModel();
        $alumno = $model->find($idAlumno);

        if (! $alumno) {
            return redirect()->to('/alumnos/completarPerfil')->with('error', 'No se encontró su perfil.');
        }

        if (strtolower($this->request->getMethod()) === 'post') {
            // Validación
            $rules = [
                'Nombre_Completo' => 'required|min_length[3]',
                'DNI' => 'required',
                'Email' => 'required|valid_email'
            ];

            if (! $this->validate($rules)) {
                $data = [
                    'alumno' => $alumno,
                    'validation' => $this->validator,
                ];
                return view('alumnos/editar_perfil', $data);
            }

            $updateData = [
                'Nombre_Completo' => $this->request->getPost('Nombre_Completo'),
                'DNI' => $this->request->getPost('DNI'),
                'Email' => $this->request->getPost('Email'),
            ];

            try {
                $model->update($idAlumno, $updateData);
                return redirect()->to('/alumnos/editarPerfil')->with('message', 'Datos actualizados correctamente.');
            } catch (\Exception $e) {
                log_message('error', 'editarPerfil: exception during update - ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error al actualizar los datos: ' . $e->getMessage())->withInput();
            }
        }

        // GET: mostrar formulario con datos actuales
        $data['alumno'] = $alumno;
        return view('alumnos/editar_perfil', $data);
    }

    /**
     * Muestra la página de inscripción para alumnos (placeholder).
     */
    public function inscribirse()
    {
        $categoriaModel = new \App\Models\CategoriaModel();
        $carreraModel = new \App\Models\CarreraModel();
        $turnoModel = new \App\Models\TurnoModel();

        $session = session();
        // Si el alumno no completó su perfil (no hay ID_Alumno en sesión), redirigir a completarPerfil
        if (! $session->get('ID_Alumno')) {
            // Si es POST, redirigir también a completarPerfil para que complete el perfil antes de inscribirse
            if (strtolower($this->request->getMethod()) === 'post') {
                return redirect()->to('/alumnos/completarPerfil')->with('error', 'Complete su perfil antes de inscribirse.');
            }

            return redirect()->to('/alumnos/completarPerfil');
        }

        // Si es POST, procesar la inscripción
        if (strtolower($this->request->getMethod()) === 'post') {
            // Obtener ID_Alumno desde la sesión (ya validado)
            $idAlumno = (int) $session->get('ID_Alumno');

            $idCarrera = $this->request->getPost('ID_Carrera');
            $idTurno = $this->request->getPost('ID_Turno');

            if (!$idCarrera || !$idTurno) {
                return redirect()->back()->with('error', 'Seleccione carrera y turno.')->withInput();
            }

            // Validar que el turno pertenece a la carrera seleccionada
            $turno = $turnoModel->find($idTurno);
            if (!$turno || $turno['ID_Carrera'] != $idCarrera) {
                return redirect()->back()->with('error', 'El turno seleccionado no corresponde a la carrera elegida.')->withInput();
            }

            // Verificar si ya está inscrito en esta carrera
            $db = \Config\Database::connect();
            $existing = $db->table('inscripciones')
                ->where('ID_Alumno', $idAlumno)
                ->where('ID_Carrera', $idCarrera)
                ->get()
                ->getRowArray();
            
            if ($existing) {
                return redirect()->back()->with('error', 'Ya está inscrito en esta carrera.')->withInput();
            }

            try {
                // Usar Query Builder directamente para tablas con PK compuesta
                $inserted = $db->table('inscripciones')->insert([
                    'ID_Alumno' => $idAlumno,
                    'ID_Carrera' => $idCarrera,
                    'ID_Turno' => $idTurno,
                    'Fecha_Inscripcion' => date('Y-m-d H:i:s')
                ]);

                if (!$inserted) {
                    return redirect()->back()->with('error', 'No se pudo realizar la inscripción.')->withInput();
                }

                return redirect()->to('/alumnos/inscribirse')->with('message', 'Inscripción realizada correctamente.');
            } catch (\Exception $e) {
                log_message('error', 'inscribirse: exception during insert - ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error al insertar la inscripción: ' . $e->getMessage())->withInput();
            }
        }

        // Obtener carreras
        $data['carreras'] = $carreraModel->findAll();
        
        // Obtener turnos con información del profesor y carrera usando join
        $db = \Config\Database::connect();
        $builder = $db->table('turnos t');
        $builder->select('t.ID_Turno, t.Turno, t.ID_Carrera, t.ID_Profesor, p.Nombre_Completo as Profesor_Nombre, c.Nombre_Carrera');
        $builder->join('profesores p', 'p.ID_Profesor = t.ID_Profesor', 'left');
        $builder->join('carreras c', 'c.ID_Carrera = t.ID_Carrera', 'left');
        $builder->orderBy('c.Nombre_Carrera', 'ASC');
        $builder->orderBy('t.Turno', 'ASC');
        $data['turnos'] = $builder->get()->getResultArray();

        return view('alumnos/inscribirse', $data);
    }
}
