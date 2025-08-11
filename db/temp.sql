/*
SQLyog Enterprise v10.42 
MySQL - 8.0.30 : Database - suksestamajayaabadi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`suksestamajayaabadi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `suksestamajayaabadi`;

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `idmenus` char(4) COLLATE utf8mb4_general_ci NOT NULL,
  `menus` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent` char(4) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urlmenus` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `iconmenus` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urut` int DEFAULT NULL,
  `levels` tinyint DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idmenus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `menus` */

insert  into `menus`(`idmenus`,`menus`,`parent`,`urlmenus`,`iconmenus`,`urut`,`levels`,`statusaktif`) values ('A001','Dashboard',NULL,'/','fas fa-tachometer-alt',0,0,'Aktif'),('B001','Referensi',NULL,NULL,'fas fa-angle-left',10,0,'Aktif'),('B005','Pengguna','B001','/pengguna','far fa-circle',15,1,'Aktif');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
