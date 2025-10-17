<?php

namespace App\Controllers;

use App\Models\CarreraModel;
use App\Models\CategoriaModel;
use CodeIgniter\Controller;

class Carreras extends Controller
{
    public function index()
    {
    $db = \Config\Database::connect();

        // Obtener carreras junto con el nombre de la categoría
        $builder = $db->table('carreras as c');
        $builder->select('c.ID_Carrera, c.Nombre_Carrera, c.ID_Categoria, cat.Categoria AS Nombre_Categoria');
        $builder->join('categorias as cat', 'cat.ID_Categoria = c.ID_Categoria', 'left');
        $query = $builder->get();
        $data['carreras'] = $query->getResultArray();

        return view('carreras/index', $data);
    }

    public function create()
    {
        // Pasar lista de categorías para el select
        $categoriaModel = new CategoriaModel();
        $data['categorias'] = $categoriaModel->findAll();

        return view('carreras/create', $data);
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

        // Lista de categorías para mostrar nombre en select
        $categoriaModel = new CategoriaModel();
        $data['categorias'] = $categoriaModel->findAll();

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