<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableInventoryEntriesDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'inventory_entry_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'product_id' => [
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
        $this->forge->addForeignKey('inventory_entry_id', 'inventory_entries', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('product_id', 'inventory_products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory_entries_details');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_entries_details');
    }
}
