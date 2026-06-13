<?php

namespace App\Models;

use CodeIgniter\Model;

class ShippingMethodModel extends Model
{
    protected $table = 'metode_pengiriman';
    protected $primaryKey = 'id_pengiriman';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_ekspedisi',
        'nama_layanan',
        'tarif',
        'tarif_per_kg',
        'berat_paket',
        'estimasi',
        'status',
    ];
}
