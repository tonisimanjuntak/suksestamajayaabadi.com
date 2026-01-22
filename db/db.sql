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

/*Table structure for table `akun` */

DROP TABLE IF EXISTS `akun`;

CREATE TABLE `akun` (
  `kdakun` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namaakun` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdparent` char(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `levels` int DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`kdakun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `akun` */

insert  into `akun`(`kdakun`,`namaakun`,`kdparent`,`levels`,`statusaktif`,`inserted_date`,`updated_date`) values ('1','Aset',NULL,1,'Aktif','2025-02-14 01:47:42','2025-02-14 06:17:20'),('1.1','Aset Lancar','1',2,'Aktif','2025-02-14 06:25:44','2025-02-14 07:19:50'),('1.1.01','Kas','1.1',3,'Aktif','2025-02-14 07:49:21','2025-02-14 07:52:15'),('1.1.01.01','Kas Tunai','1.1.01',4,'Aktif','2025-02-14 08:09:12','2025-03-16 17:31:58'),('1.1.01.02','Rekening May Bank','1.1.01',4,'Aktif','2025-02-14 08:12:41','2025-05-10 04:06:51'),('1.1.01.03','Rekening BCA','1.1.01',4,'Aktif','2025-03-16 17:32:13','2025-03-16 17:32:13'),('1.1.02','Persediaan Barang Dagang','1.1',3,'Aktif','2025-02-14 07:50:14','2025-02-14 07:50:14'),('1.1.02.01','Persediaan Bahan Baku','1.1.02',4,'Aktif','2025-02-14 08:22:10','2025-02-14 08:22:10'),('1.1.03','Piutang','1.1',3,'Aktif','2025-02-14 07:50:34','2025-03-16 18:13:52'),('1.1.03.01','Piutang Usaha','1.1.03',4,'Aktif','2025-03-16 18:13:37','2025-03-16 18:13:37'),('1.2','Aset Tidak Lancar','1',2,'Aktif','2025-02-14 06:26:10','2025-02-14 06:26:10'),('2','Liabilitas',NULL,1,'Aktif','2025-02-14 01:50:45','2025-02-14 06:17:37'),('2.1','Liabilitas Jangka Panjang','2',2,'Aktif','2025-02-14 06:38:40','2025-02-14 06:38:40'),('2.1.01','Utang','2.1',3,'Aktif','2025-03-17 05:17:27','2025-03-17 05:17:27'),('2.1.01.01','Utang Usaha (Ekspedisi)','2.1.01',4,'Aktif','2025-03-17 05:17:46','2025-05-20 14:53:48'),('2.2','Liabilitas Jangka Pendek','2',2,'Aktif','2025-02-14 06:39:03','2025-02-14 06:39:03'),('2.2.01','Utang Jangka Pendek','2.2',3,'Aktif','2025-04-25 06:32:42','2025-04-25 06:32:42'),('2.2.01.01','Utang Usaha (Supplier)','2.2.01',4,'Aktif','2025-04-25 06:33:34','2025-04-25 06:33:34'),('2.2.01.02','Utang Pajak (PPN Keluaran)','2.2.01',4,'Aktif','2025-04-25 06:34:03','2025-04-25 06:56:37'),('2.2.01.03','Utang Gaji','2.2.01',4,'Aktif','2025-04-25 06:34:23','2025-04-25 06:34:23'),('3','Modal',NULL,1,'Aktif','2025-02-14 01:50:54','2025-02-14 01:56:18'),('3.1','Modal','3',2,'Aktif','2025-04-25 14:38:46','2025-04-25 14:38:46'),('3.1.01','Modal','3.1',3,'Aktif','2025-04-25 14:39:00','2025-04-25 14:39:00'),('3.1.01.01','Modal Pemilik','3.1.01',4,'Aktif','2025-04-25 14:40:00','2025-04-25 14:40:00'),('4','Pendapatan',NULL,1,'Aktif','2025-02-14 01:51:58','2025-02-14 06:18:21'),('4.1','Pendapatan Usaha','4',2,'Aktif','2025-02-14 07:23:06','2025-02-14 07:23:06'),('4.1.01','Penjualan Usaha Dagang','4.1',3,'Aktif','2025-03-08 08:51:19','2025-03-08 08:51:19'),('4.1.01.01','Penjualan Barang Dagang','4.1.01',4,'Aktif','2025-03-08 08:52:10','2025-03-08 08:52:10'),('4.2','Pendapatan Diluar Usaha','4',2,'Aktif','2025-02-14 07:23:44','2025-02-14 07:23:44'),('4.2.01','Pendapatan Sewa','4.2',3,'Aktif','2025-03-08 08:51:34','2025-03-08 08:53:15'),('4.2.01.01','Pendapatan Sewa Truk','4.2.01',4,'Aktif','2025-03-08 08:52:33','2025-03-08 08:52:47'),('5','Beban',NULL,1,'Aktif','2025-02-14 01:52:15','2025-02-14 06:18:05'),('5.1','Beban Gaji','5',2,'Aktif','2025-02-14 07:33:40','2025-02-14 07:33:40'),('5.1.01','Gaji Pegawai','5.1',3,'Aktif','2025-03-08 07:26:30','2025-03-08 07:26:30'),('5.1.01.01','Gaji Pokok Pegawai','5.1.01',4,'Aktif','2025-03-08 07:37:31','2025-03-08 07:37:31'),('5.1.01.02','Gaji Tunjangan Pegawai','5.1.01',4,'Aktif','2025-03-08 07:37:45','2025-03-08 07:37:45'),('5.1.02','Gaji Non Pegawai','5.1',3,'Aktif','2025-03-08 07:26:54','2025-03-08 07:26:54'),('5.1.02.01','Upah Harian Non Pegawai','5.1.02',4,'Aktif','2025-03-08 07:38:08','2025-03-08 07:39:00'),('5.1.02.02','Upah Bulanan Non Pegawai','5.1.02',4,'Aktif','2025-03-08 07:38:27','2025-03-08 07:39:13'),('5.2','Beban Jasa','5',2,'Aktif','2025-02-14 07:34:55','2025-02-14 07:34:55'),('5.2.01','Jasa Pemeliharaan Barang Kantor','5.2',3,'Aktif','2025-03-08 07:33:17','2025-03-08 07:35:54'),('5.2.01.01','Jasa Pemeliharaan AC / Pendingin Ruangan','5.2.01',4,'Aktif','2025-03-08 07:39:44','2025-03-08 07:43:10'),('5.2.01.03','Jasa Pemeliharaan Komputer/ Laptop','5.2.01',4,'Aktif','2025-03-08 07:42:51','2025-03-08 07:43:20'),('5.2.02','Jasa Pemeliharaan Software','5.2',3,'Aktif','2025-03-08 07:33:54','2025-03-08 07:36:04'),('5.2.02.01','Jasa Pemeliharaan Web Aplikasi POS','5.2.02',4,'Aktif','2025-03-08 07:40:40','2025-03-08 07:43:37'),('5.3','Beban Peralatan dan Perlengkapan Kantor','5',2,'Aktif','2025-02-14 07:35:23','2025-02-14 07:35:23'),('5.3.01','Beban Barang Habis Pakai','5.3',3,'Aktif','2025-03-08 07:35:03','2025-03-08 07:36:16'),('5.3.01.01','Beban Kertas F4','5.3.01',4,'Aktif','2025-03-08 07:41:12','2025-03-08 07:41:12'),('5.3.01.02','Beban Kertas Blanko Kwitansi','5.3.01',4,'Aktif','2025-03-08 07:41:49','2025-03-08 07:41:49'),('5.3.02','Beban Peralatan Kantor','5.3',3,'Aktif','2025-03-08 07:36:37','2025-03-08 07:36:37'),('5.3.02.01','Beban Komputer/ PC','5.3.02',4,'Aktif','2025-03-08 07:42:12','2025-03-08 07:42:12'),('5.3.02.02','Beban Laptop','5.3.02',4,'Aktif','2025-03-08 07:42:26','2025-03-08 07:42:26'),('5.3.03','Beban Perlengkapan Kantor','5.3',3,'Aktif','2025-03-08 07:36:56','2025-03-08 07:37:05'),('5.3.03.01','Beban Lemari Berkas','5.3.03',4,'Aktif','2025-03-08 07:44:10','2025-03-08 07:44:10'),('5.4','Beban Operasional','5',2,'Aktif','2025-04-25 06:43:55','2025-04-25 06:43:55'),('5.4.01','Beban Penjualan','5.4',3,'Aktif','2025-04-25 06:44:30','2025-04-25 06:44:30'),('5.4.01.01','Beban Transportasi','5.4.01',4,'Aktif','2025-04-25 06:45:25','2025-04-25 06:45:25'),('5.4.01.02','Beban Iklan','5.4.01',4,'Aktif','2025-04-25 06:45:39','2025-04-25 06:45:39'),('6','Pembelian',NULL,1,'Aktif','2025-04-25 07:35:01','2025-04-25 07:35:01'),('6.1','Pembelian','6',2,'Aktif','2025-04-25 07:35:17','2025-04-25 07:35:17'),('6.1.01','Pembelian','6.1',3,'Aktif','2025-04-25 07:35:38','2025-04-25 07:35:38'),('6.1.01.01','Pembelian','6.1.01',4,'Aktif','2025-04-25 07:35:50','2025-04-25 07:35:50');

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namabank` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cabang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `norekening` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `atasnama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idbank`),
  KEY `kdakun` (`kdakun`),
  CONSTRAINT `bank_ibfk_1` FOREIGN KEY (`kdakun`) REFERENCES `akun` (`kdakun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bank` */

insert  into `bank`(`idbank`,`namabank`,`cabang`,`norekening`,`kdakun`,`inserted_date`,`updated_date`,`statusaktif`,`atasnama`) values ('BN001','May Bank','Pontianak','7844555666','1.1.01.02','2025-02-28 08:03:40','2025-05-10 04:07:20','Aktif','Budi Santoso'),('MD001','Bank Central Asia','Kota Pontianak','56889966','1.1.01.03','2025-02-28 11:59:35','2025-04-22 06:53:40','Aktif','Budi Santoso');

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `idbarang` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kdbarang` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namabarang` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idkategori` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stok` int DEFAULT '0',
  `fotobarang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hargabeli` decimal(18,0) DEFAULT '0',
  `hargajualasli` decimal(18,0) DEFAULT '0',
  `hargajualdiskon` decimal(10,0) DEFAULT '0',
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idjenisbarang` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenisbonuspenjualan` enum('Nominal','Persen') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Persen',
  `persenbonuspenjualan` decimal(3,2) DEFAULT '0.00',
  `jumlahbonuspenjualan` decimal(18,0) DEFAULT '0',
  `jenisbonustagihan` enum('Nominal','Persen') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `persenbonustagihan` decimal(3,2) DEFAULT '0.00',
  `jumlahbonustagihan` decimal(18,0) DEFAULT '0',
  `stokminimum` int DEFAULT '0',
  PRIMARY KEY (`idbarang`),
  UNIQUE KEY `kdbarang` (`kdbarang`),
  KEY `idkategori` (`idkategori`),
  KEY `kdakun` (`kdakun`),
  KEY `idjenisbarang` (`idjenisbarang`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `kategoribarang` (`idkategori`),
  CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`kdakun`) REFERENCES `akun` (`kdakun`),
  CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`idjenisbarang`) REFERENCES `jenisbarang` (`idjenisbarang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `barang` */

insert  into `barang`(`idbarang`,`kdbarang`,`namabarang`,`idkategori`,`kdakun`,`stok`,`fotobarang`,`hargabeli`,`hargajualasli`,`hargajualdiskon`,`statusaktif`,`inserted_date`,`updated_date`,`idjenisbarang`,`jenisbonuspenjualan`,`persenbonuspenjualan`,`jumlahbonuspenjualan`,`jenisbonustagihan`,`persenbonustagihan`,`jumlahbonustagihan`,`stokminimum`) values ('B001000001',NULL,'Paku 1 Inc (1 Kg)','B001','1.1.02.01',0,NULL,20000,22000,22000,'Aktif','2025-05-23 13:51:11','2025-05-23 15:02:10','002','Nominal',0.00,1000,NULL,0.00,0,0),('B001000002','ASD3819111','Besi Pagar','B001','1.1.02.01',0,NULL,20000,22000,22000,'Aktif','2025-07-10 17:04:55','2025-07-10 17:32:33','001','Persen',0.25,0,'Persen',0.25,0,120),('K001000001',NULL,'Papan Mal','K001','1.1.02.01',990,NULL,14000,15000,15000,'Aktif','2025-02-20 03:33:46','2025-05-28 15:44:12','001','Persen',0.50,0,'Persen',0.30,0,0),('K001000002','266S8182AB','Kayu 4x6 Pelang','K001','1.1.02.01',973,NULL,45000,48000,48000,'Aktif','2025-02-20 07:25:57','2025-07-10 17:19:01','001','Persen',0.50,0,'Persen',0.30,0,0),('K001000003',NULL,'Papan 26Inc','K001','1.1.02.01',97,NULL,45000,54000,54000,'Aktif','2025-05-27 17:41:54','2025-05-27 17:47:10','001','Persen',0.50,0,'Nominal',0.00,200,0),('W001000001',NULL,'Pipa 5In','W001','1.1.02.01',890,NULL,100000,120000,120000,'Aktif','2025-05-10 03:46:26','2025-05-28 15:44:30','001','Persen',0.50,0,'Persen',0.30,0,0);

/*Table structure for table `bonus` */

DROP TABLE IF EXISTS `bonus`;

CREATE TABLE `bonus` (
  `idbonus` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglbonus` date DEFAULT NULL,
  `idsales` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totalpenjualan` decimal(18,0) DEFAULT '0',
  `totalpenagihan` decimal(18,0) DEFAULT '0',
  `totalbonuspenjualan` decimal(18,0) DEFAULT '0',
  `totalbonuspenagihan` decimal(18,0) DEFAULT '0',
  `targetpenjualan` decimal(18,0) DEFAULT NULL,
  `pencapaiantarget` decimal(18,0) DEFAULT NULL,
  `totalbonustarget` decimal(18,0) DEFAULT '0',
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idbonus`),
  KEY `idsales` (`idsales`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `bonus_ibfk_1` FOREIGN KEY (`idsales`) REFERENCES `sales` (`idsales`),
  CONSTRAINT `bonus_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bonus` */

/*Table structure for table `bonuspenagihan` */

DROP TABLE IF EXISTS `bonuspenagihan`;

CREATE TABLE `bonuspenagihan` (
  `idbonuspenagihan` int NOT NULL AUTO_INCREMENT,
  `idbonus` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpiutang` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaltagihan` decimal(18,0) DEFAULT '0',
  `totalbonus` decimal(18,0) DEFAULT '0',
  PRIMARY KEY (`idbonuspenagihan`),
  KEY `idbonus` (`idbonus`),
  KEY `idpiutang` (`idpiutang`),
  KEY `idpenjualan` (`idpenjualan`),
  CONSTRAINT `bonuspenagihan_ibfk_1` FOREIGN KEY (`idbonus`) REFERENCES `bonus` (`idbonus`),
  CONSTRAINT `bonuspenagihan_ibfk_3` FOREIGN KEY (`idpiutang`) REFERENCES `piutang` (`idpiutang`),
  CONSTRAINT `bonuspenagihan_ibfk_4` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bonuspenagihan` */

/*Table structure for table `bonuspenjualan` */

DROP TABLE IF EXISTS `bonuspenjualan`;

CREATE TABLE `bonuspenjualan` (
  `idbonuspenjualan` int NOT NULL AUTO_INCREMENT,
  `idbonus` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totalinvoice` decimal(18,0) DEFAULT NULL,
  `totalbonus` decimal(18,0) DEFAULT NULL,
  `iddetailsuratjalan` int DEFAULT NULL,
  PRIMARY KEY (`idbonuspenjualan`),
  KEY `idbonus` (`idbonus`),
  KEY `idpenjualan` (`idpenjualan`),
  KEY `iddetailsuratjalan` (`iddetailsuratjalan`),
  CONSTRAINT `bonuspenjualan_ibfk_1` FOREIGN KEY (`idbonus`) REFERENCES `bonus` (`idbonus`),
  CONSTRAINT `bonuspenjualan_ibfk_2` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`),
  CONSTRAINT `bonuspenjualan_ibfk_3` FOREIGN KEY (`iddetailsuratjalan`) REFERENCES `suratjalandetail` (`iddetailsuratjalan`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bonuspenjualan` */

/*Table structure for table `bonustarget` */

DROP TABLE IF EXISTS `bonustarget`;

CREATE TABLE `bonustarget` (
  `idbonustarget` int NOT NULL AUTO_INCREMENT,
  `idbonus` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totalinvoice` decimal(18,0) DEFAULT NULL,
  `totalbonus` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`idbonustarget`),
  KEY `idbonus` (`idbonus`),
  KEY `idpenjualan` (`idpenjualan`),
  CONSTRAINT `bonustarget_ibfk_1` FOREIGN KEY (`idbonus`) REFERENCES `bonus` (`idbonus`),
  CONSTRAINT `bonustarget_ibfk_2` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bonustarget` */

/*Table structure for table `bukubank` */

DROP TABLE IF EXISTS `bukubank`;

CREATE TABLE `bukubank` (
  `idbukubank` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idtransaksi` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgltransaksi` date DEFAULT NULL,
  `debet` decimal(18,0) NOT NULL DEFAULT '0',
  `kredit` decimal(18,0) NOT NULL DEFAULT '0',
  `idjenistransaksi` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `insertbysystem` tinyint(1) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idbukubank`),
  KEY `idbank` (`idbank`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idjenistransaksi` (`idjenistransaksi`),
  CONSTRAINT `bukubank_ibfk_1` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`),
  CONSTRAINT `bukubank_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `bukubank_ibfk_3` FOREIGN KEY (`idjenistransaksi`) REFERENCES `jenistransaksi` (`idjenistransaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bukubank` */

/*Table structure for table `ekspedisi` */

DROP TABLE IF EXISTS `ekspedisi`;

CREATE TABLE `ekspedisi` (
  `idekspedisi` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namaekspedisi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamatekspedisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelpekspedisi` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emailekspedisi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nikpemilik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapemilik` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelppemilik` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nowapemilik` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakunutang` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idekspedisi`),
  KEY `kdakunutang` (`kdakunutang`),
  CONSTRAINT `ekspedisi_ibfk_1` FOREIGN KEY (`kdakunutang`) REFERENCES `akun` (`kdakun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `ekspedisi` */

insert  into `ekspedisi`(`idekspedisi`,`namaekspedisi`,`alamatekspedisi`,`notelpekspedisi`,`emailekspedisi`,`nikpemilik`,`namapemilik`,`notelppemilik`,`nowapemilik`,`inserted_date`,`updated_date`,`statusaktif`,`kdakunutang`) values ('EKSKFSD001','PT. Telex Nusantara','Jl. A yani 2','0651668888',NULL,'1829189289182918','Rudi','081200000111','081200000111','2025-05-20 15:05:19','2025-05-20 15:06:34','Aktif','2.1.01.01'),('EKSOHRR001','JNT Ekspress','Jl. Pemuda Gg.Pahlawan No.1 Kec.Pontianak Kota','0812005522200','jnt@gmail.com','2365545121215855','Wawan Susanto','081521202222','081521202222','2025-05-07 02:57:04','2025-05-20 15:07:15','Aktif','2.1.01.01'),('EKSPWRU001','Pos Indonesia','Jl. Karya Wisata No.22 Kec. Pontianak Timur','08125121212','posindonesia@gmail.com','1287485121212121','Susi','0812005121552','0812005121552','2025-05-07 02:59:05','2025-05-20 15:07:24','Aktif','2.1.01.01');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `hutang` */

DROP TABLE IF EXISTS `hutang`;

CREATE TABLE `hutang` (
  `idhutang` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idpembelian` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglhutang` date DEFAULT NULL,
  `idsupplier` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaldebet` decimal(18,0) DEFAULT NULL,
  `totalkredit` decimal(18,0) DEFAULT NULL,
  `jenissumber` enum('Pembelian','Non Pembelian') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Pembelian',
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idhutang`),
  KEY `idpembelian` (`idpembelian`),
  KEY `idsupplier` (`idsupplier`),
  CONSTRAINT `hutang_ibfk_1` FOREIGN KEY (`idpembelian`) REFERENCES `pembelian` (`idpembelian`),
  CONSTRAINT `hutang_ibfk_2` FOREIGN KEY (`idsupplier`) REFERENCES `supplier` (`idsupplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `hutang` */

insert  into `hutang`(`idhutang`,`idpembelian`,`tglhutang`,`idsupplier`,`totaldebet`,`totalkredit`,`jenissumber`,`keterangan`) values ('250501HU0003',NULL,'2025-05-01','SUPIMN0001',0,21000000,'Non Pembelian','Saldo awal hutang PT Intra Makmur'),('250606HU0001','250606BL0000001','2025-06-06','SUPMUF0001',0,4050000,'Pembelian','Hutang Pembelian dengan No. Faktur 123EE');

/*Table structure for table `hutangdetail` */

DROP TABLE IF EXISTS `hutangdetail`;

CREATE TABLE `hutangdetail` (
  `idhutangdetail` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idhutang` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglhutang` date DEFAULT NULL,
  `debet` decimal(18,0) DEFAULT NULL,
  `kredit` decimal(18,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Giro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` enum('Hutang','Pembayaran Hutang') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nobilyetgiro` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idhutangdetail`),
  KEY `idhutang` (`idhutang`),
  KEY `idbank` (`idbank`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `hutangdetail_ibfk_1` FOREIGN KEY (`idhutang`) REFERENCES `hutang` (`idhutang`),
  CONSTRAINT `hutangdetail_ibfk_2` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`),
  CONSTRAINT `hutangdetail_ibfk_3` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `hutangdetail` */

insert  into `hutangdetail`(`idhutangdetail`,`idhutang`,`tglhutang`,`debet`,`kredit`,`inserted_date`,`updated_date`,`idpengguna`,`carabayar`,`idbank`,`jenis`,`nobilyetgiro`) values ('250501HU0003005','250501HU0003','2025-05-01',0,21000000,'2025-05-01 07:35:54','2025-05-01 07:35:54','USRBID0001',NULL,NULL,'Hutang',NULL),('250606HU0001001','250606HU0001','2025-06-06',0,4050000,'2025-06-06 04:13:38','2025-06-06 04:13:38','USRBID0001',NULL,NULL,'Hutang',NULL);

/*Table structure for table `hutangekspedisi` */

DROP TABLE IF EXISTS `hutangekspedisi`;

CREATE TABLE `hutangekspedisi` (
  `idhutangekspedisi` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idtransaksi` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglhutang` date DEFAULT NULL,
  `idekspedisi` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `debet` decimal(18,0) DEFAULT NULL,
  `kredit` decimal(18,0) DEFAULT NULL,
  `jenissumber` enum('Pembelian','Penjualan','Pembayaran','Saldo') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Giro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` enum('Hutang','Pembayaran') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nobilyetgiro` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `hargadpp` decimal(18,0) DEFAULT '0',
  `persenppn` decimal(3,2) DEFAULT '0.00',
  `jumlahppn` decimal(18,0) DEFAULT '0',
  `persenpph23` decimal(3,2) DEFAULT '0.00',
  `jumlahpph23` decimal(18,0) DEFAULT '0',
  PRIMARY KEY (`idhutangekspedisi`),
  KEY `idbank` (`idbank`),
  KEY `idekspedisi` (`idekspedisi`),
  CONSTRAINT `hutangekspedisi_ibfk_1` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`),
  CONSTRAINT `hutangekspedisi_ibfk_2` FOREIGN KEY (`idekspedisi`) REFERENCES `ekspedisi` (`idekspedisi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `hutangekspedisi` */

insert  into `hutangekspedisi`(`idhutangekspedisi`,`idtransaksi`,`tglhutang`,`idekspedisi`,`debet`,`kredit`,`jenissumber`,`keterangan`,`carabayar`,`idbank`,`jenis`,`nobilyetgiro`,`inserted_date`,`updated_date`,`hargadpp`,`persenppn`,`jumlahppn`,`persenpph23`,`jumlahpph23`) values ('250522HEX000001','250522BL0000001','2025-05-22','EKSOHRR001',0,5000000,'Pembelian','Hutang ekspedisi dengan No. Faktur 333/FF',NULL,NULL,'Hutang',NULL,NULL,NULL,NULL,NULL,NULL,0.00,0),('250523HEX000001',NULL,'2025-05-23','EKSOHRR001',5000000,0,'Pembayaran','Pembayaran dengan cara giro','Giro','MD001','Pembayaran','121312312','2025-05-23 04:42:23','2025-05-23 15:16:07',NULL,NULL,NULL,0.00,0),('250527HEX000001','250527SJ01','2025-05-27','EKSOHRR001',0,100000,'Penjualan','Hutang ekspedisi dengan No. Surat Jalan 250527SJ01',NULL,NULL,'Hutang',NULL,NULL,NULL,NULL,NULL,NULL,0.00,0),('250527HEX000002','250527SJ02','2025-05-27','EKSPWRU001',0,35000,'Penjualan','Hutang ekspedisi dengan No. Surat Jalan 250527SJ02',NULL,NULL,'Hutang',NULL,NULL,NULL,NULL,NULL,NULL,0.00,0),('250711HEX000001',NULL,'2025-07-11','EKSOHRR001',25275000,0,'Pembayaran','Test','Tunai',NULL,'Pembayaran',NULL,'2025-07-11 01:59:11','2025-07-11 01:59:11',25000000,1.10,275000,NULL,500000),('250711HEX000002',NULL,'2025-07-11','EKSOHRR001',2780250,0,'Pembayaran','test','Tunai',NULL,'Pembayaran',NULL,'2025-07-11 02:01:04','2025-07-11 02:01:04',2750000,1.10,30250,0.00,55000),('250711HEX000003',NULL,'2025-07-11','EKSOHRR001',2022000,0,'Pembayaran','Test','Tunai',NULL,'Pembayaran',NULL,'2025-07-11 02:02:13','2025-07-11 03:39:53',2000000,1.10,22000,2.00,40000),('250813HEX000001','250813SJ01','2025-08-13','EKSOHRR001',0,120000,'Penjualan','Hutang ekspedisi dengan No. Surat Jalan 250813SJ01',NULL,NULL,'Hutang',NULL,NULL,NULL,0,0.00,0,0.00,0),('250819HEX000001','250813SJ02','2025-08-13','EKSKFSD001',0,20000,'Penjualan','Hutang ekspedisi dengan No. Surat Jalan 250813SJ02',NULL,NULL,'Hutang',NULL,NULL,NULL,0,0.00,0,0.00,0);

/*Table structure for table `jenisbarang` */

DROP TABLE IF EXISTS `jenisbarang`;

CREATE TABLE `jenisbarang` (
  `idjenisbarang` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenisbarang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `persenbonustarget` decimal(3,2) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idjenisbarang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenisbarang` */

insert  into `jenisbarang`(`idjenisbarang`,`jenisbarang`,`persenbonustarget`,`statusaktif`) values ('001','Fast',0.25,'Aktif'),('002','Middle',0.50,'Aktif'),('999','Standard',0.00,'Aktif');

/*Table structure for table `jenisekspedisi` */

DROP TABLE IF EXISTS `jenisekspedisi`;

CREATE TABLE `jenisekspedisi` (
  `idjenisekspedisi` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namajenisekspedisi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idjenisekspedisi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenisekspedisi` */

insert  into `jenisekspedisi`(`idjenisekspedisi`,`namajenisekspedisi`,`statusaktif`) values ('001','Darat','Aktif'),('002','Laut','Aktif'),('003','Udara','Aktif');

/*Table structure for table `jenispiutang` */

DROP TABLE IF EXISTS `jenispiutang`;

CREATE TABLE `jenispiutang` (
  `idjenispiutang` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namajenispiutang` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jatuhtempo` int DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idjenispiutang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenispiutang` */

insert  into `jenispiutang`(`idjenispiutang`,`namajenispiutang`,`jatuhtempo`,`statusaktif`) values ('P01','Slow',90,'Aktif'),('P02','Middle',45,'Aktif'),('P03','Fast',7,'Aktif');

/*Table structure for table `jenistransaksi` */

DROP TABLE IF EXISTS `jenistransaksi`;

CREATE TABLE `jenistransaksi` (
  `idjenistransaksi` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namajenistransaksi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idjenistransaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenistransaksi` */

/*Table structure for table `jurnal` */

DROP TABLE IF EXISTS `jurnal`;

CREATE TABLE `jurnal` (
  `idjurnal` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgljurnal` date DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaldebet` decimal(18,0) DEFAULT NULL,
  `totalkredit` decimal(18,0) DEFAULT NULL,
  `referensi` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` enum('Penjualan','Pembelian','Stock Adjustment','Penerimaan','Pengeluaran','Hutang','Piutang','Jurnal Penyesuaian','Retur Pembelian','Retur Penjualan','Saldo Awal') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idposting` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idjurnal`),
  KEY `idpengguna` (`keterangan`),
  KEY `idpengguna_2` (`idpengguna`),
  KEY `idposting` (`idposting`),
  CONSTRAINT `jurnal_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `jurnal_ibfk_2` FOREIGN KEY (`idposting`) REFERENCES `postingjurnal` (`idposting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jurnal` */

/*Table structure for table `jurnaldetail` */

DROP TABLE IF EXISTS `jurnaldetail`;

CREATE TABLE `jurnaldetail` (
  `idjurnaldetail` int NOT NULL AUTO_INCREMENT,
  `idjurnal` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `debet` decimal(18,0) DEFAULT NULL,
  `kredit` decimal(18,0) DEFAULT NULL,
  `urut` int DEFAULT NULL,
  PRIMARY KEY (`idjurnaldetail`),
  KEY `idjurnal` (`idjurnal`),
  KEY `kdakun` (`kdakun`),
  CONSTRAINT `jurnaldetail_ibfk_1` FOREIGN KEY (`idjurnal`) REFERENCES `jurnal` (`idjurnal`),
  CONSTRAINT `jurnaldetail_ibfk_2` FOREIGN KEY (`kdakun`) REFERENCES `akun` (`kdakun`)
) ENGINE=InnoDB AUTO_INCREMENT=600 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jurnaldetail` */

/*Table structure for table `kategoribarang` */

DROP TABLE IF EXISTS `kategoribarang`;

CREATE TABLE `kategoribarang` (
  `idkategori` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namakategori` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idkategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kategoribarang` */

insert  into `kategoribarang`(`idkategori`,`namakategori`,`inserted_date`,`updated_date`,`statusaktif`) values ('B001','Besi','2025-02-21 03:20:26','2025-02-21 03:20:26','Aktif'),('K001','Kayu Ulin','2025-02-13 08:16:29','2025-02-14 00:43:02','Aktif'),('W001','Wavin','2025-05-10 03:43:57','2025-05-10 03:43:57','Aktif');

/*Table structure for table `konsumen` */

DROP TABLE IF EXISTS `konsumen`;

CREATE TABLE `konsumen` (
  `idkonsumen` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namakonsumen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamatkonsumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelpkonsumen` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emailkonsumen` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nikpemilik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapemilik` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelppemilik` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nowapemilik` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `saldo` decimal(18,0) DEFAULT '0',
  `idwilayah` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `saldopajak` decimal(18,0) DEFAULT '0',
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `npwp` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `limitkredit` decimal(18,0) DEFAULT '50000000',
  `jumlahpiutang` decimal(18,0) DEFAULT '0',
  `kdakunpiutang` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idkonsumen`),
  KEY `idwilayah` (`idwilayah`),
  KEY `kdakunpiutang` (`kdakunpiutang`),
  CONSTRAINT `konsumen_ibfk_1` FOREIGN KEY (`idwilayah`) REFERENCES `wilayah` (`idwilayah`),
  CONSTRAINT `konsumen_ibfk_2` FOREIGN KEY (`kdakunpiutang`) REFERENCES `akun` (`kdakun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `konsumen` */

insert  into `konsumen`(`idkonsumen`,`namakonsumen`,`alamatkonsumen`,`notelpkonsumen`,`emailkonsumen`,`nikpemilik`,`namapemilik`,`notelppemilik`,`nowapemilik`,`saldo`,`idwilayah`,`saldopajak`,`inserted_date`,`updated_date`,`statusaktif`,`npwp`,`limitkredit`,`jumlahpiutang`,`kdakunpiutang`) values ('BWR001','CV. Berkat','Jl. Pemuda','0812000000',NULL,'7898797989879798','Dadang','081500000','081500000',0,'003',0,'2025-05-20 04:05:10','2025-08-20 02:29:03','Aktif','546465456545454',130000000,0,'1.1.03.01'),('IPJ001','PT. Intrajaya','Jl. Patimura','45452121212222112121','intrajaya@gmail.com','0000000000000000','Budi Hartono','0665234550','0813000000000',0,'001',0,'2025-02-21 02:54:14','2025-02-21 02:59:31','Aktif',NULL,50000000,150000,NULL),('ISO001','PT. Indrapura','Jl. Pendidikan 2','081200010100',NULL,NULL,NULL,NULL,NULL,0,'002',0,'2025-05-20 14:02:28','2025-05-20 14:04:51','Aktif','929283371781277',50000000,0,'1.1.03.01'),('KUE001','CV. Karya Utama','Jl. Pemuda','06562345455','karyautama@gmail.com','2211555122133223','Dodit','08130000000','08130000000',0,'002',0,'2025-02-21 03:23:04','2025-02-21 03:23:04','Aktif',NULL,50000000,11500000,NULL),('SKE001','Sinar Kobar','Jl. Pahlawan No.  23 Kel. Sungai Raya Kec. Sosok','06537272788','sinarkobar@gmail.com',NULL,'Toni','081200000000',NULL,0,'003',0,'2025-05-10 03:54:55','2025-05-10 03:55:14','Aktif',NULL,50000000,0,NULL);

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `idmenus` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `menus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `parent` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urlmenus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `iconmenus` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `urut` int DEFAULT NULL,
  `levels` tinyint DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `event_exist` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idmenus`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `menus` */

insert  into `menus`(`idmenus`,`menus`,`parent`,`urlmenus`,`iconmenus`,`urut`,`levels`,`statusaktif`,`event_exist`) values ('M001','Dashboard',NULL,'home','fas fa-tachometer-alt',10,0,'Aktif',''),('M002','Referensi',NULL,NULL,'fas fa-database',20,0,'Aktif',''),('M003','Barang',NULL,NULL,'fas fa-shapes',130,0,'Aktif',''),('M004','Sales',NULL,NULL,'fas fa-universal-access',180,0,'Aktif',''),('M005','Ekspedisi',NULL,NULL,'fas fa-truck',240,0,'Aktif',''),('M006','Pembelian',NULL,NULL,'fas fa-table',290,0,'Aktif',''),('M007','Penjualan',NULL,NULL,'fas fa-stamp',390,0,'Aktif',''),('M008','Transaksi Umum',NULL,NULL,'fas fa-tv',480,0,'Aktif',''),('M009','Akuntansi',NULL,NULL,'fas fa-newspaper',530,0,'Aktif',''),('M010','Logout',NULL,'logout','fas fa-sign-out-alt text-warning',610,0,'Aktif',''),('M011','Pengguna','M002','pengguna','far fa-circle',30,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M012','Wilayah','M002','wilayah','far fa-circle',40,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M013','Konsumen','M002','konsumen','far fa-circle',50,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M014','Supplier','M002','supplier','far fa-circle',60,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M015','Bank','M002','bank','far fa-circle',70,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M016','Akun','M002',NULL,'fas fa-stream',80,1,'Aktif',''),('M017','Akun Lv. 1','M016','akun1','far fa-circle',90,2,'Aktif','Lihat, Tambah, Edit, Hapus'),('M018','Akun Lv. 2','M016','akun2','far fa-circle',100,2,'Aktif','Lihat, Tambah, Edit, Hapus'),('M019','Akun Lv. 3','M016','akun3','far fa-circle',110,2,'Aktif','Lihat, Tambah, Edit, Hapus'),('M020','Akun Lv. 4','M016','akun4','far fa-circle',120,2,'Aktif','Lihat, Tambah, Edit, Hapus'),('M021','Kategori Barang','M003','kategoribarang','far fa-circle',140,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M022','Barang','M003','barang','far fa-circle',150,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M023','Stock Opname','M003','stockopname','far fa-circle',160,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M024','Laporan Persediaan','M003','lappersediaan','far fa-circle',170,1,'Aktif','Lihat'),('M025','Data Sales','M004','sales','far fa-circle',190,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M026','Penagihan Piutang','M004','penagihan','far fa-circle',200,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M027','Bonus Sales','M004','bonussales','far fa-circle',210,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M028','Laporan Penagihan','M004','lappenagihansales','fas fa-print',220,1,'Aktif','Lihat'),('M029','Laporan Bonus Sales','M004','lapbonussales','fas fa-print',230,1,'Aktif','Lihat'),('M030','Data Ekspedisi','M005','ekspedisi','far fa-circle',250,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M031','Surat Jalan','M005','suratjalan','far fa-circle',260,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M032','Buku Utang Ekspedisi','M005','hutangekspedisi','far fa-circle',270,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M033','Laporan Utang Ekspedisi','M005','laputangekspedisi','fas fa-print',280,1,'Aktif','Lihat'),('M034','Purchase Order (PO)','M006','pembelian','far fa-circle',300,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M035','Penerimaan PO','M006','pembelianpenerimaan','far fa-circle',310,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M036','Buku Utang','M006','hutang','far fa-circle',320,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M037','Retur Pembelian','M006','returpembelian','far fa-circle',330,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M038','Laporan','M006',NULL,'fas fa-print',340,1,'Aktif',''),('M039','Lap. Pembelian','M038','lappembelian','far fa-circle',350,2,'Aktif','Lihat'),('M040','Lap. Rincian Utang','M038','lapbukuhutang','far fa-circle',360,2,'Aktif','Lihat'),('M041','Lap. Rekap Utang','M038','laprekaphutang','far fa-circle',370,2,'Aktif','Lihat'),('M042','Lap. Retur Pembelian','M038','lapreturpembelian','far fa-circle',380,2,'Aktif','Lihat'),('M043','Penjualan','M007','penjualan','far fa-circle',400,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M044','Buku Piutang','M007','piutang','far fa-circle',410,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M045','Retur Penjualan','M007','returpenjualan','far fa-circle',420,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M046','Laporan','M007',NULL,'fas fa-print',430,1,'Aktif',''),('M047','Lap. Penjualan','M046','lappenjualan','far fa-circle',440,2,'Aktif','Lihat'),('M048','Lap. Rincian Piutang','M046','lapbukupiutang','far fa-circle',450,2,'Aktif','Lihat'),('M049','Lap. Rekap Piutang','M046','laprekappiutang','far fa-circle',460,2,'Aktif','Lihat'),('M050','Lap. Retur Penjualan','M046','lapreturpenjualan','far fa-circle',470,2,'Aktif','Lihat'),('M051','Pengeluaran','M008','pengeluaran','far fa-circle',490,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M052','Penerimaan','M008','penerimaan','far fa-circle',500,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M053','Lap. Pengeluaran','M008','lappengeluaran','fas fa-print',510,1,'Aktif','Lihat'),('M054','Lap. Penerimaan','M008','lappenerimaan','fas fa-print',520,1,'Aktif','Lihat'),('M055','Saldo Awal Akun','M009','saldoawal','far fa-circle',540,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M056','Jurnal Penyesuaian','M009','jurnal','far fa-circle',550,1,'Aktif','Lihat, Tambah, Edit, Hapus'),('M057','Posting Jurnal','M009','postingjurnal','far fa-circle',560,1,'Aktif','Lihat'),('M058','Buku Besar','M009','lapbukubesar','far fa-circle',570,1,'Aktif','Lihat'),('M059','Laporan Jurnal','M009','lapjurnal','far fa-circle',580,1,'Aktif','Lihat'),('M060','Laporan Neraca Saldo','M009','lapneracasaldo','far fa-circle',590,1,'Aktif','Lihat'),('M061','Laporan Laba Rugi','M009','laplabarugi','far fa-circle',600,1,'Aktif','Lihat');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_05_30_162951_create_sessions_table',1);

/*Table structure for table `otorisasi` */

DROP TABLE IF EXISTS `otorisasi`;

CREATE TABLE `otorisasi` (
  `idotorisasi` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namaotorisasi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idotorisasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `otorisasi` */

insert  into `otorisasi`(`idotorisasi`,`namaotorisasi`,`inserted_date`,`updated_date`,`statusaktif`) values ('AA001','Admin','2025-02-25 10:40:18','2025-02-25 10:40:20','Aktif'),('KL001','Kasir','2025-02-25 10:40:35','2025-02-25 10:40:37','Aktif');

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `pembelian` */

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `idpembelian` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idsupplier` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nofaktur` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglfaktur` date DEFAULT NULL,
  `tglditerima` date DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totalpembelian` decimal(18,0) NOT NULL DEFAULT '0',
  `totaldpp` decimal(18,0) DEFAULT '0',
  `totaldiskon` decimal(18,0) DEFAULT '0',
  `totalbersih` decimal(18,0) NOT NULL DEFAULT '0',
  `ppnpersen` int DEFAULT '0',
  `totalppn` decimal(18,0) DEFAULT '0',
  `biayapengiriman` decimal(18,0) DEFAULT '0',
  `totalpotongan` decimal(18,0) DEFAULT '0',
  `totalfaktur` decimal(18,0) DEFAULT '0',
  `inserted_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Hutang','Giro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nobilyetgiro` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglbilyetgiro` date DEFAULT NULL,
  `totaldpp_po` decimal(18,0) DEFAULT '0',
  `totalppn_po` decimal(18,0) DEFAULT '0',
  `totalfaktur_po` decimal(18,0) DEFAULT '0',
  `statuspenerimaan` enum('Belum Diterima','Sudah Diterima') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Belum Diterima',
  `tgl_po` date DEFAULT NULL,
  `keterangan_po` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpengguna_po` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idekspedisi` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpembelian`),
  KEY `idsupplier` (`idsupplier`),
  KEY `idpengguna` (`idpengguna`),
  KEY `tglfaktur` (`tglfaktur`),
  KEY `nofaktur` (`nofaktur`),
  KEY `idbank` (`idbank`),
  KEY `idekspedisi` (`idekspedisi`),
  CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`idsupplier`) REFERENCES `supplier` (`idsupplier`),
  CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `pembelian_ibfk_3` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`),
  CONSTRAINT `pembelian_ibfk_4` FOREIGN KEY (`idekspedisi`) REFERENCES `ekspedisi` (`idekspedisi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembelian` */

insert  into `pembelian`(`idpembelian`,`idsupplier`,`nofaktur`,`tglfaktur`,`tglditerima`,`keterangan`,`totalpembelian`,`totaldpp`,`totaldiskon`,`totalbersih`,`ppnpersen`,`totalppn`,`biayapengiriman`,`totalpotongan`,`totalfaktur`,`inserted_date`,`updated_date`,`idpengguna`,`carabayar`,`idbank`,`nobilyetgiro`,`tglbilyetgiro`,`totaldpp_po`,`totalppn_po`,`totalfaktur_po`,`statuspenerimaan`,`tgl_po`,`keterangan_po`,`idpengguna_po`,`idekspedisi`) values ('250522BL0000001','SUPMBD0001','333/FF','2025-05-22','2025-05-22','test',0,143245000,0,0,11,15755000,5000000,200000,158800000,'2025-05-22 06:47:11','2025-05-22 14:24:24','USRBID0001','Giro','BN001','212121','2025-05-22',143245000,15755000,159000000,'Sudah Diterima','2025-05-22','Pengadaan Awal','USRBID0001','EKSOHRR001'),('250606BL0000001','SUPMUF0001','123EE','2025-06-06','2025-06-06','Test',0,4054100,450000,0,11,445900,0,0,4050000,'2025-06-06 04:06:35','2025-06-06 04:13:38','USRBID0001','Hutang',NULL,NULL,'2025-06-06',4054100,445900,4500000,'Sudah Diterima','2025-06-06','Pembelian','USRBID0001','EKSOHRR001');

/*Table structure for table `pembeliandetail` */

DROP TABLE IF EXISTS `pembeliandetail`;

CREATE TABLE `pembeliandetail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idpembelian` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbarang` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahbeli` int DEFAULT '0',
  `hargasatuan` decimal(18,0) DEFAULT '0',
  `hargadpp` decimal(18,0) DEFAULT '0',
  `jumlahppn` decimal(18,0) DEFAULT '0',
  `jumlahdiskon` decimal(18,0) DEFAULT '0',
  `subtotalbeli` decimal(18,0) DEFAULT '0',
  `jenisdiskon` enum('Persen','Nominal') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `diskonpersen1` int DEFAULT '0',
  `diskonpersen2` int DEFAULT '0',
  `diskonpersen3` int DEFAULT '0',
  `jumlahbeli_po` int DEFAULT '0',
  `hargasatuan_po` int DEFAULT '0',
  `hargadpp_po` decimal(18,0) DEFAULT '0',
  `jumlahppn_po` decimal(18,0) DEFAULT '0',
  `subtotalbeli_po` decimal(18,0) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idpembelian` (`idpembelian`),
  KEY `idbarang` (`idbarang`),
  CONSTRAINT `pembeliandetail_ibfk_1` FOREIGN KEY (`idpembelian`) REFERENCES `pembelian` (`idpembelian`),
  CONSTRAINT `pembeliandetail_ibfk_2` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembeliandetail` */

insert  into `pembeliandetail`(`id`,`idpembelian`,`idbarang`,`jumlahbeli`,`hargasatuan`,`hargadpp`,`jumlahppn`,`jumlahdiskon`,`subtotalbeli`,`jenisdiskon`,`diskonpersen1`,`diskonpersen2`,`diskonpersen3`,`jumlahbeli_po`,`hargasatuan_po`,`hargadpp_po`,`jumlahppn_po`,`subtotalbeli_po`) values (77,'250522BL0000001','K001000001',1000,14000,12613,1387,0,14000000,'Nominal',0,0,0,1000,14000,12613,1387,14000000),(78,'250522BL0000001','K001000002',1000,45000,40541,4459,0,45000000,'Nominal',0,0,0,1000,45000,40541,4459,45000000),(79,'250522BL0000001','W001000001',1000,100000,90091,9909,0,100000000,'Nominal',0,0,0,1000,100000,90091,9909,100000000),(80,'250606BL0000001','K001000003',100,45000,40541,4459,4500,4050000,'Persen',10,0,0,100,45000,40541,4459,4500000);

/*Table structure for table `penagihan` */

DROP TABLE IF EXISTS `penagihan`;

CREATE TABLE `penagihan` (
  `idpenagihan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglpenagihan` date DEFAULT NULL,
  `tgltagihanakhir` date DEFAULT NULL,
  `idsales` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaltagihan` decimal(18,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statuscetak` enum('Sudah Cetak','Belum Cetak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpenagihan`),
  KEY `idsales` (`idsales`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `penagihan_ibfk_1` FOREIGN KEY (`idsales`) REFERENCES `sales` (`idsales`),
  CONSTRAINT `penagihan_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penagihan` */

insert  into `penagihan`(`idpenagihan`,`tglpenagihan`,`tgltagihanakhir`,`idsales`,`totaltagihan`,`inserted_date`,`updated_date`,`idpengguna`,`statuscetak`) values ('250527TAG000001','2025-05-27','2025-06-08','SLSJMQ0001',11650000,'2025-05-27 16:43:53','2025-05-27 16:43:53','USRBID0001','Sudah Cetak');

/*Table structure for table `penagihandetail` */

DROP TABLE IF EXISTS `penagihandetail`;

CREATE TABLE `penagihandetail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idpenagihan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpiutang` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahtagihan` decimal(18,0) DEFAULT NULL,
  `idsalesbonus` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idpenagihan` (`idpenagihan`),
  KEY `idsalesbonus` (`idsalesbonus`),
  CONSTRAINT `penagihandetail_ibfk_1` FOREIGN KEY (`idpenagihan`) REFERENCES `penagihan` (`idpenagihan`),
  CONSTRAINT `penagihandetail_ibfk_2` FOREIGN KEY (`idsalesbonus`) REFERENCES `sales` (`idsales`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penagihandetail` */

insert  into `penagihandetail`(`id`,`idpenagihan`,`idpiutang`,`jumlahtagihan`,`idsalesbonus`) values (7,'250527TAG000001','250522PI0001',11500000,'SLSJMQ0001'),(8,'250527TAG000001','250527PI0001',150000,'SLSSKN0001');

/*Table structure for table `penerimaan` */

DROP TABLE IF EXISTS `penerimaan`;

CREATE TABLE `penerimaan` (
  `idpenerimaan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglpenerimaan` date DEFAULT NULL,
  `totalpenerimaan` decimal(18,0) DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpenerimaan`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idbank` (`idbank`),
  CONSTRAINT `penerimaan_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `penerimaan_ibfk_2` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penerimaan` */

insert  into `penerimaan`(`idpenerimaan`,`tglpenerimaan`,`totalpenerimaan`,`keterangan`,`inserted_date`,`updated_date`,`idpengguna`,`carabayar`,`idbank`) values ('250308PN0000001','2025-03-08',1600000,'test','2025-03-08 08:58:27','2025-03-08 09:00:35','USRBID0001','Transfer','BN001');

/*Table structure for table `penerimaandetail` */

DROP TABLE IF EXISTS `penerimaandetail`;

CREATE TABLE `penerimaandetail` (
  `idpenerimaandetail` int NOT NULL AUTO_INCREMENT,
  `idpenerimaan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahpenerimaan` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`idpenerimaandetail`),
  KEY `idpenerimaan` (`idpenerimaan`),
  KEY `kdakun` (`kdakun`),
  CONSTRAINT `penerimaandetail_ibfk_1` FOREIGN KEY (`idpenerimaan`) REFERENCES `penerimaan` (`idpenerimaan`),
  CONSTRAINT `penerimaandetail_ibfk_2` FOREIGN KEY (`kdakun`) REFERENCES `akun` (`kdakun`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penerimaandetail` */

insert  into `penerimaandetail`(`idpenerimaandetail`,`idpenerimaan`,`kdakun`,`jumlahpenerimaan`) values (2,'250308PN0000001','4.2.01.01',1500000),(3,'250308PN0000001','4.1.01.01',100000);

/*Table structure for table `pengeluaran` */

DROP TABLE IF EXISTS `pengeluaran`;

CREATE TABLE `pengeluaran` (
  `idpengeluaran` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglpengeluaran` date DEFAULT NULL,
  `nokwitansi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totalpengeluaran` decimal(18,0) DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpengeluaran`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idbank` (`idbank`),
  CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengeluaran` */

insert  into `pengeluaran`(`idpengeluaran`,`tglpengeluaran`,`nokwitansi`,`totalpengeluaran`,`keterangan`,`inserted_date`,`updated_date`,`idpengguna`,`carabayar`,`idbank`) values ('250316PL0000001','2025-03-16','123/TS/2025',60500000,'Pembayaran Gaji Pegawai Bulan Maret 2025','2025-03-16 04:28:55','2025-03-16 04:28:55','USRBID0001','Transfer','BN001');

/*Table structure for table `pengeluarandetail` */

DROP TABLE IF EXISTS `pengeluarandetail`;

CREATE TABLE `pengeluarandetail` (
  `idpengeluarandetail` int NOT NULL AUTO_INCREMENT,
  `idpengeluaran` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahpengeluaran` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`idpengeluarandetail`),
  KEY `kdakun` (`kdakun`),
  KEY `idpengeluaran` (`idpengeluaran`),
  CONSTRAINT `pengeluarandetail_ibfk_1` FOREIGN KEY (`kdakun`) REFERENCES `akun` (`kdakun`),
  CONSTRAINT `pengeluarandetail_ibfk_2` FOREIGN KEY (`idpengeluaran`) REFERENCES `pengeluaran` (`idpengeluaran`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengeluarandetail` */

insert  into `pengeluarandetail`(`idpengeluarandetail`,`idpengeluaran`,`kdakun`,`jumlahpengeluaran`) values (4,'250316PL0000001','5.1.01.01',60500000);

/*Table structure for table `pengguna` */

DROP TABLE IF EXISTS `pengguna`;

CREATE TABLE `pengguna` (
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namapengguna` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jeniskelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelppengguna` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emailpengguna` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fotopengguna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idotorisasi` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`idpengguna`),
  UNIQUE KEY `emailpengguna` (`emailpengguna`),
  UNIQUE KEY `username` (`username`),
  KEY `idotorisasi` (`idotorisasi`),
  CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`idotorisasi`) REFERENCES `otorisasi` (`idotorisasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengguna` */

insert  into `pengguna`(`idpengguna`,`namapengguna`,`jeniskelamin`,`notelppengguna`,`emailpengguna`,`fotopengguna`,`username`,`password`,`idotorisasi`,`inserted_date`,`updated_date`,`statusaktif`,`lastlogin`) values ('9999999999','TZ Developer','Laki-laki','081200000000','admin@tzdeveloper.com',NULL,'tzdeveloper','$2y$12$Ev0AqPnl6jkwJ4Bu9vj4K.hbIN4MlqAXLVjX9KYH8MRegBkNc.w1.','AA001','2025-08-19 03:12:46','2025-08-19 03:12:46','Aktif','2026-01-22 09:34:20'),('USRBID0001','Budiman','Laki-laki','00000000000000000000','budi@gmail.com','karsten_winegeart_1grm2kdwykc_unsplash.jpg','budi','$2y$12$.YlF62K4niNYCM0mp/.RNOaptVdA4U3awYXzCJ61ghNIvsxgi9HyS','KL001','2025-02-25 04:37:28','2025-03-14 06:11:58','Aktif','2025-08-20 02:25:41');

/*Table structure for table `pengguna_menus` */

DROP TABLE IF EXISTS `pengguna_menus`;

CREATE TABLE `pengguna_menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idmenus` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hakaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idmenus` (`idmenus`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `pengguna_menus_ibfk_1` FOREIGN KEY (`idmenus`) REFERENCES `menus` (`idmenus`),
  CONSTRAINT `pengguna_menus_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=348 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengguna_menus` */

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idkonsumen` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglinvoice` date DEFAULT NULL,
  `noinvoice` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totalpenjualan` decimal(18,0) DEFAULT '0',
  `totaldpp` decimal(18,0) DEFAULT '0',
  `totaldiskon` decimal(18,0) DEFAULT '0',
  `totalbersih` decimal(18,0) DEFAULT '0',
  `ppnpersen` int DEFAULT '0',
  `totalppn` decimal(18,0) DEFAULT '0',
  `biayapengiriman` decimal(18,0) DEFAULT '0',
  `totalinvoice` decimal(18,0) DEFAULT '0',
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Piutang','Giro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idjenispiutang` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idsales` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nokwitansi` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nobilyetgiro` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idpenjualan`),
  UNIQUE KEY `noinvoice` (`noinvoice`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idkonsumen` (`idkonsumen`),
  KEY `idbank` (`idbank`),
  KEY `idjenispiutang` (`idjenispiutang`),
  KEY `tglpenjualan` (`tglinvoice`),
  KEY `idsales` (`idsales`),
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`idkonsumen`) REFERENCES `konsumen` (`idkonsumen`),
  CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`),
  CONSTRAINT `penjualan_ibfk_4` FOREIGN KEY (`idjenispiutang`) REFERENCES `jenispiutang` (`idjenispiutang`),
  CONSTRAINT `penjualan_ibfk_5` FOREIGN KEY (`idsales`) REFERENCES `sales` (`idsales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penjualan` */

insert  into `penjualan`(`idpenjualan`,`idkonsumen`,`tglinvoice`,`noinvoice`,`keterangan`,`totalpenjualan`,`totaldpp`,`totaldiskon`,`totalbersih`,`ppnpersen`,`totalppn`,`biayapengiriman`,`totalinvoice`,`idpengguna`,`inserted_date`,`updated_date`,`carabayar`,`idbank`,`idjenispiutang`,`idsales`,`nokwitansi`,`nobilyetgiro`) values ('250522JL0000001','KUE001','2025-05-22','SJA/2505/000001','Pengadan Pipa',0,10860400,500000,0,11,1139600,0,11500000,'USRBID0001','2025-05-22 07:42:43','2025-05-22 07:42:43','Piutang',NULL,'P03','SLSJMQ0001',NULL,NULL),('250527JL0000001','IPJ001','2025-05-27','SJA/2505/000002','Ket',0,135140,0,0,11,14860,0,150000,'USRBID0001','2025-05-27 13:30:38','2025-05-27 13:30:38','Piutang',NULL,'P03','SLSSKN0001',NULL,NULL),('250813JL0000001','KUE001','2025-08-13','SJA/2508/000003','Test',0,1729750,375000,0,11,190250,0,1545000,'USRBID0001','2025-08-13 15:12:43','2025-08-13 15:12:43','Tunai',NULL,NULL,'SLSKES0001','250813JL0000001#01',NULL),('250813JL0000002','SKE001','2025-08-13','SJA/2508/000004','Test',0,664875,0,0,11,73125,0,738000,'USRBID0001','2025-08-13 15:43:19','2025-08-13 15:43:19','Tunai',NULL,NULL,'SLSKES0001','250813JL0000002#01',NULL);

/*Table structure for table `penjualandetail` */

DROP TABLE IF EXISTS `penjualandetail`;

CREATE TABLE `penjualandetail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbarang` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahjual` int DEFAULT '0',
  `hargasatuan` decimal(18,0) DEFAULT '0',
  `hargadpp` decimal(18,0) DEFAULT NULL,
  `jumlahppn` decimal(18,0) DEFAULT NULL,
  `jumlahdiskon` decimal(18,0) DEFAULT '0',
  `subtotaljual` decimal(18,0) DEFAULT '0',
  `jenisdiskon` enum('Persen','Nominal') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `diskonpersen1` int DEFAULT NULL,
  `diskonpersen2` int DEFAULT NULL,
  `diskonpersen3` int DEFAULT NULL,
  `jenisbonuspenjualan` enum('Nominal','Persen') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `persenbonuspenjualan` decimal(3,2) DEFAULT '0.00',
  `jumlahbonuspenjualan` decimal(18,0) DEFAULT '0',
  `subtotalbonuspenjualan` decimal(18,0) DEFAULT '0',
  `jenisbonustagihan` enum('Nominal','Persen') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `persenbonustagihan` decimal(3,2) DEFAULT '0.00',
  `jumlahbonustagihan` decimal(18,0) DEFAULT '0',
  `subtotalbonustagihan` decimal(18,0) DEFAULT '0',
  `idjenisbarang` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `persenbonustarget` decimal(3,2) DEFAULT NULL,
  `subtotalbonustarget` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idpenjualan` (`idpenjualan`),
  KEY `idbarang` (`idbarang`),
  CONSTRAINT `penjualandetail_ibfk_1` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`),
  CONSTRAINT `penjualandetail_ibfk_2` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penjualandetail` */

insert  into `penjualandetail`(`id`,`idpenjualan`,`idbarang`,`jumlahjual`,`hargasatuan`,`hargadpp`,`jumlahppn`,`jumlahdiskon`,`subtotaljual`,`jenisdiskon`,`diskonpersen1`,`diskonpersen2`,`diskonpersen3`,`jenisbonuspenjualan`,`persenbonuspenjualan`,`jumlahbonuspenjualan`,`subtotalbonuspenjualan`,`jenisbonustagihan`,`persenbonustagihan`,`jumlahbonustagihan`,`subtotalbonustagihan`,`idjenisbarang`,`persenbonustarget`,`subtotalbonustarget`) values (88,'250522JL0000001','W001000001',100,120000,108604,11396,5000,11500000,'Nominal',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(90,'250527JL0000001','K001000001',10,15000,13514,1486,0,150000,'Nominal',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(91,'250813JL0000001','K001000002',15,48000,43244,4756,25000,345000,'Nominal',0,0,0,NULL,0.00,0,0,NULL,0.00,0,0,NULL,NULL,NULL),(92,'250813JL0000001','W001000001',10,120000,108109,11891,0,1200000,'Nominal',0,0,0,NULL,0.00,0,0,NULL,0.00,0,0,NULL,NULL,NULL),(93,'250813JL0000002','K001000002',12,48000,43244,4756,0,576000,'Nominal',0,0,0,NULL,0.00,0,0,NULL,0.00,0,0,NULL,NULL,NULL),(94,'250813JL0000002','K001000003',3,54000,48649,5351,0,162000,'Nominal',0,0,0,NULL,0.00,0,0,NULL,0.00,0,0,NULL,NULL,NULL);

/*Table structure for table `penjualankwitansi` */

DROP TABLE IF EXISTS `penjualankwitansi`;

CREATE TABLE `penjualankwitansi` (
  `nokwitansi` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglkwitansi` date NOT NULL,
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `totalplusppn` decimal(18,0) DEFAULT '0',
  `jumlahsudahbayar` decimal(18,0) DEFAULT '0',
  `jumlahbayar` decimal(18,0) DEFAULT '0',
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Giro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`nokwitansi`),
  KEY `idpenjualan` (`idpenjualan`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idbank` (`idbank`),
  CONSTRAINT `penjualankwitansi_ibfk_1` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`),
  CONSTRAINT `penjualankwitansi_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `penjualankwitansi_ibfk_3` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penjualankwitansi` */

insert  into `penjualankwitansi`(`nokwitansi`,`tglkwitansi`,`idpenjualan`,`totalplusppn`,`jumlahsudahbayar`,`jumlahbayar`,`inserted_date`,`updated_date`,`idpengguna`,`carabayar`,`idbank`) values ('250522JL0000001#01','2025-05-29','250522JL0000001',11500000,0,5000000,'2025-07-11 09:26:07','2025-07-11 09:26:07','USRBID0001','Tunai',NULL),('250522JL0000001#02','2025-07-11','250522JL0000001',11500000,5000000,6500000,'2025-07-11 15:09:50','2025-07-11 15:09:50','USRBID0001','Tunai',NULL),('250813JL0000001#01','2025-08-13','250813JL0000001',1545000,0,1545000,'2025-08-13 15:12:43','2025-08-13 15:12:43','USRBID0001','Tunai',NULL),('250813JL0000002#01','2025-08-13','250813JL0000002',738000,0,738000,'2025-08-13 15:43:19','2025-08-13 15:43:19','USRBID0001','Tunai',NULL);

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `piutang` */

DROP TABLE IF EXISTS `piutang`;

CREATE TABLE `piutang` (
  `idpiutang` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idjenispiutang` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglpiutang` date DEFAULT NULL,
  `tgljatuhtempo` date DEFAULT NULL,
  `idkonsumen` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaldebet` decimal(10,0) DEFAULT NULL,
  `totalkredit` decimal(10,0) DEFAULT NULL,
  `jenissumber` enum('Penjualan','Saldo') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Penjualan',
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgllunas` date DEFAULT NULL,
  PRIMARY KEY (`idpiutang`),
  KEY `idpenjualan` (`idpenjualan`),
  KEY `idkonsumen` (`idkonsumen`),
  KEY `idjenispiutang` (`idjenispiutang`),
  CONSTRAINT `piutang_ibfk_1` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`),
  CONSTRAINT `piutang_ibfk_2` FOREIGN KEY (`idkonsumen`) REFERENCES `konsumen` (`idkonsumen`),
  CONSTRAINT `piutang_ibfk_3` FOREIGN KEY (`idjenispiutang`) REFERENCES `jenispiutang` (`idjenispiutang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `piutang` */

insert  into `piutang`(`idpiutang`,`idpenjualan`,`idjenispiutang`,`tglpiutang`,`tgljatuhtempo`,`idkonsumen`,`totaldebet`,`totalkredit`,`jenissumber`,`keterangan`,`tgllunas`) values ('250522PI0001','250522JL0000001','P03','2025-05-22','2025-05-29','KUE001',11500000,11500000,'Penjualan','Piutang Penjualan dengan No Invoice SJA/2505/000001','2025-07-11'),('250527PI0001','250527JL0000001','P03','2025-05-27','2025-06-03','IPJ001',150000,0,'Penjualan','Piutang Penjualan dengan No Invoice SJA/2505/000002',NULL);

/*Table structure for table `piutangdetail` */

DROP TABLE IF EXISTS `piutangdetail`;

CREATE TABLE `piutangdetail` (
  `idpiutangdetail` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idpiutang` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglpiutang` date DEFAULT NULL,
  `debet` decimal(18,0) DEFAULT NULL,
  `kredit` decimal(18,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Giro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` enum('Piutang','Pembayaran Piutang') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nokwitansi` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nobilyetgiro` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bonuspenagihansudahdibayar` tinyint DEFAULT '0',
  PRIMARY KEY (`idpiutangdetail`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idbank` (`idbank`),
  KEY `idpiutang` (`idpiutang`),
  CONSTRAINT `piutangdetail_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `piutangdetail_ibfk_3` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`),
  CONSTRAINT `piutangdetail_ibfk_4` FOREIGN KEY (`idpiutang`) REFERENCES `piutang` (`idpiutang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `piutangdetail` */

insert  into `piutangdetail`(`idpiutangdetail`,`idpiutang`,`tglpiutang`,`debet`,`kredit`,`inserted_date`,`updated_date`,`idpengguna`,`carabayar`,`idbank`,`jenis`,`nokwitansi`,`nobilyetgiro`,`bonuspenagihansudahdibayar`) values ('250522PI0001001','250522PI0001','2025-05-22',11500000,0,'2025-05-22 07:42:43','2025-05-22 07:42:43','USRBID0001',NULL,NULL,'Piutang',NULL,NULL,0),('250522PI0001002','250522PI0001','2025-05-29',0,5000000,'2025-07-11 09:26:07','2025-07-11 09:26:07','USRBID0001','Tunai',NULL,'Pembayaran Piutang','250522JL0000001#01',NULL,0),('250522PI0001003','250522PI0001','2025-07-11',0,6500000,'2025-07-11 15:09:50','2025-07-11 15:09:50','USRBID0001','Tunai',NULL,'Pembayaran Piutang','250522JL0000001#02',NULL,0),('250527PI0001001','250527PI0001','2025-05-27',150000,0,'2025-05-27 13:30:39','2025-05-27 13:30:39','USRBID0001',NULL,NULL,'Piutang',NULL,NULL,0);

/*Table structure for table `postingjurnal` */

DROP TABLE IF EXISTS `postingjurnal`;

CREATE TABLE `postingjurnal` (
  `idposting` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bulan` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahdebet` decimal(18,0) DEFAULT NULL,
  `jumlahkredit` decimal(18,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idposting`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `postingjurnal_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `postingjurnal` */

/*Table structure for table `returpembelian` */

DROP TABLE IF EXISTS `returpembelian`;

CREATE TABLE `returpembelian` (
  `idreturpembelian` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idpembelian` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglretur` date DEFAULT NULL,
  `totalretur` decimal(18,0) DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusretur` enum('Proses','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Proses',
  `tglpengajuan` date DEFAULT NULL,
  PRIMARY KEY (`idreturpembelian`),
  KEY `idpembelian` (`idpembelian`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idbank` (`idbank`),
  CONSTRAINT `returpembelian_ibfk_1` FOREIGN KEY (`idpembelian`) REFERENCES `pembelian` (`idpembelian`),
  CONSTRAINT `returpembelian_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `returpembelian_ibfk_3` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `returpembelian` */

/*Table structure for table `returpembeliandetail` */

DROP TABLE IF EXISTS `returpembeliandetail`;

CREATE TABLE `returpembeliandetail` (
  `idreturdetail` int NOT NULL AUTO_INCREMENT,
  `idreturpembelian` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idbarang` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jumlahretur` int DEFAULT NULL,
  `hargaretur` decimal(18,0) DEFAULT NULL,
  `subtotalretur` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`idreturdetail`),
  KEY `idreturpembelian` (`idreturpembelian`),
  KEY `idbarang` (`idbarang`),
  CONSTRAINT `returpembeliandetail_ibfk_1` FOREIGN KEY (`idreturpembelian`) REFERENCES `returpembelian` (`idreturpembelian`),
  CONSTRAINT `returpembeliandetail_ibfk_2` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `returpembeliandetail` */

/*Table structure for table `returpenjualan` */

DROP TABLE IF EXISTS `returpenjualan`;

CREATE TABLE `returpenjualan` (
  `idreturpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglretur` date DEFAULT NULL,
  `totalretur` decimal(18,0) DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idreturpenjualan`),
  KEY `idpenjualan` (`idpenjualan`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idbank` (`idbank`),
  CONSTRAINT `returpenjualan_ibfk_1` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`),
  CONSTRAINT `returpenjualan_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `returpenjualan_ibfk_3` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `returpenjualan` */

/*Table structure for table `returpenjualandetail` */

DROP TABLE IF EXISTS `returpenjualandetail`;

CREATE TABLE `returpenjualandetail` (
  `idreturdetail` int NOT NULL AUTO_INCREMENT,
  `idreturpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idbarang` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jumlahretur` int DEFAULT NULL,
  `hargaretur` decimal(18,0) DEFAULT NULL,
  `subtotalretur` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`idreturdetail`),
  KEY `idreturpenjualan` (`idreturpenjualan`),
  KEY `idbarang` (`idbarang`),
  CONSTRAINT `returpenjualandetail_ibfk_1` FOREIGN KEY (`idreturpenjualan`) REFERENCES `returpenjualan` (`idreturpenjualan`),
  CONSTRAINT `returpenjualandetail_ibfk_2` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `returpenjualandetail` */

/*Table structure for table `riwayataktifitas` */

DROP TABLE IF EXISTS `riwayataktifitas`;

CREATE TABLE `riwayataktifitas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `namapengguna` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `namatabel` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namafunction` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1574 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `riwayataktifitas` */

insert  into `riwayataktifitas`(`id`,`deskripsi`,`namapengguna`,`inserted_date`,`namatabel`,`namafunction`,`idpengguna`) values (1572,'{\"lastlogout\":\"2026-01-22 09:34:12\"}','TZ Developer','2026-01-22 09:34:12','aplikasi','logout','9999999999'),(1573,'{\"lastlogin\":\"2026-01-22 09:34:20\"}','TZ Developer','2026-01-22 09:34:20','aplikasi','login','9999999999');

/*Table structure for table `riwayathutangekspedisi` */

DROP TABLE IF EXISTS `riwayathutangekspedisi`;

CREATE TABLE `riwayathutangekspedisi` (
  `idriwayat` int NOT NULL,
  `tglriwayat` datetime DEFAULT NULL,
  `idtransaksi` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgltransaksi` date DEFAULT NULL,
  `idekspedisi` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `saldoawal` decimal(18,0) DEFAULT '0',
  `debet` decimal(18,0) DEFAULT '0',
  `kredit` decimal(18,0) DEFAULT '0',
  `saldoakhir` decimal(18,0) DEFAULT '0',
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapengguna` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenistransaksi` enum('Pembelian','Penjualan','Pembayaran') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idriwayat`),
  KEY `idekspedisi` (`idekspedisi`),
  CONSTRAINT `riwayathutangekspedisi_ibfk_1` FOREIGN KEY (`idekspedisi`) REFERENCES `ekspedisi` (`idekspedisi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `riwayathutangekspedisi` */

/*Table structure for table `riwayatstok` */

DROP TABLE IF EXISTS `riwayatstok`;

CREATE TABLE `riwayatstok` (
  `idriwayat` int NOT NULL AUTO_INCREMENT,
  `tglriwayat` datetime DEFAULT NULL,
  `idtransaksi` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgltransaksi` date DEFAULT NULL,
  `idbarang` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stokawal` int DEFAULT NULL,
  `stokmasuk` int DEFAULT NULL,
  `stokkeluar` int DEFAULT NULL,
  `stokakhir` int DEFAULT NULL,
  `hargasebelumdiskon` decimal(18,0) DEFAULT NULL,
  `hargasetelahdiskon` decimal(18,0) DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapengguna` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenistransaksi` enum('Pembelian','Penjualan','Retur Pembelian','Retur Penjualan','Stock Opname') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hargasatuan` decimal(18,0) DEFAULT NULL,
  `hargadpp` decimal(18,0) DEFAULT NULL,
  `jumlahppn` decimal(18,0) DEFAULT NULL,
  `jumlahdiskon` decimal(18,0) DEFAULT NULL,
  `subtotal` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`idriwayat`),
  KEY `idbarang` (`idbarang`),
  CONSTRAINT `riwayatstok_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=476 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `riwayatstok` */

insert  into `riwayatstok`(`idriwayat`,`tglriwayat`,`idtransaksi`,`tgltransaksi`,`idbarang`,`stokawal`,`stokmasuk`,`stokkeluar`,`stokakhir`,`hargasebelumdiskon`,`hargasetelahdiskon`,`deskripsi`,`idpengguna`,`namapengguna`,`jenistransaksi`,`hargasatuan`,`hargadpp`,`jumlahppn`,`jumlahdiskon`,`subtotal`) values (389,'2025-05-22 06:47:58','250522BL0000001','2025-01-01','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(390,'2025-05-22 06:47:58','250522BL0000001','2025-01-01','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(391,'2025-05-22 06:47:58','250522BL0000001','2025-01-01','W001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(392,'2025-05-22 06:48:14','250522BL0000001','2025-01-01','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(393,'2025-05-22 06:48:14','250522BL0000001','2025-01-01','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(394,'2025-05-22 06:48:14','250522BL0000001','2025-01-01','W001000001',1000,0,1000,0,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(395,'2025-05-22 06:48:52','250522BL0000001','2025-01-01','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(396,'2025-05-22 06:48:52','250522BL0000001','2025-01-01','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(397,'2025-05-22 06:48:52','250522BL0000001','2025-01-01','W001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(398,'2025-05-22 06:51:01','250522RB0000001','2025-05-22','K001000001',1000,0,10,990,NULL,14000,'Retur Pembelian','USRBID0001','Budiman','Retur Pembelian',NULL,NULL,NULL,NULL,NULL),(399,'2025-05-22 06:51:45','250522RB0000001','2025-05-22','K001000001',990,10,0,1000,NULL,14000,'Hapus data retur pembelian','USRBID0001','Budiman','Retur Pembelian',NULL,NULL,NULL,NULL,NULL),(400,'2025-05-22 06:53:14','250522BL0000001','2025-01-01','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(401,'2025-05-22 06:53:14','250522BL0000001','2025-01-01','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(402,'2025-05-22 06:53:14','250522BL0000001','2025-01-01','W001000001',1000,0,1000,0,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(403,'2025-05-22 06:54:46','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(404,'2025-05-22 06:54:46','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(405,'2025-05-22 06:54:46','250522BL0000001','2025-05-22','W001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(406,'2025-05-22 07:37:07','250522RB0000001','2025-05-22','W001000001',1000,0,50,950,NULL,100000,'Retur Pembelian','USRBID0001','Budiman','Retur Pembelian',NULL,NULL,NULL,NULL,NULL),(407,'2025-05-22 07:37:54','250522RB0000001','2025-05-22','W001000001',950,50,0,1000,NULL,100000,'Hapus data retur pembelian','USRBID0001','Budiman','Retur Pembelian',NULL,NULL,NULL,NULL,NULL),(412,'2025-05-22 12:22:46','250522SJ01','2025-05-22','W001000001',1000,0,100,900,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(413,'2025-05-22 12:33:25','250522SJ01','2025-05-22','W001000001',900,100,0,1000,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(414,'2025-05-22 12:33:25','250522SJ01','2025-05-22','W001000001',1000,0,100,900,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(415,'2025-05-22 12:50:43','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(416,'2025-05-22 12:50:43','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(417,'2025-05-22 12:50:43','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(418,'2025-05-22 12:51:45','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(419,'2025-05-22 12:51:45','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(420,'2025-05-22 12:51:45','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(421,'2025-05-22 12:53:55','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(422,'2025-05-22 12:53:55','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(423,'2025-05-22 12:53:55','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(424,'2025-05-22 12:54:21','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(425,'2025-05-22 12:54:21','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(426,'2025-05-22 12:54:21','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(427,'2025-05-22 12:54:40','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(428,'2025-05-22 12:54:40','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(429,'2025-05-22 12:54:40','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(430,'2025-05-22 12:55:16','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(431,'2025-05-22 12:55:16','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(432,'2025-05-22 12:55:16','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(433,'2025-05-22 13:01:04','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(434,'2025-05-22 13:01:04','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(435,'2025-05-22 13:01:04','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(436,'2025-05-22 13:01:45','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(437,'2025-05-22 13:01:45','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(438,'2025-05-22 13:01:45','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(439,'2025-05-22 13:26:23','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(440,'2025-05-22 13:26:23','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(441,'2025-05-22 13:26:23','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(442,'2025-05-22 14:22:36','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(443,'2025-05-22 14:22:36','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(444,'2025-05-22 14:22:36','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(445,'2025-05-22 14:23:31','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(446,'2025-05-22 14:23:31','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(447,'2025-05-22 14:23:31','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(448,'2025-05-22 14:24:24','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(449,'2025-05-22 14:24:24','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(450,'2025-05-22 14:24:24','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(452,'2025-05-23 08:16:20','250522SJ01','2025-05-22','W001000001',900,100,0,1000,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(453,'2025-05-23 08:17:09','250523SJ01','2025-05-23','W001000001',1000,0,100,900,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(454,'2025-05-23 08:20:41','250523SJ01','2025-05-23','W001000001',900,100,0,1000,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(455,'2025-05-23 08:20:41','250523SJ01','2025-05-23','W001000001',1000,0,100,900,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(456,'2025-05-23 08:22:01','250523SJ01','2025-05-23','W001000001',900,100,0,1000,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(457,'2025-05-27 13:37:53','250527SJ01','2025-05-27','K001000001',1000,0,10,990,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',15000,13514,1486,0,150000),(458,'2025-05-27 16:43:12','250527SJ02','2025-05-27','W001000001',1000,0,100,900,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(459,'2025-06-06 04:13:38','250606BL0000001','2025-06-06','K001000003',0,100,0,100,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,4500,4050000),(460,'2025-08-13 15:36:55','250813SJ01','2025-08-13','K001000002',1000,0,15,985,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',48000,43244,4756,25000,345000),(461,'2025-08-13 15:36:55','250813SJ01','2025-08-13','W001000001',900,0,10,890,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',120000,108109,11891,0,1200000),(462,'2025-08-13 15:44:15','250813SJ02','2025-08-13','K001000002',985,0,12,973,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',48000,43244,4756,0,576000),(463,'2025-08-13 15:44:15','250813SJ02','2025-08-13','K001000003',100,0,3,97,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',54000,48649,5351,0,162000),(464,'2025-08-13 15:45:25','250813SJ02','2025-08-13','K001000002',973,12,0,985,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',48000,43244,4756,0,576000),(465,'2025-08-13 15:45:25','250813SJ02','2025-08-13','K001000003',97,3,0,100,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',54000,48649,5351,0,162000),(466,'2025-08-13 15:45:25','250813SJ02','2025-08-13','K001000002',985,0,12,973,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',48000,43244,4756,0,576000),(467,'2025-08-13 15:45:25','250813SJ02','2025-08-13','K001000003',100,0,3,97,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',54000,48649,5351,0,162000),(468,'2025-08-19 07:04:14','250813SJ02','2025-08-13','K001000002',973,12,0,985,NULL,NULL,'Update data surat jalan','9999999999','TZ Developer','Penjualan',48000,43244,4756,0,576000),(469,'2025-08-19 07:04:14','250813SJ02','2025-08-13','K001000003',97,3,0,100,NULL,NULL,'Update data surat jalan','9999999999','TZ Developer','Penjualan',54000,48649,5351,0,162000),(470,'2025-08-19 07:04:14','250813SJ02','2025-08-13','K001000002',985,0,12,973,NULL,NULL,'Update data surat jalan','9999999999','TZ Developer','Penjualan',48000,43244,4756,0,576000),(471,'2025-08-19 07:04:14','250813SJ02','2025-08-13','K001000003',100,0,3,97,NULL,NULL,'Update data surat jalan','9999999999','TZ Developer','Penjualan',54000,48649,5351,0,162000),(472,'2025-08-19 07:04:19','250813SJ02','2025-08-13','K001000002',973,12,0,985,NULL,NULL,'Update data surat jalan','9999999999','TZ Developer','Penjualan',48000,43244,4756,0,576000),(473,'2025-08-19 07:04:19','250813SJ02','2025-08-13','K001000003',97,3,0,100,NULL,NULL,'Update data surat jalan','9999999999','TZ Developer','Penjualan',54000,48649,5351,0,162000),(474,'2025-08-19 07:04:19','250813SJ02','2025-08-13','K001000002',985,0,12,973,NULL,NULL,'Update data surat jalan','9999999999','TZ Developer','Penjualan',48000,43244,4756,0,576000),(475,'2025-08-19 07:04:19','250813SJ02','2025-08-13','K001000003',100,0,3,97,NULL,NULL,'Update data surat jalan','9999999999','TZ Developer','Penjualan',54000,48649,5351,0,162000);

/*Table structure for table `saldoawal` */

DROP TABLE IF EXISTS `saldoawal`;

CREATE TABLE `saldoawal` (
  `idsaldoawal` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaldebet` decimal(18,0) DEFAULT NULL,
  `totalkredit` decimal(18,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idsaldoawal`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `saldoawal_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `saldoawal` */

insert  into `saldoawal`(`idsaldoawal`,`tahun`,`totaldebet`,`totalkredit`,`inserted_date`,`updated_date`,`idpengguna`) values ('2025','2025',100000000,100000000,'2025-04-25 14:59:34','2025-04-25 14:59:34','USRBID0001');

/*Table structure for table `saldoawaldetail` */

DROP TABLE IF EXISTS `saldoawaldetail`;

CREATE TABLE `saldoawaldetail` (
  `idsaldoawal` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `debet` decimal(18,0) DEFAULT NULL,
  `kredit` decimal(18,0) DEFAULT NULL,
  KEY `idsaldoawal` (`idsaldoawal`),
  KEY `kdakun` (`kdakun`),
  CONSTRAINT `saldoawaldetail_ibfk_1` FOREIGN KEY (`idsaldoawal`) REFERENCES `saldoawal` (`idsaldoawal`),
  CONSTRAINT `saldoawaldetail_ibfk_2` FOREIGN KEY (`kdakun`) REFERENCES `akun` (`kdakun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `saldoawaldetail` */

insert  into `saldoawaldetail`(`idsaldoawal`,`kdakun`,`debet`,`kredit`) values ('2025','1.1.01.01',100000000,0),('2025','2.1.01.01',0,10000000),('2025','3.1.01.01',0,90000000);

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `idsales` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namasales` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jeniskelamin` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nik` char(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempatlahir` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `agama` enum('Islam','Katolik','Kristen Protestan','Hindu','Buddha','Konghucu') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamatktp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `alamattinggal` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `statusperkawinan` enum('Kawin','Tidak Kawin','Janda/ Duda') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nowa` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglkontrak` date DEFAULT NULL,
  `filekontrak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `npwp` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `targetpenjualan` decimal(18,0) DEFAULT '0',
  PRIMARY KEY (`idsales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `sales` */

insert  into `sales`(`idsales`,`namasales`,`jeniskelamin`,`nik`,`tempatlahir`,`tgllahir`,`agama`,`alamatktp`,`alamattinggal`,`statusperkawinan`,`nowa`,`email`,`tglkontrak`,`filekontrak`,`inserted_date`,`updated_date`,`statusaktif`,`npwp`,`targetpenjualan`) values ('SLSJMQ0001','Jaja Miharga','Laki-laki','3243243243242342','Pontianak','1990-01-01','Islam','Jl. Patimura','Jl. Patimura','Kawin','0812000000','NULL','2025-05-20',NULL,'2025-05-20 14:23:33','2025-05-30 15:03:19','Aktif','829182198291919',10000000),('SLSKES0001','Khairuddin','Laki-laki','1234444555566666','Pontianak','1990-03-13','Islam','Jl. Pemuda','Jl. Pelangi','Tidak Kawin','08135553330000','khairuddin@gmail.com','2025-03-13',NULL,'2025-03-13 06:40:22','2025-05-20 14:24:00','Aktif','123456789012345',100000000),('SLSSKN0001','Siti Khadizah','Perempuan','1111111111111111','Jakarta','2000-12-02','Islam','Jl. Patimura','Jl. Patimura','Kawin','081302500000000','siti@gmail.com','2025-02-25','mbarang.xls','2025-02-25 02:25:08','2025-05-30 15:01:00','Aktif','456456456456456',1000000);

/*Table structure for table `saleswilayah` */

DROP TABLE IF EXISTS `saleswilayah`;

CREATE TABLE `saleswilayah` (
  `idsaleswilayah` int NOT NULL AUTO_INCREMENT,
  `idsales` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idwilayah` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idsaleswilayah`),
  UNIQUE KEY `idsales` (`idsales`,`idwilayah`),
  KEY `idwilayah` (`idwilayah`),
  CONSTRAINT `saleswilayah_ibfk_1` FOREIGN KEY (`idsales`) REFERENCES `sales` (`idsales`),
  CONSTRAINT `saleswilayah_ibfk_2` FOREIGN KEY (`idwilayah`) REFERENCES `wilayah` (`idwilayah`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `saleswilayah` */

insert  into `saleswilayah`(`idsaleswilayah`,`idsales`,`idwilayah`) values (30,'SLSJMQ0001','002'),(31,'SLSJMQ0001','003'),(21,'SLSKES0001','002'),(22,'SLSKES0001','003'),(29,'SLSSKN0001','001');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values ('5HkBoT4XqUaCCWEhU36Hles1swne3n0Nrhb8usks',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36','YTozNTp7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lL2xpaGF0Uml3YXlhdEFrdGlmaXRhcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NjoiX3Rva2VuIjtzOjQwOiJ1S3lvOWM4YWRpZVR3WXYxa1pZWGkwU2M0NGEyUWFDSlhQTGRXQmNOIjtzOjEwOiJpZHBlbmdndW5hIjtzOjEwOiI5OTk5OTk5OTk5IjtzOjEyOiJuYW1hcGVuZ2d1bmEiO3M6MTI6IlRaIERldmVsb3BlciI7czoxMToiaWRvdG9yaXNhc2kiO3M6NToiQUEwMDEiO3M6ODoidXNlcm5hbWUiO3M6MTE6InR6ZGV2ZWxvcGVyIjtzOjEyOiJmb3RvcGVuZ2d1bmEiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbWFnZXMvcHJvZmlsMS5wbmciO3M6MTg6ImFrdW5fYmFyYW5nX2RhZ2FuZyI7czo2OiIxLjEuMDIiO3M6MjM6ImFrdW5fYmViYW5fdHJhbnNwb3J0YXNpIjtzOjk6IjUuNC4wMS4wMSI7czo4OiJha3VuX2thcyI7czo2OiIxLjEuMDEiO3M6MTQ6ImFrdW5fa2FzX3R1bmFpIjtzOjk6IjEuMS4wMS4wMSI7czoxNDoiYWt1bl9wZW1iZWxpYW4iO3M6OToiNi4xLjAxLjAxIjtzOjI1OiJha3VuX3BlbmRhcGF0YW5fcGVuanVhbGFuIjtzOjk6IjQuMS4wMS4wMSI7czoyMToiYWt1bl9waXV0YW5nX2tvbnN1bWVuIjtzOjY6IjEuMS4wMyI7czoxODoiYWt1bl9waXV0YW5nX3VzYWhhIjtzOjk6IjEuMS4wMy4wMSI7czoyMDoiYWt1bl91dGFuZ19la3NwZWRpc2kiO3M6NjoiMi4xLjAxIjtzOjE0OiJha3VuX3V0YW5nX3BwbiI7czo5OiIyLjIuMDEuMDIiO3M6MTk6ImFrdW5fdXRhbmdfc3VwcGxpZXIiO3M6NjoiMi4yLjAxIjtzOjE2OiJha3VuX3V0YW5nX3VzYWhhIjtzOjk6IjIuMS4wMS4wMSI7czoyMzoiYm9udXNfcGVuYWdpaGFuX2RlZmF1bHQiO3M6NDoiMC4yNSI7czoyMzoiYm9udXNfcGVuanVhbGFuX2RlZmF1bHQiO3M6NDoiMC4yNSI7czoyNDoiZGVmYXVsdF9waXV0YW5nX2tvbnN1bWVuIjtzOjg6IjUwMDAwMDAwIjtzOjIwOiJkZWZhdWx0X3RhcmdldF9zYWxlcyI7czo5OiIxMDAwMDAwMDAiO3M6MjI6ImVrc3BlZGlzaV9wZXJzZW5fcHBoMjMiO3M6MToiMiI7czoyMDoiZWtzcGVkaXNpX3BlcnNlbl9wcG4iO3M6MzoiMS4xIjtzOjEzOiJwcG5fcGVtYmVsaWFuIjtzOjI6IjExIjtzOjEzOiJwcG5fcGVuanVhbGFuIjtzOjI6IjExIjtzOjMxOiJzdG9rX3Blbmp1YWxhbl9kYXJpX3N1cmF0X2phbGFuIjtzOjE6IjEiO3M6MTI6InVzYWhhX2FsYW1hdCI7czozODoiSmwuIFBlcmp1YW5nYW4gTm8uMjIyIA0KS290YSBQb250aWFuYWsiO3M6MTA6InVzYWhhX2xvZ28iO3M6ODoibG9nby5qcGciO3M6MTA6InVzYWhhX25hbWEiO3M6MjY6IlBULiBTVUtTRVMgVEFNQSBKQVlBIEFCQURJIjtzOjE4OiJ1c2FoYV9uYW1hX3NpbmdrYXQiO3M6MzoiU0pBIjtzOjEzOiJ1c2FoYV90ZWxlcG9uIjtzOjE1OiIoMDY4NSkgMjIzMzQ0NTUiO3M6MTA6InVzZXJfbWVudXMiO2E6ODp7aTowO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wMDIiO3M6NToibWVudXMiO3M6OToiUmVmZXJlbnNpIjtzOjY6InBhcmVudCI7TjtzOjg6InVybG1lbnVzIjtOO3M6OToiaWNvbm1lbnVzIjtzOjE1OiJmYXMgZmEtZGF0YWJhc2UiO3M6NDoidXJ1dCI7aToyMDtzOjY6ImxldmVscyI7aTowO3M6NzoiaGFrYWtzaSI7TjtzOjg6ImNoaWxkcmVuIjthOjY6e2k6MDthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDExIjtzOjU6Im1lbnVzIjtzOjg6IlBlbmdndW5hIjtzOjY6InBhcmVudCI7czo0OiJNMDAyIjtzOjg6InVybG1lbnVzIjtzOjg6InBlbmdndW5hIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjMwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtzOjI2OiJMaWhhdCwgVGFtYmFoLCBFZGl0LCBIYXB1cyI7czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MTthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDEyIjtzOjU6Im1lbnVzIjtzOjc6IldpbGF5YWgiO3M6NjoicGFyZW50IjtzOjQ6Ik0wMDIiO3M6ODoidXJsbWVudXMiO3M6Nzoid2lsYXlhaCI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTo0MDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjI7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAxMyI7czo1OiJtZW51cyI7czo4OiJLb25zdW1lbiI7czo2OiJwYXJlbnQiO3M6NDoiTTAwMiI7czo4OiJ1cmxtZW51cyI7czo4OiJrb25zdW1lbiI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTo1MDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjM7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAxNCI7czo1OiJtZW51cyI7czo4OiJTdXBwbGllciI7czo2OiJwYXJlbnQiO3M6NDoiTTAwMiI7czo4OiJ1cmxtZW51cyI7czo4OiJzdXBwbGllciI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTo2MDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjQ7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAxNSI7czo1OiJtZW51cyI7czo0OiJCYW5rIjtzOjY6InBhcmVudCI7czo0OiJNMDAyIjtzOjg6InVybG1lbnVzIjtzOjQ6ImJhbmsiO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6NzA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6MjY6IkxpaGF0LCBUYW1iYWgsIEVkaXQsIEhhcHVzIjtzOjg6ImNoaWxkcmVuIjthOjA6e319aTo1O2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wMTYiO3M6NToibWVudXMiO3M6NDoiQWt1biI7czo2OiJwYXJlbnQiO3M6NDoiTTAwMiI7czo4OiJ1cmxtZW51cyI7TjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFzIGZhLXN0cmVhbSI7czo0OiJ1cnV0IjtpOjgwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtOO3M6ODoiY2hpbGRyZW4iO2E6NDp7aTowO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wMTciO3M6NToibWVudXMiO3M6MTA6IkFrdW4gTHYuIDEiO3M6NjoicGFyZW50IjtzOjQ6Ik0wMTYiO3M6ODoidXJsbWVudXMiO3M6NToiYWt1bjEiO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6OTA7czo2OiJsZXZlbHMiO2k6MjtzOjc6Imhha2Frc2kiO3M6MjY6IkxpaGF0LCBUYW1iYWgsIEVkaXQsIEhhcHVzIjtzOjg6ImNoaWxkcmVuIjthOjA6e319aToxO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wMTgiO3M6NToibWVudXMiO3M6MTA6IkFrdW4gTHYuIDIiO3M6NjoicGFyZW50IjtzOjQ6Ik0wMTYiO3M6ODoidXJsbWVudXMiO3M6NToiYWt1bjIiO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6MTAwO3M6NjoibGV2ZWxzIjtpOjI7czo3OiJoYWtha3NpIjtzOjI2OiJMaWhhdCwgVGFtYmFoLCBFZGl0LCBIYXB1cyI7czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MjthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDE5IjtzOjU6Im1lbnVzIjtzOjEwOiJBa3VuIEx2LiAzIjtzOjY6InBhcmVudCI7czo0OiJNMDE2IjtzOjg6InVybG1lbnVzIjtzOjU6ImFrdW4zIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjExMDtzOjY6ImxldmVscyI7aToyO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjM7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAyMCI7czo1OiJtZW51cyI7czoxMDoiQWt1biBMdi4gNCI7czo2OiJwYXJlbnQiO3M6NDoiTTAxNiI7czo4OiJ1cmxtZW51cyI7czo1OiJha3VuNCI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aToxMjA7czo2OiJsZXZlbHMiO2k6MjtzOjc6Imhha2Frc2kiO3M6MjY6IkxpaGF0LCBUYW1iYWgsIEVkaXQsIEhhcHVzIjtzOjg6ImNoaWxkcmVuIjthOjA6e319fX19fWk6MTthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDAzIjtzOjU6Im1lbnVzIjtzOjY6IkJhcmFuZyI7czo2OiJwYXJlbnQiO047czo4OiJ1cmxtZW51cyI7TjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFzIGZhLXNoYXBlcyI7czo0OiJ1cnV0IjtpOjEzMDtzOjY6ImxldmVscyI7aTowO3M6NzoiaGFrYWtzaSI7TjtzOjg6ImNoaWxkcmVuIjthOjQ6e2k6MDthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDIxIjtzOjU6Im1lbnVzIjtzOjE1OiJLYXRlZ29yaSBCYXJhbmciO3M6NjoicGFyZW50IjtzOjQ6Ik0wMDMiO3M6ODoidXJsbWVudXMiO3M6MTQ6ImthdGVnb3JpYmFyYW5nIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjE0MDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjE7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAyMiI7czo1OiJtZW51cyI7czo2OiJCYXJhbmciO3M6NjoicGFyZW50IjtzOjQ6Ik0wMDMiO3M6ODoidXJsbWVudXMiO3M6NjoiYmFyYW5nIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjE1MDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjI7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAyMyI7czo1OiJtZW51cyI7czoxMjoiU3RvY2sgT3BuYW1lIjtzOjY6InBhcmVudCI7czo0OiJNMDAzIjtzOjg6InVybG1lbnVzIjtzOjExOiJzdG9ja29wbmFtZSI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aToxNjA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6MjY6IkxpaGF0LCBUYW1iYWgsIEVkaXQsIEhhcHVzIjtzOjg6ImNoaWxkcmVuIjthOjA6e319aTozO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wMjQiO3M6NToibWVudXMiO3M6MTg6IkxhcG9yYW4gUGVyc2VkaWFhbiI7czo2OiJwYXJlbnQiO3M6NDoiTTAwMyI7czo4OiJ1cmxtZW51cyI7czoxMzoibGFwcGVyc2VkaWFhbiI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aToxNzA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6NToiTGloYXQiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX19fWk6MjthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDA0IjtzOjU6Im1lbnVzIjtzOjU6IlNhbGVzIjtzOjY6InBhcmVudCI7TjtzOjg6InVybG1lbnVzIjtOO3M6OToiaWNvbm1lbnVzIjtzOjIzOiJmYXMgZmEtdW5pdmVyc2FsLWFjY2VzcyI7czo0OiJ1cnV0IjtpOjE4MDtzOjY6ImxldmVscyI7aTowO3M6NzoiaGFrYWtzaSI7TjtzOjg6ImNoaWxkcmVuIjthOjU6e2k6MDthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDI1IjtzOjU6Im1lbnVzIjtzOjEwOiJEYXRhIFNhbGVzIjtzOjY6InBhcmVudCI7czo0OiJNMDA0IjtzOjg6InVybG1lbnVzIjtzOjU6InNhbGVzIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjE5MDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjE7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAyNiI7czo1OiJtZW51cyI7czoxNzoiUGVuYWdpaGFuIFBpdXRhbmciO3M6NjoicGFyZW50IjtzOjQ6Ik0wMDQiO3M6ODoidXJsbWVudXMiO3M6OToicGVuYWdpaGFuIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjIwMDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjI7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAyNyI7czo1OiJtZW51cyI7czoxMToiQm9udXMgU2FsZXMiO3M6NjoicGFyZW50IjtzOjQ6Ik0wMDQiO3M6ODoidXJsbWVudXMiO3M6MTA6ImJvbnVzc2FsZXMiO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6MjEwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtzOjI2OiJMaWhhdCwgVGFtYmFoLCBFZGl0LCBIYXB1cyI7czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MzthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDI4IjtzOjU6Im1lbnVzIjtzOjE3OiJMYXBvcmFuIFBlbmFnaWhhbiI7czo2OiJwYXJlbnQiO3M6NDoiTTAwNCI7czo4OiJ1cmxtZW51cyI7czoxNzoibGFwcGVuYWdpaGFuc2FsZXMiO3M6OToiaWNvbm1lbnVzIjtzOjEyOiJmYXMgZmEtcHJpbnQiO3M6NDoidXJ1dCI7aToyMjA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6NToiTGloYXQiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjQ7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAyOSI7czo1OiJtZW51cyI7czoxOToiTGFwb3JhbiBCb251cyBTYWxlcyI7czo2OiJwYXJlbnQiO3M6NDoiTTAwNCI7czo4OiJ1cmxtZW51cyI7czoxMzoibGFwYm9udXNzYWxlcyI7czo5OiJpY29ubWVudXMiO3M6MTI6ImZhcyBmYS1wcmludCI7czo0OiJ1cnV0IjtpOjIzMDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czo1OiJMaWhhdCI7czo4OiJjaGlsZHJlbiI7YTowOnt9fX19aTozO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wMDUiO3M6NToibWVudXMiO3M6OToiRWtzcGVkaXNpIjtzOjY6InBhcmVudCI7TjtzOjg6InVybG1lbnVzIjtOO3M6OToiaWNvbm1lbnVzIjtzOjEyOiJmYXMgZmEtdHJ1Y2siO3M6NDoidXJ1dCI7aToyNDA7czo2OiJsZXZlbHMiO2k6MDtzOjc6Imhha2Frc2kiO047czo4OiJjaGlsZHJlbiI7YTo0OntpOjA7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAzMCI7czo1OiJtZW51cyI7czoxNDoiRGF0YSBFa3NwZWRpc2kiO3M6NjoicGFyZW50IjtzOjQ6Ik0wMDUiO3M6ODoidXJsbWVudXMiO3M6OToiZWtzcGVkaXNpIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjI1MDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjE7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAzMSI7czo1OiJtZW51cyI7czoxMToiU3VyYXQgSmFsYW4iO3M6NjoicGFyZW50IjtzOjQ6Ik0wMDUiO3M6ODoidXJsbWVudXMiO3M6MTA6InN1cmF0amFsYW4iO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6MjYwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtzOjI2OiJMaWhhdCwgVGFtYmFoLCBFZGl0LCBIYXB1cyI7czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MjthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDMyIjtzOjU6Im1lbnVzIjtzOjIwOiJCdWt1IFV0YW5nIEVrc3BlZGlzaSI7czo2OiJwYXJlbnQiO3M6NDoiTTAwNSI7czo4OiJ1cmxtZW51cyI7czoxNToiaHV0YW5nZWtzcGVkaXNpIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjI3MDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjM7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAzMyI7czo1OiJtZW51cyI7czoyMzoiTGFwb3JhbiBVdGFuZyBFa3NwZWRpc2kiO3M6NjoicGFyZW50IjtzOjQ6Ik0wMDUiO3M6ODoidXJsbWVudXMiO3M6MTc6ImxhcHV0YW5nZWtzcGVkaXNpIjtzOjk6Imljb25tZW51cyI7czoxMjoiZmFzIGZhLXByaW50IjtzOjQ6InVydXQiO2k6MjgwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtzOjU6IkxpaGF0IjtzOjg6ImNoaWxkcmVuIjthOjA6e319fX1pOjQ7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAwNiI7czo1OiJtZW51cyI7czo5OiJQZW1iZWxpYW4iO3M6NjoicGFyZW50IjtOO3M6ODoidXJsbWVudXMiO047czo5OiJpY29ubWVudXMiO3M6MTI6ImZhcyBmYS10YWJsZSI7czo0OiJ1cnV0IjtpOjI5MDtzOjY6ImxldmVscyI7aTowO3M6NzoiaGFrYWtzaSI7TjtzOjg6ImNoaWxkcmVuIjthOjU6e2k6MDthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDM0IjtzOjU6Im1lbnVzIjtzOjE5OiJQdXJjaGFzZSBPcmRlciAoUE8pIjtzOjY6InBhcmVudCI7czo0OiJNMDA2IjtzOjg6InVybG1lbnVzIjtzOjk6InBlbWJlbGlhbiI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTozMDA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6MjY6IkxpaGF0LCBUYW1iYWgsIEVkaXQsIEhhcHVzIjtzOjg6ImNoaWxkcmVuIjthOjA6e319aToxO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wMzUiO3M6NToibWVudXMiO3M6MTM6IlBlbmVyaW1hYW4gUE8iO3M6NjoicGFyZW50IjtzOjQ6Ik0wMDYiO3M6ODoidXJsbWVudXMiO3M6MTk6InBlbWJlbGlhbnBlbmVyaW1hYW4iO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6MzEwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtzOjI2OiJMaWhhdCwgVGFtYmFoLCBFZGl0LCBIYXB1cyI7czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MjthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDM2IjtzOjU6Im1lbnVzIjtzOjEwOiJCdWt1IFV0YW5nIjtzOjY6InBhcmVudCI7czo0OiJNMDA2IjtzOjg6InVybG1lbnVzIjtzOjY6Imh1dGFuZyI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTozMjA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6MjY6IkxpaGF0LCBUYW1iYWgsIEVkaXQsIEhhcHVzIjtzOjg6ImNoaWxkcmVuIjthOjA6e319aTozO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wMzciO3M6NToibWVudXMiO3M6MTU6IlJldHVyIFBlbWJlbGlhbiI7czo2OiJwYXJlbnQiO3M6NDoiTTAwNiI7czo4OiJ1cmxtZW51cyI7czoxNDoicmV0dXJwZW1iZWxpYW4iO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6MzMwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtzOjI2OiJMaWhhdCwgVGFtYmFoLCBFZGl0LCBIYXB1cyI7czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6NDthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDM4IjtzOjU6Im1lbnVzIjtzOjc6IkxhcG9yYW4iO3M6NjoicGFyZW50IjtzOjQ6Ik0wMDYiO3M6ODoidXJsbWVudXMiO047czo5OiJpY29ubWVudXMiO3M6MTI6ImZhcyBmYS1wcmludCI7czo0OiJ1cnV0IjtpOjM0MDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7TjtzOjg6ImNoaWxkcmVuIjthOjQ6e2k6MDthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDM5IjtzOjU6Im1lbnVzIjtzOjE0OiJMYXAuIFBlbWJlbGlhbiI7czo2OiJwYXJlbnQiO3M6NDoiTTAzOCI7czo4OiJ1cmxtZW51cyI7czoxMjoibGFwcGVtYmVsaWFuIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjM1MDtzOjY6ImxldmVscyI7aToyO3M6NzoiaGFrYWtzaSI7czo1OiJMaWhhdCI7czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MTthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDQwIjtzOjU6Im1lbnVzIjtzOjE4OiJMYXAuIFJpbmNpYW4gVXRhbmciO3M6NjoicGFyZW50IjtzOjQ6Ik0wMzgiO3M6ODoidXJsbWVudXMiO3M6MTM6ImxhcGJ1a3VodXRhbmciO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6MzYwO3M6NjoibGV2ZWxzIjtpOjI7czo3OiJoYWtha3NpIjtzOjU6IkxpaGF0IjtzOjg6ImNoaWxkcmVuIjthOjA6e319aToyO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wNDEiO3M6NToibWVudXMiO3M6MTY6IkxhcC4gUmVrYXAgVXRhbmciO3M6NjoicGFyZW50IjtzOjQ6Ik0wMzgiO3M6ODoidXJsbWVudXMiO3M6MTQ6ImxhcHJla2FwaHV0YW5nIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjM3MDtzOjY6ImxldmVscyI7aToyO3M6NzoiaGFrYWtzaSI7czo1OiJMaWhhdCI7czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MzthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDQyIjtzOjU6Im1lbnVzIjtzOjIwOiJMYXAuIFJldHVyIFBlbWJlbGlhbiI7czo2OiJwYXJlbnQiO3M6NDoiTTAzOCI7czo4OiJ1cmxtZW51cyI7czoxNzoibGFwcmV0dXJwZW1iZWxpYW4iO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6MzgwO3M6NjoibGV2ZWxzIjtpOjI7czo3OiJoYWtha3NpIjtzOjU6IkxpaGF0IjtzOjg6ImNoaWxkcmVuIjthOjA6e319fX19fWk6NTthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDA3IjtzOjU6Im1lbnVzIjtzOjk6IlBlbmp1YWxhbiI7czo2OiJwYXJlbnQiO047czo4OiJ1cmxtZW51cyI7TjtzOjk6Imljb25tZW51cyI7czoxMjoiZmFzIGZhLXN0YW1wIjtzOjQ6InVydXQiO2k6MzkwO3M6NjoibGV2ZWxzIjtpOjA7czo3OiJoYWtha3NpIjtOO3M6ODoiY2hpbGRyZW4iO2E6NDp7aTowO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wNDMiO3M6NToibWVudXMiO3M6OToiUGVuanVhbGFuIjtzOjY6InBhcmVudCI7czo0OiJNMDA3IjtzOjg6InVybG1lbnVzIjtzOjk6InBlbmp1YWxhbiI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTo0MDA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6MjY6IkxpaGF0LCBUYW1iYWgsIEVkaXQsIEhhcHVzIjtzOjg6ImNoaWxkcmVuIjthOjA6e319aToxO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wNDQiO3M6NToibWVudXMiO3M6MTI6IkJ1a3UgUGl1dGFuZyI7czo2OiJwYXJlbnQiO3M6NDoiTTAwNyI7czo4OiJ1cmxtZW51cyI7czo3OiJwaXV0YW5nIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjQxMDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjI7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTA0NSI7czo1OiJtZW51cyI7czoxNToiUmV0dXIgUGVuanVhbGFuIjtzOjY6InBhcmVudCI7czo0OiJNMDA3IjtzOjg6InVybG1lbnVzIjtzOjE0OiJyZXR1cnBlbmp1YWxhbiI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTo0MjA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6MjY6IkxpaGF0LCBUYW1iYWgsIEVkaXQsIEhhcHVzIjtzOjg6ImNoaWxkcmVuIjthOjA6e319aTozO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wNDYiO3M6NToibWVudXMiO3M6NzoiTGFwb3JhbiI7czo2OiJwYXJlbnQiO3M6NDoiTTAwNyI7czo4OiJ1cmxtZW51cyI7TjtzOjk6Imljb25tZW51cyI7czoxMjoiZmFzIGZhLXByaW50IjtzOjQ6InVydXQiO2k6NDMwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtOO3M6ODoiY2hpbGRyZW4iO2E6NDp7aTowO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wNDciO3M6NToibWVudXMiO3M6MTQ6IkxhcC4gUGVuanVhbGFuIjtzOjY6InBhcmVudCI7czo0OiJNMDQ2IjtzOjg6InVybG1lbnVzIjtzOjEyOiJsYXBwZW5qdWFsYW4iO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6NDQwO3M6NjoibGV2ZWxzIjtpOjI7czo3OiJoYWtha3NpIjtzOjU6IkxpaGF0IjtzOjg6ImNoaWxkcmVuIjthOjA6e319aToxO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wNDgiO3M6NToibWVudXMiO3M6MjA6IkxhcC4gUmluY2lhbiBQaXV0YW5nIjtzOjY6InBhcmVudCI7czo0OiJNMDQ2IjtzOjg6InVybG1lbnVzIjtzOjE0OiJsYXBidWt1cGl1dGFuZyI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTo0NTA7czo2OiJsZXZlbHMiO2k6MjtzOjc6Imhha2Frc2kiO3M6NToiTGloYXQiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjI7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTA0OSI7czo1OiJtZW51cyI7czoxODoiTGFwLiBSZWthcCBQaXV0YW5nIjtzOjY6InBhcmVudCI7czo0OiJNMDQ2IjtzOjg6InVybG1lbnVzIjtzOjE1OiJsYXByZWthcHBpdXRhbmciO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6NDYwO3M6NjoibGV2ZWxzIjtpOjI7czo3OiJoYWtha3NpIjtzOjU6IkxpaGF0IjtzOjg6ImNoaWxkcmVuIjthOjA6e319aTozO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wNTAiO3M6NToibWVudXMiO3M6MjA6IkxhcC4gUmV0dXIgUGVuanVhbGFuIjtzOjY6InBhcmVudCI7czo0OiJNMDQ2IjtzOjg6InVybG1lbnVzIjtzOjE3OiJsYXByZXR1cnBlbmp1YWxhbiI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTo0NzA7czo2OiJsZXZlbHMiO2k6MjtzOjc6Imhha2Frc2kiO3M6NToiTGloYXQiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX19fX19aTo2O2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wMDgiO3M6NToibWVudXMiO3M6MTQ6IlRyYW5zYWtzaSBVbXVtIjtzOjY6InBhcmVudCI7TjtzOjg6InVybG1lbnVzIjtOO3M6OToiaWNvbm1lbnVzIjtzOjk6ImZhcyBmYS10diI7czo0OiJ1cnV0IjtpOjQ4MDtzOjY6ImxldmVscyI7aTowO3M6NzoiaGFrYWtzaSI7TjtzOjg6ImNoaWxkcmVuIjthOjQ6e2k6MDthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDUxIjtzOjU6Im1lbnVzIjtzOjExOiJQZW5nZWx1YXJhbiI7czo2OiJwYXJlbnQiO3M6NDoiTTAwOCI7czo4OiJ1cmxtZW51cyI7czoxMToicGVuZ2VsdWFyYW4iO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6NDkwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtzOjI2OiJMaWhhdCwgVGFtYmFoLCBFZGl0LCBIYXB1cyI7czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MTthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDUyIjtzOjU6Im1lbnVzIjtzOjEwOiJQZW5lcmltYWFuIjtzOjY6InBhcmVudCI7czo0OiJNMDA4IjtzOjg6InVybG1lbnVzIjtzOjEwOiJwZW5lcmltYWFuIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjUwMDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czoyNjoiTGloYXQsIFRhbWJhaCwgRWRpdCwgSGFwdXMiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjI7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTA1MyI7czo1OiJtZW51cyI7czoxNjoiTGFwLiBQZW5nZWx1YXJhbiI7czo2OiJwYXJlbnQiO3M6NDoiTTAwOCI7czo4OiJ1cmxtZW51cyI7czoxNDoibGFwcGVuZ2VsdWFyYW4iO3M6OToiaWNvbm1lbnVzIjtzOjEyOiJmYXMgZmEtcHJpbnQiO3M6NDoidXJ1dCI7aTo1MTA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6NToiTGloYXQiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjM7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTA1NCI7czo1OiJtZW51cyI7czoxNToiTGFwLiBQZW5lcmltYWFuIjtzOjY6InBhcmVudCI7czo0OiJNMDA4IjtzOjg6InVybG1lbnVzIjtzOjEzOiJsYXBwZW5lcmltYWFuIjtzOjk6Imljb25tZW51cyI7czoxMjoiZmFzIGZhLXByaW50IjtzOjQ6InVydXQiO2k6NTIwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtzOjU6IkxpaGF0IjtzOjg6ImNoaWxkcmVuIjthOjA6e319fX1pOjc7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTAwOSI7czo1OiJtZW51cyI7czo5OiJBa3VudGFuc2kiO3M6NjoicGFyZW50IjtOO3M6ODoidXJsbWVudXMiO047czo5OiJpY29ubWVudXMiO3M6MTY6ImZhcyBmYS1uZXdzcGFwZXIiO3M6NDoidXJ1dCI7aTo1MzA7czo2OiJsZXZlbHMiO2k6MDtzOjc6Imhha2Frc2kiO047czo4OiJjaGlsZHJlbiI7YTo3OntpOjA7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTA1NSI7czo1OiJtZW51cyI7czoxNToiU2FsZG8gQXdhbCBBa3VuIjtzOjY6InBhcmVudCI7czo0OiJNMDA5IjtzOjg6InVybG1lbnVzIjtzOjk6InNhbGRvYXdhbCI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTo1NDA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6MjY6IkxpaGF0LCBUYW1iYWgsIEVkaXQsIEhhcHVzIjtzOjg6ImNoaWxkcmVuIjthOjA6e319aToxO2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wNTYiO3M6NToibWVudXMiO3M6MTg6Ikp1cm5hbCBQZW55ZXN1YWlhbiI7czo2OiJwYXJlbnQiO3M6NDoiTTAwOSI7czo4OiJ1cmxtZW51cyI7czo2OiJqdXJuYWwiO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6NTUwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtzOjI2OiJMaWhhdCwgVGFtYmFoLCBFZGl0LCBIYXB1cyI7czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6MjthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDU3IjtzOjU6Im1lbnVzIjtzOjE0OiJQb3N0aW5nIEp1cm5hbCI7czo2OiJwYXJlbnQiO3M6NDoiTTAwOSI7czo4OiJ1cmxtZW51cyI7czoxMzoicG9zdGluZ2p1cm5hbCI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTo1NjA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6NToiTGloYXQiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjM7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTA1OCI7czo1OiJtZW51cyI7czoxMDoiQnVrdSBCZXNhciI7czo2OiJwYXJlbnQiO3M6NDoiTTAwOSI7czo4OiJ1cmxtZW51cyI7czoxMjoibGFwYnVrdWJlc2FyIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjU3MDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czo1OiJMaWhhdCI7czo4OiJjaGlsZHJlbiI7YTowOnt9fWk6NDthOjk6e3M6NzoiaWRtZW51cyI7czo0OiJNMDU5IjtzOjU6Im1lbnVzIjtzOjE0OiJMYXBvcmFuIEp1cm5hbCI7czo2OiJwYXJlbnQiO3M6NDoiTTAwOSI7czo4OiJ1cmxtZW51cyI7czo5OiJsYXBqdXJuYWwiO3M6OToiaWNvbm1lbnVzIjtzOjEzOiJmYXIgZmEtY2lyY2xlIjtzOjQ6InVydXQiO2k6NTgwO3M6NjoibGV2ZWxzIjtpOjE7czo3OiJoYWtha3NpIjtzOjU6IkxpaGF0IjtzOjg6ImNoaWxkcmVuIjthOjA6e319aTo1O2E6OTp7czo3OiJpZG1lbnVzIjtzOjQ6Ik0wNjAiO3M6NToibWVudXMiO3M6MjA6IkxhcG9yYW4gTmVyYWNhIFNhbGRvIjtzOjY6InBhcmVudCI7czo0OiJNMDA5IjtzOjg6InVybG1lbnVzIjtzOjE0OiJsYXBuZXJhY2FzYWxkbyI7czo5OiJpY29ubWVudXMiO3M6MTM6ImZhciBmYS1jaXJjbGUiO3M6NDoidXJ1dCI7aTo1OTA7czo2OiJsZXZlbHMiO2k6MTtzOjc6Imhha2Frc2kiO3M6NToiTGloYXQiO3M6ODoiY2hpbGRyZW4iO2E6MDp7fX1pOjY7YTo5OntzOjc6ImlkbWVudXMiO3M6NDoiTTA2MSI7czo1OiJtZW51cyI7czoxNzoiTGFwb3JhbiBMYWJhIFJ1Z2kiO3M6NjoicGFyZW50IjtzOjQ6Ik0wMDkiO3M6ODoidXJsbWVudXMiO3M6MTE6ImxhcGxhYmFydWdpIjtzOjk6Imljb25tZW51cyI7czoxMzoiZmFyIGZhLWNpcmNsZSI7czo0OiJ1cnV0IjtpOjYwMDtzOjY6ImxldmVscyI7aToxO3M6NzoiaGFrYWtzaSI7czo1OiJMaWhhdCI7czo4OiJjaGlsZHJlbiI7YTowOnt9fX19fX0=',1769049288);

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `prefix` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `values` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `issystem` int DEFAULT '1',
  PRIMARY KEY (`prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `settings` */

insert  into `settings`(`prefix`,`values`,`deskripsi`,`inserted_date`,`updated_date`,`issystem`) values ('akun_barang_dagang','1.1.02','Akun persediaan barang dagang','2025-02-20 01:51:20','2025-02-20 01:53:16',1),('akun_beban_transportasi','5.4.01.01','Akun beban operasional transportasi','2025-04-25 06:52:28','2025-04-25 06:52:28',1),('akun_kas','1.1.01','Rekening akun kas','2025-02-28 07:35:52','2025-02-28 07:35:52',1),('akun_kas_tunai','1.1.01.01','Akun Rekening Kas Tunai','2025-03-16 17:31:05','2025-03-16 17:31:05',1),('akun_pembelian','6.1.01.01','Akun Pembelian','2025-04-25 07:36:18','2025-04-25 07:36:18',1),('akun_pendapatan_penjualan','4.1.01.01','Akun pedapatan penjualan','2025-04-25 06:24:36','2025-04-25 06:24:36',1),('akun_piutang_konsumen','1.1.03','Akun header piutang konsumen untuk filter di select 2','2025-05-20 13:45:19','2025-05-20 13:45:19',1),('akun_piutang_usaha','1.1.03.01','Rekening akun piutang usaha','2025-03-16 18:14:22','2025-03-16 18:14:22',1),('akun_utang_ekspedisi','2.1.01','Kode header akun utang ekspedisi','2025-05-20 15:00:09','2025-05-20 15:00:09',1),('akun_utang_ppn','2.2.01.02','Akun untuk pengeluaran ppn','2025-04-25 06:35:13','2025-04-25 06:35:13',1),('akun_utang_supplier','2.2.01','Kode parent akun utang supplier','2025-05-20 14:32:56','2025-05-20 14:32:56',1),('akun_utang_usaha','2.1.01.01','Rekening akun utang usaha','2025-03-17 05:18:15','2025-03-17 05:18:15',1),('bonus_penagihan_default','0.25','Bonus penagihan default di master barang dalam persen. 2 digit decimal','2025-06-06 03:44:54','2025-07-10 17:28:38',1),('bonus_penjualan_default','0.25','default bonus penjualan di master barang dalam persen. 2 digit decimal','2025-06-06 03:40:07','2025-07-10 17:28:54',1),('default_piutang_konsumen','50000000','Jumlah default piutang konsumen','2025-05-20 02:06:07','2025-05-20 02:06:07',1),('default_target_sales','100000000','Default target penjualan sales','2025-05-20 14:16:41','2025-05-20 14:16:41',1),('ekspedisi_persen_pph23','2','Jumlah persen pph23 hutang ekspedisi','2025-07-10 18:17:53','2025-07-10 18:17:53',1),('ekspedisi_persen_ppn','1.1','Jumlah persen ppn hutang ekspedisi','2025-07-10 18:17:15','2025-07-10 18:17:15',1),('ppn_pembelian','11','PPN Pembelian dalam persen','2025-04-22 03:38:36','2025-04-22 03:38:36',1),('ppn_penjualan','11','PPN penjulaan dalam pesertase','2025-03-13 17:52:00','2025-03-13 17:52:11',1),('stok_penjualan_dari_surat_jalan','1','Stok barang akan berkurang ketika ada surat jalan (1= Ya, 0=Tidak)','2025-05-22 04:22:56','2025-05-22 04:22:56',1),('usaha_alamat','Jl. Perjuangan No.222 \r\nKota Pontianak','Alamat Usaha','2025-03-06 06:07:36','2025-03-06 06:07:36',1),('usaha_logo','logo.jpg','Logo usaha','2025-02-27 01:56:05','2025-03-14 16:13:48',1),('usaha_nama','PT. SUKSES TAMA JAYA ABADI',NULL,'2025-02-27 01:54:47','2025-07-11 18:12:52',1),('usaha_nama_singkat','SJA','Singkatan Nama Usaha','2025-02-27 01:55:30','2025-07-11 18:13:12',1),('usaha_telepon','(0685) 22334455','Nomor telepon usaha','2025-03-06 06:11:06','2025-03-06 06:11:06',1);

/*Table structure for table `stockopname` */

DROP TABLE IF EXISTS `stockopname`;

CREATE TABLE `stockopname` (
  `idstockopname` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglstockopname` datetime DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idstockopname`),
  KEY `tglstockopname` (`tglstockopname`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `stockopname_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `stockopname` */

insert  into `stockopname`(`idstockopname`,`tglstockopname`,`keterangan`,`inserted_date`,`updated_date`,`idpengguna`) values ('250311SO0000001','2025-03-11 07:28:10','test','2025-03-11 07:28:10','2025-03-11 07:28:10','USRBID0001'),('250317SO0000001','2025-03-17 07:23:45','Stok Opname Maret','2025-03-17 07:23:45','2025-03-17 07:23:45','USRBID0001');

/*Table structure for table `stockopnamedetail` */

DROP TABLE IF EXISTS `stockopnamedetail`;

CREATE TABLE `stockopnamedetail` (
  `idstockopnamedetail` int NOT NULL AUTO_INCREMENT,
  `idstockopname` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbarang` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stocksystem` int DEFAULT NULL,
  `stockopname` int DEFAULT NULL,
  `keterangandetail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idstockopnamedetail`),
  KEY `idstockopname` (`idstockopname`),
  KEY `idbarang` (`idbarang`),
  CONSTRAINT `stockopnamedetail_ibfk_1` FOREIGN KEY (`idstockopname`) REFERENCES `stockopname` (`idstockopname`),
  CONSTRAINT `stockopnamedetail_ibfk_2` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `stockopnamedetail` */

insert  into `stockopnamedetail`(`idstockopnamedetail`,`idstockopname`,`idbarang`,`stocksystem`,`stockopname`,`keterangandetail`) values (3,'250311SO0000001','K001000002',2,10,NULL),(4,'250311SO0000001','K001000001',1,20,NULL),(5,'250317SO0000001','K001000002',0,1500,NULL),(6,'250317SO0000001','K001000001',-90,2200,NULL);

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `idsupplier` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namasupplier` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamatsupplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kontakperson` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelp` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `saldo` decimal(18,0) DEFAULT '0',
  `saldopajak` decimal(18,0) DEFAULT '0',
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `npwp` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakunutang` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idsupplier`),
  KEY `kdakunutang` (`kdakunutang`),
  CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`kdakunutang`) REFERENCES `akun` (`kdakun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `supplier` */

insert  into `supplier`(`idsupplier`,`namasupplier`,`alamatsupplier`,`kontakperson`,`notelp`,`email`,`saldo`,`saldopajak`,`inserted_date`,`updated_date`,`statusaktif`,`npwp`,`kdakunutang`) values ('SUPHPI0001','PT. Husada Prima','Jl. Pahlawan 2','Jojon','081200000000',NULL,0,0,'2025-05-20 14:46:40','2025-05-20 14:47:05','Aktif','189812918291219','2.2.01.01'),('SUPIMN0001','PT. Intra Makmur','Jl. Pemuda','Bambang','081300000','bambang@gmail.com',0,0,'2025-03-01 10:03:55','2025-05-20 14:47:30','Aktif','545215789625452','2.2.01.01'),('SUPMBD0001','CV. MAJU BERSAMA','Jl. Kebangkitan','Rudi','081200000000000','rudi@gmail.com',0,0,'2025-02-25 03:24:19','2025-05-20 14:47:21','Aktif','154865223157545','2.2.01.01'),('SUPMUF0001','PT. MILPO','Jakarta','Bpk. Tomi','081200000000','tomi@gmail.com',0,0,'2025-05-10 04:05:01','2025-05-20 14:47:53','Aktif','829292888999988','2.2.01.01');

/*Table structure for table `suratjalan` */

DROP TABLE IF EXISTS `suratjalan`;

CREATE TABLE `suratjalan` (
  `idsuratjalan` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglsuratjalan` date DEFAULT NULL,
  `idkonsumen` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglcetak` datetime DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaltagihan` decimal(10,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idekspedisi` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idjenisekspedisi` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `identitasekspedisi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `biayapengiriman` decimal(18,0) DEFAULT NULL,
  `rincianinputmanual` tinyint DEFAULT '1',
  PRIMARY KEY (`idsuratjalan`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idekspedisi` (`idekspedisi`),
  KEY `idjenisekspedisi` (`idjenisekspedisi`),
  KEY `idkonsumen` (`idkonsumen`),
  CONSTRAINT `suratjalan_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `suratjalan_ibfk_3` FOREIGN KEY (`idekspedisi`) REFERENCES `ekspedisi` (`idekspedisi`),
  CONSTRAINT `suratjalan_ibfk_4` FOREIGN KEY (`idjenisekspedisi`) REFERENCES `jenisekspedisi` (`idjenisekspedisi`),
  CONSTRAINT `suratjalan_ibfk_5` FOREIGN KEY (`idkonsumen`) REFERENCES `konsumen` (`idkonsumen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `suratjalan` */

insert  into `suratjalan`(`idsuratjalan`,`tglsuratjalan`,`idkonsumen`,`tglcetak`,`keterangan`,`totaltagihan`,`inserted_date`,`updated_date`,`idpengguna`,`idekspedisi`,`idjenisekspedisi`,`identitasekspedisi`,`biayapengiriman`,`rincianinputmanual`) values ('250527SJ01','2025-05-27','IPJ001',NULL,NULL,150000,'2025-05-27 13:37:53','2025-05-27 13:37:53','USRBID0001','EKSOHRR001','001','Nomor Plat: KB2244GG',100000,1),('250527SJ02','2025-05-27','KUE001',NULL,NULL,11500000,'2025-05-27 16:43:12','2025-05-27 16:43:12','USRBID0001','EKSPWRU001','001','Nomor Plat. KB3434FF',35000,1),('250813SJ01','2025-08-13','KUE001',NULL,NULL,1545000,'2025-08-13 15:36:55','2025-08-13 15:36:55','USRBID0001','EKSOHRR001','001','Test',120000,0),('250813SJ02','2025-08-13','SKE001',NULL,NULL,738000,'2025-08-13 15:44:15','2025-08-19 07:04:19','9999999999','EKSKFSD001','002','Test2',20000,1);

/*Table structure for table `suratjalandetail` */

DROP TABLE IF EXISTS `suratjalandetail`;

CREATE TABLE `suratjalandetail` (
  `iddetailsuratjalan` int NOT NULL AUTO_INCREMENT,
  `idsuratjalan` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`iddetailsuratjalan`),
  KEY `idsuratjalan` (`idsuratjalan`),
  KEY `idpenjualan` (`idpenjualan`),
  CONSTRAINT `suratjalandetail_ibfk_1` FOREIGN KEY (`idsuratjalan`) REFERENCES `suratjalan` (`idsuratjalan`),
  CONSTRAINT `suratjalandetail_ibfk_2` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `suratjalandetail` */

insert  into `suratjalandetail`(`iddetailsuratjalan`,`idsuratjalan`,`idpenjualan`) values (45,'250527SJ01','250527JL0000001'),(46,'250527SJ02','250522JL0000001'),(47,'250813SJ01','250813JL0000001'),(51,'250813SJ02','250813JL0000002');

/*Table structure for table `suratjalanrincian` */

DROP TABLE IF EXISTS `suratjalanrincian`;

CREATE TABLE `suratjalanrincian` (
  `idsuratjalanrincian` int NOT NULL AUTO_INCREMENT,
  `idsuratjalan` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `satuan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`idsuratjalanrincian`),
  KEY `idsuratjalan` (`idsuratjalan`),
  CONSTRAINT `suratjalanrincian_ibfk_1` FOREIGN KEY (`idsuratjalan`) REFERENCES `suratjalan` (`idsuratjalan`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `suratjalanrincian` */

insert  into `suratjalanrincian`(`idsuratjalanrincian`,`idsuratjalan`,`qty`,`satuan`,`keterangan`) values (21,'250527SJ01',1,'Paket','Kayu'),(22,'250527SJ02',1,'Paket','Kayu aja'),(26,'250813SJ02',1,'Dus','Paku Paku an');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*Table structure for table `wilayah` */

DROP TABLE IF EXISTS `wilayah`;

CREATE TABLE `wilayah` (
  `idwilayah` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namawilayah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idwilayah`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `wilayah` */

insert  into `wilayah`(`idwilayah`,`namawilayah`,`inserted_date`,`updated_date`,`statusaktif`) values ('001','Pontianak','2025-02-21 09:10:23','2025-08-20 02:28:14','Aktif'),('002','Singkawang','2025-02-21 03:12:27','2025-02-21 03:15:31','Aktif'),('003','Sanggau','2025-05-10 03:49:25','2025-05-10 03:49:25','Aktif');

/* Function  structure for function  `create_idbank` */

/*!50003 DROP FUNCTION IF EXISTS `create_idbank` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idbank`(`varnamabank` VARCHAR(50)) RETURNS char(5) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	DECLARE cNosekarang CHAR(3);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(3);
	DECLARE jumlah_digit INT DEFAULT 3;
	DECLARE cunix CHAR(2);
	
	SET cunix = create_unix_name(varnamabank, 2);
	
	SELECT MAX(RIGHT(RTRIM(idbank),jumlah_digit)) FROM `bank` WHERE LEFT(idbank,2) = cunix INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CAST(cNosekarang AS UNSIGNED)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cunix, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `create_idbarang` */

/*!50003 DROP FUNCTION IF EXISTS `create_idbarang` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idbarang`(`idkategori` char(4)) RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	DECLARE cNosekarang CHAR(6);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(6);
	DECLARE jumlah_digit INT DEFAULT 6;
	
	SELECT MAX(RIGHT(RTRIM(idbarang),jumlah_digit)) FROM `barang` WHERE LEFT(idbarang,4) = idkategori INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CAST(cNosekarang AS UNSIGNED)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(idkategori, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `create_idbonus` */

/*!50003 DROP FUNCTION IF EXISTS `create_idbonus` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idbonus`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(6);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(6);
    DECLARE jumlah_digit INT DEFAULT 6;
    DECLARE cUnix CHAR(9);
    
    SET cUnix = CONCAT( DATE_FORMAT(NOW(), '%y%m%d'), 'BNS' );
    
    SELECT MAX(RIGHT(RTRIM(idbonus), jumlah_digit)) 
    FROM `bonus` 
    WHERE LEFT(idbonus, 9) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idekspedisi` */

/*!50003 DROP FUNCTION IF EXISTS `create_idekspedisi` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idekspedisi`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	DECLARE cNosekarang CHAR(3);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(3);
	DECLARE jumlah_digit INT DEFAULT 3;
	DECLARE cunix CHAR(7);
	
	SET cunix = concat('EKS', create_unix_name('', 4));
	
	SELECT MAX(RIGHT(RTRIM(idekspedisi),jumlah_digit)) FROM `ekspedisi` WHERE LEFT(idekspedisi,7) = cunix INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CAST(cNosekarang AS UNSIGNED)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cunix, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `create_idhutang` */

/*!50003 DROP FUNCTION IF EXISTS `create_idhutang` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idhutang`() RETURNS char(12) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(4);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(4);
    DECLARE jumlah_digit INT DEFAULT 4;
    DECLARE cUnix CHAR(8);
    
    SET cUnix = CONCAT( DATE_FORMAT(NOW(), '%y%m%d'), 'HU' );
    
    SELECT MAX(RIGHT(RTRIM(idhutang), jumlah_digit)) 
    FROM `hutang` 
    WHERE LEFT(idhutang, 8) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idhutangdetail` */

/*!50003 DROP FUNCTION IF EXISTS `create_idhutangdetail` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idhutangdetail`(var_idhutang char(12)) RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(3);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(3);
    DECLARE jumlah_digit INT DEFAULT 3;
    DECLARE cUnix CHAR(12);
    
    SET cUnix = var_idhutang;
    
    SELECT MAX(RIGHT(RTRIM(idhutangdetail), jumlah_digit)) 
    FROM `hutangdetail` 
    WHERE LEFT(idhutangdetail, 12) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idhutangekspedisi` */

/*!50003 DROP FUNCTION IF EXISTS `create_idhutangekspedisi` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idhutangekspedisi`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(6);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(6);
    DECLARE jumlah_digit INT DEFAULT 6;
    DECLARE cUnix CHAR(9);
    
    SET cUnix = CONCAT( DATE_FORMAT(NOW(), '%y%m%d'), 'HEX' );
    
    SELECT MAX(RIGHT(RTRIM(idhutangekspedisi), jumlah_digit)) 
    FROM `hutangekspedisi` 
    WHERE LEFT(idhutangekspedisi, 9) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idjurnalpenyesuaian` */

/*!50003 DROP FUNCTION IF EXISTS `create_idjurnalpenyesuaian` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idjurnalpenyesuaian`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(7);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(7);
    DECLARE jumlah_digit INT DEFAULT 7;
    DECLARE cUnix CHAR(8);
    
    SET cUnix = concat( DATE_FORMAT(NOW(), '%y%m%d'), 'JP' );
    
    SELECT MAX(RIGHT(RTRIM(idjurnal), jumlah_digit)) 
    FROM `jurnal` 
    WHERE LEFT(idjurnal, 8) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idkategori` */

/*!50003 DROP FUNCTION IF EXISTS `create_idkategori` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idkategori`(`varnamakategori` VARCHAR(50)) RETURNS char(5) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	DECLARE cNosekarang CHAR(3);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(3);
	DECLARE jumlah_digit INT DEFAULT 3;
	DECLARE cunix CHAR(1);
	
	SET cunix = create_unix_name(varnamakategori, 1);
	
	SELECT MAX(RIGHT(RTRIM(idkategori),jumlah_digit)) FROM `kategoribarang` WHERE LEFT(idkategori,1) = cunix INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CAST(cNosekarang AS UNSIGNED)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cunix, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `create_idkonsumen` */

/*!50003 DROP FUNCTION IF EXISTS `create_idkonsumen` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idkonsumen`(`varnamakonsumen` VARCHAR(50)) RETURNS char(6) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	DECLARE cNosekarang CHAR(3);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(3);
	DECLARE jumlah_digit INT DEFAULT 3;
	DECLARE cunix CHAR(3);
	
	SET cunix = create_unix_name(varnamakonsumen, 3);
	
	SELECT MAX(RIGHT(RTRIM(idkonsumen),jumlah_digit)) FROM `konsumen` WHERE LEFT(idkonsumen,3) = cunix INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CAST(cNosekarang AS UNSIGNED)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cunix, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `create_idpembelian` */

/*!50003 DROP FUNCTION IF EXISTS `create_idpembelian` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idpembelian`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(7);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(7);
    DECLARE jumlah_digit INT DEFAULT 7;
    DECLARE cUnix CHAR(8);
    
    SET cUnix = concat( DATE_FORMAT(NOW(), '%y%m%d'), 'BL' );
    
    SELECT MAX(RIGHT(RTRIM(idpembelian), jumlah_digit)) 
    FROM `pembelian` 
    WHERE LEFT(idpembelian, 8) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idpenagihan` */

/*!50003 DROP FUNCTION IF EXISTS `create_idpenagihan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idpenagihan`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(6);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(6);
    DECLARE jumlah_digit INT DEFAULT 6;
    DECLARE cUnix CHAR(9);
    
    SET cUnix = concat( DATE_FORMAT(NOW(), '%y%m%d'), 'TAG' );
    
    SELECT MAX(RIGHT(RTRIM(idpenagihan), jumlah_digit)) 
    FROM `penagihan` 
    WHERE LEFT(idpenagihan, 9) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idpenerimaan` */

/*!50003 DROP FUNCTION IF EXISTS `create_idpenerimaan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idpenerimaan`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(7);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(7);
    DECLARE jumlah_digit INT DEFAULT 7;
    DECLARE cUnix CHAR(8);
    
    SET cUnix = concat( DATE_FORMAT(NOW(), '%y%m%d'), 'PN' );
    
    SELECT MAX(RIGHT(RTRIM(idpenerimaan), jumlah_digit)) 
    FROM `penerimaan` 
    WHERE LEFT(idpenerimaan, 8) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idpengeluaran` */

/*!50003 DROP FUNCTION IF EXISTS `create_idpengeluaran` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idpengeluaran`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(7);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(7);
    DECLARE jumlah_digit INT DEFAULT 7;
    DECLARE cUnix CHAR(8);
    
    SET cUnix = concat( DATE_FORMAT(NOW(), '%y%m%d'), 'PL' );
    
    SELECT MAX(RIGHT(RTRIM(idpengeluaran), jumlah_digit)) 
    FROM `pengeluaran` 
    WHERE LEFT(idpengeluaran, 8) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idpengguna` */

/*!50003 DROP FUNCTION IF EXISTS `create_idpengguna` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idpengguna`(`varnamapengguna` VARCHAR(50)) RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT DEFAULT 4;
	DECLARE cunix CHAR(6);
	
	SET cunix = CONCAT('USR', create_unix_name(varnamapengguna, 3));
	
	SELECT MAX(RIGHT(RTRIM(idpengguna),jumlah_digit)) FROM `pengguna` WHERE LEFT(idpengguna,6) = cunix INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CAST(cNosekarang AS UNSIGNED)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cunix, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `create_idpenjualan` */

/*!50003 DROP FUNCTION IF EXISTS `create_idpenjualan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idpenjualan`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(7);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(7);
    DECLARE jumlah_digit INT DEFAULT 7;
    DECLARE cUnix CHAR(8);
    
    SET cUnix = CONCAT( DATE_FORMAT(NOW(), '%y%m%d'), 'JL' );
    
    SELECT MAX(RIGHT(RTRIM(idpenjualan), jumlah_digit)) 
    FROM `penjualan` 
    WHERE LEFT(idpenjualan, 8) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idpiutang` */

/*!50003 DROP FUNCTION IF EXISTS `create_idpiutang` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idpiutang`() RETURNS char(12) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(4);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(4);
    DECLARE jumlah_digit INT DEFAULT 4;
    DECLARE cUnix CHAR(8);
    
    SET cUnix = CONCAT( DATE_FORMAT(NOW(), '%y%m%d'), 'PI' );
    
    SELECT MAX(RIGHT(RTRIM(idpiutang), jumlah_digit)) 
    FROM `piutang` 
    WHERE LEFT(idpiutang, 8) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idpiutangdetail` */

/*!50003 DROP FUNCTION IF EXISTS `create_idpiutangdetail` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idpiutangdetail`(var_idpiutang char(12)) RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(3);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(3);
    DECLARE jumlah_digit INT DEFAULT 3;
    DECLARE cUnix CHAR(12);
    
    SET cUnix = var_idpiutang;
    
    SELECT MAX(RIGHT(RTRIM(idpiutangdetail), jumlah_digit)) 
    FROM `piutangdetail` 
    WHERE LEFT(idpiutangdetail, 12) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idreturpembelian` */

/*!50003 DROP FUNCTION IF EXISTS `create_idreturpembelian` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idreturpembelian`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(7);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(7);
    DECLARE jumlah_digit INT DEFAULT 7;
    DECLARE cUnix CHAR(8);
    
    SET cUnix = concat( DATE_FORMAT(NOW(), '%y%m%d'), 'RB' );
    
    SELECT MAX(RIGHT(RTRIM(idreturpembelian), jumlah_digit)) 
    FROM `returpembelian` 
    WHERE LEFT(idreturpembelian, 8) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idreturpenjualan` */

/*!50003 DROP FUNCTION IF EXISTS `create_idreturpenjualan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idreturpenjualan`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(7);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(7);
    DECLARE jumlah_digit INT DEFAULT 7;
    DECLARE cUnix CHAR(8);
    
    SET cUnix = concat( DATE_FORMAT(NOW(), '%y%m%d'), 'RJ' );
    
    SELECT MAX(RIGHT(RTRIM(idreturpenjualan), jumlah_digit)) 
    FROM `returpenjualan` 
    WHERE LEFT(idreturpenjualan, 8) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idsales` */

/*!50003 DROP FUNCTION IF EXISTS `create_idsales` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idsales`(`varnamasales` VARCHAR(50)) RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT DEFAULT 4;
	DECLARE cunix CHAR(6);
	
	SET cunix = concat('SLS', create_unix_name(varnamasales, 3));
	
	SELECT MAX(RIGHT(RTRIM(idsales),jumlah_digit)) FROM `sales` WHERE LEFT(idsales,6) = cunix INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CAST(cNosekarang AS UNSIGNED)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cunix, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `create_idstockadjustment` */

/*!50003 DROP FUNCTION IF EXISTS `create_idstockadjustment` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idstockadjustment`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(4);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(4);
    DECLARE jumlah_digit INT DEFAULT 4;
    DECLARE cUnix CHAR(6);
    
    SET cUnix = DATE_FORMAT(NOW(), '%y%m%d');
    
    SELECT MAX(RIGHT(RTRIM(idstockadjustment), jumlah_digit)) 
    FROM `stockadjustment` 
    WHERE LEFT(idstockadjustment, 6) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idstockopname` */

/*!50003 DROP FUNCTION IF EXISTS `create_idstockopname` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idstockopname`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(7);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(7);
    DECLARE jumlah_digit INT DEFAULT 7;
    DECLARE cUnix CHAR(8);
    
    SET cUnix = CONCAT( DATE_FORMAT(NOW(), '%y%m%d'), 'SO' );
    
    SELECT MAX(RIGHT(RTRIM(idstockopname), jumlah_digit)) 
    FROM `stockopname` 
    WHERE LEFT(idstockopname, 8) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idsupplier` */

/*!50003 DROP FUNCTION IF EXISTS `create_idsupplier` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idsupplier`(`varnamasupplier` VARCHAR(50)) RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	DECLARE cNosekarang CHAR(4);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(4);
	DECLARE jumlah_digit INT DEFAULT 4;
	DECLARE cunix CHAR(6);
	
	SET cunix = CONCAT('SUP', create_unix_name(varnamasupplier, 3));
	
	SELECT MAX(RIGHT(RTRIM(idsupplier),jumlah_digit)) FROM `supplier` WHERE LEFT(idsupplier,6) = cunix INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CAST(cNosekarang AS UNSIGNED)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cunix, cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `create_idsuratjalan` */

/*!50003 DROP FUNCTION IF EXISTS `create_idsuratjalan` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idsuratjalan`() RETURNS char(10) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(2);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(2);
    DECLARE jumlah_digit INT DEFAULT 2;
    DECLARE cUnix CHAR(8);
    
    SET cUnix = CONCAT( DATE_FORMAT(NOW(), '%y%m%d'), 'SJ' );
    
    SELECT MAX(RIGHT(RTRIM(idsuratjalan), jumlah_digit)) 
    FROM `suratjalan` 
    WHERE LEFT(idsuratjalan, 8) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_idwilayah` */

/*!50003 DROP FUNCTION IF EXISTS `create_idwilayah` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_idwilayah`() RETURNS char(3) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
BEGIN
	DECLARE cNosekarang CHAR(3);
	DECLARE nlen INT;
	DECLARE nNoselanjutnya INT;
	DECLARE cNoselanjutnya CHAR(3);
	DECLARE jumlah_digit INT DEFAULT 3;
	
	SELECT MAX(RIGHT(RTRIM(idwilayah),jumlah_digit)) FROM `wilayah` INTO cNosekarang;	
	SET cNosekarang = IF(ISNULL(cNosekarang),0,cNosekarang);
	
	SET nNoselanjutnya = CAST(cNosekarang AS UNSIGNED)+1;
	SET cNoselanjutnya = RTRIM(CONVERT(nNoselanjutnya,CHAR));
	SET nlen = LENGTH(cNoselanjutnya);
	
	WHILE nlen+1 <= jumlah_digit DO		
		SET cNoselanjutnya= CONCAT('0',cNoselanjutnya);
		SET nlen=nlen+1;
	END WHILE;	
	
	RETURN CONCAT(cNoselanjutnya);
    END */$$
DELIMITER ;

/* Function  structure for function  `create_noinvoice` */

/*!50003 DROP FUNCTION IF EXISTS `create_noinvoice` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_noinvoice`() RETURNS char(15) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(6);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(6);
    DECLARE jumlah_digit INT DEFAULT 6;
    DECLARE cUnix CHAR(9);
    
    SET cUnix = concat('SJA/', DATE_FORMAT(NOW(), '%y%m'), '/');
    
    /*Nomor reset hanya ketika ganti tahun makanya left(invoice, 6)*/
    SELECT MAX(RIGHT(RTRIM(noinvoice), jumlah_digit)) 
    FROM `penjualan` 
    WHERE LEFT(noinvoice, 6) = left(cUnix,6) 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_nokwitansi` */

/*!50003 DROP FUNCTION IF EXISTS `create_nokwitansi` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_nokwitansi`(var_idpenjualan char(15)) RETURNS char(18) CHARSET utf8mb4 COLLATE utf8mb4_general_ci
    READS SQL DATA
BEGIN
    DECLARE cNosekarang CHAR(2);
    DECLARE nlen INT;
    DECLARE nNoselanjutnya INT;
    DECLARE cNoselanjutnya CHAR(2);
    DECLARE jumlah_digit INT DEFAULT 2;
    DECLARE cUnix CHAR(16);
    
    SET cUnix = CONCAT( var_idpenjualan, '#' );
    
    SELECT MAX(RIGHT(RTRIM(nokwitansi), jumlah_digit)) 
    FROM `penjualankwitansi` 
    WHERE LEFT(nokwitansi, 16) = cUnix 
    INTO cNosekarang;    
    
    SET cNosekarang = IF(ISNULL(cNosekarang), 0, cNosekarang);
    
    SET nNoselanjutnya = CAST(cNosekarang AS SIGNED) + 1;
    SET cNoselanjutnya = LPAD(nNoselanjutnya, jumlah_digit, '0');
    
    RETURN CONCAT(cUnix, cNoselanjutnya);
END */$$
DELIMITER ;

/* Function  structure for function  `create_unix_name` */

/*!50003 DROP FUNCTION IF EXISTS `create_unix_name` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `create_unix_name`(`var_string` VARCHAR(255), `var_length` INT(11)) RETURNS char(10) CHARSET latin1
BEGIN
	DECLARE var_return CHAR(10);
	DECLARE var_char CHAR(1);
	DECLARE posisi_space INT(11);	
	DECLARE posisi_space_temp INT(11);	
	DECLARE i INT(11);
	
	SET posisi_space = 0;
	SET posisi_space_temp = 0;
	SET i = 0;
	IF LEFT(var_string,2) IN ('PT', 'CV', 'UD') THEN
		SET var_return = '';
	ELSE
		IF var_string = '' THEN
			SET var_return = '';
		ELSE
			SET var_return = LEFT(var_string,1);
			SET var_length = var_length-1;
		END IF;
	END IF;
	
	LoopChar: WHILE i < var_length DO
			
			IF var_string = '' THEN
				-- leave LoopChar;
				SET var_char = SUBSTRING('ABCDEFGHIJKLMNOPQRSTUVWXYZ', FLOOR(RAND()*(25-1)+1), 1);
				SET var_return = CONCAT(var_return, var_char);
			ELSE 
				
				SET posisi_space_temp = LOCATE(' ' ,var_string, posisi_space+1);
				IF posisi_space_temp = 0 THEN 
					-- leave LoopChar;
					SET var_char = SUBSTRING('ABCDEFGHIJKLMNOPQRSTUVWXYZ', FLOOR(RAND()*(25-1)+1), 1);
					SET var_return = CONCAT(var_return, var_char);
				ELSE
					SET posisi_space = posisi_space_temp;
					SET var_char = SUBSTRING(var_string, posisi_space+1, 1);
					IF TRIM(var_char) <> '' THEN
						SET var_return = CONCAT(var_return, var_char);
					ELSE
						SET var_char = SUBSTRING('ABCDEFGHIJKLMNOPQRSTUVWXYZ', FLOOR(RAND()*(25-1)+1), 1);
						SET var_return = CONCAT(var_return, var_char);
					END IF;
				END IF;
			
			END IF;
			
			
			SET i = i +1;
		END WHILE LoopChar;	
		
		
	RETURN UPPER(var_return);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp_hitungulangpiutangkonsumen` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp_hitungulangpiutangkonsumen` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_hitungulangpiutangkonsumen`(varidkonsumen char(10))
BEGIN
	declare vartotaldebet decimal(18.0);
	DECLARE vartotalkredit DECIMAL(18.0);
	declare varjumlahpiutang decimal(18,0);
	
	select sum(totaldebet), sum(totalkredit) 
		from v_piutang 
		where idkonsumen = varidkonsumen into vartotaldebet, vartotalkredit;
	if vartotaldebet is null then
		set vartotaldebet = 0;
	end if;
	
	if vartotalkredit is null then 
		set vartotalkredit = 0;
	end if;
	
	set varjumlahpiutang = vartotaldebet - vartotalkredit;
	
	update konsumen set jumlahpiutang = varjumlahpiutang where idkonsumen = varidkonsumen;
    END */$$
DELIMITER ;

/*Table structure for table `v_akun1` */

DROP TABLE IF EXISTS `v_akun1`;

/*!50001 DROP VIEW IF EXISTS `v_akun1` */;
/*!50001 DROP TABLE IF EXISTS `v_akun1` */;

/*!50001 CREATE TABLE  `v_akun1`(
 `kdakun` char(9) ,
 `namaakun` varchar(100) ,
 `kdparent` char(7) ,
 `levels` int ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `inserted_date` datetime ,
 `updated_date` datetime 
)*/;

/*Table structure for table `v_akun2` */

DROP TABLE IF EXISTS `v_akun2`;

/*!50001 DROP VIEW IF EXISTS `v_akun2` */;
/*!50001 DROP TABLE IF EXISTS `v_akun2` */;

/*!50001 CREATE TABLE  `v_akun2`(
 `kdakun` char(9) ,
 `namaakun` varchar(100) ,
 `kdparent` char(7) ,
 `levels` int ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `namaparent` varchar(100) 
)*/;

/*Table structure for table `v_akun3` */

DROP TABLE IF EXISTS `v_akun3`;

/*!50001 DROP VIEW IF EXISTS `v_akun3` */;
/*!50001 DROP TABLE IF EXISTS `v_akun3` */;

/*!50001 CREATE TABLE  `v_akun3`(
 `kdakun` char(9) ,
 `namaakun` varchar(100) ,
 `kdparent` char(7) ,
 `levels` int ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `namaparent` varchar(100) 
)*/;

/*Table structure for table `v_akun4` */

DROP TABLE IF EXISTS `v_akun4`;

/*!50001 DROP VIEW IF EXISTS `v_akun4` */;
/*!50001 DROP TABLE IF EXISTS `v_akun4` */;

/*!50001 CREATE TABLE  `v_akun4`(
 `kdakun` char(9) ,
 `namaakun` varchar(100) ,
 `kdparent` char(7) ,
 `levels` int ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `namaparent` varchar(100) 
)*/;

/*Table structure for table `v_bank` */

DROP TABLE IF EXISTS `v_bank`;

/*!50001 DROP VIEW IF EXISTS `v_bank` */;
/*!50001 DROP TABLE IF EXISTS `v_bank` */;

/*!50001 CREATE TABLE  `v_bank`(
 `idbank` char(5) ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) ,
 `kdakun` char(9) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `namaakun` varchar(100) ,
 `kdparent` char(7) ,
 `atasnama` varchar(100) 
)*/;

/*Table structure for table `v_barang` */

DROP TABLE IF EXISTS `v_barang`;

/*!50001 DROP VIEW IF EXISTS `v_barang` */;
/*!50001 DROP TABLE IF EXISTS `v_barang` */;

/*!50001 CREATE TABLE  `v_barang`(
 `idbarang` char(10) ,
 `kdbarang` char(15) ,
 `namabarang` varchar(100) ,
 `idkategori` char(4) ,
 `kdakun` char(9) ,
 `stok` int ,
 `fotobarang` varchar(255) ,
 `hargabeli` decimal(18,0) ,
 `hargajualasli` decimal(18,0) ,
 `hargajualdiskon` decimal(10,0) ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `jenisbonuspenjualan` enum('Nominal','Persen') ,
 `persenbonuspenjualan` decimal(3,2) ,
 `jumlahbonuspenjualan` decimal(18,0) ,
 `jenisbonustagihan` enum('Nominal','Persen') ,
 `persenbonustagihan` decimal(3,2) ,
 `jumlahbonustagihan` decimal(18,0) ,
 `stokminimum` int ,
 `namakategori` varchar(50) ,
 `namaakun` varchar(100) ,
 `idjenisbarang` char(3) ,
 `jenisbarang` varchar(50) 
)*/;

/*Table structure for table `v_bonus` */

DROP TABLE IF EXISTS `v_bonus`;

/*!50001 DROP VIEW IF EXISTS `v_bonus` */;
/*!50001 DROP TABLE IF EXISTS `v_bonus` */;

/*!50001 CREATE TABLE  `v_bonus`(
 `idbonus` varchar(15) ,
 `tglbonus` date ,
 `idsales` char(10) ,
 `keterangan` varchar(255) ,
 `totalpenjualan` decimal(18,0) ,
 `totalpenagihan` decimal(18,0) ,
 `totalbonuspenjualan` decimal(18,0) ,
 `totalbonuspenagihan` decimal(18,0) ,
 `targetpenjualan` decimal(18,0) ,
 `pencapaiantarget` decimal(18,0) ,
 `totalbonustarget` decimal(18,0) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `namasales` varchar(50) ,
 `npwpsales` char(20) 
)*/;

/*Table structure for table `v_dasar_bonus_penjualan` */

DROP TABLE IF EXISTS `v_dasar_bonus_penjualan`;

/*!50001 DROP VIEW IF EXISTS `v_dasar_bonus_penjualan` */;
/*!50001 DROP TABLE IF EXISTS `v_dasar_bonus_penjualan` */;

/*!50001 CREATE TABLE  `v_dasar_bonus_penjualan`(
 `id` int ,
 `idpenjualan` char(15) ,
 `idbarang` char(10) ,
 `jumlahjual` int ,
 `hargasatuan` decimal(18,0) ,
 `hargadpp` decimal(18,0) ,
 `jumlahppn` decimal(18,0) ,
 `jumlahdiskon` decimal(18,0) ,
 `subtotaljual` decimal(18,0) ,
 `jenisdiskon` enum('Persen','Nominal') ,
 `diskonpersen1` int ,
 `diskonpersen2` int ,
 `diskonpersen3` int ,
 `idsuratjalan` char(10) ,
 `iddetailsuratjalan` int ,
 `idbonus` char(15) ,
 `namabarang` varchar(100) ,
 `jenisbonuspenjualan` enum('Nominal','Persen') ,
 `persenbonuspenjualan` decimal(3,2) ,
 `jumlahbonuspenjualan` decimal(18,0) ,
 `jenisbonustagihan` enum('Nominal','Persen') ,
 `persenbonustagihan` decimal(3,2) ,
 `jumlahbonustagihan` decimal(18,0) ,
 `idsales` char(10) ,
 `namasales` varchar(50) ,
 `npwpsales` char(20) ,
 `noinvoice` char(15) ,
 `tglinvoice` date 
)*/;

/*Table structure for table `v_dasar_bonus_target` */

DROP TABLE IF EXISTS `v_dasar_bonus_target`;

/*!50001 DROP VIEW IF EXISTS `v_dasar_bonus_target` */;
/*!50001 DROP TABLE IF EXISTS `v_dasar_bonus_target` */;

/*!50001 CREATE TABLE  `v_dasar_bonus_target`(
 `id` int ,
 `idpenjualan` char(15) ,
 `idbarang` char(10) ,
 `jumlahjual` int ,
 `hargasatuan` decimal(18,0) ,
 `hargadpp` decimal(18,0) ,
 `jumlahppn` decimal(18,0) ,
 `jumlahdiskon` decimal(18,0) ,
 `subtotaljual` decimal(18,0) ,
 `jenisdiskon` enum('Persen','Nominal') ,
 `diskonpersen1` int ,
 `diskonpersen2` int ,
 `diskonpersen3` int ,
 `idsuratjalan` char(10) ,
 `iddetailsuratjalan` int ,
 `idbonus` char(15) ,
 `namabarang` varchar(100) ,
 `jenisbonuspenjualan` enum('Nominal','Persen') ,
 `persenbonuspenjualan` decimal(3,2) ,
 `jumlahbonuspenjualan` decimal(18,0) ,
 `jenisbonustagihan` enum('Nominal','Persen') ,
 `persenbonustagihan` decimal(3,2) ,
 `jumlahbonustagihan` decimal(18,0) ,
 `idjenisbarang` char(3) ,
 `jenisbarang` varchar(50) ,
 `persenbonustarget` decimal(3,2) ,
 `idsales` char(10) ,
 `namasales` varchar(50) ,
 `npwpsales` char(20) ,
 `targetpenjualan` decimal(18,0) ,
 `noinvoice` char(15) ,
 `tglinvoice` date 
)*/;

/*Table structure for table `v_ekspedisi` */

DROP TABLE IF EXISTS `v_ekspedisi`;

/*!50001 DROP VIEW IF EXISTS `v_ekspedisi` */;
/*!50001 DROP TABLE IF EXISTS `v_ekspedisi` */;

/*!50001 CREATE TABLE  `v_ekspedisi`(
 `idekspedisi` char(10) ,
 `namaekspedisi` varchar(50) ,
 `alamatekspedisi` varchar(255) ,
 `notelpekspedisi` char(20) ,
 `emailekspedisi` varchar(50) ,
 `nikpemilik` char(16) ,
 `namapemilik` varchar(50) ,
 `notelppemilik` char(20) ,
 `nowapemilik` char(20) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `kdakunutang` char(9) ,
 `namaakunutang` varchar(100) 
)*/;

/*Table structure for table `v_hutang` */

DROP TABLE IF EXISTS `v_hutang`;

/*!50001 DROP VIEW IF EXISTS `v_hutang` */;
/*!50001 DROP TABLE IF EXISTS `v_hutang` */;

/*!50001 CREATE TABLE  `v_hutang`(
 `idhutang` char(12) ,
 `idpembelian` char(15) ,
 `tglhutang` date ,
 `idsupplier` char(10) ,
 `totaldebet` decimal(18,0) ,
 `totalkredit` decimal(18,0) ,
 `jenissumber` enum('Pembelian','Non Pembelian') ,
 `keterangan` varchar(255) ,
 `namasupplier` varchar(50) ,
 `nofaktur` varchar(30) ,
 `tglfaktur` date ,
 `statuslunas` varchar(11) 
)*/;

/*Table structure for table `v_hutang_laprekap` */

DROP TABLE IF EXISTS `v_hutang_laprekap`;

/*!50001 DROP VIEW IF EXISTS `v_hutang_laprekap` */;
/*!50001 DROP TABLE IF EXISTS `v_hutang_laprekap` */;

/*!50001 CREATE TABLE  `v_hutang_laprekap`(
 `idhutang` char(12) ,
 `idpembelian` char(15) ,
 `tglhutang` date ,
 `idsupplier` char(10) ,
 `namasupplier` varchar(50) ,
 `jumlahhutang` decimal(18,0) ,
 `jumlahdibayar` decimal(40,0) ,
 `nofaktur` varchar(30) ,
 `tglfaktur` date 
)*/;

/*Table structure for table `v_hutangdetail` */

DROP TABLE IF EXISTS `v_hutangdetail`;

/*!50001 DROP VIEW IF EXISTS `v_hutangdetail` */;
/*!50001 DROP TABLE IF EXISTS `v_hutangdetail` */;

/*!50001 CREATE TABLE  `v_hutangdetail`(
 `idhutangdetail` char(15) ,
 `idhutang` char(12) ,
 `tglhutang` date ,
 `debet` decimal(18,0) ,
 `kredit` decimal(18,0) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `carabayar` enum('Tunai','Transfer','Giro') ,
 `idbank` char(5) ,
 `jenis` enum('Hutang','Pembayaran Hutang') ,
 `nobilyetgiro` varchar(25) ,
 `idpembelian` char(15) ,
 `idsupplier` char(10) ,
 `namabank` varchar(50) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_hutangdetail_bahanjurnal` */

DROP TABLE IF EXISTS `v_hutangdetail_bahanjurnal`;

/*!50001 DROP VIEW IF EXISTS `v_hutangdetail_bahanjurnal` */;
/*!50001 DROP TABLE IF EXISTS `v_hutangdetail_bahanjurnal` */;

/*!50001 CREATE TABLE  `v_hutangdetail_bahanjurnal`(
 `idhutangdetail` char(15) ,
 `tglhutang` date ,
 `debet` decimal(18,0) ,
 `carabayar` enum('Tunai','Transfer','Giro') ,
 `kdakunbank` char(9) ,
 `nofaktur` varchar(30) ,
 `tglfaktur` date ,
 `jenissumber` enum('Pembelian','Non Pembelian') 
)*/;

/*Table structure for table `v_hutangdetail_bahanjurnal_nonpembelian` */

DROP TABLE IF EXISTS `v_hutangdetail_bahanjurnal_nonpembelian`;

/*!50001 DROP VIEW IF EXISTS `v_hutangdetail_bahanjurnal_nonpembelian` */;
/*!50001 DROP TABLE IF EXISTS `v_hutangdetail_bahanjurnal_nonpembelian` */;

/*!50001 CREATE TABLE  `v_hutangdetail_bahanjurnal_nonpembelian`(
 `idhutangdetail` char(15) ,
 `tglhutang` date ,
 `debet` decimal(18,0) ,
 `kredit` decimal(18,0) ,
 `carabayar` enum('Tunai','Transfer','Giro') ,
 `kdakunbank` char(9) ,
 `jenissumber` enum('Pembelian','Non Pembelian') ,
 `keterangan` varchar(255) ,
 `idhutang` char(12) 
)*/;

/*Table structure for table `v_hutangdetail_laporan` */

DROP TABLE IF EXISTS `v_hutangdetail_laporan`;

/*!50001 DROP VIEW IF EXISTS `v_hutangdetail_laporan` */;
/*!50001 DROP TABLE IF EXISTS `v_hutangdetail_laporan` */;

/*!50001 CREATE TABLE  `v_hutangdetail_laporan`(
 `idhutangdetail` char(15) ,
 `idhutang` char(12) ,
 `tglhutang` date ,
 `debet` decimal(18,0) ,
 `kredit` decimal(18,0) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `carabayar` enum('Tunai','Transfer','Giro') ,
 `idbank` char(5) ,
 `jenis` enum('Hutang','Pembayaran Hutang') ,
 `idpembelian` char(15) ,
 `idsupplier` char(10) ,
 `namabank` varchar(50) ,
 `namapengguna` varchar(50) ,
 `totaldebet` decimal(18,0) ,
 `totalkredit` decimal(18,0) ,
 `nofaktur` varchar(30) ,
 `tglfaktur` date ,
 `namasupplier` varchar(50) ,
 `npwpsupplier` char(20) 
)*/;

/*Table structure for table `v_hutangekspedisi` */

DROP TABLE IF EXISTS `v_hutangekspedisi`;

/*!50001 DROP VIEW IF EXISTS `v_hutangekspedisi` */;
/*!50001 DROP TABLE IF EXISTS `v_hutangekspedisi` */;

/*!50001 CREATE TABLE  `v_hutangekspedisi`(
 `idhutangekspedisi` char(15) ,
 `idtransaksi` char(15) ,
 `tglhutang` date ,
 `idekspedisi` char(10) ,
 `debet` decimal(18,0) ,
 `kredit` decimal(18,0) ,
 `jenissumber` enum('Pembelian','Penjualan','Pembayaran','Saldo') ,
 `keterangan` varchar(255) ,
 `carabayar` enum('Tunai','Transfer','Giro') ,
 `jenis` enum('Hutang','Pembayaran') ,
 `idbank` char(5) ,
 `nobilyetgiro` varchar(25) ,
 `hargadpp` decimal(18,0) ,
 `persenppn` decimal(3,2) ,
 `jumlahppn` decimal(18,0) ,
 `persenpph23` decimal(3,2) ,
 `jumlahpph23` decimal(18,0) ,
 `namaekspedisi` varchar(50) ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) ,
 `kdakunbank` char(9) 
)*/;

/*Table structure for table `v_jurnal` */

DROP TABLE IF EXISTS `v_jurnal`;

/*!50001 DROP VIEW IF EXISTS `v_jurnal` */;
/*!50001 DROP TABLE IF EXISTS `v_jurnal` */;

/*!50001 CREATE TABLE  `v_jurnal`(
 `idjurnal` char(15) ,
 `tgljurnal` date ,
 `keterangan` varchar(255) ,
 `totaldebet` decimal(18,0) ,
 `totalkredit` decimal(18,0) ,
 `referensi` char(15) ,
 `jenis` enum('Penjualan','Pembelian','Stock Adjustment','Penerimaan','Pengeluaran','Hutang','Piutang','Jurnal Penyesuaian','Retur Pembelian','Retur Penjualan','Saldo Awal') ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `idposting` char(6) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_jurnaldetail` */

DROP TABLE IF EXISTS `v_jurnaldetail`;

/*!50001 DROP VIEW IF EXISTS `v_jurnaldetail` */;
/*!50001 DROP TABLE IF EXISTS `v_jurnaldetail` */;

/*!50001 CREATE TABLE  `v_jurnaldetail`(
 `idjurnaldetail` int ,
 `idjurnal` char(15) ,
 `kdakun` char(9) ,
 `debet` decimal(18,0) ,
 `kredit` decimal(18,0) ,
 `urut` int ,
 `namaakun` varchar(100) ,
 `kdparent` char(7) ,
 `tgljurnal` date ,
 `jenis` enum('Penjualan','Pembelian','Stock Adjustment','Penerimaan','Pengeluaran','Hutang','Piutang','Jurnal Penyesuaian','Retur Pembelian','Retur Penjualan','Saldo Awal') ,
 `referensi` char(15) ,
 `keterangan` varchar(255) 
)*/;

/*Table structure for table `v_konsumen` */

DROP TABLE IF EXISTS `v_konsumen`;

/*!50001 DROP VIEW IF EXISTS `v_konsumen` */;
/*!50001 DROP TABLE IF EXISTS `v_konsumen` */;

/*!50001 CREATE TABLE  `v_konsumen`(
 `idkonsumen` char(6) ,
 `namakonsumen` varchar(50) ,
 `alamatkonsumen` varchar(255) ,
 `notelpkonsumen` char(20) ,
 `emailkonsumen` varchar(50) ,
 `nikpemilik` char(16) ,
 `namapemilik` varchar(50) ,
 `notelppemilik` char(20) ,
 `nowapemilik` char(20) ,
 `saldo` decimal(18,0) ,
 `idwilayah` char(3) ,
 `saldopajak` decimal(18,0) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `npwp` char(20) ,
 `limitkredit` decimal(18,0) ,
 `jumlahpiutang` decimal(18,0) ,
 `kdakunpiutang` char(9) ,
 `namawilayah` varchar(50) ,
 `namaakunpiutang` varchar(100) 
)*/;

/*Table structure for table `v_pembelian` */

DROP TABLE IF EXISTS `v_pembelian`;

/*!50001 DROP VIEW IF EXISTS `v_pembelian` */;
/*!50001 DROP TABLE IF EXISTS `v_pembelian` */;

/*!50001 CREATE TABLE  `v_pembelian`(
 `idpembelian` char(15) ,
 `idsupplier` char(10) ,
 `nofaktur` varchar(30) ,
 `tglfaktur` date ,
 `tglditerima` date ,
 `keterangan` varchar(255) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `namasupplier` varchar(50) ,
 `namapengguna` varchar(50) ,
 `carabayar` enum('Tunai','Transfer','Hutang','Giro') ,
 `idbank` char(5) ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) ,
 `atasnama` varchar(100) ,
 `kdakunbank` char(9) ,
 `totalpembelian` decimal(18,0) ,
 `totaldiskon` decimal(18,0) ,
 `totalbersih` decimal(18,0) ,
 `ppnpersen` int ,
 `totalppn` decimal(18,0) ,
 `biayapengiriman` decimal(18,0) ,
 `totalpotongan` decimal(18,0) ,
 `totalfaktur` decimal(18,0) ,
 `totaldpp` decimal(18,0) ,
 `nobilyetgiro` varchar(25) ,
 `tglbilyetgiro` date ,
 `totaldpp_po` decimal(18,0) ,
 `totalppn_po` decimal(18,0) ,
 `totalfaktur_po` decimal(18,0) ,
 `statuspenerimaan` enum('Belum Diterima','Sudah Diterima') ,
 `tgl_po` date ,
 `keterangan_po` varchar(255) ,
 `idpengguna_po` char(10) ,
 `idekspedisi` char(10) ,
 `namaekspedisi` varchar(50) 
)*/;

/*Table structure for table `v_pembelian_po` */

DROP TABLE IF EXISTS `v_pembelian_po`;

/*!50001 DROP VIEW IF EXISTS `v_pembelian_po` */;
/*!50001 DROP TABLE IF EXISTS `v_pembelian_po` */;

/*!50001 CREATE TABLE  `v_pembelian_po`(
 `idpembelian` char(15) ,
 `idsupplier` char(10) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `totaldpp_po` decimal(18,0) ,
 `totalppn_po` decimal(18,0) ,
 `totalfaktur_po` decimal(18,0) ,
 `statuspenerimaan` enum('Belum Diterima','Sudah Diterima') ,
 `tgl_po` date ,
 `keterangan_po` varchar(255) ,
 `idpengguna_po` char(10) ,
 `nofaktur` varchar(30) ,
 `ppnpersen` int ,
 `namasupplier` varchar(50) 
)*/;

/*Table structure for table `v_pembeliandetail` */

DROP TABLE IF EXISTS `v_pembeliandetail`;

/*!50001 DROP VIEW IF EXISTS `v_pembeliandetail` */;
/*!50001 DROP TABLE IF EXISTS `v_pembeliandetail` */;

/*!50001 CREATE TABLE  `v_pembeliandetail`(
 `id` int ,
 `idpembelian` char(15) ,
 `idbarang` char(10) ,
 `jumlahbeli` int ,
 `hargasatuan` decimal(18,0) ,
 `hargadpp` decimal(18,0) ,
 `jumlahppn` decimal(18,0) ,
 `jumlahdiskon` decimal(18,0) ,
 `jenisdiskon` enum('Persen','Nominal') ,
 `diskonpersen1` int ,
 `diskonpersen2` int ,
 `diskonpersen3` int ,
 `subtotalbeli` decimal(18,0) ,
 `jumlahbeli_po` int ,
 `hargasatuan_po` int ,
 `hargadpp_po` decimal(18,0) ,
 `jumlahppn_po` decimal(18,0) ,
 `subtotalbeli_po` decimal(18,0) ,
 `tglfaktur` date ,
 `nofaktur` varchar(30) ,
 `tglditerima` date ,
 `idsupplier` char(10) ,
 `namabarang` varchar(100) ,
 `idkategori` char(4) ,
 `kdakun` char(9) ,
 `namakategori` varchar(50) ,
 `stokreal` int 
)*/;

/*Table structure for table `v_pembeliandetail_bahanjurnal` */

DROP TABLE IF EXISTS `v_pembeliandetail_bahanjurnal`;

/*!50001 DROP VIEW IF EXISTS `v_pembeliandetail_bahanjurnal` */;
/*!50001 DROP TABLE IF EXISTS `v_pembeliandetail_bahanjurnal` */;

/*!50001 CREATE TABLE  `v_pembeliandetail_bahanjurnal`(
 `idpembelian` char(15) ,
 `kdakunbarang` char(9) ,
 `subtotalbeli` decimal(40,0) ,
 `nofaktur` varchar(30) ,
 `tglfaktur` date ,
 `totalfaktur` decimal(18,0) ,
 `carabayar` enum('Tunai','Transfer','Hutang','Giro') ,
 `kdakunbank` char(9) ,
 `keterangan` varchar(255) 
)*/;

/*Table structure for table `v_pembeliandetail_laporan` */

DROP TABLE IF EXISTS `v_pembeliandetail_laporan`;

/*!50001 DROP VIEW IF EXISTS `v_pembeliandetail_laporan` */;
/*!50001 DROP TABLE IF EXISTS `v_pembeliandetail_laporan` */;

/*!50001 CREATE TABLE  `v_pembeliandetail_laporan`(
 `id` int ,
 `idpembelian` char(15) ,
 `idbarang` char(10) ,
 `jumlahbeli` int ,
 `hargasatuan` decimal(18,0) ,
 `hargadpp` decimal(18,0) ,
 `jumlahppn` decimal(18,0) ,
 `jumlahdiskon` decimal(18,0) ,
 `subtotalbeli` decimal(18,0) ,
 `jenisdiskon` enum('Persen','Nominal') ,
 `diskonpersen1` int ,
 `diskonpersen2` int ,
 `diskonpersen3` int ,
 `namabarang` varchar(100) ,
 `idkategori` char(4) ,
 `kdakunbarang` char(9) ,
 `fotobarang` varchar(255) ,
 `namakategori` varchar(50) ,
 `idsupplier` char(10) ,
 `nofaktur` varchar(30) ,
 `tglfaktur` date ,
 `tglditerima` date ,
 `keterangan` varchar(255) ,
 `totalpembelian` decimal(18,0) ,
 `totaldiskon` decimal(18,0) ,
 `totalbersih` decimal(18,0) ,
 `ppnpersen` int ,
 `totalppn` decimal(18,0) ,
 `biayapengiriman` decimal(18,0) ,
 `totalpotongan` decimal(18,0) ,
 `totalfaktur` decimal(18,0) ,
 `idpengguna` char(10) ,
 `carabayar` enum('Tunai','Transfer','Hutang','Giro') ,
 `idbank` char(5) ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) ,
 `atasnama` varchar(100) ,
 `namasupplier` varchar(50) ,
 `alamatsupplier` varchar(255) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_pembeliandetail_po` */

DROP TABLE IF EXISTS `v_pembeliandetail_po`;

/*!50001 DROP VIEW IF EXISTS `v_pembeliandetail_po` */;
/*!50001 DROP TABLE IF EXISTS `v_pembeliandetail_po` */;

/*!50001 CREATE TABLE  `v_pembeliandetail_po`(
 `id` int ,
 `tgl_po` date ,
 `idpembelian` char(15) ,
 `idbarang` char(10) ,
 `jumlahbeli_po` int ,
 `hargasatuan_po` int ,
 `hargadpp_po` decimal(18,0) ,
 `jumlahppn_po` decimal(18,0) ,
 `subtotalbeli_po` decimal(18,0) ,
 `namabarang` varchar(100) ,
 `idkategori` char(4) ,
 `namakategori` varchar(50) 
)*/;

/*Table structure for table `v_pembeliandetail_retur` */

DROP TABLE IF EXISTS `v_pembeliandetail_retur`;

/*!50001 DROP VIEW IF EXISTS `v_pembeliandetail_retur` */;
/*!50001 DROP TABLE IF EXISTS `v_pembeliandetail_retur` */;

/*!50001 CREATE TABLE  `v_pembeliandetail_retur`(
 `id` int ,
 `idpembelian` char(15) ,
 `idbarang` char(10) ,
 `jumlahbeli` decimal(32,0) ,
 `jumlahretur` decimal(32,0) ,
 `hargasatuan` decimal(18,0) ,
 `jumlahdiskon` decimal(18,0) ,
 `subtotalbeli` decimal(18,0) ,
 `tglfaktur` date ,
 `nofaktur` varchar(30) ,
 `tglditerima` date ,
 `idsupplier` char(10) ,
 `namabarang` varchar(100) ,
 `idkategori` char(4) ,
 `kdakun` char(9) ,
 `namakategori` varchar(50) 
)*/;

/*Table structure for table `v_penagihan` */

DROP TABLE IF EXISTS `v_penagihan`;

/*!50001 DROP VIEW IF EXISTS `v_penagihan` */;
/*!50001 DROP TABLE IF EXISTS `v_penagihan` */;

/*!50001 CREATE TABLE  `v_penagihan`(
 `idpenagihan` char(15) ,
 `tglpenagihan` date ,
 `idsales` char(10) ,
 `totaltagihan` decimal(18,0) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `statuscetak` enum('Sudah Cetak','Belum Cetak') ,
 `namasales` varchar(50) ,
 `npwpsales` char(20) 
)*/;

/*Table structure for table `v_penagihan_yang_dibayar` */

DROP TABLE IF EXISTS `v_penagihan_yang_dibayar`;

/*!50001 DROP VIEW IF EXISTS `v_penagihan_yang_dibayar` */;
/*!50001 DROP TABLE IF EXISTS `v_penagihan_yang_dibayar` */;

/*!50001 CREATE TABLE  `v_penagihan_yang_dibayar`(
 `idpenagihan` char(15) ,
 `idsalesbonus` char(10) ,
 `idpiutang` char(12) ,
 `idpenjualan` char(15) ,
 `idpiutangdetail` char(15) ,
 `tglpiutang` date ,
 `tgljatuhtempo` date ,
 `debet` decimal(18,0) ,
 `kredit` decimal(18,0) ,
 `bonuspenagihansudahdibayar` tinyint 
)*/;

/*Table structure for table `v_penagihan_yang_dibayar_detail` */

DROP TABLE IF EXISTS `v_penagihan_yang_dibayar_detail`;

/*!50001 DROP VIEW IF EXISTS `v_penagihan_yang_dibayar_detail` */;
/*!50001 DROP TABLE IF EXISTS `v_penagihan_yang_dibayar_detail` */;

/*!50001 CREATE TABLE  `v_penagihan_yang_dibayar_detail`(
 `idpenagihan` char(15) ,
 `idsalesbonus` char(10) ,
 `idpiutang` char(12) ,
 `idpenjualan` char(15) ,
 `idpiutangdetail` char(15) ,
 `tglpiutang` date ,
 `tgljatuhtempo` date ,
 `debet` decimal(18,0) ,
 `kredit` decimal(18,0) ,
 `bonuspenagihansudahdibayar` tinyint ,
 `noinvoice` char(15) ,
 `tglinvoice` date ,
 `totaldiskon` decimal(18,0) ,
 `totaldpp` decimal(18,0) ,
 `totalppn` decimal(18,0) ,
 `totalinvoice` decimal(18,0) ,
 `idpenjualandetail` int ,
 `idbarang` char(10) ,
 `jumlahjual` int ,
 `hargasatuan` decimal(18,0) ,
 `hargadpp` decimal(18,0) ,
 `jumlahppn` decimal(18,0) ,
 `jumlahdiskon` decimal(18,0) ,
 `subtotaljual` decimal(18,0) ,
 `namabarang` varchar(100) ,
 `jenisbonustagihan` enum('Nominal','Persen') ,
 `persenbonustagihan` decimal(3,2) ,
 `jumlahbonustagihan` decimal(18,0) 
)*/;

/*Table structure for table `v_penagihandetail` */

DROP TABLE IF EXISTS `v_penagihandetail`;

/*!50001 DROP VIEW IF EXISTS `v_penagihandetail` */;
/*!50001 DROP TABLE IF EXISTS `v_penagihandetail` */;

/*!50001 CREATE TABLE  `v_penagihandetail`(
 `id` int ,
 `idpenagihan` char(15) ,
 `tglpenagihan` date ,
 `idpiutang` char(12) ,
 `jumlahtagihan` decimal(18,0) ,
 `idsalesbonus` char(10) ,
 `noinvoice` char(15) ,
 `tglinvoice` date ,
 `tglpiutang` date ,
 `tgljatuhtempo` date ,
 `idkonsumen` char(6) ,
 `namakonsumen` varchar(50) ,
 `namawilayah` varchar(50) ,
 `namasalesbonus` varchar(50) ,
 `totaldebet` decimal(10,0) ,
 `totalkredit` decimal(10,0) 
)*/;

/*Table structure for table `v_penerimaan` */

DROP TABLE IF EXISTS `v_penerimaan`;

/*!50001 DROP VIEW IF EXISTS `v_penerimaan` */;
/*!50001 DROP TABLE IF EXISTS `v_penerimaan` */;

/*!50001 CREATE TABLE  `v_penerimaan`(
 `idpenerimaan` char(15) ,
 `tglpenerimaan` date ,
 `totalpenerimaan` decimal(18,0) ,
 `keterangan` varchar(255) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `carabayar` enum('Tunai','Transfer') ,
 `idbank` char(5) ,
 `namapengguna` varchar(50) ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) 
)*/;

/*Table structure for table `v_penerimaandetail` */

DROP TABLE IF EXISTS `v_penerimaandetail`;

/*!50001 DROP VIEW IF EXISTS `v_penerimaandetail` */;
/*!50001 DROP TABLE IF EXISTS `v_penerimaandetail` */;

/*!50001 CREATE TABLE  `v_penerimaandetail`(
 `idpenerimaandetail` int ,
 `idpenerimaan` char(15) ,
 `kdakun` char(9) ,
 `jumlahpenerimaan` decimal(18,0) ,
 `tglpenerimaan` date ,
 `namaakun` varchar(100) ,
 `kdparent` char(7) 
)*/;

/*Table structure for table `v_penerimaandetail_laporan` */

DROP TABLE IF EXISTS `v_penerimaandetail_laporan`;

/*!50001 DROP VIEW IF EXISTS `v_penerimaandetail_laporan` */;
/*!50001 DROP TABLE IF EXISTS `v_penerimaandetail_laporan` */;

/*!50001 CREATE TABLE  `v_penerimaandetail_laporan`(
 `idpenerimaan` char(15) ,
 `tglpenerimaan` date ,
 `keterangan` varchar(255) ,
 `carabayar` enum('Tunai','Transfer') ,
 `idbank` char(5) ,
 `idpenerimaandetail` int ,
 `kdakun` char(9) ,
 `jumlahpenerimaan` decimal(18,0) ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) ,
 `kdakunbank` char(9) ,
 `totalpenerimaan` decimal(18,0) 
)*/;

/*Table structure for table `v_pengeluaran` */

DROP TABLE IF EXISTS `v_pengeluaran`;

/*!50001 DROP VIEW IF EXISTS `v_pengeluaran` */;
/*!50001 DROP TABLE IF EXISTS `v_pengeluaran` */;

/*!50001 CREATE TABLE  `v_pengeluaran`(
 `idpengeluaran` char(15) ,
 `tglpengeluaran` date ,
 `nokwitansi` varchar(30) ,
 `totalpengeluaran` decimal(18,0) ,
 `keterangan` varchar(255) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `carabayar` enum('Tunai','Transfer') ,
 `idbank` char(5) ,
 `namapengguna` varchar(50) ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) ,
 `kdakunbank` char(9) 
)*/;

/*Table structure for table `v_pengeluarandetail` */

DROP TABLE IF EXISTS `v_pengeluarandetail`;

/*!50001 DROP VIEW IF EXISTS `v_pengeluarandetail` */;
/*!50001 DROP TABLE IF EXISTS `v_pengeluarandetail` */;

/*!50001 CREATE TABLE  `v_pengeluarandetail`(
 `idpengeluarandetail` int ,
 `idpengeluaran` char(15) ,
 `kdakun` char(9) ,
 `jumlahpengeluaran` decimal(18,0) ,
 `tglpengeluaran` date ,
 `namaakun` varchar(100) ,
 `kdparent` char(7) 
)*/;

/*Table structure for table `v_pengeluarandetail_bahanjurnal` */

DROP TABLE IF EXISTS `v_pengeluarandetail_bahanjurnal`;

/*!50001 DROP VIEW IF EXISTS `v_pengeluarandetail_bahanjurnal` */;
/*!50001 DROP TABLE IF EXISTS `v_pengeluarandetail_bahanjurnal` */;

/*!50001 CREATE TABLE  `v_pengeluarandetail_bahanjurnal`(
 `idpengeluaran` char(15) ,
 `tglpengeluaran` date ,
 `keterangan` varchar(255) ,
 `totalpengeluaran` decimal(18,0) ,
 `carabayar` enum('Tunai','Transfer') ,
 `kdakun` char(9) ,
 `jumlahpengeluaran` decimal(18,0) ,
 `kdakunbank` char(9) 
)*/;

/*Table structure for table `v_pengguna` */

DROP TABLE IF EXISTS `v_pengguna`;

/*!50001 DROP VIEW IF EXISTS `v_pengguna` */;
/*!50001 DROP TABLE IF EXISTS `v_pengguna` */;

/*!50001 CREATE TABLE  `v_pengguna`(
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) ,
 `jeniskelamin` enum('Laki-laki','Perempuan') ,
 `notelppengguna` char(20) ,
 `emailpengguna` varchar(50) ,
 `fotopengguna` varchar(255) ,
 `username` varchar(50) ,
 `password` varchar(255) ,
 `idotorisasi` char(5) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `namaotorisasi` varchar(50) ,
 `lastlogin` datetime 
)*/;

/*Table structure for table `v_penjualan` */

DROP TABLE IF EXISTS `v_penjualan`;

/*!50001 DROP VIEW IF EXISTS `v_penjualan` */;
/*!50001 DROP TABLE IF EXISTS `v_penjualan` */;

/*!50001 CREATE TABLE  `v_penjualan`(
 `idpenjualan` char(15) ,
 `idkonsumen` char(6) ,
 `tglinvoice` date ,
 `noinvoice` char(15) ,
 `keterangan` varchar(255) ,
 `totalpenjualan` decimal(18,0) ,
 `totaldpp` decimal(18,0) ,
 `totaldiskon` decimal(18,0) ,
 `totalbersih` decimal(18,0) ,
 `ppnpersen` int ,
 `totalppn` decimal(18,0) ,
 `biayapengiriman` decimal(18,0) ,
 `totalinvoice` decimal(18,0) ,
 `idpengguna` char(10) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `carabayar` enum('Tunai','Transfer','Piutang','Giro') ,
 `idbank` char(5) ,
 `idjenispiutang` char(3) ,
 `idsales` char(10) ,
 `nokwitansi` char(18) ,
 `nobilyetgiro` varchar(25) ,
 `namakonsumen` varchar(50) ,
 `idwilayah` char(3) ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) ,
 `atasnama` varchar(100) ,
 `namasales` varchar(50) ,
 `namajenispiutang` varchar(50) ,
 `jatuhtempo` int ,
 `namapengguna` varchar(50) ,
 `namawilayah` varchar(50) 
)*/;

/*Table structure for table `v_penjualan_belumada_suratjalan` */

DROP TABLE IF EXISTS `v_penjualan_belumada_suratjalan`;

/*!50001 DROP VIEW IF EXISTS `v_penjualan_belumada_suratjalan` */;
/*!50001 DROP TABLE IF EXISTS `v_penjualan_belumada_suratjalan` */;

/*!50001 CREATE TABLE  `v_penjualan_belumada_suratjalan`(
 `idpenjualan` char(15) ,
 `idkonsumen` char(6) ,
 `tglinvoice` date ,
 `noinvoice` char(15) ,
 `totalinvoice` decimal(18,0) ,
 `idsales` char(10) ,
 `carabayar` enum('Tunai','Transfer','Piutang','Giro') ,
 `idsuratjalan` char(10) 
)*/;

/*Table structure for table `v_penjualandetail` */

DROP TABLE IF EXISTS `v_penjualandetail`;

/*!50001 DROP VIEW IF EXISTS `v_penjualandetail` */;
/*!50001 DROP TABLE IF EXISTS `v_penjualandetail` */;

/*!50001 CREATE TABLE  `v_penjualandetail`(
 `id` int ,
 `idpenjualan` char(15) ,
 `idbarang` char(10) ,
 `jumlahjual` int ,
 `hargasatuan` decimal(18,0) ,
 `hargadpp` decimal(18,0) ,
 `jumlahppn` decimal(18,0) ,
 `jumlahdiskon` decimal(18,0) ,
 `subtotaljual` decimal(18,0) ,
 `jenisdiskon` enum('Persen','Nominal') ,
 `diskonpersen1` int ,
 `diskonpersen2` int ,
 `diskonpersen3` int ,
 `idkonsumen` char(6) ,
 `tglinvoice` date ,
 `noinvoice` char(15) ,
 `ppnpersen` int ,
 `namabarang` varchar(100) ,
 `idkategori` char(4) ,
 `kdakun` char(9) ,
 `stokreal` int ,
 `namakategori` varchar(50) ,
 `jenisbonuspenjualan` enum('Nominal','Persen') ,
 `persenbonuspenjualan` decimal(3,2) ,
 `jumlahbonuspenjualan` decimal(18,0) ,
 `subtotalbonuspenjualan` decimal(18,0) ,
 `jenisbonustagihan` enum('Nominal','Persen') ,
 `persenbonustagihan` decimal(3,2) ,
 `jumlahbonustagihan` decimal(18,0) ,
 `subtotalbonustagihan` decimal(18,0) 
)*/;

/*Table structure for table `v_penjualandetail_retur` */

DROP TABLE IF EXISTS `v_penjualandetail_retur`;

/*!50001 DROP VIEW IF EXISTS `v_penjualandetail_retur` */;
/*!50001 DROP TABLE IF EXISTS `v_penjualandetail_retur` */;

/*!50001 CREATE TABLE  `v_penjualandetail_retur`(
 `id` int ,
 `idpenjualan` char(15) ,
 `idbarang` char(10) ,
 `jumlahjual` decimal(32,0) ,
 `jumlahretur` decimal(32,0) ,
 `hargasatuan` decimal(18,0) ,
 `jumlahdiskon` decimal(18,0) ,
 `subtotaljual` decimal(18,0) ,
 `jenisdiskon` enum('Persen','Nominal') ,
 `diskonpersen1` int ,
 `diskonpersen2` int ,
 `diskonpersen3` int ,
 `idkonsumen` char(6) ,
 `tglinvoice` date ,
 `noinvoice` char(15) ,
 `ppnpersen` int ,
 `namabarang` varchar(100) ,
 `idkategori` char(4) ,
 `kdakun` char(9) ,
 `namakategori` varchar(50) 
)*/;

/*Table structure for table `v_penjualanpiutang_lewat_jatuh_tempo` */

DROP TABLE IF EXISTS `v_penjualanpiutang_lewat_jatuh_tempo`;

/*!50001 DROP VIEW IF EXISTS `v_penjualanpiutang_lewat_jatuh_tempo` */;
/*!50001 DROP TABLE IF EXISTS `v_penjualanpiutang_lewat_jatuh_tempo` */;

/*!50001 CREATE TABLE  `v_penjualanpiutang_lewat_jatuh_tempo`(
 `idpenjualan` char(15) ,
 `idkonsumen` char(6) ,
 `tglinvoice` date ,
 `noinvoice` char(15) ,
 `keterangan` varchar(255) ,
 `totalpenjualan` decimal(18,0) ,
 `totaldpp` decimal(18,0) ,
 `totaldiskon` decimal(18,0) ,
 `totalbersih` decimal(18,0) ,
 `ppnpersen` int ,
 `totalppn` decimal(18,0) ,
 `biayapengiriman` decimal(18,0) ,
 `totalinvoice` decimal(18,0) ,
 `idpengguna` char(10) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `carabayar` enum('Tunai','Transfer','Piutang','Giro') ,
 `idbank` char(5) ,
 `idjenispiutang` char(3) ,
 `idsales` char(10) ,
 `nokwitansi` char(18) ,
 `nobilyetgiro` varchar(25) ,
 `namakonsumen` varchar(50) ,
 `idwilayah` char(3) ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) ,
 `atasnama` varchar(100) ,
 `namasales` varchar(50) ,
 `namajenispiutang` varchar(50) ,
 `jatuhtempo` int ,
 `namapengguna` varchar(50) ,
 `namawilayah` varchar(50) ,
 `tgljatuhtempo` date 
)*/;

/*Table structure for table `v_piutang` */

DROP TABLE IF EXISTS `v_piutang`;

/*!50001 DROP VIEW IF EXISTS `v_piutang` */;
/*!50001 DROP TABLE IF EXISTS `v_piutang` */;

/*!50001 CREATE TABLE  `v_piutang`(
 `idpiutang` char(12) ,
 `idpenjualan` char(15) ,
 `idjenispiutang` char(3) ,
 `tglpiutang` date ,
 `tgljatuhtempo` date ,
 `idkonsumen` char(6) ,
 `totaldebet` decimal(10,0) ,
 `totalkredit` decimal(10,0) ,
 `jenissumber` enum('Penjualan','Saldo') ,
 `keterangan` varchar(255) ,
 `tgllunas` date ,
 `namakonsumen` varchar(50) ,
 `namajenispiutang` varchar(50) ,
 `jatuhtempo` int ,
 `tglinvoice` date ,
 `noinvoice` char(15) ,
 `idsales` char(10) ,
 `namasales` varchar(50) ,
 `namawilayah` varchar(50) 
)*/;

/*Table structure for table `v_piutang_belum_ada_penagihan` */

DROP TABLE IF EXISTS `v_piutang_belum_ada_penagihan`;

/*!50001 DROP VIEW IF EXISTS `v_piutang_belum_ada_penagihan` */;
/*!50001 DROP TABLE IF EXISTS `v_piutang_belum_ada_penagihan` */;

/*!50001 CREATE TABLE  `v_piutang_belum_ada_penagihan`(
 `idpiutang` char(12) ,
 `idpenjualan` char(15) ,
 `idjenispiutang` char(3) ,
 `tglpiutang` date ,
 `tgljatuhtempo` date ,
 `idkonsumen` char(6) ,
 `totaldebet` decimal(10,0) ,
 `totalkredit` decimal(10,0) ,
 `jenissumber` enum('Penjualan','Saldo') ,
 `keterangan` varchar(255) ,
 `namakonsumen` varchar(50) ,
 `namajenispiutang` varchar(50) ,
 `jatuhtempo` int ,
 `tglinvoice` date ,
 `noinvoice` char(15) ,
 `idsales` char(10) ,
 `namasales` varchar(50) ,
 `idpenagihan` char(15) ,
 `idwilayah` char(3) ,
 `namawilayah` varchar(50) 
)*/;

/*Table structure for table `v_piutang_laprekap` */

DROP TABLE IF EXISTS `v_piutang_laprekap`;

/*!50001 DROP VIEW IF EXISTS `v_piutang_laprekap` */;
/*!50001 DROP TABLE IF EXISTS `v_piutang_laprekap` */;

/*!50001 CREATE TABLE  `v_piutang_laprekap`(
 `idpiutang` char(12) ,
 `tglpiutang` date ,
 `idpenjualan` char(15) ,
 `noinvoice` char(15) ,
 `tglinvoice` date ,
 `idkonsumen` char(6) ,
 `namakonsumen` varchar(50) ,
 `jatuhtempo` int ,
 `tgljatuhtempo` date ,
 `jumlahpiutang` decimal(10,0) ,
 `jumlahdibayar` decimal(40,0) ,
 `idwilayah` char(3) ,
 `namawilayah` varchar(50) ,
 `idsales` char(10) ,
 `namasales` varchar(50) 
)*/;

/*Table structure for table `v_piutang_penagihan_laporan` */

DROP TABLE IF EXISTS `v_piutang_penagihan_laporan`;

/*!50001 DROP VIEW IF EXISTS `v_piutang_penagihan_laporan` */;
/*!50001 DROP TABLE IF EXISTS `v_piutang_penagihan_laporan` */;

/*!50001 CREATE TABLE  `v_piutang_penagihan_laporan`(
 `idpiutang` char(12) ,
 `idpenjualan` char(15) ,
 `idjenispiutang` char(3) ,
 `tgljatuhtempo` date ,
 `idkonsumen` char(6) ,
 `tgllunas` date ,
 `namakonsumen` varchar(50) ,
 `namajenispiutang` varchar(50) ,
 `tglinvoice` date ,
 `noinvoice` char(15) ,
 `totalinvoice` decimal(18,0) ,
 `idsales` char(10) ,
 `namasales` varchar(50) ,
 `namawilayah` varchar(50) ,
 `jumlahlancar` decimal(40,0) ,
 `jumlahlebih90hari` decimal(40,0) ,
 `jumlahlebih150hari` decimal(40,0) ,
 `sisaumur` int 
)*/;

/*Table structure for table `v_piutangdetail` */

DROP TABLE IF EXISTS `v_piutangdetail`;

/*!50001 DROP VIEW IF EXISTS `v_piutangdetail` */;
/*!50001 DROP TABLE IF EXISTS `v_piutangdetail` */;

/*!50001 CREATE TABLE  `v_piutangdetail`(
 `idpiutangdetail` char(15) ,
 `idpiutang` char(12) ,
 `tglpiutang` date ,
 `debet` decimal(18,0) ,
 `kredit` decimal(18,0) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `carabayar` enum('Tunai','Transfer','Giro') ,
 `idbank` char(5) ,
 `jenis` enum('Piutang','Pembayaran Piutang') ,
 `idpenjualan` char(15) ,
 `idjenispiutang` char(3) ,
 `namapengguna` varchar(50) ,
 `namabank` varchar(50) ,
 `nokwitansi` char(18) ,
 `nobilyetgiro` varchar(25) 
)*/;

/*Table structure for table `v_piutangdetail_bahanjurnal` */

DROP TABLE IF EXISTS `v_piutangdetail_bahanjurnal`;

/*!50001 DROP VIEW IF EXISTS `v_piutangdetail_bahanjurnal` */;
/*!50001 DROP TABLE IF EXISTS `v_piutangdetail_bahanjurnal` */;

/*!50001 CREATE TABLE  `v_piutangdetail_bahanjurnal`(
 `idpiutangdetail` char(15) ,
 `tglpiutang` date ,
 `kredit` decimal(18,0) ,
 `carabayar` enum('Tunai','Transfer','Giro') ,
 `idbank` char(5) ,
 `kdakunbank` char(9) ,
 `totaldebet` decimal(10,0) ,
 `noinvoice` char(15) ,
 `tglinvoice` date 
)*/;

/*Table structure for table `v_piutangdetail_laporan` */

DROP TABLE IF EXISTS `v_piutangdetail_laporan`;

/*!50001 DROP VIEW IF EXISTS `v_piutangdetail_laporan` */;
/*!50001 DROP TABLE IF EXISTS `v_piutangdetail_laporan` */;

/*!50001 CREATE TABLE  `v_piutangdetail_laporan`(
 `idpiutangdetail` char(15) ,
 `idpiutang` char(12) ,
 `tglpiutang` date ,
 `debet` decimal(18,0) ,
 `kredit` decimal(18,0) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `carabayar` enum('Tunai','Transfer','Giro') ,
 `idbank` char(5) ,
 `jenis` enum('Piutang','Pembayaran Piutang') ,
 `idpenjualan` char(15) ,
 `idjenispiutang` char(3) ,
 `namapengguna` varchar(50) ,
 `namabank` varchar(50) ,
 `nokwitansi` char(18) ,
 `noinvoice` char(15) ,
 `tglinvoice` date ,
 `idkonsumen` char(6) ,
 `totaldebet` decimal(10,0) ,
 `totalkredit` decimal(10,0) ,
 `idsales` char(10) ,
 `namasales` varchar(50) ,
 `namakonsumen` varchar(50) ,
 `idwilayah` char(3) ,
 `namawilayah` varchar(50) 
)*/;

/*Table structure for table `v_postingjurnal` */

DROP TABLE IF EXISTS `v_postingjurnal`;

/*!50001 DROP VIEW IF EXISTS `v_postingjurnal` */;
/*!50001 DROP TABLE IF EXISTS `v_postingjurnal` */;

/*!50001 CREATE TABLE  `v_postingjurnal`(
 `idposting` char(6) ,
 `bulan` char(2) ,
 `tahun` char(4) ,
 `jumlahdebet` decimal(18,0) ,
 `jumlahkredit` decimal(18,0) ,
 `inserted_date` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_returpembelian` */

DROP TABLE IF EXISTS `v_returpembelian`;

/*!50001 DROP VIEW IF EXISTS `v_returpembelian` */;
/*!50001 DROP TABLE IF EXISTS `v_returpembelian` */;

/*!50001 CREATE TABLE  `v_returpembelian`(
 `idreturpembelian` char(15) ,
 `idpembelian` char(15) ,
 `tglretur` date ,
 `totalretur` decimal(18,0) ,
 `keterangan` varchar(255) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `carabayar` enum('Tunai','Transfer') ,
 `idbank` char(5) ,
 `statusretur` enum('Proses','Selesai') ,
 `tglpengajuan` date ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) ,
 `kdakunbank` char(9) ,
 `namapengguna` varchar(50) ,
 `idsupplier` char(10) ,
 `namasupplier` varchar(50) ,
 `tglfaktur` date ,
 `nofaktur` varchar(30) 
)*/;

/*Table structure for table `v_returpembeliandetail` */

DROP TABLE IF EXISTS `v_returpembeliandetail`;

/*!50001 DROP VIEW IF EXISTS `v_returpembeliandetail` */;
/*!50001 DROP TABLE IF EXISTS `v_returpembeliandetail` */;

/*!50001 CREATE TABLE  `v_returpembeliandetail`(
 `idreturdetail` int ,
 `idreturpembelian` char(15) ,
 `idbarang` char(10) ,
 `jumlahretur` int ,
 `hargaretur` decimal(18,0) ,
 `subtotalretur` decimal(18,0) ,
 `idpembelian` char(15) ,
 `tglretur` date ,
 `namabarang` varchar(100) ,
 `idkategori` char(4) ,
 `namakategori` varchar(50) 
)*/;

/*Table structure for table `v_returpembeliandetail_bahanjurnal` */

DROP TABLE IF EXISTS `v_returpembeliandetail_bahanjurnal`;

/*!50001 DROP VIEW IF EXISTS `v_returpembeliandetail_bahanjurnal` */;
/*!50001 DROP TABLE IF EXISTS `v_returpembeliandetail_bahanjurnal` */;

/*!50001 CREATE TABLE  `v_returpembeliandetail_bahanjurnal`(
 `idreturpembelian` char(15) ,
 `tglretur` date ,
 `totalretur` decimal(18,0) ,
 `kdakunbarang` char(9) ,
 `subtotalretur` decimal(40,0) ,
 `keterangan` varchar(255) ,
 `nofaktur` varchar(30) ,
 `tglfaktur` date ,
 `carabayar` enum('Tunai','Transfer') ,
 `kdakunbank` char(9) 
)*/;

/*Table structure for table `v_returpembeliandetail_laporan` */

DROP TABLE IF EXISTS `v_returpembeliandetail_laporan`;

/*!50001 DROP VIEW IF EXISTS `v_returpembeliandetail_laporan` */;
/*!50001 DROP TABLE IF EXISTS `v_returpembeliandetail_laporan` */;

/*!50001 CREATE TABLE  `v_returpembeliandetail_laporan`(
 `idreturpembelian` char(15) ,
 `tglretur` date ,
 `totalretur` decimal(18,0) ,
 `keterangan` varchar(255) ,
 `carabayar` enum('Tunai','Transfer') ,
 `idbank` char(5) ,
 `statusretur` enum('Proses','Selesai') ,
 `tglpengajuan` date ,
 `namabank` varchar(50) ,
 `idpembelian` char(15) ,
 `nofaktur` varchar(30) ,
 `tglfaktur` date ,
 `idsupplier` char(10) ,
 `namasupplier` varchar(50) ,
 `idreturdetail` int ,
 `idbarang` char(10) ,
 `namabarang` varchar(100) ,
 `kdakunbarang` char(9) ,
 `jumlahretur` int ,
 `hargaretur` decimal(18,0) ,
 `subtotalretur` decimal(18,0) 
)*/;

/*Table structure for table `v_returpenjualan` */

DROP TABLE IF EXISTS `v_returpenjualan`;

/*!50001 DROP VIEW IF EXISTS `v_returpenjualan` */;
/*!50001 DROP TABLE IF EXISTS `v_returpenjualan` */;

/*!50001 CREATE TABLE  `v_returpenjualan`(
 `idreturpenjualan` char(15) ,
 `idpenjualan` char(15) ,
 `tglretur` date ,
 `totalretur` decimal(18,0) ,
 `keterangan` varchar(255) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `carabayar` enum('Tunai','Transfer') ,
 `idbank` char(5) ,
 `idkonsumen` char(6) ,
 `tglinvoice` date ,
 `noinvoice` char(15) ,
 `namakonsumen` varchar(50) ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_returpenjualandetail` */

DROP TABLE IF EXISTS `v_returpenjualandetail`;

/*!50001 DROP VIEW IF EXISTS `v_returpenjualandetail` */;
/*!50001 DROP TABLE IF EXISTS `v_returpenjualandetail` */;

/*!50001 CREATE TABLE  `v_returpenjualandetail`(
 `idreturdetail` int ,
 `idreturpenjualan` char(15) ,
 `idbarang` char(10) ,
 `jumlahretur` int ,
 `hargaretur` decimal(18,0) ,
 `subtotalretur` decimal(18,0) ,
 `idpenjualan` char(15) ,
 `tglretur` date ,
 `namabarang` varchar(100) ,
 `idkategori` char(4) ,
 `kdakun` char(9) ,
 `namakategori` varchar(50) 
)*/;

/*Table structure for table `v_returpenjualandetail_bahanjurnal` */

DROP TABLE IF EXISTS `v_returpenjualandetail_bahanjurnal`;

/*!50001 DROP VIEW IF EXISTS `v_returpenjualandetail_bahanjurnal` */;
/*!50001 DROP TABLE IF EXISTS `v_returpenjualandetail_bahanjurnal` */;

/*!50001 CREATE TABLE  `v_returpenjualandetail_bahanjurnal`(
 `idreturpenjualan` char(15) ,
 `tglretur` date ,
 `kdakunbarang` char(9) ,
 `subtotalretur` decimal(40,0) ,
 `carabayar` enum('Tunai','Transfer') ,
 `kdakunbank` char(9) ,
 `noinvoice` char(15) ,
 `tglinvoice` date ,
 `totalretur` decimal(18,0) 
)*/;

/*Table structure for table `v_returpenjualandetail_laporan` */

DROP TABLE IF EXISTS `v_returpenjualandetail_laporan`;

/*!50001 DROP VIEW IF EXISTS `v_returpenjualandetail_laporan` */;
/*!50001 DROP TABLE IF EXISTS `v_returpenjualandetail_laporan` */;

/*!50001 CREATE TABLE  `v_returpenjualandetail_laporan`(
 `idreturdetail` int ,
 `idreturpenjualan` char(15) ,
 `idbarang` char(10) ,
 `jumlahretur` int ,
 `hargaretur` decimal(18,0) ,
 `subtotalretur` decimal(18,0) ,
 `namabarang` varchar(100) ,
 `idkategori` char(4) ,
 `kdakunbarang` char(9) ,
 `idpenjualan` char(15) ,
 `tglretur` date ,
 `totalretur` decimal(18,0) ,
 `keterangan` varchar(255) ,
 `carabayar` enum('Tunai','Transfer') ,
 `idbank` char(5) ,
 `namabank` varchar(50) ,
 `cabang` varchar(50) ,
 `norekening` varchar(25) ,
 `atasnama` varchar(100) ,
 `noinvoice` char(15) ,
 `tglinvoice` date ,
 `totalinvoice` decimal(18,0) ,
 `idsales` char(10) ,
 `namasales` varchar(50) ,
 `namakonsumen` varchar(50) ,
 `alamatkonsumen` varchar(255) ,
 `idwilayah` char(3) ,
 `namawilayah` varchar(50) 
)*/;

/*Table structure for table `v_saldoawal` */

DROP TABLE IF EXISTS `v_saldoawal`;

/*!50001 DROP VIEW IF EXISTS `v_saldoawal` */;
/*!50001 DROP TABLE IF EXISTS `v_saldoawal` */;

/*!50001 CREATE TABLE  `v_saldoawal`(
 `idsaldoawal` char(4) ,
 `tahun` char(4) ,
 `totaldebet` decimal(18,0) ,
 `totalkredit` decimal(18,0) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_saldoawaldetail` */

DROP TABLE IF EXISTS `v_saldoawaldetail`;

/*!50001 DROP VIEW IF EXISTS `v_saldoawaldetail` */;
/*!50001 DROP TABLE IF EXISTS `v_saldoawaldetail` */;

/*!50001 CREATE TABLE  `v_saldoawaldetail`(
 `idsaldoawal` char(4) ,
 `kdakun` char(9) ,
 `debet` decimal(18,0) ,
 `kredit` decimal(18,0) ,
 `namaakun` varchar(100) ,
 `kdparent` char(7) ,
 `tahun` char(4) 
)*/;

/*Table structure for table `v_saleswilayah` */

DROP TABLE IF EXISTS `v_saleswilayah`;

/*!50001 DROP VIEW IF EXISTS `v_saleswilayah` */;
/*!50001 DROP TABLE IF EXISTS `v_saleswilayah` */;

/*!50001 CREATE TABLE  `v_saleswilayah`(
 `idsaleswilayah` int ,
 `idsales` char(10) ,
 `namasales` varchar(50) ,
 `idwilayah` char(3) ,
 `namawilayah` varchar(50) 
)*/;

/*Table structure for table `v_stockopname` */

DROP TABLE IF EXISTS `v_stockopname`;

/*!50001 DROP VIEW IF EXISTS `v_stockopname` */;
/*!50001 DROP TABLE IF EXISTS `v_stockopname` */;

/*!50001 CREATE TABLE  `v_stockopname`(
 `idstockopname` char(15) ,
 `tglstockopname` datetime ,
 `keterangan` varchar(255) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) 
)*/;

/*Table structure for table `v_stockopnamedetail` */

DROP TABLE IF EXISTS `v_stockopnamedetail`;

/*!50001 DROP VIEW IF EXISTS `v_stockopnamedetail` */;
/*!50001 DROP TABLE IF EXISTS `v_stockopnamedetail` */;

/*!50001 CREATE TABLE  `v_stockopnamedetail`(
 `idstockopnamedetail` int ,
 `idstockopname` char(15) ,
 `idbarang` char(10) ,
 `stocksystem` int ,
 `stockopname` int ,
 `keterangandetail` varchar(255) ,
 `tglstockopname` datetime ,
 `namabarang` varchar(100) ,
 `idkategori` char(4) ,
 `namakategori` varchar(50) 
)*/;

/*Table structure for table `v_supplier` */

DROP TABLE IF EXISTS `v_supplier`;

/*!50001 DROP VIEW IF EXISTS `v_supplier` */;
/*!50001 DROP TABLE IF EXISTS `v_supplier` */;

/*!50001 CREATE TABLE  `v_supplier`(
 `idsupplier` char(10) ,
 `namasupplier` varchar(50) ,
 `alamatsupplier` varchar(255) ,
 `kontakperson` varchar(50) ,
 `notelp` char(20) ,
 `email` varchar(50) ,
 `saldo` decimal(18,0) ,
 `saldopajak` decimal(18,0) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `statusaktif` enum('Aktif','Tidak Aktif') ,
 `npwp` char(20) ,
 `kdakunutang` char(9) ,
 `namaakunutang` varchar(100) 
)*/;

/*Table structure for table `v_suratjalan` */

DROP TABLE IF EXISTS `v_suratjalan`;

/*!50001 DROP VIEW IF EXISTS `v_suratjalan` */;
/*!50001 DROP TABLE IF EXISTS `v_suratjalan` */;

/*!50001 CREATE TABLE  `v_suratjalan`(
 `idsuratjalan` char(10) ,
 `tglsuratjalan` date ,
 `idkonsumen` char(6) ,
 `tglcetak` datetime ,
 `keterangan` varchar(255) ,
 `inserted_date` datetime ,
 `updated_date` datetime ,
 `idpengguna` char(10) ,
 `namapengguna` varchar(50) ,
 `totaltagihan` decimal(10,0) ,
 `idekspedisi` char(10) ,
 `idjenisekspedisi` char(3) ,
 `identitasekspedisi` varchar(255) ,
 `biayapengiriman` decimal(18,0) ,
 `rincianinputmanual` tinyint ,
 `namaekspedisi` varchar(50) ,
 `namajenisekspedisi` varchar(50) ,
 `namakonsumen` varchar(50) ,
 `alamatkonsumen` varchar(255) ,
 `notelpkonsumen` char(20) ,
 `emailkonsumen` varchar(50) ,
 `nikpemilik` char(16) ,
 `namapemilik` varchar(50) ,
 `notelppemilik` char(20) ,
 `nowapemilik` char(20) ,
 `npwp` char(20) ,
 `namawilayah` varchar(50) 
)*/;

/*Table structure for table `v_suratjalan_detail_barang` */

DROP TABLE IF EXISTS `v_suratjalan_detail_barang`;

/*!50001 DROP VIEW IF EXISTS `v_suratjalan_detail_barang` */;
/*!50001 DROP TABLE IF EXISTS `v_suratjalan_detail_barang` */;

/*!50001 CREATE TABLE  `v_suratjalan_detail_barang`(
 `idsuratjalan` char(10) ,
 `tglsuratjalan` date ,
 `idpenjualan` char(15) ,
 `idbarang` char(10) ,
 `namabarang` varchar(100) ,
 `jumlahjual` int ,
 `hargasatuan` decimal(18,0) ,
 `hargadpp` decimal(18,0) ,
 `jumlahppn` decimal(18,0) ,
 `jumlahdiskon` decimal(18,0) ,
 `subtotaljual` decimal(18,0) 
)*/;

/*Table structure for table `v_suratjalan_groupconcat` */

DROP TABLE IF EXISTS `v_suratjalan_groupconcat`;

/*!50001 DROP VIEW IF EXISTS `v_suratjalan_groupconcat` */;
/*!50001 DROP TABLE IF EXISTS `v_suratjalan_groupconcat` */;

/*!50001 CREATE TABLE  `v_suratjalan_groupconcat`(
 `idsuratjalan` char(10) ,
 `tglsuratjalan` date ,
 `idkonsumen` char(6) ,
 `namakonsumen` varchar(50) ,
 `idjenisekspedisi` char(3) ,
 `namajenisekspedisi` varchar(50) ,
 `idekspedisi` char(10) ,
 `namaekspedisi` varchar(50) ,
 `identitasekspedisi` varchar(255) ,
 `biayapengiriman` decimal(18,0) ,
 `rincianinputmanual` tinyint ,
 `daftarnoinvoice` text 
)*/;

/*Table structure for table `v_suratjalan_sudah_ada_penagihan` */

DROP TABLE IF EXISTS `v_suratjalan_sudah_ada_penagihan`;

/*!50001 DROP VIEW IF EXISTS `v_suratjalan_sudah_ada_penagihan` */;
/*!50001 DROP TABLE IF EXISTS `v_suratjalan_sudah_ada_penagihan` */;

/*!50001 CREATE TABLE  `v_suratjalan_sudah_ada_penagihan`(
 `iddetailsuratjalan` int ,
 `idsuratjalan` char(10) ,
 `idpenjualan` char(15) ,
 `idpiutang` char(12) ,
 `jumlahtagihan` decimal(18,0) 
)*/;

/*Table structure for table `v_suratjalandetail` */

DROP TABLE IF EXISTS `v_suratjalandetail`;

/*!50001 DROP VIEW IF EXISTS `v_suratjalandetail` */;
/*!50001 DROP TABLE IF EXISTS `v_suratjalandetail` */;

/*!50001 CREATE TABLE  `v_suratjalandetail`(
 `iddetailsuratjalan` int ,
 `idsuratjalan` char(10) ,
 `idpenjualan` char(15) ,
 `tglsuratjalan` date ,
 `noinvoice` char(15) ,
 `tglinvoice` date ,
 `totalinvoice` decimal(18,0) ,
 `idkonsumen` char(6) ,
 `namakonsumen` varchar(50) ,
 `alamatkonsumen` varchar(255) ,
 `notelpkonsumen` char(20) ,
 `namapemilik` varchar(50) ,
 `notelppemilik` char(20) ,
 `idwilayah` char(3) ,
 `namawilayah` varchar(50) ,
 `idsales` char(10) ,
 `namasales` varchar(50) ,
 `npwp` char(20) 
)*/;

/*View structure for view v_akun1 */

/*!50001 DROP TABLE IF EXISTS `v_akun1` */;
/*!50001 DROP VIEW IF EXISTS `v_akun1` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_akun1` AS select `akun`.`kdakun` AS `kdakun`,`akun`.`namaakun` AS `namaakun`,`akun`.`kdparent` AS `kdparent`,`akun`.`levels` AS `levels`,`akun`.`statusaktif` AS `statusaktif`,`akun`.`inserted_date` AS `inserted_date`,`akun`.`updated_date` AS `updated_date` from `akun` where (`akun`.`levels` = '1') */;

/*View structure for view v_akun2 */

/*!50001 DROP TABLE IF EXISTS `v_akun2` */;
/*!50001 DROP VIEW IF EXISTS `v_akun2` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_akun2` AS select `akun`.`kdakun` AS `kdakun`,`akun`.`namaakun` AS `namaakun`,`akun`.`kdparent` AS `kdparent`,`akun`.`levels` AS `levels`,`akun`.`statusaktif` AS `statusaktif`,`akun`.`inserted_date` AS `inserted_date`,`akun`.`updated_date` AS `updated_date`,`akun_1`.`namaakun` AS `namaparent` from (`akun` join `akun` `akun_1` on((`akun`.`kdparent` = `akun_1`.`kdakun`))) where (`akun`.`levels` = '2') */;

/*View structure for view v_akun3 */

/*!50001 DROP TABLE IF EXISTS `v_akun3` */;
/*!50001 DROP VIEW IF EXISTS `v_akun3` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_akun3` AS select `akun`.`kdakun` AS `kdakun`,`akun`.`namaakun` AS `namaakun`,`akun`.`kdparent` AS `kdparent`,`akun`.`levels` AS `levels`,`akun`.`statusaktif` AS `statusaktif`,`akun`.`inserted_date` AS `inserted_date`,`akun`.`updated_date` AS `updated_date`,`akun_1`.`namaakun` AS `namaparent` from (`akun` join `akun` `akun_1` on((`akun`.`kdparent` = `akun_1`.`kdakun`))) where (`akun`.`levels` = '3') */;

/*View structure for view v_akun4 */

/*!50001 DROP TABLE IF EXISTS `v_akun4` */;
/*!50001 DROP VIEW IF EXISTS `v_akun4` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_akun4` AS select `akun`.`kdakun` AS `kdakun`,`akun`.`namaakun` AS `namaakun`,`akun`.`kdparent` AS `kdparent`,`akun`.`levels` AS `levels`,`akun`.`statusaktif` AS `statusaktif`,`akun`.`inserted_date` AS `inserted_date`,`akun`.`updated_date` AS `updated_date`,`akun_1`.`namaakun` AS `namaparent` from (`akun` join `akun` `akun_1` on((`akun`.`kdparent` = `akun_1`.`kdakun`))) where (`akun`.`levels` = '4') */;

/*View structure for view v_bank */

/*!50001 DROP TABLE IF EXISTS `v_bank` */;
/*!50001 DROP VIEW IF EXISTS `v_bank` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bank` AS select `bank`.`idbank` AS `idbank`,`bank`.`namabank` AS `namabank`,`bank`.`cabang` AS `cabang`,`bank`.`norekening` AS `norekening`,`bank`.`kdakun` AS `kdakun`,`bank`.`inserted_date` AS `inserted_date`,`bank`.`updated_date` AS `updated_date`,`bank`.`statusaktif` AS `statusaktif`,`akun`.`namaakun` AS `namaakun`,`akun`.`kdparent` AS `kdparent`,`bank`.`atasnama` AS `atasnama` from (`bank` join `akun` on((`bank`.`kdakun` = `akun`.`kdakun`))) */;

/*View structure for view v_barang */

/*!50001 DROP TABLE IF EXISTS `v_barang` */;
/*!50001 DROP VIEW IF EXISTS `v_barang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_barang` AS select `barang`.`idbarang` AS `idbarang`,`barang`.`kdbarang` AS `kdbarang`,`barang`.`namabarang` AS `namabarang`,`barang`.`idkategori` AS `idkategori`,`barang`.`kdakun` AS `kdakun`,`barang`.`stok` AS `stok`,`barang`.`fotobarang` AS `fotobarang`,`barang`.`hargabeli` AS `hargabeli`,`barang`.`hargajualasli` AS `hargajualasli`,`barang`.`hargajualdiskon` AS `hargajualdiskon`,`barang`.`statusaktif` AS `statusaktif`,`barang`.`inserted_date` AS `inserted_date`,`barang`.`updated_date` AS `updated_date`,`barang`.`jenisbonuspenjualan` AS `jenisbonuspenjualan`,`barang`.`persenbonuspenjualan` AS `persenbonuspenjualan`,`barang`.`jumlahbonuspenjualan` AS `jumlahbonuspenjualan`,`barang`.`jenisbonustagihan` AS `jenisbonustagihan`,`barang`.`persenbonustagihan` AS `persenbonustagihan`,`barang`.`jumlahbonustagihan` AS `jumlahbonustagihan`,`barang`.`stokminimum` AS `stokminimum`,`kategoribarang`.`namakategori` AS `namakategori`,`akun`.`namaakun` AS `namaakun`,`barang`.`idjenisbarang` AS `idjenisbarang`,`jenisbarang`.`jenisbarang` AS `jenisbarang` from (((`barang` join `kategoribarang` on((`barang`.`idkategori` = `kategoribarang`.`idkategori`))) left join `akun` on((`barang`.`kdakun` = `akun`.`kdakun`))) left join `jenisbarang` on((`barang`.`idjenisbarang` = `jenisbarang`.`idjenisbarang`))) */;

/*View structure for view v_bonus */

/*!50001 DROP TABLE IF EXISTS `v_bonus` */;
/*!50001 DROP VIEW IF EXISTS `v_bonus` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bonus` AS select `bonus`.`idbonus` AS `idbonus`,`bonus`.`tglbonus` AS `tglbonus`,`bonus`.`idsales` AS `idsales`,`bonus`.`keterangan` AS `keterangan`,`bonus`.`totalpenjualan` AS `totalpenjualan`,`bonus`.`totalpenagihan` AS `totalpenagihan`,`bonus`.`totalbonuspenjualan` AS `totalbonuspenjualan`,`bonus`.`totalbonuspenagihan` AS `totalbonuspenagihan`,`bonus`.`targetpenjualan` AS `targetpenjualan`,`bonus`.`pencapaiantarget` AS `pencapaiantarget`,`bonus`.`totalbonustarget` AS `totalbonustarget`,`bonus`.`inserted_date` AS `inserted_date`,`bonus`.`updated_date` AS `updated_date`,`bonus`.`idpengguna` AS `idpengguna`,`sales`.`namasales` AS `namasales`,`sales`.`npwp` AS `npwpsales` from (`bonus` join `sales` on((`bonus`.`idsales` = `sales`.`idsales`))) */;

/*View structure for view v_dasar_bonus_penjualan */

/*!50001 DROP TABLE IF EXISTS `v_dasar_bonus_penjualan` */;
/*!50001 DROP VIEW IF EXISTS `v_dasar_bonus_penjualan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dasar_bonus_penjualan` AS select `penjualandetail`.`id` AS `id`,`penjualandetail`.`idpenjualan` AS `idpenjualan`,`penjualandetail`.`idbarang` AS `idbarang`,`penjualandetail`.`jumlahjual` AS `jumlahjual`,`penjualandetail`.`hargasatuan` AS `hargasatuan`,`penjualandetail`.`hargadpp` AS `hargadpp`,`penjualandetail`.`jumlahppn` AS `jumlahppn`,`penjualandetail`.`jumlahdiskon` AS `jumlahdiskon`,`penjualandetail`.`subtotaljual` AS `subtotaljual`,`penjualandetail`.`jenisdiskon` AS `jenisdiskon`,`penjualandetail`.`diskonpersen1` AS `diskonpersen1`,`penjualandetail`.`diskonpersen2` AS `diskonpersen2`,`penjualandetail`.`diskonpersen3` AS `diskonpersen3`,`suratjalandetail`.`idsuratjalan` AS `idsuratjalan`,`suratjalandetail`.`iddetailsuratjalan` AS `iddetailsuratjalan`,`bonuspenjualan`.`idbonus` AS `idbonus`,`barang`.`namabarang` AS `namabarang`,`barang`.`jenisbonuspenjualan` AS `jenisbonuspenjualan`,`barang`.`persenbonuspenjualan` AS `persenbonuspenjualan`,`barang`.`jumlahbonuspenjualan` AS `jumlahbonuspenjualan`,`barang`.`jenisbonustagihan` AS `jenisbonustagihan`,`barang`.`persenbonustagihan` AS `persenbonustagihan`,`barang`.`jumlahbonustagihan` AS `jumlahbonustagihan`,`penjualan`.`idsales` AS `idsales`,`sales`.`namasales` AS `namasales`,`sales`.`npwp` AS `npwpsales`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`tglinvoice` AS `tglinvoice` from (((((`penjualandetail` join `suratjalandetail` on((`penjualandetail`.`idpenjualan` = `suratjalandetail`.`idpenjualan`))) left join `bonuspenjualan` on((`penjualandetail`.`idpenjualan` = `bonuspenjualan`.`idpenjualan`))) join `barang` on((`penjualandetail`.`idbarang` = `barang`.`idbarang`))) join `penjualan` on((`penjualandetail`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `sales` on((`penjualan`.`idsales` = `sales`.`idsales`))) */;

/*View structure for view v_dasar_bonus_target */

/*!50001 DROP TABLE IF EXISTS `v_dasar_bonus_target` */;
/*!50001 DROP VIEW IF EXISTS `v_dasar_bonus_target` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dasar_bonus_target` AS select `penjualandetail`.`id` AS `id`,`penjualandetail`.`idpenjualan` AS `idpenjualan`,`penjualandetail`.`idbarang` AS `idbarang`,`penjualandetail`.`jumlahjual` AS `jumlahjual`,`penjualandetail`.`hargasatuan` AS `hargasatuan`,`penjualandetail`.`hargadpp` AS `hargadpp`,`penjualandetail`.`jumlahppn` AS `jumlahppn`,`penjualandetail`.`jumlahdiskon` AS `jumlahdiskon`,`penjualandetail`.`subtotaljual` AS `subtotaljual`,`penjualandetail`.`jenisdiskon` AS `jenisdiskon`,`penjualandetail`.`diskonpersen1` AS `diskonpersen1`,`penjualandetail`.`diskonpersen2` AS `diskonpersen2`,`penjualandetail`.`diskonpersen3` AS `diskonpersen3`,`suratjalandetail`.`idsuratjalan` AS `idsuratjalan`,`suratjalandetail`.`iddetailsuratjalan` AS `iddetailsuratjalan`,`bonuspenjualan`.`idbonus` AS `idbonus`,`barang`.`namabarang` AS `namabarang`,`barang`.`jenisbonuspenjualan` AS `jenisbonuspenjualan`,`barang`.`persenbonuspenjualan` AS `persenbonuspenjualan`,`barang`.`jumlahbonuspenjualan` AS `jumlahbonuspenjualan`,`barang`.`jenisbonustagihan` AS `jenisbonustagihan`,`barang`.`persenbonustagihan` AS `persenbonustagihan`,`barang`.`jumlahbonustagihan` AS `jumlahbonustagihan`,`barang`.`idjenisbarang` AS `idjenisbarang`,`jenisbarang`.`jenisbarang` AS `jenisbarang`,`jenisbarang`.`persenbonustarget` AS `persenbonustarget`,`penjualan`.`idsales` AS `idsales`,`sales`.`namasales` AS `namasales`,`sales`.`npwp` AS `npwpsales`,`sales`.`targetpenjualan` AS `targetpenjualan`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`tglinvoice` AS `tglinvoice` from ((((((`penjualandetail` join `suratjalandetail` on((`penjualandetail`.`idpenjualan` = `suratjalandetail`.`idpenjualan`))) left join `bonuspenjualan` on((`penjualandetail`.`idpenjualan` = `bonuspenjualan`.`idpenjualan`))) join `barang` on((`penjualandetail`.`idbarang` = `barang`.`idbarang`))) join `penjualan` on((`penjualandetail`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `sales` on((`penjualan`.`idsales` = `sales`.`idsales`))) join `jenisbarang` on((`barang`.`idjenisbarang` = `jenisbarang`.`idjenisbarang`))) */;

/*View structure for view v_ekspedisi */

/*!50001 DROP TABLE IF EXISTS `v_ekspedisi` */;
/*!50001 DROP VIEW IF EXISTS `v_ekspedisi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ekspedisi` AS select `ekspedisi`.`idekspedisi` AS `idekspedisi`,`ekspedisi`.`namaekspedisi` AS `namaekspedisi`,`ekspedisi`.`alamatekspedisi` AS `alamatekspedisi`,`ekspedisi`.`notelpekspedisi` AS `notelpekspedisi`,`ekspedisi`.`emailekspedisi` AS `emailekspedisi`,`ekspedisi`.`nikpemilik` AS `nikpemilik`,`ekspedisi`.`namapemilik` AS `namapemilik`,`ekspedisi`.`notelppemilik` AS `notelppemilik`,`ekspedisi`.`nowapemilik` AS `nowapemilik`,`ekspedisi`.`inserted_date` AS `inserted_date`,`ekspedisi`.`updated_date` AS `updated_date`,`ekspedisi`.`statusaktif` AS `statusaktif`,`ekspedisi`.`kdakunutang` AS `kdakunutang`,`akun`.`namaakun` AS `namaakunutang` from (`ekspedisi` left join `akun` on((`ekspedisi`.`kdakunutang` = `akun`.`kdakun`))) */;

/*View structure for view v_hutang */

/*!50001 DROP TABLE IF EXISTS `v_hutang` */;
/*!50001 DROP VIEW IF EXISTS `v_hutang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hutang` AS select `hutang`.`idhutang` AS `idhutang`,`hutang`.`idpembelian` AS `idpembelian`,`hutang`.`tglhutang` AS `tglhutang`,`hutang`.`idsupplier` AS `idsupplier`,`hutang`.`totaldebet` AS `totaldebet`,`hutang`.`totalkredit` AS `totalkredit`,`hutang`.`jenissumber` AS `jenissumber`,`hutang`.`keterangan` AS `keterangan`,`supplier`.`namasupplier` AS `namasupplier`,`pembelian`.`nofaktur` AS `nofaktur`,`pembelian`.`tglfaktur` AS `tglfaktur`,(case when (`hutang`.`totaldebet` < `hutang`.`totalkredit`) then 'Belum Lunas' else 'Lunas' end) AS `statuslunas` from ((`hutang` left join `pembelian` on((`hutang`.`idpembelian` = `pembelian`.`idpembelian`))) join `supplier` on((`hutang`.`idsupplier` = `supplier`.`idsupplier`))) */;

/*View structure for view v_hutang_laprekap */

/*!50001 DROP TABLE IF EXISTS `v_hutang_laprekap` */;
/*!50001 DROP VIEW IF EXISTS `v_hutang_laprekap` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hutang_laprekap` AS select `v_hutang`.`idhutang` AS `idhutang`,`v_hutang`.`idpembelian` AS `idpembelian`,`v_hutang`.`tglhutang` AS `tglhutang`,`v_hutang`.`idsupplier` AS `idsupplier`,`v_hutang`.`namasupplier` AS `namasupplier`,`v_hutang`.`totalkredit` AS `jumlahhutang`,sum(`hutangdetail`.`debet`) AS `jumlahdibayar`,`v_hutang`.`nofaktur` AS `nofaktur`,`v_hutang`.`tglfaktur` AS `tglfaktur` from (`v_hutang` join `hutangdetail` on((`v_hutang`.`idhutang` = `hutangdetail`.`idhutang`))) group by `v_hutang`.`idhutang`,`v_hutang`.`idpembelian`,`v_hutang`.`tglhutang`,`v_hutang`.`idsupplier`,`v_hutang`.`namasupplier`,`jumlahhutang`,`v_hutang`.`nofaktur`,`v_hutang`.`tglfaktur` */;

/*View structure for view v_hutangdetail */

/*!50001 DROP TABLE IF EXISTS `v_hutangdetail` */;
/*!50001 DROP VIEW IF EXISTS `v_hutangdetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hutangdetail` AS select `hutangdetail`.`idhutangdetail` AS `idhutangdetail`,`hutangdetail`.`idhutang` AS `idhutang`,`hutangdetail`.`tglhutang` AS `tglhutang`,`hutangdetail`.`debet` AS `debet`,`hutangdetail`.`kredit` AS `kredit`,`hutangdetail`.`inserted_date` AS `inserted_date`,`hutangdetail`.`updated_date` AS `updated_date`,`hutangdetail`.`idpengguna` AS `idpengguna`,`hutangdetail`.`carabayar` AS `carabayar`,`hutangdetail`.`idbank` AS `idbank`,`hutangdetail`.`jenis` AS `jenis`,`hutangdetail`.`nobilyetgiro` AS `nobilyetgiro`,`hutang`.`idpembelian` AS `idpembelian`,`hutang`.`idsupplier` AS `idsupplier`,`bank`.`namabank` AS `namabank`,`pengguna`.`namapengguna` AS `namapengguna` from (((`hutangdetail` join `hutang` on((`hutangdetail`.`idhutang` = `hutang`.`idhutang`))) join `pengguna` on((`hutangdetail`.`idpengguna` = `pengguna`.`idpengguna`))) left join `bank` on((`hutangdetail`.`idbank` = `bank`.`idbank`))) */;

/*View structure for view v_hutangdetail_bahanjurnal */

/*!50001 DROP TABLE IF EXISTS `v_hutangdetail_bahanjurnal` */;
/*!50001 DROP VIEW IF EXISTS `v_hutangdetail_bahanjurnal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hutangdetail_bahanjurnal` AS select `hutangdetail`.`idhutangdetail` AS `idhutangdetail`,`hutangdetail`.`tglhutang` AS `tglhutang`,`hutangdetail`.`debet` AS `debet`,`hutangdetail`.`carabayar` AS `carabayar`,`bank`.`kdakun` AS `kdakunbank`,`pembelian`.`nofaktur` AS `nofaktur`,`pembelian`.`tglfaktur` AS `tglfaktur`,`hutang`.`jenissumber` AS `jenissumber` from (((`hutangdetail` join `hutang` on((`hutangdetail`.`idhutang` = `hutang`.`idhutang`))) left join `bank` on((`hutangdetail`.`idbank` = `bank`.`idbank`))) join `pembelian` on((`hutang`.`idpembelian` = `pembelian`.`idpembelian`))) where ((`hutangdetail`.`debet` <> 0) and (`hutang`.`jenissumber` = 'Pembelian')) */;

/*View structure for view v_hutangdetail_bahanjurnal_nonpembelian */

/*!50001 DROP TABLE IF EXISTS `v_hutangdetail_bahanjurnal_nonpembelian` */;
/*!50001 DROP VIEW IF EXISTS `v_hutangdetail_bahanjurnal_nonpembelian` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hutangdetail_bahanjurnal_nonpembelian` AS select `hutangdetail`.`idhutangdetail` AS `idhutangdetail`,`hutangdetail`.`tglhutang` AS `tglhutang`,`hutangdetail`.`debet` AS `debet`,`hutangdetail`.`kredit` AS `kredit`,`hutangdetail`.`carabayar` AS `carabayar`,`bank`.`kdakun` AS `kdakunbank`,`hutang`.`jenissumber` AS `jenissumber`,`hutang`.`keterangan` AS `keterangan`,`hutang`.`idhutang` AS `idhutang` from ((`hutangdetail` join `hutang` on((`hutangdetail`.`idhutang` = `hutang`.`idhutang`))) left join `bank` on((`hutangdetail`.`idbank` = `bank`.`idbank`))) where (`hutang`.`jenissumber` = 'Non Pembelian') */;

/*View structure for view v_hutangdetail_laporan */

/*!50001 DROP TABLE IF EXISTS `v_hutangdetail_laporan` */;
/*!50001 DROP VIEW IF EXISTS `v_hutangdetail_laporan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hutangdetail_laporan` AS select `hutangdetail`.`idhutangdetail` AS `idhutangdetail`,`hutangdetail`.`idhutang` AS `idhutang`,`hutangdetail`.`tglhutang` AS `tglhutang`,`hutangdetail`.`debet` AS `debet`,`hutangdetail`.`kredit` AS `kredit`,`hutangdetail`.`inserted_date` AS `inserted_date`,`hutangdetail`.`updated_date` AS `updated_date`,`hutangdetail`.`idpengguna` AS `idpengguna`,`hutangdetail`.`carabayar` AS `carabayar`,`hutangdetail`.`idbank` AS `idbank`,`hutangdetail`.`jenis` AS `jenis`,`hutang`.`idpembelian` AS `idpembelian`,`hutang`.`idsupplier` AS `idsupplier`,`bank`.`namabank` AS `namabank`,`pengguna`.`namapengguna` AS `namapengguna`,`hutang`.`totaldebet` AS `totaldebet`,`hutang`.`totalkredit` AS `totalkredit`,`pembelian`.`nofaktur` AS `nofaktur`,`pembelian`.`tglfaktur` AS `tglfaktur`,`supplier`.`namasupplier` AS `namasupplier`,`supplier`.`npwp` AS `npwpsupplier` from (((((`hutangdetail` join `hutang` on((`hutangdetail`.`idhutang` = `hutang`.`idhutang`))) join `pengguna` on((`hutangdetail`.`idpengguna` = `pengguna`.`idpengguna`))) left join `bank` on((`hutangdetail`.`idbank` = `bank`.`idbank`))) join `pembelian` on((`hutang`.`idpembelian` = `pembelian`.`idpembelian`))) join `supplier` on((`hutang`.`idsupplier` = `supplier`.`idsupplier`))) */;

/*View structure for view v_hutangekspedisi */

/*!50001 DROP TABLE IF EXISTS `v_hutangekspedisi` */;
/*!50001 DROP VIEW IF EXISTS `v_hutangekspedisi` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hutangekspedisi` AS select `hutangekspedisi`.`idhutangekspedisi` AS `idhutangekspedisi`,`hutangekspedisi`.`idtransaksi` AS `idtransaksi`,`hutangekspedisi`.`tglhutang` AS `tglhutang`,`hutangekspedisi`.`idekspedisi` AS `idekspedisi`,`hutangekspedisi`.`debet` AS `debet`,`hutangekspedisi`.`kredit` AS `kredit`,`hutangekspedisi`.`jenissumber` AS `jenissumber`,`hutangekspedisi`.`keterangan` AS `keterangan`,`hutangekspedisi`.`carabayar` AS `carabayar`,`hutangekspedisi`.`jenis` AS `jenis`,`hutangekspedisi`.`idbank` AS `idbank`,`hutangekspedisi`.`nobilyetgiro` AS `nobilyetgiro`,`hutangekspedisi`.`hargadpp` AS `hargadpp`,`hutangekspedisi`.`persenppn` AS `persenppn`,`hutangekspedisi`.`jumlahppn` AS `jumlahppn`,`hutangekspedisi`.`persenpph23` AS `persenpph23`,`hutangekspedisi`.`jumlahpph23` AS `jumlahpph23`,`ekspedisi`.`namaekspedisi` AS `namaekspedisi`,`bank`.`namabank` AS `namabank`,`bank`.`cabang` AS `cabang`,`bank`.`norekening` AS `norekening`,`bank`.`kdakun` AS `kdakunbank` from ((`hutangekspedisi` join `ekspedisi` on((`hutangekspedisi`.`idekspedisi` = `ekspedisi`.`idekspedisi`))) left join `bank` on((`hutangekspedisi`.`idbank` = `bank`.`idbank`))) */;

/*View structure for view v_jurnal */

/*!50001 DROP TABLE IF EXISTS `v_jurnal` */;
/*!50001 DROP VIEW IF EXISTS `v_jurnal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jurnal` AS select `jurnal`.`idjurnal` AS `idjurnal`,`jurnal`.`tgljurnal` AS `tgljurnal`,`jurnal`.`keterangan` AS `keterangan`,`jurnal`.`totaldebet` AS `totaldebet`,`jurnal`.`totalkredit` AS `totalkredit`,`jurnal`.`referensi` AS `referensi`,`jurnal`.`jenis` AS `jenis`,`jurnal`.`inserted_date` AS `inserted_date`,`jurnal`.`updated_date` AS `updated_date`,`jurnal`.`idpengguna` AS `idpengguna`,`jurnal`.`idposting` AS `idposting`,`pengguna`.`namapengguna` AS `namapengguna` from (`jurnal` join `pengguna` on((`jurnal`.`idpengguna` = `pengguna`.`idpengguna`))) */;

/*View structure for view v_jurnaldetail */

/*!50001 DROP TABLE IF EXISTS `v_jurnaldetail` */;
/*!50001 DROP VIEW IF EXISTS `v_jurnaldetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jurnaldetail` AS select `jurnaldetail`.`idjurnaldetail` AS `idjurnaldetail`,`jurnaldetail`.`idjurnal` AS `idjurnal`,`jurnaldetail`.`kdakun` AS `kdakun`,`jurnaldetail`.`debet` AS `debet`,`jurnaldetail`.`kredit` AS `kredit`,`jurnaldetail`.`urut` AS `urut`,`akun`.`namaakun` AS `namaakun`,`akun`.`kdparent` AS `kdparent`,`jurnal`.`tgljurnal` AS `tgljurnal`,`jurnal`.`jenis` AS `jenis`,`jurnal`.`referensi` AS `referensi`,`jurnal`.`keterangan` AS `keterangan` from ((`jurnaldetail` join `jurnal` on((`jurnaldetail`.`idjurnal` = `jurnal`.`idjurnal`))) join `akun` on((`jurnaldetail`.`kdakun` = `akun`.`kdakun`))) */;

/*View structure for view v_konsumen */

/*!50001 DROP TABLE IF EXISTS `v_konsumen` */;
/*!50001 DROP VIEW IF EXISTS `v_konsumen` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_konsumen` AS select `konsumen`.`idkonsumen` AS `idkonsumen`,`konsumen`.`namakonsumen` AS `namakonsumen`,`konsumen`.`alamatkonsumen` AS `alamatkonsumen`,`konsumen`.`notelpkonsumen` AS `notelpkonsumen`,`konsumen`.`emailkonsumen` AS `emailkonsumen`,`konsumen`.`nikpemilik` AS `nikpemilik`,`konsumen`.`namapemilik` AS `namapemilik`,`konsumen`.`notelppemilik` AS `notelppemilik`,`konsumen`.`nowapemilik` AS `nowapemilik`,`konsumen`.`saldo` AS `saldo`,`konsumen`.`idwilayah` AS `idwilayah`,`konsumen`.`saldopajak` AS `saldopajak`,`konsumen`.`inserted_date` AS `inserted_date`,`konsumen`.`updated_date` AS `updated_date`,`konsumen`.`statusaktif` AS `statusaktif`,`konsumen`.`npwp` AS `npwp`,`konsumen`.`limitkredit` AS `limitkredit`,`konsumen`.`jumlahpiutang` AS `jumlahpiutang`,`konsumen`.`kdakunpiutang` AS `kdakunpiutang`,`wilayah`.`namawilayah` AS `namawilayah`,`akun`.`namaakun` AS `namaakunpiutang` from ((`konsumen` join `wilayah` on((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`))) left join `akun` on((`konsumen`.`kdakunpiutang` = `akun`.`kdakun`))) */;

/*View structure for view v_pembelian */

/*!50001 DROP TABLE IF EXISTS `v_pembelian` */;
/*!50001 DROP VIEW IF EXISTS `v_pembelian` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembelian` AS select `pembelian`.`idpembelian` AS `idpembelian`,`pembelian`.`idsupplier` AS `idsupplier`,`pembelian`.`nofaktur` AS `nofaktur`,`pembelian`.`tglfaktur` AS `tglfaktur`,`pembelian`.`tglditerima` AS `tglditerima`,`pembelian`.`keterangan` AS `keterangan`,`pembelian`.`inserted_date` AS `inserted_date`,`pembelian`.`updated_date` AS `updated_date`,`pembelian`.`idpengguna` AS `idpengguna`,`supplier`.`namasupplier` AS `namasupplier`,`pengguna`.`namapengguna` AS `namapengguna`,`pembelian`.`carabayar` AS `carabayar`,`pembelian`.`idbank` AS `idbank`,`bank`.`namabank` AS `namabank`,`bank`.`cabang` AS `cabang`,`bank`.`norekening` AS `norekening`,`bank`.`atasnama` AS `atasnama`,`bank`.`kdakun` AS `kdakunbank`,`pembelian`.`totalpembelian` AS `totalpembelian`,`pembelian`.`totaldiskon` AS `totaldiskon`,`pembelian`.`totalbersih` AS `totalbersih`,`pembelian`.`ppnpersen` AS `ppnpersen`,`pembelian`.`totalppn` AS `totalppn`,`pembelian`.`biayapengiriman` AS `biayapengiriman`,`pembelian`.`totalpotongan` AS `totalpotongan`,`pembelian`.`totalfaktur` AS `totalfaktur`,`pembelian`.`totaldpp` AS `totaldpp`,`pembelian`.`nobilyetgiro` AS `nobilyetgiro`,`pembelian`.`tglbilyetgiro` AS `tglbilyetgiro`,`pembelian`.`totaldpp_po` AS `totaldpp_po`,`pembelian`.`totalppn_po` AS `totalppn_po`,`pembelian`.`totalfaktur_po` AS `totalfaktur_po`,`pembelian`.`statuspenerimaan` AS `statuspenerimaan`,`pembelian`.`tgl_po` AS `tgl_po`,`pembelian`.`keterangan_po` AS `keterangan_po`,`pembelian`.`idpengguna_po` AS `idpengguna_po`,`pembelian`.`idekspedisi` AS `idekspedisi`,`ekspedisi`.`namaekspedisi` AS `namaekspedisi` from ((((`pembelian` join `supplier` on((`pembelian`.`idsupplier` = `supplier`.`idsupplier`))) join `pengguna` on((`pembelian`.`idpengguna` = `pengguna`.`idpengguna`))) left join `bank` on((`pembelian`.`idbank` = `bank`.`idbank`))) left join `ekspedisi` on((`pembelian`.`idekspedisi` = `ekspedisi`.`idekspedisi`))) */;

/*View structure for view v_pembelian_po */

/*!50001 DROP TABLE IF EXISTS `v_pembelian_po` */;
/*!50001 DROP VIEW IF EXISTS `v_pembelian_po` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembelian_po` AS select `pembelian`.`idpembelian` AS `idpembelian`,`pembelian`.`idsupplier` AS `idsupplier`,`pembelian`.`inserted_date` AS `inserted_date`,`pembelian`.`updated_date` AS `updated_date`,`pembelian`.`totaldpp_po` AS `totaldpp_po`,`pembelian`.`totalppn_po` AS `totalppn_po`,`pembelian`.`totalfaktur_po` AS `totalfaktur_po`,`pembelian`.`statuspenerimaan` AS `statuspenerimaan`,`pembelian`.`tgl_po` AS `tgl_po`,`pembelian`.`keterangan_po` AS `keterangan_po`,`pembelian`.`idpengguna_po` AS `idpengguna_po`,`pembelian`.`nofaktur` AS `nofaktur`,`pembelian`.`ppnpersen` AS `ppnpersen`,`supplier`.`namasupplier` AS `namasupplier` from (`pembelian` join `supplier` on((`pembelian`.`idsupplier` = `supplier`.`idsupplier`))) */;

/*View structure for view v_pembeliandetail */

/*!50001 DROP TABLE IF EXISTS `v_pembeliandetail` */;
/*!50001 DROP VIEW IF EXISTS `v_pembeliandetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembeliandetail` AS select `pembeliandetail`.`id` AS `id`,`pembeliandetail`.`idpembelian` AS `idpembelian`,`pembeliandetail`.`idbarang` AS `idbarang`,`pembeliandetail`.`jumlahbeli` AS `jumlahbeli`,`pembeliandetail`.`hargasatuan` AS `hargasatuan`,`pembeliandetail`.`hargadpp` AS `hargadpp`,`pembeliandetail`.`jumlahppn` AS `jumlahppn`,`pembeliandetail`.`jumlahdiskon` AS `jumlahdiskon`,`pembeliandetail`.`jenisdiskon` AS `jenisdiskon`,`pembeliandetail`.`diskonpersen1` AS `diskonpersen1`,`pembeliandetail`.`diskonpersen2` AS `diskonpersen2`,`pembeliandetail`.`diskonpersen3` AS `diskonpersen3`,`pembeliandetail`.`subtotalbeli` AS `subtotalbeli`,`pembeliandetail`.`jumlahbeli_po` AS `jumlahbeli_po`,`pembeliandetail`.`hargasatuan_po` AS `hargasatuan_po`,`pembeliandetail`.`hargadpp_po` AS `hargadpp_po`,`pembeliandetail`.`jumlahppn_po` AS `jumlahppn_po`,`pembeliandetail`.`subtotalbeli_po` AS `subtotalbeli_po`,`pembelian`.`tglfaktur` AS `tglfaktur`,`pembelian`.`nofaktur` AS `nofaktur`,`pembelian`.`tglditerima` AS `tglditerima`,`pembelian`.`idsupplier` AS `idsupplier`,`barang`.`namabarang` AS `namabarang`,`barang`.`idkategori` AS `idkategori`,`barang`.`kdakun` AS `kdakun`,`kategoribarang`.`namakategori` AS `namakategori`,`barang`.`stok` AS `stokreal` from (((`pembeliandetail` join `pembelian` on((`pembeliandetail`.`idpembelian` = `pembelian`.`idpembelian`))) join `barang` on((`pembeliandetail`.`idbarang` = `barang`.`idbarang`))) join `kategoribarang` on((`barang`.`idkategori` = `kategoribarang`.`idkategori`))) */;

/*View structure for view v_pembeliandetail_bahanjurnal */

/*!50001 DROP TABLE IF EXISTS `v_pembeliandetail_bahanjurnal` */;
/*!50001 DROP VIEW IF EXISTS `v_pembeliandetail_bahanjurnal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembeliandetail_bahanjurnal` AS select `pembeliandetail`.`idpembelian` AS `idpembelian`,`barang`.`kdakun` AS `kdakunbarang`,sum(`pembeliandetail`.`subtotalbeli`) AS `subtotalbeli`,`pembelian`.`nofaktur` AS `nofaktur`,`pembelian`.`tglfaktur` AS `tglfaktur`,`pembelian`.`totalfaktur` AS `totalfaktur`,`pembelian`.`carabayar` AS `carabayar`,`bank`.`kdakun` AS `kdakunbank`,`pembelian`.`keterangan` AS `keterangan` from (((`pembeliandetail` join `pembelian` on((`pembeliandetail`.`idpembelian` = `pembelian`.`idpembelian`))) join `barang` on((`pembeliandetail`.`idbarang` = `barang`.`idbarang`))) left join `bank` on((`pembelian`.`idbank` = `bank`.`idbank`))) group by `pembeliandetail`.`idpembelian`,`kdakunbarang`,`pembelian`.`nofaktur`,`pembelian`.`tglfaktur`,`pembelian`.`carabayar`,`kdakunbank`,`pembelian`.`keterangan` */;

/*View structure for view v_pembeliandetail_laporan */

/*!50001 DROP TABLE IF EXISTS `v_pembeliandetail_laporan` */;
/*!50001 DROP VIEW IF EXISTS `v_pembeliandetail_laporan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembeliandetail_laporan` AS select `pembeliandetail`.`id` AS `id`,`pembeliandetail`.`idpembelian` AS `idpembelian`,`pembeliandetail`.`idbarang` AS `idbarang`,`pembeliandetail`.`jumlahbeli` AS `jumlahbeli`,`pembeliandetail`.`hargasatuan` AS `hargasatuan`,`pembeliandetail`.`hargadpp` AS `hargadpp`,`pembeliandetail`.`jumlahppn` AS `jumlahppn`,`pembeliandetail`.`jumlahdiskon` AS `jumlahdiskon`,`pembeliandetail`.`subtotalbeli` AS `subtotalbeli`,`pembeliandetail`.`jenisdiskon` AS `jenisdiskon`,`pembeliandetail`.`diskonpersen1` AS `diskonpersen1`,`pembeliandetail`.`diskonpersen2` AS `diskonpersen2`,`pembeliandetail`.`diskonpersen3` AS `diskonpersen3`,`barang`.`namabarang` AS `namabarang`,`barang`.`idkategori` AS `idkategori`,`barang`.`kdakun` AS `kdakunbarang`,`barang`.`fotobarang` AS `fotobarang`,`kategoribarang`.`namakategori` AS `namakategori`,`pembelian`.`idsupplier` AS `idsupplier`,`pembelian`.`nofaktur` AS `nofaktur`,`pembelian`.`tglfaktur` AS `tglfaktur`,`pembelian`.`tglditerima` AS `tglditerima`,`pembelian`.`keterangan` AS `keterangan`,`pembelian`.`totalpembelian` AS `totalpembelian`,`pembelian`.`totaldiskon` AS `totaldiskon`,`pembelian`.`totalbersih` AS `totalbersih`,`pembelian`.`ppnpersen` AS `ppnpersen`,`pembelian`.`totalppn` AS `totalppn`,`pembelian`.`biayapengiriman` AS `biayapengiriman`,`pembelian`.`totalpotongan` AS `totalpotongan`,`pembelian`.`totalfaktur` AS `totalfaktur`,`pembelian`.`idpengguna` AS `idpengguna`,`pembelian`.`carabayar` AS `carabayar`,`pembelian`.`idbank` AS `idbank`,`bank`.`namabank` AS `namabank`,`bank`.`cabang` AS `cabang`,`bank`.`norekening` AS `norekening`,`bank`.`atasnama` AS `atasnama`,`supplier`.`namasupplier` AS `namasupplier`,`supplier`.`alamatsupplier` AS `alamatsupplier`,`pengguna`.`namapengguna` AS `namapengguna` from ((((((`pembeliandetail` join `pembelian` on((`pembeliandetail`.`idpembelian` = `pembelian`.`idpembelian`))) join `barang` on((`pembeliandetail`.`idbarang` = `barang`.`idbarang`))) join `kategoribarang` on((`barang`.`idkategori` = `kategoribarang`.`idkategori`))) left join `supplier` on((`pembelian`.`idsupplier` = `supplier`.`idsupplier`))) left join `bank` on((`pembelian`.`idbank` = `bank`.`idbank`))) join `pengguna` on((`pembelian`.`idpengguna` = `pengguna`.`idpengguna`))) */;

/*View structure for view v_pembeliandetail_po */

/*!50001 DROP TABLE IF EXISTS `v_pembeliandetail_po` */;
/*!50001 DROP VIEW IF EXISTS `v_pembeliandetail_po` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembeliandetail_po` AS select `pembeliandetail`.`id` AS `id`,`v_pembelian_po`.`tgl_po` AS `tgl_po`,`pembeliandetail`.`idpembelian` AS `idpembelian`,`pembeliandetail`.`idbarang` AS `idbarang`,`pembeliandetail`.`jumlahbeli_po` AS `jumlahbeli_po`,`pembeliandetail`.`hargasatuan_po` AS `hargasatuan_po`,`pembeliandetail`.`hargadpp_po` AS `hargadpp_po`,`pembeliandetail`.`jumlahppn_po` AS `jumlahppn_po`,`pembeliandetail`.`subtotalbeli_po` AS `subtotalbeli_po`,`barang`.`namabarang` AS `namabarang`,`barang`.`idkategori` AS `idkategori`,`kategoribarang`.`namakategori` AS `namakategori` from (((`pembeliandetail` join `v_pembelian_po` on((`pembeliandetail`.`idpembelian` = `v_pembelian_po`.`idpembelian`))) join `barang` on((`pembeliandetail`.`idbarang` = `barang`.`idbarang`))) join `kategoribarang` on((`barang`.`idkategori` = `kategoribarang`.`idkategori`))) */;

/*View structure for view v_pembeliandetail_retur */

/*!50001 DROP TABLE IF EXISTS `v_pembeliandetail_retur` */;
/*!50001 DROP VIEW IF EXISTS `v_pembeliandetail_retur` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pembeliandetail_retur` AS select `v_pembeliandetail`.`id` AS `id`,`v_pembeliandetail`.`idpembelian` AS `idpembelian`,`v_pembeliandetail`.`idbarang` AS `idbarang`,sum(`v_pembeliandetail`.`jumlahbeli`) AS `jumlahbeli`,sum(`v_returpembeliandetail`.`jumlahretur`) AS `jumlahretur`,`v_pembeliandetail`.`hargasatuan` AS `hargasatuan`,`v_pembeliandetail`.`jumlahdiskon` AS `jumlahdiskon`,`v_pembeliandetail`.`subtotalbeli` AS `subtotalbeli`,`v_pembeliandetail`.`tglfaktur` AS `tglfaktur`,`v_pembeliandetail`.`nofaktur` AS `nofaktur`,`v_pembeliandetail`.`tglditerima` AS `tglditerima`,`v_pembeliandetail`.`idsupplier` AS `idsupplier`,`v_pembeliandetail`.`namabarang` AS `namabarang`,`v_pembeliandetail`.`idkategori` AS `idkategori`,`v_pembeliandetail`.`kdakun` AS `kdakun`,`v_pembeliandetail`.`namakategori` AS `namakategori` from (`v_pembeliandetail` left join `v_returpembeliandetail` on(((`v_pembeliandetail`.`idbarang` = `v_returpembeliandetail`.`idbarang`) and (`v_pembeliandetail`.`idpembelian` = `v_returpembeliandetail`.`idpembelian`)))) group by `v_pembeliandetail`.`id`,`v_pembeliandetail`.`idpembelian`,`v_pembeliandetail`.`idbarang`,`v_pembeliandetail`.`jumlahbeli`,`v_returpembeliandetail`.`jumlahretur`,`v_pembeliandetail`.`hargasatuan`,`v_pembeliandetail`.`jumlahdiskon`,`v_pembeliandetail`.`subtotalbeli`,`v_pembeliandetail`.`tglfaktur`,`v_pembeliandetail`.`nofaktur`,`v_pembeliandetail`.`tglditerima`,`v_pembeliandetail`.`idsupplier`,`v_pembeliandetail`.`namabarang`,`v_pembeliandetail`.`idkategori`,`v_pembeliandetail`.`kdakun`,`v_pembeliandetail`.`namakategori` */;

/*View structure for view v_penagihan */

/*!50001 DROP TABLE IF EXISTS `v_penagihan` */;
/*!50001 DROP VIEW IF EXISTS `v_penagihan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penagihan` AS select `penagihan`.`idpenagihan` AS `idpenagihan`,`penagihan`.`tglpenagihan` AS `tglpenagihan`,`penagihan`.`idsales` AS `idsales`,`penagihan`.`totaltagihan` AS `totaltagihan`,`penagihan`.`inserted_date` AS `inserted_date`,`penagihan`.`updated_date` AS `updated_date`,`penagihan`.`idpengguna` AS `idpengguna`,`penagihan`.`statuscetak` AS `statuscetak`,`sales`.`namasales` AS `namasales`,`sales`.`npwp` AS `npwpsales` from (`penagihan` join `sales` on((`penagihan`.`idsales` = `sales`.`idsales`))) */;

/*View structure for view v_penagihan_yang_dibayar */

/*!50001 DROP TABLE IF EXISTS `v_penagihan_yang_dibayar` */;
/*!50001 DROP VIEW IF EXISTS `v_penagihan_yang_dibayar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penagihan_yang_dibayar` AS select `penagihan`.`idpenagihan` AS `idpenagihan`,`penagihandetail`.`idsalesbonus` AS `idsalesbonus`,`piutang`.`idpiutang` AS `idpiutang`,`piutang`.`idpenjualan` AS `idpenjualan`,`piutangdetail`.`idpiutangdetail` AS `idpiutangdetail`,`piutangdetail`.`tglpiutang` AS `tglpiutang`,`piutang`.`tgljatuhtempo` AS `tgljatuhtempo`,`piutangdetail`.`debet` AS `debet`,`piutangdetail`.`kredit` AS `kredit`,`piutangdetail`.`bonuspenagihansudahdibayar` AS `bonuspenagihansudahdibayar` from (((`penagihandetail` join `penagihan` on((`penagihandetail`.`idpenagihan` = `penagihan`.`idpenagihan`))) join `piutang` on((`penagihandetail`.`idpiutang` = `piutang`.`idpiutang`))) join `piutangdetail` on((`piutangdetail`.`idpiutang` = `piutang`.`idpiutang`))) where (`piutangdetail`.`kredit` > 0) */;

/*View structure for view v_penagihan_yang_dibayar_detail */

/*!50001 DROP TABLE IF EXISTS `v_penagihan_yang_dibayar_detail` */;
/*!50001 DROP VIEW IF EXISTS `v_penagihan_yang_dibayar_detail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penagihan_yang_dibayar_detail` AS select `penagihan`.`idpenagihan` AS `idpenagihan`,`penagihandetail`.`idsalesbonus` AS `idsalesbonus`,`piutang`.`idpiutang` AS `idpiutang`,`piutang`.`idpenjualan` AS `idpenjualan`,`piutangdetail`.`idpiutangdetail` AS `idpiutangdetail`,`piutangdetail`.`tglpiutang` AS `tglpiutang`,`piutang`.`tgljatuhtempo` AS `tgljatuhtempo`,`piutangdetail`.`debet` AS `debet`,`piutangdetail`.`kredit` AS `kredit`,`piutangdetail`.`bonuspenagihansudahdibayar` AS `bonuspenagihansudahdibayar`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`tglinvoice` AS `tglinvoice`,`penjualan`.`totaldiskon` AS `totaldiskon`,`penjualan`.`totaldpp` AS `totaldpp`,`penjualan`.`totalppn` AS `totalppn`,`penjualan`.`totalinvoice` AS `totalinvoice`,`penjualandetail`.`id` AS `idpenjualandetail`,`penjualandetail`.`idbarang` AS `idbarang`,`penjualandetail`.`jumlahjual` AS `jumlahjual`,`penjualandetail`.`hargasatuan` AS `hargasatuan`,`penjualandetail`.`hargadpp` AS `hargadpp`,`penjualandetail`.`jumlahppn` AS `jumlahppn`,`penjualandetail`.`jumlahdiskon` AS `jumlahdiskon`,`penjualandetail`.`subtotaljual` AS `subtotaljual`,`barang`.`namabarang` AS `namabarang`,`barang`.`jenisbonustagihan` AS `jenisbonustagihan`,`barang`.`persenbonustagihan` AS `persenbonustagihan`,`barang`.`jumlahbonustagihan` AS `jumlahbonustagihan` from ((((((`penagihandetail` join `penagihan` on((`penagihandetail`.`idpenagihan` = `penagihan`.`idpenagihan`))) join `piutang` on((`penagihandetail`.`idpiutang` = `piutang`.`idpiutang`))) join `piutangdetail` on((`piutangdetail`.`idpiutang` = `piutang`.`idpiutang`))) join `penjualan` on((`piutang`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `penjualandetail` on((`penjualandetail`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `barang` on((`penjualandetail`.`idbarang` = `barang`.`idbarang`))) where (`piutangdetail`.`kredit` > 0) */;

/*View structure for view v_penagihandetail */

/*!50001 DROP TABLE IF EXISTS `v_penagihandetail` */;
/*!50001 DROP VIEW IF EXISTS `v_penagihandetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penagihandetail` AS select `penagihandetail`.`id` AS `id`,`penagihandetail`.`idpenagihan` AS `idpenagihan`,`penagihan`.`tglpenagihan` AS `tglpenagihan`,`penagihandetail`.`idpiutang` AS `idpiutang`,`penagihandetail`.`jumlahtagihan` AS `jumlahtagihan`,`penagihandetail`.`idsalesbonus` AS `idsalesbonus`,`v_piutang`.`noinvoice` AS `noinvoice`,`v_piutang`.`tglinvoice` AS `tglinvoice`,`v_piutang`.`tglpiutang` AS `tglpiutang`,`v_piutang`.`tgljatuhtempo` AS `tgljatuhtempo`,`v_piutang`.`idkonsumen` AS `idkonsumen`,`v_piutang`.`namakonsumen` AS `namakonsumen`,`v_piutang`.`namawilayah` AS `namawilayah`,`sales`.`namasales` AS `namasalesbonus`,`v_piutang`.`totaldebet` AS `totaldebet`,`v_piutang`.`totalkredit` AS `totalkredit` from (((`penagihandetail` join `penagihan` on((`penagihandetail`.`idpenagihan` = `penagihan`.`idpenagihan`))) join `v_piutang` on((`penagihandetail`.`idpiutang` = `v_piutang`.`idpiutang`))) join `sales` on((`penagihandetail`.`idsalesbonus` = `sales`.`idsales`))) */;

/*View structure for view v_penerimaan */

/*!50001 DROP TABLE IF EXISTS `v_penerimaan` */;
/*!50001 DROP VIEW IF EXISTS `v_penerimaan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penerimaan` AS select `penerimaan`.`idpenerimaan` AS `idpenerimaan`,`penerimaan`.`tglpenerimaan` AS `tglpenerimaan`,`penerimaan`.`totalpenerimaan` AS `totalpenerimaan`,`penerimaan`.`keterangan` AS `keterangan`,`penerimaan`.`inserted_date` AS `inserted_date`,`penerimaan`.`updated_date` AS `updated_date`,`penerimaan`.`idpengguna` AS `idpengguna`,`penerimaan`.`carabayar` AS `carabayar`,`penerimaan`.`idbank` AS `idbank`,`pengguna`.`namapengguna` AS `namapengguna`,`bank`.`namabank` AS `namabank`,`bank`.`cabang` AS `cabang`,`bank`.`norekening` AS `norekening` from ((`penerimaan` join `pengguna` on((`penerimaan`.`idpengguna` = `pengguna`.`idpengguna`))) left join `bank` on((`penerimaan`.`idbank` = `bank`.`idbank`))) */;

/*View structure for view v_penerimaandetail */

/*!50001 DROP TABLE IF EXISTS `v_penerimaandetail` */;
/*!50001 DROP VIEW IF EXISTS `v_penerimaandetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penerimaandetail` AS select `penerimaandetail`.`idpenerimaandetail` AS `idpenerimaandetail`,`penerimaandetail`.`idpenerimaan` AS `idpenerimaan`,`penerimaandetail`.`kdakun` AS `kdakun`,`penerimaandetail`.`jumlahpenerimaan` AS `jumlahpenerimaan`,`penerimaan`.`tglpenerimaan` AS `tglpenerimaan`,`akun`.`namaakun` AS `namaakun`,`akun`.`kdparent` AS `kdparent` from ((`penerimaandetail` join `penerimaan` on((`penerimaandetail`.`idpenerimaan` = `penerimaan`.`idpenerimaan`))) join `akun` on((`penerimaandetail`.`kdakun` = `akun`.`kdakun`))) */;

/*View structure for view v_penerimaandetail_laporan */

/*!50001 DROP TABLE IF EXISTS `v_penerimaandetail_laporan` */;
/*!50001 DROP VIEW IF EXISTS `v_penerimaandetail_laporan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penerimaandetail_laporan` AS select `penerimaan`.`idpenerimaan` AS `idpenerimaan`,`penerimaan`.`tglpenerimaan` AS `tglpenerimaan`,`penerimaan`.`keterangan` AS `keterangan`,`penerimaan`.`carabayar` AS `carabayar`,`penerimaan`.`idbank` AS `idbank`,`penerimaandetail`.`idpenerimaandetail` AS `idpenerimaandetail`,`penerimaandetail`.`kdakun` AS `kdakun`,`penerimaandetail`.`jumlahpenerimaan` AS `jumlahpenerimaan`,`bank`.`namabank` AS `namabank`,`bank`.`cabang` AS `cabang`,`bank`.`norekening` AS `norekening`,`bank`.`kdakun` AS `kdakunbank`,`penerimaan`.`totalpenerimaan` AS `totalpenerimaan` from ((`penerimaandetail` join `penerimaan` on((`penerimaandetail`.`idpenerimaan` = `penerimaan`.`idpenerimaan`))) left join `bank` on((`penerimaan`.`idbank` = `bank`.`idbank`))) */;

/*View structure for view v_pengeluaran */

/*!50001 DROP TABLE IF EXISTS `v_pengeluaran` */;
/*!50001 DROP VIEW IF EXISTS `v_pengeluaran` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengeluaran` AS select `pengeluaran`.`idpengeluaran` AS `idpengeluaran`,`pengeluaran`.`tglpengeluaran` AS `tglpengeluaran`,`pengeluaran`.`nokwitansi` AS `nokwitansi`,`pengeluaran`.`totalpengeluaran` AS `totalpengeluaran`,`pengeluaran`.`keterangan` AS `keterangan`,`pengeluaran`.`inserted_date` AS `inserted_date`,`pengeluaran`.`updated_date` AS `updated_date`,`pengeluaran`.`idpengguna` AS `idpengguna`,`pengeluaran`.`carabayar` AS `carabayar`,`pengeluaran`.`idbank` AS `idbank`,`pengguna`.`namapengguna` AS `namapengguna`,`bank`.`namabank` AS `namabank`,`bank`.`cabang` AS `cabang`,`bank`.`norekening` AS `norekening`,`bank`.`kdakun` AS `kdakunbank` from ((`pengeluaran` join `pengguna` on((`pengeluaran`.`idpengguna` = `pengguna`.`idpengguna`))) left join `bank` on((`pengeluaran`.`idbank` = `bank`.`idbank`))) */;

/*View structure for view v_pengeluarandetail */

/*!50001 DROP TABLE IF EXISTS `v_pengeluarandetail` */;
/*!50001 DROP VIEW IF EXISTS `v_pengeluarandetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengeluarandetail` AS select `pengeluarandetail`.`idpengeluarandetail` AS `idpengeluarandetail`,`pengeluarandetail`.`idpengeluaran` AS `idpengeluaran`,`pengeluarandetail`.`kdakun` AS `kdakun`,`pengeluarandetail`.`jumlahpengeluaran` AS `jumlahpengeluaran`,`pengeluaran`.`tglpengeluaran` AS `tglpengeluaran`,`akun`.`namaakun` AS `namaakun`,`akun`.`kdparent` AS `kdparent` from ((`pengeluarandetail` join `pengeluaran` on((`pengeluarandetail`.`idpengeluaran` = `pengeluaran`.`idpengeluaran`))) join `akun` on((`pengeluarandetail`.`kdakun` = `akun`.`kdakun`))) */;

/*View structure for view v_pengeluarandetail_bahanjurnal */

/*!50001 DROP TABLE IF EXISTS `v_pengeluarandetail_bahanjurnal` */;
/*!50001 DROP VIEW IF EXISTS `v_pengeluarandetail_bahanjurnal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengeluarandetail_bahanjurnal` AS select `pengeluaran`.`idpengeluaran` AS `idpengeluaran`,`pengeluaran`.`tglpengeluaran` AS `tglpengeluaran`,`pengeluaran`.`keterangan` AS `keterangan`,`pengeluaran`.`totalpengeluaran` AS `totalpengeluaran`,`pengeluaran`.`carabayar` AS `carabayar`,`pengeluarandetail`.`kdakun` AS `kdakun`,`pengeluarandetail`.`jumlahpengeluaran` AS `jumlahpengeluaran`,`bank`.`kdakun` AS `kdakunbank` from ((`pengeluarandetail` join `pengeluaran` on((`pengeluarandetail`.`idpengeluaran` = `pengeluaran`.`idpengeluaran`))) left join `bank` on((`pengeluaran`.`idbank` = `bank`.`idbank`))) */;

/*View structure for view v_pengguna */

/*!50001 DROP TABLE IF EXISTS `v_pengguna` */;
/*!50001 DROP VIEW IF EXISTS `v_pengguna` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengguna` AS select `pengguna`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna`,`pengguna`.`jeniskelamin` AS `jeniskelamin`,`pengguna`.`notelppengguna` AS `notelppengguna`,`pengguna`.`emailpengguna` AS `emailpengguna`,`pengguna`.`fotopengguna` AS `fotopengguna`,`pengguna`.`username` AS `username`,`pengguna`.`password` AS `password`,`pengguna`.`idotorisasi` AS `idotorisasi`,`pengguna`.`inserted_date` AS `inserted_date`,`pengguna`.`updated_date` AS `updated_date`,`pengguna`.`statusaktif` AS `statusaktif`,`otorisasi`.`namaotorisasi` AS `namaotorisasi`,`pengguna`.`lastlogin` AS `lastlogin` from (`pengguna` join `otorisasi` on((`pengguna`.`idotorisasi` = `otorisasi`.`idotorisasi`))) */;

/*View structure for view v_penjualan */

/*!50001 DROP TABLE IF EXISTS `v_penjualan` */;
/*!50001 DROP VIEW IF EXISTS `v_penjualan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualan` AS select `penjualan`.`idpenjualan` AS `idpenjualan`,`penjualan`.`idkonsumen` AS `idkonsumen`,`penjualan`.`tglinvoice` AS `tglinvoice`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`keterangan` AS `keterangan`,`penjualan`.`totalpenjualan` AS `totalpenjualan`,`penjualan`.`totaldpp` AS `totaldpp`,`penjualan`.`totaldiskon` AS `totaldiskon`,`penjualan`.`totalbersih` AS `totalbersih`,`penjualan`.`ppnpersen` AS `ppnpersen`,`penjualan`.`totalppn` AS `totalppn`,`penjualan`.`biayapengiriman` AS `biayapengiriman`,`penjualan`.`totalinvoice` AS `totalinvoice`,`penjualan`.`idpengguna` AS `idpengguna`,`penjualan`.`inserted_date` AS `inserted_date`,`penjualan`.`updated_date` AS `updated_date`,`penjualan`.`carabayar` AS `carabayar`,`penjualan`.`idbank` AS `idbank`,`penjualan`.`idjenispiutang` AS `idjenispiutang`,`penjualan`.`idsales` AS `idsales`,`penjualan`.`nokwitansi` AS `nokwitansi`,`penjualan`.`nobilyetgiro` AS `nobilyetgiro`,`konsumen`.`namakonsumen` AS `namakonsumen`,`konsumen`.`idwilayah` AS `idwilayah`,`bank`.`namabank` AS `namabank`,`bank`.`cabang` AS `cabang`,`bank`.`norekening` AS `norekening`,`bank`.`atasnama` AS `atasnama`,`sales`.`namasales` AS `namasales`,`jenispiutang`.`namajenispiutang` AS `namajenispiutang`,`jenispiutang`.`jatuhtempo` AS `jatuhtempo`,`pengguna`.`namapengguna` AS `namapengguna`,`wilayah`.`namawilayah` AS `namawilayah` from ((((((`penjualan` left join `konsumen` on((`penjualan`.`idkonsumen` = `konsumen`.`idkonsumen`))) join `pengguna` on((`penjualan`.`idpengguna` = `pengguna`.`idpengguna`))) left join `bank` on((`penjualan`.`idbank` = `bank`.`idbank`))) left join `jenispiutang` on((`penjualan`.`idjenispiutang` = `jenispiutang`.`idjenispiutang`))) left join `sales` on((`penjualan`.`idsales` = `sales`.`idsales`))) left join `wilayah` on((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`))) */;

/*View structure for view v_penjualan_belumada_suratjalan */

/*!50001 DROP TABLE IF EXISTS `v_penjualan_belumada_suratjalan` */;
/*!50001 DROP VIEW IF EXISTS `v_penjualan_belumada_suratjalan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualan_belumada_suratjalan` AS select `penjualan`.`idpenjualan` AS `idpenjualan`,`penjualan`.`idkonsumen` AS `idkonsumen`,`penjualan`.`tglinvoice` AS `tglinvoice`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`totalinvoice` AS `totalinvoice`,`penjualan`.`idsales` AS `idsales`,`penjualan`.`carabayar` AS `carabayar`,`suratjalandetail`.`idsuratjalan` AS `idsuratjalan` from (`penjualan` left join `suratjalandetail` on((`suratjalandetail`.`idpenjualan` = `penjualan`.`idpenjualan`))) where (`suratjalandetail`.`idsuratjalan` is null) */;

/*View structure for view v_penjualandetail */

/*!50001 DROP TABLE IF EXISTS `v_penjualandetail` */;
/*!50001 DROP VIEW IF EXISTS `v_penjualandetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualandetail` AS select `penjualandetail`.`id` AS `id`,`penjualandetail`.`idpenjualan` AS `idpenjualan`,`penjualandetail`.`idbarang` AS `idbarang`,`penjualandetail`.`jumlahjual` AS `jumlahjual`,`penjualandetail`.`hargasatuan` AS `hargasatuan`,`penjualandetail`.`hargadpp` AS `hargadpp`,`penjualandetail`.`jumlahppn` AS `jumlahppn`,`penjualandetail`.`jumlahdiskon` AS `jumlahdiskon`,`penjualandetail`.`subtotaljual` AS `subtotaljual`,`penjualandetail`.`jenisdiskon` AS `jenisdiskon`,`penjualandetail`.`diskonpersen1` AS `diskonpersen1`,`penjualandetail`.`diskonpersen2` AS `diskonpersen2`,`penjualandetail`.`diskonpersen3` AS `diskonpersen3`,`penjualan`.`idkonsumen` AS `idkonsumen`,`penjualan`.`tglinvoice` AS `tglinvoice`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`ppnpersen` AS `ppnpersen`,`barang`.`namabarang` AS `namabarang`,`barang`.`idkategori` AS `idkategori`,`barang`.`kdakun` AS `kdakun`,`barang`.`stok` AS `stokreal`,`kategoribarang`.`namakategori` AS `namakategori`,`penjualandetail`.`jenisbonuspenjualan` AS `jenisbonuspenjualan`,`penjualandetail`.`persenbonuspenjualan` AS `persenbonuspenjualan`,`penjualandetail`.`jumlahbonuspenjualan` AS `jumlahbonuspenjualan`,`penjualandetail`.`subtotalbonuspenjualan` AS `subtotalbonuspenjualan`,`penjualandetail`.`jenisbonustagihan` AS `jenisbonustagihan`,`penjualandetail`.`persenbonustagihan` AS `persenbonustagihan`,`penjualandetail`.`jumlahbonustagihan` AS `jumlahbonustagihan`,`penjualandetail`.`subtotalbonustagihan` AS `subtotalbonustagihan` from (((`penjualandetail` join `penjualan` on((`penjualandetail`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `barang` on((`penjualandetail`.`idbarang` = `barang`.`idbarang`))) join `kategoribarang` on((`barang`.`idkategori` = `kategoribarang`.`idkategori`))) */;

/*View structure for view v_penjualandetail_retur */

/*!50001 DROP TABLE IF EXISTS `v_penjualandetail_retur` */;
/*!50001 DROP VIEW IF EXISTS `v_penjualandetail_retur` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualandetail_retur` AS select `v_penjualandetail`.`id` AS `id`,`v_penjualandetail`.`idpenjualan` AS `idpenjualan`,`v_penjualandetail`.`idbarang` AS `idbarang`,sum(`v_penjualandetail`.`jumlahjual`) AS `jumlahjual`,sum(`v_returpenjualandetail`.`jumlahretur`) AS `jumlahretur`,`v_penjualandetail`.`hargasatuan` AS `hargasatuan`,`v_penjualandetail`.`jumlahdiskon` AS `jumlahdiskon`,`v_penjualandetail`.`subtotaljual` AS `subtotaljual`,`v_penjualandetail`.`jenisdiskon` AS `jenisdiskon`,`v_penjualandetail`.`diskonpersen1` AS `diskonpersen1`,`v_penjualandetail`.`diskonpersen2` AS `diskonpersen2`,`v_penjualandetail`.`diskonpersen3` AS `diskonpersen3`,`v_penjualandetail`.`idkonsumen` AS `idkonsumen`,`v_penjualandetail`.`tglinvoice` AS `tglinvoice`,`v_penjualandetail`.`noinvoice` AS `noinvoice`,`v_penjualandetail`.`ppnpersen` AS `ppnpersen`,`v_penjualandetail`.`namabarang` AS `namabarang`,`v_penjualandetail`.`idkategori` AS `idkategori`,`v_penjualandetail`.`kdakun` AS `kdakun`,`v_penjualandetail`.`namakategori` AS `namakategori` from (`v_penjualandetail` left join `v_returpenjualandetail` on(((`v_penjualandetail`.`idpenjualan` = `v_returpenjualandetail`.`idpenjualan`) and (`v_penjualandetail`.`idbarang` = `v_returpenjualandetail`.`idbarang`)))) group by `v_penjualandetail`.`id`,`v_penjualandetail`.`idpenjualan`,`v_penjualandetail`.`idbarang`,`v_penjualandetail`.`hargasatuan`,`v_penjualandetail`.`jumlahdiskon`,`v_penjualandetail`.`subtotaljual`,`v_penjualandetail`.`jenisdiskon`,`v_penjualandetail`.`diskonpersen1`,`v_penjualandetail`.`diskonpersen2`,`v_penjualandetail`.`diskonpersen3`,`v_penjualandetail`.`idkonsumen`,`v_penjualandetail`.`tglinvoice`,`v_penjualandetail`.`noinvoice`,`v_penjualandetail`.`ppnpersen`,`v_penjualandetail`.`namabarang`,`v_penjualandetail`.`idkategori`,`v_penjualandetail`.`kdakun`,`v_penjualandetail`.`namakategori` */;

/*View structure for view v_penjualanpiutang_lewat_jatuh_tempo */

/*!50001 DROP TABLE IF EXISTS `v_penjualanpiutang_lewat_jatuh_tempo` */;
/*!50001 DROP VIEW IF EXISTS `v_penjualanpiutang_lewat_jatuh_tempo` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualanpiutang_lewat_jatuh_tempo` AS select `v_penjualan`.`idpenjualan` AS `idpenjualan`,`v_penjualan`.`idkonsumen` AS `idkonsumen`,`v_penjualan`.`tglinvoice` AS `tglinvoice`,`v_penjualan`.`noinvoice` AS `noinvoice`,`v_penjualan`.`keterangan` AS `keterangan`,`v_penjualan`.`totalpenjualan` AS `totalpenjualan`,`v_penjualan`.`totaldpp` AS `totaldpp`,`v_penjualan`.`totaldiskon` AS `totaldiskon`,`v_penjualan`.`totalbersih` AS `totalbersih`,`v_penjualan`.`ppnpersen` AS `ppnpersen`,`v_penjualan`.`totalppn` AS `totalppn`,`v_penjualan`.`biayapengiriman` AS `biayapengiriman`,`v_penjualan`.`totalinvoice` AS `totalinvoice`,`v_penjualan`.`idpengguna` AS `idpengguna`,`v_penjualan`.`inserted_date` AS `inserted_date`,`v_penjualan`.`updated_date` AS `updated_date`,`v_penjualan`.`carabayar` AS `carabayar`,`v_penjualan`.`idbank` AS `idbank`,`v_penjualan`.`idjenispiutang` AS `idjenispiutang`,`v_penjualan`.`idsales` AS `idsales`,`v_penjualan`.`nokwitansi` AS `nokwitansi`,`v_penjualan`.`nobilyetgiro` AS `nobilyetgiro`,`v_penjualan`.`namakonsumen` AS `namakonsumen`,`v_penjualan`.`idwilayah` AS `idwilayah`,`v_penjualan`.`namabank` AS `namabank`,`v_penjualan`.`cabang` AS `cabang`,`v_penjualan`.`norekening` AS `norekening`,`v_penjualan`.`atasnama` AS `atasnama`,`v_penjualan`.`namasales` AS `namasales`,`v_penjualan`.`namajenispiutang` AS `namajenispiutang`,`v_penjualan`.`jatuhtempo` AS `jatuhtempo`,`v_penjualan`.`namapengguna` AS `namapengguna`,`v_penjualan`.`namawilayah` AS `namawilayah`,(`v_penjualan`.`tglinvoice` + interval `v_penjualan`.`jatuhtempo` day) AS `tgljatuhtempo` from `v_penjualan` where ((`v_penjualan`.`carabayar` = 'Piutang') and ((`v_penjualan`.`tglinvoice` + interval `v_penjualan`.`jatuhtempo` day) < cast(now() as date))) */;

/*View structure for view v_piutang */

/*!50001 DROP TABLE IF EXISTS `v_piutang` */;
/*!50001 DROP VIEW IF EXISTS `v_piutang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_piutang` AS select `piutang`.`idpiutang` AS `idpiutang`,`piutang`.`idpenjualan` AS `idpenjualan`,`piutang`.`idjenispiutang` AS `idjenispiutang`,`piutang`.`tglpiutang` AS `tglpiutang`,`piutang`.`tgljatuhtempo` AS `tgljatuhtempo`,`piutang`.`idkonsumen` AS `idkonsumen`,`piutang`.`totaldebet` AS `totaldebet`,`piutang`.`totalkredit` AS `totalkredit`,`piutang`.`jenissumber` AS `jenissumber`,`piutang`.`keterangan` AS `keterangan`,`piutang`.`tgllunas` AS `tgllunas`,`konsumen`.`namakonsumen` AS `namakonsumen`,`jenispiutang`.`namajenispiutang` AS `namajenispiutang`,`jenispiutang`.`jatuhtempo` AS `jatuhtempo`,`penjualan`.`tglinvoice` AS `tglinvoice`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`idsales` AS `idsales`,`sales`.`namasales` AS `namasales`,`wilayah`.`namawilayah` AS `namawilayah` from (((((`piutang` left join `penjualan` on((`piutang`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `jenispiutang` on((`piutang`.`idjenispiutang` = `jenispiutang`.`idjenispiutang`))) join `konsumen` on((`piutang`.`idkonsumen` = `konsumen`.`idkonsumen`))) left join `sales` on((`penjualan`.`idsales` = `sales`.`idsales`))) left join `wilayah` on((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`))) */;

/*View structure for view v_piutang_belum_ada_penagihan */

/*!50001 DROP TABLE IF EXISTS `v_piutang_belum_ada_penagihan` */;
/*!50001 DROP VIEW IF EXISTS `v_piutang_belum_ada_penagihan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_piutang_belum_ada_penagihan` AS select `v_piutang`.`idpiutang` AS `idpiutang`,`v_piutang`.`idpenjualan` AS `idpenjualan`,`v_piutang`.`idjenispiutang` AS `idjenispiutang`,`v_piutang`.`tglpiutang` AS `tglpiutang`,`v_piutang`.`tgljatuhtempo` AS `tgljatuhtempo`,`v_piutang`.`idkonsumen` AS `idkonsumen`,`v_piutang`.`totaldebet` AS `totaldebet`,`v_piutang`.`totalkredit` AS `totalkredit`,`v_piutang`.`jenissumber` AS `jenissumber`,`v_piutang`.`keterangan` AS `keterangan`,`v_piutang`.`namakonsumen` AS `namakonsumen`,`v_piutang`.`namajenispiutang` AS `namajenispiutang`,`v_piutang`.`jatuhtempo` AS `jatuhtempo`,`v_piutang`.`tglinvoice` AS `tglinvoice`,`v_piutang`.`noinvoice` AS `noinvoice`,`v_piutang`.`idsales` AS `idsales`,`v_piutang`.`namasales` AS `namasales`,`penagihandetail`.`idpenagihan` AS `idpenagihan`,`konsumen`.`idwilayah` AS `idwilayah`,`wilayah`.`namawilayah` AS `namawilayah` from ((((`v_piutang` left join `penagihandetail` on((`v_piutang`.`idpiutang` = `penagihandetail`.`idpiutang`))) join `konsumen` on((`v_piutang`.`idkonsumen` = `konsumen`.`idkonsumen`))) join `suratjalandetail` on((`v_piutang`.`idpenjualan` = `suratjalandetail`.`idpenjualan`))) left join `wilayah` on((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`))) where ((`v_piutang`.`totaldebet` > `v_piutang`.`totalkredit`) and (`penagihandetail`.`idpenagihan` is null)) */;

/*View structure for view v_piutang_laprekap */

/*!50001 DROP TABLE IF EXISTS `v_piutang_laprekap` */;
/*!50001 DROP VIEW IF EXISTS `v_piutang_laprekap` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_piutang_laprekap` AS select `v_piutang`.`idpiutang` AS `idpiutang`,`v_piutang`.`tglpiutang` AS `tglpiutang`,`v_piutang`.`idpenjualan` AS `idpenjualan`,`v_piutang`.`noinvoice` AS `noinvoice`,`v_piutang`.`tglinvoice` AS `tglinvoice`,`v_piutang`.`idkonsumen` AS `idkonsumen`,`v_piutang`.`namakonsumen` AS `namakonsumen`,`v_piutang`.`jatuhtempo` AS `jatuhtempo`,`v_piutang`.`tgljatuhtempo` AS `tgljatuhtempo`,`v_piutang`.`totaldebet` AS `jumlahpiutang`,sum(`piutangdetail`.`kredit`) AS `jumlahdibayar`,`konsumen`.`idwilayah` AS `idwilayah`,`wilayah`.`namawilayah` AS `namawilayah`,`penjualan`.`idsales` AS `idsales`,`sales`.`namasales` AS `namasales` from (((((`v_piutang` join `piutangdetail` on((`v_piutang`.`idpiutang` = `piutangdetail`.`idpiutang`))) join `konsumen` on((`v_piutang`.`idkonsumen` = `konsumen`.`idkonsumen`))) left join `penjualan` on((`v_piutang`.`idpenjualan` = `penjualan`.`idpenjualan`))) left join `wilayah` on((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`))) left join `sales` on((`penjualan`.`idsales` = `sales`.`idsales`))) group by `v_piutang`.`idpiutang`,`v_piutang`.`tglpiutang`,`v_piutang`.`idpenjualan`,`v_piutang`.`noinvoice`,`v_piutang`.`tglinvoice`,`v_piutang`.`idkonsumen`,`v_piutang`.`namakonsumen`,`v_piutang`.`jatuhtempo`,`v_piutang`.`tgljatuhtempo`,`konsumen`.`jumlahpiutang`,`konsumen`.`idwilayah`,`wilayah`.`namawilayah`,`penjualan`.`idsales`,`sales`.`namasales` */;

/*View structure for view v_piutang_penagihan_laporan */

/*!50001 DROP TABLE IF EXISTS `v_piutang_penagihan_laporan` */;
/*!50001 DROP VIEW IF EXISTS `v_piutang_penagihan_laporan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_piutang_penagihan_laporan` AS select `piutang`.`idpiutang` AS `idpiutang`,`piutang`.`idpenjualan` AS `idpenjualan`,`piutang`.`idjenispiutang` AS `idjenispiutang`,`piutang`.`tgljatuhtempo` AS `tgljatuhtempo`,`piutang`.`idkonsumen` AS `idkonsumen`,`piutang`.`tgllunas` AS `tgllunas`,`konsumen`.`namakonsumen` AS `namakonsumen`,`jenispiutang`.`namajenispiutang` AS `namajenispiutang`,`penjualan`.`tglinvoice` AS `tglinvoice`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`totalinvoice` AS `totalinvoice`,`penjualan`.`idsales` AS `idsales`,`sales`.`namasales` AS `namasales`,`wilayah`.`namawilayah` AS `namawilayah`,sum((case when ((to_days(`piutangdetail`.`tglpiutang`) - to_days(`penjualan`.`tglinvoice`)) <= 90) then `piutangdetail`.`kredit` else 0 end)) AS `jumlahlancar`,sum((case when ((to_days(`piutangdetail`.`tglpiutang`) - to_days(`penjualan`.`tglinvoice`)) between 91 and 150) then `piutangdetail`.`kredit` else 0 end)) AS `jumlahlebih90hari`,sum((case when ((to_days(`piutangdetail`.`tglpiutang`) - to_days(`penjualan`.`tglinvoice`)) >= 151) then `piutangdetail`.`kredit` else 0 end)) AS `jumlahlebih150hari`,(case when (`piutang`.`tgllunas` is null) then (to_days(`piutang`.`tgljatuhtempo`) - to_days(now())) else (to_days(`piutang`.`tgljatuhtempo`) - to_days(`piutang`.`tgllunas`)) end) AS `sisaumur` from ((((((`piutang` left join `penjualan` on((`piutang`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `jenispiutang` on((`piutang`.`idjenispiutang` = `jenispiutang`.`idjenispiutang`))) join `konsumen` on((`piutang`.`idkonsumen` = `konsumen`.`idkonsumen`))) left join `sales` on((`penjualan`.`idsales` = `sales`.`idsales`))) left join `wilayah` on((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`))) join `piutangdetail` on((`piutangdetail`.`idpiutang` = `piutang`.`idpiutang`))) group by `piutang`.`idpiutang`,`piutang`.`idpenjualan`,`piutang`.`idjenispiutang`,`piutang`.`tgljatuhtempo`,`piutang`.`idkonsumen`,`piutang`.`tgllunas`,`konsumen`.`namakonsumen`,`jenispiutang`.`namajenispiutang`,`penjualan`.`tglinvoice`,`penjualan`.`noinvoice`,`penjualan`.`totalinvoice`,`penjualan`.`idsales`,`sales`.`namasales`,`wilayah`.`namawilayah` */;

/*View structure for view v_piutangdetail */

/*!50001 DROP TABLE IF EXISTS `v_piutangdetail` */;
/*!50001 DROP VIEW IF EXISTS `v_piutangdetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_piutangdetail` AS select `piutangdetail`.`idpiutangdetail` AS `idpiutangdetail`,`piutangdetail`.`idpiutang` AS `idpiutang`,`piutangdetail`.`tglpiutang` AS `tglpiutang`,`piutangdetail`.`debet` AS `debet`,`piutangdetail`.`kredit` AS `kredit`,`piutangdetail`.`inserted_date` AS `inserted_date`,`piutangdetail`.`updated_date` AS `updated_date`,`piutangdetail`.`idpengguna` AS `idpengguna`,`piutangdetail`.`carabayar` AS `carabayar`,`piutangdetail`.`idbank` AS `idbank`,`piutangdetail`.`jenis` AS `jenis`,`piutang`.`idpenjualan` AS `idpenjualan`,`piutang`.`idjenispiutang` AS `idjenispiutang`,`pengguna`.`namapengguna` AS `namapengguna`,`bank`.`namabank` AS `namabank`,`piutangdetail`.`nokwitansi` AS `nokwitansi`,`piutangdetail`.`nobilyetgiro` AS `nobilyetgiro` from (((`piutangdetail` join `piutang` on((`piutangdetail`.`idpiutang` = `piutang`.`idpiutang`))) join `pengguna` on((`piutangdetail`.`idpengguna` = `pengguna`.`idpengguna`))) left join `bank` on((`piutangdetail`.`idbank` = `bank`.`idbank`))) */;

/*View structure for view v_piutangdetail_bahanjurnal */

/*!50001 DROP TABLE IF EXISTS `v_piutangdetail_bahanjurnal` */;
/*!50001 DROP VIEW IF EXISTS `v_piutangdetail_bahanjurnal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_piutangdetail_bahanjurnal` AS select `piutangdetail`.`idpiutangdetail` AS `idpiutangdetail`,`piutangdetail`.`tglpiutang` AS `tglpiutang`,`piutangdetail`.`kredit` AS `kredit`,`piutangdetail`.`carabayar` AS `carabayar`,`piutangdetail`.`idbank` AS `idbank`,`bank`.`kdakun` AS `kdakunbank`,`piutang`.`totaldebet` AS `totaldebet`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`tglinvoice` AS `tglinvoice` from (((`piutangdetail` join `piutang` on((`piutangdetail`.`idpiutang` = `piutang`.`idpiutang`))) left join `bank` on((`piutangdetail`.`idbank` = `bank`.`idbank`))) join `penjualan` on((`piutang`.`idpenjualan` = `penjualan`.`idpenjualan`))) where (`piutangdetail`.`kredit` <> 0) */;

/*View structure for view v_piutangdetail_laporan */

/*!50001 DROP TABLE IF EXISTS `v_piutangdetail_laporan` */;
/*!50001 DROP VIEW IF EXISTS `v_piutangdetail_laporan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_piutangdetail_laporan` AS select `piutangdetail`.`idpiutangdetail` AS `idpiutangdetail`,`piutangdetail`.`idpiutang` AS `idpiutang`,`piutangdetail`.`tglpiutang` AS `tglpiutang`,`piutangdetail`.`debet` AS `debet`,`piutangdetail`.`kredit` AS `kredit`,`piutangdetail`.`inserted_date` AS `inserted_date`,`piutangdetail`.`updated_date` AS `updated_date`,`piutangdetail`.`idpengguna` AS `idpengguna`,`piutangdetail`.`carabayar` AS `carabayar`,`piutangdetail`.`idbank` AS `idbank`,`piutangdetail`.`jenis` AS `jenis`,`piutang`.`idpenjualan` AS `idpenjualan`,`piutang`.`idjenispiutang` AS `idjenispiutang`,`pengguna`.`namapengguna` AS `namapengguna`,`bank`.`namabank` AS `namabank`,`piutangdetail`.`nokwitansi` AS `nokwitansi`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`tglinvoice` AS `tglinvoice`,`penjualan`.`idkonsumen` AS `idkonsumen`,`piutang`.`totaldebet` AS `totaldebet`,`piutang`.`totalkredit` AS `totalkredit`,`penjualan`.`idsales` AS `idsales`,`sales`.`namasales` AS `namasales`,`konsumen`.`namakonsumen` AS `namakonsumen`,`konsumen`.`idwilayah` AS `idwilayah`,`wilayah`.`namawilayah` AS `namawilayah` from (((((((`piutangdetail` join `piutang` on((`piutangdetail`.`idpiutang` = `piutang`.`idpiutang`))) join `pengguna` on((`piutangdetail`.`idpengguna` = `pengguna`.`idpengguna`))) left join `bank` on((`piutangdetail`.`idbank` = `bank`.`idbank`))) join `penjualan` on((`piutang`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `konsumen` on((`piutang`.`idkonsumen` = `konsumen`.`idkonsumen`))) left join `sales` on((`penjualan`.`idsales` = `sales`.`idsales`))) left join `wilayah` on((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`))) */;

/*View structure for view v_postingjurnal */

/*!50001 DROP TABLE IF EXISTS `v_postingjurnal` */;
/*!50001 DROP VIEW IF EXISTS `v_postingjurnal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_postingjurnal` AS select `postingjurnal`.`idposting` AS `idposting`,`postingjurnal`.`bulan` AS `bulan`,`postingjurnal`.`tahun` AS `tahun`,`postingjurnal`.`jumlahdebet` AS `jumlahdebet`,`postingjurnal`.`jumlahkredit` AS `jumlahkredit`,`postingjurnal`.`inserted_date` AS `inserted_date`,`postingjurnal`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`postingjurnal` join `pengguna` on((`postingjurnal`.`idpengguna` = `pengguna`.`idpengguna`))) */;

/*View structure for view v_returpembelian */

/*!50001 DROP TABLE IF EXISTS `v_returpembelian` */;
/*!50001 DROP VIEW IF EXISTS `v_returpembelian` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returpembelian` AS select `returpembelian`.`idreturpembelian` AS `idreturpembelian`,`returpembelian`.`idpembelian` AS `idpembelian`,`returpembelian`.`tglretur` AS `tglretur`,`returpembelian`.`totalretur` AS `totalretur`,`returpembelian`.`keterangan` AS `keterangan`,`returpembelian`.`inserted_date` AS `inserted_date`,`returpembelian`.`updated_date` AS `updated_date`,`returpembelian`.`idpengguna` AS `idpengguna`,`returpembelian`.`carabayar` AS `carabayar`,`returpembelian`.`idbank` AS `idbank`,`returpembelian`.`statusretur` AS `statusretur`,`returpembelian`.`tglpengajuan` AS `tglpengajuan`,`bank`.`namabank` AS `namabank`,`bank`.`cabang` AS `cabang`,`bank`.`norekening` AS `norekening`,`bank`.`kdakun` AS `kdakunbank`,`pengguna`.`namapengguna` AS `namapengguna`,`pembelian`.`idsupplier` AS `idsupplier`,`supplier`.`namasupplier` AS `namasupplier`,`pembelian`.`tglfaktur` AS `tglfaktur`,`pembelian`.`nofaktur` AS `nofaktur` from ((((`returpembelian` join `pembelian` on((`returpembelian`.`idpembelian` = `pembelian`.`idpembelian`))) join `pengguna` on((`returpembelian`.`idpengguna` = `pengguna`.`idpengguna`))) left join `bank` on((`returpembelian`.`idbank` = `bank`.`idbank`))) join `supplier` on((`pembelian`.`idsupplier` = `supplier`.`idsupplier`))) */;

/*View structure for view v_returpembeliandetail */

/*!50001 DROP TABLE IF EXISTS `v_returpembeliandetail` */;
/*!50001 DROP VIEW IF EXISTS `v_returpembeliandetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returpembeliandetail` AS select `returpembeliandetail`.`idreturdetail` AS `idreturdetail`,`returpembeliandetail`.`idreturpembelian` AS `idreturpembelian`,`returpembeliandetail`.`idbarang` AS `idbarang`,`returpembeliandetail`.`jumlahretur` AS `jumlahretur`,`returpembeliandetail`.`hargaretur` AS `hargaretur`,`returpembeliandetail`.`subtotalretur` AS `subtotalretur`,`returpembelian`.`idpembelian` AS `idpembelian`,`returpembelian`.`tglretur` AS `tglretur`,`barang`.`namabarang` AS `namabarang`,`barang`.`idkategori` AS `idkategori`,`kategoribarang`.`namakategori` AS `namakategori` from (((`returpembeliandetail` join `returpembelian` on((`returpembeliandetail`.`idreturpembelian` = `returpembelian`.`idreturpembelian`))) join `barang` on((`returpembeliandetail`.`idbarang` = `barang`.`idbarang`))) join `kategoribarang` on((`barang`.`idkategori` = `kategoribarang`.`idkategori`))) */;

/*View structure for view v_returpembeliandetail_bahanjurnal */

/*!50001 DROP TABLE IF EXISTS `v_returpembeliandetail_bahanjurnal` */;
/*!50001 DROP VIEW IF EXISTS `v_returpembeliandetail_bahanjurnal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returpembeliandetail_bahanjurnal` AS select `returpembelian`.`idreturpembelian` AS `idreturpembelian`,`returpembelian`.`tglretur` AS `tglretur`,`returpembelian`.`totalretur` AS `totalretur`,`barang`.`kdakun` AS `kdakunbarang`,sum(`returpembeliandetail`.`subtotalretur`) AS `subtotalretur`,`returpembelian`.`keterangan` AS `keterangan`,`pembelian`.`nofaktur` AS `nofaktur`,`pembelian`.`tglfaktur` AS `tglfaktur`,`returpembelian`.`carabayar` AS `carabayar`,`bank`.`kdakun` AS `kdakunbank` from ((((`returpembeliandetail` join `returpembelian` on((`returpembeliandetail`.`idreturpembelian` = `returpembelian`.`idreturpembelian`))) join `barang` on((`returpembeliandetail`.`idbarang` = `barang`.`idbarang`))) left join `bank` on((`returpembelian`.`idbank` = `bank`.`idbank`))) join `pembelian` on((`returpembelian`.`idpembelian` = `pembelian`.`idpembelian`))) group by `returpembelian`.`idreturpembelian`,`returpembelian`.`tglretur`,`returpembelian`.`totalretur`,`kdakunbarang`,`returpembelian`.`keterangan`,`pembelian`.`nofaktur`,`pembelian`.`tglfaktur`,`returpembelian`.`carabayar`,`kdakunbank` */;

/*View structure for view v_returpembeliandetail_laporan */

/*!50001 DROP TABLE IF EXISTS `v_returpembeliandetail_laporan` */;
/*!50001 DROP VIEW IF EXISTS `v_returpembeliandetail_laporan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returpembeliandetail_laporan` AS select `returpembelian`.`idreturpembelian` AS `idreturpembelian`,`returpembelian`.`tglretur` AS `tglretur`,`returpembelian`.`totalretur` AS `totalretur`,`returpembelian`.`keterangan` AS `keterangan`,`returpembelian`.`carabayar` AS `carabayar`,`returpembelian`.`idbank` AS `idbank`,`returpembelian`.`statusretur` AS `statusretur`,`returpembelian`.`tglpengajuan` AS `tglpengajuan`,`bank`.`namabank` AS `namabank`,`returpembelian`.`idpembelian` AS `idpembelian`,`pembelian`.`nofaktur` AS `nofaktur`,`pembelian`.`tglfaktur` AS `tglfaktur`,`pembelian`.`idsupplier` AS `idsupplier`,`supplier`.`namasupplier` AS `namasupplier`,`returpembeliandetail`.`idreturdetail` AS `idreturdetail`,`returpembeliandetail`.`idbarang` AS `idbarang`,`barang`.`namabarang` AS `namabarang`,`barang`.`kdakun` AS `kdakunbarang`,`returpembeliandetail`.`jumlahretur` AS `jumlahretur`,`returpembeliandetail`.`hargaretur` AS `hargaretur`,`returpembeliandetail`.`subtotalretur` AS `subtotalretur` from (((((`returpembeliandetail` join `returpembelian` on((`returpembeliandetail`.`idreturpembelian` = `returpembelian`.`idreturpembelian`))) join `pembelian` on((`returpembelian`.`idpembelian` = `pembelian`.`idpembelian`))) left join `bank` on((`returpembelian`.`idbank` = `bank`.`idbank`))) join `barang` on((`returpembeliandetail`.`idbarang` = `barang`.`idbarang`))) join `supplier` on((`pembelian`.`idsupplier` = `supplier`.`idsupplier`))) */;

/*View structure for view v_returpenjualan */

/*!50001 DROP TABLE IF EXISTS `v_returpenjualan` */;
/*!50001 DROP VIEW IF EXISTS `v_returpenjualan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returpenjualan` AS select `returpenjualan`.`idreturpenjualan` AS `idreturpenjualan`,`returpenjualan`.`idpenjualan` AS `idpenjualan`,`returpenjualan`.`tglretur` AS `tglretur`,`returpenjualan`.`totalretur` AS `totalretur`,`returpenjualan`.`keterangan` AS `keterangan`,`returpenjualan`.`inserted_date` AS `inserted_date`,`returpenjualan`.`updated_date` AS `updated_date`,`returpenjualan`.`idpengguna` AS `idpengguna`,`returpenjualan`.`carabayar` AS `carabayar`,`returpenjualan`.`idbank` AS `idbank`,`penjualan`.`idkonsumen` AS `idkonsumen`,`penjualan`.`tglinvoice` AS `tglinvoice`,`penjualan`.`noinvoice` AS `noinvoice`,`konsumen`.`namakonsumen` AS `namakonsumen`,`bank`.`namabank` AS `namabank`,`bank`.`cabang` AS `cabang`,`bank`.`norekening` AS `norekening`,`pengguna`.`namapengguna` AS `namapengguna` from ((((`returpenjualan` join `penjualan` on((`returpenjualan`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `pengguna` on((`returpenjualan`.`idpengguna` = `pengguna`.`idpengguna`))) left join `bank` on((`returpenjualan`.`idbank` = `bank`.`idbank`))) left join `konsumen` on((`penjualan`.`idkonsumen` = `konsumen`.`idkonsumen`))) */;

/*View structure for view v_returpenjualandetail */

/*!50001 DROP TABLE IF EXISTS `v_returpenjualandetail` */;
/*!50001 DROP VIEW IF EXISTS `v_returpenjualandetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returpenjualandetail` AS select `returpenjualandetail`.`idreturdetail` AS `idreturdetail`,`returpenjualandetail`.`idreturpenjualan` AS `idreturpenjualan`,`returpenjualandetail`.`idbarang` AS `idbarang`,`returpenjualandetail`.`jumlahretur` AS `jumlahretur`,`returpenjualandetail`.`hargaretur` AS `hargaretur`,`returpenjualandetail`.`subtotalretur` AS `subtotalretur`,`returpenjualan`.`idpenjualan` AS `idpenjualan`,`returpenjualan`.`tglretur` AS `tglretur`,`barang`.`namabarang` AS `namabarang`,`barang`.`idkategori` AS `idkategori`,`barang`.`kdakun` AS `kdakun`,`kategoribarang`.`namakategori` AS `namakategori` from (((`returpenjualandetail` join `returpenjualan` on((`returpenjualandetail`.`idreturpenjualan` = `returpenjualan`.`idreturpenjualan`))) join `barang` on((`returpenjualandetail`.`idbarang` = `barang`.`idbarang`))) join `kategoribarang` on((`barang`.`idkategori` = `kategoribarang`.`idkategori`))) */;

/*View structure for view v_returpenjualandetail_bahanjurnal */

/*!50001 DROP TABLE IF EXISTS `v_returpenjualandetail_bahanjurnal` */;
/*!50001 DROP VIEW IF EXISTS `v_returpenjualandetail_bahanjurnal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returpenjualandetail_bahanjurnal` AS select `returpenjualandetail`.`idreturpenjualan` AS `idreturpenjualan`,`returpenjualan`.`tglretur` AS `tglretur`,`barang`.`kdakun` AS `kdakunbarang`,sum(`returpenjualandetail`.`subtotalretur`) AS `subtotalretur`,`returpenjualan`.`carabayar` AS `carabayar`,`bank`.`kdakun` AS `kdakunbank`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`tglinvoice` AS `tglinvoice`,`returpenjualan`.`totalretur` AS `totalretur` from ((((`returpenjualandetail` join `returpenjualan` on((`returpenjualandetail`.`idreturpenjualan` = `returpenjualan`.`idreturpenjualan`))) join `barang` on((`returpenjualandetail`.`idbarang` = `barang`.`idbarang`))) left join `bank` on((`returpenjualan`.`idbank` = `bank`.`idbank`))) join `penjualan` on((`returpenjualan`.`idpenjualan` = `penjualan`.`idpenjualan`))) group by `returpenjualandetail`.`idreturpenjualan`,`returpenjualan`.`tglretur`,`kdakunbarang`,`returpenjualan`.`carabayar`,`kdakunbank`,`penjualan`.`noinvoice`,`penjualan`.`tglinvoice`,`returpenjualan`.`totalretur` */;

/*View structure for view v_returpenjualandetail_laporan */

/*!50001 DROP TABLE IF EXISTS `v_returpenjualandetail_laporan` */;
/*!50001 DROP VIEW IF EXISTS `v_returpenjualandetail_laporan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_returpenjualandetail_laporan` AS select `returpenjualandetail`.`idreturdetail` AS `idreturdetail`,`returpenjualandetail`.`idreturpenjualan` AS `idreturpenjualan`,`returpenjualandetail`.`idbarang` AS `idbarang`,`returpenjualandetail`.`jumlahretur` AS `jumlahretur`,`returpenjualandetail`.`hargaretur` AS `hargaretur`,`returpenjualandetail`.`subtotalretur` AS `subtotalretur`,`barang`.`namabarang` AS `namabarang`,`barang`.`idkategori` AS `idkategori`,`barang`.`kdakun` AS `kdakunbarang`,`returpenjualan`.`idpenjualan` AS `idpenjualan`,`returpenjualan`.`tglretur` AS `tglretur`,`returpenjualan`.`totalretur` AS `totalretur`,`returpenjualan`.`keterangan` AS `keterangan`,`returpenjualan`.`carabayar` AS `carabayar`,`returpenjualan`.`idbank` AS `idbank`,`bank`.`namabank` AS `namabank`,`bank`.`cabang` AS `cabang`,`bank`.`norekening` AS `norekening`,`bank`.`atasnama` AS `atasnama`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`tglinvoice` AS `tglinvoice`,`penjualan`.`totalinvoice` AS `totalinvoice`,`penjualan`.`idsales` AS `idsales`,`sales`.`namasales` AS `namasales`,`konsumen`.`namakonsumen` AS `namakonsumen`,`konsumen`.`alamatkonsumen` AS `alamatkonsumen`,`konsumen`.`idwilayah` AS `idwilayah`,`wilayah`.`namawilayah` AS `namawilayah` from (((((((`returpenjualandetail` join `returpenjualan` on((`returpenjualandetail`.`idreturpenjualan` = `returpenjualan`.`idreturpenjualan`))) join `penjualan` on((`returpenjualan`.`idpenjualan` = `penjualan`.`idpenjualan`))) left join `bank` on((`returpenjualan`.`idbank` = `bank`.`idbank`))) join `barang` on((`returpenjualandetail`.`idbarang` = `barang`.`idbarang`))) join `konsumen` on((`penjualan`.`idkonsumen` = `konsumen`.`idkonsumen`))) left join `sales` on((`penjualan`.`idsales` = `sales`.`idsales`))) left join `wilayah` on((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`))) */;

/*View structure for view v_saldoawal */

/*!50001 DROP TABLE IF EXISTS `v_saldoawal` */;
/*!50001 DROP VIEW IF EXISTS `v_saldoawal` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_saldoawal` AS select `saldoawal`.`idsaldoawal` AS `idsaldoawal`,`saldoawal`.`tahun` AS `tahun`,`saldoawal`.`totaldebet` AS `totaldebet`,`saldoawal`.`totalkredit` AS `totalkredit`,`saldoawal`.`inserted_date` AS `inserted_date`,`saldoawal`.`updated_date` AS `updated_date`,`saldoawal`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`saldoawal` join `pengguna` on((`saldoawal`.`idpengguna` = `pengguna`.`idpengguna`))) */;

/*View structure for view v_saldoawaldetail */

/*!50001 DROP TABLE IF EXISTS `v_saldoawaldetail` */;
/*!50001 DROP VIEW IF EXISTS `v_saldoawaldetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_saldoawaldetail` AS select `saldoawaldetail`.`idsaldoawal` AS `idsaldoawal`,`saldoawaldetail`.`kdakun` AS `kdakun`,`saldoawaldetail`.`debet` AS `debet`,`saldoawaldetail`.`kredit` AS `kredit`,`akun`.`namaakun` AS `namaakun`,`akun`.`kdparent` AS `kdparent`,`saldoawal`.`tahun` AS `tahun` from ((`saldoawaldetail` join `saldoawal` on((`saldoawaldetail`.`idsaldoawal` = `saldoawal`.`idsaldoawal`))) join `akun` on((`saldoawaldetail`.`kdakun` = `akun`.`kdakun`))) */;

/*View structure for view v_saleswilayah */

/*!50001 DROP TABLE IF EXISTS `v_saleswilayah` */;
/*!50001 DROP VIEW IF EXISTS `v_saleswilayah` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_saleswilayah` AS select `saleswilayah`.`idsaleswilayah` AS `idsaleswilayah`,`saleswilayah`.`idsales` AS `idsales`,`sales`.`namasales` AS `namasales`,`saleswilayah`.`idwilayah` AS `idwilayah`,`wilayah`.`namawilayah` AS `namawilayah` from ((`saleswilayah` join `sales` on((`saleswilayah`.`idsales` = `sales`.`idsales`))) join `wilayah` on((`saleswilayah`.`idwilayah` = `wilayah`.`idwilayah`))) */;

/*View structure for view v_stockopname */

/*!50001 DROP TABLE IF EXISTS `v_stockopname` */;
/*!50001 DROP VIEW IF EXISTS `v_stockopname` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stockopname` AS select `stockopname`.`idstockopname` AS `idstockopname`,`stockopname`.`tglstockopname` AS `tglstockopname`,`stockopname`.`keterangan` AS `keterangan`,`stockopname`.`inserted_date` AS `inserted_date`,`stockopname`.`updated_date` AS `updated_date`,`stockopname`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna` from (`stockopname` join `pengguna` on((`stockopname`.`idpengguna` = `pengguna`.`idpengguna`))) */;

/*View structure for view v_stockopnamedetail */

/*!50001 DROP TABLE IF EXISTS `v_stockopnamedetail` */;
/*!50001 DROP VIEW IF EXISTS `v_stockopnamedetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stockopnamedetail` AS select `stockopnamedetail`.`idstockopnamedetail` AS `idstockopnamedetail`,`stockopnamedetail`.`idstockopname` AS `idstockopname`,`stockopnamedetail`.`idbarang` AS `idbarang`,`stockopnamedetail`.`stocksystem` AS `stocksystem`,`stockopnamedetail`.`stockopname` AS `stockopname`,`stockopnamedetail`.`keterangandetail` AS `keterangandetail`,`stockopname`.`tglstockopname` AS `tglstockopname`,`barang`.`namabarang` AS `namabarang`,`barang`.`idkategori` AS `idkategori`,`kategoribarang`.`namakategori` AS `namakategori` from (((`stockopnamedetail` join `stockopname` on((`stockopnamedetail`.`idstockopname` = `stockopname`.`idstockopname`))) join `barang` on((`stockopnamedetail`.`idbarang` = `barang`.`idbarang`))) join `kategoribarang` on((`barang`.`idkategori` = `kategoribarang`.`idkategori`))) */;

/*View structure for view v_supplier */

/*!50001 DROP TABLE IF EXISTS `v_supplier` */;
/*!50001 DROP VIEW IF EXISTS `v_supplier` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_supplier` AS select `supplier`.`idsupplier` AS `idsupplier`,`supplier`.`namasupplier` AS `namasupplier`,`supplier`.`alamatsupplier` AS `alamatsupplier`,`supplier`.`kontakperson` AS `kontakperson`,`supplier`.`notelp` AS `notelp`,`supplier`.`email` AS `email`,`supplier`.`saldo` AS `saldo`,`supplier`.`saldopajak` AS `saldopajak`,`supplier`.`inserted_date` AS `inserted_date`,`supplier`.`updated_date` AS `updated_date`,`supplier`.`statusaktif` AS `statusaktif`,`supplier`.`npwp` AS `npwp`,`supplier`.`kdakunutang` AS `kdakunutang`,`akun`.`namaakun` AS `namaakunutang` from (`supplier` left join `akun` on((`supplier`.`kdakunutang` = `akun`.`kdakun`))) */;

/*View structure for view v_suratjalan */

/*!50001 DROP TABLE IF EXISTS `v_suratjalan` */;
/*!50001 DROP VIEW IF EXISTS `v_suratjalan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_suratjalan` AS select `suratjalan`.`idsuratjalan` AS `idsuratjalan`,`suratjalan`.`tglsuratjalan` AS `tglsuratjalan`,`suratjalan`.`idkonsumen` AS `idkonsumen`,`suratjalan`.`tglcetak` AS `tglcetak`,`suratjalan`.`keterangan` AS `keterangan`,`suratjalan`.`inserted_date` AS `inserted_date`,`suratjalan`.`updated_date` AS `updated_date`,`suratjalan`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna`,`suratjalan`.`totaltagihan` AS `totaltagihan`,`suratjalan`.`idekspedisi` AS `idekspedisi`,`suratjalan`.`idjenisekspedisi` AS `idjenisekspedisi`,`suratjalan`.`identitasekspedisi` AS `identitasekspedisi`,`suratjalan`.`biayapengiriman` AS `biayapengiriman`,`suratjalan`.`rincianinputmanual` AS `rincianinputmanual`,`ekspedisi`.`namaekspedisi` AS `namaekspedisi`,`jenisekspedisi`.`namajenisekspedisi` AS `namajenisekspedisi`,`konsumen`.`namakonsumen` AS `namakonsumen`,`konsumen`.`alamatkonsumen` AS `alamatkonsumen`,`konsumen`.`notelpkonsumen` AS `notelpkonsumen`,`konsumen`.`emailkonsumen` AS `emailkonsumen`,`konsumen`.`nikpemilik` AS `nikpemilik`,`konsumen`.`namapemilik` AS `namapemilik`,`konsumen`.`notelppemilik` AS `notelppemilik`,`konsumen`.`nowapemilik` AS `nowapemilik`,`konsumen`.`npwp` AS `npwp`,`wilayah`.`namawilayah` AS `namawilayah` from (((((`suratjalan` join `pengguna` on((`suratjalan`.`idpengguna` = `pengguna`.`idpengguna`))) join `ekspedisi` on((`suratjalan`.`idekspedisi` = `ekspedisi`.`idekspedisi`))) join `jenisekspedisi` on((`suratjalan`.`idjenisekspedisi` = `jenisekspedisi`.`idjenisekspedisi`))) join `konsumen` on((`suratjalan`.`idkonsumen` = `konsumen`.`idkonsumen`))) left join `wilayah` on((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`))) */;

/*View structure for view v_suratjalan_detail_barang */

/*!50001 DROP TABLE IF EXISTS `v_suratjalan_detail_barang` */;
/*!50001 DROP VIEW IF EXISTS `v_suratjalan_detail_barang` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_suratjalan_detail_barang` AS select `suratjalan`.`idsuratjalan` AS `idsuratjalan`,`suratjalan`.`tglsuratjalan` AS `tglsuratjalan`,`suratjalandetail`.`idpenjualan` AS `idpenjualan`,`penjualandetail`.`idbarang` AS `idbarang`,`barang`.`namabarang` AS `namabarang`,`penjualandetail`.`jumlahjual` AS `jumlahjual`,`penjualandetail`.`hargasatuan` AS `hargasatuan`,`penjualandetail`.`hargadpp` AS `hargadpp`,`penjualandetail`.`jumlahppn` AS `jumlahppn`,`penjualandetail`.`jumlahdiskon` AS `jumlahdiskon`,`penjualandetail`.`subtotaljual` AS `subtotaljual` from ((((`suratjalandetail` join `suratjalan` on((`suratjalandetail`.`idsuratjalan` = `suratjalan`.`idsuratjalan`))) join `penjualan` on((`suratjalandetail`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `penjualandetail` on((`penjualandetail`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `barang` on((`penjualandetail`.`idbarang` = `barang`.`idbarang`))) */;

/*View structure for view v_suratjalan_groupconcat */

/*!50001 DROP TABLE IF EXISTS `v_suratjalan_groupconcat` */;
/*!50001 DROP VIEW IF EXISTS `v_suratjalan_groupconcat` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_suratjalan_groupconcat` AS select `v_suratjalan`.`idsuratjalan` AS `idsuratjalan`,`v_suratjalan`.`tglsuratjalan` AS `tglsuratjalan`,`v_suratjalan`.`idkonsumen` AS `idkonsumen`,`v_suratjalan`.`namakonsumen` AS `namakonsumen`,`v_suratjalan`.`idjenisekspedisi` AS `idjenisekspedisi`,`v_suratjalan`.`namajenisekspedisi` AS `namajenisekspedisi`,`v_suratjalan`.`idekspedisi` AS `idekspedisi`,`v_suratjalan`.`namaekspedisi` AS `namaekspedisi`,`v_suratjalan`.`identitasekspedisi` AS `identitasekspedisi`,`v_suratjalan`.`biayapengiriman` AS `biayapengiriman`,`v_suratjalan`.`rincianinputmanual` AS `rincianinputmanual`,group_concat(`v_suratjalandetail`.`noinvoice` separator ' & ') AS `daftarnoinvoice` from (`v_suratjalan` join `v_suratjalandetail` on((`v_suratjalan`.`idsuratjalan` = `v_suratjalandetail`.`idsuratjalan`))) group by `v_suratjalan`.`idsuratjalan`,`v_suratjalan`.`tglsuratjalan`,`v_suratjalan`.`idkonsumen`,`v_suratjalan`.`namakonsumen`,`v_suratjalan`.`idjenisekspedisi`,`v_suratjalan`.`namajenisekspedisi`,`v_suratjalan`.`idekspedisi`,`v_suratjalan`.`namaekspedisi`,`v_suratjalan`.`identitasekspedisi`,`v_suratjalan`.`biayapengiriman`,`v_suratjalan`.`rincianinputmanual` */;

/*View structure for view v_suratjalan_sudah_ada_penagihan */

/*!50001 DROP TABLE IF EXISTS `v_suratjalan_sudah_ada_penagihan` */;
/*!50001 DROP VIEW IF EXISTS `v_suratjalan_sudah_ada_penagihan` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_suratjalan_sudah_ada_penagihan` AS select `suratjalandetail`.`iddetailsuratjalan` AS `iddetailsuratjalan`,`suratjalandetail`.`idsuratjalan` AS `idsuratjalan`,`suratjalandetail`.`idpenjualan` AS `idpenjualan`,`piutang`.`idpiutang` AS `idpiutang`,`penagihandetail`.`jumlahtagihan` AS `jumlahtagihan` from ((`suratjalandetail` join `piutang` on((`suratjalandetail`.`idpenjualan` = `piutang`.`idpenjualan`))) join `penagihandetail` on((`piutang`.`idpiutang` = `penagihandetail`.`idpiutang`))) */;

/*View structure for view v_suratjalandetail */

/*!50001 DROP TABLE IF EXISTS `v_suratjalandetail` */;
/*!50001 DROP VIEW IF EXISTS `v_suratjalandetail` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_suratjalandetail` AS select `suratjalandetail`.`iddetailsuratjalan` AS `iddetailsuratjalan`,`suratjalandetail`.`idsuratjalan` AS `idsuratjalan`,`suratjalandetail`.`idpenjualan` AS `idpenjualan`,`suratjalan`.`tglsuratjalan` AS `tglsuratjalan`,`penjualan`.`noinvoice` AS `noinvoice`,`penjualan`.`tglinvoice` AS `tglinvoice`,`penjualan`.`totalinvoice` AS `totalinvoice`,`penjualan`.`idkonsumen` AS `idkonsumen`,`konsumen`.`namakonsumen` AS `namakonsumen`,`konsumen`.`alamatkonsumen` AS `alamatkonsumen`,`konsumen`.`notelpkonsumen` AS `notelpkonsumen`,`konsumen`.`namapemilik` AS `namapemilik`,`konsumen`.`notelppemilik` AS `notelppemilik`,`konsumen`.`idwilayah` AS `idwilayah`,`wilayah`.`namawilayah` AS `namawilayah`,`penjualan`.`idsales` AS `idsales`,`sales`.`namasales` AS `namasales`,`sales`.`npwp` AS `npwp` from (((((`suratjalandetail` join `suratjalan` on((`suratjalandetail`.`idsuratjalan` = `suratjalan`.`idsuratjalan`))) join `penjualan` on((`suratjalandetail`.`idpenjualan` = `penjualan`.`idpenjualan`))) join `konsumen` on((`penjualan`.`idkonsumen` = `konsumen`.`idkonsumen`))) left join `sales` on((`penjualan`.`idsales` = `sales`.`idsales`))) left join `wilayah` on((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
