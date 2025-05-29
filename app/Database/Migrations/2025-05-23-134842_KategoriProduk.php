<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
                'unique'     => TRUE,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('kategori_produk');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_produk');
    }
}
