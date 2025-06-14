<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableOrdenCompra extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true
            ],
            'codigo' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'proveedor_id' => [
                'type' => 'BIGINT',
                'null' => true
            ],
            'area' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'forma_pago' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'moneda' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false
            ],
            'total' => [
                'type' => 'DECIMAL',
                'null' => false
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['aprobado', 'pendiente', 'cancelado'],
                'default' => 'pendiente',
                'null' => false
            ],
            'items' => [
                'type' => 'JSON',
                'null' => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('proveedor_id', 'proveedores', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orden_compra');
    }

    public function down()
    {
        $this->forge->dropTable('orden_compra');
    }
}
