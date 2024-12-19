-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 02:39 AM
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
-- Database: `oekaki`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `text` varchar(1024) NOT NULL,
  `parent` int(11) NOT NULL,
  `poster` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `text`, `parent`, `poster`, `timestamp`) VALUES
(1, 'asdf', 12, 3, '2024-12-19 03:06:18'),
(2, 'test comment 2', 12, 3, '2024-12-19 03:16:30'),
(3, 'comment from different user', 12, 1, '2024-12-19 03:17:31'),
(4, 'long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment long comment ', 12, 1, '2024-12-19 03:26:33'),
(5, 'sdf', 12, 1, '2024-12-19 03:30:16'),
(6, 'test', 13, 4, '2024-12-19 03:34:39');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `poster` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `text`, `image`, `poster`, `timestamp`) VALUES
(1, 'test', '1', 1, '2024-12-18 22:04:21'),
(2, 'test 2', '2', 3, '2024-12-18 22:16:05'),
(3, 'test 3', '3', 1, '2024-12-18 22:32:19'),
(4, '', '17345681603124', 3, '2024-12-19 02:29:20'),
(5, '', '17345682440599', 3, '2024-12-19 02:30:44'),
(6, '', '17345682634753', 3, '2024-12-19 02:31:03'),
(7, '', '17345683153869', 3, '2024-12-19 02:31:55'),
(8, 'qweqweqwe', '17345683604085', 3, '2024-12-19 02:32:40'),
(9, 'rrtr', '17345683758937', 3, '2024-12-19 02:32:55'),
(10, 'qweqweqwe', '17345686432242', 3, '2024-12-19 02:37:23'),
(11, 'qqq', '17345687557796', 3, '2024-12-19 02:39:15'),
(12, 'qqq', '17345687697821', 3, '2024-12-19 02:39:29'),
(13, 'aaaaaaa', '17345720753054', 4, '2024-12-19 03:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `joindate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `joindate`) VALUES
(1, 'newuser', 'e@example.com', '$argon2i$v=19$m=65536,t=4,p=1$MjNWUE1pU1diaU5mY1JxOQ$Q0S2od8ZkdLy/NoXFI2Llgng0v5d6bo8hBaSBKZIK+E', '2024-12-18 19:18:01'),
(3, 'newuser2', 'r@wikipedia.org', '$argon2i$v=19$m=65536,t=4,p=1$MGJ3bHplUWhmdk9oT2RZWg$LtPU30ks01PvpOsy0lqaIcT48B4JTRqKn/Qr2kmqyLM', '2024-12-18 19:19:18'),
(4, 'guy123', '123@123.com', '$argon2i$v=19$m=65536,t=4,p=1$SWY3ejVPSzNUenhiUDZHaA$IbnmtcTcqCf6XVqxfAnX2llOzANOS7t6Jx76+B6uJfk', '2024-12-19 03:34:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comment` (`parent`),
  ADD KEY `fk_comment_post` (`poster`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poster` (`poster`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment` FOREIGN KEY (`parent`) REFERENCES `post` (`id`),
  ADD CONSTRAINT `fk_comment_post` FOREIGN KEY (`poster`) REFERENCES `users` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_post` FOREIGN KEY (`poster`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
