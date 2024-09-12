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

-- Dumping structure for table procure_ware_db.deliveries
CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `delivery_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deliveries_purchase_id_foreign` (`purchase_id`),
  KEY `deliveries_user_id_foreign` (`user_id`),
  CONSTRAINT `deliveries_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE,
  CONSTRAINT `deliveries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table procure_ware_db.deliveries: ~1 rows (approximately)
INSERT INTO `deliveries` (`id`, `purchase_id`, `user_id`, `delivery_date`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, '2024-09-12', '2024-09-12 10:47:24', '2024-09-12 10:47:24');

-- Dumping structure for table procure_ware_db.delivery_items
CREATE TABLE IF NOT EXISTS `delivery_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` bigint unsigned NOT NULL,
  `supplier_id` bigint unsigned NOT NULL,
  `arrival_date` date NOT NULL,
  `quantity` int NOT NULL,
  `condition` enum('good','bad') COLLATE utf8mb4_unicode_ci NOT NULL,
  `unique_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `delivery_items_unique_code_unique` (`unique_code`),
  KEY `delivery_items_delivery_id_foreign` (`delivery_id`),
  KEY `delivery_items_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `delivery_items_delivery_id_foreign` FOREIGN KEY (`delivery_id`) REFERENCES `deliveries` (`id`) ON DELETE CASCADE,
  CONSTRAINT `delivery_items_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table procure_ware_db.delivery_items: ~1 rows (approximately)
INSERT INTO `delivery_items` (`id`, `delivery_id`, `supplier_id`, `arrival_date`, `quantity`, `condition`, `unique_code`, `storage_location`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, '2024-09-12', 100, 'good', 'CODE-19F722B1', 'Ruangan 1', '2024-09-12 10:47:41', '2024-09-12 10:47:41');

-- Dumping structure for table procure_ware_db.failed_jobs
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

-- Dumping data for table procure_ware_db.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table procure_ware_db.materials
CREATE TABLE IF NOT EXISTS `materials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `materials_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table procure_ware_db.materials: ~7 rows (approximately)
INSERT INTO `materials` (`id`, `name`, `code`, `description`, `unit`, `created_at`, `updated_at`) VALUES
	(1, 'Baja Ringan', 'MTRL001', 'Baja ringan yang digunakan untuk rangka atap, kuat dan tahan karat, cocok untuk konstruksi bangunan.', 'Batang', NULL, NULL),
	(2, 'Semen Portland', 'MTRL002', 'Semen Portland berkualitas tinggi untuk pekerjaan beton, plesteran, dan pasangan batu bata.', 'Sak', NULL, NULL),
	(3, 'Pasir Sungai', 'MTRL003', 'Pasir sungai bersih dan halus yang ideal untuk campuran beton dan mortar.', 'M3', NULL, NULL),
	(4, 'Besi Beton', 'MTRL004', 'Besi beton ulir dan polos untuk memperkuat struktur beton bangunan agar lebih kokoh.', 'Batang', NULL, NULL),
	(5, 'Kayu Balok', 'MTRL005', 'Kayu balok kuat dan tahan lama, digunakan untuk berbagai kebutuhan konstruksi bangunan.', 'Batang', NULL, NULL),
	(6, 'Pipa PVC 2 Inch', 'MTRL006', 'Pipa PVC 2 inch berkualitas untuk saluran air, mudah dipasang dan tahan lama.', 'Batang', NULL, NULL),
	(7, 'Kabel Listrik 2.5mm', 'MTRL007', 'Kabel listrik ukuran 2.5mm, cocok untuk instalasi listrik rumah dan gedung.', 'Roll', NULL, NULL);

-- Dumping structure for table procure_ware_db.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table procure_ware_db.migrations: ~11 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_09_09_084141_create_materials_table', 1),
	(6, '2024_09_09_084237_create_suppliers_table', 1),
	(7, '2024_09_09_084320_create_purchase_requests_table', 1),
	(8, '2024_09_09_084328_create_purchases_table', 1),
	(9, '2024_09_11_163651_create_deliveries_table', 1),
	(10, '2024_09_11_163726_create_delivery_items_table', 1),
	(11, '2024_09_11_163741_create_warehouse_stocks_table', 1);

-- Dumping structure for table procure_ware_db.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table procure_ware_db.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table procure_ware_db.personal_access_tokens
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

-- Dumping data for table procure_ware_db.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table procure_ware_db.purchases
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_request_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `purchase_date` date DEFAULT NULL,
  `expected_delivery_date` date DEFAULT NULL,
  `price_per_unit` decimal(20,2) NOT NULL,
  `total_price` decimal(20,2) DEFAULT NULL,
  `status` enum('in_process','delivered','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in_process',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchases_purchase_request_id_foreign` (`purchase_request_id`),
  KEY `purchases_user_id_foreign` (`user_id`),
  CONSTRAINT `purchases_purchase_request_id_foreign` FOREIGN KEY (`purchase_request_id`) REFERENCES `purchase_requests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table procure_ware_db.purchases: ~1 rows (approximately)
INSERT INTO `purchases` (`id`, `purchase_request_id`, `user_id`, `purchase_date`, `expected_delivery_date`, `price_per_unit`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, '2024-09-12', '2024-09-19', 10000.00, 1000000.00, 'delivered', '2024-09-12 10:47:04', '2024-09-12 10:47:24');

-- Dumping structure for table procure_ware_db.purchase_requests
CREATE TABLE IF NOT EXISTS `purchase_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `material_id` bigint unsigned NOT NULL,
  `supplier_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `request_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_requests_user_id_foreign` (`user_id`),
  KEY `purchase_requests_material_id_foreign` (`material_id`),
  KEY `purchase_requests_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `purchase_requests_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  CONSTRAINT `purchase_requests_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `purchase_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table procure_ware_db.purchase_requests: ~1 rows (approximately)
INSERT INTO `purchase_requests` (`id`, `user_id`, `material_id`, `supplier_id`, `quantity`, `status`, `request_date`, `created_at`, `updated_at`) VALUES
	(1, 3, 2, 2, 100, 'approved', '2024-09-12', '2024-09-12 10:46:11', '2024-09-12 10:46:36');

-- Dumping structure for table procure_ware_db.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `suppliers_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table procure_ware_db.suppliers: ~5 rows (approximately)
INSERT INTO `suppliers` (`id`, `name`, `code`, `contact`, `address`, `created_at`, `updated_at`) VALUES
	(1, 'PT. Bumi Konstruksi', 'SUPP001', '081234567890', 'Jl. Merak ampera no 10 surabaya', NULL, NULL),
	(2, 'CV. Mitra Abadi', 'SUPP002', '081987654321', 'Jl. Merak ampera no 10 surabaya', NULL, NULL),
	(3, 'PT. Sumber Alam', 'SUPP003', '081223344556', 'Jl. Merak ampera no 10 surabaya', NULL, NULL),
	(4, 'UD. Sejahtera Bersama', 'SUPP004', '081998877665', 'Jl. Merak ampera no 10 surabaya', NULL, NULL),
	(5, 'CV. Putra Mandiri', 'SUPP005', '081234876543', 'Jl. Merak ampera no 10 surabaya', NULL, NULL);

