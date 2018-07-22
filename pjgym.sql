-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 22, 2018 at 06:20 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pjgym`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `soft` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `alias`, `parent_id`, `description`, `link`, `soft`, `status`, `created_at`) VALUES
(1, 'Mens', 'mens', 0, '<p>Strong &amp; Powerful</p>', ' ', 1, 0, '2018-07-11 09:08:18'),
(2, 'Womens', 'womens', 0, '<p>Tough &amp; pretty</p>', ' ', 2, 0, '2018-07-11 09:08:42'),
(3, 'Shorts', 'shorts', 1, '<p>Comfortable</p>', ' ', 3, 0, '2018-07-11 09:09:26'),
(4, 'Shorts', 'shorts', 2, '<p>Good!! choice</p>', ' ', 4, 0, '2018-07-22 04:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `like` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `pro_id`, `user_id`, `comment`, `parent`, `like`, `created_at`) VALUES
(1, 16, 5, 'hello', 0, 1, '2018-07-18 09:48:08'),
(2, 16, 5, 'heelo\n', 1, 1, '2018-07-18 09:48:14'),
(3, 16, 5, 'ry cc', 1, 0, '2018-07-18 09:48:21'),
(4, 16, 5, 'kute', 0, 0, '2018-07-19 17:50:09'),
(5, 16, 5, 'cc', 4, 0, '2018-07-19 17:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `group_permission`
--

DROP TABLE IF EXISTS `group_permission`;
CREATE TABLE IF NOT EXISTS `group_permission` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `per_id` int(11) NOT NULL,
  `list_product` int(11) DEFAULT '0',
  `insert_product` int(11) DEFAULT '0',
  `edit_product` int(11) DEFAULT '0',
  `delete_product` int(11) DEFAULT '0',
  `list_category` int(11) DEFAULT '0',
  `insert_category` int(11) DEFAULT '0',
  `edit_category` int(11) DEFAULT '0',
  `delete_category` int(11) DEFAULT '0',
  `list_user` int(11) DEFAULT '0',
  `insert_user` int(11) DEFAULT '0',
  `edit_user` int(11) DEFAULT '0',
  `delete_user` int(11) DEFAULT '0',
  `list_permission` int(11) DEFAULT '0',
  `insert_permission` int(11) DEFAULT '0',
  `edit_permission` int(11) DEFAULT '0',
  `delete_permission` int(11) DEFAULT '0',
  `list_order` int(11) DEFAULT '0',
  `edit_order` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_permission`
--

