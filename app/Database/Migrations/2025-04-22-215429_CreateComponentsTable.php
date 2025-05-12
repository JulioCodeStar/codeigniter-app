<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateComponentsTable extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id'            => ['type' => 'BIGINT', 'auto_increment' => true],
      'job_id'        => ['type' => 'BIGINT', 'null' => false],
      'description'   => ['type' => 'VARCHAR', 'constraint' => '200'],
      'cantidad'      => ['type' => 'INT', 'null' => false, 'default' => 1]
    ]);

    $this->forge->addPrimaryKey('id');
    $this->forge->addForeignKey('job_id', 'jobs', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('components');
  }

  public function down()
  {
    $this->forge->dropTable('components');
  }
}
