<?php

namespace App\Models;

use CodeIgniter\Model;

class SubCategoryModel extends Model
{
    protected $table = 'sub_kategori';
    protected $primaryKey = 'id_sub_kategori';
    protected $returnType = 'array';
    protected $allowedFields = ['id_kategori', 'sub_kategori', 'slug'];
}
