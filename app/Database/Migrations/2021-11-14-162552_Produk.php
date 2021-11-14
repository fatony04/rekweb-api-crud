<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_produk'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'variant'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'stok' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'harga_beli' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'harga_jual' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ]
        ]);
        
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
