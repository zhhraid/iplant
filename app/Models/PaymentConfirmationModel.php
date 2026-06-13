<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentConfirmationModel extends Model
{
    protected $table = 'konfirmasi_pembayaran';
    protected $primaryKey = 'id_pembayaran';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_pesanan',
        'id_metode',
        'waktu_pembayaran',
        'bank_asal',
        'nama_pemilik',
        'jumlah',
        'bukti_transfer',
        'waktu_konfirmasi',
        'status_konfirmasi',
    ];
}
