-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 04, 2018 at 12:15 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `fed18`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `product_name` varchar(128) NOT NULL,
  `product_id` varchar(128) NOT NULL,
  `bought_by` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` datetime DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `color` varchar(128) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created`, `deleted`, `name`, `color`, `price`, `image`) VALUES
(1, '2018-11-01 11:56:30', NULL, 'Doomspinner', 'Black', 100, 'images/spinnerofdoom.jpg'),
(2, '2018-11-01 11:56:30', NULL, 'Unicornspinner', 'Rainbow', 200, 'images/unicornspinner.jpg'),
(3, '2018-11-01 11:57:13', NULL, 'Spinner of Death', 'Black/Gold', 300, 'images/deathspinner.jpg'),
(4, '2018-11-01 11:57:13', NULL, 'Watermelon Spinner', 'Red', 150, 'images/watermelonspinner.jpeg'),
(5, '2018-11-01 11:57:48', '2018-11-01 00:00:00', 'spinner', 'red', 100, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `adress` varchar(128) NOT NULL,
  `phone` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `adress`, `phone`, `email`) VALUES
(1, 'micke', '$2y$10$M8f1FXHNozu5OzN4nNsCEeiY3beWYJeUD..H0dub2oEX/hJPtnJ9i', 'Michael Persson', 'Kapellgränd 4', '738484894', 'michaelperssonmail@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_products`
--

CREATE TABLE `user_products` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD UNIQUE KEY `id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
