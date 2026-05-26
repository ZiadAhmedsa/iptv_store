-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2026 at 09:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakri_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image_url`, `link_url`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(7, 'لاتا', 'uploads/banners/banner_1779776936.png', 'http://127.0.0.1:8000/', 1, 0, '2026-05-26 03:28:56', '2026-05-26 03:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('inzo-store-cache-admin_dashboard_stats', 'a:7:{s:11:\"total_sales\";s:6:\"249.00\";s:12:\"total_orders\";i:1;s:14:\"total_products\";i:6;s:11:\"total_users\";i:6;s:14:\"pending_orders\";i:0;s:16:\"total_categories\";i:5;s:14:\"pending_claims\";i:1;}', 1779780985),
('inzo-store-cache-home_best_selling_products', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:4:{i:0;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:5;s:11:\"category_id\";i:3;s:4:\"name\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_ar\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_en\";s:42:\"الباقة الملكية الذهبية\";s:4:\"slug\";s:22:\"albak-almlky-althhby-2\";s:11:\"description\";s:6:\"سيب\";s:14:\"description_ar\";s:6:\"سيب\";s:14:\"description_en\";s:6:\"سيب\";s:5:\"price\";s:6:\"111.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:111;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-11 22:41:39\";s:10:\"updated_at\";s:19:\"2026-05-11 22:41:39\";s:17:\"order_items_count\";i:0;}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:5;s:11:\"category_id\";i:3;s:4:\"name\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_ar\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_en\";s:42:\"الباقة الملكية الذهبية\";s:4:\"slug\";s:22:\"albak-almlky-althhby-2\";s:11:\"description\";s:6:\"سيب\";s:14:\"description_ar\";s:6:\"سيب\";s:14:\"description_en\";s:6:\"سيب\";s:5:\"price\";s:6:\"111.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:111;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-11 22:41:39\";s:10:\"updated_at\";s:19:\"2026-05-11 22:41:39\";s:17:\"order_items_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:7;s:11:\"category_id\";i:5;s:4:\"name\";s:15:\"هولك سنة\";s:7:\"name_ar\";s:15:\"هولك سنة\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-2\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:6:\"249.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:24:11\";s:10:\"updated_at\";s:19:\"2026-05-18 22:39:24\";s:17:\"order_items_count\";i:0;}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:7;s:11:\"category_id\";i:5;s:4:\"name\";s:15:\"هولك سنة\";s:7:\"name_ar\";s:15:\"هولك سنة\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-2\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:6:\"249.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:24:11\";s:10:\"updated_at\";s:19:\"2026-05-18 22:39:24\";s:17:\"order_items_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:8;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 6 شهور\";s:7:\"name_ar\";s:19:\"هولك 6 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:1:\"1\";s:11:\"description\";s:6:\"123456\";s:14:\"description_ar\";s:6:\"123456\";s:14:\"description_en\";s:6:\"123456\";s:5:\"price\";s:6:\"149.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:28:22\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:43\";s:17:\"order_items_count\";i:0;}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:8;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 6 شهور\";s:7:\"name_ar\";s:19:\"هولك 6 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:1:\"1\";s:11:\"description\";s:6:\"123456\";s:14:\"description_ar\";s:6:\"123456\";s:14:\"description_en\";s:6:\"123456\";s:5:\"price\";s:6:\"149.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:28:22\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:43\";s:17:\"order_items_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:18:{s:2:\"id\";i:9;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 3 شهور\";s:7:\"name_ar\";s:19:\"هولك 3 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-3\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:5:\"99.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:34:50\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:18\";s:17:\"order_items_count\";i:0;}s:11:\"\0*\0original\";a:18:{s:2:\"id\";i:9;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 3 شهور\";s:7:\"name_ar\";s:19:\"هولك 3 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-3\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:5:\"99.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:34:50\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:18\";s:17:\"order_items_count\";i:0;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1779781285),
('inzo-store-cache-home_categories_with_products', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:5:{i:0;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:3;s:9:\"parent_id\";N;s:4:\"name\";s:19:\"كاس العالم\";s:7:\"name_ar\";s:19:\"كاس العالم\";s:7:\"name_en\";s:9:\"World Cup\";s:4:\"slug\";s:8:\"wold-cup\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"image\";s:42:\"uploads/categories/category_1779142159.png\";s:15:\"target_audience\";N;s:21:\"customization_enabled\";i:0;s:10:\"created_at\";s:19:\"2026-05-11 22:02:37\";s:10:\"updated_at\";s:19:\"2026-05-18 22:09:19\";s:4:\"icon\";N;s:10:\"sort_order\";i:1;}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:3;s:9:\"parent_id\";N;s:4:\"name\";s:19:\"كاس العالم\";s:7:\"name_ar\";s:19:\"كاس العالم\";s:7:\"name_en\";s:9:\"World Cup\";s:4:\"slug\";s:8:\"wold-cup\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"image\";s:42:\"uploads/categories/category_1779142159.png\";s:15:\"target_audience\";N;s:21:\"customization_enabled\";i:0;s:10:\"created_at\";s:19:\"2026-05-11 22:02:37\";s:10:\"updated_at\";s:19:\"2026-05-18 22:09:19\";s:4:\"icon\";N;s:10:\"sort_order\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:21:\"customization_enabled\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:1:{i:0;s:14:\"full_image_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"products\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:11;s:11:\"category_id\";i:3;s:4:\"name\";s:19:\"كاس العالم\";s:7:\"name_ar\";s:19:\"كاس العالم\";s:7:\"name_en\";s:42:\"الباقة الملكية الذهبية\";s:4:\"slug\";s:20:\"albak-almlky-althhby\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:6:\"111.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-26 04:58:15\";s:10:\"updated_at\";s:19:\"2026-05-26 04:58:15\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:11;s:11:\"category_id\";i:3;s:4:\"name\";s:19:\"كاس العالم\";s:7:\"name_ar\";s:19:\"كاس العالم\";s:7:\"name_en\";s:42:\"الباقة الملكية الذهبية\";s:4:\"slug\";s:20:\"albak-almlky-althhby\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:6:\"111.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-26 04:58:15\";s:10:\"updated_at\";s:19:\"2026-05-26 04:58:15\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:5;s:11:\"category_id\";i:3;s:4:\"name\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_ar\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_en\";s:42:\"الباقة الملكية الذهبية\";s:4:\"slug\";s:22:\"albak-almlky-althhby-2\";s:11:\"description\";s:6:\"سيب\";s:14:\"description_ar\";s:6:\"سيب\";s:14:\"description_en\";s:6:\"سيب\";s:5:\"price\";s:6:\"111.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:111;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-11 22:41:39\";s:10:\"updated_at\";s:19:\"2026-05-11 22:41:39\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:5;s:11:\"category_id\";i:3;s:4:\"name\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_ar\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_en\";s:42:\"الباقة الملكية الذهبية\";s:4:\"slug\";s:22:\"albak-almlky-althhby-2\";s:11:\"description\";s:6:\"سيب\";s:14:\"description_ar\";s:6:\"سيب\";s:14:\"description_en\";s:6:\"سيب\";s:5:\"price\";s:6:\"111.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:111;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-11 22:41:39\";s:10:\"updated_at\";s:19:\"2026-05-11 22:41:39\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:4:\"name\";i:1;s:7:\"name_ar\";i:2;s:7:\"name_en\";i:3;s:4:\"slug\";i:4;s:11:\"description\";i:5;s:5:\"image\";i:6;s:21:\"customization_enabled\";i:7;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:5;s:9:\"parent_id\";N;s:4:\"name\";s:8:\"هولك\";s:7:\"name_ar\";s:8:\"هولك\";s:7:\"name_en\";s:4:\"HULK\";s:4:\"slug\";s:4:\"hulk\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"image\";s:42:\"uploads/categories/category_1779142043.png\";s:15:\"target_audience\";N;s:21:\"customization_enabled\";i:0;s:10:\"created_at\";s:19:\"2026-05-18 22:07:23\";s:10:\"updated_at\";s:19:\"2026-05-18 22:07:23\";s:4:\"icon\";N;s:10:\"sort_order\";i:2;}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:5;s:9:\"parent_id\";N;s:4:\"name\";s:8:\"هولك\";s:7:\"name_ar\";s:8:\"هولك\";s:7:\"name_en\";s:4:\"HULK\";s:4:\"slug\";s:4:\"hulk\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"image\";s:42:\"uploads/categories/category_1779142043.png\";s:15:\"target_audience\";N;s:21:\"customization_enabled\";i:0;s:10:\"created_at\";s:19:\"2026-05-18 22:07:23\";s:10:\"updated_at\";s:19:\"2026-05-18 22:07:23\";s:4:\"icon\";N;s:10:\"sort_order\";i:2;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:21:\"customization_enabled\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:1:{i:0;s:14:\"full_image_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"products\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:4:{i:0;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:10;s:11:\"category_id\";i:5;s:4:\"name\";s:15:\"هولك سنة\";s:7:\"name_ar\";s:15:\"هولك سنة\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-4\";s:11:\"description\";s:33:\"جهازين ف نفس الوقت\";s:14:\"description_ar\";s:33:\"جهازين ف نفس الوقت\";s:14:\"description_en\";s:33:\"جهازين ف نفس الوقت\";s:5:\"price\";s:6:\"399.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:37:30\";s:10:\"updated_at\";s:19:\"2026-05-26 05:37:53\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:10;s:11:\"category_id\";i:5;s:4:\"name\";s:15:\"هولك سنة\";s:7:\"name_ar\";s:15:\"هولك سنة\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-4\";s:11:\"description\";s:33:\"جهازين ف نفس الوقت\";s:14:\"description_ar\";s:33:\"جهازين ف نفس الوقت\";s:14:\"description_en\";s:33:\"جهازين ف نفس الوقت\";s:5:\"price\";s:6:\"399.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:37:30\";s:10:\"updated_at\";s:19:\"2026-05-26 05:37:53\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:9;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 3 شهور\";s:7:\"name_ar\";s:19:\"هولك 3 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-3\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:5:\"99.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:34:50\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:18\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:9;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 3 شهور\";s:7:\"name_ar\";s:19:\"هولك 3 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-3\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:5:\"99.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:34:50\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:18\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:8;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 6 شهور\";s:7:\"name_ar\";s:19:\"هولك 6 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:1:\"1\";s:11:\"description\";s:6:\"123456\";s:14:\"description_ar\";s:6:\"123456\";s:14:\"description_en\";s:6:\"123456\";s:5:\"price\";s:6:\"149.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:28:22\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:43\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:8;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 6 شهور\";s:7:\"name_ar\";s:19:\"هولك 6 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:1:\"1\";s:11:\"description\";s:6:\"123456\";s:14:\"description_ar\";s:6:\"123456\";s:14:\"description_en\";s:6:\"123456\";s:5:\"price\";s:6:\"149.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:28:22\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:43\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:7;s:11:\"category_id\";i:5;s:4:\"name\";s:15:\"هولك سنة\";s:7:\"name_ar\";s:15:\"هولك سنة\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-2\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:6:\"249.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:24:11\";s:10:\"updated_at\";s:19:\"2026-05-18 22:39:24\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:7;s:11:\"category_id\";i:5;s:4:\"name\";s:15:\"هولك سنة\";s:7:\"name_ar\";s:15:\"هولك سنة\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-2\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:6:\"249.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:24:11\";s:10:\"updated_at\";s:19:\"2026-05-18 22:39:24\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:4:\"name\";i:1;s:7:\"name_ar\";i:2;s:7:\"name_en\";i:3;s:4:\"slug\";i:4;s:11:\"description\";i:5;s:5:\"image\";i:6;s:21:\"customization_enabled\";i:7;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:2;s:9:\"parent_id\";N;s:4:\"name\";s:12:\"فالكون\";s:7:\"name_ar\";s:12:\"فالكون\";s:7:\"name_en\";s:6:\"Falcon\";s:4:\"slug\";s:2:\"ja\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"image\";s:42:\"uploads/categories/category_1779141855.png\";s:15:\"target_audience\";N;s:21:\"customization_enabled\";i:0;s:10:\"created_at\";s:19:\"2026-05-10 21:09:02\";s:10:\"updated_at\";s:19:\"2026-05-18 22:04:15\";s:4:\"icon\";N;s:10:\"sort_order\";i:3;}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:2;s:9:\"parent_id\";N;s:4:\"name\";s:12:\"فالكون\";s:7:\"name_ar\";s:12:\"فالكون\";s:7:\"name_en\";s:6:\"Falcon\";s:4:\"slug\";s:2:\"ja\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"image\";s:42:\"uploads/categories/category_1779141855.png\";s:15:\"target_audience\";N;s:21:\"customization_enabled\";i:0;s:10:\"created_at\";s:19:\"2026-05-10 21:09:02\";s:10:\"updated_at\";s:19:\"2026-05-18 22:04:15\";s:4:\"icon\";N;s:10:\"sort_order\";i:3;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:21:\"customization_enabled\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:1:{i:0;s:14:\"full_image_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"products\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:4:\"name\";i:1;s:7:\"name_ar\";i:2;s:7:\"name_en\";i:3;s:4:\"slug\";i:4;s:11:\"description\";i:5;s:5:\"image\";i:6;s:21:\"customization_enabled\";i:7;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:4;s:9:\"parent_id\";N;s:4:\"name\";s:14:\"يونيفرس\";s:7:\"name_ar\";s:14:\"يونيفرس\";s:7:\"name_en\";s:8:\"Universe\";s:4:\"slug\";s:2:\"vv\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"image\";s:42:\"uploads/categories/category_1779142396.png\";s:15:\"target_audience\";N;s:21:\"customization_enabled\";i:0;s:10:\"created_at\";s:19:\"2026-05-11 22:42:39\";s:10:\"updated_at\";s:19:\"2026-05-18 22:13:16\";s:4:\"icon\";N;s:10:\"sort_order\";i:4;}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:4;s:9:\"parent_id\";N;s:4:\"name\";s:14:\"يونيفرس\";s:7:\"name_ar\";s:14:\"يونيفرس\";s:7:\"name_en\";s:8:\"Universe\";s:4:\"slug\";s:2:\"vv\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"image\";s:42:\"uploads/categories/category_1779142396.png\";s:15:\"target_audience\";N;s:21:\"customization_enabled\";i:0;s:10:\"created_at\";s:19:\"2026-05-11 22:42:39\";s:10:\"updated_at\";s:19:\"2026-05-18 22:13:16\";s:4:\"icon\";N;s:10:\"sort_order\";i:4;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:21:\"customization_enabled\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:1:{i:0;s:14:\"full_image_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"products\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:4:\"name\";i:1;s:7:\"name_ar\";i:2;s:7:\"name_en\";i:3;s:4:\"slug\";i:4;s:11:\"description\";i:5;s:5:\"image\";i:6;s:21:\"customization_enabled\";i:7;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:19:\"App\\Models\\Category\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:10:\"categories\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:16:{s:2:\"id\";i:6;s:9:\"parent_id\";N;s:4:\"name\";s:12:\"فولتشر\";s:7:\"name_ar\";s:12:\"فولتشر\";s:7:\"name_en\";s:7:\"Vultuer\";s:4:\"slug\";s:7:\"vultuer\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"image\";s:42:\"uploads/categories/category_1779142545.png\";s:15:\"target_audience\";N;s:21:\"customization_enabled\";i:0;s:10:\"created_at\";s:19:\"2026-05-18 22:15:45\";s:10:\"updated_at\";s:19:\"2026-05-18 22:15:45\";s:4:\"icon\";N;s:10:\"sort_order\";i:5;}s:11:\"\0*\0original\";a:16:{s:2:\"id\";i:6;s:9:\"parent_id\";N;s:4:\"name\";s:12:\"فولتشر\";s:7:\"name_ar\";s:12:\"فولتشر\";s:7:\"name_en\";s:7:\"Vultuer\";s:4:\"slug\";s:7:\"vultuer\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"image\";s:42:\"uploads/categories/category_1779142545.png\";s:15:\"target_audience\";N;s:21:\"customization_enabled\";i:0;s:10:\"created_at\";s:19:\"2026-05-18 22:15:45\";s:10:\"updated_at\";s:19:\"2026-05-18 22:15:45\";s:4:\"icon\";N;s:10:\"sort_order\";i:5;}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:1:{s:21:\"customization_enabled\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:1:{i:0;s:14:\"full_image_url\";}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"products\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:8:{i:0;s:4:\"name\";i:1;s:7:\"name_ar\";i:2;s:7:\"name_en\";i:3;s:4:\"slug\";i:4;s:11:\"description\";i:5;s:5:\"image\";i:6;s:21:\"customization_enabled\";i:7;s:10:\"sort_order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1779781285);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('inzo-store-cache-home_featured_products', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:6:{i:0;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:11;s:11:\"category_id\";i:3;s:4:\"name\";s:19:\"كاس العالم\";s:7:\"name_ar\";s:19:\"كاس العالم\";s:7:\"name_en\";s:42:\"الباقة الملكية الذهبية\";s:4:\"slug\";s:20:\"albak-almlky-althhby\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:6:\"111.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-26 04:58:15\";s:10:\"updated_at\";s:19:\"2026-05-26 04:58:15\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:11;s:11:\"category_id\";i:3;s:4:\"name\";s:19:\"كاس العالم\";s:7:\"name_ar\";s:19:\"كاس العالم\";s:7:\"name_en\";s:42:\"الباقة الملكية الذهبية\";s:4:\"slug\";s:20:\"albak-almlky-althhby\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:6:\"111.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-26 04:58:15\";s:10:\"updated_at\";s:19:\"2026-05-26 04:58:15\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:10;s:11:\"category_id\";i:5;s:4:\"name\";s:15:\"هولك سنة\";s:7:\"name_ar\";s:15:\"هولك سنة\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-4\";s:11:\"description\";s:33:\"جهازين ف نفس الوقت\";s:14:\"description_ar\";s:33:\"جهازين ف نفس الوقت\";s:14:\"description_en\";s:33:\"جهازين ف نفس الوقت\";s:5:\"price\";s:6:\"399.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:37:30\";s:10:\"updated_at\";s:19:\"2026-05-26 05:37:53\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:10;s:11:\"category_id\";i:5;s:4:\"name\";s:15:\"هولك سنة\";s:7:\"name_ar\";s:15:\"هولك سنة\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-4\";s:11:\"description\";s:33:\"جهازين ف نفس الوقت\";s:14:\"description_ar\";s:33:\"جهازين ف نفس الوقت\";s:14:\"description_en\";s:33:\"جهازين ف نفس الوقت\";s:5:\"price\";s:6:\"399.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:37:30\";s:10:\"updated_at\";s:19:\"2026-05-26 05:37:53\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:9;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 3 شهور\";s:7:\"name_ar\";s:19:\"هولك 3 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-3\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:5:\"99.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:34:50\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:18\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:9;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 3 شهور\";s:7:\"name_ar\";s:19:\"هولك 3 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-3\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:5:\"99.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:34:50\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:18\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:8;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 6 شهور\";s:7:\"name_ar\";s:19:\"هولك 6 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:1:\"1\";s:11:\"description\";s:6:\"123456\";s:14:\"description_ar\";s:6:\"123456\";s:14:\"description_en\";s:6:\"123456\";s:5:\"price\";s:6:\"149.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:28:22\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:43\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:8;s:11:\"category_id\";i:5;s:4:\"name\";s:19:\"هولك 6 شهور\";s:7:\"name_ar\";s:19:\"هولك 6 شهور\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:1:\"1\";s:11:\"description\";s:6:\"123456\";s:14:\"description_ar\";s:6:\"123456\";s:14:\"description_en\";s:6:\"123456\";s:5:\"price\";s:6:\"149.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:28:22\";s:10:\"updated_at\";s:19:\"2026-05-18 22:38:43\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:7;s:11:\"category_id\";i:5;s:4:\"name\";s:15:\"هولك سنة\";s:7:\"name_ar\";s:15:\"هولك سنة\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-2\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:6:\"249.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:24:11\";s:10:\"updated_at\";s:19:\"2026-05-18 22:39:24\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:7;s:11:\"category_id\";i:5;s:4:\"name\";s:15:\"هولك سنة\";s:7:\"name_ar\";s:15:\"هولك سنة\";s:7:\"name_en\";s:1:\"1\";s:4:\"slug\";s:3:\"1-2\";s:11:\"description\";N;s:14:\"description_ar\";N;s:14:\"description_en\";N;s:5:\"price\";s:6:\"249.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:0;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-18 22:24:11\";s:10:\"updated_at\";s:19:\"2026-05-18 22:39:24\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:18:\"App\\Models\\Product\":33:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:8:\"products\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:1;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:17:{s:2:\"id\";i:5;s:11:\"category_id\";i:3;s:4:\"name\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_ar\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_en\";s:42:\"الباقة الملكية الذهبية\";s:4:\"slug\";s:22:\"albak-almlky-althhby-2\";s:11:\"description\";s:6:\"سيب\";s:14:\"description_ar\";s:6:\"سيب\";s:14:\"description_en\";s:6:\"سيب\";s:5:\"price\";s:6:\"111.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:111;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-11 22:41:39\";s:10:\"updated_at\";s:19:\"2026-05-11 22:41:39\";}s:11:\"\0*\0original\";a:17:{s:2:\"id\";i:5;s:11:\"category_id\";i:3;s:4:\"name\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_ar\";s:42:\"الباقة الملكية الذهبية\";s:7:\"name_en\";s:42:\"الباقة الملكية الذهبية\";s:4:\"slug\";s:22:\"albak-almlky-althhby-2\";s:11:\"description\";s:6:\"سيب\";s:14:\"description_ar\";s:6:\"سيب\";s:14:\"description_en\";s:6:\"سيب\";s:5:\"price\";s:6:\"111.00\";s:14:\"discount_price\";N;s:5:\"stock\";i:111;s:9:\"is_active\";i:1;s:15:\"target_audience\";N;s:18:\"customization_type\";N;s:10:\"created_at\";s:19:\"2026-05-11 22:41:39\";s:10:\"updated_at\";s:19:\"2026-05-11 22:41:39\";}s:10:\"\0*\0changes\";a:0:{}s:11:\"\0*\0previous\";a:0:{}s:8:\"\0*\0casts\";a:4:{s:5:\"price\";s:9:\"decimal:2\";s:14:\"discount_price\";s:9:\"decimal:2\";s:5:\"stock\";s:7:\"integer\";s:9:\"is_active\";s:7:\"boolean\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:14:{i:0;s:11:\"category_id\";i:1;s:4:\"name\";i:2;s:7:\"name_ar\";i:3;s:7:\"name_en\";i:4;s:4:\"slug\";i:5;s:11:\"description\";i:6;s:14:\"description_ar\";i:7;s:14:\"description_en\";i:8;s:5:\"price\";i:9;s:14:\"discount_price\";i:10;s:5:\"stock\";i:11;s:9:\"is_active\";i:12;s:15:\"target_audience\";i:13;s:18:\"customization_type\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1779781285);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `target_audience` varchar(255) DEFAULT NULL,
  `customization_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `name_ar`, `name_en`, `slug`, `description`, `description_ar`, `description_en`, `image`, `target_audience`, `customization_enabled`, `created_at`, `updated_at`, `icon`, `sort_order`) VALUES
