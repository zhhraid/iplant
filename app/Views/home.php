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
    <style>
        .shipping-section {
            padding: 60px 0;
            background: #ffffff;
            border-top: 1px solid #f1f5f9;
        }
        .shipping-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.5px;
        }
        .shipping-origin-note {
            max-width: 640px;
            margin: 0 auto 42px;
            text-align: center;
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        .shipping-grid-container {
            display: grid;
            grid-template-columns: 1fr 1.3fr;
            gap: 50px;
            max-width: 1050px;
            margin: 0 auto;
            align-items: start;
        }
        @media (max-width: 768px) {
            .shipping-grid-container {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }
        .shipping-form-col {
            background: #ffffff;
        }
        .shipping-results-col {
            background: #ffffff;
            min-height: 200px;
        }
        .shipping-form-group {
            margin-bottom: 20px;
        }
        .shipping-form-group label {
            display: block;
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .shipping-select, .shipping-input {
            width: 100%;
            height: 44px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 0 12px;
            font-size: 0.95rem;
            font-family: inherit;
            color: #1e293b;
            outline: none;
            background-color: #ffffff;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .shipping-select:focus, .shipping-input:focus {
            border-color: #2196f3;
            box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.15);
        }
        .shipping-select:disabled {
            background-color: #f8fafc;
            cursor: not-allowed;
            color: #94a3b8;
            border-color: #e2e8f0;
        }
        .shipping-btn-group {
            display: flex;
            gap: 12px;
            margin-top: 25px;
        }
        .btn-cek-ongkir {
            flex: 1;
            height: 44px;
            background-color: #2196f3;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .btn-cek-ongkir:hover {
            background-color: #1976d2;
        }
        .btn-batal-ongkir {
            flex: 1;
            height: 44px;
            background-color: #ffffff;
            color: #2196f3;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
        }
        .btn-batal-ongkir:hover {
            background-color: #f0f7ff;
            border-color: #2196f3;
        }
        .results-header-text {
            text-align: center;
            font-style: italic;
            font-size: 1rem;
            color: #475569;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .shipping-results-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }
        .shipping-results-table th {
            text-align: left;
            padding: 12px;
            border-bottom: 2px solid #e2e8f0;
            color: #475569;
            font-weight: 600;
        }
        .shipping-results-table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
            vertical-align: middle;
        }
        .shipping-results-table tr:last-child td {
            border-bottom: none;
        }
    </style>
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
                        ?>
                        <div class="product-title-top"><?= esc($titleTop) ?><br><?= esc($titleBottom) ?></div>
                        <div class="product-top-right">
                            <img src="/images/logo.png" alt="iplant.id" class="small-logo" onerror="this.style.display='none'">
                        </div>
                    </div>
                    
                    <div class="product-main-image-container">
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
            <p class="shipping-origin-note">Pengiriman dari Jawa Tengah. Estimasi menyesuaikan provinsi, kota/kabupaten, kecamatan tujuan, dan berat paket.</p>
            
            <div class="shipping-grid-container">
                <!-- Left Column: Form -->
                <div class="shipping-form-col">
                    <div class="shipping-form-group">
                        <label for="home_province">Provinsi</label>
                        <select id="home_province" class="shipping-select" onchange="onProvinceChange()">
                            <option value="">Pilih Provinsi</option>
                        </select>
                    </div>

                    <div class="shipping-form-group">
                        <label for="home_city_kab">Kota/Kabupaten</label>
                        <select id="home_city_kab" class="shipping-select" onchange="onCityChange()" disabled>
                            <option value="">Pilih Kota/Kabupaten</option>
                        </select>
                    </div>

                    <div class="shipping-form-group">
                        <label for="home_district">Kecamatan</label>
                        <select id="home_district" class="shipping-select" disabled>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                    </div>

                    <div class="shipping-form-group">
                        <label for="home_weight">Berat (kg)</label>
                        <input type="number" id="home_weight" class="shipping-input" value="1" min="0.1" step="0.1" required>
                    </div>

                    <div class="shipping-btn-group">
                        <button type="button" class="btn-cek-ongkir" onclick="checkShippingRates()">Cek Ongkir</button>
                        <button type="button" class="btn-batal-ongkir" onclick="resetShippingForm()">Batal</button>
                    </div>
                </div>

                <!-- Right Column: Results -->
                <div class="shipping-results-col" id="home_shipping_results_wrapper">
                    <!-- Displayed dynamically, initially showing placeholder or empty state -->
                    <div id="results_placeholder" style="text-align: center; padding: 50px 20px; color: #94a3b8; border: 1px dashed #cbd5e1; border-radius: 8px;">
                        <i class="fas fa-truck" style="font-size: 3rem; margin-bottom: 15px; color: #cbd5e1;"></i>
                        <p style="margin: 0; font-size: 0.95rem;">Masukkan tujuan dan berat barang, lalu klik "Cek Ongkir" untuk melihat daftar tarif dan estimasi dari Jawa Tengah.</p>
                    </div>
                    
                    <div id="home_shipping_results" style="display: none;">
                        <div class="results-header-text" id="results_header_location">Jakarta Pusat (1 kg)</div>
                        <table class="shipping-results-table">
                            <thead>
                                <tr>
                                    <th>Kurir</th>
                                    <th>Layanan</th>
                                    <th style="text-align: right; padding-right: 25px;">Harga</th>
                                    <th>Estimasi</th>
                                </tr>
                            </thead>
                            <tbody id="home_shipping_results_body">
                                <!-- Dynamic rows -->
                            </tbody>
                        </table>
                    </div>
                </div>
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

        // --- Cek Ongkir Feature with Dependent Dropdowns ---
        document.addEventListener('DOMContentLoaded', () => {
            // Load provinces on page load
            loadProvinces();
        });

        function loadProvinces() {
            const provSelect = document.getElementById('home_province');
            provSelect.innerHTML = '<option value="">Memuat Provinsi...</option>';
            
            fetch('/shipping/regions/provinces')
                .then(res => res.json())
                .then(data => {
                    provSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                    data.forEach(prov => {
                        const opt = document.createElement('option');
                        opt.value = prov.id;
                        opt.textContent = prov.name;
                        provSelect.appendChild(opt);
                    });
                })
                .catch(err => {
                    console.error(err);
                    provSelect.innerHTML = '<option value="">Gagal memuat Provinsi</option>';
                });
        }

        function onProvinceChange() {
            const provId = document.getElementById('home_province').value;
            const citySelect = document.getElementById('home_city_kab');
            const distSelect = document.getElementById('home_district');
            
            // Reset and disable subsequent dropdowns
            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            citySelect.disabled = true;
            distSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            distSelect.disabled = true;
            
            if (!provId) return;

            citySelect.innerHTML = '<option value="">Memuat...</option>';
            citySelect.disabled = false;

            fetch(`/shipping/regions/regencies?province_id=${provId}`)
                .then(res => res.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                    data.forEach(city => {
                        const opt = document.createElement('option');
                        opt.value = city.id;
                        opt.textContent = city.name;
                        citySelect.appendChild(opt);
                    });
                })
                .catch(err => {
                    console.error(err);
                    citySelect.innerHTML = '<option value="">Gagal memuat</option>';
                });
        }

        function onCityChange() {
            const regencyId = document.getElementById('home_city_kab').value;
            const distSelect = document.getElementById('home_district');
            
            // Reset and disable district select
            distSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            distSelect.disabled = true;
            
            if (!regencyId) return;

            distSelect.innerHTML = '<option value="">Memuat...</option>';
            distSelect.disabled = false;

            fetch(`/shipping/regions/districts?regency_id=${regencyId}`)
                .then(res => res.json())
                .then(data => {
                    distSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    data.forEach(dist => {
                        const opt = document.createElement('option');
                        opt.value = dist.id;
                        opt.textContent = dist.name;
                        distSelect.appendChild(opt);
                    });
                })
                .catch(err => {
                    console.error(err);
                    distSelect.innerHTML = '<option value="">Gagal memuat</option>';
                });
        }

        function checkShippingRates() {
            const provSelect = document.getElementById('home_province');
            const citySelect = document.getElementById('home_city_kab');
            const distSelect = document.getElementById('home_district');
            const weightInput = document.getElementById('home_weight');

            const provText = provSelect.options[provSelect.selectedIndex]?.text;
            const cityText = citySelect.options[citySelect.selectedIndex]?.text;
            const distText = distSelect.options[distSelect.selectedIndex]?.text;
            const weightKg = parseFloat(weightInput.value);

            if (!provSelect.value || !citySelect.value || !distSelect.value) {
                alert('Silakan pilih Provinsi, Kota/Kabupaten, dan Kecamatan tujuan terlebih dahulu.');
                return;
            }

            if (isNaN(weightKg) || weightKg <= 0) {
                alert('Silakan masukkan berat barang yang valid.');
                return;
            }

            // Concatenate destination for backend format: "Province, City, District"
            const destination = `${provText}, ${cityText}, ${distText}`;
            // Convert kg to grams for backend calculation
            const weightGrams = Math.round(weightKg * 1000);

            // Hide placeholder and show loading inside table
            document.getElementById('results_placeholder').style.display = 'none';
            document.getElementById('home_shipping_results').style.display = 'block';
            
            // Set header text (e.g. "Jakarta Pusat (1 kg)")
            document.getElementById('results_header_location').textContent = `Jawa Tengah ke ${cityText} (${weightKg} kg)`;

            const resultsBody = document.getElementById('home_shipping_results_body');
            resultsBody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding: 20px; color: #64748b;"><i class="fas fa-spinner fa-spin"></i> Menghitung ongkos kirim...</td></tr>';

            fetch('/shipping/calculate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: `destination=${encodeURIComponent(destination)}&weight=${weightGrams}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    resultsBody.innerHTML = '';
                    const formatter = new Intl.NumberFormat('id-ID');
                    
                    let count = 0;
                    for (const key in data.rates) {
                        const cr = data.rates[key];
                        for (const srvKey in cr.services) {
                            const srv = cr.services[srvKey];
                            const row = document.createElement('tr');
                            row.style.borderBottom = '1px solid #e2e8f0';
                            
                            row.innerHTML = `
                                <td style="padding: 12px; font-weight: 600; color: #0f172a;">${cr.name}</td>
                                <td style="padding: 12px; color: #334155;">${srv.name}</td>
                                <td style="padding: 12px; font-weight: 500; color: #0f172a; text-align: right; padding-right: 25px;">Rp ${formatter.format(srv.cost)}</td>
                                <td style="padding: 12px; color: #475569;">${srv.etd}</td>
                            `;
                            resultsBody.appendChild(row);
                            count++;
                        }
                    }

                    if (count === 0) {
                        resultsBody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding: 20px; color: #94a3b8;">Tidak ada layanan pengiriman yang tersedia.</td></tr>';
                    }
                } else {
                    resultsBody.innerHTML = `<tr><td colspan="4" style="text-align:center; padding: 20px; color: #ef4444;">Error: ${data.message}</td></tr>`;
                }
            })
            .catch(err => {
                console.error(err);
                resultsBody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding: 20px; color: #ef4444;">Gagal menghubungi server. Silakan coba lagi.</td></tr>';
            });
        }

        function resetShippingForm() {
            document.getElementById('home_province').value = '';
            
            const citySelect = document.getElementById('home_city_kab');
            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            citySelect.disabled = true;
            
            const distSelect = document.getElementById('home_district');
            distSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            distSelect.disabled = true;
            
            document.getElementById('home_weight').value = '1';
            
            document.getElementById('home_shipping_results').style.display = 'none';
            document.getElementById('results_placeholder').style.display = 'block';
            document.getElementById('home_shipping_results_body').innerHTML = '';
        }
    </script>
</body>
</html>
