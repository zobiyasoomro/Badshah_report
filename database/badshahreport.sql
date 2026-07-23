-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2026 at 07:35 PM
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
-- Database: `badshahreport`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_pages`
--

CREATE TABLE `about_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` longtext NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_pages`
--

INSERT INTO `about_pages` (`id`, `title`, `subtitle`, `description`, `logo`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'REDEFINING THE EXCHANGEE', 'The Premium Platformm ⟶', 'BetPro Exchange is a premium, high-liquidity peer-to-peer ecosystem built for players who demand\r\n                        ultimate market transparency and ultra-competitive odds. \r\nUnlike traditional books that fix margins against you, our platform lets you back, lay, and set your\r\n                        own terms with absolute transparency. Driven by advanced real-time matching engines, we connect\r\n                        global traders directly to the actionn.', 'images/1784200412_login_logo.png', 1, NULL, '2026-07-16 06:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(3, '2026’s Biggest Gaming Surprises: Titles You Need to Play Right Now', '2026 has been a wild ride for the gaming industry. While everyone was busy counting down the days for blockbuster behemoths, several sleeper hits and unexpected expansions quietly dropped and completely stole the spotlight. If you are looking to update your backlog, here are the most notable games that are dominating the conversation.1. High on Life 2: The Ultimate ComebackLet’s be honest—the original High on Life was a massive hit, but its constant, in-your-face humor wasn\'t for everyone. High on Life 2 completely flips the script, delivering a tighter, more refined experience. The devs actually listened to fan feedback: they toned down the incessant chatter and delivered significantly improved gameplay that makes exploring alien worlds an absolute joy. It\'s easily the biggest—and most pleasant—surprise of the year.2. Resident Evil RequiemCapcom has done it again. Serving as the ninth mainline entry in the franchise, Resident Evil Requiem successfully balances atmospheric, classic survival horror with tight, grounded modern action. With a brisk 10-hour campaign, the game is beautifully optimized for PC and consoles, never padding out its runtime or wasting your time.3. MewgenicsIf you love tactical RPGs and have a soft spot for weird, strategic gameplay, Mewgenics is a must-play. Created by the mastermind behind The Binding of Isaac, this roguelike loop centers around breeding and genetically manipulating an entire army of cats. It is incredibly strange, deeply strategic, and one of the highest-rated PC games of 2026 so far.', '1784207692_2026s-biggest-gaming-surprises-titles-you-need-to-play-right-now.png', '2026-07-16 08:14:52', '2026-07-16 08:14:52');

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
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `description`, `created_at`, `updated_at`, `is_read`, `read_at`) VALUES
(3, 'Ubaid Soomro', 'ubaidsoomro505@gmail.com', 'Testing', 'sadasd wsdasd dsasD AS', '2026-07-20 04:54:16', '2026-07-20 04:54:16', 1, '2026-07-20 15:54:25'),
(5, 'Sara Ahmed', 'sara.ahmed@outlook.com', 'Support Needed', 'I need help with my account. Please contact me.', '2026-07-20 15:54:06', '2026-07-20 15:54:06', 1, '2026-07-20 15:54:25'),
(6, 'Usman Khan', 'usman.k@yahoo.com', 'Partnership', 'We want to partner with your platform. Let me know the process.', '2026-07-20 15:54:06', '2026-07-20 15:54:06', 1, '2026-07-20 15:54:25'),
(7, 'Ubaid Soomro', 'ubaidsoomro505@gmail.com', 'Testing', 'dsadasd dsadsa sad', '2026-07-20 11:03:37', '2026-07-20 11:11:11', 1, '2026-07-20 11:11:11'),
(8, 'Ubaid Soomro', 'ubaidsoomro505@gmail.com', 'Testing', 'dasdas', '2026-07-20 11:11:23', '2026-07-20 11:13:57', 1, '2026-07-20 11:13:57'),
(9, 'Ubaid Soomro', 'ubaidsoomro505@gmail.com', 'Schedule', 'heelow heelow heelow heelow heelow heelow heelow heelow heelow', '2026-07-20 11:14:38', '2026-07-20 11:22:25', 1, '2026-07-20 11:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `user_account_number` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `branch_code` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `screenshot_path` varchar(255) DEFAULT NULL,
  `is_receipt_required` tinyint(1) NOT NULL DEFAULT 0,
  `receipt_path` varchar(255) DEFAULT NULL,
  `receipt_submitted_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','approved','declined','expired') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `declined_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `user_id`, `payment_method_id`, `account_holder_name`, `user_account_number`, `amount`, `payment_method`, `bank_name`, `account_number`, `branch_code`, `transaction_id`, `screenshot_path`, `is_receipt_required`, `receipt_path`, `receipt_submitted_at`, `expires_at`, `status`, `admin_notes`, `approved_at`, `declined_at`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Ubaidullah', '031331399448', 50.00, 'mobile_wallet', 'EasyPaisa', '03188893863', NULL, '1470147014701470', NULL, 1, 'deposits/receipt_1784379335_6a5b77c71d30d.jpeg', NULL, '2026-07-19 07:55:35', 'approved', NULL, NULL, NULL, '2026-07-18 07:55:35', '2026-07-18 07:55:35'),
(2, 3, 2, 'Ubaidullah', '031331399448', 2000.00, 'mobile_wallet', 'JazzCash', '03098765432', NULL, '4710471047104710', NULL, 1, 'deposits/receipt_1784380296_6a5b7b887a7ed.png', NULL, '2026-07-19 08:11:36', 'approved', NULL, NULL, NULL, '2026-07-18 08:11:36', '2026-07-18 08:11:36'),
(3, 3, 3, 'Ubaidullah', NULL, 3000.00, 'bank', 'MCB Bank', '12345678901234', '35210061', '147014701470147096', 'deposits/screenshot_1784380393_6a5b7be9522f5.png', 0, NULL, NULL, '2026-07-19 08:13:13', 'approved', NULL, NULL, NULL, '2026-07-18 08:13:13', '2026-07-18 08:13:13'),
(4, 3, 1, 'Ubaidullah', '03188893863', 500.00, 'mobile_wallet', 'EasyPaisa', '03188893863', NULL, '147014701470147054', NULL, 1, 'deposits/receipt_1784393747_6a5bb0137960d.jpeg', NULL, '2026-07-19 11:55:47', 'approved', NULL, NULL, NULL, '2026-07-18 11:55:47', '2026-07-18 11:55:47'),
(5, 3, 2, 'Ubaidullah', '03188893863', 500.00, 'mobile_wallet', 'JazzCash', '03098765432', NULL, '147014711470141471', NULL, 1, 'deposits/receipt_1784394397_6a5bb29d07ac2.jpeg', NULL, '2026-07-19 12:06:37', 'approved', NULL, NULL, NULL, '2026-07-18 12:06:37', '2026-07-18 12:06:37'),
(6, 10, 1, 'Ubaidullah', '03188893863', 500.00, 'mobile_wallet', 'EasyPaisa', '03188893863', NULL, '147014701470147042', NULL, 1, 'deposits/receipt_1784396653_6a5bbb6d24e45.jpeg', NULL, '2026-07-19 12:44:13', 'approved', 'my marzi', NULL, '2026-07-19 00:58:40', '2026-07-18 12:44:13', '2026-07-19 00:58:40'),
(7, 12, 1, 'Ubaidullah', '03188393863', 500.00, 'mobile_wallet', 'EasyPaisa', '03188893863', NULL, 'TXN65364012Y44R', NULL, 1, 'deposits/receipt_1784565380_6a5e4e84b2b9a.png', NULL, '2026-07-21 11:36:20', 'declined', NULL, NULL, '2026-07-20 12:28:36', '2026-07-20 11:36:20', '2026-07-20 12:28:36');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

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
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('mobile_wallet','bank') NOT NULL DEFAULT 'mobile_wallet',
  `account_holder_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `account_iban` varchar(255) DEFAULT NULL,
  `branch_code` varchar(50) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `deep_link_scheme` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `type`, `account_holder_name`, `account_number`, `account_iban`, `branch_code`, `logo_path`, `deep_link_scheme`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'EasyPaisa', 'mobile_wallet', 'Ubaidullah', '03188893863', NULL, NULL, NULL, 'easypaisa://', 1, 1, '2026-07-17 11:22:31', '2026-07-17 11:22:31'),
(2, 'JazzCash', 'mobile_wallet', 'Muhammad Ahmed', '03098765432', NULL, NULL, NULL, 'jazzcash://', 1, 2, '2026-07-17 11:22:31', '2026-07-17 11:22:31'),
(3, 'Meezan Bank', 'bank', 'Muhammad Ahmed', '12345678901234', 'PK99MEZN0001234567890123', '0123', NULL, NULL, 1, 3, '2026-07-17 11:22:31', '2026-07-17 11:22:31'),
(4, 'Habib Bank Limited (HBL)', 'bank', 'Muhammad Ahmed', '98765432109876', 'PK88HBLB0009876543210987', '0456', NULL, NULL, 1, 4, '2026-07-17 11:22:31', '2026-07-17 11:22:31'),
(5, 'Bank Alfalah', 'bank', 'Muhammad Ahmed', '56789012345678', 'PK77ALFH0005678901234567', '0789', NULL, NULL, 1, 5, '2026-07-17 11:22:31', '2026-07-17 11:22:31'),
(6, 'United Bank Limited (UBL)', 'bank', 'Muhammad Ahmed', '34567890123456', 'PK66UBLB0003456789012345', '0345', NULL, NULL, 1, 6, '2026-07-17 11:22:31', '2026-07-17 11:22:31'),
(7, 'MCB Bank', 'bank', 'Muhammad Ahmed', '23456789012345', 'PK55MCBB0002345678901234', '0567', NULL, NULL, 1, 7, '2026-07-17 11:22:31', '2026-07-17 11:22:31'),
(8, 'National Bank of Pakistan', 'bank', 'Muhammad Ahmed', '45678901234567', 'PK44NBPP0004567890123456', '0890', NULL, NULL, 1, 8, '2026-07-17 11:22:31', '2026-07-17 11:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `planes`
--

CREATE TABLE `planes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `planes`
--

INSERT INTO `planes` (`id`, `user_id`, `name`, `short_description`, `price`, `created_at`, `updated_at`) VALUES
(1, 3, 'Bronze', 'first tier rank dont get any vip services', 260.00, '2026-07-20 01:06:16', '2026-07-20 01:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `plane_buyers`
--

CREATE TABLE `plane_buyers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `plane_id` bigint(20) UNSIGNED NOT NULL,
  `screenshot` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plane_buyers`
--

INSERT INTO `plane_buyers` (`id`, `user_id`, `plane_id`, `screenshot`, `price`, `created_at`, `updated_at`) VALUES
(1, 9, 1, 'plane_screenshot/1784528330_6a5dbdca5ca8a.png', 260.00, '2026-07-20 01:18:50', '2026-07-20 01:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `join_url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `name`, `subtitle`, `description`, `logo`, `website_url`, `join_url`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(3, 'Ubaid Soomro Soomro', 'hellow hellow hellow hellow hellow hellow hellow hellow hellow hellow hellow', 'hellow hellow hellow hellow hellow hellow hellow hellow hellow hellow hellow hellow hellow hellow hellow', 'platforms/1784210916_login_logo.png', NULL, 'https://www.youtube.com/watch?v=bXR8fKMCnNM', 1, 0, '2026-07-16 09:08:36', '2026-07-16 09:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `rating`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Ubaid Soomro', 5, 'dfasd dsd sd dsda', '1784559494_Fdrc6x1RfU.png', 'approved', '2026-07-20 09:58:14', '2026-07-20 12:31:46'),
(3, 'Muzamil', 5, 'hellow hellow hellow hellow hellow hellow hellow hellow hellow hellow hellow hellow ', NULL, 'pending', NULL, NULL);

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
  `user_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `whatsapp_number` varchar(20) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `register_account` tinyint(1) DEFAULT 1,
  `unregister_account` tinyint(1) DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `name`, `email`, `image`, `email_verified_at`, `password`, `whatsapp_number`, `city`, `register_account`, `unregister_account`, `remember_token`, `created_at`, `updated_at`, `address`, `state`, `country`, `linkedin_url`, `instagram_url`, `twitter_url`, `facebook_url`) VALUES
(3, 'betproadmin', 'Admin Userr', 'admin@betprOo.comm', '1784205726_6a58d19e42797.png', NULL, 'admin321', '031888938644', 'HYDERABADD', 1, 0, NULL, '2026-07-14 08:51:36', '2026-07-16 08:03:18', 'Qasimabad hyderabad\r\nQasimabad Hyderabad Sindh Pakistann', 'Sindhh', 'Pakistann', 'http://127.0.0.1:8000/admin/profilee', 'http://127.0.0.1:8000/admin/profilee', 'http://127.0.0.1:8000/admin/profilee', 'http://127.0.0.1:8000/admin/profilee'),
(9, 'client001', 'Ubaid Soomro', 'ubaidsoomro505@gmail.com', NULL, NULL, 'Client$321', '031888938633', 'Hyderabad', 1, 0, NULL, '2026-07-17 10:47:30', '2026-07-17 10:47:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '123sdag@', 'Ubaid Soomro Soomro', NULL, NULL, NULL, 'sdasd123$', '03188893863', 'huderabad', 1, 0, NULL, '2026-07-18 12:41:47', '2026-07-18 12:41:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'guest_user', 'Ubaid Soomro', 'ubaidsoomro54@gmail.com', NULL, NULL, 'Guest@2026', '031888938633', 'Hyderabad', 1, 0, NULL, '2026-07-20 02:11:57', '2026-07-20 02:11:57', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'manager01', 'Ubaid Soomro', NULL, NULL, NULL, 'Manager#999', '03188893863', 'huderabad', 1, 0, NULL, '2026-07-20 11:24:31', '2026-07-20 11:24:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_account` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `user_account`, `user_password`, `created_at`, `updated_at`) VALUES
(8, 'sample_acc', 'Sample@111', '2026-07-14 06:30:24', '2026-07-14 06:30:24'),
(9, 'user_demo', 'Demo$555', '2026-07-14 06:30:24', '2026-07-14 06:30:24'),
(10, 'temp_login', 'Temp@888', '2026-07-14 06:30:24', '2026-07-14 06:30:24'),
(12, 'jane_smith', 'securepass456', '2026-07-14 07:50:13', '2026-07-14 07:50:13'),
(13, 'mike_wilson', 'mikepass789', '2026-07-14 07:50:13', '2026-07-14 07:50:13'),
(14, 'sarah_connor', 'sarah1234', '2026-07-14 07:50:13', '2026-07-14 07:50:13'),
(15, 'david_miller', 'davidpass', '2026-07-14 07:50:13', '2026-07-14 07:50:13'),
(16, 'user_402', 'tester001', '2026-07-20 02:09:42', '2026-07-20 02:09:42'),
(17, 'ubasan123', 'ubasan123', '2026-07-20 12:26:47', '2026-07-20 12:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `account_holder_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `iban_number` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `branch_code` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','declined','completed') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `declined_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `payment_method_id`, `user_name`, `full_name`, `email`, `whatsapp_number`, `account_holder_name`, `account_number`, `amount`, `payment_method`, `bank_name`, `iban_number`, `card_number`, `branch_code`, `status`, `admin_notes`, `approved_at`, `declined_at`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'betproadmin', 'Admin Userr', 'admin@betprOo.comm', '031888938644', 'Ubaidullah', '03188893863', 500.00, 'mobile_wallet', NULL, NULL, NULL, NULL, 'approved', NULL, NULL, NULL, NULL, '2026-07-18 11:09:50', '2026-07-18 11:09:50'),
(2, 3, 2, 'betproadmin', 'Admin Userr', 'admin@betprOo.comm', '031888938644', 'Ubaidullah', '03133139448', 1000.00, 'mobile_wallet', NULL, NULL, NULL, NULL, 'approved', NULL, NULL, NULL, NULL, '2026-07-18 11:10:31', '2026-07-18 11:10:31'),
(3, 3, 3, 'betproadmin', 'Admin Userr', 'admin@betprOo.comm', '031888938644', 'Ubaidullah', NULL, 1000.00, 'bank', 'Meezan Bank', '1470147014701470', '0147014701470147000000', NULL, 'approved', NULL, NULL, NULL, NULL, '2026-07-18 11:12:20', '2026-07-18 11:12:20'),
(4, 3, 3, 'betproadmin', 'Admin Userr', 'admin@betprOo.comm', '031888938644', 'Ubaidullah', NULL, 500.00, 'bank', 'Habib Bank Limited (HBL)', '147014701471', '1470147014701470', '35210061', 'approved', NULL, NULL, NULL, NULL, '2026-07-18 11:51:55', '2026-07-18 11:51:55'),
(5, 3, 3, 'betproadmin', 'Admin Userr', 'admin@betprOo.comm', '031888938644', 'Ubaidullah', NULL, 500.00, 'bank', 'Habib Bank Limited (HBL)', '1470155487745', '3652542', NULL, 'approved', NULL, NULL, NULL, NULL, '2026-07-18 12:07:39', '2026-07-18 12:07:39'),
(6, 3, 3, 'betproadmin', 'Admin Userr', 'admin@betprOo.comm', '031888938644', 'Ubaidullah', NULL, 500.00, 'bank', 'Habib Bank Limited (HBL)', '12541', '1254325665899875', NULL, 'approved', NULL, NULL, NULL, NULL, '2026-07-18 12:12:26', '2026-07-18 12:12:26'),
(7, 10, 2, '123sdag@', 'Ubaid Soomro Soomro', NULL, '03188893863', 'Ubaidullah', '03188893863', 500.00, 'mobile_wallet', NULL, NULL, NULL, NULL, 'approved', 'meri merzi', NULL, '2026-07-19 01:06:08', NULL, '2026-07-18 12:44:40', '2026-07-19 01:06:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_pages`
--
ALTER TABLE `about_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deposits_transaction_id_unique` (`transaction_id`),
  ADD KEY `deposits_user_id_foreign` (`user_id`),
  ADD KEY `deposits_payment_method_id_foreign` (`payment_method_id`),
  ADD KEY `deposits_status_index` (`status`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_is_active` (`is_active`),
  ADD KEY `idx_sort_order` (`sort_order`);

--
-- Indexes for table `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plane_buyers`
--
ALTER TABLE `plane_buyers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `plane_id` (`plane_id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
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
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `idx_user_name` (`user_name`),
  ADD KEY `idx_whatsapp` (`whatsapp_number`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrawals_user_id_index` (`user_id`),
  ADD KEY `withdrawals_status_index` (`status`),
  ADD KEY `withdrawals_payment_method_id_index` (`payment_method_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_pages`
--
ALTER TABLE `about_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `planes`
--
ALTER TABLE `planes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plane_buyers`
--
ALTER TABLE `plane_buyers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `deposits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `planes`
--
ALTER TABLE `planes`
  ADD CONSTRAINT `planes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plane_buyers`
--
ALTER TABLE `plane_buyers`
  ADD CONSTRAINT `plane_buyers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plane_buyers_ibfk_2` FOREIGN KEY (`plane_id`) REFERENCES `planes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `withdrawals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
