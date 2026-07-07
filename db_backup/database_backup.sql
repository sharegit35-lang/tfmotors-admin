-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2026 at 03:05 PM
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
-- Database: `my_project`
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
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `english_name` varchar(255) NOT NULL,
  `khmer_name` varchar(255) NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `identity_card` varchar(255) NOT NULL,
  `cambodian_passport` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `branch_code` varchar(100) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `start_work` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `hire_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `english_name`, `khmer_name`, `gender`, `identity_card`, `cambodian_passport`, `phone`, `position`, `department_name`, `branch_name`, `branch_code`, `date_of_birth`, `start_work`, `salary`, `status`, `hire_date`, `created_at`, `updated_at`) VALUES
(1, 'CHEA KIMHONG', 'ជា គឹ​មអ្ហុង', 'male', '101410845', 'N/A', '096 264 5225', 'Technician PDI', 'human_resources', 'Head Quarters', '', '2003-09-08', '2025-07-01', 0.00, 'active', '2025-07-01', '2025-10-02 04:45:44', '2026-02-20 13:33:55'),
(2, 'POEURN HENG LEAP', 'ពឿន ហេងលាភ', 'female', '062170805', NULL, '096 511 4943', 'Service Advisor', 'After Sales', 'Head Quarters', '', '2001-01-10', '2025-07-01', 0.00, 'active', '2025-07-01', '2025-10-02 04:52:30', '2025-10-02 04:52:30'),
(3, 'SUM THOEUNRETHY', 'ស៊ុំ ធឿនរិទ្ធី', 'male', '020874567(01)', NULL, '096 265 4839', 'Technician', 'After Sales', 'MG 50M', '', '1996-02-14', '2025-07-01', 0.00, 'active', '2025-07-01', '2025-10-02 04:54:14', '2025-10-02 04:54:14'),
(4, 'SAMBATH RATTANAKBOROS', 'សម្បត្តិ រតនៈ បុរស', 'male', '011102167', NULL, '012 332 329', 'Junior Graphic Design', '4W Marketing', 'Head Quarters', '', '2000-09-09', '2025-07-01', 0.00, 'active', '2025-07-01', '2025-10-02 04:56:23', '2025-10-02 04:56:23'),
(5, 'TANN CHHEAV', 'តាន់ ឈាវ', 'male', '181001094', NULL, '078 795 978', 'Technician Apprentices', 'After Sales', 'MG Siem Reap', '', '2003-03-08', '2025-07-04', 0.00, 'active', '2025-07-04', '2025-10-02 04:57:55', '2025-10-02 04:57:55'),
(6, 'CHIM SOKCHANTRA', 'ជឹម សុខចិន្ត្រា', 'male', '180767139(01)', NULL, '016 942 272', 'Technician PDI', 'After Sales', 'Head Quarters', '', '1999-05-14', '2025-07-18', 0.00, 'active', '2025-07-18', '2025-10-02 05:00:19', '2025-10-02 05:00:19'),
(7, 'ROEUN SREYNIT', 'រឿន ស្រីនីត', 'male', '040545335', NULL, '097 532 7195', 'Logistic Assistant', 'human_resources', 'Head Quarters', '', '2003-10-21', '2025-07-25', 0.00, 'active', '2025-07-25', '2025-10-02 06:17:31', '2026-02-25 03:47:33'),
(8, 'HOU OULYCHHONG', 'ហ៊ូ អ៊ូលីឆុង', 'male', '021266555', NULL, '096 500 9908', 'Part Assistant', 'Spare Part', 'Head Quarters', '', '2001-10-22', '2025-09-01', 0.00, 'active', '2025-09-01', '2025-10-02 06:19:50', '2025-10-02 06:19:50'),
(9, 'KHUTH SOKCHAMROEUN', 'ឃុត សុខចំរើន', 'male', '011116203', NULL, '098 542 224', 'Learning & Development', 'Human Resources & Admin', 'Headquarters', '', '1997-12-26', '2025-09-08', 0.00, 'active', '2025-09-08', '2025-10-02 06:21:38', '2026-02-25 07:38:55'),
(10, 'JOHN CHANDALIN', 'ចន ច័ន្ទដាលីន', 'male', '051612784', NULL, '096 648 6561', 'Admin Officer', 'After Sales', 'Head Quarters', '', '2002-11-02', '2025-09-08', 0.00, 'active', '2025-09-08', '2025-10-02 06:23:40', '2025-10-02 06:23:40'),
(11, 'HAN HAK', 'ហាន ហាក់', 'male', '180860351', NULL, '088 344 8048', 'Technician', 'After Sales', 'MG Siem Reap', '', '1999-10-05', '2025-09-09', 0.00, 'active', '2025-09-09', '2025-10-02 06:25:32', '2025-10-02 06:25:32'),
(12, 'CHEA SOMNANG', 'ជា សំណាង', 'male', '101468729', NULL, '088 913 1139', 'Technician Apprentices', 'After Sales', 'MG 50M', '', '2004-02-03', '2025-09-08', 0.00, 'active', '2025-09-08', '2025-10-02 06:27:47', '2025-10-02 06:27:47'),
(13, 'CHANN LEAPHEA', 'ចាន់ លាភា', 'male', '190583731', NULL, '096 647 6646', 'Cleaner', 'Admin', 'Head Quarters', '', '1991-03-30', '2025-09-01', 0.00, 'active', '2025-09-01', '2025-10-02 06:29:41', '2025-10-02 06:29:41'),
(14, 'CHHUN CHANSREYPOCH', 'ឈុន ចាន់ស្រីប៉ុច', 'male', '010885888(01)', NULL, '096 480 8918', 'Cleaner', 'Admin', 'Head Quarters', '4Wheelers', '1986-07-08', '2025-09-08', 0.00, 'active', '2025-09-08', '2025-10-02 06:31:21', '2025-11-29 02:23:32'),
(15, 'CHHOEURN PHIRITH', 'ឈឿន ភិរិត', 'male', '101410810', NULL, '096 719 6704', 'Technician', '4w After Sales', 'Head Quarters', '', '2001-08-06', '2025-10-06', 0.00, 'active', '2025-10-06', '2025-10-02 06:34:08', '2025-10-02 06:34:08'),
(16, 'LIM KUYLANG', 'លឹម គុយឡាង', 'female', '011471673', 'N/A', '+855 93 829 390', 'Sales Apprentice', 'Sales', 'Head Quarters', '', '2003-10-23', '2025-10-20', 0.00, 'active', '2025-10-09', '2025-10-10 04:34:12', '2025-10-10 04:34:12'),
(17, 'CHHON CHANMOLIKA', 'ឆុន ច័ន្ទមល្លិកា', 'female', '011420350', 'N/A', '081589752', 'Sales Apprentice', 'Sales', 'Head Quarters', '', '2006-08-14', '2025-10-20', 0.00, 'active', '2025-10-09', '2025-10-10 04:40:16', '2025-10-10 05:01:29'),
(18, 'AN CHEASOKKONG', 'អាន ជាសុខគង់', 'male', '021251500', 'N/A', '069515251', 'Technician motorbike', 'After Sale', 'Head Quarters', '', '2001-08-27', '2025-10-13', 0.00, 'active', '2025-10-07', '2025-10-10 04:45:27', '2025-10-10 06:18:25'),
(19, 'SUN HENGLY', 'សុន ហេងលី', 'male', '011060568', 'N/A', '0965295758', 'Warehouse Controller', 'Spare Part', 'Head Quarters', '', '1999-09-08', '2025-11-20', 0.00, 'active', '2025-10-09', '2025-10-10 04:50:40', '2025-10-10 04:50:40'),
(20, 'THAN RACHANA WIDDHYA', 'ថន រចនា វិត្យា', 'male', '010873651 (01)', NULL, '092 835 003', 'Service Manager', 'After Sales', 'Head Quarters', '', '1996-04-30', '2025-10-16', 0.00, 'active', '2025-10-11', '2025-10-16 04:39:27', '2025-10-16 04:39:27'),
(21, 'MOV PISETH', 'ម៉ូវ ពិសិដ្ឋ', 'male', '101317768', NULL, '0885624274', 'Technician PDI 4W', 'After Sales', 'Head Quarters', '', '2000-01-10', '2025-11-01', 0.00, 'active', '2025-10-30', '2025-10-30 06:13:31', '2025-10-30 06:13:31'),
(22, 'SEANG RAVIN', 'សៀង រ៉ាវីន', 'female', '250010105', 'N/A', '078 888 303', 'Sales Consutlatn', 'human_resources', 'Head Quarters', '', '1997-10-21', '2025-11-03', 0.00, 'can\'t join', '2025-10-22', '2025-10-30 06:57:28', '2026-02-21 04:19:11'),
(23, 'SAN VICHHAY', 'សាន វិឆៃ', 'male', '062322453', 'N/A', '096 831 0861', 'Technician PDI 4W', 'Sales', 'Head Quarters', '', '2005-09-03', '2025-11-01', 0.00, 'active', '2025-10-14', '2025-10-30 07:10:16', '2025-10-30 07:10:16'),
(24, 'THAI MAKARA', 'ថៃ មករា', 'male', '160564274', 'N/A', '097 294 0204', 'Technician 2W', NULL, 'Head Quarters', '2Wheelers', '2004-01-07', '2025-12-01', 0.00, 'active', '2025-10-23', '2025-10-30 07:13:05', '2025-12-01 02:01:20'),
(25, 'KRON POV', 'គ្រន ពៅ', 'male', '020862683(02)', 'N/A', '015 442 141', 'Technician 4W', 'After Sales', 'Head Quarters', '', '1995-06-04', '2025-10-02', 0.00, 'active', '2025-10-30', '2025-10-30 07:54:06', '2025-10-30 07:54:06'),
(26, 'OUK SREYTY', 'អ៊ុក ស្រីទី', 'female', '021108682', NULL, '069954517', 'Call Center Representative', 'After Sales', 'Head Quarters', '', '1998-07-01', '2025-11-17', 0.00, 'active', '2025-11-13', '2025-11-13 06:36:46', '2025-11-13 06:36:46'),
(27, 'HIM SIEKLIM', 'ហ៊ឺម សៀកលីម', 'male', '020741175(01)', 'N/A', '093592853', 'Car Washer', 'After Sales', 'Head Quarters', '', '1980-04-15', '2025-11-14', 0.00, 'active', '2025-11-13', '2025-11-13 06:40:59', '2025-11-13 06:40:59'),
(28, 'SAL​ SOPHEA', 'សល់ សុភា', 'male', '021096715(01)', 'N/A', '0965839058', 'Car Washer', 'Sales', 'Head Quarters', '', '1998-02-13', '2025-11-17', 0.00, 'active', '2025-11-13', '2025-11-13 06:51:39', '2025-11-13 06:51:39'),
(29, 'HUOT MALA', 'ហួត ម៉ាឡា', 'male', '170378835(01)', NULL, '089608488', 'Cleaner', 'Admin', 'Siem Reap', '', '1985-09-08', '2025-11-14', 0.00, 'active', NULL, '2025-11-13 06:58:21', '2025-11-13 06:58:21'),
(30, 'SAN VUTHY', 'សាន វុឌ្ឍី', 'male', '200246793', 'N/A', '098757558', 'Senior Finance Supervisor', 'Finance', 'Head Quarters', '', '1986-07-10', '2025-11-10', 0.00, 'active', NULL, '2025-11-13 07:04:42', '2025-11-13 07:04:42'),
(31, 'HAY SOKBAN', 'ហៃ សុខបាន', 'male', '010863091(01)', 'N/A', '087313609', 'Car Washer', 'After Sales', 'Head Quarters', '', '1997-06-10', '2025-11-17', 0.00, 'active', NULL, '2025-11-17 02:34:58', '2025-11-17 02:34:58'),
(32, 'MOEURN CHANDAVIT', 'មឿន ច័ន្ទដាវីត', 'male', '011373845', NULL, '099 979 411', 'Sales Consultant - Peugeot', 'Sales', 'Head Quarters', '', '2003-07-21', '2025-11-18', 0.00, 'active', NULL, '2025-11-18 02:07:13', '2025-11-18 02:07:13'),
(33, 'CHRON SOLINDA', 'ជ្រន សុលីនដា', 'female', '040552031', NULL, '016 567 517', 'Sales Admin Apprentice', 'Admin', 'Head Quarters', '4Wheelers', '2002-07-16', '2025-12-08', 0.00, 'active', NULL, '2025-11-18 03:17:02', '2025-11-29 02:23:42'),
(34, 'SOEUN NITA', 'សឿន នីតា', 'female', '101394615', NULL, '010 831 822', 'Accountant Apprentice', 'Finance', 'Head Quarters', '', '2004-02-14', '2025-11-07', 0.00, 'active', NULL, '2025-11-18 03:19:45', '2025-11-18 03:19:45'),
(35, 'OEUR META', 'អឿ មេត្តា', 'male', '021254794', 'N/A', '096 805 3202', 'Technician PDI', 'After Sales', 'Head Quarters', '', '2002-04-05', '2025-08-25', 0.00, 'active', NULL, '2025-11-20 02:49:13', '2025-11-20 02:49:13'),
(36, 'LOCH CHANRIM', 'ឡច ចាន់រីម', 'male', '040352856(01)', NULL, '098 498 658', 'Senior Technician', 'After Sales', 'Head Quarters', '', '1995-09-12', '2025-11-24', 0.00, 'active', NULL, '2025-11-24 02:00:33', '2025-11-24 02:00:33'),
(37, 'PITOU BOTUM', 'ពិទូរ្យ បូទុម', 'female', '021344834', NULL, '016 681 135', 'Content Creator', '4W Marketing Car', 'Head Quarters', '', '2003-08-16', '2025-12-01', 0.00, 'active', NULL, '2025-11-26 08:30:05', '2025-11-26 08:30:05'),
(38, 'LIM VINLONG', 'លីម វិនឡុង', 'male', '011271256', 'N/A', '010 828 788', 'Sales Consultant - Leapmotor', 'Sales', NULL, '', '2001-01-24', '2025-12-01', NULL, 'active', NULL, '2025-11-26 08:35:33', '2025-11-26 08:35:33'),
(39, 'SAN SOTHY', 'សន សុធី', 'female', '010700352(01)', NULL, '010 967 362', 'Admin Supervisor', 'Admin', 'Head Quarters', '4Wheelers', '1992-08-03', '2025-12-12', NULL, 'active', NULL, '2025-11-26 09:10:39', '2025-11-26 10:09:33'),
(40, 'BUN PANHA', 'ប៊ុន បញ្ញា', 'male', '010715283 (01)', NULL, '098279119', 'Tax Manager', 'Finance', 'Head Quarters', '4Wheelers', '1993-05-29', '2025-12-01', NULL, 'active', '2025-10-23', '2025-11-29 02:09:51', '2025-11-29 02:09:51'),
(41, 'THY CHENDA', 'ធី ចិន្តា', 'female', '020902905(01)', 'N/A', '0966031121', 'Sales Consultant', 'Sales', 'Head Quarters', '4Wheelers', '1996-06-30', '2026-01-05', 0.00, 'active', '2025-12-09', '2025-12-27 02:50:57', '2025-12-27 04:14:37'),
(42, 'SOMNANG SOMAVOTEY', 'សំណាង សុម៉ាវត្តី', 'female', '011354043', NULL, '085 200 276', '4w Logistics Assistant', '2W Logistics', 'Head Quarters', '4Wheelers', '2003-09-16', '2026-01-14', 0.00, 'active', NULL, '2026-01-13 02:55:53', '2026-01-13 02:55:53'),
(43, 'HEA VEASNA', 'ហ៊ា វាសនា', 'male', '030839912', 'N/A', '069 262 712', 'Technical Team Leader', 'Executive Leadership', 'Siem Reap Branch', '2Wheelers', '1996-08-08', '2026-01-16', 0.00, 'active', NULL, '2026-01-16 03:20:46', '2026-02-25 06:59:21'),
(44, 'SETHA SREYNICH', 'សេដ្ឋា ស្រីនិច', 'female', '171064879', NULL, '096 96 65 861', 'Customer Service', 'After-Sales Service', 'Battambang Branch', '4Wheelers', '1999-05-04', '2026-02-02', 0.00, 'active', NULL, '2026-01-23 02:04:32', '2026-02-25 06:24:08'),
(45, 'LIM PECH SOTHIRA', 'លឹម ពេជ្យសុធីរា', 'female', '011413555', 'N/A', '098 734 888', 'Content Creator Apprentice', '4W Marketing Car', 'Head Quarters', '4Wheelers', '2006-07-30', '2026-02-02', 0.00, 'active', NULL, '2026-01-27 09:42:03', '2026-01-27 09:42:03'),
(46, 'CHOEUN CHANHENG', 'ជឿន ច័ន្ទហេង', 'male', '101460816', NULL, '067 563 132', 'Graphic Designer', NULL, 'Head Quarters', '4Wheelers', '2005-09-19', '2026-02-02', 0.00, 'active', NULL, '2026-01-28 03:37:34', '2026-01-28 03:37:59'),
(47, 'TIN FATILAS', 'ទីន ហ្វាទីឡាស់', 'female', '010880179(01)', NULL, '015 611 008', 'Service Admin', 'After-sale Royal Enfiled', 'Head Quarters', '2Wheelers', '1995-12-20', '2026-02-02', 0.00, 'active', NULL, '2026-02-03 03:42:39', '2026-02-25 09:11:15'),
(48, 'KHIM KIMCHHIENG', 'ឃឹម គីមឈៀង', 'male', '170720645(01)', NULL, '012 778 063', 'Spare Part Officer', 'Spare Part', 'Headquarters', '2W', '1996-03-07', '2026-02-09', 0.00, 'active', NULL, '2026-02-03 03:59:09', '2026-02-25 09:32:58'),
(49, 'CHHIM SENGHAV', 'ឈឹម សេងហាវ', 'male', '040439994', 'N/A', '070693326', 'Content Creator Leapmotor', 'Sales & Marketing', 'Vive Motors', '2W', '2000-02-12', '2026-03-02', 0.00, 'probation', '2026-02-01', '2026-02-25 03:29:47', '2026-03-02 02:17:40'),
(50, 'sun virak', 'ស៊ុន វីរៈ', 'male', '170709557', 'N/A', '010 359 899', 'Car Washer', 'TF1 After Sales', 'Battambang', '4W', '1994-06-26', '2026-03-16', 0.00, 'probation', '2026-02-10', '2026-02-25 09:26:29', '2026-03-03 03:13:42'),
(51, 'OEUN SREYRAM', 'អឿន ស្រីរ៉ាំ', 'female', '180956184', NULL, '071 531 322', 'Service Advisor', 'TF1 After Sales', 'Siem Reap Branch', '4W', '2003-01-08', '2026-03-02', 0.00, 'probation', '2026-01-29', '2026-02-27 08:05:53', '2026-02-27 08:05:53'),
(52, 'SENG SOPHEAK', 'សេង សុភក្ដ័', 'male', '101046368', NULL, '096 210 957', 'Technician', 'TF1 After Sales', 'Headquarters', '4W', '1998-04-07', '2026-03-02', 0.00, 'probation', '2026-01-27', '2026-02-27 08:09:19', '2026-02-27 08:09:19'),
(54, 'BEUN TONGTE', 'ប៊ឺន តុងទី', 'male', '030632360(01)', NULL, '096 740 404', 'Warehouse Assistant', 'Spare Part', 'Headquarters', '4W', '1999-07-04', '2026-04-06', 0.00, 'probation', '2026-04-01', '2026-03-31 18:29:22', '2026-03-31 18:29:22');

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
-- Table structure for table `handovers`
--

CREATE TABLE `handovers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `branch` varchar(255) NOT NULL,
  `handover_date` date NOT NULL DEFAULT '2026-07-06',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `handovers`
