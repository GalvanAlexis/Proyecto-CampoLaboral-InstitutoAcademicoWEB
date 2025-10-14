<?php

namespace App\Controllers;

use App\Models\CarreraModel;
use CodeIgniter\Controller;

class Carreras extends Controller
{
    public function index()
    {
        $model = new CarreraModel();
        $data['carreras'] = $model->findAll();

        return view('carreras/index', $data);
    }

    public function create()
    {
        return view('carreras/create');
    }

    public function store()
    {
        $model = new CarreraModel();

        $model->insert([
            'Nombre_Carrera'   => $this->request->getPost('Nombre_Carrera'),
            'ID_Categoria' => $this->request->getPost('ID_Categoria')
        ]);

        return redirect()->to('/carreras');
    }

    public function edit($id)
    {
        $model = new CarreraModel();
        $data['carreras'] = $model->find($id);

        return view('carreras/edit', $data);
    }

    public function update($id)
    {
        $model = new CarreraModel();

        $model->update($id, [
            'Nombre_Carrera'   => $this->request->getPost('Nombre_Carrera'),
            'ID_Categoria' => $this->request->getPost('ID_Categoria')
        ]);

        return redirect()->to('/carreras');
    }

    public function delete($id)
    {
        $model = new CarreraModel();
        $model->delete($id);

        return redirect()->to('/carreras');
    }
}