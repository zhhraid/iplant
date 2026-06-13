<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'pesanan';
    protected $primaryKey       = 'id_pesanan';
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
    protected $createdField  = 'tanggal_pesanan';
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = ['mapLegacyInsert'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['mapLegacyUpdate'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = ['appendLegacyData'];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function forCustomerEmail(string $email): self
    {
        return $this
            ->select('pesanan.*')
            ->join('informasi_pembeli', 'informasi_pembeli.id_informasi_pembeli = pesanan.id_informasi_pembeli', 'left')
            ->where('informasi_pembeli.email_pembeli', $email);
    }

    public function orderBy($orderBy, string $direction = 'ASC', ?bool $escape = null)
    {
        $orderBy = match ($orderBy) {
            'id' => 'id_pesanan',
            default => $orderBy,
        };

        return parent::orderBy($orderBy, $direction, $escape);
    }

    protected function mapLegacyInsert(array $data): array
    {
        if (! isset($data['data'])) {
            return $data;
        }

        $legacy = $data['data'];
        $userId = $this->findUserIdByEmail((string) ($legacy['customer_email'] ?? ''));
        $buyerInfoId = $this->createBuyerInfo($legacy, $userId);
        $shippingId = $this->findOrCreateShippingMethod(
            (string) ($legacy['shipping_courier'] ?? 'JNE - REG'),
            (int) ($legacy['shipping_cost'] ?? 0)
        );

        $data['data'] = [
            'kode_invoice' => $legacy['invoice_no'] ?? null,
            'id_pengguna' => $userId,
            'id_informasi_pembeli' => $buyerInfoId,
            'id_pengiriman' => $shippingId,
            'is_dropshipper' => (int) ($legacy['is_dropshipper'] ?? 0),
            'nama_dropshipper' => $legacy['dropshipper_name'] ?? null,
            'telepon_dropshipper' => $legacy['dropshipper_phone'] ?? null,
            'tanggal_pesanan' => $legacy['tanggal_pesanan'] ?? $legacy['created_at'] ?? null,
            'status_pesanan' => $legacy['status'] ?? 'pending',
            'status_pengiriman' => $legacy['shipping_status'] ?? null,
            'kode_unik' => (int) ($legacy['unique_code'] ?? 0),
            'no_resi' => $legacy['tracking_number'] ?? null,
            'subtotal_pesanan' => (int) ($legacy['subtotal'] ?? 0),
            'biaya_pengiriman' => (int) ($legacy['shipping_cost'] ?? 0),
            'total' => (int) ($legacy['total_amount'] ?? 0),
            'delivered_at' => $legacy['delivered_at'] ?? null,
        ];

        return $data;
    }

    protected function mapLegacyUpdate(array $data): array
    {
        if (! isset($data['data'])) {
            return $data;
        }

        $orderId = (int) ($data['id'][0] ?? 0);
        $legacy = $data['data'];

        if ($orderId > 0) {
            $this->syncPayment($orderId, $legacy);
            $this->syncRefund($orderId, $legacy);
        }

        $map = [
            'invoice_no' => 'kode_invoice',
            'status' => 'status_pesanan',
            'shipping_status' => 'status_pengiriman',
            'unique_code' => 'kode_unik',
            'tracking_number' => 'no_resi',
            'subtotal' => 'subtotal_pesanan',
            'shipping_cost' => 'biaya_pengiriman',
            'total_amount' => 'total',
            'dropshipper_name' => 'nama_dropshipper',
            'dropshipper_phone' => 'telepon_dropshipper',
        ];

        $normalized = [];
        foreach ($map as $old => $new) {
            if (array_key_exists($old, $legacy)) {
                $normalized[$new] = $legacy[$old];
            }
        }

        foreach (['kode_invoice', 'status_pesanan', 'status_pengiriman', 'kode_unik', 'no_resi', 'subtotal_pesanan', 'biaya_pengiriman', 'total', 'tanggal_pesanan', 'delivered_at', 'is_dropshipper', 'nama_dropshipper', 'telepon_dropshipper'] as $key) {
            if (array_key_exists($key, $legacy)) {
                $normalized[$key] = $legacy[$key];
            }
        }

        if (isset($legacy['shipping_courier']) || isset($legacy['id_pengiriman'])) {
            $normalized['id_pengiriman'] = $legacy['id_pengiriman'] ?? $this->findOrCreateShippingMethod(
                (string) ($legacy['shipping_courier'] ?? 'JNE - REG'),
                (int) ($legacy['shipping_cost'] ?? 0)
            );
        }

        $data['data'] = $normalized ?: ['id_pesanan' => $orderId];

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
        $buyer = [];
        if (! empty($row['id_informasi_pembeli'])) {
            $buyer = $this->db->table('informasi_pembeli')
                ->where('id_informasi_pembeli', $row['id_informasi_pembeli'])
                ->get()
                ->getRowArray() ?? [];
        }

        $shipping = null;
        if (! empty($row['id_pengiriman'])) {
            $shipping = $this->db->table('metode_pengiriman mp')
                ->select('e.nama_ekspedisi, mp.nama_layanan')
                ->join('ekspedisi e', 'e.id_ekspedisi = mp.id_ekspedisi', 'left')
                ->where('mp.id_pengiriman', $row['id_pengiriman'])
                ->get()
                ->getRowArray();
        }

        $payment = $this->db->table('konfirmasi_pembayaran kp')
            ->select('kp.*, mp.nama_bank, mp.no_rekening, mp.nama_pemilik AS rekening_pemilik')
            ->join('metode_pembayaran mp', 'mp.id_metode = kp.id_metode', 'left')
            ->where('kp.id_pesanan', $row['id_pesanan'] ?? 0)
            ->orderBy('kp.id_pembayaran', 'DESC')
            ->get()
            ->getRowArray() ?? [];

        $refund = $this->db->table('refund')
            ->where('id_pesanan', $row['id_pesanan'] ?? 0)
            ->orderBy('id_refund', 'DESC')
            ->get()
            ->getRowArray() ?? [];

        $row['id'] = $row['id_pesanan'] ?? null;
        $row['invoice_no'] = $row['kode_invoice'] ?? null;
        $row['customer_email'] = $buyer['email_pembeli'] ?? null;
        $row['newsletter'] = 0;
        $row['customer_name'] = $buyer['nama_pembeli'] ?? null;
        $row['customer_city'] = $buyer['kota_kabupaten'] ?? null;
        $row['customer_address'] = $buyer['alamat'] ?? null;
        $row['customer_zip'] = $buyer['kode_pos'] ?? null;
        $row['customer_phone'] = $buyer['telepon'] ?? null;
        $row['dropshipper_name'] = $row['nama_dropshipper'] ?? null;
        $row['dropshipper_phone'] = $row['telepon_dropshipper'] ?? null;
        $row['shipping_courier'] = $shipping ? trim($shipping['nama_ekspedisi'] . ' - ' . $shipping['nama_layanan']) : null;
        $row['shipping_cost'] = $row['biaya_pengiriman'] ?? 0;
        $row['subtotal'] = $row['subtotal_pesanan'] ?? 0;
        $row['unique_code'] = $row['kode_unik'] ?? 0;
        $row['total_amount'] = $row['total'] ?? 0;
        $row['status'] = $row['status_pesanan'] ?? null;
        $row['tracking_number'] = $row['no_resi'] ?? null;
        $row['shipping_status'] = $row['status_pengiriman'] ?? null;
        $row['payment_date'] = ! empty($payment['waktu_pembayaran']) ? date('d/m/Y', strtotime($payment['waktu_pembayaran'])) : null;
        $row['payment_transfer_to'] = ! empty($payment) ? trim(($payment['nama_bank'] ?? '') . ' - ' . ($payment['no_rekening'] ?? '') . ' - ' . ($payment['rekening_pemilik'] ?? '')) : null;
        $row['payment_source_bank'] = $payment['bank_asal'] ?? null;
        $row['payment_account_name'] = $payment['nama_pemilik'] ?? null;
        $row['payment_amount'] = $payment['jumlah'] ?? 0;
        $row['payment_proof'] = $payment['bukti_transfer'] ?? null;
        $row['payment_confirmed_at'] = $payment['waktu_konfirmasi'] ?? null;
        $row['refund_reason'] = $refund['alasan_refund'] ?? null;
        $row['refund_requested_at'] = $refund['waktu_pengajuan'] ?? null;
        $row['refund_approved_at'] = $refund['waktu_disetujui'] ?? null;

        return $row;
    }

    private function findUserIdByEmail(string $email): ?int
    {
        if ($email === '') {
            return null;
        }

        $user = $this->db->table('pengguna')->select('id_pengguna')->where('email', $email)->get()->getRowArray();

        return $user ? (int) $user['id_pengguna'] : null;
    }

    private function createBuyerInfo(array $legacy, ?int $userId): int
    {
        $this->db->table('informasi_pembeli')->insert([
            'id_pengguna' => $userId,
            'email_pembeli' => $legacy['customer_email'] ?? '',
            'nama_pembeli' => $legacy['customer_name'] ?? '',
            'kota_kabupaten' => $legacy['customer_city'] ?? '',
            'alamat' => $legacy['customer_address'] ?? '',
            'kode_pos' => $legacy['customer_zip'] ?? '',
            'telepon' => $legacy['customer_phone'] ?? '',
        ]);

        return (int) $this->db->insertID();
    }

    private function findOrCreateShippingMethod(string $courier, int $cost): int
    {
        [$expeditionName, $serviceName] = array_pad(array_map('trim', explode(' - ', $courier, 2)), 2, 'REG');
        $code = strtolower(str_replace(['&', ' '], ['nt', ''], $expeditionName));

        $expedition = $this->db->table('ekspedisi')->where('kode_ekspedisi', $code)->get()->getRowArray();
        if (! $expedition) {
            $this->db->table('ekspedisi')->insert([
                'nama_ekspedisi' => $expeditionName,
                'kode_ekspedisi' => $code,
                'logo' => '/images/expeditions/' . $code . '.png',
            ]);
            $expeditionId = (int) $this->db->insertID();
        } else {
            $expeditionId = (int) $expedition['id_ekspedisi'];
        }

        $method = $this->db->table('metode_pengiriman')
            ->where('id_ekspedisi', $expeditionId)
            ->where('nama_layanan', $serviceName)
            ->get()
            ->getRowArray();

        if ($method) {
            return (int) $method['id_pengiriman'];
        }

        $this->db->table('metode_pengiriman')->insert([
            'id_ekspedisi' => $expeditionId,
            'nama_layanan' => $serviceName,
            'tarif' => $cost,
            'tarif_per_kg' => 8000,
            'estimasi' => '2-4 hari',
            'status' => 1,
        ]);

        return (int) $this->db->insertID();
    }

    private function syncPayment(int $orderId, array $data): void
    {
        $paymentKeys = ['payment_date', 'payment_transfer_to', 'payment_source_bank', 'payment_account_name', 'payment_amount', 'payment_proof', 'payment_confirmed_at'];
        if (! array_intersect($paymentKeys, array_keys($data))) {
            return;
        }

        $methodId = $this->findPaymentMethod((string) ($data['payment_transfer_to'] ?? ''));
        $payload = [
            'id_pesanan' => $orderId,
            'id_metode' => $methodId,
            'waktu_pembayaran' => $this->parsePaymentDate($data['payment_date'] ?? null),
            'bank_asal' => $data['payment_source_bank'] ?? '-',
            'nama_pemilik' => $data['payment_account_name'] ?? '-',
            'jumlah' => (int) ($data['payment_amount'] ?? 0),
            'bukti_transfer' => $data['payment_proof'] ?? null,
            'waktu_konfirmasi' => $data['payment_confirmed_at'] ?? null,
            'status_konfirmasi' => 'diterima',
        ];

        $existing = $this->db->table('konfirmasi_pembayaran')->where('id_pesanan', $orderId)->get()->getRowArray();
        if ($existing) {
            $this->db->table('konfirmasi_pembayaran')->where('id_pembayaran', $existing['id_pembayaran'])->update($payload);
            return;
        }

        $this->db->table('konfirmasi_pembayaran')->insert($payload);
    }

    private function syncRefund(int $orderId, array $data): void
    {
        if (! isset($data['refund_reason']) && ! isset($data['refund_requested_at']) && ! isset($data['refund_approved_at'])) {
            return;
        }

        $payload = [
            'id_pesanan' => $orderId,
            'alasan_refund' => $data['refund_reason'] ?? '-',
            'waktu_pengajuan' => $data['refund_requested_at'] ?? null,
            'waktu_disetujui' => $data['refund_approved_at'] ?? null,
            'status_refund' => isset($data['refund_approved_at']) ? 'disetujui' : 'diajukan',
        ];

        $existing = $this->db->table('refund')->where('id_pesanan', $orderId)->get()->getRowArray();
        if ($existing) {
            $this->db->table('refund')->where('id_refund', $existing['id_refund'])->update($payload);
            return;
        }

        $this->db->table('refund')->insert($payload);
    }

    private function findPaymentMethod(string $transferTo): int
    {
        $builder = $this->db->table('metode_pembayaran')->select('id_metode');
        if ($transferTo !== '') {
            $bank = trim(strtok($transferTo, '-'));
            $builder->like('nama_bank', $bank);
        }

        $method = $builder->orderBy('id_metode', 'ASC')->get()->getRowArray();

        return $method ? (int) $method['id_metode'] : 1;
    }

    private function parsePaymentDate(?string $value): ?string
    {
        if (! $value) {
            return null;
        }

        $date = \DateTime::createFromFormat('d/m/Y', $value);

        return $date ? $date->format('Y-m-d 00:00:00') : $value;
    }
}
