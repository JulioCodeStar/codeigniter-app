<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServiceTable extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id'          => ['type' => 'BIGINT', 'auto_increment' => true ],
      'descripcion' => ['type' => 'VARCHAR', 'constraint' => 100 ]
    ]);

    $this->forge->addPrimaryKey('id');
    $this->forge->createTable('servicios');
  }

  public function down()
  {
    $this->forge->dropTable('servicios');
  }
}
