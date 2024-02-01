-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 09, 2023 at 10:20 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new`
--

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `restaurant_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `small_price` text COLLATE utf8mb4_unicode_ci,
  `medium_price` text COLLATE utf8mb4_unicode_ci,
  `large_price` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `restaurant_id`, `item_name`, `small_price`, `medium_price`, `large_price`, `created_at`, `updated_at`) VALUES
(1, '1', 'pizza', '10', NULL, '30', '2023-09-02 05:21:20', '2023-09-05 05:14:57'),
(2, '1', 'burger', '10', '20', '30', '2023-09-02 05:38:20', '2023-09-05 05:14:37'),
(24, '1', 'French Fries', '20', NULL, '60', '2023-09-07 05:35:29', '2023-09-07 05:35:29'),
(23, '1', 'Cheese Papdi', '50', '70', NULL, '2023-09-07 05:34:46', '2023-09-07 05:34:46'),
(22, '1', 'Tomato Soup', NULL, '50', '80', '2023-09-07 05:31:50', '2023-09-07 05:31:50'),
(7, '3', 'Burger', '20', '40', '60', '2023-09-04 01:45:57', '2023-09-04 01:45:57'),
(8, '3', 'Pasta', '10', '30', '399', '2023-09-04 01:49:38', '2023-09-05 01:25:24'),
(9, '3', 'pizza', '11', '21', '31', '2023-09-04 02:09:57', '2023-09-05 01:16:03'),
(10, '4', 'Tea', '10', '20', '30', '2023-09-04 04:15:42', '2023-09-05 01:15:40'),
(11, '4', 'coca-cola', '10', '20', '30', '2023-09-04 04:16:14', '2023-09-04 04:16:14'),
(12, '4', 'tea', '11', '22', '33', '2023-09-04 04:16:31', '2023-09-04 04:16:31'),
(14, '5', 'Samosa', '10', '20', '30', '2023-09-04 04:38:30', '2023-09-04 04:38:30'),
(15, '5', 'small burger', '20', '30', '45', '2023-09-04 04:42:33', '2023-09-04 04:42:33'),
(21, '1', 'Maggi', '25', NULL, NULL, '2023-09-07 05:30:43', '2023-09-07 05:30:43'),
(18, '1', 'Burger', '15', '20', NULL, '2023-09-05 05:20:32', '2023-09-05 05:20:32'),
(20, '1', 'Pasta', '40', '70', '100', '2023-09-07 05:28:59', '2023-09-07 05:28:59'),
(25, '1', 'Burger', '50', NULL, NULL, '2023-09-07 05:50:38', '2023-09-07 05:50:38'),
(26, '1', 'Manchurian', NULL, '250', '300', '2023-09-07 07:09:32', '2023-09-07 07:09:32'),
(27, '1', 'French Fries', '100', '200', '500', '2023-09-07 07:10:08', '2023-09-07 07:10:08'),
(28, '1', 'Honey Chilly Potato', '100', '130', '150', '2023-09-07 07:10:31', '2023-09-07 07:10:31'),
(29, '1', 'Pakora', '20', '40', '50', '2023-09-07 23:21:33', '2023-09-07 23:21:33'),
(30, '1', 'Daal Makhni', '130', '170', '400', '2023-09-07 23:54:05', '2023-09-07 23:54:05'),
(31, '1', 'Daal Fry', '200', NULL, '599', '2023-09-07 23:55:45', '2023-09-07 23:55:45'),
(32, '1', 'Kadai Paneer', '300', '350', '400', '2023-09-07 23:56:36', '2023-09-07 23:56:36'),
(33, '1', 'Corn Tikki', '30', '68', '120', '2023-09-08 01:43:15', '2023-09-08 01:43:15'),
(34, '1', 'Paalak Paneer', '200', '350', '410', '2023-09-08 01:43:56', '2023-09-08 01:43:56'),
(35, '1', 'Veg. Fried Rice', '150', '190', '260', '2023-09-08 01:44:42', '2023-09-08 01:44:42'),
(36, '1', 'Chaap Makhni', '100', '150', NULL, '2023-09-08 01:45:28', '2023-09-08 01:45:28'),
(37, '1', 'Roti', '20', NULL, NULL, '2023-09-08 01:45:52', '2023-09-08 01:45:52'),
(38, '1', 'Butter Naan', '20', '40', '65', '2023-09-08 01:46:29', '2023-09-08 01:46:29'),
(39, '1', 'Dahi Papdi', '70', '99', '145', '2023-09-08 02:16:41', '2023-09-08 02:16:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
