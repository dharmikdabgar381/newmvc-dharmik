-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 11, 2023 at 08:41 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newmvc-dharmik`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `parent_category_id` int NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '2',
  `description` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `parent_category_id`, `category_name`, `status`, `description`, `created_at`, `updated_at`) VALUES
(22, 0, 'Bedroom', 1, 'Bedroom items', '2023-03-02 04:24:56', NULL),
(28, 22, 'Beds', 1, 'Bedroom items', '2023-03-02 05:51:26', NULL),
(36, 28, 'Penal Beds', 1, 'Bedroom items', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` tinyint NOT NULL,
  `mobile` bigint NOT NULL,
  `status` tinyint NOT NULL DEFAULT '2',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(91, 'Dharmikkkk', 'Dabgar', 'dharmikdabgar381@gmail.com', 1, 9173719280, 1, '0000-00-00 00:00:00', '2023-04-07 04:58:53'),
(111, 'Mudra', 'Patel', 'mudrapatel@gmail.com', 1, 9874563212, 1, '2023-04-05 09:33:28', '2023-04-11 04:28:05'),
(114, '1', '1', '1', 1, 1, 2, '2023-04-11 08:04:20', '2023-04-11 08:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

DROP TABLE IF EXISTS `customer_address`;
CREATE TABLE IF NOT EXISTS `customer_address` (
  `address_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `customer_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES
(47, 91, 'Kalupur', 'Ahmedabad', 'GUJARAT', 'India', '380001'),
(56, 111, 'maninagar1', 'Ahmedabad', 'Gujarat', 'India', '380001'),
(58, 114, '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute`
--

DROP TABLE IF EXISTS `eav_attribute`;
CREATE TABLE IF NOT EXISTS `eav_attribute` (
  `attribute_id` int NOT NULL AUTO_INCREMENT,
  `entity_type_id` int NOT NULL,
  `code` varchar(20) NOT NULL,
  `backend_type` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL,
  `backend_model` varchar(255) NOT NULL,
  `input_type` varchar(20) NOT NULL,
  PRIMARY KEY (`attribute_id`),
  KEY `entity_type_id` (`entity_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eav_attribute`
--

INSERT INTO `eav_attribute` (`attribute_id`, `entity_type_id`, `code`, `backend_type`, `name`, `status`, `backend_model`, `input_type`) VALUES
(1, 1, 'color', 'int', 'Color', 1, '', 'select'),
(2, 1, 'color', 'int', 'Color', 1, '', 'select'),
(3, 1, 'style', 'int', 'Style', 1, '', 'select'),
(4, 1, 'short_desc', 'int', 'Short Desc', 1, '', 'select');

-- --------------------------------------------------------

--
-- Table structure for table `eav_attribute_option`
--

DROP TABLE IF EXISTS `eav_attribute_option`;
CREATE TABLE IF NOT EXISTS `eav_attribute_option` (
  `option_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `attribute_id` int NOT NULL,
  `position` int NOT NULL,
  PRIMARY KEY (`option_id`),
  KEY `attribute_id` (`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eav_attribute_option`
--

INSERT INTO `eav_attribute_option` (`option_id`, `name`, `attribute_id`, `position`) VALUES
(1, 'Red', 1, 1),
(2, 'Cream', 1, 1),
(3, 'White', 1, 1),
(4, 'Blcak', 1, 1),
(5, 'Brown', 1, 1),
(6, 'Silver', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `entity_type`
--

DROP TABLE IF EXISTS `entity_type`;
CREATE TABLE IF NOT EXISTS `entity_type` (
  `entity_type_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `entity_model` varchar(255) NOT NULL,
  PRIMARY KEY (`entity_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `entity_type`
--

INSERT INTO `entity_type` (`entity_type_id`, `name`, `entity_model`) VALUES
(1, 'product', ''),
(2, 'category', ''),
(3, 'customer', ''),
(4, 'vendor', ''),
(5, 'salesman', '');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `media_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `thumbnail` tinyint NOT NULL,
  `small` tinyint NOT NULL,
  `base` tinyint NOT NULL,
  `gallery` tinyint NOT NULL,
  `status` tinyint NOT NULL DEFAULT '2',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`media_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `product_id`, `image`, `name`, `thumbnail`, `small`, `base`, `gallery`, `status`, `created_at`) VALUES
(10, 17, '10.jpg', '', 0, 0, 0, 0, 1, '2023-02-20 08:30:42'),
(11, 17, '11.jpg', '', 0, 0, 0, 0, 1, '2023-02-20 08:49:05'),
(12, 17, '12.jpg', '', 0, 0, 0, 0, 1, '2023-02-20 08:50:01'),
(13, 17, '13.jpg', 'chair', 0, 0, 0, 0, 1, '2023-02-20 12:40:11'),
(14, 17, '14.jpg', '', 0, 0, 0, 0, 1, '2023-02-22 06:22:04'),
(17, 17, '17.jpg', 'me', 0, 0, 0, 0, 1, '2023-02-22 12:25:43'),
(18, 17, '18.jpg', 'chai', 0, 0, 0, 0, 1, '2023-02-24 11:11:44'),
(19, 19, '19.jpg', 'chair', 0, 0, 0, 0, 1, '2023-03-07 06:17:52'),
(20, 19, '20.jpg', 'chair', 0, 0, 0, 0, 1, '2023-03-07 06:19:35'),
(21, 17, '21.jpg', '', 0, 0, 0, 0, 1, '2023-03-14 04:53:18'),
(22, 17, '22.', '', 0, 0, 0, 0, 1, '2023-03-14 04:53:53'),
(23, 19, '23.jpg', '', 0, 0, 0, 0, 1, '2023-03-14 04:56:03'),
(25, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:15:27'),
(26, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:16:12'),
(27, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:16:24'),
(28, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:17:17'),
(29, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:17:31'),
(30, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:18:02'),
(31, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:18:35'),
(32, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:19:09'),
(33, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:19:33'),
(34, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:20:13'),
(35, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:20:37'),
(36, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:21:14'),
(37, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:21:27'),
(38, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:21:34'),
(39, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:22:11'),
(40, 17, NULL, 'me', 0, 0, 0, 0, 1, '2023-03-14 06:27:49'),
(41, 22, NULL, '', 0, 0, 0, 0, 1, '2023-03-14 06:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(52, 'Cash On Delivery', 2, '2023-04-06 11:54:55', '2023-04-06 11:54:55'),
(53, 'new', 1, '2023-04-06 11:10:57', '2023-04-06 11:10:57'),
(54, 'new', 2, '2023-04-07 03:57:40', '2023-04-07 03:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `sku` varchar(11) NOT NULL,
  `cost` double(10,2) NOT NULL,
  `price` double(10,2) NOT NULL,
  `quntity` int NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` int NOT NULL DEFAULT '2',
  `color` varchar(10) NOT NULL,
  `material` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `sku`, `cost`, `price`, `quntity`, `description`, `status`, `color`, `material`, `created_at`, `updated_at`) VALUES
(17, 'Office Chair ', 'ASD11A', 5000.00, 7000.00, 10, 'Best Office Chair', 1, 'Black', 'Leather&Polister', '2023-02-20 08:09:45', '2023-03-07 06:15:20'),
(19, 'HP Laptop Bag', 'HPB11A', 900.00, 1000.00, 100, 'Best Quality Laptop Bag', 1, 'Matt Black', 'Leather', '2023-02-22 08:24:41', NULL),
(22, 'Outdoor Chair', 'ASD22D', 500.00, 1000.00, 10, 'Comfortable chairs', 1, 'cream', 'wooden', '2023-03-07 06:14:44', NULL),
(23, 'Laptop', 'ASD11A', 25000.00, 35000.00, 1, 'Hp Laptop', 1, 'Silver', 'Fiber', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_int`
--

DROP TABLE IF EXISTS `product_int`;
CREATE TABLE IF NOT EXISTS `product_int` (
  `value_id` int NOT NULL AUTO_INCREMENT,
  `entity_id` int NOT NULL,
  `attribute_id` int NOT NULL,
  `value` int NOT NULL,
  PRIMARY KEY (`value_id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `entity_id` (`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

DROP TABLE IF EXISTS `salesman`;
CREATE TABLE IF NOT EXISTS `salesman` (
  `salesman_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` tinyint NOT NULL,
  `mobile` bigint NOT NULL,
  `status` tinyint NOT NULL,
  `company` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`salesman_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesman_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(10, 'Sonali', 'Gorjiya', 'sonali@gamil.com', 0, 9856985698, 1, 'cybercom', '2023-02-24 12:38:26', '2023-04-05 12:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `salesman_address`
--

DROP TABLE IF EXISTS `salesman_address`;
CREATE TABLE IF NOT EXISTS `salesman_address` (
  `address_id` int NOT NULL AUTO_INCREMENT,
  `salesman_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `salesman_id` (`salesman_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `salesman_address`
--

INSERT INTO `salesman_address` (`address_id`, `salesman_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES
(7, 10, 'Vastrapur', 'Ahmedabad', 'Gujarat', 'India', '380006');

-- --------------------------------------------------------

--
-- Table structure for table `salesman_price`
--

DROP TABLE IF EXISTS `salesman_price`;
CREATE TABLE IF NOT EXISTS `salesman_price` (
  `entity_id` int NOT NULL AUTO_INCREMENT,
  `salesman_id` int NOT NULL,
  `product_id` int NOT NULL,
  `salesman_price` double NOT NULL,
  PRIMARY KEY (`entity_id`),
  KEY `product_id` (`product_id`),
  KEY `salesman_id` (`salesman_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `salesman_price`
--

INSERT INTO `salesman_price` (`entity_id`, `salesman_id`, `product_id`, `salesman_price`) VALUES
(21, 10, 19, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE IF NOT EXISTS `shipping` (
  `shipping_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `amount` int NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`shipping_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`shipping_id`, `name`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(20, 'express', 100, 1, '2023-04-11 05:16:38', '2023-04-11 05:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `vendor_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` tinyint NOT NULL,
  `mobile` bigint NOT NULL,
  `status` tinyint NOT NULL,
  `company` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `first_name`, `last_name`, `email`, `gender`, `mobile`, `status`, `company`, `created_at`, `updated_at`) VALUES
(16, 'dharmikkkk', 'Dabgar', 'dharmikdabgar381@gmail.com', 1, 9173719280, 1, 'Cybercom Creation', '2023-02-22 09:30:03', '2023-04-11 06:21:02'),
(36, 'Harsh', 'Mandalia', 'harsh@gmail.com', 1, 9258956985, 1, 'CCC', '0000-00-00 00:00:00', '2023-04-11 06:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

DROP TABLE IF EXISTS `vendor_address`;
CREATE TABLE IF NOT EXISTS `vendor_address` (
  `address_id` int NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `vendor_id` (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`address_id`, `vendor_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES
(9, 16, 'Vastrapurrr', 'Ahmedabad', 'GUJARAT', 'india', '380001'),
(17, 36, 'Nikol', 'Ahmedabad', 'Gujarat', 'India', '380001');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eav_attribute`
--
ALTER TABLE `eav_attribute`
  ADD CONSTRAINT `eav_attribute_ibfk_1` FOREIGN KEY (`entity_type_id`) REFERENCES `entity_type` (`entity_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eav_attribute_option`
--
ALTER TABLE `eav_attribute_option`
  ADD CONSTRAINT `eav_attribute_option_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_int`
--
ALTER TABLE `product_int`
  ADD CONSTRAINT `product_int_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `eav_attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_int_ibfk_2` FOREIGN KEY (`entity_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_address`
--
ALTER TABLE `salesman_address`
  ADD CONSTRAINT `salesman_address_ibfk_1` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesman_price`
--
ALTER TABLE `salesman_price`
  ADD CONSTRAINT `salesman_price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salesman_price_ibfk_2` FOREIGN KEY (`salesman_id`) REFERENCES `salesman` (`salesman_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
