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
/*Table structure for table `ACTIVITY_HISTORY` */

CREATE TABLE `ACTIVITY_HISTORY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WHO` int(11) DEFAULT NULL,
  `WHEN` datetime NOT NULL DEFAULT current_timestamp(),
  `PREV_PAGE` int(11) DEFAULT NULL,
  `CURR_PAGE` int(11) NOT NULL,
  `SESSION_TOKEN` int(10) unsigned NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PAGE_ID_PREV` (`PREV_PAGE`),
  KEY `PAGE_ID_CURR` (`CURR_PAGE`),
  KEY `SESSION` (`SESSION_TOKEN`)
) ENGINE=InnoDB AUTO_INCREMENT=3188 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `APIKEY` */

CREATE TABLE `APIKEY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `APIKEY` varchar(64) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UNIQUE` (`APIKEY`)
) ENGINE=InnoDB AUTO_INCREMENT=328 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `BANDWIDTH` */

CREATE TABLE `BANDWIDTH` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `BANDWIDTH` int(15) NOT NULL,
  `PRICE` int(15) NOT NULL,
  `EDIT_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `BILLING` */

CREATE TABLE `BILLING` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ORDER_NUMBER` varchar(20) NOT NULL,
  `ORDER_TYPE` varchar(20) NOT NULL DEFAULT 'monthly',
  `BILL_DATE` datetime NOT NULL,
  `DUE_DATE` datetime NOT NULL,
  `COMPANY` int(11) NOT NULL,
  `SUBSCRIBE` int(11) NOT NULL,
  `CURRENCY` varchar(10) DEFAULT NULL,
  `CHARGE` decimal(8,2) NOT NULL,
  `CUT_OFF_DATE` datetime NOT NULL,
  `IS_PAID` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `B$IE1` (`COMPANY`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `BLOG_POST` */

CREATE TABLE `BLOG_POST` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IMAGE` longtext DEFAULT NULL,
  `IMAGE2` longtext DEFAULT NULL,
  `TITLE` text NOT NULL,
  `CONTENT` longtext NOT NULL,
  `DATE` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

/*Table structure for table `BLOG_TAG` */

