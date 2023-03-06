/*
SQLyog Community
MySQL - 10.4.17-MariaDB : Database - new_nus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `chat_message` */

CREATE TABLE `chat_message` (
  `CHAT_MESSAGE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TO_USER_ID` int(11) NOT NULL,
  `FROM_USER_ID` int(11) NOT NULL,
  `CHAT_MESSAGE` text DEFAULT NULL,
  `TYPE` int(1) NOT NULL COMMENT '0 = MESSAGE, 1 = FILE',
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS` int(1) NOT NULL,
  KEY `CHAT_MESSAGE_ID` (`CHAT_MESSAGE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
