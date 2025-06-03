<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePermissionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'nombres' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'seccion' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'sub_seccion' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'accion' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('permisos');
    }

    public function down()
    {
        $this->forge->dropTable('permisos');
    }
}
