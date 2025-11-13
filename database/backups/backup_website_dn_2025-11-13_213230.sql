-- MySQL dump 10.13  Distrib 8.0.39, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: website_dn
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.27-MariaDB

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('websitedn_cache5c785c036466adea360111aa28563bfd556b5fba','i:1;',1762950149),('websitedn_cache5c785c036466adea360111aa28563bfd556b5fba:timer','i:1762950149;',1762950149);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_notification`
--

DROP TABLE IF EXISTS `email_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_notification` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `reminders_id` bigint(20) unsigned NOT NULL,
  `email_tujuan` varchar(191) NOT NULL,
  `email_kirim` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_notification_reminders_id_foreign` (`reminders_id`),
  CONSTRAINT `email_notification_reminders_id_foreign` FOREIGN KEY (`reminders_id`) REFERENCES `reminders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_notification`
--

LOCK TABLES `email_notification` WRITE;
/*!40000 ALTER TABLE `email_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_nasabah` varchar(191) NOT NULL,
  `nomor_kwitansi` varchar(191) NOT NULL,
  `nominal_tagihan` varchar(191) NOT NULL,
  `status_pembayaran` varchar(191) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_tagihan` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (113,'testing 1','1234567890','1000000','Dibatalkan','testing 1','2025-11-08','2025-11-09 18:47:33','2025-11-09 18:47:33'),(114,'Salsabila Purnawati','KW63381761','9180000','Lunas','Sudah lunas, terima kasih.','2025-06-11','2025-11-12 07:21:13','2025-11-12 07:21:13'),(115,'Muni Budiyanto','KW29009931','4530000','Lunas','Lunas via mobile banking.','2025-05-11','2025-11-12 07:21:13','2025-11-12 07:21:13'),(116,'Daniswara Candra Widodo S.Gz','KW62528640','2350000','Lunas','Pembayaran lunas tepat waktu.','2024-11-20','2025-11-12 07:21:13','2025-11-12 07:21:13'),(117,'Ian Cahyo Santoso M.M.','KW24878597','3530000','Lunas','Lunas sesuai invoice.','2025-04-27','2025-11-12 07:21:13','2025-11-12 07:21:13'),(118,'Hasta Winarno','KW87566903','2440000','Dibatalkan','Revisi tagihan diperlukan.','2025-07-24','2025-11-12 07:21:13','2025-11-12 07:21:13'),(119,'Jaka Saputra','KW47564404','5210000','Dibatalkan','Dibatalkan atas permintaan nasabah.','2025-09-26','2025-11-12 07:21:13','2025-11-12 07:21:13'),(120,'Queen Siska Andriani M.Farm','KW90032954','7840000','Lunas','Pembayaran lunas tepat waktu.','2025-08-07','2025-11-12 07:21:13','2025-11-12 07:21:13'),(121,'Virman Pradana M.Farm','KW35689891','5570000','Lunas','Pembayaran lunas tepat waktu.','2024-11-13','2025-11-12 07:21:13','2025-11-12 07:21:13'),(122,'Mitra Winarno','KW73349130','3990000','Lunas','Lunas sesuai invoice.','2024-11-28','2025-11-12 07:21:13','2025-11-12 07:21:13'),(123,'Gasti Mulyani','KW30476534','9600000','Lunas','Pembayaran cash sudah diterima.','2024-12-07','2025-11-12 07:21:13','2025-11-12 07:21:13'),(124,'Hasan Sihombing','KW58258734','3330000','Dibatalkan','Tagihan tidak valid.','2025-11-05','2025-11-12 07:21:13','2025-11-12 07:21:13'),(125,'Cawisadi Sihotang','KW26369328','4410000','Lunas','Pembayaran lunas tepat waktu.','2025-08-02','2025-11-12 07:21:13','2025-11-12 07:21:13'),(126,'Ade Maryati M.Farm','KW57829459','1350000','Dibatalkan','Tagihan tidak valid.','2025-02-27','2025-11-12 07:21:13','2025-11-12 07:21:13'),(127,'Jagaraga Latupono','KW29851703','9330000','Dibatalkan','Tagihan tidak valid.','2025-06-30','2025-11-12 07:21:13','2025-11-12 07:21:13'),(128,'Jagapati Salahudin','KW79103174','4030000','Dibatalkan','Tagihan tidak valid.','2025-10-22','2025-11-12 07:21:13','2025-11-12 07:21:13'),(129,'Ina Kuswandari','KW77943342','5250000','Dibatalkan','Kesalahan sistem.','2024-12-15','2025-11-12 07:21:13','2025-11-12 07:21:13'),(130,'Laila Paramita Haryanti S.E.I','KW30654500','3750000','Dibatalkan','Revisi tagihan diperlukan.','2025-08-26','2025-11-12 07:21:13','2025-11-12 07:21:13'),(131,'Dadap Luwar Nainggolan','KW93659749','7850000','Dibatalkan','Tagihan tidak valid.','2024-12-05','2025-11-12 07:21:13','2025-11-12 07:21:13'),(132,'Cahyo Ardianto','KW82650240','5660000','Lunas','Lunas melalui transfer bank.','2025-07-24','2025-11-12 07:21:13','2025-11-12 07:21:13'),(133,'Karsa Haryanto','KW38577949','1350000','Lunas','Pembayaran lunas tepat waktu.','2025-10-19','2025-11-12 07:21:13','2025-11-12 07:21:13'),(134,'Daru Adriansyah','KW87464854','4760000','Dibatalkan','Data tidak sesuai.','2025-09-29','2025-11-12 07:21:13','2025-11-12 07:21:13'),(135,'Rendy Chandra Sihombing','KW40503022','5290000','Lunas','Pembayaran lunas tepat waktu.','2025-03-24','2025-11-12 07:21:13','2025-11-12 07:21:13'),(136,'Gandi Nainggolan S.H.','KW27635205','960000','Dibatalkan','Data tidak sesuai.','2025-05-01','2025-11-12 07:21:13','2025-11-12 07:21:13'),(137,'Gasti Anggraini','KW88584011','2070000','Dibatalkan','Nasabah meminta pembatalan.','2025-03-17','2025-11-12 07:21:13','2025-11-12 07:21:13'),(138,'Ida Melani','KW75858415','4720000','Dibatalkan','Data tidak sesuai.','2025-01-22','2025-11-12 07:21:13','2025-11-12 07:21:13'),(139,'Opung Gunawan S.Pd','KW50600173','4520000','Lunas','Sudah dibayar penuh.','2025-10-07','2025-11-12 07:21:13','2025-11-12 07:21:13'),(140,'Laila Yulia Sudiati M.Ak','KW11844258','6510000','Dibatalkan','Kesalahan sistem.','2025-10-30','2025-11-12 07:21:13','2025-11-12 07:21:13'),(141,'Vicky Astuti','KW77502070','6070000','Dibatalkan','Revisi tagihan diperlukan.','2025-07-25','2025-11-12 07:21:13','2025-11-12 07:21:13'),(142,'Capa Mahendra','KW73967181','9090000','Dibatalkan','Dibatalkan atas permintaan nasabah.','2025-04-10','2025-11-12 07:21:13','2025-11-12 07:21:13'),(143,'Luis Suryono S.Pd','KW25924466','7740000','Lunas','Pembayaran lunas tepat waktu.','2025-08-21','2025-11-12 07:21:13','2025-11-12 07:21:13'),(144,'Siti Mandasari S.Ked','KW16349264','3750000','Dibatalkan','Dibatalkan karena kesalahan input.','2025-01-02','2025-11-12 07:21:13','2025-11-12 07:21:13'),(145,'Zelaya Puspita','KW64154619','7050000','Lunas','Sudah lunas, terima kasih.','2025-05-18','2025-11-12 07:21:13','2025-11-12 07:21:13'),(146,'Jamalia Usada','KW99561519','5900000','Dibatalkan','Tagihan tidak valid.','2024-12-08','2025-11-12 07:21:13','2025-11-12 07:21:13'),(147,'Anom Mangunsong','KW08736454','5190000','Lunas','Pembayaran lengkap diterima.','2025-04-23','2025-11-12 07:21:13','2025-11-12 07:21:13'),(148,'Shakila Elma Laksita S.E.I','KW09897320','9600000','Dibatalkan','Kesalahan sistem.','2025-06-05','2025-11-12 07:21:13','2025-11-12 07:21:13'),(149,'Indra Rafid Santoso','KW81857830','3190000','Lunas','Sudah dibayar penuh.','2025-02-24','2025-11-12 07:21:13','2025-11-12 07:21:13'),(150,'Sabar Cakrawala Dabukke S.Kom','KW83264064','9980000','Lunas','Lunas via mobile banking.','2025-10-15','2025-11-12 07:21:13','2025-11-12 07:21:13'),(151,'Uli Mulyani','KW45300465','3630000','Lunas','Sudah lunas, terima kasih.','2025-08-10','2025-11-12 07:21:13','2025-11-12 07:21:13'),(152,'Daru Wibisono','KW36300934','1960000','Dibatalkan','Dibatalkan atas permintaan nasabah.','2025-01-08','2025-11-12 07:21:13','2025-11-12 07:21:13'),(153,'Eja Baktiono Tamba S.Farm','KW11192613','5440000','Lunas','Pembayaran lunas tepat waktu.','2025-06-27','2025-11-12 07:21:13','2025-11-12 07:21:13'),(154,'Diah Yance Kuswandari M.Pd','KW31009218','1150000','Dibatalkan','Data tidak sesuai.','2025-09-20','2025-11-12 07:21:13','2025-11-12 07:21:13'),(155,'Nurul Rahmi Aryani','KW00982843','8980000','Lunas','Pembayaran lunas tepat waktu.','2025-01-21','2025-11-12 07:21:13','2025-11-12 07:21:13'),(156,'Yessi Anggraini','KW47977294','8700000','Lunas','Lunas via mobile banking.','2025-08-11','2025-11-12 07:21:13','2025-11-12 07:21:13'),(157,'Hilda Suartini','KW16272595','3120000','Lunas','Pembayaran lunas tepat waktu.','2025-01-28','2025-11-12 07:21:13','2025-11-12 07:21:13'),(158,'Jaswadi Lanang Nababan S.Sos','KW88998926','4460000','Dibatalkan','Nasabah meminta pembatalan.','2025-05-14','2025-11-12 07:21:13','2025-11-12 07:21:13'),(159,'Nova Aisyah Usada','KW69361551','8260000','Lunas','Lunas via mobile banking.','2025-06-25','2025-11-12 07:21:13','2025-11-12 07:21:13'),(160,'Victoria Purwanti','KW12407687','9490000','Lunas','Sudah lunas, terima kasih.','2025-04-20','2025-11-12 07:21:13','2025-11-12 07:21:13'),(161,'Parman Samosir','KW14092868','5040000','Dibatalkan','Tagihan tidak valid.','2025-07-11','2025-11-12 07:21:13','2025-11-12 07:21:13'),(162,'Dacin Hasta Widodo','KW58419575','9330000','Lunas','Lunas sesuai invoice.','2025-05-08','2025-11-12 07:21:13','2025-11-12 07:21:13'),(163,'Puspa Hastuti','KW25565377','9600000','Dibatalkan','Kesalahan sistem.','2025-04-15','2025-11-12 07:21:13','2025-11-12 07:21:13'),(164,'Nardi Digdaya Mustofa S.Kom','KW56177731','7730000','Dibatalkan','Nasabah meminta pembatalan.','2025-10-21','2025-11-12 07:21:13','2025-11-12 07:21:13'),(165,'Suci Winarsih','KW71078413','6560000','Dibatalkan','Data tidak sesuai.','2025-01-23','2025-11-12 07:21:13','2025-11-12 07:21:13'),(166,'Elvina Wahyuni','KW06059526','1200000','Dibatalkan','Revisi tagihan diperlukan.','2025-05-18','2025-11-12 07:21:13','2025-11-12 07:21:13'),(167,'Titin Pertiwi','KW80327954','6710000','Lunas','Pembayaran cash sudah diterima.','2025-02-23','2025-11-12 07:21:13','2025-11-12 07:21:13'),(168,'Ophelia Laksmiwati','KW41004401','3730000','Dibatalkan','Revisi tagihan diperlukan.','2025-02-03','2025-11-12 07:21:13','2025-11-12 07:21:13'),(169,'Dian Safitri M.Pd','KW25822763','9470000','Dibatalkan','Duplikasi data.','2025-07-14','2025-11-12 07:21:13','2025-11-12 07:21:13'),(170,'Silvia Queen Wijayanti','KW69128068','3660000','Lunas','Pembayaran lunas tepat waktu.','2025-02-13','2025-11-12 07:21:13','2025-11-12 07:21:13'),(171,'Luwes Wadi Uwais','KW26733059','5030000','Dibatalkan','Nasabah meminta pembatalan.','2025-05-12','2025-11-12 07:21:13','2025-11-12 07:21:13'),(172,'Puput Wulandari','KW70991474','9320000','Lunas','Lunas melalui transfer bank.','2025-01-22','2025-11-12 07:21:13','2025-11-12 07:21:13'),(173,'Zalindra Novitasari','KW48366890','5770000','Dibatalkan','Data tidak sesuai.','2025-08-09','2025-11-12 07:21:13','2025-11-12 07:21:13'),(174,'Eka Hidayat','KW00571197','1280000','Lunas','Pembayaran lunas tepat waktu.','2025-02-26','2025-11-12 07:21:13','2025-11-12 07:21:13'),(175,'Suci Almira Suryatmi','KW11133149','3910000','Lunas','Lunas via mobile banking.','2025-07-22','2025-11-12 07:21:13','2025-11-12 07:21:13'),(176,'Akarsana Cemeti Halim M.Farm','KW51345954','4060000','Lunas','Lunas sesuai invoice.','2024-12-26','2025-11-12 07:21:13','2025-11-12 07:21:13'),(177,'Titin Palastri','KW39482662','7100000','Lunas','Sudah dibayar penuh.','2025-04-25','2025-11-12 07:21:13','2025-11-12 07:21:13'),(178,'Estiono Maryadi Dongoran','KW12025855','4450000','Lunas','Pembayaran lengkap diterima.','2024-11-19','2025-11-12 07:21:13','2025-11-12 07:21:13'),(179,'Opan Prasasta','KW87714193','2040000','Lunas','Pembayaran lengkap diterima.','2025-07-21','2025-11-12 07:21:13','2025-11-12 07:21:13'),(180,'Enteng Thamrin M.TI.','KW86203646','8800000','Lunas','Pembayaran lunas tepat waktu.','2025-09-05','2025-11-12 07:21:13','2025-11-12 07:21:13'),(181,'Putri Nasyiah S.E.','KW07599092','610000','Dibatalkan','Dibatalkan atas permintaan nasabah.','2025-01-03','2025-11-12 07:21:13','2025-11-12 07:21:13'),(182,'Ayu Utami','KW79361139','4430000','Lunas','Pembayaran lunas tepat waktu.','2024-11-17','2025-11-12 07:21:13','2025-11-12 07:21:13'),(183,'Ophelia Yulianti','KW74076806','1880000','Dibatalkan','Revisi tagihan diperlukan.','2025-05-12','2025-11-12 07:21:13','2025-11-12 07:21:13'),(184,'Emas Mustofa','KW85764722','9480000','Lunas','Lunas sesuai invoice.','2025-11-05','2025-11-12 07:21:13','2025-11-12 07:21:13'),(185,'Cindy Mayasari','KW61745702','7270000','Dibatalkan','Dibatalkan karena kesalahan input.','2025-05-16','2025-11-12 07:21:13','2025-11-12 07:21:13'),(186,'Luis Saefullah','KW46682374','4150000','Lunas','Lunas via mobile banking.','2024-12-17','2025-11-12 07:21:13','2025-11-12 07:21:13'),(187,'Enteng Tamba','KW54681748','3730000','Dibatalkan','Tagihan tidak valid.','2024-12-04','2025-11-12 07:21:13','2025-11-12 07:21:13'),(188,'Clara Mulyani S.Psi','KW34262431','9200000','Dibatalkan','Duplikasi data.','2025-03-04','2025-11-12 07:21:13','2025-11-12 07:21:13'),(189,'Sabar Megantara','KW54094507','6850000','Lunas','Lunas sesuai invoice.','2025-08-16','2025-11-12 07:21:13','2025-11-12 07:21:13'),(190,'Asmianto Daruna Prayoga S.T.','KW81209710','2040000','Lunas','Pembayaran lengkap diterima.','2025-01-20','2025-11-12 07:21:13','2025-11-12 07:21:13'),(191,'Mahmud Cemplunk Simanjuntak S.Sos','KW34910662','9950000','Dibatalkan','Dibatalkan atas permintaan nasabah.','2025-10-30','2025-11-12 07:21:13','2025-11-12 07:21:13'),(192,'Bella Kartika Fujiati S.Kom','KW73099464','5480000','Dibatalkan','Dibatalkan atas permintaan nasabah.','2024-12-04','2025-11-12 07:21:13','2025-11-12 07:21:13'),(193,'Elma Kusmawati S.Pd','KW82485780','2630000','Lunas','Pembayaran lengkap diterima.','2025-03-20','2025-11-12 07:21:13','2025-11-12 07:21:13'),(194,'Taufik Wibisono','KW12478734','5590000','Lunas','Sudah lunas, terima kasih.','2025-03-04','2025-11-12 07:21:13','2025-11-12 07:21:13'),(195,'Zaenab Susanti M.Ak','KW13429844','1110000','Dibatalkan','Revisi tagihan diperlukan.','2025-02-04','2025-11-12 07:21:13','2025-11-12 07:21:13'),(196,'Murti Hakim','KW51548134','2890000','Lunas','Lunas via mobile banking.','2025-01-13','2025-11-12 07:21:13','2025-11-12 07:21:13'),(197,'Wahyu Sitompul','KW76885100','3940000','Dibatalkan','Duplikasi data.','2025-09-30','2025-11-12 07:21:13','2025-11-12 07:21:13'),(198,'Sakti Kusumo','KW79415614','5370000','Lunas','Lunas melalui transfer bank.','2025-05-26','2025-11-12 07:21:13','2025-11-12 07:21:13'),(199,'Irfan Bakda Utama','KW28198050','8260000','Dibatalkan','Duplikasi data.','2025-04-12','2025-11-12 07:21:13','2025-11-12 07:21:13'),(200,'Taufan Saragih','KW13793431','1470000','Dibatalkan','Kesalahan sistem.','2025-02-06','2025-11-12 07:21:13','2025-11-12 07:21:13'),(201,'Gatot Danu Rajasa M.Farm','KW96455770','2000000','Dibatalkan','Kesalahan sistem.','2025-11-05','2025-11-12 07:21:13','2025-11-12 07:21:13'),(202,'Talia Usamah','KW67680273','8420000','Lunas','Sudah lunas, terima kasih.','2024-12-29','2025-11-12 07:21:13','2025-11-12 07:21:13'),(203,'Gamani Kairav Suryono','KW42053099','740000','Lunas','Pembayaran cash sudah diterima.','2025-06-12','2025-11-12 07:21:13','2025-11-12 07:21:13'),(204,'Dian Maryati S.IP','KW06669838','850000','Lunas','Lunas melalui transfer bank.','2025-02-17','2025-11-12 07:21:13','2025-11-12 07:21:13'),(205,'Ismail Empluk Manullang','KW79353415','8700000','Dibatalkan','Revisi tagihan diperlukan.','2025-05-24','2025-11-12 07:21:13','2025-11-12 07:21:13'),(206,'Hendra Praba Situmorang','KW30225493','5250000','Dibatalkan','Tagihan tidak valid.','2025-07-23','2025-11-12 07:21:13','2025-11-12 07:21:13'),(207,'Elvina Haryanti','KW07732335','1700000','Dibatalkan','Data tidak sesuai.','2025-04-18','2025-11-12 07:21:13','2025-11-12 07:21:13'),(208,'Mahfud Legawa Anggriawan S.T.','KW81657182','3800000','Dibatalkan','Dibatalkan karena kesalahan input.','2025-08-29','2025-11-12 07:21:13','2025-11-12 07:21:13'),(209,'Yunita Hariyah','KW99201569','5460000','Dibatalkan','Duplikasi data.','2024-12-21','2025-11-12 07:21:13','2025-11-12 07:21:13'),(210,'Darsirah Respati Utama M.Pd','KW16527789','4010000','Dibatalkan','Data tidak sesuai.','2025-02-11','2025-11-12 07:21:13','2025-11-12 07:21:13'),(211,'Jefri Saragih','KW14303431','8090000','Dibatalkan','Dibatalkan karena kesalahan input.','2025-02-20','2025-11-12 07:21:13','2025-11-12 07:21:13'),(212,'Panji Jailani','KW65304172','8440000','Lunas','Pembayaran lengkap diterima.','2025-09-18','2025-11-12 07:21:13','2025-11-12 07:21:13'),(213,'Suci Halimah','KW29539238','4920000','Dibatalkan','Dibatalkan atas permintaan nasabah.','2025-08-19','2025-11-12 07:21:13','2025-11-12 07:21:13'),(214,'testing 21','KW5567842','456785','Dibatalkan','tes 21','2025-12-15','2025-11-12 11:50:11','2025-11-12 11:50:11'),(215,'testing 20','KW5567842','456785','Lunas','tes 20','2025-12-05','2025-11-12 11:50:46','2025-11-12 11:50:46'),(216,'testing 3','KW1234567890','1234567','Lunas',NULL,'2025-11-13','2025-11-12 12:23:45','2025-11-12 12:23:45');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_08_19_185520_create_reminders_table',1),(5,'2024_08_21_093743_create_history_table',1),(6,'2024_08_29_085545_create_email_notifications_table',1),(7,'2025_10_16_161333_create_password_reset_tokens_table',1),(8,'2025_10_16_161723_add_email_to_users_table',1),(9,'2025_11_12_161959_add_unique_constraint_to_reminders_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_reset_tokens_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reminders`
--

DROP TABLE IF EXISTS `reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reminders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `nama_nasabah` varchar(191) DEFAULT NULL,
  `nomor_kwitansi` varchar(191) DEFAULT NULL,
  `nominal_tagihan` int(11) DEFAULT NULL,
  `status_pembayaran` varchar(191) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_tagihan` date DEFAULT NULL,
  `is_canceled` tinyint(1) NOT NULL DEFAULT 0,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_reminder_constraint` (`nomor_kwitansi`,`nama_nasabah`,`tanggal_tagihan`),
  KEY `reminders_user_id_foreign` (`user_id`),
  CONSTRAINT `reminders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=288 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reminders`
--

LOCK TABLES `reminders` WRITE;
/*!40000 ALTER TABLE `reminders` DISABLE KEYS */;
INSERT INTO `reminders` VALUES (160,1,'testing 2','1234567890',1000000,'Pending','testing 2','2025-11-11',0,0,'2025-11-09 18:45:31','2025-11-09 18:45:31'),(161,NULL,'Bella Laksmiwati','KW42243483',4570000,'Pending','Pembayaran tertunda.','2025-12-15',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(162,NULL,'Ratih Purnawati','KW15646334',5190000,'Pending','Pembayaran dalam proses verifikasi.','2026-01-13',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(163,NULL,'Ridwan Ozy Prakasa S.Gz','KW78634224',8900000,'Pending','Menunggu transfer dari nasabah.','2025-12-12',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(164,NULL,'Luhung Prayoga Hutasoit','KW99940292',9210000,'Pending','Belum ada konfirmasi pembayaran.','2025-12-13',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(165,NULL,'Abyasa Asmianto Situmorang S.Pt','KW84435133',5540000,'Pending','Pembayaran dalam proses verifikasi.','2025-11-19',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(166,NULL,'Eka Irawan','KW66443443',6740000,'Pending','Tagihan belum dibayar.','2025-11-18',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(167,NULL,'Elon Simbolon','KW47855002',2710000,'Pending','Menunggu konfirmasi pembayaran.','2026-01-11',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(168,NULL,'Mila Laksita','KW70983445',4270000,'Pending','Pembayaran dalam proses verifikasi.','2026-01-05',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(169,NULL,'Slamet Raharja Winarno S.Ked','KW03800812',8180000,'Pending','Menunggu transfer dari nasabah.','2026-01-11',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(170,NULL,'Winda Handayani','KW85344438',6680000,'Pending','Mohon segera dilunasi.','2026-01-14',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(171,NULL,'Enteng Aris Prasasta','KW09862944',1850000,'Pending','Segera lakukan pembayaran.','2026-01-14',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(172,NULL,'Darijan Mariadi Salahudin','KW64724061',4310000,'Pending','Menunggu konfirmasi pembayaran.','2025-11-18',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(173,NULL,'Martana Emil Wahyudin M.Kom.','KW04839082',2110000,'Pending','Pembayaran tertunda.','2025-11-16',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(174,NULL,'Genta Novitasari','KW65502307',5640000,'Pending','Pembayaran tertunda.','2025-11-19',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(175,NULL,'Makuta Narpati','KW02693831',4700000,'Pending','Menunggu pelunasan.','2026-01-13',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(176,NULL,'Dwi Mandala','KW43756596',8260000,'Pending','Pembayaran tertunda.','2025-11-17',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(177,NULL,'Mulyono Anggabaya Hardiansyah M.Farm','KW21291892',4170000,'Pending','Tagihan jatuh tempo segera.','2026-01-09',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(178,NULL,'Tugiman Setiawan','KW55934879',8660000,'Pending','Tagihan belum dibayar.','2026-01-13',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(179,NULL,'Patricia Wulan Suryatmi S.T.','KW01797811',640000,'Pending','Tagihan jatuh tempo segera.','2025-12-09',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(180,NULL,'Jasmin Puspasari','KW20750082',8410000,'Pending','Tagihan belum dibayar.','2025-11-17',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(181,NULL,'Zalindra Pudjiastuti S.E.I','KW48902618',3720000,'Pending','Pembayaran tertunda.','2025-12-13',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(182,NULL,'Anita Laksita','KW59606512',3950000,'Pending','Menunggu konfirmasi pembayaran.','2025-12-16',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(183,NULL,'Ida Lailasari','KW18576808',9890000,'Pending','Menunggu pelunasan.','2026-01-04',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(184,NULL,'Emil Hakim S.Sos','KW22503747',3640000,'Pending','Menunggu konfirmasi pembayaran.','2025-11-18',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(185,NULL,'Amelia Pudjiastuti','KW77356829',4820000,'Pending','Pembayaran tertunda.','2025-11-15',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(186,NULL,'Rahman Kasim Adriansyah M.M.','KW57981656',3620000,'Pending','Tagihan belum dibayar.','2026-01-05',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(187,NULL,'Rangga Endra Suwarno M.M.','KW05723816',3440000,'Pending','Tagihan belum dibayar.','2026-01-13',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(188,NULL,'Pardi Saputra','KW87561664',2400000,'Pending','Mohon segera dilunasi.','2025-11-17',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(189,NULL,'Rahmat Pradana S.H.','KW50837179',530000,'Pending','Pembayaran dalam proses verifikasi.','2025-11-16',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(190,NULL,'Hasim Setiawan','KW49965770',2490000,'Pending','Menunggu transfer dari nasabah.','2025-12-12',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(191,NULL,'Alika Namaga S.Pd','KW36754419',5380000,'Pending','Belum ada konfirmasi pembayaran.','2025-11-15',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(192,NULL,'Unjani Zaenab Melani','KW26693877',3910000,'Pending','Tagihan jatuh tempo segera.','2025-11-16',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(193,NULL,'Rachel Yulianti','KW89238363',3970000,'Pending','Pembayaran dalam proses verifikasi.','2026-01-04',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(194,NULL,'Darimin Estiawan Kusumo M.Pd','KW38353481',9910000,'Pending','Segera lakukan pembayaran.','2025-11-18',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(195,NULL,'Karsana Narji Wacana','KW12904455',1070000,'Pending','Tagihan belum dibayar.','2025-12-09',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(196,NULL,'Wadi Widodo','KW03647498',1930000,'Pending','Tagihan belum dibayar.','2025-12-04',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(197,NULL,'Farah Rahmawati','KW64996920',9940000,'Pending','Menunggu konfirmasi pembayaran.','2025-11-18',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(198,NULL,'Mulya Utama','KW90857701',9000000,'Pending','Menunggu konfirmasi pembayaran.','2025-12-03',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(199,NULL,'Danuja Prayoga','KW74646133',5160000,'Pending','Menunggu pelunasan.','2026-01-16',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(200,NULL,'Hafshah Suryatmi','KW03877385',8440000,'Pending','Menunggu transfer dari nasabah.','2025-11-17',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(201,NULL,'Pangestu Thamrin','KW03837974',1570000,'Pending','Mohon segera dilunasi.','2025-12-14',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(202,NULL,'Mahmud Sihotang','KW72566908',1280000,'Pending','Mohon segera dilunasi.','2025-12-03',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(203,NULL,'Puspa Jamalia Mardhiyah M.Farm','KW78411074',3650000,'Pending','Tagihan jatuh tempo segera.','2025-11-16',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(204,NULL,'Kemal Hutapea S.H.','KW13914302',9200000,'Pending','Pembayaran dalam proses verifikasi.','2026-01-10',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(205,NULL,'Kanda Jaeman Lazuardi M.Farm','KW60792313',8300000,'Pending','Pembayaran tertunda.','2025-12-03',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(206,NULL,'Cakrabirawa Sihombing S.E.','KW76055914',5830000,'Pending','Mohon segera dilunasi.','2026-01-02',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(207,NULL,'Dodo Martana Ardianto M.Pd','KW67128131',7720000,'Pending','Pembayaran tertunda.','2025-12-10',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(208,NULL,'Gilang Tampubolon M.TI.','KW48369713',8490000,'Pending','Pembayaran tertunda.','2025-11-19',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(209,NULL,'Kusuma Zulkarnain S.E.I','KW12596978',3450000,'Pending','Belum ada konfirmasi pembayaran.','2025-12-06',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(210,NULL,'Hamzah Nashiruddin','KW38815648',1270000,'Pending','Menunggu konfirmasi pembayaran.','2026-01-01',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(211,NULL,'Puti Hariyah','KW40538180',9690000,'Pending','Pembayaran dalam proses verifikasi.','2025-12-08',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(212,NULL,'Mutia Handayani','KW06950931',3080000,'Pending','Belum ada konfirmasi pembayaran.','2026-01-15',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(213,NULL,'Hasan Latupono','KW53938596',1490000,'Pending','Menunggu konfirmasi pembayaran.','2026-01-13',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(214,NULL,'Ajimin Sitorus','KW60216836',9840000,'Pending','Menunggu konfirmasi pembayaran.','2025-11-15',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(215,NULL,'Asmuni Darmaji Prasetya S.Ked','KW14749888',4990000,'Pending','Segera lakukan pembayaran.','2026-01-04',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(216,NULL,'Rahmat Hidayat','KW55057248',5010000,'Pending','Menunggu pelunasan.','2025-11-15',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(217,NULL,'Jayadi Mujur Zulkarnain','KW22856481',3300000,'Pending','Pembayaran tertunda.','2025-12-05',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(218,NULL,'Kurnia Mustofa S.Pd','KW84369246',7050000,'Pending','Menunggu konfirmasi pembayaran.','2025-11-19',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(219,NULL,'Murti Pangestu S.T.','KW86283666',5510000,'Pending','Menunggu pelunasan.','2025-12-15',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(220,NULL,'Kemba Ajimat Siregar','KW64076044',6010000,'Pending','Belum ada konfirmasi pembayaran.','2026-01-01',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(221,NULL,'Amelia Farida','KW29481686',7060000,'Pending','Segera lakukan pembayaran.','2026-01-10',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(222,NULL,'Uchita Yuliarti','KW61053704',3180000,'Pending','Menunggu konfirmasi pembayaran.','2025-12-03',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(223,NULL,'Widya Laksmiwati','KW18499379',5740000,'Pending','Menunggu transfer dari nasabah.','2026-01-10',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(224,NULL,'Paris Diah Yolanda','KW31031433',5080000,'Pending','Belum ada konfirmasi pembayaran.','2026-01-08',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(225,NULL,'Elon Habibi S.IP','KW09853062',7750000,'Pending','Segera lakukan pembayaran.','2025-12-10',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(226,NULL,'Liman Hutagalung S.IP','KW89974672',2210000,'Pending','Pembayaran tertunda.','2025-11-17',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(227,NULL,'Luwar Firmansyah','KW36956095',6550000,'Pending','Tagihan belum dibayar.','2025-11-18',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(228,NULL,'Dodo Wacana','KW64201994',9270000,'Pending','Belum ada konfirmasi pembayaran.','2025-12-07',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(229,NULL,'Karman Waskita','KW76288503',740000,'Pending','Segera lakukan pembayaran.','2026-01-10',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(230,NULL,'Novi Ani Uyainah','KW00316601',2350000,'Pending','Mohon segera dilunasi.','2025-11-19',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(231,NULL,'Edward Narpati','KW11445391',6220000,'Pending','Mohon segera dilunasi.','2025-11-18',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(232,NULL,'Nova Maryati','KW62458680',7150000,'Pending','Tagihan belum dibayar.','2025-11-18',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(233,NULL,'Belinda Nasyiah','KW34036595',6650000,'Pending','Menunggu transfer dari nasabah.','2026-01-02',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(234,NULL,'Ellis Kani Mardhiyah','KW95089263',3200000,'Pending','Segera lakukan pembayaran.','2025-11-16',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(235,NULL,'Lili Susanti','KW99951864',6350000,'Pending','Menunggu konfirmasi pembayaran.','2026-01-06',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(236,NULL,'Kunthara Haryanto S.IP','KW33430554',9970000,'Pending','Segera lakukan pembayaran.','2026-01-01',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(237,NULL,'Kamaria Yuliarti','KW88313351',4150000,'Pending','Menunggu konfirmasi pembayaran.','2025-11-19',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(238,NULL,'Lidya Laila Handayani','KW82981137',2490000,'Pending','Segera lakukan pembayaran.','2025-12-13',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(239,NULL,'Ega Dabukke S.Farm','KW98904733',7290000,'Pending','Menunggu pelunasan.','2026-01-03',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(240,NULL,'Jarwa Kusumo','KW07901237',950000,'Pending','Mohon segera dilunasi.','2025-12-13',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(241,NULL,'Dina Juli Lailasari','KW49922981',690000,'Pending','Tagihan belum dibayar.','2025-12-02',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(242,NULL,'Rachel Farida','KW16392528',2060000,'Pending','Menunggu konfirmasi pembayaran.','2025-11-19',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(243,NULL,'Kayun Kusumo','KW27250141',7410000,'Pending','Mohon segera dilunasi.','2025-11-19',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(244,NULL,'Nalar Rajata','KW37869207',6390000,'Pending','Menunggu pelunasan.','2025-11-17',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(245,NULL,'Wisnu Pradipta','KW85170650',4420000,'Pending','Menunggu pelunasan.','2025-11-19',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(246,NULL,'Karman Ardianto','KW94308925',5270000,'Pending','Mohon segera dilunasi.','2026-01-13',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(247,NULL,'Anita Riyanti','KW54414122',7820000,'Pending','Mohon segera dilunasi.','2025-12-11',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(248,NULL,'Hasna Restu Wulandari','KW29584725',3900000,'Pending','Belum ada konfirmasi pembayaran.','2025-11-18',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(249,NULL,'Vera Pudjiastuti S.Kom','KW01902762',9480000,'Pending','Belum ada konfirmasi pembayaran.','2025-11-16',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(250,NULL,'Kanda Luhung Nainggolan','KW43266942',9800000,'Pending','Segera lakukan pembayaran.','2025-12-08',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(251,NULL,'Rachel Rahmawati','KW54989047',3910000,'Pending','Tagihan belum dibayar.','2025-11-17',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(252,NULL,'Putri Nadine Hartati','KW10706297',3690000,'Pending','Menunggu transfer dari nasabah.','2025-12-02',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(253,NULL,'Adiarja Wijaya','KW34196823',1600000,'Pending','Tagihan belum dibayar.','2026-01-10',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(254,NULL,'Zamira Anggraini','KW66222206',6100000,'Pending','Mohon segera dilunasi.','2025-12-05',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(255,NULL,'Nadia Utami','KW04501519',6810000,'Pending','Pembayaran tertunda.','2025-12-15',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(256,NULL,'Vino Pangestu','KW34072672',5730000,'Pending','Mohon segera dilunasi.','2025-12-17',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(257,NULL,'Akarsana Agus Wibisono','KW14646128',3640000,'Pending','Pembayaran tertunda.','2025-12-05',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(258,NULL,'Mursita Simanjuntak','KW65612830',7290000,'Pending','Pembayaran dalam proses verifikasi.','2025-11-15',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(259,NULL,'Jindra Waskita','KW58833106',9440000,'Pending','Pembayaran tertunda.','2025-11-19',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(260,NULL,'Bella Wulandari S.I.Kom','KW46643691',8080000,'Pending','Menunggu pelunasan.','2025-12-09',0,0,'2025-11-12 07:20:33','2025-11-12 07:20:33'),(265,1,'testing 4','KW1231123123',1231231,'Pending','testing 4','2025-11-14',0,0,'2025-11-12 08:13:45','2025-11-12 08:13:45'),(266,1,'testing 5','KW5567842',456785,'Pending','testing 5','2025-11-16',0,0,'2025-11-12 08:31:42','2025-11-12 08:31:42'),(267,1,'testing 6','KW5567842',456785,'Pending',NULL,'2025-11-16',0,0,'2025-11-12 08:31:57','2025-11-12 08:31:57'),(268,1,'testing 7','KW5567842',456785,'Pending',NULL,'2025-11-16',0,0,'2025-11-12 08:32:17','2025-11-12 08:32:17'),(269,1,'testing 8','KW5567842',456785,'Pending',NULL,'2025-11-20',0,0,'2025-11-12 08:33:32','2025-11-12 08:33:32'),(270,1,'testing 9','KW5567842',456785,'Pending',NULL,'2025-11-28',0,0,'2025-11-12 08:33:46','2025-11-12 08:33:46'),(271,1,'testing 10','KW5567842',456785,'Pending','tes','2025-11-28',0,0,'2025-11-12 08:34:00','2025-11-12 08:34:00'),(272,1,'testing 11','KW5567842',456785,'Pending',NULL,'2025-11-28',0,0,'2025-11-12 08:56:15','2025-11-12 08:56:15'),(273,1,'testing 12','KW5567842',456785,'Pending',NULL,'2025-11-28',0,0,'2025-11-12 08:56:42','2025-11-12 08:56:42'),(276,1,'testing 13','KW5567842',456785,'Pending','tes','2025-11-21',0,0,'2025-11-12 08:58:22','2025-11-12 08:58:22'),(277,1,'testing 14','KW5567842',456785,'Pending','testing','2025-11-23',0,0,'2025-11-12 08:58:55','2025-11-12 08:58:55'),(278,1,'testing 15','KW5567842',456785,'Pending','tes','2025-12-24',0,0,'2025-11-12 09:09:04','2025-11-12 09:09:04'),(279,1,'testing 16','KW5567842',456785,'Pending','tes 16','2025-12-01',0,0,'2025-11-12 09:09:36','2025-11-12 09:09:36'),(280,1,'testing 17','KW5567842',456785,'Pending','tes 17','2025-12-02',0,0,'2025-11-12 09:11:54','2025-11-12 09:11:54'),(281,1,'testing 18','KW5567842',456785,'Pending','tes 18','2025-12-03',0,0,'2025-11-12 09:32:37','2025-11-12 09:32:37'),(282,1,'testing 19','KW5567842',456785,'Pending','tes 19','2025-12-04',0,0,'2025-11-12 09:33:03','2025-11-12 09:33:03'),(287,1,'testing 22','KW5567842',456785,'Pending','tes 22','2025-11-13',0,0,'2025-11-12 12:47:37','2025-11-12 12:47:37');
/*!40000 ALTER TABLE `reminders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('1370oCmZQZOV4cHJcnRiVdceVRS99ZXEa1BorCPC',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0','ZXlKcGRpSTZJbFJ1TmxOUk9EbHpObTh5UkVSTFozZFNNR1ZITldjOVBTSXNJblpoYkhWbElqb2lNRWxTVkV0VFlVZGhTa3BrWmxWTlNuRlBWakZ0WVhaTkwxWXpVVnBDVmxoWFMxWTFhV3d5VTFkaFdua3ZNM2RMZG5WM1NIZFdWME5rVFcxbldsZEJOeTlhU2xGSU5pdFVOblZ4Y1ROMk9UTklSWFZyUTIxVmF6WnFWWFJRWVhGNmNucHhkMHRsVjFWWWVraHFTVlZOUjNOa2RqUldabmRzY0UxcFpUbDBSM2xSYTB0d1dVMHpXVXgzUW1wdmExZEJkelJJT0dOVFZVNDFVbVZxZDJOVVRpdHhOVTAzVlRReGNHeFlZeXRKY2pOVFFUQldiMnByTVZWbVoxSjZOVEoyVlhJM1FXbFFNRVF5WTJ4U2R6VldZMFpsZDJvMWJ6UjVRVkpKVDNZelpYTjJlVVZpTW5kTVRURlplSEpIWkUxTFIyOHlVRzVrYVhKeFJuWkpaR1JrU0VrNVpWSm9PRU5pTjJ4MGRHWktNazVvWWtWSllqbFJNVFZqY0dGMk0zZHRZMmwzUkd0RVFteE9UMUpRTlcxcVFrcHNRemhGYjJoVlJqZzRlakk0WVVNM1pDdHFWV3g0YUVSUlpXbFdlazlxV20wMmJsWTFibWhyUVVaMGNGaGhSRVZzTlVWb2IxUkJSbmxKVWtNNGExaGxVMUJJVWxSbWExVXpkbVJ2ZDBoNUlpd2liV0ZqSWpvaU1UUmtORGxsWWpjMllqQXpPV1ExT0dKaE1tSmlNamczTkRVek9XSTNOV1U0TnpNMk5qYzVOVEV4WXpobVpERTROek5oWkdObE5qazBNV1F5TkdZMU9TSXNJblJoWnlJNklpSjk=',1762950082),('l7Em9e1bCvygSFfUA5w9EN9mJsBfRqLpn5OTK51E',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0','ZXlKcGRpSTZJbEZsVVZCSVVraG1kbUozVm5sM09WQndWekZXYmtFOVBTSXNJblpoYkhWbElqb2ljRFo1ZVRKeVRTOUZaRXBsVlRoc09VUmhaRWs0UVVVeGVGcDRTRnBrVUZkc2IzSjRkMWhETVZwQmJVbzVjbEZUV2pCRFUyaEhRV1JIYmxFME1ITXdOVXRHVkhGcFNXbGhRV0phZDBGWk1XeE1ZM2h2V25wV1NrTlZUalIzTTFoVVNTOHJRWGxtY25CNWExQlpWV1pTU1UxSlZIRXJOMjF3ZEUxTlpqbE9OMk5hUTFkMVZFOTNjVUppUVhKNUswazRSWFJaVFhSR2JDczFkako1UmpoTmRtUjBkMk5hUzJKR1EyOU5lbVVyTDNGdmRrcEtaVlJRVkhCelltcE9SRGRFVURack5VdEdXamRNV1VKWlJFMXNMM1JPTm5rNVNVOWllamxTTjNsd0szcFBTWFJ2VlhWUGNDc3pSMHRXYjNGNVlqRm5TMk5uVjNNdlFqaFZXU3RpVXpCRE4zZDVTMWR0Y2xsblNYZHZRMGh1U2s1SmVHeHlOSE12Ymk5alVIVXJWbmwzUkVSTFoxZGpha05LZFhaV1EzcGhaVzVrUkRaUE0zWnBjVU5oWjNraUxDSnRZV01pT2lJM1kyWmlPR1ZqTlRobE1XVmlNVEZpWVRGaVl6WTNaalptWTJGaE1HWm1PR0pqWVdaaFkyTmlOek0wTVRNNE1UTmhZbVV5TTJJeU1tSmtOalEyWTJNeklpd2lkR0ZuSWpvaUluMD0=',1763041733),('onCdbfg2yLiihc7iRebebo1bpz6cQbulECNYc1Vp',1,'127.0.0.1','Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Mobile Safari/537.36 Edg/142.0.0.0','ZXlKcGRpSTZJa1JMVWpCelRUSjBNeXR1WlRWVmJDdFBVM1owY0VFOVBTSXNJblpoYkhWbElqb2liekI0VTIxM1ZtMVFTelV6UW5KSk9FOXJMMXBHV1V4elUySjBTMnBUTVU4ek1rVmFaMmxwWm1jMFRHSmtVWE0yTUU5MFdFSjZPRWRQTlRGaWVHMTJORFJuYkZkQ1NYRnVUMjVZTW5SbE5EZG9Sa3MyTldoV2QybEJXbTFrSzBOR1ZXc3JVRVJIZEhaQ1JHODNiRFJqTUdwTVNEQTVWa2RMZDFGd2FqaEJNalpwWm14RWJuaENNMFp1WlVvemFGUjZNVlE0ZVVkRVIzWTFjRnBDVTJoaE4yWTBiM1UyTlVwblRWQkhhMWhITTJsWU1YVm1UbUV5Y0haS1lpdG1lamRNVUVKV1UxbGxkVk5VZG14WmJ6QkdUVEYzYTFVMWFsZFFiMFJvYVdkV2NXTnNOWHByVG5abEwzWk9WbkYwUlZSbVltUllReTk1TjB4Q1RXVlpNbXBTYW5GeFNXRnVNbVZIVldFM2MycHdaek5YV1c5ak1VdDRaVEZ0ZUdrMVVXZzVaRGx5ZUVoeFozWkplazAxZDBKalNFVXdaR0p6VjA1MlZrOUhkVTVXUkZaRFRrWXdWamxLYkVSMk5YRkJNbGt3WjJKVVowYzRlbmhvVjA4cmFUa3dheTh5VGxkWFRHRTFWR1l5V0hjMGJrTnJVME54WkRNdk16UjZRMVZUVTNoWE4xTjNPWE5GY2paUmEwY3JOM2hGU21vek0yZHNRVDA5SWl3aWJXRmpJam9pWTJOak16Tm1OekJsTTJJek0yTmtPV00yTlRjeVlUZGtOekV6TXpBeE4yWTVaV1V5TkRJNE5HWTBZVFk1TUdNNVltUmhaREprTUdRMllqVm1OVEV3WkNJc0luUmhaeUk2SWlKOQ==',1762952867),('SgpZuytFvA0xvR2Fz3iVqifyNnA2WQruuXgcq88G',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0','ZXlKcGRpSTZJbTl5UkVWSU9YZHJhMFlyWTAxaE4wTndjVFptYUdjOVBTSXNJblpoYkhWbElqb2liVUZtZG5wRk56bEdRamRaUVRWeVkyaFNOa2hyTkV0cVowTXZRbGw2U0hCUlZsVm9URlV2WTFaSlowMHdjVmR4TW5oRFVFZFhieTg0VDJZemExb3dORFV2ZHk5Q1FuQnRWRVkyYTFoVVRYaFhTV3BQVm1vMU4zcFlXV1p4TUVKb1NVSkdiMHMyZFZBeFRGTnVUVUZET0haYWRHMVlTRTkyZGxsUFZYSlVhSEpZZWtGR2ExVXpXRGh5Wm1OelZqaFRaMk56U0hoamVYSnRVMmd5YkhSS1drMXVVa0ZOZEV0a1oxZG5aV05hZVZFNE1sVlJSemRtYWpaek1saEZVakpRTW1GUFRHNUpXVmgwTWxVNFEyOUZNMVpYUVdVclJubFpRamRTSzJwcVJHY3pOVEZCTTIwd1pXb3dNVWg0VUVOT2RtVkdVbnB2ZG1kdlVVUjRVbWhwVTBGdmMxSTJiVFEzU0VjNVVFWlpiemh4ZEdGaWRGSjJOMmxuTnk5UWN5OVJNV0kwTjAxMWNsQlNlSEZOYkhoSlRIQjFhVVl6VVdKdFMzcENWbVUyV0hRek9WbFFRVEowUW1oVFlUZDBOakJXWTJGR2JWaHlhRlpNUkROMUwzVnhjR0ZhUm10eE1HRnVTbm8yWkUwM1EySmtVMnhHUTFSaFFXUXJRelZzZFdSdU1VOHdjek5SUzJOU1ZsUTVjRWRJYzA1cU1rWmFiaTh4UzNCQ1dtaDBUMkUxUVRVeFVYVjFZblExV2taNGVtbE1TWFo0VkVwNFkwSk1OVkZYVGxCVFRWRnlWMmh3ZUZSWGVFaFBRbnBCUTI5Q1UxcGtZek16Y0c4MGJXbHVOR05DTlhOSGQxVkNkV3RyVFZrOUlpd2liV0ZqSWpvaU4yVXpOV05tTkRKa016aGxNRFprTnpJMk5UUTBPR05rWXpjNU1qRTBOR0ZpTkRZNE1UQmhaVEUwT0RZeVpUVXlNemhsTjJKa1pqRXlNMlkyWldaalppSXNJblJoWnlJNklpSjk=',1762950019);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `terakhir_login` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Keuangan','keuangandn01','deninugrahakantornotaris@gmail.com','$2y$12$Vbzihtqt3MAmofA4qKekD.PPrcfbIaqAtC8QBtetHlrDacM4NGcJG','2025-11-12 12:21:30',NULL,'2025-10-16 09:23:34','2025-11-12 12:21:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'website_dn'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-13 21:32:30
