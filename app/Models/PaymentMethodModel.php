<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodModel extends Model
{
    protected $table = 'metode_pembayaran';
    protected $primaryKey = 'id_metode';
    protected $returnType = 'array';
    protected $allowedFields = [
        'nama_bank',
        'no_rekening',
        'nama_pemilik',
        'status',
    ];
}
