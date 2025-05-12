<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableMovimientos extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id'          => [ 'type' => 'BIGINT', 'auto_increment' => true ],
          'user_id'     => [ 'type' => 'CHAR', 'constraint' => 36, 'null' => false ],
          'caja_id'     => [ 'type' => 'BIGINT', 'null' => false ],
          'tipo'        => [ 'type' => 'ENUM', 'constraint' => ['pago_contrato', 'pago_venta', 'pago_cita', 'pago_mantenimiento'], 'null' => false ],
          'descripcion' => [ 'type' => 'TEXT', 'null' => false ],
          'moneda'      => [ 'type' => 'VARCHAR', 'constraint' => 10, 'null' => false ],
          'total'       => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => false ],
          'created_at'    => [ 'type' => 'DATETIME', 'default' => date('Y-m-d H:i:s') ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('caja_id', 'cajas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('movimientos');
    }

    public function down()
    {
        $this->forge->dropTable('movimientos');
    }
}
