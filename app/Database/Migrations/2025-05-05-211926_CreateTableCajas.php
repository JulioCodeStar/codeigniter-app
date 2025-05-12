<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableCajas extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id'            => [ 'type' => 'BIGINT', 'auto_increment' => true],
          'user_id'       => [ 'type' => 'CHAR', 'constraint' => 36, 'null' => false ],
          'sede_id'       => [ 'type' => 'BIGINT', 'null' => false ],
          'hora_apertura' => [ 'type' => 'DATETIME', 'null' => false ],
          'hora_cierre'   => [ 'type' => 'DATETIME', 'null' => true ],
          'estado'        => [ 
            'type'        => 'ENUM', 
            'constraint'  => ['abierta', 'cerrada'], 
            'default'     => 'abierta' 
          ],
          'created_at'    => [ 'type' => 'DATETIME', 'default' => date('Y-m-d H:i:s') ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('sede_id', 'sedes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cajas');
    }

    public function down()
    {
        $this->forge->dropTable('cajas');
    }
}
