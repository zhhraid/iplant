<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya - iplant.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            background: #fff;
        }
        .account-main {
            max-width: 1040px;
            margin: 24px auto 0;
            padding: 0 15px 46px;
            min-height: 315px;
        }
        .account-title,
        .orders-title {
            font-size: 2rem;
            line-height: 1.2;
            color: #343a40;
            margin: 0 0 18px;
            font-weight: 700;
        }
        .account-profile-row {
            display: flex;
            align-items: flex-start;
            gap: 28px;
            margin-bottom: 26px;
        }
        .account-field-label {
            color: #60666d;
            font-size: 0.95rem;
            margin-bottom: 4px;
        }
        .account-field-value {
            color: #1f2933;
            font-size: 1rem;
        }
        .btn-change-password {
            color: #1689ff;
            border: 1px solid #8fc6ff;
            border-radius: 4px;
            background: #fff;
            padding: 8px 20px;
            text-decoration: none;
            line-height: 1;
        }
        .orders-empty {
            color: #9a9a9a;
            font-size: 1.25rem;
            margin-top: 15px;
        }
        
        /* Order Cards layout */
        .orders-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 760px;
            margin-top: 15px;
        }
        .order-card {
            border: 1px solid #eaeaea;
            border-radius: 6px;
            background-color: #fff;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            transition: box-shadow 0.2s;
        }
        .order-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        .order-card-header {
            background-color: #fafafa;
            border-bottom: 1px solid #eaeaea;
            padding: 12px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .order-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            color: #333;
        }
        .order-date {
            font-weight: 400;
            color: #666;
        }
        .order-invoice-link {
            font-weight: 700;
            color: #1689ff;
            text-decoration: none;
            transition: color 0.2s;
        }
        .order-invoice-link:hover {
            color: #0066cc;
            text-decoration: underline;
        }
        
        .order-status-badges {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .status-badge-acc {
            font-size: 0.76rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 4px;
            color: white;
            letter-spacing: 0.2px;
        }
        
        /* Status badge colors matching invoice.php */
        .status-badge-acc.pending,
        .status-badge-acc.belum-dibayar {
            background-color: #f39c12; /* Orange */
        }
        .status-badge-acc.menunggu-konfirmasi {
            background-color: #999; /* Grey */
        }
        .status-badge-acc.expired {
            background-color: #e74c3c; /* Red */
        }
        .status-badge-acc.dibatalkan {
            background-color: #777; /* Grey */
        }
        .status-badge-acc.terbayar,
        .status-badge-acc.delivered,
        .status-badge-acc.semua-terkirim {
            background-color: #46ad54; /* Green */
        }
        .status-badge-acc.refund {
            background-color: #777;
        }

        .order-card-body {
            padding: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }
        .order-product-info {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }
        .order-product-img {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #eee;
        }
        .order-product-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .order-product-name {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            text-decoration: none;
            transition: color 0.2s;
        }
        .order-product-name:hover {
            color: #1689ff;
        }
        .order-product-meta {
            font-size: 0.88rem;
            color: #666;
        }
        
        .order-total-price {
            font-size: 1.15rem;
            font-weight: 700;
            color: #333;
            text-align: right;
            min-width: 120px;
        }
        
        .order-card-footer {
            padding: 0 18px 18px;
            display: flex;
            justify-content: flex-end;
            border-top: none;
        }
        .btn-payment-confirm-acc {
            color: #1689ff;
            border: 1px solid #8fc6ff;
            border-radius: 4px;
            background: #fff;
            padding: 8px 16px;
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            transition: all 0.2s;
            line-height: 1;
        }
        .btn-payment-confirm-acc:hover {
            background-color: #1689ff;
            color: #fff;
            border-color: #1689ff;
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
                    <li><a href="/account">Akun Saya</a></li>
                    <li><a href="/logout">Logout</a></li>
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

    <main class="account-main">
        <h1 class="account-title">My Account</h1>
        <div class="account-profile-row">
            <div>
                <div class="account-field-label">Nama Depan</div>
                <div class="account-field-value"><?= esc($user['first_name'] ?? $user['name']) ?></div>
            </div>
            <div>
                <div class="account-field-label">Nama Belakang</div>
                <div class="account-field-value"><?= esc($user['last_name'] ?: '-') ?></div>
            </div>
            <div>
                <div class="account-field-label">Email</div>
                <div class="account-field-value"><?= esc($user['email']) ?></div>
            </div>
            <a href="/change-password" class="btn-change-password">Ubah Password</a>
        </div>

        <h2 class="orders-title">Orders</h2>
        <?php if (empty($orders)): ?>
            <div class="orders-empty">Tidak ada order</div>
        <?php else: ?>
            <div class="orders-list">
                <?php foreach ($orders as $order): 
                    $orderStatus = trim((string) ($order['status'] ?? 'pending'));
                    $normalizedStatus = strtolower($orderStatus);
                    
                    $statusClass = 'pending';
                    $statusLabel = 'Belum Dibayar';
                    if (in_array($normalizedStatus, ['dibatalkan', 'cancelled', 'canceled'], true)) {
                        $statusClass = 'dibatalkan';
                        $statusLabel = 'Dibatalkan';
                    } elseif (in_array($normalizedStatus, ['menunggu konfirmasi', 'waiting confirmation'], true)) {
                        $statusClass = 'menunggu-konfirmasi';
                        $statusLabel = 'Menunggu Konfirmasi';
                    } elseif (in_array($normalizedStatus, ['terbayar', 'paid', 'sudah dibayar'], true)) {
                        $statusClass = 'terbayar';
                        $statusLabel = 'Terbayar';
                    } elseif (in_array($normalizedStatus, ['expired', 'kadaluarsa'], true)) {
                        $statusClass = 'expired';
                        $statusLabel = 'Expired';
                    }
                    
                    $months = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
                        7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                    $orderTime = new DateTime($order['created_at'], new DateTimeZone(app_timezone()));
                    $m = (int) $orderTime->format('n');
                    $monthName = $months[$m] ?? $orderTime->format('F');
                    $formattedDate = $orderTime->format('j') . ' ' . $monthName . ' ' . $orderTime->format('Y');

                    $firstItem = $order['items'][0] ?? null;
                    $hasMoreItems = count($order['items'] ?? []) > 1;
                ?>
                <div class="order-card">
                    <!-- Card Header -->
                    <div class="order-card-header">
                        <div class="order-meta">
                            <span class="order-date"><?= $formattedDate ?></span>
                            <a href="/invoice/<?= $order['id'] ?>" class="order-invoice-link"><?= esc($order['invoice_no']) ?></a>
                        </div>
                        <div class="order-status-badges">
                            <span class="status-badge-acc <?= $statusClass ?>"><?= $statusLabel ?></span>
                            
                            <?php if ($statusClass === 'terbayar' && strtolower(trim($order['shipping_status'] ?? '')) === 'sudah sampai'): ?>
                                <span class="status-badge-acc semua-terkirim">Semua Terkirim</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Card Body -->
                    <?php if ($firstItem): ?>
                    <div class="order-card-body">
                        <div class="order-product-info">
                            <img class="order-product-img" src="<?= esc($firstItem['image_url']) ?>" alt="<?= esc($firstItem['product_name']) ?>" onerror="this.src='https://placehold.co/60x60?text=iplant.id'">
                            <div class="order-product-details">
                                <a href="/product-detail/<?= $firstItem['product_id'] ?>" class="order-product-name"><?= esc($firstItem['product_name']) ?></a>
                                <div class="order-product-meta">
                                    Rp <?= number_format($firstItem['price'], 0, ',', '.') ?> &nbsp;&nbsp;&nbsp; <?= $firstItem['quantity'] ?>x
                                    <?php if ($hasMoreItems): ?>
                                        <span style="color: #888; font-style: italic; font-size: 0.85rem; margin-left: 8px;">(+ <?= count($order['items']) - 1 ?> produk lainnya)</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="order-total-price">
                            Rp <?= number_format($order['total_amount'], 0, ',', '.') ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Card Footer (Actions) -->
                    <?php if ($statusLabel === 'Belum Dibayar'): ?>
                    <div class="order-card-footer">
                        <a href="/invoice/<?= $order['id'] ?>/confirm-payment" class="btn-payment-confirm-acc">Konfirmasi Pembayaran</a>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

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
</body>
</html>
