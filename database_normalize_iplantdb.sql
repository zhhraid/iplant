SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS rating;
DROP TABLE IF EXISTS refund;
DROP TABLE IF EXISTS konfirmasi_pembayaran;
DROP TABLE IF EXISTS metode_pembayaran;
DROP TABLE IF EXISTS detail_pesanan;
DROP TABLE IF EXISTS pesanan;
DROP TABLE IF EXISTS metode_pengiriman;
DROP TABLE IF EXISTS ekspedisi;
DROP TABLE IF EXISTS kupon;
DROP TABLE IF EXISTS detail_keranjang;
DROP TABLE IF EXISTS keranjang;
DROP TABLE IF EXISTS informasi_pembeli;
DROP TABLE IF EXISTS produk;
DROP TABLE IF EXISTS sub_kategori;
DROP TABLE IF EXISTS kategori;
DROP TABLE IF EXISTS blog;

CREATE TABLE kategori (
  id_kategori INT UNSIGNED NOT NULL AUTO_INCREMENT,
  kategori VARCHAR(100) NOT NULL,
  slug VARCHAR(120) NOT NULL,
  PRIMARY KEY (id_kategori),
  UNIQUE KEY kategori_slug_unique (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE sub_kategori (
  id_sub_kategori INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_kategori INT UNSIGNED NOT NULL,
  sub_kategori VARCHAR(100) NOT NULL,
  slug VARCHAR(120) NOT NULL,
  PRIMARY KEY (id_sub_kategori),
  UNIQUE KEY sub_kategori_slug_unique (slug),
  KEY sub_kategori_id_kategori_index (id_kategori),
  CONSTRAINT sub_kategori_id_kategori_foreign FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE produk (
  id_produk INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_sub_kategori INT UNSIGNED NULL,
  nama_produk VARCHAR(100) NOT NULL,
  harga INT NOT NULL,
  harga_lama INT NULL,
  gambar_produk VARCHAR(255) NULL,
  stok INT NOT NULL DEFAULT 0,
  deskripsi_produk TEXT NULL,
  PRIMARY KEY (id_produk),
  KEY produk_id_sub_kategori_index (id_sub_kategori),
  CONSTRAINT produk_id_sub_kategori_foreign FOREIGN KEY (id_sub_kategori) REFERENCES sub_kategori(id_sub_kategori) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE pengguna (
  id_pengguna INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nama VARCHAR(120) NOT NULL,
  email VARCHAR(150) NOT NULL,
  password VARCHAR(255) NOT NULL,
  newsletter TINYINT(1) NOT NULL DEFAULT 0,
  role VARCHAR(30) NOT NULL DEFAULT 'customer',
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  remember_token VARCHAR(100) NULL,
  reset_token VARCHAR(100) NULL,
  reset_token_expires_at DATETIME NULL,
  last_login_at DATETIME NULL,
  PRIMARY KEY (id_pengguna),
  UNIQUE KEY pengguna_email_unique (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE informasi_pembeli (
  id_informasi_pembeli INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_pengguna INT UNSIGNED NULL,
  email_pembeli VARCHAR(150) NOT NULL,
  nama_pembeli VARCHAR(120) NOT NULL,
  provinsi VARCHAR(100) NULL,
  kota_kabupaten VARCHAR(100) NOT NULL,
  kecamatan VARCHAR(100) NULL,
  alamat TEXT NOT NULL,
  kode_pos VARCHAR(20) NOT NULL,
  telepon VARCHAR(30) NOT NULL,
  PRIMARY KEY (id_informasi_pembeli),
  KEY informasi_pembeli_id_pengguna_index (id_pengguna),
  CONSTRAINT informasi_pembeli_id_pengguna_foreign FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE keranjang (
  id_keranjang INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_pengguna INT UNSIGNED NOT NULL,
  PRIMARY KEY (id_keranjang),
  UNIQUE KEY keranjang_id_pengguna_unique (id_pengguna),
  CONSTRAINT keranjang_id_pengguna_foreign FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE detail_keranjang (
  id_detail_keranjang INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_keranjang INT UNSIGNED NOT NULL,
  id_produk INT UNSIGNED NOT NULL,
  jumlah_keranjang INT NOT NULL DEFAULT 1,
  PRIMARY KEY (id_detail_keranjang),
  UNIQUE KEY detail_keranjang_unique (id_keranjang, id_produk),
  KEY detail_keranjang_id_produk_index (id_produk),
  CONSTRAINT detail_keranjang_id_keranjang_foreign FOREIGN KEY (id_keranjang) REFERENCES keranjang(id_keranjang) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT detail_keranjang_id_produk_foreign FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE kupon (
  id_kupon INT UNSIGNED NOT NULL AUTO_INCREMENT,
  kode_kupon VARCHAR(50) NOT NULL,
  tipe_diskon VARCHAR(20) NOT NULL DEFAULT 'nominal',
  jumlah_diskon INT NOT NULL DEFAULT 0,
  minimum_pesanan INT NOT NULL DEFAULT 0,
  status TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (id_kupon),
  UNIQUE KEY kupon_kode_kupon_unique (kode_kupon)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE ekspedisi (
  id_ekspedisi INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nama_ekspedisi VARCHAR(80) NOT NULL,
  kode_ekspedisi VARCHAR(20) NOT NULL,
  logo VARCHAR(255) NULL,
  PRIMARY KEY (id_ekspedisi),
  UNIQUE KEY ekspedisi_kode_ekspedisi_unique (kode_ekspedisi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE metode_pengiriman (
  id_pengiriman INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_ekspedisi INT UNSIGNED NOT NULL,
  nama_layanan VARCHAR(80) NOT NULL,
  tarif INT NOT NULL DEFAULT 0,
  tarif_per_kg INT NOT NULL DEFAULT 0,
  berat_paket INT NOT NULL DEFAULT 1000,
  estimasi VARCHAR(40) NOT NULL DEFAULT '2-4 hari',
  status TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (id_pengiriman),
  KEY metode_pengiriman_id_ekspedisi_index (id_ekspedisi),
  CONSTRAINT metode_pengiriman_id_ekspedisi_foreign FOREIGN KEY (id_ekspedisi) REFERENCES ekspedisi(id_ekspedisi) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE pesanan (
  id_pesanan INT UNSIGNED NOT NULL AUTO_INCREMENT,
  kode_invoice VARCHAR(50) NOT NULL,
  id_pengguna INT UNSIGNED NULL,
  id_informasi_pembeli INT UNSIGNED NULL,
  id_kupon INT UNSIGNED NULL,
  id_pengiriman INT UNSIGNED NULL,
  is_dropshipper TINYINT(1) NOT NULL DEFAULT 0,
  nama_dropshipper VARCHAR(100) NULL,
  telepon_dropshipper VARCHAR(30) NULL,
  tanggal_pesanan DATETIME NULL,
  status_pesanan VARCHAR(20) NOT NULL DEFAULT 'pending',
  status_pengiriman VARCHAR(80) NULL,
  kode_unik INT NOT NULL DEFAULT 0,
  no_resi VARCHAR(80) NULL,
  subtotal_pesanan INT NOT NULL DEFAULT 0,
  biaya_pengiriman INT NOT NULL DEFAULT 0,
  total INT NOT NULL DEFAULT 0,
  delivered_at DATETIME NULL,
  PRIMARY KEY (id_pesanan),
  UNIQUE KEY pesanan_kode_invoice_unique (kode_invoice),
  KEY pesanan_id_pengguna_index (id_pengguna),
  KEY pesanan_id_informasi_pembeli_index (id_informasi_pembeli),
  KEY pesanan_id_kupon_index (id_kupon),
  KEY pesanan_id_pengiriman_index (id_pengiriman),
  CONSTRAINT pesanan_id_pengguna_foreign FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT pesanan_id_informasi_pembeli_foreign FOREIGN KEY (id_informasi_pembeli) REFERENCES informasi_pembeli(id_informasi_pembeli) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT pesanan_id_kupon_foreign FOREIGN KEY (id_kupon) REFERENCES kupon(id_kupon) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT pesanan_id_pengiriman_foreign FOREIGN KEY (id_pengiriman) REFERENCES metode_pengiriman(id_pengiriman) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE detail_pesanan (
  id_detail_pesanan INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_pesanan INT UNSIGNED NOT NULL,
  id_produk INT UNSIGNED NOT NULL,
  nama_produk VARCHAR(100) NOT NULL,
  jumlah_pesan INT NOT NULL,
  harga_saat_beli INT NOT NULL,
  subtotal_item INT NOT NULL,
  PRIMARY KEY (id_detail_pesanan),
  KEY detail_pesanan_id_pesanan_index (id_pesanan),
  KEY detail_pesanan_id_produk_index (id_produk),
  CONSTRAINT detail_pesanan_id_pesanan_foreign FOREIGN KEY (id_pesanan) REFERENCES pesanan(id_pesanan) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT detail_pesanan_id_produk_foreign FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE metode_pembayaran (
  id_metode INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nama_bank VARCHAR(80) NOT NULL,
  no_rekening VARCHAR(50) NOT NULL,
  nama_pemilik VARCHAR(120) NOT NULL,
  status TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (id_metode)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE konfirmasi_pembayaran (
  id_pembayaran INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_pesanan INT UNSIGNED NOT NULL,
  id_metode INT UNSIGNED NOT NULL,
  waktu_pembayaran DATETIME NULL,
  bank_asal VARCHAR(80) NOT NULL,
  nama_pemilik VARCHAR(120) NOT NULL,
  jumlah INT NOT NULL,
  bukti_transfer VARCHAR(255) NULL,
  waktu_konfirmasi DATETIME NULL,
  status_konfirmasi VARCHAR(30) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (id_pembayaran),
  KEY konfirmasi_pembayaran_id_pesanan_index (id_pesanan),
  KEY konfirmasi_pembayaran_id_metode_index (id_metode),
  CONSTRAINT konfirmasi_pembayaran_id_pesanan_foreign FOREIGN KEY (id_pesanan) REFERENCES pesanan(id_pesanan) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT konfirmasi_pembayaran_id_metode_foreign FOREIGN KEY (id_metode) REFERENCES metode_pembayaran(id_metode) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE refund (
  id_refund INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_pesanan INT UNSIGNED NOT NULL,
  alasan_refund TEXT NOT NULL,
  waktu_pengajuan DATETIME NULL,
  waktu_disetujui DATETIME NULL,
  status_refund VARCHAR(30) NOT NULL DEFAULT 'diajukan',
  PRIMARY KEY (id_refund),
  KEY refund_id_pesanan_index (id_pesanan),
  CONSTRAINT refund_id_pesanan_foreign FOREIGN KEY (id_pesanan) REFERENCES pesanan(id_pesanan) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE rating (
  id_rating INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_pesanan INT UNSIGNED NOT NULL,
  id_produk INT UNSIGNED NOT NULL,
  id_pengguna INT UNSIGNED NULL,
  rating TINYINT(1) NOT NULL,
  gambar VARCHAR(255) NULL,
  review TEXT NOT NULL,
  PRIMARY KEY (id_rating),
  KEY rating_id_pesanan_index (id_pesanan),
  KEY rating_id_produk_index (id_produk),
  KEY rating_id_pengguna_index (id_pengguna),
  CONSTRAINT rating_id_pesanan_foreign FOREIGN KEY (id_pesanan) REFERENCES pesanan(id_pesanan) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT rating_id_produk_foreign FOREIGN KEY (id_produk) REFERENCES produk(id_produk) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT rating_id_pengguna_foreign FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE blog (
  id_blog INT UNSIGNED NOT NULL AUTO_INCREMENT,
  slug VARCHAR(150) NOT NULL,
  judul_blog VARCHAR(180) NOT NULL,
  gambar VARCHAR(255) NULL,
  konten_blog TEXT NOT NULL,
  tanggal_publish DATETIME NULL,
  PRIMARY KEY (id_blog),
  UNIQUE KEY blog_slug_unique (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO kategori (kategori, slug)
SELECT DISTINCT category, LOWER(REPLACE(category, ' ', '-'))
FROM products
WHERE category IS NOT NULL AND category <> '';

INSERT INTO sub_kategori (id_kategori, sub_kategori, slug)
SELECT DISTINCT k.id_kategori, p.subcategory, LOWER(REPLACE(p.subcategory, ' ', '-'))
FROM products p
JOIN kategori k ON k.kategori = p.category
WHERE p.subcategory IS NOT NULL AND p.subcategory <> '';

INSERT INTO produk (id_produk, id_sub_kategori, nama_produk, harga, harga_lama, gambar_produk, stok, deskripsi_produk)
SELECT p.id, sk.id_sub_kategori, p.name, p.price, p.old_price, p.image_url, p.stock, p.description
FROM products p
LEFT JOIN kategori k ON k.kategori = p.category
LEFT JOIN sub_kategori sk ON sk.id_kategori = k.id_kategori AND sk.sub_kategori = p.subcategory;

INSERT INTO pengguna (id_pengguna, nama, email, password, newsletter, role, is_active, remember_token, reset_token, reset_token_expires_at, last_login_at)
SELECT id, name, email, password_hash, newsletter, role, is_active, remember_token, reset_token, reset_token_expires_at, last_login_at
FROM users;

INSERT INTO ekspedisi (nama_ekspedisi, kode_ekspedisi, logo)
SELECT DISTINCT courier_name, LOWER(REPLACE(courier_name, '&', 'nt')), CONCAT('/images/expeditions/', LOWER(REPLACE(courier_name, '&', 'nt')), '.png')
FROM (
  SELECT TRIM(SUBSTRING_INDEX(COALESCE(shipping_courier, 'JNE - REG'), ' - ', 1)) AS courier_name
  FROM orders
) courier
WHERE courier_name <> '';

INSERT INTO metode_pengiriman (id_ekspedisi, nama_layanan, tarif, tarif_per_kg, estimasi, status)
SELECT e.id_ekspedisi,
       service_name,
       MAX(shipping_cost),
       8000,
       '2-4 hari',
       1
FROM (
  SELECT TRIM(SUBSTRING_INDEX(COALESCE(shipping_courier, 'JNE - REG'), ' - ', 1)) AS courier_name,
         TRIM(SUBSTRING_INDEX(COALESCE(shipping_courier, 'JNE - REG'), ' - ', -1)) AS service_name,
         shipping_cost
  FROM orders
) shipping
JOIN ekspedisi e ON e.nama_ekspedisi = shipping.courier_name
GROUP BY e.id_ekspedisi, service_name;

INSERT INTO metode_pembayaran (nama_bank, no_rekening, nama_pemilik, status)
VALUES
('BCA', '0190725880', 'ALFIANSYAH ANWAR', 1),
('Mandiri', '9876543210', 'iPlant Indonesia', 1);

INSERT INTO informasi_pembeli (id_informasi_pembeli, id_pengguna, email_pembeli, nama_pembeli, kota_kabupaten, alamat, kode_pos, telepon)
SELECT o.id,
       u.id_pengguna,
       o.customer_email,
       o.customer_name,
       o.customer_city,
       o.customer_address,
       o.customer_zip,
       o.customer_phone
FROM orders o
LEFT JOIN pengguna u ON u.email = o.customer_email;

INSERT INTO pesanan (id_pesanan, kode_invoice, id_pengguna, id_informasi_pembeli, id_pengiriman, is_dropshipper, nama_dropshipper, telepon_dropshipper, tanggal_pesanan, status_pesanan, status_pengiriman, kode_unik, no_resi, subtotal_pesanan, biaya_pengiriman, total, delivered_at)
SELECT o.id,
       o.invoice_no,
       u.id_pengguna,
       o.id,
       mp.id_pengiriman,
       o.is_dropshipper,
       o.dropshipper_name,
       o.dropshipper_phone,
       o.created_at,
       o.status,
       o.shipping_status,
       o.unique_code,
       o.tracking_number,
       o.subtotal,
       o.shipping_cost,
       o.total_amount,
       o.delivered_at
FROM orders o
LEFT JOIN pengguna u ON u.email = o.customer_email
LEFT JOIN ekspedisi e ON e.nama_ekspedisi = TRIM(SUBSTRING_INDEX(COALESCE(o.shipping_courier, 'JNE - REG'), ' - ', 1))
LEFT JOIN metode_pengiriman mp ON mp.id_ekspedisi = e.id_ekspedisi
  AND mp.nama_layanan = TRIM(SUBSTRING_INDEX(COALESCE(o.shipping_courier, 'JNE - REG'), ' - ', -1));

INSERT INTO detail_pesanan (id_detail_pesanan, id_pesanan, id_produk, nama_produk, jumlah_pesan, harga_saat_beli, subtotal_item)
SELECT id, order_id, product_id, product_name, quantity, price, quantity * price
FROM order_items;

INSERT INTO konfirmasi_pembayaran (id_pesanan, id_metode, waktu_pembayaran, bank_asal, nama_pemilik, jumlah, bukti_transfer, waktu_konfirmasi, status_konfirmasi)
SELECT o.id,
       COALESCE(mp.id_metode, (SELECT MIN(id_metode) FROM metode_pembayaran)),
       STR_TO_DATE(o.payment_date, '%d/%m/%Y'),
       COALESCE(NULLIF(o.payment_source_bank, ''), '-'),
       COALESCE(NULLIF(o.payment_account_name, ''), '-'),
       COALESCE(NULLIF(o.payment_amount, 0), o.total_amount),
       o.payment_proof,
       o.payment_confirmed_at,
       CASE WHEN LOWER(o.status) IN ('terbayar', 'paid', 'sudah dibayar') THEN 'diterima' ELSE 'pending' END
FROM orders o
LEFT JOIN metode_pembayaran mp ON o.payment_transfer_to LIKE CONCAT(mp.nama_bank, '%')
WHERE o.payment_date IS NOT NULL
   OR o.payment_transfer_to IS NOT NULL
   OR o.payment_source_bank IS NOT NULL
   OR o.payment_amount > 0
   OR o.payment_proof IS NOT NULL
   OR o.payment_confirmed_at IS NOT NULL;

INSERT INTO refund (id_pesanan, alasan_refund, waktu_pengajuan, waktu_disetujui, status_refund)
SELECT id, refund_reason, refund_requested_at, refund_approved_at,
       CASE WHEN refund_approved_at IS NOT NULL THEN 'disetujui' ELSE 'diajukan' END
FROM orders
WHERE refund_reason IS NOT NULL AND refund_reason <> '';

INSERT INTO rating (id_rating, id_pesanan, id_produk, id_pengguna, rating, gambar, review)
SELECT r.id, r.order_id, r.product_id, u.id_pengguna, r.rating, r.image_url, r.review_text
FROM reviews r
LEFT JOIN orders o ON o.id = r.order_id
LEFT JOIN pengguna u ON u.email = o.customer_email;

INSERT INTO kupon (kode_kupon, tipe_diskon, jumlah_diskon, minimum_pesanan, status)
VALUES
('IPLANT10', 'nominal', 10000, 100000, 1),
('TANAMAN20', 'nominal', 20000, 200000, 1);

INSERT INTO blog (slug, judul_blog, gambar, konten_blog, tanggal_publish)
VALUES
('tanaman-udara-tillandsia', 'Tanaman Udara Tillandsia', '/images/blog/Tanaman Udara Tillandsia.png', 'Tillandsia adalah tanaman udara yang menyerap uap air dan nutrisi dari udara melalui bulu halus di sekelilingnya.', '2023-11-10 14:15:00'),
('rempah-eropa', 'Rempah Eropa Yang Bisa Kamu Tanam Di Rumah', '/images/blog/Rempah Eropa Yang Bisa Kamu Tanam Di Rumah.png', 'Mint, thyme, rosemary, oregano, dan sage dapat ditanam di rumah dengan perawatan yang relatif mudah.', '2023-11-09 10:45:00'),
('tanaman-hias-keberuntungan', 'Tanaman Hias Keberuntungan Zamioculcas', '/images/blog/Tanaman Hias Keberuntungan Zamioculcas.png', 'Zamioculcas atau pohon dolar populer sebagai tanaman hias indoor karena tampilannya elegan dan perawatannya mudah.', '2023-11-09 15:30:00');

DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS users;

SET FOREIGN_KEY_CHECKS = 1;
