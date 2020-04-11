-- MariaDB dump 10.17  Distrib 10.4.8-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_grs
-- ------------------------------------------------------
-- Server version	10.4.8-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` longblob DEFAULT NULL,
  `filename` varchar(200) COLLATE ascii_bin DEFAULT NULL,
  `size` double DEFAULT NULL,
  `mime` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  `uid` varchar(50) COLLATE ascii_bin DEFAULT NULL,
  `guid` varchar(50) COLLATE ascii_bin DEFAULT NULL COMMENT 'Grievance uid',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grantees`
--

DROP TABLE IF EXISTS `grantees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grantees` (
  `GRANTEE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `HOUSEHOLD_ID` varchar(25) COLLATE ascii_bin NOT NULL,
  `ENTRY_ID` double NOT NULL,
  PRIMARY KEY (`GRANTEE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `grievances`
--

DROP TABLE IF EXISTS `grievances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grievances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FIRSTNAME` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  `MIDDLENAME` varchar(50) COLLATE ascii_bin DEFAULT NULL,
  `LASTNAME` varchar(50) COLLATE ascii_bin DEFAULT NULL,
  `EXT` varchar(3) COLLATE ascii_bin DEFAULT NULL,
  `PSGC` varchar(9) COLLATE ascii_bin DEFAULT NULL,
  `ADDRESS` text COLLATE ascii_bin DEFAULT NULL,
  `CONTACTNO` varchar(50) COLLATE ascii_bin DEFAULT NULL,
  `EMAIL` varchar(50) COLLATE ascii_bin DEFAULT NULL,
  `GRS_TYPE` int(11) DEFAULT NULL,
  `DESCRIPTION` text COLLATE ascii_bin DEFAULT NULL,
  `EOOB` int(11) DEFAULT NULL,
  `DATE_REPORTED` date DEFAULT NULL,
  `GRS_SOURCE` int(11) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `DATE_SUBMITTED` date DEFAULT NULL,
  `DATE_RESOLVED` date DEFAULT NULL,
  `ENCODED_BY` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  `DATE_ENCODED` datetime DEFAULT NULL,
  `Remarks` text COLLATE ascii_bin DEFAULT NULL,
  `uid` varchar(50) COLLATE ascii_bin DEFAULT NULL,
  `docid` varchar(50) COLLATE ascii_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` blob DEFAULT NULL,
  `description` varchar(50) COLLATE ascii_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lib_eoob`
--

DROP TABLE IF EXISTS `lib_eoob`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lib_eoob` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eoob` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lib_grssource`
--

DROP TABLE IF EXISTS `lib_grssource`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lib_grssource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(300) COLLATE ascii_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lib_grssubtype`
--

DROP TABLE IF EXISTS `lib_grssubtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lib_grssubtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `subtype` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  `withrem` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lib_grstype`
--

DROP TABLE IF EXISTS `lib_grstype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lib_grstype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grs_type` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lib_psgc`
--

DROP TABLE IF EXISTS `lib_psgc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lib_psgc` (
  `PSGC` int(11) NOT NULL AUTO_INCREMENT,
  `REGION` varchar(255) DEFAULT NULL,
  `PROVINCE` varchar(255) DEFAULT NULL,
  `MUNICIPALITY` varchar(255) DEFAULT NULL,
  `BARANGAY` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`PSGC`)
) ENGINE=InnoDB AUTO_INCREMENT=153617144 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lib_status`
--

DROP TABLE IF EXISTS `lib_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lib_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(200) COLLATE ascii_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mode`
--

DROP TABLE IF EXISTS `mode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mode` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ohm` text DEFAULT NULL,
  `class` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  `desciption` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `roster`
--

DROP TABLE IF EXISTS `roster`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roster` (
  `REGION` varchar(255) DEFAULT NULL,
  `PROVINCE` varchar(255) DEFAULT NULL,
  `MUNICIPALITY` varchar(255) DEFAULT NULL,
  `BARANGAY` varchar(255) DEFAULT NULL,
  `PUROK` varchar(255) DEFAULT NULL,
  `ADDRESS` varchar(255) DEFAULT NULL,
  `HOUSEHOLD_ID` varchar(255) DEFAULT NULL,
  `ENTRY_ID` double NOT NULL,
  `LAST_NAME` varchar(255) DEFAULT NULL,
  `FIRST_NAME` varchar(255) DEFAULT NULL,
  `MID_NAME` varchar(255) DEFAULT NULL,
  `EXT_NAME` varchar(255) DEFAULT NULL,
  `HH_GRANTEE` varchar(255) DEFAULT NULL,
  `CHILD_BENE` varchar(255) DEFAULT NULL,
  `MONITORED_EDUC` varchar(255) DEFAULT NULL,
  `BIRTHDAY` date DEFAULT NULL,
  `AGE` int(11) DEFAULT NULL,
  `REL_HH` varchar(255) DEFAULT NULL,
  `SEX` varchar(255) DEFAULT NULL,
  `PREGNANT_STATUS` varchar(255) DEFAULT NULL,
  `DISABLED` varchar(255) DEFAULT NULL,
  `ATTEND_SCHOOL` varchar(255) DEFAULT NULL,
  `REASON_FOR_NOT_ATTENDING` varchar(255) DEFAULT NULL,
  `DATE_REASON` date DEFAULT NULL,
  `GRADE_LEVEL` varchar(255) DEFAULT NULL,
  `SCHOOL_NAME` varchar(255) DEFAULT NULL,
  `DOMINANT_SCHOOL` varchar(255) DEFAULT NULL,
  `HC_NAME` varchar(255) DEFAULT NULL,
  `REGISTERED` varchar(255) DEFAULT NULL,
  `CLIENT_STATUS` varchar(255) DEFAULT NULL,
  `MEMBER_STATUS` varchar(255) DEFAULT NULL,
  `IP_AFFILIATION` varchar(255) DEFAULT NULL,
  `MODE_OF_PAYMENT` varchar(255) DEFAULT NULL,
  `HH_SET` int(11) DEFAULT NULL,
  `SET_GROUP` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ENTRY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(80) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `assignment` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `approved` int(11) DEFAULT 0,
  `status` varchar(20) DEFAULT 'Active',
  `picture` longblob DEFAULT NULL,
  `picture_size` varchar(40) DEFAULT NULL,
  `picture_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-11 20:19:25
