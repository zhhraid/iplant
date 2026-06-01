<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis Ulasan untuk Invoice <?= esc($order['invoice_no']) ?> - iplant.id</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .review-page {
            max-width: 720px;
            margin: 50px auto;
            padding: 0 20px;
            box-sizing: border-box;
        }
        .invoice-title-wrapper {
            margin-bottom: 25px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .invoice-title {
            font-size: 1.6rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        .btn-back-invoice {
            font-size: 0.9rem;
            color: #64748b;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }
        .btn-back-invoice:hover {
            color: #1e293b;
        }
        .review-item-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }
        .product-info-row {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 20px;
        }
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #eee;
        }
        .product-name-link {
            color: #0088ff;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.05rem;
            transition: color 0.2s;
        }
        .product-name-link:hover {
            color: #0077ee;
            text-decoration: underline;
        }
        .rating-stars-wrapper {
            margin-bottom: 15px;
        }
        .stars {
            display: flex;
            gap: 8px;
        }
        .star-btn {
            font-size: 2rem;
            color: #ccc;
            cursor: pointer;
            transition: color 0.15s, transform 0.1s;
        }
        .star-btn:hover {
            transform: scale(1.1);
        }
        .review-textarea {
            width: 100%;
            height: 120px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 12px;
            font-family: inherit;
            font-size: 0.95rem;
            outline: none;
            resize: none;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }
        .review-textarea:focus {
            border-color: #3b82f6;
        }
        .photo-upload-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            cursor: pointer;
            color: #64748b;
            transition: border-color 0.2s, background-color 0.2s, color 0.2s;
            box-sizing: border-box;
        }
        .photo-upload-card:hover {
            border-color: #0088ff;
            background-color: #f0f8ff;
            color: #0088ff;
        }
        .photo-preview-card {
            position: relative;
            width: 100px;
            height: 100px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            box-sizing: border-box;
        }
        .preview-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .btn-remove-photo {
            position: absolute;
            top: 4px;
            right: 4px;
            background: rgba(0,0,0,0.5);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 0.75rem;
            transition: background 0.2s;
        }
        .btn-remove-photo:hover {
            background: rgba(0,0,0,0.7);
        }
        .actions-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
            margin-bottom: 50px;
        }
        .btn-submit-review {
            background-color: #0088ff;
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background-color 0.2s;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }
        .btn-submit-review:hover {
            background-color: #0077ee;
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

    <main class="review-page">
        <div class="invoice-title-wrapper">
            <h1 class="invoice-title">Invoice <?= esc($order['invoice_no']) ?></h1>
            <a href="/invoice/<?= $order['id'] ?>" class="btn-back-invoice">
                <i class="fas fa-arrow-left"></i> Kembali ke Invoice
            </a>
        </div>

        <form action="/invoice/<?= $order['id'] ?>/review/submit" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <?php foreach($items as $item): ?>
                <div class="review-item-card">
                    <!-- Product Info row -->
                    <div class="product-info-row">
                        <img class="product-img" src="<?= esc($item['image_url']) ?>" alt="<?= esc($item['product_name']) ?>" onerror="this.src='https://placehold.co/60x60?text=iplant.id'">
                        <a href="/product-detail/<?= $item['product_id'] ?>" class="product-name-link" target="_blank">
                            <?= esc($item['product_name']) ?>
                        </a>
                    </div>

                    <!-- Interactive Star Rating selection -->
                    <div class="rating-stars-wrapper">
                        <div class="stars" data-product-id="<?= $item['product_id'] ?>">
                            <i class="far fa-star star-btn" data-value="1"></i>
                            <i class="far fa-star star-btn" data-value="2"></i>
                            <i class="far fa-star star-btn" data-value="3"></i>
                            <i class="far fa-star star-btn" data-value="4"></i>
                            <i class="far fa-star star-btn" data-value="5"></i>
                        </div>
                        <input type="hidden" name="ratings[<?= $item['product_id'] ?>]" id="rating-input-<?= $item['product_id'] ?>" value="5">
                    </div>

                    <!-- Textarea input -->
                    <div style="margin-bottom: 20px;">
                        <textarea class="review-textarea" name="reviews[<?= $item['product_id'] ?>]" placeholder="Tuliskan sesuatu di sini" required></textarea>
                    </div>

                    <!-- Photo Upload area -->
                    <div class="photo-upload-section">
                        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                            <label for="photo-file-<?= $item['product_id'] ?>" class="photo-upload-card" id="upload-card-<?= $item['product_id'] ?>">
                                <i class="fas fa-camera" style="font-size: 1.4rem; margin-bottom: 6px;"></i>
                                <span style="font-size: 0.75rem; font-weight: 600;">+ Foto Baru</span>
                            </label>
                            <input type="file" name="photos[<?= $item['product_id'] ?>]" id="photo-file-<?= $item['product_id'] ?>" accept="image/*" style="display: none;" onchange="handlePhotoSelect(this, <?= $item['product_id'] ?>)">

                            <div id="preview-container-<?= $item['product_id'] ?>" class="photo-preview-card" style="display: none;">
                                <img id="preview-img-<?= $item['product_id'] ?>" class="preview-img" src="">
                                <button type="button" class="btn-remove-photo" onclick="removePhoto(<?= $item['product_id'] ?>)" aria-label="Hapus foto">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="actions-row">
                <button type="submit" class="btn-submit-review">Kirim Review</button>
            </div>
        </form>
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
        document.addEventListener('DOMContentLoaded', () => {
            const starContainers = document.querySelectorAll('.stars');
            starContainers.forEach(container => {
                const productId = container.dataset.productId;
                const stars = container.querySelectorAll('.star-btn');
                const input = document.getElementById(`rating-input-${productId}`);
                
                // Set default/initial rating to 5 stars
                updateStars(stars, 5);
                
                stars.forEach(star => {
                    star.addEventListener('click', () => {
                        const val = parseInt(star.dataset.value);
                        input.value = val;
                        updateStars(stars, val);
                    });
                    
                    star.addEventListener('mouseover', () => {
                        const val = parseInt(star.dataset.value);
                        highlightStars(stars, val);
                    });
                    
                    star.addEventListener('mouseout', () => {
                        const val = parseInt(input.value);
                        updateStars(stars, val);
                    });
                });
            });
        });

        function updateStars(stars, rating) {
            stars.forEach(star => {
                const val = parseInt(star.dataset.value);
                if (val <= rating) {
                    star.className = 'fas fa-star star-btn';
                    star.style.color = '#f39c12';
                } else {
                    star.className = 'far fa-star star-btn';
                    star.style.color = '#ccc';
                }
            });
        }

        function highlightStars(stars, rating) {
            stars.forEach(star => {
                const val = parseInt(star.dataset.value);
                if (val <= rating) {
                    star.style.color = '#f39c12';
                } else {
                    star.style.color = '#ccc';
                }
            });
        }

        function handlePhotoSelect(input, productId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewContainer = document.getElementById(`preview-container-${productId}`);
                    const previewImg = document.getElementById(`preview-img-${productId}`);
                    const uploadCard = document.getElementById(`upload-card-${productId}`);
                    
                    previewImg.src = e.target.result;
                    previewContainer.style.display = 'block';
                    uploadCard.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }

        function removePhoto(productId) {
            const input = document.getElementById(`photo-file-${productId}`);
            const previewContainer = document.getElementById(`preview-container-${productId}`);
            const previewImg = document.getElementById(`preview-img-${productId}`);
            const uploadCard = document.getElementById(`upload-card-${productId}`);
            
            input.value = '';
            previewImg.src = '';
            previewContainer.style.display = 'none';
            uploadCard.style.display = 'flex';
        }
    </script>
</body>
</html>
