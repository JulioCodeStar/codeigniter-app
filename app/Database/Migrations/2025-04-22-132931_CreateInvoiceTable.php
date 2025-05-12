<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoiceTable extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id'                => ['type' => 'BIGINT', 'auto_increment' => true],
      'cod_cotizacion'    => ['type' => 'CHAR', 'constraint' => 36, 'unique' => true],
      'paciente_id'       => ['type' => 'CHAR', 'constraint' => 36],
      'encargado'         => ['type' => 'VARCHAR', 'constraint' => 100],

      'servicios_id'      => ['type' => 'BIGINT', 'null' => false,],
      'jobs_id'           => ['type' => 'BIGINT', 'null' => false,],
      'peso'              => ['type' => 'DECIMAL', 'constraint' => '3,2', 'null' => true],

      'moneda'            => ['type' => 'VARCHAR', 'constraint' => 5],
      'monto'             => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true], // Subtotal sin descuentos ni IGV

      'aplica_descuento'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
      'descuento'         => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0.00],

      'igv'               => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],       // checkbox
      'igv_valor'         => ['type' => 'DECIMAL', 'constraint' => '5,2', 'default' => 18.00], // para cálculos

      'monto_final'       => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],

      'ajustes'           => ['type' => 'LONGTEXT', 'null' => true],
      'diagnostico'       => ['type' => 'LONGTEXT', 'null' => true],

      'fecha_now'         => ['type' => 'DATETIME', 'null' => false],
      'fecha_exp'         => ['type' => 'DATETIME', 'null' => false],

      'created_at'        => ['type' => 'DATETIME', 'default' => date('Y-m-d H:i:s')],
      'updated_at'        => ['type' => 'DATETIME', 'default' => date('Y-m-d H:i:s')],
    ]);

    $this->forge->addPrimaryKey('id');
    $this->forge->addForeignKey('paciente_id', 'pacientes', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('servicios_id', 'servicios', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('jobs_id', 'jobs', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('cotizaciones');
  }

  public function down()
  {
    $this->forge->dropTable('cotizaciones');
  }
}
