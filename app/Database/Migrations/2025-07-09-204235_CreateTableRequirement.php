<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableRequirement extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
                'null' => false,
            ],
            'codigo' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'unique' => true,
            ],
            'area_solicitante' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'nombre_solicitante' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
            ],
            'sede_origen' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'sede_destino' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'items' => [
                'type' => 'JSON',
            ],
            'estado' => [
                'type' => 'ENUM',
                'constraint' => ['pendiente', 'aprobado', 'empaquetando', 'en transito', 'recibido', 'cancelado'],
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
        $this->forge->addForeignKey('sede_origen', 'sedes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sede_destino', 'sedes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory_requirements');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_requirements');
    }
}
