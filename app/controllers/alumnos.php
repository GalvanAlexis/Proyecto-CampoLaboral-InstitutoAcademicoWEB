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
        // Validación de datos
        $validation = \Config\Services::validation();
        $validation->setRules([
            'Nombre_Completo' => 'required|min_length[3]|max_length[255]|alpha_space',
            'DNI' => 'required|numeric|min_length[7]|max_length[8]|is_unique[alumnos.DNI]',
            'email' => 'required|valid_email|max_length[255]|is_unique[alumnos.Email]'
        ], [
            'Nombre_Completo' => [
                'required' => 'El nombre completo es obligatorio',
                'min_length' => 'El nombre debe tener al menos 3 caracteres',
                'alpha_space' => 'El nombre solo puede contener letras y espacios'
            ],
            'DNI' => [
                'required' => 'El DNI es obligatorio',
                'numeric' => 'El DNI debe ser numérico',
                'is_unique' => 'Este DNI ya está registrado'
            ],
            'email' => [
                'required' => 'El email es obligatorio',
                'valid_email' => 'Debe ingresar un email válido',
                'is_unique' => 'Este email ya está registrado'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new AlumnoModel();

        $inserted = $model->insert([
            'Nombre_Completo' => trim($this->request->getPost('Nombre_Completo')),
            'DNI' => trim($this->request->getPost('DNI')),
            'Email' => strtolower(trim($this->request->getPost('email')))
        ]);

        if ($inserted) {
            return redirect()->to('/alumnos')->with('message', 'Alumno creado exitosamente');
        }

        return redirect()->back()->withInput()->with('error', 'Error al crear el alumno');
    }

    public function edit($id)
    {
        // Validar que ID sea numérico
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->to('/alumnos')->with('error', 'ID inválido');
        }

        $model = new AlumnoModel();
        $alumno = $model->find($id);

        if (!$alumno) {
            return redirect()->to('/alumnos')->with('error', 'Alumno no encontrado');
        }

        $data['alumno'] = $alumno;
        return view('alumnos/edit', $data);
    }

    public function update($id)
    {
        // Validar que ID sea numérico
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->to('/alumnos')->with('error', 'ID inválido');
        }

        $model = new AlumnoModel();
        
        // Verificar que el alumno existe
        $alumno = $model->find($id);
        if (!$alumno) {
            return redirect()->to('/alumnos')->with('error', 'Alumno no encontrado');
        }

        // Validación de datos
        $validation = \Config\Services::validation();
        $validation->setRules([
            'Nombre_Completo' => 'required|min_length[3]|max_length[255]|alpha_space',
            'DNI' => 'required|numeric|min_length[7]|max_length[8]|is_unique[alumnos.DNI,ID_Alumno,' . $id . ']',
            'email' => 'required|valid_email|max_length[255]|is_unique[alumnos.Email,ID_Alumno,' . $id . ']'
        ], [
            'Nombre_Completo' => [
                'required' => 'El nombre completo es obligatorio',
                'min_length' => 'El nombre debe tener al menos 3 caracteres',
                'alpha_space' => 'El nombre solo puede contener letras y espacios'
            ],
            'DNI' => [
                'required' => 'El DNI es obligatorio',
                'numeric' => 'El DNI debe ser numérico',
                'is_unique' => 'Este DNI ya está registrado'
            ],
            'email' => [
                'required' => 'El email es obligatorio',
                'valid_email' => 'Debe ingresar un email válido',
                'is_unique' => 'Este email ya está registrado'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $updated = $model->update($id, [
            'Nombre_Completo' => trim($this->request->getPost('Nombre_Completo')),
            'DNI' => trim($this->request->getPost('DNI')),
            'Email' => strtolower(trim($this->request->getPost('email')))
        ]);

        if ($updated) {
            return redirect()->to('/alumnos')->with('message', 'Alumno actualizado exitosamente');
        }

        return redirect()->back()->withInput()->with('error', 'Error al actualizar el alumno');
    }

    public function delete($id)
    {
        // Validar que ID sea numérico
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->to('/alumnos')->with('error', 'ID inválido');
        }

        $model = new AlumnoModel();
        
        // Verificar que el alumno existe
        $alumno = $model->find($id);
        if (!$alumno) {
            return redirect()->to('/alumnos')->with('error', 'Alumno no encontrado');
        }

        // Verificar que no tenga inscripciones
        $db = \Config\Database::connect();
        $inscripciones = $db->table('inscripciones')
            ->where('ID_Alumno', $id)
            ->countAllResults();

        if ($inscripciones > 0) {
            return redirect()->to('/alumnos')->with('error', 'No se puede eliminar: el alumno tiene ' . $inscripciones . ' inscripción(es) activa(s). Elimine primero las inscripciones.');
        }

        // Si tiene user_id vinculado (no NULL), desvincularlo antes de eliminar
        if (isset($alumno['user_id']) && $alumno['user_id'] !== null) {
            $db->table('alumnos')
                ->where('ID_Alumno', $id)
                ->update(['user_id' => null]);
        }

        $deleted = $model->delete($id);

        if ($deleted) {
            return redirect()->to('/alumnos')->with('message', 'Alumno eliminado exitosamente');
        }

        return redirect()->to('/alumnos')->with('error', 'Error al eliminar el alumno');
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
            // Validación completa con verificación de duplicados
            $validation = \Config\Services::validation();
            $validation->setRules([
                'Nombre_Completo' => 'required|min_length[3]|max_length[255]|alpha_space',
                'DNI' => 'required|numeric|min_length[7]|max_length[8]|is_unique[alumnos.DNI]',
                'Email' => 'required|valid_email|max_length[255]|is_unique[alumnos.Email]'
            ], [
                'Nombre_Completo' => [
                    'required' => 'El nombre completo es obligatorio',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres',
                    'alpha_space' => 'El nombre solo puede contener letras y espacios'
                ],
                'DNI' => [
                    'required' => 'El DNI es obligatorio',
                    'numeric' => 'El DNI debe ser numérico',
                    'is_unique' => 'Este DNI ya está registrado'
                ],
                'Email' => [
                    'required' => 'El email es obligatorio',
                    'valid_email' => 'Debe ingresar un email válido',
                    'is_unique' => 'Este email ya está registrado'
                ]
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $data = [
                'Nombre_Completo' => trim($this->request->getPost('Nombre_Completo')),
                'DNI' => trim($this->request->getPost('DNI')),
                'Email' => strtolower(trim($this->request->getPost('Email'))),
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
            // Validación completa con verificación de duplicados (excluyendo el registro actual)
            $validation = \Config\Services::validation();
            $validation->setRules([
                'Nombre_Completo' => 'required|min_length[3]|max_length[255]|alpha_space',
                'DNI' => 'required|numeric|min_length[7]|max_length[8]|is_unique[alumnos.DNI,ID_Alumno,' . $idAlumno . ']',
                'Email' => 'required|valid_email|max_length[255]|is_unique[alumnos.Email,ID_Alumno,' . $idAlumno . ']'
            ], [
                'Nombre_Completo' => [
                    'required' => 'El nombre completo es obligatorio',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres',
                    'alpha_space' => 'El nombre solo puede contener letras y espacios'
                ],
                'DNI' => [
                    'required' => 'El DNI es obligatorio',
                    'numeric' => 'El DNI debe ser numérico',
                    'is_unique' => 'Este DNI ya está registrado'
                ],
                'Email' => [
                    'required' => 'El email es obligatorio',
                    'valid_email' => 'Debe ingresar un email válido',
                    'is_unique' => 'Este email ya está registrado'
                ]
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $updateData = [
                'Nombre_Completo' => trim($this->request->getPost('Nombre_Completo')),
                'DNI' => trim($this->request->getPost('DNI')),
                'Email' => strtolower(trim($this->request->getPost('Email'))),
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

    /**
     * Muestra las inscripciones del alumno autenticado
     */
    public function misInscripciones()
    {
        $idAlumno = session()->get('ID_Alumno');

        if (!$idAlumno) {
            return redirect()->to('alumnos/completarPerfil');
        }

        // Obtener inscripciones del alumno con información completa
        $db = \Config\Database::connect();
        $builder = $db->table('inscripciones i');
        $builder->select('i.Fecha_Inscripcion, c.Nombre_Carrera, t.Turno, p.Nombre_Completo as Profesor_Nombre, p.Email as Profesor_Email');
        $builder->join('carreras c', 'c.ID_Carrera = i.ID_Carrera', 'left');
        $builder->join('turnos t', 't.ID_Turno = i.ID_Turno', 'left');
        $builder->join('profesores p', 'p.ID_Profesor = t.ID_Profesor', 'left');
        $builder->where('i.ID_Alumno', $idAlumno);
        $builder->orderBy('i.Fecha_Inscripcion', 'DESC');
        
        $data['inscripciones'] = $builder->get()->getResultArray();

        return view('alumnos/mis_inscripciones', $data);
    }
}
