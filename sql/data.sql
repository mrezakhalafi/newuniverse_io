/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 5.6.25-log : Database - new_nus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Data for the table `PAGE_LIST` */

insert  into `PAGE_LIST`(`ID`,`PAGE_NAME`) values 
(1,'INDEX'),
(2,'PRODUCTS'),
(3,'USECASE'),
(4,'SOLUTIONS'),
(5,'PRICING'),
(6,'BLOG'),
(7,'CONTACT US'),
(8,'TERMS AND POLICIES'),
(9,'LOGIN'),
(10,'SIGNUP'),
(11,'VERIFY EMAIL'),
(12,'PAYCHECKOUT'),
(13,'THANKYOU PAGE'),
(14,'DASHBOARD'),
(15,'INVOICE'),
(16,'MAIL');

/*Data for the table `PRICE` */

insert  into `PRICE`(`ID`,`UNIT`,`UNIT_TYPE`,`AMOUNT`,`DISCOUNT`) values 
(1,0.00,0,50.00,0),
(2,0.00,0,33.50,0),
(3,0.00,0,100.00,0),
(4,0.00,0,0.00,0);

/*Data for the table `PRICE_PER_KB` */

insert  into `PRICE_PER_KB`(`ID`,`CURRENCY`,`AMOUNT`) values 
(1,'IDR',3.975000),
(2,'USD',0.000265);

/*Data for the table `PRODUCT` */

insert  into `PRODUCT`(`ID`,`PRODUCT_NAME`,`QUOTA_OF_STORAGE`,`QUOTA_OF_BANDWIDTH`,`PRICE`,`CATEGORY`,`STATUS`) values 
(1,'PACKAGE SATU',100000,50000,1,1,1),
(2,'PACKAGE DUA',200000,100000,2,2,1),
(3,'PACKAGE CUSTOM',500000,500000,3,3,1),
(4,'PACKAGE TRIAL',100000,50000,4,4,1);

/*Data for the table `RATING_PARAM` */

insert  into `RATING_PARAM`(`ID`,`SERVICE_TYPE`,`AMOUNT`) values 
(1,'TEXT',1),
(2,'DOC_IMAGE',250),
(3,'VIDEO',2500),
(4,'LIVESTREAM',5700),
(5,'VOIP_CALL',150),
(6,'VIDEO_CALL',5700);

/*Data for the table `SERVER_ADDRESS` */

insert  into `SERVER_ADDRESS`(`COMPANY`,`SEQUENCE`,`IP_ADDRESS`,`PORT_ANDROID`,`PORT_IOS`) values 
(45,1,'192.168.0.56','52823','52328'),
(45,2,'192.168.0.88','52823','52328');

/*Data for the table `SERVICE` */

insert  into `SERVICE`(`ID`,`SERVICE_NAME`,`QUOTA`) values 
(1,'Live Streaming',0),
(2,'Video Call',0),
(3,'Audio Call',0),
(4,'Unified Messaging',0),
(5,'Whiteboard',0),
(6,'Screen Sharing',0),
(7,'Chatbot',0);

/*Data for the table `SITE_SETTINGS` */

insert  into `SITE_SETTINGS`(`ID`,`PROPERTY`,`VALUE`) values 
(1,'GEOLOC',1),
(2,'LANGUAGE',0);

/*Data for the table `USAGE_LIMIT` */

insert  into `USAGE_LIMIT`(`ID`,`NAME`,`LIMIT`) values 
(1,'TEXT',5000000),
(2,'IMAGE',50000),
(3,'VIDEO',5000),
(4,'LIVESTREAM',3000),
(5,'VOIP_CALL',50000),
(6,'VIDEO_CALL',500);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
