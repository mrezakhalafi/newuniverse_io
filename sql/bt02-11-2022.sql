/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.24-MariaDB : Database - new_nus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`new_nus` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `new_nus`;

/*Table structure for table `blog_post` */

DROP TABLE IF EXISTS `BLOG_POST`;

CREATE TABLE `BLOG_POST` (
  `ID` varchar(64) NOT NULL,
  `IMAGE` longtext DEFAULT NULL,
  `IMAGE2` longtext DEFAULT NULL,
  `TITLE` text NOT NULL,
  `CONTENT` longtext NOT NULL,
  `URL` text DEFAULT NULL,
  `URL2` text DEFAULT NULL,
  `URL3` text DEFAULT NULL,
  `DATE` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `blog_post` */

insert  into `BLOG_POST`(`ID`,`IMAGE`,`IMAGE2`,`TITLE`,`CONTENT`,`URL`,`URL2`,`URL3`,`DATE`) values 
('16674432892661f2c89','pexels-yan-krukov-8867476S.jpg','pexels-yan-krukov-8867476S.jpg','3 Ways CPaaS Enhances Banking Capabilities','PHA+PHNwYW4gc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij5CYW5raW5nIGhhcyBldm9sdmVkIG92ZXIgdGhlIHllYXJzIHRocm91Z2ggcmVjZW50IHRlY2hub2xvZ2ljYWwgYWR2YW5jZW1lbnRzLiBUb2RheSwgeW91IGNhbiBhY2Nlc3MgYWxsIGZpbmFuY2lhbCBzZXJ2aWNlcyBmcm9tIGEgbW9iaWxlIGFwcC4gVGhpcyBjb252ZW5pZW5jZSwgaG93ZXZlciwgaXNu4oCZdCBleHRlbmRlZCB0byB0aGUgY29tbXVuaWNhdGlvbiBkZXBhcnRtZW50LiA8L3NwYW4+PHN0cm9uZyBzdHlsZT0iY29sb3I6IHJnYigzMiwgMzMsIDM2KTsiPk1vc3QgYmFua3MgYXJlIHN0aWxsIHN0cnVnZ2xpbmcgdG8gZmluZCBhIGJldHRlciB3YXkgb2Ygbm90IG9ubHkgaW50ZXJhY3Rpbmcgd2l0aCB0aGVpciBjdXN0b21lcnMgYnV0IGFsc28gcHJvdmlkaW5nIHBlcnNvbmFsaXplZCBhbnN3ZXJzLiBUaGUgQ1BhYVMgaGFzLCBob3dldmVyLCBwcm92aWRlZCBhIGdyZWF0IHNvbHV0aW9uIHRvIHRoaXMgcHJvYmxlbS4gVGhlIHBsYXRmb3JtIGFsbG93cyBiYW5rcyB0byBoYXZlIGFsbCBjb21tdW5pY2F0aW9uIGNoYW5uZWxzIGludGVncmF0ZWQgaW50byBmaW5hbmNpYWwgaW5zdGl0dXRpb25z4oCZIG9mZmljaWFsIGFwcHMuPC9zdHJvbmc+PC9wPjxwPjxicj48L3A+PHA+PHNwYW4gc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij5IZXJlIGFyZSB0aGUgYmVuZWZpdHMgb2YgdGhpcyBwbGF0Zm9ybTo8L3NwYW4+PC9wPjx1bD48bGk+PHNwYW4gc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij5HaXZlcyBhIHNlY3VyZSBhbHRlcm5hdGl2ZTwvc3Bhbj48L2xpPjxsaT48c3BhbiBzdHlsZT0iY29sb3I6IHJnYigzMiwgMzMsIDM2KTsiPkVuaGFuY2VzIHBlcnNvbmFsaXplZCBzb2x1dGlvbnM8L3NwYW4+PC9saT48bGk+PHNwYW4gc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij5CZXR0ZXIgc2VydmljZXMgYXQgYSByZWR1Y2VkIGNvc3Q8L3NwYW4+PC9saT48L3VsPg==','https://www.globalbankingandfinance.com/3-ways-cpaas-enhances-banking-capabilities/',NULL,NULL,'2022-11-01 14:25:49'),
('1667443295865a391bd','what-is-uc-header.png','what-is-uc-header.png','How an un-unified communications system can harm customer experience','PHA+PHNwYW4gc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij5Gb2xsb3dpbmcgdGhlIGFjY2VsZXJhdGVkIGRpZ2l0YWwgdHJhbnNmb3JtYXRpb24gb3ZlciB0aGUgcGFzdCB0d28geWVhcnMsIGNhdXNlZCBieSB0aGUgcGFuZGVtaWMsIGN1c3RvbWVycyBub3cgcmVxdWlyZSBhbmQgZXhwZWN0IGEgc3RyZWFtbGluZWQsIGhvbGlzdGljIGV4cGVyaWVuY2Ugd2hlbiBkZWFsaW5nIHdpdGggY3VzdG9tZXIgc2VydmljZSBjaGFubmVscy4gPC9zcGFuPjxzdHJvbmcgc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij5UaGV5IGV4cGVjdCBvbi1kZW1hbmQgYXNzaXN0YW5jZSBwbGF0Zm9ybXMgYXQgdGhlIHRvdWNoIG9mIGEgYnV0dG9uIOKAkyBhIHVuaWZpZWQgY29tbXVuaWNhdGlvbnMgc3lzdGVtLjwvc3Ryb25nPjwvcD4=','https://www.globalbankingandfinance.com/how-an-un-unified-communications-system-can-harm-customer-experience/',NULL,NULL,'2022-11-01 14:43:56'),
('1667443306626f0bb58','istockphoto-1218601476-612x612.jpg','istockphoto-1218601476-612x612.jpg','Sinch Report Reveals Consumers Want Better Ways To Get Real-Time Financial Services and Connect with Their Bank','PHA+PHNwYW4gc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij5DdXN0b21lcnMgd2FudCB0d28td2F5LCByZWFsLXRpbWUgaW50ZXJhY3Rpb25zIHRoYXQgY2FuIHNvbHZlIGJhbmtpbmcgcHJvYmxlbXMgYXMgdGhleSBoYXBwZW4sIG5vIG1hdHRlciB3aGVyZSB0aGV5IGFyZS4gRmlmdHktdGhyZWUgcGVyY2VudCBhcmUgZnJ1c3RyYXRlZCB3aGVuIHRoZXkgY2Fubm90IHJlcGx5IHRvIGEgbW9iaWxlIG1lc3NhZ2UgYW5kIG9uZSBpbiB0aHJlZSB1bmRlciA0MCB3aG8gaGF2ZSBldmVuIHN3aXRjaGVkIGJhbmtzIHRvIGdldCBhIGJldHRlciBtb2JpbGUgZXhwZXJpZW5jZS48L3NwYW4+PC9wPjxwPjxicj48L3A+PHA+PHNwYW4gc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij7igJxJdCBpcyBhbGwgYWJvdXQgaW50ZXJhY3RpdmUsIHBlcnNvbmFsaXNlZCBjb21tdW5pY2F0aW9ucyB0aGF0IGFyZSByZWxldmFudCB0byBjdXN0b21lcnPigJkgZmluYW5jaWFsIGdvYWxzLCBhbmQgaG93IGVhc3kgaXQgaXMgdG8gZ2V0IGEgcmVzcG9uc2UgZnJvbSBhIHBlcnNvbiB3aGVuIG5lZWRlZC4gVGhvdWdoIG1hbnkgYXJlIHN0aWxsIGJ1aWxkaW5nIHRoZWlyIHRydXN0IGluIGRpZ2l0YWwgYmFua2luZywgdGVjaG5vbG9neSBjYW4gYWxzbyBoZWxwIGN1c3RvbWVycyBmZWVsIG1vcmUgc2VjdXJlIHRvby48L3NwYW4+PC9wPjxwPjxicj48L3A+PHA+PHNwYW4gc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij4iQmFua3MgdGhhdCBwYXJ0bmVyIHdpdGggYSByZWxpYWJsZSBDUGFhUyB2ZW5kb3IgZ2FpbiBhIHVuaXF1ZSBhZHZhbnRhZ2UgZm9yIHNlY3VyaW5nIGJvdGggY3VzdG9tZXIgZW5nYWdlbWVudCBhbmQgdHJ1c3QgdGhyb3VnaCBhIHdpZGUgcmFuZ2Ugb2YgcmVhbCB0aW1lIGNvbW11bmljYXRpb25zIGFuZCB2ZXJpZmljYXRpb24gc29sdXRpb25zLCBsaWtlIG11bHRpLWZhY3RvciBhdXRoZW50aWNhdGlvbiBhbmQgdHdvIHN0ZXAgdmVyaWZpY2F0aW9uLCB1c2luZyBjaGFubmVscyBjdXN0b21lcnMgcHJlZmVyIGFuZCBhcmUgZmFtaWxpYXIgd2l0aC7igJ08L3NwYW4+PC9wPg==','https://totaltele.com/sinch-report-reveals-consumers-want-better-ways-to-get-real-time-financial-services-and-connect-with-their-bank/',NULL,NULL,'2022-11-01 14:55:55'),
('1667443312346aa22c6','How-Webex-CPaaS-Solutions-is-Helping-Banks-to-Fight-the-Latest-Fraud-Challenges-.jpg','How-Webex-CPaaS-Solutions-is-Helping-Banks-to-Fight-the-Latest-Fraud-Challenges-.jpg','How Webex CPaaS Solutions is Helping Banks to Fight the Latest Fraud Challenges  ','PHA+PHNwYW4gc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij5UaHJvdWdoIG91ciBlbnRlcnByaXNlLWdyYWRlIGNsb3VkIGNvbW11bmljYXRpb25zIChDUGFhUykgcGxhdGZvcm0gd2UgYXJlIGhlbHBpbmcgYmFua3MsIHBheW1lbnQgc2VydmljZSBwcm92aWRlcnMsIGFuZCBvdGhlciBjb21wYW5pZXMgdG8gdGFrZSBhZHZhbnRhZ2Ugb2YgdGhlIG5ldywgc2VjdXJlLCB2ZXJpZmllZCBtZXNzYWdpbmcgY2hhbm5lbHMgc3VjaCBhcyBSQ1MgQnVzaW5lc3MgTWVzc2FnaW5nLiBXZSBjYW4gc3RpbGwgc2VuZCB0aGUgdHJhZGl0aW9uYWwgU01TIGFuZCBtYWtlIHZvaWNlIGNhbGxzLCBidXQgdGhlc2UgbmV3IGNoYW5uZWxzIGFyZSBtYWtpbmcgaXQgbXVjaCBtb3JlIGRpZmZpY3VsdCBmb3IgZnJhdWRzdGVycyB0byBpbXBlcnNvbmF0ZSBhIGJhbmsgb3IgYnVzaW5lc3Mu4oCdPC9zcGFuPjwvcD4=','https://www.uctoday.com/unified-communications/cpaas/how-webex-cpaas-solutions-is-helping-banks-to-fight-the-latest-fraud-challenges/','https://thefintechtimes.com/cisco-communicating-trust-how-banks-can-connect-with-customers-effectively-and-securely/',NULL,'2022-11-01 14:57:20'),
('1667443316559b0d013','ucaas-unified-communications.jpg','ucaas-unified-communications.jpg','The State of Unified Communications in Financial Services 2022','PHA+PHNwYW4gc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij5XaXRoIHVuaWZpZWQgY29tbXVuaWNhdGlvbnMsIGVtcGxveWVlcyBjYW4gY29sbGFib3JhdGUgYW5kIGVuZ2FnZSB3aXRoIGVhY2ggb3RoZXIsIGNyZWF0aW5nIGEgbW9yZSBjb2hlc2l2ZSB0ZWEsIGNhcGFibGUgb2Ygb3B0aW1hbCBwZXJmb3JtYW5jZSBhY3Jvc3MgbXVsdGlwbGUgY2hhbm5lbHMuIFVDIGNhbiBldmVuIHBhdmUgdGhlIHdheSBmb3IgbmV3IGZvcm1zIG9mIGRpZ2l0YWwgdHJhbnNmb3JtYXRpb24gZm9yIGZpbmFuY2lhbCBzZXJ2aWNlcyBjb21wYW5pZXMuIEZvciBpbnN0YW5jZSwgaW52ZXN0aW5nIGluIFVDYWFTIGNvdWxkIG9wZW4gdGhlIGRvb3IgZm9yIG5ldyBBSSBpbm5vdmF0aW9ucyBhbmQgaHlicmlkIHdvcmsgb3Bwb3J0dW5pdGllcy4gU29tZSBvZiB0aGUgbW9zdCBzaWduaWZpY2FudCB0cmVuZHMgc2hhcGluZyBVQyBpbiBmaW5hbmNpYWwgc2VydmljZXMgdG9kYXkgaW5jbHVkZTo8L3NwYW4+PC9wPg==','https://www.uctoday.com/unified-communications/the-state-of-unified-communications-in-financial-services-2022/','https://www.uctoday.com/unified-communications/cpaas/cpaas-vs-ucaas/','https://www.techtarget.com/searchunifiedcommunications/feature/UCaaS-vs-CCaaS-vs-CPaaS-Whats-the-difference','2022-11-01 15:24:19'),
('16674433206888785f9','secured-communications.png','secured-communications.png','Wall Street hit with $2 billion in fines over employees using WhatsApp and other unauthorized messaging apps','PHA+PHNwYW4gc3R5bGU9ImNvbG9yOiByZ2IoMzIsIDMzLCAzNik7Ij7igJxGaW5hbmNlLCB1bHRpbWF0ZWx5LCBkZXBlbmRzIG9uIHRydXN0LiBCeSBmYWlsaW5nIHRvIGhvbm9yIHRoZWlyIHJlY29yZC1rZWVwaW5nIGFuZCBib29rcy1hbmQtcmVjb3JkcyBvYmxpZ2F0aW9ucywgdGhlIG1hcmtldCBwYXJ0aWNpcGFudHMgd2UgaGF2ZSBjaGFyZ2VkIHRvZGF5IGhhdmUgZmFpbGVkIHRvIG1haW50YWluIHRoYXQgdHJ1c3Qs4oCdIFNFQyBDaGFpciBHYXJ5IEdlbnNsZXIgc2FpZCBpbiB0aGUgYWdlbmN54oCZcyBzdGF0ZW1lbnQuIOKAnEFzIHRlY2hub2xvZ3kgY2hhbmdlcywgaXTigJlzIGV2ZW4gbW9yZSBpbXBvcnRhbnQgdGhhdCByZWdpc3RyYW50cyBhcHByb3ByaWF0ZWx5IGNvbmR1Y3QgdGhlaXIgY29tbXVuaWNhdGlvbnMgYWJvdXQgYnVzaW5lc3MgbWF0dGVycyB3aXRoaW4gb25seSBvZmZpY2lhbCBjaGFubmVscywgYW5kIHRoZXkgbXVzdCBtYWludGFpbiBhbmQgcHJlc2VydmUgdGhvc2UgY29tbXVuaWNhdGlvbnMu4oCdPC9zcGFuPjwvcD4=','https://fortune.com/2022/09/27/wall-street-fines-employee-use-of-whatsapp-unauthorized-messaging-apps/','','','2022-11-01 15:33:09');

/*Table structure for table `blog_tag` */

DROP TABLE IF EXISTS `BLOG_TAG`;

CREATE TABLE `BLOG_TAG` (
  `BLOG_ID` varchar(64) NOT NULL,
  `TAG` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `blog_tag` */

insert  into `BLOG_TAG`(`BLOG_ID`,`TAG`) values 
('16674432892661f2c89','001'),
('1667443295865a391bd','002'),
('1667443306626f0bb58','003'),
('1667443312346aa22c6','001'),
('1667443316559b0d013','002'),
('16674433206888785f9','002'),
('1667448061059ea016a','001');

/*Table structure for table `blog_taglist` */

DROP TABLE IF EXISTS `BLOG_TAGLIST`;

CREATE TABLE `BLOG_TAGLIST` (
  `ID` varchar(10) NOT NULL,
  `TAG` text DEFAULT NULL,
  `TAG_ID` text DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `blog_taglist` */

insert  into `BLOG_TAGLIST`(`ID`,`TAG`,`TAG_ID`) values 
('001','CPaaS','CPaaS'),
('002','UCaaS','UCaaS'),
('003','CCaaS','CCaaS'),
('004','Lo-code','Lo-code'),
('005','Machine Learning','Pembelajaran Mesin'),
('006','AI','AI'),
('007','Blockchain','Blockchain');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
