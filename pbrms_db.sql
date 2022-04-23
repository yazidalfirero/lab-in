-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2022 at 10:20 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pbrms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(11, 'HEMALOTOGI', 'Pemerikasaan tetang apa saja yang mengenai darah', 1, 0, '2022-03-20 21:52:52', NULL),
(12, 'FAAL HATI', 'Pemerikasaan mengenai organ hati', 1, 0, '2022-03-20 21:53:02', NULL),
(13, 'LEMAK', 'Pemeriksaan mengenai lemak tubuh', 1, 0, '2022-03-20 21:53:14', NULL),
(14, 'FAAL GINJAL', 'Pemerikasaan mengenai organ ginjal', 1, 0, '2022-03-20 21:53:23', NULL),
(15, 'IMUNOLOGI', 'Pemeriksaan tentang imun', 1, 0, '2022-03-20 21:53:40', NULL),
(16, 'PREPARAT DIRECK', 'Pemerikasaan tentang', 1, 0, '2022-03-20 21:53:49', NULL),
(17, 'TES KEHAMILAN', 'Pemeriksaan mengenai kehamilan', 1, 0, '2022-03-20 21:54:00', NULL),
(18, 'NARKOBA', 'Pemeriksaan test Narkoba', 1, 0, '2022-03-20 21:54:09', NULL),
(19, 'GULA DARAH', 'Pemeriksaan tentang gula darah', 1, 0, '2022-03-20 21:54:17', NULL),
(20, 'URINALISA', 'Pemeriksaan tentang urin', 1, 0, '2022-03-20 21:54:29', NULL),
(21, 'TUMOR MARKER', 'Pemeriksaan tentang tumor', 1, 0, '2022-03-20 21:54:36', NULL),
(22, 'JANTUNG', 'Pemeriksaan tentang organ jantung', 1, 0, '2022-03-20 21:54:44', NULL),
(23, 'HORMON', 'Pemeriksaan tentang hormon', 1, 0, '2022-03-20 21:54:50', '2022-03-20 21:54:57'),
(24, 'Cek Sperma', 'Test Kualitas Sperma', 1, 0, '2022-03-20 22:49:53', NULL),
(25, 'Biaya Transportasi', 'Biaya tambahan untuk hasil rujukan', 1, 0, '2022-03-22 09:57:16', NULL),
(26, 'SEROLOGI', '', 1, 0, '2022-03-22 15:29:59', NULL),
(27, 'Lain-lain', '', 1, 0, '2022-03-22 16:44:42', NULL),
(28, 'DL', '', 1, 0, '2022-03-25 13:45:25', NULL),
(29, 'UL', '', 1, 0, '2022-03-25 15:46:40', NULL),
(30, 'Diff', '', 1, 0, '2022-03-25 15:57:10', NULL),
(31, 'WIDAL', '', 1, 0, '2022-03-25 16:01:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `jenis_discount` enum('nominal','persen') NOT NULL,
  `jumlah_discount` double NOT NULL,
  `expired_at` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `title`, `jenis_discount`, `jumlah_discount`, `expired_at`, `date_created`, `description`) VALUES
(8, '20%', 'persen', 20, '0000-00-00 00:00:00', '2022-03-22 01:55:39', '  Diskon 20%'),
(10, '50%', 'persen', 50, '0000-00-00 00:00:00', '2022-03-22 14:13:52', '  '),
(11, '10%', 'persen', 10, '0000-00-00 00:00:00', '2022-03-22 17:24:38', '  '),
(12, '30%', 'persen', 30, '0000-00-00 00:00:00', '2022-03-22 17:24:52', '  '),
(13, '40%', 'persen', 40, '0000-00-00 00:00:00', '2022-03-22 17:25:23', '  '),
(14, '3%', 'persen', 3, '0000-00-00 00:00:00', '2022-03-22 17:25:42', '  '),
(15, '40.000', 'nominal', 40000, '0000-00-00 00:00:00', '2022-03-22 18:00:23', '  '),
(16, '10.000', 'nominal', 10000, '0000-00-00 00:00:00', '2022-03-22 18:00:37', '  '),
(17, '20.000', 'nominal', 20000, '0000-00-00 00:00:00', '2022-03-22 18:00:45', '  '),
(18, '30.000', 'nominal', 30000, '0000-00-00 00:00:00', '2022-03-23 03:20:56', '  '),
(19, '50.000', 'nominal', 50000, '0000-00-00 00:00:00', '2022-03-23 03:21:06', '  ');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` int(11) NOT NULL,
  `price_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `price_paket` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `price_id`, `nama`, `price_paket`) VALUES
