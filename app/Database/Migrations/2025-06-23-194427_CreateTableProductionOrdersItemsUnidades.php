<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableProductionOrdersItemsUnidades extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'production_order_item_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'numero_serie_production' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('production_order_item_id', 'production_orders_items', 'id', 'CASCADE', 'CASCADE', 'fk_order_item_id_production_orders_items');
        $this->forge->createTable('production_orders_items_unidades');
    }

    public function down()
    {
        $this->forge->dropTable('production_orders_items_unidades');
    }
}