-- Dumping structure for table procure_ware_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('manager_a','manager_b','staff_purchase','staff_warehouse') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff_purchase',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table procure_ware_db.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Manager A', 'manager.a@example.com', 'manager_a', NULL, '$2y$12$MCbEHhfjrhneYo.HhboSGOIa7cPyESVNV2rAWt9BKiLxFtlIMaGGO', NULL, '2024-09-12 10:44:24', '2024-09-12 10:44:24'),
	(2, 'Manager B', 'manager.b@example.com', 'manager_b', NULL, '$2y$12$BfKunoSNP0MoABu7NdGo9OJqHb7hhw/kNqbb3VhhX5PC5wgxb3pbm', NULL, '2024-09-12 10:44:25', '2024-09-12 10:44:25'),
	(3, 'Staff Pembelian', 'staff.purchase@example.com', 'staff_purchase', NULL, '$2y$12$GE8ljOqx0lTTw.o.jV3lo.zQiDuwx/1avM6Di.jSX.US91V/h1Ody', NULL, '2024-09-12 10:44:25', '2024-09-12 10:44:25'),
	(4, 'Staff Gudang', 'staff.warehouse@example.com', 'staff_warehouse', NULL, '$2y$12$e0JsOQTsN2HONmwZZnBiGeiNnTUVU5KvATLgluP6XjYhuQHp02u4m', NULL, '2024-09-12 10:44:25', '2024-09-12 10:44:25');

-- Dumping structure for table procure_ware_db.warehouse_stocks
CREATE TABLE IF NOT EXISTS `warehouse_stocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `material_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `warehouse_stocks_material_id_foreign` (`material_id`),
  CONSTRAINT `warehouse_stocks_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table procure_ware_db.warehouse_stocks: ~1 rows (approximately)
INSERT INTO `warehouse_stocks` (`id`, `material_id`, `quantity`, `created_at`, `updated_at`) VALUES
	(1, 2, 100, '2024-09-12 10:47:41', '2024-09-12 10:47:41');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
