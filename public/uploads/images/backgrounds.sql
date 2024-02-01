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
-- Table structure for table `backgrounds`
--

DROP TABLE IF EXISTS `backgrounds`;
CREATE TABLE IF NOT EXISTS `backgrounds` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backgrounds`
--

INSERT INTO `backgrounds` (`id`, `image`, `color`, `created_at`, `updated_at`) VALUES
(23, 'uploads/download (4).jpeg', 'White', '2023-09-07 05:00:49', '2023-09-07 05:00:49'),
(19, 'uploads/preview.jpg', 'white', '2023-09-07 01:51:13', '2023-09-07 01:51:13'),
(20, 'uploads/menu1.jpg', '#fff', '2023-09-07 01:53:51', '2023-09-07 01:53:51'),
(21, 'uploads/download123.jpeg', 'white', '2023-09-07 02:58:37', '2023-09-07 02:58:37'),
(22, 'uploads/WhatsApp Image 2023-09-07 at 14.12.10.jpg', 'White', '2023-09-07 03:12:45', '2023-09-07 03:12:45'),
(5, 'uploads/menu2.jpg', 'red', '2023-09-05 02:21:19', '2023-09-05 02:21:19'),
(1, 'uploads/images (1).jpeg', 'black', '2023-09-05 01:37:11', '2023-09-05 01:37:11'),
(2, 'uploads/download (2).jpeg', 'black', '2023-09-05 01:37:20', '2023-09-05 01:37:20'),
(3, 'uploads/halloween-party.jpg', 'white', '2023-09-05 02:00:19', '2023-09-05 02:00:19');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
