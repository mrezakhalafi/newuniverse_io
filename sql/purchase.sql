/*
SQLyog Community
MySQL - 5.7.33 : Database - palio_lite
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `PURCHASE` */

CREATE TABLE `PURCHASE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TRANSACTION_ID` varchar(256) DEFAULT NULL,
  `MERCHANT_ID` varchar(256) DEFAULT NULL,
  `PRODUCT_ID` varchar(256) DEFAULT NULL,
  `PRICE` int(11) DEFAULT NULL,
  `AMOUNT` int(11) DEFAULT NULL,
  `METHOD` varchar(256) DEFAULT NULL,
  `FPIN` varchar(256) DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
