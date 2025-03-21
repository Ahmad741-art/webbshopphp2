-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Mar 21, 2025 at 07:53 AM
-- Server version: 9.2.0
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `quantity` int NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `payment_method` varchar(50) DEFAULT NULL,
  `products` json NOT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `full_name`, `email`, `phone`, `address`, `payment_method`, `products`, `total_price`, `order_date`) VALUES
(19, 'Ahmad Esmael', 'lund7alab2004@gmail.com', '0790154668', 'Sunnanväg 137', 'Credit Card', '{\"laptop\": 1, \"earbuds\": 1, \"hörlurar\": 8}', 0.00, '2025-03-06 17:07:55'),
(20, 'Ahmad Esmael', 'lund7alab2004@gmail.com', '0790154668', 'Sunnanväg 137', 'Credit Card', '{\"laptop\": 1, \"earbuds\": 1, \"hörlurar\": 8}', 0.00, '2025-03-06 17:12:06'),
(21, 'Ahmad Esmael', 'lund7alab2004@gmail.com', '0790154668', 'Sunnanväg 137', 'Credit Card', '{\"laptop\": 1, \"earbuds\": 1, \"hörlurar\": 8}', 16800.00, '2025-03-06 17:13:33'),
(22, 'Ahmad Esmael', 'lund7alab2004@gmail.com', '0790154668', 'Sunnanväg 137', 'Credit Card', '{\"laptop\": 1, \"earbuds\": 1, \"hörlurar\": 8}', 16800.00, '2025-03-06 17:16:23'),
(23, 'Ahmad Esmael', 'lund7alab2004@gmail.com', '0790154668', 'Sunnanväg 137', 'Credit Card', '{\"earbuds\": 1, \"hörlurar\": 1}', 1800.00, '2025-03-06 17:20:42'),
(24, 'Ahmad Esmael', 'lund7alab2004@gmail.com', '0790154668', 'Sunnanväg 137', 'Credit Card', '{\"laptop\": 1}', 15000.00, '2025-03-07 04:10:03'),
(25, 'Ahmad Esmael', 'lund7alab2004@gmail.com', '0790154668', 'Sunnanväg 137', 'Credit Card', '{\"earbuds\": 1}', 1000.00, '2025-03-07 20:35:18'),
(26, 'Ahmad Esmael', 'lund7alab2004@gmail.com', '0790154668', 'Sunnanväg 137', 'Credit Card', '{\"earbuds\": 1}', 1000.00, '2025-03-10 20:50:56'),
(27, 'Ahmad Esmael', 'lund7alab2004@gmail.com', '0790154668', 'Sunnanväg 137', 'Credit Card', '{\"hörlurar\": 1}', 800.00, '2025-03-21 07:17:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `added_by_admin_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `added_by_admin_id`) VALUES
(4, 'mobil', '3000', 'https://images.ctfassets.net/iidtcybzv1rq/CAzXntTZhcBjDU2Zw9npr/e7762a75a265d1f3a704ddec59a86f3b/Samsung_Galaxy_S24_OnyxBlack_Baksida.png?fm=avif&w=1000&q=80', 4),
(35, 'hörlurar', '800', 'hörlurar.jpg', 0),
(36, 'earbuds', '1000', 'earbuds.jpg', 0),
(37, 'laptop', '15000', 'laptop.jpg', 0),
(41, 'ipad', '12000', 'ipad.jpeg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `email`) VALUES
(1, 'admin', '$2y$12$GHL7N1gcB4nTq/jUvtLf0.w016IUNwoimTAH.x1fOecYr285l.OGq', 'admin', ''),
(4, 'me', '$2y$12$JeysdJrAYG9Mk7xLsV5z.uDU5yzHHC4NhOYN7wKykGi25OaSpVgwS', 'admin', 'ffff.mmmm@gmail.com'),
(6, 'him', '$2y$12$W.eC4gvQefjIpfSqG5s5VOwfNnH59.znCtlKd1McOtzOgzmaLgbUO', 'customer', 'bbbb.llll@gmail.com'),
(7, 'they', '$2y$12$rkRynkKWu2ChH.03mz/duuf22rhcivoyb9AhVzKrE9QvSMFf3TegW', 'customer', 'hhhh.hhhh@gmail.com'),
(8, 'Alrik', '$2y$12$AOKt9Mx6g3HgjWZ4sy6eBeJWUA/Bv/t4qP9f9QbDsKI3kIENgNZXK', 'customer', 'aaaaa.lllll@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
