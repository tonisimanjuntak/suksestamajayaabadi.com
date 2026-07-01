/*
SQLyog Ultimate v10.42 
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

/*Table structure for table `pembayaranpiutang` */

DROP TABLE IF EXISTS `pembayaranpiutang`;

CREATE TABLE `pembayaranpiutang` (
  `idpembayaranpiutang` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tglpembayaran` date DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Giro') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totalpembayaran` decimal(18,0) DEFAULT NULL,
  `totaldibayar` decimal(18,0) DEFAULT NULL,
  `totaldiskon` decimal(18,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`idpembayaranpiutang`),
  KEY `tglpembayaran` (`tglpembayaran`),
  KEY `carabayar` (`carabayar`),
  KEY `idbank` (`idbank`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `pembayaranpiutang_ibfk_1` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`),
  CONSTRAINT `pembayaranpiutang_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembayaranpiutang` */

/*Table structure for table `pembayaranpiutangdetail` */

DROP TABLE IF EXISTS `pembayaranpiutangdetail`;

CREATE TABLE `pembayaranpiutangdetail` (
  `iddetail` int NOT NULL AUTO_INCREMENT,
  `idpembayaranpiutang` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpiutang` char(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `debet` decimal(18,0) DEFAULT NULL,
  `kredit` decimal(18,0) DEFAULT NULL,
  `bonuspenagihansudahdibayar` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`iddetail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembayaranpiutangdetail` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
