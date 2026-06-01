<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - iplant.id</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <!-- Header -->
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

    <!-- Main Content -->
    <main class="container cart-main">
        <?php if(empty($cart)): ?>
            <div style="text-align:center; padding: 50px 0;">
                <h3 style="color:#7f8c8d; margin-bottom: 20px;">Kamu belum memiliki produk di kantong belanja</h3>
                <a href="/" style="background:#3498db; color:#fff; padding:10px 20px; border-radius:4px; text-decoration:none;">Kembali ke Home</a>
            </div>
        <?php else: ?>
            <?php 
                $subtotal = 0;
                foreach($cart as $item): 
                    $itemSubtotal = $item['price'] * $item['quantity'];
                    $subtotal += $itemSubtotal;
            ?>
            <div class="cart-item" id="cart-item-<?= $item['id'] ?>">
                <div class="cart-item-image">
                    <img src="<?= esc($item['image_url']) ?>" alt="<?= esc($item['name']) ?>">
                </div>
                <div class="cart-item-info">
                    <div class="cart-item-title-row">
                        <a href="/product-detail/<?= $item['id'] ?>" class="cart-item-name"><?= esc($item['name']) ?></a>
                        <i class="fas fa-times cart-item-remove" onclick="removeCart(<?= $item['id'] ?>)"></i>
                    </div>
                    <div class="cart-item-price">Rp <?= number_format($item['price'], 0, ',', '.') ?></div>
                </div>
                <div class="cart-item-actions">
                    <div class="qty-selector">
                        <button class="btn-qty-minus" onclick="updateCartQty(<?= $item['id'] ?>, -1)">-</button>
                        <input type="text" value="<?= $item['quantity'] ?>" class="qty-input" id="qty-input-<?= $item['id'] ?>" readonly>
                        <button class="btn-qty-plus" onclick="updateCartQty(<?= $item['id'] ?>, 1)">+</button>
                    </div>
                    <div class="cart-item-subtotal">Rp <?= number_format($itemSubtotal, 0, ',', '.') ?></div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="cart-summary">
                <div class="cart-total-line">
                    <span class="total-label">Total</span>
                    <span class="total-amount" id="cart-total">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                </div>
                <a href="/checkout/info?source=cart" class="btn-checkout" style="text-decoration:none; display:inline-block; text-align:center;">Checkout</a>
            </div>
        <?php endif; ?>
    </main>

    <!-- Black Footer -->
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

    <script>
        function updateCartQty(productId, change) {
            const input = document.getElementById('qty-input-' + productId);
            let current = parseInt(input.value);
            let newVal = current + change;
            if (newVal >= 1) {
                // Update via AJAX
                fetch('/cart/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: `product_id=${productId}&quantity=${newVal}`
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status === 'success') {
                        window.location.reload();
                    }
                });
            }
        }

        function removeCart(productId) {
            fetch('/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    window.location.reload();
                }
            });
        }
    </script>
</body>
</html>
