<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolePermissionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'permisos_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addPrimaryKey(['role_id', 'permisos_id']);
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('permisos_id', 'permisos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('role_permisos');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('role_permisos', 'role_permisos_role_id_foreign');
        // $this->forge->dropForeignKey('role_permisos', 'role_permisos_permisos_id_foreign');
        $this->forge->dropTable('role_permisos');
    }
}
