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
}
