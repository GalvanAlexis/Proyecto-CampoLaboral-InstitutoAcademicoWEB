<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class Usuarios extends Controller
{
    public function index()
    {
        $model = new UsuarioModel();
        $data['usuarios'] = $model->findAll();

        return view('usuarios/index', $data);
    }

    public function create()
    {
        return view('usuarios/create');
    }

    public function store()
    {
        $model = new UsuarioModel();

        $model->insert([
            'Email'       => $this->request->getPost('Email'),
            'Password' => $this->request->getPost('password'),
            'ID_Rol'  => $this->request->getPost('ID_Rol')
        ]);

        return redirect()->to('/usuarios');
    }

    public function edit($id)
    {
        $model = new UsuarioModel();
        $data['usuario'] = $model->find($id);

        return view('usuarios/edit', $data);
    }

    public function update($id)
    {
        $model = new UsuarioModel();

        $model->update($id, [
            'Email'       => $this->request->getPost('Email'),
            'Password' => $this->request->getPost('password'),
            'ID_Rol'  => $this->request->getPost('ID_Rol')
        ]);

        return redirect()->to('/usuarios');
    }

    public function delete($id)
    {
        $model = new UsuarioModel();
        $model->delete($id);

        return redirect()->to('/usuarios');
    }
}
