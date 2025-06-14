<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableOrdenImportacion extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'codigo' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'area' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Pendiente', 'En Proceso', 'Completado'],
                'default' => 'Pendiente',
            ],
            'items' => [
                'type' => 'JSON',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('orden_importacion');
    }

    public function down()
    {
        $this->forge->dropTable('orden_importacion');
    }
}
