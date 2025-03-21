-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 06:19 PM
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
-- Database: `abm`
--

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` enum('books','electronics','stationery','other') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `request` tinyint(1) DEFAULT 0,
  `buyer_id` int(11) DEFAULT NULL,
  `material_name` text NOT NULL,
  `material_image` text NOT NULL,
  `material_review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `user_id`, `title`, `description`, `image`, `price`, `category`, `created_at`, `request`, `buyer_id`, `material_name`, `material_image`, `material_review`) VALUES
(1, 4, 'test', 'sss', 'abm.jpg', 699.00, 'books', '2025-03-10 03:31:59', 1, NULL, '', '', ''),
(2, 4, 'test', 'adad', '1741577594_coding.png', 700.00, 'books', '2025-03-10 03:33:14', 1, 3, '', '', ''),
(4, 3, 'test', 'sss', '1741581540_areas.jpg', 200.00, 'books', '2025-03-10 04:39:00', 1, 3, '', '', ''),
(5, 3, 'test', 'hfhfh', '1742112578_barcode_67cb5fd929797.png', 900.00, 'books', '2025-03-16 08:09:38', 0, 4, '', '', ''),
(6, 3, 'materialhaha', 'test lng hahahhaha', '1742533678_ed689d53-f853-4290-bb6a-7c97be56bf6a.jpg', 150.00, 'books', '2025-03-21 05:07:58', 0, NULL, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `receipt` varchar(255) NOT NULL,
  `request` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `material_id`, `receipt`, `request`) VALUES
(3, 3, 2, '1741581277_gcash.jpg', 1),
(4, 3, 4, '1741581565_nows.jpg', 1),
(5, 3, 2, '1742112593_9ea6baa9-fb9a-47ee-9e62-742a9ee97ab9.jfif', 1),
(6, 4, 5, '1742115927_abm.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_scores`
--

CREATE TABLE `quiz_scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `quiz_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_scores`
--

INSERT INTO `quiz_scores` (`id`, `user_id`, `score`, `total_questions`, `quiz_date`, `created_at`) VALUES
(7, 4, 1, 2, '2025-03-12 17:54:26', '2025-03-12'),
(8, 4, 1, 2, '2025-03-12 17:54:45', '2025-03-12'),
(9, 3, 1, 2, '2025-03-12 17:58:23', '2025-03-12'),
(10, 3, 1, 2, '2025-03-12 18:11:16', '2025-03-12'),
(11, 3, 2, 2, '2025-03-16 06:23:11', '2025-03-15'),
(12, 3, 1, 2, '2025-03-16 07:10:42', '2025-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(3, 'users', 'hperformanceexhaust@gmail.com', '$2y$10$rkEl2zZIiyleeA9EVf.IYu8qYtirqmcn3n7B6XjAe2gdkGvJorRWy'),
(4, 'rens', 'wasieacuna@gmail.com', '$2y$10$gVVXwdfbd/PLOTxqwPynkOnhia3p4sS6RaLuGpt9mEn3Z4hbehAlu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indexes for table `quiz_scores`
--
ALTER TABLE `quiz_scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_scores`
--
ALTER TABLE `quiz_scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`);

--
-- Constraints for table `quiz_scores`
--
ALTER TABLE `quiz_scores`
  ADD CONSTRAINT `quiz_scores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
