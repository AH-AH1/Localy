-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql107.infinityfree.com
-- Generation Time: Jun 30, 2025 at 06:16 AM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_39308609_localy`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_ID` int(11) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_subject` enum('General Enquiry','Technical Support','Report Problem','Billing Question','Feature Request') NOT NULL,
  `contact_message` varchar(255) NOT NULL,
  `contact_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_ID`, `contact_name`, `contact_email`, `contact_subject`, `contact_message`, `contact_date`) VALUES
(4, 'Jealous', 'jk@gmail.com', 'Feature Request', 'Why can&#39;t I chat to the seller?', '2025-06-30 02:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `order_quantity` int(2) NOT NULL,
  `order_price` float NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `user_ID`, `product_ID`, `order_quantity`, `order_price`, `order_date`) VALUES
(16, 30, 17, 4, 48, '2025-06-30 00:22:43'),
(17, 20, 18, 3, 45, '2025-06-30 02:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_ID` int(11) NOT NULL,
  `seller_ID` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_cost` float NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_ID`, `seller_ID`, `product_name`, `product_cost`, `product_description`, `product_image`) VALUES
(17, 94, 'Pineapples', 12, 'Big and juicy pineapples.', 'julien-pianetti-Cr9hZrpC1Oc-unsplash.jpg'),
(18, 94, 'Watermelon', 15, 'Very sweet and ready to eat.', 'mockup-graphics-HuMXepbutF8-unsplash.jpg'),
(19, 95, 'Green Apples', 3, 'Green apples, just picked from the tree.', 'green apple.jpg'),
(20, 95, 'Mangos', 6, 'Ripe and ready to eat mangos, very sweet. Come buy in person and get 3 for the price of 2.', 'mango.JPG'),
(21, 96, 'Chicken Burger', 28, 'Very nice chicken burger. Made quickly, for those on the go.', 'burger.jpg'),
(22, 97, 'Pineapples', 20, 'Yellow pineapples', 'julien-pianetti-Cr9hZrpC1Oc-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `seller_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_description` varchar(255) NOT NULL,
  `store_contact` varchar(10) NOT NULL,
  `store_type` enum('Vegetables','Fruits','Prepared Meat','Livestock','Groceries','Snacks','Takeaway/Fast Food','Traditional Meals','Beauty and Hair','Toiletries','Medicine and Herbs','Baby Products','Clothes','Arts and Crafts','Other') NOT NULL,
  `store_location` enum('Klein Drakenstein Road','Lady Grey Street','New Street','Paarl East','Donkervliet Street','Wamkelekile Street','Mohajane Street','Phokeng Street','Ntshamba Street','Bartolomeu Street','Springbok Street','Market/Melling Street','Hoofweg Road','Church Street','Bell Star Junction/Bellville Train Station') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_ID`, `user_ID`, `store_name`, `store_description`, `store_contact`, `store_type`, `store_location`) VALUES
(94, 20, 'Vizia Fruit Stall', 'I sell fresh fruit everyday at affordable prices.', '0628422505', 'Fruits', 'Klein Drakenstein Road'),
(95, 21, 'Thabo Fruit Galore', 'I sell every kind of fruit. I get them fresh everyday from local farms, and serve them to you.', '0628422789', 'Fruits', 'Bartolomeu Street'),
(96, 22, 'Jasons Fast Eats', 'I do fast food, like burgers, hotdogs and braai chicken', '0788422505', 'Takeaway/Fast Food', 'Donkervliet Street'),
(97, 30, 'Aden Store', 'My first store', '0628422505', 'Fruits', 'Klein Drakenstein Road');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` varchar(255) DEFAULT 'user' COMMENT 'user, admin',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `first_name`, `last_name`, `email_address`, `user_password`, `user_role`, `created_at`) VALUES
(19, 'Aden', 'Test', 'at@gmail.com', '$2y$10$ntT.C8Sj20hHrcbyqLrOkekt1j1fVqmsKVoB50PwV.U4UIBQyuCIW', 'admin', '2025-06-29 23:22:58'),
(20, 'Ben', 'Vizia', 'vizia@gmail.com', '$2y$10$IyR6TPXN4VTtlP4FZ4xO4O.wd8h.Wn08MqtvWUSWbR8DAk/KD15a.', 'user', '2025-06-29 22:06:08'),
(21, 'Thabo', 'Zuda', 'thaboz@gmail.com', '$2y$10$mSM5CYtVDMuQaorE5zLZuOtY7tlXeqy89nyIuCz/ccHtY824bGKZO', 'user', '2025-06-29 22:15:50'),
(22, 'Jason', 'Argos', 'argos@gmail.com', '$2y$10$26Jwzv63uCaTui.xZugYpOJeT4d4sBTBnEFZacrM8/AvPrrcQomxO', 'user', '2025-06-29 22:25:56'),
(23, 'Vincent', 'September', 'vincent@gmail.com', '$2y$10$SyRyc4X0MlaImJinpHJSNO2aG1LxpwynPZS14rHP3alYyP0/d88pa', 'user', '2025-06-29 22:32:35'),
(24, 'JP', 'Singh', 'jp.singh@gmail.com', '$2y$10$jSyrcgXAVUPHZqKFtC2bOexBX48ChVPF9D2lsrvHTbyC7QhaSRoPS', 'user', '2025-06-29 22:37:21'),
(25, 'Vile', 'Mdla', 'mdla@gmail.com', '$2y$10$B4eSPre97G.Ms/kTq/e.0uy8D/NrCblwDACV4jD3ryX.qX/9Mpy8e', 'user', '2025-06-29 22:38:46'),
(26, 'Asive', 'Conanna', 'asivec@gmail.com', '$2y$10$IZ0ONirQHMYzzUxoGccRie6FiHJhP5AI3Kje.Ip49enl2px1QgoEC', 'user', '2025-06-29 22:39:49'),
(27, 'Connor', 'Jacobs', 'c.jacobs89@gmail.com', '$2y$10$dvsethy82/ea0OHufXwwJeeDBsouNJ6W7G3b/48VDre6vPWhaykMe', 'user', '2025-06-29 22:40:46'),
(28, 'Tokolo', 'Mbebe', 'tokolom@gmail.com', '$2y$10$8xh/ueOjWWwju98ddrUjc.Bg3fipbkHFjB4XYr.C9pZr1WEzZcMFG', 'user', '2025-06-29 22:41:38'),
(29, 'Fanie', 'de Vries', 'fanie@gmail.com', '$2y$10$ADvq044pqC0K2kOuAUY9v.2q1NGAK4ZSrz2egDq5DSx97Uh0IlCLG', 'user', '2025-06-29 22:42:24'),
(30, 'Aden', 'Hoffman', 'ah@gmail.com', '$2y$10$ZVqWpKOtOEc.jm.wuMGfMOvBYQUwWWMLgnJgfMjCbKU5LXLwQOxAq', 'user', '2025-06-30 00:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wish_ID` int(10) NOT NULL,
  `product_ID` int(10) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_ID`),
  ADD KEY `products_ibfk_2` (`product_ID`),
  ADD KEY `users_ibfk_1` (`user_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_ID`),
  ADD KEY `seller_ID` (`seller_ID`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`seller_ID`),
  ADD KEY `user_ID_fk` (`user_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`),
  ADD UNIQUE KEY `email_unique` (`email_address`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wish_ID`),
  ADD KEY `product_ID_fk` (`product_ID`),
  ADD KEY `user_ID_fk` (`user_ID`),
  ADD KEY `product_ID` (`product_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wish_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`product_ID`) REFERENCES `products` (`product_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_ID`) REFERENCES `sellers` (`seller_ID`) ON DELETE CASCADE;

--
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
  ADD CONSTRAINT `sellers_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_ID`) REFERENCES `products` (`product_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
