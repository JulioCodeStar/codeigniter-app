<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableInventoryExitsDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'inventory_exit_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'inventory_product_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'cantidad' => [
                'type' => 'DECIMAL',
                'constraint' => [10, 2],
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('inventory_exit_id', 'inventory_exits', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('inventory_product_id', 'inventory_products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory_exits_details');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_exits_details');
    }
}
