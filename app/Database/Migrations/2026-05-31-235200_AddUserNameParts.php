<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserNameParts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'null' => true,
                'after' => 'name',
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'null' => true,
                'after' => 'first_name',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['first_name', 'last_name']);
    }
}
