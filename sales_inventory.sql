-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 24, 2018 at 05:06 PM
-- Server version: 8.0.12
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `middle_name` varchar(35) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `last_name` varchar(35) NOT NULL,
  `cellphone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `telephone_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=good, 2=bogus'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `middle_name`, `last_name`, `cellphone_number`, `telephone_number`, `facebook_link`, `created_at`, `status`) VALUES
(1, 'test', NULL, 'test', NULL, NULL, NULL, '2018-11-24 08:46:04', 1),
(2, 'ok', NULL, 'ok', NULL, NULL, 'ok', '2018-11-24 09:03:06', 1),
(3, 'tete', NULL, 'tete', NULL, NULL, 'tet', '2018-11-24 09:04:49', 1),
(4, 'erew', NULL, '5435', NULL, NULL, '654654', '2018-11-24 09:05:02', 1),
(5, 'rewrw', NULL, 'rewr', NULL, NULL, 'rewrw', '2018-11-24 09:06:26', 1),
(6, 'dane', NULL, 'dave', NULL, NULL, NULL, '2018-11-24 09:53:53', 1),
(7, 'ew', NULL, 'r', NULL, NULL, 'r', '2018-11-24 09:54:00', 1),
(8, '545', NULL, '343', NULL, NULL, '43', '2018-11-24 09:54:07', 1),
(9, 'udu', NULL, 'udu', NULL, NULL, NULL, '2018-11-24 09:56:53', 1),
(10, 'ardi2', NULL, 'cruz2', NULL, NULL, NULL, '2018-11-24 10:00:01', 1),
(11, 'ew', NULL, '55', NULL, NULL, '5', '2018-11-24 10:01:33', 1),
(12, '123', NULL, '4324', NULL, NULL, NULL, '2018-11-24 10:02:34', 1),
(13, '54', NULL, '545', NULL, NULL, NULL, '2018-11-24 10:02:50', 1),
(14, '54', NULL, '5', NULL, NULL, NULL, '2018-11-24 10:03:13', 1),
(15, 'ohno', NULL, 'nono', NULL, NULL, NULL, '2018-11-24 10:03:59', 1),
(16, '34', NULL, '4', NULL, NULL, NULL, '2018-11-24 10:04:05', 1),
(17, 'CANELLL', NULL, 'RERER', NULL, NULL, NULL, '2018-11-24 10:07:19', 1),
(18, 'Dane Dave', NULL, 'LLorera', NULL, NULL, NULL, '2018-11-24 10:28:07', 1),
(19, 'dadada', NULL, 'dadada', NULL, NULL, 'dadadad', '2018-11-24 10:30:03', 1),
(20, 'dsd', NULL, 'dsd', NULL, NULL, 'ddw', '2018-11-24 11:58:10', 1),
(21, 'lastone', NULL, 'lastone', NULL, NULL, 'lastone', '2018-11-24 11:59:31', 1),
(22, 'eee', NULL, 'eee', NULL, NULL, 'eee', '2018-11-24 12:00:22', 1),
(23, 'oneone', NULL, 'oneone', NULL, NULL, 'oneone', '2018-11-24 12:05:04', 1),
(24, 'ewe', NULL, 'ewew', NULL, NULL, 'ewe', '2018-11-24 12:06:06', 1),
(25, 'ewew', NULL, 'ewew', NULL, NULL, 'ewew', '2018-11-24 12:06:24', 1),
(26, '34', NULL, '4343', NULL, NULL, '4343', '2018-11-24 12:06:29', 1),
(27, '232', NULL, '323', NULL, NULL, '22', '2018-11-24 12:06:32', 1),
(28, '434', NULL, '434', NULL, NULL, '434', '2018-11-24 12:06:51', 1),
(29, 'wew', NULL, 'ewe', NULL, NULL, 'ew', '2018-11-24 12:40:06', 1),
(30, 'dione', NULL, 'dion', NULL, NULL, 'wee', '2018-11-24 14:18:07', 1),
(31, 'akopo', NULL, 'si inday', NULL, NULL, NULL, '2018-11-24 14:18:21', 1),
(32, '5445', NULL, '434', NULL, NULL, '54', '2018-11-24 16:41:09', 1),
(33, '1321', NULL, '1231', NULL, NULL, '32131', '2018-11-24 16:41:15', 1),
(34, '101010', NULL, '101010', NULL, NULL, '10101', '2018-11-24 17:02:47', 1),
(35, '6565', NULL, '6565', NULL, NULL, '6565', '2018-11-24 17:04:08', 1),
(36, '54', NULL, '54', NULL, NULL, '545', '2018-11-24 17:04:17', 1),
(37, '4324', NULL, '23423', NULL, NULL, '43242', '2018-11-24 17:04:40', 1),
(38, '5345', NULL, '43534', NULL, NULL, '5435', '2018-11-24 17:04:46', 1),
(39, '654654', NULL, '6546', NULL, NULL, '6546', '2018-11-24 17:04:52', 1),
(40, '432', NULL, '432', NULL, NULL, '432', '2018-11-24 17:04:55', 1),
(41, '34534', NULL, '545', NULL, NULL, 't4', '2018-11-24 17:04:59', 1),
(42, 'hhhqget1gre', NULL, 'dw', NULL, NULL, NULL, '2018-11-24 17:05:05', 1),
(43, '54354', NULL, '4343', NULL, NULL, NULL, '2018-11-24 17:05:10', 1),
(44, '1213', NULL, '4324', NULL, NULL, NULL, '2018-11-24 17:05:15', 1),
(45, 'hghg', NULL, 'gfgfe', NULL, NULL, 'gfdgd', '2018-11-24 17:05:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `code` varchar(10) NOT NULL,
  `beginning_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `code`, `beginning_price`, `selling_price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'vatongf', 'ITEM001123', 10001, 20002, 2, '2018-11-24 05:35:26', '2018-11-24 09:05:46'),
