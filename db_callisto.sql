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
('AC001','akunpertama@gmail.com','akun_pertama','akun pertama','akun1','123456781234',1,'jl. rumah akun pertama 1 no 1','kucing.jpg','2001-01-01');

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `cart_customer_id` varchar(6) NOT NULL,
  `cart_pro_id` varchar(6) NOT NULL,
  `qty` int(11) NOT NULL,
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
  `pro_size` varchar(2) NOT NULL,
  `pro_detail` varchar(255) NOT NULL,
  `pro_picture` varchar(255) NOT NULL,
  `pro_status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `product` */

insert  into `product`(`pro_id`,`pro_name`,`pro_price`,`pro_stock`,`pro_size`,`pro_detail`,`pro_picture`,`pro_status`) values 
('PD001','CASABLANCA L\'Arche De Nuit Printed T-Shirt Black',8700000,50,'s','CASABLANCA L\'Arche De Nuit Printed T-Shirt with Black color and 100% Cotton','product_1.png',1),
('PD002','CASABLANCA L\'Arche De Nuit Printed T-Shirt Black',9200000,50,'m','CASABLANCA L\'Arche De Nuit Printed T-Shirt with Black color and 100% Cotton','product_1.png',1),
('PD003','CASABLANCA L\'Arche De Nuit Printed T-Shirt Black',9700000,50,'l','CASABLANCA L\'Arche De Nuit Printed T-Shirt with Black color and 100% Cotton','product_1.png',1),
('PD004','CASABLANCA L\'Arche De Nuit Printed T-Shirt Black',10000000,50,'xl','CASABLANCA L\'Arche De Nuit Printed T-Shirt with Black color and 100% Cotton','product_1.png',1),
('PD005','AMI PARIS Logo T-Shirt Dark Beige',7200000,50,'s','A tonal beige colourway creates a more subtle appearance for the signature Ami de Coeur motif on this AMI Paris T-shirt.','product_2.png',1),
('PD006','AMI PARIS Logo T-Shirt Dark Beige',7900000,50,'m','A tonal beige colourway creates a more subtle appearance for the signature Ami de Coeur motif on this AMI Paris T-shirt.','product_2.png',1),
('PD007','AMI PARIS Logo T-Shirt Dark Beige',8400000,50,'l','A tonal beige colourway creates a more subtle appearance for the signature Ami de Coeur motif on this AMI Paris T-shirt.','product_2.png',1),
('PD008','AMI PARIS Logo T-Shirt Dark Beige',8900000,50,'xl','A tonal beige colourway creates a more subtle appearance for the signature Ami de Coeur motif on this AMI Paris T-shirt.','product_2.png',1),
('PD009','AMI PARIS Logo T-Shirt Dark Beige',6300000,50,'s','Crafted from organic cotton, this AMI Paris T-shirt boasts the signature Ami de Coeur monogram motif to the front. A brand signature, this logo is taken from founder Alexandre Mattiussi\'s sign off in letters to friends.','product_3.png',1),
('PD010','AMI PARIS Logo T-Shirt Dark Beige',6700000,50,'m','Crafted from organic cotton, this AMI Paris T-shirt boasts the signature Ami de Coeur monogram motif to the front. A brand signature, this logo is taken from founder Alexandre Mattiussi\'s sign off in letters to friends.','product_3.png',1),
('PD011','AMI PARIS Logo T-Shirt Dark Beige',7300000,50,'l','Crafted from organic cotton, this AMI Paris T-shirt boasts the signature Ami de Coeur monogram motif to the front. A brand signature, this logo is taken from founder Alexandre Mattiussi\'s sign off in letters to friends.','product_3.png',1),
('PD012','AMI PARIS Logo T-Shirt Dark Beige',8000000,50,'xl','Crafted from organic cotton, this AMI Paris T-shirt boasts the signature Ami de Coeur monogram motif to the front. A brand signature, this logo is taken from founder Alexandre Mattiussi\'s sign off in letters to friends.','product_3.png',1),
('PD013','HUGO Relaxed-fit Cotton T-shirt Black',5000000,50,'s','A signature T-shirt in a laid-back fit by HUGO Menswear. Trimmed with a HUGO logo badge, this short-sleeved T-shirt is detailed with tonal woven material at the drawcord hem and chest pocket. The pure-cotton fabric is treated for an extra-soft finish.','product_4.png',1),
('PD014','HUGO Relaxed-fit Cotton T-shirt Black',5300000,50,'m','A signature T-shirt in a laid-back fit by HUGO Menswear. Trimmed with a HUGO logo badge, this short-sleeved T-shirt is detailed with tonal woven material at the drawcord hem and chest pocket. The pure-cotton fabric is treated for an extra-soft finish.','product_4.png',1),
('PD015','HUGO Relaxed-fit Cotton T-shirt Black',5700000,50,'l','A signature T-shirt in a laid-back fit by HUGO Menswear. Trimmed with a HUGO logo badge, this short-sleeved T-shirt is detailed with tonal woven material at the drawcord hem and chest pocket. The pure-cotton fabric is treated for an extra-soft finish.','product_4.png',1),
('PD016','HUGO Relaxed-fit Cotton T-shirt Black',6000000,50,'xl','A signature T-shirt in a laid-back fit by HUGO Menswear. Trimmed with a HUGO logo badge, this short-sleeved T-shirt is detailed with tonal woven material at the drawcord hem and chest pocket. The pure-cotton fabric is treated for an extra-soft finish.','product_4.png',1),
('PD017','PALM ANGELS Splatter Palm Classic T-Shirt Butter/Black',6000000,50,'s','ecru/black gold-tone cotton palm tree print logo print to the rear paint splatter detail crew neck short sleeves straight hem','product_5.png',1),
('PD018','PALM ANGELS Splatter Palm Classic T-Shirt Butter/Black',6200000,50,'l','ecru/black gold-tone cotton palm tree print logo print to the rear paint splatter detail crew neck short sleeves straight hem','product_5.png',1),
('PD019','PALM ANGELS Splatter Palm Classic T-Shirt Butter/Black',6400000,50,'m','ecru/black gold-tone cotton palm tree print logo print to the rear paint splatter detail crew neck short sleeves straight hem','product_5.png',1),
('PD020','PALM ANGELS Splatter Palm Classic T-Shirt Butter/Black',6600000,50,'xl','ecru/black gold-tone cotton palm tree print logo print to the rear paint splatter detail crew neck short sleeves straight hem','product_5.png',1),
('PD021','AMI PARIS Logo T-Shirt Black',1500000,50,'s','One of AMI Paris\' signature pieces, the Ami de Coeur T-shirt appears here in an organic cotton fabrication in a black hue. The distinguishing embroidered logo on the chest is seen in a tonal iteration, adding to the piece\'s understated style.','product_6.png',1),
('PD022','AMI PARIS Logo T-Shirt Black',1600000,50,'m','One of AMI Paris\' signature pieces, the Ami de Coeur T-shirt appears here in an organic cotton fabrication in a black hue. The distinguishing embroidered logo on the chest is seen in a tonal iteration, adding to the piece\'s understated style.','product_6.png',1),
('PD023','AMI PARIS Logo T-Shirt Black',1700000,50,'l','One of AMI Paris\' signature pieces, the Ami de Coeur T-shirt appears here in an organic cotton fabrication in a black hue. The distinguishing embroidered logo on the chest is seen in a tonal iteration, adding to the piece\'s understated style.','product_6.png',1),
('PD024','AMI PARIS Logo T-Shirt Black',1800000,50,'xl','One of AMI Paris\' signature pieces, the Ami de Coeur T-shirt appears here in an organic cotton fabrication in a black hue. The distinguishing embroidered logo on the chest is seen in a tonal iteration, adding to the piece\'s understated style.','product_6.png',1),
('PD025','AMI PARIS Ami De Coeur Logo T-Shirt Parma',1000000,50,'s','Crafted from organic cotton, this AMI Paris T-shirt boasts the Ami de Coeur motif to the front. A brand signature, this logo is taken from founder Alexandre Mattiussi\'s sign off in letters to friends.','product_7.png',1),
('PD026','AMI PARIS Ami De Coeur Logo T-Shirt Parma',1200000,50,'m','Crafted from organic cotton, this AMI Paris T-shirt boasts the Ami de Coeur motif to the front. A brand signature, this logo is taken from founder Alexandre Mattiussi\'s sign off in letters to friends.','product_7.png',1),
('PD027','AMI PARIS Ami De Coeur Logo T-Shirt Parma',1400000,50,'l','Crafted from organic cotton, this AMI Paris T-shirt boasts the Ami de Coeur motif to the front. A brand signature, this logo is taken from founder Alexandre Mattiussi\'s sign off in letters to friends.','product_7.png',1),
('PD028','AMI PARIS Ami De Coeur Logo T-Shirt Parma',1600000,50,'xl','Crafted from organic cotton, this AMI Paris T-shirt boasts the Ami de Coeur motif to the front. A brand signature, this logo is taken from founder Alexandre Mattiussi\'s sign off in letters to friends.','product_7.png',1),
('PD029','BALENCIAGA Strike 1917 Oversized T-Shirt Khaki',8500000,50,'s','Cut to an oversized silhouette, this relaxed t-shirt from Balenciaga is detailed with the brand\'s Strike 1917 logo print motif at the chest and rear.','product_8.png',1),
('PD030','BALENCIAGA Strike 1917 Oversized T-Shirt Khaki',8600000,50,'m','Cut to an oversized silhouette, this relaxed t-shirt from Balenciaga is detailed with the brand\'s Strike 1917 logo print motif at the chest and rear.','product_8.png',1),
('PD031','BALENCIAGA Strike 1917 Oversized T-Shirt Khaki',8700000,50,'l','Cut to an oversized silhouette, this relaxed t-shirt from Balenciaga is detailed with the brand\'s Strike 1917 logo print motif at the chest and rear.','product_8.png',1),
('PD032','BALENCIAGA Strike 1917 Oversized T-Shirt Khaki',8900000,50,'xl','Cut to an oversized silhouette, this relaxed t-shirt from Balenciaga is detailed with the brand\'s Strike 1917 logo print motif at the chest and rear.','product_8.png',1),
('PD033','MONCLER GENIUS X 7 MONCLER FRGMT HIROSHI FUJIWARA Circus S/S T-Shirt Red',4500000,50,'s','Reflecting the dedication to lower the brand\'s environmental impact, this t-shirt is crafted from organic cotton. The classic crew neck is embellished with a printed motif on the back. The loose fit style is part of the 7 Moncler FRGMT Hiroshi Fujiwara co','product_9.png',1),
('PD034','MONCLER GENIUS X 7 MONCLER FRGMT HIROSHI FUJIWARA Circus S/S T-Shirt Red',4600000,50,'m','Reflecting the dedication to lower the brand\'s environmental impact, this t-shirt is crafted from organic cotton. The classic crew neck is embellished with a printed motif on the back. The loose fit style is part of the 7 Moncler FRGMT Hiroshi Fujiwara co','product_9.png',1),
('PD035','MONCLER GENIUS X 7 MONCLER FRGMT HIROSHI FUJIWARA Circus S/S T-Shirt Red',4700000,50,'l','Reflecting the dedication to lower the brand\'s environmental impact, this t-shirt is crafted from organic cotton. The classic crew neck is embellished with a printed motif on the back. The loose fit style is part of the 7 Moncler FRGMT Hiroshi Fujiwara co','product_9.png',1),
('PD036','MONCLER GENIUS X 7 MONCLER FRGMT HIROSHI FUJIWARA Circus S/S T-Shirt Red',4900000,50,'xl','Reflecting the dedication to lower the brand\'s environmental impact, this t-shirt is crafted from organic cotton. The classic crew neck is embellished with a printed motif on the back. The loose fit style is part of the 7 Moncler FRGMT Hiroshi Fujiwara co','product_9.png',1),
('PD037','ALEXANDER MCQUEEN Logo Print T-Shirt Blue',4800000,50,'s','Alexander McQueen\'s paintbrush-style logo print punctuates the chest of this cotton T-shirt design, demonstrating the brand\'s creative flair whilst exhibiting a more casual tone in line with contemporary street style.','product_10.png',1),
('PD038','ALEXANDER MCQUEEN Logo Print T-Shirt Blue',5100000,50,'m','Alexander McQueen\'s paintbrush-style logo print punctuates the chest of this cotton T-shirt design, demonstrating the brand\'s creative flair whilst exhibiting a more casual tone in line with contemporary street style.','product_10.png',1),
('PD039','ALEXANDER MCQUEEN Logo Print T-Shirt Blue',5300000,50,'l','Alexander McQueen\'s paintbrush-style logo print punctuates the chest of this cotton T-shirt design, demonstrating the brand\'s creative flair whilst exhibiting a more casual tone in line with contemporary street style.','product_10.png',1),
('PD040','ALEXANDER MCQUEEN Logo Print T-Shirt Blue',5600000,50,'xl','Alexander McQueen\'s paintbrush-style logo print punctuates the chest of this cotton T-shirt design, demonstrating the brand\'s creative flair whilst exhibiting a more casual tone in line with contemporary street style.','product_10.png',1),
('PD041','LANVIN Embossed Logo Ombré Cotton T-shirt Teal Blue',8000000,50,'s','Enhancing Lanvin\'s timeless Parisian style with contemporary detailing, this T-shirt exhibits a playful ombré effect, whilst a logo punctuates its front.','product_11.png',1),
('PD042','LANVIN Embossed Logo Ombré Cotton T-shirt Teal Blue',8300000,50,'m','Enhancing Lanvin\'s timeless Parisian style with contemporary detailing, this T-shirt exhibits a playful ombré effect, whilst a logo punctuates its front.','product_11.png',1),
('PD043','LANVIN Embossed Logo Ombré Cotton T-shirt Teal Blue',8600000,50,'l','Enhancing Lanvin\'s timeless Parisian style with contemporary detailing, this T-shirt exhibits a playful ombré effect, whilst a logo punctuates its front.','product_11.png',1),
('PD044','LANVIN Embossed Logo Ombré Cotton T-shirt Teal Blue',8900000,50,'xl','Enhancing Lanvin\'s timeless Parisian style with contemporary detailing, this T-shirt exhibits a playful ombré effect, whilst a logo punctuates its front.','product_11.png',1),
('PD045','OFF-WHITE Paint Script Over T-Shirt Black',7100000,50,'s','black/white cotton signature Arrows motif logo print to the front logo print to the rear.','product_12.png',1),
('PD046','OFF-WHITE Paint Script Over T-Shirt Black',7300000,50,'m','black/white cotton signature Arrows motif logo print to the front logo print to the rear.','product_12.png',1),
('PD047','OFF-WHITE Paint Script Over T-Shirt Black',7600000,50,'l','black/white cotton signature Arrows motif logo print to the front logo print to the rear.','product_12.png',1),
('PD048','OFF-WHITE Paint Script Over T-Shirt Black',8000000,50,'xl','black/white cotton signature Arrows motif logo print to the front logo print to the rear.','product_12.png',1),
('PD049','STONE ISLAND Logo-print Short-sleeve T-shirt Navy Blue',3000000,50,'s','The iconic Stone Island Compass has been a symbol of quality, innovation and style since the brand\'s inception in 1982. Featured as a large-scale print at the front of this T-shirt, the garment references this element of the brand\'s history in a contempor','product_13.png',1),
('PD050','STONE ISLAND Logo-print Short-sleeve T-shirt Navy Blue',3200000,50,'m','The iconic Stone Island Compass has been a symbol of quality, innovation and style since the brand\'s inception in 1982. Featured as a large-scale print at the front of this T-shirt, the garment references this element of the brand\'s history in a contempor','product_13.png',1),
('PD051','STONE ISLAND Logo-print Short-sleeve T-shirt Navy Blue',3500000,50,'l','The iconic Stone Island Compass has been a symbol of quality, innovation and style since the brand\'s inception in 1982. Featured as a large-scale print at the front of this T-shirt, the garment references this element of the brand\'s history in a contempor','product_13.png',1),
('PD052','STONE ISLAND Logo-print Short-sleeve T-shirt Navy Blue',3900000,50,'xl','The iconic Stone Island Compass has been a symbol of quality, innovation and style since the brand\'s inception in 1982. Featured as a large-scale print at the front of this T-shirt, the garment references this element of the brand\'s history in a contempor','product_13.png',1),
('PD053','AHLUWALIA Nobody\'s Perfect print T-shirt White',2000000,50,'s','Nobody\'s Perfect print T-shirt.','product_14.png',1),
('PD054','AHLUWALIA Nobody\'s Perfect print T-shirt White',2250000,50,'m','Nobody\'s Perfect print T-shirt.','product_14.png',1),
('PD055','AHLUWALIA Nobody\'s Perfect print T-shirt White',2400000,50,'l','Nobody\'s Perfect print T-shirt.','product_14.png',1),
('PD056','AHLUWALIA Nobody\'s Perfect print T-shirt White',2670000,50,'xl','Nobody\'s Perfect print T-shirt.','product_14.png',1),
('PD057','DSQUARED2 Fruit-patch crew-neck T-shirt Black',2000000,50,'s','Fruit-patch crew-neck T-shirt.','product_15.png',1),
('PD058','DSQUARED2 Fruit-patch crew-neck T-shirt Black',2150000,50,'m','Fruit-patch crew-neck T-shirt.','product_15.png',1),
('PD059','DSQUARED2 Fruit-patch crew-neck T-shirt Black',2220000,50,'l','Fruit-patch crew-neck T-shirt.','product_15.png',1),
('PD060','DSQUARED2 Fruit-patch crew-neck T-shirt Black',2400000,50,'xl','Fruit-patch crew-neck T-shirt.','product_15.png',1),
('PD061','DSQUARED2 One Life One Planet T-Shirt',3500000,50,'s','DSquared2 passes on an eco-conscious message with the slogan printed on the front of this cotton T-shirt.','product_16.png',1),
('PD062','DSQUARED2 One Life One Planet T-Shirt',3600000,50,'m','DSquared2 passes on an eco-conscious message with the slogan printed on the front of this cotton T-shirt.','product_16.png',1),
('PD063','DSQUARED2 One Life One Planet T-Shirt',3700000,50,'l','DSquared2 passes on an eco-conscious message with the slogan printed on the front of this cotton T-shirt.','product_16.png',1),
('PD064','DSQUARED2 One Life One Planet T-Shirt',3900000,50,'xl','DSquared2 passes on an eco-conscious message with the slogan printed on the front of this cotton T-shirt.','product_16.png',1),
('PD065','JUST DON Tiger-print Cotton T-shirt',2800000,50,'s','Tiger-print Cotton T-shirt','product_17.png',1),
('PD066','JUST DON Tiger-print Cotton T-shirt',2900000,50,'m','Tiger-print Cotton T-shirt','product_17.png',1),
('PD067','JUST DON Tiger-print Cotton T-shirt',3000000,50,'l','Tiger-print Cotton T-shirt','product_17.png',1),
('PD068','JUST DON Tiger-print Cotton T-shirt',3150000,50,'xl','Tiger-print Cotton T-shirt','product_17.png',1),
('PD069','BALMAIN Monogram Bulky Fit T-Shirt Dark Grey',9100000,50,'s','Logo monogram T-shirt','product_18.png',1),
('PD070','BALMAIN Monogram Bulky Fit T-Shirt Dark Grey',9150000,50,'m','Logo monogram T-shirt','product_18.png',1),
('PD071','BALMAIN Monogram Bulky Fit T-Shirt Dark Grey',9300000,50,'l','Logo monogram T-shirt','product_18.png',1),
('PD072','BALMAIN Monogram Bulky Fit T-Shirt Dark Grey',9500000,50,'xl','Logo monogram T-shirt','product_18.png',1),
('PD073','LANVIN Sci-Fi Print T-Shirt Midnight Blue',11500000,50,'s','Made in Italy from lightweight cotton, this short-sleeve T-shirt from Lanvin is designed in a dark ink blue colour and cut for a relaxed fit that seamlessly contrasts with its colourful graphic print at the front.','product_19.png',1),
('PD074','LANVIN Sci-Fi Print T-Shirt Midnight Blue',12600000,50,'m','Made in Italy from lightweight cotton, this short-sleeve T-shirt from Lanvin is designed in a dark ink blue colour and cut for a relaxed fit that seamlessly contrasts with its colourful graphic print at the front.','product_19.png',1),
('PD075','LANVIN Sci-Fi Print T-Shirt Midnight Blue',13700000,50,'l','Made in Italy from lightweight cotton, this short-sleeve T-shirt from Lanvin is designed in a dark ink blue colour and cut for a relaxed fit that seamlessly contrasts with its colourful graphic print at the front.','product_19.png',1),
('PD076','LANVIN Sci-Fi Print T-Shirt Midnight Blue',14100000,50,'xl','Made in Italy from lightweight cotton, this short-sleeve T-shirt from Lanvin is designed in a dark ink blue colour and cut for a relaxed fit that seamlessly contrasts with its colourful graphic print at the front.','product_19.png',1),
('PD077','AHLUWALIA Link T-Shirt Green',2500000,50,'s','Nobody\'s Perfect print T-shirt','product_20.png',1),
('PD078','AHLUWALIA Link T-Shirt Green',2650000,50,'m','Nobody\'s Perfect print T-shirt','product_20.png',1),
('PD079','AHLUWALIA Link T-Shirt Green',2700000,50,'l','Nobody\'s Perfect print T-shirt','product_20.png',1),
('PD080','AHLUWALIA Link T-Shirt Green',2810000,50,'xl','Nobody\'s Perfect print T-shirt','product_20.png',1),
('PD081','DSQUARED2 Ceresio9 Cool Logo-Print T-shirt White',3800000,50,'s','Show off your love for logos and iconic streetwear style. This Dsquared2 logo-print T-shirt says it all. Word for word.','product_21.png',1),
('PD082','DSQUARED2 Ceresio9 Cool Logo-Print T-shirt White',4000000,50,'m','Show off your love for logos and iconic streetwear style. This Dsquared2 logo-print T-shirt says it all. Word for word.','product_21.png',1),
('PD083','DSQUARED2 Ceresio9 Cool Logo-Print T-shirt White',4300000,50,'l','Show off your love for logos and iconic streetwear style. This Dsquared2 logo-print T-shirt says it all. Word for word.','product_21.png',1),
('PD084','DSQUARED2 Ceresio9 Cool Logo-Print T-shirt White',4550000,50,'xl','Show off your love for logos and iconic streetwear style. This Dsquared2 logo-print T-shirt says it all. Word for word.','product_21.png',1),
('PD085','MAHARISHI Maha Warhol Dollar Sign T-Shirt White',1500000,50,'s','graphic-print short-sleeve T-shirt','product_22.png',1),
('PD086','MAHARISHI Maha Warhol Dollar Sign T-Shirt White',1600000,50,'m','graphic-print short-sleeve T-shirt','product_22.png',1),
('PD087','MAHARISHI Maha Warhol Dollar Sign T-Shirt White',1700000,50,'l','graphic-print short-sleeve T-shirt','product_22.png',1),
('PD088','MAHARISHI Maha Warhol Dollar Sign T-Shirt White',1900000,50,'xl','graphic-print short-sleeve T-shirt','product_22.png',1),
('PD089','MONCLER X 2 MONCLER GENIUS 1952 SS T-Shirt',4500000,50,'s','MONCLER X 2 MONCLER GENIUS','product_23.png',1),
('PD090','MONCLER X 2 MONCLER GENIUS 1952 SS T-Shirt',4600000,50,'m','MONCLER X 2 MONCLER GENIUS','product_23.png',1),
('PD091','MONCLER X 2 MONCLER GENIUS 1952 SS T-Shirt',4700000,50,'l','MONCLER X 2 MONCLER GENIUS','product_23.png',1),
('PD092','MONCLER X 2 MONCLER GENIUS 1952 SS T-Shirt',4900000,50,'xl','MONCLER X 2 MONCLER GENIUS','product_23.png',1),
('PD093','DSQUARED2 Canada Print T-shirt Black',4300000,50,'s','logo-print cotton T-shirt','product_24.png',1),
('PD094','DSQUARED2 Canada Print T-shirt Black',4360000,50,'m','logo-print cotton T-shirt','product_24.png',1),
('PD095','DSQUARED2 Canada Print T-shirt Black',4400000,50,'l','logo-print cotton T-shirt','product_24.png',1),
('PD096','DSQUARED2 Canada Print T-shirt Black',4550000,50,'xl','logo-print cotton T-shirt','product_24.png',1),
('PD097','TOM FORD Long-Sleeved T-shirt Blue',6500000,50,'s','With a commitment to impeccably crafted, timeless designs, TOM FORD presents this sweatshirt. Crafted in a cotton-blend construction, the lightweight piece is defined by its powder-blue hue.','product_25.png',1),
('PD098','TOM FORD Long-Sleeved T-shirt Blue',6600000,50,'m','With a commitment to impeccably crafted, timeless designs, TOM FORD presents this sweatshirt. Crafted in a cotton-blend construction, the lightweight piece is defined by its powder-blue hue.','product_25.png',1),
('PD099','TOM FORD Long-Sleeved T-shirt Blue',6700000,50,'l','With a commitment to impeccably crafted, timeless designs, TOM FORD presents this sweatshirt. Crafted in a cotton-blend construction, the lightweight piece is defined by its powder-blue hue.','product_25.png',1),
('PD100','TOM FORD Long-Sleeved T-shirt Blue',6900000,50,'xl','With a commitment to impeccably crafted, timeless designs, TOM FORD presents this sweatshirt. Crafted in a cotton-blend construction, the lightweight piece is defined by its powder-blue hue.','product_25.png',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
