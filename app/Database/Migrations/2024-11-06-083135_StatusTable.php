<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'status_name' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('status');
    }

    public function down()
    {
        $this->forge->dropTable('status');
    }
}
