<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - iplant.id</title>
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
    <main class="container category-main">
        <!-- Sidebar -->
        <aside class="category-sidebar">
            <h3 class="sidebar-title">KATEGORI</h3>
            <ul class="sidebar-list">
                <li class="<?= $active_sub === 'bambu-hoki' ? 'active' : '' ?>"><a href="/category/bambu-hoki">Bambu Hoki</a></li>
                <li class="<?= $active_sub === 'anggrek' ? 'active' : '' ?>"><a href="/category/anggrek">Anggrek</a></li>
                <li class="<?= $active_sub === 'mawar' ? 'active' : '' ?>"><a href="/category/mawar">Mawar</a></li>
                <li class="<?= $active_sub === 'mangga' ? 'active' : '' ?>"><a href="/category/mangga">Mangga</a></li>
                <li class="<?= $active_sub === 'media-tanam' ? 'active' : '' ?>"><a href="/category/media-tanam">Media Tanam</a></li>
            </ul>
        </aside>

        <!-- Content -->
        <section class="category-content">
            <h2 class="category-search-title" style="font-size: 1.3rem; margin-bottom: 25px; font-weight: 500; color: #222; font-family: 'Inter', sans-serif;">
                Hasil pencarian untuk <em style="font-style: italic; font-weight: 700;"><?= esc(strtolower($active_sub_name)) ?></em>
            </h2>

            <div class="sort-bar">
                <label>Urutkan:</label>
                <select>
                    <option>Terbaru</option>
                </select>
            </div>

            <div class="category-grid">
                <?php
                if (!empty($products)):
                    $count = 0;
                    foreach($products as $p):
                        $isHidden = ($count >= 3);
                        $count++;
                ?>
                <div class="category-card <?= $isHidden ? 'hidden-product' : '' ?>" <?= $isHidden ? 'style="display: none;"' : '' ?>>
                    <div class="category-image">
                        <img src="<?= esc($p['image_url']) ?>" alt="<?= esc($p['name']) ?>" onerror="this.src='https://placehold.co/200x250?text=iplant.id'">
                        <span class="category-badge">iplant.id</span>
                    </div>
                    <div class="category-info">
                        <div class="category-price">
                            <?php if(!empty($p['old_price'])): ?>
                                <span class="category-price-old">Rp <?= number_format($p['old_price'], 0, ',', '.') ?></span>
                            <?php endif; ?>
                            Rp <?= number_format($p['price'], 0, ',', '.') ?>
                        </div>
                        <h4 class="category-title"><a href="/product-detail/<?= $p['id'] ?>"><?= esc($p['name']) ?></a></h4>
                        <div class="category-rating">
                            <?php
                            $rRating = $p['rating'] ?? 0.0;
                            $rFull = floor($rRating);
                            $rEmpty = 5 - $rFull;
                            for($k = 0; $k < $rFull; $k++) {
                                echo '<i class="fas fa-star" style="color: #f1c40f;"></i>';
                            }
                            for($k = 0; $k < $rEmpty; $k++) {
                                echo '<i class="far fa-star" style="color: #ccc;"></i>';
                            }
                            ?>
                            <span class="rating-count">(<?= esc($p['reviews_count'] ?? 0) ?>)</span>
                        </div>
                    </div>
                </div>
                <?php 
                    endforeach; 
                else:
                ?>
                    <p>Tidak ada produk dalam sub-kategori ini.</p>
                <?php endif; ?>
            </div>

            <?php if (!empty($products) && count($products) > 3): ?>
            <div class="load-more-container" style="text-align: center; margin-top: 40px; margin-bottom: 20px;">
                <button id="btnLoadMore" class="btn-load-more">Lihat Lagi</button>
            </div>
            <?php endif; ?>
        </section>
    </main>

    <!-- Black Footer -->
    <footer class="footer-black">
        <div class="container footer-black-container">
            <div class="footer-black-col">
                <h4>Links</h4>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="#">Blog</a></li>
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
        document.getElementById('btnLoadMore')?.addEventListener('click', function() {
            const hiddenProducts = document.querySelectorAll('.category-card.hidden-product');
            let count = 0;
            hiddenProducts.forEach(prod => {
                if (count < 3) {
                    prod.style.display = 'block';
                    prod.classList.remove('hidden-product');
                    count++;
                }
            });
            // Hide button if no more hidden products
            if (document.querySelectorAll('.category-card.hidden-product').length === 0) {
                this.style.display = 'none';
            }
        });
    </script>
</body>
</html>
