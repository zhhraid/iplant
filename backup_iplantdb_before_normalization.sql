-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: iplantdb
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(80) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(80) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `role` varchar(30) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'customer',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Zhahra Idhya Astwoti','Zhahra','Idhya Astwoti','zhahraastwoti@gmail.com','$2y$10$uXcCaRp54GRDCVCGduzrx.T0zO1BCpFbKlqBjJ8ze61VS9Js0whke',0,'customer',1,NULL,NULL,NULL,'2026-06-01 00:00:56','2026-06-01 00:00:33','2026-06-01 00:00:33'),(2,'ciman','ciman',NULL,'ciman@gmail.com','$2y$10$EzSwmG1H.kf3rITAn.FLMOXPHw1FaXYTmbdNCNh7IMxHcjnz2UDu2',0,'customer',1,NULL,NULL,NULL,'2026-06-01 10:52:10','2026-06-01 00:01:24','2026-06-01 00:01:24');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subcategory` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` int NOT NULL,
  `old_price` int DEFAULT NULL,
  `rating` decimal(3,1) NOT NULL DEFAULT '0.0',
  `reviews_count` int NOT NULL DEFAULT '0',
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Bambu Rejeki Fire Ring','Tanaman Hias','Bambu Hoki',75000,NULL,5.0,5,'/images/products/Bambu Rejeki Fire Ring Clean.png',10,'Bambu Rejeki Fire Ring merupakan tanaman hias bambu hoki dengan susunan batang yang unik dan menarik. Bentuknya yang melingkar memberikan tampilan dekoratif yang berbeda dari bambu hoki biasa, sehingga cocok dijadikan penghias meja, ruang tamu, maupun area kerja.\n\nTanaman ini cocok untuk pelanggan yang menyukai tanaman hias minimalis namun tetap memiliki nilai estetika. Perawatannya cukup mudah karena dapat diletakkan di tempat dengan cahaya tidak langsung dan tidak membutuhkan perawatan yang terlalu rumit.'),(2,'Bambu Rejeki 3 Tingkat (M)','Tanaman Hias','Bambu Hoki',75000,NULL,4.5,12,'/images/products/Bambu Rejeki 3 Tingkat (M) Clean.png',8,'Bambu Rejeki 3 Tingkat (M) memiliki bentuk susunan batang bertingkat yang rapi dan elegan. Model bertingkat ini membuat tampilannya terlihat lebih berisi dan cocok digunakan sebagai dekorasi ruangan dengan kesan alami.\n\nProduk ini cocok untuk penghias meja kantor, ruang tamu, maupun hadiah tanaman hias. Selain tampilannya menarik, bambu rejeki juga banyak diminati karena mudah dirawat dan dapat memberikan suasana segar pada ruangan.'),(3,'Bambu Rejeki Triangle Vas','Tanaman Hias','Bambu Hoki',90000,NULL,4.7,9,'/images/products/Bambu Rejeki Triangle Vas Clean.png',5,'Bambu Rejeki Triangle Vas merupakan tanaman hias bambu hoki yang disusun dalam bentuk vas segitiga. Bentuk ini memberikan tampilan yang simpel, modern, dan cocok untuk dekorasi indoor.\n\nTanaman ini sesuai untuk pelanggan yang menginginkan tanaman hias berukuran praktis namun tetap menarik. Dengan bentuk yang rapi dan warna hijau alami, produk ini dapat mempercantik sudut ruangan, meja belajar, maupun meja kerja.'),(4,'Bambu Rejeki Vas Variegata','Tanaman Hias','Bambu Hoki',90000,NULL,4.8,8,'/images/products/Bambu Rejeki Vas Variegata Clean.png',6,'Bambu Rejeki Vas Variegata memiliki tampilan daun yang lebih menarik karena terdapat variasi warna pada daunnya. Perpaduan warna hijau dan corak variegata membuat tanaman ini terlihat lebih segar dan dekoratif.\n\nProduk ini cocok untuk pelanggan yang menyukai tanaman hias dengan tampilan daun unik. Selain mudah dirawat, Bambu Rejeki Vas Variegata juga dapat menjadi pilihan dekorasi yang memberikan kesan alami dan estetik pada ruangan.'),(5,'Bambu Rejeki Curly Vas','Tanaman Hias','Bambu Hoki',120000,NULL,4.9,15,'/images/products/Bambu Rejeki Curly Vas Clean.png',4,'Bambu Rejeki Curly Vas memiliki bentuk batang yang melengkung atau curly sehingga tampil lebih unik dibandingkan bambu hoki biasa. Bentuknya yang artistik membuat tanaman ini cocok sebagai elemen dekorasi modern.\n\nTanaman ini dapat digunakan untuk mempercantik meja, rak, atau sudut ruangan. Dengan perawatan sederhana dan tampilan yang unik, Bambu Rejeki Curly Vas cocok untuk pembeli yang ingin tanaman hias praktis namun tetap menarik perhatian.'),(6,'Bambu Rejeki Pagoda 5','Tanaman Hias','Bambu Hoki',120000,150000,5.0,20,'/images/products/Bambu Rejeki Pagoda 5 Clean.png',5,'Bambu Rejeki Pagoda 5 merupakan tanaman bambu hoki dengan susunan batang menyerupai bentuk pagoda. Bentuknya yang bertingkat dan simetris memberikan kesan rapi, unik, serta memiliki nilai dekoratif tinggi.\n\nProduk ini cocok dijadikan dekorasi rumah, kantor, maupun hadiah untuk orang terdekat. Dengan tampilannya yang elegan, Bambu Rejeki Pagoda 5 dapat memberikan nuansa segar sekaligus memperindah ruangan.'),(7,'Anggrek Bulan Mini Kuning','Tanaman Berbunga','Anggrek',200000,NULL,4.6,14,'/images/products/Anggrek Bulan Mini Kuning Clean.png',5,'Anggrek Bulan Mini Kuning merupakan tanaman anggrek berukuran mini dengan warna bunga kuning yang cerah dan lembut. Warna bunganya memberikan kesan segar, ceria, dan cocok untuk mempercantik ruangan maupun teras rumah.\n\nTanaman ini cocok untuk pelanggan yang menyukai anggrek dengan ukuran praktis dan tampilan manis. Dengan perawatan yang tepat, Anggrek Bulan Mini Kuning dapat menjadi koleksi tanaman berbunga yang indah dan menarik.'),(8,'Anggrek Bulan Mini Putih','Tanaman Berbunga','Anggrek',200000,NULL,4.8,18,'/images/products/Anggrek Bulan Mini Putih Clean.png',6,'Anggrek Bulan Mini Putih memiliki bunga berwarna putih yang memberikan kesan bersih, elegan, dan menenangkan. Ukurannya yang mini membuat tanaman ini cocok diletakkan di meja, rak tanaman, atau area indoor dengan pencahayaan cukup.\n\nProduk ini sesuai untuk pelanggan yang menyukai tanaman berbunga dengan tampilan sederhana namun tetap mewah. Warna putih pada bunganya membuat anggrek ini mudah dipadukan dengan berbagai konsep dekorasi rumah.'),(9,'Cymbidium Chen\'s Ruby','Tanaman Berbunga','Anggrek',175000,NULL,4.9,6,'/images/products/Cymbidium Chen\'s Ruby Clean.png',4,'Cymbidium Chen’s Ruby merupakan jenis anggrek dengan tampilan bunga yang menarik dan memiliki karakter berbeda dari anggrek bulan. Bentuk dan warnanya memberikan kesan eksotis sehingga cocok untuk koleksi tanaman berbunga.\n\nTanaman ini cocok untuk pelanggan yang ingin menambah variasi koleksi anggrek di rumah. Dengan bentuk bunga yang khas, Cymbidium Chen’s Ruby dapat menjadi pilihan dekoratif untuk taman, teras, maupun area tanaman hias.'),(10,'Anggrek Bulan Mini Purple','Tanaman Berbunga','Anggrek',150000,NULL,4.7,22,'/images/products/Anggrek Bulan Mini Purple Clean.png',10,'Anggrek Bulan Mini Purple memiliki warna ungu yang cantik dan memberikan kesan anggun. Warna bunganya yang mencolok namun tetap lembut membuat tanaman ini cocok sebagai penghias ruangan maupun teras.\n\nProduk ini cocok bagi pelanggan yang menyukai tanaman berbunga dengan warna yang lebih hidup. Anggrek Bulan Mini Purple dapat menjadi pilihan menarik untuk memperindah rumah sekaligus menambah nuansa alami.'),(11,'Anggrek Bulan Black Jack','Tanaman Berbunga','Anggrek',150000,NULL,5.0,11,'/images/products/Anggrek Bulan Black Jack Clean.png',7,'Anggrek Bulan Black Jack merupakan tanaman anggrek dengan tampilan bunga yang unik dan elegan. Warna bunganya yang lebih kuat memberikan kesan eksklusif serta berbeda dari jenis anggrek bulan pada umumnya.\n\nTanaman ini cocok untuk pelanggan yang menginginkan koleksi anggrek dengan karakter visual yang lebih menonjol. Dengan tampilan yang menarik, Anggrek Bulan Black Jack dapat menjadi pusat perhatian dalam dekorasi tanaman hias.'),(12,'Anggrek Cattleya Pra-Remaja','Tanaman Berbunga','Anggrek',60000,NULL,4.3,7,'/images/products/Anggrek Cattleya Pra-Remaja Clean.png',18,'Anggrek Cattleya Pra-Remaja merupakan tanaman anggrek yang masih berada pada fase pertumbuhan sebelum dewasa. Jenis ini cocok bagi pelanggan yang ingin merawat anggrek dari tahap awal hingga berkembang dan berbunga.\n\nProduk ini sesuai untuk penghobi tanaman yang menikmati proses perawatan tanaman hias. Dengan perawatan yang sabar dan tepat, Anggrek Cattleya Pra-Remaja dapat tumbuh menjadi tanaman anggrek yang indah dan bernilai dekoratif.'),(13,'Mawar Impor Emilien','Tanaman Berbunga','Mawar',45000,75000,4.8,19,'/images/products/Mawar Impor Emilien Clean.png',10,'Mawar Impor Emilien merupakan tanaman mawar dengan tampilan bunga yang indah dan elegan. Warna serta bentuk kelopaknya memberikan kesan romantis, sehingga cocok digunakan sebagai tanaman hias di taman atau halaman rumah.\n\nProduk ini cocok untuk pelanggan yang ingin mempercantik area outdoor dengan tanaman berbunga. Mawar Impor Emilien dapat menjadi pilihan koleksi mawar yang menarik karena tampilannya memberikan kesan mewah dan alami.'),(14,'Blue Moonstone Rose','Tanaman Berbunga','Mawar',75000,NULL,4.9,13,'/images/products/Blue Moonstone Rose Clean.png',12,'Blue Moonstone Rose merupakan tanaman mawar dengan tampilan bunga yang unik dan menarik. Keindahan warnanya membuat tanaman ini cocok dijadikan koleksi bagi pecinta mawar yang menginginkan variasi berbeda dari mawar biasa.\n\nTanaman ini dapat mempercantik taman, pot hias, maupun sudut halaman rumah. Blue Moonstone Rose sesuai untuk pelanggan yang menyukai tanaman berbunga dengan karakter visual yang lembut, cantik, dan estetik.'),(15,'Mawar Impor Kahala','Tanaman Berbunga','Mawar',40000,NULL,4.5,10,'/images/products/Mawar Impor Kahala Clean.png',15,'Mawar Impor Kahala memiliki tampilan bunga yang cantik dengan warna yang memberikan kesan hangat dan elegan. Jenis mawar ini cocok untuk memperindah taman rumah maupun area dekorasi luar ruangan.\n\nProduk ini cocok bagi pelanggan yang ingin memiliki tanaman berbunga dengan daya tarik visual tinggi. Dengan perawatan yang baik, Mawar Impor Kahala dapat tumbuh indah dan memberikan suasana taman yang lebih hidup.'),(16,'Mawar Impor Aube','Tanaman Berbunga','Mawar',40000,NULL,4.7,16,'/images/products/Mawar Impor Aube Clean.png',10,'Mawar Impor Aube merupakan jenis mawar yang memiliki tampilan bunga menawan dan cocok untuk koleksi tanaman hias berbunga. Bentuk kelopaknya memberikan kesan lembut, anggun, dan bernilai dekoratif.\n\nTanaman ini cocok diletakkan di taman, halaman, atau pot hias. Mawar Impor Aube dapat menjadi pilihan bagi pelanggan yang ingin menghadirkan nuansa romantis dan alami di lingkungan rumah.'),(17,'Mawar Impor Minion Putih','Tanaman Berbunga','Mawar',35000,NULL,4.4,5,'/images/products/Mawar Impor Minion Putih Clean.png',8,'Mawar Impor Minion Putih memiliki bunga berwarna putih yang memberikan kesan bersih, lembut, dan elegan. Warna putih pada bunga mawar ini cocok untuk menciptakan suasana taman yang tenang dan indah.\n\nProduk ini sesuai untuk pelanggan yang menyukai tanaman berbunga dengan tampilan sederhana namun tetap menarik. Mawar Impor Minion Putih dapat menjadi pilihan dekorasi taman yang cantik dan mudah dipadukan dengan tanaman lain.'),(18,'Mawar Rambat Orange','Tanaman Berbunga','Mawar',45000,NULL,4.6,8,'/images/products/Mawar Rambat Orange Clean.png',6,'Mawar Rambat Orange merupakan tanaman mawar rambat dengan warna bunga oranye yang cerah dan menarik. Jenis ini cocok digunakan untuk menghiasi pagar, dinding taman, pergola, atau area luar ruangan lainnya.\n\nTanaman ini sesuai untuk pelanggan yang ingin membuat taman terlihat lebih hidup dan berwarna. Dengan pertumbuhan yang merambat, Mawar Rambat Orange dapat menjadi elemen dekoratif alami yang mempercantik area rumah.'),(19,'Mangga Irwin (Jumbo)','Bibit Buah','Mangga',600000,NULL,5.0,4,'/images/products/Mangga Irwin (Jumbo) Clean.png',2,'Mangga Irwin Jumbo merupakan bibit mangga yang dikenal dengan ukuran buah yang besar dan tampilan menarik. Bibit ini cocok untuk ditanam di halaman rumah, kebun, maupun lahan pekarangan yang cukup luas.\n\nProduk ini sesuai untuk pelanggan yang ingin menanam tanaman buah produktif. Dengan perawatan yang tepat, Mangga Irwin Jumbo berpotensi menghasilkan buah yang dapat dikonsumsi sendiri maupun dimanfaatkan sebagai hasil kebun.'),(20,'Mangga Kiojay (Berbuah)','Bibit Buah','Mangga',700000,NULL,4.9,7,'/images/products/Mangga Kiojay (Berbuah) Clean.png',3,'Mangga Kiojay Berbuah merupakan bibit mangga yang sudah berada pada fase siap atau mendekati masa berbuah. Produk ini cocok bagi pelanggan yang ingin memiliki tanaman buah tanpa menunggu terlalu lama dari tahap bibit kecil.\n\nTanaman ini dapat menjadi pilihan menarik untuk pekarangan rumah karena memiliki nilai produktif dan dekoratif. Selain memperindah halaman, Mangga Kiojay Berbuah juga memberikan manfaat berupa hasil buah ketika sudah tumbuh optimal.'),(21,'Mangga Mahatir','Bibit Buah','Mangga',90000,NULL,4.7,13,'/images/products/Mangga Mahatir Clean.png',15,'Mangga Mahatir merupakan salah satu jenis bibit mangga yang banyak diminati karena potensi buahnya yang menarik. Bibit ini cocok ditanam di area pekarangan, kebun kecil, atau lahan terbuka dengan pencahayaan cukup.\n\nProduk ini sesuai untuk pelanggan yang ingin mulai berkebun tanaman buah. Dengan perawatan rutin seperti penyiraman, pemupukan, dan pencahayaan yang baik, Mangga Mahatir dapat tumbuh menjadi tanaman buah yang produktif.'),(22,'Mangga Apel','Bibit Buah','Mangga',75000,90000,4.5,11,'/images/products/Mangga Apel Clean.png',10,'Mangga Apel merupakan bibit mangga dengan karakter buah yang khas dan berbeda dari jenis mangga lainnya. Tanaman ini cocok untuk pelanggan yang ingin memiliki variasi tanaman buah di halaman rumah.\n\nBibit Mangga Apel dapat menjadi pilihan untuk penghijauan sekaligus tanaman produktif. Selain memberikan suasana hijau pada lingkungan, tanaman ini juga berpotensi menghasilkan buah yang dapat dinikmati saat masa panen.'),(23,'Mangga Gajah','Bibit Buah','Mangga',128000,160000,4.6,6,'/images/products/Mangga Gajah Clean.png',8,'Mangga Gajah merupakan jenis bibit mangga yang dikenal dengan potensi ukuran buah yang besar. Tanaman ini cocok ditanam di pekarangan atau kebun yang memiliki ruang tumbuh cukup luas.\n\nProduk ini sesuai untuk pelanggan yang ingin menanam tanaman buah bernilai produktif. Dengan perawatan yang baik, Mangga Gajah dapat tumbuh kuat dan menjadi pilihan tanaman buah yang bermanfaat untuk jangka panjang.'),(24,'Mangga Kiojay','Bibit Buah','Mangga',120000,150000,4.8,9,'/images/products/Mangga Kiojay Clean.png',12,'Mangga Kiojay merupakan bibit mangga yang cocok untuk ditanam sebagai tanaman buah di rumah maupun kebun. Jenis ini banyak diminati karena memiliki potensi buah yang menarik dan cocok untuk koleksi tanaman produktif.\n\nTanaman ini cocok untuk pelanggan yang ingin memanfaatkan lahan kosong menjadi lebih bermanfaat. With pemeliharaan yang tepat, Mangga Kiojay dapat tumbuh sehat dan memberikan hasil buah di kemudian hari.'),(25,'Media Tanam Forest Moss 250gr','Produk Lain','Media Tanam',20000,NULL,4.8,32,'/images/products/Media Tanam Forest Moss 250gr Clean.png',50,'Media Tanam Forest Moss 250gr merupakan media tanam yang dapat membantu menjaga kelembapan pada tanaman. Produk ini cocok digunakan untuk berbagai kebutuhan tanaman hias, terutama tanaman yang memerlukan media lembap.\n\nMedia ini sesuai untuk pelanggan yang ingin meningkatkan kualitas perawatan tanaman. Dengan penggunaan yang tepat, Forest Moss dapat membantu akar tanaman tetap sehat dan mendukung pertumbuhan tanaman secara optimal.'),(26,'Media Semai Premium 500gr','Produk Lain','Media Tanam',40000,NULL,4.7,24,'/images/products/Media Semai Premium 500gr Clean.png',40,'Media Semai Premium 500gr merupakan media tanam yang dirancang untuk membantu proses penyemaian benih. Teksturnya mendukung pertumbuhan awal tanaman sehingga cocok digunakan oleh pemula maupun penghobi tanaman.\n\nProduk ini cocok untuk pelanggan yang ingin memulai proses menanam dari benih. Dengan media semai yang tepat, benih dapat tumbuh lebih baik dan lebih mudah dipindahkan ke media tanam utama setelah cukup kuat.'),(27,'Rockwool 15cm | Media Semai Benih','Produk Lain','Media Tanam',32000,NULL,4.6,45,'/images/products/Rockwall 15cm  Media Semai Benih Clean.png',100,'Rockwool 15cm Media Semai Benih merupakan media semai yang praktis digunakan untuk menumbuhkan benih. Media ini banyak digunakan karena mampu menyerap air dengan baik dan mendukung proses perkecambahan.\n\nProduk ini cocok untuk penyemaian sayuran, tanaman hias, maupun kebutuhan hidroponik sederhana. Dengan bentuk yang mudah digunakan, Rockwool membantu proses semai menjadi lebih rapi dan efisien.'),(28,'Media Tanam Akadama 1 Karung','Produk Lain','Media Tanam',370000,NULL,4.9,10,'/images/products/Media Tanam Akadama 1 Karung Clean.png',5,'Media Tanam Akadama 1 Karung merupakan media tanam yang cocok digunakan untuk kebutuhan tanaman tertentu, terutama tanaman yang membutuhkan media berpori. Akadama membantu menjaga sirkulasi udara dan kelembapan pada akar.\n\nProduk ini sesuai untuk pelanggan yang membutuhkan media tanam dalam jumlah lebih banyak. Dengan ukuran satu karung, media ini cocok digunakan untuk koleksi tanaman, repotting, atau kebutuhan berkebun yang lebih besar.'),(29,'Media Tanam Premium AKADAMA','Produk Lain','Media Tanam',45000,NULL,5.0,2,'/images/products/Media Tanam Premium AKADAMA Clean.png',20,'Media Tanam Premium AKADAMA merupakan media tanam berkualitas yang dapat mendukung pertumbuhan akar tanaman. Media ini memiliki struktur yang baik untuk menjaga keseimbangan air dan udara di sekitar akar.\n\nProduk ini cocok untuk pelanggan yang ingin memberikan media tanam lebih optimal pada tanaman koleksi. Dengan penggunaan yang sesuai, Premium Akadama dapat membantu tanaman tumbuh lebih sehat dan kuat.'),(30,'Media Tanam Kaktus Premium','Produk Lain','Media Tanam',40000,NULL,5.0,14,'/images/products/Media Tanam Kaktus Premium Clean.png',25,'Media Tanam Kaktus Premium merupakan media tanam khusus yang cocok untuk tanaman kaktus dan sukulen. Media ini dirancang agar tidak terlalu menahan air sehingga dapat membantu mencegah akar tanaman mudah membusuk.\n\nProduk ini cocok untuk pelanggan yang merawat kaktus, sukulen, atau tanaman sejenis yang membutuhkan media kering dan porous. Dengan media yang sesuai, tanaman dapat tumbuh lebih sehat dan perawatannya menjadi lebih mudah.');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `customer_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_city` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `customer_zip` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_phone` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `is_dropshipper` tinyint(1) NOT NULL DEFAULT '0',
  `dropshipper_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dropshipper_phone` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `shipping_courier` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `shipping_cost` int NOT NULL DEFAULT '0',
  `subtotal` int NOT NULL DEFAULT '0',
  `unique_code` int NOT NULL DEFAULT '0',
  `total_amount` int NOT NULL DEFAULT '0',
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `payment_date` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_transfer_to` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_source_bank` varchar(80) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_account_name` varchar(120) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_amount` int DEFAULT '0',
  `payment_proof` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_confirmed_at` datetime DEFAULT NULL,
  `refund_reason` text COLLATE utf8mb4_general_ci,
  `refund_requested_at` datetime DEFAULT NULL,
  `refund_approved_at` datetime DEFAULT NULL,
  `tracking_number` varchar(80) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `shipping_status` varchar(80) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'IPLANT6455','zhahraidhya221@gmail.com',0,'Zhahra Idhya Astwoti','DKI Jakarta, Jakarta Pusat, Gambir','JL. Bakti No. 72a, Parupuk Tabing, Kec. Koto Tangah, Kota Padang, Sumatra Barat','25586','+6281266962505',0,'','','JNE - REG',17000,75000,76,92076,'Terbayar','2026-05-31 23:00:46','31/05/2026','BCA - 0190725880 - ALFIANSYAH ANWAR','BNI','ZHAHRA',92076,NULL,'2026-05-31 23:01:01',NULL,NULL,NULL,'JD0561623445','Sudah Sampai','2026-05-31 23:11:29'),(2,'IPLANT2083','zhahraidhya221@gmail.com',0,'Zhahra Idhya Astwoti','DKI Jakarta, Jakarta Pusat, Gambir','JL. Bakti No. 72a, Parupuk Tabing, Kec. Koto Tangah, Kota Padang, Sumatra Barat','25586','+6281266962505',0,'','','JNE - REG',17000,75000,78,92078,'pending','2026-05-31 23:12:58',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'IPLANT8546','zhahraidhya221@gmail.com',0,'Zhahra Idhya Astwoti','DKI Jakarta, Jakarta Pusat, Sawah Besar','JL. Bakti No. 72a, Parupuk Tabing, Kec. Koto Tangah, Kota Padang, Sumatra Barat','25586','+6281266962505',0,'','','JNE - REG',17000,75000,29,92029,'Terbayar','2026-05-31 23:14:57',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,'Menunggu Untuk Dikirim',NULL),(4,'IPLANT1568','zhahraidhya221@gmail.com',0,'Zhahra Idhya Astwoti','DKI Jakarta, Jakarta Pusat, Menteng','JL. Bakti No. 72a, Parupuk Tabing, Kec. Koto Tangah, Kota Padang, Sumatra Barat','25586','+6281266962505',0,'','','JNE - REG',17000,75000,11,92011,'Terbayar','2026-05-31 23:18:25','31/05/2026','BCA - 0190725880 - ALFIANSYAH ANWAR','BNI','ZHAHRA',92011,NULL,'2026-05-31 23:18:50',NULL,NULL,NULL,'JNE242789446','Sudah Sampai','2026-05-31 23:37:46'),(5,'IPLANT5868','zhahraidhya221@gmail.com',0,'Zhahra Idhya Astwoti','DKI Jakarta, Jakarta Pusat, Sawah Besar','JL. Bakti No. 72a, Parupuk Tabing, Kec. Koto Tangah, Kota Padang, Sumatra Barat','25586','+6281266962505',0,'','','JNE - REG',17000,75000,20,92020,'pending','2026-05-31 23:40:01',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'IPLANT9195','zhahraidhya221@gmail.com',0,'Zhahra Idhya Astwoti','DKI Jakarta, Jakarta Pusat, Gambir','JL. Bakti No. 72a, Parupuk Tabing, Kec. Koto Tangah, Kota Padang, Sumatra Barat','25586','+6281266962505',0,'','','JNE - REG',17000,75000,71,92071,'Terbayar','2026-05-31 23:43:04','31/05/2026','BCA - 0190725880 - ALFIANSYAH ANWAR','BNI','ZHAHRA',92071,NULL,'2026-05-31 23:45:24',NULL,NULL,NULL,'JNE579171734','Sudah Sampai','2026-05-31 23:46:54'),(7,'IPLANT2060','ciman@gmail.com',0,'Zhahra Idhya Astwoti','','JL. Bakti No. 72a, Parupuk Tabing, Kec. Koto Tangah, Kota Padang, Sumatra Barat','25586','+6281266962505',0,'','','JNE - REG',25000,600000,11,625011,'Terbayar','2026-06-01 00:17:28','01/06/2026','BCA - 0190725880 - ALFIANSYAH ANWAR','BNI','ZHAHRA',625011,NULL,'2026-06-01 00:17:42',NULL,NULL,NULL,'JNE722584154','Sudah Sampai','2026-06-01 00:18:26'),(8,'IPLANT3971','zhahraidhya221@gmail.com',0,'Zhahra Idhya Astwoti','DKI Jakarta, Jakarta Pusat, Gambir','JL. Bakti No. 72a, Parupuk Tabing, Kec. Koto Tangah, Kota Padang, Sumatra Barat','25586','+6281266962505',0,'','','LION - Regpack',15000,75000,54,65054,'Menunggu Konfirmasi','2026-06-01 10:51:33','01/06/2026','BCA - 0190725880 - ALFIANSYAH ANWAR','BNI','ZHAHRA',65054,NULL,'2026-06-01 10:51:48',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `price` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,1,'Bambu Rejeki Fire Ring',1,75000),(2,2,1,'Bambu Rejeki Fire Ring',1,75000),(3,3,1,'Bambu Rejeki Fire Ring',1,75000),(4,4,1,'Bambu Rejeki Fire Ring',1,75000),(5,5,1,'Bambu Rejeki Fire Ring',1,75000),(6,6,2,'Bambu Rejeki 3 Tingkat (M)',1,75000),(7,7,19,'Mangga Irwin (Jumbo)',1,600000),(8,8,1,'Bambu Rejeki Fire Ring',1,75000);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  `user_name` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `review_text` text COLLATE utf8mb4_general_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,1,1,'Zhahra Idhya Astwoti',5,'Luar biasa bagus, bambunya segar!',NULL,'2026-05-31 17:16:43','2026-05-31 17:16:43'),(2,7,19,'ciman',4,'okok','/uploads/reviews/1780247923_99993bebd10674426011.png','2026-06-01 00:18:43','2026-06-01 00:18:43');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-06  9:52:11
