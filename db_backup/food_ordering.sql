-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2022 at 06:06 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_ordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `user_id` int(11) NOT NULL,
  `order_item` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`user_id`, `order_item`, `price`) VALUES
(2, 'Quarantine', 350),
(2, 'American', 350);

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `user_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `payment_received` int(11) DEFAULT 0,
  `payment_method` varchar(10) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`user_id`, `transaction_id`, `payment_received`, `payment_method`, `date`) VALUES
(2, 2, 0, 'COD', '2021-12-19 01:02:27'),
(2, 3, 0, 'COD', '2021-12-19 01:11:16'),
(2, 4, 0, 'COD', '2021-12-19 02:02:40'),
(2, 6, 1500, 'paypal', '2021-12-19 14:22:22'),
(2, 7, 0, 'COD', '2021-12-19 14:39:41'),
(2, 8, 1650, 'skrill', '2021-12-19 14:57:31'),
(9, 9, 0, 'COD', '2021-12-19 17:37:22'),
(2, 10, 0, 'COD', '2021-12-20 16:05:15'),
(2, 11, 1350, 'skrill', '2021-12-21 18:53:36'),
(2, 12, 1250, 'paypal', '2021-12-21 20:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `res_id` int(11) NOT NULL,
  `res_name` varchar(20) NOT NULL,
  `res_desc` varchar(255) NOT NULL,
  `link` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`res_id`, `res_name`, `res_desc`, `link`) VALUES
(1, 'McDonald\'s', 'We the world\'s largest restaurant chain by revenue. We best known for its hamburgers, cheeseburgers and french fries, they feature chicken products, breakfast items, soft drinks, milkshakes, wraps, and desserts.', 'http://localhost/food_ordering/restaurant_pages/mcd_page.php'),
(2, 'KFC', 'KFC is an American fast food restaurant chain headquartered in Louisville, Kentucky that specializes in fried chicken. It is the world\'s second-largest restaurant chain after McDonald\'s, with 22,621 locations globally in 150 countries', 'http://localhost/food_ordering/restaurant_pages/kfc_page.php'),
(3, 'Albaik', 'Albaik is a Saudi fast food restaurant chain headquartered in Jeddah, Hejaz that primarily sells broasted and fried chicken with a variety of sauces. It is Saudi Arabia\'s largest restaurant chain', 'http://localhost/food_ordering/restaurant_pages/alb_page.php');

-- --------------------------------------------------------

--
-- Table structure for table `res_menu`
--

CREATE TABLE `res_menu` (
  `res_id` int(11) NOT NULL,
  `food_name` varchar(30) NOT NULL,
  `food_type` varchar(20) NOT NULL,
  `food_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `res_menu`
--

INSERT INTO `res_menu` (`res_id`, `food_name`, `food_type`, `food_price`) VALUES
(1, 'Godzilla Milkshake', 'Shakes', 150),
(1, 'Oreo Dream', 'Shakes', 250),
(1, 'Quarantine Buddy', 'Shakes', 350),
(1, 'Pan Cake', 'Breakfast', 150),
(1, 'Country Delight', 'Breakfast', 450),
(1, 'Bacon Overflow', 'Breakfast', 550),
(1, 'Diner Double', 'Lunch', 650),
(1, 'Egg Attack', 'Lunch', 250),
(1, 'American Classic', 'Lunch', 350),
(1, 'Bison Steak', 'Dinner', 850);

-- --------------------------------------------------------

--
-- Table structure for table `rider_details`
--

CREATE TABLE `rider_details` (
  `res_id` int(11) NOT NULL,
  `rider_name` varchar(20) NOT NULL,
  `rider_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rider_details`
--

INSERT INTO `rider_details` (`res_id`, `rider_name`, `rider_rating`) VALUES
(1, 'Ahsan', 4),
(2, 'Faiz', 5),
(3, 'Hamza', 4);

-- --------------------------------------------------------

--
-- Table structure for table `table_details`
--

CREATE TABLE `table_details` (
  `table_id` int(11) NOT NULL,
  `table_location` varchar(20) NOT NULL,
  `table_status` varchar(20) NOT NULL DEFAULT 'available',
  `res_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_details`
--

INSERT INTO `table_details` (`table_id`, `table_location`, `table_status`, `res_id`, `user_id`) VALUES
(1, 'corner', 'occupied', 1, 2),
(2, 'center', 'occupied', 1, 2),
(3, 'left corner', 'occupied', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `user_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`user_id`, `username`, `email`, `password`, `date`) VALUES
(2, 'faiz', 'faizm0512@gmail.com', '$2y$10$KkW3UsgDx8NlebTWNCryv.v3mDgzU79c2q9lCVRT6EyzUfr9junhu', '2021-12-16 00:01:42'),
(9, 'Shah Hussain', 'sh_456@gmail.com', '$2y$10$eom9mMIuDj/8iyTPAt8d9Owmrf3uS9M1qRQWE1WNUo4pEMZXnh4Ki', '2021-12-19 17:35:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `res_menu`
--
ALTER TABLE `res_menu`
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `rider_details`
--
ALTER TABLE `rider_details`
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `table_details`
--
ALTER TABLE `table_details`
  ADD PRIMARY KEY (`table_id`),
  ADD KEY `res_id` (`res_id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `table_details`
--
ALTER TABLE `table_details`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_data` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_data` (`user_id`);

--
-- Constraints for table `res_menu`
--
ALTER TABLE `res_menu`
  ADD CONSTRAINT `res_menu_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `restaurant` (`res_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rider_details`
--
ALTER TABLE `rider_details`
  ADD CONSTRAINT `rider_details_ibfk_1` FOREIGN KEY (`res_id`) REFERENCES `restaurant` (`res_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
