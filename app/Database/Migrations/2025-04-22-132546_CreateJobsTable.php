<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJobsTable extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id'          => ['type' => 'BIGINT', 'auto_increment' => true ],
      'servicios_id'  => ['type' => 'BIGINT' ],
      'descripcion' => ['type' => 'VARCHAR', 'constraint' => 100 ]
    ]);

    $this->forge->addPrimaryKey('id');
    $this->forge->addForeignKey('servicios_id', 'servicios', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('jobs');
  }

  public function down()
  {
    $this->forge->dropTable('jobs');
  }
}