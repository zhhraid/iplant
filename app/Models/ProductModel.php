<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_sub_kategori',
        'nama_produk',
        'harga',
        'harga_lama',
        'gambar_produk',
        'stok',
        'deskripsi_produk',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function legacySelect(): self
    {
        return $this
            ->select("
                produk.id_produk AS id,
                produk.id_sub_kategori,
                produk.nama_produk AS name,
                kategori.kategori AS category,
                sub_kategori.sub_kategori AS subcategory,
                produk.harga AS price,
                produk.harga_lama AS old_price,
                produk.gambar_produk AS image_url,
                produk.stok AS stock,
                produk.deskripsi_produk AS description,
                COALESCE(ROUND(AVG(rating.rating), 1), 0) AS rating,
                COUNT(rating.id_rating) AS reviews_count
            ")
            ->join('sub_kategori', 'sub_kategori.id_sub_kategori = produk.id_sub_kategori', 'left')
            ->join('kategori', 'kategori.id_kategori = sub_kategori.id_kategori', 'left')
            ->join('rating', 'rating.id_produk = produk.id_produk', 'left')
            ->groupBy('produk.id_produk');
    }

    public function findLegacy($id): ?array
    {
        return $this->legacySelect()->where('produk.id_produk', $id)->first();
    }

    public function firstLegacy(): ?array
    {
        return $this->legacySelect()->first();
    }

    public function findLegacyByIds(array $ids): array
    {
        if ($ids === []) {
            return [];
        }

        return $this->legacySelect()->whereIn('produk.id_produk', $ids)->findAll();
    }

    public function findLegacyBySubcategories(array $names): array
    {
        return $this->legacySelect()->whereIn('sub_kategori.sub_kategori', $names)->findAll();
    }

    public function findLegacyBySubcategory(string $name): array
    {
        return $this->legacySelect()->where('sub_kategori.sub_kategori', $name)->findAll();
    }

    public function findRelatedLegacy(int $productId, int $limit = 6): array
    {
        return $this->legacySelect()->where('produk.id_produk !=', $productId)->findAll($limit);
    }
}
