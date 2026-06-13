<?php

namespace App\Models;

use CodeIgniter\Model;

class RefundModel extends Model
{
    protected $table = 'refund';
    protected $primaryKey = 'id_refund';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_pesanan',
        'alasan_refund',
        'waktu_pengajuan',
        'waktu_disetujui',
        'status_refund',
    ];
}
