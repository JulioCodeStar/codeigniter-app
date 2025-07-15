<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableInventory extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'stock' => [
                'type' => 'DECIMAL',
                'constraint' => [10, 2],
                'default' => 0.00,
                'null' => false,
            ],
            'sede_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
        ]);

        $this->forge->addForeignKey('product_id', 'inventory_products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sede_id', 'sedes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory');
    }

    public function down()
    {
        $this->forge->dropTable('inventory');
    }
}
