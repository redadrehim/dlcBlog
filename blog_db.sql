-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 03, 2018 at 05:17 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `body`, `created`, `modified`) VALUES
(1, 1, 1, 'test comment1', '2018-02-03 01:41:06', '2018-02-03 15:53:54'),
(2, NULL, 1, 'dsada', '2018-02-03 01:44:27', '2018-02-03 01:44:27'),
(3, 4, 1, 'ddasdsadasxxxxx', '2018-02-03 01:45:24', '2018-02-03 01:46:19'),
(4, NULL, 4, 'dsda', '2018-02-03 15:24:50', '2018-02-03 15:24:50'),
(9, 6, 0, 'dsadasdsa', '2018-02-03 16:07:49', '2018-02-03 16:07:49');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created`, `modified`) VALUES
(1, 1, 'The title', 'This is the post body.', '2018-02-02 23:46:28', NULL),
(2, 0, 'A title once again', 'And the post body follows.', '2018-02-02 23:46:28', NULL),
(3, 0, 'Title strikes back', 'This is really exciting! Not.', '2018-02-02 23:46:28', NULL),
(4, 1, 'dsadsa', 'dasdsa', '2018-02-03 01:30:33', '2018-02-03 01:30:33'),
(5, 4, 'test 2', 'test 2', '2018-02-03 15:24:33', '2018-02-03 15:24:33'),
(6, 5, 'dsa', 'dsadsa', '2018-02-03 15:59:54', '2018-02-03 15:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bio` text,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `bio`, `username`, `password`, `role`, `created`, `modified`) VALUES
(4, 'Administrator', 'Administrator Bio', 'admin', '579383613f4ac6328a621080fc61a69b32ee618b', 'admin', '2018-02-03 15:06:34', '2018-02-03 15:06:34'),
(5, 'writer', 'writer Bio\r\n', 'writer', 'ac7b4126da7790c581b1886fcbde78f80d46c845', 'writer', '2018-02-03 15:54:56', '2018-02-03 15:54:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;