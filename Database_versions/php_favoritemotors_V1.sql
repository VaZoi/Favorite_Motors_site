-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 04:04 PM
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
-- Database: `php_favoritemotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, 'Aprilia'),
(2, 'BMW'),
(3, 'Ducati'),
(4, 'Harley-Davidson'),
(5, 'Honda'),
(6, 'Kawasaki'),
(7, 'Yamaha'),
(8, 'KTM'),
(9, 'Suzuki'),
(10, 'Benelli'),
(13, 'Triumph');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'Adventure'),
(2, 'Urban'),
(3, 'Sport-Tour'),
(4, 'Sport'),
(5, 'Tour'),
(6, 'Classic');

-- --------------------------------------------------------

--
-- Table structure for table `motorlicenses`
--

CREATE TABLE `motorlicenses` (
  `motorlicense_id` int(11) NOT NULL,
  `motorlicense_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motorlicenses`
--

INSERT INTO `motorlicenses` (`motorlicense_id`, `motorlicense_name`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `motors`
--

CREATE TABLE `motors` (
  `motor_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `motorlicense_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `cc` int(11) DEFAULT NULL,
  `pk` int(11) DEFAULT NULL,
  `kw` int(11) DEFAULT NULL,
  `seat_height` int(11) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motors`
--

INSERT INTO `motors` (`motor_id`, `category_id`, `brand_id`, `motorlicense_id`, `status_id`, `name`, `price`, `cc`, `pk`, `kw`, `seat_height`, `weight`) VALUES
(2, 2, 7, 2, 1, 'MT-07', 8999.00, 689, 73, 54, 805, 184.00);

-- --------------------------------------------------------

--
-- Table structure for table `motor_images`
--

CREATE TABLE `motor_images` (
  `image_id` int(11) NOT NULL,
  `motor_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motor_images`
--

INSERT INTO `motor_images` (`image_id`, `motor_id`, `image_path`) VALUES
(1, 2, '../uploads/6673f3c29d56f_yamaha-mt07-abs-2024-cinza-lateral-direita-800x445-2095436497.jpg'),
(2, 2, '../uploads/6673f72340bbf_443004395_317501407904680_1089646530739047565_n.jpg'),
(4, 2, '../uploads/66742ba2ca008_background_yamaha.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status`) VALUES
(1, 'Active'),
(2, 'Cancelled'),
(3, 'Disabled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `motorlicenses`
--
ALTER TABLE `motorlicenses`
  ADD PRIMARY KEY (`motorlicense_id`);

--
-- Indexes for table `motors`
--
ALTER TABLE `motors`
  ADD PRIMARY KEY (`motor_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `motorlicense_id` (`motorlicense_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `motor_images`
--
ALTER TABLE `motor_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `motor_id` (`motor_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `motorlicenses`
--
ALTER TABLE `motorlicenses`
  MODIFY `motorlicense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `motors`
--
ALTER TABLE `motors`
  MODIFY `motor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `motor_images`
--
ALTER TABLE `motor_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `motors`
--
ALTER TABLE `motors`
  ADD CONSTRAINT `motors_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `motors_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`),
  ADD CONSTRAINT `motors_ibfk_3` FOREIGN KEY (`motorlicense_id`) REFERENCES `motorlicenses` (`motorlicense_id`),
  ADD CONSTRAINT `motors_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `motor_images`
--
ALTER TABLE `motor_images`
  ADD CONSTRAINT `motor_images_ibfk_1` FOREIGN KEY (`motor_id`) REFERENCES `motors` (`motor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
