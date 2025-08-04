<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableHistoryProcessServices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'service_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'order' => [
                'type' => 'INT',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('service_id', 'servicios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('history_process_services');
    }

    public function down()
    {
        $this->forge->dropTable('history_process_services');
    }
}
