<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableInventoryProductsSerials extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'inventory_product_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'serial' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'estado' => [
                'type' => 'ENUM',
                'constraint' => ['Disponible', 'Utilizado', 'Dañado', 'Perdido'],
                'default' => 'Disponible',
                'null' => false,
            ],
            'sede_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'inventory_entries_details_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'inventory_exits_details_id' => [
                'type' => 'BIGINT',
                'null' => true,
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
        $this->forge->addForeignKey('inventory_product_id', 'inventory_products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sede_id', 'sedes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('inventory_entries_details_id', 'inventory_entries_details', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('inventory_exits_details_id', 'inventory_exits_details', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory_products_serials');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_products_serials');
    }
}
