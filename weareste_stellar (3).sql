-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2023 at 03:06 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weareste_stellar`
--

-- --------------------------------------------------------

--
-- Table structure for table `activation_codes`
--

CREATE TABLE `activation_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activationCode` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activation_codes`
--

INSERT INTO `activation_codes` (`id`, `activationCode`, `status`, `created_at`, `updated_at`) VALUES
(1, 395901882, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(2, 243775396, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(3, 1133126736, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(4, 9254194, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(5, 41165656, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(6, 1540514094, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(7, 491669603, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(8, 890469530, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(9, 332691597, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(10, 1161872189, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(11, 778147654, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(12, 1913751642, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(13, 2098678881, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(14, 682493873, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(15, 40595130, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(16, 573548011, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(17, 1946112692, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(18, 656009902, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(19, 1890631513, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(20, 215170290, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(21, 518069262, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(22, 1807439864, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(23, 442003676, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(24, 1060662003, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(25, 1320314343, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(26, 859481381, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(27, 306706868, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(28, 1216786485, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(29, 917214272, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(30, 1668399216, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(31, 1922381146, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(32, 1727891486, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(33, 792796805, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(34, 1664869603, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(35, 1360146808, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(36, 243201959, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(37, 1215918898, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(38, 1784203944, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(39, 1050366671, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(40, 1864646819, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(41, 1940210697, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(42, 1565376089, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(43, 773236088, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(44, 1764434856, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(45, 1592009728, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(46, 1613656466, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(47, 265835789, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(48, 945746303, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(49, 1896696179, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(50, 737894924, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(51, 91038398, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(52, 75874131, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(53, 1282187023, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(54, 1265242186, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(55, 1860222446, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(56, 1487969256, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(57, 1948690226, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(58, 287553340, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(59, 1452241668, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(60, 1534055327, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(61, 196593633, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(62, 992863653, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(63, 1175110333, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(64, 2091422029, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(65, 245111171, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(66, 1565701617, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(67, 225629722, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(68, 2007398520, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(69, 1756133085, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(70, 544136341, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(71, 1493971811, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(72, 523388627, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(73, 743688043, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(74, 453142538, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(75, 729119605, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(76, 62585988, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(77, 477599670, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(78, 1621317136, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(79, 1055711353, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(80, 61853951, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(81, 2039084274, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(82, 1278537479, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(83, 1462074655, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(84, 554786920, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(85, 1844086673, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(86, 880512600, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(87, 1713229613, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(88, 20034483, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(89, 357392430, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(90, 1538611841, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(91, 206994600, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(92, 1448806452, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(93, 1406148988, 1, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(94, 990009543, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(95, 1554893672, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(96, 1417980364, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(97, 335005567, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(98, 55157302, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(99, 1559275522, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(100, 2130261776, 0, '2023-01-30 22:31:13', '2023-01-30 22:31:13'),
(101, 6460782, 1, '2023-03-09 18:54:54', '2023-03-09 18:54:54'),
(102, 5526567, 1, '2023-03-10 05:57:37', '2023-03-10 05:57:37'),
(103, 1469376, 1, '2023-03-15 17:04:30', '2023-03-15 17:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `encashment_logs`
--

CREATE TABLE `encashment_logs` (
  `logID` int(11) NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `encashment` decimal(10,0) NOT NULL,
  `rebateBalance` decimal(10,0) NOT NULL,
  `claim` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genealogy_logs`
--

CREATE TABLE `genealogy_logs` (
  `transID` int(11) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `sponsorID` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `totalRebate` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genealogy_logs`
--

INSERT INTO `genealogy_logs` (`transID`, `id`, `sponsorID`, `title`, `description`, `totalRebate`, `created_at`, `updated_at`) VALUES
(22, 1, '0', 'Root User', 'admin added John Doe', 0, NULL, NULL),
(23, 3, '1', 'New Start-up Account Added', 'Felicia Sinco added GROVER PELE SINCO', 50, '2023-03-18 16:48:43', '2023-03-18 16:48:43'),
(24, 4, '1', 'New Start-up Account Added', 'Felicia Sinco added SHERRIE MAE SINCO', 100, '2023-03-18 16:56:15', '2023-03-18 16:56:15'),
(27, 3, '1', 'An Account Unlocked Great Savings', 'Admin Upgraded GROVER PELE NERI SINCO\'s with Felicia Neri Sinco as Sponsor.', 500, '2023-03-19 05:46:21', '2023-03-19 05:46:21'),
(28, 6, '3', 'New Start-up Account Added', 'GROVER PELE SINCO added Reynante Bati-on', 50, '2023-03-19 14:32:00', '2023-03-19 14:32:00'),
(29, 8, '6', 'New Start-up Account Added', 'Reynante Bati-on added Wilson Ybanez', 50, '2023-03-19 14:56:51', '2023-03-19 14:56:51'),
(30, 9, '6', 'New Start-up Account Added', 'Reynante Bati-on added Rosevilla Casihan', 100, '2023-03-19 15:54:53', '2023-03-19 15:54:53'),
(31, 10, '6', 'New Start-up Account Added', 'Reynante Bati-on added Rizaldie Antagon', 150, '2023-03-19 15:58:33', '2023-03-19 15:58:33'),
(34, 13, '6', 'New Start-up Account Added', 'Reynante Bati-on added John Michael Pandic', 200, '2023-03-19 16:14:44', '2023-03-19 16:14:44'),
(35, 14, '1', 'New Start-up Account Added', 'Felicia Sinco added Rhovick Geñoso', 182, '2023-03-20 10:44:36', '2023-03-20 10:44:36'),
(36, 15, '4', 'New Start-up Account Added', 'SHERRIE MAE SINCO added Maricel Mabelin', 50, '2023-03-20 11:26:35', '2023-03-20 11:26:35'),
(37, 16, '1', 'New Start-up Account Added', 'Felicia Sinco added Emmanuel II Mulawan', 240, '2023-03-20 11:40:45', '2023-03-20 11:40:45'),
(38, 17, '3', 'New Start-up Account Added', 'GROVER PELE SINCO added Marycon Aspiras', 132, '2023-03-20 13:47:39', '2023-03-20 13:47:39'),
(39, 18, '15', 'New Start-up Account Added', 'Maricel Mabelin added Rena Lowesie Magas', 50, '2023-03-20 18:51:16', '2023-03-20 18:51:16'),
(40, 19, '14', 'New Start-up Account Added', 'Rhovick Geñoso added Crispina Macarine', 50, '2023-03-21 08:56:43', '2023-03-21 08:56:43'),
(41, 20, '14', 'New Start-up Account Added', 'Rhovick Geñoso added Thelma Angub', 100, '2023-03-21 09:01:30', '2023-03-21 09:01:30'),
(42, 21, '14', 'New Start-up Account Added', 'Rhovick Geñoso added Joype Matiga', 150, '2023-03-21 09:06:42', '2023-03-21 09:06:42'),
(43, 22, '19', 'New Start-up Account Added', 'Crispina Macarine added Greggie Adlao', 50, '2023-03-21 09:33:00', '2023-03-21 09:33:00'),
(44, 23, '19', 'New Start-up Account Added', 'Crispina Macarine added Junita Bendoy', 100, '2023-03-21 10:10:11', '2023-03-21 10:10:11'),
(45, 24, '19', 'New Start-up Account Added', 'Crispina Macarine added Rey Bryan Biong', 150, '2023-03-21 10:13:57', '2023-03-21 10:13:57'),
(46, 25, '19', 'New Start-up Account Added', 'Crispina Macarine added Jemarlyndie Jumamoy', 200, '2023-03-21 10:17:31', '2023-03-21 10:17:31'),
(47, 26, '19', 'New Start-up Account Added', 'Crispina Macarine added Rogelita Rangas', 250, '2023-03-21 10:21:02', '2023-03-21 10:21:02'),
(48, 27, '15', 'New Start-up Account Added', 'Maricel Mabelin added Teresa Claros', 100, '2023-03-21 10:33:58', '2023-03-21 10:33:58'),
(49, 28, '19', 'New Start-up Account Added', 'Crispina Macarine added Malyn Salamares', 300, '2023-03-21 10:42:45', '2023-03-21 10:42:45'),
(50, 29, '19', 'New Start-up Account Added', 'Crispina Macarine added Wenalyn Sinaca', 350, '2023-03-21 10:54:01', '2023-03-21 10:54:01'),
(51, 30, '1', 'New Start-up Account Added', 'Felicia Sinco added Thomas Oco', 376, '2023-03-22 05:48:49', '2023-03-22 05:48:49'),
(53, 32, '6', 'New Start-up Account Added', 'Reynante Bati-on added Danny Patecion', 250, '2023-03-29 15:26:14', '2023-03-29 15:26:14'),
(54, 33, '9', 'New Start-up Account Added', 'Rosevilla Casihan added Reymar Casihan', 50, '2023-04-04 16:12:56', '2023-04-04 16:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `greatsavedata`
--

CREATE TABLE `greatsavedata` (
  `greatsaveID` int(11) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `rebate` decimal(10,0) NOT NULL,
  `stars` int(11) NOT NULL,
  `encashment` decimal(10,0) NOT NULL,
  `rebateBalance` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `greatsavedata`
--

INSERT INTO `greatsavedata` (`greatsaveID`, `id`, `rebate`, `stars`, `encashment`, `rebateBalance`) VALUES
(1, 1, '500', 0, '0', '500'),
(2, 3, '0', 0, '0', '0'),
(3, 4, '0', 0, '0', '0'),
(5, 6, '0', 0, '0', '0'),
(6, 8, '0', 0, '0', '0'),
(7, 9, '0', 0, '0', '0'),
(8, 10, '0', 0, '0', '0'),
(11, 13, '0', 0, '0', '0'),
(12, 14, '0', 0, '0', '0'),
(13, 15, '0', 0, '0', '0'),
(14, 16, '0', 0, '0', '0'),
(15, 17, '0', 0, '0', '0'),
(16, 18, '0', 0, '0', '0'),
(17, 19, '0', 0, '0', '0'),
(18, 20, '0', 0, '0', '0'),
(19, 21, '0', 0, '0', '0'),
(20, 22, '0', 0, '0', '0'),
(21, 23, '0', 0, '0', '0'),
(22, 24, '0', 0, '0', '0'),
(23, 25, '0', 0, '0', '0'),
(24, 26, '0', 0, '0', '0'),
(25, 27, '0', 0, '0', '0'),
(26, 28, '0', 0, '0', '0'),
(27, 29, '0', 0, '0', '0'),
(28, 30, '0', 0, '0', '0'),
(30, 32, '0', 0, '0', '0'),
(31, 33, '0', 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `greatsavings`
--

CREATE TABLE `greatsavings` (
  `greatsaveID` int(11) NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `sponsorID` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `cycle` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `greatsavings`
--

INSERT INTO `greatsavings` (`greatsaveID`, `userID`, `sponsorID`, `fullName`, `cycle`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Felicia Neri Sinco', 1, NULL, NULL),
(3, 3, 1, 'GROVER PELE NERI SINCO', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_25_034926_add_fields_to_users', 2),
(7, '2023_01_25_040239_create_activation_code_table', 3),
(9, '2023_02_20_090810_create_notifications_table', 4),
(10, '2023_02_28_215528_create_user_rewards_table', 5),
(11, '2023_03_03_060107_create_jobs_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(45, 'App\\Models\\User', 8, 'API TOKEN', '5a60e4425ceb272a3b78aa924dc295ca1ccec1742bafe651a815bf3ece3dac52', '[\"*\"]', '2023-03-19 16:19:36', NULL, '2023-03-19 16:19:35', '2023-03-19 16:19:36'),
(54, 'App\\Models\\User', 4, 'API TOKEN', 'a6174cf4616586ad2ae6ea9995393c209f917f6d1d38a620ec2325777a9956be', '[\"*\"]', '2023-03-21 09:13:04', NULL, '2023-03-20 11:24:14', '2023-03-21 09:13:04'),
(59, 'App\\Models\\User', 15, 'API TOKEN', 'd755ee7ca0efa0bbc147a208b54c41fb9002565732cbc54e683bb7d9dc75c94b', '[\"*\"]', '2023-03-20 19:03:31', NULL, '2023-03-20 18:44:42', '2023-03-20 19:03:31'),
(62, 'App\\Models\\User', 14, 'API TOKEN', 'beee9cb469da7efff2e05a1c03a429332838e78c2e630239a3ec583d889c1635', '[\"*\"]', '2023-03-21 09:07:05', NULL, '2023-03-21 07:26:31', '2023-03-21 09:07:05'),
(65, 'App\\Models\\User', 19, 'API TOKEN', 'efecaa6803098eca37f8b7f9cb379310639098b8fcd290e28a1e7084c9f72729', '[\"*\"]', '2023-03-21 10:54:07', NULL, '2023-03-21 09:21:33', '2023-03-21 10:54:07'),
(66, 'App\\Models\\User', 15, 'API TOKEN', '33430f082346ba807575256063112e7c84126ef733d2424fc0596393ed5f5c3b', '[\"*\"]', '2023-03-21 10:53:51', NULL, '2023-03-21 10:30:26', '2023-03-21 10:53:51'),
(67, 'App\\Models\\User', 15, 'API TOKEN', 'fb96d39dc37c33969d398bcff5e619db901afb43055616970803d7959e4e9e2d', '[\"*\"]', '2023-03-21 10:54:43', NULL, '2023-03-21 10:54:42', '2023-03-21 10:54:43'),
(68, 'App\\Models\\User', 14, 'API TOKEN', 'bd0d63b057951c5dbdb161c53beae7815e7b9371935a5c4fcda3f5686e514adb', '[\"*\"]', '2023-03-21 10:59:51', NULL, '2023-03-21 10:55:31', '2023-03-21 10:59:51'),
(80, 'App\\Models\\User', 4, 'API TOKEN', '321c6ffcfaf6dd41bf3abead70c5ac8c2bbd17fda797adf58db5c27e3d12dd7e', '[\"*\"]', '2023-03-27 13:33:03', NULL, '2023-03-22 05:54:35', '2023-03-27 13:33:03'),
(104, 'App\\Models\\User', 6, 'API TOKEN', '4d63ab0f80ff9ef202248fe34d5269c69445cf65c94cb2328609051d149b4a5f', '[\"*\"]', '2023-04-02 07:31:13', NULL, '2023-04-02 05:36:52', '2023-04-02 07:31:13'),
(106, 'App\\Models\\User', 32, 'API TOKEN', '6eeedd31a9bbaf35f0da75a30115839cd420368794dc0c1d8276a900f22bcc58', '[\"*\"]', '2023-04-02 06:11:47', NULL, '2023-04-02 06:10:06', '2023-04-02 06:11:47'),
(107, 'App\\Models\\User', 6, 'API TOKEN', '37325653255121880fd96496df61e94611488d5ecc7f78bbd35555678ff67ea6', '[\"*\"]', '2023-04-02 15:17:11', NULL, '2023-04-02 15:16:55', '2023-04-02 15:17:11'),
(109, 'App\\Models\\User', 6, 'API TOKEN', '498c1e218bc978c186373893664a969f07033de01548cc559a91712295564d93', '[\"*\"]', '2023-04-04 16:27:27', NULL, '2023-04-04 16:22:59', '2023-04-04 16:27:27'),
(110, 'App\\Models\\User', 9, 'API TOKEN', 'a89d8622095db2140c01cc4c9eb0cfee766857fef00e8f880584f25d09dd0b58', '[\"*\"]', '2023-04-04 16:36:56', NULL, '2023-04-04 16:32:42', '2023-04-04 16:36:56'),
(111, 'App\\Models\\User', 9, 'API TOKEN', '8cdb150a1d9d11ef6ee0397ee2922a879711d8e51e14dca677d8fc2c1827171b', '[\"*\"]', '2023-04-04 16:38:24', NULL, '2023-04-04 16:37:17', '2023-04-04 16:38:24'),
(112, 'App\\Models\\User', 9, 'API TOKEN', 'bf136f862ff4390c68df55c98eaec61ed252bc67198540f3cae5754d5538fcf1', '[\"*\"]', '2023-04-04 16:40:07', NULL, '2023-04-04 16:40:07', '2023-04-04 16:40:07'),
(113, 'App\\Models\\User', 6, 'API TOKEN', 'eb3ca87f79d6f47d4a7d9d48840f277010266eba998b34af7985c4ce355a1024', '[\"*\"]', '2023-04-04 17:12:02', NULL, '2023-04-04 17:12:01', '2023-04-04 17:12:02'),
(114, 'App\\Models\\User', 33, 'API TOKEN', '2e99fb79033590a3937a0d00997128f66a1aac3a61b2e11d120d0da19d288660', '[\"*\"]', '2023-04-04 17:41:26', NULL, '2023-04-04 17:41:25', '2023-04-04 17:41:26'),
(115, 'App\\Models\\User', 33, 'API TOKEN', '583c8c2b586726aa26555dbcc28f44d2a2477708ef9080942c559974baf61e72', '[\"*\"]', '2023-04-04 17:42:17', NULL, '2023-04-04 17:42:16', '2023-04-04 17:42:17'),
(118, 'App\\Models\\User', 6, 'API TOKEN', '628f6638eba960ef68336198dd9b0b9b557dfb5c0d7c8a9dece8e70bdbeb9a67', '[\"*\"]', '2023-04-05 05:30:03', NULL, '2023-04-05 05:29:32', '2023-04-05 05:30:03'),
(119, 'App\\Models\\User', 6, 'API TOKEN', 'c2e2753e1f9a3eff29081b87693f957f831b670bacbbe2f46cf0507e3aafe611', '[\"*\"]', '2023-04-06 12:14:01', NULL, '2023-04-06 12:13:59', '2023-04-06 12:14:01'),
(120, 'App\\Models\\User', 9, 'API TOKEN', '7367d62be41b663327b5751278cefa8bfd693614c65fce9daeab579be545be81', '[\"*\"]', '2023-04-06 12:22:36', NULL, '2023-04-06 12:22:35', '2023-04-06 12:22:36'),
(121, 'App\\Models\\User', 3, 'API TOKEN', '3f4ee13d68d5eee8cf9761a92b192fcfc2880db3d8ee022944c530de49e17264', '[\"*\"]', '2023-06-01 16:14:52', NULL, '2023-06-01 16:14:52', '2023-06-01 16:14:52'),
(122, 'App\\Models\\User', 1, 'API TOKEN', 'c2d302f46854040b249c94b1234c71766c228d9ac4f159a6c02a03c0da8f5443', '[\"*\"]', NULL, NULL, '2023-07-31 05:12:34', '2023-07-31 05:12:34'),
(123, 'App\\Models\\User', 1, 'API TOKEN', 'efb2af1fa190b6ade51333000370dbb627a507bb05da89e97007038cb575552c', '[\"*\"]', '2023-07-31 05:16:56', NULL, '2023-07-31 05:16:53', '2023-07-31 05:16:56'),
(124, 'App\\Models\\User', 1, 'API TOKEN', '4c42fbc931af9874a88f439dfa76e5fe8c4281e896736b89c25a5d3866a24a1b', '[\"*\"]', '2023-07-31 05:19:55', NULL, '2023-07-31 05:16:53', '2023-07-31 05:19:55'),
(125, 'App\\Models\\User', 3, 'API TOKEN', '91e4aace69f00ff1f121b1807a2e2d29c4a5f8887b4dea0894677aa6cfb911e9', '[\"*\"]', '2023-07-31 05:21:40', NULL, '2023-07-31 05:21:30', '2023-07-31 05:21:40'),
(126, 'App\\Models\\User', 3, 'API TOKEN', 'eceda8d9e2973732f1c53b54e6fab3d840b2cdd13d01e176c02a5ff58eee0f7b', '[\"*\"]', '2023-08-24 03:30:30', NULL, '2023-08-24 03:28:30', '2023-08-24 03:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `rewardsID` int(11) NOT NULL,
  `rewardsItem` varchar(255) NOT NULL,
  `rewardsImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`rewardsID`, `rewardsItem`, `rewardsImage`) VALUES
(1, 'We Provide Products', 'weprovideproducts'),
(2, '1 Pail of Laundry Detergent', 'detergent'),
(3, 'Grocery Package', 'grocery'),
(4, '7 We Provide Elite Packages', 'elitepackage'),
(5, 'Brand New Car', 'car');

-- --------------------------------------------------------

--
-- Table structure for table `startupdata`
--

CREATE TABLE `startupdata` (
  `startupID` int(11) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `rebate` decimal(10,0) NOT NULL,
  `stars` int(11) NOT NULL,
  `encashment` decimal(10,0) NOT NULL,
  `rebateBalance` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `startupdata`
--

INSERT INTO `startupdata` (`startupID`, `id`, `rebate`, `stars`, `encashment`, `rebateBalance`) VALUES
(1, 1, '396', 22, '0', '396'),
(2, 3, '146', 6, '0', '146'),
(3, 4, '66', 2, '0', '66'),
(5, 6, '258', 1, '0', '258'),
(6, 8, '0', 0, '0', '0'),
(7, 9, '50', 0, '0', '50'),
(8, 10, '0', 0, '0', '0'),
(11, 13, '0', 0, '0', '0'),
(12, 14, '206', 7, '0', '206'),
(13, 15, '100', 0, '0', '100'),
(14, 16, '0', 0, '0', '0'),
(15, 17, '0', 0, '0', '0'),
(16, 18, '0', 0, '0', '0'),
(17, 19, '350', 0, '0', '350'),
(18, 20, '0', 0, '0', '0'),
(19, 21, '0', 0, '0', '0'),
(20, 22, '0', 0, '0', '0'),
(21, 23, '0', 0, '0', '0'),
(22, 24, '0', 0, '0', '0'),
(23, 25, '0', 0, '0', '0'),
(24, 26, '0', 0, '0', '0'),
(25, 27, '0', 0, '0', '0'),
(26, 28, '0', 0, '0', '0'),
(27, 29, '0', 0, '0', '0'),
(28, 30, '0', 0, '0', '0'),
(30, 32, '0', 0, '0', '0'),
(31, 33, '0', 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `startupsavings`
--

CREATE TABLE `startupsavings` (
  `startupID` int(11) NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `sponsorID` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `cycle` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `startupsavings`
--

INSERT INTO `startupsavings` (`startupID`, `userID`, `sponsorID`, `fullName`, `cycle`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Felicia Neri Sinco', 1, NULL, NULL),
(2, 3, 1, 'GROVER PELE NERI SINCO', 1, NULL, NULL),
(3, 4, 1, 'SHERRIE MAE NERI SINCO', 1, NULL, NULL),
(5, 6, 3, 'Reynante Antapon Bati-on', 1, NULL, NULL),
(6, 8, 6, 'Wilson Perturbos Ybanez', 1, NULL, NULL),
(7, 9, 6, 'Rosevilla Emoc Casihan', 1, NULL, NULL),
(8, 10, 6, 'Rizaldie Omecnol Antagon', 1, NULL, NULL),
(11, 13, 6, 'John Michael Baso Pandic', 1, NULL, NULL),
(12, 14, 1, 'Rhovick Nacional Geñoso', 1, NULL, NULL),
(13, 15, 4, 'Maricel Claros Mabelin', 1, NULL, NULL),
(14, 16, 1, 'Emmanuel II Suanque Mulawan', 1, NULL, NULL),
(15, 17, 3, 'Marycon Jabagat Aspiras', 1, NULL, NULL),
(16, 18, 15, 'Rena Lowesie Redondo Magas', 1, NULL, NULL),
(17, 19, 14, 'Crispina Martinez Macarine', 1, NULL, NULL),
(18, 20, 14, 'Thelma Bayhonan Angub', 1, NULL, NULL),
(19, 21, 14, 'Joype Abragan Matiga', 1, NULL, NULL),
(20, 22, 19, 'Greggie Angcog Adlao', 1, NULL, NULL),
(21, 23, 19, 'Junita Sendiong Bendoy', 1, NULL, NULL),
(22, 24, 19, 'Rey Bryan Maquinano Biong', 1, NULL, NULL),
(23, 25, 19, 'Jemarlyndie Mayola Jumamoy', 1, NULL, NULL),
(24, 26, 19, 'Rogelita Luayon Rangas', 1, NULL, NULL),
(25, 27, 15, 'Teresa Pansoy Claros', 1, NULL, NULL),
(26, 28, 19, 'Malyn Mantilla Salamares', 1, NULL, NULL),
(27, 29, 19, 'Wenalyn Curada Sinaca', 1, NULL, NULL),
(28, 30, 1, 'Thomas Jarales Oco', 1, NULL, NULL),
(30, 32, 6, 'Danny Eguanan Patecion', 1, NULL, NULL),
(31, 33, 9, 'Reymar Emoc Casihan', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activationCode` int(11) NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middleName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactInfo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsUpgraded` int(11) NOT NULL,
  `cycle` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `activationCode`, `firstName`, `middleName`, `lastName`, `date_of_birth`, `contactInfo`, `email`, `password`, `role`, `IsUpgraded`, `cycle`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'felysinco', 395901882, 'Felicia', 'Neri', 'Sinco', '1962-12-20', '09171246541', 'grofel5@yahoo.com', '$2y$10$/E2QqsbUIWNwby3gmXA7CubFEjFtUwEdr1tPr0eySXbRaSUlqoiam', 'user', 1, 1, NULL, '2023-01-23 16:51:59', '2023-07-31 05:06:11'),
(2, 'admin_stellar', 0, '', '', '', '07-07-1997', '09978366415', 'admin@stellar.com', '$2y$10$d1hz6vaTgpFzBPP8gGamieS0fkf9bpDUYMr4gBVZPJNZTljUutEuy', 'admin', 0, 1, NULL, '2023-01-27 17:16:32', '2023-03-19 05:49:05'),
(3, 'groverpeleC1', 1469376, 'GROVER PELE', 'NERI', 'SINCO', '1985-02-06', '09177661046', 'groverpele@gmail.com', '$2y$10$5plt/1V/tB3xwLq4W.bfO.ZDPdC0HdWA3l.Iimb3EatfP1iEyWlTK', 'user', 1, 1, NULL, '2023-03-18 16:48:43', '2023-07-31 05:20:56'),
(4, 'SHERRIE MAESINCO_C1', 5526567, 'SHERRIE MAE', 'NERI', 'SINCO', '1979-05-09', '09177043066', 'sherriemae09@gmail.com', '$2y$10$t4SWmcOb.tipl9Pjyo9qWexYEUiVV9wrjGC6BlhMmkEbtdokqTPjS', 'user', 0, 1, NULL, '2023-03-18 16:56:14', '2023-03-18 16:56:14'),
(6, 'ReynanteBati-onC1', 6460782, 'Reynante', 'Antapon', 'Bati-on', '1997-05-27', '09559551420', 'RaBati27on@gmail.com', '$2y$10$AtGECJx.gJ/1py2dzHVWV.T4GSThI5lNeXyWY.KG0abg9OgpSJoKm', 'user', 0, 1, NULL, '2023-03-19 14:31:59', '2023-03-19 14:53:32'),
(8, 'wheelsoon2023', 1282187023, 'Wilson', 'Perturbos', 'Ybanez', '1973-06-02', '09955692906', 'wybanez77@gmail.com', '$2y$10$WfcXLOe65yz2lbuaaJxbD.AJgwdEqL1rx9DWePq1BW28kf1o4vlr6', 'user', 0, 1, NULL, '2023-03-19 14:56:51', '2023-03-19 16:18:54'),
(9, 'RosevillaCasihan22', 225629722, 'Rosevilla', 'Emoc', 'Casihan', '1997-05-22', '09564460159', 'casihanrosevilla22@gmail.com', '$2y$10$0BNj.pzGHKyXidYfbFPUuOP/gFJVihD2UaeZm.peL2.Q6us4Eo9MS', 'user', 0, 1, NULL, '2023-03-19 15:54:53', '2023-04-04 16:37:50'),
(10, 'RizaldieAntagon_C1', 2007398520, 'Rizaldie', 'Omecnol', 'Antagon', '1994-11-07', '09914744263', 'omecnol4@gmail.com', '$2y$10$nvdrcvgivzz.YYalmuXGk.XALh5bcA.CxJNxULYRRzS7/rybs8qDq', 'user', 0, 1, NULL, '2023-03-19 15:58:33', '2023-03-19 15:58:33'),
(13, 'John MichaelPandic_C1', 737894924, 'John Michael', 'Baso', 'Pandic', '1997-05-07', '09122329497', 'johnmichaelpandic6@gmail.com', '$2y$10$lTSdq4ugiZ46K43CRUuw5udJGVuUZRK5pT0ODy0h/7uRBMUA3/tGy', 'user', 0, 1, NULL, '2023-03-19 16:14:44', '2023-03-19 16:14:44'),
(14, 'Bing_C1', 544136341, 'Rhovick', 'Nacional', 'Geñoso', '1981-09-19', '09279576188', 'bingzky@gmail.com', '$2y$10$PROqCll3tUUNs/GOSj0eROSBfGTioNVu7mPUsnLae7I1h6ut5nGhe', 'user', 0, 1, NULL, '2023-03-20 10:44:35', '2023-03-21 07:25:56'),
(15, 'RichKhacie21', 1175110333, 'Maricel', 'Claros', 'Mabelin', '1985-09-20', '09487365695', 'mmabelin915@gmail.com', '$2y$10$X4EW7kFq1cW7Zju7rT98ReMpsUirAZPUte79cPVt1n/QwZz3pICne', 'user', 0, 1, NULL, '2023-03-20 11:26:34', '2023-03-21 10:53:41'),
(16, 'Emmanuel IIMulawan_C1', 992863653, 'Emmanuel II', 'Suanque', 'Mulawan', '1992-11-12', '09672487959', 'emman143mulawan@gmail.com', '$2y$10$f0tFxn1Xcp.Sj2DSZsZgbuYlMPXmLJMfkDdlSnz0GUmcYGTt8F1Qa', 'user', 0, 1, NULL, '2023-03-20 11:40:45', '2023-03-20 11:40:45'),
(17, 'MaryconAspiras_C1', 62585988, 'Marycon', 'Jabagat', 'Aspiras', '1975-12-16', '09367951250', 'jabagatmarycon@gmail.com', '$2y$10$QU11DYvX1EaM2MpE9vfCGOkEA6gdDdQVrjimJY4zateE0HMfxXTta', 'user', 0, 1, NULL, '2023-03-20 13:47:39', '2023-03-20 13:47:39'),
(18, 'Rena LowesieMagas_C1', 477599670, 'Rena Lowesie', 'Redondo', 'Magas', '1995-12-27', '09059795754', 'kyleaddyson30@gmail.com', '$2y$10$nL.pnVJBfbXykwmjqcMsOuMZInGOdbe6MxM3E88pi8uA9KVXdlBX6', 'user', 0, 1, NULL, '2023-03-20 18:51:16', '2023-03-20 18:51:16'),
(19, 'Cris_C1', 2091422029, 'Crispina', 'Martinez', 'Macarine', '1968-07-26', '09811124396', 'missirah54@gmail.com', '$2y$10$zwYygJHAQJgRU.k5EUc3E.Nic5oST2xMb8UVx7uUG2Ca5KbYj5vb2', 'user', 0, 1, NULL, '2023-03-21 08:56:43', '2023-03-21 09:21:18'),
(20, 'ThelmaAngub_C1', 1896696179, 'Thelma', 'Bayhonan', 'Angub', '1974-08-01', '09465212100', 'thelmab.angub74@gmail.com', '$2y$10$G3veJCacS7uzI6aNX91b3eKqT/gDQjoQvcyXoBlck8J9RwnKqRwGi', 'user', 0, 1, NULL, '2023-03-21 09:01:30', '2023-03-21 09:01:30'),
(21, 'JoypeMatiga_C1', 245111171, 'Joype', 'Abragan', 'Matiga', '1976-08-27', '09655346800', 'jopematiga2468@gmail.com', '$2y$10$7Vj9cNonX.N2AI8xYdRPMeKW1R2VUN5rWiHYKB7CauIbbsoNg1MMK', 'user', 0, 1, NULL, '2023-03-21 09:06:42', '2023-03-21 09:06:42'),
(22, 'GreggieAdlao_C1', 453142538, 'Greggie', 'Angcog', 'Adlao', '1983-10-26', '09705409703', 'greggie.adlao@deped.com.ph', '$2y$10$N2GW7hYQFvBhSg5b9pwpfeh5kcqGqtc4rdO8EJOwND.LNyezpsnai', 'user', 0, 1, NULL, '2023-03-21 09:33:00', '2023-03-21 09:33:00'),
(23, 'JunitaBendoy_C1', 729119605, 'Junita', 'Sendiong', 'Bendoy', '1974-06-17', '09635568446', 'junita.bendoy@deped.com.ph', '$2y$10$H1d95z4Bjzk9Tni8tCA7DOSJT8K2hy1kK36ksP/f9VR2.i1Gz8NLC', 'user', 0, 1, NULL, '2023-03-21 10:10:11', '2023-03-21 10:10:11'),
(24, 'Rey BryanBiong_C1', 743688043, 'Rey Bryan', 'Maquinano', 'Biong', '1990-01-30', '09638332041', 'reybryan.biong@deped.gov.ph', '$2y$10$DKSjZzXMSEWS25xd/2lPNOAN1KiKxLUGor6MZIQOTYZtDR.i2D5Py', 'user', 0, 1, NULL, '2023-03-21 10:13:57', '2023-03-21 10:13:57'),
(25, 'JemarlyndieJumamoy_C1', 523388627, 'Jemarlyndie', 'Mayola', 'Jumamoy', '1991-07-03', '09514044168', 'jemarlyndiej@gmail.com', '$2y$10$MH5THJUslnTerJPBuP9a9uoJP59seo3M/oX.yUqf8jr.JjrUeLmWy', 'user', 0, 1, NULL, '2023-03-21 10:17:31', '2023-03-21 10:17:31'),
(26, 'RogelitaRangas_C1', 1756133085, 'Rogelita', 'Luayon', 'Rangas', '1961-02-06', '09505797831', 'rogelitarangas@gmail.com', '$2y$10$VMtirUpL4d1qlHhwg2WxjO1mgbpPecx9YNRnWvENJRMevY6gfeUVS', 'user', 0, 1, NULL, '2023-03-21 10:21:01', '2023-03-21 10:21:01'),
(27, 'TeresaClaros_C1', 196593633, 'Teresa', 'Pansoy', 'Claros', '1965-01-08', '09972071432', 'teresaclaros1965@gmail.com', '$2y$10$WhnxALrTAHSjGs0/mCa7K.DwhALbcgAnlMXJcN960q.x.ZrWgmpjC', 'user', 0, 1, NULL, '2023-03-21 10:33:58', '2023-03-21 10:33:58'),
(28, 'MalynSalamares_C1', 1565701617, 'Malyn', 'Mantilla', 'Salamares', '1963-08-01', '09105334526', 'marlynsalamares@deped.gov.ph', '$2y$10$riw8XZDGY0XKgtoQrzGu5OFgEmnZ8DLO6kD26b83Pv/6svuAgdBJa', 'user', 0, 1, NULL, '2023-03-21 10:42:45', '2023-03-21 10:42:45'),
(29, 'WenalynSinaca_C1', 1493971811, 'Wenalyn', 'Curada', 'Sinaca', '1987-09-04', '09460723181', 'curadawenalyn@gmail.com', '$2y$10$ZtFh1t58jvMJi6cwMXYtxer7exVrndRhf5HYswAwD7jjOakq62p/u', 'user', 0, 1, NULL, '2023-03-21 10:54:01', '2023-03-21 10:54:01'),
(30, 'ThomasOco_C1', 1621317136, 'Thomas', 'Jarales', 'Oco', '1966-12-29', '09363696405', 'ocothomas932@gmail.com', '$2y$10$U2.J/bahOgH.5SEmI/TUmuv4WGEm74ygZS9QiU/5dmJboD0tBVMuq', 'user', 0, 1, NULL, '2023-03-22 05:48:49', '2023-03-22 05:48:49'),
(32, 'DannyPatecion_C1', 1448806452, 'Danny', 'Eguanan', 'Patecion', '1993-07-12', '09751554127', 'dpatecion@gmail.com', '$2y$10$UOIMISIpAYhCIx/H7Ta3GOe2P2nmlw3Pe6EU/iuta4oF/Cp5zYnr6', 'user', 0, 1, NULL, '2023-03-29 15:26:14', '2023-04-02 06:08:16'),
(33, 'ReymarCasihan_C1', 1406148988, 'Reymar', 'Emoc', 'Casihan', '2000-10-07', '09653314884', 'reymarcasihan07@gmail.com', '$2y$10$Wmofd8YcLDkNRmTYQujM0u1Xm0EnMb/7hQF0u2srjV.ekUuu9zHIG', 'user', 0, 1, NULL, '2023-04-04 16:12:55', '2023-04-04 16:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_rewards`
--

CREATE TABLE `user_rewards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `rewardsID` int(11) NOT NULL,
  `redeemStatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activation_codes`
--
ALTER TABLE `activation_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `encashment_logs`
--
ALTER TABLE `encashment_logs`
  ADD PRIMARY KEY (`logID`),
  ADD KEY `userEncashment` (`userID`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genealogy_logs`
--
ALTER TABLE `genealogy_logs`
  ADD PRIMARY KEY (`transID`),
  ADD KEY `startup_logs_ibfk_1` (`id`);

--
-- Indexes for table `greatsavedata`
--
ALTER TABLE `greatsavedata`
  ADD PRIMARY KEY (`greatsaveID`),
  ADD KEY `userGreatSaveData` (`id`);

--
-- Indexes for table `greatsavings`
--
ALTER TABLE `greatsavings`
  ADD PRIMARY KEY (`greatsaveID`),
  ADD KEY `greatsavings_user` (`userID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`rewardsID`);

--
-- Indexes for table `startupdata`
--
ALTER TABLE `startupdata`
  ADD PRIMARY KEY (`startupID`),
  ADD KEY `userStartupData` (`id`);

--
-- Indexes for table `startupsavings`
--
ALTER TABLE `startupsavings`
  ADD PRIMARY KEY (`startupID`),
  ADD KEY `startupsavungs_user` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rewards`
--
ALTER TABLE `user_rewards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_rewards_userid_foreign` (`userID`),
  ADD KEY `user_rewards_rewardsid_foreign` (`rewardsID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activation_codes`
--
ALTER TABLE `activation_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `encashment_logs`
--
ALTER TABLE `encashment_logs`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genealogy_logs`
--
ALTER TABLE `genealogy_logs`
  MODIFY `transID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `greatsavedata`
--
ALTER TABLE `greatsavedata`
  MODIFY `greatsaveID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `greatsavings`
--
ALTER TABLE `greatsavings`
  MODIFY `greatsaveID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `rewardsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `startupdata`
--
ALTER TABLE `startupdata`
  MODIFY `startupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `startupsavings`
--
ALTER TABLE `startupsavings`
  MODIFY `startupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_rewards`
--
ALTER TABLE `user_rewards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `encashment_logs`
--
ALTER TABLE `encashment_logs`
  ADD CONSTRAINT `userEncashment` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `genealogy_logs`
--
ALTER TABLE `genealogy_logs`
  ADD CONSTRAINT `genealogy_logs_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `greatsavedata`
--
ALTER TABLE `greatsavedata`
  ADD CONSTRAINT `userGreatSaveData` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `greatsavings`
--
ALTER TABLE `greatsavings`
  ADD CONSTRAINT `greatsavings_user` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `startupdata`
--
ALTER TABLE `startupdata`
  ADD CONSTRAINT `userStartupData` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `startupsavings`
--
ALTER TABLE `startupsavings`
  ADD CONSTRAINT `startupsavungs_user` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_rewards`
--
ALTER TABLE `user_rewards`
  ADD CONSTRAINT `user_rewards_rewardsid_foreign` FOREIGN KEY (`rewardsID`) REFERENCES `rewards` (`rewardsID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_rewards_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