--

INSERT INTO `handovers` (`id`, `employee_name`, `position`, `branch`, `handover_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CHEA KIMHONG', 'SPEAR PART TEAM', 'MG Battambang', '2026-07-06', 'active', '2026-07-06 02:50:08', '2026-07-06 02:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `handover_items`
--

CREATE TABLE `handover_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `handover_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `asset_code` varchar(255) DEFAULT NULL,
  `condition` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `handover_items`
--

INSERT INTO `handover_items` (`id`, `handover_id`, `description`, `serial_number`, `quantity`, `asset_code`, `condition`, `created_at`, `updated_at`) VALUES
(2, 1, 'LENOVO SLIM 3', '1QAZ2WSX', 1, 'AST-1492', 'ថ្មី', '2026-07-06 03:05:54', '2026-07-06 03:05:54');

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
-- Table structure for table `job_posts`
--

CREATE TABLE `job_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `employment_type` varchar(255) NOT NULL DEFAULT 'Full Time',
  `salary_range` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL DEFAULT 'Phnom Penh, Cambodia',
  `description` text DEFAULT NULL,
  `status` enum('Open','Closed','Draft') NOT NULL DEFAULT 'Open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`id`, `title`, `employment_type`, `salary_range`, `location`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Senior Inventory Specialist', 'Full Time', NULL, 'Phnom Penh', 'Manage inventory operations, monitor stock accuracy, coordinate with suppliers, and ensure efficient warehouse processes across all business locations.\r\nRequirements\r\n3+ years of inventory management experience\r\nStrong analytical and organizational skills\r\nExperience with ERP or inventory systems\r\nMicrosoft Excel proficiency', 'Open', '2026-07-07 09:41:25', '2026-07-07 09:41:25'),
