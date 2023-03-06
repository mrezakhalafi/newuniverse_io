/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.19-MariaDB : Database - palio_lite
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`palio_lite` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `palio_lite`;

/*Table structure for table `paxel_airwaybill` */

DROP TABLE IF EXISTS `paxel_airwaybill`;

CREATE TABLE `paxel_airwaybill` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AWB_CODE` varchar(255) NOT NULL,
  `SHIPPING_COST` int(11) NOT NULL,
  `EST_PICKUP` varchar(255) NOT NULL,
  `EST_ARRIVAL` varchar(255) NOT NULL,
  `CREATED_DATETIME` varchar(255) NOT NULL,
  `FPIN` varchar(255) NOT NULL,
  `MERCHANT_NAME` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
