<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpeditionModel extends Model
{
    protected $table = 'ekspedisi';
    protected $primaryKey = 'id_ekspedisi';
    protected $returnType = 'array';
    protected $allowedFields = ['nama_ekspedisi', 'kode_ekspedisi', 'logo'];
}
