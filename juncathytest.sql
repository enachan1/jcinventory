-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 02:09 PM
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
  `item_date_added` date DEFAULT NULL,
  `sales` int(11) NOT NULL,
  `stable` int(11) NOT NULL,
  `average` int(11) NOT NULL,
  `reorder` int(11) NOT NULL,
  `critical` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items_db`
--

INSERT INTO `items_db` (`id`, `item_sku`, `item_barcode`, `item_name`, `item_stocks`, `item_expdate`, `item_price`, `item_category`, `item_date_added`, `sales`, `stable`, `average`, `reorder`, `critical`) VALUES
(8, '240109MGP', 4204785633234, 'Piattos BBQ Flavor 20g', 14, '2024-01-18', 24.15, 'Snacks', '2024-01-09', 50, 150, 80, 50, 25);

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
(1, 'The item Cream O choco filled with the SKU of 231206QZJ is expired', 1),
(2, 'The item Cream O Vanilla Filled with the SKU of 231206EBD is expired', 1),
(3, 'The item PIATTOS CHEESE 85G with the SKU of 231208JNI is about to expire', 1),
(4, 'The item PIATTOS CHEESE 85G with the SKU of 231208WQQ is about to expire', 1),
(5, 'The item Nestea Lemon with the SKU of 231206LGL is expired', 1),
(6, 'The item Hansel Chocolate Sandwich with the SKU of 231206NSV is about to expire', 1),
(7, 'The item PIATTOS CHEESE 85G with the SKU of 231208JNI is expired', 1),
(8, 'The item PIATTOS CHEESE 85G with the SKU of 231208WQQ is expired', 1),
(9, 'The item hi with the SKU of 231215RRQ is about to expire', 1),
(10, 'The item man inasal with the SKU of 231216TEG is about to expire', 1),
(11, 'The item suka with the SKU of 231216GUX is in reorder level', 1),
(12, 'The item suka with the SKU of 231216SUY is in reorder level', 1),
(13, 'The item Piattos BBQ Flavor 20g with the SKU of 240109MGP is in critical level', 0),
(14, 'The item Piattos BBQ Flavor 20g with the SKU of 240109MGP is about to expire', 0);

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

--
-- Dumping data for table `purchase_order_db`
--

INSERT INTO `purchase_order_db` (`po_item_sku`, `po_item_name`, `po_qty`, `po_uom`, `po_category`, `po_item_price`, `po_dot`, `po_expdelivery`, `is_delivered`, `inventory_in`, `vendor_id`) VALUES
('240109UYR', 'TAHOOS', 23, 'Packs', 'Snacks', 2435, '2024-01-09', '2024-03-02', 1, 0, 10002),
('240109ZVI', 'PIATTOS', 23, 'Boxes', 'Snacks', 5553, '2024-01-09', '2024-03-02', 1, 0, 10002),
('240109ZPE', 'tit', 23, 'Boxes', 'Necessities', 4655, '2024-01-09', '2024-02-10', NULL, 0, 10003),
('240109HFU', 'asdasdq', 23, 'Boxes', 'Canned Goods', 3461, '2024-01-09', '2024-02-10', NULL, 0, 10003);

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
(1, 4204785633234, 'Piattos BBQ Flavor 20g', 15, 362.25, '2024-01-09 14:48:09', 'JUNCATHYR20240109074809', 9),
(2, 4204785633234, 'Piattos BBQ Flavor 20g', 1, 24.15, '2024-01-09 20:49:34', 'JUNCATHYR20240109134934', 9);

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
(300, 20, 70, 50, 150);

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
('JUNCATHYR20240109074809', '2024-01-09 14:48:09', 15, 405.72, 9),
('JUNCATHYR20240109134934', '2024-01-09 20:49:34', 1, 27.05, 9);

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
(1, 'admin', 'admin@admin.com', '$2y$10$IUtKkXUw/QcY0AqjzvEP1OUTY95mA.FSnNrBMA92uOmhr07VHlFki', 0, 1),
(9, 'cashier', 'cashier@cashier.com', '$2y$10$SYbmI7.5m8Ayv7v8L5y/tuCFZwRUU2l60ZqiOUuMvS0nw7.QrDd8G', 0, 0);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification_db`
--
ALTER TABLE `notification_db`
  MODIFY `notif_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales_db`
--
ALTER TABLE `sales_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uom_db`
--
ALTER TABLE `uom_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users__db`
--
ALTER TABLE `users__db`
  MODIFY `acc_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vendors_db`
--
ALTER TABLE `vendors_db`
  MODIFY `vendor_id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10007;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
