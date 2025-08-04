<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableHistoryRegisterProcess extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'history_patient_process_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'fecha_register' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'evaluacion' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'diagnostico' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'pruebas_encaje' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'observaciones' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'tecnico' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->addForeignKey('history_patient_process_id', 'history_patient_process', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('history_register_process');
    }

    public function down()
    {
        $this->forge->dropTable('history_register_process');
    }
}
