<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionDetailModel extends Model
{
    protected $table = 'transaction_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'transaction_id',
        'product_id',
        'jumlah',
        'diskon',
        'subtotal_harga',
        'created_at',
        'updated_at'
    ];

    public function getDetailWithProduct($transactionId)
    {
        return $this->db->table('transaction_detail td')
            ->select('td.*, p.nama as nama, p.harga as harga, p.foto as foto')
            ->join('product p', 'p.id = td.product_id')
            ->where('td.transaction_id', $transactionId)
            ->get()
            ->getResultArray();
    }
}
