-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2021 at 03:23 PM
-- Server version: 10.3.28-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bigshot_live`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) DEFAULT 1,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `phone`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin@email.com', '$2y$10$kWxHZoXuhxBiFY/vdokU0u9REwpd7EWV7kekYFaS6Kd9ro6fLwK4S', '65756756', 1, '1', '2020-10-28 12:11:44', '2020-10-29 05:18:53'),
(4, 'sahin', 'asdsad', 'sadasd', 'asdsadas', 3, 'asdsadsa', NULL, '2020-12-22 05:46:42'),
(5, 'sohel', 'sohel@gmail.com', '$2y$10$EAowdcACPEPaLr8YvxIoDexW5YXHwhrJrQKivOhSGfgzR8baHh6kK', '', 10, '1', '2021-01-09 04:29:32', '2021-01-09 04:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `key_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permissions` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumer_key` char(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumer_secret` char(43) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nonces` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `truncated_key` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_access` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_taxonomies`
--

CREATE TABLE `attribute_taxonomies` (
  `attribute_id` bigint(20) NOT NULL,
  `attribute_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_label` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_orderby` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `attribute_public` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_taxonomies`
--

INSERT INTO `attribute_taxonomies` (`attribute_id`, `attribute_name`, `attribute_label`, `attribute_type`, `attribute_orderby`, `status`, `attribute_public`, `created_at`, `updated_at`) VALUES
(1, 'color', 'color', 'select', 'menu_order', 1, 1, '2020-12-27 18:20:29', '2020-12-27 18:20:29'),
(2, 'Size', 'size', 'select', 'menu_order', 1, 1, '2020-12-27 18:20:32', '2020-12-27 18:20:32'),
(3, 'sdsdasd', 'sdsdasd', 'select', 'menu_order', 1, 1, '2021-04-05 01:25:21', '2021-04-05 01:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_amount` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `expire_date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `coupon_amount`, `coupon_type`, `expire_date`, `status`, `created_at`, `updated_at`) VALUES
(3, '85', '300', '1', '2021-03-20', 1, NULL, NULL),
(4, 'ten', '10', '2', '2021-03-20', 1, NULL, NULL),
(5, 'Newyear21', '10', '2', '2021-04-30', 1, NULL, NULL),
(6, 'SAVE50', '20', '1', '2021-01-10', 1, NULL, NULL),
(7, 'arif', '300', '1', '2021-03-22', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ecommerce_termmeta`
--

CREATE TABLE `ecommerce_termmeta` (
  `meta_id` bigint(20) NOT NULL,
  `ecommerce_term_id` bigint(20) NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL,
  `level` smallint(4) NOT NULL,
  `source` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `context` longtext COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_07_11_100407_create_admins_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 2),
(5, '2020_09_14_100203_create_wishlist', 2),
(10, '2020_10_28_105612_create_roles_table', 3),
(11, '2020_10_28_105713_create_permissions_table', 3),
(12, '2020_10_28_152329_create_permissions_table', 4),
(13, '2020_10_28_152345_create_roles_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'Delivery Condition', '10000', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `order_itemmeta`
--

CREATE TABLE `order_itemmeta` (
  `meta_id` bigint(20) NOT NULL,
  `order_item_id` bigint(20) NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_parent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_itemmeta`
--

INSERT INTO `order_itemmeta` (`meta_id`, `order_item_id`, `meta_key`, `meta_value`, `order_id`, `order_date`, `customer_id`, `product_id`, `product_parent`) VALUES
(1, 1, '_tax_class', '', '158', '2021-04-04', '0', '50', '49'),
(2, 1, '_qty', '1', '158', '2021-04-04', '0', '50', '49'),
(3, 1, '_product_id', '50', '158', '2021-04-04', '0', '50', '49'),
(4, 1, '_variation_id', '', '158', '2021-04-04', '0', '50', '49'),
(5, 1, 'order_actual_cost', '600', '158', '2021-04-04', '0', '50', '49'),
(6, 1, 'order_product_cost', '600', '158', '2021-04-04', '0', '50', '49'),
(7, 1, '_line_subtotal', '1000', '158', '2021-04-04', '0', '50', '49'),
(8, 1, '_line_total', '1000', '158', '2021-04-04', '0', '50', '49'),
(9, 1, '_line_subtotal_tax', '', '158', '2021-04-04', '0', '50', '49'),
(10, 1, '_line_tax', '', '158', '2021-04-04', '0', '50', '49'),
(11, 1, '_line_tax_data', '2021-04-04 19:22:35', '158', '2021-04-04', '0', '50', '49'),
(12, 1, 'delivery_charge', '200', '158', '2021-04-04', '0', '50', '49'),
(13, 1, 'coupon_code', NULL, '158', '2021-04-04', '0', '50', '49'),
(14, 1, 'coupon_taka', '0', '158', '2021-04-04', '0', '50', '49'),
(15, 1, 'attribute_parent', '50', '158', '2021-04-04', '0', '50', '49'),
(16, 1, 'user_district', 'Comilla', '158', '2021-04-04', '0', '50', '49'),
(17, 1, 'user_city', 'Laksham', '158', '2021-04-04', '0', '50', '49'),
(18, 1, 'user_zip', '1300', '158', '2021-04-04', '0', '50', '49'),
(19, 2, '_tax_class', '', '158', '2021-04-04', '0', '4', '1'),
(20, 2, '_qty', '1', '158', '2021-04-04', '0', '4', '1'),
(21, 2, '_product_id', '4', '158', '2021-04-04', '0', '4', '1'),
(22, 2, '_variation_id', '', '158', '2021-04-04', '0', '4', '1'),
(23, 2, 'order_actual_cost', '900', '158', '2021-04-04', '0', '4', '1'),
(24, 2, 'order_product_cost', '900', '158', '2021-04-04', '0', '4', '1'),
(25, 2, '_line_subtotal', '1000', '158', '2021-04-04', '0', '4', '1'),
(26, 2, '_line_total', '1000', '158', '2021-04-04', '0', '4', '1'),
(27, 2, '_line_subtotal_tax', '', '158', '2021-04-04', '0', '4', '1'),
(28, 2, '_line_tax', '', '158', '2021-04-04', '0', '4', '1'),
(29, 2, '_line_tax_data', '2021-04-04 19:22:35', '158', '2021-04-04', '0', '4', '1'),
(30, 2, 'delivery_charge', '200', '158', '2021-04-04', '0', '4', '1'),
(31, 2, 'coupon_code', NULL, '158', '2021-04-04', '0', '4', '1'),
(32, 2, 'coupon_taka', '0', '158', '2021-04-04', '0', '4', '1'),
(33, 2, 'attribute_parent', '4', '158', '2021-04-04', '0', '4', '1'),
(34, 2, 'user_district', 'Comilla', '158', '2021-04-04', '0', '4', '1'),
(35, 2, 'user_city', 'Laksham', '158', '2021-04-04', '0', '4', '1'),
(36, 2, 'user_zip', '1300', '158', '2021-04-04', '0', '4', '1'),
(37, 3, '_tax_class', '', '159', '2021-04-04', '5', '2', '1'),
(38, 3, '_qty', '1', '159', '2021-04-04', '5', '2', '1'),
(39, 3, '_product_id', '2', '159', '2021-04-04', '5', '2', '1'),
(40, 3, '_variation_id', '', '159', '2021-04-04', '5', '2', '1'),
(41, 3, 'order_actual_cost', '900', '159', '2021-04-04', '5', '2', '1'),
(42, 3, 'order_product_cost', '900', '159', '2021-04-04', '5', '2', '1'),
(43, 3, '_line_subtotal', '1000', '159', '2021-04-04', '5', '2', '1'),
(44, 3, '_line_total', '1000', '159', '2021-04-04', '5', '2', '1'),
(45, 3, '_line_subtotal_tax', '', '159', '2021-04-04', '5', '2', '1'),
(46, 3, '_line_tax', '', '159', '2021-04-04', '5', '2', '1'),
(47, 3, '_line_tax_data', '2021-04-04 19:23:21', '159', '2021-04-04', '5', '2', '1'),
(48, 3, 'delivery_charge', '200', '159', '2021-04-04', '5', '2', '1'),
(49, 3, 'coupon_code', NULL, '159', '2021-04-04', '5', '2', '1'),
(50, 3, 'coupon_taka', '0', '159', '2021-04-04', '5', '2', '1'),
(51, 3, 'attribute_parent', '2', '159', '2021-04-04', '5', '2', '1'),
(52, 3, 'user_district', 'Comilla', '159', '2021-04-04', '5', '2', '1'),
(53, 3, 'user_city', 'Laksham', '159', '2021-04-04', '5', '2', '1'),
(54, 3, 'user_zip', '1300', '159', '2021-04-04', '5', '2', '1'),
(55, 4, '_tax_class', '', '159', '2021-04-04', '5', '9', '6'),
(56, 4, '_qty', '1', '159', '2021-04-04', '5', '9', '6'),
(57, 4, '_product_id', '9', '159', '2021-04-04', '5', '9', '6'),
(58, 4, '_variation_id', '', '159', '2021-04-04', '5', '9', '6'),
(59, 4, 'order_actual_cost', '700', '159', '2021-04-04', '5', '9', '6'),
(60, 4, 'order_product_cost', '700', '159', '2021-04-04', '5', '9', '6'),
(61, 4, '_line_subtotal', '800', '159', '2021-04-04', '5', '9', '6'),
(62, 4, '_line_total', '800', '159', '2021-04-04', '5', '9', '6'),
(63, 4, '_line_subtotal_tax', '', '159', '2021-04-04', '5', '9', '6'),
(64, 4, '_line_tax', '', '159', '2021-04-04', '5', '9', '6'),
(65, 4, '_line_tax_data', '2021-04-04 19:23:21', '159', '2021-04-04', '5', '9', '6'),
(66, 4, 'delivery_charge', '200', '159', '2021-04-04', '5', '9', '6'),
(67, 4, 'coupon_code', NULL, '159', '2021-04-04', '5', '9', '6'),
(68, 4, 'coupon_taka', '0', '159', '2021-04-04', '5', '9', '6'),
(69, 4, 'attribute_parent', '9', '159', '2021-04-04', '5', '9', '6'),
(70, 4, 'user_district', 'Comilla', '159', '2021-04-04', '5', '9', '6'),
(71, 4, 'user_city', 'Laksham', '159', '2021-04-04', '5', '9', '6'),
(72, 4, 'user_zip', '1300', '159', '2021-04-04', '5', '9', '6'),
(73, 5, '_tax_class', '', '163', '2021-04-04', '5', '39', '39'),
(74, 5, '_qty', '1', '163', '2021-04-04', '5', '39', '39'),
(75, 5, '_product_id', '39', '163', '2021-04-04', '5', '39', '39'),
(76, 5, '_variation_id', '', '163', '2021-04-04', '5', '39', '39'),
(77, 5, 'order_actual_cost', '800', '163', '2021-04-04', '5', '39', '39'),
(78, 5, 'order_product_cost', '800', '163', '2021-04-04', '5', '39', '39'),
(79, 5, '_line_subtotal', '1000', '163', '2021-04-04', '5', '39', '39'),
(80, 5, '_line_total', '1000', '163', '2021-04-04', '5', '39', '39'),
(81, 5, '_line_subtotal_tax', '', '163', '2021-04-04', '5', '39', '39'),
(82, 5, '_line_tax', '', '163', '2021-04-04', '5', '39', '39'),
(83, 5, '_line_tax_data', '2021-04-04 19:28:01', '163', '2021-04-04', '5', '39', '39'),
(84, 5, 'delivery_charge', '200', '163', '2021-04-04', '5', '39', '39'),
(85, 5, 'coupon_code', NULL, '163', '2021-04-04', '5', '39', '39'),
(86, 5, 'coupon_taka', '0', '163', '2021-04-04', '5', '39', '39'),
(87, 5, 'attribute_parent', '39', '163', '2021-04-04', '5', '39', '39'),
(88, 5, 'user_district', 'Comilla', '163', '2021-04-04', '5', '39', '39'),
(89, 5, 'user_city', 'Laksham', '163', '2021-04-04', '5', '39', '39'),
(90, 5, 'user_zip', '1300', '163', '2021-04-04', '5', '39', '39'),
(91, 6, '_tax_class', '', '163', '2021-04-04', '5', '10', '6'),
(92, 6, '_qty', '1', '163', '2021-04-04', '5', '10', '6'),
(93, 6, '_product_id', '10', '163', '2021-04-04', '5', '10', '6'),
(94, 6, '_variation_id', '', '163', '2021-04-04', '5', '10', '6'),
(95, 6, 'order_actual_cost', '700', '163', '2021-04-04', '5', '10', '6'),
(96, 6, 'order_product_cost', '700', '163', '2021-04-04', '5', '10', '6'),
(97, 6, '_line_subtotal', '800', '163', '2021-04-04', '5', '10', '6'),
(98, 6, '_line_total', '800', '163', '2021-04-04', '5', '10', '6'),
(99, 6, '_line_subtotal_tax', '', '163', '2021-04-04', '5', '10', '6'),
(100, 6, '_line_tax', '', '163', '2021-04-04', '5', '10', '6'),
(101, 6, '_line_tax_data', '2021-04-04 19:28:01', '163', '2021-04-04', '5', '10', '6'),
(102, 6, 'delivery_charge', '200', '163', '2021-04-04', '5', '10', '6'),
(103, 6, 'coupon_code', NULL, '163', '2021-04-04', '5', '10', '6'),
(104, 6, 'coupon_taka', '0', '163', '2021-04-04', '5', '10', '6'),
(105, 6, 'attribute_parent', '10', '163', '2021-04-04', '5', '10', '6'),
(106, 6, 'user_district', 'Comilla', '163', '2021-04-04', '5', '10', '6'),
(107, 6, 'user_city', 'Laksham', '163', '2021-04-04', '5', '10', '6'),
(108, 6, 'user_zip', '1300', '163', '2021-04-04', '5', '10', '6'),
(109, 7, '_tax_class', '', '164', '2021-04-04', '5', '3', '1'),
(110, 7, '_qty', '1', '164', '2021-04-04', '5', '3', '1'),
(111, 7, '_product_id', '3', '164', '2021-04-04', '5', '3', '1'),
(112, 7, '_variation_id', '', '164', '2021-04-04', '5', '3', '1'),
(113, 7, 'order_actual_cost', '900', '164', '2021-04-04', '5', '3', '1'),
(114, 7, 'order_product_cost', '900', '164', '2021-04-04', '5', '3', '1'),
(115, 7, '_line_subtotal', '1000', '164', '2021-04-04', '5', '3', '1'),
(116, 7, '_line_total', '1000', '164', '2021-04-04', '5', '3', '1'),
(117, 7, '_line_subtotal_tax', '', '164', '2021-04-04', '5', '3', '1'),
(118, 7, '_line_tax', '', '164', '2021-04-04', '5', '3', '1'),
(119, 7, '_line_tax_data', '2021-04-04 19:28:19', '164', '2021-04-04', '5', '3', '1'),
(120, 7, 'delivery_charge', '100', '164', '2021-04-04', '5', '3', '1'),
(121, 7, 'coupon_code', NULL, '164', '2021-04-04', '5', '3', '1'),
(122, 7, 'coupon_taka', '0', '164', '2021-04-04', '5', '3', '1'),
(123, 7, 'attribute_parent', '3', '164', '2021-04-04', '5', '3', '1'),
(124, 7, 'user_district', 'Dhaka', '164', '2021-04-04', '5', '3', '1'),
(125, 7, 'user_city', 'Badda', '164', '2021-04-04', '5', '3', '1'),
(126, 7, 'user_zip', '1200', '164', '2021-04-04', '5', '3', '1');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` bigint(20) NOT NULL,
  `order_item_name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_item_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` bigint(20) NOT NULL,
  `product_parent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_item_name`, `order_item_type`, `product_id`, `order_id`, `product_parent`) VALUES
(1, 'Dresses', 'line-item', '50', 158, '49'),
(2, 'Bag', 'line-item', '4', 158, '1'),
(3, 'Bag', 'line-item', '2', 159, '1'),
(4, 'Jeans', 'line-item', '9', 159, '6'),
(5, 'Belt', 'line-item', '39', 163, '39'),
(6, 'Jeans', 'line-item', '10', 163, '6'),
(7, 'Bag', 'line-item', '3', 164, '1');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('parthokar90@gmail.com', '$2y$10$UUrtTc333wwAHCTL5v0D1Ov4uGY9uze3gyQ7bJlOkiQgi.gjEcUT.', '2020-12-09 02:11:45'),
('hm.sohelrana95@gmail.com', '$2y$10$4pE.WW/O7mKL2UXr6babbeApI0AKDKFo7g4QxTKaAQ.aijFH7c90m', '2020-12-09 02:26:31'),
('demo@email.com', '$2y$10$Oq0JrTNtYw5d8sOKSu37Ne2LOvs5pI09Dwh5VJeyqEddjv1SVwRj6', '2021-03-28 13:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `payment_tokenmeta`
--

CREATE TABLE `payment_tokenmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `payment_token_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_tokens`
--

CREATE TABLE `payment_tokens` (
  `token_id` bigint(20) UNSIGNED NOT NULL,
  `gateway_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'manage-dashboard', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(2, 'Category', 'create-category', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(3, 'Tag', 'manage-tag', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(4, 'Attribute', 'manage-attribute', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(5, 'Product', 'manage-product', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(6, 'Quick Report', 'quick-report', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(7, 'Order History', 'order-history', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(8, 'Send Parcel', 'send-parcel', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(9, 'Reject', 'manage-reject', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(10, 'Manage Stock', 'manage-stock', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(11, 'Customer List', 'manage-customer', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(13, 'Settings', 'manage-settings', '2020-10-28 10:48:52', '2020-10-28 10:48:52'),
(14, 'Report', 'manage-report', '2020-10-28 10:48:52', '2020-10-28 10:48:52');

-- --------------------------------------------------------

--
-- Table structure for table `postmeta`
--

CREATE TABLE `postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postmeta`
--

INSERT INTO `postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'stock_status', NULL),
(2, 1, 'regular_price', '1200'),
(3, 1, 'sale_price', '1000'),
(4, 1, 'weight', NULL),
(5, 1, 'length', NULL),
(6, 1, 'width', NULL),
(7, 1, 'height', NULL),
(8, 1, 'product_stock', '900'),
(9, 1, 'start_stock', '900'),
(10, 1, '_sku', '323'),
(11, 1, 'attached_file', '1610437503.jpg'),
(12, 1, 'gallery_file', 'Crossbody bag 2.jpg'),
(1624, 157, 'first_name', 'Partho'),
(14, 1, 'gallery_file', 'Tote bag 2.jpg'),
(15, 1, 'gallery_file', 'Tote bag 3.jpg'),
(16, 1, 'gallery_file', 'Tote bag 4.jpg'),
(17, 2, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"}]'),
(18, 1, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"}]'),
(19, 2, 'attribute_stock', '3'),
(20, 2, 'attribute_low_stock', '1'),
(21, 2, 'att_status', '1'),
(22, 3, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"}]'),
(23, 1, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"}]'),
(24, 3, 'attribute_stock', '2'),
(25, 3, 'attribute_low_stock', '1'),
(26, 3, 'att_status', '1'),
(27, 4, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Blue\",\"term_id\":\"11\"}]'),
(28, 1, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Blue\",\"term_id\":\"11\"}]'),
(29, 4, 'attribute_stock', '0'),
(30, 4, 'attribute_low_stock', '1'),
(31, 4, 'att_status', '1'),
(32, 5, 'stock_status', 'instock'),
(33, 5, 'regular_price', '0'),
(34, 5, 'sale_price', '900'),
(35, 5, 'weight', NULL),
(36, 5, 'length', NULL),
(37, 5, 'width', NULL),
(38, 5, 'height', NULL),
(39, 5, 'product_stock', '700'),
(40, 5, 'start_stock', '700'),
(41, 5, 'default_qty', '91'),
(42, 5, 'alert_qty', '10'),
(43, 5, '_sku', '357'),
(44, 5, 'attached_file', '1610437578.jpg'),
(1625, 157, 'last_name', 'Kar'),
(1626, 157, 'address_one', 'Habiganj,Sylhet'),
(47, 5, 'gallery_file', 'Earring 2.jpg'),
(48, 5, 'gallery_file', 'Necklace 2.jpg'),
(49, 5, 'gallery_file', 'Necklace 3.jpg'),
(50, 6, 'stock_status', NULL),
(51, 6, 'regular_price', '100'),
(52, 6, 'sale_price', '800'),
(53, 6, 'weight', NULL),
(54, 6, 'length', NULL),
(55, 6, 'width', NULL),
(56, 6, 'height', NULL),
(57, 6, 'product_stock', '700'),
(58, 6, 'start_stock', '700'),
(59, 6, '_sku', '988'),
(60, 6, 'attached_file', '1610437676.jpg'),
(61, 6, 'gallery_file', 'Jeans 1.jpg'),
(62, 6, 'gallery_file', 'Jeans 2.jpg'),
(63, 6, 'gallery_file', 'Jeans 2-2.jpg'),
(1627, 157, 'address_two', NULL),
(1628, 157, 'phone', '01435345'),
(66, 7, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(67, 6, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(68, 7, 'attribute_stock', '9'),
(69, 7, 'attribute_low_stock', '10'),
(70, 7, 'att_status', '1'),
(71, 8, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(72, 6, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(73, 8, 'attribute_stock', '0'),
(74, 8, 'attribute_low_stock', '10'),
(75, 8, 'att_status', '1'),
(76, 9, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"S\",\"term_id\":\"15\"}]'),
(77, 6, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"S\",\"term_id\":\"15\"}]'),
(78, 9, 'attribute_stock', '8'),
(79, 9, 'attribute_low_stock', '10'),
(80, 9, 'att_status', '1'),
(81, 10, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"M\",\"term_id\":\"16\"}]'),
(82, 6, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"M\",\"term_id\":\"16\"}]'),
(83, 10, 'attribute_stock', '98'),
(84, 10, 'attribute_low_stock', '10'),
(85, 10, 'att_status', '1'),
(86, 11, 'first_name', 'sohel'),
(87, 11, 'last_name', 'Ahmed'),
(88, 11, 'address_one', 'Uttara,Dhaka'),
(89, 11, 'address_two', NULL),
(90, 11, 'phone', '01981368525'),
(91, 11, 'email', 'sohelahmeditebd@gmail.com'),
(92, 11, 'country', 'Bangladesh'),
(93, 11, 'state', 'Dhaka'),
(94, 11, 'city', 'Badda'),
(95, 11, 'zip', '1200'),
(96, 11, '_customer_user', '1'),
(97, 11, '_billing_postcode', '1200'),
(98, 11, '_billing_company', NULL),
(99, 11, '_billing_last_name', NULL),
(100, 11, '_billing_first_name', NULL),
(101, 11, 'payment_method', 'Cash On Delivery'),
(102, 12, 'first_name', 'sohel'),
(103, 12, 'last_name', 'Ahmed'),
(104, 12, 'address_one', 'Uttara,Dhaka'),
(105, 12, 'address_two', NULL),
(106, 12, 'phone', '01981368525'),
(107, 12, 'email', 'sohelahmeditebd@gmail.com'),
(108, 12, 'country', 'Bangladesh'),
(109, 12, 'state', 'Dhaka'),
(110, 12, 'city', 'Badda'),
(111, 12, 'zip', '1200'),
(112, 12, '_customer_user', '1'),
(113, 12, '_billing_postcode', '1200'),
(114, 12, '_billing_company', NULL),
(115, 12, '_billing_last_name', NULL),
(116, 12, '_billing_first_name', NULL),
(117, 12, 'payment_method', 'Cash On Delivery'),
(118, 12, 'processing_date', '2021-01-12'),
(119, 11, 'processing_date', '2021-01-12'),
(120, 13, 'first_name', 'sohel'),
(121, 13, 'last_name', 'Ahmed'),
(122, 13, 'address_one', 'Uttara,Dhaka'),
(123, 13, 'address_two', NULL),
(124, 13, 'phone', '01981368525'),
(125, 13, 'email', 'sohelahmeditebd@gmail.com'),
(126, 13, 'country', 'Bangladesh'),
(127, 13, 'state', 'Dhaka'),
(128, 13, 'city', 'Badda'),
(129, 13, 'zip', '1200'),
(130, 13, '_customer_user', '1'),
(131, 13, '_billing_postcode', '1200'),
(132, 13, '_billing_company', NULL),
(133, 13, '_billing_last_name', NULL),
(134, 13, '_billing_first_name', NULL),
(135, 13, 'payment_method', 'Cash On Delivery'),
(136, 14, 'first_name', 'sohel'),
(137, 14, 'last_name', 'Ahmed'),
(138, 14, 'address_one', 'Uttara,Dhaka'),
(139, 14, 'address_two', NULL),
(140, 14, 'phone', '01981368525'),
(141, 14, 'email', 'sohelahmeditebd@gmail.com'),
(142, 14, 'country', 'Bangladesh'),
(143, 14, 'state', 'Dhaka'),
(144, 14, 'city', 'Badda'),
(145, 14, 'zip', '1200'),
(146, 14, '_customer_user', '1'),
(147, 14, '_billing_postcode', '1200'),
(148, 14, '_billing_company', NULL),
(149, 14, '_billing_last_name', NULL),
(150, 14, '_billing_first_name', NULL),
(151, 14, 'payment_method', 'Cash On Delivery'),
(152, 14, 'processing_date', '2021-01-12'),
(153, 13, 'processing_date', '2021-01-12'),
(154, 15, 'first_name', 'sohel'),
(155, 15, 'last_name', 'Ahmed'),
(156, 15, 'address_one', 'Uttara,Dhaka'),
(157, 15, 'address_two', NULL),
(158, 15, 'phone', '01981368525'),
(159, 15, 'email', 'sohelahmeditebd@gmail.com'),
(160, 15, 'country', 'Bangladesh'),
(161, 15, 'state', 'Dhaka'),
(162, 15, 'city', 'Badda'),
(163, 15, 'zip', '1200'),
(164, 15, '_customer_user', '1'),
(165, 15, '_billing_postcode', '1200'),
(166, 15, '_billing_company', NULL),
(167, 15, '_billing_last_name', NULL),
(168, 15, '_billing_first_name', NULL),
(169, 15, 'payment_method', 'Cash On Delivery'),
(170, 16, 'first_name', 'sohel'),
(171, 16, 'last_name', 'Ahmed'),
(172, 16, 'address_one', 'Uttara,Dhaka'),
(173, 16, 'address_two', NULL),
(174, 16, 'phone', '01981368525'),
(175, 16, 'email', 'sohelahmeditebd@gmail.com'),
(176, 16, 'country', 'Bangladesh'),
(177, 16, 'state', 'Dhaka'),
(178, 16, 'city', 'Badda'),
(179, 16, 'zip', '1200'),
(180, 16, '_customer_user', '1'),
(181, 16, '_billing_postcode', '1200'),
(182, 16, '_billing_company', NULL),
(183, 16, '_billing_last_name', NULL),
(184, 16, '_billing_first_name', NULL),
(185, 16, 'payment_method', 'Cash On Delivery'),
(186, 17, 'first_name', 'sohel'),
(187, 17, 'last_name', 'Ahmed'),
(188, 17, 'address_one', 'Uttara,Dhaka'),
(189, 17, 'address_two', NULL),
(190, 17, 'phone', '01981368525'),
(191, 17, 'email', 'sohelahmeditebd@gmail.com'),
(192, 17, 'country', 'Bangladesh'),
(193, 17, 'state', 'Dhaka'),
(194, 17, 'city', 'Badda'),
(195, 17, 'zip', '1200'),
(196, 17, '_customer_user', '1'),
(197, 17, '_billing_postcode', '1200'),
(198, 17, '_billing_company', NULL),
(199, 17, '_billing_last_name', NULL),
(200, 17, '_billing_first_name', NULL),
(201, 17, 'payment_method', 'Cash On Delivery'),
(202, 18, 'first_name', 'sohel'),
(203, 18, 'last_name', 'Ahmed'),
(204, 18, 'address_one', 'Uttara,Dhaka'),
(205, 18, 'address_two', NULL),
(206, 18, 'phone', '01981368525'),
(207, 18, 'email', 'sohelahmeditebd@gmail.com'),
(208, 18, 'country', 'Bangladesh'),
(209, 18, 'state', 'Dhaka'),
(210, 18, 'city', 'Badda'),
(211, 18, 'zip', '1200'),
(212, 18, '_customer_user', '1'),
(213, 18, '_billing_postcode', '1200'),
(214, 18, '_billing_company', NULL),
(215, 18, '_billing_last_name', NULL),
(216, 18, '_billing_first_name', NULL),
(217, 18, 'payment_method', 'Cash On Delivery'),
(218, 19, 'first_name', 'sohel'),
(219, 19, 'last_name', 'Ahmed'),
(220, 19, 'address_one', 'Uttara,Dhaka'),
(221, 19, 'address_two', NULL),
(222, 19, 'phone', '01981368525'),
(223, 19, 'email', 'sohelahmeditebd@gmail.com'),
(224, 19, 'country', 'Bangladesh'),
(225, 19, 'state', 'Dhaka'),
(226, 19, 'city', 'Badda'),
(227, 19, 'zip', '1200'),
(228, 19, '_customer_user', '1'),
(229, 19, '_billing_postcode', '1200'),
(230, 19, '_billing_company', NULL),
(231, 19, '_billing_last_name', NULL),
(232, 19, '_billing_first_name', NULL),
(233, 19, 'payment_method', 'Cash On Delivery'),
(234, 20, 'first_name', 'sohel'),
(235, 20, 'last_name', 'Ahmed'),
(236, 20, 'address_one', 'Uttara,Dhaka'),
(237, 20, 'address_two', NULL),
(238, 20, 'phone', '01981368525'),
(239, 20, 'email', 'sohelahmeditebd@gmail.com'),
(240, 20, 'country', 'Bangladesh'),
(241, 20, 'state', 'Dhaka'),
(242, 20, 'city', 'Badda'),
(243, 20, 'zip', '1200'),
(244, 20, '_customer_user', '1'),
(245, 20, '_billing_postcode', '1200'),
(246, 20, '_billing_company', NULL),
(247, 20, '_billing_last_name', NULL),
(248, 20, '_billing_first_name', NULL),
(249, 20, 'payment_method', 'Cash On Delivery'),
(250, 17, 'processing_date', '2021-01-12'),
(251, 21, 'first_name', 'sohel'),
(252, 21, 'last_name', 'Ahmed'),
(253, 21, 'address_one', 'Uttara,Dhaka'),
(254, 21, 'address_two', NULL),
(255, 21, 'phone', '01981368525'),
(256, 21, 'email', 'sohelahmeditebd@gmail.com'),
(257, 21, 'country', 'Bangladesh'),
(258, 21, 'state', 'Dhaka'),
(259, 21, 'city', 'Badda'),
(260, 21, 'zip', '1200'),
(261, 21, '_customer_user', '1'),
(262, 21, '_billing_postcode', '1200'),
(263, 21, '_billing_company', NULL),
(264, 21, '_billing_last_name', NULL),
(265, 21, '_billing_first_name', NULL),
(266, 21, 'payment_method', 'Cash On Delivery'),
(267, 22, 'first_name', 'sohel'),
(268, 22, 'last_name', 'Ahmed'),
(269, 22, 'address_one', 'Uttara,Dhaka'),
(270, 22, 'address_two', NULL),
(271, 22, 'phone', '01981368525'),
(272, 22, 'email', 'sohelahmeditebd@gmail.com'),
(273, 22, 'country', 'Bangladesh'),
(274, 22, 'state', 'Dhaka'),
(275, 22, 'city', 'Badda'),
(276, 22, 'zip', '1200'),
(277, 22, '_customer_user', '1'),
(278, 22, '_billing_postcode', '1200'),
(279, 22, '_billing_company', NULL),
(280, 22, '_billing_last_name', NULL),
(281, 22, '_billing_first_name', NULL),
(282, 22, 'payment_method', 'Cash On Delivery'),
(283, 23, 'first_name', 'sohel'),
(284, 23, 'last_name', 'Ahmed'),
(285, 23, 'address_one', 'Uttara,Dhaka'),
(286, 23, 'address_two', NULL),
(287, 23, 'phone', '01981368525'),
(288, 23, 'email', 'sohelahmeditebd@gmail.com'),
(289, 23, 'country', 'Bangladesh'),
(290, 23, 'state', 'Dhaka'),
(291, 23, 'city', 'Badda'),
(292, 23, 'zip', '1200'),
(293, 23, '_customer_user', '1'),
(294, 23, '_billing_postcode', '1200'),
(295, 23, '_billing_company', NULL),
(296, 23, '_billing_last_name', NULL),
(297, 23, '_billing_first_name', NULL),
(298, 23, 'payment_method', 'Cash On Delivery'),
(299, 24, 'first_name', 'sohel'),
(300, 24, 'last_name', 'Ahmed'),
(301, 24, 'address_one', 'Uttara,Dhaka'),
(302, 24, 'address_two', NULL),
(303, 24, 'phone', '01981368525'),
(304, 24, 'email', 'sohelahmeditebd@gmail.com'),
(305, 24, 'country', 'Bangladesh'),
(306, 24, 'state', 'Dhaka'),
(307, 24, 'city', 'Badda'),
(308, 24, 'zip', '1200'),
(309, 24, '_customer_user', '1'),
(310, 24, '_billing_postcode', '1200'),
(311, 24, '_billing_company', NULL),
(312, 24, '_billing_last_name', NULL),
(313, 24, '_billing_first_name', NULL),
(314, 24, 'payment_method', 'Cash On Delivery'),
(315, 25, 'first_name', 'sohel'),
(316, 25, 'last_name', 'Ahmed'),
(317, 25, 'address_one', 'Uttara,Dhaka'),
(318, 25, 'address_two', NULL),
(319, 25, 'phone', '01981368525'),
(320, 25, 'email', 'sohelahmeditebd@gmail.com'),
(321, 25, 'country', 'Bangladesh'),
(322, 25, 'state', 'Dhaka'),
(323, 25, 'city', 'Badda'),
(324, 25, 'zip', '1200'),
(325, 25, '_customer_user', '1'),
(326, 25, '_billing_postcode', '1200'),
(327, 25, '_billing_company', NULL),
(328, 25, '_billing_last_name', NULL),
(329, 25, '_billing_first_name', NULL),
(330, 25, 'payment_method', 'Cash On Delivery'),
(331, 26, 'stock_status', NULL),
(332, 26, 'regular_price', '1000'),
(333, 26, 'sale_price', '1000'),
(334, 26, 'weight', NULL),
(335, 26, 'length', NULL),
(336, 26, 'width', NULL),
(337, 26, 'height', NULL),
(338, 26, 'product_stock', '700'),
(339, 26, 'start_stock', '700'),
(340, 26, '_sku', '872'),
(341, 26, 'attached_file', '1610446313.jpg'),
(342, 26, 'gallery_file', 'Tshirt 1.jpg'),
(343, 26, 'gallery_file', 'Tshirt 1-2.jpg'),
(1629, 157, 'email', 'parthokar90@gmail.com'),
(345, 26, 'gallery_file', 'Tunic 3.jpg'),
(346, 27, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"},{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(347, 26, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"},{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(348, 27, 'attribute_stock', '189'),
(349, 27, 'attribute_low_stock', '10'),
(350, 27, 'att_status', '1'),
(351, 28, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"},{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(352, 26, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"},{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(353, 28, 'attribute_stock', '197'),
(354, 28, 'attribute_low_stock', '10'),
(355, 28, 'att_status', '1'),
(356, 29, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Blue\",\"term_id\":\"11\"},{\"taxonomy\":\"size\",\"term\":\"S\",\"term_id\":\"15\"}]'),
(357, 26, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Blue\",\"term_id\":\"11\"},{\"taxonomy\":\"size\",\"term\":\"S\",\"term_id\":\"15\"}]'),
(358, 29, 'attribute_stock', '198'),
(359, 29, 'attribute_low_stock', '10'),
(360, 29, 'att_status', '1'),
(361, 30, 'first_name', 'sohel'),
(362, 30, 'last_name', 'Ahmed'),
(363, 30, 'address_one', 'Uttara,Dhaka'),
(364, 30, 'address_two', NULL),
(365, 30, 'phone', '01981368525'),
(366, 30, 'email', 'sohelahmeditebd@gmail.com'),
(367, 30, 'country', 'Bangladesh'),
(368, 30, 'state', 'Dhaka'),
(369, 30, 'city', 'Badda'),
(370, 30, 'zip', '1200'),
(371, 30, '_customer_user', '1'),
(372, 30, '_billing_postcode', '1200'),
(373, 30, '_billing_company', NULL),
(374, 30, '_billing_last_name', NULL),
(375, 30, '_billing_first_name', NULL),
(376, 30, 'payment_method', 'Cash On Delivery'),
(377, 31, 'first_name', 'sohel'),
(378, 31, 'last_name', 'Ahmed'),
(379, 31, 'address_one', 'Uttara,Dhaka'),
(380, 31, 'address_two', NULL),
(381, 31, 'phone', '01981368525'),
(382, 31, 'email', 'sohelahmeditebd@gmail.com'),
(383, 31, 'country', 'Bangladesh'),
(384, 31, 'state', 'Dhaka'),
(385, 31, 'city', 'Badda'),
(386, 31, 'zip', '1200'),
(387, 31, '_customer_user', '1'),
(388, 31, '_billing_postcode', '1200'),
(389, 31, '_billing_company', NULL),
(390, 31, '_billing_last_name', NULL),
(391, 31, '_billing_first_name', NULL),
(392, 31, 'payment_method', 'Cash On Delivery'),
(393, 32, 'first_name', 'sohel'),
(394, 32, 'last_name', 'Ahmed'),
(395, 32, 'address_one', 'Uttara,Dhaka'),
(396, 32, 'address_two', NULL),
(397, 32, 'phone', '01981368525'),
(398, 32, 'email', 'sohelahmeditebd@gmail.com'),
(399, 32, 'country', 'Bangladesh'),
(400, 32, 'state', 'Dhaka'),
(401, 32, 'city', 'Badda'),
(402, 32, 'zip', '1200'),
(403, 32, '_customer_user', '1'),
(404, 32, '_billing_postcode', '1200'),
(405, 32, '_billing_company', NULL),
(406, 32, '_billing_last_name', NULL),
(407, 32, '_billing_first_name', NULL),
(408, 32, 'payment_method', 'Cash On Delivery'),
(409, 33, 'first_name', 'sohel'),
(410, 33, 'last_name', 'Ahmed'),
(411, 33, 'address_one', 'Uttara,Dhaka'),
(412, 33, 'address_two', NULL),
(413, 33, 'phone', '01981368525'),
(414, 33, 'email', 'sohelahmeditebd@gmail.com'),
(415, 33, 'country', 'Bangladesh'),
(416, 33, 'state', 'Dhaka'),
(417, 33, 'city', 'Badda'),
(418, 33, 'zip', '1200'),
(419, 33, '_customer_user', '1'),
(420, 33, '_billing_postcode', '1200'),
(421, 33, '_billing_company', NULL),
(422, 33, '_billing_last_name', NULL),
(423, 33, '_billing_first_name', NULL),
(424, 33, 'payment_method', 'Cash On Delivery'),
(425, 34, 'first_name', 'sohel'),
(426, 34, 'last_name', 'Ahmed'),
(427, 34, 'address_one', 'Uttara,Dhaka'),
(428, 34, 'address_two', NULL),
(429, 34, 'phone', '01981368525'),
(430, 34, 'email', 'sohelahmeditebd@gmail.com'),
(431, 34, 'country', 'Bangladesh'),
(432, 34, 'state', 'Dhaka'),
(433, 34, 'city', 'Badda'),
(434, 34, 'zip', '1200'),
(435, 34, '_customer_user', '1'),
(436, 34, '_billing_postcode', '1200'),
(437, 34, '_billing_company', NULL),
(438, 34, '_billing_last_name', NULL),
(439, 34, '_billing_first_name', NULL),
(440, 34, 'payment_method', 'Cash On Delivery'),
(441, 35, 'first_name', 'sohel'),
(442, 35, 'last_name', 'Ahmed'),
(443, 35, 'address_one', 'Uttara,Dhaka'),
(444, 35, 'address_two', NULL),
(445, 35, 'phone', '01981368525'),
(446, 35, 'email', 'sohelahmeditebd@gmail.com'),
(447, 35, 'country', 'Bangladesh'),
(448, 35, 'state', 'Dhaka'),
(449, 35, 'city', 'Badda'),
(450, 35, 'zip', '1200'),
(451, 35, '_customer_user', '1'),
(452, 35, '_billing_postcode', '1200'),
(453, 35, '_billing_company', NULL),
(454, 35, '_billing_last_name', NULL),
(455, 35, '_billing_first_name', NULL),
(456, 35, 'payment_method', 'Cash On Delivery'),
(457, 36, 'first_name', 'sohel'),
(458, 36, 'last_name', 'Ahmed'),
(459, 36, 'address_one', 'Uttara,Dhaka'),
(460, 36, 'address_two', NULL),
(461, 36, 'phone', '01981368525'),
(462, 36, 'email', 'sohelahmeditebd@gmail.com'),
(463, 36, 'country', 'Bangladesh'),
(464, 36, 'state', 'Dhaka'),
(465, 36, 'city', 'Badda'),
(466, 36, 'zip', '1200'),
(467, 36, '_customer_user', '1'),
(468, 36, '_billing_postcode', '1200'),
(469, 36, '_billing_company', NULL),
(470, 36, '_billing_last_name', NULL),
(471, 36, '_billing_first_name', NULL),
(472, 36, 'payment_method', 'Cash On Delivery'),
(473, 37, 'first_name', 'sohel'),
(474, 37, 'last_name', 'Ahmed'),
(475, 37, 'address_one', 'Uttara,Dhaka'),
(476, 37, 'address_two', NULL),
(477, 37, 'phone', '01981368525'),
(478, 37, 'email', 'sohelahmeditebd@gmail.com'),
(479, 37, 'country', 'Bangladesh'),
(480, 37, 'state', 'Dhaka'),
(481, 37, 'city', 'Badda'),
(482, 37, 'zip', '1200'),
(483, 37, '_customer_user', '1'),
(484, 37, '_billing_postcode', '1200'),
(485, 37, '_billing_company', NULL),
(486, 37, '_billing_last_name', NULL),
(487, 37, '_billing_first_name', NULL),
(488, 37, 'payment_method', 'Cash On Delivery'),
(489, 37, 'processing_date', '2021-01-12'),
(504, 35, 'processing_date', '2021-01-12'),
(491, 38, 'banner_image', '1610451001.png'),
(915, 72, '_billing_postcode', '1200'),
(916, 72, '_billing_company', NULL),
(912, 72, 'city', 'Badda'),
(913, 72, 'zip', '1200'),
(914, 72, '_customer_user', '0'),
(910, 72, 'country', 'Bangladesh'),
(911, 72, 'state', 'Dhaka'),
(908, 72, 'phone', '01787884545'),
(909, 72, 'email', 'dipa@gmail.com'),
(505, 34, 'processing_date', '2021-01-12'),
(506, 39, 'stock_status', 'instock'),
(507, 39, 'regular_price', '1100'),
(508, 39, 'sale_price', '1000'),
(509, 39, 'weight', NULL),
(510, 39, 'length', NULL),
(511, 39, 'width', NULL),
(512, 39, 'height', NULL),
(513, 39, 'product_stock', '800'),
(514, 39, 'start_stock', '800'),
(515, 39, 'default_qty', '83'),
(516, 39, 'alert_qty', '10'),
(517, 39, '_sku', '496'),
(518, 39, 'attached_file', '1610454376.jpg'),
(519, 39, 'gallery_file', 'Belt 1.jpg'),
(520, 39, 'gallery_file', 'Scarve 1.jpg'),
(521, 39, 'gallery_file', 'Scarve 2.jpg'),
(522, 40, 'stock_status', 'instock'),
(523, 40, 'regular_price', NULL),
(524, 40, 'sale_price', '1000'),
(525, 40, 'weight', NULL),
(526, 40, 'length', NULL),
(527, 40, 'width', NULL),
(528, 40, 'height', NULL),
(529, 40, 'product_stock', '700'),
(530, 40, 'start_stock', '700'),
(531, 40, '_sku', '702'),
(532, 40, 'attached_file', '1610454498.jpg'),
(1631, 157, 'state', 'Dhaka'),
(1630, 157, 'country', 'Bangladesh'),
(535, 40, 'gallery_file', 'purse 2.jpg'),
(536, 40, 'gallery_file', 'Tote bag 2.jpg'),
(537, 40, 'gallery_file', 'Tote bag 3.jpg'),
(538, 41, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"}]'),
(539, 40, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"}]'),
(540, 41, 'attribute_stock', '90'),
(541, 41, 'attribute_low_stock', '10'),
(542, 41, 'att_status', '1'),
(543, 42, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"}]'),
(544, 40, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"}]'),
(545, 42, 'attribute_stock', '100'),
(546, 42, 'attribute_low_stock', '10'),
(547, 42, 'att_status', '1'),
(548, 43, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Green\",\"term_id\":\"12\"}]'),
(549, 40, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Green\",\"term_id\":\"12\"}]'),
(550, 43, 'attribute_stock', '98'),
(551, 43, 'attribute_low_stock', '10'),
(552, 43, 'att_status', '1'),
(553, 44, 'stock_status', 'instock'),
(554, 44, 'regular_price', '1300'),
(555, 44, 'sale_price', '1000'),
(556, 44, 'weight', NULL),
(557, 44, 'length', NULL),
(558, 44, 'width', NULL),
(559, 44, 'height', NULL),
(560, 44, 'product_stock', '900'),
(561, 44, 'start_stock', '900'),
(562, 44, '_sku', '946'),
(563, 44, 'attached_file', '1610454616.jpg'),
(564, 44, 'gallery_file', 'leggings 1-2.jpg'),
(565, 44, 'gallery_file', 'skirt 1.jpg'),
(1632, 157, 'city', 'Badda'),
(567, 44, 'gallery_file', 'skirt 1-3.jpg'),
(568, 45, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(569, 44, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(570, 45, 'attribute_stock', '99'),
(571, 45, 'attribute_low_stock', '10'),
(572, 45, 'att_status', '1'),
(573, 46, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(574, 44, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(575, 46, 'attribute_stock', '97'),
(576, 46, 'attribute_low_stock', '10'),
(577, 46, 'att_status', '1'),
(578, 47, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"S\",\"term_id\":\"15\"}]'),
(579, 44, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"S\",\"term_id\":\"15\"}]'),
(580, 47, 'attribute_stock', '98'),
(581, 47, 'attribute_low_stock', '10'),
(582, 47, 'att_status', '1'),
(583, 48, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"M\",\"term_id\":\"16\"}]'),
(584, 44, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"M\",\"term_id\":\"16\"}]'),
(585, 48, 'attribute_stock', '99'),
(586, 48, 'attribute_low_stock', '10'),
(587, 48, 'att_status', '1'),
(588, 49, 'stock_status', 'instock'),
(589, 49, 'regular_price', NULL),
(590, 49, 'sale_price', '1000'),
(591, 49, 'weight', NULL),
(592, 49, 'length', NULL),
(593, 49, 'width', NULL),
(594, 49, 'height', NULL),
(595, 49, 'product_stock', '600'),
(596, 49, 'start_stock', '600'),
(597, 49, '_sku', '414'),
(598, 49, 'attached_file', '1610454733.jpg'),
(599, 49, 'gallery_file', 'Dresses 1.jpg'),
(600, 49, 'gallery_file', 'Dresses 1-2.jpg'),
(601, 49, 'gallery_file', 'Dresses 2.jpg'),
(1633, 157, 'zip', '1200'),
(1634, 157, '_customer_user', '5'),
(604, 50, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"},{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(605, 49, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"},{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(606, 50, 'attribute_stock', '70'),
(607, 50, 'attribute_low_stock', '10'),
(608, 50, 'att_status', '1'),
(609, 51, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"},{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(610, 49, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"},{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(611, 51, 'attribute_stock', '99'),
(612, 51, 'attribute_low_stock', '10'),
(613, 51, 'att_status', '1'),
(614, 52, 'first_name', 'Elias'),
(615, 52, 'last_name', 'Howlader'),
(616, 52, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(617, 52, 'address_two', NULL),
(618, 52, 'phone', '0123456'),
(619, 52, 'email', 'elihowlader@hotmail.com'),
(620, 52, 'country', 'Bangladesh'),
(621, 52, 'state', 'Dhaka'),
(622, 52, 'city', 'Badda'),
(623, 52, 'zip', '1200'),
(624, 52, '_customer_user', '2'),
(625, 52, '_billing_postcode', '1200'),
(626, 52, '_billing_company', NULL),
(627, 52, '_billing_last_name', NULL),
(628, 52, '_billing_first_name', NULL),
(629, 52, 'payment_method', 'Cash On Delivery'),
(630, 53, 'first_name', 'Elias'),
(631, 53, 'last_name', 'Howlader'),
(632, 53, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(633, 53, 'address_two', NULL),
(634, 53, 'phone', '0123456'),
(635, 53, 'email', 'elihowlader@hotmail.com'),
(636, 53, 'country', 'Bangladesh'),
(637, 53, 'state', 'Dhaka'),
(638, 53, 'city', 'Badda'),
(639, 53, 'zip', '1200'),
(640, 53, '_customer_user', '2'),
(641, 53, '_billing_postcode', '1200'),
(642, 53, '_billing_company', NULL),
(643, 53, '_billing_last_name', NULL),
(644, 53, '_billing_first_name', NULL),
(645, 53, 'payment_method', 'Cash On Delivery'),
(646, 54, 'first_name', 'Elias'),
(647, 54, 'last_name', 'Howlader'),
(648, 54, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(649, 54, 'address_two', NULL),
(650, 54, 'phone', '0123'),
(651, 54, 'email', 'elihowlader@hotmail.com'),
(652, 54, 'country', 'Bangladesh'),
(653, 54, 'state', 'Dhaka'),
(654, 54, 'city', 'Badda'),
(655, 54, 'zip', '1200'),
(656, 54, '_customer_user', '2'),
(657, 54, '_billing_postcode', '1200'),
(658, 54, '_billing_company', NULL),
(659, 54, '_billing_last_name', NULL),
(660, 54, '_billing_first_name', NULL),
(661, 54, 'payment_method', 'Cash On Delivery'),
(662, 55, 'first_name', 'Elias'),
(663, 55, 'last_name', 'Howlader'),
(664, 55, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(665, 55, 'address_two', NULL),
(666, 55, 'phone', '012345'),
(667, 55, 'email', 'elihowlader@hotmail.com'),
(668, 55, 'country', 'Bangladesh'),
(669, 55, 'state', 'Comilla'),
(670, 55, 'city', 'Laksham'),
(671, 55, 'zip', '1300'),
(672, 55, '_customer_user', '2'),
(673, 55, '_billing_postcode', '1300'),
(674, 55, '_billing_company', NULL),
(675, 55, '_billing_last_name', NULL),
(676, 55, '_billing_first_name', NULL),
(677, 55, 'payment_method', 'Cash On Delivery'),
(678, 56, 'first_name', 'Elias'),
(679, 56, 'last_name', 'Howlader'),
(680, 56, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(681, 56, 'address_two', NULL),
(682, 56, 'phone', '0123456'),
(683, 56, 'email', 'elihowlader@hotmail.com'),
(684, 56, 'country', 'Bangladesh'),
(685, 56, 'state', 'Dhaka'),
(686, 56, 'city', 'Badda'),
(687, 56, 'zip', '1200'),
(688, 56, '_customer_user', '2'),
(689, 56, '_billing_postcode', '1200'),
(690, 56, '_billing_company', NULL),
(691, 56, '_billing_last_name', NULL),
(692, 56, '_billing_first_name', NULL),
(693, 56, 'payment_method', 'Cash On Delivery'),
(697, 52, 'processing_date', '2021-01-13'),
(698, 53, 'processing_date', '2021-01-13'),
(696, 54, 'processing_date', '2021-01-13'),
(699, 55, 'processing_date', '2021-01-14'),
(700, 57, 'first_name', 'Elias'),
(701, 57, 'last_name', 'Howlader'),
(702, 57, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(703, 57, 'address_two', NULL),
(704, 57, 'phone', '0'),
(705, 57, 'email', 'elihowlader@hotmail.com'),
(706, 57, 'country', 'Bangladesh'),
(707, 57, 'state', 'Dhaka'),
(708, 57, 'city', 'Badda'),
(709, 57, 'zip', '1200'),
(710, 57, '_customer_user', '2'),
(711, 57, '_billing_postcode', '1200'),
(712, 57, '_billing_company', NULL),
(713, 57, '_billing_last_name', NULL),
(714, 57, '_billing_first_name', NULL),
(715, 57, 'payment_method', 'Cash On Delivery'),
(716, 58, 'first_name', 'Elias'),
(717, 58, 'last_name', 'Howlader'),
(718, 58, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(719, 58, 'address_two', NULL),
(720, 58, 'phone', '0'),
(721, 58, 'email', 'elihowlader@hotmail.com'),
(722, 58, 'country', 'Bangladesh'),
(723, 58, 'state', 'Dhaka'),
(724, 58, 'city', 'Badda'),
(725, 58, 'zip', '1200'),
(726, 58, '_customer_user', '2'),
(727, 58, '_billing_postcode', '1200'),
(728, 58, '_billing_company', NULL),
(729, 58, '_billing_last_name', NULL),
(730, 58, '_billing_first_name', NULL),
(731, 58, 'payment_method', 'Cash On Delivery'),
(732, 59, 'first_name', 'Elias'),
(733, 59, 'last_name', 'Howlader'),
(734, 59, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(735, 59, 'address_two', NULL),
(736, 59, 'phone', '0'),
(737, 59, 'email', 'elihowlader@hotmail.com'),
(738, 59, 'country', 'Bangladesh'),
(739, 59, 'state', 'Dhaka'),
(740, 59, 'city', 'Badda'),
(741, 59, 'zip', '1200'),
(742, 59, '_customer_user', '2'),
(743, 59, '_billing_postcode', '1200'),
(744, 59, '_billing_company', NULL),
(745, 59, '_billing_last_name', NULL),
(746, 59, '_billing_first_name', NULL),
(747, 59, 'payment_method', 'Cash On Delivery'),
(748, 59, 'processing_date', '2021-01-14'),
(749, 58, 'processing_date', '2021-01-14'),
(750, 57, 'processing_date', '2021-01-14'),
(751, 60, 'first_name', 'sohel'),
(752, 60, 'last_name', 'Ahmed'),
(753, 60, 'address_one', 'Uttara,Dhaka'),
(754, 60, 'address_two', NULL),
(755, 60, 'phone', '01981368525'),
(756, 60, 'email', 'sohelahmeditebd@gmail.com'),
(757, 60, 'country', 'Bangladesh'),
(758, 60, 'state', 'Dhaka'),
(759, 60, 'city', 'Badda'),
(760, 60, 'zip', '1200'),
(761, 60, '_customer_user', '1'),
(762, 60, '_billing_postcode', '1200'),
(763, 60, '_billing_company', NULL),
(764, 60, '_billing_last_name', NULL),
(765, 60, '_billing_first_name', NULL),
(766, 60, 'payment_method', 'Cash On Delivery'),
(767, 61, 'first_name', 'sohel'),
(768, 61, 'last_name', 'Ahmed'),
(769, 61, 'address_one', 'Uttara,Dhaka'),
(770, 61, 'address_two', NULL),
(771, 61, 'phone', '01981368525'),
(772, 61, 'email', 'sohelahmeditebd@gmail.com'),
(773, 61, 'country', 'Bangladesh'),
(774, 61, 'state', 'Dhaka'),
(775, 61, 'city', 'Badda'),
(776, 61, 'zip', '1200'),
(777, 61, '_customer_user', '1'),
(778, 61, '_billing_postcode', '1200'),
(779, 61, '_billing_company', NULL),
(780, 61, '_billing_last_name', NULL),
(781, 61, '_billing_first_name', NULL),
(782, 61, 'payment_method', 'Cash On Delivery'),
(783, 61, 'processing_date', '2021-01-14'),
(784, 60, 'processing_date', '2021-01-14'),
(906, 72, 'address_one', 'Uttara,Dhaka'),
(907, 72, 'address_two', NULL),
(904, 72, 'first_name', 'Aminul'),
(905, 72, 'last_name', 'Islam'),
(791, 65, 'first_name', 'Elias'),
(792, 65, 'last_name', 'Howlader'),
(793, 65, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(794, 65, 'address_two', NULL),
(795, 65, 'phone', '0123456'),
(796, 65, 'email', 'elihowlader@hotmail.com'),
(797, 65, 'country', 'Bangladesh'),
(798, 65, 'state', 'Dhaka'),
(799, 65, 'city', 'Badda'),
(800, 65, 'zip', '1200'),
(801, 65, '_customer_user', '2'),
(802, 65, '_billing_postcode', '1200'),
(803, 65, '_billing_company', NULL),
(804, 65, '_billing_last_name', NULL),
(805, 65, '_billing_first_name', NULL),
(806, 65, 'payment_method', 'Cash On Delivery'),
(807, 66, 'first_name', 'Elias'),
(808, 66, 'last_name', 'Howlader'),
(809, 66, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(810, 66, 'address_two', NULL),
(811, 66, 'phone', '0123456'),
(812, 66, 'email', 'elihowlader@hotmail.com'),
(813, 66, 'country', 'Bangladesh'),
(814, 66, 'state', 'Comilla'),
(815, 66, 'city', 'Laksham'),
(816, 66, 'zip', '1300'),
(817, 66, '_customer_user', '2'),
(818, 66, '_billing_postcode', '1300'),
(819, 66, '_billing_company', NULL),
(820, 66, '_billing_last_name', NULL),
(821, 66, '_billing_first_name', NULL),
(822, 66, 'payment_method', 'Cash On Delivery'),
(823, 67, 'first_name', 'Elias'),
(824, 67, 'last_name', 'Howlader'),
(825, 67, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(826, 67, 'address_two', NULL),
(827, 67, 'phone', '0'),
(828, 67, 'email', 'elihowlader@hotmail.com'),
(829, 67, 'country', 'Bangladesh'),
(830, 67, 'state', 'Dhaka'),
(831, 67, 'city', 'Badda'),
(832, 67, 'zip', '1200'),
(833, 67, '_customer_user', '2'),
(834, 67, '_billing_postcode', '1200'),
(835, 67, '_billing_company', NULL),
(836, 67, '_billing_last_name', NULL),
(837, 67, '_billing_first_name', NULL),
(838, 67, 'payment_method', 'Cash On Delivery'),
(839, 68, 'first_name', 'Elias'),
(840, 68, 'last_name', 'Howlader'),
(841, 68, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(842, 68, 'address_two', NULL),
(843, 68, 'phone', '0123'),
(844, 68, 'email', 'elihowlader@hotmail.com'),
(845, 68, 'country', 'Bangladesh'),
(846, 68, 'state', 'Dhaka'),
(847, 68, 'city', 'Badda'),
(848, 68, 'zip', '1200'),
(849, 68, '_customer_user', '2'),
(850, 68, '_billing_postcode', '1200'),
(851, 68, '_billing_company', NULL),
(852, 68, '_billing_last_name', NULL),
(853, 68, '_billing_first_name', NULL),
(854, 68, 'payment_method', 'Cash On Delivery'),
(855, 69, 'first_name', 'Elias'),
(856, 69, 'last_name', 'Howlader'),
(857, 69, 'address_one', 'House 15/1, Road - 5, Block -A, Mirpur'),
(858, 69, 'address_two', NULL),
(859, 69, 'phone', '01234'),
(860, 69, 'email', 'elihowlader@hotmail.com'),
(861, 69, 'country', 'Bangladesh'),
(862, 69, 'state', 'Dhaka'),
(863, 69, 'city', 'Badda'),
(864, 69, 'zip', '1200'),
(865, 69, '_customer_user', '2'),
(866, 69, '_billing_postcode', '1200'),
(867, 69, '_billing_company', NULL),
(868, 69, '_billing_last_name', NULL),
(869, 69, '_billing_first_name', NULL),
(870, 69, 'payment_method', 'DeliveryChargeOnly'),
(871, 69, 'processing_date', '2021-02-10'),
(872, 70, 'first_name', 'Demo'),
(873, 70, 'last_name', 'User'),
(874, 70, 'address_one', 'Uttara,Dhaka'),
(875, 70, 'address_two', NULL),
(876, 70, 'phone', '0'),
(877, 70, 'email', 'demo@email.com'),
(878, 70, 'country', 'Bangladesh'),
(879, 70, 'state', 'Dhaka'),
(880, 70, 'city', 'Badda'),
(881, 70, 'zip', '1200'),
(882, 70, '_customer_user', '3'),
(883, 70, '_billing_postcode', '1200'),
(884, 70, '_billing_company', NULL),
(885, 70, '_billing_last_name', NULL),
(886, 70, '_billing_first_name', NULL),
(887, 70, 'payment_method', 'Cash On Delivery'),
(888, 71, 'first_name', 'Mohammad'),
(889, 71, 'last_name', 'Parvez'),
(890, 71, 'address_one', 'Flat# 9, House# 622, Road#7, Block# G'),
(891, 71, 'address_two', NULL),
(892, 71, 'phone', 'tanvir@itebd.com'),
(893, 71, 'email', 'tanvir@itebd.com'),
(894, 71, 'country', 'Bangladesh'),
(895, 71, 'state', 'Dhaka'),
(896, 71, 'city', 'Badda'),
(897, 71, 'zip', '1200'),
(898, 71, '_customer_user', '0'),
(899, 71, '_billing_postcode', '1200'),
(900, 71, '_billing_company', NULL),
(901, 71, '_billing_last_name', NULL),
(902, 71, '_billing_first_name', NULL),
(903, 71, 'payment_method', 'FullPayment'),
(917, 72, '_billing_last_name', NULL),
(918, 72, '_billing_first_name', NULL),
(919, 72, 'payment_method', 'Cash On Delivery'),
(920, 73, 'first_name', 'Aminul'),
(921, 73, 'last_name', 'Islam'),
(922, 73, 'address_one', 'Uttara,Dhaka'),
(923, 73, 'address_two', NULL),
(924, 73, 'phone', '01787884545'),
(925, 73, 'email', 'a.soton7@gmail.com'),
(926, 73, 'country', 'Bangladesh'),
(927, 73, 'state', 'Comilla'),
(928, 73, 'city', 'Laksham'),
(929, 73, 'zip', '1300'),
(930, 73, '_customer_user', '4'),
(931, 73, '_billing_postcode', '1300'),
(932, 73, '_billing_company', NULL),
(933, 73, '_billing_last_name', NULL),
(934, 73, '_billing_first_name', NULL),
(935, 73, 'payment_method', 'Cash On Delivery'),
(936, 27, 'product_status', 'reject'),
(964, 75, 'address_two', NULL),
(939, 28, 'product_status', 'reject'),
(961, 75, 'first_name', 'Aminul'),
(942, 29, 'product_status', 'reject'),
(963, 75, 'address_one', 'Uttara,Dhaka'),
(962, 75, 'last_name', 'Islam'),
(945, 74, 'first_name', 'sohel'),
(946, 74, 'last_name', 'Ahmed'),
(947, 74, 'address_one', 'Uttara,Dhaka'),
(948, 74, 'address_two', NULL),
(949, 74, 'phone', '01981368525'),
(950, 74, 'email', 'sohelahmeditebd@gmail.com'),
(951, 74, 'country', 'Bangladesh'),
(952, 74, 'state', 'Dhaka'),
(953, 74, 'city', 'Badda'),
(954, 74, 'zip', '1200'),
(955, 74, '_customer_user', '1'),
(956, 74, '_billing_postcode', '1200'),
(957, 74, '_billing_company', NULL),
(958, 74, '_billing_last_name', NULL),
(959, 74, '_billing_first_name', NULL),
(960, 74, 'payment_method', 'Cash On Delivery'),
(965, 75, 'phone', '0'),
(966, 75, 'email', 'a.soton7@gmail.com'),
(967, 75, 'country', 'Bangladesh'),
(968, 75, 'state', 'Comilla'),
(969, 75, 'city', 'Laksham'),
(970, 75, 'zip', '1300'),
(971, 75, '_customer_user', '4'),
(972, 75, '_billing_postcode', '1300'),
(973, 75, '_billing_company', NULL),
(974, 75, '_billing_last_name', NULL),
(975, 75, '_billing_first_name', NULL),
(976, 75, 'payment_method', 'Cash On Delivery'),
(977, 39, 'product_status', 'reject'),
(980, 76, 'first_name', 'Partho'),
(981, 76, 'last_name', 'Kar'),
(982, 76, 'address_one', 'Uttara,Dhaka'),
(983, 76, 'address_two', NULL),
(984, 76, 'phone', '01435345'),
(985, 76, 'email', 'parthokar90@gmail.com'),
(986, 76, 'country', 'Bangladesh'),
(987, 76, 'state', 'Dhaka'),
(988, 76, 'city', 'Badda'),
(989, 76, 'zip', '1200'),
(990, 76, '_customer_user', '5'),
(991, 76, '_billing_postcode', '1200'),
(992, 76, '_billing_company', NULL),
(993, 76, '_billing_last_name', NULL),
(994, 76, '_billing_first_name', NULL),
(995, 76, 'payment_method', 'Cash On Delivery'),
(996, 5, 'product_status', 'reject'),
(1001, 80, 'first_name', 'Aminul'),
(999, 73, 'processing_date', '2021-03-18'),
(1000, 72, 'processing_date', '2021-03-18'),
(1002, 80, 'last_name', 'Islam'),
(1003, 80, 'address_one', 'Uttara,Dhaka'),
(1004, 80, 'address_two', NULL),
(1005, 80, 'phone', '01787884545'),
(1006, 80, 'email', 'a.soton7@gmail.com'),
(1007, 80, 'country', 'Bangladesh'),
(1008, 80, 'state', 'Dhaka'),
(1009, 80, 'city', 'Badda'),
(1010, 80, 'zip', '1200'),
(1011, 80, '_customer_user', '4'),
(1012, 80, '_billing_postcode', '1200'),
(1013, 80, '_billing_company', NULL),
(1014, 80, '_billing_last_name', NULL),
(1015, 80, '_billing_first_name', NULL),
(1016, 80, 'payment_method', 'DeliveryChargeOnly'),
(1017, 81, 'first_name', 'Aminul'),
(1018, 81, 'last_name', 'Islam'),
(1019, 81, 'address_one', 'Uttara,Dhaka'),
(1020, 81, 'address_two', NULL),
(1021, 81, 'phone', '0'),
(1022, 81, 'email', 'a.soton7@gmail.com'),
(1023, 81, 'country', 'Bangladesh'),
(1024, 81, 'state', 'Dhaka'),
(1025, 81, 'city', 'Badda'),
(1026, 81, 'zip', '1200'),
(1027, 81, '_customer_user', '4'),
(1028, 81, '_billing_postcode', '1200'),
(1029, 81, '_billing_company', NULL),
(1030, 81, '_billing_last_name', NULL),
(1031, 81, '_billing_first_name', NULL),
(1032, 81, 'payment_method', 'Cash On Delivery'),
(1033, 76, 'processing_date', '2021-03-18'),
(1034, 45, 'product_status', 'reject'),
(1075, 88, 'city', 'Laksham'),
(1074, 88, 'state', 'Comilla'),
(1037, 46, 'product_status', 'reject'),
(1073, 88, 'country', 'Bangladesh'),
(1071, 88, 'phone', '01981368525'),
(1040, 47, 'product_status', 'reject'),
(1072, 88, 'email', 'sohelahmeditebd@gmail.com'),
(1043, 48, 'product_status', 'reject'),
(1064, 4, 'product_status', 'reject'),
(1069, 88, 'address_one', 'Uttara,Dhaka'),
(1046, 39, 'product_status', 'reject'),
(1070, 88, 'address_two', NULL),
(1049, 27, 'product_status', 'reject'),
(1061, 3, 'product_status', 'reject'),
(1067, 88, 'first_name', 'sohel'),
(1052, 28, 'product_status', 'reject'),
(1068, 88, 'last_name', 'Ahmed'),
(1055, 29, 'product_status', 'reject'),
(1058, 2, 'product_status', 'reject'),
(1076, 88, 'zip', '1300'),
(1077, 88, '_customer_user', '1'),
(1078, 88, '_billing_postcode', '1300'),
(1079, 88, '_billing_company', NULL),
(1080, 88, '_billing_last_name', NULL),
(1081, 88, '_billing_first_name', NULL),
(1082, 88, 'payment_method', 'Cash On Delivery'),
(1083, 90, 'first_name', 'Aminul'),
(1084, 90, 'last_name', 'Islam'),
(1085, 90, 'address_one', 'Uttara,Dhaka'),
(1086, 90, 'address_two', NULL),
(1087, 90, 'phone', '01787884545'),
(1088, 90, 'email', 'a.soton7@gmail.com'),
(1089, 90, 'country', 'Bangladesh'),
(1090, 90, 'state', 'Dhaka'),
(1091, 90, 'city', 'Badda'),
(1092, 90, 'zip', '1200'),
(1093, 90, '_customer_user', '4'),
(1094, 90, '_billing_postcode', '1200'),
(1095, 90, '_billing_company', NULL),
(1096, 90, '_billing_last_name', NULL),
(1097, 90, '_billing_first_name', NULL),
(1098, 90, 'payment_method', 'Cash On Delivery'),
(1099, 91, 'first_name', 'Aminul'),
(1100, 91, 'last_name', 'Islam'),
(1101, 91, 'address_one', 'Uttara,Dhaka'),
(1102, 91, 'address_two', NULL),
(1103, 91, 'phone', '0'),
(1104, 91, 'email', 'a.soton7@gmail.com'),
(1105, 91, 'country', 'Bangladesh'),
(1106, 91, 'state', 'Dhaka'),
(1107, 91, 'city', 'Badda'),
(1108, 91, 'zip', '1200'),
(1109, 91, '_customer_user', '4'),
(1110, 91, '_billing_postcode', '1200'),
(1111, 91, '_billing_company', NULL),
(1112, 91, '_billing_last_name', NULL),
(1113, 91, '_billing_first_name', NULL),
(1114, 91, 'payment_method', 'Cash On Delivery'),
(1115, 91, 'processing_date', '2021-03-18'),
(1116, 27, 'product_status', 'reject'),
(1128, 94, 'address_one', 'Uttara,Dhaka'),
(1127, 94, 'last_name', 'Ahmed'),
(1119, 28, 'product_status', 'reject'),
(1126, 94, 'first_name', 'sohel'),
(1122, 29, 'product_status', 'reject'),
(1125, 90, 'processing_date', '2021-03-18'),
(1129, 94, 'address_two', NULL),
(1130, 94, 'phone', '01981368525'),
(1131, 94, 'email', 'sohelahmeditebd@gmail.com'),
(1132, 94, 'country', 'Bangladesh'),
(1133, 94, 'state', 'Comilla'),
(1134, 94, 'city', 'Laksham'),
(1135, 94, 'zip', '1300'),
(1136, 94, '_customer_user', '1'),
(1137, 94, '_billing_postcode', '1300'),
(1138, 94, '_billing_company', NULL),
(1139, 94, '_billing_last_name', NULL),
(1140, 94, '_billing_first_name', NULL),
(1141, 94, 'payment_method', 'Cash On Delivery'),
(1142, 97, 'first_name', 'sohel'),
(1143, 97, 'last_name', 'Ahmed'),
(1144, 97, 'address_one', 'chandpur'),
(1145, 97, 'address_two', NULL),
(1146, 97, 'phone', '01981368525'),
(1147, 97, 'email', 'sohelahmeditebd@gmail.com'),
(1148, 97, 'country', 'Bangladesh'),
(1149, 97, 'state', 'Comilla'),
(1150, 97, 'city', 'Laksham'),
(1151, 97, 'zip', '1300'),
(1152, 97, '_customer_user', '1'),
(1153, 97, '_billing_postcode', '1300'),
(1154, 97, '_billing_company', NULL),
(1155, 97, '_billing_last_name', NULL),
(1156, 97, '_billing_first_name', NULL),
(1157, 97, 'payment_method', 'Cash On Delivery'),
(1158, 41, 'product_status', 'reject'),
(1169, 88, 'processing_date', '2021-03-18'),
(1161, 42, 'product_status', 'reject'),
(1168, 94, 'processing_date', '2021-03-18'),
(1164, 43, 'product_status', 'reject'),
(1167, 97, 'processing_date', '2021-03-18'),
(1170, 102, 'first_name', 'rana'),
(1171, 102, 'last_name', 'khan'),
(1172, 102, 'address_one', 'Uttara,Dhaka'),
(1173, 102, 'address_two', NULL),
(1174, 102, 'phone', '0'),
(1175, 102, 'email', 'sohelahmedite@gmail.com'),
(1176, 102, 'country', 'Bangladesh'),
(1177, 102, 'state', 'Dhaka'),
(1178, 102, 'city', 'Badda'),
(1179, 102, 'zip', '1200'),
(1180, 102, '_customer_user', '6'),
(1181, 102, '_billing_postcode', '1200'),
(1182, 102, '_billing_company', NULL),
(1183, 102, '_billing_last_name', NULL),
(1184, 102, '_billing_first_name', NULL),
(1185, 102, 'payment_method', 'Cash On Delivery'),
(1186, 103, 'first_name', 'rana'),
(1187, 103, 'last_name', 'khan'),
(1188, 103, 'address_one', 'Uttara,Dhaka'),
(1189, 103, 'address_two', NULL),
(1190, 103, 'phone', '0'),
(1191, 103, 'email', 'sohelahmedite@gmail.com'),
(1192, 103, 'country', 'Bangladesh'),
(1193, 103, 'state', 'Dhaka'),
(1194, 103, 'city', 'Badda'),
(1195, 103, 'zip', '1200'),
(1196, 103, '_customer_user', '6'),
(1197, 103, '_billing_postcode', '1200'),
(1198, 103, '_billing_company', NULL),
(1199, 103, '_billing_last_name', NULL),
(1200, 103, '_billing_first_name', NULL),
(1201, 103, 'payment_method', 'Cash On Delivery'),
(1202, 103, 'processing_date', '2021-03-18'),
(1203, 109, 'first_name', 'rana'),
(1204, 109, 'last_name', 'khan'),
(1205, 109, 'address_one', 'Uttara,Dhaka'),
(1206, 109, 'address_two', NULL),
(1207, 109, 'phone', '0'),
(1208, 109, 'email', 'sohelahmedite@gmail.com'),
(1209, 109, 'country', 'Bangladesh'),
(1210, 109, 'state', 'chandpur'),
(1211, 109, 'city', 'matlab'),
(1212, 109, 'zip', '2300'),
(1213, 109, '_customer_user', '6'),
(1214, 109, '_billing_postcode', '2300'),
(1215, 109, '_billing_company', NULL),
(1216, 109, '_billing_last_name', NULL),
(1217, 109, '_billing_first_name', NULL),
(1218, 109, 'payment_method', 'FullPayment'),
(1219, 110, 'first_name', 'Demo'),
(1220, 110, 'last_name', 'User'),
(1221, 110, 'address_one', 'Uttara,Dhaka'),
(1222, 110, 'address_two', NULL),
(1223, 110, 'phone', '435435'),
(1224, 110, 'email', 'demo@email.com'),
(1225, 110, 'country', 'Bangladesh'),
(1226, 110, 'state', 'Comilla'),
(1227, 110, 'city', 'Laksham'),
(1228, 110, 'zip', '1300'),
(1229, 110, '_customer_user', '3'),
(1230, 110, '_billing_postcode', '1300'),
(1231, 110, '_billing_company', NULL),
(1232, 110, '_billing_last_name', NULL),
(1233, 110, '_billing_first_name', NULL),
(1234, 110, 'payment_method', 'Cash On Delivery'),
(1235, 110, 'processing_date', '2021-03-20'),
(1236, 109, 'processing_date', '2021-03-20'),
(1237, 75, 'processing_date', '2021-03-20'),
(1238, 27, 'product_status', 'reject'),
(1239, 27, 'reject_date', '2021-03-20'),
(1467, 27, 'product_status', 'reject'),
(1241, 28, 'product_status', 'reject'),
(1242, 28, 'reject_date', '2021-03-20'),
(1243, 28, 'reject_qty', '1'),
(1244, 115, 'stock_status', NULL),
(1245, 115, 'regular_price', '400'),
(1246, 115, 'sale_price', '300'),
(1247, 115, 'weight', NULL),
(1248, 115, 'length', NULL),
(1249, 115, 'width', NULL),
(1250, 115, 'height', NULL),
(1251, 115, 'product_stock', '200'),
(1252, 115, 'start_stock', '200'),
(1253, 115, '_sku', '398'),
(1254, 115, 'attached_file', '1616225794.jpg'),
(1255, 115, 'gallery_file', 'Jeans 2-2.jpg'),
(1257, 115, 'gallery_file', 'leggings 1-2.jpg'),
(1258, 116, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"},{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(1259, 115, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"},{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(1260, 116, 'attribute_stock', '95'),
(1261, 116, 'attribute_low_stock', '10'),
(1262, 116, 'att_status', '1'),
(1263, 117, 'first_name', 'sohel'),
(1264, 117, 'last_name', 'Ahmed'),
(1265, 117, 'address_one', 'chandpur'),
(1266, 117, 'address_two', NULL),
(1267, 117, 'phone', '01981368525'),
(1268, 117, 'email', 'sohelahmeditebd@gmail.com'),
(1269, 117, 'country', 'Bangladesh'),
(1270, 117, 'state', 'Dhaka'),
(1271, 117, 'city', 'Badda'),
(1272, 117, 'zip', '1200'),
(1273, 117, '_customer_user', '1'),
(1274, 117, '_billing_postcode', '1200'),
(1275, 117, '_billing_company', NULL),
(1276, 117, '_billing_last_name', NULL),
(1277, 117, '_billing_first_name', NULL),
(1278, 117, 'payment_method', 'Cash On Delivery'),
(1279, 118, 'first_name', 'sohel'),
(1280, 118, 'last_name', 'Ahmed'),
(1281, 118, 'address_one', 'chandpur'),
(1282, 118, 'address_two', NULL),
(1283, 118, 'phone', '01981368525'),
(1284, 118, 'email', 'sohelahmeditebd@gmail.com'),
(1285, 118, 'country', 'Bangladesh'),
(1286, 118, 'state', 'Dhaka'),
(1287, 118, 'city', 'Badda'),
(1288, 118, 'zip', '1200'),
(1289, 118, '_customer_user', '1'),
(1290, 118, '_billing_postcode', '1200'),
(1291, 118, '_billing_company', NULL),
(1292, 118, '_billing_last_name', NULL),
(1293, 118, '_billing_first_name', NULL),
(1294, 118, 'payment_method', 'Cash On Delivery'),
(1295, 119, 'first_name', 'sohel'),
(1296, 119, 'last_name', 'Ahmed'),
(1297, 119, 'address_one', 'chandpur'),
(1298, 119, 'address_two', NULL),
(1299, 119, 'phone', '01981368525'),
(1300, 119, 'email', 'sohelahmeditebd@gmail.com'),
(1301, 119, 'country', 'Bangladesh'),
(1302, 119, 'state', 'Comilla'),
(1303, 119, 'city', 'Laksham'),
(1304, 119, 'zip', '1300'),
(1305, 119, '_customer_user', '1'),
(1306, 119, '_billing_postcode', '1300'),
(1307, 119, '_billing_company', NULL),
(1308, 119, '_billing_last_name', NULL),
(1309, 119, '_billing_first_name', NULL),
(1310, 119, 'payment_method', 'Cash On Delivery'),
(1311, 120, 'first_name', 'sohel'),
(1312, 120, 'last_name', 'Ahmed'),
(1313, 120, 'address_one', 'chandpur'),
(1314, 120, 'address_two', NULL),
(1315, 120, 'phone', '01981368525'),
(1316, 120, 'email', 'sohelahmeditebd@gmail.com'),
(1317, 120, 'country', 'Bangladesh'),
(1318, 120, 'state', 'chandpur'),
(1319, 120, 'city', 'matlab'),
(1320, 120, 'zip', '2300'),
(1321, 120, '_customer_user', '1'),
(1322, 120, '_billing_postcode', '2300'),
(1323, 120, '_billing_company', NULL),
(1324, 120, '_billing_last_name', NULL),
(1325, 120, '_billing_first_name', NULL),
(1326, 120, 'payment_method', 'Cash On Delivery'),
(1328, 120, 'processing_date', '2021-03-20'),
(1329, 119, 'processing_date', '2021-03-20'),
(1330, 123, 'first_name', 'sohel'),
(1331, 123, 'last_name', 'Ahmed'),
(1332, 123, 'address_one', 'chandpur'),
(1333, 123, 'address_two', NULL),
(1334, 123, 'phone', '01981368525'),
(1335, 123, 'email', 'sohelahmeditebd@gmail.com'),
(1336, 123, 'country', 'Bangladesh'),
(1337, 123, 'state', 'Comilla'),
(1338, 123, 'city', 'Laksham'),
(1339, 123, 'zip', '1300'),
(1340, 123, '_customer_user', '1'),
(1341, 123, '_billing_postcode', '1300'),
(1342, 123, '_billing_company', NULL),
(1343, 123, '_billing_last_name', NULL),
(1344, 123, '_billing_first_name', NULL),
(1345, 123, 'payment_method', 'Cash On Delivery'),
(1346, 123, 'processing_date', '2021-03-20'),
(1347, 126, 'first_name', 'sohel'),
(1348, 126, 'last_name', 'Ahmed'),
(1349, 126, 'address_one', 'chandpur'),
(1350, 126, 'address_two', NULL),
(1351, 126, 'phone', '01981368525'),
(1352, 126, 'email', 'sohelahmeditebd@gmail.com'),
(1353, 126, 'country', 'Bangladesh'),
(1354, 126, 'state', 'Dhaka'),
(1355, 126, 'city', 'Badda'),
(1356, 126, 'zip', '1200'),
(1357, 126, '_customer_user', '1'),
(1358, 126, '_billing_postcode', '1200'),
(1359, 126, '_billing_company', NULL),
(1360, 126, '_billing_last_name', NULL),
(1361, 126, '_billing_first_name', NULL),
(1362, 126, 'payment_method', 'Cash On Delivery'),
(1363, 127, 'first_name', 'sohel'),
(1364, 127, 'last_name', 'Ahmed'),
(1365, 127, 'address_one', 'chandpur'),
(1366, 127, 'address_two', NULL),
(1367, 127, 'phone', '01981368525'),
(1368, 127, 'email', 'sohelahmeditebd@gmail.com'),
(1369, 127, 'country', 'Bangladesh'),
(1370, 127, 'state', 'Dhaka'),
(1371, 127, 'city', 'Badda'),
(1372, 127, 'zip', '1200'),
(1373, 127, '_customer_user', '1'),
(1374, 127, '_billing_postcode', '1200'),
(1375, 127, '_billing_company', NULL),
(1376, 127, '_billing_last_name', NULL),
(1377, 127, '_billing_first_name', NULL),
(1378, 127, 'payment_method', 'Cash On Delivery'),
(1379, 128, 'first_name', 'Demo'),
(1380, 128, 'last_name', 'User'),
(1381, 128, 'address_one', 'Mirpur,Dhaka'),
(1382, 128, 'address_two', NULL),
(1383, 128, 'phone', '435435'),
(1384, 128, 'email', 'demo@email.com'),
(1385, 128, 'country', 'Bangladesh'),
(1386, 128, 'state', 'chandpur'),
(1387, 128, 'city', 'matlab'),
(1388, 128, 'zip', '2300'),
(1389, 128, '_customer_user', '3'),
(1390, 128, '_billing_postcode', '2300'),
(1391, 128, '_billing_company', NULL),
(1392, 128, '_billing_last_name', NULL),
(1393, 128, '_billing_first_name', NULL),
(1394, 128, 'payment_method', 'Cash On Delivery'),
(1395, 129, 'first_name', 'Elias'),
(1396, 129, 'last_name', 'Howlader'),
(1397, 129, 'address_one', 'Uttara,Dhaka'),
(1398, 129, 'address_two', NULL),
(1399, 129, 'phone', '0123456789'),
(1400, 129, 'email', 'elihowlader@hotmail.com'),
(1401, 129, 'country', 'Bangladesh'),
(1402, 129, 'state', 'Dhaka'),
(1403, 129, 'city', 'Badda'),
(1404, 129, 'zip', '1200'),
(1405, 129, '_customer_user', '2'),
(1406, 129, '_billing_postcode', '1200'),
(1407, 129, '_billing_company', NULL),
(1408, 129, '_billing_last_name', NULL),
(1409, 129, '_billing_first_name', NULL),
(1410, 129, 'payment_method', 'Cash On Delivery'),
(1411, 130, 'first_name', 'Elias'),
(1412, 130, 'last_name', 'Howlader'),
(1413, 130, 'address_one', 'Uttara,Dhaka'),
(1414, 130, 'address_two', NULL);
INSERT INTO `postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1415, 130, 'phone', '0123456789'),
(1416, 130, 'email', 'elihowlader@hotmail.com'),
(1417, 130, 'country', 'Bangladesh'),
(1418, 130, 'state', 'chandpur'),
(1419, 130, 'city', 'matlab'),
(1420, 130, 'zip', '2300'),
(1421, 130, '_customer_user', '2'),
(1422, 130, '_billing_postcode', '2300'),
(1423, 130, '_billing_company', NULL),
(1424, 130, '_billing_last_name', NULL),
(1425, 130, '_billing_first_name', NULL),
(1426, 130, 'payment_method', 'Cash On Delivery'),
(1427, 130, 'processing_date', '2021-03-21'),
(1428, 126, 'processing_date', '2021-03-21'),
(1429, 127, 'processing_date', '2021-03-21'),
(1430, 128, 'processing_date', '2021-03-21'),
(1431, 137, 'first_name', 'Elias'),
(1432, 137, 'last_name', 'Howlader'),
(1433, 137, 'address_one', 'Uttara,Dhaka'),
(1434, 137, 'address_two', NULL),
(1435, 137, 'phone', '0123456789'),
(1436, 137, 'email', 'elihowlader@hotmail.com'),
(1437, 137, 'country', 'Bangladesh'),
(1438, 137, 'state', 'Comilla'),
(1439, 137, 'city', 'Laksham'),
(1440, 137, 'zip', '1300'),
(1441, 137, '_customer_user', '2'),
(1442, 137, '_billing_postcode', '1300'),
(1443, 137, '_billing_company', NULL),
(1444, 137, '_billing_last_name', NULL),
(1445, 137, '_billing_first_name', NULL),
(1446, 137, 'payment_method', 'Cash On Delivery'),
(1447, 138, 'first_name', 'Elias'),
(1448, 138, 'last_name', 'Howlader'),
(1449, 138, 'address_one', 'Uttara,Dhaka'),
(1450, 138, 'address_two', NULL),
(1451, 138, 'phone', '0123456789'),
(1452, 138, 'email', 'elihowlader@hotmail.com'),
(1453, 138, 'country', 'Bangladesh'),
(1454, 138, 'state', 'Dhaka'),
(1455, 138, 'city', 'Badda'),
(1456, 138, 'zip', '1200'),
(1457, 138, '_customer_user', '2'),
(1458, 138, '_billing_postcode', '1200'),
(1459, 138, '_billing_company', NULL),
(1460, 138, '_billing_last_name', NULL),
(1461, 138, '_billing_first_name', NULL),
(1462, 138, 'payment_method', 'Cash On Delivery'),
(1463, 138, 'processing_date', '2021-03-21'),
(1464, 27, 'product_status', 'reject'),
(1466, 27, 'reject_qty', '1'),
(1468, 27, 'reject_date', '2021-03-21'),
(1469, 27, 'reject_qty', '1'),
(1470, 7, 'product_status', 'reject'),
(1471, 7, 'reject_date', '2021-03-21'),
(1472, 7, 'reject_qty', '1'),
(1473, 141, 'first_name', 'Innovative'),
(1474, 141, 'last_name', 'Admin'),
(1475, 141, 'address_one', 'Uttara,Dhaka'),
(1476, 141, 'address_two', NULL),
(1477, 141, 'phone', '01777996579'),
(1478, 141, 'email', 'ariful@itebd.com'),
(1479, 141, 'country', 'Bangladesh'),
(1480, 141, 'state', 'Dhaka'),
(1481, 141, 'city', 'Badda'),
(1482, 141, 'zip', '1200'),
(1483, 141, '_customer_user', '7'),
(1484, 141, '_billing_postcode', '1200'),
(1485, 141, '_billing_company', NULL),
(1486, 141, '_billing_last_name', NULL),
(1487, 141, '_billing_first_name', NULL),
(1488, 141, 'payment_method', 'FullPayment'),
(1489, 142, 'first_name', 'Innovative'),
(1490, 142, 'last_name', 'Admin'),
(1491, 142, 'address_one', 'Uttara,Dhaka'),
(1492, 142, 'address_two', NULL),
(1493, 142, 'phone', '01777996579'),
(1494, 142, 'email', 'ariful@itebd.com'),
(1495, 142, 'country', 'Bangladesh'),
(1496, 142, 'state', 'chandpur'),
(1497, 142, 'city', 'matlab'),
(1498, 142, 'zip', '2300'),
(1499, 142, '_customer_user', '7'),
(1500, 142, '_billing_postcode', '2300'),
(1501, 142, '_billing_company', NULL),
(1502, 142, '_billing_last_name', NULL),
(1503, 142, '_billing_first_name', NULL),
(1504, 142, 'payment_method', 'Cash On Delivery'),
(1505, 143, 'first_name', 'Innovative'),
(1506, 143, 'last_name', 'Admin'),
(1507, 143, 'address_one', 'Uttara,Dhaka'),
(1508, 143, 'address_two', NULL),
(1509, 143, 'phone', '01777996579'),
(1510, 143, 'email', 'ariful@itebd.com'),
(1511, 143, 'country', 'Bangladesh'),
(1512, 143, 'state', 'Dhaka'),
(1513, 143, 'city', 'Badda'),
(1514, 143, 'zip', '1200'),
(1515, 143, '_customer_user', '7'),
(1516, 143, '_billing_postcode', '1200'),
(1517, 143, '_billing_company', NULL),
(1518, 143, '_billing_last_name', NULL),
(1519, 143, '_billing_first_name', NULL),
(1520, 143, 'payment_method', 'Cash On Delivery'),
(1521, 143, 'processing_date', '2021-03-22'),
(1522, 146, 'first_name', 'Innovative'),
(1523, 146, 'last_name', 'Admin'),
(1524, 146, 'address_one', 'Uttara,Dhaka'),
(1525, 146, 'address_two', NULL),
(1526, 146, 'phone', '01777996579'),
(1527, 146, 'email', 'ariful@itebd.com'),
(1528, 146, 'country', 'Bangladesh'),
(1529, 146, 'state', 'Dhaka'),
(1530, 146, 'city', 'Badda'),
(1531, 146, 'zip', '1200'),
(1532, 146, '_customer_user', '7'),
(1533, 146, '_billing_postcode', '1200'),
(1534, 146, '_billing_company', NULL),
(1535, 146, '_billing_last_name', NULL),
(1536, 146, '_billing_first_name', NULL),
(1537, 146, 'payment_method', 'DeliveryChargeOnly'),
(1538, 147, 'first_name', 'Innovative'),
(1539, 147, 'last_name', 'Admin'),
(1540, 147, 'address_one', 'Uttara,Dhaka'),
(1541, 147, 'address_two', NULL),
(1542, 147, 'phone', '01777996579'),
(1543, 147, 'email', 'ariful@itebd.com'),
(1544, 147, 'country', 'Bangladesh'),
(1545, 147, 'state', 'Dhaka'),
(1546, 147, 'city', 'Badda'),
(1547, 147, 'zip', '1200'),
(1548, 147, '_customer_user', '7'),
(1549, 147, '_billing_postcode', '1200'),
(1550, 147, '_billing_company', NULL),
(1551, 147, '_billing_last_name', NULL),
(1552, 147, '_billing_first_name', NULL),
(1553, 147, 'payment_method', 'Cash On Delivery'),
(1554, 148, 'first_name', 'Test'),
(1555, 148, 'last_name', 'User'),
(1556, 148, 'address_one', 'Uttara,Dhaka'),
(1557, 148, 'address_two', NULL),
(1558, 148, 'phone', '0'),
(1559, 148, 'email', 'test@email.com'),
(1560, 148, 'country', 'Bangladesh'),
(1561, 148, 'state', 'Comilla'),
(1562, 148, 'city', 'Laksham'),
(1563, 148, 'zip', '1300'),
(1564, 148, '_customer_user', '8'),
(1565, 148, '_billing_postcode', '1300'),
(1566, 148, '_billing_company', NULL),
(1567, 148, '_billing_last_name', NULL),
(1568, 148, '_billing_first_name', NULL),
(1569, 148, 'payment_method', 'Cash On Delivery'),
(1570, 149, 'first_name', 'fdgdfg'),
(1571, 149, 'last_name', 'dfgdfg'),
(1572, 149, 'address_one', 'dfgfdg'),
(1573, 149, 'address_two', NULL),
(1574, 149, 'phone', 'bigshotstyle20@gmail.com'),
(1575, 149, 'email', 'parthokar90@gmail.com'),
(1576, 149, 'country', 'Bangladesh'),
(1577, 149, 'state', 'Dhaka'),
(1578, 149, 'city', 'Badda'),
(1579, 149, 'zip', '1200'),
(1580, 149, '_customer_user', '0'),
(1581, 149, '_billing_postcode', '1200'),
(1582, 149, '_billing_company', NULL),
(1583, 149, '_billing_last_name', NULL),
(1584, 149, '_billing_first_name', NULL),
(1585, 149, 'payment_method', 'Cash On Delivery'),
(1586, 150, 'first_name', 'fgfd'),
(1587, 150, 'last_name', 'ertertert'),
(1588, 150, 'address_one', 'retertertert'),
(1589, 150, 'address_two', NULL),
(1590, 150, 'phone', 'a@email.com'),
(1591, 150, 'email', 'a@email.com'),
(1592, 150, 'country', 'Bangladesh'),
(1593, 150, 'state', 'Dhaka'),
(1594, 150, 'city', 'Badda'),
(1595, 150, 'zip', '1200'),
(1596, 150, '_customer_user', '0'),
(1597, 150, '_billing_postcode', '1200'),
(1598, 150, '_billing_company', NULL),
(1599, 150, '_billing_last_name', NULL),
(1600, 150, '_billing_first_name', NULL),
(1601, 150, 'payment_method', 'Cash On Delivery'),
(1602, 149, 'processing_date', '2021-03-23'),
(1603, 148, 'processing_date', '2021-03-23'),
(1604, 147, 'processing_date', '2021-03-23'),
(1605, 156, 'first_name', 'Test'),
(1606, 156, 'last_name', 'User'),
(1607, 156, 'address_one', 'Uttara,Dhaka'),
(1608, 156, 'address_two', NULL),
(1609, 156, 'phone', '0'),
(1610, 156, 'email', 'test@email.com'),
(1611, 156, 'country', 'Bangladesh'),
(1612, 156, 'state', 'Comilla'),
(1613, 156, 'city', 'Laksham'),
(1614, 156, 'zip', '1300'),
(1615, 156, '_customer_user', '8'),
(1616, 156, '_billing_postcode', '1300'),
(1617, 156, '_billing_company', NULL),
(1618, 156, '_billing_last_name', NULL),
(1619, 156, '_billing_first_name', NULL),
(1620, 156, 'payment_method', 'Cash On Delivery'),
(1621, 156, 'processing_date', '2021-03-23'),
(1622, 146, 'processing_date', '2021-03-28'),
(1623, 142, 'processing_date', '2021-03-28'),
(1635, 157, '_billing_postcode', '1200'),
(1636, 157, '_billing_company', NULL),
(1637, 157, '_billing_last_name', NULL),
(1638, 157, '_billing_first_name', NULL),
(1639, 157, 'payment_method', 'Cash On Delivery'),
(1640, 158, 'first_name', 'fdgdfg'),
(1641, 158, 'last_name', 'dfgdfg'),
(1642, 158, 'address_one', 'Uttara,Dhaka'),
(1643, 158, 'address_two', NULL),
(1644, 158, 'phone', 'bigshotstyle20@gmail.com'),
(1645, 158, 'email', 'parthokar90@gmail.com'),
(1646, 158, 'country', 'Bangladesh'),
(1647, 158, 'state', 'Comilla'),
(1648, 158, 'city', 'Laksham'),
(1649, 158, 'zip', '1300'),
(1650, 158, '_customer_user', '0'),
(1651, 158, '_billing_postcode', '1300'),
(1652, 158, '_billing_company', NULL),
(1653, 158, '_billing_last_name', NULL),
(1654, 158, '_billing_first_name', NULL),
(1655, 158, 'payment_method', 'Cash On Delivery'),
(1656, 159, 'first_name', 'Partho'),
(1657, 159, 'last_name', 'Kar'),
(1658, 159, 'address_one', 'Habiganj,Sylhet'),
(1659, 159, 'address_two', NULL),
(1660, 159, 'phone', '01435345'),
(1661, 159, 'email', 'parthokar90@gmail.com'),
(1662, 159, 'country', 'Bangladesh'),
(1663, 159, 'state', 'Comilla'),
(1664, 159, 'city', 'Laksham'),
(1665, 159, 'zip', '1300'),
(1666, 159, '_customer_user', '5'),
(1667, 159, '_billing_postcode', '1300'),
(1668, 159, '_billing_company', NULL),
(1669, 159, '_billing_last_name', NULL),
(1670, 159, '_billing_first_name', NULL),
(1671, 159, 'payment_method', 'Cash On Delivery'),
(1672, 159, 'processing_date', '2021-04-04'),
(1673, 158, 'processing_date', '2021-04-04'),
(1674, 163, 'first_name', 'Partho'),
(1675, 163, 'last_name', 'Kar'),
(1676, 163, 'address_one', 'Habiganj,Sylhet'),
(1677, 163, 'address_two', NULL),
(1678, 163, 'phone', '01435345'),
(1679, 163, 'email', 'parthokar90@gmail.com'),
(1680, 163, 'country', 'Bangladesh'),
(1681, 163, 'state', 'Comilla'),
(1682, 163, 'city', 'Laksham'),
(1683, 163, 'zip', '1300'),
(1684, 163, '_customer_user', '5'),
(1685, 163, '_billing_postcode', '1300'),
(1686, 163, '_billing_company', NULL),
(1687, 163, '_billing_last_name', NULL),
(1688, 163, '_billing_first_name', NULL),
(1689, 163, 'payment_method', 'Cash On Delivery'),
(1690, 164, 'first_name', 'Partho'),
(1691, 164, 'last_name', 'Kar'),
(1692, 164, 'address_one', 'Habiganj,Sylhet'),
(1693, 164, 'address_two', NULL),
(1694, 164, 'phone', '01435345'),
(1695, 164, 'email', 'parthokar90@gmail.com'),
(1696, 164, 'country', 'Bangladesh'),
(1697, 164, 'state', 'Dhaka'),
(1698, 164, 'city', 'Badda'),
(1699, 164, 'zip', '1200'),
(1700, 164, '_customer_user', '5'),
(1701, 164, '_billing_postcode', '1200'),
(1702, 164, '_billing_company', NULL),
(1703, 164, '_billing_last_name', NULL),
(1704, 164, '_billing_first_name', NULL),
(1705, 164, 'payment_method', 'Cash On Delivery'),
(1706, 164, 'processing_date', '2021-04-04'),
(1707, 163, 'processing_date', '2021-04-04');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `post_date` datetime DEFAULT current_timestamp(),
  `post_date_gmt` datetime DEFAULT current_timestamp(),
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime DEFAULT current_timestamp(),
  `post_modified_gmt` datetime NOT NULL DEFAULT current_timestamp(),
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 2, '2021-01-12 13:43:00', '2021-01-12 19:43:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'Bag', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'publish', 'open', 'open', '', 'Bag', '', '', '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', 0, '', 0, 'product', '', 0),
(2, 2, '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', 1, '', 0, 'product_varient', '', 0),
(3, 2, '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', 1, '', 0, 'product_varient', '', 0),
(4, 2, '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', 1, '', 0, 'product_varient', '', 0),
(5, 2, '2021-01-12 13:45:00', '2021-01-12 19:45:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'Necklace', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'publish', 'open', 'open', '', 'Necklace', '', '', '2021-01-12 15:46:18', '2021-01-12 15:46:18', '', 0, '', 0, 'product', '', 0),
(6, 2, '2021-01-12 13:46:00', '2021-01-12 19:46:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'Jeans', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'publish', 'open', 'open', '', 'Jeans', '', '', '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', 0, '', 0, 'product', '', 0),
(7, 2, '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', 6, '', 0, 'product_varient', '', 0),
(8, 2, '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', 6, '', 0, 'product_varient', '', 0),
(9, 2, '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', 6, '', 0, 'product_varient', '', 0),
(10, 2, '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', 6, '', 0, 'product_varient', '', 0),
(39, 2, '2021-01-12 18:24:00', '2021-01-13 00:24:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Belt', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'publish', 'open', 'open', '', 'Belt', '', '', '2021-01-12 20:26:16', '2021-01-12 20:26:16', '', 0, '', 0, 'product', '', 0),
(38, 2, '2021-01-12 17:30:00', '2021-01-12 23:30:00', 'Banner Image', 'Banner Image', 'Banner Image', 'publish', 'open', 'open', '', 'Banner Image', '', '', '2021-01-12 19:30:01', '2021-01-12 19:30:01', '', 0, '', 0, 'banner', '', 0),
(26, 2, '2021-01-09 16:08:00', '2021-01-09 22:08:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Tunic', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'publish', 'open', 'open', '', 'Tunic', '', '', '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', 0, '', 0, 'product', '', 0),
(27, 2, '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', 26, '', 0, 'product_varient', '', 0),
(28, 2, '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', 26, '', 0, 'product_varient', '', 0),
(29, 2, '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', 26, '', 0, 'product_varient', '', 0),
(40, 2, '2021-01-12 18:26:00', '2021-01-13 00:26:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Purse', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'publish', 'open', 'open', '', 'Purse', '', '', '2021-01-12 20:28:18', '2021-01-12 20:28:18', '', 0, '', 0, 'product', '', 0),
(41, 2, '2021-01-12 18:28:18', '2021-01-12 20:28:18', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:28:18', '2021-01-12 20:28:18', '', 40, '', 0, 'product_varient', '', 0),
(42, 2, '2021-01-12 18:28:18', '2021-01-12 20:28:18', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:28:18', '2021-01-12 20:28:18', '', 40, '', 0, 'product_varient', '', 0),
(43, 2, '2021-01-12 18:28:18', '2021-01-12 20:28:18', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:28:18', '2021-01-12 20:28:18', '', 40, '', 0, 'product_varient', '', 0),
(44, 2, '2021-01-12 18:28:00', '2021-01-13 00:28:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Skirt', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'publish', 'open', 'open', '', 'Skirt', '', '', '2021-01-12 20:30:16', '2021-01-12 20:30:16', '', 0, '', 0, 'product', '', 0),
(45, 2, '2021-01-12 18:30:16', '2021-01-12 20:30:16', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:30:16', '2021-01-12 20:30:16', '', 44, '', 0, 'product_varient', '', 0),
(46, 2, '2021-01-12 18:30:16', '2021-01-12 20:30:16', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:30:16', '2021-01-12 20:30:16', '', 44, '', 0, 'product_varient', '', 0),
(47, 2, '2021-01-12 18:30:16', '2021-01-12 20:30:16', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:30:16', '2021-01-12 20:30:16', '', 44, '', 0, 'product_varient', '', 0),
(48, 2, '2021-01-12 18:30:16', '2021-01-12 20:30:16', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:30:16', '2021-01-12 20:30:16', '', 44, '', 0, 'product_varient', '', 0),
(49, 2, '2021-01-12 18:30:00', '2021-01-12 00:30:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Dresses', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'publish', 'open', 'open', '', 'Dresses', '', '', '2021-01-12 20:32:13', '2021-01-12 20:32:13', '', 0, '', 0, 'product', '', 0),
(50, 2, '2021-01-12 18:32:13', '2021-01-12 20:32:13', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:32:13', '2021-01-12 20:32:13', '', 49, '', 0, 'product_varient', '', 0),
(51, 2, '2021-01-12 18:32:13', '2021-01-12 20:32:13', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:32:13', '2021-01-12 20:32:13', '', 49, '', 0, 'product_varient', '', 0),
(87, 5, '2021-03-18 18:11:17', '2021-03-18 18:11:17', 'asdfdsfds', 'Big Problem', '', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 18:11:17', '2021-03-18 18:11:17', '', 0, '', 0, 'genarel_quiry', '', 0),
(86, 4, '2021-03-18 17:55:17', '2021-03-18 17:55:17', 'kono rply nai keno??', 'Query', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 17:55:17', '2021-03-18 17:55:17', '', 0, '', 0, 'genarel_quiry', '', 0),
(85, 1, '2021-03-18 17:53:09', '2021-03-18 17:53:09', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'ddd', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 17:53:09', '2021-03-18 17:53:09', '', 0, '', 0, 'genarel_quiry', '', 0),
(84, 4, '2021-03-18 17:51:27', '2021-03-18 17:51:27', 'hello boss', 'question', 'jksdjalkjf', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 17:51:27', '2021-03-18 17:51:27', '', 0, '', 0, 'genarel_quiry', '', 0),
(132, 2, '2021-03-21 11:49:19', '2021-03-21 17:49:19', '', '126', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-21 11:49:19', '2021-03-21 13:49:19', 'Mrpeon', 131, '', 0, 'invoice_order', '', 0),
(131, 2, '2021-03-21 11:49:19', '2021-03-21 17:49:19', '126,130', 'invoice', '', 'publish', 'open', 'open', '', 'inv-11', '', '', '2021-03-21 11:49:19', '2021-03-21 13:49:19', 'Mrpeon', 0, '', 0, 'invoice', '', 0),
(124, 2, '2021-03-20 17:45:27', '2021-03-20 23:45:27', '123', 'invoice', '', 'publish', 'open', 'open', '', 'inv-10', '', '', '2021-03-20 17:45:27', '2021-03-20 19:45:27', 'ddd', 0, '', 0, 'invoice', '', 0),
(77, 2, '2021-03-18 15:26:43', '2021-03-18 21:26:43', '72,73', 'invoice', '', 'publish', 'open', 'open', '', 'inv-2', '', '', '2021-03-18 15:26:43', '2021-03-18 17:26:43', 'bigshot', 0, '', 0, 'invoice', '', 0),
(133, 2, '2021-03-21 11:49:19', '2021-03-21 17:49:19', '', '130', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-21 11:49:19', '2021-03-21 13:49:19', 'Mrpeon', 131, '', 0, 'invoice_order', '', 0),
(62, 2, '2021-01-15 03:43:18', '2021-01-15 09:43:18', '58,59', 'invoice', '', 'publish', 'open', 'open', '', 'inv-1', '', '', '2021-01-15 03:43:18', '2021-01-15 05:43:18', 'Mrpeon', 0, '', 0, 'invoice', '', 0),
(63, 2, '2021-01-15 03:43:18', '2021-01-15 09:43:18', '', '58', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-01-15 03:43:18', '2021-01-15 05:43:18', 'Mrpeon', 62, '', 0, 'invoice_order', '', 0),
(64, 2, '2021-01-15 03:43:18', '2021-01-15 09:43:18', '', '59', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-01-15 03:43:18', '2021-01-15 05:43:18', 'Mrpeon', 62, '', 0, 'invoice_order', '', 0),
(83, 2, '2021-03-18 15:48:42', '2021-03-18 21:48:42', '', '76', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 15:48:42', '2021-03-18 17:48:42', 'tye', 82, '', 0, 'invoice_order', '', 0),
(82, 2, '2021-03-18 15:48:42', '2021-03-18 21:48:42', '76', 'invoice', '', 'publish', 'open', 'open', '', 'inv-3', '', '', '2021-03-18 15:48:42', '2021-03-18 17:48:42', 'tye', 0, '', 0, 'invoice', '', 0),
(79, 2, '2021-03-18 15:26:43', '2021-03-18 21:26:43', '', '73', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 15:26:43', '2021-03-18 17:26:43', 'bigshot', 77, '', 0, 'invoice_order', '', 0),
(78, 2, '2021-03-18 15:26:43', '2021-03-18 21:26:43', '', '72', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 15:26:43', '2021-03-18 17:26:43', 'bigshot', 77, '', 0, 'invoice_order', '', 0),
(89, 4, '2021-03-18 18:36:58', '2021-03-18 18:36:58', 'hello boss , why??', 'Query', 'Lorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industry', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 18:36:58', '2021-03-18 18:36:58', '', 0, '', 0, 'genarel_quiry', '', 0),
(122, 2, '2021-03-20 17:42:52', '2021-03-20 23:42:52', '', '119', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-20 17:42:52', '2021-03-20 19:42:52', 'sss', 121, '', 0, 'invoice_order', '', 0),
(92, 2, '2021-03-18 16:55:42', '2021-03-18 22:55:42', '91', 'invoice', '', 'publish', 'open', 'open', '', 'inv-4', '', '', '2021-03-18 16:55:42', '2021-03-18 18:55:42', 'itebd', 0, '', 0, 'invoice', '', 0),
(93, 2, '2021-03-18 16:55:42', '2021-03-18 22:55:42', '', '91', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 16:55:42', '2021-03-18 18:55:42', 'itebd', 92, '', 0, 'invoice_order', '', 0),
(121, 2, '2021-03-20 17:42:52', '2021-03-20 23:42:52', '119', 'invoice', '', 'publish', 'open', 'open', '', 'inv-9', '', '', '2021-03-20 17:42:52', '2021-03-20 19:42:52', 'sss', 0, '', 0, 'invoice', '', 0),
(95, 2, '2021-03-18 17:35:10', '2021-03-18 23:35:10', '90', 'invoice', '', 'publish', 'open', 'open', '', 'inv-5', '', '', '2021-03-18 17:35:10', '2021-03-18 19:35:10', 'dhl', 0, '', 0, 'invoice', '', 0),
(96, 2, '2021-03-18 17:35:10', '2021-03-18 23:35:10', '', '90', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 17:35:10', '2021-03-18 19:35:10', 'dhl', 95, '', 0, 'invoice_order', '', 0),
(98, 2, '2021-03-18 17:49:12', '2021-03-18 23:49:12', '88,94,97', 'invoice', '', 'publish', 'open', 'open', '', 'inv-6', '', '', '2021-03-18 17:49:12', '2021-03-18 19:49:12', 'bigshot', 0, '', 0, 'invoice', '', 0),
(99, 2, '2021-03-18 17:49:12', '2021-03-18 23:49:12', '', '88', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 17:49:12', '2021-03-18 19:49:12', 'bigshot', 98, '', 0, 'invoice_order', '', 0),
(100, 2, '2021-03-18 17:49:12', '2021-03-18 23:49:12', '', '94', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 17:49:12', '2021-03-18 19:49:12', 'bigshot', 98, '', 0, 'invoice_order', '', 0),
(101, 2, '2021-03-18 17:49:12', '2021-03-18 23:49:12', '', '97', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 17:49:12', '2021-03-18 19:49:12', 'bigshot', 98, '', 0, 'invoice_order', '', 0),
(125, 2, '2021-03-20 17:45:27', '2021-03-20 23:45:27', '', '123', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-20 17:45:27', '2021-03-20 19:45:27', 'ddd', 124, '', 0, 'invoice_order', '', 0),
(104, 2, '2021-03-18 18:13:17', '2021-03-19 00:13:17', '103', 'invoice', '', 'publish', 'open', 'open', '', 'inv-7', '', '', '2021-03-18 18:13:17', '2021-03-18 20:13:17', 'dfsaz', 0, '', 0, 'invoice', '', 0),
(105, 2, '2021-03-18 18:13:17', '2021-03-19 00:13:17', '', '103', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 18:13:17', '2021-03-18 20:13:17', 'dfsaz', 104, '', 0, 'invoice_order', '', 0),
(106, 6, '2021-03-18 20:18:00', '2021-03-18 20:18:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'lorem', 'Lorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industry', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 20:18:00', '2021-03-18 20:18:00', '', 0, '', 0, 'genarel_quiry', '', 0),
(107, 6, '2021-03-18 20:18:28', '2021-03-18 20:18:28', 'ZXZ', 'vcbc', 'Lorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industry', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 20:18:28', '2021-03-18 20:18:28', '', 0, '', 0, 'genarel_quiry', '', 0),
(108, 6, '2021-03-18 20:19:25', '2021-03-18 20:19:25', 'It is a', 'big', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 20:19:25', '2021-03-18 20:19:25', '', 0, '', 0, 'genarel_quiry', '', 0),
(111, 2, '2021-03-20 13:18:59', '2021-03-20 19:18:59', '75,109,110', 'invoice', '', 'publish', 'open', 'open', '', 'inv-8', '', '', '2021-03-20 13:18:59', '2021-03-20 15:18:59', 'Arif Company', 0, '', 0, 'invoice', '', 0),
(112, 2, '2021-03-20 13:18:59', '2021-03-20 19:18:59', '', '75', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-20 13:18:59', '2021-03-20 15:18:59', 'Arif Company', 111, '', 0, 'invoice_order', '', 0),
(113, 2, '2021-03-20 13:18:59', '2021-03-20 19:18:59', '', '109', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-20 13:18:59', '2021-03-20 15:18:59', 'Arif Company', 111, '', 0, 'invoice_order', '', 0),
(114, 2, '2021-03-20 13:18:59', '2021-03-20 19:18:59', '', '110', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-20 13:18:59', '2021-03-20 15:18:59', 'Arif Company', 111, '', 0, 'invoice_order', '', 0),
(115, 2, '2021-03-20 13:35:00', '2021-03-20 19:35:00', '<p>lorem</p>', 'silk saree', '<p>lorem</p>', 'unpublish', 'open', 'open', '', 'silk saree', '', '', '2021-03-20 15:36:34', '2021-03-20 15:36:34', '', 0, '', 0, 'product', '', 0),
(116, 2, '2021-03-20 15:36:34', '2021-03-20 15:36:34', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-03-20 15:36:34', '2021-03-20 15:36:34', '', 115, '', 0, 'product_varient', '', 0),
(134, 2, '2021-03-21 11:58:09', '2021-03-21 17:58:09', '120,127', 'invoice', '', 'publish', 'open', 'open', '', 'inv-12', '', '', '2021-03-21 11:58:09', '2021-03-21 13:58:09', 'mrpeon', 0, '', 0, 'invoice', '', 0),
(135, 2, '2021-03-21 11:58:09', '2021-03-21 17:58:09', '', '120', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-21 11:58:09', '2021-03-21 13:58:09', 'mrpeon', 134, '', 0, 'invoice_order', '', 0),
(136, 2, '2021-03-21 11:58:09', '2021-03-21 17:58:09', '', '127', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-21 11:58:09', '2021-03-21 13:58:09', 'mrpeon', 134, '', 0, 'invoice_order', '', 0),
(139, 2, '2021-03-21 14:49:03', '2021-03-21 20:49:03', '138', 'invoice', '', 'publish', 'open', 'open', '', 'inv-13', '', '', '2021-03-21 14:49:03', '2021-03-21 16:49:03', 'Mrpeon', 0, '', 0, 'invoice', '', 0),
(140, 2, '2021-03-21 14:49:03', '2021-03-21 20:49:03', '', '138', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-21 14:49:03', '2021-03-21 16:49:03', 'Mrpeon', 139, '', 0, 'invoice_order', '', 0),
(166, 2, '2021-04-04 13:29:22', '2021-04-04 19:29:22', '', '163', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 13:29:22', '2021-04-04 15:29:22', 'Test Company', 165, '', 0, 'invoice_order', '', 0),
(167, 2, '2021-04-04 13:29:22', '2021-04-04 19:29:22', '', '164', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 13:29:22', '2021-04-04 15:29:22', 'Test Company', 165, '', 0, 'invoice_order', '', 0),
(144, 2, '2021-03-22 12:15:22', '2021-03-22 18:15:22', '143', 'invoice', '', 'publish', 'open', 'open', '', 'inv-14', '', '', '2021-03-22 12:15:22', '2021-03-22 14:15:22', 'test', 0, '', 0, 'invoice', '', 0),
(145, 2, '2021-03-22 12:15:22', '2021-03-22 18:15:22', '', '143', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-22 12:15:22', '2021-03-22 14:15:22', 'test', 144, '', 0, 'invoice_order', '', 0),
(161, 2, '2021-04-04 13:24:52', '2021-04-04 19:24:52', '', '158', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 13:24:52', '2021-04-04 15:24:52', 'Test Company', 160, '', 0, 'invoice_order', '', 0),
(162, 2, '2021-04-04 13:24:52', '2021-04-04 19:24:52', '', '159', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 13:24:52', '2021-04-04 15:24:52', 'Test Company', 160, '', 0, 'invoice_order', '', 0),
(163, 5, '2021-04-04 00:00:00', '2021-04-04 19:28:01', '', 'Order2021-04-04 13:28:01', '', 'delivered', 'open', 'open', 'order_1247', 'order-2', '', '', '2021-04-04 13:29:43', '2021-04-04 15:28:01', 'Test Company', 0, '', 0, 'shop_order', '', 0),
(164, 5, '2021-04-04 00:00:00', '2021-04-04 19:28:19', '', 'Order2021-04-04 13:28:19', '', 'delivered', 'open', 'open', 'order_1247', 'order-3', '', '', '2021-04-04 13:29:46', '2021-04-04 15:28:19', 'Test Company', 0, '', 0, 'shop_order', '', 0),
(165, 2, '2021-04-04 13:29:22', '2021-04-04 19:29:22', '163,164', 'invoice', '', 'publish', 'open', 'open', '', 'inv-17', '', '', '2021-04-04 13:29:22', '2021-04-04 15:29:22', 'Test Company', 0, '', 0, 'invoice', '', 0),
(151, 2, '2021-03-23 12:23:45', '2021-03-23 18:23:45', '128,147,148,149', 'invoice', '', 'publish', 'open', 'open', '', 'inv-15', '', '', '2021-03-23 12:23:45', '2021-03-23 14:23:45', 'Testing Company', 0, '', 0, 'invoice', '', 0),
(152, 2, '2021-03-23 12:23:45', '2021-03-23 18:23:45', '', '128', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-23 12:23:45', '2021-03-23 14:23:45', 'Testing Company', 151, '', 0, 'invoice_order', '', 0),
(153, 2, '2021-03-23 12:23:45', '2021-03-23 18:23:45', '', '147', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-23 12:23:45', '2021-03-23 14:23:45', 'Testing Company', 151, '', 0, 'invoice_order', '', 0),
(154, 2, '2021-03-23 12:23:45', '2021-03-23 18:23:45', '', '148', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-23 12:23:45', '2021-03-23 14:23:45', 'Testing Company', 151, '', 0, 'invoice_order', '', 0),
(155, 2, '2021-03-23 12:23:45', '2021-03-23 18:23:45', '', '149', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-23 12:23:45', '2021-03-23 14:23:45', 'Testing Company', 151, '', 0, 'invoice_order', '', 0),
(160, 2, '2021-04-04 13:24:52', '2021-04-04 19:24:52', '158,159', 'invoice', '', 'publish', 'open', 'open', '', 'inv-16', '', '', '2021-04-04 13:24:52', '2021-04-04 15:24:52', 'Test Company', 0, '', 0, 'invoice', '', 0),
(158, 0, '2021-04-04 00:00:00', '2021-04-04 19:22:35', '', 'Order2021-04-04 13:22:35', '', 'delivered', 'open', 'open', 'order_1247', 'order-1', '', '', '2021-04-04 13:25:44', '2021-04-04 15:22:35', 'Test Company', 0, '', 0, 'shop_order', '', 0),
(159, 5, '2021-04-04 00:00:00', '2021-04-04 19:23:21', '', 'Order2021-04-04 13:23:21', '', 'delivered', 'open', 'open', 'order_1247', 'order-1', '', '', '2021-04-04 13:25:47', '2021-04-04 15:23:21', 'Test Company', 0, '', 0, 'shop_order', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_attibutes`
--

CREATE TABLE `product_attibutes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `product_parent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taxonomy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `term` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `term_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product_attibutes`
--

INSERT INTO `product_attibutes` (`id`, `post_id`, `product_parent`, `taxonomy`, `term`, `term_id`, `parent_id`, `status`) VALUES
(1, 1, '2', 'color', 'Red', 9, 0, 1),
(2, 1, '3', 'color', 'Black', 10, 0, 1),
(3, 1, '4', 'color', 'Blue', 11, 0, 1),
(4, 6, '7', 'size', 'XL', 13, 0, 1),
(5, 6, '8', 'size', 'X', 14, 0, 1),
(6, 6, '9', 'size', 'S', 15, 0, 1),
(7, 6, '10', 'size', 'M', 16, 0, 1),
(8, 26, '27', 'color', 'Red', 9, 0, 1),
(9, 26, '27', 'size', 'XL', 13, 8, 1),
(10, 26, '28', 'color', 'Black', 10, 0, 1),
(11, 26, '28', 'size', 'X', 14, 10, 1),
(12, 26, '29', 'color', 'Blue', 11, 0, 1),
(13, 26, '29', 'size', 'S', 15, 12, 1),
(14, 40, '41', 'color', 'Red', 9, 0, 1),
(15, 40, '42', 'color', 'Black', 10, 0, 1),
(16, 40, '43', 'color', 'Green', 12, 0, 1),
(17, 44, '45', 'size', 'XL', 13, 0, 1),
(18, 44, '46', 'size', 'X', 14, 0, 1),
(19, 44, '47', 'size', 'S', 15, 0, 1),
(20, 44, '48', 'size', 'M', 16, 0, 1),
(21, 49, '50', 'color', 'Red', 9, 0, 1),
(22, 49, '50', 'size', 'XL', 13, 21, 1),
(23, 49, '51', 'color', 'Black', 10, 0, 1),
(24, 49, '51', 'size', 'X', 14, 23, 1),
(25, 115, '116', 'color', 'Red', 9, 0, 1),
(26, 115, '116', 'size', 'XL', 13, 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '2020-10-28 10:48:52', '2020-11-15 04:01:36'),
(3, 'Editor', '', '2020-10-29 04:21:40', '2020-12-22 05:44:53'),
(10, 'sohel', 'sohel', '2021-01-09 04:32:04', '2021-01-09 04:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 13),
(1, 14),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(10, 1),
(10, 5),
(10, 7);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` bigint(20) NOT NULL,
  `session_key` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_expiry` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_zones`
--

CREATE TABLE `shipping_zones` (
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `zone_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zone_order` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_zone_locations`
--

CREATE TABLE `shipping_zone_locations` (
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `location_code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_zone_methods`
--

CREATE TABLE `shipping_zone_methods` (
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `instance_id` bigint(20) UNSIGNED NOT NULL,
  `method_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method_order` bigint(20) UNSIGNED NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE `tax_rates` (
  `tax_rate_id` bigint(20) NOT NULL,
  `tax_rate_country` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate_state` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tax_rate_priority` bigint(20) NOT NULL,
  `tax_rate_compound` int(1) NOT NULL DEFAULT 0,
  `tax_rate_shipping` int(1) NOT NULL DEFAULT 1,
  `tax_rate_order` bigint(20) NOT NULL,
  `tax_rate_class` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax_rate_locations`
--

CREATE TABLE `tax_rate_locations` (
  `location_id` bigint(20) NOT NULL,
  `location_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_rate_id` bigint(20) NOT NULL,
  `location_type` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_attribute_stock`
--

CREATE TABLE `temp_attribute_stock` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `termmeta`
--

CREATE TABLE `termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`term_id`, `name`, `slug`, `term_group`, `status`, `createdDate`) VALUES
(1, 'Women', 'women', 0, 1, '2020-12-27 20:05:13'),
(2, 'Men', 'men', 0, 1, '2020-12-27 20:05:20'),
(3, 'Women', 'women', 0, 1, '2020-12-27 20:05:57'),
(4, 'Tops', 'tops', 3, 1, '2020-12-27 20:06:12'),
(5, 'Dresses', 'dresses', 4, 1, '2020-12-27 20:06:24'),
(6, 'Tunic & shirts', 'tunic-shirts', 4, 1, '2020-12-27 20:06:38'),
(7, 'T-Shirts', 't-shirts', 4, 1, '2020-12-27 20:06:53'),
(8, 'Tank Tops', 'tank-tops', 4, 1, '2020-12-27 20:07:05'),
(9, 'Red', 'red', 0, 1, '2020-12-27 18:20:48'),
(10, 'Black', 'black', 0, 1, '2020-12-27 18:20:54'),
(11, 'Blue', 'blue', 0, 1, '2020-12-27 18:21:00'),
(12, 'Green', 'green', 0, 1, '2020-12-27 18:21:05'),
(13, 'XL', 'xl', 0, 1, '2020-12-27 18:21:18'),
(14, 'X', 'x', 0, 1, '2020-12-27 18:21:28'),
(15, 'S', 's', 0, 1, '2020-12-27 18:21:32'),
(16, 'M', 'm', 0, 1, '2020-12-27 18:21:36'),
(17, 'Dhaka', 'dhaka', 0, 1, '2020-12-27 20:25:53'),
(18, 'Badda', 'badda', 0, 1, '2020-12-27 20:26:04'),
(19, 'Comilla', 'comilla', 0, 1, '2020-12-27 20:26:16'),
(20, 'Laksham', 'laksham', 0, 1, '2020-12-27 20:26:29'),
(21, 'Bottoms', 'bottoms', 3, 1, '2020-12-27 20:30:01'),
(22, 'Skirts', 'skirts', 21, 1, '2020-12-27 20:30:15'),
(23, 'Jeans', 'jeans', 21, 1, '2020-12-27 20:30:34'),
(24, 'Legging & pyjamas', 'legging-pyjamas', 21, 1, '2020-12-27 20:30:49'),
(25, 'Bras & Sleepwear', 'bras-sleepwear', 3, 1, '2020-12-28 12:07:54'),
(26, 'Bras', 'bras', 25, 1, '2020-12-28 12:08:16'),
(27, 'Panties', 'panties', 25, 1, '2020-12-28 12:08:30'),
(28, 'Bra & Panties Sets', 'bra-panties-sets', 25, 1, '2020-12-28 12:08:57'),
(29, 'Sleepwear', 'sleepwear', 25, 1, '2020-12-28 12:09:19'),
(30, 'Bags', 'bags', 3, 1, '2020-12-31 12:17:31'),
(31, 'Tote Bags', 'tote-bags', 30, 1, '2020-12-31 12:17:46'),
(32, 'Crossbody Bags', 'crossbody-bags', 30, 1, '2020-12-31 12:18:03'),
(33, 'Purses', 'purses', 30, 1, '2020-12-31 12:18:18'),
(34, 'Jewellery', 'jewellery', 3, 1, '2020-12-31 12:18:30'),
(35, 'Earrings', 'earrings', 34, 1, '2020-12-31 12:18:47'),
(36, 'Necklaces', 'necklaces', 34, 1, '2020-12-31 12:19:01'),
(37, 'Bracelets', 'bracelets', 34, 1, '2020-12-31 12:19:15'),
(38, 'Accessories', 'accessories', 3, 1, '2020-12-31 12:19:28'),
(39, 'Sunglasses', 'sunglasses', 38, 1, '2020-12-31 12:19:45'),
(40, 'Scarves', 'scarves', 38, 1, '2020-12-31 12:20:04'),
(41, 'Belts', 'belts', 38, 1, '2020-12-31 12:20:22'),
(42, 'fruit', 'fruit', 0, 0, '2021-02-11 16:30:17'),
(43, 'Jacket', 'jacket', 42, 0, '2021-02-11 16:30:27'),
(44, 'chandpur', 'chandpur', 0, 1, '2021-03-18 20:20:46'),
(45, 'matlab', 'matlab', 0, 1, '2021-03-18 20:21:11'),
(46, 'sdfsdfdsf', 'sdfsdfdsf', 43, 1, '2021-04-05 03:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `term_relationships`
--

CREATE TABLE `term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_relationships`
--

INSERT INTO `term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 31, 0),
(5, 36, 0),
(6, 23, 0),
(26, 6, 0),
(39, 41, 0),
(40, 33, 0),
(44, 22, 0),
(49, 5, 0),
(115, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `term_taxonomy`
--

CREATE TABLE `term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `term_taxonomy`
--

INSERT INTO `term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`, `createdDate`) VALUES
(1, 1, 'product_tag', '', 0, 0, '2020-12-27 20:05:13'),
(2, 2, 'product_tag', '', 0, 0, '2020-12-27 20:05:20'),
(3, 3, 'product_cat', '', 0, 0, '2020-12-27 20:05:57'),
(4, 4, 'product_cat', '', 0, 0, '2020-12-27 20:06:12'),
(5, 5, 'product_cat', '', 0, 0, '2020-12-27 20:06:24'),
(6, 6, 'product_cat', '', 0, 0, '2020-12-27 20:06:38'),
(7, 7, 'product_cat', '', 0, 0, '2020-12-27 20:06:53'),
(8, 8, 'product_cat', '', 0, 0, '2020-12-27 20:07:05'),
(9, 9, 'color', '', 0, 0, '2020-12-27 18:20:48'),
(10, 10, 'color', '', 0, 0, '2020-12-27 18:20:54'),
(11, 11, 'color', '', 0, 0, '2020-12-27 18:21:00'),
(12, 12, 'color', '', 0, 0, '2020-12-27 18:21:05'),
(13, 13, 'size', '', 0, 0, '2020-12-27 18:21:18'),
(14, 14, 'size', '', 0, 0, '2020-12-27 18:21:28'),
(15, 15, 'size', '', 0, 0, '2020-12-27 18:21:32'),
(16, 16, 'size', '', 0, 0, '2020-12-27 18:21:36'),
(17, 17, 'district', '100', 0, 0, '2020-12-27 20:25:53'),
(18, 18, 'city', NULL, 17, 0, '2020-12-27 20:26:04'),
(19, 18, 'postcode', '1200', 18, 0, '2020-12-27 20:26:04'),
(20, 19, 'district', '200', 0, 0, '2020-12-27 20:26:16'),
(21, 20, 'city', NULL, 19, 0, '2020-12-27 20:26:29'),
(22, 20, 'postcode', '1300', 20, 0, '2020-12-27 20:26:29'),
(23, 21, 'product_cat', '', 0, 0, '2020-12-27 20:30:01'),
(24, 22, 'product_cat', '', 0, 0, '2020-12-27 20:30:15'),
(25, 23, 'product_cat', '', 0, 0, '2020-12-27 20:30:34'),
(26, 24, 'product_cat', '', 0, 0, '2020-12-27 20:30:49'),
(27, 25, 'product_cat', '', 0, 0, '2020-12-28 12:07:54'),
(28, 26, 'product_cat', '', 0, 0, '2020-12-28 12:08:16'),
(29, 27, 'product_cat', '', 0, 0, '2020-12-28 12:08:30'),
(30, 28, 'product_cat', '', 0, 0, '2020-12-28 12:08:57'),
(31, 29, 'product_cat', '', 0, 0, '2020-12-28 12:09:19'),
(32, 30, 'product_cat', '', 0, 0, '2020-12-31 12:17:31'),
(33, 31, 'product_cat', '', 0, 0, '2020-12-31 12:17:46'),
(34, 32, 'product_cat', '', 0, 0, '2020-12-31 12:18:03'),
(35, 33, 'product_cat', '', 0, 0, '2020-12-31 12:18:18'),
(36, 34, 'product_cat', '', 0, 0, '2020-12-31 12:18:30'),
(37, 35, 'product_cat', '', 0, 0, '2020-12-31 12:18:47'),
(38, 36, 'product_cat', '', 0, 0, '2020-12-31 12:19:01'),
(39, 37, 'product_cat', '', 0, 0, '2020-12-31 12:19:15'),
(40, 38, 'product_cat', '', 0, 0, '2020-12-31 12:19:28'),
(41, 39, 'product_cat', '', 0, 0, '2020-12-31 12:19:45'),
(42, 40, 'product_cat', '', 0, 0, '2020-12-31 12:20:04'),
(43, 41, 'product_cat', '', 0, 0, '2020-12-31 12:20:22'),
(44, 42, 'product_cat', '', 0, 0, '2021-02-11 16:30:17'),
(45, 43, 'product_cat', '', 0, 0, '2021-02-11 16:30:27'),
(46, 44, 'district', '175', 0, 0, '2021-03-18 20:20:46'),
(47, 45, 'city', NULL, 44, 0, '2021-03-18 20:21:11'),
(48, 45, 'postcode', '2300', 45, 0, '2021-03-18 20:21:11'),
(49, 46, 'product_cat', '', 0, 0, '2021-04-05 03:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `usermeta`
--

CREATE TABLE `usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usermeta`
--

INSERT INTO `usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(399, 0, 'address_one', 'Uttara,Dhaka'),
(400, 0, 'district', '19'),
(401, 0, 'city', '20'),
(402, 0, 'zip', '1300'),
(5, 1, 'first_name', 'sohel'),
(6, 1, 'last_name', 'Ahmed'),
(7, 1, 'address_two', 'chandpur'),
(8, 1, 'phone', '01981368525'),
(9, 1, 'user_image', NULL),
(315, 1, 'address_one', 'chandpur'),
(316, 1, 'district', '17'),
(317, 1, 'city', '18'),
(318, 1, 'zip', '1200'),
(134, 2, 'first_name', 'Elias'),
(135, 2, 'last_name', 'Howlader'),
(136, 2, 'address_two', 'Uttara,Dhaka'),
(137, 2, 'phone', '0123456789'),
(138, 2, 'user_image', NULL),
(340, 2, 'address_one', 'Uttara,Dhaka'),
(341, 2, 'district', '17'),
(342, 2, 'city', '18'),
(343, 2, 'zip', '1200'),
(179, 3, 'first_name', 'Demo'),
(180, 3, 'last_name', 'User'),
(181, 3, 'address_two', 'Mirpur,Dhaka'),
(182, 3, 'phone', '435435'),
(183, 3, 'user_image', NULL),
(319, 3, 'address_one', 'Mirpur,Dhaka'),
(320, 3, 'district', '44'),
(321, 3, 'city', '45'),
(322, 3, 'zip', '2300'),
(212, 4, 'first_name', 'Aminul'),
(213, 4, 'last_name', 'Islam'),
(214, 4, 'address_two', 'Uttara,Dhaka'),
(215, 4, 'phone', '0'),
(216, 4, 'user_image', 'user.png'),
(258, 4, 'address_one', 'Uttara,Dhaka'),
(259, 4, 'district', '17'),
(260, 4, 'city', '18'),
(261, 4, 'zip', '1200'),
(229, 5, 'first_name', 'Partho'),
(230, 5, 'last_name', 'Kar'),
(231, 5, 'address_two', 'Habiganj,Sylhet'),
(232, 5, 'phone', '01435345'),
(233, 5, 'user_image', NULL),
(411, 5, 'address_one', 'Habiganj,Sylhet'),
(412, 5, 'district', '17'),
(413, 5, 'city', '18'),
(414, 5, 'zip', '1200'),
(270, 6, 'first_name', 'rana'),
(271, 6, 'last_name', 'khan'),
(272, 6, 'address_two', 'Uttara,Dhaka'),
(273, 6, 'phone', '0'),
(274, 6, 'user_image', 'user.png'),
(283, 6, 'address_one', 'Uttara,Dhaka'),
(284, 6, 'district', '44'),
(285, 6, 'city', '45'),
(286, 6, 'zip', '2300'),
(323, 7, 'first_name', 'Innovative'),
(324, 7, 'last_name', 'Admin'),
(325, 7, 'address_two', 'Uttara,Dhaka'),
(326, 7, 'phone', '01777996579'),
(327, 7, 'user_image', NULL),
(360, 7, 'address_one', 'Uttara,Dhaka'),
(361, 7, 'district', '17'),
(362, 7, 'city', '18'),
(363, 7, 'zip', '1200'),
(364, 8, 'first_name', 'Test'),
(365, 8, 'last_name', 'User'),
(366, 8, 'address_two', 'Uttara,Dhaka'),
(367, 8, 'phone', '05675757'),
(368, 8, 'user_image', NULL),
(381, 8, 'address_one', 'Uttara,Dhaka'),
(382, 8, 'district', '19'),
(383, 8, 'city', '20'),
(384, 8, 'zip', '1300'),
(385, 9, 'first_name', 'Demo'),
(386, 9, 'last_name', 'Two'),
(387, 9, 'address_two', 'Uttara,Dhaka'),
(388, 9, 'phone', '367655676'),
(389, 9, 'user_image', NULL),
(394, 10, 'first_name', 'Isabell Feeney'),
(395, 10, 'last_name', 'Kerluke'),
(396, 10, 'address_two', 'Uttara,Dhaka'),
(397, 10, 'phone', '0'),
(398, 10, 'user_image', 'user.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `provider`, `provider_id`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'sohel', 'Ahmed', 'sohelahmeditebd@gmail.com', NULL, '$2y$10$F7mSSinpRHLn9xob.hWF2ejCnX39x52I06YcXHYum8mfoAjFTakEu', NULL, NULL, NULL, 1, '2021-01-12 04:49:07', '2021-01-12 04:49:07'),
(2, 'Elias', 'Howlader', 'elihowlader@hotmail.com', NULL, '$2y$10$CewDkNm8E0/Xa05e32b4C.E8fXa/o8nSkfeogdxveuIoluLpi1eCa', NULL, NULL, NULL, 1, '2021-01-12 23:32:44', '2021-01-12 23:32:44'),
(3, 'Demo', 'User', 'demo@email.com', NULL, '$2y$10$ypDnBnkNIe3oiiT2jrcfA.PoDHRpcSIU//CgvGofqC8bW99R3CyaS', NULL, NULL, NULL, 1, '2021-01-18 07:09:58', '2021-01-18 07:09:58'),
(4, 'Aminul', 'Islam', 'a.soton7@gmail.com', NULL, '$2y$10$AEgA3BzOt6f0omNWMBOLy.YaViLGTVAR4VFVzquoLMgswSkr0WeAi', NULL, NULL, NULL, 1, '2021-03-10 02:50:49', '2021-03-10 02:50:49'),
(5, 'Partho', 'Kar', 'parthokar90@gmail.com', NULL, '$2y$10$M5IpbaP6p2MuhdHgx9936.LK1NE5AoTCnR0TAf64r/5M4LRtj/T0G', NULL, NULL, NULL, 1, '2021-03-18 07:21:12', '2021-03-18 07:21:12'),
(6, 'rana', 'khan', 'sohelahmedite@gmail.com', NULL, '$2y$10$beteEl6iSBSgc666AdHuz.3jZUrsYDIcZMU8Yb9BWo7UjSsTmHTU2', NULL, NULL, NULL, 1, '2021-03-18 09:59:51', '2021-03-18 09:59:51'),
(7, 'Innovative', 'Admin', 'ariful@itebd.com', NULL, '$2y$10$Jyx9Z531bOoqCD041rY82OvliO7lO9/RaZNjiWMGJJH2dEwD4i9na', NULL, NULL, NULL, 1, '2021-03-21 02:45:08', '2021-03-21 02:45:08'),
(8, 'Test', 'User', 'test@email.com', NULL, '$2y$10$uMZLvSbgY6yWruhjCSKjgOp0xTdLWGk8ehpZo8WOnQiun/28HuTYy', NULL, NULL, NULL, 1, '2021-03-23 01:44:02', '2021-03-23 01:44:02'),
(9, 'Demo', 'Two', 'demo2@email.com', NULL, '$2y$10$xczivM64JD56c9aZJbrq3uZSqKgfwWy/a2KJZZglkhiPyTCgAN6y6', NULL, NULL, NULL, 1, '2021-04-01 10:00:59', '2021-04-01 10:00:59'),
(10, 'Isabell Feeney', 'Kerluke', 'Lincoln_Legros@yahoo.com', NULL, '$2y$10$jm8UAa51XbObPaYMdz35JOMxgNeS4TThuxJhGvABOuCNB/1xLsU/S', NULL, NULL, NULL, 1, '2021-04-03 22:10:13', '2021-04-03 22:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`user_id`, `permission_id`) VALUES
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 13),
(2, 14),
(3, 1),
(3, 2),
(5, 1),
(5, 5),
(5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actual_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`cart_id`, `user_id`, `id`, `name`, `price`, `actual_price`, `quantity`) VALUES
(294, '6', '45', 'Skirt', '1000', '1000', '1'),
(330, '2', '50', 'Dresses', '1000', '1000', '1'),
(338, '7', '27', 'Tunic', '1000', '1000', '1'),
(349, '9', '28', 'Tunic', '1000', '1000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(7, 7, 39, NULL, NULL),
(8, 2, 6, NULL, NULL),
(12, 9, 26, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`key_id`),
  ADD KEY `consumer_key` (`consumer_key`),
  ADD KEY `consumer_secret` (`consumer_secret`);

--
-- Indexes for table `attribute_taxonomies`
--
ALTER TABLE `attribute_taxonomies`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `attribute_name` (`attribute_name`(191));

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ecommerce_termmeta`
--
ALTER TABLE `ecommerce_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `meta_key` (`meta_key`(250)),
  ADD KEY `woocommerce_term_id` (`ecommerce_term_id`) USING BTREE;

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`),
  ADD KEY `autoload` (`autoload`);

--
-- Indexes for table `order_itemmeta`
--
ALTER TABLE `order_itemmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `order_item_id` (`order_item_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_tokenmeta`
--
ALTER TABLE `payment_tokenmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `payment_token_id` (`payment_token_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `payment_tokens`
--
ALTER TABLE `payment_tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postmeta`
--
ALTER TABLE `postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `product_attibutes`
--
ALTER TABLE `product_attibutes`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `post_id` (`post_id`) USING BTREE,
  ADD KEY `meta_key` (`taxonomy`(191)) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD UNIQUE KEY `session_key` (`session_key`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- Indexes for table `shipping_zones`
--
ALTER TABLE `shipping_zones`
  ADD PRIMARY KEY (`zone_id`);

--
-- Indexes for table `shipping_zone_locations`
--
ALTER TABLE `shipping_zone_locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `location_type` (`location_type`),
  ADD KEY `location_type_code` (`location_type`,`location_code`(90));

--
-- Indexes for table `shipping_zone_methods`
--
ALTER TABLE `shipping_zone_methods`
  ADD PRIMARY KEY (`instance_id`);

--
-- Indexes for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD PRIMARY KEY (`tax_rate_id`),
  ADD KEY `tax_rate_country` (`tax_rate_country`),
  ADD KEY `tax_rate_state` (`tax_rate_state`(191)),
  ADD KEY `tax_rate_class` (`tax_rate_class`(191)),
  ADD KEY `tax_rate_priority` (`tax_rate_priority`);

--
-- Indexes for table `tax_rate_locations`
--
ALTER TABLE `tax_rate_locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `tax_rate_id` (`tax_rate_id`),
  ADD KEY `location_type` (`location_type`),
  ADD KEY `location_type_code` (`location_type`,`location_code`(90));

--
-- Indexes for table `temp_attribute_stock`
--
ALTER TABLE `temp_attribute_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `termmeta`
--
ALTER TABLE `termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `term_relationships`
--
ALTER TABLE `term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `term_taxonomy`
--
ALTER TABLE `term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `usermeta`
--
ALTER TABLE `usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `key_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribute_taxonomies`
--
ALTER TABLE `attribute_taxonomies`
  MODIFY `attribute_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ecommerce_termmeta`
--
ALTER TABLE `ecommerce_termmeta`
  MODIFY `meta_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_itemmeta`
--
ALTER TABLE `order_itemmeta`
  MODIFY `meta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_tokenmeta`
--
ALTER TABLE `payment_tokenmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_tokens`
--
ALTER TABLE `payment_tokens`
  MODIFY `token_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `postmeta`
--
ALTER TABLE `postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1708;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `product_attibutes`
--
ALTER TABLE `product_attibutes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_zones`
--
ALTER TABLE `shipping_zones`
  MODIFY `zone_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_zone_locations`
--
ALTER TABLE `shipping_zone_locations`
  MODIFY `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_zone_methods`
--
ALTER TABLE `shipping_zone_methods`
  MODIFY `instance_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `tax_rate_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tax_rate_locations`
--
ALTER TABLE `tax_rate_locations`
  MODIFY `location_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_attribute_stock`
--
ALTER TABLE `temp_attribute_stock`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `termmeta`
--
ALTER TABLE `termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `term_taxonomy`
--
ALTER TABLE `term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `usermeta`
--
ALTER TABLE `usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=415;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `cart_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
