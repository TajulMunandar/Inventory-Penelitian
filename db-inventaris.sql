-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table inventaris-gubsu-mt.barangs
DROP TABLE IF EXISTS `barangs`;
CREATE TABLE IF NOT EXISTS `barangs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kategori` bigint unsigned NOT NULL,
  `deskripsi_barang` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_pengadaan` year DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `barangs_kode_barang_unique` (`kode_barang`),
  UNIQUE KEY `barangs_serial_number_unique` (`serial_number`),
  KEY `barangs_id_kategori_foreign` (`id_kategori`),
  CONSTRAINT `barangs_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategoris` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventaris-gubsu-mt.barangs: ~16 rows (approximately)
REPLACE INTO `barangs` (`id`, `kode_barang`, `id_kategori`, `deskripsi_barang`, `serial_number`, `lokasi_user`, `tahun_pengadaan`, `keterangan`, `kondisi_barang`, `status`, `created_at`, `updated_at`) VALUES
	(1, '345974', 5, 'HDMI', '54596922', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:58:10'),
	(2, '352909', 6, 'HDMI', '91328151', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(3, '788001', 3, 'Switch', '84724922', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(4, '696478', 7, 'Laptop', '72228056', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(5, '657025', 3, 'Switch', '10729206', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(6, '301637', 6, 'HDMI', '34491776', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(7, '676589', 5, 'Switch', '44630997', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(8, '141255', 3, 'HDMI', '31668507', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(9, '793816', 7, 'Laptop', '43391687', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(10, '473220', 1, 'Switch', '47397052', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(11, '652184', 1, 'MIC', '48962803', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(12, '155020', 5, 'Laptop', '43256194', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(13, '115683', 6, 'MIC', '58033384', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(14, '613092', 6, 'HDMI', '59023608', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(15, '928221', 1, 'Switch', '42770965', 'TIK', '2020', '', 'Baik', 0, '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(16, '765434', 4, 'Kertas A4', '1234', 'TIK', NULL, NULL, 'Baik', 1, '2023-05-31 01:57:04', '2023-05-31 01:57:26');

-- Dumping structure for table inventaris-gubsu-mt.detailpeminjamans
DROP TABLE IF EXISTS `detailpeminjamans`;
CREATE TABLE IF NOT EXISTS `detailpeminjamans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_peminjaman` bigint unsigned NOT NULL,
  `id_barang` bigint unsigned NOT NULL,
  `status_detail` tinyint(1) NOT NULL,
  `hbs_pakai` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detailpeminjamans_id_peminjaman_foreign` (`id_peminjaman`),
  KEY `detailpeminjamans_id_barang_foreign` (`id_barang`),
  CONSTRAINT `detailpeminjamans_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barangs` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `detailpeminjamans_id_peminjaman_foreign` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjamans` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventaris-gubsu-mt.detailpeminjamans: ~2 rows (approximately)
REPLACE INTO `detailpeminjamans` (`id`, `id_peminjaman`, `id_barang`, `status_detail`, `hbs_pakai`, `created_at`, `updated_at`) VALUES
	(1, 1, 16, 1, 1, '2023-05-31 01:57:26', '2023-05-31 01:57:26'),
	(2, 2, 1, 0, 0, '2023-05-31 01:58:00', '2023-05-31 01:58:10');

-- Dumping structure for table inventaris-gubsu-mt.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventaris-gubsu-mt.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table inventaris-gubsu-mt.kategoris
DROP TABLE IF EXISTS `kategoris`;
CREATE TABLE IF NOT EXISTS `kategoris` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventaris-gubsu-mt.kategoris: ~9 rows (approximately)
REPLACE INTO `kategoris` (`id`, `kategori`, `created_at`, `updated_at`) VALUES
	(1, 'Tool Network', '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(2, 'Storage', '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(3, 'Multimedia', '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(4, 'Habis Pakai', '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(5, 'PC', '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(6, 'Access Point', '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(7, 'Switch', '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(8, 'Router', '2023-05-31 01:45:40', '2023-05-31 01:45:40'),
	(10, 'Server', '2023-05-31 02:10:54', '2023-05-31 02:11:07');

-- Dumping structure for table inventaris-gubsu-mt.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventaris-gubsu-mt.migrations: ~8 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_04_06_031113_create_kategoris_table', 1),
	(6, '2023_04_06_031121_create_barangs_table', 1),
	(7, '2023_04_06_031129_create_peminjamans_table', 1),
	(8, '2023_05_14_150524_create_detailpeminjamans_table', 1);

-- Dumping structure for table inventaris-gubsu-mt.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventaris-gubsu-mt.password_resets: ~0 rows (approximately)

-- Dumping structure for table inventaris-gubsu-mt.peminjamans
DROP TABLE IF EXISTS `peminjamans`;
CREATE TABLE IF NOT EXISTS `peminjamans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime DEFAULT NULL,
  `nama_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventaris-gubsu-mt.peminjamans: ~2 rows (approximately)
REPLACE INTO `peminjamans` (`id`, `tgl_pinjam`, `tgl_kembali`, `nama_peminjam`, `bidang`, `keterangan`, `created_at`, `updated_at`) VALUES
	(1, '2023-05-31 08:57:26', NULL, 'Puput', 'TIK', 'Keperluan Acara', '2023-05-31 01:57:26', '2023-05-31 01:57:26'),
	(2, '2023-05-31 08:58:00', '2023-05-31 08:58:10', 'Puput', 'TIK', 'Keperluan Acara', '2023-05-31 01:58:00', '2023-05-31 01:58:10');

-- Dumping structure for table inventaris-gubsu-mt.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventaris-gubsu-mt.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table inventaris-gubsu-mt.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table inventaris-gubsu-mt.users: ~1 rows (approximately)
REPLACE INTO `users` (`id`, `nama`, `username`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Shanon Kuhn Sr.', 'admin', '2023-05-31 01:45:40', '$2y$10$3CpyPmLnvKTLAFn565Q1Au8QjbxIS.bx8.ydgXIzs3tMmKvfUy4V6', 1, 'OAbnCcewZDjwNkc7T31pX1w4YZWtOycx0J0dagmGyc7L6mMcv05Ma55LV2fn', '2023-05-31 01:45:40', '2023-05-31 01:45:40');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
