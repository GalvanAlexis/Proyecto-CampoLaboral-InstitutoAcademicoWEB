<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\GroupModel;

class Usuarios extends Controller
{
    public function index()
    {
        $userModel = new UserModel();
        
        // Obtener solo usuarios activos (no eliminados)
        $data['usuarios'] = $userModel->findAll();
        
        // Opcional: mostrar usuarios eliminados (soft deleted) si existen
        // $data['usuarios_eliminados'] = $userModel->onlyDeleted()->findAll();

        return view('usuarios/index', $data);
    }

    public function create()
    {
        // Obtén los grupos definidos en AuthGroups
        $groups = config('AuthGroups')->groups;
        return view('usuarios/create', ['groups' => $groups]);
    }

    public function store()
    {
        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];

        $groupName = $this->request->getPost('group');

        // Crea el usuario
        $user = new User($data);
        $userModel->save($user);

        // Obtén el ID del usuario recién creado
        $userId = $userModel->getInsertID();

        // Asigna el grupo insertando en auth_groups_users
        $db = \Config\Database::connect();
        $db->table('auth_groups_users')->insert([
            'user_id' => $userId,
            'group' => $groupName,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/usuarios')->with('message', 'Usuario creado correctamente');
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $data['usuario'] = $userModel->find($id);
        $groups = config('AuthGroups')->groups;
        $data['groups'] = $groups;

        return view('usuarios/edit', $data);
    }

    public function update($id)
    {
        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ];

        $password = $this->request->getPost('password');
        if ($password) {
            $data['password'] = $password;
        }

        $group = $this->request->getPost('group');

        $userModel->update($id, $data);

        // Actualiza el grupo del usuario
        if ($group) {
            $groupModel = new GroupModel();
            $groupModel->removeUserFromAllGroups($id);
            $groupModel->addUserToGroup($id, $group);
        }

        return redirect()->to('/usuarios')->with('message', 'Usuario actualizado correctamente');
    }

    public function delete($id)
    {
        // Validar que el ID sea numérico y positivo
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->to('/usuarios')->with('error', 'ID de usuario inválido');
        }
        
        $userModel = new UserModel();
        
        // Verificar que el usuario existe
        $user = $userModel->withDeleted()->find($id);
        if (!$user) {
            return redirect()->to('/usuarios')->with('error', 'Usuario no encontrado');
        }
        
        // Evitar que el usuario se elimine a sí mismo
        if (auth()->id() == $id) {
            return redirect()->to('/usuarios')->with('error', 'No puedes eliminar tu propia cuenta');
        }
        
        // Desvincular automáticamente alumnos y profesores asociados antes de eliminar
        $db = \Config\Database::connect();
        
        // Desvincular alumnos (establecer user_id a NULL)
        $alumnosAfectados = $db->table('alumnos')->where('user_id', $id)->countAllResults();
        if ($alumnosAfectados > 0) {
            $db->table('alumnos')->where('user_id', $id)->update(['user_id' => null]);
        }
        
        // Desvincular profesores (establecer user_id a NULL)
        $profesoresAfectados = $db->table('profesores')->where('user_id', $id)->countAllResults();
        if ($profesoresAfectados > 0) {
            $db->table('profesores')->where('user_id', $id)->update(['user_id' => null]);
        }
        
        // Eliminar permanentemente (borrado físico, no soft delete)
        $userModel->delete($id, true);

        $mensaje = 'Usuario eliminado correctamente';
        if ($alumnosAfectados > 0 || $profesoresAfectados > 0) {
            $mensaje .= ' (se desvincularon ' . ($alumnosAfectados + $profesoresAfectados) . ' registro(s))';
        }

        return redirect()->to('/usuarios')->with('message', $mensaje);
    }
}
