<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);

        // Claves primarias compuestas
        $this->forge->addPrimaryKey(['user_id', 'role_id']);
        
        // Claves foráneas
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('role_id', 'roles', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('user_roles');
    }

    public function down()
    {
        $this->forge->dropTable('user_roles');
    }
}
