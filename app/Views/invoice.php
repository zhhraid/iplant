<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice <?= esc($order['invoice_no']) ?> - iplant.id</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .invoice-page {
            max-width: 1000px;
            margin: 50px auto;
            padding: 0 20px;
            box-sizing: border-box;
        }
        
        /* Header section matching mockup */
        .invoice-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .invoice-title-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .invoice-title {
            font-size: 1.6rem;
            font-weight: 500;
            color: #333;
            margin: 0;
        }
        .status-badge {
            background-color: #f39c12;
            color: white;
            font-weight: 600;
            font-size: 0.78rem;
            padding: 4px 10px;
            border-radius: 4px;
            letter-spacing: 0.2px;
        }
        .status-badge.cancelled {
            background-color: #777;
        }
        .status-badge.waiting-confirmation {
            background-color: #999;
        }
        .status-badge.refund-requested {
            background-color: #777;
        }
        .status-badge.refund-approved {
            background-color: #777;
        }
        .status-badge.paid,
        .status-badge.delivered {
            background-color: #46ad54;
        }
        .invoice-date {
            font-size: 0.95rem;
            color: #999;
            font-style: italic;
        }

        /* Product list style with thin border lines above and below, no table headers */
        .invoice-items-list {
            border-top: 1px solid #eaeaea;
            border-bottom: 1px solid #eaeaea;
            margin-bottom: 30px;
            padding: 10px 0;
        }
        .invoice-item-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        .item-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .item-img {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #eee;
        }
        .item-name-link {
            color: #0088ff;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.05rem;
            transition: color 0.2s;
        }
        .item-name-link:hover {
            color: #0077ee;
            text-decoration: underline;
        }
        .item-right {
            display: flex;
            align-items: center;
            gap: 60px;
        }
        .item-price, .item-qty {
            font-size: 1rem;
            color: #333;
        }
        .item-subtotal {
            font-size: 1rem;
            font-weight: 500;
            color: #333;
            min-width: 80px;
            text-align: right;
        }

        /* Two column layout for bottom details */
        .invoice-details-row {
            display: flex;
            justify-content: space-between;
            gap: 40px;
            margin-bottom: 40px;
        }
        .shipping-info-box {
            flex: 1;
            border: 1px solid #eaeaea;
            border-radius: 4px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }
        .shipping-info-content {
            padding: 20px 20px 10px 20px;
            font-size: 0.92rem;
            color: #333;
            line-height: 1.6;
        }
        .shipping-info-content h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 12px;
            color: #333;
        }
        .shipping-status-footer {
            background: #fafafa;
            border-top: 1px solid #eaeaea;
            padding: 12px 20px;
            font-style: italic;
            color: #999;
            font-size: 0.95rem;
        }
        .tracking-info {
            border-top: 1px solid #eaeaea;
            margin: 14px 0 0;
            padding-top: 12px;
            color: #333;
        }
        .tracking-info-label {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }
        .tracking-info-value {
            font-size: 0.95rem;
            margin-bottom: 12px;
        }
        .tracking-events {
            border-top: 1px solid #eaeaea;
            margin-top: 10px;
        }
        .tracking-event-row {
            display: grid;
            grid-template-columns: 90px 1fr;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.82rem;
            line-height: 1.35;
        }
        .tracking-event-time {
            color: #666;
            text-align: right;
        }
        .tracking-event-desc {
            color: #2f3a44;
        }
        
        .totals-summary-box {
            width: 380px;
            font-size: 0.95rem;
        }
        .summary-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            color: #333;
            align-items: flex-start;
        }
        .summary-line.grand-total {
            font-size: 1.4rem;
            font-weight: 700;
            color: #000;
            border-top: 1px solid #eaeaea;
            padding-top: 15px;
            margin-top: 15px;
            align-items: center;
        }

        /* Invoice Action buttons */
        .invoice-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
            margin-top: 25px;
        }
        .btn-payment-confirm {
            background-color: #0088ff;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-payment-confirm:hover {
            background-color: #0077ee;
        }
        .btn-order-cancel {
            color: #666;
            text-decoration: none;
            font-size: 0.95rem;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }
        .btn-order-cancel:hover {
            color: #333;
            text-decoration: underline;
        }
        .btn-refund {
            color: #555;
            text-decoration: none;
            font-size: 1rem;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }
        .btn-refund:hover {
            color: #333;
            text-decoration: underline;
        }
        .btn-review {
            background-color: #1e96e8;
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-review:hover {
            background-color: #1686d3;
        }

        .cancel-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.38);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 1000;
        }
        .cancel-modal-overlay.active {
            display: flex;
        }
        .cancel-modal {
            width: 100%;
            max-width: 410px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 18px 48px rgba(0, 0, 0, 0.25);
            padding: 22px 26px 20px;
            box-sizing: border-box;
        }
        .cancel-modal h2 {
            margin: 0 0 22px;
            font-size: 1.55rem;
            font-weight: 500;
            color: #1f2933;
        }
        .cancel-modal p {
            margin: 0 0 14px;
            color: #1f2933;
            font-size: 1rem;
            line-height: 1.45;
        }
        .cancel-modal p strong {
            font-style: italic;
            font-weight: 700;
        }
        .cancel-options {
            display: flex;
            align-items: center;
            gap: 22px;
            margin-bottom: 16px;
        }
        .cancel-options label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            color: #1f2933;
            font-size: 0.95rem;
        }
        .cancel-modal-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }
        .modal-cancel-submit,
        .modal-close-btn {
            height: 38px;
            border-radius: 4px;
            font-size: 0.95rem;
            cursor: pointer;
        }
        .modal-cancel-submit {
            border: none;
            background: #3498db;
            color: #fff;
            font-weight: 600;
        }
        .modal-cancel-submit:disabled {
            background: #b9b9b9;
            cursor: not-allowed;
        }
        .modal-close-btn {
            border: 1px solid #b8d8fb;
            background: #fff;
            color: #0088ff;
        }
        .refund-reason {
            margin-bottom: 18px;
        }
        .refund-reason label,
        .refund-confirm-label {
            display: block;
            color: #1f2933;
            font-size: 0.95rem;
            margin-bottom: 6px;
        }
        .refund-reason textarea {
            width: 100%;
            height: 66px;
            resize: none;
            border: 1px solid #d6d6d6;
            border-radius: 4px;
            padding: 9px;
            font-family: inherit;
            font-size: 1rem;
            outline: none;
            box-sizing: border-box;
        }
        .refund-reason textarea::placeholder {
            color: #9aa0a6;
        }

        /* Instructions footer block */
        .bank-instructions-footer {
            border-top: 1px solid #eaeaea;
            padding-top: 30px;
            margin-top: 50px;
            font-size: 0.95rem;
        }
        .instructions-header-text {
            font-size: 0.95rem;
            color: #333;
            margin-bottom: 25px;
        }
        .bank-accounts-grid {
            display: flex;
            gap: 40px;
            justify-content: space-between;
        }
        .bank-account-card {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            flex: 1;
        }
        .bank-logo-box {
            display: flex;
            align-items: center;
            min-height: 40px;
        }
        .bank-details-text {
            font-size: 0.88rem;
            color: #555;
            line-height: 1.4;
        }
        .bank-details-text strong {
            display: block;
            font-weight: bold;
            color: #000;
            margin-bottom: 2px;
            font-size: 0.92rem;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container header-container">
            <div class="logo">
                <a href="/"><img src="/images/logo.png" alt="iplant.id Logo" onerror="this.src='https://placehold.co/150x50?text=iplant.id'"></a>
            </div>
            <nav class="nav">
                <ul class="nav-links">
                    <li class="dropdown-kategori">
                        <a href="#" class="dropdown-toggle">Kategori <i class="fas fa-chevron-down" style="font-size: 0.8rem; margin-left: 4px;"></i></a>
                        <div class="mega-menu">
                            <div class="mega-menu-col">
                                <h4 class="mega-menu-title">Tanaman Hias</h4>
                                <ul>
                                    <li><a href="/category/bambu-hoki">Bambu Hoki</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu-col">
                                <h4 class="mega-menu-title">Tanaman Berbunga</h4>
                                <ul>
                                    <li><a href="/category/anggrek">Anggrek</a></li>
                                    <li><a href="/category/mawar"><i class="fas fa-award" style="color: #e74c3c;"></i> Mawar</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu-col">
                                <h4 class="mega-menu-title">Bibit Buah</h4>
                                <ul>
                                    <li><a href="/category/mangga">Mangga</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu-col">
                                <h4 class="mega-menu-title">Produk lain</h4>
                                <ul>
                                    <li><a href="/category/media-tanam">Media Tanam</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/cart" class="cart-link">Keranjang <span class="badge-cart"><?= count(session()->get('cart') ?? []) ?></span></a></li>
                    <?php if (session()->get('user')): ?>
                        <li><a href="/account">Akun Saya</a></li>
                        <li><a href="/logout">Logout</a></li>
                    <?php else: ?>
                        <li><a href="/login">Login</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" placeholder="Cari ...">
                </div>
            </div>
        </div>
    </header>

    <?php
    // Indonesian month array for date formatting
    $months = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
    $orderTime = new DateTime($order['created_at'], new DateTimeZone(app_timezone()));
    $m = (int) $orderTime->format('n');
    $monthName = $months[$m] ?? $orderTime->format('F');
    $formattedDate = $orderTime->format('j') . ' ' . $monthName . ' ' . $orderTime->format('Y') . ' pukul ' . $orderTime->format('g:i a');

    $orderStatus = trim((string) ($order['status'] ?? 'pending'));
    $normalizedStatus = strtolower($orderStatus);
    $isCancelled = in_array($normalizedStatus, ['dibatalkan', 'cancelled', 'canceled'], true);
    $isWaitingConfirmation = in_array($normalizedStatus, ['menunggu konfirmasi', 'waiting confirmation'], true);
    $isPaid = in_array($normalizedStatus, ['terbayar', 'paid', 'sudah dibayar'], true);
    $isRefundRequested = in_array($normalizedStatus, ['meminta refund', 'refund diminta', 'minta refund', 'refund requested'], true);
    $isRefundApproved = in_array($normalizedStatus, ['refund disetujui', 'refund approved'], true);
    $statusLabel = 'Belum Dibayar';
    $statusClass = '';

    if ($isCancelled) {
        $statusLabel = 'Dibatalkan';
        $statusClass = 'cancelled';
    } elseif ($isWaitingConfirmation) {
        $statusLabel = 'Menunggu Konfirmasi';
        $statusClass = 'waiting-confirmation';
    } elseif ($isPaid) {
        $statusLabel = 'Terbayar';
        $statusClass = 'paid';
    } elseif ($isRefundRequested) {
        $statusLabel = 'Meminta Refund';
        $statusClass = 'refund-requested';
    } elseif ($isRefundApproved) {
        $statusLabel = 'Refund Disetujui';
        $statusClass = 'refund-approved';
    }

    $showShippingStatus = !($isPaid || $isRefundRequested || $isRefundApproved);
    $showPaymentInstructions = !($isCancelled || $isWaitingConfirmation || $isPaid || $isRefundRequested || $isRefundApproved);
    
    // Determine shipping status text dynamically
    $orderShippingStatus = trim((string) ($order['shipping_status'] ?? ''));
    if (empty($orderShippingStatus)) {
        $orderShippingStatus = 'Menunggu Untuk Dikirim';
    }

    if ($isCancelled) {
        $shippingStatusText = 'Order Dibatalkan';
    } elseif ($isRefundRequested) {
        $shippingStatusText = 'Minta Refund';
    } elseif ($isRefundApproved) {
        $shippingStatusText = 'Refund Disetujui';
    } elseif (!$isPaid) {
        $shippingStatusText = 'Menunggu Untuk Dikirim';
    } else {
        $shippingStatusText = $orderShippingStatus;
    }

    $formatTrackingTime = static function (?string $eventTime) use ($months): string {
        if (empty($eventTime)) {
            return '';
        }

        $time = new DateTime($eventTime, new DateTimeZone(app_timezone()));
        $eventMonth = $months[(int) $time->format('n')] ?? $time->format('F');

        return $time->format('j') . ' ' . $eventMonth . ', ' . $time->format('g:i a');
    };
    ?>

    <div class="invoice-page">
        <?php if (session()->getFlashdata('success')): ?>
            <div style="background-color: #def7ec; color: #03543f; border: 1px solid #bcf0da; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 0.95rem; font-weight: 500;">
                <i class="fas fa-check-circle" style="margin-right: 8px;"></i> <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div style="background-color: #fde8e8; color: #9b1c1c; border: 1px solid #fbd5d5; padding: 12px 16px; border-radius: 6px; margin-bottom: 20px; font-size: 0.95rem; font-weight: 500;">
                <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i> <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if ($isPaid): ?>
        <!-- Simulation Helper Control Panel for Testing / Lecturer Demo -->
        <div class="simulation-helper-box" style="background-color: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 6px; padding: 16px 20px; margin-bottom: 30px; font-size: 0.92rem; color: #334155; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="font-weight: 700; margin-bottom: 8px; display: flex; align-items: center; gap: 8px; color: #1e293b;">
                <span style="font-size: 1.15rem;">Ã¢Å¡â„¢Ã¯Â¸Â</span>
                <span>Panel Simulasi Integrasi API Pelacakan Kurir (Mock API)</span>
            </div>
            <div style="margin-bottom: 12px; color: #64748b; line-height: 1.55;">
                <strong>Catatan Teknis (Penjelasan Dosen):</strong> Pada sistem produksi nyata, data perjalanan (tracking events) tidak disimpan di database lokal untuk efisiensi penyimpanan. Sebagai gantinya, data diintegrasikan secara real-time melalui <strong>API Ekspedisi</strong> (seperti RajaOngkir atau Biteship) menggunakan parameter <em>Nomor Resi</em>. Panel ini disediakan sebagai <strong>Mock API</strong> untuk menyimulasikan respon transit kurir saat status pesanan telah dikonfirmasi oleh admin toko.
            </div>
            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
                <?php 
                $currentShippingStatus = strtolower(trim($order['shipping_status'] ?? ''));
                if (empty($currentShippingStatus) || $currentShippingStatus === 'menunggu untuk dikirim'): 
                ?>
                    <span style="font-weight: 600; color: #16a34a; font-size: 0.9rem;">Status: Lunas & Siap Dikirim (Awaiting Shipment)</span>
                    <span style="color: #cbd5e1;">|</span>
                    <a href="/invoice/<?= $order['id'] ?>/simulate-ship" class="btn-payment-confirm" style="background-color: #ea580c; padding: 8px 16px; font-size: 0.88rem; text-decoration: none; color: #fff; border-radius: 4px; font-weight: 500; display: inline-block;">
                        Simulasikan Kirim Barang (Generate Resi Otomatis)
                    </a>
                <?php elseif ($currentShippingStatus === 'dalam perjalanan'): ?>
                    <span style="font-weight: 600; color: #ea580c; font-size: 0.9rem;">Status: Sedang Dikirim (In Transit)</span>
                    <span style="color: #cbd5e1;">|</span>
                    <a href="/invoice/<?= $order['id'] ?>/simulate-deliver" class="btn-payment-confirm" style="background-color: #16a34a; padding: 8px 16px; font-size: 0.88rem; text-decoration: none; color: #fff; border-radius: 4px; font-weight: 500; display: inline-block;">
                        Simulasikan Paket Sampai (Telah Diterima)
                    </a>
                <?php else: ?>
                    <span style="font-weight: 600; color: #16a34a; font-size: 0.9rem; display: flex; align-items: center; gap: 6px;">
                        Ã¢Å“â€¦ Status: Transaksi Selesai & Paket Telah Diterima.
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <!-- Header row -->
        <div class="invoice-header-row">
            <div class="invoice-title-wrapper">
                <h1 class="invoice-title">Invoice <?= esc($order['invoice_no']) ?></h1>
                <span class="status-badge <?= esc($statusClass) ?>"><?= esc($statusLabel) ?></span>
                <?php if ($isPaid && strtolower(trim($order['shipping_status'] ?? '')) === 'sudah sampai'): ?>
                    <span class="status-badge delivered">Semua Terkirim</span>
                <?php endif; ?>
            </div>
            <div class="invoice-date"><?= $formattedDate ?></div>
        </div>

        <!-- Product items list with thin lines -->
        <div class="invoice-items-list">
            <?php foreach($items as $item): ?>
            <div class="invoice-item-row">
                <div class="item-left">
                    <img class="item-img" src="<?= esc($item['image_url'] ?? 'https://placehold.co/60x60?text=iplant.id') ?>" alt="<?= esc($item['product_name']) ?>" onerror="this.src='https://placehold.co/60x60?text=iplant.id'">
                    <a href="/product-detail/<?= $item['product_id'] ?>" class="item-name-link"><?= esc($item['product_name']) ?></a>
                </div>
                
                <div class="item-right">
                    <span class="item-price"><?= number_format($item['price'], 0, ',', '.') ?></span>
                    <span class="item-qty"><?= $item['quantity'] ?>x</span>
                    <span class="item-subtotal"><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Details and Totals Summary Row -->
        <div class="invoice-details-row">
            <!-- Left Info Box -->
            <div class="shipping-info-box">
                <div class="shipping-info-content">
                    <h4>Kirim ke</h4>
                    <div style="font-weight: 700; color: #000; margin-bottom: 5px;"><?= esc($order['customer_name']) ?></div>
                    <div>
                        <?= nl2br(esc($order['customer_address'])) ?><br>
                        <?= esc($order['customer_city']) ?>, <?= esc($order['customer_zip']) ?><br>
                        Indonesia
                    </div>
                    <div style="margin-top: 5px;"><?= esc($order['customer_phone']) ?></div>
                    <div style="font-style: italic; margin-top: 10px; color: #555; font-weight: 500;"><?= esc($order['shipping_courier']) ?></div>

                    <?php 
                    $hasShipped = $isPaid && !empty($order['shipping_status']) && strtolower(trim($order['shipping_status'])) !== 'menunggu untuk dikirim';
                    if ($hasShipped): 
                    ?>
                        <div class="tracking-info">
                            <div class="tracking-info-label">Nomor Resi</div>
                            <div class="tracking-info-value"><?= esc($order['tracking_number'] ?? 'JD0561623445') ?></div>
                            <div class="tracking-info-label">Status</div>
                            <div class="tracking-info-value"><?= esc($order['shipping_status'] ?? 'Sudah Sampai') ?></div>

                            <div class="tracking-events">
                                <?php foreach ($trackingEvents as $event): ?>
                                    <div class="tracking-event-row">
                                        <div class="tracking-event-time"><?= esc($formatTrackingTime($event['event_time'] ?? null)) ?></div>
                                        <div class="tracking-event-desc"><?= esc($event['description']) ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="shipping-status-footer">
                    <?= $shippingStatusText ?>
                </div>
            </div>

            <!-- Right Totals Box -->
            <div class="totals-summary-box">
                <div class="summary-line">
                    <span>Subtotal</span>
                    <span><?= number_format($order['subtotal'], 0, ',', '.') ?></span>
                </div>
                <div class="summary-line" style="flex-direction: column; gap: 4px; margin-bottom: 12px;">
                    <div style="display: flex; justify-content: space-between; width: 100%;">
                        <span>Tarif Pengiriman</span>
                        <span><?= number_format($order['shipping_cost'], 0, ',', '.') ?></span>
                    </div>
                    <div style="font-size: 0.8rem; color: #999;"><?= esc($order['shipping_courier']) ?></div>
                </div>
                <div class="summary-line">
                    <span>Kode Unik</span>
                    <span><?= number_format($order['unique_code'], 0, ',', '.') ?></span>
                </div>
                
                <?php 
                // Calculate coupon discount if applied
                $calculatedDiscount = (int) ($order['subtotal'] + $order['shipping_cost'] + $order['unique_code'] - $order['total_amount']);
                if ($calculatedDiscount > 0):
                ?>
                <div class="summary-line" style="color: #e74c3c;">
                    <span>Potongan Kupon</span>
                    <span>-<?= number_format($calculatedDiscount, 0, ',', '.') ?></span>
                </div>
                <?php endif; ?>
                
                <div class="summary-line grand-total">
                    <span>Total</span>
                    <span style="font-size: 1.5rem; font-weight: 700;">Rp <?= number_format($order['total_amount'], 0, ',', '.') ?></span>
                </div>

                <!-- Action buttons block -->
                <div class="invoice-actions">
                    <?php if ($isPaid): ?>
                        <?php if (strtolower(trim($order['shipping_status'] ?? '')) === 'sudah sampai'): ?>
                            <?php if (isset($hasReviewed) && $hasReviewed): ?>
                                <span style="color: #27ae60; font-weight: 600; font-size: 0.95rem; display: inline-flex; align-items: center; gap: 6px; padding: 10px 0;">
                                    <i class="fas fa-check-circle"></i> Sudah Diulas
                                </span>
                            <?php else: ?>
                                <a href="/invoice/<?= $order['id'] ?>/review" class="btn-review">Tulis Review</a>
                                <button type="button" class="btn-refund" onclick="openRefundModal()">Minta Refund</button>
                            <?php endif; ?>
                        <?php else: ?>
                            <button type="button" class="btn-refund" onclick="openRefundModal()">Minta Refund</button>
                        <?php endif; ?>
                    <?php elseif ($isWaitingConfirmation): ?>
                        <button type="button" class="btn-refund" onclick="openRefundModal()">Minta Refund</button>
                    <?php elseif (!$isCancelled && !$isRefundRequested && !$isRefundApproved): ?>
                        <a href="/invoice/<?= $order['id'] ?>/confirm-payment" class="btn-payment-confirm">Konfirmasi Pembayaran</a>
                        <button type="button" class="btn-order-cancel" onclick="openCancelModal()">Batalkan Order</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Bank account instructions block -->
        <?php if ($showPaymentInstructions): ?>
            <div class="bank-instructions-footer">
                <div class="instructions-header-text">Mohon lakukan pembayaran ke salah satu rekening dibawah ini.</div>
                <div class="bank-accounts-grid">
                    <!-- BCA Account logo -->
                    <div class="bank-account-card">
                        <div class="bank-logo-box">
                            <img src="/images/payments/bca.png" alt="BCA" style="height: 26px; object-fit: contain;">
                        </div>
                        <div class="bank-details-text">
                            <strong>BCA</strong>
                            <span>0190725880</span><br>
                            <span>ALFIANSYAH ANWAR</span>
                        </div>
                    </div>
                    
                    <!-- BNI Account logo -->
                    <div class="bank-account-card">
                        <div class="bank-logo-box">
                            <img src="/images/payments/bni.png" alt="BNI" style="height: 22px; object-fit: contain;">
                        </div>
                        <div class="bank-details-text">
                            <strong>BNI</strong>
                            <span>1231021328</span><br>
                            <span>ALFIANSYAH ANWAR</span>
                        </div>
                    </div>
                    
                    <!-- Mandiri Account logo -->
                    <div class="bank-account-card">
                        <div class="bank-logo-box">
                            <img src="/images/payments/mandiri.png" alt="Mandiri" style="height: 22px; object-fit: contain;">
                        </div>
                        <div class="bank-details-text">
                            <strong>MANDIRI</strong>
                            <span>144002484913</span><br>
                            <span>ALFIANSYAH ANWAR</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <footer class="footer-black">
        <div class="container footer-black-container">
            <div class="footer-black-col">
                <h4>Links</h4>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/category/bambu-hoki">Daftar Produk</a></li>
                    <li><a href="/confirm-payment">Konfirmasi Pembayaran</a></li>
                </ul>
            </div>
            <div class="footer-black-col">
                <h4>Social Media</h4>
                <div class="social-icons-black">
                    <a href="https://www.instagram.com/iplant_shop" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.tiktok.com/@iplant.id" target="_blank" rel="noopener" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    <a href="https://www.youtube.com/@iPlantIndonesia" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="https://web.facebook.com/iplant.id?_rdc=1&amp;_rdr#" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
            <div class="footer-black-col">
                <h4>Hubungi Kami</h4>
                <ul class="contact-info-black">
                    <li><i class="fab fa-whatsapp"></i> 0831-6500-7109</li>
                    <li><i class="far fa-envelope"></i> iplant.indonesia@gmail.com</li>
                    <li><i class="fas fa-map-marker-alt"></i> JL Cemara Kipas No 31<br>Sidomulyo, Kota Batu.<br>Jawa Timur.</li>
                </ul>
            </div>
            <div class="footer-black-col newsletter-black-col">
                <h4>Berita Newsletter</h4>
                <div class="newsletter-form-black">
                    <input type="email" placeholder="Masukan email di sini">
                    <button class="btn-subscribe">Berlangganan</button>
                </div>
            </div>
        </div>
        <div class="footer-black-bottom">
            <p>@2026 iPlant Inc.</p>
        </div>
    </footer>

    <div class="cancel-modal-overlay" id="cancelOrderModal" aria-hidden="true">
        <div class="cancel-modal" role="dialog" aria-modal="true" aria-labelledby="cancelOrderTitle">
            <h2 id="cancelOrderTitle">Batalkan Order</h2>
            <p>Apakah kamu yakin untuk membatalkan order <strong><?= esc($order['invoice_no']) ?></strong>?</p>

            <form action="/invoice/<?= $order['id'] ?>/cancel" method="POST" id="cancelOrderForm">
                <div class="cancel-options">
                    <label>
                        <input type="radio" name="cancel_confirmation" value="yes">
                        Ya
                    </label>
                    <label>
                        <input type="radio" name="cancel_confirmation" value="no" checked>
                        Tidak
                    </label>
                </div>
                <div class="cancel-modal-actions">
                    <button type="submit" class="modal-cancel-submit" id="cancelOrderSubmit" disabled>Batalkan Order</button>
                    <button type="button" class="modal-close-btn" onclick="closeCancelModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="cancel-modal-overlay" id="refundModal" aria-hidden="true">
        <div class="cancel-modal" role="dialog" aria-modal="true" aria-labelledby="refundTitle">
            <h2 id="refundTitle">Minta Refund</h2>

            <form action="/invoice/<?= $order['id'] ?>/refund" method="POST" id="refundForm">
                <div class="refund-reason">
                    <label for="refund_reason">Alasan</label>
                    <textarea id="refund_reason" name="refund_reason" placeholder="Tuliskan alasan kamu di sini"></textarea>
                </div>
                <div class="refund-confirm-label">Apa kamu yakin?</div>
                <div class="cancel-options">
                    <label>
                        <input type="radio" name="refund_confirmation" value="yes">
                        Ya
                    </label>
                    <label>
                        <input type="radio" name="refund_confirmation" value="no" checked>
                        Tidak
                    </label>
                </div>
                <div class="cancel-modal-actions">
                    <button type="submit" class="modal-cancel-submit" id="refundSubmit" disabled>Minta Refund</button>
                    <button type="button" class="modal-close-btn" onclick="closeRefundModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const cancelModal = document.getElementById('cancelOrderModal');
        const cancelSubmit = document.getElementById('cancelOrderSubmit');
        const cancelRadios = document.querySelectorAll('input[name="cancel_confirmation"]');
        const refundModal = document.getElementById('refundModal');
        const refundSubmit = document.getElementById('refundSubmit');
        const refundRadios = document.querySelectorAll('input[name="refund_confirmation"]');
        const refundReason = document.getElementById('refund_reason');

        function openCancelModal() {
            cancelModal.classList.add('active');
            cancelModal.setAttribute('aria-hidden', 'false');
        }

        function closeCancelModal() {
            cancelModal.classList.remove('active');
            cancelModal.setAttribute('aria-hidden', 'true');
            const noOption = document.querySelector('input[name="cancel_confirmation"][value="no"]');
            if (noOption) {
                noOption.checked = true;
            }
            updateCancelSubmitState();
        }

        function updateCancelSubmitState() {
            const selected = document.querySelector('input[name="cancel_confirmation"]:checked');
            cancelSubmit.disabled = !selected || selected.value !== 'yes';
        }

        function openRefundModal() {
            refundModal.classList.add('active');
            refundModal.setAttribute('aria-hidden', 'false');
        }

        function closeRefundModal() {
            refundModal.classList.remove('active');
            refundModal.setAttribute('aria-hidden', 'true');
            const noOption = document.querySelector('input[name="refund_confirmation"][value="no"]');
            if (noOption) {
                noOption.checked = true;
            }
            refundReason.value = '';
            updateRefundSubmitState();
        }

        function updateRefundSubmitState() {
            const selected = document.querySelector('input[name="refund_confirmation"]:checked');
            refundSubmit.disabled = !selected || selected.value !== 'yes' || refundReason.value.trim() === '';
        }

        cancelRadios.forEach((radio) => {
            radio.addEventListener('change', updateCancelSubmitState);
        });

        refundRadios.forEach((radio) => {
            radio.addEventListener('change', updateRefundSubmitState);
        });

        refundReason.addEventListener('input', updateRefundSubmitState);

        cancelModal.addEventListener('click', (event) => {
            if (event.target === cancelModal) {
                closeCancelModal();
            }
        });

        refundModal.addEventListener('click', (event) => {
            if (event.target === refundModal) {
                closeRefundModal();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && cancelModal.classList.contains('active')) {
                closeCancelModal();
            }
            if (event.key === 'Escape' && refundModal.classList.contains('active')) {
                closeRefundModal();
            }
        });
    </script>
</body>
</html>
