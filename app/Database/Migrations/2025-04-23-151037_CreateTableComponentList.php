<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableComponentList extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id'              => [ 'type' => 'BIGINT', 'auto_increment' => true ],
          'component_id'    => [ 'type' => 'BIGINT', 'null' => false ],
          'items'           => [ 'type' => 'VARCHAR', 'constraint' => 200 , 'null' => false ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('component_id', 'components', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('componentes_list');
    }

    public function down()
    {
        $this->forge->dropTable('componentes_list');
    }
}
