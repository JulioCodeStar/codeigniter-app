<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableReporteCurrency extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id'              => ['type' => 'BIGINT', 'auto_increment' => true],
      'reporte_id'      => ['type' => 'BIGINT', 'null' => false],
      'moneda'          => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => false],
      'total'           => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => false],
    ]);

    $this->forge->addPrimaryKey('id');
    $this->forge->addForeignKey('reporte_id', 'reportes', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('reportes_monedas');
  }

  public function down()
  {
    $this->forge->dropTable('reportes_monedas');
  }
}
