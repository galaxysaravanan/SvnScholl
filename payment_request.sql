-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 10:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `microfinance`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment_request`
--

CREATE TABLE `payment_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT 0,
  `to_id` int(11) DEFAULT 0,
  `transaction_id` varchar(50) DEFAULT NULL,
  `old_balance` decimal(10,2) DEFAULT 0.00,
  `pay_amount` decimal(10,2) DEFAULT 0.00,
  `image` varchar(100) DEFAULT NULL,
  `payment_type_id` int(11) DEFAULT 0,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

--
-- Dumping data for table `payment_request`
--

INSERT INTO `payment_request` (`id`, `from_id`, `to_id`, `transaction_id`, `old_balance`, `pay_amount`, `image`, `payment_type_id`, `status`) VALUES
(1, 121, 12122, '1222', 121212.00, 12.00, NULL, 222, 0),
(2, 121, 12122, '1222', 121212.00, 12.00, NULL, 222, 0),
(3, 121, 12122, '1222', 121212.00, 12.00, NULL, 222, 0),
(4, 121, 12122, '1222', 121212.00, 12.00, NULL, 222, 0),
(5, 121, 12122, '1222', 121212.00, 12.00, NULL, 222, 0),
(6, 12, 21, '12', 0.00, 1000.00, NULL, 122, 0),
(7, 12, 21, '12', 0.00, 1000.00, NULL, 122, 0),
(8, 12, 21, '12', 0.00, 1000.00, NULL, 122, 0),
(9, 12, 21, '12', 0.00, 1000.00, NULL, 122, 0),
(10, 12, 21, '12', 0.00, 1000.00, NULL, 122, 0),
(11, 12, 21, '12', 0.00, 1000.00, NULL, 122, 0),
(12, 12, 21, '12', 0.00, 1000.00, NULL, 122, 0),
(13, 12, 21, '12', 0.00, 1000.00, NULL, 122, 0),
(14, 12, 21, '12', 0.00, 1000.00, NULL, 122, 0),
(15, 12, 21, '12', 0.00, 1000.00, NULL, 122, 0),
(16, 12, 21, '12', 0.00, 1000.00, NULL, 122, 0),
(18, 12, 21, '12', 0.00, 1000.00, '18.jpg', 122, 0),
(19, 12, 21, '2', 0.00, 111.00, '19.webp', 123, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_request`
--
ALTER TABLE `payment_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_request`
--
ALTER TABLE `payment_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
