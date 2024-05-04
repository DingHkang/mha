-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 01:34 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mha`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `achievement_name` varchar(255) DEFAULT NULL,
  `date_achieved` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `user_id`, `achievement_name`, `date_achieved`) VALUES
(1, 1, 'Record Health Scores Complete', '2024-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linkUrl` varchar(255) NOT NULL,
  `imageUrl` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `minScore` int(255) NOT NULL,
  `maxScore` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `linkUrl`, `imageUrl`, `description`, `minScore`, `maxScore`) VALUES
(1, 'Mindfulness Exercises', 'mindfulness_exercises', 'img/mindfulness.jpg', 'Guided Meditation Sessions: Offer audio or video-guided meditations focusing on different themes such as relaxation, stress reduction, or mindfulness.\r\nBreathing Exercises: Interactive guides that lead users through various breathing techniques to help manage anxiety and improve focus.', 10, 40),
(2, 'Mood Tracking', 'mood_tracking', 'img/mood.jpg', '    Daily Mood Diary: Allow users to track their mood over time with interactive charts and insights to help them identify patterns and triggers.\r\n    Mood Swings Tracker: A tool to record and analyze mood swings and provide personalized feedback or tips.', 20, 30),
(3, 'Sleep Improvement Tools', 'sleep_improvement', 'img/sleep.jpg', '    Sleep Quality Tracker: Help users track their sleep patterns and provide tips for improvement.\r\n    Relaxing Sounds and Bedtime Stories: Offer a library of sounds and stories designed to help users fall asleep more easily.', 10, 40),
(4, 'Stress Relief Puzzle Game', 'puzzle_game', 'img/puzzle.jpg', 'Interactive games that help users reduce stress through engaging activities.', 10, 30);

-- --------------------------------------------------------

--
-- Table structure for table `moods`
--

CREATE TABLE `moods` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moods`
--

INSERT INTO `moods` (`id`, `user_id`, `date`, `rating`) VALUES
(16, 1, '2024-04-19', 1),
(17, 1, '2024-04-20', 4),
(18, 1, '2024-04-29', 3),
(19, 1, '2024-04-30', 4),
(20, 1, '2024-04-29', 5),
(24, 1, '2024-04-23', 1),
(25, 1, '2024-04-30', 4),
(26, 1, '2024-05-02', 1),
(28, 2, '2024-04-29', 3),
(29, 2, '2024-04-24', 4),
(30, 1, '2024-04-20', 5);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `test_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `user_id`, `score`, `test_date`) VALUES
(1, 1, 34, '2024-04-26 22:56:48'),
(2, 1, 25, '2024-04-26 22:57:15'),
(3, 1, 22, '2024-04-28 20:35:42');

-- --------------------------------------------------------

--
-- Table structure for table `sleep_logs`
--

CREATE TABLE `sleep_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sleep_logs`
--

INSERT INTO `sleep_logs` (`id`, `user_id`, `date`, `duration`, `notes`, `created_at`) VALUES
(1, 1, '2024-04-27', 3, 'Happy Sleep', '2024-04-27 04:46:33'),
(2, 1, '2024-04-28', 4, 'bad dream', '2024-04-27 06:41:27'),
(3, 1, '2024-04-29', 7, 'Good Sleep', '2024-04-27 06:43:02'),
(4, 1, '2024-04-26', 8, 'Happy sleeping', '2024-04-27 07:05:47'),
(5, 1, '2024-04-30', 7, 'nice sleep', '2024-04-27 09:45:12'),
(6, NULL, '2024-04-05', 8, 'u', '2024-04-28 07:09:35'),
(7, 1, '2024-04-30', 5, 'Happy Dream', '2024-04-28 07:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`, `last_login`, `is_active`) VALUES
(1, 'John Doe', 'test@gmail.com', '$2y$10$KZEW0eXeEG6SWk7yQMzyyuZvCH2TuinYvZjeSki3YZTNCxXImpmFa', '2024-04-17 11:15:33', NULL, 1),
(2, 'Admin', 'admin123@gmail.com', '$2y$10$o32UOPHsXq1n6XhsNZB/7.A0lhDzSAtGaok0oBScPVjjZAZYJzW3C', '2024-04-17 13:35:03', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moods`
--
ALTER TABLE `moods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sleep_logs`
--
ALTER TABLE `sleep_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `moods`
--
ALTER TABLE `moods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sleep_logs`
--
ALTER TABLE `sleep_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
