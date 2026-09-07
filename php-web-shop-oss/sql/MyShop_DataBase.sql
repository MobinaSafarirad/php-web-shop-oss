-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 02, 2026 at 11:00 AM
-- Server version: 11.5.2-MariaDB
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Database: `myshop_database`
-- --------------------------------------------------------

-- --------------------------------------------------------
-- Table structure for table `orders`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `orderdate` date NOT NULL,
  `pro_code` int(10) NOT NULL,
  `pro_qty` int(10) NOT NULL,
  `pro_price` float NOT NULL,
  `pro_mobile` varchar(11) NOT NULL,
  `address` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample order data
INSERT INTO `orders` (`id`, `username`, `orderdate`, `pro_code`, `pro_qty`, `pro_price`, `pro_mobile`, `address`) VALUES
(36, 'Jadi Mirmirani', '2026-05-21', 1321, 1, 900000, '03902145842', 'Tehran, Main Street, No. 123'),
(35, 'Aisa Safarirad', '2026-05-20', 1320, 1, 750000, '09927448039', 'Shiraz, Darayi Town'),
(34, 'Aisa Safarirad', '2026-05-20', 1318, 1, 1500000, '09927448039', 'Fars Province, Shiraz, Darayi Town'),
(33, 'Elnaz Razavi', '2026-05-20', 1317, 1, 899000, '09924570236', 'Fars Province, Shiraz, Valfajr Town'),
(32, 'Samer Ashrafi', '2026-05-20', 1318, 1, 1500000, '09108745032', 'Alborz Province, Karaj, Gohardasht Town'),
(31, 'Samer Ashrafi', '2026-05-20', 1318, 1, 1500000, '09108745032', 'Alborz Province, Karaj, Gohardasht Town'),
(30, 'Samer Ashrafi', '2026-05-20', 1319, 1, 2000000, '09108745032', 'Alborz Province, Karaj, Gohardasht Town'),
(29, 'Samer Ashrafi', '2026-05-20', 1321, 1, 900000, '09108745032', 'Alborz Province, Karaj, Gohardasht Town'),
(28, 'Elnaz Razavi', '2026-05-20', 1318, 1, 1500000, '09924570236', 'Fars Province, Shiraz, Valfajr Town'),
(27, 'Melina Asadi', '2026-05-19', 1317, 1, 899000, '09984562030', 'Fars, Shiraz, Farhangian Town'),
(26, 'Melina Asadi', '2026-05-19', 1316, 1, 166000, '09984562030', 'Fars, Shiraz, Farhangian Town'),
(25, 'Melina Asadi', '2026-05-19', 1315, 1, 850000, '09984562030', 'Fars, Shiraz, Farhangian Town'),
(24, 'Mobina Safarirad', '2026-05-19', 1321, 1, 900000, '09927448039', 'Fars, Shiraz, Darayi Town'),
(37, 'Jadi Mirmirani', '2026-06-02', 1316, 1, 166000, '03902145842', 'Tehran'),
(38, 'Jadi Mirmirani', '2026-06-02', 1321, 1, 900000, '03902145842', 'Tehran'),
(39, 'Jadi Mirmirani', '2026-06-02', 1320, 3, 750000, '03902145842', 'Tehran'),
(40, 'Radman Razavi', '2026-07-02', 1319, 1, 2000000, '09925847145', 'Shiraz, Kuch Street, Alley 11, No. 3'),
(41, 'Radman Razavi', '2026-07-02', 1316, 1, 166000, '09925847145', 'Shiraz, Kuch Street, Alley 11, No. 3'),
(42, 'Radman Razavi', '2026-07-02', 1321, 1, 900000, '09925847145', 'Shiraz, Kuch Street, Alley 11, No. 3'),
(43, 'Mobina Safarirad', '2026-07-02', 1318, 1, 1500000, '09927448039', 'Shiraz, District 9, Darayi Town .....'),
(44, 'Parham Dadkhah', '2026-07-02', 1321, 1, 900000, '09175843697', 'Isfahan, Shahid Vafaei Street, Alley 12, No. 325'),
(45, 'Parham Dadkhah', '2026-07-02', 1323, 1, 1250000, '09175843697', 'Isfahan, Shahid Vafaei Street, Alley 12, No. 325'),
(46, 'Diana Mowsuli', '2026-07-02', 1323, 1, 1250000, '09932581476', 'Shiraz, Valfajr Town, Narges Street, Alley 11, left side, 7th door');

-- --------------------------------------------------------
-- Table structure for table `products`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `pro_code` int(10) NOT NULL AUTO_INCREMENT,
  `pro_name` varchar(200) NOT NULL,
  `pro_qty` int(10) NOT NULL,
  `pro_price` float NOT NULL,
  `pro_image` varchar(80) NOT NULL,
  `pro_detail` text NOT NULL,
  PRIMARY KEY (`pro_code`)
) ENGINE=MyISAM AUTO_INCREMENT=1327 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample product data
INSERT INTO `products` (`pro_code`, `pro_name`, `pro_qty`, `pro_price`, `pro_image`, `pro_detail`) VALUES
(1315, 'PHP Educational Book', 247, 850000, 'images/1781986082_4460.png', 'If you are looking to learn PHP from scratch, this book is definitely for you.'),
(1317, 'JavaScript Educational Book', 198, 899000, 'images/1779205112_1581.png', 'JavaScript is a flexible programming language that offers many tools for developers.'),
(1318, 'ICDL Training Package', 495, 1500000, 'images/1779206650_3963.png', 'Computer basics are essential skills in today\'s world. Don\'t miss this package.'),
(1319, 'Computer 0-100 Package', 440, 2000000, 'images/1779206811_9504.png', 'If you are interested in computers and learning, this package is a must-have.'),
(1320, 'Excel Training Package', 196, 750000, 'images/1779207124_4539.png', 'Excel has become an essential skill in many offices and organizations. Knowing it gives you a competitive edge on your resume.'),
(1321, 'Linux OS Training Package', 647, 900000, 'images/1779212579_1210.png', 'Linux is an operating system like Windows and Mac. It manages hardware resources like CPU, RAM, and memory. In fact, Android, one of the world\'s most popular platforms, is powered by Linux.'),
(1322, 'Computer Data Science Package', 100, 1850000, 'images/1779429739_3455.png', 'If you are interested in computer science or studying in this field, this package is designed to make you more professional.'),
(1325, 'Windows 11 Training Package', 120, 1585000, 'images/1782983823_7044.png', 'Windows 11 is the latest version of Microsoft\'s operating system, officially released on June 24, 2021.'),
(1326, 'Rhino Software Training Package', 50, 800000, 'images/1782984014_4961.png', 'Rhino is a precise 3D CAD modeling software, known for its ability to create complex forms and organic curves, making it a primary tool for architects and industrial designers.');

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `realname` varchar(80) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Sample user data
INSERT INTO `users` (`realname`, `username`, `password`, `email`, `role`) VALUES
('Site Admin', 'admin', '1234', 'admin@myshop.com', 1),
('Betty', 'bet', 'habibti', 'betty@gmail.com', 0);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
