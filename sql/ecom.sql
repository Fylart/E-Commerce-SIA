-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 07:18 AM
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
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `region` varchar(100) NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `postal_code` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `region`, `apartment`, `postal_code`, `city`, `phone`, `payment_method`, `created_at`) VALUES
(1, 2, 'Region 1', 'isaudhboSNFiNASDvjknSLDNFvloSJKNVDliNSOCDmOSLUGJbnlISJNDFJZxvn', '1602', 'Pasig', '09163026630', 'COD', '2024-11-15 01:46:32'),
(2, 1, 'Region 2', 'isaudhboSNFiNASDvjknSLDNFvloSJKNVDliNSOCDmOSLUGJbnlISJNDFJZxvn', '1602', 'Pasig', '09163026630', 'GCash', '2024-11-15 01:48:51'),
(3, 3, 'Region 2', 'arezo', '1423', 'Pasig', '9069339946', 'COD', '2024-11-15 02:37:00'),
(4, 3, 'Region 2', 'Pasig', '1423', 'Pasig', '9069339946', 'BPI', '2024-11-15 02:39:44'),
(5, 3, 'Region 1', 'test', '12312', 'asd', '432432', 'GCash', '2024-11-15 12:53:02'),
(6, 1, 'Region 1', 'arezo', '1423', 'Paig', '09171245678', 'BPI', '2024-11-17 03:54:40'),
(7, 1, 'Region 2', 'arezo', '1423', 'Pasig', '09171245678', 'Maya', '2024-11-17 04:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `region` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `orders_id`, `product`, `price`, `quantity`, `region`) VALUES
(1, 1, 'Cream Blush', 499.00, 1, '0'),
(2, 1, 'Face Sculpting Microcurrent Spheres', 499.00, 1, '0'),
(3, 1, 'Holy Grail Microblade Brow Renew Shaping Gel', 499.00, 1, '0'),
(4, 2, 'Cream Blush', 499.00, 1, '0'),
(5, 2, 'Perfect Aura Iconic 2in1 Blush and Lip Cream', 499.00, 1, '0'),
(6, 3, 'Face Sculpting Microcurrent Spheres', 499.00, 1, '0'),
(7, 3, 'Lip Mallow Pen', 499.00, 1, '0'),
(8, 3, 'Off Duty Soft Focus Creme Bronzer', 499.00, 1, '0'),
(9, 3, 'Perfect Aura Iconic 2in1 Blush and Lip Cream', 499.00, 2, '0'),
(10, 3, 'Holy Grail Lash Lift Mascara', 499.00, 1, '0'),
(11, 4, 'Face Sculpting Microcurrent Spheres', 499.00, 1, '0'),
(12, 4, 'Lip Mallow Pen', 499.00, 1, '0'),
(13, 4, 'Off Duty Soft Focus Creme Bronzer', 499.00, 1, '0'),
(14, 4, 'Perfect Aura Iconic 2in1 Blush and Lip Cream', 499.00, 2, '0'),
(15, 4, 'Holy Grail Lash Lift Mascara', 499.00, 1, '0'),
(16, 5, 'Drawing Tablet', 15000.00, 1, '0'),
(17, 6, 'Skin Clarity Exfoliating Cleanser', 499.00, 1, '0'),
(18, 6, 'Tine', 0.01, 1, '0'),
(19, 7, 'Skin Clarity Exfoliating Cleanser', 499.00, 1, '0'),
(20, 7, 'Makeup', 20.00, 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `imgDir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock`, `description`, `imgDir`) VALUES
(8, 'Tine', 0.01, 1, 'Leron Leron ipsum sinta buko ng papaya', '../images/important(8).jpg'),
(9, 'Makeup', 20.00, 2, 'Leron Leron ipsum sinta buko ng papaya', '../images/Makeup.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(55) NOT NULL,
  `lastName` varchar(55) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `address`, `email`, `password`) VALUES
(1, 'Paul Andrei', 'Palaroan', 'DRR compound. Quezon Avenue Ext., Mamala 2', 'scatoladidolci23@gmail.com', 'paul123'),
(2, 'vivien', 'olarte', 'mataas na lupa', 'olarteznavivien@gmail.com', 'avicleoalicutie'),
(3, 'windyl', 'aguilar', 'cainta, rizal', 'windylhindot@gmail.com', 'windyl123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_id` (`orders_id`);

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
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
