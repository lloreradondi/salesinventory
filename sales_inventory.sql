-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 21, 2018 at 03:06 PM
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `middle_name`, `last_name`, `cellphone_number`, `telephone_number`, `facebook_link`, `created_at`) VALUES
(1, 'test', NULL, 'test last naem', NULL, NULL, NULL, '2018-11-21 13:01:59'),
(2, '434', NULL, '434', NULL, NULL, NULL, '2018-11-21 13:21:12'),
(3, '434', NULL, '434', NULL, NULL, NULL, '2018-11-21 13:23:48'),
(4, '434', NULL, '434', NULL, NULL, NULL, '2018-11-21 13:23:49'),
(5, '434', NULL, '434', NULL, NULL, NULL, '2018-11-21 13:24:56'),
(6, '434', NULL, '434', NULL, NULL, NULL, '2018-11-21 13:25:12'),
(7, '434', NULL, '434', NULL, NULL, NULL, '2018-11-21 13:25:57'),
(8, '434', NULL, '434', NULL, NULL, NULL, '2018-11-21 13:27:07'),
(9, '434', NULL, '434', NULL, NULL, NULL, '2018-11-21 13:27:32'),
(10, '434', NULL, '434', NULL, NULL, NULL, '2018-11-21 13:28:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
