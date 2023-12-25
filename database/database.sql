-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla ventas.correos
CREATE TABLE IF NOT EXISTS `correos` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correos_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas.correos: ~2 rows (aproximadamente)
INSERT INTO `correos` (`id`, `nombre`, `email`, `created_at`, `updated_at`) VALUES
	('0a40012a-6d8f-463f-afdb-35f8387c8f96', 'Zad', 'zading2023@gmail.com', '2023-12-25 01:19:01', '2023-12-25 01:19:01'),
	('545f5a78-2f4f-41da-9293-b38f0b6b23a9', 'Jair Guerrero', 'ernestojair2023@outlook.es', '2023-12-25 01:15:07', '2023-12-25 01:15:07');

-- Volcando estructura para tabla ventas.dashboards
CREATE TABLE IF NOT EXISTS `dashboards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas.dashboards: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas.failed_jobs
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

-- Volcando datos para la tabla ventas.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas.migrations: ~12 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(20, '2023_12_16_193342_create_ventas_table', 1),
	(43, '2014_10_12_000000_create_users_table', 2),
	(44, '2014_10_12_100000_create_password_reset_tokens_table', 2),
	(45, '2019_05_03_000001_create_customer_columns', 2),
	(46, '2019_05_03_000002_create_subscriptions_table', 2),
	(47, '2019_05_03_000003_create_subscription_items_table', 2),
	(48, '2019_08_19_000000_create_failed_jobs_table', 2),
	(49, '2019_12_14_000001_create_personal_access_tokens_table', 2),
	(50, '2023_12_13_200441_create_dashboards_table', 2),
	(51, '2023_12_13_200455_create_correos_table', 2),
	(52, '2023_12_13_200511_create_promociones_table', 2),
	(53, '2023_12_14_000831_create_promo_vendidos_table', 2);

-- Volcando estructura para tabla ventas.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas.password_reset_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas.personal_access_tokens
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

-- Volcando datos para la tabla ventas.personal_access_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas.promociones
CREATE TABLE IF NOT EXISTS `promociones` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_paquete` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_paquete` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo_adulto` double NOT NULL,
  `costo_ninio` double NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `promocion` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas.promociones: ~1 rows (aproximadamente)
INSERT INTO `promociones` (`id`, `nombre_paquete`, `descripcion_paquete`, `costo_adulto`, `costo_ninio`, `imagen`, `promocion`, `created_at`, `updated_at`) VALUES
	('8173a8a8-ba69-41c6-afc1-e4e7dbb825bd', 'Bebidas alcoholicas', 'Las bebidas son algo que se deben tomar con precaución por que no e spra todos...', 1000, 200, 'storage/imagenes/ZZbao2l1NPuc45PydlGZoajrMjFx7CSFfc7Y1BnF.jpg', 0, '2023-12-24 23:38:32', '2023-12-24 23:38:32');

-- Volcando estructura para tabla ventas.promo_vendidos
CREATE TABLE IF NOT EXISTS `promo_vendidos` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_paquete` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad_adultos` int NOT NULL,
  `cantidad_ninio` int NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas.promo_vendidos: ~20 rows (aproximadamente)
