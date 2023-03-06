-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: ib_01
-- ------------------------------------------------------
-- Server version	5.7.29-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ACCESS_CATEGORY`
--

DROP TABLE IF EXISTS `ACCESS_CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACCESS_CATEGORY` (
  `ID` int(6) NOT NULL,
  `NAME` varchar(40) DEFAULT NULL,
  `PARENT` int(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ACCESS_CATEGORY_MUTASI`
--

DROP TABLE IF EXISTS `ACCESS_CATEGORY_MUTASI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACCESS_CATEGORY_MUTASI` (
  `ID` int(6) NOT NULL,
  `NAME` varchar(128) DEFAULT NULL,
  `PARENT` int(6) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ACTIVITY`
--

DROP TABLE IF EXISTS `ACTIVITY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACTIVITY` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ACTIVITY_HISTORY`
--

DROP TABLE IF EXISTS `ACTIVITY_HISTORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACTIVITY_HISTORY` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `who1` varchar(64) NOT NULL COMMENT 'Refer to table USER_LIST',
  `who2` varchar(1024) DEFAULT NULL,
  `what1` varchar(64) NOT NULL COMMENT '-',
  `what2` varchar(64) DEFAULT NULL COMMENT '-',
  `where1` varchar(64) DEFAULT NULL COMMENT '-',
  `where2` varchar(64) DEFAULT NULL COMMENT '-',
  `when1` datetime NOT NULL COMMENT '-',
  `when2` datetime DEFAULT NULL COMMENT '-',
  `why1` varchar(64) DEFAULT NULL COMMENT '-',
  `why2` varchar(64) DEFAULT NULL COMMENT '-',
  `how1` varchar(64) DEFAULT NULL COMMENT '-',
  `how2` varchar(64) DEFAULT NULL COMMENT '-',
  `extra1` text,
  `extra2` text,
  PRIMARY KEY (`id`),
  KEY `AK1_idx` (`who1`,`what1`,`where1`,`when1`,`why1`,`how1`),
  KEY `AK2_idx` (`what1`,`when1`,`who1`)
) ENGINE=InnoDB AUTO_INCREMENT=65972 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ACTIVITY_HISTORY_DETAIL`
--

DROP TABLE IF EXISTS `ACTIVITY_HISTORY_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ACTIVITY_HISTORY_DETAIL` (
  `message_id` varchar(1024) NOT NULL COMMENT 'Refer to table ACTIVITY_HISTORY, WHY1',
  `who1` varchar(64) NOT NULL COMMENT 'Refer to table USER_LIST, recipient',
  `EXTRA1` text,
  `EXTRA2` text,
  PRIMARY KEY (`message_id`,`who1`),
  KEY `AK1_idx` (`who1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ADMIN_ACCESS`
--

DROP TABLE IF EXISTS `ADMIN_ACCESS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ADMIN_ACCESS` (
  `ID` int(6) NOT NULL,
  `EMAIL` varchar(128) DEFAULT NULL,
  `PASSWORD` varchar(16) DEFAULT NULL,
  `RID` int(11) DEFAULT NULL,
  `BUSINESS_ENTITY` int(11) DEFAULT NULL,
  `STATUS` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ADS`
--

DROP TABLE IF EXISTS `ADS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ADS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `TITLE` varchar(256) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `CONTENT_TYPE` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:IMAGE, 1:VIDEO',
  `ADS_TYPE` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1:Content Ads, 2:Premium Ads',
  `CREATED_DATE` bigint(20) DEFAULT NULL,
  `THUMB_ID` varchar(512) DEFAULT NULL,
  `FILE_ID` varchar(512) DEFAULT NULL,
  `DURATION` varchar(16) DEFAULT '0',
  `START_DATE` bigint(20) DEFAULT NULL,
  `END_DATE` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `POST$AK2` (`END_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `APP`
--

DROP TABLE IF EXISTS `APP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `APP` (
  `CODE` varchar(8) NOT NULL,
  `NAME` varchar(48) NOT NULL,
  `DOWNLOAD_PATH` varchar(256) NOT NULL,
  `STATUS` tinyint(4) DEFAULT '0',
  `DESCRIPTION` text,
  `THUMB_ID` varchar(256) DEFAULT NULL,
  `CREATED_BY` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CATEGORY_ID` tinyint(4) DEFAULT '0',
  `ANDROID_PACKAGE_NAME` varchar(128) DEFAULT NULL,
  `ANDROID_CLASS_NAME` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`CODE`),
  UNIQUE KEY `NAME_UNIQUE` (`NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `APPS_SCHEME`
--

DROP TABLE IF EXISTS `APPS_SCHEME`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `APPS_SCHEME` (
  `ID` int(6) NOT NULL,
  `TITLE` varchar(32) NOT NULL,
  `SC_DATE` datetime NOT NULL,
  `EC_DATE` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `APPS_SCHEME_DETAIL`
--

DROP TABLE IF EXISTS `APPS_SCHEME_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `APPS_SCHEME_DETAIL` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `APP_ID` int(6) NOT NULL,
  `KEY` varchar(16) NOT NULL,
  `VALUE` varchar(32) NOT NULL,
  `SC_DATE` datetime NOT NULL,
  `EC_DATE` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ASD$IE` (`APP_ID`,`KEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `APP_USER`
--

DROP TABLE IF EXISTS `APP_USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `APP_USER` (
  `CODE` varchar(8) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `STATUS` tinyint(4) NOT NULL,
  `LAST_UPDATE` datetime NOT NULL,
  PRIMARY KEY (`CODE`,`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `AREAS`
--

DROP TABLE IF EXISTS `AREAS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AREAS` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `AREA_ID` int(4) NOT NULL,
  `DESCRIPTION_1` varchar(45) DEFAULT NULL,
  `DESCRIPTION_2` varchar(45) DEFAULT NULL,
  `STATUS` int(1) NOT NULL COMMENT '0:TIDAK AKTIVE; 1:AKTIVE',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `AUDIO`
--

DROP TABLE IF EXISTS `AUDIO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AUDIO` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AUDIO_ID` varchar(48) NOT NULL,
  `AUDIO` mediumblob NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `AUDIO$AK1` (`ID`),
  UNIQUE KEY `AUDIO$AK2` (`AUDIO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `AUTO_POST`
--

DROP TABLE IF EXISTS `AUTO_POST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AUTO_POST` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(64) DEFAULT NULL,
  `DOMAIN` varchar(100) DEFAULT NULL,
  `CATEGORY` int(11) DEFAULT NULL,
  `LAST_UPDATE` datetime DEFAULT NULL,
  `PRIVACY` int(11) NOT NULL DEFAULT '1',
  `IS_ACTIVE` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `AUTO_POST_LINKS`
--

DROP TABLE IF EXISTS `AUTO_POST_LINKS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AUTO_POST_LINKS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(64) NOT NULL,
  `URL` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6224 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `AUTO_POST_LINKS_BKP_20200626`
--

DROP TABLE IF EXISTS `AUTO_POST_LINKS_BKP_20200626`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AUTO_POST_LINKS_BKP_20200626` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(64) NOT NULL,
  `URL` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=405 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BACKUP_RESTORE_STATE`
--

DROP TABLE IF EXISTS `BACKUP_RESTORE_STATE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BACKUP_RESTORE_STATE` (
  `F_PIN` varchar(20) NOT NULL,
  `OPTION` varchar(8) NOT NULL,
  `FILE_ID` varchar(128) NOT NULL,
  `FILE_SIZE` varchar(32) NOT NULL,
  `STATE` varchar(1) NOT NULL DEFAULT '0',
  `CREATED_DATE` varchar(20) DEFAULT NULL,
  `RECORD_SIZE` int(11) DEFAULT NULL,
  PRIMARY KEY (`F_PIN`),
  UNIQUE KEY `POST_VIEWER$UK1` (`F_PIN`,`OPTION`,`FILE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BAKCUP_STATUS_COVID`
--

DROP TABLE IF EXISTS `BAKCUP_STATUS_COVID`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BAKCUP_STATUS_COVID` (
  `CAPTURE_DATE` date NOT NULL,
  `TOTAL_KASUS` varchar(128) DEFAULT '0',
  `KASUS_BARU_PER_HARI` varchar(45) DEFAULT '0',
  `SEMBUH` varchar(45) DEFAULT '0',
  `DIRAWAT` varchar(45) DEFAULT '0',
  `MENINGGAL` varchar(45) DEFAULT '0',
  PRIMARY KEY (`CAPTURE_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BD_COMPANY_STOCK`
--

DROP TABLE IF EXISTS `BD_COMPANY_STOCK`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BD_COMPANY_STOCK` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(45) DEFAULT NULL,
  `COMPANY_NAME` varchar(45) DEFAULT NULL,
  `PRICE` decimal(15,3) DEFAULT NULL,
  `DATA` text,
  `LAST_UPDATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK1` (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BLACKLIST_FORUM`
--

DROP TABLE IF EXISTS `BLACKLIST_FORUM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BLACKLIST_FORUM` (
  `ID` int(6) NOT NULL,
  `F_PIN` varchar(32) NOT NULL COMMENT 'USER_LIST.F_PIN pelaku',
  `CHAT_ID` varchar(32) NOT NULL COMMENT 'DISCUSSION_FORUM.CHAT_ID blacklist',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BLACKLIST_USER_NEARBY`
--

DROP TABLE IF EXISTS `BLACKLIST_USER_NEARBY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BLACKLIST_USER_NEARBY` (
  `F_PIN` varchar(20) NOT NULL,
  PRIMARY KEY (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BLOCK_USER`
--

DROP TABLE IF EXISTS `BLOCK_USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BLOCK_USER` (
  `F_PIN` text,
  `L_PIN` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BLOG`
--

DROP TABLE IF EXISTS `BLOG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BLOG` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BLOG_ID` varchar(48) NOT NULL,
  `TITLE` varchar(256) NOT NULL,
  `BODY` text NOT NULL,
  `CREATED_BY` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `THUMB_ID` varchar(512) DEFAULT NULL,
  `BLOG_SCOPE_ID` tinyint(4) DEFAULT '7',
  `L_PIN` varchar(30) DEFAULT NULL,
  `APP_CODE` varchar(8) DEFAULT NULL,
  `CATEGORY_ID` smallint(4) DEFAULT NULL,
  `COMMENTS` tinyint(4) DEFAULT '1',
  `TEXT_PREVIEW` text,
  `VIDEO_ID` varchar(512) DEFAULT NULL,
  `IMAGE_ID` text,
  `F_USER_ID` varchar(24) DEFAULT NULL,
  `VIDEO_DURATION` varchar(16) DEFAULT '0',
  `N_VIEWS` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `BLOG$AK1` (`BLOG_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BLOG_COMMENT`
--

DROP TABLE IF EXISTS `BLOG_COMMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BLOG_COMMENT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BLOG_COMMENT_ID` varchar(32) DEFAULT NULL,
  `BLOG_ID` varchar(48) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `BODY` text NOT NULL,
  `F_USER_ID` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `BLOG_COMMENT$AK1` (`BLOG_ID`,`F_PIN`,`CREATED_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BROADCAST_NOTIFICATION`
--

DROP TABLE IF EXISTS `BROADCAST_NOTIFICATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BROADCAST_NOTIFICATION` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `VERSION` varchar(16) DEFAULT NULL,
  `MESSAGE` varchar(512) DEFAULT NULL,
  `STATUS` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `VERSION` (`VERSION`),
  KEY `STATUS` (`STATUS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BUSINESS_CATEGORY`
--

DROP TABLE IF EXISTS `BUSINESS_CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BUSINESS_CATEGORY` (
  `ID` tinyint(4) NOT NULL,
  `CATEGORY` varbinary(40) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BUSINESS_ENTITY`
--

DROP TABLE IF EXISTS `BUSINESS_ENTITY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BUSINESS_ENTITY` (
  `ID` int(11) NOT NULL DEFAULT '0',
  `NAME` varchar(255) DEFAULT NULL,
  `PARENT` int(11) DEFAULT NULL,
  `ROOT_PARENT` int(11) DEFAULT NULL,
  `CATEGORY` varchar(192) DEFAULT NULL,
  `TYPE` tinyint(4) DEFAULT NULL,
  `COMPANY_ID_TYPE` tinyint(4) DEFAULT NULL,
  `COMPANY_ID` varchar(60) DEFAULT NULL,
  `LEVEL` int(11) DEFAULT NULL,
  `NCHILD` int(11) DEFAULT NULL,
  `SC_DATE` datetime DEFAULT NULL,
  `EC_DATE` datetime NOT NULL DEFAULT '9999-12-31 00:00:00',
  `IMAGE` text,
  `DOMAIN` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `BE_AK1` (`NAME`,`PARENT`,`CATEGORY`,`ROOT_PARENT`),
  KEY `BE_IE2` (`TYPE`,`SC_DATE`,`EC_DATE`),
  KEY `INDEX_1` (`CATEGORY`),
  KEY `INDEX_2` (`ID`),
  KEY `INDEX_3` (`TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `BUSINESS_ENTITY_BKP`
--

DROP TABLE IF EXISTS `BUSINESS_ENTITY_BKP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BUSINESS_ENTITY_BKP` (
  `ID` int(11) NOT NULL DEFAULT '0',
  `NAME` varchar(255) DEFAULT NULL,
  `PARENT` int(11) DEFAULT NULL,
  `ROOT_PARENT` int(11) DEFAULT NULL,
  `CATEGORY` varchar(192) DEFAULT NULL,
  `TYPE` tinyint(4) DEFAULT NULL,
  `COMPANY_ID_TYPE` tinyint(4) DEFAULT NULL,
  `COMPANY_ID` varchar(60) DEFAULT NULL,
  `LEVEL` int(11) DEFAULT NULL,
  `NCHILD` int(11) DEFAULT NULL,
  `SC_DATE` datetime DEFAULT NULL,
  `EC_DATE` datetime NOT NULL DEFAULT '9999-12-31 00:00:00',
  `IMAGE` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `BE_AK1` (`NAME`,`PARENT`,`CATEGORY`,`ROOT_PARENT`),
  KEY `BE_IE2` (`TYPE`,`SC_DATE`,`EC_DATE`),
  KEY `INDEX_1` (`CATEGORY`),
  KEY `INDEX_2` (`ID`),
  KEY `INDEX_3` (`TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CARD_TYPE`
--

DROP TABLE IF EXISTS `CARD_TYPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CARD_TYPE` (
  `ID` int(6) NOT NULL,
  `NAME` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CATEGORY`
--

DROP TABLE IF EXISTS `CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CATEGORY` (
  `ID` mediumint(6) NOT NULL,
  `CODE` varchar(32) DEFAULT NULL,
  `DESCRIPTION` varchar(256) DEFAULT NULL,
  `EDUCATIONAL` smallint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `C$IE1` (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CHAT`
--

DROP TABLE IF EXISTS `CHAT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CHAT` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `CHAT_ID` varchar(32) NOT NULL,
  `TITLE` varchar(50) NOT NULL,
  `F_PIN` varchar(32) NOT NULL,
  `L_PIN` varchar(32) DEFAULT NULL,
  `SCOPE_ID` int(2) DEFAULT '0',
  `ANONYM` char(1) DEFAULT '0',
  `IMAGE` text,
  `UNIQ_CODE` varchar(32) DEFAULT NULL,
  `CATEGORY` varchar(32) DEFAULT NULL,
  `ACTIVITY` varchar(64) DEFAULT NULL,
  `SHARED` char(1) DEFAULT NULL,
  `CLIENTS` varchar(128) DEFAULT NULL,
  `GROUP_OWNER` varchar(32) NOT NULL DEFAULT '',
  `SC_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `EC_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `EMAIL` varchar(32) NOT NULL DEFAULT ' ',
  `ACTIVITY_ID` int(11) NOT NULL DEFAULT '0',
  `CLIENT_ID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CHAT$AK1` (`CHAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CHAT_FILTER`
--

DROP TABLE IF EXISTS `CHAT_FILTER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CHAT_FILTER` (
  `F_PIN` varchar(40) DEFAULT NULL,
  `FILTER` varchar(40) DEFAULT NULL,
  UNIQUE KEY `UK1` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CHAT_MEMBERS`
--

DROP TABLE IF EXISTS `CHAT_MEMBERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CHAT_MEMBERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(45) DEFAULT NULL,
  `CHAT_ID` varchar(45) DEFAULT NULL,
  `F_PIN` varchar(45) DEFAULT NULL,
  `REG_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `UK` (`CHAT_ID`,`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=2439 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `COMMENT`
--

DROP TABLE IF EXISTS `COMMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMMENT` (
  `ID_COMMENT` int(255) NOT NULL AUTO_INCREMENT,
  `ID_REVIEW` int(255) NOT NULL,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID_RESTAURANT` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `COMMENT` text COLLATE utf8_unicode_ci NOT NULL,
  `COMMENT_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_COMMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `COMMENT_MENU`
--

DROP TABLE IF EXISTS `COMMENT_MENU`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMMENT_MENU` (
  `ID_COMMENT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_REVIEW` int(11) NOT NULL,
  `ID_USER` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID_MENU` int(11) NOT NULL,
  `COMMENT` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `COMMENT_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_COMMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `COMPANY_ID`
--

DROP TABLE IF EXISTS `COMPANY_ID`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COMPANY_ID` (
  `ID` tinyint(4) NOT NULL,
  `ID_TYPE` varbinary(40) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CONTENT_CATEGORY`
--

DROP TABLE IF EXISTS `CONTENT_CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CONTENT_CATEGORY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) DEFAULT NULL,
  `CATEGORY` mediumint(6) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CC$AK1` (`POST_ID`,`CATEGORY`)
) ENGINE=InnoDB AUTO_INCREMENT=7710 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CONTENT_CATEGORY_BKP_NEWS_BOT_20200626`
--

DROP TABLE IF EXISTS `CONTENT_CATEGORY_BKP_NEWS_BOT_20200626`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CONTENT_CATEGORY_BKP_NEWS_BOT_20200626` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) DEFAULT NULL,
  `CATEGORY` mediumint(6) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CC$AK1` (`POST_ID`,`CATEGORY`)
) ENGINE=InnoDB AUTO_INCREMENT=2144 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CORRECTION_WORD`
--

DROP TABLE IF EXISTS `CORRECTION_WORD`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CORRECTION_WORD` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY` varchar(45) DEFAULT NULL,
  `KEY` varchar(45) DEFAULT NULL COMMENT 'ONLY LOWERCASE\n',
  `WORD` varchar(45) DEFAULT NULL,
  `MATCH_CASE` char(1) DEFAULT '1' COMMENT 'JIka 0: maka mempertahankan formatcase kata semula\njika 1: maka formatcase akan disesuaikan dengan kata baru',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK1` (`KEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `COVID_APD_ITEM`
--

DROP TABLE IF EXISTS `COVID_APD_ITEM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COVID_APD_ITEM` (
  `ID` bigint(32) NOT NULL AUTO_INCREMENT,
  `KEY` varchar(45) NOT NULL,
  `DESCRIPTION` varchar(45) NOT NULL,
  `UNIT` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `COVID_APD_ITEM$K` (`KEY`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `COVID_APD_RECEIVE`
--

DROP TABLE IF EXISTS `COVID_APD_RECEIVE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COVID_APD_RECEIVE` (
  `ID` bigint(32) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `SUBMIT_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `DATA_COVID$K` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `COVID_APD_RECEIVE_DETAIL`
--

DROP TABLE IF EXISTS `COVID_APD_RECEIVE_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COVID_APD_RECEIVE_DETAIL` (
  `ID` bigint(32) NOT NULL AUTO_INCREMENT,
  `COVID_APD_RECEIVE` varchar(20) NOT NULL,
  `COVID_APD_ITEM` varchar(45) NOT NULL,
  `VALUE` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `COVID_APD_RECEIVE_DETAIL$AK` (`COVID_APD_RECEIVE`),
  KEY `COVID_APD_RECEIVE_DETAIL$AK2` (`COVID_APD_ITEM`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `COVID_APD_STOCK`
--

DROP TABLE IF EXISTS `COVID_APD_STOCK`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COVID_APD_STOCK` (
  `ID` bigint(32) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `LAST_UPDATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `COVID_APD_ITEM` varchar(45) NOT NULL,
  `QUANTITY` int(11) DEFAULT '0',
  `USAGE` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `COVID_APD_STOCK$AK` (`F_PIN`,`COVID_APD_ITEM`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `COVID_PAYMENT`
--

DROP TABLE IF EXISTS `COVID_PAYMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COVID_PAYMENT` (
  `ID` bigint(32) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `L_PIN` varchar(20) NOT NULL,
  `SUBMIT_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `DESCRIPTION` text,
  `AMOUNT` double NOT NULL DEFAULT '0',
  `TITLE` text,
  `API_BCA_PAYMENT_ID` text,
  `API_LANDING_PAGE_URL` text,
  PRIMARY KEY (`ID`),
  KEY `COVID_PAYMENT$AK` (`F_PIN`),
  KEY `COVID_PAYMENT$AK2` (`L_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `COVID_RECIPE`
--

DROP TABLE IF EXISTS `COVID_RECIPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COVID_RECIPE` (
  `ID` bigint(32) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `L_PIN` varchar(20) NOT NULL,
  `SUBMIT_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `NOTE` text,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `COVID_RECIPE$AK` (`F_PIN`),
  KEY `COVID_RECIPE$AK2` (`L_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `COVID_RECIPE_DETAIL`
--

DROP TABLE IF EXISTS `COVID_RECIPE_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COVID_RECIPE_DETAIL` (
  `ID` bigint(32) NOT NULL AUTO_INCREMENT,
  `COVID_RECIPE` varchar(20) NOT NULL,
  `SQ_NO` int(1) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `COVID_RECIPE_DETAIL$AK` (`COVID_RECIPE`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CUISINE_CATEGORY`
--

DROP TABLE IF EXISTS `CUISINE_CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CUISINE_CATEGORY` (
  `ID_CUISINE` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE_CUISINE` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_CUISINE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DATA_COVID`
--

DROP TABLE IF EXISTS `DATA_COVID`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DATA_COVID` (
  `ID` bigint(32) NOT NULL,
  `SUBMIT_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `F_PIN` varchar(20) NOT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `KONFIRMASI` int(11) DEFAULT '0',
  `DIRAWAT` int(11) DEFAULT '0',
  `SEMBUH` int(11) DEFAULT '0',
  `MENINGGAL` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `DATA_COVID$K` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DAYS`
--

DROP TABLE IF EXISTS `DAYS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DAYS` (
  `ID_DAY` int(11) NOT NULL AUTO_INCREMENT,
  `NAME_DAY` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_DAY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DEFAULT_ACTIVITY`
--

DROP TABLE IF EXISTS `DEFAULT_ACTIVITY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DEFAULT_ACTIVITY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` int(11) DEFAULT NULL,
  `ACTIVITY` int(11) DEFAULT NULL,
  `R` varchar(256) DEFAULT NULL,
  `A` varchar(256) DEFAULT NULL,
  `C` varchar(256) DEFAULT NULL,
  `I` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DEFAULT_ACTIVITY_DUMMY`
--

DROP TABLE IF EXISTS `DEFAULT_ACTIVITY_DUMMY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DEFAULT_ACTIVITY_DUMMY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` int(11) DEFAULT NULL,
  `ACTIVITY` int(11) DEFAULT NULL,
  `R` varchar(256) DEFAULT NULL,
  `A` varchar(256) DEFAULT NULL,
  `C` varchar(256) DEFAULT NULL,
  `I` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DELETETHIS`
--

DROP TABLE IF EXISTS `DELETETHIS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DELETETHIS` (
  `INT` int(11) NOT NULL,
  `BIGINT` bigint(20) NOT NULL,
  PRIMARY KEY (`INT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DF_ACTIVITY`
--

DROP TABLE IF EXISTS `DF_ACTIVITY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DF_ACTIVITY` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(256) DEFAULT NULL,
  `THUMBNAIL` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DF_CHAT`
--

DROP TABLE IF EXISTS `DF_CHAT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DF_CHAT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CHAT` text,
  `PROJECT` varchar(128) DEFAULT NULL,
  `ACTIVITY` varchar(128) DEFAULT NULL,
  `CLIENT` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DF_CLIENT`
--

DROP TABLE IF EXISTS `DF_CLIENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DF_CLIENT` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(45) DEFAULT NULL,
  `THUMBNAIL` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DF_CLIENT_ADDRESS`
--

DROP TABLE IF EXISTS `DF_CLIENT_ADDRESS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DF_CLIENT_ADDRESS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLIENT_ID` int(11) DEFAULT NULL,
  `NAME` varchar(45) DEFAULT NULL,
  `ADDRESS` text,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `IS_DEFAULT` char(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `UK1` (`CLIENT_ID`,`NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DF_CLIENT_ADDRESS_BU_20171211`
--

DROP TABLE IF EXISTS `DF_CLIENT_ADDRESS_BU_20171211`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DF_CLIENT_ADDRESS_BU_20171211` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLIENT_ID` int(11) DEFAULT NULL,
  `NAME` varchar(45) DEFAULT NULL,
  `ADDRESS` text,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `IS_DEFAULT` char(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `UK1` (`CLIENT_ID`,`NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DISCUSSION_FORUM`
--

DROP TABLE IF EXISTS `DISCUSSION_FORUM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DISCUSSION_FORUM` (
  `CHAT_ID` varchar(60) NOT NULL,
  `title` varchar(512) DEFAULT NULL,
  `GROUP_ID` varchar(64) DEFAULT NULL,
  `IMAGE` text COMMENT 'Thumbnail',
  `ANONYM` char(1) NOT NULL DEFAULT '0',
  `CATEGORY` varchar(32) DEFAULT NULL,
  `SC_DATE` date DEFAULT NULL COMMENT 'START DATE PROJECT/PRODUCT',
  `EC_DATE` date DEFAULT NULL COMMENT 'END DATE PROJECT/PRODUCT',
  `EMAIL` varchar(32) DEFAULT NULL COMMENT '..',
  `CLIENT` int(11) DEFAULT NULL COMMENT 'DF_CLIENT.ID',
  `ACTIVITY` int(11) DEFAULT NULL COMMENT 'DF_ACTIVITY.ID',
  `R` varchar(512) DEFAULT NULL,
  `A` varchar(512) DEFAULT NULL,
  `C` varchar(512) DEFAULT NULL,
  `I` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`CHAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DISCUSSION_FORUM_BKP`
--

DROP TABLE IF EXISTS `DISCUSSION_FORUM_BKP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DISCUSSION_FORUM_BKP` (
  `CHAT_ID` varchar(32) NOT NULL,
  `TITLE` varchar(64) NOT NULL COMMENT 'Judul DF',
  `GROUP_ID` varchar(32) NOT NULL COMMENT 'GROUPS.GROUP_ID owner',
  `IMAGE` text COMMENT 'Thumbnail',
  `ANONYM` char(1) NOT NULL DEFAULT '0',
  `CATEGORY` varchar(32) DEFAULT NULL,
  `SC_DATE` date DEFAULT NULL COMMENT 'START DATE PROJECT/PRODUCT',
  `EC_DATE` date DEFAULT NULL COMMENT 'END DATE PROJECT/PRODUCT',
  `EMAIL` varchar(32) DEFAULT NULL COMMENT '..',
  `CLIENT` int(11) DEFAULT NULL COMMENT 'DF_CLIENT.ID',
  `ACTIVITY` int(11) DEFAULT NULL COMMENT 'DF_ACTIVITY.ID',
  `R` varchar(512) DEFAULT NULL,
  `A` varchar(512) DEFAULT NULL,
  `C` varchar(512) DEFAULT NULL,
  `I` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`CHAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DISCUSSION_FORUM_BU_20171211`
--

DROP TABLE IF EXISTS `DISCUSSION_FORUM_BU_20171211`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DISCUSSION_FORUM_BU_20171211` (
  `CHAT_ID` varchar(32) NOT NULL,
  `TITLE` varchar(64) NOT NULL COMMENT 'Judul DF',
  `GROUP_ID` varchar(32) NOT NULL COMMENT 'GROUPS.GROUP_ID owner',
  `IMAGE` text NOT NULL COMMENT 'Thumbnail',
  `ANONYM` char(1) NOT NULL DEFAULT '0',
  `CATEGORY` varchar(32) DEFAULT NULL,
  `SC_DATE` date DEFAULT NULL COMMENT 'START DATE PROJECT/PRODUCT',
  `EC_DATE` date DEFAULT NULL COMMENT 'END DATE PROJECT/PRODUCT',
  `EMAIL` varchar(32) NOT NULL COMMENT '..',
  `CLIENT` int(11) NOT NULL COMMENT 'DF_CLIENT.ID',
  `ACTIVITY` int(11) NOT NULL COMMENT 'DF_ACTIVITY.ID',
  PRIMARY KEY (`CHAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DISCUSSION_FORUM_DUMMY`
--

DROP TABLE IF EXISTS `DISCUSSION_FORUM_DUMMY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DISCUSSION_FORUM_DUMMY` (
  `CHAT_ID` varchar(32) NOT NULL,
  `TITLE` varchar(64) NOT NULL COMMENT 'Judul DF',
  `GROUP_ID` varchar(32) NOT NULL COMMENT 'GROUPS.GROUP_ID owner',
  `IMAGE` text COMMENT 'Thumbnail',
  `ANONYM` char(1) NOT NULL DEFAULT '0',
  `CATEGORY` varchar(32) DEFAULT NULL,
  `SC_DATE` date DEFAULT NULL COMMENT 'START DATE PROJECT/PRODUCT',
  `EC_DATE` date DEFAULT NULL COMMENT 'END DATE PROJECT/PRODUCT',
  `EMAIL` varchar(32) DEFAULT NULL COMMENT '..',
  `CLIENT` int(11) DEFAULT NULL COMMENT 'DF_CLIENT.ID',
  `ACTIVITY` int(11) DEFAULT NULL COMMENT 'DF_ACTIVITY.ID',
  PRIMARY KEY (`CHAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `DUKCAPIL_KTP`
--

DROP TABLE IF EXISTS `DUKCAPIL_KTP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DUKCAPIL_KTP` (
  `ID` varchar(16) NOT NULL,
  `FIRST_NAME` varchar(128) DEFAULT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `GENDER` int(1) NOT NULL DEFAULT '1',
  `BIRTH_PLACE` varchar(128) DEFAULT NULL,
  `BIRTH_DATE` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EASYSOFT_LIST`
--

DROP TABLE IF EXISTS `EASYSOFT_LIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EASYSOFT_LIST` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `NAME` varchar(128) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EDU_CATEGORY`
--

DROP TABLE IF EXISTS `EDU_CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EDU_CATEGORY` (
  `CATEGORY` mediumint(6) NOT NULL,
  `DESCRIPTION` varchar(32) DEFAULT NULL,
  `LEVEL` mediumint(6) NOT NULL COMMENT '0:TK, 1:SD, 2:SMP, 3:SMA',
  `LAST_UPDATE` bigint(16) DEFAULT NULL,
  PRIMARY KEY (`CATEGORY`,`LEVEL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EMAIL_CONFIG_HINT`
--

DROP TABLE IF EXISTS `EMAIL_CONFIG_HINT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EMAIL_CONFIG_HINT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BUSINESS_ENTITY` int(11) NOT NULL,
  `CONFIG` varchar(40) NOT NULL,
  `VALUE` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CONFIG$UK1` (`BUSINESS_ENTITY`,`CONFIG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EMAIL_MEDIC`
--

DROP TABLE IF EXISTS `EMAIL_MEDIC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EMAIL_MEDIC` (
  `EMAIL` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EMULATOR_BLACKLIST`
--

DROP TABLE IF EXISTS `EMULATOR_BLACKLIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EMULATOR_BLACKLIST` (
  `KEY` varchar(32) NOT NULL,
  `VALUE` varchar(64) NOT NULL,
  `SCORE` double DEFAULT NULL,
  PRIMARY KEY (`KEY`,`VALUE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ERROR_CODE`
--

DROP TABLE IF EXISTS `ERROR_CODE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ERROR_CODE` (
  `ERROR_CODE` varchar(48) NOT NULL,
  `ERROR_DESC` varchar(128) NOT NULL,
  PRIMARY KEY (`ERROR_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ESMONEY_ACCOUNT`
--

DROP TABLE IF EXISTS `ESMONEY_ACCOUNT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ESMONEY_ACCOUNT` (
  `F_PIN` varchar(20) NOT NULL,
  `ACCOUNT_ID` varchar(32) DEFAULT NULL,
  `BALANCE` decimal(15,3) DEFAULT NULL,
  `VA_ID` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FAMILY`
--

DROP TABLE IF EXISTS `FAMILY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FAMILY` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `FAMILY_ID` varchar(32) NOT NULL,
  `FAMILY_NAME` varchar(64) NOT NULL,
  `IMAGE_ID` varchar(256) DEFAULT NULL,
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `MEMBER_QTY` int(6) DEFAULT NULL,
  `MAX_LEVEL` int(6) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `STATUS` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `FAMILY$AK1` (`FAMILY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FAMILY_MEMBER`
--

DROP TABLE IF EXISTS `FAMILY_MEMBER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FAMILY_MEMBER` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `FAMILY_ID` varchar(32) NOT NULL,
  `F_PIN` varchar(20) DEFAULT NULL,
  `PARENT_PIN` varchar(20) DEFAULT NULL,
  `LEVEL` int(6) DEFAULT NULL,
  `POINT` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FAMILY_ID` (`FAMILY_ID`,`PARENT_PIN`),
  KEY `FAMILY_ID_2` (`FAMILY_ID`,`F_PIN`),
  KEY `FAMILY_ID_3` (`FAMILY_ID`,`LEVEL`),
  KEY `F_PIN` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FAVORITE_MENU`
--

DROP TABLE IF EXISTS `FAVORITE_MENU`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FAVORITE_MENU` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FAV_NAME` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `BOOKING_CODE` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `FAV_DATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FEEDER`
--

DROP TABLE IF EXISTS `FEEDER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FEEDER` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RESOURCE` varchar(45) DEFAULT NULL,
  `PUB_DATE` datetime DEFAULT NULL,
  `FEEDER_CATEGORY` tinyint(4) DEFAULT NULL,
  `TITLE` text,
  `LINK` varchar(255) DEFAULT NULL,
  `AUTHOR` varchar(45) DEFAULT NULL,
  `GUID` varchar(128) DEFAULT NULL,
  `CONTENT` text,
  `CONTENT_TYPE` int(11) DEFAULT '0' COMMENT '0: Web Page, 1: Native View',
  `IMAGE` text,
  `BE` int(11) NOT NULL DEFAULT '15',
  `TAG` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK1` (`PUB_DATE`,`LINK`)
) ENGINE=InnoDB AUTO_INCREMENT=42168 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FEEDER_CATEGORY`
--

DROP TABLE IF EXISTS `FEEDER_CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FEEDER_CATEGORY` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DESCRIPTION` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FEEDER_DUMMY`
--

DROP TABLE IF EXISTS `FEEDER_DUMMY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FEEDER_DUMMY` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RESOURCE` varchar(45) DEFAULT NULL,
  `PUB_DATE` datetime DEFAULT NULL,
  `FEEDER_CATEGORY` tinyint(4) DEFAULT NULL,
  `TITLE` text,
  `LINK` varchar(255) DEFAULT NULL,
  `AUTHOR` varchar(45) DEFAULT NULL,
  `GUID` varchar(128) DEFAULT NULL,
  `CONTENT` text,
  `CONTENT_TYPE` int(11) DEFAULT '0' COMMENT '0: Web Page, 1: Native View',
  `IMAGE` text,
  `BE` int(11) NOT NULL DEFAULT '15',
  `TAG` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK1` (`PUB_DATE`,`LINK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FOLLOW`
--

DROP TABLE IF EXISTS `FOLLOW`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FOLLOW` (
  `F_PIN` varchar(20) NOT NULL,
  `L_PIN` varchar(20) NOT NULL,
  `FOLLOW_DATE` bigint(20) DEFAULT NULL,
  `UNFOLLOW_DATE` bigint(20) NOT NULL,
  PRIMARY KEY (`F_PIN`,`L_PIN`,`UNFOLLOW_DATE`),
  KEY `FOLOW$AK1` (`L_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FOLLOW_LIST`
--

DROP TABLE IF EXISTS `FOLLOW_LIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FOLLOW_LIST` (
  `F_PIN` varchar(20) NOT NULL,
  `L_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  PRIMARY KEY (`F_PIN`,`L_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM`
--

DROP TABLE IF EXISTS `FORM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FORM_ID` varchar(45) NOT NULL,
  `TITLE` varchar(45) NOT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `CREATED_BY` varchar(45) DEFAULT NULL,
  `STATUS` char(1) DEFAULT '1' COMMENT '''0:NonActive 1:Active''',
  `TARGET` char(1) DEFAULT '1' COMMENT '1: Personal, 2:Group',
  `SQ_NO` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_ACCESS`
--

DROP TABLE IF EXISTS `FORM_ACCESS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_ACCESS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` int(11) DEFAULT NULL,
  `FORM_ID` varchar(45) DEFAULT NULL,
  `GROUP_ID` varchar(45) DEFAULT NULL,
  `ACCESS_CATEGORY` int(11) DEFAULT NULL,
  `F_PIN` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_ACCESS_DUMMY`
--

DROP TABLE IF EXISTS `FORM_ACCESS_DUMMY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_ACCESS_DUMMY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` int(11) DEFAULT NULL,
  `FORM_ID` varchar(45) DEFAULT NULL,
  `GROUP_ID` varchar(45) DEFAULT NULL,
  `ACCESS_CATEGORY` int(11) DEFAULT NULL,
  `F_PIN` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_ASSIGNMENT_REPORT`
--

DROP TABLE IF EXISTS `FORM_ASSIGNMENT_REPORT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_ASSIGNMENT_REPORT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` varchar(45) DEFAULT NULL,
  `TASK` varchar(45) DEFAULT NULL,
  `PROJECT` varchar(45) DEFAULT NULL,
  `CLIENT` varchar(45) DEFAULT NULL,
  `ACTIVITY` varchar(512) DEFAULT NULL,
  `INITIATOR` varchar(45) DEFAULT NULL,
  `PIC` varchar(45) DEFAULT NULL,
  `PROGRESS` int(11) DEFAULT NULL,
  `SC_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `EC_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `REMARK` varchar(255) DEFAULT NULL,
  `LAST_UPDATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `MESSAGE_ID` varchar(45) DEFAULT NULL,
  `SUB_ACTIVITY` varchar(512) DEFAULT NULL,
  `TASK_TITLE` varchar(128) DEFAULT NULL,
  `ASSIGNEE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_ASSIGNMENT_REPORT_BU_20171211`
--

DROP TABLE IF EXISTS `FORM_ASSIGNMENT_REPORT_BU_20171211`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_ASSIGNMENT_REPORT_BU_20171211` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` varchar(45) DEFAULT NULL,
  `TASK` varchar(45) DEFAULT NULL,
  `PROJECT` varchar(45) DEFAULT NULL,
  `CLIENT` varchar(45) DEFAULT NULL,
  `ACTIVITY` varchar(45) DEFAULT NULL,
  `INITIATOR` varchar(45) DEFAULT NULL,
  `PIC` varchar(45) DEFAULT NULL,
  `PROGRESS` int(11) DEFAULT NULL,
  `SC_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `EC_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `REMARK` varchar(255) DEFAULT NULL,
  `LAST_UPDATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `MESSAGE_ID` varchar(45) DEFAULT NULL,
  `SUB_ACTIVITY` varchar(45) DEFAULT NULL,
  `TASK_TITLE` varchar(128) DEFAULT NULL,
  `ASSIGNEE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_ASSIGNMENT_REPORT_OLAP`
--

DROP TABLE IF EXISTS `FORM_ASSIGNMENT_REPORT_OLAP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_ASSIGNMENT_REPORT_OLAP` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` varchar(45) DEFAULT NULL,
  `TASK` varchar(45) DEFAULT NULL,
  `PROJECT` varchar(45) DEFAULT NULL,
  `CLIENT` varchar(45) DEFAULT NULL,
  `ACTIVITY` varchar(512) DEFAULT NULL,
  `INITIATOR` varchar(45) DEFAULT NULL,
  `PIC` varchar(45) DEFAULT NULL,
  `PROGRESS` int(11) DEFAULT NULL,
  `SC_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `EC_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `REMARK` varchar(255) DEFAULT NULL,
  `LAST_UPDATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `MESSAGE_ID` varchar(45) DEFAULT NULL,
  `SUB_ACTIVITY` varchar(512) DEFAULT NULL,
  `TASK_TITLE` varchar(128) DEFAULT NULL,
  `ASSIGNEE` varchar(128) DEFAULT NULL,
  `PROJECT_NAME` varchar(512) DEFAULT NULL,
  `CHAT_ID` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_BKP`
--

DROP TABLE IF EXISTS `FORM_BKP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_BKP` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FORM_ID` varchar(45) NOT NULL,
  `TITLE` varchar(45) NOT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `CREATED_BY` varchar(45) DEFAULT NULL,
  `STATUS` char(1) DEFAULT '1' COMMENT '''0:NonActive 1:Active''',
  `TARGET` char(1) DEFAULT '1' COMMENT '1: Personal, 2:Group',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_CHAIN`
--

DROP TABLE IF EXISTS `FORM_CHAIN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_CHAIN` (
  `ID` int(11) NOT NULL,
  `BE` int(11) DEFAULT '0',
  `FORM` varchar(45) DEFAULT NULL COMMENT 'FORM.FORM_ID',
  `GROUP` varchar(45) DEFAULT NULL COMMENT 'GROUPS.GROUP_ID',
  `FORUM` varchar(45) DEFAULT NULL,
  `ACCESS_CATEGORY` int(6) DEFAULT '0' COMMENT 'ACCESS_CATEGORY.ID',
  `F_PIN` varchar(45) DEFAULT NULL COMMENT 'USER_LIST.F_PIN',
  `ACTION_TYPE` char(1) DEFAULT NULL COMMENT '1 = RW, 0 = RO',
  `NEXT_CHAIN` tinyint(4) DEFAULT NULL COMMENT 'FORM_CHAIN.ID',
  `SQ_NO` int(6) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_INVITATION`
--

DROP TABLE IF EXISTS `FORM_INVITATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_INVITATION` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` text,
  `TASK` varchar(45) DEFAULT NULL,
  `MESSAGE_ID` varchar(100) DEFAULT NULL,
  `INITIATOR` varchar(45) DEFAULT NULL,
  `ASSIGNEE` varchar(128) DEFAULT NULL,
  `SC_DATE` datetime DEFAULT NULL,
  `EC_DATE` datetime DEFAULT NULL,
  `MOM` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `UK1` (`TASK`),
  KEY `IE1` (`SC_DATE`,`EC_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_ITEM`
--

DROP TABLE IF EXISTS `FORM_ITEM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_ITEM` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FORM_ID` varchar(45) NOT NULL,
  `LABEL` varchar(45) NOT NULL,
  `VALUE` text,
  `KEY` varchar(45) DEFAULT NULL,
  `SQ_NO` int(11) DEFAULT '0',
  `TYPE` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=285 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_PIC_DETAIL`
--

DROP TABLE IF EXISTS `FORM_PIC_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_PIC_DETAIL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FORM_ID` varchar(45) NOT NULL,
  `REF_ID` varchar(45) NOT NULL,
  `SUBMIT_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `SUBMIT_BY` varchar(45) NOT NULL,
  `NOTE` varchar(512) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `PARAM_1` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3291 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_PROJECT`
--

DROP TABLE IF EXISTS `FORM_PROJECT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_PROJECT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` int(11) DEFAULT NULL,
  `PROJECT` varchar(45) DEFAULT NULL,
  `CLIENT` varchar(45) DEFAULT NULL,
  `ACTIVITY` varchar(45) DEFAULT NULL,
  `SUB_ACTIVITY` varchar(45) DEFAULT NULL,
  `REF_ID` varchar(128) DEFAULT NULL,
  `TITLE` varchar(128) DEFAULT NULL,
  `FORM_ID` varchar(45) DEFAULT NULL,
  `FORM_NAME` varchar(40) DEFAULT NULL,
  `INSERT_DATE` date DEFAULT NULL,
  `INSERT_TIME` datetime DEFAULT NULL,
  `LAST_UPDATE` date DEFAULT NULL,
  `LAST_UPTIME` datetime DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK1` (`REF_ID`),
  KEY `IE1` (`INSERT_DATE`),
  KEY `IE2` (`PROJECT`),
  KEY `IE3` (`PROJECT`,`CLIENT`),
  KEY `IE4` (`PROJECT`,`CLIENT`,`ACTIVITY`),
  KEY `IE5` (`LAST_UPDATE`),
  KEY `IE6` (`TITLE`),
  KEY `IE7` (`FORM_NAME`),
  KEY `IE8` (`STATUS`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_RECURRING`
--

DROP TABLE IF EXISTS `FORM_RECURRING`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_RECURRING` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FORM_SUBMIT_ID` int(11) NOT NULL,
  `TYPE` varchar(25) DEFAULT NULL COMMENT 'Daily',
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `END_DATE` date DEFAULT '9999-12-31',
  PRIMARY KEY (`ID`),
  KEY `index2` (`FORM_SUBMIT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_SUBMIT`
--

DROP TABLE IF EXISTS `FORM_SUBMIT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_SUBMIT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `REF_ID` varchar(45) DEFAULT NULL,
  `FORM_ID` varchar(45) NOT NULL,
  `F_PIN` varchar(45) DEFAULT NULL,
  `CREATED_DATE` varchar(45) DEFAULT NULL,
  `APPROVED` char(1) DEFAULT NULL,
  `RECURRING_REF` int(11) DEFAULT '0',
  `DISCUSSION_ID` varchar(100) DEFAULT NULL,
  `INSERT_DATE` date DEFAULT NULL,
  `SQ_NO` int(11) DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_SUBMIT_ASSIGN`
--

DROP TABLE IF EXISTS `FORM_SUBMIT_ASSIGN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_SUBMIT_ASSIGN` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `REF_ID` varchar(50) DEFAULT NULL,
  `F_PIN` varchar(30) DEFAULT NULL,
  `APPROVE` char(1) DEFAULT NULL,
  `NOTE` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK1` (`REF_ID`,`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FORM_SUBMIT_DETAIL`
--

DROP TABLE IF EXISTS `FORM_SUBMIT_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FORM_SUBMIT_DETAIL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FORM_SUBMIT_ID` int(11) DEFAULT NULL,
  `KEY` varchar(45) DEFAULT NULL,
  `VALUE` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FRIEND_LIST`
--

DROP TABLE IF EXISTS `FRIEND_LIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FRIEND_LIST` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `L_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `BLOCK` int(1) DEFAULT '0',
  `OFFMP` int(1) DEFAULT '1',
  `STATUS` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `FRIEND_LIST$AK1` (`F_PIN`,`L_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=86150 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FRIEND_LIST_DUMMY`
--

DROP TABLE IF EXISTS `FRIEND_LIST_DUMMY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FRIEND_LIST_DUMMY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `L_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `BLOCK` int(1) DEFAULT '0',
  `OFFMP` int(1) DEFAULT '0',
  `STATUS` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `FRIEND_LIST$AK1` (`F_PIN`,`L_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FRIEND_LIST_MUTASI`
--

DROP TABLE IF EXISTS `FRIEND_LIST_MUTASI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FRIEND_LIST_MUTASI` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `L_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `BLOCK` int(1) DEFAULT '0',
  `OFFMP` int(1) DEFAULT '0',
  `STATUS` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `FRIEND_LIST$AK1` (`F_PIN`,`L_PIN`),
  KEY `IE$1` (`L_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `FRIEND_LIST_TMP`
--

DROP TABLE IF EXISTS `FRIEND_LIST_TMP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FRIEND_LIST_TMP` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `L_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `BLOCK` int(1) DEFAULT '0',
  `OFFMP` int(1) DEFAULT '1',
  `STATUS` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `FRIEND_LIST_TMP$AK1` (`F_PIN`,`L_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=130216 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GEOCODE`
--

DROP TABLE IF EXISTS `GEOCODE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GEOCODE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LATITUDE` varchar(16) NOT NULL,
  `LONGITUDE` varchar(16) NOT NULL,
  `ALTITUDE` varchar(16) DEFAULT '0.0',
  `ROUTE` varchar(128) DEFAULT NULL,
  `SUBLOCALITY_1` varchar(128) DEFAULT NULL,
  `SUBLOCALITY_2` varchar(128) DEFAULT NULL,
  `SUBLOCALITY_3` varchar(128) DEFAULT NULL,
  `SUBLOCALITY_4` varchar(128) DEFAULT NULL,
  `SUBLOCALITY_5` varchar(128) DEFAULT NULL,
  `LOCALITY_1` varchar(128) DEFAULT NULL,
  `LOCALITY_2` varchar(128) DEFAULT NULL,
  `ADM_AREA_L3` varchar(128) DEFAULT NULL,
  `ADM_AREA_L2` varchar(128) DEFAULT NULL,
  `ADM_AREA_L1` varchar(128) DEFAULT NULL,
  `COUNTRY` varchar(128) DEFAULT NULL,
  `POSTAL_CODE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`LATITUDE`,`LONGITUDE`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GOV_TERRITORY`
--

DROP TABLE IF EXISTS `GOV_TERRITORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GOV_TERRITORY` (
  `ID` mediumint(9) NOT NULL,
  `NAME` varbinary(128) NOT NULL,
  `GT_CATEGORY` smallint(6) NOT NULL,
  `PARENT` mediumint(9) NOT NULL,
  `LEVEL` smallint(6) NOT NULL,
  `NCHILD` smallint(6) NOT NULL,
  `CLONGITUDE` decimal(13,10) DEFAULT NULL,
  `CLATITUDE` decimal(13,10) DEFAULT NULL,
  `BOUNDARY` text,
  `BOUNDARY_USER` text,
  `FILE_NAME` text,
  `SC_DATE` datetime DEFAULT NULL COMMENT 'tanggal eksekusi',
  `EC_DATE` datetime DEFAULT '9999-12-31 00:00:00',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GT_AK1` (`NAME`,`GT_CATEGORY`,`PARENT`),
  KEY `GT_IE` (`LEVEL`,`GT_CATEGORY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GROUPS`
--

DROP TABLE IF EXISTS `GROUPS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GROUPS` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(32) NOT NULL,
  `GROUP_NAME` varchar(255) NOT NULL,
  `MESSAGE_SCOPE_ID` int(1) NOT NULL DEFAULT '0' COMMENT '1:Global, 2:Street 3:whisper 4:Group\n',
  `IS_ORGANIZATION` tinyint(4) NOT NULL DEFAULT '0',
  `LEVEL` tinyint(4) NOT NULL DEFAULT '-1',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `IMAGE_ID` varchar(256) DEFAULT NULL,
  `QUOTE` varchar(512) DEFAULT NULL,
  `CREATED_BY` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `PARENT_ID` varchar(32) DEFAULT NULL,
  `CHAT_MODIFIER` int(1) DEFAULT '1',
  `BUSINESS_ENTITY` int(11) DEFAULT '0',
  `IS_OPEN` int(4) DEFAULT '0',
  `IS_VIRTUAL` int(11) DEFAULT '0',
  `IS_EDUCATION` smallint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GROUP$AK1` (`GROUP_ID`),
  KEY `BE` (`BUSINESS_ENTITY`)
) ENGINE=InnoDB AUTO_INCREMENT=797 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GROUPS2`
--

DROP TABLE IF EXISTS `GROUPS2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GROUPS2` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(32) NOT NULL,
  `GROUP_NAME` varchar(64) NOT NULL,
  `MESSAGE_SCOPE_ID` int(1) NOT NULL DEFAULT '0' COMMENT '1:Global, 2:Street 3:whisper 4:Group\n',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `IMAGE_ID` varchar(256) DEFAULT NULL,
  `QUOTE` varchar(512) DEFAULT NULL,
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `PARENT_ID` varchar(32) DEFAULT NULL,
  `CHAT_MODIFIER` int(1) DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GROUP$AK1` (`GROUP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GROUPS22042020`
--

DROP TABLE IF EXISTS `GROUPS22042020`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GROUPS22042020` (
  `ID` int(6) NOT NULL DEFAULT '0',
  `GROUP_ID` varchar(32) NOT NULL,
  `GROUP_NAME` varchar(255) NOT NULL,
  `MESSAGE_SCOPE_ID` int(1) NOT NULL DEFAULT '0' COMMENT '1:Global, 2:Street 3:whisper 4:Group\n',
  `IS_ORGANIZATION` tinyint(4) NOT NULL DEFAULT '0',
  `LEVEL` tinyint(4) NOT NULL DEFAULT '-1',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `IMAGE_ID` varchar(256) DEFAULT NULL,
  `QUOTE` varchar(512) DEFAULT NULL,
  `CREATED_BY` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `PARENT_ID` varchar(32) DEFAULT NULL,
  `CHAT_MODIFIER` int(1) DEFAULT '1',
  `BUSINESS_ENTITY` int(11) DEFAULT '0',
  `IS_OPEN` int(4) DEFAULT '0',
  `IS_VIRTUAL` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GROUPS_DUMMY`
--

DROP TABLE IF EXISTS `GROUPS_DUMMY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GROUPS_DUMMY` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(32) NOT NULL,
  `GROUP_NAME` varchar(255) NOT NULL,
  `MESSAGE_SCOPE_ID` int(1) NOT NULL DEFAULT '0' COMMENT '1:Global, 2:Street 3:whisper 4:Group\n',
  `IS_ORGANIZATION` tinyint(4) NOT NULL DEFAULT '0',
  `LEVEL` tinyint(4) NOT NULL DEFAULT '-1',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `IMAGE_ID` varchar(256) DEFAULT NULL,
  `QUOTE` varchar(512) DEFAULT NULL,
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `PARENT_ID` varchar(32) DEFAULT NULL,
  `CHAT_MODIFIER` int(1) DEFAULT '1',
  `BUSINESS_ENTITY` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GROUP$AK1` (`GROUP_ID`),
  KEY `BE` (`BUSINESS_ENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GROUPS_EXTENDED`
--

DROP TABLE IF EXISTS `GROUPS_EXTENDED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GROUPS_EXTENDED` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(32) NOT NULL,
  `LEVEL_EDUCATION` smallint(1) DEFAULT '-1',
  `MATERI_EDUCATION` smallint(1) DEFAULT '-1',
  `EDUCATION_STAGE` smallint(1) DEFAULT '-1',
  PRIMARY KEY (`ID`),
  KEY `GROUPS_EXTENDED$AK1` (`GROUP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=656 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GROUPS_GLOBAL`
--

DROP TABLE IF EXISTS `GROUPS_GLOBAL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GROUPS_GLOBAL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GROUPS_MUTASI`
--

DROP TABLE IF EXISTS `GROUPS_MUTASI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GROUPS_MUTASI` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(32) NOT NULL,
  `GROUP_NAME` varchar(255) NOT NULL,
  `MESSAGE_SCOPE_ID` int(1) NOT NULL DEFAULT '0' COMMENT '1:Global, 2:Street 3:whisper 4:Group\n',
  `IS_ORGANIZATION` tinyint(4) NOT NULL DEFAULT '0',
  `LEVEL` tinyint(4) NOT NULL DEFAULT '-1',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `IMAGE_ID` varchar(256) DEFAULT NULL,
  `QUOTE` varchar(512) DEFAULT NULL,
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `PARENT_ID` varchar(32) DEFAULT NULL,
  `CHAT_MODIFIER` int(1) DEFAULT '1',
  `BUSINESS_ENTITY` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GROUP$AK1` (`GROUP_ID`),
  KEY `BE` (`BUSINESS_ENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GROUP_BKP`
--

DROP TABLE IF EXISTS `GROUP_BKP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GROUP_BKP` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(32) NOT NULL,
  `GROUP_NAME` varchar(255) NOT NULL,
  `MESSAGE_SCOPE_ID` int(1) NOT NULL DEFAULT '0' COMMENT '1:Global, 2:Street 3:whisper 4:Group\n',
  `IS_ORGANIZATION` tinyint(4) NOT NULL DEFAULT '0',
  `LEVEL` tinyint(4) NOT NULL DEFAULT '-1',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `IMAGE_ID` varchar(256) DEFAULT NULL,
  `QUOTE` varchar(512) DEFAULT NULL,
  `CREATED_BY` varchar(20) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `PARENT_ID` varchar(32) DEFAULT NULL,
  `CHAT_MODIFIER` int(1) DEFAULT '1',
  `BUSINESS_ENTITY` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GROUP$AK1` (`GROUP_ID`),
  KEY `BE` (`BUSINESS_ENTITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GROUP_HIERARCHY`
--

DROP TABLE IF EXISTS `GROUP_HIERARCHY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GROUP_HIERARCHY` (
  `GROUP_ID` varchar(32) DEFAULT NULL,
  `PARENT_ID` varchar(32) DEFAULT NULL,
  `PARENT_NAME` varchar(255) DEFAULT NULL,
  `PARENT_LEVEL` tinyint(4) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  UNIQUE KEY `G$1` (`GROUP_ID`,`PARENT_ID`,`PARENT_LEVEL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GT_BOUNDARY`
--

DROP TABLE IF EXISTS `GT_BOUNDARY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GT_BOUNDARY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GOV_TERRITORY` varchar(6) NOT NULL,
  `SQ_NO` int(11) NOT NULL,
  `LONGITUDE` varchar(45) NOT NULL,
  `LATITUDE` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `GT_CATEGORY`
--

DROP TABLE IF EXISTS `GT_CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GT_CATEGORY` (
  `ID` smallint(6) NOT NULL,
  `NAME` varchar(64) NOT NULL,
  `PARENT` smallint(6) NOT NULL,
  `LEVEL` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GTC_AK1` (`NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `HOLIDAY`
--

DROP TABLE IF EXISTS `HOLIDAY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HOLIDAY` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `office` int(11) NOT NULL COMMENT 'Refer to table OFFICE',
  `holiday_date` date NOT NULL COMMENT '-',
  PRIMARY KEY (`id`),
  KEY `AK1_idx` (`holiday_date`,`office`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `IMAGE`
--

DROP TABLE IF EXISTS `IMAGE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IMAGE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IMAGE_ID` varchar(45) NOT NULL,
  `IMAGE` mediumblob,
  `PATH` varchar(256) DEFAULT NULL,
  `FORMAT` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `IMAGE$AK1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `INACTIVE_USER_LIST_210920`
--

DROP TABLE IF EXISTS `INACTIVE_USER_LIST_210920`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `INACTIVE_USER_LIST_210920` (
  `ID` int(6) NOT NULL DEFAULT '0',
  `F_PIN` varchar(20) NOT NULL,
  `UPLINE_PIN` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(128) NOT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `IMAGE` varchar(256) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT '0',
  `QUOTE` varchar(512) DEFAULT NULL COMMENT 'user status',
  `CONNECTED` int(1) DEFAULT '0' COMMENT '0:NOT CONNECT, 1:CONNECT\n',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `ALTITUDE` varchar(45) DEFAULT NULL,
  `CELL` varchar(24) DEFAULT NULL,
  `LAST_LOC_UPDATE` datetime DEFAULT NULL,
  `EMPTY_1` varchar(1) DEFAULT NULL,
  `IMEI` varchar(48) DEFAULT NULL,
  `TIMEZONE` varchar(45) DEFAULT NULL,
  `PRIVACY_FLAG` varchar(16) DEFAULT NULL,
  `MSISDN` varchar(24) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT '0',
  `CREATED_DATE` datetime NOT NULL,
  `OFFLINE_MODE` int(1) DEFAULT '0',
  `NETWORK_TYPE` int(1) DEFAULT '0',
  `SERVER_ID` char(2) DEFAULT NULL,
  `LAST_CON_UPDATE` datetime DEFAULT NULL,
  `EXT_TEXT_1` text,
  `IS_DEACTIVATED` tinyint(4) NOT NULL DEFAULT '0',
  `EC_DATE` bigint(20) DEFAULT NULL,
  `SHOP` varchar(36) DEFAULT NULL,
  `POS_FLAG` char(1) DEFAULT '0',
  `CONNECTION_FLAG` int(1) DEFAULT '0',
  `EXTENSION` int(11) DEFAULT NULL,
  `LAC` varchar(45) DEFAULT NULL,
  `CI` varchar(45) DEFAULT NULL,
  `LAST_LOC_NAME` varchar(225) DEFAULT NULL,
  `ROOT_BE` int(11) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  `AC` int(11) DEFAULT NULL,
  `INIT_STATE` int(1) DEFAULT NULL,
  `REAL_IMEI` varchar(32) DEFAULT NULL,
  `APP_VERSION` varchar(40) DEFAULT NULL,
  `RESET_FLAG` int(1) DEFAULT '0',
  `FIRST_INIT` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `INDONESIAN_WORDS`
--

DROP TABLE IF EXISTS `INDONESIAN_WORDS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `INDONESIAN_WORDS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WORD` varchar(64) NOT NULL,
  `TYPE` varchar(8) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UQ_INDONESIAN_WORDS_WORDS_TYPE` (`WORD`,`TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `KBBI_MINI`
--

DROP TABLE IF EXISTS `KBBI_MINI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KBBI_MINI` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KATA` varchar(20) NOT NULL,
  `JENIS_KATA` varchar(8) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `KBLI_2015`
--

DROP TABLE IF EXISTS `KBLI_2015`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KBLI_2015` (
  `CHAPTER` varchar(2) NOT NULL,
  `CODE` varchar(16) NOT NULL,
  `IS_LEAF` tinyint(4) NOT NULL DEFAULT '0',
  `NAME` varchar(256) NOT NULL,
  `DESC` text NOT NULL,
  PRIMARY KEY (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `KBLI_2015_INVERTED`
--

DROP TABLE IF EXISTS `KBLI_2015_INVERTED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KBLI_2015_INVERTED` (
  `TERM` varchar(24) NOT NULL,
  `LOCATION` varchar(16) NOT NULL,
  `FREQUENCY` int(11) NOT NULL,
  PRIMARY KEY (`TERM`,`LOCATION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `KBLI_2015_TERMS`
--

DROP TABLE IF EXISTS `KBLI_2015_TERMS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KBLI_2015_TERMS` (
  `TERM` varchar(24) NOT NULL,
  `TOTAL_FREQUENCY` int(11) NOT NULL,
  `TOTAL_DOC` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`TERM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `KREN_WEB`
--

DROP TABLE IF EXISTS `KREN_WEB`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `KREN_WEB` (
  `F_PIN` varchar(20) NOT NULL,
  `WEB_ID` varchar(20) NOT NULL,
  PRIMARY KEY (`F_PIN`),
  UNIQUE KEY `KREN_WEB$AK` (`WEB_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `LIVE_TV`
--

DROP TABLE IF EXISTS `LIVE_TV`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LIVE_TV` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `TV_ID` int(11) DEFAULT NULL,
  `CATEGORY_ID` smallint(4) DEFAULT NULL,
  `TITLE` varchar(64) DEFAULT NULL,
  `DESCRIPTION` varchar(512) DEFAULT NULL,
  `STREAM_ID` varchar(512) DEFAULT NULL,
  `THUMB_ID` varchar(512) DEFAULT NULL,
  `IMAGE_ID` varchar(512) DEFAULT NULL,
  `LAST_UPDATE` datetime NOT NULL,
  `STATUS` int(1) DEFAULT NULL,
  `SCHEME_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `LOCATION_HISTORY`
--

DROP TABLE IF EXISTS `LOCATION_HISTORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LOCATION_HISTORY` (
  `USER_PIN` varchar(20) NOT NULL,
  `DATETIME` datetime NOT NULL,
  `LONGITUDE` varchar(45) NOT NULL,
  `LATITUDE` varchar(45) NOT NULL,
  PRIMARY KEY (`DATETIME`,`USER_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `LOCATION_HISTORY_HOURLY`
--

DROP TABLE IF EXISTS `LOCATION_HISTORY_HOURLY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LOCATION_HISTORY_HOURLY` (
  `USER_PIN` varchar(20) NOT NULL,
  `DATE` date NOT NULL,
  `HOUR_OF_DAY` tinyint(4) NOT NULL,
  `LONGITUDE` varchar(45) NOT NULL,
  `LATITUDE` varchar(45) NOT NULL,
  PRIMARY KEY (`USER_PIN`,`DATE`,`HOUR_OF_DAY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MAPPING_PG`
--

DROP TABLE IF EXISTS `MAPPING_PG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MAPPING_PG` (
  `L1_GROUP_ID` varchar(32) DEFAULT NULL,
  `L1_GROUP_NAME` varchar(255) DEFAULT NULL,
  `L1_PARENT` varchar(32) DEFAULT NULL,
  `L1_LEVEL` tinyint(4) DEFAULT NULL,
  `L2_GROUP_ID` varchar(32) DEFAULT NULL,
  `L2_GROUP_NAME` varchar(255) DEFAULT NULL,
  `L2_PARENT` varchar(32) DEFAULT NULL,
  `L2_LEVEL` tinyint(4) DEFAULT NULL,
  `L3_GROUP_ID` varchar(32) DEFAULT NULL,
  `L3_GROUP_NAME` varchar(255) DEFAULT NULL,
  `L3_PARENT` varchar(32) DEFAULT NULL,
  `L3_LEVEL` tinyint(4) DEFAULT NULL,
  `L4_GROUP_ID` varchar(32) DEFAULT NULL,
  `L4_GROUP_NAME` varchar(255) DEFAULT NULL,
  `L4_PARENT` varchar(32) DEFAULT NULL,
  `L4_LEVEL` tinyint(4) DEFAULT NULL,
  `L5_GROUP_ID` varchar(32) DEFAULT NULL,
  `L5_GROUP_NAME` varchar(255) DEFAULT NULL,
  `L5_PARENT` varchar(32) DEFAULT NULL,
  `L5_LEVEL` tinyint(4) DEFAULT NULL,
  `L6_GROUP_ID` varchar(32) DEFAULT NULL,
  `L6_GROUP_NAME` varchar(255) DEFAULT NULL,
  `L6_PARENT` varchar(32) DEFAULT NULL,
  `L6_LEVEL` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MAPPING_USER_WALLET`
--

DROP TABLE IF EXISTS `MAPPING_USER_WALLET`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MAPPING_USER_WALLET` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(24) DEFAULT '0',
  `SOURCE_ID` varchar(24) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `MAPPING_USER_WALLET$AK` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MEMBERS`
--

DROP TABLE IF EXISTS `MEMBERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MEMBERS` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(32) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `BLOCK` int(1) DEFAULT '0',
  `POSITION` int(1) DEFAULT '0',
  `ACCESS_CATEGORY` int(6) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GROUP$AK` (`GROUP_ID`,`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=10356 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MEMBERS_BACKUP_20190207`
--

DROP TABLE IF EXISTS `MEMBERS_BACKUP_20190207`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MEMBERS_BACKUP_20190207` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(32) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `BLOCK` int(1) DEFAULT '0',
  `POSITION` int(1) DEFAULT '0',
  `ACCESS_CATEGORY` int(6) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GROUP$AK` (`GROUP_ID`,`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MEMBERS_BKP`
--

DROP TABLE IF EXISTS `MEMBERS_BKP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MEMBERS_BKP` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(32) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `BLOCK` int(1) DEFAULT '0',
  `POSITION` int(1) DEFAULT '0',
  `ACCESS_CATEGORY` int(6) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GROUP$AK` (`GROUP_ID`,`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=7705 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MEMBERS_MUTASI`
--

DROP TABLE IF EXISTS `MEMBERS_MUTASI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MEMBERS_MUTASI` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(32) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `BLOCK` int(1) DEFAULT '0',
  `POSITION` int(1) DEFAULT '0',
  `ACCESS_CATEGORY` int(6) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GROUP$AK` (`GROUP_ID`,`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MENU_IMAGE`
--

DROP TABLE IF EXISTS `MENU_IMAGE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MENU_IMAGE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `image_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_menu` (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MERCHANTS`
--

DROP TABLE IF EXISTS `MERCHANTS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MERCHANTS` (
  `ID` varchar(32) NOT NULL,
  `NAME` varchar(64) NOT NULL,
  `DESCRIPTION` text,
  `IMAGE` varchar(128) DEFAULT NULL,
  `ADDRESS` text,
  `LATITUDE` varchar(32) DEFAULT NULL,
  `LONGITUDE` varchar(32) DEFAULT NULL,
  `PHONE_NUMBER` varchar(32) DEFAULT NULL,
  `EMAIL` varchar(32) DEFAULT NULL,
  `OPEN_HOUR` varchar(32) DEFAULT NULL,
  `CLOSED_HOUR` varchar(32) DEFAULT NULL,
  `OWNER` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MESSAGE`
--

DROP TABLE IF EXISTS `MESSAGE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MESSAGE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MESSAGE_ID` varchar(60) DEFAULT NULL,
  `DESTINATION` varchar(60) DEFAULT NULL,
  `ORIGINATOR` varchar(60) DEFAULT NULL,
  `CONTENT` text,
  `SENT_TIME` decimal(20,0) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `AK1` (`MESSAGE_ID`),
  KEY `AK3` (`ORIGINATOR`),
  KEY `AK4` (`DESTINATION`),
  KEY `AK2` (`SENT_TIME`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MESSAGE_FILTER`
--

DROP TABLE IF EXISTS `MESSAGE_FILTER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MESSAGE_FILTER` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `MESSAGE_CODE` varchar(16) DEFAULT '',
  `STATUS` int(1) DEFAULT NULL COMMENT '* 1 --> Selalu push\n * 2 --> Dispatch jika awake',
  `DESRIPTION` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MISC_DATA`
--

DROP TABLE IF EXISTS `MISC_DATA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MISC_DATA` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KEY` varchar(45) NOT NULL,
  `VALUE` text NOT NULL,
  `TIME` bigint(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `UNIQUE` (`KEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MSISDN_MEDIC_WHITELIST`
--

DROP TABLE IF EXISTS `MSISDN_MEDIC_WHITELIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MSISDN_MEDIC_WHITELIST` (
  `MSISDN` varchar(24) NOT NULL,
  `FLAG` int(1) DEFAULT '0',
  UNIQUE KEY `MSISDN_MEDIC_WHITELIST$AK` (`MSISDN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MUTATION_RESET_UPGRADE`
--

DROP TABLE IF EXISTS `MUTATION_RESET_UPGRADE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MUTATION_RESET_UPGRADE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `DATE` date DEFAULT NULL,
  `HOUR` int(11) NOT NULL,
  `STATUS` int(1) DEFAULT '0' COMMENT '0:Waiting, 1:Processed',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK1` (`F_PIN`,`DATE`,`STATUS`,`HOUR`),
  KEY `STATUS` (`STATUS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `MYIMAGE`
--

DROP TABLE IF EXISTS `MYIMAGE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MYIMAGE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MYIMAGE_ID` varchar(48) NOT NULL,
  `FORMAT` varchar(10) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CREATED_BY` varchar(20) NOT NULL,
  `STATUS` int(1) DEFAULT NULL,
  `DESCRIPTION` varchar(512) DEFAULT NULL,
  `THUMB_ID` varchar(256) DEFAULT NULL,
  `IMAGE_ID` varchar(256) DEFAULT NULL,
  `SCOPE_ID` int(1) DEFAULT '7',
  `L_PIN` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `SIMAGE_ID_UNIQUE` (`MYIMAGE_ID`),
  KEY `SIMAGE$AK_1` (`MYIMAGE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NEWS_MAPPING`
--

DROP TABLE IF EXISTS `NEWS_MAPPING`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NEWS_MAPPING` (
  `SCHEME_ID` int(10) DEFAULT NULL,
  `RESOURCE` varchar(45) DEFAULT NULL COMMENT '0:NU 1:IT'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NEW_DF`
--

DROP TABLE IF EXISTS `NEW_DF`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NEW_DF` (
  `_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CHAT_ID` varchar(64) DEFAULT NULL,
  `TITLE` varchar(512) DEFAULT NULL,
  `THUMB` text,
  `OWNER` varchar(30) DEFAULT NULL,
  `PRODUCT_ID` varchar(64) DEFAULT NULL,
  `CLIENT_ID` varchar(64) DEFAULT NULL,
  `DESCRIPTION` text,
  `START_DATE` bigint(20) DEFAULT NULL,
  `END_DATE` bigint(20) DEFAULT NULL,
  `GROUP_ID` varchar(64) DEFAULT NULL,
  `CREATED_DATE` bigint(20) DEFAULT NULL,
  `PROJECT_REF` varchar(64) DEFAULT NULL,
  `TRANS_ID` varchar(64) DEFAULT NULL,
  `DELETE_DATE` datetime DEFAULT NULL,
  `INFOI` int(1) DEFAULT '1',
  PRIMARY KEY (`_ID`),
  UNIQUE KEY `CHAT_ID` (`CHAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NEW_DF_ACTIVITY`
--

DROP TABLE IF EXISTS `NEW_DF_ACTIVITY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NEW_DF_ACTIVITY` (
  `_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CHAT_ID` varchar(64) DEFAULT NULL,
  `FORM_ID` varchar(30) DEFAULT NULL,
  `ACTIVITY_ID` varchar(64) DEFAULT NULL,
  `ACTIVITY_NAME` varchar(512) DEFAULT NULL,
  `SUB_ACTIVITY_ID` varchar(64) DEFAULT NULL,
  `SUB_ACTIVITY_NAME` varchar(512) DEFAULT NULL,
  `START_DATE` varchar(100) DEFAULT NULL,
  `END_DATE` varchar(100) DEFAULT NULL,
  `DESCRIPTION` text,
  `IS_DISCUSSION` char(1) DEFAULT NULL COMMENT 'Activity as a sub Discussion Forum',
  `DISCUSSION_ID` varchar(60) DEFAULT NULL COMMENT 'Refere to table DISCUSSION_FORUM.CHAT_ID',
  `IS_ARCHIVED` char(1) DEFAULT NULL,
  PRIMARY KEY (`_ID`),
  UNIQUE KEY `NDAU1` (`CHAT_ID`,`FORM_ID`),
  KEY `NDAK1` (`DISCUSSION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NEW_DF_CLIENT`
--

DROP TABLE IF EXISTS `NEW_DF_CLIENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NEW_DF_CLIENT` (
  `_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CLIENT_ID` varchar(64) DEFAULT NULL,
  `NAME` varchar(512) DEFAULT NULL,
  `THUMB` text,
  PRIMARY KEY (`_ID`),
  UNIQUE KEY `CLIENT_ID` (`CLIENT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NEW_DF_EXTENDED`
--

DROP TABLE IF EXISTS `NEW_DF_EXTENDED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NEW_DF_EXTENDED` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` varchar(64) DEFAULT NULL,
  `anonym` text,
  PRIMARY KEY (`_id`),
  UNIQUE KEY `chat_id` (`chat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NEW_DF_MUTE`
--

DROP TABLE IF EXISTS `NEW_DF_MUTE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NEW_DF_MUTE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CHAT_ID` varchar(64) DEFAULT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `SC_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `EC_DATE` datetime DEFAULT '9999-12-31 23:59:59',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NEW_DF_PRODUCT`
--

DROP TABLE IF EXISTS `NEW_DF_PRODUCT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NEW_DF_PRODUCT` (
  `_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_ID` varchar(64) DEFAULT NULL,
  `NAME` varchar(512) DEFAULT NULL,
  `THUMB` text,
  PRIMARY KEY (`_ID`),
  UNIQUE KEY `PRODUCT_ID` (`PRODUCT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NEW_DF_RACI`
--

DROP TABLE IF EXISTS `NEW_DF_RACI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NEW_DF_RACI` (
  `_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CHAT_ID` varchar(64) DEFAULT NULL,
  `F_PIN` varchar(30) DEFAULT NULL,
  `ROLE` int(11) DEFAULT NULL COMMENT '1:R, 2:A, 3:C, 4:I',
  `REFF_ID` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`_ID`),
  UNIQUE KEY `NEW_DF_RACI$UK1` (`CHAT_ID`,`F_PIN`,`REFF_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NEW_DF_RACI_BKP_2019030314`
--

DROP TABLE IF EXISTS `NEW_DF_RACI_BKP_2019030314`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NEW_DF_RACI_BKP_2019030314` (
  `_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CHAT_ID` varchar(64) DEFAULT NULL,
  `F_PIN` varchar(30) DEFAULT NULL,
  `ROLE` int(11) DEFAULT NULL COMMENT '1:R, 2:A, 3:C, 4:I',
  `REFF_ID` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NEW_DF_SUB_ACTIVITY`
--

DROP TABLE IF EXISTS `NEW_DF_SUB_ACTIVITY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NEW_DF_SUB_ACTIVITY` (
  `_ID` int(11) NOT NULL AUTO_INCREMENT,
  `CHAT_ID` varchar(64) DEFAULT NULL,
  `ACTIVITY_ID` varchar(64) DEFAULT NULL,
  `SUB_ACTIVITY_ID` varchar(64) DEFAULT NULL,
  `THUMB` text,
  PRIMARY KEY (`_ID`),
  UNIQUE KEY `CHAT_ID` (`CHAT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NEW_SUB_DF_RACI`
--

DROP TABLE IF EXISTS `NEW_SUB_DF_RACI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NEW_SUB_DF_RACI` (
  `_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DISCUSSION_ID` varchar(60) DEFAULT NULL,
  `F_PIN` varchar(20) DEFAULT NULL,
  `ROLE` int(11) DEFAULT NULL COMMENT '1:R, 2:A, 3:C, 4:I',
  PRIMARY KEY (`_ID`),
  UNIQUE KEY `NEW_SUB_DF_RACI$AK1` (`DISCUSSION_ID`,`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NOTIFICATION_COVID`
--

DROP TABLE IF EXISTS `NOTIFICATION_COVID`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NOTIFICATION_COVID` (
  `SURVEY_COVID` bigint(32) NOT NULL,
  `FLAG` int(6) DEFAULT '0',
  PRIMARY KEY (`SURVEY_COVID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OFFICE`
--

DROP TABLE IF EXISTS `OFFICE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OFFICE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place_id` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `radius` int(11) NOT NULL DEFAULT '100',
  `longitude` varchar(45) NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `address` text,
  `be_id` int(11) NOT NULL,
  `default_office` int(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `PLACE_ID_UNIQUE` (`place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OFFICE_MUTASI`
--

DROP TABLE IF EXISTS `OFFICE_MUTASI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OFFICE_MUTASI` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place_id` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `radius` int(11) NOT NULL DEFAULT '100',
  `longitude` varchar(45) NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `be_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `PLACE_ID_UNIQUE` (`place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OFFICE_TIME`
--

DROP TABLE IF EXISTS `OFFICE_TIME`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OFFICE_TIME` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OFFICE_X`
--

DROP TABLE IF EXISTS `OFFICE_X`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OFFICE_X` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place_id` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `radius` int(11) NOT NULL DEFAULT '100',
  `longitude` varchar(45) NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `address` varchar(128) DEFAULT NULL,
  `be_id` int(11) NOT NULL DEFAULT '0',
  `timezone` int(2) NOT NULL DEFAULT '7',
  `lunch_enable` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `PLACE_ID_UNIQUE` (`place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OPEN_INVITATION`
--

DROP TABLE IF EXISTS `OPEN_INVITATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OPEN_INVITATION` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `INVITATION_ID` varchar(64) NOT NULL,
  `TITLE` varchar(512) DEFAULT NULL,
  `GOAL` text,
  `CREATED_DATE` datetime DEFAULT NULL,
  `START_DATE` datetime DEFAULT NULL,
  `END_DATE` datetime DEFAULT NULL,
  `LOCATION_NAME` varchar(512) DEFAULT NULL,
  `LONGITUDE` decimal(13,10) DEFAULT NULL,
  `LATITUDE` decimal(13,10) DEFAULT NULL,
  `OWNER` varchar(32) DEFAULT NULL,
  `FORM_TEXT` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `OI1` (`INVITATION_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OPEN_INVITATION_AGENDA`
--

DROP TABLE IF EXISTS `OPEN_INVITATION_AGENDA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OPEN_INVITATION_AGENDA` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `INVITATION_ID` varchar(64) NOT NULL,
  `AGENDA_ID` varchar(64) NOT NULL,
  `TITLE` varchar(512) DEFAULT NULL,
  `DESCRIPTION` text NOT NULL,
  `LOCATION_NAME` varchar(512) DEFAULT NULL,
  `LONGITUDE` decimal(13,10) DEFAULT NULL,
  `LATITUDE` decimal(13,10) DEFAULT NULL,
  `START_DATE` datetime DEFAULT NULL,
  `END_DATE` datetime DEFAULT NULL,
  `BROADCAST` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `OIA1` (`INVITATION_ID`,`AGENDA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OPEN_INVITATION_INVITED`
--

DROP TABLE IF EXISTS `OPEN_INVITATION_INVITED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OPEN_INVITATION_INVITED` (
  `INVITATION_ID` varchar(64) NOT NULL,
  `BE` int(11) NOT NULL,
  UNIQUE KEY `OII1` (`INVITATION_ID`,`BE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OPEN_INVITATION_REGISTER`
--

DROP TABLE IF EXISTS `OPEN_INVITATION_REGISTER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OPEN_INVITATION_REGISTER` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AGENDA_ID` varchar(64) NOT NULL,
  `F_PIN` varchar(20) DEFAULT NULL,
  `REGISTER_DATE` datetime DEFAULT NULL,
  `ATTEND_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `OIR1` (`AGENDA_ID`,`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ORDER_TRANSACTION`
--

DROP TABLE IF EXISTS `ORDER_TRANSACTION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORDER_TRANSACTION` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_RESTO` int(11) NOT NULL,
  `ID_MENU` int(11) NOT NULL,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `TOTAL_PAYMENT` int(255) NOT NULL,
  `ORDER_TIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ORGANIZATION_LEADER`
--

DROP TABLE IF EXISTS `ORGANIZATION_LEADER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORGANIZATION_LEADER` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(45) DEFAULT NULL,
  `ACCESS_CATEGORY` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ORGANIZATION_LEADER_20190311`
--

DROP TABLE IF EXISTS `ORGANIZATION_LEADER_20190311`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORGANIZATION_LEADER_20190311` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(45) DEFAULT NULL,
  `ACCESS_CATEGORY` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ORGANIZATION_LEADER_BKP`
--

DROP TABLE IF EXISTS `ORGANIZATION_LEADER_BKP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORGANIZATION_LEADER_BKP` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(45) DEFAULT NULL,
  `ACCESS_CATEGORY` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ORGANIZATION_LEADER_MUTASI`
--

DROP TABLE IF EXISTS `ORGANIZATION_LEADER_MUTASI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORGANIZATION_LEADER_MUTASI` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(45) DEFAULT NULL,
  `ACCESS_CATEGORY` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ORG_ACTIVITY`
--

DROP TABLE IF EXISTS `ORG_ACTIVITY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ORG_ACTIVITY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUP_ID` varchar(100) NOT NULL,
  `ACTIVITY` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK1` (`GROUP_ID`,`ACTIVITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OUT_QUEUE_L1`
--

DROP TABLE IF EXISTS `OUT_QUEUE_L1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OUT_QUEUE_L1` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KEY` text,
  `DATA` text,
  `CREATED_DATE` datetime DEFAULT NULL,
  `END_DATE` datetime DEFAULT NULL,
  `STATUS` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX` (`STATUS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OUT_QUEUE_L2`
--

DROP TABLE IF EXISTS `OUT_QUEUE_L2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OUT_QUEUE_L2` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `KEY` text,
  `DATA` text,
  `CREATED_DATE` datetime DEFAULT NULL,
  `END_DATE` datetime DEFAULT NULL,
  `STATUS` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `INDEX` (`STATUS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PARTNER_BE`
--

DROP TABLE IF EXISTS `PARTNER_BE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PARTNER_BE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` int(11) NOT NULL,
  `BE_MITRA` int(11) NOT NULL,
  `BE_MITRA_NAME` varchar(128) NOT NULL,
  `IP` varchar(45) NOT NULL,
  `PORT` int(11) NOT NULL,
  `LAST_UPDATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PARTNER_BE $UK0` (`BE_MITRA_NAME`),
  UNIQUE KEY `PARTNER_BE $UK1` (`BE_MITRA`,`IP`,`PORT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PARTNER_USER`
--

DROP TABLE IF EXISTS `PARTNER_USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PARTNER_USER` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(45) NOT NULL,
  `IMAGE` varchar(256) NOT NULL DEFAULT '',
  `FIRST_NAME` varchar(128) DEFAULT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `IMEI` varchar(48) NOT NULL DEFAULT '',
  `MSISDN` varchar(20) NOT NULL DEFAULT '',
  `EMAIL` varchar(128) NOT NULL DEFAULT '',
  `BE` int(11) NOT NULL,
  `BE_NAME` varchar(45) NOT NULL,
  `DIVISION` varchar(128) NOT NULL,
  `POSITION` varchar(128) NOT NULL,
  `CONNECTION_FLAG` int(1) NOT NULL DEFAULT '0',
  `LAST_UPDATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PARTNER_BE $UK1` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PAYMENT`
--

DROP TABLE IF EXISTS `PAYMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PAYMENT` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `DESCRIPTION_1` varchar(45) DEFAULT NULL,
  `DESCRIPTION_2` varchar(45) DEFAULT NULL,
  `STATUS` int(1) NOT NULL COMMENT '0:TIDAK AKTIVE; 1:AKTIVE',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PENDING_ACTION`
--

DROP TABLE IF EXISTS `PENDING_ACTION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PENDING_ACTION` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(100) NOT NULL,
  `SUBMIT_DATE` date DEFAULT NULL,
  `SUBMIT_TIME` datetime DEFAULT CURRENT_TIMESTAMP,
  `ACTION_CODE` varchar(100) NOT NULL,
  `PROJECT` int(11) NOT NULL,
  `CLIENT` int(11) NOT NULL,
  `R` varchar(255) NOT NULL COMMENT 'DF.CHAT_ID',
  `A` varchar(255) NOT NULL COMMENT 'DF.CHAT_ID',
  `C` varchar(255) NOT NULL COMMENT 'DF.CHAT_ID',
  `I` varchar(255) NOT NULL COMMENT 'DF.CHAT_ID',
  `PROCESS_DATE` date DEFAULT NULL,
  `PROCESS_TIME` datetime DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL COMMENT '1:OK, -1:ERROR',
  PRIMARY KEY (`ID`),
  KEY `IK1` (`SUBMIT_DATE`),
  KEY `IK2` (`USERNAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PENDING_SID`
--

DROP TABLE IF EXISTS `PENDING_SID`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PENDING_SID` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `SID` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PENDING_SID$AK` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PERSON_ACTIVITY`
--

DROP TABLE IF EXISTS `PERSON_ACTIVITY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERSON_ACTIVITY` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person` varchar(20) NOT NULL,
  `activity` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` datetime NOT NULL,
  `office` int(11) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `note` varchar(128) DEFAULT NULL,
  `STATUS` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_PERSON_ACTIVITY_1_idx` (`activity`),
  KEY `fk_PERSON_ACTIVITY_2_idx` (`office`),
  KEY `fk_PERSON_ACTIVITY_3_idx` (`person`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PERSON_APPROVE_EDUCATIONAL`
--

DROP TABLE IF EXISTS `PERSON_APPROVE_EDUCATIONAL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERSON_APPROVE_EDUCATIONAL` (
  `F_PIN` varchar(20) NOT NULL,
  PRIMARY KEY (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PERSON_APPROVE_HANDYCRAFT`
--

DROP TABLE IF EXISTS `PERSON_APPROVE_HANDYCRAFT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERSON_APPROVE_HANDYCRAFT` (
  `F_PIN` varchar(20) NOT NULL,
  PRIMARY KEY (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PERSON_APPROVE_MEDIC`
--

DROP TABLE IF EXISTS `PERSON_APPROVE_MEDIC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERSON_APPROVE_MEDIC` (
  `F_PIN` varchar(20) NOT NULL,
  PRIMARY KEY (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PERSON_APPROVE_VA`
--

DROP TABLE IF EXISTS `PERSON_APPROVE_VA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERSON_APPROVE_VA` (
  `F_PIN` varchar(20) NOT NULL,
  PRIMARY KEY (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PERSON_HEIRS`
--

DROP TABLE IF EXISTS `PERSON_HEIRS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERSON_HEIRS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(32) DEFAULT NULL,
  `MSISDN` varchar(20) DEFAULT NULL,
  `RELATION` varchar(40) DEFAULT NULL,
  `PHOTO` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK1` (`F_PIN`,`MSISDN`)
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PERSON_LEAVE`
--

DROP TABLE IF EXISTS `PERSON_LEAVE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERSON_LEAVE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(45) NOT NULL,
  `SC_DATE` date NOT NULL,
  `EC_DATE` date DEFAULT NULL,
  `REASON` text,
  PRIMARY KEY (`ID`,`SC_DATE`,`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PERSON_LOCATION`
--

DROP TABLE IF EXISTS `PERSON_LOCATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERSON_LOCATION` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `LATITUDE` varchar(128) DEFAULT NULL,
  `LONGITUDE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `PERSON_LOCATION$AK1` (`CREATED_DATE`),
  KEY `PLIE$2` (`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=1646391 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PERSON_OFFICE`
--

DROP TABLE IF EXISTS `PERSON_OFFICE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERSON_OFFICE` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person` varchar(20) NOT NULL,
  `office` int(11) NOT NULL,
  `office_time` int(11) NOT NULL,
  `default_office` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1677 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PERSON_OFFICE_MUTASI`
--

DROP TABLE IF EXISTS `PERSON_OFFICE_MUTASI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERSON_OFFICE_MUTASI` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person` varchar(20) NOT NULL,
  `office` int(11) NOT NULL,
  `office_time` int(11) NOT NULL,
  `default_office` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PERSON_SCHOOL`
--

DROP TABLE IF EXISTS `PERSON_SCHOOL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PERSON_SCHOOL` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `GROUP_ID` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PERSON_SCHOOL$AK` (`F_PIN`,`GROUP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PIC`
--

DROP TABLE IF EXISTS `PIC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PIC` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `ID_PIC` int(10) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PLACE`
--

DROP TABLE IF EXISTS `PLACE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PLACE` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `PLACE_ID` varchar(20) NOT NULL,
  `PLACE_NAME` varchar(50) DEFAULT NULL,
  `LATITUDE` varchar(32) NOT NULL,
  `LONGITUDE` varchar(32) NOT NULL,
  `ALTITUDE` varchar(32) NOT NULL,
  `CELL` varchar(16) NOT NULL,
  `QUOTE` varchar(2048) DEFAULT NULL,
  `LAST_UPDATE` datetime NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CREATED_BY` varchar(20) NOT NULL,
  `THUMB_ID` varchar(256) DEFAULT NULL,
  `RADIUS` int(6) DEFAULT '0',
  `CATEGORY_ID` int(2) DEFAULT '0' COMMENT '0 = undefined\n1 = hotel\n2 = hospital\n3 = parking\n4 = school / university\n5 = bus stop\n6 = home\n7 = supermarket\n8 = dam\n9 = lawyer\n10 = mosque\n11 = cycling\n12 = toilets\n13 = taxi\n14 = farm\n15 = airport\n16 = zoo\n17 = yoga\n18 = winehouse\n19 = theater\n20 = restaurant\n21 = wifi\n22 = stadium\n23 = playground\n24 = construction\n25 = karting\n26 = church\n27 = gazstation\n28 = bank\n29 = factory\n30 = library\n31 = gym\n32 = coffee\n33 = beach\n34 = tent\n35 = smokingarea\n36 = cinema\n37 = workoffice\n38 = dentist\n39 = bar\n40 = museum',
  `HOMEPAGE` varchar(256) DEFAULT NULL,
  `IMAGE_ID` varchar(256) DEFAULT NULL,
  `VB_STATUS` int(2) DEFAULT '0',
  `RATE` decimal(2,1) DEFAULT '0.0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PLACE$AK1` (`PLACE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POLIKLINIK`
--

DROP TABLE IF EXISTS `POLIKLINIK`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POLIKLINIK` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PLACE_ID` varchar(45) DEFAULT NULL,
  `NAME` varchar(45) DEFAULT NULL,
  `DOCTOR` varchar(45) DEFAULT NULL,
  `QUEUE_SIZE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IE1` (`PLACE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST`
--

DROP TABLE IF EXISTS `POST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `TITLE` varchar(256) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `TYPE` tinyint(1) NOT NULL DEFAULT '2' COMMENT '0:VOD, 1:NEWS, 2:USER',
  `CREATED_DATE` bigint(20) NOT NULL,
  `PRIVACY` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:PRIVATE, 2:FRIEND, 3:PUBLIC',
  `NU_AUDITION_DATE` bigint(20) DEFAULT NULL,
  `FILE_TYPE` tinyint(1) NOT NULL COMMENT '1:IMAGE, 2:VIDEO, 3:FILE',
  `THUMB_ID` varchar(512) DEFAULT NULL,
  `FILE_ID` varchar(512) DEFAULT NULL,
  `DURATION` varchar(16) DEFAULT '0',
  `TOTAL_COMMENT` int(11) DEFAULT '0',
  `TOTAL_LIKES` int(11) DEFAULT '0',
  `TOTAL_DISLIKES` int(11) DEFAULT '0',
  `LAST_UPDATE` bigint(20) DEFAULT NULL,
  `LAST_EDIT` bigint(20) DEFAULT NULL,
  `EC_DATE` bigint(20) DEFAULT NULL,
  `VIEWER` int(11) DEFAULT '0',
  `SCORE` double NOT NULL DEFAULT '0',
  `LINK` text,
  `MERCHANT` varchar(32) DEFAULT NULL,
  `STORY_NAME` varchar(60) DEFAULT NULL,
  `STORY_DATE` bigint(20) DEFAULT NULL,
  `FILE_SUMMARIZATION` varchar(512) DEFAULT NULL,
  `TARGET` smallint(1) DEFAULT '0',
  `PRICING` smallint(1) DEFAULT '0',
  `PRICING_MONEY` varchar(100) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST$AK1` (`POST_ID`),
  KEY `POST$AK2` (`F_PIN`),
  KEY `POST$AK3` (`LAST_UPDATE`)
) ENGINE=InnoDB AUTO_INCREMENT=7681 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_BKP_260619`
--

DROP TABLE IF EXISTS `POST_BKP_260619`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_BKP_260619` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `TITLE` varchar(256) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `TYPE` tinyint(1) NOT NULL DEFAULT '2' COMMENT '0:VOD, 1:NEWS, 2:USER',
  `CREATED_DATE` bigint(20) DEFAULT NULL,
  `PRIVACY` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:PRIVATE, 2:FRIEND, 3:PUBLIC',
  `NU_AUDITION_DATE` bigint(20) DEFAULT NULL,
  `FILE_TYPE` tinyint(1) NOT NULL COMMENT '1:IMAGE, 2:VIDEO, 3:FILE',
  `THUMB_ID` varchar(512) DEFAULT NULL,
  `FILE_ID` varchar(512) DEFAULT NULL,
  `DURATION` varchar(16) DEFAULT '0',
  `TOTAL_COMMENT` int(11) DEFAULT '0',
  `TOTAL_LIKES` int(11) DEFAULT '0',
  `TOTAL_DISLIKES` int(11) DEFAULT '0',
  `LAST_UPDATE` bigint(20) DEFAULT NULL,
  `LAST_EDIT` bigint(20) DEFAULT NULL,
  `EC_DATE` bigint(20) DEFAULT NULL,
  `VIEWER` int(11) DEFAULT '0',
  `SCORE` double NOT NULL DEFAULT '0',
  `LINK` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST$AK1` (`POST_ID`),
  KEY `POST$AK2` (`F_PIN`),
  KEY `POST$AK3` (`LAST_UPDATE`)
) ENGINE=InnoDB AUTO_INCREMENT=1642 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_BKP_NEWS_BOT`
--

DROP TABLE IF EXISTS `POST_BKP_NEWS_BOT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_BKP_NEWS_BOT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `TITLE` varchar(256) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `TYPE` tinyint(1) NOT NULL DEFAULT '2' COMMENT '0:VOD, 1:NEWS, 2:USER',
  `CREATED_DATE` bigint(20) NOT NULL,
  `PRIVACY` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:PRIVATE, 2:FRIEND, 3:PUBLIC',
  `NU_AUDITION_DATE` bigint(20) DEFAULT NULL,
  `FILE_TYPE` tinyint(1) NOT NULL COMMENT '1:IMAGE, 2:VIDEO, 3:FILE',
  `THUMB_ID` varchar(512) DEFAULT NULL,
  `FILE_ID` varchar(512) DEFAULT NULL,
  `DURATION` varchar(16) DEFAULT '0',
  `TOTAL_COMMENT` int(11) DEFAULT '0',
  `TOTAL_LIKES` int(11) DEFAULT '0',
  `TOTAL_DISLIKES` int(11) DEFAULT '0',
  `LAST_UPDATE` bigint(20) DEFAULT NULL,
  `LAST_EDIT` bigint(20) DEFAULT NULL,
  `EC_DATE` bigint(20) DEFAULT NULL,
  `VIEWER` int(11) DEFAULT '0',
  `SCORE` double NOT NULL DEFAULT '0',
  `LINK` text,
  `MERCHANT` varchar(32) DEFAULT NULL,
  `STORY_NAME` varchar(60) DEFAULT NULL,
  `STORY_DATE` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST$AK1` (`POST_ID`),
  KEY `POST$AK2` (`F_PIN`),
  KEY `POST$AK3` (`LAST_UPDATE`)
) ENGINE=InnoDB AUTO_INCREMENT=827 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_COMMENT`
--

DROP TABLE IF EXISTS `POST_COMMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_COMMENT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMMENT_ID` varchar(40) NOT NULL,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `COMMENT` text NOT NULL,
  `CREATED_DATE` bigint(20) DEFAULT NULL,
  `REF_COMMENT_ID` varchar(40) DEFAULT NULL,
  `LAC_ID` varchar(32) DEFAULT NULL COMMENT 'LAC ID',
  `CELL_ID` varchar(32) DEFAULT NULL COMMENT 'Cell ID',
  `MCC_ID` varchar(32) DEFAULT NULL COMMENT 'MCC ID',
  `MNC_ID` varchar(32) DEFAULT NULL COMMENT 'MNC ID',
  `PCI_ID` varchar(32) DEFAULT NULL COMMENT 'PCI ID',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST_COMMENT$UK1` (`COMMENT_ID`),
  KEY `POST_COMMENT$AK1` (`POST_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=817 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_EXTENDED`
--

DROP TABLE IF EXISTS `POST_EXTENDED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_EXTENDED` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `CATEGORY_ID` smallint(4) DEFAULT NULL,
  `ADDRESS` varchar(256) DEFAULT NULL,
  `LEVEL_EDUCATION` smallint(1) DEFAULT '-1',
  `MATERI_EDUCATION` smallint(1) DEFAULT '-1',
  `FINALTEST_EDUCATION` smallint(1) DEFAULT '-1',
  PRIMARY KEY (`ID`),
  KEY `POST_EXTENDED$AK1` (`POST_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3072 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_INTERACTION_SCORE`
--

DROP TABLE IF EXISTS `POST_INTERACTION_SCORE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_INTERACTION_SCORE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `SCORE_VIEW_MINE` double NOT NULL DEFAULT '0',
  `SCORE_VIEW_OTHERS` double NOT NULL DEFAULT '0',
  `SCORE_COMMENT_MINE` double NOT NULL DEFAULT '0',
  `SCORE_COMMENT_OTHERS` double NOT NULL DEFAULT '0',
  `SCORE_LIKE_MINE` double NOT NULL DEFAULT '0',
  `SCORE_LIKE_OTHERS` double NOT NULL DEFAULT '0',
  `SCORE_FOLLOW` double NOT NULL DEFAULT '0',
  `SCORE_VIEW_COMBINATION` double NOT NULL DEFAULT '0',
  `SCORE_INTERACTIVE_COMBINATION` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST_INTERACTION_SCORE$UK1` (`POST_ID`,`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=705 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_PARTICIPATE`
--

DROP TABLE IF EXISTS `POST_PARTICIPATE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_PARTICIPATE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `POST_ID_RECRUITER` varchar(40) NOT NULL,
  `PARTICIPATE_DATE` bigint(20) DEFAULT NULL,
  `FORM_REF_ID` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `PP$AK1` (`POST_ID`),
  KEY `PP$AK2` (`POST_ID_RECRUITER`),
  KEY `PP$AK3` (`FORM_REF_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_QUIZ`
--

DROP TABLE IF EXISTS `POST_QUIZ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_QUIZ` (
  `POST_ID` varchar(40) NOT NULL,
  `QUESTION` longtext,
  PRIMARY KEY (`POST_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_QUIZ_GROUP`
--

DROP TABLE IF EXISTS `POST_QUIZ_GROUP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_QUIZ_GROUP` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `GROUP_ID` varchar(255) NOT NULL,
  `TOPIC_ID` varchar(255) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST_TARGET_GROUP$AK` (`POST_ID`,`GROUP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_QUIZ_MEMBER`
--

DROP TABLE IF EXISTS `POST_QUIZ_MEMBER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_QUIZ_MEMBER` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `ANSWER` longtext,
  `ANSWER_DATE` datetime DEFAULT NULL,
  `SCORE` int(11) DEFAULT '0',
  `SCORE_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST_QUIZ_MEMBER$AK` (`POST_ID`,`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_RATING`
--

DROP TABLE IF EXISTS `POST_RATING`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_RATING` (
  `POST_ID` varchar(60) NOT NULL,
  `POSTING_TIME` bigint(20) DEFAULT NULL,
  `ACCOUNT_TYPE` bigint(20) DEFAULT NULL,
  `FOLLOWER` bigint(20) DEFAULT NULL,
  `LIKES` bigint(20) DEFAULT NULL,
  `COMMENTS` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`POST_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_REACTION`
--

DROP TABLE IF EXISTS `POST_REACTION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_REACTION` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `FLAG` tinyint(1) NOT NULL COMMENT '1:LIKE, -1:DISLIKE, 0:NETRAL',
  `LAST_UPDATE` bigint(20) DEFAULT NULL,
  `LAC_ID` varchar(32) DEFAULT NULL COMMENT 'LAC ID',
  `CELL_ID` varchar(32) DEFAULT NULL COMMENT 'Cell ID',
  `MCC_ID` varchar(32) DEFAULT NULL COMMENT 'MCC ID',
  `MNC_ID` varchar(32) DEFAULT NULL COMMENT 'MNC ID',
  `PCI_ID` varchar(32) DEFAULT NULL COMMENT 'PCI ID',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST_REACTION$UK1` (`POST_ID`,`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=1319 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_REACTION_BACKUP`
--

DROP TABLE IF EXISTS `POST_REACTION_BACKUP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_REACTION_BACKUP` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `FLAG` tinyint(1) NOT NULL COMMENT '1:LIKE, -1:DISLIKE, 0:NETRAL',
  `LAST_UPDATE` bigint(20) DEFAULT NULL,
  `LAC_ID` varchar(32) DEFAULT NULL COMMENT 'LAC ID',
  `CELL_ID` varchar(32) DEFAULT NULL COMMENT 'Cell ID',
  `MCC_ID` varchar(32) DEFAULT NULL COMMENT 'MCC ID',
  `MNC_ID` varchar(32) DEFAULT NULL COMMENT 'MNC ID',
  `PCI_ID` varchar(32) DEFAULT NULL COMMENT 'PCI ID',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST_REACTION$UK1` (`POST_ID`,`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_REPORT`
--

DROP TABLE IF EXISTS `POST_REPORT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_REPORT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(40) NOT NULL,
  `REPORT_DATE` bigint(20) NOT NULL,
  `REASON` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_REQUEST_TUTORIAL`
--

DROP TABLE IF EXISTS `POST_REQUEST_TUTORIAL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_REQUEST_TUTORIAL` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `DELIVERED` smallint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `REQUEST_EDUCATIONAL$AK` (`POST_ID`,`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_SHARED`
--

DROP TABLE IF EXISTS `POST_SHARED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_SHARED` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `SOCMED_FLAG` tinyint(1) NOT NULL COMMENT '1:FB, 2:IG, 3:YT, 4:FB-IG, 5:FB-YT, 6:IG-YT, 7:ALL',
  `SHARED_DATE` bigint(20) DEFAULT NULL,
  `URL` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `PP$AK1` (`POST_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_STORY`
--

DROP TABLE IF EXISTS `POST_STORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_STORY` (
  `STORY_ID` varchar(60) NOT NULL,
  `STORY_NAME` varchar(100) DEFAULT NULL,
  `F_PIN` varchar(60) DEFAULT NULL,
  `POST_ID` text,
  `STORY_DATE` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`STORY_ID`),
  KEY `AK1` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_STORY_BKP_NEWS_BOT_20200626`
--

DROP TABLE IF EXISTS `POST_STORY_BKP_NEWS_BOT_20200626`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_STORY_BKP_NEWS_BOT_20200626` (
  `STORY_ID` varchar(60) NOT NULL,
  `STORY_NAME` varchar(100) DEFAULT NULL,
  `F_PIN` varchar(60) DEFAULT NULL,
  `POST_ID` text,
  `STORY_DATE` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`STORY_ID`),
  KEY `AK1` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_TARGET_GROUP`
--

DROP TABLE IF EXISTS `POST_TARGET_GROUP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_TARGET_GROUP` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `GROUP_ID` varchar(255) NOT NULL,
  `TOPIC_ID` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST_TARGET_GROUP$AK` (`POST_ID`,`GROUP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_TARGET_INVITED`
--

DROP TABLE IF EXISTS `POST_TARGET_INVITED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_TARGET_INVITED` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST_TARGET_INVITED$AK` (`POST_ID`,`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `POST_VIEWER`
--

DROP TABLE IF EXISTS `POST_VIEWER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POST_VIEWER` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST_VIEWER$UK1` (`POST_ID`,`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=9440 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PREFS`
--

DROP TABLE IF EXISTS `PREFS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PREFS` (
  `BE` int(11) DEFAULT NULL,
  `KEY` varchar(30) DEFAULT NULL,
  `VALUE` text,
  UNIQUE KEY `UK1` (`BE`,`KEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PRODUCT`
--

DROP TABLE IF EXISTS `PRODUCT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUCT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(10) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `GROUP_ID` int(11) NOT NULL,
  `ACCOUNT_TYPE` int(11) NOT NULL,
  `PRODUCT_TYPE` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK1` (`CODE`,`ACCOUNT_TYPE`),
  KEY `IE1` (`GROUP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PRODUCT_DENOM`
--

DROP TABLE IF EXISTS `PRODUCT_DENOM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUCT_DENOM` (
  `PRODUCT_ID` int(11) NOT NULL,
  `DENOM` varchar(10) NOT NULL,
  KEY `IE1` (`PRODUCT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PRODUCT_GROUP`
--

DROP TABLE IF EXISTS `PRODUCT_GROUP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUCT_GROUP` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NAME` (`NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PRODUCT_PREFIX`
--

DROP TABLE IF EXISTS `PRODUCT_PREFIX`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUCT_PREFIX` (
  `PREFIX` varchar(10) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  PRIMARY KEY (`PREFIX`),
  KEY `IE1` (`PRODUCT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PROJECT`
--

DROP TABLE IF EXISTS `PROJECT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PROJECT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(45) DEFAULT NULL,
  `CATEGORY` varchar(60) DEFAULT NULL,
  `SC_DATE` datetime DEFAULT NULL,
  `EC_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `PROJECT$UK` (`TITLE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PROJECT_BACKUP`
--

DROP TABLE IF EXISTS `PROJECT_BACKUP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PROJECT_BACKUP` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(45) DEFAULT NULL,
  `CLIENT_ID` varchar(45) DEFAULT NULL,
  `SC_DATE` datetime DEFAULT NULL,
  `EC_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PROJECT_BUDGET`
--

DROP TABLE IF EXISTS `PROJECT_BUDGET`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PROJECT_BUDGET` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECT_ID` int(11) DEFAULT NULL,
  `ACTIVITY_ID` int(11) DEFAULT NULL,
  `TOTAL` decimal(20,0) DEFAULT NULL,
  `REMAINING` decimal(20,0) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PROJECT_BUDGET_DETAIL`
--

DROP TABLE IF EXISTS `PROJECT_BUDGET_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PROJECT_BUDGET_DETAIL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PROJECT_ID` int(11) DEFAULT NULL,
  `ACTIVITY_ID` int(11) DEFAULT NULL,
  `FORM_ID` varchar(45) DEFAULT NULL,
  `TRANS_DATE` datetime DEFAULT NULL,
  `AMOUNT` decimal(20,0) DEFAULT NULL,
  `PIC` varchar(45) DEFAULT NULL,
  `REF_ID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `QUESTION_PROCESS`
--

DROP TABLE IF EXISTS `QUESTION_PROCESS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `QUESTION_PROCESS` (
  `ID` int(11) DEFAULT NULL,
  `LABEL` varchar(30) DEFAULT NULL COMMENT 'label will shown as confirmation',
  `QUESTION` text COMMENT 'text shown as chat message',
  `QUESTION_ENG` text COMMENT 'text shown as chat message ENG',
  `ANSWER_TYPE` varchar(100) DEFAULT NULL COMMENT 'text,number,option',
  `ANSWER_PARAM` text COMMENT 'text=id:hint | number=id:hint | option=id1:opt1,id2:opt2,-',
  UNIQUE KEY `UK1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RACI_TEMPLATE_DTL`
--

DROP TABLE IF EXISTS `RACI_TEMPLATE_DTL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RACI_TEMPLATE_DTL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `HDR` int(11) DEFAULT NULL,
  `ACTIVITY` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RACI_TEMPLATE_HDR`
--

DROP TABLE IF EXISTS `RACI_TEMPLATE_HDR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RACI_TEMPLATE_HDR` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(45) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `REFERRER`
--

DROP TABLE IF EXISTS `REFERRER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REFERRER` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `L_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `STATUS` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `REFERRER$AK1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `REF_USER_20181005`
--

DROP TABLE IF EXISTS `REF_USER_20181005`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REF_USER_20181005` (
  `ORGANIZATION` varchar(128) DEFAULT NULL,
  `FULL_NAME` varchar(128) DEFAULT NULL,
  `NIK` varchar(16) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT NULL,
  `F_PIN` varchar(20) DEFAULT NULL,
  `POSITION` varchar(128) DEFAULT NULL,
  `CITY` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `REKAM_MEDIC`
--

DROP TABLE IF EXISTS `REKAM_MEDIC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REKAM_MEDIC` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `REKAM_MEDIC_ID` varchar(40) NOT NULL,
  `SUBMIT_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `F_PIN` varchar(20) NOT NULL,
  `FILE_ID` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `REKAM_MEDIC$K` (`REKAM_MEDIC_ID`),
  KEY `REKAM_MEDIC$K2` (`F_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `REQUEST_EDUCATIONAL`
--

DROP TABLE IF EXISTS `REQUEST_EDUCATIONAL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REQUEST_EDUCATIONAL` (
  `ID` varchar(64) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `NO_KTP` varchar(128) NOT NULL,
  `NAMA_KTP` varchar(128) NOT NULL,
  `MSISDN_KTP` varchar(24) NOT NULL,
  `GROUP_ID` varchar(32) DEFAULT NULL COMMENT 'School Group ID',
  `GROUP_NAME` varchar(255) DEFAULT NULL COMMENT 'School Group Name',
  `STATUS` int(1) DEFAULT '0',
  `APPROVED_BY` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `REQUEST_EDUCATIONAL$AK` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `REQUEST_HANDYCRAFT`
--

DROP TABLE IF EXISTS `REQUEST_HANDYCRAFT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REQUEST_HANDYCRAFT` (
  `ID` varchar(64) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `NO_KTP` varchar(128) NOT NULL,
  `NAMA_KTP` varchar(128) NOT NULL,
  `MSISDN_KTP` varchar(24) NOT NULL,
  `STATUS` int(1) DEFAULT '0',
  `APPROVED_BY` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `REQUEST_HANDYCRAFT$AK` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `REQUEST_MEDIC`
--

DROP TABLE IF EXISTS `REQUEST_MEDIC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REQUEST_MEDIC` (
  `ID` varchar(64) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `NO_KTP` varchar(128) NOT NULL,
  `NAMA_KTP` varchar(128) NOT NULL,
  `MSISDN_KTP` varchar(24) NOT NULL,
  `STATUS` int(1) DEFAULT '0',
  `APPROVED_BY` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `REQUEST_MEDIC$AK` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `REQUEST_VERIFIED_ACCOUNT`
--

DROP TABLE IF EXISTS `REQUEST_VERIFIED_ACCOUNT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REQUEST_VERIFIED_ACCOUNT` (
  `ID` varchar(64) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `NO_KTP` varchar(128) NOT NULL,
  `NAMA_KTP` varchar(128) NOT NULL,
  `MSISDN_KTP` varchar(24) NOT NULL,
  `STATUS` int(1) DEFAULT '0',
  `APPROVED_BY` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `REQUEST_MEDIC$AK` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RESTAURANT_IMAGE`
--

DROP TABLE IF EXISTS `RESTAURANT_IMAGE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RESTAURANT_IMAGE` (
  `ID_IMAGE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_RESTAURANT` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FILENAME_IMAGE` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `STATUS_IMAGE` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_IMAGE`),
  KEY `ID_RESTAURANT` (`ID_RESTAURANT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RESTAURANT_LIST`
--

DROP TABLE IF EXISTS `RESTAURANT_LIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RESTAURANT_LIST` (
  `ID_RESTAURANT` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `NAME_RESTAURANT` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `LATITUDE_RESTAURANT` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `LONGITUDE_RESTAURANT` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `TYPE_RESTAURANT` int(11) NOT NULL,
  `REGISTERDATE_RESTAURANT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PHONE_RESTAURANT` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `VERIFIED` int(11) NOT NULL DEFAULT '0',
  `STATE` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PROVINCE` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_RESTAURANT`),
  KEY `TYPE_RESTAURANT` (`TYPE_RESTAURANT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RESTAURANT_MENU`
--

DROP TABLE IF EXISTS `RESTAURANT_MENU`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RESTAURANT_MENU` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_RESTAURANT` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `id_restaurant` (`ID_RESTAURANT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RESTAURANT_TYPE`
--

DROP TABLE IF EXISTS `RESTAURANT_TYPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RESTAURANT_TYPE` (
  `ID_TYPE` int(11) NOT NULL AUTO_INCREMENT,
  `NAME_TYPE` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_TYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RETROW`
--

DROP TABLE IF EXISTS `RETROW`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RETROW` (
  `ID` int(11) NOT NULL,
  `SYNTAX` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `REVIEW`
--

DROP TABLE IF EXISTS `REVIEW`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REVIEW` (
  `ID_REVIEW` int(255) NOT NULL AUTO_INCREMENT,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_RESTAURANT` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `REVIEW` text COLLATE utf8_unicode_ci NOT NULL,
  `RATING` double NOT NULL,
  `REVIEW_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_REVIEW`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `REVIEW_MENU`
--

DROP TABLE IF EXISTS `REVIEW_MENU`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REVIEW_MENU` (
  `ID_REVIEW` int(255) NOT NULL AUTO_INCREMENT,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_MENU` int(255) DEFAULT NULL,
  `REVIEW` text COLLATE utf8_unicode_ci NOT NULL,
  `RATING` double NOT NULL,
  `REVIEW_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_REVIEW`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ROOM`
--

DROP TABLE IF EXISTS `ROOM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ROOM` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `ROOM_ID` varchar(32) NOT NULL,
  `TITLE` varchar(512) NOT NULL,
  `SCOPE_ID` int(2) NOT NULL,
  `THUMB_ID` varchar(128) DEFAULT NULL,
  `QUOTE` text,
  `L_PIN` varchar(14) NOT NULL,
  `F_USER_ID` varchar(20) NOT NULL,
  `CREATED_BY` varchar(14) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `PASSWORD` varchar(48) DEFAULT NULL,
  `STATUS` int(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ROOM$AK1` (`ROOM_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RS_LIST`
--

DROP TABLE IF EXISTS `RS_LIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RS_LIST` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `SORDER` int(11) DEFAULT NULL COMMENT 'urutan',
  `F_PIN` varchar(45) DEFAULT NULL COMMENT 'USER_LIST.F_PIN',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RS_REMOTE_WHITELIST`
--

DROP TABLE IF EXISTS `RS_REMOTE_WHITELIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RS_REMOTE_WHITELIST` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `RS_PIN` varchar(45) DEFAULT NULL COMMENT 'USER_LIST.F_PIN RS',
  `F_PIN` varchar(45) DEFAULT NULL COMMENT 'USER_LIST.F_PIN B#',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SCHOOLS`
--

DROP TABLE IF EXISTS `SCHOOLS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SCHOOLS` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `GROUP_KEY` varchar(100) NOT NULL,
  `GROUP_ID` varchar(32) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `SCHOOLS$AK` (`GROUP_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SCHOOL_RELATION`
--

DROP TABLE IF EXISTS `SCHOOL_RELATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SCHOOL_RELATION` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `SCHOOL_ID` varchar(32) NOT NULL COMMENT 'School Group ID',
  `POMG_ID` varchar(32) NOT NULL COMMENT 'POMG Group ID on School Group ID',
  `TEMP_ID` varchar(32) NOT NULL COMMENT 'Member Unregistered Group ID on School Group',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `SCHOOL_RELATION$AK` (`SCHOOL_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SCORE_POST`
--

DROP TABLE IF EXISTS `SCORE_POST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SCORE_POST` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `POST_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `TYPE` tinyint(1) NOT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `SCORE` int(11) DEFAULT '0',
  `NOTE` varchar(128) DEFAULT '',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `SCORE_POST$UK1` (`POST_ID`,`F_PIN`,`TYPE`),
  KEY `SCORE_POST$IDX1` (`POST_ID`,`F_PIN`),
  KEY `SCORE_POST$IDX2` (`POST_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5961 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SELF_MEMBER_REGISTRATION`
--

DROP TABLE IF EXISTS `SELF_MEMBER_REGISTRATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SELF_MEMBER_REGISTRATION` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CREATED_DATE` datetime DEFAULT NULL,
  `GROUP_ID` varchar(30) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `FIRST_NAME` varchar(24) DEFAULT NULL,
  `LAST_NAME` varchar(24) DEFAULT NULL,
  `NIK` varchar(24) NOT NULL,
  `MSISDN` varchar(20) NOT NULL,
  `EMAIL` varchar(128) NOT NULL,
  `AC` varchar(11) NOT NULL,
  `OFFICE` varchar(11) DEFAULT NULL,
  `OFFICE_TIME` varchar(11) DEFAULT NULL,
  `IMEI` varchar(48) DEFAULT NULL,
  `REF_ID` varchar(30) DEFAULT NULL,
  `LAST_UPDATE` datetime DEFAULT NULL,
  `FLAG` int(11) DEFAULT NULL COMMENT '0:Rejected, 1:Approved',
  `APPROVED_BY` varchar(20) DEFAULT NULL,
  `DATA` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SEQ_TABLE`
--

DROP TABLE IF EXISTS `SEQ_TABLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SEQ_TABLE` (
  `ID` smallint(6) NOT NULL DEFAULT '0',
  `CODE` varchar(64) NOT NULL COMMENT 'nama table',
  `LST_ID` decimal(40,0) DEFAULT NULL,
  `TTL_REC` decimal(40,0) DEFAULT NULL,
  `MAX_ID` decimal(40,0) DEFAULT NULL,
  `STATUS` int(1) DEFAULT NULL,
  `APP_ID` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `SEQ_TABLE$AK` (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SERVER_NOTIFICATION`
--

DROP TABLE IF EXISTS `SERVER_NOTIFICATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SERVER_NOTIFICATION` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `KEY` varchar(2) NOT NULL,
  `VALUE` varchar(64) DEFAULT NULL,
  `MESSAGE_TEXT` varchar(1024) NOT NULL,
  `STATUS` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `STATUS` (`STATUS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SHARED_DISCUSSION_FORUM`
--

DROP TABLE IF EXISTS `SHARED_DISCUSSION_FORUM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SHARED_DISCUSSION_FORUM` (
  `CHAT_ID` varchar(32) NOT NULL COMMENT 'DISCUSSION_FORUM.CHAT_ID owner',
  `GROUP_ID` varchar(32) NOT NULL COMMENT 'GROUPS.GROUP_ID shared',
  UNIQUE KEY `CHAT_ID` (`CHAT_ID`,`GROUP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SHOP`
--

DROP TABLE IF EXISTS `SHOP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SHOP` (
  `ID` int(11) NOT NULL,
  `CODE` varchar(36) NOT NULL,
  `NAME` varchar(128) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `AK` (`CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SHOP_TRANS`
--

DROP TABLE IF EXISTS `SHOP_TRANS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SHOP_TRANS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(32) DEFAULT NULL,
  `SHOP_CODE` varchar(32) DEFAULT NULL,
  `TRANS_NAME` varchar(40) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SHOP_TRANS_DETAIL`
--

DROP TABLE IF EXISTS `SHOP_TRANS_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SHOP_TRANS_DETAIL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SHOP_TRANS` int(11) DEFAULT NULL COMMENT 'refer to SHOP_TRANS.ID',
  `STOCK_CODE` int(11) DEFAULT NULL COMMENT 'refer to STOCK.CODE',
  `QTY` int(11) DEFAULT NULL,
  `PRICE` decimal(15,0) DEFAULT '0',
  `DISCOUNT` decimal(15,0) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `IE1` (`SHOP_TRANS`),
  KEY `IE2` (`STOCK_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SIGNUP_TOKEN`
--

DROP TABLE IF EXISTS `SIGNUP_TOKEN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SIGNUP_TOKEN` (
  `TOKEN` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SIUP`
--

DROP TABLE IF EXISTS `SIUP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SIUP` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ID_RESTAURANT` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_restaurant` (`ID_RESTAURANT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `STATUS_COVID`
--

DROP TABLE IF EXISTS `STATUS_COVID`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STATUS_COVID` (
  `CAPTURE_DATE` date NOT NULL,
  `TOTAL_KASUS` varchar(128) DEFAULT '0',
  `KASUS_BARU_PER_HARI` varchar(45) DEFAULT '0',
  `SEMBUH` varchar(45) DEFAULT '0',
  `DIRAWAT` varchar(45) DEFAULT '0',
  `MENINGGAL` varchar(45) DEFAULT '0',
  PRIMARY KEY (`CAPTURE_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `STICKER`
--

DROP TABLE IF EXISTS `STICKER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STICKER` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `STICKER_ID` varchar(45) NOT NULL,
  `IMAGE_ID` varchar(256) DEFAULT NULL,
  `FORMAT` varchar(5) DEFAULT NULL,
  `CREATED_BY` varchar(45) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `STICKER_SET_ID` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `IMAGE$AK1` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `STICKER_SET`
--

DROP TABLE IF EXISTS `STICKER_SET`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STICKER_SET` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `STICKER_SET_ID` varchar(45) NOT NULL,
  `NAME` varchar(45) NOT NULL,
  `TEXT_PREVIEW` varchar(255) DEFAULT 'Hello world! now you can use my catcUp expression in your chat',
  `PRICE` varchar(8) DEFAULT '0',
  `CREATED_BY` varchar(45) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `THUMB_ID` text,
  `PREVIEW_ID` text,
  `DOWNLOADS` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `STOCK`
--

DROP TABLE IF EXISTS `STOCK`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STOCK` (
  `ID` int(11) NOT NULL,
  `CODE` varchar(36) NOT NULL,
  `SHOP` varchar(36) NOT NULL,
  `NAME` varchar(36) NOT NULL,
  `PRICE` decimal(15,3) NOT NULL,
  `QUANTITY` int(11) NOT NULL DEFAULT '0',
  `STOCKcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `AK` (`CODE`,`SHOP`),
  KEY `FK` (`SHOP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `STORY`
--

DROP TABLE IF EXISTS `STORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STORY` (
  `F_PIN` varchar(60) DEFAULT NULL,
  `LAST_UPDATE` bigint(20) DEFAULT NULL,
  UNIQUE KEY `SUK1` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `STUDENT_REGISTER_CLASS`
--

DROP TABLE IF EXISTS `STUDENT_REGISTER_CLASS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `STUDENT_REGISTER_CLASS` (
  `ID` varchar(64) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `PARENT_F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `NIM` varchar(128) DEFAULT '0',
  `STUDENT_NAME` varchar(128) NOT NULL,
  `STUDENT_EMAIL` varchar(128) DEFAULT '0',
  `SCHOOL_ID` varchar(32) NOT NULL,
  `CLASS_ID` varchar(32) NOT NULL,
  `STATUS` int(1) DEFAULT '0',
  `APPROVED_BY` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `STUDENT_REGISTER_CLASS$AK` (`F_PIN`,`CLASS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SUB_ACCOUNT`
--

DROP TABLE IF EXISTS `SUB_ACCOUNT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SUB_ACCOUNT` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(40) NOT NULL,
  `L_PIN` varchar(40) NOT NULL,
  `ACCESS` text NOT NULL,
  `SOCIAL_ACCESS` text,
  `MEDICAL_ACCESS` text,
  `HANDYCRAFT_ACCESS` text,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `LAST_UPDATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `POST_TARGET_GROUP$AK` (`F_PIN`,`L_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SUB_ACTIVITY`
--

DROP TABLE IF EXISTS `SUB_ACTIVITY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SUB_ACTIVITY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` int(11) DEFAULT NULL,
  `ACTIVITY` varchar(256) DEFAULT NULL,
  `SUB_ACTIVITY` varchar(256) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `STATUS` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SUB_ACTIVITY_20181016`
--

DROP TABLE IF EXISTS `SUB_ACTIVITY_20181016`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SUB_ACTIVITY_20181016` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` int(11) DEFAULT NULL,
  `ACTIVITY` varchar(256) DEFAULT NULL,
  `SUB_ACTIVITY` varchar(256) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `STATUS` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SUB_ACTIVITY_DUMMY`
--

DROP TABLE IF EXISTS `SUB_ACTIVITY_DUMMY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SUB_ACTIVITY_DUMMY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` int(11) DEFAULT NULL,
  `ACTIVITY` varchar(45) DEFAULT NULL,
  `SUB_ACTIVITY` varchar(45) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `STATUS` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SUB_ACTIVITY_OB`
--

DROP TABLE IF EXISTS `SUB_ACTIVITY_OB`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SUB_ACTIVITY_OB` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE` int(11) DEFAULT NULL,
  `ACTIVITY` varchar(256) DEFAULT NULL,
  `SUB_ACTIVITY` varchar(256) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `STATUS` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SURVEY_COVID`
--

DROP TABLE IF EXISTS `SURVEY_COVID`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SURVEY_COVID` (
  `ID` bigint(32) NOT NULL,
  `SUBMIT_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `F_PIN` varchar(20) NOT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `SCORE` double NOT NULL DEFAULT '0',
  `FLAG` int(6) DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `SURVEY_COVID$K` (`F_PIN`),
  KEY `SURVEY_COVID$AK2` (`FLAG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SURVEY_COVID_DETAIL`
--

DROP TABLE IF EXISTS `SURVEY_COVID_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SURVEY_COVID_DETAIL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SURVEY_COVID` bigint(32) NOT NULL,
  `KEY` varchar(32) DEFAULT NULL,
  `VALUE` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `SURVEY_COVID_DETAIL$K` (`SURVEY_COVID`)
) ENGINE=InnoDB AUTO_INCREMENT=20435 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SURVEY_COVID_SCORE`
--

DROP TABLE IF EXISTS `SURVEY_COVID_SCORE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SURVEY_COVID_SCORE` (
  `KEY` varchar(32) NOT NULL,
  `VALUE` int(11) NOT NULL,
  `SCORE` double DEFAULT NULL,
  PRIMARY KEY (`KEY`,`VALUE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SURVEY_RESULT`
--

DROP TABLE IF EXISTS `SURVEY_RESULT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SURVEY_RESULT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LAST_UPDATE` double DEFAULT NULL,
  `TPS_ID` varchar(45) NOT NULL,
  `VOTE_01` int(11) NOT NULL,
  `VOTE_02` int(11) NOT NULL,
  `VOTE_INVALID` int(11) NOT NULL,
  `VOTERS_TOTAL` int(11) NOT NULL,
  `VOTERS_QTY` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `SURVEY_RESULT$AK` (`TPS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SURVEY_SUBMIT`
--

DROP TABLE IF EXISTS `SURVEY_SUBMIT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SURVEY_SUBMIT` (
  `TRX_ID` varchar(45) NOT NULL,
  `TPS_ID` varchar(45) NOT NULL,
  `SURVEY_TIME` double DEFAULT NULL,
  `VOTE_01` int(11) NOT NULL,
  `VOTE_02` int(11) NOT NULL,
  `VOTE_INVALID` int(11) NOT NULL,
  `VOTERS_TOTAL` int(11) NOT NULL,
  `VOTERS_QTY` int(11) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CARD_ID` varchar(45) NOT NULL,
  `IMAGES` varchar(512) DEFAULT NULL,
  `VIDEOS` varchar(512) DEFAULT NULL,
  `FILES` varchar(512) DEFAULT NULL,
  `SIGNATURE` varchar(64) DEFAULT NULL,
  `LONGITUDE` decimal(13,10) DEFAULT NULL,
  `LATITUDE` decimal(13,10) DEFAULT NULL,
  PRIMARY KEY (`TRX_ID`),
  KEY `SURVEY_RESULT$TPS` (`TPS_ID`),
  KEY `SURVEY_RESULT$F_PIN` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SURVEY_SUMMARY`
--

DROP TABLE IF EXISTS `SURVEY_SUMMARY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SURVEY_SUMMARY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LAST_UPDATE` double DEFAULT NULL,
  `GOV_TERRITORY` varchar(6) NOT NULL,
  `AREA_CODE` varchar(6) NOT NULL,
  `VOTE_01` int(11) NOT NULL,
  `VOTE_02` int(11) NOT NULL,
  `VOTE_INVALID` int(11) NOT NULL,
  `VOTERS_TOTAL` int(11) NOT NULL,
  `VOTERS_QTY` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `SURVEY_SUMMARY$GOV_TERRITORY` (`GOV_TERRITORY`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SVIDEO`
--

DROP TABLE IF EXISTS `SVIDEO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SVIDEO` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SVIDEO_ID` varchar(48) NOT NULL,
  `TITLE` varchar(512) DEFAULT NULL,
  `FORMAT` varchar(10) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `CREATED_BY` varchar(20) NOT NULL,
  `STATUS` int(1) DEFAULT '0',
  `DESCRIPTION_1` varchar(512) DEFAULT NULL,
  `CATEGORY_ID` int(3) NOT NULL DEFAULT '0',
  `N_VIEWS` int(11) DEFAULT '0',
  `IMAGE_ID` varchar(48) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  UNIQUE KEY `SVIDEO_ID_UNIQUE` (`SVIDEO_ID`),
  KEY `VIDEO_SHARE$AK` (`SVIDEO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=koi8r;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SVIDEO_CATEGORY`
--

DROP TABLE IF EXISTS `SVIDEO_CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SVIDEO_CATEGORY` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `CATEGORY_ID` int(3) NOT NULL,
  `NAME` varchar(48) DEFAULT NULL,
  `DESCRIPTION_1` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CATEGORY_ID_UNIQUE` (`CATEGORY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TEACHER_REGISTER_CLASS`
--

DROP TABLE IF EXISTS `TEACHER_REGISTER_CLASS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TEACHER_REGISTER_CLASS` (
  `ID` varchar(64) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  `NIK` varchar(128) DEFAULT '0',
  `REAL_NAME` varchar(128) NOT NULL,
  `EMAIL` varchar(128) DEFAULT '0',
  `SCHOOL_ID` varchar(32) NOT NULL,
  `STAGE_LEVEL` varchar(5) NOT NULL,
  `STAGE_NAME` varchar(128) NOT NULL,
  `MAJOR_NAME` varchar(128) DEFAULT NULL,
  `CLASS_TYPE` varchar(5) NOT NULL,
  `CLASS_NAME` varchar(128) NOT NULL,
  `STATUS` int(1) DEFAULT '0',
  `APPROVED_BY` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TEST`
--

DROP TABLE IF EXISTS `TEST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TEST` (
  `ID` int(10) DEFAULT NULL,
  `nama` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TESTTT`
--

DROP TABLE IF EXISTS `TESTTT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TESTTT` (
  `F_PIN` varchar(20) NOT NULL,
  `PASSWORD` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TICKER`
--

DROP TABLE IF EXISTS `TICKER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TICKER` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TICKER_ID` varchar(48) NOT NULL,
  `TYPE` int(1) DEFAULT '0' COMMENT '0: NEWS, 1:ADVERTISEMENT\n',
  `TITLE` varchar(128) NOT NULL,
  `BODY` text NOT NULL,
  `IMAGE_ID` varchar(48) DEFAULT NULL,
  `PLACE_ID` varchar(48) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TOOLS_SCHEDULER`
--

DROP TABLE IF EXISTS `TOOLS_SCHEDULER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TOOLS_SCHEDULER` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRIPTION` varchar(64) DEFAULT NULL,
  `TYPE` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Just Execute, 2:Dump File, 3:Send Mail, 4:Send SMS',
  `STATUS` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0:Not-Active, 1=Active',
  `DB_URL` varchar(64) DEFAULT NULL,
  `DB_USER` varchar(32) DEFAULT NULL,
  `DB_PASSWORD` varchar(32) DEFAULT NULL,
  `QUERY` varchar(4096) DEFAULT NULL,
  `HOUR` varchar(16) NOT NULL DEFAULT '*',
  `DOM` varchar(16) NOT NULL DEFAULT '*',
  `MONTH` varchar(16) NOT NULL DEFAULT '*',
  `WD` varchar(16) NOT NULL DEFAULT '*',
  `PATH_DUMP_FILE` varchar(128) DEFAULT NULL,
  `FILENAME` varchar(128) DEFAULT NULL,
  `SEPARATOR` varchar(3) NOT NULL DEFAULT ',' COMMENT 'Separator antar field pada setiap line',
  `EMAIL_RECIPIENT` varchar(512) NOT NULL DEFAULT 'rio.f@easysoft.co.id',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TPS`
--

DROP TABLE IF EXISTS `TPS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TPS` (
  `TPS_ID` varchar(45) NOT NULL,
  `NAME` varchar(32) NOT NULL,
  `GOV_TERRITORY` varchar(45) NOT NULL,
  `LONGITUDE` decimal(13,10) DEFAULT NULL,
  `LATITUDE` decimal(13,10) DEFAULT NULL,
  PRIMARY KEY (`TPS_ID`),
  KEY `TPS$IX1` (`GOV_TERRITORY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TPS_PILPRES`
--

DROP TABLE IF EXISTS `TPS_PILPRES`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TPS_PILPRES` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(32) NOT NULL,
  `LATITUDE` decimal(13,10) NOT NULL,
  `LONGITUDE` decimal(13,10) NOT NULL,
  `KELURAHAN` varchar(45) NOT NULL COMMENT 'Kelurahan',
  `SUB_DISTRICT` varchar(45) NOT NULL COMMENT 'Kecamatan / Desa',
  `DISTRICT` varchar(45) NOT NULL COMMENT 'Kota / Kabupaten',
  `PROVINCE` varchar(45) NOT NULL COMMENT 'Provinsi',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TPS_PILPRES$AK` (`LATITUDE`,`LONGITUDE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TPS_SAMPLE`
--

DROP TABLE IF EXISTS `TPS_SAMPLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TPS_SAMPLE` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `TPS_ID` varchar(16) DEFAULT NULL,
  `NAME` varchar(32) NOT NULL,
  `LATITUDE` decimal(13,10) NOT NULL,
  `LONGITUDE` decimal(13,10) NOT NULL,
  `KELURAHAN` varchar(45) NOT NULL COMMENT 'Kelurahan',
  `SUB_DISTRICT` varchar(45) NOT NULL COMMENT 'Kecamatan / Desa',
  `DISTRICT` varchar(45) NOT NULL COMMENT 'Kota / Kabupaten',
  `PROVINCE` varchar(45) NOT NULL COMMENT 'Provinsi',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TPS_PILPRES$AK` (`LATITUDE`,`LONGITUDE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TRANSACTION`
--

DROP TABLE IF EXISTS `TRANSACTION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TRANSACTION` (
  `ID_TRANS` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_RESTAURANT` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `BOOKING_CODE` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `BOOK_DATE` date DEFAULT NULL,
  `BOOK_TIME` time DEFAULT NULL,
  `GUEST_COUNT` int(11) DEFAULT NULL,
  `TRANS_CREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CONFIRM_TIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_PIC` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `STATUS` tinyint(4) NOT NULL DEFAULT '1',
  `FLAG` int(11) NOT NULL DEFAULT '1',
  `TOTAL_PAYMENT` int(255) NOT NULL,
  `PAYMENT_METHOD` int(11) NOT NULL,
  PRIMARY KEY (`ID_TRANS`),
  KEY `ID_USER` (`ID_USER`),
  KEY `ID_RESTAURANT` (`ID_RESTAURANT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TRANSACTION_DETAIL`
--

DROP TABLE IF EXISTS `TRANSACTION_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TRANSACTION_DETAIL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TRANSACTION` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ID_MENU` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `QTY` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TRANS_DETAIL`
--

DROP TABLE IF EXISTS `TRANS_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TRANS_DETAIL` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TRANS_ID` varchar(32) NOT NULL,
  `PRODUCT_ID` varchar(32) DEFAULT NULL,
  `PRODUCT_NAME` varchar(512) DEFAULT NULL,
  `QTY` int(11) DEFAULT NULL,
  `PRICE` decimal(15,0) DEFAULT NULL,
  `DISCOUNT` decimal(15,0) DEFAULT NULL,
  `SUB_TOTAL` decimal(15,0) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDX$TRANS_ID` (`TRANS_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TRANS_HEADER`
--

DROP TABLE IF EXISTS `TRANS_HEADER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TRANS_HEADER` (
  `TRANS_ID` varchar(32) NOT NULL,
  `DATE` date DEFAULT NULL,
  `DATETIME` double DEFAULT NULL,
  `POS_ID` varchar(20) DEFAULT NULL,
  `F_PIN` varchar(20) DEFAULT NULL,
  `TOTAL` decimal(15,0) DEFAULT NULL,
  `STATUS` int(1) DEFAULT '0',
  PRIMARY KEY (`TRANS_ID`),
  KEY `IDX$DATE` (`DATE`),
  KEY `IDX$POS_ID` (`POS_ID`),
  KEY `IDX$F_PIN` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TRX`
--

DROP TABLE IF EXISTS `TRX`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TRX` (
  `F_PIN` varchar(60) DEFAULT NULL,
  `TID` varchar(60) DEFAULT NULL,
  `DATE` datetime DEFAULT NULL,
  `POST_ID` varchar(60) DEFAULT NULL,
  `DATA` text,
  `PRICE` double(20,0) DEFAULT NULL,
  `DELIVERY` double(20,2) DEFAULT NULL,
  `TOTAL` double(20,0) DEFAULT NULL,
  `STATUS` int(11) DEFAULT '0',
  `L_PIN` varchar(60) DEFAULT NULL,
  UNIQUE KEY `UK` (`TID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `UNIQUE_ACTIVITY_HISTORY_210920`
--

DROP TABLE IF EXISTS `UNIQUE_ACTIVITY_HISTORY_210920`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UNIQUE_ACTIVITY_HISTORY_210920` (
  `who1` varchar(64) NOT NULL COMMENT 'Refer to table USER_LIST'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `UNIQ_CODE`
--

DROP TABLE IF EXISTS `UNIQ_CODE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UNIQ_CODE` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(45) DEFAULT NULL,
  `CATEGORY` varchar(45) DEFAULT NULL,
  `ACTIVITY` varchar(45) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `UK` (`BE`,`CODE`,`ACTIVITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_ACCESS_HISTORY`
--

DROP TABLE IF EXISTS `USER_ACCESS_HISTORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_ACCESS_HISTORY` (
  `ID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `LAST_ACCESS_DATE` date DEFAULT NULL,
  `LAST_ACCESS_TIME` datetime DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `LAST_ACCESS_DATE` (`LAST_ACCESS_DATE`),
  KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_ACHIEVEMENT`
--

DROP TABLE IF EXISTS `USER_ACHIEVEMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_ACHIEVEMENT` (
  `f_pin` varchar(20) DEFAULT NULL,
  `achievement_id` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_APPS_SCHEME`
--

DROP TABLE IF EXISTS `USER_APPS_SCHEME`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_APPS_SCHEME` (
  `APP_ID` int(6) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `SC_DATE` datetime NOT NULL,
  `EC_DATE` datetime NOT NULL,
  PRIMARY KEY (`APP_ID`,`F_PIN`,`EC_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_BACKUP_20180710`
--

DROP TABLE IF EXISTS `USER_BACKUP_20180710`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_BACKUP_20180710` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `UPLINE_PIN` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(128) NOT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `IMAGE` varchar(256) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT '0',
  `QUOTE` varchar(512) DEFAULT NULL COMMENT 'user status',
  `CONNECTED` int(1) DEFAULT '0' COMMENT '0:NOT CONNECT, 1:CONNECT\n',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `ALTITUDE` varchar(45) DEFAULT NULL,
  `CELL` varchar(24) DEFAULT NULL,
  `LAST_LOC_UPDATE` datetime DEFAULT NULL,
  `EMPTY_1` varchar(1) DEFAULT NULL,
  `IMEI` varchar(32) DEFAULT NULL,
  `TIMEZONE` varchar(45) DEFAULT NULL,
  `PRIVACY_FLAG` varchar(16) DEFAULT NULL,
  `MSISDN` varchar(24) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT '0',
  `CREATED_DATE` datetime NOT NULL,
  `OFFLINE_MODE` int(1) DEFAULT '0',
  `NETWORK_TYPE` int(1) DEFAULT '0',
  `SERVER_ID` char(2) DEFAULT NULL,
  `LAST_CON_UPDATE` datetime DEFAULT NULL,
  `EXT_TEXT_1` text,
  `IS_DEACTIVATED` tinyint(4) NOT NULL DEFAULT '0',
  `EC_DATE` bigint(20) DEFAULT NULL,
  `SHOP` varchar(36) DEFAULT NULL,
  `POS_FLAG` char(1) DEFAULT '0',
  `CONNECTION_FLAG` int(1) DEFAULT '0',
  `EXTENSION` int(11) DEFAULT NULL,
  `LAC` varchar(45) DEFAULT NULL,
  `CI` varchar(45) DEFAULT NULL,
  `LAST_LOC_NAME` varchar(225) DEFAULT NULL,
  `ROOT_BE` int(11) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  `AC` int(11) DEFAULT NULL,
  `INIT_STATE` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST$AK` (`F_PIN`),
  UNIQUE KEY `USER_LIST$AK2` (`USER_ID`),
  UNIQUE KEY `USER_LIST$AK3` (`BE`,`EMAIL`),
  UNIQUE KEY `USER_LIST$AK4` (`BE`,`MSISDN`),
  KEY `USER_LIST$IE` (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_DEACTIVED`
--

DROP TABLE IF EXISTS `USER_DEACTIVED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_DEACTIVED` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `UPLINE_PIN` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(128) NOT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `IMAGE` varchar(256) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT '0',
  `QUOTE` varchar(512) DEFAULT NULL COMMENT 'user status',
  `CONNECTED` int(1) DEFAULT '0' COMMENT '0:NOT CONNECT, 1:CONNECT\n',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `ALTITUDE` varchar(45) DEFAULT NULL,
  `CELL` varchar(24) DEFAULT NULL,
  `LAST_LOC_UPDATE` datetime DEFAULT NULL,
  `EMPTY_1` varchar(1) DEFAULT NULL,
  `IMEI` varchar(32) DEFAULT NULL,
  `TIMEZONE` varchar(45) DEFAULT NULL,
  `PRIVACY_FLAG` varchar(16) DEFAULT NULL,
  `MSISDN` varchar(24) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT '0',
  `CREATED_DATE` datetime NOT NULL,
  `OFFLINE_MODE` int(1) DEFAULT '0',
  `NETWORK_TYPE` int(1) DEFAULT '0',
  `SERVER_ID` char(2) DEFAULT NULL,
  `LAST_CON_UPDATE` datetime DEFAULT NULL,
  `EXT_TEXT_1` text,
  `IS_DEACTIVATED` tinyint(4) NOT NULL DEFAULT '0',
  `EC_DATE` bigint(20) DEFAULT NULL,
  `SHOP` varchar(36) DEFAULT NULL,
  `POS_FLAG` char(1) DEFAULT '0',
  `CONNECTION_FLAG` int(1) DEFAULT '0',
  `EXTENSION` int(11) DEFAULT NULL,
  `LAC` varchar(45) DEFAULT NULL,
  `CI` varchar(45) DEFAULT NULL,
  `LAST_LOC_NAME` varchar(225) DEFAULT NULL,
  `ROOT_BE` int(11) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  `AC` int(11) DEFAULT NULL,
  `INIT_STATE` int(1) DEFAULT NULL,
  `REAL_IMEI` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST$AK` (`F_PIN`),
  UNIQUE KEY `USER_LIST$AK2` (`USER_ID`),
  UNIQUE KEY `USER_LIST$AK3` (`BE`,`EMAIL`),
  UNIQUE KEY `USER_LIST$AK4` (`BE`,`MSISDN`),
  KEY `USER_LIST$IE` (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_DELETED`
--

DROP TABLE IF EXISTS `USER_DELETED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_DELETED` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `UPLINE_PIN` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(24) NOT NULL,
  `LAST_NAME` varchar(24) DEFAULT NULL,
  `IMAGE` varchar(256) DEFAULT NULL,
  `USER_ID` varchar(32) DEFAULT '0',
  `QUOTE` varchar(512) DEFAULT NULL COMMENT 'user status',
  `CONNECTED` int(1) DEFAULT '0' COMMENT '0:NOT CONNECT, 1:CONNECT\n',
  `LAST_UPDATE` datetime NOT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `ALTITUDE` varchar(45) DEFAULT NULL,
  `CELL` varchar(24) DEFAULT NULL,
  `LAST_LOC_UPDATE` datetime DEFAULT NULL,
  `EMPTY_1` varchar(1) DEFAULT NULL,
  `IMEI` varchar(32) DEFAULT NULL,
  `TIMEZONE` varchar(45) DEFAULT NULL,
  `PRIVACY_FLAG` varchar(16) DEFAULT NULL,
  `MSISDN` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `OFFLINE_MODE` int(1) DEFAULT '0',
  `NETWORK_TYPE` int(1) DEFAULT '0',
  `SERVER_ID` char(2) DEFAULT NULL,
  `LAST_CON_UPDATE` datetime DEFAULT NULL,
  `EXT_TEXT_1` text,
  `IS_DEACTIVATED` tinyint(4) NOT NULL DEFAULT '0',
  `EC_DATE` bigint(20) DEFAULT NULL,
  `SHOP` varchar(36) DEFAULT NULL,
  `POS_FLAG` char(1) DEFAULT '0',
  `CONNECTION_FLAG` int(1) DEFAULT '0',
  `EXTENSION` int(11) DEFAULT NULL,
  `LAC` varchar(45) DEFAULT NULL,
  `CI` varchar(45) DEFAULT NULL,
  `LAST_LOC_NAME` varchar(225) DEFAULT NULL,
  `ROOT_BE` int(11) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  `AC` int(11) DEFAULT NULL,
  `INIT_STATE` int(1) DEFAULT NULL,
  `CARD_TYPE` int(1) DEFAULT '0',
  `CARD_ID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST$AK` (`F_PIN`),
  UNIQUE KEY `USER_LIST$AK4` (`BE`,`MSISDN`),
  UNIQUE KEY `USER_LIST$AK2` (`USER_ID`),
  KEY `USER_LIST$IE` (`EMAIL`)
) ENGINE=InnoDB AUTO_INCREMENT=382 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_LIST`
--

DROP TABLE IF EXISTS `USER_LIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_LIST` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `UPLINE_PIN` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(128) NOT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `IMAGE` varchar(256) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT '0',
  `QUOTE` varchar(512) DEFAULT NULL COMMENT 'user status',
  `CONNECTED` int(1) DEFAULT '0' COMMENT '0:NOT CONNECT, 1:CONNECT\n',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `ALTITUDE` varchar(45) DEFAULT NULL,
  `CELL` varchar(24) DEFAULT NULL,
  `LAST_LOC_UPDATE` datetime DEFAULT NULL,
  `EMPTY_1` varchar(1) DEFAULT NULL,
  `IMEI` varchar(48) DEFAULT NULL,
  `TIMEZONE` varchar(45) DEFAULT NULL,
  `PRIVACY_FLAG` varchar(16) DEFAULT NULL,
  `MSISDN` varchar(24) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT '0',
  `CREATED_DATE` datetime NOT NULL,
  `OFFLINE_MODE` int(1) DEFAULT '0',
  `NETWORK_TYPE` int(1) DEFAULT '0',
  `SERVER_ID` char(2) DEFAULT NULL,
  `LAST_CON_UPDATE` datetime DEFAULT NULL,
  `EXT_TEXT_1` text,
  `IS_DEACTIVATED` tinyint(4) NOT NULL DEFAULT '0',
  `EC_DATE` bigint(20) DEFAULT NULL,
  `SHOP` varchar(36) DEFAULT NULL,
  `POS_FLAG` char(1) DEFAULT '0',
  `CONNECTION_FLAG` int(1) DEFAULT '0',
  `EXTENSION` int(11) DEFAULT NULL,
  `LAC` varchar(45) DEFAULT NULL,
  `CI` varchar(45) DEFAULT NULL,
  `LAST_LOC_NAME` varchar(225) DEFAULT NULL,
  `ROOT_BE` int(11) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  `AC` int(11) DEFAULT NULL,
  `INIT_STATE` int(1) DEFAULT NULL,
  `REAL_IMEI` varchar(32) DEFAULT NULL,
  `APP_VERSION` varchar(40) DEFAULT NULL,
  `RESET_FLAG` int(1) DEFAULT '0',
  `FIRST_INIT` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST$AK` (`F_PIN`),
  UNIQUE KEY `USER_LIST$AK2` (`USER_ID`),
  KEY `USER_LIST$IE` (`EMAIL`),
  KEY `U$IE2` (`MSISDN`),
  KEY `USER_LIST$IE3` (`LATITUDE`,`LONGITUDE`),
  KEY `USER_LIST$IE4` (`LONGITUDE`,`LATITUDE`)
) ENGINE=InnoDB AUTO_INCREMENT=16426 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_LIST22042020`
--

DROP TABLE IF EXISTS `USER_LIST22042020`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_LIST22042020` (
  `ID` int(6) NOT NULL DEFAULT '0',
  `F_PIN` varchar(20) NOT NULL,
  `UPLINE_PIN` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(128) NOT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `IMAGE` varchar(256) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT '0',
  `QUOTE` varchar(512) DEFAULT NULL COMMENT 'user status',
  `CONNECTED` int(1) DEFAULT '0' COMMENT '0:NOT CONNECT, 1:CONNECT\n',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `ALTITUDE` varchar(45) DEFAULT NULL,
  `CELL` varchar(24) DEFAULT NULL,
  `LAST_LOC_UPDATE` datetime DEFAULT NULL,
  `EMPTY_1` varchar(1) DEFAULT NULL,
  `IMEI` varchar(48) DEFAULT NULL,
  `TIMEZONE` varchar(45) DEFAULT NULL,
  `PRIVACY_FLAG` varchar(16) DEFAULT NULL,
  `MSISDN` varchar(24) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT '0',
  `CREATED_DATE` datetime NOT NULL,
  `OFFLINE_MODE` int(1) DEFAULT '0',
  `NETWORK_TYPE` int(1) DEFAULT '0',
  `SERVER_ID` char(2) DEFAULT NULL,
  `LAST_CON_UPDATE` datetime DEFAULT NULL,
  `EXT_TEXT_1` text,
  `IS_DEACTIVATED` tinyint(4) NOT NULL DEFAULT '0',
  `EC_DATE` bigint(20) DEFAULT NULL,
  `SHOP` varchar(36) DEFAULT NULL,
  `POS_FLAG` char(1) DEFAULT '0',
  `CONNECTION_FLAG` int(1) DEFAULT '0',
  `EXTENSION` int(11) DEFAULT NULL,
  `LAC` varchar(45) DEFAULT NULL,
  `CI` varchar(45) DEFAULT NULL,
  `LAST_LOC_NAME` varchar(225) DEFAULT NULL,
  `ROOT_BE` int(11) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  `AC` int(11) DEFAULT NULL,
  `INIT_STATE` int(1) DEFAULT NULL,
  `REAL_IMEI` varchar(32) DEFAULT NULL,
  `APP_VERSION` varchar(40) DEFAULT NULL,
  `RESET_FLAG` int(1) DEFAULT '0',
  `FIRST_INIT` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_LIST_20190404_BAK`
--

DROP TABLE IF EXISTS `USER_LIST_20190404_BAK`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_LIST_20190404_BAK` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `UPLINE_PIN` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(128) NOT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `IMAGE` varchar(256) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT '0',
  `QUOTE` varchar(512) DEFAULT NULL COMMENT 'user status',
  `CONNECTED` int(1) DEFAULT '0' COMMENT '0:NOT CONNECT, 1:CONNECT\n',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `ALTITUDE` varchar(45) DEFAULT NULL,
  `CELL` varchar(24) DEFAULT NULL,
  `LAST_LOC_UPDATE` datetime DEFAULT NULL,
  `EMPTY_1` varchar(1) DEFAULT NULL,
  `IMEI` varchar(48) DEFAULT NULL,
  `TIMEZONE` varchar(45) DEFAULT NULL,
  `PRIVACY_FLAG` varchar(16) DEFAULT NULL,
  `MSISDN` varchar(24) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT '0',
  `CREATED_DATE` datetime NOT NULL,
  `OFFLINE_MODE` int(1) DEFAULT '0',
  `NETWORK_TYPE` int(1) DEFAULT '0',
  `SERVER_ID` char(2) DEFAULT NULL,
  `LAST_CON_UPDATE` datetime DEFAULT NULL,
  `EXT_TEXT_1` text,
  `IS_DEACTIVATED` tinyint(4) NOT NULL DEFAULT '0',
  `EC_DATE` bigint(20) DEFAULT NULL,
  `SHOP` varchar(36) DEFAULT NULL,
  `POS_FLAG` char(1) DEFAULT '0',
  `CONNECTION_FLAG` int(1) DEFAULT '0',
  `EXTENSION` int(11) DEFAULT NULL,
  `LAC` varchar(45) DEFAULT NULL,
  `CI` varchar(45) DEFAULT NULL,
  `LAST_LOC_NAME` varchar(225) DEFAULT NULL,
  `ROOT_BE` int(11) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  `AC` int(11) DEFAULT NULL,
  `INIT_STATE` int(1) DEFAULT NULL,
  `REAL_IMEI` varchar(32) DEFAULT NULL,
  `APP_VERSION` varchar(40) DEFAULT NULL,
  `RESET_FLAG` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST$AK` (`F_PIN`),
  UNIQUE KEY `USER_LIST$AK2` (`USER_ID`),
  UNIQUE KEY `USER_LIST$AK3` (`BE`,`EMAIL`),
  UNIQUE KEY `USER_LIST$AK4` (`BE`,`MSISDN`),
  KEY `USER_LIST$IE` (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_LIST_BKP_260619`
--

DROP TABLE IF EXISTS `USER_LIST_BKP_260619`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_LIST_BKP_260619` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `UPLINE_PIN` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(128) NOT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `IMAGE` varchar(256) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT '0',
  `QUOTE` varchar(512) DEFAULT NULL COMMENT 'user status',
  `CONNECTED` int(1) DEFAULT '0' COMMENT '0:NOT CONNECT, 1:CONNECT\n',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `ALTITUDE` varchar(45) DEFAULT NULL,
  `CELL` varchar(24) DEFAULT NULL,
  `LAST_LOC_UPDATE` datetime DEFAULT NULL,
  `EMPTY_1` varchar(1) DEFAULT NULL,
  `IMEI` varchar(48) DEFAULT NULL,
  `TIMEZONE` varchar(45) DEFAULT NULL,
  `PRIVACY_FLAG` varchar(16) DEFAULT NULL,
  `MSISDN` varchar(24) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT '0',
  `CREATED_DATE` datetime NOT NULL,
  `OFFLINE_MODE` int(1) DEFAULT '0',
  `NETWORK_TYPE` int(1) DEFAULT '0',
  `SERVER_ID` char(2) DEFAULT NULL,
  `LAST_CON_UPDATE` datetime DEFAULT NULL,
  `EXT_TEXT_1` text,
  `IS_DEACTIVATED` tinyint(4) NOT NULL DEFAULT '0',
  `EC_DATE` bigint(20) DEFAULT NULL,
  `SHOP` varchar(36) DEFAULT NULL,
  `POS_FLAG` char(1) DEFAULT '0',
  `CONNECTION_FLAG` int(1) DEFAULT '0',
  `EXTENSION` int(11) DEFAULT NULL,
  `LAC` varchar(45) DEFAULT NULL,
  `CI` varchar(45) DEFAULT NULL,
  `LAST_LOC_NAME` varchar(225) DEFAULT NULL,
  `ROOT_BE` int(11) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  `AC` int(11) DEFAULT NULL,
  `INIT_STATE` int(1) DEFAULT NULL,
  `REAL_IMEI` varchar(32) DEFAULT NULL,
  `APP_VERSION` varchar(40) DEFAULT NULL,
  `RESET_FLAG` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST$AK` (`F_PIN`),
  UNIQUE KEY `USER_LIST$AK2` (`USER_ID`),
  UNIQUE KEY `USER_LIST$AK3` (`BE`,`EMAIL`),
  UNIQUE KEY `USER_LIST$AK4` (`BE`,`MSISDN`),
  KEY `USER_LIST$IE` (`EMAIL`)
) ENGINE=InnoDB AUTO_INCREMENT=10765 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_LIST_DUMMY`
--

DROP TABLE IF EXISTS `USER_LIST_DUMMY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_LIST_DUMMY` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `UPLINE_PIN` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(128) NOT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `IMAGE` varchar(256) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT '0',
  `QUOTE` varchar(512) DEFAULT NULL COMMENT 'user status',
  `CONNECTED` int(1) DEFAULT '0' COMMENT '0:NOT CONNECT, 1:CONNECT\n',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `ALTITUDE` varchar(45) DEFAULT NULL,
  `CELL` varchar(24) DEFAULT NULL,
  `LAST_LOC_UPDATE` datetime DEFAULT NULL,
  `EMPTY_1` varchar(1) DEFAULT NULL,
  `IMEI` varchar(32) DEFAULT NULL,
  `TIMEZONE` varchar(45) DEFAULT NULL,
  `PRIVACY_FLAG` varchar(16) DEFAULT NULL,
  `MSISDN` varchar(24) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT '0',
  `CREATED_DATE` datetime NOT NULL,
  `OFFLINE_MODE` int(1) DEFAULT '0',
  `NETWORK_TYPE` int(1) DEFAULT '0',
  `SERVER_ID` char(2) DEFAULT NULL,
  `LAST_CON_UPDATE` datetime DEFAULT NULL,
  `EXT_TEXT_1` text,
  `IS_DEACTIVATED` tinyint(4) NOT NULL DEFAULT '0',
  `EC_DATE` bigint(20) DEFAULT NULL,
  `SHOP` varchar(36) DEFAULT NULL,
  `POS_FLAG` char(1) DEFAULT NULL,
  `CONNECTION_FLAG` int(1) DEFAULT '0',
  `EXTENSION` int(11) DEFAULT NULL,
  `LAC` varchar(45) DEFAULT NULL,
  `CI` varchar(45) DEFAULT NULL,
  `LAST_LOC_NAME` varchar(225) DEFAULT NULL,
  `ROOT_BE` int(11) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  `AC` int(11) DEFAULT NULL,
  `INIT_STATE` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST$AK` (`F_PIN`),
  UNIQUE KEY `USER_LIST$AK2` (`USER_ID`),
  UNIQUE KEY `USER_LIST$AK3` (`BE`,`EMAIL`),
  UNIQUE KEY `USER_LIST$AK4` (`BE`,`MSISDN`),
  KEY `USER_LIST$IE` (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_LIST_EXTENDED`
--

DROP TABLE IF EXISTS `USER_LIST_EXTENDED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_LIST_EXTENDED` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `TITLE` varchar(24) DEFAULT NULL,
  `GENDER` int(1) DEFAULT '0',
  `ADDRESS` varchar(256) DEFAULT NULL,
  `BIRTHDATE` datetime DEFAULT NULL,
  `TYPE_ADS` int(1) DEFAULT '0',
  `TYPE_LP` int(1) DEFAULT '0',
  `TYPE_POST` int(1) DEFAULT '0',
  `CREATED_DATE` datetime DEFAULT NULL,
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LOGIN_TYPE` int(1) DEFAULT '0' COMMENT 'Tipe Login 0:Login MSISDN, 1:Gmail, 2:FB',
  `BIDANG_INDUSTRI` varchar(128) DEFAULT NULL,
  `VISI` text,
  `MISI` text,
  `COMPANY_LAT` decimal(10,8) DEFAULT NULL,
  `COMPANY_LNG` decimal(11,8) DEFAULT NULL,
  `WEB` varchar(64) DEFAULT NULL,
  `CERTIFICATE_IMAGE` varchar(256) NOT NULL DEFAULT '',
  `IMEI` varchar(60) DEFAULT NULL,
  `IMSI` varchar(60) DEFAULT NULL,
  `OFFICIAL_ACCOUNT` int(1) DEFAULT '0',
  `PASSWORD` varchar(64) DEFAULT NULL,
  `CARD_TYPE` int(11) NOT NULL DEFAULT '1',
  `CARD_ID` varchar(128) NOT NULL DEFAULT '0',
  `IS_SUPER_ADMIN` int(11) DEFAULT '0',
  `IS_SUSPENDED` int(11) DEFAULT '0',
  `IS_VIRTUAL` int(11) DEFAULT '0',
  `USER_TYPE` int(11) DEFAULT '0',
  `REAL_NAME` varchar(100) DEFAULT NULL,
  `IS_SUB_ACCOUNT` smallint(1) DEFAULT '0',
  `LAST_SIGN` varchar(100) DEFAULT NULL,
  `ANDROID_ID` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST$AK` (`F_PIN`),
  KEY `$AK1` (`IMEI`),
  KEY `$AK2` (`IMSI`)
) ENGINE=InnoDB AUTO_INCREMENT=5876 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_LIST_EXTENDED_20200428`
--

DROP TABLE IF EXISTS `USER_LIST_EXTENDED_20200428`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_LIST_EXTENDED_20200428` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `TITLE` varchar(24) DEFAULT NULL,
  `GENDER` int(1) DEFAULT '0',
  `ADDRESS` varchar(256) DEFAULT NULL,
  `BIRTHDATE` datetime DEFAULT NULL,
  `TYPE_ADS` int(1) DEFAULT '0',
  `TYPE_LP` int(1) DEFAULT '0',
  `TYPE_POST` int(1) DEFAULT '0',
  `CREATED_DATE` datetime DEFAULT NULL,
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LOGIN_TYPE` int(1) DEFAULT '0' COMMENT 'Tipe Login 0:Login MSISDN, 1:Gmail, 2:FB',
  `BIDANG_INDUSTRI` varchar(128) DEFAULT NULL,
  `VISI` text,
  `MISI` text,
  `COMPANY_LAT` decimal(10,8) DEFAULT NULL,
  `COMPANY_LNG` decimal(11,8) DEFAULT NULL,
  `WEB` varchar(64) DEFAULT NULL,
  `CERTIFICATE_IMAGE` varchar(256) NOT NULL DEFAULT '',
  `IMEI` varchar(60) DEFAULT NULL,
  `IMSI` varchar(60) DEFAULT NULL,
  `OFFICIAL_ACCOUNT` int(1) DEFAULT '0',
  `PASSWORD` varchar(64) DEFAULT NULL,
  `CARD_TYPE` int(11) NOT NULL DEFAULT '1',
  `CARD_ID` varchar(128) NOT NULL DEFAULT '0',
  `IS_SUPER_ADMIN` int(11) DEFAULT '0',
  `IS_SUSPENDED` int(11) DEFAULT '0',
  `IS_VIRTUAL` int(11) DEFAULT '0',
  `USER_TYPE` int(11) DEFAULT '0',
  `REAL_NAME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST$AK` (`F_PIN`),
  KEY `$AK1` (`IMEI`),
  KEY `$AK2` (`IMSI`)
) ENGINE=InnoDB AUTO_INCREMENT=356 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_LIST_EXTENDED_TMP`
--

DROP TABLE IF EXISTS `USER_LIST_EXTENDED_TMP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_LIST_EXTENDED_TMP` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `TITLE` varchar(24) DEFAULT NULL,
  `GENDER` int(1) DEFAULT '0',
  `ADDRESS` varchar(256) DEFAULT NULL,
  `BIRTHDATE` datetime DEFAULT NULL,
  `TYPE_ADS` int(1) DEFAULT '0',
  `TYPE_LP` int(1) DEFAULT '0',
  `TYPE_POST` int(1) DEFAULT '0',
  `CREATED_DATE` datetime DEFAULT NULL,
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LOGIN_TYPE` int(1) DEFAULT '0' COMMENT 'Tipe Login 0:Login MSISDN, 1:Gmail, 2:FB',
  `BIDANG_INDUSTRI` varchar(128) DEFAULT NULL,
  `VISI` text,
  `MISI` text,
  `COMPANY_LAT` decimal(10,8) DEFAULT NULL,
  `COMPANY_LNG` decimal(11,8) DEFAULT NULL,
  `WEB` varchar(64) DEFAULT NULL,
  `CERTIFICATE_IMAGE` varchar(256) NOT NULL DEFAULT '',
  `IMEI` varchar(60) DEFAULT NULL,
  `IMSI` varchar(60) DEFAULT NULL,
  `OFFICIAL_ACCOUNT` int(1) DEFAULT '0',
  `PASSWORD` varchar(64) DEFAULT NULL,
  `CARD_TYPE` int(11) NOT NULL DEFAULT '1',
  `CARD_ID` varchar(128) NOT NULL DEFAULT '0',
  `IS_SUPER_ADMIN` int(11) DEFAULT '0',
  `IS_SUSPENDED` int(11) DEFAULT '0',
  `IS_VIRTUAL` int(11) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST$AK` (`F_PIN`),
  KEY `$AK1` (`IMEI`),
  KEY `$AK2` (`IMSI`)
) ENGINE=InnoDB AUTO_INCREMENT=3515 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_LIST_MUTASI`
--

DROP TABLE IF EXISTS `USER_LIST_MUTASI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_LIST_MUTASI` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `UPLINE_PIN` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(128) NOT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `IMAGE` varchar(256) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT '0',
  `QUOTE` varchar(512) DEFAULT NULL COMMENT 'user status',
  `CONNECTED` int(1) DEFAULT '0' COMMENT '0:NOT CONNECT, 1:CONNECT\n',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `ALTITUDE` varchar(45) DEFAULT NULL,
  `CELL` varchar(24) DEFAULT NULL,
  `LAST_LOC_UPDATE` datetime DEFAULT NULL,
  `EMPTY_1` varchar(1) DEFAULT NULL,
  `IMEI` varchar(48) DEFAULT NULL,
  `TIMEZONE` varchar(45) DEFAULT NULL,
  `PRIVACY_FLAG` varchar(16) DEFAULT NULL,
  `MSISDN` varchar(24) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT '0',
  `CREATED_DATE` datetime NOT NULL,
  `OFFLINE_MODE` int(1) DEFAULT '0',
  `NETWORK_TYPE` int(1) DEFAULT '0',
  `SERVER_ID` char(2) DEFAULT NULL,
  `LAST_CON_UPDATE` datetime DEFAULT NULL,
  `EXT_TEXT_1` text,
  `IS_DEACTIVATED` tinyint(4) NOT NULL DEFAULT '0',
  `EC_DATE` bigint(20) DEFAULT NULL,
  `SHOP` varchar(36) DEFAULT NULL,
  `POS_FLAG` char(1) DEFAULT '0',
  `CONNECTION_FLAG` int(1) DEFAULT '0',
  `EXTENSION` int(11) DEFAULT NULL,
  `LAC` varchar(45) DEFAULT NULL,
  `CI` varchar(45) DEFAULT NULL,
  `LAST_LOC_NAME` varchar(225) DEFAULT NULL,
  `ROOT_BE` int(11) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  `AC` int(11) DEFAULT NULL,
  `INIT_STATE` int(1) DEFAULT NULL,
  `REAL_IMEI` varchar(32) DEFAULT NULL,
  `APP_VERSION` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST$AK` (`F_PIN`),
  UNIQUE KEY `USER_LIST$AK2` (`USER_ID`),
  UNIQUE KEY `USER_LIST$AK3` (`BE`,`EMAIL`),
  UNIQUE KEY `USER_LIST$AK4` (`BE`,`MSISDN`),
  KEY `USER_LIST$IE` (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_LIST_TMP`
--

DROP TABLE IF EXISTS `USER_LIST_TMP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_LIST_TMP` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `UPLINE_PIN` varchar(20) DEFAULT NULL,
  `FIRST_NAME` varchar(128) NOT NULL,
  `LAST_NAME` varchar(128) DEFAULT NULL,
  `IMAGE` varchar(256) DEFAULT NULL,
  `USER_ID` varchar(24) DEFAULT '0',
  `QUOTE` varchar(512) DEFAULT NULL COMMENT 'user status',
  `CONNECTED` int(1) DEFAULT '0' COMMENT '0:NOT CONNECT, 1:CONNECT\n',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `LATITUDE` varchar(45) DEFAULT NULL,
  `LONGITUDE` varchar(45) DEFAULT NULL,
  `ALTITUDE` varchar(45) DEFAULT NULL,
  `CELL` varchar(24) DEFAULT NULL,
  `LAST_LOC_UPDATE` datetime DEFAULT NULL,
  `EMPTY_1` varchar(1) DEFAULT NULL,
  `IMEI` varchar(48) DEFAULT NULL,
  `TIMEZONE` varchar(45) DEFAULT NULL,
  `PRIVACY_FLAG` varchar(16) DEFAULT NULL,
  `MSISDN` varchar(24) DEFAULT NULL,
  `EMAIL` varchar(128) DEFAULT '0',
  `CREATED_DATE` datetime NOT NULL,
  `OFFLINE_MODE` int(1) DEFAULT '0',
  `NETWORK_TYPE` int(1) DEFAULT '0',
  `SERVER_ID` char(2) DEFAULT NULL,
  `LAST_CON_UPDATE` datetime DEFAULT NULL,
  `EXT_TEXT_1` text,
  `IS_DEACTIVATED` tinyint(4) NOT NULL DEFAULT '0',
  `EC_DATE` bigint(20) DEFAULT NULL,
  `SHOP` varchar(36) DEFAULT NULL,
  `POS_FLAG` char(1) DEFAULT '0',
  `CONNECTION_FLAG` int(1) DEFAULT '0',
  `EXTENSION` int(11) DEFAULT NULL,
  `LAC` varchar(45) DEFAULT NULL,
  `CI` varchar(45) DEFAULT NULL,
  `LAST_LOC_NAME` varchar(225) DEFAULT NULL,
  `ROOT_BE` int(11) DEFAULT NULL,
  `BE` int(11) DEFAULT NULL,
  `AC` int(11) DEFAULT NULL,
  `INIT_STATE` int(1) DEFAULT NULL,
  `REAL_IMEI` varchar(32) DEFAULT NULL,
  `APP_VERSION` varchar(40) DEFAULT NULL,
  `RESET_FLAG` int(1) DEFAULT '0',
  `FIRST_INIT` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER_LIST_TMP$AK` (`F_PIN`),
  UNIQUE KEY `USER_LIST_TMP$AK2` (`USER_ID`),
  KEY `USER_LIST_TMP$IE` (`EMAIL`),
  KEY `U$IE2` (`MSISDN`)
) ENGINE=InnoDB AUTO_INCREMENT=13571 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_TOKEN`
--

DROP TABLE IF EXISTS `USER_TOKEN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_TOKEN` (
  `F_PIN` varchar(20) NOT NULL,
  `TOKEN` text,
  `CALL_TOKEN` text,
  PRIMARY KEY (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_WALLET`
--

DROP TABLE IF EXISTS `USER_WALLET`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_WALLET` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` varchar(24) NOT NULL,
  `ACCOUNT_TYPE` int(11) NOT NULL,
  `ACCOUNT_ID` varchar(28) DEFAULT NULL,
  `PASSWORD` varchar(24) NOT NULL,
  `SC_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EC_DATE` datetime NOT NULL DEFAULT '9999-12-31 23:59:59',
  `PARAM1` varchar(24) DEFAULT NULL,
  `PARAM2` varchar(24) DEFAULT NULL,
  `PARAM3` varchar(24) DEFAULT NULL,
  `PARAM4` varchar(24) DEFAULT NULL,
  `PARAM5` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IE1` (`USER_ID`),
  KEY `IE2` (`ACCOUNT_TYPE`,`ACCOUNT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VB_STATUS`
--

DROP TABLE IF EXISTS `VB_STATUS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VB_STATUS` (
  `ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `PLACE_ID` varchar(20) DEFAULT NULL,
  `DATE_START` date DEFAULT NULL,
  `DATE_END` date DEFAULT NULL,
  `TIME` int(2) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PLACE_ID_2` (`PLACE_ID`,`DATE_START`,`DATE_END`,`TIME`),
  KEY `PLACE_ID` (`PLACE_ID`,`TIME`),
  KEY `DATE_START` (`DATE_START`,`DATE_END`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VC_ROOM`
--

DROP TABLE IF EXISTS `VC_ROOM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VC_ROOM` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `VC_ROOM_ID` varchar(120) NOT NULL,
  `DATA` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `VC_ROOM$AK` (`F_PIN`,`VC_ROOM_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VGT`
--

DROP TABLE IF EXISTS `VGT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VGT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VGT_ID` varchar(40) NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  `TITLE` varchar(256) NOT NULL,
  `BODY` text NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `THUMB_ID` varchar(512) DEFAULT NULL,
  `CATEGORY_ID` smallint(4) DEFAULT NULL,
  `TAG` varchar(255) DEFAULT '1',
  `VIDEO_ID` varchar(512) DEFAULT NULL,
  `VIDEO_DURATION` varchar(16) DEFAULT '0',
  `N_VIEWS` int(11) DEFAULT '0',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `STATUS` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `VIDEO_GT$AK1` (`VGT_ID`),
  KEY `STATUS` (`STATUS`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VIDEO`
--

DROP TABLE IF EXISTS `VIDEO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VIDEO` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VIDEO_ID` varchar(48) NOT NULL,
  `VIDEO` longblob NOT NULL,
  `PATH` varchar(256) DEFAULT NULL,
  `FORMAT` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `VIDEO$AK1` (`ID`),
  UNIQUE KEY `VIDEO$AK2` (`VIDEO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VOD`
--

DROP TABLE IF EXISTS `VOD`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOD` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VOD_ID` int(48) NOT NULL,
  `TITLE` varchar(256) NOT NULL,
  `BODY` text NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `THUMB_ID` varchar(512) DEFAULT NULL,
  `CATEGORY_ID` smallint(4) DEFAULT NULL,
  `TAG` varchar(255) DEFAULT NULL,
  `VIDEO_ID` varchar(512) DEFAULT NULL,
  `VIDEO_DURATION` varchar(16) DEFAULT '0',
  `N_VIEWS` int(11) DEFAULT '0',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `STATUS` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `VIDEO_OD$AK1` (`VOD_ID`),
  KEY `STATUS` (`STATUS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VOD_DUMMY`
--

DROP TABLE IF EXISTS `VOD_DUMMY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOD_DUMMY` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VOD_ID` int(48) NOT NULL,
  `TITLE` varchar(256) NOT NULL,
  `BODY` text NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `THUMB_ID` varchar(512) DEFAULT NULL,
  `CATEGORY_ID` smallint(4) DEFAULT NULL,
  `TAG` varchar(255) DEFAULT NULL,
  `VIDEO_ID` varchar(512) DEFAULT NULL,
  `VIDEO_DURATION` varchar(16) DEFAULT '0',
  `N_VIEWS` int(11) DEFAULT '0',
  `LAST_UPDATE` datetime DEFAULT NULL,
  `STATUS` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `VIDEO_OD$AK1` (`VOD_ID`),
  KEY `STATUS` (`STATUS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `VOD_MAPPING`
--

DROP TABLE IF EXISTS `VOD_MAPPING`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOD_MAPPING` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `BE_ROOT_ID` int(11) DEFAULT NULL,
  `BE_ID` int(11) DEFAULT NULL,
  `GROUP_ID` varchar(45) DEFAULT NULL,
  `VOD_ID` int(11) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `LAST_UPDATE` datetime DEFAULT NULL,
  `SCHEME_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UK1` (`BE_ROOT_ID`,`BE_ID`,`GROUP_ID`,`VOD_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WALLET_ACCOUNT`
--

DROP TABLE IF EXISTS `WALLET_ACCOUNT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WALLET_ACCOUNT` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WALLET_TYPE` tinyint(4) DEFAULT '1',
  `WALLET_NO` varchar(32) DEFAULT '-',
  `USER_PIN` varchar(20) NOT NULL,
  `BALANCE` decimal(15,3) DEFAULT NULL,
  `SC_DATE` datetime DEFAULT '2017-02-26 17:33:15',
  `EC_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `UX_WALLET_ACCOUNT_WALLET_TYPE_WALLET_NO` (`WALLET_TYPE`,`WALLET_NO`),
  KEY `ID_WALLET_ACCOUNT_USER_ID` (`USER_PIN`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WALLET_MUTATION`
--

DROP TABLE IF EXISTS `WALLET_MUTATION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WALLET_MUTATION` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(32) DEFAULT NULL,
  `BALANCE_BEFORE` decimal(15,0) DEFAULT NULL,
  `AMOUNT` decimal(15,0) DEFAULT NULL,
  `BALANCE_AFTER` decimal(15,0) DEFAULT NULL,
  `TYPE` varchar(40) DEFAULT NULL,
  `DESCRIPTION` varchar(40) DEFAULT NULL,
  `CREATED_DATE` date DEFAULT NULL,
  `CREATED_TIME` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `IE1` (`CREATED_DATE`),
  KEY `IE2` (`F_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WALLET_TYPE`
--

DROP TABLE IF EXISTS `WALLET_TYPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WALLET_TYPE` (
  `ID` tinyint(4) NOT NULL,
  `NAME` varchar(45) NOT NULL,
  `AMOUNT` decimal(15,3) NOT NULL DEFAULT '1.000',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WHITELIST_CS`
--

DROP TABLE IF EXISTS `WHITELIST_CS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WHITELIST_CS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `STATUS` int(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `FRIEND_LIST$AK1` (`F_PIN`,`STATUS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WHITELIST_FORUM`
--

DROP TABLE IF EXISTS `WHITELIST_FORUM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WHITELIST_FORUM` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `F_PIN` varchar(20) NOT NULL,
  `device_id` varchar(48) DEFAULT NULL,
  `CHAT_ID` varchar(32) NOT NULL COMMENT 'DISCUSSION_FORUM.CHAT_ID blacklist',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WIFI_LIST`
--

DROP TABLE IF EXISTS `WIFI_LIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WIFI_LIST` (
  `ID` tinyint(4) NOT NULL AUTO_INCREMENT,
  `OFFICE` int(11) DEFAULT NULL COMMENT 'OFFICE.ID',
  `SSID` varchar(45) DEFAULT NULL COMMENT 'WIFI SSID',
  `MAC_ADDRESS` varchar(45) NOT NULL COMMENT 'WIFI MACC ADDRESS',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WISHLIST`
--

DROP TABLE IF EXISTS `WISHLIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WISHLIST` (
  `ID` varchar(33) NOT NULL,
  `USER_PIN` varchar(20) NOT NULL,
  `CONTENT` varchar(256) NOT NULL,
  `DATE_SUBMITTED` datetime DEFAULT NULL,
  `TYPE` tinyint(4) DEFAULT '99' COMMENT '1 = demand/ 2 = supply/ 99 = unknown',
  `THUMBNAIL` varchar(128) DEFAULT NULL,
  `RATING` float DEFAULT NULL,
  `LOCATION` varchar(128) DEFAULT NULL,
  `LONGITUDE` double DEFAULT NULL,
  `LATITUDE` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `WISHLIST_UNIQUE1_USER_PIN_CONTENT` (`USER_PIN`,`CONTENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WISHLIST_FAILED`
--

DROP TABLE IF EXISTS `WISHLIST_FAILED`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WISHLIST_FAILED` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WISHLIST` varchar(256) NOT NULL,
  `DATETIME` datetime NOT NULL,
  `F_PIN` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `WISHLIST_FAILED_ID1_DATETIME` (`DATETIME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WISHLIST_GOODS`
--

DROP TABLE IF EXISTS `WISHLIST_GOODS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WISHLIST_GOODS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(64) NOT NULL,
  `TOTAL_OCCURRED` int(11) NOT NULL,
  `TYPE` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `WISHLIST_GOODS_id1_name` (`NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WISHLIST_GOODS_QUERY_WORDS2`
--

DROP TABLE IF EXISTS `WISHLIST_GOODS_QUERY_WORDS2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WISHLIST_GOODS_QUERY_WORDS2` (
  `WISHLIST_GOODS_ID` int(11) NOT NULL,
  `PHRASE_NO` tinyint(4) NOT NULL DEFAULT '-1',
  `WORD_INDEX` tinyint(4) NOT NULL DEFAULT '-1',
  `WORD_ID` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`WISHLIST_GOODS_ID`,`PHRASE_NO`,`WORD_INDEX`,`WORD_ID`),
  KEY `WISHLIST_GOODS_QUERY_WORDS_ID1_WISHLIST_GOODS_ID` (`WORD_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WISHLIST_GOODS_RELATIONS`
--

DROP TABLE IF EXISTS `WISHLIST_GOODS_RELATIONS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WISHLIST_GOODS_RELATIONS` (
  `WISHLIST_GOODS_A` int(11) NOT NULL,
  `RELATIONS` tinyint(4) NOT NULL,
  `WISHLIST_GOODS_B` int(11) NOT NULL,
  PRIMARY KEY (`WISHLIST_GOODS_A`,`RELATIONS`,`WISHLIST_GOODS_B`),
  KEY `WISHLIST_GOODS_RELATION_GOODS_B_ID1` (`WISHLIST_GOODS_B`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WISHLIST_GOODS_RELATIONS_TYPE`
--

DROP TABLE IF EXISTS `WISHLIST_GOODS_RELATIONS_TYPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WISHLIST_GOODS_RELATIONS_TYPE` (
  `ID` tinyint(4) NOT NULL,
  `DESC` varchar(256) DEFAULT NULL,
  `IS_DUPLEX` tinyint(4) DEFAULT NULL COMMENT '0 = 1 way/ 1 = 2 way',
  `LEFT_SIDE_DESCRIPTION` varchar(64) DEFAULT 'any object',
  `RIGHT_SIDE_DESCRIPTION` varchar(64) DEFAULT 'any object',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WISHLIST_ITEM`
--

DROP TABLE IF EXISTS `WISHLIST_ITEM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WISHLIST_ITEM` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WISHLIST_ID` varchar(33) NOT NULL,
  `ITEM_NO` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `WISHLIST_ITEM_UK1_WISHLIST_ID_ITEM_NO` (`WISHLIST_ID`,`ITEM_NO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WISHLIST_ITEM_WORDS`
--

DROP TABLE IF EXISTS `WISHLIST_ITEM_WORDS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WISHLIST_ITEM_WORDS` (
  `WISHLIST_ITEM_ID` int(11) NOT NULL,
  `WORD_ID` int(11) NOT NULL,
  `WORD_POSITION` tinyint(4) NOT NULL,
  PRIMARY KEY (`WISHLIST_ITEM_ID`,`WORD_ID`,`WORD_POSITION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WISHLIST_TYPE`
--

DROP TABLE IF EXISTS `WISHLIST_TYPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WISHLIST_TYPE` (
  `ID` tinyint(4) NOT NULL,
  `DESC` varchar(256) NOT NULL,
  `TAG` varchar(3) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WISHLIST_WORDS`
--

DROP TABLE IF EXISTS `WISHLIST_WORDS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WISHLIST_WORDS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WORD` varchar(46) NOT NULL,
  `TOTAL_OCCURRED` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `WISHLIST_WORDS_UK1_WORD` (`WORD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `WORKING_DAYS`
--

DROP TABLE IF EXISTS `WORKING_DAYS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WORKING_DAYS` (
  `ID_WORKDAY` int(11) NOT NULL AUTO_INCREMENT,
  `ID_RESTAURANT` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID_DAY` int(11) NOT NULL,
  `OPEN_HOUR` time NOT NULL,
  `CLOSE_HOUR` time NOT NULL,
  PRIMARY KEY (`ID_WORKDAY`),
  KEY `ID_RESTAURANT` (`ID_RESTAURANT`),
  KEY `ID_DAY` (`ID_DAY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ZZZ_WISHLIST`
--

DROP TABLE IF EXISTS `ZZZ_WISHLIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ZZZ_WISHLIST` (
  `ID` varchar(33) NOT NULL,
  `USER_PIN` varchar(20) NOT NULL,
  `CONTENT` varchar(256) NOT NULL,
  `DATE_SUBMITTED` datetime DEFAULT NULL,
  `TYPE` tinyint(4) DEFAULT '99' COMMENT '0 = demand/ 1 = supply/ 99 = unknown',
  `THUMBNAIL` varchar(128) DEFAULT NULL,
  `RATING` float DEFAULT NULL,
  `LOCATION` varchar(128) DEFAULT NULL,
  `LONGITUDE` double DEFAULT NULL,
  `LATITUDE` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `WISHLIST_UNIQUE1_USER_PIN_CONTENT` (`USER_PIN`,`CONTENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ZZZ_WISHLIST_GOODS`
--

DROP TABLE IF EXISTS `ZZZ_WISHLIST_GOODS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ZZZ_WISHLIST_GOODS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(64) NOT NULL,
  `TOTAL_OCCURRED` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `WISHLIST_GOODS_id1_name` (`NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ZZZ_WISHLIST_GOODS_MAPPING`
--

DROP TABLE IF EXISTS `ZZZ_WISHLIST_GOODS_MAPPING`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ZZZ_WISHLIST_GOODS_MAPPING` (
  `WISHLIST_GOODS` int(11) NOT NULL,
  `TYPE` tinyint(4) NOT NULL COMMENT '0 = supply / 1 = demand',
  `WISHLIST_ID` varchar(33) NOT NULL,
  `QTY` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`WISHLIST_GOODS`,`TYPE`,`WISHLIST_ID`),
  KEY `WISHLIST_GOODS_MAPPING_Id1_wishlist_id` (`WISHLIST_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ZZZ_WISHLIST_GOODS_QUERY_WORDS`
--

DROP TABLE IF EXISTS `ZZZ_WISHLIST_GOODS_QUERY_WORDS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ZZZ_WISHLIST_GOODS_QUERY_WORDS` (
  `WISHLIST_GOODS_ID` int(11) NOT NULL,
  `QUERY_WORD` varchar(64) NOT NULL,
  PRIMARY KEY (`QUERY_WORD`,`WISHLIST_GOODS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'ib_01'
--
/*!50003 DROP PROCEDURE IF EXISTS `BUILD_FORM_PIC_DETAIL` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `BUILD_FORM_PIC_DETAIL`(p_ref_id VARCHAR(40), p_data TEXT)
BEGIN
insert ignore into FORM_PIC_DETAIL(FORM_ID, REF_ID, SUBMIT_DATE, SUBMIT_BY)
select
fs.FORM_ID
,fs.REF_ID
, fs.CREATED_DATE SUBMIT_DATE
, fs.F_PIN SUBMIT_BY
from FORM_SUBMIT fs, FORM_SUBMIT_DETAIL fd, FORM f, USER_LIST us
where
fs.ID = fd.FORM_SUBMIT_ID
and fs.REF_ID = p_ref_id
and fs.FORM_ID = f.FORM_ID
and fs.F_PIN   = us.F_PIN
group by fs.REF_ID;END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `BUILD_FORM_PROJECT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `BUILD_FORM_PROJECT`(p_ref_id VARCHAR(40))
BEGIN
insert ignore into FORM_PROJECT(BE, PROJECT, CLIENT, ACTIVITY, SUB_ACTIVITY, REF_ID, TITLE, FORM_ID, INSERT_DATE, INSERT_TIME, LAST_UPDATE, LAST_UPTIME, FORM_NAME, STATUS)
select
us.BE
, GROUP_CONCAT(IF(fd.`KEY`='project', SUBSTRING_INDEX(SUBSTRING_INDEX(fd.VALUE, '"', 4), '"', -1), NULL)) PROJECT
, GROUP_CONCAT(IF(fd.`KEY`='project', SUBSTRING_INDEX(SUBSTRING_INDEX(fd.VALUE, '"', 8), '"', -1), NULL)) CLIENT
, GROUP_CONCAT(IF(fd.`KEY`='project', SUBSTRING_INDEX(SUBSTRING_INDEX(fd.VALUE, '"', 6), '"', -1), NULL)) ACTIVITY
, GROUP_CONCAT(IF(fd.`KEY`='project', SUBSTRING_INDEX(SUBSTRING_INDEX(fd.VALUE, '"', 10), '"', -1), NULL)) SUB_ACTIVITY
, fs.REF_ID
, GROUP_CONCAT(
  IF(fs.FORM_ID in ('123433', '123436', '1234321', '123879') and fd.`KEY`='description'
       , LEFT(REPLACE(REPLACE(REPLACE(fd.VALUE, '/', ' '), '\n', ' '), '"', ''), 45)
  , IF (fs.FORM_ID ='123440' and fd.`KEY`='cpl_id'
       , LEFT(REPLACE(REPLACE(REPLACE(fd.VALUE, '/', ' '), '\n', ' '), '"', ''), 45)
  , IF (fs.FORM_ID ='123439' and fd.`KEY`='note'
       , LEFT(REPLACE(REPLACE(REPLACE(fd.VALUE, '/', ' '), '\n', ' '), '"', ''), 45)
  , IF (fd.`KEY`='title'
       , LEFT(REPLACE(REPLACE(REPLACE(fd.VALUE, '/', ' '), '\n', ' '), '"', ''), 45)
  , NULL))))
) TITLE
, fs.FORM_ID
, DATE(fs.CREATED_DATE) INSERT_DATE
, fs.CREATED_DATE INSERT_TIME
, DATE(fs.CREATED_DATE) LAST_UPDATE
, fs.CREATED_DATE LAST_UPTIME
, f.TITLE FORM_NAME
, IF(fs.APPROVED is NULL, 'Inprogress', 'Complete') STATUS
from FORM_SUBMIT fs, FORM_SUBMIT_DETAIL fd, FORM f, USER_LIST us
where
fs.ID = fd.FORM_SUBMIT_ID
and fs.REF_ID = p_ref_id
and fs.FORM_ID = f.FORM_ID
and fs.F_PIN   = us.F_PIN
group by fs.REF_ID
having PROJECT is NOT NULL;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `BUILD_GROUP_HIERARCHY_7L` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `BUILD_GROUP_HIERARCHY_7L`(v_level tinyint(1), v_be int(11))
BEGIN
delete from  GROUP_HIERARCHY;


INSERT INTO GROUP_HIERARCHY
SELECT 
GROUP_ID,PARENT_ID,'-','0', A.BUSINESS_ENTITY
FROM 
GROUPS A
WHERE 
BUSINESS_ENTITY=v_be AND LEVEL=1;


INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,A.PARENT_ID,B.GROUP_NAME,B.LEVEL, B.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B
WHERE 
A.BUSINESS_ENTITY=v_be AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY AND A.LEVEL=2
and A.PARENT_ID=B.GROUP_ID;
 

INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,B.PARENT_ID,C.GROUP_NAME,C.LEVEL, C.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C
WHERE 
A.BUSINESS_ENTITY=v_be AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY AND A.LEVEL=3
and A.PARENT_ID=B.GROUP_ID
and B.PARENT_ID=C.GROUP_ID;

INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,C.PARENT_ID,D.GROUP_NAME,D.LEVEL, D.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C, GROUPS D
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=4
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=D.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID
and B.PARENT_ID=C.GROUP_ID
and C.PARENT_ID=D.GROUP_ID;

INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,D.PARENT_ID,E.GROUP_NAME,E.LEVEL, E.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C, GROUPS D, GROUPS E
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=5
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=D.BUSINESS_ENTITY
AND E.BUSINESS_ENTITY=D.BUSINESS_ENTITY 
and A.PARENT_ID=B.GROUP_ID 
and B.PARENT_ID=C.GROUP_ID 
and C.PARENT_ID=D.GROUP_ID 
and D.PARENT_ID=E.GROUP_ID;


INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,E.PARENT_ID,F.GROUP_NAME,F.LEVEL, F.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C, GROUPS D, GROUPS E, GROUPS F
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=6
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=D.BUSINESS_ENTITY
AND E.BUSINESS_ENTITY=D.BUSINESS_ENTITY
AND E.BUSINESS_ENTITY=F.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID 
and B.PARENT_ID=C.GROUP_ID 
and C.PARENT_ID=D.GROUP_ID 
and D.PARENT_ID=E.GROUP_ID 
and E.PARENT_ID=F.GROUP_ID;


INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,F.PARENT_ID,G.GROUP_NAME,G.LEVEL, G.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C, GROUPS D, GROUPS E, GROUPS F, GROUPS G
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=7
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=D.BUSINESS_ENTITY
AND E.BUSINESS_ENTITY=D.BUSINESS_ENTITY
AND E.BUSINESS_ENTITY=F.BUSINESS_ENTITY
AND G.BUSINESS_ENTITY=F.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID 
and B.PARENT_ID=C.GROUP_ID 
and C.PARENT_ID=D.GROUP_ID 
and D.PARENT_ID=E.GROUP_ID 
and E.PARENT_ID=F.GROUP_ID
and F.PARENT_ID=G.GROUP_ID;



INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,A.PARENT_ID,B.GROUP_NAME,B.LEVEL, B.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=3
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID;
 

INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,B.PARENT_ID,C.GROUP_NAME,C.LEVEL, C.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=4
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID
and B.PARENT_ID=C.GROUP_ID;

INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,C.PARENT_ID,D.GROUP_NAME,D.LEVEL, D.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C, GROUPS D
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=5
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=D.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID
and B.PARENT_ID=C.GROUP_ID
and C.PARENT_ID=D.GROUP_ID;

INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,D.PARENT_ID,E.GROUP_NAME,E.LEVEL, E.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C, GROUPS D, GROUPS E
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=6
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=D.BUSINESS_ENTITY
AND E.BUSINESS_ENTITY=D.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID 
and B.PARENT_ID=C.GROUP_ID 
and C.PARENT_ID=D.GROUP_ID 
and D.PARENT_ID=E.GROUP_ID;


INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,E.PARENT_ID,F.GROUP_NAME,F.LEVEL, F.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C, GROUPS D, GROUPS E, GROUPS F
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=7
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=D.BUSINESS_ENTITY
AND E.BUSINESS_ENTITY=D.BUSINESS_ENTITY
AND E.BUSINESS_ENTITY=F.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID 
and B.PARENT_ID=C.GROUP_ID 
and C.PARENT_ID=D.GROUP_ID 
and D.PARENT_ID=E.GROUP_ID
and E.PARENT_ID=F.GROUP_ID;
 


INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,A.PARENT_ID,B.GROUP_NAME,B.LEVEL, B.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=4
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID;
 

INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,B.PARENT_ID,C.GROUP_NAME,C.LEVEL, C.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=5
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID
and B.PARENT_ID=C.GROUP_ID;


INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,C.PARENT_ID,D.GROUP_NAME,D.LEVEL, D.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C, GROUPS D
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=6
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=D.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID
and B.PARENT_ID=C.GROUP_ID
and C.PARENT_ID=D.GROUP_ID; 


INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,D.PARENT_ID,E.GROUP_NAME,E.LEVEL, E.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C, GROUPS D, GROUPS E
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=7
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=D.BUSINESS_ENTITY
AND E.BUSINESS_ENTITY=D.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID
and B.PARENT_ID=C.GROUP_ID
and C.PARENT_ID=D.GROUP_ID 
and D.PARENT_ID=E.GROUP_ID; 



INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,A.PARENT_ID,B.GROUP_NAME,B.LEVEL, B.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=5
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID;
 

INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,B.PARENT_ID,C.GROUP_NAME,C.LEVEL, C.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=6
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID
and B.PARENT_ID=C.GROUP_ID;


INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,C.PARENT_ID,D.GROUP_NAME,D.LEVEL,D.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C, GROUPS D
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=7
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=D.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID
and B.PARENT_ID=C.GROUP_ID
and C.PARENT_ID=D.GROUP_ID;



INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,A.PARENT_ID,B.GROUP_NAME,B.LEVEL, B.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=6
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID;


INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,B.PARENT_ID,C.GROUP_NAME,C.LEVEL, C.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B, GROUPS C 
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=7
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
AND C.BUSINESS_ENTITY=B.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID
and B.PARENT_ID=C.GROUP_ID;



INSERT INTO GROUP_HIERARCHY
SELECT 
A.GROUP_ID,A.PARENT_ID,B.GROUP_NAME,B.LEVEL, B.BUSINESS_ENTITY
FROM 
GROUPS A, GROUPS B
WHERE 
A.BUSINESS_ENTITY=v_be AND A.LEVEL=7
AND A.BUSINESS_ENTITY=B.BUSINESS_ENTITY
and A.PARENT_ID=B.GROUP_ID; 
commit;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `getTodayNews` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getTodayNews`()
BEGIN
SELECT ID, RESOURCE, PUB_DATE, FEEDER_CATEGORY, TITLE, LINK, AUTHOR, GUID, CONTENT, CONTENT_TYPE, PUB_DATE, IMAGE, BE
FROM FEEDER
order by PUB_DATE desc
limit 20;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_AVALIABLE_DRIVER` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_AVALIABLE_DRIVER`(pScDate datetime, pEcDate datetime)
BEGIN
select CONCAT(F_PIN, ',', FIRST_NAME, ' ', LAST_NAME, ',*')
 from USER_LIST u
 left join FORM_ASSIGNMENT_REPORT a
 on u.F_PIN = a.PIC
 and a.SC_DATE <= pEcDate
 and a.EC_DATE >= pScDate
where
u.AC = 327;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_DIF` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_DIF`(p_project varchar(45), p_client varchar(45), p_activity varchar(45), p_last_id int(11))
BEGIN
IF p_activity IS NOT NULL THEN
SELECT concat('/', REPLACE(SUB_ACTIVITY, '/', ' '), '/', REPLACE(TITLE, '/', ' '), '/', REF_ID, '/' , FORM_ID, '/' , ID, '/' , DATE_FORMAT(INSERT_DATE, '%e %b %Y')) FROM FORM_PROJECT where PROJECT=p_project and CLIENT=p_client and ACTIVITY=p_activity and (p_last_id = 0 || ID < p_last_id) order BY ID DESC limit 12;
ELSEIF p_client IS NOT NULL THEN
SELECT concat('/', ACTIVITY) FROM FORM_PROJECT where PROJECT=p_project and CLIENT=p_client group by ACTIVITY order BY ACTIVITY, INSERT_DATE;
ELSEIF p_project IS NOT NULL THEN
SELECT concat('/', CLIENT) FROM FORM_PROJECT where PROJECT=p_project group by CLIENT order BY CLIENT;
ELSE
SELECT concat('/', PROJECT) FROM FORM_PROJECT group by PROJECT order BY PROJECT;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_DIF_AND_ORDER` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_DIF_AND_ORDER`(p_be int(11), p_group_id varchar(32), p_project varchar(45), p_client varchar(45), p_activity varchar(45), p_last_id int(11), p_order int(11))
BEGIN
IF p_activity IS NOT NULL THEN
  IF p_order = 1 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.INSERT_DATE DESC, fp.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 2 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.INSERT_DATE ASC,  fp.INSERT_TIME ASC limit p_last_id, 12;
  ELSEIF p_order = 3 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.TITLE DESC, fp.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 4 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.TITLE ASC, fp.INSERT_TIME ASC limit p_last_id, 12;
  ELSEIF p_order = 5 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.FORM_NAME DESC, fp.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 6 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.FORM_NAME ASC, fp.INSERT_TIME ASC limit p_last_id, 12;
  ELSEIF p_order = 7 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.LAST_UPDATE DESC, fp.LAST_UPTIME DESC limit p_last_id, 12;
  ELSEIF p_order = 8 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.LAST_UPDATE ASC, fp.LAST_UPTIME ASC limit p_last_id, 12;
  ELSEIF p_order = 9 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.STATUS DESC, fp.LAST_UPTIME DESC limit p_last_id, 12;
  ELSEIF p_order = 10 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.STATUS ASC, fp.LAST_UPTIME ASC limit p_last_id, 12;
  END IF;
ELSEIF p_client IS NOT NULL THEN
SELECT concat('/', fp.ACTIVITY) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity group by fp.ACTIVITY order BY fp.ACTIVITY, fp.INSERT_DATE;
ELSEIF p_project IS NOT NULL THEN
SELECT concat('/', fp.CLIENT) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity group by fp.CLIENT order BY fp.CLIENT;
ELSE
SELECT concat('/', fp.PROJECT) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity group by fp.PROJECT order BY fp.PROJECT;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_DIF_AND_ORDER_BY_RACI` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_DIF_AND_ORDER_BY_RACI`(p_be int(11), p_group_id varchar(32), p_project varchar(45), p_client varchar(45), p_activity varchar(45), p_sub_activity varchar(45), p_last_id int(11), p_order int(11))
BEGIN
IF p_activity IS NOT NULL THEN
  IF p_order = 1 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.SUB_ACTIVITY=p_sub_activity and fp.ref_id=s.form_id and nd.chat_id = s.chat_id order BY fp.INSERT_DATE DESC, fp.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 2 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.SUB_ACTIVITY=p_sub_activity and fp.ref_id=s.form_id and nd.chat_id = s.chat_id order BY fp.INSERT_DATE ASC,  fp.INSERT_TIME ASC limit p_last_id, 12;
  ELSEIF p_order = 3 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.SUB_ACTIVITY=p_sub_activity and fp.ref_id=s.form_id and nd.chat_id = s.chat_id order BY fp.TITLE DESC, fp.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 4 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.SUB_ACTIVITY=p_sub_activity and fp.ref_id=s.form_id and nd.chat_id = s.chat_id order BY fp.TITLE ASC, fp.INSERT_TIME ASC limit p_last_id, 12;
  ELSEIF p_order = 5 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.SUB_ACTIVITY=p_sub_activity and fp.ref_id=s.form_id and nd.chat_id = s.chat_id order BY fp.FORM_NAME DESC, fp.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 6 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.SUB_ACTIVITY=p_sub_activity and fp.ref_id=s.form_id and nd.chat_id = s.chat_id order BY fp.FORM_NAME ASC, fp.INSERT_TIME ASC limit p_last_id, 12;
  ELSEIF p_order = 7 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.SUB_ACTIVITY=p_sub_activity and fp.ref_id=s.form_id and nd.chat_id = s.chat_id order BY fp.LAST_UPDATE DESC, fp.LAST_UPTIME DESC limit p_last_id, 12;
  ELSEIF p_order = 8 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.SUB_ACTIVITY=p_sub_activity and fp.ref_id=s.form_id and nd.chat_id = s.chat_id order BY fp.LAST_UPDATE ASC, fp.LAST_UPTIME ASC limit p_last_id, 12;
  ELSEIF p_order = 9 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.SUB_ACTIVITY=p_sub_activity and fp.ref_id=s.form_id and nd.chat_id = s.chat_id order BY fp.STATUS DESC, fp.LAST_UPTIME DESC limit p_last_id, 12;
  ELSEIF p_order = 10 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.SUB_ACTIVITY=p_sub_activity and fp.ref_id=s.form_id and nd.chat_id = s.chat_id order BY fp.STATUS ASC, fp.LAST_UPTIME ASC limit p_last_id, 12;
  END IF;
ELSEIF p_client IS NOT NULL THEN
SELECT concat('/', fp.ACTIVITY, '-', fp.SUB_ACTIVITY) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.CLIENT=p_client and fp.ref_id=s.form_id and nd.chat_id = s.chat_id and nd.delete_date is null group by fp.ACTIVITY, fp.SUB_ACTIVITY order BY fp.ACTIVITY,  fp.INSERT_DATE;
ELSEIF p_project IS NOT NULL THEN
SELECT concat('/', fp.CLIENT) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and nd.TITLE=p_project and fp.be=p_be and fp.ref_id=s.form_id and nd.chat_id = s.chat_id and nd.delete_date is null group by fp.CLIENT order BY fp.CLIENT;
ELSE
SELECT concat('/', nd.TITLE) FROM FORM_PROJECT fp, NEW_DF_ACTIVITY s, NEW_DF nd where fp.BE=p_be and fp.ref_id=s.form_id and nd.chat_id = s.chat_id and nd.delete_date is null group by nd.chat_id order BY nd.title;
END IF;END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_DIF_AND_ORDER_BY_RACI_BKP` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_DIF_AND_ORDER_BY_RACI_BKP`(p_be int(11), p_group_id varchar(32), p_project varchar(45), p_client varchar(45), p_activity varchar(45), p_last_id int(11), p_order int(11))
BEGIN
IF p_activity IS NOT NULL THEN
  IF p_order = 1 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.INSERT_DATE DESC, fp.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 2 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.INSERT_DATE ASC,  fp.INSERT_TIME ASC limit p_last_id, 12;
  ELSEIF p_order = 3 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.TITLE DESC, fp.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 4 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.TITLE ASC, fp.INSERT_TIME ASC limit p_last_id, 12;
  ELSEIF p_order = 5 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.FORM_NAME DESC, fp.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 6 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.FORM_NAME ASC, fp.INSERT_TIME ASC limit p_last_id, 12;
  ELSEIF p_order = 7 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.LAST_UPDATE DESC, fp.LAST_UPTIME DESC limit p_last_id, 12;
  ELSEIF p_order = 8 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.LAST_UPDATE ASC, fp.LAST_UPTIME ASC limit p_last_id, 12;
  ELSEIF p_order = 9 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.STATUS DESC, fp.LAST_UPTIME DESC limit p_last_id, 12;
  ELSEIF p_order = 10 THEN
    SELECT concat('/', REPLACE(fp.SUB_ACTIVITY, '/', ' '), '/', REPLACE(fp.TITLE, '/', ' '), '/', fp.REF_ID, '/' , fp.FORM_ID, '/' , fp.ID, '/' , DATE_FORMAT(fp.INSERT_DATE, '%e %b %Y'), '/', IFNULL(fp.STATUS, ' ')) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.ACTIVITY=p_activity and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity order BY fp.STATUS ASC, fp.LAST_UPTIME ASC limit p_last_id, 12;
  END IF;
ELSEIF p_client IS NOT NULL THEN
SELECT concat('/', fp.ACTIVITY) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.CLIENT=p_client and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity group by fp.ACTIVITY, fp.SUB_ACTIVITY order BY fp.ACTIVITY, fp.INSERT_DATE;
ELSEIF p_project IS NOT NULL THEN
SELECT concat('/', fp.CLIENT) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.PROJECT=p_project and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity group by fp.CLIENT order BY fp.CLIENT;
ELSE
SELECT concat('/', fp.PROJECT) FROM FORM_PROJECT fp, SUB_ACTIVITY s where fp.BE=p_be and fp.be=s.be and fp.activity=s.activity and fp.sub_activity=s.sub_activity group by fp.PROJECT order BY fp.PROJECT;
END IF;END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_DIF_AND_ORDER_BY_RACI_TEST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_DIF_AND_ORDER_BY_RACI_TEST`(p_be int(11), p_group_id varchar(32), p_project varchar(45), p_client varchar(45), p_activity varchar(45), p_last_id int(11), p_order int(11))
BEGIN
IF p_activity IS NOT NULL THEN
  IF p_order = 1 THEN
    SELECT concat('/', REPLACE(FP.SUB_ACTIVITY, '/', ' '), '/', REPLACE(FP.TITLE, '/', ' '), '/', FP.REF_ID, '/' , FP.FORM_ID, '/' , FP.ID, '/' , DATE_FORMAT(FP.INSERT_DATE, '%e %b %Y'), '/', IFNULL(FP.STATUS, ' ')) 
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') AND FP.PROJECT = p_project AND FP.CLIENT = p_client AND FP.ACTIVITY= p_activity 
group by FP.INSERT_DATE DESC order BY FP.INSERT_DATE DESC, FP.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 2 THEN
    SELECT concat('/', REPLACE(FP.SUB_ACTIVITY, '/', ' '), '/', REPLACE(FP.TITLE, '/', ' '), '/', FP.REF_ID, '/' , FP.FORM_ID, '/' , FP.ID, '/' , DATE_FORMAT(FP.INSERT_DATE, '%e %b %Y'), '/', IFNULL(FP.STATUS, ' ')) 
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') AND FP.PROJECT = p_project AND FP.CLIENT = p_client AND FP.ACTIVITY= p_activity 
group by FP.INSERT_DATE ASC order BY FP.INSERT_DATE ASC, FP.INSERT_TIME ASC limit p_last_id, 12; 
  ELSEIF p_order = 3 THEN
    SELECT concat('/', REPLACE(FP.SUB_ACTIVITY, '/', ' '), '/', REPLACE(FP.TITLE, '/', ' '), '/', FP.REF_ID, '/' , FP.FORM_ID, '/' , FP.ID, '/' , DATE_FORMAT(FP.INSERT_DATE, '%e %b %Y'), '/', IFNULL(FP.STATUS, ' ')) 
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') AND FP.PROJECT = p_project AND FP.CLIENT = p_client AND FP.ACTIVITY= p_activity 
group by FP.TITLE DESC order BY FP.TITLE DESC, FP.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 4 THEN
    SELECT concat('/', REPLACE(FP.SUB_ACTIVITY, '/', ' '), '/', REPLACE(FP.TITLE, '/', ' '), '/', FP.REF_ID, '/' , FP.FORM_ID, '/' , FP.ID, '/' , DATE_FORMAT(FP.INSERT_DATE, '%e %b %Y'), '/', IFNULL(FP.STATUS, ' ')) 
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') AND FP.PROJECT = p_project AND FP.CLIENT = p_client AND FP.ACTIVITY= p_activity 
group by FP.TITLE ASC order BY FP.TITLE ASC, FP.INSERT_TIME ASC limit p_last_id, 12;
  ELSEIF p_order = 5 THEN
    SELECT concat('/', REPLACE(FP.SUB_ACTIVITY, '/', ' '), '/', REPLACE(FP.TITLE, '/', ' '), '/', FP.REF_ID, '/' , FP.FORM_ID, '/' , FP.ID, '/' , DATE_FORMAT(FP.INSERT_DATE, '%e %b %Y'), '/', IFNULL(FP.STATUS, ' ')) 
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') AND FP.PROJECT = p_project AND FP.CLIENT = p_client AND FP.ACTIVITY= p_activity 
group by FP.FORM_NAME DESC order BY FP.FORM_NAME DESC, FP.INSERT_TIME DESC limit p_last_id, 12;
  ELSEIF p_order = 6 THEN
   SELECT concat('/', REPLACE(FP.SUB_ACTIVITY, '/', ' '), '/', REPLACE(FP.TITLE, '/', ' '), '/', FP.REF_ID, '/' , FP.FORM_ID, '/' , FP.ID, '/' , DATE_FORMAT(FP.INSERT_DATE, '%e %b %Y'), '/', IFNULL(FP.STATUS, ' ')) 
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') AND FP.PROJECT = p_project AND FP.CLIENT = p_client AND FP.ACTIVITY= p_activity 
group by FP.FORM_NAME ASC order BY FP.FORM_NAME ASC, FP.INSERT_TIME ASC limit p_last_id, 12; 
  ELSEIF p_order = 7 THEN
    SELECT concat('/', REPLACE(FP.SUB_ACTIVITY, '/', ' '), '/', REPLACE(FP.TITLE, '/', ' '), '/', FP.REF_ID, '/' , FP.FORM_ID, '/' , FP.ID, '/' , DATE_FORMAT(FP.INSERT_DATE, '%e %b %Y'), '/', IFNULL(FP.STATUS, ' ')) 
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') AND FP.PROJECT = p_project AND FP.CLIENT = p_client AND FP.ACTIVITY= p_activity 
group by FP.LAST_UPDATE DESC order BY FP.LAST_UPDATE DESC, FP.LAST_UPTIME DESC limit p_last_id, 12;
  ELSEIF p_order = 8 THEN
    SELECT concat('/', REPLACE(FP.SUB_ACTIVITY, '/', ' '), '/', REPLACE(FP.TITLE, '/', ' '), '/', FP.REF_ID, '/' , FP.FORM_ID, '/' , FP.ID, '/' , DATE_FORMAT(FP.INSERT_DATE, '%e %b %Y'), '/', IFNULL(FP.STATUS, ' ')) 
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') AND FP.PROJECT = p_project AND FP.CLIENT = p_client AND FP.ACTIVITY= p_activity 
group by FP.LAST_UPDATE ASC order BY FP.LAST_UPDATE ASC, FP.LAST_UPTIME ASC limit p_last_id, 12;
  ELSEIF p_order = 9 THEN
    SELECT concat('/', REPLACE(FP.SUB_ACTIVITY, '/', ' '), '/', REPLACE(FP.TITLE, '/', ' '), '/', FP.REF_ID, '/' , FP.FORM_ID, '/' , FP.ID, '/' , DATE_FORMAT(FP.INSERT_DATE, '%e %b %Y'), '/', IFNULL(FP.STATUS, ' ')) 
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') AND FP.PROJECT = p_project AND FP.CLIENT = p_client AND FP.ACTIVITY= p_activity 
group by FP.STATUS DESC order BY FP.STATUS DESC, FP.LAST_UPTIME DESC limit p_last_id, 12;
  ELSEIF p_order = 10 THEN
    SELECT concat('/', REPLACE(FP.SUB_ACTIVITY, '/', ' '), '/', REPLACE(FP.TITLE, '/', ' '), '/', FP.REF_ID, '/' , FP.FORM_ID, '/' , FP.ID, '/' , DATE_FORMAT(FP.INSERT_DATE, '%e %b %Y'), '/', IFNULL(FP.STATUS, ' ')) 
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') AND FP.PROJECT = p_project AND FP.CLIENT = p_client AND FP.ACTIVITY= p_activity 
group by FP.STATUS ASC order BY FP.STATUS ASC, FP.LAST_UPTIME ASC limit p_last_id, 12;
  END IF;
ELSEIF p_client IS NOT NULL THEN
SELECT CONCAT('/',FP.ACTIVITY)
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') and FP.PROJECT = p_project and FP.CLIENT = p_client 
group by FP.ACTIVITY order BY FP.ACTIVITY, FP.INSERT_DATE;
ELSEIF p_project IS NOT NULL THEN
SELECT CONCAT('/',FP.CLIENT)
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') and FP.PROJECT = p_project 
group by FP.CLIENT order BY FP.CLIENT;
ELSE
SELECT CONCAT('/',FP.PROJECT)
FROM FORM_PROJECT FP
LEFT JOIN (DISCUSSION_FORUM DF LEFT JOIN DF_CLIENT DFC ON DF.CLIENT = DFC.ID LEFT JOIN DF_ACTIVITY DFA ON DF.ACTIVITY = DFA.ID) ON FP.PROJECT = DF.TITLE
LEFT JOIN DF_ACTIVITY DA ON FP.ACTIVITY = DA.TITLE
LEFT JOIN DF_CLIENT DC ON FP.CLIENT = DC.TITLE
WHERE FP.BE = p_be 
AND (DF.R = p_group_id OR DF.R LIKE '%p_group_id,%' OR DF.R LIKE '%,p_group_id,%' OR DF.R LIKE '%,p_group_id%' 
OR DF.A = p_group_id OR DF.A LIKE '%p_group_id,%' OR DF.A LIKE '%,p_group_id,%' OR DF.A LIKE '%,p_group_id%' 
OR DF.C = p_group_id  OR DF.C LIKE '%p_group_id,%' OR DF.C LIKE '%,p_group_id,%' OR DF.C LIKE '%,p_group_id%' 
OR DF.I = p_group_id OR DF.I LIKE '%p_group_id,%' OR DF.I LIKE '%,p_group_id,%' OR DF.I LIKE '%,p_group_id%') 
group by FP.PROJECT order BY FP.PROJECT;
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_DIF_SEARCH` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_DIF_SEARCH`(p_be int(11), p_project varchar(45), p_client varchar(45), p_activity varchar(45), p_search varchar(45),p_last_id int(11))
BEGIN
SELECT concat('/', REPLACE(SUB_ACTIVITY, '/', ' '), '/', REPLACE(TITLE, '/', ' '), '/', REF_ID, '/' , FORM_ID, '/' , ID, '/' , DATE_FORMAT(INSERT_DATE, '%e %b %Y')) FROM FORM_PROJECT where BE=p_be and PROJECT=p_project and CLIENT=p_client and TITLE like p_search and (p_last_id = 0 || ID < p_last_id) order BY ID DESC limit 12;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_DIF_SUBMIT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_DIF_SUBMIT`(p_ref_id varchar(45))
BEGIN
SELECT d.`KEY`, d.`VALUE`, s.F_PIN
from
FORM_SUBMIT_DETAIL d,
FORM_SUBMIT s
where
s.REF_ID = p_ref_id
and s.ID = d.FORM_SUBMIT_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_ELIGIBLE_LUNCH` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_ELIGIBLE_LUNCH`()
BEGIN
SELECT
p.person, p.activity, p.status, p.`date`, p.`time`, fs.CREATED_DATE
FROM
PERSON_ACTIVITY p
LEFT JOIN
FORM_SUBMIT fs ON fs.FORM_ID = '123437'
AND fs.F_PIN = p.person
WHERE
p.`time` > CURDATE()
AND p.status = 1
AND CURDATE() > fs.CREATED_DATE
GROUP BY p.person;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_ELIGIBLE_LUNCH_PERSON` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_ELIGIBLE_LUNCH_PERSON`(p_ref_id VARCHAR(40))
BEGIN
SELECT
p.person, p.activity, p.status, p.`date`, p.`time`
FROM
PERSON_ACTIVITY p
WHERE
p.`time` > CURDATE()
AND p.status IN(1,2)
AND p.activity = 2
AND p.person = p_ref_id
GROUP BY p.person;END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_FORM_LIST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kren`@`%` PROCEDURE `GET_FORM_LIST`(pBe INT, pGrup VARCHAR(45), pAc INT, pPin VARCHAR(45), pLast BIGINT)
BEGIN
select
 f.FORM_ID
, f.TITLE
, f.CREATED_BY
, unix_timestamp(f.CREATED_DATE) 
, f.sq_no
from
 FORM f, FORM_ACCESS a
where unix_timestamp(f.CREATED_DATE) > pLast
and f.FORM_ID = a.FORM_ID 
and f.`STATUS`= 1
and a.BE = pBe
and (
(a.GROUP_ID is NULL and a.ACCESS_CATEGORY is NULL and a.F_PIN is NULL)
or
(a.GROUP_ID = pGrup and a.ACCESS_CATEGORY is NULL and a.F_PIN is NULL)
or
(a.GROUP_ID = pGrup and a.ACCESS_CATEGORY = pAc and a.F_PIN is NULL)
or
(a.GROUP_ID is NULL and a.ACCESS_CATEGORY is NULL and a.F_PIN = pPin)
)
group by 1 order by f.sq_no;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_FORM_RECURRING_TODAY` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_FORM_RECURRING_TODAY`()
BEGIN
select ref.F_PIN, ref.DISCUSSION_ID, ref.ID, snd.CREATED_DATE, ref.CREATED_DATE, lv.ID, ho.ID
from FORM_RECURRING rc
left join FORM_SUBMIT ref on ref.ID=rc.FORM_SUBMIT_ID
left join FORM_SUBMIT snd on snd.RECURRING_REF=ref.ID and snd.CREATED_DATE>CURDATE()
left join PERSON_LEAVE lv on lv.F_PIN = ref.F_PIN and CURDATE() between lv.SC_DATE and lv.EC_DATE
left join PERSON_OFFICE of on of.PERSON = ref.F_PIN and of.DEFAULT_OFFICE=1
left join HOLIDAY ho on ho.OFFICE = of.ID and ho.HOLIDAY_DATE = CURDATE()
where
ref.CREATED_DATE < CURDATE()
and rc.END_DATE >= CURDATE()
and snd.CREATED_DATE is NULL
and lv.ID is NULL
and ho.ID is NULL;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_LUNCH_STORIES` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_LUNCH_STORIES`(p_f_pin VARCHAR(40))
BEGIN
SELECT
fs.ID, fs.REF_ID, fs.F_PIN, fs.CREATED_DATE
FROM
FORM_SUBMIT fs
WHERE
fs.F_PIN = p_f_pin
AND fs.CREATED_DATE > DATE_ADD(curdate(), INTERVAL - 1 MONTH)
AND fs.FORM_ID = 123437 ORDER BY fs.CREATED_DATE DESC;END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_MAIN_CONTENT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_MAIN_CONTENT`(p_f_pin VARCHAR(60))
BEGIN

select CONCAT(p.THUMB_ID, '|', p.FILE_ID)
from POST p, USER_LIST u, USER_LIST_EXTENDED ex
 where
  p.F_PIN = u.F_PIN
  and u.F_PIN = ex.F_PIN
  and u.EC_DATE is NULL
  and ex.OFFICIAL_ACCOUNT in (1,11)
  and p.EC_DATE is NULL
  and p.FILE_TYPE=2
ORDER BY p.SCORE desc, p.LAST_UPDATE DESC LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_MAIN_CONTENT_NEW` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_MAIN_CONTENT_NEW`(p_f_pin VARCHAR(60), p_account VARCHAR(60), p_category text)
BEGIN
select CONCAT(P.THUMB_ID, '|', P.FILE_ID),
A.OFF_ACCOUNT,
P.POST_ID
from
POST P,
    (select p.f_pin, max(p.created_date) post_date, IF(ux.official_account=1 OR ux.official_account=11, 1, 0) OFF_ACCOUNT
    from
    POST p left join FRIEND_LIST f on p.f_pin=f.l_pin and f.f_pin=p_f_pin
           left join USER_LIST_EXTENDED ux on p.f_pin=ux.f_pin
           left JOIN CONTENT_CATEGORY pc ON p.POST_ID = pc.POST_ID
    where
    p.file_type=2
    and p.ec_date is null
    AND FIND_IN_SET(IFNULL(pc.CATEGORY, -1), p_category) > 0
    and (p.privacy = 3 or (p.privacy = 2 and f.f_pin is not NULL) or (p.privacy = 1 and p.f_pin = p_f_pin))
    and (  (ux.official_account in (1,2,11,12) and FIND_IN_SET(1, p_account) > 0)
        or (ux.official_account not in (1,5,6,7,11,12) AND f.f_pin is not NULL and FIND_IN_SET(2, p_account)  > 0)
        or (ux.official_account not in (1,2,5,6,7,11,12) and f.f_pin is NULL and FIND_IN_SET(3, p_account)  > 0)
        or (ux.official_account in (3) and FIND_IN_SET(4, p_account)  > 0)
        or (ux.official_account in (5,11) and FIND_IN_SET(5, p_account)  > 0)
        or (ux.official_account in (6,12) and FIND_IN_SET(6, p_account)  > 0)
        or (ux.official_account in (7) and FIND_IN_SET(7, p_account)  > 0)
    )
    group by f_pin) A
    , USER_LIST U
where
P.FILE_TYPE=2
AND P.F_PIN=A.f_pin
AND P.F_PIN=U.F_PIN
AND P.CREATED_DATE=A.post_date
ORDER BY A.OFF_ACCOUNT DESC, A.post_date DESC
LIMIT 1 ;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_MESSAGE` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kren`@`%` PROCEDURE `GET_MESSAGE`(p_sent_time DECIMAL(20), p_destination VARCHAR(60))
BEGIN
select ID, CONTENT from MESSAGE
where
DESTINATION=p_destination
and (p_sent_time = 0 OR
     (p_sent_time > 0 AND SENT_TIME < p_sent_time ) OR
     (p_sent_time < 0 AND SENT_TIME > ABS(p_sent_time))
    )
order by

CASE WHEN p_sent_time >= 0 THEN SENT_TIME END DESC ,
CASE WHEN p_sent_time < 0 THEN SENT_TIME END ASC

limit 20;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_MESSAGE_LAST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kren`@`%` PROCEDURE `GET_MESSAGE_LAST`(p_destination VARCHAR(60))
BEGIN
select ID, CONTENT from MESSAGE
where
DESTINATION=p_destination
order by SENT_TIME DESC
limit 1;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_MONITORING_REPORT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_MONITORING_REPORT`(p_be int, p_project varchar(128), p_client varchar(128), p_userid varchar(24))
BEGIN
SELECT
X.ACTIVITY, IFNULL(Y.REMARK, '') REMARK, X.RESPONSIBLE, X.ACCOUNTABLE, X.CONSULT,X.INFORM, X.DATE_START, X.DATE_END
, (IFNULL(Y.PROGRESS, 0)/100*X.TARGETNOW) PROGRESS
, X.TARGETNOW
, IF(NOW()<X.DATE_START,0, IF((IFNULL(Y.PROGRESS, 0)/100*X.TARGETNOW)>=(X.TARGETNOW),3,IF((Y.PROGRESS/100*X.TARGETNOW) between X.TARGETBEFORE AND TARGETNOW,2,1))) VALUECOLOR
, IF(NOW()<X.DATE_START,'GREY', IF((IFNULL(Y.PROGRESS, 0)/100*X.TARGETNOW)>=(X.TARGETNOW),'GREEN',IF((Y.PROGRESS/100*X.TARGETNOW) between X.TARGETBEFORE AND TARGETNOW,'YELLOW','RED'))) COLOR
FROM
(SELECT
a.ID,
a.TITLE ACTIVITY,
group_concat(distinct concat(rr.GROUP_ID, '~' , rr.GROUP_NAME, '~' , rr.IMAGE_ID)) RESPONSIBLE,
group_concat(distinct concat(ra.GROUP_ID, '~' , ra.GROUP_NAME, '~' , ra.IMAGE_ID)) ACCOUNTABLE,
group_concat(distinct concat(rc.GROUP_ID, '~' , rc.GROUP_NAME, '~' , rc.IMAGE_ID)) CONSULT,
group_concat(distinct concat(ri.GROUP_ID, '~' , ri.GROUP_NAME, '~' , ri.IMAGE_ID)) INFORM,
c.SC_DATE DATE_START,
c.EC_DATE DATE_END,
DATEDIFF(c.EC_DATE,c.SC_DATE)+1 TOTALDAY,
IF((DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)<0,0,(DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)) TOTALNOW,
IF((IF((DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)<0,0,(DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)))=0,0,
(IF((DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)<0,0,(DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)))*100/(DATEDIFF(c.EC_DATE,c.SC_DATE)+1)) TARGETNOW,
IF((IF((DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -2 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -2 DAY)),c.SC_DATE)+1)<0,0,(DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -2 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -2 DAY)),c.SC_DATE)+1)))=0,0,
(IF((DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -2 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -2 DAY)),c.SC_DATE)+1)<0,0,(DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -2 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -2 DAY)),c.SC_DATE)+1)))*100/(DATEDIFF(c.EC_DATE,c.SC_DATE)+1)) TARGETBEFORE
FROM
DF_ACTIVITY a
, DISCUSSION_FORUM c
left join GROUPS rr on find_in_set(rr.GROUP_ID, c.R)
left join GROUPS ra on find_in_set(ra.GROUP_ID, c.A)
left join GROUPS rc on find_in_set(rc.GROUP_ID, c.C)
left join GROUPS ri on find_in_set(ri.GROUP_ID, c.I)
, GROUPS gm
, DF_CLIENT dc
, USER_LIST ul, MEMBERS m, GROUPS g
where
a.ID = c.ACTIVITY
and c.TITLE=p_project
and c.CLIENT = dc.ID
and dc.TITLE=p_client
and gm.GROUP_ID = c.GROUP_ID
and gm.BUSINESS_ENTITY=p_be
AND (ul.USER_ID = p_userid or '-99'=p_userid)
AND ul.F_PIN=m.F_PIN AND m.GROUP_ID=g.GROUP_ID
AND g.BUSINESS_ENTITY=p_be AND g.IS_ORGANIZATION=1 AND (FIND_IN_SET(g.GROUP_ID, c.R) or FIND_IN_SET(g.GROUP_ID, c.A) or FIND_IN_SET(g.GROUP_ID, c.C) or FIND_IN_SET(g.GROUP_ID, c.I))
GROUP BY a.TITLE
order by a.ID) X LEFT JOIN
(SELECT
A.ACTIVITY
,AVG(A.PROGRESS_SUMMARY) PROGRESS
,AVG(A.VALUECOLOR) VALUECOLOR
,A.REMARK
FROM
(

select ACTIVITY, ALLDAY, TOTALNOW, TARGETNOW, TARGETBEFORE
, IFNULL(PROGRESS, 0) PROGRESS
, IF(PROGRESS>=((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY)) ,100,IFNULL(PROGRESS,0)*100/(IFNULL((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY),0))) PROGRESS_SUMMARY
, '?' COLOR
, 0 VALUECOLOR
, SC_DATE, EC_DATE
, REMARK
FROM
(select far.ACTIVITY
, DATEDIFF(far.EC_DATE,far.SC_DATE)+1 ALLDAY
, DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -1 DAY),far.SC_DATE)+1 TOTALNOW
, IFNULL((DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -1 DAY),far.SC_DATE)+1)*100/(DATEDIFF(far.EC_DATE,far.SC_DATE)+1),0) TARGETNOW
, IFNULL((DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -2 DAY),far.SC_DATE)+1)*100/(DATEDIFF(far.EC_DATE,far.SC_DATE)+1),0) TARGETBEFORE
, IFNULL(far.PROGRESS,0) PROGRESS
, far.SC_DATE
, far.EC_DATE
, far.REMARK
from FORM_ASSIGNMENT_REPORT far
WHERE far.BE=p_be AND far.PROJECT=p_project AND CLIENT=p_client AND  far.SC_DATE<CURDATE()) TEMP1

union

select ACTIVITY, ALLDAY, TOTALNOW, TARGETNOW, TARGETBEFORE
, IFNULL(PROGRESS, 0)
, IF(PROGRESS>=((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY)) ,100,IFNULL(PROGRESS,0)*100/(IFNULL((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY),0))) PROGRESS_SUMMARY
, '?' COLOR
, 0 VALUECOLOR
, SC_DATE, EC_DATE
, REMARK
FROM
(select far.ACTIVITY
, IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1) ALLDAY
, IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE)),HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))+1) TOTALNOW
, IFNULL((IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE)),HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))+1))*100/(IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1)),0) TARGETNOW
, IFNULL((IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(DATE_ADD(NOW(), INTERVAL -1 HOUR)>EC_DATE,EC_DATE,DATE_ADD(NOW(), INTERVAL -1 HOUR)),SC_DATE)),HOUR(TIMEDIFF(IF(DATE_ADD(NOW(), INTERVAL -1 HOUR)>EC_DATE,EC_DATE,DATE_ADD(NOW(), INTERVAL -1 HOUR)),SC_DATE))+1))*100/(IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1)),0) TARGETBEFORE
, IFNULL(far.PROGRESS,0) PROGRESS
, far.SC_DATE
, far.EC_DATE
, far.REMARK
from FORM_ASSIGNMENT_REPORT far
WHERE far.BE=p_be AND far.PROJECT=p_project AND CLIENT=p_client
AND  far.SC_DATE between CURDATE() and DATE_ADD(CURDATE(), interval +86399 second)
AND  far.EC_DATE between CURDATE() and DATE_ADD(CURDATE(), interval +86399 second) ) TEMP2

) A
GROUP BY A.ACTIVITY) Y
ON X.ACTIVITY=Y.ACTIVITY
WHERE X.DATE_START is NOT NULL
ORDER BY X.ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_MONITORING_REPORT2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_MONITORING_REPORT2`(p_be int, p_project varchar(30), p_client varchar(30), p_userid varchar(24))
BEGIN
SELECT
X.ACTIVITY, IFNULL(Y.REMARK, '') REMARK, X.RESPONSIBLE, X.ACCOUNTABLE, X.CONSULT,X.INFORM, X.DATE_START, X.DATE_END
, (IFNULL(Y.PROGRESS, 0)/100*X.TARGETNOW) PROGRESS
, X.TARGETNOW
, IF(NOW()<X.DATE_START,0, IF((IFNULL(Y.PROGRESS, 0)/100*X.TARGETNOW)>=(X.TARGETNOW),3,IF((Y.PROGRESS/100*X.TARGETNOW) between X.TARGETBEFORE AND TARGETNOW,2,1))) VALUECOLOR
, IF(NOW()<X.DATE_START,'GREY', IF((IFNULL(Y.PROGRESS, 0)/100*X.TARGETNOW)>=(X.TARGETNOW),'GREEN',IF((Y.PROGRESS/100*X.TARGETNOW) between X.TARGETBEFORE AND TARGETNOW,'YELLOW','RED'))) COLOR
FROM
(SELECT
c.CHAT_ID,
a.TITLE ACTIVITY,
group_concat(distinct concat(rr.GROUP_ID, '~' , rr.GROUP_NAME, '~' , rr.IMAGE_ID)) RESPONSIBLE,
group_concat(distinct concat(ra.GROUP_ID, '~' , ra.GROUP_NAME, '~' , ra.IMAGE_ID)) ACCOUNTABLE,
group_concat(distinct concat(rc.GROUP_ID, '~' , rc.GROUP_NAME, '~' , rc.IMAGE_ID)) CONSULT,
group_concat(distinct concat(ri.GROUP_ID, '~' , ri.GROUP_NAME, '~' , ri.IMAGE_ID)) INFORM,
c.SC_DATE DATE_START,
c.EC_DATE DATE_END,
DATEDIFF(c.EC_DATE,c.SC_DATE)+1 TOTALDAY,
IF((DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)<0,0,(DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)) TOTALNOW,
IF((IF((DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)<0,0,(DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)))=0,0,
(IF((DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)<0,0,(DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -1 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -1 DAY)),c.SC_DATE)+1)))*100/(DATEDIFF(c.EC_DATE,c.SC_DATE)+1)) TARGETNOW,
IF((IF((DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -2 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -2 DAY)),c.SC_DATE)+1)<0,0,(DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -2 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -2 DAY)),c.SC_DATE)+1)))=0,0,
(IF((DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -2 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -2 DAY)),c.SC_DATE)+1)<0,0,(DATEDIFF(IF(DATE_ADD(CURDATE(), INTERVAL -2 DAY)>c.EC_DATE,c.EC_DATE,DATE_ADD(CURDATE(), INTERVAL -2 DAY)),c.SC_DATE)+1)))*100/(DATEDIFF(c.EC_DATE,c.SC_DATE)+1)) TARGETBEFORE
FROM
DISCUSSION_FORUM c
LEFT JOIN DF_ACTIVITY a on c.ACTIVITY=a.ID
LEFT JOIN DF_CLIENT dc on c.CLIENT=dc.ID
LEFT JOIN SHARED_DISCUSSION_FORUM sdf on sdf.CHAT_ID = c.CHAT_ID
left join GROUPS rr on rr.GROUP_ID=sdf.GROUP_ID AND sdf.R = 1
left join GROUPS ra on ra.GROUP_ID=sdf.GROUP_ID AND sdf.A = 1
left join GROUPS rc on rc.GROUP_ID=sdf.GROUP_ID AND sdf.C = 1
left join GROUPS ri on ri.GROUP_ID=sdf.GROUP_ID AND sdf.I = 1
, USER_LIST ul, MEMBERS m, GROUPS g
where c.TITLE=p_project
AND dc.TITLE=p_client
AND c.GROUP_ID = g.GROUP_ID
AND g.BUSINESS_ENTITY=p_be AND g.IS_ORGANIZATION=1
AND (ul.USER_ID = p_userid or '-99'=p_userid)
AND ul.F_PIN=m.F_PIN AND m.GROUP_ID=g.GROUP_ID
AND (rr.GROUP_ID=g.GROUP_ID or ra.GROUP_ID=g.GROUP_ID or rc.GROUP_ID=g.GROUP_ID or ri.GROUP_ID=g.GROUP_ID)
GROUP BY a.TITLE
order by c.CHAT_ID) X LEFT JOIN
(SELECT
A.ACTIVITY
,AVG(A.PROGRESS_SUMMARY) PROGRESS
,AVG(A.VALUECOLOR) VALUECOLOR
,A.REMARK
FROM
(

select ACTIVITY, ALLDAY, TOTALNOW, TARGETNOW, TARGETBEFORE
, IFNULL(PROGRESS, 0) PROGRESS
, IF(PROGRESS>=((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY)) ,100,IFNULL(PROGRESS,0)*100/(IFNULL((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY),0))) PROGRESS_SUMMARY
, '?' COLOR
, 0 VALUECOLOR
, SC_DATE, EC_DATE
, REMARK
FROM
(select far.ACTIVITY
, DATEDIFF(far.EC_DATE,far.SC_DATE)+1 ALLDAY
, DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -1 DAY),far.SC_DATE)+1 TOTALNOW
, IFNULL((DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -1 DAY),far.SC_DATE)+1)*100/(DATEDIFF(far.EC_DATE,far.SC_DATE)+1),0)
, IFNULL((DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -2 DAY),far.SC_DATE)+1)*100/(DATEDIFF(far.EC_DATE,far.SC_DATE)+1),0) TARGETBEFORE
, IFNULL(far.PROGRESS,0) PROGRESS
, far.SC_DATE
, far.EC_DATE
, far.REMARK
from FORM_ASSIGNMENT_REPORT far
WHERE far.BE=p_be AND far.PROJECT=p_project AND CLIENT=p_client AND  far.SC_DATE<CURDATE()) TEMP1

union

select ACTIVITY, ALLDAY, TOTALNOW, TARGETNOW, TARGETBEFORE
, IFNULL(PROGRESS, 0)
, IF(PROGRESS>=((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY)) ,100,IFNULL(PROGRESS,0)*100/(IFNULL((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY),0))) PROGRESS_SUMMARY
, '?' COLOR
, 0 VALUECOLOR
, SC_DATE, EC_DATE
, REMARK
FROM
(select far.ACTIVITY
, IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1) ALLDAY
, IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE)),HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))+1) TOTALNOW
, IFNULL((IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE)),HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))+1))*100/(IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1)),0) TARGETNOW
, IFNULL((IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(DATE_ADD(NOW(), INTERVAL -1 HOUR)>EC_DATE,EC_DATE,DATE_ADD(NOW(), INTERVAL -1 HOUR)),SC_DATE)),HOUR(TIMEDIFF(IF(DATE_ADD(NOW(), INTERVAL -1 HOUR)>EC_DATE,EC_DATE,DATE_ADD(NOW(), INTERVAL -1 HOUR)),SC_DATE))+1))*100/(IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1)),0) TARGETBEFORE
, IFNULL(far.PROGRESS,0) PROGRESS
, far.SC_DATE
, far.EC_DATE
, far.REMARK
from FORM_ASSIGNMENT_REPORT far
WHERE far.BE=p_be AND far.PROJECT=p_project AND CLIENT=p_client
AND  far.SC_DATE between CURDATE() and DATE_ADD(CURDATE(), interval +86399 second)
AND  far.EC_DATE between CURDATE() and DATE_ADD(CURDATE(), interval +86399 second) ) TEMP2

) A
GROUP BY A.ACTIVITY) Y
ON X.ACTIVITY=Y.ACTIVITY
WHERE X.DATE_START is NOT NULL
ORDER BY X.ID;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_MONITORING_REPORT_HIGHLIGHT` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_MONITORING_REPORT_HIGHLIGHT`(p_be int, p_project varchar(30), p_client varchar(30))
BEGIN
SELECT Y.ACTIVITY, Y.TASK_TITLE, Y.TASK_ID, Y.PIC, concat(ul.FIRST_NAME,' ',ul.LAST_NAME) PIC_NAME, Y.ALLDAY, Y.TOTALNOW, Y.TARGETNOW, Y.TARGETBEFORE, Y.PROGRESS, Y.PROGRESS_SUMMARY, Y.SC_DATE, Y.EC_DATE, Y.REMARK, Y.FLAG
, IF(FLAG=1,10000+(TOTALNOW-ALLDAY),IF(TOTALNOW-ALLDAY<=24,(TOTALNOW-ALLDAY),10000+ ((TOTALNOW-ALLDAY) DIV 24))) CONCLUSION_ORDER
, IF(FLAG=1,concat((TOTALNOW-ALLDAY),' day(s) Late'),IF(TOTALNOW-ALLDAY<=24,concat((TOTALNOW-ALLDAY),' hour(s) Late'),concat((TOTALNOW-ALLDAY) DIV 24,' day(s) Late'))) CONCLUSION
FROM (
select ACTIVITY, TASK_TITLE, TASK TASK_ID, PIC, ALLDAY, TOTALNOW, TARGETNOW, TARGETBEFORE
, IFNULL(PROGRESS, 0) PROGRESS
, IF(PROGRESS>=((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY)) ,100,IFNULL(PROGRESS,0)*100/(IFNULL((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY),0))) PROGRESS_SUMMARY
, '?' COLOR
, 0 VALUECOLOR
, SC_DATE, EC_DATE
, REMARK
, 1 FLAG
FROM
(
select far.ACTIVITY
, far.TASK_TITLE
, far.TASK
, far.PIC
, DATEDIFF(far.EC_DATE,far.SC_DATE)+1 ALLDAY
, DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -1 DAY),far.SC_DATE)+1 TOTALNOW
, IFNULL((DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -1 DAY),far.SC_DATE)+1)*100/(DATEDIFF(far.EC_DATE,far.SC_DATE)+1),0) TARGETNOW
, IFNULL((DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -2 DAY),far.SC_DATE)+1)*100/(DATEDIFF(far.EC_DATE,far.SC_DATE)+1),0) TARGETBEFORE
, IFNULL(far.PROGRESS,0) PROGRESS
, far.SC_DATE
, far.EC_DATE
, far.REMARK
from FORM_ASSIGNMENT_REPORT far
WHERE far.BE=p_be AND far.PROJECT=p_project AND CLIENT=p_client AND  far.SC_DATE<CURDATE()) TEMP1

union

select ACTIVITY, TASK_TITLE, TASK TASK_ID, PIC, ALLDAY, TOTALNOW, TARGETNOW, TARGETBEFORE
, IFNULL(PROGRESS, 0)
, IF(PROGRESS>=((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY)) ,100,IFNULL(PROGRESS,0)*100/(IFNULL((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY),0))) PROGRESS_SUMMARY
, '?' COLOR
, 0 VALUECOLOR
, SC_DATE, EC_DATE
, REMARK
, 2 FLAG
FROM
(select far.ACTIVITY
, far.TASK_TITLE
, far.TASK
, far.PIC
, IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1) ALLDAY
, IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE)),HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))+1) TOTALNOW
, IFNULL((IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE)),HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))+1))*100/(IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1)),0) TARGETNOW
, IFNULL((IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(DATE_ADD(NOW(), INTERVAL -1 HOUR)>EC_DATE,EC_DATE,DATE_ADD(NOW(), INTERVAL -1 HOUR)),SC_DATE)),HOUR(TIMEDIFF(IF(DATE_ADD(NOW(), INTERVAL -1 HOUR)>EC_DATE,EC_DATE,DATE_ADD(NOW(), INTERVAL -1 HOUR)),SC_DATE))+1))*100/(IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1)),0) TARGETBEFORE
, IFNULL(far.PROGRESS,0) PROGRESS
, far.SC_DATE
, far.EC_DATE
, far.REMARK
from FORM_ASSIGNMENT_REPORT far
WHERE far.BE=p_be AND far.PROJECT=p_project AND CLIENT=p_client
AND  far.SC_DATE between CURDATE() and DATE_ADD(CURDATE(), interval +86399 second)
AND  far.EC_DATE between CURDATE() and DATE_ADD(CURDATE(), interval +86399 second) ) TEMP2
) Y, USER_LIST ul
WHERE Y.PIC=ul.F_PIN AND Y.PROGRESS_SUMMARY<100
ORDER BY Y.ACTIVITY ASC, CONCLUSION_ORDER DESC;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_MONITORING_REPORT_LV_1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_MONITORING_REPORT_LV_1`(p_be int, p_project varchar(128), p_client varchar(128), p_activity varchar(128))
BEGIN
SELECT
Y.SUB_ACTIVITY ACTIVITY, IFNULL(Y.REMARK, '') REMARK, '' RESPONSIBLE, '' ACCOUNTABLE, '' CONSULT,'' INFORM, Y.DATE_START, Y.DATE_END
, (IFNULL(Y.PROGRESS, 0)/100*Y.TARGETNOW) PROGRESS
, Y.TARGETNOW
, IF(NOW()<Y.DATE_START,0, IF((IFNULL(Y.PROGRESS, 0)/100*Y.TARGETNOW)>=(Y.TARGETNOW),3,IF((Y.PROGRESS/100*Y.TARGETNOW) between Y.TARGETBEFORE AND TARGETNOW,2,1))) VALUECOLOR
, IF(NOW()<Y.DATE_START,'GREY', IF((IFNULL(Y.PROGRESS, 0)/100*Y.TARGETNOW)>=(Y.TARGETNOW),'GREEN',IF((Y.PROGRESS/100*Y.TARGETNOW) between Y.TARGETBEFORE AND TARGETNOW,'YELLOW','RED'))) COLOR
FROM
(SELECT
A.SUB_ACTIVITY
,AVG(A.PROGRESS) PROGRESS
,AVG(A.VALUECOLOR) VALUECOLOR
,A.REMARK
,A.SC_DATE DATE_START
,A.EC_DATE DATE_END
,IF(A.TARGETNOW>100,100,A.TARGETNOW) TARGETNOW
,IF(A.TARGETBEFORE>100,100,A.TARGETBEFORE) TARGETBEFORE
FROM
(

select SUB_ACTIVITY, ALLDAY, TOTALNOW, TARGETNOW, TARGETBEFORE
, IFNULL(PROGRESS, 0) PROGRESS
, IF(PROGRESS>=((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY)) ,100,IFNULL(PROGRESS,0)*100/(IFNULL((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY),0))) PROGRESS_SUMMARY
, '?' COLOR
, 0 VALUECOLOR
, SC_DATE, EC_DATE
, REMARK
FROM
(select far.SUB_ACTIVITY
, DATEDIFF(far.EC_DATE,far.SC_DATE)+1 ALLDAY
, DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -1 DAY),far.SC_DATE)+1 TOTALNOW
, IFNULL((DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -1 DAY),far.SC_DATE)+1)*100/(DATEDIFF(far.EC_DATE,far.SC_DATE)+1),0) TARGETNOW
, IFNULL((DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -2 DAY),far.SC_DATE)+1)*100/(DATEDIFF(far.EC_DATE,far.SC_DATE)+1),0) TARGETBEFORE
, IFNULL(far.PROGRESS,0) PROGRESS
, far.SC_DATE
, far.EC_DATE
, far.REMARK
from FORM_ASSIGNMENT_REPORT far
WHERE far.BE=p_be AND far.PROJECT=p_project AND CLIENT=p_client AND  far.SC_DATE<CURDATE() AND far.ACTIVITY=p_activity) TEMP1

union

select SUB_ACTIVITY, ALLDAY, TOTALNOW, TARGETNOW, TARGETBEFORE
, IFNULL(PROGRESS, 0)
, IF(PROGRESS>=((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY)) ,100,IFNULL(PROGRESS,0)*100/(IFNULL((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY),0))) PROGRESS_SUMMARY
, '?' COLOR
, 0 VALUECOLOR
, SC_DATE, EC_DATE
, REMARK
FROM
(select far.SUB_ACTIVITY
, IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1) ALLDAY
, IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE)),HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))+1) TOTALNOW
, IFNULL((IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE)),HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))+1))*100/(IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1)),0) TARGETNOW
, IFNULL((IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(DATE_ADD(NOW(), INTERVAL -1 HOUR)>EC_DATE,EC_DATE,DATE_ADD(NOW(), INTERVAL -1 HOUR)),SC_DATE)),HOUR(TIMEDIFF(IF(DATE_ADD(NOW(), INTERVAL -1 HOUR)>EC_DATE,EC_DATE,DATE_ADD(NOW(), INTERVAL -1 HOUR)),SC_DATE))+1))*100/(IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1)),0) TARGETBEFORE
, IFNULL(far.PROGRESS,0) PROGRESS
, far.SC_DATE
, far.EC_DATE
, far.REMARK
from FORM_ASSIGNMENT_REPORT far
WHERE far.BE=p_be AND far.PROJECT=p_project AND CLIENT=p_client
AND  far.SC_DATE between CURDATE() and DATE_ADD(CURDATE(), interval +86399 second)
AND  far.EC_DATE between CURDATE() and DATE_ADD(CURDATE(), interval +86399 second)
AND far.ACTIVITY=p_activity) TEMP2

) A
GROUP BY A.SUB_ACTIVITY) Y;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_MONITORING_REPORT_LV_2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_MONITORING_REPORT_LV_2`(p_be int, p_project varchar(128), p_client varchar(128), p_activity varchar(128), p_subactivity varchar(128))
BEGIN
SELECT
Y.TASK_TITLE ACTIVITY, IFNULL(Y.REMARK, '') REMARK, '' RESPONSIBLE, '' ACCOUNTABLE, '' CONSULT,'' INFORM, Y.DATE_START, Y.DATE_END
, (IFNULL(Y.PROGRESS, 0)/100*Y.TARGETNOW) PROGRESS
, Y.TARGETNOW
, IF(NOW()<Y.DATE_START,0, IF((IFNULL(Y.PROGRESS, 0)/100*Y.TARGETNOW)>=(Y.TARGETNOW),3,IF((Y.PROGRESS/100*Y.TARGETNOW) between Y.TARGETBEFORE AND TARGETNOW,2,1))) VALUECOLOR
, IF(NOW()<Y.DATE_START,'GREY', IF((IFNULL(Y.PROGRESS, 0)/100*Y.TARGETNOW)>=(Y.TARGETNOW),'GREEN',IF((Y.PROGRESS/100*Y.TARGETNOW) between Y.TARGETBEFORE AND TARGETNOW,'YELLOW','RED'))) COLOR
FROM
(SELECT
A.TASK_TITLE
,AVG(A.PROGRESS) PROGRESS
,AVG(A.VALUECOLOR) VALUECOLOR
,A.REMARK
,A.SC_DATE DATE_START
,A.EC_DATE DATE_END
,IF(A.TARGETNOW>100,100,A.TARGETNOW) TARGETNOW
,IF(A.TARGETBEFORE>100,100,A.TARGETBEFORE) TARGETBEFORE
FROM
(

select TASK_TITLE, ALLDAY, TOTALNOW, TARGETNOW, TARGETBEFORE
, IFNULL(PROGRESS, 0) PROGRESS
, IF(PROGRESS>=((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY)) ,100,IFNULL(PROGRESS,0)*100/(IFNULL((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY),0))) PROGRESS_SUMMARY
, '?' COLOR
, 0 VALUECOLOR
, SC_DATE, EC_DATE
, REMARK
FROM
(select far.TASK_TITLE
, DATEDIFF(far.EC_DATE,far.SC_DATE)+1 ALLDAY
, DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -1 DAY),far.SC_DATE)+1 TOTALNOW
, IFNULL((DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -1 DAY),far.SC_DATE)+1)*100/(DATEDIFF(far.EC_DATE,far.SC_DATE)+1),0) TARGETNOW
, IFNULL((DATEDIFF(DATE_ADD(CURDATE(), INTERVAL -2 DAY),far.SC_DATE)+1)*100/(DATEDIFF(far.EC_DATE,far.SC_DATE)+1),0) TARGETBEFORE
, IFNULL(far.PROGRESS,0) PROGRESS
, far.SC_DATE
, far.EC_DATE
, far.REMARK
from FORM_ASSIGNMENT_REPORT far
WHERE far.BE=p_be AND far.PROJECT=p_project AND CLIENT=p_client AND  far.SC_DATE<CURDATE()
AND far.ACTIVITY=p_activity AND far.SUB_ACTIVITY=p_subactivity) TEMP1

union

select TASK_TITLE, ALLDAY, TOTALNOW, TARGETNOW, TARGETBEFORE
, IFNULL(PROGRESS, 0)
, IF(PROGRESS>=((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY)) ,100,IFNULL(PROGRESS,0)*100/(IFNULL((IF(TOTALNOW>=ALLDAY,ALLDAY,TOTALNOW))*100/(ALLDAY),0))) PROGRESS_SUMMARY
, '?' COLOR
, 0 VALUECOLOR
, SC_DATE, EC_DATE
, REMARK
FROM
(select far.TASK_TITLE
, IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1) ALLDAY
, IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE)),HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))+1) TOTALNOW
, IFNULL((IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE)),HOUR(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))+1))*100/(IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1)),0) TARGETNOW
, IFNULL((IF(MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0 AND MINUTE(TIMEDIFF(IF(NOW()>EC_DATE,EC_DATE,NOW()),SC_DATE))=0, HOUR(TIMEDIFF(IF(DATE_ADD(NOW(), INTERVAL -1 HOUR)>EC_DATE,EC_DATE,DATE_ADD(NOW(), INTERVAL -1 HOUR)),SC_DATE)),HOUR(TIMEDIFF(IF(DATE_ADD(NOW(), INTERVAL -1 HOUR)>EC_DATE,EC_DATE,DATE_ADD(NOW(), INTERVAL -1 HOUR)),SC_DATE))+1))*100/(IF(MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0 AND MINUTE(TIMEDIFF(EC_DATE,SC_DATE))=0, HOUR(TIMEDIFF(EC_DATE,SC_DATE)),HOUR(TIMEDIFF(EC_DATE,SC_DATE))+1)),0) TARGETBEFORE
, IFNULL(far.PROGRESS,0) PROGRESS
, far.SC_DATE
, far.EC_DATE
, far.REMARK
from FORM_ASSIGNMENT_REPORT far
WHERE far.BE=p_be AND far.PROJECT=p_project AND CLIENT=p_client
AND  far.SC_DATE between CURDATE() and DATE_ADD(CURDATE(), interval +86399 second)
AND  far.EC_DATE between CURDATE() and DATE_ADD(CURDATE(), interval +86399 second)
AND far.ACTIVITY=p_activity AND far.SUB_ACTIVITY=p_subactivity) TEMP2

) A
GROUP BY A.TASK_TITLE) Y;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_MUTATION_HISTORY` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ucc`@`%` PROCEDURE `GET_MUTATION_HISTORY`(p_pin VARCHAR(30))
BEGIN
select CONCAT(UNIX_TIMESTAMP(CREATED_TIME),'000') TIME, DESCRIPTION, TYPE, FORMAT(BALANCE_BEFORE, 0), FORMAT(AMOUNT, 0), FORMAT(BALANCE_AFTER,0) from WALLET_MUTATION where CREATED_DATE > DATE_ADD(CURDATE(), INTERVAL -7 DAY) AND F_PIN=p_pin;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_OPEN_GROUP_LIST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_OPEN_GROUP_LIST`(p_f_pin VARCHAR(40), p_account VARCHAR(40), p_search VARCHAR(60), p_offset BIGINT(20))
BEGIN
select g.GROUP_ID, g.GROUP_NAME, IFNULL(g.QUOTE, '')
from
 GROUPS g left join MEMBERS m on g.GROUP_ID=m.GROUP_ID and m.F_PIN=p_f_pin
          left join USER_LIST_EXTENDED UX on g.CREATED_BY=UX.F_PIN
          left join FRIEND_LIST F on g.CREATED_BY=F.L_PIN and F.F_PIN = p_f_pin
where
 g.IS_OPEN = 1
 and g.GROUP_NAME like p_search
 and (p_offset=0 OR p_offset > UNIX_TIMESTAMP(g.LAST_UPDATE) * 1000)
 AND (  (UX.OFFICIAL_ACCOUNT in (1,2,5,11,12) AND FIND_IN_SET(1, p_account) > 0)
     OR (UX.OFFICIAL_ACCOUNT != 1 AND F.L_PIN is NOT NULL AND FIND_IN_SET(2, p_account)  > 0)
     OR (UX.OFFICIAL_ACCOUNT not in (1,2,5,11,12) AND F.L_PIN is NULL AND FIND_IN_SET(3, p_account) > 0)
     OR (UX.OFFICIAL_ACCOUNT in (5,11) and FIND_IN_SET(5, p_account)  > 0)
     OR (UX.OFFICIAL_ACCOUNT in (6,12) and FIND_IN_SET(6, p_account)  > 0)
     OR (UX.OFFICIAL_ACCOUNT in (7) and FIND_IN_SET(7, p_account)  > 0)
     )
 order by g.LAST_UPDATE DESC
 limit 10;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_POST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_POST`(p_f_pin VARCHAR(60), p_post_id VARCHAR(60), p_last_update BIGINT(20))
BEGIN
SELECT P.POST_ID, P.F_PIN,
CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME),
U.IMAGE,
P.TYPE,
CASE WHEN P.EC_DATE is not NULL THEN -1
     WHEN PRIVACY = 1 THEN IF(P.F_PIN = p_f_pin, P.CREATED_DATE, -1)
     WHEN PRIVACY = 2 THEN IF(P.F_PIN = p_f_pin OR F.ID is not NULL, P.CREATED_DATE, -1)
     WHEN PRIVACY = 3 THEN P.CREATED_DATE
     ELSE -1
END CREATE_DATE,
P.TITLE,
P.DESCRIPTION,
P.PRIVACY,
P.NU_AUDITION_DATE,
P.TOTAL_COMMENT,
P.TOTAL_LIKES,
P.TOTAL_DISLIKES,
P.LAST_UPDATE,
P.FILE_TYPE,
P.THUMB_ID,
P.FILE_ID,
P.DURATION,
IFNULL(P.EC_DATE, 9999999999999),
IFNULL(E.CATEGORY_ID, '0'),
IFNULL(R.FLAG, 0),
IFNULL(P.LAST_EDIT, 0),
0 PARTI_SIZE,
'' PARTI_MINE,
IFNULL(V.QTY, 0),
IFNULL(FL.QTY, 0),
P.SCORE,
P.LINK,
IFNULL(UNIX_TIMESTAMP(PRT.CREATED_DATE) * 1000, 0),
'0',
IFNULL(E.LEVEL_EDUCATION, '-1'),
IFNULL(E.MATERI_EDUCATION, '-1'),
IFNULL(E.FINALTEST_EDUCATION, '-1'),
IFNULL(P.FILE_SUMMARIZATION, ''),
IFNULL(P.TARGET, '0'),
IFNULL(P.PRICING, '0'),
IFNULL(P.PRICING_MONEY, '0')
FROM
POST P
    LEFT JOIN POST_REACTION R ON P.POST_ID = R.POST_ID AND R.F_PIN = p_f_pin
    LEFT JOIN POST_REQUEST_TUTORIAL PRT ON P.POST_ID = PRT.POST_ID AND PRT.F_PIN = p_f_pin
    LEFT JOIN POST_EXTENDED E ON P.POST_ID = E.POST_ID
    LEFT JOIN (SELECT L_PIN, COUNT(*) QTY FROM FOLLOW WHERE NOW() BETWEEN FOLLOW_DATE AND UNFOLLOW_DATE GROUP BY L_PIN) FL ON P.F_PIN = FL.L_PIN
    LEFT JOIN (SELECT POST_ID, COUNT(*) QTY FROM POST_VIEWER GROUP BY POST_ID) V ON P.POST_ID = V.POST_ID
, USER_LIST U
    LEFT JOIN FRIEND_LIST F on U.F_PIN=F.F_PIN AND F.L_PIN = p_f_pin
WHERE
P.F_PIN = U.F_PIN
AND P.LAST_UPDATE > p_last_update
AND P.POST_ID = p_post_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_POST_PROFILE` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_POST_PROFILE`(p_f_pin VARCHAR(60), p_l_pin VARCHAR(60), p_merchant_id VARCHAR(60), p_privacy_level INT(1), p_created_date BIGINT(20), p_story_id VARCHAR(60), p_limit INT(11))
BEGIN

SELECT P.POST_ID, P.F_PIN,
IFNULL(M.NAME, CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME)),
IFNULL(M.IMAGE, U.IMAGE),
P.TYPE,
P.CREATED_DATE,
P.TITLE,
P.DESCRIPTION,
P.PRIVACY,
P.NU_AUDITION_DATE,
P.TOTAL_COMMENT,
P.TOTAL_LIKES,
P.TOTAL_DISLIKES,
P.LAST_UPDATE,
P.FILE_TYPE,
P.THUMB_ID,
P.FILE_ID,
P.DURATION,
IFNULL(P.EC_DATE, 9999999999999),
IFNULL(E.CATEGORY_ID, '0'),
IFNULL(R.FLAG, 0),
IFNULL(P.LAST_EDIT, 0),
0 PARTI_SIZE,
'' PARTI_MINE,
IFNULL(V.QTY, 0),
IFNULL(FL.QTY, 0),
P.SCORE,
P.LINK,
IFNULL(UNIX_TIMESTAMP(PRT.CREATED_DATE) * 1000, 0),
'0',
IFNULL(E.LEVEL_EDUCATION, '-1'),
IFNULL(E.MATERI_EDUCATION, '-1'),
IFNULL(E.FINALTEST_EDUCATION, '-1'),
IFNULL(P.FILE_SUMMARIZATION, ''),
IFNULL(P.TARGET, '0'),
IFNULL(P.PRICING, '0'),
IFNULL(P.PRICING_MONEY, '0')
FROM
POST P
LEFT JOIN MERCHANTS M ON P.MERCHANT = M.ID AND M.ID=p_merchant_id
LEFT JOIN USER_LIST U ON P.F_PIN = U.F_PIN AND U.F_PIN=p_l_pin
LEFT JOIN POST_REACTION R ON P.POST_ID = R.POST_ID AND R.F_PIN = p_f_pin
LEFT JOIN POST_REQUEST_TUTORIAL PRT ON P.POST_ID = PRT.POST_ID AND PRT.F_PIN = p_f_pin
LEFT JOIN POST_EXTENDED E ON P.POST_ID = E.POST_ID
LEFT JOIN (SELECT L_PIN, COUNT(*) QTY FROM FOLLOW WHERE NOW() BETWEEN FOLLOW_DATE AND UNFOLLOW_DATE GROUP BY L_PIN) FL ON P.F_PIN = FL.L_PIN
LEFT JOIN (SELECT POST_ID, COUNT(*) QTY FROM POST_VIEWER GROUP BY POST_ID) V ON P.POST_ID = V.POST_ID
LEFT JOIN POST_STORY PS ON P.F_PIN=PS.F_PIN AND PS.STORY_ID = p_story_id AND FIND_IN_SET(P.POST_ID, PS.POST_ID) > 0
WHERE
(P.F_PIN = p_l_pin OR P.MERCHANT = p_merchant_id)
AND P.PRIVACY >= p_privacy_level
AND (p_created_date = 0
     OR (p_created_date > 0 && P.CREATED_DATE < p_created_date)
     OR (p_created_date < 0 && P.CREATED_DATE > ABS(p_created_date))
     )
AND P.EC_DATE IS NULL
AND (p_story_id='' OR PS.STORY_ID IS NOT NULL)
group by P.POST_ID
order by
CASE
 WHEN p_created_date >= 0 THEN P.CREATED_DATE END DESC,
CASE
 WHEN p_created_date < 0 THEN P.CREATED_DATE END ASC

limit p_limit
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_POST_TIMELINE` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_POST_TIMELINE`(p_f_pin VARCHAR(60), p_score BIGINT(20), p_last_update BIGINT(20), p_video INT(1), p_recruitment INT(1), p_news INT(1), p_public INT(1), p_friend INT(1), p_private INT(1), p_contains VARCHAR(60))
BEGIN

SELECT P.POST_ID, P.F_PIN,
CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME),
U.IMAGE,
P.TYPE,
P.CREATED_DATE,
P.TITLE,
P.DESCRIPTION,
P.PRIVACY,
P.NU_AUDITION_DATE,
P.TOTAL_COMMENT,
P.TOTAL_LIKES,
P.TOTAL_DISLIKES,
P.LAST_UPDATE,
P.FILE_TYPE,
P.THUMB_ID,
P.FILE_ID,
P.DURATION,
IFNULL(P.EC_DATE, 9999999999999),
IFNULL(E.CATEGORY_ID, '0'),
IFNULL(R.FLAG, 0),
IFNULL(P.LAST_EDIT, 0),
0 PARTI_SIZE,
'' PARTI_MINE,
IFNULL(V.QTY, 0),
IFNULL(FL.QTY, 0),
P.SCORE,
P.LINK
FROM
POST P
    LEFT JOIN POST_REACTION R ON P.POST_ID = R.POST_ID AND R.F_PIN = p_f_pin
    LEFT JOIN POST_EXTENDED E ON P.POST_ID = E.POST_ID
    LEFT JOIN (SELECT L_PIN, COUNT(*) QTY FROM FOLLOW WHERE NOW() BETWEEN FOLLOW_DATE AND UNFOLLOW_DATE GROUP BY L_PIN) FL ON P.F_PIN = FL.L_PIN
    LEFT JOIN (SELECT POST_ID, COUNT(*) QTY FROM POST_VIEWER GROUP BY POST_ID) V ON P.POST_ID = V.POST_ID
    LEFT JOIN USER_LIST_EXTENDED UX ON P.F_PIN = UX.F_PIN
, USER_LIST U
WHERE
P.F_PIN = U.F_PIN
AND P.EC_DATE IS NULL
AND ( (p_score = 0 AND p_last_update = 0) OR  (P.SCORE < p_score OR ( P.SCORE = p_score AND P.LAST_UPDATE < p_last_update)) )
AND P.PRIVACY = 2
AND P.F_PIN = p_f_pin
AND (( (UX.OFFICIAL_ACCOUNT = 1) AND
      (
        (P.FILE_TYPE=2 AND p_video = 1) OR
        (P.FILE_TYPE=5 AND p_recruitment = 1) OR
        (P.FILE_TYPE in (1,3) AND p_news = 1)
      )
     ) OR
     ( (UX.OFFICIAL_ACCOUNT != 1) AND
      (
        (P.PRIVACY=3 AND p_public = 1) OR
        (P.PRIVACY=2 AND p_friend = 1) OR
        (P.PRIVACY=1 AND p_private = 1)
      )
     ))
AND (p_contains = '' OR (P.TITLE like p_contains OR P.DESCRIPTION like p_contains OR CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) like p_contains))

UNION

SELECT P.POST_ID, P.F_PIN,
CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME),
U.IMAGE,
P.TYPE,
P.CREATED_DATE,
P.TITLE,
P.DESCRIPTION,
P.PRIVACY,
P.NU_AUDITION_DATE,
P.TOTAL_COMMENT,
P.TOTAL_LIKES,
P.TOTAL_DISLIKES,
P.LAST_UPDATE,
P.FILE_TYPE,
P.THUMB_ID,
P.FILE_ID,
P.DURATION,
IFNULL(P.EC_DATE, 9999999999999),
IFNULL(E.CATEGORY_ID, '0'),
IFNULL(R.FLAG, 0),
IFNULL(P.LAST_EDIT, 0),
0 PARTI_SIZE,
'' PARTI_MINE,
IFNULL(V.QTY, 0),
IFNULL(FL.QTY, 0),
P.SCORE,
P.LINK
FROM
POST P
    LEFT JOIN POST_REACTION R ON P.POST_ID = R.POST_ID AND R.F_PIN = p_f_pin
    LEFT JOIN POST_EXTENDED E ON P.POST_ID = E.POST_ID
    LEFT JOIN (SELECT L_PIN, COUNT(*) QTY FROM FOLLOW WHERE NOW() BETWEEN FOLLOW_DATE AND UNFOLLOW_DATE GROUP BY L_PIN) FL ON P.F_PIN = FL.L_PIN
    LEFT JOIN (SELECT POST_ID, COUNT(*) QTY FROM POST_VIEWER GROUP BY POST_ID) V ON P.POST_ID = V.POST_ID
    LEFT JOIN USER_LIST_EXTENDED UX ON P.F_PIN = UX.F_PIN
, USER_LIST U, FRIEND_LIST F
WHERE
P.F_PIN = U.F_PIN
AND P.EC_DATE IS NULL
AND ( (p_score = 0 AND p_last_update = 0) OR  (P.SCORE < p_score OR ( P.SCORE = p_score AND P.LAST_UPDATE < p_last_update)) )
AND P.F_PIN = F.L_PIN
AND P.PRIVACY = 2
AND F.F_PIN = p_f_pin
AND (( (UX.OFFICIAL_ACCOUNT = 1) AND
      (
        (P.FILE_TYPE=2 AND p_video = 1) OR
        (P.FILE_TYPE=5 AND p_recruitment = 1) OR
        (P.FILE_TYPE in (1,3) AND p_news = 1)
      )
     ) OR
     ( (UX.OFFICIAL_ACCOUNT != 1) AND
      (
        (P.PRIVACY=3 AND p_public = 1) OR
        (P.PRIVACY=2 AND p_friend = 1) OR
        (P.PRIVACY=1 AND p_private = 1)
      )
     ))
AND (p_contains = '' OR (P.TITLE like p_contains OR P.DESCRIPTION like p_contains  OR CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) like p_contains))

UNION

SELECT P.POST_ID, P.F_PIN,
CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME),
U.IMAGE,
P.TYPE,
P.CREATED_DATE,
P.TITLE,
P.DESCRIPTION,
P.PRIVACY,
P.NU_AUDITION_DATE,
P.TOTAL_COMMENT,
P.TOTAL_LIKES,
P.TOTAL_DISLIKES,
P.LAST_UPDATE,
P.FILE_TYPE,
P.THUMB_ID,
P.FILE_ID,
P.DURATION,
IFNULL(P.EC_DATE, 9999999999999),
IFNULL(E.CATEGORY_ID, '0'),
IFNULL(R.FLAG, 0),
IFNULL(P.LAST_EDIT, 0),
0 PARTI_SIZE,
'' PARTI_MINE,
IFNULL(V.QTY, 0),
IFNULL(FL.QTY, 0),
P.SCORE,
P.LINK
FROM
POST P
    LEFT JOIN POST_REACTION R ON P.POST_ID = R.POST_ID AND R.F_PIN = p_f_pin
    LEFT JOIN POST_EXTENDED E ON P.POST_ID = E.POST_ID
    LEFT JOIN (SELECT L_PIN, COUNT(*) QTY FROM FOLLOW WHERE NOW() BETWEEN FOLLOW_DATE AND UNFOLLOW_DATE GROUP BY L_PIN) FL ON P.F_PIN = FL.L_PIN
    LEFT JOIN (SELECT POST_ID, COUNT(*) QTY FROM POST_VIEWER GROUP BY POST_ID) V ON P.POST_ID = V.POST_ID
    LEFT JOIN USER_LIST_EXTENDED UX ON P.F_PIN = UX.F_PIN
, USER_LIST U
WHERE
P.F_PIN = U.F_PIN
AND P.EC_DATE IS NULL
AND ( (p_score = 0 AND p_last_update = 0) OR  (P.SCORE < p_score OR ( P.SCORE = p_score AND P.LAST_UPDATE < p_last_update)) )
AND P.PRIVACY  = 3
AND (( (UX.OFFICIAL_ACCOUNT = 1) AND
      (
        (P.FILE_TYPE=2 AND p_video = 1) OR
        (P.FILE_TYPE=5 AND p_recruitment = 1) OR
        (P.FILE_TYPE in (1,3) AND p_news = 1)
      )
     ) OR
     ( (UX.OFFICIAL_ACCOUNT != 1) AND
      (
        (P.PRIVACY=3 AND p_public = 1) OR
        (P.PRIVACY=2 AND p_friend = 1) OR
        (P.PRIVACY=1 AND p_private = 1)
      )
     ))
AND (p_contains = '' OR (P.TITLE like p_contains OR P.DESCRIPTION like p_contains OR CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) like p_contains))

ORDER BY SCORE DESC, LAST_UPDATE DESC
LIMIT 6;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_POST_TIMELINE_CATEGORY` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_POST_TIMELINE_CATEGORY`(p_f_pin VARCHAR(60), p_score BIGINT(20), p_last_update BIGINT(20), p_account VARCHAR(10), p_category text, p_contains VARCHAR(60))
BEGIN

SELECT P.POST_ID, P.F_PIN,
CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME),
U.IMAGE,
P.TYPE,
P.CREATED_DATE,
P.TITLE,
P.DESCRIPTION,
P.PRIVACY,
P.NU_AUDITION_DATE,
P.TOTAL_COMMENT,
P.TOTAL_LIKES,
P.TOTAL_DISLIKES,
P.LAST_UPDATE,
P.FILE_TYPE,
P.THUMB_ID,
P.FILE_ID,
P.DURATION,
IFNULL(P.EC_DATE, 9999999999999),
IFNULL(E.CATEGORY_ID, '0'),
IFNULL(R.FLAG, 0),
IFNULL(P.LAST_EDIT, 0),
0 PARTI_SIZE,
'' PARTI_MINE,
IFNULL(V.QTY, 0),
IFNULL(FL.QTY, 0),
P.SCORE,
P.LINK,
IFNULL(UNIX_TIMESTAMP(PRT.CREATED_DATE) * 1000, 0),
'0',
IFNULL(E.LEVEL_EDUCATION, '-1'),
IFNULL(E.MATERI_EDUCATION, '-1'),
IFNULL(E.FINALTEST_EDUCATION, '-1'),
IFNULL(P.FILE_SUMMARIZATION, ''),
IFNULL(P.TARGET, '0'),
IFNULL(P.PRICING, '0'),
IFNULL(P.PRICING_MONEY, '0')
FROM
POST P
    LEFT JOIN POST_REACTION R ON P.POST_ID = R.POST_ID AND R.F_PIN = p_f_pin
    LEFT JOIN POST_REQUEST_TUTORIAL PRT ON P.POST_ID = PRT.POST_ID AND PRT.F_PIN = p_f_pin
    LEFT JOIN POST_EXTENDED E ON P.POST_ID = E.POST_ID
    LEFT JOIN (SELECT L_PIN, COUNT(*) QTY FROM FOLLOW WHERE NOW() BETWEEN FOLLOW_DATE AND UNFOLLOW_DATE GROUP BY L_PIN) FL ON P.F_PIN = FL.L_PIN
    LEFT JOIN (SELECT POST_ID, COUNT(*) QTY FROM POST_VIEWER GROUP BY POST_ID) V ON P.POST_ID = V.POST_ID
    LEFT JOIN USER_LIST_EXTENDED UX ON P.F_PIN = UX.F_PIN
    LEFT JOIN CONTENT_CATEGORY PC ON P.POST_ID = PC.POST_ID
, USER_LIST U
WHERE
P.F_PIN = U.F_PIN
AND P.EC_DATE IS NULL
AND ( (p_score = 0 AND p_last_update = 0) OR  (P.SCORE < p_score OR ( P.SCORE = p_score AND P.LAST_UPDATE < p_last_update)) )
AND P.PRIVACY = 2
AND P.F_PIN = p_f_pin
AND FIND_IN_SET(IFNULL(PC.CATEGORY, -1), p_category) > 0
AND (p_contains = '' OR (P.TITLE like p_contains OR P.DESCRIPTION like p_contains OR CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) like p_contains))
UNION
SELECT P.POST_ID, P.F_PIN,
CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME),
U.IMAGE,
P.TYPE,
P.CREATED_DATE,
P.TITLE,
P.DESCRIPTION,
P.PRIVACY,
P.NU_AUDITION_DATE,
P.TOTAL_COMMENT,
P.TOTAL_LIKES,
P.TOTAL_DISLIKES,
P.LAST_UPDATE,
P.FILE_TYPE,
P.THUMB_ID,
P.FILE_ID,
P.DURATION,
IFNULL(P.EC_DATE, 9999999999999),
IFNULL(E.CATEGORY_ID, '0'),
IFNULL(R.FLAG, 0),
IFNULL(P.LAST_EDIT, 0),
0 PARTI_SIZE,
'' PARTI_MINE,
IFNULL(V.QTY, 0),
IFNULL(FL.QTY, 0),
P.SCORE,
P.LINK,
IFNULL(UNIX_TIMESTAMP(PRT.CREATED_DATE) * 1000, 0),
'0',
IFNULL(E.LEVEL_EDUCATION, '-1'),
IFNULL(E.MATERI_EDUCATION, '-1'),
IFNULL(E.FINALTEST_EDUCATION, '-1'),
IFNULL(P.FILE_SUMMARIZATION, ''),
IFNULL(P.TARGET, '0'),
IFNULL(P.PRICING, '0'),
IFNULL(P.PRICING_MONEY, '0')
FROM
POST P
    LEFT JOIN POST_REACTION R ON P.POST_ID = R.POST_ID AND R.F_PIN = p_f_pin
    LEFT JOIN POST_REQUEST_TUTORIAL PRT ON P.POST_ID = PRT.POST_ID AND PRT.F_PIN = p_f_pin
    LEFT JOIN POST_EXTENDED E ON P.POST_ID = E.POST_ID
    LEFT JOIN (SELECT L_PIN, COUNT(*) QTY FROM FOLLOW WHERE NOW() BETWEEN FOLLOW_DATE AND UNFOLLOW_DATE GROUP BY L_PIN) FL ON P.F_PIN = FL.L_PIN
    LEFT JOIN (SELECT POST_ID, COUNT(*) QTY FROM POST_VIEWER GROUP BY POST_ID) V ON P.POST_ID = V.POST_ID
    LEFT JOIN USER_LIST_EXTENDED UX ON P.F_PIN = UX.F_PIN
    LEFT JOIN CONTENT_CATEGORY PC ON P.POST_ID = PC.POST_ID
, USER_LIST U, FRIEND_LIST F
WHERE
P.F_PIN = U.F_PIN
AND P.EC_DATE IS NULL
AND ( (p_score = 0 AND p_last_update = 0) OR  (P.SCORE < p_score OR ( P.SCORE = p_score AND P.LAST_UPDATE < p_last_update)) )
AND P.F_PIN = F.L_PIN
AND P.PRIVACY = 2
AND F.F_PIN = p_f_pin
AND FIND_IN_SET(IFNULL(PC.CATEGORY, -1), p_category) > 0
AND (p_contains = '' OR (P.TITLE like p_contains OR P.DESCRIPTION like p_contains  OR CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) like p_contains))
AND (  (UX.OFFICIAL_ACCOUNT in (1,2,11,12) AND FIND_IN_SET(1, p_account) > 0)
    OR (UX.OFFICIAL_ACCOUNT not in (1,3,5,6,7,11,12) AND F.L_PIN is NOT NULL AND FIND_IN_SET(2, p_account)  > 0)
    OR (UX.OFFICIAL_ACCOUNT not in (1,2,3,5,6,7,11,12) AND F.L_PIN is NULL AND FIND_IN_SET(3, p_account) > 0)
    OR (UX.OFFICIAL_ACCOUNT in (3) AND FIND_IN_SET(4, p_account) > 0)
    OR (UX.OFFICIAL_ACCOUNT in (5,11) AND FIND_IN_SET(5, p_account) > 0)
    OR (UX.OFFICIAL_ACCOUNT in (6,12) AND FIND_IN_SET(6, p_account) > 0)
    OR (UX.OFFICIAL_ACCOUNT in (7) AND FIND_IN_SET(7, p_account) > 0)
    )
UNION
SELECT P.POST_ID, P.F_PIN,
CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME),
U.IMAGE,
P.TYPE,
P.CREATED_DATE,
P.TITLE,
P.DESCRIPTION,
P.PRIVACY,
P.NU_AUDITION_DATE,
P.TOTAL_COMMENT,
P.TOTAL_LIKES,
P.TOTAL_DISLIKES,
P.LAST_UPDATE,
P.FILE_TYPE,
P.THUMB_ID,
P.FILE_ID,
P.DURATION,
IFNULL(P.EC_DATE, 9999999999999),
IFNULL(E.CATEGORY_ID, '0'),
IFNULL(R.FLAG, 0),
IFNULL(P.LAST_EDIT, 0),
0 PARTI_SIZE,
'' PARTI_MINE,
IFNULL(V.QTY, 0),
IFNULL(FL.QTY, 0),
P.SCORE,
P.LINK,
IFNULL(UNIX_TIMESTAMP(PRT.CREATED_DATE) * 1000, 0),
'0',
IFNULL(E.LEVEL_EDUCATION, '-1'),
IFNULL(E.MATERI_EDUCATION, '-1'),
IFNULL(E.FINALTEST_EDUCATION, '-1'),
IFNULL(P.FILE_SUMMARIZATION, ''),
IFNULL(P.TARGET, '0'),
IFNULL(P.PRICING, '0'),
IFNULL(P.PRICING_MONEY, '0')
FROM
POST P
    LEFT JOIN POST_REACTION R ON P.POST_ID = R.POST_ID AND R.F_PIN = p_f_pin
    LEFT JOIN POST_REQUEST_TUTORIAL PRT ON P.POST_ID = PRT.POST_ID AND PRT.F_PIN = p_f_pin
    LEFT JOIN POST_EXTENDED E ON P.POST_ID = E.POST_ID
    LEFT JOIN (SELECT L_PIN, COUNT(*) QTY FROM FOLLOW WHERE NOW() BETWEEN FOLLOW_DATE AND UNFOLLOW_DATE GROUP BY L_PIN) FL ON P.F_PIN = FL.L_PIN
    LEFT JOIN (SELECT POST_ID, COUNT(*) QTY FROM POST_VIEWER GROUP BY POST_ID) V ON P.POST_ID = V.POST_ID
    LEFT JOIN USER_LIST_EXTENDED UX ON P.F_PIN = UX.F_PIN
    LEFT JOIN CONTENT_CATEGORY PC ON P.POST_ID = PC.POST_ID
, USER_LIST U LEFT JOIN FRIEND_LIST F ON F.F_PIN=p_f_pin AND F.L_PIN=U.F_PIN
WHERE
P.F_PIN = U.F_PIN
AND P.EC_DATE IS NULL
AND ( (p_score = 0 AND p_last_update = 0) OR  (P.SCORE < p_score OR ( P.SCORE = p_score AND P.LAST_UPDATE < p_last_update)) )
AND P.PRIVACY  = 3
AND FIND_IN_SET(IFNULL(PC.CATEGORY, -1), p_category) > 0
AND (p_contains = '' OR (P.TITLE like p_contains OR P.DESCRIPTION like p_contains OR CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) like p_contains))
AND (  (UX.OFFICIAL_ACCOUNT in (1,2,11,12) AND FIND_IN_SET(1, p_account) > 0)
    OR (UX.OFFICIAL_ACCOUNT not in (1,3,5,6,7,11,12) AND F.L_PIN is NOT NULL AND FIND_IN_SET(2, p_account)  > 0)
    OR (UX.OFFICIAL_ACCOUNT not in (1,2,3,5,6,7,11,12) AND F.L_PIN is NULL AND FIND_IN_SET(3, p_account) > 0)
    OR (UX.OFFICIAL_ACCOUNT in (3) AND FIND_IN_SET(4, p_account) > 0)
    OR (UX.OFFICIAL_ACCOUNT in (5,11) AND FIND_IN_SET(5, p_account) > 0)
    OR (UX.OFFICIAL_ACCOUNT in (6,12) AND FIND_IN_SET(6, p_account) > 0)
    OR (UX.OFFICIAL_ACCOUNT in (7) AND FIND_IN_SET(7, p_account) > 0)
    )
GROUP BY 1 ORDER BY SCORE DESC, LAST_UPDATE DESC
LIMIT 15;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_POST_VIDEO_LIST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_POST_VIDEO_LIST`(p_f_pin VARCHAR(40), p_account VARCHAR(60), p_search VARCHAR(100) )
BEGIN
select
P.F_PIN,
P.TITLE,
P.FILE_ID,
P.THUMB_ID,
P.CREATED_DATE,
A.OFF_ACCOUNT,
P.POST_ID,
IFNULL(P.TARGET, '0'),
IFNULL(P.PRICING, '0'),
IFNULL(P.PRICING_MONEY, '0')
from
POST P,
    (select p.f_pin, max(p.created_date) post_date, IF(ux.official_account=1 OR ux.official_account=11, 1, 0) OFF_ACCOUNT
    from
    POST p left join FRIEND_LIST f on p.f_pin=f.l_pin and f.f_pin=p_f_pin
           left join USER_LIST_EXTENDED ux on p.f_pin=ux.f_pin
    where
    p.file_type=2
    and p.ec_date is null
    and (p.privacy = 3 or (p.privacy = 2 and f.f_pin is not NULL) or (p.privacy = 1 and p.f_pin = p_f_pin))
    and (  (ux.official_account in (1,2,11) and FIND_IN_SET(1, p_account) > 0)
        or (ux.official_account not in (1,5,6,7,11) AND f.f_pin is not NULL and FIND_IN_SET(2, p_account)  > 0)
        or (ux.official_account not in (1,2,5,6,7,11) and f.f_pin is NULL and FIND_IN_SET(3, p_account)  > 0)
        or (ux.official_account in (3) and FIND_IN_SET(4, p_account)  > 0)
        or (ux.official_account in (5,11) and FIND_IN_SET(5, p_account)  > 0)
        or (ux.official_account in (6) and FIND_IN_SET(6, p_account)  > 0)
        or (ux.official_account in (7) and FIND_IN_SET(7, p_account)  > 0)
    )
    group by f_pin) A
    , USER_LIST U
where
P.FILE_TYPE=2
AND P.F_PIN=A.f_pin
AND P.F_PIN=U.F_PIN
AND P.CREATED_DATE=A.post_date
AND (P.TITLE like p_search OR CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) like p_search)
ORDER BY A.OFF_ACCOUNT DESC, A.post_date DESC
LIMIT 30 ;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_POST_VIDEO_LIST2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_POST_VIDEO_LIST2`(p_f_pin VARCHAR(40), p_account VARCHAR(60))
BEGIN
select P.F_PIN, P.TITLE, P.FILE_ID, P.THUMB_ID, P.CREATED_DATE, IF(UX.OFFICIAL_ACCOUNT=1, 1, 0)
from
POST P left join FRIEND_LIST F on F.F_PIN=p_f_pin and P.F_PIN=F.L_PIN
, USER_LIST_EXTENDED UX
where
P.F_PIN=UX.F_PIN
AND P.FILE_TYPE=2
AND P.EC_DATE is NULL
AND (  (UX.OFFICIAL_ACCOUNT in (1,2) AND FIND_IN_SET(1, p_account) > 0)
    OR (UX.OFFICIAL_ACCOUNT != 1 AND F.F_PIN is not NULL AND FIND_IN_SET(2, p_account)  > 0)
    OR (UX.OFFICIAL_ACCOUNT not in (1,2) AND F.F_PIN is NULL AND FIND_IN_SET(3, p_account)  > 0)
    )
GROUP BY P.F_PIN
ORDER BY 6 DESC , 5 DESC
LIMIT 30;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_POST_VIDEO_LIST_NEW` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_POST_VIDEO_LIST_NEW`(p_f_pin VARCHAR(40), p_account VARCHAR(60), p_category text, p_search VARCHAR(100))
BEGIN
select
P.F_PIN,
P.TITLE,
P.FILE_ID,
P.THUMB_ID,
P.CREATED_DATE,
A.OFF_ACCOUNT,
P.POST_ID,
IFNULL(P.TARGET, '0'),
IFNULL(P.PRICING, '0'),
IFNULL(P.PRICING_MONEY, '0')
from
POST P,
    (select p.f_pin, max(p.created_date) post_date, IF(ux.official_account=1 OR ux.official_account=11, 1, 0) OFF_ACCOUNT
    from
    POST p left join FRIEND_LIST f on p.f_pin=f.l_pin and f.f_pin=p_f_pin
           left join USER_LIST_EXTENDED ux on p.f_pin=ux.f_pin
           left JOIN CONTENT_CATEGORY pc ON p.POST_ID = pc.POST_ID
    where
    p.file_type=2
    and p.ec_date is null
    AND FIND_IN_SET(IFNULL(pc.CATEGORY, -1), p_category) > 0
    and (p.privacy = 3 or (p.privacy = 2 and f.f_pin is not NULL) or (p.privacy = 1 and p.f_pin = p_f_pin))
    and (  (ux.official_account in (1,2,11,12) and FIND_IN_SET(1, p_account) > 0)
        or (ux.official_account not in (1,5,6,7,11,12) AND f.f_pin is not NULL and FIND_IN_SET(2, p_account)  > 0)
        or (ux.official_account not in (1,2,5,6,7,11,12) and f.f_pin is NULL and FIND_IN_SET(3, p_account)  > 0)
        or (ux.official_account in (3) and FIND_IN_SET(4, p_account)  > 0)
        or (ux.official_account in (5,11) and FIND_IN_SET(5, p_account)  > 0)
        or (ux.official_account in (6,12) and FIND_IN_SET(6, p_account)  > 0)
        or (ux.official_account in (7) and FIND_IN_SET(7, p_account)  > 0)
    )
    group by f_pin) A
    , USER_LIST U
where
P.FILE_TYPE=2
AND P.F_PIN=A.f_pin
AND P.F_PIN=U.F_PIN
AND P.CREATED_DATE=A.post_date
AND (P.TITLE like p_search OR CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) like p_search)
ORDER BY A.OFF_ACCOUNT DESC, A.post_date DESC
LIMIT 30 ;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_PVL` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_PVL`(p_f_pin VARCHAR(40), p_account VARCHAR(60), p_search VARCHAR(100) )
BEGIN
select P.F_PIN, P.TITLE, P.FILE_ID, P.THUMB_ID, P.CREATED_DATE, A.OFF_ACCOUNT
from
POST P,
    (select p.f_pin, max(p.created_date) post_date, IF(ux.official_account=1, 1, 0) OFF_ACCOUNT
    from
    POST p left join FRIEND_LIST f on p.f_pin=f.l_pin and f.f_pin=p_f_pin
           left join USER_LIST_EXTENDED ux on p.f_pin=ux.f_pin
    where
    p.file_type=2
    and p.ec_date is null
    and (p.privacy = 3 or (p.privacy = 2 and f.f_pin is not NULL) or (p.privacy = 1 and p.f_pin = p_f_pin))
    and (  (ux.official_account in (1,2) and FIND_IN_SET(1, p_account) > 0)
        or (ux.official_account != 1 AND f.f_pin is not NULL and FIND_IN_SET(2, p_account)  > 0)
        or (ux.official_account not in (1,2) and f.f_pin is NULL and FIND_IN_SET(3, p_account)  > 0)
        or (ux.official_account in (3) and FIND_IN_SET(4, p_account)  > 0)
    )
    group by f_pin) A
    , USER_LIST U
where
P.FILE_TYPE=2
AND P.F_PIN=A.f_pin
AND P.F_PIN=U.F_PIN
AND P.CREATED_DATE=A.post_date
AND (P.TITLE like p_search OR CONCAT(U.FIRST_NAME, ' ', U.LAST_NAME) like p_search)
ORDER BY A.OFF_ACCOUNT DESC, A.post_date DESC
LIMIT 30 ;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_RACI_BE` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_RACI_BE`(pBE int, pACTIVITY varchar(40))
BEGIN
select ac.ACTIVITY
, group_concat(distinct concat(r.GROUP_NAME, '~' , r.IMAGE_ID)) R
, group_concat(distinct concat(a.GROUP_NAME, '~' , a.IMAGE_ID)) A
, group_concat(distinct concat(c.GROUP_NAME, '~' , c.IMAGE_ID)) C
, group_concat(distinct concat(i.GROUP_NAME, '~' , i.IMAGE_ID)) I
from DEFAULT_ACTIVITY ac
left join GROUPS r on find_in_set(r.GROUP_ID, ac.R)
left join GROUPS a on find_in_set(a.GROUP_ID, ac.A)
left join GROUPS c on find_in_set(c.GROUP_ID, ac.C)
left join GROUPS i on find_in_set(i.GROUP_ID, ac.I)
where ac.BE=pBE and ac.ACTIVITY=pACTIVITY
group by ac.BE, ac.ACTIVITY;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_SHOP_HISTORY` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ucc`@`%` PROCEDURE `GET_SHOP_HISTORY`(p_pin VARCHAR(30))
BEGIN
select t.ID, s.NAME
, CONCAT(UNIX_TIMESTAMP(t.CREATED_DATE), '000') TRANS_DATE
, CONCAT(t.TRANS_NAME, ' ', SUM(d.QTY) ,' item senilai Rp ', CAST(FORMAT(SUM(d.PRICE * d.QTY), 0) as CHAR)) DESCRIPTION
from
SHOP_TRANS t,
SHOP_TRANS_DETAIL d,
SHOP s
where
t.ID = d.SHOP_TRANS
and t.SHOP_CODE = s.CODE
and t.F_PIN = p_pin
and t.CREATED_DATE > DATE_ADD(CURDATE(), INTERVAL -7 DAY)
group by t.ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_SHOP_HISTORY_DETAIL` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`ucc`@`%` PROCEDURE `GET_SHOP_HISTORY_DETAIL`(p_id VARCHAR(30))
BEGIN
select s.NAME, d.QTY, FORMAT(d.PRICE, 0), FORMAT(d.DISCOUNT, 0), FORMAT((d.QTY * d.PRICE),0) TOTAL
from
SHOP_TRANS_DETAIL d,
STOCK s
where
d.SHOP_TRANS = p_id
and d.STOCK_CODE = s.CODE;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_STORY_LIST` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_STORY_LIST`(p_f_pin VARCHAR(60), p_account VARCHAR(60), p_offset BIGINT(20))
BEGIN
select * from (
select CONCAT(a.F_PIN, '|', MAX(a.DATE), '|', a.LABEL), MAX(a.DATE) as DATE from (
    select CONCAT(u.FIRST_NAME, ' ', u.LAST_NAME, '|', IFNULL(IF(u.IMAGE='', '-', u.IMAGE), '-')) as LABEL, s.LAST_UPDATE as DATE, u.F_PIN
    from STORY s
    , USER_LIST u
     left join USER_LIST_EXTENDED ex on u.F_PIN=ex.F_PIN
     left join FRIEND_LIST f on u.F_PIN = f.F_PIN and f.L_PIN=p_f_pin
    where
    s.F_PIN != p_f_pin
    and s.F_PIN = u.F_PIN
and u.ec_date is null
    and (p_offset = 0 OR s.LAST_UPDATE < p_offset)
    and s.LAST_UPDATE > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 YEAR)) * 1000
    and (
        (p_account like '%1%' and ex.OFFICIAL_ACCOUNT in (1, 2, 11, 12))
     OR (p_account like '%2%' and ex.OFFICIAL_ACCOUNT not in (1) and f.ID is NOT NULL)
     OR (p_account like '%4%' and ex.OFFICIAL_ACCOUNT in (3))
     OR (p_account like '%5%' and ex.OFFICIAL_ACCOUNT in (5, 11))
     OR (p_account like '%6%' and ex.OFFICIAL_ACCOUNT in (6, 12))
     OR (p_account like '%7%' and ex.OFFICIAL_ACCOUNT in (7))
    )

    UNION ALL

    select CONCAT(u.FIRST_NAME, ' ', u.LAST_NAME, '|', IFNULL(IF(u.IMAGE='', '-', u.IMAGE), '-')) as LABEL, p.CREATED_DATE as DATE, u.F_PIN
    from POST p
    , USER_LIST u
     left join USER_LIST_EXTENDED ex on u.F_PIN=ex.F_PIN
     left join FRIEND_LIST f on u.F_PIN = f.F_PIN and f.L_PIN=p_f_pin
    where
    p.F_PIN != p_f_pin
    and p.F_PIN = u.F_PIN
and u.ec_date is null
    and (p_offset = 0 OR p.CREATED_DATE < p_offset)
    and p.CREATED_DATE > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 YEAR)) * 1000
    and (
        (p_account like '%1%' and ex.OFFICIAL_ACCOUNT in (1, 2, 11, 12) and p.PRIVACY in (2, 3))
     OR (p_account like '%2%' and ex.OFFICIAL_ACCOUNT not in (1,3) and f.ID is NOT NULL and p.PRIVACY in (2, 3))
     OR (p_account like '%3%' and ex.OFFICIAL_ACCOUNT not in (1,2,3,5,11,12) and f.ID is NULL and p.PRIVACY in (3))
     OR (p_account like '%4%' and ex.OFFICIAL_ACCOUNT in (3) and f.ID is not NULL and p.PRIVACY in (2, 3))
     OR (p_account like '%5%' and ex.OFFICIAL_ACCOUNT in (5, 11) and p.PRIVACY in (2, 3))
     OR (p_account like '%6%' and ex.OFFICIAL_ACCOUNT in (6, 12) and p.PRIVACY in (2, 3))
     OR (p_account like '%7%' and ex.OFFICIAL_ACCOUNT in (7) and p.PRIVACY in (2, 3))
    )
) a

where p_offset = 0 OR a.F_PIN not in (
    select u.F_PIN
    from STORY s
    , USER_LIST u
     left join USER_LIST_EXTENDED ex on u.F_PIN=ex.F_PIN
     left join FRIEND_LIST f on u.F_PIN = f.F_PIN and f.L_PIN=p_f_pin
    where
    s.F_PIN != p_f_pin
    and s.F_PIN = u.F_PIN
and u.ec_date is null
    and s.LAST_UPDATE >= p_offset
    and s.LAST_UPDATE > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 YEAR)) * 1000
    and (
        (p_account like '%1%' and ex.OFFICIAL_ACCOUNT in (1, 2, 11, 12))
     OR (p_account like '%2%' and ex.OFFICIAL_ACCOUNT not in (1, 3) and f.ID is NOT NULL)
     OR (p_account like '%4%' and ex.OFFICIAL_ACCOUNT in (3) and f.ID is NOT NULL)
     OR (p_account like '%5%' and ex.OFFICIAL_ACCOUNT in (5, 11))
     OR (p_account like '%6%' and ex.OFFICIAL_ACCOUNT in (6, 12))
     OR (p_account like '%7%' and ex.OFFICIAL_ACCOUNT in (7))
    )

    UNION

    select u.F_PIN
    from POST p
    , USER_LIST u
     left join USER_LIST_EXTENDED ex on u.F_PIN=ex.F_PIN
     left join FRIEND_LIST f on u.F_PIN = f.F_PIN and f.L_PIN=p_f_pin
    where
    p.F_PIN != p_f_pin
    and p.F_PIN = u.F_PIN
and u.ec_date is null
    and p.CREATED_DATE >= p_offset
    and p.CREATED_DATE > UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 1 YEAR)) * 1000
    and (
        (p_account like '%1%' and ex.OFFICIAL_ACCOUNT in (1, 2, 11, 12) and p.PRIVACY in (2, 3))
     OR (p_account like '%2%' and ex.OFFICIAL_ACCOUNT not in (1,3) and f.ID is NOT NULL and p.PRIVACY in (2, 3))
     OR (p_account like '%3%' and ex.OFFICIAL_ACCOUNT not in (1,2,3) and f.ID is NULL and p.PRIVACY in (3))
     OR (p_account like '%4%' and ex.OFFICIAL_ACCOUNT in (3) and f.ID is NULL and p.PRIVACY in (2,3))
     OR (p_account like '%5%' and ex.OFFICIAL_ACCOUNT in (5, 11) and p.PRIVACY in (2,3))
     OR (p_account like '%6%' and ex.OFFICIAL_ACCOUNT in (6, 12) and p.PRIVACY in (2,3))
     OR (p_account like '%7%' and ex.OFFICIAL_ACCOUNT in (7) and p.PRIVACY in (2,3))
    )
)
group by a.F_PIN
) xx order by xx.DATE DESC
LIMIT 8;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_STORY_PROFILE` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_STORY_PROFILE`(p_f_pin VARCHAR(60), p_l_pin VARCHAR(60), p_merchant_id VARCHAR(60), p_privacy_level INT(1), p_created_date BIGINT(20), p_limit INT(11))
BEGIN

SELECT CONCAT(P.POST_ID, '|' , PS.STORY_NAME, '|' , SUBSTRING_INDEX(P.THUMB_ID, '|', 1), '|' , PS.STORY_DATE, '|' , PS.STORY_ID, '|' , PS.POST_ID)
FROM
POST_STORY PS,
POST P
LEFT JOIN MERCHANTS M ON P.MERCHANT = M.ID AND M.ID=p_merchant_id
LEFT JOIN USER_LIST U ON P.F_PIN = U.F_PIN AND U.F_PIN=p_l_pin
LEFT JOIN POST_REACTION R ON P.POST_ID = R.POST_ID AND R.F_PIN = p_f_pin
LEFT JOIN POST_EXTENDED E ON P.POST_ID = E.POST_ID
LEFT JOIN (SELECT L_PIN, COUNT(*) QTY FROM FOLLOW WHERE NOW() BETWEEN FOLLOW_DATE AND UNFOLLOW_DATE GROUP BY L_PIN) FL ON P.F_PIN = FL.L_PIN
LEFT JOIN (SELECT POST_ID, COUNT(*) QTY FROM POST_VIEWER GROUP BY POST_ID) V ON P.POST_ID = V.POST_ID
WHERE
PS.F_PIN = p_l_pin
AND FIND_IN_SET(P.POST_ID, PS.POST_ID) > 0
AND (P.F_PIN = p_l_pin OR P.MERCHANT = p_merchant_id)
AND P.PRIVACY >= p_privacy_level
AND (p_created_date = 0
     OR (p_created_date > 0 && PS.STORY_DATE < p_created_date)
     OR (p_created_date < 0 && PS.STORY_DATE > ABS(p_created_date))
     )
AND P.EC_DATE IS NULL
group by PS.STORY_ID
order by
CASE
 WHEN p_created_date >= 0 THEN PS.STORY_DATE END DESC,
CASE
 WHEN p_created_date < 0 THEN PS.STORY_DATE END ASC
limit p_limit
;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_SUGGEST_FRIEND` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_SUGGEST_FRIEND`(p_f_pin varchar(60), p_last_seq INT(11))
BEGIN
 
set @rownum := p_last_seq;
set @lim    := p_last_seq + 10;

select x.F_PIN, @rownum := @rownum + 1 as row_number, x.NAME from (
(select u.F_PIN, CONCAT(u.FIRST_NAME, ' ', u.LAST_NAME) NAME from USER_LIST u, USER_LIST_EXTENDED ux
where u.F_PIN != p_f_pin and u.F_PIN not in (select L_PIN from FRIEND_LIST where F_PIN=p_f_pin)
and (u.PRIVACY_FLAG is NULL OR u.PRIVACY_FLAG='0')
and ux.OFFICIAL_ACCOUNT!=1
and (u.CONNECTED=1 or ux.OFFICIAL_ACCOUNT=3)
and u.F_PIN = ux.F_PIN
and ux.IS_VIRTUAL!=1
and p_last_seq = 0
order by RAND() limit 50
)

UNION

(select u.F_PIN, CONCAT(u.FIRST_NAME, ' ', u.LAST_NAME) NAME from USER_LIST u, USER_LIST_EXTENDED ux
where u.F_PIN != p_f_pin and u.F_PIN not in (select L_PIN from FRIEND_LIST where F_PIN=p_f_pin)
and u.F_PIN = ux.F_PIN
and ux.IS_VIRTUAL=1
and p_last_seq = 0
order by RAND() limit 50
)
) x order by 3 limit 50;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_SUGGEST_FRIEND2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`nup`@`%` PROCEDURE `GET_SUGGEST_FRIEND2`(p_f_pin varchar(60), p_last_seq INT(11))
BEGIN

set @rownum := p_last_seq;
set @lim    := p_last_seq + 10;

select * from (
(select u.F_PIN, @rownum := @rownum + 1 as row_number from USER_LIST u, USER_LIST_EXTENDED ux
where u.F_PIN != p_f_pin and u.F_PIN not in (select L_PIN from FRIEND_LIST where F_PIN=p_f_pin)
and (u.PRIVACY_FLAG is NULL OR u.PRIVACY_FLAG='0')
and ux.OFFICIAL_ACCOUNT!=1
and u.CONNECTED=1
and u.F_PIN = ux.F_PIN
and ux.IS_VIRTUAL!=1
and p_last_seq = 0
order by RAND()
)

UNION

(select u.F_PIN, p_last_seq row_number from USER_LIST u, USER_LIST_EXTENDED ux
where u.F_PIN != p_f_pin and u.F_PIN not in (select L_PIN from FRIEND_LIST where F_PIN=p_f_pin)
and u.F_PIN = ux.F_PIN
and ux.IS_VIRTUAL=1
and p_last_seq = 0
order by RAND()
)
) x limit 50;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_UNREAD` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`kren`@`%` PROCEDURE `GET_UNREAD`(p_origin varchar(60), p_sent_time DECIMAL(20), p_destination VARCHAR(60))
BEGIN
select COUNT(ID) from MESSAGE
where
DESTINATION=p_destination
and ORIGINATOR != p_origin
and SENT_TIME > p_sent_time;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `GET_USER_CHECKIN_NOT_POSTING` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_USER_CHECKIN_NOT_POSTING`(p_minute_interval int)
BEGIN
select u.F_PIN, u.FIRST_NAME, fs.CREATED_DATE
from PERSON_ACTIVITY p
, USER_LIST u left join FORM_SUBMIT fs on fs.FORM_ID = '123437' and fs.F_PIN = u.F_PIN and fs.CREATED_DATE > CURDATE()
where p.ACTIVITY=2 and p.`TIME` > DATE_SUB(NOW(), INTERVAL p_minute_interval MINUTE)
and p.PERSON=u.F_PIN
and fs.CREATED_DATE is NULL
group by 1
order by 2 ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `MAPPING_USER_BE_WEEKLY` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `MAPPING_USER_BE_WEEKLY`(IN v_be BIGINT(16))
BEGIN
DECLARE be VARCHAR(128);
DECLARE total INT(11);
DECLARE aktif INT(11);


SET be = (SELECT NAME FROM BUSINESS_ENTITY WHERE ID = v_be);
SET total = (select COUNT(*) FROM USER_LIST);
SET aktif = (select COUNT(*) FROM USER_LIST WHERE IMEI IS NOT NULL);

INSERT INTO bw_chat_210.MAPPING_USER_BE_WEEKLY VALUES (NULL, be, total, aktif,  date_format(date_add(curdate(),interval -1 day),'%Y-%m-%d 00:00:00'));

COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SUMMARY_ACITIVI_USER_1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SUMMARY_ACITIVI_USER_1`(IN v_be BIGINT(16), v_day int(11))
BEGIN
DECLARE be VARCHAR(128);
DECLARE voip_i INT(11);
DECLARE voip_r INT(11);
DECLARE vcall_i INT(11);
DECLARE vcall_r INT(11);
DECLARE ls_i INT(11);
DECLARE ls_j INT(11);

SET be = (SELECT NAME FROM BUSINESS_ENTITY WHERE ID = v_be);
SET voip_i = (SELECT COUNT(distinct AC.who1) FROM ACTIVITY_HISTORY AC, USER_LIST UL WHERE AC.who1 = UL.F_PIN and AC.what1 = 'AoIP' AND AC.when1 BETWEEN date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 00:00:00') AND date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 23:59:59'));
SET voip_r = (SELECT COUNT(distinct AC.who2) FROM ACTIVITY_HISTORY AC WHERE AC.what1 = 'AoIP' AND AC.when1 BETWEEN date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 00:00:00') AND date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 23:59:59'));
SET vcall_i = (SELECT COUNT(distinct AC.who1) FROM ACTIVITY_HISTORY AC, USER_LIST UL WHERE AC.who1 = UL.F_PIN and AC.what1 = 'VoIP' AND AC.when1 BETWEEN date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 00:00:00') AND date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 23:59:59'));
SET vcall_r = (SELECT COUNT(distinct AC.who2) FROM ACTIVITY_HISTORY AC WHERE AC.what1 = 'VoIP' AND AC.when1 BETWEEN date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 00:00:00') AND date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 23:59:59'));
SET ls_i = (SELECT COUNT(distinct AC.who1) FROM ACTIVITY_HISTORY AC, USER_LIST UL WHERE AC.who1 = UL.F_PIN and AC.what1 = 'BoIP' AND AC.when1 BETWEEN date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 00:00:00') AND date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 23:59:59'));
SET ls_j = (SELECT COUNT(distinct AC.who2) FROM ACTIVITY_HISTORY AC WHERE AC.what1 = 'BoIP' AND AC.when1 BETWEEN date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 00:00:00') AND date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 23:59:59'));


INSERT INTO bw_chat_210.SUMMARY_ACTIVITY_USER VALUES (NULL, be, voip_i, voip_r, vcall_i, vcall_r, ls_i, ls_j, date_format(date_add(curdate(),interval -v_day day),'%Y-%m-%d 00:00:00'));

COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `TOTAL_USER_UPDATE` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `TOTAL_USER_UPDATE`(IN v_hour int(12), v_version varchar(64),v_version2 varchar(64),v_version_ios varchar(64))
BEGIN
DECLARE dbs_name VARCHAR(128);
DECLARE dbs_total int(12);
DECLARE dbs_total_active int(12);
DECLARE des_name VARCHAR(128);
DECLARE des_total INT(12);
DECLARE des_total_active int(12);
DECLARE dgs_name VARCHAR(128);
DECLARE dgs_total int(12);
DECLARE dgs_total_active int(12);
DECLARE other_name VARCHAR(128);
DECLARE other_total INT(12);
DECLARE other_total_active INT(12);
DECLARE other2_total INT(12);
DECLARE other2_total_active INT(12);
DECLARE total_telkom varchar(64);
DECLARE total_user INT(12);
DECLARE total_user_aktif INT(12);

SET dbs_name = ('DIVISI BUSINESS SERVICE');
SET des_name = ('DIVISI ENTERPRISE SERVICE');
SET dgs_name = ('DIVISI GOVERNMENT SERVICE');
SET other_name =('Other');
SET total_telkom = 'Direktorat Lain';

SET dbs_total =(SELECT COUNT(UL.ID) FROM USER_LIST UL, MEMBERS M, GROUP_HIERARCHY GH WHERE UL.F_PIN = M.F_PIN AND M.GROUP_ID = GH.GROUP_ID AND M.ACCESS_CATEGORY!=0 AND GH.PARENT_ID IN ('117_1973'));

SET des_total =(SELECT COUNT(UL.ID) FROM USER_LIST UL, MEMBERS M, GROUP_HIERARCHY GH WHERE UL.F_PIN = M.F_PIN AND M.GROUP_ID = GH.GROUP_ID AND M.ACCESS_CATEGORY!=0 AND GH.PARENT_ID IN ('117_2028'));

SET dgs_total =(SELECT COUNT(UL.ID) FROM USER_LIST UL, MEMBERS M, GROUP_HIERARCHY GH WHERE UL.F_PIN = M.F_PIN AND M.GROUP_ID = GH.GROUP_ID AND M.ACCESS_CATEGORY!=0 AND GH.PARENT_ID IN ('117_2169'));

SET other_total =(SELECT COUNT(UL.ID) FROM USER_LIST UL, MEMBERS M, GROUP_HIERARCHY GH WHERE UL.F_PIN = M.F_PIN AND M.GROUP_ID = GH.GROUP_ID AND M.ACCESS_CATEGORY !=0 AND GH.PARENT_ID IN ('117_2239','117_2248','117_2257','117_2264'));

SET other2_total =(SELECT COUNT(UL.ID) FROM USER_LIST UL, MEMBERS M, GROUP_HIERARCHY GH WHERE UL.F_PIN = M.F_PIN AND M.GROUP_ID = GH.GROUP_ID AND M.ACCESS_CATEGORY !=0 AND GH.GROUP_ID IN ('117_2237','117_2238','117_2272','117_2273'));

set dbs_total_active =(SELECT COUNT(UL.ID) FROM USER_LIST UL, MEMBERS M, GROUP_HIERARCHY GH WHERE UL.F_PIN = M.F_PIN AND M.GROUP_ID = GH.GROUP_ID AND M.ACCESS_CATEGORY!=0 AND GH.PARENT_ID IN ('117_1973') AND UL.APP_VERSION in (v_version,v_version2,v_version_ios));

SET des_total_active = (SELECT COUNT(UL.ID) FROM USER_LIST UL, MEMBERS M, GROUP_HIERARCHY GH WHERE UL.F_PIN = M.F_PIN AND M.GROUP_ID = GH.GROUP_ID AND M.ACCESS_CATEGORY!=0 AND GH.PARENT_ID IN ('117_2028') AND UL.APP_VERSION in (v_version,v_version2,v_version_ios));

SET dgs_total_active = (SELECT COUNT(UL.ID) FROM USER_LIST UL, MEMBERS M, GROUP_HIERARCHY GH WHERE UL.F_PIN = M.F_PIN AND M.GROUP_ID = GH.GROUP_ID AND M.ACCESS_CATEGORY!=0 AND GH.PARENT_ID IN ('117_2169') AND UL.APP_VERSION in (v_version,v_version2,v_version_ios));
 
SET other_total_active = (SELECT COUNT(UL.ID) FROM USER_LIST UL, MEMBERS M, GROUP_HIERARCHY GH WHERE UL.F_PIN = M.F_PIN AND M.GROUP_ID = GH.GROUP_ID AND M.ACCESS_CATEGORY !=0 AND GH.PARENT_ID IN ('117_2239','117_2248','117_2257','117_2264') AND UL.APP_VERSION in (v_version,v_version2,v_version_ios));

SET other2_total_active = (SELECT COUNT(UL.ID) FROM USER_LIST UL, MEMBERS M, GROUP_HIERARCHY GH WHERE UL.F_PIN = M.F_PIN AND M.GROUP_ID = GH.GROUP_ID AND M.ACCESS_CATEGORY !=0 AND GH.GROUP_ID IN ('117_2237','117_2238','117_2272','117_2273') AND UL.APP_VERSION in (v_version,v_version2,v_version_ios));

set total_user = (select COUNT(*) FROM USER_LIST);
SET total_user_aktif = (SELECT COUNT(*) FROM USER_LIST WHERE APP_VERSION in (v_version,v_version2,v_version_ios) AND BE = 117);

INSERT INTO bw_chat_210.TOTAL_USER_UPDATE VALUES(NULL,'PT. Telekomunikasi Indonesia','Direktorat EBIS','Direktur EBIS',1,1, NOW(),v_hour);
INSERT INTO bw_chat_210.TOTAL_USER_UPDATE VALUES(NULL,'PT. Telekomunikasi Indonesia','Direktorat EBIS',dbs_name,dbs_total,dbs_total_active, NOW(),v_hour);
INSERT INTO bw_chat_210.TOTAL_USER_UPDATE VALUES(NULL,'PT. Telekomunikasi Indonesia','Direktorat EBIS',des_name,des_total,des_total_active, NOW(),v_hour);
INSERT INTO bw_chat_210.TOTAL_USER_UPDATE VALUES(NULL,'PT. Telekomunikasi Indonesia','Direktorat EBIS',dgs_name,dgs_total,dgs_total_active, NOW(),v_hour);
INSERT INTO bw_chat_210.TOTAL_USER_UPDATE VALUES(NULL,'PT. Telekomunikasi Indonesia','Direktorat EBIS',other_name,other_total,other_total_active, NOW(),v_hour);
update bw_chat_210.TOTAL_USER_UPDATE set TOTAL = (TOTAL+other2_total),TOTAL_AKTIF =(TOTAL_AKTIF+other2_total_active) WHERE TANGGAL = now() AND ORGANIZATION = 'Other';
commit;
INSERT INTO bw_chat_210.TOTAL_USER_UPDATE SELECT NULL,'PT. Telekomunikasi Indonesia','Direktorat lain','-', total_user - (SELECT SUM(TOTAL) from bw_chat_210.TOTAL_USER_UPDATE where TANGGAL = now()), total_user_aktif - (SELECT SUM(TOTAL_AKTIF) from bw_chat_210.TOTAL_USER_UPDATE where TANGGAL = now()), now(),v_hour;

COMMIT;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `TOTAL_USER_UPDATE_2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `TOTAL_USER_UPDATE_2`(IN v_hour INT(11),v_version varchar(64),v_version2 varchar(54), v_version_ios varchar(54))
BEGIN

INSERT INTO bw_chat_210.TOTAL_USER_UPDATE SELECT * FROM (SELECT NULL, BE.NAME,'--','-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_124.USER_LIST UL, bw_124.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_127.USER_LIST UL, bw_127.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_128.USER_LIST UL, bw_128.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_108.USER_LIST UL, bw_108.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_121.USER_LIST UL, bw_121.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_130.USER_LIST UL, bw_130.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_131.USER_LIST UL, bw_131.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_132.USER_LIST UL, bw_132.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_133.USER_LIST UL, bw_133.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_134.USER_LIST UL, bw_134.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_135.USER_LIST UL, bw_135.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_136.USER_LIST UL, bw_136.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_139.USER_LIST UL, bw_139.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_137.USER_LIST UL, bw_137.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_138.USER_LIST UL, bw_138.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_140.USER_LIST UL, bw_140.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_142.USER_LIST UL, bw_142.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_143.USER_LIST UL, bw_143.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_144.USER_LIST UL, bw_144.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_145.USER_LIST UL, bw_145.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_146.USER_LIST UL, bw_146.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_147.USER_LIST UL, bw_147.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_148.USER_LIST UL, bw_148.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_149.USER_LIST UL, bw_149.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1 UNION
SELECT NULL,BE.NAME,'--', '-', COUNT(UL.F_PIN), SUM(IF(UL.APP_VERSION in (v_version,v_version2,v_version_ios), 1, 0)) USER_UPGRADE,NOW(),v_hour FROM bw_150.USER_LIST UL, bw_150.BUSINESS_ENTITY BE WHERE BE.ID = UL.BE  GROUP BY 1) a ORDER BY 3 DESC;
COMMIT;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-26 10:37:51
