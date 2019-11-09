-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2019 at 02:48 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regency` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `phone`, `email`, `regency`) VALUES
(3, 'Nguyen Van Quang', '0702404194', 'S2x32k92k13@yahoo.com.vn', 'aaaa'),
(4, 'Nguyen Van Quang', '0702404194', 'nguyenthuylinh4192@gmail.com', 'aaaa'),
(8, 'Nguyen Van Quang', '0702404194', 'nguyenthuylinh4192@gmail.com', 'aaaa'),
(9, 'Nguyen Van Dung', '04825949896', 'ngdung2012@gmail.com', 'Thay Giao'),
(10, 'Tran Van A', '841568161515', 'nttnhi070590@gmail.com', 'Quốc trưởng'),
(11, 'Tiger Trần', '8461825191', 'threeque@gmail.com', 'Cố vấn tối cao'),
(12, 'Tao có Súng', '849966996699', 'trandan4.0@gmail.com', 'Tiên tri vũ trụ'),
(13, 'T bắn mày á ', '8461825191', 'tkut3_1998@yahoo.com', 'Hải Ngoại');

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

CREATE TABLE `label` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`id`, `name`) VALUES
(1, 'cong viec'),
(2, 'game'),
(3, 'sach'),
(4, 'truong'),
(5, 'label'),
(6, 'demo');

-- --------------------------------------------------------

--
-- Table structure for table `label_contact`
--

CREATE TABLE `label_contact` (
  `id` int(11) NOT NULL,
  `label_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `label_contact`
--

INSERT INTO `label_contact` (`id`, `label_id`, `contact_id`) VALUES
(17, 1, 9),
(18, 1, 3),
(19, 6, 11),
(20, 6, 12),
(21, 6, 13),
(22, 6, 10),
(23, 1, 8),
(24, 1, 12),
(25, 2, 9),
(26, 3, 13),
(28, 3, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `label`
--
ALTER TABLE `label`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `label_contact`
--
ALTER TABLE `label_contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_id` (`contact_id`),
  ADD KEY `label_id` (`label_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `label`
--
ALTER TABLE `label`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `label_contact`
--
ALTER TABLE `label_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `label_contact`
--
ALTER TABLE `label_contact`
  ADD CONSTRAINT `label_contact_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`),
  ADD CONSTRAINT `label_contact_ibfk_2` FOREIGN KEY (`label_id`) REFERENCES `label` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
