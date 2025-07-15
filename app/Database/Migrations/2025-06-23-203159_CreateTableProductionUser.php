<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableProductionUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'char',
                'constraint' => 36,
                'null' => false,
            ],
            'area' => [
                'type' => 'ENUM',
                'constraint' => ['Producción', 'Desarrollo Tecnológico', 'Textil'],
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('production_user');
    }

    public function down()
    {
        $this->forge->dropTable('production_user');
    }
}
