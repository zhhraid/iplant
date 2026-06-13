<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNormalizedCommerceTables extends Migration
{
    public function up()
    {
        // Deprecated. The current app uses the existing phpMyAdmin tables:
        // users, products, orders, order_items, and reviews.
    }

    public function down()
    {
        // No-op.
    }
}
