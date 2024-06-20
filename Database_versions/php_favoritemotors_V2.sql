-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 09:07 PM
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
  `weight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motors`
--

INSERT INTO `motors` (`motor_id`, `category_id`, `brand_id`, `motorlicense_id`, `status_id`, `name`, `price`, `cc`, `pk`, `kw`, `seat_height`, `weight`) VALUES
(2, 2, 7, 2, 1, 'MT-07', 8999.00, 689, 73, 54, 805, 184),
(3, 3, 7, 2, 1, 'Tracer 7 GT', 11899.00, 689, 72, 54, 835, 196),
(4, 3, 2, 3, 1, 'S 1000 XT', 23700.00, 999, 165, 121, 840, 226),
(5, 4, 7, 3, 1, 'R1', 23499.00, 998, 200, 147, 855, 201);

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
(4, 2, '../uploads/66742ba2ca008_background_yamaha.jpg'),
(5, 2, '../uploads/66743c196e495_th-2676593890.jpg'),
(6, 2, '../uploads/66743c196fec2_th-4012999008.jpg'),
(7, 2, '../uploads/66743c19714a1_th-2520907942.jpg'),
(8, 2, '../uploads/66743c197269b_th-1155866338.jpg'),
(9, 2, '../uploads/66743c19736bc_th-1670823994.jpg'),
(10, 2, '../uploads/66743c19745d7_th-2260021346.jpg'),
(11, 2, '../uploads/66743c1975045_th-1203694488.jpg'),
(12, 2, '../uploads/66743c1975a8e_th-1328444926.jpg'),
(13, 2, '../uploads/66743c1976a6d_th-187182414.jpg'),
(14, 2, '../uploads/66743c1977cb5_th-1091519318.jpg'),
(15, 2, '../uploads/66743c1979272_f82d1e909d3e506bc9029c7e4fedd202-1872826622.jpg'),
(16, 3, '../uploads/667467133e8c5_tracer-700-19-11-p1055170-869406995.jpg'),
(17, 3, '../uploads/667467134023d_Yamaha-Tracer-700-GT-BM-7-1200x897-3750838468.jpg'),
(18, 3, '../uploads/6674671340e24_Yamaha_Tracer_700_GT_2021_1-2796052423.jpg'),
(19, 3, '../uploads/6674671341941_my23-tracer7gt-02-4155875647.jpg'),
(20, 3, '../uploads/6674671342930_S0-yamaha-tracer-7-gt-le-retour-de-la-version-haut-de-gamme-de-la-tracer-7-652662-235719955.jpg'),
(21, 3, '../uploads/667468dbc9878_th-1516197430.jpg'),
(22, 4, '../uploads/6674694de6cca_2024-BMW-M-1000-XR-psb-scaled-1446376870.jpg'),
(23, 4, '../uploads/6674694de7f55_BMW-M-1000-XR-2024-1024x664-1980622131.jpg'),
(24, 4, '../uploads/6674694de9173_BMW_S_1000_XR_2017-1887715358.jpg'),
(25, 4, '../uploads/6674694de9c64_34663_P90234311_highRes_bmw-s-1000-xr-10-201-2452083962.jpg'),
(26, 4, '../uploads/6674694dea7fb_6.-The-All-New-BMW-S-1000-XR-1-313527602.jpg'),
(27, 4, '../uploads/66746966e3bd8_th-1735936977.jpg'),
(37, 5, '../uploads/66746f5371651_01346a542a42557f9dc19df2d7326d56-1627473666.jpg'),
(38, 5, '../uploads/66746f5372a18_39C832B2-C29F-4BCF-A9AD-4F95E2986E54.jpg'),
(39, 5, '../uploads/66746f537345b_1222994-3222054930.jpg'),
(40, 5, '../uploads/66746f5373f59_Screenshot_20240620-195054_Instagram.jpg'),
(41, 5, '../uploads/66746f5374961_Used-2016-Yamaha-R1-1617043772-1850774310.jpg'),
(42, 5, '../uploads/66746f71a3ce0_2024-Yamaha-YZF-R1M-2933232176.jpg');

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
  MODIFY `motor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `motor_images`
--
ALTER TABLE `motor_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
