<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskonModel;

    public function __construct()
    {
        $this->diskonModel = new DiskonModel();
    }

    public function index()
    {
        $data['diskonList'] = $this->diskonModel->findAll();
        return view('v_diskon', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('id');
        $tanggal = $this->request->getPost('tanggal');
        $nominal = $this->request->getPost('nominal');

        if (!$id) {
            // Tambah data baru → periksa apakah tanggal sudah ada
            $exist = $this->diskonModel->where('tanggal', $tanggal)->first();
            if ($exist) {
                return redirect()->back()->with('failed', 'The tanggal field contain a unique value.');
            }

            $this->diskonModel->save([
                'tanggal' => $tanggal,
                'nominal' => $nominal
            ]);

            return redirect()->back()->with('success', 'Diskon berhasil ditambahkan.');
        } else {
            // Edit data → update tanggal & nominal
            $this->diskonModel->update($id, [
                'tanggal' => $tanggal,
                'nominal' => $nominal
            ]);

            return redirect()->back()->with('success', 'Diskon berhasil diperbarui.');
        }
    }

    public function delete($id)
    {
        $this->diskonModel->delete($id);
        return redirect()->back()->with('success', 'Diskon berhasil dihapus.');
    }
}