(6, 29, 'Hb', 122),
(7, 30, 'Hb', 122),
(8, 31, 'Hb', 122),
(9, 32, 'Hb', 122),
(10, 33, 'Hb', 122),
(37, 62, 'ul', 133),
(38, 63, 'ul', 133),
(39, 64, 'ul', 133),
(40, 65, 'ul', 133),
(41, 66, 'ul', 133),
(42, 123, 'ul', 133),
(43, 67, 'ul', 133),
(44, 68, 'ul', 133),
(45, 69, 'ul', 133),
(46, 124, 'ul', 133),
(47, 70, 'ul', 133),
(48, 71, 'ul', 133),
(49, 72, 'ul', 133),
(50, 73, 'ul', 133),
(51, 74, 'ul', 133),
(52, 75, 'ul', 133),
(53, 76, 'ul', 133),
(54, 77, 'ul', 133),
(55, 78, 'ul', 133),
(56, 79, 'ul', 133),
(57, 80, 'ul', 133),
(58, 82, 'ul', 133),
(59, 125, 'ul', 133),
(60, 127, 'diff', 126),
(61, 128, 'diff', 126),
(62, 129, 'diff', 126),
(63, 130, 'diff', 126),
(64, 131, 'diff', 126),
(65, 132, 'diff', 126),
(66, 88, 'widal', 113),
(67, 88, 'widal', 113),
(68, 89, 'widal', 113),
(69, 90, 'widal', 113),
(70, 91, 'widal', 113);

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(30) NOT NULL,
  `transaction_id` int(30) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `price_list`
--

