-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 08:37 AM
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
-- Database: `couriersystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` int(10) NOT NULL,
  `track_id` int(50) DEFAULT NULL,
  `sender_name` varchar(50) DEFAULT NULL,
  `sender_address` varchar(200) DEFAULT NULL,
  `sender_contact` int(20) DEFAULT NULL,
  `recipent_name` varchar(50) DEFAULT NULL,
  `recipent_address` varchar(200) DEFAULT NULL,
  `recipent_contact` int(20) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `status` int(20) NOT NULL,
  `agent_name` varchar(20) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `track_id`, `sender_name`, `sender_address`, `sender_contact`, `recipent_name`, `recipent_address`, `recipent_contact`, `weight`, `price`, `status`, `agent_name`, `date`) VALUES
(8, 7502618, 'hamza', '8888', 0, 'tauseef', 'Saddar', 2222, '2 kg', '1000', 1, 'tauseef', '2024-09-23'),
(9, 3146076, '', '', 0, '', '', 0, '', '', 1, 'hamza', '2024-09-23'),
(10, 1032652, 'Tau', '445445', 0, 'Hamza', 'Hussainabad', 444444, '1 kg', '500', 2, 'tauseef', '2024-09-23'),
(11, 4052754, 'Farhan', 'Baldia', 454545454, 'Imran', 'Baldia', 44444444, '1 kg', '500', 3, 'tauseef', '2024-09-23'),
(12, 8240083, 'Junaid', 'Goli Mar', 22222222, 'Tabish', 'Liaquatabad', 2147483647, '4kg', '2000', 5, 'tauseef', '2024-09-23'),
(13, 4871239, '', '', 0, '', '', 0, '', '', 1, 'jazim', '2024-09-24'),
(14, 4306467, '', '', 0, '', '', 0, '', '', 1, 'jazim', '2024-09-24'),
(15, 7712691, '', '', 0, '', '', 0, '', '', 1, 'jazim', '2024-09-24'),
(16, 1117342, '', '', 0, '', '', 0, '', '', 1, 'jazim', '2024-09-24'),
(17, 9823486, '', '', 0, '', '', 0, '', '', 1, 'jazim', '2024-09-24'),
(18, 4185999, '', '', 0, '', '', 0, '', '', 1, 'jazim', '2024-09-24'),
(20, 8837620, '', '', 2147483647, '', '', 0, '', '', 1, 'tauseef', '2024-09-24'),
(21, 5891065, '', '', 2147483647, '', '', 0, '', '', 1, 'tauseef', '2024-09-24'),
(22, 2784551, '', '', 0, '', '', 0, '', '', 4, 'tauseef', '2024-09-25');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Received'),
(2, 'On the Way'),
(3, 'Pending'),
(4, 'Delivered'),
(5, 'Returned');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `upwd` varchar(10) NOT NULL,
  `role` varchar(20) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `upwd`, `role`, `added_date`) VALUES
(18, 'admin', 'admin', 'admin', '2024-09-19 08:11:36'),
(33, 'tauseef', '111', 'agent', '2024-09-22 11:56:57'),
(34, 'user', 'user', 'user', '2024-09-22 11:59:11'),
(35, 'hamza', '111', 'agent', '2024-09-23 01:19:37'),
(36, 'jazim', '111', 'agent', '2024-09-24 11:45:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parcels`
--
ALTER TABLE `parcels`
  ADD CONSTRAINT `parcels_ibfk_1` FOREIGN KEY (`status`) REFERENCES `status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
