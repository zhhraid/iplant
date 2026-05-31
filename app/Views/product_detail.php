<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - iplant.id</title>
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
    <main class="container product-detail-main">
        <?php
        // Determine product category breadcrumb and thumbnails dynamically
        $sub = $product['subcategory'] ?? 'Bambu Hoki';
        $categoryName = $sub;

        // Map product names to their specific local image paths
        $productName = $product['name'] ?? '';
        $productImagesMap = [
            'Bambu Rejeki Fire Ring' => [
                '/images/products/Bambu Rejeki Fire Ring.png',
                '/images/products/Bambu Rejeki Fire Ring 2.png',
                '/images/products/Bambu Rejeki Fire Ring 3.png',
            ],
            'Bambu Rejeki 3 Tingkat (M)' => [
                '/images/products/Bambu Rejeki 3 Tingkat (M).png',
                '/images/products/Bambu Rejeki 3 Tingkat (M) 2.png',
                '/images/products/Bambu Rejeki 3 Tingkat (M) 3.png',
            ],
            'Bambu Rejeki Triangle Vas' => [
                '/images/products/Bambu Rejeki Triangle Vas.png',
            ],
            'Bambu Rejeki Vas Variegata' => [
                '/images/products/Bambu Rejeki Vas Variegata.png',
                '/images/products/Bambu Rejeki Vas Variegata 2.png',
            ],
            'Bambu Rejeki Curly Vas' => [
                '/images/products/Bambu Rejeki Curly Vas.png',
                '/images/products/Bambu Rejeki Curly Vas 2.png',
            ],
            'Bambu Rejeki Pagoda 5' => [
                '/images/products/Bambu Rejeki Pagoda 5.png',
                '/images/products/Bambu Rejeki Pagoda 5 2.png',
            ],
            'Anggrek Bulan Mini Kuning' => [
                '/images/products/Anggrek Bulan Mini Kuning.png',
                '/images/products/Anggrek Bulan Mini Kuning 2.png',
            ],
            'Anggrek Bulan Mini Putih' => [
                '/images/products/Anggrek Bulan Mini Putih.png',
            ],
            'Cymbidium Chen\'s Ruby' => [
                '/images/products/Cymbidium Chen\'s Ruby.png',
            ],
            'Anggrek Bulan Mini Purple' => [
                '/images/products/Anggrek Bulan Mini Purple.png',
            ],
            'Anggrek Bulan Black Jack' => [
                '/images/products/Anggrek Bulan Black Jack.png',
            ],
            'Anggrek Cattleya Pra-Remaja' => [
                '/images/products/Anggrek Cattleya Pra-Remaja.png',
            ],
            'Mawar Impor Emilien' => [
                '/images/products/Mawar Impor Emilien.png',
                '/images/products/Mawar Impor Emilien 2.jpg',
            ],
            'Blue Moonstone Rose' => [
                '/images/products/Blue Moonstone Rose.png',
            ],
            'Mawar Impor Kahala' => [
                '/images/products/Mawar Impor Kahala.png',
            ],
            'Mawar Impor Aube' => [
                '/images/products/Mawar Impor Aube.png',
            ],
            'Mawar Impor Minion Putih' => [
                '/images/products/Mawar Impor Minion Putih.png',
            ],
            'Mawar Rambat Orange' => [
                '/images/products/Mawar Rambat Orange.png',
            ],
            'Mangga Irwin (Jumbo)' => [
                '/images/products/Mangga Irwin (Jumbo).png',
            ],
            'Mangga Kiojay (Berbuah)' => [
                '/images/products/Mangga Kiojay (Berbuah).png',
            ],
            'Mangga Mahatir' => [
                '/images/products/Mangga Mahatir.png',
            ],
            'Mangga Apel' => [
                '/images/products/Mangga Apel.png',
            ],
            'Mangga Gajah' => [
                '/images/products/Mangga Gajah.png',
            ],
            'Mangga Kiojay' => [
                '/images/products/Mangga Kiojay.png',
            ],
            'Media Tanam Forest Moss 250gr' => [
                '/images/products/Media Tanam Forest Moss 250gr.png',
            ],
            'Media Semai Premium 500gr' => [
                '/images/products/Media Semai Premium 500gr.png',
            ],
            'Rockwool 15cm | Media Semai Benih' => [
                '/images/products/Rockwall 15cm  Media Semai Benih.png',
            ],
            'Media Tanam Akadama 1 Karung' => [
                '/images/products/Media Tanam Akadama 1 Karung.png',
            ],
            'Media Tanam Premium AKADAMA' => [
                '/images/products/Media Tanam Premium AKADAMA.png',
            ],
            'Media Tanam Kaktus Premium' => [
                '/images/products/Media Tanam Kaktus Premium.png',
            ],
        ];

        $thumbnails = $productImagesMap[$productName] ?? [$product['image_url']];

        // Specifications mapping
        if ($sub === 'Bambu Hoki') {
            $specs = [
                ['icon' => 'fas fa-ruler-vertical', 'text' => '20-30 cm'],
                ['icon' => 'fas fa-sun', 'text' => 'partial sun'],
                ['icon' => 'fas fa-tint', 'text' => '1x sehari'],
            ];
        } elseif ($sub === 'Anggrek') {
            $specs = [
                ['icon' => 'fas fa-ruler-vertical', 'text' => '25-35 cm'],
                ['icon' => 'fas fa-sun', 'text' => 'partial shade'],
                ['icon' => 'fas fa-tint', 'text' => '1x sehari'],
            ];
        } elseif ($sub === 'Mawar') {
            $specs = [
                ['icon' => 'fas fa-ruler-vertical', 'text' => '30-40 cm'],
                ['icon' => 'fas fa-sun', 'text' => 'full sun'],
                ['icon' => 'fas fa-tint', 'text' => '2x sehari'],
            ];
        } elseif ($sub === 'Mangga') {
            $specs = [
                ['icon' => 'fas fa-ruler-vertical', 'text' => '60-80 cm'],
                ['icon' => 'fas fa-sun', 'text' => 'full sun'],
                ['icon' => 'fas fa-tint', 'text' => '1x sehari'],
            ];
        } else { // Media Tanam
            $specs = [
                ['icon' => 'fas fa-weight-hanging', 'text' => '250g - 2kg'],
                ['icon' => 'fas fa-house-user', 'text' => 'indoor/outdoor'],
                ['icon' => 'fas fa-shield-alt', 'text' => 'steril & organik'],
            ];
        }
        ?>

        <div class="breadcrumb">
            <a href="/">Semua Produk</a> > <span><?= esc($categoryName) ?></span>
        </div>

        <div class="product-detail-top">
            <div class="product-gallery">
                <?php if (count($thumbnails) > 1): ?>
                <div class="gallery-thumbnails">
                    <?php foreach($thumbnails as $idx => $thumb): ?>
                        <img src="<?= esc($thumb) ?>" class="<?= $idx === 0 ? 'active' : '' ?>" onclick="switchImage(this, '<?= esc($thumb) ?>')" onerror="this.src='https://placehold.co/80x80?text=iplant'">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <div class="gallery-main">
                    <img src="<?= esc($product['image_url']) ?>" id="mainProductImage" alt="<?= esc($product['name']) ?>" onerror="this.src='https://placehold.co/400x500?text=iplant.id'">
                </div>
            </div>

            <div class="product-info-detail">
                <h1 class="product-detail-title"><?= esc($product['name']) ?></h1>
                
                <div class="product-rating-detail">
                    <span class="rating-score"><?= number_format($product['rating'] ?? 0.0, 1) ?></span>
                    <?php 
                    $rating = $product['rating'] ?? 0.0;
                    $fullStars = floor($rating);
                    $emptyStars = 5 - $fullStars;
                    for($k = 0; $k < $fullStars; $k++) {
                        echo '<i class="fas fa-star" style="color: #f1c40f;"></i> ';
                    }
                    for($k = 0; $k < $emptyStars; $k++) {
                        echo '<i class="far fa-star" style="color: #ccc;"></i> ';
                    }
                    ?>
                    <span class="rating-count">(<?= esc($product['reviews_count'] ?? 0) ?>)</span>
                </div>

                <div class="product-price-detail">
                    <?php if(!empty($product['old_price'])): ?>
                        <span class="price-old" style="text-decoration: line-through; color: #888; font-style: italic; font-size: 1.2rem; margin-right: 10px;">Rp <?= number_format($product['old_price'], 0, ',', '.') ?></span>
                    <?php endif; ?>
                    <span class="price-new" style="color: #222; font-weight: 700;">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                </div>

                <div class="qty-selector">
                    <button class="btn-qty-minus" onclick="updateQty(-1)">-</button>
                    <input type="text" value="1" class="qty-input" id="qtyInput" readonly>
                    <button class="btn-qty-plus" onclick="updateQty(1)">+</button>
                </div>

                <?php if($product['stock'] <= 0): ?>
                    <div class="product-out-of-stock" style="color: #e84a4a; font-weight: 600; margin-bottom: 15px;">Tidak ada stock</div>
                <?php endif; ?>

                <div class="product-actions">
                    <button class="btn-buy-now" onclick="buyNow()" style="background-color: #e74c3c;">Beli Sekarang</button>
                    <button class="btn-add-cart" id="btnAddToCart" onclick="addToCart(<?= $product['id'] ?>)" style="background-color: #5cb85c;">Tambah ke Keranjang</button>
                </div>
            </div>
        </div>

        <div class="product-description">
            <?= $product['description'] ?>
        </div>

        <div class="related-products">
            <h3>Produk Lainnya</h3>
            <div class="related-grid">
                <?php foreach($related as $r): ?>
                <div class="category-card">
                    <div class="category-image">
                        <img src="<?= esc($r['image_url']) ?>" alt="<?= esc($r['name']) ?>" onerror="this.src='https://placehold.co/200x250?text=iplant.id'">
                        <span class="category-badge">iplant.id</span>
                    </div>
                    <div class="category-info">
                        <div class="category-price">
                            <?php if(!empty($r['old_price'])): ?>
                                <span class="category-price-old">Rp <?= number_format($r['old_price'], 0, ',', '.') ?></span>
                            <?php endif; ?>
                            Rp <?= number_format($r['price'], 0, ',', '.') ?>
                        </div>
                        <h4 class="category-title"><a href="/product-detail/<?= $r['id'] ?>"><?= esc($r['name']) ?></a></h4>
                        <div class="category-rating">
                            <?php 
                            $rRating = $r['rating'] ?? 0.0;
                            $rFull = floor($rRating);
                            $rEmpty = 5 - $rFull;
                            for($k = 0; $k < $rFull; $k++) {
                                echo '<i class="fas fa-star" style="color: #f1c40f;"></i>';
                            }
                            for($k = 0; $k < $rEmpty; $k++) {
                                echo '<i class="far fa-star" style="color: #ccc;"></i>';
                            }
                            ?>
                            <span class="rating-count">(<?= esc($r['reviews_count'] ?? 0) ?>)</span>
                        </div>
                        <div class="share-link"><i class="fas fa-share"></i> Share</div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- Modal Pop-up -->
    <div id="cartModal" class="modal-overlay">
        <div class="modal-content">
            <h3 class="modal-title">Barang berhasil dimasukkan ke keranjang</h3>
            <div class="modal-actions">
                <a href="/cart" class="btn-modal-cart">Lihat Keranjang</a>
                <button id="btnContinueShopping" class="btn-modal-continue">Kembali Berbelanja</button>
            </div>
        </div>
    </div>

    <!-- Black Footer -->
    <footer class="footer-black">
        <div class="container footer-black-container">
            <div class="footer-black-col">
                <h4>Links</h4>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="#">Daftar Produk</a></li>
                    <li><a href="#">Konfirmasi Pembayaran</a></li>
                </ul>
            </div>
            <div class="footer-black-col">
                <h4>Social Media</h4>
                <div class="social-icons-black">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
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
        const maxStock = <?= $product['stock'] > 0 ? $product['stock'] : 99 ?>;
        
        function switchImage(el, src) {
            document.getElementById('mainProductImage').src = src;
            document.querySelectorAll('.gallery-thumbnails img').forEach(img => img.classList.remove('active'));
            el.classList.add('active');
        }

        function updateQty(change) {
            const input = document.getElementById('qtyInput');
            let current = parseInt(input.value);
            let newVal = current + change;
            if (newVal >= 1 && newVal <= maxStock) {
                input.value = newVal;
            }
        }

        function addToCart(productId) {
            const qty = document.getElementById('qtyInput').value;
            
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `product_id=${productId}&quantity=${qty}`
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    // Update badge
                    let badge = document.querySelector('.badge-cart');
                    if(badge) badge.innerText = data.cart_count;
                    document.getElementById('cartModal').style.display = 'flex';
                }
            });
        }
        
        function buyNow() {
            const productId = <?= $product['id'] ?>;
            const qty = document.getElementById('qtyInput').value;
            
            fetch('/checkout/buy-now', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `product_id=${productId}&quantity=${qty}`
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === 'success') {
                    window.location.href = '/checkout/info?source=buy_now';
                }
            });
        }

        document.getElementById('btnContinueShopping').addEventListener('click', function() {
            document.getElementById('cartModal').style.display = 'none';
        });
    </script>
</body>
</html>
