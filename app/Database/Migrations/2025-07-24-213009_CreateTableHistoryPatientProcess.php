<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableHistoryPatientProcess extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'contract_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'process_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['en_proceso', 'completado'],
                'null' => false,
            ],
            'proceso_actual' => [
                'type' => 'BOOLEAN',
                'null' => false,    
                'default' => true,
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
        $this->forge->addForeignKey('contract_id', 'contratos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('process_id', 'history_process_services', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('history_patient_process');
    }

    public function down()
    {
        $this->forge->dropTable('history_patient_process');
    }
}
