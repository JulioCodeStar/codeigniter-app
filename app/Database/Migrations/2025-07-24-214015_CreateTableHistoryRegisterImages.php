<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableHistoryRegisterImages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'history_register_process_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'ruta_imagen' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('history_register_process_id', 'history_register_process', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('history_register_images');
    }

    public function down()
    {
        $this->forge->dropTable('history_register_images');
    }
}
