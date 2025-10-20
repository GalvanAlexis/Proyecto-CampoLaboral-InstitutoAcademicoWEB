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
        $data['usuarios'] = $userModel->findAll();

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
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/usuarios')->with('message', 'Usuario eliminado correctamente');
    }
}
