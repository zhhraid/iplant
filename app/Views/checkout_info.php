<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pengiriman - iplant.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="checkout-page-container">
        <!-- Left Side: Form Content -->
        <div class="checkout-left-side">
            <div class="checkout-left-content">
                <div class="checkout-logo-new">
                    <a href="/">iPlant</a>
                </div>
                
                <div class="checkout-breadcrumb-new">
                    <span class="active">Informasi Pembeli</span> &gt; 
                    <span>Metode Pengiriman</span> &gt; 
                    <span>Metode Pembayaran</span>
                </div>
                
                <form action="/checkout/shipping" method="POST" id="checkoutInfoForm">
                    <div class="form-group-new">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="john@connor.com" required>
                    </div>
                    
                    <div class="checkbox-group-new">
                        <input type="checkbox" name="newsletter" id="newsletter">
                        <label for="newsletter">Berlangganan ke newsletter</label>
                    </div>
                    
                    <h3 class="checkout-section-title">Alamat Pengiriman</h3>
                    
                    <div class="form-group-new">
                        <label for="name">Nama</label>
                        <input type="text" id="name" name="name" placeholder="John" required>
                    </div>
                    
                    <!-- Searchable Custom Dropdown for Kota/Kabupaten -->
                    <div class="form-group-new" style="position: relative;">
                        <label for="city_trigger">Kota/Kabupaten</label>
                        <input type="hidden" id="city" name="city" required>
                        <div id="city_trigger" class="custom-select-trigger" onclick="toggleCityDropdown(event)">
                            <span id="city_selected_text" style="color: #999;">Pilih Kota/Kabupaten</span>
                            <i class="fas fa-chevron-down" style="font-size: 0.8rem; color: #999;"></i>
                        </div>
                        
                        <div id="city_dropdown" class="custom-select-dropdown" style="display: none;">
                            <div class="dropdown-arrow"></div>
                            <div class="dropdown-search-wrapper">
                                <input type="text" id="city_search_input" placeholder="Cari..." autocomplete="off" oninput="filterCities(this.value)" onclick="event.stopPropagation()">
                                <button type="button" class="dropdown-search-btn" onclick="event.stopPropagation()">
                                    <i class="fas fa-search" style="color: #aaa;"></i>
                                </button>
                            </div>
                            <ul id="city_options_list" class="dropdown-options-list">
                                <li class="dropdown-message">Ketik 3 huruf</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="form-group-new">
                        <label for="address">Alamat</label>
                        <textarea id="address" name="address" placeholder="22 Jump Street" rows="3" style="resize: vertical;" required></textarea>
                    </div>
                    
                    <div class="form-row-new">
                        <div class="form-group-new">
                            <label for="zip">Kode Pos</label>
                            <input type="text" id="zip" name="zip" placeholder="12345" required>
                        </div>
                        <div class="form-group-new">
                            <label for="phone">Telepon</label>
                            <input type="text" id="phone" name="phone" placeholder="+628114003232" required>
                        </div>
                    </div>
                    
                    <div class="checkbox-group-new" style="margin-top: 15px;">
                        <input type="checkbox" name="is_dropshipper" id="is_dropshipper" onchange="toggleDropship(this)">
                        <label for="is_dropshipper">Kirim sebagai dropshipper</label>
                    </div>
                    
                    <div id="dropshipFields" style="display:none; margin-bottom: 20px;">
                        <div class="form-row-new">
                            <div class="form-group-new">
                                <label for="dropshipper_name">Nama Dropshipper</label>
                                <input type="text" id="dropshipper_name" name="dropshipper_name" placeholder="Raden Wijaya">
                            </div>
                            <div class="form-group-new">
                                <label for="dropshipper_phone">Telepon Dropshipper</label>
                                <input type="text" id="dropshipper_phone" name="dropshipper_phone" placeholder="+628114003232">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Aligned to the right, removed "< Kembali ke Keranjang" -->
                    <div style="display: flex; justify-content: flex-end; margin-top: 40px; padding-top: 10px;">
                        <button type="submit" class="btn-primary-new">Lanjutkan</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Right Side: Order Summary -->
        <div class="checkout-right-side">
            <div class="checkout-right-content">
                <div class="summary-items-new">
                    <?php 
                        $coupon = session()->get('coupon') ?? [];
                        $couponCode = $coupon['code'] ?? '';
                        $couponDiscount = (int) ($coupon['discount'] ?? 0);
                        $subtotal = 0;
                        foreach($cart as $item): 
                            $subtotal += $item['price'] * $item['quantity'];
                    ?>
                    <div class="summary-item-new" id="item-<?= $item['id'] ?>">
                        <div class="summary-item-left">
                            <img src="<?= esc($item['image_url']) ?>" alt="<?= esc($item['name']) ?>" onerror="this.src='https://placehold.co/50x50?text=iplant.id'">
                            <div class="summary-item-details">
                                <div class="summary-item-name-new"><?= esc($item['name']) ?></div>
                                <div class="summary-item-price-new"><?= number_format($item['price'], 0, ',', '.') ?></div>
                            </div>
                        </div>
                        <div class="qty-selector-new">
                            <button type="button" onclick="changeQty(<?= $item['id'] ?>, -1)" <?= $item['quantity'] <= 1 ? 'disabled' : '' ?>>-</button>
                            <input type="text" id="qty-<?= $item['id'] ?>" value="<?= $item['quantity'] ?>" readonly>
                            <button type="button" onclick="changeQty(<?= $item['id'] ?>, 1)">+</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="coupon-section-new">
                    <label class="coupon-label-new">Kode Kupon</label>
                    <div class="coupon-input-group-new">
                        <input type="text" id="coupon_code" name="coupon_code" placeholder="Kode" value="<?= esc($couponCode) ?>">
                        <button type="button" onclick="applyCoupon()">Cari</button>
                    </div>
                    <!-- Coupon Error Message -->
                    <div id="coupon-error" style="display: none; color: #333; font-size: 0.88rem; margin-top: 10px; text-align: left;">
                        <span id="coupon-error-msg"></span>
                    </div>
                </div>
                
                <div class="totals-section-new" style="border-bottom: 1px solid #e1e1e1; padding-bottom: 15px;">
                    <div class="totals-row-new">
                        <span>Subtotal</span>
                        <span id="subtotal-val">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                    </div>
                    <div class="totals-row-new" id="discount-row" style="<?= $couponDiscount > 0 ? '' : 'display: none;' ?> color: #e74c3c;">
                        <span>Potongan Kupon (<span id="applied-coupon-code"><?= esc($couponCode) ?></span>)</span>
                        <span>-Rp <span id="applied-coupon-discount"><?= number_format($couponDiscount, 0, ',', '.') ?></span></span>
                    </div>
                </div>
                
                <div class="totals-section-new">
                    <div class="totals-row-new total-grand-new" style="border-top: none; margin-top: 0; padding-top: 0;">
                        <span>Total</span>
                        <span id="grand-total-val">Rp <?= number_format($subtotal - $couponDiscount, 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Array Wilayah Indonesia untuk Pencarian
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

        // Searchable select functions
        function toggleCityDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('city_dropdown');
            const isHidden = dropdown.style.display === 'none';
            
            // Close all dropdowns
            dropdown.style.display = isHidden ? 'block' : 'none';
            
            if (isHidden) {
                const searchInput = document.getElementById('city_search_input');
                searchInput.value = '';
                searchInput.focus();
                filterCities('');
            }
        }

        function filterCities(query) {
            const trimmed = query.trim().toLowerCase();
            const list = document.getElementById('city_options_list');
            list.innerHTML = '';

            if (trimmed.length < 3) {
                const msgLi = document.createElement('li');
                msgLi.className = 'dropdown-message';
                msgLi.innerText = 'Ketik 3 huruf';
                list.appendChild(msgLi);
                return;
            }

            const matches = wilayahIndonesia.filter(item => item.toLowerCase().includes(trimmed));

            if (matches.length === 0) {
                const msgLi = document.createElement('li');
                msgLi.className = 'dropdown-message';
                msgLi.innerText = 'Tidak ditemukan';
                list.appendChild(msgLi);
                return;
            }

            matches.forEach(cityStr => {
                const li = document.createElement('li');
                li.innerText = cityStr;
                li.onclick = function(e) {
                    e.stopPropagation();
                    selectCity(cityStr);
                };
                list.appendChild(li);
            });
        }

        function selectCity(val) {
            document.getElementById('city').value = val;
            const textSpan = document.getElementById('city_selected_text');
            textSpan.innerText = val;
            textSpan.style.color = '#333';
            document.getElementById('city_dropdown').style.display = 'none';
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('city_dropdown');
            const trigger = document.getElementById('city_trigger');
            if (dropdown && trigger && !dropdown.contains(event.target) && !trigger.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });

        function toggleDropship(checkbox) {
            const fields = document.getElementById('dropshipFields');
            fields.style.display = checkbox.checked ? 'block' : 'none';
            const nameInput = document.getElementById('dropshipper_name');
            const phoneInput = document.getElementById('dropshipper_phone');
            if (checkbox.checked) {
                nameInput.setAttribute('required', 'required');
                phoneInput.setAttribute('required', 'required');
            } else {
                nameInput.removeAttribute('required');
                phoneInput.removeAttribute('required');
            }
        }
        
        function changeQty(productId, delta) {
            const input = document.getElementById('qty-' + productId);
            let qty = parseInt(input.value) + delta;
            if (qty < 1) {
                return;
            }

            updateCartItem(productId, qty);
        }
        
        function updateCartItem(productId, qty) {
            // Show loading state
            document.querySelector('.checkout-right-content').style.opacity = '0.5';
            
            fetch('/checkout/update-item', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'product_id=' + productId + '&quantity=' + qty
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload();
                } else {
                    document.querySelector('.checkout-right-content').style.opacity = '1';
                }
            })
            .catch(err => {
                console.error(err);
                document.querySelector('.checkout-right-content').style.opacity = '1';
            });
        }
        
        function applyCoupon() {
            const input = document.getElementById('coupon_code');
            const code = input.value.trim();
            const errorDiv = document.getElementById('coupon-error');
            const invalidCodeSpan = document.getElementById('invalid-coupon-code');
            const discountRow = document.getElementById('discount-row');
            const appliedCodeSpan = document.getElementById('applied-coupon-code');
            const appliedDiscountSpan = document.getElementById('applied-coupon-discount');
            const grandTotalSpan = document.getElementById('grand-total-val');
            
            if (code === '') {
                errorDiv.style.display = 'none';
                return;
            }
            
            // Show loading state
            document.querySelector('.checkout-right-content').style.opacity = '0.5';
            
            fetch('/checkout/apply-coupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'coupon_code=' + encodeURIComponent(code)
            })
            .then(res => res.json())
            .then(data => {
                document.querySelector('.checkout-right-content').style.opacity = '1';
                if (data.status === 'success') {
                    // Hide error
                    errorDiv.style.display = 'none';
                    // Show discount row
                    discountRow.style.display = 'flex';
                    appliedCodeSpan.innerText = data.code;
                    
                    const formatter = new Intl.NumberFormat('id-ID');
                    appliedDiscountSpan.innerText = formatter.format(data.discount);
                    
                    // Recalculate grand total
                    const subtotal = <?= $subtotal ?>;
                    const grandTotal = subtotal - data.discount;
                    grandTotalSpan.innerText = 'Rp ' + formatter.format(grandTotal);
                } else {
                    // Show error from backend
                    errorDiv.style.display = 'block';
                    document.getElementById('coupon-error-msg').innerHTML = data.message;
                    
                    // Hide discount row
                    discountRow.style.display = 'none';
                    
                    const formatter = new Intl.NumberFormat('id-ID');
                    const subtotal = <?= $subtotal ?>;
                    grandTotalSpan.innerText = 'Rp ' + formatter.format(subtotal);
                }
            })
            .catch(err => {
                console.error(err);
                document.querySelector('.checkout-right-content').style.opacity = '1';
            });
        }
    </script>
</body>
</html>
