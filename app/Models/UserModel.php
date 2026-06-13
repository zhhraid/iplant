<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = false;
    protected $allowedFields = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = '';
    protected $updatedField = '';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert = ['mapLegacyData'];
    protected $afterInsert = [];
    protected $beforeUpdate = ['mapLegacyData'];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = ['appendLegacyData'];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    protected function mapLegacyData(array $data): array
    {
        if (! isset($data['data'])) {
            return $data;
        }

        if (isset($data['data']['name'])) {
            $data['data']['nama'] = $data['data']['name'];
            unset($data['data']['name']);
        }

        if (isset($data['data']['password_hash'])) {
            $data['data']['password'] = $data['data']['password_hash'];
            unset($data['data']['password_hash']);
        }

        unset($data['data']['first_name'], $data['data']['last_name']);

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
        $name = $row['nama'] ?? '';
        $parts = preg_split('/\s+/', trim($name), 2);

        $row['id'] = $row['id_pengguna'] ?? null;
        $row['name'] = $name;
        $row['first_name'] = $parts[0] ?? $name;
        $row['last_name'] = $parts[1] ?? '';
        $row['password_hash'] = $row['password'] ?? null;

        return $row;
    }
}
