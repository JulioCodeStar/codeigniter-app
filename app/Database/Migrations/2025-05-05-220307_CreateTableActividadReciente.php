<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableActividadReciente extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id'              => [ 'type' => 'BIGINT', 'auto_increment' => true ],
          'user_id'         => [ 'type' => 'CHAR', 'constraint' => 36, 'null' => false ],
          'movimiento_id'   => [ 'type' => 'BIGINT', 'null' => false ],
          'accion'          => [ 'type' => 'ENUM', 'constraint' => ['crear', 'editar', 'actualizar', 'eliminar'], 'null' => false ],
          'descripcion'     => [ 'type' => 'TEXT', 'null' => false ],
          'created_at'      => [ 'type' => 'DATETIME', 'default' => date('Y-m-d H:i:s') ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'pacientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('movimiento_id', 'movimientos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('actividad_reciente');
    }

    public function down()
    {
      $this->forge->dropTable('actividad_reciente');
    }
}
