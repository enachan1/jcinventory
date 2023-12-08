-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 11:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_db`
--

INSERT INTO `category_db` (`id`, `category_name`) VALUES
(1, 'Canned Goods'),
(2, 'Drinks'),
(3, 'Necessities'),
(4, 'Snacks'),
(5, 'Chemicals'),
(16, 'Biscuits'),
(17, 'Powdered Drink'),
(18, 'Noodles'),
(19, 'Candy'),
(21, 'Soap');

-- --------------------------------------------------------

--
-- Table structure for table `items_db`
--

CREATE TABLE `items_db` (
  `id` bigint(20) NOT NULL,
  `item_sku` varchar(255) NOT NULL,
  `item_barcode` bigint(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_stocks` int(11) NOT NULL,
  `item_expdate` date DEFAULT NULL,
  `item_price` float NOT NULL,
  `item_category` varchar(50) NOT NULL,
  `item_date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items_db`
--

INSERT INTO `items_db` (`id`, `item_sku`, `item_barcode`, `item_name`, `item_stocks`, `item_expdate`, `item_price`, `item_category`, `item_date_added`) VALUES
(1, '231206QZJ', 4800010075243, 'Cream O choco filled', 244, '2023-12-06', 8.8, 'Biscuits', '2023-12-06'),
(2, '231206EBD', 4800010075069, 'Cream O Vanilla Filled', 30, '2023-11-24', 8.4, 'Biscuits', '2023-12-06'),
(3, '231206OVR', 4806521795021, 'Donut Time', 249, '2024-05-31', 10.5, 'Snacks', '2023-12-06'),
(4, '231206LGL', 4800361379557, 'Nestea Lemon', 60, '2024-03-30', 25.2, 'Powdered Drink', '2023-12-06'),
(5, '231206NSV', 4800092113307, 'Hansel Chocolate Sandwich', 254, '2024-08-31', 8.07, 'Powdered Drink', '2023-12-06'),
(6, '231206FAZ', 4800811156899, 'ANGIES GUMMY BERRIES', 98, '2026-12-31', 43.05, 'Snacks', '2023-12-06'),
(7, '231206RAK', 4800016560910, 'NISSIN RAMEN SPICY SEAFOOD', 252, '2024-04-30', 24.15, 'Noodles', '2023-12-06'),
(8, '231206GRG', 4800016555985, 'XTRA BIG KALAMANSI', 254, '2024-05-03', 17.12, 'Noodles', '2023-12-06'),
(9, '231206OGC', 4800361416726, 'NESCAFE CREAMY WHITE', 253, '2024-04-05', 15.75, 'Powdered Drink', '2023-12-06'),
(10, '231206OYI', 4800361410816, 'BEAR BRAND FORTIFIED MILK', 239, '2024-04-06', 12.08, 'Powdered Drink', '2023-12-06'),
(11, '231208JNI', 4800016644504, 'PIATTOS CHEESE 85G', 255, '2023-12-09', 20, 'Snacks', '2023-12-08'),
(12, '231208WQQ', 4800016644504, 'PIATTOS CHEESE 85G', 255, '2023-12-13', 20, 'Snacks', '2023-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `notification_db`
--

CREATE TABLE `notification_db` (
  `notif_id` bigint(20) NOT NULL,
  `message` varchar(355) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_db`
--

INSERT INTO `notification_db` (`notif_id`, `message`, `is_deleted`) VALUES
(1, 'The item PIATTOS CHEESE 85G with the SKU of 231208JNI is expired', 0),
(2, 'The item PIATTOS CHEESE 85G with the SKU of 231208JNI is about to expire', 0),
(3, 'The item Cream O choco filled with the SKU of 231206QZJ is expired', 0),
(4, 'The item Cream O Vanilla Filled with the SKU of 231206EBD is expired', 0),
(5, 'The item PIATTOS CHEESE 85G with the SKU of 231208WQQ is about to expire', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_db`
--

CREATE TABLE `purchase_order_db` (
  `po_item_sku` varchar(255) NOT NULL,
  `po_item_name` varchar(255) NOT NULL,
  `po_qty` float NOT NULL,
  `po_uom` varchar(255) NOT NULL,
  `po_category` varchar(255) NOT NULL,
  `po_item_price` double NOT NULL,
  `po_dot` date NOT NULL,
  `po_expdelivery` date NOT NULL,
  `is_delivered` tinyint(1) DEFAULT NULL,
  `inventory_in` tinyint(1) DEFAULT NULL,
  `vendor_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_db`
--

CREATE TABLE `sales_db` (
  `id` bigint(20) NOT NULL,
  `s_sku` bigint(50) NOT NULL,
  `s_item` varchar(255) NOT NULL,
  `s_qty` float NOT NULL,
  `s_total` float NOT NULL,
  `s_date` datetime NOT NULL,
  `reciept_no` varchar(255) NOT NULL,
  `acc_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_db`
--

INSERT INTO `sales_db` (`id`, `s_sku`, `s_item`, `s_qty`, `s_total`, `s_date`, `reciept_no`, `acc_id`) VALUES
(1, 4800010075069, 'Cream O Vanilla Filled', 4, 33.6, '2023-12-06 12:55:06', 'JUNCATHYR20231206055506', 5),
(2, 4800361379557, 'Nestea Lemon', 6, 151.2, '2023-12-06 12:55:06', 'JUNCATHYR20231206055506', 5),
(3, 4806521795021, 'Donut Time', 5, 52.5, '2023-12-06 12:55:06', 'JUNCATHYR20231206055506', 5),
(4, 4800010075243, 'Cream O choco filled', 1, 8.8, '2023-12-06 12:55:06', 'JUNCATHYR20231206055506', 5),
(5, 4800811156899, 'ANGIES GUMMY BERRIES', 2, 86.1, '2023-12-06 12:55:06', 'JUNCATHYR20231206055506', 5),
(6, 4800092113307, 'Hansel Chocolate Sandwich', 1, 8.07, '2023-12-06 12:55:06', 'JUNCATHYR20231206055506', 5),
(7, 4800016560910, 'NISSIN RAMEN SPICY SEAFOOD', 2, 48.3, '2023-12-06 12:55:06', 'JUNCATHYR20231206055506', 5),
(8, 4800361410816, 'BEAR BRAND FORTIFIED MILK', 1, 12.08, '2023-12-06 12:55:06', 'JUNCATHYR20231206055506', 5),
(9, 4800361416726, 'NESCAFE CREAMY WHITE', 1, 15.75, '2023-12-06 12:55:06', 'JUNCATHYR20231206055506', 5),
(10, 4800016555985, 'XTRA BIG KALAMANSI', 1, 17.12, '2023-12-06 12:55:06', 'JUNCATHYR20231206055506', 5),
(11, 4800361379557, 'Nestea Lemon', 3, 75.6, '2023-12-06 12:57:30', 'JUNCATHYR20231206055730', 5),
(12, 4800010075069, 'Cream O Vanilla Filled', 8, 67.2, '2023-12-06 12:57:30', 'JUNCATHYR20231206055730', 5),
(13, 4806521795021, 'Donut Time', 1, 10.5, '2023-12-06 12:57:30', 'JUNCATHYR20231206055730', 5),
(14, 4800361416726, 'NESCAFE CREAMY WHITE', 1, 15.75, '2023-12-06 12:57:30', 'JUNCATHYR20231206055730', 5),
(15, 4800361410816, 'BEAR BRAND FORTIFIED MILK', 15, 181.2, '2023-12-06 12:59:37', 'JUNCATHYR20231206055937', 5),
(16, 4800010075243, 'Cream O choco filled', 10, 88, '2023-12-06 13:00:23', 'JUNCATHYR20231206060023', 5),
(17, 4800016560910, 'NISSIN RAMEN SPICY SEAFOOD', 1, 24.15, '2023-12-08 16:53:07', 'JUNCATHYR20231208095307', 5);

-- --------------------------------------------------------

--
-- Table structure for table `setting_db`
--

CREATE TABLE `setting_db` (
  `threshold` int(11) NOT NULL,
  `critical` int(11) NOT NULL,
  `average` int(11) NOT NULL,
  `reorder` int(11) NOT NULL,
  `stable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting_db`
--

INSERT INTO `setting_db` (`threshold`, `critical`, `average`, `reorder`, `stable`) VALUES
(50, 20, 70, 50, 150);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_db`
--

CREATE TABLE `transaction_db` (
  `reciept_no` varchar(255) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `total_item` int(11) NOT NULL,
  `overall_amount` float NOT NULL,
  `acc_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_db`
--

INSERT INTO `transaction_db` (`reciept_no`, `transaction_date`, `total_item`, `overall_amount`, `acc_id`) VALUES
('JUNCATHYR20231206055506', '2023-12-06 12:55:06', 24, 485.54, 5),
('JUNCATHYR20231206055730', '2023-12-06 12:57:30', 13, 189.34, 5),
('JUNCATHYR20231206055937', '2023-12-06 12:59:37', 15, 202.94, 5),
('JUNCATHYR20231206060023', '2023-12-06 13:00:23', 10, 98.56, 5),
('JUNCATHYR20231208095307', '2023-12-08 16:53:07', 1, 27.05, 5);

-- --------------------------------------------------------

--
-- Table structure for table `uom_db`
--

CREATE TABLE `uom_db` (
  `id` bigint(20) NOT NULL,
  `uom_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uom_db`
--

INSERT INTO `uom_db` (`id`, `uom_name`) VALUES
(1, 'Boxes'),
(2, 'Cases'),
(3, 'Packs'),
(5, 'Gallons');

-- --------------------------------------------------------

--
-- Table structure for table `users__db`
--

CREATE TABLE `users__db` (
  `acc_id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass_word` varchar(255) NOT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users__db`
--

INSERT INTO `users__db` (`acc_id`, `user_name`, `email`, `pass_word`, `contact_no`, `is_admin`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$CzzLKx87QEgkQzq5gJh3.uo7g5knkdFCv.2oQEyVu3wZR3xd.dCBu', 0, 1),
(2, 'cashier', 'notadmin@notadmin.com', '$2y$10$srTH9HwBVOhWeXmEkMVRCOc5uA10C.7KEjbQLPVcC5AlToknX3/kS', 0, 0),
(5, 'Carlo', 'carlo@gmail.com', '$2y$10$ldK3ogolhUOUNouMUpW9pOvHyrdjUD3zLyfOdAqSGN1qHV8WJP8ua', 0, 0),
(7, 'kohaku', 'kohaku@gmail.com', '$2y$10$YqeqhRuHPeTis01Gzx9t9.3iRh3ZXNc/hW2/xSBogPcjJYgacuuPu', 0, 1),
(8, 'Nhorlvick', 'nhrlvck@gmail.com', '$2y$10$mJnLIf4.kR22nUQxvq5tpuVJwdy6vZDHxkO8mRlGlP0qAalQmSf5u', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendors_db`
--

CREATE TABLE `vendors_db` (
  `vendor_id` bigint(50) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_contact` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors_db`
--

INSERT INTO `vendors_db` (`vendor_id`, `vendor_name`, `vendor_contact`) VALUES
(10001, 'Nhorlvick', 91492665),
(10002, 'CHIPS CO', 2147483647),
(10003, 'San Miguels', 2147483647),
(10004, 'Lawrence', 2147483647),
(10005, 'Carlo', 919276513),
(10006, 'Paul', 91928854652);

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
-- Indexes for table `notification_db`
--
ALTER TABLE `notification_db`
  ADD PRIMARY KEY (`notif_id`),
  ADD UNIQUE KEY `message` (`message`);

--
-- Indexes for table `purchase_order_db`
--
ALTER TABLE `purchase_order_db`
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `sales_db`
--
ALTER TABLE `sales_db`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_db_ibfk_1` (`reciept_no`);

--
-- Indexes for table `transaction_db`
--
ALTER TABLE `transaction_db`
  ADD PRIMARY KEY (`reciept_no`);

--
-- Indexes for table `uom_db`
--
ALTER TABLE `uom_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users__db`
--
ALTER TABLE `users__db`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `vendors_db`
--
ALTER TABLE `vendors_db`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_db`
--
ALTER TABLE `category_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `items_db`
--
ALTER TABLE `items_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notification_db`
--
ALTER TABLE `notification_db`
  MODIFY `notif_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_db`
--
ALTER TABLE `sales_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `uom_db`
--
ALTER TABLE `uom_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users__db`
--
ALTER TABLE `users__db`
  MODIFY `acc_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendors_db`
--
ALTER TABLE `vendors_db`
  MODIFY `vendor_id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10007;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
