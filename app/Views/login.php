<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - iplant.id</title>
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
    <main class="login-main">
        <div class="login-box">
            <h2 class="login-title">Login</h2>
            
            <form action="#" method="POST">
                <div class="form-group-login">
                    <label>Email</label>
                    <input type="email" placeholder="john@connor.com" required>
                </div>
                
                <div class="form-group-login">
                    <label>Password</label>
                    <input type="password" placeholder="******" required>
                </div>
                
                <div class="login-actions-row">
                    <button type="submit" class="btn-login-submit">Login</button>
                    <a href="/register" class="btn-register-link">Daftar Baru</a>
                </div>
                
                <a href="/forgot-password" class="forgot-password">Lupa password</a>
            </form>
        </div>
    </main>

    <!-- Black Footer -->
    <footer class="footer-black">
        <div class="container footer-black-container">
            <div class="footer-black-col">
                <h4>Links</h4>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="#">Blog</a></li>
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
