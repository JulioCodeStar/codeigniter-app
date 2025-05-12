<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePagos extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id'              => [ 'type' => 'BIGINT', 'auto_increment' => true ],
          'modulo'          => [ 'type' => 'ENUM', 'constraint' => ['contrato', 'venta', 'cita', 'mantenimiento'], 'null' => false ],
          'referencia_id'   => [ 'type' => 'BIGINT', 'null' => false ],
          'paciente_id'     => [ 'type' => 'CHAR', 'constraint' => 36 ],
          'tip_pago'        => [ 'type' => 'VARCHAR', 'constraint' => 100, 'null' => false ],
          'moneda'          => [ 'type' => 'VARCHAR', 'constraint' => 10, 'null' => false],
          'monto'           => [ 'type' => 'DECIMAL', 'constraint' => '10,2', 'null' => false ],
          'observaciones'   => [ 'type' => 'TEXT', 'null' => true ],
          'created_at'      => [ 'type' => 'DATETIME', 'default' => date('Y-m-d H:i:s') ],
          'updated_at'      => [ 'type' => 'DATETIME', 'default' => date('Y-m-d H:i:s') ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('paciente_id', 'pacientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pagos');
    }

    public function down()
    {
        $this->forge->dropTable('pagos');
    }
}
