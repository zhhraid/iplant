<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderTrackingEvents extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'order_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'event_time' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'sort_order' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('order_id');
        $this->forge->createTable('order_tracking_events');
    }

    public function down()
    {
        $this->forge->dropTable('order_tracking_events');
    }
}
