<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orders extends Migration
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
            'invoice_no' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'customer_email' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'newsletter' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'customer_name' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'customer_city' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'customer_address' => ['type' => 'TEXT'],
            'customer_zip' => ['type' => 'VARCHAR', 'constraint' => '20'],
            'customer_phone' => ['type' => 'VARCHAR', 'constraint' => '30'],
            'is_dropshipper' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
            ],
            'dropshipper_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'dropshipper_phone' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => true,
            ],
            'shipping_courier' => ['type' => 'VARCHAR', 'constraint' => '50', 'null' => true],
            'shipping_cost' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'subtotal' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'unique_code' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'total_amount' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'default' => 'pending',
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