(9, 'vatong', 'ITEM001254', 10006, 200021, 0, '2018-11-24 05:35:26', '2018-11-24 08:57:04'),
(10, 'test', 'DTUAg', 10007, 999999, 0, '2018-11-24 16:49:13', '2018-11-24 08:53:27'),
(11, 'PPOO', 'W4UA', 1000, 1000, 0, '2018-11-24 16:51:03', NULL),
(12, 'yihi', 'PWOW', 1000, 1000, 6, '2018-11-24 16:52:20', NULL),
(13, 'BAHUU', '5CS8', 1000, 1000, 0, '2018-11-24 16:52:29', NULL),
(14, 'OOOOOOOOOO', 'KUZF', 666666, 1000, 0, '2018-11-24 16:53:05', '2018-11-24 08:53:15'),
(15, '12313', 'J8H7', 321312, 1000, 10, '2018-11-24 17:03:06', NULL),
(16, '545', '9MTX', 1000, 1000, 10, '2018-11-24 17:03:15', NULL),
(17, '65', 'EL32', 1000, 1000, 0, '2018-11-24 17:03:19', NULL),
(18, '666', 'YSWV', 1000, 1000, 10, '2018-11-24 17:03:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `item_name` varchar(111) NOT NULL,
  `item_code` varchar(111) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `beginning_price` double NOT NULL,
  `selling_price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=pending, 2=cancelled, 3=accepted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `item_name`, `item_code`, `item_quantity`, `beginning_price`, `selling_price`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 08:46:04', NULL, 1),
(2, 2, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 09:03:06', NULL, 1),
(3, 3, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 09:04:49', NULL, 1),
(4, 4, 'COCO CHANEL', 'ITEM002', 1, 1500, 1700, '2018-11-24 09:05:02', NULL, 1),
(5, 5, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 09:06:26', NULL, 1),
(6, 2, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 09:41:25', NULL, 1),
(7, 6, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 09:53:53', NULL, 1),
(8, 7, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 09:54:00', NULL, 1),
(9, 8, 'COCO CHANEL', 'ITEM002', 1, 1500, 1700, '2018-11-24 09:54:07', NULL, 1),
(10, 2, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 09:55:32', NULL, 1),
(11, 9, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 09:56:53', NULL, 1),
(12, 10, '4', 'ITEM001', 1, 4, 4, '2018-11-24 10:00:01', NULL, 1),
(13, 10, '4', 'ITEM001', 1, 4, 4, '2018-11-24 10:01:13', NULL, 1),
(14, 11, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 10:01:33', NULL, 1),
(15, 12, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 10:02:34', NULL, 1),
(16, 13, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 10:02:50', NULL, 1),
(17, 14, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 10:03:13', NULL, 1),
(18, 15, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 10:03:59', NULL, 1),
(19, 16, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 10:04:05', NULL, 1),
(20, 1, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 10:06:52', NULL, 1),
(21, 17, 'COCO CHANEL', 'ITEM002', 10, 1500, 1700, '2018-11-24 10:07:19', NULL, 1),
(22, 18, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 10:28:07', NULL, 1),
(23, 6, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 10:29:39', NULL, 1),
(24, 19, 'LOUIS VUITTON', 'ITEM001', 15, 1000, 2000, '2018-11-24 10:30:03', NULL, 1),
(25, 20, 'LOUIS VUITTON', 'ITEM001', 2, 1000, 2000, '2018-11-24 11:58:10', NULL, 1),
(26, 21, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 11:59:31', NULL, 1),
(27, 22, 'LOUIS VUITTON', 'ITEM001', 3, 1000, 2000, '2018-11-24 12:00:22', NULL, 1),
(28, 23, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 12:05:04', NULL, 1),
(29, 24, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 12:06:06', NULL, 1),
(30, 25, 'LOUIS VUITTON', 'ITEM001', 2, 1000, 2000, '2018-11-24 12:06:24', NULL, 1),
(31, 26, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 12:06:29', NULL, 1),
(32, 27, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 12:06:32', NULL, 1),
(33, 28, 'LOUIS VUITTON', 'ITEM001', 1, 1000, 2000, '2018-11-24 12:06:51', NULL, 1),
(34, 1, 'COCO CHANEL', 'ITEM002', 1, 1500, 1700, '2018-11-24 12:06:57', NULL, 1),
(35, 29, 'COCO CHANEL', 'ITEM002', 12, 1500, 1700, '2018-11-24 12:40:06', NULL, 1),
(36, 1, 'COCO CHANEL', 'ITEM002', 1, 1500, 1700, '2018-11-24 13:30:59', NULL, 1),
(37, 30, 'test', 'AAG4', 1, 1, 1, '2018-11-24 14:18:07', NULL, 1),
(38, 31, '3', 'VV1D', 10, 1000, 1000, '2018-11-24 14:18:21', NULL, 1),
(39, 32, 'vatong1', 'ITEM001254', 1, 10006, 200021, '2018-11-24 16:41:09', NULL, 1),
(40, 33, 'vatong1', 'ITEM001254', 1, 10006, 200021, '2018-11-24 16:41:15', NULL, 1),
(41, 34, 'BAHUU', '5CS8', 10, 1000, 1000, '2018-11-24 17:02:47', NULL, 1),
(42, 35, 'vatongf', 'ITEM001123', 1, 10001, 20002, '2018-11-24 17:04:08', NULL, 1),
(43, 36, 'vatongf', 'ITEM001123', -1, 10001, 20002, '2018-11-24 17:04:17', NULL, 1),
(44, 36, 'vatongf', 'ITEM001123', 9, 10001, 20002, '2018-11-24 17:04:33', NULL, 1),
(45, 37, 'vatong', 'ITEM001254', 18, 10006, 200021, '2018-11-24 17:04:40', NULL, 1),
(46, 38, 'test', 'DTUAg', 10, 10007, 999999, '2018-11-24 17:04:46', NULL, 1),
(47, 39, 'PPOO', 'W4UA', 10, 1000, 1000, '2018-11-24 17:04:52', NULL, 1),
(48, 40, 'yihi', 'PWOW', 1, 1000, 1000, '2018-11-24 17:04:55', NULL, 1),
(49, 41, 'yihi', 'PWOW', 1, 1000, 1000, '2018-11-24 17:04:59', NULL, 1),
(50, 42, 'yihi', 'PWOW', 1, 1000, 1000, '2018-11-24 17:05:05', NULL, 1),
(51, 43, 'yihi', 'PWOW', 1, 1000, 1000, '2018-11-24 17:05:10', NULL, 1),
(52, 44, 'OOOOOOOOOO', 'KUZF', 10, 666666, 1000, '2018-11-24 17:05:15', NULL, 1),
(53, 45, '65', 'EL32', 10, 1000, 1000, '2018-11-24 17:05:22', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
