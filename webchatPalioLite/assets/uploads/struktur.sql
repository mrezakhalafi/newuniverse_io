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
/*Table structure for table `activity_history` */

CREATE TABLE `activity_history` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2985 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `apikey` */

CREATE TABLE `apikey` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `APIKEY` varchar(64) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UNIQUE` (`APIKEY`)
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `bandwidth` */

CREATE TABLE `bandwidth` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `BANDWIDTH` int(15) NOT NULL,
  `PRICE` int(15) NOT NULL,
  `EDIT_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `billing` */

CREATE TABLE `billing` (
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
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `blog_post` */

CREATE TABLE `blog_post` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IMAGE` longtext DEFAULT NULL,
  `IMAGE2` longtext DEFAULT NULL,
  `TITLE` text NOT NULL,
  `CONTENT` longtext NOT NULL,
  `DATE` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

/*Table structure for table `blog_tag` */

CREATE TABLE `blog_tag` (
  `BLOG_ID` int(11) NOT NULL,
  `TAG` text NOT NULL,
  KEY `BLOG_ID` (`BLOG_ID`),
  CONSTRAINT `BLOG_TAG_ibfk_1` FOREIGN KEY (`BLOG_ID`) REFERENCES `blog_post` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `chat_message` */

CREATE TABLE `chat_message` (
  `CHAT_MESSAGE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TO_USER_ID` int(11) NOT NULL,
  `FROM_USER_ID` int(11) NOT NULL,
  `CHAT_MESSAGE` text NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUS` int(1) NOT NULL,
  KEY `CHAT_MESSAGE_ID` (`CHAT_MESSAGE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `comp_feature` */

CREATE TABLE `comp_feature` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY_ID` int(11) DEFAULT NULL,
  `TYPE` int(11) DEFAULT NULL,
  `VALUE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UNIQUE_TYPE` (`COMPANY_ID`,`TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=334 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `company` */

CREATE TABLE `company` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `API_KEY` varchar(64) DEFAULT NULL,
  `DOMAIN` varchar(64) NOT NULL,
  `STATUS` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `C$AK1` (`API_KEY`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `company_info` */

CREATE TABLE `company_info` (
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

/*Table structure for table `component` */

CREATE TABLE `component` (
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

/*Table structure for table `demo_access` */

CREATE TABLE `demo_access` (
  `ID` bigint(20) NOT NULL,
  `NAME` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `demo_contact` */

CREATE TABLE `demo_contact` (
  `ID` bigint(20) NOT NULL,
  `ACCESS` bigint(20) NOT NULL,
  `NAME` varchar(128) NOT NULL,
  `EMAIL` varchar(64) DEFAULT NULL,
  `PROFILE_PICTURE` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `demo_document` */

CREATE TABLE `demo_document` (
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

/*Table structure for table `demo_document_detail` */

CREATE TABLE `demo_document_detail` (
  `ID` bigint(20) NOT NULL,
  `DOCUMENT` bigint(20) NOT NULL,
  `KEY` text NOT NULL,
  `VALUE` text NOT NULL,
  `SQNO` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `demo_document_labeling` */

CREATE TABLE `demo_document_labeling` (
  `ID` bigint(20) NOT NULL,
  `NAME` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `discount` */

CREATE TABLE `discount` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY` int(11) NOT NULL,
  `COMPONENT` int(11) NOT NULL,
  `UNIT` decimal(8,2) NOT NULL,
  `UNIT_TYPE` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `D$IE1` (`COMPANY`),
  KEY `D$IE2` (`COMPONENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `email` */

CREATE TABLE `email` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `hash` */

CREATE TABLE `hash` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(256) NOT NULL,
  `HASH` varchar(256) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `inquiries` */

CREATE TABLE `inquiries` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TIMESTAMP` datetime NOT NULL,
  `PROSPECT_NAME` varchar(32) NOT NULL,
  `EMAIL` varchar(32) NOT NULL,
  `INQUIRY` text DEFAULT NULL,
  `STATUS` tinyint(2) DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `I$IE1` (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `login_details` */

CREATE TABLE `login_details` (
  `LOGIN_DETAILS_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `LAST_ACTIVITY` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IS_TYPE` enum('no','yes') DEFAULT NULL,
  KEY `LOGIN_DETAILS_ID` (`LOGIN_DETAILS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `mail_tracker` */

CREATE TABLE `mail_tracker` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `TEMPLATE` varchar(255) DEFAULT NULL,
  `STATUS` int(1) DEFAULT 0,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `message` */

CREATE TABLE `message` (
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
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `multiplier` */

CREATE TABLE `multiplier` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `FEATURE` int(2) NOT NULL,
  `MONTHLY` int(5) NOT NULL,
  `ANNUAL` decimal(8,2) NOT NULL,
  `EDIT_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `page_list` */

CREATE TABLE `page_list` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PAGE_NAME` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `payment` */

CREATE TABLE `payment` (
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
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `prelaunch` */

CREATE TABLE `prelaunch` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `price` */

CREATE TABLE `price` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UNIT` decimal(8,2) NOT NULL,
  `UNIT_TYPE` tinyint(2) NOT NULL,
  `AMOUNT` decimal(8,2) NOT NULL,
  `DISCOUNT` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `P$IE1` (`DISCOUNT`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `product` */

CREATE TABLE `product` (
  `ID` mediumint(6) NOT NULL AUTO_INCREMENT,
  `PRODUCT_NAME` varchar(64) NOT NULL,
  `QUOTA_OF_STORAGE` bigint(15) NOT NULL,
  `QUOTA_OF_BANDWIDTH` bigint(15) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `CATEGORY` tinyint(2) NOT NULL,
  `STATUS` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `redirect_count` */

CREATE TABLE `redirect_count` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(64) NOT NULL,
  `FB_REDIRECT` int(6) DEFAULT 0,
  `TW_REDIRECT` int(6) DEFAULT 0,
  `IG_REDIRECT` int(6) DEFAULT 0,
  `LI_REDIRECT` int(6) DEFAULT 0,
  `TIME_REDIRECT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `sdk` */

CREATE TABLE `sdk` (
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

/*Table structure for table `service` */

CREATE TABLE `service` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SERVICE_NAME` varchar(64) NOT NULL,
  `QUOTA` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `session` */

CREATE TABLE `session` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) DEFAULT NULL,
  `SESSION_TOKEN` varchar(64) NOT NULL,
  `SESSION_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=836 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `site_settings` */

CREATE TABLE `site_settings` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PROPERTY` varchar(64) DEFAULT NULL,
  `VALUE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `storage` */

CREATE TABLE `storage` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `STORAGE` int(15) NOT NULL,
  `PRICE` int(15) NOT NULL,
  `EDIT_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `subscribe` */

CREATE TABLE `subscribe` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMPANY` int(11) NOT NULL,
  `PRODUCT` mediumint(6) NOT NULL,
  `START_DATE` datetime NOT NULL,
  `END_DATE` datetime NOT NULL,
  `STATUS` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `S$IE1` (`COMPANY`),
  KEY `S$IE2` (`PRODUCT`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `subscription_type` */

CREATE TABLE `subscription_type` (
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

/*Table structure for table `ticket` */

CREATE TABLE `ticket` (
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

/*Table structure for table `transaction_history` */

CREATE TABLE `transaction_history` (
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

/*Table structure for table `trial_access` */

CREATE TABLE `trial_access` (
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

/*Table structure for table `usage` */

CREATE TABLE `usage` (
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

/*Table structure for table `usage_detail` */

CREATE TABLE `usage_detail` (
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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `usage_limit` */

CREATE TABLE `usage_limit` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(64) NOT NULL,
  `LIMIT` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `usage_summary` */

CREATE TABLE `usage_summary` (
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

/*Table structure for table `user_account` */

CREATE TABLE `user_account` (
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
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
