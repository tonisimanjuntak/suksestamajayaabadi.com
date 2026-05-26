/*
SQLyog Ultimate v10.42 
MySQL - 8.0.30 : Database - sukd9756_suksestamajayaabadi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sukd9756_suksestamajayaabadi` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `sukd9756_suksestamajayaabadi`;

/*Table structure for table `pengguna_menus` */

DROP TABLE IF EXISTS `pengguna_menus`;

CREATE TABLE `pengguna_menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idmenus` char(4) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hakaksi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idmenus` (`idmenus`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `pengguna_menus_ibfk_1` FOREIGN KEY (`idmenus`) REFERENCES `menus` (`idmenus`),
  CONSTRAINT `pengguna_menus_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=546 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengguna_menus` */

insert  into `pengguna_menus`(`id`,`idpengguna`,`idmenus`,`hakaksi`) values (495,'USRASO0001','M011','Lihat,Tambah,Edit,Hapus'),(496,'USRASO0001','M012','Lihat,Tambah,Edit,Hapus'),(497,'USRASO0001','M013','Lihat,Tambah,Edit,Hapus'),(498,'USRASO0001','M014','Lihat,Tambah,Edit,Hapus'),(499,'USRASO0001','M015','Lihat,Tambah,Edit,Hapus'),(500,'USRASO0001','M017','Lihat,Tambah,Edit,Hapus'),(501,'USRASO0001','M018','Lihat,Tambah,Edit,Hapus'),(502,'USRASO0001','M019','Lihat,Tambah,Edit,Hapus'),(503,'USRASO0001','M020','Lihat,Tambah,Edit,Hapus'),(504,'USRASO0001','M021','Lihat,Tambah,Edit,Hapus'),(505,'USRASO0001','M062','Lihat,Tambah,Edit,Hapus'),(506,'USRASO0001','M022','Lihat,Tambah,Edit,Hapus'),(507,'USRASO0001','MB01','Lihat'),(508,'USRASO0001','M023','Lihat,Tambah,Edit,Hapus'),(509,'USRASO0001','MB02','Lihat,Tambah,Edit,Hapus'),(510,'USRASO0001','M024','Lihat'),(511,'USRASO0001','M025','Lihat,Tambah,Edit,Hapus'),(512,'USRASO0001','M026','Lihat,Tambah,Edit,Hapus'),(513,'USRASO0001','M027','Lihat,Tambah,Edit,Hapus'),(514,'USRASO0001','M028','Lihat'),(515,'USRASO0001','M029','Lihat'),(516,'USRASO0001','M030','Lihat,Tambah,Edit,Hapus'),(517,'USRASO0001','M031','Lihat,Tambah,Edit,Hapus'),(518,'USRASO0001','M032','Lihat,Tambah,Edit,Hapus'),(519,'USRASO0001','M033','Lihat'),(520,'USRASO0001','M034','Lihat,Tambah,Edit,Hapus'),(521,'USRASO0001','M035','Lihat,Tambah,Edit,Hapus'),(522,'USRASO0001','M036','Lihat,Tambah,Edit,Hapus'),(523,'USRASO0001','M037','Lihat,Tambah,Edit,Hapus'),(524,'USRASO0001','M039','Lihat'),(525,'USRASO0001','M040','Lihat'),(526,'USRASO0001','M041','Lihat'),(527,'USRASO0001','M042','Lihat'),(528,'USRASO0001','M043','Lihat,Tambah,Edit,Hapus'),(529,'USRASO0001','M044','Lihat,Tambah,Edit,Hapus'),(530,'USRASO0001','M045','Lihat,Tambah,Edit,Hapus'),(531,'USRASO0001','M047','Lihat'),(532,'USRASO0001','M048','Lihat'),(533,'USRASO0001','M049','Lihat'),(534,'USRASO0001','M050','Lihat'),(535,'USRASO0001','M051','Lihat,Tambah,Edit,Hapus'),(536,'USRASO0001','M052','Lihat,Tambah,Edit,Hapus'),(537,'USRASO0001','M053','Lihat'),(538,'USRASO0001','M054','Lihat'),(539,'USRASO0001','M055','Lihat,Tambah,Edit,Hapus'),(540,'USRASO0001','M056','Lihat,Tambah,Edit,Hapus'),(541,'USRASO0001','M057','Lihat'),(542,'USRASO0001','M058','Lihat'),(543,'USRASO0001','M059','Lihat'),(544,'USRASO0001','M060','Lihat'),(545,'USRASO0001','M061','Lihat');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
