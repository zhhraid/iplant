<?php

namespace App\Models;

use CodeIgniter\Model;

class BuyerInfoModel extends Model
{
    protected $table = 'informasi_pembeli';
    protected $primaryKey = 'id_informasi_pembeli';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_pengguna',
        'email_pembeli',
        'nama_pembeli',
        'provinsi',
        'kota_kabupaten',
        'kecamatan',
        'alamat',
        'kode_pos',
        'telepon',
    ];
}
