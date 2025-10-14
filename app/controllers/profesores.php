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
}