INSERT INTO `group_permission` (`id`, `per_id`, `list_product`, `insert_product`, `edit_product`, `delete_product`, `list_category`, `insert_category`, `edit_category`, `delete_category`, `list_user`, `insert_user`, `edit_user`, `delete_user`, `list_permission`, `insert_permission`, `edit_permission`, `delete_permission`, `list_order`, `edit_order`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, NULL),
(2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

DROP TABLE IF EXISTS `like`;
CREATE TABLE IF NOT EXISTS `like` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id`, `comment_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 5, NULL, NULL),
(2, 1, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(54, '2014_10_12_000000_create_users_table', 1),
(55, '2014_10_12_100000_create_password_resets_table', 1),
(56, '2018_05_08_070419_create_categories_table', 1),
(57, '2018_05_08_070608_create_products_table', 1),
(75, '2018_07_18_134520_create_order_details_table', 2),
(71, '2018_07_05_121916_create_permission_table', 2),
(72, '2018_07_14_112805_create_comments_table', 2),
(73, '2018_07_15_203331_create_like_table', 2),
(74, '2018_07_18_134304_create_orders_table', 2),
(76, '2018_07_19_130733_create_status_table', 3),
(77, '2018_07_21_220024_create_group_permission_table', 4),
(78, '2018_07_22_200017_create_ship_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_place` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_cost` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `area`, `delivery_place`, `delivery_cost`, `status`, `created_at`) VALUES
(41, 5, 'hcm', 'Q9', '2.00', 5, '2018-07-22 18:17:12'),
(40, 5, 'hcm', 'Q9', '2.00', 5, '2018-07-22 18:14:17'),
(39, 5, 'hcm', 'Q9', '2.00', 5, '2018-07-22 18:09:55'),
(38, 5, 'hcm', 'Q9', '2.00', 5, '2018-07-22 17:59:42'),
(37, 5, 'hcm', 'Q9', '2.00', 1, '2018-07-22 17:58:15'),
(36, 5, 'hcm', 'Q9', '2.00', 5, '2018-07-22 17:43:13'),
(35, 5, 'hcm', 'Q9', '2.00', 1, '2018-07-22 17:43:13'),
(34, 5, 'hcm', 'Q9', '2.00', 5, '2018-07-22 17:39:38'),
(33, 5, 'hcm', 'Q9', '2.00', 5, '2017-07-18 15:36:28'),
(32, 5, 'hcm', 'Q9', '2.00', 1, '2018-07-18 15:34:58'),
(31, 5, 'hcm', 'Q9', '2.00', 1, '2018-07-18 15:32:35'),
(30, 5, 'hcm', 'Q9', '2.00', 5, '2018-07-18 15:32:26'),
(29, 5, 'hcm', 'Q9', '2.00', 5, '2018-07-18 15:30:55'),
(28, 5, 'hcm', 'Q9', '2.00', 5, '2018-07-18 09:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `pro_id`, `price`, `size`, `quantity`, `created_at`) VALUES
(112, 41, 14, '26.00', 'M', 2, '2018-07-22 18:17:12'),
(111, 41, 15, '26.00', 'M', 2, '2018-07-22 18:17:12'),
(110, 41, 16, '26.00', 'M', 2, '2018-07-22 18:17:12'),
(109, 40, 14, '26.00', 'M', 2, '2018-07-22 18:14:17'),
(108, 40, 15, '26.00', 'M', 2, '2018-07-22 18:14:17'),
(107, 40, 16, '26.00', 'M', 2, '2018-07-22 18:14:17'),
(106, 39, 14, '26.00', 'XL', 3, '2018-07-22 18:09:55'),
(105, 39, 15, '26.00', 'L', 3, '2018-07-22 18:09:55'),
(104, 39, 16, '26.00', 'M', 3, '2018-07-22 18:09:55'),
(103, 38, 14, '26.00', 'L', 3, '2018-07-22 17:59:42'),
(102, 38, 15, '26.00', 'L', 3, '2018-07-22 17:59:42'),
(101, 38, 16, '26.00', 'L', 3, '2018-07-22 17:59:42'),
(100, 37, 14, '26.00', 'XS', 1, '2018-07-22 17:58:15'),
(99, 37, 15, '26.00', 'XS', 1, '2018-07-22 17:58:15'),
(98, 37, 16, '26.00', 'XS', 1, '2018-07-22 17:58:15'),
(97, 36, 14, '26.00', 'S', 3, '2018-07-22 17:43:13'),
(96, 36, 15, '26.00', 'S', 3, '2018-07-22 17:43:13'),
(95, 36, 16, '26.00', 'S', 3, '2018-07-22 17:43:13'),
(94, 35, 14, '26.00', 'S', 3, '2018-07-22 17:43:13'),
(93, 35, 15, '26.00', 'S', 3, '2018-07-22 17:43:13'),
(92, 35, 16, '26.00', 'S', 3, '2018-07-22 17:43:13'),
(91, 34, 14, '26.00', 'XS', 4, '2018-07-22 17:39:38'),
(90, 34, 15, '26.00', 'XS', 4, '2018-07-22 17:39:38'),
(89, 34, 16, '26.00', 'XS', 3, '2018-07-22 17:39:38'),
(88, 33, 16, '26.00', 'S', 5, '2017-01-18 15:36:28'),
(87, 32, 1, '36.00', 'XS', 5, '2018-07-18 15:34:58'),
(86, 31, 15, '26.00', 'XS', 5, '2018-04-18 15:32:35'),
(85, 31, 16, '26.00', 'XS', 11, '2018-05-18 15:32:35'),
(84, 28, 14, '26.00', 'XS', 1, '2018-06-18 09:42:14'),
(83, 28, 15, '26.00', 'XS', 1, '2018-03-18 09:42:14'),
(82, 28, 16, '26.00', 'XS', 1, '2018-07-18 09:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`, `position`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, NULL, NULL),
(2, 'Enter Data', 2, NULL, NULL),
(3, 'Sale Management', NULL, NULL, NULL),
(4, 'Customer', 4, NULL, NULL),
(5, 'Saler', NULL, NULL, NULL),
(6, 'Shipper', 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cate_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reduce` int(11) NOT NULL,
  `size` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `alias`, `cate_id`, `price`, `quantity`, `reduce`, `size`, `image`, `sub_image`, `intro`, `description`, `view`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PERFORATED SHORTS', 'perforated-shorts', 3, 36, 59, 36, '{\"XS\":5,\"S\":\"10\",\"M\":\"10\",\"L\":\"11\",\"XL\":\"12\",\"2XL\":\"11\"}', 'short_11531300493.1', '[\"short_11531300493.2\",\"short_11531300493.3\",\"short_11531300493.4\",\"short_11531300493.5\"]', 'No matter how strenuous the workout, the Men’s Perforated Shorts are ready to see you through.', '<p>No matter how strenuous the workout, the Men&rsquo;s Perforated Shorts are ready to see you through. Constructed with 4-way stretch fabric, on-trend split hems and an elasticated waistband, you&rsquo;re guaranteed a customisable fit for ultimate comfort.</p>\r\n\r\n<p>Featuring laser cut perforation and fused hems, the Perforated Shorts provide a sleek design.</p>\r\n\r\n<p>Finished with working zip pockets to the side and reflective logo.</p>\r\n\r\n<p>Main: 89% Polyester, 11% Elastane.</p>\r\n\r\n<p>Model is 6&#39;0&quot; and wears size M</p>', 0, 0, '2018-07-11 09:14:53', '2018-07-18 15:34:58'),
(2, 'LIGHT GREY', 'light-grey', 3, 36, 61, 36, '{\"XS\":\"11\",\"S\":\"10\",\"M\":\"10\",\"L\":\"10\",\"XL\":\"10\",\"2XL\":\"10\"}', 'short_21531300712.2', '[\"short_21531300712.jpg\",\"short_21531300712.1\",\"short_21531300712.3\",\"short_21531300712.4\"]', 'No matter how strenuous the workout, the Men’s Perforated Shorts are ready to see you through.', '<p>No matter how strenuous the workout, the Men&rsquo;s Perforated Shorts are ready to see you through. Constructed with 4-way stretch fabric, on-trend split hems and an elasticated waistband, you&rsquo;re guaranteed a customisable fit for ultimate comfort.</p>\r\n\r\n<p>Featuring laser cut perforation and fused hems, the Perforated Shorts provide a sleek design.</p>\r\n\r\n<p>Finished with working zip pockets to the side and reflective logo.</p>\r\n\r\n<p>Main: 89% Polyester, 11% Elastane.</p>\r\n\r\n<p>Model is 6&#39;0&quot; and wears size M</p>', 0, 0, '2018-07-11 09:18:32', '2018-07-11 09:18:32'),
(3, 'BLACK', 'black', 3, 36, 60, 36, '{\"XS\":\"10\",\"S\":\"10\",\"M\":\"10\",\"L\":\"10\",\"XL\":\"10\",\"2XL\":\"10\"}', 'short_31531300893.1', '[\"short_31531300893.2\",\"short_31531300893.3\",\"short_31531300893.4\",\"short_31531300893.5\",\"short_31531300893.jpg\"]', 'No matter how strenuous the workout, the Men’s Perforated Shorts are ready to see you through.', '<p>No matter how strenuous the workout, the Men&rsquo;s Perforated Shorts are ready to see you through. Constructed with 4-way stretch fabric, on-trend split hems and an elasticated waistband, you&rsquo;re guaranteed a customisable fit for ultimate comfort.</p>\r\n\r\n<p>Featuring laser cut perforation and fused hems, the Perforated Shorts provide a sleek design.</p>\r\n\r\n<p>Finished with working zip pockets to the side and reflective logo.</p>\r\n\r\n<p>Main: 89% Polyester, 11% Elastane.</p>\r\n\r\n<p>Model is 6&#39;0&quot; and wears size M</p>', 0, 0, '2018-07-11 09:21:33', '2018-07-11 09:21:33'),
(4, 'CHARCOAL', 'charcoal', 3, 36, 64, 36, '{\"XS\":\"11\",\"S\":\"11\",\"M\":\"10\",\"L\":\"12\",\"XL\":\"10\",\"2XL\":\"10\"}', 'short_41531301466.jpg', '[\"short_41531301466.1\",\"short_41531301466.2\",\"short_41531301466.3\",\"short_41531301466.4\"]', 'No matter how strenuous the workout, the Men’s Perforated Two in One Shorts are ready to see you through.', '<p>No matter how strenuous the workout, the Men&rsquo;s Perforated Two in One Shorts are ready to see you through. Constructed with 4-way stretch fabric, an elasticated waistband, and on-trend split hems, you&rsquo;re ensured a distraction free workout.</p>\r\n\r\n<p>Featuring laser cut perforation detailing and fused hems, the Perforated Two In One Shorts provide an aesthetic, clean and sleek look. Complete with an inner short to provide full coverage and semi-compression support, the Men&rsquo;s Perforated Two In One Shorts allow you to keep going for longer.</p>\r\n\r\n<p>Finished with reflective Gymshark logo.</p>\r\n\r\n<p>Main: 88% Polyester, 12% Elastane</p>\r\n\r\n<p>Inner Short: 93% Polyester, 7% Elastane</p>\r\n\r\n<p>Model is 6&#39;0&quot; and wears size M</p>', 0, 0, '2018-07-11 09:31:06', '2018-07-11 09:31:06'),
(5, 'NIGHTSHADE PURPLE', 'nightshade-purple', 3, 42, 66, 42, '{\"XS\":\"11\",\"S\":\"10\",\"M\":\"11\",\"L\":\"12\",\"XL\":\"11\",\"2XL\":\"11\"}', 'short_51531301661.jpg', '[\"short_51531301661.1\",\"short_51531301661.2\",\"short_51531301661.3\",\"short_51531301661.4\",\"short_51531301661.5\"]', 'No matter how strenuous the workout, the Men’s Perforated Two in One Shorts are ready to see you through.', '<p>No matter how strenuous the workout, the Men&rsquo;s Perforated Two in One Shorts are ready to see you through. Constructed with 4-way stretch fabric, an elasticated waistband, and on-trend split hems, you&rsquo;re ensured a distraction free workout.</p>\r\n\r\n<p>Featuring laser cut perforation detailing and fused hems, the Perforated Two In One Shorts provide an aesthetic, clean and sleek look. Complete with an inner short to provide full coverage and semi-compression support, the Men&rsquo;s Perforated Two In One Shorts allow you to keep going for longer.</p>\r\n\r\n<p>Finished with reflective Gymshark logo.</p>\r\n\r\n<p>Main: 88% Polyester, 12% Elastane</p>\r\n\r\n<p>Inner Short: 93% Polyester, 7% Elastane</p>\r\n\r\n<p>Model is 6&#39;0&quot; and wears size M</p>', 0, 0, '2018-07-11 09:34:21', '2018-07-11 09:43:39'),
(6, 'BLUE', 'blue', 3, 38, 64, 38, '{\"XS\":\"11\",\"S\":\"10\",\"M\":\"12\",\"L\":\"10\",\"XL\":\"11\",\"2XL\":\"10\"}', 'short_61531301819.3', '[\"short_61531301819.1\",\"short_61531301819.2\",\"short_61531301819.5\",\"short_11531303329.1\",\"short_1-21531303343.jpg\"]', 'Engineered with your comfort in mind, the Atlantic Swim Shorts are the perfect addition to your holiday wardrobe, allowing you to move freely both in and out of the water.', '<p>Engineered with your comfort in mind, the Atlantic Swim Shorts are the perfect addition to your holiday wardrobe, allowing you to move freely both in and out of the water.</p>\r\n\r\n<p>With split hems, an internal mesh lining and draw cord, the Atlantic Swim Shorts are the simple yet essential addition to your holiday wardrobe. Ideal for swimming, or even chilling by the pool.</p>\r\n\r\n<p>Complete with Gymshark logo.</p>\r\n\r\n<p>Main: 100% Polyester.</p>\r\n\r\n<p>Mesh: 90% Polyester, 10% Elastane.</p>\r\n\r\n<p>Model is 5&#39;11&quot; and wears size M</p>', 0, 0, '2018-07-11 09:36:59', '2018-07-11 10:02:23'),
(7, 'CHARCOAL', 'charcoal', 3, 38, 171, 35, '{\"XS\":\"111\",\"S\":\"11\",\"M\":\"10\",\"L\":\"12\",\"XL\":\"13\",\"2XL\":\"14\"}', 'short_7-11531302372.jpg', '[\"short_71531302372.jpg\",\"short_7-21531302372.jpg\",\"short_7-31531302372.jpg\",\"short_7-41531302372.jpg\",\"short_7-51531302372.jpg\"]', 'Engineered with your comfort in mind, the Atlantic Swim Shorts are the perfect addition to your holiday wardrobe, allowing you to move freely both in and out of the water.', '<p>ngineered with your comfort in mind, the Atlantic Swim Shorts are the perfect addition to your holiday wardrobe, allowing you to move freely both in and out of the water.</p>\r\n\r\n<p>With split hems, an internal mesh lining and draw cord, the Atlantic Swim Shorts are the simple yet essential addition to your holiday wardrobe. Ideal for swimming, or even chilling by the pool.</p>\r\n\r\n<p>Complete with Gymshark logo.</p>\r\n\r\n<p>Main: 100% Polyester.</p>\r\n\r\n<p>Mesh: 90% Polyester, 10% Elastane.</p>\r\n\r\n<p>Model is 5&#39;11&quot; and wears size M</p>', 0, 0, '2018-07-11 09:46:12', '2018-07-11 09:46:12'),
(8, 'OZONE SHORTS BLACK', 'ozone-shorts-black', 3, 40, 76, 40, '{\"XS\":\"11\",\"S\":\"11\",\"M\":\"12\",\"L\":\"13\",\"XL\":\"14\",\"2XL\":\"15\"}', 'short_81531302522.3', '[\"short_81531302522.1\",\"short_81531302522.2\",\"short_81531302522.5\",\"short_81531302522.4\",\"short_81531302522.jpg\"]', 'Sleek, stylish and effortlessly cool, the Ozone Shorts combine a classic silhouette with superior design.', '<p>Sleek, stylish and effortlessly cool, the Ozone Shorts combine a classic silhouette with superior design. Boasting a longer length, the Ozone Shorts offer a liberating range of movement whilst providing ultimate comfort and unique style.</p>\r\n\r\n<p>Exposed welt zip pockets to the side and back provide a convenient way to store essentials, whilst adjustable drawcord offers you the perfect, adjustable fit. Complete with branded internal waistband and tonal logo.</p>\r\n\r\n<p>Main: 57% Cotton, 43% Polyester<br />\r\nRib: 100% Nylon<br />\r\nMesh: 100% Polyester</p>\r\n\r\n<p>Model is 5&#39;11&quot; and wears size M</p>', 0, 0, '2018-07-11 09:48:42', '2018-07-11 09:48:42'),
(9, 'OZONE SHORTS PORT', 'ozone-shorts-port', 3, 40, 76, 38, '{\"XS\":\"11\",\"S\":\"11\",\"M\":\"12\",\"L\":\"13\",\"XL\":\"14\",\"2XL\":\"15\"}', 'short_91531302652.jpg', '[\"short_91531302652.2\",\"short_91531302652.1\",\"short_91531302652.3\",\"short_91531302652.4\",\"short_91531302652.5\"]', 'Sleek, stylish and effortlessly cool, the Ozone Shorts combine a classic silhouette with superior design.', '<p>Sleek, stylish and effortlessly cool, the Ozone Shorts combine a classic silhouette with superior design. Boasting a longer length, the Ozone Shorts offer a liberating range of movement whilst providing ultimate comfort and unique style.</p>\r\n\r\n<p>Exposed welt zip pockets to the side and back provide a convenient way to store essentials, whilst adjustable drawcord offers you the perfect, adjustable fit. Complete with branded internal waistband and tonal logo.</p>\r\n\r\n<p>Main: 57% Cotton, 43% Polyester<br />\r\nRib: 100% Nylon<br />\r\nMesh: 100% Polyester</p>\r\n\r\n<p>Model is 5&#39;11&quot; and wears size M</p>', 0, 0, '2018-07-11 09:50:52', '2018-07-11 09:50:52'),
(10, 'CAPITAL SHORTS DEEP TEAL', 'capital-shorts-deep-teal', 3, 34, 146, 34, '{\"XS\":\"1\",\"S\":\"10\",\"M\":\"15\",\"L\":\"20\",\"XL\":\"100\"}', 'short_101531302799.3', '[\"short_101531302799.1\",\"short_101531302799.2\",\"short_101531302799.4\",\"short_101531302799.5\",\"short_101531302799.jpg\"]', 'Designed as part of our lifestyle range, the Capital shorts boast an elasticated waist for the ultimate comfort.', '<p>Designed as part of our lifestyle range, the Capital shorts boast an elasticated waist for the ultimate comfort. An essential that works both in and out of the gym, featuring a fused hem and flat drawcords for a clean aesthetic.</p>\r\n\r\n<p>Concealed zip pockets provide a safe, convenient and subtle way to store essentials whilst training. Complete with Gymshark tab logo and crafted from a soft stretch material blend.</p>\r\n\r\n<p>89% Polyester, 11% Elastane.</p>\r\n\r\n<p>Model is 6&#39;2&quot;and wears size L</p>', 0, 0, '2018-07-11 09:53:19', '2018-07-11 09:53:19'),
(11, 'FREE FLOW SHORTS SLATE LAVENDER', 'free-flow-shorts-slate-lavender', 3, 34, 44, 34, '{\"XS\":\"11\",\"S\":\"11\",\"M\":\"10\",\"L\":\"12\"}', 'short_111531302959.4', '[\"short_111531302959.0\",\"short_111531302959.1\",\"short_111531302959.3\",\"short_111531302959.5\",\"short_111531302959.jpg\"]', 'Constructed from a lightweight perforated fabric, the Free Flow Shorts are engineered for enhanced ventilation and breathability, providing you with a distraction-free workout.', '<p>Constructed from a lightweight perforated fabric, the Free Flow Shorts are engineered for enhanced ventilation and breathability, providing you with a distraction-free workout.</p>\r\n\r\n<p>Designed as part of our lifestyle range, the Free Flow Shorts integrate soft stretch fabric to allow for a full range of movement. Complete with concealed zip pockets to store your essentials safely and cut-out reflective logo.</p>\r\n\r\n<p>48% Polyester, 21% Viscose,13% Pima Cotton, 11% Poly propylene, 7% Nylon.</p>\r\n\r\n<p>Model is 6&#39;2&quot; and wears size L.</p>', 0, 0, '2018-07-11 09:55:59', '2018-07-11 09:55:59'),
(12, 'ARK SHORTS BLACK', 'ark-shorts-black', 3, 26, 61, 26, '{\"XS\":\"11\",\"S\":\"12\",\"M\":\"15\",\"L\":\"11\",\"XL\":\"12\"}', 'short_121531303093.3', '[\"short_121531303093.1\",\"short_121531303093.2\",\"short_121531303093.4\",\"short_121531303093.5\",\"short_121531303093.jpg\"]', 'Taking you back to basics.', '<p>Taking you back to basics. The Ark Shorts have been designed with form and function in mind to provide consistent comfort for both workout and leisure.</p>\r\n\r\n<p>Constructed from lightweight, jersey blend fabric, the Ark Shorts boast a liberating range of movement whilst providing the perfect fit. Working side pockets are concealed for your convenience.</p>\r\n\r\n<p>Completed with raw-edge trim, drawstring waist and Gymshark embroidered shark head logo.</p>\r\n\r\n<p>60% Polyester, 35% Cotton, 5% Elastane.</p>\r\n\r\n<p>Model is 6&#39;4&quot;and wears size L</p>', 0, 0, '2018-07-11 09:58:13', '2018-07-11 09:58:13'),
(13, 'SPORT SHORTS CHARCOAL', 'sport-shorts-charcoal', 3, 26, 60, 26, '{\"XS\":\"11\",\"S\":\"12\",\"M\":\"12\",\"L\":\"10\",\"XL\":\"15\"}', 'short_131531303277.2', '[\"short_131531303277.1\",\"short_131531303277.4\",\"short_131531303277.3\",\"short_131531303277.5\"]', 'Your new go-to shorts for any activity, the Men’s Sport Shorts are truly a wardrobe essential.', '<p>Your new go-to shorts for any activity, the Men&rsquo;s Sport Shorts are truly a wardrobe essential. With mesh panelling for enhanced ventilation, an adjustable waistband and concealed zip pockets for your comfort and convenience.</p>\r\n\r\n<p>The Gymshark Sport Shorts are ready and waiting to take any workout to the next level. Complete with printed Gymshark logo, they&rsquo;re the perfect all-rounder shorts.</p>\r\n\r\n<p>100% Polyester.</p>\r\n\r\n<p>Model is 6&#39;2&quot; and wears size L</p>', 0, 0, '2018-07-11 10:01:17', '2018-07-11 10:53:50'),
(14, 'SPORT SHORT WHITE', 'sport-short-white', 3, 26, 101, 26, '{\"XS\":13,\"S\":13,\"M\":12,\"L\":22,\"XL\":20,\"2XL\":\"21\"}', 'short_141531303524.2', '[\"short_141531307125.1\",\"short_141531307125.3\",\"short_141531307125.4\",\"short_141531307125.5\",\"short_141531307125.jpg\"]', 'Your new go to shorts for any type of activity.', '<p>Your new go to shorts for any type of activity. The Men&#39;s Sports Shorts are a gym bag essential.</p>\r\n\r\n<p>-&nbsp;Adjustable waistband<br />\r\n-&nbsp;Mesh ventilation<br />\r\n-&nbsp;Printed Gymshark logo</p>\r\n\r\n<p>100% Polyester</p>\r\n\r\n<p>Model is 6&#39;2&quot; and wears size L</p>', 0, 0, '2018-07-11 10:05:24', '2018-07-22 18:18:19'),
(15, 'SPORT SHORTS LIGHT GREY', 'sport-shorts-light-grey', 3, 26, 118, 26, '{\"XS\":23,\"S\":25,\"M\":12,\"L\":34,\"XL\":\"10\",\"2XL\":\"14\"}', 'short_151531303662.3', '[\"short_151531307056.1\",\"short_151531307085.2\",\"short_151531307085.4\",\"short_151531307085.5\",\"short_151531307085.jpg\"]', 'Your new go to shorts for any type of activity.', '<p>Your new go to shorts for any type of activity. The Men&#39;s Sports Shorts are a gym bag essential.</p>\r\n\r\n<p>-&nbsp;Adjustable waistband<br />\r\n-&nbsp;Mesh ventilation<br />\r\n-&nbsp;Printed Gymshark logo</p>\r\n\r\n<p>100% Polyester</p>\r\n\r\n<p>Model is 6&#39;2&quot; and wears size L</p>', 0, 0, '2018-07-11 10:07:42', '2018-07-22 18:18:19'),
(16, 'ARK SHORTS PORT', 'ark-shorts-port', 3, 26, 110, 26, '{\"XS\":13,\"S\":29,\"M\":15,\"L\":23,\"XL\":\"30\"}', 'short_161531308080.3', '{\"0\":\"short_161532230439.1\",\"2\":\"short_161532230439.2\",\"3\":\"short_161532230480.4\",\"4\":\"short_161532230480.5\",\"5\":\"short_161532230480.jpg\"}', 'Taking you back to basics.', '<p>king you back to basics. The Ark Shorts have been designed with form and function in mind to provide consistent comfort for both workout and leisure.</p>\r\n\r\n<p>Constructed from lightweight, jersey blend fabric, the Ark Shorts boast a liberating range of movement whilst providing the perfect fit. Working side pockets are concealed for your convenience.</p>\r\n\r\n<p>Completed with raw-edge trim, drawstring waist and Gymshark embroidered shark head logo.</p>\r\n\r\n<p>60% Polyester, 35% Cotton, 5% Elastane.</p>\r\n\r\n<p>Model is 6&#39;4&quot;and wears size L</p>\r\n\r\n<p>.</p>\r\n\r\n<p>.</p>\r\n\r\n<p>.</p>\r\n\r\n<p>.</p>\r\n\r\n<p>.</p>\r\n\r\n<p>.</p>\r\n\r\n<p>.</p>\r\n\r\n<p>.</p>.', 0, 0, '2018-07-11 10:09:28', '2018-07-22 18:18:19'),
(17, 'asqweq', 'asqweq', 0, 12312, 3, 12312, '{\"XS\":\"3\"}', 'short_2-31532232102.jpg', NULL, 'qweqweqe', '<p>qweq</p>', 0, 1, '2018-07-22 04:01:42', '2018-07-22 04:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `ship`
--

DROP TABLE IF EXISTS `ship`;
CREATE TABLE IF NOT EXISTS `ship` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ship`
--

INSERT INTO `ship` (`id`, `user_id`, `order_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 33, 2, NULL, NULL),
(2, 10, 28, 2, NULL, NULL),
(3, 11, 29, 2, NULL, NULL),
(4, 12, 30, 2, NULL, NULL),
(5, 12, 34, 2, NULL, NULL),
(6, 10, 36, 2, NULL, NULL),
(7, 10, 38, 2, NULL, NULL),
(8, 10, 39, 2, NULL, NULL),
(9, 11, 40, 2, NULL, NULL),
(10, 10, 41, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'New', NULL, NULL),
(2, 'Confirmed', NULL, NULL),
(3, 'Delivering', NULL, NULL),
(4, 'Completed', NULL, NULL),
(5, 'Cancel', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `image`, `permission_id`, `phone_number`, `address`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Harrik', 'Uchiha', 'a@gmail.com', '$2y$10$1BMY0BkqbMmZtLe85kK4iezUhMK.FM3sfTkGqOCkxbMKF/5t5n3k6', '', '2', '012654', NULL, 0, 'D8SzQymjGl1W94oHe77qc4wNbbWoTot7SV4ZTuCoTHUqOf5u5JSU8qBYUCzi', '2018-07-06 05:47:08', '2018-07-06 05:47:08'),
(2, 'Duong', 'Tan', 'b@gmail.com', '$2y$10$XiWKnbJfRq5iV5HnNmmVTu1onXV8Aubcy2VZC.S8f1/bZjeADIMT.', 'cartoon1531229821.jpg', '1', '01688868552', 'Q9', 0, '2iEqzURiMwtpy2XaGCWSOVd7smVbjFn5lme8bMMshA2sMs0gttprg5ZcsOzf', '2018-07-06 07:26:45', '2018-07-10 08:08:03'),
(3, 'Sandy', 'Lou', 'san@gmail.com', '$2y$10$/wMWhqS9i/Bb.EMXRNg.3.1jWVj6Byhbzr52iWC.6jjAICuR1IEii', '', '4', '0168868553', NULL, 0, NULL, '2018-07-12 05:36:17', '2018-07-12 05:36:17'),
(4, 'Mood', 'OM', 'moo@gmail.com', '$2y$10$fO0IJwhe4R/P0nZfJ9rE0OS2Yo.iuY5X9iAvW53bt5DNJ4nrdf5aS', 'bingoi1531405438.jpg', '4', '01245', 'Q9', 0, NULL, '2018-07-12 05:40:10', '2018-07-12 07:38:09'),
(5, 'Hen', 'ry', 'he@gmail.com', '$2y$10$55jCfagum6Krl312sKLhIu04atypi65quumhKhiaHXJK.k4hASKoa', '3331531564143.jpg', '4', '011111', 'Q9', 0, 'kwgjItZLwk6yuFMFEDQjLstOsEIV2N9eicNbnaKGa3XRqhyPEqj0aGJQTO3w', '2018-07-14 03:28:04', '2018-07-14 03:28:41'),
(6, 'Ku', 'Te', 'ku@gmail.com', '$2y$10$fHDZvStjawPJ/AIt27nleO9czrUFTqdv82GV.SN2kkccc7nFfDwd6', 'ajinomoto1531585002.jpg', '4', '01688868553', NULL, 0, 'dZMPgtRSCGsL0bb6AbLBbDKHPZDaBisDgI2M6GtepX7FKLzYPxmz2VYJGJA2', '2018-07-14 16:16:42', '2018-07-14 16:16:42'),
(7, 'Elizabenth', 'Jonhangson', 'enter@gmail.com', '$2y$10$9Z7rhY2nk5ZHfhPr/ZDYuuD5rjcve0qQFGAM.tEzCeR9As3CFqTs2', '', '2', '0165534789', NULL, 0, NULL, '2018-07-22 03:03:06', '2018-07-22 03:03:06'),
(8, 'Victork', 'Rick', 'sale@gmail.com', '$2y$10$NwGrXfL4DAU3I75GXrNGpuzxGsWYPXKPPXfLIJgSZgYgMX6oP6CfK', 'applevinegar1532228632.jpg', '3', '478913123', NULL, 0, NULL, '2018-07-22 03:03:52', '2018-07-22 03:03:52'),
(9, 'hiddisonte', 'Kid', 'saler@gmail.com', '$2y$10$uGCGCuvKi2Z2umOxpD8i3e7jaPQ7e02tURAEFBN8hdKsNAf/V.abO', '', '5', '013654784', NULL, 0, NULL, '2018-07-22 03:04:52', '2018-07-22 03:04:52'),
(10, 'Ship', 'Shirt', 'ss@gmail.com', '$2y$10$9VRf4jN2hxnVD8/rGVltWukd/bVSlfv6rzlZ9AeRiFkht7HQK8Bh6', '', '6', '01685534781', NULL, 0, NULL, '2018-07-22 13:07:04', '2018-07-22 13:07:04'),
(11, 'Ken', 'ji', 'kj@gmail.com', '$2y$10$mbRIh1Q46l5PSTzE9LYkVe9LfvM8xIwOzjEyxaLCJOwe1ukq13AGy', '', '6', '01688553147', NULL, 0, NULL, '2018-07-22 13:07:24', '2018-07-22 13:07:24'),
(12, 'Jack', 'Ken', 'k@gmail.com', '$2y$10$G4VF.rXCkcyta3NYkz8OMedGETRA738pO1JrjDO65QQzp4a.9X1Ne', '', '6', '0168853477', NULL, 0, NULL, '2018-07-22 13:07:52', '2018-07-22 13:07:52');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
