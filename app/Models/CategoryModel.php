<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $returnType = 'array';
    protected $allowedFields = ['kategori', 'slug'];
}
