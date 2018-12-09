-- MySQL dump 10.13  Distrib 5.6.41, for FreeBSD11.2 (amd64)
--
-- Host: localhost    Database: radius
-- ------------------------------------------------------
-- Server version	5.6.41

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `username` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `firstname` varchar(200) NOT NULL DEFAULT '',
  `lastname` varchar(200) NOT NULL DEFAULT '',
  `mailaddr` varchar(200) NOT NULL DEFAULT '',
  `dateregis` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `encryption` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`username`),
  KEY `password` (`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES ('adm','123456','ทดสอบ','ระบบ','test@test.com','2017-07-18 02:22:38','clear',1),('adm1','123456','adm1','admin','--','2018-09-27 06:51:51','clear',1),('admin','123456','นายการุณ','บุญครอบ','bunkhrob@gmail.com','2012-07-18 18:14:32','clear',1),('office1','123456','ทดสอบ','ระบบ','-','2014-06-12 21:44:31','clear',1),('st9','123456','st9','grp-16-07-2017-03-17-27','--','2018-09-27 02:31:24','clear',1),('t1','123456','ครู1','ทดสอบ','t1@test.com','2017-07-16 03:25:20','clear',1);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrator` (
  `username` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `name` varchar(200) NOT NULL DEFAULT '',
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`username`),
  KEY `password` (`password`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES ('administrator','5f4dcc3b5aa765d61d8327deb882cf99','ผู้ดูแลระบบ','2018-11-06 01:46:53');
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ap`
--

DROP TABLE IF EXISTS `ap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ap` (
  `apname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ipaddr` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`apname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ap`
--

LOCK TABLES `ap` WRITE;
/*!40000 ALTER TABLE `ap` DISABLE KEYS */;
INSERT INTO `ap` VALUES ('www.bms.ac.th','202.143.142.21'),('www.google.com','www.google.com'),('www.tansumhospital.go.th','203.113.117.68'),('www.yahoo.com','www.yahoo.com');
/*!40000 ALTER TABLE `ap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration` (
  `variable` varchar(200) NOT NULL DEFAULT '',
  `value` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`variable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` VALUES ('default_regis_status','0'),('multi_encryption','0'),('redirect','http://www.phoubon.in.th');
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cui`
--

DROP TABLE IF EXISTS `cui`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cui` (
  `clientipaddress` varchar(46) NOT NULL DEFAULT '',
  `callingstationid` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `cui` varchar(32) NOT NULL DEFAULT '',
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastaccounting` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`username`,`clientipaddress`,`callingstationid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cui`
--

LOCK TABLES `cui` WRITE;
/*!40000 ALTER TABLE `cui` DISABLE KEYS */;
/*!40000 ALTER TABLE `cui` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genuser`
--

DROP TABLE IF EXISTS `genuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genuser` (
  `userprefix` varchar(50) NOT NULL,
  `userlastno` int(11) NOT NULL,
  PRIMARY KEY (`userprefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genuser`
--

LOCK TABLES `genuser` WRITE;
/*!40000 ALTER TABLE `genuser` DISABLE KEYS */;
INSERT INTO `genuser` VALUES ('adm',11);
/*!40000 ALTER TABLE `genuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `gname` varchar(100) NOT NULL DEFAULT '',
  `gdesc` varchar(200) NOT NULL DEFAULT '',
  `gupload` int(11) NOT NULL DEFAULT '0',
  `gdownload` int(11) NOT NULL DEFAULT '0',
  `gexpire` date NOT NULL DEFAULT '0000-00-00',
  `glimited` int(11) NOT NULL DEFAULT '0',
  `gstatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`gid`),
  KEY `gname` (`gname`),
  KEY `gdesc` (`gdesc`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','Administrator',0,0,'0000-00-00',0,1),(2,'register','Register',512,1024,'0000-00-00',0,0),(3,'office','Office',2048,2048,'0000-00-00',0,1),(4,'grp-16-07-2017-03-17-27','Student',5000,5000,'0000-00-00',0,1),(5,'grp-16-07-2017-03-18-38','Teacher',10240,10240,'0000-00-00',0,1),(6,'group20170718021701','TS-Test',5000,8000,'0000-00-00',0,1),(7,'group-20180927071220','TEST2',3000,5000,'0000-00-00',0,1);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interface`
--

DROP TABLE IF EXISTS `interface`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interface` (
  `variable` varchar(200) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`variable`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interface`
--

LOCK TABLES `interface` WRITE;
/*!40000 ALTER TABLE `interface` DISABLE KEYS */;
INSERT INTO `interface` VALUES ('fail_login','<font color=red>à¸‚à¹‰à¸­à¸¡à¸¹à¸¥à¸‚à¸­à¸‡à¸„à¸¸à¸“à¹„à¸¡à¹ˆà¸–à¸¹à¸à¸•à¹‰à¸­à¸‡</font>'),('footer','<b><font color=white>à¸„à¸³à¸­à¸˜à¸´à¸šà¸²à¸¢à¸à¸²à¸£à¹ƒà¸Šà¹‰à¸‡à¸²à¸™<font></b><ul>\r\n<li>à¸ªà¸²à¸¡à¸²à¸£à¸–à¸ªà¸¡à¸±à¸„à¸£à¸ªà¸¡à¸²à¸Šà¸´à¸à¹„à¸”à¹‰à¸—à¸µà¹ˆà¸™à¸µà¹ˆ <a href=\"admin/register.php\"> à¸ªà¸¡à¸±à¸„à¸£à¸ªà¸¡à¸²à¸Šà¸´à¸</a><br><b>* à¹à¸•à¹ˆà¸ˆà¸°à¹ƒà¸Šà¹‰à¸‡à¸²à¸™à¹„à¸”à¹‰à¹€à¸¡à¸·à¹ˆà¸­à¹„à¸”à¹‰à¸£à¸±à¸šà¸­à¸™à¸¸à¸à¸²à¸•à¹à¸¥à¹‰à¸§*</b></li>\r\n <li>à¸«à¸²à¸ User à¸¢à¸±à¸‡à¸„à¹‰à¸²à¸‡à¹ƒà¸™à¸£à¸°à¸šà¸šà¸ˆà¸°à¸•à¹‰à¸­à¸‡à¸•à¸±à¸”à¸à¸²à¸£à¸—à¸³à¸‡à¸²à¸™à¸à¹ˆà¸­à¸™à¹„à¸”à¹‰à¸—à¸µà¹ˆà¸™à¸µà¹ˆ <a href=\"admin/user_kick.php\"> Kick </a></li>\r\n<li>à¸–à¹‰à¸²à¸›à¹Šà¸­à¸šà¸­à¸±à¸žà¹„à¸¡à¹ˆà¸‚à¸¶à¹‰à¸™à¹ƒà¸«à¹‰à¸­à¸­à¸à¸ˆà¸²à¸à¸£à¸°à¸šà¸šà¹„à¸”à¹‰à¹‚à¸”à¸¢à¸žà¸´à¸¡à¸žà¹Œ 1.1.1.1 à¸—à¸µà¹ˆà¹€à¸šà¸£à¸²à¸§à¹Œà¹€à¸‹à¸­à¸£à¹Œ\r\n<li>à¸¥à¸·à¸¡à¸£à¸«à¸±à¸ªà¸œà¹ˆà¸²à¸™à¸«à¸£à¸·à¸­à¹„à¸¡à¹ˆà¸ªà¸²à¸¡à¸²à¸£à¸–à¹€à¸‚à¹‰à¸²à¸ªà¸¹à¹ˆà¸£à¸°à¸šà¸šà¹„à¸”à¹‰ à¸à¸£à¸¸à¸“à¸²à¸•à¸´à¸”à¸•à¹ˆà¸­à¹€à¸ˆà¹‰à¸²à¸«à¸™à¹‰à¸²à¸—à¸µà¹ˆà¸œà¸¹à¹‰à¸”à¸¹à¹à¸¥à¸£à¸°à¸šà¸šà¸¯</li>\r\n</ul>'),('footer_popup','<br><font color=white><b>à¸„à¸³à¸­à¸˜à¸´à¸šà¸²à¸¢à¸à¸²à¸£à¹ƒà¸Šà¹‰à¸‡à¸²à¸™<font></b><ul><li>à¸à¸²à¸£à¸›à¸´à¸”à¸«à¸™à¹‰à¸²à¸•à¹ˆà¸²à¸‡à¸™à¸µà¹‰à¸ˆà¸°à¸—à¸³à¹ƒà¸«à¹‰à¸„à¸¸à¸“à¸­à¸­à¸à¸ˆà¸²à¸à¸£à¸°à¸šà¸šà¸—à¸±à¸™à¸—à¸µ</li>\r\n<li>à¸–à¹‰à¸²à¸›à¹Šà¸­à¸šà¸­à¸±à¸žà¹„à¸¡à¹ˆà¸‚à¸¶à¹‰à¸™à¹ƒà¸«à¹‰à¸­à¸­à¸à¸ˆà¸²à¸à¸£à¸°à¸šà¸šà¹„à¸”à¹‰à¹‚à¸”à¸¢à¸žà¸´à¸¡à¸žà¹Œ 1.1.1.1 à¸—à¸µà¹ˆà¹€à¸šà¸£à¸²à¸§à¹Œà¹€à¸‹à¸­à¸£à¹Œ</li><li>à¸«à¸²à¸à¹€à¸à¸´à¸”à¸›à¸±à¸à¸«à¸²à¹ƒà¸™à¸à¸²à¸£à¹ƒà¸Šà¹‰à¸‡à¸²à¸™ à¸à¸£à¸¸à¸“à¸²à¸•à¸´à¸”à¸•à¹ˆà¸­à¹€à¸ˆà¹‰à¸²à¸«à¸™à¹‰à¸²à¸—à¸µà¹ˆà¸„à¸£à¸±à¸š</li></ul>                                                                        '),('please_login','à¸à¸£à¸¸à¸“à¸²à¸à¸£à¸­à¸à¸Šà¸·à¹ˆà¸­à¸œà¸¹à¹‰à¹ƒà¸Šà¹‰à¹à¸¥à¸°à¸£à¸«à¸±à¸ªà¸œà¹ˆà¸²à¸™'),('template_name','temp01'),('title','-:- Wifi Hotspot Authent!catioN -:-');
/*!40000 ALTER TABLE `interface` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nas`
--

DROP TABLE IF EXISTS `nas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nasname` varchar(128) NOT NULL,
  `shortname` varchar(32) DEFAULT NULL,
  `type` varchar(30) DEFAULT 'other',
  `ports` int(5) DEFAULT NULL,
  `secret` varchar(60) NOT NULL DEFAULT 'secret',
  `server` varchar(64) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT 'RADIUS Client',
  PRIMARY KEY (`id`),
  KEY `nasname` (`nasname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nas`
--

LOCK TABLES `nas` WRITE;
/*!40000 ALTER TABLE `nas` DISABLE KEYS */;
/*!40000 ALTER TABLE `nas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radacct`
--

DROP TABLE IF EXISTS `radacct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radacct` (
  `radacctid` bigint(21) NOT NULL AUTO_INCREMENT,
  `acctsessionid` varchar(64) NOT NULL DEFAULT '',
  `acctuniqueid` varchar(32) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `realm` varchar(64) DEFAULT '',
  `nasipaddress` varchar(15) NOT NULL DEFAULT '',
  `nasportid` varchar(15) DEFAULT NULL,
  `nasporttype` varchar(32) DEFAULT NULL,
  `acctstarttime` datetime DEFAULT NULL,
  `acctupdatetime` datetime DEFAULT NULL,
  `acctstoptime` datetime DEFAULT NULL,
  `acctinterval` int(12) DEFAULT NULL,
  `acctsessiontime` int(12) unsigned DEFAULT NULL,
  `acctauthentic` varchar(32) DEFAULT NULL,
  `connectinfo_start` varchar(50) DEFAULT NULL,
  `connectinfo_stop` varchar(50) DEFAULT NULL,
  `acctinputoctets` bigint(20) DEFAULT NULL,
  `acctoutputoctets` bigint(20) DEFAULT NULL,
  `calledstationid` varchar(50) NOT NULL DEFAULT '',
  `callingstationid` varchar(50) NOT NULL DEFAULT '',
  `acctterminatecause` varchar(32) NOT NULL DEFAULT '',
  `servicetype` varchar(32) DEFAULT NULL,
  `framedprotocol` varchar(32) DEFAULT NULL,
  `framedipaddress` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`radacctid`),
  UNIQUE KEY `acctuniqueid` (`acctuniqueid`),
  KEY `username` (`username`),
  KEY `framedipaddress` (`framedipaddress`),
  KEY `acctsessionid` (`acctsessionid`),
  KEY `acctsessiontime` (`acctsessiontime`),
  KEY `acctstarttime` (`acctstarttime`),
  KEY `acctinterval` (`acctinterval`),
  KEY `acctstoptime` (`acctstoptime`),
  KEY `nasipaddress` (`nasipaddress`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radacct`
--

LOCK TABLES `radacct` WRITE;
/*!40000 ALTER TABLE `radacct` DISABLE KEYS */;
/*!40000 ALTER TABLE `radacct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radattribute`
--

DROP TABLE IF EXISTS `radattribute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radattribute` (
  `att_status` int(2) NOT NULL DEFAULT '0',
  `attribute` varchar(200) NOT NULL,
  `default_value` varchar(200) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `gp_database` varchar(40) DEFAULT NULL,
  `enum_value` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`attribute`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radattribute`
--

LOCK TABLES `radattribute` WRITE;
/*!40000 ALTER TABLE `radattribute` DISABLE KEYS */;
INSERT INTO `radattribute` VALUES (1,'Acct-Interim-Interval','60','minutes','radgroupreply;','','If present in Access-Accept chilli will generate interim accounting records with the specified interval (seconds).','Accounting'),(1,'Auth-Type','Local','enum','radgroupcheck;','Local;Pam;Accept;Reject;System;EAP;','Authorization different value','Divers'),(0,'Callback-ID','','','radgroupreply;','','','Callback'),(0,'Callback-Number','','','radgroupreply;','','','Callback'),(0,'Callback-Station-ID','','','radgroupcheck;','','','Callback'),(0,'Called-Station-ID','','','radgroupcheck;','','	Set to the radiuscalled command line option or the MAC address of ChilliSpot if not present.','Divers'),(0,'Calling-Station-ID','','','radgroupcheck;','','MAC address of client','Divers'),(0,'CHAP-Challenge','','','radgroupcheck;','','Used for UAM','Divers'),(0,'CHAP-Password','','','radgroupcheck;','','Used for UAM','Divers'),(0,'ChilliSpot-MAC-Allowed','','','radgroupcheck;radgroupreply;','','For allow mac adress auth','Chillispot'),(0,'ChilliSpot-Max-Input-Octets','','','radgroupcheck;radgroupreply;','','Maximum number of octets the user is allowed to transmit. After this limit has been reached the user will be disconnected.','Chillispot'),(0,'ChilliSpot-Max-Output-Octets','','','radgroupreply;radgroupcheck;','','Maximum number of octets the user is allowed to receive. After this limit has been reached the user will be disconnected.','Chillispot'),(0,'ChilliSpot-Max-Total-Octets','','','radgroupreply;radgroupcheck;','','Maximum number of octets the user is allowed to transfer (sum of octets transmitted and received). After this limit has been reached the user will be disconnected.','Chillispot'),(0,'ChilliSpot-UAM-Allowed','','','radgroupreply;','','When received from the radius server in an RFC 2882 style configuration management message this attribute will override the uamallowed command line option.','Chillispot'),(0,'EAP-Message','','','radgroupreply;','','','EAP'),(0,'Fall-Through','1','','radgroupreply;','','','Divers'),(0,'Filter-ID','','','radgroupreply;','','','Divers'),(0,'Framed-Compression','Van-Jacobsen-Header-Compression','','radgroupreply;','None;Van-Jacobson-TCP-IP;Van-Jacobsen-Header-Compression;IPX-Header-Compression;Stac-LZS-Compression;','','Framed'),(0,'Framed-IP-Address','','','radgroupreply;','','','Framed'),(0,'Framed-IP-Netmask','','','radgroupreply;','','','Framed'),(0,'Framed-IPX-Network','','','radgroupreply;','','','Framed'),(0,'Framed-MTU','','','radgroupreply;','','','Framed'),(0,'Framed-Protocol','PPP','','radgroupreply;','PPP;SLIP;ARAP;Gandalf SLP/MLP;Xylogics IPX/SIP;X.75 Synchronous;','','Framed'),(0,'Framed-Route','','','radgroupreply;','','','Framed'),(0,'Framed-Routing','','','radgroupreply;','Broadcast routing tables and notifications;Listen for routing notification broadcasts;Broadcast and listen for notifications;','','Framed'),(1,'Idle-Timeout','600','minutes','radgroupreply;','','Logout once idle timeout is reached (seconds)','Divers'),(0,'Login-IP-Host','','','radgroupreply;','','','Login'),(0,'Login-LAT-Group','','','radgroupreply;','','','Login'),(0,'Login-LAT-Node','','','radgroupreply;','','','Login'),(0,'Login-LAT-Port','','','radgroupreply;','','','Login'),(0,'Login-Service','','','radgroupreply;','Telnet;Rlogin;Tcp Clear;PortMaster;LAT;X25-PAD;X25-T3POS;Tcp Clear Quiet;','','Login'),(0,'Login-TCP-Port','','','radgroupreply;','','','Login'),(1,'Max-All-Session','14400','hours','radgroupcheck;','','','Divers'),(1,'Max-Daily-Session','14400','hours','radgroupcheck;','','','Divers'),(0,'MS-MPPE-Recv-Key','','','radgroupreply;','','','Mppe'),(0,'MS-MPPE-Send-Key','','','radgroupreply;','','User for wpa','Mppe'),(0,'NAS-ID','','','radgroupcheck;','','Set to radiusnasid option if present.','Nas'),(0,'NAS-IP-Address','','','radgroupcheck;','','IP address of Chilli (set by the radiusnasip or radiuslisten option).IP address of Chilli (set by the radiusnasip or radiuslisten option). If neither radiuslisten nor nasipaddress are set NAS-IP-Address is set to \"0.0.0.0\". ','Nas'),(0,'NAS-Port-Type','','','radgroupcheck;','Wireless-IEEE-802.11;','','Nas'),(0,'Port-Limit','','','radgroupreply;','','','Divers'),(0,'Reply-Message','','','radgroupreply;','','String returned to the user','Divers'),(1,'Service-Type','Login','enum','radgroupreply;','Login-User;Framed;Callback Login;Callback Framed;Outbound;Administrative;NAS Prompt;Authenticate Only;Callback NAS Prompt;Call Check;Callback Administrative;','Network service','Divers'),(1,'Session-Timeout','7200','hours','radgroupreply;radgroupcheck;','','Logout once session timeout is reached (seconds)','Divers'),(1,'Simultaneous-Use','1','enum','radgroupreply;radgroupcheck;','0;1;','','Divers'),(0,'Tunnel-Medium-Type','IPv4','','radgroupreply;','IPv4;IPv6;NSAP;HDLC;BBN 1822;802;E.163;E.164;F.69;X.121;IPX;Appletalk;Decnet IV;Banyan Vines; E164 with NSAP format subaddress;','','Tunnel'),(0,'Tunnel-Password','','','radgroupreply;','','','Tunnel'),(0,'Tunnel-Type','','','radgroupreply;','Point-to-Point Tunneling Protocol;Layer Two Forwarding;Layer Two Tunneling Protocol;Ascend Tunnel Manaement Protocol;Virtual Tunneling Protocol;IP Authentification Header in the Tunnel-mode;IP-in-IP Encapsulation;Minimal IP-in-IP Encapsulation;IP Encapsul','','Tunnel'),(0,'WISPr-Bandwidth-Max-Down','4194304','bits','radgroupreply;','','Maximum receive rate (b/s). Limits the bandwidth of the connection. Note that this attribute is specified in bits per second.','Wispr'),(0,'WISPr-Bandwidth-Max-Up','2097152','bits','radgroupreply;','','Maximum transmit rate (b/s). Limits the bandwidth of the connection. Note that this attribute is specified in bits per second.','Wispr'),(0,'WISPr-Location-ID','','','radgroupcheck;','','Location ID is set to the radiuslocationid option if present. Should be in the format: isocc=<ISO_Country_Code>, cc=<E.164_Country_Code>,ac=<E.164_Area_Code>,network=<ssid/ZONE>','Wispr'),(0,'WISPr-Location-Name','','','radgroupcheck;','','Location Name is set to the radiuslocationname option if present. Should be in the format: <HOTSPOT_OPERATOR_NAME>,<LOCATION>','Wispr'),(0,'WISPr-Logoff-URL','','','radgroupreply;','','Chilli includes this attribute in Access-Request messages in order to notify the operator of the log off URL to use for logging off clients. Defaults to \"http://192.168.182.1:3990/logoff\"','Wispr'),(1,'WISPr-Redirection-URL','http://www.pixpros.net','text','radgroupreply;','','If present the client will be redirected to this URL once authenticated. This URL should include a link to WISPr-Logoff-URL in order to enable the client to log off.','Wispr'),(0,'WISPr-Session-Terminate-Time','','','radgroupreply;','','The time when the user should be disconnected in ISO 8601 format (YYYY-MM-DDThh:mm:ssTZD). If TZD is not specified local time is assumed. For example a disconnect on 18 December 2001 at 7:00 PM UTC would be specified as 2001-12-18T19:00:00+00:00.','Wispr');
/*!40000 ALTER TABLE `radattribute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radcheck`
--

DROP TABLE IF EXISTS `radcheck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radcheck` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT ':=',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB AUTO_INCREMENT=390 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radcheck`
--

LOCK TABLES `radcheck` WRITE;
/*!40000 ALTER TABLE `radcheck` DISABLE KEYS */;
INSERT INTO `radcheck` VALUES (19,'admin','Cleartext-Password',':=','123456'),(205,'office1','Cleartext-Password',':=','123456'),(336,'t1','Cleartext-Password',':=','123456'),(338,'adm','Cleartext-Password',':=','123456'),(371,'st9','Cleartext-Password',':=','123456'),(389,'adm1','Cleartext-Password',':=','123456');
/*!40000 ALTER TABLE `radcheck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radgroupcheck`
--

DROP TABLE IF EXISTS `radgroupcheck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radgroupcheck` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT ':=',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB AUTO_INCREMENT=239 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radgroupcheck`
--

LOCK TABLES `radgroupcheck` WRITE;
/*!40000 ALTER TABLE `radgroupcheck` DISABLE KEYS */;
INSERT INTO `radgroupcheck` VALUES (201,'grp-16-07-2017-03-18-38','Simultaneous-Use',':=','1'),(202,'grp-16-07-2017-03-18-38','Max-Daily-Session',':=','86400'),(205,'grp-16-07-2017-03-17-27','Simultaneous-Use',':=','1'),(206,'grp-16-07-2017-03-17-27','Max-Daily-Session',':=','28800'),(210,'register','Simultaneous-Use',':=','1'),(211,'register','Max-Daily-Session',':=','28800'),(220,'office','Simultaneous-Use',':=','1'),(221,'office','Max-Daily-Session',':=','72000'),(223,'group20170718021701','Simultaneous-Use',':=','1'),(224,'group20170718021701','Max-Daily-Session',':=','28800'),(230,'group-20180927071220','Simultaneous-Use',':=','1'),(231,'group-20180927071220','Max-Daily-Session',':=','28800'),(236,'admin','Simultaneous-Use',':=','1'),(237,'admin','Max-Daily-Session',':=','86400'),(238,'register','Auth-Type',':=','Reject');
/*!40000 ALTER TABLE `radgroupcheck` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radgroupreply`
--

DROP TABLE IF EXISTS `radgroupreply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radgroupreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT ':=',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `groupname` (`groupname`(32))
) ENGINE=InnoDB AUTO_INCREMENT=559 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radgroupreply`
--

LOCK TABLES `radgroupreply` WRITE;
/*!40000 ALTER TABLE `radgroupreply` DISABLE KEYS */;
INSERT INTO `radgroupreply` VALUES (488,'grp-16-07-2017-03-18-38','Service-Type',':=','Login-User'),(489,'grp-16-07-2017-03-18-38','Acct-Interim-Interval',':=','60'),(490,'grp-16-07-2017-03-18-38','Idle-Timeout',':=','1800'),(491,'grp-16-07-2017-03-18-38','Session-Timeout',':=','28800'),(492,'grp-16-07-2017-03-18-38','WISPr-Redirection-URL',':=','http://www.phoubon.in.th'),(493,'grp-16-07-2017-03-18-38','WISPr-Bandwidth-Max-Down',':=','10485760'),(494,'grp-16-07-2017-03-18-38','WISPr-Bandwidth-Max-Up',':=','10485760'),(502,'grp-16-07-2017-03-17-27','Service-Type',':=','Login-User'),(503,'grp-16-07-2017-03-17-27','Acct-Interim-Interval',':=','60'),(504,'grp-16-07-2017-03-17-27','Idle-Timeout',':=','1200'),(505,'grp-16-07-2017-03-17-27','Session-Timeout',':=','14400'),(506,'grp-16-07-2017-03-17-27','WISPr-Redirection-URL',':=','http://www.phoubon.in.th'),(507,'grp-16-07-2017-03-17-27','WISPr-Bandwidth-Max-Down',':=','5120000'),(508,'grp-16-07-2017-03-17-27','WISPr-Bandwidth-Max-Up',':=','5120000'),(516,'register','Service-Type',':=','Login-User'),(517,'register','Acct-Interim-Interval',':=','60'),(518,'register','Idle-Timeout',':=','900'),(519,'register','Session-Timeout',':=','14400'),(520,'register','WISPr-Redirection-URL',':=','http://www.phoubon.in.th'),(521,'register','WISPr-Bandwidth-Max-Down',':=','1048576'),(522,'register','WISPr-Bandwidth-Max-Up',':=','524288'),(528,'office','Service-Type',':=','Login-User'),(529,'office','Acct-Interim-Interval',':=','60'),(530,'office','Idle-Timeout',':=','1800'),(531,'office','Session-Timeout',':=','28800'),(532,'office','WISPr-Redirection-URL',':=','http://www.phoubon.in.th'),(533,'office','WISPr-Bandwidth-Max-Down',':=','2097152'),(534,'office','WISPr-Bandwidth-Max-Up',':=','2097152'),(535,'group20170718021701','Service-Type',':=','Login-User'),(536,'group20170718021701','Acct-Interim-Interval',':=','300'),(537,'group20170718021701','Idle-Timeout',':=','900'),(538,'group20170718021701','Session-Timeout',':=','14400'),(539,'group20170718021701','WISPr-Redirection-URL',':=','http://www.google.com'),(540,'group20170718021701','WISPr-Bandwidth-Max-Down',':=','8192000'),(541,'group20170718021701','WISPr-Bandwidth-Max-Up',':=','5120000'),(542,'group-20180927071220','Service-Type',':=','Login-User'),(543,'group-20180927071220','Acct-Interim-Interval',':=','300'),(544,'group-20180927071220','Idle-Timeout',':=','900'),(545,'group-20180927071220','Session-Timeout',':=','14400'),(546,'group-20180927071220','WISPr-Redirection-URL',':=','http://www.google.com'),(547,'group-20180927071220','WISPr-Bandwidth-Max-Down',':=','5120000'),(548,'group-20180927071220','WISPr-Bandwidth-Max-Up',':=','3072000'),(554,'admin','Service-Type',':=','Login-User'),(555,'admin','Acct-Interim-Interval',':=','300'),(556,'admin','Idle-Timeout',':=','1800'),(557,'admin','Session-Timeout',':=','28800'),(558,'admin','WISPr-Redirection-URL',':=','http://www.phoubon.in.th');
/*!40000 ALTER TABLE `radgroupreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radippool`
--

DROP TABLE IF EXISTS `radippool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radippool` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pool_name` varchar(30) NOT NULL,
  `framedipaddress` varchar(15) NOT NULL DEFAULT '',
  `nasipaddress` varchar(15) NOT NULL DEFAULT '',
  `calledstationid` varchar(30) NOT NULL,
  `callingstationid` varchar(30) NOT NULL,
  `expiry_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(64) NOT NULL DEFAULT '',
  `pool_key` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radippool`
--

LOCK TABLES `radippool` WRITE;
/*!40000 ALTER TABLE `radippool` DISABLE KEYS */;
/*!40000 ALTER TABLE `radippool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radpostauth`
--

DROP TABLE IF EXISTS `radpostauth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radpostauth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `pass` varchar(64) NOT NULL DEFAULT '',
  `reply` varchar(32) NOT NULL DEFAULT '',
  `authdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radpostauth`
--

LOCK TABLES `radpostauth` WRITE;
/*!40000 ALTER TABLE `radpostauth` DISABLE KEYS */;
/*!40000 ALTER TABLE `radpostauth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radreply`
--

DROP TABLE IF EXISTS `radreply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radreply` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '=',
  `value` varchar(253) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `username` (`username`(32))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radreply`
--

LOCK TABLES `radreply` WRITE;
/*!40000 ALTER TABLE `radreply` DISABLE KEYS */;
/*!40000 ALTER TABLE `radreply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `radusergroup`
--

DROP TABLE IF EXISTS `radusergroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `radusergroup` (
  `username` varchar(64) NOT NULL DEFAULT '',
  `groupname` varchar(64) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`username`),
  KEY `groupname` (`groupname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `radusergroup`
--

LOCK TABLES `radusergroup` WRITE;
/*!40000 ALTER TABLE `radusergroup` DISABLE KEYS */;
INSERT INTO `radusergroup` VALUES ('adm','group20170718021701',1),('adm1','admin',1),('admin','admin',1),('office1','office',1),('st9','grp-16-07-2017-03-17-27',1),('t1','grp-16-07-2017-03-18-38',1);
/*!40000 ALTER TABLE `radusergroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wimax`
--

DROP TABLE IF EXISTS `wimax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wimax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL DEFAULT '',
  `authdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `spi` varchar(16) NOT NULL DEFAULT '',
  `mipkey` varchar(400) NOT NULL DEFAULT '',
  `lifetime` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `spi` (`spi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wimax`
--

LOCK TABLES `wimax` WRITE;
/*!40000 ALTER TABLE `wimax` DISABLE KEYS */;
/*!40000 ALTER TABLE `wimax` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-06  1:53:39
