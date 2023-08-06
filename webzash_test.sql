-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2023 at 04:05 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webzash_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `wzaccounts`
--

CREATE TABLE `wzaccounts` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `db_datasource` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `db_database` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `db_host` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `db_port` int(11) DEFAULT NULL,
  `db_login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `db_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `db_prefix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `db_persistent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `db_schema` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `db_unixsocket` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `db_settings` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ssl_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ssl_cert` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ssl_ca` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hidden` int(1) NOT NULL DEFAULT 0,
  `others` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wzsettings`
--

CREATE TABLE `wzsettings` (
  `id` int(11) NOT NULL,
  `sitename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `drcr_toby` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enable_logging` int(1) NOT NULL DEFAULT 0,
  `row_count` int(11) NOT NULL DEFAULT 10,
  `user_registration` int(1) NOT NULL DEFAULT 0,
  `admin_verification` int(1) NOT NULL DEFAULT 0,
  `email_verification` int(1) NOT NULL DEFAULT 0,
  `email_protocol` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_host` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_port` int(11) DEFAULT 0,
  `email_tls` int(1) DEFAULT 0,
  `email_username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `others` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wzsettings`
--

INSERT INTO `wzsettings` (`id`, `sitename`, `drcr_toby`, `enable_logging`, `row_count`, `user_registration`, `admin_verification`, `email_verification`, `email_protocol`, `email_host`, `email_port`, `email_tls`, `email_username`, `email_password`, `email_from`, `others`) VALUES
(1, 'Phiedevs', 'drcr', 1, 10, 1, 1, 1, 'Smtp', 'localhost', 3306, 0, 'admin@123', 'admin@123', 'Marikina city', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wzuseraccounts`
--

CREATE TABLE `wzuseraccounts` (
  `id` int(11) NOT NULL,
  `wzuser_id` int(11) NOT NULL,
  `wzaccount_id` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wzusers`
--

CREATE TABLE `wzusers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `verification_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified` int(1) NOT NULL DEFAULT 0,
  `admin_verified` int(1) NOT NULL DEFAULT 0,
  `retry_count` int(1) NOT NULL DEFAULT 0,
  `all_accounts` int(1) NOT NULL DEFAULT 0,
  `default_account` int(11) NOT NULL DEFAULT 0,
  `others` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wzusers`
--

INSERT INTO `wzusers` (`id`, `username`, `password`, `fullname`, `email`, `timezone`, `role`, `status`, `verification_key`, `email_verified`, `admin_verified`, `retry_count`, `all_accounts`, `default_account`, `others`) VALUES
(1, 'admin', 'd0c45219a80adae6dd4e198f565bf7c2e4bcba2b', 'Juan Carlo', 'caballeroaldrin02@gmail.com', 'UTC', 'admin', 1, '', 1, 1, 0, 1, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wzaccounts`
--
ALTER TABLE `wzaccounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wzsettings`
--
ALTER TABLE `wzsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wzuseraccounts`
--
ALTER TABLE `wzuseraccounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wzuseraccounts_fk_check_wzuser_id` (`wzuser_id`),
  ADD KEY `wzuseraccounts_fk_check_wzaccount_id` (`wzaccount_id`);

--
-- Indexes for table `wzusers`
--
ALTER TABLE `wzusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wzaccounts`
--
ALTER TABLE `wzaccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wzsettings`
--
ALTER TABLE `wzsettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wzuseraccounts`
--
ALTER TABLE `wzuseraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wzusers`
--
ALTER TABLE `wzusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wzuseraccounts`
--
ALTER TABLE `wzuseraccounts`
  ADD CONSTRAINT `wzuseraccounts_fk_check_wzaccount_id` FOREIGN KEY (`wzaccount_id`) REFERENCES `wzaccounts` (`id`),
  ADD CONSTRAINT `wzuseraccounts_fk_check_wzuser_id` FOREIGN KEY (`wzuser_id`) REFERENCES `wzusers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
