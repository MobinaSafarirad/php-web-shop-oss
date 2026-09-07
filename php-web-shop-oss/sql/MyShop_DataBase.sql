-- phpMyAdmin SQL Dump
-- version 5.2.3deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 07, 2026 at 09:32 PM
-- Server version: 8.4.10-0ubuntu0.26.04.1
-- PHP Version: 8.5.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myshop_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_persian_ci NOT NULL,
  `orderdate` date NOT NULL,
  `pro_code` int NOT NULL,
  `pro_qty` int NOT NULL,
  `pro_price` float NOT NULL,
  `pro_mobile` varchar(11) COLLATE utf8mb4_persian_ci NOT NULL,
  `address` varchar(400) COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_code` int NOT NULL,
  `pro_name` varchar(200) COLLATE utf8mb4_persian_ci NOT NULL,
  `pro_qty` int NOT NULL,
  `pro_price` float NOT NULL,
  `pro_image` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL,
  `pro_detail` text COLLATE utf8mb4_persian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_code`, `pro_name`, `pro_qty`, `pro_price`, `pro_image`, `pro_detail`) VALUES
(1330, 'shorts ', 100, 50, 'images/1788732364_4063.jpeg', 'If you like plain shorts these ones are the best, you might like them'),
(1331, 'Cotton cap', 200, 75, 'images/1788732386_5358.jpeg', 'If you\'re looking for an organic cotton cap check this one'),
(1332, 'Pants', 140, 150, 'images/1788732400_9943.jpeg', 'These are the best plain you could get'),
(1333, 'Grey T-shirt', 250, 100, 'images/1788732412_2176.jpeg', 'A plain grey T-shirt with nice material'),
(1334, 'Black T-shirt', 100, 150, 'images/1788732422_9821.jpeg', 'A nice and plain classic man T-shirt'),
(1335, 'Dark blue plain T-shirt bulk', 200, 160, 'images/1788732435_6641.jpeg', 'Buy men\'s plain half sleeve');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `realname` varchar(80) COLLATE utf8mb4_persian_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_persian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_persian_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_persian_ci NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`realname`, `username`, `password`, `email`, `role`) VALUES
('admin', 'myshop_user', '1234', 'admin@myshop.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_code` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1337;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
