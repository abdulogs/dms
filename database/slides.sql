-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2023 at 07:21 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slides`
--

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `website` varchar(5000) DEFAULT NULL,
  `reference` varchar(1000) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `fullname`, `email`, `username`, `phone`, `password`, `website`, `reference`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Abdul Hannan', 'abdulhannanzarrar001@gmail.com', 'Bc180401569', '03204322564', 'Haifahn/123', 'vulms.vu.edu.pk', '', '', 1, '2022/02/13 12:09:29 AM', '2022/02/13 12:09:29 AM'),
(2, 'Abdul Hannan', 'abdulhannanzarrar001@gmail.com', 'abdulhannanzarrar001', '03204322564', 'loser/123', 'facebook', '', '', 1, '2022/03/02 06:58:46 PM', '2022/03/02 06:58:46 PM'),
(3, 'Abdul Hannan', 'abdulhannanzarrar001@gmail.com', 'abdulhannanzarrar001', '03204322564', 'Hudahn/123', 'google', '', '', 1, '2022/03/02 07:01:07 PM', '2022/03/02 07:01:07 PM'),
(4, 'Abdul Hannan', 'abdulhannanfarooq1998@gmail.com', 'abdulhannanfarooq1998', '03204322564', 'haifahn/123', 'facebook', '', '', 1, '2022/03/02 07:01:44 PM', '2022/03/02 07:02:05 PM'),
(5, 'Abdul Hannan', 'abdulhannanfarooq1998@gmail.com', 'abdulhannanfarooq1998', '03204322564', 'Haifahn/123', 'google', '', '', 1, '2022/03/02 07:03:07 PM', '2022/03/02 07:03:07 PM'),
(6, 'Abdul Hannan', 'abdulhannanfarooq1998@gmail.com', '8bfc14a3', '03204322564', 'Haifahn/123', 'upwork', 'pet name kalu', '', 1, '2022/03/02 07:07:42 PM', '2022/03/02 07:07:42 PM'),
(7, 'brainbreads', 'brainbreadsbb', 'brainbreadsbb', '03204322564', 'Hudahn/123', 'google', '', '', 1, '2022/03/02 07:08:30 PM', '2022/03/02 07:08:30 PM'),
(8, 'Abdul Hannan', 'abdulhannanfarooq1998@gmail.com', 'abdulhannan300', '03204322564', 'Haifahn/123', 'fiverr', '', '', 1, '2022/03/02 07:11:18 PM', '2022/03/02 07:11:18 PM');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `name`, `ordering`, `topic_id`, `user_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Introduction to vue.js', 1, 4, 1, '<ol><li>Introduction of vue.js</li><li>History of vue.js</li><li>Current version</li><li>Progressive framework</li><li>Single page application</li><li>Competition </li><li>Environment</li></ol>', 1, '2022/02/12 09:26:42 PM', '2022/02/13 04:11:01 PM'),
(2, 'Environment setup', 2, 4, 1, '<ol><li>Node.js installation</li><li>Vs studio code</li><li>Vue.js installation</li></ol>', 1, '2022/02/12 11:24:19 PM', '2022/02/12 11:34:52 PM'),
(3, 'Installtion', 2, 4, 1, '<p>vue.js</p>', 1, '2022/02/13 07:33:45 PM', '2022/02/13 07:33:45 PM'),
(4, 'Python rest framework', 1, 6, 1, '<h4><strong>Why Django?</strong></h4><ul><li>Fast and reliable to use.</li><li>Security is the main key of Django Rest API.</li><li>Work nice with JavaScript frameworks</li><li>Big community support</li></ul><h4><strong>Rest API Services</strong></h4><ul><li>Full application setup and customize</li><li>Third party library integration with Django rest API</li><li>Building logics based on your business</li><li>API\'s testing with your frontend app</li><li>Full authentication service</li><li>Social authentication (ex-login with google)</li><li>Admin panel (customize admin panel if needed)</li><li>Integration with any of the database MYSQL, SQLITE</li></ul>', 1, '2022/02/27 12:58:07 AM', '2022/02/27 01:10:21 AM'),
(5, 'Node.js Rest Api', 8, 5, 1, '<h4><strong>Why Node.js (Express.js)?</strong></h4><ul><li>Fast and reliable to use.</li><li>Security is the main key of Node Rest API.</li><li>Work nice with JavaScript frameworks</li><li>Big community support</li></ul><h4><strong>Rest API Services</strong></h4><ul><li>Full application setup and customize</li><li>Third party library integration with Node.js Rest API</li><li>Building logics based on your business</li><li>API\'s testing with your frontend app</li><li>Full authentication service</li><li>Admin panel (customize admin panel if needed)</li><li>Integration with any of the database MYSQL, SQLITE</li></ul>', 1, '2022/02/27 01:18:47 AM', '2022/02/27 01:20:44 AM'),
(6, 'Php rest api', 1, 7, 1, '<h4>Why PHP (Laravel, Lumen)?</h4><ul><li>Fast and reliable to use.</li><li>Security is the main key of PHP Rest API.</li><li>Work nice with JavaScript frameworks</li><li>Big community support</li></ul><h4>Rest API Services</h4><ul><li>Full application setup and customize</li><li>Third party library integration with PHPRest API</li><li>Building logics based on your business</li><li>API\'s testing with your frontend app</li><li>Full authentication service</li><li>Admin panel (customize admin panel if needed)</li><li>Integration with any of the database MYSQL, SQLITE</li></ul>', 1, '2022/02/27 01:31:29 AM', '2022/02/27 01:31:29 AM');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `technology` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `user_id`, `name`, `color`, `technology`, `logo`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 'Nuxt.js tutorials', '#00C68F', 'Nuxt.js', 'topic16446908122560px-Nuxt_logo.svg.png', 1, '2022/02/12 08:58:38 PM', '2022/02/12 11:33:32 PM'),
(4, 1, 'Vue 3 tutorials', '#3FB27F', 'Vue.js', 'topic164469086058482acecef1014c0b5e4a1e.png', 1, '2022/02/12 11:34:20 PM', '2022/02/12 11:34:20 PM'),
(5, 1, 'Node.js', '#60B047', 'Node.js', 'topic1644691031node-js-736399_1280.png', 1, '2022/02/12 11:37:11 PM', '2022/02/12 11:37:11 PM'),
(6, 1, 'Python', '#366B98', 'Python', 'topic1645905299800px-Python-logo-notext.svg.png', 1, '2022/02/27 12:54:59 AM', '2022/02/27 12:54:59 AM'),
(7, 1, 'Php', '#4D588E', 'Php', 'topic1645907364PHP-logo.svg.png', 1, '2022/02/27 01:29:24 AM', '2022/02/27 01:29:24 AM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` varchar(30) DEFAULT NULL,
  `updated_at` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Abdul', 'Hannan', 'abdul@gmail.com', 'aa5f9f65b56c061344c609e01f3f021e', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
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
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
