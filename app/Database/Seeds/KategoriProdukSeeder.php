<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriProdukSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Laptop Gaming',
                'deskripsi' => 'Kategori untuk laptop dengan spesifikasi tinggi untuk kebutuhan gaming.',
            ],
            [
                'nama' => 'Laptop Bisnis',
                'deskripsi' => 'Laptop ringan dan efisien untuk keperluan bisnis dan kerja profesional.',
            ],
            [
                'nama' => 'Laptop Pelajar',
                'deskripsi' => 'Laptop dengan harga terjangkau yang cocok untuk kebutuhan belajar.',
            ]
        ];

        foreach ($data as $item) {
            $this->db->table('kategori_produk')->insert($item);
        }
    }
}
