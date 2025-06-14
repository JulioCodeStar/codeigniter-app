<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableOrdenTrabajo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'codigo' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'necesidad' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'area_responsable' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'aprobado_por' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'actividad' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'descripcion' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'requerido_a' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'responsable' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'tiempo' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('orden_trabajo');
    }

    public function down()
    {
        $this->forge->dropTable('orden_trabajo');
    }
}
