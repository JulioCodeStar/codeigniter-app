<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableInvoiceList extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id'              => [ 'type' => 'BIGINT', 'auto_increment' => true ],
          'cotizacion_id'   => [ 'type' => 'BIGINT', 'null' => false ],
          'title'           => [ 'type' => 'VARCHAR', 'constraint' => '100', 'null' => false],
          'descripcion'     => [ 'type' => 'VARCHAR', 'constraint' => '100', 'null' => false],
          'cantidad'        => [ 'type' => 'INT', 'null' => false]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('cotizacion_id', 'cotizaciones', 'id', 'CASCADE', 'CASCADE', 'cotizacion_list_invoice_fk');
        $this->forge->createTable('cotizaciones_list');
    }

    public function down()
    {
        $this->forge->dropTable('cotizaciones_list');
    }
}
