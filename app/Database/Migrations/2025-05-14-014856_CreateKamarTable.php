<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKamarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kamar'  => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status'      => [
                'type'       => 'ENUM',
                'constraint' => ['tersedia', 'terisi'],
                'default'    => 'tersedia',
            ],
            'harga'       => [
                'type'       => 'INT',
                'constraint' => '11',
            ],
            'deskripsi'   => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'gambar'      => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kamar');
    }

    public function down()
    {
        $this->forge->dropTable('kamar');
    }
}
