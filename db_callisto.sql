-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2022 at 07:42 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_callisto`
--

-- --------------------------------------------------------

CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_callisto` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_callisto`;

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` varchar(6) NOT NULL,
  `acc_email` varchar(255) NOT NULL,
  `acc_user` varchar(255) NOT NULL,
  `acc_name` varchar(255) NOT NULL,
  `acc_pass` varchar(255) NOT NULL,
  `acc_telp` varchar(15) NOT NULL,
  `acc_gender` int(1) NOT NULL,
  `acc_alamat` varchar(255) NOT NULL,
  `acc_profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_customer_id` varchar(5) NOT NULL,
  `cart_pro_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `d_trans`
--

CREATE TABLE `d_trans` (
  `dt_id` varchar(6) NOT NULL,
  `dt_amount` int(4) NOT NULL,
  `dt_subtotal` int(11) NOT NULL,
  `dt_ht_invoice` varchar(11) NOT NULL,
  `dt_pro_id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `h_trans`
--

CREATE TABLE `h_trans` (
  `ht_invoice` varchar(255) NOT NULL,
  `ht_date` varchar(255) NOT NULL,
  `ht_total` int(11) NOT NULL,
  `ht_status` int(1) NOT NULL DEFAULT 0,
  `ht_customer_id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` varchar(5) NOT NULL,
  `pay_ht_invoice` varchar(11) NOT NULL,
  `pay_customer_id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` varchar(6) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `pro_price` int(11) NOT NULL,
  `pro_stock` int(5) NOT NULL,
  `pro_color` varchar(255) NOT NULL,
  `pro_size` varchar(2) NOT NULL,
  `pro_detail` varchar(255) NOT NULL,
  `pro_picture` varchar(255) NOT NULL,
  `pro_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `cart_customer_id` (`cart_customer_id`),
  ADD KEY `cart_pro_id` (`cart_pro_id`);

--
-- Indexes for table `d_trans`
--
ALTER TABLE `d_trans`
  ADD PRIMARY KEY (`dt_id`),
  ADD KEY `dt_ht_invoice` (`dt_ht_invoice`),
  ADD KEY `dt_pro_id` (`dt_pro_id`);

--
-- Indexes for table `h_trans`
--
ALTER TABLE `h_trans`
  ADD PRIMARY KEY (`ht_invoice`),
  ADD KEY `fkhtrans_customer` (`ht_customer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `pay_ht_invoice` (`pay_ht_invoice`),
  ADD KEY `pay_customer_id` (`pay_customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_customer_id`) REFERENCES `account` (`acc_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`cart_pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `d_trans`
--
ALTER TABLE `d_trans`
  ADD CONSTRAINT `d_trans_ibfk_1` FOREIGN KEY (`dt_ht_invoice`) REFERENCES `h_trans` (`ht_invoice`),
  ADD CONSTRAINT `d_trans_ibfk_2` FOREIGN KEY (`dt_pro_id`) REFERENCES `product` (`pro_id`);

--
-- Constraints for table `h_trans`
--
ALTER TABLE `h_trans`
  ADD CONSTRAINT `fkhtrans_customer` FOREIGN KEY (`ht_customer_id`) REFERENCES `account` (`acc_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`pay_ht_invoice`) REFERENCES `h_trans` (`ht_invoice`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`pay_customer_id`) REFERENCES `account` (`acc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
