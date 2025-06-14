<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableConsentimiento extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'contrato_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'fecha_entrega' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'items' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('contrato_id', 'contratos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('consentimiento');
    }

    public function down()
    {
        $this->forge->dropTable('consentimiento');
    }
}
