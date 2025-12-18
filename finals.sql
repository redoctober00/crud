/*
SQLyog Ultimate
MySQL - 11.8.3-MariaDB : Database - finals
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`finals` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;

USE `finals`;

/*Table structure for table `sample` */


DROP TABLE IF EXISTS `sample`;

-- CREATE TABLE `sample` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `fname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci DEFAULT NULL,
--   `mname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci DEFAULT NULL,
--   `lname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci DEFAULT NULL,
--   `photo` varchar(255) DEFAULT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Changed collation from utf8mb4_uca1400_ai_ci to utf8mb4_unicode_ci
-- because the local MySQL version (XAMPP) does not support MySQL 8+ collations
CREATE TABLE `sample` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;


/*Data for the table `sample` */

LOCK TABLES `sample` WRITE;

insert  into `sample`(`id`,`fname`,`mname`,`lname`,`photo`) values 
(1,'Juans','Ponce','Dela Cruz','3jrd7uhiknlixv9u2228599220251130061618.jpg'),
(2,'John','Doe','Smith','cilnocburvg3ueh14592535220251130080528.webp'),
(3,'Jake Aldrin','mname','Sanchez','3kuwzxxfu4z7wial7264379820251130061708.jpg'),
(9,'Q','Q','Q',NULL);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
