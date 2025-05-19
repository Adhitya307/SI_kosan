<?php

namespace App\Controllers;

use App\Models\KamarModel;

class Kamar extends BaseController
{
    public function index()
    {
        $model = new KamarModel();
        $data['kamars'] = $model->findAll();
        return view('kamar/index', $data);
    }

    public function create()
    {
        return view('kamar/create');
    }

    public function store()
    {
        $model = new KamarModel();

        $foto = $this->request->getFile('foto');
        if ($foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads', $newName);
        } else {
            $newName = null;
        }

        $model->save([
            'nama_kamar' => $this->request->getPost('nama_kamar'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'foto' => $newName
        ]);

        return redirect()->to('/kamar');
    }

    public function edit($id)
    {
        $model = new KamarModel();
        $data['kamar'] = $model->find($id);
        return view('kamar/edit', $data);
    }

    public function update($id)
    {
        $model = new KamarModel();
        $data = [
            'nama_kamar' => $this->request->getPost('nama_kamar'),
            'harga' => $this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];

        $foto = $this->request->getFile('foto');
        if ($foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move('uploads', $newName);
            $data['foto'] = $newName;
        }

        $model->update($id, $data);
        return redirect()->to('/kamar');
    }

    public function delete($id)
    {
        $model = new KamarModel();
        $model->delete($id);
        return redirect()->to('/kamar');
    }
}
