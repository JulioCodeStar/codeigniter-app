<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableInventoryExits extends Migration
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
                'constraint' => 100,
                'null' => false,
            ],
            'tipo' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'id_paciente' => [
                'type' => 'CHAR',
                'constraint' => 36,
                'null' => true,
            ],
            'nombre_externo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'area_solicitante' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'nombre_solicitante' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'responsable_almacen' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'notas' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'sede_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('area_solicitante', 'areas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_paciente', 'pacientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sede_id', 'sedes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory_exits');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_exits');
    }
}
