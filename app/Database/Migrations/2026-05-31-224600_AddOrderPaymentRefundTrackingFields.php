<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOrderPaymentRefundTrackingFields extends Migration
{
    public function up()
    {
        $this->forge->addColumn('orders', [
            'payment_date' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'payment_transfer_to' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ],
            'payment_source_bank' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'null' => true,
            ],
            'payment_account_name' => [
                'type' => 'VARCHAR',
                'constraint' => '120',
                'null' => true,
            ],
            'payment_amount' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'payment_proof' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'payment_confirmed_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'refund_reason' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'refund_requested_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'refund_approved_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'tracking_number' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'null' => true,
            ],
            'shipping_status' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'null' => true,
            ],
            'delivered_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', [
            'payment_date',
            'payment_transfer_to',
            'payment_source_bank',
            'payment_account_name',
            'payment_amount',
            'payment_proof',
            'payment_confirmed_at',
            'refund_reason',
            'refund_requested_at',
            'refund_approved_at',
            'tracking_number',
            'shipping_status',
            'delivered_at',
        ]);
    }
}