CREATE TABLE `price_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `size` text NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `normalvalue` text NOT NULL,
  `normalvalue_wanita` text NOT NULL,
  `satuan` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `price_list`
--

INSERT INTO `price_list` (`id`, `category_id`, `size`, `price`, `normalvalue`, `normalvalue_wanita`, `satuan`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(29, 28, 'Hb', 0, '13.5 - 18.0', '13.5 - 17.0', 'gr/dl', 1, 0, '2022-03-20 21:56:44', '2022-03-25 15:39:41'),
(30, 28, 'Jumlah Eritrosit', 0, '4.5 - 6.2', '', 'juta/mm3', 1, 0, '2022-03-20 21:57:09', '2022-03-25 15:40:55'),
(31, 28, 'Jumlah Lekosit', 0, '4.5 - 11', '', 'ribu/mm3', 1, 0, '2022-03-20 21:57:37', '2022-03-25 15:39:58'),
(32, 28, 'Trombosit', 0, '150 - 450', '', 'ribu/mm3', 1, 0, '2022-03-20 21:58:02', '2022-03-25 15:41:21'),
(33, 28, 'Hematokrit', 0, '40 - 45', '', '%', 1, 0, '2022-03-20 21:58:25', '2022-03-25 15:41:37'),
(34, 11, 'Lanju Endap Darah', 0, '4.5 - 11', '', 'ribu/mm3', 1, 0, '2022-03-20 21:59:06', NULL),
(35, 11, 'Westergren', 0, '0 - 15', '', 'mm/jam', 1, 0, '2022-03-20 21:59:35', NULL),
(37, 11, 'Wintrobe', 0, '0 - 8', '', 'mm/jam', 1, 0, '2022-03-20 22:00:03', NULL),
(38, 11, 'Bleending Time (BT)', 20000, '1 - 7', '', 'minutes', 1, 0, '2022-03-20 22:00:26', '2022-03-22 16:29:23'),
(39, 11, 'Cloting Time (CT)', 20000, '<15', '', 'minutes', 1, 0, '2022-03-20 22:00:44', '2022-03-22 16:29:37'),
(40, 11, 'Hapusan Darah (Sp PK)', 0, '12 - 16', '', 'sec', 1, 0, '2022-03-20 22:01:07', NULL),
(41, 11, 'Malaria (tes kombinasi)', 50000, 'Negatif', '', 'ribu/mm3', 1, 0, '2022-03-20 22:01:35', '2022-03-22 16:43:55'),
(42, 12, 'Albumin', 50000, '3.5 - 4.8', '', 'g/dl', 1, 0, '2022-03-20 22:02:47', '2022-03-22 16:31:54'),
(43, 12, 'Globutin', 50000, '2.0 - 3.5', '', 'g/dl', 1, 0, '2022-03-20 22:03:13', '2022-03-22 16:32:19'),
(44, 12, 'Bilirubin Total', 25000, 's.d 1.1', '', 'mg/dl', 1, 0, '2022-03-20 22:03:33', '2022-03-22 16:32:42'),
(45, 12, 'Bilirubin Direct', 25000, 's.d 0.25', '', 'mg/dl', 1, 0, '2022-03-20 22:03:52', '2022-03-22 16:32:53'),
(46, 12, 'SGOT', 30000, 's.d 37', '', 'U/I', 1, 0, '2022-03-20 22:04:08', '2022-03-22 16:31:33'),
(47, 12, 'SGPT', 30000, 's.d 40', '', 'U/I', 1, 0, '2022-03-20 22:04:26', '2022-03-22 16:31:42'),
(48, 12, 'Total Protein', 50000, '6.0 - 8.3', '', 'g/dl', 1, 0, '2022-03-20 22:04:42', '2022-03-22 16:32:06'),
(49, 12, 'Bilirubin Indirect', 25000, 's.d 0.7', '', 'mg/dl', 1, 0, '2022-03-20 22:05:09', '2022-03-22 16:40:53'),
(50, 13, 'Cholesterol', 30000, '140 - 200', '', 'mg/dl', 1, 0, '2022-03-20 22:05:57', '2022-03-22 16:34:46'),
(51, 13, 'Trigliseride', 40000, 's.d 200', '', 'mg/dl', 1, 0, '2022-03-20 22:06:20', '2022-03-22 16:34:57'),
(52, 13, 'HDL Cholesterol', 30000, '35 - 55', '', 'mg/dl', 1, 0, '2022-03-20 22:06:48', '2022-03-22 16:35:10'),
(53, 13, 'LDL Cholesterol', 30000, '< 130', '', 'mg/dl', 1, 0, '2022-03-20 22:07:19', '2022-03-22 16:35:26'),
(54, 13, 'Rasio Cholesterol', 40000, '< 4.5', '', 'mg/dl', 1, 0, '2022-03-20 22:07:43', '2022-03-22 16:35:39'),
(55, 14, 'Urea', 30000, '17 - 54', '', 'mg/dl', 1, 0, '2022-03-20 22:08:23', '2022-03-22 00:00:04'),
(56, 14, 'Creatinin', 20000, '0.6 - 1.3', '', 'mg/dl', 1, 1, '2022-03-20 22:08:41', '2022-03-22 17:02:57'),
(57, 14, 'Uric Acid', 30000, '3.4 - 7.0', '', 'mg/dl', 1, 0, '2022-03-20 22:09:12', '2022-03-22 16:36:59'),
(58, 19, 'Gula Darah Puasa', 25000, '60 - 100', '', 'mg/dl', 1, 0, '2022-03-20 22:09:38', '2022-03-22 16:34:15'),
(59, 19, 'Gula Darah 2 JPP', 25000, '<140', '', 'mg/dl', 1, 0, '2022-03-20 22:09:53', '2022-03-22 16:34:22'),
(60, 19, 'Gula Darah Sewaktu', 25000, '<200', '', 'mg/dl', 1, 0, '2022-03-20 22:10:09', '2022-03-22 16:34:08'),
(61, 19, 'HbA 1C', 250000, '<6.5', '', '%', 1, 0, '2022-03-20 22:10:25', '2022-03-22 16:34:35'),
(62, 29, 'Bj', 0, '1.010 - 1.020', '1.010 - 1.020', '', 1, 0, '2022-03-20 22:11:02', '2022-03-25 15:47:23'),
(63, 29, 'Protein', 0, 'Negatif', 'Negatif', '', 1, 0, '2022-03-20 22:11:22', '2022-03-25 15:47:46'),
(64, 29, 'Reduksi', 0, 'Negatif', 'Negatif', '', 1, 0, '2022-03-20 22:12:06', '2022-03-25 15:48:32'),
(65, 29, 'Bilirubin', 0, 'Negatif', 'Negatif', '', 1, 0, '2022-03-20 22:12:18', '2022-03-25 16:10:18'),
(66, 29, 'Urobilinogen', 0, 'Negatif', 'Negatif', '', 1, 0, '2022-03-20 22:12:32', '2022-03-25 15:49:37'),
(67, 29, 'pH', 0, '4.5 - 8.0', '4.5 - 8.0', '', 1, 0, '2022-03-20 22:12:51', '2022-03-25 15:50:46'),
(68, 29, 'Nitrit', 0, 'Negatif', 'Negatif', '', 1, 0, '2022-03-20 22:13:03', '2022-03-25 15:51:00'),
(69, 29, 'Aseton', 0, 'Negatif', 'Negatif', '', 1, 0, '2022-03-20 22:13:12', '2022-03-25 15:51:13'),
(70, 29, 'Eritrosit', 0, '<5', '<5', 'LPB', 1, 0, '2022-03-20 22:13:29', '2022-03-25 15:52:07'),
(71, 29, 'Lekosit', 0, '<5', '<5', 'LPB', 1, 0, '2022-03-20 22:13:42', '2022-03-25 15:52:23'),
(72, 29, 'Epitel', 0, '', '', '', 1, 0, '2022-03-20 22:13:53', '2022-03-25 15:52:33'),
(73, 29, 'Kristal', 0, '', '', '', 1, 0, '2022-03-20 22:14:01', '2022-03-25 15:52:51'),
(74, 29, 'Ca Oxalat', 0, '', '', '', 1, 0, '2022-03-20 22:14:09', '2022-03-25 15:53:01'),
(75, 29, 'Uric Acid', 0, '', '', '', 1, 0, '2022-03-20 22:14:19', '2022-03-25 15:53:35'),
(76, 29, 'Amorph', 0, '', '', '', 1, 0, '2022-03-20 22:14:32', '2022-03-25 15:53:50'),
(77, 29, 'Silinder', 0, '', '', '', 1, 0, '2022-03-20 22:14:40', '2022-03-25 15:54:00'),
(78, 29, 'Granular', 0, '', '', '', 1, 0, '2022-03-20 22:14:50', '2022-03-25 15:54:08'),
(79, 29, 'Hialin', 0, '', '', '', 1, 0, '2022-03-20 22:15:00', '2022-03-25 15:54:21'),
(80, 29, 'Waxy', 0, '', '', '', 1, 0, '2022-03-20 22:15:09', '2022-03-25 15:55:22'),
(81, 20, 'Lain - lain', 0, '', '', '', 1, 0, '2022-03-20 22:15:19', NULL),
(82, 29, 'Bakteri', 0, '', '', '', 1, 0, '2022-03-20 22:15:28', '2022-03-25 15:55:52'),
(83, 20, 'Pregany Test (HCG)', 0, '>25', '', 'ml', 1, 0, '2022-03-20 22:15:53', NULL),
(84, 15, 'HBsAG', 56000, 'Negatif', '', '', 1, 0, '2022-03-20 22:16:22', '2022-03-22 16:42:30'),
(85, 15, 'Anti HCV', 66000, '', '', '', 1, 0, '2022-03-20 22:16:32', '2022-03-22 16:42:39'),
(87, 15, 'IgM Toxoplasma', 0, '', '', '', 1, 0, '2022-03-20 22:16:49', NULL),
(88, 31, 'Salmonella Typhi O', 0, '', '', '', 1, 0, '2022-03-20 22:17:09', '2022-03-25 16:01:54'),
(89, 31, 'Salmonella Typhi H', 0, '', '', '', 1, 0, '2022-03-20 22:17:24', '2022-03-25 16:02:08'),
(90, 31, 'Salmonella O Paratyphi a', 0, '', '', '', 1, 0, '2022-03-20 22:17:32', '2022-03-25 16:02:20'),
(91, 31, 'Salmonella O Paratyphi b', 0, '', '', '', 1, 0, '2022-03-20 22:17:39', '2022-03-25 16:02:32'),
(92, 15, 'RA Tes', 0, 'Negatif', '', '', 1, 0, '2022-03-20 22:17:56', NULL),
(93, 15, 'VDRL Titer', 50000, 'Negatif', '', '', 1, 0, '2022-03-20 22:18:12', '2022-03-22 16:42:00'),
(94, 15, 'SYPHILIS TEST', 50000, '', '', '', 1, 0, '2022-03-20 22:18:21', '2022-03-22 16:42:17'),
(95, 15, 'B20', 150000, 'Negatif', '', '', 1, 0, '2022-03-20 22:18:30', '2022-03-22 16:26:04'),
(96, 15, 'IgE Total', 0, '', '', '', 1, 0, '2022-03-20 22:18:41', NULL),
(97, 16, 'Gram preparat', 100000, '', '', '', 1, 0, '2022-03-20 22:19:04', '2022-03-22 16:31:18'),
(98, 16, 'BTA', 100000, '', '', '', 1, 0, '2022-03-20 22:19:11', '2022-03-22 16:31:03'),
(99, 17, 'Tes Pack / Test Kehamilan', 25000, '', '', '', 1, 0, '2022-03-20 22:19:28', '2022-03-22 16:30:46'),
(100, 18, 'Amphetamin', 0, 'Negatif', '', '', 1, 0, '2022-03-20 22:19:46', NULL),
(101, 18, 'Opiate', 0, 'Negatif', '', '', 1, 0, '2022-03-20 22:19:58', NULL),
(102, 18, 'THC', 0, 'Negatif', '', '', 1, 0, '2022-03-20 22:20:06', NULL),
(103, 18, 'Narkoba 6 Parameter', 220000, 'Negatif', '', '', 1, 0, '2022-03-20 22:20:16', '2022-03-22 16:44:12'),
(104, 21, 'CEA', 0, '', '', '', 1, 0, '2022-03-20 22:20:40', NULL),
(105, 21, 'Ca 153', 0, '', '', '', 1, 0, '2022-03-20 22:20:49', NULL),
(106, 21, 'PSA Total', 0, '', '', '', 1, 0, '2022-03-20 22:21:04', NULL),
(107, 22, 'ECG', 0, '', '', '', 1, 0, '2022-03-20 22:21:17', NULL),
(108, 23, 'T3', 0, '', '', '', 1, 0, '2022-03-20 22:21:28', NULL),
(109, 23, 'T4', 0, '', '', '', 1, 0, '2022-03-20 22:21:33', NULL),
(110, 24, 'Sperma Analisa', 155000, '', '', '', 1, 0, '2022-03-20 22:50:07', '2022-03-22 16:42:57'),
(111, 25, 'Jarak 1 Km - 10 Km', 10000, '', '', '', 1, 0, '2022-03-22 10:02:10', '2022-03-22 13:19:55'),
(113, 31, 'WIDAL', 50000, '', '', '', 1, 0, '2022-03-22 15:30:30', '2022-03-25 16:01:36'),
(114, 11, 'LED', 20000, '', '', '', 1, 0, '2022-03-22 16:28:37', NULL),
(115, 11, 'Golongan Darah', 30000, '', '', '', 1, 0, '2022-03-22 16:29:56', NULL),
(116, 14, 'Ceratinin', 30000, '', '', '', 1, 0, '2022-03-22 16:36:29', NULL),
(117, 26, 'Rematik', 50000, '', '', '', 1, 0, '2022-03-22 16:43:39', NULL),
(118, 27, 'Rapid Anti-Gen', 200000, 'Negatif', '', '', 1, 0, '2022-03-22 16:45:06', NULL),
(119, 27, 'Rapid Antibody', 100000, 'Negatif', '', '', 1, 0, '2022-03-22 16:45:29', NULL),
(120, 24, 'peju', 0, '', '', '', 1, 1, '2022-03-23 02:11:23', '2022-03-23 02:11:50'),
(121, 11, 'Darah lengkappppppppp', 0, '', '', '', 1, 1, '2022-03-25 13:42:17', '2022-03-25 13:45:16'),
(122, 28, 'DL ( Darah Lengkap )', 80000, '', '', 'Hb', 1, 0, '2022-03-25 13:45:43', '2022-03-25 13:53:55'),
(123, 29, 'Sangur Tes', 0, 'Negatif', 'Negatif', '', 1, 0, '2022-03-25 15:50:12', NULL),
(124, 29, 'Sedimen', 0, '', '', '', 1, 0, '2022-03-25 15:51:43', NULL),
(125, 29, 'Jamur', 0, '', '', '', 1, 0, '2022-03-25 15:56:17', NULL),
(126, 30, 'Diff (Pria / Wanita)', 20000, '', '', '', 1, 0, '2022-03-25 15:57:54', NULL),
(127, 30, 'Eosinofil', 0, '1 - 3', '1 - 3', '%', 1, 0, '2022-03-25 15:58:22', NULL),
(128, 30, 'Basofil', 0, '0 - 1', '0 - 1', '%', 1, 0, '2022-03-25 15:58:44', NULL),
(129, 30, 'Stab', 0, '2 - 6', '2 - 6', '%', 1, 0, '2022-03-25 15:59:09', NULL),
(130, 30, 'Segmen', 0, '50 - 70', '50 - 70', '%', 1, 0, '2022-03-25 15:59:32', NULL),
(131, 30, 'Limfosit', 0, '20 - 40', '20 - 40', '%', 1, 0, '2022-03-25 15:59:56', NULL),
(132, 30, 'Monosit', 0, '2 - 8', '2 - 8', '%', 1, 0, '2022-03-25 16:00:12', NULL),
(133, 29, 'UL ( Urine Lengkap)', 50000, '', '', '', 1, 0, '2022-03-25 16:05:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sperm_transaction`
--

