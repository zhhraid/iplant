<?php

namespace App\Models;

use CodeIgniter\Model;

class CartItemModel extends Model
{
    protected $table = 'detail_keranjang';
    protected $primaryKey = 'id_detail_keranjang';
    protected $returnType = 'array';
    protected $allowedFields = ['id_keranjang', 'id_produk', 'jumlah_keranjang'];
}
