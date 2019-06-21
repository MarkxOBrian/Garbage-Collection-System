-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2019 at 02:41 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waste_mngt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_signup`
--

CREATE TABLE `admin_signup` (
  `full_name` varchar(50) NOT NULL,
  `email_adm` varchar(50) NOT NULL,
  `password_adm` varchar(16) NOT NULL,
  `phone_no` int(10) NOT NULL,
  `City` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_reg`
--

CREATE TABLE `company_reg` (
  `comp_id` int(11) NOT NULL,
  `comp_name` varchar(50) NOT NULL,
  `comp_email` varchar(50) NOT NULL,
  `comp_category` varchar(50) NOT NULL,
  `comp_location` varchar(50) NOT NULL,
  `comp_dtls` longtext NOT NULL,
  `comp_phone` int(10) NOT NULL,
  `comp_pwd` varchar(255) NOT NULL,
  `comp_logo` text NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_reg`
--

INSERT INTO `company_reg` (`comp_id`, `comp_name`, `comp_email`, `comp_category`, `comp_location`, `comp_dtls`, `comp_phone`, `comp_pwd`, `comp_logo`, `date_registered`, `last_login`) VALUES
(18, 'Multimedia University', 'infor@mmu.ac.ke', 'Stationary Waste', 'Nairobi', 'ConnectedPDF is a disruptive technology that brings new levels of accountable, collaboration, and productivity to the creation, sharing, and tracking of PDF documents worldwide.\r\nConnectedPDF creates a more productive and secure environment by embedding identity and intelligence into PDF documents for the first time.', 0, '$2y$10$3fTu5lE0p.VnbkER6cSsh.DUVsi4tCuZGiSvhlTPgfY8GCfGjHx/.', '/ProjectMini/complogo/images/e069abe901ea3723922fd4ff64c33251.jpg', '2018-08-15 09:17:57', '2018-08-15 08:20:26'),
(21, 'Moringa', 'moringa@ymail.com', 'Liquid Waste', 'Eldoret', 'Company Description', 754568565, '$2y$10$3wLgOtTAFOM.wRG7yLXB1O1PFNOtd3UWnFuaYDVGDmCO9xAKQEVUq', '/ProjectMini/complogo/images/ed2da2be39aa6164e65a5006549a3d91.jpg', '2018-08-15 17:50:44', '0000-00-00 00:00:00'),
(22, 'Katachom', 'katachom@gmail.com', 'Stationary Waste', 'Nairobi', 'We are a waste disposal company', 754568565, '$2y$10$qXddZ.9enQ/qzueaVLMfYOD0v9/3DffDNP9VrzBA5G9N1tM1GMEWy', '/ProjectMini/complogo/images/40225796611718d8084e553479928407.jpg', '2018-08-16 17:34:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `phone_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `company_name`, `email`, `location`, `phone_number`) VALUES
(1, 'Moringa', 'otieno@gmail.com', 'Eldoret', 789088872);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cellphone` int(10) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`id`, `first_name`, `second_name`, `email`, `location`, `password`, `cellphone`, `date_registered`, `last_login`) VALUES
(31, 'Brian ', 'Ouma', 'brian@me.com', 'Mombasa', '$2y$10$3zHr4exqFsywEn2nIh1s/.8UlBkNb70h925oYdceK9VenctY1hGrq', 712345678, '2019-06-14 16:32:55', '2019-06-15 08:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `super_id` int(11) NOT NULL,
  `super_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`super_id`, `super_email`, `password`, `date_registered`, `last_login`) VALUES
(1, 'admin@smartdisposal.co.ke', '$2y$10$2.JBVZTNRBnNudeyVL4zxu3LyivomIZdaN1gsxz/CrIZ7TwEp5rb2', '2018-08-15 00:00:00', '2019-06-21 14:38:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_reg`
--
ALTER TABLE `company_reg`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`super_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_reg`
--
ALTER TABLE `company_reg`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `super_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
