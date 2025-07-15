<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUnidades extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'nombres' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'abreviatura' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('unidades');
    }

    public function down()
    {
        $this->forge->dropTable('unidades');
    }
}
