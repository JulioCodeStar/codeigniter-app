<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableProductionOrders extends Migration
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
                'unique' => false,
            ],
            'tip_orden' => [
                'type' => 'ENUM',
                'constraint' => ['Paciente', 'Proyecto', 'Prueba', 'Stock', 'Otros'],
                'null' => false,
            ],
            'paciente_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
                'null' => true,
            ],
            'nombre_externo' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'fecha_solicitud' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'fecha_entrega' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'notas' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'estado' => [
                'type' => 'TINYINT',
                'null' => false,
                'default' => 1,
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
        $this->forge->createTable('production_orders');
    }

    public function down()
    {
        $this->forge->dropTable('production_orders');
    }
}
