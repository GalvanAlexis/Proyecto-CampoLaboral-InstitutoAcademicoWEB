<?php

namespace App\Controllers;

use App\Models\ProfesorModel;
use CodeIgniter\Controller;

class Profesores extends Controller
{
    public function index()
    {
        $model = new ProfesorModel();
        $data['profesores'] = $model->findAll();

        return view('profesores/index', $data);
    }

    public function create()
    {
        return view('profesores/create');
    }

    public function store()
    {
        // Validación de datos
        $validation = \Config\Services::validation();
        $validation->setRules([
            'Nombre_Completo' => 'required|min_length[3]|max_length[255]|alpha_space',
            'DNI' => 'required|numeric|min_length[7]|max_length[8]|is_unique[profesores.DNI]',
            'email' => 'required|valid_email|max_length[255]|is_unique[profesores.Email]'
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

        $model = new ProfesorModel();

        $inserted = $model->insert([
            'Nombre_Completo' => trim($this->request->getPost('Nombre_Completo')),
            'DNI' => trim($this->request->getPost('DNI')),
            'Email' => strtolower(trim($this->request->getPost('email')))
        ]);

        if ($inserted) {
            return redirect()->to('/profesores')->with('message', 'Profesor creado exitosamente');
        }

        return redirect()->back()->withInput()->with('error', 'Error al crear el profesor');
    }

    public function edit($id)
    {
        // Validar que ID sea numérico
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->to('/profesores')->with('error', 'ID inválido');
        }

        $model = new ProfesorModel();
        $profesor = $model->find($id);

        if (!$profesor) {
            return redirect()->to('/profesores')->with('error', 'Profesor no encontrado');
        }

        $data['profesor'] = $profesor;
        return view('profesores/edit', $data);
    }

    public function update($id)
    {
        // Validar que ID sea numérico
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->to('/profesores')->with('error', 'ID inválido');
        }

        $model = new ProfesorModel();
        
        // Verificar que el profesor existe
        $profesor = $model->find($id);
        if (!$profesor) {
            return redirect()->to('/profesores')->with('error', 'Profesor no encontrado');
        }

        // Validación de datos
        $validation = \Config\Services::validation();
        $validation->setRules([
            'Nombre_Completo' => 'required|min_length[3]|max_length[255]|alpha_space',
            'DNI' => 'required|numeric|min_length[7]|max_length[8]|is_unique[profesores.DNI,ID_Profesor,' . $id . ']',
            'email' => 'required|valid_email|max_length[255]|is_unique[profesores.Email,ID_Profesor,' . $id . ']'
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
            return redirect()->to('/profesores')->with('message', 'Profesor actualizado exitosamente');
        }

        return redirect()->back()->withInput()->with('error', 'Error al actualizar el profesor');
    }

    public function delete($id)
    {
        // Validar que ID sea numérico
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->to('/profesores')->with('error', 'ID inválido');
        }

        $model = new ProfesorModel();
        
        // Verificar que el profesor existe
        $profesor = $model->find($id);
        if (!$profesor) {
            return redirect()->to('/profesores')->with('error', 'Profesor no encontrado');
        }

        // Verificar que no tenga turnos asignados
        $db = \Config\Database::connect();
        $turnos = $db->table('turnos')
            ->where('ID_Profesor', $id)
            ->countAllResults();

        if ($turnos > 0) {
            return redirect()->to('/profesores')->with('error', 'No se puede eliminar: el profesor tiene turnos asignados');
        }

        // Verificar que no esté vinculado a un usuario
        if (!empty($profesor['user_id'])) {
            return redirect()->to('/profesores')->with('error', 'No se puede eliminar: el profesor está vinculado a un usuario del sistema');
        }

        $deleted = $model->delete($id);

        if ($deleted) {
            return redirect()->to('/profesores')->with('message', 'Profesor eliminado exitosamente');
        }

        return redirect()->to('/profesores')->with('error', 'Error al eliminar el profesor');
    }

