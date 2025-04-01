-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2025 at 06:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehr`
--

-- --------------------------------------------------------

--
-- Table structure for table `allergy`
--

CREATE TABLE `allergy` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `dateTime` datetime NOT NULL,
  `allergy` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allergy`
--

INSERT INTO `allergy` (`id`, `patient_Id`, `dateTime`, `allergy`, `description`, `path`, `created_at`, `updated_at`) VALUES
(3, 1, '2025-03-27 14:28:00', 'Paracetamol', 'description', 'MedicalRecords/Allergy/YEbnnijnrVHvLbtT0gLid83h9WedDuK7XfTEghRT.jpg', '2025-03-26 22:28:47', '2025-03-27 06:38:16'),
(4, 1, '2025-03-27 22:38:00', 'iboprufen', 'test', NULL, '2025-03-27 06:38:32', '2025-03-27 06:38:32');

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
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imaging` int(11) DEFAULT NULL,
  `laboratory` int(11) DEFAULT NULL,
  `histopath` int(11) DEFAULT NULL,
  `microbiology` int(11) DEFAULT NULL,
  `specialtest` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `imaging`, `laboratory`, `histopath`, `microbiology`, `specialtest`, `created_at`, `updated_at`) VALUES
(1, 10, 10, 5, 10, 10, NULL, '2025-03-26 23:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_order`
--

CREATE TABLE `doctor_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `day_number` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `order` varchar(255) DEFAULT NULL,
  `rationale` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_order`
--

INSERT INTO `doctor_order` (`id`, `patient_Id`, `day_number`, `date_time`, `order`, `rationale`, `signature`, `created_at`, `updated_at`) VALUES
(1, 1, 312312, '2025-04-22 00:13:00', '31231', '312', 'signatures/cCNXdTEyF7VxJlBisT0P69H7DJmItmIFEwcdhUtd.jpg', '2025-04-01 08:10:47', '2025-04-01 08:44:04'),
(2, 1, 312312, '2025-04-22 00:13:00', NULL, '312', NULL, '2025-04-01 08:13:24', '2025-04-01 08:13:24'),
(3, 1, 312312, '2025-04-22 00:13:00', '312', '312', 'signatures/d49eByS3NTejstTIkERav2QAY1MWndPXNkuPKz1i.jpg', '2025-04-01 08:13:41', '2025-04-01 08:36:02');

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
-- Table structure for table `histopath`
--

CREATE TABLE `histopath` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `dateTime` datetime NOT NULL,
  `testType` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `histopath`
--

INSERT INTO `histopath` (`id`, `patient_Id`, `dateTime`, `testType`, `result`, `path`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-03-20 13:39:00', '312', 'histopathdas312', 'MedicalRecords/Histopath/VIVJohlETQdvTwhsJ2ut84zHCg7KQfyAfOxNaKhF.jpg', '2025-03-26 21:40:05', '2025-03-26 21:43:51');

-- --------------------------------------------------------

--
-- Table structure for table `imaging`
--

CREATE TABLE `imaging` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `dateTime` datetime NOT NULL,
  `testType` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `imaging`
--

INSERT INTO `imaging` (`id`, `patient_Id`, `dateTime`, `testType`, `result`, `path`, `created_at`, `updated_at`) VALUES
(10, 1, '2025-03-19 15:17:00', '31', '2312', 'MedicalRecords/Imaging/IyRawfTl9H3GLuQYqWjEPauQeInuKN2Xm4dhQt2O.jpg', '2025-03-26 23:17:36', '2025-03-26 23:17:36');

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
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `dateTime` datetime NOT NULL,
  `testType` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`id`, `patient_Id`, `dateTime`, `testType`, `result`, `path`, `created_at`, `updated_at`) VALUES
