<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableProductionOrdersItemsStatusLogs extends Migration
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
            'estado' => [
                'type' => 'ENUM',
                'constraint' => ['pendiente', 'en producción', 'ensablando','terminado', 'entregado', 'cancelado'],
                'null' => false,
                'default' => 'pendiente',
            ],
            'notas' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'usuario' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('production_order_item_id', 'production_orders_items', 'id', 'CASCADE', 'CASCADE', 'fk_order_item_id_production_orders_items_status_logs');
        $this->forge->createTable('production_orders_items_status_logs');
    }

    public function down()
    {
        $this->forge->dropTable('production_orders_items_status_logs');
    }
}
