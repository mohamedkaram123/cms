-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2021 at 06:27 PM
-- Server version: 5.7.36
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mkaramfe_fekra_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_id` int(11) DEFAULT NULL,
  `module` int(11) DEFAULT NULL,
  `cat` int(11) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `operation` int(11) DEFAULT NULL,
  `title_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addons`
--

CREATE TABLE `addons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `unique_identifier` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `activated` int(1) NOT NULL DEFAULT '1',
  `image` varchar(1000) COLLATE utf32_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `set_default` int(1) NOT NULL DEFAULT '0',
  `governorate_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `currency_format` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_plus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `name`, `logo`, `currency_id`, `currency_format`, `facebook`, `twitter`, `instagram`, `youtube`, `google_plus`, `created_at`, `updated_at`) VALUES
(1, 'Active eCommerce', 'uploads/logo/matggar.png', 1, 'symbol', 'https://facebook.com', 'https://twitter.com', 'https://instagram.com', 'https://youtube.com', 'https://google.com', '2019-08-04 16:39:15', '2019-08-04 16:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Size', '2020-02-24 05:55:07', '2020-02-24 05:55:07'),
(2, 'Fabric', '2020-02-24 05:55:13', '2020-02-24 05:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_translations`
--

CREATE TABLE `attribute_translations` (
  `id` bigint(20) NOT NULL,
  `attribute_id` bigint(20) NOT NULL,
  `attribut_key` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '1',
  `published` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `banner` int(11) DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_img` int(11) DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `top` int(1) NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand_translations`
--

CREATE TABLE `brand_translations` (
  `id` bigint(20) NOT NULL,
  `brand_id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_settings`
--

CREATE TABLE `business_settings` (
  `id` int(11) NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `business_settings`
--

INSERT INTO `business_settings` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'home_default_currency', '1', '2018-10-16 01:35:52', '2019-01-28 01:26:53'),
(2, 'system_default_currency', '30', '2018-10-16 01:36:58', '2021-09-26 12:57:12'),
(3, 'currency_format', '1', '2018-10-17 03:01:59', '2018-10-17 03:01:59'),
(4, 'symbol_format', '1', '2018-10-17 03:01:59', '2021-10-03 09:34:45'),
(5, 'no_of_decimals', '2', '2018-10-17 03:01:59', '2021-09-26 13:27:08'),
(6, 'product_activation', '1', '2018-10-28 01:38:37', '2019-02-04 01:11:41'),
(7, 'vendor_system_activation', '1', '2018-10-28 07:44:16', '2019-02-04 01:11:38'),
(8, 'show_vendors', '1', '2018-10-28 07:44:47', '2019-02-04 01:11:13'),
(9, 'paypal_payment', '1', '2018-10-28 07:45:16', '2019-01-31 05:09:10'),
(10, 'stripe_payment', '0', '2018-10-28 07:45:47', '2018-11-14 01:51:51'),
(11, 'cash_payment', '1', '2018-10-28 07:46:05', '2019-01-24 03:40:18'),
(12, 'payumoney_payment', '0', '2018-10-28 07:46:27', '2019-03-05 05:41:36'),
(13, 'best_selling', '1', '2018-12-24 08:13:44', '2019-02-14 05:29:13'),
(14, 'paypal_sandbox', '1', '2019-01-16 12:44:18', '2021-04-27 11:50:35'),
(15, 'sslcommerz_sandbox', '1', '2019-01-16 12:44:18', '2019-03-14 00:07:26'),
(16, 'sslcommerz_payment', '0', '2019-01-24 09:39:07', '2019-01-29 06:13:46'),
(17, 'vendor_commission', '20', '2019-01-31 06:18:04', '2019-04-13 06:49:26'),
(18, 'verification_form', '[{\"type\":\"text\",\"label\":\"Your name\"},{\"type\":\"text\",\"label\":\"Shop name\"},{\"type\":\"text\",\"label\":\"Email\"},{\"type\":\"text\",\"label\":\"License No\"},{\"type\":\"text\",\"label\":\"Full Address\"},{\"type\":\"text\",\"label\":\"Phone Number\"},{\"type\":\"file\",\"label\":\"Tax Papers\"}]', '2019-02-03 11:36:58', '2021-10-03 10:05:52'),
(19, 'google_analytics', '0', '2019-02-06 12:22:35', '2019-02-06 12:22:35'),
(20, 'facebook_login', '0', '2019-02-07 12:51:59', '2019-02-08 19:41:15'),
(21, 'google_login', '0', '2019-02-07 12:52:10', '2019-02-08 19:41:14'),
(22, 'twitter_login', '0', '2019-02-07 12:52:20', '2019-02-08 02:32:56'),
(23, 'payumoney_payment', '1', '2019-03-05 11:38:17', '2019-03-05 11:38:17'),
(24, 'payumoney_sandbox', '1', '2019-03-05 11:38:17', '2019-03-05 05:39:18'),
(36, 'facebook_chat', '0', '2019-04-15 11:45:04', '2019-04-15 11:45:04'),
(37, 'email_verification', '1', '2019-04-30 07:30:07', '2021-04-27 09:41:40'),
(38, 'wallet_system', '1', '2019-05-19 08:05:44', '2021-04-27 09:41:32'),
(39, 'coupon_system', '1', '2019-06-11 09:46:18', '2021-04-27 09:41:36'),
(40, 'current_version', '4.3', '2019-06-11 09:46:18', '2019-06-11 09:46:18'),
(41, 'instamojo_payment', '0', '2019-07-06 09:58:03', '2019-07-06 09:58:03'),
(42, 'instamojo_sandbox', '1', '2019-07-06 09:58:43', '2019-07-06 09:58:43'),
(43, 'razorpay', '0', '2019-07-06 09:58:43', '2019-07-06 09:58:43'),
(44, 'paystack', '0', '2019-07-21 13:00:38', '2019-07-21 13:00:38'),
(45, 'pickup_point', '1', '2019-10-17 11:50:39', '2021-04-27 09:41:35'),
(46, 'maintenance_mode', '0', '2019-10-17 11:51:04', '2019-10-17 11:51:04'),
(47, 'voguepay', '0', '2019-10-17 11:51:24', '2019-10-17 11:51:24'),
(48, 'voguepay_sandbox', '0', '2019-10-17 11:51:38', '2019-10-17 11:51:38'),
(50, 'category_wise_commission', '1', '2020-01-21 07:22:47', '2021-04-27 09:41:39'),
(51, 'conversation_system', '1', '2020-01-21 07:23:21', '2020-01-21 07:23:21'),
(52, 'guest_checkout_active', '1', '2020-01-22 07:36:38', '2020-01-22 07:36:38'),
(53, 'facebook_pixel', '0', '2020-01-22 11:43:58', '2020-01-22 11:43:58'),
(55, 'classified_product', '1', '2020-05-13 13:01:05', '2021-04-27 09:41:34'),
(56, 'pos_activation_for_seller', '1', '2020-06-11 09:45:02', '2020-06-11 09:45:02'),
(57, 'shipping_type', 'product_wise_shipping', '2020-07-01 13:49:56', '2020-07-01 13:49:56'),
(58, 'flat_rate_shipping_cost', '0', '2020-07-01 13:49:56', '2020-07-01 13:49:56'),
(59, 'shipping_cost_admin', '0', '2020-07-01 13:49:56', '2020-07-01 13:49:56'),
(60, 'payhere_sandbox', '0', '2020-07-30 18:23:53', '2020-07-30 18:23:53'),
(61, 'payhere', '0', '2020-07-30 18:23:53', '2020-07-30 18:23:53'),
(62, 'google_recaptcha', '0', '2020-08-17 07:13:37', '2020-08-17 07:13:37'),
(63, 'ngenius', '0', '2020-09-22 10:58:21', '2020-09-22 10:58:21'),
(64, 'header_logo', '137', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(65, 'show_language_switcher', 'on', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(66, 'show_currency_switcher', 'on', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(67, 'header_stikcy', 'on', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(68, 'footer_logo', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(69, 'about_us_description', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(70, 'contact_address', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(71, 'contact_phone', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(72, 'contact_email', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(73, 'widget_one_labels', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(74, 'widget_one_links', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(75, 'widget_one', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(76, 'frontend_copyright_text', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(77, 'show_social_links', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(78, 'facebook_link', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(79, 'twitter_link', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(80, 'instagram_link', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(81, 'youtube_link', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(82, 'linkedin_link', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(83, 'payment_method_images', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(84, 'home_slider_images', '[\"51\",\"113\"]', '2020-11-16 07:26:36', '2021-05-26 08:13:16'),
(85, 'home_slider_links', '[\"http:\\/\\/www.google.com\",\"http:\\/\\/www.google.com\"]', '2020-11-16 07:26:36', '2021-05-26 08:13:16'),
(86, 'home_banner1_images', '[]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(87, 'home_banner1_links', '[]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(88, 'home_banner2_images', '[]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(89, 'home_banner2_links', '[]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(90, 'home_categories', '[]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(91, 'top10_categories', '[]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(92, 'top10_brands', '[]', '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(93, 'website_name', 'المتجر الجامد الازرق', '2020-11-16 07:26:36', '2021-09-26 13:17:26'),
(94, 'site_motto', 'أفضل متجر الكتروني', '2020-11-16 07:26:36', '2021-09-26 13:17:39'),
(95, 'site_icon', '137', '2020-11-16 07:26:36', '2021-11-20 13:08:28'),
(96, 'base_color', '#046ae6', '2020-11-16 07:26:36', '2021-09-26 13:15:27'),
(97, 'base_hov_color', '#e62e04', '2020-11-16 07:26:36', '2021-09-26 13:15:27'),
(98, 'meta_title', 'المتجر الجامد', '2020-11-16 07:26:36', '2021-09-26 13:17:01'),
(99, 'meta_description', 'متجر جامد اخر حاجه شحن مجاني وعروض مدمرة للبورصة العالمية ومفاجئات مستنياك سجل دلوقتي واشتري اونلاين في بيتك او اعرض منتجاتك للعالم', '2020-11-16 07:26:36', '2021-09-26 13:17:01'),
(100, 'meta_keywords', 'اعرض منتجاتك , اشتري , طور , بيع , العالم', '2020-11-16 07:26:36', '2021-09-26 13:17:01'),
(101, 'meta_image', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(102, 'site_name', 'المتجر الجامد جدا', '2020-11-16 07:26:36', '2021-10-02 09:48:04'),
(103, 'system_logo_white', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(104, 'system_logo_black', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(105, 'timezone', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(106, 'admin_login_background', NULL, '2020-11-16 07:26:36', '2020-11-16 07:26:36'),
(107, 'iyzico_sandbox', '1', '2020-12-30 16:45:56', '2020-12-30 16:45:56'),
(108, 'iyzico', '1', '2020-12-30 16:45:56', '2020-12-30 16:45:56'),
(109, 'decimal_separator', '1', '2020-12-30 16:45:56', '2020-12-30 16:45:56'),
(110, 'nagad', '0', '2021-01-22 10:30:03', '2021-01-22 10:30:03'),
(111, 'bkash', '0', '2021-01-22 10:30:03', '2021-01-22 10:30:03'),
(112, 'bkash_sandbox', '1', '2021-01-22 10:30:03', '2021-01-22 10:30:03'),
(113, 'header_menu_labels', '[\"Home\",\"Flash Sale\",\"All Brands\",\"All Categories\"]', '2021-02-16 02:43:11', '2021-10-02 13:56:23'),
(114, 'header_menu_links', '[\"https:\\/\\/mkaram.fekrait.net\\/test\\/\",\"https:\\/\\/mkaram.fekrait.net\\/test\\/FlashSale\",\"https:\\/\\/mkaram.fekrait.net\\/test\\/search\",\"https:\\/\\/mkaram.fekrait.net\\/test\\/categories\"]', '2021-02-16 02:43:11', '2021-11-20 13:07:06'),
(115, 'product_manage_by_admin', '1', '2021-04-27 09:41:38', '2021-04-27 09:41:38'),
(116, 'paytab_sandbox', '1', '2021-05-06 01:25:51', '2021-05-17 08:31:55'),
(119, 'PAYTAB_PROFILE_ID', '67483', '2021-05-06 02:00:34', '2021-05-12 02:48:39'),
(120, 'PAYTAB_SERVER_KEY', 'SZJNRLBJLK-JBMGDML2WT-22MGMBBGTG', '2021-05-06 02:00:44', '2021-05-12 02:48:39'),
(124, 'TapPayment_Secret_Key', 'sk_test_s0r1YFLEWmONM2cDjehSyRuB', '2021-05-06 18:28:54', '2021-05-06 16:31:45'),
(125, 'TapPayment_Publishable_Key', 'pk_test_2cW4BJzdmLKYpQOlwH6CM0nI', '2021-05-06 18:29:07', '2021-05-06 16:31:45'),
(126, 'TapPayment_MERCHANT_KEY', NULL, '2021-05-06 18:29:17', '2021-05-06 18:29:17'),
(127, 'TapPayment_sandbox', '1', '2021-05-06 18:29:29', '2021-05-06 18:29:29'),
(128, '\"[\\\"payment_type\\\":\\\"wallet_pa', '{\"tran_ref\":\"TST2112900166406\",\"merchant_id\":18501,\"profile_id\":67483,\"cart_id\":\"100\",\"cart_description\":\"Dummy Order 35925502061445345\",\"cart_currency\":\"EGP\",\"cart_amount\":\"20.00\",\"tran_currency\":\"EGP\",\"tran_total\":\"20.00\",\"tran_type\":\"Auth\",\"tran_class\":\"ECom\",\"customer_details\":{\"name\":\"mohamed karam\",\"email\":\"customer19@mail.com\",\"street1\":\"16mohamed frag street cairo\",\"city\":\"cairo\",\"state\":\"C\",\"country\":\"EG\",\"zip\":\"002\",\"ip\":\"156.223.254.129\"},\"shipping_details\":{\"name\":\"mohamed karam\",\"email\":\"customer19@mail.com\",\"street1\":\"16mohamed frag street cairo\",\"city\":\"cairo\",\"state\":\"KB\",\"country\":\"EG\",\"zip\":\"002\"},\"payment_result\":{\"response_status\":\"E\",\"response_code\":\"200\",\"response_message\":\"Invalid card number\",\"cvv_result\":null,\"avs_result\":null,\"transaction_time\":\"2021-05-09T23:02:44Z\"},\"payment_info\":{\"payment_method\":\"MasterCard\",\"card_type\":\"Credit\",\"card_scheme\":\"MasterCard\",\"payment_description\":\"5123 45## #### 0008\",\"expiryMonth\":7,\"expiryYear\":2021,\"IssuerCountry\":\"BJ\",\"IssuerName\":\"Afriland First Bank\"}}', '2021-05-09 21:07:18', '2021-05-09 21:07:18'),
(129, '\"[\\\"payment_type\\\":\\\"wallet_pa', '{\"tran_ref\":\"TST2112900166408\",\"merchant_id\":18501,\"profile_id\":67483,\"cart_id\":\"100\",\"cart_description\":\"Dummy Order 35925502061445345\",\"cart_currency\":\"EGP\",\"cart_amount\":\"21.00\",\"tran_currency\":\"EGP\",\"tran_total\":\"21.00\",\"tran_type\":\"Auth\",\"tran_class\":\"ECom\",\"customer_details\":{\"name\":\"mohamed karam\",\"email\":\"customer19@mail.com\",\"street1\":\"16mohamed frag street cairo\",\"city\":\"cairo\",\"state\":\"C\",\"country\":\"EG\",\"zip\":\"002\",\"ip\":\"156.223.254.129\"},\"shipping_details\":{\"name\":\"mohamed karam\",\"email\":\"customer19@mail.com\",\"street1\":\"16mohamed frag street cairo\",\"city\":\"cairo\",\"state\":\"JS\",\"country\":\"EG\",\"zip\":\"002\"},\"payment_result\":{\"response_status\":\"E\",\"response_code\":\"200\",\"response_message\":\"Invalid card number\",\"cvv_result\":null,\"avs_result\":null,\"transaction_time\":\"2021-05-09T23:07:36Z\"},\"payment_info\":{\"payment_method\":\"MasterCard\",\"card_type\":\"Credit\",\"card_scheme\":\"MasterCard\",\"payment_description\":\"5123 45## #### 0008\",\"expiryMonth\":7,\"expiryYear\":2021,\"IssuerCountry\":\"BJ\",\"IssuerName\":\"Afriland First Bank\"}}', '2021-05-09 21:07:37', '2021-05-09 21:07:37'),
(130, '[\"payment_type\":\"wallet_paymen', '{\"tran_ref\":\"TST2112900166411\",\"merchant_id\":18501,\"profile_id\":67483,\"cart_id\":\"100\",\"cart_description\":\"Dummy Order 35925502061445345\",\"cart_currency\":\"EGP\",\"cart_amount\":\"12.00\",\"tran_currency\":\"EGP\",\"tran_total\":\"12.00\",\"tran_type\":\"Auth\",\"tran_class\":\"ECom\",\"customer_details\":{\"name\":\"mohamed karam\",\"email\":\"customer19@mail.com\",\"street1\":\"16mohamed frag street cairo\",\"city\":\"cairo\",\"state\":\"C\",\"country\":\"EG\",\"zip\":\"002\",\"ip\":\"156.223.254.129\"},\"shipping_details\":{\"name\":\"mohamed karam\",\"email\":\"customer19@mail.com\",\"street1\":\"16mohamed frag street cairo\",\"city\":\"cairo\",\"state\":\"KFS\",\"country\":\"EG\",\"zip\":\"002\"},\"payment_result\":{\"response_status\":\"E\",\"response_code\":\"200\",\"response_message\":\"Invalid card number\",\"cvv_result\":null,\"avs_result\":null,\"transaction_time\":\"2021-05-09T23:15:17Z\"},\"payment_info\":{\"payment_method\":\"MasterCard\",\"card_type\":\"Credit\",\"card_scheme\":\"MasterCard\",\"payment_description\":\"5123 45## #### 0008\",\"expiryMonth\":7,\"expiryYear\":2021,\"IssuerCountry\":\"BJ\",\"IssuerName\":\"Afriland First Bank\"}}', '2021-05-09 21:15:18', '2021-05-09 21:15:18'),
(131, '[\"payment_type\":\"wallet_paymen', '{\"tran_ref\":\"TST2112900166410\",\"merchant_id\":18501,\"profile_id\":67483,\"cart_id\":\"100\",\"cart_description\":\"Dummy Order 35925502061445345\",\"cart_currency\":\"EGP\",\"cart_amount\":\"200.00\",\"tran_currency\":\"EGP\",\"tran_total\":\"200.00\",\"tran_type\":\"Auth\",\"tran_class\":\"ECom\",\"customer_details\":{\"name\":\"mohamed karam\",\"email\":\"customer19@mail.com\",\"street1\":\"16mohamed frag street cairo\",\"city\":\"cairo\",\"state\":\"C\",\"country\":\"EG\",\"zip\":\"002\",\"ip\":\"156.223.254.129\"},\"shipping_details\":{\"name\":\"mohamed karam\",\"email\":\"customer19@mail.com\",\"street1\":\"16mohamed frag street cairo\",\"city\":\"cairo\",\"state\":\"GZ\",\"country\":\"EG\",\"zip\":\"002\"},\"payment_result\":{\"response_status\":\"E\",\"response_code\":\"200\",\"response_message\":\"Invalid card number\",\"cvv_result\":null,\"avs_result\":null,\"transaction_time\":\"2021-05-09T23:13:08Z\"},\"payment_info\":{\"payment_method\":\"MasterCard\",\"card_type\":\"Credit\",\"card_scheme\":\"MasterCard\",\"payment_description\":\"5123 45## #### 0008\",\"expiryMonth\":7,\"expiryYear\":2021,\"IssuerCountry\":\"BJ\",\"IssuerName\":\"Afriland First Bank\"}}', '2021-05-09 21:15:44', '2021-05-09 21:15:44'),
(132, '98', '{\"tran_ref\":\"TST2112900166412\",\"merchant_id\":18501,\"profile_id\":67483,\"cart_id\":\"100\",\"cart_description\":\"Dummy Order 35925502061445345\",\"cart_currency\":\"EGP\",\"cart_amount\":\"12.00\",\"tran_currency\":\"EGP\",\"tran_total\":\"12.00\",\"tran_type\":\"Auth\",\"tran_class\":\"ECom\",\"customer_details\":{\"name\":\"mohamed karam\",\"email\":\"customer19@mail.com\",\"street1\":\"16mohamed frag street cairo\",\"city\":\"cairo\",\"state\":\"C\",\"country\":\"EG\",\"zip\":\"002\",\"ip\":\"156.223.254.129\"},\"shipping_details\":{\"name\":\"mohamed karam\",\"email\":\"customer19@mail.com\",\"street1\":\"16mohamed frag street cairo\",\"city\":\"cairo\",\"state\":\"IS\",\"country\":\"EG\",\"zip\":\"002\"},\"payment_result\":{\"response_status\":\"E\",\"response_code\":\"200\",\"response_message\":\"Invalid card number\",\"cvv_result\":null,\"avs_result\":null,\"transaction_time\":\"2021-05-09T23:19:41Z\"},\"payment_info\":{\"payment_method\":\"MasterCard\",\"card_type\":\"Credit\",\"card_scheme\":\"MasterCard\",\"payment_description\":\"5123 45## #### 0008\",\"expiryMonth\":7,\"expiryYear\":2021,\"IssuerCountry\":\"BJ\",\"IssuerName\":\"Afriland First Bank\"}}', '2021-05-09 21:19:43', '2021-05-09 21:19:43'),
(133, '{\"id\":\"auth_TS061120210422Op33', '98', '2021-05-09 23:13:35', '2021-05-09 23:13:35'),
(134, '{\"id\":\"auth_TS012820210425u2K1', '98', '2021-05-09 23:16:53', '2021-05-09 23:16:53'),
(135, 'fawry_merchant_code', '1tSa6uxz2nSDBAu4fGpqXw==', '2021-05-11 02:15:59', '2021-05-15 04:02:39'),
(136, 'fawry_security_key', 'd876355df7d24c4da1a09c03f63ec0bc', '2021-05-11 02:16:32', '2021-05-11 02:16:32'),
(137, 'fawry_live', '0', '2021-05-11 02:21:46', '2021-08-02 10:21:37'),
(138, 'PAYTAB_PROFILE_ID_saudi', '67488', '2021-05-12 04:58:42', '2021-10-03 11:08:17'),
(139, 'PAYTAB_SERVER_KEY_saudi', 'SDJNRLBMKL-JBMGHZNHDZ-KZGWBZHTGN', '2021-05-12 04:59:01', '2021-05-12 03:05:52'),
(140, 'paytab_sandbox_saudi', '1', '2021-05-12 04:59:13', '2021-10-03 11:02:54'),
(141, 'fawry_sandbox', '1', '2021-05-15 05:21:17', '2021-05-15 04:32:32'),
(142, 'PUSHER_APP_ID', '1209058', '2021-05-25 04:45:35', '2021-05-25 04:45:35'),
(143, 'PUSHER_APP_KEY', '4cb26936b0c150a50114', '2021-05-25 04:45:35', '2021-05-25 04:45:35'),
(144, 'PUSHER_APP_SECRET', '6d6e84b9e14cd3726576', '2021-05-25 04:46:00', '2021-05-25 04:46:00'),
(145, 'PUSHER_APP_CLUSTER', 'mt1', '2021-05-25 04:46:00', '2021-05-25 04:46:00'),
(148, 'API KEY FIREBASE', 'AIzaSyAGr-cMpw_CPFYQyK3DM33Uviy03peqKW8', '2021-06-25 00:39:41', '2021-09-12 10:23:46'),
(149, 'AUTH DOMAIN FIREBASE', 'loginotp-30c7e.firebaseapp.com', '2021-06-25 00:39:41', '2021-09-12 10:23:46'),
(150, 'PROJECT ID FIREBASE', 'loginotp-30c7e', '2021-06-25 00:40:51', '2021-09-12 10:23:46'),
(151, 'STORAGE BUCKET FIREBASE', 'loginotp-30c7e.appspot.com', '2021-06-25 00:40:51', '2021-09-12 10:23:46'),
(152, 'MESSAGING SENDER ID FIREBASE', '114147845669', '2021-06-25 00:41:55', '2021-09-12 10:23:46'),
(153, 'APP ID FIREBASE', '1:114147845669:web:5ede7ce51313344798c1cc', '2021-06-25 00:41:55', '2021-09-12 10:23:46'),
(154, 'MEASUREMENT ID FIREBASE', 'G-2YTC08Y2CP', '2021-06-25 00:42:33', '2021-09-12 10:23:46'),
(155, 'smtp_host', 'smtp.googlemail.com', '2021-06-28 01:50:04', '2021-10-06 08:56:22'),
(156, 'smtp_port', '465', '2021-06-28 01:50:04', '2021-06-28 19:58:43'),
(157, 'smtp_username', 'momokaram223@gmail.com', '2021-06-28 01:50:04', '2021-10-06 08:56:22'),
(158, 'smtp_password', 'krttcvdpkjlkrhjr', '2021-06-28 01:50:04', '2021-10-06 08:56:22'),
(159, 'smtp_encryption', 'ssl', '2021-06-28 01:50:04', '2021-06-28 19:58:43'),
(160, 'smtp_from_address', 'momokaram223@gmail.com', '2021-06-28 01:50:04', '2021-10-06 08:56:22'),
(161, 'smtp_from_name', 'cms fekra', '2021-06-28 01:50:04', '2021-06-28 19:58:43'),
(162, 'mailchimp_host', 'smtp.mandrillapp.com', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(163, 'mailchimp_port', '465', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(164, 'mailchimp_username', 'fekra_cms', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(165, 'mailchimp_password', '65KTnJbQFN5b5Chbl0gYDw', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(166, 'mailchimp_encryption', 'ssl', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(167, 'mailchimp_from_address', 'mniazy@mandobee.com', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(168, 'mailchimp_from_name', 'cms fekra', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(169, 'mailgun_host', 'smtp.mailgun.org', '2021-06-28 01:50:04', '2021-06-28 19:58:43'),
(170, 'mailgun_port', '465', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(171, 'mailgun_username', 'postmaster@mail1.mandobee.com', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(172, 'mailgun_password', 'bf67cb8d184a5cd8cce2c486eeaf6a35-aff8aa95-299e5885', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(173, 'mailgun_encryption', 'ssl', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(174, 'mailgun_from_address', 'momokaram223@gmail.com', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(175, 'mailgun_from_name', 'cms fekra', '2021-06-28 01:50:04', '2021-06-28 19:58:44'),
(218, 'smtp_value', '0', '2021-06-28 02:37:27', '2021-06-28 01:02:41'),
(219, 'mailchimp_value', '0', '2021-06-28 02:37:27', '2021-06-28 02:03:28'),
(220, 'mailgun_value', '0', '2021-06-28 02:37:27', '2021-06-28 01:59:46'),
(221, 'PROVIDE_FEKRA_SMS_USERNAME', 'testdemo', '2021-06-30 01:36:39', '2021-06-30 01:36:39'),
(222, 'PROVIDE_FEKRA_SMS_PASSWORD', 'F102030ekra', '2021-06-30 01:36:39', '2021-06-30 01:36:39'),
(223, 'PROVIDE_FEKRA_SMS_SENDER_NAME', 'FSMS-AD', '2021-06-30 01:36:39', '2021-07-06 19:16:28'),
(224, 'header_script', '<style>\r\n\r\nbody {\r\n    font-size: 12px;\r\n    font-family: \'Cairo\';\r\n    color: #000;\r\n}\r\n\r\n</style>', '2021-08-04 11:47:06', '2021-10-06 10:55:14'),
(225, 'footer_script', '<link href=\'https://fonts.googleapis.com/css?family=Cairo\' rel=\'stylesheet\'>', '2021-08-04 11:47:06', '2021-10-06 10:55:14'),
(226, 'header_script_admin', '<link href=\'https://fonts.googleapis.com/css?family=Cairo\' rel=\'stylesheet\'>\r\n<style>\r\n\r\nbody {\r\n    font-size: 12px;\r\n    font-family: \'Cairo\';\r\n    color: #000;\r\n}\r\n\r\n.aiz-side-nav-list .aiz-side-nav-icon {color: #5dd5c4;}\r\n.aiz-sidebar.left {    background-color: #16263f;}\r\n\r\n.aiz-main-wrapper {\r\n    min-height: 100vh;\r\n    max-width: 100vw;\r\n    background-color: #f8f8f8;\r\n}\r\n\r\n\r\n\r\n.aiz-side-nav-list .aiz-side-nav-link {\r\n\r\n    color: #fff;\r\n    font-family: cairo;\r\n}\r\n\r\n.form-control {\r\n \r\n    color: #000;\r\n}\r\n\r\n.opacity-50 {\r\n    opacity: 1 !important;\r\n}\r\n\r\n.fs-12 {\r\n    font-size: 1.1rem !important;\r\n}\r\n\r\n.table .thead-light th {\r\n    color: #fff;\r\n    background-color: #0db099;\r\n    border-color: #5dd5c4;\r\n}\r\n\r\n.table .thead-light th {\r\n    color: #fff;\r\n    font-size: 15px;\r\n}\r\n\r\n.table td, .table th {\r\n    padding: .75rem;\r\n    vertical-align: top;\r\n    border-top: 1px solid #dee2e6;\r\n    border: 1px solid #dedede;\r\n}\r\n\r\n.table thead th {\r\n    vertical-align: bottom;\r\n    border-bottom: 2px solid #5dd5c4;\r\n    background-color: #0db099;\r\n    color: #fff;\r\n    font-size: 14px;\r\n}\r\n</style>', '2021-08-04 15:22:05', '2021-10-06 10:58:02'),
(227, 'footer_script_admin', NULL, '2021-08-04 15:22:05', '2021-10-06 10:58:02'),
(228, 'style_price_del', 'font-size:12px;\r\ndisplay:inline-block;', '2021-10-01 14:31:47', '2021-10-14 10:26:32'),
(229, 'style_price', 'font-size:12px;\r\ndisplay:inline-block;', '2021-10-01 14:31:47', '2021-10-14 10:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) UNSIGNED NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) DEFAULT NULL,
  `variation` text COLLATE utf8_unicode_ci,
  `price` double(8,2) DEFAULT '0.00',
  `tax` double(8,2) DEFAULT '0.00',
  `shipping_cost` double(8,2) DEFAULT '0.00',
  `shipping_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` double(10,2) NOT NULL DEFAULT '0.00',
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coupon_applied` tinyint(4) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `shipping` text COLLATE utf8_unicode_ci,
  `order_admin` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_files`
--

CREATE TABLE `cart_files` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_level` int(11) NOT NULL DEFAULT '0',
  `commision_rate` double(8,2) NOT NULL DEFAULT '0.00',
  `banner` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featured` int(1) NOT NULL DEFAULT '0',
  `top` int(1) NOT NULL DEFAULT '0',
  `digital` int(1) NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_translations`
--

CREATE TABLE `category_translations` (
  `id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'en',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `governorate_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` double(20,2) NOT NULL DEFAULT '0.00',
  `pool_area` tinyint(4) NOT NULL DEFAULT '0',
  `shipping_days` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city_translations`
--

CREATE TABLE `city_translations` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commission_histories`
--

CREATE TABLE `commission_histories` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_detail_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `admin_commission` double(25,2) NOT NULL,
  `seller_earning` double(25,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `title` varchar(1000) COLLATE utf32_unicode_ci DEFAULT NULL,
  `sender_viewed` int(1) NOT NULL DEFAULT '1',
  `receiver_viewed` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL,
  `first_num` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `tel`, `status`, `order`, `first_num`, `created_at`, `updated_at`) VALUES
(1, 'AL', 'Albania', '355', 1, 0, NULL, '2021-01-31 03:33:13', '2021-01-31 03:33:13'),
(2, 'DZ', 'Algeria', '213', 1, 0, NULL, '2021-01-31 03:33:14', '2021-01-31 03:33:14'),
(3, 'AD', 'Andorra', '376', 1, 0, NULL, '2021-01-31 03:33:14', '2021-01-31 03:33:14'),
(4, 'AO', 'Angola', '244', 1, 0, NULL, '2021-01-31 03:33:14', '2021-01-31 03:33:14'),
(5, 'AR', 'Argentina', '54', 1, 0, NULL, '2021-01-31 03:33:15', '2021-01-31 03:33:15'),
(6, 'AM', 'Armenia', '374', 1, 0, NULL, '2021-01-31 03:33:15', '2021-01-31 03:33:15'),
(7, 'AW', 'Aruba', '297', 1, 0, NULL, '2021-01-31 03:33:15', '2021-01-31 03:33:15'),
(8, 'AU', 'Australia', '61', 1, 0, NULL, '2021-01-31 03:33:15', '2021-01-31 03:33:15'),
(9, 'AT', 'Austria', '43', 1, 0, NULL, '2021-01-31 03:33:15', '2021-01-31 03:33:15'),
(10, 'AZ', 'Azerbaijan', '994', 1, 0, NULL, '2021-01-31 03:33:15', '2021-01-31 03:33:15'),
(11, 'BH', 'Bahrain', '973', 1, 0, NULL, '2021-01-31 03:33:15', '2021-01-31 03:33:15'),
(12, 'BD', 'Bangladesh', '880', 1, 0, NULL, '2021-01-31 03:33:16', '2021-01-31 03:33:16'),
(13, 'BY', 'Belarus', '375', 1, 0, NULL, '2021-01-31 03:33:16', '2021-01-31 03:33:16'),
(14, 'BE', 'Belgium', '32', 1, 0, NULL, '2021-01-31 03:33:16', '2021-01-31 03:33:16'),
(15, 'BZ', 'Belize', '501', 1, 0, NULL, '2021-01-31 03:33:16', '2021-01-31 03:33:16'),
(16, 'BJ', 'Benin', '229', 1, 0, NULL, '2021-01-31 03:33:16', '2021-01-31 03:33:16'),
(17, 'BT', 'Bhutan', '975', 1, 0, NULL, '2021-01-31 03:33:16', '2021-01-31 03:33:16'),
(18, 'BO', 'Bolivia', '591', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(19, 'BA', 'Bosnia and Herzegovina', '387', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(20, 'BW', 'Botswana', '267', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(21, 'BR', 'Brazil', '55', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(22, 'IO', 'British Indian Ocean Territory', '246', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(23, 'BN', 'Brunei Darussalam', '673', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(24, 'BG', 'Bulgaria', '359', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(25, 'BF', 'Burkina Faso', '226', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(26, 'BI', 'Burundi', '257', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(27, 'KH', 'Cambodia', '855', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(28, 'CM', 'Cameroon', '237', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(29, 'CA', 'Canada', '1', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(30, 'CV', 'Cape Verde', '238', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(31, 'CF', 'Central African Republic', '236', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(32, 'TD', 'Chad', '235', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(33, 'CL', 'Chile', '56', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(34, 'CN', 'China', '86', 1, 0, NULL, '2021-01-31 03:33:17', '2021-01-31 03:33:17'),
(35, 'HK', 'Hong Kong', '852', 1, 0, NULL, '2021-01-31 03:33:18', '2021-01-31 03:33:18'),
(36, 'MO', 'Macao', '853', 1, 0, NULL, '2021-01-31 03:33:18', '2021-01-31 03:33:18'),
(37, 'CX', 'Christmas Island', '61', 1, 0, NULL, '2021-01-31 03:33:18', '2021-01-31 03:33:18'),
(38, 'CC', 'Cocos (Keeling) Islands', '61', 1, 0, NULL, '2021-01-31 03:33:18', '2021-01-31 03:33:18'),
(39, 'CO', 'Colombia', '57', 1, 0, NULL, '2021-01-31 03:33:18', '2021-01-31 03:33:18'),
(40, 'KM', 'Comoros', '269', 1, 0, NULL, '2021-01-31 03:33:18', '2021-01-31 03:33:18'),
(41, 'CK', 'Cook Islands', '682', 1, 0, NULL, '2021-01-31 03:33:18', '2021-01-31 03:33:18'),
(42, 'CR', 'Costa Rica', '506', 1, 0, NULL, '2021-01-31 03:33:18', '2021-01-31 03:33:18'),
(43, 'HR', 'Croatia', '385', 1, 0, NULL, '2021-01-31 03:33:18', '2021-01-31 03:33:18'),
(44, 'CU', 'Cuba', '53', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(45, 'CY', 'Cyprus', '357', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(46, 'CZ', 'Czech Republic', '420', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(47, 'DK', 'Denmark', '45', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(48, 'DJ', 'Djibouti', '253', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(49, 'EC', 'Ecuador', '593', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(50, 'EG', 'Egypt', '20', 1, 2, 1, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(51, 'SV', 'El Salvador', '503', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(52, 'GQ', 'Equatorial Guinea', '240', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(53, 'ER', 'Eritrea', '291', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(54, 'EE', 'Estonia', '372', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(55, 'ET', 'Ethiopia', '251', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(56, 'FO', 'Faroe Islands', '298', 1, 0, NULL, '2021-01-31 03:33:19', '2021-01-31 03:33:19'),
(57, 'FJ', 'Fiji', '679', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(58, 'FI', 'Finland', '358', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(59, 'FR', 'France', '33', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(60, 'GF', 'French Guiana', '689', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(61, 'GA', 'Gabon', '241', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(62, 'GM', 'Gambia', '220', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(63, 'GE', 'Georgia', '995', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(64, 'DE', 'Germany', '49', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(65, 'GH', 'Ghana', '233', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(66, 'GI', 'Gibraltar', '350', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(67, 'GR', 'Greece', '30', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(68, 'GL', 'Greenland', '299', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(69, 'GT', 'Guatemala', '502', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(70, 'GN', 'Guinea', '224', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(71, 'GY', 'Guyana', '592', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(72, 'HT', 'Haiti', '509', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(73, 'HN', 'Honduras', '504', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(74, 'HU', 'Hungary', '36', 1, 0, NULL, '2021-01-31 03:33:20', '2021-01-31 03:33:20'),
(75, 'IS', 'Iceland', '354', 1, 0, NULL, '2021-01-31 03:33:21', '2021-01-31 03:33:21'),
(76, 'IN', 'India', '91', 1, 0, NULL, '2021-01-31 03:33:21', '2021-01-31 03:33:21'),
(77, 'ID', 'Indonesia', '62', 1, 0, NULL, '2021-01-31 03:33:21', '2021-01-31 03:33:21'),
(78, 'IR', 'Iran, Islamic Republic of', '98', 1, 0, NULL, '2021-01-31 03:33:21', '2021-01-31 03:33:21'),
(79, 'IQ', 'Iraq', '964', 1, 0, NULL, '2021-01-31 03:33:21', '2021-01-31 03:33:21'),
(80, 'IE', 'Ireland', '353', 1, 0, NULL, '2021-01-31 03:33:21', '2021-01-31 03:33:21'),
(81, 'IL', 'Israel', '972', 1, 0, NULL, '2021-01-31 03:33:21', '2021-01-31 03:33:21'),
(82, 'IT', 'Italy', '39', 1, 0, NULL, '2021-01-31 03:33:21', '2021-01-31 03:33:21'),
(83, 'JP', 'Japan', '81', 1, 0, NULL, '2021-01-31 03:33:21', '2021-01-31 03:33:21'),
(84, 'JO', 'Jordan', '962', 1, 0, NULL, '2021-01-31 03:33:21', '2021-01-31 03:33:21'),
(85, 'KZ', 'Kazakhstan', '7', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(86, 'KE', 'Kenya', '254', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(87, 'KI', 'Kiribati', '686', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(88, 'KW', 'Kuwait', '965', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(89, 'KG', 'Kyrgyzstan', '996', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(90, 'LV', 'Latvia', '371', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(91, 'LB', 'Lebanon', '961', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(92, 'LS', 'Lesotho', '266', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(93, 'LR', 'Liberia', '231', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(94, 'LY', 'Libya', '218', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(95, 'LI', 'Liechtenstein', '423', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(96, 'LT', 'Lithuania', '370', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(97, 'LU', 'Luxembourg', '352', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(98, 'MK', 'Macedonia', '389', 1, 0, NULL, '2021-01-31 03:33:22', '2021-01-31 03:33:22'),
(99, 'MG', 'Madagascar', '261', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(100, 'MW', 'Malawi', '265', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(101, 'MY', 'Malaysia', '60', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(102, 'MV', 'Maldives', '960', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(103, 'ML', 'Mali', '223', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(104, 'MT', 'Malta', '356', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(105, 'MH', 'Marshall Islands', '692', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(106, 'MR', 'Mauritania', '222', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(107, 'MU', 'Mauritius', '230', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(108, 'YT', 'Mayotte', '262', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(109, 'MX', 'Mexico', '52', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(110, 'FM', 'Micronesia', '691', 1, 0, NULL, '2021-01-31 03:33:23', '2021-01-31 03:33:23'),
(111, 'MD', 'Moldova', '373', 1, 0, NULL, '2021-01-31 03:33:24', '2021-01-31 03:33:24'),
(112, 'MC', 'Monaco', '377', 1, 0, NULL, '2021-01-31 03:33:24', '2021-01-31 03:33:24'),
(113, 'MN', 'Mongolia', '976', 1, 0, NULL, '2021-01-31 03:33:24', '2021-01-31 03:33:24'),
(114, 'ME', 'Montenegro', '382', 1, 0, NULL, '2021-01-31 03:33:24', '2021-01-31 03:33:24'),
(115, 'MA', 'Morocco', '212', 1, 0, NULL, '2021-01-31 03:33:25', '2021-01-31 03:33:25'),
(116, 'MZ', 'Mozambique', '258', 1, 0, NULL, '2021-01-31 03:33:25', '2021-01-31 03:33:25'),
(117, 'MM', 'Myanmar', '95', 1, 0, NULL, '2021-01-31 03:33:25', '2021-01-31 03:33:25'),
(118, 'NA', 'Namibia', '264', 1, 0, NULL, '2021-01-31 03:33:25', '2021-01-31 03:33:25'),
(119, 'NR', 'Nauru', '674', 1, 0, NULL, '2021-01-31 03:33:25', '2021-01-31 03:33:25'),
(120, 'NP', 'Nepal', '977', 1, 0, NULL, '2021-01-31 03:33:25', '2021-01-31 03:33:25'),
(121, 'NL', 'Netherlands', '31', 1, 0, NULL, '2021-01-31 03:33:25', '2021-01-31 03:33:25'),
(122, 'NC', 'New Caledonia', '687', 1, 0, NULL, '2021-01-31 03:33:25', '2021-01-31 03:33:25'),
(123, 'NZ', 'New Zealand', '64', 1, 0, NULL, '2021-01-31 03:33:25', '2021-01-31 03:33:25'),
(124, 'NI', 'Nicaragua', '505', 1, 0, NULL, '2021-01-31 03:33:25', '2021-01-31 03:33:25'),
(125, 'NE', 'Niger', '227', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(126, 'NG', 'Nigeria', '234', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(127, 'NU', 'Niue', '683', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(128, 'NO', 'Norway', '47', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(129, 'OM', 'Oman', '968', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(130, 'PK', 'Pakistan', '92', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(131, 'PW', 'Palau', '680', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(132, 'PS', 'Palestinian', '972', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(133, 'PA', 'Panama', '507', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(134, 'PY', 'Paraguay', '595', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(135, 'PE', 'Peru', '51', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(136, 'PH', 'Philippines', '63', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(137, 'PN', 'Pitcairn', '870', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(138, 'PL', 'Poland', '48', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(139, 'PT', 'Portugal', '351', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(140, 'QA', 'Qatar', '974', 1, 0, NULL, '2021-01-31 03:33:26', '2021-01-31 03:33:26'),
(141, 'RO', 'Romania', '40', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(142, 'RU', 'Russian Federation', '7', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(143, 'RW', 'Rwanda', '250', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(144, 'SH', 'Saint Helena', '290', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(145, 'PM', 'Saint Pierre and Miquelon', '508', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(146, 'WS', 'Samoa', '685', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(147, 'SM', 'San Marino', '378', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(148, 'ST', 'Sao Tome and Principe', '239', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(149, 'SA', 'Saudi Arabia', '966', 1, 1, 5, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(150, 'SN', 'Senegal', '221', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(151, 'RS', 'Serbia', '381', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(152, 'SC', 'Seychelles', '248', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(153, 'SL', 'Sierra Leone', '232', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(154, 'SG', 'Singapore', '65', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(155, 'SK', 'Slovakia', '421', 1, 0, NULL, '2021-01-31 03:33:27', '2021-01-31 03:33:27'),
(156, 'SI', 'Slovenia', '386', 1, 0, NULL, '2021-01-31 03:33:28', '2021-01-31 03:33:28'),
(157, 'SB', 'Solomon Islands', '677', 1, 0, NULL, '2021-01-31 03:33:28', '2021-01-31 03:33:28'),
(158, 'SO', 'Somalia', '252', 1, 0, NULL, '2021-01-31 03:33:28', '2021-01-31 03:33:28'),
(159, 'ZA', 'South Africa', '27', 1, 0, NULL, '2021-01-31 03:33:28', '2021-01-31 03:33:28'),
(160, 'ES', 'Spain', '34', 1, 0, NULL, '2021-01-31 03:33:28', '2021-01-31 03:33:28'),
(161, 'LK', 'Sri Lanka', '94', 1, 0, NULL, '2021-01-31 03:33:28', '2021-01-31 03:33:28'),
(162, 'SD', 'Sudan', '249', 1, 0, NULL, '2021-01-31 03:33:28', '2021-01-31 03:33:28'),
(163, 'SR', 'Suriname', '597', 1, 0, NULL, '2021-01-31 03:33:28', '2021-01-31 03:33:28'),
(164, 'SJ', 'Svalbard and Jan Mayen Islands', '47', 1, 0, NULL, '2021-01-31 03:33:28', '2021-01-31 03:33:28'),
(165, 'SZ', 'Swaziland', '268', 1, 0, NULL, '2021-01-31 03:33:28', '2021-01-31 03:33:28'),
(166, 'SE', 'Sweden', '46', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(167, 'CH', 'Switzerland', '41', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(168, 'SY', 'Syrian Arab Republic', '963', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(169, 'TW', 'Taiwan, Republic of China', '886', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(170, 'TJ', 'Tajikistan', '992', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(171, 'TZ', 'Tanzania', '255', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(172, 'TH', 'Thailand', '66', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(173, 'TG', 'Togo', '228', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(174, 'TK', 'Tokelau', '690', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(175, 'TO', 'Tonga', '676', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(176, 'TN', 'Tunisia', '216', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(177, 'TR', 'Turkey', '90', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(178, 'TM', 'Turkmenistan', '993', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(179, 'TV', 'Tuvalu', '688', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(180, 'UG', 'Uganda', '256', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(181, 'UA', 'Ukraine', '380', 1, 0, NULL, '2021-01-31 03:33:29', '2021-01-31 03:33:29'),
(182, 'AE', 'United Arab Emirates', '971', 1, 0, NULL, '2021-01-31 03:33:30', '2021-01-31 03:33:30'),
(183, 'GB', 'United Kingdom', '44', 1, 0, NULL, '2021-01-31 03:33:30', '2021-01-31 03:33:30'),
(184, 'US', 'United States of America', '1', 1, 0, NULL, '2021-01-31 03:33:30', '2021-01-31 03:33:30'),
(185, 'UY', 'Uruguay', '598', 1, 0, NULL, '2021-01-31 03:33:30', '2021-01-31 03:33:30'),
(186, 'UZ', 'Uzbekistan', '998', 1, 0, NULL, '2021-01-31 03:33:30', '2021-01-31 03:33:30'),
(187, 'VU', 'Vanuatu', '678', 1, 0, NULL, '2021-01-31 03:33:30', '2021-01-31 03:33:30'),
(188, 'VE', 'Venezuela', '58', 1, 0, NULL, '2021-01-31 03:33:30', '2021-01-31 03:33:30'),
(189, 'VN', 'Viet Nam', '84', 1, 0, NULL, '2021-01-31 03:33:31', '2021-01-31 03:33:31'),
(190, 'WF', 'Wallis and Futuna Islands', '681', 1, 0, NULL, '2021-01-31 03:33:31', '2021-01-31 03:33:31'),
(191, 'YE', 'Yemen', '967', 1, 0, NULL, '2021-01-31 03:33:31', '2021-01-31 03:33:31'),
(192, 'ZM', 'Zambia', '260', 1, 0, NULL, '2021-01-31 03:33:31', '2021-01-31 03:33:31'),
(193, 'ZW', 'Zimbabwe', '263', 1, 0, NULL, '2021-01-31 03:33:31', '2021-01-31 03:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `discount` double(20,2) NOT NULL,
  `discount_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` int(15) NOT NULL,
  `end_date` int(15) NOT NULL,
  `total_usage_for_one_user` int(11) DEFAULT '1',
  `total_usage_for_all` int(11) DEFAULT '1',
  `free_shipping` tinyint(4) DEFAULT '1',
  `minimum_amount_of_purchases` double(20,2) DEFAULT '1000000000.00',
  `special_offers` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usages`
--

CREATE TABLE `coupon_usages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exchange_rate` double(10,5) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `exchange_rate`, `status`, `code`, `created_at`, `updated_at`) VALUES
(1, 'U.S. Dollar', '$', 1.00000, 1, 'USD', '2018-10-09 11:35:08', '2018-10-17 05:50:52'),
(2, 'Australian Dollar', '$', 1.28000, 1, 'AUD', '2018-10-09 11:35:08', '2019-02-04 05:51:55'),
(5, 'Brazilian Real', 'R$', 3.25000, 0, 'BRL', '2018-10-09 11:35:08', '2021-09-09 06:25:31'),
(6, 'Canadian Dollar', '$', 1.27000, 1, 'CAD', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(7, 'Czech Koruna', 'Kč', 20.65000, 1, 'CZK', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(8, 'Danish Krone', 'kr', 6.05000, 1, 'DKK', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(9, 'Euro', '€', 0.85000, 1, 'EUR', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(10, 'Hong Kong Dollar', '$', 7.83000, 1, 'HKD', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(11, 'Hungarian Forint', 'Ft', 255.24000, 1, 'HUF', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(12, 'Israeli New Sheqel', '₪', 3.48000, 1, 'ILS', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(13, 'Japanese Yen', '¥', 107.12000, 1, 'JPY', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(14, 'Malaysian Ringgit', 'RM', 3.91000, 1, 'MYR', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(15, 'Mexican Peso', '$', 18.72000, 1, 'MXN', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(16, 'Norwegian Krone', 'kr', 7.83000, 1, 'NOK', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(17, 'New Zealand Dollar', '$', 1.38000, 1, 'NZD', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(18, 'Philippine Peso', '₱', 52.26000, 1, 'PHP', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(19, 'Polish Zloty', 'zł', 3.39000, 1, 'PLN', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(20, 'Pound Sterling', '£', 0.72000, 1, 'GBP', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(21, 'Russian Ruble', 'руб', 55.93000, 1, 'RUB', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(22, 'Singapore Dollar', '$', 1.32000, 1, 'SGD', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(23, 'Swedish Krona', 'kr', 8.19000, 1, 'SEK', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(24, 'Swiss Franc', 'CHF', 0.94000, 1, 'CHF', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(26, 'Thai Baht', '฿', 31.39000, 1, 'THB', '2018-10-09 11:35:08', '2018-10-09 11:35:08'),
(27, 'Taka', '৳', 84.00000, 1, 'BDT', '2018-10-09 11:35:08', '2018-12-02 05:16:13'),
(28, 'Indian Rupee', 'Rs', 68.45000, 1, 'Rupee', '2019-07-07 10:33:46', '2019-07-07 10:33:46'),
(29, 'Egyptian Pounds', 'L.E', 15.62690, 1, 'EGP', '2021-05-17 23:00:05', '2021-05-17 23:00:05'),
(30, 'Saudi Arabian Riyals', 'SAR', 3.75000, 1, 'SAR', '2021-05-17 23:05:00', '2021-10-02 08:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_packages`
--

CREATE TABLE `customer_packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double(20,2) DEFAULT NULL,
  `product_upload` int(11) DEFAULT NULL,
  `logo` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_package_payments`
--

CREATE TABLE `customer_package_payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_package_id` int(11) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci NOT NULL,
  `approval` int(1) NOT NULL,
  `offline_payment` int(1) NOT NULL COMMENT '1=offline payment\r\n2=online paymnet',
  `reciept` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_package_translations`
--

CREATE TABLE `customer_package_translations` (
  `id` bigint(20) NOT NULL,
  `customer_package_id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_products`
--

CREATE TABLE `customer_products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `added_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `subsubcategory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `photos` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_img` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `conditon` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` text COLLATE utf8_unicode_ci,
  `video_provider` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_link` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci,
  `unit_price` double(20,2) DEFAULT '0.00',
  `meta_title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_img` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pdf` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_product_translations`
--

CREATE TABLE `customer_product_translations` (
  `id` bigint(20) NOT NULL,
  `customer_product_id` bigint(20) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fekrait_activities`
--

CREATE TABLE `fekrait_activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` int(11) DEFAULT NULL,
  `cat` int(11) DEFAULT NULL,
  `window` int(11) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `operation` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flash_deals`
--

CREATE TABLE `flash_deals` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start_date` int(20) DEFAULT NULL,
  `end_date` int(20) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `featured` int(1) NOT NULL DEFAULT '0',
  `background_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text_color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flash_deal_products`
--

CREATE TABLE `flash_deal_products` (
  `id` int(11) NOT NULL,
  `flash_deal_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount` double(20,2) DEFAULT '0.00',
  `discount_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flash_deal_translations`
--

CREATE TABLE `flash_deal_translations` (
  `id` bigint(20) NOT NULL,
  `flash_deal_id` bigint(20) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `frontend_color` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'default',
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_login_background` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_login_sidebar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google_plus` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `frontend_color`, `logo`, `footer_logo`, `admin_logo`, `admin_login_background`, `admin_login_sidebar`, `favicon`, `site_name`, `address`, `description`, `phone`, `email`, `facebook`, `instagram`, `twitter`, `youtube`, `google_plus`, `created_at`, `updated_at`) VALUES
(1, 'default', 'uploads/logo/pfdIuiMeXGkDAIpPEUrvUCbQrOHu484nbGfz77zB.png', NULL, 'uploads/admin_logo/wCgHrz0Q5QoL1yu4vdrNnQIr4uGuNL48CXfcxOuS.png', NULL, NULL, 'uploads/favicon/uHdGidSaRVzvPgDj6JFtntMqzJkwDk9659233jrb.png', 'Active Ecommerce CMS', 'Demo Address', 'Active eCommerce CMS is a Multi vendor system is such a platform to build a border less marketplace.', '1234567890', 'admin@example.com', 'https://www.facebook.com', 'https://www.instagram.com', 'https://www.twitter.com', 'https://www.youtube.com', 'https://www.googleplus.com', '2019-03-13 08:01:06', '2019-03-13 02:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `governorates`
--

CREATE TABLE `governorates` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `home_categories`
--

CREATE TABLE `home_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subsubcategories` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rtl` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `rtl`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 0, '2019-01-20 12:13:20', '2019-01-20 12:13:20'),
(4, 'Arabic', 'sa', 1, '2019-04-28 18:34:12', '2019-04-28 18:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_shipment_addresses`
--

CREATE TABLE `local_shipment_addresses` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `governorate_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `cost` double(20,2) NOT NULL,
  `shipping_days` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text COLLATE utf32_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2021_07_27_140630_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `body` text,
  `data` text,
  `type` int(11) DEFAULT NULL,
  `show` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('125ce8289850f80d9fea100325bf892fbd0deba1f87dbfc2ab81fb43d57377ec24ed65f7dc560e46', 1, 1, 'Personal Access Token', '[]', 0, '2019-07-30 04:51:13', '2019-07-30 04:51:13', '2020-07-30 10:51:13'),
('293d2bb534220c070c4e90d25b5509965d23d3ddbc05b1e29fb4899ae09420ff112dbccab1c6f504', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 06:00:04', '2019-08-04 06:00:04', '2020-08-04 12:00:04'),
('5363e91c7892acdd6417aa9c7d4987d83568e229befbd75be64282dbe8a88147c6c705e06c1fb2bf', 1, 1, 'Personal Access Token', '[]', 0, '2019-07-13 06:44:28', '2019-07-13 06:44:28', '2020-07-13 12:44:28'),
('681b4a4099fac5e12517307b4027b54df94cbaf0cbf6b4bf496534c94f0ccd8a79dd6af9742d076b', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:23:06', '2019-08-04 07:23:06', '2020-08-04 13:23:06'),
('6d229e3559e568df086c706a1056f760abc1370abe74033c773490581a042442154afa1260c4b6f0', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:32:12', '2019-08-04 07:32:12', '2020-08-04 13:32:12'),
('6efc0f1fc3843027ea1ea7cd35acf9c74282f0271c31d45a164e7b27025a315d31022efe7bb94aaa', 1, 1, 'Personal Access Token', '[]', 0, '2019-08-08 02:35:26', '2019-08-08 02:35:26', '2020-08-08 08:35:26'),
('7745b763da15a06eaded371330072361b0524c41651cf48bf76fc1b521a475ece78703646e06d3b0', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:29:44', '2019-08-04 07:29:44', '2020-08-04 13:29:44'),
('815b625e239934be293cd34479b0f766bbc1da7cc10d464a2944ddce3a0142e943ae48be018ccbd0', 1, 1, 'Personal Access Token', '[]', 1, '2019-07-22 02:07:47', '2019-07-22 02:07:47', '2020-07-22 08:07:47'),
('8921a4c96a6d674ac002e216f98855c69de2568003f9b4136f6e66f4cb9545442fb3e37e91a27cad', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 06:05:05', '2019-08-04 06:05:05', '2020-08-04 12:05:05'),
('8d8b85720304e2f161a66564cec0ecd50d70e611cc0efbf04e409330086e6009f72a39ce2191f33a', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 06:44:35', '2019-08-04 06:44:35', '2020-08-04 12:44:35'),
('bcaaebdead4c0ef15f3ea6d196fd80749d309e6db8603b235e818cb626a5cea034ff2a55b66e3e1a', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:14:32', '2019-08-04 07:14:32', '2020-08-04 13:14:32'),
('c25417a5c728073ca8ba57058ded43d496a9d2619b434d2a004dd490a64478c08bc3e06ffc1be65d', 1, 1, 'Personal Access Token', '[]', 1, '2019-07-30 01:45:31', '2019-07-30 01:45:31', '2020-07-30 07:45:31'),
('c7423d85b2b5bdc5027cb283be57fa22f5943cae43f60b0ed27e6dd198e46f25e3501b3081ed0777', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-05 05:02:59', '2019-08-05 05:02:59', '2020-08-05 11:02:59'),
('e76f19dbd5c2c4060719fb1006ac56116fd86f7838b4bf74e2c0a0ac9696e724df1e517dbdb357f4', 1, 1, 'Personal Access Token', '[]', 1, '2019-07-15 02:53:40', '2019-07-15 02:53:40', '2020-07-15 08:53:40'),
('ed7c269dd6f9a97750a982f62e0de54749be6950e323cdfef892a1ec93f8ddbacf9fe26e6a42180e', 1, 1, 'Personal Access Token', '[]', 1, '2019-07-13 06:36:45', '2019-07-13 06:36:45', '2020-07-13 12:36:45'),
('f6d1475bc17a27e389000d3df4da5c5004ce7610158b0dd414226700c0f6db48914637b4c76e1948', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:22:01', '2019-08-04 07:22:01', '2020-08-04 13:22:01'),
('f85e4e444fc954430170c41779a4238f84cd6fed905f682795cd4d7b6a291ec5204a10ac0480eb30', 1, 1, 'Personal Access Token', '[]', 1, '2019-07-30 06:38:49', '2019-07-30 06:38:49', '2020-07-30 12:38:49'),
('f8bf983a42c543b99128296e4bc7c2d17a52b5b9ef69670c629b93a653c6a4af27be452e0c331f79', 1, 1, 'Personal Access Token', '[]', 1, '2019-08-04 07:28:55', '2019-08-04 07:28:55', '2020-08-04 13:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'eR2y7WUuem28ugHKppFpmss7jPyOHZsMkQwBo1Jj', 'http://localhost', 1, 0, 0, '2019-07-13 06:17:34', '2019-07-13 06:17:34'),
(2, NULL, 'Laravel Password Grant Client', 'WLW2Ol0GozbaXEnx1NtXoweYPuKEbjWdviaUgw77', 'http://localhost', 0, 1, 0, '2019-07-13 06:17:34', '2019-07-13 06:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-07-13 06:17:34', '2019-07-13 06:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `shipping_address` longtext COLLATE utf8_unicode_ci,
  `delivery_status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'pending',
  `payment_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'unpaid',
  `payment_details` longtext COLLATE utf8_unicode_ci,
  `grand_total` double(20,2) DEFAULT NULL,
  `coupon_discount` double(20,2) NOT NULL DEFAULT '0.00',
  `code` mediumtext COLLATE utf8_unicode_ci,
  `date` int(20) NOT NULL,
  `viewed` int(1) NOT NULL DEFAULT '0',
  `delivery_viewed` int(1) NOT NULL DEFAULT '1',
  `payment_status_viewed` int(1) DEFAULT '1',
  `commission_calculated` int(11) NOT NULL DEFAULT '0',
  `shipping_days` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `variation` longtext COLLATE utf8_unicode_ci,
  `price` double(20,2) DEFAULT NULL,
  `tax` double(20,2) NOT NULL DEFAULT '0.00',
  `shipping_cost` double(20,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) DEFAULT NULL,
  `payment_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unpaid',
  `delivery_status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'pending',
  `shipping_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pickup_point_id` int(11) DEFAULT NULL,
  `product_referral_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details_files`
--

CREATE TABLE `order_details_files` (
  `id` int(11) NOT NULL,
  `order_detials_id` int(11) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `meta_title` text COLLATE utf8_unicode_ci,
  `meta_description` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `page_translations`
--

CREATE TABLE `page_translations` (
  `id` bigint(20) NOT NULL,
  `page_id` bigint(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL DEFAULT '0.00',
  `payment_details` longtext COLLATE utf8_unicode_ci,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `txn_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_card_fawry_token_users`
--

CREATE TABLE `payment_card_fawry_token_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_card_fawry_token` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paytabs_invoices`
--

CREATE TABLE `paytabs_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `result` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_code` int(10) UNSIGNED NOT NULL,
  `pt_invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` int(10) UNSIGNED DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_first_six_digits` int(10) UNSIGNED DEFAULT NULL,
  `card_last_four_digits` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_points`
--

CREATE TABLE `pickup_points` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `pick_up_status` int(1) DEFAULT NULL,
  `cash_on_pickup_status` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pickup_point_translations`
--

CREATE TABLE `pickup_point_translations` (
  `id` bigint(20) NOT NULL,
  `pickup_point_id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` int(11) NOT NULL,
  `name` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `name`, `content`, `created_at`, `updated_at`) VALUES
(1, 'support_policy', NULL, '2019-10-29 12:54:45', '2019-01-22 05:13:15'),
(2, 'return_policy', NULL, '2019-10-29 12:54:47', '2019-01-24 05:40:11'),
(4, 'seller_policy', NULL, '2019-10-29 12:54:49', '2019-02-04 17:50:15'),
(5, 'terms', NULL, '2019-10-29 12:54:51', '2019-10-28 18:00:00'),
(6, 'privacy_policy', NULL, '2019-10-29 12:54:54', '2019-10-28 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `prices_system`
--

CREATE TABLE `prices_system` (
  `id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `added_by` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `subsubcategory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `photos` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_img` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_provider` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `unit_price` double(20,2) NOT NULL,
  `purchase_price` double(20,2) NOT NULL,
  `variant_product` int(1) NOT NULL DEFAULT '0',
  `attributes` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '[]',
  `choice_options` mediumtext COLLATE utf8_unicode_ci,
  `colors` mediumtext COLLATE utf8_unicode_ci,
  `variations` text COLLATE utf8_unicode_ci,
  `todays_deal` int(11) NOT NULL DEFAULT '0',
  `published` int(11) NOT NULL DEFAULT '1',
  `stock_visibility_state` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'quantity',
  `cash_on_delivery` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = On, 0 = Off',
  `featured` int(11) NOT NULL DEFAULT '0',
  `seller_featured` int(11) NOT NULL DEFAULT '0',
  `current_stock` int(10) NOT NULL DEFAULT '0',
  `unit` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `min_qty` int(11) NOT NULL DEFAULT '1',
  `low_stock_quantity` int(11) DEFAULT NULL,
  `discount` double(20,2) DEFAULT NULL,
  `discount_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax` double(20,2) DEFAULT NULL,
  `tax_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_type` varchar(20) CHARACTER SET latin1 DEFAULT 'flat_rate',
  `shipping_cost` text COLLATE utf8_unicode_ci,
  `is_quantity_multiplied` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = Mutiplied with shipping cost',
  `est_shipping_days` int(11) DEFAULT NULL,
  `num_of_sale` int(11) NOT NULL DEFAULT '0',
  `meta_title` mediumtext COLLATE utf8_unicode_ci,
  `meta_description` longtext COLLATE utf8_unicode_ci,
  `meta_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `rating` double(8,2) NOT NULL DEFAULT '0.00',
  `barcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `digital` int(1) NOT NULL DEFAULT '0',
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double(20,2) NOT NULL DEFAULT '0.00',
  `qty` int(11) NOT NULL DEFAULT '0',
  `image` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_taxes`
--

CREATE TABLE `product_taxes` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `tax` double(20,2) NOT NULL,
  `tax_type` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_translations`
--

CREATE TABLE `product_translations` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminder_baskets`
--

CREATE TABLE `reminder_baskets` (
  `id` int(11) NOT NULL,
  `date_send_reminder` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `channel_msg` enum('sms','email','all') NOT NULL,
  `msg` text NOT NULL,
  `title_mail` varchar(191) DEFAULT NULL,
  `status` enum('send','pending') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `public` tinyint(4) NOT NULL DEFAULT '0',
  `duration_discount_hour` int(11) DEFAULT NULL,
  `minmum_amount_basket` double(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reminder_customers`
--

CREATE TABLE `reminder_customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reminder_id` int(11) NOT NULL,
  `temporary_discount_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `comment` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `viewed` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'Manager', '[\"1\",\"2\",\"4\"]', '2018-10-10 04:39:47', '2018-10-10 04:51:37'),
(2, 'Accountant', '[\"2\",\"3\"]', '2018-10-10 04:52:09', '2018-10-10 04:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `role_translations`
--

CREATE TABLE `role_translations` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `searches`
--

CREATE TABLE `searches` (
  `id` int(11) NOT NULL,
  `query` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `verification_status` int(1) NOT NULL DEFAULT '0',
  `verification_info` longtext COLLATE utf8_unicode_ci,
  `cash_on_delivery_status` int(1) NOT NULL DEFAULT '0',
  `admin_to_pay` double(20,2) NOT NULL DEFAULT '0.00',
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_acc_name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_acc_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_routing_no` int(50) DEFAULT NULL,
  `bank_payment_status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seller_withdraw_requests`
--

CREATE TABLE `seller_withdraw_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` double(20,2) DEFAULT NULL,
  `message` longtext,
  `status` int(1) DEFAULT NULL,
  `viewed` int(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` int(11) NOT NULL,
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `revisit` int(11) NOT NULL,
  `sitemap_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `keyword`, `author`, `revisit`, `sitemap_link`, `description`, `created_at`, `updated_at`) VALUES
(1, 'bootstrap,responsive,template,developer', 'Active IT Zone', 11, 'https://www.activeitzone.com', 'Active E-commerce CMS Multi vendor system is such a platform to build a border less marketplace both for physical and digital goods.', '2019-08-08 08:56:11', '2019-08-08 02:56:11');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sliders` longtext COLLATE utf8_unicode_ci,
  `address` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8_unicode_ci,
  `pick_up_point_id` text COLLATE utf8_unicode_ci,
  `shipping_cost` double(20,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` int(1) NOT NULL DEFAULT '1',
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `special_offers`
--

CREATE TABLE `special_offers` (
  `id` int(11) NOT NULL,
  `offer_title` varchar(191) NOT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `offer_type` enum('x_to_y','amount','percent') NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `special_offers_customer_purchase`
--

CREATE TABLE `special_offers_customer_purchase` (
  `id` int(11) NOT NULL,
  `special_offers_id` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `type_discount` enum('amount','percent') NOT NULL,
  `min_type` enum('price','quantity') NOT NULL,
  `min_price` int(11) NOT NULL DEFAULT '0',
  `min_qty` int(11) NOT NULL DEFAULT '0',
  `with_coupon` tinyint(4) NOT NULL DEFAULT '0',
  `maximum_discount` int(11) NOT NULL DEFAULT '0',
  `offer_applies_type` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `special_offers_product`
--

CREATE TABLE `special_offers_product` (
  `id` int(11) NOT NULL,
  `special_offers_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `type` enum('product','category') NOT NULL,
  `type_x_to_y` enum('from','to') DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `special_offers_xy`
--

CREATE TABLE `special_offers_xy` (
  `id` int(11) NOT NULL,
  `special_offers_id` int(11) DEFAULT NULL,
  `customer_qty_buy` int(11) NOT NULL,
  `customer_qty_get` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `free` tinyint(4) NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `tax_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = Inactive, 1 = Active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_discount`
--

CREATE TABLE `temporary_discount` (
  `id` int(11) NOT NULL,
  `discount_type` enum('amount','percent') NOT NULL DEFAULT 'amount',
  `reminder_id` int(11) DEFAULT NULL,
  `shipping_free` tinyint(4) NOT NULL DEFAULT '0',
  `discount` int(11) NOT NULL,
  `expire_discount_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `text_area`
--

CREATE TABLE `text_area` (
  `id` int(11) NOT NULL,
  `text` text,
  `link_photo` varchar(200) DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `html` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `code` int(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8_unicode_ci,
  `files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `viewed` int(1) NOT NULL DEFAULT '0',
  `client_viewed` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_replies`
--

CREATE TABLE `ticket_replies` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reply` longtext COLLATE utf8_unicode_ci NOT NULL,
  `files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int(11) NOT NULL,
  `lang` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang_key` text COLLATE utf8_unicode_ci,
  `lang_value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(1, 'en', 'Language has been inserted successfully', 'Language has been inserted successfully', '2021-05-05 23:07:53', '2021-05-05 23:07:53'),
(2, 'en', 'This is used for search. Input those words by which cutomer can find this product.', 'This is used for search. Input those words by which cutomer can find this product.', '2021-04-27 16:01:42', '2021-04-27 16:01:42'),
(3, 'en', 'All Category', 'All Category', '2020-11-02 07:40:38', '2020-11-02 07:40:38'),
(4, 'en', 'All', 'All', '2020-11-02 07:40:38', '2020-11-02 07:40:38'),
(5, 'en', 'Flash Sale', 'Flash Sale', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(6, 'en', 'View More', 'View More', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(7, 'en', 'Add to wishlist', 'Add to wishlist', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(8, 'en', 'Add to compare', 'Add to compare', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(9, 'en', 'Add to cart', 'Add to cart', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(10, 'en', 'Club Point', 'Club Point', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(11, 'en', 'Classified Ads', 'Classified Ads', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(13, 'en', 'Used', 'Used', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(14, 'en', 'Top 10 Categories', 'Top 10 Categories', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(15, 'en', 'View All Categories', 'View All Categories', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(16, 'en', 'Top 10 Brands', 'Top 10 Brands', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(17, 'en', 'View All Brands', 'View All Brands', '2020-11-02 07:40:40', '2020-11-02 07:40:40'),
(43, 'en', 'Terms & conditions', 'Terms & conditions', '2020-11-02 07:40:41', '2020-11-02 07:40:41'),
(51, 'en', 'Best Selling', 'Best Selling', '2020-11-02 07:40:42', '2020-11-02 07:40:42'),
(53, 'en', 'Top 20', 'Top 20', '2020-11-02 07:40:42', '2020-11-02 07:40:42'),
(55, 'en', 'Featured Products', 'Featured Products', '2020-11-02 07:40:42', '2020-11-02 07:40:42'),
(56, 'en', 'Best Sellers', 'Best Sellers', '2020-11-02 07:40:43', '2020-11-02 07:40:43'),
(57, 'en', 'Visit Store', 'Visit Store', '2020-11-02 07:40:43', '2020-11-02 07:40:43'),
(58, 'en', 'Popular Suggestions', 'Popular Suggestions', '2020-11-02 07:46:59', '2020-11-02 07:46:59'),
(59, 'en', 'Category Suggestions', 'Category Suggestions', '2020-11-02 07:46:59', '2020-11-02 07:46:59'),
(62, 'en', 'Automobile & Motorcycle', 'Automobile & Motorcycle', '2020-11-02 07:47:01', '2020-11-02 07:47:01'),
(63, 'en', 'Price range', 'Price range', '2020-11-02 07:47:01', '2020-11-02 07:47:01'),
(64, 'en', 'Filter by color', 'Filter by color', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(65, 'en', 'Home', 'Home', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(67, 'en', 'Newest', 'Newest', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(68, 'en', 'Oldest', 'Oldest', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(69, 'en', 'Price low to high', 'Price low to high', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(70, 'en', 'Price high to low', 'Price high to low', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(71, 'en', 'Brands', 'Brands', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(72, 'en', 'All Brands', 'All Brands', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(74, 'en', 'All Sellers', 'All Sellers', '2020-11-02 07:47:02', '2020-11-02 07:47:02'),
(78, 'en', 'Inhouse product', 'Inhouse product', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(79, 'en', 'Message Seller', 'Message Seller', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(80, 'en', 'Price', 'Price', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(81, 'en', 'Discount Price', 'Discount Price', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(82, 'en', 'Color', 'Color', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(83, 'en', 'Quantity', 'Quantity', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(84, 'en', 'available', 'available', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(85, 'en', 'Total Price', 'Total Price', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(86, 'en', 'Out of Stock', 'Out of Stock', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(87, 'en', 'Refund', 'Refund', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(88, 'en', 'Share', 'Share', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(89, 'en', 'Sold By', 'Sold By', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(90, 'en', 'customer reviews', 'customer reviews', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(91, 'en', 'Top Selling Products', 'Top Selling Products', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(92, 'en', 'Description', 'Description', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(93, 'en', 'Video', 'Video', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(94, 'en', 'Reviews', 'Reviews', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(95, 'en', 'Download', 'Download', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(96, 'en', 'There have been no reviews for this product yet.', 'There have been no reviews for this product yet.', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(97, 'en', 'Related products', 'Related products', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(98, 'en', 'Any query about this product', 'Any query about this product', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(99, 'en', 'Product Name', 'Product Name', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(100, 'en', 'Your Question', 'Your Question', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(101, 'en', 'Send', 'Send', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(103, 'en', 'Use country code before number', 'Use country code before number', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(105, 'en', 'Remember Me', 'Remember Me', '2020-11-02 08:18:03', '2020-11-02 08:18:03'),
(107, 'en', 'Dont have an account?', 'Dont have an account?', '2020-11-02 08:18:04', '2020-11-02 08:18:04'),
(108, 'en', 'Register Now', 'Register Now', '2020-11-02 08:18:04', '2020-11-02 08:18:04'),
(109, 'en', 'Or Login With', 'Or Login With', '2020-11-02 08:18:04', '2020-11-02 08:18:04'),
(110, 'en', 'oops..', 'oops..', '2020-11-02 10:29:04', '2020-11-02 10:29:04'),
(111, 'en', 'This item is out of stock!', 'This item is out of stock!', '2020-11-02 10:29:04', '2020-11-02 10:29:04'),
(112, 'en', 'Back to shopping', 'Back to shopping', '2020-11-02 10:29:04', '2020-11-02 10:29:04'),
(113, 'en', 'Login to your account.', 'Login to your account.', '2020-11-02 11:27:41', '2020-11-02 11:27:41'),
(115, 'en', 'Purchase History', 'Purchase History', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(116, 'en', 'New', 'New', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(117, 'en', 'Downloads', 'Downloads', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(118, 'en', 'Sent Refund Request', 'Sent Refund Request', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(119, 'en', 'Product Bulk Upload', 'Product Bulk Upload', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(123, 'en', 'Orders', 'Orders', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(124, 'en', 'Recieved Refund Request', 'Recieved Refund Request', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(126, 'en', 'Shop Setting', 'Shop Setting', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(127, 'en', 'Payment History', 'Payment History', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(128, 'en', 'Money Withdraw', 'Money Withdraw', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(129, 'en', 'Conversations', 'Conversations', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(130, 'en', 'My Wallet', 'My Wallet', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(131, 'en', 'Earning Points', 'Earning Points', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(132, 'en', 'Support Ticket', 'Support Ticket', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(133, 'en', 'Manage Profile', 'Manage Profile', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(134, 'en', 'Sold Amount', 'Sold Amount', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(135, 'en', 'Your sold amount (current month)', 'Your sold amount (current month)', '2020-11-02 11:27:53', '2020-11-02 11:27:53'),
(136, 'en', 'Total Sold', 'Total Sold', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(137, 'en', 'Last Month Sold', 'Last Month Sold', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(138, 'en', 'Total sale', 'Total sale', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(139, 'en', 'Total earnings', 'Total earnings', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(140, 'en', 'Successful orders', 'Successful orders', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(141, 'en', 'Total orders', 'Total orders', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(142, 'en', 'Pending orders', 'Pending orders', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(143, 'en', 'Cancelled orders', 'Cancelled orders', '2020-11-02 11:27:54', '2020-11-02 11:27:54'),
(145, 'en', 'Product', 'Product', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(147, 'en', 'Purchased Package', 'Purchased Package', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(148, 'en', 'Package Not Found', 'Package Not Found', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(149, 'en', 'Upgrade Package', 'Upgrade Package', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(150, 'en', 'Shop', 'Shop', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(151, 'en', 'Manage & organize your shop', 'Manage & organize your shop', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(152, 'en', 'Go to setting', 'Go to setting', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(153, 'en', 'Payment', 'Payment', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(154, 'en', 'Configure your payment method', 'Configure your payment method', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(156, 'en', 'My Panel', 'My Panel', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(158, 'en', 'Item has been added to wishlist', 'Item has been added to wishlist', '2020-11-02 11:27:55', '2020-11-02 11:27:55'),
(159, 'en', 'My Points', 'My Points', '2020-11-02 11:28:15', '2020-11-02 11:28:15'),
(160, 'en', ' Points', ' Points', '2020-11-02 11:28:15', '2020-11-02 11:28:15'),
(161, 'en', 'Wallet Money', 'Wallet Money', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(162, 'en', 'Exchange Rate', 'Exchange Rate', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(163, 'en', 'Point Earning history', 'Point Earning history', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(164, 'en', 'Date', 'Date', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(165, 'en', 'Points', 'Points', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(166, 'en', 'Converted', 'Converted', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(167, 'en', 'Action', 'Action', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(168, 'en', 'No history found.', 'No history found.', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(169, 'en', 'Convert has been done successfully Check your Wallets', 'Convert has been done successfully Check your Wallets', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(170, 'en', 'Something went wrong', 'Something went wrong', '2020-11-02 11:28:16', '2020-11-02 11:28:16'),
(171, 'en', 'Remaining Uploads', 'Remaining Uploads', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(172, 'en', 'No Package Found', 'No Package Found', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(173, 'en', 'Search product', 'Search product', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(174, 'en', 'Name', 'Name', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(176, 'en', 'Current Qty', 'Current Qty', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(177, 'en', 'Base Price', 'Base Price', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(178, 'en', 'Published', 'Published', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(179, 'en', 'Featured', 'Featured', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(180, 'en', 'Options', 'Options', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(181, 'en', 'Edit', 'Edit', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(182, 'en', 'Duplicate', 'Duplicate', '2020-11-02 11:37:13', '2020-11-02 11:37:13'),
(184, 'en', '1. Download the skeleton file and fill it with data.', '1. Download the skeleton file and fill it with data.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(185, 'en', '2. You can download the example file to understand how the data must be filled.', '2. You can download the example file to understand how the data must be filled.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(186, 'en', '3. Once you have downloaded and filled the skeleton file, upload it in the form below and submit.', '3. Once you have downloaded and filled the skeleton file, upload it in the form below and submit.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(187, 'en', '4. After uploading products you need to edit them and set products images and choices.', '4. After uploading products you need to edit them and set products images and choices.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(188, 'en', 'Download CSV', 'Download CSV', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(189, 'en', '1. Category,Sub category,Sub Sub category and Brand should be in numerical ids.', '1. Category,Sub category,Sub Sub category and Brand should be in numerical ids.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(190, 'en', '2. You can download the pdf to get Category,Sub category,Sub Sub category and Brand id.', '2. You can download the pdf to get Category,Sub category,Sub Sub category and Brand id.', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(191, 'en', 'Download Category', 'Download Category', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(192, 'en', 'Download Sub category', 'Download Sub category', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(193, 'en', 'Download Sub Sub category', 'Download Sub Sub category', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(194, 'en', 'Download Brand', 'Download Brand', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(195, 'en', 'Upload CSV File', 'Upload CSV File', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(196, 'en', 'CSV', 'CSV', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(197, 'en', 'Choose CSV File', 'Choose CSV File', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(198, 'en', 'Upload', 'Upload', '2020-11-02 11:37:20', '2020-11-02 11:37:20'),
(199, 'en', 'Add New Digital Product', 'Add New Digital Product', '2020-11-02 11:37:25', '2020-11-02 11:37:25'),
(200, 'en', 'Available Status', 'Available Status', '2020-11-02 11:37:29', '2020-11-02 11:37:29'),
(201, 'en', 'Admin Status', 'Admin Status', '2020-11-02 11:37:29', '2020-11-02 11:37:29'),
(202, 'en', 'Pending Balance', 'Pending Balance', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(203, 'en', 'Send Withdraw Request', 'Send Withdraw Request', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(204, 'en', 'Withdraw Request history', 'Withdraw Request history', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(205, 'en', 'Amount', 'Amount', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(206, 'en', 'Status', 'Status', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(207, 'en', 'Message', 'Message', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(208, 'en', 'Send A Withdraw Request', 'Send A Withdraw Request', '2020-11-02 11:38:07', '2020-11-02 11:38:07'),
(209, 'en', 'Basic Info', 'Basic Info', '2020-11-02 11:38:13', '2020-11-02 11:38:13'),
(211, 'en', 'Your Phone', 'Your Phone', '2020-11-02 11:38:13', '2020-11-02 11:38:13'),
(212, 'en', 'Photo', 'Photo', '2020-11-02 11:38:13', '2020-11-02 11:38:13'),
(213, 'en', 'Browse', 'Browse', '2020-11-02 11:38:13', '2020-11-02 11:38:13'),
(215, 'en', 'Your Password', 'Your Password', '2020-11-02 11:38:13', '2020-11-02 11:38:13'),
(216, 'en', 'New Password', 'New Password', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(217, 'en', 'Confirm Password', 'Confirm Password', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(218, 'en', 'Add New Address', 'Add New Address', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(219, 'en', 'Payment Setting', 'Payment Setting', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(220, 'en', 'Cash Payment', 'Cash Payment', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(221, 'en', 'Bank Payment', 'Bank Payment', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(222, 'en', 'Bank Name', 'Bank Name', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(223, 'en', 'Bank Account Name', 'Bank Account Name', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(224, 'en', 'Bank Account Number', 'Bank Account Number', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(225, 'en', 'Bank Routing Number', 'Bank Routing Number', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(226, 'en', 'Update Profile', 'Update Profile', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(227, 'en', 'Change your email', 'Change your email', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(228, 'en', 'Your Email', 'Your Email', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(229, 'en', 'Sending Email...', 'Sending Email...', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(230, 'en', 'Verify', 'Verify', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(231, 'en', 'Update Email', 'Update Email', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(232, 'en', 'New Address', 'New Address', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(233, 'en', 'Your Address', 'Your Address', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(234, 'en', 'Country', 'Country', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(235, 'en', 'Select your country', 'Select your country', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(236, 'en', 'City', 'City', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(237, 'en', 'Your City', 'Your City', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(239, 'en', 'Your Postal Code', 'Your Postal Code', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(240, 'en', '+880', '880', '2020-11-02 11:38:14', '2021-05-05 23:16:22'),
(241, 'en', 'Save', 'Save', '2020-11-02 11:38:14', '2020-11-02 11:38:14'),
(242, 'en', 'Received Refund Request', 'Received Refund Request', '2020-11-02 11:56:20', '2020-11-02 11:56:20'),
(244, 'en', 'Delete Confirmation', 'Delete Confirmation', '2020-11-02 11:56:20', '2020-11-02 11:56:20'),
(245, 'en', 'Are you sure to delete this?', 'Are you sure to delete this?', '2020-11-02 11:56:21', '2020-11-02 11:56:21'),
(246, 'en', 'Premium Packages for Sellers', 'Premium Packages for Sellers', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(247, 'en', 'Product Upload', 'Product Upload', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(248, 'en', 'Digital Product Upload', 'Digital Product Upload', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(250, 'en', 'Purchase Package', 'Purchase Package', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(251, 'en', 'Select Payment Type', 'Select Payment Type', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(252, 'en', 'Payment Type', 'Payment Type', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(253, 'en', 'Select One', 'Select One', '2020-11-02 11:57:36', '2020-11-02 11:57:36'),
(254, 'en', 'Online payment', 'Online payment', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(255, 'en', 'Offline payment', 'Offline payment', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(256, 'en', 'Purchase Your Package', 'Purchase Your Package', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(258, 'en', 'Paypal', 'Paypal', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(259, 'en', 'Stripe', 'Stripe', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(260, 'en', 'sslcommerz', 'sslcommerz', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(265, 'en', 'Confirm', 'Confirm', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(266, 'en', 'Offline Package Payment', 'Offline Package Payment', '2020-11-02 11:57:37', '2020-11-02 11:57:37'),
(267, 'en', 'Transaction ID', 'Transaction ID', '2020-11-02 12:30:12', '2020-11-02 12:30:12'),
(268, 'en', 'Choose image', 'Choose image', '2020-11-02 12:30:12', '2020-11-02 12:30:12'),
(269, 'en', 'Code', 'Code', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(270, 'en', 'Delivery Status', 'Delivery Status', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(271, 'en', 'Payment Status', 'Payment Status', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(272, 'en', 'Paid', 'Paid', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(273, 'en', 'Order Details', 'Order Details', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(274, 'en', 'Download Invoice', 'Download Invoice', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(275, 'en', 'Unpaid', 'Unpaid', '2020-11-02 12:42:00', '2020-11-02 12:42:00'),
(277, 'en', 'Order placed', 'Order placed', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(278, 'en', 'Confirmed', 'Confirmed', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(279, 'en', 'On delivery', 'On delivery', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(280, 'en', 'Delivered', 'Delivered', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(281, 'en', 'Order Summary', 'Order Summary', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(282, 'en', 'Order Code', 'Order Code', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(283, 'en', 'Customer', 'Customer', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(287, 'en', 'Total order amount', 'Total order amount', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(288, 'en', 'Shipping metdod', 'Shipping metdod', '2020-11-02 12:43:59', '2020-11-02 12:43:59'),
(289, 'en', 'Flat shipping rate', 'Flat shipping rate', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(290, 'en', 'Payment metdod', 'Payment metdod', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(291, 'en', 'Variation', 'Variation', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(292, 'en', 'Delivery Type', 'Delivery Type', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(293, 'en', 'Home Delivery', 'Home Delivery', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(294, 'en', 'Order Ammount', 'Order Ammount', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(295, 'en', 'Subtotal', 'Subtotal', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(296, 'en', 'Shipping', 'Shipping', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(298, 'en', 'Coupon Discount', 'Coupon Discount', '2020-11-02 12:44:00', '2020-11-02 12:44:00'),
(300, 'en', 'N/A', 'N/A', '2020-11-02 12:44:20', '2020-11-02 12:44:20'),
(301, 'en', 'In stock', 'In stock', '2020-11-02 12:54:52', '2020-11-02 12:54:52'),
(302, 'en', 'Buy Now', 'Buy Now', '2020-11-02 12:54:52', '2020-11-02 12:54:52'),
(303, 'en', 'Item added to your cart!', 'Item added to your cart!', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(304, 'en', 'Proceed to Checkout', 'Proceed to Checkout', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(305, 'en', 'Cart Items', 'Cart Items', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(306, 'en', '1. My Cart', '1. My Cart', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(307, 'en', 'View cart', 'View cart', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(308, 'en', '2. Shipping info', '2. Shipping info', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(309, 'en', 'Checkout', 'Checkout', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(310, 'en', '3. Delivery info', '3. Delivery info', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(311, 'en', '4. Payment', '4. Payment', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(312, 'en', '5. Confirmation', '5. Confirmation', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(313, 'en', 'Remove', 'Remove', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(314, 'en', 'Return to shop', 'Return to shop', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(315, 'en', 'Continue to Shipping', 'Continue to Shipping', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(316, 'en', 'Or', 'Or', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(317, 'en', 'Guest Checkout', 'Guest Checkout', '2020-11-02 12:56:46', '2020-11-02 12:56:46'),
(318, 'en', 'Continue to Delivery Info', 'Continue to Delivery Info', '2020-11-02 12:57:44', '2020-11-02 12:57:44'),
(319, 'en', 'Postal Code', 'Postal Code', '2020-11-02 13:01:01', '2020-11-02 13:01:01'),
(320, 'en', 'Choose Delivery Type', 'Choose Delivery Type', '2020-11-02 13:01:04', '2020-11-02 13:01:04'),
(321, 'en', 'Local Pickup', 'Local Pickup', '2020-11-02 13:01:04', '2020-11-02 13:01:04'),
(322, 'en', 'Select your nearest pickup point', 'Select your nearest pickup point', '2020-11-02 13:01:04', '2020-11-02 13:01:04'),
(323, 'en', 'Continue to Payment', 'Continue to Payment', '2020-11-02 13:01:04', '2020-11-02 13:01:04'),
(324, 'en', 'Select a payment option', 'Select a payment option', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(325, 'en', 'Razorpay', 'Razorpay', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(326, 'en', 'Paystack', 'Paystack', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(327, 'en', 'VoguePay', 'VoguePay', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(328, 'en', 'payhere', 'payhere', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(329, 'en', 'ngenius', 'ngenius', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(330, 'en', 'Paytm', 'Paytm', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(331, 'en', 'Cash on Delivery', 'Cash on Delivery', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(332, 'en', 'Your wallet balance :', 'Your wallet balance :', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(333, 'en', 'Insufficient balance', 'Insufficient balance', '2020-11-02 13:01:13', '2020-11-02 13:01:13'),
(334, 'en', 'I agree to the', 'I agree to the', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(338, 'en', 'Complete Order', 'Complete Order', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(339, 'en', 'Summary', 'Summary', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(340, 'en', 'Items', 'Items', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(341, 'en', 'Total Club point', 'Total Club point', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(342, 'en', 'Total Shipping', 'Total Shipping', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(343, 'en', 'Have coupon code? Enter here', 'Have coupon code? Enter here', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(344, 'en', 'Apply', 'Apply', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(345, 'en', 'You need to agree with our policies', 'You need to agree with our policies', '2020-11-02 13:01:14', '2020-11-02 13:01:14'),
(346, 'en', 'Forgot password', 'Forgot password', '2020-11-02 13:01:25', '2020-11-02 13:01:25'),
(469, 'en', 'SEO Setting', 'SEO Setting', '2020-11-02 13:01:33', '2020-11-02 13:01:33'),
(474, 'en', 'System Update', 'System Update', '2020-11-02 13:01:34', '2020-11-02 13:01:34'),
(480, 'en', 'Add New Payment Method', 'Add New Payment Method', '2020-11-02 13:01:38', '2020-11-02 13:01:38'),
(481, 'en', 'Manual Payment Method', 'Manual Payment Method', '2020-11-02 13:01:38', '2020-11-02 13:01:38'),
(482, 'en', 'Heading', 'Heading', '2020-11-02 13:01:38', '2020-11-02 13:01:38'),
(483, 'en', 'Logo', 'Logo', '2020-11-02 13:01:38', '2020-11-02 13:01:38'),
(484, 'en', 'Manual Payment Information', 'Manual Payment Information', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(485, 'en', 'Type', 'Type', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(486, 'en', 'Custom Payment', 'Custom Payment', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(487, 'en', 'Check Payment', 'Check Payment', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(488, 'en', 'Checkout Thumbnail', 'Checkout Thumbnail', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(489, 'en', 'Payment Instruction', 'Payment Instruction', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(490, 'en', 'Bank Information', 'Bank Information', '2020-11-02 13:01:42', '2020-11-02 13:01:42'),
(491, 'en', 'Select File', 'Select File', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(492, 'en', 'Upload New', 'Upload New', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(493, 'en', 'Sort by newest', 'Sort by newest', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(494, 'en', 'Sort by oldest', 'Sort by oldest', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(495, 'en', 'Sort by smallest', 'Sort by smallest', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(496, 'en', 'Sort by largest', 'Sort by largest', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(497, 'en', 'Selected Only', 'Selected Only', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(498, 'en', 'No files found', 'No files found', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(499, 'en', '0 File selected', '0 File selected', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(500, 'en', 'Clear', 'Clear', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(501, 'en', 'Prev', 'Prev', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(502, 'en', 'Next', 'Next', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(503, 'en', 'Add Files', 'Add Files', '2020-11-02 13:01:53', '2020-11-02 13:01:53'),
(504, 'en', 'Method has been inserted successfully', 'Method has been inserted successfully', '2020-11-02 13:02:03', '2020-11-02 13:02:03'),
(506, 'en', 'Order Date', 'Order Date', '2020-11-02 13:02:42', '2020-11-02 13:02:42'),
(507, 'en', 'Bill to', 'Bill to', '2020-11-02 13:02:42', '2020-11-02 13:02:42'),
(510, 'en', 'Sub Total', 'Sub Total', '2020-11-02 13:02:42', '2020-11-02 13:02:42'),
(512, 'en', 'Total Tax', 'Total Tax', '2020-11-02 13:02:42', '2020-11-02 13:02:42'),
(513, 'en', 'Grand Total', 'Grand Total', '2020-11-02 13:02:42', '2020-11-02 13:02:42'),
(514, 'en', 'Your order has been placed successfully. Please submit payment information from purchase history', 'Your order has been placed successfully. Please submit payment information from purchase history', '2020-11-02 13:02:47', '2020-11-02 13:02:47'),
(515, 'en', 'Thank You for Your Order!', 'Thank You for Your Order!', '2020-11-02 13:02:48', '2020-11-02 13:02:48'),
(516, 'en', 'Order Code:', 'Order Code:', '2020-11-02 13:02:48', '2020-11-02 13:02:48'),
(517, 'en', 'A copy or your order summary has been sent to', 'A copy or your order summary has been sent to', '2020-11-02 13:02:48', '2020-11-02 13:02:48'),
(518, 'en', 'Make Payment', 'Make Payment', '2020-11-02 13:03:26', '2020-11-02 13:03:26'),
(519, 'en', 'Payment screenshot', 'Payment screenshot', '2020-11-02 13:03:29', '2020-11-02 13:03:29'),
(520, 'en', 'Paypal Credential', 'Paypal Credential', '2020-11-02 13:12:20', '2020-11-02 13:12:20'),
(522, 'en', 'Paypal Client ID', 'Paypal Client ID', '2020-11-02 13:12:20', '2020-11-02 13:12:20'),
(523, 'en', 'Paypal Client Secret', 'Paypal Client Secret', '2020-11-02 13:12:20', '2020-11-02 13:12:20'),
(524, 'en', 'Paypal Sandbox Mode', 'Paypal Sandbox Mode', '2020-11-02 13:12:20', '2020-11-02 13:12:20'),
(525, 'en', 'Sslcommerz Credential', 'Sslcommerz Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(526, 'en', 'Sslcz Store Id', 'Sslcz Store Id', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(527, 'en', 'Sslcz store password', 'Sslcz store password', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(528, 'en', 'Sslcommerz Sandbox Mode', 'Sslcommerz Sandbox Mode', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(529, 'en', 'Stripe Credential', 'Stripe Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(531, 'en', 'STRIPE KEY', 'STRIPE KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(533, 'en', 'STRIPE SECRET', 'STRIPE SECRET', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(534, 'en', 'RazorPay Credential', 'RazorPay Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(535, 'en', 'RAZOR KEY', 'RAZOR KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(536, 'en', 'RAZOR SECRET', 'RAZOR SECRET', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(537, 'en', 'Instamojo Credential', 'Instamojo Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(538, 'en', 'API KEY', 'API KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(539, 'en', 'IM API KEY', 'IM API KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(540, 'en', 'AUTH TOKEN', 'AUTH TOKEN', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(541, 'en', 'IM AUTH TOKEN', 'IM AUTH TOKEN', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(542, 'en', 'Instamojo Sandbox Mode', 'Instamojo Sandbox Mode', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(543, 'en', 'PayStack Credential', 'PayStack Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(544, 'en', 'PUBLIC KEY', 'PUBLIC KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(545, 'en', 'SECRET KEY', 'SECRET KEY', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(546, 'en', 'MERCHANT EMAIL', 'MERCHANT EMAIL', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(547, 'en', 'VoguePay Credential', 'VoguePay Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(548, 'en', 'MERCHANT ID', 'MERCHANT ID', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(549, 'en', 'Sandbox Mode', 'Sandbox Mode', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(550, 'en', 'Payhere Credential', 'Payhere Credential', '2020-11-02 13:12:21', '2020-11-02 13:12:21'),
(551, 'en', 'PAYHERE MERCHANT ID', 'PAYHERE MERCHANT ID', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(552, 'en', 'PAYHERE SECRET', 'PAYHERE SECRET', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(553, 'en', 'PAYHERE CURRENCY', 'PAYHERE CURRENCY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(554, 'en', 'Payhere Sandbox Mode', 'Payhere Sandbox Mode', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(555, 'en', 'Ngenius Credential', 'Ngenius Credential', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(556, 'en', 'NGENIUS OUTLET ID', 'NGENIUS OUTLET ID', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(557, 'en', 'NGENIUS API KEY', 'NGENIUS API KEY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(558, 'en', 'NGENIUS CURRENCY', 'NGENIUS CURRENCY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(559, 'en', 'Mpesa Credential', 'Mpesa Credential', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(560, 'en', 'MPESA CONSUMER KEY', 'MPESA CONSUMER KEY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(561, 'en', 'MPESA_CONSUMER_KEY', 'MPESA_CONSUMER_KEY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(562, 'en', 'MPESA CONSUMER SECRET', 'MPESA CONSUMER SECRET', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(563, 'en', 'MPESA_CONSUMER_SECRET', 'MPESA_CONSUMER_SECRET', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(564, 'en', 'MPESA SHORT CODE', 'MPESA SHORT CODE', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(565, 'en', 'MPESA_SHORT_CODE', 'MPESA_SHORT_CODE', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(566, 'en', 'MPESA SANDBOX ACTIVATION', 'MPESA SANDBOX ACTIVATION', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(567, 'en', 'Flutterwave Credential', 'Flutterwave Credential', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(568, 'en', 'RAVE_PUBLIC_KEY', 'RAVE_PUBLIC_KEY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(569, 'en', 'RAVE_SECRET_KEY', 'RAVE_SECRET_KEY', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(570, 'en', 'RAVE_TITLE', 'RAVE_TITLE', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(571, 'en', 'STAGIN ACTIVATION', 'STAGIN ACTIVATION', '2020-11-02 13:12:22', '2020-11-02 13:12:22'),
(573, 'en', 'All Product', 'All Product', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(574, 'en', 'Sort By', 'Sort By', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(575, 'en', 'Rating (High > Low)', 'Rating (High > Low)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(576, 'en', 'Rating (Low > High)', 'Rating (Low > High)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(577, 'en', 'Num of Sale (High > Low)', 'Num of Sale (High > Low)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(578, 'en', 'Num of Sale (Low > High)', 'Num of Sale (Low > High)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(579, 'en', 'Base Price (High > Low)', 'Base Price (High > Low)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(580, 'en', 'Base Price (Low > High)', 'Base Price (Low > High)', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(581, 'en', 'Type & Enter', 'Type & Enter', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(582, 'en', 'Added By', 'Added By', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(583, 'en', 'Num of Sale', 'Num of Sale', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(584, 'en', 'Total Stock', 'Total Stock', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(585, 'en', 'Todays Deal', 'Todays Deal', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(586, 'en', 'Rating', 'Rating', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(587, 'en', 'times', 'times', '2020-11-02 13:15:01', '2020-11-02 13:15:01'),
(588, 'en', 'Add Nerw Product', 'Add Nerw Product', '2020-11-02 13:15:02', '2020-11-02 13:15:02'),
(589, 'en', 'Product Information', 'Product Information', '2020-11-02 13:15:02', '2020-11-02 13:15:02'),
(590, 'en', 'Unit', 'Unit', '2020-11-02 13:15:02', '2020-11-02 13:15:02'),
(591, 'en', 'Unit (e.g. KG, Pc etc)', 'Unit (e.g. KG, Pc etc)', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(592, 'en', 'Minimum Qty', 'Minimum Qty', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(593, 'en', 'Tags', 'Tags', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(594, 'en', 'Type and hit enter to add a tag', 'Type and hit enter to add a tag', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(595, 'en', 'Barcode', 'Barcode', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(596, 'en', 'Refundable', 'Refundable', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(597, 'en', 'Product Images', 'Product Images', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(598, 'en', 'Gallery Images', 'Gallery Images', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(599, 'en', 'Todays Deal updated successfully', 'Todays Deal updated successfully', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(600, 'en', 'Published products updated successfully', 'Published products updated successfully', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(601, 'en', 'Thumbnail Image', 'Thumbnail Image', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(602, 'en', 'Featured products updated successfully', 'Featured products updated successfully', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(603, 'en', 'Product Videos', 'Product Videos', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(604, 'en', 'Video Provider', 'Video Provider', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(605, 'en', 'Youtube', 'Youtube', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(606, 'en', 'Dailymotion', 'Dailymotion', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(607, 'en', 'Vimeo', 'Vimeo', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(608, 'en', 'Video Link', 'Video Link', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(609, 'en', 'Product Variation', 'Product Variation', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(610, 'en', 'Colors', 'Colors', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(611, 'en', 'Attributes', 'Attributes', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(612, 'en', 'Choose Attributes', 'Choose Attributes', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(613, 'en', 'Choose the attributes of this product and then input values of each attribute', 'Choose the attributes of this product and then input values of each attribute', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(614, 'en', 'Product price + stock', 'Product price + stock', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(616, 'en', 'Unit price', 'Unit price', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(617, 'en', 'Purchase price', 'Purchase price', '2020-11-02 13:15:03', '2020-11-02 13:15:03'),
(618, 'en', 'Flat', 'Flat', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(619, 'en', 'Percent', 'Percent', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(620, 'en', 'Discount', 'Discount', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(621, 'en', 'Product Description', 'Product Description', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(622, 'en', 'Product Shipping Cost', 'Product Shipping Cost', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(623, 'en', 'Free Shipping', 'Free Shipping', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(624, 'en', 'Flat Rate', 'Flat Rate', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(625, 'en', 'Shipping cost', 'Shipping cost', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(626, 'en', 'PDF Specification', 'PDF Specification', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(627, 'en', 'SEO Meta Tags', 'SEO Meta Tags', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(628, 'en', 'Meta Title', 'Meta Title', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(629, 'en', 'Meta Image', 'Meta Image', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(630, 'en', 'Choice Title', 'Choice Title', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(631, 'en', 'Enter choice values', 'Enter choice values', '2020-11-02 13:15:04', '2020-11-02 13:15:04'),
(632, 'en', 'All categories', 'All categories', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(633, 'en', 'Add New category', 'Add New category', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(634, 'en', 'Type name & Enter', 'Type name & Enter', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(635, 'en', 'Banner', 'Banner', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(637, 'en', 'Commission', 'Commission', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(638, 'en', 'icon', 'icon', '2020-11-03 07:12:19', '2020-11-03 07:12:19'),
(639, 'en', 'Featured categories updated successfully', 'Featured categories updated successfully', '2020-11-03 07:12:20', '2020-11-03 07:12:20'),
(640, 'en', 'Hot', 'Hot', '2020-11-03 07:13:12', '2020-11-03 07:13:12'),
(641, 'en', 'Filter by Payment Status', 'Filter by Payment Status', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(642, 'en', 'Un-Paid', 'Un-Paid', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(643, 'en', 'Filter by Deliver Status', 'Filter by Deliver Status', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(644, 'en', 'Pending', 'Pending', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(645, 'en', 'Type Order code & hit Enter', 'Type Order code & hit Enter', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(646, 'en', 'Num. of Products', 'Num. of Products', '2020-11-03 07:15:15', '2020-11-03 07:15:15'),
(647, 'en', 'Walk In Customer', 'Walk In Customer', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(648, 'en', 'QTY', 'QTY', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(649, 'en', 'Without Shipping Charge', 'Without Shipping Charge', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(650, 'en', 'With Shipping Charge', 'With Shipping Charge', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(651, 'en', 'Pay With Cash', 'Pay With Cash', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(652, 'en', 'Shipping Address', 'Shipping Address', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(653, 'en', 'Close', 'Close', '2020-11-03 10:03:20', '2020-11-03 10:03:20'),
(654, 'en', 'Select country', 'Select country', '2020-11-03 10:03:21', '2020-11-03 10:03:21'),
(655, 'en', 'Order Confirmation', 'Order Confirmation', '2020-11-03 10:03:21', '2020-11-03 10:03:21'),
(656, 'en', 'Are you sure to confirm this order?', 'Are you sure to confirm this order?', '2020-11-03 10:03:21', '2020-11-03 10:03:21'),
(657, 'en', 'Comfirm Order', 'Comfirm Order', '2020-11-03 10:03:21', '2020-11-03 10:03:21'),
(659, 'en', 'Personal Info', 'Personal Info', '2020-11-03 11:38:15', '2020-11-03 11:38:15'),
(660, 'en', 'Repeat Password', 'Repeat Password', '2020-11-03 11:38:15', '2020-11-03 11:38:15'),
(661, 'en', 'Shop Name', 'Shop Name', '2020-11-03 11:38:15', '2020-11-03 11:38:15'),
(662, 'en', 'Register Your Shop', 'Register Your Shop', '2020-11-03 11:38:15', '2020-11-03 11:38:15'),
(663, 'en', 'Affiliate Informations', 'Affiliate Informations', '2020-11-03 11:39:06', '2020-11-03 11:39:06'),
(664, 'en', 'Affiliate', 'Affiliate', '2020-11-03 11:39:06', '2020-11-03 11:39:06'),
(665, 'en', 'User Info', 'User Info', '2020-11-03 11:39:06', '2020-11-03 11:39:06'),
(667, 'en', 'Installed Addon', 'Installed Addon', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(668, 'en', 'Available Addon', 'Available Addon', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(669, 'en', 'Install New Addon', 'Install New Addon', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(670, 'en', 'Version', 'Version', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(671, 'en', 'Activated', 'Activated', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(672, 'en', 'Deactivated', 'Deactivated', '2020-11-03 11:48:13', '2020-11-03 11:48:13'),
(673, 'en', 'Activate OTP', 'Activate OTP', '2020-11-03 11:48:20', '2020-11-03 11:48:20'),
(674, 'en', 'OTP will be Used For', 'OTP will be Used For', '2020-11-03 11:48:20', '2020-11-03 11:48:20'),
(675, 'en', 'Settings updated successfully', 'Settings updated successfully', '2020-11-03 11:48:20', '2020-11-03 11:48:20'),
(676, 'en', 'Product Owner', 'Product Owner', '2020-11-03 11:48:46', '2020-11-03 11:48:46'),
(677, 'en', 'Point', 'Point', '2020-11-03 11:48:46', '2020-11-03 11:48:46'),
(678, 'en', 'Set Point for Product Within a Range', 'Set Point for Product Within a Range', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(679, 'en', 'Set Point for multiple products', 'Set Point for multiple products', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(680, 'en', 'Min Price', 'Min Price', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(681, 'en', 'Max Price', 'Max Price', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(682, 'en', 'Set Point for all Products', 'Set Point for all Products', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(683, 'en', 'Set Point For ', 'Set Point For ', '2020-11-03 11:48:47', '2020-11-03 11:48:47'),
(684, 'en', 'Convert Status', 'Convert Status', '2020-11-03 11:48:58', '2020-11-03 11:48:58'),
(685, 'en', 'Earned At', 'Earned At', '2020-11-03 11:48:59', '2020-11-03 11:48:59'),
(686, 'en', 'Seller Based Selling Report', 'Seller Based Selling Report', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(687, 'en', 'Sort by verificarion status', 'Sort by verificarion status', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(688, 'en', 'Approved', 'Approved', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(689, 'en', 'Non Approved', 'Non Approved', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(690, 'en', 'Filter', 'Filter', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(691, 'en', 'Seller Name', 'Seller Name', '2020-11-03 11:49:35', '2020-11-03 11:49:35'),
(692, 'en', 'Number of Product Sale', 'Number of Product Sale', '2020-11-03 11:49:36', '2020-11-03 11:49:36'),
(693, 'en', 'Order Amount', 'Order Amount', '2020-11-03 11:49:36', '2020-11-03 11:49:36'),
(694, 'en', 'Facebook Chat Setting', 'Facebook Chat Setting', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(695, 'en', 'Facebook Page ID', 'Facebook Page ID', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(696, 'en', 'Please be carefull when you are configuring Facebook chat. For incorrect configuration you will not get messenger icon on your user-end site.', 'Please be carefull when you are configuring Facebook chat. For incorrect configuration you will not get messenger icon on your user-end site.', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(697, 'en', 'Login into your facebook page', 'Login into your facebook page', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(698, 'en', 'Find the About option of your facebook page', 'Find the About option of your facebook page', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(699, 'en', 'At the very bottom, you can find the \\“Facebook Page ID\\”', 'At the very bottom, you can find the \\“Facebook Page ID\\”', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(700, 'en', 'Go to Settings of your page and find the option of \\\"Advance Messaging\\\"', 'Go to Settings of your page and find the option of \\\"Advance Messaging\\\"', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(701, 'en', 'Scroll down that page and you will get \\\"white listed domain\\\"', 'Scroll down that page and you will get \\\"white listed domain\\\"', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(702, 'en', 'Set your website domain name', 'Set your website domain name', '2020-11-03 11:51:14', '2020-11-03 11:51:14'),
(703, 'en', 'Google reCAPTCHA Setting', 'Google reCAPTCHA Setting', '2020-11-03 11:51:25', '2020-11-03 11:51:25'),
(704, 'en', 'Site KEY', 'Site KEY', '2020-11-03 11:51:25', '2020-11-03 11:51:25'),
(705, 'en', 'Select Shipping Method', 'Select Shipping Method', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(706, 'en', 'Product Wise Shipping Cost', 'Product Wise Shipping Cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(707, 'en', 'Flat Rate Shipping Cost', 'Flat Rate Shipping Cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(708, 'en', 'Seller Wise Flat Shipping Cost', 'Seller Wise Flat Shipping Cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(709, 'en', 'Note', 'Note', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(710, 'en', 'Product Wise Shipping Cost calulation: Shipping cost is calculate by addition of each product shipping cost', 'Product Wise Shipping Cost calulation: Shipping cost is calculate by addition of each product shipping cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(711, 'en', 'Flat Rate Shipping Cost calulation: How many products a customer purchase, doesn\'t matter. Shipping cost is fixed', 'Flat Rate Shipping Cost calulation: How many products a customer purchase, doesn\'t matter. Shipping cost is fixed', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(712, 'en', 'Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If a customer purchase 2 product from two seller shipping cost is calculate by addition of each seller flat shipping cost', 'Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If a customer purchase 2 product from two seller shipping cost is calculate by addition of each seller flat shipping cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(713, 'en', 'Flat Rate Cost', 'Flat Rate Cost', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(714, 'en', 'Shipping Cost for Admin Products', 'Shipping Cost for Admin Products', '2020-11-03 11:51:32', '2020-11-03 11:51:32'),
(715, 'en', 'Countries', 'Countries', '2020-11-03 11:52:02', '2020-11-03 11:52:02'),
(716, 'en', 'Show/Hide', 'Show/Hide', '2020-11-03 11:52:02', '2020-11-03 11:52:02'),
(717, 'en', 'Country status updated successfully', 'Country status updated successfully', '2020-11-03 11:52:02', '2020-11-03 11:52:02'),
(718, 'en', 'All Subcategories', 'All Subcategories', '2020-11-03 12:27:55', '2020-11-03 12:27:55'),
(719, 'en', 'Add New Subcategory', 'Add New Subcategory', '2020-11-03 12:27:55', '2020-11-03 12:27:55'),
(720, 'en', 'Sub-Categories', 'Sub-Categories', '2020-11-03 12:27:55', '2020-11-03 12:27:55'),
(721, 'en', 'Sub Category Information', 'Sub Category Information', '2020-11-03 12:28:07', '2020-11-03 12:28:07'),
(723, 'en', 'Slug', 'Slug', '2020-11-03 12:28:07', '2020-11-03 12:28:07'),
(724, 'en', 'All Sub Subcategories', 'All Sub Subcategories', '2020-11-03 12:29:12', '2020-11-03 12:29:12');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(725, 'en', 'Add New Sub Subcategory', 'Add New Sub Subcategory', '2020-11-03 12:29:12', '2020-11-03 12:29:12'),
(726, 'en', 'Sub-Sub-categories', 'Sub-Sub-categories', '2020-11-03 12:29:12', '2020-11-03 12:29:12'),
(727, 'en', 'Make This Default', 'Make This Default', '2020-11-04 08:24:24', '2020-11-04 08:24:24'),
(728, 'en', 'Shops', 'Shops', '2020-11-04 11:17:10', '2020-11-04 11:17:10'),
(729, 'en', 'Women Clothing & Fashion', 'Women Clothing & Fashion', '2020-11-04 11:23:12', '2020-11-04 11:23:12'),
(730, 'en', 'Cellphones & Tabs', 'Cellphones & Tabs', '2020-11-04 12:10:41', '2020-11-04 12:10:41'),
(731, 'en', 'Welcome to', 'Welcome to', '2020-11-07 07:14:43', '2020-11-07 07:14:43'),
(732, 'en', 'Create a New Account', 'Create a New Account', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(733, 'en', 'Full Name', 'Full Name', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(734, 'en', 'password', 'password', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(735, 'en', 'Confrim Password', 'Confrim Password', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(736, 'en', 'I agree with the', 'I agree with the', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(737, 'en', 'Terms and Conditions', 'Terms and Conditions', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(738, 'en', 'Register', 'Register', '2020-11-07 07:32:15', '2020-11-07 07:32:15'),
(739, 'en', 'Already have an account', 'Already have an account', '2020-11-07 07:32:16', '2020-11-07 07:32:16'),
(741, 'en', 'Sign Up with', 'Sign Up with', '2020-11-07 07:32:16', '2020-11-07 07:32:16'),
(742, 'en', 'I agree with the Terms and Conditions', 'I agree with the Terms and Conditions', '2020-11-07 07:34:49', '2020-11-07 07:34:49'),
(745, 'en', 'All Role', 'All Role', '2020-11-07 07:44:28', '2020-11-07 07:44:28'),
(746, 'en', 'Add New Role', 'Add New Role', '2020-11-07 07:44:28', '2020-11-07 07:44:28'),
(747, 'en', 'Roles', 'Roles', '2020-11-07 07:44:28', '2020-11-07 07:44:28'),
(749, 'en', 'Add New Staffs', 'Add New Staffs', '2020-11-07 07:44:36', '2020-11-07 07:44:36'),
(750, 'en', 'Role', 'Role', '2020-11-07 07:44:36', '2020-11-07 07:44:36'),
(751, 'en', 'Frontend Website Name', 'Frontend Website Name', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(752, 'en', 'Website Name', 'Website Name', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(753, 'en', 'Site Motto', 'Site Motto', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(754, 'en', 'Best eCommerce Website', 'Best eCommerce Website', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(755, 'en', 'Site Icon', 'Site Icon', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(756, 'en', 'Website favicon. 32x32 .png', 'Website favicon. 32x32 .png', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(757, 'en', 'Website Base Color', 'Website Base Color', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(758, 'en', 'Hex Color Code', 'Hex Color Code', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(759, 'en', 'Website Base Hover Color', 'Website Base Hover Color', '2020-11-07 07:44:59', '2020-11-07 07:44:59'),
(760, 'en', 'Update', 'Update', '2020-11-07 07:45:00', '2020-11-07 07:45:00'),
(761, 'en', 'Global Seo', 'Global Seo', '2020-11-07 07:45:00', '2020-11-07 07:45:00'),
(762, 'en', 'Meta description', 'Meta description', '2020-11-07 07:45:00', '2020-11-07 07:45:00'),
(763, 'en', 'Keywords', 'Keywords', '2020-11-07 07:45:00', '2020-11-07 07:45:00'),
(764, 'en', 'Separate with coma', 'Separate with coma', '2020-11-07 07:45:00', '2020-11-07 07:45:00'),
(765, 'en', 'Website Pages', 'Website Pages', '2020-11-07 07:49:04', '2020-11-07 07:49:04'),
(766, 'en', 'All Pages', 'All Pages', '2020-11-07 07:49:04', '2020-11-07 07:49:04'),
(767, 'en', 'Add New Page', 'Add New Page', '2020-11-07 07:49:04', '2020-11-07 07:49:04'),
(768, 'en', 'URL', 'URL', '2020-11-07 07:49:04', '2020-11-07 07:49:04'),
(769, 'en', 'Actions', 'Actions', '2020-11-07 07:49:04', '2020-11-07 07:49:04'),
(770, 'en', 'Edit Page Information', 'Edit Page Information', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(771, 'en', 'Page Content', 'Page Content', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(772, 'en', 'Title', 'Title', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(773, 'en', 'Link', 'Link', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(774, 'en', 'Use character, number, hypen only', 'Use character, number, hypen only', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(775, 'en', 'Add Content', 'Add Content', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(776, 'en', 'Seo Fields', 'Seo Fields', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(777, 'en', 'Update Page', 'Update Page', '2020-11-07 07:49:22', '2020-11-07 07:49:22'),
(778, 'en', 'Default Language', 'Default Language', '2020-11-07 07:50:09', '2020-11-07 07:50:09'),
(779, 'en', 'Add New Language', 'Add New Language', '2020-11-07 07:50:09', '2020-11-07 07:50:09'),
(780, 'en', 'RTL', 'RTL', '2020-11-07 07:50:09', '2020-11-07 07:50:09'),
(781, 'en', 'Translation', 'Translation', '2020-11-07 07:50:09', '2020-11-07 07:50:09'),
(782, 'en', 'Language Information', 'Language Information', '2020-11-07 07:50:23', '2020-11-07 07:50:23'),
(783, 'en', 'Save Page', 'Save Page', '2020-11-07 07:51:27', '2020-11-07 07:51:27'),
(784, 'en', 'Home Page Settings', 'Home Page Settings', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(785, 'en', 'Home Slider', 'Home Slider', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(786, 'en', 'Photos & Links', 'Photos & Links', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(787, 'en', 'Add New', 'Add New', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(788, 'en', 'Home Categories', 'Home Categories', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(789, 'en', 'Home Banner 1 (Max 3)', 'Home Banner 1 (Max 3)', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(790, 'en', 'Banner & Links', 'Banner & Links', '2020-11-07 07:51:35', '2020-11-07 07:51:35'),
(791, 'en', 'Home Banner 2 (Max 3)', 'Home Banner 2 (Max 3)', '2020-11-07 07:51:36', '2020-11-07 07:51:36'),
(792, 'en', 'Top 10', 'Top 10', '2020-11-07 07:51:36', '2020-11-07 07:51:36'),
(793, 'en', 'Top Categories (Max 10)', 'Top Categories (Max 10)', '2020-11-07 07:51:36', '2020-11-07 07:51:36'),
(794, 'en', 'Top Brands (Max 10)', 'Top Brands (Max 10)', '2020-11-07 07:51:36', '2020-11-07 07:51:36'),
(795, 'en', 'System Name', 'System Name', '2020-11-07 07:54:22', '2020-11-07 07:54:22'),
(796, 'en', 'System Logo - White', 'System Logo - White', '2020-11-07 07:54:22', '2020-11-07 07:54:22'),
(797, 'en', 'Choose Files', 'Choose Files', '2020-11-07 07:54:22', '2020-11-07 07:54:22'),
(798, 'en', 'Will be used in admin panel side menu', 'Will be used in admin panel side menu', '2020-11-07 07:54:23', '2020-11-07 07:54:23'),
(799, 'en', 'System Logo - Black', 'System Logo - Black', '2020-11-07 07:54:23', '2020-11-07 07:54:23'),
(800, 'en', 'Will be used in admin panel topbar in mobile + Admin login page', 'Will be used in admin panel topbar in mobile + Admin login page', '2020-11-07 07:54:23', '2020-11-07 07:54:23'),
(801, 'en', 'System Timezone', 'System Timezone', '2020-11-07 07:54:23', '2020-11-07 07:54:23'),
(802, 'en', 'Admin login page background', 'Admin login page background', '2020-11-07 07:54:23', '2020-11-07 07:54:23'),
(803, 'en', 'Website Header', 'Website Header', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(804, 'en', 'Header Setting', 'Header Setting', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(805, 'en', 'Header Logo', 'Header Logo', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(806, 'en', 'Show Language Switcher?', 'Show Language Switcher?', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(807, 'en', 'Show Currency Switcher?', 'Show Currency Switcher?', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(808, 'en', 'Enable stikcy header?', 'Enable stikcy header?', '2020-11-07 08:21:36', '2020-11-07 08:21:36'),
(809, 'en', 'Website Footer', 'Website Footer', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(810, 'en', 'Footer Widget', 'Footer Widget', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(811, 'en', 'About Widget', 'About Widget', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(812, 'en', 'Footer Logo', 'Footer Logo', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(813, 'en', 'About description', 'About description', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(814, 'en', 'Contact Info Widget', 'Contact Info Widget', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(815, 'en', 'Footer contact address', 'Footer contact address', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(816, 'en', 'Footer contact phone', 'Footer contact phone', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(817, 'en', 'Footer contact email', 'Footer contact email', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(818, 'en', 'Link Widget One', 'Link Widget One', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(819, 'en', 'Links', 'Links', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(820, 'en', 'Footer Bottom', 'Footer Bottom', '2020-11-07 08:21:56', '2020-11-07 08:21:56'),
(821, 'en', 'Copyright Widget ', 'Copyright Widget ', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(822, 'en', 'Copyright Text', 'Copyright Text', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(823, 'en', 'Social Link Widget ', 'Social Link Widget ', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(824, 'en', 'Show Social Links?', 'Show Social Links?', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(825, 'en', 'Social Links', 'Social Links', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(826, 'en', 'Payment Methods Widget ', 'Payment Methods Widget ', '2020-11-07 08:21:57', '2020-11-07 08:21:57'),
(827, 'en', 'RTL status updated successfully', 'RTL status updated successfully', '2020-11-07 08:36:11', '2020-11-07 08:36:11'),
(828, 'en', 'Language changed to ', 'Language changed to ', '2020-11-07 08:36:27', '2020-11-07 08:36:27'),
(829, 'en', 'Inhouse Product sale report', 'Inhouse Product sale report', '2020-11-07 09:30:25', '2020-11-07 09:30:25'),
(830, 'en', 'Sort by Category', 'Sort by Category', '2020-11-07 09:30:25', '2020-11-07 09:30:25'),
(831, 'en', 'Product wise stock report', 'Product wise stock report', '2020-11-07 09:31:02', '2020-11-07 09:31:02'),
(832, 'en', 'Currency changed to ', 'Currency changed to ', '2020-11-07 12:36:28', '2020-11-07 12:36:28'),
(833, 'en', 'Avatar', 'Avatar', '2020-11-08 09:32:35', '2020-11-08 09:32:35'),
(834, 'en', 'Copy', 'Copy', '2020-11-08 10:03:42', '2020-11-08 10:03:42'),
(835, 'en', 'Variant', 'Variant', '2020-11-08 10:43:02', '2020-11-08 10:43:02'),
(836, 'en', 'Variant Price', 'Variant Price', '2020-11-08 10:43:03', '2020-11-08 10:43:03'),
(837, 'en', 'SKU', 'SKU', '2020-11-08 10:43:03', '2020-11-08 10:43:03'),
(838, 'en', 'Key', 'Key', '2020-11-08 12:35:09', '2020-11-08 12:35:09'),
(839, 'en', 'Value', 'Value', '2020-11-08 12:35:09', '2020-11-08 12:35:09'),
(840, 'en', 'Copy Translations', 'Copy Translations', '2020-11-08 12:35:10', '2020-11-08 12:35:10'),
(841, 'en', 'All Pick-up Points', 'All Pick-up Points', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(842, 'en', 'Add New Pick-up Point', 'Add New Pick-up Point', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(843, 'en', 'Manager', 'Manager', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(844, 'en', 'Location', 'Location', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(845, 'en', 'Pickup Station Contact', 'Pickup Station Contact', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(846, 'en', 'Open', 'Open', '2020-11-08 12:35:43', '2020-11-08 12:35:43'),
(847, 'en', 'POS Activation for Seller', 'POS Activation for Seller', '2020-11-08 12:35:55', '2020-11-08 12:35:55'),
(848, 'en', 'Order Completed Successfully.', 'Order Completed Successfully.', '2020-11-08 12:36:02', '2020-11-08 12:36:02'),
(849, 'en', 'Text Input', 'Text Input', '2020-11-08 12:38:40', '2020-11-08 12:38:40'),
(850, 'en', 'Select', 'Select', '2020-11-08 12:38:40', '2020-11-08 12:38:40'),
(851, 'en', 'Multiple Select', 'Multiple Select', '2020-11-08 12:38:40', '2020-11-08 12:38:40'),
(852, 'en', 'Radio', 'Radio', '2020-11-08 12:38:40', '2020-11-08 12:38:40'),
(853, 'en', 'File', 'File', '2020-11-08 12:38:40', '2020-11-08 12:38:40'),
(854, 'en', 'Email Address', 'Email Address', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(855, 'en', 'Verification Info', 'Verification Info', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(856, 'en', 'Approval', 'Approval', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(857, 'en', 'Due Amount', 'Due Amount', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(858, 'en', 'Show', 'Show', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(859, 'en', 'Pay Now', 'Pay Now', '2020-11-08 12:39:32', '2020-11-08 12:39:32'),
(860, 'en', 'Affiliate User Verification', 'Affiliate User Verification', '2020-11-08 12:40:01', '2020-11-08 12:40:01'),
(861, 'en', 'Reject', 'Reject', '2020-11-08 12:40:01', '2020-11-08 12:40:01'),
(862, 'en', 'Accept', 'Accept', '2020-11-08 12:40:01', '2020-11-08 12:40:01'),
(863, 'en', 'Beauty, Health & Hair', 'Beauty, Health & Hair', '2020-11-08 12:54:17', '2020-11-08 12:54:17'),
(864, 'en', 'Comparison', 'Comparison', '2020-11-08 12:54:33', '2020-11-08 12:54:33'),
(865, 'en', 'Reset Compare List', 'Reset Compare List', '2020-11-08 12:54:33', '2020-11-08 12:54:33'),
(866, 'en', 'Your comparison list is empty', 'Your comparison list is empty', '2020-11-08 12:54:33', '2020-11-08 12:54:33'),
(867, 'en', 'Convert Point To Wallet', 'Convert Point To Wallet', '2020-11-08 13:04:42', '2020-11-08 13:04:42'),
(868, 'en', 'Note: You need to activate wallet option first before using club point addon.', 'Note: You need to activate wallet option first before using club point addon.', '2020-11-08 13:04:43', '2020-11-08 13:04:43'),
(869, 'en', 'Create an account.', 'Create an account.', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(870, 'en', 'Use Email Instead', 'Use Email Instead', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(871, 'en', 'By signing up you agree to our terms and conditions.', 'By signing up you agree to our terms and conditions.', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(872, 'en', 'Create Account', 'Create Account', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(873, 'en', 'Or Join With', 'Or Join With', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(874, 'en', 'Already have an account?', 'Already have an account?', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(875, 'en', 'Log In', 'Log In', '2020-11-09 06:17:11', '2020-11-09 06:17:11'),
(876, 'en', 'Computer & Accessories', 'Computer & Accessories', '2020-11-09 07:52:05', '2020-11-09 07:52:05'),
(878, 'en', 'Product(s)', 'Product(s)', '2020-11-09 07:52:23', '2020-11-09 07:52:23'),
(879, 'en', 'in your cart', 'in your cart', '2020-11-09 07:52:23', '2020-11-09 07:52:23'),
(880, 'en', 'in your wishlist', 'in your wishlist', '2020-11-09 07:52:23', '2020-11-09 07:52:23'),
(881, 'en', 'you ordered', 'you ordered', '2020-11-09 07:52:24', '2020-11-09 07:52:24'),
(882, 'en', 'Default Shipping Address', 'Default Shipping Address', '2020-11-09 07:52:24', '2020-11-09 07:52:24'),
(883, 'en', 'Sports & outdoor', 'Sports & outdoor', '2020-11-09 07:53:32', '2020-11-09 07:53:32'),
(884, 'en', 'Copied', 'Copied', '2020-11-09 07:54:19', '2020-11-09 07:54:19'),
(885, 'en', 'Copy the Promote Link', 'Copy the Promote Link', '2020-11-09 07:54:19', '2020-11-09 07:54:19'),
(886, 'en', 'Write a review', 'Write a review', '2020-11-09 07:54:20', '2020-11-09 07:54:20'),
(887, 'en', 'Your name', 'Your name', '2020-11-09 07:54:20', '2020-11-09 07:54:20'),
(888, 'en', 'Comment', 'Comment', '2020-11-09 07:54:20', '2020-11-09 07:54:20'),
(889, 'en', 'Your review', 'Your review', '2020-11-09 07:54:20', '2020-11-09 07:54:20'),
(890, 'en', 'Submit review', 'Submit review', '2020-11-09 07:54:20', '2020-11-09 07:54:20'),
(891, 'en', 'Claire Willis', 'Claire Willis', '2020-11-09 08:05:00', '2020-11-09 08:05:00'),
(892, 'en', 'Germaine Greene', 'Germaine Greene', '2020-11-09 08:05:00', '2020-11-09 08:05:00'),
(893, 'en', 'Product File', 'Product File', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(894, 'en', 'Choose file', 'Choose file', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(895, 'en', 'Type to add a tag', 'Type to add a tag', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(896, 'en', 'Images', 'Images', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(897, 'en', 'Main Images', 'Main Images', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(898, 'en', 'Meta Tags', 'Meta Tags', '2020-11-09 08:07:08', '2020-11-09 08:07:08'),
(899, 'en', 'Digital Product has been inserted successfully', 'Digital Product has been inserted successfully', '2020-11-09 08:14:25', '2020-11-09 08:14:25'),
(900, 'en', 'Edit Digital Product', 'Edit Digital Product', '2020-11-09 08:14:34', '2020-11-09 08:14:34'),
(901, 'en', 'Select an option', 'Select an option', '2020-11-09 08:14:34', '2020-11-09 08:14:34'),
(902, 'en', 'tax', 'tax', '2020-11-09 08:14:35', '2020-11-09 08:14:35'),
(903, 'en', 'Any question about this product?', 'Any question about this product?', '2020-11-09 08:15:11', '2020-11-09 08:15:11'),
(904, 'en', 'Sign in', 'Sign in', '2020-11-09 08:15:11', '2020-11-09 08:15:11'),
(905, 'en', 'Login with Google', 'Login with Google', '2020-11-09 08:15:11', '2020-11-09 08:15:11'),
(906, 'en', 'Login with Facebook', 'Login with Facebook', '2020-11-09 08:15:11', '2020-11-09 08:15:11'),
(907, 'en', 'Login with Twitter', 'Login with Twitter', '2020-11-09 08:15:11', '2020-11-09 08:15:11'),
(908, 'en', 'Click to show phone number', 'Click to show phone number', '2020-11-09 08:15:51', '2020-11-09 08:15:51'),
(909, 'en', 'Other Ads of', 'Other Ads of', '2020-11-09 08:15:52', '2020-11-09 08:15:52'),
(910, 'en', 'Store Home', 'Store Home', '2020-11-09 08:54:23', '2020-11-09 08:54:23'),
(911, 'en', 'Top Selling', 'Top Selling', '2020-11-09 08:54:23', '2020-11-09 08:54:23'),
(912, 'en', 'Shop Settings', 'Shop Settings', '2020-11-09 08:55:38', '2020-11-09 08:55:38'),
(913, 'en', 'Visit Shop', 'Visit Shop', '2020-11-09 08:55:38', '2020-11-09 08:55:38'),
(914, 'en', 'Pickup Points', 'Pickup Points', '2020-11-09 08:55:38', '2020-11-09 08:55:38'),
(915, 'en', 'Select Pickup Point', 'Select Pickup Point', '2020-11-09 08:55:38', '2020-11-09 08:55:38'),
(916, 'en', 'Slider Settings', 'Slider Settings', '2020-11-09 08:55:39', '2020-11-09 08:55:39'),
(917, 'en', 'Social Media Link', 'Social Media Link', '2020-11-09 08:55:39', '2020-11-09 08:55:39'),
(918, 'en', 'Facebook', 'Facebook', '2020-11-09 08:55:39', '2020-11-09 08:55:39'),
(919, 'en', 'Twitter', 'Twitter', '2020-11-09 08:55:39', '2020-11-09 08:55:39'),
(920, 'en', 'Google', 'Google', '2020-11-09 08:55:39', '2020-11-09 08:55:39'),
(921, 'en', 'New Arrival Products', 'New Arrival Products', '2020-11-09 08:56:26', '2020-11-09 08:56:26'),
(922, 'en', 'Check Your Order Status', 'Check Your Order Status', '2020-11-09 09:23:32', '2020-11-09 09:23:32'),
(923, 'en', 'Shipping method', 'Shipping method', '2020-11-09 09:27:40', '2020-11-09 09:27:40'),
(924, 'en', 'Shipped By', 'Shipped By', '2020-11-09 09:27:41', '2020-11-09 09:27:41'),
(925, 'en', 'Image', 'Image', '2020-11-09 09:29:37', '2020-11-09 09:29:37'),
(926, 'en', 'Sub Sub Category', 'Sub Sub Category', '2020-11-09 09:29:37', '2020-11-09 09:29:37'),
(927, 'en', 'Inhouse Products', 'Inhouse Products', '2020-11-09 10:22:32', '2020-11-09 10:22:32'),
(928, 'en', 'Forgot Password?', 'Forgot Password?', '2020-11-09 10:33:21', '2020-11-09 10:33:21'),
(929, 'en', 'Enter your email address to recover your password.', 'Enter your email address to recover your password.', '2020-11-09 10:33:21', '2020-11-09 10:33:21'),
(930, 'en', 'Email or Phone', 'Email or Phone', '2020-11-09 10:33:21', '2020-11-09 10:33:21'),
(931, 'en', 'Send Password Reset Link', 'Send Password Reset Link', '2020-11-09 10:33:21', '2020-11-09 10:33:21'),
(932, 'en', 'Back to Login', 'Back to Login', '2020-11-09 10:33:21', '2020-11-09 10:33:21'),
(933, 'en', 'index', 'index', '2020-11-09 10:35:29', '2020-11-09 10:35:29'),
(934, 'en', 'Download Your Product', 'Download Your Product', '2020-11-09 10:35:30', '2020-11-09 10:35:30'),
(935, 'en', 'Option', 'Option', '2020-11-09 10:35:30', '2020-11-09 10:35:30'),
(936, 'en', 'Applied Refund Request', 'Applied Refund Request', '2020-11-09 10:35:39', '2020-11-09 10:35:39'),
(937, 'en', 'Item has been renoved from wishlist', 'Item has been renoved from wishlist', '2020-11-09 10:36:04', '2020-11-09 10:36:04'),
(938, 'en', 'Bulk Products Upload', 'Bulk Products Upload', '2020-11-09 10:39:24', '2020-11-09 10:39:24'),
(939, 'en', 'Upload CSV', 'Upload CSV', '2020-11-09 10:39:25', '2020-11-09 10:39:25'),
(940, 'en', 'Create a Ticket', 'Create a Ticket', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(941, 'en', 'Tickets', 'Tickets', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(942, 'en', 'Ticket ID', 'Ticket ID', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(943, 'en', 'Sending Date', 'Sending Date', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(944, 'en', 'Subject', 'Subject', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(945, 'en', 'View Details', 'View Details', '2020-11-09 10:40:25', '2020-11-09 10:40:25'),
(946, 'en', 'Provide a detailed description', 'Provide a detailed description', '2020-11-09 10:40:26', '2020-11-09 10:40:26'),
(947, 'en', 'Type your reply', 'Type your reply', '2020-11-09 10:40:26', '2020-11-09 10:40:26'),
(948, 'en', 'Send Ticket', 'Send Ticket', '2020-11-09 10:40:26', '2020-11-09 10:40:26'),
(949, 'en', 'Load More', 'Load More', '2020-11-09 10:40:57', '2020-11-09 10:40:57'),
(950, 'en', 'Jewelry & Watches', 'Jewelry & Watches', '2020-11-09 10:47:38', '2020-11-09 10:47:38'),
(951, 'en', 'Filters', 'Filters', '2020-11-09 10:53:54', '2020-11-09 10:53:54'),
(952, 'en', 'Contact address', 'Contact address', '2020-11-09 10:58:46', '2020-11-09 10:58:46'),
(953, 'en', 'Contact phone', 'Contact phone', '2020-11-09 10:58:47', '2020-11-09 10:58:47'),
(954, 'en', 'Contact email', 'Contact email', '2020-11-09 10:58:47', '2020-11-09 10:58:47'),
(955, 'en', 'Filter by', 'Filter by', '2020-11-09 11:00:03', '2020-11-09 11:00:03'),
(956, 'en', 'Condition', 'Condition', '2020-11-09 11:56:13', '2020-11-09 11:56:13'),
(957, 'en', 'All Type', 'All Type', '2020-11-09 11:56:13', '2020-11-09 11:56:13'),
(960, 'en', 'Pay with wallet', 'Pay with wallet', '2020-11-09 12:56:34', '2020-11-09 12:56:34'),
(961, 'en', 'Select variation', 'Select variation', '2020-11-10 07:54:29', '2020-11-10 07:54:29'),
(962, 'en', 'No Product Added', 'No Product Added', '2020-11-10 08:07:53', '2020-11-10 08:07:53'),
(963, 'en', 'Status has been updated successfully', 'Status has been updated successfully', '2020-11-10 08:41:23', '2020-11-10 08:41:23'),
(964, 'en', 'All Seller Packages', 'All Seller Packages', '2020-11-10 09:14:10', '2020-11-10 09:14:10'),
(965, 'en', 'Add New Package', 'Add New Package', '2020-11-10 09:14:10', '2020-11-10 09:14:10'),
(966, 'en', 'Package Logo', 'Package Logo', '2020-11-10 09:14:10', '2020-11-10 09:14:10'),
(967, 'en', 'days', 'days', '2020-11-10 09:14:10', '2020-11-10 09:14:10'),
(968, 'en', 'Create New Seller Package', 'Create New Seller Package', '2020-11-10 09:14:31', '2020-11-10 09:14:31'),
(969, 'en', 'Package Name', 'Package Name', '2020-11-10 09:14:31', '2020-11-10 09:14:31'),
(970, 'en', 'Duration', 'Duration', '2020-11-10 09:14:31', '2020-11-10 09:14:31'),
(971, 'en', 'Validity in number of days', 'Validity in number of days', '2020-11-10 09:14:31', '2020-11-10 09:14:31'),
(972, 'en', 'Update Package Information', 'Update Package Information', '2020-11-10 09:14:59', '2020-11-10 09:14:59'),
(973, 'en', 'Package has been inserted successfully', 'Package has been inserted successfully', '2020-11-10 09:15:14', '2020-11-10 09:15:14'),
(974, 'en', 'Refund Request', 'Refund Request', '2020-11-10 09:17:25', '2020-11-10 09:17:25'),
(975, 'en', 'Reason', 'Reason', '2020-11-10 09:17:25', '2020-11-10 09:17:25'),
(976, 'en', 'Label', 'Label', '2020-11-10 09:20:13', '2020-11-10 09:20:13'),
(977, 'en', 'Select Label', 'Select Label', '2020-11-10 09:20:13', '2020-11-10 09:20:13'),
(978, 'en', 'Multiple Select Label', 'Multiple Select Label', '2020-11-10 09:20:13', '2020-11-10 09:20:13'),
(979, 'en', 'Radio Label', 'Radio Label', '2020-11-10 09:20:13', '2020-11-10 09:20:13'),
(980, 'en', 'Pickup Point Orders', 'Pickup Point Orders', '2020-11-10 09:25:40', '2020-11-10 09:25:40'),
(981, 'en', 'View', 'View', '2020-11-10 09:25:40', '2020-11-10 09:25:40'),
(982, 'en', 'Order #', 'Order #', '2020-11-10 09:25:48', '2020-11-10 09:25:48'),
(983, 'en', 'Order Status', 'Order Status', '2020-11-10 09:25:48', '2020-11-10 09:25:48'),
(984, 'en', 'Total amount', 'Total amount', '2020-11-10 09:25:48', '2020-11-10 09:25:48'),
(986, 'en', 'TOTAL', 'TOTAL', '2020-11-10 09:25:49', '2020-11-10 09:25:49'),
(987, 'en', 'Delivery status has been updated', 'Delivery status has been updated', '2020-11-10 09:25:49', '2020-11-10 09:25:49'),
(988, 'en', 'Payment status has been updated', 'Payment status has been updated', '2020-11-10 09:25:49', '2020-11-10 09:25:49'),
(989, 'en', 'INVOICE', 'INVOICE', '2020-11-10 09:25:58', '2020-11-10 09:25:58'),
(990, 'en', 'Set Refund Time', 'Set Refund Time', '2020-11-10 09:34:04', '2020-11-10 09:34:04'),
(991, 'en', 'Set Time for sending Refund Request', 'Set Time for sending Refund Request', '2020-11-10 09:34:04', '2020-11-10 09:34:04'),
(992, 'en', 'Set Refund Sticker', 'Set Refund Sticker', '2020-11-10 09:34:05', '2020-11-10 09:34:05'),
(993, 'en', 'Sticker', 'Sticker', '2020-11-10 09:34:05', '2020-11-10 09:34:05'),
(994, 'en', 'Refund Request All', 'Refund Request All', '2020-11-10 09:34:12', '2020-11-10 09:34:12'),
(995, 'en', 'Order Id', 'Order Id', '2020-11-10 09:34:12', '2020-11-10 09:34:12'),
(996, 'en', 'Seller Approval', 'Seller Approval', '2020-11-10 09:34:12', '2020-11-10 09:34:12'),
(997, 'en', 'Admin Approval', 'Admin Approval', '2020-11-10 09:34:12', '2020-11-10 09:34:12'),
(998, 'en', 'Refund Status', 'Refund Status', '2020-11-10 09:34:12', '2020-11-10 09:34:12'),
(1000, 'en', 'No Refund', 'No Refund', '2020-11-10 09:35:27', '2020-11-10 09:35:27'),
(1001, 'en', 'Status updated successfully', 'Status updated successfully', '2020-11-10 09:54:20', '2020-11-10 09:54:20'),
(1002, 'en', 'User Search Report', 'User Search Report', '2020-11-11 06:43:24', '2020-11-11 06:43:24'),
(1003, 'en', 'Search By', 'Search By', '2020-11-11 06:43:24', '2020-11-11 06:43:24'),
(1004, 'en', 'Number searches', 'Number searches', '2020-11-11 06:43:24', '2020-11-11 06:43:24'),
(1005, 'en', 'Sender', 'Sender', '2020-11-11 06:51:49', '2020-11-11 06:51:49'),
(1006, 'en', 'Receiver', 'Receiver', '2020-11-11 06:51:49', '2020-11-11 06:51:49'),
(1007, 'en', 'Verification form updated successfully', 'Verification form updated successfully', '2020-11-11 06:53:29', '2020-11-11 06:53:29'),
(1008, 'en', 'Invalid email or password', 'Invalid email or password', '2020-11-11 07:07:49', '2020-11-11 07:07:49'),
(1009, 'en', 'All Coupons', 'All Coupons', '2020-11-11 07:14:04', '2020-11-11 07:14:04'),
(1010, 'en', 'Add New Coupon', 'Add New Coupon', '2020-11-11 07:14:04', '2020-11-11 07:14:04'),
(1011, 'en', 'Coupon Information', 'Coupon Information', '2020-11-11 07:14:04', '2020-11-11 07:14:04'),
(1012, 'en', 'Start Date', 'Start Date', '2020-11-11 07:14:04', '2020-11-11 07:14:04'),
(1013, 'en', 'End Date', 'End Date', '2020-11-11 07:14:05', '2020-11-11 07:14:05'),
(1014, 'en', 'Product Base', 'Product Base', '2020-11-11 07:14:05', '2020-11-11 07:14:05'),
(1015, 'en', 'Send Newsletter', 'Send Newsletter', '2020-11-11 07:14:10', '2020-11-11 07:14:10'),
(1016, 'en', 'Mobile Users', 'Mobile Users', '2020-11-11 07:14:10', '2020-11-11 07:14:10'),
(1017, 'en', 'SMS subject', 'SMS subject', '2020-11-11 07:14:10', '2020-11-11 07:14:10'),
(1018, 'en', 'SMS content', 'SMS content', '2020-11-11 07:14:10', '2020-11-11 07:14:10'),
(1019, 'en', 'All Flash Delas', 'All Flash Delas', '2020-11-11 07:16:06', '2020-11-11 07:16:06'),
(1020, 'en', 'Create New Flash Dela', 'Create New Flash Dela', '2020-11-11 07:16:06', '2020-11-11 07:16:06'),
(1022, 'en', 'Page Link', 'Page Link', '2020-11-11 07:16:06', '2020-11-11 07:16:06'),
(1023, 'en', 'Flash Deal Information', 'Flash Deal Information', '2020-11-11 07:16:14', '2020-11-11 07:16:14'),
(1024, 'en', 'Background Color', 'Background Color', '2020-11-11 07:16:14', '2020-11-11 07:16:14'),
(1026, 'en', 'Text Color', 'Text Color', '2020-11-11 07:16:14', '2020-11-11 07:16:14'),
(1027, 'en', 'White', 'White', '2020-11-11 07:16:14', '2020-11-11 07:16:14'),
(1028, 'en', 'Dark', 'Dark', '2020-11-11 07:16:15', '2020-11-11 07:16:15'),
(1029, 'en', 'Choose Products', 'Choose Products', '2020-11-11 07:16:15', '2020-11-11 07:16:15'),
(1030, 'en', 'Discounts', 'Discounts', '2020-11-11 07:16:20', '2020-11-11 07:16:20'),
(1031, 'en', 'Discount Type', 'Discount Type', '2020-11-11 07:16:20', '2020-11-11 07:16:20'),
(1032, 'en', 'Twillo Credential', 'Twillo Credential', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1033, 'en', 'TWILIO SID', 'TWILIO SID', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1034, 'en', 'TWILIO AUTH TOKEN', 'TWILIO AUTH TOKEN', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1035, 'en', 'TWILIO VERIFY SID', 'TWILIO VERIFY SID', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1036, 'en', 'VALID TWILLO NUMBER', 'VALID TWILLO NUMBER', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1037, 'en', 'Nexmo Credential', 'Nexmo Credential', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1038, 'en', 'NEXMO KEY', 'NEXMO KEY', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1039, 'en', 'NEXMO SECRET', 'NEXMO SECRET', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1040, 'en', 'SSL Wireless Credential', 'SSL Wireless Credential', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1041, 'en', 'SSL SMS API TOKEN', 'SSL SMS API TOKEN', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1042, 'en', 'SSL SMS SID', 'SSL SMS SID', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1043, 'en', 'SSL SMS URL', 'SSL SMS URL', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1044, 'en', 'Fast2SMS Credential', 'Fast2SMS Credential', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1045, 'en', 'AUTH KEY', 'AUTH KEY', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1046, 'en', 'ROUTE', 'ROUTE', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1047, 'en', 'Promotional Use', 'Promotional Use', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1048, 'en', 'Transactional Use', 'Transactional Use', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1050, 'en', 'SENDER ID', 'SENDER ID', '2020-11-11 07:17:35', '2020-11-11 07:17:35'),
(1051, 'en', 'Nexmo OTP', 'Nexmo OTP', '2020-11-11 07:17:42', '2020-11-11 07:17:42'),
(1052, 'en', 'Twillo OTP', 'Twillo OTP', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1053, 'en', 'SSL Wireless OTP', 'SSL Wireless OTP', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1054, 'en', 'Fast2SMS OTP', 'Fast2SMS OTP', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1055, 'en', 'Order Placement', 'Order Placement', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1056, 'en', 'Delivery Status Changing Time', 'Delivery Status Changing Time', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1057, 'en', 'Paid Status Changing Time', 'Paid Status Changing Time', '2020-11-11 07:17:43', '2020-11-11 07:17:43'),
(1058, 'en', 'Send Bulk SMS', 'Send Bulk SMS', '2020-11-11 07:19:14', '2020-11-11 07:19:14'),
(1059, 'en', 'All Subscribers', 'All Subscribers', '2020-11-11 07:21:51', '2020-11-11 07:21:51'),
(1060, 'en', 'Coupon Information Adding', 'Coupon Information Adding', '2020-11-11 07:22:25', '2020-11-11 07:22:25'),
(1061, 'en', 'Coupon Type', 'Coupon Type', '2020-11-11 07:22:25', '2020-11-11 07:22:25'),
(1062, 'en', 'For Products', 'For Products', '2020-11-11 07:22:25', '2020-11-11 07:22:25'),
(1063, 'en', 'For Total Orders', 'For Total Orders', '2020-11-11 07:22:25', '2020-11-11 07:22:25'),
(1064, 'en', 'Add Your Product Base Coupon', 'Add Your Product Base Coupon', '2020-11-11 07:22:42', '2020-11-11 07:22:42'),
(1065, 'en', 'Coupon code', 'Coupon code', '2020-11-11 07:22:42', '2020-11-11 07:22:42'),
(1066, 'en', 'Sub Category', 'Sub Category', '2020-11-11 07:22:42', '2020-11-11 07:22:42'),
(1067, 'en', 'Add More', 'Add More', '2020-11-11 07:22:43', '2020-11-11 07:22:43'),
(1068, 'en', 'Add Your Cart Base Coupon', 'Add Your Cart Base Coupon', '2020-11-11 07:29:40', '2020-11-11 07:29:40'),
(1069, 'en', 'Minimum Shopping', 'Minimum Shopping', '2020-11-11 07:29:40', '2020-11-11 07:29:40'),
(1070, 'en', 'Maximum Discount Amount', 'Maximum Discount Amount', '2020-11-11 07:29:41', '2020-11-11 07:29:41'),
(1071, 'en', 'Coupon Information Update', 'Coupon Information Update', '2020-11-11 08:18:34', '2020-11-11 08:18:34'),
(1073, 'en', 'Please Configure SMTP Setting to work all email sending funtionality', 'Please Configure SMTP Setting to work all email sending funtionality', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1074, 'en', 'Configure Now', 'Configure Now', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1076, 'en', 'Total published products', 'Total published products', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1077, 'en', 'Total sellers products', 'Total sellers products', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1078, 'en', 'Total admin products', 'Total admin products', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1079, 'en', 'Manage Products', 'Manage Products', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1080, 'en', 'Total product category', 'Total product category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1081, 'en', 'Create Category', 'Create Category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1082, 'en', 'Total product sub sub category', 'Total product sub sub category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1083, 'en', 'Create Sub Sub Category', 'Create Sub Sub Category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1084, 'en', 'Total product sub category', 'Total product sub category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1085, 'en', 'Create Sub Category', 'Create Sub Category', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1086, 'en', 'Total product brand', 'Total product brand', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1087, 'en', 'Create Brand', 'Create Brand', '2020-11-11 13:10:18', '2020-11-11 13:10:18'),
(1089, 'en', 'Total sellers', 'Total sellers', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1091, 'en', 'Total approved sellers', 'Total approved sellers', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1093, 'en', 'Total pending sellers', 'Total pending sellers', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1094, 'en', 'Manage Sellers', 'Manage Sellers', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1095, 'en', 'Category wise product sale', 'Category wise product sale', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1097, 'en', 'Sale', 'Sale', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1098, 'en', 'Category wise product stock', 'Category wise product stock', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1099, 'en', 'Category Name', 'Category Name', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1100, 'en', 'Stock', 'Stock', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1101, 'en', 'Frontend', 'Frontend', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1103, 'en', 'Home page', 'Home page', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1104, 'en', 'setting', 'setting', '2020-11-11 13:10:19', '2020-11-11 13:10:19'),
(1106, 'en', 'Policy page', 'Policy page', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1107, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1109, 'en', 'General', 'General', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1110, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1111, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1112, 'en', 'Useful link', 'Useful link', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1113, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1114, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1115, 'en', 'Activation', 'Activation', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1116, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1117, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1118, 'en', 'SMTP', 'SMTP', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1119, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1120, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1121, 'en', 'Payment method', 'Payment method', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1122, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1123, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1124, 'en', 'Social media', 'Social media', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1125, 'en', 'setting', 'setting', '2020-11-11 13:10:20', '2020-11-11 13:10:20'),
(1126, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1127, 'en', 'Business', 'Business', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1128, 'en', 'setting', 'setting', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1130, 'en', 'setting', 'setting', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1131, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1132, 'en', 'Seller verification', 'Seller verification', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1133, 'en', 'form setting', 'form setting', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1134, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1135, 'en', 'Language', 'Language', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1136, 'en', 'setting', 'setting', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1137, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1139, 'en', 'setting', 'setting', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1140, 'en', 'Click Here', 'Click Here', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1141, 'en', 'Dashboard', 'Dashboard', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1142, 'en', 'POS System', 'POS System', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1143, 'en', 'POS Manager', 'POS Manager', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1144, 'en', 'POS Configuration', 'POS Configuration', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1145, 'en', 'Products', 'Products', '2020-11-11 13:10:21', '2020-11-11 13:10:21'),
(1146, 'en', 'Add New product', 'Add New product', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1147, 'en', 'All Products', 'All Products', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1148, 'en', 'In House Products', 'In House Products', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1149, 'en', 'Seller Products', 'Seller Products', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1150, 'en', 'Digital Products', 'Digital Products', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1151, 'en', 'Bulk Import', 'Bulk Import', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1152, 'en', 'Bulk Export', 'Bulk Export', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1153, 'en', 'Category', 'Category', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1154, 'en', 'Subcategory', 'Subcategory', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1155, 'en', 'Sub Subcategory', 'Sub Subcategory', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1156, 'en', 'Brand', 'Brand', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1157, 'en', 'Attribute', 'Attribute', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1158, 'en', 'Product Reviews', 'Product Reviews', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1159, 'en', 'Sales', 'Sales', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1160, 'en', 'All Orders', 'All Orders', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1161, 'en', 'Inhouse orders', 'Inhouse orders', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1162, 'en', 'Seller Orders', 'Seller Orders', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1163, 'en', 'Pick-up Point Order', 'Pick-up Point Order', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1164, 'en', 'Refunds', 'Refunds', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1165, 'en', 'Refund Requests', 'Refund Requests', '2020-11-11 13:10:22', '2020-11-11 13:10:22'),
(1166, 'en', 'Approved Refund', 'Approved Refund', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1167, 'en', 'Refund Configuration', 'Refund Configuration', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1168, 'en', 'Customers', 'Customers', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1169, 'en', 'Customer list', 'Customer list', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1170, 'en', 'Classified Products', 'Classified Products', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1171, 'en', 'Classified Packages', 'Classified Packages', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1172, 'en', 'Sellers', 'Sellers', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1173, 'en', 'All Seller', 'All Seller', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1174, 'en', 'Payouts', 'Payouts', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1175, 'en', 'Payout Requests', 'Payout Requests', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1176, 'en', 'Seller Commission', 'Seller Commission', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1177, 'en', 'Seller Packages', 'Seller Packages', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1178, 'en', 'Seller Verification Form', 'Seller Verification Form', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1179, 'en', 'Reports', 'Reports', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1180, 'en', 'In House Product Sale', 'In House Product Sale', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1181, 'en', 'Seller Products Sale', 'Seller Products Sale', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1182, 'en', 'Products Stock', 'Products Stock', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1183, 'en', 'Products wishlist', 'Products wishlist', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1184, 'en', 'User Searches', 'User Searches', '2020-11-11 13:10:23', '2020-11-11 13:10:23'),
(1185, 'en', 'Marketing', 'Marketing', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1186, 'en', 'Flash deals', 'Flash deals', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1187, 'en', 'Newsletters', 'Newsletters', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1188, 'en', 'Bulk SMS', 'Bulk SMS', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1189, 'en', 'Subscribers', 'Subscribers', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1190, 'en', 'Coupon', 'Coupon', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1191, 'en', 'Support', 'Support', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1192, 'en', 'Ticket', 'Ticket', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1193, 'en', 'Product Queries', 'Product Queries', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1194, 'en', 'Website Setup', 'Website Setup', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1195, 'en', 'Header', 'Header', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1196, 'en', 'Footer', 'Footer', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1197, 'en', 'Pages', 'Pages', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1198, 'en', 'Appearance', 'Appearance', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1199, 'en', 'Setup & Configurations', 'Setup & Configurations', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1200, 'en', 'General Settings', 'General Settings', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1201, 'en', 'Features activation', 'Features activation', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1202, 'en', 'Languages', 'Languages', '2020-11-11 13:10:24', '2020-11-11 13:10:24'),
(1203, 'en', 'Currency', 'Currency', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1204, 'en', 'Pickup point', 'Pickup point', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1205, 'en', 'SMTP Settings', 'SMTP Settings', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1206, 'en', 'Payment Methods', 'Payment Methods', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1207, 'en', 'File System Configuration', 'File System Configuration', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1208, 'en', 'Social media Logins', 'Social media Logins', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1209, 'en', 'Analytics Tools', 'Analytics Tools', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1210, 'en', 'Facebook Chat', 'Facebook Chat', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1211, 'en', 'Google reCAPTCHA', 'Google reCAPTCHA', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1212, 'en', 'Shipping Configuration', 'Shipping Configuration', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1213, 'en', 'Shipping Countries', 'Shipping Countries', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1214, 'en', 'Affiliate System', 'Affiliate System', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1215, 'en', 'Affiliate Registration Form', 'Affiliate Registration Form', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1216, 'en', 'Affiliate Configurations', 'Affiliate Configurations', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1217, 'en', 'Affiliate Users', 'Affiliate Users', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1218, 'en', 'Referral Users', 'Referral Users', '2020-11-11 13:10:25', '2020-11-11 13:10:25'),
(1219, 'en', 'Affiliate Withdraw Requests', 'Affiliate Withdraw Requests', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1220, 'en', 'Offline Payment System', 'Offline Payment System', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1221, 'en', 'Manual Payment Methods', 'Manual Payment Methods', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1222, 'en', 'Offline Wallet Recharge', 'Offline Wallet Recharge', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1223, 'en', 'Offline Customer Package Payments', 'Offline Customer Package Payments', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1224, 'en', 'Offline Seller Package Payments', 'Offline Seller Package Payments', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1225, 'en', 'Paytm Payment Gateway', 'Paytm Payment Gateway', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1226, 'en', 'Set Paytm Credentials', 'Set Paytm Credentials', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1227, 'en', 'Club Point System', 'Club Point System', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1228, 'en', 'Club Point Configurations', 'Club Point Configurations', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1229, 'en', 'Set Product Point', 'Set Product Point', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1230, 'en', 'User Points', 'User Points', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1231, 'en', 'OTP System', 'OTP System', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1232, 'en', 'OTP Configurations', 'OTP Configurations', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1233, 'en', 'Set OTP Credentials', 'Set OTP Credentials', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1234, 'en', 'Staffs', 'Staffs', '2020-11-11 13:10:26', '2020-11-11 13:10:26'),
(1235, 'en', 'All staffs', 'All staffs', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1236, 'en', 'Staff permissions', 'Staff permissions', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1237, 'en', 'Addon Manager', 'Addon Manager', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1238, 'en', 'Browse Website', 'Browse Website', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1239, 'en', 'POS', 'POS', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1240, 'en', 'Notifications', 'Notifications', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1241, 'en', 'new orders', 'new orders', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1242, 'en', 'user-image', 'user-image', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1243, 'en', 'Profile', 'Profile', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1244, 'en', 'Logout', 'Logout', '2020-11-11 13:10:27', '2020-11-11 13:10:27'),
(1247, 'en', 'Page Not Found!', 'Page Not Found!', '2020-11-11 13:10:28', '2020-11-11 13:10:28'),
(1249, 'en', 'The page you are looking for has not been found on our server.', 'The page you are looking for has not been found on our server.', '2020-11-11 13:10:28', '2020-11-11 13:10:28'),
(1253, 'en', 'Registration', 'Registration', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1255, 'en', 'I am shopping for...', 'I am shopping for...', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1257, 'en', 'Compare', 'Compare', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1259, 'en', 'Wishlist', 'Wishlist', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1261, 'en', 'Cart', 'Cart', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1263, 'en', 'Your Cart is empty', 'Your Cart is empty', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1265, 'en', 'Categories', 'Categories', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1267, 'en', 'See All', 'See All', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1269, 'en', 'Seller Policy', 'Seller Policy', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1271, 'en', 'Return Policy', 'Return Policy', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1273, 'en', 'Support Policy', 'Support Policy', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1275, 'en', 'Privacy Policy', 'Privacy Policy', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1277, 'en', 'Your Email Address', 'Your Email Address', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1279, 'en', 'Subscribe', 'Subscribe', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1281, 'en', 'Contact Info', 'Contact Info', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1283, 'en', 'Address', 'Address', '2020-11-11 13:10:29', '2020-11-11 13:10:29'),
(1285, 'en', 'Phone', 'Phone', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1287, 'en', 'Email', 'Email', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1288, 'en', 'Login', 'Login', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1289, 'en', 'My Account', 'My Account', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1291, 'en', 'Login', 'Login', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1293, 'en', 'Order History', 'Order History', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1295, 'en', 'My Wishlist', 'My Wishlist', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1297, 'en', 'Track Order', 'Track Order', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1299, 'en', 'Be an affiliate partner', 'Be an affiliate partner', '2020-11-11 13:10:30', '2020-11-11 13:10:30');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(1301, 'en', 'Be a Seller', 'Be a Seller', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1303, 'en', 'Apply Now', 'Apply Now', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1305, 'en', 'Confirmation', 'Confirmation', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1307, 'en', 'Delete confirmation message', 'Delete confirmation message', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1309, 'en', 'Cancel', 'Cancel', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1312, 'en', 'Delete', 'Delete', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1313, 'en', 'Item has been added to compare list', 'Item has been added to compare list', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1314, 'en', 'Please login first', 'Please login first', '2020-11-11 13:10:30', '2020-11-11 13:10:30'),
(1315, 'en', 'Total Earnings From', 'Total Earnings From', '2020-11-12 08:01:11', '2020-11-12 08:01:11'),
(1316, 'en', 'Client Subscription', 'Client Subscription', '2020-11-12 08:01:12', '2020-11-12 08:01:12'),
(1317, 'en', 'Product category', 'Product category', '2020-11-12 08:03:46', '2020-11-12 08:03:46'),
(1318, 'en', 'Product sub sub category', 'Product sub sub category', '2020-11-12 08:03:46', '2020-11-12 08:03:46'),
(1319, 'en', 'Product sub category', 'Product sub category', '2020-11-12 08:03:46', '2020-11-12 08:03:46'),
(1320, 'en', 'Product brand', 'Product brand', '2020-11-12 08:03:46', '2020-11-12 08:03:46'),
(1321, 'en', 'Top Client Packages', 'Top Client Packages', '2020-11-12 08:05:21', '2020-11-12 08:05:21'),
(1322, 'en', 'Top Freelancer Packages', 'Top Freelancer Packages', '2020-11-12 08:05:21', '2020-11-12 08:05:21'),
(1323, 'en', 'Number of sale', 'Number of sale', '2020-11-12 09:13:09', '2020-11-12 09:13:09'),
(1324, 'en', 'Number of Stock', 'Number of Stock', '2020-11-12 09:16:02', '2020-11-12 09:16:02'),
(1325, 'en', 'Top 10 Products', 'Top 10 Products', '2020-11-12 10:02:29', '2020-11-12 10:02:29'),
(1326, 'en', 'Top 12 Products', 'Top 12 Products', '2020-11-12 10:02:39', '2020-11-12 10:02:39'),
(1327, 'en', 'Admin can not be a seller', 'Admin can not be a seller', '2020-11-12 11:30:19', '2020-11-12 11:30:19'),
(1328, 'en', 'Filter by Rating', 'Filter by Rating', '2020-11-15 08:01:15', '2020-11-15 08:01:15'),
(1329, 'en', 'Published reviews updated successfully', 'Published reviews updated successfully', '2020-11-15 08:01:15', '2020-11-15 08:01:15'),
(1330, 'en', 'Refund Sticker has been updated successfully', 'Refund Sticker has been updated successfully', '2020-11-15 08:17:12', '2020-11-15 08:17:12'),
(1331, 'en', 'Edit Product', 'Edit Product', '2020-11-15 10:31:54', '2020-11-15 10:31:54'),
(1332, 'en', 'Meta Images', 'Meta Images', '2020-11-15 10:32:12', '2020-11-15 10:32:12'),
(1333, 'en', 'Update Product', 'Update Product', '2020-11-15 10:32:12', '2020-11-15 10:32:12'),
(1334, 'en', 'Product has been deleted successfully', 'Product has been deleted successfully', '2020-11-15 10:32:57', '2020-11-15 10:32:57'),
(1335, 'en', 'Your Profile has been updated successfully!', 'Your Profile has been updated successfully!', '2020-11-15 11:10:42', '2020-11-15 11:10:42'),
(1336, 'en', 'Upload limit has been reached. Please upgrade your package.', 'Upload limit has been reached. Please upgrade your package.', '2020-11-15 11:13:45', '2020-11-15 11:13:45'),
(1337, 'en', 'Add Your Product', 'Add Your Product', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1338, 'en', 'Select a category', 'Select a category', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1339, 'en', 'Select a brand', 'Select a brand', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1340, 'en', 'Product Unit', 'Product Unit', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1341, 'en', 'Minimum Qty.', 'Minimum Qty.', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1342, 'en', 'Product Tag', 'Product Tag', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1343, 'en', 'Type & hit enter', 'Type & hit enter', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1344, 'en', 'Videos', 'Videos', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1345, 'en', 'Video From', 'Video From', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1346, 'en', 'Video URL', 'Video URL', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1347, 'en', 'Customer Choice', 'Customer Choice', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1348, 'en', 'PDF', 'PDF', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1349, 'en', 'Choose PDF', 'Choose PDF', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1350, 'en', 'Select Category', 'Select Category', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1351, 'en', 'Target Category', 'Target Category', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1352, 'en', 'subsubcategory', 'subsubcategory', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1353, 'en', 'Search Category', 'Search Category', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1354, 'en', 'Search SubCategory', 'Search SubCategory', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1355, 'en', 'Search SubSubCategory', 'Search SubSubCategory', '2020-11-15 11:17:56', '2020-11-15 11:17:56'),
(1356, 'en', 'Update your product', 'Update your product', '2020-11-15 11:39:14', '2020-11-15 11:39:14'),
(1357, 'en', 'Product has been updated successfully', 'Product has been updated successfully', '2020-11-15 11:51:36', '2020-11-15 11:51:36'),
(1358, 'en', 'Add Your Digital Product', 'Add Your Digital Product', '2020-11-15 12:24:21', '2020-11-15 12:24:21'),
(1359, 'en', 'Active eCommerce CMS Update Process', 'Active eCommerce CMS Update Process', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1361, 'en', 'Codecanyon purchase code', 'Codecanyon purchase code', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1362, 'en', 'Database Name', 'Database Name', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1363, 'en', 'Database Username', 'Database Username', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1364, 'en', 'Database Password', 'Database Password', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1365, 'en', 'Database Hostname', 'Database Hostname', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1366, 'en', 'Update Now', 'Update Now', '2020-11-16 07:53:31', '2020-11-16 07:53:31'),
(1368, 'en', 'Congratulations', 'Congratulations', '2020-11-16 07:55:14', '2020-11-16 07:55:14'),
(1369, 'en', 'You have successfully completed the updating process. Please Login to continue', 'You have successfully completed the updating process. Please Login to continue', '2020-11-16 07:55:14', '2020-11-16 07:55:14'),
(1370, 'en', 'Go to Home', 'Go to Home', '2020-11-16 07:55:14', '2020-11-16 07:55:14'),
(1371, 'en', 'Login to Admin panel', 'Login to Admin panel', '2020-11-16 07:55:14', '2020-11-16 07:55:14'),
(1372, 'en', 'S3 File System Credentials', 'S3 File System Credentials', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1373, 'en', 'AWS_ACCESS_KEY_ID', 'AWS_ACCESS_KEY_ID', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1374, 'en', 'AWS_SECRET_ACCESS_KEY', 'AWS_SECRET_ACCESS_KEY', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1375, 'en', 'AWS_DEFAULT_REGION', 'AWS_DEFAULT_REGION', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1376, 'en', 'AWS_BUCKET', 'AWS_BUCKET', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1377, 'en', 'AWS_URL', 'AWS_URL', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1378, 'en', 'S3 File System Activation', 'S3 File System Activation', '2020-11-16 12:59:57', '2020-11-16 12:59:57'),
(1379, 'en', 'Your phone number', 'Your phone number', '2020-11-17 05:50:10', '2020-11-17 05:50:10'),
(1380, 'en', 'Zip File', 'Zip File', '2020-11-17 06:58:45', '2020-11-17 06:58:45'),
(1381, 'en', 'Install', 'Install', '2020-11-17 06:58:45', '2020-11-17 06:58:45'),
(1382, 'en', 'This version is not capable of installing Addons, Please update.', 'This version is not capable of installing Addons, Please update.', '2020-11-17 06:59:11', '2020-11-17 06:59:11'),
(1383, 'en', 'Browse All Categories', 'Browse All Categories', '2021-02-09 09:01:58', '2021-02-09 09:01:58'),
(1384, 'en', 'Find Our Locations', 'Find Our Locations', '2021-02-09 09:01:58', '2021-02-09 09:01:58'),
(1385, 'en', 'To Get More Emersive', 'To Get More Emersive', '2021-02-09 09:01:58', '2021-02-09 09:01:58'),
(1386, 'en', 'Nothing found', 'Nothing found', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1387, 'en', 'File selected', 'File selected', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1388, 'en', 'Files selected', 'Files selected', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1389, 'en', 'Add more files', 'Add more files', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1390, 'en', 'Adding more files', 'Adding more files', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1391, 'en', 'Drop files here, paste or', 'Drop files here, paste or', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1392, 'en', 'Upload complete', 'Upload complete', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1393, 'en', 'Upload paused', 'Upload paused', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1394, 'en', 'Resume upload', 'Resume upload', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1395, 'en', 'Pause upload', 'Pause upload', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1396, 'en', 'Retry upload', 'Retry upload', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1397, 'en', 'Cancel upload', 'Cancel upload', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1398, 'en', 'Uploading', 'Uploading', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1399, 'en', 'Processing', 'Processing', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1400, 'en', 'Complete', 'Complete', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1401, 'en', 'Files', 'Files', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1402, 'en', 'Blogs', 'Blogs', '2021-04-20 11:27:09', '2021-04-20 11:27:09'),
(1403, 'en', 'View All Sellers', 'View All Sellers', '2021-04-20 11:27:10', '2021-04-20 11:27:10'),
(1404, 'en', 'Please Configure SMTP Setting to work all email sending functionality', 'Please Configure SMTP Setting to work all email sending functionality', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1405, 'en', 'Order', 'Order', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1406, 'en', 'Search in menu', 'Search in menu', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1407, 'en', 'Uploaded Files', 'Uploaded Files', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1408, 'en', 'Commission History', 'Commission History', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1409, 'en', 'Wallet Recharge History', 'Wallet Recharge History', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1410, 'en', 'Blog System', 'Blog System', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1411, 'en', 'All Posts', 'All Posts', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1412, 'en', 'Vat & TAX', 'Vat & TAX', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1413, 'en', 'Facebook Comment', 'Facebook Comment', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1414, 'en', 'Shipping Cities', 'Shipping Cities', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1415, 'en', 'System', 'System', '2021-04-20 11:27:21', '2021-04-20 11:27:21'),
(1416, 'en', 'Server status', 'Server status', '2021-04-20 11:27:22', '2021-04-20 11:27:22'),
(2256, 'en', 'These images are visible in product details page gallery. Use 600x600 sizes images.', 'These images are visible in product details page gallery. Use 600x600 sizes images.', '2021-04-27 16:10:02', '2021-04-27 16:10:02'),
(2257, 'en', 'This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.', 'This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.', '2021-04-27 16:10:02', '2021-04-27 16:10:02'),
(2258, 'en', 'Use proper link without extra parameter. Don\'t use short share link/embeded iframe code.', 'Use proper link without extra parameter. Don\'t use short share link/embeded iframe code.', '2021-04-27 16:10:02', '2021-04-27 16:10:02'),
(2259, 'en', 'Product Wise Shipping', 'Product Wise Shipping', '2021-04-27 16:10:02', '2021-04-27 16:10:02'),
(2260, 'en', 'cairo', 'cairo', '2021-04-27 16:10:02', '2021-04-27 16:10:02'),
(2261, 'en', 'Cost', 'Cost', '2021-04-27 16:10:02', '2021-04-27 16:10:02'),
(2262, 'en', 'alargantin', 'alargantin', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2263, 'en', 'Is Product Quantity Mulitiply', 'Is Product Quantity Mulitiply', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2264, 'en', 'Low Stock Quantity Warning', 'Low Stock Quantity Warning', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2265, 'en', 'Stock Visibility State', 'Stock Visibility State', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2266, 'en', 'Show Stock Quantity', 'Show Stock Quantity', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2267, 'en', 'Show Stock With Text Only', 'Show Stock With Text Only', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2268, 'en', 'Hide Stock', 'Hide Stock', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2269, 'en', 'Flash Deal', 'Flash Deal', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2270, 'en', 'Add To Flash', 'Add To Flash', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2271, 'en', 'Estimate Shipping Time', 'Estimate Shipping Time', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2272, 'en', 'Shipping Days', 'Shipping Days', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2273, 'en', 'Save As Draft', 'Save As Draft', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2274, 'en', 'Save & Unpublish', 'Save & Unpublish', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2275, 'en', 'Save & Publish', 'Save & Publish', '2021-04-27 16:10:03', '2021-04-27 16:10:03'),
(2276, 'en', 'Parent Category', 'Parent Category', '2021-04-27 16:12:16', '2021-04-27 16:12:16'),
(2277, 'en', 'Order Level', 'Order Level', '2021-04-27 16:12:16', '2021-04-27 16:12:16'),
(2278, 'en', 'Level', 'Level', '2021-04-27 16:12:16', '2021-04-27 16:12:16'),
(2279, 'en', 'Install/Update Addon', 'Install/Update Addon', '2021-04-27 16:12:20', '2021-04-27 16:12:20'),
(2280, 'en', 'No Addon Installed', 'No Addon Installed', '2021-04-27 16:12:20', '2021-04-27 16:12:20'),
(2281, 'en', 'Install/Update', 'Install/Update', '2021-04-27 16:12:44', '2021-04-27 16:12:44'),
(2282, 'en', 'Filter by date', 'Filter by date', '2021-04-27 16:14:46', '2021-04-27 16:14:46'),
(2283, 'en', 'Seller', 'Seller', '2021-04-27 16:15:17', '2021-04-27 16:15:17'),
(2284, 'en', 'All Customers', 'All Customers', '2021-04-27 16:15:38', '2021-04-27 16:15:38'),
(2285, 'en', 'Type email or name & Enter', 'Type email or name & Enter', '2021-04-27 16:15:38', '2021-04-27 16:15:38'),
(2286, 'en', 'Package', 'Package', '2021-04-27 16:15:38', '2021-04-27 16:15:38'),
(2287, 'en', 'Wallet Balance', 'Wallet Balance', '2021-04-27 16:15:38', '2021-04-27 16:15:38'),
(2288, 'en', 'Log in as this Customer', 'Log in as this Customer', '2021-04-27 16:15:38', '2021-04-27 16:15:38'),
(2289, 'en', 'Ban this Customer', 'Ban this Customer', '2021-04-27 16:15:38', '2021-04-27 16:15:38'),
(2290, 'en', 'Do you really want to ban this Customer?', 'Do you really want to ban this Customer?', '2021-04-27 16:15:38', '2021-04-27 16:15:38'),
(2291, 'en', 'Proceed!', 'Proceed!', '2021-04-27 16:15:38', '2021-04-27 16:15:38'),
(2292, 'en', 'Do you really want to unban this Customer?', 'Do you really want to unban this Customer?', '2021-04-27 16:15:38', '2021-04-27 16:15:38'),
(2293, 'en', 'Uploaded By', 'Uploaded By', '2021-04-27 16:15:41', '2021-04-27 16:15:41'),
(2294, 'en', 'Uploaded By', 'Uploaded By', '2021-04-27 16:15:41', '2021-04-27 16:15:41'),
(2295, 'en', 'Customer Status', 'Customer Status', '2021-04-27 16:15:41', '2021-04-27 16:15:41'),
(2296, 'en', 'All Classifies Packages', 'All Classifies Packages', '2021-04-27 16:15:43', '2021-04-27 16:15:43'),
(2297, 'en', 'Bkash Credential', 'Bkash Credential', '2021-04-27 16:17:40', '2021-04-27 16:17:40'),
(2298, 'en', 'BKASH CHECKOUT APP KEY', 'BKASH CHECKOUT APP KEY', '2021-04-27 16:17:40', '2021-04-27 16:17:40'),
(2299, 'en', 'BKASH CHECKOUT APP SECRET', 'BKASH CHECKOUT APP SECRET', '2021-04-27 16:17:40', '2021-04-27 16:17:40'),
(2300, 'en', 'BKASH CHECKOUT USER NAME', 'BKASH CHECKOUT USER NAME', '2021-04-27 16:17:40', '2021-04-27 16:17:40'),
(2301, 'en', 'BKASH CHECKOUT PASSWORD', 'BKASH CHECKOUT PASSWORD', '2021-04-27 16:17:40', '2021-04-27 16:17:40'),
(2302, 'en', 'Bkash Sandbox Mode', 'Bkash Sandbox Mode', '2021-04-27 16:17:40', '2021-04-27 16:17:40'),
(2303, 'en', 'Nagad Credential', 'Nagad Credential', '2021-04-27 16:17:40', '2021-04-27 16:17:40'),
(2304, 'en', 'NAGAD MODE', 'NAGAD MODE', '2021-04-27 16:17:40', '2021-04-27 16:17:40'),
(2305, 'en', 'NAGAD MERCHANT ID', 'NAGAD MERCHANT ID', '2021-04-27 16:17:40', '2021-04-27 16:17:40'),
(2306, 'en', 'NAGAD MERCHANT NUMBER', 'NAGAD MERCHANT NUMBER', '2021-04-27 16:17:41', '2021-04-27 16:17:41'),
(2307, 'en', 'NAGAD PG PUBLIC KEY', 'NAGAD PG PUBLIC KEY', '2021-04-27 16:17:41', '2021-04-27 16:17:41'),
(2308, 'en', 'NAGAD MERCHANT PRIVATE KEY', 'NAGAD MERCHANT PRIVATE KEY', '2021-04-27 16:17:41', '2021-04-27 16:17:41'),
(2309, 'en', 'PAYSTACK CURRENCY CODE', 'PAYSTACK CURRENCY CODE', '2021-04-27 16:17:41', '2021-04-27 16:17:41'),
(2310, 'en', 'Iyzico Credential', 'Iyzico Credential', '2021-04-27 16:17:41', '2021-04-27 16:17:41'),
(2311, 'en', 'IYZICO_API_KEY', 'IYZICO_API_KEY', '2021-04-27 16:17:41', '2021-04-27 16:17:41'),
(2312, 'en', 'IYZICO API KEY', 'IYZICO API KEY', '2021-04-27 16:17:41', '2021-04-27 16:17:41'),
(2313, 'en', 'IYZICO_SECRET_KEY', 'IYZICO_SECRET_KEY', '2021-04-27 16:17:41', '2021-04-27 16:17:41'),
(2314, 'en', 'IYZICO SECRET KEY', 'IYZICO SECRET KEY', '2021-04-27 16:17:41', '2021-04-27 16:17:41'),
(2315, 'en', 'IYZICO Sandbox Mode', 'IYZICO Sandbox Mode', '2021-04-27 16:17:41', '2021-04-27 16:17:41'),
(2316, 'en', 'Facebook Pixel Setting', 'Facebook Pixel Setting', '2021-04-27 16:20:54', '2021-04-27 16:20:54'),
(2317, 'en', 'Facebook Pixel', 'Facebook Pixel', '2021-04-27 16:20:55', '2021-04-27 16:20:55'),
(2318, 'en', 'Facebook Pixel ID', 'Facebook Pixel ID', '2021-04-27 16:20:55', '2021-04-27 16:20:55'),
(2319, 'en', 'Please be carefull when you are configuring Facebook pixel.', 'Please be carefull when you are configuring Facebook pixel.', '2021-04-27 16:20:55', '2021-04-27 16:20:55'),
(2320, 'en', 'Log in to Facebook and go to your Ads Manager account', 'Log in to Facebook and go to your Ads Manager account', '2021-04-27 16:20:55', '2021-04-27 16:20:55'),
(2321, 'en', 'Open the Navigation Bar and select Events Manager', 'Open the Navigation Bar and select Events Manager', '2021-04-27 16:20:55', '2021-04-27 16:20:55'),
(2322, 'en', 'Copy your Pixel ID from underneath your Site Name and paste the number into Facebook Pixel ID field', 'Copy your Pixel ID from underneath your Site Name and paste the number into Facebook Pixel ID field', '2021-04-27 16:20:55', '2021-04-27 16:20:55'),
(2323, 'en', 'Google Analytics Setting', 'Google Analytics Setting', '2021-04-27 16:20:55', '2021-04-27 16:20:55'),
(2324, 'en', 'Google Analytics', 'Google Analytics', '2021-04-27 16:20:55', '2021-04-27 16:20:55'),
(2325, 'en', 'Tracking ID', 'Tracking ID', '2021-04-27 16:20:55', '2021-04-27 16:20:55'),
(2326, 'en', 'update Language Info', 'update Language Info', '2021-04-27 16:21:14', '2021-04-27 16:21:14'),
(2327, 'en', 'Type key & Enter', 'Type key & Enter', '2021-04-27 16:21:23', '2021-04-27 16:21:23'),
(2328, 'en', 'Wallet Transaction Report', 'Wallet Transaction Report', '2021-04-27 16:28:01', '2021-04-27 16:28:01'),
(2329, 'en', 'Wallet Transaction', 'Wallet Transaction', '2021-04-27 16:28:01', '2021-04-27 16:28:01'),
(2330, 'en', 'Choose User', 'Choose User', '2021-04-27 16:28:01', '2021-04-27 16:28:01'),
(2331, 'en', 'Daterange', 'Daterange', '2021-04-27 16:28:01', '2021-04-27 16:28:01'),
(2332, 'en', 'Info', 'Info', '2021-04-27 16:28:18', '2021-04-27 16:28:18'),
(2333, 'en', 'Link copied to clipboard', 'Link copied to clipboard', '2021-04-27 16:28:24', '2021-04-27 16:28:24'),
(2334, 'en', 'Oops, unable to copy', 'Oops, unable to copy', '2021-04-27 16:28:24', '2021-04-27 16:28:24'),
(2335, 'en', 'Iyzico', 'Iyzico', '2021-04-27 16:28:36', '2021-04-27 16:28:36'),
(2336, 'en', 'Staff Information', 'Staff Information', '2021-04-27 16:32:58', '2021-04-27 16:32:58'),
(2337, 'en', 'All uploaded files', 'All uploaded files', '2021-04-27 16:33:48', '2021-04-27 16:33:48'),
(2338, 'en', 'Upload New File', 'Upload New File', '2021-04-27 16:33:48', '2021-04-27 16:33:48'),
(2339, 'en', 'All files', 'All files', '2021-04-27 16:33:48', '2021-04-27 16:33:48'),
(2340, 'en', 'Search your files', 'Search your files', '2021-04-27 16:33:48', '2021-04-27 16:33:48'),
(2341, 'en', 'Search', 'Search', '2021-04-27 16:33:48', '2021-04-27 16:33:48'),
(2342, 'en', 'Details Info', 'Details Info', '2021-04-27 16:33:48', '2021-04-27 16:33:48'),
(2343, 'en', 'Copy Link', 'Copy Link', '2021-04-27 16:33:49', '2021-04-27 16:33:49'),
(2344, 'en', 'Are you sure to delete this file?', 'Are you sure to delete this file?', '2021-04-27 16:33:49', '2021-04-27 16:33:49'),
(2345, 'en', 'File Info', 'File Info', '2021-04-27 16:33:49', '2021-04-27 16:33:49'),
(2346, 'en', 'Save Product', 'Save Product', '2021-04-27 18:47:41', '2021-04-27 18:47:41'),
(2347, 'en', 'Step 1', 'Step 1', '2021-04-27 20:37:47', '2021-04-27 20:37:47'),
(2348, 'en', 'Download the skeleton file and fill it with proper data', 'Download the skeleton file and fill it with proper data', '2021-04-27 20:37:48', '2021-04-27 20:37:48'),
(2349, 'en', 'You can download the example file to understand how the data must be filled', 'You can download the example file to understand how the data must be filled', '2021-04-27 20:37:48', '2021-04-27 20:37:48'),
(2350, 'en', 'Once you have downloaded and filled the skeleton file, upload it in the form below and submit', 'Once you have downloaded and filled the skeleton file, upload it in the form below and submit', '2021-04-27 20:37:48', '2021-04-27 20:37:48'),
(2351, 'en', 'After uploading products you need to edit them and set product\'s images and choices', 'After uploading products you need to edit them and set product\'s images and choices', '2021-04-27 20:37:48', '2021-04-27 20:37:48'),
(2352, 'en', 'Step 2', 'Step 2', '2021-04-27 20:37:48', '2021-04-27 20:37:48'),
(2353, 'en', 'Category and Brand should be in numerical id', 'Category and Brand should be in numerical id', '2021-04-27 20:37:48', '2021-04-27 20:37:48'),
(2354, 'en', 'You can download the pdf to get Category and Brand id', 'You can download the pdf to get Category and Brand id', '2021-04-27 20:37:48', '2021-04-27 20:37:48'),
(2355, 'en', 'Upload Product File', 'Upload Product File', '2021-04-27 20:37:48', '2021-04-27 20:37:48'),
(3570, 'en', 'Trans imported successfully', 'Trans imported successfully', '2021-04-27 22:47:39', '2021-04-27 22:47:39'),
(4653, 'en', 'Your order has been placed', 'Your order has been placed', '2021-04-28 12:59:14', '2021-04-28 12:59:14'),
(4654, 'en', 'Payment completed', 'Payment completed', '2021-04-28 12:59:14', '2021-04-28 12:59:14'),
(4663, 'en', 'Email already exists!', 'Email already exists!', '2021-04-28 15:46:13', '2021-04-28 15:46:13'),
(4664, 'en', 'Add New Seller', 'Add New Seller', '2021-04-28 15:46:13', '2021-04-28 15:46:13'),
(4665, 'en', 'Seller Information', 'Seller Information', '2021-04-28 15:46:13', '2021-04-28 15:46:13'),
(4666, 'en', 'Email Verification', 'Email Verification', '2021-04-28 15:46:33', '2021-04-28 15:46:33'),
(4667, 'en', 'Please click the button below to verify your email address.', 'Please click the button below to verify your email address.', '2021-04-28 15:46:33', '2021-04-28 15:46:33'),
(4668, 'en', 'Email Verification - ', 'Email Verification - ', '2021-04-28 15:46:33', '2021-04-28 15:46:33'),
(4669, 'en', 'Filter by Approval', 'Filter by Approval', '2021-04-28 15:49:07', '2021-04-28 15:49:07'),
(4670, 'en', 'Non-Approved', 'Non-Approved', '2021-04-28 15:49:07', '2021-04-28 15:49:07'),
(4671, 'en', 'Type name or email & Enter', 'Type name or email & Enter', '2021-04-28 15:49:07', '2021-04-28 15:49:07'),
(4672, 'en', 'Due to seller', 'Due to seller', '2021-04-28 15:49:07', '2021-04-28 15:49:07'),
(4673, 'en', 'Log in as this Seller', 'Log in as this Seller', '2021-04-28 15:49:07', '2021-04-28 15:49:07'),
(4674, 'en', 'Go to Payment', 'Go to Payment', '2021-04-28 15:49:07', '2021-04-28 15:49:07'),
(4675, 'en', 'Ban this seller', 'Ban this seller', '2021-04-28 15:49:07', '2021-04-28 15:49:07'),
(4676, 'en', 'Do you really want to ban this seller?', 'Do you really want to ban this seller?', '2021-04-28 15:49:07', '2021-04-28 15:49:07'),
(4677, 'en', 'Approved sellers updated successfully', 'Approved sellers updated successfully', '2021-04-28 15:49:07', '2021-04-28 15:49:07'),
(4678, 'en', 'New verification request(s)', 'New verification request(s)', '2021-04-28 15:49:19', '2021-04-28 15:49:19'),
(4679, 'en', 'Seller Payments', 'Seller Payments', '2021-04-28 15:49:38', '2021-04-28 15:49:38'),
(4680, 'en', 'Payment Details', 'Payment Details', '2021-04-28 15:49:38', '2021-04-28 15:49:38'),
(4681, 'en', 'of seller product price will be deducted from seller earnings', 'of seller product price will be deducted from seller earnings', '2021-04-28 15:51:38', '2021-04-28 15:51:38'),
(4682, 'en', 'of seller product price will be deducted from seller earnings', 'of seller product price will be deducted from seller earnings', '2021-04-28 15:51:38', '2021-04-28 15:51:38'),
(4683, 'en', 'This commission only works when Category Based Commission is turned off from Business Settings', 'This commission only works when Category Based Commission is turned off from Business Settings', '2021-04-28 15:51:38', '2021-04-28 15:51:38'),
(4684, 'en', 'Commission doesn\'t work if seller package system add-on is activated', 'Commission doesn\'t work if seller package system add-on is activated', '2021-04-28 15:51:39', '2021-04-28 15:51:39'),
(4685, 'en', 'Commission doesn\'t work if seller package system add-on is activated', 'Commission doesn\'t work if seller package system add-on is activated', '2021-04-28 15:51:39', '2021-04-28 15:51:39'),
(4686, 'en', 'Seller Withdraw Request', 'Seller Withdraw Request', '2021-04-28 15:51:42', '2021-04-28 15:51:42'),
(4687, 'en', 'Total Amount to Pay', 'Total Amount to Pay', '2021-04-28 15:51:42', '2021-04-28 15:51:42'),
(4688, 'en', 'Requested Amount', 'Requested Amount', '2021-04-28 15:51:42', '2021-04-28 15:51:42'),
(4689, 'en', 'Seller has been inserted successfully', 'Seller has been inserted successfully', '2021-04-28 15:52:34', '2021-04-28 15:52:34'),
(4690, 'en', 'About', 'About', '2021-04-28 15:53:25', '2021-04-28 15:53:25'),
(4691, 'en', 'Payout Info', 'Payout Info', '2021-04-28 15:53:25', '2021-04-28 15:53:25'),
(4692, 'en', 'Bank Acc Name', 'Bank Acc Name', '2021-04-28 15:53:25', '2021-04-28 15:53:25'),
(4693, 'en', 'Bank Acc Number', 'Bank Acc Number', '2021-04-28 15:53:25', '2021-04-28 15:53:25'),
(4694, 'en', 'Total Products', 'Total Products', '2021-04-28 15:53:26', '2021-04-28 15:53:26'),
(4695, 'en', 'Total Sold Amount', 'Total Sold Amount', '2021-04-28 15:53:26', '2021-04-28 15:53:26'),
(4696, 'en', 'Verify Your Email Address', 'Verify Your Email Address', '2021-04-28 15:53:33', '2021-04-28 15:53:33'),
(4697, 'en', 'Before proceeding, please check your email for a verification link.', 'Before proceeding, please check your email for a verification link.', '2021-04-28 15:53:33', '2021-04-28 15:53:33'),
(4698, 'en', 'If you did not receive the email.', 'If you did not receive the email.', '2021-04-28 15:53:33', '2021-04-28 15:53:33'),
(4699, 'en', 'Click here to request another', 'Click here to request another', '2021-04-28 15:53:33', '2021-04-28 15:53:33'),
(4700, 'en', 'A fresh verification link has been sent to your email address.', 'A fresh verification link has been sent to your email address.', '2021-04-28 15:53:43', '2021-04-28 15:53:43'),
(4701, 'en', 'Use Phone Instead', 'Use Phone Instead', '2021-04-28 15:55:01', '2021-04-28 15:55:01'),
(4702, 'en', 'Email or Phone already exists.', 'Email or Phone already exists.', '2021-04-28 15:55:52', '2021-04-28 15:55:52'),
(4703, 'en', 'Registration successfull. Please verify your email.', 'Registration successfull. Please verify your email.', '2021-04-28 15:57:21', '2021-04-28 15:57:21'),
(4704, 'en', 'Your email has been verified successfully', 'Your email has been verified successfully', '2021-04-28 15:57:35', '2021-04-28 15:57:35'),
(4705, 'en', 'Recharge Wallet', 'Recharge Wallet', '2021-04-28 15:58:08', '2021-04-28 15:58:08'),
(4706, 'en', 'Offline Recharge Wallet', 'Offline Recharge Wallet', '2021-04-28 15:58:08', '2021-04-28 15:58:08'),
(4722, 'en', 'Order status has been updated', 'Order status has been updated', '2021-04-30 20:10:46', '2021-04-30 20:10:46'),
(4752, 'en', 'Pickip Point', 'Pickip Point', '2021-05-01 02:09:58', '2021-05-01 02:09:58'),
(4767, 'en', 'Something went wrong!', 'Something went wrong!', '2021-05-03 02:58:13', '2021-05-03 02:58:13'),
(4768, 'en', 'Sorry for the inconvenience, but we\'re working on it.', 'Sorry for the inconvenience, but we\'re working on it.', '2021-05-03 02:58:13', '2021-05-03 02:58:13'),
(4769, 'en', 'Error code', 'Error code', '2021-05-03 02:58:13', '2021-05-03 02:58:13'),
(4770, 'en', 'Your Shop has been created successfully!', 'Your Shop has been created successfully!', '2021-05-03 04:39:49', '2021-05-03 04:39:49'),
(4771, 'en', 'Shop Logo', 'Shop Logo', '2021-05-03 04:39:50', '2021-05-03 04:39:50'),
(4772, 'en', 'Shop Address', 'Shop Address', '2021-05-03 04:39:50', '2021-05-03 04:39:50'),
(4773, 'en', 'Banner Settings', 'Banner Settings', '2021-05-03 04:39:50', '2021-05-03 04:39:50'),
(4774, 'en', 'Banners', 'Banners', '2021-05-03 04:39:50', '2021-05-03 04:39:50'),
(4775, 'en', 'We had to limit height to maintian consistancy. In some device both side of the banner might be cropped for height limitation.', 'We had to limit height to maintian consistancy. In some device both side of the banner might be cropped for height limitation.', '2021-05-03 04:39:50', '2021-05-03 04:39:50'),
(4776, 'en', 'Insert link with https ', 'Insert link with https ', '2021-05-03 04:39:50', '2021-05-03 04:39:50'),
(4777, 'en', 'Verify Now', 'Verify Now', '2021-05-03 04:40:18', '2021-05-03 04:40:18'),
(4778, 'en', 'Uplaod Product', 'Uplaod Product', '2021-05-03 04:40:28', '2021-05-03 04:40:28'),
(4779, 'en', 'Category Information', 'Category Information', '2021-05-04 00:41:36', '2021-05-04 00:41:36'),
(4780, 'en', 'Translatable', 'Translatable', '2021-05-04 00:41:36', '2021-05-04 00:41:36'),
(4781, 'en', 'No Parent', 'No Parent', '2021-05-04 00:41:36', '2021-05-04 00:41:36'),
(4782, 'en', 'Ordering Number', 'Ordering Number', '2021-05-04 00:41:36', '2021-05-04 00:41:36'),
(4783, 'en', 'Physical', 'Physical', '2021-05-04 00:41:37', '2021-05-04 00:41:37'),
(4784, 'en', 'Digital', 'Digital', '2021-05-04 00:41:37', '2021-05-04 00:41:37'),
(4785, 'en', '200x200', '200x200', '2021-05-04 00:41:37', '2021-05-04 00:41:37'),
(4786, 'en', '32x32', '32x32', '2021-05-04 00:41:37', '2021-05-04 00:41:37'),
(4787, 'en', 'Commission Rate', 'Commission Rate', '2021-05-04 00:41:37', '2021-05-04 00:41:37'),
(4788, 'en', 'Category has been updated successfully', 'Category has been updated successfully', '2021-05-04 00:58:27', '2021-05-04 00:58:27'),
(4789, 'en', 'Category has been inserted successfully', 'Category has been inserted successfully', '2021-05-04 01:00:10', '2021-05-04 01:00:10'),
(4790, 'en', 'Add New Brand', 'Add New Brand', '2021-05-04 01:01:46', '2021-05-04 01:01:46'),
(4791, 'en', '120x80', '120x80', '2021-05-04 01:01:46', '2021-05-04 01:01:46'),
(4792, 'en', 'Brand Information', 'Brand Information', '2021-05-04 01:01:49', '2021-05-04 01:01:49'),
(4793, 'en', 'Brand Information', 'Brand Information', '2021-05-04 01:01:49', '2021-05-04 01:01:49'),
(4794, 'en', 'Brand has been updated successfully', 'Brand has been updated successfully', '2021-05-04 01:02:55', '2021-05-04 01:02:55'),
(4795, 'en', 'Brand has been inserted successfully', 'Brand has been inserted successfully', '2021-05-04 01:03:46', '2021-05-04 01:03:46'),
(4796, 'en', 'HTTPS Activation', 'HTTPS Activation', '2021-05-04 01:25:08', '2021-05-04 01:25:08'),
(4797, 'en', 'Maintenance Mode Activation', 'Maintenance Mode Activation', '2021-05-04 01:25:08', '2021-05-04 01:25:08'),
(4798, 'en', 'Disable image optimization?', 'Disable image optimization?', '2021-05-04 01:25:08', '2021-05-04 01:25:08'),
(4799, 'en', 'Business Related', 'Business Related', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4800, 'en', 'Vendor System Activation', 'Vendor System Activation', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4801, 'en', 'Classified Product', 'Classified Product', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4802, 'en', 'Wallet System Activation', 'Wallet System Activation', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4803, 'en', 'Coupon System Activation', 'Coupon System Activation', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4804, 'en', 'Pickup Point Activation', 'Pickup Point Activation', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4805, 'en', 'Conversation Activation', 'Conversation Activation', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4806, 'en', 'Seller Product Manage By Admin', 'Seller Product Manage By Admin', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4807, 'en', 'After activate this option Cash On Delivery of Seller product will be managed by Admin', 'After activate this option Cash On Delivery of Seller product will be managed by Admin', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4808, 'en', 'Category-based Commission', 'Category-based Commission', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4809, 'en', 'After activate this option Seller commision will be disabled and You need to set commission on each category otherwise Admin will not get any commision', 'After activate this option Seller commision will be disabled and You need to set commission on each category otherwise Admin will not get any commision', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4810, 'en', 'Set Commisssion Now', 'Set Commisssion Now', '2021-05-04 01:25:09', '2021-05-04 01:25:09'),
(4811, 'en', 'Payment Related', 'Payment Related', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4812, 'en', 'Paypal Payment Activation', 'Paypal Payment Activation', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4813, 'en', 'You need to configure Paypal correctly to enable this feature', 'You need to configure Paypal correctly to enable this feature', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4814, 'en', 'Stripe Payment Activation', 'Stripe Payment Activation', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4815, 'en', 'SSlCommerz Activation', 'SSlCommerz Activation', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4816, 'en', 'Instamojo Payment Activation', 'Instamojo Payment Activation', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4817, 'en', 'You need to configure Instamojo Payment correctly to enable this feature', 'You need to configure Instamojo Payment correctly to enable this feature', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4818, 'en', 'Razor Pay Activation', 'Razor Pay Activation', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4819, 'en', 'You need to configure Razor correctly to enable this feature', 'You need to configure Razor correctly to enable this feature', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4820, 'en', 'PayStack Activation', 'PayStack Activation', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4821, 'en', 'You need to configure PayStack correctly to enable this feature', 'You need to configure PayStack correctly to enable this feature', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4822, 'en', 'VoguePay Activation', 'VoguePay Activation', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4823, 'en', 'You need to configure VoguePay correctly to enable this feature', 'You need to configure VoguePay correctly to enable this feature', '2021-05-04 01:25:10', '2021-05-04 01:25:10'),
(4824, 'en', 'Payhere Activation', 'Payhere Activation', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4825, 'en', 'Ngenius Activation', 'Ngenius Activation', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4826, 'en', 'You need to configure Ngenius correctly to enable this feature', 'You need to configure Ngenius correctly to enable this feature', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4827, 'en', 'Iyzico Activation', 'Iyzico Activation', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4828, 'en', 'You need to configure iyzico correctly to enable this feature', 'You need to configure iyzico correctly to enable this feature', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4829, 'en', 'Bkash Activation', 'Bkash Activation', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4830, 'en', 'You need to configure bkash correctly to enable this feature', 'You need to configure bkash correctly to enable this feature', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4831, 'en', 'Nagad Activation', 'Nagad Activation', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4832, 'en', 'You need to configure nagad correctly to enable this feature', 'You need to configure nagad correctly to enable this feature', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4833, 'en', 'Cash Payment Activation', 'Cash Payment Activation', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4834, 'en', 'Social Media Login', 'Social Media Login', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4835, 'en', 'Facebook login', 'Facebook login', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4836, 'en', 'You need to configure Facebook Client correctly to enable this feature', 'You need to configure Facebook Client correctly to enable this feature', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4837, 'en', 'Google login', 'Google login', '2021-05-04 01:25:11', '2021-05-04 01:25:11'),
(4838, 'en', 'You need to configure Google Client correctly to enable this feature', 'You need to configure Google Client correctly to enable this feature', '2021-05-04 01:25:12', '2021-05-04 01:25:12'),
(4839, 'en', 'Twitter login', 'Twitter login', '2021-05-04 01:25:12', '2021-05-04 01:25:12'),
(4840, 'en', 'You need to configure Twitter Client correctly to enable this feature', 'You need to configure Twitter Client correctly to enable this feature', '2021-05-04 01:25:12', '2021-05-04 01:25:12'),
(4841, 'en', 'Cookies Agreement', 'Cookies Agreement', '2021-05-04 01:54:48', '2021-05-04 01:54:48'),
(4842, 'en', 'Cookies Agreement', 'Cookies Agreement', '2021-05-04 01:54:48', '2021-05-04 01:54:48'),
(4843, 'en', 'Cookies Agreement Text', 'Cookies Agreement Text', '2021-05-04 01:54:49', '2021-05-04 01:54:49'),
(4844, 'en', 'Show Cookies Agreement?', 'Show Cookies Agreement?', '2021-05-04 01:54:49', '2021-05-04 01:54:49'),
(4845, 'en', 'Custom Script', 'Custom Script', '2021-05-04 01:54:49', '2021-05-04 01:54:49'),
(4846, 'en', 'Header custom script - before </head>', 'Header custom script - before </head>', '2021-05-04 01:54:49', '2021-05-04 01:54:49'),
(4847, 'en', 'Write script with <script> tag', 'Write script with <script> tag', '2021-05-04 01:54:49', '2021-05-04 01:54:49'),
(4848, 'en', 'Footer custom script - before </body>', 'Footer custom script - before </body>', '2021-05-04 01:54:49', '2021-05-04 01:54:49'),
(4849, 'en', 'Back to uploaded files', 'Back to uploaded files', '2021-05-04 02:08:14', '2021-05-04 02:08:14'),
(4850, 'en', 'Drag & drop your files', 'Drag & drop your files', '2021-05-04 02:08:14', '2021-05-04 02:08:14'),
(4857, 'en', ' PayTabs Credential', ' PayTabs Credential', '2021-05-05 23:16:25', '2021-05-05 23:16:25'),
(4858, 'en', 'Profile Id', 'Profile Id', '2021-05-05 23:16:25', '2021-05-05 23:16:25'),
(4859, 'en', 'Server  Key', 'Server  Key', '2021-05-05 23:16:25', '2021-05-05 23:16:25'),
(4860, 'en', 'PayTabs Credential', 'PayTabs Credential', '2021-05-05 23:20:31', '2021-05-05 23:20:31'),
(4861, 'en', 'Server Key', 'Server Key', '2021-05-05 23:20:31', '2021-05-05 23:20:31'),
(4862, 'en', 'PayTab Sandbox Mode\n', 'PayTab Sandbox Mode\n', '2021-05-05 23:40:09', '2021-05-05 23:40:09'),
(4863, 'en', 'PayTab Sandbox Mode', 'PayTab Sandbox Mode', '2021-05-05 23:41:10', '2021-05-05 23:41:10'),
(4864, 'en', 'System Default Currency', 'System Default Currency', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4865, 'en', 'System Default Currency', 'System Default Currency', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4866, 'en', 'Set Currency Formats', 'Set Currency Formats', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4867, 'en', 'Set Currency Formats', 'Set Currency Formats', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4868, 'en', 'Symbol Format', 'Symbol Format', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4869, 'en', 'Decimal Separator', 'Decimal Separator', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4870, 'en', 'No of decimals', 'No of decimals', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4871, 'en', 'All Currencies', 'All Currencies', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4872, 'en', 'All Currencies', 'All Currencies', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4873, 'en', 'Add New Currency', 'Add New Currency', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4874, 'en', 'Currency name', 'Currency name', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4875, 'en', 'Currency name', 'Currency name', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4876, 'en', 'Currency symbol', 'Currency symbol', '2021-05-06 00:03:59', '2021-05-06 00:03:59'),
(4877, 'en', 'Currency code', 'Currency code', '2021-05-06 00:04:00', '2021-05-06 00:04:00'),
(4878, 'en', 'Currency Status updated successfully', 'Currency Status updated successfully', '2021-05-06 00:04:00', '2021-05-06 00:04:00'),
(4879, 'en', 'Currency Status updated successfully', 'Currency Status updated successfully', '2021-05-06 00:04:00', '2021-05-06 00:04:00'),
(4880, 'en', 'PayTab', 'PayTab', '2021-05-06 00:16:01', '2021-05-06 00:16:01'),
(4881, 'en', 'PayTab', 'PayTab', '2021-05-06 00:16:01', '2021-05-06 00:16:01'),
(4882, 'en', 'Forgot password ?', 'Forgot password ?', '2021-05-06 01:08:16', '2021-05-06 01:08:16'),
(4883, 'en', 'Your Cart was empty', 'Your Cart was empty', '2021-05-06 02:59:01', '2021-05-06 02:59:01'),
(4884, 'en', 'Your order has been placed successfully', 'Your order has been placed successfully', '2021-05-06 04:04:20', '2021-05-06 04:04:20'),
(4885, 'en', 'The requested quantity is not available for ', 'The requested quantity is not available for ', '2021-05-06 04:10:15', '2021-05-06 04:10:15'),
(4886, 'en', 'TapPayment Secret API Key', 'TapPayment Secret API Key', '2021-05-06 16:19:01', '2021-05-06 16:19:01'),
(4887, 'en', 'TapPayment Publishable API Key', 'TapPayment Publishable API Key', '2021-05-06 16:19:01', '2021-05-06 16:19:01'),
(4888, 'en', 'TapPayment Secret API Key', 'TapPayment Secret API Key', '2021-05-06 16:19:01', '2021-05-06 16:19:01'),
(4889, 'en', 'TapPayment Merchant ID', 'TapPayment Merchant ID', '2021-05-06 16:19:01', '2021-05-06 16:19:01'),
(4890, 'en', 'TapPayment Publishable API Key', 'TapPayment Publishable API Key', '2021-05-06 16:19:01', '2021-05-06 16:19:01'),
(4891, 'en', 'TapPayment', 'TapPayment', '2021-05-06 16:19:01', '2021-05-06 16:19:01'),
(4892, 'en', 'TapPayment Merchant ID', 'TapPayment Merchant ID', '2021-05-06 16:19:01', '2021-05-06 16:19:01'),
(4893, 'en', 'TapPayment', 'TapPayment', '2021-05-06 16:19:01', '2021-05-06 16:19:01'),
(4894, 'en', 'TapPayment Sandbox Mode', 'TapPayment Sandbox Mode', '2021-05-06 16:25:25', '2021-05-06 16:25:25'),
(4895, 'en', 'TapPayment Credential', 'TapPayment Credential', '2021-05-06 16:26:42', '2021-05-06 16:26:42'),
(4896, 'en', 'TapPayment Credential', 'TapPayment Credential', '2021-05-06 16:26:42', '2021-05-06 16:26:42'),
(4897, 'en', 'Blog', 'Blog', '2021-05-06 20:18:04', '2021-05-06 20:18:04'),
(4898, 'en', 'We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.', 'We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.', '2021-05-07 00:09:50', '2021-05-07 00:09:50'),
(4899, 'en', 'We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.', 'We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.', '2021-05-07 00:09:50', '2021-05-07 00:09:50'),
(4900, 'en', ' PayTab Sandbox Mode', ' PayTab Sandbox Mode', '2021-05-12 01:29:56', '2021-05-12 01:29:56'),
(4901, 'en', 'Paytabsaudi', 'Paytabsaudi', '2021-05-12 21:46:19', '2021-05-12 21:46:19'),
(4902, 'en', 'Header Nav Menu', 'Header Nav Menu', '2021-05-12 22:34:25', '2021-05-12 22:34:25'),
(4903, 'en', 'Link with', 'Link with', '2021-05-12 22:34:25', '2021-05-12 22:34:25'),
(4904, 'en', 'Merchant Code', 'Merchant Code', '2021-05-15 05:11:39', '2021-05-15 05:11:39'),
(4905, 'en', 'Security Key', 'Security Key', '2021-05-15 05:12:01', '2021-05-15 05:12:01'),
(4906, 'en', 'Fawry Sandbox Mode', 'Fawry Sandbox Mode', '2021-05-15 05:15:03', '2021-05-15 05:15:03'),
(4907, 'en', 'Fawry Live', 'Live', '2021-05-15 05:16:44', '2021-05-15 05:16:44'),
(4908, 'en', 'Fawry Credential', 'Fawry Credential', '2021-05-15 05:29:58', '2021-05-15 05:29:58'),
(4909, 'en', 'Fawry', 'Fawry', '2021-05-15 07:10:02', '2021-05-15 07:10:02'),
(4910, 'en', 'Please add shipping address', 'Please add shipping address', '2021-05-16 16:34:43', '2021-05-16 16:34:43'),
(4911, 'en', 'Abandoned baskets', 'Abandoned baskets', '2021-05-18 16:41:04', '2021-05-18 16:41:04'),
(4912, 'en', 'Emails', 'Emails', '2021-05-20 10:36:56', '2021-05-20 10:36:56'),
(4913, 'en', 'Users', 'Users', '2021-05-20 10:36:56', '2021-05-20 10:36:56'),
(4914, 'en', 'Newsletter subject', 'Newsletter subject', '2021-05-20 10:36:56', '2021-05-20 10:36:56'),
(4915, 'en', 'Newsletter content', 'Newsletter content', '2021-05-20 10:36:56', '2021-05-20 10:36:56'),
(4916, 'en', 'Search', 'Search', '2021-05-22 04:32:04', '2021-05-22 04:32:04'),
(4917, 'en', 'Name', 'Name', '2021-05-22 04:32:04', '2021-05-22 04:32:04'),
(4918, 'en', 'Price', 'Price', '2021-05-22 04:32:33', '2021-05-22 04:32:33'),
(4919, 'en', 'Created At', 'Created At', '2021-05-22 04:32:33', '2021-05-22 04:32:33'),
(4920, 'en', 'All rows number', 'All rows number', '2021-05-22 04:33:34', '2021-05-22 04:33:34'),
(4921, 'en', 'Go to page', 'Go to page', '2021-05-22 04:33:34', '2021-05-22 04:33:34'),
(4922, 'en', 'Page', 'Page ', '2021-05-22 04:34:08', '2021-05-22 04:34:08'),
(4923, 'en', 'to', 'to', '2021-05-22 04:34:08', '2021-05-22 04:34:08'),
(4924, 'en', 'Desc', 'Desc', '2021-05-22 04:34:39', '2021-05-22 04:34:39'),
(4925, 'en', 'Asc', 'Asc', '2021-05-22 04:34:39', '2021-05-22 04:34:39'),
(4926, 'en', 'increase', 'increase', '2021-05-22 04:35:08', '2021-05-22 04:35:08'),
(4927, 'en', 'show', 'show', '2021-05-22 04:35:08', '2021-05-22 04:35:08'),
(4928, 'en', 'undefined', 'undefined', '2021-05-22 06:00:36', '2021-05-22 06:00:36'),
(4929, 'en', 'Abandoned Baskets', 'Abandoned Baskets', '2021-05-22 19:59:00', '2021-05-22 19:59:00'),
(4930, 'en', 'Coupon has been saved successfully', 'Coupon has been saved successfully', '2021-05-22 20:05:54', '2021-05-22 20:05:54'),
(4931, 'en', 'Total Usage For One User', 'Total Usage For One User', '2021-05-23 03:00:08', '2021-05-23 03:00:08'),
(4932, 'en', 'Coupon already exist for this coupon code', 'Coupon already exist for this coupon code', '2021-05-23 08:28:39', '2021-05-23 08:28:39'),
(4933, 'en', 'Coupon expired!', 'Coupon expired!', '2021-05-23 09:00:26', '2021-05-23 09:00:26'),
(4934, 'en', 'Coupon has been applied', 'Coupon has been applied', '2021-05-23 09:08:27', '2021-05-23 09:08:27'),
(4935, 'en', 'Change Coupon', 'Change Coupon', '2021-05-23 09:08:27', '2021-05-23 09:08:27'),
(4936, 'en', 'You already used this coupon!', 'You already used this coupon!', '2021-05-23 09:36:45', '2021-05-23 09:36:45'),
(4937, 'en', 'Wallet', 'Wallet', '2021-05-24 03:36:03', '2021-05-24 03:36:03'),
(4938, 'en', 'Wallet', 'Wallet', '2021-05-24 03:36:03', '2021-05-24 03:36:03'),
(4939, 'en', 'Add New Product var In baskets', 'Add New Product var In baskets', '2021-05-25 07:47:16', '2021-05-25 07:47:16'),
(4940, 'en', 'the Customer var_user Add New Product In Baskets a Price var_price Inclusive of Tax and Shipping\r\n', 'the Customer var_user Add New Product In Baskets a Price var_price Inclusive of Tax and Shipping\r\n', '2021-05-25 08:34:56', '2021-05-25 08:34:56'),
(4941, 'en', 'the Customer var_user Add New Product In Baskets a Price var_price Inclusive of Tax and Shipping', 'the Customer var_user Add New Product In Baskets a Price var_price Inclusive of Tax and Shipping sssssssssss', '2021-05-25 06:48:30', '2021-05-25 06:48:30'),
(4942, 'en', 'Paytabs Credential', 'Paytabs Credential', '2021-05-25 12:58:41', '2021-05-25 12:58:41'),
(4943, 'en', 'Home Banner 3 (Max 3)', 'Home Banner 3 (Max 3)', '2021-05-26 08:08:55', '2021-05-26 08:08:55'),
(4944, 'en', 'Not Have Any Address', 'Not Have Any Address', '2021-05-27 12:32:28', '2021-05-27 12:32:28'),
(4945, 'en', 'Carts', 'Carts', '2021-05-28 13:35:49', '2021-05-28 13:35:49'),
(4946, 'en', 'Tax', 'Tax', '2021-05-28 13:36:39', '2021-05-28 13:36:39'),
(4947, 'en', 'Categorey Name', 'Categorey Name', '2021-05-30 05:44:27', '2021-05-30 05:44:27'),
(4948, 'en', 'Product Desc', 'Product Desc', '2021-05-30 05:44:27', '2021-05-30 05:44:27'),
(4949, 'en', 'Search By', 'Search By', '2021-05-30 05:51:13', '2021-05-30 05:51:13'),
(4950, 'en', 'Customer Name', 'Customer Name', '2021-05-30 05:55:52', '2021-05-30 05:55:52'),
(4951, 'en', 'Seller Phone', 'Seller Phone', '2021-05-30 06:00:11', '2021-05-30 06:00:11'),
(4952, 'en', 'Phone `Number`', 'Phone `Number`', '2021-05-30 04:04:48', '2021-05-30 04:04:48'),
(4953, 'en', 'Phone Number', 'Phone Number', '2021-05-30 04:05:12', '2021-05-30 04:05:12'),
(4954, 'en', 'With Free Shiping ?', 'With Free Shiping ?', '2021-05-31 11:23:03', '2021-05-31 11:23:03');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(4955, 'en', 'Yes', 'Yes', '2021-05-31 11:24:56', '2021-05-31 11:24:56'),
(4956, 'en', 'No', 'No', '2021-05-31 11:24:56', '2021-05-31 11:24:56'),
(4957, 'en', 'Total Usage For All', 'Total Usage For All', '2021-05-31 11:26:23', '2021-05-31 11:26:23'),
(4958, NULL, 'Minimum Amount of Purchases', 'Minimum Amount of Purchases', '2021-05-31 11:28:17', '2021-05-31 11:28:17'),
(4959, 'en', 'Minimum Amount of Purchases', 'Minimum Amount of Purchases', '2021-05-31 10:10:40', '2021-05-31 10:10:40'),
(4960, 'en', 'Rate Total Customer Purchasers', 'Rate Total Customer Purchasers', '2021-05-31 12:19:50', '2021-05-31 12:19:50'),
(4961, 'en', 'Amount Total Customer Purchasers', 'Amount Total Customer Purchasers', '2021-05-31 12:20:15', '2021-05-31 12:20:15'),
(4962, 'en', 'Add Product', 'Add Product', '2021-05-31 14:18:39', '2021-05-31 14:18:39'),
(4963, 'en', 'Unit Price', 'Unit Price', '2021-05-31 15:10:34', '2021-05-31 15:10:34'),
(4964, 'en', 'Choose Brand', 'Choose Brand', '2021-05-31 15:12:54', '2021-05-31 15:12:54'),
(4965, 'en', 'Choose Category', 'Choose Category', '2021-05-31 15:12:54', '2021-05-31 15:12:54'),
(4966, 'en', 'Quantity', 'Quantity', '2021-05-31 15:35:43', '2021-05-31 15:35:43'),
(4967, 'en', 'Purchase Price', 'Purchase Price', '2021-05-31 15:36:33', '2021-05-31 15:36:33'),
(4968, 'en', 'No Selected Item', 'No Selected Item', '2021-06-01 08:37:14', '2021-06-01 08:37:14'),
(4969, 'en', 'No Item Selected', 'No Item Selected', '2021-06-01 08:37:41', '2021-06-01 08:37:41'),
(4970, 'en', 'Is Selected var_num Items', 'Is Selected var_num Items', '2021-06-01 08:38:55', '2021-06-01 08:38:55'),
(4971, 'en', 'Close', 'Close', '2021-06-01 09:06:28', '2021-06-01 09:06:28'),
(4972, 'en', 'Save Changes', 'Save Changes', '2021-06-01 09:06:28', '2021-06-01 09:06:28'),
(4973, 'en', 'Edit Product', 'Edit Product', '2021-06-01 10:01:51', '2021-06-01 10:01:51'),
(4974, 'en', 'Minimum Amount of Purchases Not Enough', 'Minimum Amount of Purchases Not Enough', '2021-06-01 12:35:22', '2021-06-01 12:35:22'),
(4975, 'en', 'Product Wish Report', 'Product Wish Report', '2021-06-01 11:46:58', '2021-06-01 11:46:58'),
(4976, 'en', 'Number of Wish', 'Number of Wish', '2021-06-01 11:46:58', '2021-06-01 11:46:58'),
(4977, 'en', 'Main Reports', 'Main Reports', '2021-06-01 13:52:32', '2021-06-01 13:52:32'),
(4978, 'en', 'There Error In Payment Process Not Finished', 'There Error In Payment Process Not Finished', '2021-06-02 12:27:09', '2021-06-02 12:27:09'),
(4979, 'en', 'Product Prices', 'Product Prices', '2021-06-03 16:23:35', '2021-06-03 16:23:35'),
(4980, 'en', 'Taxes', 'Taxes', '2021-06-03 16:23:35', '2021-06-03 16:23:35'),
(4981, 'en', 'Sales Cash After Delivery', 'Sales Cash After Delivery', '2021-06-03 16:23:36', '2021-06-03 16:23:36'),
(4982, 'en', 'Sales By Wallet', 'Sales By Wallet', '2021-06-03 16:23:36', '2021-06-03 16:23:36'),
(4983, 'en', 'Sales By Elec Pay', 'Sales By Elec Pay', '2021-06-03 16:23:36', '2021-06-03 16:23:36'),
(4984, 'en', 'Payment Sales', 'Payment Sales', '2021-06-03 16:28:42', '2021-06-03 16:28:42'),
(4985, 'en', 'Number Products', 'Number Products', '2021-06-03 22:20:14', '2021-06-03 22:20:14'),
(4986, 'en', 'Quantity Products', 'Quantity Products', '2021-06-03 22:20:14', '2021-06-03 22:20:14'),
(4987, 'en', 'Taxes Amount', 'Taxes Amount', '2021-06-03 22:20:14', '2021-06-03 22:20:14'),
(4988, 'en', 'Taxes Percent', 'Taxes Percent', '2021-06-03 22:20:14', '2021-06-03 22:20:14'),
(4989, 'en', 'Unit Prices', 'Unit Prices', '2021-06-03 22:20:14', '2021-06-03 22:20:14'),
(4990, 'en', 'Purchase Prices', 'Purchase Prices', '2021-06-03 22:20:14', '2021-06-03 22:20:14'),
(4991, 'en', 'Visitor', 'Visitor', '2021-06-04 10:49:15', '2021-06-04 10:49:15'),
(4992, 'en', 'Open View Home Index', 'Open View Home Index', '2021-06-04 11:20:20', '2021-06-04 11:20:20'),
(4993, 'en', 'Customer Numbers Activies', 'Customer Numbers Activies', '2021-06-04 12:50:50', '2021-06-04 12:50:50'),
(4994, 'en', 'Customer Numbers Not Activies', 'Customer Numbers Not Activies', '2021-06-04 12:50:50', '2021-06-04 12:50:50'),
(4995, 'en', 'Customer Orders', 'Customer Orders', '2021-06-04 12:50:50', '2021-06-04 12:50:50'),
(4996, 'en', 'Customer Purchases', 'Customer Purchases', '2021-06-04 12:50:50', '2021-06-04 12:50:50'),
(4997, 'en', 'Visitores', 'Visitores', '2021-06-04 14:47:20', '2021-06-04 14:47:20'),
(4998, 'en', 'Visitors', 'Visitors', '2021-06-04 17:08:07', '2021-06-04 17:08:07'),
(4999, 'en', 'Admins Visitors', 'Admins Visitors', '2021-06-04 17:08:07', '2021-06-04 17:08:07'),
(5000, 'en', 'Sellers Visitors', 'Sellers Visitors', '2021-06-04 17:08:07', '2021-06-04 17:08:07'),
(5001, 'en', 'Customers Visitors', 'Customers Visitors', '2021-06-04 17:08:07', '2021-06-04 17:08:07'),
(5002, 'en', 'Guests Visitors', 'Guests Visitors', '2021-06-04 17:08:07', '2021-06-04 17:08:07'),
(5003, 'en', 'Seller Numbers Activies', 'Seller Numbers Activies', '2021-06-06 06:31:30', '2021-06-06 06:31:30'),
(5004, 'en', 'Seller Numbers Not Activies', 'Seller Numbers Not Activies', '2021-06-06 06:31:30', '2021-06-06 06:31:30'),
(5005, 'en', 'Seller Purchases', 'Seller Purchases', '2021-06-06 06:31:30', '2021-06-06 06:31:30'),
(5006, 'en', 'Orders Status Deliver', 'Orders Status Deliver', '2021-06-06 07:40:23', '2021-06-06 07:40:23'),
(5007, 'en', 'Orders Pending', 'Orders Pending', '2021-06-06 07:40:24', '2021-06-06 07:40:24'),
(5008, 'en', 'Orders Confirmed', 'Orders Confirmed', '2021-06-06 07:40:24', '2021-06-06 07:40:24'),
(5009, 'en', 'Orders On Delivery', 'Orders On Delivery', '2021-06-06 07:40:24', '2021-06-06 07:40:24'),
(5010, 'en', 'Orders Delivered', 'Orders Delivered', '2021-06-06 07:40:24', '2021-06-06 07:40:24'),
(5011, 'en', 'Orders Payment Status', 'Orders Payment Status', '2021-06-06 07:40:24', '2021-06-06 07:40:24'),
(5012, 'en', 'Orders Paid', 'Orders Paid', '2021-06-06 07:40:24', '2021-06-06 07:40:24'),
(5013, 'en', 'Orders UnPaid', 'Orders UnPaid', '2021-06-06 07:40:24', '2021-06-06 07:40:24'),
(5014, 'en', 'Orders Paid Prices', 'Orders Paid Prices', '2021-06-06 07:40:24', '2021-06-06 07:40:24'),
(5015, 'en', 'Orders UnPaid Prices', 'Orders UnPaid Prices', '2021-06-06 07:40:24', '2021-06-06 07:40:24'),
(5016, 'en', 'Visits', 'Visits', '2021-06-06 09:42:43', '2021-06-06 09:42:43'),
(5017, 'en', 'Paytabegypt', 'Paytabegypt', '2021-06-07 09:42:05', '2021-06-07 09:42:05'),
(5018, 'en', 'Id', 'Id', '2021-06-07 10:23:31', '2021-06-07 10:23:31'),
(5019, 'en', 'Un Paid', 'Un Paid', '2021-06-07 20:44:27', '2021-06-07 20:44:27'),
(5020, 'en', 'Create New Order', 'Create New Order', '2021-06-08 07:37:25', '2021-06-08 07:37:25'),
(5021, 'en', 'Toggle paginate', 'Toggle paginate', '2021-06-08 08:52:33', '2021-06-08 08:52:33'),
(5022, 'en', 'Edit Order', 'Edit Order', '2021-06-09 06:59:34', '2021-06-09 06:59:34'),
(5023, 'en', 'weight', 'weight', '2021-06-09 08:23:27', '2021-06-09 08:23:27'),
(5024, 'en', 'Calc', 'Calc', '2021-06-09 08:23:27', '2021-06-09 08:23:27'),
(5025, 'en', 'Calc Basckt', 'Calc Basckt', '2021-06-09 08:31:02', '2021-06-09 08:31:02'),
(5026, 'en', 'Coupons', 'Coupons', '2021-06-09 08:34:13', '2021-06-09 08:34:13'),
(5027, 'en', 'Add Coupons', 'Add Coupons', '2021-06-09 08:34:13', '2021-06-09 08:34:13'),
(5028, 'en', 'Add Coupon', 'Add Coupon', '2021-06-09 08:34:39', '2021-06-09 08:34:39'),
(5029, 'en', 'Customer Phone', 'Customer Phone', '2021-06-09 19:32:43', '2021-06-09 19:32:43'),
(5030, 'en', 'Customer Email', 'Customer Email', '2021-06-09 19:32:43', '2021-06-09 19:32:43'),
(5031, 'en', 'Please, the field only accepts email', 'Please, the field only accepts email', '2021-06-09 19:51:34', '2021-06-09 19:51:34'),
(5032, 'en', '* Please, the field only accepts email', '* Please, the field only accepts email', '2021-06-09 20:02:16', '2021-06-09 20:02:16'),
(5033, 'en', 'Choose Country', 'Choose Country', '2021-06-09 20:35:07', '2021-06-09 20:35:07'),
(5034, 'en', 'Product Price', 'Product Price', '2021-06-11 13:26:11', '2021-06-11 13:26:11'),
(5035, 'en', 'Expend', 'Expend', '2021-06-14 12:33:36', '2021-06-14 12:33:36'),
(5036, 'en', 'Produc Name', 'Produc Name', '2021-06-14 14:49:01', '2021-06-14 14:49:01'),
(5037, 'en', 'Produc Price', 'Produc Price', '2021-06-14 14:49:01', '2021-06-14 14:49:01'),
(5038, 'en', 'Produc Color', 'Produc Color', '2021-06-14 14:49:01', '2021-06-14 14:49:01'),
(5039, 'en', 'Product Color', 'Product Color', '2021-06-14 14:52:03', '2021-06-14 14:52:03'),
(5040, 'en', 'Save Change', 'Save Change', '2021-06-14 18:06:25', '2021-06-14 18:06:25'),
(5041, 'en', 'No Number Phone', 'No Number Phone', '2021-06-14 18:20:07', '2021-06-14 18:20:07'),
(5042, 'en', 'pendding', 'pendding', '2021-06-14 20:40:41', '2021-06-14 20:40:41'),
(5043, 'en', 'Create Order', 'Create Order', '2021-06-14 20:41:17', '2021-06-14 20:41:17'),
(5044, 'en', 'loading...', 'loading...', '2021-06-14 20:49:58', '2021-06-14 20:49:58'),
(5045, 'en', 'Adress', 'Adress', '2021-06-16 12:16:12', '2021-06-16 12:16:12'),
(5046, 'en', 'please,write your adress to shipping', 'please,write your adress to shipping', '2021-06-16 12:16:12', '2021-06-16 12:16:12'),
(5047, 'en', 'please,write your phone number', 'please,write your phone number', '2021-06-16 12:16:12', '2021-06-16 12:16:12'),
(5048, 'en', 'please,write your postal code', 'please,write your postal code', '2021-06-16 12:16:12', '2021-06-16 12:16:12'),
(5049, 'en', 'Shipping Data', 'Shipping Data', '2021-06-16 12:22:18', '2021-06-16 12:22:18'),
(5050, 'en', 'please,write your adress to shipping*', 'please,write your adress to shipping*', '2021-06-16 12:26:02', '2021-06-16 12:26:02'),
(5051, 'en', 'please,write your phone number*', 'please,write your phone number*', '2021-06-16 12:26:02', '2021-06-16 12:26:02'),
(5052, 'en', 'please,write your postal code*', 'please,write your postal code*', '2021-06-16 12:26:02', '2021-06-16 12:26:02'),
(5053, 'en', 'Country*', 'Country*', '2021-06-16 12:26:02', '2021-06-16 12:26:02'),
(5054, 'en', 'City*', 'City*', '2021-06-16 12:26:02', '2021-06-16 12:26:02'),
(5055, 'en', 'please,write your adress*', 'please,write your adress*', '2021-06-16 12:26:30', '2021-06-16 12:26:30'),
(5056, 'en', 'please check var is empty', 'please check var is empty', '2021-06-16 14:56:38', '2021-06-16 14:56:38'),
(5057, 'en', 'please check customer is empty', 'please check customer is empty', '2021-06-17 09:34:48', '2021-06-17 09:34:48'),
(5058, 'en', 'please,write your address*', 'please,write your address*', '2021-06-17 12:23:12', '2021-06-17 12:23:12'),
(5059, 'en', 'Order has been deleted successfully', 'Order has been deleted successfully', '2021-06-17 18:36:29', '2021-06-17 18:36:29'),
(5060, 'en', 'Edit Shipping', 'Edit Shipping', '2021-06-17 21:01:27', '2021-06-17 21:01:27'),
(5061, 'en', 'All Flash Deals', 'All Flash Deals', '2021-06-18 10:47:40', '2021-06-18 10:47:40'),
(5062, 'en', 'Create New Flash Deal', 'Create New Flash Deal', '2021-06-18 10:47:40', '2021-06-18 10:47:40'),
(5063, 'en', '#FFFFFF', '#FFFFFF', '2021-06-18 10:47:47', '2021-06-18 10:47:47'),
(5064, 'en', 'This image is shown as cover banner in flash deal details page.', 'This image is shown as cover banner in flash deal details page.', '2021-06-18 10:47:47', '2021-06-18 10:47:47'),
(5065, 'en', 'Special Offers', 'Special Offers', '2021-06-18 17:46:40', '2021-06-18 17:46:40'),
(5066, 'en', 'Offer Data', 'Offer Data', '2021-06-19 09:39:32', '2021-06-19 09:39:32'),
(5067, 'en', 'Add a suitable title for the Offer', 'Add a suitable title for the Offer', '2021-06-19 09:56:16', '2021-06-19 09:56:16'),
(5068, 'en', 'Offer Title', 'Offer Title', '2021-06-19 09:56:16', '2021-06-19 09:56:16'),
(5069, 'en', 'End Date Offer', 'End Date Offer', '2021-06-19 10:15:41', '2021-06-19 10:15:41'),
(5070, 'en', 'Offer Type', 'Offer Type', '2021-06-19 10:33:59', '2021-06-19 10:33:59'),
(5071, 'en', 'Select the type of discount to be applied to the cart', 'Select the type of discount to be applied to the cart', '2021-06-19 10:39:45', '2021-06-19 10:39:45'),
(5072, 'en', 'When the customer buy X get on y', 'When the customer buy X get on y', '2021-06-19 11:01:12', '2021-06-19 11:01:12'),
(5073, 'en', 'Fixed amount of customer purchases', 'Fixed amount of customer purchases', '2021-06-19 11:01:12', '2021-06-19 11:01:12'),
(5074, 'en', 'Percent of customer purchases', 'Percent of customer purchases', '2021-06-19 11:01:12', '2021-06-19 11:01:12'),
(5075, 'en', 'Offer Options', 'Offer Options', '2021-06-19 11:58:57', '2021-06-19 11:58:57'),
(5076, 'en', 'Quantify', 'Quantify', '2021-06-19 11:58:57', '2021-06-19 11:58:57'),
(5077, 'en', 'Choose Categories', 'Choose Categories', '2021-06-19 13:08:48', '2021-06-19 13:08:48'),
(5078, 'en', 'Products Items are Choosing ', 'Products Items are Choosing ', '2021-06-19 14:57:53', '2021-06-19 14:57:53'),
(5079, 'en', 'If the customer buys', 'If the customer buys', '2021-06-19 15:07:46', '2021-06-19 15:07:46'),
(5080, 'en', 'Select the products and quantity to be available in the cart to apply the discount', 'Select the products and quantity to be available in the cart to apply the discount', '2021-06-19 15:07:46', '2021-06-19 15:07:46'),
(5081, 'en', 'Determine what the customer gets when the previous condition is met', 'Determine what the customer gets when the previous condition is met', '2021-06-19 16:11:12', '2021-06-19 16:11:12'),
(5082, 'en', 'Customer gets', 'Customer gets', '2021-06-19 16:11:12', '2021-06-19 16:11:12'),
(5083, 'en', 'Discount Percent', 'Discount Percent', '2021-06-19 17:02:33', '2021-06-19 17:02:33'),
(5084, 'en', 'free product', 'free product', '2021-06-19 17:04:23', '2021-06-19 17:04:23'),
(5085, 'en', 'Products from', 'Products from', '2021-06-19 17:26:42', '2021-06-19 17:26:42'),
(5086, 'en', 'discount value', 'discount value', '2021-06-19 18:10:43', '2021-06-19 18:10:43'),
(5087, 'en', 'The customer received the discount', 'The customer received the discount', '2021-06-19 18:10:43', '2021-06-19 18:10:43'),
(5088, 'en', 'Maximum discount', 'Maximum discount', '2021-06-19 18:10:43', '2021-06-19 18:10:43'),
(5089, 'en', 'The total cost of the stimulus that the customer will receive may be', 'The total cost of the stimulus that the customer will receive may be', '2021-06-19 18:10:43', '2021-06-19 18:10:43'),
(5090, 'en', 'All products in the cart', 'All products in the cart', '2021-06-19 18:29:24', '2021-06-19 18:29:24'),
(5091, 'en', 'Selected Products', 'Selected Products', '2021-06-19 18:29:24', '2021-06-19 18:29:24'),
(5092, 'en', 'Selected Categories', 'Selected Categories', '2021-06-19 18:29:25', '2021-06-19 18:29:25'),
(5093, 'en', 'Selected Payment Methods', 'Selected Payment Methods', '2021-06-19 18:29:25', '2021-06-19 18:29:25'),
(5094, 'en', 'Offer applies to', 'Offer applies to', '2021-06-19 18:29:25', '2021-06-19 18:29:25'),
(5095, 'en', 'Choose one of the following conditions to apply the offer', 'Choose one of the following conditions to apply the offer', '2021-06-19 18:30:14', '2021-06-19 18:30:14'),
(5096, 'en', 'Paytab saudi', 'Paytab saudi', '2021-06-19 20:37:36', '2021-06-19 20:37:36'),
(5097, 'en', 'Paytab egypt', 'Paytab egypt', '2021-06-19 20:37:36', '2021-06-19 20:37:36'),
(5098, 'en', 'Payments', 'Payments', '2021-06-19 20:37:36', '2021-06-19 20:37:36'),
(5099, 'en', 'Choose Payments', 'Choose Payments', '2021-06-19 20:37:36', '2021-06-19 20:37:36'),
(5100, 'en', 'Limit Offer', 'Limit Offer', '2021-06-19 22:18:08', '2021-06-19 22:18:08'),
(5101, 'en', 'Limit for Purchese Price', 'Limit for Purchese Price', '2021-06-19 22:18:08', '2021-06-19 22:18:08'),
(5102, 'en', 'Limit for Product Quantity', 'Limit for Product Quantity', '2021-06-19 22:18:08', '2021-06-19 22:18:08'),
(5103, 'en', 'Limit for Products Quantity', 'Limit for Products Quantity', '2021-06-19 22:19:14', '2021-06-19 22:19:14'),
(5104, 'en', 'Apply the offer with the discount coupon', 'Apply the offer with the discount coupon', '2021-06-19 22:30:42', '2021-06-19 22:30:42'),
(5105, 'en', 'Create Special Offers', 'Create Special Offers', '2021-06-21 09:52:27', '2021-06-21 09:52:27'),
(5106, 'en', 'quantify1', 'quantify1', '2021-06-21 12:31:39', '2021-06-21 12:31:39'),
(5107, 'en', 'quantify2', 'quantify2', '2021-06-21 12:31:39', '2021-06-21 12:31:39'),
(5108, 'en', 'products1', 'products1', '2021-06-21 12:31:39', '2021-06-21 12:31:39'),
(5109, 'en', 'products2', 'products2', '2021-06-21 12:31:39', '2021-06-21 12:31:39'),
(5110, 'en', 'categories1', 'categories1', '2021-06-21 12:31:39', '2021-06-21 12:31:39'),
(5111, 'en', 'categories2', 'categories2', '2021-06-21 12:31:39', '2021-06-21 12:31:39'),
(5112, 'en', 'Data saved', 'Data saved', '2021-06-21 19:26:04', '2021-06-21 19:26:04'),
(5113, 'en', 'No Orders for this customer', 'No Orders for this customer', '2021-06-23 17:32:07', '2021-06-23 17:32:07'),
(5114, 'en', 'No Orders for this seller', 'No Orders for this seller', '2021-06-24 12:22:07', '2021-06-24 12:22:07'),
(5115, 'en', 'No Products for this seller', 'No Products for this seller', '2021-06-24 14:12:26', '2021-06-24 14:12:26'),
(5116, 'en', 'Firebase Settings', 'Firebase Settings', '2021-06-24 22:13:01', '2021-06-24 22:13:01'),
(5117, 'en', 'Sendmail', 'Sendmail', '2021-06-24 22:13:27', '2021-06-24 22:13:27'),
(5118, 'en', 'Mailgun', 'Mailgun', '2021-06-24 22:13:27', '2021-06-24 22:13:27'),
(5119, 'en', 'MAIL HOST', 'MAIL HOST', '2021-06-24 22:13:27', '2021-06-24 22:13:27'),
(5120, 'en', 'MAIL PORT', 'MAIL PORT', '2021-06-24 22:13:27', '2021-06-24 22:13:27'),
(5121, 'en', 'MAIL USERNAME', 'MAIL USERNAME', '2021-06-24 22:13:27', '2021-06-24 22:13:27'),
(5122, 'en', 'MAIL PASSWORD', 'MAIL PASSWORD', '2021-06-24 22:13:27', '2021-06-24 22:13:27'),
(5123, 'en', 'MAIL ENCRYPTION', 'MAIL ENCRYPTION', '2021-06-24 22:13:27', '2021-06-24 22:13:27'),
(5124, 'en', 'MAIL FROM ADDRESS', 'MAIL FROM ADDRESS', '2021-06-24 22:13:27', '2021-06-24 22:13:27'),
(5125, 'en', 'MAIL FROM NAME', 'MAIL FROM NAME', '2021-06-24 22:13:27', '2021-06-24 22:13:27'),
(5126, 'en', 'MAILGUN DOMAIN', 'MAILGUN DOMAIN', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5127, 'en', 'MAILGUN SECRET', 'MAILGUN SECRET', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5128, 'en', 'Save Configuration', 'Save Configuration', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5129, 'en', 'Test SMTP configuration', 'Test SMTP configuration', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5130, 'en', 'Enter your email address', 'Enter your email address', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5131, 'en', 'Send test email', 'Send test email', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5132, 'en', 'Instruction', 'Instruction', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5133, 'en', 'Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of order place, new registration, sending newsletter.', 'Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of order place, new registration, sending newsletter.', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5134, 'en', 'For Non-SSL', 'For Non-SSL', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5135, 'en', 'Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver ', 'Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver ', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5136, 'en', 'Set Mail Host according to your server Mail Client Manual Settings', 'Set Mail Host according to your server Mail Client Manual Settings', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5137, 'en', 'Set Mail port as 587', 'Set Mail port as 587', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5138, 'en', 'Set Mail Encryption as ssl if you face issue with tls', 'Set Mail Encryption as ssl if you face issue with tls', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5139, 'en', 'For SSL', 'For SSL', '2021-06-24 22:13:28', '2021-06-24 22:13:28'),
(5140, 'en', 'Set Mail port as 465', 'Set Mail port as 465', '2021-06-24 22:13:29', '2021-06-24 22:13:29'),
(5141, 'en', 'Set Mail Encryption as ssl', 'Set Mail Encryption as ssl', '2021-06-24 22:13:29', '2021-06-24 22:13:29'),
(5142, 'en', 'Firebase Configration', 'Firebase Configration', '2021-06-24 22:28:44', '2021-06-24 22:28:44'),
(5143, 'en', 'Auth Domain', 'Auth Domain', '2021-06-25 15:23:54', '2021-06-25 15:23:54'),
(5144, 'en', 'Project Id', 'Project Id', '2021-06-25 15:23:54', '2021-06-25 15:23:54'),
(5145, 'en', 'Storage Bucket', 'Storage Bucket', '2021-06-25 15:23:54', '2021-06-25 15:23:54'),
(5146, 'en', 'Messagin Sender Id', 'Messagin Sender Id', '2021-06-25 15:23:54', '2021-06-25 15:23:54'),
(5147, 'en', 'App Id', 'App Id', '2021-06-25 15:23:54', '2021-06-25 15:23:54'),
(5148, 'en', 'Measurement Id', 'Measurement Id', '2021-06-25 15:23:54', '2021-06-25 15:23:54'),
(5149, 'en', 'Save Data', 'Save Data', '2021-06-25 15:29:14', '2021-06-25 15:29:14'),
(5150, 'en', 'the var is required', 'the var is required', '2021-06-25 16:12:38', '2021-06-25 16:12:38'),
(5151, 'en', 'Data saved successfully', 'Data saved successfully', '2021-06-25 16:12:38', '2021-06-25 16:12:38'),
(5152, 'en', 'User Id', 'User Id', '2021-06-25 20:10:18', '2021-06-25 20:10:18'),
(5153, 'en', 'Edit Profile', 'Edit Profile', '2021-06-26 00:23:47', '2021-06-26 00:23:47'),
(5154, 'en', 'Change Photo', 'Change Photo', '2021-06-26 11:38:20', '2021-06-26 11:38:20'),
(5155, 'en', 'No Ordres for this customer', 'No Ordres for this customer', '2021-06-26 12:48:18', '2021-06-26 12:48:18'),
(5156, 'en', 'MAILCHIMP', 'MAILCHIMP', '2021-06-28 00:53:58', '2021-06-28 00:53:58'),
(5157, 'en', 'Saved successfully', 'Saved successfully', '2021-06-28 02:39:24', '2021-06-28 02:39:24'),
(5158, 'en', 'Send Mail', 'Send Mail', '2021-06-28 10:28:25', '2021-06-28 10:28:25'),
(5159, 'en', 'Content', 'Content', '2021-06-28 10:28:25', '2021-06-28 10:28:25'),
(5160, 'en', 'Details', 'Details', '2021-06-28 10:28:25', '2021-06-28 10:28:25'),
(5161, 'en', 'Mail View1', 'Mail View1', '2021-06-28 18:57:38', '2021-06-28 18:57:38'),
(5162, 'en', 'Text Btn Link', 'Text Btn Link', '2021-06-28 19:11:51', '2021-06-28 19:11:51'),
(5163, 'en', 'Mail Driver', 'Mail Driver', '2021-06-28 19:11:51', '2021-06-28 19:11:51'),
(5164, 'en', 'sent succesfully', 'sent succesfully', '2021-06-28 20:20:04', '2021-06-28 20:20:04'),
(5165, 'en', 'sent error', 'sent error', '2021-06-28 20:20:04', '2021-06-28 20:20:04'),
(5166, 'en', 'sent error please check user email or provider not correct', 'sent error please check user email or provider not correct', '2021-06-28 21:51:26', '2021-06-28 21:51:26'),
(5167, 'en', 'MailChimp', 'MailChimp', '2021-06-29 14:50:33', '2021-06-29 14:50:33'),
(5168, 'en', 'please check mail or driver', 'please check mail or driver', '2021-06-29 14:51:16', '2021-06-29 14:51:16'),
(5169, 'en', 'An email has been sent.', 'An email has been sent.', '2021-06-29 15:19:24', '2021-06-29 15:19:24'),
(5170, 'en', 'SMS Settings', 'SMS Settings', '2021-06-29 23:07:18', '2021-06-29 23:07:18'),
(5171, 'en', 'Provide Fekra', 'Provide Fekra', '2021-06-30 00:13:04', '2021-06-30 00:13:04'),
(5172, 'en', 'Sender Name', 'Sender Name', '2021-06-30 00:13:04', '2021-06-30 00:13:04'),
(5173, 'en', 'User Name', 'User Name', '2021-06-30 00:13:04', '2021-06-30 00:13:04'),
(5174, 'en', 'User Password', 'User Password', '2021-06-30 00:13:04', '2021-06-30 00:13:04'),
(5175, 'en', 'Sms Provider', 'Sms Provider', '2021-06-30 01:59:11', '2021-06-30 01:59:11'),
(5176, 'en', 'SMS Fekra', 'SMS Fekra', '2021-06-30 01:59:11', '2021-06-30 01:59:11'),
(5177, 'en', 'Send SMS', 'Send SMS', '2021-06-30 02:02:01', '2021-06-30 02:02:01'),
(5178, 'en', 'Count', 'Count', '2021-06-30 02:16:55', '2021-06-30 02:16:55'),
(5179, 'en', 'Parts', 'Parts', '2021-06-30 02:16:55', '2021-06-30 02:16:55'),
(5180, 'en', 'Enter Count', 'Enter Count', '2021-06-30 03:13:21', '2021-06-30 03:13:21'),
(5181, 'en', 'sent error. please check user phone or provider not correct', 'sent error. please check user phone or provider not correct', '2021-06-30 17:32:12', '2021-06-30 17:32:12'),
(5182, 'en', 'Role Information', 'Role Information', '2021-07-03 13:44:57', '2021-07-03 13:44:57'),
(5183, 'en', 'Permissions', 'Permissions', '2021-07-03 13:44:57', '2021-07-03 13:44:57'),
(5184, 'en', 'the Customer var_user Add New Product In Baskets a Price 72 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 72 Inclusive of Tax and Shipping sssssssssss', '2021-07-03 18:06:21', '2021-07-03 18:06:21'),
(5185, 'en', 'the Customer var_user Add New Product In Baskets a Price 86 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 86 Inclusive of Tax and Shipping sssssssssss', '2021-07-03 18:06:21', '2021-07-03 18:06:21'),
(5186, 'en', 'the Customer var_user Add New Product In Baskets a Price 246 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 246 Inclusive of Tax and Shipping sssssssssss', '2021-07-03 18:06:21', '2021-07-03 18:06:21'),
(5187, 'en', 'the Customer var_user Add New Product In Baskets a Price 240 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 240 Inclusive of Tax and Shipping sssssssssss', '2021-07-03 18:06:21', '2021-07-03 18:06:21'),
(5188, 'en', 'the Customer var_user Add New Product In Baskets a Price 123 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 123 Inclusive of Tax and Shipping sssssssssss', '2021-07-03 18:06:21', '2021-07-03 18:06:21'),
(5189, 'en', 'New Special Offer', 'New Special Offer', '2021-07-04 17:12:01', '2021-07-04 17:12:01'),
(5190, 'en', 'If you buy a number_var_x of product_var_x, you get a number_var_y of product_var_y', 'If you buy a number_var_x of product_var_x, you get a number_var_y of product_var_y', '2021-07-05 22:55:48', '2021-07-05 22:55:48'),
(5191, 'en', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum amount of purchases is var_price', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum amount of purchases is var_price', '2021-07-06 03:44:29', '2021-07-06 03:44:29'),
(5192, 'en', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum quantity of products is var_count', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum quantity of products is var_count', '2021-07-06 03:44:29', '2021-07-06 03:44:29'),
(5193, 'en', 'If you buy one of these products, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price', 'If you buy one of these products, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price', '2021-07-06 03:44:29', '2021-07-06 03:44:29'),
(5194, 'en', 'If you buy one of these products, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimumquantity of products is var_count', 'If you buy one of these products, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimumquantity of products is var_count', '2021-07-06 03:44:29', '2021-07-06 03:44:29'),
(5195, 'en', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price', '2021-07-06 04:05:19', '2021-07-06 04:05:19'),
(5196, 'en', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimumquantity of products is var_count', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimumquantity of products is var_count', '2021-07-06 04:05:19', '2021-07-06 04:05:19'),
(5197, 'en', 'All products in Cart', 'All products in Cart', '2021-07-06 04:07:35', '2021-07-06 04:07:35'),
(5198, 'en', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum quantity of products is var_count', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum quantity of products is var_count', '2021-07-06 04:09:55', '2021-07-06 04:09:55'),
(5199, 'en', 'the Customer var_user Add New Product In Baskets a Price 480 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 480 Inclusive of Tax and Shipping sssssssssss', '2021-07-06 20:04:38', '2021-07-06 20:04:38'),
(5200, 'en', 'the Customer var_user Add New Product In Baskets a Price 222 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 222 Inclusive of Tax and Shipping sssssssssss', '2021-07-06 20:07:25', '2021-07-06 20:07:25'),
(5201, 'en', 'the Customer var_user Add New Product In Baskets a Price 77 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 77 Inclusive of Tax and Shipping sssssssssss', '2021-07-06 20:07:59', '2021-07-06 20:07:59'),
(5202, 'en', 'the Customer var_user Add New Product In Baskets a Price 113 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 113 Inclusive of Tax and Shipping sssssssssss', '2021-07-06 21:53:22', '2021-07-06 21:53:22'),
(5203, 'en', 'the Customer var_user Add New Product In Baskets a Price 116 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 116 Inclusive of Tax and Shipping sssssssssss', '2021-07-06 21:53:23', '2021-07-06 21:53:23'),
(5204, 'en', 'the Customer var_user Add New Product In Baskets a Price 74 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 74 Inclusive of Tax and Shipping sssssssssss', '2021-07-06 21:55:42', '2021-07-06 21:55:42'),
(5205, 'en', 'the Customer var_user Add New Product In Baskets a Price 97 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 97 Inclusive of Tax and Shipping sssssssssss', '2021-07-06 21:55:42', '2021-07-06 21:55:42'),
(5206, 'en', 'the Customer var_user Add New Product In Baskets a Price 93 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 93 Inclusive of Tax and Shipping sssssssssss', '2021-07-06 22:29:28', '2021-07-06 22:29:28'),
(5207, 'en', 'the Customer var_user Add New Product In Baskets a Price 104 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 104 Inclusive of Tax and Shipping sssssssssss', '2021-07-06 22:29:28', '2021-07-06 22:29:28'),
(5208, 'en', 'All cities', 'All cities', '2021-07-07 05:52:10', '2021-07-07 05:52:10'),
(5209, 'en', 'Cities', 'Cities', '2021-07-07 05:52:10', '2021-07-07 05:52:10'),
(5210, 'en', 'Add New city', 'Add New city', '2021-07-07 05:52:10', '2021-07-07 05:52:10'),
(5211, 'en', 'Product has been inserted successfully', 'Product has been inserted successfully', '2021-07-07 17:44:34', '2021-07-07 17:44:34'),
(5212, 'en', 'All Attributes', 'All Attributes', '2021-07-07 21:47:47', '2021-07-07 21:47:47'),
(5213, 'en', 'Add New Attribute', 'Add New Attribute', '2021-07-07 21:47:47', '2021-07-07 21:47:47'),
(5214, 'en', 'Commission History report', 'Commission History report', '2021-07-07 21:50:09', '2021-07-07 21:50:09'),
(5215, 'en', 'Choose Seller', 'Choose Seller', '2021-07-07 21:50:09', '2021-07-07 21:50:09'),
(5216, 'en', 'Admin Commission', 'Admin Commission', '2021-07-07 21:50:09', '2021-07-07 21:50:09'),
(5217, 'en', 'Seller Earning', 'Seller Earning', '2021-07-07 21:50:10', '2021-07-07 21:50:10'),
(5218, 'en', 'Add New Post', 'Add New Post', '2021-07-07 21:50:33', '2021-07-07 21:50:33'),
(5219, 'en', 'All blog posts', 'All blog posts', '2021-07-07 21:50:33', '2021-07-07 21:50:33'),
(5220, 'en', 'Short Description', 'Short Description', '2021-07-07 21:50:33', '2021-07-07 21:50:33'),
(5221, 'en', 'Change blog status successfully', 'Change blog status successfully', '2021-07-07 21:50:33', '2021-07-07 21:50:33'),
(5222, 'en', 'All Blog Categories', 'All Blog Categories', '2021-07-07 21:50:38', '2021-07-07 21:50:38'),
(5223, 'en', 'Blog Categories', 'Blog Categories', '2021-07-07 21:50:38', '2021-07-07 21:50:38'),
(5224, 'en', 'Support Desk', 'Support Desk', '2021-07-07 21:51:32', '2021-07-07 21:51:32'),
(5225, 'en', 'Type ticket code & Enter', 'Type ticket code & Enter', '2021-07-07 21:51:32', '2021-07-07 21:51:32'),
(5226, 'en', 'User', 'User', '2021-07-07 21:51:32', '2021-07-07 21:51:32'),
(5227, 'en', 'Last reply', 'Last reply', '2021-07-07 21:51:33', '2021-07-07 21:51:33'),
(5228, 'en', 'All Taxes', 'All Taxes', '2021-07-07 21:52:18', '2021-07-07 21:52:18'),
(5229, 'en', 'Add New Tax', 'Add New Tax', '2021-07-07 21:52:18', '2021-07-07 21:52:18'),
(5230, 'en', 'Tax Type', 'Tax Type', '2021-07-07 21:52:18', '2021-07-07 21:52:18'),
(5231, 'en', 'Tax Name', 'Tax Name', '2021-07-07 21:52:19', '2021-07-07 21:52:19'),
(5232, 'en', 'Tax status updated successfully', 'Tax status updated successfully', '2021-07-07 21:52:19', '2021-07-07 21:52:19'),
(5233, 'en', 'No Manager', 'No Manager', '2021-07-07 21:52:24', '2021-07-07 21:52:24'),
(5234, 'en', 'At the very bottom, you can find the “Facebook Page ID”', 'At the very bottom, you can find the “Facebook Page ID”', '2021-07-07 21:52:52', '2021-07-07 21:52:52'),
(5235, 'en', 'Go to Settings of your page and find the option of \"Advance Messaging\"', 'Go to Settings of your page and find the option of \"Advance Messaging\"', '2021-07-07 21:52:52', '2021-07-07 21:52:52'),
(5236, 'en', 'Scroll down that page and you will get \"white listed domain\"', 'Scroll down that page and you will get \"white listed domain\"', '2021-07-07 21:52:52', '2021-07-07 21:52:52'),
(5237, 'en', 'Facebook Comment Setting', 'Facebook Comment Setting', '2021-07-07 21:53:04', '2021-07-07 21:53:04'),
(5238, 'en', 'Facebook App ID', 'Facebook App ID', '2021-07-07 21:53:04', '2021-07-07 21:53:04'),
(5239, 'en', 'Please be carefull when you are configuring Facebook Comment. For incorrect configuration you will not get comment section on your user-end site.', 'Please be carefull when you are configuring Facebook Comment. For incorrect configuration you will not get comment section on your user-end site.', '2021-07-07 21:53:04', '2021-07-07 21:53:04'),
(5240, 'en', 'After then go to this URL https://developers.facebook.com/apps/', 'After then go to this URL https://developers.facebook.com/apps/', '2021-07-07 21:53:04', '2021-07-07 21:53:04'),
(5241, 'en', 'Create Your App', 'Create Your App', '2021-07-07 21:53:04', '2021-07-07 21:53:04'),
(5242, 'en', 'In Dashboard page you will get your App ID', 'In Dashboard page you will get your App ID', '2021-07-07 21:53:05', '2021-07-07 21:53:05'),
(5243, 'en', 'Area Wise Flat Shipping Cost', 'Area Wise Flat Shipping Cost', '2021-07-07 21:53:22', '2021-07-07 21:53:22'),
(5244, 'en', 'Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If customers purchase 2 product from two seller shipping cost is calculated by addition of each seller flat shipping cost', 'Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If customers purchase 2 product from two seller shipping cost is calculated by addition of each seller flat shipping cost', '2021-07-07 21:53:22', '2021-07-07 21:53:22'),
(5245, 'en', 'Area Wise Flat Shipping Cost calulation: Fixed rate for each area. If customers purchase multiple products from one seller shipping cost is calculated by the customer shipping area. To configure area wise shipping cost go to ', 'Area Wise Flat Shipping Cost calulation: Fixed rate for each area. If customers purchase multiple products from one seller shipping cost is calculated by the customer shipping area. To configure area wise shipping cost go to ', '2021-07-07 21:53:23', '2021-07-07 21:53:23'),
(5246, 'en', '1. Flat rate shipping cost is applicable if Flat rate shipping is enabled.', '1. Flat rate shipping cost is applicable if Flat rate shipping is enabled.', '2021-07-07 21:53:23', '2021-07-07 21:53:23'),
(5247, 'en', '1. Shipping cost for admin is applicable if Seller wise shipping cost is enabled.', '1. Shipping cost for admin is applicable if Seller wise shipping cost is enabled.', '2021-07-07 21:53:23', '2021-07-07 21:53:23'),
(5248, 'en', 'Update your system', 'Update your system', '2021-07-07 21:54:09', '2021-07-07 21:54:09'),
(5249, 'en', 'Current verion', 'Current verion', '2021-07-07 21:54:09', '2021-07-07 21:54:09'),
(5250, 'en', 'Make sure your server has matched with all requirements.', 'Make sure your server has matched with all requirements.', '2021-07-07 21:54:09', '2021-07-07 21:54:09'),
(5251, 'en', 'Check Here', 'Check Here', '2021-07-07 21:54:09', '2021-07-07 21:54:09'),
(5252, 'en', 'Download latest version from codecanyon.', 'Download latest version from codecanyon.', '2021-07-07 21:54:09', '2021-07-07 21:54:09'),
(5253, 'en', 'Extract downloaded zip. You will find updates.zip file in those extraced files.', 'Extract downloaded zip. You will find updates.zip file in those extraced files.', '2021-07-07 21:54:09', '2021-07-07 21:54:09'),
(5254, 'en', 'Upload that zip file here and click update now.', 'Upload that zip file here and click update now.', '2021-07-07 21:54:09', '2021-07-07 21:54:09'),
(5255, 'en', 'If you are using any addon make sure to update those addons after updating.', 'If you are using any addon make sure to update those addons after updating.', '2021-07-07 21:54:09', '2021-07-07 21:54:09'),
(5256, 'en', 'Server information', 'Server information', '2021-07-07 21:54:26', '2021-07-07 21:54:26'),
(5257, 'en', 'Current Version', 'Current Version', '2021-07-07 21:54:26', '2021-07-07 21:54:26'),
(5258, 'en', 'Required Version', 'Required Version', '2021-07-07 21:54:26', '2021-07-07 21:54:26'),
(5259, 'en', 'php.ini Config', 'php.ini Config', '2021-07-07 21:54:27', '2021-07-07 21:54:27'),
(5260, 'en', 'Config Name', 'Config Name', '2021-07-07 21:54:27', '2021-07-07 21:54:27'),
(5261, 'en', 'Current', 'Current', '2021-07-07 21:54:27', '2021-07-07 21:54:27'),
(5262, 'en', 'Recommended', 'Recommended', '2021-07-07 21:54:27', '2021-07-07 21:54:27'),
(5263, 'en', 'Extensions information', 'Extensions information', '2021-07-07 21:54:27', '2021-07-07 21:54:27'),
(5264, 'en', 'Extension Name', 'Extension Name', '2021-07-07 21:54:27', '2021-07-07 21:54:27'),
(5265, 'en', 'Filesystem Permissions', 'Filesystem Permissions', '2021-07-07 21:54:27', '2021-07-07 21:54:27'),
(5266, 'en', 'File or Folder', 'File or Folder', '2021-07-07 21:54:27', '2021-07-07 21:54:27'),
(5267, 'en', 'Email already used', 'Email already used', '2021-07-08 04:34:33', '2021-07-08 04:34:33'),
(5268, 'en', 'Staff has been inserted successfully', 'Staff has been inserted successfully', '2021-07-08 04:38:10', '2021-07-08 04:38:10'),
(5269, 'en', 'of', 'of', '2021-07-08 21:49:45', '2021-07-08 21:49:45'),
(5270, 'en', 'Total pendding sellers', 'Total pendding sellers', '2021-07-10 02:56:30', '2021-07-10 02:56:30'),
(5271, 'en', 'Select Payment Option.', 'Select Payment Option.', '2021-07-10 16:26:38', '2021-07-10 16:26:38'),
(5272, 'en', 'Number of sales products', 'Number of sales products', '2021-07-14 02:04:38', '2021-07-14 02:04:38'),
(5273, 'en', 'Number of stock products', 'Number of stock products', '2021-07-14 02:04:39', '2021-07-14 02:04:39'),
(5274, 'en', 'Quantity Product', 'Quantity Product', '2021-07-15 17:56:30', '2021-07-15 17:56:30'),
(5275, 'en', 'product_id', 'product_id', '2021-07-15 21:07:51', '2021-07-15 21:07:51'),
(5276, 'en', 'product_name', 'product_name', '2021-07-15 21:07:51', '2021-07-15 21:07:51'),
(5277, 'en', 'product_price', 'product_price', '2021-07-15 21:07:51', '2021-07-15 21:07:51'),
(5278, 'en', 'product_quantity', 'product_quantity', '2021-07-15 21:07:51', '2021-07-15 21:07:51'),
(5279, 'en', 'Product Stock', 'Product Stock', '2021-07-17 00:27:44', '2021-07-17 00:27:44'),
(5280, 'en', 'the Customer var_user Add New Product In Baskets a Price 340 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 340 Inclusive of Tax and Shipping sssssssssss', '2021-07-17 15:01:09', '2021-07-17 15:01:09'),
(5281, 'en', 'the Customer var_user Add New Product In Baskets a Price 415 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 415 Inclusive of Tax and Shipping sssssssssss', '2021-07-17 15:01:09', '2021-07-17 15:01:09'),
(5282, 'en', 'the Customer var_user Add New Product In Baskets a Price 919 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 919 Inclusive of Tax and Shipping sssssssssss', '2021-07-17 15:01:09', '2021-07-17 15:01:09'),
(5283, 'en', 'AVG Bascktes', 'AVG Bascktes', '2021-07-18 16:35:35', '2021-07-18 16:35:35'),
(5284, 'en', 'Choose Branch Report', 'Choose Branch Report', '2021-07-18 20:04:28', '2021-07-18 20:04:28'),
(5285, 'en', 'Sales Products', 'Sales Products', '2021-07-18 20:04:28', '2021-07-18 20:04:28'),
(5286, 'en', 'Sales Brands', 'Sales Brands', '2021-07-18 20:04:28', '2021-07-18 20:04:28'),
(5287, 'en', 'Sales Categories', 'Sales Categories', '2021-07-18 20:04:28', '2021-07-18 20:04:28'),
(5288, 'en', 'Sales Coupons', 'Sales Coupons', '2021-07-18 20:04:28', '2021-07-18 20:04:28'),
(5289, 'en', 'Product Quantity', 'Product Quantity', '2021-07-19 06:07:38', '2021-07-19 06:07:38'),
(5290, 'en', 'Date Add In Baskets', 'Date Add In Baskets', '2021-07-19 12:55:00', '2021-07-19 12:55:00'),
(5291, 'en', 'Basket Product Price', 'Basket Product Price', '2021-07-19 12:55:00', '2021-07-19 12:55:00'),
(5292, 'en', 'Number Product Sales', 'Number Product Sales', '2021-07-21 02:48:18', '2021-07-21 02:48:18'),
(5293, 'en', 'Product Sales Total Prices', 'Product Sales Total Prices', '2021-07-21 02:48:18', '2021-07-21 02:48:18'),
(5294, 'en', 'Total Coupons Discount Amount', 'Total Coupons Discount Amount', '2021-07-21 06:24:55', '2021-07-21 06:24:55'),
(5295, 'en', 'Total Coupons Discount Percent', 'Total Coupons Discount Percent', '2021-07-21 06:24:55', '2021-07-21 06:24:55'),
(5296, 'en', 'Total Coupons Usages', 'Total Coupons Usages', '2021-07-21 06:24:56', '2021-07-21 06:24:56'),
(5297, 'en', 'Coupons Number Usage', 'Coupons Number Usage', '2021-07-21 06:24:56', '2021-07-21 06:24:56'),
(5298, 'en', 'slightly satisfied', 'slightly satisfied', '2021-07-21 09:25:28', '2021-07-21 09:25:28'),
(5299, 'en', 'fully satisfied', 'fully satisfied', '2021-07-21 09:25:28', '2021-07-21 09:25:28'),
(5300, 'en', 'angry', 'angry', '2021-07-21 09:25:28', '2021-07-21 09:25:28'),
(5301, 'en', 'not satisfied', 'not satisfied', '2021-07-21 09:25:28', '2021-07-21 09:25:28'),
(5302, 'en', 'satisfied', 'satisfied', '2021-07-21 09:25:28', '2021-07-21 09:25:28'),
(5303, 'en', 'customer purches', 'customer purches', '2021-07-21 10:11:23', '2021-07-21 10:11:23'),
(5304, 'en', 'customer not purches', 'customer not purches', '2021-07-21 10:11:23', '2021-07-21 10:11:23'),
(5305, 'en', 'highest paying customers', 'highest paying customers', '2021-07-21 10:43:43', '2021-07-21 10:43:43'),
(5306, 'en', 'Customer Sales', 'Customer Sales', '2021-07-21 11:32:02', '2021-07-21 11:32:02'),
(5307, 'en', 'Customer Review', 'Customer Review', '2021-07-21 11:32:02', '2021-07-21 11:32:02'),
(5308, 'en', 'sunday', 'sunday', '2021-07-21 18:42:35', '2021-07-21 18:42:35'),
(5309, 'en', 'monday', 'monday', '2021-07-21 18:42:35', '2021-07-21 18:42:35'),
(5310, 'en', 'tuesday', 'tuesday', '2021-07-21 18:42:35', '2021-07-21 18:42:35'),
(5311, 'en', 'wedinsday', 'wedinsday', '2021-07-21 18:42:36', '2021-07-21 18:42:36'),
(5312, 'en', 'thursday', 'thursday', '2021-07-21 18:42:36', '2021-07-21 18:42:36'),
(5313, 'en', 'friday', 'friday', '2021-07-21 18:42:37', '2021-07-21 18:42:37'),
(5314, 'en', 'saterday', 'saterday', '2021-07-21 18:42:37', '2021-07-21 18:42:37'),
(5315, 'en', 'Wednesday', 'Wednesday', '2021-07-21 19:56:50', '2021-07-21 19:56:50'),
(5316, 'en', 'Most Wanted Days', 'Most Wanted Days', '2021-07-21 20:02:49', '2021-07-21 20:02:49'),
(5317, 'en', 'Most Orders Customers', 'Most Orders Customers', '2021-07-21 20:53:11', '2021-07-21 20:53:11'),
(5318, 'en', 'Number Order Sales', 'Number Order Sales', '2021-07-22 02:33:19', '2021-07-22 02:33:19'),
(5319, 'en', 'search id', 'search id', '2021-07-22 11:35:12', '2021-07-22 11:35:12'),
(5320, 'en', 'search seller name', 'search seller name', '2021-07-22 14:00:51', '2021-07-22 14:00:51'),
(5321, 'en', 'search customer name', 'search customer name', '2021-07-22 14:00:51', '2021-07-22 14:00:51'),
(5322, 'en', 'search grand total', 'search grand total', '2021-07-22 14:28:11', '2021-07-22 14:28:11'),
(5323, 'en', 'search order code', 'search order code', '2021-07-22 14:28:11', '2021-07-22 14:28:11'),
(5324, 'en', 'Search Data', 'Search Data', '2021-07-23 07:11:32', '2021-07-23 07:11:32'),
(5325, 'en', 'search Balance', 'search Balance', '2021-07-23 11:52:14', '2021-07-23 11:52:14'),
(5326, 'en', 'search email', 'search email', '2021-07-23 11:52:14', '2021-07-23 11:52:14'),
(6129, 'sa', 'All Category', 'كل الفئات', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6130, 'sa', 'All', 'الكل', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6131, 'sa', 'Flash Sale', 'بيع مفاجئ', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6132, 'sa', 'View More', 'عرض المزيد', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6133, 'sa', 'Add to wishlist', 'أضف إلى قائمة الرغبات', '2021-02-09 04:47:58', '2021-09-25 13:14:32'),
(6134, 'sa', 'Add to compare', 'أضف للمقارنة', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6135, 'sa', 'Add to cart', 'أضف إلى السلة', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6136, 'sa', 'Club Point', 'كلوب بوينت', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6137, 'sa', 'Classified Ads', 'الإعلانات المبوبة', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6138, 'sa', 'Used', 'مستخدم', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6139, 'sa', 'Top 10 Categories', 'أعلى 10 فئات', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6140, 'sa', 'View All Categories', 'عرض جميع الفئات', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6141, 'sa', 'Top 10 Brands', 'أفضل 10 ماركات', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6142, 'sa', 'View All Brands', 'عرض كل الماركات', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6143, 'sa', 'Terms & conditions', 'البنود و الظروف', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6144, 'sa', 'Best Selling', 'أفضل مبيعات', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6145, 'sa', 'Top 20', 'أفضل 20', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6146, 'sa', 'Featured Products', 'منتجات مميزة', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6147, 'sa', 'Best Sellers', 'أفضل البائعين', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6148, 'sa', 'Visit Store', 'قم بزيارة المعرض او المتجر', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6149, 'sa', 'Popular Suggestions', 'الاقتراحات الشعبية', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6150, 'sa', 'Category Suggestions', 'اقتراحات الفئة', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6151, 'sa', 'Automobile & Motorcycle', 'السيارات والدراجات النارية', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6152, 'sa', 'Price range', 'نطاق السعر', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6153, 'sa', 'Filter by color', 'تصفية حسب اللون', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6154, 'sa', 'Home', 'الصفحة الرئيسية', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6155, 'sa', 'Newest', 'الأحدث', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6156, 'sa', 'Oldest', 'الأقدم', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6157, 'sa', 'Price low to high', 'السعر من الارخص للاعلى', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6158, 'sa', 'Price high to low', 'السعر الاعلى الى الادنى', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6159, 'sa', 'Brands', 'العلامات التجارية', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6160, 'sa', 'All Brands', 'جميع العلامات التجارية', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6161, 'sa', 'All Sellers', 'كل البائعين', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6162, 'sa', 'Inhouse product', 'منتج داخلي', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6163, 'sa', 'Message Seller', 'مراسلة البائع', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6164, 'sa', 'Price', 'السعر', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6165, 'sa', 'Discount Price', 'سعر الخصم', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6166, 'sa', 'Color', 'اللون', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6167, 'sa', 'Quantity', 'كمية', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6168, 'sa', 'available', 'متاح', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6169, 'sa', 'Total Price', 'السعر الكلي', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6170, 'sa', 'Out of Stock', 'إنتهى من المخزن', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6171, 'sa', 'Refund', 'إعادة مال', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6172, 'sa', 'Share', 'شارك', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6173, 'sa', 'Sold By', 'تم بيعها من قبل', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6174, 'sa', 'customer reviews', 'آراء العملاء', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6175, 'sa', 'Top Selling Products', 'المنتجات الأكثر مبيعًا', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6176, 'sa', 'Description', 'وصف', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6177, 'sa', 'Video', 'فيديو', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6178, 'sa', 'Reviews', 'المراجعات', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6179, 'sa', 'Download', 'تحميل', '2021-02-09 04:47:58', '2021-02-09 04:47:58');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(6180, 'sa', 'There have been no reviews for this product yet.', 'لم تكن هناك مراجعات لهذا المنتج حتى الآن.', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6181, 'sa', 'Related products', 'منتجات ذات صله', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6182, 'sa', 'Any query about this product', 'أي استفسار عن هذا المنتج', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6183, 'sa', 'Product Name', 'اسم المنتج', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6184, 'sa', 'Your Question', 'سؤالك', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6185, 'sa', 'Send', 'إرسال', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6186, 'sa', 'Use country code before number', 'استخدم رمز البلد قبل الرقم', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6187, 'sa', 'Remember Me', 'تذكرنى', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6188, 'sa', 'Dont have an account?', 'ليس لديك حساب؟', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6189, 'sa', 'Register Now', 'سجل الان', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6190, 'sa', 'Or Login With', 'أو تسجيل الدخول باستخدام', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6191, 'sa', 'oops..', 'وجه الفتاة..', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6192, 'sa', 'This item is out of stock!', 'هذا العنصر غير متوفر في المخزون!', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6193, 'sa', 'Back to shopping', 'العودة إلى التسوق', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6194, 'sa', 'Login to your account.', 'تسجيل الدخول إلى حسابك.', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6195, 'sa', 'Purchase History', 'تاريخ شراء', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6196, 'sa', 'New', 'جديد', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6197, 'sa', 'Downloads', 'التحميلات', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6198, 'sa', 'Sent Refund Request', 'طلب استرداد مرسل', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6199, 'sa', 'Product Bulk Upload', 'تحميل مجمع للمنتج', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6200, 'sa', 'Orders', 'الطلبات', '2021-02-09 04:47:58', '2021-02-09 04:47:58'),
(6201, 'sa', 'Recieved Refund Request', 'تم استلام طلب استرداد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6202, 'sa', 'Shop Setting', 'إعداد المتجر', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6203, 'sa', 'Payment History', 'تاريخ الدفع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6204, 'sa', 'Money Withdraw', 'سحب الأموال', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6205, 'sa', 'Conversations', 'المحادثات', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6206, 'sa', 'My Wallet', 'محفظتى', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6207, 'sa', 'Earning Points', 'كسب النقاط', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6208, 'sa', 'Support Ticket', 'بطاقة الدعم', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6209, 'sa', 'Manage Profile', 'إدارة الملف الشخصي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6210, 'sa', 'Sold Amount', 'المبلغ المباع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6211, 'sa', 'Your sold amount (current month)', 'المبلغ المباع (الشهر الحالي)', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6212, 'sa', 'Total Sold', 'إجمالي المبيعات', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6213, 'sa', 'Last Month Sold', 'تم بيع الشهر الماضي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6214, 'sa', 'Total sale', 'إجمالي البيع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6215, 'sa', 'Total earnings', 'الأرباح الكلية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6216, 'sa', 'Successful orders', 'الطلبات الناجحة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6217, 'sa', 'Total orders', 'إجمالي الطلبات', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6218, 'sa', 'Pending orders', 'الطلبات المعلقة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6219, 'sa', 'Cancelled orders', 'الطلبات الملغاة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6220, 'sa', 'Product', 'المنتج', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6221, 'sa', 'Purchased Package', 'الحزمة المشتراة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6222, 'sa', 'Package Not Found', 'الحزمة غير موجودة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6223, 'sa', 'Upgrade Package', 'حزمة الترقية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6224, 'sa', 'Shop', 'متجر', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6225, 'sa', 'Manage & organize your shop', 'إدارة وتنظيم متجرك', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6226, 'sa', 'Go to setting', 'اذهب إلى الإعداد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6227, 'sa', 'Payment', 'دفع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6228, 'sa', 'Configure your payment method', 'تكوين طريقة الدفع الخاصة بك', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6229, 'sa', 'My Panel', 'لوحتي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6230, 'sa', 'Item has been added to wishlist', 'تمت إضافة العنصر إلى قائمة الرغبات', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6231, 'sa', 'My Points', 'نقاطي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6232, 'sa', ' Points', 'نقاط', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6233, 'sa', 'Wallet Money', 'أموال المحفظة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6234, 'sa', 'Exchange Rate', 'سعر الصرف', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6235, 'sa', 'Point Earning history', 'سجل كسب النقاط', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6236, 'sa', 'Date', 'تاريخ', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6237, 'sa', 'Points', 'نقاط', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6238, 'sa', 'Converted', 'محولة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6239, 'sa', 'Action', 'عمل', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6240, 'sa', 'No history found.', 'لم يتم العثور على سجل.', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6241, 'sa', 'Convert has been done successfully Check your Wallets', 'تم التحويل بنجاح تحقق من محافظك', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6242, 'sa', 'Something went wrong', 'هناك خطأ ما', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6243, 'sa', 'Remaining Uploads', 'التحميلات المتبقية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6244, 'sa', 'No Package Found', 'لم يتم العثور على حزمة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6245, 'sa', 'Search product', 'البحث عن المنتج', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6246, 'sa', 'Name', 'اسم', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6247, 'sa', 'Current Qty', 'الكمية الحالية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6248, 'sa', 'Base Price', 'السعر الأساسي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6249, 'sa', 'Published', 'نشرت', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6250, 'sa', 'Featured', 'متميز', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6251, 'sa', 'Options', 'خيارات', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6252, 'sa', 'Edit', 'تعديل', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6253, 'sa', 'Duplicate', 'مكرر', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6254, 'sa', '1. Download the skeleton file and fill it with data.', '1. قم بتنزيل ملف الهيكل العظمي واملأه بالبيانات.', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6255, 'sa', '2. You can download the example file to understand how the data must be filled.', '2. يمكنك تنزيل ملف المثال لفهم كيفية ملء البيانات.', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6256, 'sa', '3. Once you have downloaded and filled the skeleton file, upload it in the form below and submit.', '3. بمجرد تنزيل ملف الهيكل العظمي وتعبئته ، قم بتحميله في النموذج أدناه وأرسله.', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6257, 'sa', '4. After uploading products you need to edit them and set products images and choices.', '4. بعد تحميل المنتجات تحتاج إلى تعديلها وتعيين صور المنتجات والاختيارات.', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6258, 'sa', 'Download CSV', 'تنزيل ملف CSV', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6259, 'sa', '1. Category,Sub category,Sub Sub category and Brand should be in numerical ids.', '1. يجب أن تكون الفئة ، والفئة الفرعية ، والفئة الفرعية والعلامة التجارية في هويات رقمية.', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6260, 'sa', '2. You can download the pdf to get Category,Sub category,Sub Sub category and Brand id.', '2. يمكنك تنزيل ملف pdf للحصول على الفئة والفئة الفرعية والفئة الفرعية ومعرف العلامة التجارية.', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6261, 'sa', 'Download Category', 'فئة التحميل', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6262, 'sa', 'Download Sub category', 'تحميل فئة فرعية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6263, 'sa', 'Download Sub Sub category', 'تحميل فئة فرعية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6264, 'sa', 'Download Brand', 'تحميل الماركة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6265, 'sa', 'Upload CSV File', 'تحميل ملف CSV', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6266, 'sa', 'CSV', 'CSV', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6267, 'sa', 'Choose CSV File', 'اختر ملف CSV', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6268, 'sa', 'Upload', 'تحميل', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6269, 'sa', 'Add New Digital Product', 'إضافة منتج رقمي جديد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6270, 'sa', 'Available Status', 'الحالة المتاحة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6271, 'sa', 'Admin Status', 'حالة المسؤول', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6272, 'sa', 'Pending Balance', 'رصيد معلق', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6273, 'sa', 'Send Withdraw Request', 'إرسال طلب سحب', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6274, 'sa', 'Withdraw Request history', 'سحب تاريخ الطلب', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6275, 'sa', 'Amount', 'كمية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6276, 'sa', 'Status', 'الحالة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6277, 'sa', 'Message', 'رسالة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6278, 'sa', 'Send A Withdraw Request', 'إرسال طلب سحب', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6279, 'sa', 'Basic Info', 'معلومات أساسية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6280, 'sa', 'Your Phone', 'هاتفك', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6281, 'sa', 'Photo', 'صورة فوتوغرافية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6282, 'sa', 'Browse', 'تصفح', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6283, 'sa', 'Your Password', 'كلمتك السرية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6284, 'sa', 'New Password', 'كلمة المرور الجديدة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6285, 'sa', 'Confirm Password', 'تأكيد كلمة المرور', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6286, 'sa', 'Add New Address', 'أضف عنوان جديد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6287, 'sa', 'Payment Setting', 'إعداد الدفع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6288, 'sa', 'Cash Payment', 'دفع نقدا', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6289, 'sa', 'Bank Payment', 'الدفع المصرفية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6290, 'sa', 'Bank Name', 'اسم البنك', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6291, 'sa', 'Bank Account Name', 'اسم الحساب المصرفي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6292, 'sa', 'Bank Account Number', 'رقم الحساب المصرفي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6293, 'sa', 'Bank Routing Number', 'رقم التحويل المصرفي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6294, 'sa', 'Update Profile', 'تحديث الملف', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6295, 'sa', 'Change your email', 'قم بتغيير بريدك الإلكتروني', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6296, 'sa', 'Your Email', 'بريدك الالكتروني', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6297, 'sa', 'Sending Email...', 'إرسال البريد الإلكتروني...', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6298, 'sa', 'Verify', 'تحقق', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6299, 'sa', 'Update Email', 'تحديث البريد الإلكتروني', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6300, 'sa', 'New Address', 'عنوان جديد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6301, 'sa', 'Your Address', 'عنوانك', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6302, 'sa', 'Country', 'بلد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6303, 'sa', 'Select your country', 'اختر بلدك', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6304, 'sa', 'City', 'مدينة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6305, 'sa', 'Your City', 'مدينتك', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6306, 'sa', 'Your Postal Code', 'رمزك البريدي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6307, 'sa', '+880', '+880', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6308, 'sa', 'Save', 'حفظ', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6309, 'sa', 'Received Refund Request', 'تم استلام طلب استرداد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6310, 'sa', 'Delete Confirmation', 'تأكيد الحذف', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6311, 'sa', 'Are you sure to delete this?', 'هل أنت متأكد من حذف هذا؟', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6312, 'sa', 'Premium Packages for Sellers', 'حزم متميزة للبائعين', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6313, 'sa', 'Product Upload', 'تحميل المنتج', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6314, 'sa', 'Digital Product Upload', 'تحميل المنتج الرقمي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6315, 'sa', 'Purchase Package', 'حزمة الشراء', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6316, 'sa', 'Select Payment Type', 'اختر طريقة الدفع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6317, 'sa', 'Payment Type', 'نوع الدفع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6318, 'sa', 'Select One', 'حدد واحد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6319, 'sa', 'Online payment', 'الدفع الالكتروني', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6320, 'sa', 'Offline payment', 'الدفع دون اتصال بالإنترنت', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6321, 'sa', 'Purchase Your Package', 'شراء باقتك', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6322, 'sa', 'Paypal', 'باي بال', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6323, 'sa', 'Stripe', 'شريط', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6324, 'sa', 'sslcommerz', 'sslcommerz', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6325, 'sa', 'Confirm', 'تؤكد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6326, 'sa', 'Offline Package Payment', 'دفع حزمة دون اتصال', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6327, 'sa', 'Transaction ID', 'رقم المعاملة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6328, 'sa', 'Choose image', 'اختر صورة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6329, 'sa', 'Code', 'الشفرة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6330, 'sa', 'Delivery Status', 'حالة التسليم', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6331, 'sa', 'Payment Status', 'حالة السداد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6332, 'sa', 'Paid', 'دفع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6333, 'sa', 'Order Details', 'تفاصيل الطلب', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6334, 'sa', 'Download Invoice', 'تحميل فاتورة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6335, 'sa', 'Unpaid', 'غير مدفوعة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6336, 'sa', 'Order placed', 'تم الطلب', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6337, 'sa', 'Confirmed', 'تم تأكيد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6338, 'sa', 'On delivery', 'عند التسليم', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6339, 'sa', 'Delivered', 'تم التوصيل', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6340, 'sa', 'Order Summary', 'ملخص الطلب', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6341, 'sa', 'Order Code', 'رمز الطلب', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6342, 'sa', 'Customer', 'الزبون', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6343, 'sa', 'Total order amount', 'إجمالي مبلغ الطلب', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6344, 'sa', 'Shipping metdod', 'metdod الشحن', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6345, 'sa', 'Flat shipping rate', 'سعر الشحن ثابت', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6346, 'sa', 'Payment metdod', 'metdod الدفع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6347, 'sa', 'Variation', 'الاختلاف', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6348, 'sa', 'Delivery Type', 'نوع التوصيل', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6349, 'sa', 'Home Delivery', 'توصيل منزلي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6350, 'sa', 'Order Ammount', 'مبلغ الطلب', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6351, 'sa', 'Subtotal', 'المجموع الفرعي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6352, 'sa', 'Shipping', 'الشحن', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6353, 'sa', 'Coupon Discount', 'خصم القسيمة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6354, 'sa', 'N/A', 'غير متاح', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6355, 'sa', 'In stock', 'متوفر !', '2021-02-09 04:47:59', '2021-09-26 12:01:34'),
(6356, 'sa', 'Buy Now', 'اشتري الآن', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6357, 'sa', 'Item added to your cart!', 'إضافة السلعة الى سلة التسوق الخاصة بك!', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6358, 'sa', 'Proceed to Checkout', 'الشروع في الخروج', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6359, 'sa', 'Cart Items', 'عناصر عربة التسوق', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6360, 'sa', '1. My Cart', '1. عربة التسوق الخاصة بي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6361, 'sa', 'View cart', 'عرض عربة التسوق', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6362, 'sa', '2. Shipping info', '2. معلومات الشحن', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6363, 'sa', 'Checkout', 'الدفع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6364, 'sa', '3. Delivery info', '3. معلومات التسليم', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6365, 'sa', '4. Payment', '4. الدفع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6366, 'sa', '5. Confirmation', '5. التأكيد', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6367, 'sa', 'Remove', 'إزالة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6368, 'sa', 'Return to shop', 'العودة الى المتجر', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6369, 'sa', 'Continue to Shipping', 'تابع إلى الشحن', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6370, 'sa', 'Or', 'أو', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6371, 'sa', 'Guest Checkout', 'ضيف المحاسبة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6372, 'sa', 'Continue to Delivery Info', 'تابع إلى معلومات التسليم', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6373, 'sa', 'Postal Code', 'الرمز البريدي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6374, 'sa', 'Choose Delivery Type', 'اختر نوع التسليم', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6375, 'sa', 'Local Pickup', 'شاحنة محلية', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6376, 'sa', 'Select your nearest pickup point', 'حدد أقرب نقطة التقاط لك', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6377, 'sa', 'Continue to Payment', 'تابع إلى الدفع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6378, 'sa', 'Select a payment option', 'حدد خيار الدفع', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6379, 'sa', 'Razorpay', 'RazorPay', '2021-02-09 04:47:59', '2021-09-26 12:56:18'),
(6380, 'sa', 'Paystack', 'Paystack', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6381, 'sa', 'VoguePay', 'VoguePay', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6382, 'sa', 'payhere', 'ادفع هنا', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6383, 'sa', 'ngenius', 'عبقري', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6384, 'sa', 'Paytm', 'Paytm', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6385, 'sa', 'Cash on Delivery', 'الدفع عند الاستلام', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6386, 'sa', 'Your wallet balance :', 'رصيد محفظتك:', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6387, 'sa', 'Insufficient balance', 'رصيد غير كاف', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6388, 'sa', 'I agree to the', 'أنا أوافق على', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6389, 'sa', 'Complete Order', 'اكمل الطلب', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6390, 'sa', 'Summary', 'ملخص', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6391, 'sa', 'Items', 'العناصر', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6392, 'sa', 'Total Club point', 'مجموع نقاط النادي', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6393, 'sa', 'Total Shipping', 'إجمالي الشحن', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6394, 'sa', 'Have coupon code? Enter here', 'هل لديك رمز قسيمة؟ أدخل هنا', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6395, 'sa', 'Apply', 'تطبيق', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6396, 'sa', 'You need to agree with our policies', 'أنت بحاجة إلى الموافقة على سياساتنا', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6397, 'sa', 'Forgot password', 'هل نسيت كلمة المرور', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6398, 'sa', 'SEO Setting', 'إعداد محركات البحث', '2021-02-09 04:47:59', '2021-09-26 13:19:30'),
(6399, 'sa', 'System Update', 'تحديث النظام', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6400, 'sa', 'Add New Payment Method', 'أضف طريقة دفع جديدة', '2021-02-09 04:47:59', '2021-02-09 04:47:59'),
(6401, 'sa', 'Manual Payment Method', 'طريقة الدفع اليدوي', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6402, 'sa', 'Heading', 'عنوان', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6403, 'sa', 'Logo', 'شعار', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6404, 'sa', 'Manual Payment Information', 'معلومات الدفع اليدوي', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6405, 'sa', 'Type', 'اكتب', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6406, 'sa', 'Custom Payment', 'الدفع المخصص', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6407, 'sa', 'Check Payment', 'التحقق من الدفع', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6408, 'sa', 'Checkout Thumbnail', 'صورة مصغرة للخروج', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6409, 'sa', 'Payment Instruction', 'تعليمات الدفع', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6410, 'sa', 'Bank Information', 'المعلومات المصرفية', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6411, 'sa', 'Select File', 'حدد ملف', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6412, 'sa', 'Upload New', 'تحميل جديد', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6413, 'sa', 'Sort by newest', 'الترتيب حسب الأحدث', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6414, 'sa', 'Sort by oldest', 'فرز حسب الأقدم', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6415, 'sa', 'Sort by smallest', 'فرز حسب الأصغر', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6416, 'sa', 'Sort by largest', 'فرز حسب الأكبر', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6417, 'sa', 'Selected Only', 'المحدد فقط', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6418, 'sa', 'No files found', 'لا توجد ملفات', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6419, 'sa', '0 File selected', '0 ملف محدد', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6420, 'sa', 'Clear', 'واضح', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6421, 'sa', 'Prev', 'السابق', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6422, 'sa', 'Next', 'التالى', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6423, 'sa', 'Add Files', 'إضافة ملفات', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6424, 'sa', 'Method has been inserted successfully', 'تم إدخال الطريقة بنجاح', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6425, 'sa', 'Order Date', 'تاريخ الطلب', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6426, 'sa', 'Bill to', 'مشروع قانون ل', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6427, 'sa', 'Sub Total', 'المجموع الفرعي', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6428, 'sa', 'Total Tax', 'مجموع الضريبة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6429, 'sa', 'Grand Total', 'المبلغ الإجمالي', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6430, 'sa', 'Your order has been placed successfully. Please submit payment information from purchase history', 'تم وضع طلبك بنجاح. يرجى تقديم معلومات الدفع من سجل الشراء', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6431, 'sa', 'Thank You for Your Order!', 'شكرا لطلبك!', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6432, 'sa', 'Order Code:', 'رمز الطلب:', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6433, 'sa', 'A copy or your order summary has been sent to', 'تم إرسال نسخة أو ملخص طلبك إلى', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6434, 'sa', 'Make Payment', 'قم بالدفع', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6435, 'sa', 'Payment screenshot', 'لقطة شاشة الدفع', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6436, 'sa', 'Paypal Credential', 'اعتماد Paypal', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6437, 'sa', 'Paypal Client ID', 'معرف عميل Paypal', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6438, 'sa', 'Paypal Client Secret', 'سر عميل Paypal', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6439, 'sa', 'Paypal Sandbox Mode', 'وضع Paypal Sandbox', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6440, 'sa', 'Sslcommerz Credential', 'اعتماد Sslcommerz', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6441, 'sa', 'Sslcz Store Id', 'معرف متجر sslcz', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6442, 'sa', 'Sslcz store password', 'كلمة مرور متجر sslcz', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6443, 'sa', 'Sslcommerz Sandbox Mode', 'وضع الحماية Sslcommerz', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6444, 'sa', 'Stripe Credential', 'اعتماد شريطي', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6445, 'sa', 'STRIPE KEY', 'مفتاح الشريط', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6446, 'sa', 'STRIPE SECRET', 'سر الشريط', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6447, 'sa', 'RazorPay Credential', 'اعتماد RazorPay', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6448, 'sa', 'RAZOR KEY', 'مفتاح Razor', '2021-02-09 04:48:00', '2021-09-26 12:56:18'),
(6449, 'sa', 'RAZOR SECRET', 'سر Razor', '2021-02-09 04:48:00', '2021-09-26 12:56:18'),
(6450, 'sa', 'Instamojo Credential', 'اعتماد Instamojo', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6451, 'sa', 'API KEY', 'مفتاح API', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6452, 'sa', 'IM API KEY', 'IM API KEY', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6453, 'sa', 'AUTH TOKEN', 'AUTH TOKEN', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6454, 'sa', 'IM AUTH TOKEN', 'رمز IM AUTH', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6455, 'sa', 'Instamojo Sandbox Mode', 'وضع Instamojo Sandbox', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6456, 'sa', 'PayStack Credential', 'اعتماد PayStack', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6457, 'sa', 'PUBLIC KEY', 'المفتاح العمومي', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6458, 'sa', 'SECRET KEY', 'مفتاح سري', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6459, 'sa', 'MERCHANT EMAIL', 'البريد الإلكتروني للتاجر', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6460, 'sa', 'VoguePay Credential', 'اعتماد VoguePay', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6461, 'sa', 'MERCHANT ID', 'معرف التاجر', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6462, 'sa', 'Sandbox Mode', 'وضع الحماية', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6463, 'sa', 'Payhere Credential', 'اعتماد Payhere', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6464, 'sa', 'PAYHERE MERCHANT ID', 'معرف تاجر بايهير', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6465, 'sa', 'PAYHERE SECRET', 'PAYHERE SECRET', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6466, 'sa', 'PAYHERE CURRENCY', 'عملة الدفع', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6467, 'sa', 'Payhere Sandbox Mode', 'وضع Payhere Sandbox', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6468, 'sa', 'Ngenius Credential', 'Ngenius Credential', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6469, 'sa', 'NGENIUS OUTLET ID', 'معرف منفذ NGENIUS', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6470, 'sa', 'NGENIUS API KEY', 'NGENIUS API KEY', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6471, 'sa', 'NGENIUS CURRENCY', 'العملة الأجنبية', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6472, 'sa', 'Mpesa Credential', 'اعتماد Mpesa', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6473, 'sa', 'MPESA CONSUMER KEY', 'مفتاح المستهلك MPESA', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6474, 'sa', 'MPESA_CONSUMER_KEY', 'MPESA_CONSUMER_KEY', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6475, 'sa', 'MPESA CONSUMER SECRET', 'سر المستهلك MPESA', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6476, 'sa', 'MPESA_CONSUMER_SECRET', 'MPESA_CONSUMER_SECRET', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6477, 'sa', 'MPESA SHORT CODE', 'كود MPESA المختصر', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6478, 'sa', 'MPESA_SHORT_CODE', 'MPESA_SHORT_CODE', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6479, 'sa', 'MPESA SANDBOX ACTIVATION', 'تنشيط ساندبوكس MPESA', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6480, 'sa', 'Flutterwave Credential', 'اعتماد Flutterwave', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6481, 'sa', 'RAVE_PUBLIC_KEY', 'RAVE_PUBLIC_KEY', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6482, 'sa', 'RAVE_SECRET_KEY', 'RAVE_SECRET_KEY', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6483, 'sa', 'RAVE_TITLE', 'RAVE_TITLE', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6484, 'sa', 'STAGIN ACTIVATION', 'تنشيط STAGIN', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6485, 'sa', 'All Product', 'كل المنتجات', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6486, 'sa', 'Sort By', 'ترتيب حسب', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6487, 'sa', 'Rating (High > Low)', 'التصنيف (مرتفع> منخفض)', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6488, 'sa', 'Rating (Low > High)', 'التصنيف (منخفض> مرتفع)', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6489, 'sa', 'Num of Sale (High > Low)', 'عدد المبيعات (مرتفع> منخفض)', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6490, 'sa', 'Num of Sale (Low > High)', 'عدد المبيعات (منخفض> مرتفع)', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6491, 'sa', 'Base Price (High > Low)', 'السعر الأساسي (مرتفع> منخفض)', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6492, 'sa', 'Base Price (Low > High)', 'السعر الأساسي (منخفض> مرتفع)', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6493, 'sa', 'Type & Enter', 'اكتب & أدخل', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6494, 'sa', 'Added By', 'أضيفت من قبل', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6495, 'sa', 'Num of Sale', 'رقم البيع', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6496, 'sa', 'Total Stock', 'إجمالي المخزون', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6497, 'sa', 'Todays Deal', 'صفقة اليوم', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6498, 'sa', 'Rating', 'تقييم', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6499, 'sa', 'times', 'مرات', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6500, 'sa', 'Add Nerw Product', 'أضف منتج نيرو', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6501, 'sa', 'Product Information', 'معلومات المنتج', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6502, 'sa', 'Unit', 'وحدة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6503, 'sa', 'Unit (e.g. KG, Pc etc)', 'الوحدة (مثل KG ، Pc إلخ)', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6504, 'sa', 'Minimum Qty', 'الحد الأدنى من الكمية', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6505, 'sa', 'Tags', 'العلامات', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6506, 'sa', 'Type and hit enter to add a tag', 'اكتب واضغط على Enter لإضافة علامة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6507, 'sa', 'Barcode', 'الباركود', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6508, 'sa', 'Refundable', 'مستردة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6509, 'sa', 'Product Images', 'صور المنتج', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6510, 'sa', 'Gallery Images', 'معرض الصور', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6511, 'sa', 'Todays Deal updated successfully', 'تم تحديث صفقة اليوم بنجاح', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6512, 'sa', 'Published products updated successfully', 'تم تحديث المنتجات المنشورة بنجاح', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6513, 'sa', 'Thumbnail Image', 'صورة مصغرة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6514, 'sa', 'Featured products updated successfully', 'تم تحديث المنتجات المميزة بنجاح', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6515, 'sa', 'Product Videos', 'فيديو المنتج', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6516, 'sa', 'Video Provider', 'مزود الفيديو', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6517, 'sa', 'Youtube', 'موقع YouTube', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6518, 'sa', 'Dailymotion', 'ديلي موشن', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6519, 'sa', 'Vimeo', 'فيميو', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6520, 'sa', 'Video Link', 'رابط الفيديو', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6521, 'sa', 'Product Variation', 'تنوع المنتج', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6522, 'sa', 'Colors', 'الألوان', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6523, 'sa', 'Attributes', 'السمات', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6524, 'sa', 'Choose Attributes', 'اختر السمات', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6525, 'sa', 'Choose the attributes of this product and then input values of each attribute', 'اختر سمات هذا المنتج ثم قيم الإدخال لكل سمة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6526, 'sa', 'Product price + stock', 'سعر المنتج + الأسهم', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6527, 'sa', 'Unit price', 'سعر الوحدة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6528, 'sa', 'Purchase price', 'سعر الشراء', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6529, 'sa', 'Flat', 'مسطحة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6530, 'sa', 'Percent', 'نسبه مئويه', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6531, 'sa', 'Discount', 'خصم', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6532, 'sa', 'Product Description', 'وصف المنتج', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6533, 'sa', 'Product Shipping Cost', 'تكلفة شحن المنتج', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6534, 'sa', 'Free Shipping', 'الشحن مجانا', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6535, 'sa', 'Flat Rate', 'سعر موحد', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6536, 'sa', 'Shipping cost', 'تكلفة الشحن', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6537, 'sa', 'PDF Specification', 'مواصفات PDF', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6538, 'sa', 'SEO Meta Tags', 'العلامات الوصفية لمحركات البحث', '2021-02-09 04:48:00', '2021-09-26 13:19:30'),
(6539, 'sa', 'Meta Title', 'عنوان الفوقية', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6540, 'sa', 'Meta Image', 'صورة ميتا', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6541, 'sa', 'Choice Title', 'عنوان الاختيار', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6542, 'sa', 'Enter choice values', 'أدخل قيم الاختيار', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6543, 'sa', 'All categories', 'جميع الفئات', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6544, 'sa', 'Add New category', 'إضافة فئة جديدة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6545, 'sa', 'Type name & Enter', 'اكتب الاسم وأدخل', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6546, 'sa', 'Banner', 'لافتة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6547, 'sa', 'Commission', 'عمولة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6548, 'sa', 'icon', 'أيقونة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6549, 'sa', 'Featured categories updated successfully', 'تم تحديث الفئات المميزة بنجاح', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6550, 'sa', 'Hot', 'الحار', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6551, 'sa', 'Filter by Payment Status', 'تصفية حسب حالة الدفع', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6552, 'sa', 'Un-Paid', 'غير مدفوعة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6553, 'sa', 'Filter by Deliver Status', 'تصفية حسب تسليم الحالة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6554, 'sa', 'Pending', 'قيد الانتظار', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6555, 'sa', 'Type Order code & hit Enter', 'اكتب رمز الطلب واضغط على Enter', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6556, 'sa', 'Num. of Products', 'رقم. المنتجات', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6557, 'sa', 'Walk In Customer', 'دخول العميل', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6558, 'sa', 'QTY', 'الكمية', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6559, 'sa', 'Without Shipping Charge', 'بدون رسوم الشحن', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6560, 'sa', 'With Shipping Charge', 'مع رسوم الشحن', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6561, 'sa', 'Pay With Cash', 'الدفع نقدا', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6562, 'sa', 'Shipping Address', 'عنوان الشحن', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6563, 'sa', 'Close', 'اغلاق', '2021-02-09 04:48:00', '2021-08-04 11:30:24'),
(6564, 'sa', 'Select country', 'حدد الدولة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6565, 'sa', 'Order Confirmation', 'تأكيد الطلب', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6566, 'sa', 'Are you sure to confirm this order?', 'هل أنت متأكد من تأكيد هذا الطلب؟', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6567, 'sa', 'Comfirm Order', 'ترتيب Comfirm', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6568, 'sa', 'Personal Info', 'معلومات شخصية', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6569, 'sa', 'Repeat Password', 'اعد كلمة السر', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6570, 'sa', 'Shop Name', 'اسم المحل', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6571, 'sa', 'Register Your Shop', 'سجل متجرك', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6572, 'sa', 'Affiliate Informations', 'المعلومات التابعة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6573, 'sa', 'Affiliate', 'شركة تابعة', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6574, 'sa', 'User Info', 'معلومات المستخدم', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6575, 'sa', 'Installed Addon', 'الملحق المثبت', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6576, 'sa', 'Available Addon', 'الملحق المتاح', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6577, 'sa', 'Install New Addon', 'قم بتثبيت ملحق جديد', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6578, 'sa', 'Version', 'الإصدار', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6579, 'sa', 'Activated', 'مفعل', '2021-02-09 04:48:00', '2021-02-09 04:48:00'),
(6580, 'sa', 'Deactivated', 'معطل', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6581, 'sa', 'Activate OTP', 'تفعيل OTP', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6582, 'sa', 'OTP will be Used For', 'سيتم استخدام OTP لـ', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6583, 'sa', 'Settings updated successfully', 'تم تحديث الإعدادات بنجاح', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6584, 'sa', 'Product Owner', 'مالك المنتج', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6585, 'sa', 'Point', 'نقطة', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6586, 'sa', 'Set Point for Product Within a Range', 'تعيين نقطة للمنتج ضمن النطاق', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6587, 'sa', 'Set Point for multiple products', 'تعيين نقطة لمنتجات متعددة', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6588, 'sa', 'Min Price', 'سعر دقيقة', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6589, 'sa', 'Max Price', 'أقصى سعر', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6590, 'sa', 'Set Point for all Products', 'تعيين نقطة لجميع المنتجات', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6591, 'sa', 'Set Point For ', 'تعيين نقطة ل', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6592, 'sa', 'Convert Status', 'تحويل الحالة', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6593, 'sa', 'Earned At', 'حصل في', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6594, 'sa', 'Seller Based Selling Report', 'تقرير البيع القائم على البائع', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6595, 'sa', 'Sort by verificarion status', 'فرز حسب حالة التحقق', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6596, 'sa', 'Approved', 'وافق', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6597, 'sa', 'Non Approved', 'ليس مصدق عليه', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6598, 'sa', 'Filter', 'منقي', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6599, 'sa', 'Seller Name', 'اسم البائع', '2021-02-09 04:48:01', '2021-09-26 13:24:34'),
(6600, 'sa', 'Number of Product Sale', 'عدد بيع المنتج', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6601, 'sa', 'Order Amount', 'كمية الطلب', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6602, 'sa', 'Facebook Chat Setting', 'إعداد دردشة Facebook', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6603, 'sa', 'Facebook Page ID', 'معرف صفحة الفيسبوك', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6604, 'sa', 'Please be carefull when you are configuring Facebook chat. For incorrect configuration you will not get messenger icon on your user-end site.', 'يرجى توخي الحذر عند تكوين دردشة Facebook. للتكوين غير الصحيح ، لن تحصل على أيقونة messenger على موقع المستخدم الخاص بك.', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6605, 'sa', 'Login into your facebook page', 'تسجيل الدخول إلى صفحة الفيسبوك الخاصة بك', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6606, 'sa', 'Find the About option of your facebook page', 'ابحث عن خيار حول صفحتك على Facebook', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6607, 'sa', 'At the very bottom, you can find the \\“Facebook Page ID\\”', 'في الجزء السفلي ، يمكنك العثور على \\ \"معرف صفحة Facebook \\\"', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6608, 'sa', 'Go to Settings of your page and find the option of \\\"Advance Messaging\\\"', 'انتقل إلى إعدادات صفحتك وابحث عن خيار \\ \"تقديم الرسائل \\\"', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6609, 'sa', 'Scroll down that page and you will get \\\"white listed domain\\\"', 'مرر لأسفل تلك الصفحة وستحصل على \\ \"المجال المدرج في القائمة البيضاء \\\"', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6610, 'sa', 'Set your website domain name', 'قم بتعيين اسم مجال موقع الويب الخاص بك', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6611, 'sa', 'Google reCAPTCHA Setting', 'إعداد Google reCAPTCHA', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6612, 'sa', 'Site KEY', 'مفتاح الموقع', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6613, 'sa', 'Select Shipping Method', 'إختر طريقة الشحن', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6614, 'sa', 'Product Wise Shipping Cost', 'تكلفة شحن المنتج المتغيرة', '2021-02-09 04:48:01', '2021-09-26 13:34:48'),
(6615, 'sa', 'Flat Rate Shipping Cost', 'تكلفة الشحن بسعر موحد', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6616, 'sa', 'Seller Wise Flat Shipping Cost', 'تكلفة الشحن المتغيرة للبائع', '2021-02-09 04:48:01', '2021-09-26 13:35:03'),
(6617, 'sa', 'Note', 'ملحوظة', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6618, 'sa', 'Product Wise Shipping Cost calulation: Shipping cost is calculate by addition of each product shipping cost', 'حساب تكلفة الشحن المتغيرة للمنتج: يتم حساب تكلفة الشحن عن طريق إضافة تكلفة شحن كل منتج', '2021-02-09 04:48:01', '2021-09-26 13:34:48'),
(6619, 'sa', 'Flat Rate Shipping Cost calulation: How many products a customer purchase, doesnt matter. Shipping cost is fixed', 'حساب تكلفة الشحن بالسعر الثابت: لا يهم كم عدد المنتجات التي يشتريها العميل. تكلفة الشحن ثابتة', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6620, 'sa', 'Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If a customer purchase 2 product from two seller shipping cost is calculate by addition of each seller flat shipping cost', 'حساب لتكلفة الشحن المتغيرة للبائع: سعر ثابت لكل بائع. إذا قام العميل بشراء منتجين من باعئين  ، يتم حسابها بإضافة تكلفة الشحن الثابتة لكل بائع', '2021-02-09 04:48:01', '2021-09-26 13:34:48'),
(6621, 'sa', 'Flat Rate Cost', 'تكلفة السعر الثابت', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6622, 'sa', 'Shipping Cost for Admin Products', 'تكلفة الشحن للمنتجات الإدارية', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6623, 'sa', 'Countries', 'بلدان', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6624, 'sa', 'Show/Hide', 'اظهر /اخفي', '2021-02-09 04:48:01', '2021-10-03 10:11:04'),
(6625, 'sa', 'Country status updated successfully', 'تم تحديث حالة البلد بنجاح', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6626, 'sa', 'All Subcategories', 'جميع الفئات الفرعية', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6627, 'sa', 'Add New Subcategory', 'إضافة فئة فرعية جديدة', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6628, 'sa', 'Sub-Categories', 'الفئات الفرعية', '2021-02-09 04:48:01', '2021-02-09 04:48:01'),
(6629, 'sa', 'Sub Category Information', 'معلومات الفئة الفرعية', '2021-02-09 04:48:25', '2021-02-09 04:48:25'),
(6630, 'sa', 'Slug', 'سبيكة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6631, 'sa', 'All Sub Subcategories', 'جميع الفئات الفرعية', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6632, 'sa', 'Add New Sub Subcategory', 'إضافة تصنيف فرعي جديد', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6633, 'sa', 'Sub-Sub-categories', 'الفئات الفرعية الفرعية', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6634, 'sa', 'Make This Default', 'اجعل هذا الافتراضي', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6635, 'sa', 'Shops', 'محلات', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6636, 'sa', 'Women Clothing & Fashion', 'ملابس وموضة نسائية', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6637, 'sa', 'Cellphones & Tabs', 'الهواتف المحمولة وعلامات التبويب', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6638, 'sa', 'Welcome to', 'مرحبا بك في', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6639, 'sa', 'Create a New Account', 'انشاء حساب جديد', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6640, 'sa', 'Full Name', 'الاسم الكامل', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6641, 'sa', 'password', 'كلمه السر', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6642, 'sa', 'Confrim Password', 'تأكيد كلمة المرور', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6643, 'sa', 'I agree with the', 'وأنا أتفق مع', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6644, 'sa', 'Terms and Conditions', 'الأحكام والشروط', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6645, 'sa', 'Register', 'تسجيل', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6646, 'sa', 'Already have an account', 'هل لديك حساب', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6647, 'sa', 'Sign Up with', 'سجل مع', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6648, 'sa', 'I agree with the Terms and Conditions', 'اني اوافق على الشروط والظروف', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6649, 'sa', 'All Role', 'كل دور', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6650, 'sa', 'Add New Role', 'إضافة دور جديد', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6651, 'sa', 'Roles', 'الأدوار', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6652, 'sa', 'Add New Staffs', 'إضافة طاقم عمل جديد', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6653, 'sa', 'Role', 'وظيفة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6654, 'sa', 'Frontend Website Name', 'اسم موقع الواجهة الأمامية', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6655, 'sa', 'Website Name', 'اسم الموقع', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6656, 'sa', 'Site Motto', 'شعار الموقع', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6657, 'sa', 'Best eCommerce Website', 'أفضل موقع للتجارة الإلكترونية', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6658, 'sa', 'Site Icon', 'أيقونة الموقع', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6659, 'sa', 'Website favicon. 32x32 .png', 'أيقونة موقع الويب. 32 × 32. png', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6660, 'sa', 'Website Base Color', 'لون قاعدة الموقع', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6661, 'sa', 'Hex Color Code', 'رمز اللون السداسي', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6662, 'sa', 'Website Base Hover Color', 'لون قاعدة موقع الويب', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6663, 'sa', 'Update', 'تحديث', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6664, 'sa', 'Global Seo', 'محركات البحث العامة', '2021-02-09 04:48:26', '2021-09-26 13:19:30'),
(6665, 'sa', 'Meta description', 'ميتا الوصف', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6666, 'sa', 'Keywords', 'الكلمات الدالة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6667, 'sa', 'Separate with coma', 'فصل مع غيبوبة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6668, 'sa', 'Website Pages', 'صفحات الموقع', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6669, 'sa', 'All Pages', 'كل الصفحات', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6670, 'sa', 'Add New Page', 'أضف صفحة جديدة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6671, 'sa', 'URL', 'URL', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6672, 'sa', 'Actions', 'أجراءات', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6673, 'sa', 'Edit Page Information', 'تحرير معلومات الصفحة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6674, 'sa', 'Page Content', 'محتوى الصفحة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6675, 'sa', 'Title', 'عنوان', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6676, 'sa', 'Link', 'حلقة الوصل', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6677, 'sa', 'Use character, number, hypen only', 'استخدم الحرف ، الرقم ، الواصلة فقط', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6678, 'sa', 'Add Content', 'إضافة محتوى', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6679, 'sa', 'Seo Fields', 'حقول محركات البحث', '2021-02-09 04:48:26', '2021-09-26 13:19:30'),
(6680, 'sa', 'Update Page', 'تحديث الصفحة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6681, 'sa', 'Default Language', 'اللغة الافتراضية', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6682, 'sa', 'Add New Language', 'أضف لغة جديدة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6683, 'sa', 'RTL', 'RTL', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6684, 'sa', 'Translation', 'ترجمة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6685, 'sa', 'Language Information', 'معلومات اللغة', '2021-02-09 04:48:26', '2021-02-09 04:48:26');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(6686, 'sa', 'Save Page', 'احفظ الصفحة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6687, 'sa', 'Home Page Settings', 'إعدادات الصفحة الرئيسية', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6688, 'sa', 'Home Slider', 'المنزل المنزلق', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6689, 'sa', 'Photos & Links', 'الصور والروابط', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6690, 'sa', 'Add New', 'اضف جديد', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6691, 'sa', 'Home Categories', 'فئات المنزل', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6692, 'sa', 'Home Banner 1 (Max 3)', 'لافتة المنزل 1 (الحد الأقصى 3)', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6693, 'sa', 'Banner & Links', 'لافتة وروابط', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6694, 'sa', 'Home Banner 2 (Max 3)', 'لافتة المنزل 2 (الحد الأقصى 3)', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6695, 'sa', 'Top 10', 'أعلى 10', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6696, 'sa', 'Top Categories (Max 10)', 'أهم الفئات (بحد أقصى 10)', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6697, 'sa', 'Top Brands (Max 10)', 'أشهر الماركات (بحد أقصى 10)', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6698, 'sa', 'System Name', 'اسم النظام', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6699, 'sa', 'System Logo - White', 'شعار النظام - أبيض', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6700, 'sa', 'Choose Files', 'اختر الملفات', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6701, 'sa', 'Will be used in admin panel side menu', 'سيتم استخدامها في القائمة الجانبية للوحة الإدارة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6702, 'sa', 'System Logo - Black', 'شعار النظام - أسود', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6703, 'sa', 'Will be used in admin panel topbar in mobile + Admin login page', 'سيتم استخدامها في الشريط العلوي للوحة الإدارة في الجوال + صفحة تسجيل دخول المسؤول', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6704, 'sa', 'System Timezone', 'المنطقة الزمنية للنظام', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6705, 'sa', 'Admin login page background', 'خلفية صفحة تسجيل دخول المسؤول', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6706, 'sa', 'Website Header', 'رأس موقع الويب', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6707, 'sa', 'Header Setting', 'إعداد الرأس', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6708, 'sa', 'Header Logo', 'رأس الشعار', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6709, 'sa', 'Show Language Switcher?', 'إظهار محوّل اللغة؟', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6710, 'sa', 'Show Currency Switcher?', 'إظهار محوّل العملات؟', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6711, 'sa', 'Enable stikcy header?', 'تمكين رأس stikcy؟', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6712, 'sa', 'Website Footer', 'تذييل موقع الويب', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6713, 'sa', 'Footer Widget', 'القطعة التذييل', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6714, 'sa', 'About Widget', 'حول القطعة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6715, 'sa', 'Footer Logo', 'تذييل الشعار', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6716, 'sa', 'About description', 'حول الوصف', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6717, 'sa', 'Contact Info Widget', 'أداة معلومات الاتصال', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6718, 'sa', 'Footer contact address', 'عنوان اتصال التذييل', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6719, 'sa', 'Footer contact phone', 'هاتف جهة اتصال التذييل', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6720, 'sa', 'Footer contact email', 'البريد الإلكتروني لجهة اتصال التذييل', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6721, 'sa', 'Link Widget One', 'رابط القطعة واحد', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6722, 'sa', 'Links', 'الروابط', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6723, 'sa', 'Footer Bottom', 'أسفل التذييل', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6724, 'sa', 'Copyright Widget ', 'القطعة حقوق الطبع والنشر', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6725, 'sa', 'Copyright Text', 'نص حقوق النشر', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6726, 'sa', 'Social Link Widget ', 'أداة الارتباط الاجتماعي', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6727, 'sa', 'Show Social Links?', 'إظهار الروابط الاجتماعية؟', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6728, 'sa', 'Social Links', 'روابط اجتماعية', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6729, 'sa', 'Payment Methods Widget ', 'أداة طرق الدفع', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6730, 'sa', 'RTL status updated successfully', 'تم تحديث حالة RTL بنجاح', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6731, 'sa', 'Language changed to ', 'تغيرت اللغة إلى', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6732, 'sa', 'Inhouse Product sale report', 'تقرير بيع المنتج الداخلي', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6733, 'sa', 'Sort by Category', 'فرز حسب الفئة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6734, 'sa', 'Product wise stock report', 'تقرير مخزون المنتج المتغير', '2021-02-09 04:48:26', '2021-09-26 13:34:48'),
(6735, 'sa', 'Currency changed to ', 'تغيرت العملة إلى', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6736, 'sa', 'Avatar', 'الصورة الرمزية', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6737, 'sa', 'Copy', 'نسخ', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6738, 'sa', 'Variant', 'متغير', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6739, 'sa', 'Variant Price', 'سعر متغير', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6740, 'sa', 'SKU', 'SKU', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6741, 'sa', 'Key', 'مفتاح', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6742, 'sa', 'Value', 'القيمة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6743, 'sa', 'Copy Translations', 'نسخ الترجمات', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6744, 'sa', 'All Pick-up Points', 'جميع نقاط الاستلام', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6745, 'sa', 'Add New Pick-up Point', 'أضف نقطة التقاط جديدة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6746, 'sa', 'Manager', 'مدير', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6747, 'sa', 'Location', 'موقعك', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6748, 'sa', 'Pickup Station Contact', 'الاتصال بمحطة الالتقاط', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6749, 'sa', 'Open', 'افتح', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6750, 'sa', 'POS Activation for Seller', 'تفعيل نقاط البيع للبائع', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6751, 'sa', 'Order Completed Successfully.', 'اكتمل الطلب بنجاح.', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6752, 'sa', 'Text Input', 'إدخال النص', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6753, 'sa', 'Select', 'تحديد', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6754, 'sa', 'Multiple Select', 'تحديد متعدد', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6755, 'sa', 'Radio', 'مذياع', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6756, 'sa', 'File', 'ملف', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6757, 'sa', 'Email Address', 'عنوان بريد الكتروني', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6758, 'sa', 'Verification Info', 'معلومات التحقق', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6759, 'sa', 'Approval', 'موافقة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6760, 'sa', 'Due Amount', 'مبلغ مستحق', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6761, 'sa', 'Show', 'عرض', '2021-02-09 04:48:26', '2021-10-03 10:11:04'),
(6762, 'sa', 'Pay Now', 'ادفع الآن', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6763, 'sa', 'Affiliate User Verification', 'التحقق من المستخدم التابع', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6764, 'sa', 'Reject', 'رفض', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6765, 'sa', 'Accept', 'قبول', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6766, 'sa', 'Beauty, Health & Hair', 'الجمال والصحة والشعر', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6767, 'sa', 'Comparison', 'مقارنة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6768, 'sa', 'Reset Compare List', 'إعادة تعيين قائمة المقارنة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6769, 'sa', 'Your comparison list is empty', 'قائمة المقارنة الخاصة بك فارغة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6770, 'sa', 'Convert Point To Wallet', 'تحويل النقطة إلى المحفظة', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6771, 'sa', 'Note: You need to activate wallet option first before using club point addon.', 'ملاحظة: أنت بحاجة إلى تنشيط خيار المحفظة أولاً قبل استخدام ملحق نقطة النادي.', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6772, 'sa', 'Create an account.', 'انشئ حساب.', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6773, 'sa', 'Use Email Instead', 'استخدم البريد الإلكتروني بدلاً من ذلك', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6774, 'sa', 'By signing up you agree to our terms and conditions.', 'بالتسجيل فإنك توافق على الشروط والأحكام الخاصة بنا.', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6775, 'sa', 'Create Account', 'إنشاء حساب', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6776, 'sa', 'Or Join With', 'أو انضم إلى', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6777, 'sa', 'Already have an account?', 'هل لديك حساب؟', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6778, 'sa', 'Log In', 'تسجيل الدخول', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6779, 'sa', 'Computer & Accessories', 'الكمبيوتر وملحقاته', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6780, 'sa', 'Product(s)', 'منتجات)', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6781, 'sa', 'in your cart', 'في عربة التسوق الخاصة بك', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6782, 'sa', 'in your wishlist', 'في قائمة الرغبات الخاصة بك', '2021-02-09 04:48:26', '2021-02-09 04:48:26'),
(6783, 'sa', 'you ordered', 'لقد طلبت', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6784, 'sa', 'Default Shipping Address', 'عنوان الشحن الافتراضي', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6785, 'sa', 'Sports & outdoor', 'رياضة وخارجية', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6786, 'sa', 'Copied', 'نسخ', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6787, 'sa', 'Copy the Promote Link', 'انسخ رابط الترويج', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6788, 'sa', 'Write a review', 'أكتب مراجعة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6789, 'sa', 'Your name', 'اسمك', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6790, 'sa', 'Comment', 'تعليق', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6791, 'sa', 'Your review', 'مراجعتك', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6792, 'sa', 'Submit review', 'إرسال المراجعة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6793, 'sa', 'Claire Willis', 'كلير ويليس', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6794, 'sa', 'Germaine Greene', 'جيرمين جرين', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6795, 'sa', 'Product File', 'ملف المنتج', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6796, 'sa', 'Choose file', 'اختر ملف', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6797, 'sa', 'Type to add a tag', 'اكتب لإضافة علامة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6798, 'sa', 'Images', 'الصور', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6799, 'sa', 'Main Images', 'الصور الرئيسية', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6800, 'sa', 'Meta Tags', 'العلامات الفوقية', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6801, 'sa', 'Digital Product has been inserted successfully', 'تم إدخال المنتج الرقمي بنجاح', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6802, 'sa', 'Edit Digital Product', 'تحرير المنتج الرقمي', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6803, 'sa', 'Select an option', 'حدد اختيارا', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6804, 'sa', 'tax', 'ضريبة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6805, 'sa', 'Any question about this product?', 'أي سؤال حول هذا المنتج؟', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6806, 'sa', 'Sign in', 'تسجيل الدخول', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6807, 'sa', 'Login with Google', 'تسجيل الدخول عبر جوجل', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6808, 'sa', 'Login with Facebook', 'تسجيل الدخول باستخدام الفيسبوك', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6809, 'sa', 'Login with Twitter', 'تسجيل الدخول مع Twitter', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6810, 'sa', 'Click to show phone number', 'انقر لإظهار رقم الهاتف', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6811, 'sa', 'Other Ads of', 'إعلانات أخرى من', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6812, 'sa', 'Store Home', 'الرئيسية للبائع', '2021-02-09 04:48:27', '2021-09-26 12:06:07'),
(6813, 'sa', 'Top Selling', 'الأكثر مبيعا', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6814, 'sa', 'Shop Settings', 'إعدادات المتجر', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6815, 'sa', 'Visit Shop', 'قم بزيارة المتجر', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6816, 'sa', 'Pickup Points', 'نقاط الالتقاط', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6817, 'sa', 'Select Pickup Point', 'حدد نقطة الالتقاط', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6818, 'sa', 'Slider Settings', 'إعدادات المنزلق', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6819, 'sa', 'Social Media Link', 'رابط التواصل الاجتماعي', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6820, 'sa', 'Facebook', 'موقع التواصل الاجتماعي الفيسبوك', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6821, 'sa', 'Twitter', 'تويتر', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6822, 'sa', 'Google', 'جوجل', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6823, 'sa', 'New Arrival Products', 'منتجات وصلت حديثاً', '2021-02-09 04:48:27', '2021-09-26 12:04:49'),
(6824, 'sa', 'Check Your Order Status', 'تحقق من حالة طلبك', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6825, 'sa', 'Shipping method', 'طريقة الشحن', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6826, 'sa', 'Shipped By', 'تم الشحن بواسطة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6827, 'sa', 'Image', 'صورة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6828, 'sa', 'Sub Sub Category', 'فئة فرعية فرعية', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6829, 'sa', 'Inhouse Products', 'المنتجات الداخلية', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6830, 'sa', 'Forgot Password?', 'هل نسيت كلمة المرور؟', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6831, 'sa', 'Enter your email address to recover your password.', 'أدخل عنوان بريدك الإلكتروني لاستعادة كلمة المرور الخاصة بك.', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6832, 'sa', 'Email or Phone', 'بريد الكتروني او هاتف', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6833, 'sa', 'Send Password Reset Link', 'إرسال رابط إعادة تعيين كلمة السر', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6834, 'sa', 'Back to Login', 'العودة إلى تسجيل الدخول', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6835, 'sa', 'index', 'فهرس', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6836, 'sa', 'Download Your Product', 'قم بتنزيل منتجك', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6837, 'sa', 'Option', 'اختيار', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6838, 'sa', 'Applied Refund Request', 'طلب استرداد مطبق', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6839, 'sa', 'Item has been renoved from wishlist', 'تمت إعادة العنصر من قائمة الرغبات', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6840, 'sa', 'Bulk Products Upload', 'تحميل المنتجات بالجملة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6841, 'sa', 'Upload CSV', 'تحميل CSV', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6842, 'sa', 'Create a Ticket', 'قم بإنشاء تذكرة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6843, 'sa', 'Tickets', 'تذاكر', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6844, 'sa', 'Ticket ID', 'معرف التذكرة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6845, 'sa', 'Sending Date', 'تاريخ إرسال', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6846, 'sa', 'Subject', 'موضوع', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6847, 'sa', 'View Details', 'عرض التفاصيل', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6848, 'sa', 'Provide a detailed description', 'قدم وصفاً مفصلاً', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6849, 'sa', 'Type your reply', 'اكتب ردك', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6850, 'sa', 'Send Ticket', 'إرسال التذكرة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6851, 'sa', 'Load More', 'تحميل المزيد', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6852, 'sa', 'Jewelry & Watches', 'المجوهرات والساعات', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6853, 'sa', 'Filters', 'المرشحات', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6854, 'sa', 'Contact address', 'عنوان الإتصال', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6855, 'sa', 'Contact phone', 'هاتف الاتصال', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6856, 'sa', 'Contact email', 'تواصل بالبريد الاكتروني', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6857, 'sa', 'Filter by', 'مصنف بواسطة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6858, 'sa', 'Condition', 'شرط', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6859, 'sa', 'All Type', 'كل الأنواع', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6860, 'sa', 'Pay with wallet', 'ادفع بالمحفظة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6861, 'sa', 'Select variation', 'حدد الاختلاف', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6862, 'sa', 'No Product Added', 'لا يوجد منتج مضاف', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6863, 'sa', 'Status has been updated successfully', 'تم تحديث الحالة بنجاح', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6864, 'sa', 'All Seller Packages', 'جميع حزم البائع', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6865, 'sa', 'Add New Package', 'إضافة حزمة جديدة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6866, 'sa', 'Package Logo', 'حزمة الشعار', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6867, 'sa', 'days', 'أيام', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6868, 'sa', 'Create New Seller Package', 'إنشاء حزمة بائع جديدة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6869, 'sa', 'Package Name', 'اسم الحزمة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6870, 'sa', 'Duration', 'المدة الزمنية', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6871, 'sa', 'Validity in number of days', 'الصلاحية في عدد الأيام', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6872, 'sa', 'Update Package Information', 'تحديث معلومات الحزمة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6873, 'sa', 'Package has been inserted successfully', 'تم إدخال الحزمة بنجاح', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6874, 'sa', 'Refund Request', 'طلب ارجاع', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6875, 'sa', 'Reason', 'السبب', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6876, 'sa', 'Label', 'ضع الكلمة المناسبة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6877, 'sa', 'Select Label', 'حدد التسمية', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6878, 'sa', 'Multiple Select Label', 'متعدد تحديد التسمية', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6879, 'sa', 'Radio Label', 'تسمية الراديو', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6880, 'sa', 'Pickup Point Orders', 'أوامر نقطة الاستلام', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6881, 'sa', 'View', 'رأي', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6882, 'sa', 'Order #', 'طلب #', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6883, 'sa', 'Order Status', 'حالة الطلب', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6884, 'sa', 'Total amount', 'المبلغ الإجمالي', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6885, 'sa', 'TOTAL', 'مجموع', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6886, 'sa', 'Delivery status has been updated', 'تم تحديث حالة التسليم', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6887, 'sa', 'Payment status has been updated', 'تم تحديث حالة الدفع', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6888, 'sa', 'INVOICE', 'فاتورة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6889, 'sa', 'Set Refund Time', 'ضبط وقت الاسترداد', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6890, 'sa', 'Set Time for sending Refund Request', 'تعيين الوقت لإرسال طلب استرداد', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6891, 'sa', 'Set Refund Sticker', 'تعيين ملصق استرداد', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6892, 'sa', 'Sticker', 'ملصق', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6893, 'sa', 'Refund Request All', 'طلب استرداد الكل', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6894, 'sa', 'Order Id', 'رقم التعريف الخاص بالطلب', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6895, 'sa', 'Seller Approval', 'موافقة البائع', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6896, 'sa', 'Admin Approval', 'موافقة المسؤول', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6897, 'sa', 'Refund Status', 'حالة رد الأموال', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6898, 'sa', 'No Refund', 'لا رد', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6899, 'sa', 'Status updated successfully', 'تم تحديث الحالة بنجاح', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6900, 'sa', 'User Search Report', 'تقرير بحث المستخدم', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6901, 'sa', 'Search By', 'البحث عن طريق', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6902, 'sa', 'Number searches', 'عدد عمليات البحث', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6903, 'sa', 'Sender', 'مرسل', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6904, 'sa', 'Receiver', 'المتلقي', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6905, 'sa', 'Verification form updated successfully', 'تم تحديث نموذج التحقق بنجاح', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6906, 'sa', 'Invalid email or password', 'البريد الإلكتروني أو كلمة السر خاطئة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6907, 'sa', 'All Coupons', 'جميع القسائم', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6908, 'sa', 'Add New Coupon', 'أضف قسيمة جديدة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6909, 'sa', 'Coupon Information', 'معلومات القسيمة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6910, 'sa', 'Start Date', 'تاريخ البدء', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6911, 'sa', 'End Date', 'تاريخ الانتهاء', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6912, 'sa', 'Product Base', 'قاعدة المنتج', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6913, 'sa', 'Send Newsletter', 'إرسال النشرة الإخبارية', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6914, 'sa', 'Mobile Users', 'مستخدمو المحمول', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6915, 'sa', 'SMS subject', 'موضوع الرسائل القصيرة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6916, 'sa', 'SMS content', 'محتوى الرسائل القصيرة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6917, 'sa', 'All Flash Delas', 'كل فلاش ديلاس', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6918, 'sa', 'Create New Flash Dela', 'إنشاء فلاش ديلا جديد', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6919, 'sa', 'Page Link', 'رابط الصفحة', '2021-02-09 04:48:27', '2021-02-09 04:48:27'),
(6920, 'sa', 'Flash Deal Information', 'معلومات صفقة فلاش', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6921, 'sa', 'Background Color', 'لون الخلفية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6922, 'sa', '#0000ff', '# 0000ff', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6923, 'sa', 'Text Color', 'لون الخط', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6924, 'sa', 'White', 'أبيض', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6925, 'sa', 'Dark', 'داكن', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6926, 'sa', 'Choose Products', 'اختر المنتجات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6927, 'sa', 'Discounts', 'الخصومات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6928, 'sa', 'Discount Type', 'نوع الخصم', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6929, 'sa', 'Twillo Credential', 'اعتماد Twillo', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6930, 'sa', 'TWILIO SID', 'TWILIO SID', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6931, 'sa', 'TWILIO AUTH TOKEN', 'رمز TWILIO AUTH', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6932, 'sa', 'TWILIO VERIFY SID', 'TWILIO VERIFY SID', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6933, 'sa', 'VALID TWILLO NUMBER', 'رقم تويلو صالح', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6934, 'sa', 'Nexmo Credential', 'اعتماد Nexmo', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6935, 'sa', 'NEXMO KEY', 'NEXMO KEY', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6936, 'sa', 'NEXMO SECRET', 'NEXMO SECRET', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6937, 'sa', 'SSL Wireless Credential', 'اعتماد لاسلكي SSL', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6938, 'sa', 'SSL SMS API TOKEN', 'SSL SMS API TOKEN', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6939, 'sa', 'SSL SMS SID', 'SSL SMS SID', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6940, 'sa', 'SSL SMS URL', 'عنوان URL لـ SSL SMS', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6941, 'sa', 'Fast2SMS Credential', 'اعتماد Fast2SMS', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6942, 'sa', 'AUTH KEY', 'مفتاح المصادقة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6943, 'sa', 'ROUTE', 'طريق', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6944, 'sa', 'Promotional Use', 'الاستخدام الترويجي', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6945, 'sa', 'Transactional Use', 'استخدام المعاملات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6946, 'sa', 'SENDER ID', 'هوية المرسل', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6947, 'sa', 'Nexmo OTP', 'Nexmo OTP', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6948, 'sa', 'Twillo OTP', 'Twillo OTP', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6949, 'sa', 'SSL Wireless OTP', 'SSL Wireless OTP', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6950, 'sa', 'Fast2SMS OTP', 'Fast2SMS OTP', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6951, 'sa', 'Order Placement', 'ترتيب التنسيب', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6952, 'sa', 'Delivery Status Changing Time', 'وقت تغيير حالة التسليم', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6953, 'sa', 'Paid Status Changing Time', 'وقت تغيير الحالة المدفوعة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6954, 'sa', 'Send Bulk SMS', 'إرسال رسائل نصية مجمعة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6955, 'sa', 'All Subscribers', 'كل المشتركين', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6956, 'sa', 'Coupon Information Adding', 'إضافة معلومات القسيمة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6957, 'sa', 'Coupon Type', 'نوع القسيمة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6958, 'sa', 'For Products', 'للمنتجات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6959, 'sa', 'For Total Orders', 'لإجمالي الطلبات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6960, 'sa', 'Add Your Product Base Coupon', 'أضف قسيمة قاعدة المنتج الخاصة بك', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6961, 'sa', 'Coupon code', 'رمز الكوبون', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6962, 'sa', 'Sub Category', 'تصنيف فرعي', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6963, 'sa', 'Add More', 'أضف المزيد', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6964, 'sa', 'Add Your Cart Base Coupon', 'أضف قسيمة سلة التسوق الخاصة بك', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6965, 'sa', 'Minimum Shopping', 'الحد الأدنى من التسوق', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6966, 'sa', 'Maximum Discount Amount', 'الحد الأقصى لمبلغ الخصم', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6967, 'sa', 'Coupon Information Update', 'تحديث معلومات القسيمة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6968, 'sa', 'Please Configure SMTP Setting to work all email sending funtionality', 'يرجى تكوين إعداد SMTP للعمل على جميع وظائف إرسال البريد الإلكتروني', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6969, 'sa', 'Configure Now', 'تكوين الآن', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6970, 'sa', 'Total published products', 'إجمالي المنتجات المنشورة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6971, 'sa', 'Total sellers products', 'إجمالي منتجات البائعين', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6972, 'sa', 'Total admin products', 'إجمالي منتجات الإدارة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6973, 'sa', 'Manage Products', 'إدارة المنتجات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6974, 'sa', 'Total product category', 'فئة المنتج الإجمالية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6975, 'sa', 'Create Category', 'إنشاء فئة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6976, 'sa', 'Total product sub sub category', 'إجمالي فئة فرعية المنتج', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6977, 'sa', 'Create Sub Sub Category', 'تكوين فئة فرعية فرعية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6978, 'sa', 'Total product sub category', 'إجمالي فئة المنتج الفرعية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6979, 'sa', 'Create Sub Category', 'إنشاء فئة فرعية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6980, 'sa', 'Total product brand', 'إجمالي العلامة التجارية للمنتج', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6981, 'sa', 'Create Brand', 'إنشاء علامة تجارية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6982, 'sa', 'Total sellers', 'إجمالي البائعين', '2021-02-09 04:48:28', '2021-09-26 13:24:34'),
(6983, 'sa', 'Total approved sellers', 'إجمالي البائعين المعتمدين', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6984, 'sa', 'Total pending sellers', 'إجمالي البائعين المعلقين', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6985, 'sa', 'Manage Sellers', 'إدارة البائعين', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6986, 'sa', 'Category wise product sale', 'بيع المنتج من فئة المتغير', '2021-02-09 04:48:28', '2021-09-26 13:34:48'),
(6987, 'sa', 'Sale', 'تخفيض السعر', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6988, 'sa', 'Category wise product stock', 'فئة مخزون المنتج المتغير', '2021-02-09 04:48:28', '2021-09-26 13:34:48'),
(6989, 'sa', 'Category Name', 'اسم التصنيف', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6990, 'sa', 'Stock', 'مخزون', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6991, 'sa', 'Frontend', 'نهاية المقدمة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6992, 'sa', 'Home page', 'الصفحة الرئيسية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6993, 'sa', 'setting', 'ضبط', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6994, 'sa', 'Policy page', 'صفحة السياسة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6995, 'sa', 'General', 'معلومات عامة', '2021-02-09 04:48:28', '2021-09-26 13:18:48'),
(6996, 'sa', 'Click Here', 'انقر هنا', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6997, 'sa', 'Useful link', 'رابط مفيد', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6998, 'sa', 'Activation', 'التنشيط', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(6999, 'sa', 'SMTP', 'SMTP', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7000, 'sa', 'Payment method', 'طريقة الدفع او السداد', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7001, 'sa', 'Social media', 'وسائل التواصل الاجتماعي', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7002, 'sa', 'Business', 'اعمال', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7003, 'sa', 'Seller verification', 'التحقق من البائع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7004, 'sa', 'form setting', 'وضع النموذج', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7005, 'sa', 'Language', 'لغة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7006, 'sa', 'Dashboard', 'لوحة القيادة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7007, 'sa', 'POS System', 'نظام نقاط البيع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7008, 'sa', 'POS Manager', 'مدير نقاط البيع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7009, 'sa', 'POS Configuration', 'تكوين نقاط البيع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7010, 'sa', 'Products', 'منتجات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7011, 'sa', 'Add New product', 'اضافة منتج جديد', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7012, 'sa', 'All Products', 'جميع المنتجات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7013, 'sa', 'In House Products', 'منتجات المنزل', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7014, 'sa', 'Seller Products', 'منتجات البائع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7015, 'sa', 'Digital Products', 'المنتجات الرقمية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7016, 'sa', 'Bulk Import', 'استيراد بالجملة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7017, 'sa', 'Bulk Export', 'تصدير بالجملة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7018, 'sa', 'Category', 'الفئة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7019, 'sa', 'Subcategory', 'تصنيف فرعي', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7020, 'sa', 'Sub Subcategory', 'فئة فرعية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7021, 'sa', 'Brand', 'الماركة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7022, 'sa', 'Attribute', 'ينسب', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7023, 'sa', 'Product Reviews', 'تعليقات المنتج', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7024, 'sa', 'Sales', 'مبيعات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7025, 'sa', 'All Orders', 'جميع الطلبات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7026, 'sa', 'Inhouse orders', 'أوامر داخلية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7027, 'sa', 'Seller Orders', 'طلبات البائع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7028, 'sa', 'Pick-up Point Order', 'طلب نقطة الاستلام', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7029, 'sa', 'Refunds', 'المبالغ المستردة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7030, 'sa', 'Refund Requests', 'طلبات الاسترداد', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7031, 'sa', 'Approved Refund', 'إعادة الأموال المعتمدة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7032, 'sa', 'Refund Configuration', 'تكوين استرداد', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7033, 'sa', 'Customers', 'العملاء', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7034, 'sa', 'Customer list', 'قائمة العملاء', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7035, 'sa', 'Classified Products', 'المنتجات المبوبة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7036, 'sa', 'Classified Packages', 'الحزم المصنفة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7037, 'sa', 'Sellers', 'البائعين', '2021-02-09 04:48:28', '2021-09-26 13:24:34'),
(7038, 'sa', 'All Seller', 'كل البائعين', '2021-02-09 04:48:28', '2021-09-26 13:24:34'),
(7039, 'sa', 'Payouts', 'المدفوعات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7040, 'sa', 'Payout Requests', 'طلبات الدفع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7041, 'sa', 'Seller Commission', 'عمولة البائع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7042, 'sa', 'Seller Packages', 'حزم البائع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7043, 'sa', 'Seller Verification Form', 'نموذج التحقق من البائع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7044, 'sa', 'Reports', 'التقارير', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7045, 'sa', 'In House Product Sale', 'بيع المنتجات في المنزل', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7046, 'sa', 'Seller Products Sale', 'بيع منتجات البائع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7047, 'sa', 'Products Stock', 'مخزون المنتجات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7048, 'sa', 'Products wishlist', 'قائمة المنتجات المفضلة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7049, 'sa', 'User Searches', 'عمليات بحث المستخدم', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7050, 'sa', 'Marketing', 'تسويق', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7051, 'sa', 'Flash deals', 'صفقات فلاش', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7052, 'sa', 'Newsletters', 'النشرات الإخبارية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7053, 'sa', 'Bulk SMS', 'الرسائل القصيرة بالجملة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7054, 'sa', 'Subscribers', 'مشتركين', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7055, 'sa', 'Coupon', 'القسيمة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7056, 'sa', 'Support', 'الدعم', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7057, 'sa', 'Ticket', 'تذكرة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7058, 'sa', 'Product Queries', 'استفسارات المنتج', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7059, 'sa', 'Website Setup', 'إعداد الموقع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7060, 'sa', 'Header', 'رأس', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7061, 'sa', 'Footer', 'تذييل', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7062, 'sa', 'Pages', 'الصفحات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7063, 'sa', 'Appearance', 'مظهر خارجي', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7064, 'sa', 'Setup & Configurations', 'الإعداد والتكوينات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7065, 'sa', 'General Settings', 'الاعدادات العامة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7066, 'sa', 'Features activation', 'تفعيل الميزات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7067, 'sa', 'Languages', 'اللغات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7068, 'sa', 'Currency', 'عملة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7069, 'sa', 'Pickup point', 'نقطة الالتقاط', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7070, 'sa', 'SMTP Settings', 'إعدادات SMTP', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7071, 'sa', 'Payment Methods', 'طرق الدفع', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7072, 'sa', 'File System Configuration', 'تكوين نظام الملفات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7073, 'sa', 'Social media Logins', 'عمليات تسجيل الدخول إلى وسائل التواصل الاجتماعي', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7074, 'sa', 'Analytics Tools', 'أدوات التحليلات', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7075, 'sa', 'Facebook Chat', 'دردشة الفيسبوك', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7076, 'sa', 'Google reCAPTCHA', 'جوجل reCAPTCHA', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7077, 'sa', 'Shipping Configuration', 'تكوين الشحن', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7078, 'sa', 'Shipping Countries', 'دول الشحن', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7079, 'sa', 'Affiliate System', 'نظام الانتساب', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7080, 'sa', 'Affiliate Registration Form', 'استمارة تسجيل المنتسبين', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7081, 'sa', 'Affiliate Configurations', 'التكوينات التابعة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7082, 'sa', 'Affiliate Users', 'المستخدمون المنتسبون', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7083, 'sa', 'Referral Users', 'المستخدمون المحالون', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7084, 'sa', 'Affiliate Withdraw Requests', 'طلبات السحب التابعة', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7085, 'sa', 'Offline Payment System', 'نظام الدفع دون اتصال بالإنترنت', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7086, 'sa', 'Manual Payment Methods', 'طرق الدفع اليدوية', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7087, 'sa', 'Offline Wallet Recharge', 'إعادة شحن المحفظة دون اتصال بالإنترنت', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7088, 'sa', 'Offline Customer Package Payments', 'مدفوعات حزمة العملاء غير المتصلين', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7089, 'sa', 'Offline Seller Package Payments', 'مدفوعات حزمة البائع غير المتصل', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7090, 'sa', 'Paytm Payment Gateway', 'بوابة الدفع Paytm', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7091, 'sa', 'Set Paytm Credentials', 'قم بتعيين بيانات اعتماد Paytm', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7092, 'sa', 'Club Point System', 'نظام كلوب بوينت', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7093, 'sa', 'Club Point Configurations', 'تكوينات كلوب بوينت', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7094, 'sa', 'Set Product Point', 'تعيين نقطة المنتج', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7095, 'sa', 'User Points', 'نقاط المستخدم', '2021-02-09 04:48:28', '2021-02-09 04:48:28'),
(7096, 'sa', 'OTP System', 'نظام OTP', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7097, 'sa', 'OTP Configurations', 'تكوينات OTP', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7098, 'sa', 'Set OTP Credentials', 'قم بتعيين بيانات اعتماد OTP', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7099, 'sa', 'Staffs', 'طاقم العمل', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7100, 'sa', 'All staffs', 'كل فريق العمل', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7101, 'sa', 'Staff permissions', 'أذونات الموظفين', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7102, 'sa', 'Addon Manager', 'مدير الملحق', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7103, 'sa', 'Browse Website', 'تصفح الموقع', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7104, 'sa', 'POS', 'نقاط البيع', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7105, 'sa', 'Notifications', 'إشعارات', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7106, 'sa', 'new orders', 'طلبات جديدة', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7107, 'sa', 'user-image', 'صورة المستخدم', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7108, 'sa', 'Profile', 'الملف الشخصي', '2021-02-09 04:48:29', '2021-02-09 04:48:29'),
(7109, 'sa', 'Logout', 'تسجيل خروج', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7110, 'sa', 'Page Not Found!', 'الصفحة غير موجودة!', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7111, 'sa', 'The page you are looking for has not been found on our server.', 'لم يتم العثور على الصفحة التي تبحث عنها على خادمنا.', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7112, 'sa', 'Registration', 'التسجيل', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7113, 'sa', 'I am shopping for...', 'انا اتسوق لأجل...', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7114, 'sa', 'Compare', 'قارن', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7115, 'sa', 'Wishlist', 'قائمة الرغبات', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7116, 'sa', 'Cart', 'عربة التسوق', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7117, 'sa', 'Your Cart is empty', 'عربة التسوق فارغة', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7118, 'sa', 'Categories', 'التصنيفات', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7119, 'sa', 'See All', 'اظهار الكل', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7120, 'sa', 'Seller Policy', 'سياسة البائع', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7121, 'sa', 'Return Policy', 'سياسة العائدات', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7122, 'sa', 'Support Policy', 'سياسة الدعم', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7123, 'sa', 'Privacy Policy', 'سياسة خاصة', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7124, 'sa', 'Your Email Address', 'عنوان بريدك الإلكتروني', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7125, 'sa', 'Subscribe', 'الإشتراك', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7126, 'sa', 'Contact Info', 'معلومات الاتصال', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7127, 'sa', 'Address', 'عنوان', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7128, 'sa', 'Phone', 'هاتف', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7129, 'sa', 'Email', 'البريد الإلكتروني', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7130, 'sa', 'Login', 'تسجيل الدخول', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7131, 'sa', 'My Account', 'حسابي', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7132, 'sa', 'Order History', 'تاريخ الطلب', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7133, 'sa', 'My Wishlist', 'قائمة رغباتي', '2021-02-09 04:48:49', '2021-09-26 13:01:40'),
(7134, 'sa', 'Track Order', 'ترتيب المسار', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7135, 'sa', 'Be an affiliate partner', 'كن شريكًا تابعًا', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7136, 'sa', 'Be a Seller', 'كن بائعا', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7137, 'sa', 'Apply Now', 'قدم الآن', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7138, 'sa', 'Confirmation', 'التأكيد', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7139, 'sa', 'Delete confirmation message', 'حذف رسالة التأكيد', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7140, 'sa', 'Cancel', 'إلغاء', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7141, 'sa', 'Delete', 'حذف', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7142, 'sa', 'Item has been added to compare list', 'تمت إضافة العنصر إلى قائمة المقارنة', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7143, 'sa', 'Please login first', 'الرجاء تسجيل الدخول أولا', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7144, 'sa', 'Total Earnings From', 'إجمالي الأرباح من', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7145, 'sa', 'Client Subscription', 'اشتراك العميل', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7146, 'sa', 'Product category', 'فئة المنتج', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7147, 'sa', 'Product sub sub category', 'الفئة الفرعية للمنتج', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7148, 'sa', 'Product sub category', 'فئة المنتج الفرعية', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7149, 'sa', 'Product brand', 'العلامة التجارية المنتج', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7150, 'sa', 'Top Client Packages', 'حزم العميل الأعلى', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7151, 'sa', 'Top Freelancer Packages', 'أفضل الحزم لحسابهم الخاص', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7152, 'sa', 'Number of sale', 'رقم البيع', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7153, 'sa', 'Number of Stock', 'عدد الأسهم', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7154, 'sa', 'Top 10 Products', 'أفضل 10 منتجات', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7155, 'sa', 'Top 12 Products', 'أفضل 12 منتجات', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7156, 'sa', 'Admin can not be a seller', 'لا يمكن للمسؤول أن يكون بائعًا', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7157, 'sa', 'Filter by Rating', 'تصفية حسب التصنيف', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7158, 'sa', 'Published reviews updated successfully', 'تم تحديث المراجعات المنشورة بنجاح', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7159, 'sa', 'Refund Sticker has been updated successfully', 'تم تحديث ملصق رد الأموال بنجاح', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7160, 'sa', 'Edit Product', 'تحرير المنتج', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7161, 'sa', 'Meta Images', 'ميتا صور', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7162, 'sa', 'Update Product', 'تحديث المنتج', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7163, 'sa', 'Product has been deleted successfully', 'تم حذف المنتج بنجاح', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7164, 'sa', 'Your Profile has been updated successfully!', 'تم تحديث ملفك الشخصي بنجاح!', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7165, 'sa', 'Upload limit has been reached. Please upgrade your package.', 'تم الوصول إلى حد التحميل. الرجاء ترقية الحزمة الخاصة بك.', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7166, 'sa', 'Add Your Product', 'أضف منتجك', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7167, 'sa', 'Select a category', 'اختر تصنيف', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7168, 'sa', 'Select a brand', 'اختر ماركة', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7169, 'sa', 'Product Unit', 'وحدة المنتج', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7170, 'sa', 'Minimum Qty.', 'الحد الأدنى من الكمية.', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7171, 'sa', 'Product Tag', 'علامة المنتج', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7172, 'sa', 'Type & hit enter', 'اكتب & اضغط دخول', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7173, 'sa', 'Videos', 'أشرطة فيديو', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7174, 'sa', 'Video From', 'فيديو من', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7175, 'sa', 'Video URL', 'رابط الفيديو', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7176, 'sa', 'Customer Choice', 'اختيار العميل', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7177, 'sa', 'PDF', 'بي دي إف', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7178, 'sa', 'Choose PDF', 'اختر PDF', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7179, 'sa', 'Select Category', 'اختر الفئة', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7180, 'sa', 'Target Category', 'الفئة المستهدفة', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7181, 'sa', 'subsubcategory', 'فئة فرعية', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7182, 'sa', 'Search Category', 'فئة البحث', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7183, 'sa', 'Search SubCategory', 'بحث فرعي', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7184, 'sa', 'Search SubSubCategory', 'بحث SubSubCategory', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7185, 'sa', 'Update your product', 'قم بتحديث منتجك', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7186, 'sa', 'Product has been updated successfully', 'تم تحديث المنتج بنجاح', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7187, 'sa', 'Add Your Digital Product', 'أضف منتجك الرقمي', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7188, 'sa', 'Active eCommerce CMS Update Process', 'عملية تحديث CMS للتجارة الإلكترونية النشطة', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7189, 'sa', 'Codecanyon purchase code', 'كود شراء Codecanyon', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7190, 'sa', 'Database Name', 'اسم قاعدة البيانات', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7191, 'sa', 'Database Username', 'اسم مستخدم قاعدة البيانات', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7192, 'sa', 'Database Password', 'كلمة مرور قاعدة البيانات', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7193, 'sa', 'Database Hostname', 'اسم مضيف قاعدة البيانات', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7194, 'sa', 'Update Now', 'تحديث الان', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7195, 'sa', 'Congratulations', 'تهانينا', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7196, 'sa', 'You have successfully completed the updating process. Please Login to continue', 'لقد أكملت بنجاح عملية التحديث. الرجاء تسجيل الدخول للمتابعة', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7197, 'sa', 'Go to Home', 'اذهب إلى الصفحة الرئيسية', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7198, 'sa', 'Login to Admin panel', 'تسجيل الدخول إلى لوحة الإدارة', '2021-02-09 04:48:49', '2021-02-09 04:48:49');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(7199, 'sa', 'S3 File System Credentials', 'بيانات اعتماد نظام ملف S3', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7200, 'sa', 'AWS_ACCESS_KEY_ID', 'AWS_ACCESS_KEY_ID', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7201, 'sa', 'AWS_SECRET_ACCESS_KEY', 'AWS_SECRET_ACCESS_KEY', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7202, 'sa', 'AWS_DEFAULT_REGION', 'AWS_DEFAULT_REGION', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7203, 'sa', 'AWS_BUCKET', 'AWS_BUCKET', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7204, 'sa', 'AWS_URL', 'AWS_URL', '2021-02-09 04:48:49', '2021-02-09 04:48:49'),
(7205, 'sa', 'S3 File System Activation', 'تفعيل نظام ملفات S3', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7206, 'sa', 'Your phone number', 'رقم تليفونك', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7207, 'sa', 'Zip File', 'ملف مضغوط', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7208, 'sa', 'Install', 'تثبيت', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7209, 'sa', 'This version is not capable of installing Addons, Please update.', 'هذا الإصدار غير قادر على تثبيت الملحقات ، يرجى التحديث.', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7210, 'sa', 'Search in menu', 'البحث في القائمة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7211, 'sa', 'Uploaded Files', 'الملفات التي يتم تحميلها', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7212, 'sa', 'Shipping Cities', 'مدن الشحن', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7213, 'sa', 'System', 'النظام', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7214, 'sa', 'Server status', 'حالة الملقم', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7215, 'sa', 'Nothing Found', 'لا شيء موجود', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7216, 'sa', 'Parent Category', 'القسم الرئيسي', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7217, 'sa', 'Level', 'مستوى', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7218, 'sa', 'Category Information', 'معلومات الفئة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7219, 'sa', 'Translatable', 'قابل للترجمة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7220, 'sa', 'No Parent', 'لا يوجد أصل', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7221, 'sa', 'Physical', 'جسدي - بدني', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7222, 'sa', 'Digital', 'رقمي', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7223, 'sa', '200x200', '200 × 200', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7224, 'sa', '32x32', '32x32', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7225, 'sa', 'Search your files', 'ابحث في ملفاتك', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7226, 'sa', 'Category has been updated successfully', 'تم تحديث الفئة بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7227, 'sa', 'All uploaded files', 'جميع الملفات المرفوعة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7228, 'sa', 'Upload New File', 'تحميل ملف جديد', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7229, 'sa', 'All files', 'كل الملفات', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7230, 'sa', 'Search', 'بحث', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7231, 'sa', 'Details Info', 'تفاصيل معلومات', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7232, 'sa', 'Copy Link', 'انسخ الرابط', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7233, 'sa', 'Are you sure to delete this file?', 'هل أنت متأكد من حذف هذا الملف؟', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7234, 'sa', 'File Info', 'معلومات الملف', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7235, 'sa', 'Link copied to clipboard', 'تم نسخ الرابط إلى الحافظة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7236, 'sa', 'Oops, unable to copy', 'عفوًا ، غير قادر على النسخ', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7237, 'sa', 'File deleted successfully', 'تم حذف الملف بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7238, 'sa', 'Add New Brand', 'أضف علامة تجارية جديدة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7239, 'sa', '120x80', '120 × 80', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7240, 'sa', 'Brand Information', 'معلومات العلامة التجارية', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7241, 'sa', 'Brand has been updated successfully', 'تم تحديث العلامة التجارية بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7242, 'sa', 'Brand has been deleted successfully', 'تم حذف العلامة التجارية بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7243, 'sa', 'This is used for search. Input those words by which cutomer can find this product.', 'هذا يستخدم للبحث. أدخل تلك الكلمات التي يمكن لـ cutomer العثور على هذا المنتج من خلالها.', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7244, 'sa', 'These images are visible in product details page gallery. Use 600x600 sizes images.', 'هذه الصور مرئية في معرض صفحة تفاصيل المنتج. استخدم صور بحجم 600 × 600.', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7245, 'sa', 'This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.', 'هذه الصورة مرئية في كل علبة المنتج. استخدم صورة بحجم 300 × 300. احتفظ ببعض المساحة الفارغة حول الكائن الرئيسي لصورتك حيث كان علينا قص بعض الحواف في أجهزة مختلفة لجعلها مستجيبة.', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7246, 'sa', 'Use proper link without extra parameter. Don\'t use short share link/embeded iframe code.', 'استخدم الارتباط المناسب بدون معلمة إضافية. لا تستخدم رابط المشاركة القصير / كود iframe المضمن.', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7247, 'sa', 'Save Product', 'حفظ المنتج', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7248, 'sa', 'Product has been inserted successfully', 'تم إدخال المنتج بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7249, 'sa', 'Something went wrong!', 'هناك خطأ ما!', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7250, 'sa', 'Sorry for the inconvenience, but we\'re working on it.', 'آسف على الإزعاج ، لكننا نعمل على ذلك.', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7251, 'sa', 'Error code', 'خطا بالكود', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7252, 'sa', 'Please Configure SMTP Setting to work all email sending functionality', 'يرجى تكوين إعداد SMTP للعمل على جميع وظائف إرسال البريد الإلكتروني', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7253, 'sa', 'Order', 'طلب', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7254, 'sa', 'We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.', 'لدينا ارتفاع محدود للافتة للحفاظ على واجهة المستخدم. كان علينا الاقتصاص من كلا الجانبين الأيسر والأيمن في عرض الأجهزة المختلفة لجعلها مستجيبة. قبل تصميم لافتة ضع هذه النقاط في الاعتبار.', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7255, 'sa', 'Home Banner 3 (Max 3)', 'لافتة المنزل 3 (الحد الأقصى 3)', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7256, 'sa', 'Add New Seller', 'إضافة بائع جديد', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7257, 'sa', 'Filter by Approval', 'تصفية حسب الموافقة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7258, 'sa', 'Non-Approved', 'ليس مصدق عليه', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7259, 'sa', 'Type name or email & Enter', 'اكتب الاسم أو البريد الإلكتروني وأدخل', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7260, 'sa', 'Due to seller', 'مستحق للبائع', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7261, 'sa', 'Log in as this Seller', 'تسجيل الدخول باسم هذا البائع', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7262, 'sa', 'Go to Payment', 'انتقل إلى الدفع', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7263, 'sa', 'Ban this seller', 'حظر هذا البائع', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7264, 'sa', 'Do you really want to ban this seller?', 'هل تريد حقًا حظر هذا البائع؟', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7265, 'sa', 'Proceed!', 'تقدم!', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7266, 'sa', 'Approved sellers updated successfully', 'تم تحديث البائعين المعتمدين بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7267, 'sa', 'Seller has been deleted successfully', 'تم حذف البائع بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7268, 'sa', 'Seller Information', 'معلومات البائع', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7269, 'sa', 'Seller has been inserted successfully', 'تم إدراج البائع بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7270, 'sa', 'Email already exists!', 'البريد الالكتروني موجود بالفعل!', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7271, 'sa', 'Verify Your Email Address', 'تحقق من عنوان بريدك الإلكتروني', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7272, 'sa', 'Before proceeding, please check your email for a verification link.', 'قبل المتابعة ، يرجى التحقق من بريدك الإلكتروني للحصول على رابط التحقق.', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7273, 'sa', 'If you did not receive the email.', 'إذا لم تستلم البريد الإلكتروني.', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7274, 'sa', 'Click here to request another', 'انقر هنا لطلب آخر', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7275, 'sa', 'Email Verification', 'تأكيد بواسطة البريد الالكتروني', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7276, 'sa', 'Email Verification - ', 'تأكيد بواسطة البريد الالكتروني -', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7277, 'sa', 'HTTPS Activation', 'تفعيل HTTPS', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7278, 'sa', 'Maintenance Mode', 'نمط الصيانة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7279, 'sa', 'Maintenance Mode Activation', 'تفعيل وضع الصيانة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7280, 'sa', 'Classified Product Activate', 'تنشيط المنتج المصنف', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7281, 'sa', 'Classified Product', 'منتج مصنف', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7282, 'sa', 'Business Related', 'الأعمال ذات الصلة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7283, 'sa', 'Vendor System Activation', 'تفعيل نظام البائع', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7284, 'sa', 'Wallet System Activation', 'تفعيل نظام المحفظة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7285, 'sa', 'Coupon System Activation', 'تفعيل نظام القسيمة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7286, 'sa', 'Pickup Point Activation', 'تفعيل نقطة الالتقاط', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7287, 'sa', 'Conversation Activation', 'تفعيل المحادثة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7288, 'sa', 'Guest Checkout Activation', 'تفعيل تسجيل خروج الضيف', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7289, 'sa', 'Category-based Commission', 'عمولة على أساس الفئة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7290, 'sa', 'After activate this option Seller commision will be disabled and You need to set commission on each category otherwise Admin will not get any commision', 'بعد تفعيل هذا الخيار ، سيتم تعطيل عمولة البائع وتحتاج إلى تعيين العمولة على كل فئة وإلا فلن يحصل المسؤول على أي عمولة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7291, 'sa', 'Set Commisssion Now', 'تعيين كوميسيون الآن', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7292, 'sa', 'Payment Related', 'الدفع ذات الصلة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7293, 'sa', 'Paypal Payment Activation', 'تفعيل الدفع باي بال', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7294, 'sa', 'You need to configure Paypal correctly to enable this feature', 'تحتاج إلى تكوين Paypal بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7295, 'sa', 'Stripe Payment Activation', 'تفعيل الدفع عبر الشريط', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7296, 'sa', 'SSlCommerz Activation', 'تفعيل SSlCommerz', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7297, 'sa', 'Instamojo Payment Activation', 'تفعيل الدفع Instamojo', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7298, 'sa', 'You need to configure Instamojo Payment correctly to enable this feature', 'تحتاج إلى تكوين Instamojo Payment بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7299, 'sa', 'Razor Pay Activation', 'تفعيل دفع RazorPay', '2021-02-09 04:48:50', '2021-09-26 12:56:18'),
(7300, 'sa', 'You need to configure Razor correctly to enable this feature', 'تحتاج إلى تكوين Razor بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7301, 'sa', 'PayStack Activation', 'تفعيل PayStack', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7302, 'sa', 'You need to configure PayStack correctly to enable this feature', 'تحتاج إلى تكوين PayStack بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7303, 'sa', 'VoguePay Activation', 'تفعيل VoguePay', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7304, 'sa', 'You need to configure VoguePay correctly to enable this feature', 'تحتاج إلى تكوين VoguePay بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7305, 'sa', 'Payhere Activation', 'تفعيل Payhere', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7306, 'sa', 'Ngenius Activation', 'تفعيل Ngenius', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7307, 'sa', 'You need to configure Ngenius correctly to enable this feature', 'تحتاج إلى تكوين Ngenius بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7308, 'sa', 'Iyzico Activation', 'تفعيل Iyzico', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7309, 'sa', 'You need to configure iyzico correctly to enable this feature', 'تحتاج إلى تكوين iyzico بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7310, 'sa', 'Bkash Activation', 'تفعيل بكاش', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7311, 'sa', 'You need to configure bkash correctly to enable this feature', 'تحتاج إلى تكوين bkash بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7312, 'sa', 'Nagad Activation', 'تفعيل نجاد', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7313, 'sa', 'You need to configure nagad correctly to enable this feature', 'تحتاج إلى تكوين nagad بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7314, 'sa', 'Cash Payment Activation', 'تفعيل الدفع النقدي', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7315, 'sa', 'Social Media Login', 'تسجيل الدخول إلى وسائل التواصل الاجتماعي', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7316, 'sa', 'Facebook login', 'تسجيل الدخول الى الفيسبوك', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7317, 'sa', 'You need to configure Facebook Client correctly to enable this feature', 'تحتاج إلى تكوين Facebook Client بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7318, 'sa', 'Google login', 'تسجيل الدخول إلى Google', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7319, 'sa', 'You need to configure Google Client correctly to enable this feature', 'تحتاج إلى تكوين عميل Google بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7320, 'sa', 'Twitter login', 'تسجيل الدخول إلى Twitter', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7321, 'sa', 'You need to configure Twitter Client correctly to enable this feature', 'تحتاج إلى تكوين عميل تويتر بشكل صحيح لتمكين هذه الميزة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7322, 'sa', 'Shop Logo', 'متجر الشعار', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7323, 'sa', 'Shop Address', 'عنوان المحل', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7324, 'sa', 'Banner Settings', 'إعدادات البانر', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7325, 'sa', 'Banners', 'لافتات', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7326, 'sa', 'We had to limit height to maintian consistancy. In some device both side of the banner might be cropped for height limitation.', 'كان علينا تحديد الارتفاع للحفاظ على الاتساق. في بعض الأجهزة ، قد يتم اقتصاص كلا جانبي الشعار للحد من الارتفاع.', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7327, 'sa', 'Insert link with https ', 'أدخل الارتباط مع https', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7328, 'sa', 'Your Shop has been updated successfully!', 'تم تحديث متجرك بنجاح!', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7329, 'sa', 'Search result for ', 'نتيجة البحث عن', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7330, 'sa', 'Brand has been inserted successfully', 'تم إدراج العلامة التجارية بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7331, 'sa', 'About', 'حول', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7332, 'sa', 'Payout Info', 'معلومات الدفع', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7333, 'sa', 'Bank Acc Name', 'اسم حساب البنك', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7334, 'sa', 'Bank Acc Number', 'رقم حساب البنك', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7335, 'sa', 'Total Products', 'إجمالي المنتجات', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7336, 'sa', 'Total Sold Amount', 'إجمالي المبلغ المباع', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7337, 'sa', 'Wallet Balance', 'رصيد المحفظة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7338, 'sa', 'Cookies Agreement', 'اتفاقية ملفات تعريف الارتباط', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7339, 'sa', 'Cookies Agreement Text', 'نص اتفاقية ملفات تعريف الارتباط', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7340, 'sa', 'Show Cookies Agreement?', 'إظهار اتفاقية ملفات تعريف الارتباط؟', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7341, 'sa', 'Custom Script', 'برنامج نصي مخصص', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7342, 'sa', 'Header custom script - before </head>', 'البرنامج النصي المخصص للرأس - قبل </head>', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7343, 'sa', 'Write script with <script> tag', 'اكتب البرنامج النصي بعلامة <script>', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7344, 'sa', 'Footer custom script - before </body>', 'البرنامج النصي المخصص للتذييل - قبل </ body>', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7345, 'sa', 'Category has been inserted successfully', 'تم ادراج الفئة بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7346, 'sa', 'All Flash Deals', 'جميع عروض فلاش', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7347, 'sa', 'Create New Flash Deal', 'إنشاء صفقة فلاش جديدة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7348, 'sa', '#FFFFFF', '#FFFFFF', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7349, 'sa', 'This image is shown as cover banner in flash deal details page.', 'تظهر هذه الصورة كبانر غلاف في صفحة تفاصيل صفقة فلاش.', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7350, 'sa', 'Flash Deal has been inserted successfully', 'تم إدراج عرض الفلاش بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7351, 'sa', 'Flash deal status updated successfully', 'تم تحديث حالة صفقة الفلاش بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7352, 'sa', 'Flash Deal has been updated successfully', 'تم تحديث صفقة الفلاش بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7353, 'sa', 'update Language Info', 'تحديث معلومات اللغة', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7354, 'sa', 'Language has been updated successfully', 'تم تحديث اللغة بنجاح', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7355, 'sa', 'Type key & Enter', 'اكتب مفتاح وأدخل', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7356, 'sa', 'Translations updated for ', 'تم تحديث الترجمات لـ', '2021-02-09 04:48:50', '2021-02-09 04:48:50'),
(7357, 'sa', 'File selected', 'File selected', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7358, 'sa', 'Files selected', 'Files selected', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7359, 'sa', 'Add more files', 'Add more files', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7360, 'sa', 'Adding more files', 'Adding more files', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7361, 'sa', 'Drop files here, paste or', 'Drop files here, paste or', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7362, 'sa', 'Upload complete', 'Upload complete', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7363, 'sa', 'Upload paused', 'Upload paused', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7364, 'sa', 'Resume upload', 'Resume upload', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7365, 'sa', 'Pause upload', 'Pause upload', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7366, 'sa', 'Retry upload', 'Retry upload', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7367, 'sa', 'Cancel upload', 'Cancel upload', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7368, 'sa', 'Uploading', 'Uploading', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7369, 'sa', 'Processing', 'Processing', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7370, 'sa', 'Complete', 'Complete', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7371, 'sa', 'Files', 'Files', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7372, 'sa', 'Commission History', 'Commission History', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7373, 'sa', 'Wallet Recharge History', 'Wallet Recharge History', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7374, 'sa', 'Blog System', 'نظام المدونات', '2021-07-20 07:06:07', '2021-08-09 14:51:56'),
(7375, 'sa', 'All Posts', 'All Posts', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7376, 'sa', 'Vat & TAX', 'Vat & TAX', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7377, 'sa', 'Facebook Comment', 'Facebook Comment', '2021-07-20 07:06:07', '2021-07-20 07:06:07'),
(7378, 'sa', 'Blogs', 'Blogs', '2021-07-20 07:06:08', '2021-07-20 07:06:08'),
(72380, 'en', 'orders.delivery_status', 'orders.delivery_status', '2021-07-25 14:05:45', '2021-07-25 14:05:45'),
(72381, 'sa', 'Language has been inserted successfully', 'تم إدخال اللغة بنجاح', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72382, 'sa', 'Flat Rate Shipping Cost calulation: How many products a customer purchase, doesn\'t matter. Shipping cost is fixed', 'حساب تكلفة الشحن بالسعر الثابت: لا يهم كم عدد المنتجات التي يشتريها العميل. تكلفة الشحن ثابتة', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72383, 'sa', 'Browse All Categories', 'تصفح جميع الفئات', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72384, 'sa', 'Find Our Locations', 'ابحث عن مواقعنا', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72385, 'sa', 'To Get More Emersive', 'للحصول على المزيد من التميز', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72386, 'sa', 'View All Sellers', 'عرض جميع البائعين', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72387, 'sa', 'Product Wise Shipping', 'المنتج متغير الشحن', '2021-07-25 17:30:26', '2021-09-26 13:34:48'),
(72388, 'sa', 'cairo', 'القاهرة', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72389, 'sa', 'Cost', 'كلفة', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72390, 'sa', 'alargantin', 'الأرجانتين', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72391, 'sa', 'Is Product Quantity Mulitiply', 'هل كمية المنتج Mulitiply', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72392, 'sa', 'Low Stock Quantity Warning', 'تحذير انخفاض كمية المخزون', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72393, 'sa', 'Stock Visibility State', 'حالة رؤية المخزون', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72394, 'sa', 'Show Stock Quantity', 'إظهار كمية المخزون', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72395, 'sa', 'Show Stock With Text Only', 'إظهار المخزون مع النص فقط', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72396, 'sa', 'Hide Stock', 'إخفاء المخزون', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72397, 'sa', 'Flash Deal', 'صفقة فلاش', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72398, 'sa', 'Add To Flash', 'أضف إلى Flash', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72399, 'sa', 'Estimate Shipping Time', 'تقدير وقت الشحن', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72400, 'sa', 'Shipping Days', 'أيام الشحن', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72401, 'sa', 'Save As Draft', 'حفظ كمسودة', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72402, 'sa', 'Save & Unpublish', 'حفظ & إلغاء النشر', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72403, 'sa', 'Save & Publish', 'حفظ ونشر', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72404, 'sa', 'Order Level', 'مستوى الطلب', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72405, 'sa', 'Install/Update Addon', 'تثبيت / تحديث الملحق', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72406, 'sa', 'No Addon Installed', 'لا يوجد ملحق مثبت', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72407, 'sa', 'Install/Update', 'تثبيت التحديث', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72408, 'sa', 'Filter by date', 'تصفية حسب التاريخ', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72409, 'sa', 'Seller', 'تاجر', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72410, 'sa', 'All Customers', 'كل العملاء', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72411, 'sa', 'Type email or name & Enter', 'اكتب البريد الإلكتروني أو الاسم وأدخل', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72412, 'sa', 'Package', 'صفقة', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72413, 'sa', 'Log in as this Customer', 'تسجيل الدخول باسم هذا العميل', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72414, 'sa', 'Ban this Customer', 'حظر هذا العميل', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72415, 'sa', 'Do you really want to ban this Customer?', 'هل تريد حقًا حظر هذا العميل؟', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72416, 'sa', 'Do you really want to unban this Customer?', 'هل تريد حقًا إلغاء حظر هذا العميل؟', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72417, 'sa', 'Uploaded By', 'تم الرفع بواسطة', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72418, 'sa', 'Customer Status', 'حالة العميل', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72419, 'sa', 'All Classifies Packages', 'كل حزم تصنيف', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72420, 'sa', 'Bkash Credential', 'اعتماد بكاش', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72421, 'sa', 'BKASH CHECKOUT APP KEY', 'BKASH CHECKOUT APP KEY', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72422, 'sa', 'BKASH CHECKOUT APP SECRET', 'BKASH CHECKOUT APP SECRET', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72423, 'sa', 'BKASH CHECKOUT USER NAME', 'اسم مستخدم تسجيل الخروج من بكاش', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72424, 'sa', 'BKASH CHECKOUT PASSWORD', 'BKASH CHECKOUT PASSWORD', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72425, 'sa', 'Bkash Sandbox Mode', 'وضع Bkash Sandbox', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72426, 'sa', 'Nagad Credential', 'نجاد الاعتماد', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72427, 'sa', 'NAGAD MODE', 'وضع نجاد', '2021-07-25 17:30:26', '2021-07-25 17:30:26'),
(72428, 'sa', 'NAGAD MERCHANT ID', 'معرف تاجر نجاد', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72429, 'sa', 'NAGAD MERCHANT NUMBER', 'رقم تاجر نجاد', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72430, 'sa', 'NAGAD PG PUBLIC KEY', 'نجاد مفتاح عام', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72431, 'sa', 'NAGAD MERCHANT PRIVATE KEY', 'نجاد مفتاح خاص للتاجر', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72432, 'sa', 'PAYSTACK CURRENCY CODE', 'رمز عملة الدفع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72433, 'sa', 'Iyzico Credential', 'اعتماد ايزيكو', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72434, 'sa', 'IYZICO_API_KEY', 'IYZICO_API_KEY', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72435, 'sa', 'IYZICO API KEY', 'IYZICO API KEY', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72436, 'sa', 'IYZICO_SECRET_KEY', 'IYZICO_SECRET_KEY', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72437, 'sa', 'IYZICO SECRET KEY', 'مفتاح IYZICO السري', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72438, 'sa', 'IYZICO Sandbox Mode', 'وضع الحماية IYZICO', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72439, 'sa', 'Facebook Pixel Setting', 'إعداد Facebook Pixel', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72440, 'sa', 'Facebook Pixel', 'فيسبوك بيكسل', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72441, 'sa', 'Facebook Pixel ID', 'معرف Facebook Pixel', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72442, 'sa', 'Please be carefull when you are configuring Facebook pixel.', 'يرجى توخي الحذر عند تكوين Facebook pixel.', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72443, 'sa', 'Log in to Facebook and go to your Ads Manager account', 'قم بتسجيل الدخول إلى Facebook وانتقل إلى حساب Ads Manager الخاص بك', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72444, 'sa', 'Open the Navigation Bar and select Events Manager', 'افتح شريط التنقل وحدد مدير الأحداث', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72445, 'sa', 'Copy your Pixel ID from underneath your Site Name and paste the number into Facebook Pixel ID field', 'انسخ معرّف Pixel من أسفل اسم الموقع والصق الرقم في حقل Facebook Pixel ID', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72446, 'sa', 'Google Analytics Setting', 'إعداد Google Analytics', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72447, 'sa', 'Google Analytics', 'تحليلات كوكل', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72448, 'sa', 'Tracking ID', 'معرف التتبع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72449, 'sa', 'Wallet Transaction Report', 'تقرير معاملات المحفظة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72450, 'sa', 'Wallet Transaction', 'معاملة المحفظة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72451, 'sa', 'Choose User', 'اختر المستخدم', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72452, 'sa', 'Daterange', 'نطاق الموعد', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72453, 'sa', 'Info', 'معلومات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72454, 'sa', 'Iyzico', 'ايزيكو', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72455, 'sa', 'Staff Information', 'معلومات الموظفين', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72456, 'sa', 'Step 1', 'الخطوة 1', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72457, 'sa', 'Download the skeleton file and fill it with proper data', 'قم بتنزيل ملف الهيكل العظمي واملأه بالبيانات المناسبة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72458, 'sa', 'You can download the example file to understand how the data must be filled', 'يمكنك تنزيل ملف المثال لفهم كيفية تعبئة البيانات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72459, 'sa', 'Once you have downloaded and filled the skeleton file, upload it in the form below and submit', 'بمجرد تنزيل ملف الهيكل العظمي وتعبئته ، قم بتحميله في النموذج أدناه وأرسله', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72460, 'sa', 'After uploading products you need to edit them and set product\'s images and choices', 'بعد تحميل المنتجات تحتاج إلى تعديلها وتعيين صور المنتج وخياراته', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72461, 'sa', 'Step 2', 'الخطوة 2', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72462, 'sa', 'Category and Brand should be in numerical id', 'يجب أن تكون الفئة والعلامة التجارية في معرف رقمي', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72463, 'sa', 'You can download the pdf to get Category and Brand id', 'يمكنك تنزيل ملف pdf للحصول على معرف الفئة والعلامة التجارية', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72464, 'sa', 'Upload Product File', 'تحميل ملف المنتج', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72465, 'sa', 'Trans imported successfully', 'تم استيراد Trans بنجاح', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72466, 'sa', 'Your order has been placed', 'وقد وضعت طلبك', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72467, 'sa', 'Payment completed', 'تم التسديد', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72468, 'sa', 'Please click the button below to verify your email address.', 'الرجاء النقر فوق الزر أدناه للتحقق من عنوان بريدك الإلكتروني.', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72469, 'sa', 'New verification request(s)', 'طلب (طلبات) تحقق جديد', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72470, 'sa', 'Seller Payments', 'مدفوعات البائع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72471, 'sa', 'Payment Details', 'بيانات الدفع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72472, 'sa', 'of seller product price will be deducted from seller earnings', 'من سعر منتج البائع سيتم خصمه من أرباح البائع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72473, 'sa', 'This commission only works when Category Based Commission is turned off from Business Settings', 'تعمل هذه العمولة فقط عند إيقاف تشغيل \"العمولة القائمة على الفئة\" من \"إعدادات الأعمال\"', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72474, 'sa', 'Commission doesn\'t work if seller package system add-on is activated', 'لا تعمل العمولة إذا تم تنشيط الوظيفة الإضافية لنظام حزمة البائع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72475, 'sa', 'Seller Withdraw Request', 'طلب سحب البائع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72476, 'sa', 'Total Amount to Pay', 'المبلغ الإجمالي للدفع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72477, 'sa', 'Requested Amount', 'الكمية المطلوبة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72478, 'sa', 'A fresh verification link has been sent to your email address.', 'تم إرسال رابط تحقق جديد إلى عنوان بريدك الإلكتروني.', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72479, 'sa', 'Use Phone Instead', 'استخدم الهاتف بدلاً من ذلك', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72480, 'sa', 'Email or Phone already exists.', 'البريد الإلكتروني أو الهاتف موجود بالفعل.', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72481, 'sa', 'Registration successfull. Please verify your email.', 'تم التسجيل بنجاح. يرجى التحقق من بريدك الإلكتروني.', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72482, 'sa', 'Your email has been verified successfully', 'تم التحقق من بريدك الإلكتروني بنجاح', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72483, 'sa', 'Recharge Wallet', 'إعادة شحن المحفظة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72484, 'sa', 'Offline Recharge Wallet', 'محفظة إعادة الشحن دون اتصال بالإنترنت', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72485, 'sa', 'Order status has been updated', 'تم تحديث حالة الطلب', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72486, 'sa', 'Pickip Point', 'نقطة الشحن', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72487, 'sa', 'Your Shop has been created successfully!', 'تم إنشاء متجرك بنجاح!', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72488, 'sa', 'Verify Now', 'تحقق الآن', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72489, 'sa', 'Uplaod Product', 'رفع المنتج', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72490, 'sa', 'Ordering Number', 'رقم الطلب', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72491, 'sa', 'Commission Rate', 'نسبة العمولة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72492, 'sa', 'Disable image optimization?', 'تعطيل تحسين الصورة؟', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72493, 'sa', 'Seller Product Manage By Admin', 'إدارة منتج البائع بواسطة المسؤول', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72494, 'sa', 'After activate this option Cash On Delivery of Seller product will be managed by Admin', 'بعد تفعيل هذا الخيار ، ستتم إدارة الدفع عند التسليم لمنتج البائع بواسطة المسؤول', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72495, 'sa', 'Back to uploaded files', 'العودة إلى الملفات المرفوعة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72496, 'sa', 'Drag & drop your files', 'اسحب الملفات وأفلتها', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72497, 'sa', ' PayTabs Credential', ' اعتماد بيتابس', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72498, 'sa', 'Profile Id', 'ملف البطاقة الشخصية', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72499, 'sa', 'Server  Key', 'مفتاح الخادم', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72500, 'sa', 'PayTabs Credential', 'اعتماد Paytabs', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72501, 'sa', 'Server Key', 'مفتاح الخادم', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72502, 'sa', 'PayTab Sandbox Mode\n', 'وضع حماية PayTab_x000D_\n', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72503, 'sa', 'PayTab Sandbox Mode', 'وضع PayTab Sandbox', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72504, 'sa', 'System Default Currency', 'عملة النظام الافتراضية', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72505, 'sa', 'Set Currency Formats', 'تعيين تنسيقات العملات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72506, 'sa', 'Symbol Format', 'تنسيق الرمز', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72507, 'sa', 'Decimal Separator', 'الفاصل العشري', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72508, 'sa', 'No of decimals', 'عدد الكسور العشرية', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72509, 'sa', 'All Currencies', 'جميع العملات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72510, 'sa', 'Add New Currency', 'أضف عملة جديدة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72511, 'sa', 'Currency name', 'اسم العملة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72512, 'sa', 'Currency symbol', 'رمز العملة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72513, 'sa', 'Currency code', 'رمز العملة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72514, 'sa', 'Currency Status updated successfully', 'تم تحديث حالة العملة بنجاح', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72515, 'sa', 'PayTab', 'بيتاب', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72516, 'sa', 'Forgot password ?', 'هل نسيت كلمة السر ؟', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72517, 'sa', 'Your Cart was empty', 'عربة التسوق الخاصة بك كانت فارغة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72518, 'sa', 'Your order has been placed successfully', 'تم وضع طلبك بنجاح', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72519, 'sa', 'The requested quantity is not available for ', 'الكمية المطلوبة غير متوفرة لـ', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72520, 'sa', 'TapPayment Secret API Key', 'TapPayment Secret API Key', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72521, 'sa', 'TapPayment Publishable API Key', 'TapPayment مفتاح API القابل للنشر', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72522, 'sa', 'TapPayment Merchant ID', 'TapPayment معرف التاجر', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72523, 'sa', 'TapPayment', 'TapPayment', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72524, 'sa', 'TapPayment Sandbox Mode', 'اضغط على وضع الحماية للدفع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72525, 'sa', 'TapPayment Credential', 'TapPayment بيانات الاعتماد', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72526, 'sa', 'Blog', 'مقالات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72527, 'sa', ' PayTab Sandbox Mode', ' وضع PayTab Sandbox', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72528, 'sa', 'Paytabsaudi', 'Paytabsaudi', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72529, 'sa', 'Header Nav Menu', 'قائمة تنقل الرأس', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72530, 'sa', 'Link with', 'ارتباط مع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72531, 'sa', 'Merchant Code', 'كود التاجر', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72532, 'sa', 'Security Key', 'مفتاح الامان', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72533, 'sa', 'Fawry Sandbox Mode', 'وضع Fawry Sandbox', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72534, 'sa', 'Fawry Live', 'فوري لايف', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72535, 'sa', 'Fawry Credential', 'اعتماد فوري', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72536, 'sa', 'Fawry', 'فوري', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72537, 'sa', 'Please add shipping address', 'الرجاء إضافة عنوان الشحن', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72538, 'sa', 'Abandoned baskets', 'سلال متروكه', '2021-07-25 17:30:27', '2021-08-09 14:48:38'),
(72539, 'sa', 'Emails', 'رسائل البريد الإلكتروني', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72540, 'sa', 'Users', 'المستخدمون', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72541, 'sa', 'Newsletter subject', 'موضوع النشرة الإخبارية', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72542, 'sa', 'Newsletter content', 'محتوى النشرة الإخبارية', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72543, 'sa', 'Created At', 'أنشئت في', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72544, 'sa', 'All rows number', 'كل عدد الصفوف', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72545, 'sa', 'Go to page', 'انتقل إلى صفحة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72546, 'sa', 'Page', 'صفحة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72547, 'sa', 'to', 'ل', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72548, 'sa', 'Desc', 'تنازلي', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72549, 'sa', 'Asc', 'تصاعدي', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72550, 'sa', 'increase', 'يزيد', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72551, 'sa', 'undefined', 'غير معرف', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72552, 'sa', 'Coupon has been saved successfully', 'تم حفظ القسيمة بنجاح', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72553, 'sa', 'Total Usage For One User', 'إجمالي الاستخدام لمستخدم واحد', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72554, 'sa', 'Coupon already exist for this coupon code', 'القسيمة موجودة بالفعل لرمز القسيمة هذا', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72555, 'sa', 'Coupon expired!', 'القسيمة منتهية الصلاحية!', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72556, 'sa', 'Coupon has been applied', 'تم تطبيق القسيمة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72557, 'sa', 'Change Coupon', 'تغيير القسيمة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72558, 'sa', 'You already used this coupon!', 'لقد استخدمت بالفعل هذه القسيمة!', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72559, 'sa', 'Wallet', 'محفظة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72560, 'sa', 'Add New Product var In baskets', 'إضافة منتج جديد var في سلال', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72561, 'sa', 'the Customer var_user Add New Product In Baskets a Price var_price Inclusive of Tax and Shipping\n', 'الزبون var_user يضيف منتج جديد في السله سعره var_price شامل الضريبه والشحن', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72562, 'sa', 'the Customer var_user Add New Product In Baskets a Price var_price Inclusive of Tax and Shipping', 'الزبون var_user يضيف منتج جديد في السله سعره var_price شامل الضريبه والشحن', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72563, 'sa', 'Not Have Any Address', 'ليس لديك أي عنوان', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72564, 'sa', 'Carts', 'عربات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72565, 'sa', 'Categorey Name', 'اسم فئة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72566, 'sa', 'Product Desc', 'وصف المنتج', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72567, 'sa', 'Customer Name', 'اسم الزبون', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72568, 'sa', 'Seller Phone', 'هاتف البائع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72569, 'sa', 'Phone `Number`', 'رقم الهاتف', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72570, 'sa', 'Phone Number', 'رقم التليفون', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72571, 'sa', 'With Free Shiping ?', 'مع الشحن المجاني؟', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72572, 'sa', 'Yes', 'نعم', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72573, 'sa', 'No', 'رقم', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72574, 'sa', 'Total Usage For All', 'إجمالي الاستخدام للجميع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72575, 'sa', 'Minimum Amount of Purchases', 'الحد الأدنى من المشتريات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72576, 'sa', 'Rate Total Customer Purchasers', 'معدل إجمالي مشتري العملاء', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72577, 'sa', 'Amount Total Customer Purchasers', 'المبلغ الإجمالي للعملاء المشترين', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72578, 'sa', 'Add Product', 'أضف منتج', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72579, 'sa', 'Choose Brand', 'اختر الماركة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72580, 'sa', 'Choose Category', 'اختر الفئة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72581, 'sa', 'No Selected Item', 'لا يوجد عنصر محدد', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72582, 'sa', 'No Item Selected', 'لم يتم تحديد أي عنصر', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72583, 'sa', 'Is Selected var_num Items', 'تم تحديد var_num من العناصر', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72584, 'sa', 'Save Changes', 'حفظ التغييرات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72585, 'sa', 'Minimum Amount of Purchases Not Enough', 'الحد الأدنى لمقدار المشتريات غير كافٍ', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72586, 'sa', 'Product Wish Report', 'تقرير رغبات المنتج', '2021-07-25 17:30:27', '2021-09-26 13:01:40'),
(72587, 'sa', 'Number of Wish', 'عدد الرغبات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72588, 'sa', 'Main Reports', 'التقارير الرئيسية', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72589, 'sa', 'There Error In Payment Process Not Finished', 'هناك خطأ في عملية الدفع لم تنته', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72590, 'sa', 'Product Prices', 'أسعار المنتجات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72591, 'sa', 'Taxes', 'الضرائب', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72592, 'sa', 'Sales Cash After Delivery', 'كاش المبيعات بعد التسليم', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72593, 'sa', 'Sales By Wallet', 'المبيعات عن طريق المحفظة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72594, 'sa', 'Sales By Elec Pay', 'المبيعات عن طريق Elec Pay', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72595, 'sa', 'Payment Sales', 'مبيعات الدفع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72596, 'sa', 'Number Products', 'عدد المنتجات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72597, 'sa', 'Quantity Products', 'كمية المنتجات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72598, 'sa', 'Taxes Amount', 'مبلغ الضرائب', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72599, 'sa', 'Taxes Percent', 'نسبة الضرائب', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72600, 'sa', 'Unit Prices', 'أسعار الوحدات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72601, 'sa', 'Purchase Prices', 'أسعار الشراء', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72602, 'sa', 'Visitor', 'زائر', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72603, 'sa', 'Open View Home Index', 'افتح عرض الصفحة الرئيسية الفهرس', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72604, 'sa', 'Customer Numbers Activies', 'أنشطة أرقام العملاء', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72605, 'sa', 'Customer Numbers Not Activies', 'أرقام العملاء ليست أنشطة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72606, 'sa', 'Customer Orders', 'طلبات العملاء', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72607, 'sa', 'Customer Purchases', 'مشتريات العملاء', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72608, 'sa', 'Visitores', 'الزوار', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72609, 'sa', 'Visitors', 'الزائرين', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72610, 'sa', 'Admins Visitors', 'زوار المشرفين', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72611, 'sa', 'Sellers Visitors', 'زوار البائعين', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72612, 'sa', 'Customers Visitors', 'زوار العملاء', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72613, 'sa', 'Guests Visitors', 'الزوار الزوار', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72614, 'sa', 'Seller Numbers Activies', 'أنشطة أرقام البائعين', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72615, 'sa', 'Seller Numbers Not Activies', 'أرقام البائع ليست أنشطة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72616, 'sa', 'Seller Purchases', 'مشتريات البائع', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72617, 'sa', 'Orders Status Deliver', 'تسليم حالة الطلبات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72618, 'sa', 'Orders Pending', 'الطلبات المعلقة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72619, 'sa', 'Orders Confirmed', 'تم تأكيد الطلبات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72620, 'sa', 'Orders On Delivery', 'الطلبات عند التسليم', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72621, 'sa', 'Orders Delivered', 'تم تسليم الطلبات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72622, 'sa', 'Orders Payment Status', 'حالة دفع الطلبات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72623, 'sa', 'Orders Paid', 'الطلبات المدفوعة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72624, 'sa', 'Orders UnPaid', 'الطلبات غير المدفوعة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72625, 'sa', 'Orders Paid Prices', 'أسعار الطلبات المدفوعة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72626, 'sa', 'Orders UnPaid Prices', 'أسعار الطلبات غير المدفوعة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72627, 'sa', 'Visits', 'الزيارات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72628, 'sa', 'Paytabegypt', 'Paytabegypt', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72629, 'sa', 'Id', 'بطاقة تعريف', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72630, 'sa', 'Un Paid', 'غير مدفوعة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72631, 'sa', 'Create New Order', 'إنشاء طلب جديد', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72632, 'sa', 'Toggle paginate', 'تبديل ترقيم الصفحات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72633, 'sa', 'Edit Order', 'تحرير الأمر', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72634, 'sa', 'weight', 'وزن', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72635, 'sa', 'Calc', 'احسب', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72636, 'sa', 'Calc Basckt', 'احسب باسكت', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72637, 'sa', 'Coupons', 'كوبونات', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72638, 'sa', 'Add Coupons', 'أضف القسائم', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72639, 'sa', 'Add Coupon', 'أضف عرض', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72640, 'sa', 'Customer Phone', 'هاتف العميل', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72641, 'sa', 'Customer Email', 'البريد الإلكتروني للعميل', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72642, 'sa', 'Please, the field only accepts email', 'من فضلك ، الحقل يقبل البريد الإلكتروني فقط', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72643, 'sa', '* Please, the field only accepts email', '* من فضلك ، الحقل يقبل البريد الإلكتروني فقط', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72644, 'sa', 'Choose Country', 'اختر الدولة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72645, 'sa', 'Product Price', 'سعر المنتج', '2021-07-25 17:30:27', '2021-07-25 17:30:27');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(72646, 'sa', 'Expend', 'أنفق', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72647, 'sa', 'Produc Name', 'اسم المنتج', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72648, 'sa', 'Produc Price', 'سعر المنتج', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72649, 'sa', 'Produc Color', 'إنتاج اللون', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72650, 'sa', 'Product Color', 'لون المنتج', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72651, 'sa', 'Save Change', 'حفظ التغيير', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72652, 'sa', 'No Number Phone', 'لا يوجد رقم هاتف', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72653, 'sa', 'pendding', 'معلقة', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72654, 'sa', 'Create Order', 'إنشاء النظام', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72655, 'sa', 'loading...', 'جار التحميل...', '2021-07-25 17:30:27', '2021-07-25 17:30:27'),
(72656, 'sa', 'Adress', 'العنوان', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72657, 'sa', 'please,write your adress to shipping', 'من فضلك اكتب عنوانك للشحن', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72658, 'sa', 'please,write your phone number', 'من فضلك اكتب رقم هاتفك', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72659, 'sa', 'please,write your postal code', 'من فضلك اكتب الرمز البريدي الخاص بك', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72660, 'sa', 'Shipping Data', 'بيانات الشحن', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72661, 'sa', 'please,write your adress to shipping*', 'من فضلك اكتب عنوانك للشحن *', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72662, 'sa', 'please,write your phone number*', 'من فضلك اكتب رقم هاتفك *', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72663, 'sa', 'please,write your postal code*', 'من فضلك اكتب الرمز البريدي الخاص بك *', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72664, 'sa', 'Country*', 'دولة*', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72665, 'sa', 'City*', 'مدينة*', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72666, 'sa', 'please,write your adress*', 'من فضلك اكتب عنوانك *', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72667, 'sa', 'please check var is empty', 'يرجى التحقق من var فارغ', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72668, 'sa', 'please check customer is empty', 'يرجى التحقق من أن العميل فارغ', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72669, 'sa', 'please,write your address*', 'من فضلك اكتب عنوانك *', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72670, 'sa', 'Order has been deleted successfully', 'تم حذف الطلب بنجاح', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72671, 'sa', 'Edit Shipping', 'تحرير الشحن', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72672, 'sa', 'Special Offers', 'عروض خاصة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72673, 'sa', 'Offer Data', 'عرض البيانات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72674, 'sa', 'Add a suitable title for the Offer', 'أضف عنوانًا مناسبًا للعرض', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72675, 'sa', 'Offer Title', 'عنوان العرض', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72676, 'sa', 'End Date Offer', 'عرض تاريخ الانتهاء', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72677, 'sa', 'Offer Type', 'نوع العرض', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72678, 'sa', 'Select the type of discount to be applied to the cart', 'حدد نوع الخصم الذي سيتم تطبيقه على سلة التسوق', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72679, 'sa', 'When the customer buy X get on y', 'عندما يشتري العميل X تحصل على y', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72680, 'sa', 'Fixed amount of customer purchases', 'كمية ثابتة من مشتريات العملاء', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72681, 'sa', 'Percent of customer purchases', 'نسبة مشتريات العملاء', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72682, 'sa', 'Offer Options', 'عرض الخيارات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72683, 'sa', 'Quantify', 'تحديد الكمية', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72684, 'sa', 'Choose Categories', 'اختر الفئات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72685, 'sa', 'Products Items are Choosing ', 'المنتجات يتم اختيار العناصر', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72686, 'sa', 'If the customer buys', 'إذا اشترى العميل', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72687, 'sa', 'Select the products and quantity to be available in the cart to apply the discount', 'حدد المنتجات والكمية المراد توفيرها في سلة التسوق لتطبيق الخصم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72688, 'sa', 'Determine what the customer gets when the previous condition is met', 'حدد ما يحصل عليه العميل عند استيفاء الشرط السابق', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72689, 'sa', 'Customer gets', 'يحصل العميل', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72690, 'sa', 'Discount Percent', 'نسبة الخصم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72691, 'sa', 'free product', 'منتج مجاني', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72692, 'sa', 'Products from', 'منتجات من', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72693, 'sa', 'discount value', 'قيمة الخصم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72694, 'sa', 'The customer received the discount', 'حصل العميل على الخصم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72695, 'sa', 'Maximum discount', 'الحد الأقصى للخصم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72696, 'sa', 'The total cost of the stimulus that the customer will receive may be', 'قد تكون التكلفة الإجمالية للحافز الذي سيحصل عليه العميل', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72697, 'sa', 'All products in the cart', 'جميع المنتجات في عربة التسوق', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72698, 'sa', 'Selected Products', 'منتجات مختارة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72699, 'sa', 'Selected Categories', 'فئات مختارة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72700, 'sa', 'Selected Payment Methods', 'طرق الدفع المختارة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72701, 'sa', 'Offer applies to', 'يسري العرض على', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72702, 'sa', 'Choose one of the following conditions to apply the offer', 'اختر أحد الشروط التالية لتطبيق العرض', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72703, 'sa', 'Paytab saudi', 'بيتاب السعودية', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72704, 'sa', 'Paytab egypt', 'بيتاب مصر', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72705, 'sa', 'Payments', 'المدفوعات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72706, 'sa', 'Choose Payments', 'اختر المدفوعات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72707, 'sa', 'Limit Offer', 'عرض الحد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72708, 'sa', 'Limit for Purchese Price', 'حد سعر Purchese', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72709, 'sa', 'Limit for Product Quantity', 'حد لكمية المنتج', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72710, 'sa', 'Limit for Products Quantity', 'حد لكمية المنتجات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72711, 'sa', 'Apply the offer with the discount coupon', 'تطبيق العرض مع كوبون الخصم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72712, 'sa', 'Create Special Offers', 'إنشاء عروض خاصة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72713, 'sa', 'quantify1', 'حدد كمية 1', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72714, 'sa', 'quantify2', 'حدد الكمية 2', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72715, 'sa', 'products1', 'المنتجات 1', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72716, 'sa', 'products2', 'المنتجات 2', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72717, 'sa', 'categories1', 'الفئات 1', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72718, 'sa', 'categories2', 'الفئات 2', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72719, 'sa', 'Data saved', 'تم حفظ البيانات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72720, 'sa', 'No Orders for this customer', 'لا توجد طلبات لهذا الزبون', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72721, 'sa', 'No Orders for this seller', 'لا توجد طلبات لهذا البائع', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72722, 'sa', 'No Products for this seller', 'لا توجد منتجات لهذا البائع', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72723, 'sa', 'Firebase Settings', 'إعدادات Firebase', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72724, 'sa', 'Sendmail', 'ارسل بريد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72725, 'sa', 'Mailgun', 'Mailgun', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72726, 'sa', 'MAIL HOST', 'مضيف البريد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72727, 'sa', 'MAIL PORT', 'منفذ البريد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72728, 'sa', 'MAIL USERNAME', 'اسم المستخدم البريد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72729, 'sa', 'MAIL PASSWORD', 'كلمة المرور البريدية', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72730, 'sa', 'MAIL ENCRYPTION', 'تشفير البريد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72731, 'sa', 'MAIL FROM ADDRESS', 'البريد من العنوان', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72732, 'sa', 'MAIL FROM NAME', 'البريد من الاسم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72733, 'sa', 'MAILGUN DOMAIN', 'المجال الرئيسي', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72734, 'sa', 'MAILGUN SECRET', 'سر البريد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72735, 'sa', 'Save Configuration', 'حفظ التكوين', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72736, 'sa', 'Test SMTP configuration', 'اختبار تكوين SMTP', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72737, 'sa', 'Enter your email address', 'أدخل عنوان بريدك الالكتروني', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72738, 'sa', 'Send test email', 'إرسال بريد إلكتروني تجريبي', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72739, 'sa', 'Instruction', 'تعليمات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72740, 'sa', 'Please be carefull when you are configuring SMTP. For incorrect configuration you will get error at the time of order place, new registration, sending newsletter.', 'يرجى توخي الحذر عند تكوين SMTP. للتكوين غير الصحيح ، ستحصل على خطأ في وقت تقديم الطلب ، والتسجيل الجديد ، وإرسال النشرة الإخبارية.', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72741, 'sa', 'For Non-SSL', 'لغير SSL', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72742, 'sa', 'Select sendmail for Mail Driver if you face any issue after configuring smtp as Mail Driver ', 'حدد sendmail لبرنامج Mail Driver إذا واجهت أي مشكلة بعد تكوين SMTP كبرنامج تشغيل البريد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72743, 'sa', 'Set Mail Host according to your server Mail Client Manual Settings', 'قم بتعيين مضيف البريد وفقًا للإعدادات اليدوية لعميل البريد الخاص بالخادم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72744, 'sa', 'Set Mail port as 587', 'قم بتعيين منفذ البريد على 587', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72745, 'sa', 'Set Mail Encryption as ssl if you face issue with tls', 'عيّن تشفير البريد كـ ssl إذا كنت تواجه مشكلة في tls', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72746, 'sa', 'For SSL', 'لـ SSL', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72747, 'sa', 'Set Mail port as 465', 'قم بتعيين منفذ البريد كـ 465', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72748, 'sa', 'Set Mail Encryption as ssl', 'قم بتعيين تشفير البريد كـ ssl', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72749, 'sa', 'Firebase Configration', 'ترحيل Firebase', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72750, 'sa', 'Auth Domain', 'مجال مصادقة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72751, 'sa', 'Project Id', 'معرف المشروع', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72752, 'sa', 'Storage Bucket', 'دلو التخزين', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72753, 'sa', 'Messagin Sender Id', 'معرف مرسل Messagin', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72754, 'sa', 'App Id', 'معرف التطبيق', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72755, 'sa', 'Measurement Id', 'معرّف القياس', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72756, 'sa', 'Save Data', 'حفظ البيانات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72757, 'sa', 'the var is required', 'var مطلوب', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72758, 'sa', 'Data saved successfully', 'تم حفظ المعلومات بنجاح', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72759, 'sa', 'User Id', 'معرف المستخدم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72760, 'sa', 'Edit Profile', 'تعديل الملف الشخصي', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72761, 'sa', 'Change Photo', 'غير الصوره', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72762, 'sa', 'No Ordres for this customer', 'لا توجد أوامر لهذا العميل', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72763, 'sa', 'MAILCHIMP', 'ميل تشيمب', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72764, 'sa', 'Saved successfully', 'حفظ بنجاح', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72765, 'sa', 'Send Mail', 'ارسل بريد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72766, 'sa', 'Content', 'المحتوى', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72767, 'sa', 'Details', 'تفاصيل', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72768, 'sa', 'Mail View1', 'عرض البريد 1', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72769, 'sa', 'Text Btn Link', 'نص رابط Btn', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72770, 'sa', 'Mail Driver', 'سائق البريد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72771, 'sa', 'sent succesfully', 'أرسل بنجاح', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72772, 'sa', 'sent error', 'تم الإرسال خطأ', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72773, 'sa', 'sent error please check user email or provider not correct', 'تم الإرسال خطأ ، يرجى التحقق من البريد الإلكتروني للمستخدم أو المزود غير صحيح', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72774, 'sa', 'please check mail or driver', 'يرجى التحقق من البريد أو السائق', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72775, 'sa', 'An email has been sent.', 'تم ارسال البريد الإلكتروني.', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72776, 'sa', 'SMS Settings', 'إعدادات الرسائل القصيرة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72777, 'sa', 'Provide Fekra', 'تقديم فكرة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72778, 'sa', 'Sender Name', 'اسم المرسل', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72779, 'sa', 'User Name', 'اسم االمستخدم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72780, 'sa', 'User Password', 'كلمة مرور المستخدم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72781, 'sa', 'Sms Provider', 'مزود الرسائل القصيرة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72782, 'sa', 'SMS Fekra', 'فكرة SMS', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72783, 'sa', 'Send SMS', 'أرسل رسالة نصية قصيرة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72784, 'sa', 'Count', 'عدد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72785, 'sa', 'Parts', 'القطع', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72786, 'sa', 'Enter Count', 'أدخل عدد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72787, 'sa', 'sent error. please check user phone or provider not correct', 'تم الإرسال خطأ. يرجى التحقق من أن هاتف المستخدم أو مزود الخدمة غير صحيح', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72788, 'sa', 'Role Information', 'معلومات الدور', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72789, 'sa', 'Permissions', 'أذونات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72790, 'sa', 'the Customer var_user Add New Product In Baskets a Price 72 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعر 72 شاملاً الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72791, 'sa', 'the Customer var_user Add New Product In Baskets a Price 86 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعر 86 شامل الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72792, 'sa', 'the Customer var_user Add New Product In Baskets a Price 246 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعر 246 شاملاً الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72793, 'sa', 'the Customer var_user Add New Product In Baskets a Price 240 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعر 240 شاملاً الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72794, 'sa', 'the Customer var_user Add New Product In Baskets a Price 123 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون إضافة منتج جديد في سلال سعر 123 شامل الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72795, 'sa', 'New Special Offer', 'عرض خاص جديد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72796, 'sa', 'If you buy a number_var_x of product_var_x, you get a number_var_y of product_var_y', 'إذا اشتريت number_var_x من product_var_x ، فستحصل على number_var_y من product_var_y', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72797, 'sa', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum amount of purchases is var_price', 'إذا اشتريت من أحد هذه var_type ، فستحصل على var_discount ، بشرط أن يكون الحد الأدنى للمشتريات هو var_price', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72798, 'sa', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum quantity of products is var_count', 'إذا اشتريت من أحد هذه var_type ، فستحصل على var_discount ، بشرط أن يكون الحد الأدنى لكمية المنتجات هو var_count', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72799, 'sa', 'If you buy one of these products, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price', 'إذا اشتريت أحد هذه المنتجات ، فستحصل على خصم var_discount_perceent شريطة ألا يتجاوز الحد الأقصى للخصم var_max_price_discount وأن الحد الأدنى لمبلغ الشراء هو var_price', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72800, 'sa', 'If you buy one of these products, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimumquantity of products is var_count', 'إذا اشتريت أحد هذه المنتجات ، فستحصل على خصم var_discount_perceent شريطة ألا يتجاوز الحد الأقصى للخصم var_max_price_discount وأن الحد الأدنى لكمية المنتجات هو var_count', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72803, 'sa', 'All products in Cart', 'جميع المنتجات في عربة التسوق', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72804, 'sa', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum quantity of products is var_count', 'لو انت اشتريت واحده من var_type سوف تحصل علي خصم var_discount_perceent بشرط ألا يتجاوز الحد الأقصى للخصم\r\n و الحد الادني لكمية المنتجات var_count', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72805, 'sa', 'the Customer var_user Add New Product In Baskets a Price 480 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعر 480 شاملاً الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72806, 'sa', 'the Customer var_user Add New Product In Baskets a Price 222 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون إضافة منتج جديد في سلال سعر 222 شامل الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72807, 'sa', 'the Customer var_user Add New Product In Baskets a Price 77 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال بسعر 77 شاملاً الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72808, 'sa', 'the Customer var_user Add New Product In Baskets a Price 113 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعر 113 شامل الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72809, 'sa', 'the Customer var_user Add New Product In Baskets a Price 116 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعر 116 شاملاً الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72810, 'sa', 'the Customer var_user Add New Product In Baskets a Price 74 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون إضافة منتج جديد في سلال السعر 74 شامل الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72811, 'sa', 'the Customer var_user Add New Product In Baskets a Price 97 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعر 97 شاملاً الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72812, 'sa', 'the Customer var_user Add New Product In Baskets a Price 93 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعرًا 93 شاملاً الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72813, 'sa', 'the Customer var_user Add New Product In Baskets a Price 104 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعر 104 شاملاً الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72814, 'sa', 'All cities', 'كل المدن', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72815, 'sa', 'Cities', 'مدن', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72816, 'sa', 'Add New city', 'أضف مدينة جديدة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72817, 'sa', 'All Attributes', 'كل السمات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72818, 'sa', 'Add New Attribute', 'أضف سمة جديدة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72819, 'sa', 'Commission History report', 'تقرير تاريخ اللجنة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72820, 'sa', 'Choose Seller', 'اختر البائع', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72821, 'sa', 'Admin Commission', 'لجنة الإدارة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72822, 'sa', 'Seller Earning', 'أرباح البائع', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72823, 'sa', 'Add New Post', 'أضف منشور جديد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72824, 'sa', 'All blog posts', 'جميع مشاركات المدونة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72825, 'sa', 'Short Description', 'وصف قصير', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72826, 'sa', 'Change blog status successfully', 'تغيير حالة المدونة بنجاح', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72827, 'sa', 'All Blog Categories', 'جميع فئات المدونة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72828, 'sa', 'Blog Categories', 'فئات المدونة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72829, 'sa', 'Support Desk', 'مكتب الدعم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72830, 'sa', 'Type ticket code & Enter', 'اكتب رمز التذكرة وأدخل', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72831, 'sa', 'User', 'المستعمل', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72832, 'sa', 'Last reply', 'الرد الأخير', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72833, 'sa', 'All Taxes', 'جميع الضرائب', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72834, 'sa', 'Add New Tax', 'أضف ضريبة جديدة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72835, 'sa', 'Tax Type', 'نوع الضريبة', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72836, 'sa', 'Tax Name', 'الاسم الضريبي', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72837, 'sa', 'Tax status updated successfully', 'تم تحديث الحالة الضريبية بنجاح', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72838, 'sa', 'No Manager', 'لا يوجد مدير', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72839, 'sa', 'At the very bottom, you can find the “Facebook Page ID”', 'في الجزء السفلي ، يمكنك العثور على \"معرف صفحة Facebook\"', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72840, 'sa', 'Go to Settings of your page and find the option of \"Advance Messaging\"', 'انتقل إلى إعدادات صفحتك وابحث عن خيار \"المراسلة المتقدمة\"', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72841, 'sa', 'Scroll down that page and you will get \"white listed domain\"', 'قم بالتمرير لأسفل تلك الصفحة وستحصل على \"نطاق مدرج في القائمة البيضاء\"', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72842, 'sa', 'Facebook Comment Setting', 'إعداد تعليق Facebook', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72843, 'sa', 'Facebook App ID', 'معرف تطبيق Facebook', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72844, 'sa', 'Please be carefull when you are configuring Facebook Comment. For incorrect configuration you will not get comment section on your user-end site.', 'يرجى توخي الحذر عند تكوين Facebook Comment. للتكوين غير الصحيح ، لن تحصل على قسم التعليقات على موقع المستخدم الخاص بك.', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72845, 'sa', 'After then go to this URL https://developers.facebook.com/apps/', 'بعد ذلك ، انتقل إلى عنوان URL هذا https://developers.facebook.com/apps/', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72846, 'sa', 'Create Your App', 'أنشئ تطبيقك', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72847, 'sa', 'In Dashboard page you will get your App ID', 'في صفحة لوحة المعلومات ، ستحصل على معرف التطبيق الخاص بك', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72848, 'sa', 'Area Wise Flat Shipping Cost', 'تكلفة الشحن المتغيره للمنطقة', '2021-07-25 17:30:28', '2021-09-26 13:34:48'),
(72849, 'sa', 'Seller Wise Flat Shipping Cost calulation: Fixed rate for each seller. If customers purchase 2 product from two seller shipping cost is calculated by addition of each seller flat shipping cost', 'حساب لتكلفة الشحن المتغيرة للبائع: سعر ثابت لكل بائع. إذا قام العميل بشراء منتجين من باعئين  ، يتم حسابها بإضافة تكلفة الشحن الثابتة لكل بائع', '2021-07-25 17:30:28', '2021-09-26 13:34:48'),
(72850, 'sa', 'Area Wise Flat Shipping Cost calulation: Fixed rate for each area. If customers purchase multiple products from one seller shipping cost is calculated by the customer shipping area. To configure area wise shipping cost go to ', 'حساب تكلفة الشحن الثابتة حسب المنطقة: معدل ثابت لكل منطقة. إذا قام العملاء بشراء منتجات متعددة من بائع واحد ، يتم حساب تكلفة الشحن من خلال منطقة شحن العميل. لتكوين تكلفة الشحن حسب المنطقة ، انتقل إلى', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72851, 'sa', '1. Flat rate shipping cost is applicable if Flat rate shipping is enabled.', '1. يتم تطبيق تكلفة الشحن ذات السعر الثابت إذا تم تمكين الشحن بسعر موحد.', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72852, 'sa', '1. Shipping cost for admin is applicable if Seller wise shipping cost is enabled.', '1. تسري تكلفة الشحن للمشرف إذا تم تمكين تكلفة الشحن الخاصة بالبائع.', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72853, 'sa', 'Update your system', 'قم بتحديث نظامك', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72854, 'sa', 'Current verion', 'الإصدار الحالي', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72855, 'sa', 'Make sure your server has matched with all requirements.', 'تأكد من تطابق الخادم الخاص بك مع جميع المتطلبات.', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72856, 'sa', 'Check Here', 'تحقق هنا', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72857, 'sa', 'Download latest version from codecanyon.', 'قم بتنزيل أحدث إصدار من برنامج codecanyon.', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72858, 'sa', 'Extract downloaded zip. You will find updates.zip file in those extraced files.', 'استخراج ملف zip الذي تم تنزيله. ستجد ملف updates.zip في تلك الملفات الخارجية.', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72859, 'sa', 'Upload that zip file here and click update now.', 'قم بتحميل هذا الملف المضغوط هنا وانقر فوق تحديث الآن.', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72860, 'sa', 'If you are using any addon make sure to update those addons after updating.', 'إذا كنت تستخدم أي أداة إضافية ، فتأكد من تحديث هذه الوظائف الإضافية بعد التحديث.', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72861, 'sa', 'Server information', 'معلومات الخادم', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72862, 'sa', 'Current Version', 'النسخة الحالية', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72863, 'sa', 'Required Version', 'الإصدار المطلوب', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72864, 'sa', 'php.ini Config', 'تكوين php.ini', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72865, 'sa', 'Config Name', 'اسم التكوين', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72866, 'sa', 'Current', 'حاضر', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72867, 'sa', 'Recommended', 'مستحسن', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72868, 'sa', 'Extensions information', 'معلومات الإضافات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72869, 'sa', 'Extension Name', 'اسم الامتداد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72870, 'sa', 'Filesystem Permissions', 'أذونات نظام الملفات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72871, 'sa', 'File or Folder', 'ملف أو مجلد', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72872, 'sa', 'Email already used', 'البريد الإلكتروني مستخدم بالفعل', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72873, 'sa', 'Staff has been inserted successfully', 'تم إدراج الموظفين بنجاح', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72874, 'sa', 'of', 'من', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72875, 'sa', 'Total pendding sellers', 'مجموع البائعين المعلقين', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72876, 'sa', 'Select Payment Option.', 'حدد خيار الدفع.', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72877, 'sa', 'Number of sales products', 'عدد منتجات البيع', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72878, 'sa', 'Number of stock products', 'عدد منتجات المخزون', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72879, 'sa', 'Quantity Product', 'كمية المنتج', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72880, 'sa', 'product_id', 'معرف المنتج', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72881, 'sa', 'product_name', 'اسم المنتج', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72882, 'sa', 'product_price', 'سعر المنتج', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72883, 'sa', 'product_quantity', 'كمية المنتج', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72884, 'sa', 'Product Stock', 'مخزون المنتج', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72885, 'sa', 'the Customer var_user Add New Product In Baskets a Price 340 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون إضافة منتج جديد في سلال السعر 340 شامل الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72886, 'sa', 'the Customer var_user Add New Product In Baskets a Price 415 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعر 415 شامل الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72887, 'sa', 'the Customer var_user Add New Product In Baskets a Price 919 Inclusive of Tax and Shipping sssssssssss', 'var_user الزبون يضيف منتجًا جديدًا في سلال سعر 919 شاملاً الضرائب والشحن sssssssssss', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72888, 'sa', 'AVG Bascktes', 'AVG Bascktes', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72889, 'sa', 'Choose Branch Report', 'اختر تقرير الفرع', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72890, 'sa', 'Sales Products', 'منتجات المبيعات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72891, 'sa', 'Sales Brands', 'ماركات المبيعات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72892, 'sa', 'Sales Categories', 'فئات المبيعات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72893, 'sa', 'Sales Coupons', 'كوبونات المبيعات', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72894, 'sa', 'Product Quantity', 'كمية المنتج', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72895, 'sa', 'Date Add In Baskets', 'أضف التاريخ في سلال', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72896, 'sa', 'Basket Product Price', 'سعر سلة المنتج', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72897, 'sa', 'Number Product Sales', 'رقم مبيعات المنتج', '2021-07-25 17:30:28', '2021-07-25 17:30:28'),
(72898, 'sa', 'Product Sales Total Prices', 'إجمالي أسعار مبيعات المنتج', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72899, 'sa', 'Total Coupons Discount Amount', 'إجمالي مبلغ خصم القسائم', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72900, 'sa', 'Total Coupons Discount Percent', 'إجمالي نسبة خصم القسائم', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72901, 'sa', 'Total Coupons Usages', 'إجمالي استخدامات القسائم', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72902, 'sa', 'Coupons Number Usage', 'استخدام عدد القسائم', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72903, 'sa', 'slightly satisfied', 'راضٍ قليلاً', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72904, 'sa', 'fully satisfied', 'راض تماما', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72905, 'sa', 'angry', 'غاضب', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72906, 'sa', 'not satisfied', 'غير راضية', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72907, 'sa', 'satisfied', 'راضي', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72908, 'sa', 'customer purches', 'مشتريات العملاء', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72909, 'sa', 'customer not purches', 'الزبون لا يفرش', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72910, 'sa', 'highest paying customers', 'العملاء الأعلى ربحًا', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72911, 'sa', 'Customer Sales', 'مبيعات العملاء', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72912, 'sa', 'Customer Review', 'رأي العميل', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72913, 'sa', 'sunday', 'يوم الأحد', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72914, 'sa', 'monday', 'الاثنين', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72915, 'sa', 'tuesday', 'يوم الثلاثاء', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72916, 'sa', 'wedinsday', 'الأربعاء', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72917, 'sa', 'thursday', 'يوم الخميس', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72918, 'sa', 'friday', 'يوم الجمعة', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72919, 'sa', 'saterday', 'السبت', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72920, 'sa', 'Wednesday', 'الأربعاء', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72921, 'sa', 'Most Wanted Days', 'أكثر الأيام المطلوبة', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72922, 'sa', 'Most Orders Customers', 'معظم طلبات العملاء', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72923, 'sa', 'Number Order Sales', 'رقم طلب المبيعات', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72924, 'sa', 'search id', 'معرف البحث', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72925, 'sa', 'search seller name', 'ابحث عن اسم البائع', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72926, 'sa', 'search customer name', 'البحث عن اسم العميل', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72927, 'sa', 'search grand total', 'البحث في المجموع الكلي', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72928, 'sa', 'search order code', 'البحث عن رمز الطلب', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72929, 'sa', 'Search Data', 'بيانات البحث', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72930, 'sa', 'search Balance', 'البحث عن الرصيد', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72931, 'sa', 'search email', 'ابحث عن البريد الألكتروني', '2021-07-25 17:30:29', '2021-07-25 17:30:29'),
(72947, 'en', 'Blog Information', 'Blog Information', '2021-07-26 16:05:37', '2021-07-26 16:05:37'),
(72948, 'en', 'Blog Information', 'Blog Information', '2021-07-26 16:05:37', '2021-07-26 16:05:37'),
(72949, 'en', 'Blog Title', 'Blog Title', '2021-07-26 16:05:37', '2021-07-26 16:05:37'),
(72950, 'en', 'Meta Keywords', 'Meta Keywords', '2021-07-26 16:05:37', '2021-07-26 16:05:37'),
(72951, 'en', 'Meta Keywords', 'Meta Keywords', '2021-07-26 16:05:37', '2021-07-26 16:05:37'),
(72952, 'en', 'Google Login Credential', 'Google Login Credential', '2021-07-26 16:45:21', '2021-07-26 16:45:21'),
(72953, 'en', 'Google Login Credential', 'Google Login Credential', '2021-07-26 16:45:21', '2021-07-26 16:45:21'),
(72954, 'en', 'Client ID', 'Client ID', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72955, 'en', 'Google Client ID', 'Google Client ID', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72956, 'en', 'Google Client ID', 'Google Client ID', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72957, 'en', 'Client Secret', 'Client Secret', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72958, 'en', 'Client Secret', 'Client Secret', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72959, 'en', 'Google Client Secret', 'Google Client Secret', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72960, 'en', 'Google Client Secret', 'Google Client Secret', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72961, 'en', 'Facebook Login Credential', 'Facebook Login Credential', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72962, 'en', 'Facebook Client ID', 'Facebook Client ID', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72963, 'en', 'Facebook Client ID', 'Facebook Client ID', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72964, 'en', 'App Secret', 'App Secret', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72965, 'en', 'Facebook Client Secret', 'Facebook Client Secret', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72966, 'en', 'Twitter Login Credential', 'Twitter Login Credential', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72967, 'en', 'Twitter Login Credential', 'Twitter Login Credential', '2021-07-26 16:45:22', '2021-07-26 16:45:22'),
(72968, 'en', 'Twitter Client ID', 'Twitter Client ID', '2021-07-26 16:45:23', '2021-07-26 16:45:23'),
(72969, 'en', 'Twitter Client Secret', 'Twitter Client Secret', '2021-07-26 16:45:23', '2021-07-26 16:45:23'),
(72970, 'en', 'Twitter Client Secret', 'Twitter Client Secret', '2021-07-26 16:45:23', '2021-07-26 16:45:23'),
(72971, 'en', 'User Phone', 'User Phone', '2021-07-27 05:16:11', '2021-07-27 05:16:11'),
(72972, 'en', 'User Email', 'User Email', '2021-07-27 05:16:11', '2021-07-27 05:16:11'),
(72973, 'en', 'Admin', 'Admin', '2021-07-27 05:18:17', '2021-07-27 05:18:17'),
(72974, 'en', 'Checked All', 'Checked All', '2021-07-27 09:01:43', '2021-07-27 09:01:43'),
(72975, 'en', 'Choose', 'Choose', '2021-07-27 10:00:52', '2021-07-27 10:00:52'),
(72976, 'en', 'choose var_number user', 'choose var_number user', '2021-07-27 10:07:33', '2021-07-27 10:07:33'),
(72977, 'en', 'Send Mails', 'Send Mails', '2021-07-27 11:08:23', '2021-07-27 11:08:23'),
(72978, 'en', 'sent error. please check user email or provider not correct', 'sent error. please check user email or provider not correct', '2021-07-27 12:37:32', '2021-07-27 12:37:32'),
(72979, 'en', 'Queue', 'Queue', '2021-07-28 15:59:55', '2021-07-28 15:59:55'),
(72980, 'en', 'Sent Succesfully Queue Mails', 'Sent Succesfully Queue Mails', '2021-07-28 16:18:34', '2021-07-28 16:18:34'),
(72986, 'sa', 'Blog Information', 'معلومات عن البلوج', '2021-07-29 07:15:48', '2021-07-29 07:15:48'),
(72987, 'sa', 'Blog Title', 'عنوان البلوج', '2021-07-29 07:15:48', '2021-07-29 07:15:48'),
(72988, 'sa', 'Meta Keywords', 'كلمات مفتاحيه', '2021-07-29 07:15:48', '2021-07-29 07:15:48'),
(72989, 'sa', 'Google Login Credential', 'التسجيل عن طريق جوجل', '2021-07-29 07:15:48', '2021-07-29 07:15:48'),
(72990, 'sa', 'Client ID', 'معرف العميل', '2021-07-29 07:15:48', '2021-07-29 07:15:48'),
(72991, 'sa', 'Google Client ID', 'العميل', '2021-07-29 07:15:48', '2021-07-29 07:15:48'),
(72992, 'sa', 'Client Secret', 'المعرف السري للعميل', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(72993, 'sa', 'Google Client Secret', 'المعرف السري للعميل جوجل', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(72994, 'sa', 'Facebook Login Credential', 'التسجيل عن طريق فيسبوك', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(72995, 'sa', 'Facebook Client ID', 'المعرف للعميل فيسبوك', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(72996, 'sa', 'App Secret', 'اكلمة سر التطبيق', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(72997, 'sa', 'Facebook Client Secret', 'المعرف السري للعميل فيسبوك', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(72998, 'sa', 'Twitter Login Credential', 'التسجيل عن طريق تويتر', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(72999, 'sa', 'Twitter Client ID', 'المعرف للعميل تويتر', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73000, 'sa', 'Twitter Client Secret', 'المعرف السري للعميل تويتر', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73001, 'sa', 'User Phone', 'رقم هاتف المستخدم', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73002, 'sa', 'User Email', 'البريد الالكتروني للمستخدم', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73003, 'sa', 'Admin', 'الادمن', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73004, 'sa', 'Checked All', 'اختيار الكل', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73005, 'sa', 'Choose', 'اختيار', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73006, 'sa', 'choose var_number user', 'اختيار var_number المستخدم', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73007, 'sa', 'Send Mails', 'ارسال الايملات', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73008, 'sa', 'sent error. please check user email or provider not correct', 'هناك خطأ في الارسال من فضلك تحقق من البروفايدر او الايميل', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73009, 'sa', 'Queue', 'queue', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73010, 'sa', 'Sent Succesfully Queue Mails', 'تم ارسال queue بنجاح', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73011, 'en', 'Translations updated for ', 'Translations updated for ', '2021-07-29 07:15:49', '2021-07-29 07:15:49'),
(73026, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 340 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 340 شامل الضريبه والشحن', '2021-07-29 07:44:11', '2021-07-29 07:44:11'),
(73027, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 415 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 415 شامل الضريبه والشحن', '2021-07-29 07:44:11', '2021-07-29 07:44:11'),
(73028, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 919 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 919 شامل الضريبه والشحن', '2021-07-29 07:44:11', '2021-07-29 07:44:11'),
(73029, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 246 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 246 شامل الضريبه والشحن', '2021-07-29 07:44:11', '2021-07-29 07:44:11'),
(73030, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 123 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 123 شامل الضريبه والشحن', '2021-07-29 07:44:11', '2021-07-29 07:44:11'),
(73031, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 97 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 97 شامل الضريبه والشحن', '2021-07-29 07:44:11', '2021-07-29 07:44:11'),
(73032, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 104 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 104 شامل الضريبه والشحن', '2021-07-29 07:44:11', '2021-07-29 07:44:11'),
(73033, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 74 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 74 شامل الضريبه والشحن', '2021-07-29 07:44:12', '2021-07-29 07:44:12'),
(73034, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 113 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 113 شامل الضريبه والشحن', '2021-07-29 07:44:15', '2021-07-29 07:44:15'),
(73035, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 116 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 116 شامل الضريبه والشحن', '2021-07-29 07:44:15', '2021-07-29 07:44:15'),
(73036, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 222 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 222 شامل الضريبه والشحن', '2021-07-29 07:44:16', '2021-07-29 07:44:16'),
(73037, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 480 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 480 شامل الضريبه والشحن', '2021-07-29 07:44:16', '2021-07-29 07:44:16'),
(73038, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 240 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 240 شامل الضريبه والشحن', '2021-07-29 07:44:17', '2021-07-29 07:44:17'),
(73039, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 86 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 86 شامل الضريبه والشحن', '2021-07-29 07:44:17', '2021-07-29 07:44:17'),
(73040, 'en', 'search Price', 'search Price', '2021-07-29 08:27:53', '2021-07-29 08:27:53'),
(73041, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 155 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 155 شامل الضريبه والشحن', '2021-08-04 09:29:07', '2021-08-04 09:29:07'),
(73042, 'en', 'the Customer var_user Add New Product In Baskets a Price 155 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 155 Inclusive of Tax and Shipping sssssssssss', '2021-08-04 10:06:39', '2021-08-04 10:06:39'),
(73043, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 310 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 310 شامل الضريبه والشحن', '2021-08-04 11:28:48', '2021-08-04 11:28:48'),
(73044, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 465 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 465 شامل الضريبه والشحن', '2021-08-04 11:33:11', '2021-08-04 11:33:11'),
(73045, 'en', 'the Customer var_user Add New Product In Baskets a Price 465 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 465 Inclusive of Tax and Shipping sssssssssss', '2021-08-04 11:46:24', '2021-08-04 11:46:24'),
(73046, 'en', 'the Customer var_user Add New Product In Baskets a Price 310 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 310 Inclusive of Tax and Shipping sssssssssss', '2021-08-04 11:46:24', '2021-08-04 11:46:24'),
(73047, 'en', 'Custom Script Admin', 'Custom Script Admin', '2021-08-04 12:24:35', '2021-08-04 12:24:35'),
(73048, 'en', 'Header custom script admin - before </head>', 'Header custom script admin - before </head>', '2021-08-04 12:24:35', '2021-08-04 12:24:35'),
(73049, 'en', 'Write script admin with <script> tag', 'Write script admin with <script> tag', '2021-08-04 12:24:35', '2021-08-04 12:24:35'),
(73050, 'en', 'Footer custom script admin - before </body>', 'Footer custom script admin - before </body>', '2021-08-04 12:24:35', '2021-08-04 12:24:35'),
(73051, 'sa', 'Custom Script Admin', 'برنامج نصي مخصص للادمن بانل', '2021-08-04 12:32:07', '2021-08-04 12:32:07'),
(73052, 'sa', 'Header custom script admin - before </head>', NULL, '2021-08-04 12:32:07', '2021-08-04 12:32:07'),
(73053, 'sa', 'Footer custom script admin - before </body>', NULL, '2021-08-04 12:32:07', '2021-08-04 12:32:07'),
(73054, 'en', 'Date From', 'Date From', '2021-08-04 19:14:31', '2021-08-04 19:14:31'),
(73055, 'en', 'Date To', 'Date To', '2021-08-04 19:14:31', '2021-08-04 19:14:31'),
(73056, 'en', 'Users Type', 'Users Type', '2021-08-04 19:16:44', '2021-08-04 19:16:44'),
(73057, 'sa', 'Date From', 'التاريخ من', '2021-08-04 19:17:39', '2021-08-04 19:17:39'),
(73058, 'sa', 'Date To', 'التاريخ الي', '2021-08-04 19:17:39', '2021-08-04 19:17:39'),
(73059, 'sa', 'Users Type', 'نوع المستخدمين', '2021-08-04 19:17:39', '2021-08-04 19:17:39'),
(73060, 'en', 'Product Unavailable', 'Product Unavailable', '2021-08-05 08:46:42', '2021-08-05 08:46:42'),
(73061, 'en', 'search Phone', 'search Phone', '2021-08-09 14:24:11', '2021-08-09 14:24:11'),
(73062, 'en', 'Are you sure?', 'Are you sure?', '2021-08-09 14:24:11', '2021-08-09 14:24:11'),
(73063, 'en', 'Once deleted, you will not be able to recover this imaginary data!', 'Once deleted, you will not be able to recover this imaginary data!', '2021-08-09 14:24:11', '2021-08-09 14:24:11'),
(73064, 'en', 'Your imaginary data is safe!', 'Your imaginary data is safe!', '2021-08-09 14:24:11', '2021-08-09 14:24:11'),
(73065, 'en', 'ban', 'ban', '2021-08-09 14:24:11', '2021-08-09 14:24:11'),
(73066, 'en', 'unban', 'unban', '2021-08-09 14:24:11', '2021-08-09 14:24:11'),
(73067, 'en', 'Do you really want to ban it?', 'Do you really want to ban it?', '2021-08-09 14:24:11', '2021-08-09 14:24:11'),
(73068, 'en', 'Do you really want to unblock it?', 'Do you really want to unblock it?', '2021-08-09 14:24:11', '2021-08-09 14:24:11'),
(73069, 'en', 'unblock', 'unblock', '2021-08-09 14:24:11', '2021-08-09 14:24:11'),
(73070, 'en', 'Abandoned basket reminders', 'Abandoned basket reminders', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73071, 'en', 'Create a new reminder', 'Create a new reminder', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73072, 'en', 'number of products', 'number of products', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73073, 'en', 'calc baskets', 'calc baskets', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73074, 'en', 'active temporary discount', 'active temporary discount', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73075, 'en', 'sms', 'sms', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73076, 'en', 'special users', 'special users', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73077, 'en', 'all users', 'all users', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73078, 'en', 'date send reminder', 'date send reminder', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73079, 'en', 'channel', 'channel', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73080, 'en', 'public', 'public', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73081, 'en', 'not found reminders', 'not found reminders', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73082, 'en', 'email and sms', 'email and sms', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73083, 'en', 'please choose users', 'please choose users', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73084, 'en', 'error msg', 'error msg', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73085, 'en', 'ok', 'ok', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73086, 'en', 'successfully saved data', 'successfully saved data', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73087, 'en', 'Temporary discount with reminder', 'Temporary discount with reminder', '2021-08-09 14:24:24', '2021-08-09 14:24:24');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(73088, 'en', 'Temporary discount with reminder', 'Temporary discount with reminder', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73089, 'en', 'shipping free', 'shipping free', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73090, 'en', 'shipping free', 'shipping free', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73091, 'en', 'discount basket', 'discount basket', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73092, 'en', 'discount basket', 'discount basket', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73093, 'en', 'grant the customer discount and define discount type is amount or percent from purches', 'grant the customer discount and define discount type is amount or percent from purches', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73094, 'en', 'amount from purches', 'amount from purches', '2021-08-09 14:24:24', '2021-08-09 14:24:24'),
(73095, 'en', 'percent from purches', 'percent from purches', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73096, 'en', 'text msg', 'text msg', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73097, 'en', 'Choose send way and text msg', 'Choose send way and text msg', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73098, 'en', 'msg sms', 'msg sms', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73099, 'en', 'title email', 'title email', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73100, 'en', 'hello {var_name} We would like to offer you a special discount {var_discount_amount} on the shopping cart But the discount ends on {var_date}, don\'t miss it!', 'hello {var_name} We would like to offer you a special discount {var_discount_amount} on the shopping cart But the discount ends on {var_date}, don\'t miss it!', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73101, 'en', 'total discount', 'total discount', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73102, 'en', 'discount expiry date', 'discount expiry date', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73103, 'en', 'send now', 'send now', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73104, 'en', 'specific time', 'specific time', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73105, 'en', 'date send offer', 'date send offer', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73106, 'en', 'expire date', 'expire date', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73107, 'en', 'the var_1 or var_2 is required', 'the var_1 or var_2 is required', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73108, 'en', 'Your basket is full of products, please complete the order', 'Your basket is full of products, please complete the order', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73109, 'en', 'The reminder will be sent after the customer has left the cart for a specified period and exceeded the cart for a certain value', 'The reminder will be sent after the customer has left the cart for a specified period and exceeded the cart for a certain value', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73110, 'en', 'The period of leaving the basket', 'The period of leaving the basket', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73111, 'en', 'Minimum total basket', 'Minimum total basket', '2021-08-09 14:24:25', '2021-08-09 14:24:25'),
(73112, 'en', 'Poof! Your imaginary data has been deleted!', 'Poof! Your imaginary data has been deleted!', '2021-08-09 14:29:56', '2021-08-09 14:29:56'),
(73113, 'en', 'What is the abandoned basket?', 'What is the abandoned basket?', '2021-08-09 14:31:02', '2021-08-09 14:31:02'),
(73114, 'en', 'It is the basket that the customer added the products to, then forgot and did not complete the purchase. And to motivate the customer to complete the order, you can activate a special temporary discount', 'It is the basket that the customer added the products to, then forgot and did not complete the purchase. And to motivate the customer to complete the order, you can activate a special temporary discount', '2021-08-09 14:31:02', '2021-08-09 14:31:02'),
(73115, 'sa', 'Product Unavailable', 'المنتج غير متاح', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73116, 'sa', 'search Phone', 'ابحث عن الهاتف', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73117, 'sa', 'Are you sure?', 'هل انت متأكد من الحذف ؟', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73118, 'sa', 'Once deleted, you will not be able to recover this imaginary data!', 'بمجرد الحذف ، لن تتمكن من استعادة هذه البيانات الوهمية!', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73119, 'sa', 'Your imaginary data is safe!', 'بياناتك الان امنه!', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73120, 'sa', 'ban', 'حظر', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73121, 'sa', 'unban', 'فك الحظر', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73122, 'sa', 'Do you really want to ban it?', 'هل انت بالفعل تريد الحظر', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73123, 'sa', 'Do you really want to unblock it?', 'هل انت بالفعل تريد فك الحظر', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73124, 'sa', 'unblock', 'فك الحظر', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73125, 'sa', 'Abandoned basket reminders', 'تذكيرات السلات المتروكه', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73126, 'sa', 'Create a new reminder', 'انشاء تذكير جديد', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73127, 'sa', 'number of products', 'عدد المنتجات', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73128, 'sa', 'calc baskets', 'مجموع السله', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73129, 'sa', 'active temporary discount', 'تفعيل الخصم المؤقت', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73130, 'sa', 'sms', 'sms', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73131, 'sa', 'special users', 'مستخدمين خاصين', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73132, 'sa', 'all users', 'جميع المستخدمين', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73133, 'sa', 'date send reminder', 'تاريخ ارسال التذكير', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73134, 'sa', 'channel', 'قناة الارسال', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73135, 'sa', 'public', 'العامه', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73136, 'sa', 'not found reminders', 'لا يوجد تذكيرات', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73137, 'sa', 'email and sms', 'بريد الكتروني او sms', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73138, 'sa', 'please choose users', 'من فضلك اختار المستخدمين', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73139, 'sa', 'error msg', 'هناك خطأ', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73140, 'sa', 'ok', 'حسنا !', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73141, 'sa', 'successfully saved data', 'تم حفظ البيانات', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73142, 'sa', 'Temporary discount with reminder', 'خصم مؤقت مع التذكير', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73143, 'sa', 'shipping free', 'الشحن المجاني', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73144, 'sa', 'discount basket', 'خصم السلة', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73145, 'sa', 'grant the customer discount and define discount type is amount or percent from purches', 'منح العميل خصمًا وتحديد نوع الخصم هو المبلغ أو النسبة المئوية من المشتريات', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73146, 'sa', 'amount from purches', 'مبلغ من المشتريات', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73147, 'sa', 'percent from purches', 'نسبة من المشتريات', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73148, 'sa', 'text msg', 'نص الرساله', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73149, 'sa', 'Choose send way and text msg', 'اختر طريقة الإرسال ورسالة نصية', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73150, 'sa', 'msg sms', 'الرسائل القصيرة SMS', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73151, 'sa', 'title email', 'عنوان البريد الالكتروني', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73152, 'sa', 'hello {var_name} We would like to offer you a special discount {var_discount_amount} on the shopping cart But the discount ends on {var_date}, don\'t miss it!', 'مرحبًا {var_name} نود أن نقدم لك خصمًا خاصًا {var_discount_amount} على عربة التسوق ولكن الخصم ينتهي في {var_date} ، لا تفوت الفرصة!', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73153, 'sa', 'total discount', 'اجمالي الخصم', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73154, 'sa', 'discount expiry date', 'تاريخ انتهاء الخصم', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73155, 'sa', 'send now', 'ارسل الان', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73156, 'sa', 'specific time', 'تحديدت الوقت', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73157, 'sa', 'date send offer', 'تاريخ ارسال عرض الخصن', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73158, 'sa', 'expire date', 'تاريخ الانتهاء', '2021-08-09 14:44:25', '2021-08-09 14:44:25'),
(73159, 'sa', 'the var_1 or var_2 is required', 'مطلوب var_1 أو var_2', '2021-08-09 14:46:10', '2021-08-09 14:46:10'),
(73160, 'sa', 'Your basket is full of products, please complete the order', 'سلتك مليئة بالمنتجات ، يرجى إكمال الطلب', '2021-08-09 14:46:10', '2021-08-09 14:46:10'),
(73161, 'sa', 'The reminder will be sent after the customer has left the cart for a specified period and exceeded the cart for a certain value', 'سيتم إرسال التذكير بعد مغادرة العميل للعربة لفترة محددة وتجاوزها لقيمة معينة', '2021-08-09 14:46:10', '2021-08-09 14:46:10'),
(73162, 'sa', 'The period of leaving the basket', 'مدة ترك السلة', '2021-08-09 14:46:10', '2021-08-09 14:46:10'),
(73163, 'sa', 'Minimum total basket', 'الحد الأدنى لإجمالي السلة', '2021-08-09 14:46:10', '2021-08-09 14:46:10'),
(73164, 'sa', 'Poof! Your imaginary data has been deleted!', 'تم حذف بياناتك بنجاح!', '2021-08-09 14:46:10', '2021-08-09 14:46:10'),
(73165, 'sa', 'What is the abandoned basket?', 'ما هي السلة المهجورة؟', '2021-08-09 14:46:10', '2021-08-09 14:46:10'),
(73166, 'sa', 'It is the basket that the customer added the products to, then forgot and did not complete the purchase. And to motivate the customer to complete the order, you can activate a special temporary discount', 'هي السلة التي أضاف إليها العميل المنتجات ثم نسيها ولم يكمل عملية الشراء. ولتحفيز العميل لإتمام الطلب يمكنك تفعيل خصم خاص مؤقت', '2021-08-09 14:46:10', '2021-08-09 14:46:10'),
(73167, 'en', 'the Customer var_user Add New Product In Baskets a Price 90 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 90 Inclusive of Tax and Shipping sssssssssss', '2021-08-10 04:50:19', '2021-08-10 04:50:19'),
(73168, 'en', 'the Customer var_user Add New Product In Baskets a Price 45 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 45 Inclusive of Tax and Shipping sssssssssss', '2021-08-10 04:50:24', '2021-08-10 04:50:24'),
(73169, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 90 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 90 شامل الضريبه والشحن', '2021-08-10 04:51:33', '2021-08-10 04:51:33'),
(73170, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 45 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 45 شامل الضريبه والشحن', '2021-08-10 04:51:34', '2021-08-10 04:51:34'),
(73171, 'en', 'Flash Deal has been inserted successfully', 'Flash Deal has been inserted successfully', '2021-08-10 20:14:09', '2021-08-10 20:14:09'),
(73172, 'en', 'the Customer var_user Add New Product In Baskets a Price 529 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 529 Inclusive of Tax and Shipping sssssssssss', '2021-08-16 08:09:50', '2021-08-16 08:09:50'),
(73173, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 529 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 529 شامل الضريبه والشحن', '2021-08-16 08:10:04', '2021-08-16 08:10:04'),
(73174, 'en', 'Search result for ', 'Search result for ', '2021-08-18 03:32:31', '2021-08-18 03:32:31'),
(73175, 'en', 'the Customer var_user Add New Product In Baskets a Price 651 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 651 Inclusive of Tax and Shipping sssssssssss', '2021-08-18 14:36:23', '2021-08-18 14:36:23'),
(73176, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 651 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 651 شامل الضريبه والشحن', '2021-08-18 14:36:35', '2021-08-18 14:36:35'),
(73177, 'en', 'order created at', 'order created at', '2021-08-19 07:07:28', '2021-08-19 07:07:28'),
(73178, 'en', 'Nothing found', 'Nothing found', '2021-08-19 07:19:58', '2021-08-19 07:19:58'),
(73179, 'en', 'review this is order', 'review this is order', '2021-08-19 07:26:05', '2021-08-19 07:26:05'),
(73180, 'en', 'Delete', 'Delete', '2021-08-21 02:15:05', '2021-08-21 02:15:05'),
(73181, 'en', 'Albania', 'Albania', '2021-08-21 13:30:47', '2021-08-21 13:30:47'),
(73182, 'en', 'Algeria', 'Algeria', '2021-08-21 13:30:47', '2021-08-21 13:30:47'),
(73183, 'en', 'Andorra', 'Andorra', '2021-08-21 13:30:47', '2021-08-21 13:30:47'),
(73184, 'en', 'Angola', 'Angola', '2021-08-21 13:30:48', '2021-08-21 13:30:48'),
(73185, 'en', 'Argentina', 'Argentina', '2021-08-21 13:30:48', '2021-08-21 13:30:48'),
(73186, 'en', 'Armenia', 'Armenia', '2021-08-21 13:30:48', '2021-08-21 13:30:48'),
(73187, 'en', 'Aruba', 'Aruba', '2021-08-21 13:30:48', '2021-08-21 13:30:48'),
(73188, 'en', 'Australia', 'Australia', '2021-08-21 13:30:48', '2021-08-21 13:30:48'),
(73189, 'en', 'Austria', 'Austria', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73190, 'en', 'Azerbaijan', 'Azerbaijan', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73191, 'en', 'Bahrain', 'Bahrain', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73192, 'en', 'Bangladesh', 'Bangladesh', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73193, 'en', 'Belarus', 'Belarus', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73194, 'en', 'Belgium', 'Belgium', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73195, 'en', 'Belize', 'Belize', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73196, 'en', 'Benin', 'Benin', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73197, 'en', 'Bhutan', 'Bhutan', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73198, 'en', 'Bolivia', 'Bolivia', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73199, 'en', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73200, 'en', 'Botswana', 'Botswana', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73201, 'en', 'Brazil', 'Brazil', '2021-08-21 13:30:49', '2021-08-21 13:30:49'),
(73202, 'en', 'British Indian Ocean Territory', 'British Indian Ocean Territory', '2021-08-21 13:30:50', '2021-08-21 13:30:50'),
(73203, 'en', 'Brunei Darussalam', 'Brunei Darussalam', '2021-08-21 13:30:50', '2021-08-21 13:30:50'),
(73204, 'en', 'Bulgaria', 'Bulgaria', '2021-08-21 13:30:50', '2021-08-21 13:30:50'),
(73205, 'en', 'Burkina Faso', 'Burkina Faso', '2021-08-21 13:30:50', '2021-08-21 13:30:50'),
(73206, 'en', 'Burundi', 'Burundi', '2021-08-21 13:30:50', '2021-08-21 13:30:50'),
(73207, 'en', 'Cambodia', 'Cambodia', '2021-08-21 13:30:50', '2021-08-21 13:30:50'),
(73208, 'en', 'Cameroon', 'Cameroon', '2021-08-21 13:30:50', '2021-08-21 13:30:50'),
(73209, 'en', 'Canada', 'Canada', '2021-08-21 13:30:50', '2021-08-21 13:30:50'),
(73210, 'en', 'Cape Verde', 'Cape Verde', '2021-08-21 13:30:50', '2021-08-21 13:30:50'),
(73211, 'en', 'Central African Republic', 'Central African Republic', '2021-08-21 13:30:50', '2021-08-21 13:30:50'),
(73212, 'en', 'Chad', 'Chad', '2021-08-21 13:30:50', '2021-08-21 13:30:50'),
(73213, 'en', 'Chile', 'Chile', '2021-08-21 13:30:51', '2021-08-21 13:30:51'),
(73214, 'en', 'China', 'China', '2021-08-21 13:30:51', '2021-08-21 13:30:51'),
(73215, 'en', 'Hong Kong', 'Hong Kong', '2021-08-21 13:30:51', '2021-08-21 13:30:51'),
(73216, 'en', 'Macao', 'Macao', '2021-08-21 13:30:51', '2021-08-21 13:30:51'),
(73217, 'en', 'Christmas Island', 'Christmas Island', '2021-08-21 13:30:51', '2021-08-21 13:30:51'),
(73218, 'en', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', '2021-08-21 13:30:51', '2021-08-21 13:30:51'),
(73219, 'en', 'Colombia', 'Colombia', '2021-08-21 13:30:51', '2021-08-21 13:30:51'),
(73220, 'en', 'Comoros', 'Comoros', '2021-08-21 13:30:51', '2021-08-21 13:30:51'),
(73221, 'en', 'Cook Islands', 'Cook Islands', '2021-08-21 13:30:51', '2021-08-21 13:30:51'),
(73222, 'en', 'Costa Rica', 'Costa Rica', '2021-08-21 13:30:51', '2021-08-21 13:30:51'),
(73223, 'en', 'Croatia', 'Croatia', '2021-08-21 13:30:51', '2021-08-21 13:30:51'),
(73224, 'en', 'Cuba', 'Cuba', '2021-08-21 13:30:52', '2021-08-21 13:30:52'),
(73225, 'en', 'Cyprus', 'Cyprus', '2021-08-21 13:30:52', '2021-08-21 13:30:52'),
(73226, 'en', 'Czech Republic', 'Czech Republic', '2021-08-21 13:30:52', '2021-08-21 13:30:52'),
(73227, 'en', 'Denmark', 'Denmark', '2021-08-21 13:30:52', '2021-08-21 13:30:52'),
(73228, 'en', 'Djibouti', 'Djibouti', '2021-08-21 13:30:52', '2021-08-21 13:30:52'),
(73229, 'en', 'Ecuador', 'Ecuador', '2021-08-21 13:30:52', '2021-08-21 13:30:52'),
(73230, 'en', 'Egypt', 'Egypt', '2021-08-21 13:30:52', '2021-08-21 13:30:52'),
(73231, 'en', 'El Salvador', 'El Salvador', '2021-08-21 13:30:52', '2021-08-21 13:30:52'),
(73232, 'en', 'Equatorial Guinea', 'Equatorial Guinea', '2021-08-21 13:30:52', '2021-08-21 13:30:52'),
(73233, 'en', 'Eritrea', 'Eritrea', '2021-08-21 13:30:53', '2021-08-21 13:30:53'),
(73234, 'en', 'Estonia', 'Estonia', '2021-08-21 13:30:53', '2021-08-21 13:30:53'),
(73235, 'en', 'Ethiopia', 'Ethiopia', '2021-08-21 13:30:53', '2021-08-21 13:30:53'),
(73236, 'en', 'Faroe Islands', 'Faroe Islands', '2021-08-21 13:30:53', '2021-08-21 13:30:53'),
(73237, 'en', 'Fiji', 'Fiji', '2021-08-21 13:30:53', '2021-08-21 13:30:53'),
(73238, 'en', 'Finland', 'Finland', '2021-08-21 13:30:53', '2021-08-21 13:30:53'),
(73239, 'en', 'France', 'France', '2021-08-21 13:30:53', '2021-08-21 13:30:53'),
(73240, 'en', 'French Guiana', 'French Guiana', '2021-08-21 13:30:53', '2021-08-21 13:30:53'),
(73241, 'en', 'Gabon', 'Gabon', '2021-08-21 13:30:53', '2021-08-21 13:30:53'),
(73242, 'en', 'Gambia', 'Gambia', '2021-08-21 13:30:54', '2021-08-21 13:30:54'),
(73243, 'en', 'Georgia', 'Georgia', '2021-08-21 13:30:54', '2021-08-21 13:30:54'),
(73244, 'en', 'Germany', 'Germany', '2021-08-21 13:30:54', '2021-08-21 13:30:54'),
(73245, 'en', 'Ghana', 'Ghana', '2021-08-21 13:30:54', '2021-08-21 13:30:54'),
(73246, 'en', 'Gibraltar', 'Gibraltar', '2021-08-21 13:30:54', '2021-08-21 13:30:54'),
(73247, 'en', 'Greece', 'Greece', '2021-08-21 13:30:54', '2021-08-21 13:30:54'),
(73248, 'en', 'Greenland', 'Greenland', '2021-08-21 13:30:54', '2021-08-21 13:30:54'),
(73249, 'en', 'Guatemala', 'Guatemala', '2021-08-21 13:30:54', '2021-08-21 13:30:54'),
(73250, 'en', 'Guinea', 'Guinea', '2021-08-21 13:30:55', '2021-08-21 13:30:55'),
(73251, 'en', 'Guyana', 'Guyana', '2021-08-21 13:30:55', '2021-08-21 13:30:55'),
(73252, 'en', 'Haiti', 'Haiti', '2021-08-21 13:30:55', '2021-08-21 13:30:55'),
(73253, 'en', 'Honduras', 'Honduras', '2021-08-21 13:30:55', '2021-08-21 13:30:55'),
(73254, 'en', 'Hungary', 'Hungary', '2021-08-21 13:30:55', '2021-08-21 13:30:55'),
(73255, 'en', 'Iceland', 'Iceland', '2021-08-21 13:30:55', '2021-08-21 13:30:55'),
(73256, 'en', 'India', 'India', '2021-08-21 13:30:55', '2021-08-21 13:30:55'),
(73257, 'en', 'Indonesia', 'Indonesia', '2021-08-21 13:30:55', '2021-08-21 13:30:55'),
(73258, 'en', 'Iran, Islamic Republic of', 'Iran, Islamic Republic of', '2021-08-21 13:30:55', '2021-08-21 13:30:55'),
(73259, 'en', 'Iraq', 'Iraq', '2021-08-21 13:30:55', '2021-08-21 13:30:55'),
(73260, 'en', 'Ireland', 'Ireland', '2021-08-21 13:30:56', '2021-08-21 13:30:56'),
(73261, 'en', 'Israel', 'Israel', '2021-08-21 13:30:56', '2021-08-21 13:30:56'),
(73262, 'en', 'Italy', 'Italy', '2021-08-21 13:30:56', '2021-08-21 13:30:56'),
(73263, 'en', 'Japan', 'Japan', '2021-08-21 13:30:56', '2021-08-21 13:30:56'),
(73264, 'en', 'Jordan', 'Jordan', '2021-08-21 13:30:56', '2021-08-21 13:30:56'),
(73265, 'en', 'Kazakhstan', 'Kazakhstan', '2021-08-21 13:30:56', '2021-08-21 13:30:56'),
(73266, 'en', 'Kenya', 'Kenya', '2021-08-21 13:30:56', '2021-08-21 13:30:56'),
(73267, 'en', 'Kiribati', 'Kiribati', '2021-08-21 13:30:56', '2021-08-21 13:30:56'),
(73268, 'en', 'Kuwait', 'Kuwait', '2021-08-21 13:30:56', '2021-08-21 13:30:56'),
(73269, 'en', 'Kyrgyzstan', 'Kyrgyzstan', '2021-08-21 13:30:57', '2021-08-21 13:30:57'),
(73270, 'en', 'Latvia', 'Latvia', '2021-08-21 13:30:57', '2021-08-21 13:30:57'),
(73271, 'en', 'Lebanon', 'Lebanon', '2021-08-21 13:30:57', '2021-08-21 13:30:57'),
(73272, 'en', 'Lesotho', 'Lesotho', '2021-08-21 13:30:57', '2021-08-21 13:30:57'),
(73273, 'en', 'Liberia', 'Liberia', '2021-08-21 13:30:57', '2021-08-21 13:30:57'),
(73274, 'en', 'Libya', 'Libya', '2021-08-21 13:30:57', '2021-08-21 13:30:57'),
(73275, 'en', 'Liechtenstein', 'Liechtenstein', '2021-08-21 13:30:57', '2021-08-21 13:30:57'),
(73276, 'en', 'Lithuania', 'Lithuania', '2021-08-21 13:30:57', '2021-08-21 13:30:57'),
(73277, 'en', 'Luxembourg', 'Luxembourg', '2021-08-21 13:30:57', '2021-08-21 13:30:57'),
(73278, 'en', 'Macedonia', 'Macedonia', '2021-08-21 13:30:58', '2021-08-21 13:30:58'),
(73279, 'en', 'Madagascar', 'Madagascar', '2021-08-21 13:30:58', '2021-08-21 13:30:58'),
(73280, 'en', 'Malawi', 'Malawi', '2021-08-21 13:30:58', '2021-08-21 13:30:58'),
(73281, 'en', 'Malaysia', 'Malaysia', '2021-08-21 13:30:58', '2021-08-21 13:30:58'),
(73282, 'en', 'Maldives', 'Maldives', '2021-08-21 13:30:58', '2021-08-21 13:30:58'),
(73283, 'en', 'Mali', 'Mali', '2021-08-21 13:30:58', '2021-08-21 13:30:58'),
(73284, 'en', 'Malta', 'Malta', '2021-08-21 13:30:58', '2021-08-21 13:30:58'),
(73285, 'en', 'Marshall Islands', 'Marshall Islands', '2021-08-21 13:30:58', '2021-08-21 13:30:58'),
(73286, 'en', 'Mauritania', 'Mauritania', '2021-08-21 13:30:58', '2021-08-21 13:30:58'),
(73287, 'en', 'Mauritius', 'Mauritius', '2021-08-21 13:30:58', '2021-08-21 13:30:58'),
(73288, 'en', 'Mayotte', 'Mayotte', '2021-08-21 13:30:59', '2021-08-21 13:30:59'),
(73289, 'en', 'Mexico', 'Mexico', '2021-08-21 13:30:59', '2021-08-21 13:30:59'),
(73290, 'en', 'Micronesia', 'Micronesia', '2021-08-21 13:30:59', '2021-08-21 13:30:59'),
(73291, 'en', 'Moldova', 'Moldova', '2021-08-21 13:30:59', '2021-08-21 13:30:59'),
(73292, 'en', 'Monaco', 'Monaco', '2021-08-21 13:30:59', '2021-08-21 13:30:59'),
(73293, 'en', 'Mongolia', 'Mongolia', '2021-08-21 13:31:00', '2021-08-21 13:31:00'),
(73294, 'en', 'Montenegro', 'Montenegro', '2021-08-21 13:31:01', '2021-08-21 13:31:01'),
(73295, 'en', 'Morocco', 'Morocco', '2021-08-21 13:31:01', '2021-08-21 13:31:01'),
(73296, 'en', 'Mozambique', 'Mozambique', '2021-08-21 13:31:01', '2021-08-21 13:31:01'),
(73297, 'en', 'Myanmar', 'Myanmar', '2021-08-21 13:31:01', '2021-08-21 13:31:01'),
(73298, 'en', 'Namibia', 'Namibia', '2021-08-21 13:31:01', '2021-08-21 13:31:01'),
(73299, 'en', 'Nauru', 'Nauru', '2021-08-21 13:31:01', '2021-08-21 13:31:01'),
(73300, 'en', 'Nepal', 'Nepal', '2021-08-21 13:31:02', '2021-08-21 13:31:02'),
(73301, 'en', 'Netherlands', 'Netherlands', '2021-08-21 13:31:02', '2021-08-21 13:31:02'),
(73302, 'en', 'New Caledonia', 'New Caledonia', '2021-08-21 13:31:02', '2021-08-21 13:31:02'),
(73303, 'en', 'New Zealand', 'New Zealand', '2021-08-21 13:31:02', '2021-08-21 13:31:02'),
(73304, 'en', 'Nicaragua', 'Nicaragua', '2021-08-21 13:31:02', '2021-08-21 13:31:02'),
(73305, 'en', 'Niger', 'Niger', '2021-08-21 13:31:02', '2021-08-21 13:31:02'),
(73306, 'en', 'Nigeria', 'Nigeria', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73307, 'en', 'Niue', 'Niue', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73308, 'en', 'Norway', 'Norway', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73309, 'en', 'Oman', 'Oman', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73310, 'en', 'Pakistan', 'Pakistan', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73311, 'en', 'Palau', 'Palau', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73312, 'en', 'Palestinian', 'Palestinian', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73313, 'en', 'Panama', 'Panama', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73314, 'en', 'Paraguay', 'Paraguay', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73315, 'en', 'Peru', 'Peru', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73316, 'en', 'Philippines', 'Philippines', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73317, 'en', 'Pitcairn', 'Pitcairn', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73318, 'en', 'Poland', 'Poland', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73319, 'en', 'Portugal', 'Portugal', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73320, 'en', 'Qatar', 'Qatar', '2021-08-21 13:31:03', '2021-08-21 13:31:03'),
(73321, 'en', 'Romania', 'Romania', '2021-08-21 13:31:04', '2021-08-21 13:31:04'),
(73322, 'en', 'Russian Federation', 'Russian Federation', '2021-08-21 13:31:04', '2021-08-21 13:31:04'),
(73323, 'en', 'Rwanda', 'Rwanda', '2021-08-21 13:31:04', '2021-08-21 13:31:04'),
(73324, 'en', 'Saint Helena', 'Saint Helena', '2021-08-21 13:31:04', '2021-08-21 13:31:04'),
(73325, 'en', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', '2021-08-21 13:31:04', '2021-08-21 13:31:04'),
(73326, 'en', 'Samoa', 'Samoa', '2021-08-21 13:31:05', '2021-08-21 13:31:05'),
(73327, 'en', 'San Marino', 'San Marino', '2021-08-21 13:31:05', '2021-08-21 13:31:05'),
(73328, 'en', 'Sao Tome and Principe', 'Sao Tome and Principe', '2021-08-21 13:31:05', '2021-08-21 13:31:05'),
(73329, 'en', 'Saudi Arabia', 'Saudi Arabia', '2021-08-21 13:31:05', '2021-08-21 13:31:05'),
(73330, 'en', 'Senegal', 'Senegal', '2021-08-21 13:31:05', '2021-08-21 13:31:05'),
(73331, 'en', 'Serbia', 'Serbia', '2021-08-21 13:31:05', '2021-08-21 13:31:05'),
(73332, 'en', 'Seychelles', 'Seychelles', '2021-08-21 13:31:06', '2021-08-21 13:31:06'),
(73333, 'en', 'Sierra Leone', 'Sierra Leone', '2021-08-21 13:31:06', '2021-08-21 13:31:06'),
(73334, 'en', 'Singapore', 'Singapore', '2021-08-21 13:31:06', '2021-08-21 13:31:06'),
(73335, 'en', 'Slovakia', 'Slovakia', '2021-08-21 13:31:06', '2021-08-21 13:31:06'),
(73336, 'en', 'Slovenia', 'Slovenia', '2021-08-21 13:31:06', '2021-08-21 13:31:06'),
(73337, 'en', 'Solomon Islands', 'Solomon Islands', '2021-08-21 13:31:06', '2021-08-21 13:31:06'),
(73338, 'en', 'Somalia', 'Somalia', '2021-08-21 13:31:06', '2021-08-21 13:31:06'),
(73339, 'en', 'South Africa', 'South Africa', '2021-08-21 13:31:06', '2021-08-21 13:31:06'),
(73340, 'en', 'Spain', 'Spain', '2021-08-21 13:31:06', '2021-08-21 13:31:06'),
(73341, 'en', 'Sri Lanka', 'Sri Lanka', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73342, 'en', 'Sudan', 'Sudan', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73343, 'en', 'Suriname', 'Suriname', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73344, 'en', 'Svalbard and Jan Mayen Islands', 'Svalbard and Jan Mayen Islands', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73345, 'en', 'Swaziland', 'Swaziland', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73346, 'en', 'Sweden', 'Sweden', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73347, 'en', 'Switzerland', 'Switzerland', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73348, 'en', 'Syrian Arab Republic', 'Syrian Arab Republic', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73349, 'en', 'Taiwan, Republic of China', 'Taiwan, Republic of China', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73350, 'en', 'Tajikistan', 'Tajikistan', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73351, 'en', 'Tanzania', 'Tanzania', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73352, 'en', 'Thailand', 'Thailand', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73353, 'en', 'Togo', 'Togo', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73354, 'en', 'Tokelau', 'Tokelau', '2021-08-21 13:31:07', '2021-08-21 13:31:07'),
(73355, 'en', 'Tonga', 'Tonga', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73356, 'en', 'Tunisia', 'Tunisia', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73357, 'en', 'Turkey', 'Turkey', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73358, 'en', 'Turkmenistan', 'Turkmenistan', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73359, 'en', 'Tuvalu', 'Tuvalu', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73360, 'en', 'Uganda', 'Uganda', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73361, 'en', 'Ukraine', 'Ukraine', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73362, 'en', 'United Arab Emirates', 'United Arab Emirates', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73363, 'en', 'United Kingdom', 'United Kingdom', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73364, 'en', 'United States of America', 'United States of America', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73365, 'en', 'Uruguay', 'Uruguay', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73366, 'en', 'Uzbekistan', 'Uzbekistan', '2021-08-21 13:31:08', '2021-08-21 13:31:08'),
(73367, 'en', 'Vanuatu', 'Vanuatu', '2021-08-21 13:31:09', '2021-08-21 13:31:09'),
(73368, 'en', 'Venezuela', 'Venezuela', '2021-08-21 13:31:09', '2021-08-21 13:31:09'),
(73369, 'en', 'Viet Nam', 'Viet Nam', '2021-08-21 13:31:09', '2021-08-21 13:31:09'),
(73370, 'en', 'Wallis and Futuna Islands', 'Wallis and Futuna Islands', '2021-08-21 13:31:09', '2021-08-21 13:31:09'),
(73371, 'en', 'Yemen', 'Yemen', '2021-08-21 13:31:09', '2021-08-21 13:31:09'),
(73372, 'en', 'Zambia', 'Zambia', '2021-08-21 13:31:09', '2021-08-21 13:31:09'),
(73373, 'en', 'Zimbabwe', 'Zimbabwe', '2021-08-21 13:31:09', '2021-08-21 13:31:09'),
(73374, 'en', 'Please enter the code', 'Please enter the code', '2021-08-21 15:15:31', '2021-08-21 15:15:31'),
(73375, 'en', 'sent to', 'sent to', '2021-08-21 15:15:31', '2021-08-21 15:15:31'),
(73376, 'en', 'verification', 'verification', '2021-08-21 15:15:31', '2021-08-21 15:15:31'),
(73377, 'en', 'Didn\'t get the code', 'Didn\'t get the code', '2021-08-21 15:15:31', '2021-08-21 15:15:31'),
(73378, 'en', 'resend code', 'resend code', '2021-08-21 15:15:31', '2021-08-21 15:15:31'),
(73379, 'en', 'Didn\'t get the code ?', 'Didn\'t get the code ?', '2021-08-21 15:48:40', '2021-08-21 15:48:40'),
(73380, 'en', 'You have exceeded the maximum number of messages', 'You have exceeded the maximum number of messages', '2021-08-21 22:03:11', '2021-08-21 22:03:11'),
(73381, 'en', 'The code you entered is wrong', 'The code you entered is wrong', '2021-08-22 00:00:44', '2021-08-22 00:00:44'),
(73382, 'en', 'File Uploads', 'File Uploads', '2021-08-26 04:01:35', '2021-08-26 04:01:35'),
(73383, 'en', 'Notes', 'Notes', '2021-08-26 04:01:35', '2021-08-26 04:01:35'),
(73384, 'en', 'Add Notes', 'Add Notes', '2021-08-26 04:41:54', '2021-08-26 04:41:54'),
(73385, 'en', 'add Note', 'add Note', '2021-08-26 04:41:54', '2021-08-26 04:41:54'),
(73386, 'en', 'please enter your notes', 'please enter your notes', '2021-08-26 04:41:54', '2021-08-26 04:41:54'),
(73387, 'en', 'These files are visible in product details page gallery', 'These files are visible in product details page gallery', '2021-08-26 05:15:59', '2021-08-26 05:15:59'),
(73388, 'en', 'These files are visible in product details page gallery,please choose files', 'These files are visible in product details page gallery,please choose files', '2021-08-26 05:18:49', '2021-08-26 05:18:49'),
(73389, 'en', 'These files are visible to seller page gallery,please choose files lkdsl dls dl sl', 'These files are visible to seller page gallery,please choose files lkdsl dls dl sl', '2021-08-26 05:19:37', '2021-08-26 05:19:37'),
(73390, 'en', 'the Customer var_user Add New Product In Baskets a Price 5859 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 5859 Inclusive of Tax and Shipping sssssssssss', '2021-08-29 06:34:22', '2021-08-29 06:34:22'),
(73391, 'en', 'the Customer var_user Add New Product In Baskets a Price 5208 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 5208 Inclusive of Tax and Shipping sssssssssss', '2021-08-29 06:34:22', '2021-08-29 06:34:22'),
(73392, 'en', 'the Customer var_user Add New Product In Baskets a Price 4557 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 4557 Inclusive of Tax and Shipping sssssssssss', '2021-08-29 06:34:22', '2021-08-29 06:34:22'),
(73393, 'en', 'the Customer var_user Add New Product In Baskets a Price 3906 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 3906 Inclusive of Tax and Shipping sssssssssss', '2021-08-29 06:34:22', '2021-08-29 06:34:22'),
(73394, 'en', 'the Customer var_user Add New Product In Baskets a Price 3255 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 3255 Inclusive of Tax and Shipping sssssssssss', '2021-08-29 06:34:23', '2021-08-29 06:34:23'),
(73395, 'en', 'the Customer var_user Add New Product In Baskets a Price 2604 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 2604 Inclusive of Tax and Shipping sssssssssss', '2021-08-29 06:34:23', '2021-08-29 06:34:23'),
(73396, 'en', 'the Customer var_user Add New Product In Baskets a Price 1953 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 1953 Inclusive of Tax and Shipping sssssssssss', '2021-08-29 06:34:25', '2021-08-29 06:34:25'),
(73397, 'en', 'the Customer var_user Add New Product In Baskets a Price 1302 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 1302 Inclusive of Tax and Shipping sssssssssss', '2021-08-29 06:34:26', '2021-08-29 06:34:26'),
(73398, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 5859 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 5859 شامل الضريبه والشحن', '2021-08-29 06:36:54', '2021-08-29 06:36:54'),
(73399, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 5208 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 5208 شامل الضريبه والشحن', '2021-08-29 06:36:54', '2021-08-29 06:36:54'),
(73400, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 4557 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 4557 شامل الضريبه والشحن', '2021-08-29 06:36:54', '2021-08-29 06:36:54'),
(73401, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 3906 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 3906 شامل الضريبه والشحن', '2021-08-29 06:36:55', '2021-08-29 06:36:55'),
(73402, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 3255 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 3255 شامل الضريبه والشحن', '2021-08-29 06:36:55', '2021-08-29 06:36:55'),
(73403, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 2604 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 2604 شامل الضريبه والشحن', '2021-08-29 06:36:56', '2021-08-29 06:36:56'),
(73404, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 1953 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1953 شامل الضريبه والشحن', '2021-08-29 06:37:00', '2021-08-29 06:37:00'),
(73405, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 1302 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1302 شامل الضريبه والشحن', '2021-08-29 06:37:03', '2021-08-29 06:37:03'),
(73406, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 6510 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 6510 شامل الضريبه والشحن', '2021-08-29 10:49:09', '2021-08-29 10:49:09'),
(73407, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 634 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 634 شامل الضريبه والشحن', '2021-08-29 10:49:09', '2021-08-29 10:49:09'),
(73408, 'en', 'City Information', 'City Information', '2021-08-29 10:49:40', '2021-08-29 10:49:40'),
(73409, 'en', 'City has been updated successfully', 'City has been updated successfully', '2021-08-29 10:49:49', '2021-08-29 10:49:49'),
(73410, 'en', 'order files', 'order files', '2021-08-29 11:32:41', '2021-08-29 11:32:41'),
(73411, 'en', 'notes on products', 'notes on products', '2021-08-29 11:55:02', '2021-08-29 11:55:02'),
(73412, 'en', 'products name', 'products name', '2021-08-29 11:57:19', '2021-08-29 11:57:19'),
(73413, 'en', 'the Customer var_user Add New Product In Baskets a Price 6510 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 6510 Inclusive of Tax and Shipping sssssssssss', '2021-08-30 08:25:02', '2021-08-30 08:25:02'),
(73414, 'en', 'the Customer var_user Add New Product In Baskets a Price 634 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 634 Inclusive of Tax and Shipping sssssssssss', '2021-08-30 08:25:02', '2021-08-30 08:25:02'),
(73415, 'en', 'show msg', 'show msg', '2021-08-30 08:43:09', '2021-08-30 08:43:09'),
(73416, 'en', 'show msg add card', 'show msg add card', '2021-08-30 08:48:01', '2021-08-30 08:48:01'),
(73417, 'en', 'the Customer var_user Add New Product In Baskets a Price 1232 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 1232 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:44', '2021-08-31 12:26:44'),
(73418, 'en', 'the Customer var_user Add New Product In Baskets a Price 616 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 616 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:44', '2021-08-31 12:26:44'),
(73419, 'en', 'the Customer var_user Add New Product In Baskets a Price 16275 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 16275 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:44', '2021-08-31 12:26:44'),
(73420, 'en', 'the Customer var_user Add New Product In Baskets a Price 15624 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 15624 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:44', '2021-08-31 12:26:44'),
(73421, 'en', 'the Customer var_user Add New Product In Baskets a Price 14973 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 14973 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:44', '2021-08-31 12:26:44'),
(73422, 'en', 'the Customer var_user Add New Product In Baskets a Price 14322 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 14322 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:44', '2021-08-31 12:26:44'),
(73423, 'en', 'the Customer var_user Add New Product In Baskets a Price 13671 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 13671 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:45', '2021-08-31 12:26:45'),
(73424, 'en', 'the Customer var_user Add New Product In Baskets a Price 13020 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 13020 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:45', '2021-08-31 12:26:45'),
(73425, 'en', 'the Customer var_user Add New Product In Baskets a Price 12369 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 12369 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:45', '2021-08-31 12:26:45'),
(73426, 'en', 'the Customer var_user Add New Product In Baskets a Price 11718 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 11718 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:45', '2021-08-31 12:26:45'),
(73427, 'en', 'the Customer var_user Add New Product In Baskets a Price 11067 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 11067 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:45', '2021-08-31 12:26:45'),
(73428, 'en', 'the Customer var_user Add New Product In Baskets a Price 10416 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 10416 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:45', '2021-08-31 12:26:45'),
(73429, 'en', 'the Customer var_user Add New Product In Baskets a Price 9765 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 9765 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:45', '2021-08-31 12:26:45'),
(73430, 'en', 'the Customer var_user Add New Product In Baskets a Price 9114 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 9114 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:46', '2021-08-31 12:26:46'),
(73431, 'en', 'the Customer var_user Add New Product In Baskets a Price 8463 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 8463 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:46', '2021-08-31 12:26:46'),
(73432, 'en', 'the Customer var_user Add New Product In Baskets a Price 7812 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 7812 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:46', '2021-08-31 12:26:46'),
(73433, 'en', 'the Customer var_user Add New Product In Baskets a Price 7161 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 7161 Inclusive of Tax and Shipping sssssssssss', '2021-08-31 12:26:46', '2021-08-31 12:26:46'),
(73434, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 1232 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1232 شامل الضريبه والشحن', '2021-09-05 07:41:33', '2021-09-05 07:41:33'),
(73435, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 616 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 616 شامل الضريبه والشحن', '2021-09-05 07:41:34', '2021-09-05 07:41:34'),
(73436, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 16275 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 16275 شامل الضريبه والشحن', '2021-09-05 07:41:34', '2021-09-05 07:41:34'),
(73437, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 15624 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 15624 شامل الضريبه والشحن', '2021-09-05 07:41:34', '2021-09-05 07:41:34'),
(73438, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 14973 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 14973 شامل الضريبه والشحن', '2021-09-05 07:41:35', '2021-09-05 07:41:35'),
(73439, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 14322 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 14322 شامل الضريبه والشحن', '2021-09-05 07:41:35', '2021-09-05 07:41:35'),
(73440, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 13671 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 13671 شامل الضريبه والشحن', '2021-09-05 07:41:35', '2021-09-05 07:41:35'),
(73441, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 13020 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 13020 شامل الضريبه والشحن', '2021-09-05 07:41:36', '2021-09-05 07:41:36'),
(73442, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 12369 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 12369 شامل الضريبه والشحن', '2021-09-05 07:41:36', '2021-09-05 07:41:36'),
(73443, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 11718 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 11718 شامل الضريبه والشحن', '2021-09-05 07:41:36', '2021-09-05 07:41:36'),
(73444, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 11067 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 11067 شامل الضريبه والشحن', '2021-09-05 07:41:37', '2021-09-05 07:41:37'),
(73445, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 10416 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 10416 شامل الضريبه والشحن', '2021-09-05 07:41:37', '2021-09-05 07:41:37'),
(73446, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 9765 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 9765 شامل الضريبه والشحن', '2021-09-05 07:41:37', '2021-09-05 07:41:37'),
(73447, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 9114 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 9114 شامل الضريبه والشحن', '2021-09-05 07:41:38', '2021-09-05 07:41:38'),
(73448, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 8463 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 8463 شامل الضريبه والشحن', '2021-09-05 07:41:38', '2021-09-05 07:41:38'),
(73449, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 7812 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 7812 شامل الضريبه والشحن', '2021-09-05 07:41:39', '2021-09-05 07:41:39'),
(73450, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 7161 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 7161 شامل الضريبه والشحن', '2021-09-05 07:41:39', '2021-09-05 07:41:39'),
(73451, 'en', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum amount of purchases is var_price offer code var_code', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum amount of purchases is var_price offer code var_code', '2021-09-07 12:03:54', '2021-09-07 12:03:54'),
(73452, 'en', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum quantity of products is var_count offer code var_code', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum quantity of products is var_count offer code var_code', '2021-09-07 12:03:55', '2021-09-07 12:03:55'),
(73453, 'en', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price offer code var_code', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price offer code var_code', '2021-09-07 12:03:56', '2021-09-07 12:03:56'),
(73454, 'en', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum quantity of products is var_count offer code var_code', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum quantity of products is var_count offer code var_code', '2021-09-07 12:03:56', '2021-09-07 12:03:56'),
(73455, 'en', 'Special Offer for a limited time', 'Special Offer for a limited time', '2021-09-07 13:06:28', '2021-09-07 13:06:28'),
(73456, 'en', 'Cart Items dd', 'Cart Items dd', '2021-09-07 13:12:25', '2021-09-07 13:12:25'),
(73457, 'en', 'Special Offer for a limited time Coupon Code :', 'Special Offer for a limited time Coupon Code :', '2021-09-07 13:44:37', '2021-09-07 13:44:37'),
(73458, 'en', 'Spcial Offers Products', 'Spcial Offers Products', '2021-09-08 12:27:53', '2021-09-08 12:27:53'),
(73459, 'en', 'special offer', 'special offer', '2021-09-08 12:46:21', '2021-09-08 12:46:21'),
(73460, 'en', 'Item has been added to compare list', 'Item has been added to compare list', '2021-09-08 13:58:15', '2021-09-08 13:58:15'),
(73461, 'sa', 'the Customer var_user Add New Product In Baskets a Price 6510 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 6510 Inclusive of Tax and Shipping sssssssssss', '2021-09-12 11:54:28', '2021-09-12 11:54:28'),
(73462, 'sa', 'the Customer var_user Add New Product In Baskets a Price 634 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 634 Inclusive of Tax and Shipping sssssssssss', '2021-09-12 11:54:28', '2021-09-12 11:54:28'),
(73463, 'sa', 'the Customer var_user Add New Product In Baskets a Price 651 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 651 Inclusive of Tax and Shipping sssssssssss', '2021-09-12 11:54:28', '2021-09-12 11:54:28'),
(73464, 'sa', 'the Customer var_user Add New Product In Baskets a Price 5859 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 5859 Inclusive of Tax and Shipping sssssssssss', '2021-09-12 11:54:28', '2021-09-12 11:54:28'),
(73465, 'sa', 'the Customer var_user Add New Product In Baskets a Price 5208 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 5208 Inclusive of Tax and Shipping sssssssssss', '2021-09-12 11:54:28', '2021-09-12 11:54:28'),
(73466, 'sa', 'the Customer var_user Add New Product In Baskets a Price 4557 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 4557 Inclusive of Tax and Shipping sssssssssss', '2021-09-12 11:54:28', '2021-09-12 11:54:28'),
(73467, 'sa', 'the Customer var_user Add New Product In Baskets a Price 3906 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 3906 Inclusive of Tax and Shipping sssssssssss', '2021-09-12 11:54:29', '2021-09-12 11:54:29'),
(73468, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 14322 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 14322 شامل الضريبه والشحن', '2021-09-12 13:05:16', '2021-09-12 13:05:16'),
(73469, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 13671 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 13671 شامل الضريبه والشحن', '2021-09-12 13:05:16', '2021-09-12 13:05:16'),
(73470, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 13020 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 13020 شامل الضريبه والشحن', '2021-09-12 13:05:16', '2021-09-12 13:05:16'),
(73471, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 12369 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 12369 شامل الضريبه والشحن', '2021-09-12 13:05:16', '2021-09-12 13:05:16');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(73472, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 11718 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 11718 شامل الضريبه والشحن', '2021-09-12 13:05:17', '2021-09-12 13:05:17'),
(73473, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 11067 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 11067 شامل الضريبه والشحن', '2021-09-12 13:05:17', '2021-09-12 13:05:17'),
(73474, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 10416 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 10416 شامل الضريبه والشحن', '2021-09-12 13:05:18', '2021-09-12 13:05:18'),
(73475, 'sa', 'Spcial Offers Products', 'Spcial Offers Products', '2021-09-14 08:24:43', '2021-09-14 08:24:43'),
(73476, 'sa', 'special offer', 'special offer', '2021-09-14 08:24:43', '2021-09-14 08:24:43'),
(73477, 'sa', 'Egypt', 'Egypt', '2021-09-14 12:20:04', '2021-09-14 12:20:04'),
(73478, 'sa', 'Saudi Arabia', 'Saudi Arabia', '2021-09-14 12:20:04', '2021-09-14 12:20:04'),
(73479, 'sa', 'Albania', 'Albania', '2021-09-14 12:20:04', '2021-09-14 12:20:04'),
(73480, 'sa', 'Algeria', 'Algeria', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73481, 'sa', 'Andorra', 'Andorra', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73482, 'sa', 'Angola', 'Angola', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73483, 'sa', 'Argentina', 'Argentina', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73484, 'sa', 'Armenia', 'Armenia', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73485, 'sa', 'Aruba', 'Aruba', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73486, 'sa', 'Australia', 'Australia', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73487, 'sa', 'Austria', 'Austria', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73488, 'sa', 'Azerbaijan', 'Azerbaijan', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73489, 'sa', 'Bahrain', 'Bahrain', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73490, 'sa', 'Bangladesh', 'Bangladesh', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73491, 'sa', 'Belarus', 'Belarus', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73492, 'sa', 'Belgium', 'Belgium', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73493, 'sa', 'Belize', 'Belize', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73494, 'sa', 'Benin', 'Benin', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73495, 'sa', 'Bhutan', 'Bhutan', '2021-09-14 12:20:05', '2021-09-14 12:20:05'),
(73496, 'sa', 'Bolivia', 'Bolivia', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73497, 'sa', 'Bosnia and Herzegovina', 'Bosnia and Herzegovina', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73498, 'sa', 'Botswana', 'Botswana', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73499, 'sa', 'Brazil', 'Brazil', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73500, 'sa', 'British Indian Ocean Territory', 'British Indian Ocean Territory', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73501, 'sa', 'Brunei Darussalam', 'Brunei Darussalam', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73502, 'sa', 'Bulgaria', 'Bulgaria', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73503, 'sa', 'Burkina Faso', 'Burkina Faso', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73504, 'sa', 'Burundi', 'Burundi', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73505, 'sa', 'Cambodia', 'Cambodia', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73506, 'sa', 'Cameroon', 'Cameroon', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73507, 'sa', 'Canada', 'Canada', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73508, 'sa', 'Cape Verde', 'Cape Verde', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73509, 'sa', 'Central African Republic', 'Central African Republic', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73510, 'sa', 'Chad', 'Chad', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73511, 'sa', 'Chile', 'Chile', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73512, 'sa', 'China', 'China', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73513, 'sa', 'Hong Kong', 'Hong Kong', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73514, 'sa', 'Macao', 'Macao', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73515, 'sa', 'Christmas Island', 'Christmas Island', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73516, 'sa', 'Cocos (Keeling) Islands', 'Cocos (Keeling) Islands', '2021-09-14 12:20:06', '2021-09-14 12:20:06'),
(73517, 'sa', 'Colombia', 'Colombia', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73518, 'sa', 'Comoros', 'Comoros', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73519, 'sa', 'Cook Islands', 'Cook Islands', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73520, 'sa', 'Costa Rica', 'Costa Rica', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73521, 'sa', 'Croatia', 'Croatia', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73522, 'sa', 'Cuba', 'Cuba', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73523, 'sa', 'Cyprus', 'Cyprus', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73524, 'sa', 'Czech Republic', 'Czech Republic', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73525, 'sa', 'Denmark', 'Denmark', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73526, 'sa', 'Djibouti', 'Djibouti', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73527, 'sa', 'Ecuador', 'Ecuador', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73528, 'sa', 'El Salvador', 'El Salvador', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73529, 'sa', 'Equatorial Guinea', 'Equatorial Guinea', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73530, 'sa', 'Eritrea', 'Eritrea', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73531, 'sa', 'Estonia', 'Estonia', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73532, 'sa', 'Ethiopia', 'Ethiopia', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73533, 'sa', 'Faroe Islands', 'Faroe Islands', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73534, 'sa', 'Fiji', 'Fiji', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73535, 'sa', 'Finland', 'Finland', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73536, 'sa', 'France', 'France', '2021-09-14 12:20:07', '2021-09-14 12:20:07'),
(73537, 'sa', 'French Guiana', 'French Guiana', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73538, 'sa', 'Gabon', 'Gabon', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73539, 'sa', 'Gambia', 'Gambia', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73540, 'sa', 'Georgia', 'Georgia', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73541, 'sa', 'Germany', 'Germany', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73542, 'sa', 'Ghana', 'Ghana', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73543, 'sa', 'Gibraltar', 'Gibraltar', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73544, 'sa', 'Greece', 'Greece', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73545, 'sa', 'Greenland', 'Greenland', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73546, 'sa', 'Guatemala', 'Guatemala', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73547, 'sa', 'Guinea', 'Guinea', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73548, 'sa', 'Guyana', 'Guyana', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73549, 'sa', 'Haiti', 'Haiti', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73550, 'sa', 'Honduras', 'Honduras', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73551, 'sa', 'Hungary', 'Hungary', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73552, 'sa', 'Iceland', 'Iceland', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73553, 'sa', 'India', 'India', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73554, 'sa', 'Indonesia', 'Indonesia', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73555, 'sa', 'Iran, Islamic Republic of', 'Iran, Islamic Republic of', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73556, 'sa', 'Iraq', 'Iraq', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73557, 'sa', 'Ireland', 'Ireland', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73558, 'sa', 'Israel', 'Israel', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73559, 'sa', 'Italy', 'Italy', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73560, 'sa', 'Japan', 'Japan', '2021-09-14 12:20:08', '2021-09-14 12:20:08'),
(73561, 'sa', 'Jordan', 'Jordan', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73562, 'sa', 'Kazakhstan', 'Kazakhstan', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73563, 'sa', 'Kenya', 'Kenya', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73564, 'sa', 'Kiribati', 'Kiribati', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73565, 'sa', 'Kuwait', 'Kuwait', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73566, 'sa', 'Kyrgyzstan', 'Kyrgyzstan', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73567, 'sa', 'Latvia', 'Latvia', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73568, 'sa', 'Lebanon', 'Lebanon', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73569, 'sa', 'Lesotho', 'Lesotho', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73570, 'sa', 'Liberia', 'Liberia', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73571, 'sa', 'Libya', 'Libya', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73572, 'sa', 'Liechtenstein', 'Liechtenstein', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73573, 'sa', 'Lithuania', 'Lithuania', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73574, 'sa', 'Luxembourg', 'Luxembourg', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73575, 'sa', 'Macedonia', 'Macedonia', '2021-09-14 12:20:09', '2021-09-14 12:20:09'),
(73576, 'sa', 'Madagascar', 'Madagascar', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73577, 'sa', 'Malawi', 'Malawi', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73578, 'sa', 'Malaysia', 'Malaysia', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73579, 'sa', 'Maldives', 'Maldives', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73580, 'sa', 'Mali', 'Mali', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73581, 'sa', 'Malta', 'Malta', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73582, 'sa', 'Marshall Islands', 'Marshall Islands', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73583, 'sa', 'Mauritania', 'Mauritania', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73584, 'sa', 'Mauritius', 'Mauritius', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73585, 'sa', 'Mayotte', 'Mayotte', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73586, 'sa', 'Mexico', 'Mexico', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73587, 'sa', 'Micronesia', 'Micronesia', '2021-09-14 12:20:10', '2021-09-14 12:20:10'),
(73588, 'sa', 'Moldova', 'Moldova', '2021-09-14 12:20:11', '2021-09-14 12:20:11'),
(73589, 'sa', 'Monaco', 'Monaco', '2021-09-14 12:20:11', '2021-09-14 12:20:11'),
(73590, 'sa', 'Mongolia', 'Mongolia', '2021-09-14 12:20:11', '2021-09-14 12:20:11'),
(73591, 'sa', 'Montenegro', 'Montenegro', '2021-09-14 12:20:11', '2021-09-14 12:20:11'),
(73592, 'sa', 'Morocco', 'Morocco', '2021-09-14 12:20:11', '2021-09-14 12:20:11'),
(73593, 'sa', 'Mozambique', 'Mozambique', '2021-09-14 12:20:11', '2021-09-14 12:20:11'),
(73594, 'sa', 'Myanmar', 'Myanmar', '2021-09-14 12:20:11', '2021-09-14 12:20:11'),
(73595, 'sa', 'Namibia', 'Namibia', '2021-09-14 12:20:11', '2021-09-14 12:20:11'),
(73596, 'sa', 'Nauru', 'Nauru', '2021-09-14 12:20:11', '2021-09-14 12:20:11'),
(73597, 'sa', 'Nepal', 'Nepal', '2021-09-14 12:20:11', '2021-09-14 12:20:11'),
(73598, 'sa', 'Netherlands', 'Netherlands', '2021-09-14 12:20:11', '2021-09-14 12:20:11'),
(73599, 'sa', 'New Caledonia', 'New Caledonia', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73600, 'sa', 'New Zealand', 'New Zealand', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73601, 'sa', 'Nicaragua', 'Nicaragua', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73602, 'sa', 'Niger', 'Niger', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73603, 'sa', 'Nigeria', 'Nigeria', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73604, 'sa', 'Niue', 'Niue', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73605, 'sa', 'Norway', 'Norway', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73606, 'sa', 'Oman', 'Oman', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73607, 'sa', 'Pakistan', 'Pakistan', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73608, 'sa', 'Palau', 'Palau', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73609, 'sa', 'Palestinian', 'Palestinian', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73610, 'sa', 'Panama', 'Panama', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73611, 'sa', 'Paraguay', 'Paraguay', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73612, 'sa', 'Peru', 'Peru', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73613, 'sa', 'Philippines', 'Philippines', '2021-09-14 12:20:12', '2021-09-14 12:20:12'),
(73614, 'sa', 'Pitcairn', 'Pitcairn', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73615, 'sa', 'Poland', 'Poland', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73616, 'sa', 'Portugal', 'Portugal', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73617, 'sa', 'Qatar', 'Qatar', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73618, 'sa', 'Romania', 'Romania', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73619, 'sa', 'Russian Federation', 'Russian Federation', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73620, 'sa', 'Rwanda', 'Rwanda', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73621, 'sa', 'Saint Helena', 'Saint Helena', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73622, 'sa', 'Saint Pierre and Miquelon', 'Saint Pierre and Miquelon', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73623, 'sa', 'Samoa', 'Samoa', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73624, 'sa', 'San Marino', 'San Marino', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73625, 'sa', 'Sao Tome and Principe', 'Sao Tome and Principe', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73626, 'sa', 'Senegal', 'Senegal', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73627, 'sa', 'Serbia', 'Serbia', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73628, 'sa', 'Seychelles', 'Seychelles', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73629, 'sa', 'Sierra Leone', 'Sierra Leone', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73630, 'sa', 'Singapore', 'Singapore', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73631, 'sa', 'Slovakia', 'Slovakia', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73632, 'sa', 'Slovenia', 'Slovenia', '2021-09-14 12:20:13', '2021-09-14 12:20:13'),
(73633, 'sa', 'Solomon Islands', 'Solomon Islands', '2021-09-14 12:20:14', '2021-09-14 12:20:14'),
(73634, 'sa', 'Somalia', 'Somalia', '2021-09-14 12:20:14', '2021-09-14 12:20:14'),
(73635, 'sa', 'South Africa', 'South Africa', '2021-09-14 12:20:14', '2021-09-14 12:20:14'),
(73636, 'sa', 'Spain', 'Spain', '2021-09-14 12:20:14', '2021-09-14 12:20:14'),
(73637, 'sa', 'Sri Lanka', 'Sri Lanka', '2021-09-14 12:20:14', '2021-09-14 12:20:14'),
(73638, 'sa', 'Sudan', 'Sudan', '2021-09-14 12:20:14', '2021-09-14 12:20:14'),
(73639, 'sa', 'Suriname', 'Suriname', '2021-09-14 12:20:14', '2021-09-14 12:20:14'),
(73640, 'sa', 'Svalbard and Jan Mayen Islands', 'Svalbard and Jan Mayen Islands', '2021-09-14 12:20:14', '2021-09-14 12:20:14'),
(73641, 'sa', 'Swaziland', 'Swaziland', '2021-09-14 12:20:14', '2021-09-14 12:20:14'),
(73642, 'sa', 'Sweden', 'Sweden', '2021-09-14 12:20:14', '2021-09-14 12:20:14'),
(73643, 'sa', 'Switzerland', 'Switzerland', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73644, 'sa', 'Syrian Arab Republic', 'Syrian Arab Republic', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73645, 'sa', 'Taiwan, Republic of China', 'Taiwan, Republic of China', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73646, 'sa', 'Tajikistan', 'Tajikistan', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73647, 'sa', 'Tanzania', 'Tanzania', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73648, 'sa', 'Thailand', 'Thailand', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73649, 'sa', 'Togo', 'Togo', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73650, 'sa', 'Tokelau', 'Tokelau', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73651, 'sa', 'Tonga', 'Tonga', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73652, 'sa', 'Tunisia', 'Tunisia', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73653, 'sa', 'Turkey', 'Turkey', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73654, 'sa', 'Turkmenistan', 'Turkmenistan', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73655, 'sa', 'Tuvalu', 'Tuvalu', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73656, 'sa', 'Uganda', 'Uganda', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73657, 'sa', 'Ukraine', 'Ukraine', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73658, 'sa', 'United Arab Emirates', 'United Arab Emirates', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73659, 'sa', 'United Kingdom', 'United Kingdom', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73660, 'sa', 'United States of America', 'United States of America', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73661, 'sa', 'Uruguay', 'Uruguay', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73662, 'sa', 'Uzbekistan', 'Uzbekistan', '2021-09-14 12:20:15', '2021-09-14 12:20:15'),
(73663, 'sa', 'Vanuatu', 'Vanuatu', '2021-09-14 12:20:16', '2021-09-14 12:20:16'),
(73664, 'sa', 'Venezuela', 'Venezuela', '2021-09-14 12:20:16', '2021-09-14 12:20:16'),
(73665, 'sa', 'Viet Nam', 'Viet Nam', '2021-09-14 12:20:16', '2021-09-14 12:20:16'),
(73666, 'sa', 'Wallis and Futuna Islands', 'Wallis and Futuna Islands', '2021-09-14 12:20:16', '2021-09-14 12:20:16'),
(73667, 'sa', 'Yemen', 'Yemen', '2021-09-14 12:20:16', '2021-09-14 12:20:16'),
(73668, 'sa', 'Zambia', 'Zambia', '2021-09-14 12:20:16', '2021-09-14 12:20:16'),
(73669, 'sa', 'Zimbabwe', 'Zimbabwe', '2021-09-14 12:20:16', '2021-09-14 12:20:16'),
(73670, 'sa', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum quantity of products is var_count offer code var_code', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum quantity of products is var_count offer code var_code', '2021-09-14 12:20:52', '2021-09-14 12:20:52'),
(73671, 'sa', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price offer code var_code', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price offer code var_code', '2021-09-14 12:20:53', '2021-09-14 12:20:53'),
(73672, 'sa', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum quantity of products is var_count offer code var_code', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum quantity of products is var_count offer code var_code', '2021-09-14 12:20:53', '2021-09-14 12:20:53'),
(73673, 'sa', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum amount of purchases is var_price offer code var_code', 'If you buy from one of these var_type, you will get a var_discount, provided that the minimum amount of purchases is var_price offer code var_code', '2021-09-14 12:21:05', '2021-09-14 12:21:05'),
(73674, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 634 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 634 شامل الضريبه والشحن', '2021-09-14 12:23:42', '2021-09-14 12:23:42'),
(73675, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 123 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 123 شامل الضريبه والشحن', '2021-09-14 12:23:45', '2021-09-14 12:23:45'),
(73676, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 246 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 246 شامل الضريبه والشحن', '2021-09-14 12:23:45', '2021-09-14 12:23:45'),
(73677, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 97 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 97 شامل الضريبه والشحن', '2021-09-14 12:23:45', '2021-09-14 12:23:45'),
(73678, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 104 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 104 شامل الضريبه والشحن', '2021-09-14 12:23:47', '2021-09-14 12:23:47'),
(73679, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 74 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 74 شامل الضريبه والشحن', '2021-09-14 12:23:47', '2021-09-14 12:23:47'),
(73680, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 113 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 113 شامل الضريبه والشحن', '2021-09-14 12:23:47', '2021-09-14 12:23:47'),
(73681, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 116 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 116 شامل الضريبه والشحن', '2021-09-14 12:23:49', '2021-09-14 12:23:49'),
(73682, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 222 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 222 شامل الضريبه والشحن', '2021-09-14 12:23:51', '2021-09-14 12:23:51'),
(73683, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 480 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 480 شامل الضريبه والشحن', '2021-09-14 12:23:53', '2021-09-14 12:23:53'),
(73684, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 240 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 240 شامل الضريبه والشحن', '2021-09-14 12:23:55', '2021-09-14 12:23:55'),
(73685, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 616 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 616 شامل الضريبه والشحن', '2021-09-14 12:24:17', '2021-09-14 12:24:17'),
(73686, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 1232 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1232 شامل الضريبه والشحن', '2021-09-14 12:24:17', '2021-09-14 12:24:17'),
(73687, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 16275 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 16275 شامل الضريبه والشحن', '2021-09-14 12:24:18', '2021-09-14 12:24:18'),
(73688, 'sa', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price', 'If you buy one of these var_type, you will get a discount var_discount_perceent Provided that the maximum discount does not exceed var_max_price_discount and that the minimum purchase amount is var_price', '2021-09-14 12:24:18', '2021-09-14 12:24:18'),
(73689, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 15624 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 15624 شامل الضريبه والشحن', '2021-09-14 12:24:19', '2021-09-14 12:24:19'),
(73690, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 14973 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 14973 شامل الضريبه والشحن', '2021-09-14 12:24:19', '2021-09-14 12:24:19'),
(73691, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 9765 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 9765 شامل الضريبه والشحن', '2021-09-14 12:24:20', '2021-09-14 12:24:20'),
(73692, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 9114 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 9114 شامل الضريبه والشحن', '2021-09-14 12:24:20', '2021-09-14 12:24:20'),
(73693, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 8463 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 8463 شامل الضريبه والشحن', '2021-09-14 12:24:20', '2021-09-14 12:24:20'),
(73694, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 7812 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 7812 شامل الضريبه والشحن', '2021-09-14 12:24:20', '2021-09-14 12:24:20'),
(73695, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 7161 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 7161 شامل الضريبه والشحن', '2021-09-14 12:24:20', '2021-09-14 12:24:20'),
(73696, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 6510 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 6510 شامل الضريبه والشحن', '2021-09-14 12:24:20', '2021-09-14 12:24:20'),
(73697, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 651 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 651 شامل الضريبه والشحن', '2021-09-14 12:24:20', '2021-09-14 12:24:20'),
(73698, 'sa', 'Add Notes', 'اضف ملاحظات', '2021-09-14 16:10:06', '2021-09-26 13:08:31'),
(73699, 'sa', 'Please enter the code', 'من فضلك ادخل الرمز', '2021-09-15 06:56:57', '2021-09-15 09:09:29'),
(73700, 'sa', 'sent to', 'تم الارسال', '2021-09-15 06:56:57', '2021-09-26 13:08:31'),
(73701, 'sa', 'verification', 'التحقق', '2021-09-15 06:56:57', '2021-09-26 13:08:31'),
(73702, 'sa', 'Didn\'t get the code ?', 'لم يصلك الكود؟', '2021-09-15 06:56:57', '2021-09-26 13:08:31'),
(73703, 'sa', 'resend code', 'اعد ارسال الكود', '2021-09-15 06:56:57', '2021-09-26 13:08:31'),
(73704, 'sa', 'The code you entered is wrong', 'الكود المدخل خاطئ', '2021-09-15 06:56:57', '2021-09-26 13:08:31'),
(73705, 'sa', 'You have exceeded the maximum number of messages', 'لقد وصلت للحد الاقصى من الرسائل', '2021-09-15 06:56:57', '2021-09-26 13:08:31'),
(73706, 'sa', 'the name is required', 'الاسم مطلوب', '2021-09-15 07:50:52', '2021-09-26 13:08:31'),
(73707, 'sa', 'the password is required', 'كلمة المرور مطلوبة', '2021-09-15 07:50:52', '2021-09-26 13:08:31'),
(73708, 'sa', 'the email is required', 'البريد مطلوب', '2021-09-15 07:50:52', '2021-09-26 13:08:31'),
(73709, 'sa', 'the phone is required', 'رقم الجوال مطلوب', '2021-09-15 07:50:52', '2021-09-26 13:08:31'),
(73710, 'sa', 'phone not match country', 'رقم الجوال لا يطابق الدولة', '2021-09-15 08:59:52', '2021-09-26 13:08:31'),
(73711, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 5859 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 5859 شامل الضريبه والشحن', '2021-09-15 09:06:19', '2021-09-15 09:06:19'),
(73712, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 5208 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 5208 شامل الضريبه والشحن', '2021-09-15 09:06:19', '2021-09-15 09:06:19'),
(73713, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 4557 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 4557 شامل الضريبه والشحن', '2021-09-15 09:06:19', '2021-09-15 09:06:19'),
(73714, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 3906 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 3906 شامل الضريبه والشحن', '2021-09-15 09:06:19', '2021-09-15 09:06:19'),
(73715, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 3255 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 3255 شامل الضريبه والشحن', '2021-09-15 09:06:20', '2021-09-15 09:06:20'),
(73716, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 2604 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 2604 شامل الضريبه والشحن', '2021-09-15 09:06:20', '2021-09-15 09:06:20'),
(73717, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 1953 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1953 شامل الضريبه والشحن', '2021-09-15 09:06:20', '2021-09-15 09:06:20'),
(73718, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 1302 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1302 شامل الضريبه والشحن', '2021-09-15 09:06:20', '2021-09-15 09:06:20'),
(73719, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 529 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 529 شامل الضريبه والشحن', '2021-09-15 09:06:21', '2021-09-15 09:06:21'),
(73720, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 90 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 90 شامل الضريبه والشحن', '2021-09-15 09:06:21', '2021-09-15 09:06:21'),
(73721, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 45 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 45 شامل الضريبه والشحن', '2021-09-15 09:06:21', '2021-09-15 09:06:21'),
(73722, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 86 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 86 شامل الضريبه والشحن', '2021-09-15 09:06:22', '2021-09-15 09:06:22'),
(73723, 'sa', 'File Uploads', 'رفع الملفات', '2021-09-15 09:23:31', '2021-09-26 13:08:31'),
(73724, 'sa', 'Notes', 'الملاحظات', '2021-09-15 09:23:32', '2021-09-26 13:08:31'),
(73725, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 755 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 755 شامل الضريبه والشحن', '2021-09-15 09:25:36', '2021-09-15 09:25:36'),
(73726, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 755 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 755 شامل الضريبه والشحن', '2021-09-15 09:25:46', '2021-09-15 09:25:46'),
(73727, 'sa', 'Update Currency', 'تحديث العملة', '2021-09-15 09:50:03', '2021-09-26 13:08:31'),
(73728, 'sa', 'Symbol', 'الرمز', '2021-09-15 09:50:03', '2021-09-26 13:08:31'),
(73729, 'sa', 'Currency updated successfully', 'تم تحديث العملة بنجاح', '2021-09-15 09:50:21', '2021-09-26 13:08:31'),
(73730, 'sa', 'remove all carts', 'ازالة جميع العربات', '2021-09-15 13:03:33', '2021-09-26 13:06:27'),
(73731, 'en', 'remove all carts', 'remove all carts', '2021-09-15 13:04:07', '2021-09-15 13:04:07'),
(73732, 'en', 'remove all carts', 'remove all carts', '2021-09-15 13:04:07', '2021-09-15 13:04:07'),
(73733, 'sa', 'all Items has been removed from cart', 'تم ازالة جميع العناصر', '2021-09-15 13:19:44', '2021-09-26 13:06:27'),
(73734, 'en', 'all Items has been removed from cart', 'all Items has been removed from cart', '2021-09-15 13:20:59', '2021-09-15 13:20:59'),
(73735, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 6340 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 6340 شامل الضريبه والشحن', '2021-09-15 13:42:54', '2021-09-15 13:42:54'),
(73736, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 5706 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 5706 شامل الضريبه والشحن', '2021-09-15 13:42:54', '2021-09-15 13:42:54'),
(73737, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 5072 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 5072 شامل الضريبه والشحن', '2021-09-15 13:42:54', '2021-09-15 13:42:54'),
(73738, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 1830 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1830 شامل الضريبه والشحن', '2021-09-15 13:49:15', '2021-09-15 13:49:15'),
(73739, 'sa', 'Product Image', 'صورة المنتج', '2021-09-15 14:05:20', '2021-09-26 13:06:27'),
(73740, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 105 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 105 شامل الضريبه والشحن', '2021-09-15 14:11:37', '2021-09-15 14:11:37'),
(73741, 'en', 'الزبون var_user يضيف منتج جديد في السله سعره 915 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 915 شامل الضريبه والشحن', '2021-09-15 14:11:37', '2021-09-15 14:11:37'),
(73742, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 1830 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1830 شامل الضريبه والشحن', '2021-09-15 14:11:37', '2021-09-15 14:11:37'),
(73743, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 6340 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 6340 شامل الضريبه والشحن', '2021-09-15 14:11:37', '2021-09-15 14:11:37'),
(73744, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 5706 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 5706 شامل الضريبه والشحن', '2021-09-15 14:11:38', '2021-09-15 14:11:38'),
(73745, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 5072 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 5072 شامل الضريبه والشحن', '2021-09-15 14:11:38', '2021-09-15 14:11:38'),
(73746, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 105 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 105 شامل الضريبه والشحن', '2021-09-15 14:11:41', '2021-09-15 14:11:41'),
(73747, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 915 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 915 شامل الضريبه والشحن', '2021-09-15 14:11:41', '2021-09-15 14:11:41'),
(73748, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 415 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 415 شامل الضريبه والشحن', '2021-09-15 14:11:41', '2021-09-15 14:11:41'),
(73749, 'sa', 'please wait 12 hours to return resend code', 'برجاء الانتظار 12 ساعه لإعادة ارسال الكود', '2021-09-19 10:49:16', '2021-09-26 13:06:27'),
(73750, 'sa', 'The code you entered is wrong please check number code', 'الكود المدخل خاطئ ، برجاء التاكد من الكود', '2021-09-19 10:49:16', '2021-09-26 13:06:27'),
(73751, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 315 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 315 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73752, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 493 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 493 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73753, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 986 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 986 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73754, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 3775 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 3775 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73755, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 3020 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 3020 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73756, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 2265 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 2265 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73757, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 1510 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1510 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73758, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 1497 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1497 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73759, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 998 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 998 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73760, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 499 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 499 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73761, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 1755 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1755 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73762, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 3476 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 3476 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73763, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 32 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 32 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73764, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 64 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 64 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73765, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 1806 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1806 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73766, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 340 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 340 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73767, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 919 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 919 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73768, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 155 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 155 شامل الضريبه والشحن', '2021-09-19 23:52:27', '2021-09-19 23:52:27'),
(73769, 'sa', 'Item has Not from same Categorey', 'العناصر ليست من نفس الفئة', '2021-09-20 11:48:06', '2021-09-26 13:06:27'),
(73770, 'sa', 'No account exists with this email', 'لا يوجد حساب مربوط بهذا البريد', '2021-09-21 06:31:19', '2021-09-26 13:06:27'),
(73771, 'sa', 'Premium Packages for Customers', 'Premium Packages for Customers', '2021-09-21 06:32:42', '2021-09-21 06:32:42'),
(73772, 'sa', 'Offline Package Purchase ', 'Offline Package Purchase', '2021-09-21 06:32:42', '2021-09-26 13:06:27'),
(73773, 'sa', 'has not been verified yet.', 'لم يتم التحقق بعد', '2021-09-21 07:27:28', '2021-09-26 13:06:27'),
(73774, 'sa', 'Shop Verification', 'التحقق من المتجر', '2021-09-21 07:28:34', '2021-09-26 13:06:27'),
(73775, 'sa', 'Your shop verification request has been submitted successfully!', 'تم ارسال طلب التحقق من المتجر بنجاح', '2021-09-21 07:30:30', '2021-09-26 13:06:27'),
(73776, 'sa', 'Sorry! You have sent verification request already.', 'عفوا ، لقد قمت بإرسال طلب التحقق بالفعل', '2021-09-21 07:31:19', '2021-09-26 13:06:27'),
(73777, 'sa', 'Message has been send to seller', 'تم ارسال الرساله للبائع', '2021-09-21 08:20:51', '2021-09-26 13:06:27'),
(73778, 'sa', 'Your request is pending', 'طلبك قيد المتابعه', '2021-09-23 07:03:19', '2021-09-26 13:06:27'),
(73779, 'sa', 'show products', 'اعرض المنتجات', '2021-09-23 08:06:57', '2021-09-26 13:06:27'),
(73780, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 34500 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 34500 شامل الضريبه والشحن', '2021-09-23 13:36:27', '2021-09-23 13:36:27'),
(73781, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 1725 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1725 شامل الضريبه والشحن', '2021-09-23 13:36:27', '2021-09-23 13:36:27'),
(73782, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 26448.85 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 26448.85 شامل الضريبه والشحن', '2021-09-23 13:36:27', '2021-09-23 13:36:27'),
(73783, 'sa', 'please Login to can put Wishlists', 'برجاء تسجيل الدخول للحفظ بقائمة المفضلة', '2021-09-25 10:41:18', '2021-09-26 13:01:40'),
(73784, 'sa', 'Your Wishlist is empty', 'قائمة رغباتك فارغه', '2021-09-25 10:42:50', '2021-09-26 13:01:40'),
(73785, 'sa', 'Wishlist Items', 'عناصر قائمة الرغبات', '2021-09-25 10:43:01', '2021-09-26 13:01:40'),
(73786, 'sa', 'View Wishlist', 'عرض قائمة الرغبات', '2021-09-25 10:43:01', '2021-09-26 13:01:40'),
(73787, 'sa', 'Pickup Point Information', 'معلومات نقطة الالتقاط', '2021-09-25 12:48:41', '2021-09-26 13:06:27'),
(73788, 'sa', 'Pickup Point Status', 'حالة نقطة الالتقاط', '2021-09-25 12:48:41', '2021-09-26 13:06:27'),
(73789, 'sa', 'Pick-up Point Manager', 'مدير نقطة الالتقاط', '2021-09-25 12:48:41', '2021-09-26 13:03:16'),
(73790, 'sa', 'City has been inserted successfully', 'تم ادخال المدينه بنجاح', '2021-09-25 12:49:34', '2021-09-26 13:03:16'),
(73791, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 498 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 498 شامل الضريبه والشحن', '2021-09-25 13:30:22', '2021-09-25 13:30:22'),
(73792, 'sa', 'Write script admin with <script> tag', 'Write script admin with <script> tag', '2021-09-26 09:13:49', '2021-09-26 09:13:49'),
(73793, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 751 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 751 شامل الضريبه والشحن', '2021-09-26 10:47:57', '2021-09-26 10:47:57'),
(73794, 'sa', 'Contact', 'التواصل', '2021-09-26 11:17:43', '2021-09-26 13:03:16'),
(73795, 'sa', 'order files', 'ملفات الطلب', '2021-09-26 11:25:57', '2021-09-26 13:03:16'),
(73796, 'sa', 'notes on products', 'ملاحظات على المنتج', '2021-09-26 11:26:09', '2021-09-26 13:03:16'),
(73797, 'sa', 'Tax Information', 'Tax Information', '2021-09-26 13:24:47', '2021-09-26 13:24:47'),
(73798, 'sa', 'update Tax Info', 'update Tax Info', '2021-09-26 13:24:47', '2021-09-26 13:24:47'),
(73799, 'sa', 'Tax has been updated successfully', 'Tax has been updated successfully', '2021-09-26 13:25:05', '2021-09-26 13:25:05'),
(73800, 'sa', 'PicupPoint has been inserted successfully', 'PicupPoint has been inserted successfully', '2021-09-26 13:26:02', '2021-09-26 13:26:02'),
(73801, 'sa', 'the Customer var_user Add New Product In Baskets a Price 751 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 751 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73802, 'sa', 'the Customer var_user Add New Product In Baskets a Price 755 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 755 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73803, 'sa', 'the Customer var_user Add New Product In Baskets a Price 1725 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 1725 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73804, 'sa', 'the Customer var_user Add New Product In Baskets a Price 498 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 498 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73805, 'sa', 'the Customer var_user Add New Product In Baskets a Price 105 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 105 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73806, 'sa', 'the Customer var_user Add New Product In Baskets a Price 493 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 493 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73807, 'sa', 'the Customer var_user Add New Product In Baskets a Price 1830 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 1830 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73808, 'sa', 'the Customer var_user Add New Product In Baskets a Price 915 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 915 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73809, 'sa', 'the Customer var_user Add New Product In Baskets a Price 34500 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 34500 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73810, 'sa', 'the Customer var_user Add New Product In Baskets a Price 26448.85 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 26448.85 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73811, 'sa', 'the Customer var_user Add New Product In Baskets a Price 315 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 315 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73812, 'sa', 'the Customer var_user Add New Product In Baskets a Price 986 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 986 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73813, 'sa', 'the Customer var_user Add New Product In Baskets a Price 3775 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 3775 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73814, 'sa', 'the Customer var_user Add New Product In Baskets a Price 3020 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 3020 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73815, 'sa', 'the Customer var_user Add New Product In Baskets a Price 2265 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 2265 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73816, 'sa', 'the Customer var_user Add New Product In Baskets a Price 1510 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 1510 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73817, 'sa', 'the Customer var_user Add New Product In Baskets a Price 1497 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 1497 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73818, 'sa', 'the Customer var_user Add New Product In Baskets a Price 998 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 998 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73819, 'sa', 'the Customer var_user Add New Product In Baskets a Price 499 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 499 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73820, 'sa', 'the Customer var_user Add New Product In Baskets a Price 1755 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 1755 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73821, 'sa', 'the Customer var_user Add New Product In Baskets a Price 3476 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 3476 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:44', '2021-09-26 18:43:44'),
(73822, 'sa', 'the Customer var_user Add New Product In Baskets a Price 1302 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 1302 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:45', '2021-09-26 18:43:45'),
(73823, 'sa', 'the Customer var_user Add New Product In Baskets a Price 32 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 32 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:45', '2021-09-26 18:43:45'),
(73824, 'sa', 'the Customer var_user Add New Product In Baskets a Price 64 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 64 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:45', '2021-09-26 18:43:45'),
(73825, 'sa', 'the Customer var_user Add New Product In Baskets a Price 1806 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 1806 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:45', '2021-09-26 18:43:45'),
(73826, 'sa', 'the Customer var_user Add New Product In Baskets a Price 155 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 155 Inclusive of Tax and Shipping sssssssssss', '2021-09-26 18:43:45', '2021-09-26 18:43:45'),
(73827, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 830 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 830 شامل الضريبه والشحن', '2021-09-29 11:09:06', '2021-09-29 11:09:06'),
(73828, 'sa', 'order created at', 'order created at', '2021-09-29 11:26:22', '2021-09-29 11:26:22'),
(73829, 'sa', 'review this is order', 'review this is order', '2021-09-29 11:26:22', '2021-09-29 11:26:22'),
(73830, 'sa', 'show msg add card', 'show msg add card', '2021-09-29 11:26:22', '2021-09-29 11:26:22'),
(73831, 'sa', 'No payment history available for this seller', 'No payment history available for this seller', '2021-09-29 11:27:59', '2021-09-29 11:27:59'),
(73832, 'sa', 'This offer has been expired.', 'This offer has been expired.', '2021-09-29 11:45:02', '2021-09-29 11:45:02'),
(73833, 'sa', 'currency styleSheet', 'currency styleSheet', '2021-10-01 11:39:01', '2021-10-01 11:39:01'),
(73834, 'sa', 'Write style without <style> tag', 'Write style without <style> tag', '2021-10-01 11:39:01', '2021-10-01 11:39:01'),
(73835, 'sa', 'currency del styleSheet', 'currency del styleSheet', '2021-10-01 11:39:01', '2021-10-01 11:39:01'),
(73836, 'sa', 'City Information', 'City Information', '2021-10-01 12:42:09', '2021-10-01 12:42:09'),
(73837, 'sa', 'the Customer var_user Add New Product In Baskets a Price 830 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 830 Inclusive of Tax and Shipping sssssssssss', '2021-10-02 08:27:55', '2021-10-02 08:27:55'),
(73838, 'sa', 'New page has been created successfully', 'New page has been created successfully', '2021-10-02 09:57:23', '2021-10-02 09:57:23'),
(73839, 'sa', 'Page has been deleted successfully', 'Page has been deleted successfully', '2021-10-02 10:17:27', '2021-10-02 10:17:27'),
(73840, 'sa', 'Slug has been used already', 'Slug has been used already', '2021-10-02 10:18:35', '2021-10-02 10:18:35'),
(73841, 'sa', 'Page has been updated successfully', 'Page has been updated successfully', '2021-10-02 10:22:47', '2021-10-02 10:22:47'),
(73842, 'sa', 'Return Policy Page', 'Return Policy Page', '2021-10-02 13:55:40', '2021-10-02 13:55:40'),
(73843, 'sa', 'Shop Info', 'Shop Info', '2021-10-03 10:07:42', '2021-10-03 10:07:42'),
(73844, 'sa', 'Address info updated successfully', 'Address info updated successfully', '2021-10-03 10:18:10', '2021-10-03 10:18:10'),
(73845, 'sa', 'You do not have enough balance to send withdraw request', 'You do not have enough balance to send withdraw request', '2021-10-03 10:18:48', '2021-10-03 10:18:48');
INSERT INTO `translations` (`id`, `lang`, `lang_key`, `lang_value`, `created_at`, `updated_at`) VALUES
(73846, 'sa', 'Order Deleted', 'Order Deleted', '2021-10-03 10:23:49', '2021-10-03 10:23:49'),
(73847, 'sa', 'City has been deleted successfully', 'City has been deleted successfully', '2021-10-03 10:53:53', '2021-10-03 10:53:53'),
(73848, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 69000 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 69000 شامل الضريبه والشحن', '2021-10-03 10:53:56', '2021-10-03 10:53:56'),
(73849, 'sa', 'all Items has been removed from wichlist', 'all Items has been removed from wichlist', '2021-10-05 11:45:43', '2021-10-05 11:45:43'),
(73850, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 2745 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 2745 شامل الضريبه والشحن', '2021-10-06 08:55:53', '2021-10-06 08:55:53'),
(73851, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 3594.141 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 3594.141 شامل الضريبه والشحن', '2021-10-06 10:15:32', '2021-10-06 10:15:32'),
(73852, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 7188.282 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 7188.282 شامل الضريبه والشحن', '2021-10-06 10:46:46', '2021-10-06 10:46:46'),
(73853, 'sa', 'the Customer var_user Add New Product In Baskets a Price 3594.141 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 3594.141 Inclusive of Tax and Shipping sssssssssss', '2021-10-09 07:31:59', '2021-10-09 07:31:59'),
(73854, 'sa', 'the Customer var_user Add New Product In Baskets a Price 7188.282 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 7188.282 Inclusive of Tax and Shipping sssssssssss', '2021-10-09 07:31:59', '2021-10-09 07:31:59'),
(73855, 'sa', 'the Customer var_user Add New Product In Baskets a Price 2745 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 2745 Inclusive of Tax and Shipping sssssssssss', '2021-10-09 07:31:59', '2021-10-09 07:31:59'),
(73856, 'sa', 'the Customer var_user Add New Product In Baskets a Price 69000 Inclusive of Tax and Shipping sssssssssss', 'the Customer var_user Add New Product In Baskets a Price 69000 Inclusive of Tax and Shipping sssssssssss', '2021-10-09 07:31:59', '2021-10-09 07:31:59'),
(73857, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 1698 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1698 شامل الضريبه والشحن', '2021-10-10 14:00:40', '2021-10-10 14:00:40'),
(73858, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 849 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 849 شامل الضريبه والشحن', '2021-10-10 14:00:40', '2021-10-10 14:00:40'),
(73859, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 2492 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 2492 شامل الضريبه والشحن', '2021-10-10 14:00:40', '2021-10-10 14:00:40'),
(73860, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 1869 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 1869 شامل الضريبه والشحن', '2021-10-10 14:00:40', '2021-10-10 14:00:40'),
(73861, 'sa', 'Please enter your file ', 'Please enter your file ', '2021-10-10 14:03:31', '2021-10-10 14:03:31'),
(73862, 'sa', 'Cities imported successfully is number ', 'Cities imported successfully is number ', '2021-10-10 14:14:44', '2021-10-10 14:14:44'),
(73863, 'sa', 'the data entered before ', 'the data entered before ', '2021-10-10 14:17:31', '2021-10-10 14:17:31'),
(73864, 'sa', 'Tax not included', 'Tax not included', '2021-10-11 11:39:26', '2021-10-11 11:39:26'),
(73865, 'sa', 'done', 'done', '2021-10-14 09:13:18', '2021-10-14 09:13:18'),
(73866, 'sa', 'from', 'من', '2021-10-14 09:13:18', '2021-10-14 09:16:35'),
(73867, 'sa', 'SAR', 'ريال', '2021-10-14 09:31:34', '2021-10-14 09:32:16'),
(73868, 'sa', 'Choose All', 'Choose All', '2021-11-01 07:40:33', '2021-11-01 07:40:33'),
(73869, 'sa', 'please check product', 'please check product', '2021-11-01 07:40:33', '2021-11-01 07:40:33'),
(73870, 'sa', 'not found cities to shipping', 'not found cities to shipping', '2021-11-01 09:39:34', '2021-11-01 09:39:34'),
(73871, 'sa', '1. Category and Brand should be in numerical id.', '1. Category and Brand should be in numerical id.', '2021-11-07 06:18:46', '2021-11-07 06:18:46'),
(73872, 'sa', '2. You can download the pdf to get Category and Brand id.', '2. You can download the pdf to get Category and Brand id.', '2021-11-07 06:18:46', '2021-11-07 06:18:46'),
(73873, 'sa', 'tap payment', 'tap payment', '2021-11-08 14:26:15', '2021-11-08 14:26:15'),
(73874, 'sa', 'Success! Your token is', 'Success! Your token is', '2021-11-08 14:26:15', '2021-11-08 14:26:15'),
(73875, 'sa', 'Submit', 'Submit', '2021-11-08 14:26:15', '2021-11-08 14:26:15'),
(73876, 'sa', 'geza', 'geza', '2021-11-09 09:33:59', '2021-11-09 09:33:59'),
(73877, 'sa', 'mansora', 'mansora', '2021-11-09 09:33:59', '2021-11-09 09:33:59'),
(73878, 'sa', 'Product has been duplicated successfully', 'Product has been duplicated successfully', '2021-11-09 10:10:06', '2021-11-09 10:10:06'),
(73879, 'sa', 'Default', 'Default', '2021-11-15 06:42:39', '2021-11-15 06:42:39'),
(73880, 'sa', 'Shipping Home', 'Shipping Home', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73881, 'sa', 'Public Point', 'Public Point', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73882, 'sa', 'Add Address', 'Add Address', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73883, 'sa', 'Enter Your Address', 'Enter Your Address', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73884, 'sa', 'Choose Governorate', 'Choose Governorate', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73885, 'sa', 'Choose City', 'Choose City', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73886, 'sa', 'please enter postal code', 'please enter postal code', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73887, 'sa', 'please enter phone', 'please enter phone', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73888, 'sa', 'please enter address', 'please enter address', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73889, 'sa', 'please enter country', 'please enter country', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73890, 'sa', 'please enter governorate', 'please enter governorate', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73891, 'sa', 'please enter city', 'please enter city', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73892, 'sa', 'Local Shipment', 'Local Shipment', '2021-11-17 10:59:38', '2021-11-17 10:59:38'),
(73893, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 4530 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 4530 شامل الضريبه والشحن', '2021-11-17 11:34:01', '2021-11-17 11:34:01'),
(73894, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 5750 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 5750 شامل الضريبه والشحن', '2021-11-17 11:34:01', '2021-11-17 11:34:01'),
(73895, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 7077 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 7077 شامل الضريبه والشحن', '2021-11-17 11:34:01', '2021-11-17 11:34:01'),
(73896, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 24541 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 24541 شامل الضريبه والشحن', '2021-11-17 11:34:01', '2021-11-17 11:34:01'),
(73897, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 12270.5 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 12270.5 شامل الضريبه والشحن', '2021-11-17 11:34:01', '2021-11-17 11:34:01'),
(73898, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 15119.487 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 15119.487 شامل الضريبه والشحن', '2021-11-17 11:34:01', '2021-11-17 11:34:01'),
(73899, 'sa', 'الزبون var_user يضيف منتج جديد في السله سعره 210 شامل الضريبه والشحن', 'الزبون var_user يضيف منتج جديد في السله سعره 210 شامل الضريبه والشحن', '2021-11-17 11:34:02', '2021-11-17 11:34:02'),
(73900, 'sa', 'Shipping Governorates', 'Shipping Governorates', '2021-11-17 11:36:31', '2021-11-17 11:36:31'),
(73901, 'sa', 'Governorate Name', 'Governorate Name', '2021-11-17 11:37:26', '2021-11-17 11:37:26'),
(73902, 'sa', 'Governorates', 'Governorates', '2021-11-17 11:37:26', '2021-11-17 11:37:26'),
(73903, 'sa', 'Country Name', 'Country Name', '2021-11-17 11:37:26', '2021-11-17 11:37:26'),
(73904, 'sa', 'add governorate', 'add governorate', '2021-11-17 11:37:26', '2021-11-17 11:37:26'),
(73905, 'sa', 'please enter governorate name', 'please enter governorate name', '2021-11-17 11:37:26', '2021-11-17 11:37:26'),
(73906, 'sa', 'City Name', 'City Name', '2021-11-17 11:38:11', '2021-11-17 11:38:11'),
(73907, 'sa', 'search city name', 'search city name', '2021-11-17 11:38:11', '2021-11-17 11:38:11'),
(73908, 'sa', 'please enter shipping days', 'please enter shipping days', '2021-11-17 11:38:11', '2021-11-17 11:38:11'),
(73909, 'sa', 'please enter cost', 'please enter cost', '2021-11-17 11:38:11', '2021-11-17 11:38:11'),
(73910, 'sa', 'Edit Address', 'Edit Address', '2021-11-17 11:38:11', '2021-11-17 11:38:11'),
(73911, 'sa', 'Pool Area', 'Pool Area', '2021-11-17 12:07:41', '2021-11-17 12:07:41'),
(73912, 'sa', 'Governorate', 'Governorate', '2021-11-17 13:26:02', '2021-11-17 13:26:02'),
(73913, 'sa', 'Pool Areas', 'Pool Areas', '2021-11-17 13:26:02', '2021-11-17 13:26:02'),
(73914, 'sa', 'area', 'area', '2021-11-17 13:26:02', '2021-11-17 13:26:02'),
(73915, 'sa', 'Please Enter adress', 'Please Enter adress', '2021-11-17 22:04:21', '2021-11-17 22:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `file_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `referred_by` int(11) DEFAULT NULL,
  `provider_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'customer',
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_code` text COLLATE utf8_unicode_ci,
  `new_email_verificiation_code` text COLLATE utf8_unicode_ci,
  `password` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_original` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `balance` double(20,2) NOT NULL DEFAULT '0.00',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `referral_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_package_id` int(11) DEFAULT NULL,
  `remaining_uploads` int(11) DEFAULT '0',
  `country_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `referred_by`, `provider_id`, `user_type`, `name`, `email`, `email_verified_at`, `verification_code`, `new_email_verificiation_code`, `password`, `remember_token`, `avatar`, `avatar_original`, `address`, `country`, `city`, `postal_code`, `phone`, `balance`, `banned`, `referral_code`, `customer_package_id`, `remaining_uploads`, `country_id`, `created_at`, `updated_at`) VALUES
(9, NULL, NULL, 'admin', 'admin', 'i@hamada.io', '2021-04-20 11:04:51', NULL, NULL, '$2y$10$JufvLCR9kog.uM0jYy5LYe2Z/YLpkEK7b.yulObM.T4naqkyJtFP6', 'TwujkPWh2iNrx0OLBTj1w7f0BzfmWYk7Ew5EiJ6BW7e1TAktwoQMFxRS6jKr', NULL, NULL, NULL, NULL, NULL, NULL, '01020760530', 518.00, 0, NULL, NULL, 0, NULL, '2021-04-20 11:26:51', '2021-05-06 02:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double(20,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_details` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_translations`
--
ALTER TABLE `attribute_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand_translations`
--
ALTER TABLE `brand_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_settings`
--
ALTER TABLE `business_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_files`
--
ALTER TABLE `cart_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `category_translations`
--
ALTER TABLE `category_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_translations`
--
ALTER TABLE `city_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_histories`
--
ALTER TABLE `commission_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_packages`
--
ALTER TABLE `customer_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_package_payments`
--
ALTER TABLE `customer_package_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_package_translations`
--
ALTER TABLE `customer_package_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_products`
--
ALTER TABLE `customer_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_product_translations`
--
ALTER TABLE `customer_product_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fekrait_failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fekrait_activities`
--
ALTER TABLE `fekrait_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_deals`
--
ALTER TABLE `flash_deals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_deal_products`
--
ALTER TABLE `flash_deal_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_deal_translations`
--
ALTER TABLE `flash_deal_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `governorates`
--
ALTER TABLE `governorates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_categories`
--
ALTER TABLE `home_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fekrait_jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `local_shipment_addresses`
--
ALTER TABLE `local_shipment_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details_files`
--
ALTER TABLE `order_details_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_card_fawry_token_users`
--
ALTER TABLE `payment_card_fawry_token_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paytabs_invoices`
--
ALTER TABLE `paytabs_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickup_points`
--
ALTER TABLE `pickup_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pickup_point_translations`
--
ALTER TABLE `pickup_point_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices_system`
--
ALTER TABLE `prices_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `tags` (`tags`(255));

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_taxes`
--
ALTER TABLE `product_taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_translations`
--
ALTER TABLE `product_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminder_baskets`
--
ALTER TABLE `reminder_baskets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reminder_customers`
--
ALTER TABLE `reminder_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_translations`
--
ALTER TABLE `role_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `seller_withdraw_requests`
--
ALTER TABLE `seller_withdraw_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_offers`
--
ALTER TABLE `special_offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_offers_customer_purchase`
--
ALTER TABLE `special_offers_customer_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_offers_product`
--
ALTER TABLE `special_offers_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_offers_xy`
--
ALTER TABLE `special_offers_xy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_discount`
--
ALTER TABLE `temporary_discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `text_area`
--
ALTER TABLE `text_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `addons`
--
ALTER TABLE `addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute_translations`
--
ALTER TABLE `attribute_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brand_translations`
--
ALTER TABLE `brand_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `business_settings`
--
ALTER TABLE `business_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=471;

--
-- AUTO_INCREMENT for table `cart_files`
--
ALTER TABLE `cart_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category_translations`
--
ALTER TABLE `category_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `city_translations`
--
ALTER TABLE `city_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `commission_histories`
--
ALTER TABLE `commission_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99969;

--
-- AUTO_INCREMENT for table `customer_packages`
--
ALTER TABLE `customer_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_package_payments`
--
ALTER TABLE `customer_package_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_package_translations`
--
ALTER TABLE `customer_package_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_products`
--
ALTER TABLE `customer_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_product_translations`
--
ALTER TABLE `customer_product_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fekrait_activities`
--
ALTER TABLE `fekrait_activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `flash_deals`
--
ALTER TABLE `flash_deals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `flash_deal_products`
--
ALTER TABLE `flash_deal_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `flash_deal_translations`
--
ALTER TABLE `flash_deal_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `governorates`
--
ALTER TABLE `governorates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_categories`
--
ALTER TABLE `home_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_shipment_addresses`
--
ALTER TABLE `local_shipment_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=758;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144425;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143990;

--
-- AUTO_INCREMENT for table `order_details_files`
--
ALTER TABLE `order_details_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_card_fawry_token_users`
--
ALTER TABLE `payment_card_fawry_token_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paytabs_invoices`
--
ALTER TABLE `paytabs_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickup_points`
--
ALTER TABLE `pickup_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pickup_point_translations`
--
ALTER TABLE `pickup_point_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prices_system`
--
ALTER TABLE `prices_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194956;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195249;

--
-- AUTO_INCREMENT for table `product_taxes`
--
ALTER TABLE `product_taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194994;

--
-- AUTO_INCREMENT for table `product_translations`
--
ALTER TABLE `product_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194697;

--
-- AUTO_INCREMENT for table `reminder_baskets`
--
ALTER TABLE `reminder_baskets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reminder_customers`
--
ALTER TABLE `reminder_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143626;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_translations`
--
ALTER TABLE `role_translations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `searches`
--
ALTER TABLE `searches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11145;

--
-- AUTO_INCREMENT for table `seller_withdraw_requests`
--
ALTER TABLE `seller_withdraw_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11142;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `special_offers`
--
ALTER TABLE `special_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `special_offers_customer_purchase`
--
ALTER TABLE `special_offers_customer_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `special_offers_product`
--
ALTER TABLE `special_offers_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `special_offers_xy`
--
ALTER TABLE `special_offers_xy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temporary_discount`
--
ALTER TABLE `temporary_discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `text_area`
--
ALTER TABLE `text_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73916;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111124;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
