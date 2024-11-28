-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2024 at 03:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'Culture Champion'),
(4, 'Difference Maker'),
(1, 'Makes Work Fun'),
(2, 'Team Player');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `employee_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `firstname`, `lastname`, `username`, `email`, `employee_password`) VALUES
(1, 'Konstantina', 'Gjurkovikj', 'konstantina', 'tina@gmail.com', 'tina123'),
(2, 'Marija', 'Josifoska', 'marija', 'marija@hotmail.com', 'marija321'),
(3, 'Ilina', 'Aleksoska', 'ilina', 'ilina@yahoo.com', 'ilina123'),
(4, 'Borjan', 'Strashevski', 'borjan', 'borjan@hotmail.com', 'borjan321'),
(5, 'Dijana', 'Damcevska', 'dijana', 'dijana@gmail.com', 'dijana111'),
(6, 'Ana', 'Ilieska', 'anailieska', 'anailieska@yahoo.com', 'ana222'),
(7, 'Marijan', 'Djurkovic', 'marijan', 'marijan@hotmail.com', 'marijan333'),
(8, 'Stela', 'Jovanoska', 'stela', 'stela@gmail.com', 'stela888'),
(9, 'Antonio', 'Josifoski', 'antonio', 'antonio@hotmail.com', 'antonio999'),
(10, 'Ivana', 'Ivanoska', 'ivana', 'ivana@yahoo.com', 'ivana777');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `nominee_id`, `category_id`, `comment`, `timestamp`) VALUES
(1, 2, 1, 1, 'Great work buddy.', '2024-11-27 23:37:58'),
(2, 2, 8, 2, 'Great teammate...', '2024-11-28 11:07:18'),
(3, 1, 5, 3, 'Have respect for everyone in the office.', '2024-11-28 12:20:44'),
(4, 1, 7, 1, 'Tells some nice jokes! :)', '2024-11-28 12:23:28'),
(5, 1, 3, 4, 'Such a talented developer.', '2024-11-28 12:26:58'),
(6, 2, 1, 1, 'Funniest teammate out there!!', '2024-11-28 12:37:28'),
(7, 2, 5, 3, 'Really nice character.', '2024-11-28 12:42:35'),
(8, 2, 1, 1, 'No cap.', '2024-11-28 12:42:47'),
(9, 4, 6, 4, 'Really motivated and productive.', '2024-11-28 12:49:19'),
(10, 4, 8, 2, 'great team spirit', '2024-11-28 12:50:19'),
(11, 7, 6, 4, 'Great mind.', '2024-11-28 12:51:01'),
(12, 1, 8, 1, 'Good soul', '2024-11-28 14:32:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voter_id` (`voter_id`),
  ADD KEY `nominee_id` (`nominee_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`voter_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`nominee_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
