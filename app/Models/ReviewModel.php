<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table            = 'rating';
    protected $primaryKey       = 'id_rating';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    protected $validationRules      = [
        'id_pesanan' => 'required|integer',
        'id_produk'  => 'required|integer',
        'rating'     => 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]',
        'review'     => 'required',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = ['mapLegacyData'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['mapLegacyData'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['appendLegacyData'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function where($key = null, $value = null, ?bool $escape = null)
    {
        if ($key === 'order_id') {
            $key = 'id_pesanan';
        } elseif ($key === 'product_id') {
            $key = 'id_produk';
        }

        return parent::where($key, $value, $escape);
    }

    protected function mapLegacyData(array $data): array
    {
        if (! isset($data['data'])) {
            return $data;
        }

        $map = [
            'order_id' => 'id_pesanan',
            'product_id' => 'id_produk',
            'review_text' => 'review',
            'image_url' => 'gambar',
        ];

        foreach ($map as $old => $new) {
            if (array_key_exists($old, $data['data'])) {
                $data['data'][$new] = $data['data'][$old];
                unset($data['data'][$old]);
            }
        }

        unset($data['data']['user_name']);

        return $data;
    }

    protected function appendLegacyData(array $data): array
    {
        if (! isset($data['data'])) {
            return $data;
        }

        if (isset($data['data'][$this->primaryKey])) {
            $data['data'] = $this->legacyRow($data['data']);
            return $data;
        }

        foreach ($data['data'] as &$row) {
            if (is_array($row)) {
                $row = $this->legacyRow($row);
            }
        }

        return $data;
    }

    private function legacyRow(array $row): array
    {
        $row['id'] = $row['id_rating'] ?? null;
        $row['order_id'] = $row['id_pesanan'] ?? null;
        $row['product_id'] = $row['id_produk'] ?? null;
        $row['review_text'] = $row['review'] ?? null;
        $row['image_url'] = $row['gambar'] ?? null;

        return $row;
    }
}
