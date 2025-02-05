-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Jan 08, 2025 at 10:45 AM
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
-- Database: `technova`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(20) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `name`, `username`, `email`, `password`, `create_at`, `type`) VALUES
(19, 'Admin', 'admin', 'admin@ecyber.com', '$2y$10$4.3TB2KzM5nAw508gsIujuleObXUCGFypbtxtodSvsd1lFh8JRtNa', '2025-01-08 04:05:36', 'main admin'),
(20, 'Kasun', 'hasha', 'hashan@gmail.com', '$2y$10$jWRT4hApHpW6RlhG9aqZD.2mfmENML7NkPHZ7RCMGLRXJzRCwA5uS', '2025-01-08 04:13:37', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`) VALUES
(1, 'Headphones', 'category_6719cc9dbce1a1.80900191.png'),
(2, 'Smart Watches', 'category_6719ccc7d2c424.63324108.png'),
(3, 'Mobiles', 'category_6719ccfc30a517.75644464.png'),
(4, 'Laptops', 'category_6719cd142c13e3.04382414.png'),
(5, 'Tablets', 'category_6719cd1fc202c3.52979763.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'Now',
  `subject` varchar(255) NOT NULL,
  `massage` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `reply` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `payment_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `category` int(10) NOT NULL,
  `confirm` varchar(15) NOT NULL DEFAULT 'Confirm',
  `is_mail` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `product_id`, `user_id`, `payment_method`, `quantity`, `total`, `order_date`, `order_status`, `payment_status`, `category`, `confirm`, `is_mail`) VALUES
(83, '7', 36, 109, 'Cash on delivery (COD)', 1, 129805.00, '2025-01-08 09:10:19', 'Pending', 'Pending', 4, 'Order Again', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `shipping_method` varchar(50) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `payment_status` varchar(20) NOT NULL DEFAULT 'Pending',
  `total` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `user_id`, `name`, `email`, `phone`, `country`, `state`, `city`, `address`, `shipping_method`, `payment_method`, `created_at`, `order_status`, `payment_status`, `total`) VALUES
