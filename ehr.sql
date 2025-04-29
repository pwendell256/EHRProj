-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 04:31 PM
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
(4, 1, '2025-03-27 22:38:00', 'iboprufen', 'test', NULL, '2025-03-27 06:38:32', '2025-03-27 06:38:32'),
(5, 1, '2025-04-29 22:00:00', 'gamot', '321', 'MedicalRecords/Allergy/Nsbxg2kMSn35FYdN4hJ3Muvo0HsWsgPxiqWgYJsa.jpg', '2025-04-29 06:00:24', '2025-04-29 06:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `assessments`
--

CREATE TABLE `assessments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `triggers` varchar(255) DEFAULT NULL,
  `conductor` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `orientation_level` varchar(255) DEFAULT 'Alert',
  `person` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `situation` varchar(255) DEFAULT NULL,
  `temperature` varchar(255) DEFAULT 'Warm',
  `blood_pressure` varchar(255) DEFAULT NULL,
  `respiratory_rate` varchar(255) DEFAULT NULL,
  `pulse_rate` varchar(255) DEFAULT NULL,
  `oxygen_saturation` varchar(255) DEFAULT NULL,
  `hair` varchar(255) DEFAULT NULL,
  `eyes` varchar(255) DEFAULT NULL,
  `perrla` tinyint(1) DEFAULT 0,
  `nose` varchar(255) DEFAULT NULL,
  `ears` varchar(255) DEFAULT NULL,
  `mouth` varchar(255) DEFAULT NULL,
  `midline_tongue` tinyint(1) DEFAULT 0,
  `moist` tinyint(1) DEFAULT 0,
  `lesions` tinyint(1) DEFAULT 0,
  `dentition` tinyint(1) DEFAULT 0,
  `carotid_pulse` tinyint(1) DEFAULT 0,
  `jugular_vein_distention` tinyint(1) DEFAULT 0,
  `trachea_midline` tinyint(1) DEFAULT 0,
  `muffled` tinyint(1) DEFAULT 0,
  `arrhythmia` tinyint(1) DEFAULT 0,
  `anterior` tinyint(1) DEFAULT 0,
  `posterior` tinyint(1) DEFAULT 0,
  `lateral` tinyint(1) DEFAULT 0,
  `chest_symmetry` tinyint(1) DEFAULT 0,
  `skin_turgor` tinyint(1) DEFAULT 0,
  `inspection` varchar(255) DEFAULT NULL,
  `palpation` varchar(255) DEFAULT NULL,
  `auscultation` varchar(255) DEFAULT NULL,
  `luq` varchar(255) DEFAULT 'Active',
  `ruq` varchar(255) DEFAULT 'Active',
  `llq` varchar(255) DEFAULT 'Active',
  `rlq` varchar(255) DEFAULT 'Active',
  `radial_pulses` varchar(255) DEFAULT NULL,
  `radial_other` varchar(255) DEFAULT NULL,
  `temperaturetrunk` varchar(255) DEFAULT NULL,
  `grip` varchar(255) DEFAULT NULL,
  `capillary_refill` varchar(255) DEFAULT NULL,
  `hair_present` tinyint(1) DEFAULT 0,
  `edema` varchar(255) DEFAULT NULL,
  `foot_strength` varchar(255) DEFAULT NULL,
  `yellowed` tinyint(1) DEFAULT 0,
  `thickened` tinyint(1) DEFAULT 0,
  `ingrown` tinyint(1) DEFAULT 0,
  `upper_r1` varchar(255) DEFAULT NULL,
  `upper_r2` varchar(255) DEFAULT NULL,
  `upper_l1` varchar(255) DEFAULT NULL,
  `upper_l2` varchar(255) DEFAULT NULL,
  `lower_r1` varchar(255) DEFAULT NULL,
  `lower_r2` varchar(255) DEFAULT NULL,
  `lower_l1` varchar(255) DEFAULT NULL,
  `lower_l2` varchar(255) DEFAULT NULL,
  `sensation` varchar(255) DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `bmi` decimal(8,2) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `intensity` int(11) DEFAULT 1,
  `location` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `characteristics` varchar(255) DEFAULT NULL,
  `precipitation` varchar(255) DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `nonverbals` varchar(255) DEFAULT NULL,
  `relief_factors` varchar(255) DEFAULT NULL,
  `sleep` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assessments`
--

INSERT INTO `assessments` (`id`, `patient_Id`, `triggers`, `conductor`, `date`, `time`, `orientation_level`, `person`, `place`, `situation`, `temperature`, `blood_pressure`, `respiratory_rate`, `pulse_rate`, `oxygen_saturation`, `hair`, `eyes`, `perrla`, `nose`, `ears`, `mouth`, `midline_tongue`, `moist`, `lesions`, `dentition`, `carotid_pulse`, `jugular_vein_distention`, `trachea_midline`, `muffled`, `arrhythmia`, `anterior`, `posterior`, `lateral`, `chest_symmetry`, `skin_turgor`, `inspection`, `palpation`, `auscultation`, `luq`, `ruq`, `llq`, `rlq`, `radial_pulses`, `radial_other`, `temperaturetrunk`, `grip`, `capillary_refill`, `hair_present`, `edema`, `foot_strength`, `yellowed`, `thickened`, `ingrown`, `upper_r1`, `upper_r2`, `upper_l1`, `upper_l2`, `lower_r1`, `lower_r2`, `lower_l1`, `lower_l2`, `sensation`, `weight`, `height`, `bmi`, `type`, `intensity`, `location`, `duration`, `characteristics`, `precipitation`, `frequency`, `nonverbals`, `relief_factors`, `sleep`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'test312312', '11', '2025-04-02', '01:11', 'Alert', '1312', '1', '1', '1', '1', '1', '1', '1', '1', '1', 0, '1', '1', '1', 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '1', '1', '1', 'Active', 'Active', 'Active', 'Active', '1', '1', 'Warm', '1', '1', 1, '1', '1', 1, 0, 0, '1', '1', '1', '1', '1', '1', '1', NULL, '1', 1.00, 1.00, 1.00, NULL, 1, '1', '1', '1', '1', '1', '1', NULL, '1', '1', NULL, '2025-04-29 03:57:32'),
(2, 9, NULL, NULL, NULL, NULL, 'Alert', NULL, NULL, NULL, 'Warm', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 'Active', 'Active', 'Active', 'Active', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02 06:19:47', '2025-04-02 06:19:47'),
(3, 10, NULL, NULL, NULL, NULL, 'Alert', NULL, NULL, NULL, 'Warm', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 'Active', 'Active', 'Active', 'Active', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02 19:24:52', '2025-04-02 19:24:52');

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
-- Table structure for table `diagnosis`
--

CREATE TABLE `diagnosis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `initial` text DEFAULT NULL,
  `tc` text DEFAULT NULL,
  `ro` text DEFAULT NULL,
  `final` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`id`, `patient_Id`, `initial`, `tc`, `ro`, `final`, `created_at`, `updated_at`) VALUES
(1, 1, '312', '32', '131', '2312', NULL, '2025-04-01 23:43:53'),
(2, 8, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 9, NULL, NULL, NULL, NULL, '2025-04-02 06:19:47', '2025-04-02 06:19:47'),
(4, 10, NULL, NULL, NULL, NULL, '2025-04-02 19:24:52', '2025-04-02 19:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `discharge`
--

CREATE TABLE `discharge` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `medicine` varchar(255) DEFAULT NULL,
  `exercise` varchar(255) DEFAULT NULL,
  `treatment` varchar(255) DEFAULT NULL,
  `health` varchar(255) DEFAULT NULL,
  `followup_visit` varchar(255) DEFAULT NULL,
  `diet` varchar(255) DEFAULT NULL,
  `spirituality` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discharge`
--

INSERT INTO `discharge` (`id`, `patient_Id`, `date`, `medicine`, `exercise`, `treatment`, `health`, `followup_visit`, `diet`, `spirituality`, `created_at`, `updated_at`) VALUES
(2, 1, '2025-04-29', '1312321', '1312', 'sda', 'sda', 'das', 'das', 'das', NULL, '2025-04-29 05:17:37');

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
(7, 1, 12, '2025-04-03 11:15:00', '31', '321', 'signatures/aRVcQeLuFCweq36KYg63vZcHn1K81J2c6UlBhRok.jpg', '2025-04-02 19:15:36', '2025-04-04 15:52:30'),
(8, 1, 321, '2025-04-05 07:51:00', '312', '312', 'signatures/g4RCPcI5uDVmzj7Io2P74BEqAM9wU1TfJpR16G1i.jpg', '2025-04-04 15:51:18', '2025-04-04 15:51:18'),
(9, 1, 312, '2025-04-05 12:54:00', '312', '231', 'signatures/8aFJDcgS0NXRPU5xmhSbwm6WTtkDHahEpfHn4b2S.jpg', '2025-04-04 20:54:55', '2025-04-04 20:54:55');

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
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `history` longtext DEFAULT NULL,
  `past` longtext DEFAULT NULL,
  `family` longtext DEFAULT NULL,
  `birth` longtext DEFAULT NULL,
  `environment` longtext DEFAULT NULL,
  `dietary` longtext DEFAULT NULL,
  `review` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `patient_Id`, `history`, `past`, `family`, `birth`, `environment`, `dietary`, `review`, `created_at`, `updated_at`) VALUES
(1, 1, 'No known chronic illnesses (e.g., asthma, diabetes, congenital heart disease)\nNo history of previous hospitalizations\nNo known history of recurrent ear infections\nNo history of allergies aside from Amoxicillin\nComplete childhood immunizations received', 'No family history of hearing loss, recurrent ear infections, or chronic illnesses (e.g., asthma, hypertension, diabetes)\nNo known genetic disorders', 'Full-term baby, delivered via normal spontaneous vaginal delivery\nNo complications during pregnancy or delivery\nAchieved developmental milestones appropriately for age', 'Lives with parents and siblings in a well-ventilated home\nNo known exposure to secondhand smoke or environmental pollutants\nNo recent travel history\nNo exposure to sick contacts with similar symptoms1', 'Lives with parents and siblings in a well-ventilated home\nNo known exposure to secondhand smoke or environmental pollutants\nNo recent travel history\nNo exposure to sick contacts with similar symptoms', 'Balanced diet, no known food allergies\nAdequate fluid intake', 'General: Mild fever, occasional irritability\nENT: Left ear pain, muffled hearing, no discharge\nRespiratory: No cough, no shortness of breath\nGastrointestinal: No vomiting, no diarrhea, normal appetite\nNeurological: No headache, no dizziness, no loss of consciousness', NULL, '2025-04-04 15:53:38'),
(2, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02 06:19:47', '2025-04-02 06:19:47'),
(4, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02 19:24:52', '2025-04-02 19:24:52');

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
-- Table structure for table `lab_diagnosis`
--

CREATE TABLE `lab_diagnosis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `wbc` varchar(255) DEFAULT NULL,
  `rbc` varchar(255) DEFAULT NULL,
  `hemoglobin` varchar(255) DEFAULT NULL,
  `hematocrit` varchar(255) DEFAULT NULL,
  `mcv` varchar(255) DEFAULT NULL,
  `mch` varchar(255) DEFAULT NULL,
  `mchc` varchar(255) DEFAULT NULL,
  `rbc_width` varchar(255) DEFAULT NULL,
  `platelet_count` varchar(255) DEFAULT NULL,
  `neutrophils` varchar(255) DEFAULT NULL,
  `lymphocytes` varchar(255) DEFAULT NULL,
  `monocytes` varchar(255) DEFAULT NULL,
  `eosinophils` varchar(255) DEFAULT NULL,
  `basophils` varchar(255) DEFAULT NULL,
  `chest_pa` text DEFAULT NULL,
  `impression` text DEFAULT NULL,
  `advice` text DEFAULT NULL,
  `advice_path` varchar(255) DEFAULT NULL,
  `xray_path` varchar(255) DEFAULT NULL,
  `uri_date` date DEFAULT NULL,
  `uri_time` time DEFAULT NULL,
  `transparency` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `sp_gravity` varchar(255) DEFAULT NULL,
  `ph` varchar(255) DEFAULT NULL,
  `protein` varchar(255) DEFAULT NULL,
  `glucose` varchar(255) DEFAULT NULL,
  `bilirubin` varchar(255) DEFAULT NULL,
  `ery_hb` varchar(255) DEFAULT NULL,
  `leukocytes` varchar(255) DEFAULT NULL,
  `nitrite` varchar(255) DEFAULT NULL,
  `urobilinogen` varchar(255) DEFAULT NULL,
  `ketone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lab_diagnosis`
--

INSERT INTO `lab_diagnosis` (`id`, `patient_Id`, `wbc`, `rbc`, `hemoglobin`, `hematocrit`, `mcv`, `mch`, `mchc`, `rbc_width`, `platelet_count`, `neutrophils`, `lymphocytes`, `monocytes`, `eosinophils`, `basophils`, `chest_pa`, `impression`, `advice`, `advice_path`, `xray_path`, `uri_date`, `uri_time`, `transparency`, `color`, `sp_gravity`, `ph`, `protein`, `glucose`, `bilirubin`, `ery_hb`, `leukocytes`, `nitrite`, `urobilinogen`, `ketone`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02', '14:11:00', 'test', 'test', '1.010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-29 05:55:52'),
(2, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02 06:19:47', '2025-04-02 06:19:47'),
(4, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02 19:24:52', '2025-04-02 19:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `mar`
--

CREATE TABLE `mar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `med` varchar(255) DEFAULT NULL,
  `dosage` varchar(255) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mar`
--

INSERT INTO `mar` (`id`, `patient_Id`, `med`, `dosage`, `route`, `time`, `note`, `created_at`, `updated_at`) VALUES
(2, 1, 'Azithromycin1', '10 mg/kg', 'P/O', 'once a day', NULL, NULL, '2025-04-04 20:59:45'),
(24, 9, '312', '312', '312', '312', '321', '2025-04-02 23:53:13', '2025-04-02 23:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `mar_time`
--

CREATE TABLE `mar_time` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mar_Id` bigint(20) UNSIGNED NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `adm` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mar_time`
--

INSERT INTO `mar_time` (`id`, `mar_Id`, `date`, `time`, `adm`, `path`, `created_at`, `updated_at`) VALUES
(16, 2, '2025-04-03', '15:39:00', 'test', 'mar/signatures/pCsYL8wyQNJS8W64hCKu3Kv3YfrVgkPJ9mE0H4Kn.jpg', '2025-04-02 23:40:04', '2025-04-02 23:44:46'),
(18, 2, '2025-04-03', '18:42:00', 'test', 'mar/signatures/JBJdzHdasMviGEokJQSLKa0fMGO6RrZ73jNwYbAG.jpg', '2025-04-02 23:42:38', '2025-04-02 23:44:39'),
(19, 2, '2025-04-02', '15:45:00', '3121', 'mar/signatures/Wd6Nt3cE6Nlitf4I8VT4ajVQJiCxJENVmIlTA6FP.png', '2025-04-02 23:45:32', '2025-04-04 15:44:09'),
(20, 24, '2025-04-03', '03:53:00', '312', 'mar/signatures/PhDxV76y6QnWU6wbzDaRoFCWre5u9lD1iBSetElf.png', '2025-04-02 23:53:23', '2025-04-02 23:53:23'),
(21, 2, '2025-04-05', '07:29:00', '312', NULL, '2025-04-04 15:29:16', '2025-04-04 15:29:16');

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
(3, 1, '2025-03-28', 'test', '2025-03-27 17:32:12', '2025-03-27 17:32:12'),
(4, 1, '2025-04-16', '312', '2025-04-16 04:58:44', '2025-04-16 04:58:44'),
(8, 1, '2025-04-29', 'paracetamol', '2025-04-29 05:54:56', '2025-04-29 05:54:56'),
(9, 1, '2025-04-29', 'gamot', '2025-04-29 06:00:48', '2025-04-29 06:00:48');

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
(22, '2025_04_01_160019_create_doctor_order_table', 11),
(37, '2025_04_02_011103_create_nurse_order_table', 12),
(38, '2025_04_02_021214_create_diagnosis_table', 12),
(39, '2025_04_02_023210_create_lab_diagnosis_table', 12),
(43, '2025_04_02_064505_create_assessment_table', 13),
(44, '2025_04_02_073215_create_treatment_table', 14),
(45, '2025_04_02_133823_create_mar_table', 15),
(47, '2025_04_02_133944_create_mar_time_table', 16),
(48, '2025_04_02_140830_create_history_table', 17),
(49, '2025_04_29_130110_create_discharge_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `nurse_note`
--

CREATE TABLE `nurse_note` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `observation` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nurse_note`
--

INSERT INTO `nurse_note` (`id`, `patient_Id`, `date`, `time`, `observation`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-04-05', '07:27:00', '312', '2025-04-04 15:27:35', '2025-04-04 15:27:35'),
(3, 1, '2025-04-04', '07:44:00', '312', '2025-04-04 15:44:44', '2025-04-04 15:44:44'),
(4, 1, '2025-04-05', '09:44:00', '312', '2025-04-04 15:44:51', '2025-04-04 15:44:51'),
(5, 1, '2025-04-05', '07:44:00', '321', '2025-04-04 15:44:59', '2025-04-04 15:44:59'),
(6, 1, '2025-04-03', '19:45:00', '321', '2025-04-04 15:45:53', '2025-04-04 15:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `override`
--

CREATE TABLE `override` (
  `id` int(11) NOT NULL,
  `medication_Id` bigint(11) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `dateTime` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `override`
--

INSERT INTO `override` (`id`, `medication_Id`, `name`, `reason`, `signature`, `dateTime`, `created_at`, `updated_at`) VALUES
(4, 8, 'test', 'test', 'allergy/signature/ahxt0WnKIDnCfIeyHijUHmxFeU6UTVPKvid1wVqp.jpg', '2025-04-29 21:54:00', '2025-04-29 05:54:56', '2025-04-29 05:54:56'),
(5, 9, '312', '321', 'allergy/signature/BEtDQJxLq14EthFc1mR7lUG1zbpdZJZVd2qL16Ud.png', '2025-04-29 22:00:00', '2025-04-29 06:00:48', '2025-04-29 06:00:48');

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
  `birth_place` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `admission_no` varchar(255) NOT NULL,
  `admission_datetime` datetime NOT NULL,
  `room_no` varchar(255) NOT NULL,
  `station` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `condition` varchar(255) NOT NULL,
  `chiefComplaint` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `full_name`, `birth_date`, `birth_place`, `gender`, `age`, `admission_no`, `admission_datetime`, `room_no`, `station`, `status`, `condition`, `chiefComplaint`, `education`, `image`, `created_at`, `updated_at`) VALUES
(1, 'John Renz Natividad', '2010-05-02', 'Marikina', 'Male', 14, '32189', '2025-03-27 09:33:00', '313312', 'General Medical Ward - Bed No. 6', 'Healthy', 'None', 'nausea', 'College', 'Patient/Profile/Rl3Yj5eHiPtYgBgvwAcajFQAPYLEC2UE1ZNd62pN.jpg', '2025-03-26 17:34:03', '2025-04-16 05:09:42'),
(8, '312', '2025-04-02', NULL, '312', 0, '312', '2025-04-02 10:15:00', '312', 'ICU - 502', '31', '312', '312', NULL, NULL, '2025-04-01 18:16:08', '2025-04-01 18:16:08'),
(9, '321', '2025-04-02', NULL, '312', 0, '312', '2025-04-02 22:19:00', '31', 'ICU - 502', '312', '312', '3122', NULL, 'Patient/Profile/rJQY04Tblqcn6FrkbesrlRMCabNqxpljY60Uw9hw.jpg', '2025-04-02 06:19:47', '2025-04-02 23:53:04'),
(10, 'Mark', '2005-05-05', 'Davao', 'Male', 19, '312', '2025-04-03 11:24:00', '312', 'ICU - 502', '312', '313', '321', '31', NULL, '2025-04-02 19:24:52', '2025-04-02 19:24:52');

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
(3, 1, '1231', '1', '1', '2025-04-09', '1', '1312', '1', '1', '1', '1', '1', '1', NULL, '2025-04-01 07:46:45'),
(4, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-01 18:16:08', '2025-04-01 18:16:08'),
(5, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02 06:19:47', '2025-04-02 06:19:47'),
(6, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-04-02 19:24:52', '2025-04-02 19:24:52');

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
('ztbP97pRxoUVXNbmoOO3sDjmpGsCvNqB842E3qC5', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieFlTdlhOeEs4dkc3akJzcWRuYUhpcnNNZHFMSFVyQmlaWGJCR1ZTdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9QYXRpZW50LU1hbmFnZW1lbnQvMT90YWI9SGlzdG9yeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1745936949);

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
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_Id` bigint(20) UNSIGNED NOT NULL,
  `short_term` text DEFAULT NULL,
  `long_term` text DEFAULT NULL,
  `medication` text DEFAULT NULL,
  `intervention` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`id`, `patient_Id`, `short_term`, `long_term`, `medication`, `intervention`, `created_at`, `updated_at`) VALUES
(1, 1, '321\n312321', '312', '321', '321', NULL, '2025-04-01 23:49:22'),
(2, 8, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 9, NULL, NULL, NULL, NULL, '2025-04-02 06:19:47', '2025-04-02 06:19:47'),
(4, 10, NULL, NULL, NULL, NULL, '2025-04-02 19:24:52', '2025-04-02 19:24:52');

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
(1, 'testing', 'test@gmail.com', NULL, '$2y$12$dtAdbJL1XfWXDjQ1/pIJj.zGr74ixnEXnnpgtoErzpcWvgK4n/6Oy', NULL, NULL, NULL),
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
-- Indexes for table `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessments_patient_id_foreign` (`patient_Id`);

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
-- Indexes for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diagnosis_patient_id_foreign` (`patient_Id`);

--
-- Indexes for table `discharge`
--
ALTER TABLE `discharge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discharge_patient_id_foreign` (`patient_Id`);

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
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_patient_id_foreign` (`patient_Id`);

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
-- Indexes for table `lab_diagnosis`
--
ALTER TABLE `lab_diagnosis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lab_diagnosis_patient_id_foreign` (`patient_Id`);

--
-- Indexes for table `mar`
--
ALTER TABLE `mar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mar_patient_id_foreign` (`patient_Id`);

--
-- Indexes for table `mar_time`
--
ALTER TABLE `mar_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mar_time_mar_id_foreign` (`mar_Id`);

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
-- Indexes for table `nurse_note`
--
ALTER TABLE `nurse_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nurse_note_patient_id_foreign` (`patient_Id`);

--
-- Indexes for table `override`
--
ALTER TABLE `override`
  ADD PRIMARY KEY (`id`),
  ADD KEY `override_ibfk_1` (`medication_Id`);

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
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `treatment_patient_id_foreign` (`patient_Id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diagnosis`
--
ALTER TABLE `diagnosis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `discharge`
--
ALTER TABLE `discharge`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_order`
--
ALTER TABLE `doctor_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `lab_diagnosis`
--
ALTER TABLE `lab_diagnosis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mar`
--
ALTER TABLE `mar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `mar_time`
--
ALTER TABLE `mar_time`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `microbiology`
--
ALTER TABLE `microbiology`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `nurse_note`
--
ALTER TABLE `nurse_note`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `override`
--
ALTER TABLE `override`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patient_info`
--
ALTER TABLE `patient_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `specialtest`
--
ALTER TABLE `specialtest`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Constraints for table `assessments`
--
ALTER TABLE `assessments`
  ADD CONSTRAINT `assessments_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD CONSTRAINT `diagnosis_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discharge`
--
ALTER TABLE `discharge`
  ADD CONSTRAINT `discharge_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `lab_diagnosis`
--
ALTER TABLE `lab_diagnosis`
  ADD CONSTRAINT `lab_diagnosis_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mar`
--
ALTER TABLE `mar`
  ADD CONSTRAINT `mar_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mar_time`
--
ALTER TABLE `mar_time`
  ADD CONSTRAINT `mar_time_mar_id_foreign` FOREIGN KEY (`mar_Id`) REFERENCES `mar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `nurse_note`
--
ALTER TABLE `nurse_note`
  ADD CONSTRAINT `nurse_note_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `override`
--
ALTER TABLE `override`
  ADD CONSTRAINT `override_ibfk_1` FOREIGN KEY (`medication_Id`) REFERENCES `medication` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `treatment`
--
ALTER TABLE `treatment`
  ADD CONSTRAINT `treatment_patient_id_foreign` FOREIGN KEY (`patient_Id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
