-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2025 at 03:53 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

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
  `id` int NOT NULL,
  `asset_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `stock` int NOT NULL,
  `asset_info_detail` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `asset_type` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset_name`, `stock`, `asset_info_detail`, `img`, `asset_type`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Lactogenn', 1, 'ewfsw', '1737444061_lactogen.jpg', 'fast moving', 1, '2024-10-28 00:00:00', '2025-01-22 15:42:02'),
(2, 'Milo', 6, 'Milooo', 'milosusu.jpg', 'slow moving', 2, '2024-10-30 00:00:00', '2024-12-09 14:49:21'),
(3, 'Milo 2', 6, 'gygygyg', 'milosusu.jpg', 'fast moving', 2, '2024-10-31 00:00:00', '2024-12-09 14:48:47'),
(4, 'Kopi', 58, 'Kopi Hitam', 'kopi.JPG', 'fast moving', 1, '2024-11-12 00:00:00', '2024-12-11 13:24:58'),
(5, 'Keyboard', 93, NULL, 'IT pc.png', 'slow moving', 1, '2025-01-13 00:00:00', '2025-01-22 15:21:30'),
(6, 'bolu', 10, 'bolu padalarang', 'Screenshot (2).png', 'fast moving', 1, '2025-04-22 00:00:00', '2025-04-23 12:57:26'),
(7, 'Monitor', 20, 'monitor pids', '27.png', 'slow moving', 1, '2025-05-03 00:00:00', '2025-05-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int NOT NULL,
  `asset_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity_received` int NOT NULL,
  `quantity_ordered` int NOT NULL,
  `quantity_remaining` int NOT NULL,
  `checkout_by` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
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
(54, 'kopi', 12, 12, 58, 'akmal anjay', '2024-11-18 08:42:22'),
(55, 'Lactogenn', 8, 8, 2, 'Admin Akmal', '2025-04-17 17:25:02'),
(56, 'bolu', 11, 11, 10, 'Admin Akmal', '2025-04-26 11:31:03'),
(57, 'Keyboard', 37, 37, 93, 'Admin Akmal', '2025-05-03 09:50:55'),
(58, 'Lactogenn', 1, 1, 1, 'Fatah Test', '2025-05-03 10:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int NOT NULL,
  `asset_id` int NOT NULL,
  `created_by` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` date NOT NULL,
  `role` enum('admin','staff','user') COLLATE utf8mb4_general_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `created_at`, `role`) VALUES
(1, 'Admin', 'Akmal', '123456789', 'akmal@ims.com', '2024-10-22', 'admin'),
(2, 'Fatah', 'Test', 'qwertyui', 'fatah@ims.com', '2024-10-24', 'staff'),
(3, 'alif', 'testing', '1234', 'test@gmail.com', '2024-12-08', 'user'),
(4, 'staff', '1', '123', 'staff1@ims.com', '2025-01-13', 'staff'),
(5, 'staff', '12', '123', 'staff122@ims.com', '2025-01-13', 'staff'),
(6, 'a', 'a', '123', 'l@ims.com', '2025-04-18', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