(1, 36, 'Praveen Manupriya ', 'praveen.manupriya@ecyber.com', '0773891726', 'Sri Lanka', '1234', 'Galle', '\'Amila\' Baddegama Road, Hikkaduwa', 'Free Shipping', 'Cash on delivery (COD)', '2024-12-24 08:54:50', 'Pending', 'Pending', 13055.00),
(2, 36, 'Praveen Manupriya ', 'praveen.manupriya@ecyber.com', '0773891726', 'Sri Lanka', '1234', 'Galle', '\'Amila\' Baddegama Road, Hikkaduwa', 'Free Shipping', 'Bank Transfer', '2024-12-24 08:59:51', 'Pending', 'Pending', 13055.00),
(3, 36, 'Praveen Manupriya ', 'praveen.manupriya@ecyber.com', '0773891726', 'Sri Lanka', '1234', 'Galle', '\'Amila\' Baddegama Road, Hikkaduwa', 'Free Shipping', 'Cash on delivery (COD)', '2024-12-24 09:01:14', 'Pending', 'Pending', 13055.00),
(4, 36, 'Praveen Manupriya ', 'praveen.manupriya@ecyber.com', '0773891726', 'Sri Lanka', '1234', 'Galle', '\'Amila\' Baddegama Road, Hikkaduwa', 'Free Shipping', 'Bank Transfer', '2024-12-24 09:03:57', 'Pending', 'Pending', 13055.00),
(5, 38, 'Praveen Manupriya ', 'praveen.manupriya@ecyber.com', '0773891726', 'Sri Lanka', '1234', 'Galle', '\'Amila\' Baddegama Road, Hikkaduwa', 'Free Shipping', 'Bank Transfer', '2024-12-24 09:06:41', 'Pending', 'Pending', -200.00),
(6, 98, 'Praveen Manupriya ', 'praveen.manupriya@ecyber.com', '0773891726', 'Sri Lanka', '1234', 'Galle', '\'Amila\' Baddegama Road, Hikkaduwa', 'Free Shipping', 'Cash on delivery (COD)', '2025-01-04 07:33:02', 'Pending', 'Pending', -200.00),
(7, 109, 'Praveen Manupriya ', 'praveen.manupriya@ecyber.com', '0773891726', 'Sri Lanka', '1234', 'Galle', '\'Amila\' Baddegama Road, Hikkaduwa', 'Free Shipping', 'Cash on delivery (COD)', '2025-01-08 03:40:17', 'Pending', 'Pending', 129805.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `stock`, `price`, `image`, `category`) VALUES
(1, 'Navy Headphones', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 0, 17500.00, 'product_67038fac36f2c2.32394934.png', '1'),
(2, 'White Headphones', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 3, 75500.00, 'product_67039112c25706.06722649.png', '1'),
(3, 'Candy Headphones', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 11, 13250.00, 'product_670393002c9940.21310420.png', '1'),
(4, 'Mouve Headphones', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 4, 21900.00, 'product_670393396009b8.29735119.png', '1'),
(6, 'Water Smartwatch', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 3, 32500.00, 'product_670393ebc504c9.49133057.png', '2'),
(7, 'Peach Smartwatch', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 8, 9000.00, 'product_67039427b048d2.01886968.png', '2'),
(8, 'Bear Smartwatch', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 6, 8500.00, 'product_6703947e52a592.33232180.png', '2'),
(9, 'Beige Smartwatch', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 7, 6990.00, 'product_670394cbc48735.50949218.png', '2'),
(10, 'Creamy Smartwatch', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 9, 3206.00, 'product_6703950cac6dd3.48287024.png', '2'),
(11, 'Arctic Smartwatch', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 6, 35000.00, 'product_6703964ee4b719.00582106.png', '2'),
(12, 'Blush Smartwatch', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 8, 17500.00, 'product_670397007d5032.44990940.png', '2'),
(13, 'Stony Smartwatch', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 3, 11999.00, 'product_67039795675fb3.25344250.png', '2'),
(14, 'Grassy Smartwatch', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 4, 18900.00, 'product_670397b80de6a4.26480103.png', '2'),
(15, 'Sandy Phone', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 10, 33500.00, 'product_67039835b70864.96551774.png', '3'),
(16, 'Grassyfloss Phone', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 1, 45000.00, 'product_670398802d8079.93077227.png', '3'),
(17, 'Skyblue Phone', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 2, 54900.00, 'product_670398b75a1359.30473199.png', '3'),
(18, 'Mouve Phone', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 13, 25000.00, 'product_670398f9945980.30328358.png', '3'),
(19, 'Minty Phone', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 7, 31000.00, 'product_6703994ce2cce4.85049261.png', '3'),
(20, 'Sunrise Phone', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 8, 55000.00, 'product_6703997269da28.04626752.png', '3'),
(21, 'Sunset Phone', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 10, 57000.00, 'product_67039991b43de1.59580629.png', '3'),
(22, 'Nightsky Phone', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 8, 67000.00, 'product_670399a5f1d772.02234307.png', '3'),
(23, 'Vanilla Phone', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 20, 27000.00, 'product_67039a3b2a1d72.07077954.png', '3'),
(24, 'Navy Phone', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 8, 62000.00, 'product_67039a916eff10.93972442.png', '3'),
(25, 'Silver Tablet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 9, 74275.00, 'product_67039b6043e402.72196217.png', '5'),
(26, 'Candy Tablet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 2, 289990.00, 'product_67039bb142fa60.13543292.png', '5'),
(27, 'Skyblue Tablet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 0, 89900.00, 'product_67039bd98ecb57.50974389.png', '5'),
(28, 'Mint Tablet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 9, 38000.00, 'product_67039c0b863167.73795230.png', '5'),
(29, 'Lead Tablet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 13, 34990.00, 'product_67039cac2a6355.81692196.png', '5'),
(30, 'Sandy Tablet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 5, 90000.00, 'product_67039cd36d5812.92203178.png', '5'),
(31, 'Lilac Tablet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 15, 45000.00, 'product_67039d1b0c6866.38924388.png', '5'),
(32, 'Natural Tablet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 6, 55000.00, 'product_67039d40cd4ea0.08322280.png', '5'),
(33, 'Creamy Tablet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 2, 75000.00, 'product_67039d7ca2a349.96433066.png', '5'),
(34, 'River Tablet', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 11, 45000.00, 'product_67039d93f13967.39278956.png', '5'),
(35, 'Sapphire Laptop ', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 8, 290000.00, 'product_67039ec35d00d1.37701634.png', '4'),
(36, 'Fire Laptop ', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 7, 130000.00, 'product_67039f009c6ab9.86895502.png', '4'),
(37, 'Turquoise Laptop ', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 3, 450000.00, 'product_67039f4236a721.07460056.png', '4'),
(38, 'Smokey Laptop ', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 4, 115000.00, 'product_67039f99507f51.22122401.png', '4'),
(39, 'Splash Laptop ', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 10, 338000.00, 'product_67039fe4bb9ff9.56523358.png', '4'),
(40, 'Grenade Laptop ', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 5, 225990.00, 'product_6703a024658709.04934149.png', '4'),
(41, 'Mosaic Laptop ', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 8, 172999.00, 'product_6703a0a728bc66.87752556.png', '4'),
(42, 'Chromatic Laptop ', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 6, 235990.00, 'product_6703a0eebe8ad1.97602898.png', '4'),
(43, 'Gleam Laptop ', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 15, 190500.00, 'product_6703a13cd47643.46256068.png', '4'),
(54, 'Corol Laptop', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 20, 175000.00, 'product_671b1b95ef9e08.59516125.png', '4'),
(55, 'Floss Smartwatch	', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quasi voluptate.', 20, 13000.00, 'product_671b1caf064b71.89733321.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'customer',
  `is_banned` int(2) NOT NULL DEFAULT 0,
  `is_logged_in` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) NOT NULL,
  `verification_code` varchar(11) NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `phone`, `password`, `email`, `type`, `is_banned`, `is_logged_in`, `created_at`, `profile_picture`, `verification_code`, `is_verified`) VALUES
(109, 'Praveen Manupriya ', 'praveen', 773891726, '$2y$10$2eGPTCuvPUfPSs430sEgveh6.QAtubiYfsrVLADfbpZD7gq7e9dwa', 'praveen.manupriya@ecyber.com', 'customer', 0, 0, '2025-01-08 02:58:29', 'registration_images/m04-removebg-preview.png', '528668', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=300;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
