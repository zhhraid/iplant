<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran <?= esc($order['invoice_no']) ?> - iplant.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            background: #fff;
        }
        .payment-confirm-page {
            min-height: 650px;
            padding: 62px 15px 18px;
        }
        .payment-confirm-card {
            width: 100%;
            max-width: 410px;
            margin: 0 auto;
        }
        .payment-confirm-title {
            margin: 0 0 28px;
            text-align: left;
            font-size: 2.15rem;
            font-weight: 700;
            color: #1f2933;
        }
        .confirm-field {
            margin-bottom: 5px;
        }
        .confirm-field label {
            display: block;
            margin-bottom: 3px;
            color: #555;
            font-size: 0.82rem;
        }
        .confirm-input,
        .confirm-select {
            width: 100%;
            height: 34px;
            border: 1px solid #dcdcdc;
            border-radius: 4px;
            background: #fff;
            color: #1f2933;
            font-size: 1rem;
            padding: 6px 8px;
            outline: none;
        }
        .confirm-input[readonly] {
            background: #f4f4f4;
            color: #666;
        }
        .date-input-wrap {
            position: relative;
        }
        .date-input-wrap::after {
            content: "";
            position: absolute;
            right: 27px;
            top: 7px;
            width: 1px;
            height: 20px;
            background: #dcdcdc;
            pointer-events: none;
        }
        .confirm-date {
            padding-right: 36px;
        }
        .calendar-toggle {
            position: absolute;
            inset: 0;
            border: 0;
            background: transparent;
            cursor: pointer;
            text-align: right;
            padding-right: 9px;
            color: transparent;
        }
        .calendar-popover {
            position: absolute;
            left: 0;
            top: 38px;
            width: 365px;
            background: #fff;
            border: 1px solid #d7d7d7;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.18);
            z-index: 20;
            display: none;
        }
        .calendar-popover.active {
            display: block;
        }
        .calendar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 18px 10px;
            color: #555;
            font-size: 1.45rem;
        }
        .calendar-nav {
            border: 0;
            background: transparent;
            color: #bbb;
            font-size: 2.2rem;
            line-height: 1;
            cursor: pointer;
        }
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
            padding: 0 14px 12px;
            text-align: center;
            color: #666;
            font-size: 1.35rem;
        }
        .calendar-weekday {
            color: #bbb;
            font-size: 1.25rem;
        }
        .calendar-weekday.sunday,
        .calendar-day.sunday {
            color: #ff3333;
        }
        .calendar-day {
            border: 0;
            background: transparent;
            height: 46px;
            border-radius: 50%;
            color: #666;
            font: inherit;
            cursor: pointer;
        }
        .calendar-day.empty {
            color: #e1e1e1;
            cursor: default;
        }
        .calendar-day.selected {
            background: #2698ed;
            color: #fff;
        }
        .amount-input-wrap {
            display: grid;
            grid-template-columns: 48px 1fr;
            height: 34px;
            border: 1px solid #dcdcdc;
            border-radius: 4px;
            overflow: hidden;
            background: #fff;
        }
        .amount-prefix {
            display: flex;
            align-items: center;
            padding-left: 9px;
            color: #1f2933;
            font-size: 0.95rem;
        }
        .amount-input {
            border: 0;
            outline: none;
            padding: 6px 9px;
            text-align: right;
            font-size: 1rem;
            color: #000;
        }
        .upload-row {
            margin: 12px 0 30px;
        }
        .upload-label {
            display: block;
            margin-bottom: 4px;
            color: #555;
            font-size: 0.82rem;
        }
        .upload-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 173px;
            height: 36px;
            border: 1px solid #8fc6ff;
            border-radius: 4px;
            color: #1689ff;
            background: #fff;
            cursor: pointer;
            font-size: 1rem;
        }
        .upload-preview-box {
            display: none;
            width: 100%;
            height: 190px;
            margin-top: 6px;
            margin-bottom: 7px;
            border: 1px solid #e3e3e3;
            background: #f7f7f7;
            overflow: hidden;
        }
        .upload-preview-box.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .upload-preview-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .upload-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 7px;
        }
        .remove-upload-button {
            display: none;
            align-items: center;
            justify-content: center;
            height: 36px;
            border: 1px solid #ffb4b4;
            border-radius: 4px;
            color: #ff6666;
            background: #fff;
            cursor: pointer;
            font-size: 1rem;
        }
        .remove-upload-button.active {
            display: inline-flex;
        }
        .confirm-submit {
            width: 100%;
            height: 37px;
            border: 0;
            border-radius: 4px;
            background: #2698ed;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
        }
        .confirm-bank-row {
            max-width: 1120px;
            margin: 30px auto 0;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 60px;
            align-items: center;
        }
        .confirm-bank-item {
            display: flex;
            align-items: center;
            gap: 20px;
            color: #1f2933;
            line-height: 1.35;
        }
        .confirm-bank-item img {
            width: 115px;
            max-height: 44px;
            object-fit: contain;
        }
        .confirm-bank-text strong {
            display: block;
            font-weight: 700;
            margin-bottom: 2px;
        }
        .confirm-bank-text span {
            display: block;
            font-size: 0.95rem;
        }
        @media (max-width: 900px) {
            .confirm-bank-row {
                grid-template-columns: 1fr;
                gap: 18px;
                max-width: 410px;
            }
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
        $paymentDate = date('d/m/Y');
        $amount = number_format((int) $order['total_amount'], 0, ',', '.');
    ?>

    <main class="payment-confirm-page">
        <section class="payment-confirm-card">
            <h1 class="payment-confirm-title">Konfirmasi Pembayaran</h1>

            <form action="/invoice/<?= $order['id'] ?>/confirm-payment" method="POST" enctype="multipart/form-data">
                <div class="confirm-field">
                    <label for="invoice_no">Nomor Invoice</label>
                    <input class="confirm-input" type="text" id="invoice_no" name="invoice_no" value="<?= esc($order['invoice_no']) ?>" readonly>
                </div>

                <div class="confirm-field">
                    <label for="payment_date">Waktu Pembayaran</label>
                    <div class="date-input-wrap">
                        <input class="confirm-input confirm-date" type="text" id="payment_date" name="payment_date" value="<?= esc($paymentDate) ?>" autocomplete="off">
                        <button type="button" class="calendar-toggle" id="calendarToggle" aria-label="Buka kalender">Kalender</button>
                        <div class="calendar-popover" id="calendarPopover">
                            <div class="calendar-header">
                                <button type="button" class="calendar-nav" id="prevMonth" aria-label="Bulan sebelumnya">&lsaquo;</button>
                                <span id="calendarTitle"></span>
                                <button type="button" class="calendar-nav" id="nextMonth" aria-label="Bulan berikutnya">&rsaquo;</button>
                            </div>
                            <div class="calendar-grid" id="calendarGrid"></div>
                        </div>
                    </div>
                </div>

                <div class="confirm-field">
                    <label for="transfer_to">Ditransfer Ke</label>
                    <select class="confirm-select" id="transfer_to" name="transfer_to">
                        <option value="BCA - 0190725880 - ALFIANSYAH ANWAR">BCA - 0190725880 - ALFIANSYAH ANWAR</option>
                        <option value="BNI - 1231021328 - ALFIANSYAH ANWAR">BNI - 1231021328 - ALFIANSYAH ANWAR</option>
                        <option value="MANDIRI - 144002484913 - ALFIANSYAH ANWAR">MANDIRI - 144002484913 - ALFIANSYAH ANWAR</option>
                    </select>
                </div>

                <div class="confirm-field">
                    <label for="source_bank">Bank Asal</label>
                    <input class="confirm-input" type="text" id="source_bank" name="source_bank" placeholder="BCA">
                </div>

                <div class="confirm-field">
                    <label for="account_name">Nama Pemilik Rekening</label>
                    <input class="confirm-input" type="text" id="account_name" name="account_name" placeholder="Raden Wijaya">
                </div>

                <div class="confirm-field">
                    <label for="amount">Jumlah</label>
                    <div class="amount-input-wrap">
                        <span class="amount-prefix">Rp</span>
                        <input class="amount-input" type="text" id="amount" name="amount" value="<?= esc($amount) ?>">
                    </div>
                </div>

                <div class="upload-row">
                    <span class="upload-label">Bukti Transfer (Opsional)</span>
                    <div class="upload-preview-box" id="uploadPreviewBox">
                        <img src="" alt="Preview bukti transfer" id="uploadPreviewImage">
                    </div>
                    <div class="upload-actions">
                        <label class="upload-button" for="transfer_proof">Upload Gambar</label>
                        <button type="button" class="remove-upload-button" id="removeUploadButton">Hapus Gambar</button>
                    </div>
                    <input type="file" id="transfer_proof" name="transfer_proof" accept="image/*" style="display: none;">
                </div>

                <button class="confirm-submit" type="submit">Konfirmasi</button>
            </form>
        </section>

        <section class="confirm-bank-row">
            <div class="confirm-bank-item">
                <img src="/images/payments/bca.png" alt="BCA">
                <div class="confirm-bank-text">
                    <strong>BCA</strong>
                    <span>0190725880</span>
                    <span>ALFIANSYAH ANWAR</span>
                </div>
            </div>
            <div class="confirm-bank-item">
                <img src="/images/payments/bni.png" alt="BNI">
                <div class="confirm-bank-text">
                    <strong>BNI</strong>
                    <span>1231021328</span>
                    <span>ALFIANSYAH ANWAR</span>
                </div>
            </div>
            <div class="confirm-bank-item">
                <img src="/images/payments/mandiri.png" alt="MANDIRI">
                <div class="confirm-bank-text">
                    <strong>MANDIRI</strong>
                    <span>144002484913</span>
                    <span>ALFIANSYAH ANWAR</span>
                </div>
            </div>
        </section>
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
                    <a href="#"><i class="fab fa-facebook"></i></a>
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
        const transferProofInput = document.getElementById('transfer_proof');
        const previewBox = document.getElementById('uploadPreviewBox');
        const previewImage = document.getElementById('uploadPreviewImage');
        const removeUploadButton = document.getElementById('removeUploadButton');
        const paymentDateInput = document.getElementById('payment_date');
        const calendarToggle = document.getElementById('calendarToggle');
        const calendarPopover = document.getElementById('calendarPopover');
        const calendarTitle = document.getElementById('calendarTitle');
        const calendarGrid = document.getElementById('calendarGrid');
        const prevMonth = document.getElementById('prevMonth');
        const nextMonth = document.getElementById('nextMonth');
        const monthNames = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        const weekdayNames = ['S', 'R', 'K', 'J', 'S', 'M', 'S'];
        let visibleDate = parseDisplayDate(paymentDateInput.value);

        transferProofInput.addEventListener('change', () => {
            const file = transferProofInput.files[0];

            if (!file) {
                clearUploadPreview();
                return;
            }

            previewImage.src = URL.createObjectURL(file);
            previewBox.classList.add('active');
            removeUploadButton.classList.add('active');
        });

        removeUploadButton.addEventListener('click', () => {
            transferProofInput.value = '';
            clearUploadPreview();
        });

        function clearUploadPreview() {
            if (previewImage.src) {
                URL.revokeObjectURL(previewImage.src);
            }

            previewImage.src = '';
            previewBox.classList.remove('active');
            removeUploadButton.classList.remove('active');
        }

        calendarToggle.addEventListener('click', (event) => {
            event.stopPropagation();
            visibleDate = parseDisplayDate(paymentDateInput.value);
            renderCalendar();
            calendarPopover.classList.toggle('active');
        });

        paymentDateInput.addEventListener('focus', () => {
            visibleDate = parseDisplayDate(paymentDateInput.value);
            renderCalendar();
            calendarPopover.classList.add('active');
        });

        prevMonth.addEventListener('click', (event) => {
            event.stopPropagation();
            visibleDate.setMonth(visibleDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonth.addEventListener('click', (event) => {
            event.stopPropagation();
            visibleDate.setMonth(visibleDate.getMonth() + 1);
            renderCalendar();
        });

        document.addEventListener('click', (event) => {
            if (!calendarPopover.contains(event.target) && event.target !== paymentDateInput && event.target !== calendarToggle) {
                calendarPopover.classList.remove('active');
            }
        });

        function parseDisplayDate(value) {
            const match = /^(\d{2})\/(\d{2})\/(\d{4})$/.exec(value);

            if (match) {
                return new Date(Number(match[3]), Number(match[2]) - 1, Number(match[1]));
            }

            return new Date();
        }

        function formatDisplayDate(date) {
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();

            return `${day}/${month}/${year}`;
        }

        function renderCalendar() {
            const selectedDate = parseDisplayDate(paymentDateInput.value);
            const year = visibleDate.getFullYear();
            const month = visibleDate.getMonth();
            const firstDay = new Date(year, month, 1);
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const startOffset = firstDay.getDay();

            calendarTitle.textContent = `${monthNames[month]} ${year}`;
            calendarGrid.innerHTML = '';

            weekdayNames.forEach((name, index) => {
                const weekday = document.createElement('div');
                weekday.className = `calendar-weekday ${index === 0 ? 'sunday' : ''}`;
                weekday.textContent = name;
                calendarGrid.appendChild(weekday);
            });

            for (let i = 0; i < startOffset; i++) {
                const empty = document.createElement('button');
                empty.type = 'button';
                empty.className = 'calendar-day empty';
                empty.textContent = '.';
                empty.disabled = true;
                calendarGrid.appendChild(empty);
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const date = new Date(year, month, day);
                const dayButton = document.createElement('button');
                dayButton.type = 'button';
                dayButton.className = `calendar-day ${date.getDay() === 0 ? 'sunday' : ''}`;
                dayButton.textContent = day;

                if (
                    selectedDate.getFullYear() === year
                    && selectedDate.getMonth() === month
                    && selectedDate.getDate() === day
                ) {
                    dayButton.classList.add('selected');
                }

                dayButton.addEventListener('click', (event) => {
                    event.stopPropagation();
                    paymentDateInput.value = formatDisplayDate(date);
                    calendarPopover.classList.remove('active');
                });

                calendarGrid.appendChild(dayButton);
            }
        }

        renderCalendar();
    </script>
</body>
</html>
