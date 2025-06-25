-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 01:33 PM
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
-- Database: `doctrax`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `user_id` int(11) NOT NULL,
  `account_code` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `suffix_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('User','Super Admin','','') NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_records`
--

CREATE TABLE `document_records` (
  `document_id` int(11) NOT NULL,
  `document_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `document_validation` datetime DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `suffix_name` enum('Sr.','Jr.','I','II','III','IV','V','VI','VII') DEFAULT NULL,
  `age` int(11) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `document_title` varchar(255) NOT NULL,
  `document_url` text NOT NULL,
  `document_status` varchar(255) NOT NULL,
  `document_code` varchar(255) NOT NULL,
  `account_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_data`
--

CREATE TABLE `feedback_data` (
  `id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `service_feedback` text NOT NULL,
  `service_suggestion` text NOT NULL,
  `recommendation` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `notif_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_code` varchar(255) NOT NULL,
  `document_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `process_logs`
--

CREATE TABLE `process_logs` (
  `process_id` int(11) NOT NULL,
  `reference_num` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `document_status` varchar(255) NOT NULL,
  `document_remarks` varchar(255) NOT NULL,
  `document_validation` varchar(255) NOT NULL,
  `remark_description` text NOT NULL,
  `document_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_unique` (`email`),
  ADD UNIQUE KEY `account_code` (`account_code`);

--
-- Indexes for table `document_records`
--
ALTER TABLE `document_records`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `feedback_data`
--
ALTER TABLE `feedback_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`notif_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `process_logs`
--
ALTER TABLE `process_logs`
  ADD PRIMARY KEY (`process_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_records`
--
ALTER TABLE `document_records`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_data`
--
ALTER TABLE `feedback_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `process_logs`
--
ALTER TABLE `process_logs`
  MODIFY `process_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
