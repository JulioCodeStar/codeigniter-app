<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePatientsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'cod_paciente' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'nombres' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'apellidos' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'dni' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'genero' => [
                'type' => 'ENUM',
                'constraint' => ['Masculino', 'Femenino'],
            ],
            'edad' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
            'contacto' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'fecha_nacimiento' => [
                'type' => 'DATE',
            ],
            'direccion' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'sede' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'distrito' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'vendedor' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'otro_contacto' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'canal' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'time_ampu' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'motivo_amputacion' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'afecciones' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'alergias' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'observaciones' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => date('Y-m-d H:i:s'),
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'default' => date('Y-m-d H:i:s'),
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('cod_paciente');
        $this->forge->addUniqueKey('dni');
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('pacientes');
    }

    public function down()
    {
        $this->forge->dropTable('pacientes');
    }
}
