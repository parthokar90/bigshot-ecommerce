-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2021 at 06:16 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bigshot`
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
(2, 'Size', 'size', 'select', 'menu_order', 1, 1, '2020-12-27 18:20:32', '2020-12-27 18:20:32');

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
(1, 1, '_tax_class', '', '117', '2021-03-20', '1', '45', '44'),
(2, 1, '_qty', '0', '117', '2021-03-20', '1', '45', '44'),
(3, 1, '_product_id', '45', '117', '2021-03-20', '1', '45', '44'),
(4, 1, '_variation_id', '', '117', '2021-03-20', '1', '45', '44'),
(5, 1, 'order_actual_cost', '900', '117', '2021-03-20', '1', '45', '44'),
(6, 1, 'order_product_cost', '0', '117', '2021-03-20', '1', '45', '44'),
(7, 1, '_line_subtotal', '0', '117', '2021-03-20', '1', '45', '44'),
(8, 1, '_line_total', '0', '117', '2021-03-20', '1', '45', '44'),
(9, 1, '_line_subtotal_tax', '', '117', '2021-03-20', '1', '45', '44'),
(10, 1, '_line_tax', '', '117', '2021-03-20', '1', '45', '44'),
(11, 1, '_line_tax_data', '2021-03-20 23:10:28', '117', '2021-03-20', '1', '45', '44'),
(12, 1, 'delivery_charge', '100', '117', '2021-03-20', '1', '45', '44'),
(13, 1, 'coupon_code', '85', '117', '2021-03-20', '1', '45', '44'),
(14, 1, 'coupon_taka', '0', '117', '2021-03-20', '1', '45', '44'),
(15, 1, 'attribute_parent', '45', '117', '2021-03-20', '1', '45', '44'),
(16, 1, 'user_district', 'Dhaka', '117', '2021-03-20', '1', '45', '44'),
(17, 1, 'user_city', 'Badda', '117', '2021-03-20', '1', '45', '44'),
(18, 1, 'user_zip', '1200', '117', '2021-03-20', '1', '45', '44'),
(19, 2, '_tax_class', '', '117', '2021-03-20', '1', '50', '49'),
(20, 2, '_qty', '0', '117', '2021-03-20', '1', '50', '49'),
(21, 2, '_product_id', '50', '117', '2021-03-20', '1', '50', '49'),
(22, 2, '_variation_id', '', '117', '2021-03-20', '1', '50', '49'),
(23, 2, 'order_actual_cost', '600', '117', '2021-03-20', '1', '50', '49'),
(24, 2, 'order_product_cost', '2400', '117', '2021-03-20', '1', '50', '49'),
(25, 2, '_line_subtotal', '0', '117', '2021-03-20', '1', '50', '49'),
(26, 2, '_line_total', '4000', '117', '2021-03-20', '1', '50', '49'),
(27, 2, '_line_subtotal_tax', '', '117', '2021-03-20', '1', '50', '49'),
(28, 2, '_line_tax', '', '117', '2021-03-20', '1', '50', '49'),
(29, 2, '_line_tax_data', '2021-03-20 23:10:28', '117', '2021-03-20', '1', '50', '49'),
(30, 2, 'delivery_charge', '100', '117', '2021-03-20', '1', '50', '49'),
(31, 2, 'coupon_code', '85', '117', '2021-03-20', '1', '50', '49'),
(32, 2, 'coupon_taka', '0', '117', '2021-03-20', '1', '50', '49'),
(33, 2, 'attribute_parent', '50', '117', '2021-03-20', '1', '50', '49'),
(34, 2, 'user_district', 'Dhaka', '117', '2021-03-20', '1', '50', '49'),
(35, 2, 'user_city', 'Badda', '117', '2021-03-20', '1', '50', '49'),
(36, 2, 'user_zip', '1200', '117', '2021-03-20', '1', '50', '49'),
(37, 3, '_tax_class', '', '117', '2021-03-20', '1', '5', '5'),
(38, 3, '_qty', '0', '117', '2021-03-20', '1', '5', '5'),
(39, 3, '_product_id', '5', '117', '2021-03-20', '1', '5', '5'),
(40, 3, '_variation_id', '', '117', '2021-03-20', '1', '5', '5'),
(41, 3, 'order_actual_cost', '700', '117', '2021-03-20', '1', '5', '5'),
(42, 3, 'order_product_cost', '0', '117', '2021-03-20', '1', '5', '5'),
(43, 3, '_line_subtotal', '0', '117', '2021-03-20', '1', '5', '5'),
(44, 3, '_line_total', '0', '117', '2021-03-20', '1', '5', '5'),
(45, 3, '_line_subtotal_tax', '', '117', '2021-03-20', '1', '5', '5'),
(46, 3, '_line_tax', '', '117', '2021-03-20', '1', '5', '5'),
(47, 3, '_line_tax_data', '2021-03-20 23:10:28', '117', '2021-03-20', '1', '5', '5'),
(48, 3, 'delivery_charge', '100', '117', '2021-03-20', '1', '5', '5'),
(49, 3, 'coupon_code', '85', '117', '2021-03-20', '1', '5', '5'),
(50, 3, 'coupon_taka', '0', '117', '2021-03-20', '1', '5', '5'),
(51, 3, 'attribute_parent', '5', '117', '2021-03-20', '1', '5', '5'),
(52, 3, 'user_district', 'Dhaka', '117', '2021-03-20', '1', '5', '5'),
(53, 3, 'user_city', 'Badda', '117', '2021-03-20', '1', '5', '5'),
(54, 3, 'user_zip', '1200', '117', '2021-03-20', '1', '5', '5'),
(55, 3, 'cancel_quantity', '1', '117', '2021-03-20', '1', NULL, NULL),
(56, 2, 'cancel_quantity', '1', '117', '2021-03-20', '1', NULL, NULL),
(57, 3, 'cancel_quantity_default', '0', '117', NULL, NULL, NULL, '5'),
(58, 3, 'cancel_default_product', '5', '117', NULL, NULL, NULL, NULL),
(59, 1, 'cancel_quantity_attribute', '0', '117', NULL, NULL, NULL, NULL),
(60, 1, 'cancel_attribute_product', '45', '117', NULL, NULL, NULL, NULL),
(61, 2, 'cancel_quantity_attribute', '4', '117', NULL, NULL, NULL, NULL),
(62, 2, 'cancel_attribute_product', '50', '117', NULL, NULL, NULL, NULL),
(63, 4, '_tax_class', '', '118', '2021-03-20', '1', '116', '115'),
(64, 4, '_qty', '0', '118', '2021-03-20', '1', '116', '115'),
(65, 4, '_product_id', '116', '118', '2021-03-20', '1', '116', '115'),
(66, 4, '_variation_id', '', '118', '2021-03-20', '1', '116', '115'),
(67, 4, 'order_actual_cost', '200', '118', '2021-03-20', '1', '116', '115'),
(68, 4, 'order_product_cost', '0', '118', '2021-03-20', '1', '116', '115'),
(69, 4, '_line_subtotal', '0', '118', '2021-03-20', '1', '116', '115'),
(70, 4, '_line_total', '0', '118', '2021-03-20', '1', '116', '115'),
(71, 4, '_line_subtotal_tax', '', '118', '2021-03-20', '1', '116', '115'),
(72, 4, '_line_tax', '', '118', '2021-03-20', '1', '116', '115'),
(73, 4, '_line_tax_data', '2021-03-20 23:23:35', '118', '2021-03-20', '1', '116', '115'),
(74, 4, 'delivery_charge', '0', '118', '2021-03-20', '1', '116', '115'),
(75, 4, 'coupon_code', 'ten', '118', '2021-03-20', '1', '116', '115'),
(76, 4, 'coupon_taka', '0', '118', '2021-03-20', '1', '116', '115'),
(77, 4, 'attribute_parent', '116', '118', '2021-03-20', '1', '116', '115'),
(78, 4, 'user_district', 'Dhaka', '118', '2021-03-20', '1', '116', '115'),
(79, 4, 'user_city', 'Badda', '118', '2021-03-20', '1', '116', '115'),
(80, 4, 'user_zip', '1200', '118', '2021-03-20', '1', '116', '115'),
(81, 5, '_tax_class', '', '118', '2021-03-20', '1', '51', '49'),
(82, 5, '_qty', '0', '118', '2021-03-20', '1', '51', '49'),
(83, 5, '_product_id', '51', '118', '2021-03-20', '1', '51', '49'),
(84, 5, '_variation_id', '', '118', '2021-03-20', '1', '51', '49'),
(85, 5, 'order_actual_cost', '600', '118', '2021-03-20', '1', '51', '49'),
(86, 5, 'order_product_cost', '0', '118', '2021-03-20', '1', '51', '49'),
(87, 5, '_line_subtotal', '0', '118', '2021-03-20', '1', '51', '49'),
(88, 5, '_line_total', '0', '118', '2021-03-20', '1', '51', '49'),
(89, 5, '_line_subtotal_tax', '', '118', '2021-03-20', '1', '51', '49'),
(90, 5, '_line_tax', '', '118', '2021-03-20', '1', '51', '49'),
(91, 5, '_line_tax_data', '2021-03-20 23:23:35', '118', '2021-03-20', '1', '51', '49'),
(92, 5, 'delivery_charge', '0', '118', '2021-03-20', '1', '51', '49'),
(93, 5, 'coupon_code', 'ten', '118', '2021-03-20', '1', '51', '49'),
(94, 5, 'coupon_taka', '0', '118', '2021-03-20', '1', '51', '49'),
(95, 5, 'attribute_parent', '51', '118', '2021-03-20', '1', '51', '49'),
(96, 5, 'user_district', 'Dhaka', '118', '2021-03-20', '1', '51', '49'),
(97, 5, 'user_city', 'Badda', '118', '2021-03-20', '1', '51', '49'),
(98, 5, 'user_zip', '1200', '118', '2021-03-20', '1', '51', '49'),
(99, 6, '_tax_class', '', '118', '2021-03-20', '1', '45', '44'),
(100, 6, '_qty', '0', '118', '2021-03-20', '1', '45', '44'),
(101, 6, '_product_id', '45', '118', '2021-03-20', '1', '45', '44'),
(102, 6, '_variation_id', '', '118', '2021-03-20', '1', '45', '44'),
(103, 6, 'order_actual_cost', '900', '118', '2021-03-20', '1', '45', '44'),
(104, 6, 'order_product_cost', '4500', '118', '2021-03-20', '1', '45', '44'),
(105, 6, '_line_subtotal', '0', '118', '2021-03-20', '1', '45', '44'),
(106, 6, '_line_total', '5000', '118', '2021-03-20', '1', '45', '44'),
(107, 6, '_line_subtotal_tax', '', '118', '2021-03-20', '1', '45', '44'),
(108, 6, '_line_tax', '', '118', '2021-03-20', '1', '45', '44'),
(109, 6, '_line_tax_data', '2021-03-20 23:23:35', '118', '2021-03-20', '1', '45', '44'),
(110, 6, 'delivery_charge', '0', '118', '2021-03-20', '1', '45', '44'),
(111, 6, 'coupon_code', 'ten', '118', '2021-03-20', '1', '45', '44'),
(112, 6, 'coupon_taka', '0', '118', '2021-03-20', '1', '45', '44'),
(113, 6, 'attribute_parent', '45', '118', '2021-03-20', '1', '45', '44'),
(114, 6, 'user_district', 'Dhaka', '118', '2021-03-20', '1', '45', '44'),
(115, 6, 'user_city', 'Badda', '118', '2021-03-20', '1', '45', '44'),
(116, 6, 'user_zip', '1200', '118', '2021-03-20', '1', '45', '44'),
(117, 7, '_tax_class', '', '118', '2021-03-20', '1', '5', '5'),
(118, 7, '_qty', '0', '118', '2021-03-20', '1', '5', '5'),
(119, 7, '_product_id', '5', '118', '2021-03-20', '1', '5', '5'),
(120, 7, '_variation_id', '', '118', '2021-03-20', '1', '5', '5'),
(121, 7, 'order_actual_cost', '700', '118', '2021-03-20', '1', '5', '5'),
(122, 7, 'order_product_cost', '7000', '118', '2021-03-20', '1', '5', '5'),
(123, 7, '_line_subtotal', '0', '118', '2021-03-20', '1', '5', '5'),
(124, 7, '_line_total', '9000', '118', '2021-03-20', '1', '5', '5'),
(125, 7, '_line_subtotal_tax', '', '118', '2021-03-20', '1', '5', '5'),
(126, 7, '_line_tax', '', '118', '2021-03-20', '1', '5', '5'),
(127, 7, '_line_tax_data', '2021-03-20 23:23:35', '118', '2021-03-20', '1', '5', '5'),
(128, 7, 'delivery_charge', '0', '118', '2021-03-20', '1', '5', '5'),
(129, 7, 'coupon_code', 'ten', '118', '2021-03-20', '1', '5', '5'),
(130, 7, 'coupon_taka', '0', '118', '2021-03-20', '1', '5', '5'),
(131, 7, 'attribute_parent', '5', '118', '2021-03-20', '1', '5', '5'),
(132, 7, 'user_district', 'Dhaka', '118', '2021-03-20', '1', '5', '5'),
(133, 7, 'user_city', 'Badda', '118', '2021-03-20', '1', '5', '5'),
(134, 7, 'user_zip', '1200', '118', '2021-03-20', '1', '5', '5'),
(135, 8, '_tax_class', '', '119', '2021-03-20', '1', '5', '5'),
(136, 8, '_qty', '1', '119', '2021-03-20', '1', '5', '5'),
(137, 8, '_product_id', '5', '119', '2021-03-20', '1', '5', '5'),
(138, 8, '_variation_id', '', '119', '2021-03-20', '1', '5', '5'),
(139, 8, 'order_actual_cost', '700', '119', '2021-03-20', '1', '5', '5'),
(140, 8, 'order_product_cost', '700', '119', '2021-03-20', '1', '5', '5'),
(141, 8, '_line_subtotal', '900', '119', '2021-03-20', '1', '5', '5'),
(142, 8, '_line_total', '900', '119', '2021-03-20', '1', '5', '5'),
(143, 8, '_line_subtotal_tax', '', '119', '2021-03-20', '1', '5', '5'),
(144, 8, '_line_tax', '', '119', '2021-03-20', '1', '5', '5'),
(145, 8, '_line_tax_data', '2021-03-20 23:24:07', '119', '2021-03-20', '1', '5', '5'),
(146, 8, 'delivery_charge', '200', '119', '2021-03-20', '1', '5', '5'),
(147, 8, 'coupon_code', NULL, '119', '2021-03-20', '1', '5', '5'),
(148, 8, 'coupon_taka', '0', '119', '2021-03-20', '1', '5', '5'),
(149, 8, 'attribute_parent', '5', '119', '2021-03-20', '1', '5', '5'),
(150, 8, 'user_district', 'Comilla', '119', '2021-03-20', '1', '5', '5'),
(151, 8, 'user_city', 'Laksham', '119', '2021-03-20', '1', '5', '5'),
(152, 8, 'user_zip', '1300', '119', '2021-03-20', '1', '5', '5'),
(153, 9, '_tax_class', '', '119', '2021-03-20', '1', '41', '40'),
(154, 9, '_qty', '1', '119', '2021-03-20', '1', '41', '40'),
(155, 9, '_product_id', '41', '119', '2021-03-20', '1', '41', '40'),
(156, 9, '_variation_id', '', '119', '2021-03-20', '1', '41', '40'),
(157, 9, 'order_actual_cost', '700', '119', '2021-03-20', '1', '41', '40'),
(158, 9, 'order_product_cost', '700', '119', '2021-03-20', '1', '41', '40'),
(159, 9, '_line_subtotal', '1000', '119', '2021-03-20', '1', '41', '40'),
(160, 9, '_line_total', '1000', '119', '2021-03-20', '1', '41', '40'),
(161, 9, '_line_subtotal_tax', '', '119', '2021-03-20', '1', '41', '40'),
(162, 9, '_line_tax', '', '119', '2021-03-20', '1', '41', '40'),
(163, 9, '_line_tax_data', '2021-03-20 23:24:07', '119', '2021-03-20', '1', '41', '40'),
(164, 9, 'delivery_charge', '200', '119', '2021-03-20', '1', '41', '40'),
(165, 9, 'coupon_code', NULL, '119', '2021-03-20', '1', '41', '40'),
(166, 9, 'coupon_taka', '0', '119', '2021-03-20', '1', '41', '40'),
(167, 9, 'attribute_parent', '41', '119', '2021-03-20', '1', '41', '40'),
(168, 9, 'user_district', 'Comilla', '119', '2021-03-20', '1', '41', '40'),
(169, 9, 'user_city', 'Laksham', '119', '2021-03-20', '1', '41', '40'),
(170, 9, 'user_zip', '1300', '119', '2021-03-20', '1', '41', '40'),
(171, 10, '_tax_class', '', '119', '2021-03-20', '1', '39', '39'),
(172, 10, '_qty', '1', '119', '2021-03-20', '1', '39', '39'),
(173, 10, '_product_id', '39', '119', '2021-03-20', '1', '39', '39'),
(174, 10, '_variation_id', '', '119', '2021-03-20', '1', '39', '39'),
(175, 10, 'order_actual_cost', '800', '119', '2021-03-20', '1', '39', '39'),
(176, 10, 'order_product_cost', '800', '119', '2021-03-20', '1', '39', '39'),
(177, 10, '_line_subtotal', '1000', '119', '2021-03-20', '1', '39', '39'),
(178, 10, '_line_total', '1000', '119', '2021-03-20', '1', '39', '39'),
(179, 10, '_line_subtotal_tax', '', '119', '2021-03-20', '1', '39', '39'),
(180, 10, '_line_tax', '', '119', '2021-03-20', '1', '39', '39'),
(181, 10, '_line_tax_data', '2021-03-20 23:24:07', '119', '2021-03-20', '1', '39', '39'),
(182, 10, 'delivery_charge', '200', '119', '2021-03-20', '1', '39', '39'),
(183, 10, 'coupon_code', NULL, '119', '2021-03-20', '1', '39', '39'),
(184, 10, 'coupon_taka', '0', '119', '2021-03-20', '1', '39', '39'),
(185, 10, 'attribute_parent', '39', '119', '2021-03-20', '1', '39', '39'),
(186, 10, 'user_district', 'Comilla', '119', '2021-03-20', '1', '39', '39'),
(187, 10, 'user_city', 'Laksham', '119', '2021-03-20', '1', '39', '39'),
(188, 10, 'user_zip', '1300', '119', '2021-03-20', '1', '39', '39'),
(189, 11, '_tax_class', '', '120', '2021-03-20', '1', '39', '39'),
(190, 11, '_qty', '1', '120', '2021-03-20', '1', '39', '39'),
(191, 11, '_product_id', '39', '120', '2021-03-20', '1', '39', '39'),
(192, 11, '_variation_id', '', '120', '2021-03-20', '1', '39', '39'),
(193, 11, 'order_actual_cost', '800', '120', '2021-03-20', '1', '39', '39'),
(194, 11, 'order_product_cost', '800', '120', '2021-03-20', '1', '39', '39'),
(195, 11, '_line_subtotal', '1000', '120', '2021-03-20', '1', '39', '39'),
(196, 11, '_line_total', '1000', '120', '2021-03-20', '1', '39', '39'),
(197, 11, '_line_subtotal_tax', '', '120', '2021-03-20', '1', '39', '39'),
(198, 11, '_line_tax', '', '120', '2021-03-20', '1', '39', '39'),
(199, 11, '_line_tax_data', '2021-03-20 23:25:02', '120', '2021-03-20', '1', '39', '39'),
(200, 11, 'delivery_charge', '175', '120', '2021-03-20', '1', '39', '39'),
(201, 11, 'coupon_code', NULL, '120', '2021-03-20', '1', '39', '39'),
(202, 11, 'coupon_taka', '0', '120', '2021-03-20', '1', '39', '39'),
(203, 11, 'attribute_parent', '39', '120', '2021-03-20', '1', '39', '39'),
(204, 11, 'user_district', 'chandpur', '120', '2021-03-20', '1', '39', '39'),
(205, 11, 'user_city', 'matlab', '120', '2021-03-20', '1', '39', '39'),
(206, 11, 'user_zip', '2300', '120', '2021-03-20', '1', '39', '39'),
(207, 12, '_tax_class', '', '120', '2021-03-20', '1', '41', '40'),
(208, 12, '_qty', '1', '120', '2021-03-20', '1', '41', '40'),
(209, 12, '_product_id', '41', '120', '2021-03-20', '1', '41', '40'),
(210, 12, '_variation_id', '', '120', '2021-03-20', '1', '41', '40'),
(211, 12, 'order_actual_cost', '700', '120', '2021-03-20', '1', '41', '40'),
(212, 12, 'order_product_cost', '700', '120', '2021-03-20', '1', '41', '40'),
(213, 12, '_line_subtotal', '1000', '120', '2021-03-20', '1', '41', '40'),
(214, 12, '_line_total', '1000', '120', '2021-03-20', '1', '41', '40'),
(215, 12, '_line_subtotal_tax', '', '120', '2021-03-20', '1', '41', '40'),
(216, 12, '_line_tax', '', '120', '2021-03-20', '1', '41', '40'),
(217, 12, '_line_tax_data', '2021-03-20 23:25:02', '120', '2021-03-20', '1', '41', '40'),
(218, 12, 'delivery_charge', '175', '120', '2021-03-20', '1', '41', '40'),
(219, 12, 'coupon_code', NULL, '120', '2021-03-20', '1', '41', '40'),
(220, 12, 'coupon_taka', '0', '120', '2021-03-20', '1', '41', '40'),
(221, 12, 'attribute_parent', '41', '120', '2021-03-20', '1', '41', '40'),
(222, 12, 'user_district', 'chandpur', '120', '2021-03-20', '1', '41', '40'),
(223, 12, 'user_city', 'matlab', '120', '2021-03-20', '1', '41', '40'),
(224, 12, 'user_zip', '2300', '120', '2021-03-20', '1', '41', '40'),
(225, 5, 'cancel_quantity', '2', '118', '2021-03-20', '1', NULL, NULL),
(226, 4, 'cancel_quantity', '2', '118', '2021-03-20', '1', NULL, NULL),
(235, 13, '_tax_class', '', '123', '2021-03-20', '1', '47', '44'),
(227, 7, 'cancel_quantity_default', '10', '118', NULL, NULL, NULL, '5'),
(228, 7, 'cancel_default_product', '5', '118', NULL, NULL, NULL, NULL),
(229, 4, 'cancel_quantity_attribute', '0', '118', NULL, NULL, NULL, NULL),
(230, 4, 'cancel_attribute_product', '116', '118', NULL, NULL, NULL, NULL),
(231, 5, 'cancel_quantity_attribute', '0', '118', NULL, NULL, NULL, NULL),
(232, 5, 'cancel_attribute_product', '51', '118', NULL, NULL, NULL, NULL),
(233, 6, 'cancel_quantity_attribute', '5', '118', NULL, NULL, NULL, NULL),
(234, 6, 'cancel_attribute_product', '45', '118', NULL, NULL, NULL, NULL),
(236, 13, '_qty', '0', '123', '2021-03-20', '1', '47', '44'),
(237, 13, '_product_id', '47', '123', '2021-03-20', '1', '47', '44'),
(238, 13, '_variation_id', '', '123', '2021-03-20', '1', '47', '44'),
(239, 13, 'order_actual_cost', '900', '123', '2021-03-20', '1', '47', '44'),
(240, 13, 'order_product_cost', '0', '123', '2021-03-20', '1', '47', '44'),
(241, 13, '_line_subtotal', '0', '123', '2021-03-20', '1', '47', '44'),
(242, 13, '_line_total', '10000', '123', '2021-03-20', '1', '47', '44'),
(243, 13, '_line_subtotal_tax', '', '123', '2021-03-20', '1', '47', '44'),
(244, 13, '_line_tax', '', '123', '2021-03-20', '1', '47', '44'),
(245, 13, '_line_tax_data', '2021-03-20 23:43:22', '123', '2021-03-20', '1', '47', '44'),
(246, 13, 'delivery_charge', '0', '123', '2021-03-20', '1', '47', '44'),
(247, 13, 'coupon_code', NULL, '123', '2021-03-20', '1', '47', '44'),
(248, 13, 'coupon_taka', '0', '123', '2021-03-20', '1', '47', '44'),
(249, 13, 'attribute_parent', '47', '123', '2021-03-20', '1', '47', '44'),
(250, 13, 'user_district', 'Comilla', '123', '2021-03-20', '1', '47', '44'),
(251, 13, 'user_city', 'Laksham', '123', '2021-03-20', '1', '47', '44'),
(252, 13, 'user_zip', '1300', '123', '2021-03-20', '1', '47', '44'),
(253, 14, '_tax_class', '', '123', '2021-03-20', '1', '5', '5'),
(254, 14, '_qty', '0', '123', '2021-03-20', '1', '5', '5'),
(255, 14, '_product_id', '5', '123', '2021-03-20', '1', '5', '5'),
(256, 14, '_variation_id', '', '123', '2021-03-20', '1', '5', '5'),
(257, 14, 'order_actual_cost', '700', '123', '2021-03-20', '1', '5', '5'),
(258, 14, 'order_product_cost', '0', '123', '2021-03-20', '1', '5', '5'),
(259, 14, '_line_subtotal', '0', '123', '2021-03-20', '1', '5', '5'),
(260, 14, '_line_total', '9000', '123', '2021-03-20', '1', '5', '5'),
(261, 14, '_line_subtotal_tax', '', '123', '2021-03-20', '1', '5', '5'),
(262, 14, '_line_tax', '', '123', '2021-03-20', '1', '5', '5'),
(263, 14, '_line_tax_data', '2021-03-20 23:43:22', '123', '2021-03-20', '1', '5', '5'),
(264, 14, 'delivery_charge', '0', '123', '2021-03-20', '1', '5', '5'),
(265, 14, 'coupon_code', NULL, '123', '2021-03-20', '1', '5', '5'),
(266, 14, 'coupon_taka', '0', '123', '2021-03-20', '1', '5', '5'),
(267, 14, 'attribute_parent', '5', '123', '2021-03-20', '1', '5', '5'),
(268, 14, 'user_district', 'Comilla', '123', '2021-03-20', '1', '5', '5'),
(269, 14, 'user_city', 'Laksham', '123', '2021-03-20', '1', '5', '5'),
(270, 14, 'user_zip', '1300', '123', '2021-03-20', '1', '5', '5'),
(271, 13, 'product_status', 'cancel', '123', '2021-03-20', '2', NULL, NULL),
(272, 13, 'product_status', 'cancel', '123', '2021-03-20', '2', NULL, NULL),
(273, 14, 'product_status', 'cancel', '123', '2021-03-20', '2', NULL, NULL),
(274, 14, 'product_status', 'cancel', '123', '2021-03-20', '2', NULL, NULL),
(275, 15, '_tax_class', '', '126', '2021-03-20', '1', '45', '44'),
(276, 15, '_qty', '1', '126', '2021-03-20', '1', '45', '44'),
(277, 15, '_product_id', '45', '126', '2021-03-20', '1', '45', '44'),
(278, 15, '_variation_id', '', '126', '2021-03-20', '1', '45', '44'),
(279, 15, 'order_actual_cost', '900', '126', '2021-03-20', '1', '45', '44'),
(280, 15, 'order_product_cost', '900', '126', '2021-03-20', '1', '45', '44'),
(281, 15, '_line_subtotal', '1000', '126', '2021-03-20', '1', '45', '44'),
(282, 15, '_line_total', '1000', '126', '2021-03-20', '1', '45', '44'),
(283, 15, '_line_subtotal_tax', '', '126', '2021-03-20', '1', '45', '44'),
(284, 15, '_line_tax', '', '126', '2021-03-20', '1', '45', '44'),
(285, 15, '_line_tax_data', '2021-03-20 23:50:49', '126', '2021-03-20', '1', '45', '44'),
(286, 15, 'delivery_charge', '100', '126', '2021-03-20', '1', '45', '44'),
(287, 15, 'coupon_code', 'ten', '126', '2021-03-20', '1', '45', '44'),
(288, 15, 'coupon_taka', '250', '126', '2021-03-20', '1', '45', '44'),
(289, 15, 'attribute_parent', '45', '126', '2021-03-20', '1', '45', '44'),
(290, 15, 'user_district', 'Dhaka', '126', '2021-03-20', '1', '45', '44'),
(291, 15, 'user_city', 'Badda', '126', '2021-03-20', '1', '45', '44'),
(292, 15, 'user_zip', '1200', '126', '2021-03-20', '1', '45', '44'),
(293, 16, '_tax_class', '', '126', '2021-03-20', '1', '116', '115'),
(294, 16, '_qty', '5', '126', '2021-03-20', '1', '116', '115'),
(295, 16, '_product_id', '116', '126', '2021-03-20', '1', '116', '115'),
(296, 16, '_variation_id', '', '126', '2021-03-20', '1', '116', '115'),
(297, 16, 'order_actual_cost', '200', '126', '2021-03-20', '1', '116', '115'),
(298, 16, 'order_product_cost', '1000', '126', '2021-03-20', '1', '116', '115'),
(299, 16, '_line_subtotal', '1500', '126', '2021-03-20', '1', '116', '115'),
(300, 16, '_line_total', '1500', '126', '2021-03-20', '1', '116', '115'),
(301, 16, '_line_subtotal_tax', '', '126', '2021-03-20', '1', '116', '115'),
(302, 16, '_line_tax', '', '126', '2021-03-20', '1', '116', '115'),
(303, 16, '_line_tax_data', '2021-03-20 23:50:49', '126', '2021-03-20', '1', '116', '115'),
(304, 16, 'delivery_charge', '100', '126', '2021-03-20', '1', '116', '115'),
(305, 16, 'coupon_code', 'ten', '126', '2021-03-20', '1', '116', '115'),
(306, 16, 'coupon_taka', '250', '126', '2021-03-20', '1', '116', '115'),
(307, 16, 'attribute_parent', '116', '126', '2021-03-20', '1', '116', '115'),
(308, 16, 'user_district', 'Dhaka', '126', '2021-03-20', '1', '116', '115'),
(309, 16, 'user_city', 'Badda', '126', '2021-03-20', '1', '116', '115'),
(310, 16, 'user_zip', '1200', '126', '2021-03-20', '1', '116', '115'),
(311, 17, '_tax_class', '', '127', '2021-03-20', '1', '50', '49'),
(312, 17, '_qty', '10', '127', '2021-03-20', '1', '50', '49'),
(313, 17, '_product_id', '50', '127', '2021-03-20', '1', '50', '49'),
(314, 17, '_variation_id', '', '127', '2021-03-20', '1', '50', '49'),
(315, 17, 'order_actual_cost', '600', '127', '2021-03-20', '1', '50', '49'),
(316, 17, 'order_product_cost', '6000', '127', '2021-03-20', '1', '50', '49'),
(317, 17, '_line_subtotal', '10000', '127', '2021-03-20', '1', '50', '49'),
(318, 17, '_line_total', '10000', '127', '2021-03-20', '1', '50', '49'),
(319, 17, '_line_subtotal_tax', '', '127', '2021-03-20', '1', '50', '49'),
(320, 17, '_line_tax', '', '127', '2021-03-20', '1', '50', '49'),
(321, 17, '_line_tax_data', '2021-03-20 23:51:21', '127', '2021-03-20', '1', '50', '49'),
(322, 17, 'delivery_charge', '0', '127', '2021-03-20', '1', '50', '49'),
(323, 17, 'coupon_code', NULL, '127', '2021-03-20', '1', '50', '49'),
(324, 17, 'coupon_taka', '0', '127', '2021-03-20', '1', '50', '49'),
(325, 17, 'attribute_parent', '50', '127', '2021-03-20', '1', '50', '49'),
(326, 17, 'user_district', 'Dhaka', '127', '2021-03-20', '1', '50', '49'),
(327, 17, 'user_city', 'Badda', '127', '2021-03-20', '1', '50', '49'),
(328, 17, 'user_zip', '1200', '127', '2021-03-20', '1', '50', '49'),
(329, 18, '_tax_class', '', '127', '2021-03-20', '1', '39', '39'),
(330, 18, '_qty', '1', '127', '2021-03-20', '1', '39', '39'),
(331, 18, '_product_id', '39', '127', '2021-03-20', '1', '39', '39'),
(332, 18, '_variation_id', '', '127', '2021-03-20', '1', '39', '39'),
(333, 18, 'order_actual_cost', '800', '127', '2021-03-20', '1', '39', '39'),
(334, 18, 'order_product_cost', '800', '127', '2021-03-20', '1', '39', '39'),
(335, 18, '_line_subtotal', '1000', '127', '2021-03-20', '1', '39', '39'),
(336, 18, '_line_total', '1000', '127', '2021-03-20', '1', '39', '39'),
(337, 18, '_line_subtotal_tax', '', '127', '2021-03-20', '1', '39', '39'),
(338, 18, '_line_tax', '', '127', '2021-03-20', '1', '39', '39'),
(339, 18, '_line_tax_data', '2021-03-20 23:51:21', '127', '2021-03-20', '1', '39', '39'),
(340, 18, 'delivery_charge', '0', '127', '2021-03-20', '1', '39', '39'),
(341, 18, 'coupon_code', NULL, '127', '2021-03-20', '1', '39', '39'),
(342, 18, 'coupon_taka', '0', '127', '2021-03-20', '1', '39', '39'),
(343, 18, 'attribute_parent', '39', '127', '2021-03-20', '1', '39', '39'),
(344, 18, 'user_district', 'Dhaka', '127', '2021-03-20', '1', '39', '39'),
(345, 18, 'user_city', 'Badda', '127', '2021-03-20', '1', '39', '39'),
(346, 18, 'user_zip', '1200', '127', '2021-03-20', '1', '39', '39'),
(347, 19, '_tax_class', '', '128', '2021-03-20', '3', '50', '49'),
(348, 19, '_qty', '0', '128', '2021-03-20', '3', '50', '49'),
(349, 19, '_product_id', '50', '128', '2021-03-20', '3', '50', '49'),
(350, 19, '_variation_id', '', '128', '2021-03-20', '3', '50', '49'),
(351, 19, 'order_actual_cost', '600', '128', '2021-03-20', '3', '50', '49'),
(352, 19, 'order_product_cost', '600', '128', '2021-03-20', '3', '50', '49'),
(353, 19, '_line_subtotal', '0', '128', '2021-03-20', '3', '50', '49'),
(354, 19, '_line_total', '1000', '128', '2021-03-20', '3', '50', '49'),
(355, 19, '_line_subtotal_tax', '', '128', '2021-03-20', '3', '50', '49'),
(356, 19, '_line_tax', '', '128', '2021-03-20', '3', '50', '49'),
(357, 19, '_line_tax_data', '2021-03-21 05:51:53', '128', '2021-03-20', '3', '50', '49'),
(358, 19, 'delivery_charge', '175', '128', '2021-03-20', '3', '50', '49'),
(359, 19, 'coupon_code', NULL, '128', '2021-03-20', '3', '50', '49'),
(360, 19, 'coupon_taka', '0', '128', '2021-03-20', '3', '50', '49'),
(361, 19, 'attribute_parent', '50', '128', '2021-03-20', '3', '50', '49'),
(362, 19, 'user_district', 'chandpur', '128', '2021-03-20', '3', '50', '49'),
(363, 19, 'user_city', 'matlab', '128', '2021-03-20', '3', '50', '49'),
(364, 19, 'user_zip', '2300', '128', '2021-03-20', '3', '50', '49'),
(365, 20, '_tax_class', '', '129', '2021-03-21', '2', '4', '1'),
(366, 20, '_qty', '1', '129', '2021-03-21', '2', '4', '1'),
(367, 20, '_product_id', '4', '129', '2021-03-21', '2', '4', '1'),
(368, 20, '_variation_id', '', '129', '2021-03-21', '2', '4', '1'),
(369, 20, 'order_actual_cost', '900', '129', '2021-03-21', '2', '4', '1'),
(370, 20, 'order_product_cost', '900', '129', '2021-03-21', '2', '4', '1'),
(371, 20, '_line_subtotal', '1000', '129', '2021-03-21', '2', '4', '1'),
(372, 20, '_line_total', '1000', '129', '2021-03-21', '2', '4', '1'),
(373, 20, '_line_subtotal_tax', '', '129', '2021-03-21', '2', '4', '1'),
(374, 20, '_line_tax', '', '129', '2021-03-21', '2', '4', '1'),
(375, 20, '_line_tax_data', '2021-03-21 17:23:12', '129', '2021-03-21', '2', '4', '1'),
(376, 20, 'delivery_charge', '100', '129', '2021-03-21', '2', '4', '1'),
(377, 20, 'coupon_code', NULL, '129', '2021-03-21', '2', '4', '1'),
(378, 20, 'coupon_taka', '0', '129', '2021-03-21', '2', '4', '1'),
(379, 20, 'attribute_parent', '4', '129', '2021-03-21', '2', '4', '1'),
(380, 20, 'user_district', 'Dhaka', '129', '2021-03-21', '2', '4', '1'),
(381, 20, 'user_city', 'Badda', '129', '2021-03-21', '2', '4', '1'),
(382, 20, 'user_zip', '1200', '129', '2021-03-21', '2', '4', '1'),
(383, 21, '_tax_class', '', '129', '2021-03-21', '2', '9', '6'),
(384, 21, '_qty', '1', '129', '2021-03-21', '2', '9', '6'),
(385, 21, '_product_id', '9', '129', '2021-03-21', '2', '9', '6'),
(386, 21, '_variation_id', '', '129', '2021-03-21', '2', '9', '6'),
(387, 21, 'order_actual_cost', '700', '129', '2021-03-21', '2', '9', '6'),
(388, 21, 'order_product_cost', '700', '129', '2021-03-21', '2', '9', '6'),
(389, 21, '_line_subtotal', '800', '129', '2021-03-21', '2', '9', '6'),
(390, 21, '_line_total', '800', '129', '2021-03-21', '2', '9', '6'),
(391, 21, '_line_subtotal_tax', '', '129', '2021-03-21', '2', '9', '6'),
(392, 21, '_line_tax', '', '129', '2021-03-21', '2', '9', '6'),
(393, 21, '_line_tax_data', '2021-03-21 17:23:12', '129', '2021-03-21', '2', '9', '6'),
(394, 21, 'delivery_charge', '100', '129', '2021-03-21', '2', '9', '6'),
(395, 21, 'coupon_code', NULL, '129', '2021-03-21', '2', '9', '6'),
(396, 21, 'coupon_taka', '0', '129', '2021-03-21', '2', '9', '6'),
(397, 21, 'attribute_parent', '9', '129', '2021-03-21', '2', '9', '6'),
(398, 21, 'user_district', 'Dhaka', '129', '2021-03-21', '2', '9', '6'),
(399, 21, 'user_city', 'Badda', '129', '2021-03-21', '2', '9', '6'),
(400, 21, 'user_zip', '1200', '129', '2021-03-21', '2', '9', '6'),
(401, 22, '_tax_class', '', '130', '2021-03-21', '2', '27', '26'),
(402, 22, '_qty', '1', '130', '2021-03-21', '2', '27', '26'),
(403, 22, '_product_id', '27', '130', '2021-03-21', '2', '27', '26'),
(404, 22, '_variation_id', '', '130', '2021-03-21', '2', '27', '26'),
(405, 22, 'order_actual_cost', '700', '130', '2021-03-21', '2', '27', '26'),
(406, 22, 'order_product_cost', '700', '130', '2021-03-21', '2', '27', '26'),
(407, 22, '_line_subtotal', '1000', '130', '2021-03-21', '2', '27', '26'),
(408, 22, '_line_total', '2000', '130', '2021-03-21', '2', '27', '26'),
(409, 22, '_line_subtotal_tax', '', '130', '2021-03-21', '2', '27', '26'),
(410, 22, '_line_tax', '', '130', '2021-03-21', '2', '27', '26'),
(411, 22, '_line_tax_data', '2021-03-21 17:34:26', '130', '2021-03-21', '2', '27', '26'),
(412, 22, 'delivery_charge', '175', '130', '2021-03-21', '2', '27', '26'),
(413, 22, 'coupon_code', NULL, '130', '2021-03-21', '2', '27', '26'),
(414, 22, 'coupon_taka', '0', '130', '2021-03-21', '2', '27', '26'),
(415, 22, 'attribute_parent', '27', '130', '2021-03-21', '2', '27', '26'),
(416, 22, 'user_district', 'chandpur', '130', '2021-03-21', '2', '27', '26'),
(417, 22, 'user_city', 'matlab', '130', '2021-03-21', '2', '27', '26'),
(418, 22, 'user_zip', '2300', '130', '2021-03-21', '2', '27', '26'),
(419, 23, '_tax_class', '', '130', '2021-03-21', '2', '50', '49'),
(420, 23, '_qty', '0', '130', '2021-03-21', '2', '50', '49'),
(421, 23, '_product_id', '50', '130', '2021-03-21', '2', '50', '49'),
(422, 23, '_variation_id', '', '130', '2021-03-21', '2', '50', '49'),
(423, 23, 'order_actual_cost', '600', '130', '2021-03-21', '2', '50', '49'),
(424, 23, 'order_product_cost', '0', '130', '2021-03-21', '2', '50', '49'),
(425, 23, '_line_subtotal', '0', '130', '2021-03-21', '2', '50', '49'),
(426, 23, '_line_total', '2000', '130', '2021-03-21', '2', '50', '49'),
(427, 23, '_line_subtotal_tax', '', '130', '2021-03-21', '2', '50', '49'),
(428, 23, '_line_tax', '', '130', '2021-03-21', '2', '50', '49'),
(429, 23, '_line_tax_data', '2021-03-21 17:34:26', '130', '2021-03-21', '2', '50', '49'),
(430, 23, 'delivery_charge', '175', '130', '2021-03-21', '2', '50', '49'),
(431, 23, 'coupon_code', NULL, '130', '2021-03-21', '2', '50', '49'),
(432, 23, 'coupon_taka', '0', '130', '2021-03-21', '2', '50', '49'),
(433, 23, 'attribute_parent', '50', '130', '2021-03-21', '2', '50', '49'),
(434, 23, 'user_district', 'chandpur', '130', '2021-03-21', '2', '50', '49'),
(435, 23, 'user_city', 'matlab', '130', '2021-03-21', '2', '50', '49'),
(436, 23, 'user_zip', '2300', '130', '2021-03-21', '2', '50', '49'),
(437, 24, '_tax_class', '', '130', '2021-03-21', '2', '5', '5'),
(438, 24, '_qty', '1', '130', '2021-03-21', '2', '5', '5'),
(439, 24, '_product_id', '5', '130', '2021-03-21', '2', '5', '5'),
(440, 24, '_variation_id', '', '130', '2021-03-21', '2', '5', '5'),
(441, 24, 'order_actual_cost', '700', '130', '2021-03-21', '2', '5', '5'),
(442, 24, 'order_product_cost', '700', '130', '2021-03-21', '2', '5', '5'),
(443, 24, '_line_subtotal', '900', '130', '2021-03-21', '2', '5', '5'),
(444, 24, '_line_total', '900', '130', '2021-03-21', '2', '5', '5'),
(445, 24, '_line_subtotal_tax', '', '130', '2021-03-21', '2', '5', '5'),
(446, 24, '_line_tax', '', '130', '2021-03-21', '2', '5', '5'),
(447, 24, '_line_tax_data', '2021-03-21 17:34:26', '130', '2021-03-21', '2', '5', '5'),
(448, 24, 'delivery_charge', '175', '130', '2021-03-21', '2', '5', '5'),
(449, 24, 'coupon_code', NULL, '130', '2021-03-21', '2', '5', '5'),
(450, 24, 'coupon_taka', '0', '130', '2021-03-21', '2', '5', '5'),
(451, 24, 'attribute_parent', '5', '130', '2021-03-21', '2', '5', '5'),
(452, 24, 'user_district', 'chandpur', '130', '2021-03-21', '2', '5', '5'),
(453, 24, 'user_city', 'matlab', '130', '2021-03-21', '2', '5', '5'),
(454, 24, 'user_zip', '2300', '130', '2021-03-21', '2', '5', '5'),
(455, 25, '_tax_class', '', '137', '2021-03-21', '2', '27', '26'),
(456, 25, '_qty', '3', '137', '2021-03-21', '2', '27', '26'),
(457, 25, '_product_id', '27', '137', '2021-03-21', '2', '27', '26'),
(458, 25, '_variation_id', '', '137', '2021-03-21', '2', '27', '26'),
(459, 25, 'order_actual_cost', '700', '137', '2021-03-21', '2', '27', '26'),
(460, 25, 'order_product_cost', '2100', '137', '2021-03-21', '2', '27', '26'),
(461, 25, '_line_subtotal', '3000', '137', '2021-03-21', '2', '27', '26'),
(462, 25, '_line_total', '3000', '137', '2021-03-21', '2', '27', '26'),
(463, 25, '_line_subtotal_tax', '', '137', '2021-03-21', '2', '27', '26'),
(464, 25, '_line_tax', '', '137', '2021-03-21', '2', '27', '26'),
(465, 25, '_line_tax_data', '2021-03-21 20:19:07', '137', '2021-03-21', '2', '27', '26'),
(466, 25, 'delivery_charge', '200', '137', '2021-03-21', '2', '27', '26'),
(467, 25, 'coupon_code', NULL, '137', '2021-03-21', '2', '27', '26'),
(468, 25, 'coupon_taka', '0', '137', '2021-03-21', '2', '27', '26'),
(469, 25, 'attribute_parent', '27', '137', '2021-03-21', '2', '27', '26'),
(470, 25, 'user_district', 'Comilla', '137', '2021-03-21', '2', '27', '26'),
(471, 25, 'user_city', 'Laksham', '137', '2021-03-21', '2', '27', '26'),
(472, 25, 'user_zip', '1300', '137', '2021-03-21', '2', '27', '26'),
(473, 26, '_tax_class', '', '137', '2021-03-21', '2', '5', '5'),
(474, 26, '_qty', '2', '137', '2021-03-21', '2', '5', '5'),
(475, 26, '_product_id', '5', '137', '2021-03-21', '2', '5', '5'),
(476, 26, '_variation_id', '', '137', '2021-03-21', '2', '5', '5'),
(477, 26, 'order_actual_cost', '700', '137', '2021-03-21', '2', '5', '5'),
(478, 26, 'order_product_cost', '1400', '137', '2021-03-21', '2', '5', '5'),
(479, 26, '_line_subtotal', '1800', '137', '2021-03-21', '2', '5', '5'),
(480, 26, '_line_total', '1800', '137', '2021-03-21', '2', '5', '5'),
(481, 26, '_line_subtotal_tax', '', '137', '2021-03-21', '2', '5', '5'),
(482, 26, '_line_tax', '', '137', '2021-03-21', '2', '5', '5'),
(483, 26, '_line_tax_data', '2021-03-21 20:19:07', '137', '2021-03-21', '2', '5', '5'),
(484, 26, 'delivery_charge', '200', '137', '2021-03-21', '2', '5', '5'),
(485, 26, 'coupon_code', NULL, '137', '2021-03-21', '2', '5', '5'),
(486, 26, 'coupon_taka', '0', '137', '2021-03-21', '2', '5', '5'),
(487, 26, 'attribute_parent', '5', '137', '2021-03-21', '2', '5', '5'),
(488, 26, 'user_district', 'Comilla', '137', '2021-03-21', '2', '5', '5'),
(489, 26, 'user_city', 'Laksham', '137', '2021-03-21', '2', '5', '5'),
(490, 26, 'user_zip', '1300', '137', '2021-03-21', '2', '5', '5'),
(491, 23, 'product_status', 'cancel', '130', '2021-03-21', '2', NULL, NULL),
(492, 22, 'product_status', 'cancel', '130', '2021-03-21', '2', NULL, NULL),
(493, 27, '_tax_class', '', '138', '2021-03-21', '2', '5', '5'),
(494, 27, '_qty', '1', '138', '2021-03-21', '2', '5', '5'),
(495, 27, '_product_id', '5', '138', '2021-03-21', '2', '5', '5'),
(496, 27, '_variation_id', '', '138', '2021-03-21', '2', '5', '5'),
(497, 27, 'order_actual_cost', '700', '138', '2021-03-21', '2', '5', '5'),
(498, 27, 'order_product_cost', '700', '138', '2021-03-21', '2', '5', '5'),
(499, 27, '_line_subtotal', '900', '138', '2021-03-21', '2', '5', '5'),
(500, 27, '_line_total', '1800', '138', '2021-03-21', '2', '5', '5'),
(501, 27, '_line_subtotal_tax', '', '138', '2021-03-21', '2', '5', '5'),
(502, 27, '_line_tax', '', '138', '2021-03-21', '2', '5', '5'),
(503, 27, '_line_tax_data', '2021-03-21 20:45:55', '138', '2021-03-21', '2', '5', '5'),
(504, 27, 'delivery_charge', '100', '138', '2021-03-21', '2', '5', '5'),
(505, 27, 'coupon_code', 'newyear21', '138', '2021-03-21', '2', '5', '5'),
(506, 27, 'coupon_taka', '390', '138', '2021-03-21', '2', '5', '5'),
(507, 27, 'attribute_parent', '5', '138', '2021-03-21', '2', '5', '5'),
(508, 27, 'user_district', 'Dhaka', '138', '2021-03-21', '2', '5', '5'),
(509, 27, 'user_city', 'Badda', '138', '2021-03-21', '2', '5', '5'),
(510, 27, 'user_zip', '1200', '138', '2021-03-21', '2', '5', '5'),
(511, 28, '_tax_class', '', '138', '2021-03-21', '2', '46', '44'),
(512, 28, '_qty', '3', '138', '2021-03-21', '2', '46', '44'),
(513, 28, '_product_id', '46', '138', '2021-03-21', '2', '46', '44'),
(514, 28, '_variation_id', '', '138', '2021-03-21', '2', '46', '44'),
(515, 28, 'order_actual_cost', '900', '138', '2021-03-21', '2', '46', '44'),
(516, 28, 'order_product_cost', '2700', '138', '2021-03-21', '2', '46', '44'),
(517, 28, '_line_subtotal', '3000', '138', '2021-03-21', '2', '46', '44'),
(518, 28, '_line_total', '3000', '138', '2021-03-21', '2', '46', '44'),
(519, 28, '_line_subtotal_tax', '', '138', '2021-03-21', '2', '46', '44'),
(520, 28, '_line_tax', '', '138', '2021-03-21', '2', '46', '44'),
(521, 28, '_line_tax_data', '2021-03-21 20:45:55', '138', '2021-03-21', '2', '46', '44'),
(522, 28, 'delivery_charge', '100', '138', '2021-03-21', '2', '46', '44'),
(523, 28, 'coupon_code', 'newyear21', '138', '2021-03-21', '2', '46', '44'),
(524, 28, 'coupon_taka', '390', '138', '2021-03-21', '2', '46', '44'),
(525, 28, 'attribute_parent', '46', '138', '2021-03-21', '2', '46', '44'),
(526, 28, 'user_district', 'Dhaka', '138', '2021-03-21', '2', '46', '44'),
(527, 28, 'user_city', 'Badda', '138', '2021-03-21', '2', '46', '44'),
(528, 28, 'user_zip', '1200', '138', '2021-03-21', '2', '46', '44'),
(529, 27, 'product_status', 'cancel', '138', '2021-03-21', '2', NULL, NULL),
(530, 29, '_tax_class', '', '141', '2021-03-22', '7', '51', '49'),
(531, 29, '_qty', '0', '141', '2021-03-22', '7', '51', '49'),
(532, 29, '_product_id', '51', '141', '2021-03-22', '7', '51', '49'),
(533, 29, '_variation_id', '', '141', '2021-03-22', '7', '51', '49'),
(534, 29, 'order_actual_cost', '600', '141', '2021-03-22', '7', '51', '49'),
(535, 29, 'order_product_cost', '6000', '141', '2021-03-22', '7', '51', '49'),
(536, 29, '_line_subtotal', '0', '141', '2021-03-22', '7', '51', '49'),
(537, 29, '_line_total', '10000', '141', '2021-03-22', '7', '51', '49'),
(538, 29, '_line_subtotal_tax', '', '141', '2021-03-22', '7', '51', '49'),
(539, 29, '_line_tax', '', '141', '2021-03-22', '7', '51', '49'),
(540, 29, '_line_tax_data', '2021-03-22 17:23:05', '141', '2021-03-22', '7', '51', '49'),
(541, 29, 'delivery_charge', '0', '141', '2021-03-22', '7', '51', '49'),
(542, 29, 'coupon_code', NULL, '141', '2021-03-22', '7', '51', '49'),
(543, 29, 'coupon_taka', '0', '141', '2021-03-22', '7', '51', '49'),
(544, 29, 'attribute_parent', '51', '141', '2021-03-22', '7', '51', '49'),
(545, 29, 'user_district', 'Dhaka', '141', '2021-03-22', '7', '51', '49'),
(546, 29, 'user_city', 'Badda', '141', '2021-03-22', '7', '51', '49'),
(547, 29, 'user_zip', '1200', '141', '2021-03-22', '7', '51', '49'),
(548, 30, '_tax_class', '', '141', '2021-03-22', '7', '45', '44'),
(549, 30, '_qty', '0', '141', '2021-03-22', '7', '45', '44'),
(550, 30, '_product_id', '45', '141', '2021-03-22', '7', '45', '44'),
(551, 30, '_variation_id', '', '141', '2021-03-22', '7', '45', '44'),
(552, 30, 'order_actual_cost', '900', '141', '2021-03-22', '7', '45', '44'),
(553, 30, 'order_product_cost', '5400', '141', '2021-03-22', '7', '45', '44'),
(554, 30, '_line_subtotal', '0', '141', '2021-03-22', '7', '45', '44'),
(555, 30, '_line_total', '6000', '141', '2021-03-22', '7', '45', '44'),
(556, 30, '_line_subtotal_tax', '', '141', '2021-03-22', '7', '45', '44'),
(557, 30, '_line_tax', '', '141', '2021-03-22', '7', '45', '44'),
(558, 30, '_line_tax_data', '2021-03-22 17:23:05', '141', '2021-03-22', '7', '45', '44'),
(559, 30, 'delivery_charge', '0', '141', '2021-03-22', '7', '45', '44'),
(560, 30, 'coupon_code', NULL, '141', '2021-03-22', '7', '45', '44'),
(561, 30, 'coupon_taka', '0', '141', '2021-03-22', '7', '45', '44'),
(562, 30, 'attribute_parent', '45', '141', '2021-03-22', '7', '45', '44'),
(563, 30, 'user_district', 'Dhaka', '141', '2021-03-22', '7', '45', '44'),
(564, 30, 'user_city', 'Badda', '141', '2021-03-22', '7', '45', '44'),
(565, 30, 'user_zip', '1200', '141', '2021-03-22', '7', '45', '44'),
(566, 31, '_tax_class', '', '141', '2021-03-22', '7', '39', '39'),
(567, 31, '_qty', '0', '141', '2021-03-22', '7', '39', '39'),
(568, 31, '_product_id', '39', '141', '2021-03-22', '7', '39', '39'),
(569, 31, '_variation_id', '', '141', '2021-03-22', '7', '39', '39'),
(570, 31, 'order_actual_cost', '800', '141', '2021-03-22', '7', '39', '39'),
(571, 31, 'order_product_cost', '4000', '141', '2021-03-22', '7', '39', '39'),
(572, 31, '_line_subtotal', '0', '141', '2021-03-22', '7', '39', '39'),
(573, 31, '_line_total', '5000', '141', '2021-03-22', '7', '39', '39'),
(574, 31, '_line_subtotal_tax', '', '141', '2021-03-22', '7', '39', '39'),
(575, 31, '_line_tax', '', '141', '2021-03-22', '7', '39', '39'),
(576, 31, '_line_tax_data', '2021-03-22 17:23:05', '141', '2021-03-22', '7', '39', '39'),
(577, 31, 'delivery_charge', '0', '141', '2021-03-22', '7', '39', '39'),
(578, 31, 'coupon_code', NULL, '141', '2021-03-22', '7', '39', '39'),
(579, 31, 'coupon_taka', '0', '141', '2021-03-22', '7', '39', '39'),
(580, 31, 'attribute_parent', '39', '141', '2021-03-22', '7', '39', '39'),
(581, 31, 'user_district', 'Dhaka', '141', '2021-03-22', '7', '39', '39'),
(582, 31, 'user_city', 'Badda', '141', '2021-03-22', '7', '39', '39'),
(583, 31, 'user_zip', '1200', '141', '2021-03-22', '7', '39', '39'),
(584, 32, '_tax_class', '', '141', '2021-03-22', '7', '27', '26'),
(585, 32, '_qty', '0', '141', '2021-03-22', '7', '27', '26'),
(586, 32, '_product_id', '27', '141', '2021-03-22', '7', '27', '26'),
(587, 32, '_variation_id', '', '141', '2021-03-22', '7', '27', '26'),
(588, 32, 'order_actual_cost', '700', '141', '2021-03-22', '7', '27', '26'),
(589, 32, 'order_product_cost', '700', '141', '2021-03-22', '7', '27', '26'),
(590, 32, '_line_subtotal', '0', '141', '2021-03-22', '7', '27', '26'),
(591, 32, '_line_total', '1000', '141', '2021-03-22', '7', '27', '26'),
(592, 32, '_line_subtotal_tax', '', '141', '2021-03-22', '7', '27', '26'),
(593, 32, '_line_tax', '', '141', '2021-03-22', '7', '27', '26'),
(594, 32, '_line_tax_data', '2021-03-22 17:23:05', '141', '2021-03-22', '7', '27', '26'),
(595, 32, 'delivery_charge', '0', '141', '2021-03-22', '7', '27', '26'),
(596, 32, 'coupon_code', NULL, '141', '2021-03-22', '7', '27', '26'),
(597, 32, 'coupon_taka', '0', '141', '2021-03-22', '7', '27', '26'),
(598, 32, 'attribute_parent', '27', '141', '2021-03-22', '7', '27', '26'),
(599, 32, 'user_district', 'Dhaka', '141', '2021-03-22', '7', '27', '26'),
(600, 32, 'user_city', 'Badda', '141', '2021-03-22', '7', '27', '26'),
(601, 32, 'user_zip', '1200', '141', '2021-03-22', '7', '27', '26'),
(602, 33, '_tax_class', '', '142', '2021-03-22', '7', '5', '5'),
(603, 33, '_qty', '3', '142', '2021-03-22', '7', '5', '5'),
(604, 33, '_product_id', '5', '142', '2021-03-22', '7', '5', '5'),
(605, 33, '_variation_id', '', '142', '2021-03-22', '7', '5', '5'),
(606, 33, 'order_actual_cost', '700', '142', '2021-03-22', '7', '5', '5'),
(607, 33, 'order_product_cost', '2100', '142', '2021-03-22', '7', '5', '5'),
(608, 33, '_line_subtotal', '2700', '142', '2021-03-22', '7', '5', '5'),
(609, 33, '_line_total', '2700', '142', '2021-03-22', '7', '5', '5'),
(610, 33, '_line_subtotal_tax', '', '142', '2021-03-22', '7', '5', '5'),
(611, 33, '_line_tax', '', '142', '2021-03-22', '7', '5', '5'),
(612, 33, '_line_tax_data', '2021-03-22 17:33:01', '142', '2021-03-22', '7', '5', '5'),
(613, 33, 'delivery_charge', '175', '142', '2021-03-22', '7', '5', '5'),
(614, 33, 'coupon_code', NULL, '142', '2021-03-22', '7', '5', '5'),
(615, 33, 'coupon_taka', '0', '142', '2021-03-22', '7', '5', '5'),
(616, 33, 'attribute_parent', '5', '142', '2021-03-22', '7', '5', '5'),
(617, 33, 'user_district', 'chandpur', '142', '2021-03-22', '7', '5', '5'),
(618, 33, 'user_city', 'matlab', '142', '2021-03-22', '7', '5', '5'),
(619, 33, 'user_zip', '2300', '142', '2021-03-22', '7', '5', '5'),
(620, 34, '_tax_class', '', '143', '2021-03-22', '7', '2', '1'),
(621, 34, '_qty', '1', '143', '2021-03-22', '7', '2', '1'),
(622, 34, '_product_id', '2', '143', '2021-03-22', '7', '2', '1'),
(623, 34, '_variation_id', '', '143', '2021-03-22', '7', '2', '1'),
(624, 34, 'order_actual_cost', '900', '143', '2021-03-22', '7', '2', '1'),
(625, 34, 'order_product_cost', '900', '143', '2021-03-22', '7', '2', '1'),
(626, 34, '_line_subtotal', '1000', '143', '2021-03-22', '7', '2', '1'),
(627, 34, '_line_total', '1000', '143', '2021-03-22', '7', '2', '1'),
(628, 34, '_line_subtotal_tax', '', '143', '2021-03-22', '7', '2', '1'),
(629, 34, '_line_tax', '', '143', '2021-03-22', '7', '2', '1'),
(630, 34, '_line_tax_data', '2021-03-22 18:02:43', '143', '2021-03-22', '7', '2', '1'),
(631, 34, 'delivery_charge', '100', '143', '2021-03-22', '7', '2', '1'),
(632, 34, 'coupon_code', 'arif', '143', '2021-03-22', '7', '2', '1'),
(633, 34, 'coupon_taka', '300', '143', '2021-03-22', '7', '2', '1'),
(634, 34, 'attribute_parent', '2', '143', '2021-03-22', '7', '2', '1'),
(635, 34, 'user_district', 'Dhaka', '143', '2021-03-22', '7', '2', '1'),
(636, 34, 'user_city', 'Badda', '143', '2021-03-22', '7', '2', '1'),
(637, 34, 'user_zip', '1200', '143', '2021-03-22', '7', '2', '1'),
(638, 35, '_tax_class', '', '143', '2021-03-22', '7', '3', '1'),
(639, 35, '_qty', '2', '143', '2021-03-22', '7', '3', '1'),
(640, 35, '_product_id', '3', '143', '2021-03-22', '7', '3', '1'),
(641, 35, '_variation_id', '', '143', '2021-03-22', '7', '3', '1'),
(642, 35, 'order_actual_cost', '900', '143', '2021-03-22', '7', '3', '1'),
(643, 35, 'order_product_cost', '1800', '143', '2021-03-22', '7', '3', '1'),
(644, 35, '_line_subtotal', '2000', '143', '2021-03-22', '7', '3', '1'),
(645, 35, '_line_total', '2000', '143', '2021-03-22', '7', '3', '1'),
(646, 35, '_line_subtotal_tax', '', '143', '2021-03-22', '7', '3', '1'),
(647, 35, '_line_tax', '', '143', '2021-03-22', '7', '3', '1'),
(648, 35, '_line_tax_data', '2021-03-22 18:02:43', '143', '2021-03-22', '7', '3', '1'),
(649, 35, 'delivery_charge', '100', '143', '2021-03-22', '7', '3', '1'),
(650, 35, 'coupon_code', 'arif', '143', '2021-03-22', '7', '3', '1'),
(651, 35, 'coupon_taka', '300', '143', '2021-03-22', '7', '3', '1'),
(652, 35, 'attribute_parent', '3', '143', '2021-03-22', '7', '3', '1'),
(653, 35, 'user_district', 'Dhaka', '143', '2021-03-22', '7', '3', '1'),
(654, 35, 'user_city', 'Badda', '143', '2021-03-22', '7', '3', '1'),
(655, 35, 'user_zip', '1200', '143', '2021-03-22', '7', '3', '1'),
(656, 36, '_tax_class', '', '143', '2021-03-22', '7', '4', '1'),
(657, 36, '_qty', '3', '143', '2021-03-22', '7', '4', '1'),
(658, 36, '_product_id', '4', '143', '2021-03-22', '7', '4', '1'),
(659, 36, '_variation_id', '', '143', '2021-03-22', '7', '4', '1'),
(660, 36, 'order_actual_cost', '900', '143', '2021-03-22', '7', '4', '1'),
(661, 36, 'order_product_cost', '2700', '143', '2021-03-22', '7', '4', '1'),
(662, 36, '_line_subtotal', '3000', '143', '2021-03-22', '7', '4', '1'),
(663, 36, '_line_total', '3000', '143', '2021-03-22', '7', '4', '1'),
(664, 36, '_line_subtotal_tax', '', '143', '2021-03-22', '7', '4', '1'),
(665, 36, '_line_tax', '', '143', '2021-03-22', '7', '4', '1'),
(666, 36, '_line_tax_data', '2021-03-22 18:02:43', '143', '2021-03-22', '7', '4', '1'),
(667, 36, 'delivery_charge', '100', '143', '2021-03-22', '7', '4', '1'),
(668, 36, 'coupon_code', 'arif', '143', '2021-03-22', '7', '4', '1'),
(669, 36, 'coupon_taka', '300', '143', '2021-03-22', '7', '4', '1'),
(670, 36, 'attribute_parent', '4', '143', '2021-03-22', '7', '4', '1'),
(671, 36, 'user_district', 'Dhaka', '143', '2021-03-22', '7', '4', '1'),
(672, 36, 'user_city', 'Badda', '143', '2021-03-22', '7', '4', '1'),
(673, 36, 'user_zip', '1200', '143', '2021-03-22', '7', '4', '1'),
(674, 34, 'product_status', 'cancel', '143', '2021-03-22', '2', NULL, NULL),
(675, 34, 'cancel_quantity', '1', '143', '2021-03-22', '7', NULL, NULL),
(676, 0, 'cancel_quantity_default', '5', '141', NULL, NULL, NULL, '39'),
(677, 0, 'cancel_default_product', '39', '141', NULL, NULL, NULL, NULL),
(678, 0, 'cancel_quantity_attribute', '10', '141', NULL, NULL, NULL, NULL),
(679, 0, 'cancel_attribute_product', '51', '141', NULL, NULL, NULL, NULL),
(680, 0, 'cancel_quantity_attribute', '6', '141', NULL, NULL, NULL, NULL),
(681, 0, 'cancel_attribute_product', '45', '141', NULL, NULL, NULL, NULL),
(682, 0, 'cancel_quantity_attribute', '1', '141', NULL, NULL, NULL, NULL),
(683, 0, 'cancel_attribute_product', '27', '141', NULL, NULL, NULL, NULL),
(684, 37, '_tax_class', '', '146', '2021-03-22', '7', '5', '5'),
(685, 37, '_qty', '1', '146', '2021-03-22', '7', '5', '5'),
(686, 37, '_product_id', '5', '146', '2021-03-22', '7', '5', '5'),
(687, 37, '_variation_id', '', '146', '2021-03-22', '7', '5', '5'),
(688, 37, 'order_actual_cost', '700', '146', '2021-03-22', '7', '5', '5'),
(689, 37, 'order_product_cost', '700', '146', '2021-03-22', '7', '5', '5'),
(690, 37, '_line_subtotal', '900', '146', '2021-03-22', '7', '5', '5'),
(691, 37, '_line_total', '900', '146', '2021-03-22', '7', '5', '5'),
(692, 37, '_line_subtotal_tax', '', '146', '2021-03-22', '7', '5', '5'),
(693, 37, '_line_tax', '', '146', '2021-03-22', '7', '5', '5'),
(694, 37, '_line_tax_data', '2021-03-22 20:11:05', '146', '2021-03-22', '7', '5', '5'),
(695, 37, 'delivery_charge', '0', '146', '2021-03-22', '7', '5', '5'),
(696, 37, 'coupon_code', NULL, '146', '2021-03-22', '7', '5', '5'),
(697, 37, 'coupon_taka', '0', '146', '2021-03-22', '7', '5', '5'),
(698, 37, 'attribute_parent', '5', '146', '2021-03-22', '7', '5', '5'),
(699, 37, 'user_district', 'Dhaka', '146', '2021-03-22', '7', '5', '5'),
(700, 37, 'user_city', 'Badda', '146', '2021-03-22', '7', '5', '5'),
(701, 37, 'user_zip', '1200', '146', '2021-03-22', '7', '5', '5'),
(702, 38, '_tax_class', '', '147', '2021-03-22', '7', '50', '49'),
(703, 38, '_qty', '1', '147', '2021-03-22', '7', '50', '49'),
(704, 38, '_product_id', '50', '147', '2021-03-22', '7', '50', '49'),
(705, 38, '_variation_id', '', '147', '2021-03-22', '7', '50', '49'),
(706, 38, 'order_actual_cost', '600', '147', '2021-03-22', '7', '50', '49'),
(707, 38, 'order_product_cost', '600', '147', '2021-03-22', '7', '50', '49'),
(708, 38, '_line_subtotal', '1000', '147', '2021-03-22', '7', '50', '49'),
(709, 38, '_line_total', '1000', '147', '2021-03-22', '7', '50', '49'),
(710, 38, '_line_subtotal_tax', '', '147', '2021-03-22', '7', '50', '49'),
(711, 38, '_line_tax', '', '147', '2021-03-22', '7', '50', '49'),
(712, 38, '_line_tax_data', '2021-03-22 20:21:44', '147', '2021-03-22', '7', '50', '49'),
(713, 38, 'delivery_charge', '100', '147', '2021-03-22', '7', '50', '49'),
(714, 38, 'coupon_code', NULL, '147', '2021-03-22', '7', '50', '49'),
(715, 38, 'coupon_taka', '0', '147', '2021-03-22', '7', '50', '49');
INSERT INTO `order_itemmeta` (`meta_id`, `order_item_id`, `meta_key`, `meta_value`, `order_id`, `order_date`, `customer_id`, `product_id`, `product_parent`) VALUES
(716, 38, 'attribute_parent', '50', '147', '2021-03-22', '7', '50', '49'),
(717, 38, 'user_district', 'Dhaka', '147', '2021-03-22', '7', '50', '49'),
(718, 38, 'user_city', 'Badda', '147', '2021-03-22', '7', '50', '49'),
(719, 38, 'user_zip', '1200', '147', '2021-03-22', '7', '50', '49'),
(720, 39, '_tax_class', '', '148', '2021-03-23', '8', '50', '49'),
(721, 39, '_qty', '1', '148', '2021-03-23', '8', '50', '49'),
(722, 39, '_product_id', '50', '148', '2021-03-23', '8', '50', '49'),
(723, 39, '_variation_id', '', '148', '2021-03-23', '8', '50', '49'),
(724, 39, 'order_actual_cost', '600', '148', '2021-03-23', '8', '50', '49'),
(725, 39, 'order_product_cost', '600', '148', '2021-03-23', '8', '50', '49'),
(726, 39, '_line_subtotal', '1000', '148', '2021-03-23', '8', '50', '49'),
(727, 39, '_line_total', '1000', '148', '2021-03-23', '8', '50', '49'),
(728, 39, '_line_subtotal_tax', '', '148', '2021-03-23', '8', '50', '49'),
(729, 39, '_line_tax', '', '148', '2021-03-23', '8', '50', '49'),
(730, 39, '_line_tax_data', '2021-03-23 15:45:45', '148', '2021-03-23', '8', '50', '49'),
(731, 39, 'delivery_charge', '200', '148', '2021-03-23', '8', '50', '49'),
(732, 39, 'coupon_code', NULL, '148', '2021-03-23', '8', '50', '49'),
(733, 39, 'coupon_taka', '0', '148', '2021-03-23', '8', '50', '49'),
(734, 39, 'attribute_parent', '50', '148', '2021-03-23', '8', '50', '49'),
(735, 39, 'user_district', 'Comilla', '148', '2021-03-23', '8', '50', '49'),
(736, 39, 'user_city', 'Laksham', '148', '2021-03-23', '8', '50', '49'),
(737, 39, 'user_zip', '1300', '148', '2021-03-23', '8', '50', '49'),
(738, 40, '_tax_class', '', '148', '2021-03-23', '8', '39', '39'),
(739, 40, '_qty', '1', '148', '2021-03-23', '8', '39', '39'),
(740, 40, '_product_id', '39', '148', '2021-03-23', '8', '39', '39'),
(741, 40, '_variation_id', '', '148', '2021-03-23', '8', '39', '39'),
(742, 40, 'order_actual_cost', '800', '148', '2021-03-23', '8', '39', '39'),
(743, 40, 'order_product_cost', '800', '148', '2021-03-23', '8', '39', '39'),
(744, 40, '_line_subtotal', '1000', '148', '2021-03-23', '8', '39', '39'),
(745, 40, '_line_total', '1000', '148', '2021-03-23', '8', '39', '39'),
(746, 40, '_line_subtotal_tax', '', '148', '2021-03-23', '8', '39', '39'),
(747, 40, '_line_tax', '', '148', '2021-03-23', '8', '39', '39'),
(748, 40, '_line_tax_data', '2021-03-23 15:45:45', '148', '2021-03-23', '8', '39', '39'),
(749, 40, 'delivery_charge', '200', '148', '2021-03-23', '8', '39', '39'),
(750, 40, 'coupon_code', NULL, '148', '2021-03-23', '8', '39', '39'),
(751, 40, 'coupon_taka', '0', '148', '2021-03-23', '8', '39', '39'),
(752, 40, 'attribute_parent', '39', '148', '2021-03-23', '8', '39', '39'),
(753, 40, 'user_district', 'Comilla', '148', '2021-03-23', '8', '39', '39'),
(754, 40, 'user_city', 'Laksham', '148', '2021-03-23', '8', '39', '39'),
(755, 40, 'user_zip', '1300', '148', '2021-03-23', '8', '39', '39'),
(756, 41, '_tax_class', '', '151', '2021-03-24', '3', '50', '49'),
(757, 41, '_qty', '0', '151', '2021-03-24', '3', '50', '49'),
(758, 41, '_product_id', '50', '151', '2021-03-24', '3', '50', '49'),
(759, 41, '_variation_id', '', '151', '2021-03-24', '3', '50', '49'),
(760, 41, 'order_actual_cost', '600', '151', '2021-03-24', '3', '50', '49'),
(761, 41, 'order_product_cost', '0', '151', '2021-03-24', '3', '50', '49'),
(762, 41, '_line_subtotal', '0', '151', '2021-03-24', '3', '50', '49'),
(763, 41, '_line_total', '0', '151', '2021-03-24', '3', '50', '49'),
(764, 41, '_line_subtotal_tax', '', '151', '2021-03-24', '3', '50', '49'),
(765, 41, '_line_tax', '', '151', '2021-03-24', '3', '50', '49'),
(766, 41, '_line_tax_data', '2021-03-24 23:21:39', '151', '2021-03-24', '3', '50', '49'),
(767, 41, 'delivery_charge', '100', '151', '2021-03-24', '3', '50', '49'),
(768, 41, 'coupon_code', NULL, '151', '2021-03-24', '3', '50', '49'),
(769, 41, 'coupon_taka', '0', '151', '2021-03-24', '3', '50', '49'),
(770, 41, 'attribute_parent', '50', '151', '2021-03-24', '3', '50', '49'),
(771, 41, 'user_district', 'Dhaka', '151', '2021-03-24', '3', '50', '49'),
(772, 41, 'user_city', 'Badda', '151', '2021-03-24', '3', '50', '49'),
(773, 41, 'user_zip', '1200', '151', '2021-03-24', '3', '50', '49'),
(774, 42, '_tax_class', '', '151', '2021-03-24', '3', '3', '1'),
(775, 42, '_qty', '2', '151', '2021-03-24', '3', '3', '1'),
(776, 42, '_product_id', '3', '151', '2021-03-24', '3', '3', '1'),
(777, 42, '_variation_id', '', '151', '2021-03-24', '3', '3', '1'),
(778, 42, 'order_actual_cost', '900', '151', '2021-03-24', '3', '3', '1'),
(779, 42, 'order_product_cost', '1800', '151', '2021-03-24', '3', '3', '1'),
(780, 42, '_line_subtotal', '2000', '151', '2021-03-24', '3', '3', '1'),
(781, 42, '_line_total', '2000', '151', '2021-03-24', '3', '3', '1'),
(782, 42, '_line_subtotal_tax', '', '151', '2021-03-24', '3', '3', '1'),
(783, 42, '_line_tax', '', '151', '2021-03-24', '3', '3', '1'),
(784, 42, '_line_tax_data', '2021-03-24 23:21:39', '151', '2021-03-24', '3', '3', '1'),
(785, 42, 'delivery_charge', '100', '151', '2021-03-24', '3', '3', '1'),
(786, 42, 'coupon_code', NULL, '151', '2021-03-24', '3', '3', '1'),
(787, 42, 'coupon_taka', '0', '151', '2021-03-24', '3', '3', '1'),
(788, 42, 'attribute_parent', '3', '151', '2021-03-24', '3', '3', '1'),
(789, 42, 'user_district', 'Dhaka', '151', '2021-03-24', '3', '3', '1'),
(790, 42, 'user_city', 'Badda', '151', '2021-03-24', '3', '3', '1'),
(791, 42, 'user_zip', '1200', '151', '2021-03-24', '3', '3', '1'),
(792, 43, '_tax_class', '', '152', '2021-03-24', '3', '2', '1'),
(793, 43, '_qty', '0', '152', '2021-03-24', '3', '2', '1'),
(794, 43, '_product_id', '2', '152', '2021-03-24', '3', '2', '1'),
(795, 43, '_variation_id', '', '152', '2021-03-24', '3', '2', '1'),
(796, 43, 'order_actual_cost', '900', '152', '2021-03-24', '3', '2', '1'),
(797, 43, 'order_product_cost', '0', '152', '2021-03-24', '3', '2', '1'),
(798, 43, '_line_subtotal', '0', '152', '2021-03-24', '3', '2', '1'),
(799, 43, '_line_total', '0', '152', '2021-03-24', '3', '2', '1'),
(800, 43, '_line_subtotal_tax', '', '152', '2021-03-24', '3', '2', '1'),
(801, 43, '_line_tax', '', '152', '2021-03-24', '3', '2', '1'),
(802, 43, '_line_tax_data', '2021-03-24 23:29:37', '152', '2021-03-24', '3', '2', '1'),
(803, 43, 'delivery_charge', '200', '152', '2021-03-24', '3', '2', '1'),
(804, 43, 'coupon_code', NULL, '152', '2021-03-24', '3', '2', '1'),
(805, 43, 'coupon_taka', '0', '152', '2021-03-24', '3', '2', '1'),
(806, 43, 'attribute_parent', '2', '152', '2021-03-24', '3', '2', '1'),
(807, 43, 'user_district', 'Comilla', '152', '2021-03-24', '3', '2', '1'),
(808, 43, 'user_city', 'Laksham', '152', '2021-03-24', '3', '2', '1'),
(809, 43, 'user_zip', '1300', '152', '2021-03-24', '3', '2', '1'),
(810, 44, '_tax_class', '', '153', '2021-03-24', '3', '51', '49'),
(811, 44, '_qty', '1', '153', '2021-03-24', '3', '51', '49'),
(812, 44, '_product_id', '51', '153', '2021-03-24', '3', '51', '49'),
(813, 44, '_variation_id', '', '153', '2021-03-24', '3', '51', '49'),
(814, 44, 'order_actual_cost', '600', '153', '2021-03-24', '3', '51', '49'),
(815, 44, 'order_product_cost', '600', '153', '2021-03-24', '3', '51', '49'),
(816, 44, '_line_subtotal', '1000', '153', '2021-03-24', '3', '51', '49'),
(817, 44, '_line_total', '1000', '153', '2021-03-24', '3', '51', '49'),
(818, 44, '_line_subtotal_tax', '', '153', '2021-03-24', '3', '51', '49'),
(819, 44, '_line_tax', '', '153', '2021-03-24', '3', '51', '49'),
(820, 44, '_line_tax_data', '2021-03-24 23:58:42', '153', '2021-03-24', '3', '51', '49'),
(821, 44, 'delivery_charge', '100', '153', '2021-03-24', '3', '51', '49'),
(822, 44, 'coupon_code', NULL, '153', '2021-03-24', '3', '51', '49'),
(823, 44, 'coupon_taka', '0', '153', '2021-03-24', '3', '51', '49'),
(824, 44, 'attribute_parent', '51', '153', '2021-03-24', '3', '51', '49'),
(825, 44, 'user_district', 'Dhaka', '153', '2021-03-24', '3', '51', '49'),
(826, 44, 'user_city', 'Badda', '153', '2021-03-24', '3', '51', '49'),
(827, 44, 'user_zip', '1200', '153', '2021-03-24', '3', '51', '49'),
(828, 45, '_tax_class', '', '154', '2021-03-24', '3', '4', '1'),
(829, 45, '_qty', '1', '154', '2021-03-24', '3', '4', '1'),
(830, 45, '_product_id', '4', '154', '2021-03-24', '3', '4', '1'),
(831, 45, '_variation_id', '', '154', '2021-03-24', '3', '4', '1'),
(832, 45, 'order_actual_cost', '900', '154', '2021-03-24', '3', '4', '1'),
(833, 45, 'order_product_cost', '900', '154', '2021-03-24', '3', '4', '1'),
(834, 45, '_line_subtotal', '1000', '154', '2021-03-24', '3', '4', '1'),
(835, 45, '_line_total', '1000', '154', '2021-03-24', '3', '4', '1'),
(836, 45, '_line_subtotal_tax', '', '154', '2021-03-24', '3', '4', '1'),
(837, 45, '_line_tax', '', '154', '2021-03-24', '3', '4', '1'),
(838, 45, '_line_tax_data', '2021-03-24 23:59:06', '154', '2021-03-24', '3', '4', '1'),
(839, 45, 'delivery_charge', '200', '154', '2021-03-24', '3', '4', '1'),
(840, 45, 'coupon_code', NULL, '154', '2021-03-24', '3', '4', '1'),
(841, 45, 'coupon_taka', '0', '154', '2021-03-24', '3', '4', '1'),
(842, 45, 'attribute_parent', '4', '154', '2021-03-24', '3', '4', '1'),
(843, 45, 'user_district', 'Comilla', '154', '2021-03-24', '3', '4', '1'),
(844, 45, 'user_city', 'Laksham', '154', '2021-03-24', '3', '4', '1'),
(845, 45, 'user_zip', '1300', '154', '2021-03-24', '3', '4', '1'),
(846, 46, '_tax_class', '', '155', '2021-03-24', '3', '5', '5'),
(847, 46, '_qty', '0', '155', '2021-03-24', '3', '5', '5'),
(848, 46, '_product_id', '5', '155', '2021-03-24', '3', '5', '5'),
(849, 46, '_variation_id', '', '155', '2021-03-24', '3', '5', '5'),
(850, 46, 'order_actual_cost', '700', '155', '2021-03-24', '3', '5', '5'),
(851, 46, 'order_product_cost', '0', '155', '2021-03-24', '3', '5', '5'),
(852, 46, '_line_subtotal', '0', '155', '2021-03-24', '3', '5', '5'),
(853, 46, '_line_total', '0', '155', '2021-03-24', '3', '5', '5'),
(854, 46, '_line_subtotal_tax', '', '155', '2021-03-24', '3', '5', '5'),
(855, 46, '_line_tax', '', '155', '2021-03-24', '3', '5', '5'),
(856, 46, '_line_tax_data', '2021-03-24 23:59:32', '155', '2021-03-24', '3', '5', '5'),
(857, 46, 'delivery_charge', '175', '155', '2021-03-24', '3', '5', '5'),
(858, 46, 'coupon_code', NULL, '155', '2021-03-24', '3', '5', '5'),
(859, 46, 'coupon_taka', '0', '155', '2021-03-24', '3', '5', '5'),
(860, 46, 'attribute_parent', '5', '155', '2021-03-24', '3', '5', '5'),
(861, 46, 'user_district', 'chandpur', '155', '2021-03-24', '3', '5', '5'),
(862, 46, 'user_city', 'matlab', '155', '2021-03-24', '3', '5', '5'),
(863, 46, 'user_zip', '2300', '155', '2021-03-24', '3', '5', '5'),
(864, 46, 'cancel_quantity', '1', '155', '2021-03-24', '3', NULL, NULL),
(865, 41, 'cancel_quantity', '1', '151', '2021-03-24', '3', NULL, NULL),
(866, 42, 'cancel_quantity', '1', '151', '2021-03-24', '3', NULL, NULL),
(867, 47, '_tax_class', '', '158', '2021-03-25', '3', '28', '26'),
(868, 47, '_qty', '0', '158', '2021-03-25', '3', '28', '26'),
(869, 47, '_product_id', '28', '158', '2021-03-25', '3', '28', '26'),
(870, 47, '_variation_id', '', '158', '2021-03-25', '3', '28', '26'),
(871, 47, 'order_actual_cost', '700', '158', '2021-03-25', '3', '28', '26'),
(872, 47, 'order_product_cost', '0', '158', '2021-03-25', '3', '28', '26'),
(873, 47, '_line_subtotal', '0', '158', '2021-03-25', '3', '28', '26'),
(874, 47, '_line_total', '0', '158', '2021-03-25', '3', '28', '26'),
(875, 47, '_line_subtotal_tax', '', '158', '2021-03-25', '3', '28', '26'),
(876, 47, '_line_tax', '', '158', '2021-03-25', '3', '28', '26'),
(877, 47, '_line_tax_data', '2021-03-25 17:39:21', '158', '2021-03-25', '3', '28', '26'),
(878, 47, 'delivery_charge', '100', '158', '2021-03-25', '3', '28', '26'),
(879, 47, 'coupon_code', NULL, '158', '2021-03-25', '3', '28', '26'),
(880, 47, 'coupon_taka', '0', '158', '2021-03-25', '3', '28', '26'),
(881, 47, 'attribute_parent', '28', '158', '2021-03-25', '3', '28', '26'),
(882, 47, 'user_district', 'Dhaka', '158', '2021-03-25', '3', '28', '26'),
(883, 47, 'user_city', 'Badda', '158', '2021-03-25', '3', '28', '26'),
(884, 47, 'user_zip', '1200', '158', '2021-03-25', '3', '28', '26'),
(885, 47, 'cancel_quantity', '1', '158', '2021-03-25', '3', NULL, NULL),
(886, 43, 'cancel_quantity', '1', '152', '2021-03-24', '3', NULL, NULL),
(887, 43, 'cancel_quantity', '2', '152', '2021-03-24', '3', NULL, NULL),
(888, 43, 'cancel_quantity', '1', '152', '2021-03-24', '3', NULL, NULL),
(889, 19, 'cancel_quantity_attribute', '1', '128', NULL, NULL, NULL, NULL),
(890, 19, 'cancel_attribute_product', '50', '128', NULL, NULL, NULL, NULL),
(891, 48, '_tax_class', '', '179', '2021-04-04', '3', '51', '49'),
(892, 48, '_qty', '1', '179', '2021-04-04', '3', '51', '49'),
(893, 48, '_product_id', '51', '179', '2021-04-04', '3', '51', '49'),
(894, 48, '_variation_id', '', '179', '2021-04-04', '3', '51', '49'),
(895, 48, 'order_actual_cost', '600', '179', '2021-04-04', '3', '51', '49'),
(896, 48, 'order_product_cost', '600', '179', '2021-04-04', '3', '51', '49'),
(897, 48, '_line_subtotal', '1000', '179', '2021-04-04', '3', '51', '49'),
(898, 48, '_line_total', '1000', '179', '2021-04-04', '3', '51', '49'),
(899, 48, '_line_subtotal_tax', '', '179', '2021-04-04', '3', '51', '49'),
(900, 48, '_line_tax', '', '179', '2021-04-04', '3', '51', '49'),
(901, 48, '_line_tax_data', '2021-04-04 20:17:21', '179', '2021-04-04', '3', '51', '49'),
(902, 48, 'delivery_charge', '100', '179', '2021-04-04', '3', '51', '49'),
(903, 48, 'coupon_code', NULL, '179', '2021-04-04', '3', '51', '49'),
(904, 48, 'coupon_taka', '0', '179', '2021-04-04', '3', '51', '49'),
(905, 48, 'attribute_parent', '51', '179', '2021-04-04', '3', '51', '49'),
(906, 48, 'user_district', 'Dhaka', '179', '2021-04-04', '3', '51', '49'),
(907, 48, 'user_city', 'Badda', '179', '2021-04-04', '3', '51', '49'),
(908, 48, 'user_zip', '1200', '179', '2021-04-04', '3', '51', '49'),
(909, 49, '_tax_class', '', '179', '2021-04-04', '3', '50', '49'),
(910, 49, '_qty', '1', '179', '2021-04-04', '3', '50', '49'),
(911, 49, '_product_id', '50', '179', '2021-04-04', '3', '50', '49'),
(912, 49, '_variation_id', '', '179', '2021-04-04', '3', '50', '49'),
(913, 49, 'order_actual_cost', '600', '179', '2021-04-04', '3', '50', '49'),
(914, 49, 'order_product_cost', '600', '179', '2021-04-04', '3', '50', '49'),
(915, 49, '_line_subtotal', '1000', '179', '2021-04-04', '3', '50', '49'),
(916, 49, '_line_total', '1000', '179', '2021-04-04', '3', '50', '49'),
(917, 49, '_line_subtotal_tax', '', '179', '2021-04-04', '3', '50', '49'),
(918, 49, '_line_tax', '', '179', '2021-04-04', '3', '50', '49'),
(919, 49, '_line_tax_data', '2021-04-04 20:17:21', '179', '2021-04-04', '3', '50', '49'),
(920, 49, 'delivery_charge', '100', '179', '2021-04-04', '3', '50', '49'),
(921, 49, 'coupon_code', NULL, '179', '2021-04-04', '3', '50', '49'),
(922, 49, 'coupon_taka', '0', '179', '2021-04-04', '3', '50', '49'),
(923, 49, 'attribute_parent', '50', '179', '2021-04-04', '3', '50', '49'),
(924, 49, 'user_district', 'Dhaka', '179', '2021-04-04', '3', '50', '49'),
(925, 49, 'user_city', 'Badda', '179', '2021-04-04', '3', '50', '49'),
(926, 49, 'user_zip', '1200', '179', '2021-04-04', '3', '50', '49'),
(927, 50, '_tax_class', '', '180', '2021-04-04', '3', '46', '44'),
(928, 50, '_qty', '1', '180', '2021-04-04', '3', '46', '44'),
(929, 50, '_product_id', '46', '180', '2021-04-04', '3', '46', '44'),
(930, 50, '_variation_id', '', '180', '2021-04-04', '3', '46', '44'),
(931, 50, 'order_actual_cost', '900', '180', '2021-04-04', '3', '46', '44'),
(932, 50, 'order_product_cost', '900', '180', '2021-04-04', '3', '46', '44'),
(933, 50, '_line_subtotal', '1000', '180', '2021-04-04', '3', '46', '44'),
(934, 50, '_line_total', '1000', '180', '2021-04-04', '3', '46', '44'),
(935, 50, '_line_subtotal_tax', '', '180', '2021-04-04', '3', '46', '44'),
(936, 50, '_line_tax', '', '180', '2021-04-04', '3', '46', '44'),
(937, 50, '_line_tax_data', '2021-04-04 20:17:42', '180', '2021-04-04', '3', '46', '44'),
(938, 50, 'delivery_charge', '200', '180', '2021-04-04', '3', '46', '44'),
(939, 50, 'coupon_code', NULL, '180', '2021-04-04', '3', '46', '44'),
(940, 50, 'coupon_taka', '0', '180', '2021-04-04', '3', '46', '44'),
(941, 50, 'attribute_parent', '46', '180', '2021-04-04', '3', '46', '44'),
(942, 50, 'user_district', 'Comilla', '180', '2021-04-04', '3', '46', '44'),
(943, 50, 'user_city', 'Laksham', '180', '2021-04-04', '3', '46', '44'),
(944, 50, 'user_zip', '1300', '180', '2021-04-04', '3', '46', '44'),
(945, 51, '_tax_class', '', '184', '2021-04-04', '3', '50', '49'),
(946, 51, '_qty', '1', '184', '2021-04-04', '3', '50', '49'),
(947, 51, '_product_id', '50', '184', '2021-04-04', '3', '50', '49'),
(948, 51, '_variation_id', '', '184', '2021-04-04', '3', '50', '49'),
(949, 51, 'order_actual_cost', '600', '184', '2021-04-04', '3', '50', '49'),
(950, 51, 'order_product_cost', '600', '184', '2021-04-04', '3', '50', '49'),
(951, 51, '_line_subtotal', '1000', '184', '2021-04-04', '3', '50', '49'),
(952, 51, '_line_total', '1000', '184', '2021-04-04', '3', '50', '49'),
(953, 51, '_line_subtotal_tax', '', '184', '2021-04-04', '3', '50', '49'),
(954, 51, '_line_tax', '', '184', '2021-04-04', '3', '50', '49'),
(955, 51, '_line_tax_data', '2021-04-04 20:28:32', '184', '2021-04-04', '3', '50', '49'),
(956, 51, 'delivery_charge', '200', '184', '2021-04-04', '3', '50', '49'),
(957, 51, 'coupon_code', NULL, '184', '2021-04-04', '3', '50', '49'),
(958, 51, 'coupon_taka', '0', '184', '2021-04-04', '3', '50', '49'),
(959, 51, 'attribute_parent', '50', '184', '2021-04-04', '3', '50', '49'),
(960, 51, 'user_district', 'Comilla', '184', '2021-04-04', '3', '50', '49'),
(961, 51, 'user_city', 'Laksham', '184', '2021-04-04', '3', '50', '49'),
(962, 51, 'user_zip', '1300', '184', '2021-04-04', '3', '50', '49'),
(963, 52, '_tax_class', '', '187', '2021-04-04', '3', '50', '49'),
(964, 52, '_qty', '1', '187', '2021-04-04', '3', '50', '49'),
(965, 52, '_product_id', '50', '187', '2021-04-04', '3', '50', '49'),
(966, 52, '_variation_id', '', '187', '2021-04-04', '3', '50', '49'),
(967, 52, 'order_actual_cost', '600', '187', '2021-04-04', '3', '50', '49'),
(968, 52, 'order_product_cost', '600', '187', '2021-04-04', '3', '50', '49'),
(969, 52, '_line_subtotal', '1000', '187', '2021-04-04', '3', '50', '49'),
(970, 52, '_line_total', '1000', '187', '2021-04-04', '3', '50', '49'),
(971, 52, '_line_subtotal_tax', '', '187', '2021-04-04', '3', '50', '49'),
(972, 52, '_line_tax', '', '187', '2021-04-04', '3', '50', '49'),
(973, 52, '_line_tax_data', '2021-04-04 21:38:32', '187', '2021-04-04', '3', '50', '49'),
(974, 52, 'delivery_charge', '200', '187', '2021-04-04', '3', '50', '49'),
(975, 52, 'coupon_code', NULL, '187', '2021-04-04', '3', '50', '49'),
(976, 52, 'coupon_taka', '0', '187', '2021-04-04', '3', '50', '49'),
(977, 52, 'attribute_parent', '50', '187', '2021-04-04', '3', '50', '49'),
(978, 52, 'user_district', 'Comilla', '187', '2021-04-04', '3', '50', '49'),
(979, 52, 'user_city', 'Laksham', '187', '2021-04-04', '3', '50', '49'),
(980, 52, 'user_zip', '1300', '187', '2021-04-04', '3', '50', '49'),
(981, 53, '_tax_class', '', '188', '2021-04-04', '3', '28', '26'),
(982, 53, '_qty', '1', '188', '2021-04-04', '3', '28', '26'),
(983, 53, '_product_id', '28', '188', '2021-04-04', '3', '28', '26'),
(984, 53, '_variation_id', '', '188', '2021-04-04', '3', '28', '26'),
(985, 53, 'order_actual_cost', '700', '188', '2021-04-04', '3', '28', '26'),
(986, 53, 'order_product_cost', '700', '188', '2021-04-04', '3', '28', '26'),
(987, 53, '_line_subtotal', '1000', '188', '2021-04-04', '3', '28', '26'),
(988, 53, '_line_total', '1000', '188', '2021-04-04', '3', '28', '26'),
(989, 53, '_line_subtotal_tax', '', '188', '2021-04-04', '3', '28', '26'),
(990, 53, '_line_tax', '', '188', '2021-04-04', '3', '28', '26'),
(991, 53, '_line_tax_data', '2021-04-04 21:38:52', '188', '2021-04-04', '3', '28', '26'),
(992, 53, 'delivery_charge', '200', '188', '2021-04-04', '3', '28', '26'),
(993, 53, 'coupon_code', NULL, '188', '2021-04-04', '3', '28', '26'),
(994, 53, 'coupon_taka', '0', '188', '2021-04-04', '3', '28', '26'),
(995, 53, 'attribute_parent', '28', '188', '2021-04-04', '3', '28', '26'),
(996, 53, 'user_district', 'Comilla', '188', '2021-04-04', '3', '28', '26'),
(997, 53, 'user_city', 'Laksham', '188', '2021-04-04', '3', '28', '26'),
(998, 53, 'user_zip', '1300', '188', '2021-04-04', '3', '28', '26'),
(999, 54, '_tax_class', '', '192', '2021-04-04', '3', '51', '49'),
(1000, 54, '_qty', '1', '192', '2021-04-04', '3', '51', '49'),
(1001, 54, '_product_id', '51', '192', '2021-04-04', '3', '51', '49'),
(1002, 54, '_variation_id', '', '192', '2021-04-04', '3', '51', '49'),
(1003, 54, 'order_actual_cost', '600', '192', '2021-04-04', '3', '51', '49'),
(1004, 54, 'order_product_cost', '600', '192', '2021-04-04', '3', '51', '49'),
(1005, 54, '_line_subtotal', '1000', '192', '2021-04-04', '3', '51', '49'),
(1006, 54, '_line_total', '1000', '192', '2021-04-04', '3', '51', '49'),
(1007, 54, '_line_subtotal_tax', '', '192', '2021-04-04', '3', '51', '49'),
(1008, 54, '_line_tax', '', '192', '2021-04-04', '3', '51', '49'),
(1009, 54, '_line_tax_data', '2021-04-04 23:27:34', '192', '2021-04-04', '3', '51', '49'),
(1010, 54, 'delivery_charge', '200', '192', '2021-04-04', '3', '51', '49'),
(1011, 54, 'coupon_code', NULL, '192', '2021-04-04', '3', '51', '49'),
(1012, 54, 'coupon_taka', '0', '192', '2021-04-04', '3', '51', '49'),
(1013, 54, 'attribute_parent', '51', '192', '2021-04-04', '3', '51', '49'),
(1014, 54, 'user_district', 'Comilla', '192', '2021-04-04', '3', '51', '49'),
(1015, 54, 'user_city', 'Laksham', '192', '2021-04-04', '3', '51', '49'),
(1016, 54, 'user_zip', '1300', '192', '2021-04-04', '3', '51', '49'),
(1017, 55, '_tax_class', '', '193', '2021-04-04', '3', '39', '39'),
(1018, 55, '_qty', '1', '193', '2021-04-04', '3', '39', '39'),
(1019, 55, '_product_id', '39', '193', '2021-04-04', '3', '39', '39'),
(1020, 55, '_variation_id', '', '193', '2021-04-04', '3', '39', '39'),
(1021, 55, 'order_actual_cost', '800', '193', '2021-04-04', '3', '39', '39'),
(1022, 55, 'order_product_cost', '800', '193', '2021-04-04', '3', '39', '39'),
(1023, 55, '_line_subtotal', '1000', '193', '2021-04-04', '3', '39', '39'),
(1024, 55, '_line_total', '1000', '193', '2021-04-04', '3', '39', '39'),
(1025, 55, '_line_subtotal_tax', '', '193', '2021-04-04', '3', '39', '39'),
(1026, 55, '_line_tax', '', '193', '2021-04-04', '3', '39', '39'),
(1027, 55, '_line_tax_data', '2021-04-04 23:27:51', '193', '2021-04-04', '3', '39', '39'),
(1028, 55, 'delivery_charge', '200', '193', '2021-04-04', '3', '39', '39'),
(1029, 55, 'coupon_code', NULL, '193', '2021-04-04', '3', '39', '39'),
(1030, 55, 'coupon_taka', '0', '193', '2021-04-04', '3', '39', '39'),
(1031, 55, 'attribute_parent', '39', '193', '2021-04-04', '3', '39', '39'),
(1032, 55, 'user_district', 'Comilla', '193', '2021-04-04', '3', '39', '39'),
(1033, 55, 'user_city', 'Laksham', '193', '2021-04-04', '3', '39', '39'),
(1034, 55, 'user_zip', '1300', '193', '2021-04-04', '3', '39', '39'),
(1035, 56, '_tax_class', '', '194', '2021-04-04', '3', '3', '1'),
(1036, 56, '_qty', '1', '194', '2021-04-04', '3', '3', '1'),
(1037, 56, '_product_id', '3', '194', '2021-04-04', '3', '3', '1'),
(1038, 56, '_variation_id', '', '194', '2021-04-04', '3', '3', '1'),
(1039, 56, 'order_actual_cost', '900', '194', '2021-04-04', '3', '3', '1'),
(1040, 56, 'order_product_cost', '900', '194', '2021-04-04', '3', '3', '1'),
(1041, 56, '_line_subtotal', '1000', '194', '2021-04-04', '3', '3', '1'),
(1042, 56, '_line_total', '1000', '194', '2021-04-04', '3', '3', '1'),
(1043, 56, '_line_subtotal_tax', '', '194', '2021-04-04', '3', '3', '1'),
(1044, 56, '_line_tax', '', '194', '2021-04-04', '3', '3', '1'),
(1045, 56, '_line_tax_data', '2021-04-04 23:28:08', '194', '2021-04-04', '3', '3', '1'),
(1046, 56, 'delivery_charge', '175', '194', '2021-04-04', '3', '3', '1'),
(1047, 56, 'coupon_code', NULL, '194', '2021-04-04', '3', '3', '1'),
(1048, 56, 'coupon_taka', '0', '194', '2021-04-04', '3', '3', '1'),
(1049, 56, 'attribute_parent', '3', '194', '2021-04-04', '3', '3', '1'),
(1050, 56, 'user_district', 'chandpur', '194', '2021-04-04', '3', '3', '1'),
(1051, 56, 'user_city', 'matlab', '194', '2021-04-04', '3', '3', '1'),
(1052, 56, 'user_zip', '2300', '194', '2021-04-04', '3', '3', '1'),
(1053, 57, '_tax_class', '', '195', '2021-04-04', '3', '28', '26'),
(1054, 57, '_qty', '1', '195', '2021-04-04', '3', '28', '26'),
(1055, 57, '_product_id', '28', '195', '2021-04-04', '3', '28', '26'),
(1056, 57, '_variation_id', '', '195', '2021-04-04', '3', '28', '26'),
(1057, 57, 'order_actual_cost', '700', '195', '2021-04-04', '3', '28', '26'),
(1058, 57, 'order_product_cost', '700', '195', '2021-04-04', '3', '28', '26'),
(1059, 57, '_line_subtotal', '1000', '195', '2021-04-04', '3', '28', '26'),
(1060, 57, '_line_total', '1000', '195', '2021-04-04', '3', '28', '26'),
(1061, 57, '_line_subtotal_tax', '', '195', '2021-04-04', '3', '28', '26'),
(1062, 57, '_line_tax', '', '195', '2021-04-04', '3', '28', '26'),
(1063, 57, '_line_tax_data', '2021-04-04 23:28:27', '195', '2021-04-04', '3', '28', '26'),
(1064, 57, 'delivery_charge', '200', '195', '2021-04-04', '3', '28', '26'),
(1065, 57, 'coupon_code', NULL, '195', '2021-04-04', '3', '28', '26'),
(1066, 57, 'coupon_taka', '0', '195', '2021-04-04', '3', '28', '26'),
(1067, 57, 'attribute_parent', '28', '195', '2021-04-04', '3', '28', '26'),
(1068, 57, 'user_district', 'Comilla', '195', '2021-04-04', '3', '28', '26'),
(1069, 57, 'user_city', 'Laksham', '195', '2021-04-04', '3', '28', '26'),
(1070, 57, 'user_zip', '1300', '195', '2021-04-04', '3', '28', '26');

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
(1, 'Skirt', 'line-item', '45', 117, '44'),
(2, 'Dresses', 'line-item', '50', 117, '49'),
(3, 'Necklace', 'line-item', '5', 117, '5'),
(4, 'silk saree', 'line-item', '116', 118, '115'),
(5, 'Dresses', 'line-item', '51', 118, '49'),
(6, 'Skirt', 'line-item', '45', 118, '44'),
(7, 'Necklace', 'line-item', '5', 118, '5'),
(8, 'Necklace', 'line-item', '5', 119, '5'),
(9, 'Purse', 'line-item', '41', 119, '40'),
(10, 'Belt', 'line-item', '39', 119, '39'),
(11, 'Belt', 'line-item', '39', 120, '39'),
(12, 'Purse', 'line-item', '41', 120, '40'),
(13, 'Skirt', 'line-item', '47', 123, '44'),
(14, 'Necklace', 'line-item', '5', 123, '5'),
(15, 'Skirt', 'line-item', '45', 126, '44'),
(16, 'silk saree', 'line-item', '116', 126, '115'),
(17, 'Dresses', 'line-item', '50', 127, '49'),
(18, 'Belt', 'line-item', '39', 127, '39'),
(19, 'Dresses', 'line-item', '50', 128, '49'),
(20, 'Bag', 'line-item', '4', 129, '1'),
(21, 'Jeans', 'line-item', '9', 129, '6'),
(22, 'Tunic', 'line-item', '27', 130, '26'),
(23, 'Dresses', 'line-item', '50', 130, '49'),
(24, 'Necklace', 'line-item', '5', 130, '5'),
(25, 'Tunic', 'line-item', '27', 137, '26'),
(26, 'Necklace', 'line-item', '5', 137, '5'),
(27, 'Necklace', 'line-item', '5', 138, '5'),
(28, 'Skirt', 'line-item', '46', 138, '44'),
(29, 'Dresses', 'line-item', '51', 141, '49'),
(30, 'Skirt', 'line-item', '45', 141, '44'),
(31, 'Belt', 'line-item', '39', 141, '39'),
(32, 'Tunic', 'line-item', '27', 141, '26'),
(33, 'Necklace', 'line-item', '5', 142, '5'),
(34, 'Bag', 'line-item', '2', 143, '1'),
(35, 'Bag', 'line-item', '3', 143, '1'),
(36, 'Bag', 'line-item', '4', 143, '1'),
(37, 'Necklace', 'line-item', '5', 146, '5'),
(38, 'Dresses', 'line-item', '50', 147, '49'),
(39, 'Dresses', 'line-item', '50', 148, '49'),
(40, 'Belt', 'line-item', '39', 148, '39'),
(41, 'Dresses', 'line-item', '50', 151, '49'),
(42, 'Bag', 'line-item', '3', 151, '1'),
(43, 'Bag', 'line-item', '2', 152, '1'),
(44, 'Dresses', 'line-item', '51', 153, '49'),
(45, 'Bag', 'line-item', '4', 154, '1'),
(46, 'Necklace', 'line-item', '5', 155, '5'),
(47, 'Tunic', 'line-item', '28', 158, '26'),
(48, 'Dresses', 'line-item', '51', 179, '49'),
(49, 'Dresses', 'line-item', '50', 179, '49'),
(50, 'Skirt', 'line-item', '46', 180, '44'),
(51, 'Dresses', 'line-item', '50', 184, '49'),
(52, 'Dresses', 'line-item', '50', 187, '49'),
(53, 'Tunic', 'line-item', '28', 188, '26'),
(54, 'Dresses', 'line-item', '51', 192, '49'),
(55, 'Belt', 'line-item', '39', 193, '39'),
(56, 'Bag', 'line-item', '3', 194, '1'),
(57, 'Tunic', 'line-item', '28', 195, '26');

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
('hm.sohelrana95@gmail.com', '$2y$10$4pE.WW/O7mKL2UXr6babbeApI0AKDKFo7g4QxTKaAQ.aijFH7c90m', '2020-12-09 02:26:31');

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
(13, 1, 'gallery_file', 'Crossbody bag 2-2.jpg'),
(14, 1, 'gallery_file', 'Tote bag 2.jpg'),
(15, 1, 'gallery_file', 'Tote bag 3.jpg'),
(16, 1, 'gallery_file', 'Tote bag 4.jpg'),
(17, 2, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"}]'),
(18, 1, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"}]'),
(19, 2, 'attribute_stock', '100'),
(20, 2, 'attribute_low_stock', '1'),
(21, 2, 'att_status', '1'),
(22, 3, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"}]'),
(23, 1, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"}]'),
(24, 3, 'attribute_stock', '100'),
(25, 3, 'attribute_low_stock', '1'),
(26, 3, 'att_status', '1'),
(27, 4, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Blue\",\"term_id\":\"11\"}]'),
(28, 1, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Blue\",\"term_id\":\"11\"}]'),
(29, 4, 'attribute_stock', '99'),
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
(45, 5, 'gallery_file', 'Bracelet 1.jpg'),
(46, 5, 'gallery_file', 'Earring 1.jpg'),
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
(64, 6, 'gallery_file', 'leggings 1.jpg'),
(65, 6, 'gallery_file', 'leggings 1-2.jpg'),
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
(78, 9, 'attribute_stock', '9'),
(79, 9, 'attribute_low_stock', '10'),
(80, 9, 'att_status', '1'),
(81, 10, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"M\",\"term_id\":\"16\"}]'),
(82, 6, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"M\",\"term_id\":\"16\"}]'),
(83, 10, 'attribute_stock', '99'),
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
(344, 26, 'gallery_file', 'Tunic 2-2.jpg'),
(345, 26, 'gallery_file', 'Tunic 3.jpg'),
(346, 27, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"},{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(347, 26, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"},{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(348, 27, 'attribute_stock', '190'),
(349, 27, 'attribute_low_stock', '10'),
(350, 27, 'att_status', '1'),
(351, 28, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"},{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(352, 26, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"},{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(353, 28, 'attribute_stock', '195'),
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
(522, 40, 'stock_status', NULL),
(523, 40, 'regular_price', '0'),
(524, 40, 'sale_price', '1000'),
(525, 40, 'weight', NULL),
(526, 40, 'length', NULL),
(527, 40, 'width', NULL),
(528, 40, 'height', NULL),
(529, 40, 'product_stock', '700'),
(530, 40, 'start_stock', '700'),
(531, 40, '_sku', '702'),
(532, 40, 'attached_file', '1610454498.jpg'),
(533, 40, 'gallery_file', 'Crossbody bag 2-2.jpg'),
(534, 40, 'gallery_file', 'Purse 1.jpg'),
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
(566, 44, 'gallery_file', 'skirt 1-2.jpg'),
(567, 44, 'gallery_file', 'skirt 1-3.jpg'),
(568, 45, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(569, 44, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(570, 45, 'attribute_stock', '99'),
(571, 45, 'attribute_low_stock', '10'),
(572, 45, 'att_status', '1'),
(573, 46, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(574, 44, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(575, 46, 'attribute_stock', '96'),
(576, 46, 'attribute_low_stock', '10'),
(577, 46, 'att_status', '1'),
(578, 47, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"S\",\"term_id\":\"15\"}]'),
(579, 44, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"S\",\"term_id\":\"15\"}]'),
(580, 47, 'attribute_stock', '98'),
(581, 47, 'attribute_low_stock', '10'),
(582, 47, 'att_status', '1'),
(583, 48, 'attribute', '[{\"taxonomy\":\"size\",\"term\":\"M\",\"term_id\":\"16\"}]'),
(584, 44, 'default_attribute', '[{\"taxonomy\":\"size\",\"term\":\"M\",\"term_id\":\"16\"}]'),
(585, 48, 'attribute_stock', '100'),
(586, 48, 'attribute_low_stock', '10'),
(587, 48, 'att_status', '1'),
(588, 49, 'stock_status', NULL),
(589, 49, 'regular_price', '0'),
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
(602, 49, 'gallery_file', 'Dresses 3.jpg'),
(603, 49, 'gallery_file', 'Dresses 3-2.jpg'),
(604, 50, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"},{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(605, 49, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"},{\"taxonomy\":\"size\",\"term\":\"XL\",\"term_id\":\"13\"}]'),
(606, 50, 'attribute_stock', '79'),
(607, 50, 'attribute_low_stock', '10'),
(608, 50, 'att_status', '1'),
(609, 51, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"},{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(610, 49, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Black\",\"term_id\":\"10\"},{\"taxonomy\":\"size\",\"term\":\"X\",\"term_id\":\"14\"}]'),
(611, 51, 'attribute_stock', '97'),
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
(1254, 115, 'attached_file', '1616817290.jpg'),
(1255, 115, 'gallery_file', 'Jeans 2-2.jpg'),
(1256, 115, 'gallery_file', 'leggings 1.jpg'),
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
(1410, 129, 'payment_method', 'Cash On Delivery');
INSERT INTO `postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1411, 130, 'first_name', 'Elias'),
(1412, 130, 'last_name', 'Howlader'),
(1413, 130, 'address_one', 'Uttara,Dhaka'),
(1414, 130, 'address_two', NULL),
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
(1570, 151, 'first_name', 'Demo'),
(1571, 151, 'last_name', 'User'),
(1572, 151, 'address_one', 'Mirpur,Dhaka'),
(1573, 151, 'address_two', NULL),
(1574, 151, 'phone', '435435'),
(1575, 151, 'email', 'demo@email.com'),
(1576, 151, 'country', 'Bangladesh'),
(1577, 151, 'state', 'Dhaka'),
(1578, 151, 'city', 'Badda'),
(1579, 151, 'zip', '1200'),
(1580, 151, '_customer_user', '3'),
(1581, 151, '_billing_postcode', '1200'),
(1582, 151, '_billing_company', NULL),
(1583, 151, '_billing_last_name', NULL),
(1584, 151, '_billing_first_name', NULL),
(1585, 151, 'payment_method', 'DeliveryChargeOnly'),
(1586, 152, 'first_name', 'Demo'),
(1587, 152, 'last_name', 'User'),
(1588, 152, 'address_one', 'Mirpur,Dhaka435345345'),
(1589, 152, 'address_two', NULL),
(1590, 152, 'phone', '435435'),
(1591, 152, 'email', 'demo@email.com'),
(1592, 152, 'country', 'Bangladesh'),
(1593, 152, 'state', 'Comilla'),
(1594, 152, 'city', 'Laksham'),
(1595, 152, 'zip', '1300'),
(1596, 152, '_customer_user', '3'),
(1597, 152, '_billing_postcode', '1300'),
(1598, 152, '_billing_company', NULL),
(1599, 152, '_billing_last_name', NULL),
(1600, 152, '_billing_first_name', NULL),
(1601, 152, 'payment_method', 'Cash On Delivery'),
(1602, 153, 'first_name', 'Demo'),
(1603, 153, 'last_name', 'User'),
(1604, 153, 'address_one', 'Mirpur,Dhaka'),
(1605, 153, 'address_two', NULL),
(1606, 153, 'phone', '435435'),
(1607, 153, 'email', 'demo@email.com'),
(1608, 153, 'country', 'Bangladesh'),
(1609, 153, 'state', 'Dhaka'),
(1610, 153, 'city', 'Badda'),
(1611, 153, 'zip', '1200'),
(1612, 153, '_customer_user', '3'),
(1613, 153, '_billing_postcode', '1200'),
(1614, 153, '_billing_company', NULL),
(1615, 153, '_billing_last_name', NULL),
(1616, 153, '_billing_first_name', NULL),
(1617, 153, 'payment_method', 'Cash On Delivery'),
(1618, 154, 'first_name', 'Demo'),
(1619, 154, 'last_name', 'User'),
(1620, 154, 'address_one', 'Mirpur,Dhaka'),
(1621, 154, 'address_two', NULL),
(1622, 154, 'phone', '435435'),
(1623, 154, 'email', 'demo@email.com'),
(1624, 154, 'country', 'Bangladesh'),
(1625, 154, 'state', 'Comilla'),
(1626, 154, 'city', 'Laksham'),
(1627, 154, 'zip', '1300'),
(1628, 154, '_customer_user', '3'),
(1629, 154, '_billing_postcode', '1300'),
(1630, 154, '_billing_company', NULL),
(1631, 154, '_billing_last_name', NULL),
(1632, 154, '_billing_first_name', NULL),
(1633, 154, 'payment_method', 'Cash On Delivery'),
(1634, 155, 'first_name', 'Demo'),
(1635, 155, 'last_name', 'User'),
(1636, 155, 'address_one', 'Mirpur,Dhaka'),
(1637, 155, 'address_two', NULL),
(1638, 155, 'phone', '435435'),
(1639, 155, 'email', 'demo@email.com'),
(1640, 155, 'country', 'Bangladesh'),
(1641, 155, 'state', 'chandpur'),
(1642, 155, 'city', 'matlab'),
(1643, 155, 'zip', '2300'),
(1644, 155, '_customer_user', '3'),
(1645, 155, '_billing_postcode', '2300'),
(1646, 155, '_billing_company', NULL),
(1647, 155, '_billing_last_name', NULL),
(1648, 155, '_billing_first_name', NULL),
(1649, 155, 'payment_method', 'Cash On Delivery'),
(1650, 155, 'processing_date', '2021-03-25'),
(1651, 158, 'first_name', 'Demo'),
(1652, 158, 'last_name', 'User'),
(1653, 158, 'address_one', 'Mirpur,Dhaka'),
(1654, 158, 'address_two', NULL),
(1655, 158, 'phone', '435435'),
(1656, 158, 'email', 'demo@email.com'),
(1657, 158, 'country', 'Bangladesh'),
(1658, 158, 'state', 'Dhaka'),
(1659, 158, 'city', 'Badda'),
(1660, 158, 'zip', '1200'),
(1661, 158, '_customer_user', '3'),
(1662, 158, '_billing_postcode', '1200'),
(1663, 158, '_billing_company', NULL),
(1664, 158, '_billing_last_name', NULL),
(1665, 158, '_billing_first_name', NULL),
(1666, 158, 'payment_method', 'Cash On Delivery'),
(1667, 154, 'processing_date', '2021-03-25'),
(1668, 153, 'processing_date', '2021-03-25'),
(1669, 151, 'processing_date', '2021-03-25'),
(1670, 148, 'processing_date', '2021-03-27'),
(1671, 147, 'processing_date', '2021-03-27'),
(1672, 146, 'processing_date', '2021-03-27'),
(1673, 142, 'processing_date', '2021-03-27'),
(1674, 137, 'processing_date', '2021-03-27'),
(1675, 171, 'stock_status', 'instock'),
(1676, 171, 'regular_price', '0'),
(1677, 171, 'sale_price', '3000'),
(1678, 171, 'weight', NULL),
(1679, 171, 'length', NULL),
(1680, 171, 'width', NULL),
(1681, 171, 'height', NULL),
(1682, 171, 'product_stock', '1000'),
(1683, 171, 'start_stock', '1000'),
(1684, 171, 'default_qty', '100'),
(1685, 171, 'alert_qty', '20'),
(1686, 171, '_sku', '661'),
(1687, 171, 'attached_file', '1616817236.jpg'),
(1688, 171, 'gallery_file', '1612154372.jpg'),
(1689, 172, 'stock_status', NULL),
(1690, 172, 'regular_price', '5000'),
(1691, 172, 'sale_price', '3000'),
(1692, 172, 'weight', NULL),
(1693, 172, 'length', NULL),
(1694, 172, 'width', NULL),
(1695, 172, 'height', NULL),
(1696, 172, 'product_stock', '1000'),
(1697, 172, 'start_stock', '1000'),
(1698, 172, '_sku', '838'),
(1699, 172, 'attached_file', '1616821341.jpg'),
(1700, 172, 'gallery_file', '1612154372.jpg'),
(1701, 173, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"}]'),
(1702, 172, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"}]'),
(1703, 173, 'attribute_stock', '130'),
(1704, 173, 'attribute_low_stock', '20'),
(1705, 173, 'att_status', '1'),
(1706, 174, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Blue\",\"term_id\":\"11\"}]'),
(1707, 172, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Blue\",\"term_id\":\"11\"}]'),
(1708, 174, 'attribute_stock', '130'),
(1709, 174, 'attribute_low_stock', '20'),
(1710, 174, 'att_status', '1'),
(1711, 175, 'stock_status', 'instock'),
(1712, 175, 'regular_price', '5000'),
(1713, 175, 'sale_price', '3000'),
(1714, 175, 'weight', NULL),
(1715, 175, 'length', NULL),
(1716, 175, 'width', NULL),
(1717, 175, 'height', NULL),
(1718, 175, 'product_stock', '1000'),
(1719, 175, 'start_stock', '1000'),
(1720, 175, 'default_qty', '100'),
(1721, 175, 'alert_qty', '0'),
(1722, 175, '_sku', '129'),
(1723, 175, 'attached_file', '1616825389.jpg'),
(1724, 175, 'gallery_file', 'p.jpg'),
(1725, 176, 'stock_status', NULL),
(1726, 176, 'regular_price', '5000'),
(1727, 176, 'sale_price', '3000'),
(1728, 176, 'weight', NULL),
(1729, 176, 'length', NULL),
(1730, 176, 'width', NULL),
(1731, 176, 'height', NULL),
(1732, 176, 'product_stock', '1000'),
(1733, 176, 'start_stock', '1000'),
(1734, 176, '_sku', '543'),
(1735, 176, 'attached_file', '1616825484.jpg'),
(1736, 176, 'gallery_file', 'p.jpg'),
(1737, 177, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"}]'),
(1738, 176, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Red\",\"term_id\":\"9\"}]'),
(1739, 177, 'attribute_stock', '100'),
(1740, 177, 'attribute_low_stock', '40'),
(1741, 177, 'att_status', '1'),
(1742, 178, 'attribute', '[{\"taxonomy\":\"color\",\"term\":\"Blue\",\"term_id\":\"11\"}]'),
(1743, 176, 'default_attribute', '[{\"taxonomy\":\"color\",\"term\":\"Blue\",\"term_id\":\"11\"}]'),
(1744, 178, 'attribute_stock', '100'),
(1745, 178, 'attribute_low_stock', '40'),
(1746, 178, 'att_status', '1'),
(1747, 179, 'first_name', 'Demo'),
(1748, 179, 'last_name', 'User'),
(1749, 179, 'address_one', 'Mirpur,Dhaka'),
(1750, 179, 'address_two', NULL),
(1751, 179, 'phone', '435435'),
(1752, 179, 'email', 'demo@email.com'),
(1753, 179, 'country', 'Bangladesh'),
(1754, 179, 'state', 'Dhaka'),
(1755, 179, 'city', 'Badda'),
(1756, 179, 'zip', '1200'),
(1757, 179, '_customer_user', '3'),
(1758, 179, '_billing_postcode', '1200'),
(1759, 179, '_billing_company', NULL),
(1760, 179, '_billing_last_name', NULL),
(1761, 179, '_billing_first_name', NULL),
(1762, 179, 'payment_method', 'Cash On Delivery'),
(1763, 180, 'first_name', 'Demo'),
(1764, 180, 'last_name', 'User'),
(1765, 180, 'address_one', 'Mirpur,Dhaka'),
(1766, 180, 'address_two', NULL),
(1767, 180, 'phone', '435435'),
(1768, 180, 'email', 'demo@email.com'),
(1769, 180, 'country', 'Bangladesh'),
(1770, 180, 'state', 'Comilla'),
(1771, 180, 'city', 'Laksham'),
(1772, 180, 'zip', '1300'),
(1773, 180, '_customer_user', '3'),
(1774, 180, '_billing_postcode', '1300'),
(1775, 180, '_billing_company', NULL),
(1776, 180, '_billing_last_name', NULL),
(1777, 180, '_billing_first_name', NULL),
(1778, 180, 'payment_method', 'Cash On Delivery'),
(1779, 180, 'processing_date', '2021-04-04'),
(1780, 179, 'processing_date', '2021-04-04'),
(1781, 184, 'first_name', 'Demo'),
(1782, 184, 'last_name', 'User'),
(1783, 184, 'address_one', 'Mirpur,Dhaka'),
(1784, 184, 'address_two', NULL),
(1785, 184, 'phone', '435435'),
(1786, 184, 'email', 'demo@email.com'),
(1787, 184, 'country', 'Bangladesh'),
(1788, 184, 'state', 'Comilla'),
(1789, 184, 'city', 'Laksham'),
(1790, 184, 'zip', '1300'),
(1791, 184, '_customer_user', '3'),
(1792, 184, '_billing_postcode', '1300'),
(1793, 184, '_billing_company', NULL),
(1794, 184, '_billing_last_name', NULL),
(1795, 184, '_billing_first_name', NULL),
(1796, 184, 'payment_method', 'Cash On Delivery'),
(1797, 184, 'processing_date', '2021-04-04'),
(1798, 187, 'first_name', 'Demo'),
(1799, 187, 'last_name', 'User'),
(1800, 187, 'address_one', 'Mirpur,Dhaka'),
(1801, 187, 'address_two', NULL),
(1802, 187, 'phone', '435435'),
(1803, 187, 'email', 'demo@email.com'),
(1804, 187, 'country', 'Bangladesh'),
(1805, 187, 'state', 'Comilla'),
(1806, 187, 'city', 'Laksham'),
(1807, 187, 'zip', '1300'),
(1808, 187, '_customer_user', '3'),
(1809, 187, '_billing_postcode', '1300'),
(1810, 187, '_billing_company', NULL),
(1811, 187, '_billing_last_name', NULL),
(1812, 187, '_billing_first_name', NULL),
(1813, 187, 'payment_method', 'Cash On Delivery'),
(1814, 188, 'first_name', 'Demo'),
(1815, 188, 'last_name', 'User'),
(1816, 188, 'address_one', 'Mirpur,Dhaka'),
(1817, 188, 'address_two', NULL),
(1818, 188, 'phone', '435435'),
(1819, 188, 'email', 'demo@email.com'),
(1820, 188, 'country', 'Bangladesh'),
(1821, 188, 'state', 'Comilla'),
(1822, 188, 'city', 'Laksham'),
(1823, 188, 'zip', '1300'),
(1824, 188, '_customer_user', '3'),
(1825, 188, '_billing_postcode', '1300'),
(1826, 188, '_billing_company', NULL),
(1827, 188, '_billing_last_name', NULL),
(1828, 188, '_billing_first_name', NULL),
(1829, 188, 'payment_method', 'Cash On Delivery'),
(1830, 188, 'processing_date', '2021-04-04'),
(1831, 187, 'processing_date', '2021-04-04'),
(1832, 192, 'first_name', 'Demo'),
(1833, 192, 'last_name', 'User'),
(1834, 192, 'address_one', 'Mirpur,Dhaka'),
(1835, 192, 'address_two', NULL),
(1836, 192, 'phone', '435435'),
(1837, 192, 'email', 'demo@email.com'),
(1838, 192, 'country', 'Bangladesh'),
(1839, 192, 'state', 'Comilla'),
(1840, 192, 'city', 'Laksham'),
(1841, 192, 'zip', '1300'),
(1842, 192, '_customer_user', '3'),
(1843, 192, '_billing_postcode', '1300'),
(1844, 192, '_billing_company', NULL),
(1845, 192, '_billing_last_name', NULL),
(1846, 192, '_billing_first_name', NULL),
(1847, 192, 'payment_method', 'Cash On Delivery'),
(1848, 193, 'first_name', 'Demo'),
(1849, 193, 'last_name', 'User'),
(1850, 193, 'address_one', 'Mirpur,Dhaka'),
(1851, 193, 'address_two', NULL),
(1852, 193, 'phone', '435435'),
(1853, 193, 'email', 'demo@email.com'),
(1854, 193, 'country', 'Bangladesh'),
(1855, 193, 'state', 'Comilla'),
(1856, 193, 'city', 'Laksham'),
(1857, 193, 'zip', '1300'),
(1858, 193, '_customer_user', '3'),
(1859, 193, '_billing_postcode', '1300'),
(1860, 193, '_billing_company', NULL),
(1861, 193, '_billing_last_name', NULL),
(1862, 193, '_billing_first_name', NULL),
(1863, 193, 'payment_method', 'Cash On Delivery'),
(1864, 194, 'first_name', 'Demo'),
(1865, 194, 'last_name', 'User'),
(1866, 194, 'address_one', 'Mirpur,Dhaka'),
(1867, 194, 'address_two', NULL),
(1868, 194, 'phone', '435435'),
(1869, 194, 'email', 'demo@email.com'),
(1870, 194, 'country', 'Bangladesh'),
(1871, 194, 'state', 'chandpur'),
(1872, 194, 'city', 'matlab'),
(1873, 194, 'zip', '2300'),
(1874, 194, '_customer_user', '3'),
(1875, 194, '_billing_postcode', '2300'),
(1876, 194, '_billing_company', NULL),
(1877, 194, '_billing_last_name', NULL),
(1878, 194, '_billing_first_name', NULL),
(1879, 194, 'payment_method', 'Cash On Delivery'),
(1880, 195, 'first_name', 'Demo'),
(1881, 195, 'last_name', 'User'),
(1882, 195, 'address_one', 'Mirpur,Dhaka'),
(1883, 195, 'address_two', NULL),
(1884, 195, 'phone', '435435'),
(1885, 195, 'email', 'demo@email.com'),
(1886, 195, 'country', 'Bangladesh'),
(1887, 195, 'state', 'Comilla'),
(1888, 195, 'city', 'Laksham'),
(1889, 195, 'zip', '1300'),
(1890, 195, '_customer_user', '3'),
(1891, 195, '_billing_postcode', '1300'),
(1892, 195, '_billing_company', NULL),
(1893, 195, '_billing_last_name', NULL),
(1894, 195, '_billing_first_name', NULL),
(1895, 195, 'payment_method', 'Cash On Delivery'),
(1896, 195, 'processing_date', '2021-04-04'),
(1897, 194, 'processing_date', '2021-04-04'),
(1898, 193, 'processing_date', '2021-04-04'),
(1899, 192, 'processing_date', '2021-04-04');

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
(1, 2, '2021-01-18 13:43:00', '2021-01-18 19:43:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'Bag', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'publish', 'open', 'open', '', 'Bag', '', '', '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', 0, '', 0, 'product', '', 0),
(2, 2, '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', 1, '', 0, 'product_varient', '', 0),
(3, 2, '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', 1, '', 0, 'product_varient', '', 0),
(4, 2, '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:45:03', '2021-01-12 15:45:03', '', 1, '', 0, 'product_varient', '', 0),
(5, 2, '2021-03-27 13:45:00', '2021-03-27 19:45:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'Necklace', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'publish', 'open', 'open', '', 'Necklace', '', '', '2021-01-12 15:46:18', '2021-01-12 15:46:18', '', 0, '', 0, 'product', '', 0),
(6, 2, '2021-01-12 13:46:00', '2021-01-12 19:46:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'Jeans', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>', 'publish', 'open', 'open', '', 'Jeans', '', '', '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', 0, '', 0, 'product', '', 0),
(7, 2, '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', 6, '', 0, 'product_varient', '', 0),
(8, 2, '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', 6, '', 0, 'product_varient', '', 0),
(9, 2, '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', 6, '', 0, 'product_varient', '', 0),
(10, 2, '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 15:47:56', '2021-01-12 15:47:56', '', 6, '', 0, 'product_varient', '', 0),
(39, 2, '2021-03-20 00:00:00', '2021-03-20 06:00:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Belt', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'publish', 'open', 'open', '', 'Belt', '', '', '2021-01-12 20:26:16', '2021-01-12 20:26:16', '', 0, '', 0, 'product', '', 0),
(38, 2, '2021-01-12 17:30:00', '2021-01-12 23:30:00', 'Banner Image', 'Banner Image', 'Banner Image', 'publish', 'open', 'open', '', 'Banner Image', '', '', '2021-01-12 19:30:01', '2021-01-12 19:30:01', '', 0, '', 0, 'banner', '', 0),
(26, 2, '2021-03-27 16:08:00', '2021-03-27 22:08:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Tunic', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'publish', 'open', 'open', '', 'Tunic', '', '', '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', 0, '', 0, 'product', '', 0),
(27, 2, '2021-03-20 00:00:00', '2021-01-12 18:11:53', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', 26, '', 0, 'product_varient', '', 0),
(28, 2, '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', 26, '', 0, 'product_varient', '', 0),
(29, 2, '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 18:11:53', '2021-01-12 18:11:53', '', 26, '', 0, 'product_varient', '', 0),
(40, 2, '2021-03-27 18:26:00', '2021-03-28 00:26:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Purse', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'publish', 'open', 'open', '', 'Purse', '', '', '2021-01-12 20:28:18', '2021-01-12 20:28:18', '', 0, '', 0, 'product', '', 0),
(41, 2, '2021-03-27 18:26:00', '2021-03-28 00:26:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Purse', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'unpublish', 'open', 'open', '', 'Purse', '', '', '2021-01-12 20:28:18', '2021-01-12 20:28:18', '', 40, '', 0, 'product_varient', '', 0),
(42, 2, '2021-03-27 18:26:00', '2021-03-28 00:26:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Purse', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'unpublish', 'open', 'open', '', 'Purse', '', '', '2021-01-12 20:28:18', '2021-01-12 20:28:18', '', 40, '', 0, 'product_varient', '', 0),
(43, 2, '2021-03-27 18:26:00', '2021-03-28 00:26:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Purse', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'unpublish', 'open', 'open', '', 'Purse', '', '', '2021-01-12 20:28:18', '2021-01-12 20:28:18', '', 40, '', 0, 'product_varient', '', 0),
(44, 2, '2021-01-12 18:28:00', '2021-01-13 00:28:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Skirt', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'publish', 'open', 'open', '', 'Skirt', '', '', '2021-01-12 20:30:16', '2021-01-12 20:30:16', '', 0, '', 0, 'product', '', 0),
(45, 2, '2021-01-12 18:30:16', '2021-01-12 20:30:16', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:30:16', '2021-01-12 20:30:16', '', 44, '', 0, 'product_varient', '', 0),
(46, 2, '2021-01-12 18:30:16', '2021-01-12 20:30:16', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:30:16', '2021-01-12 20:30:16', '', 44, '', 0, 'product_varient', '', 0),
(47, 2, '2021-01-12 18:30:16', '2021-01-12 20:30:16', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:30:16', '2021-01-12 20:30:16', '', 44, '', 0, 'product_varient', '', 0),
(48, 2, '2021-01-12 18:30:16', '2021-01-12 20:30:16', '', '', '', 'publish', 'open', 'open', '', '', '', '', '2021-01-12 20:30:16', '2021-01-12 20:30:16', '', 44, '', 0, 'product_varient', '', 0),
(49, 2, '2021-03-27 18:30:00', '2021-03-28 00:30:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Dresses', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'publish', 'open', 'open', '', 'Dresses', '', '', '2021-01-12 20:32:13', '2021-01-12 20:32:13', '', 0, '', 0, 'product', '', 0),
(50, 2, '2021-03-27 18:30:00', '2021-03-28 00:30:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Dresses', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'unpublish', 'open', 'open', '', 'Dresses', '', '', '2021-01-12 20:32:13', '2021-01-12 20:32:13', '', 49, '', 0, 'product_varient', '', 0),
(51, 2, '2021-03-27 18:30:00', '2021-03-28 00:30:00', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'Dresses', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>', 'unpublish', 'open', 'open', '', 'Dresses', '', '', '2021-01-12 20:32:13', '2021-01-12 20:32:13', '', 49, '', 0, 'product_varient', '', 0),
(87, 5, '2021-03-18 18:11:17', '2021-03-18 18:11:17', 'asdfdsfds', 'Big Problem', '', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 18:11:17', '2021-03-18 18:11:17', '', 0, '', 0, 'genarel_quiry', '', 0),
(86, 4, '2021-03-18 17:55:17', '2021-03-18 17:55:17', 'kono rply nai keno??', 'Query', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 17:55:17', '2021-03-18 17:55:17', '', 0, '', 0, 'genarel_quiry', '', 0),
(85, 1, '2021-03-18 17:53:09', '2021-03-18 17:53:09', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'ddd', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 17:53:09', '2021-03-18 17:53:09', '', 0, '', 0, 'genarel_quiry', '', 0),
(84, 4, '2021-03-18 17:51:27', '2021-03-18 17:51:27', 'hello boss', 'question', 'jksdjalkjf', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 17:51:27', '2021-03-18 17:51:27', '', 0, '', 0, 'genarel_quiry', '', 0),
(132, 2, '2021-03-21 11:49:19', '2021-03-21 17:49:19', '', '126', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-21 11:49:19', '2021-03-21 13:49:19', 'Mrpeon', 131, '', 0, 'invoice_order', '', 0),
(131, 2, '2021-03-21 11:49:19', '2021-03-21 17:49:19', '126,130', 'invoice', '', 'publish', 'open', 'open', '', 'inv-11', '', '', '2021-03-21 11:49:19', '2021-03-21 13:49:19', 'Mrpeon', 0, '', 0, 'invoice', '', 0),
(123, 1, '2021-03-20 00:00:00', '2021-03-20 23:43:22', '', 'Order2021-03-20 17:43:22', '', 'cancelled', 'open', 'open', 'order_1247', 'order-5', '', '', '2021-03-20 17:48:44', '2021-03-20 19:43:22', 'ddd', 0, '', 0, 'shop_order', '', 0),
(124, 2, '2021-03-20 17:45:27', '2021-03-20 23:45:27', '123', 'invoice', '', 'publish', 'open', 'open', '', 'inv-10', '', '', '2021-03-20 17:45:27', '2021-03-20 19:45:27', 'ddd', 0, '', 0, 'invoice', '', 0),
(77, 2, '2021-03-18 15:26:43', '2021-03-18 21:26:43', '72,73', 'invoice', '', 'publish', 'open', 'open', '', 'inv-2', '', '', '2021-03-18 15:26:43', '2021-03-18 17:26:43', 'bigshot', 0, '', 0, 'invoice', '', 0),
(133, 2, '2021-03-21 11:49:19', '2021-03-21 17:49:19', '', '130', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-21 11:49:19', '2021-03-21 13:49:19', 'Mrpeon', 131, '', 0, 'invoice_order', '', 0),
(62, 2, '2021-01-15 03:43:18', '2021-01-15 09:43:18', '58,59', 'invoice', '', 'publish', 'open', 'open', '', 'inv-1', '', '', '2021-01-15 03:43:18', '2021-01-15 05:43:18', 'Mrpeon', 0, '', 0, 'invoice', '', 0),
(63, 2, '2021-01-15 03:43:18', '2021-01-15 09:43:18', '', '58', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-01-15 03:43:18', '2021-01-15 05:43:18', 'Mrpeon', 62, '', 0, 'invoice_order', '', 0),
(64, 2, '2021-01-15 03:43:18', '2021-01-15 09:43:18', '', '59', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-01-15 03:43:18', '2021-01-15 05:43:18', 'Mrpeon', 62, '', 0, 'invoice_order', '', 0),
(83, 2, '2021-03-18 15:48:42', '2021-03-18 21:48:42', '', '76', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 15:48:42', '2021-03-18 17:48:42', 'tye', 82, '', 0, 'invoice_order', '', 0),
(82, 2, '2021-03-18 15:48:42', '2021-03-18 21:48:42', '76', 'invoice', '', 'publish', 'open', 'open', '', 'inv-3', '', '', '2021-03-18 15:48:42', '2021-03-18 17:48:42', 'tye', 0, '', 0, 'invoice', '', 0),
(129, 2, '2021-03-21 00:00:00', '2021-03-21 17:23:12', '', 'Order2021-03-21 11:23:12', '', 'on-hold', 'open', 'open', 'order_1247', 'order-1', '', '', '2021-03-21 13:23:12', '2021-03-21 13:23:12', '', 0, '', 0, 'shop_order', '', 0),
(79, 2, '2021-03-18 15:26:43', '2021-03-18 21:26:43', '', '73', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 15:26:43', '2021-03-18 17:26:43', 'bigshot', 77, '', 0, 'invoice_order', '', 0),
(130, 2, '2021-03-21 00:00:00', '2021-03-21 17:34:26', '', 'Order2021-03-21 11:34:26', '', 'delivered', 'open', 'open', 'order_1247', 'order-2', '', '', '2021-03-21 14:22:37', '2021-03-21 13:34:26', 'Mrpeon', 0, '', 0, 'shop_order', '', 0),
(78, 2, '2021-03-18 15:26:43', '2021-03-18 21:26:43', '', '72', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 15:26:43', '2021-03-18 17:26:43', 'bigshot', 77, '', 0, 'invoice_order', '', 0),
(89, 4, '2021-03-18 18:36:58', '2021-03-18 18:36:58', 'hello boss , why??', 'Query', 'Lorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industry', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 18:36:58', '2021-03-18 18:36:58', '', 0, '', 0, 'genarel_quiry', '', 0),
(120, 1, '2021-03-20 00:00:00', '2021-03-20 23:25:02', '', 'Order2021-03-20 17:25:02', '', 'delivered', 'open', 'open', 'order_1247', 'order-4', '', '', '2021-03-25 13:31:31', '2021-03-20 19:25:02', 'mrpeon', 0, '', 0, 'shop_order', '', 0),
(126, 1, '2021-03-20 00:00:00', '2021-03-20 23:50:49', '', 'Order2021-03-20 17:50:49', '', 'delivered', 'open', 'open', 'order_1247', 'order-6', '', '', '2021-03-21 14:22:25', '2021-03-20 19:50:49', 'Mrpeon', 0, '', 0, 'shop_order', '', 0),
(122, 2, '2021-03-20 17:42:52', '2021-03-20 23:42:52', '', '119', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-20 17:42:52', '2021-03-20 19:42:52', 'sss', 121, '', 0, 'invoice_order', '', 0),
(92, 2, '2021-03-18 16:55:42', '2021-03-18 22:55:42', '91', 'invoice', '', 'publish', 'open', 'open', '', 'inv-4', '', '', '2021-03-18 16:55:42', '2021-03-18 18:55:42', 'itebd', 0, '', 0, 'invoice', '', 0),
(93, 2, '2021-03-18 16:55:42', '2021-03-18 22:55:42', '', '91', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 16:55:42', '2021-03-18 18:55:42', 'itebd', 92, '', 0, 'invoice_order', '', 0),
(121, 2, '2021-03-20 17:42:52', '2021-03-20 23:42:52', '119', 'invoice', '', 'publish', 'open', 'open', '', 'inv-9', '', '', '2021-03-20 17:42:52', '2021-03-20 19:42:52', 'sss', 0, '', 0, 'invoice', '', 0),
(95, 2, '2021-03-18 17:35:10', '2021-03-18 23:35:10', '90', 'invoice', '', 'publish', 'open', 'open', '', 'inv-5', '', '', '2021-03-18 17:35:10', '2021-03-18 19:35:10', 'dhl', 0, '', 0, 'invoice', '', 0),
(96, 2, '2021-03-18 17:35:10', '2021-03-18 23:35:10', '', '90', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 17:35:10', '2021-03-18 19:35:10', 'dhl', 95, '', 0, 'invoice_order', '', 0),
(127, 1, '2021-03-20 00:00:00', '2021-03-20 23:51:21', '', 'Order2021-03-20 17:51:21', '', 'dispatch', 'open', 'open', 'order_1247', 'order-7', '', '', '2021-03-21 11:58:09', '2021-03-20 19:51:21', 'mrpeon', 0, '', 0, 'shop_order', '', 0),
(98, 2, '2021-03-18 17:49:12', '2021-03-18 23:49:12', '88,94,97', 'invoice', '', 'publish', 'open', 'open', '', 'inv-6', '', '', '2021-03-18 17:49:12', '2021-03-18 19:49:12', 'bigshot', 0, '', 0, 'invoice', '', 0),
(99, 2, '2021-03-18 17:49:12', '2021-03-18 23:49:12', '', '88', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 17:49:12', '2021-03-18 19:49:12', 'bigshot', 98, '', 0, 'invoice_order', '', 0),
(100, 2, '2021-03-18 17:49:12', '2021-03-18 23:49:12', '', '94', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 17:49:12', '2021-03-18 19:49:12', 'bigshot', 98, '', 0, 'invoice_order', '', 0),
(101, 2, '2021-03-18 17:49:12', '2021-03-18 23:49:12', '', '97', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 17:49:12', '2021-03-18 19:49:12', 'bigshot', 98, '', 0, 'invoice_order', '', 0),
(128, 3, '2021-03-20 00:00:00', '2021-03-21 05:51:53', 'dfsfsd', 'Order2021-03-20 23:51:53', '', 'cancelled', 'open', 'open', 'order_1247', 'order-1', '', '', '2021-03-25 05:01:28', '2021-03-21 01:51:53', '', 0, '', 0, 'shop_order', '', 0),
(125, 2, '2021-03-20 17:45:27', '2021-03-20 23:45:27', '', '123', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-20 17:45:27', '2021-03-20 19:45:27', 'ddd', 124, '', 0, 'invoice_order', '', 0),
(104, 2, '2021-03-18 18:13:17', '2021-03-19 00:13:17', '103', 'invoice', '', 'publish', 'open', 'open', '', 'inv-7', '', '', '2021-03-18 18:13:17', '2021-03-18 20:13:17', 'dfsaz', 0, '', 0, 'invoice', '', 0),
(105, 2, '2021-03-18 18:13:17', '2021-03-19 00:13:17', '', '103', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-18 18:13:17', '2021-03-18 20:13:17', 'dfsaz', 104, '', 0, 'invoice_order', '', 0),
(106, 6, '2021-03-18 20:18:00', '2021-03-18 20:18:00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'lorem', 'Lorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industry', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 20:18:00', '2021-03-18 20:18:00', '', 0, '', 0, 'genarel_quiry', '', 0),
(107, 6, '2021-03-18 20:18:28', '2021-03-18 20:18:28', 'ZXZ', 'vcbc', 'Lorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industryLorem Ipsum is simply dummy text of the printing and typesetting industry', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 20:18:28', '2021-03-18 20:18:28', '', 0, '', 0, 'genarel_quiry', '', 0),
(108, 6, '2021-03-18 20:19:25', '2021-03-18 20:19:25', 'It is a', 'big', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'publish', 'open', 'open', '', '', '', '', '2021-03-18 20:19:25', '2021-03-18 20:19:25', '', 0, '', 0, 'genarel_quiry', '', 0),
(118, 1, '2021-03-20 00:00:00', '2021-03-20 23:23:35', 'this', 'Order2021-03-20 17:23:35', '', 'cancelled', 'open', 'open', 'order_1247', 'order-2', '', '', '2021-03-20 05:41:24', '2021-03-20 19:23:35', '', 0, '', 0, 'shop_order', '', 0),
(111, 2, '2021-03-20 13:18:59', '2021-03-20 19:18:59', '75,109,110', 'invoice', '', 'publish', 'open', 'open', '', 'inv-8', '', '', '2021-03-20 13:18:59', '2021-03-20 15:18:59', 'Arif Company', 0, '', 0, 'invoice', '', 0),
(112, 2, '2021-03-20 13:18:59', '2021-03-20 19:18:59', '', '75', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-20 13:18:59', '2021-03-20 15:18:59', 'Arif Company', 111, '', 0, 'invoice_order', '', 0),
(113, 2, '2021-03-20 13:18:59', '2021-03-20 19:18:59', '', '109', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-20 13:18:59', '2021-03-20 15:18:59', 'Arif Company', 111, '', 0, 'invoice_order', '', 0),
(114, 2, '2021-03-20 13:18:59', '2021-03-20 19:18:59', '', '110', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-20 13:18:59', '2021-03-20 15:18:59', 'Arif Company', 111, '', 0, 'invoice_order', '', 0),
(117, 1, '2021-03-20 00:00:00', '2021-03-20 23:10:28', 'lorem', 'Order2021-03-20 17:10:28', '', 'cancelled', 'open', 'open', 'order_1247', 'order-1', '', '', '2021-03-20 05:20:41', '2021-03-20 19:10:28', '', 0, '', 0, 'shop_order', '', 0),
(115, 2, '2021-03-27 13:35:00', '2021-03-27 19:35:00', '<p>lorem</p>', 'silk saree', '<p>lorem</p>', 'unpublish', 'open', 'open', '', 'silk saree', '', '', '2021-03-20 15:36:34', '2021-03-20 15:36:34', '', 0, '', 0, 'product', '', 0),
(116, 2, '2021-03-27 13:35:00', '2021-03-27 19:35:00', '<p>lorem</p>', 'silk saree', '<p>lorem</p>', 'unpublish', 'open', 'open', '', 'silk saree', '', '', '2021-03-20 15:36:34', '2021-03-20 15:36:34', '', 115, '', 0, 'product_varient', '', 0),
(119, 1, '2021-03-20 00:00:00', '2021-03-20 23:24:07', '', 'Order2021-03-20 17:24:07', '', 'delivered', 'open', 'open', 'order_1247', 'order-3', '', '', '2021-03-20 17:45:51', '2021-03-20 19:24:07', 'sss', 0, '', 0, 'shop_order', '', 0),
(134, 2, '2021-03-21 11:58:09', '2021-03-21 17:58:09', '120,127', 'invoice', '', 'publish', 'open', 'open', '', 'inv-12', '', '', '2021-03-21 11:58:09', '2021-03-21 13:58:09', 'mrpeon', 0, '', 0, 'invoice', '', 0),
(135, 2, '2021-03-21 11:58:09', '2021-03-21 17:58:09', '', '120', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-21 11:58:09', '2021-03-21 13:58:09', 'mrpeon', 134, '', 0, 'invoice_order', '', 0),
(136, 2, '2021-03-21 11:58:09', '2021-03-21 17:58:09', '', '127', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-21 11:58:09', '2021-03-21 13:58:09', 'mrpeon', 134, '', 0, 'invoice_order', '', 0),
(137, 2, '2021-03-21 00:00:00', '2021-03-21 20:19:07', '', 'Order2021-03-21 14:19:07', '', 'delivered', 'open', 'open', 'order_1247', 'order-3', '', '', '2021-03-27 09:49:28', '2021-03-21 16:19:07', 'me', 0, '', 0, 'shop_order', '', 0),
(138, 2, '2021-03-21 00:00:00', '2021-03-21 20:45:55', '', 'Order2021-03-21 14:45:55', '', 'delivered', 'open', 'open', 'order_1247', 'order-4', '', '', '2021-03-21 14:51:48', '2021-03-21 16:45:55', 'Mrpeon', 0, '', 0, 'shop_order', '', 0),
(139, 2, '2021-03-21 14:49:03', '2021-03-21 20:49:03', '138', 'invoice', '', 'publish', 'open', 'open', '', 'inv-13', '', '', '2021-03-21 14:49:03', '2021-03-21 16:49:03', 'Mrpeon', 0, '', 0, 'invoice', '', 0),
(140, 2, '2021-03-21 14:49:03', '2021-03-21 20:49:03', '', '138', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-21 14:49:03', '2021-03-21 16:49:03', 'Mrpeon', 139, '', 0, 'invoice_order', '', 0),
(141, 7, '2021-03-22 00:00:00', '2021-03-22 17:23:05', 'tfgyrtfytrfy', 'Order2021-03-22 11:23:05', '', 'cancelled', 'open', 'open', 'order_1247', 'order-1', '', '', '2021-03-22 12:27:02', '2021-03-22 13:23:05', '', 0, '', 0, 'shop_order', '', 0),
(142, 7, '2021-03-22 00:00:00', '2021-03-22 17:33:01', '', 'Order2021-03-22 11:33:01', '', 'delivered', 'open', 'open', 'order_1247', 'order-2', '', '', '2021-03-27 09:49:35', '2021-03-22 13:33:01', 'me', 0, '', 0, 'shop_order', '', 0),
(143, 7, '2021-03-22 00:00:00', '2021-03-22 18:02:43', '', 'Order2021-03-22 12:02:43', '', 'delivered', 'open', 'open', 'order_1247', 'order-3', '', '', '2021-03-22 12:17:31', '2021-03-22 14:02:43', 'test', 0, '', 0, 'shop_order', '', 0),
(144, 2, '2021-03-22 12:15:22', '2021-03-22 18:15:22', '143', 'invoice', '', 'publish', 'open', 'open', '', 'inv-14', '', '', '2021-03-22 12:15:22', '2021-03-22 14:15:22', 'test', 0, '', 0, 'invoice', '', 0),
(145, 2, '2021-03-22 12:15:22', '2021-03-22 18:15:22', '', '143', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-22 12:15:22', '2021-03-22 14:15:22', 'test', 144, '', 0, 'invoice_order', '', 0),
(146, 7, '2021-03-22 00:00:00', '2021-03-22 20:11:05', '', 'Order2021-03-22 14:11:05', '', 'delivered', 'open', 'open', 'order_1247', 'order-4', '', '', '2021-03-27 09:49:41', '2021-03-22 16:11:05', 'me', 0, '', 0, 'shop_order', '', 0),
(147, 7, '2021-03-22 00:00:00', '2021-03-22 20:21:44', '', 'Order2021-03-22 14:21:44', '', 'delivered', 'open', 'open', 'order_1247', 'order-5', '', '', '2021-03-27 09:49:46', '2021-03-22 16:21:44', 'My Com', 0, '', 0, 'shop_order', '', 0),
(148, 8, '2021-03-23 00:00:00', '2021-03-23 15:45:45', '', 'Order2021-03-23 09:45:45', '', 'dispatch', 'open', 'open', 'order_1247', 'order-1', '', '', '2021-03-27 09:42:56', '2021-03-23 11:45:45', 'My Com', 0, '', 0, 'shop_order', '', 0),
(149, 8, '2021-03-24 14:06:42', '2021-03-24 14:06:42', 'dfdsfsdfsdf', 'dsfsdfsdf', 'tfgehyhjiu4ireufykuirtkkukieuukritulotuutj6reewjyweu', 'publish', 'open', 'open', '', '', '', '', '2021-03-24 14:06:42', '2021-03-24 14:06:42', '', 0, '', 0, 'genarel_quiry', '', 0),
(150, 8, '2021-03-24 14:07:54', '2021-03-24 14:07:54', '3453534534', 'erterter', 'hlwwwwww', 'publish', 'open', 'open', '', '', '', '', '2021-03-24 14:07:54', '2021-03-24 14:07:54', '', 0, '', 0, 'genarel_quiry', '', 0),
(151, 3, '2021-03-24 00:00:00', '2021-03-24 23:21:39', '', 'Order2021-03-24 17:21:39', '', 'dispatch', 'open', 'open', 'order_1247', 'order-2', '', '', '2021-03-27 09:42:56', '2021-03-24 17:21:39', 'My Com', 0, '', 0, 'shop_order', '', 0),
(152, 3, '2021-03-24 00:00:00', '2021-03-24 23:29:37', '', 'Order2021-03-24 17:29:37', '', 'cancelled', 'open', 'open', 'order_1247', 'order-3', '', '', '2021-03-25 16:48:00', '2021-03-24 17:29:37', '', 0, '', 0, 'shop_order', '', 0),
(153, 3, '2021-03-24 00:00:00', '2021-03-24 23:58:42', '', 'Order2021-03-24 17:58:42', '', 'delivered', 'open', 'open', 'order_1247', 'order-4', '', '', '2021-03-27 09:45:14', '2021-03-24 17:58:42', 'my', 0, '', 0, 'shop_order', '', 0),
(154, 3, '2021-03-24 00:00:00', '2021-03-24 23:59:06', '', 'Order2021-03-24 17:59:06', '', 'delivered', 'open', 'open', 'order_1247', 'order-5', '', '', '2021-03-27 09:45:21', '2021-03-24 17:59:06', 'my', 0, '', 0, 'shop_order', '', 0),
(155, 3, '2021-03-24 00:00:00', '2021-03-24 23:59:32', '', 'Order2021-03-24 17:59:32', '', 'cancelled', 'open', 'open', 'order_1247', 'order-6', '', '', '2021-03-25 11:11:00', '2021-03-24 17:59:32', 'fdgdfgdfg', 0, '', 0, 'shop_order', '', 0),
(156, 2, '2021-03-25 11:10:49', '2021-03-25 17:10:49', '155', 'invoice', '', 'publish', 'open', 'open', '', 'inv-15', '', '', '2021-03-25 11:10:49', '2021-03-25 11:10:49', 'fdgdfgdfg', 0, '', 0, 'invoice', '', 0),
(157, 2, '2021-03-25 11:10:49', '2021-03-25 17:10:49', '', '155', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-25 11:10:49', '2021-03-25 11:10:49', 'fdgdfgdfg', 156, '', 0, 'invoice_order', '', 0),
(158, 3, '2021-03-25 00:00:00', '2021-03-25 17:39:21', '', 'Order2021-03-25 11:39:21', '', 'cancelled', 'open', 'open', 'order_1247', 'order-7', '', '', '2021-03-25 16:46:00', '2021-03-25 11:39:21', '', 0, '', 0, 'shop_order', '', 0),
(159, 3, '2021-03-25 16:55:04', '2021-03-25 16:55:04', 'vxcvxcv', 'cxvcx', '', 'publish', 'open', 'open', '', '', '', '', '2021-03-25 16:55:04', '2021-03-25 16:55:04', '', 0, '', 0, 'genarel_quiry', '', 0),
(160, 2, '2021-03-27 09:41:39', '2021-03-27 15:41:39', '147,148,151', 'invoice', '', 'publish', 'open', 'open', '', 'inv-16', '', '', '2021-03-27 09:41:39', '2021-03-27 09:41:39', 'My Com', 0, '', 0, 'invoice', '', 0),
(161, 2, '2021-03-27 09:41:39', '2021-03-27 15:41:39', '', '147', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-27 09:41:39', '2021-03-27 09:41:39', 'My Com', 160, '', 0, 'invoice_order', '', 0),
(162, 2, '2021-03-27 09:41:39', '2021-03-27 15:41:39', '', '148', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-27 09:41:39', '2021-03-27 09:41:39', 'My Com', 160, '', 0, 'invoice_order', '', 0),
(163, 2, '2021-03-27 09:41:39', '2021-03-27 15:41:39', '', '151', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-27 09:41:39', '2021-03-27 09:41:39', 'My Com', 160, '', 0, 'invoice_order', '', 0),
(164, 2, '2021-03-27 09:43:43', '2021-03-27 15:43:43', '153,154', 'invoice', '', 'publish', 'open', 'open', '', 'inv-17', '', '', '2021-03-27 09:43:43', '2021-03-27 09:43:43', 'my', 0, '', 0, 'invoice', '', 0),
(165, 2, '2021-03-27 09:43:43', '2021-03-27 15:43:43', '', '153', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-27 09:43:43', '2021-03-27 09:43:43', 'my', 164, '', 0, 'invoice_order', '', 0),
(166, 2, '2021-03-27 09:43:43', '2021-03-27 15:43:43', '', '154', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-27 09:43:43', '2021-03-27 09:43:43', 'my', 164, '', 0, 'invoice_order', '', 0),
(167, 2, '2021-03-27 09:48:52', '2021-03-27 15:48:52', '137,142,146', 'invoice', '', 'publish', 'open', 'open', '', 'inv-18', '', '', '2021-03-27 09:48:52', '2021-03-27 09:48:52', 'me', 0, '', 0, 'invoice', '', 0),
(168, 2, '2021-03-27 09:48:52', '2021-03-27 15:48:52', '', '137', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-27 09:48:52', '2021-03-27 09:48:52', 'me', 167, '', 0, 'invoice_order', '', 0),
(169, 2, '2021-03-27 09:48:52', '2021-03-27 15:48:52', '', '142', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-27 09:48:52', '2021-03-27 09:48:52', 'me', 167, '', 0, 'invoice_order', '', 0),
(170, 2, '2021-03-27 09:48:52', '2021-03-27 15:48:52', '', '146', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-03-27 09:48:52', '2021-03-27 09:48:52', 'me', 167, '', 0, 'invoice_order', '', 0),
(171, 2, '2021-03-20 10:03:00', '2021-03-20 16:03:00', '<p>xczzxc</p>', 'Just Testing', '<p>zxczxczxczx</p>', 'unpublish', 'open', 'open', '', 'Just Testing', '', '', '2021-03-27 09:53:56', '2021-03-27 09:53:56', '', 0, '', 0, 'product', '', 0),
(172, 2, '2021-03-27 00:00:00', '2021-03-27 06:00:00', '<p>asdasd</p>', 'at_product', '<p>zxczxczx</p>', 'unpublish', 'open', 'open', '', 'at_product', '', '', '2021-03-27 11:02:21', '2021-03-27 11:02:21', '', 0, '', 0, 'product', '', 0),
(173, 2, '2021-03-27 00:00:00', '2021-03-27 06:00:00', '<p>asdasd</p>', 'at_product', '<p>zxczxczx</p>', 'unpublish', 'open', 'open', '', 'at_product', '', '', '2021-03-27 11:02:21', '2021-03-27 11:02:21', '', 172, '', 0, 'product_varient', '', 0),
(174, 2, '2021-03-27 00:00:00', '2021-03-27 06:00:00', '<p>asdasd</p>', 'at_product', '<p>zxczxczx</p>', 'unpublish', 'open', 'open', '', 'at_product', '', '', '2021-03-27 11:02:21', '2021-03-27 11:02:21', '', 172, '', 0, 'product_varient', '', 0),
(175, 2, '2021-03-20 12:09:00', '2021-03-20 18:09:00', '<p>sdfsdfdsf</p>', 'sohel', '<p>vxcvxcvxcv</p>', 'unpublish', 'open', 'open', '', 'sohel', '', '', '2021-03-27 12:09:49', '2021-03-27 12:09:49', '', 0, '', 0, 'product', '', 0),
(176, 2, '2021-03-27 12:10:00', '2021-03-27 18:10:00', '<p>dsfsdfsdf</p>', 'sohel variant', '<p>dsfsdfds</p>', 'unpublish', 'open', 'open', '', 'sohel variant', '', '', '2021-03-27 12:11:24', '2021-03-27 12:11:24', '', 0, '', 0, 'product', '', 0),
(177, 2, '2021-03-27 12:10:00', '2021-03-27 18:10:00', '<p>dsfsdfsdf</p>', 'sohel variant', '<p>dsfsdfds</p>', 'unpublish', 'open', 'open', '', 'sohel variant', '', '', '2021-03-27 12:11:24', '2021-03-27 12:11:24', '', 176, '', 0, 'product_varient', '', 0),
(178, 2, '2021-03-27 12:10:00', '2021-03-27 18:10:00', '<p>dsfsdfsdf</p>', 'sohel variant', '<p>dsfsdfds</p>', 'unpublish', 'open', 'open', '', 'sohel variant', '', '', '2021-03-27 12:11:24', '2021-03-27 12:11:24', '', 176, '', 0, 'product_varient', '', 0),
(179, 3, '2021-04-04 00:00:00', '2021-04-04 20:17:21', '', 'Order2021-04-04 14:17:21', '', 'delivered', 'open', 'open', 'order_1247', 'order-8', '', '', '2021-04-04 14:29:27', '2021-04-04 14:17:21', 'Test Company', 0, '', 0, 'shop_order', '', 0),
(180, 3, '2021-04-04 00:00:00', '2021-04-04 20:17:42', '', 'Order2021-04-04 14:17:42', '', 'delivered', 'open', 'open', 'order_1247', 'order-9', '', '', '2021-04-04 14:29:31', '2021-04-04 14:17:42', 'Test Company', 0, '', 0, 'shop_order', '', 0),
(181, 2, '2021-04-04 14:21:44', '2021-04-04 20:21:44', '179,180', 'invoice', '', 'publish', 'open', 'open', '', 'inv-19', '', '', '2021-04-04 14:21:44', '2021-04-04 14:21:44', 'Test Company', 0, '', 0, 'invoice', '', 0),
(182, 2, '2021-04-04 14:21:44', '2021-04-04 20:21:44', '', '179', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 14:21:44', '2021-04-04 14:21:44', 'Test Company', 181, '', 0, 'invoice_order', '', 0),
(183, 2, '2021-04-04 14:21:44', '2021-04-04 20:21:44', '', '180', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 14:21:44', '2021-04-04 14:21:44', 'Test Company', 181, '', 0, 'invoice_order', '', 0),
(184, 3, '2021-04-04 00:00:00', '2021-04-04 20:28:32', '', 'Order2021-04-04 14:28:32', '', 'delivered', 'open', 'open', 'order_1247', 'order-10', '', '', '2021-04-04 14:29:20', '2021-04-04 14:28:32', 'Test', 0, '', 0, 'shop_order', '', 0),
(185, 2, '2021-04-04 14:28:56', '2021-04-04 20:28:56', '184', 'invoice', '', 'publish', 'open', 'open', '', 'inv-20', '', '', '2021-04-04 14:28:56', '2021-04-04 14:28:56', 'Test', 0, '', 0, 'invoice', '', 0),
(186, 2, '2021-04-04 14:28:56', '2021-04-04 20:28:56', '', '184', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 14:28:56', '2021-04-04 14:28:56', 'Test', 185, '', 0, 'invoice_order', '', 0),
(187, 3, '2021-04-04 00:00:00', '2021-04-04 21:38:32', '', 'Order2021-04-04 15:38:32', '', 'delivered', 'open', 'open', 'order_1247', 'order-11', '', '', '2021-04-04 15:40:14', '2021-04-04 15:38:32', 'Test', 0, '', 0, 'shop_order', '', 0),
(188, 3, '2021-04-04 00:00:00', '2021-04-04 21:38:52', '', 'Order2021-04-04 15:38:52', '', 'delivered', 'open', 'open', 'order_1247', 'order-12', '', '', '2021-04-04 15:40:21', '2021-04-04 15:38:52', 'Test', 0, '', 0, 'shop_order', '', 0),
(189, 2, '2021-04-04 15:39:23', '2021-04-04 21:39:23', '187,188', 'invoice', '', 'publish', 'open', 'open', '', 'inv-21', '', '', '2021-04-04 15:39:23', '2021-04-04 15:39:23', 'Test', 0, '', 0, 'invoice', '', 0),
(190, 2, '2021-04-04 15:39:23', '2021-04-04 21:39:23', '', '187', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 15:39:23', '2021-04-04 15:39:23', 'Test', 189, '', 0, 'invoice_order', '', 0),
(191, 2, '2021-04-04 15:39:23', '2021-04-04 21:39:23', '', '188', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 15:39:23', '2021-04-04 15:39:23', 'Test', 189, '', 0, 'invoice_order', '', 0),
(192, 3, '2021-04-04 00:00:00', '2021-04-04 23:27:34', '', 'Order2021-04-04 17:27:34', '', 'delivered', 'open', 'open', 'order_1247', 'order-13', '', '', '2021-04-04 17:29:49', '2021-04-04 17:27:34', 'Arif Company', 0, '', 0, 'shop_order', '', 0),
(193, 3, '2021-04-04 00:00:00', '2021-04-04 23:27:51', '', 'Order2021-04-04 17:27:51', '', 'delivered', 'open', 'open', 'order_1247', 'order-14', '', '', '2021-04-04 17:29:56', '2021-04-04 17:27:51', 'Arif Company', 0, '', 0, 'shop_order', '', 0),
(194, 3, '2021-04-04 00:00:00', '2021-04-04 23:28:08', '', 'Order2021-04-04 17:28:08', '', 'delivered', 'open', 'open', 'order_1247', 'order-15', '', '', '2021-04-04 17:29:59', '2021-04-04 17:28:08', 'Arif Company', 0, '', 0, 'shop_order', '', 0),
(195, 3, '2021-04-04 00:00:00', '2021-04-04 23:28:27', '', 'Order2021-04-04 17:28:27', '', 'delivered', 'open', 'open', 'order_1247', 'order-16', '', '', '2021-04-04 17:30:03', '2021-04-04 17:28:27', 'Arif Company', 0, '', 0, 'shop_order', '', 0),
(196, 2, '2021-04-04 17:29:20', '2021-04-04 23:29:20', '192,193,194,195', 'invoice', '', 'publish', 'open', 'open', '', 'inv-22', '', '', '2021-04-04 17:29:20', '2021-04-04 17:29:20', 'Arif Company', 0, '', 0, 'invoice', '', 0),
(197, 2, '2021-04-04 17:29:20', '2021-04-04 23:29:20', '', '192', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 17:29:20', '2021-04-04 17:29:20', 'Arif Company', 196, '', 0, 'invoice_order', '', 0),
(198, 2, '2021-04-04 17:29:20', '2021-04-04 23:29:20', '', '193', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 17:29:20', '2021-04-04 17:29:20', 'Arif Company', 196, '', 0, 'invoice_order', '', 0),
(199, 2, '2021-04-04 17:29:20', '2021-04-04 23:29:20', '', '194', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 17:29:20', '2021-04-04 17:29:20', 'Arif Company', 196, '', 0, 'invoice_order', '', 0),
(200, 2, '2021-04-04 17:29:20', '2021-04-04 23:29:20', '', '195', '', 'publish', 'open', 'open', '', 'invoice_order', '', '', '2021-04-04 17:29:20', '2021-04-04 17:29:20', 'Arif Company', 196, '', 0, 'invoice_order', '', 0);

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
(26, 115, '116', 'size', 'XL', 13, 25, 1),
(27, 172, '173', 'color', 'Red', 9, 0, 1),
(28, 172, '174', 'color', 'Blue', 11, 0, 1),
(29, 176, '177', 'color', 'Red', 9, 0, 1),
(30, 176, '178', 'color', 'Blue', 11, 0, 1);

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
(45, 'matlab', 'matlab', 0, 1, '2021-03-18 20:21:11');

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
(49, 8, 0),
(115, 5, 0),
(172, 6, 0),
(171, 21, 0),
(175, 8, 0),
(176, 21, 0);

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
(48, 45, 'postcode', '2300', 45, 0, '2021-03-18 20:21:11');

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
(218, 0, 'district', '17'),
(219, 0, 'city', '18'),
(220, 0, 'zip', '1200'),
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
(434, 3, 'address_one', 'Mirpur,Dhaka'),
(435, 3, 'district', '19'),
(436, 3, 'city', '20'),
(437, 3, 'zip', '1300'),
(217, 0, 'address_one', 'Uttara,Dhaka'),
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
(238, 5, 'address_one', 'Uttara,Dhaka'),
(239, 5, 'district', '17'),
(240, 5, 'city', '18'),
(241, 5, 'zip', '1200'),
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
(367, 8, 'phone', '0'),
(368, 8, 'user_image', 'user.png'),
(369, 8, 'address_one', 'Uttara,Dhaka'),
(370, 8, 'district', '19'),
(371, 8, 'city', '20'),
(372, 8, 'zip', '1300'),
(373, 9, 'first_name', 'Arif'),
(374, 9, 'last_name', 'hossain'),
(375, 9, 'address_two', 'Uttara,Dhaka'),
(376, 9, 'phone', '0'),
(377, 9, 'user_image', 'user.png');

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
(3, 'Demo', 'User', 'demo@email.com', NULL, '$2y$10$kWxHZoXuhxBiFY/vdokU0u9REwpd7EWV7kekYFaS6Kd9ro6fLwK4S', NULL, NULL, NULL, 1, '2021-01-18 07:09:58', '2021-01-18 07:09:58'),
(4, 'Aminul', 'Islam', 'a.soton7@gmail.com', NULL, '$2y$10$AEgA3BzOt6f0omNWMBOLy.YaViLGTVAR4VFVzquoLMgswSkr0WeAi', NULL, NULL, NULL, 1, '2021-03-10 02:50:49', '2021-03-10 02:50:49'),
(5, 'Partho', 'Kar', 'parthokar90@gmail.com', NULL, '$2y$10$M5IpbaP6p2MuhdHgx9936.LK1NE5AoTCnR0TAf64r/5M4LRtj/T0G', NULL, NULL, NULL, 1, '2021-03-18 07:21:12', '2021-03-18 07:21:12'),
(6, 'rana', 'khan', 'sohelahmedite@gmail.com', NULL, '$2y$10$beteEl6iSBSgc666AdHuz.3jZUrsYDIcZMU8Yb9BWo7UjSsTmHTU2', NULL, NULL, NULL, 1, '2021-03-18 09:59:51', '2021-03-18 09:59:51'),
(7, 'Innovative', 'Admin', 'ariful@itebd.com', NULL, '$2y$10$Jyx9Z531bOoqCD041rY82OvliO7lO9/RaZNjiWMGJJH2dEwD4i9na', NULL, NULL, NULL, 1, '2021-03-21 02:45:08', '2021-03-21 02:45:08'),
(8, 'Test', 'User', 'test@email.com', NULL, '$2y$10$uMZLvSbgY6yWruhjCSKjgOp0xTdLWGk8ehpZo8WOnQiun/28HuTYy', NULL, NULL, NULL, 1, '2021-03-23 01:44:02', '2021-03-23 01:44:02'),
(9, 'Arif', 'hossain', 'a@email.com', NULL, '$2y$10$lo4mOYxOcUo69Odaugwq8u5UXWrUXj7k.ofx9zHDRchCorzNopJki', NULL, NULL, NULL, 1, '2021-03-24 09:48:59', '2021-03-24 09:48:59');

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
(271, '5', '50', 'Dresses', '1000', '1000', '1'),
(294, '6', '45', 'Skirt', '1000', '1000', '1'),
(330, '2', '50', 'Dresses', '1000', '1000', '1'),
(338, '7', '27', 'Tunic', '1000', '1000', '1');

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
(8, 2, 6, NULL, NULL);

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
  MODIFY `attribute_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `meta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1071;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1900;

--
-- AUTO_INCREMENT for table `product_attibutes`
--
ALTER TABLE `product_attibutes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `termmeta`
--
ALTER TABLE `termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `term_taxonomy`
--
ALTER TABLE `term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `usermeta`
--
ALTER TABLE `usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=438;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `cart_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=374;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
