<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableReportes extends Migration
{
    public function up()
    {
      $this->forge->addField([
        'id'              => [ 'type' => 'BIGINT', 'auto_increment' => true ],
        'caja_id'         => [ 'type' => 'BIGINT', 'null' => false ],
        'generedo_por'    => [ 'type' => 'CHAR', 'constraint' => 36, 'null' => false ],
        'generado_en'     => [ 'type' => 'TEXT', 'null' => false ],
      ]);

      $this->forge->addPrimaryKey('id');
      $this->forge->addForeignKey('generedo_por', 'pacientes', 'id', 'CASCADE', 'CASCADE');
      $this->forge->addForeignKey('caja_id', 'cajas', 'id', 'CASCADE', 'CASCADE');
      $this->forge->createTable('reportes');
    }

    public function down()
    {
      $this->forge->dropTable('reportes');
    }
}
