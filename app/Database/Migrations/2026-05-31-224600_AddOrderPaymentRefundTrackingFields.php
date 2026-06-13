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
                'after' => 'created_at',
            ],
            'payment_transfer_to' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
                'after' => 'payment_date',
            ],
            'payment_source_bank' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'null' => true,
                'after' => 'payment_transfer_to',
            ],
            'payment_account_name' => [
                'type' => 'VARCHAR',
                'constraint' => '120',
                'null' => true,
                'after' => 'payment_source_bank',
            ],
            'payment_amount' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'after' => 'payment_account_name',
            ],
            'payment_proof' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
                'after' => 'payment_amount',
            ],
            'payment_confirmed_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'payment_proof',
            ],
            'refund_reason' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'payment_confirmed_at',
            ],
            'refund_requested_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'refund_reason',
            ],
            'refund_approved_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'refund_requested_at',
            ],
            'tracking_number' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'null' => true,
                'after' => 'refund_approved_at',
            ],
            'shipping_status' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
                'null' => true,
                'after' => 'tracking_number',
            ],
            'delivered_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'shipping_status',
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
