<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class PembelianController extends BaseController
{
    protected $transaksi;
    protected $detail;

    public function __construct()
    {
        helper(['form', 'number']);
        $this->transaksi = new TransactionModel();
        $this->detail = new TransactionDetailModel();
    }

    public function index()
    {
        $transactions = $this->transaksi->orderBy('created_at', 'DESC')->findAll();

        foreach ($transactions as &$transaksi) {
            $transaksi['detail'] = $this->detail->getDetailWithProduct($transaksi['id']);
        }

        return view('v_pembelian', ['transactions' => $transactions]);
    }

    public function ubahStatus($id)
    {
        $transaksi = $this->transaksi->find($id);
        if ($transaksi) {
            $statusBaru = $transaksi['status'] == 1 ? 0 : 1;
            $this->transaksi->update($id, ['status' => $statusBaru]);
        }

        return redirect()->to(base_url('pembelian'))->with('success', 'Status berhasil diubah.');
    }
}