CREATE TABLE `sperm_transaction` (
  `id` int(30) NOT NULL,
  `price_id` int(11) NOT NULL,
  `nama_pasien` text NOT NULL,
  `umur_pasien` varchar(3) NOT NULL,
  `alamat_pasien` text NOT NULL,
  `rujukan_pengirim` varchar(25) NOT NULL,
  `kontak_pasien` varchar(25) NOT NULL,
  `nama_pengirim` varchar(25) NOT NULL,
  `sample_diterima` varchar(25) NOT NULL,
  `sample_diperiksa` varchar(25) NOT NULL,
  `cara_pengeluaran` varchar(25) NOT NULL,
  `wadah_sperm` varchar(25) NOT NULL,
  `abnesia_sperm` varchar(25) NOT NULL,
  `kougulum_sperm` varchar(25) NOT NULL,
  `volume_sperm` varchar(25) NOT NULL,
  `warna_sperm` varchar(25) NOT NULL,
  `ph_sperm` varchar(25) NOT NULL,
  `bau_sperm` varchar(25) NOT NULL,
  `lekuefaksi_sperm` varchar(25) NOT NULL,
  `rapid_sperm` varchar(15) NOT NULL,
  `slow_sperm` varchar(25) NOT NULL,
  `nonrapid_sperm` varchar(25) NOT NULL,
  `immotile_sperm` varchar(25) NOT NULL,
  `spermatozoa_sperm` varchar(25) NOT NULL,
  `jumlah_spermatozoa_total` varchar(25) NOT NULL,
  `aglutinasi_sperm` varchar(25) NOT NULL,
  `lekosit_sperm` varchar(25) NOT NULL,
  `konsentrasi_sperm` varchar(25) NOT NULL,
  `motilitas_sperm` varchar(25) NOT NULL,
  `morfologi_sperm` varchar(25) NOT NULL,
  `kesan_sperm` text NOT NULL,
  `normo_sperm` varchar(25) NOT NULL,
  `piri_sperm` varchar(25) NOT NULL,
  `lepto_sperm` varchar(25) NOT NULL,
  `terato_sperm` varchar(25) NOT NULL,
  `mikro_sperm` varchar(25) NOT NULL,
  `makro_sperm` varchar(25) NOT NULL,
  `doble_sperm` varchar(25) NOT NULL,
  `abnormalisasi_leher` varchar(25) NOT NULL,
  `abnormalisasi_ekor` varchar(25) NOT NULL,
  `spermatozoa_imatur` char(25) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sperm_transaction`
--

INSERT INTO `sperm_transaction` (`id`, `price_id`, `nama_pasien`, `umur_pasien`, `alamat_pasien`, `rujukan_pengirim`, `kontak_pasien`, `nama_pengirim`, `sample_diterima`, `sample_diperiksa`, `cara_pengeluaran`, `wadah_sperm`, `abnesia_sperm`, `kougulum_sperm`, `volume_sperm`, `warna_sperm`, `ph_sperm`, `bau_sperm`, `lekuefaksi_sperm`, `rapid_sperm`, `slow_sperm`, `nonrapid_sperm`, `immotile_sperm`, `spermatozoa_sperm`, `jumlah_spermatozoa_total`, `aglutinasi_sperm`, `lekosit_sperm`, `konsentrasi_sperm`, `motilitas_sperm`, `morfologi_sperm`, `kesan_sperm`, `normo_sperm`, `piri_sperm`, `lepto_sperm`, `terato_sperm`, `mikro_sperm`, `makro_sperm`, `doble_sperm`, `abnormalisasi_leher`, `abnormalisasi_ekor`, `spermatozoa_imatur`, `date_created`) VALUES
(43, 110, 'f', 'gfu', 'gg', 'fdu', 'g', 'dkhvs', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', '2022-03-23 03:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'LAB-IN'),
(6, 'short_name', 'LAB-IN'),
(11, 'logo', 'uploads/logo-1647929405.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1647929406.png');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` int(3) NOT NULL,
  `transaction_id` int(30) NOT NULL,
  `price_id` int(30) NOT NULL,
  `paket_price_id` int(11) DEFAULT NULL,
  `hasil` text NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `quantity` float NOT NULL DEFAULT 0,
  `total` float NOT NULL DEFAULT 0,
  `date_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `price_id`, `paket_price_id`, `hasil`, `price`, `quantity`, `total`, `date_updated`) VALUES
(1, 27, 29, 122, '0', 0, 1, 0, '2022-03-27 16:19:25'),
(2, 27, 30, 122, '0', 0, 1, 0, '2022-03-27 16:19:25'),
(3, 27, 31, 122, '0', 0, 1, 0, '2022-03-27 16:19:25'),
(4, 27, 32, 122, '0', 0, 1, 0, '2022-03-27 16:19:25'),
(5, 27, 33, 122, '0', 0, 1, 0, '2022-03-27 16:19:25'),
(18, 30, 29, 122, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(19, 30, 30, 122, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(20, 30, 31, 122, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(21, 30, 32, 122, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(22, 30, 33, 122, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(23, 30, 62, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(24, 30, 63, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(25, 30, 64, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(26, 30, 65, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(27, 30, 66, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(28, 30, 123, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(29, 30, 67, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(30, 30, 68, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(31, 30, 69, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(32, 30, 124, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(33, 30, 70, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(34, 30, 71, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(35, 30, 72, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(36, 30, 73, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(37, 30, 74, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(38, 30, 75, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(39, 30, 76, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(40, 30, 77, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(41, 30, 78, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(42, 30, 79, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(43, 30, 80, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(44, 30, 82, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(45, 30, 125, 133, '0', 0, 1, 0, '2022-03-27 16:22:27'),
(48, 30, 85, NULL, '', 0, 1, 0, '2022-03-27 16:25:25'),
(49, 33, 110, NULL, '155000', 0, 1, 155000, '2022-03-27 16:25:58'),
(50, 34, 29, 122, '0', 0, 1, 0, '2022-03-27 16:26:30'),
(51, 34, 30, 122, '0', 0, 1, 0, '2022-03-27 16:26:30'),
(52, 34, 31, 122, '0', 0, 1, 0, '2022-03-27 16:26:30'),
(53, 34, 32, 122, '0', 0, 1, 0, '2022-03-27 16:26:30'),
(54, 34, 33, 122, '0', 0, 1, 0, '2022-03-27 16:26:30'),
(55, 34, 46, NULL, '30000', 0, 1, 30000, '2022-03-27 16:26:30'),
(56, 35, 29, 122, '0', 0, 1, 0, '2022-03-27 16:28:56'),
(57, 35, 30, 122, '0', 0, 1, 0, '2022-03-27 16:28:56'),
(58, 35, 31, 122, '0', 0, 1, 0, '2022-03-27 16:28:56'),
(59, 35, 32, 122, '0', 0, 1, 0, '2022-03-27 16:28:56'),
(60, 35, 33, 122, '0', 0, 1, 0, '2022-03-27 16:28:56'),
(61, 35, 46, NULL, '0', 30000, 1, 30000, '2022-03-27 16:28:56'),
(62, 35, 47, NULL, '0', 30000, 1, 30000, '2022-03-27 16:28:56'),
(63, 36, 116, NULL, '0', 30000, 1, 30000, '2022-03-29 02:59:49'),
(64, 36, 29, 122, '0', 0, 1, 0, '2022-03-29 02:59:49'),
(65, 36, 30, 122, '0', 0, 1, 0, '2022-03-29 02:59:49'),
(66, 36, 31, 122, '0', 0, 1, 0, '2022-03-29 02:59:49'),
(67, 36, 32, 122, '0', 0, 1, 0, '2022-03-29 02:59:49'),
(68, 36, 33, 122, '0', 0, 1, 0, '2022-03-29 02:59:49'),
(69, 37, 47, NULL, '0', 30000, 1, 30000, '2022-03-29 03:05:28'),
(70, 37, 29, 122, '0', 0, 1, 0, '2022-03-29 03:05:28'),
(71, 37, 30, 122, '0', 0, 1, 0, '2022-03-29 03:05:28'),
(72, 37, 31, 122, '0', 0, 1, 0, '2022-03-29 03:05:28'),
(73, 37, 32, 122, '0', 0, 1, 0, '2022-03-29 03:05:28'),
(74, 37, 33, 122, '0', 0, 1, 0, '2022-03-29 03:05:28'),
(75, 38, 47, NULL, '0', 30000, 1, 30000, '2022-03-29 03:05:58'),
(76, 38, 29, 122, '0', 0, 1, 0, '2022-03-29 03:05:58'),
(77, 38, 30, 122, '0', 0, 1, 0, '2022-03-29 03:05:58'),
(78, 38, 31, 122, '0', 0, 1, 0, '2022-03-29 03:05:58'),
(79, 38, 32, 122, '0', 0, 1, 0, '2022-03-29 03:05:58'),
(80, 38, 33, 122, '0', 0, 1, 0, '2022-03-29 03:05:58'),
(81, 39, 29, 122, '0', 0, 1, 0, '2022-03-29 03:07:12'),
(82, 39, 30, 122, '0', 0, 1, 0, '2022-03-29 03:07:12'),
(83, 39, 31, 122, '0', 0, 1, 0, '2022-03-29 03:07:12'),
(84, 39, 32, 122, '0', 0, 1, 0, '2022-03-29 03:07:12'),
(85, 39, 33, 122, '0', 0, 1, 0, '2022-03-29 03:07:12'),
(86, 39, 127, 126, '0', 0, 1, 0, '2022-03-29 03:07:12'),
(87, 39, 128, 126, '0', 0, 1, 0, '2022-03-29 03:07:12'),
(88, 39, 129, 126, '0', 0, 1, 0, '2022-03-29 03:07:12'),
(89, 39, 130, 126, '0', 0, 1, 0, '2022-03-29 03:07:12'),
(90, 39, 131, 126, '0', 0, 1, 0, '2022-03-29 03:07:12'),
(91, 39, 132, 126, '0', 0, 1, 0, '2022-03-29 03:07:12'),
(92, 46, 29, 122, '0', 0, 1, 0, '2022-03-29 03:14:59'),
(93, 46, 30, 122, '0', 0, 1, 0, '2022-03-29 03:14:59'),
(94, 46, 31, 122, '0', 0, 1, 0, '2022-03-29 03:14:59'),
(95, 46, 32, 122, '0', 0, 1, 0, '2022-03-29 03:14:59'),
(96, 46, 33, 122, '0', 0, 1, 0, '2022-03-29 03:14:59'),
(97, 46, 127, 126, '0', 0, 1, 0, '2022-03-29 03:14:59'),
(98, 46, 128, 126, '0', 0, 1, 0, '2022-03-29 03:14:59'),
(99, 46, 129, 126, '0', 0, 1, 0, '2022-03-29 03:14:59'),
(100, 46, 130, 126, '0', 0, 1, 0, '2022-03-29 03:14:59'),
(101, 46, 131, 126, '0', 0, 1, 0, '2022-03-29 03:14:59'),
(102, 46, 132, 126, '0', 0, 1, 0, '2022-03-29 03:14:59'),
(103, 47, 59, NULL, '0', 25000, 1, 25000, '2022-03-29 03:17:34'),
(104, 47, 29, 122, '0', 0, 1, 0, '2022-03-29 03:17:34'),
(105, 47, 30, 122, '0', 0, 1, 0, '2022-03-29 03:17:34'),
(106, 47, 31, 122, '0', 0, 1, 0, '2022-03-29 03:17:34'),
(107, 47, 32, 122, '0', 0, 1, 0, '2022-03-29 03:17:34'),
(108, 47, 33, 122, '0', 0, 1, 0, '2022-03-29 03:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_list`
--

CREATE TABLE `transaction_list` (
  `id` int(30) NOT NULL,
  `discount_id` int(30) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `client_name` text NOT NULL,
  `client_age` text NOT NULL,
  `client_gender` enum('Pria','Wanita') NOT NULL,
  `client_contact` text NOT NULL,
  `client_address` text NOT NULL,
  `sender` text NOT NULL,
  `sender_name` text NOT NULL,
  `total_amount` float NOT NULL DEFAULT 0,
  `paid_amount` float NOT NULL DEFAULT 0,
  `balance` float NOT NULL DEFAULT 0,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Unpaid, 1=partially paid, 2= paid',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1= On-process, 2= done',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_list`
--

INSERT INTO `transaction_list` (`id`, `discount_id`, `code`, `client_name`, `client_age`, `client_gender`, `client_contact`, `client_address`, `sender`, `sender_name`, `total_amount`, `paid_amount`, `balance`, `payment_status`, `status`, `date_created`, `date_updated`) VALUES
(8, NULL, '0300001', 'Diza', '24', 'Pria', '089', 'N/A', 'RS', 'Dr', 0, 0, 0, 0, 0, '2022-03-27 01:37:13', '2022-03-27 01:37:13'),
(9, NULL, '0300002', 'Trian', '24', 'Pria', '08776', 'N/A', 'RS', 'Dr', 0, 0, 0, 0, 0, '2022-03-27 01:37:45', '2022-03-27 01:37:45'),
(10, 11, '0300003', 'Yazed', '21', 'Pria', '089682305042', 'N/A', 'Rumah Sakit', 'Dokter', 0, 0, 0, 0, 0, '2022-03-27 15:50:46', '2022-03-27 15:50:46'),
(21, NULL, '0300004', 'YAZED', '103', 'Pria', '08776', 'N/A', 'RS', 'Dr', 80000, 0, 0, 0, 0, '2022-03-27 16:14:07', NULL),
(23, NULL, '0300005', 'YAZED', '103', 'Pria', '08776', 'N/A', 'RS', 'Dr', 0, 0, 0, 0, 0, '2022-03-27 16:15:05', '2022-03-27 16:15:05'),
(24, NULL, '0300006', 'TRIAN', '1004', 'Pria', '089665212', 'N/A', 'RS', 'Dr', 80000, 0, 0, 0, 0, '2022-03-27 16:18:32', NULL),
(27, NULL, '0300007', 'TRIAN', '1004', 'Pria', '089665212', 'N/A', 'RS', 'Dr', 0, 0, 0, 0, 0, '2022-03-27 16:19:25', '2022-03-27 16:19:25'),
(30, NULL, '0300008', 'Diaz', '24', 'Pria', '089', 'N/A', 'RS', 'Dr', 0, 0, 0, 0, 0, '2022-03-27 16:22:27', '2022-03-27 16:22:27'),
(33, NULL, '0300009', 'TRIAN', '1004', 'Pria', '08776', 'N/A', 'RS', 'Dr', 155000, 0, 0, 0, 0, '2022-03-27 16:25:58', NULL),
(34, NULL, '0300010', 'Diaz', '1004', 'Pria', '089', 'N/A', 'RS', 'Dr', 30000, 0, 0, 0, 0, '2022-03-27 16:26:30', '2022-03-27 16:26:30'),
(35, NULL, '0300011', 'Diaz', '24', 'Pria', '089', 'N/A', 'RS', 'Dr', 60000, 0, 0, 0, 0, '2022-03-27 16:28:56', '2022-03-27 16:28:56'),
(36, NULL, '0300012', 'lolok', '24', 'Pria', '089682305042', 'N/A', 'Rumah Sakit', 'Dokter', 30000, 0, 0, 0, 0, '2022-03-29 02:59:49', '2022-03-29 02:59:49'),
(37, NULL, '0300013', 'fatrio', '34', 'Pria', '089682305042', 'N/A', 'Rumah Sakit', 'Dokter', 30000, 0, 0, 0, 0, '2022-03-29 03:05:28', '2022-03-29 03:05:28'),
(38, NULL, '0300014', 'fatrio', '34', 'Pria', '089682305042', 'N/A', 'Rumah Sakit', 'Dokter', 30000, 0, 0, 0, 0, '2022-03-29 03:05:58', '2022-03-29 03:05:58'),
(39, NULL, '0300015', 'fatrios', '21', 'Pria', '089682305042', 'N/A', 'Rumah Sakit', 'Dokter', 0, 0, 0, 0, 0, '2022-03-29 03:07:12', '2022-03-29 03:07:12'),
(46, NULL, '0300016', 'qwddqw', '12', 'Pria', '089682305042', 'N/A', 'Rumah Sakit', 'Dokter', 100000, 0, 0, 0, 0, '2022-03-29 03:14:59', NULL),
(47, 10, '0300017', 'qwddqw', '12', 'Pria', '089682305042', 'N/A', 'Rumah Sakit', 'Dokter', 65000, 0, 0, 0, 0, '2022-03-29 03:17:34', '2022-03-29 03:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_result`
--

CREATE TABLE `transaction_result` (
  `id` int(30) NOT NULL,
  `transaction_id` int(30) NOT NULL,
  `price_id` int(30) NOT NULL,
  `hasil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1639468007', NULL, 1, 1, '2021-01-20 14:02:37', '2021-12-14 15:47:08'),
(8, 'Akun', NULL, 'Pegawai', 'pegawai', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, 2, 1, '2022-02-16 22:41:47', NULL),
(9, 'Master', NULL, 'User', 'master', '9e25626a1f138d9061f68fce958b1975', 'uploads/avatar-9.png?v=1647503482', NULL, 1, 1, '2022-03-17 14:51:22', '2022-03-17 14:51:22'),
(10, 'Pegawai', NULL, 'Pertama', 'Pegawai1', '25d55ad283aa400af464c76d713c07ad', 'uploads/avatar-10.png?v=1647928885', NULL, 2, 1, '2022-03-22 13:01:25', '2022-03-22 13:01:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_id_fk` (`price_id`),
  ADD KEY `price_paket_fk` (`price_paket`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `price_list`
--
ALTER TABLE `price_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `sperm_transaction`
--
ALTER TABLE `sperm_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_id` (`price_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `price_id` (`price_id`),
  ADD KEY `paket_price_fk` (`paket_price_id`);

--
-- Indexes for table `transaction_list`
--
ALTER TABLE `transaction_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discount_fk` (`discount_id`);

--
-- Indexes for table `transaction_result`
--
ALTER TABLE `transaction_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_result_ibfk_1` (`transaction_id`),
  ADD KEY `transaction_result_ibfk_2` (`price_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_list`
--
ALTER TABLE `price_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `sperm_transaction`
--
ALTER TABLE `sperm_transaction`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `transaction_list`
--
ALTER TABLE `transaction_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `transaction_result`
--
ALTER TABLE `transaction_result`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paket`
--
ALTER TABLE `paket`
  ADD CONSTRAINT `price_id_fk` FOREIGN KEY (`price_id`) REFERENCES `price_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `price_paket_fk` FOREIGN KEY (`price_paket`) REFERENCES `price_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD CONSTRAINT `payment_history_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `price_list`
--
ALTER TABLE `price_list`
  ADD CONSTRAINT `price_list_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sperm_transaction`
--
ALTER TABLE `sperm_transaction`
  ADD CONSTRAINT `price_id` FOREIGN KEY (`price_id`) REFERENCES `price_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `paket_price_fk` FOREIGN KEY (`paket_price_id`) REFERENCES `price_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_items_ibfk_2` FOREIGN KEY (`price_id`) REFERENCES `price_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_list`
--
ALTER TABLE `transaction_list`
  ADD CONSTRAINT `discount_fk` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_result`
--
ALTER TABLE `transaction_result`
  ADD CONSTRAINT `transaction_result_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_result_ibfk_2` FOREIGN KEY (`price_id`) REFERENCES `price_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
