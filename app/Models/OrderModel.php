<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'invoice_no', 'customer_email', 'newsletter', 'customer_name', 
        'customer_city', 'customer_address', 'customer_zip', 'customer_phone',
        'is_dropshipper', 'dropshipper_name', 'dropshipper_phone',
        'shipping_courier', 'shipping_cost', 'subtotal', 'unique_code', 
        'total_amount', 'status', 'created_at', 'payment_date',
        'payment_transfer_to', 'payment_source_bank', 'payment_account_name',
        'payment_amount', 'payment_proof', 'payment_confirmed_at',
        'refund_reason', 'refund_requested_at', 'refund_approved_at',
        'tracking_number', 'shipping_status', 'delivered_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
