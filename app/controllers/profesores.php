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
        $model = new ProfesorModel();

        $model->insert([
            'Nombre_Completo' => $this->request->getPost('Nombre_Completo'),
            'DNI' => $this->request->getPost('DNI'),
            'Email'  => $this->request->getPost('email')
        ]);

        return redirect()->to('/profesores');
    }

    public function edit($id)
    {
        $model = new ProfesorModel();
        $data['profesor'] = $model->find($id);

        return view('profesores/edit', $data);
    }

    public function update($id)
    {
        $model = new ProfesorModel();

        $model->update($id, [
            'Nombre_Completo' => $this->request->getPost('Nombre_Completo'),
            'DNI' => $this->request->getPost('DNI'),
            'Email'  => $this->request->getPost('email')
        ]);

        return redirect()->to('/profesores');
    }

    public function delete($id)
    {
        $model = new ProfesorModel();
        $model->delete($id);

        return redirect()->to('/profesores');
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
            'Nombre_Completo' => $this->request->getPost('Nombre_Completo'),
            'DNI'             => $this->request->getPost('DNI'),
            'Email'           => $this->request->getPost('Email'),
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
        $model = new ProfesorModel();

        $data = [
            'Nombre_Completo' => $this->request->getPost('Nombre_Completo'),
            'DNI'             => $this->request->getPost('DNI'),
            'Email'           => $this->request->getPost('Email'),
        ];

        $updated = $model->update($idProfesor, $data);

        if ($updated) {
            return redirect()->back()->with('message', 'Datos actualizados correctamente');
        }

        return redirect()->back()->with('error', 'Error al actualizar los datos');
    }
}
