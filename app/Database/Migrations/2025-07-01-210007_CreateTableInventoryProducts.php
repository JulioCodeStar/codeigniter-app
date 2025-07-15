<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableInventoryProducts extends Migration
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
                'unique' => true,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'descripcion' => [
                'type' => 'TEXT',
            ],
            'area_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'unidad_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'categoria' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'stock_min' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'stock_max' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'requiere_serie' => [
                'type' => 'BOOLEAN',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('area_id', 'areas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('unidad_id', 'unidades', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory_products');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_products');
    }
}