    /**
     * Muestra el formulario para que un profesor complete su perfil por primera vez
     */
    public function completarPerfil()
    {
        // Verificar que el usuario esté autenticado y sea profesor
        if (!auth()->loggedIn()) {
            return redirect()->to('login')->with('error', 'Debes iniciar sesión');
        }

        $user = auth()->user();
        if (!$user->inGroup('profesor')) {
            return redirect()->to('/')->with('error', 'Acceso denegado');
        }

        // Si ya tiene perfil, redirigir a editar
        if (session()->get('ID_Profesor')) {
            return redirect()->to('profesores/editarPerfil');
        }

        // Si es POST, procesar el formulario
        if (strtolower($this->request->getMethod()) === 'post') {
            return $this->guardarPerfil();
        }

        // Si es GET, mostrar el formulario
        return view('profesores/completar_perfil');
    }

    /**
     * Guarda el perfil del profesor en la base de datos
     */
    protected function guardarPerfil()
    {
        // Validación completa con verificación de duplicados
        $validation = \Config\Services::validation();
        $validation->setRules([
            'Nombre_Completo' => 'required|min_length[3]|max_length[255]|alpha_space',
            'DNI' => 'required|numeric|min_length[7]|max_length[8]|is_unique[profesores.DNI]',
            'Email' => 'required|valid_email|max_length[255]|is_unique[profesores.Email]'
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

        $db = \Config\Database::connect();
        
        // Obtener el identity_id del usuario autenticado
        $userId = auth()->id();
        $identityRow = $db->table('auth_identities')
            ->where('user_id', $userId)
            ->get()
            ->getRow();

        if (!$identityRow) {
            return redirect()->back()->with('error', 'Error al obtener datos del usuario');
        }

        $identityId = $identityRow->id;

        // Verificar que no exista ya un profesor con este user_id
        $existeProfesor = $db->table('profesores')
            ->where('user_id', $identityId)
            ->get()
            ->getRow();

        if ($existeProfesor) {
            session()->set('ID_Profesor', $existeProfesor->ID_Profesor);
            return redirect()->to('profesores/editarPerfil')->with('message', 'Tu perfil ya existe');
        }

        // Insertar el nuevo profesor
        $data = [
            'Nombre_Completo' => trim($this->request->getPost('Nombre_Completo')),
            'DNI'             => trim($this->request->getPost('DNI')),
            'Email'           => strtolower(trim($this->request->getPost('Email'))),
            'user_id'         => $identityId,
        ];

        $inserted = $db->table('profesores')->insert($data);

        if ($inserted) {
            $profesorId = $db->insertID();
            session()->set('ID_Profesor', $profesorId);
            return redirect()->to('/')->with('message', 'Perfil completado exitosamente');
        }

        return redirect()->back()->with('error', 'Error al guardar el perfil');
    }

    /**
     * Muestra el formulario para que un profesor edite su perfil
     */
    public function editarPerfil()
    {
        // Verificar que el usuario esté autenticado y sea profesor
        if (!auth()->loggedIn()) {
            return redirect()->to('login')->with('error', 'Debes iniciar sesión');
        }

        $user = auth()->user();
        if (!$user->inGroup('profesor')) {
            return redirect()->to('/')->with('error', 'Acceso denegado');
        }

        // Si no tiene perfil, redirigir a completar
        $idProfesor = session()->get('ID_Profesor');
        if (!$idProfesor) {
            return redirect()->to('profesores/completarPerfil');
        }

        // Si es POST, procesar la actualización
        if (strtolower($this->request->getMethod()) === 'post') {
            return $this->actualizarPerfil($idProfesor);
        }

        // Si es GET, mostrar el formulario con los datos actuales
        $model = new ProfesorModel();
        $profesor = $model->find($idProfesor);

        if (!$profesor) {
            session()->remove('ID_Profesor');
            return redirect()->to('profesores/completarPerfil')->with('error', 'Perfil no encontrado');
        }

        return view('profesores/editar_perfil', ['profesor' => $profesor]);
    }

    /**
     * Actualiza los datos del perfil del profesor
     */
    protected function actualizarPerfil($idProfesor)
    {
        // Validación completa con verificación de duplicados (excluyendo el registro actual)
        $validation = \Config\Services::validation();
        $validation->setRules([
            'Nombre_Completo' => 'required|min_length[3]|max_length[255]|alpha_space',
            'DNI' => 'required|numeric|min_length[7]|max_length[8]|is_unique[profesores.DNI,ID_Profesor,' . $idProfesor . ']',
            'Email' => 'required|valid_email|max_length[255]|is_unique[profesores.Email,ID_Profesor,' . $idProfesor . ']'
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

        $model = new ProfesorModel();

        $data = [
            'Nombre_Completo' => trim($this->request->getPost('Nombre_Completo')),
            'DNI'             => trim($this->request->getPost('DNI')),
            'Email'           => strtolower(trim($this->request->getPost('Email'))),
        ];

        $updated = $model->update($idProfesor, $data);

        if ($updated) {
            return redirect()->back()->with('message', 'Datos actualizados correctamente');
        }

        return redirect()->back()->with('error', 'Error al actualizar los datos');
    }

    /**
     * Muestra el formulario para que el profesor cree un turno
     * o procesa la creación del turno
     */
    public function crearTurno()
    {
        $idProfesor = session()->get('ID_Profesor');

        if (!$idProfesor) {
            return redirect()->to('profesores/completarPerfil');
        }

        // Si es POST, procesar la creación del turno
        if (strtolower($this->request->getMethod()) === 'post') {
            return $this->guardarTurno($idProfesor);
        }

        // Si es GET, mostrar el formulario
        $carreraModel = new \App\Models\CarreraModel();
        $data['carreras'] = $carreraModel->findAll();

        return view('profesores/crear_turno', $data);
    }

    /**
     * Guarda el turno creado por el profesor
     */
    protected function guardarTurno($idProfesor)
    {
        $turnoModel = new \App\Models\TurnoModel();

        $data = [
            'Turno'       => $this->request->getPost('Turno'),
            'ID_Profesor' => $idProfesor,
            'ID_Carrera'  => $this->request->getPost('ID_Carrera')
        ];

        $inserted = $turnoModel->insert($data);

        if ($inserted) {
            return redirect()->to('profesores/misTurnos')->with('message', 'Turno creado exitosamente');
        }

        return redirect()->back()->with('error', 'Error al crear el turno')->withInput();
    }

    /**
     * Muestra los turnos del profesor autenticado
     */
    public function misTurnos()
    {
        $idProfesor = session()->get('ID_Profesor');

        if (!$idProfesor) {
            return redirect()->to('profesores/completarPerfil');
        }

        $turnoModel = new \App\Models\TurnoModel();
        $inscripcionModel = new \App\Models\InscripcionModel();

        // Obtener turnos del profesor con información de carrera
        $turnos = $turnoModel->select('turnos.ID_Turno, turnos.Turno, carreras.Nombre_Carrera')
                    ->join('carreras', 'carreras.ID_Carrera = turnos.ID_Carrera')
                    ->where('turnos.ID_Profesor', $idProfesor)
                    ->findAll();

        // Contar inscriptos por cada turno
        foreach ($turnos as &$turno) {
            $turno['cantidad_inscriptos'] = $inscripcionModel->where('ID_Turno', $turno['ID_Turno'])->countAllResults();
        }

        $data['turnos'] = $turnos;

        return view('profesores/mis_turnos', $data);
    }

    /**
     * Muestra los alumnos inscriptos a un turno específico del profesor
     */
    public function verInscriptos($idTurno)
    {
        $idProfesor = session()->get('ID_Profesor');

        if (!$idProfesor) {
            return redirect()->to('profesores/completarPerfil');
        }

        $turnoModel = new \App\Models\TurnoModel();
        
        // Verificar que el turno pertenece al profesor
        $turno = $turnoModel->select('turnos.ID_Turno, turnos.Turno, carreras.Nombre_Carrera')
                    ->join('carreras', 'carreras.ID_Carrera = turnos.ID_Carrera')
                    ->where('turnos.ID_Turno', $idTurno)
                    ->where('turnos.ID_Profesor', $idProfesor)
                    ->first();

        if (!$turno) {
            return redirect()->to('profesores/misTurnos')->with('error', 'Turno no encontrado');
        }

        $inscripcionModel = new \App\Models\InscripcionModel();

        // Obtener alumnos inscriptos a este turno
        $inscriptos = $inscripcionModel->select('alumnos.Nombre_Completo, alumnos.DNI, alumnos.Email, Inscripciones.Fecha_Inscripcion')
                        ->join('alumnos', 'alumnos.ID_Alumno = Inscripciones.ID_Alumno')
                        ->where('Inscripciones.ID_Turno', $idTurno)
                        ->findAll();

        $data['turno'] = $turno;
        $data['inscriptos'] = $inscriptos;

        return view('profesores/ver_inscriptos', $data);
    }
}
