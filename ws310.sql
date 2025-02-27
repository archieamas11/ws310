-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2025 at 03:40 PM
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
(1023, 'archie albarico', '2000-10-12', 'female', 'married', '887111111', 'Sit quisquam aut qu', 'Dolore odio nihil ne', 'Animi adipisci accu', '09491853866', 'archiealbarico69@gmail.com', '09491853866', 'Region I (Ilocos Region)', '0100000000', 'Ilocos Norte', '0102800000', 'Vintar', '0102823000', 'San Roque', '0102823053', 'tunghaan', '2222', 'Cheyenne Nora Stokes Reynolds', 'Faith Wallace Hall Rich', '2025-02-22');

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1028;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
