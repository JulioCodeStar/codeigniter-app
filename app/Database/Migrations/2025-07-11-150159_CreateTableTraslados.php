<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTraslados extends Migration
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
                'constraint' => 50,
                'null' => false,
            ],
            'requirement_id' => [
                'type' => 'BIGINT',
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
            'detalles' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'estado' => [
                'type' => 'ENUM',
                'constraint' => ['pendiente', 'aprobado', 'empaquetando', 'en transito', 'recibido', 'cancelado'],
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
        $this->forge->addForeignKey('requirement_id', 'inventory_requirements', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sede_origen', 'sedes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sede_destino', 'sedes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory_traslados');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_traslados');
    }
}
