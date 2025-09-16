<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlumnoModel;

class Alumno extends BaseController
{
    // Propiedad para el modelo
    protected $model;

    // Carga el modelo en el constructor
    public function __construct()
    {
        $this->model = new AlumnoModel();
    }

    // Listar todos los alumnos
    public function index()
    {
        $data['alumnos'] = $this->model->findAll();
        return view('alumnos/index', $data);
    }

    // Mostrar el formulario para crear un nuevo alumno
    public function new()
    {
        return view('alumnos/create');
    }

    // Guardar un nuevo alumno
    public function create()
    {
        if (!$this->validate([
            'Nombre_Completo' => 'required|min_length[3]|max_length[255]',
            'DNI' => 'required|numeric|is_unique[alumnos.DNI]',
            'Email' => 'required|valid_email|is_unique[alumnos.Email]'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->save($this->request->getPost());

        return redirect()->to('/alumnos')->with('success', 'Alumno creado correctamente.');
    }

    // Mostrar el formulario para editar un alumno
    public function edit($id)
    {
        $data['alumno'] = $this->model->find($id);
        return view('alumnos/edit', $data);
    }

    // Actualizar un alumno existente
    public function update($id)
    {
        $rules = [
            'Nombre_Completo' => 'required|min_length[3]|max_length[255]',
            'DNI' => 'required|numeric',
            'Email' => 'required|valid_email'
        ];

        // Se agrega la regla de unicidad solo si el email ha cambiado
        if ($this->request->getPost('Email') !== $this->model->find($id)['Email']) {
            $rules['Email'] .= '|is_unique[alumnos.Email]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, $this->request->getPost());

        return redirect()->to('/alumnos')->with('success', 'Alumno actualizado correctamente.');
    }

    // Eliminar un alumno (soft delete)
    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/alumnos')->with('success', 'Alumno eliminado correctamente.');
    }
}