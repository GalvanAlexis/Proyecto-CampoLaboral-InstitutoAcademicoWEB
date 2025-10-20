<?php

namespace App\Controllers;

use App\Models\TurnoModel;
use App\Models\ProfesorModel;
use App\Models\CarreraModel;
use CodeIgniter\Controller;

class Turnos extends Controller
{
    public function index()
    {
        $model = new TurnoModel();
        // Usar método del modelo que trae relaciones
        if (method_exists($model, 'getTurnosConRelaciones')) {
            $data['turnos'] = $model->getTurnosConRelaciones();
        } else {
            $data['turnos'] = $model->findAll();
        }

        return view('turnos/index', $data);
    }

    public function create()
    {
        $profesorModel = new ProfesorModel();
        $carreraModel = new CarreraModel();

        $data['profesores'] = $profesorModel->findAll();
        $data['carreras'] = $carreraModel->findAll();

        return view('turnos/create', $data);
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
        $profesorModel = new ProfesorModel();
        $carreraModel = new CarreraModel();

        $data['profesores'] = $profesorModel->findAll();
        $data['carreras'] = $carreraModel->findAll();

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
