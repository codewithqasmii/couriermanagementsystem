-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 09:12 PM
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
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `b_id` int(10) NOT NULL,
  `b_name` varchar(50) NOT NULL,
  `b_address` varchar(50) NOT NULL,
  `b_phone` int(20) NOT NULL,
  `b_city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`b_id`, `b_name`, `b_address`, `b_phone`, `b_city`) VALUES
(1, 'CMS Gulshan', 'Hassan Square', 2147483647, 'Karachi'),
(2, 'CMS Rawalpindi', 'Main Rawalpindi Road ', 2147483647, 'Rawalpindi'),
(3, 'CMS Anar Karli', 'Anar Kali road Lahore', 2147483647, 'Lahore'),
(4, 'CMS Muree', 'Main Muree road Islamabad', 2147483647, 'Islamabad'),
(5, 'CMS Saddar', 'Zainab Market Saddar', 2147483647, 'Karachi');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Rawalpindi'),
(2, 'Karachi'),
(3, 'Lahore'),
(4, 'Islamabad');

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
(1, 1822942, 'hamza', 'gulshan iqbal', 22222222, 'farhan', 'lahore', 2147483647, '5kg', '2000', 1, 'tauseef ', '2024-10-04'),
(2, 7651332, 'Tauseef', 'Nazimabad', 2147483647, 'Zain', 'Korangi', 444444444, '1 kg', '500', 1, 'hamza', '2024-10-05');

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
  `uemail` varchar(30) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `upwd` varchar(10) NOT NULL,
  `role` varchar(20) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_city` varchar(20) NOT NULL,
  `added_date` datetime NOT NULL,
  `password_reset_token` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uemail`, `uname`, `upwd`, `role`, `branch_name`, `branch_city`, `added_date`, `password_reset_token`) VALUES
(18, '', 'admin', 'admin', 'admin', '', '', '2024-09-19 08:11:36', ''),
(61, 'a@gmail.com', 'aaaaaa', 'aaa111', 'agent', 'CMS Rawalpindi', 'Rawalpindi', '2024-10-04 06:21:37', ''),
(62, 'tauseef@gmail.com', 'tauseef ', 'aaaa111', 'agent', 'CMS Gulshan', 'Karachi', '2024-10-04 07:15:45', ''),
(63, 'anarkalr@gmail.com', 'hamza', 'aaa111', 'agent', 'CMS Anar Karli', 'Lahore', '2024-10-04 07:34:05', ''),
(64, 'muree@gmail.com', 'muree', 'aaa111', 'agent', 'CMS Muree', 'Islamabad', '2024-10-04 07:35:01', ''),
(65, 'sadar@gmail.com', 'sadarbranch', 'aaa111', 'agent', 'CMS Saddar', 'Karachi', '2024-10-04 10:51:27', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `b_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

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
