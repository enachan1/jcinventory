-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2023 at 09:35 AM
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
  `item_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items_db`
--

INSERT INTO `items_db` (`id`, `item_sku`, `item_barcode`, `item_name`, `item_stocks`, `item_expdate`, `item_price`, `item_category`) VALUES
(1, 'LULUMOPANOT', 654897561321, 'Coca Cola Mismo', 100, '2023-11-29', 27, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_db`
--

CREATE TABLE `purchase_db` (
  `id` bigint(20) NOT NULL,
  `p_sku` bigint(30) NOT NULL,
  `p_itemname` varchar(255) NOT NULL,
  `p_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('', 'asfdsf', 23, 'Boxes', 'Canned Goods', 32, '2023-10-25', '2023-10-31', NULL, NULL, 10001),
('231028JXQ', 'piatoss', 2, 'Boxes', 'Canned Goods', 120, '2023-10-28', '2023-10-30', NULL, NULL, 10004),
('231028NQC', 'energen', 1, 'Boxes', 'Canned Goods', 14, '2023-10-28', '2023-10-31', NULL, NULL, 10001),
('231028SSO', 'asfdsf', 1, 'Boxes', 'Canned Goods', 14, '2023-10-28', '2023-10-31', NULL, NULL, 10001),
('231028MYE', 'asfdsf', 1, 'Boxes', 'Canned Goods', 14, '2023-10-28', '2023-10-31', NULL, NULL, 10001),
('231028YKT', 'asfdsf', 1, 'Boxes', 'Canned Goods', 14, '2023-10-28', '2023-10-31', NULL, NULL, 10001),
('231028TDO', 'energen', 1, 'Boxes', 'Canned Goods', 14, '2023-10-28', '2023-10-31', NULL, NULL, 10001);

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
  `s_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_db`
--

INSERT INTO `sales_db` (`id`, `s_sku`, `s_item`, `s_qty`, `s_total`, `s_date`) VALUES
(1, 89456456123, 'toblerone', 1, 26, '2023-10-25'),
(2, 89456456123, 'toblerone', 1, 26, '2023-10-25'),
(3, 89456456123, 'toblerone', 1, 26, '2023-10-25'),
(4, 89456456123, 'toblerone', 1, 26, '2023-10-25'),
(5, 23568775126, 'Coca Cola Mismo', 1, 15, '2023-10-25'),
(6, 89456456123, 'toblerone', 3, 78, '2023-10-26'),
(7, 23568775126, 'Coca Cola Mismo', 3, 45, '2023-10-26'),
(8, 89456456123, 'toblerone', 3, 78, '2023-10-26'),
(9, 25458976321, 'Piattos', 2, 38, '2023-10-26'),
(22, 25458976321, 'Piattos', 1, 19, '2023-10-26'),
(23, 89456456123, 'toblerone', 1, 26, '2023-10-26'),
(24, 23568775126, 'Coca Cola Mismo', 5, 75, '2023-10-26'),
(25, 89456456123, 'toblerone', 3, 78, '2023-10-26'),
(26, 25458976321, 'Piattos', 2, 38, '2023-10-26'),
(27, 23568775126, 'Coca Cola Mismo', 1, 15, '2023-10-28'),
(28, 23568775126, 'Coca Cola Mismo', 1, 15, '2023-10-28'),
(29, 89456456123, 'toblerone', 1, 26, '2023-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_db`
--

CREATE TABLE `transaction_db` (
  `reciept_no` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `total_item` int(11) NOT NULL,
  `overall_amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_db`
--

INSERT INTO `transaction_db` (`reciept_no`, `transaction_date`, `total_item`, `overall_amount`) VALUES
('juncathyr20231026062720', '2023-10-26', 2, 45),
('juncathyr20231026063026', '2023-10-26', 10, 191),
('juncathyr20231028082611', '2023-10-28', 1, 15),
('juncathyr20231028115524', '2023-10-28', 1, 15),
('juncathyr20231028121831', '2023-10-28', 1, 26);

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
(5, 'Boxes');

-- --------------------------------------------------------

--
-- Table structure for table `users__db`
--

CREATE TABLE `users__db` (
  `id` bigint(20) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass_word` varchar(255) NOT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users__db`
--

INSERT INTO `users__db` (`id`, `user_name`, `email`, `pass_word`, `contact_no`, `is_admin`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$G8aqIVH39MA8FWmfN7e2FewYWYJ7smOlu/yp3Kferk1VsUIwgrYm6', 0, 1),
(2, 'cashier', 'notadmin@notadmin.com', '$2y$10$srTH9HwBVOhWeXmEkMVRCOc5uA10C.7KEjbQLPVcC5AlToknX3/kS', 0, 0),
(9, ' ena', 'em@em.com', '$2y$10$EIPBDSMpQ9VMIa2y2wuh0OST.Z0Pb4NMMTJZMekRQHSLQLAfvUCfC', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendors_db`
--

CREATE TABLE `vendors_db` (
  `vendor_id` bigint(20) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors_db`
--

INSERT INTO `vendors_db` (`vendor_id`, `vendor_name`, `vendor_contact`) VALUES
(10001, 'vendor2', 123456),
(10002, 'xijinping', 2147483647),
(10003, 'vladimir', 6589443),
(10004, 'haheds', 2147483647);

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
-- Indexes for table `purchase_db`
--
ALTER TABLE `purchase_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_db`
--
ALTER TABLE `purchase_order_db`
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `sales_db`
--
ALTER TABLE `sales_db`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_db`
--
ALTER TABLE `purchase_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_db`
--
ALTER TABLE `sales_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `uom_db`
--
ALTER TABLE `uom_db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users__db`
--
ALTER TABLE `users__db`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase_order_db`
--
ALTER TABLE `purchase_order_db`
  ADD CONSTRAINT `purchase_order_db_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors_db` (`vendor_id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
