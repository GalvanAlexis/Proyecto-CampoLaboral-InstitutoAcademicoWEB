<?php

namespace App\Controllers;

use App\Models\TurnoModel;
use CodeIgniter\Controller;

class Turnos extends Controller
{
    public function index()
    {
        $model = new TurnoModel();
        $data['turnos'] = $model->findAll();

        return view('turnos/index', $data);
    }

    public function create()
    {
        return view('turnos/create');
    }

    public function store()
    {
        $model = new TurnoModel();

        $model->insert([
            'Turno'       => $this->request->getPost('Turno'),
            'ID_Profesor' => $this->request->getPost('ID_Profesor'),
            'ID_Carrera'  => $this->request->getPost('ID_Carrera'),
        ]);

        return redirect()->to('/turnos');
    }

    public function edit($id)
    {
        $model = new TurnoModel();
        $data['turno'] = $model->find($id);

        return view('turnos/edit', $data);
    }

    public function update($id)
    {
        $model = new TurnoModel();

        $model->update($id, [
            'Turno'       => $this->request->getPost('Turno'),
            'ID_Profesor' => $this->request->getPost('ID_Profesor'),
            'ID_Carrera'  => $this->request->getPost('ID_Carrera'),
        ]);

        return redirect()->to('/turnos');
    }

    public function delete($id)
    {
        $model = new TurnoModel();
        $model->delete($id);

        return redirect()->to('/turnos');
    }
}
