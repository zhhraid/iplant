<?php

namespace App\Models;

use CodeIgniter\Model;

class CouponModel extends Model
{
    protected $table = 'kupon';
    protected $primaryKey = 'id_kupon';
    protected $returnType = 'array';
    protected $allowedFields = [
        'kode_kupon',
        'tipe_diskon',
        'jumlah_diskon',
        'minimum_pesanan',
        'status',
    ];
}