(2, NULL, 'فالكون', 'فالكون', 'Falcon', 'ja', NULL, NULL, NULL, 'uploads/categories/category_1779141855.png', NULL, 0, '2026-05-10 18:09:02', '2026-05-18 19:04:15', NULL, 3),
(3, NULL, 'كاس العالم', 'كاس العالم', 'World Cup', 'wold-cup', NULL, NULL, NULL, 'uploads/categories/category_1779142159.png', NULL, 0, '2026-05-11 19:02:37', '2026-05-18 19:09:19', NULL, 1),
(4, NULL, 'يونيفرس', 'يونيفرس', 'Universe', 'vv', NULL, NULL, NULL, 'uploads/categories/category_1779142396.png', NULL, 0, '2026-05-11 19:42:39', '2026-05-18 19:13:16', NULL, 4),
(5, NULL, 'هولك', 'هولك', 'HULK', 'hulk', NULL, NULL, NULL, 'uploads/categories/category_1779142043.png', NULL, 0, '2026-05-18 19:07:23', '2026-05-18 19:07:23', NULL, 2),
(6, NULL, 'فولتشر', 'فولتشر', 'Vultuer', 'vultuer', NULL, NULL, NULL, 'uploads/categories/category_1779142545.png', NULL, 0, '2026-05-18 19:15:45', '2026-05-18 19:15:45', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `free_subscription_plans`
--

CREATE TABLE `free_subscription_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `duration_days` int(11) DEFAULT NULL,
  `assigned_email` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `free_subscription_plans`
--

INSERT INTO `free_subscription_plans` (`id`, `title`, `host`, `username`, `password`, `description`, `duration_days`, `assigned_email`, `is_active`, `created_at`, `updated_at`) VALUES
(8, 'اشتراك مجاني - 24 ساعة', 'http://hulk8k.xyz:8080', '15252626262', '1', NULL, NULL, 'stakestake111115@gmail.com', 1, '2026-05-09 20:06:47', '2026-05-09 20:07:22'),
(14, '24 ساعه', 'http://hulk8k.xyz:8080', '52253336945101', '14809803464869', NULL, 1, 'amjadalmaqdasheii@gmail.com', 1, '2026-05-11 20:43:35', '2026-05-11 20:43:35'),
(15, 'سنه', 'http://hulk8k.xyz:8080', 'ziad', '14809803464869', '1', 365, 'amjadalmaqdasheii@gmail.com', 1, '2026-05-11 20:45:05', '2026-05-11 20:46:17'),
(16, '1', 'http://hulk8k.xyz:8080', '52253336945101', '1', NULL, 11, 'amjadalmaqdasheii@gmail.com', 1, '2026-05-11 20:46:57', '2026-05-11 20:46:57'),
(17, 'b', '1dd', '1', '1', NULL, 1234, 'zahmd4218@gmail.com', 1, '2026-05-11 22:46:17', '2026-05-18 15:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'ph-device-tablet',
  `content` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`id`, `title`, `category`, `icon`, `content`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, '1', 'anderoid', 'ph-monitor', 'khgvdlishv li', 1, 1, '2026-05-09 14:19:34', '2026-05-10 19:17:43'),
(3, '000', 'mac', 'ph-monitor1', '1', 1, 0, '2026-05-10 19:17:05', '2026-05-10 19:29:11'),
(4, 'a', 'sony', 'ph-monitor', 'a', 1, 0, '2026-05-11 19:58:02', '2026-05-11 19:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `guide_steps`
--

CREATE TABLE `guide_steps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `guide_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guide_steps`
--

INSERT INTO `guide_steps` (`id`, `guide_id`, `image_path`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(19, 3, '/storage/guides/aeWMBH53uh3MPxPB9gv4HJxopSxhbRTm22k5NXBV.jpg', 'jodoj', 0, '2026-05-10 19:29:11', '2026-05-10 19:29:11'),
(20, 3, '/storage/guides/p4QmqIdoFvbHDB3xbs6nxT4CjOJGTMsubWZcup2a.jpg', '11', 1, '2026-05-10 19:29:11', '2026-05-10 19:29:11'),
(21, 2, '/storage/guides/52jR1kYf9Ie9xhmq6XuB8m8AbIm5vHne1odGppAk.jpg', '111', 0, '2026-05-10 19:30:02', '2026-05-10 19:30:02'),
(22, 2, '/storage/guides/D4AVxE6L8gOEE04wqZ8u6aXTRt0WEuxJgzSMxjrU.png', '111deadd', 1, '2026-05-10 19:30:02', '2026-05-10 19:30:02'),
(29, 4, '/storage/guides/f3S8kOFnfQnqkZ9Kwd9Is7GMcjkBcWJ8YpnmeIOM.png', 'a', 0, '2026-05-11 20:00:24', '2026-05-11 20:00:24'),
(30, 4, '/storage/guides/qiiLPTrGIoXg4maqpTNSE46apq1wVJ292QhRUtIH.jpg', 'qq', 1, '2026-05-11 20:00:24', '2026-05-11 20:00:24'),
(31, 4, '/storage/guides/6D86aR6zcvVq5SJs6ZYwmeG7hpyWF0bWzmhxqeuW.png', 'drycgvuhbk', 2, '2026-05-11 20:00:24', '2026-05-11 20:00:24'),
(32, 4, '/storage/guides/HfZikux332jksvwwUzEpPGRl0sbdFyhXS6t8vuGc.png', 'a', 3, '2026-05-11 20:00:24', '2026-05-11 20:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `delivery_status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_number` varchar(255) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `address_id`, `total`, `total_amount`, `status`, `delivery_status`, `order_number`, `payment_method`, `payment_status`, `whatsapp_number`, `notes`, `created_at`, `updated_at`) VALUES
(13, 3, NULL, 249.00, 249.00, 'completed', 'completed', 'EAC335FA', 'whatsapp', 'paid', '7654', '', '2026-05-26 04:35:19', '2026-05-26 04:35:53');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(15, 13, 7, 1, 249.00, '2026-05-26 04:35:19', '2026-05-26 04:35:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_status_history`
--

CREATE TABLE `order_status_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status_type` varchar(255) NOT NULL,
  `old_value` varchar(255) DEFAULT NULL,
  `new_value` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\User', 16, 'flutter-mobile-app', 'ae1cd9fcf185c7056d3205a5ad6cbdc06c1e5920b0994792ff5d66d42c28743a', '[\"*\"]', '2026-05-14 22:33:40', NULL, '2026-05-14 22:16:13', '2026-05-14 22:33:40'),
(4, 'App\\Models\\User', 3, 'flutter-mobile-app', '841fbd27f48ecefd7d5fc5d7a070fad53bff0706286a4539dd4c7107e7a6b0ec', '[\"*\"]', '2026-05-18 15:39:42', NULL, '2026-05-18 15:36:02', '2026-05-18 15:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_ar` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `description_ar` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `target_audience` varchar(255) DEFAULT NULL,
  `customization_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `name_ar`, `name_en`, `slug`, `description`, `description_ar`, `description_en`, `price`, `discount_price`, `stock`, `is_active`, `target_audience`, `customization_type`, `created_at`, `updated_at`) VALUES
(5, 3, 'الباقة الملكية الذهبية', 'الباقة الملكية الذهبية', 'الباقة الملكية الذهبية', 'albak-almlky-althhby-2', 'سيب', 'سيب', 'سيب', 111.00, NULL, 111, 1, NULL, NULL, '2026-05-11 19:41:39', '2026-05-11 19:41:39'),
(7, 5, 'هولك سنة', 'هولك سنة', '1', '1-2', NULL, NULL, NULL, 249.00, NULL, 0, 1, NULL, NULL, '2026-05-18 19:24:11', '2026-05-18 19:39:24'),
(8, 5, 'هولك 6 شهور', 'هولك 6 شهور', '1', '1', '123456', '123456', '123456', 149.00, NULL, 0, 1, NULL, NULL, '2026-05-18 19:28:22', '2026-05-18 19:38:43'),
(9, 5, 'هولك 3 شهور', 'هولك 3 شهور', '1', '1-3', NULL, NULL, NULL, 99.00, NULL, 0, 1, NULL, NULL, '2026-05-18 19:34:50', '2026-05-18 19:38:18'),
(10, 5, 'هولك سنة', 'هولك سنة', '1', '1-4', 'جهازين ف نفس الوقت', 'جهازين ف نفس الوقت', 'جهازين ف نفس الوقت', 399.00, NULL, 0, 1, NULL, NULL, '2026-05-18 19:37:30', '2026-05-26 02:37:53'),
(11, 3, 'كاس العالم', 'كاس العالم', 'الباقة الملكية الذهبية', 'albak-almlky-althhby', NULL, NULL, NULL, 111.00, NULL, 0, 1, NULL, NULL, '2026-05-26 01:58:15', '2026-05-26 01:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`, `is_primary`, `created_at`, `updated_at`) VALUES
(5, 5, 'products/zViAScyHvEfd7JKhod37Vk0g37X6DsNrcTD52sCh.jpg', 1, '2026-05-11 19:41:39', '2026-05-11 19:41:39'),
(7, 7, 'products/5HWLMxGt5X9sXiWmOcKyPLekCGlbzY9dvHsvlXnv.png', 1, '2026-05-18 19:24:11', '2026-05-18 19:24:11'),
(8, 8, 'products/iWpEX9tsSO9TrPJL5ec4fLI5SmkgjEsoL3VlFmKl.png', 1, '2026-05-18 19:28:22', '2026-05-18 19:28:22'),
(9, 9, 'products/wdrO1SlmiLl8aZooDusNiQNK8k18kUy2nEB7bsAe.png', 1, '2026-05-18 19:34:50', '2026-05-18 19:34:50'),
(10, 10, 'products/Bzrmuqbg4r0Rys7L5V65YuBXY2JCs34h85NoXYRX.png', 1, '2026-05-18 19:37:30', '2026-05-18 19:37:30'),
(11, 11, 'products/kIus8k5ny1lGdxYlRodGFEEJfc3yOK4CF7GpYI98.png', 1, '2026-05-26 01:58:15', '2026-05-26 01:58:15');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('16fsbLV1VKdwuU0RiEGPakhJqSNXoVn0exbl4HSi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1VDVGE1cERCWUhNaGRxV3ZwaUtYRXUzd3ZBWGdrTUhPODhlSTR5bSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779776950),
('4wxc4zJO79Wlbd0u4xiuiDswskyXbpW8qqsTtdJQ', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQlpMbmp4R2dmQ0RNNVpkZ003MkQxekdlQjlUdmRONHVjRXN2M2xzRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9vcmRlcnMvRUFDMzM1RkEiO3M6NToicm91dGUiO3M6MTc6ImFkbWluLm9yZGVycy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1779780985),
('dFaItcTFXP97e0s8r0CuG9n7g3G0gVoZXETYRUGU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidUNJVXRCRzEzSFFVbENTWG5UMEFmZ0tUN3k4a1U5ZTg5UUd3ekF2VSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1779780686),
('UXnuyj7aPpo6Tn1vFLQobu4cx1DFdki8Ln8uNf0y', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUmI1VzU2NjV6emt3aE5neEdpQW5tdEJROE1nZXV2anNRNFMwVmFHbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2ZyZWUtc3Vic2NyaXB0aW9ucyI7fX0=', 1779778482);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'زياد', 'general', '2026-05-09 13:54:12', '2026-05-18 15:31:59'),
(2, 'site_description', 'احب زياد', 'general', '2026-05-09 13:54:12', '2026-05-09 15:02:36'),
(3, 'site_keywords', NULL, 'general', '2026-05-09 13:54:12', '2026-05-09 13:54:12'),
(4, 'contact_whatsapp', '12345678', 'contact', '2026-05-09 13:54:12', '2026-05-09 14:44:49'),
(5, 'contact_email', 'zahmd4218@gmail.com', 'contact', '2026-05-09 13:54:12', '2026-05-09 14:44:49'),
(6, 'theme_color', '#2139b0', 'branding', '2026-05-09 13:54:12', '2026-05-11 21:34:31'),
(7, 'dark_mode_default', '0', 'general', '2026-05-09 13:54:12', '2026-05-09 18:58:33'),
(8, 'whatsapp', '775296025', 'contact', '2026-05-09 18:58:33', '2026-05-11 19:05:04'),
(9, 'support_email', 'amjad200002@gmail.com', 'contact', '2026-05-09 18:58:33', '2026-05-11 20:04:07'),
(10, 'instagram', 'ييي', 'social', '2026-05-09 18:58:33', '2026-05-10 14:32:18'),
(11, 'twitter', 'ييي', 'social', '2026-05-09 18:58:33', '2026-05-10 14:32:18'),
(12, 'logo_path', 'branding/logo_1779129770.png', 'branding', '2026-05-09 19:01:21', '2026-05-18 15:42:50'),
(13, 'payment_bank_name', 'ابوبكر', 'payment', '2026-05-10 19:55:33', '2026-05-10 20:46:02'),
(14, 'payment_bank_account', '123456789', 'payment', '2026-05-10 19:55:33', '2026-05-10 20:46:02'),
(15, 'payment_bank_iban', '12345678', 'payment', '2026-05-10 19:55:33', '2026-05-11 20:05:03'),
(16, 'loyalty_earn_methods', 'اشترك في المتجر واحصل على 50 نقطة فورية\r\nاطلب أي باقة واحصل على نقطة مقابل كل ريال\r\nقيم المنتجات التي اشتريتها واحصل على 10 نقاط\r\nىى', 'loyalty', '2026-05-15 21:11:17', '2026-05-15 21:12:33'),
(17, 'loyalty_redeem_methods', 'استبدل 500 نقطة بخصم 10% على طلبك\r\nاستبدل 1000 نقطة بشهر مجاني VIP\r\nاستبدل نقاطك بكوبونات هدايا', 'loyalty', '2026-05-15 21:11:17', '2026-05-15 21:11:17'),
(18, 'developer_info', 'المهندس زياد', 'general', '2026-05-26 02:18:20', '2026-05-26 02:18:20'),
(19, 'developer_link', 'https://wa.me/778340075', 'general', '2026-05-26 02:42:13', '2026-05-26 04:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','editor') NOT NULL DEFAULT 'user',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'زياد', 'zahmd4218@gmail.com', '0538577978', NULL, '$2y$12$juDPoUKimzQtPXvL1yFcb.8ID5N7tzHxj.L0fa79tEcFVfl4AXvaO', 'admin', 1, NULL, '2026-05-09 13:40:44', '2026-05-14 20:39:34'),
(9, 'hfn', 'zeyadalsharbi@gmail.com', '0538571111', NULL, '$2y$12$PdU7MP1AJZywgJgeGjnIDeYpcErBYMaf5wiqiP1MaZFpfbKN/Gcey', 'user', 1, NULL, '2026-05-10 14:08:08', '2026-05-10 14:09:01'),
(12, 'مو', 'zahmd42181@gmail.com', '05385771978', NULL, '$2y$12$XoOBl8.Jfku88QtH0pGRlOvWd3hl//lzGyB6VjIgo0/iXWZtUrGDO', 'user', 1, NULL, '2026-05-10 14:52:50', '2026-05-10 14:52:50'),
(13, 'ابو بكر', 'abu77549abu@gmail.com', '0538577555', NULL, '$2y$12$fzwgiY7mf/prLd/v6HToX.sVpSKEyPsbGW3uoD1SMUU8YHiQRODEy', 'user', 1, NULL, '2026-05-10 18:11:47', '2026-05-11 19:44:05'),
(15, 'امجد', 'amjadalmaqdasheii@gmail.com', '0538577000', NULL, '$2y$12$Qc4ovpLMfeBQo9zePzIwZeH52iNQPyNt65xcKtVWtHBX9tX5i9W22', 'admin', 1, NULL, '2026-05-11 19:47:45', '2026-05-18 15:29:38'),
(16, 'زياد', 'stakestake111115@gmail.com', '0577834007', NULL, '$2y$12$XdROkKb6YeuG0ephBHlkbeBjsq8JYwtqHvGU5YSRi5x2/GSpq7V/C', 'user', 1, NULL, '2026-05-14 22:14:39', '2026-05-14 22:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_free_subscriptions`
--

CREATE TABLE `user_free_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `free_subscription_plan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `mac_address` varchar(255) NOT NULL,
  `claimed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','expired','revoked','requested') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_free_subscriptions`
--

INSERT INTO `user_free_subscriptions` (`id`, `user_id`, `free_subscription_plan_id`, `category_name`, `mac_address`, `claimed_at`, `expires_at`, `status`, `created_at`, `updated_at`) VALUES
(14, 13, NULL, 'ت', 'UNKNOWN', '2026-05-10 20:57:07', NULL, 'requested', '2026-05-10 20:57:07', '2026-05-10 20:57:07'),
(16, 15, 14, 'هولك', 'UNKNOWN', '2026-05-11 20:41:53', '2026-05-12 20:43:35', 'active', '2026-05-11 20:41:53', '2026-05-11 20:43:35'),
(17, 15, 15, NULL, 'ASSIGNED-BY-ADMIN', '2026-05-11 20:45:05', '2027-05-11 20:46:17', 'active', '2026-05-11 20:45:05', '2026-05-11 20:46:17'),
(18, 15, 16, NULL, 'ASSIGNED-BY-ADMIN', '2026-05-11 20:46:57', '2026-05-22 20:46:57', 'active', '2026-05-11 20:46:57', '2026-05-11 20:46:57'),
(19, 3, 17, 'كاس العالم', 'UNKNOWN', '2026-05-11 22:45:25', '2029-10-03 15:38:09', 'active', '2026-05-11 22:45:25', '2026-05-18 15:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `mac_address` varchar(255) DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `last_activity_at` timestamp NULL DEFAULT NULL,
  `logout_at` timestamp NULL DEFAULT NULL,
  `status` enum('active','ended') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `mac_address`, `device_id`, `ip_address`, `user_agent`, `session_id`, `login_at`, `last_activity_at`, `logout_at`, `status`, `created_at`, `updated_at`) VALUES
(2, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'lpyR1qCo0cBZUD08uWJa9FwXqNE8xPaejG8zVvpH', '2026-05-09 13:41:09', '2026-05-09 13:41:59', '2026-05-09 13:41:59', 'ended', '2026-05-09 13:41:09', '2026-05-09 13:41:59'),
(3, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'VdqspG0GTxLFWAkGGRLjDOJet99ElTl6c5V9SxPE', '2026-05-09 13:42:06', '2026-05-09 13:42:06', NULL, 'active', '2026-05-09 13:42:06', '2026-05-09 13:42:06'),
(4, 3, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'PR3prIuBhw6G1aqN9RQr5eE4tvXxETrToUsMroZq', '2026-05-09 13:42:07', '2026-05-09 15:34:55', '2026-05-09 15:34:55', 'ended', '2026-05-09 13:42:07', '2026-05-09 15:34:55'),
(5, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'BRu6LCLAkRTAYAH9ygt8O6xbUdkCxgwaaqkq5Hnr', '2026-05-09 15:35:03', '2026-05-09 15:35:03', NULL, 'active', '2026-05-09 15:35:03', '2026-05-09 15:35:03'),
(6, 3, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '6zhIiN6R33HORGJRBX0DIIwoCW91TRZj8zI4Bosi', '2026-05-09 15:35:04', '2026-05-09 16:52:21', '2026-05-09 16:52:21', 'ended', '2026-05-09 15:35:04', '2026-05-09 16:52:21'),
(8, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'h0NxmTBmfQEIHfFJZZOcGBJHVCvh6DSF3WGjVjkP', '2026-05-09 16:57:08', '2026-05-09 16:57:08', NULL, 'active', '2026-05-09 16:57:08', '2026-05-09 16:57:08'),
(9, 3, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'jLQnYktyZjDP16aAMfp2CkFJdZg5sqwtzsp1fNO6', '2026-05-09 16:57:08', '2026-05-09 17:04:30', '2026-05-09 17:04:30', 'ended', '2026-05-09 16:57:08', '2026-05-09 17:04:30'),
(11, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'FxS9512WdrxlrZ1D7sxGLoWf3VBsmIASDZs2kqAI', '2026-05-09 17:07:03', '2026-05-09 17:07:03', NULL, 'active', '2026-05-09 17:07:03', '2026-05-09 17:07:03'),
(12, 3, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'lRlt1ZuamSNdTHWIW0O6VX0hWuDNJuMcLuZbyIlX', '2026-05-09 17:07:04', '2026-05-09 17:32:56', '2026-05-09 17:32:56', 'ended', '2026-05-09 17:07:04', '2026-05-09 17:32:56'),
(14, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'KJbrUo6QOQgH1QVy3AY5ske6SnoOjAJHnxc6Fdng', '2026-05-09 17:39:27', '2026-05-09 17:39:27', NULL, 'active', '2026-05-09 17:39:27', '2026-05-09 17:39:27'),
(15, 3, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'syb4wHrKWdqhG1DmJfsbOs1AY8yxt3ypyZ6NsPPI', '2026-05-09 17:39:27', '2026-05-09 17:41:31', '2026-05-09 17:41:31', 'ended', '2026-05-09 17:39:27', '2026-05-09 17:41:31'),
(17, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'lUuWKOrT8N7eFwjjgY8zj1RPDeWLY4avVTPkJ1to', '2026-05-09 17:44:58', '2026-05-09 17:44:58', NULL, 'active', '2026-05-09 17:44:58', '2026-05-09 17:44:58'),
(18, 3, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YKXsITH0T2Y12vtAwXfswDbCBJwntrYfSMVSohZY', '2026-05-09 17:44:59', '2026-05-09 17:46:09', '2026-05-09 17:46:09', 'ended', '2026-05-09 17:44:59', '2026-05-09 17:46:09'),
(20, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'oreE5XPVgfnqW29bFT4sSZgIvWcfqjWbzwb3RjaH', '2026-05-09 17:53:09', '2026-05-09 17:53:09', NULL, 'active', '2026-05-09 17:53:09', '2026-05-09 17:53:09'),
(21, 3, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'GenBVNPxXzUirFKM2BCkw7iDi6qMYsoN0cn1zTfA', '2026-05-09 17:53:10', '2026-05-09 17:55:26', '2026-05-09 17:55:26', 'ended', '2026-05-09 17:53:10', '2026-05-09 17:55:26'),
(23, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'kWQim1hnEdp2V9dz0EY6E0B1bgZiSIhxCO7UzaLw', '2026-05-09 17:56:15', '2026-05-09 17:56:15', NULL, 'active', '2026-05-09 17:56:15', '2026-05-09 17:56:15'),
(24, 3, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'nsQ4FFs6NB4ZQNkaiTMGnKdUFvndO4MUWtdtButa', '2026-05-09 17:56:16', '2026-05-09 17:59:04', '2026-05-09 17:59:04', 'ended', '2026-05-09 17:56:16', '2026-05-09 17:59:04'),
(26, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'opwRQwft5Ic7yyqjRALS8AKV9kjtCD19TFGIv9Q4', '2026-05-09 18:02:48', '2026-05-09 18:02:48', NULL, 'active', '2026-05-09 18:02:48', '2026-05-09 18:02:48'),
(33, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Kz9lFuuYWucYCl1ML0KtrjEeQL0XnOFGONcdkoYm', '2026-05-10 12:50:07', '2026-05-10 12:50:07', NULL, 'active', '2026-05-10 12:50:07', '2026-05-10 12:50:07'),
(34, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'iYzmscGCLqAcc3Rp5iTWCVGMKAVz28L7ifg0T0T7', '2026-05-10 13:44:22', '2026-05-10 13:44:22', NULL, 'active', '2026-05-10 13:44:22', '2026-05-10 13:44:22'),
(35, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'LTrmo8WOoybscSeeBZXwxzXdLnk2FDFlGy29r9hU', '2026-05-10 13:56:27', '2026-05-10 13:56:27', NULL, 'active', '2026-05-10 13:56:27', '2026-05-10 13:56:27'),
(36, 9, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'biWJnmY8p790TfUTyfGt9K2Zb2Bn836fvmjOXuH6', '2026-05-10 14:09:01', '2026-05-10 14:09:05', '2026-05-10 14:09:05', 'ended', '2026-05-10 14:09:01', '2026-05-10 14:09:05'),
(38, 13, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'djGb49skgoymM0xdSZmJrj74LRdJLLpl1Bp9QKvd', '2026-05-10 18:12:29', '2026-05-10 21:14:13', NULL, 'active', '2026-05-10 18:12:29', '2026-05-10 21:14:13'),
(39, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'x9JejLzd3Gdn3bErlvaVjwGdpOoYbu8EpqpCgiv4', '2026-05-11 18:59:58', '2026-05-11 18:59:58', NULL, 'active', '2026-05-11 18:59:58', '2026-05-11 18:59:58'),
(40, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'tMU5c6GOEHF4gKaMKaqWijhEIfJKmbaGmoaLnZSN', '2026-05-11 19:07:11', '2026-05-11 19:44:28', '2026-05-11 19:44:28', 'ended', '2026-05-11 19:07:11', '2026-05-11 19:44:28'),
(41, 15, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'EnQd9pE1LcKjhwZTxFx7c6yvNpEdHNupZ5t4iWdm', '2026-05-11 19:48:07', '2026-05-11 20:05:25', NULL, 'active', '2026-05-11 19:48:07', '2026-05-11 20:05:25'),
(42, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '3abSRpBpQqPNMcVEWCKmvmguQu3YCb95xKQokKfC', '2026-05-11 20:05:26', '2026-05-11 20:05:26', NULL, 'active', '2026-05-11 20:05:26', '2026-05-11 20:05:26'),
(43, 15, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'NLmzYnaOnVaATAqTctYnqua25Un7dcubCg4zSXUT', '2026-05-11 20:05:26', '2026-05-11 20:05:43', NULL, 'active', '2026-05-11 20:05:26', '2026-05-11 20:05:43'),
(44, 15, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'uXPZVa4hP9VKdCdwOGEE2yPpCSoMAl4iLKgCz7uD', '2026-05-11 20:05:44', '2026-05-11 20:05:44', NULL, 'active', '2026-05-11 20:05:44', '2026-05-11 20:05:44'),
(45, 15, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'STIv33LTgNwkHfyp6eBvwbkOa7SElF5orNoiXHeu', '2026-05-11 20:05:44', '2026-05-11 20:05:49', '2026-05-11 20:05:49', 'ended', '2026-05-11 20:05:44', '2026-05-11 20:05:49'),
(46, 15, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'STIv33LTgNwkHfyp6eBvwbkOa7SElF5orNoiXHeu', '2026-05-11 20:05:50', '2026-05-11 20:06:06', NULL, 'active', '2026-05-11 20:05:50', '2026-05-11 20:06:06'),
(47, 15, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '0OWNpEUNZtlqKlZdoYZpoOmOYSD2wjPr2mZCd0Nx', '2026-05-11 20:06:07', '2026-05-11 20:06:07', NULL, 'active', '2026-05-11 20:06:07', '2026-05-11 20:06:07'),
(48, 15, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'i1i9KCMkonBQ8WtA62UnKO8Ihx4vxpupjVMgOuQ9', '2026-05-11 20:06:07', '2026-05-11 22:38:37', NULL, 'active', '2026-05-11 20:06:07', '2026-05-11 22:38:37'),
(50, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'qAGtHuNX4skS8QJStDGQDbr3v7moE0AwJbWH9qzC', '2026-05-11 22:40:30', '2026-05-11 22:40:30', NULL, 'active', '2026-05-11 22:40:30', '2026-05-11 22:40:30'),
(51, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '9ZpBhc9wx63EGtoNcXmT1Z3dmyLFrhJka8nynVXi', '2026-05-11 22:43:58', '2026-05-11 22:50:25', NULL, 'active', '2026-05-11 22:43:58', '2026-05-11 22:50:25'),
(52, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'mqECI3EkA26aIJBZxsYn6EXpviz7DmHJfKoapKd1', '2026-05-14 19:52:31', '2026-05-14 20:03:39', '2026-05-14 20:03:39', 'ended', '2026-05-14 19:52:31', '2026-05-14 20:03:39'),
(53, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'NxiWHVb90fBegisioVbskBJQBS7X7GSxBLNuWpTq', '2026-05-14 20:17:59', '2026-05-14 20:37:15', NULL, 'active', '2026-05-14 20:17:59', '2026-05-14 20:37:15'),
(54, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'WSf54rCkIJQKV3XxgDIITUHNDppZKsMIwhuKqJcS', '2026-05-14 20:37:16', '2026-05-14 20:37:16', NULL, 'active', '2026-05-14 20:37:16', '2026-05-14 20:37:16'),
(55, 3, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'q2JJgoww0kMQaQWuqdhDzdQdcKeSuAVt2qaKCXzs', '2026-05-14 20:37:16', '2026-05-14 20:38:06', '2026-05-14 20:38:06', 'ended', '2026-05-14 20:37:16', '2026-05-14 20:38:06'),
(56, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'nBXwxNSnnN3IEQ64TiaUQaYLuoOaBWHv3dwHHGNV', '2026-05-14 20:41:23', '2026-05-14 22:37:05', NULL, 'active', '2026-05-14 20:41:23', '2026-05-14 22:37:05'),
(57, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'xEmnojmWn9rLviIYKCSvhA0ByaTu5IsbiI28Txqv', '2026-05-15 20:36:29', '2026-05-15 20:36:29', NULL, 'active', '2026-05-15 20:36:29', '2026-05-15 20:36:29'),
(58, 15, NULL, 'DEV-d7d03540', '192.168.43.68', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'IhwrQbdgqLQ9TZIJ4BJZYXVGfO0TpHEhOeS72ry6', '2026-05-18 15:28:36', '2026-05-18 15:28:36', NULL, 'active', '2026-05-18 15:28:36', '2026-05-18 15:28:36'),
(59, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'LATC5oHTiexWEcNpWlQu2JP4m9bocuCZaOaUMBr8', '2026-05-18 15:29:05', '2026-05-18 15:29:05', NULL, 'active', '2026-05-18 15:29:05', '2026-05-18 15:29:05'),
(60, 3, NULL, 'DEV-d7d03540', '192.168.43.68', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'CmUtdkcf2FaiLZ2A2xPBpJpsYAS94j4o22pTEuN3', '2026-05-18 15:31:21', '2026-05-18 15:31:21', NULL, 'active', '2026-05-18 15:31:21', '2026-05-18 15:31:21'),
(61, 3, NULL, 'DEV-2e0849c2', '192.168.0.169', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'C9iJ6YQyHaCkIhiH33FAeekgYCtvihexMFDQl8PC', '2026-05-18 15:40:45', '2026-05-18 16:58:26', NULL, 'active', '2026-05-18 15:40:45', '2026-05-18 16:58:26'),
(62, 3, NULL, 'DEV-2e0849c2', '192.168.0.169', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'dAIy6pu0opVAD6pmLIIVhs2PC8i26EEOpy7ricej', '2026-05-18 16:58:28', '2026-05-18 16:58:28', NULL, 'active', '2026-05-18 16:58:28', '2026-05-18 16:58:28'),
(63, 3, NULL, NULL, '192.168.0.169', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'P3EPYoMJjgVpfnf1sE1WUSFP5jvCBijDt7rjeCLZ', '2026-05-18 16:58:28', '2026-05-18 17:13:21', NULL, 'active', '2026-05-18 16:58:28', '2026-05-18 17:13:21'),
(64, 3, NULL, 'DEV-497e8bc7', '192.168.43.93', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'mDdHo5bREr4AXyg9ecg2XG45RWvkEM1QQKZfOFVD', '2026-05-18 18:36:06', '2026-05-18 18:36:06', NULL, 'active', '2026-05-18 18:36:06', '2026-05-18 18:36:06'),
(65, 3, NULL, 'DEV-497e8bc7', '192.168.43.93', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'Hr086bNBV524PD0npNa0Hr9rSATY31piRmavS2cF', '2026-05-18 19:23:42', '2026-05-18 19:23:42', NULL, 'active', '2026-05-18 19:23:42', '2026-05-18 19:23:42'),
(66, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'WB0jB9tB6vDRdWdl1mCEOBlFqzwHFzoiP4wN4mrZ', '2026-05-18 19:25:13', '2026-05-18 19:25:13', NULL, 'active', '2026-05-18 19:25:13', '2026-05-18 19:25:13'),
(67, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'xbeXwwZTTnHilc2k55ZLWtnHueuweUQzkLKEtYDF', '2026-05-18 19:26:36', '2026-05-18 19:26:36', NULL, 'active', '2026-05-18 19:26:36', '2026-05-18 19:26:36'),
(68, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '0dsK77HUZZljleHcFwyweLPdK3gF3cCpXuX344mJ', '2026-05-26 01:54:42', '2026-05-26 01:56:42', NULL, 'active', '2026-05-26 01:54:42', '2026-05-26 01:56:42'),
(69, 3, NULL, 'DEV-fd50da64', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'NK0WDmTNTy5Fag3MABSF8wKvGkiEul1fAL6sqJhz', '2026-05-26 01:56:43', '2026-05-26 01:56:43', NULL, 'active', '2026-05-26 01:56:43', '2026-05-26 01:56:43'),
(70, 3, NULL, NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '4wxc4zJO79Wlbd0u4xiuiDswskyXbpW8qqsTtdJQ', '2026-05-26 01:56:44', '2026-05-26 04:36:25', NULL, 'active', '2026-05-26 01:56:44', '2026-05-26 04:36:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `free_subscription_plans`
--
ALTER TABLE `free_subscription_plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `free_subscription_plans_is_active_index` (`is_active`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guide_steps`
--
ALTER TABLE `guide_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guide_steps_guide_id_foreign` (`guide_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_status_index` (`status`),
  ADD KEY `orders_created_at_index` (`created_at`),
  ADD KEY `orders_order_number_index` (`order_number`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `order_status_history`
--
ALTER TABLE `order_status_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_status_history_user_id_foreign` (`user_id`),
  ADD KEY `order_status_history_order_id_status_type_index` (`order_id`,`status_type`),
  ADD KEY `order_status_history_created_at_index` (`created_at`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_index` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_index` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_free_subscriptions`
--
ALTER TABLE `user_free_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_free_subscriptions_status_index` (`status`),
  ADD KEY `user_free_subscriptions_user_id_index` (`user_id`),
  ADD KEY `user_free_subscriptions_free_subscription_plan_id_index` (`free_subscription_plan_id`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_sessions_user_id_index` (`user_id`),
  ADD KEY `user_sessions_session_id_index` (`session_id`),
  ADD KEY `user_sessions_status_index` (`status`),
  ADD KEY `user_sessions_login_at_index` (`login_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `free_subscription_plans`
--
ALTER TABLE `free_subscription_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guide_steps`
--
ALTER TABLE `guide_steps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_status_history`
--
ALTER TABLE `order_status_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_free_subscriptions`
--
ALTER TABLE `user_free_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `guide_steps`
--
ALTER TABLE `guide_steps`
  ADD CONSTRAINT `guide_steps_guide_id_foreign` FOREIGN KEY (`guide_id`) REFERENCES `guides` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_status_history`
--
ALTER TABLE `order_status_history`
  ADD CONSTRAINT `order_status_history_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_status_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_free_subscriptions`
--
ALTER TABLE `user_free_subscriptions`
  ADD CONSTRAINT `user_free_subscriptions_free_subscription_plan_id_foreign` FOREIGN KEY (`free_subscription_plan_id`) REFERENCES `free_subscription_plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_free_subscriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
