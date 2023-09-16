-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 15, 2023 at 06:08 PM
-- Server version: 8.0.34-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juncathytest`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_db`
--

CREATE TABLE `category_db` (
  `id` int NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_db`
--

INSERT INTO `category_db` (`id`, `category_name`) VALUES
(1, 'Canned Goods'),
(2, 'Drinks'),
(3, 'Necessities');

-- --------------------------------------------------------

--
-- Table structure for table `items_db`
--

CREATE TABLE `items_db` (
  `id` bigint NOT NULL,
  `sku` bigint NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `qty` int NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items_db`
--

INSERT INTO `items_db` (`id`, `sku`, `item_name`, `qty`, `price`) VALUES
(1, 32455, 'piattos', 365, 12),
(2, 1032155, 'martys', 55, 8),
(3, 321569879, 'cock', 78, 27),
(4, 56468798721, 'pepsi paloma', 45, 30);

-- --------------------------------------------------------

--
-- Table structure for table `uom_db`
--

CREATE TABLE `uom_db` (
  `id` bigint NOT NULL,
  `uom_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uom_db`
--

INSERT INTO `uom_db` (`id`, `uom_name`) VALUES
(1, 'Liters'),
(2, 'Dozen'),
(3, 'Pieces');

-- --------------------------------------------------------

--
-- Table structure for table `users__db`
--

CREATE TABLE `users__db` (
  `id` bigint NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass_word` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users__db`
--

INSERT INTO `users__db` (`id`, `user_name`, `email`, `pass_word`, `is_admin`) VALUES
(1, 'admin_user', 'hello@admin.ph', '5d41402abc4b2a76b9719d911017c592', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_db`
--
ALTER TABLE `category_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_db`
--
ALTER TABLE `items_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uom_db`
--
ALTER TABLE `uom_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users__db`
--
ALTER TABLE `users__db`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_db`
--
ALTER TABLE `category_db`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items_db`
--
ALTER TABLE `items_db`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uom_db`
--
ALTER TABLE `uom_db`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users__db`
--
ALTER TABLE `users__db`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
