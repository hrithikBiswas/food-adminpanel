-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 09:45 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminpanel`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updataed` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updataed`) VALUES
(1, 'Add-ons', 'Phasellus vitae rutrum quam, ac vestibulum dui. Ut at nisl mi. Interdum et malesuada fames ac ante ipsum primis in faucibus.', 1, 0, '2023-03-29 01:10:47', '2023-03-29 01:10:47'),
(2, 'Combo Meals', 'Donec nec pharetra elit. Donec id mattis mauris. Proin molestie neque eget augue vulputate, feugiat turpis commodo. Sed aliquam nibh ac metus pretium, a lacinia ligula consequat. Ut ac arcu sit amet ex gravida efficitur a.', 1, 0, '2023-03-29 01:12:05', '2023-03-29 15:51:37'),
(3, 'Desert', 'Suspendisse nec aliquet metus. Duis et feugiat ipsum. Quisque dignissim at nibh in vehicula. Integer semper ligula porta accumsan dictum.', 1, 0, '2023-03-29 01:16:53', '2023-03-29 01:16:53'),
(4, 'Drinks', 'In id vestibulum ipsum. Cras ut lacus a quam iaculis euismod sit amet.', 1, 0, '2023-03-29 01:36:48', '2023-03-29 15:36:07'),
(5, 'Floats', 'Maecenas venenatis dolor ipsum, sit amet porta augue ultricies in. In augue elit, blandit vel quam sit amet, tincidunt condimentum arcu.', 1, 0, '2023-03-29 15:36:47', '2023-03-29 15:36:47'),
(6, 'Group', 'Donec ac sapien gravida, varius diam non, gravida tellus. Quisque ornare augue turpis, malesuada porta erat vulputate eget.', 0, 1, '2023-03-29 15:37:38', '2023-03-30 01:11:18'),
(7, 'Sandwiches', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vehicula ipsum nec nibh condimentum congue. Nulla finibus libero vel magna consectetur, sit amet laoreet est aliquam. Nam viverra urna tincidunt lorem tincidunt, eu pellentesque risus blandit.', 1, 0, '2023-03-29 15:48:47', '2023-03-29 15:50:00'),
(8, 'Meals', 'Cras lobortis porta commodo. Donec at nibh congue, posuere mauris eget, tincidunt massa.', 1, 0, '2023-03-29 15:49:43', '2023-03-29 15:49:43'),
(9, 'Group Meals', 'Donec ac sapien gravida, varius diam non, gravida tellus. Quisque ornare augue turpis, malesuada porta erat vulputate eget.', 1, 0, '2023-03-29 15:50:55', '2023-03-29 15:50:55'),
(10, 'Hrithik', 'rterterreef', 1, 1, '2023-04-04 19:00:00', '2023-04-04 19:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `menu_list`
--

CREATE TABLE `menu_list` (
  `id` int(99) NOT NULL,
  `category_id` int(50) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_list`
--

INSERT INTO `menu_list` (`id`, `category_id`, `code`, `name`, `description`, `price`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 7, 'B1', 'Regular Burger', 'Cras egestas velit eget libero cursus consectetur. Curabitur ligula ligula, ultricies sed elit a, laoreet viverra ante.', 85, 1, 0, '2023-03-30 18:30:41', '2023-03-31 20:10:57'),
(2, 4, 'D1', 'Coke 12oz', 'Cras at risus nec neque semper consectetur. Quisque eget neque imperdiet odio molestie eleifend. Suspendisse sit amet sodales nibh.', 25, 1, 0, '2023-03-30 18:32:15', '2023-03-30 18:32:15'),
(3, 4, 'D2', 'Royal 12oz.', 'Cras at risus nec neque semper consectetur. Quisque eget neque imperdiet odio molestie eleifend. Suspendisse sit amet sodales nibh.', 25, 1, 0, '2023-03-30 18:33:07', '2023-04-04 14:14:12'),
(4, 5, 'F1', 'Coke Float', 'Cras a metus sed enim gravida placerat a id eros. Aliquam nisi erat, mattis at lacus a, malesuada volutpat urna. Nulla lobortis nibh eget mi scelerisque interdum.', 70, 1, 0, '2023-03-30 18:34:04', '2023-03-31 19:39:25'),
(5, 5, 'F2', 'Coffee Float', 'Vestibulum ornare elit et felis malesuada suscipit non consectetur est. Suspendisse vel dui interdum, viverra massa non, hendrerit nisl', 80, 1, 0, '2023-03-30 18:35:01', '2023-03-30 18:35:01'),
(6, 9, 'GM1', '6pcs Chicken, Spag, 5 drinks', 'Integer laoreet pharetra augue, sed luctus nulla iaculis eget. Sed vel augue imperdiet est vehicula tristique non vel ante. In malesuada auctor mattis.', 455, 1, 0, '2023-03-30 18:35:49', '2023-03-30 18:35:49'),
(7, 8, 'M1', 'Fried Chicken with Rice', 'Proin quis orci nisl. Suspendisse a luctus felis, at blandit magna. Integer sit amet sem urna. Morbi ut neque turpis.', 155, 1, 0, '2023-03-30 18:36:54', '2023-03-30 18:36:54'),
(8, 8, 'M2', 'Fried Chicken with 2 Rice', 'Nulla in elementum enim, non pulvinar tortor. Proin aliquet, lacus eu condimentum feugiat, quam odio egestas augue, cursus laoreet ipsum massa vitae purus', 145, 1, 0, '2023-03-30 18:37:38', '2023-03-30 18:37:38'),
(9, 3, 'S1', 'Moruvumi Food', 'It\'s a saudi arabian food', 50, 1, 1, '2023-03-31 19:42:01', '2023-03-31 20:10:45'),
(10, 4, 'Q4', 'coke 250ml', 'Coca-cola is sophisticated liquid supplier company', 20, 1, 0, '2023-04-04 14:13:57', '2023-04-04 14:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `price` float(12,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `menu_id`, `price`, `quantity`) VALUES
(1, 10, 20.00, 2),
(1, 6, 455.00, 1),
(2, 4, 70.00, 2),
(2, 8, 145.00, 1),
(2, 7, 155.00, 1),
(2, 1, 85.00, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `queue` varchar(50) NOT NULL,
  `total_amount` float(12,2) NOT NULL,
  `tendered_amount` float(12,2) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0 = Queued,\r\n1 = Served	',
  `dete_created` datetime(1) NOT NULL DEFAULT current_timestamp(1),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `user_id`, `code`, `queue`, `total_amount`, `tendered_amount`, `status`, `dete_created`, `date_updated`) VALUES
(1, 1, '2023040500001', '00001', 495.00, 500.00, 0, '2023-04-05 18:51:10.6', '2023-04-05 18:51:10'),
(2, 1, '2023040500002', '00002', 610.00, 1000.00, 1, '2023-04-05 18:51:31.2', '2023-04-05 18:51:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` varchar(250) DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Hrithik', '', 'Biswas', 'admin', 'admin', 'uploads/avatars/1.png', NULL, 1, '2023-04-05 18:31:34', '2023-04-05 18:33:14'),
(2, 'Raju', '', 'Biswas', 'Cashier', 'admin', 'uploads/avatars/2.png', NULL, 2, '2023-04-05 18:32:15', '2023-04-05 18:32:15'),
(3, 'Binod', '', 'Das', 'Binod', '1234', 'uploads/avatars/3.png', NULL, 3, '2023-04-05 18:50:48', '2023-04-05 18:50:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_list`
--
ALTER TABLE `menu_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
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
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu_list`
--
ALTER TABLE `menu_list`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
