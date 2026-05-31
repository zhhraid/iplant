<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password - iplant.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            background: #fff;
        }
        .password-main {
            min-height: 455px;
            padding: 100px 15px 72px;
        }
        .password-box {
            width: 100%;
            max-width: 416px;
            margin: 0 auto;
        }
        .password-title {
            font-size: 1.55rem;
            font-weight: 500;
            color: #1f2933;
            margin: 0 0 14px;
        }
        .password-field {
            margin-bottom: 8px;
        }
        .password-field label {
            display: block;
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }
        .password-field input {
            width: 100%;
            height: 36px;
            border: 1px solid #d8d8d8;
            border-radius: 4px;
            padding: 6px 9px;
            font-size: 0.95rem;
            box-sizing: border-box;
            outline: none;
        }
        .password-submit {
            width: 100%;
            height: 42px;
            margin-top: 8px;
            border: 0;
            border-radius: 4px;
            background: #2698ed;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
        }
        .auth-email-pill {
            background: #eaf2ff;
            color: #000;
            padding: 9px 12px;
            border-radius: 5px;
            line-height: 1;
            white-space: nowrap;
        }
        .form-message {
            margin-bottom: 10px;
            font-size: 0.9rem;
        }
        .form-message.error {
            color: #e74c3c;
        }
        .form-message.success {
            color: #2e9f45;
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
                    <li><a href="/cart" class="cart-link">Keranjang</a></li>
                    <li><a href="/account">Akun Saya</a></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <div class="auth-email-pill"><?= esc($user['email']) ?></div>
            </div>
        </div>
    </header>

    <main class="password-main">
        <div class="password-box">
            <h1 class="password-title">Ubah Password</h1>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="form-message error"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="form-message success"><?= esc(session()->getFlashdata('success')) ?></div>
            <?php endif; ?>

            <form action="/change-password" method="POST">
                <div class="password-field">
                    <label for="current_password">Password Sekarang</label>
                    <input type="password" id="current_password" name="current_password" placeholder="******" required autofocus>
                </div>
                <div class="password-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="******" required>
                </div>
                <div class="password-field">
                    <label for="password_confirm">Konfirmasi Password</label>
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="******" required>
                </div>
                <button type="submit" class="password-submit">Ubah Password</button>
            </form>
        </div>
    </main>

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
</body>
</html>
