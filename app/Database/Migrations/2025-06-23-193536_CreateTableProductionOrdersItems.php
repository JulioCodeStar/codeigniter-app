<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableProductionOrdersItems extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'production_order_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'production_producto_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'cantidad' => [
                'type' => 'INT',
                'null' => false,
            ],
            'especificaciones' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'estado' => [
                'type' => 'ENUM',
                'constraint' => ['pendiente', 'en producción', 'ensablando','terminado', 'entregado', 'cancelado'],
                'null' => false,
                'default' => 'pendiente',
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
        $this->forge->addForeignKey('production_order_id', 'production_orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('production_producto_id', 'production_products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('production_orders_items');
    }

    public function down()
    {
        $this->forge->dropTable('production_orders_items');
    }
}
