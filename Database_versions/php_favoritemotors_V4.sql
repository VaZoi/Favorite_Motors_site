-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 10:31 PM
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
(6, 'Classic'),
(8, 'Adventure-Tour');

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
  `weight` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motors`
--

INSERT INTO `motors` (`motor_id`, `category_id`, `brand_id`, `motorlicense_id`, `status_id`, `name`, `price`, `cc`, `pk`, `kw`, `seat_height`, `weight`, `likes`) VALUES
(2, 2, 7, 2, 1, 'MT-07', 8999.00, 689, 73, 54, 805, 184, 48),
(3, 3, 7, 2, 1, 'Tracer 7 GT', 11899.00, 689, 72, 54, 835, 196, 35),
(4, 3, 2, 3, 1, 'S 1000 XT', 23700.00, 999, 165, 121, 840, 226, 10),
(5, 4, 7, 3, 1, 'R1', 23499.00, 998, 200, 147, 855, 201, 16),
(7, 2, 7, 3, 1, 'MT-10', 18099.00, 998, 160, 118, 825, 212, 20),
(8, 8, 9, 2, 1, 'V-Strom 650A', 9899.00, 645, 70, 52, 835, 213, 51);

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
(42, 5, '../uploads/66746f71a3ce0_2024-Yamaha-YZF-R1M-2933232176.jpg'),
(44, 2, '../uploads/66752353049a8_accessories-recommendations-v0-m5698j03le6d1.webp'),
(45, 2, '../uploads/66752353057ca_9jvrgqml4o6d1.webp'),
(46, 2, '../uploads/6675235306331_took-this-tonight-v0-ef0vuj54tn6d1.webp'),
(47, 2, '../uploads/6675235307388_my-07-23-beauty-so-far-v0-ihlrklnn4r6d1.webp'),
(48, 2, '../uploads/66752353084fd_got-my-24-tuned-v0-7deoj92rfy6d1.webp'),
(49, 2, '../uploads/66752353091e1_06wn39k3947d1.webp'),
(50, 2, '../uploads/6675235309f92_first-ride-out-as-soon-as-i-passed-my-exam-v0-k2h8p9z3r57d1.webp'),
(51, 2, '../uploads/667523530af95_they-said-dont-get-a-black-bike-as-your-first-bike-v0-z1w8sv6kn47d1.webp'),
(52, 2, '../uploads/667523530be9c_first-post-v0-gtqwgub2xj7d1.webp'),
(53, 2, '../uploads/667523530cc4c_picked-her-up-yesterday-brand-new-24-v0-yr430obtln7d1.webp'),
(54, 2, '../uploads/667523530d918_second-mt07-v0-e27oad8k0t7d1.webp'),
(55, 2, '../uploads/667523530e6eb_parking-garage-lighting-hits-different-v0-hqanmua58s7d1.webp'),
(56, 2, '../uploads/6675af6d2eb17_burnout-fz09.gif'),
(57, 2, '../uploads/6675af94b8083_on-the-road-motorcyclist.gif'),
(59, 7, '../uploads/667d3613b9f9f_Yamaha-MT-10-2017-700px-1975797176.jpg'),
(60, 7, '../uploads/667d36337de25_thumb-1920-1007671-1225040769.jpg'),
(61, 7, '../uploads/667d3647e988a_2022_yam_mt10spns_us_bwm2_sta_003_03-2686719133.jpg'),
(62, 7, '../uploads/667d36ffdbd5f_yamaha-mt10-sport-test-11-3785140387.jpg'),
(63, 7, '../uploads/667d36ffdd160_maxresdefault-1120149611.jpg'),
(64, 7, '../uploads/667d36ffdd9d1_2016_YAM_MT10_EU_BNS4DSJ_DET_005-4287734150.jpg'),
(65, 7, '../uploads/667d36ffdf013_18_8-937200311.jpg'),
(66, 7, '../uploads/667d376badf87_MT-101.jpg'),
(67, 7, '../uploads/667d376baffbd_5-32-746030683.jpg'),
(68, 7, '../uploads/667d376bb122c_wp3946300-348545056.jpg'),
(69, 7, '../uploads/667d376bb23a5_2021-Yamaha-MT-10a-326337118.jpg'),
(70, 8, '../uploads/66f6d8facf83c_V-Strom_650_Adventure_pack.webp'),
(71, 8, '../uploads/66f6d8fad151c_2025_Adventure_V-Strom_650_PPH_2500x1227.jpg'),
(72, 8, '../uploads/66f6d8fad29c4_suzuki-v-strom-650-abs-88565-243539812.jpg'),
(73, 8, '../uploads/66f6d8fad3c61_suzuki-vstrom-650-abs-adventure-2014-4-460297854.jpg'),
(74, 8, '../uploads/66f6d8fad5225_suzuki-vstrom-650-abs-traveller-2010-2-3388164309.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `distance_km` float NOT NULL,
  `duration_hours` float NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `file_path`, `distance_km`, `duration_hours`, `description`, `created_at`) VALUES
(1, 'Ruim rondje Ijsselmeer', '../uploads/routes/ruim-rondje-ijsselmeer.gpx', 460.68, 9.07861, 'De route is bedoeld voor een tochtje Friesland, Weerribben, Veluwe. Met begin en eindpunt in Den Helder', '2024-09-27 18:08:46'),
(2, 'Fahlenscheid', '../uploads/routes/fahlenscheid.gpx', 458.21, 0, 'Kort rondje om de dag mee te beginnen.', '2024-09-27 18:41:47'),
(3, 'Socialrun (2016)', '../uploads/routes/socialrun-2016.gpx', 554.662, 0, 'Route van de social run 2016 (estafetteloop tegen stigmatisering in de psychiatrie) . Ruim rondje om het ijsselmeer. Flinke tocht, reken op een hele dag!', '2024-09-27 18:45:50'),
(4, 'Twee dagen rit brabant - Arum (Friesland) ', '../uploads/routes/twee-dagen-rit-brabant-arum-friesland.gpx', 611.359, 0, 'Met vrienden twee dagen getoerd, van Brabant naar Friesland, rondom het IJsselmeer. Overnachting in Arum, Hotel de Gekroonde Leeuw. Routepunt 104. Aanrader. Alles wat je nodig hebt is er. Maar je kan het natuurlijk ook in een dag doen.', '2024-09-27 18:57:03'),
(5, 'Kelmond - Mosel - Kelmond', '../uploads/routes/kelmond-mosel-kelmond.gpx', 461.708, 0, 'Kelmond - Badmunster Eifel - Burnburgring - Cochum - Marialach - Heimbach - Brand - Kelmond', '2024-09-27 19:08:21'),
(6, 'Idromeer Gardameer Kranenburg', '../uploads/routes/idromeer-gardameer-kranenburg.gpx', 1357.75, 0, 'Via Idromeer, Gardameer, Tirol, Romantische Strasse, Sauerland kom je weer in Kranenburg, dichtbij Nederland aan.', '2024-09-27 19:12:49'),
(7, 'tour de france', '../uploads/routes/routeyou-tour-de-france.gpx', 6088.95, 0, 'tour de france', '2024-09-27 19:27:32'),
(8, 'Essais Cap Nord', '../uploads/routes/routeyou-essais-cap-nord.gpx', 10874.3, 0, 'Essais Cap Nord', '2024-09-27 19:36:48'),
(9, 'A Nice CALM Ride', '../uploads/routes/routeyou-a-nice-calm-ride.gpx', 8705.75, 0, 'A Nice CALM Ride', '2024-09-27 19:44:11'),
(10, 'Rondje_Texel', '../uploads/routes/routeyou-rondje-texel.gpx', 97.1519, 0, 'Rondje_Texel', '2024-09-27 19:46:48');

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
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `motorlicenses`
--
ALTER TABLE `motorlicenses`
  MODIFY `motorlicense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `motors`
--
ALTER TABLE `motors`
  MODIFY `motor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `motor_images`
--
ALTER TABLE `motor_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