CREATE TABLE `BLOG_TAG` (
  `BLOG_ID` int(11) NOT NULL,
  `TAG` text NOT NULL,
  KEY `BLOG_ID` (`BLOG_ID`),
  CONSTRAINT `BLOG_TAG_ibfk_1` FOREIGN KEY (`BLOG_ID`) REFERENCES `BLOG_POST` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `CHAT_MESSAGE` */

CREATE TABLE `CHAT_MESSAGE` (
  `CHAT_MESSAGE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TO_USER_ID` int(11) NOT NULL,
  `FROM_USER_ID` int(11) NOT NULL,
  `CHAT_MESSAGE` text NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS` int(1) NOT NULL,
  KEY `CHAT_MESSAGE_ID` (`CHAT_MESSAGE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `COMP_FEATURE` */

CREATE TABLE `COMP_FEATURE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY_ID` int(11) DEFAULT NULL,
  `TYPE` int(11) DEFAULT NULL,
  `VALUE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UNIQUE_TYPE` (`COMPANY_ID`,`TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=337 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `COMPANY` */

CREATE TABLE `COMPANY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `API_KEY` varchar(64) DEFAULT NULL,
  `DOMAIN` varchar(64) NOT NULL,
  `STATUS` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `C$AK1` (`API_KEY`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `COMPANY_INFO` */

CREATE TABLE `COMPANY_INFO` (
  `COMPANY` int(11) NOT NULL,
  `PHONE_NUMBER` varchar(32) DEFAULT NULL,
  `COMPANY_NAME` varchar(64) NOT NULL,
  `PRODUCT_INTEREST` varchar(64) DEFAULT NULL,
  `DEVELOPMENT_TYPE` varchar(32) DEFAULT NULL,
  `INDUSTRY_TYPE` varchar(32) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `PRIVATE_PASSWORD` varchar(256) DEFAULT NULL,
  `COMPANY_LOGO` varchar(256) DEFAULT NULL,
  `SUPPORT_EMAIL` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`COMPANY`),
  KEY `CI$IE1` (`COMPANY_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `COMPONENT` */

CREATE TABLE `COMPONENT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT` mediumint(6) NOT NULL,
  `SERVICE` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `STATUS` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `C$IE1` (`PRODUCT`),
  KEY `C$IE2` (`SERVICE`),
  KEY `C$IE3` (`PRICE`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `DEMO_ACCESS` */

CREATE TABLE `DEMO_ACCESS` (
  `ID` bigint(20) NOT NULL,
  `NAME` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `DEMO_CONTACT` */

CREATE TABLE `DEMO_CONTACT` (
  `ID` bigint(20) NOT NULL,
  `ACCESS` bigint(20) NOT NULL,
  `NAME` varchar(128) NOT NULL,
  `EMAIL` varchar(64) DEFAULT NULL,
  `PROFILE_PICTURE` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `DEMO_DOCUMENT` */

CREATE TABLE `DEMO_DOCUMENT` (
  `ID` bigint(20) NOT NULL,
  `ENTITY` bigint(20) NOT NULL,
  `DATE` varchar(32) NOT NULL,
  `CREATOR` bigint(20) NOT NULL,
  `NUMBER` varchar(32) NOT NULL,
  `STATUS` int(11) NOT NULL,
  `ACTIVITY` int(11) NOT NULL,
  `ROOT_ID` bigint(20) DEFAULT NULL,
  `DESCRIPTION` text DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `DEMO_DOCUMENT_DETAIL` */

CREATE TABLE `DEMO_DOCUMENT_DETAIL` (
  `ID` bigint(20) NOT NULL,
  `DOCUMENT` bigint(20) NOT NULL,
  `KEY` text NOT NULL,
  `VALUE` text NOT NULL,
  `SQNO` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `DEMO_DOCUMENT_LABELING` */

CREATE TABLE `DEMO_DOCUMENT_LABELING` (
  `ID` bigint(20) NOT NULL,
  `NAME` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `DISCOUNT` */

CREATE TABLE `DISCOUNT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY` int(11) NOT NULL,
  `COMPONENT` int(11) NOT NULL,
  `UNIT` decimal(8,2) NOT NULL,
  `UNIT_TYPE` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `D$IE1` (`COMPANY`),
  KEY `D$IE2` (`COMPONENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `EMAIL` */

CREATE TABLE `EMAIL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `HASH` */

CREATE TABLE `HASH` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(256) NOT NULL,
  `HASH` varchar(256) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `INQUIRIES` */

CREATE TABLE `INQUIRIES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIMESTAMP` datetime NOT NULL,
  `PROSPECT_NAME` varchar(32) NOT NULL,
  `EMAIL` varchar(32) NOT NULL,
  `INQUIRY` text DEFAULT NULL,
  `STATUS` tinyint(2) DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `I$IE1` (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `LOGIN_DETAILS` */

CREATE TABLE `LOGIN_DETAILS` (
  `LOGIN_DETAILS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `LAST_ACTIVITY` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IS_TYPE` enum('no','yes') DEFAULT NULL,
  KEY `LOGIN_DETAILS_ID` (`LOGIN_DETAILS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `MAIL_TRACKER` */

CREATE TABLE `MAIL_TRACKER` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `TEMPLATE` varchar(255) DEFAULT NULL,
  `STATUS` int(1) DEFAULT 0,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `MESSAGE` */

CREATE TABLE `MESSAGE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY` int(11) NOT NULL,
  `USER_ACCOUNT` int(11) NOT NULL,
  `M_ID` int(11) NOT NULL,
  `MESSAGE_DATE` datetime NOT NULL,
  `MESSAGE_DESC` varchar(1024) CHARACTER SET utf32 COLLATE utf32_bin DEFAULT NULL,
  `IS_READ` int(11) DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `PY$IE2` (`COMPANY`),
  KEY `PY$IE3` (`USER_ACCOUNT`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `MULTIPLIER` */

CREATE TABLE `MULTIPLIER` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `FEATURE` int(2) NOT NULL,
  `MONTHLY` int(5) NOT NULL,
  `ANNUAL` decimal(8,2) NOT NULL,
  `EDIT_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `PAGE_LIST` */

CREATE TABLE `PAGE_LIST` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PAGE_NAME` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `PAYMENT` */

CREATE TABLE `PAYMENT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PAYMENT_METHOD` varchar(64) NOT NULL,
  `BILL` int(11) NOT NULL,
  `COMPANY` int(11) NOT NULL,
  `USER` int(11) NOT NULL,
  `PAY_DATE` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `PY$QIE1` (`BILL`),
  KEY `PY$IE2` (`COMPANY`),
  KEY `PY$IE3` (`USER`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `PRELAUNCH` */

CREATE TABLE `PRELAUNCH` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `PRICE` */

CREATE TABLE `PRICE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UNIT` decimal(8,2) NOT NULL,
  `UNIT_TYPE` tinyint(2) NOT NULL,
  `AMOUNT` decimal(8,2) NOT NULL,
  `DISCOUNT` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `P$IE1` (`DISCOUNT`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `PRODUCT` */

CREATE TABLE `PRODUCT` (
  `ID` mediumint(6) NOT NULL AUTO_INCREMENT,
  `PRODUCT_NAME` varchar(64) NOT NULL,
  `QUOTA_OF_STORAGE` bigint(15) NOT NULL,
  `QUOTA_OF_BANDWIDTH` bigint(15) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `CATEGORY` tinyint(2) NOT NULL,
  `STATUS` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `RATING` */

CREATE TABLE `RATING` (
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
  `RATE_AMOUNT` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `RATING_PARAM` */

CREATE TABLE `RATING_PARAM` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SERVICE_TYPE` varchar(32) NOT NULL,
  `AMOUNT` int(11) NOT NULL COMMENT 'KB/RECIPIENT(TEXT,ATTACHMENT,VIDEO); KB/MINUTE(LS,VOIP,VIDCALL)',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `REDIRECT_COUNT` */

CREATE TABLE `REDIRECT_COUNT` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(64) NOT NULL,
  `FB_REDIRECT` int(6) DEFAULT 0,
  `TW_REDIRECT` int(6) DEFAULT 0,
  `IG_REDIRECT` int(6) DEFAULT 0,
  `LI_REDIRECT` int(6) DEFAULT 0,
  `TIME_REDIRECT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `SDK` */

CREATE TABLE `SDK` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TICKET_NUMBER` int(11) NOT NULL,
  `GENERAL` int(11) NOT NULL DEFAULT 0,
  `LIVE_STREAMING` int(11) NOT NULL DEFAULT 0,
  `VIDEO_CALL` int(11) NOT NULL DEFAULT 0,
  `AUDIO_CALL` int(11) NOT NULL DEFAULT 0,
  `SCREEN_SHARING` int(11) NOT NULL DEFAULT 0,
  `WHITEBOARDING` int(11) NOT NULL DEFAULT 0,
  `UNIFIED_MESSAGING` int(11) NOT NULL DEFAULT 0,
  `CHATBOT` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `TICKET_NUMBER` (`TICKET_NUMBER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `SERVICE` */

CREATE TABLE `SERVICE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SERVICE_NAME` varchar(64) NOT NULL,
  `QUOTA` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `SESSION` */

CREATE TABLE `SESSION` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) DEFAULT NULL,
  `SESSION_TOKEN` varchar(64) NOT NULL,
  `SESSION_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=883 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `SITE_SETTINGS` */

CREATE TABLE `SITE_SETTINGS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PROPERTY` varchar(64) DEFAULT NULL,
  `VALUE` int(11) DEFAULT NULL,
  `PREV_VALUE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `STORAGE` */

CREATE TABLE `STORAGE` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `STORAGE` int(15) NOT NULL,
  `PRICE` int(15) NOT NULL,
  `EDIT_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `SUBSCRIBE` */

CREATE TABLE `SUBSCRIBE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY` int(11) NOT NULL,
  `PRODUCT` mediumint(6) NOT NULL,
  `START_DATE` datetime NOT NULL,
  `END_DATE` datetime NOT NULL,
  `STATUS` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `S$IE1` (`COMPANY`),
  KEY `S$IE2` (`PRODUCT`)
) ENGINE=InnoDB AUTO_INCREMENT=179 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `SUBSCRIPTION_TYPE` */

CREATE TABLE `SUBSCRIPTION_TYPE` (
  `ID` varchar(20) NOT NULL,
  `COMPANY_ID` int(6) NOT NULL,
  `USER_ID` int(6) NOT NULL,
  `FEATURE` int(2) NOT NULL,
  `SERVICE` varchar(64) NOT NULL,
  `TYPE` varchar(32) NOT NULL,
  `STORAGE` int(15) NOT NULL,
  `BANDWIDTH` int(15) NOT NULL,
  `PRICE` decimal(8,2) NOT NULL,
  `DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UNIQUE_ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `TICKET` */

CREATE TABLE `TICKET` (
  `TICKET_NUMBER` int(11) NOT NULL AUTO_INCREMENT,
  `CREATED_TIME` datetime NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `SUMMARY` varchar(128) NOT NULL,
  `METHOD` varchar(32) NOT NULL,
  `DETAIL` varchar(1024) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`TICKET_NUMBER`),
  KEY `CREATED_BY` (`CREATED_BY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `TRANSACTION_HISTORY` */

CREATE TABLE `TRANSACTION_HISTORY` (
  `ID` bigint(20) NOT NULL,
  `TRANSACTION_ID` int(11) NOT NULL,
  `ACCESS_TOKEN` varchar(100) NOT NULL,
  `PAYMENT_ID` varchar(100) NOT NULL,
  `AMOUNT` decimal(8,2) NOT NULL,
  `SIGNATURE` varchar(256) NOT NULL,
  `LANDING_URL` varchar(100) NOT NULL,
  `DATE` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `TRIAL_ACCESS` */

CREATE TABLE `TRIAL_ACCESS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY_NAME` varchar(64) NOT NULL,
  `CONTACT_NAME` varchar(64) NOT NULL,
  `EMAIL_CONTACT` varchar(64) NOT NULL,
  `API_KEY` varchar(64) DEFAULT NULL,
  `START_DATE` datetime NOT NULL,
  `END_DATE` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TA$AK1` (`API_KEY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `USAGE` */

CREATE TABLE `USAGE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY` int(11) NOT NULL,
  `COMPONENT` int(11) NOT NULL,
  `DURATION` time NOT NULL,
  `BYTE` int(15) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `START_TIME` datetime DEFAULT NULL,
  `END_TIME` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `U$IE1` (`COMPANY`),
  KEY `U$IE2` (`COMPONENT`),
  KEY `U$IE3` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `USAGE_DETAIL` */

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

/*Table structure for table `USAGE_LIMIT` */

CREATE TABLE `USAGE_LIMIT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(64) NOT NULL,
  `LIMIT` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `USAGE_SUMMARY` */

CREATE TABLE `USAGE_SUMMARY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY_ID` int(11) NOT NULL,
  `TEXT_RECIPIENT` int(11) DEFAULT 0,
  `IMG_RECIPIENT` int(11) DEFAULT 0,
  `VIDEO_RECIPIENT` int(11) DEFAULT 0,
  `LS_MINUTES` int(11) DEFAULT 0,
  `VOIP_MINUTES` int(11) DEFAULT 0,
  `VC_MINUTES` int(11) DEFAULT 0,
  `CREATED_AT` date NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UNIQUE_COMPANY_ID_CREATED_AT` (`COMPANY_ID`,`CREATED_AT`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `USER_ACCOUNT` */

CREATE TABLE `USER_ACCOUNT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY` int(11) NOT NULL,
  `USERNAME` varchar(64) NOT NULL,
  `EMAIL_ACCOUNT` varchar(64) NOT NULL,
  `PASSWORD` varchar(256) NOT NULL,
  `STATUS` tinyint(2) NOT NULL,
  `HASH` varchar(32) DEFAULT NULL,
  `ACTIVE` tinyint(2) DEFAULT NULL,
  `STATE` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UA$AK2` (`EMAIL_ACCOUNT`),
  KEY `UA$IE1` (`COMPANY`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
