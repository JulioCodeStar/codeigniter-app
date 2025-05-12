<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableCajaAcceso extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'id'            => [ 'type' => 'INT', 'auto_increment' => true ],
      'user_id'       => [ 'type' => 'CHAR', 'constraint' => 36, 'null' => false ],
      'sede_id'       => [ 'type' => 'BIGINT', 'null' => false ],
      'is_active'     => [ 'type' => 'BOOLEAN', 'default' => true ],
      'created_at'    => [ 'type' => 'DATETIME', 'default' => date('Y-m-d H:i:s') ],
    ]);

    $this->forge->addPrimaryKey('id');
    $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->addForeignKey('sede_id', 'sedes', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('caja_accesos');
  }

  public function down()
  {
    $this->forge->dropTable('caja_accesos');
  }
}
