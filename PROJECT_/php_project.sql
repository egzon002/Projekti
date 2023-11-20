-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 10:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(1, 'Sweatshirt With Zip Collar', 'shirt', 'awesome shirt', 'zara.jpg', 'zara0.1.jpg', 'zara0.2.jpg', 'zara.jpg', 42.00, 87, 'green'),
(2, 'Basic Hoodie', 'shirt', 'awesome shirt', 'zara1.jpg', 'zara1.1.jpg', 'zara1.2.jpg', 'zara1.jpg', 33.00, 99, 'blue'),
(3, 'Button-Up Hoodie', 'jackets', 'awesome jackets', 'zara2.jpg', 'zara2.1.jpg', 'zara2.2.jpg', 'zara2.3', 50.00, 0, 'black'),
(4, 'Ripped Baggy Jeans', 'jeans', 'awesome jeans', 'zara3.jpg', 'zara3.1.jpg', 'zara3.2.jpg', 'zara3.3.jpg', 49.00, 99, 'blue'),
(5, 'Oversize Sweatshirt With Slogan', 'hoodies', 'awesome sweatshirt', 'zara4.jpg', 'zara4.1.jpg', 'zara4.2.jpg', 'zara4.3.jpg', 33.00, 99, 'cream'),
(6, 'Abstract Print Knit T-SHIRT', 'hoodies', 'awesome T-SHIRT', 'zara5.jpg', 'zara5.1.jpg', 'zara5.2.jpg', 'zara5.3.jpg', 25.00, 90, 'black'),
(7, 'Cargo Trousers', 'hoodies', 'awesome trousers', 'zara6.jpg', 'zara6.1.jpg', 'zara6.2.jpg', 'zara6.3.jpg', 49.00, 90, 'gray'),
(8, 'Straight Fit Denim Bermuda Shorts', 'hoodies', 'awesome shorts', 'zara7.jpg', 'zara7.1.jpg', 'zara7.2.jpg', 'zara7.3.jpg', 33.00, 95, 'blue'),
(9, 'Nike Air Max Plus', 'shoes', 'awesome black shoes', 'shoes.jpg', 'shoes0.1.jpg', 'shoes0.2.jpg', 'shoes0.3.jpg', 189.00, 99, 'black'),
(10, 'Nike Dunk Low Retro', 'shoes', 'awesome shoes', 'shoes1.jpg', 'shoes1.1.jpg', 'shoes1.2.jpg', 'shoes1.3.jpg', 119.00, 99, 'white and red'),
(11, 'Nike Waffle Debut', 'shoes', 'awesome shoes', 'shoes2.jpg', 'shoes2.1.jpg', 'shoes2.2.jpg', 'shoes2.3.jpg', 41.00, 97, 'black'),
(12, 'Air Jordan 11 CMFT Low', 'shoes', 'awesome shoes', 'shoes3.jpg', 'shoes3.1.jpg', 'shoes3.2.jpg', 'shoes3.3.jpg', 56.00, 47, 'red'),
(13, 'SAMSUNG Galaxy Watch 5 PRO SM-R920NZKA Black', 'watch', 'awesome watch', 'watch.jpg', 'watch0.1.jpg', 'watch0.2.jpg', 'watch0.3.jpg', 367.00, 51, 'black'),
(14, 'AMAZFIT GTS 4 Mini Black', 'watch', 'awesome watch', 'watch1.jpg', 'watch1.1.jpg', 'watch1.2.jpg', 'watch1.3.jpg', 111.00, 99, 'black'),
(15, 'Haylou Mibro X1', 'watch', 'awesome watch', 'watch2.jpg', 'watch2.1.jpg', '[value-7]', '[value-8]', 94.00, 0, 'black'),
(16, 'SAMSUNG Galaxy Watch 4 Classic 46mm BT Black', 'watch', 'awesome watch', 'watch3.jpg', 'watch3.1.jpg', 'watch3.2.jpg', 'watch3.3.jpg', 341.00, 87, 'black');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

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
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
