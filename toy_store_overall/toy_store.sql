-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2025 at 04:39 AM
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
-- Database: `toy_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `fulfillment_status` enum('processing','delivered') NOT NULL DEFAULT 'processing',
  `method` enum('cod','creditcard','gcash','paypal') NOT NULL,
  `order_summary` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `order_date`, `shipping_fee`, `total_price`, `payment_status`, `fulfillment_status`, `method`, `order_summary`) VALUES
(1, 'ORD67F9B44B8DA40', 2, '2025-04-12 02:31:07', 50.00, 3327.99, 'unpaid', 'processing', 'cod', 'Honkai: Star Rail Official Merchandise Character Keycaps, 40cm Officer Caitlin & Vi Plush Doll, Heartsteel Ez Cosplay'),
(2, 'ORD67F9B5B66E8AD', 2, '2025-04-12 02:37:10', 50.00, 9581.00, 'unpaid', 'processing', 'paypal', 'Alien Stage Blind Box, Love and Deepspace Fanmade Tenorinzu, Rebirth of Evangelion - Evangelion EVA-01, Heartsteel Ez Cosplay, Tekken Jin Cos'),
(3, 'ORD67F9B6B80A7DC', 2, '2025-04-12 02:41:28', 50.00, 499.00, 'paid', 'delivered', 'gcash', 'Tekken Jin Cos'),
(4, 'ORD67F9BEEC0D250', 2, '2025-04-12 03:16:28', 50.00, 1299.00, 'paid', 'delivered', 'gcash', '40cm Fan Made Honkai Star Rail Black Swan Plush Doll'),
(5, 'ORD67F9C0E0E09EE', 3, '2025-04-12 03:24:48', 50.00, 5196.00, 'unpaid', 'processing', 'cod', 'Fanmade Attack On Titan Neck Pillow'),
(6, 'ORD67F9C4454C147', 4, '2025-04-12 03:39:17', 50.00, 3596.00, 'paid', 'delivered', 'cod', 'One Piece Red Ado'),
(7, 'ORD67F9C9F4ED75B', 4, '2025-04-12 04:03:32', 50.00, 1587.00, 'paid', 'delivered', 'creditcard', 'Love and Deepspace Fanmade Tenorinzu, Naturalism Axolotl Plush'),
(8, 'ORD67F9CCC34158D', 3, '2025-04-12 04:15:31', 50.00, 1609.93, 'paid', 'delivered', 'gcash', 'Honkai: Star Rail Official Merchandise Character Keycaps'),
(9, 'ORD67F9CE1980662', 3, '2025-04-12 04:21:13', 50.00, 1599.00, 'unpaid', 'processing', 'cod', '40cm Officer Caitlin & Vi Plush Doll');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `toy_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_products` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `toys`
--

CREATE TABLE `toys` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `toys`
--

INSERT INTO `toys` (`id`, `name`, `description`, `price`, `image`, `stock_quantity`, `category`, `created_at`) VALUES
(1, 'Rebirth of Evangelion - Evangelion EVA-01', 'High-quality Evangelion figure', 5999.00, 'eva01.jpg', 9, 'Figures', '2025-04-12 00:37:03'),
(2, 'Tekken Alisa Plush', 'Official Tekken Alisa plush doll', 2899.00, 'alisa_plush.jpg', 11, 'Plush', '2025-04-12 02:10:58'),
(3, 'Naturalism Axolotl Plush', 'Soft axolotl plush toy', 1450.00, 'axolotl.jpg', 24, 'Plush', '2025-04-12 02:23:26'),
(4, 'Love and Deepspace Fanmade Doll: X-02 Caleb', 'New Myth Character: X-02 Caleb with Visor and Foldable Wings', 1899.00, 'x02caleb.png', 5, 'Plush', '2025-04-05 07:30:00'),
(5, 'Fanmade Attack On Titan Neck Pillow', 'Comfortable Titan-themed neck pillow', 1299.00, 'aot_pillow.jpg', 15, 'Costumes', '2025-04-12 01:25:31'),
(7, 'Tekken King Plushie', 'Official Tekken King plush', 1044.00, 'tekken_king.jpg', 12, 'Plush', '2025-04-07 07:30:00'),
(8, 'Genshin Impact Official Hu Tao Plush Doll', 'Official Hu Tao character plush', 3451.00, 'hutao.jpg', 7, 'Plush', '2025-04-07 07:30:00'),
(9, 'One Piece Red Ado', 'One Piece character figure', 899.00, 'onepiece_ado.jpg', 26, 'Costumes', '2025-04-12 01:39:17'),
(10, 'Tekken Jin Cos', 'Tekken Jin cosplay costume', 499.00, 'jin_cos.jpg', 1, 'Costumes', '2025-04-12 00:41:28'),
(12, 'Heartsteel Ez Cosplay', 'Heartsteel Ezreal cosplay set', 1499.00, 'ez_cos.jpg', 23, 'Costumes', '2025-04-12 01:48:40'),
(13, 'Spirit Blossom Ahri', 'Ahri costume from Spirit Blossom line', 682.00, 'ahri_cos.jpg', 4, 'Costumes', '2025-04-11 02:30:00'),
(14, 'Alien Stage Blind Box', 'Mystery collectible figures', 1512.00, 'alien_box.jpg', 49, 'Collectibles', '2025-04-12 00:37:03'),
(15, 'Turbo Granny Watch Holder', 'Funny watch stand', 626.00, 'granny_holder.jpg', 20, 'Figures', '2025-04-12 01:35:10'),
(16, 'Honkai: Star Rail Official Merchandise Character Keycaps', 'HSR Collectible character keycaps', 229.99, 'hsrkeycaps.png', 92, 'Collectibles', '2025-04-12 02:15:31'),
(17, 'Honkai: Star Rail Official Merchandise Q Version Series Enamel Pin', 'HSR Collectible enamel pins', 49.99, 'hsrenamelpin.png', 50, 'Collectibles', '2025-04-11 12:30:00'),
(18, 'Love and Deepspace Fanmade Tenorinzu', 'Adorably Soft Collectible figures', 72.00, 'tenorinzu.png', 25, 'Collectibles', '2025-04-12 02:03:32'),
(20, 'asa', 'shdaisadj jadasjka s', 123.12, 'about-img.png', 64, 'Collectibles', '2025-04-12 02:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(11) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `user_type` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `number`, `password`, `address`, `user_type`) VALUES
(1, 'admin', 'admin@gmail.com', '0', 'd033e22ae348aeb5660fc2140aec35850c4da997', '1103 Quezon City', 'admin'),
(2, 'user', 'user@example.com', '12345678910', '8cb2237d0679ca88db6464eac60da96345513964', 'City of Angels', 'user'),
(3, 'John dave1235', 'john1@example.com', '12346614211', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123 Main St', 'user'),
(4, 'Jane smith xd', 'jane1@example.com', '123123', '7c4a8d09ca3762af61e59520943dc26494f8941b', '456 Oak Ave', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `toy_id` (`toy_id`);

--
-- Indexes for table `toys`
--
ALTER TABLE `toys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `number` (`number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `toys`
--
ALTER TABLE `toys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`toy_id`) REFERENCES `toys` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