INSERT INTO `promo_vendidos` (`id`, `nombre_paquete`, `telefono`, `correo`, `nombre`, `cantidad_adultos`, `cantidad_ninio`, `total`, `created_at`, `updated_at`) VALUES
	('1e628aa9-00d6-45b0-86f5-c4f90d6be582', 'Bebidas alcoholicas', '0986496051', 'ernestojair2023@outlook.es', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 00:42:36', '2023-12-25 00:42:36'),
	('2cf2a8a2-d5bf-42d1-a645-5cd8549c8e31', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 00:07:20', '2023-12-25 00:07:20'),
	('30fb69b5-9f35-43f0-99db-97a47ed7aff6', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 00:33:29', '2023-12-25 00:33:29'),
	('33f3da1b-3027-4f4f-a3a4-7f381859ebb9', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 00:14:47', '2023-12-25 00:14:47'),
	('37e6f462-0af5-4060-8c3f-d186680c385f', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Guerrero', 4, 4, 4800, '2023-12-25 00:16:05', '2023-12-25 00:16:05'),
	('3b609b03-5f49-482e-a79f-d2b10113cb03', 'Bebidas alcoholicas', '0986496051', 'ernesto2023guerrero@outlook.com', 'Wilther Guerrero', 4, 4, 4800, '2023-12-25 00:27:53', '2023-12-25 00:27:53'),
	('4a6ed8d9-61e2-4ecb-9663-f0026a016dda', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Guerrero', 4, 4, 4800, '2023-12-25 00:09:46', '2023-12-25 00:09:46'),
	('669c8cd8-c537-4373-9d04-48e58f0220cd', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 00:08:56', '2023-12-25 00:08:56'),
	('672ad987-55b5-4735-bf24-117a4c791a67', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 01:32:15', '2023-12-25 01:32:15'),
	('725b7d94-23bc-4c41-b3c1-67246a12fe94', 'Bebidas alcoholicas', '0986496051', 'ernestojair2023@outlook.es', 'Ernesto Jair', 4, 2, 4400, '2023-12-25 00:47:54', '2023-12-25 00:47:54'),
	('84f59f17-c5c6-4dfc-8a84-8b9726ed51d2', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 01:29:02', '2023-12-25 01:29:02'),
	('8817283e-728e-4446-95d0-9bfe0c805127', 'Bebidas alcoholicas', '0986496051', 'ernestojair2023@outlook.es', 'Ernesto Guerrero', 4, 2, 4400, '2023-12-25 00:36:20', '2023-12-25 00:36:20'),
	('938ff41e-7570-442b-beaa-99a433efd0bb', 'Bebidas alcoholicas', '0986496051', 'aj244117c@gmail.com', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 01:24:46', '2023-12-25 01:24:46'),
	('9c72f42a-6b75-4920-9af7-fa64f39dfc5a', 'Bebidas alcoholicas', '0986496054', 'ernestojair2020@gmail.com', 'Hola', 4, 2, 4400, '2023-12-24 23:42:34', '2023-12-24 23:42:34'),
	('9e54e0f6-e1c3-47f0-bc95-cae7d163cd2c', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Guerrero', 5, 4, 5800, '2023-12-24 23:39:31', '2023-12-24 23:39:31'),
	('afe20bcf-a3e5-4ec2-b0c7-a4297402db50', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 00:28:35', '2023-12-25 00:28:35'),
	('b33c98fa-55bf-4353-a677-efe56a1db8c4', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Guerrero', 4, 4, 4800, '2023-12-25 00:19:10', '2023-12-25 00:19:10'),
	('b73022f3-fd76-47c2-8219-0a9379c9c276', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 00:04:39', '2023-12-25 00:04:39'),
	('bb55d1ed-16f7-4134-ab78-a81734edda56', 'Bebidas alcoholicas', '0986496051', 'ernestojair2020@gmail.com', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 01:33:23', '2023-12-25 01:33:23'),
	('ff7d251e-5aac-4edc-b183-9a50c92dc4a6', 'Bebidas alcoholicas', '0986496051', 'aj244117c@gmail.com', 'Ernesto Jair', 4, 4, 4800, '2023-12-25 01:22:42', '2023-12-25 01:22:42');

-- Volcando estructura para tabla ventas.subscriptions
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscriptions_stripe_id_unique` (`stripe_id`),
  KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas.subscriptions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas.subscription_items
CREATE TABLE IF NOT EXISTS `subscription_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint unsigned NOT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_product` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscription_items_stripe_id_unique` (`stripe_id`),
  KEY `subscription_items_subscription_id_stripe_price_index` (`subscription_id`,`stripe_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas.subscription_items: ~0 rows (aproximadamente)

-- Volcando estructura para tabla ventas.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_stripe_id_index` (`stripe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas.users: ~1 rows (aproximadamente)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `pm_type`, `pm_last_four`, `trial_ends_at`) VALUES
	(1, 'Ernesto Jair', 'ernestojair2020@gmail.com', NULL, '$2y$12$tXeLvrP.QI0lwbvy76r7ouspeLKVRYS.NbrjLZB0nYbMN4/WIJJIe', NULL, '2023-12-24 23:37:19', '2023-12-24 23:37:19', NULL, NULL, NULL, NULL);

-- Volcando estructura para tabla ventas.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ventas.ventas: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
