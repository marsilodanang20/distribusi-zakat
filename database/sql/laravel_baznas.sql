-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2025 at 01:23 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_baznas`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distribusi_zakat`
--

CREATE TABLE `distribusi_zakat` (
  `id` bigint UNSIGNED NOT NULL,
  `mustahik_id` bigint UNSIGNED NOT NULL,
  `kategori_mustahik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_hak` int DEFAULT NULL,
  `jenis_zakat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distribusi_beras` int DEFAULT NULL,
  `distribusi_uang` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distribusi_zakat`
--

INSERT INTO `distribusi_zakat` (`id`, `mustahik_id`, `kategori_mustahik`, `jumlah_hak`, `jenis_zakat`, `distribusi_beras`, `distribusi_uang`, `created_at`, `updated_at`) VALUES
(6, 2, 'Fakir', 1, 'Beras', 3, 0, '2025-12-23 15:32:23', '2025-12-23 15:56:12'),
(7, 2, 'Fakir', 1, 'Uang', 0, 40000, '2025-12-23 15:46:22', '2025-12-23 15:46:22'),
(8, 1, 'Miskin', 2, 'Beras', 5, 0, '2025-12-23 18:15:11', '2025-12-23 18:15:11'),
(9, 3, 'Ghorim', 4, 'Uang', 0, 160000, '2025-12-23 18:16:02', '2025-12-23 18:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jumlah_zakat`
--

CREATE TABLE `jumlah_zakat` (
  `id` bigint UNSIGNED NOT NULL,
  `jumlah_beras` int DEFAULT NULL,
  `jumlah_uang` int DEFAULT NULL,
  `total_beras` int DEFAULT NULL,
  `total_uang` int DEFAULT NULL,
  `total_distribusi` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jumlah_zakat`
--

INSERT INTO `jumlah_zakat` (`id`, `jumlah_beras`, `jumlah_uang`, `total_beras`, `total_uang`, `total_distribusi`, `created_at`, `updated_at`) VALUES
(1, 0, 5763996, 13, 6034000, 15, NULL, '2025-12-23 18:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_mustahik`
--

CREATE TABLE `kategori_mustahik` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_hak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_mustahik`
--

INSERT INTO `kategori_mustahik` (`id`, `nama_kategori`, `jumlah_hak`, `created_at`, `updated_at`) VALUES
(1, 'Ghorim', '4', NULL, NULL),
(2, 'Fakir', '1', NULL, NULL),
(3, 'Miskin', '2', NULL, NULL),
(4, 'Mualaf', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_23_185155_create_articles_table', 1),
(6, '2023_04_23_185207_create_galleries_table', 1),
(7, '2023_04_23_185429_create_muzakki_table', 1),
(8, '2023_04_23_185436_create_mustahik_table', 1),
(9, '2023_04_23_185600_create_kategori_mustahik_table', 1),
(10, '2023_04_23_185738_create_pengumpulan_zakat_table', 1),
(11, '2023_04_23_185750_create_distribusi_zakat_table', 1),
(12, '2023_04_23_191130_create_jumlah_zakat_table', 1),
(13, '2025_11_29_164052_add_caption_to_galleries_table', 2),
(14, '2025_12_24_041036_update_pengumpulan_zakat_table_structure', 3),
(15, '2025_12_24_042715_update_distribusi_zakat_table_structure', 4);

-- --------------------------------------------------------

--
-- Table structure for table `mustahik`
--

CREATE TABLE `mustahik` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_mustahik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_mustahik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_hak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `handphone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_kk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mustahik`
--

INSERT INTO `mustahik` (`id`, `nama_mustahik`, `kategori_mustahik`, `jumlah_hak`, `alamat`, `handphone`, `nomor_kk`, `created_at`, `updated_at`) VALUES
(1, 'Zainal', 'Miskin', '2', 'Cirebon', '01234567890', '123456789123456', '2025-11-26 04:53:36', '2025-12-23 16:18:54'),
(2, 'Abdul', 'Fakir', '1', 'Cirebon', '08678978911', '12345675676718990', '2025-11-26 05:04:05', '2025-12-23 14:51:29'),
(3, 'Fikri', 'Ghorim', '4', 'Cirebon', '08985678912', '3201234567891011', '2025-12-23 16:20:22', '2025-12-23 16:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `muzakki`
--

CREATE TABLE `muzakki` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_muzakki` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_tanggungan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `handphone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_kk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `muzakki`
--

INSERT INTO `muzakki` (`id`, `nama_muzakki`, `jumlah_tanggungan`, `alamat`, `handphone`, `nomor_kk`, `created_at`, `updated_at`) VALUES
(1, 'Raihan Biruni', '4', 'Cirebon', '01234567890', '320111111111111111', '2025-11-26 04:52:44', '2025-12-23 16:17:33'),
(2, 'Raka', '2', 'Cirebon', '01234567890', '320222222222222222', '2025-11-26 05:01:08', '2025-12-23 16:17:44'),
(3, 'Danang', '1', 'Cirebon', '0123456777', '32033333333333333', '2025-11-26 05:02:18', '2025-12-23 16:17:53'),
(4, 'Ilham', '3', 'Cirebon', '012345678901', '320444444444444444', '2025-12-23 08:55:58', '2025-12-23 16:17:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengumpulan_zakat`
--

CREATE TABLE `pengumpulan_zakat` (
  `id` bigint UNSIGNED NOT NULL,
  `muzakki_id` bigint UNSIGNED NOT NULL,
  `jumlah_tanggungan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_tanggungandibayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bayar_beras` int DEFAULT NULL,
  `bayar_uang` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumpulan_zakat`
--

INSERT INTO `pengumpulan_zakat` (`id`, `muzakki_id`, `jumlah_tanggungan`, `jenis_bayar`, `jumlah_tanggungandibayar`, `bayar_beras`, `bayar_uang`, `created_at`, `updated_at`) VALUES
(4, 1, '3', 'Uang', '3', 9, 0, '2025-12-23 14:17:55', '2025-12-23 16:29:35'),
(5, 2, '3', 'Uang', '2', 0, 80000, '2025-12-23 14:19:46', '2025-12-23 16:09:47'),
(6, 1, '3', 'Beras', '3', 9, 0, '2025-12-23 15:17:03', '2025-12-23 16:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@zaqat.com', NULL, '$2y$10$oMhbqgEKxh2Ukkl62I6ineTy/iLFKEMFAwuivQwIpDucmWauGVSK6', NULL, NULL, NULL),
(2, 'Danang', 'danang@gmail.com', NULL, '$2y$10$OFOA02qoMtCb8.pLv8KnzegHT0dzCV2PKxvi/paGx6DCky2o2yZLi', 'q4YiYZpkFR9v5S9mJI4uAb3FJJjZm7oCrFe3CQHWroLLSXBpJUHkcS0rTueS', '2025-11-26 01:27:47', '2025-11-26 01:27:47'),
(3, 'Administrator', 'admin@gmail.com', NULL, '$2y$10$5vgCb.3uGnJwmZMOKyCGy.YDh9/CqRfmXG2U.sH3efslMBZJT9lRW', 'E7NxSLtyrPTb6afmtkFoWQ3jJv9jlSuK5lcqspIXa5umcbDCf3o7lSquShVU', '2025-11-30 05:11:32', '2025-11-30 05:11:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distribusi_zakat`
--
ALTER TABLE `distribusi_zakat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jumlah_zakat`
--
ALTER TABLE `jumlah_zakat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_mustahik`
--
ALTER TABLE `kategori_mustahik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mustahik`
--
ALTER TABLE `mustahik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muzakki`
--
ALTER TABLE `muzakki`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengumpulan_zakat`
--
ALTER TABLE `pengumpulan_zakat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengumpulan_zakat_muzakki_id_foreign` (`muzakki_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `distribusi_zakat`
--
ALTER TABLE `distribusi_zakat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jumlah_zakat`
--
ALTER TABLE `jumlah_zakat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori_mustahik`
--
ALTER TABLE `kategori_mustahik`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mustahik`
--
ALTER TABLE `mustahik`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `muzakki`
--
ALTER TABLE `muzakki`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengumpulan_zakat`
--
ALTER TABLE `pengumpulan_zakat`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengumpulan_zakat`
--
ALTER TABLE `pengumpulan_zakat`
  ADD CONSTRAINT `pengumpulan_zakat_muzakki_id_foreign` FOREIGN KEY (`muzakki_id`) REFERENCES `muzakki` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
