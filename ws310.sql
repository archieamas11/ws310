-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 07:04 PM
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
-- Database: `ws310`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_full_name` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `sex` varchar(100) DEFAULT NULL,
  `civil_status` varchar(100) DEFAULT NULL,
  `tax_identification_number` varchar(15) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `telephone_number` varchar(15) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `region_code` varchar(100) NOT NULL,
  `province` varchar(50) DEFAULT NULL,
  `province_code` varchar(100) NOT NULL,
  `municipality` varchar(50) DEFAULT NULL,
  `municipality_code` varchar(100) NOT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `barangay_code` varchar(100) NOT NULL,
  `home_address` varchar(250) NOT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `fathers_full_name` varchar(100) DEFAULT NULL,
  `mothers_full_name` varchar(100) DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_full_name`, `date_of_birth`, `sex`, `civil_status`, `tax_identification_number`, `nationality`, `religion`, `place_of_birth`, `phone_number`, `email_address`, `telephone_number`, `region`, `region_code`, `province`, `province_code`, `municipality`, `municipality_code`, `barangay`, `barangay_code`, `home_address`, `zip_code`, `fathers_full_name`, `mothers_full_name`, `date_created`) VALUES
(1021, 'archie amas albarico', '1987-10-24', 'male', 'married', '123456789', 'filipino', 'roman catholic', 'vicente sotto memorial medical center', '09123456789', 'archiealbarico69@gmail.com', '02123456789', 'Region VII (Central Visayas)', '0300000000', 'Cebu', '0301400000', 'Minglanilla', '0301414000', 'Poblacion Ward IV', '0301414008', 'Tunghaan, Minglanilla, Cebu', '6046', 'mario beduya amas', 'jessie amas sd', '2025-02-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1022;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
