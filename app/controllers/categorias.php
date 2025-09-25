<?php

namespace App\Controllers;

use App\Models\CategoriaModel;
use CodeIgniter\Controller;

class Categorias extends Controller
{
    public function index()
    {
        $model = new CategoriaModel();
        $data['categorias'] = $model->findAll();

        return view('categorias/index', $data);
    }

    public function create()
    {
        return view('categorias/create');
    }

    public function store()
    {
        $model = new CategoriaModel();

        $model->insert([
            'Categoria'   => $this->request->getPost('Categoria')
        ]);

        return redirect()->to('/categorias');
    }

    public function edit($id)
    {
        $model = new CategoriaModel();
        $data['categorias'] = $model->find($id);

        return view('categorias/edit', $data);
    }

    public function update($id)
    {
        $model = new CategoriaModel();

        $model->update($id, [
            'Categoria'   => $this->request->getPost('Categoria')
        ]);

        return redirect()->to('/categorias');
    }

    public function delete($id)
    {
        $model = new CategoriaModel();
        $model->delete($id);

        return redirect()->to('/categorias');
    }
}