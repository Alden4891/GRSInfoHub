/*
SQLyog Ultimate v8.55 
MySQL - 5.5.5-10.4.8-MariaDB : Database - db_grs
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_grs` /*!40100 DEFAULT CHARACTER SET ascii COLLATE ascii_bin */;

USE `db_grs`;

/*Table structure for table `grantees` */

DROP TABLE IF EXISTS `grantees`;

CREATE TABLE `grantees` (
  `GRANTEE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `HOUSEHOLD_ID` varchar(25) COLLATE ascii_bin NOT NULL,
  `ENTRY_ID` double NOT NULL,
  PRIMARY KEY (`GRANTEE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

/*Table structure for table `grievances` */

DROP TABLE IF EXISTS `grievances`;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=ascii COLLATE=ascii_bin;

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` blob DEFAULT NULL,
  `description` varchar(50) COLLATE ascii_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

/*Table structure for table `lib_eoob` */

DROP TABLE IF EXISTS `lib_eoob`;

CREATE TABLE `lib_eoob` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eoob` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `lib_grssource` */

DROP TABLE IF EXISTS `lib_grssource`;

CREATE TABLE `lib_grssource` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` varchar(300) COLLATE ascii_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=ascii COLLATE=ascii_bin;

/*Table structure for table `lib_grstype` */

DROP TABLE IF EXISTS `lib_grstype`;

CREATE TABLE `lib_grstype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grs_type` varchar(100) COLLATE ascii_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=ascii COLLATE=ascii_bin;

/*Table structure for table `lib_psgc` */

DROP TABLE IF EXISTS `lib_psgc`;

CREATE TABLE `lib_psgc` (
  `PSGC` int(11) NOT NULL AUTO_INCREMENT,
  `REGION` varchar(255) DEFAULT NULL,
  `PROVINCE` varchar(255) DEFAULT NULL,
  `MUNICIPALITY` varchar(255) DEFAULT NULL,
  `BARANGAY NAME` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`PSGC`)
) ENGINE=InnoDB AUTO_INCREMENT=153617144 DEFAULT CHARSET=utf8;

/*Table structure for table `lib_status` */

DROP TABLE IF EXISTS `lib_status`;

CREATE TABLE `lib_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(200) COLLATE ascii_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=ascii COLLATE=ascii_bin;

/*Table structure for table `mode` */

DROP TABLE IF EXISTS `mode`;

CREATE TABLE `mode` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ohm` text DEFAULT NULL,
  `class` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  `desciption` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `roster` */

DROP TABLE IF EXISTS `roster`;

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

/*Table structure for table `test` */

DROP TABLE IF EXISTS `test`;

CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

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

/* Procedure structure for procedure `check_table_exists` */

/*!50003 DROP PROCEDURE IF EXISTS  `check_table_exists` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `check_table_exists`(table_name VARCHAR(100))
BEGIN
    DECLARE CONTINUE HANDLER FOR SQLSTATE '42S02' SET @err = 1;
    SET @err = 0;
    SET @table_name = table_name;
    SET @sql_query = CONCAT('SELECT 1 FROM ',@table_name);
    PREPARE stmt1 FROM @sql_query;
    IF (@err = 1) THEN
        SET @table_exists = 0;
    ELSE
        SET @table_exists = 1;
        DEALLOCATE PREPARE stmt1;
    END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `getOtherIntervPivt` */

/*!50003 DROP PROCEDURE IF EXISTS  `getOtherIntervPivt` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `getOtherIntervPivt`(IN param1 VARCHAR(255))
BEGIN
sET @sql = NULL;
SET @row_number = 0; 
CREATE TEMPORARY TABLE new_tbl
SELECT 
CONCAT('CASE WHEN (p.program_id=',program_id,') then count(p.program_id) else 0 END as ','''col_',@row_number := @row_number + 1,'''') AS PROGRAMS
FROM lib_programs p
INNER JOIN lib_subcomp sc
ON p.subcomp_id = sc.subcomp_id
INNER JOIN lib_comp c
ON sc.comp_id = c.comp_id
WHERE c.comp_id = 5;
SET @row_number = 0; 
CREATE TEMPORARY TABLE new_tbl_col
SELECT 
CONCAT('SUM(col_',@row_number := @row_number + 1,') AS col_',@row_number) AS COLUMNX
FROM lib_programs p
INNER JOIN lib_subcomp sc
ON p.subcomp_id = sc.subcomp_id
INNER JOIN lib_comp c
ON sc.comp_id = c.comp_id
WHERE c.comp_id = 5;
set @cols = (SELECT GROUP_CONCAT(COLUMNX) FROM new_tbl_col);
SELECT GROUP_CONCAT(PROGRAMS) INTO @SQL FROM new_tbl;
    
SET @PART0  = "CREATE TEMPORARY TABLE new_tbl2"; 
SET @PART1 = " SELECT  r.REGION,  r.PROVINCE,  r.MUNICIPALITY,  r.BARANGAY,  r.HOUSEHOLD_ID,  r.LAST_NAME,  r.FIRST_NAME,  r.MID_NAME,  r.EXT_NAME,  r.SEX,  i.yds_child_count AS 'YDS', ";
SET @PART2 = @SQL;
SET @PART3 = " ,COUNT(p.program_id) AS TOTAL FROM `db_grs`.`grantees` g  INNER JOIN `db_grs`.`roster` r    ON (g.`ENTRY_ID` = r.`ENTRY_ID`)  INNER JOIN `db_grs`.intervensions i    ON (i.HOUSEHOLD_ID = g.HOUSEHOLD_ID) INNER JOIN `db_grs`.lib_programs p    ON (i.program_id = p.program_id)  INNER JOIN `db_grs`.lib_subcomp sc    ON (p.subcomp_id=sc.subcomp_id) " ;
SET @PART4 = concat(" WHERE  " , param1 ," AND sc.comp_id = 5 ");
SET @PART5 = " GROUP BY r.HOUSEHOLD_ID,p.program_id ORDER BY 1,2 LIMIT 0, 1000;";
SET @SQL = CONCAT(@PART0,@PART1,@PART2,@PART3,@PART4,@PART5);
PREPARE stmt1 FROM @SQL;
EXECUTE stmt1;
 
set @P1 = "SELECT REGION,PROVINCE,MUNICIPALITY,BARANGAY,HOUSEHOLD_ID,LAST_NAME,FIRST_NAME,MID_NAME,EXT_NAME,SEX,YDS, ";
set @P2 = @cols;
SET @P3 = ",SUM(TOTAL)  AS TOTAL";
SET @P4 = " FROM new_tbl2";
SET @P5 = " GROUP BY REGION,PROVINCE,MUNICIPALITY,BARANGAY,HOUSEHOLD_ID,LAST_NAME,FIRST_NAME,MID_NAME,EXT_NAME,SEX,YDS ;";
SET @SQL2=CONCAT(@P1,@P2,@P3,@P4,@P5);
PREPARE stmt2 FROM @SQL2;
EXECUTE stmt2;
DROP TEMPORARY TABLE new_tbl;
DROP TEMPORARY TABLE new_tbl2;
DROP TEMPORARY TABLE new_tbl_col;
    
    
    
    
END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_mode` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_mode` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_mode`()
BEGIN
/*
https://www.pornhub.com/view_video.php?viewkey=ph5cf5300f01150
https://www.pornhub.com/view_video.php?viewkey=ph5de30cb6243b1
https://www.pornhub.com/view_video.php?viewkey=ph5dca2a4770d3a
https://www.pornhub.com/view_video.php?viewkey=ph5d42cb7711564
https://www.pornhub.com/view_video.php?viewkey=ph5e1d9beada40e
https://www.pornhub.com/view_video.php?viewkey=ph5de009bf532d5
https://www.pornhub.com/view_video.php?viewkey=ph5e3888a7a7601
https://www.pornhub.com/view_video.php?viewkey=ph5e65ae56c6f31
https://www.pornhub.com/view_video.php?viewkey=ph5caf8080eb7fc
https://www.pornhub.com/view_video.php?viewkey=ph5e4e9217d86fc
https://www.pornhub.com/view_video.php?viewkey=ph5dc2d24c267e5
https://www.pornhub.com/view_video.php?viewkey=ph5e5b85320de6e
https://www.pornhub.com/view_video.php?viewkey=ph5df96ec41f4c8
https://www.pornhub.com/view_video.php?viewkey=ph5e0100c4d9934
https://www.pornhub.com/view_video.php?viewkey=ph5e70eb6384453
https://www.pornhub.com/view_video.php?viewkey=ph5cec4214df72b
https://www.pornhub.com/view_video.php?viewkey=ph5e2bc0041ee5c
https://www.pornhub.com/view_video.php?viewkey=ph5e455c24237de
https://www.pornhub.com/view_video.php?viewkey=ph5e66dbe948440
https://www.pornhub.com/view_video.php?viewkey=ph5910cd225c83f
https://www.pornhub.com/view_video.php?viewkey=ph5e600b241f909
https://www.pornhub.com/view_video.php?viewkey=ph5db3b2af48f4c
https://www.pornhub.com/view_video.php?viewkey=ph5d5c7a5deeea0
https://www.pornhub.com/view_video.php?viewkey=ph5e518de92dcea
https://www.pornhub.com/view_video.php?viewkey=ph5e6e337d3346d
https://www.pornhub.com/view_video.php?viewkey=ph5e7029ecd9aa2
https://www.pornhub.com/view_video.php?viewkey=ph5e5fbf0aba589
https://www.pornhub.com/view_video.php?viewkey=ph5e5c29368b7b2
https://www.pornhub.com/view_video.php?viewkey=ph5e70cf1dc487a
https://www.pornhub.com/view_video.php?viewkey=ph5c97215fdfb6e
https://www.pornhub.com/view_video.php?viewkey=ph5e6ceeae0fcb3
https://www.pornhub.com/view_video.php?viewkey=ph5b8cfcdd1ca75
https://www.pornhub.com/view_video.php?viewkey=ph5e2fb8a09b787
https://www.pornhub.com/view_video.php?viewkey=ph5e4284d1e11b3
https://www.pornhub.com/view_video.php?viewkey=ph5c571e634ffa4
https://www.pornhub.com/view_video.php?viewkey=ph5e711e065126b
https://www.pornhub.com/view_video.php?viewkey=ph5e651880e8972
https://www.pornhub.com/view_video.php?viewkey=ph5caab42712f7f
https://www.pornhub.com/view_video.php?viewkey=ph5e6e32cc7475d
https://www.pornhub.com/view_video.php?viewkey=ph589197f96c5c7
https://www.pornhub.com/view_video.php?viewkey=ph5aefb44e61cac
https://www.pornhub.com/view_video.php?viewkey=ph5e631102c84df
https://www.pornhub.com/view_video.php?viewkey=ph5e6e7894bb915
https://www.pornhub.com/view_video.php?viewkey=ph5e5af574e5ab5
https://www.pornhub.com/view_video.php?viewkey=ph5e2dbad42104c
https://www.pornhub.com/view_video.php?viewkey=ph5b7f1e67ba6f6
https://www.pornhub.com/view_video.php?viewkey=ph5e6405433fd4f
https://www.pornhub.com/view_video.php?viewkey=ph5c9723fe4d563
https://www.pornhub.com/view_video.php?viewkey=ph5d59eb0dee94d
https://www.pornhub.com/view_video.php?viewkey=ph5d59eabe3221a
https://www.pornhub.com/view_video.php?viewkey=ph5d5f9d9cc736c
https://www.pornhub.com/view_video.php?viewkey=ph5d28d82eb8849
https://www.pornhub.com/view_video.php?viewkey=ph5d97f33429f01
https://www.pornhub.com/view_video.php?viewkey=ph5d59eae1e9b90
https://www.pornhub.com/view_video.php?viewkey=361927838
https://www.pornhub.com/view_video.php?viewkey=ph5dad6cbe9b5d5
https://www.pornhub.com/view_video.php?viewkey=ph5c98e964c168d
https://www.pornhub.com/view_video.php?viewkey=ph57b972f7ea896
https://www.pornhub.com/view_video.php?viewkey=ph5e6a6f41dcf7e
https://www.pornhub.com/view_video.php?viewkey=ph5e321ec44a08b
https://www.pornhub.com/view_video.php?viewkey=ph5e6d6cae64e03
https://www.pornhub.com/view_video.php?viewkey=ph5e6c30d29e649
https://www.pornhub.com/view_video.php?viewkey=ph5c360c9f4217f
https://www.pornhub.com/view_video.php?viewkey=ph5e5370aae9415
https://www.pornhub.com/view_video.php?viewkey=ph5b86f1b07b609
https://www.pornhub.com/view_video.php?viewkey=ph5926bce651f30
https://www.pornhub.com/view_video.php?viewkey=ph5cc8ffb3c51fa
https://www.pornhub.com/view_video.php?viewkey=ph5cc88c7e05e73
https://www.pornhub.com/view_video.php?viewkey=ph5d53e36fec19b
https://www.pornhub.com/view_video.php?viewkey=ph5d6db6ab344f3
https://www.pornhub.com/view_video.php?viewkey=ph5d03f5a66b22c
https://www.pornhub.com/view_video.php?viewkey=ph5e5e7465398fc
https://www.pornhub.com/view_video.php?viewkey=ph5a6d31dd5ae64
https://www.pornhub.com/view_video.php?viewkey=ph588bb51d4da74
https://www.pornhub.com/view_video.php?viewkey=ph5e5d71ee4283c
https://www.pornhub.com/view_video.php?viewkey=ph5e582d4eba5c8
https://www.pornhub.com/view_video.php?viewkey=ph5e0f9bb1cf035
https://www.pornhub.com/view_video.php?viewkey=ph5e596287ab023
https://www.pornhub.com/view_video.php?viewkey=ph5cad742d09ab1
https://www.pornhub.com/view_video.php?viewkey=ph5bebbbb981ca9
https://www.pornhub.com/view_video.php?viewkey=ph5dec464e25d3a
https://www.pornhub.com/view_video.php?viewkey=ph5cb33c0a06b57
https://www.pornhub.com/view_video.php?viewkey=ph5a6d36441ef61
https://www.pornhub.com/view_video.php?viewkey=ph5e37ed2da262b
https://www.pornhub.com/view_video.php?viewkey=ph5e492b5679f0a
https://www.pornhub.com/view_video.php?viewkey=ph586b178a41583
https://www.pornhub.com/view_video.php?viewkey=ph5ded7020c5d1b
https://www.pornhub.com/view_video.php?viewkey=ph5e67f416de0e3
https://www.pornhub.com/view_video.php?viewkey=ph5ccea718019b0
https://www.pornhub.com/view_video.php?viewkey=ph5cbc2fdece0e5
https://www.pornhub.com/view_video.php?viewkey=ph5e6bc8b810964
https://www.pornhub.com/view_video.php?viewkey=ph5e6adff7c8332
https://www.pornhub.com/view_video.php?viewkey=805222005
https://www.pornhub.com/view_video.php?viewkey=ph5e0e389f79011
https://www.pornhub.com/view_video.php?viewkey=ph5db79c688e016
https://www.pornhub.com/view_video.php?viewkey=ph5b30807456e7c
https://www.pornhub.com/view_video.php?viewkey=ph5ada377c27313
https://www.pornhub.com/view_video.php?viewkey=ph5e5fded390878
https://www.pornhub.com/view_video.php?viewkey=ph5e6ec9f053bd8
https://www.pornhub.com/view_video.php?viewkey=ph5e38e72dbacec
https://www.pornhub.com/view_video.php?viewkey=ph5d91ba2ba018d
https://www.pornhub.com/view_video.php?viewkey=ph5e6f9789c2825
https://www.pornhub.com/view_video.php?viewkey=ph5e521a025829d
https://www.pornhub.com/view_video.php?viewkey=ph5e70dcd92f22a
https://www.pornhub.com/view_video.php?viewkey=ph5e6e61f29f0d5
https://www.pornhub.com/view_video.php?viewkey=ph5e6df90771a08
https://www.pornhub.com/view_video.php?viewkey=ph5cdd6116c5cb2
https://www.pornhub.com/view_video.php?viewkey=ph5e372e1b231d7
https://www.pornhub.com/view_video.php?viewkey=ph5e6eaf5fbacd6
https://www.pornhub.com/view_video.php?viewkey=ph5e60b55345dd0
https://www.pornhub.com/view_video.php?viewkey=ph5e52ed4953a26
https://www.pornhub.com/view_video.php?viewkey=ph5c98f2c25ba1c
https://www.pornhub.com/view_video.php?viewkey=ph5c96381546f5e
https://www.pornhub.com/view_video.php?viewkey=ph592f6a92572ad
https://www.pornhub.com/view_video.php?viewkey=ph5e47ca0f48f3a
https://www.pornhub.com/view_video.php?viewkey=ph55f4f8121a0ae
https://www.pornhub.com/view_video.php?viewkey=ph5cc5b5881e2c5
https://www.pornhub.com/view_video.php?viewkey=ph5ca8c69fd476c
https://www.pornhub.com/view_video.php?viewkey=ph5ca918972aa77
https://www.pornhub.com/view_video.php?viewkey=ph5ca8c5946bc89
https://www.pornhub.com/view_video.php?viewkey=ph5b26544080398
https://www.pornhub.com/view_video.php?viewkey=ph5e650e395e802
https://www.pornhub.com/view_video.php?viewkey=ph57a4ccc96e667
https://www.pornhub.com/view_video.php?viewkey=ph5e6eaa0901bb3
https://www.pornhub.com/view_video.php?viewkey=330083968
https://www.pornhub.com/view_video.php?viewkey=ph588bb51d48472
https://www.pornhub.com/view_video.php?viewkey=ph5e6d00e710c6a
https://www.pornhub.com/view_video.php?viewkey=ph5c85617a2c132
https://www.pornhub.com/view_video.php?viewkey=ph5c0d398cd2167
https://www.pornhub.com/view_video.php?viewkey=ph5d864e084088e
https://www.pornhub.com/view_video.php?viewkey=ph5a7f0d202c090
https://www.pornhub.com/view_video.php?viewkey=ph5c1610a71650d
https://www.pornhub.com/view_video.php?viewkey=ph5e6cfbe172a57
https://www.pornhub.com/view_video.php?viewkey=ph5e56c93555f52
https://www.pornhub.com/view_video.php?viewkey=ph5b143c492beb6
https://www.pornhub.com/view_video.php?viewkey=ph5bbceba10f5e2
https://www.pornhub.com/view_video.php?viewkey=ph5e64751912f14
https://www.pornhub.com/view_video.php?viewkey=ph5e6b14a822a51
https://www.pornhub.com/view_video.php?viewkey=ph5e601da87a4fe
https://www.pornhub.com/view_video.php?viewkey=ph5e59ad48c25c8
https://www.pornhub.com/view_video.php?viewkey=ph5e5e23f97c866
https://www.pornhub.com/view_video.php?viewkey=ph5e5bb865da9c1
https://www.pornhub.com/view_video.php?viewkey=ph59ea1e0c2d6df
https://www.pornhub.com/view_video.php?viewkey=ph57a5c4f419c34
https://www.pornhub.com/view_video.php?viewkey=ph5e446a07f3a48
https://www.pornhub.com/view_video.php?viewkey=ph5c1c419929f35
https://www.pornhub.com/view_video.php?viewkey=ph5a90f3cf2eabd
https://www.pornhub.com/view_video.php?viewkey=ph5b5858181318a
https://www.pornhub.com/view_video.php?viewkey=ph5e430255dc568
https://www.pornhub.com/view_video.php?viewkey=ph5adab6a8d28fe
https://www.pornhub.com/view_video.php?viewkey=ph5e15147ca07d5
https://www.pornhub.com/view_video.php?viewkey=ph5e1c6b6c8872e
https://www.pornhub.com/view_video.php?viewkey=ph5bb4dceb122ef
https://www.pornhub.com/view_video.php?viewkey=ph5bb28c8c9c3c8
https://www.pornhub.com/view_video.php?viewkey=ph5e20278aa0800
https://www.pornhub.com/view_video.php?viewkey=ph5e0513082a854
https://www.pornhub.com/view_video.php?viewkey=ph5e366b422c2f2
https://www.pornhub.com/view_video.php?viewkey=ph5c8a7bad92f86
https://www.pornhub.com/view_video.php?viewkey=ph5e5d0fe3234d5
https://www.pornhub.com/view_video.php?viewkey=ph5b8eb4bd1c9ab
https://www.pornhub.com/view_video.php?viewkey=ph57d28794c696a
https://www.pornhub.com/view_video.php?viewkey=ph58c9324a1ebcf
https://www.pornhub.com/view_video.php?viewkey=ph5c664dc7d42ac
https://www.pornhub.com/view_video.php?viewkey=ph5981f4c1e816b
https://www.pornhub.com/view_video.php?viewkey=ph5b24391fb74c9
https://www.pornhub.com/view_video.php?viewkey=ph5d26d1b4a0efd
https://www.pornhub.com/view_video.php?viewkey=ph5e7143d4d8628
https://www.pornhub.com/view_video.php?viewkey=ph5e4b83f7c37a3
https://www.pornhub.com/view_video.php?viewkey=ph5d9dc712220dd
https://www.pornhub.com/view_video.php?viewkey=ph5e1048ac43c47
https://www.pornhub.com/view_video.php?viewkey=ph5dabf15dd3c85
https://www.pornhub.com/view_video.php?viewkey=ph5e50415a149a6
https://www.pornhub.com/view_video.php?viewkey=ph5de374c83a6bf
https://www.pornhub.com/view_video.php?viewkey=ph5cdf197a6b73d
https://www.pornhub.com/view_video.php?viewkey=ph5e3188fbb1f8f
https://www.pornhub.com/view_video.php?viewkey=ph5dfb2e3ea4f78
*/
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
