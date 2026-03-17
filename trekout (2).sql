-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2025 at 03:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trekout`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `passenger_name` varchar(100) NOT NULL,
  `passenger_age` int(3) DEFAULT NULL,
  `passenger_gender` enum('male','female','other') DEFAULT NULL,
  `passenger_email` varchar(150) NOT NULL,
  `passenger_phone` varchar(20) NOT NULL,
  `booking_id` varchar(30) NOT NULL,
  `route_name` varchar(100) NOT NULL,
  `operator` varchar(100) NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `seats` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('confirmed','cancelled','completed') DEFAULT 'confirmed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `student_id`, `passenger_name`, `passenger_age`, `passenger_gender`, `passenger_email`, `passenger_phone`, `booking_id`, `route_name`, `operator`, `departure_date`, `departure_time`, `seats`, `total_amount`, `status`, `created_at`) VALUES
(1, 12, '23456', 'rajveer', 28, 'male', 'raj@gmail.com', '2231234511', 'BK689cb37d74280', 'Delhi to Manali', 'Himachal Travels', '2023-05-25', '22:30:00', '20', 649.00, 'confirmed', '2025-08-13 15:47:09'),
(2, 1, '1234', 'raj', 18, 'male', 'raj1@gmail.com', '1234567899', 'BK689cb58d7a022', 'Jaipur to Goa', 'Kadamba Travels', '2023-05-28', '21:00:00', '20, 15, 10, 5', 2596.00, 'confirmed', '2025-08-13 15:55:57'),
(3, 3, '1234', 'raj', 28, 'male', 'raj@gmail.com', '2231234511', 'BK689cbcf74be2d', 'Jaipur to Goa', 'Kadamba Travels', '2023-05-28', '21:00:00', '20, 15, 10, 5', 2596.00, 'confirmed', '2025-08-13 16:27:35'),
(4, 3, '1234', 'qwe', 28, 'male', 'raj1@gmail.com', '2231234511', 'BK689cbdb1317b1', 'Mumbai to Delhi', 'MSRTC', '2023-05-30', '08:00:00', '20, 15', 1298.00, 'confirmed', '2025-08-13 16:30:41'),
(5, 12, '1234', 'qwe', 26, 'other', 'raj1@gmail.com', '2231234511', 'BK689d6c689095f', 'Delhi to Manali', 'Himachal Travels', '2023-05-25', '22:30:00', '15, 20, 10, 5', 2596.00, 'confirmed', '2025-08-14 04:56:08'),
(6, 12, '23456', '34t', 29, 'other', 'raj@gmail.com', '1234567899', 'BK68a2e330ce86f', 'Delhi to Manali', 'Himachal Travels', '2023-05-25', '22:30:00', '20, 19, 18, 12, 8', 3245.00, 'confirmed', '2025-08-18 08:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`name`, `email`, `password_hash`, `student_id`, `created_at`) VALUES
('raj', 'asdf21@gmail.com', '$2y$10$7G9II9SVseXSeOwK2iZdQexWYR3vjDii3yFBcAQC90WLWDPDi6j4W', 1, '2025-08-13 15:54:34'),
('rajveer', 'asdf1234@gmail.com', '$2y$10$o2ZOfvtqKE5IE/gDsdDSHuDBV6mutEZ40a3eow/aWnYd3Omt9qikS', 2, '2025-08-13 16:24:59'),
('rajveer', 'rah@gmail.com', '$2y$10$qVgahaN172LedWUaGCLPUOyMdk7WMU7Nl5Gzur3pz3MEQr39I.lla', 3, '2025-08-13 16:26:32'),
('rajveer', 'asdf12@gmail.com', '$2y$10$uXEFnFSJAHFH6vPc8SNeeONpwEo8BMPLSCkv1JE5HhGA.QIZeWN6y', 12, '2025-08-13 12:04:32'),
('rajveer', 'asdf123@gmail.com', '$2y$10$Rh/rB.gWft7S/m9lG5UfFOx.PF4FOIbw0Zgz13SN1X7hYARqCi5tK', 13, '2025-08-13 12:51:01'),
('rajveer', 'raj61115@gmail.com', '$2y$10$fE53dI664KSKiB6/IXSJI.lHJ9KOJj67YkiXEBBOk9dqhoQdNou9i', 123456796, '2025-08-11 16:47:51'),
('rajveer', 'raj611@gmail.com', '$2y$10$jalADTT8ENr1N6/BvS4bEeSxBY/RR3XLLY3MmkimP4rauWMurvKX2', 123456797, '2025-08-11 16:48:06'),
('qwer', 'raj3@gmail.com', '$2y$10$QpQ.iWV7YWGj3xT36FVcJOBQcZhHtJTZSeAfqAw5AxiJLZZknbXFa', 123456798, '2025-08-11 16:51:14'),
('rajveer', 'raj6114115@gmail.com', '$2y$10$jRZelGubVYUAVqgrjT0Bx.xy0rCrgYnFmtn.lNfzIOnrBhXb7nMZG', 123456799, '2025-08-11 16:51:35'),
('rajveer', 'raj6121@gmail.com', '$2y$10$DEWb5iejB9wJDkD1F0xzFOJOhlDNVp9td9lJBUJhxAhdM8lKRsuzq', 123456800, '2025-08-11 16:51:54'),
('raju', 'raj3112@gmail.com', '$2y$10$EIp7nCeld8GxGPF0Bcb5NOuFhk2zbsraCMRqXsHBJtWmDYg3GLFN6', 123456801, '2025-08-12 11:41:36'),
('rajveer', 'rajveersingh3@gmail.com', '$2y$10$FPyudR8csS3CUNb4z/vz8.jIqSjQJYk5SBwWvSmG52rs9Kyb2LCF2', 123456802, '2025-08-12 17:23:18'),
('rajveer', 'asdf1@gmail.com', '$2y$10$16/j8mjny59eBoYbqeCt1uA3ROeUF6SfaU2S9wsYsiFHjo1gSBf0S', 123456803, '2025-08-12 20:29:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_id` (`booking_id`),
  ADD KEY `idx_student_id` (`student_id`),
  ADD KEY `idx_booking_id` (`booking_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123456804;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
