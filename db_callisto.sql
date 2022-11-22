/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.24-MariaDB : Database - db_callisto
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_callisto` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_callisto`;

/*Table structure for table `account` */

DROP TABLE IF EXISTS `account`;

CREATE TABLE `account` (
  `acc_id` varchar(6) NOT NULL,
  `acc_email` varchar(255) NOT NULL,
  `acc_user` varchar(255) NOT NULL,
  `acc_name` varchar(255) NOT NULL,
  `acc_pass` varchar(255) NOT NULL,
  `acc_telp` varchar(15) NOT NULL,
  `acc_gender` int(1) NOT NULL,
  `acc_alamat` varchar(255) DEFAULT NULL,
  `acc_profile` varchar(255) DEFAULT NULL,
  `acc_tglLahir` date DEFAULT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `account` */

insert  into `account`(`acc_id`,`acc_email`,`acc_user`,`acc_name`,`acc_pass`,`acc_telp`,`acc_gender`,`acc_alamat`,`acc_profile`,`acc_tglLahir`) values 
('AC001','akunpertama@gmail.com','akun_pertama','akun pertama','akun1','123456781234',1,'jl. rumah akun pertama 1 no 1',NULL,'2001-01-01');

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `cart_customer_id` varchar(5) NOT NULL,
  `cart_pro_id` varchar(5) NOT NULL,
  KEY `cart_customer_id` (`cart_customer_id`),
  KEY `cart_pro_id` (`cart_pro_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cart_customer_id`) REFERENCES `account` (`acc_id`),
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`cart_pro_id`) REFERENCES `product` (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `cart` */

/*Table structure for table `d_trans` */

DROP TABLE IF EXISTS `d_trans`;

CREATE TABLE `d_trans` (
  `dt_id` varchar(6) NOT NULL,
  `dt_amount` int(4) NOT NULL,
  `dt_subtotal` int(11) NOT NULL,
  `dt_ht_invoice` varchar(11) NOT NULL,
  `dt_pro_id` varchar(6) NOT NULL,
  PRIMARY KEY (`dt_id`),
  KEY `dt_ht_invoice` (`dt_ht_invoice`),
  KEY `dt_pro_id` (`dt_pro_id`),
  CONSTRAINT `d_trans_ibfk_1` FOREIGN KEY (`dt_ht_invoice`) REFERENCES `h_trans` (`ht_invoice`),
  CONSTRAINT `d_trans_ibfk_2` FOREIGN KEY (`dt_pro_id`) REFERENCES `product` (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `d_trans` */

/*Table structure for table `h_trans` */

DROP TABLE IF EXISTS `h_trans`;

CREATE TABLE `h_trans` (
  `ht_invoice` varchar(255) NOT NULL,
  `ht_date` varchar(255) NOT NULL,
  `ht_total` int(11) NOT NULL,
  `ht_status` int(1) NOT NULL DEFAULT 0,
  `ht_customer_id` varchar(6) NOT NULL,
  PRIMARY KEY (`ht_invoice`),
  KEY `fkhtrans_customer` (`ht_customer_id`),
  CONSTRAINT `fkhtrans_customer` FOREIGN KEY (`ht_customer_id`) REFERENCES `account` (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `h_trans` */

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `pay_id` varchar(5) NOT NULL,
  `pay_ht_invoice` varchar(11) NOT NULL,
  `pay_customer_id` varchar(6) NOT NULL,
  PRIMARY KEY (`pay_id`),
  KEY `pay_ht_invoice` (`pay_ht_invoice`),
  KEY `pay_customer_id` (`pay_customer_id`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`pay_ht_invoice`) REFERENCES `h_trans` (`ht_invoice`),
  CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`pay_customer_id`) REFERENCES `account` (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `payment` */

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `pro_id` varchar(6) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `pro_price` int(11) NOT NULL,
  `pro_stock` int(5) NOT NULL,
  `pro_color` varchar(255) NOT NULL,
  `pro_size` varchar(2) NOT NULL,
  `pro_detail` varchar(255) NOT NULL,
  `pro_picture` varchar(255) NOT NULL,
  `pro_status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `product` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
