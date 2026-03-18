-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2026 at 06:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flood_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `relief_requests`
--

CREATE TABLE `relief_requests` (
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `relief_type` enum('Food','Water','Medicine','Shelter') NOT NULL,
  `district` varchar(100) NOT NULL,
  `division` varchar(100) NOT NULL,
  `gn_division` varchar(100) NOT NULL,
  `contact_person_name` varchar(100) NOT NULL,
  `contact_number` varchar(25) NOT NULL,
  `family_members` int(11) NOT NULL,
  `severity` enum('Low','Medium','High') NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `address` varchar(100) NOT NULL,
  `status` enum('Pending','Accepted','Rejected','') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relief_requests`
--

INSERT INTO `relief_requests` (`request_id`, `user_id`, `relief_type`, `district`, `division`, `gn_division`, `contact_person_name`, `contact_number`, `family_members`, `severity`, `description`, `created_at`, `address`, `status`) VALUES
(1, 2, 'Food', 'Kandy', 'Kandy', 'Katugasthota', '', '0', 5, 'High', 'A family is stranded without food after heavy rains.', '2026-02-03 19:28:00', '', NULL),
(2, 3, 'Water', 'Galle', 'Galle', 'Unawatuna', '', '0', 3, 'Medium', 'Need clean drinking water.', '2026-02-03 19:28:00', '', NULL),
(3, 5, 'Medicine', 'Kurunegala', 'Kurunegala', 'Mawathagama', '', '0', 4, 'Low', 'Require medicines for children age under 4y.', '2026-02-03 19:28:00', '', NULL),
(4, 2, 'Shelter', 'Kandy', 'Kandy', 'Katugasthota', '', '0', 6, 'High', 'House damaged by flood, need temporary shelter.', '2026-02-03 19:28:00', '', NULL),
(5, 4, 'Food', 'Matara', 'Matara', 'Devananda', '', '0', 7, 'Medium', 'Food supplies running out after storm damage.', '2026-02-03 19:28:00', '', NULL),
(6, 1, 'Water', 'gampaha', 'dc', 'dvd', ' cvdv', '769750023', 5, 'Low', 'help me please', '2026-03-16 08:59:46', 'cscv ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `address`, `created_at`) VALUES
(1, 'Dinithi Himaya', 'himaya123@gmail.com', 'mayaa1234', 'admin', 'No 116,Main Street, Gampaha.', '2026-02-03 19:08:49'),
(2, 'Sathmi Adhikari', 'sathmi0330@gmail.com', 'sithu0330', 'admin', 'No 22,Yatiyana, Minuwangoda.', '2026-02-03 19:08:49'),
(3, 'Bimnya Herath', 'bima2004@gmail.com', 'bima2004', 'user', 'No 52,Main Street, Colombo.', '2026-02-03 19:08:49'),
(4, 'Kaveesha Pathirathna', 'kaveeshapathirathna@gmail.com', 'k1a2v3e4', 'user', 'No 256,Udugampola, Gampaha.', '2026-02-03 19:08:49'),
(5, 'Sithara Perera', 'sithus@gmail.com', 'sithara', 'user', 'No 64,Mathammana, Minuwangoda.', '2026-02-03 19:08:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `relief_requests`
--
ALTER TABLE `relief_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `foreign_key_relief_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `relief_requests`
--
ALTER TABLE `relief_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `relief_requests`
--
ALTER TABLE `relief_requests`
  ADD CONSTRAINT `relief_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
