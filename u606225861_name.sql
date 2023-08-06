-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 02, 2023 at 09:20 AM
-- Server version: 10.6.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u606225861_name`
--

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE `entries` (
  `id` bigint(18) NOT NULL,
  `tag_id` bigint(18) DEFAULT NULL,
  `entrytype_id` bigint(18) NOT NULL,
  `number` bigint(18) DEFAULT NULL,
  `date` date NOT NULL,
  `dr_total` decimal(25,2) NOT NULL DEFAULT 0.00,
  `cr_total` decimal(25,2) NOT NULL DEFAULT 0.00,
  `narration` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `entries`
--

INSERT INTO `entries` (`id`, `tag_id`, `entrytype_id`, `number`, `date`, `dr_total`, `cr_total`, `narration`) VALUES
(4, 1, 1, 1, '2023-07-01', '3000.00', '3000.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `entryitems`
--

CREATE TABLE `entryitems` (
  `id` bigint(18) NOT NULL,
  `entry_id` bigint(18) NOT NULL,
  `ledger_id` bigint(18) NOT NULL,
  `amount` decimal(25,2) NOT NULL DEFAULT 0.00,
  `dc` char(1) NOT NULL,
  `reconciliation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `entryitems`
--

INSERT INTO `entryitems` (`id`, `entry_id`, `ledger_id`, `amount`, `dc`, `reconciliation_date`) VALUES
(5, 4, 8, '3000.00', 'D', NULL),
(6, 4, 7, '3000.00', 'C', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `entrytypes`
--

CREATE TABLE `entrytypes` (
  `id` bigint(18) NOT NULL,
  `label` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `base_type` int(2) NOT NULL DEFAULT 0,
  `numbering` int(2) NOT NULL DEFAULT 1,
  `prefix` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `zero_padding` int(2) NOT NULL DEFAULT 0,
  `restriction_bankcash` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `entrytypes`
--

INSERT INTO `entrytypes` (`id`, `label`, `name`, `description`, `base_type`, `numbering`, `prefix`, `suffix`, `zero_padding`, `restriction_bankcash`) VALUES
(1, 'receipt', 'Receipt', 'Received in Bank account or Cash account', 1, 1, '', '', 0, 2),
(2, 'payment', 'Payment', 'Payment made from Bank account or Cash account', 1, 1, '', '', 0, 3),
(3, 'contra', 'Contra', 'Transfer between Bank account and Cash account', 1, 1, '', '', 0, 4),
(4, 'journal', 'Journal', 'Transaction that does not involve a Bank account or Cash account', 1, 1, '', '', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(18) NOT NULL,
  `parent_id` bigint(18) DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `affects_gross` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `parent_id`, `name`, `code`, `affects_gross`) VALUES
(1, NULL, 'Assets', NULL, 0),
(2, NULL, 'Liabilities and Owners Equity', NULL, 0),
(3, NULL, 'Incomes', NULL, 0),
(4, NULL, 'Expenses', NULL, 0),
(5, 1, 'Fixed Assets', NULL, 0),
(6, 1, 'Current Assets', NULL, 0),
(7, 1, 'Investments', NULL, 0),
(8, 2, 'Capital Account', NULL, 0),
(9, 2, 'Current Liabilities', NULL, 0),
(10, 2, 'Loans (Liabilities)', NULL, 0),
(11, 3, 'Direct Incomes', NULL, 1),
(12, 4, 'Direct Expenses', NULL, 1),
(13, 3, 'Indirect Incomes', NULL, 0),
(14, 4, 'Indirect Expenses', NULL, 0),
(15, 3, 'Sales', NULL, 1),
(16, 4, 'Purchases', NULL, 1),
(17, 8, 'Capital', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` bigint(18) NOT NULL,
  `group_id` bigint(18) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `op_balance` decimal(25,2) NOT NULL DEFAULT 0.00,
  `op_balance_dc` char(1) NOT NULL,
  `type` int(2) NOT NULL DEFAULT 0,
  `reconciliation` int(1) NOT NULL DEFAULT 0,
  `notes` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `ledgers`
--

INSERT INTO `ledgers` (`id`, `group_id`, `name`, `code`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `notes`) VALUES
(7, 6, 'Cash', NULL, '90000.00', 'D', 1, 0, ''),
(8, 6, 'Accounts Receivable', NULL, '20000.00', 'D', 1, 0, ''),
(9, 6, 'Inventory', NULL, '35000.00', 'D', 1, 0, ''),
(13, 5, 'Property, Plant, and Equipment', NULL, '40000.00', 'D', 1, 0, ''),
(15, 5, 'Land', NULL, '15000.00', 'D', 1, 0, ''),
(16, 7, 'Long-Term Investments', NULL, '0.00', 'D', 0, 0, ''),
(17, 7, 'Short-Term Investments', NULL, '0.00', 'D', 1, 0, ''),
(18, 8, 'Share Capital', NULL, '75000.00', 'C', 1, 0, ''),
(19, 8, 'Retained Earnings', NULL, '15000.00', 'C', 1, 0, ''),
(20, 9, 'Accounts Payable', NULL, '60000.00', 'C', 1, 0, ''),
(21, 9, 'Unearned Revenue', NULL, '10000.00', 'C', 1, 0, ''),
(22, 10, 'Bank Loan', NULL, '40000.00', 'C', 1, 0, ''),
(27, 12, 'Depreciation Expenses', NULL, '5000.00', 'D', 1, 0, ''),
(28, 12, 'Wages Expense', NULL, '3000.00', 'D', 1, 0, ''),
(29, 12, 'Utility Expense', NULL, '1500.00', 'D', 1, 0, ''),
(30, 14, 'Interest Expenses', NULL, '3000.00', 'D', 1, 0, ''),
(31, 14, 'Income Tax', NULL, '5000.00', 'D', 1, 0, ''),
(32, 16, 'Cost of Sales', NULL, '82500.00', 'D', 1, 0, ''),
(33, 11, 'Revenue', NULL, '100000.00', 'C', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(18) NOT NULL,
  `date` datetime NOT NULL,
  `level` int(1) NOT NULL,
  `host_ip` varchar(25) NOT NULL,
  `user` varchar(25) NOT NULL,
  `url` varchar(255) NOT NULL,
  `user_agent` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `date`, `level`, `host_ip`, `user`, `url`, `user_agent`, `message`) VALUES
(19, '2023-06-21 04:02:03', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Cash'),
(20, '2023-06-21 04:02:43', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Accounts Receivable'),
(21, '2023-06-21 04:03:03', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/settings/account', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Updated account settings'),
(22, '2023-06-21 04:03:40', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Inventory'),
(23, '2023-06-21 04:03:49', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Inventory'),
(24, '2023-06-21 04:04:57', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Prepaid Expenses'),
(25, '2023-06-21 04:05:29', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Short-Term Investments'),
(26, '2023-06-21 04:06:03', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Accounts Receivable'),
(27, '2023-06-21 04:06:10', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Cash'),
(28, '2023-06-21 04:06:14', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Inventory'),
(29, '2023-06-21 04:06:19', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Prepaid Expenses'),
(30, '2023-06-21 04:06:23', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Short-Term Investments'),
(31, '2023-06-21 04:07:12', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Short-Term Investments'),
(32, '2023-06-21 04:07:33', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Long-Term Investments'),
(33, '2023-06-21 04:08:33', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Property, Plant, and Equipment'),
(34, '2023-06-21 04:10:22', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : (Less Accumulated Depreciation)'),
(35, '2023-06-21 04:11:55', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Long-Term Investments'),
(36, '2023-06-21 04:12:05', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Short-Term Investments'),
(37, '2023-06-21 04:12:39', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Intangible Assets'),
(38, '2023-06-21 04:13:45', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Property, Plant, and Equipment'),
(39, '2023-06-21 04:14:07', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : (Less Accumulated Depreciation)'),
(40, '2023-06-21 04:14:29', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Property, Plant, and Equipment'),
(41, '2023-06-21 04:18:12', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/7', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Cash'),
(42, '2023-06-21 04:18:28', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Accounts Receivable'),
(43, '2023-06-21 04:18:39', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/9', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Inventory'),
(44, '2023-06-21 04:18:46', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/delete/10', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Ledger : Prepaid Expenses'),
(45, '2023-06-21 04:19:29', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/delete/14', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Ledger : (Less Accumulated Depreciation)'),
(46, '2023-06-21 04:19:40', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/delete/12', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Ledger : Long-Term Investments'),
(47, '2023-06-21 04:19:55', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/15', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Land'),
(48, '2023-06-21 04:20:09', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/13', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Property, Plant, and Equipment'),
(49, '2023-06-21 04:20:18', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/delete/11', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Ledger : Short-Term Investments'),
(50, '2023-06-21 04:20:31', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Long-Term Investments'),
(51, '2023-06-21 04:20:42', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/16', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Long-Term Investments'),
(52, '2023-06-21 04:21:01', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Short-Term Investments'),
(53, '2023-06-21 04:21:13', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/17', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Short-Term Investments'),
(54, '2023-06-21 04:23:07', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Share Capital'),
(55, '2023-06-21 04:24:09', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Retained Earnings'),
(56, '2023-06-21 04:24:17', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Share Capital'),
(57, '2023-06-21 04:26:49', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Accounts Payable'),
(58, '2023-06-21 04:27:25', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Unearned Revenue'),
(59, '2023-06-21 04:28:40', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Bank Loan'),
(60, '2023-06-21 04:34:02', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Revenue'),
(61, '2023-06-21 04:34:24', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Revenue'),
(62, '2023-06-21 04:34:52', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/delete/23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Ledger : Revenue'),
(63, '2023-06-21 04:51:27', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/entries/delete/journal/1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Journal entry numbered 1'),
(64, '2023-06-21 04:52:24', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/settings/account', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Updated account settings'),
(65, '2023-06-21 05:32:11', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Revenue'),
(66, '2023-06-21 05:32:37', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Gross Profit'),
(67, '2023-06-21 05:33:14', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Cost of Sales'),
(68, '2023-06-21 05:35:59', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Depreciation Expenses'),
(69, '2023-06-21 05:38:36', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Wages Expense'),
(70, '2023-06-21 05:39:29', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Utility Expense'),
(71, '2023-06-21 05:40:09', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Interest Expenses'),
(72, '2023-06-21 05:40:35', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Income Tax'),
(73, '2023-06-21 05:41:51', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Gross Profit'),
(74, '2023-06-21 05:42:17', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Revenue'),
(75, '2023-06-21 05:42:53', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/delete/24', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Ledger : Revenue'),
(76, '2023-06-21 05:43:03', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Cost of Sales'),
(77, '2023-06-21 05:46:33', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/delete/25', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Ledger : Gross Profit'),
(78, '2023-06-21 05:46:36', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/delete/26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Ledger : Cost of Sales'),
(79, '2023-06-21 05:48:33', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Cost of Sales'),
(80, '2023-06-21 05:49:52', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Cost of Sales'),
(81, '2023-06-21 05:51:11', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : Gross Profit'),
(82, '2023-06-21 05:51:43', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Net Profit'),
(83, '2023-06-21 05:52:55', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/ledgers/edit/33', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Revenue'),
(84, '2023-06-21 11:31:04', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/ledgers/edit/32', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Cost of Sales'),
(85, '2023-06-21 11:35:45', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/settings/account', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Updated account settings'),
(86, '2023-06-21 12:00:43', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : test'),
(87, '2023-06-21 12:00:56', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/ledgers/delete/34', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Ledger : test'),
(88, '2023-06-21 12:07:45', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/entries/add/contra', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Contra entry numbered 1'),
(89, '2023-06-21 12:09:18', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/entries/delete/contra/2', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Contra entry numbered 1'),
(90, '2023-06-21 12:37:56', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/settings/account', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Updated account settings'),
(91, '2023-06-21 12:41:21', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/tags/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Tag : pending'),
(92, '2023-06-21 12:46:45', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/settings/account', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Updated account settings'),
(93, '2023-06-21 12:46:56', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/settings/account', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Updated account settings'),
(94, '2023-06-22 01:58:02', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/groups/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Group : Capital'),
(95, '2023-06-22 02:08:52', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/ledgers/edit/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Accounts Receivable'),
(96, '2023-06-22 02:09:21', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/ledgers/edit/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Accounts Receivable'),
(97, '2023-06-22 02:09:50', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/ledgers/edit/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Accounts Receivable'),
(98, '2023-06-22 02:09:59', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/ledgers/edit/8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Ledger : Accounts Receivable'),
(99, '2023-06-27 12:36:55', 1, '136.158.40.0', 'admin', 'https://jmiaccounting.online/settings/account', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Updated account settings'),
(100, '2023-07-01 10:53:53', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/entries/add/receipt', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Receipt entry numbered 1'),
(101, '2023-07-01 10:54:26', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/entries/delete/receipt/3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Receipt entry numbered 1'),
(102, '2023-07-01 10:55:49', 1, '112.201.234.59', 'admin', 'https://jmiaccounting.online/entries/add/receipt', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Receipt entry numbered 1'),
(103, '2023-07-02 06:55:03', 1, '2001:4451:77e:6c00:255e:b', 'admin', 'https://jmiaccounting.online/ledgers/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Ledger : test'),
(104, '2023-07-02 06:56:40', 1, '2001:4451:77e:6c00:255e:b', 'admin', 'https://jmiaccounting.online/ledgers/delete/35', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Ledger : test'),
(105, '2023-07-02 08:03:23', 1, '2001:4451:77e:6c00:255e:b', 'admin', 'https://jmiaccounting.online/groups/add', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Added Group : Tax'),
(106, '2023-07-02 08:03:35', 1, '2001:4451:77e:6c00:255e:b', 'admin', 'https://jmiaccounting.online/groups/edit/18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Edited Group : Tax'),
(107, '2023-07-02 08:03:48', 1, '2001:4451:77e:6c00:255e:b', 'admin', 'https://jmiaccounting.online/groups/delete/18', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Sa', 'Deleted Group : Tax');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fy_start` date NOT NULL,
  `fy_end` date NOT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `currency_format` varchar(100) NOT NULL,
  `decimal_places` int(2) NOT NULL DEFAULT 2,
  `date_format` varchar(100) NOT NULL,
  `timezone` varchar(100) NOT NULL,
  `manage_inventory` int(1) NOT NULL DEFAULT 0,
  `account_locked` int(1) NOT NULL DEFAULT 0,
  `email_use_default` int(1) NOT NULL DEFAULT 0,
  `email_protocol` varchar(10) NOT NULL,
  `email_host` varchar(255) NOT NULL,
  `email_port` int(5) NOT NULL,
  `email_tls` int(1) NOT NULL DEFAULT 0,
  `email_username` varchar(255) NOT NULL,
  `email_password` varchar(255) NOT NULL,
  `email_from` varchar(255) NOT NULL,
  `print_paper_height` decimal(10,3) NOT NULL DEFAULT 0.000,
  `print_paper_width` decimal(10,3) NOT NULL DEFAULT 0.000,
  `print_margin_top` decimal(10,3) NOT NULL DEFAULT 0.000,
  `print_margin_bottom` decimal(10,3) NOT NULL DEFAULT 0.000,
  `print_margin_left` decimal(10,3) NOT NULL DEFAULT 0.000,
  `print_margin_right` decimal(10,3) NOT NULL DEFAULT 0.000,
  `print_orientation` char(1) NOT NULL,
  `print_page_format` char(1) NOT NULL,
  `database_version` int(10) NOT NULL,
  `settings` varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `address`, `email`, `fy_start`, `fy_end`, `currency_symbol`, `currency_format`, `decimal_places`, `date_format`, `timezone`, `manage_inventory`, `account_locked`, `email_use_default`, `email_protocol`, `email_host`, `email_port`, `email_tls`, `email_username`, `email_password`, `email_from`, `print_paper_height`, `print_paper_width`, `print_margin_top`, `print_margin_bottom`, `print_margin_left`, `print_margin_right`, `print_orientation`, `print_page_format`, `database_version`, `settings`) VALUES
(1, 'JMI', 'tester', 'tester@gmail.com', '2023-01-01', '2023-12-31', 'P', '###,###.##', 2, 'd-M-Y|dd-M-yy', 'UTC', 0, 0, 1, 'Smtp', '', 0, 0, '', '', '', '0.000', '0.000', '0.000', '0.000', '0.000', '0.000', 'P', 'H', 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(18) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` char(6) NOT NULL,
  `background` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `color`, `background`) VALUES
(1, 'pending', '000000', 'ffffa3');

-- --------------------------------------------------------

--
-- Table structure for table `wzaccounts`
--

CREATE TABLE `wzaccounts` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `db_datasource` varchar(255) DEFAULT NULL,
  `db_database` varchar(255) DEFAULT NULL,
  `db_host` varchar(255) DEFAULT NULL,
  `db_port` int(11) DEFAULT NULL,
  `db_login` varchar(255) DEFAULT NULL,
  `db_password` varchar(255) DEFAULT NULL,
  `db_prefix` varchar(255) DEFAULT NULL,
  `db_persistent` varchar(255) DEFAULT NULL,
  `db_schema` varchar(255) DEFAULT NULL,
  `db_unixsocket` varchar(255) DEFAULT NULL,
  `db_settings` varchar(255) DEFAULT NULL,
  `ssl_key` varchar(255) DEFAULT NULL,
  `ssl_cert` varchar(255) DEFAULT NULL,
  `ssl_ca` varchar(255) DEFAULT NULL,
  `hidden` int(1) NOT NULL DEFAULT 0,
  `others` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `wzaccounts`
--

INSERT INTO `wzaccounts` (`id`, `label`, `db_datasource`, `db_database`, `db_host`, `db_port`, `db_login`, `db_password`, `db_prefix`, `db_persistent`, `db_schema`, `db_unixsocket`, `db_settings`, `ssl_key`, `ssl_cert`, `ssl_ca`, `hidden`, `others`) VALUES
(1, 'sample20142105', 'Database/Mysql', 'u606225861_name', 'localhost', 3306, 'u606225861_username', 'Password123!', '', '0', '', '', '', NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wzsettings`
--

CREATE TABLE `wzsettings` (
  `id` int(11) NOT NULL,
  `sitename` varchar(255) DEFAULT NULL,
  `drcr_toby` varchar(255) DEFAULT NULL,
  `enable_logging` int(1) NOT NULL DEFAULT 0,
  `row_count` int(11) NOT NULL DEFAULT 10,
  `user_registration` int(1) NOT NULL DEFAULT 0,
  `admin_verification` int(1) NOT NULL DEFAULT 0,
  `email_verification` int(1) NOT NULL DEFAULT 0,
  `email_protocol` varchar(255) DEFAULT NULL,
  `email_host` varchar(255) DEFAULT NULL,
  `email_port` int(11) DEFAULT 0,
  `email_tls` int(1) DEFAULT 0,
  `email_username` varchar(255) DEFAULT NULL,
  `email_password` varchar(255) DEFAULT NULL,
  `email_from` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `wzsettings`
--

INSERT INTO `wzsettings` (`id`, `sitename`, `drcr_toby`, `enable_logging`, `row_count`, `user_registration`, `admin_verification`, `email_verification`, `email_protocol`, `email_host`, `email_port`, `email_tls`, `email_username`, `email_password`, `email_from`, `others`) VALUES
(1, 'jmi', 'drcr', 1, 10, 1, 1, 1, 'Smtp', 'localhost', 3306, 0, 'admin@123', 'admin@123', 'Caloocan City', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wzuseraccounts`
--

CREATE TABLE `wzuseraccounts` (
  `id` int(11) NOT NULL,
  `wzuser_id` int(11) NOT NULL,
  `wzaccount_id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wzusers`
--

CREATE TABLE `wzusers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `timezone` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `verification_key` varchar(255) DEFAULT NULL,
  `email_verified` int(1) NOT NULL DEFAULT 0,
  `admin_verified` int(1) NOT NULL DEFAULT 0,
  `retry_count` int(1) NOT NULL DEFAULT 0,
  `all_accounts` int(1) NOT NULL DEFAULT 0,
  `default_account` int(11) NOT NULL DEFAULT 0,
  `others` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `wzusers`
--

INSERT INTO `wzusers` (`id`, `username`, `password`, `fullname`, `email`, `timezone`, `role`, `status`, `verification_key`, `email_verified`, `admin_verified`, `retry_count`, `all_accounts`, `default_account`, `others`) VALUES
(1, 'admin', 'd0c45219a80adae6dd4e198f565bf7c2e4bcba2b', 'Juan Carlo', 'caballeroaldrin02@gmail.com', 'UTC', 'admin', 1, '16db4011d3e8defaad3a3a7f1a42abe790787941', 1, 1, 0, 1, 1, NULL),
(9, 'Guest User', '42ab32df1e0bb471b74a17092232dad1018f6e12', 'Guest User', 'gerboyanzon@gmail.com', 'UTC', 'admin', 1, '50d48d2e7861d7031674b4f30052403ed687601d', 1, 1, 0, 1, 0, NULL),
(11, 'Marc Jeibriel Yanzon', '42ab32df1e0bb471b74a17092232dad1018f6e12', 'Marc Jeibriel Yanzon', 'lugawrkgk@gmail.com', 'UTC', 'admin', 1, '05594de9218ea05787711b7f052b93d86960a10b', 1, 1, 0, 1, 0, NULL),
(12, 'sevillaadmin', 'afc5965a4ea192e45909edae4c2a2ac886a420d0', 'Gabriel Sevilla', 'gamirasevilla@gmail.com', 'UTC', 'admin', 1, '69303b87d3d06584af3197b38aaa9a3c1798060f', 1, 1, 0, 1, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `entrytype_id` (`entrytype_id`);

--
-- Indexes for table `entryitems`
--
ALTER TABLE `entryitems`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `entry_id` (`entry_id`),
  ADD KEY `ledger_id` (`ledger_id`);

--
-- Indexes for table `entrytypes`
--
ALTER TABLE `entrytypes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`),
  ADD UNIQUE KEY `label` (`label`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `id` (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `id` (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `id` (`id`);

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
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `entryitems`
--
ALTER TABLE `entryitems`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `entrytypes`
--
ALTER TABLE `entrytypes`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wzaccounts`
--
ALTER TABLE `wzaccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wzsettings`
--
ALTER TABLE `wzsettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wzuseraccounts`
--
ALTER TABLE `wzuseraccounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wzusers`
--
ALTER TABLE `wzusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_fk_check_entrytype_id` FOREIGN KEY (`entrytype_id`) REFERENCES `entrytypes` (`id`),
  ADD CONSTRAINT `entries_fk_check_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `entryitems`
--
ALTER TABLE `entryitems`
  ADD CONSTRAINT `entryitems_fk_check_entry_id` FOREIGN KEY (`entry_id`) REFERENCES `entries` (`id`),
  ADD CONSTRAINT `entryitems_fk_check_ledger_id` FOREIGN KEY (`ledger_id`) REFERENCES `ledgers` (`id`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_fk_check_parent_id` FOREIGN KEY (`parent_id`) REFERENCES `groups` (`id`);

--
-- Constraints for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD CONSTRAINT `ledgers_fk_check_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

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
