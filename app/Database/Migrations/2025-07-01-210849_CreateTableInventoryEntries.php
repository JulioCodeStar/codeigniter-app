<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableInventoryEntries extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'BIGINT',
                'auto_increment' => true,
            ],
            'codigo' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
            ],
            'tipo' => [
                'type' => 'ENUM',
                'constraint' => ['Factura', 'Stock'],
                'null' => false,
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'fecha_documento' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'responsable' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'proveedor' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'sede_id' => [
                'type' => 'BIGINT',
                'null' => false,
            ],
            'observacion' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('sede_id', 'sedes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('inventory_entries');
    }

    public function down()
    {
        $this->forge->dropTable('inventory_entries');
    }
}
