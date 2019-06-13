-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2019 at 09:17 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DemoLogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminUser`
--

CREATE TABLE `adminUser` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminUser`
--

INSERT INTO `adminUser` (`id`, `username`, `password`, `email`) VALUES
(1, 'Navayuvan', '600cf396d9cd4acabb30eeaefb4bf16d', 'navayuvan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `ShopLogin`
--

CREATE TABLE `ShopLogin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ShopLogin`
--

INSERT INTO `ShopLogin` (`id`, `username`, `password`) VALUES
(9, 'MMN27', 'c082d69011f85eaff1ffb93e2d7a6137'),
(10, 'MMN30', 'd823a560bbcfa9db5e34eaa06a3bc28c');

-- --------------------------------------------------------

--
-- Table structure for table `Shops`
--

CREATE TABLE `Shops` (
  `id` int(11) NOT NULL,
  `shopName` varchar(40) NOT NULL,
  `seatCapacity` varchar(5) NOT NULL,
  `openingTime` text NOT NULL,
  `closingTime` text NOT NULL,
  `leaveDays` varchar(30) NOT NULL,
  `ownerName` varchar(40) NOT NULL,
  `contactNumber` varchar(30) NOT NULL,
  `Pricing` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `street` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` mediumint(9) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `bookings` int(11) NOT NULL DEFAULT '0',
  `offers` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Shops`
--

INSERT INTO `Shops` (`id`, `shopName`, `seatCapacity`, `openingTime`, `closingTime`, `leaveDays`, `ownerName`, `contactNumber`, `Pricing`, `email`, `street`, `city`, `state`, `pincode`, `status`, `bookings`, `offers`) VALUES
(27, 'Nat', '5', '10:50', '12:30', '2nd week Tuesday', 'Natasha', '9999999999', 'jhg - 10, huiuh - 50', 'navayuvan@gmail.com', 'Adadad', 'Dindigfyuk', 'TN', 600606, 1, 0, NULL),
(30, 'Nata', '5', '10:50', '12:30', '2nd week Tuesday', 'Natasha', '9999999999', 'jhg - 10, huiuh - 50', 'navayuvan@gmail.com', 'Adadad', 'Dindigfyuk', 'TN', 600606, 0, 0, NULL);

--
-- Triggers `Shops`
--
DELIMITER $$
CREATE TRIGGER `shopLoginAdd` AFTER INSERT ON `Shops` FOR EACH ROW INSERT INTO `ShopLogin` (`username`, `password`) VALUES (CONCAT("MMN", NEW.id), MD5(CONCAT("MMN", NEW.id)))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `email`) VALUES
(7, 'Navayuvan', '25f9e794323b453885f5181f1b624d0b', 'nava@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminUser`
--
ALTER TABLE `adminUser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ShopLogin`
--
ALTER TABLE `ShopLogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Shops`
--
ALTER TABLE `Shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminUser`
--
ALTER TABLE `adminUser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ShopLogin`
--
ALTER TABLE `ShopLogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Shops`
--
ALTER TABLE `Shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
