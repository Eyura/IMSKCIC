-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 06:41 AM
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `asset_number` varchar(20) NOT NULL,
  `asset_name` varchar(200) NOT NULL,
  `stock` int(255) NOT NULL,
  `asset_price` int(255) NOT NULL,
  `asset_status` varchar(100) NOT NULL,
  `asset_condition` varchar(100) NOT NULL,
  `asset_info_detail` varchar(200) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `asset_type` varchar(15) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset_number`, `asset_name`, `stock`, `asset_price`, `asset_status`, `asset_condition`, `asset_info_detail`, `img`, `asset_type`, `created_by`, `created_at`, `updated_at`, `location`) VALUES
(1, 'TEMP-1c', 'Lactogenn', 10, 0, 'we', 'w3ef', 'ewfsw', '1737444061_lactogen.jpg', 'fast moving', 1, '2024-10-28 00:00:00', '2025-01-22 15:42:02', 'erf'),
(2, 'TEMP-2', 'Milo', 6, 0, '', '', 'Milooo', 'milosusu.jpg', 'slow moving', 2, '2024-10-30 00:00:00', '2024-12-09 14:49:21', ''),
(3, 'TEMP-3', 'Milo 2', 6, 0, '', '', 'gygygyg', 'milosusu.jpg', 'fast moving', 2, '2024-10-31 00:00:00', '2024-12-09 14:48:47', ''),
(4, 'TEMP-4', 'Kopi', 58, 0, '', '', 'Kopi Hitam', 'kopi.JPG', 'fast moving', 1, '2024-11-12 00:00:00', '2024-12-11 13:24:58', ''),
(5, 'dwdwd', 'Keyboard', 130, 0, '', '', NULL, 'IT pc.png', 'slow moving', 1, '2025-01-13 00:00:00', '2025-01-22 15:21:30', '');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `asset_name` varchar(100) NOT NULL,
  `quantity_received` int(11) NOT NULL,
  `quantity_ordered` int(11) NOT NULL,
  `quantity_remaining` int(11) NOT NULL,
  `checkout_by` varchar(100) NOT NULL,
  `checkout_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `asset_name`, `quantity_received`, `quantity_ordered`, `quantity_remaining`, `checkout_by`, `checkout_at`) VALUES
(31, 'milomu', 1, 1, 7, 'akmal anjay', '2024-01-02 08:41:35'),
(37, 'susu om ohh', 4, 4, 15, 'akmal anjay', '2024-01-04 11:33:10'),
(38, 'milomu', 4, 4, 6, 'akmal anjay', '2024-02-08 14:14:21'),
(39, 'kopi', 10, 10, 14, 'akmal anjay', '2024-03-05 09:24:00'),
(40, 'mau susu dong', 5, 5, 6, 'akmal anjay', '2024-04-08 09:44:37'),
(41, 'kopi', 1, 1, 13, 'akmal anjay', '2024-04-16 11:14:02'),
(42, 'kopi', 10, 10, 3, 'akmal anjay', '2024-05-13 11:15:39'),
(43, 'susu om ohh', 1, 1, 14, 'akmal anjay', '2024-06-04 11:17:05'),
(44, 'kopi', 3, 3, 0, 'akmal anjay', '2024-07-16 11:17:51'),
(45, 'kopi', 5, 5, 25, 'akmal anjay', '2024-08-16 11:46:51'),
(46, 'kopi', 2, 2, 23, 'akmal anjay', '2024-09-09 11:47:41'),
(47, 'kopi', 4, 4, 19, 'akmal anjay', '2024-11-13 11:49:25'),
(48, 'kopi', 7, 7, 12, 'akmal anjay', '2024-11-13 11:49:30'),
(49, 'kopi', 7, 7, 5, 'akmal anjay', '2024-11-13 11:49:34'),
(50, 'kopi', 5, 5, 0, 'akmal anjay', '2024-12-17 11:52:13'),
(51, 'kopi', 5, 5, 95, 'akmal anjay', '2023-01-04 12:03:37'),
(52, 'kopi', 10, 10, 85, 'akmal anjay', '2023-02-09 12:03:42'),
(53, 'kopi', 15, 15, 70, 'akmal anjay', '2023-03-08 12:03:46'),
(54, 'kopi', 12, 12, 58, 'akmal anjay', '2024-11-18 08:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` date NOT NULL,
  `role` enum('admin','staff','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `created_at`, `role`) VALUES
(1, 'Admin', 'Akmal', '123456789', 'akmal@ims.com', '2024-10-22', 'admin'),
(2, 'Fatah', 'Test', 'qwertyui', 'fatah@ims.com', '2024-10-24', 'user'),
(3, 'alif', 'testing', '1234', 'test@gmail.com', '2024-12-08', 'user'),
(4, 'staff', '1', '123', 'staff1@ims.com', '2025-01-13', 'staff'),
(5, 'staff', '12', '123', 'staff122@ims.com', '2025-01-13', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asset_number` (`asset_number`),
  ADD KEY `fk_user` (`created_by`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `asset_id` (`asset_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `stocks_ibfk_2` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
