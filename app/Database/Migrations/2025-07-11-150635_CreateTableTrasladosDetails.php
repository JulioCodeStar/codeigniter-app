<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableTrasladosDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'traslado_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'producto_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'cantidad' => [
                'type' => 'INT',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('traslado_id', 'inventory_traslados', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('producto_id', 'inventory_products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory_traslados_details');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_traslados_details');
    }
}
