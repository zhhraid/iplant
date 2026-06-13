<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'id_blog';
    protected $returnType = 'array';
    protected $allowedFields = [
        'slug',
        'judul_blog',
        'gambar',
        'konten_blog',
        'tanggal_publish',
    ];
}
