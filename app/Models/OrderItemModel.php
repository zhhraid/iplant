<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table            = 'detail_pesanan';
    protected $primaryKey       = 'id_detail_pesanan';
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

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = ['mapLegacyData'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
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
            'product_name' => 'nama_produk',
            'quantity' => 'jumlah_pesan',
            'price' => 'harga_saat_beli',
        ];

        foreach ($map as $old => $new) {
            if (array_key_exists($old, $data['data'])) {
                $data['data'][$new] = $data['data'][$old];
                unset($data['data'][$old]);
            }
        }

        $data['data']['subtotal_item'] = (int) ($data['data']['jumlah_pesan'] ?? 0) * (int) ($data['data']['harga_saat_beli'] ?? 0);

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
        $row['id'] = $row['id_detail_pesanan'] ?? null;
        $row['order_id'] = $row['id_pesanan'] ?? null;
        $row['product_id'] = $row['id_produk'] ?? null;
        $row['product_name'] = $row['nama_produk'] ?? null;
        $row['quantity'] = $row['jumlah_pesan'] ?? null;
        $row['price'] = $row['harga_saat_beli'] ?? null;

        return $row;
    }
}
