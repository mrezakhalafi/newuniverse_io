/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.17-MariaDB : Database - new_nus2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `price_per_kb` */

CREATE TABLE `PRICE_PER_KB` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CURRENCY` varchar(10) NOT NULL,
  `AMOUNT` decimal(10,6) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `price_per_kb` */

insert  into `PRICE_PER_KB`(`ID`,`CURRENCY`,`AMOUNT`) values 
(1,'IDR',3.975000),
(2,'USD',0.000265);

/*Table structure for table `rating_param` */

CREATE TABLE `RATING_PARAM` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SERVICE_TYPE` varchar(32) NOT NULL,
  `AMOUNT` int(11) NOT NULL COMMENT 'KB/RECIPIENT(TEXT,ATTACHMENT,VIDEO); KB/MINUTE(LS,VOIP,VIDCALL)',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `rating_param` */

insert  into `RATING_PARAM`(`ID`,`SERVICE_TYPE`,`AMOUNT`) values 
(1,'TEXT',1),
(2,'DOC_IMAGE',250),
(3,'VIDEO',2500),
(4,'LIVESTREAM',5700),
(5,'VOIP_CALL',150),
(6,'VIDEO_CALL',11400);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
