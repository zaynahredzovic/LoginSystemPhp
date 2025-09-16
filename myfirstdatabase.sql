-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2025 at 10:09 AM
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
-- Database: `myfirstdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pwd`, `email`, `created_at`) VALUES
(4, 'zaynahzaynah', '$2y$10$14lu8Ej3uz3o2GixbjOSz.BT0NgHcPekmKE/aywJ9kalMpUP4FCf2', 'zaynah@gmail.com', '2025-09-12 21:39:33'),
(5, 'zaynah', '$2y$12$lNunoJlV/0JKHvmyGl43H.w/dE91Ij19HBjDkqzZONfdj5vVMVRvy', 'zaynahr@gmail.com', '2025-09-14 15:33:00'),
(6, 'cezar', '$2y$12$ZHZazA32lnL/In/fklwntOe1pjzSHXrXVqVQvd/OriX5oeKupMNe6', 'cezar@gmail.com', '2025-09-14 15:34:26'),
(7, 's', '$2y$12$BGJ6Z7mxmSbR0H9FFt12..Ftx0GLYRXdhOyWis4Uc/0WhLTOYMC1S', 'zaynahredzovic@gmail.com', '2025-09-14 15:54:24'),
(8, 'aaaa', '$2y$12$qV3ahzqTlFUkRCfW44SvfeYwejscgo3xhLF5qnt8xejD5Ua9PvfBu', 'a@gmail.com', '2025-09-14 20:33:03'),
(9, 'g', '$2y$12$KcF3rInue/gnABdfeQWntOqhBjh0CAXsZ7udGIhq61FLx4dB.1ZZC', 'g@gmail.com', '2025-09-15 12:43:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
