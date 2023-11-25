-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 11:47 AM
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
(5, 'Chemicals');

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
  `item_expdate` date NOT NULL,
  `item_price` float NOT NULL,
  `item_category` varchar(50) NOT NULL,
  `item_date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items_db`
--

INSERT INTO `items_db` (`id`, `item_sku`, `item_barcode`, `item_name`, `item_stocks`, `item_expdate`, `item_price`, `item_category`, `item_date_added`) VALUES
(11, '231114CLF', 89765421368, 'LEMON SQUARE CHEESE CAKE 300g', 184, '2024-01-05', 60.5, 'Snacks', '2023-11-20'),
(12, '231114KTZ', 987561321858, 'CROSSINI 1PACK', 587, '2023-12-21', 11, 'Snacks', '2023-10-31'),
(13, '231115ZZR', 987561321858, 'CROSSINI 1PACK', 141, '2023-12-08', 49.5, 'Snacks', '2023-10-24'),
(15, '231115SXS', 89765421368, 'LEMON SQUARE CHEESE CAKE 300G', 333, '2023-11-30', 60.5, 'Canned Goods', '2023-11-15'),
(16, '231115YSN', 9876543215, 'piatoss', 50, '2023-12-16', 20.35, 'Snacks', '2023-11-15');

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
(1, 'The item LEMON SQUARE CHEESE CAKE 300g with the SKU of 231114CLF is expired', 1),
(2, 'The item CROSSINI 1PACK with the SKU of 231114KTZ is expired', 1),
(3, 'The item LEMON SQUARE CHEESE CAKE 20G with the SKU of 231115SXS is about to expire', 1),
(4, 'The item LEMON SQUARE CHEESE CAKE 300G with the SKU of 231115SXS is about to expire', 1),
(5, 'The item CROSSINI 1PACK with the SKU of 231115ZZR is about to expire', 0),
(6, 'The item piatoss with the SKU of 231115YSN is in reorder level', 1);

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
  `isBadOrder` tinyint(1) DEFAULT NULL,
  `vendor_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order_db`
--

INSERT INTO `purchase_order_db` (`po_item_sku`, `po_item_name`, `po_qty`, `po_uom`, `po_category`, `po_item_price`, `po_dot`, `po_expdelivery`, `is_delivered`, `isBadOrder`, `vendor_id`) VALUES
('231124WNU', 'Mang Inasal', 25, 'Tanga', 'Canned Goods', 700, '2023-11-24', '2023-12-02', 1, 0, 10001);

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

-- --------------------------------------------------------

--
-- Table structure for table `setting_db`
--

CREATE TABLE `setting_db` (
  `threshold` int(11) NOT NULL,
  `markup` float NOT NULL,
  `critical` int(11) NOT NULL,
  `average` int(11) NOT NULL,
  `reorder` int(11) NOT NULL,
  `stable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting_db`
--

INSERT INTO `setting_db` (`threshold`, `markup`, `critical`, `average`, `reorder`, `stable`) VALUES
(40, 10, 20, 70, 50, 150);

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
(0, 'Packs'),
(5, 'Boxes'),
(7, 'Cases');

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
  `vendor_contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors_db`
--

INSERT INTO `vendors_db` (`vendor_id`, `vendor_name`, `vendor_contact`) VALUES
(10001, 'Nhorlvick', 91492665);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `items_db`
--
ALTER TABLE `items_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notification_db`
--
ALTER TABLE `notification_db`
  MODIFY `notif_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales_db`
--
ALTER TABLE `sales_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users__db`
--
ALTER TABLE `users__db`
  MODIFY `acc_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendors_db`
--
ALTER TABLE `vendors_db`
  MODIFY `vendor_id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
