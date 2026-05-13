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

/*Table structure for table `konversistok` */

DROP TABLE IF EXISTS `konversistok`;

CREATE TABLE `konversistok` (
  `idkonversi` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `tglkonversi` datetime DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbarangasal` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jlhbarangasal` int DEFAULT NULL,
  `idsatuanasal` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbarangtujuan` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jlhbarangtujuan` int DEFAULT NULL,
  `idsatuantujuan` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idkonversi`),
  KEY `tglkonversi` (`tglkonversi`),
  KEY `idbarangasal` (`idbarangasal`),
  KEY `idbarangtujuan` (`idbarangtujuan`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `konversistok_ibfk_1` FOREIGN KEY (`idbarangasal`) REFERENCES `barang` (`idbarang`),
  CONSTRAINT `konversistok_ibfk_2` FOREIGN KEY (`idbarangtujuan`) REFERENCES `barang` (`idbarang`),
  CONSTRAINT `konversistok_ibfk_3` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `konversistok` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
