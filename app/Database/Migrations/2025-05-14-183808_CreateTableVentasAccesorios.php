<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableVentasAccesorios extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id'              => ['type' => 'BIGINT', 'auto_increment' => true],
      'n_boleta'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
      'cotizacion_id'   => ['type' => 'BIGINT', 'null' => false],
      'paciente_id'     => ['type' => 'CHAR', 'constraint' => 36, 'null' => false],
      'fecha_inicio'    => ['type' => 'DATE',  'null', false],
      'fecha_garantia'  => ['type' => 'DATE', 'null', false],
      'monto_total'     => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => false],
      'moneda'          => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
      'user_id'         => ['type' => 'CHAR', 'constraint' => 36, 'null' => false],
      'created_at'      => ['type' => 'DATETIME', 'default' => date('Y-m-d H:i:s')],
      'updated_at'      => ['type' => 'DATETIME', 'default' => date('Y-m-d H:i:s')],
    ]);

    $this->forge->addPrimaryKey('id');
    $this->forge->addForeignKey('cotizacion_id', 'cotizaciones', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('paciente_id', 'pacientes', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('ventas_accesorios');
  }

  public function down()
  {
    $this->forge->dropTable('ventas_accesorios');
  }
}
