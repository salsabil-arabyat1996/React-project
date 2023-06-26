-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2023 at 06:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contract-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `agreement`
--

CREATE TABLE `agreement` (
  `id` int(10) NOT NULL,
  `user_id` int(20) NOT NULL,
  `contract_id` int(20) NOT NULL,
  `status` int(10) NOT NULL,
  `strat_date` text NOT NULL,
  `end_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agreement`
--

INSERT INTO `agreement` (`id`, `user_id`, `contract_id`, `status`, `strat_date`, `end_date`) VALUES
(36, 15, 12, 1, '2023-06-25', '2023-06-26'),
(37, 15, 16, 1, '2023-06-25', '2025-06-25');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `detail` text NOT NULL,
  `description` text NOT NULL,
  `price` int(20) NOT NULL,
  `image` text NOT NULL,
  `employee_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `name`, `detail`, `description`, `price`, `image`, `employee_id`) VALUES
(12, 'Turbo-1', 'powerfull intenet offer ', '5g internet speed 100mg/s', 1, 'https://www.jo.zain.com/english/PublishingImages/ZainInternet/Intro_Fiber_ar.jpg', 1),
(15, 'Turbo-2', 'WIFI extender  Discounted rates on international and cellular calls', 'Enjoy an unlimited experience of convenience and luxury with your subscription.', 25, 'https://www.jo.zain.com/english/PublishingImages/Offers/mobile-ar-100.jpg', 2),
(16, 'Turbo-3', 'Discounted rates on international and cellular calls\r\nWe also provide you with the advanced and innovative Orange Home Box', ', which gives you a high-speed ADSL internet connection, so that you and your family can go as much as you want without ceilings.', 30, 'https://www.jo.zain.com/english/PublishingImages/ZainInternet/jeeran.jpg', 1),
(17, 'Turbo-4', 'which gives you a high-speed ADSL internet connection, so that you and your family can go as much as you want without ceilings.', 'We also provide you with the advanced and innovative Orange Home Box, which gives you a high-speed ADS', 50, 'https://techlekh.com/wp-content/uploads/2021/11/CGNET-50Mbps-plan-thumbnail.jpg', 3),
(18, 'Turbo-5', ' you with the advanced and innovative Orange Home Box, which gives you a high-speed ADS', 'Unlimited local and national calls to Orange fixed line only / 22 thousand minutes\r\nThe price per minute to other landline networks is 2.8 piasters/minute', 30, 'https://www.jo.zain.com/english/HomePageSlider/Website%201400x620%20EN@4x-100.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` int(100) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `phone`, `department`) VALUES
(1, 'MOHAMED', 'mohamed@gmail.com', 856526, 'IT'),
(2, 'Mohamed salem', 'ms0201152@gmail.com', 795743679, 'IT'),
(3, 'Mohamed salem', 'ms0201152@gmail.com', 795743679, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `image`) VALUES
(15, 'khaled salem', 'ms0201152@gmail.com', 'Mohamed126', 2, 'https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agreement`
--
ALTER TABLE `agreement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`contract_id`),
  ADD KEY `contract_id` (`contract_id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agreement`
--
ALTER TABLE `agreement`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agreement`
--
ALTER TABLE `agreement`
  ADD CONSTRAINT `agreement_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agreement_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
