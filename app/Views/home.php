<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iplant.id - Toko Tanaman Online</title>
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
                <img src="/images/logo.png" alt="iplant.id Logo" onerror="this.src='https://placehold.co/150x50?text=iplant.id'">
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
                    <li><a href="/login">Login</a></li>
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
    <main class="container main-content">
        <div class="product-grid">
            <!-- Dynamic Product Items from Database -->
            <?php 
            if (!empty($products)): 
                $count = 0;
                foreach($products as $p): 
                    $isHidden = ($count >= 10);
                    $count++;
            ?>
                <div class="product-card <?= $isHidden ? 'hidden-product' : '' ?>" <?= $isHidden ? 'style="display: none;"' : '' ?>>
                    <div class="product-header">
                        <?php 
                        // Break name into two lines if it's long
                        $nameParts = explode(' ', $p['name'], 3);
                        $titleTop = isset($nameParts[1]) ? $nameParts[0] . ' ' . $nameParts[1] : $p['name'];
                        $titleBottom = isset($nameParts[2]) ? $nameParts[2] : '';

                        // Determine subcategory close up image
                        $closeUpImage = 'https://images.unsplash.com/photo-1549241520-425e3dfc01cb?w=120&h=90&fit=crop'; // default (mawar)
                        if ($p['subcategory'] === 'Bambu Hoki') {
                            $closeUpImage = 'https://images.unsplash.com/photo-1534710961216-75c9d402f03e?w=120&h=90&fit=crop';
                        } elseif ($p['subcategory'] === 'Anggrek') {
                            $closeUpImage = 'https://images.unsplash.com/photo-1525310072745-f49212b5ac6d?w=120&h=90&fit=crop';
                        } elseif ($p['subcategory'] === 'Mawar') {
                            $closeUpImage = '/images/products/mawar-close.jpg';
                        } elseif ($p['subcategory'] === 'Mangga') {
                            $closeUpImage = 'https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?w=120&h=90&fit=crop';
                        } elseif ($p['subcategory'] === 'Media Tanam') {
                            $closeUpImage = 'https://images.unsplash.com/photo-1599599810769-bcde5a160d32?w=120&h=90&fit=crop';
                        }
                        ?>
                        <div class="product-title-top"><?= esc($titleTop) ?><br><?= esc($titleBottom) ?></div>
                        <div class="product-top-right">
                            <img src="/images/logo.png" alt="iplant.id" class="small-logo" onerror="this.style.display='none'">
                            <img src="<?= $closeUpImage ?>" alt="<?= esc($p['subcategory']) ?> close up" class="product-close-up" onerror="this.src='https://images.unsplash.com/photo-1549241520-425e3dfc01cb?w=120&h=90&fit=crop'">
                        </div>
                    </div>
                    
                    <div class="product-main-image-container">
                        <div class="plant-specs">
                            <?php if (stripos($p['name'], 'bambu') !== false): ?>
                                <div class="spec-item"><span class="spec-icon"><i class="fas fa-ruler-vertical"></i></span> <span>20-30 cm</span></div>
                                <div class="spec-item"><span class="spec-icon"><i class="fas fa-sun"></i></span> <span>partial sun</span></div>
                                <div class="spec-item"><span class="spec-icon"><i class="fas fa-tint"></i></span> <span>1x sehari</span></div>
                            <?php else: ?>
                                <div class="spec-item"><span class="spec-icon"><i class="fas fa-ruler-vertical"></i></span> <span>30-40 cm</span></div>
                                <div class="spec-item"><span class="spec-icon"><i class="fas fa-sun"></i></span> <span>full sun</span></div>
                                <div class="spec-item"><span class="spec-icon"><i class="fas fa-tint"></i></span> <span>2x sehari</span></div>
                            <?php endif; ?>
                        </div>
                        <img src="<?= esc($p['image_url']) ?>" alt="<?= esc($p['name']) ?>" class="product-main-image" onerror="this.src='https://placehold.co/200x250?text=iplant.id'">
                    </div>
                    
                    <div class="product-footer-text">www.iplant.id | 0831-6500-7109</div>
                    
                    <div class="product-price-section">
                        <?php if(!empty($p['old_price'])): ?>
                            <span class="price-old">Rp <?= number_format($p['old_price'], 0, ',', '.') ?></span>
                        <?php endif; ?>
                        <span class="price-new">Rp <?= number_format($p['price'], 0, ',', '.') ?></span>
                    </div>
                    
                    <div class="product-subtitle"><?= esc($p['name']) ?></div>
                    
                    <div class="product-rating">
                        <?php 
                        $rating = $p['rating'] ?? 0.0;
                        $fullStars = floor($rating);
                        $emptyStars = 5 - $fullStars;
                        ?>
                        <div class="stars">
                            <?php for($k = 0; $k < $fullStars; $k++): ?>
                                <i class="fas fa-star" style="color: #f1c40f;"></i>
                            <?php endfor; ?>
                            <?php for($k = 0; $k < $emptyStars; $k++): ?>
                                <i class="far fa-star" style="color: #ccc;"></i>
                            <?php endfor; ?>
                        </div>
                        <span class="review-count">(<?= esc($p['reviews_count'] ?? 0) ?>)</span>
                    </div>
                    
                    <div class="product-actions">
                        <button class="btn-share"><i class="fas fa-share"></i> Bagikan</button>
                        <button class="btn-detail" onclick="window.location.href='/product-detail/<?= $p['id'] ?>'">Lihat Detil</button>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada produk tersedia.</p>
            <?php endif; ?>
        </div>
        
        <div class="load-more-container">
            <button class="btn-load-more">Load More</button>
        </div>
    </main>

    <!-- Shipping Section -->
    <section class="shipping-section">
        <div class="container">
            <h2 class="shipping-title">Cek Ongkos Kirim</h2>
            <div class="shipping-form" style="position: relative;">
                <div class="form-group">
                    <label>Asal</label>
                    <select disabled style="background-color: #f5f5f5; cursor: not-allowed;">
                        <option>Kota Makassar</option>
                    </select>
                </div>
                
                <!-- Searchable Custom Dropdown for Kota/Kabupaten -->
                <div class="form-group" style="position: relative;">
                    <label for="home_city_trigger">Tujuan</label>
                    <input type="hidden" id="home_city" name="destination" required>
                    <div id="home_city_trigger" class="custom-select-trigger" onclick="toggleHomeCityDropdown(event)">
                        <span id="home_city_selected_text" style="color: #999;">Pilih Kota/Kabupaten</span>
                        <i class="fas fa-chevron-down" style="font-size: 0.8rem; color: #999;"></i>
                    </div>
                    
                    <div id="home_city_dropdown" class="custom-select-dropdown" style="display: none; width: 100%;">
                        <div class="dropdown-arrow"></div>
                        <div class="dropdown-search-wrapper">
                            <input type="text" id="home_city_search_input" placeholder="Cari..." autocomplete="off" oninput="filterHomeCities(this.value)" onclick="event.stopPropagation()">
                            <button type="button" class="dropdown-search-btn" onclick="event.stopPropagation()">
                                <i class="fas fa-search" style="color: #aaa;"></i>
                            </button>
                        </div>
                        <ul id="home_city_options_list" class="dropdown-options-list">
                            <li class="dropdown-message">Ketik 3 huruf</li>
                        </ul>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Kurir</label>
                    <select id="home_courier">
                        <option value="all">Semua Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="jnt">J&T Express</option>
                        <option value="tiki">TIKI</option>
                        <option value="lion">Lion Parcel</option>
                        <option value="pos">POS Indonesia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Berat (g)</label>
                    <input type="number" id="home_weight" value="1000" min="1" required>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-primary" onclick="checkShippingRates()">Cek Ongkir</button>
                    <button type="button" class="btn btn-outline" onclick="resetShippingForm()">Batal</button>
                </div>
            </div>
            
            <!-- Shipping Results Table -->
            <div class="shipping-results" id="home_shipping_results" style="display: none; margin-top: 30px;">
                <table style="width: 100%; border-collapse: collapse; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden;">
                    <thead>
                        <tr style="background-color: #f5f5f5; border-bottom: 2px solid #eaeaea;">
                            <th style="padding: 15px; text-align: left; font-weight: 600; color: #333;">Kurir</th>
                            <th style="padding: 15px; text-align: left; font-weight: 600; color: #333;">Layanan</th>
                            <th style="padding: 15px; text-align: left; font-weight: 600; color: #333;">Biaya</th>
                            <th style="padding: 15px; text-align: left; font-weight: 600; color: #333;">Estimasi</th>
                        </tr>
                    </thead>
                    <tbody id="home_shipping_results_body">
                        <!-- Filled dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-container">
            <div class="footer-col">
                <h4>iplant.id</h4>
                <ul>
                    <li><a href="#">Kategori</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Sosial Media</h4>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Hubungi Kami</h4>
                <ul class="contact-info">
                    <li><i class="fas fa-map-marker-alt"></i> Jl. Pertanian No. 1, Makassar</li>
                    <li><i class="fas fa-envelope"></i> info@iplant.id</li>
                    <li><i class="fas fa-phone"></i> +62 812 3456 7890</li>
                </ul>
            </div>
            <div class="footer-col newsletter-col">
                <h4>Berlangganan Newsletter</h4>
                <div class="newsletter-form">
                    <input type="email" placeholder="Email Anda...">
                    <button class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 iplant.id - Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <script>
        document.querySelector('.btn-load-more')?.addEventListener('click', function() {
            const hiddenProducts = document.querySelectorAll('.product-card.hidden-product');
            let count = 0;
            hiddenProducts.forEach(prod => {
                if (count < 10) {
                    prod.style.display = 'block';
                    prod.classList.remove('hidden-product');
                    count++;
                }
            });
            // Hide button container if no more hidden products
            if (document.querySelectorAll('.product-card.hidden-product').length === 0) {
                this.parentElement.style.display = 'none';
            }
        });
        
        // Hide button container initially if <= 10 products
        if (document.querySelectorAll('.product-card').length <= 10) {
            const container = document.querySelector('.load-more-container');
            if (container) container.style.display = 'none';
        }

        // --- Cek Ongkir Feature ---
        const wilayahIndonesia = [
          "DKI Jakarta, Jakarta Pusat, Gambir",
          "DKI Jakarta, Jakarta Pusat, Sawah Besar",
          "DKI Jakarta, Jakarta Pusat, Kemayoran",
          "DKI Jakarta, Jakarta Pusat, Senen",
          "DKI Jakarta, Jakarta Pusat, Cempaka Putih",
          "DKI Jakarta, Jakarta Pusat, Menteng",
          "DKI Jakarta, Jakarta Pusat, Tanah Abang",
          "DKI Jakarta, Jakarta Pusat, Johar Baru",

          "DKI Jakarta, Jakarta Utara, Penjaringan",
          "DKI Jakarta, Jakarta Utara, Pademangan",
          "DKI Jakarta, Jakarta Utara, Tanjung Priok",
          "DKI Jakarta, Jakarta Utara, Koja",
          "DKI Jakarta, Jakarta Utara, Kelapa Gading",
          "DKI Jakarta, Jakarta Utara, Cilincing",

          "DKI Jakarta, Jakarta Barat, Cengkareng",
          "DKI Jakarta, Jakarta Barat, Grogol Petamburan",
          "DKI Jakarta, Jakarta Barat, Taman Sari",
          "DKI Jakarta, Jakarta Barat, Tambora",
          "DKI Jakarta, Jakarta Barat, Kebon Jeruk",
          "DKI Jakarta, Jakarta Barat, Kalideres",
          "DKI Jakarta, Jakarta Barat, Palmerah",
          "DKI Jakarta, Jakarta Barat, Kembangan",

          "DKI Jakarta, Jakarta Selatan, Kebayoran Baru",
          "DKI Jakarta, Jakarta Selatan, Kebayoran Lama",
          "DKI Jakarta, Jakarta Selatan, Pesanggrahan",
          "DKI Jakarta, Jakarta Selatan, Cilandak",
          "DKI Jakarta, Jakarta Selatan, Pasar Minggu",
          "DKI Jakarta, Jakarta Selatan, Jagakarsa",
          "DKI Jakarta, Jakarta Selatan, Mampang Prapatan",
          "DKI Jakarta, Jakarta Selatan, Pancoran",
          "DKI Jakarta, Jakarta Selatan, Tebet",
          "DKI Jakarta, Jakarta Selatan, Setiabudi",

          "DKI Jakarta, Jakarta Timur, Matraman",
          "DKI Jakarta, Jakarta Timur, Pulo Gadung",
          "DKI Jakarta, Jakarta Timur, Jatinegara",
          "DKI Jakarta, Jakarta Timur, Duren Sawit",
          "DKI Jakarta, Jakarta Timur, Kramat Jati",
          "DKI Jakarta, Jakarta Timur, Makasar",
          "DKI Jakarta, Jakarta Timur, Pasar Rebo",
          "DKI Jakarta, Jakarta Timur, Ciracas",
          "DKI Jakarta, Jakarta Timur, Cipayung",
          "DKI Jakarta, Jakarta Timur, Cakung",

          "Jawa Barat, Kota Bandung, Bandung Wetan",
          "Jawa Barat, Kota Bandung, Coblong",
          "Jawa Barat, Kota Bandung, Sukajadi",
          "Jawa Barat, Kota Bandung, Cicendo",
          "Jawa Barat, Kota Bandung, Lengkong",
          "Jawa Barat, Kota Bandung, Regol",
          "Jawa Barat, Kota Bandung, Batununggal",
          "Jawa Barat, Kota Bandung, Kiaracondong",

          "Jawa Barat, Kota Bogor, Bogor Tengah",
          "Jawa Barat, Kota Bogor, Bogor Utara",
          "Jawa Barat, Kota Bogor, Bogor Selatan",
          "Jawa Barat, Kota Bogor, Bogor Timur",
          "Jawa Barat, Kota Bogor, Bogor Barat",
          "Jawa Barat, Kota Bogor, Tanah Sareal",

          "Jawa Barat, Kota Depok, Beji",
          "Jawa Barat, Kota Depok, Cimanggis",
          "Jawa Barat, Kota Depok, Pancoran Mas",
          "Jawa Barat, Kota Depok, Sukmajaya",
          "Jawa Barat, Kota Depok, Limo",
          "Jawa Barat, Kota Depok, Sawangan",
          "Jawa Barat, Kota Depok, Bojongsari",
          "Jawa Barat, Kota Depok, Cilodong",
          "Jawa Barat, Kota Depok, Cinere",
          "Jawa Barat, Kota Depok, Cipayung",
          "Jawa Barat, Kota Depok, Tapos",

          "Jawa Tengah, Kota Semarang, Semarang Tengah",
          "Jawa Tengah, Kota Semarang, Semarang Utara",
          "Jawa Tengah, Kota Semarang, Semarang Timur",
          "Jawa Tengah, Kota Semarang, Semarang Selatan",
          "Jawa Tengah, Kota Semarang, Semarang Barat",
          "Jawa Tengah, Kota Semarang, Candisari",
          "Jawa Tengah, Kota Semarang, Gajahmungkur",
          "Jawa Tengah, Kota Semarang, Tembalang",

          "DI Yogyakarta, Kota Yogyakarta, Danurejan",
          "DI Yogyakarta, Kota Yogyakarta, Gedongtengen",
          "DI Yogyakarta, Kota Yogyakarta, Gondokusuman",
          "DI Yogyakarta, Kota Yogyakarta, Gondomanan",
          "DI Yogyakarta, Kota Yogyakarta, Jetis",
          "DI Yogyakarta, Kota Yogyakarta, Kotagede",
          "DI Yogyakarta, Kota Yogyakarta, Kraton",
          "DI Yogyakarta, Kota Yogyakarta, Mantrijeron",
          "DI Yogyakarta, Kota Yogyakarta, Mergangsan",
          "DI Yogyakarta, Kota Yogyakarta, Ngampilan",
          "DI Yogyakarta, Kota Yogyakarta, Pakualaman",
          "DI Yogyakarta, Kota Yogyakarta, Tegalrejo",
          "DI Yogyakarta, Kota Yogyakarta, Umbulharjo",
          "DI Yogyakarta, Kota Yogyakarta, Wirobrajan",

          "Jawa Timur, Kota Surabaya, Tegalsari",
          "Jawa Timur, Kota Surabaya, Genteng",
          "Jawa Timur, Kota Surabaya, Bubutan",
          "Jawa Timur, Kota Surabaya, Simokerto",
          "Jawa Timur, Kota Surabaya, Pabean Cantian",
          "Jawa Timur, Kota Surabaya, Semampir",
          "Jawa Timur, Kota Surabaya, Krembangan",
          "Jawa Timur, Kota Surabaya, Kenjeran",
          "Jawa Timur, Kota Surabaya, Tambaksari",
          "Jawa Timur, Kota Surabaya, Gubeng",
          "Jawa Timur, Kota Surabaya, Rungkut",

          "Banten, Kota Tangerang, Tangerang",
          "Banten, Kota Tangerang, Karawaci",
          "Banten, Kota Tangerang, Cibodas",
          "Banten, Kota Tangerang, Cipondoh",
          "Banten, Kota Tangerang, Pinang",
          "Banten, Kota Tangerang, Ciledug",
          "Banten, Kota Tangerang, Larangan",

          "Sumatera Barat, Kota Padang, Padang Barat",
          "Sumatera Barat, Kota Padang, Padang Timur",
          "Sumatera Barat, Kota Padang, Padang Selatan",
          "Sumatera Barat, Kota Padang, Padang Utara",
          "Sumatera Barat, Kota Padang, Koto Tangah",
          "Sumatera Barat, Kota Padang, Kuranji",
          "Sumatera Barat, Kota Padang, Pauh",
          "Sumatera Barat, Kota Padang, Lubuk Kilangan",
          "Sumatera Barat, Kota Padang, Lubuk Begalung",
          "Sumatera Barat, Kota Padang, Bungus Teluk Kabung",
          "Sumatera Barat, Kota Padang, Nanggalo",

          "Sumatera Utara, Kota Medan, Medan Kota",
          "Sumatera Utara, Kota Medan, Medan Barat",
          "Sumatera Utara, Kota Medan, Medan Timur",
          "Sumatera Utara, Kota Medan, Medan Utara",
          "Sumatera Utara, Kota Medan, Medan Petisah",
          "Sumatera Utara, Kota Medan, Medan Baru",
          "Sumatera Utara, Kota Medan, Medan Johor",
          "Sumatera Utara, Kota Medan, Medan Selayang",

          "Riau, Kota Pekanbaru, Pekanbaru Kota",
          "Riau, Kota Pekanbaru, Sail",
          "Riau, Kota Pekanbaru, Sukajadi",
          "Riau, Kota Pekanbaru, Senapelan",
          "Riau, Kota Pekanbaru, Lima Puluh",
          "Riau, Kota Pekanbaru, Rumbai",

          "Bali, Kota Denpasar, Denpasar Barat",
          "Bali, Kota Denpasar, Denpasar Timur",
          "Bali, Kota Denpasar, Denpasar Selatan",
          "Bali, Kota Denpasar, Denpasar Utara",

          "Sulawesi Selatan, Kota Makassar, Makassar",
          "Sulawesi Selatan, Kota Makassar, Ujung Pandang",
          "Sulawesi Selatan, Kota Makassar, Rappocini",
          "Sulawesi Selatan, Kota Makassar, Panakkukang",
          "Sulawesi Selatan, Kota Makassar, Tamalate",
          "Sulawesi Selatan, Kota Makassar, Biringkanaya",

          "Kalimantan Timur, Kota Balikpapan, Balikpapan Kota",
          "Kalimantan Timur, Kota Balikpapan, Balikpapan Utara",
          "Kalimantan Timur, Kota Balikpapan, Balikpapan Selatan",
          "Kalimantan Timur, Kota Balikpapan, Balikpapan Timur",
          "Kalimantan Timur, Kota Balikpapan, Balikpapan Barat",

          "Papua, Kota Jayapura, Jayapura Utara",
          "Papua, Kota Jayapura, Jayapura Selatan",
          "Papua, Kota Jayapura, Abepura",
          "Papua, Kota Jayapura, Muara Tami",
          "Papua, Kota Jayapura, Heram"
        ];

        function toggleHomeCityDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('home_city_dropdown');
            const isHidden = dropdown.style.display === 'none';
            
            dropdown.style.display = isHidden ? 'block' : 'none';
            
            if (isHidden) {
                const searchInput = document.getElementById('home_city_search_input');
                searchInput.value = '';
                searchInput.focus();
                filterHomeCities('');
            }
        }

        function filterHomeCities(query) {
            const trimmed = query.trim().toLowerCase();
            const listEl = document.getElementById('home_city_options_list');
            listEl.innerHTML = '';

            if (trimmed.length < 3) {
                const msgLi = document.createElement('li');
                msgLi.className = 'dropdown-message';
                msgLi.innerText = 'Ketik 3 huruf';
                listEl.appendChild(msgLi);
                return;
            }

            const matches = wilayahIndonesia.filter(item => item.toLowerCase().includes(trimmed));

            if (matches.length === 0) {
                const msgLi = document.createElement('li');
                msgLi.className = 'dropdown-message';
                msgLi.innerText = 'Tidak ditemukan';
                listEl.appendChild(msgLi);
                return;
            }

            matches.forEach(cityStr => {
                const li = document.createElement('li');
                li.innerText = cityStr;
                li.style.padding = '8px 12px';
                li.style.cursor = 'pointer';
                li.onclick = function(e) {
                    e.stopPropagation();
                    selectHomeCity(cityStr);
                };
                listEl.appendChild(li);
            });
        }

        function selectHomeCity(val) {
            document.getElementById('home_city').value = val;
            const textSpan = document.getElementById('home_city_selected_text');
            textSpan.innerText = val;
            textSpan.style.color = '#333';
            document.getElementById('home_city_dropdown').style.display = 'none';
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('home_city_dropdown');
            const trigger = document.getElementById('home_city_trigger');
            if (dropdown && trigger && !dropdown.contains(event.target) && !trigger.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });

        function checkShippingRates() {
            const destination = document.getElementById('home_city').value;
            const courier = document.getElementById('home_courier').value;
            const weight = document.getElementById('home_weight').value;

            if (!destination) {
                alert('Silakan pilih kota/kabupaten tujuan terlebih dahulu.');
                return;
            }

            if (!weight || weight <= 0) {
                alert('Silakan masukkan berat barang yang valid.');
                return;
            }

            // Show loading
            const resultsBody = document.getElementById('home_shipping_results_body');
            resultsBody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding: 20px; color: #666;"><i class="fas fa-spinner fa-spin"></i> Menghitung ongkos kirim...</td></tr>';
            document.getElementById('home_shipping_results').style.display = 'block';

            fetch('/shipping/calculate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'destination=' + encodeURIComponent(destination) + '&weight=' + weight
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    resultsBody.innerHTML = '';
                    const formatter = new Intl.NumberFormat('id-ID');
                    
                    let count = 0;
                    for (const key in data.rates) {
                        if (courier !== 'all' && key !== courier) continue;
                        
                        const cr = data.rates[key];
                        for (const srvKey in cr.services) {
                            const srv = cr.services[srvKey];
                            const row = document.createElement('tr');
                            row.style.borderBottom = '1px solid #eaeaea';
                            row.innerHTML = `
                                <td style="padding: 15px; display: flex; align-items: center; gap: 8px;">
                                    <img src="${cr.logo}" alt="${cr.name}" style="max-height: 20px; max-width: 60px; object-fit: contain;">
                                    <span style="font-weight: 500;">${cr.name}</span>
                                </td>
                                <td style="padding: 15px; color: #333; font-style: italic; font-weight: 600;">${srv.name}</td>
                                <td style="padding: 15px; font-weight: 600; color: #000;">Rp ${formatter.format(srv.cost)}</td>
                                <td style="padding: 15px; color: #666;">${srv.etd}</td>
                            `;
                            resultsBody.appendChild(row);
                            count++;
                        }
                    }

                    if (count === 0) {
                        resultsBody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding: 20px; color: #999;">Tidak ada layanan pengiriman yang cocok.</td></tr>';
                    }
                } else {
                    resultsBody.innerHTML = `<tr><td colspan="4" style="text-align:center; padding: 20px; color: #e74c3c;">Error: ${data.message}</td></tr>`;
                }
            })
            .catch(err => {
                console.error(err);
                resultsBody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding: 20px; color: #e74c3c;">Gagal menghubungi server. Silakan coba lagi.</td></tr>';
            });
        }

        function resetShippingForm() {
            document.getElementById('home_city').value = '';
            document.getElementById('home_city_selected_text').innerText = 'Pilih Kota/Kabupaten';
            document.getElementById('home_city_selected_text').style.color = '#999';
            document.getElementById('home_courier').value = 'all';
            document.getElementById('home_weight').value = '1000';
            document.getElementById('home_shipping_results').style.display = 'none';
            document.getElementById('home_shipping_results_body').innerHTML = '';
        }
    </script>
</body>
</html>
