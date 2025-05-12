<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableSede extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id'            => [ 'type' => 'BIGINT', 'auto_increment' => true ],
          'sucursal'      => [ 'type' => 'VARCHAR', 'constraint' => 100, 'null' => false ],
          'descripcion'   => [ 'type' => 'TEXT', 'null' => true ],
          'created_at'    => [ 'type' => 'DATETIME', 'default' => date('Y-m-d H:i:s') ],
          'updated_at'    => [ 'type' => 'DATETIME', 'default' => date('Y-m-d H:i:s')]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('sedes');
    }

    public function down()
    {
        $this->forge->dropTable('sedes');
    }
}
