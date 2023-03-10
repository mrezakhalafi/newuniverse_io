/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.17-MariaDB : Database - new_nus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `rating` */

CREATE TABLE `RATING` (
  `ID` int(11) NOT NULL,
  `USAGE_SUMMARY` int(11) NOT NULL,
  `SERVICE_TYPE` int(11) NOT NULL COMMENT '1=TEXT,2=IMAGE,3=VIDEO,4=LIVESTREAM,5=VOIP,6=VIDEOCALL',
  `FROM` varchar(256) DEFAULT NULL,
  `TO` varchar(256) DEFAULT NULL,
  `CONTENT_ID` varchar(256) NOT NULL,
  `CONTENT` varchar(1000) DEFAULT NULL,
  `USAGE_DATE` datetime NOT NULL,
  `DURATION` int(11) DEFAULT NULL,
  `CREATED_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `RATE_STATUS` int(11) DEFAULT NULL,
  `RATE_AMOUNT` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `rating` */

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
(4,'LIVESTREAM',1500),
(5,'VOIP_CALL',100),
(6,'VIDEO_CALL',10000);

/*Table structure for table `usage_detail` */

CREATE TABLE `USAGE_DETAIL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USAGE_SUMMARY` int(11) NOT NULL,
  `SERVICE_TYPE` int(11) NOT NULL COMMENT '1=TEXT,2=IMAGE,3=VIDEO,4=LIVESTREAM,5=VOIP,6=VIDEOCALL',
  `FROM` varchar(256) DEFAULT NULL,
  `TO` varchar(256) DEFAULT NULL,
  `CONTENT` varchar(1000) DEFAULT NULL,
  `CONTENT_ID` varchar(256) NOT NULL,
  `USAGE_DATE` datetime NOT NULL,
  `DURATION` int(11) DEFAULT NULL,
  `CREATED_AT` datetime NOT NULL DEFAULT current_timestamp(),
  `RATE_STATUS` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usage_detail` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