(4, 1, '2025-03-13 13:39:00', '312', '31dsadas312', NULL, '2025-03-26 21:39:43', '2025-03-26 21:41:16'),
(5, 1, '2025-04-18 15:25:00', '312', '312', NULL, '2025-03-26 23:25:58', '2025-03-26 23:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `medication` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`id`, `patient_Id`, `date`, `medication`, `created_at`, `updated_at`) VALUES
(2, 1, '2025-03-28', 'etst', '2025-03-27 08:51:58', '2025-03-27 08:52:07'),
(3, 1, '2025-03-28', 'test', '2025-03-27 17:32:12', '2025-03-27 17:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `microbiology`
--

CREATE TABLE `microbiology` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `dateTime` datetime NOT NULL,
  `testType` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `microbiology`
--

INSERT INTO `microbiology` (`id`, `patient_Id`, `dateTime`, `testType`, `result`, `path`, `created_at`, `updated_at`) VALUES
(2, 1, '2025-03-20 15:28:00', '312', '321', NULL, '2025-03-26 23:28:35', '2025-03-26 23:28:35');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_27_010942_create_patient_table', 2),
(9, '2025_03_27_041830_create_imaging_table', 3),
(10, '2025_03_27_051542_create_laboratory_table', 3),
(11, '2025_03_27_053408_create_histopath_table', 4),
(12, '2025_03_27_054549_create_microbiology_table', 5),
(13, '2025_03_27_055158_create_specialtest_table', 6),
(14, '2025_03_27_061207_create_allergy_table', 7),
(15, '2025_03_27_065622_create_config_table', 8),
(16, '2025_03_27_142123_create_medication_table', 9),
(21, '2025_04_01_151505_create_patient_info_table', 10),
(22, '2025_04_01_160019_create_doctor_order_table', 11);

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
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `admission_no` varchar(255) NOT NULL,
  `admission_datetime` datetime NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `station` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `chiefComplaint` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `full_name`, `birth_date`, `gender`, `age`, `admission_no`, `admission_datetime`, `room_no`, `station`, `status`, `condition`, `chiefComplaint`, `image`, `created_at`, `updated_at`) VALUES
(1, 'John Renz Natividad', '2003-05-02', 'Male', 21, '32189', '2025-03-27 09:33:00', '313312', 'General Medical Ward - Bed No. 6', 'Healthy', 'None', 'nausea', 'Patient/Profile/Rl3Yj5eHiPtYgBgvwAcajFQAPYLEC2UE1ZNd62pN.jpg', '2025-03-26 17:34:03', '2025-04-01 07:46:51'),
(4, 'jose', '2002-02-02', '321', 23, '321', '2025-03-27 10:14:00', '231', 'General Medical Ward - Bed No. 6', '321', '231', NULL, NULL, '2025-03-26 18:14:47', '2025-04-01 00:28:19'),
(7, 'test', '2025-04-08', '312', 0, '312', '2025-04-19 23:25:00', '312', 'ICU - 502', '312', '312', '231', NULL, '2025-04-01 07:25:58', '2025-04-01 07:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `patient_info`
--

CREATE TABLE `patient_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `registration_no` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `diagnosis` varchar(255) DEFAULT NULL,
  `other_diagnoses` varchar(255) DEFAULT NULL,
  `allergies` varchar(255) DEFAULT NULL,
  `reaction` varchar(255) DEFAULT NULL,
  `emergency_name` varchar(255) DEFAULT NULL,
  `emergency_relationship` varchar(255) DEFAULT NULL,
  `emergency_address` text DEFAULT NULL,
  `emergency_phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_info`
--

INSERT INTO `patient_info` (`id`, `patient_Id`, `registration_no`, `religion`, `address`, `admission_date`, `diagnosis`, `other_diagnoses`, `allergies`, `reaction`, `emergency_name`, `emergency_relationship`, `emergency_address`, `emergency_phone`, `created_at`, `updated_at`) VALUES
(1, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-01 07:25:58', '2025-04-01 07:25:58'),
(2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, '1231', '1', '1', '2025-04-09', '1', '1312', '1', '1', '1', '1', '1', '1', NULL, '2025-04-01 07:46:45');

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
('l0TQ9XYRoA6J7on1Nbx0W1rowpg6pBoxw1jK1MQD', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVFBtb0MzQzZHaTZjS0RhVUJxZTZmQXlqUHRoYmxPajEyd05TN1JpNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL1BhdGllbnQtTWFuYWdlbWVudC8xIjt9fQ==', 1743525844);

-- --------------------------------------------------------

--
-- Table structure for table `specialtest`
--

CREATE TABLE `specialtest` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `dateTime` datetime NOT NULL,
  `testType` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialtest`
--

INSERT INTO `specialtest` (`id`, `patient_Id`, `dateTime`, `testType`, `result`, `path`, `created_at`, `updated_at`) VALUES
(2, 1, '2025-03-27 15:28:00', '321', '312', NULL, '2025-03-26 23:28:50', '2025-03-26 23:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@gmail.com', NULL, '$2y$12$dtAdbJL1XfWXDjQ1/pIJj.zGr74ixnEXnnpgtoErzpcWvgK4n/6Oy', NULL, NULL, NULL),
(2, 'johnrenz', 'test@email.com', NULL, '$2y$12$ouWtBppXvAWvumM1kj0pdu5bpAj6gRVBNmZA6necmkNQUHqY3T.Le', NULL, '2025-04-01 00:47:51', '2025-04-01 00:47:51'),
(3, 'jose rizal', 'joserizal@gmail.com', NULL, '$2y$12$7xJcyg3PHxfxIm5TytLqTeArutckXbpsSs1cnfZ2BY4cYJaONdZKK', NULL, '2025-04-01 05:35:09', '2025-04-01 05:35:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allergy`
--
ALTER TABLE `allergy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `allergy_patient_id_foreign` (`patient_Id`);

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
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_order`
--
ALTER TABLE `doctor_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_order_patient_id_foreign` (`patient_Id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `histopath`
--
ALTER TABLE `histopath`
  ADD PRIMARY KEY (`id`),
  ADD KEY `histopath_patient_id_foreign` (`patient_Id`);

--
-- Indexes for table `imaging`
--
ALTER TABLE `imaging`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imaging_patient_id_foreign` (`patient_Id`);

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
-- Indexes for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laboratory_patient_id_foreign` (`patient_Id`);

--
-- Indexes for table `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medication_patient_id_foreign` (`patient_Id`);

--
-- Indexes for table `microbiology`
--
ALTER TABLE `microbiology`
  ADD PRIMARY KEY (`id`),
  ADD KEY `microbiology_patient_id_foreign` (`patient_Id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_info_patient_id_foreign` (`patient_Id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `specialtest`
--
ALTER TABLE `specialtest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialtest_patient_id_foreign` (`patient_Id`);

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
-- AUTO_INCREMENT for table `allergy`
--
ALTER TABLE `allergy`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctor_order`
--
ALTER TABLE `doctor_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `histopath`
--
ALTER TABLE `histopath`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `imaging`
--
ALTER TABLE `imaging`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laboratory`
--
ALTER TABLE `laboratory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `microbiology`
--
ALTER TABLE `microbiology`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specialtest`
--
ALTER TABLE `specialtest`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allergy`
--
ALTER TABLE `allergy`
  ADD CONSTRAINT `allergy_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_order`
--
ALTER TABLE `doctor_order`
  ADD CONSTRAINT `doctor_order_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `histopath`
--
ALTER TABLE `histopath`
  ADD CONSTRAINT `histopath_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `imaging`
--
ALTER TABLE `imaging`
  ADD CONSTRAINT `imaging_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD CONSTRAINT `laboratory_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medication`
--
ALTER TABLE `medication`
  ADD CONSTRAINT `medication_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `microbiology`
--
ALTER TABLE `microbiology`
  ADD CONSTRAINT `microbiology_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_info`
--
ALTER TABLE `patient_info`
  ADD CONSTRAINT `patient_info_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specialtest`
--
ALTER TABLE `specialtest`
  ADD CONSTRAINT `specialtest_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
