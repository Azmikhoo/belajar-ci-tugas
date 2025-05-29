<?php

namespace App\Controllers;

use App\Models\KategoriProdukModel;

class KategoriProdukController extends BaseController
{
    public function index()
    {
        $model = new KategoriProdukModel();
        $data['kategori'] = $model->findAll();
        return view('v_kategori_produk', $data);
    }

    public function create()
    {
        $model = new KategoriProdukModel();
        $model->save(['nama' => $this->request->getPost('nama')]);
        return redirect()->to(base_url('kategori'))->with('success', 'Kategori ditambahkan.');
    }

    public function edit($id)
    {
        $model = new KategoriProdukModel();
        $model->update($id, ['nama' => $this->request->getPost('nama')]);
        return redirect()->to(base_url('kategori'))->with('success', 'Kategori diubah.');
    }

    public function delete($id)
    {
        $model = new KategoriProdukModel();
        $model->delete($id);
        return redirect()->to(base_url('kategori'))->with('success', 'Kategori dihapus.');
    }
}
