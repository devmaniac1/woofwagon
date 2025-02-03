-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2025 at 05:20 PM
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
-- Database: `woofwagon`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2024_12_30_055625_create_products_table', 1),
(4, '2024_12_31_060213_create_personal_access_tokens_table', 1),
(5, '2025_01_22_125510_create_orders_table', 1),
(6, '0001_01_01_000000_create_users_table', 2),
(7, '2025_01_26_092336_create_orders_table', 3),
(8, '2025_01_26_100248_create_orders_table', 4),
(9, '2025_01_26_110804_create_orders_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `payment_method` enum('cash_on_delivery','card_on_delivery') NOT NULL,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total` decimal(8,2) NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` enum('Pending','Delivered','Cancelled') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `payment_method`, `discount`, `total`, `products`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Nishika', 'nishika@gmail.com', '0777878692', '52/1 Hendala Wattala', 'cash_on_delivery', 6.75, 38.25, '\"{\\\"4\\\":{\\\"name\\\":\\\"Pedigree\\\",\\\"quantity\\\":\\\"2\\\",\\\"price\\\":\\\"12.00\\\",\\\"total\\\":24},\\\"5\\\":{\\\"name\\\":\\\"Chew toy\\\",\\\"quantity\\\":1,\\\"price\\\":\\\"6.00\\\",\\\"total\\\":\\\"6.00\\\"},\\\"1\\\":{\\\"name\\\":\\\"Kibbles and Bits\\\",\\\"quantity\\\":1,\\\"price\\\":\\\"15.00\\\",\\\"total\\\":\\\"15.00\\\"}}\"', 'Cancelled', '2025-01-29 08:48:49', '2025-01-29 09:03:24'),
(11, 'Shenaya', 'shenaya@gmail.com', '0774290498', 'Colombo -13', 'card_on_delivery', 3.60, 20.40, '\"{\\\"4\\\":{\\\"name\\\":\\\"Pedigree\\\",\\\"quantity\\\":\\\"2\\\",\\\"price\\\":\\\"12.00\\\",\\\"total\\\":24}}\"', 'Delivered', '2025-01-29 08:57:39', '2025-01-29 09:03:06'),
(12, 'Jude', 'jude@gmail.com', '12345678', 'Wattala, Sri Lanka', 'cash_on_delivery', 4.35, 18.65, '\"{\\\"4\\\":{\\\"name\\\":\\\"Pedigree\\\",\\\"quantity\\\":1,\\\"price\\\":\\\"12.00\\\",\\\"total\\\":\\\"12.00\\\"},\\\"6\\\":{\\\"name\\\":\\\"Dog Robe\\\",\\\"quantity\\\":1,\\\"price\\\":\\\"5.00\\\",\\\"total\\\":\\\"5.00\\\"},\\\"5\\\":{\\\"name\\\":\\\"Chew toy\\\",\\\"quantity\\\":1,\\\"price\\\":\\\"6.00\\\",\\\"total\\\":\\\"6.00\\\"}}\"', 'Delivered', '2025-01-30 11:32:23', '2025-02-01 07:30:29'),
(13, 'Shenaya', 'shenaya@gmail.com', '0774290498', 'Sri Lanka', 'card_on_delivery', 2.70, 15.30, '\"{\\\"8\\\":{\\\"name\\\":\\\"Spike balls\\\",\\\"quantity\\\":1,\\\"price\\\":\\\"8.00\\\",\\\"total\\\":\\\"8.00\\\"},\\\"10\\\":{\\\"name\\\":\\\"Chicken Flavour Cookies\\\",\\\"quantity\\\":1,\\\"price\\\":\\\"10.00\\\",\\\"total\\\":\\\"10.00\\\"}}\"', 'Cancelled', '2025-01-30 12:07:32', '2025-01-30 12:08:59'),
(14, 'Shenaya', 'shenaya@gmail.com', '0774290498', 'Mt. Lavinia', 'card_on_delivery', 6.75, 38.25, '\"{\\\"1\\\":{\\\"name\\\":\\\"Kibbles and Bits\\\",\\\"quantity\\\":3,\\\"price\\\":\\\"15.00\\\",\\\"total\\\":45}}\"', 'Pending', '2025-02-01 03:07:32', '2025-02-01 03:07:32'),
(15, 'Jude', 'jude@gmail.com', '0777878692', 'Wattala', 'cash_on_delivery', 0.45, 2.55, '\"{\\\"11\\\":{\\\"name\\\":\\\"Pet Toy\\\",\\\"quantity\\\":1,\\\"price\\\":\\\"3.00\\\",\\\"total\\\":\\\"3.00\\\"}}\"', 'Cancelled', '2025-02-01 07:28:55', '2025-02-01 07:30:34'),
(16, 'Shivanika Ramachandran', 'shiv@gmail.com', '12345678', 'Kotahena', 'cash_on_delivery', 3.45, 19.55, '\"{\\\"6\\\":{\\\"name\\\":\\\"Dog Robe\\\",\\\"quantity\\\":1,\\\"price\\\":\\\"5.00\\\",\\\"total\\\":\\\"5.00\\\"},\\\"11\\\":{\\\"name\\\":\\\"Pet Toy\\\",\\\"quantity\\\":1,\\\"price\\\":\\\"3.00\\\",\\\"total\\\":\\\"3.00\\\"},\\\"1\\\":{\\\"name\\\":\\\"Kibbles and Bits\\\",\\\"quantity\\\":1,\\\"price\\\":\\\"15.00\\\",\\\"total\\\":\\\"15.00\\\"}}\"', 'Delivered', '2025-02-01 10:41:29', '2025-02-01 10:44:07');

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
  `name` varchar(255) NOT NULL,
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
(1, 'App\\Models\\User', 4, 'API Token', '0b8f11370045378703353dab77d5271f78d4d2be9ec7d15cbb38c5067fd53501', '[\"*\"]', NULL, NULL, '2025-01-30 00:56:28', '2025-01-30 00:56:28'),
(2, 'App\\Models\\User', 1, 'woofWagon', '00ad2fb6727a09bc7a48d3d0fa00183dd7df869bf70674f37df4f8dc2faf83a7', '[\"*\"]', NULL, NULL, '2025-01-30 01:47:27', '2025-01-30 01:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Kibbles and Bits', 15.00, 7, 'images/SbY4LMYfnY2Zfwlm7sMViLEaVHwdEUTdfUW8rgtf.jpg', '2025-01-22 07:50:03', '2025-01-29 08:23:32'),
(4, 'Pedigree', 12.00, 10, 'images/Yht4qHM8pYZ2UrdoYtPiTmbLG1SzUUPDOBVv9t6Q.jpg', '2025-01-27 03:39:30', '2025-02-01 10:44:50'),
(6, 'Dog Robe', 5.00, 0, 'images/1pwpbLivosguQhnt8Pnn6BoWKGYHQXKY8Rkf2nkD.jpg', '2025-01-29 08:24:52', '2025-02-01 10:45:45'),
(10, 'Chicken Flavour Cookies', 10.00, 2, 'images/33u4nCC5KQWka66YDyLFAVEJoaKwYUrI1ubDlkeS.png', '2025-01-29 08:40:08', '2025-01-29 08:40:08'),
(11, 'Pet Toy', 3.00, 0, 'images/0bmcfr6Qg3yfnY8E9IGMj1HN3egltRcuJocxOtgJ.jpg', '2025-01-30 12:11:13', '2025-02-01 10:45:15');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `user_type`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shenaya Jayawardene', 'shenaya@gmail.com', '0774290498', 'user', NULL, '$2y$12$KI4cRwebTIltF54S4rCxn.2dXRuABbCkOp1JQnZIIvBt2y.FKgqCm', NULL, '2025-01-22 07:45:58', '2025-02-01 03:08:24'),
(3, 'admin', 'admin@gmail.com', '778700343', 'admin', NULL, '$2y$12$3eldiapMPLtZeL7I7Z.6PunQpW9/16b7HxA/LQsk3J8N2.SkVAsde', NULL, '2025-01-22 07:48:32', '2025-01-30 12:04:07'),
(4, 'Nishika Jayawardene', 'nishika@gmail.com', '0777878692', 'user', NULL, '$2y$12$hNl.K2rChdNuJWg6TsS9U.Crx5NuJ69pIs6dfvMwiBKuQOqTx061q', NULL, '2025-01-29 08:41:21', '2025-01-29 08:41:21'),
(9, 'Judaa', 'jude@gmail.com', '12345678', 'user', NULL, '$2y$12$7ceNz3UPxXmY9vGvg6d1EuZOCD5UjPm9FUzYAjNVzjabxhZZhtcoi', NULL, '2025-01-30 11:23:36', '2025-02-01 03:21:05'),
(10, 'Shivanika Ramachandran', 'shiv@gmail.com', '0774342567', 'user', NULL, '$2y$12$T4f2t5cVXmatD75H2R3D6OTvHarTYCWpC0nFNjx0pdwkSMi0wY6rO', NULL, '2025-02-01 10:38:29', '2025-02-01 10:38:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