(2, 'Senior Software Developer', 'Full Time', NULL, 'Phnom Penh', 'Design, develop, and maintain enterprise applications while collaborating with cross-functional teams to deliver high-quality software solutions.\r\nRequirements\r\n5+ years of software development experience\r\nLaravel, PHP, MySQL\r\nFlutter or React experience is a plus\r\nGit and REST API knowledge', 'Open', '2026-07-07 10:05:14', '2026-07-07 10:05:14');

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
(4, '2025_09_30_030007_create_employees_table', 2),
(5, '2026_02_20_094934_add_status_to_employees_table', 3),
(6, '2026_07_03_132137_add_is_admin_to_users_table', 4),
(7, '2026_07_05_101629_create_permission_tables', 5),
(8, '2026_07_06_091116_create_handovers_table', 6),
(9, '2026_07_06_091217_create_handover_items_table', 6),
(10, '2026_07_07_160339_create_job_posts_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2026-07-05 03:18:42', '2026-07-05 03:18:42'),
(2, 'Staff', 'web', '2026-07-05 03:18:42', '2026-07-05 03:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('077e92w2nB57mIqtIm0ZmbMYSJAhf4n1eONMSsIg', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkI3WHFmenRoWmZPQ21MWTJvZ3k0WTV5Zms0VmV4cENsS2lpZk9BMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9lbXBsb3llZS5uZXRlbS5vbmxpbmUvZW1wbG95ZWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1775664148),
('2NfZKadjiDh0JqdaLmq4r496uywVyLsc5LcxxDCh', NULL, '192.168.0.121', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUXVJSTZKNXNyb21XMVNpUFNHeHdueXA4d3E0cFkxWFZhWHJSUHpaRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly8xMC4wLjAuNzo4MDgwL215X3Byb2plY3QvcHVibGljL2VtcGxveWVlLzU0L2VkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1774984090),
('69dY912fIxfRRjvb8YSBI3rE1BHq5JdVMBt3E5mJ', NULL, '192.168.0.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYndmODJTTWRxQUM4NkswYmdNSlNqY1RLajVhSHFndkRHR0V2amFKdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly8xMC4wLjAuNzo4MDgwL215X3Byb2plY3QvcHVibGljL2VtcGxveWVlL2NyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1774981573),
('b7ifvxkB32rHiTTsu489x7Tm14mhe6hA3rHNtZwX', NULL, '192.168.0.74', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidDFlOFV2T0NHYjVoRTRVRUpuVEFwY1hqRVk2QXJQTDRPb1ZqbjdNdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775138391),
('c6Gt734AJMz4qwmRmsrJx39d3QPFwDXmOSAXjlrK', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYVg5SElNNkVVVG9KQmxmTjNqNFpLam5nVWJYVGhaRlI1NVpKTW5QVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly9tZy1kZWFsZXIubmV0ZW0ub25saW5lL2NoZWNrLWF1dGgtc2Vzc2lvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1775664171),
('dbrrzoeGI6bZfBGJCpvOw9Z9gLJnUTX1JOAFsxOq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0ZCQjBhbFRWU0FDaVB1bjVWbUVYazZnS0FNSmNrYm0zaXNhVFBmMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lbXBsb3llZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777691856),
('djwOL8Bmis9oCPVlRRTKH5Mvy2gHvYWXRYTlSKk1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkdxT2loSGZDckVXOGEzb283TzRESXJqdWdKcUxMV3kxNWZ4OUFxRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lbXBsb3llZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1778656242),
('eRRejAeZOaZ8J1HRfzWH1MorVKI7hsHDj6FU8fC0', NULL, '192.168.0.136', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWVybU5UcWE4cXBSUWVwZzJiTkczeGdVR3VXSXJSb09VSkdLNTJsdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMC4wLjAuNzo4MDgwL215X3Byb2plY3QvcHVibGljL2VtcGxveWVlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774981763),
('hgEG20PPdSqWdNxpkhxMglt1RJm6PmS5gNARpsBk', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0Rnb1RDa2paaFEyWnpveklqbkVUajEyd0FOUGhvV2JaZEVnOVpVSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9tZy1kZWFsZXIubmV0ZW0ub25saW5lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775660721),
('kipSkRtGKxnK2GclQsazFVprMfTye5iB67fQsb90', NULL, '192.168.0.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib3lEU01IbW1Wbmhsd0JSMEo0b0hMbHJaQ1ZLUHVGdEN4M3ZjU1BmYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMC4wLjAuNzo4MDgwL215X3Byb2plY3QvcHVibGljL2VtcGxveWVlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775225721),
('KKPnfUfqCnBITrKIP7jz8YDLA9R3eAHlZMgJ5lnu', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFVrWDY1MkhveDJ4YVExbUxFZ3QwajBOeUpwT2lRTFh3WW1TRjF2SCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9lbXBsb3llZS5uZXRlbS5vbmxpbmUvZW1wbG95ZWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1775664181),
('lOTyU7mtfpMfW5W7mGV0YRE7F9sLEkhr50LmRfYu', NULL, '192.168.0.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3NiRURDYW5vQ1c5bFphTmV6SEVnNGtGbHE5RDFVZk5nWU5KbE9uYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMC4wLjAuNzo4MDgwL215X3Byb2plY3QvcHVibGljL2VtcGxveWVlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775225753),
('QIZTUuUBuNA1lCmSz1ALxRWEY49CBlIycMIR8C68', NULL, '192.168.0.122', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1FLSkIxbjc3Y0hONG1KTnAxdjFVeGk0RGttYVlnSWlwSVRhbVRmUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMC4wLjAuNzo4MDgwL215X3Byb2plY3QvcHVibGljL2VtcGxveWVlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775144107),
('rd4tTT4veNdYfgUZqLRPmWDwajD14J39wteQI3h6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHN0VHBUNVI3bzEzckVGQWtPOURjTUh5REEzR0Ftc20yYVdGNzFaQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9lbXBsb3llZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1775659359),
('TAbXig4hVGZQydsUsvDvqXZA0am8JXlJBfwmKBh4', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieEpVcFc3VnNTTFc4Z3NnZHNrZkNYUXpydHl4TEhTQ3lSVGtoQmpOSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9lbXBsb3llZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1775661354),
('tAn4MPhPAQMI9w5zzASte3vu3WnnQa5pzwME4h7A', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVhuVWRWbWo2ME5zcnlORmc0UkQ3RzZIbXc4Y3lJeFZkRkgyeEhlWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9tZy1kZWFsZXIubmV0ZW0ub25saW5lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775661985),
('W7jpnAmNW5cc9hp35fItTKrN7fIZFmtCA4pzwHqa', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibmtDRmJUTnRMNXNnWlV1MkVuUXlKcEZPUU1LcnRWd3NKaTE1ZXhVNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9lbXBsb3llZS5uZXRlbS5vbmxpbmUvZW1wbG95ZWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1775664171),
('yNS8W67DiFalyKIb1kuHBe2abmRkBZZq6STEhVlo', NULL, '172.16.0.6', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYm1UUllia05NUE56aW5sY2ozQU1OYnRYaXBtWlRsbk5UMTNZaTRNVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMC4wLjAuNzo4MDgwL215X3Byb2plY3QvcHVibGljL2VtcGxveWVlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774982143);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Manager', 'admin@example.com', 1, NULL, '$2y$12$teK5hLgHhSWGG35nJiZc3eKPDIAHcl5lV12bXqAIQr1fxnfDGCzMG', NULL, '2026-07-03 06:48:38', '2026-07-05 09:56:28'),
(2, 'Super Admin', 'admin@tfmotors.com', 0, NULL, '$2y$12$rLI.PEi.UHcPuL0ahBuBg.f94gmT1GJNG9/Gz5/vxWj8k12Cj7asa', 'aUMXBgpAnja4qyoj6PAAfwQybRkIAyR5THUlhuzwOrA4uvMfsxgxX52zILfM', '2026-07-05 03:18:42', '2026-07-05 03:18:42'),
(3, 'General Staff', 'staff@tfmotors.com', 0, NULL, '$2y$12$A0FEFxDp902.vb0JL0sJWuZHjWxC38wjRTLtOrFy6PGtAu6.2U9Za', NULL, '2026-07-05 03:18:43', '2026-07-05 03:18:43');

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
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_identity_card_unique` (`identity_card`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `handovers`
--
ALTER TABLE `handovers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `handover_items`
--
ALTER TABLE `handover_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `handover_items_handover_id_foreign` (`handover_id`);

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
-- Indexes for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `handovers`
--
ALTER TABLE `handovers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `handover_items`
--
ALTER TABLE `handover_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_posts`
--
ALTER TABLE `job_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
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
-- Constraints for table `handover_items`
--
ALTER TABLE `handover_items`
  ADD CONSTRAINT `handover_items_handover_id_foreign` FOREIGN KEY (`handover_id`) REFERENCES `handovers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
