/*
SQLyog Enterprise v10.42 
MySQL - 8.0.30 : Database - pointofsales
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`pointofsales` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `pointofsales`;

/*Table structure for table `akun` */

DROP TABLE IF EXISTS `akun`;

CREATE TABLE `akun` (
  `kdakun` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namaakun` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdparent` char(7) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `levels` int DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`kdakun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `akun` */

insert  into `akun`(`kdakun`,`namaakun`,`kdparent`,`levels`,`statusaktif`,`inserted_date`,`updated_date`) values ('1','Aset',NULL,1,'Aktif','2025-02-14 01:47:42','2025-02-14 06:17:20'),('1.1','Aset Lancar','1',2,'Aktif','2025-02-14 06:25:44','2025-02-14 07:19:50'),('1.1.01','Kas','1.1',3,'Aktif','2025-02-14 07:49:21','2025-02-14 07:52:15'),('1.1.01.01','Kas Tunai','1.1.01',4,'Aktif','2025-02-14 08:09:12','2025-03-16 17:31:58'),('1.1.01.02','Rekening May Bank','1.1.01',4,'Aktif','2025-02-14 08:12:41','2025-05-10 04:06:51'),('1.1.01.03','Rekening BCA','1.1.01',4,'Aktif','2025-03-16 17:32:13','2025-03-16 17:32:13'),('1.1.02','Persediaan Barang Dagang','1.1',3,'Aktif','2025-02-14 07:50:14','2025-02-14 07:50:14'),('1.1.02.01','Persediaan Bahan Baku','1.1.02',4,'Aktif','2025-02-14 08:22:10','2025-02-14 08:22:10'),('1.1.03','Piutang','1.1',3,'Aktif','2025-02-14 07:50:34','2025-03-16 18:13:52'),('1.1.03.01','Piutang Usaha','1.1.03',4,'Aktif','2025-03-16 18:13:37','2025-03-16 18:13:37'),('1.2','Aset Tidak Lancar','1',2,'Aktif','2025-02-14 06:26:10','2025-02-14 06:26:10'),('2','Liabilitas',NULL,1,'Aktif','2025-02-14 01:50:45','2025-02-14 06:17:37'),('2.1','Liabilitas Jangka Panjang','2',2,'Aktif','2025-02-14 06:38:40','2025-02-14 06:38:40'),('2.1.01','Utang','2.1',3,'Aktif','2025-03-17 05:17:27','2025-03-17 05:17:27'),('2.1.01.01','Utang Usaha (Ekspedisi)','2.1.01',4,'Aktif','2025-03-17 05:17:46','2025-05-20 14:53:48'),('2.2','Liabilitas Jangka Pendek','2',2,'Aktif','2025-02-14 06:39:03','2025-02-14 06:39:03'),('2.2.01','Utang Jangka Pendek','2.2',3,'Aktif','2025-04-25 06:32:42','2025-04-25 06:32:42'),('2.2.01.01','Utang Usaha (Supplier)','2.2.01',4,'Aktif','2025-04-25 06:33:34','2025-04-25 06:33:34'),('2.2.01.02','Utang Pajak (PPN Keluaran)','2.2.01',4,'Aktif','2025-04-25 06:34:03','2025-04-25 06:56:37'),('2.2.01.03','Utang Gaji','2.2.01',4,'Aktif','2025-04-25 06:34:23','2025-04-25 06:34:23'),('3','Modal',NULL,1,'Aktif','2025-02-14 01:50:54','2025-02-14 01:56:18'),('3.1','Modal','3',2,'Aktif','2025-04-25 14:38:46','2025-04-25 14:38:46'),('3.1.01','Modal','3.1',3,'Aktif','2025-04-25 14:39:00','2025-04-25 14:39:00'),('3.1.01.01','Modal Pemilik','3.1.01',4,'Aktif','2025-04-25 14:40:00','2025-04-25 14:40:00'),('4','Pendapatan',NULL,1,'Aktif','2025-02-14 01:51:58','2025-02-14 06:18:21'),('4.1','Pendapatan Usaha','4',2,'Aktif','2025-02-14 07:23:06','2025-02-14 07:23:06'),('4.1.01','Penjualan Usaha Dagang','4.1',3,'Aktif','2025-03-08 08:51:19','2025-03-08 08:51:19'),('4.1.01.01','Penjualan Barang Dagang','4.1.01',4,'Aktif','2025-03-08 08:52:10','2025-03-08 08:52:10'),('4.2','Pendapatan Diluar Usaha','4',2,'Aktif','2025-02-14 07:23:44','2025-02-14 07:23:44'),('4.2.01','Pendapatan Sewa','4.2',3,'Aktif','2025-03-08 08:51:34','2025-03-08 08:53:15'),('4.2.01.01','Pendapatan Sewa Truk','4.2.01',4,'Aktif','2025-03-08 08:52:33','2025-03-08 08:52:47'),('5','Beban',NULL,1,'Aktif','2025-02-14 01:52:15','2025-02-14 06:18:05'),('5.1','Beban Gaji','5',2,'Aktif','2025-02-14 07:33:40','2025-02-14 07:33:40'),('5.1.01','Gaji Pegawai','5.1',3,'Aktif','2025-03-08 07:26:30','2025-03-08 07:26:30'),('5.1.01.01','Gaji Pokok Pegawai','5.1.01',4,'Aktif','2025-03-08 07:37:31','2025-03-08 07:37:31'),('5.1.01.02','Gaji Tunjangan Pegawai','5.1.01',4,'Aktif','2025-03-08 07:37:45','2025-03-08 07:37:45'),('5.1.02','Gaji Non Pegawai','5.1',3,'Aktif','2025-03-08 07:26:54','2025-03-08 07:26:54'),('5.1.02.01','Upah Harian Non Pegawai','5.1.02',4,'Aktif','2025-03-08 07:38:08','2025-03-08 07:39:00'),('5.1.02.02','Upah Bulanan Non Pegawai','5.1.02',4,'Aktif','2025-03-08 07:38:27','2025-03-08 07:39:13'),('5.2','Beban Jasa','5',2,'Aktif','2025-02-14 07:34:55','2025-02-14 07:34:55'),('5.2.01','Jasa Pemeliharaan Barang Kantor','5.2',3,'Aktif','2025-03-08 07:33:17','2025-03-08 07:35:54'),('5.2.01.01','Jasa Pemeliharaan AC / Pendingin Ruangan','5.2.01',4,'Aktif','2025-03-08 07:39:44','2025-03-08 07:43:10'),('5.2.01.03','Jasa Pemeliharaan Komputer/ Laptop','5.2.01',4,'Aktif','2025-03-08 07:42:51','2025-03-08 07:43:20'),('5.2.02','Jasa Pemeliharaan Software','5.2',3,'Aktif','2025-03-08 07:33:54','2025-03-08 07:36:04'),('5.2.02.01','Jasa Pemeliharaan Web Aplikasi POS','5.2.02',4,'Aktif','2025-03-08 07:40:40','2025-03-08 07:43:37'),('5.3','Beban Peralatan dan Perlengkapan Kantor','5',2,'Aktif','2025-02-14 07:35:23','2025-02-14 07:35:23'),('5.3.01','Beban Barang Habis Pakai','5.3',3,'Aktif','2025-03-08 07:35:03','2025-03-08 07:36:16'),('5.3.01.01','Beban Kertas F4','5.3.01',4,'Aktif','2025-03-08 07:41:12','2025-03-08 07:41:12'),('5.3.01.02','Beban Kertas Blanko Kwitansi','5.3.01',4,'Aktif','2025-03-08 07:41:49','2025-03-08 07:41:49'),('5.3.02','Beban Peralatan Kantor','5.3',3,'Aktif','2025-03-08 07:36:37','2025-03-08 07:36:37'),('5.3.02.01','Beban Komputer/ PC','5.3.02',4,'Aktif','2025-03-08 07:42:12','2025-03-08 07:42:12'),('5.3.02.02','Beban Laptop','5.3.02',4,'Aktif','2025-03-08 07:42:26','2025-03-08 07:42:26'),('5.3.03','Beban Perlengkapan Kantor','5.3',3,'Aktif','2025-03-08 07:36:56','2025-03-08 07:37:05'),('5.3.03.01','Beban Lemari Berkas','5.3.03',4,'Aktif','2025-03-08 07:44:10','2025-03-08 07:44:10'),('5.4','Beban Operasional','5',2,'Aktif','2025-04-25 06:43:55','2025-04-25 06:43:55'),('5.4.01','Beban Penjualan','5.4',3,'Aktif','2025-04-25 06:44:30','2025-04-25 06:44:30'),('5.4.01.01','Beban Transportasi','5.4.01',4,'Aktif','2025-04-25 06:45:25','2025-04-25 06:45:25'),('5.4.01.02','Beban Iklan','5.4.01',4,'Aktif','2025-04-25 06:45:39','2025-04-25 06:45:39'),('6','Pembelian',NULL,1,'Aktif','2025-04-25 07:35:01','2025-04-25 07:35:01'),('6.1','Pembelian','6',2,'Aktif','2025-04-25 07:35:17','2025-04-25 07:35:17'),('6.1.01','Pembelian','6.1',3,'Aktif','2025-04-25 07:35:38','2025-04-25 07:35:38'),('6.1.01.01','Pembelian','6.1.01',4,'Aktif','2025-04-25 07:35:50','2025-04-25 07:35:50');

/*Table structure for table `bank` */

DROP TABLE IF EXISTS `bank`;

CREATE TABLE `bank` (
  `idbank` char(5) COLLATE utf8mb4_general_ci NOT NULL,
  `namabank` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cabang` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `norekening` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `atasnama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idbank`),
  KEY `kdakun` (`kdakun`),
  CONSTRAINT `bank_ibfk_1` FOREIGN KEY (`kdakun`) REFERENCES `akun` (`kdakun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `bank` */

insert  into `bank`(`idbank`,`namabank`,`cabang`,`norekening`,`kdakun`,`inserted_date`,`updated_date`,`statusaktif`,`atasnama`) values ('BN001','May Bank','Pontianak','7844555666','1.1.01.02','2025-02-28 08:03:40','2025-05-10 04:07:20','Aktif','Budi Santoso'),('MD001','Bank Central Asia','Kota Pontianak','56889966','1.1.01.03','2025-02-28 11:59:35','2025-04-22 06:53:40','Aktif','Budi Santoso');

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `idbarang` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `kdbarang` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namabarang` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idkategori` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stok` int DEFAULT '0',
  `fotobarang` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hargabeli` decimal(18,0) DEFAULT '0',
  `hargajualasli` decimal(18,0) DEFAULT '0',
  `hargajualdiskon` decimal(10,0) DEFAULT '0',
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idjenisbarang` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenisbonuspenjualan` enum('Nominal','Persen') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Persen',
  `persenbonuspenjualan` decimal(3,2) DEFAULT '0.00',
  `jumlahbonuspenjualan` decimal(18,0) DEFAULT '0',
  `jenisbonustagihan` enum('Nominal','Persen') COLLATE utf8mb4_general_ci DEFAULT NULL,
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

insert  into `barang`(`idbarang`,`kdbarang`,`namabarang`,`idkategori`,`kdakun`,`stok`,`fotobarang`,`hargabeli`,`hargajualasli`,`hargajualdiskon`,`statusaktif`,`inserted_date`,`updated_date`,`idjenisbarang`,`jenisbonuspenjualan`,`persenbonuspenjualan`,`jumlahbonuspenjualan`,`jenisbonustagihan`,`persenbonustagihan`,`jumlahbonustagihan`,`stokminimum`) values ('B001000001',NULL,'Paku 1 Inc (1 Kg)','B001','1.1.02.01',0,NULL,20000,22000,22000,'Aktif','2025-05-23 13:51:11','2025-05-23 15:02:10','002','Nominal',0.00,1000,NULL,0.00,0,0),('B001000002','ASD3819111','Besi Pagar','B001','1.1.02.01',0,NULL,20000,22000,22000,'Aktif','2025-07-10 17:04:55','2025-07-10 17:32:33','001','Persen',0.25,0,'Persen',0.25,0,120),('K001000001',NULL,'Papan Mal','K001','1.1.02.01',990,NULL,14000,15000,15000,'Aktif','2025-02-20 03:33:46','2025-05-28 15:44:12','001','Persen',0.50,0,'Persen',0.30,0,0),('K001000002','266S8182AB','Kayu 4x6 Pelang','K001','1.1.02.01',1000,NULL,45000,48000,48000,'Aktif','2025-02-20 07:25:57','2025-07-10 17:19:01','001','Persen',0.50,0,'Persen',0.30,0,0),('K001000003',NULL,'Papan 26Inc','K001','1.1.02.01',100,NULL,45000,54000,54000,'Aktif','2025-05-27 17:41:54','2025-05-27 17:47:10','001','Persen',0.50,0,'Nominal',0.00,200,0),('W001000001',NULL,'Pipa 5In','W001','1.1.02.01',900,NULL,100000,120000,120000,'Aktif','2025-05-10 03:46:26','2025-05-28 15:44:30','001','Persen',0.50,0,'Persen',0.30,0,0);

/*Table structure for table `bonus` */

DROP TABLE IF EXISTS `bonus`;

CREATE TABLE `bonus` (
  `idbonus` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglbonus` date DEFAULT NULL,
  `idsales` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totalpenjualan` decimal(18,0) DEFAULT '0',
  `totalpenagihan` decimal(18,0) DEFAULT '0',
  `totalbonuspenjualan` decimal(18,0) DEFAULT '0',
  `totalbonuspenagihan` decimal(18,0) DEFAULT '0',
  `targetpenjualan` decimal(18,0) DEFAULT NULL,
  `pencapaiantarget` decimal(18,0) DEFAULT NULL,
  `totalbonustarget` decimal(18,0) DEFAULT '0',
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idbonus` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpiutang` char(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpenjualan` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idbonus` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpenjualan` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idbonus` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpenjualan` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idbukubank` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `idbank` char(5) COLLATE utf8mb4_general_ci NOT NULL,
  `idtransaksi` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgltransaksi` date DEFAULT NULL,
  `debet` decimal(18,0) NOT NULL DEFAULT '0',
  `kredit` decimal(18,0) NOT NULL DEFAULT '0',
  `idjenistransaksi` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `insertbysystem` tinyint(1) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `namaekspedisi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamatekspedisi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelpekspedisi` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emailekspedisi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nikpemilik` char(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapemilik` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelppemilik` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nowapemilik` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakunutang` char(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idhutang` char(12) COLLATE utf8mb4_general_ci NOT NULL,
  `idpembelian` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglhutang` date DEFAULT NULL,
  `idsupplier` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaldebet` decimal(18,0) DEFAULT NULL,
  `totalkredit` decimal(18,0) DEFAULT NULL,
  `jenissumber` enum('Pembelian','Non Pembelian') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Pembelian',
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idhutangdetail` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `idhutang` char(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglhutang` date DEFAULT NULL,
  `debet` decimal(18,0) DEFAULT NULL,
  `kredit` decimal(18,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Giro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` enum('Hutang','Pembayaran Hutang') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nobilyetgiro` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idhutangekspedisi` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `idtransaksi` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglhutang` date DEFAULT NULL,
  `idekspedisi` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `debet` decimal(18,0) DEFAULT NULL,
  `kredit` decimal(18,0) DEFAULT NULL,
  `jenissumber` enum('Pembelian','Penjualan','Pembayaran','Saldo') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Giro') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` enum('Hutang','Pembayaran') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nobilyetgiro` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
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

insert  into `hutangekspedisi`(`idhutangekspedisi`,`idtransaksi`,`tglhutang`,`idekspedisi`,`debet`,`kredit`,`jenissumber`,`keterangan`,`carabayar`,`idbank`,`jenis`,`nobilyetgiro`,`inserted_date`,`updated_date`,`hargadpp`,`persenppn`,`jumlahppn`,`persenpph23`,`jumlahpph23`) values ('250522HEX000001','250522BL0000001','2025-05-22','EKSOHRR001',0,5000000,'Pembelian','Hutang ekspedisi dengan No. Faktur 333/FF',NULL,NULL,'Hutang',NULL,NULL,NULL,NULL,NULL,NULL,0.00,0),('250523HEX000001',NULL,'2025-05-23','EKSOHRR001',5000000,0,'Pembayaran','Pembayaran dengan cara giro','Giro','MD001','Pembayaran','121312312','2025-05-23 04:42:23','2025-05-23 15:16:07',NULL,NULL,NULL,0.00,0),('250527HEX000001','250527SJ01','2025-05-27','EKSOHRR001',0,100000,'Penjualan','Hutang ekspedisi dengan No. Surat Jalan 250527SJ01',NULL,NULL,'Hutang',NULL,NULL,NULL,NULL,NULL,NULL,0.00,0),('250527HEX000002','250527SJ02','2025-05-27','EKSPWRU001',0,35000,'Penjualan','Hutang ekspedisi dengan No. Surat Jalan 250527SJ02',NULL,NULL,'Hutang',NULL,NULL,NULL,NULL,NULL,NULL,0.00,0),('250711HEX000001',NULL,'2025-07-11','EKSOHRR001',25275000,0,'Pembayaran','Test','Tunai',NULL,'Pembayaran',NULL,'2025-07-11 01:59:11','2025-07-11 01:59:11',25000000,1.10,275000,NULL,500000),('250711HEX000002',NULL,'2025-07-11','EKSOHRR001',2780250,0,'Pembayaran','test','Tunai',NULL,'Pembayaran',NULL,'2025-07-11 02:01:04','2025-07-11 02:01:04',2750000,1.10,30250,0.00,55000),('250711HEX000003',NULL,'2025-07-11','EKSOHRR001',2022000,0,'Pembayaran','Test','Tunai',NULL,'Pembayaran',NULL,'2025-07-11 02:02:13','2025-07-11 03:39:53',2000000,1.10,22000,2.00,40000);

/*Table structure for table `jenisbarang` */

DROP TABLE IF EXISTS `jenisbarang`;

CREATE TABLE `jenisbarang` (
  `idjenisbarang` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `jenisbarang` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `persenbonustarget` decimal(3,2) DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idjenisbarang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenisbarang` */

insert  into `jenisbarang`(`idjenisbarang`,`jenisbarang`,`persenbonustarget`,`statusaktif`) values ('001','Fast',0.25,'Aktif'),('002','Middle',0.50,'Aktif'),('999','Standard',0.00,'Aktif');

/*Table structure for table `jenisekspedisi` */

DROP TABLE IF EXISTS `jenisekspedisi`;

CREATE TABLE `jenisekspedisi` (
  `idjenisekspedisi` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `namajenisekspedisi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idjenisekspedisi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenisekspedisi` */

insert  into `jenisekspedisi`(`idjenisekspedisi`,`namajenisekspedisi`,`statusaktif`) values ('001','Darat','Aktif'),('002','Laut','Aktif'),('003','Udara','Aktif');

/*Table structure for table `jenispiutang` */

DROP TABLE IF EXISTS `jenispiutang`;

CREATE TABLE `jenispiutang` (
  `idjenispiutang` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `namajenispiutang` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jatuhtempo` int DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idjenispiutang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenispiutang` */

insert  into `jenispiutang`(`idjenispiutang`,`namajenispiutang`,`jatuhtempo`,`statusaktif`) values ('P01','Slow',90,'Aktif'),('P02','Middle',45,'Aktif'),('P03','Fast',7,'Aktif');

/*Table structure for table `jenistransaksi` */

DROP TABLE IF EXISTS `jenistransaksi`;

CREATE TABLE `jenistransaksi` (
  `idjenistransaksi` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `namajenistransaksi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idjenistransaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jenistransaksi` */

/*Table structure for table `jurnal` */

DROP TABLE IF EXISTS `jurnal`;

CREATE TABLE `jurnal` (
  `idjurnal` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tgljurnal` date DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaldebet` decimal(18,0) DEFAULT NULL,
  `totalkredit` decimal(18,0) DEFAULT NULL,
  `referensi` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` enum('Penjualan','Pembelian','Stock Adjustment','Penerimaan','Pengeluaran','Hutang','Piutang','Jurnal Penyesuaian','Retur Pembelian','Retur Penjualan','Saldo Awal') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idjurnal` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `namakategori` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idkategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kategoribarang` */

insert  into `kategoribarang`(`idkategori`,`namakategori`,`inserted_date`,`updated_date`,`statusaktif`) values ('B001','Besi','2025-02-21 03:20:26','2025-02-21 03:20:26','Aktif'),('K001','Kayu Ulin','2025-02-13 08:16:29','2025-02-14 00:43:02','Aktif'),('W001','Wavin','2025-05-10 03:43:57','2025-05-10 03:43:57','Aktif');

/*Table structure for table `konsumen` */

DROP TABLE IF EXISTS `konsumen`;

CREATE TABLE `konsumen` (
  `idkonsumen` char(6) COLLATE utf8mb4_general_ci NOT NULL,
  `namakonsumen` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamatkonsumen` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelpkonsumen` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emailkonsumen` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nikpemilik` char(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapemilik` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelppemilik` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nowapemilik` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `saldo` decimal(18,0) DEFAULT '0',
  `idwilayah` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `saldopajak` decimal(18,0) DEFAULT '0',
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `npwp` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `limitkredit` decimal(18,0) DEFAULT '50000000',
  `jumlahpiutang` decimal(18,0) DEFAULT '0',
  `kdakunpiutang` char(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idkonsumen`),
  KEY `idwilayah` (`idwilayah`),
  KEY `kdakunpiutang` (`kdakunpiutang`),
  CONSTRAINT `konsumen_ibfk_1` FOREIGN KEY (`idwilayah`) REFERENCES `wilayah` (`idwilayah`),
  CONSTRAINT `konsumen_ibfk_2` FOREIGN KEY (`kdakunpiutang`) REFERENCES `akun` (`kdakun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `konsumen` */

insert  into `konsumen`(`idkonsumen`,`namakonsumen`,`alamatkonsumen`,`notelpkonsumen`,`emailkonsumen`,`nikpemilik`,`namapemilik`,`notelppemilik`,`nowapemilik`,`saldo`,`idwilayah`,`saldopajak`,`inserted_date`,`updated_date`,`statusaktif`,`npwp`,`limitkredit`,`jumlahpiutang`,`kdakunpiutang`) values ('BWR001','CV. Berkat','Jl. Pemuda','0812000000',NULL,'7898797989879798','Dadang','081500000','081500000',0,'003',0,'2025-05-20 04:05:10','2025-05-20 04:08:20','Aktif','546465456545454',130000000,0,NULL),('IPJ001','PT. Intrajaya','Jl. Patimura','45452121212222112121','intrajaya@gmail.com','0000000000000000','Budi Hartono','0665234550','0813000000000',0,'001',0,'2025-02-21 02:54:14','2025-02-21 02:59:31','Aktif',NULL,50000000,150000,NULL),('ISO001','PT. Indrapura','Jl. Pendidikan 2','081200010100',NULL,NULL,NULL,NULL,NULL,0,'002',0,'2025-05-20 14:02:28','2025-05-20 14:04:51','Aktif','929283371781277',50000000,0,'1.1.03.01'),('KUE001','CV. Karya Utama','Jl. Pemuda','06562345455','karyautama@gmail.com','2211555122133223','Dodit','08130000000','08130000000',0,'002',0,'2025-02-21 03:23:04','2025-02-21 03:23:04','Aktif',NULL,50000000,11500000,NULL),('SKE001','Sinar Kobar','Jl. Pahlawan No.  23 Kel. Sungai Raya Kec. Sosok','06537272788','sinarkobar@gmail.com',NULL,'Toni','081200000000',NULL,0,'003',0,'2025-05-10 03:54:55','2025-05-10 03:55:14','Aktif',NULL,50000000,0,NULL);

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
  `idotorisasi` char(5) COLLATE utf8mb4_general_ci NOT NULL,
  `namaotorisasi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
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
  `idsupplier` char(10) COLLATE utf8mb4_general_ci NOT NULL,
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
  `idbank` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nobilyetgiro` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglbilyetgiro` date DEFAULT NULL,
  `totaldpp_po` decimal(18,0) DEFAULT '0',
  `totalppn_po` decimal(18,0) DEFAULT '0',
  `totalfaktur_po` decimal(18,0) DEFAULT '0',
  `statuspenerimaan` enum('Belum Diterima','Sudah Diterima') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Belum Diterima',
  `tgl_po` date DEFAULT NULL,
  `keterangan_po` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpengguna_po` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idekspedisi` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idbarang` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahbeli` int DEFAULT '0',
  `hargasatuan` decimal(18,0) DEFAULT '0',
  `hargadpp` decimal(18,0) DEFAULT '0',
  `jumlahppn` decimal(18,0) DEFAULT '0',
  `jumlahdiskon` decimal(18,0) DEFAULT '0',
  `subtotalbeli` decimal(18,0) DEFAULT '0',
  `jenisdiskon` enum('Persen','Nominal') COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idpenagihan` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tglpenagihan` date DEFAULT NULL,
  `tgltagihanakhir` date DEFAULT NULL,
  `idsales` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaltagihan` decimal(18,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statuscetak` enum('Sudah Cetak','Belum Cetak') COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idpenagihan` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpiutang` char(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahtagihan` decimal(18,0) DEFAULT NULL,
  `idsalesbonus` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idpenerimaan` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tglpenerimaan` date DEFAULT NULL,
  `totalpenerimaan` decimal(18,0) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idpenerimaan` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idpengeluaran` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tglpengeluaran` date DEFAULT NULL,
  `nokwitansi` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totalpengeluaran` decimal(18,0) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idpengeluaran` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idpengguna` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `namapengguna` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jeniskelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelppengguna` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emailpengguna` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fotopengguna` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idotorisasi` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`idpengguna`),
  UNIQUE KEY `emailpengguna` (`emailpengguna`),
  UNIQUE KEY `username` (`username`),
  KEY `idotorisasi` (`idotorisasi`),
  CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`idotorisasi`) REFERENCES `otorisasi` (`idotorisasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengguna` */

insert  into `pengguna`(`idpengguna`,`namapengguna`,`jeniskelamin`,`notelppengguna`,`emailpengguna`,`fotopengguna`,`username`,`password`,`idotorisasi`,`inserted_date`,`updated_date`,`statusaktif`,`lastlogin`) values ('USRBID0001','Budiman','Laki-laki','00000000000000000000','budi@gmail.com','karsten_winegeart_1grm2kdwykc_unsplash.jpg','budi','$2y$12$.YlF62K4niNYCM0mp/.RNOaptVdA4U3awYXzCJ61ghNIvsxgi9HyS','KL001','2025-02-25 04:37:28','2025-03-14 06:11:58','Aktif','2025-07-11 18:13:54');

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idkonsumen` char(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Piutang','Giro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idjenispiutang` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idsales` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nokwitansi` char(18) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nobilyetgiro` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
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

insert  into `penjualan`(`idpenjualan`,`idkonsumen`,`tglinvoice`,`noinvoice`,`keterangan`,`totalpenjualan`,`totaldpp`,`totaldiskon`,`totalbersih`,`ppnpersen`,`totalppn`,`biayapengiriman`,`totalinvoice`,`idpengguna`,`inserted_date`,`updated_date`,`carabayar`,`idbank`,`idjenispiutang`,`idsales`,`nokwitansi`,`nobilyetgiro`) values ('250522JL0000001','KUE001','2025-05-22','SJA/2505/000001','Pengadan Pipa',0,10860400,500000,0,11,1139600,0,11500000,'USRBID0001','2025-05-22 07:42:43','2025-05-22 07:42:43','Piutang',NULL,'P03','SLSJMQ0001',NULL,NULL),('250527JL0000001','IPJ001','2025-05-27','SJA/2505/000002','Ket',0,135140,0,0,11,14860,0,150000,'USRBID0001','2025-05-27 13:30:38','2025-05-27 13:30:38','Piutang',NULL,'P03','SLSSKN0001',NULL,NULL);

/*Table structure for table `penjualandetail` */

DROP TABLE IF EXISTS `penjualandetail`;

CREATE TABLE `penjualandetail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbarang` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahjual` int DEFAULT '0',
  `hargasatuan` decimal(18,0) DEFAULT '0',
  `hargadpp` decimal(18,0) DEFAULT NULL,
  `jumlahppn` decimal(18,0) DEFAULT NULL,
  `jumlahdiskon` decimal(18,0) DEFAULT '0',
  `subtotaljual` decimal(18,0) DEFAULT '0',
  `jenisdiskon` enum('Persen','Nominal') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `diskonpersen1` int DEFAULT NULL,
  `diskonpersen2` int DEFAULT NULL,
  `diskonpersen3` int DEFAULT NULL,
  `jenisbonuspenjualan` enum('Nominal','Persen') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `persenbonuspenjualan` decimal(3,2) DEFAULT '0.00',
  `jumlahbonuspenjualan` decimal(18,0) DEFAULT '0',
  `subtotalbonuspenjualan` decimal(18,0) DEFAULT '0',
  `jenisbonustagihan` enum('Nominal','Persen') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `persenbonustagihan` decimal(3,2) DEFAULT '0.00',
  `jumlahbonustagihan` decimal(18,0) DEFAULT '0',
  `subtotalbonustagihan` decimal(18,0) DEFAULT '0',
  `idjenisbarang` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `persenbonustarget` decimal(3,2) DEFAULT NULL,
  `subtotalbonustarget` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idpenjualan` (`idpenjualan`),
  KEY `idbarang` (`idbarang`),
  CONSTRAINT `penjualandetail_ibfk_1` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`),
  CONSTRAINT `penjualandetail_ibfk_2` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penjualandetail` */

insert  into `penjualandetail`(`id`,`idpenjualan`,`idbarang`,`jumlahjual`,`hargasatuan`,`hargadpp`,`jumlahppn`,`jumlahdiskon`,`subtotaljual`,`jenisdiskon`,`diskonpersen1`,`diskonpersen2`,`diskonpersen3`,`jenisbonuspenjualan`,`persenbonuspenjualan`,`jumlahbonuspenjualan`,`subtotalbonuspenjualan`,`jenisbonustagihan`,`persenbonustagihan`,`jumlahbonustagihan`,`subtotalbonustagihan`,`idjenisbarang`,`persenbonustarget`,`subtotalbonustarget`) values (88,'250522JL0000001','W001000001',100,120000,108604,11396,5000,11500000,'Nominal',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(90,'250527JL0000001','K001000001',10,15000,13514,1486,0,150000,'Nominal',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `penjualankwitansi` */

DROP TABLE IF EXISTS `penjualankwitansi`;

CREATE TABLE `penjualankwitansi` (
  `nokwitansi` char(18) COLLATE utf8mb4_general_ci NOT NULL,
  `tglkwitansi` date NOT NULL,
  `idpenjualan` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `totalplusppn` decimal(18,0) DEFAULT '0',
  `jumlahsudahbayar` decimal(18,0) DEFAULT '0',
  `jumlahbayar` decimal(18,0) DEFAULT '0',
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Giro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`nokwitansi`),
  KEY `idpenjualan` (`idpenjualan`),
  KEY `idpengguna` (`idpengguna`),
  KEY `idbank` (`idbank`),
  CONSTRAINT `penjualankwitansi_ibfk_1` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`),
  CONSTRAINT `penjualankwitansi_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`),
  CONSTRAINT `penjualankwitansi_ibfk_3` FOREIGN KEY (`idbank`) REFERENCES `bank` (`idbank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penjualankwitansi` */

insert  into `penjualankwitansi`(`nokwitansi`,`tglkwitansi`,`idpenjualan`,`totalplusppn`,`jumlahsudahbayar`,`jumlahbayar`,`inserted_date`,`updated_date`,`idpengguna`,`carabayar`,`idbank`) values ('250522JL0000001#01','2025-05-29','250522JL0000001',11500000,0,5000000,'2025-07-11 09:26:07','2025-07-11 09:26:07','USRBID0001','Tunai',NULL),('250522JL0000001#02','2025-07-11','250522JL0000001',11500000,5000000,6500000,'2025-07-11 15:09:50','2025-07-11 15:09:50','USRBID0001','Tunai',NULL);

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
  `idpenjualan` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idjenispiutang` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglpiutang` date DEFAULT NULL,
  `tgljatuhtempo` date DEFAULT NULL,
  `idkonsumen` char(6) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaldebet` decimal(10,0) DEFAULT NULL,
  `totalkredit` decimal(10,0) DEFAULT NULL,
  `jenissumber` enum('Penjualan','Saldo') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Penjualan',
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer','Giro') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` enum('Piutang','Pembayaran Piutang') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nokwitansi` char(18) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nobilyetgiro` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `bulan` char(2) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun` char(4) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jumlahdebet` decimal(18,0) DEFAULT NULL,
  `jumlahkredit` decimal(18,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idposting`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `postingjurnal_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `postingjurnal` */

/*Table structure for table `returpembelian` */

DROP TABLE IF EXISTS `returpembelian`;

CREATE TABLE `returpembelian` (
  `idreturpembelian` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `idpembelian` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tglretur` date DEFAULT NULL,
  `totalretur` decimal(18,0) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statusretur` enum('Proses','Selesai') COLLATE utf8mb4_general_ci DEFAULT 'Proses',
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
  `idreturpenjualan` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `idpenjualan` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tglretur` date DEFAULT NULL,
  `totalretur` decimal(18,0) DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `carabayar` enum('Tunai','Transfer') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbank` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idreturpenjualan` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `idbarang` char(10) COLLATE utf8mb4_general_ci NOT NULL,
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
  `namatabel` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namafunction` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1503 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `riwayataktifitas` */

insert  into `riwayataktifitas`(`id`,`deskripsi`,`namapengguna`,`inserted_date`,`namatabel`,`namafunction`) values (1,'{\"idkategori\":\"B003\",\"namakategori\":\"Besi\",\"inserted_date\":\"2025-02-13 17:31:12\",\"updated_date\":\"2025-02-13 17:31:12\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-13 17:31:12','kategoribarang','simpanData'),(2,'{\"idkategori\":\"B001\",\"namakategori\":\"Besi\",\"inserted_date\":\"2025-02-13 17:30:32\",\"updated_date\":\"2025-02-13 17:30:32\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-13 17:42:00','kategoribarang','hapus'),(3,'{\"idkategori\":\"B003\",\"namakategori\":\"Besi\",\"inserted_date\":\"2025-02-13 17:31:12\",\"updated_date\":\"2025-02-13 17:31:12\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-13 17:44:51','kategoribarang','hapus'),(4,'{\"idkategori\":\"A001\",\"namakategori\":\"aa\",\"inserted_date\":\"2025-02-13 17:46:53\",\"updated_date\":\"2025-02-13 17:46:53\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-13 17:46:53','kategoribarang','simpanData'),(5,'{\"idkategori\":\"A001\",\"namakategori\":\"aa\",\"inserted_date\":\"2025-02-13 17:46:53\",\"updated_date\":\"2025-02-13 17:46:53\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-13 17:47:05','kategoribarang','hapus'),(6,'{\"namakategori\":\"Kayu Ulin\",\"updated_date\":\"2025-02-13 17:49:01\",\"statusaktif\":\"Tidak Aktif\"}','Kasir','2025-02-13 17:49:01','kategoribarang','updateData'),(7,'{\"namakategori\":\"Kayu Ulin\",\"updated_date\":\"2025-02-13 17:49:40\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-13 17:49:40','kategoribarang','updateData'),(8,'{\"idkategori\":\"K001\",\"namakategori\":\"Kayu Ulin\",\"updated_date\":\"2025-02-13 17:53:03\",\"statusaktif\":\"Tidak Aktif\"}','Kasir','2025-02-13 17:53:03','kategoribarang','updateData'),(9,'{\"idkategori\":\"K001\",\"namakategori\":\"Kayu Ulin\",\"updated_date\":\"2025-02-14 00:43:02\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-14 00:43:02','kategoribarang','updateData'),(10,'{\"idkategori\":\"S001\",\"namakategori\":\"sdf\",\"inserted_date\":\"2025-02-14 01:04:41\",\"updated_date\":\"2025-02-14 01:04:41\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-14 01:04:41','kategoribarang','simpanData'),(11,'{\"idkategori\":\"S001\",\"namakategori\":\"sdf\",\"inserted_date\":\"2025-02-14 01:04:41\",\"updated_date\":\"2025-02-14 01:04:41\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-14 01:04:50','kategoribarang','hapusData'),(12,'{\"kdakun\":\"1\",\"namaakun\":\"Aktiva\",\"inserted_date\":\"2025-02-14 01:47:42\",\"updated_date\":\"2025-02-14 01:47:42\",\"statusaktif\":\"Aktif\",\"levels\":\"1\"}','Kasir','2025-02-14 01:47:42','akun','simpanData'),(13,'{\"kdakun\":\"1\",\"namaakun\":\"Aktiva Tetap\",\"updated_date\":\"2025-02-14 01:48:34\"}','Kasir','2025-02-14 01:48:34','akun','updateData'),(14,'{\"kdakun\":\"2\",\"namaakun\":\"Utang\",\"inserted_date\":\"2025-02-14 01:50:45\",\"updated_date\":\"2025-02-14 01:50:45\",\"statusaktif\":\"Aktif\",\"levels\":\"1\"}','Kasir','2025-02-14 01:50:45','akun','simpanData'),(15,'{\"kdakun\":\"3\",\"namaakun\":\"Modal\",\"inserted_date\":\"2025-02-14 01:50:54\",\"updated_date\":\"2025-02-14 01:50:54\",\"statusaktif\":\"Aktif\",\"levels\":\"1\"}','Kasir','2025-02-14 01:50:54','akun','simpanData'),(16,'{\"kdakun\":\"4\",\"namaakun\":\"Penjualan\",\"inserted_date\":\"2025-02-14 01:51:58\",\"updated_date\":\"2025-02-14 01:51:58\",\"statusaktif\":\"Aktif\",\"levels\":\"1\"}','Kasir','2025-02-14 01:51:58','akun','simpanData'),(17,'{\"kdakun\":\"5\",\"namaakun\":\"Biaya\",\"inserted_date\":\"2025-02-14 01:52:15\",\"updated_date\":\"2025-02-14 01:52:15\",\"statusaktif\":\"Aktif\",\"levels\":\"1\"}','Kasir','2025-02-14 01:52:16','akun','simpanData'),(18,'{\"kdakun\":\"6\",\"namaakun\":\"Lainnya\",\"inserted_date\":\"2025-02-14 01:52:34\",\"updated_date\":\"2025-02-14 01:52:34\",\"statusaktif\":\"Aktif\",\"levels\":\"1\"}','Kasir','2025-02-14 01:52:35','akun','simpanData'),(19,'{\"kdakun\":\"6\",\"namaakun\":\"Lainnya\",\"updated_date\":\"2025-02-14 01:52:41\"}','Kasir','2025-02-14 01:52:41','akun','updateData'),(20,'{\"kdakun\":\"6\",\"namaakun\":\"Lainnya\",\"kdparent\":null,\"levels\":1,\"statusaktif\":\"Aktif\",\"inserted_date\":\"2025-02-14 01:52:34\",\"updated_date\":\"2025-02-14 01:52:41\"}','Kasir','2025-02-14 01:52:45','akun','hapusData'),(21,'{\"kdakun\":\"3\",\"namaakun\":\"Modal\",\"updated_date\":\"2025-02-14 01:56:18\"}','Kasir','2025-02-14 01:56:18','akun','updateData'),(22,'{\"kdakun\":\"1.1\",\"namaakun\":\"Kas\",\"inserted_date\":\"2025-02-14 06:14:26\",\"updated_date\":\"2025-02-14 06:14:26\",\"statusaktif\":\"Aktif\",\"levels\":\"1\"}','Kasir','2025-02-14 06:14:26','akun','simpanData'),(23,'{\"kdakun\":\"1.1\",\"namaakun\":\"Aset Lancar\",\"updated_date\":\"2025-02-14 06:16:49\"}','Kasir','2025-02-14 06:16:50','akun','updateData'),(24,'{\"kdakun\":\"1.2\",\"namaakun\":\"Aset Tidak Lancar\",\"inserted_date\":\"2025-02-14 06:17:06\",\"updated_date\":\"2025-02-14 06:17:06\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 06:17:06','akun','simpanData'),(25,'{\"kdakun\":\"1\",\"namaakun\":\"Aset\",\"updated_date\":\"2025-02-14 06:17:20\"}','Kasir','2025-02-14 06:17:20','akun','updateData'),(26,'{\"kdakun\":\"2\",\"namaakun\":\"Liabilitas\",\"updated_date\":\"2025-02-14 06:17:37\"}','Kasir','2025-02-14 06:17:37','akun','updateData'),(27,'{\"kdakun\":\"5\",\"namaakun\":\"Beban\",\"updated_date\":\"2025-02-14 06:18:05\"}','Kasir','2025-02-14 06:18:06','akun','updateData'),(28,'{\"kdakun\":\"4\",\"namaakun\":\"Pendapatan\",\"updated_date\":\"2025-02-14 06:18:21\"}','Kasir','2025-02-14 06:18:21','akun','updateData'),(29,'{\"kdakun\":\"2.1\",\"namaakun\":\"Liabilitas Jangka Panjang\",\"inserted_date\":\"2025-02-14 06:19:04\",\"updated_date\":\"2025-02-14 06:19:04\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 06:19:04','akun','simpanData'),(30,'{\"kdakun\":\"1.1\",\"namaakun\":\"Aset Lancar\",\"kdparent\":\"1\",\"inserted_date\":\"2025-02-14 06:25:44\",\"updated_date\":\"2025-02-14 06:25:44\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 06:25:44','akun','simpanData'),(31,'{\"kdakun\":\"1.2\",\"namaakun\":\"Aset Tidak Lancar\",\"kdparent\":\"1\",\"inserted_date\":\"2025-02-14 06:26:10\",\"updated_date\":\"2025-02-14 06:26:10\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 06:26:10','akun','simpanData'),(32,'{\"kdakun\":\"2.1\",\"namaakun\":\"Liabilitas Jangka Panjang\",\"kdparent\":\"2\",\"inserted_date\":\"2025-02-14 06:38:40\",\"updated_date\":\"2025-02-14 06:38:40\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 06:38:40','akun','simpanData'),(33,'{\"kdakun\":\"2.2\",\"namaakun\":\"Liabilitas Jangka Pendek\",\"kdparent\":\"2\",\"inserted_date\":\"2025-02-14 06:39:03\",\"updated_date\":\"2025-02-14 06:39:03\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 06:39:03','akun','simpanData'),(34,'{\"kdakun\":\"1.1\",\"namaakun\":\"Aset Lancar\",\"updated_date\":\"2025-02-14 07:19:10\"}','Kasir','2025-02-14 07:19:10','akun','updateData'),(35,'{\"kdakun\":\"1.1\",\"namaakun\":\"Aset Lancar 1\",\"updated_date\":\"2025-02-14 07:19:31\"}','Kasir','2025-02-14 07:19:31','akun','updateData'),(36,'{\"kdakun\":\"1.1\",\"namaakun\":\"Aset Lancar\",\"updated_date\":\"2025-02-14 07:19:50\"}','Kasir','2025-02-14 07:19:50','akun','updateData'),(37,'{\"kdakun\":\"4.1\",\"namaakun\":\"Pendapatan Usaha\",\"kdparent\":\"4\",\"inserted_date\":\"2025-02-14 07:23:06\",\"updated_date\":\"2025-02-14 07:23:06\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 07:23:06','akun','simpanData'),(38,'{\"kdakun\":\"4.2\",\"namaakun\":\"Pendapatan Diluar Usaha\",\"kdparent\":\"4\",\"inserted_date\":\"2025-02-14 07:23:44\",\"updated_date\":\"2025-02-14 07:23:44\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 07:23:44','akun','simpanData'),(39,'{\"kdakun\":\"5.1\",\"namaakun\":\"Beban Gaji\",\"kdparent\":\"5\",\"inserted_date\":\"2025-02-14 07:33:40\",\"updated_date\":\"2025-02-14 07:33:40\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 07:33:40','akun','simpanData'),(40,'{\"kdakun\":\"5.2\",\"namaakun\":\"Beban Jasa\",\"kdparent\":\"5\",\"inserted_date\":\"2025-02-14 07:34:55\",\"updated_date\":\"2025-02-14 07:34:55\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 07:34:55','akun','simpanData'),(41,'{\"kdakun\":\"5.3\",\"namaakun\":\"Beban Peralatan dan Perlengkapan Kantor\",\"kdparent\":\"5\",\"inserted_date\":\"2025-02-14 07:35:23\",\"updated_date\":\"2025-02-14 07:35:23\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 07:35:23','akun','simpanData'),(42,'{\"kdakun\":\"1.1.01\",\"namaakun\":\"Kas\",\"kdparent\":\"1.1\",\"inserted_date\":\"2025-02-14 07:47:38\",\"updated_date\":\"2025-02-14 07:47:38\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Kasir','2025-02-14 07:47:38','akun','simpanData'),(43,'{\"kdakun\":\"1.1.01\",\"namaakun\":\"Kas\",\"kdparent\":\"1.1\",\"inserted_date\":\"2025-02-14 07:49:21\",\"updated_date\":\"2025-02-14 07:49:21\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Kasir','2025-02-14 07:49:21','akun','simpanData'),(44,'{\"kdakun\":\"1.1.02\",\"namaakun\":\"Persediaan Barang Dagang\",\"kdparent\":\"1.1\",\"inserted_date\":\"2025-02-14 07:50:14\",\"updated_date\":\"2025-02-14 07:50:14\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Kasir','2025-02-14 07:50:14','akun','simpanData'),(45,'{\"kdakun\":\"1.1.03\",\"namaakun\":\"Piutang Usaha\",\"kdparent\":\"1.1\",\"inserted_date\":\"2025-02-14 07:50:34\",\"updated_date\":\"2025-02-14 07:50:34\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Kasir','2025-02-14 07:50:34','akun','simpanData'),(46,'{\"kdakun\":\"1.1.01\",\"namaakun\":\"Kas 1\",\"updated_date\":\"2025-02-14 07:51:15\"}','Kasir','2025-02-14 07:51:15','akun','updateData'),(47,'{\"kdakun\":\"1.1.01\",\"namaakun\":\"Kas\",\"updated_date\":\"2025-02-14 07:51:21\"}','Kasir','2025-02-14 07:51:21','akun','updateData'),(48,'{\"kdakun\":\"1.1.04\",\"namaakun\":\"test\",\"kdparent\":\"1.1\",\"inserted_date\":\"2025-02-14 07:51:30\",\"updated_date\":\"2025-02-14 07:51:30\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Kasir','2025-02-14 07:51:30','akun','simpanData'),(49,'{\"kdakun\":\"1.1.04\",\"namaakun\":\"test\",\"kdparent\":\"1.1\",\"levels\":3,\"statusaktif\":\"Aktif\",\"inserted_date\":\"2025-02-14 07:51:30\",\"updated_date\":\"2025-02-14 07:51:30\",\"namaparent\":\"Aset Lancar\"}','Kasir','2025-02-14 07:51:35','akun','hapusData'),(50,'{\"kdakun\":\"1.1.01\",\"namaakun\":\"Kas\",\"updated_date\":\"2025-02-14 07:52:15\"}','Kasir','2025-02-14 07:52:15','akun','updateData'),(51,'{\"kdakun\":\"1.1.01.01\",\"namaakun\":\"Rekening BCA\",\"kdparent\":\"1.1.01\",\"inserted_date\":\"2025-02-14 08:09:12\",\"updated_date\":\"2025-02-14 08:09:12\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Kasir','2025-02-14 08:09:12','akun','simpanData'),(52,'{\"kdakun\":\"1.1.01.01\",\"namaakun\":\"Rekening BCA 1\",\"updated_date\":\"2025-02-14 08:09:43\"}','Kasir','2025-02-14 08:09:43','akun','updateData'),(53,'{\"kdakun\":\"1.1.01.01\",\"namaakun\":\"Rekening BCA\",\"updated_date\":\"2025-02-14 08:09:49\"}','Kasir','2025-02-14 08:09:49','akun','updateData'),(54,'{\"kdakun\":\"1.1.01.02\",\"namaakun\":\"Bank Niaga\",\"kdparent\":\"1.1.01\",\"inserted_date\":\"2025-02-14 08:12:41\",\"updated_date\":\"2025-02-14 08:12:41\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Kasir','2025-02-14 08:12:41','akun','simpanData'),(55,'{\"kdakun\":\"1.1.02.01\",\"namaakun\":\"Persediaan Bahan Baku\",\"kdparent\":\"1.1.02\",\"inserted_date\":\"2025-02-14 08:22:10\",\"updated_date\":\"2025-02-14 08:22:10\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Kasir','2025-02-14 08:22:10','akun','simpanData'),(56,'{\"prefix\":\"akun_persediaan_bdagang\",\"values\":\"1.1.02\",\"updated_date\":\"2025-02-20 01:39:03\",\"deskripsi\":\"Akun untuk persediaan barang dagang\"}','Kasir','2025-02-20 01:39:03','settings','updateData'),(57,'{\"prefix\":\"test\",\"values\":\"abc\",\"updated_date\":\"2025-02-20 01:41:49\",\"deskripsi\":\"a\"}','Kasir','2025-02-20 01:41:49','settings','updateData'),(58,'{\"prefix\":\"asd\",\"values\":\"sd\",\"updated_date\":\"2025-02-20 01:43:48\",\"deskripsi\":\"sd\"}','Kasir','2025-02-20 01:43:48','settings','updateData'),(59,'{\"prefix\":\"as\",\"values\":\"ssa\",\"updated_date\":\"2025-02-20 01:44:07\",\"deskripsi\":\"sasass\"}','Kasir','2025-02-20 01:44:07','settings','updateData'),(60,'{\"prefix\":\"akun_test\",\"values\":\"1.01.02\",\"inserted_date\":\"2025-02-20 01:49:25\",\"updated_date\":\"2025-02-20 01:49:25\",\"deskripsi\":\"Akun\"}','Kasir','2025-02-20 01:49:25','settings','simpanData'),(61,'{\"prefix\":\"akun_test\",\"values\":\"1.01.02\",\"updated_date\":\"2025-02-20 01:49:55\",\"deskripsi\":\"Akun 123\"}','Kasir','2025-02-20 01:49:55','settings','updateData'),(62,'{\"prefix\":\"akun_test\",\"values\":\"1.01.02\",\"deskripsi\":\"Akun 123\",\"inserted_date\":\"2025-02-20 01:49:25\",\"updated_date\":\"2025-02-20 01:49:55\"}','Kasir','2025-02-20 01:50:04','settings','hapusData'),(63,'{\"prefix\":\"akun_barang_dagang\",\"values\":\"1.01.02\",\"inserted_date\":\"2025-02-20 01:51:20\",\"updated_date\":\"2025-02-20 01:51:20\",\"deskripsi\":\"Akun persediaan barang dagang\"}','Kasir','2025-02-20 01:51:20','settings','simpanData'),(64,'{\"prefix\":\"akun_barang_dagang\",\"values\":\"1.1.02\",\"updated_date\":\"2025-02-20 01:51:38\",\"deskripsi\":\"Akun persediaan barang dagang\"}','Kasir','2025-02-20 01:51:38','settings','updateData'),(65,'{\"prefix\":\"akun_barang_dagang\",\"values\":\"1.1.02\",\"updated_date\":\"2025-02-20 01:53:16\",\"deskripsi\":\"Akun persediaan barang dagang\"}','Kasir','2025-02-20 01:53:16','settings','updateData'),(66,'{\"idbarang\":\"K001000001\",\"namabarang\":\"Papan Mal\",\"idkategori\":\"K001\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"14000\",\"hargajual\":\"15000\",\"inserted_date\":\"2025-02-20 03:33:46\",\"updated_date\":\"2025-02-20 03:33:46\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-20 03:33:47','barang','simpanData'),(67,'{\"idbarang\":\"K001000001\",\"namabarang\":\"Papan Mal\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"14000\",\"hargajual\":\"16000\",\"updated_date\":\"2025-02-20 03:43:47\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-20 03:43:47','barang','updateData'),(68,'{\"idbarang\":\"K001000001\",\"namabarang\":\"Papan Mal\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"14000\",\"hargajual\":\"15500\",\"updated_date\":\"2025-02-20 03:44:41\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-20 03:44:41','barang','updateData'),(69,'{\"idbarang\":\"K001000001\",\"namabarang\":\"Papan Mal\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"14000\",\"hargajual\":\"15500\",\"updated_date\":\"2025-02-20 03:44:49\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-20 03:44:49','barang','updateData'),(70,'{\"idbarang\":\"K001000001\",\"namabarang\":\"Papan Mal\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"14000\",\"hargajual\":\"15500\",\"updated_date\":\"2025-02-20 03:44:56\",\"statusaktif\":\"Tidak Aktif\"}','Kasir','2025-02-20 03:44:56','barang','updateData'),(71,'{\"idbarang\":\"K001000001\",\"namabarang\":\"Papan Mal\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"14000\",\"hargajual\":\"15500\",\"updated_date\":\"2025-02-20 03:45:07\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-20 03:45:07','barang','updateData'),(72,'{\"idbarang\":\"K001000002\",\"namabarang\":\"test\",\"idkategori\":\"K001\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"2000\",\"hargajual\":\"2100\",\"inserted_date\":\"2025-02-20 03:48:53\",\"updated_date\":\"2025-02-20 03:48:53\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-20 03:48:53','barang','simpanData'),(73,'{\"idbarang\":\"K001000002\",\"namabarang\":\"test\",\"idkategori\":\"K001\",\"kdakun\":\"1.1.02.01\",\"stok\":0,\"fotobarang\":null,\"hargabeli\":\"2000\",\"hargajual\":\"2100\",\"statusaktif\":\"Aktif\",\"namakategori\":\"Kayu Ulin\",\"namaakun\":\"Persediaan Bahan Baku\"}','Kasir','2025-02-20 03:49:15','barang','hapusData'),(74,'{\"idbarang\":\"K001000002\",\"namabarang\":\"Kayu 4x6 Pelang\",\"idkategori\":\"K001\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"45000\",\"hargajual\":\"50000\",\"inserted_date\":\"2025-02-20 07:25:57\",\"updated_date\":\"2025-02-20 07:25:57\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-20 07:25:57','barang','simpanData'),(75,'{\"idbarang\":\"K001000001\",\"namabarang\":\"Papan Mal\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"14000\",\"hargajualasli\":\"15000\",\"hargajualdiskon\":\"15000\",\"updated_date\":\"2025-02-20 07:33:42\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-20 07:33:42','barang','updateData'),(76,'{\"idbarang\":\"K001000002\",\"namabarang\":\"Kayu 4x6 Pelang\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"45000\",\"hargajualasli\":\"48000\",\"hargajualdiskon\":\"48000\",\"updated_date\":\"2025-02-20 07:33:54\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-20 07:33:54','barang','updateData'),(77,'{\"idbarang\":\"K001000003\",\"namabarang\":\"asdf\",\"idkategori\":\"K001\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"25000\",\"hargajualasli\":\"28000\",\"hargajualdiskon\":\"28000\",\"inserted_date\":\"2025-02-20 07:34:11\",\"updated_date\":\"2025-02-20 07:34:11\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-20 07:34:11','barang','simpanData'),(78,'{\"idbarang\":\"K001000003\",\"namabarang\":\"asdf\",\"idkategori\":\"K001\",\"kdakun\":\"1.1.02.01\",\"stok\":0,\"fotobarang\":null,\"hargabeli\":\"25000\",\"hargajualasli\":\"28000\",\"hargajualdiskon\":\"28000\",\"statusaktif\":\"Aktif\",\"namakategori\":\"Kayu Ulin\",\"namaakun\":\"Persediaan Bahan Baku\"}','Kasir','2025-02-20 07:34:57','barang','hapusData'),(79,'{\"idkonsumen\":\"LPM001\",\"namakonsumen\":\"CV. Lestari Permata\",\"notelpkonsumen\":\"0656825445\",\"alamatkonsumen\":\"Jl. Pahlawan\",\"emailkonsumen\":\"lestaripermata@gmail.com\",\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"idwilayah\":\"001\",\"inserted_date\":\"2025-02-21 02:33:56\",\"updated_date\":\"2025-02-21 02:33:56\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-21 02:33:56','konsumen','simpanData'),(80,'{\"idkonsumen\":\"IPJ001\",\"namakonsumen\":\"PT. Intrajaya\",\"notelpkonsumen\":\"45452121212222112121\",\"alamatkonsumen\":\"Jl. Patimura\",\"emailkonsumen\":\"intrajaya@gmail.com\",\"nikpemilik\":\"7878787878787878\",\"namapemilik\":\"Budi Hartono\",\"notelppemilik\":\"07812121212112121212\",\"nowapemilik\":\"12121221212121212121\",\"idwilayah\":\"001\",\"inserted_date\":\"2025-02-21 02:54:14\",\"updated_date\":\"2025-02-21 02:54:14\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-21 02:54:14','konsumen','simpanData'),(81,'{\"idkonsumen\":\"IPJ001\",\"namakonsumen\":\"PT. Intrajaya\",\"notelpkonsumen\":\"45452121212222112121\",\"alamatkonsumen\":\"Jl. Patimura\",\"emailkonsumen\":\"intrajaya@gmail.com\",\"nikpemilik\":\"0000000000000000\",\"namapemilik\":\"Budi Hartono\",\"notelppemilik\":\"0665234550\",\"nowapemilik\":\"0813000000000\",\"idwilayah\":\"001\",\"updated_date\":\"2025-02-21 02:59:17\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-21 02:59:17','konsumen','updateData'),(82,'{\"idkonsumen\":\"IPJ001\",\"namakonsumen\":\"PT. Intrajaya\",\"notelpkonsumen\":\"45452121212222112121\",\"alamatkonsumen\":\"Jl. Patimura\",\"emailkonsumen\":\"intrajaya@gmail.com\",\"nikpemilik\":\"0000000000000000\",\"namapemilik\":\"Budi Hartono\",\"notelppemilik\":\"0665234550\",\"nowapemilik\":\"0813000000000\",\"idwilayah\":\"001\",\"updated_date\":\"2025-02-21 02:59:23\",\"statusaktif\":\"Tidak Aktif\"}','Kasir','2025-02-21 02:59:23','konsumen','updateData'),(83,'{\"idkonsumen\":\"IPJ001\",\"namakonsumen\":\"PT. Intrajaya\",\"notelpkonsumen\":\"45452121212222112121\",\"alamatkonsumen\":\"Jl. Patimura\",\"emailkonsumen\":\"intrajaya@gmail.com\",\"nikpemilik\":\"0000000000000000\",\"namapemilik\":\"Budi Hartono\",\"notelppemilik\":\"0665234550\",\"nowapemilik\":\"0813000000000\",\"idwilayah\":\"001\",\"updated_date\":\"2025-02-21 02:59:31\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-21 02:59:31','konsumen','updateData'),(84,'{\"idkonsumen\":\"LPM001\",\"namakonsumen\":\"CV. Lestari Permata\",\"alamatkonsumen\":\"Jl. Pahlawan\",\"notelpkonsumen\":\"0656825445\",\"emailkonsumen\":\"lestaripermata@gmail.com\",\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"saldo\":\"0\",\"idwilayah\":\"001\",\"saldopajak\":\"0\",\"inserted_date\":\"2025-02-21 02:33:56\",\"updated_date\":\"2025-02-21 02:33:56\",\"statusaktif\":\"Aktif\",\"namawilayah\":\"Pontianak\"}','Kasir','2025-02-21 02:59:37','konsumen','hapusData'),(85,'{\"idwilayah\":\"002\",\"namawilayah\":\"Singkawang\",\"inserted_date\":\"2025-02-21 03:12:27\",\"updated_date\":\"2025-02-21 03:12:27\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-21 03:12:28','wilayah','simpanData'),(86,'{\"idwilayah\":\"002\",\"namawilayah\":\"Singkawang\",\"updated_date\":\"2025-02-21 03:12:41\",\"statusaktif\":\"Tidak Aktif\"}','Kasir','2025-02-21 03:12:41','wilayah','updateData'),(87,'{\"idwilayah\":\"002\",\"namawilayah\":\"Singkawang\",\"updated_date\":\"2025-02-21 03:12:52\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-21 03:12:52','wilayah','updateData'),(88,'{\"idwilayah\":\"002\",\"namawilayah\":\"Singkawang 1\",\"updated_date\":\"2025-02-21 03:15:25\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-21 03:15:25','wilayah','updateData'),(89,'{\"idwilayah\":\"002\",\"namawilayah\":\"Singkawang\",\"updated_date\":\"2025-02-21 03:15:31\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-21 03:15:31','wilayah','updateData'),(90,'{\"idkategori\":\"B001\",\"namakategori\":\"Besi\",\"inserted_date\":\"2025-02-21 03:20:26\",\"updated_date\":\"2025-02-21 03:20:26\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-21 03:20:26','kategoribarang','simpanData'),(91,'{\"idkonsumen\":\"KUE001\",\"namakonsumen\":\"CV. Karya Utama\",\"notelpkonsumen\":\"06562345455\",\"alamatkonsumen\":\"Jl. Pemuda\",\"emailkonsumen\":\"karyautama@gmail.com\",\"nikpemilik\":\"2211555122133223\",\"namapemilik\":\"Dodit\",\"notelppemilik\":\"08130000000\",\"nowapemilik\":\"08130000000\",\"idwilayah\":\"002\",\"inserted_date\":\"2025-02-21 03:23:04\",\"updated_date\":\"2025-02-21 03:23:04\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-21 03:23:04','konsumen','simpanData'),(92,'{\"prefix\":\"test\",\"values\":\"test\",\"inserted_date\":\"2025-02-21 03:24:57\",\"updated_date\":\"2025-02-21 03:24:57\",\"deskripsi\":\"test\"}','Kasir','2025-02-21 03:24:57','settings','simpanData'),(93,'{\"prefix\":\"test\",\"values\":\"test\",\"deskripsi\":\"test\",\"inserted_date\":\"2025-02-21 03:24:57\",\"updated_date\":\"2025-02-21 03:24:57\"}','Kasir','2025-02-21 03:25:14','settings','hapusData'),(94,'{\"idsales\":\"SLSAGA0001\",\"namasales\":\"asdfasdfas\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3423243243243242\",\"tempatlahir\":\"asdfsadfasd\",\"tgllahir\":\"2025-02-25\",\"agama\":\"Islam\",\"alamatktp\":\"sdfa\",\"alamattinggal\":\"asdf\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"32423432\",\"email\":\"email@gmail.com\",\"tglkontrak\":\"2025-02-25\",\"inserted_date\":\"2025-02-25 01:17:29\",\"updated_date\":\"2025-02-25 01:17:29\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 01:17:29','sales','simpanData'),(95,'{\"idsales\":\"SLSAGA0001\",\"namasales\":\"Budi\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3423243243243242\",\"tempatlahir\":\"asdfsadfasd\",\"tgllahir\":\"2025-02-25\",\"agama\":\"Islam\",\"alamatktp\":\"sdfa\",\"alamattinggal\":\"asdf\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"32423432\",\"email\":\"email@gmail.com\",\"tglkontrak\":\"2025-02-25\",\"updated_date\":\"2025-02-25 02:01:57\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 02:01:57','sales','updateData'),(96,'{\"idsales\":\"SLSAGA0001\",\"namasales\":\"Budi\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3423243243243242\",\"tempatlahir\":\"asdfsadfasd\",\"tgllahir\":\"2025-02-25\",\"agama\":\"Islam\",\"alamatktp\":\"sdfa\",\"alamattinggal\":\"asdf\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"32423432\",\"email\":\"email@gmail.com\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"receipt.pdf\",\"updated_date\":\"2025-02-25 02:14:38\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 02:14:39','sales','updateData'),(97,'{\"idsales\":\"SLSAGA0001\",\"namasales\":\"Budi\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3423243243243242\",\"tempatlahir\":\"asdfsadfasd\",\"tgllahir\":\"2025-02-25\",\"agama\":\"Islam\",\"alamatktp\":\"sdfa\",\"alamattinggal\":\"asdf\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"32423432\",\"email\":\"email@gmail.com\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"receipt1.pdf\",\"updated_date\":\"2025-02-25 02:15:30\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 02:15:31','sales','updateData'),(98,'{\"idsales\":\"SLSAGA0001\",\"namasales\":\"Budi\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3423243243243242\",\"tempatlahir\":\"asdfsadfasd\",\"tgllahir\":\"2025-02-25\",\"agama\":\"Islam\",\"alamatktp\":\"sdfa\",\"alamattinggal\":\"asdf\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"32423432\",\"email\":\"email@gmail.com\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"doc_20250218_wa0094.pdf\",\"updated_date\":\"2025-02-25 02:22:29\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 02:22:30','sales','updateData'),(99,'{\"idsales\":\"SLSAGA0001\",\"namasales\":\"Budi\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3423243243243242\",\"tempatlahir\":\"asdfsadfasd\",\"tgllahir\":\"2025-02-25\",\"agama\":\"Islam\",\"alamatktp\":\"sdfa\",\"alamattinggal\":\"asdf\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"32423432\",\"email\":\"email@gmail.com\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"laporan_pendapatan_ruangan_radiologi.xlsx\",\"updated_date\":\"2025-02-25 02:23:24\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 02:23:24','sales','updateData'),(100,'{\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"jeniskelamin\":\"Perempuan\",\"nik\":\"1111111111111111\",\"tempatlahir\":\"Jakarta\",\"tgllahir\":\"2000-12-02\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"081302500000000\",\"email\":\"siti@gmail.com\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"mbarang.xls\",\"inserted_date\":\"2025-02-25 02:25:08\",\"updated_date\":\"2025-02-25 02:25:08\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 02:25:08','sales','simpanData'),(101,'{\"idsales\":\"SLSAGA0001\",\"namasales\":\"Budi\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3423243243243242\",\"tempatlahir\":\"asdfsadfasd\",\"tgllahir\":\"2025-02-25\",\"agama\":\"Islam\",\"alamatktp\":\"sdfa\",\"alamattinggal\":\"asdf\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"32423432\",\"email\":\"email@gmail.com\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"receipt.pdf\",\"updated_date\":\"2025-02-25 02:31:25\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 02:31:25','sales','updateData'),(102,'{\"idsales\":\"SLSAGA0001\",\"namasales\":\"Budi\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3423243243243242\",\"tempatlahir\":\"asdfsadfasd\",\"tgllahir\":\"2025-02-25\",\"agama\":\"Islam\",\"alamatktp\":\"sdfa\",\"alamattinggal\":\"asdf\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"32423432\",\"email\":\"email@gmail.com\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"receipt.pdf\",\"inserted_date\":\"2025-02-25 01:17:29\",\"updated_date\":\"2025-02-25 02:31:25\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 02:37:29','sales','hapusData'),(103,'{\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"alamatsupplier\":\"Jl. Kebangkitan\",\"kontakperson\":null,\"notelp\":\"081200000000000\",\"email\":\"rudi@gmail.com\",\"inserted_date\":\"2025-02-25 03:24:19\",\"updated_date\":\"2025-02-25 03:24:19\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 03:24:19','supplier','simpanData'),(104,'{\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"alamatsupplier\":\"Jl. Kebangkitan\",\"kontakperson\":\"Rudi\",\"notelp\":\"081200000000000\",\"email\":\"rudi@gmail.com\",\"updated_date\":\"2025-02-25 03:26:21\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 03:26:21','supplier','updateData'),(105,'{\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"alamatsupplier\":\"Jl. Kebangkitan\",\"kontakperson\":\"Rudi\",\"notelp\":\"081200000000000\",\"email\":\"rudi@gmail.com\",\"updated_date\":\"2025-02-25 03:28:21\",\"statusaktif\":\"Tidak Aktif\"}','Kasir','2025-02-25 03:28:21','supplier','updateData'),(106,'{\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"alamatsupplier\":\"Jl. Kebangkitan\",\"kontakperson\":\"Rudi\",\"notelp\":\"081200000000000\",\"email\":\"rudi@gmail.com\",\"updated_date\":\"2025-02-25 03:28:32\",\"statusaktif\":\"Aktif\"}','Kasir','2025-02-25 03:28:32','supplier','updateData'),(107,'{\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"00000000000000000000\",\"emailpengguna\":\"budi@gmail.com\",\"fotopengguna\":null,\"username\":\"budi\",\"idotorisasi\":\"AA001\",\"updated_date\":\"2025-02-25 07:10:46\",\"statusaktif\":null}','BUdi','2025-02-25 07:10:46','pengguna','updateData'),(108,'{\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"00000000000000000000\",\"emailpengguna\":\"budi@gmail.com\",\"fotopengguna\":null,\"username\":\"budi\",\"idotorisasi\":\"AA001\",\"updated_date\":\"2025-02-25 07:13:32\",\"statusaktif\":\"Tidak Aktif\"}','BUdi','2025-02-25 07:13:32','pengguna','updateData'),(109,'{\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"00000000000000000000\",\"emailpengguna\":\"budi@gmail.com\",\"fotopengguna\":null,\"username\":\"budi\",\"idotorisasi\":\"AA001\",\"updated_date\":\"2025-02-25 07:13:50\",\"statusaktif\":\"Aktif\"}','BUdi','2025-02-25 07:13:51','pengguna','updateData'),(110,'{\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"00000000000000000000\",\"emailpengguna\":\"budi@gmail.com\",\"fotopengguna\":\"karsten_winegeart_1grm2kdwykc_unsplash.jpg\",\"username\":\"budi\",\"idotorisasi\":\"AA001\",\"updated_date\":\"2025-02-25 07:14:33\",\"statusaktif\":\"Aktif\"}','BUdi','2025-02-25 07:14:33','pengguna','updateData'),(111,'{\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"00000000000000000000\",\"emailpengguna\":\"budi@gmail.com\",\"fotopengguna\":\"karsten_winegeart_1grm2kdwykc_unsplash.jpg\",\"username\":\"budi\",\"idotorisasi\":\"AA001\",\"updated_date\":\"2025-02-25 07:14:54\",\"statusaktif\":\"Aktif\"}','BUdi','2025-02-25 07:14:54','pengguna','updateData'),(112,'{\"idpengguna\":\"USRKKP0001\",\"namapengguna\":\"Kasir\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"00\",\"emailpengguna\":\"kasir@gmail.com\",\"fotopengguna\":null,\"username\":\"kasir\",\"password\":\"$2y$12$WqKudl3\\/cbQL\\/ioqaqiyZuHQ5c5PV6\\/CpSW3aWVcF6XmO\\/uZYfChu\",\"idotorisasi\":\"KL001\",\"inserted_date\":\"2025-02-25 07:15:45\",\"updated_date\":\"2025-02-25 07:15:45\",\"statusaktif\":\"Aktif\"}','BUdi','2025-02-25 07:15:46','pengguna','simpanData'),(113,'{\"idpengguna\":\"USRAPU0001\",\"namapengguna\":\"asdf\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"3421\",\"emailpengguna\":\"gidam@gmail.com\",\"fotopengguna\":null,\"username\":\"gudang\",\"password\":\"$2y$12$OGlbXxJW4OfSpgN9o7abteIRnXpifSHLs0FuLu.eSw8lVbVZCM876\",\"idotorisasi\":\"KL001\",\"inserted_date\":\"2025-02-25 07:16:29\",\"updated_date\":\"2025-02-25 07:16:29\",\"statusaktif\":\"Aktif\"}','BUdi','2025-02-25 07:16:29','pengguna','simpanData'),(114,'{\"idpengguna\":\"USRAPU0001\",\"namapengguna\":\"asdf\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"3421\",\"emailpengguna\":\"gidam@gmail.com\",\"fotopengguna\":null,\"username\":\"gudang\",\"password\":\"$2y$12$OGlbXxJW4OfSpgN9o7abteIRnXpifSHLs0FuLu.eSw8lVbVZCM876\",\"idotorisasi\":\"KL001\",\"inserted_date\":\"2025-02-25 07:16:29\",\"updated_date\":\"2025-02-25 07:16:29\",\"statusaktif\":\"Aktif\",\"namaotorisasi\":\"Kasir\"}','BUdi','2025-02-25 07:16:38','pengguna','hapusData'),(115,'{\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"00000000000000000000\",\"emailpengguna\":\"budi@gmail.com\",\"fotopengguna\":\"karsten_winegeart_1grm2kdwykc_unsplash.jpg\",\"username\":\"budi\",\"idotorisasi\":\"AA001\",\"updated_date\":\"2025-02-25 07:28:16\",\"statusaktif\":\"Aktif\"}','BUdi','2025-02-25 07:28:16','pengguna','updateData'),(116,'{\"idpengguna\":\"USRKKP0001\",\"namapengguna\":\"Kasir\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"00\",\"emailpengguna\":\"kasir@gmail.com\",\"fotopengguna\":null,\"username\":\"kasir\",\"password\":\"$2y$12$WqKudl3\\/cbQL\\/ioqaqiyZuHQ5c5PV6\\/CpSW3aWVcF6XmO\\/uZYfChu\",\"idotorisasi\":\"KL001\",\"inserted_date\":\"2025-02-25 07:15:45\",\"updated_date\":\"2025-02-25 07:15:45\",\"statusaktif\":\"Aktif\",\"namaotorisasi\":\"Kasir\"}','BUdi','2025-02-25 07:30:58','pengguna','hapusData'),(117,'{\"lastlogin\":\"2025-02-25 07:45:22\"}','Budiman','2025-02-25 07:45:22','pengguna','updateData'),(118,'{\"lastlogin\":\"2025-02-25 07:54:39\"}','Budiman','2025-02-25 07:54:39','pengguna','updateData'),(119,'{\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"00000000000000000000\",\"emailpengguna\":\"budi@gmail.com\",\"fotopengguna\":\"karsten_winegeart_1grm2kdwykc_unsplash.jpg\",\"username\":\"budi\",\"idotorisasi\":\"AA001\",\"updated_date\":\"2025-02-25 07:56:07\",\"statusaktif\":\"Aktif\"}','Budiman','2025-02-25 07:56:07','pengguna','updateData'),(120,'{\"lastlogin\":\"2025-02-26 02:11:55\"}','Budiman','2025-02-26 02:11:55','pengguna','updateData'),(121,'{\"lastlogin\":\"2025-02-27 01:47:44\"}','Budiman','2025-02-27 01:47:44','pengguna','updateData'),(122,'{\"lastlogin\":\"2025-02-27 01:54:20\"}','Budiman','2025-02-27 01:54:20','pengguna','updateData'),(123,'{\"prefix\":\"usaha_nama\",\"values\":\"PT. INTRAHUSADA\",\"inserted_date\":\"2025-02-27 01:54:47\",\"updated_date\":\"2025-02-27 01:54:47\",\"deskripsi\":null}','Budiman','2025-02-27 01:54:47','settings','simpanData'),(124,'{\"prefix\":\"usaha_nama_singkat\",\"values\":\"IHD\",\"inserted_date\":\"2025-02-27 01:55:30\",\"updated_date\":\"2025-02-27 01:55:30\",\"deskripsi\":\"Singkatan Nama Usaha\"}','Budiman','2025-02-27 01:55:30','settings','simpanData'),(125,'{\"prefix\":\"usaha_logo\",\"values\":\"logo.png\",\"inserted_date\":\"2025-02-27 01:56:05\",\"updated_date\":\"2025-02-27 01:56:05\",\"deskripsi\":\"Logo usaha\"}','Budiman','2025-02-27 01:56:05','settings','simpanData'),(126,'{\"prefix\":\"usaha_nama\",\"values\":\"PT. INTRAHUSADA PERMATA\",\"updated_date\":\"2025-02-27 01:56:28\",\"deskripsi\":null}','Budiman','2025-02-27 01:56:28','settings','updateData'),(127,'{\"lastlogin\":\"2025-02-27 02:03:29\"}','Budiman','2025-02-27 02:03:29','pengguna','updateData'),(128,'{\"lastlogin\":\"2025-02-27 03:46:00\"}','Budiman','2025-02-27 03:46:00','pengguna','updateData'),(129,'{\"idpembelian\":\"250227BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"123\",\"tglfaktur\":\"2025-02-27\",\"tglditerima\":\"2025-02-27\",\"keterangan\":\"test\",\"totalsetelahdiskon\":90000,\"totalsebelumdiskon\":90000,\"inserted_date\":\"2025-02-27 04:15:07\",\"updated_date\":\"2025-02-27 04:15:07\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-02-27 04:15:07','pembelian','simpanData'),(130,'[{\"idpembelian\":\"250227BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"90000\"}]','Budiman','2025-02-27 04:15:07','pembeliandetail','simpanData'),(131,'{\"lastlogin\":\"2025-02-28 02:46:51\"}','Budiman','2025-02-28 02:46:51','pengguna','updateData'),(132,'{\"idpembelian\":\"250228BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"222\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"Pembelian Bahan\",\"totalsetelahdiskon\":90000,\"totalsebelumdiskon\":90000,\"inserted_date\":\"2025-02-28 02:47:32\",\"updated_date\":\"2025-02-28 02:47:32\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-02-28 02:47:32','pembelian','simpanData'),(133,'[{\"idpembelian\":\"250228BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"90000\"}]','Budiman','2025-02-28 02:47:32','pembeliandetail','simpanData'),(134,'{\"idpembelian\":\"250228BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"222\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"Pembelian Bahan test\",\"totalsetelahdiskon\":90000,\"totalsebelumdiskon\":90000,\"inserted_date\":\"2025-02-28 04:23:32\",\"updated_date\":\"2025-02-28 04:23:32\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-02-28 04:23:32','pembelian','simpanData'),(135,'[{\"idpembelian\":\"250228BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"90000\"}]','Budiman','2025-02-28 04:23:32','pembeliandetail','simpanData'),(136,'{\"idpembelian\":\"250228BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"222\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"Pembelian Bahan test\",\"totalsetelahdiskon\":90000,\"totalsebelumdiskon\":90000,\"inserted_date\":\"2025-02-28 04:24:26\",\"updated_date\":\"2025-02-28 04:24:26\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-02-28 04:24:26','pembelian','simpanData'),(137,'[{\"idpembelian\":\"250228BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"90000\"}]','Budiman','2025-02-28 04:24:26','pembeliandetail','simpanData'),(138,'{\"idpembelian\":\"250228BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"222\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"Pembelian Bahan\",\"totalsetelahdiskon\":90000,\"totalsebelumdiskon\":90000,\"inserted_date\":\"2025-02-28 04:26:52\",\"updated_date\":\"2025-02-28 04:26:52\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-02-28 04:26:52','pembelian','simpanData'),(139,'[{\"idpembelian\":\"250228BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"90000\"}]','Budiman','2025-02-28 04:26:52','pembeliandetail','simpanData'),(140,'{\"idpembelian\":\"250228BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"222\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"Pembelian Bahan Baru\",\"totalsetelahdiskon\":90000,\"totalsebelumdiskon\":90000,\"inserted_date\":\"2025-02-28 04:27:16\",\"updated_date\":\"2025-02-28 04:27:16\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-02-28 04:27:16','pembelian','simpanData'),(141,'[{\"idpembelian\":\"250228BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"90000\"}]','Budiman','2025-02-28 04:27:16','pembeliandetail','simpanData'),(142,'{\"idpembelian\":\"250228BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"333\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"Test Pengadaan\",\"totalsetelahdiskon\":90000,\"totalsebelumdiskon\":90000,\"inserted_date\":\"2025-02-28 04:33:04\",\"updated_date\":\"2025-02-28 04:33:04\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-02-28 04:33:05','pembelian','simpanData'),(143,'[{\"idpembelian\":\"250228BL0000002\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"90000\"}]','Budiman','2025-02-28 04:33:05','pembeliandetail','simpanData'),(144,'{\"idpembelian\":\"250228BL0000003\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"4444\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"Pembelian ke 4\",\"totalsetelahdiskon\":90000,\"totalsebelumdiskon\":90000,\"inserted_date\":\"2025-02-28 04:38:41\",\"updated_date\":\"2025-02-28 04:38:41\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-02-28 04:38:41','pembelian','simpanData'),(145,'[{\"idpembelian\":\"250228BL0000003\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"90000\"}]','Budiman','2025-02-28 04:38:41','pembeliandetail','simpanData'),(146,'{\"idpembelian\":\"250228BL0000004\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"232\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"abc\",\"totalsetelahdiskon\":118000,\"totalsebelumdiskon\":118000,\"inserted_date\":\"2025-02-28 04:40:02\",\"updated_date\":\"2025-02-28 04:40:02\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-02-28 04:40:02','pembelian','simpanData'),(147,'[{\"idpembelian\":\"250228BL0000004\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"28000\"},{\"idpembelian\":\"250228BL0000004\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"90000\"}]','Budiman','2025-02-28 04:40:02','pembeliandetail','simpanData'),(148,'{\"lastlogin\":\"2025-02-28 07:31:17\"}','Budiman','2025-02-28 07:31:17','pengguna','updateData'),(149,'{\"prefix\":\"akun_kas\",\"values\":\"1.1.01\",\"inserted_date\":\"2025-02-28 07:35:52\",\"updated_date\":\"2025-02-28 07:35:52\",\"deskripsi\":\"Rekening akun kas\"}','Budiman','2025-02-28 07:35:52','settings','simpanData'),(150,'{\"lastlogin\":\"2025-02-28 07:36:37\"}','Budiman','2025-02-28 07:36:37','pengguna','updateData'),(151,'{\"idbank\":\"BN001\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"kdakun\":\"1.1.01.02\",\"inserted_date\":\"2025-02-28 08:03:40\",\"updated_date\":\"2025-02-28 08:03:40\",\"statusaktif\":\"Aktif\"}','Budiman','2025-02-28 08:03:40','bank','simpanData'),(152,'{\"idbank\":\"BN001\",\"namabank\":\"Bank Niaga 1\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"kdakun\":\"1.1.01.02\",\"updated_date\":\"2025-02-28 08:07:05\",\"statusaktif\":\"Aktif\"}','Budiman','2025-02-28 08:07:05','bank','updateData'),(153,'{\"idbank\":\"BN001\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"kdakun\":\"1.1.01.02\",\"updated_date\":\"2025-02-28 08:07:15\",\"statusaktif\":\"Aktif\"}','Budiman','2025-02-28 08:07:15','bank','updateData'),(154,'{\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"kdakun\":\"1.1.01.01\",\"updated_date\":\"2025-02-28 08:07:24\",\"statusaktif\":\"Aktif\"}','Budiman','2025-02-28 08:07:25','bank','updateData'),(155,'{\"idbank\":\"TT001\",\"namabank\":\"test\",\"cabang\":\"acb\",\"norekening\":\"123232\",\"kdakun\":\"1.1.01.01\",\"inserted_date\":\"2025-02-28 08:07:37\",\"updated_date\":\"2025-02-28 08:07:37\",\"statusaktif\":\"Aktif\"}','Budiman','2025-02-28 08:07:37','bank','simpanData'),(156,'{\"idbank\":\"TT001\",\"namabank\":\"test\",\"cabang\":\"acb\",\"norekening\":\"123232\",\"kdakun\":\"1.1.01.01\",\"inserted_date\":\"2025-02-28 08:07:37\",\"updated_date\":\"2025-02-28 08:07:37\",\"statusaktif\":\"Aktif\",\"namaakun\":\"Rekening BCA\",\"kdparent\":\"1.1.01\"}','Budiman','2025-02-28 08:07:42','bank','hapusData'),(157,'{\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"kdakun\":\"1.1.01.01\",\"updated_date\":\"2025-02-28 08:07:57\",\"statusaktif\":\"Tidak Aktif\"}','Budiman','2025-02-28 08:07:57','bank','updateData'),(158,'{\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"kdakun\":\"1.1.01.01\",\"updated_date\":\"2025-02-28 08:08:03\",\"statusaktif\":\"Aktif\"}','Budiman','2025-02-28 08:08:04','bank','updateData'),(159,'{\"lastlogin\":\"2025-02-28 14:23:40\"}','Budiman','2025-02-28 14:23:40','pengguna','updateData'),(160,'{\"idpembelian\":\"250228BL0000004\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"3322\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"test\",\"totalsetelahdiskon\":45000,\"totalsebelumdiskon\":45000,\"inserted_date\":\"2025-02-28 14:42:25\",\"updated_date\":\"2025-02-28 14:42:25\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-02-28 14:42:25','pembelian','simpanData'),(161,'[{\"idpembelian\":\"250228BL0000004\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"45000\"}]','Budiman','2025-02-28 14:42:25','pembeliandetail','simpanData'),(162,'{\"idpembelian\":\"250228BL0000005\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"23aa\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"test\",\"totalsetelahdiskon\":135000,\"totalsebelumdiskon\":135000,\"inserted_date\":\"2025-02-28 15:01:30\",\"updated_date\":\"2025-02-28 15:01:30\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-02-28 15:01:30','pembelian','simpanData'),(163,'[{\"idpembelian\":\"250228BL0000005\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"3\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"135000\"}]','Budiman','2025-02-28 15:01:30','pembeliandetail','simpanData'),(164,'{\"idpembelian\":\"250228BL0000006\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"3433\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"test\",\"totalsetelahdiskon\":90000,\"totalsebelumdiskon\":90000,\"inserted_date\":\"2025-02-28 15:02:03\",\"updated_date\":\"2025-02-28 15:02:03\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":null}','Budiman','2025-02-28 15:02:03','pembelian','simpanData'),(165,'[{\"idpembelian\":\"250228BL0000006\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"90000\"}]','Budiman','2025-02-28 15:02:03','pembeliandetail','simpanData'),(166,'{\"idpembelian\":\"250228BL0000007\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"23232\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"test\",\"totalsetelahdiskon\":45000,\"totalsebelumdiskon\":45000,\"inserted_date\":\"2025-02-28 15:07:05\",\"updated_date\":\"2025-02-28 15:07:05\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-02-28 15:07:05','pembelian','simpanData'),(167,'[{\"idpembelian\":\"250228BL0000007\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"45000\"}]','Budiman','2025-02-28 15:07:05','pembeliandetail','simpanData'),(168,'{\"idpembelian\":\"250228BL0000008\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"232323\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"test\",\"totalsetelahdiskon\":45000,\"totalsebelumdiskon\":45000,\"inserted_date\":\"2025-02-28 15:07:34\",\"updated_date\":\"2025-02-28 15:07:34\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-02-28 15:07:34','pembelian','simpanData'),(169,'[{\"idpembelian\":\"250228BL0000008\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"45000\"}]','Budiman','2025-02-28 15:07:34','pembeliandetail','simpanData'),(170,'{\"idpembelian\":\"250228BL0000007\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"23232\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"test\",\"totalsetelahdiskon\":45000,\"totalsebelumdiskon\":45000,\"updated_date\":\"2025-02-28 16:08:40\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-02-28 16:08:40','pembelian','updateData'),(171,'[{\"idpembelian\":\"250228BL0000007\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"45000\"}]','Budiman','2025-02-28 16:08:40','pembeliandetail','updateData'),(172,'{\"lastlogin\":\"2025-03-01 07:54:05\"}','Budiman','2025-03-01 07:54:05','pengguna','updateData'),(173,'{\"idpembelian\":\"250301BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"123\",\"tglfaktur\":\"2025-02-28\",\"tglditerima\":\"2025-02-28\",\"keterangan\":\"test\",\"totalsetelahdiskon\":28000,\"totalsebelumdiskon\":28000,\"inserted_date\":\"2025-03-01 10:02:16\",\"updated_date\":\"2025-03-01 10:02:16\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-03-01 10:02:16','pembelian','simpanData'),(174,'[{\"idpembelian\":\"250301BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"28000\"}]','Budiman','2025-03-01 10:02:16','pembeliandetail','simpanData'),(175,'{\"idpembelian\":\"250301BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"33\",\"tglfaktur\":\"2025-03-01\",\"tglditerima\":\"2025-03-01\",\"keterangan\":\"test 2\",\"totalsetelahdiskon\":149000,\"totalsebelumdiskon\":149000,\"inserted_date\":\"2025-03-01 10:02:56\",\"updated_date\":\"2025-03-01 10:02:56\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-03-01 10:02:56','pembelian','simpanData'),(176,'[{\"idpembelian\":\"250301BL0000002\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"3\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"135000\"},{\"idpembelian\":\"250301BL0000002\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"1\",\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"14000\"}]','Budiman','2025-03-01 10:02:56','pembeliandetail','simpanData'),(177,'{\"idsupplier\":\"SUPIMN0001\",\"namasupplier\":\"PT. Intra Makmur\",\"alamatsupplier\":\"Jl. Pemuda\",\"kontakperson\":\"Bambang\",\"notelp\":\"081300000\",\"email\":\"bambang@gmail.com\",\"inserted_date\":\"2025-03-01 10:03:55\",\"updated_date\":\"2025-03-01 10:03:55\",\"statusaktif\":\"Aktif\"}','Budiman','2025-03-01 10:03:55','supplier','simpanData'),(178,'{\"lastlogin\":\"2025-03-03 15:28:31\"}','Budiman','2025-03-03 15:28:31','pengguna','updateData'),(179,'{\"lastlogin\":\"2025-03-04 01:03:25\"}','Budiman','2025-03-04 01:03:25','pengguna','updateData'),(180,'{\"idpenjualan\":\"250304JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503040001\",\"tglinvoice\":\"2025-03-04\",\"keterangan\":\"test\",\"totalsetelahdiskon\":15000,\"totalsebelumdiskon\":15000,\"inserted_date\":\"2025-03-04 01:10:31\",\"updated_date\":\"2025-03-04 01:10:31\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null}','Budiman','2025-03-04 01:10:31','penjualan','simpanData'),(181,'[{\"idpenjualan\":\"250304JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"}]','Budiman','2025-03-04 01:10:31','penjualandetail','simpanData'),(182,'{\"idpenjualan\":\"250304JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503040001\",\"tglinvoice\":\"2025-03-04\",\"keterangan\":\"test\",\"totalsetelahdiskon\":111000,\"totalsebelumdiskon\":111000,\"updated_date\":\"2025-03-04 01:19:11\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null}','Budiman','2025-03-04 01:19:11','penjualan','updateData'),(183,'[{\"idpenjualan\":\"250304JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"},{\"idpenjualan\":\"250304JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"2\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"96000\"}]','Budiman','2025-03-04 01:19:11','penjualandetail','updateData'),(184,'{\"idpenjualan\":\"250304JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503040001\",\"tglinvoice\":\"2025-03-04\",\"keterangan\":\"test\",\"totalsetelahdiskon\":111000,\"totalsebelumdiskon\":111000,\"updated_date\":\"2025-03-04 01:26:46\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null}','Budiman','2025-03-04 01:26:46','penjualan','updateData'),(185,'[{\"idpenjualan\":\"250304JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"},{\"idpenjualan\":\"250304JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"2\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"96000\"}]','Budiman','2025-03-04 01:26:46','penjualandetail','updateData'),(186,'{\"idpenjualan\":\"250304JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503040001\",\"tglinvoice\":\"2025-03-04\",\"keterangan\":\"test\",\"totalsetelahdiskon\":15000,\"totalsebelumdiskon\":15000,\"inserted_date\":\"2025-03-04 01:31:56\",\"updated_date\":\"2025-03-04 01:31:56\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null}','Budiman','2025-03-04 01:31:56','penjualan','simpanData'),(187,'[{\"idpenjualan\":\"250304JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"}]','Budiman','2025-03-04 01:31:56','penjualandetail','simpanData'),(188,'{\"idpenjualan\":\"250304JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503040001\",\"tglinvoice\":\"2025-03-04\",\"keterangan\":\"test\",\"totalsetelahdiskon\":15000,\"totalsebelumdiskon\":15000,\"updated_date\":\"2025-03-04 01:32:24\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null}','Budiman','2025-03-04 01:32:24','penjualan','updateData'),(189,'[{\"idpenjualan\":\"250304JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"}]','Budiman','2025-03-04 01:32:24','penjualandetail','updateData'),(190,'{\"idpenjualan\":\"250304JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-04\",\"noinvoice\":\"2503040001\",\"keterangan\":\"test\",\"totalsetelahdiskon\":\"15000\",\"totalsebelumdiskon\":\"15000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-04 01:31:56\",\"updated_date\":\"2025-03-04 01:32:24\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"CV. Karya Utama\"}','Budiman','2025-03-04 01:32:54','penjualan','hapusData'),(191,'[{\"id\":8,\"idpenjualan\":\"250304JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":1,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"}]','Budiman','2025-03-04 01:32:54','penjualandetail','hapusData'),(192,'{\"idpenjualan\":\"250304JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503040001\",\"tglinvoice\":\"2025-03-04\",\"keterangan\":\"test\",\"totalsetelahdiskon\":15000,\"totalsebelumdiskon\":15000,\"inserted_date\":\"2025-03-04 02:10:41\",\"updated_date\":\"2025-03-04 02:10:41\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null}','Budiman','2025-03-04 02:10:41','penjualan','simpanData'),(193,'[{\"idpenjualan\":\"250304JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"}]','Budiman','2025-03-04 02:10:41','penjualandetail','simpanData'),(194,'{\"idpenjualan\":\"250304JL0000002\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503040002\",\"tglinvoice\":\"2025-03-04\",\"keterangan\":\"test\",\"totalsetelahdiskon\":48000,\"totalsebelumdiskon\":48000,\"inserted_date\":\"2025-03-04 02:11:04\",\"updated_date\":\"2025-03-04 02:11:04\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null}','Budiman','2025-03-04 02:11:04','penjualan','simpanData'),(195,'[{\"idpenjualan\":\"250304JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"48000\"}]','Budiman','2025-03-04 02:11:04','penjualandetail','simpanData'),(196,'{\"idpenjualan\":\"250304JL0000003\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503040004\",\"tglinvoice\":\"2025-03-04\",\"keterangan\":\"test\",\"totalsetelahdiskon\":15000,\"totalsebelumdiskon\":15000,\"inserted_date\":\"2025-03-04 02:11:34\",\"updated_date\":\"2025-03-04 02:11:34\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null}','Budiman','2025-03-04 02:11:34','penjualan','simpanData'),(197,'[{\"idpenjualan\":\"250304JL0000003\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"}]','Budiman','2025-03-04 02:11:34','penjualandetail','simpanData'),(198,'{\"idpenjualan\":\"250304JL0000003\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503040004\",\"tglinvoice\":\"2025-03-04\",\"keterangan\":\"test\",\"totalsetelahdiskon\":15000,\"totalsebelumdiskon\":15000,\"updated_date\":\"2025-03-04 02:32:26\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null}','Budiman','2025-03-04 02:32:26','penjualan','updateData'),(199,'[{\"idpenjualan\":\"250304JL0000003\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"}]','Budiman','2025-03-04 02:32:26','penjualandetail','updateData'),(200,'{\"lastlogin\":\"2025-03-04 05:51:55\"}','Budiman','2025-03-04 05:51:55','pengguna','updateData'),(201,'{\"lastlogin\":\"2025-03-06 05:37:09\"}','Budiman','2025-03-06 05:37:09','pengguna','updateData'),(202,'{\"idpenjualan\":\"250304JL0000003\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503040004\",\"tglinvoice\":\"2025-03-04\",\"keterangan\":\"test\",\"totalsetelahdiskon\":15000,\"totalsebelumdiskon\":15000,\"updated_date\":\"2025-03-06 05:38:02\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null}','Budiman','2025-03-06 05:38:02','penjualan','updateData'),(203,'[{\"idpenjualan\":\"250304JL0000003\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"}]','Budiman','2025-03-06 05:38:02','penjualandetail','updateData'),(204,'{\"idpenjualan\":\"250306JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503060001\",\"tglinvoice\":\"2025-03-06\",\"keterangan\":\"test\",\"totalsetelahdiskon\":78000,\"totalsebelumdiskon\":78000,\"inserted_date\":\"2025-03-06 05:42:53\",\"updated_date\":\"2025-03-06 05:42:53\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\"}','Budiman','2025-03-06 05:42:53','penjualan','simpanData'),(205,'[{\"idpenjualan\":\"250306JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"48000\"},{\"idpenjualan\":\"250306JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"2\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"30000\"}]','Budiman','2025-03-06 05:42:53','penjualandetail','simpanData'),(206,'{\"prefix\":\"usaha_alamat\",\"values\":\"Jl. Perjuangan No.222 \\r\\nKota Pontianak\",\"inserted_date\":\"2025-03-06 06:07:36\",\"updated_date\":\"2025-03-06 06:07:36\",\"deskripsi\":\"Alamat Usaha\"}','Budiman','2025-03-06 06:07:36','settings','simpanData'),(207,'{\"lastlogin\":\"2025-03-06 06:08:26\"}','Budiman','2025-03-06 06:08:27','pengguna','updateData'),(208,'{\"prefix\":\"usaha_telepon\",\"values\":\"(0685) 22334455\",\"inserted_date\":\"2025-03-06 06:11:06\",\"updated_date\":\"2025-03-06 06:11:06\",\"deskripsi\":\"Nomor telepon usaha\"}','Budiman','2025-03-06 06:11:07','settings','simpanData'),(209,'{\"lastlogin\":\"2025-03-06 06:11:49\"}','Budiman','2025-03-06 06:11:49','pengguna','updateData'),(210,'{\"lastlogin\":\"2025-03-06 11:46:51\"}','Budiman','2025-03-06 11:46:51','pengguna','updateData'),(211,'{\"idpenjualan\":\"250304JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-04\",\"noinvoice\":\"2503040001\",\"keterangan\":\"test\",\"totalsetelahdiskon\":\"15000\",\"totalsebelumdiskon\":\"15000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-04 02:10:41\",\"updated_date\":\"2025-03-04 02:10:41\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"CV. Karya Utama\"}','Budiman','2025-03-06 11:51:19','penjualan','hapusData'),(212,'[{\"id\":9,\"idpenjualan\":\"250304JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":1,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"}]','Budiman','2025-03-06 11:51:19','penjualandetail','hapusData'),(213,'{\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"0102\",\"tglfaktur\":\"2025-03-06\",\"tglditerima\":\"2025-03-06\",\"keterangan\":\"test\",\"totalsetelahdiskon\":280000,\"totalsebelumdiskon\":280000,\"inserted_date\":\"2025-03-06 12:17:03\",\"updated_date\":\"2025-03-06 12:17:03\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-03-06 12:17:03','pembelian','simpanData'),(214,'[{\"idpembelian\":\"250306BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"20\",\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"280000\"}]','Budiman','2025-03-06 12:17:03','pembeliandetail','simpanData'),(215,'{\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"0102\",\"tglfaktur\":\"2025-03-06\",\"tglditerima\":\"2025-03-06\",\"keterangan\":\"test\",\"totalsetelahdiskon\":460000,\"totalsebelumdiskon\":460000,\"updated_date\":\"2025-03-06 12:33:46\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-03-06 12:33:47','pembelian','updateData'),(216,'[{\"idpembelian\":\"250306BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"20\",\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"280000\"},{\"idpembelian\":\"250306BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"4\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"180000\"}]','Budiman','2025-03-06 12:33:47','pembeliandetail','updateData'),(217,'{\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"0102\",\"tglfaktur\":\"2025-03-06\",\"tglditerima\":\"2025-03-06\",\"keterangan\":\"test\",\"totalsetelahdiskon\":180000,\"totalsebelumdiskon\":180000,\"updated_date\":\"2025-03-06 12:35:25\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-03-06 12:35:26','pembelian','updateData'),(218,'[{\"idpembelian\":\"250306BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"4\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"180000\"}]','Budiman','2025-03-06 12:35:26','pembeliandetail','updateData'),(219,'{\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"0102\",\"tglfaktur\":\"2025-03-06\",\"tglditerima\":\"2025-03-06\",\"keterangan\":\"test\",\"totalsetelahdiskon\":\"180000\",\"totalsebelumdiskon\":\"180000\",\"inserted_date\":\"2025-03-06 12:17:03\",\"updated_date\":\"2025-03-06 12:35:25\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null}','Budiman','2025-03-06 12:40:30','pembelian','hapusData'),(220,'[{\"id\":30,\"idpembelian\":\"250306BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":4,\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"180000\"}]','Budiman','2025-03-06 12:40:30','pembeliandetail','hapusData'),(221,'{\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"123\",\"tglfaktur\":\"2025-03-06\",\"tglditerima\":\"2025-03-06\",\"keterangan\":\"tets\",\"totalsetelahdiskon\":28000,\"totalsebelumdiskon\":28000,\"inserted_date\":\"2025-03-06 12:42:58\",\"updated_date\":\"2025-03-06 12:42:58\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-03-06 12:42:58','pembelian','simpanData'),(222,'[{\"idpembelian\":\"250306BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"2\",\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"28000\"}]','Budiman','2025-03-06 12:42:58','pembeliandetail','simpanData'),(223,'{\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"123\",\"tglfaktur\":\"2025-03-06\",\"tglditerima\":\"2025-03-06\",\"keterangan\":\"tets\",\"totalsetelahdiskon\":\"28000\",\"totalsebelumdiskon\":\"28000\",\"inserted_date\":\"2025-03-06 12:42:58\",\"updated_date\":\"2025-03-06 12:42:58\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null}','Budiman','2025-03-06 12:43:03','pembelian','hapusData'),(224,'[{\"id\":31,\"idpembelian\":\"250306BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":2,\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"28000\"}]','Budiman','2025-03-06 12:43:03','pembeliandetail','hapusData'),(225,'{\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"1212\",\"tglfaktur\":\"2025-03-06\",\"tglditerima\":\"2025-03-06\",\"keterangan\":\"test\",\"totalsetelahdiskon\":495000,\"totalsebelumdiskon\":495000,\"inserted_date\":\"2025-03-06 12:43:24\",\"updated_date\":\"2025-03-06 12:43:24\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-03-06 12:43:24','pembelian','simpanData'),(226,'[{\"idpembelian\":\"250306BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"11\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"495000\"}]','Budiman','2025-03-06 12:43:24','pembeliandetail','simpanData'),(227,'{\"idpembelian\":\"250306BL0000002\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"2222\",\"tglfaktur\":\"2025-03-06\",\"tglditerima\":\"2025-03-06\",\"keterangan\":\"ada\",\"totalsetelahdiskon\":990000,\"totalsebelumdiskon\":990000,\"inserted_date\":\"2025-03-06 12:43:45\",\"updated_date\":\"2025-03-06 12:43:45\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\"}','Budiman','2025-03-06 12:43:45','pembelian','simpanData'),(228,'[{\"idpembelian\":\"250306BL0000002\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"22\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"990000\"}]','Budiman','2025-03-06 12:43:45','pembeliandetail','simpanData'),(230,'{\"idhutangdetail\":\"250306HU0001002\",\"idhutang\":\"250306HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"100000\",\"inserted_date\":\"2025-03-07 02:21:55\",\"updated_date\":\"2025-03-07 02:21:55\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:21:55','hutangdetail','simpanData'),(231,'{\"idhutangdetail\":\"250306HU0001002\",\"idhutang\":\"250306HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":\"0\",\"kredit\":\"100000\",\"inserted_date\":\"2025-03-07 02:21:55\",\"updated_date\":\"2025-03-07 02:21:55\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-07 02:33:34','hutangdetail','hapusData'),(232,'{\"idhutangdetail\":\"250306HU0001002\",\"idhutang\":\"250306HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"495000\",\"inserted_date\":\"2025-03-07 02:34:58\",\"updated_date\":\"2025-03-07 02:34:58\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:34:58','hutangdetail','simpanData'),(233,'{\"idhutangdetail\":\"250306HU0001002\",\"idhutang\":\"250306HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":\"0\",\"kredit\":\"495000\",\"inserted_date\":\"2025-03-07 02:34:58\",\"updated_date\":\"2025-03-07 02:34:58\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-07 02:38:57','hutangdetail','hapusData'),(234,'{\"idhutangdetail\":\"250306HU0001002\",\"idhutang\":\"250306HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"495000\",\"inserted_date\":\"2025-03-07 02:39:13\",\"updated_date\":\"2025-03-07 02:39:13\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:39:13','hutangdetail','simpanData'),(235,'{\"idhutangdetail\":\"250306HU0001002\",\"idhutang\":\"250306HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":\"0\",\"kredit\":\"495000\",\"inserted_date\":\"2025-03-07 02:39:13\",\"updated_date\":\"2025-03-07 02:39:13\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-07 02:42:36','hutangdetail','hapusData'),(236,'{\"idhutangdetail\":\"250306HU0001002\",\"idhutang\":\"250306HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"100000\",\"inserted_date\":\"2025-03-07 02:42:58\",\"updated_date\":\"2025-03-07 02:42:58\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:42:58','hutangdetail','simpanData'),(237,'{\"idhutangdetail\":\"250306HU0001002\",\"idhutang\":\"250306HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":\"0\",\"kredit\":\"100000\",\"inserted_date\":\"2025-03-07 02:42:58\",\"updated_date\":\"2025-03-07 02:42:58\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-07 02:44:16','hutangdetail','hapusData'),(238,'{\"idhutangdetail\":\"250306HU0001002\",\"idhutang\":\"250306HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"100000\",\"inserted_date\":\"2025-03-07 02:44:26\",\"updated_date\":\"2025-03-07 02:44:26\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:44:26','hutangdetail','simpanData'),(239,'{\"idhutangdetail\":\"250306HU0001003\",\"idhutang\":\"250306HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"395000\",\"inserted_date\":\"2025-03-07 02:44:36\",\"updated_date\":\"2025-03-07 02:44:36\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:44:36','hutangdetail','simpanData'),(240,'{\"idpembelian\":\"250306BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"1212\",\"tglfaktur\":\"2025-03-06\",\"tglditerima\":\"2025-03-06\",\"keterangan\":\"test\",\"totalsetelahdiskon\":\"495000\",\"totalsebelumdiskon\":\"495000\",\"inserted_date\":\"2025-03-06 12:43:24\",\"updated_date\":\"2025-03-06 12:43:24\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null}','Budiman','2025-03-07 02:47:17','pembelian','hapusData'),(241,'[{\"id\":32,\"idpembelian\":\"250306BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":11,\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"495000\"}]','Budiman','2025-03-07 02:47:17','pembeliandetail','hapusData'),(242,'{\"idpembelian\":\"250307BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"1111\",\"tglfaktur\":\"2025-03-07\",\"tglditerima\":\"2025-03-07\",\"keterangan\":\"abc\",\"totalsetelahdiskon\":1040000,\"totalsebelumdiskon\":1040000,\"inserted_date\":\"2025-03-07 02:48:02\",\"updated_date\":\"2025-03-07 02:48:02\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-03-07 02:48:02','pembelian','simpanData'),(243,'[{\"idpembelian\":\"250307BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"10\",\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"140000\"},{\"idpembelian\":\"250307BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"20\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"900000\"}]','Budiman','2025-03-07 02:48:02','pembeliandetail','simpanData'),(244,'{\"idhutangdetail\":\"250307HU0001002\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"500000\",\"inserted_date\":\"2025-03-07 02:48:21\",\"updated_date\":\"2025-03-07 02:48:21\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:48:21','hutangdetail','simpanData'),(245,'{\"idhutangdetail\":\"250307HU0001003\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"540000\",\"inserted_date\":\"2025-03-07 02:48:44\",\"updated_date\":\"2025-03-07 02:48:44\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:48:44','hutangdetail','simpanData'),(246,'{\"idhutangdetail\":\"250307HU0001003\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":\"0\",\"kredit\":\"540000\",\"inserted_date\":\"2025-03-07 02:48:44\",\"updated_date\":\"2025-03-07 02:48:44\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250307BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-07 02:49:02','hutangdetail','hapusData'),(247,'{\"idhutangdetail\":\"250307HU0001003\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"600000\",\"inserted_date\":\"2025-03-07 02:49:16\",\"updated_date\":\"2025-03-07 02:49:16\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:49:16','hutangdetail','simpanData'),(248,'{\"idhutangdetail\":\"250307HU0001003\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":\"0\",\"kredit\":\"600000\",\"inserted_date\":\"2025-03-07 02:49:16\",\"updated_date\":\"2025-03-07 02:49:16\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250307BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-07 02:53:56','hutangdetail','hapusData'),(249,'{\"idhutangdetail\":\"250307HU0001002\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":\"0\",\"kredit\":\"500000\",\"inserted_date\":\"2025-03-07 02:48:21\",\"updated_date\":\"2025-03-07 02:48:21\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250307BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-07 02:54:18','hutangdetail','hapusData'),(250,'{\"idhutangdetail\":\"250307HU0001002\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"300000\",\"inserted_date\":\"2025-03-07 02:54:49\",\"updated_date\":\"2025-03-07 02:54:49\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:54:49','hutangdetail','simpanData'),(251,'{\"idhutangdetail\":\"250307HU0001003\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"740000\",\"inserted_date\":\"2025-03-07 02:55:25\",\"updated_date\":\"2025-03-07 02:55:25\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:55:25','hutangdetail','simpanData'),(252,'{\"idhutangdetail\":\"250307HU0001002\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":\"0\",\"kredit\":\"300000\",\"inserted_date\":\"2025-03-07 02:54:49\",\"updated_date\":\"2025-03-07 02:54:49\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250307BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-07 02:55:57','hutangdetail','hapusData'),(253,'{\"idhutangdetail\":\"250307HU0001004\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"300000\",\"inserted_date\":\"2025-03-07 02:56:14\",\"updated_date\":\"2025-03-07 02:56:14\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-07 02:56:14','hutangdetail','simpanData'),(254,'{\"idhutangdetail\":\"250307HU0001004\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":\"0\",\"kredit\":\"300000\",\"inserted_date\":\"2025-03-07 02:56:14\",\"updated_date\":\"2025-03-07 02:56:14\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250307BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-07 03:26:14','hutangdetail','hapusData'),(255,'{\"idpiutangdetail\":\"250306PI0001002\",\"idpiutang\":\"250306PI0001\",\"tglpiutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"50000\",\"inserted_date\":\"2025-03-07 06:13:10\",\"updated_date\":\"2025-03-07 06:13:10\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Piutang\"}','Budiman','2025-03-07 06:13:10','piutangdetail','simpanData'),(256,'{\"idpiutangdetail\":\"250306PI0001003\",\"idpiutang\":\"250306PI0001\",\"tglpiutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"28000\",\"inserted_date\":\"2025-03-07 06:14:31\",\"updated_date\":\"2025-03-07 06:14:31\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Piutang\"}','Budiman','2025-03-07 06:14:31','piutangdetail','simpanData'),(257,'{\"idpiutangdetail\":\"250306PI0001003\",\"idpiutang\":\"250306PI0001\",\"tglpiutang\":\"2025-03-07\",\"debet\":\"0\",\"kredit\":\"28000\",\"inserted_date\":\"2025-03-07 06:14:31\",\"updated_date\":\"2025-03-07 06:14:31\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250306JL0000001\",\"idjenispiutang\":\"P02\",\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Central Asia\"}','Budiman','2025-03-07 06:15:10','piutangdetail','hapusData'),(258,'{\"idpiutangdetail\":\"250306PI0001003\",\"idpiutang\":\"250306PI0001\",\"tglpiutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"28000\",\"inserted_date\":\"2025-03-07 06:16:03\",\"updated_date\":\"2025-03-07 06:16:03\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Piutang\"}','Budiman','2025-03-07 06:16:03','piutangdetail','simpanData'),(259,'{\"idpenjualan\":\"250307JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503070001\",\"tglinvoice\":\"2025-03-07\",\"keterangan\":\"test\",\"totalsetelahdiskon\":348000,\"totalsebelumdiskon\":348000,\"inserted_date\":\"2025-03-07 06:16:37\",\"updated_date\":\"2025-03-07 06:16:37\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\"}','Budiman','2025-03-07 06:16:37','penjualan','simpanData'),(260,'[{\"idpenjualan\":\"250307JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"1\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"48000\"},{\"idpenjualan\":\"250307JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"20\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"300000\"}]','Budiman','2025-03-07 06:16:37','penjualandetail','simpanData'),(261,'{\"idpiutangdetail\":\"250307PI0001002\",\"idpiutang\":\"250307PI0001\",\"tglpiutang\":\"2025-03-07\",\"debet\":0,\"kredit\":\"100000\",\"inserted_date\":\"2025-03-07 06:19:05\",\"updated_date\":\"2025-03-07 06:19:05\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\"}','Budiman','2025-03-07 06:19:05','piutangdetail','simpanData'),(262,'{\"lastlogin\":\"2025-03-07 16:25:34\"}','Budiman','2025-03-07 16:25:34','pengguna','updateData'),(263,'{\"lastlogin\":\"2025-03-08 06:51:03\"}','Budiman','2025-03-08 06:51:03','pengguna','updateData'),(264,'{\"kdakun\":\"5.1.01\",\"namaakun\":\"Gaji Pegawai\",\"kdparent\":\"5.1\",\"inserted_date\":\"2025-03-08 07:26:30\",\"updated_date\":\"2025-03-08 07:26:30\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-03-08 07:26:31','akun','simpanData'),(265,'{\"kdakun\":\"5.1.02\",\"namaakun\":\"Gaji Non Pegawai\",\"kdparent\":\"5.1\",\"inserted_date\":\"2025-03-08 07:26:54\",\"updated_date\":\"2025-03-08 07:26:54\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-03-08 07:26:54','akun','simpanData'),(266,'{\"kdakun\":\"5.2.01\",\"namaakun\":\"Jasa pemeliharaan barang kantor\",\"kdparent\":\"5.2\",\"inserted_date\":\"2025-03-08 07:33:17\",\"updated_date\":\"2025-03-08 07:33:17\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-03-08 07:33:17','akun','simpanData'),(267,'{\"kdakun\":\"5.2.02\",\"namaakun\":\"Jasa pemeliharaan software\",\"kdparent\":\"5.2\",\"inserted_date\":\"2025-03-08 07:33:54\",\"updated_date\":\"2025-03-08 07:33:54\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-03-08 07:33:54','akun','simpanData'),(268,'{\"kdakun\":\"5.3.01\",\"namaakun\":\"Beban barang habis pakai\",\"kdparent\":\"5.3\",\"inserted_date\":\"2025-03-08 07:35:03\",\"updated_date\":\"2025-03-08 07:35:03\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-03-08 07:35:03','akun','simpanData'),(269,'{\"kdakun\":\"5.2.01\",\"namaakun\":\"Jasa Pemeliharaan Barang Kantor\",\"updated_date\":\"2025-03-08 07:35:54\"}','Budiman','2025-03-08 07:35:54','akun','updateData'),(270,'{\"kdakun\":\"5.2.02\",\"namaakun\":\"Jasa Pemeliharaan Software\",\"updated_date\":\"2025-03-08 07:36:04\"}','Budiman','2025-03-08 07:36:04','akun','updateData'),(271,'{\"kdakun\":\"5.3.01\",\"namaakun\":\"Beban Barang Habis Pakai\",\"updated_date\":\"2025-03-08 07:36:16\"}','Budiman','2025-03-08 07:36:16','akun','updateData'),(272,'{\"kdakun\":\"5.3.02\",\"namaakun\":\"Beban Peralatan Kantor\",\"kdparent\":\"5.3\",\"inserted_date\":\"2025-03-08 07:36:37\",\"updated_date\":\"2025-03-08 07:36:37\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-03-08 07:36:37','akun','simpanData'),(273,'{\"kdakun\":\"5.3.03\",\"namaakun\":\"Perlengkapan Kantor\",\"kdparent\":\"5.3\",\"inserted_date\":\"2025-03-08 07:36:56\",\"updated_date\":\"2025-03-08 07:36:56\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-03-08 07:36:56','akun','simpanData'),(274,'{\"kdakun\":\"5.3.03\",\"namaakun\":\"Beban Perlengkapan Kantor\",\"updated_date\":\"2025-03-08 07:37:05\"}','Budiman','2025-03-08 07:37:05','akun','updateData'),(275,'{\"kdakun\":\"5.1.01.01\",\"namaakun\":\"Gaji Pokok Pegawai\",\"kdparent\":\"5.1.01\",\"inserted_date\":\"2025-03-08 07:37:31\",\"updated_date\":\"2025-03-08 07:37:31\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:37:31','akun','simpanData'),(276,'{\"kdakun\":\"5.1.01.02\",\"namaakun\":\"Gaji Tunjangan Pegawai\",\"kdparent\":\"5.1.01\",\"inserted_date\":\"2025-03-08 07:37:45\",\"updated_date\":\"2025-03-08 07:37:45\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:37:45','akun','simpanData'),(277,'{\"kdakun\":\"5.1.02.01\",\"namaakun\":\"Upah Harian Non Pegawai\",\"kdparent\":\"5.1.02\",\"inserted_date\":\"2025-03-08 07:38:08\",\"updated_date\":\"2025-03-08 07:38:08\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:38:08','akun','simpanData'),(278,'{\"kdakun\":\"5.1.02.02\",\"namaakun\":\"Upah bulanan non pegawai\",\"kdparent\":\"5.1.02\",\"inserted_date\":\"2025-03-08 07:38:27\",\"updated_date\":\"2025-03-08 07:38:27\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:38:27','akun','simpanData'),(279,'{\"kdakun\":\"5.1.02.01\",\"namaakun\":\"Upah harian non pegawai\",\"updated_date\":\"2025-03-08 07:38:37\"}','Budiman','2025-03-08 07:38:37','akun','updateData'),(280,'{\"kdakun\":\"5.1.02.01\",\"namaakun\":\"Upah Harian Non Pegawai\",\"updated_date\":\"2025-03-08 07:39:00\"}','Budiman','2025-03-08 07:39:00','akun','updateData'),(281,'{\"kdakun\":\"5.1.02.02\",\"namaakun\":\"Upah Bulanan Non Pegawai\",\"updated_date\":\"2025-03-08 07:39:13\"}','Budiman','2025-03-08 07:39:13','akun','updateData'),(282,'{\"kdakun\":\"5.2.01.01\",\"namaakun\":\"Pemeliharaan AC \\/ Pendingin Ruangan\",\"kdparent\":\"5.2.01\",\"inserted_date\":\"2025-03-08 07:39:44\",\"updated_date\":\"2025-03-08 07:39:44\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:39:44','akun','simpanData'),(283,'{\"kdakun\":\"5.2.02.01\",\"namaakun\":\"Pemeliharaan Web Aplikasi POS\",\"kdparent\":\"5.2.02\",\"inserted_date\":\"2025-03-08 07:40:40\",\"updated_date\":\"2025-03-08 07:40:40\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:40:40','akun','simpanData'),(284,'{\"kdakun\":\"5.3.01.01\",\"namaakun\":\"Beban Kertas F4\",\"kdparent\":\"5.3.01\",\"inserted_date\":\"2025-03-08 07:41:12\",\"updated_date\":\"2025-03-08 07:41:12\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:41:12','akun','simpanData'),(285,'{\"kdakun\":\"5.3.01.02\",\"namaakun\":\"Beban Kertas Blanko Kwitansi\",\"kdparent\":\"5.3.01\",\"inserted_date\":\"2025-03-08 07:41:49\",\"updated_date\":\"2025-03-08 07:41:49\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:41:49','akun','simpanData'),(286,'{\"kdakun\":\"5.3.02.01\",\"namaakun\":\"Beban Komputer\\/ PC\",\"kdparent\":\"5.3.02\",\"inserted_date\":\"2025-03-08 07:42:12\",\"updated_date\":\"2025-03-08 07:42:12\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:42:12','akun','simpanData'),(287,'{\"kdakun\":\"5.3.02.02\",\"namaakun\":\"Beban Laptop\",\"kdparent\":\"5.3.02\",\"inserted_date\":\"2025-03-08 07:42:26\",\"updated_date\":\"2025-03-08 07:42:26\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:42:26','akun','simpanData'),(288,'{\"kdakun\":\"5.2.01.03\",\"namaakun\":\"Pemeliharaan Komputer\\/ Laptop\",\"kdparent\":\"5.2.01\",\"inserted_date\":\"2025-03-08 07:42:51\",\"updated_date\":\"2025-03-08 07:42:51\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:42:51','akun','simpanData'),(289,'{\"kdakun\":\"5.2.01.01\",\"namaakun\":\"Jasa Pemeliharaan AC \\/ Pendingin Ruangan\",\"updated_date\":\"2025-03-08 07:43:10\"}','Budiman','2025-03-08 07:43:10','akun','updateData'),(290,'{\"kdakun\":\"5.2.01.03\",\"namaakun\":\"Jasa Pemeliharaan Komputer\\/ Laptop\",\"updated_date\":\"2025-03-08 07:43:20\"}','Budiman','2025-03-08 07:43:20','akun','updateData'),(291,'{\"kdakun\":\"5.2.02.01\",\"namaakun\":\"JasaPemeliharaan Web Aplikasi POS\",\"updated_date\":\"2025-03-08 07:43:29\"}','Budiman','2025-03-08 07:43:29','akun','updateData'),(292,'{\"kdakun\":\"5.2.02.01\",\"namaakun\":\"Jasa Pemeliharaan Web Aplikasi POS\",\"updated_date\":\"2025-03-08 07:43:37\"}','Budiman','2025-03-08 07:43:37','akun','updateData'),(293,'{\"kdakun\":\"5.3.03.01\",\"namaakun\":\"Beban Lemari Berkas\",\"kdparent\":\"5.3.03\",\"inserted_date\":\"2025-03-08 07:44:10\",\"updated_date\":\"2025-03-08 07:44:10\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 07:44:10','akun','simpanData'),(294,'{\"idpengeluaran\":\"250308PL0000001\",\"tglpengeluaran\":\"2025-03-08\",\"nokwitansi\":\"123\",\"totalpengeluaran\":2000000,\"keterangan\":\"test\",\"inserted_date\":\"2025-03-08 08:06:47\",\"updated_date\":\"2025-03-08 08:06:47\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-03-08 08:06:47','pengeluaran','simpanData'),(295,'[{\"idpengeluaran\":\"250308PL0000001\",\"kdakun\":\"5.1.01.01\",\"jumlahpengeluaran\":\"2000000\"}]','Budiman','2025-03-08 08:06:47','pengeluarandetail','simpanData'),(296,'{\"idpengeluaran\":\"250308PL0000001\",\"tglpengeluaran\":\"2025-03-08\",\"nokwitansi\":\"123\",\"totalpengeluaran\":2500000,\"keterangan\":\"test\",\"updated_date\":\"2025-03-08 08:20:12\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-03-08 08:20:12','pengeluaran','updateData'),(297,'[{\"idpengeluaran\":\"250308PL0000001\",\"kdakun\":\"5.1.01.01\",\"jumlahpengeluaran\":\"2000000\"},{\"idpengeluaran\":\"250308PL0000001\",\"kdakun\":\"5.1.01.02\",\"jumlahpengeluaran\":\"500000\"}]','Budiman','2025-03-08 08:20:12','pengeluarandetail','updateData'),(298,'{\"idpengeluaran\":\"250308PL0000001\",\"tglpengeluaran\":\"2025-03-08\",\"nokwitansi\":\"123\",\"totalpengeluaran\":\"2500000\",\"keterangan\":\"test\",\"inserted_date\":\"2025-03-08 08:06:47\",\"updated_date\":\"2025-03-08 08:20:12\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"kdakunbank\":\"1.1.01.02\"}','Budiman','2025-03-08 08:23:00','pengeluaran','hapusData'),(299,'[{\"idpengeluarandetail\":2,\"idpengeluaran\":\"250308PL0000001\",\"kdakun\":\"5.1.01.01\",\"jumlahpengeluaran\":\"2000000\"},{\"idpengeluarandetail\":3,\"idpengeluaran\":\"250308PL0000001\",\"kdakun\":\"5.1.01.02\",\"jumlahpengeluaran\":\"500000\"}]','Budiman','2025-03-08 08:23:00','pengeluarandetail','hapusData'),(300,'{\"kdakun\":\"4.1.01\",\"namaakun\":\"Penjualan Usaha Dagang\",\"kdparent\":\"4.1\",\"inserted_date\":\"2025-03-08 08:51:19\",\"updated_date\":\"2025-03-08 08:51:19\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-03-08 08:51:19','akun','simpanData'),(301,'{\"kdakun\":\"4.2.01\",\"namaakun\":\"Pendapatan Dari Biaya Sewa\",\"kdparent\":\"4.2\",\"inserted_date\":\"2025-03-08 08:51:34\",\"updated_date\":\"2025-03-08 08:51:34\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-03-08 08:51:34','akun','simpanData'),(302,'{\"kdakun\":\"4.1.01.01\",\"namaakun\":\"Penjualan Barang Dagang\",\"kdparent\":\"4.1.01\",\"inserted_date\":\"2025-03-08 08:52:10\",\"updated_date\":\"2025-03-08 08:52:10\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 08:52:10','akun','simpanData'),(303,'{\"kdakun\":\"4.2.01.01\",\"namaakun\":\"Pendapatan biaya sewa truk\",\"kdparent\":\"4.2.01\",\"inserted_date\":\"2025-03-08 08:52:33\",\"updated_date\":\"2025-03-08 08:52:33\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-08 08:52:33','akun','simpanData'),(304,'{\"kdakun\":\"4.2.01.01\",\"namaakun\":\"Pendapatan Sewa Truk\",\"updated_date\":\"2025-03-08 08:52:47\"}','Budiman','2025-03-08 08:52:47','akun','updateData'),(305,'{\"kdakun\":\"4.2.01\",\"namaakun\":\"Pendapatan Sewa\",\"updated_date\":\"2025-03-08 08:53:15\"}','Budiman','2025-03-08 08:53:15','akun','updateData'),(306,'{\"idpenerimaan\":\"250308PN0000001\",\"tglpenerimaan\":\"2025-03-08\",\"totalpenerimaan\":1500000,\"keterangan\":\"test\",\"inserted_date\":\"2025-03-08 08:58:27\",\"updated_date\":\"2025-03-08 08:58:27\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-03-08 08:58:27','penerimaan','simpanData'),(307,'[{\"idpenerimaan\":\"250308PN0000001\",\"kdakun\":\"4.2.01.01\",\"jumlahpenerimaan\":\"1500000\"}]','Budiman','2025-03-08 08:58:27','penerimaandetail','simpanData'),(308,'{\"idpenerimaan\":\"250308PN0000001\",\"tglpenerimaan\":\"2025-03-08\",\"totalpenerimaan\":1600000,\"keterangan\":\"test\",\"updated_date\":\"2025-03-08 09:00:35\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-03-08 09:00:35','penerimaan','updateData'),(309,'[{\"idpenerimaan\":\"250308PN0000001\",\"kdakun\":\"4.2.01.01\",\"jumlahpenerimaan\":\"1500000\"},{\"idpenerimaan\":\"250308PN0000001\",\"kdakun\":\"4.1.01.01\",\"jumlahpenerimaan\":\"100000\"}]','Budiman','2025-03-08 09:00:35','penerimaandetail','updateData'),(310,'{\"lastlogin\":\"2025-03-08 15:08:12\"}','Budiman','2025-03-08 15:08:12','pengguna','updateData'),(311,'{\"idjurnal\":\"250308JP0000001\",\"tgljurnal\":\"2025-03-08\",\"keterangan\":\"test\",\"totaldebet\":\"1000\",\"totalkredit\":\"1000\",\"inserted_date\":\"2025-03-08 16:56:00\",\"updated_date\":\"2025-03-08 16:56:00\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Jurnal Penyesuaian\"}','Budiman','2025-03-08 16:56:00','jurnal','simpanData'),(312,'[{\"idjurnal\":\"250308JP0000001\",\"kdakun\":\"1.1.01.01\",\"debet\":\"1000\",\"kredit\":\"0\"},{\"idjurnal\":\"250308JP0000001\",\"kdakun\":\"1.1.01.02\",\"debet\":\"0\",\"kredit\":\"1000\"}]','Budiman','2025-03-08 16:56:00','jurnaldetail','simpanData'),(313,'{\"idjurnal\":\"250308JP0000001\",\"tgljurnal\":\"2025-03-08\",\"keterangan\":\"test\",\"totaldebet\":\"1000\",\"totalkredit\":\"1000\",\"updated_date\":\"2025-03-08 17:08:24\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Jurnal Penyesuaian\"}','Budiman','2025-03-08 17:08:24','jurnal','updateData'),(314,'[{\"idjurnal\":\"250308JP0000001\",\"kdakun\":\"1.1.01.01\",\"debet\":\"1000\",\"kredit\":\"0\"},{\"idjurnal\":\"250308JP0000001\",\"kdakun\":\"4.1.01.01\",\"debet\":\"0\",\"kredit\":\"1000\"}]','Budiman','2025-03-08 17:08:24','jurnaldetail','updateData'),(315,'{\"idjurnal\":\"250308JP0000001\",\"tgljurnal\":\"2025-03-08\",\"keterangan\":\"coba coba\",\"totaldebet\":\"1000\",\"totalkredit\":\"1000\",\"updated_date\":\"2025-03-08 17:08:39\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Jurnal Penyesuaian\"}','Budiman','2025-03-08 17:08:39','jurnal','updateData'),(316,'[{\"idjurnal\":\"250308JP0000001\",\"kdakun\":\"1.1.01.01\",\"debet\":\"1000\",\"kredit\":\"0\"},{\"idjurnal\":\"250308JP0000001\",\"kdakun\":\"4.1.01.01\",\"debet\":\"0\",\"kredit\":\"1000\"}]','Budiman','2025-03-08 17:08:39','jurnaldetail','updateData'),(317,'{\"idjurnal\":\"250309JP0000001\",\"tgljurnal\":\"2025-03-08\",\"keterangan\":\"teststst\",\"totaldebet\":\"15000\",\"totalkredit\":\"15000\",\"inserted_date\":\"2025-03-08 17:11:06\",\"updated_date\":\"2025-03-08 17:11:06\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Jurnal Penyesuaian\"}','Budiman','2025-03-08 17:11:06','jurnal','simpanData'),(318,'[{\"idjurnal\":\"250309JP0000001\",\"kdakun\":\"1.1.01.02\",\"debet\":\"15000\",\"kredit\":\"0\"},{\"idjurnal\":\"250309JP0000001\",\"kdakun\":\"4.2.01.01\",\"debet\":\"0\",\"kredit\":\"15000\"}]','Budiman','2025-03-08 17:11:06','jurnaldetail','simpanData'),(319,'{\"idjurnal\":\"250308JP0000001\",\"tgljurnal\":\"2025-03-08\",\"keterangan\":\"coba coba\",\"totaldebet\":\"1000\",\"totalkredit\":\"1000\",\"referensi\":null,\"jenis\":\"Jurnal Penyesuaian\",\"inserted_date\":\"2025-03-08 16:56:00\",\"updated_date\":\"2025-03-08 17:08:39\",\"idpengguna\":\"USRBID0001\",\"idposting\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-03-08 17:12:50','jurnal','hapusData'),(320,'[{\"idjurnaldetail\":5,\"idjurnal\":\"250308JP0000001\",\"kdakun\":\"1.1.01.01\",\"debet\":\"1000\",\"kredit\":\"0\",\"urut\":null},{\"idjurnaldetail\":6,\"idjurnal\":\"250308JP0000001\",\"kdakun\":\"4.1.01.01\",\"debet\":\"0\",\"kredit\":\"1000\",\"urut\":null}]','Budiman','2025-03-08 17:12:50','jurnaldetail','hapusData'),(321,'{\"idjurnal\":\"250309JP0000001\",\"tgljurnal\":\"2025-03-08\",\"keterangan\":\"coba coba\",\"totaldebet\":\"15000\",\"totalkredit\":\"15000\",\"updated_date\":\"2025-03-08 17:13:02\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Jurnal Penyesuaian\"}','Budiman','2025-03-08 17:13:02','jurnal','updateData'),(322,'[{\"idjurnal\":\"250309JP0000001\",\"kdakun\":\"1.1.01.02\",\"debet\":\"15000\",\"kredit\":\"0\"},{\"idjurnal\":\"250309JP0000001\",\"kdakun\":\"4.2.01.01\",\"debet\":\"0\",\"kredit\":\"15000\"}]','Budiman','2025-03-08 17:13:02','jurnaldetail','updateData'),(323,'{\"idjurnal\":\"250309JP0000001\",\"tgljurnal\":\"2025-03-08\",\"keterangan\":\"coba coba\",\"totaldebet\":\"15000\",\"totalkredit\":\"15000\",\"updated_date\":\"2025-03-08 17:40:43\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Jurnal Penyesuaian\"}','Budiman','2025-03-08 17:40:43','jurnal','updateData'),(324,'[{\"idjurnal\":\"250309JP0000001\",\"kdakun\":\"1.1.01.02\",\"debet\":\"15000\",\"kredit\":\"0\"},{\"idjurnal\":\"250309JP0000001\",\"kdakun\":\"4.2.01.01\",\"debet\":\"0\",\"kredit\":\"15000\"}]','Budiman','2025-03-08 17:40:43','jurnaldetail','updateData'),(325,'{\"lastlogin\":\"2025-03-09 06:05:45\"}','Budiman','2025-03-09 06:05:45','pengguna','updateData'),(326,'{\"lastlogin\":\"2025-03-11 01:56:00\"}','Budiman','2025-03-11 01:56:00','pengguna','updateData'),(327,'{\"lastlogin\":\"2025-03-11 07:04:02\"}','Budiman','2025-03-11 07:04:03','pengguna','updateData'),(328,'{\"idstockopname\":\"250311SO0000001\",\"tglstockopname\":\"2025-03-11\",\"keterangan\":\"test\",\"inserted_date\":\"2025-03-11 07:21:08\",\"updated_date\":\"2025-03-11 07:21:08\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-11 07:21:09','stockopname','simpanData'),(329,'[{\"idstockopname\":\"250311SO0000001\",\"idbarang\":\"K001000002\",\"stocksystem\":\"55\",\"stockopname\":\"2\",\"keterangandetail\":\"a\"},{\"idstockopname\":\"250311SO0000001\",\"idbarang\":\"K001000001\",\"stocksystem\":\"-16\",\"stockopname\":\"1\",\"keterangandetail\":\"b\"}]','Budiman','2025-03-11 07:21:09','stockopnamedetail','simpanData'),(330,'{\"idstockopname\":\"250311SO0000001\",\"tglstockopname\":\"2025-03-11 07:28:10\",\"keterangan\":\"test\",\"inserted_date\":\"2025-03-11 07:28:10\",\"updated_date\":\"2025-03-11 07:28:10\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-11 07:28:10','stockopname','simpanData'),(331,'[{\"idstockopname\":\"250311SO0000001\",\"idbarang\":\"K001000002\",\"stocksystem\":\"2\",\"stockopname\":\"10\",\"keterangandetail\":null},{\"idstockopname\":\"250311SO0000001\",\"idbarang\":\"K001000001\",\"stocksystem\":\"1\",\"stockopname\":\"20\",\"keterangandetail\":null}]','Budiman','2025-03-11 07:28:10','stockopnamedetail','simpanData'),(332,'{\"lastlogin\":\"2025-03-12 01:15:37\"}','Budiman','2025-03-12 01:15:37','pengguna','updateData'),(333,'{\"lastlogin\":\"2025-03-12 12:19:29\"}','Budiman','2025-03-12 12:19:29','pengguna','updateData'),(334,'{\"idreturpembelian\":\"250312RB0000001\",\"idpembelian\":\"250306BL0000002\",\"tglretur\":\"2025-03-12\",\"totalretur\":450000,\"keterangan\":\"test\",\"inserted_date\":\"2025-03-12 15:10:58\",\"updated_date\":\"2025-03-12 15:10:58\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-03-12 15:10:58','returpembelian','simpanData'),(335,'[{\"idreturpembelian\":\"250312RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"10\",\"hargaretur\":\"45000\",\"subtotalretur\":\"450000\"}]','Budiman','2025-03-12 15:10:58','returpembeliandetail','simpanData'),(336,'{\"lastlogin\":\"2025-03-13 03:57:14\"}','Budiman','2025-03-13 03:57:14','pengguna','updateData'),(337,'{\"idreturpembelian\":\"250312RB0000001\",\"idpembelian\":\"250306BL0000002\",\"tglretur\":\"2025-03-12\",\"totalretur\":\"450000\",\"keterangan\":\"test\",\"inserted_date\":\"2025-03-12 15:10:58\",\"updated_date\":\"2025-03-12 15:10:58\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPIMN0001\",\"namasupplier\":\"PT. Intra Makmur\",\"tglfaktur\":\"2025-03-06\"}','Budiman','2025-03-13 04:02:09','returpembelian','hapusData'),(338,'[{\"idreturdetail\":1,\"idreturpembelian\":\"250312RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":10,\"hargaretur\":\"45000\",\"subtotalretur\":\"450000\"}]','Budiman','2025-03-13 04:02:09','returpembeliandetail','hapusData'),(339,'{\"idreturpembelian\":\"250313RB0000001\",\"idpembelian\":\"250306BL0000002\",\"tglretur\":\"2025-03-13\",\"totalretur\":225000,\"keterangan\":null,\"inserted_date\":\"2025-03-13 04:11:39\",\"updated_date\":\"2025-03-13 04:11:39\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null}','Budiman','2025-03-13 04:11:39','returpembelian','simpanData'),(340,'[{\"idreturpembelian\":\"250313RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"5\",\"hargaretur\":\"45000\",\"subtotalretur\":\"225000\"}]','Budiman','2025-03-13 04:11:39','returpembeliandetail','simpanData'),(341,'{\"idreturpembelian\":\"250313RB0000002\",\"idpembelian\":\"250306BL0000002\",\"tglretur\":\"2025-03-13\",\"totalretur\":765000,\"keterangan\":\"test\",\"inserted_date\":\"2025-03-13 04:13:28\",\"updated_date\":\"2025-03-13 04:13:28\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-03-13 04:13:28','returpembelian','simpanData'),(342,'[{\"idreturpembelian\":\"250313RB0000002\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"17\",\"hargaretur\":\"45000\",\"subtotalretur\":\"765000\"}]','Budiman','2025-03-13 04:13:28','returpembeliandetail','simpanData'),(343,'{\"idreturpembelian\":\"250313RB0000003\",\"idpembelian\":\"250307BL0000001\",\"tglretur\":\"2025-03-13\",\"totalretur\":14000,\"keterangan\":\"test\",\"inserted_date\":\"2025-03-13 04:13:53\",\"updated_date\":\"2025-03-13 04:13:53\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-03-13 04:13:53','returpembelian','simpanData'),(344,'[{\"idreturpembelian\":\"250313RB0000003\",\"idbarang\":\"K001000001\",\"jumlahretur\":\"1\",\"hargaretur\":\"14000\",\"subtotalretur\":\"14000\"}]','Budiman','2025-03-13 04:13:53','returpembeliandetail','simpanData'),(345,'{\"idreturpembelian\":\"250313RB0000001\",\"idpembelian\":\"250306BL0000002\",\"tglretur\":\"2025-03-13\",\"totalretur\":\"225000\",\"keterangan\":null,\"inserted_date\":\"2025-03-13 04:11:39\",\"updated_date\":\"2025-03-13 04:11:39\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPIMN0001\",\"namasupplier\":\"PT. Intra Makmur\",\"tglfaktur\":\"2025-03-06\"}','Budiman','2025-03-13 04:14:00','returpembelian','hapusData'),(346,'[{\"idreturdetail\":2,\"idreturpembelian\":\"250313RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":5,\"hargaretur\":\"45000\",\"subtotalretur\":\"225000\"}]','Budiman','2025-03-13 04:14:00','returpembeliandetail','hapusData'),(347,'{\"idreturpenjualan\":\"250313RJ0000001\",\"idpenjualan\":\"250307JL0000001\",\"tglretur\":\"2025-03-13\",\"totalretur\":45000,\"keterangan\":\"test\",\"inserted_date\":\"2025-03-13 05:13:18\",\"updated_date\":\"2025-03-13 05:13:18\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-03-13 05:13:18','returpenjualan','simpanData'),(348,'[{\"idreturpenjualan\":\"250313RJ0000001\",\"idbarang\":\"K001000001\",\"jumlahretur\":\"3\",\"hargaretur\":\"15000\",\"subtotalretur\":\"45000\"}]','Budiman','2025-03-13 05:13:18','returpenjualandetail','simpanData'),(349,'{\"idreturpenjualan\":\"250313RJ0000002\",\"idpenjualan\":\"250307JL0000001\",\"tglretur\":\"2025-03-13\",\"totalretur\":30000,\"keterangan\":\"Test\",\"inserted_date\":\"2025-03-13 05:16:36\",\"updated_date\":\"2025-03-13 05:16:36\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-03-13 05:16:36','returpenjualan','simpanData'),(350,'[{\"idreturpenjualan\":\"250313RJ0000002\",\"idbarang\":\"K001000001\",\"jumlahretur\":\"2\",\"hargaretur\":\"15000\",\"subtotalretur\":\"30000\"}]','Budiman','2025-03-13 05:16:36','returpenjualandetail','simpanData'),(351,'{\"idreturpenjualan\":\"250313RJ0000001\",\"idpenjualan\":\"250307JL0000001\",\"tglretur\":\"2025-03-13\",\"totalretur\":\"45000\",\"keterangan\":\"test\",\"inserted_date\":\"2025-03-13 05:13:18\",\"updated_date\":\"2025-03-13 05:13:18\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-07\",\"noinvoice\":\"2503070001\",\"namakonsumen\":\"CV. Karya Utama\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-03-13 05:18:19','returpenjualan','hapusData'),(352,'[{\"idreturdetail\":1,\"idreturpenjualan\":\"250313RJ0000001\",\"idbarang\":\"K001000001\",\"jumlahretur\":3,\"hargaretur\":\"15000\",\"subtotalretur\":\"45000\"}]','Budiman','2025-03-13 05:18:19','returpenjualandetail','hapusData'),(353,'{\"idreturpenjualan\":\"250313RJ0000003\",\"idpenjualan\":\"250307JL0000001\",\"tglretur\":\"2025-03-13\",\"totalretur\":45000,\"keterangan\":null,\"inserted_date\":\"2025-03-13 05:18:34\",\"updated_date\":\"2025-03-13 05:18:34\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-03-13 05:18:34','returpenjualan','simpanData'),(354,'[{\"idreturpenjualan\":\"250313RJ0000003\",\"idbarang\":\"K001000001\",\"jumlahretur\":\"3\",\"hargaretur\":\"15000\",\"subtotalretur\":\"45000\"}]','Budiman','2025-03-13 05:18:34','returpenjualandetail','simpanData'),(355,'{\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"1234444555566666\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-03-13\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Pemuda\",\"alamattinggal\":\"Jl. Pelangi\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"08135553330000\",\"email\":\"khairuddin@gmail.com\",\"tglkontrak\":\"2025-03-13\",\"filekontrak\":null,\"inserted_date\":\"2025-03-13 06:40:22\",\"updated_date\":\"2025-03-13 06:40:22\",\"statusaktif\":\"Aktif\"}','Budiman','2025-03-13 06:40:22','sales','simpanData'),(356,'{\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"1234444555566666\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-03-13\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Pemuda\",\"alamattinggal\":\"Jl. Pelangi\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"08135553330000\",\"email\":\"khairuddin@gmail.com\",\"tglkontrak\":\"2025-03-13\",\"filekontrak\":null,\"updated_date\":\"2025-03-13 12:30:43\",\"statusaktif\":\"Aktif\"}','Budiman','2025-03-13 12:30:43','sales','updateData'),(357,'{\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"jeniskelamin\":\"Perempuan\",\"nik\":\"1111111111111111\",\"tempatlahir\":\"Jakarta\",\"tgllahir\":\"2000-12-02\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"081302500000000\",\"email\":\"siti@gmail.com\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"mbarang.xls\",\"updated_date\":\"2025-03-13 12:32:11\",\"statusaktif\":\"Aktif\"}','Budiman','2025-03-13 12:32:11','sales','updateData'),(358,'{\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"1234444555566666\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-03-13\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Pemuda\",\"alamattinggal\":\"Jl. Pelangi\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"08135553330000\",\"email\":\"khairuddin@gmail.com\",\"tglkontrak\":\"2025-03-13\",\"filekontrak\":null,\"updated_date\":\"2025-03-13 12:32:28\",\"statusaktif\":\"Aktif\"}','Budiman','2025-03-13 12:32:28','sales','updateData'),(359,'{\"idpenjualan\":\"250313JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503130001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"test\",\"totalsetelahdiskon\":96000,\"totalsebelumdiskon\":96000,\"inserted_date\":\"2025-03-13 13:05:43\",\"updated_date\":\"2025-03-13 13:05:43\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\"}','Budiman','2025-03-13 13:05:43','penjualan','simpanData'),(360,'[{\"idpenjualan\":\"250313JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"2\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"96000\"}]','Budiman','2025-03-13 13:05:43','penjualandetail','simpanData'),(361,'{\"idpenjualan\":\"250313JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503130001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"test\",\"totalsetelahdiskon\":96000,\"totalsebelumdiskon\":96000,\"updated_date\":\"2025-03-13 13:14:11\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\"}','Budiman','2025-03-13 13:14:11','penjualan','updateData'),(362,'[{\"idpenjualan\":\"250313JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"2\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"96000\"}]','Budiman','2025-03-13 13:14:11','penjualandetail','updateData'),(363,'{\"idpenjualan\":\"250313JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503130001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"test\",\"totalsetelahdiskon\":96000,\"totalsebelumdiskon\":96000,\"updated_date\":\"2025-03-13 13:14:22\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\"}','Budiman','2025-03-13 13:14:23','penjualan','updateData'),(364,'[{\"idpenjualan\":\"250313JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"2\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"96000\"}]','Budiman','2025-03-13 13:14:23','penjualandetail','updateData'),(365,'{\"idreturpenjualan\":\"250313RJ0000003\",\"idpenjualan\":\"250307JL0000001\",\"tglretur\":\"2025-03-13\",\"totalretur\":\"45000\",\"keterangan\":null,\"inserted_date\":\"2025-03-13 05:18:34\",\"updated_date\":\"2025-03-13 05:18:34\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-07\",\"noinvoice\":\"2503070001\",\"namakonsumen\":\"CV. Karya Utama\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-03-13 14:00:00','returpenjualan','hapusData'),(366,'[{\"idreturdetail\":3,\"idreturpenjualan\":\"250313RJ0000003\",\"idbarang\":\"K001000001\",\"jumlahretur\":3,\"hargaretur\":\"15000\",\"subtotalretur\":\"45000\"}]','Budiman','2025-03-13 14:00:00','returpenjualandetail','hapusData'),(367,'{\"idreturpenjualan\":\"250313RJ0000002\",\"idpenjualan\":\"250307JL0000001\",\"tglretur\":\"2025-03-13\",\"totalretur\":\"30000\",\"keterangan\":\"Test\",\"inserted_date\":\"2025-03-13 05:16:36\",\"updated_date\":\"2025-03-13 05:16:36\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-07\",\"noinvoice\":\"2503070001\",\"namakonsumen\":\"CV. Karya Utama\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-13 14:00:04','returpenjualan','hapusData'),(368,'[{\"idreturdetail\":2,\"idreturpenjualan\":\"250313RJ0000002\",\"idbarang\":\"K001000001\",\"jumlahretur\":2,\"hargaretur\":\"15000\",\"subtotalretur\":\"30000\"}]','Budiman','2025-03-13 14:00:04','returpenjualandetail','hapusData'),(369,'{\"idpenjualan\":\"250313JL0000001\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-03-13\",\"noinvoice\":\"2503130001\",\"keterangan\":\"test\",\"totalsetelahdiskon\":\"96000\",\"totalsebelumdiskon\":\"96000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-13 13:05:43\",\"updated_date\":\"2025-03-13 13:14:22\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"PT. Intrajaya\",\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\"}','Budiman','2025-03-13 14:01:59','penjualan','hapusData'),(370,'[{\"id\":22,\"idpenjualan\":\"250313JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":2,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"96000\"}]','Budiman','2025-03-13 14:01:59','penjualandetail','hapusData'),(371,'{\"idpenjualan\":\"250307JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-07\",\"noinvoice\":\"2503070001\",\"keterangan\":\"test\",\"totalsetelahdiskon\":\"348000\",\"totalsebelumdiskon\":\"348000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-07 06:16:37\",\"updated_date\":\"2025-03-07 06:16:37\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":\"Middle\",\"jatuhtempo\":30,\"namakonsumen\":\"CV. Karya Utama\",\"idsales\":null,\"namasales\":null}','Budiman','2025-03-13 14:02:29','penjualan','hapusData'),(372,'[{\"id\":18,\"idpenjualan\":\"250307JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":1,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"48000\"},{\"id\":19,\"idpenjualan\":\"250307JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":20,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"300000\"}]','Budiman','2025-03-13 14:02:29','penjualandetail','hapusData'),(373,'{\"idpenjualan\":\"250306JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-06\",\"noinvoice\":\"2503060001\",\"keterangan\":\"test\",\"totalsetelahdiskon\":\"78000\",\"totalsebelumdiskon\":\"78000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-06 05:42:53\",\"updated_date\":\"2025-03-06 05:42:53\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":\"Middle\",\"jatuhtempo\":30,\"namakonsumen\":\"CV. Karya Utama\",\"idsales\":null,\"namasales\":null}','Budiman','2025-03-13 14:03:03','penjualan','hapusData'),(374,'[{\"id\":16,\"idpenjualan\":\"250306JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":1,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"48000\"},{\"id\":17,\"idpenjualan\":\"250306JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":2,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"30000\"}]','Budiman','2025-03-13 14:03:03','penjualandetail','hapusData'),(375,'{\"idpenjualan\":\"250313JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503130001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Penjualan Transfer\",\"totalsetelahdiskon\":30000,\"totalsebelumdiskon\":30000,\"inserted_date\":\"2025-03-13 15:09:10\",\"updated_date\":\"2025-03-13 15:09:10\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250313JL0000001#01\"}','Budiman','2025-03-13 15:09:10','penjualan','simpanData'),(376,'[{\"idpenjualan\":\"250313JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"2\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"30000\"}]','Budiman','2025-03-13 15:09:10','penjualandetail','simpanData'),(377,'{\"idpenjualan\":\"250313JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503130001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Penjualan Transfer\",\"totalsetelahdiskon\":30000,\"totalsebelumdiskon\":30000,\"updated_date\":\"2025-03-13 15:13:34\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250313JL0000001#02\"}','Budiman','2025-03-13 15:13:35','penjualan','updateData'),(378,'[{\"idpenjualan\":\"250313JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"2\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"30000\"}]','Budiman','2025-03-13 15:13:35','penjualandetail','updateData'),(379,'{\"idpenjualan\":\"250313JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503130001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Penjualan Transfer 1\",\"totalsetelahdiskon\":30000,\"totalsebelumdiskon\":30000,\"updated_date\":\"2025-03-13 15:16:45\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250313JL0000001#03\"}','Budiman','2025-03-13 15:16:45','penjualan','updateData'),(380,'[{\"idpenjualan\":\"250313JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"2\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"30000\"}]','Budiman','2025-03-13 15:16:45','penjualandetail','updateData'),(381,'{\"idpenjualan\":\"250304JL0000003\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-04\",\"noinvoice\":\"2503040004\",\"keterangan\":\"test\",\"totalsetelahdiskon\":\"15000\",\"totalsebelumdiskon\":\"15000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-04 02:11:34\",\"updated_date\":\"2025-03-06 05:38:02\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idsales\":null,\"namasales\":null,\"nokwitansi\":null}','Budiman','2025-03-13 15:20:08','penjualan','hapusData'),(382,'[{\"id\":13,\"idpenjualan\":\"250304JL0000003\",\"idbarang\":\"K001000001\",\"jumlahjual\":1,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"15000\"}]','Budiman','2025-03-13 15:20:08','penjualandetail','hapusData'),(383,'{\"idpenjualan\":\"250304JL0000002\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-03-04\",\"noinvoice\":\"2503040002\",\"keterangan\":\"test\",\"totalsetelahdiskon\":\"48000\",\"totalsebelumdiskon\":\"48000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-04 02:11:04\",\"updated_date\":\"2025-03-04 02:11:04\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"PT. Intrajaya\",\"idsales\":null,\"namasales\":null,\"nokwitansi\":null}','Budiman','2025-03-13 15:20:20','penjualan','hapusData'),(384,'[{\"id\":10,\"idpenjualan\":\"250304JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":1,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"48000\"}]','Budiman','2025-03-13 15:20:20','penjualandetail','hapusData'),(385,'{\"idpenjualan\":\"250313JL0000001\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-03-13\",\"noinvoice\":\"2503130001\",\"keterangan\":\"Penjualan Transfer 1\",\"totalsetelahdiskon\":\"30000\",\"totalsebelumdiskon\":\"30000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-13 15:09:10\",\"updated_date\":\"2025-03-13 15:16:45\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"PT. Intrajaya\",\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"nokwitansi\":\"250313JL0000001#03\"}','Budiman','2025-03-13 15:20:40','penjualan','hapusData'),(386,'[{\"id\":27,\"idpenjualan\":\"250313JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":2,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"30000\"}]','Budiman','2025-03-13 15:20:40','penjualandetail','hapusData'),(387,'{\"idpenjualan\":\"250313JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503130001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Piutang middle\",\"totalsetelahdiskon\":960000,\"totalsebelumdiskon\":960000,\"inserted_date\":\"2025-03-13 15:21:21\",\"updated_date\":\"2025-03-13 15:21:21\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null}','Budiman','2025-03-13 15:21:21','penjualan','simpanData'),(388,'[{\"idpenjualan\":\"250313JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"20\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"960000\"}]','Budiman','2025-03-13 15:21:21','penjualandetail','simpanData'),(389,'{\"idpenjualan\":\"250313JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503130001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Piutang middle 1\",\"totalsetelahdiskon\":960000,\"totalsebelumdiskon\":960000,\"updated_date\":\"2025-03-13 15:21:59\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null}','Budiman','2025-03-13 15:21:59','penjualan','updateData'),(390,'[{\"idpenjualan\":\"250313JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"20\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"960000\"}]','Budiman','2025-03-13 15:21:59','penjualandetail','updateData'),(391,'{\"idpenjualan\":\"250313JL0000002\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503130002\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Bayar ke BCA\",\"totalsetelahdiskon\":1020000,\"totalsebelumdiskon\":1020000,\"inserted_date\":\"2025-03-13 15:22:44\",\"updated_date\":\"2025-03-13 15:22:44\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250313JL0000002#01\"}','Budiman','2025-03-13 15:22:45','penjualan','simpanData'),(392,'[{\"idpenjualan\":\"250313JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"15\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"720000\"},{\"idpenjualan\":\"250313JL0000002\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"20\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"300000\"}]','Budiman','2025-03-13 15:22:45','penjualandetail','simpanData'),(393,'{\"idpenjualan\":\"250313JL0000003\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503130003\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Test Tunai\",\"totalsetelahdiskon\":1440000,\"totalsebelumdiskon\":1440000,\"inserted_date\":\"2025-03-13 15:29:37\",\"updated_date\":\"2025-03-13 15:29:37\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250313JL0000003#01\"}','Budiman','2025-03-13 15:29:37','penjualan','simpanData'),(394,'[{\"idpenjualan\":\"250313JL0000003\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"30\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"1440000\"}]','Budiman','2025-03-13 15:29:37','penjualandetail','simpanData'),(395,'{\"idpiutangdetail\":\"250313PI0001002\",\"idpiutang\":\"250313PI0001\",\"tglpiutang\":\"2025-03-13\",\"debet\":0,\"kredit\":\"500000\",\"inserted_date\":\"2025-03-13 15:43:30\",\"updated_date\":\"2025-03-13 15:43:30\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250313JL0000001#01\"}','Budiman','2025-03-13 15:43:30','piutangdetail','simpanData'),(396,'{\"idpiutangdetail\":\"250313PI0001003\",\"idpiutang\":\"250313PI0001\",\"tglpiutang\":\"2025-03-13\",\"debet\":0,\"kredit\":\"460000\",\"inserted_date\":\"2025-03-13 15:45:31\",\"updated_date\":\"2025-03-13 15:45:31\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250313JL0000001#02\"}','Budiman','2025-03-13 15:45:31','piutangdetail','simpanData'),(397,'{\"idpiutangdetail\":\"250313PI0001003\",\"idpiutang\":\"250313PI0001\",\"tglpiutang\":\"2025-03-13\",\"debet\":\"0\",\"kredit\":\"460000\",\"inserted_date\":\"2025-03-13 15:45:31\",\"updated_date\":\"2025-03-13 15:45:31\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250313JL0000001\",\"idjenispiutang\":\"P02\",\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Central Asia\",\"nokwitansi\":\"250313JL0000001#02\"}','Budiman','2025-03-13 16:13:59','piutangdetail','hapusData'),(398,'{\"idpiutangdetail\":\"250313PI0001003\",\"idpiutang\":\"250313PI0001\",\"tglpiutang\":\"2025-03-13\",\"debet\":0,\"kredit\":\"460000\",\"inserted_date\":\"2025-03-13 16:14:39\",\"updated_date\":\"2025-03-13 16:14:39\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250313JL0000001#02\"}','Budiman','2025-03-13 16:14:39','piutangdetail','simpanData'),(399,'{\"idpenjualan\":\"250313JL0000004\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503130004\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Test\",\"totalsetelahdiskon\":450000,\"totalsebelumdiskon\":450000,\"inserted_date\":\"2025-03-13 16:40:23\",\"updated_date\":\"2025-03-13 16:40:23\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null}','Budiman','2025-03-13 16:40:23','penjualan','simpanData'),(400,'[{\"idpenjualan\":\"250313JL0000004\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"30\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"450000\"}]','Budiman','2025-03-13 16:40:23','penjualandetail','simpanData'),(401,'{\"prefix\":\"ppn_persen\",\"values\":\"10\",\"inserted_date\":\"2025-03-13 17:50:57\",\"updated_date\":\"2025-03-13 17:50:57\",\"deskripsi\":\"Jumlah PPN dalam Persentase\"}','Budiman','2025-03-13 17:50:57','settings','simpanData'),(402,'{\"prefix\":\"ppn_persen\",\"values\":\"10\",\"deskripsi\":\"Jumlah PPN dalam Persentase\",\"inserted_date\":\"2025-03-13 17:50:57\",\"updated_date\":\"2025-03-13 17:50:57\"}','Budiman','2025-03-13 17:51:31','settings','hapusData'),(403,'{\"prefix\":\"ppn_penjualan\",\"values\":\"10\",\"inserted_date\":\"2025-03-13 17:52:00\",\"updated_date\":\"2025-03-13 17:52:00\",\"deskripsi\":\"PPN penjulaan dalam pesertase\"}','Budiman','2025-03-13 17:52:00','settings','simpanData'),(404,'{\"prefix\":\"ppn_penjualan\",\"values\":\"11\",\"updated_date\":\"2025-03-13 17:52:11\",\"deskripsi\":\"PPN penjulaan dalam pesertase\"}','Budiman','2025-03-13 17:52:11','settings','updateData'),(405,'{\"lastlogin\":\"2025-03-13 17:53:59\"}','Budiman','2025-03-13 17:53:59','pengguna','updateData'),(406,'{\"idpiutangdetail\":\"250313PI0001003\",\"idpiutang\":\"250313PI0001\",\"tglpiutang\":\"2025-03-13\",\"debet\":\"0\",\"kredit\":\"460000\",\"inserted_date\":\"2025-03-13 16:14:39\",\"updated_date\":\"2025-03-13 16:14:39\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250313JL0000001\",\"idjenispiutang\":\"P02\",\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Central Asia\",\"nokwitansi\":\"250313JL0000001#02\"}','Budiman','2025-03-13 18:00:51','piutangdetail','hapusData'),(407,'{\"idpiutangdetail\":\"250313PI0001002\",\"idpiutang\":\"250313PI0001\",\"tglpiutang\":\"2025-03-13\",\"debet\":\"0\",\"kredit\":\"500000\",\"inserted_date\":\"2025-03-13 15:43:30\",\"updated_date\":\"2025-03-13 15:43:30\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250313JL0000001\",\"idjenispiutang\":\"P02\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"nokwitansi\":\"250313JL0000001#01\"}','Budiman','2025-03-13 18:00:55','piutangdetail','hapusData'),(408,'{\"idpenjualan\":\"250313JL0000004\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-03-13\",\"noinvoice\":\"2503130004\",\"keterangan\":\"Test\",\"totalsetelahdiskon\":\"450000\",\"totalsebelumdiskon\":\"450000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-13 16:40:23\",\"updated_date\":\"2025-03-13 16:40:23\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":\"Fast\",\"jatuhtempo\":7,\"namakonsumen\":\"PT. Intrajaya\",\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"nokwitansi\":null}','Budiman','2025-03-13 18:01:07','penjualan','hapusData'),(409,'[{\"id\":33,\"idpenjualan\":\"250313JL0000004\",\"idbarang\":\"K001000001\",\"jumlahjual\":30,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"450000\",\"ppnpersen\":0}]','Budiman','2025-03-13 18:01:07','penjualandetail','hapusData'),(410,'{\"idpenjualan\":\"250313JL0000003\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-13\",\"noinvoice\":\"2503130003\",\"keterangan\":\"Test Tunai\",\"totalsetelahdiskon\":\"1440000\",\"totalsebelumdiskon\":\"1440000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-13 15:29:37\",\"updated_date\":\"2025-03-13 15:29:37\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"nokwitansi\":\"250313JL0000003#01\"}','Budiman','2025-03-13 18:01:11','penjualan','hapusData'),(411,'[{\"id\":32,\"idpenjualan\":\"250313JL0000003\",\"idbarang\":\"K001000002\",\"jumlahjual\":30,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"1440000\",\"ppnpersen\":0}]','Budiman','2025-03-13 18:01:11','penjualandetail','hapusData'),(412,'{\"idpenjualan\":\"250313JL0000002\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-13\",\"noinvoice\":\"2503130002\",\"keterangan\":\"Bayar ke BCA\",\"totalsetelahdiskon\":\"1020000\",\"totalsebelumdiskon\":\"1020000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-13 15:22:44\",\"updated_date\":\"2025-03-13 15:22:44\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"nokwitansi\":\"250313JL0000002#01\"}','Budiman','2025-03-13 18:01:17','penjualan','hapusData'),(413,'[{\"id\":30,\"idpenjualan\":\"250313JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":15,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"720000\",\"ppnpersen\":0},{\"id\":31,\"idpenjualan\":\"250313JL0000002\",\"idbarang\":\"K001000001\",\"jumlahjual\":20,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"300000\",\"ppnpersen\":0}]','Budiman','2025-03-13 18:01:17','penjualandetail','hapusData'),(414,'{\"idpenjualan\":\"250313JL0000001\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-03-13\",\"noinvoice\":\"2503130001\",\"keterangan\":\"Piutang middle 1\",\"totalsetelahdiskon\":\"960000\",\"totalsebelumdiskon\":\"960000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-13 15:21:21\",\"updated_date\":\"2025-03-13 15:21:59\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":\"Middle\",\"jatuhtempo\":30,\"namakonsumen\":\"PT. Intrajaya\",\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"nokwitansi\":null}','Budiman','2025-03-13 18:01:21','penjualan','hapusData'),(415,'[{\"id\":29,\"idpenjualan\":\"250313JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":20,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"960000\",\"ppnpersen\":0}]','Budiman','2025-03-13 18:01:21','penjualandetail','hapusData'),(416,'{\"idpenjualan\":\"250314JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503140001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"test\",\"totalsetelahdiskon\":300000,\"totalsebelumdiskon\":300000,\"inserted_date\":\"2025-03-13 18:03:36\",\"updated_date\":\"2025-03-13 18:03:36\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250314JL0000001#01\"}','Budiman','2025-03-13 18:03:36','penjualan','simpanData'),(417,'[{\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"20\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"300000\",\"ppnpersen\":\"11\"}]','Budiman','2025-03-13 18:03:36','penjualandetail','simpanData'),(418,'{\"idpenjualan\":\"250314JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-13\",\"noinvoice\":\"2503140001\",\"keterangan\":\"test\",\"totalsetelahdiskon\":\"300000\",\"totalsebelumdiskon\":\"300000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-13 18:03:36\",\"updated_date\":\"2025-03-13 18:03:36\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"nokwitansi\":\"250314JL0000001#01\",\"ppnpersen\":0}','Budiman','2025-03-13 18:08:59','penjualan','hapusData'),(419,'[{\"id\":34,\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":20,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"300000\"}]','Budiman','2025-03-13 18:08:59','penjualandetail','hapusData'),(420,'{\"idpenjualan\":\"250314JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503140001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Coba\",\"totalsetelahdiskon\":300000,\"totalsebelumdiskon\":300000,\"inserted_date\":\"2025-03-13 18:09:19\",\"updated_date\":\"2025-03-13 18:09:19\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250314JL0000001#01\",\"ppnpersen\":\"11\"}','Budiman','2025-03-13 18:09:19','penjualan','simpanData'),(421,'[{\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"20\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"300000\"}]','Budiman','2025-03-13 18:09:19','penjualandetail','simpanData'),(422,'{\"idpenjualan\":\"250314JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503140001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Coba\",\"totalsetelahdiskon\":300000,\"totalsebelumdiskon\":300000,\"updated_date\":\"2025-03-13 18:42:23\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250314JL0000001#02\",\"ppnpersen\":\"11\"}','Budiman','2025-03-13 18:42:23','penjualan','updateData'),(423,'[{\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"20\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"300000\"}]','Budiman','2025-03-13 18:42:23','penjualandetail','updateData'),(424,'{\"idpenjualan\":\"250314JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503140001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Coba\",\"totalsetelahdiskon\":1020000,\"totalsebelumdiskon\":1020000,\"updated_date\":\"2025-03-13 18:42:47\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250314JL0000001#03\",\"ppnpersen\":\"11\"}','Budiman','2025-03-13 18:42:47','penjualan','updateData'),(425,'[{\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"20\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"300000\"},{\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"15\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"720000\"}]','Budiman','2025-03-13 18:42:47','penjualandetail','updateData'),(426,'{\"idpenjualan\":\"250314JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503140001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Coba\",\"totalsetelahdiskon\":720000,\"totalsebelumdiskon\":720000,\"updated_date\":\"2025-03-13 18:46:19\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250314JL0000001#04\",\"ppnpersen\":\"11\"}','Budiman','2025-03-13 18:46:19','penjualan','updateData'),(427,'[{\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"15\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"720000\"}]','Budiman','2025-03-13 18:46:19','penjualandetail','updateData'),(428,'{\"idpenjualan\":\"250314JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503140001\",\"tglinvoice\":\"2025-03-13\",\"keterangan\":\"Coba\",\"totalsetelahdiskon\":885000,\"totalsebelumdiskon\":885000,\"updated_date\":\"2025-03-13 18:46:41\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250314JL0000001#05\",\"ppnpersen\":\"11\"}','Budiman','2025-03-13 18:46:41','penjualan','updateData'),(429,'[{\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"15\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"720000\"},{\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"11\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"165000\"}]','Budiman','2025-03-13 18:46:41','penjualandetail','updateData'),(430,'{\"lastlogin\":\"2025-03-14 01:24:19\"}','Budiman','2025-03-14 01:24:19','pengguna','updateData'),(431,'{\"idpenjualan\":\"250314JL0000001\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-03-13\",\"noinvoice\":\"2503140001\",\"keterangan\":\"Coba\",\"totalsetelahdiskon\":\"885000\",\"totalsebelumdiskon\":\"885000\",\"totalsetelahdiskonplusppn\":982350,\"totalsebelumdiskonplusppn\":982350,\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-13 18:09:19\",\"updated_date\":\"2025-03-13 18:46:41\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"PT. Intrajaya\",\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"nokwitansi\":\"250314JL0000001#05\",\"ppnpersen\":11}','Budiman','2025-03-14 01:46:36','penjualan','hapusData'),(432,'[{\"id\":40,\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":15,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"720000\"},{\"id\":41,\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":11,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"165000\"}]','Budiman','2025-03-14 01:46:36','penjualandetail','hapusData'),(433,'{\"idpenjualan\":\"250314JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2503140001\",\"tglinvoice\":\"2025-03-14\",\"keterangan\":\"Test\",\"totalsetelahdiskon\":1110000,\"totalsebelumdiskon\":1110000,\"inserted_date\":\"2025-03-14 01:47:42\",\"updated_date\":\"2025-03-14 01:47:42\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250314JL0000001#01\",\"ppnpersen\":\"11\"}','Budiman','2025-03-14 01:47:42','penjualan','simpanData'),(434,'[{\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"10\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"150000\"},{\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"20\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"960000\"}]','Budiman','2025-03-14 01:47:42','penjualandetail','simpanData'),(435,'{\"lastlogin\":\"2025-03-14 04:13:20\"}','Budiman','2025-03-14 04:13:20','pengguna','updateData'),(436,'{\"idpenjualan\":\"250314JL0000002\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503140002\",\"tglinvoice\":\"2025-03-14\",\"keterangan\":\"Test Piutang\",\"totalsetelahdiskon\":1440000,\"totalsebelumdiskon\":1440000,\"inserted_date\":\"2025-03-14 04:20:45\",\"updated_date\":\"2025-03-14 04:20:45\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSKES0001\",\"nokwitansi\":null,\"ppnpersen\":\"11\"}','Budiman','2025-03-14 04:20:45','penjualan','simpanData'),(437,'[{\"idpenjualan\":\"250314JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"30\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"1440000\"}]','Budiman','2025-03-14 04:20:45','penjualandetail','simpanData'),(438,'{\"idpiutangdetail\":\"250314PI0001002\",\"idpiutang\":\"250314PI0001\",\"tglpiutang\":\"2025-03-14\",\"debet\":0,\"kredit\":\"500000\",\"inserted_date\":\"2025-03-14 04:24:24\",\"updated_date\":\"2025-03-14 04:24:24\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250314JL0000002#01\"}','Budiman','2025-03-14 04:24:24','piutangdetail','simpanData'),(439,'{\"idpiutangdetail\":\"250314PI0001003\",\"idpiutang\":\"250314PI0001\",\"tglpiutang\":\"2025-03-14\",\"debet\":0,\"kredit\":\"1098400\",\"inserted_date\":\"2025-03-14 04:25:17\",\"updated_date\":\"2025-03-14 04:25:17\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250314JL0000002#02\"}','Budiman','2025-03-14 04:25:17','piutangdetail','simpanData'),(440,'{\"idreturpenjualan\":\"250314RJ0000001\",\"idpenjualan\":\"250314JL0000001\",\"tglretur\":\"2025-03-14\",\"totalretur\":48000,\"keterangan\":\"test\",\"inserted_date\":\"2025-03-14 06:02:28\",\"updated_date\":\"2025-03-14 06:02:28\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-03-14 06:02:28','returpenjualan','simpanData'),(441,'[{\"idreturpenjualan\":\"250314RJ0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"1\",\"hargaretur\":\"48000\",\"subtotalretur\":\"48000\"}]','Budiman','2025-03-14 06:02:28','returpenjualandetail','simpanData'),(442,'{\"idreturpenjualan\":\"250314RJ0000001\",\"idpenjualan\":\"250314JL0000001\",\"tglretur\":\"2025-03-14\",\"totalretur\":\"48000\",\"keterangan\":\"test\",\"inserted_date\":\"2025-03-14 06:02:28\",\"updated_date\":\"2025-03-14 06:02:28\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-03-14\",\"noinvoice\":\"2503140001\",\"namakonsumen\":\"PT. Intrajaya\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-03-14 06:04:08','returpenjualan','hapusData'),(443,'[{\"idreturdetail\":4,\"idreturpenjualan\":\"250314RJ0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":1,\"hargaretur\":\"48000\",\"subtotalretur\":\"48000\"}]','Budiman','2025-03-14 06:04:08','returpenjualandetail','hapusData'),(444,'{\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"00000000000000000000\",\"emailpengguna\":\"budi@gmail.com\",\"fotopengguna\":\"karsten_winegeart_1grm2kdwykc_unsplash.jpg\",\"username\":\"budi\",\"idotorisasi\":\"KL001\",\"updated_date\":\"2025-03-14 06:11:58\",\"statusaktif\":\"Aktif\"}','Budiman','2025-03-14 06:11:58','pengguna','updateData'),(445,'{\"lastlogin\":\"2025-03-14 14:33:59\"}','Budiman','2025-03-14 14:33:59','pengguna','updateData'),(446,'{\"prefix\":\"usaha_logo\",\"values\":\"logo.jpg\",\"updated_date\":\"2025-03-14 16:13:48\",\"deskripsi\":\"Logo usaha\"}','Budiman','2025-03-14 16:13:48','settings','updateData'),(447,'{\"lastlogin\":\"2025-03-14 16:13:56\"}','Budiman','2025-03-14 16:13:56','pengguna','updateData'),(448,'{\"lastlogin\":\"2025-03-15 04:37:43\"}','Budiman','2025-03-15 04:37:43','pengguna','updateData'),(449,'{\"idpembelian\":\"250315BL0000001\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"12345\",\"tglfaktur\":\"2025-03-15\",\"tglditerima\":\"2025-03-15\",\"keterangan\":\"Test\",\"totalsetelahdiskon\":1630000,\"totalsebelumdiskon\":1630000,\"inserted_date\":\"2025-03-15 04:54:12\",\"updated_date\":\"2025-03-15 04:54:12\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-03-15 04:54:12','pembelian','simpanData'),(450,'[{\"idpembelian\":\"250315BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"30\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"1350000\"},{\"idpembelian\":\"250315BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"20\",\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"280000\"}]','Budiman','2025-03-15 04:54:12','pembeliandetail','simpanData'),(451,'{\"lastlogin\":\"2025-03-15 10:03:01\"}','Budiman','2025-03-15 10:03:01','pengguna','updateData'),(452,'{\"idpembelian\":\"250315BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"22488399\\/DE\\/2025\",\"tglfaktur\":\"2025-03-15\",\"tglditerima\":\"2025-03-15\",\"keterangan\":\"Pembelian Kayu dan Papan\",\"totalsetelahdiskon\":1700000,\"totalsebelumdiskon\":1700000,\"inserted_date\":\"2025-03-15 12:50:46\",\"updated_date\":\"2025-03-15 12:50:46\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-03-15 12:50:46','pembelian','simpanData'),(453,'[{\"idpembelian\":\"250315BL0000002\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"30\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"1350000\"},{\"idpembelian\":\"250315BL0000002\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"25\",\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"350000\"}]','Budiman','2025-03-15 12:50:46','pembeliandetail','simpanData'),(454,'{\"idhutangdetail\":\"250307HU0001003\",\"idhutang\":\"250307HU0001\",\"tglhutang\":\"2025-03-07\",\"debet\":\"0\",\"kredit\":\"740000\",\"inserted_date\":\"2025-03-07 02:55:25\",\"updated_date\":\"2025-03-07 02:55:25\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250307BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-15 12:56:33','hutangdetail','hapusData'),(455,'{\"idpembelian\":\"250315BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"22488399\\/DE\\/2025\",\"tglfaktur\":\"2025-03-15\",\"tglditerima\":\"2025-03-15\",\"keterangan\":\"Pembelian Kayu dan Papan\",\"totalsetelahdiskon\":\"1700000\",\"totalsebelumdiskon\":\"1700000\",\"inserted_date\":\"2025-03-15 12:50:46\",\"updated_date\":\"2025-03-15 12:50:46\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null}','Budiman','2025-03-15 12:57:05','pembelian','hapusData'),(456,'[{\"id\":38,\"idpembelian\":\"250315BL0000002\",\"idbarang\":\"K001000002\",\"jumlahbeli\":30,\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"1350000\"},{\"id\":39,\"idpembelian\":\"250315BL0000002\",\"idbarang\":\"K001000001\",\"jumlahbeli\":25,\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"350000\"}]','Budiman','2025-03-15 12:57:05','pembeliandetail','hapusData'),(457,'{\"idpembelian\":\"250315BL0000001\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"12345\",\"tglfaktur\":\"2025-03-15\",\"tglditerima\":\"2025-03-15\",\"keterangan\":\"Test\",\"totalsetelahdiskon\":\"1630000\",\"totalsebelumdiskon\":\"1630000\",\"inserted_date\":\"2025-03-15 04:54:12\",\"updated_date\":\"2025-03-15 04:54:12\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"PT. Intra Makmur\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null}','Budiman','2025-03-15 12:57:09','pembelian','hapusData'),(458,'[{\"id\":36,\"idpembelian\":\"250315BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":30,\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"1350000\"},{\"id\":37,\"idpembelian\":\"250315BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":20,\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"280000\"}]','Budiman','2025-03-15 12:57:09','pembeliandetail','hapusData'),(459,'{\"idreturpembelian\":\"250313RB0000002\",\"idpembelian\":\"250306BL0000002\",\"tglretur\":\"2025-03-13\",\"totalretur\":\"765000\",\"keterangan\":\"test\",\"inserted_date\":\"2025-03-13 04:13:28\",\"updated_date\":\"2025-03-13 04:13:28\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPIMN0001\",\"namasupplier\":\"PT. Intra Makmur\",\"tglfaktur\":\"2025-03-06\"}','Budiman','2025-03-15 12:57:31','returpembelian','hapusData'),(460,'[{\"idreturdetail\":3,\"idreturpembelian\":\"250313RB0000002\",\"idbarang\":\"K001000002\",\"jumlahretur\":17,\"hargaretur\":\"45000\",\"subtotalretur\":\"765000\"}]','Budiman','2025-03-15 12:57:31','returpembeliandetail','hapusData'),(461,'{\"idreturpembelian\":\"250313RB0000003\",\"idpembelian\":\"250307BL0000001\",\"tglretur\":\"2025-03-13\",\"totalretur\":\"14000\",\"keterangan\":\"test\",\"inserted_date\":\"2025-03-13 04:13:53\",\"updated_date\":\"2025-03-13 04:13:53\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"tglfaktur\":\"2025-03-07\"}','Budiman','2025-03-15 12:57:38','returpembelian','hapusData'),(462,'[{\"idreturdetail\":4,\"idreturpembelian\":\"250313RB0000003\",\"idbarang\":\"K001000001\",\"jumlahretur\":1,\"hargaretur\":\"14000\",\"subtotalretur\":\"14000\"}]','Budiman','2025-03-15 12:57:38','returpembeliandetail','hapusData'),(463,'{\"idpembelian\":\"250307BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"1111\",\"tglfaktur\":\"2025-03-07\",\"tglditerima\":\"2025-03-07\",\"keterangan\":\"abc\",\"totalsetelahdiskon\":\"1040000\",\"totalsebelumdiskon\":\"1040000\",\"inserted_date\":\"2025-03-07 02:48:02\",\"updated_date\":\"2025-03-07 02:48:02\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null}','Budiman','2025-03-15 12:57:51','pembelian','hapusData'),(464,'[{\"id\":34,\"idpembelian\":\"250307BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":10,\"hargasebelumdiskon\":\"14000\",\"hargasetelahdiskon\":\"14000\",\"subtotalbeli\":\"140000\"},{\"id\":35,\"idpembelian\":\"250307BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":20,\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"900000\"}]','Budiman','2025-03-15 12:57:51','pembeliandetail','hapusData'),(465,'{\"idpembelian\":\"250315BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"728199\\/FA\\/2025\",\"tglfaktur\":\"2025-03-15\",\"tglditerima\":\"2025-03-15\",\"keterangan\":\"Pembelian Kayu\",\"totalsetelahdiskon\":1350000,\"totalsebelumdiskon\":1350000,\"inserted_date\":\"2025-03-15 13:01:29\",\"updated_date\":\"2025-03-15 13:01:29\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-03-15 13:01:30','pembelian','simpanData'),(466,'[{\"idpembelian\":\"250315BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"30\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"1350000\"}]','Budiman','2025-03-15 13:01:30','pembeliandetail','simpanData'),(467,'{\"idhutangdetail\":\"250315HU0001002\",\"idhutang\":\"250315HU0001\",\"tglhutang\":\"2025-03-15\",\"debet\":\"500000\",\"kredit\":0,\"inserted_date\":\"2025-03-15 13:13:24\",\"updated_date\":\"2025-03-15 13:13:24\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-03-15 13:13:24','hutangdetail','simpanData'),(468,'{\"lastlogin\":\"2025-03-15 15:22:14\"}','Budiman','2025-03-15 15:22:14','pengguna','updateData'),(469,'{\"lastlogin\":\"2025-03-15 18:04:13\"}','Budiman','2025-03-15 18:04:13','pengguna','updateData'),(470,'{\"idreturpembelian\":\"250316RB0000001\",\"idpembelian\":\"250315BL0000001\",\"tglretur\":\"2025-03-15\",\"totalretur\":675000,\"keterangan\":\"Ada 15 kayu nya sudah bolong bolong\",\"inserted_date\":\"2025-03-15 18:11:35\",\"updated_date\":\"2025-03-15 18:11:35\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\"}','Budiman','2025-03-15 18:11:35','returpembelian','simpanData'),(471,'[{\"idreturpembelian\":\"250316RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"15\",\"hargaretur\":\"45000\",\"subtotalretur\":\"675000\"}]','Budiman','2025-03-15 18:11:35','returpembeliandetail','simpanData'),(472,'{\"idpenjualan\":\"250316JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503160001\",\"tglinvoice\":\"2025-03-15\",\"keterangan\":\"TEST2\",\"totalsetelahdiskon\":1200000,\"totalsebelumdiskon\":1200000,\"inserted_date\":\"2025-03-15 18:43:16\",\"updated_date\":\"2025-03-15 18:43:16\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null,\"ppnpersen\":\"11\"}','Budiman','2025-03-15 18:43:16','penjualan','simpanData'),(473,'[{\"idpenjualan\":\"250316JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"80\",\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"1200000\"}]','Budiman','2025-03-15 18:43:16','penjualandetail','simpanData'),(474,'{\"idreturpenjualan\":\"250316RJ0000001\",\"idpenjualan\":\"250314JL0000001\",\"tglretur\":\"2025-03-15\",\"totalretur\":30000,\"keterangan\":\"Kayu nya retak\",\"inserted_date\":\"2025-03-15 18:55:33\",\"updated_date\":\"2025-03-15 18:55:33\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-03-15 18:55:33','returpenjualan','simpanData'),(475,'[{\"idreturpenjualan\":\"250316RJ0000001\",\"idbarang\":\"K001000001\",\"jumlahretur\":\"2\",\"hargaretur\":\"15000\",\"subtotalretur\":\"30000\"}]','Budiman','2025-03-15 18:55:33','returpenjualandetail','simpanData'),(476,'{\"lastlogin\":\"2025-03-16 04:11:05\"}','Budiman','2025-03-16 04:11:05','pengguna','updateData'),(477,'{\"idpengeluaran\":\"250316PL0000001\",\"tglpengeluaran\":\"2025-03-16\",\"nokwitansi\":\"123\\/TS\\/2025\",\"totalpengeluaran\":60500000,\"keterangan\":\"Pembayaran Gaji Pegawai Bulan Maret 2025\",\"inserted_date\":\"2025-03-16 04:28:55\",\"updated_date\":\"2025-03-16 04:28:55\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-03-16 04:28:56','pengeluaran','simpanData'),(478,'[{\"idpengeluaran\":\"250316PL0000001\",\"kdakun\":\"5.1.01.01\",\"jumlahpengeluaran\":\"60500000\"}]','Budiman','2025-03-16 04:28:56','pengeluarandetail','simpanData'),(479,'{\"idpenjualan\":\"250316JL0000002\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503160002\",\"tglinvoice\":\"2025-03-16\",\"keterangan\":\"test\",\"totalsetelahdiskon\":96000,\"totalsebelumdiskon\":96000,\"inserted_date\":\"2025-03-16 05:12:59\",\"updated_date\":\"2025-03-16 05:12:59\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250316JL0000002#01\",\"ppnpersen\":\"11\"}','Budiman','2025-03-16 05:12:59','penjualan','simpanData'),(480,'[{\"idpenjualan\":\"250316JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"2\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"96000\"}]','Budiman','2025-03-16 05:12:59','penjualandetail','simpanData'),(481,'{\"idpembelian\":\"250316BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"010022\\/FK\\/2025\",\"tglfaktur\":\"2025-03-16\",\"tglditerima\":\"2025-03-16\",\"keterangan\":\"Pembeliah Bahan\",\"totalsetelahdiskon\":900000,\"totalsebelumdiskon\":900000,\"inserted_date\":\"2025-03-16 05:13:55\",\"updated_date\":\"2025-03-16 05:13:55\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-03-16 05:13:55','pembelian','simpanData'),(482,'[{\"idpembelian\":\"250316BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"20\",\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"subtotalbeli\":\"900000\"}]','Budiman','2025-03-16 05:13:55','pembeliandetail','simpanData'),(483,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-16 07:34:06\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-16 07:34:06','postingjurnal','simpanData'),(484,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-16 07:34:06\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-16 08:02:56','sales','hapusData'),(485,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-16 08:03:02\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-16 08:03:02','postingjurnal','simpanData'),(486,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-16 08:03:37\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-16 08:03:37','postingjurnal','simpanData'),(487,'{\"idposting\":\"022025\",\"bulan\":\"02\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-16 08:03:46\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-16 08:03:46','postingjurnal','simpanData'),(488,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-16 08:03:37\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-16 08:04:00','sales','hapusData'),(489,'{\"idposting\":\"022025\",\"bulan\":\"02\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-16 08:03:46\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-16 08:04:04','sales','hapusData'),(490,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-16 08:03:02\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-16 08:04:08','sales','hapusData'),(491,'{\"lastlogin\":\"2025-03-16 16:36:23\"}','Budiman','2025-03-16 16:36:23','pengguna','updateData'),(492,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-16 16:36:36\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-16 16:36:36','postingjurnal','simpanData'),(493,'{\"idposting\":\"022025\",\"bulan\":\"02\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-16 16:40:57\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-16 16:40:57','postingjurnal','simpanData'),(494,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-16 16:36:36\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-16 16:41:03','sales','hapusData'),(495,'{\"idposting\":\"022025\",\"bulan\":\"02\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-16 16:40:57\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-16 16:41:08','sales','hapusData'),(496,'{\"lastlogin\":\"2025-03-16 17:30:26\"}','Budiman','2025-03-16 17:30:26','pengguna','updateData'),(497,'{\"prefix\":\"akun_kas_tunai\",\"values\":\"1.1.01.01\",\"inserted_date\":\"2025-03-16 17:31:05\",\"updated_date\":\"2025-03-16 17:31:05\",\"deskripsi\":\"Akun Rekening Kas Tunai\"}','Budiman','2025-03-16 17:31:05','settings','simpanData'),(498,'{\"kdakun\":\"1.1.01.01\",\"namaakun\":\"Kas Tunai\",\"updated_date\":\"2025-03-16 17:31:58\"}','Budiman','2025-03-16 17:31:58','akun','updateData'),(499,'{\"kdakun\":\"1.1.01.03\",\"namaakun\":\"Rekening BCA\",\"kdparent\":\"1.1.01\",\"inserted_date\":\"2025-03-16 17:32:13\",\"updated_date\":\"2025-03-16 17:32:13\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-16 17:32:13','akun','simpanData'),(500,'{\"kdakun\":\"1.1.01.02\",\"namaakun\":\"Rekening Bank Niaga\",\"updated_date\":\"2025-03-16 17:33:04\"}','Budiman','2025-03-16 17:33:04','akun','updateData'),(501,'{\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"kdakun\":\"1.1.01.03\",\"updated_date\":\"2025-03-16 17:33:27\",\"statusaktif\":\"Aktif\"}','Budiman','2025-03-16 17:33:27','bank','updateData'),(502,'{\"lastlogin\":\"2025-03-16 17:34:03\"}','Budiman','2025-03-16 17:34:03','pengguna','updateData'),(503,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-16 17:40:13\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-16 17:40:13','postingjurnal','simpanData'),(505,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-16 17:44:12\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-16 17:44:12','postingjurnal','simpanData'),(506,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-16 17:44:12\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-16 17:45:47','sales','hapusData'),(507,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-16 17:45:56\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-16 17:45:56','postingjurnal','simpanData'),(508,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-16 17:45:56\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-16 17:46:25','sales','hapusData'),(509,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-16 17:40:13\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-16 17:46:30','sales','hapusData'),(510,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-16 17:49:24\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-16 17:49:24','postingjurnal','simpanData'),(511,'{\"kdakun\":\"1.1.03.01\",\"namaakun\":\"Piutang Usaha\",\"kdparent\":\"1.1.03\",\"inserted_date\":\"2025-03-16 18:13:37\",\"updated_date\":\"2025-03-16 18:13:37\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-16 18:13:37','akun','simpanData'),(512,'{\"kdakun\":\"1.1.03\",\"namaakun\":\"Piutang\",\"updated_date\":\"2025-03-16 18:13:52\"}','Budiman','2025-03-16 18:13:52','akun','updateData'),(513,'{\"prefix\":\"akun_piutang_usaha\",\"values\":\"1.1.03.01\",\"inserted_date\":\"2025-03-16 18:14:22\",\"updated_date\":\"2025-03-16 18:14:22\",\"deskripsi\":\"Rekening akun piutang usaha\"}','Budiman','2025-03-16 18:14:22','settings','simpanData'),(514,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-16 17:49:24\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-16 18:19:33','sales','hapusData'),(516,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-16 18:20:34\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-16 18:20:34','postingjurnal','simpanData'),(517,'{\"lastlogin\":\"2025-03-17 01:39:45\"}','Budiman','2025-03-17 01:39:45','pengguna','updateData'),(518,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-16 18:20:34\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 01:50:58','sales','hapusData'),(520,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 01:54:36\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 01:54:36','postingjurnal','simpanData'),(521,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 01:54:36\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 01:59:32','sales','hapusData'),(522,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 01:59:37\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 01:59:37','postingjurnal','simpanData'),(523,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 01:59:37\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 02:25:04','sales','hapusData'),(525,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 02:26:47\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 02:26:47','postingjurnal','simpanData'),(526,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 02:26:47\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 02:38:12','sales','hapusData'),(527,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 02:38:16\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 02:38:16','postingjurnal','simpanData'),(528,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 02:38:16\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 02:41:05','sales','hapusData'),(529,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 02:41:09\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 02:41:09','postingjurnal','simpanData'),(530,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 02:41:09\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 03:22:10','sales','hapusData'),(533,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 03:23:43\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 03:23:43','postingjurnal','simpanData'),(534,'{\"kdakun\":\"2.11\",\"namaakun\":\"Utang\",\"kdparent\":\"2.1\",\"inserted_date\":\"2025-03-17 05:17:00\",\"updated_date\":\"2025-03-17 05:17:00\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-03-17 05:17:00','akun','simpanData'),(535,'{\"kdakun\":\"2.11\",\"namaakun\":\"Utang\",\"kdparent\":\"2.1\",\"levels\":3,\"statusaktif\":\"Aktif\",\"inserted_date\":\"2025-03-17 05:17:00\",\"updated_date\":\"2025-03-17 05:17:00\",\"namaparent\":\"Liabilitas Jangka Panjang\"}','Budiman','2025-03-17 05:17:08','akun','hapusData'),(536,'{\"kdakun\":\"2.1.01\",\"namaakun\":\"Utang\",\"kdparent\":\"2.1\",\"inserted_date\":\"2025-03-17 05:17:27\",\"updated_date\":\"2025-03-17 05:17:27\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-03-17 05:17:27','akun','simpanData'),(537,'{\"kdakun\":\"2.1.01.01\",\"namaakun\":\"Utang Usaha\",\"kdparent\":\"2.1.01\",\"inserted_date\":\"2025-03-17 05:17:46\",\"updated_date\":\"2025-03-17 05:17:46\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-03-17 05:17:46','akun','simpanData'),(538,'{\"prefix\":\"akun_utang_usaha\",\"values\":\"2.1.01.01\",\"inserted_date\":\"2025-03-17 05:18:15\",\"updated_date\":\"2025-03-17 05:18:15\",\"deskripsi\":\"Rekening akun utang usaha\"}','Budiman','2025-03-17 05:18:15','settings','simpanData'),(539,'{\"lastlogin\":\"2025-03-17 05:18:33\"}','Budiman','2025-03-17 05:18:33','pengguna','updateData'),(540,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 03:23:43\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 05:20:39','sales','hapusData'),(542,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 05:21:23\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 05:21:23','postingjurnal','simpanData'),(543,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 05:21:23\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 05:30:08','sales','hapusData'),(544,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 05:30:12\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 05:30:12','postingjurnal','simpanData'),(545,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 05:30:12\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 05:33:18','sales','hapusData'),(546,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 05:33:22\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 05:33:22','postingjurnal','simpanData'),(547,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 05:33:22\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 05:41:24','sales','hapusData'),(549,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 05:44:51\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 05:44:51','postingjurnal','simpanData'),(550,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 05:44:51\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 05:50:48','sales','hapusData'),(551,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 05:50:52\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 05:50:52','postingjurnal','simpanData'),(552,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 05:50:52\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 06:01:53','sales','hapusData'),(553,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 06:01:57\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 06:01:57','postingjurnal','simpanData'),(554,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 06:04:18\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 06:04:18','postingjurnal','simpanData'),(555,'{\"idposting\":\"022025\",\"bulan\":\"02\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-03-17 06:04:23\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 06:04:23','postingjurnal','simpanData'),(556,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"72412460\",\"jumlahkredit\":\"72412460\",\"inserted_date\":\"2025-03-17 06:01:57\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 07:21:59','sales','hapusData'),(557,'{\"idposting\":\"022025\",\"bulan\":\"02\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 06:04:23\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 07:22:02','sales','hapusData'),(558,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-03-17 06:04:18\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-03-17 07:22:05','sales','hapusData'),(559,'{\"idpenjualan\":\"250317JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2503170001\",\"tglinvoice\":\"2025-03-17\",\"keterangan\":\"Test\",\"totalsetelahdiskon\":96000,\"totalsebelumdiskon\":96000,\"inserted_date\":\"2025-03-17 07:22:43\",\"updated_date\":\"2025-03-17 07:22:43\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250317JL0000001#01\",\"ppnpersen\":\"11\"}','Budiman','2025-03-17 07:22:43','penjualan','simpanData'),(560,'[{\"idpenjualan\":\"250317JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"2\",\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"96000\"}]','Budiman','2025-03-17 07:22:43','penjualandetail','simpanData'),(561,'{\"idstockopname\":\"250317SO0000001\",\"tglstockopname\":\"2025-03-17 07:23:45\",\"keterangan\":\"Stok Opname Maret\",\"inserted_date\":\"2025-03-17 07:23:45\",\"updated_date\":\"2025-03-17 07:23:45\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-03-17 07:23:45','stockopname','simpanData'),(562,'[{\"idstockopname\":\"250317SO0000001\",\"idbarang\":\"K001000002\",\"stocksystem\":\"0\",\"stockopname\":\"1500\",\"keterangandetail\":null},{\"idstockopname\":\"250317SO0000001\",\"idbarang\":\"K001000001\",\"stocksystem\":\"-90\",\"stockopname\":\"2200\",\"keterangandetail\":null}]','Budiman','2025-03-17 07:23:45','stockopnamedetail','simpanData'),(563,'{\"lastlogin\":\"2025-03-17 07:30:39\"}','Budiman','2025-03-17 07:30:39','pengguna','updateData'),(564,'{\"lastlogin\":\"2025-03-17 07:31:32\"}','Budiman','2025-03-17 07:31:32','pengguna','updateData'),(565,'{\"lastlogin\":\"2025-04-08 04:13:00\"}','Budiman','2025-04-08 04:13:00','pengguna','updateData'),(566,'{\"lastlogin\":\"2025-04-09 01:06:37\"}','Budiman','2025-04-09 01:06:37','pengguna','updateData'),(567,'{\"idreturpembelian\":\"250409RB0000001\",\"idpembelian\":\"250315BL0000001\",\"tglretur\":\"2025-04-09\",\"totalretur\":90000,\"keterangan\":\"test\",\"inserted_date\":\"2025-04-09 01:20:59\",\"updated_date\":\"2025-04-09 01:20:59\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\"}','Budiman','2025-04-09 01:20:59','returpembelian','simpanData'),(568,'[{\"idreturpembelian\":\"250409RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"2\",\"hargaretur\":\"45000\",\"subtotalretur\":\"90000\"}]','Budiman','2025-04-09 01:20:59','returpembeliandetail','simpanData'),(569,'{\"idreturpembelian\":\"250409RB0000001\",\"idpembelian\":\"250315BL0000001\",\"tglretur\":\"2025-04-09\",\"totalretur\":\"90000\",\"keterangan\":\"test\",\"inserted_date\":\"2025-04-09 01:20:59\",\"updated_date\":\"2025-04-09 01:20:59\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"tglfaktur\":\"2025-03-15\",\"statusretur\":\"Proses\",\"tglpengajuan\":null}','Budiman','2025-04-09 02:14:16','returpembelian','hapusData'),(570,'[{\"idreturdetail\":6,\"idreturpembelian\":\"250409RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":2,\"hargaretur\":\"45000\",\"subtotalretur\":\"90000\"}]','Budiman','2025-04-09 02:14:16','returpembeliandetail','hapusData'),(571,'{\"idreturpembelian\":\"250409RB0000001\",\"idpembelian\":\"250315BL0000001\",\"tglpengajuan\":\"2025-04-09\",\"totalretur\":90000,\"keterangan\":\"test\",\"inserted_date\":\"2025-04-09 02:31:08\",\"updated_date\":\"2025-04-09 02:31:08\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\"}','Budiman','2025-04-09 02:31:08','returpembelian','simpanData'),(572,'[{\"idreturpembelian\":\"250409RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"2\",\"hargaretur\":\"45000\",\"subtotalretur\":\"90000\"}]','Budiman','2025-04-09 02:31:08','returpembeliandetail','simpanData'),(573,'{\"lastlogin\":\"2025-04-10 01:56:20\"}','Budiman','2025-04-10 01:56:20','pengguna','updateData'),(574,'{\"idreturpembelian\":\"250409RB0000001\",\"tglretur\":\"2025-04-10\",\"updated_date\":\"2025-04-10 01:58:26\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"statusretur\":\"Selesai\"}','Budiman','2025-04-10 01:58:26','returpembelian','updateData'),(575,'[{\"idreturdetail\":7,\"idreturpembelian\":\"250409RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":2,\"hargaretur\":\"45000\",\"subtotalretur\":\"90000\"}]','Budiman','2025-04-10 01:58:26','returpembeliandetail','updateData'),(576,'{\"lastlogin\":\"2025-04-14 02:34:46\"}','Budiman','2025-04-14 02:34:46','pengguna','updateData'),(577,'{\"lastlogin\":\"2025-04-15 01:30:12\"}','Budiman','2025-04-15 01:30:12','pengguna','updateData'),(578,'{\"lastlogin\":\"2025-04-15 06:51:32\"}','Budiman','2025-04-15 06:51:32','pengguna','updateData'),(579,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-15 07:27:37\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-15 07:27:37','postingjurnal','simpanData'),(580,'{\"idposting\":\"022025\",\"bulan\":\"02\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-15 07:27:41\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-15 07:27:41','postingjurnal','simpanData'),(581,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-15 07:27:45\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-15 07:27:45','postingjurnal','simpanData'),(582,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-15 07:27:49\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-15 07:27:49','postingjurnal','simpanData'),(583,'{\"lastlogin\":\"2025-04-16 01:19:03\"}','Budiman','2025-04-16 01:19:03','pengguna','updateData'),(584,'{\"lastlogin\":\"2025-04-17 01:27:11\"}','Budiman','2025-04-17 01:27:11','pengguna','updateData'),(585,'{\"lastlogin\":\"2025-04-17 03:55:21\"}','Budiman','2025-04-17 03:55:21','pengguna','updateData'),(586,'{\"lastlogin\":\"2025-04-21 02:41:12\"}','Budiman','2025-04-21 02:41:12','pengguna','updateData'),(587,'{\"lastlogin\":\"2025-04-22 00:50:40\"}','Budiman','2025-04-22 00:50:40','pengguna','updateData'),(588,'{\"prefix\":\"ppn_pembelian\",\"values\":\"11\",\"inserted_date\":\"2025-04-22 03:38:36\",\"updated_date\":\"2025-04-22 03:38:36\",\"deskripsi\":\"PPN Pembelian dalam persen\"}','Budiman','2025-04-22 03:38:36','settings','simpanData'),(589,'{\"lastlogin\":\"2025-04-22 03:39:00\"}','Budiman','2025-04-22 03:39:00','pengguna','updateData'),(590,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"90000\",\"jumlahkredit\":\"90000\",\"inserted_date\":\"2025-04-15 07:27:49\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-22 03:52:10','sales','hapusData'),(591,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"72519020\",\"jumlahkredit\":\"72519020\",\"inserted_date\":\"2025-04-15 07:27:45\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-22 03:52:14','sales','hapusData'),(592,'{\"idposting\":\"022025\",\"bulan\":\"02\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-04-15 07:27:41\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-22 03:52:18','sales','hapusData'),(593,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-04-15 07:27:37\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-22 03:52:21','sales','hapusData'),(594,'{\"idhutangdetail\":\"250315HU0001002\",\"idhutang\":\"250315HU0001\",\"tglhutang\":\"2025-03-15\",\"debet\":\"500000\",\"kredit\":\"0\",\"inserted_date\":\"2025-03-15 13:13:24\",\"updated_date\":\"2025-03-15 13:13:24\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250315BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Niaga\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-22 03:52:32','hutangdetail','hapusData'),(595,'{\"idpembelian\":\"250306BL0000002\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"2222\",\"tglfaktur\":\"2025-03-06\",\"tglditerima\":\"2025-03-06\",\"keterangan\":\"ada\",\"totalsetelahdiskon\":\"990000\",\"totalsebelumdiskon\":\"990000\",\"inserted_date\":\"2025-03-06 12:43:45\",\"updated_date\":\"2025-03-06 12:43:45\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"PT. Intra Makmur\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\"}','Budiman','2025-04-22 03:52:41','pembelian','hapusData'),(596,'[{\"id\":33,\"idpembelian\":\"250306BL0000002\",\"idbarang\":\"K001000002\",\"jumlahbeli\":22,\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"jumlahdiskon\":null,\"subtotalbeli\":\"990000\",\"jenisdiskon\":null,\"diskonpersen1\":null,\"diskonpersen2\":null,\"diskonpersen3\":null}]','Budiman','2025-04-22 03:52:41','pembeliandetail','hapusData'),(597,'{\"idpembelian\":\"250316BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"010022\\/FK\\/2025\",\"tglfaktur\":\"2025-03-16\",\"tglditerima\":\"2025-03-16\",\"keterangan\":\"Pembeliah Bahan\",\"totalsetelahdiskon\":\"900000\",\"totalsebelumdiskon\":\"900000\",\"inserted_date\":\"2025-03-16 05:13:55\",\"updated_date\":\"2025-03-16 05:13:55\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\"}','Budiman','2025-04-22 03:52:57','pembelian','hapusData'),(598,'[{\"id\":41,\"idpembelian\":\"250316BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":20,\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"jumlahdiskon\":null,\"subtotalbeli\":\"900000\",\"jenisdiskon\":null,\"diskonpersen1\":null,\"diskonpersen2\":null,\"diskonpersen3\":null}]','Budiman','2025-04-22 03:52:57','pembeliandetail','hapusData'),(599,'{\"idreturpembelian\":\"250409RB0000001\",\"idpembelian\":\"250315BL0000001\",\"tglretur\":\"2025-04-10\",\"totalretur\":\"90000\",\"keterangan\":\"test\",\"inserted_date\":\"2025-04-09 02:31:08\",\"updated_date\":\"2025-04-10 01:58:26\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"tglfaktur\":\"2025-03-15\",\"statusretur\":\"Selesai\",\"tglpengajuan\":\"2025-04-09\"}','Budiman','2025-04-22 03:56:55','returpembelian','hapusData'),(600,'[{\"idreturdetail\":7,\"idreturpembelian\":\"250409RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":2,\"hargaretur\":\"45000\",\"subtotalretur\":\"90000\"}]','Budiman','2025-04-22 03:56:55','returpembeliandetail','hapusData'),(601,'{\"idpembelian\":\"250315BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"728199\\/FA\\/2025\",\"tglfaktur\":\"2025-03-15\",\"tglditerima\":\"2025-03-15\",\"keterangan\":\"Pembelian Kayu\",\"totalsetelahdiskon\":\"1350000\",\"totalsebelumdiskon\":\"1350000\",\"inserted_date\":\"2025-03-15 13:01:29\",\"updated_date\":\"2025-03-15 13:01:29\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null}','Budiman','2025-04-22 04:01:26','pembelian','hapusData'),(602,'[{\"id\":40,\"idpembelian\":\"250315BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":30,\"hargasebelumdiskon\":\"45000\",\"hargasetelahdiskon\":\"45000\",\"jumlahdiskon\":null,\"subtotalbeli\":\"1350000\",\"jenisdiskon\":null,\"diskonpersen1\":null,\"diskonpersen2\":null,\"diskonpersen3\":null}]','Budiman','2025-04-22 04:01:26','pembeliandetail','hapusData'),(603,'{\"idpembelian\":\"250422BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"01\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"Test\",\"totalpembelian\":\"450000\",\"totaldiskon\":\"86620\",\"totalbersih\":\"363380\",\"ppnpersen\":\"11\",\"totalppn\":\"39971\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"403351\",\"inserted_date\":\"2025-04-22 04:31:54\",\"updated_date\":\"2025-04-22 04:31:54\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-04-22 04:31:54','pembelian','simpanData'),(604,'[{\"idpembelian\":\"250422BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"10\",\"hargasatuan\":\"45000\",\"jumlahdiskon\":\"8662\",\"subtotalbeli\":\"363380\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"15\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-22 04:31:55','pembeliandetail','simpanData'),(605,'{\"idpembelian\":\"250422BL0000002\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"TEst2\",\"totalpembelian\":\"490000\",\"totaldiskon\":\"24500\",\"totalbersih\":\"465500\",\"ppnpersen\":\"11\",\"totalppn\":\"51205\",\"biayapengiriman\":\"25000\",\"totalfaktur\":\"516705\",\"inserted_date\":\"2025-04-22 04:33:04\",\"updated_date\":\"2025-04-22 04:33:04\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-04-22 04:33:04','pembelian','simpanData'),(606,'[{\"idpembelian\":\"250422BL0000002\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"35\",\"hargasatuan\":\"14000\",\"jumlahdiskon\":\"700\",\"subtotalbeli\":\"465500\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-22 04:33:04','pembeliandetail','simpanData'),(607,'{\"idpembelian\":\"250422BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"01\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"Test\",\"inserted_date\":\"2025-04-22 04:31:54\",\"updated_date\":\"2025-04-22 04:31:54\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Tunai\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"totalpembelian\":\"450000\",\"totaldiskon\":\"86620\",\"totalbersih\":\"363380\",\"ppnpersen\":11,\"totalppn\":\"39971\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"403351\"}','Budiman','2025-04-22 04:36:03','pembelian','hapusData'),(608,'[{\"id\":42,\"idpembelian\":\"250422BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":10,\"hargasatuan\":\"45000\",\"jumlahdiskon\":\"8662\",\"subtotalbeli\":\"363380\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":15,\"diskonpersen2\":5,\"diskonpersen3\":0}]','Budiman','2025-04-22 04:36:03','pembeliandetail','hapusData'),(609,'{\"idpembelian\":\"250422BL0000002\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"TEst2\",\"totalpembelian\":\"490000\",\"totaldiskon\":\"24500\",\"totalbersih\":\"465500\",\"ppnpersen\":\"11\",\"totalppn\":\"51205\",\"biayapengiriman\":\"25000\",\"totalfaktur\":\"541705\",\"updated_date\":\"2025-04-22 04:50:32\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-04-22 04:50:33','pembelian','updateData'),(610,'[{\"idpembelian\":\"250422BL0000002\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"35\",\"hargasatuan\":\"14000\",\"jumlahdiskon\":\"700\",\"subtotalbeli\":\"465500\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-22 04:50:33','pembeliandetail','updateData'),(611,'{\"idpembelian\":\"250422BL0000003\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"03\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"TEST\",\"totalpembelian\":\"1125000\",\"totaldiskon\":\"88300\",\"totalbersih\":\"1036700\",\"ppnpersen\":\"11\",\"totalppn\":\"114037\",\"biayapengiriman\":\"30000\",\"totalfaktur\":\"1180737\",\"inserted_date\":\"2025-04-22 04:52:39\",\"updated_date\":\"2025-04-22 04:52:39\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\"}','Budiman','2025-04-22 04:52:39','pembelian','simpanData'),(612,'[{\"idpembelian\":\"250422BL0000003\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"25\",\"hargasatuan\":\"45000\",\"jumlahdiskon\":\"3532\",\"subtotalbeli\":\"1036700\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"3\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-22 04:52:39','pembeliandetail','simpanData'),(613,'{\"idpembelian\":\"250422BL0000003\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"03\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"TEST\",\"totalpembelian\":\"1125000\",\"totaldiskon\":\"88300\",\"totalbersih\":\"1036700\",\"ppnpersen\":\"11\",\"totalppn\":\"114037\",\"biayapengiriman\":\"30000\",\"totalfaktur\":\"1180737\",\"updated_date\":\"2025-04-22 04:52:52\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\"}','Budiman','2025-04-22 04:52:52','pembelian','updateData'),(614,'[{\"idpembelian\":\"250422BL0000003\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"25\",\"hargasatuan\":\"45000\",\"jumlahdiskon\":\"3532\",\"subtotalbeli\":\"1036700\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"3\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-22 04:52:52','pembeliandetail','updateData'),(615,'{\"idpembelian\":\"250422BL0000003\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"03\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"TEST\",\"totalpembelian\":\"1125000\",\"totaldiskon\":\"88300\",\"totalbersih\":\"1036700\",\"ppnpersen\":\"11\",\"totalppn\":\"114037\",\"biayapengiriman\":\"30000\",\"totalfaktur\":\"1180737\",\"updated_date\":\"2025-04-22 04:53:25\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\"}','Budiman','2025-04-22 04:53:25','pembelian','updateData'),(616,'[{\"idpembelian\":\"250422BL0000003\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"25\",\"hargasatuan\":\"45000\",\"jumlahdiskon\":\"3532\",\"subtotalbeli\":\"1036700\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"3\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-22 04:53:25','pembeliandetail','updateData'),(617,'{\"idpembelian\":\"250422BL0000002\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"TEst2\",\"totalpembelian\":\"490000\",\"totaldiskon\":\"24500\",\"totalbersih\":\"465500\",\"ppnpersen\":\"11\",\"totalppn\":\"51205\",\"biayapengiriman\":\"25000\",\"totalfaktur\":\"541705\",\"updated_date\":\"2025-04-22 04:53:31\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\"}','Budiman','2025-04-22 04:53:31','pembelian','updateData'),(618,'[{\"idpembelian\":\"250422BL0000002\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"35\",\"hargasatuan\":\"14000\",\"jumlahdiskon\":\"700\",\"subtotalbeli\":\"465500\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-22 04:53:31','pembeliandetail','updateData'),(619,'{\"idpembelian\":\"250422BL0000004\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"04\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"Test\",\"totalpembelian\":\"462000\",\"totaldiskon\":\"66000\",\"totalbersih\":\"396000\",\"ppnpersen\":\"11\",\"totalppn\":\"43560\",\"biayapengiriman\":\"15000\",\"totalfaktur\":\"454560\",\"inserted_date\":\"2025-04-22 04:54:50\",\"updated_date\":\"2025-04-22 04:54:50\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-04-22 04:54:50','pembelian','simpanData'),(620,'[{\"idpembelian\":\"250422BL0000004\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"33\",\"hargasatuan\":\"14000\",\"jumlahdiskon\":\"2000\",\"subtotalbeli\":\"396000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-22 04:54:50','pembeliandetail','simpanData'),(621,'{\"idpembelian\":\"250422BL0000004\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"04\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"Test\",\"totalpembelian\":\"462000\",\"totaldiskon\":\"66000\",\"totalbersih\":\"396000\",\"ppnpersen\":\"11\",\"totalppn\":\"43560\",\"biayapengiriman\":\"15000\",\"totalfaktur\":\"454560\",\"updated_date\":\"2025-04-22 04:58:01\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-04-22 04:58:01','pembelian','updateData'),(622,'[{\"idpembelian\":\"250422BL0000004\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"33\",\"hargasatuan\":\"14000\",\"jumlahdiskon\":\"2000\",\"subtotalbeli\":\"396000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-22 04:58:01','pembeliandetail','updateData'),(623,'{\"idbank\":\"BT001\",\"namabank\":\"BNI\",\"cabang\":\"Pontianak\",\"norekening\":\"081520002000\",\"atasnama\":\"Budi\",\"kdakun\":\"1.1.01.03\",\"inserted_date\":\"2025-04-22 05:04:37\",\"updated_date\":\"2025-04-22 05:04:37\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-22 05:04:37','bank','simpanData'),(624,'{\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"atasnama\":\"Budi Santoso\",\"kdakun\":\"1.1.01.03\",\"updated_date\":\"2025-04-22 05:06:37\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-22 05:06:37','bank','updateData'),(625,'{\"idbank\":\"BN001\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"atasnama\":\"Budi Santoso\",\"kdakun\":\"1.1.01.02\",\"updated_date\":\"2025-04-22 05:06:44\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-22 05:06:44','bank','updateData'),(626,'{\"idbank\":\"BT001\",\"namabank\":\"BNI\",\"cabang\":\"Pontianak\",\"norekening\":\"081520002000\",\"kdakun\":\"1.1.01.03\",\"inserted_date\":\"2025-04-22 05:04:37\",\"updated_date\":\"2025-04-22 05:04:37\",\"statusaktif\":\"Aktif\",\"namaakun\":\"Rekening BCA\",\"kdparent\":\"1.1.01\",\"atasnama\":\"Budi\"}','Budiman','2025-04-22 05:06:48','bank','hapusData'),(627,'{\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"atasnama\":\"Budi Santoso\",\"kdakun\":\"1.1.01.03\",\"updated_date\":\"2025-04-22 06:53:28\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-22 06:53:28','bank','updateData'),(628,'{\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"atasnama\":\"Budi Santoso1\",\"kdakun\":\"1.1.01.03\",\"updated_date\":\"2025-04-22 06:53:34\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-22 06:53:34','bank','updateData'),(629,'{\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"atasnama\":\"Budi Santoso\",\"kdakun\":\"1.1.01.03\",\"updated_date\":\"2025-04-22 06:53:40\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-22 06:53:40','bank','updateData'),(630,'{\"lastlogin\":\"2025-04-22 11:49:17\"}','Budiman','2025-04-22 11:49:17','pengguna','updateData'),(631,'{\"idpiutangdetail\":\"250314PI0001003\",\"idpiutang\":\"250314PI0001\",\"tglpiutang\":\"2025-03-14\",\"debet\":\"0\",\"kredit\":\"1098400\",\"inserted_date\":\"2025-03-14 04:25:17\",\"updated_date\":\"2025-03-14 04:25:17\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250314JL0000002\",\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Niaga\",\"nokwitansi\":\"250314JL0000002#02\"}','Budiman','2025-04-22 11:52:36','piutangdetail','hapusData'),(632,'{\"idpiutangdetail\":\"250314PI0001002\",\"idpiutang\":\"250314PI0001\",\"tglpiutang\":\"2025-03-14\",\"debet\":\"0\",\"kredit\":\"500000\",\"inserted_date\":\"2025-03-14 04:24:24\",\"updated_date\":\"2025-03-14 04:24:24\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250314JL0000002\",\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"nokwitansi\":\"250314JL0000002#01\"}','Budiman','2025-04-22 11:52:41','piutangdetail','hapusData'),(633,'{\"idreturpenjualan\":\"250316RJ0000001\",\"idpenjualan\":\"250314JL0000001\",\"tglretur\":\"2025-03-15\",\"totalretur\":\"30000\",\"keterangan\":\"Kayu nya retak\",\"inserted_date\":\"2025-03-15 18:55:33\",\"updated_date\":\"2025-03-15 18:55:33\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-03-14\",\"noinvoice\":\"2503140001\",\"namakonsumen\":\"PT. Intrajaya\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-22 11:52:53','returpenjualan','hapusData'),(634,'[{\"idreturdetail\":5,\"idreturpenjualan\":\"250316RJ0000001\",\"idbarang\":\"K001000001\",\"jumlahretur\":2,\"hargaretur\":\"15000\",\"subtotalretur\":\"30000\"}]','Budiman','2025-04-22 11:52:53','returpenjualandetail','hapusData'),(635,'{\"idpenjualan\":\"250314JL0000001\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-03-14\",\"noinvoice\":\"2503140001\",\"keterangan\":\"Test\",\"totalsetelahdiskon\":\"1110000\",\"totalsebelumdiskon\":\"1110000\",\"totalsetelahdiskonplusppn\":1232100,\"totalsebelumdiskonplusppn\":1232100,\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-14 01:47:42\",\"updated_date\":\"2025-03-14 01:47:42\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"PT. Intrajaya\",\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"nokwitansi\":\"250314JL0000001#01\",\"ppnpersen\":11}','Budiman','2025-04-22 11:53:04','penjualan','hapusData'),(636,'[{\"id\":42,\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":10,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"150000\"},{\"id\":43,\"idpenjualan\":\"250314JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":20,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"960000\"}]','Budiman','2025-04-22 11:53:04','penjualandetail','hapusData'),(637,'{\"idpenjualan\":\"250317JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-17\",\"noinvoice\":\"2503170001\",\"keterangan\":\"Test\",\"totalsetelahdiskon\":\"96000\",\"totalsebelumdiskon\":\"96000\",\"totalsetelahdiskonplusppn\":106560,\"totalsebelumdiskonplusppn\":106560,\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-17 07:22:43\",\"updated_date\":\"2025-03-17 07:22:43\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"nokwitansi\":\"250317JL0000001#01\",\"ppnpersen\":11}','Budiman','2025-04-22 11:53:13','penjualan','hapusData'),(638,'[{\"id\":47,\"idpenjualan\":\"250317JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":2,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"96000\"}]','Budiman','2025-04-22 11:53:13','penjualandetail','hapusData'),(639,'{\"idpenjualan\":\"250316JL0000002\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-16\",\"noinvoice\":\"2503160002\",\"keterangan\":\"test\",\"totalsetelahdiskon\":\"96000\",\"totalsebelumdiskon\":\"96000\",\"totalsetelahdiskonplusppn\":106560,\"totalsebelumdiskonplusppn\":106560,\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-16 05:12:59\",\"updated_date\":\"2025-03-16 05:12:59\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":null,\"jatuhtempo\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"nokwitansi\":\"250316JL0000002#01\",\"ppnpersen\":11}','Budiman','2025-04-22 11:53:22','penjualan','hapusData'),(640,'[{\"id\":46,\"idpenjualan\":\"250316JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":2,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"96000\"}]','Budiman','2025-04-22 11:53:22','penjualandetail','hapusData'),(641,'{\"idpenjualan\":\"250316JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-15\",\"noinvoice\":\"2503160001\",\"keterangan\":\"TEST2\",\"totalsetelahdiskon\":\"1200000\",\"totalsebelumdiskon\":\"1200000\",\"totalsetelahdiskonplusppn\":1332000,\"totalsebelumdiskonplusppn\":1332000,\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-15 18:43:16\",\"updated_date\":\"2025-03-15 18:43:16\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":\"Fast\",\"jatuhtempo\":7,\"namakonsumen\":\"CV. Karya Utama\",\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"nokwitansi\":null,\"ppnpersen\":11}','Budiman','2025-04-22 11:53:31','penjualan','hapusData'),(642,'[{\"id\":45,\"idpenjualan\":\"250316JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":80,\"hargasebelumdiskon\":\"15000\",\"hargasetelahdiskon\":\"15000\",\"subtotaljual\":\"1200000\"}]','Budiman','2025-04-22 11:53:32','penjualandetail','hapusData'),(643,'{\"idpenjualan\":\"250314JL0000002\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-03-14\",\"noinvoice\":\"2503140002\",\"keterangan\":\"Test Piutang\",\"totalsetelahdiskon\":\"1440000\",\"totalsebelumdiskon\":\"1440000\",\"totalsetelahdiskonplusppn\":1598400,\"totalsebelumdiskonplusppn\":1598400,\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-03-14 04:20:45\",\"updated_date\":\"2025-03-14 04:20:45\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namajenispiutang\":\"Fast\",\"jatuhtempo\":7,\"namakonsumen\":\"CV. Karya Utama\",\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"nokwitansi\":null,\"ppnpersen\":11}','Budiman','2025-04-22 11:53:40','penjualan','hapusData'),(644,'[{\"id\":44,\"idpenjualan\":\"250314JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":30,\"hargasebelumdiskon\":\"48000\",\"hargasetelahdiskon\":\"48000\",\"subtotaljual\":\"1440000\"}]','Budiman','2025-04-22 11:53:40','penjualandetail','hapusData'),(645,'{\"lastlogin\":\"2025-04-23 02:18:53\"}','Budiman','2025-04-23 02:18:53','pengguna','updateData'),(646,'{\"idpenjualan\":\"250423JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2504230001\",\"tglinvoice\":\"2025-04-23\",\"keterangan\":\"Test\",\"totalpenjualan\":\"480000\",\"totaldiskon\":\"56640\",\"totalbersih\":\"536640\",\"ppnpersen\":\"11\",\"totalppn\":\"59030\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"595670\",\"inserted_date\":\"2025-04-23 03:10:59\",\"updated_date\":\"2025-04-23 03:10:59\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250423JL0000001#01\"}','Budiman','2025-04-23 03:10:59','penjualan','simpanData'),(647,'[{\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"5664\",\"subtotaljual\":\"536640\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"2\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-23 03:10:59','penjualandetail','simpanData'),(648,'{\"idpenjualan\":\"250423JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2504230001\",\"tglinvoice\":\"2025-04-23\",\"keterangan\":\"Test\",\"totalpenjualan\":\"480000\",\"totaldiskon\":\"56640\",\"totalbersih\":\"536640\",\"ppnpersen\":\"11\",\"totalppn\":\"59030\",\"biayapengiriman\":\"25000\",\"totalinvoice\":\"620670\",\"updated_date\":\"2025-04-23 03:47:04\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250423JL0000001#02\"}','Budiman','2025-04-23 03:47:04','penjualan','updateData'),(649,'[{\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"5664\",\"subtotaljual\":\"536640\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"2\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-23 03:47:04','penjualandetail','updateData'),(650,'{\"idpenjualan\":\"250423JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2504230001\",\"tglinvoice\":\"2025-04-23\",\"keterangan\":\"Test\",\"totalpenjualan\":\"480000\",\"totaldiskon\":\"56640\",\"totalbersih\":\"536640\",\"ppnpersen\":\"11\",\"totalppn\":\"59030\",\"biayapengiriman\":\"30000\",\"totalinvoice\":\"625670\",\"updated_date\":\"2025-04-23 03:48:45\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250423JL0000001#03\"}','Budiman','2025-04-23 03:48:45','penjualan','updateData'),(651,'[{\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"5664\",\"subtotaljual\":\"536640\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"2\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-23 03:48:45','penjualandetail','updateData'),(652,'{\"idpenjualan\":\"250423JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2504230001\",\"tglinvoice\":\"2025-04-23\",\"keterangan\":\"Test\",\"totalpenjualan\":\"630000\",\"totaldiskon\":\"68640\",\"totalbersih\":\"698640\",\"ppnpersen\":\"11\",\"totalppn\":\"76850\",\"biayapengiriman\":\"25000\",\"totalinvoice\":\"800490\",\"updated_date\":\"2025-04-23 03:49:30\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250423JL0000001#04\"}','Budiman','2025-04-23 03:49:30','penjualan','updateData'),(653,'[{\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"5664\",\"subtotaljual\":\"536640\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"2\",\"diskonpersen3\":\"0\"},{\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"10\",\"hargasatuan\":\"15000\",\"jumlahdiskon\":\"1200\",\"subtotaljual\":\"162000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-23 03:49:30','penjualandetail','updateData'),(654,'{\"idpenjualan\":\"250423JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-04-23\",\"noinvoice\":\"2504230001\",\"keterangan\":\"Test\",\"totalpenjualan\":\"630000\",\"totaldiskon\":\"68640\",\"totalbersih\":\"698640\",\"ppnpersen\":11,\"totalppn\":\"76850\",\"biayapengiriman\":\"25000\",\"totalinvoice\":\"800490\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-04-23 03:10:59\",\"updated_date\":\"2025-04-23 03:49:30\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250423JL0000001#04\",\"namakonsumen\":\"CV. Karya Utama\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"atasnama\":\"Budi Santoso\",\"namasales\":\"Khairuddin\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-04-23 03:51:25','penjualan','hapusData'),(655,'[{\"id\":51,\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":10,\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"5664\",\"subtotaljual\":\"536640\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":10,\"diskonpersen2\":2,\"diskonpersen3\":0},{\"id\":52,\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":10,\"hargasatuan\":\"15000\",\"jumlahdiskon\":\"1200\",\"subtotaljual\":\"162000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-04-23 03:51:25','penjualandetail','hapusData'),(656,'{\"idpenjualan\":\"250423JL0000001\",\"idkonsumen\":null,\"noinvoice\":\"2504230001\",\"tglinvoice\":\"2025-04-23\",\"keterangan\":\"Test\",\"totalpenjualan\":\"630000\",\"totaldiskon\":\"69600\",\"totalbersih\":\"699600\",\"ppnpersen\":\"11\",\"totalppn\":\"76956\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"776556\",\"inserted_date\":\"2025-04-23 03:53:55\",\"updated_date\":\"2025-04-23 03:53:55\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":null,\"nokwitansi\":null}','Budiman','2025-04-23 03:53:55','penjualan','simpanData'),(657,'[{\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"6960\",\"subtotaljual\":\"549600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"},{\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"10\",\"hargasatuan\":\"15000\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"150000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-23 03:53:55','penjualandetail','simpanData'),(658,'{\"idpenjualan\":\"250423JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2504230001\",\"tglinvoice\":\"2025-04-23\",\"keterangan\":\"Test\",\"totalpenjualan\":\"630000\",\"totaldiskon\":\"69600\",\"totalbersih\":\"699600\",\"ppnpersen\":\"11\",\"totalppn\":\"76956\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"776556\",\"updated_date\":\"2025-04-23 03:59:31\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null}','Budiman','2025-04-23 03:59:31','penjualan','updateData'),(659,'[{\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"10\",\"hargasatuan\":\"15000\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"150000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"6960\",\"subtotaljual\":\"549600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-23 03:59:31','penjualandetail','updateData'),(660,'{\"idpenjualan\":\"250423JL0000002\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2504230002\",\"tglinvoice\":\"2025-04-23\",\"keterangan\":\"Test\",\"totalpenjualan\":\"960000\",\"totaldiskon\":\"105600\",\"totalbersih\":\"1065600\",\"ppnpersen\":\"11\",\"totalppn\":\"117216\",\"biayapengiriman\":\"20000\",\"totalinvoice\":\"1202816\",\"inserted_date\":\"2025-04-23 04:03:21\",\"updated_date\":\"2025-04-23 04:03:21\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null}','Budiman','2025-04-23 04:03:21','penjualan','simpanData'),(661,'[{\"idpenjualan\":\"250423JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"20\",\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"5280\",\"subtotaljual\":\"1065600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"11\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-23 04:03:21','penjualandetail','simpanData'),(662,'{\"idpenjualan\":\"250423JL0000002\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"2504230002\",\"tglinvoice\":\"2025-04-23\",\"keterangan\":\"Test\",\"totalpenjualan\":\"960000\",\"totaldiskon\":\"105600\",\"totalbersih\":\"1065600\",\"ppnpersen\":\"11\",\"totalppn\":\"117216\",\"biayapengiriman\":\"20000\",\"totalinvoice\":\"1202816\",\"updated_date\":\"2025-04-23 04:03:30\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null}','Budiman','2025-04-23 04:03:30','penjualan','updateData'),(663,'[{\"idpenjualan\":\"250423JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"20\",\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"5280\",\"subtotaljual\":\"1065600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"11\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-23 04:03:30','penjualandetail','updateData'),(664,'{\"idpiutangdetail\":\"250423PI0002002\",\"idpiutang\":\"250423PI0002\",\"tglpiutang\":\"2025-04-23\",\"debet\":0,\"kredit\":\"1202816\",\"inserted_date\":\"2025-04-23 04:03:42\",\"updated_date\":\"2025-04-23 04:03:42\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250423JL0000002#01\"}','Budiman','2025-04-23 04:03:42','piutangdetail','simpanData'),(665,'{\"idpenjualan\":\"250423JL0000001\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-04-23\",\"noinvoice\":\"2504230001\",\"keterangan\":\"Test\",\"totalpenjualan\":\"630000\",\"totaldiskon\":\"69600\",\"totalbersih\":\"699600\",\"ppnpersen\":11,\"totalppn\":\"76956\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"776556\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-04-23 03:53:55\",\"updated_date\":\"2025-04-23 03:59:31\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null,\"namakonsumen\":\"PT. Intrajaya\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Siti Khadizah\",\"namajenispiutang\":\"Fast\",\"jatuhtempo\":7,\"namapengguna\":\"Budiman\"}','Budiman','2025-04-23 04:04:20','penjualan','hapusData'),(666,'[{\"id\":55,\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":10,\"hargasatuan\":\"15000\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"150000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0},{\"id\":56,\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":10,\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"6960\",\"subtotaljual\":\"549600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":10,\"diskonpersen2\":5,\"diskonpersen3\":0}]','Budiman','2025-04-23 04:04:20','penjualandetail','hapusData'),(667,'{\"idpiutangdetail\":\"250423PI0002002\",\"idpiutang\":\"250423PI0002\",\"tglpiutang\":\"2025-04-23\",\"debet\":\"0\",\"kredit\":\"1202816\",\"inserted_date\":\"2025-04-23 04:03:42\",\"updated_date\":\"2025-04-23 04:03:42\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250423JL0000002\",\"idjenispiutang\":\"P02\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"nokwitansi\":\"250423JL0000002#01\"}','Budiman','2025-04-23 04:05:02','piutangdetail','hapusData'),(668,'{\"idpenjualan\":\"250423JL0000002\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-04-23\",\"noinvoice\":\"2504230002\",\"keterangan\":\"Test\",\"totalpenjualan\":\"960000\",\"totaldiskon\":\"105600\",\"totalbersih\":\"1065600\",\"ppnpersen\":11,\"totalppn\":\"117216\",\"biayapengiriman\":\"20000\",\"totalinvoice\":\"1202816\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-04-23 04:03:21\",\"updated_date\":\"2025-04-23 04:03:30\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null,\"namakonsumen\":\"PT. Intrajaya\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Siti Khadizah\",\"namajenispiutang\":\"Middle\",\"jatuhtempo\":30,\"namapengguna\":\"Budiman\"}','Budiman','2025-04-23 04:05:11','penjualan','hapusData'),(669,'[{\"id\":58,\"idpenjualan\":\"250423JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":20,\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"5280\",\"subtotaljual\":\"1065600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":11,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-04-23 04:05:11','penjualandetail','hapusData'),(670,'{\"idpenjualan\":\"250423JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2504230001\",\"tglinvoice\":\"2025-04-23\",\"keterangan\":\"Kayu Besar\",\"totalpenjualan\":\"5760000\",\"totaldiskon\":\"835200\",\"totalbersih\":\"6595200\",\"ppnpersen\":\"11\",\"totalppn\":\"725472\",\"biayapengiriman\":\"150000\",\"totalinvoice\":\"7470672\",\"inserted_date\":\"2025-04-23 04:06:06\",\"updated_date\":\"2025-04-23 04:06:06\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSKES0001\",\"nokwitansi\":null}','Budiman','2025-04-23 04:06:06','penjualan','simpanData'),(671,'[{\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"120\",\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"6960\",\"subtotaljual\":\"6595200\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-23 04:06:06','penjualandetail','simpanData'),(672,'{\"lastlogin\":\"2025-04-24 01:46:55\"}','Budiman','2025-04-24 01:46:55','pengguna','updateData'),(673,'{\"idhutangdetail\":\"250422HU0001002\",\"idhutang\":\"250422HU0001\",\"tglhutang\":\"2025-04-24\",\"debet\":\"454560\",\"kredit\":0,\"inserted_date\":\"2025-04-24 02:34:11\",\"updated_date\":\"2025-04-24 02:34:11\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-04-24 02:34:11','hutangdetail','simpanData'),(674,'{\"lastlogin\":\"2025-04-24 07:45:50\"}','Budiman','2025-04-24 07:45:50','pengguna','updateData'),(675,'{\"lastlogin\":\"2025-04-24 14:46:20\"}','Budiman','2025-04-24 14:46:20','pengguna','updateData'),(676,'{\"lastlogin\":\"2025-04-24 14:46:24\"}','Budiman','2025-04-24 14:46:24','pengguna','updateData'),(677,'{\"idreturpembelian\":\"250424RB0000001\",\"idpembelian\":\"250422BL0000002\",\"tglpengajuan\":\"2025-04-24\",\"totalretur\":490000,\"keterangan\":\"test\",\"inserted_date\":\"2025-04-24 15:50:48\",\"updated_date\":\"2025-04-24 15:50:48\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\"}','Budiman','2025-04-24 15:50:48','returpembelian','simpanData'),(678,'[{\"idreturpembelian\":\"250424RB0000001\",\"idbarang\":\"K001000001\",\"jumlahretur\":\"35\",\"hargaretur\":\"14000\",\"subtotalretur\":\"490000\"}]','Budiman','2025-04-24 15:50:48','returpembeliandetail','simpanData'),(679,'{\"idreturpembelian\":\"250424RB0000001\",\"tglretur\":\"2025-04-24\",\"updated_date\":\"2025-04-24 15:51:18\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"statusretur\":\"Selesai\"}','Budiman','2025-04-24 15:51:18','returpembelian','updateData'),(680,'[{\"idreturdetail\":8,\"idreturpembelian\":\"250424RB0000001\",\"idbarang\":\"K001000001\",\"jumlahretur\":35,\"hargaretur\":\"14000\",\"subtotalretur\":\"490000\"}]','Budiman','2025-04-24 15:51:18','returpembeliandetail','updateData'),(681,'{\"idreturpembelian\":\"250424RB0000001\",\"idpembelian\":\"250422BL0000002\",\"tglretur\":\"2025-04-24\",\"totalretur\":\"490000\",\"keterangan\":\"test\",\"inserted_date\":\"2025-04-24 15:50:48\",\"updated_date\":\"2025-04-24 15:51:18\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPIMN0001\",\"namasupplier\":\"PT. Intra Makmur\",\"tglfaktur\":\"2025-04-22\",\"statusretur\":\"Selesai\",\"tglpengajuan\":\"2025-04-24\"}','Budiman','2025-04-24 15:52:34','returpembelian','hapusData'),(682,'[{\"idreturdetail\":8,\"idreturpembelian\":\"250424RB0000001\",\"idbarang\":\"K001000001\",\"jumlahretur\":35,\"hargaretur\":\"14000\",\"subtotalretur\":\"490000\"}]','Budiman','2025-04-24 15:52:34','returpembeliandetail','hapusData'),(683,'{\"idreturpembelian\":\"250424RB0000001\",\"idpembelian\":\"250422BL0000003\",\"tglpengajuan\":\"2025-04-24\",\"totalretur\":450000,\"keterangan\":null,\"inserted_date\":\"2025-04-24 16:12:45\",\"updated_date\":\"2025-04-24 16:12:45\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\"}','Budiman','2025-04-24 16:12:45','returpembelian','simpanData'),(684,'[{\"idreturpembelian\":\"250424RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"10\",\"hargaretur\":\"45000\",\"subtotalretur\":\"450000\"}]','Budiman','2025-04-24 16:12:45','returpembeliandetail','simpanData'),(685,'{\"idreturpembelian\":\"250424RB0000002\",\"idpembelian\":\"250422BL0000003\",\"tglpengajuan\":\"2025-04-24\",\"totalretur\":135000,\"keterangan\":\"Kayu nya tidak lurus dan berlobang\",\"inserted_date\":\"2025-04-24 16:29:35\",\"updated_date\":\"2025-04-24 16:29:35\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\"}','Budiman','2025-04-24 16:29:36','returpembelian','simpanData'),(686,'[{\"idreturpembelian\":\"250424RB0000002\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"3\",\"hargaretur\":\"45000\",\"subtotalretur\":\"135000\"}]','Budiman','2025-04-24 16:29:36','returpembeliandetail','simpanData'),(687,'{\"idreturpembelian\":\"250424RB0000001\",\"idpembelian\":\"250422BL0000003\",\"tglretur\":null,\"totalretur\":\"450000\",\"keterangan\":null,\"inserted_date\":\"2025-04-24 16:12:45\",\"updated_date\":\"2025-04-24 16:12:45\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\",\"tglpengajuan\":\"2025-04-24\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"tglfaktur\":\"2025-04-22\",\"nofaktur\":\"03\\/2025\"}','Budiman','2025-04-24 16:30:04','returpembelian','hapusData'),(688,'[{\"idreturdetail\":9,\"idreturpembelian\":\"250424RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":10,\"hargaretur\":\"45000\",\"subtotalretur\":\"450000\"}]','Budiman','2025-04-24 16:30:04','returpembeliandetail','hapusData'),(689,'{\"idreturpembelian\":\"250424RB0000003\",\"idpembelian\":\"250422BL0000002\",\"tglpengajuan\":\"2025-04-24\",\"totalretur\":98000,\"keterangan\":\"Kayu nya rusak\",\"inserted_date\":\"2025-04-24 16:30:37\",\"updated_date\":\"2025-04-24 16:30:37\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\"}','Budiman','2025-04-24 16:30:37','returpembelian','simpanData'),(690,'[{\"idreturpembelian\":\"250424RB0000003\",\"idbarang\":\"K001000001\",\"jumlahretur\":\"7\",\"hargaretur\":\"14000\",\"subtotalretur\":\"98000\"}]','Budiman','2025-04-24 16:30:37','returpembeliandetail','simpanData'),(691,'{\"idreturpembelian\":\"250424RB0000003\",\"tglretur\":\"2025-04-24\",\"updated_date\":\"2025-04-24 16:55:18\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"statusretur\":\"Selesai\"}','Budiman','2025-04-24 16:55:18','returpembelian','updateData'),(692,'[{\"idreturdetail\":11,\"idreturpembelian\":\"250424RB0000003\",\"idbarang\":\"K001000001\",\"jumlahretur\":7,\"hargaretur\":\"14000\",\"subtotalretur\":\"98000\"}]','Budiman','2025-04-24 16:55:18','returpembeliandetail','updateData'),(693,'{\"idreturpenjualan\":\"250425RJ0000001\",\"idpenjualan\":\"250423JL0000001\",\"tglretur\":\"2025-04-24\",\"totalretur\":96000,\"keterangan\":\"Salah Barang\",\"inserted_date\":\"2025-04-24 17:13:16\",\"updated_date\":\"2025-04-24 17:13:16\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-04-24 17:13:16','returpenjualan','simpanData'),(694,'[{\"idreturpenjualan\":\"250425RJ0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"2\",\"hargaretur\":\"48000\",\"subtotalretur\":\"96000\"}]','Budiman','2025-04-24 17:13:16','returpenjualandetail','simpanData'),(695,'{\"idpenjualan\":\"250425JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2504250001\",\"tglinvoice\":\"2025-04-24\",\"keterangan\":\"Penjualan kepada CV.Karya\",\"totalpenjualan\":\"300000\",\"totaldiskon\":\"20000\",\"totalbersih\":\"320000\",\"ppnpersen\":\"11\",\"totalppn\":\"35200\",\"biayapengiriman\":\"10000\",\"totalinvoice\":\"365200\",\"inserted_date\":\"2025-04-24 17:22:39\",\"updated_date\":\"2025-04-24 17:22:39\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSKES0001\",\"nokwitansi\":null}','Budiman','2025-04-24 17:22:39','penjualan','simpanData'),(696,'[{\"idpenjualan\":\"250425JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"20\",\"hargasatuan\":\"15000\",\"jumlahdiskon\":\"1000\",\"subtotaljual\":\"320000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-04-24 17:22:39','penjualandetail','simpanData'),(697,'{\"idreturpenjualan\":\"250425RJ0000002\",\"idpenjualan\":\"250425JL0000001\",\"tglretur\":\"2025-04-24\",\"totalretur\":45000,\"keterangan\":\"Kayu rusak\",\"inserted_date\":\"2025-04-24 17:23:27\",\"updated_date\":\"2025-04-24 17:23:27\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-04-24 17:23:27','returpenjualan','simpanData'),(698,'[{\"idreturpenjualan\":\"250425RJ0000002\",\"idbarang\":\"K001000001\",\"jumlahretur\":\"3\",\"hargaretur\":\"15000\",\"subtotalretur\":\"45000\"}]','Budiman','2025-04-24 17:23:27','returpenjualandetail','simpanData'),(699,'{\"lastlogin\":\"2025-04-25 01:44:33\"}','Budiman','2025-04-25 01:44:33','pengguna','updateData'),(700,'{\"lastlogin\":\"2025-04-25 01:46:09\"}','Budiman','2025-04-25 01:46:09','pengguna','updateData'),(701,'{\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"1234444555566666\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-03-13\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Pemuda\",\"alamattinggal\":\"Jl. Pelangi\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"08135553330000\",\"email\":\"khairuddin@gmail.com\",\"npwp\":\"123213\",\"tglkontrak\":\"2025-03-13\",\"filekontrak\":null,\"updated_date\":\"2025-04-25 01:59:55\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-25 01:59:55','sales','updateData'),(702,'{\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"1234444555566666\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-03-13\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Pemuda\",\"alamattinggal\":\"Jl. Pelangi\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"08135553330000\",\"email\":\"khairuddin@gmail.com\",\"npwp\":\"12321300000\",\"tglkontrak\":\"2025-03-13\",\"filekontrak\":null,\"updated_date\":\"2025-04-25 02:00:14\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-25 02:00:15','sales','updateData'),(703,'{\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"1234444555566666\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-03-13\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Pemuda\",\"alamattinggal\":\"Jl. Pelangi\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"08135553330000\",\"email\":\"khairuddin@gmail.com\",\"npwp\":\"1231231231321233\",\"tglkontrak\":\"2025-03-13\",\"filekontrak\":null,\"updated_date\":\"2025-04-25 02:00:30\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-25 02:00:31','sales','updateData'),(704,'{\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"jeniskelamin\":\"Perempuan\",\"nik\":\"1111111111111111\",\"tempatlahir\":\"Jakarta\",\"tgllahir\":\"2000-12-02\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"081302500000000\",\"email\":\"siti@gmail.com\",\"npwp\":\"4564564564564566\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"mbarang.xls\",\"updated_date\":\"2025-04-25 02:00:42\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-25 02:00:42','sales','updateData'),(705,'{\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"1234444555566666\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-03-13\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Pemuda\",\"alamattinggal\":\"Jl. Pelangi\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"08135553330000\",\"email\":\"khairuddin@gmail.com\",\"npwp\":\"123456789012345\",\"tglkontrak\":\"2025-03-13\",\"filekontrak\":null,\"updated_date\":\"2025-04-25 02:03:56\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-25 02:03:57','sales','updateData'),(706,'{\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"jeniskelamin\":\"Perempuan\",\"nik\":\"1111111111111111\",\"tempatlahir\":\"Jakarta\",\"tgllahir\":\"2000-12-02\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"081302500000000\",\"email\":\"siti@gmail.com\",\"npwp\":\"456456456456456\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"mbarang.xls\",\"updated_date\":\"2025-04-25 02:04:08\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-25 02:04:08','sales','updateData'),(707,'{\"idsupplier\":\"SUPAHQ0001\",\"namasupplier\":\"abc\",\"npwp\":\"121212121212121\",\"alamatsupplier\":\"test\",\"kontakperson\":\"abc\",\"notelp\":\"122132323\",\"email\":\"asdf@gmail.com\",\"inserted_date\":\"2025-04-25 02:12:46\",\"updated_date\":\"2025-04-25 02:12:46\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-25 02:12:46','supplier','simpanData'),(708,'{\"idsupplier\":\"SUPAHQ0001\",\"namasupplier\":\"abc\",\"npwp\":\"222222222222222\",\"alamatsupplier\":\"test\",\"kontakperson\":\"abc\",\"notelp\":\"122132323\",\"email\":\"asdf@gmail.com\",\"updated_date\":\"2025-04-25 02:12:56\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-25 02:12:56','supplier','updateData'),(709,'{\"idsupplier\":\"SUPAHQ0001\",\"namasupplier\":\"abc\",\"alamatsupplier\":\"test\",\"kontakperson\":\"abc\",\"notelp\":\"122132323\",\"email\":\"asdf@gmail.com\",\"saldo\":\"0\",\"saldopajak\":\"0\",\"inserted_date\":\"2025-04-25 02:12:46\",\"updated_date\":\"2025-04-25 02:12:56\",\"statusaktif\":\"Aktif\",\"npwp\":\"222222222222222\"}','Budiman','2025-04-25 02:13:01','supplier','hapusData'),(710,'{\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"npwp\":\"154865223157545\",\"alamatsupplier\":\"Jl. Kebangkitan\",\"kontakperson\":\"Rudi\",\"notelp\":\"081200000000000\",\"email\":\"rudi@gmail.com\",\"updated_date\":\"2025-04-25 02:13:12\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-25 02:13:12','supplier','updateData'),(711,'{\"idsupplier\":\"SUPIMN0001\",\"namasupplier\":\"PT. Intra Makmur\",\"npwp\":\"545215789625452\",\"alamatsupplier\":\"Jl. Pemuda\",\"kontakperson\":\"Bambang\",\"notelp\":\"081300000\",\"email\":\"bambang@gmail.com\",\"updated_date\":\"2025-04-25 02:13:21\",\"statusaktif\":\"Aktif\"}','Budiman','2025-04-25 02:13:21','supplier','updateData'),(712,'{\"idhutangdetail\":\"250422HU0001002\",\"idhutang\":\"250422HU0001\",\"tglhutang\":\"2025-04-24\",\"debet\":\"454560\",\"kredit\":\"0\",\"inserted_date\":\"2025-04-24 02:34:11\",\"updated_date\":\"2025-04-24 02:34:11\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250422BL0000004\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-04-25 02:26:01','hutangdetail','hapusData'),(713,'{\"idpiutangdetail\":\"250425PI0001002\",\"idpiutang\":\"250425PI0001\",\"tglpiutang\":\"2025-04-25\",\"debet\":0,\"kredit\":\"365200\",\"inserted_date\":\"2025-04-25 03:24:06\",\"updated_date\":\"2025-04-25 03:24:06\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250425JL0000001#01\"}','Budiman','2025-04-25 03:24:06','piutangdetail','simpanData'),(714,'{\"idpiutangdetail\":\"250425PI0001002\",\"idpiutang\":\"250425PI0001\",\"tglpiutang\":\"2025-04-25\",\"debet\":\"0\",\"kredit\":\"365200\",\"inserted_date\":\"2025-04-25 03:24:06\",\"updated_date\":\"2025-04-25 03:24:06\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250425JL0000001\",\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"nokwitansi\":\"250425JL0000001#01\"}','Budiman','2025-04-25 03:32:24','piutangdetail','hapusData'),(715,'{\"idpiutangdetail\":\"250425PI0001002\",\"idpiutang\":\"250425PI0001\",\"tglpiutang\":\"2025-04-25\",\"debet\":0,\"kredit\":\"365200\",\"inserted_date\":\"2025-04-25 03:32:30\",\"updated_date\":\"2025-04-25 03:32:30\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250425JL0000001#01\"}','Budiman','2025-04-25 03:32:30','piutangdetail','simpanData'),(716,'{\"idjurnal\":\"250425JP0000001\",\"tgljurnal\":\"2025-04-25\",\"keterangan\":\"Setor Tunai\",\"totaldebet\":\"10000000\",\"totalkredit\":\"10000000\",\"inserted_date\":\"2025-04-25 03:42:33\",\"updated_date\":\"2025-04-25 03:42:33\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Jurnal Penyesuaian\"}','Budiman','2025-04-25 03:42:33','jurnal','simpanData'),(717,'[{\"idjurnal\":\"250425JP0000001\",\"kdakun\":\"1.1.01.01\",\"debet\":\"10000000\",\"kredit\":\"0\"},{\"idjurnal\":\"250425JP0000001\",\"kdakun\":\"1.1.01.03\",\"debet\":\"0\",\"kredit\":\"10000000\"}]','Budiman','2025-04-25 03:42:33','jurnaldetail','simpanData'),(719,'{\"lastlogin\":\"2025-04-25 06:09:45\"}','Budiman','2025-04-25 06:09:45','pengguna','updateData'),(720,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 06:12:14\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 06:12:14','postingjurnal','simpanData'),(721,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 06:12:19\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 06:12:19','postingjurnal','simpanData'),(722,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 06:16:13\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 06:16:13','postingjurnal','simpanData'),(723,'{\"idposting\":\"022025\",\"bulan\":\"02\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 06:16:26\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 06:16:26','postingjurnal','simpanData'),(724,'{\"prefix\":\"akun_pendapatan_penjualan\",\"values\":\"4.1.01.01\",\"inserted_date\":\"2025-04-25 06:24:36\",\"updated_date\":\"2025-04-25 06:24:36\",\"deskripsi\":\"Akun pedapatan penjualan\"}','Budiman','2025-04-25 06:24:36','settings','simpanData'),(725,'{\"lastlogin\":\"2025-04-25 06:24:59\"}','Budiman','2025-04-25 06:24:59','pengguna','updateData'),(726,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"7835872\",\"jumlahkredit\":\"7835872\",\"inserted_date\":\"2025-04-25 06:16:13\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-25 06:25:09','sales','hapusData'),(727,'{\"kdakun\":\"2.2.01\",\"namaakun\":\"Utang Jangka Pendek\",\"kdparent\":\"2.2\",\"inserted_date\":\"2025-04-25 06:32:42\",\"updated_date\":\"2025-04-25 06:32:42\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-04-25 06:32:43','akun','simpanData'),(728,'{\"kdakun\":\"2.2.01.01\",\"namaakun\":\"Utang Usaha (Supplier)\",\"kdparent\":\"2.2.01\",\"inserted_date\":\"2025-04-25 06:33:34\",\"updated_date\":\"2025-04-25 06:33:34\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-04-25 06:33:34','akun','simpanData'),(729,'{\"kdakun\":\"2.2.01.02\",\"namaakun\":\"Utang Pajak (PPN Keluaran, PPh Pasal 23)\",\"kdparent\":\"2.2.01\",\"inserted_date\":\"2025-04-25 06:34:03\",\"updated_date\":\"2025-04-25 06:34:03\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-04-25 06:34:03','akun','simpanData'),(730,'{\"kdakun\":\"2.2.01.03\",\"namaakun\":\"Utang Gaji\",\"kdparent\":\"2.2.01\",\"inserted_date\":\"2025-04-25 06:34:23\",\"updated_date\":\"2025-04-25 06:34:23\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-04-25 06:34:23','akun','simpanData'),(731,'{\"prefix\":\"akun_utang_ppn\",\"values\":\"2.2.01.02\",\"inserted_date\":\"2025-04-25 06:35:13\",\"updated_date\":\"2025-04-25 06:35:13\",\"deskripsi\":\"Akun untuk pengeluaran ppn\"}','Budiman','2025-04-25 06:35:13','settings','simpanData'),(732,'{\"lastlogin\":\"2025-04-25 06:35:43\"}','Budiman','2025-04-25 06:35:43','pengguna','updateData'),(733,'{\"kdakun\":\"5.4\",\"namaakun\":\"Beban Operasional\",\"kdparent\":\"5\",\"inserted_date\":\"2025-04-25 06:43:55\",\"updated_date\":\"2025-04-25 06:43:55\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Budiman','2025-04-25 06:43:55','akun','simpanData'),(734,'{\"kdakun\":\"5.4.01\",\"namaakun\":\"Beban Penjualan\",\"kdparent\":\"5.4\",\"inserted_date\":\"2025-04-25 06:44:30\",\"updated_date\":\"2025-04-25 06:44:30\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-04-25 06:44:30','akun','simpanData'),(735,'{\"kdakun\":\"5.4.01.01\",\"namaakun\":\"Beban Transportasi\",\"kdparent\":\"5.4.01\",\"inserted_date\":\"2025-04-25 06:45:25\",\"updated_date\":\"2025-04-25 06:45:25\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-04-25 06:45:25','akun','simpanData'),(736,'{\"kdakun\":\"5.4.01.02\",\"namaakun\":\"Beban Iklan\",\"kdparent\":\"5.4.01\",\"inserted_date\":\"2025-04-25 06:45:39\",\"updated_date\":\"2025-04-25 06:45:39\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-04-25 06:45:39','akun','simpanData'),(737,'{\"prefix\":\"beban_transportasi\",\"values\":\"5.4.01.01\",\"inserted_date\":\"2025-04-25 06:50:27\",\"updated_date\":\"2025-04-25 06:50:27\",\"deskripsi\":\"Beban Operasional Transportasi\"}','Budiman','2025-04-25 06:50:27','settings','simpanData'),(738,'{\"lastlogin\":\"2025-04-25 06:51:04\"}','Budiman','2025-04-25 06:51:04','pengguna','updateData'),(739,'{\"prefix\":\"beban_transportasi\",\"values\":\"5.4.01.01\",\"deskripsi\":\"Beban Operasional Transportasi\",\"inserted_date\":\"2025-04-25 06:50:27\",\"updated_date\":\"2025-04-25 06:50:27\",\"issystem\":1}','Budiman','2025-04-25 06:52:01','settings','hapusData'),(740,'{\"prefix\":\"akun_beban_transportasi\",\"values\":\"5.4.01.01\",\"inserted_date\":\"2025-04-25 06:52:28\",\"updated_date\":\"2025-04-25 06:52:28\",\"deskripsi\":\"Akun beban operasional transportasi\"}','Budiman','2025-04-25 06:52:28','settings','simpanData'),(741,'{\"lastlogin\":\"2025-04-25 06:52:38\"}','Budiman','2025-04-25 06:52:38','pengguna','updateData'),(742,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 06:55:07\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 06:55:07','postingjurnal','simpanData'),(743,'{\"kdakun\":\"2.2.01.02\",\"namaakun\":\"Utang Pajak (PPN Keluaran)\",\"updated_date\":\"2025-04-25 06:56:37\"}','Budiman','2025-04-25 06:56:38','akun','updateData'),(744,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"7835872\",\"jumlahkredit\":\"7835872\",\"inserted_date\":\"2025-04-25 06:55:07\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-25 07:03:31','sales','hapusData'),(745,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 07:03:35\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 07:03:35','postingjurnal','simpanData'),(746,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"8201072\",\"jumlahkredit\":\"8201072\",\"inserted_date\":\"2025-04-25 07:03:35\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-25 07:06:58','sales','hapusData'),(747,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 07:07:02\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 07:07:02','postingjurnal','simpanData'),(748,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"8201072\",\"jumlahkredit\":\"8201072\",\"inserted_date\":\"2025-04-25 07:07:02\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-25 07:13:14','sales','hapusData'),(750,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 07:13:36\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 07:13:36','postingjurnal','simpanData'),(751,'{\"kdakun\":\"6\",\"namaakun\":\"Pembelian\",\"inserted_date\":\"2025-04-25 07:35:01\",\"updated_date\":\"2025-04-25 07:35:01\",\"statusaktif\":\"Aktif\",\"levels\":\"1\"}','Budiman','2025-04-25 07:35:01','akun','simpanData'),(752,'{\"kdakun\":\"6.1\",\"namaakun\":\"Pembelian\",\"kdparent\":\"6\",\"inserted_date\":\"2025-04-25 07:35:17\",\"updated_date\":\"2025-04-25 07:35:17\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Budiman','2025-04-25 07:35:17','akun','simpanData'),(753,'{\"kdakun\":\"6.1.01\",\"namaakun\":\"Pembelian\",\"kdparent\":\"6.1\",\"inserted_date\":\"2025-04-25 07:35:38\",\"updated_date\":\"2025-04-25 07:35:38\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-04-25 07:35:38','akun','simpanData'),(754,'{\"kdakun\":\"6.1.01.01\",\"namaakun\":\"Pembelian\",\"kdparent\":\"6.1.01\",\"inserted_date\":\"2025-04-25 07:35:50\",\"updated_date\":\"2025-04-25 07:35:50\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-04-25 07:35:50','akun','simpanData'),(755,'{\"prefix\":\"akun_pembelian\",\"values\":\"6.1.01.01\",\"inserted_date\":\"2025-04-25 07:36:18\",\"updated_date\":\"2025-04-25 07:36:18\",\"deskripsi\":\"Akun Pembelian\"}','Budiman','2025-04-25 07:36:18','settings','simpanData'),(756,'{\"lastlogin\":\"2025-04-25 07:37:29\"}','Budiman','2025-04-25 07:37:29','pengguna','updateData'),(757,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"8342072\",\"jumlahkredit\":\"8342072\",\"inserted_date\":\"2025-04-25 07:13:36\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-25 07:38:13','sales','hapusData'),(759,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 07:40:26\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 07:40:26','postingjurnal','simpanData'),(760,'{\"lastlogin\":\"2025-04-25 13:26:41\"}','Budiman','2025-04-25 13:26:41','pengguna','updateData'),(761,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"10519074\",\"jumlahkredit\":\"10519074\",\"inserted_date\":\"2025-04-25 07:40:26\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-25 13:27:50','sales','hapusData'),(762,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 13:27:58\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 13:27:58','postingjurnal','simpanData'),(763,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"10519074\",\"jumlahkredit\":\"10519074\",\"inserted_date\":\"2025-04-25 13:27:58\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-25 13:32:05','sales','hapusData'),(766,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 13:34:36\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 13:34:36','postingjurnal','simpanData'),(767,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"10617074\",\"jumlahkredit\":\"10617074\",\"inserted_date\":\"2025-04-25 13:34:36\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-25 13:36:51','sales','hapusData'),(768,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 13:36:55\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 13:36:55','postingjurnal','simpanData'),(769,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"10617074\",\"jumlahkredit\":\"10617074\",\"inserted_date\":\"2025-04-25 13:36:55\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-25 13:46:53','sales','hapusData'),(770,'{\"idhutangdetail\":\"250422HU0001002\",\"idhutang\":\"250422HU0001\",\"tglhutang\":\"2025-04-25\",\"debet\":\"200000\",\"kredit\":0,\"inserted_date\":\"2025-04-25 13:47:13\",\"updated_date\":\"2025-04-25 13:47:13\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-04-25 13:47:13','hutangdetail','simpanData'),(771,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 13:47:25\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 13:47:25','postingjurnal','simpanData'),(772,'{\"kdakun\":\"3.1\",\"namaakun\":\"Modal\",\"kdparent\":\"3\",\"inserted_date\":\"2025-04-25 14:38:46\",\"updated_date\":\"2025-04-25 14:38:46\",\"statusaktif\":\"Aktif\",\"levels\":\"2\"}','Budiman','2025-04-25 14:38:46','akun','simpanData'),(773,'{\"kdakun\":\"3.1.01\",\"namaakun\":\"Modal\",\"kdparent\":\"3.1\",\"inserted_date\":\"2025-04-25 14:39:00\",\"updated_date\":\"2025-04-25 14:39:00\",\"statusaktif\":\"Aktif\",\"levels\":\"3\"}','Budiman','2025-04-25 14:39:00','akun','simpanData'),(774,'{\"kdakun\":\"3.1.01.01\",\"namaakun\":\"Modal Pemilik\",\"kdparent\":\"3.1.01\",\"inserted_date\":\"2025-04-25 14:40:00\",\"updated_date\":\"2025-04-25 14:40:00\",\"statusaktif\":\"Aktif\",\"levels\":\"4\"}','Budiman','2025-04-25 14:40:00','akun','simpanData'),(775,'{\"idsaldoawal\":\"2025\",\"tahun\":\"2025\",\"totaldebet\":\"1000\",\"totalkredit\":\"1000\",\"inserted_date\":\"2025-04-25 14:45:12\",\"updated_date\":\"2025-04-25 14:45:12\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 14:45:12','saldoawal','simpanData'),(776,'[{\"idsaldoawal\":\"2025\",\"kdakun\":\"1.1.01.01\",\"debet\":\"1000\",\"kredit\":\"0\"},{\"idsaldoawal\":\"2025\",\"kdakun\":\"3.1.01.01\",\"debet\":\"0\",\"kredit\":\"1000\"}]','Budiman','2025-04-25 14:45:12','saldoawaldetail','simpanData'),(777,'{\"idsaldoawal\":\"2025\",\"tahun\":\"2025\",\"totaldebet\":\"100000000\",\"totalkredit\":\"100000000\",\"inserted_date\":\"2025-04-25 14:59:34\",\"updated_date\":\"2025-04-25 14:59:34\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 14:59:34','saldoawal','updateData'),(778,'[{\"idsaldoawal\":\"2025\",\"kdakun\":\"1.1.01.01\",\"debet\":\"100000000\",\"kredit\":\"0\"},{\"idsaldoawal\":\"2025\",\"kdakun\":\"2.1.01.01\",\"debet\":\"0\",\"kredit\":\"10000000\"},{\"idsaldoawal\":\"2025\",\"kdakun\":\"3.1.01.01\",\"debet\":\"0\",\"kredit\":\"90000000\"}]','Budiman','2025-04-25 14:59:34','saldoawaldetail','updateData'),(779,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"10817074\",\"jumlahkredit\":\"10817074\",\"inserted_date\":\"2025-04-25 13:47:25\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-25 15:02:03','sales','hapusData'),(780,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-25 15:02:14\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 15:02:14','postingjurnal','simpanData'),(781,'{\"idsuratjalan\":\"250426SJ01\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"totaltagihan\":\"7835872\",\"inserted_date\":\"2025-04-25 17:40:04\",\"updated_date\":\"2025-04-25 17:40:04\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 17:40:04','suratjalan','simpanData'),(782,'[{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250423JL0000001\"},{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250425JL0000001\"}]','Budiman','2025-04-25 17:40:04','suratjalandetail','simpanData'),(783,'{\"idsuratjalan\":\"250426SJ01\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"totaltagihan\":\"7835872\",\"inserted_date\":\"2025-04-25 17:41:48\",\"updated_date\":\"2025-04-25 17:41:48\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 17:41:48','suratjalan','simpanData'),(784,'[{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250423JL0000001\"},{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250425JL0000001\"}]','Budiman','2025-04-25 17:41:48','suratjalandetail','simpanData'),(785,'{\"idsuratjalan\":\"250426SJ02\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"totaltagihan\":\"7470672\",\"inserted_date\":\"2025-04-25 18:26:57\",\"updated_date\":\"2025-04-25 18:26:57\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 18:26:57','suratjalan','simpanData'),(786,'[{\"idsuratjalan\":\"250426SJ02\",\"idpenjualan\":\"250423JL0000001\"}]','Budiman','2025-04-25 18:26:57','suratjalandetail','simpanData'),(787,'{\"idsuratjalan\":\"250426SJ01\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"tglcetak\":null,\"keterangan\":null,\"inserted_date\":\"2025-04-25 17:41:48\",\"updated_date\":\"2025-04-25 17:41:48\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Khairuddin\",\"npwp\":\"123456789012345\",\"namapengguna\":\"Budiman\",\"totaltagihan\":\"7835872\"}','Budiman','2025-04-25 18:32:08','suratjalan','hapusData'),(788,'[{\"iddetailsuratjalan\":3,\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250423JL0000001\"},{\"iddetailsuratjalan\":4,\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250425JL0000001\"}]','Budiman','2025-04-25 18:32:08','suratjalandetail','hapusData'),(789,'{\"idsuratjalan\":\"250426SJ02\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"tglcetak\":null,\"keterangan\":null,\"inserted_date\":\"2025-04-25 18:26:57\",\"updated_date\":\"2025-04-25 18:26:57\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Khairuddin\",\"npwp\":\"123456789012345\",\"namapengguna\":\"Budiman\",\"totaltagihan\":\"7470672\"}','Budiman','2025-04-25 18:32:13','suratjalan','hapusData'),(790,'[{\"iddetailsuratjalan\":5,\"idsuratjalan\":\"250426SJ02\",\"idpenjualan\":\"250423JL0000001\"}]','Budiman','2025-04-25 18:32:13','suratjalandetail','hapusData'),(791,'{\"idsuratjalan\":\"250426SJ01\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"totaltagihan\":\"7835872\",\"inserted_date\":\"2025-04-25 18:32:30\",\"updated_date\":\"2025-04-25 18:32:30\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 18:32:30','suratjalan','simpanData'),(792,'[{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250423JL0000001\"},{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250425JL0000001\"}]','Budiman','2025-04-25 18:32:30','suratjalandetail','simpanData'),(793,'{\"idsuratjalan\":\"250426SJ02\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"totaltagihan\":\"7470672\",\"inserted_date\":\"2025-04-25 18:32:42\",\"updated_date\":\"2025-04-25 18:32:42\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 18:32:42','suratjalan','simpanData'),(794,'[{\"idsuratjalan\":\"250426SJ02\",\"idpenjualan\":\"250423JL0000001\"}]','Budiman','2025-04-25 18:32:42','suratjalandetail','simpanData'),(795,'{\"idsuratjalan\":\"250426SJ02\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"tglcetak\":null,\"keterangan\":null,\"inserted_date\":\"2025-04-25 18:32:42\",\"updated_date\":\"2025-04-25 18:32:42\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Khairuddin\",\"npwp\":\"123456789012345\",\"namapengguna\":\"Budiman\",\"totaltagihan\":\"7470672\"}','Budiman','2025-04-25 18:33:02','suratjalan','hapusData'),(796,'[{\"iddetailsuratjalan\":8,\"idsuratjalan\":\"250426SJ02\",\"idpenjualan\":\"250423JL0000001\"}]','Budiman','2025-04-25 18:33:02','suratjalandetail','hapusData'),(797,'{\"idsuratjalan\":\"250426SJ01\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"totaltagihan\":\"7470672\",\"updated_date\":\"2025-04-25 18:36:45\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 18:36:45','suratjalan','updateData'),(798,'[{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250423JL0000001\"}]','Budiman','2025-04-25 18:36:45','suratjalandetail','updateData'),(799,'{\"idsuratjalan\":\"250426SJ01\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"totaltagihan\":\"7835872\",\"updated_date\":\"2025-04-25 18:37:00\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 18:37:00','suratjalan','updateData'),(800,'[{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250423JL0000001\"},{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250425JL0000001\"}]','Budiman','2025-04-25 18:37:00','suratjalandetail','updateData'),(801,'{\"idsuratjalan\":\"250426SJ01\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"totaltagihan\":\"7470672\",\"updated_date\":\"2025-04-25 18:39:20\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 18:39:20','suratjalan','updateData'),(802,'[{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250423JL0000001\"}]','Budiman','2025-04-25 18:39:20','suratjalandetail','updateData'),(803,'{\"idsuratjalan\":\"250426SJ02\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"totaltagihan\":\"365200\",\"inserted_date\":\"2025-04-25 18:50:52\",\"updated_date\":\"2025-04-25 18:50:52\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 18:50:52','suratjalan','simpanData'),(804,'[{\"idsuratjalan\":\"250426SJ02\",\"idpenjualan\":\"250425JL0000001\"}]','Budiman','2025-04-25 18:50:52','suratjalandetail','simpanData'),(805,'{\"idsuratjalan\":\"250426SJ02\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"tglcetak\":null,\"keterangan\":null,\"inserted_date\":\"2025-04-25 18:50:52\",\"updated_date\":\"2025-04-25 18:50:52\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Khairuddin\",\"npwp\":\"123456789012345\",\"namapengguna\":\"Budiman\",\"totaltagihan\":\"365200\"}','Budiman','2025-04-25 18:51:13','suratjalan','hapusData'),(806,'[{\"iddetailsuratjalan\":13,\"idsuratjalan\":\"250426SJ02\",\"idpenjualan\":\"250425JL0000001\"}]','Budiman','2025-04-25 18:51:13','suratjalandetail','hapusData'),(807,'{\"idsuratjalan\":\"250426SJ01\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"totaltagihan\":\"7835872\",\"updated_date\":\"2025-04-25 18:51:26\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 18:51:26','suratjalan','updateData'),(808,'[{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250423JL0000001\"},{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250425JL0000001\"}]','Budiman','2025-04-25 18:51:26','suratjalandetail','updateData'),(809,'{\"idsuratjalan\":\"250426SJ01\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"totaltagihan\":\"7470672\",\"updated_date\":\"2025-04-25 18:51:36\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 18:51:36','suratjalan','updateData'),(810,'[{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250423JL0000001\"}]','Budiman','2025-04-25 18:51:36','suratjalandetail','updateData'),(811,'{\"idsuratjalan\":\"250426SJ01\",\"tglsuratjalan\":\"2025-04-25\",\"totaltagihan\":\"7835872\",\"updated_date\":\"2025-04-25 18:53:00\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-25 18:53:00','suratjalan','updateData'),(812,'[{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250423JL0000001\"},{\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250425JL0000001\"}]','Budiman','2025-04-25 18:53:00','suratjalandetail','updateData'),(813,'{\"lastlogin\":\"2025-04-29 00:36:32\"}','Budiman','2025-04-29 00:36:32','pengguna','updateData'),(814,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"10817074\",\"jumlahkredit\":\"10817074\",\"inserted_date\":\"2025-04-25 15:02:14\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-04-29 00:41:45','sales','hapusData'),(815,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-04-29 00:41:50\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-04-29 00:41:50','postingjurnal','simpanData'),(816,'{\"lastlogin\":\"2025-05-01 05:18:44\"}','Budiman','2025-05-01 05:18:44','pengguna','updateData'),(817,'{\"idhutang\":\"250501HU0001\",\"tglhutang\":\"2025-05-01\",\"idsupplier\":\"SUPIMN0001\",\"totaldebet\":0,\"totalkredit\":\"23232\",\"jenissumber\":\"Non Pembelian\"}','Budiman','2025-05-01 05:33:44','hutang','simpanData'),(818,'{\"idhutangdetail\":\"250501HU0001001\",\"idhutang\":\"250501HU0001\",\"tglhutang\":\"2025-05-01\",\"debet\":0,\"kredit\":\"23232\",\"inserted_date\":\"2025-05-01 05:33:44\",\"updated_date\":\"2025-05-01 05:33:44\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Hutang\"}','Budiman','2025-05-01 05:33:44','hutangdetail','simpanData'),(819,'{\"idpembelian\":\"250501BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"22800\\/2025\",\"tglfaktur\":\"2025-05-01\",\"tglditerima\":\"2025-05-01\",\"keterangan\":\"Pembelian Bahan Kayu\",\"totalpembelian\":\"9000000\",\"totaldiskon\":\"400000\",\"totalbersih\":\"8600000\",\"ppnpersen\":\"11\",\"totalppn\":\"946000\",\"biayapengiriman\":\"100000\",\"totalfaktur\":\"9646000\",\"inserted_date\":\"2025-05-01 06:30:03\",\"updated_date\":\"2025-05-01 06:30:03\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-05-01 06:30:03','pembelian','simpanData'),(820,'[{\"idpembelian\":\"250501BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"200\",\"hargasatuan\":\"45000\",\"jumlahdiskon\":\"2000\",\"subtotalbeli\":\"8600000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-01 06:30:03','pembeliandetail','simpanData'),(821,'{\"idpembelian\":\"250501BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"22800\\/2025\",\"tglfaktur\":\"2025-05-01\",\"tglditerima\":\"2025-05-01\",\"keterangan\":\"Pembelian Bahan Kayu\",\"inserted_date\":\"2025-05-01 06:30:03\",\"updated_date\":\"2025-05-01 06:30:03\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"9000000\",\"totaldiskon\":\"400000\",\"totalbersih\":\"8600000\",\"ppnpersen\":11,\"totalppn\":\"946000\",\"biayapengiriman\":\"100000\",\"totalfaktur\":\"9646000\"}','Budiman','2025-05-01 06:31:54','pembelian','hapusData'),(822,'[{\"id\":53,\"idpembelian\":\"250501BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":200,\"hargasatuan\":\"45000\",\"jumlahdiskon\":\"2000\",\"subtotalbeli\":\"8600000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-01 06:31:54','pembeliandetail','hapusData'),(823,'{\"idpembelian\":\"250501BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"289099\\/2025\",\"tglfaktur\":\"2025-05-01\",\"tglditerima\":\"2025-05-01\",\"keterangan\":\"Pembelian bahan bangunan kayu\",\"totalpembelian\":\"9000000\",\"totaldiskon\":\"400000\",\"totalbersih\":\"8600000\",\"ppnpersen\":\"11\",\"totalppn\":\"946000\",\"biayapengiriman\":0,\"totalfaktur\":\"9546000\",\"inserted_date\":\"2025-05-01 06:32:32\",\"updated_date\":\"2025-05-01 06:32:32\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null}','Budiman','2025-05-01 06:32:32','pembelian','simpanData'),(824,'[{\"idpembelian\":\"250501BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"200\",\"hargasatuan\":\"45000\",\"jumlahdiskon\":\"2000\",\"subtotalbeli\":\"8600000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-01 06:32:32','pembeliandetail','simpanData'),(825,'{\"idhutang\":\"250501HU0001\",\"idpembelian\":null,\"tglhutang\":\"2025-05-01\",\"idsupplier\":\"SUPIMN0001\",\"totaldebet\":\"0\",\"totalkredit\":\"23232\",\"jenissumber\":\"Non Pembelian\",\"keterangan\":null,\"namasupplier\":\"PT. Intra Makmur\",\"nofaktur\":null,\"tglfaktur\":null,\"statuslunas\":\"Belum Lunas\"}','Budiman','2025-05-01 06:46:23','hutang','hapusData'),(826,'[{\"idhutangdetail\":\"250501HU0001001\",\"idhutang\":\"250501HU0001\",\"tglhutang\":\"2025-05-01\",\"debet\":\"0\",\"kredit\":\"23232\",\"inserted_date\":\"2025-05-01 05:33:44\",\"updated_date\":\"2025-05-01 05:33:44\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"jenis\":\"Hutang\"}]','Budiman','2025-05-01 06:46:23','hutangdetail','hapusData'),(827,'{\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"idsupplier\":\"SUPIMN0001\",\"totaldebet\":0,\"totalkredit\":\"20000000\",\"jenissumber\":\"Non Pembelian\",\"keterangan\":\"Saldo awal hutang PT Intra Makmur\"}','Budiman','2025-05-01 06:51:56','hutang','simpanData'),(828,'{\"idhutangdetail\":\"250501HU0003001\",\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"debet\":0,\"kredit\":\"20000000\",\"inserted_date\":\"2025-05-01 06:51:56\",\"updated_date\":\"2025-05-01 06:51:56\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Hutang\"}','Budiman','2025-05-01 06:51:56','hutangdetail','simpanData'),(829,'{\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"idsupplier\":\"SUPIMN0001\",\"totaldebet\":0,\"totalkredit\":\"20000000\",\"jenissumber\":\"Non Pembelian\",\"keterangan\":\"Saldo awal hutang PT Intra Makmur\"}','Budiman','2025-05-01 07:03:09','hutang','updateData'),(830,'{\"idhutangdetail\":\"250501HU0003002\",\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"debet\":0,\"kredit\":\"20000000\",\"inserted_date\":\"2025-05-01 07:03:09\",\"updated_date\":\"2025-05-01 07:03:09\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Hutang\"}','Budiman','2025-05-01 07:03:09','hutangdetail','updateData'),(831,'{\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"idsupplier\":\"SUPIMN0001\",\"totaldebet\":0,\"totalkredit\":\"20000000\",\"jenissumber\":\"Non Pembelian\",\"keterangan\":\"Saldo awal hutang PT Intra Makmur1\"}','Budiman','2025-05-01 07:03:20','hutang','updateData'),(832,'{\"idhutangdetail\":\"250501HU0003003\",\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"debet\":0,\"kredit\":\"20000000\",\"inserted_date\":\"2025-05-01 07:03:20\",\"updated_date\":\"2025-05-01 07:03:20\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Hutang\"}','Budiman','2025-05-01 07:03:20','hutangdetail','updateData'),(833,'{\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"idsupplier\":\"SUPIMN0001\",\"totaldebet\":0,\"totalkredit\":\"21000000\",\"jenissumber\":\"Non Pembelian\",\"keterangan\":\"Saldo awal hutang PT Intra Makmur1\"}','Budiman','2025-05-01 07:35:20','hutang','updateData'),(834,'{\"idhutangdetail\":\"250501HU0003004\",\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"debet\":0,\"kredit\":\"21000000\",\"inserted_date\":\"2025-05-01 07:35:19\",\"updated_date\":\"2025-05-01 07:35:19\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Hutang\"}','Budiman','2025-05-01 07:35:20','hutangdetail','updateData'),(835,'{\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"idsupplier\":\"SUPIMN0001\",\"totaldebet\":0,\"totalkredit\":\"21000000\",\"jenissumber\":\"Non Pembelian\",\"keterangan\":\"Saldo awal hutang PT Intra Makmur\"}','Budiman','2025-05-01 07:35:54','hutang','updateData'),(836,'{\"idhutangdetail\":\"250501HU0003005\",\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"debet\":0,\"kredit\":\"21000000\",\"inserted_date\":\"2025-05-01 07:35:54\",\"updated_date\":\"2025-05-01 07:35:54\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Hutang\"}','Budiman','2025-05-01 07:35:54','hutangdetail','updateData'),(837,'{\"idhutangdetail\":\"250501HU0002002\",\"idhutang\":\"250501HU0002\",\"tglhutang\":\"2025-05-01\",\"debet\":\"5000000\",\"kredit\":0,\"inserted_date\":\"2025-05-01 08:16:12\",\"updated_date\":\"2025-05-01 08:16:12\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-05-01 08:16:12','hutangdetail','simpanData'),(838,'{\"idhutangdetail\":\"250501HU0002003\",\"idhutang\":\"250501HU0002\",\"tglhutang\":\"2025-05-01\",\"debet\":\"4546000\",\"kredit\":0,\"inserted_date\":\"2025-05-01 08:16:53\",\"updated_date\":\"2025-05-01 08:16:53\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-05-01 08:16:53','hutangdetail','simpanData'),(839,'{\"idhutangdetail\":\"250501HU0003006\",\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"debet\":\"10000000\",\"kredit\":0,\"inserted_date\":\"2025-05-01 08:22:00\",\"updated_date\":\"2025-05-01 08:22:00\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-05-01 08:22:00','hutangdetail','simpanData'),(840,'{\"idhutangdetail\":\"250501HU0003007\",\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"debet\":\"11000000\",\"kredit\":0,\"inserted_date\":\"2025-05-01 08:22:45\",\"updated_date\":\"2025-05-01 08:22:45\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-05-01 08:22:45','hutangdetail','simpanData'),(841,'{\"idhutangdetail\":\"250501HU0002003\",\"idhutang\":\"250501HU0002\",\"tglhutang\":\"2025-05-01\",\"debet\":\"4546000\",\"kredit\":\"0\",\"inserted_date\":\"2025-05-01 08:16:53\",\"updated_date\":\"2025-05-01 08:16:53\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250501BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-01 08:24:31','hutangdetail','hapusDetail'),(842,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"10817074\",\"jumlahkredit\":\"10817074\",\"inserted_date\":\"2025-04-29 00:41:50\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-01 08:36:43','sales','hapusData'),(843,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-05-01 09:08:12\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-01 09:08:12','postingjurnal','simpanData'),(845,'{\"idposting\":\"052025\",\"bulan\":\"05\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-05-01 09:09:48\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-01 09:09:48','postingjurnal','simpanData'),(846,'{\"idposting\":\"052025\",\"bulan\":\"05\",\"tahun\":\"2025\",\"jumlahdebet\":\"56546000\",\"jumlahkredit\":\"56546000\",\"inserted_date\":\"2025-05-01 09:09:48\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-01 09:11:13','sales','hapusData'),(847,'{\"idposting\":\"052025\",\"bulan\":\"05\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-05-01 09:11:18\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-01 09:11:18','postingjurnal','simpanData'),(848,'{\"lastlogin\":\"2025-05-01 13:33:18\"}','Budiman','2025-05-01 13:33:18','pengguna','updateData'),(849,'{\"lastlogin\":\"2025-05-02 03:08:12\"}','Budiman','2025-05-02 03:08:12','pengguna','updateData'),(850,'{\"idposting\":\"052025\",\"bulan\":\"05\",\"tahun\":\"2025\",\"jumlahdebet\":\"56546000\",\"jumlahkredit\":\"56546000\",\"inserted_date\":\"2025-05-01 09:11:18\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-02 03:11:45','sales','hapusData'),(851,'{\"idpiutang\":\"250502PI0001\",\"idjenispiutang\":\"P02\",\"tglpiutang\":\"2025-05-02\",\"tgljatuhtempo\":\"2025-06-01\",\"idkonsumen\":\"KUE001\",\"keterangan\":\"Penjualan dengan nomor. 123\",\"totaldebet\":\"25000000\",\"totalkredit\":0,\"jenissumber\":\"Non Penjualan\"}','Budiman','2025-05-02 03:15:36','piutang','simpanTambahPiutang'),(852,'{\"idpiutangdetail\":\"250502PI0001001\",\"idpiutang\":\"250502PI0001\",\"tglpiutang\":\"2025-05-02\",\"debet\":\"25000000\",\"kredit\":0,\"inserted_date\":\"2025-05-02 03:15:36\",\"updated_date\":\"2025-05-02 03:15:36\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Piutang\"}','Budiman','2025-05-02 03:15:36','piutangdetail','simpanTambahPiutang'),(853,'{\"idpiutang\":\"250502PI0002\",\"idjenispiutang\":\"P02\",\"tglpiutang\":\"2025-05-02\",\"tgljatuhtempo\":\"2025-06-01\",\"idkonsumen\":\"KUE001\",\"keterangan\":\"test\",\"totaldebet\":\"25000000\",\"totalkredit\":0,\"jenissumber\":\"Non Penjualan\"}','Budiman','2025-05-02 03:16:21','piutang','simpanTambahPiutang'),(854,'{\"idpiutangdetail\":\"250502PI0002001\",\"idpiutang\":\"250502PI0002\",\"tglpiutang\":\"2025-05-02\",\"debet\":\"25000000\",\"kredit\":0,\"inserted_date\":\"2025-05-02 03:16:21\",\"updated_date\":\"2025-05-02 03:16:21\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Piutang\"}','Budiman','2025-05-02 03:16:21','piutangdetail','simpanTambahPiutang'),(855,'{\"idpenjualan\":\"250502JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"2505020001\",\"tglinvoice\":\"2025-05-02\",\"keterangan\":\"Penjualan kayu\",\"totalpenjualan\":\"240000\",\"totaldiskon\":\"2500\",\"totalbersih\":\"242500\",\"ppnpersen\":\"11\",\"totalppn\":\"26675\",\"biayapengiriman\":\"25000\",\"totalinvoice\":\"294175\",\"inserted_date\":\"2025-05-02 03:34:37\",\"updated_date\":\"2025-05-02 03:34:37\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSKES0001\",\"nokwitansi\":null}','Budiman','2025-05-02 03:34:37','penjualan','simpanData'),(856,'[{\"idpenjualan\":\"250502JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"5\",\"hargasatuan\":\"48000\",\"jumlahdiskon\":\"500\",\"subtotaljual\":\"242500\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-02 03:34:37','penjualandetail','simpanData'),(857,'{\"idpiutang\":\"250502PI0004\",\"idjenispiutang\":\"P02\",\"tglpiutang\":\"2025-05-02\",\"tgljatuhtempo\":\"2025-06-01\",\"idkonsumen\":\"KUE001\",\"keterangan\":\"test1\",\"totaldebet\":\"25000000\",\"totalkredit\":0,\"jenissumber\":\"Non Penjualan\"}','Budiman','2025-05-02 04:02:15','piutang','simpanTambahPiutang'),(858,'{\"idpiutangdetail\":\"250502PI0004001\",\"idpiutang\":\"250502PI0004\",\"tglpiutang\":\"2025-05-02\",\"debet\":\"25000000\",\"kredit\":0,\"inserted_date\":\"2025-05-02 04:02:15\",\"updated_date\":\"2025-05-02 04:02:15\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Piutang\"}','Budiman','2025-05-02 04:02:15','piutangdetail','simpanTambahPiutang'),(859,'{\"idpiutang\":\"250502PI0005\",\"idjenispiutang\":\"P02\",\"tglpiutang\":\"2025-05-02\",\"tgljatuhtempo\":\"2025-06-01\",\"idkonsumen\":\"KUE001\",\"keterangan\":\"test2\",\"totaldebet\":\"25000000\",\"totalkredit\":0,\"jenissumber\":\"Non Penjualan\"}','Budiman','2025-05-02 04:02:34','piutang','simpanTambahPiutang'),(860,'{\"idpiutangdetail\":\"250502PI0005001\",\"idpiutang\":\"250502PI0005\",\"tglpiutang\":\"2025-05-02\",\"debet\":\"25000000\",\"kredit\":0,\"inserted_date\":\"2025-05-02 04:02:34\",\"updated_date\":\"2025-05-02 04:02:34\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Piutang\"}','Budiman','2025-05-02 04:02:34','piutangdetail','simpanTambahPiutang'),(861,'{\"idpiutang\":\"250502PI0005\",\"idjenispiutang\":\"P02\",\"tglpiutang\":\"2025-05-02\",\"tgljatuhtempo\":\"2025-06-01\",\"idkonsumen\":\"KUE001\",\"keterangan\":\"test3\",\"totaldebet\":\"25000000\",\"totalkredit\":0,\"jenissumber\":\"Non Penjualan\"}','Budiman','2025-05-02 04:05:27','piutang','updateTambahPiutang'),(862,'{\"idpiutangdetail\":\"250502PI0005002\",\"idpiutang\":\"250502PI0005\",\"tglpiutang\":\"2025-05-02\",\"debet\":\"25000000\",\"kredit\":0,\"inserted_date\":\"2025-05-02 04:05:27\",\"updated_date\":\"2025-05-02 04:05:27\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Piutang\"}','Budiman','2025-05-02 04:05:27','piutangdetail','updateTambahPiutang'),(863,'{\"lastlogin\":\"2025-05-05 01:46:07\"}','Budiman','2025-05-05 01:46:07','pengguna','updateData'),(864,'{\"idpenjualan\":\"250505JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"tglinvoice\":\"2025-05-05\",\"keterangan\":\"Test\",\"totaldpp\":\"658995\",\"totaldiskon\":\"104400\",\"ppnpersen\":\"11\",\"totalppn\":\"61005\",\"totalinvoice\":\"615600\",\"inserted_date\":\"2025-05-05 06:16:44\",\"updated_date\":\"2025-05-05 06:16:44\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null}','Budiman','2025-05-05 06:16:44','penjualan','simpanData'),(865,'[{\"idpenjualan\":\"250505JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"15\",\"hargasatuan\":\"48000\",\"hargadpp\":\"43933\",\"jumlahppn\":\"4067\",\"jumlahdiskon\":\"6960\",\"subtotaljual\":\"615600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-05 06:16:44','penjualandetail','simpanData'),(866,'{\"idpenjualan\":\"250505JL0000001\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-05-05\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"keterangan\":\"Test\",\"totalpenjualan\":null,\"totaldiskon\":\"104400\",\"totalbersih\":null,\"ppnpersen\":11,\"totalppn\":\"61005\",\"biayapengiriman\":null,\"totalinvoice\":\"615600\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-05 06:16:44\",\"updated_date\":\"2025-05-05 06:16:44\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null,\"namakonsumen\":\"PT. Intrajaya\",\"idwilayah\":\"001\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Siti Khadizah\",\"namajenispiutang\":\"Middle\",\"jatuhtempo\":45,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Pontianak\"}','Budiman','2025-05-05 06:18:11','penjualan','hapusData'),(867,'[{\"id\":63,\"idpenjualan\":\"250505JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":15,\"hargasatuan\":\"48000\",\"hargadpp\":\"43933\",\"jumlahppn\":\"4067\",\"jumlahdiskon\":\"6960\",\"subtotaljual\":\"615600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":10,\"diskonpersen2\":5,\"diskonpersen3\":0}]','Budiman','2025-05-05 06:18:11','penjualandetail','hapusData'),(868,'{\"idpenjualan\":\"250502JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-05-02\",\"noinvoice\":\"2505020001\",\"keterangan\":\"Penjualan kayu\",\"totalpenjualan\":\"240000\",\"totaldiskon\":\"2500\",\"totalbersih\":\"242500\",\"ppnpersen\":11,\"totalppn\":\"26675\",\"biayapengiriman\":\"25000\",\"totalinvoice\":\"294175\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-02 03:34:37\",\"updated_date\":\"2025-05-02 03:34:37\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSKES0001\",\"nokwitansi\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idwilayah\":\"002\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Khairuddin\",\"namajenispiutang\":\"Fast\",\"jatuhtempo\":7,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Singkawang\"}','Budiman','2025-05-05 06:18:15','penjualan','hapusData'),(869,'[{\"id\":61,\"idpenjualan\":\"250502JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":5,\"hargasatuan\":\"48000\",\"hargadpp\":null,\"jumlahppn\":null,\"jumlahdiskon\":\"500\",\"subtotaljual\":\"242500\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-05 06:18:15','penjualandetail','hapusData'),(870,'{\"idposting\":\"042025\",\"bulan\":\"04\",\"tahun\":\"2025\",\"jumlahdebet\":\"10817074\",\"jumlahkredit\":\"10817074\",\"inserted_date\":\"2025-05-01 09:08:12\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-05 06:18:30','sales','hapusData'),(871,'{\"idposting\":\"032025\",\"bulan\":\"03\",\"tahun\":\"2025\",\"jumlahdebet\":\"62100000\",\"jumlahkredit\":\"62100000\",\"inserted_date\":\"2025-04-25 06:12:19\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-05 06:18:33','sales','hapusData'),(872,'{\"idposting\":\"022025\",\"bulan\":\"02\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-04-25 06:16:26\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-05 06:18:36','sales','hapusData'),(873,'{\"idposting\":\"012025\",\"bulan\":\"01\",\"tahun\":\"2025\",\"jumlahdebet\":\"0\",\"jumlahkredit\":\"0\",\"inserted_date\":\"2025-04-25 06:12:14\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-05 06:18:40','sales','hapusData'),(874,'{\"idsuratjalan\":\"250426SJ01\",\"tglsuratjalan\":\"2025-04-25\",\"idsales\":\"SLSKES0001\",\"tglcetak\":null,\"keterangan\":null,\"inserted_date\":\"2025-04-25 18:32:30\",\"updated_date\":\"2025-04-25 18:53:00\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Khairuddin\",\"npwp\":\"123456789012345\",\"namapengguna\":\"Budiman\",\"totaltagihan\":\"7835872\"}','Budiman','2025-05-05 06:18:52','suratjalan','hapusData'),(875,'[{\"iddetailsuratjalan\":17,\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250423JL0000001\"},{\"iddetailsuratjalan\":18,\"idsuratjalan\":\"250426SJ01\",\"idpenjualan\":\"250425JL0000001\"}]','Budiman','2025-05-05 06:18:52','suratjalandetail','hapusData'),(876,'{\"idreturpenjualan\":\"250425RJ0000002\",\"idpenjualan\":\"250425JL0000001\",\"tglretur\":\"2025-04-24\",\"totalretur\":\"45000\",\"keterangan\":\"Kayu rusak\",\"inserted_date\":\"2025-04-24 17:23:27\",\"updated_date\":\"2025-04-24 17:23:27\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-04-24\",\"noinvoice\":\"2504250001\",\"namakonsumen\":\"CV. Karya Utama\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-05-05 06:18:57','returpenjualan','hapusData'),(877,'[{\"idreturdetail\":7,\"idreturpenjualan\":\"250425RJ0000002\",\"idbarang\":\"K001000001\",\"jumlahretur\":3,\"hargaretur\":\"15000\",\"subtotalretur\":\"45000\"}]','Budiman','2025-05-05 06:18:57','returpenjualandetail','hapusData'),(878,'{\"idreturpenjualan\":\"250425RJ0000001\",\"idpenjualan\":\"250423JL0000001\",\"tglretur\":\"2025-04-24\",\"totalretur\":\"96000\",\"keterangan\":\"Salah Barang\",\"inserted_date\":\"2025-04-24 17:13:16\",\"updated_date\":\"2025-04-24 17:13:16\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-04-23\",\"noinvoice\":\"2504230001\",\"namakonsumen\":\"CV. Karya Utama\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-05-05 06:19:01','returpenjualan','hapusData'),(879,'[{\"idreturdetail\":6,\"idreturpenjualan\":\"250425RJ0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":2,\"hargaretur\":\"48000\",\"subtotalretur\":\"96000\"}]','Budiman','2025-05-05 06:19:01','returpenjualandetail','hapusData'),(880,'{\"idpenjualan\":\"250423JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-04-23\",\"noinvoice\":\"2504230001\",\"keterangan\":\"Kayu Besar\",\"totalpenjualan\":\"5760000\",\"totaldiskon\":\"835200\",\"totalbersih\":\"6595200\",\"ppnpersen\":11,\"totalppn\":\"725472\",\"biayapengiriman\":\"150000\",\"totalinvoice\":\"7470672\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-04-23 04:06:06\",\"updated_date\":\"2025-04-23 04:06:06\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSKES0001\",\"nokwitansi\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idwilayah\":\"002\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Khairuddin\",\"namajenispiutang\":\"Fast\",\"jatuhtempo\":7,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Singkawang\"}','Budiman','2025-05-05 06:20:34','penjualan','hapusData'),(881,'[{\"id\":59,\"idpenjualan\":\"250423JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":120,\"hargasatuan\":\"48000\",\"hargadpp\":null,\"jumlahppn\":null,\"jumlahdiskon\":\"6960\",\"subtotaljual\":\"6595200\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":10,\"diskonpersen2\":5,\"diskonpersen3\":0}]','Budiman','2025-05-05 06:20:34','penjualandetail','hapusData'),(882,'{\"idpiutangdetail\":\"250425PI0001002\",\"idpiutang\":\"250425PI0001\",\"tglpiutang\":\"2025-04-25\",\"debet\":\"0\",\"kredit\":\"365200\",\"inserted_date\":\"2025-04-25 03:32:30\",\"updated_date\":\"2025-04-25 03:32:30\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250425JL0000001\",\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"nokwitansi\":\"250425JL0000001#01\"}','Budiman','2025-05-05 06:20:54','piutangdetail','hapusData'),(883,'{\"idpenjualan\":\"250425JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-04-24\",\"noinvoice\":\"2504250001\",\"keterangan\":\"Penjualan kepada CV.Karya\",\"totalpenjualan\":\"300000\",\"totaldiskon\":\"20000\",\"totalbersih\":\"320000\",\"ppnpersen\":11,\"totalppn\":\"35200\",\"biayapengiriman\":\"10000\",\"totalinvoice\":\"365200\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-04-24 17:22:39\",\"updated_date\":\"2025-04-24 17:22:39\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSKES0001\",\"nokwitansi\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idwilayah\":\"002\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Khairuddin\",\"namajenispiutang\":\"Fast\",\"jatuhtempo\":7,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Singkawang\"}','Budiman','2025-05-05 06:21:00','penjualan','hapusData'),(884,'[{\"id\":60,\"idpenjualan\":\"250425JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":20,\"hargasatuan\":\"15000\",\"hargadpp\":null,\"jumlahppn\":null,\"jumlahdiskon\":\"1000\",\"subtotaljual\":\"320000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-05 06:21:00','penjualandetail','hapusData'),(885,'{\"idpenjualan\":\"250505JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"tglinvoice\":\"2025-05-05\",\"keterangan\":\"Test penjualan\",\"totaldpp\":\"439330\",\"totaldiskon\":\"69600\",\"ppnpersen\":\"11\",\"totalppn\":\"40670\",\"totalinvoice\":\"410400\",\"inserted_date\":\"2025-05-05 06:25:27\",\"updated_date\":\"2025-05-05 06:25:27\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null}','Budiman','2025-05-05 06:25:27','penjualan','simpanData'),(886,'[{\"idpenjualan\":\"250505JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"hargadpp\":\"43933\",\"jumlahppn\":\"4067\",\"jumlahdiskon\":\"6960\",\"subtotaljual\":\"410400\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-05 06:25:27','penjualandetail','simpanData'),(887,'{\"lastlogin\":\"2025-05-05 12:58:15\"}','Budiman','2025-05-05 12:58:15','pengguna','updateData'),(888,'{\"lastlogin\":\"2025-05-05 12:58:17\"}','Budiman','2025-05-05 12:58:18','pengguna','updateData'),(889,'{\"idpenjualan\":\"250505JL0000001\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-05-05\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"keterangan\":\"Test penjualan\",\"totalpenjualan\":null,\"totaldiskon\":\"69600\",\"totalbersih\":null,\"ppnpersen\":11,\"totalppn\":\"40670\",\"biayapengiriman\":null,\"totalinvoice\":\"410400\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-05 06:25:27\",\"updated_date\":\"2025-05-05 06:25:27\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null,\"namakonsumen\":\"PT. Intrajaya\",\"idwilayah\":\"001\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Siti Khadizah\",\"namajenispiutang\":\"Middle\",\"jatuhtempo\":45,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Pontianak\"}','Budiman','2025-05-05 13:11:55','penjualan','hapusData'),(890,'[{\"id\":64,\"idpenjualan\":\"250505JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":10,\"hargasatuan\":\"48000\",\"hargadpp\":\"43933\",\"jumlahppn\":\"4067\",\"jumlahdiskon\":\"6960\",\"subtotaljual\":\"410400\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":10,\"diskonpersen2\":5,\"diskonpersen3\":0}]','Budiman','2025-05-05 13:11:55','penjualandetail','hapusData'),(891,'{\"idpenjualan\":\"250505JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"tglinvoice\":\"2025-05-05\",\"keterangan\":\"Test Penjualan\",\"totaldpp\":\"441590\",\"totaldiskon\":\"92400\",\"ppnpersen\":\"11\",\"totalppn\":\"38410\",\"totalinvoice\":\"387600\",\"inserted_date\":\"2025-05-05 13:12:36\",\"updated_date\":\"2025-05-05 13:12:36\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null}','Budiman','2025-05-05 13:12:36','penjualan','simpanData'),(892,'[{\"idpenjualan\":\"250505JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"hargadpp\":\"44159\",\"jumlahppn\":\"3841\",\"jumlahdiskon\":\"9240\",\"subtotaljual\":\"387600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"15\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-05 13:12:36','penjualandetail','simpanData'),(893,'{\"idpenjualan\":\"250505JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"tglinvoice\":\"2025-05-05\",\"keterangan\":\"Test Penjualan 1\",\"totaldpp\":\"441590\",\"totaldiskon\":\"92400\",\"ppnpersen\":\"11\",\"totalppn\":\"38410\",\"totalinvoice\":\"387600\",\"updated_date\":\"2025-05-05 13:24:19\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null}','Budiman','2025-05-05 13:24:19','penjualan','updateData'),(894,'[{\"idpenjualan\":\"250505JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"hargadpp\":\"44159\",\"jumlahppn\":\"3841\",\"jumlahdiskon\":\"9240\",\"subtotaljual\":\"387600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"15\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-05 13:24:19','penjualandetail','updateData'),(895,'{\"idpenjualan\":\"250505JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"tglinvoice\":\"2025-05-05\",\"keterangan\":\"Test Penjualan\",\"totaldpp\":\"644300\",\"totaldiskon\":\"92400\",\"ppnpersen\":\"11\",\"totalppn\":\"60700\",\"totalinvoice\":\"612600\",\"updated_date\":\"2025-05-05 13:24:45\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null}','Budiman','2025-05-05 13:24:45','penjualan','updateData'),(896,'[{\"idpenjualan\":\"250505JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"hargadpp\":\"44159\",\"jumlahppn\":\"3841\",\"jumlahdiskon\":\"9240\",\"subtotaljual\":\"387600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"15\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"},{\"idpenjualan\":\"250505JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"15\",\"hargasatuan\":\"15000\",\"hargadpp\":\"13514\",\"jumlahppn\":\"1486\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"225000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-05 13:24:45','penjualandetail','updateData'),(897,'{\"idpenjualan\":\"250505JL0000002\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"tglinvoice\":\"2025-05-05\",\"keterangan\":\"Penjualan tunai\",\"totaldpp\":\"433430\",\"totaldiskon\":\"10000\",\"ppnpersen\":\"11\",\"totalppn\":\"46570\",\"totalinvoice\":\"470000\",\"inserted_date\":\"2025-05-05 13:29:26\",\"updated_date\":\"2025-05-05 13:29:26\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250505JL0000002#01\"}','Budiman','2025-05-05 13:29:26','penjualan','simpanData'),(898,'[{\"idpenjualan\":\"250505JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"hargadpp\":\"43343\",\"jumlahppn\":\"4657\",\"jumlahdiskon\":\"1000\",\"subtotaljual\":\"470000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-05 13:29:26','penjualandetail','simpanData'),(899,'{\"idpenjualan\":\"250505JL0000003\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"SJA\\/2505\\/000003\",\"tglinvoice\":\"2025-05-05\",\"keterangan\":\"tests\",\"totaldpp\":\"874380\",\"totaldiskon\":\"96000\",\"ppnpersen\":\"11\",\"totalppn\":\"85620\",\"totalinvoice\":\"864000\",\"inserted_date\":\"2025-05-05 14:28:03\",\"updated_date\":\"2025-05-05 14:28:03\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250505JL0000003#01\",\"nobilyetgiro\":\"1122334455\"}','Budiman','2025-05-05 14:28:03','penjualan','simpanData'),(900,'[{\"idpenjualan\":\"250505JL0000003\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"20\",\"hargasatuan\":\"48000\",\"hargadpp\":\"43719\",\"jumlahppn\":\"4281\",\"jumlahdiskon\":\"4800\",\"subtotaljual\":\"864000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-05 14:28:03','penjualandetail','simpanData'),(901,'{\"idpenjualan\":\"250505JL0000003\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"SJA\\/2505\\/000003\",\"tglinvoice\":\"2025-05-05\",\"keterangan\":\"tests\",\"totaldpp\":\"874380\",\"totaldiskon\":\"96000\",\"ppnpersen\":\"11\",\"totalppn\":\"85620\",\"totalinvoice\":\"864000\",\"updated_date\":\"2025-05-05 14:56:17\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250505JL0000003#02\",\"nobilyetgiro\":\"1122334455\"}','Budiman','2025-05-05 14:56:17','penjualan','updateData'),(902,'[{\"idpenjualan\":\"250505JL0000003\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"20\",\"hargasatuan\":\"48000\",\"hargadpp\":\"43719\",\"jumlahppn\":\"4281\",\"jumlahdiskon\":\"4800\",\"subtotaljual\":\"864000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-05 14:56:17','penjualandetail','updateData'),(903,'{\"idpenjualan\":\"250505JL0000003\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"SJA\\/2505\\/000003\",\"tglinvoice\":\"2025-05-05\",\"keterangan\":\"tests\",\"totaldpp\":\"874380\",\"totaldiskon\":\"96000\",\"ppnpersen\":\"11\",\"totalppn\":\"85620\",\"totalinvoice\":\"864000\",\"updated_date\":\"2025-05-05 14:57:39\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250505JL0000003#03\",\"nobilyetgiro\":\"1122334455\"}','Budiman','2025-05-05 14:57:39','penjualan','updateData'),(904,'[{\"idpenjualan\":\"250505JL0000003\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"20\",\"hargasatuan\":\"48000\",\"hargadpp\":\"43719\",\"jumlahppn\":\"4281\",\"jumlahdiskon\":\"4800\",\"subtotaljual\":\"864000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-05 14:57:39','penjualandetail','updateData'),(905,'{\"lastlogin\":\"2025-05-06 07:58:46\"}','Budiman','2025-05-06 07:58:46','pengguna','updateData'),(906,'{\"lastlogin\":\"2025-05-07 02:36:20\"}','Budiman','2025-05-07 02:36:20','pengguna','updateData'),(907,'{\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT\",\"notelpekspedisi\":\"0812005522200\",\"alamatekspedisi\":\"Jl. Pemuda Gg.Pahlawan No.1 Kec.Pontianak Kota\",\"emailekspedisi\":\"jnt@gmail.com\",\"nikpemilik\":\"2365545121215855\",\"namapemilik\":\"Wawan Susanto\",\"notelppemilik\":\"081521202222\",\"nowapemilik\":\"081521202222\",\"inserted_date\":\"2025-05-07 02:57:04\",\"updated_date\":\"2025-05-07 02:57:04\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-07 02:57:04','ekspedisi','simpanData'),(908,'{\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\",\"notelpekspedisi\":\"0812005522200\",\"alamatekspedisi\":\"Jl. Pemuda Gg.Pahlawan No.1 Kec.Pontianak Kota\",\"emailekspedisi\":\"jnt@gmail.com\",\"nikpemilik\":\"2365545121215855\",\"namapemilik\":\"Wawan Susanto\",\"notelppemilik\":\"081521202222\",\"nowapemilik\":\"081521202222\",\"updated_date\":\"2025-05-07 02:57:37\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-07 02:57:37','ekspedisi','updateData'),(909,'{\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\",\"notelpekspedisi\":\"0812005522200\",\"alamatekspedisi\":\"Jl. Pemuda Gg.Pahlawan No.1 Kec.Pontianak Kota\",\"emailekspedisi\":\"jnt@gmail.com\",\"nikpemilik\":\"2365545121215855\",\"namapemilik\":\"Wawan Susanto\",\"notelppemilik\":\"081521202222\",\"nowapemilik\":\"081521202222\",\"updated_date\":\"2025-05-07 02:57:51\",\"statusaktif\":\"Tidak Aktif\"}','Budiman','2025-05-07 02:57:51','ekspedisi','updateData'),(910,'{\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\",\"notelpekspedisi\":\"0812005522200\",\"alamatekspedisi\":\"Jl. Pemuda Gg.Pahlawan No.1 Kec.Pontianak Kota\",\"emailekspedisi\":\"jnt@gmail.com\",\"nikpemilik\":\"2365545121215855\",\"namapemilik\":\"Wawan Susanto\",\"notelppemilik\":\"081521202222\",\"nowapemilik\":\"081521202222\",\"updated_date\":\"2025-05-07 02:57:57\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-07 02:57:58','ekspedisi','updateData'),(911,'{\"idekspedisi\":\"EKSPWRU001\",\"namaekspedisi\":\"Pos Indonesia\",\"notelpekspedisi\":\"08125121212\",\"alamatekspedisi\":\"Jl. Karya Wisata No.22 Kec. Pontianak Timur\",\"emailekspedisi\":\"posindonesia@gmail.com\",\"nikpemilik\":\"1287485121212121\",\"namapemilik\":\"Susi\",\"notelppemilik\":\"0812005121552\",\"nowapemilik\":\"0812005121552\",\"inserted_date\":\"2025-05-07 02:59:05\",\"updated_date\":\"2025-05-07 02:59:05\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-07 02:59:05','ekspedisi','simpanData'),(912,'{\"idekspedisi\":\"EKSUPMS001\",\"namaekspedisi\":\"test\",\"notelpekspedisi\":\"23232\",\"alamatekspedisi\":\"Jl. A\",\"emailekspedisi\":\"test@gmail.com\",\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"inserted_date\":\"2025-05-07 03:21:37\",\"updated_date\":\"2025-05-07 03:21:37\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-07 03:21:37','ekspedisi','simpanData'),(913,'{\"idekspedisi\":\"EKSUPMS001\",\"namaekspedisi\":\"test\",\"alamatekspedisi\":\"Jl. A\",\"notelpekspedisi\":\"23232\",\"emailekspedisi\":\"test@gmail.com\",\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"inserted_date\":\"2025-05-07 03:21:37\",\"updated_date\":\"2025-05-07 03:21:37\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-07 03:21:43','ekspedisi','hapusData'),(914,'{\"lastlogin\":\"2025-05-07 07:35:14\"}','Budiman','2025-05-07 07:35:14','pengguna','updateData'),(915,'{\"lastlogin\":\"2025-05-07 15:48:10\"}','Budiman','2025-05-07 15:48:11','pengguna','updateData'),(916,'{\"idreturpembelian\":\"250424RB0000002\",\"idpembelian\":\"250422BL0000003\",\"tglretur\":null,\"totalretur\":\"135000\",\"keterangan\":\"Kayu nya tidak lurus dan berlobang\",\"inserted_date\":\"2025-04-24 16:29:35\",\"updated_date\":\"2025-04-24 16:29:35\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\",\"tglpengajuan\":\"2025-04-24\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"kdakunbank\":null,\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"tglfaktur\":\"2025-04-22\",\"nofaktur\":\"03\\/2025\"}','Budiman','2025-05-07 16:10:28','returpembelian','hapusData'),(917,'[{\"idreturdetail\":10,\"idreturpembelian\":\"250424RB0000002\",\"idbarang\":\"K001000002\",\"jumlahretur\":3,\"hargaretur\":\"45000\",\"subtotalretur\":\"135000\"}]','Budiman','2025-05-07 16:10:28','returpembeliandetail','hapusData'),(918,'{\"idreturpembelian\":\"250424RB0000003\",\"idpembelian\":\"250422BL0000002\",\"tglretur\":\"2025-04-24\",\"totalretur\":\"98000\",\"keterangan\":\"Kayu nya rusak\",\"inserted_date\":\"2025-04-24 16:30:37\",\"updated_date\":\"2025-04-24 16:55:18\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"statusretur\":\"Selesai\",\"tglpengajuan\":\"2025-04-24\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"kdakunbank\":\"1.1.01.02\",\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPIMN0001\",\"namasupplier\":\"PT. Intra Makmur\",\"tglfaktur\":\"2025-04-22\",\"nofaktur\":\"02\\/2025\"}','Budiman','2025-05-07 16:10:35','returpembelian','hapusData'),(919,'[{\"idreturdetail\":11,\"idreturpembelian\":\"250424RB0000003\",\"idbarang\":\"K001000001\",\"jumlahretur\":7,\"hargaretur\":\"14000\",\"subtotalretur\":\"98000\"}]','Budiman','2025-05-07 16:10:35','returpembeliandetail','hapusData'),(920,'{\"idhutangdetail\":\"250422HU0001002\",\"idhutang\":\"250422HU0001\",\"tglhutang\":\"2025-04-25\",\"debet\":\"200000\",\"kredit\":\"0\",\"inserted_date\":\"2025-04-25 13:47:13\",\"updated_date\":\"2025-04-25 13:47:13\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250422BL0000004\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-05-07 16:10:52','hutangdetail','hapusDetail'),(921,'{\"idhutangdetail\":\"250501HU0002002\",\"idhutang\":\"250501HU0002\",\"tglhutang\":\"2025-05-01\",\"debet\":\"5000000\",\"kredit\":\"0\",\"inserted_date\":\"2025-05-01 08:16:12\",\"updated_date\":\"2025-05-01 08:16:12\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Hutang\",\"idpembelian\":\"250501BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Niaga\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-07 16:11:03','hutangdetail','hapusDetail'),(922,'{\"idpembelian\":\"250501BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"289099\\/2025\",\"tglfaktur\":\"2025-05-01\",\"tglditerima\":\"2025-05-01\",\"keterangan\":\"Pembelian bahan bangunan kayu\",\"inserted_date\":\"2025-05-01 06:32:32\",\"updated_date\":\"2025-05-01 06:32:32\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"9000000\",\"totaldiskon\":\"400000\",\"totalbersih\":\"8600000\",\"ppnpersen\":11,\"totalppn\":\"946000\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"9546000\"}','Budiman','2025-05-07 16:11:18','pembelian','hapusData'),(923,'[{\"id\":54,\"idpembelian\":\"250501BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":200,\"hargasatuan\":\"45000\",\"hargadpp\":null,\"jumlahppn\":null,\"jumlahdiskon\":\"2000\",\"subtotalbeli\":\"8600000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-07 16:11:18','pembeliandetail','hapusData'),(924,'{\"idpembelian\":\"250422BL0000004\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"04\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"Test\",\"inserted_date\":\"2025-04-22 04:54:50\",\"updated_date\":\"2025-04-22 04:58:01\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"462000\",\"totaldiskon\":\"66000\",\"totalbersih\":\"396000\",\"ppnpersen\":11,\"totalppn\":\"43560\",\"biayapengiriman\":\"15000\",\"totalfaktur\":\"454560\"}','Budiman','2025-05-07 16:11:25','pembelian','hapusData'),(925,'[{\"id\":52,\"idpembelian\":\"250422BL0000004\",\"idbarang\":\"K001000001\",\"jumlahbeli\":33,\"hargasatuan\":\"14000\",\"hargadpp\":null,\"jumlahppn\":null,\"jumlahdiskon\":\"2000\",\"subtotalbeli\":\"396000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-07 16:11:25','pembeliandetail','hapusData'),(926,'{\"idpembelian\":\"250422BL0000003\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"03\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"TEST\",\"inserted_date\":\"2025-04-22 04:52:39\",\"updated_date\":\"2025-04-22 04:53:25\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"atasnama\":\"Budi Santoso\",\"kdakunbank\":\"1.1.01.03\",\"totalpembelian\":\"1125000\",\"totaldiskon\":\"88300\",\"totalbersih\":\"1036700\",\"ppnpersen\":11,\"totalppn\":\"114037\",\"biayapengiriman\":\"30000\",\"totalfaktur\":\"1180737\"}','Budiman','2025-05-07 16:11:30','pembelian','hapusData'),(927,'[{\"id\":47,\"idpembelian\":\"250422BL0000003\",\"idbarang\":\"K001000002\",\"jumlahbeli\":25,\"hargasatuan\":\"45000\",\"hargadpp\":null,\"jumlahppn\":null,\"jumlahdiskon\":\"3532\",\"subtotalbeli\":\"1036700\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":5,\"diskonpersen2\":3,\"diskonpersen3\":0}]','Budiman','2025-05-07 16:11:30','pembeliandetail','hapusData'),(928,'{\"idpembelian\":\"250422BL0000002\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-04-22\",\"tglditerima\":\"2025-04-22\",\"keterangan\":\"TEst2\",\"inserted_date\":\"2025-04-22 04:33:04\",\"updated_date\":\"2025-04-22 04:53:31\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"PT. Intra Makmur\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"namabank\":\"Bank Niaga\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"atasnama\":\"Budi Santoso\",\"kdakunbank\":\"1.1.01.02\",\"totalpembelian\":\"490000\",\"totaldiskon\":\"24500\",\"totalbersih\":\"465500\",\"ppnpersen\":11,\"totalppn\":\"51205\",\"biayapengiriman\":\"25000\",\"totalfaktur\":\"541705\"}','Budiman','2025-05-07 16:11:36','pembelian','hapusData'),(929,'[{\"id\":48,\"idpembelian\":\"250422BL0000002\",\"idbarang\":\"K001000001\",\"jumlahbeli\":35,\"hargasatuan\":\"14000\",\"hargadpp\":null,\"jumlahppn\":null,\"jumlahdiskon\":\"700\",\"subtotalbeli\":\"465500\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":5,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-07 16:11:36','pembeliandetail','hapusData'),(930,'{\"idpembelian\":\"250507BL0000001\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"001\\/FAKTUR\",\"tglfaktur\":\"2025-05-07\",\"tglditerima\":\"2025-05-07\",\"keterangan\":\"Pembelian bahan mei\",\"totaldpp\":\"601375\",\"totaldiskon\":\"68250\",\"ppnpersen\":\"11\",\"totalppn\":\"58625\",\"totalfaktur\":\"591750\",\"inserted_date\":\"2025-05-07 16:14:47\",\"updated_date\":\"2025-05-07 16:14:47\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null,\"nobilyetgiro\":null}','Budiman','2025-05-07 16:14:48','pembelian','simpanData'),(931,'[{\"idpembelian\":\"250507BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"10\",\"hargasatuan\":\"45000\",\"hargadpp\":\"41188\",\"jumlahppn\":\"3812\",\"jumlahdiskon\":\"6525\",\"subtotalbeli\":\"384750\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250507BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"15\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12633\",\"jumlahppn\":\"1367\",\"jumlahdiskon\":\"200\",\"subtotalbeli\":\"207000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-07 16:14:48','pembeliandetail','simpanData'),(932,'{\"idpembelian\":\"250507BL0000001\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"001\\/FAKTUR\",\"tglfaktur\":\"2025-05-07\",\"tglditerima\":\"2025-05-07\",\"keterangan\":\"Pembelian bahan mei periode 1\",\"totaldpp\":\"601375\",\"totaldiskon\":\"68250\",\"ppnpersen\":\"11\",\"totalppn\":\"58625\",\"totalfaktur\":\"591750\",\"updated_date\":\"2025-05-07 16:40:27\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null,\"nobilyetgiro\":null}','Budiman','2025-05-07 16:40:27','pembelian','updateData'),(933,'[{\"idpembelian\":\"250507BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"15\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12633\",\"jumlahppn\":\"1367\",\"jumlahdiskon\":\"200\",\"subtotalbeli\":\"207000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250507BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"10\",\"hargasatuan\":\"45000\",\"hargadpp\":\"41188\",\"jumlahppn\":\"3812\",\"jumlahdiskon\":\"6525\",\"subtotalbeli\":\"384750\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-07 16:40:27','pembeliandetail','updateData'),(934,'{\"idpembelian\":\"250507BL0000001\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"001\\/FAKTUR\",\"tglfaktur\":\"2025-05-07\",\"tglditerima\":\"2025-05-07\",\"keterangan\":\"Pembelian bahan mei periode 1\",\"totaldpp\":\"601375\",\"totaldiskon\":\"68250\",\"ppnpersen\":\"11\",\"totalppn\":\"58625\",\"totalfaktur\":\"591750\",\"updated_date\":\"2025-05-07 16:43:38\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":null}','Budiman','2025-05-07 16:43:38','pembelian','updateData'),(935,'[{\"idpembelian\":\"250507BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"15\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12633\",\"jumlahppn\":\"1367\",\"jumlahdiskon\":\"200\",\"subtotalbeli\":\"207000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250507BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"10\",\"hargasatuan\":\"45000\",\"hargadpp\":\"41188\",\"jumlahppn\":\"3812\",\"jumlahdiskon\":\"6525\",\"subtotalbeli\":\"384750\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-07 16:43:38','pembeliandetail','updateData'),(936,'{\"idpembelian\":\"250507BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"0002\\/FAKTUR\",\"tglfaktur\":\"2025-05-07\",\"tglditerima\":\"2025-05-07\",\"keterangan\":\"Pembelian Bahan Mei Periode 2\",\"totaldpp\":\"1359930\",\"totaldiskon\":\"222750\",\"ppnpersen\":\"11\",\"totalppn\":\"125070\",\"totalfaktur\":\"1262250\",\"inserted_date\":\"2025-05-07 16:45:30\",\"updated_date\":\"2025-05-07 16:45:30\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null,\"nobilyetgiro\":null}','Budiman','2025-05-07 16:45:30','pembelian','simpanData'),(937,'[{\"idpembelian\":\"250507BL0000002\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"33\",\"hargasatuan\":\"45000\",\"hargadpp\":\"41210\",\"jumlahppn\":\"3790\",\"jumlahdiskon\":\"6750\",\"subtotalbeli\":\"1262250\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"15\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-07 16:45:30','pembeliandetail','simpanData'),(938,'{\"idhutangdetail\":\"250507HU0001002\",\"idhutang\":\"250507HU0001\",\"tglhutang\":\"2025-05-07\",\"debet\":\"1262250\",\"kredit\":0,\"inserted_date\":\"2025-05-07 17:03:29\",\"updated_date\":\"2025-05-07 17:03:29\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":\"DB1\\/244200\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-05-07 17:03:29','hutangdetail','simpanData'),(939,'{\"idhutangdetail\":\"250507HU0001002\",\"idhutang\":\"250507HU0001\",\"tglhutang\":\"2025-05-07\",\"debet\":\"1262250\",\"kredit\":\"0\",\"inserted_date\":\"2025-05-07 17:03:29\",\"updated_date\":\"2025-05-07 17:03:29\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"jenis\":\"Pembayaran Hutang\",\"nobilyetgiro\":\"DB1\\/244200\",\"idpembelian\":\"250507BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-05-07 17:06:42','hutangdetail','hapusDetail'),(940,'{\"idhutangdetail\":\"250507HU0001002\",\"idhutang\":\"250507HU0001\",\"tglhutang\":\"2025-05-07\",\"debet\":\"500000\",\"kredit\":0,\"inserted_date\":\"2025-05-07 17:08:11\",\"updated_date\":\"2025-05-07 17:08:11\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":\"245\\/BILYET\",\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-05-07 17:08:11','hutangdetail','simpanData'),(941,'{\"idpiutangdetail\":\"250505PI0001002\",\"idpiutang\":\"250505PI0001\",\"tglpiutang\":\"2025-05-07\",\"debet\":0,\"kredit\":\"612600\",\"inserted_date\":\"2025-05-07 17:25:34\",\"updated_date\":\"2025-05-07 17:25:34\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":\"BN001\",\"nobilyetgiro\":\"645\\/BILYET\",\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250505JL0000001#01\"}','Budiman','2025-05-07 17:25:34','piutangdetail','simpanData'),(942,'{\"idpiutang\":\"250502PI0001\",\"idpenjualan\":null,\"idjenispiutang\":\"P02\",\"tglpiutang\":\"2025-05-02\",\"tgljatuhtempo\":\"2025-06-01\",\"idkonsumen\":\"KUE001\",\"totaldebet\":\"25000000\",\"totalkredit\":\"0\",\"jenissumber\":\"Non Penjualan\",\"keterangan\":\"Penjualan dengan nomor. 123\",\"namakonsumen\":\"CV. Karya Utama\",\"namajenispiutang\":\"Middle\",\"jatuhtempo\":45,\"tglinvoice\":null,\"noinvoice\":null,\"statuslunas\":\"Belum Lunas\"}','Budiman','2025-05-07 18:33:35','piutang','hapusData'),(943,'{\"idpiutang\":\"250502PI0002\",\"idpenjualan\":null,\"idjenispiutang\":\"P02\",\"tglpiutang\":\"2025-05-02\",\"tgljatuhtempo\":\"2025-06-01\",\"idkonsumen\":\"KUE001\",\"totaldebet\":\"25000000\",\"totalkredit\":\"0\",\"jenissumber\":\"Non Penjualan\",\"keterangan\":\"test\",\"namakonsumen\":\"CV. Karya Utama\",\"namajenispiutang\":\"Middle\",\"jatuhtempo\":45,\"tglinvoice\":null,\"noinvoice\":null,\"statuslunas\":\"Belum Lunas\"}','Budiman','2025-05-07 18:34:46','piutang','hapusData'),(944,'{\"idpiutang\":\"250502PI0004\",\"idpenjualan\":null,\"idjenispiutang\":\"P02\",\"tglpiutang\":\"2025-05-02\",\"tgljatuhtempo\":\"2025-06-01\",\"idkonsumen\":\"KUE001\",\"totaldebet\":\"25000000\",\"totalkredit\":\"0\",\"jenissumber\":\"Non Penjualan\",\"keterangan\":\"test1\",\"namakonsumen\":\"CV. Karya Utama\",\"namajenispiutang\":\"Middle\",\"jatuhtempo\":45,\"tglinvoice\":null,\"noinvoice\":null,\"statuslunas\":\"Belum Lunas\"}','Budiman','2025-05-07 18:34:52','piutang','hapusData'),(945,'{\"idpiutang\":\"250502PI0005\",\"idjenispiutang\":\"P02\",\"tglpiutang\":\"2025-05-02\",\"tgljatuhtempo\":\"2025-06-16\",\"idkonsumen\":\"KUE001\",\"keterangan\":\"Saldo Awal Piutang CV. Karya Utama\",\"totaldebet\":\"25000000\",\"totalkredit\":0,\"jenissumber\":\"Non Penjualan\"}','Budiman','2025-05-07 18:35:12','piutang','updateTambahPiutang'),(946,'{\"idpiutangdetail\":\"250502PI0005003\",\"idpiutang\":\"250502PI0005\",\"tglpiutang\":\"2025-05-02\",\"debet\":\"25000000\",\"kredit\":0,\"inserted_date\":\"2025-05-07 18:35:12\",\"updated_date\":\"2025-05-07 18:35:12\",\"idpengguna\":\"USRBID0001\",\"jenis\":\"Piutang\"}','Budiman','2025-05-07 18:35:12','piutangdetail','updateTambahPiutang'),(947,'{\"lastlogin\":\"2025-05-09 16:25:21\"}','Budiman','2025-05-09 16:25:21','pengguna','updateData'),(948,'{\"lastlogin\":\"2025-05-10 03:41:51\"}','Budiman','2025-05-10 03:41:51','pengguna','updateData'),(949,'{\"idkategori\":\"W001\",\"namakategori\":\"Wavin\",\"inserted_date\":\"2025-05-10 03:43:57\",\"updated_date\":\"2025-05-10 03:43:57\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-10 03:43:57','kategoribarang','simpanData'),(950,'{\"idbarang\":\"W001000001\",\"namabarang\":\"Pipa 5In\",\"idkategori\":\"W001\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"100000\",\"hargajualasli\":\"120000\",\"hargajualdiskon\":\"120000\",\"inserted_date\":\"2025-05-10 03:46:26\",\"updated_date\":\"2025-05-10 03:46:26\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-10 03:46:26','barang','simpanData'),(951,'{\"idbarang\":\"W001000001\",\"namabarang\":\"Pipa 5In\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"100000\",\"hargajualasli\":\"120000\",\"hargajualdiskon\":\"120000\",\"updated_date\":\"2025-05-10 03:47:15\",\"statusaktif\":\"Tidak Aktif\"}','Budiman','2025-05-10 03:47:15','barang','updateData'),(952,'{\"idbarang\":\"W001000001\",\"namabarang\":\"Pipa 5In\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"100000\",\"hargajualasli\":\"120000\",\"hargajualdiskon\":\"120000\",\"updated_date\":\"2025-05-10 03:48:02\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-10 03:48:02','barang','updateData'),(953,'{\"idwilayah\":\"003\",\"namawilayah\":\"Sanggau\",\"inserted_date\":\"2025-05-10 03:49:25\",\"updated_date\":\"2025-05-10 03:49:25\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-10 03:49:25','wilayah','simpanData'),(954,'{\"idkonsumen\":\"SKE001\",\"namakonsumen\":\"Sinar Kobar\",\"notelpkonsumen\":\"06537272788\",\"alamatkonsumen\":\"Jl. Pahlawan No.  23 Kel. Sungai Raya Kec. Sosok\",\"emailkonsumen\":\"sinarkobar@gmail.com\",\"nikpemilik\":null,\"namapemilik\":\"Toni\",\"notelppemilik\":null,\"nowapemilik\":null,\"idwilayah\":\"003\",\"inserted_date\":\"2025-05-10 03:54:55\",\"updated_date\":\"2025-05-10 03:54:55\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-10 03:54:55','konsumen','simpanData'),(955,'{\"idkonsumen\":\"SKE001\",\"namakonsumen\":\"Sinar Kobar\",\"notelpkonsumen\":\"06537272788\",\"alamatkonsumen\":\"Jl. Pahlawan No.  23 Kel. Sungai Raya Kec. Sosok\",\"emailkonsumen\":\"sinarkobar@gmail.com\",\"nikpemilik\":null,\"namapemilik\":\"Toni\",\"notelppemilik\":\"081200000000\",\"nowapemilik\":null,\"idwilayah\":\"003\",\"updated_date\":\"2025-05-10 03:55:14\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-10 03:55:14','konsumen','updateData'),(956,'{\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"1234444555566666\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-03-13\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Pemuda\",\"alamattinggal\":\"Jl. Pelangi\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"08135553330000\",\"email\":\"khairuddin@gmail.com\",\"npwp\":\"123456789012345\",\"tglkontrak\":\"2025-03-13\",\"filekontrak\":null,\"updated_date\":\"2025-05-10 04:03:24\",\"statusaktif\":\"Tidak Aktif\"}','Budiman','2025-05-10 04:03:24','sales','updateData'),(957,'{\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"1234444555566666\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-03-13\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Pemuda\",\"alamattinggal\":\"Jl. Pelangi\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"08135553330000\",\"email\":\"khairuddin@gmail.com\",\"npwp\":\"123456789012345\",\"tglkontrak\":\"2025-03-13\",\"filekontrak\":null,\"updated_date\":\"2025-05-10 04:03:37\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-10 04:03:37','sales','updateData'),(958,'{\"idsupplier\":\"SUPMUF0001\",\"namasupplier\":\"PT. MILPO\",\"npwp\":\"829292888999988\",\"alamatsupplier\":\"Jakarta\",\"kontakperson\":\"Bpk. Tomi\",\"notelp\":\"081200000000\",\"email\":\"tomi@gmail.com\",\"inserted_date\":\"2025-05-10 04:05:01\",\"updated_date\":\"2025-05-10 04:05:01\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-10 04:05:01','supplier','simpanData'),(959,'{\"kdakun\":\"1.1.01.02\",\"namaakun\":\"Rekening May Bank\",\"updated_date\":\"2025-05-10 04:06:51\"}','Budiman','2025-05-10 04:06:51','akun','updateData'),(960,'{\"idbank\":\"BN001\",\"namabank\":\"May Bank\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"atasnama\":\"Budi Santoso\",\"kdakun\":\"1.1.01.02\",\"updated_date\":\"2025-05-10 04:07:20\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-10 04:07:20','bank','updateData'),(961,'{\"idpembelian\":\"250510BL0000001\",\"idsupplier\":\"SUPMUF0001\",\"nofaktur\":\"001\\/FAKTUR\\/2025\",\"tglfaktur\":\"2025-05-10\",\"tglditerima\":\"2025-05-10\",\"keterangan\":\"Pmebelian Material Kayu\",\"totaldpp\":\"9459500\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"1040500\",\"totalfaktur\":\"10500000\",\"inserted_date\":\"2025-05-10 04:59:27\",\"updated_date\":\"2025-05-10 04:59:27\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":null}','Budiman','2025-05-10 04:59:27','pembelian','simpanData'),(962,'[{\"idpembelian\":\"250510BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"100\",\"hargasatuan\":\"105000\",\"hargadpp\":\"94595\",\"jumlahppn\":\"10405\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"10500000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-10 04:59:27','pembeliandetail','simpanData'),(963,'{\"idpembelian\":\"250510BL0000001\",\"idsupplier\":\"SUPMUF0001\",\"nofaktur\":\"001\\/FAKTUR\\/2025\",\"tglfaktur\":\"2025-05-10\",\"tglditerima\":\"2025-05-10\",\"keterangan\":\"Pmebelian Material Kayu\",\"totaldpp\":\"9459500\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"1040500\",\"totalfaktur\":\"10500000\",\"updated_date\":\"2025-05-10 04:59:58\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null,\"nobilyetgiro\":null}','Budiman','2025-05-10 04:59:58','pembelian','updateData'),(964,'[{\"idpembelian\":\"250510BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"100\",\"hargasatuan\":\"105000\",\"hargadpp\":\"94595\",\"jumlahppn\":\"10405\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"10500000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-10 04:59:58','pembeliandetail','updateData'),(965,'{\"idhutangdetail\":\"250510HU0001002\",\"idhutang\":\"250510HU0001\",\"tglhutang\":\"2025-05-10\",\"debet\":\"5000000\",\"kredit\":0,\"inserted_date\":\"2025-05-10 05:01:12\",\"updated_date\":\"2025-05-10 05:01:12\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"nobilyetgiro\":null,\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-05-10 05:01:12','hutangdetail','simpanData'),(966,'{\"idreturpembelian\":\"250510RB0000001\",\"idpembelian\":\"250510BL0000001\",\"tglpengajuan\":\"2025-05-10\",\"totalretur\":525000,\"keterangan\":\"Pipa Patah\",\"inserted_date\":\"2025-05-10 05:04:40\",\"updated_date\":\"2025-05-10 05:04:40\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\"}','Budiman','2025-05-10 05:04:40','returpembelian','simpanData'),(967,'[{\"idreturpembelian\":\"250510RB0000001\",\"idbarang\":\"W001000001\",\"jumlahretur\":\"5\",\"hargaretur\":\"105000\",\"subtotalretur\":\"525000\"}]','Budiman','2025-05-10 05:04:40','returpembeliandetail','simpanData'),(968,'{\"idpenjualan\":\"250510JL0000001\",\"idkonsumen\":\"SKE001\",\"noinvoice\":\"SJA\\/2505\\/000004\",\"tglinvoice\":\"2025-05-10\",\"keterangan\":\"-\",\"totaldpp\":\"1316580\",\"totaldiskon\":\"194520\",\"ppnpersen\":\"11\",\"totalppn\":\"123420\",\"totalinvoice\":\"1245480\",\"inserted_date\":\"2025-05-10 05:38:51\",\"updated_date\":\"2025-05-10 05:38:51\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSKES0001\",\"nokwitansi\":null,\"nobilyetgiro\":null}','Budiman','2025-05-10 05:38:51','penjualan','simpanData'),(969,'[{\"idpenjualan\":\"250510JL0000001\",\"idbarang\":\"W001000001\",\"jumlahjual\":\"10\",\"hargasatuan\":\"120000\",\"hargadpp\":\"110036\",\"jumlahppn\":\"9964\",\"jumlahdiskon\":\"19452\",\"subtotaljual\":\"1005480\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"2\"},{\"idpenjualan\":\"250510JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"5\",\"hargasatuan\":\"48000\",\"hargadpp\":\"43244\",\"jumlahppn\":\"4756\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"240000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-10 05:38:51','penjualandetail','simpanData'),(970,'{\"idpiutangdetail\":\"250510PI0001002\",\"idpiutang\":\"250510PI0001\",\"tglpiutang\":\"2025-05-10\",\"debet\":0,\"kredit\":\"1245480\",\"inserted_date\":\"2025-05-10 05:50:55\",\"updated_date\":\"2025-05-10 05:50:55\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"nobilyetgiro\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250510JL0000001#01\"}','Budiman','2025-05-10 05:50:55','piutangdetail','simpanData'),(971,'{\"idreturpenjualan\":\"250510RJ0000001\",\"idpenjualan\":\"250505JL0000002\",\"tglretur\":\"2025-05-10\",\"totalretur\":480000,\"keterangan\":\"Pipa bocor\",\"inserted_date\":\"2025-05-10 05:55:55\",\"updated_date\":\"2025-05-10 05:55:55\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null}','Budiman','2025-05-10 05:55:55','returpenjualan','simpanData'),(972,'[{\"idreturpenjualan\":\"250510RJ0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"10\",\"hargaretur\":\"48000\",\"subtotalretur\":\"480000\"}]','Budiman','2025-05-10 05:55:55','returpenjualandetail','simpanData'),(973,'{\"idposting\":\"052025\",\"bulan\":\"05\",\"tahun\":\"2025\",\"jumlahdebet\":0,\"jumlahkredit\":0,\"inserted_date\":\"2025-05-10 07:55:25\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-10 07:55:25','postingjurnal','simpanData'),(974,'{\"lastlogin\":\"2025-05-10 14:25:10\"}','Budiman','2025-05-10 14:25:10','pengguna','updateData'),(975,'{\"lastlogin\":\"2025-05-11 11:26:30\"}','Budiman','2025-05-11 11:26:30','pengguna','updateData'),(976,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idsales\":\"SLSKES0001\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"biayapengiriman\":\"150000\",\"identitasekspedisi\":\"No Plat: KB2121SX\",\"totaltagihan\":\"864000\",\"inserted_date\":\"2025-05-11 12:11:16\",\"updated_date\":\"2025-05-11 12:11:16\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-11 12:11:16','suratjalan','simpanData'),(977,'[{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000003\"}]','Budiman','2025-05-11 12:11:16','suratjalandetail','simpanData'),(978,'[{\"idsuratjalan\":\"250511SJ01\",\"namabarang\":\"Kayu Bulat\",\"qty\":\"1\",\"satuan\":\"Box\",\"keterangan\":\"Kayu ukuran 2m\"}]','Budiman','2025-05-11 12:11:16','suratjalanrincian','simpanData'),(979,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"biayapengiriman\":\"150000\",\"identitasekspedisi\":\"No Plat: KB2121SX\",\"totaltagihan\":\"864000\",\"updated_date\":\"2025-05-11 12:24:39\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-11 12:24:39','suratjalan','updateData'),(980,'[{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000003\"}]','Budiman','2025-05-11 12:24:39','suratjalandetail','updateData'),(981,'[{\"idsuratjalan\":\"250511SJ01\",\"namabarang\":\"Kayu Bulat\",\"qty\":\"1\",\"satuan\":\"Box\",\"keterangan\":\"Kayu ukuran 2m\"}]','Budiman','2025-05-11 12:24:39','suratjalanrincian','updateData'),(982,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"biayapengiriman\":\"150000\",\"identitasekspedisi\":\"No Plat: KB2121SX, Supir: Bambang\",\"totaltagihan\":\"864000\",\"updated_date\":\"2025-05-11 12:24:56\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-11 12:24:56','suratjalan','updateData'),(983,'[{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000003\"}]','Budiman','2025-05-11 12:24:56','suratjalandetail','updateData'),(984,'[{\"idsuratjalan\":\"250511SJ01\",\"namabarang\":\"Kayu Bulat\",\"qty\":\"1\",\"satuan\":\"Box\",\"keterangan\":\"Kayu ukuran 2m\"}]','Budiman','2025-05-11 12:24:56','suratjalanrincian','updateData'),(985,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idsales\":\"SLSKES0001\",\"tglcetak\":null,\"keterangan\":null,\"inserted_date\":\"2025-05-11 12:11:16\",\"updated_date\":\"2025-05-11 12:24:56\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Khairuddin\",\"npwp\":\"123456789012345\",\"namapengguna\":\"Budiman\",\"totaltagihan\":\"864000\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"identitasekspedisi\":\"No Plat: KB2121SX, Supir: Bambang\",\"biayapengiriman\":\"150000\",\"namaekspedisi\":\"JNT Ekspress\",\"namajenisekspedisi\":\"Laut\"}','Budiman','2025-05-11 12:32:31','suratjalan','hapusData'),(986,'[{\"iddetailsuratjalan\":21,\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000003\"}]','Budiman','2025-05-11 12:32:31','suratjalandetail','hapusData'),(987,'[{\"idsuratjalanrincian\":3,\"idsuratjalan\":\"250511SJ01\",\"namabarang\":\"Kayu Bulat\",\"qty\":1,\"satuan\":\"Box\",\"keterangan\":\"Kayu ukuran 2m\"}]','Budiman','2025-05-11 12:32:31','suratjalanrincian','hapusData'),(988,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idkonsumen\":\"IPJ001\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"biayapengiriman\":\"150000\",\"identitasekspedisi\":\"No Plat: KB2929SS, Supir: bambang\",\"totaltagihan\":\"1082600\",\"inserted_date\":\"2025-05-11 12:47:08\",\"updated_date\":\"2025-05-11 12:47:08\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-11 12:47:08','suratjalan','simpanData'),(989,'[{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000001\"},{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000002\"}]','Budiman','2025-05-11 12:47:08','suratjalandetail','simpanData'),(990,'[{\"idsuratjalan\":\"250511SJ01\",\"namabarang\":\"Kayu Bulat\",\"qty\":\"1\",\"satuan\":\"Box\",\"keterangan\":\"Kayu ukuran 2m\"}]','Budiman','2025-05-11 12:47:08','suratjalanrincian','simpanData'),(991,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"biayapengiriman\":\"150000\",\"identitasekspedisi\":\"No Plat: KB2929SS, Supir: bambang\",\"totaltagihan\":\"1082600\",\"updated_date\":\"2025-05-11 12:53:17\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-11 12:53:17','suratjalan','updateData'),(992,'[{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000001\"},{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000002\"}]','Budiman','2025-05-11 12:53:17','suratjalandetail','updateData'),(993,'[{\"idsuratjalan\":\"250511SJ01\",\"namabarang\":\"Kayu Bulat\",\"qty\":\"1\",\"satuan\":\"Box\",\"keterangan\":\"Kayu ukuran 2m\"}]','Budiman','2025-05-11 12:53:17','suratjalanrincian','updateData'),(994,'{\"idposting\":\"052025\",\"bulan\":\"05\",\"tahun\":\"2025\",\"jumlahdebet\":\"65384160\",\"jumlahkredit\":\"65384160\",\"inserted_date\":\"2025-05-10 07:55:25\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-11 14:01:41','sales','hapusData'),(995,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idkonsumen\":\"IPJ001\",\"tglcetak\":null,\"keterangan\":null,\"inserted_date\":\"2025-05-11 12:47:08\",\"updated_date\":\"2025-05-11 12:53:17\",\"idpengguna\":\"USRBID0001\",\"namapengguna\":\"Budiman\",\"totaltagihan\":\"1082600\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"identitasekspedisi\":\"No Plat: KB2929SS, Supir: bambang\",\"biayapengiriman\":\"150000\",\"namaekspedisi\":\"JNT Ekspress\",\"namajenisekspedisi\":\"Laut\",\"namakonsumen\":\"PT. Intrajaya\",\"alamatkonsumen\":\"Jl. Patimura\",\"notelpkonsumen\":\"45452121212222112121\",\"emailkonsumen\":\"intrajaya@gmail.com\",\"nikpemilik\":\"0000000000000000\",\"namapemilik\":\"Budi Hartono\",\"notelppemilik\":\"0665234550\",\"nowapemilik\":\"0813000000000\",\"npwp\":null,\"namawilayah\":\"Pontianak\"}','Budiman','2025-05-11 14:38:04','suratjalan','hapusData'),(996,'[{\"iddetailsuratjalan\":24,\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000001\"},{\"iddetailsuratjalan\":25,\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000002\"}]','Budiman','2025-05-11 14:38:04','suratjalandetail','hapusData'),(997,'[{\"idsuratjalanrincian\":5,\"idsuratjalan\":\"250511SJ01\",\"namabarang\":\"Kayu Bulat\",\"qty\":1,\"satuan\":\"Box\",\"keterangan\":\"Kayu ukuran 2m\"}]','Budiman','2025-05-11 14:38:04','suratjalanrincian','hapusData'),(998,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idkonsumen\":\"IPJ001\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"biayapengiriman\":\"250000\",\"identitasekspedisi\":\"test\",\"totaltagihan\":\"1082600\",\"inserted_date\":\"2025-05-11 14:41:03\",\"updated_date\":\"2025-05-11 14:41:03\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-11 14:41:03','suratjalan','simpanData'),(999,'[{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000001\"},{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000002\"}]','Budiman','2025-05-11 14:41:03','suratjalandetail','simpanData'),(1000,'[{\"idsuratjalan\":\"250511SJ01\",\"qty\":null,\"satuan\":\"2\",\"keterangan\":\"Kol\"}]','Budiman','2025-05-11 14:41:03','suratjalanrincian','simpanData'),(1001,'{\"lastlogin\":\"2025-05-12 06:07:18\"}','Budiman','2025-05-12 06:07:18','pengguna','updateData'),(1002,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"biayapengiriman\":\"250000\",\"identitasekspedisi\":\"test\",\"totaltagihan\":\"1082600\",\"updated_date\":\"2025-05-12 06:09:51\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-12 06:09:52','suratjalan','updateData'),(1003,'[{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000001\"},{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000002\"}]','Budiman','2025-05-12 06:09:52','suratjalandetail','updateData'),(1004,'[{\"idsuratjalan\":\"250511SJ01\",\"qty\":\"2\",\"satuan\":\"satuan\",\"keterangan\":\"ket\"}]','Budiman','2025-05-12 06:09:52','suratjalanrincian','updateData'),(1005,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"biayapengiriman\":\"250000\",\"identitasekspedisi\":\"test\",\"totaltagihan\":\"1082600\",\"updated_date\":\"2025-05-12 06:10:03\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-12 06:10:03','suratjalan','updateData'),(1006,'[{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000001\"},{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000002\"}]','Budiman','2025-05-12 06:10:03','suratjalandetail','updateData'),(1007,'[{\"idsuratjalan\":\"250511SJ01\",\"qty\":\"2\",\"satuan\":\"satuan\",\"keterangan\":\"ket\"}]','Budiman','2025-05-12 06:10:03','suratjalanrincian','updateData'),(1008,'{\"idsuratjalan\":\"250512SJ01\",\"tglsuratjalan\":\"2025-05-12\",\"idkonsumen\":\"KUE001\",\"idekspedisi\":\"EKSPWRU001\",\"idjenisekspedisi\":\"001\",\"biayapengiriman\":\"100000\",\"identitasekspedisi\":\"KB2433FF\",\"totaltagihan\":\"864000\",\"inserted_date\":\"2025-05-12 06:10:58\",\"updated_date\":\"2025-05-12 06:10:58\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-12 06:10:58','suratjalan','simpanData'),(1009,'[{\"idsuratjalan\":\"250512SJ01\",\"idpenjualan\":\"250505JL0000003\"}]','Budiman','2025-05-12 06:10:58','suratjalandetail','simpanData'),(1010,'[{\"idsuratjalan\":\"250512SJ01\",\"qty\":\"1\",\"satuan\":\"KG\",\"keterangan\":\"KEterangan\"}]','Budiman','2025-05-12 06:10:58','suratjalanrincian','simpanData'),(1011,'{\"idsuratjalan\":\"250512SJ01\",\"tglsuratjalan\":\"2025-05-12\",\"idekspedisi\":\"EKSPWRU001\",\"idjenisekspedisi\":\"001\",\"biayapengiriman\":\"100000\",\"identitasekspedisi\":\"KB2433FF\",\"totaltagihan\":\"864000\",\"updated_date\":\"2025-05-12 06:12:51\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-12 06:12:51','suratjalan','updateData'),(1012,'[{\"idsuratjalan\":\"250512SJ01\",\"idpenjualan\":\"250505JL0000003\"}]','Budiman','2025-05-12 06:12:51','suratjalandetail','updateData'),(1013,'[{\"idsuratjalan\":\"250512SJ01\",\"qty\":\"1\",\"satuan\":\"KG\",\"keterangan\":\"KEterangan\"}]','Budiman','2025-05-12 06:12:51','suratjalanrincian','updateData'),(1014,'{\"idsuratjalan\":\"250512SJ01\",\"tglsuratjalan\":\"2025-05-12\",\"idekspedisi\":\"EKSPWRU001\",\"idjenisekspedisi\":\"001\",\"biayapengiriman\":\"100000\",\"identitasekspedisi\":\"KB2433FF\",\"totaltagihan\":\"864000\",\"updated_date\":\"2025-05-12 06:13:05\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-12 06:13:05','suratjalan','updateData'),(1015,'[{\"idsuratjalan\":\"250512SJ01\",\"idpenjualan\":\"250505JL0000003\"}]','Budiman','2025-05-12 06:13:05','suratjalandetail','updateData'),(1016,'[{\"idsuratjalan\":\"250512SJ01\",\"qty\":\"1\",\"satuan\":\"KG\",\"keterangan\":\"KEterangan\"}]','Budiman','2025-05-12 06:13:05','suratjalanrincian','updateData'),(1017,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"biayapengiriman\":\"250000\",\"identitasekspedisi\":\"Hati Hati Barang Pecah Belah\",\"totaltagihan\":\"1082600\",\"updated_date\":\"2025-05-12 06:35:43\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-12 06:35:43','suratjalan','updateData'),(1018,'[{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000002\"},{\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000001\"}]','Budiman','2025-05-12 06:35:43','suratjalandetail','updateData'),(1019,'[{\"idsuratjalan\":\"250511SJ01\",\"qty\":\"2\",\"satuan\":\"Kol\",\"keterangan\":\"Barang BLACKFOOT, HYPER, DAN AFTA\"}]','Budiman','2025-05-12 06:35:43','suratjalanrincian','updateData'),(1020,'{\"lastlogin\":\"2025-05-13 02:08:23\"}','Budiman','2025-05-13 02:08:23','pengguna','updateData'),(1021,'{\"idreturpembelian\":\"250510RB0000001\",\"idpembelian\":\"250510BL0000001\",\"tglretur\":null,\"totalretur\":\"525000\",\"keterangan\":\"Pipa Patah\",\"inserted_date\":\"2025-05-10 05:04:40\",\"updated_date\":\"2025-05-10 05:04:40\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\",\"tglpengajuan\":\"2025-05-10\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"kdakunbank\":null,\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPMUF0001\",\"namasupplier\":\"PT. MILPO\",\"tglfaktur\":\"2025-05-10\",\"nofaktur\":\"001\\/FAKTUR\\/2025\"}','Budiman','2025-05-13 02:08:40','returpembelian','hapusData'),(1022,'[{\"idreturdetail\":12,\"idreturpembelian\":\"250510RB0000001\",\"idbarang\":\"W001000001\",\"jumlahretur\":5,\"hargaretur\":\"105000\",\"subtotalretur\":\"525000\"}]','Budiman','2025-05-13 02:08:40','returpembeliandetail','hapusData'),(1023,'{\"idhutangdetail\":\"250510HU0001002\",\"idhutang\":\"250510HU0001\",\"tglhutang\":\"2025-05-10\",\"debet\":\"5000000\",\"kredit\":\"0\",\"inserted_date\":\"2025-05-10 05:01:12\",\"updated_date\":\"2025-05-10 05:01:12\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Hutang\",\"nobilyetgiro\":null,\"idpembelian\":\"250510BL0000001\",\"idsupplier\":\"SUPMUF0001\",\"namabank\":\"May Bank\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-13 02:09:08','hutangdetail','hapusDetail'),(1024,'{\"idhutangdetail\":\"250507HU0001002\",\"idhutang\":\"250507HU0001\",\"tglhutang\":\"2025-05-07\",\"debet\":\"500000\",\"kredit\":\"0\",\"inserted_date\":\"2025-05-07 17:08:11\",\"updated_date\":\"2025-05-07 17:08:11\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"jenis\":\"Pembayaran Hutang\",\"nobilyetgiro\":\"245\\/BILYET\",\"idpembelian\":\"250507BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":\"Bank Central Asia\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-13 02:09:20','hutangdetail','hapusDetail'),(1025,'{\"idhutangdetail\":\"250501HU0003006\",\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"debet\":\"10000000\",\"kredit\":\"0\",\"inserted_date\":\"2025-05-01 08:22:00\",\"updated_date\":\"2025-05-01 08:22:00\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Hutang\",\"nobilyetgiro\":null,\"idpembelian\":null,\"idsupplier\":\"SUPIMN0001\",\"namabank\":\"May Bank\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-13 02:09:28','hutangdetail','hapusDetail'),(1026,'{\"idhutangdetail\":\"250501HU0003007\",\"idhutang\":\"250501HU0003\",\"tglhutang\":\"2025-05-01\",\"debet\":\"11000000\",\"kredit\":\"0\",\"inserted_date\":\"2025-05-01 08:22:45\",\"updated_date\":\"2025-05-01 08:22:45\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Hutang\",\"nobilyetgiro\":null,\"idpembelian\":null,\"idsupplier\":\"SUPIMN0001\",\"namabank\":\"May Bank\",\"namapengguna\":\"Budiman\"}','Budiman','2025-05-13 02:09:32','hutangdetail','hapusDetail'),(1027,'{\"idpembelian\":\"250510BL0000001\",\"idsupplier\":\"SUPMUF0001\",\"nofaktur\":\"001\\/FAKTUR\\/2025\",\"tglfaktur\":\"2025-05-10\",\"tglditerima\":\"2025-05-10\",\"keterangan\":\"Pmebelian Material Kayu\",\"inserted_date\":\"2025-05-10 04:59:27\",\"updated_date\":\"2025-05-10 04:59:58\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"PT. MILPO\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"1040500\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"10500000\",\"totaldpp\":\"9459500\",\"nobilyetgiro\":null}','Budiman','2025-05-13 02:09:48','pembelian','hapusData'),(1028,'[{\"id\":63,\"idpembelian\":\"250510BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":100,\"hargasatuan\":\"105000\",\"hargadpp\":\"94595\",\"jumlahppn\":\"10405\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"10500000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":null,\"hargadpp_po\":null,\"jumlahpph_po\":null,\"jumlahdiskon_po\":null,\"subtotalbeli_po\":null,\"diskonpersen1_po\":null,\"diskonpersen2_po\":null,\"diskonpersen3_po\":null}]','Budiman','2025-05-13 02:09:48','pembeliandetail','hapusData'),(1029,'{\"idpembelian\":\"250507BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"0002\\/FAKTUR\",\"tglfaktur\":\"2025-05-07\",\"tglditerima\":\"2025-05-07\",\"keterangan\":\"Pembelian Bahan Mei Periode 2\",\"inserted_date\":\"2025-05-07 16:45:30\",\"updated_date\":\"2025-05-07 16:45:30\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"222750\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"125070\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"1262250\",\"totaldpp\":\"1359930\",\"nobilyetgiro\":null}','Budiman','2025-05-13 02:09:52','pembelian','hapusData'),(1030,'[{\"id\":61,\"idpembelian\":\"250507BL0000002\",\"idbarang\":\"K001000002\",\"jumlahbeli\":33,\"hargasatuan\":\"45000\",\"hargadpp\":\"41210\",\"jumlahppn\":\"3790\",\"jumlahdiskon\":\"6750\",\"subtotalbeli\":\"1262250\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":15,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":null,\"hargadpp_po\":null,\"jumlahpph_po\":null,\"jumlahdiskon_po\":null,\"subtotalbeli_po\":null,\"diskonpersen1_po\":null,\"diskonpersen2_po\":null,\"diskonpersen3_po\":null}]','Budiman','2025-05-13 02:09:52','pembeliandetail','hapusData'),(1031,'{\"idpembelian\":\"250507BL0000001\",\"idsupplier\":\"SUPIMN0001\",\"nofaktur\":\"001\\/FAKTUR\",\"tglfaktur\":\"2025-05-07\",\"tglditerima\":\"2025-05-07\",\"keterangan\":\"Pembelian bahan mei periode 1\",\"inserted_date\":\"2025-05-07 16:14:47\",\"updated_date\":\"2025-05-07 16:43:38\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"PT. Intra Makmur\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"68250\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"58625\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"591750\",\"totaldpp\":\"601375\",\"nobilyetgiro\":null}','Budiman','2025-05-13 02:09:56','pembelian','hapusData'),(1032,'[{\"id\":59,\"idpembelian\":\"250507BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":15,\"hargasatuan\":\"14000\",\"hargadpp\":\"12633\",\"jumlahppn\":\"1367\",\"jumlahdiskon\":\"200\",\"subtotalbeli\":\"207000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":null,\"hargadpp_po\":null,\"jumlahpph_po\":null,\"jumlahdiskon_po\":null,\"subtotalbeli_po\":null,\"diskonpersen1_po\":null,\"diskonpersen2_po\":null,\"diskonpersen3_po\":null},{\"id\":60,\"idpembelian\":\"250507BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":10,\"hargasatuan\":\"45000\",\"hargadpp\":\"41188\",\"jumlahppn\":\"3812\",\"jumlahdiskon\":\"6525\",\"subtotalbeli\":\"384750\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":10,\"diskonpersen2\":5,\"diskonpersen3\":0,\"jumlahbeli_po\":null,\"hargadpp_po\":null,\"jumlahpph_po\":null,\"jumlahdiskon_po\":null,\"subtotalbeli_po\":null,\"diskonpersen1_po\":null,\"diskonpersen2_po\":null,\"diskonpersen3_po\":null}]','Budiman','2025-05-13 02:09:56','pembeliandetail','hapusData'),(1033,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPIMN0001\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Order barang ke PT Intra\",\"totaldpp_po\":\"810820\",\"totalppn_po\":\"89180\",\"totalfaktur_po\":\"900000\",\"inserted_date\":\"2025-05-13 02:55:07\",\"updated_date\":\"2025-05-13 02:55:07\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-13 02:55:07','pembelian','simpanData'),(1034,'[{\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli_po\":\"20\",\"hargasatuan_po\":\"45000\",\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"900000\"}]','Budiman','2025-05-13 02:55:07','pembeliandetail','simpanData'),(1035,'{\"lastlogin\":\"2025-05-13 10:41:36\"}','Budiman','2025-05-13 10:41:36','pengguna','updateData'),(1036,'{\"lastlogin\":\"2025-05-13 15:11:30\"}','Budiman','2025-05-13 15:11:30','pengguna','updateData'),(1037,'{\"idpembelian\":\"250513BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"test\",\"totaldpp_po\":\"445951\",\"totalppn_po\":\"49049\",\"totalfaktur_po\":\"495000\",\"inserted_date\":\"2025-05-13 15:21:08\",\"updated_date\":\"2025-05-13 15:21:08\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-13 15:21:08','pembelian','simpanData'),(1038,'[{\"idpembelian\":\"250513BL0000002\",\"idbarang\":\"K001000002\",\"jumlahbeli_po\":\"11\",\"hargasatuan_po\":\"45000\",\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"495000\"}]','Budiman','2025-05-13 15:21:08','pembeliandetail','simpanData'),(1039,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPIMN0001\",\"inserted_date\":\"2025-05-13 02:55:07\",\"updated_date\":\"2025-05-13 02:55:07\",\"totaldpp_po\":\"810820\",\"totalppn_po\":\"89180\",\"totalfaktur_po\":\"900000\",\"statuspenerimaan\":\"Belum Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Order barang ke PT Intra\",\"idpengguna_po\":\"USRBID0001\",\"nofaktur\":null,\"namasupplier\":\"PT. Intra Makmur\"}','Budiman','2025-05-13 15:21:57','pembelian','hapusData'),(1040,'[{\"id\":64,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":null,\"hargasatuan\":\"0\",\"hargadpp\":\"0\",\"jumlahppn\":\"0\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"0\",\"jenisdiskon\":null,\"diskonpersen1\":null,\"diskonpersen2\":null,\"diskonpersen3\":null,\"jumlahbeli_po\":20,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"900000\"}]','Budiman','2025-05-13 15:21:57','pembeliandetail','hapusData'),(1041,'{\"idpembelian\":\"250513BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"inserted_date\":\"2025-05-13 15:21:08\",\"updated_date\":\"2025-05-13 15:21:08\",\"totaldpp_po\":\"445951\",\"totalppn_po\":\"49049\",\"totalfaktur_po\":\"495000\",\"statuspenerimaan\":\"Belum Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"test\",\"idpengguna_po\":\"USRBID0001\",\"nofaktur\":null,\"namasupplier\":\"CV. MAJU BERSAMA\"}','Budiman','2025-05-13 15:26:44','pembelian','hapusData'),(1042,'[{\"id\":65,\"idpembelian\":\"250513BL0000002\",\"idbarang\":\"K001000002\",\"jumlahbeli\":0,\"hargasatuan\":\"0\",\"hargadpp\":\"0\",\"jumlahppn\":\"0\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"0\",\"jenisdiskon\":null,\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":11,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"495000\"}]','Budiman','2025-05-13 15:26:44','pembeliandetail','hapusData'),(1043,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"ppnpersen\":\"11\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Test\",\"totaldpp_po\":\"567574\",\"totalppn_po\":\"62426\",\"totalfaktur_po\":\"630000\",\"inserted_date\":\"2025-05-13 15:27:01\",\"updated_date\":\"2025-05-13 15:27:01\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-13 15:27:01','pembelian','simpanData'),(1044,'[{\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli_po\":\"14\",\"hargasatuan_po\":\"45000\",\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"}]','Budiman','2025-05-13 15:27:01','pembeliandetail','simpanData'),(1045,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"ppnpersen\":\"11\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Test 2\",\"totaldpp_po\":\"567574\",\"totalppn_po\":\"62426\",\"totalfaktur_po\":\"630000\",\"updated_date\":\"2025-05-13 15:29:48\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-13 15:29:48','pembelian','updateData'),(1046,'[{\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli_po\":\"14\",\"hargasatuan_po\":\"45000\",\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"}]','Budiman','2025-05-13 15:29:48','pembeliandetail','updateData'),(1047,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"ppnpersen\":\"11\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Test 2\",\"totaldpp_po\":\"693704\",\"totalppn_po\":\"76296\",\"totalfaktur_po\":\"770000\",\"updated_date\":\"2025-05-13 15:30:09\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-13 15:30:09','pembelian','updateData'),(1048,'[{\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli_po\":\"14\",\"hargasatuan_po\":\"45000\",\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"},{\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli_po\":\"10\",\"hargasatuan_po\":\"14000\",\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"}]','Budiman','2025-05-13 15:30:09','pembeliandetail','updateData'),(1049,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"ppnpersen\":\"11\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Test 2\",\"totaldpp_po\":\"693704\",\"totalppn_po\":\"76296\",\"totalfaktur_po\":\"770000\",\"updated_date\":\"2025-05-13 15:30:16\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-13 15:30:16','pembelian','updateData'),(1050,'[{\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli_po\":\"10\",\"hargasatuan_po\":\"14000\",\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"},{\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli_po\":\"14\",\"hargasatuan_po\":\"45000\",\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"}]','Budiman','2025-05-13 15:30:16','pembeliandetail','updateData'),(1051,'{\"idpembelian\":\"250513BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"ppnpersen\":\"11\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Pemesanan barang ke CV Maju\",\"totaldpp_po\":\"9009100\",\"totalppn_po\":\"990900\",\"totalfaktur_po\":\"10000000\",\"inserted_date\":\"2025-05-13 15:33:22\",\"updated_date\":\"2025-05-13 15:33:22\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-13 15:33:23','pembelian','simpanData'),(1052,'[{\"idpembelian\":\"250513BL0000002\",\"idbarang\":\"W001000001\",\"jumlahbeli_po\":\"100\",\"hargasatuan_po\":\"100000\",\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"10000000\"}]','Budiman','2025-05-13 15:33:23','pembeliandetail','simpanData'),(1053,'{\"lastlogin\":\"2025-05-14 06:04:16\"}','Budiman','2025-05-14 06:04:16','pengguna','updateData'),(1054,'{\"lastlogin\":\"2025-05-14 12:29:05\"}','Budiman','2025-05-14 12:29:05','pengguna','updateData'),(1055,'{\"lastlogin\":\"2025-05-14 14:43:12\"}','Budiman','2025-05-14 14:43:12','pengguna','updateData'),(1056,'{\"lastlogin\":\"2025-05-14 16:47:39\"}','Budiman','2025-05-14 16:47:39','pengguna','updateData'),(1057,'{\"lastlogin\":\"2025-05-15 01:50:01\"}','Budiman','2025-05-15 01:50:01','pengguna','updateData'),(1058,'{\"lastlogin\":\"2025-05-15 08:01:29\"}','Budiman','2025-05-15 08:01:29','pengguna','updateData'),(1059,'{\"idpembelian\":\"250513BL0000001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-05-14\",\"tglditerima\":\"2025-05-15\",\"idsupplier\":\"SUPMBD0001\",\"keterangan\":\"Test\",\"totaldpp\":\"1266420\",\"totaldiskon\":\"51890\",\"ppnpersen\":\"11\",\"totalppn\":\"133580\",\"totalfaktur\":\"1348110\",\"updated_date\":\"2025-05-15 08:36:11\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null,\"nobilyetgiro\":null,\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-15 08:36:11','pembelian','updateData'),(1060,'[{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"70\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"10\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12850\",\"jumlahppn\":\"1150\",\"jumlahdiskon\":\"2389\",\"subtotalbeli\":\"116110\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"3\"},{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"71\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"28\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40640\",\"jumlahppn\":\"4360\",\"jumlahdiskon\":\"1000\",\"subtotalbeli\":\"1232000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-15 08:36:11','pembeliandetail','updateData'),(1061,'{\"lastlogin\":\"2025-05-16 01:01:02\"}','Budiman','2025-05-16 01:01:02','pengguna','updateData'),(1062,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-05-14\",\"tglditerima\":\"2025-05-15\",\"keterangan\":\"Test\",\"inserted_date\":\"2025-05-13 15:27:01\",\"updated_date\":\"2025-05-15 08:36:11\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"51890\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"133580\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"1348110\",\"totaldpp\":\"1266420\",\"nobilyetgiro\":null}','Budiman','2025-05-16 01:17:37','pembelian','hapusPenerimaan'),(1063,'[{\"id\":70,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":10,\"hargasatuan\":\"14000\",\"hargadpp\":\"12850\",\"jumlahppn\":\"1150\",\"jumlahdiskon\":\"2389\",\"subtotalbeli\":\"116110\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":10,\"diskonpersen2\":5,\"diskonpersen3\":3,\"jumlahbeli_po\":10,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"},{\"id\":71,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":28,\"hargasatuan\":\"45000\",\"hargadpp\":\"40640\",\"jumlahppn\":\"4360\",\"jumlahdiskon\":\"1000\",\"subtotalbeli\":\"1232000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":14,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"}]','Budiman','2025-05-16 01:17:37','pembeliandetail','hapusPenerimaan'),(1064,'{\"idpembelian\":\"250513BL0000001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-05-16\",\"tglditerima\":\"2025-05-16\",\"idsupplier\":\"SUPMBD0001\",\"keterangan\":\"Test\",\"totaldpp\":\"6247104\",\"totaldiskon\":\"383980\",\"ppnpersen\":\"11\",\"totalppn\":\"644896\",\"totalfaktur\":\"6508020\",\"updated_date\":\"2025-05-16 02:00:05\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null,\"nobilyetgiro\":null,\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-16 02:00:05','pembelian','updateData'),(1065,'[{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"70\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"66\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12814\",\"jumlahppn\":\"1186\",\"jumlahdiskon\":\"2030\",\"subtotalbeli\":\"790020\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"5\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"71\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"22\",\"hargasatuan\":\"44000\",\"hargadpp\":\"39640\",\"jumlahppn\":\"4360\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"968000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000001\",\"iddetail\":null,\"idbarang\":\"W001000001\",\"jumlahbeli\":\"50\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90586\",\"jumlahppn\":\"9414\",\"jumlahdiskon\":\"5000\",\"subtotalbeli\":\"4750000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-16 02:00:05','pembeliandetail','updateData'),(1066,'{\"idpembelian\":\"250513BL0000002\",\"nofaktur\":\"04\\/2025\",\"tglfaktur\":\"2025-05-16\",\"tglditerima\":\"2025-05-16\",\"idsupplier\":\"SUPMBD0001\",\"keterangan\":\"Test\",\"totaldpp\":\"4504550\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"495450\",\"totalfaktur\":\"5000000\",\"updated_date\":\"2025-05-16 02:03:38\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":null,\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-16 02:03:39','pembelian','updateData'),(1067,'[{\"idpembelian\":\"250513BL0000002\",\"iddetail\":\"72\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"50\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"5000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-16 02:03:39','pembeliandetail','updateData'),(1068,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-05-16\",\"tglditerima\":\"2025-05-16\",\"keterangan\":\"Test\",\"inserted_date\":\"2025-05-13 15:27:01\",\"updated_date\":\"2025-05-16 02:00:05\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"383980\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"644896\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"6508020\",\"totaldpp\":\"6247104\",\"nobilyetgiro\":null}','Budiman','2025-05-16 02:05:01','pembelian','hapusPenerimaan'),(1069,'[{\"id\":70,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":66,\"hargasatuan\":\"14000\",\"hargadpp\":\"12814\",\"jumlahppn\":\"1186\",\"jumlahdiskon\":\"2030\",\"subtotalbeli\":\"790020\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":10,\"diskonpersen2\":5,\"diskonpersen3\":0,\"jumlahbeli_po\":10,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"},{\"id\":71,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":22,\"hargasatuan\":\"44000\",\"hargadpp\":\"39640\",\"jumlahppn\":\"4360\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"968000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":14,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"},{\"id\":73,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":50,\"hargasatuan\":\"100000\",\"hargadpp\":\"90586\",\"jumlahppn\":\"9414\",\"jumlahdiskon\":\"5000\",\"subtotalbeli\":\"4750000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":5,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":0,\"hargasatuan_po\":0,\"hargadpp_po\":\"0\",\"jumlahppn_po\":\"0\",\"subtotalbeli_po\":\"0\"}]','Budiman','2025-05-16 02:05:01','pembeliandetail','hapusPenerimaan'),(1070,'{\"idpembelian\":\"250513BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"04\\/2025\",\"tglfaktur\":\"2025-05-16\",\"tglditerima\":\"2025-05-16\",\"keterangan\":\"Test\",\"inserted_date\":\"2025-05-13 15:33:22\",\"updated_date\":\"2025-05-16 02:03:38\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"495450\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"5000000\",\"totaldpp\":\"4504550\",\"nobilyetgiro\":null}','Budiman','2025-05-16 02:44:29','pembelian','hapusPenerimaan'),(1071,'[{\"id\":72,\"idpembelian\":\"250513BL0000002\",\"idbarang\":\"W001000001\",\"jumlahbeli\":50,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"5000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":100,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"10000000\"}]','Budiman','2025-05-16 02:44:29','pembeliandetail','hapusPenerimaan'),(1072,'{\"idpembelian\":\"250513BL0000001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-05-16\",\"tglditerima\":\"2025-05-16\",\"idsupplier\":\"SUPMBD0001\",\"keterangan\":\"Test\",\"totaldpp\":\"693704\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"76296\",\"totalfaktur\":\"770000\",\"updated_date\":\"2025-05-16 02:49:49\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null,\"nobilyetgiro\":null,\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-16 02:49:49','pembelian','updateData'),(1073,'[{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"70\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"10\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"140000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"71\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"14\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"73\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"0\",\"hargasatuan\":\"0\",\"hargadpp\":\"0\",\"jumlahppn\":\"0\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"0\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-16 02:49:49','pembeliandetail','updateData'),(1074,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-05-16\",\"tglditerima\":\"2025-05-16\",\"keterangan\":\"Test\",\"inserted_date\":\"2025-05-13 15:27:01\",\"updated_date\":\"2025-05-16 02:49:49\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"76296\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"770000\",\"totaldpp\":\"693704\",\"nobilyetgiro\":null}','Budiman','2025-05-16 02:49:53','pembelian','hapusPenerimaan'),(1075,'[{\"id\":70,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":10,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"140000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":10,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"},{\"id\":71,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":14,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":14,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"},{\"id\":73,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":0,\"hargasatuan\":\"0\",\"hargadpp\":\"0\",\"jumlahppn\":\"0\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"0\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":0,\"hargasatuan_po\":0,\"hargadpp_po\":\"0\",\"jumlahppn_po\":\"0\",\"subtotalbeli_po\":\"0\"}]','Budiman','2025-05-16 02:49:53','pembeliandetail','hapusPenerimaan'),(1076,'{\"idpembelian\":\"250513BL0000001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-05-16\",\"tglditerima\":\"2025-05-16\",\"idsupplier\":\"SUPMBD0001\",\"keterangan\":\"test\",\"totaldpp\":\"885624\",\"totaldiskon\":\"27475\",\"ppnpersen\":\"11\",\"totalppn\":\"94376\",\"totalfaktur\":\"952525\",\"updated_date\":\"2025-05-16 02:50:51\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":null,\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-16 02:50:51','pembelian','updateData'),(1077,'[{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"70\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"25\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12722\",\"jumlahppn\":\"1278\",\"jumlahdiskon\":\"1099\",\"subtotalbeli\":\"322525\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"3\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"71\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"14\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-16 02:50:51','pembeliandetail','updateData'),(1078,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-05-16\",\"tglditerima\":\"2025-05-16\",\"keterangan\":\"test\",\"inserted_date\":\"2025-05-13 15:27:01\",\"updated_date\":\"2025-05-16 02:50:51\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"27475\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"94376\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"952525\",\"totaldpp\":\"885624\",\"nobilyetgiro\":null}','Budiman','2025-05-16 02:52:01','pembelian','hapusPenerimaan'),(1079,'[{\"id\":70,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":25,\"hargasatuan\":\"14000\",\"hargadpp\":\"12722\",\"jumlahppn\":\"1278\",\"jumlahdiskon\":\"1099\",\"subtotalbeli\":\"322525\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":5,\"diskonpersen2\":3,\"diskonpersen3\":0,\"jumlahbeli_po\":10,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"},{\"id\":71,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":14,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":14,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"}]','Budiman','2025-05-16 02:52:01','pembeliandetail','hapusPenerimaan'),(1080,'{\"idpembelian\":\"250513BL0000001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-05-16\",\"tglditerima\":\"2025-05-16\",\"idsupplier\":\"SUPMBD0001\",\"keterangan\":\"Test\",\"totaldpp\":\"857591\",\"totaldiskon\":\"53784\",\"ppnpersen\":\"11\",\"totalppn\":\"88409\",\"totalfaktur\":\"892216\",\"updated_date\":\"2025-05-16 02:53:23\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":null,\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-16 02:53:23','pembelian','updateData'),(1081,'[{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"70\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"15\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12633\",\"jumlahppn\":\"1367\",\"jumlahdiskon\":\"200\",\"subtotalbeli\":\"207000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"71\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"16\",\"hargasatuan\":\"46000\",\"hargadpp\":\"41756\",\"jumlahppn\":\"4244\",\"jumlahdiskon\":\"3174\",\"subtotalbeli\":\"685216\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"2\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-16 02:53:23','pembeliandetail','updateData'),(1082,'{\"lastlogin\":\"2025-05-19 02:36:58\"}','Budiman','2025-05-19 02:36:58','pengguna','updateData'),(1083,'{\"idpembelian\":\"250513BL0000002\",\"nofaktur\":\"04\\/2025\",\"tglfaktur\":\"2025-05-19\",\"tglditerima\":\"2025-05-19\",\"idsupplier\":\"SUPMBD0001\",\"keterangan\":\"Test\",\"totaldpp\":\"2135171\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"234829\",\"totalfaktur\":\"2370000\",\"updated_date\":\"2025-05-19 04:55:38\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null,\"nobilyetgiro\":null,\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-19 04:55:38','pembelian','penerimaanPembelian'),(1084,'[{\"idpembelian\":\"250513BL0000002\",\"iddetail\":\"72\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"16\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"1600000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000002\",\"iddetail\":null,\"idbarang\":\"K001000001\",\"jumlahbeli\":\"55\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"770000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-19 04:55:38','pembeliandetail','penerimaanPembelian'),(1085,'{\"idpengguna\":\"USRTQS0001\",\"namapengguna\":\"test\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"34124123432423\",\"emailpengguna\":null,\"fotopengguna\":null,\"username\":\"test\",\"password\":\"$2y$12$MDRCOBbaMCAIFHe3dWW2E.0jUSv6zc.qy0JharoYZOesqtQ5MKXhS\",\"idotorisasi\":\"KL001\",\"inserted_date\":\"2025-05-19 06:46:27\",\"updated_date\":\"2025-05-19 06:46:27\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-19 06:46:28','pengguna','simpanData'),(1086,'{\"idpengguna\":\"USRTJA0001\",\"namapengguna\":\"test2\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"43434343\",\"emailpengguna\":null,\"fotopengguna\":null,\"username\":\"test2123\",\"password\":\"$2y$12$0DnzHx9czO.dJJ.tRGCnV.NhA1dm3dg7t4BEb0hTOcXk4eakiglsC\",\"idotorisasi\":\"AA001\",\"inserted_date\":\"2025-05-19 06:47:18\",\"updated_date\":\"2025-05-19 06:47:18\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-19 06:47:19','pengguna','simpanData'),(1087,'{\"idpengguna\":\"USRTQS0001\",\"namapengguna\":\"test\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"34124123432423\",\"emailpengguna\":null,\"fotopengguna\":null,\"username\":\"test\",\"password\":\"$2y$12$MDRCOBbaMCAIFHe3dWW2E.0jUSv6zc.qy0JharoYZOesqtQ5MKXhS\",\"idotorisasi\":\"KL001\",\"inserted_date\":\"2025-05-19 06:46:27\",\"updated_date\":\"2025-05-19 06:46:27\",\"statusaktif\":\"Aktif\",\"namaotorisasi\":\"Kasir\",\"lastlogin\":null}','Budiman','2025-05-19 06:47:26','pengguna','hapusData'),(1088,'{\"idpengguna\":\"USRTJA0001\",\"namapengguna\":\"test2\",\"jeniskelamin\":\"Laki-laki\",\"notelppengguna\":\"43434343\",\"emailpengguna\":null,\"fotopengguna\":null,\"username\":\"test2123\",\"password\":\"$2y$12$0DnzHx9czO.dJJ.tRGCnV.NhA1dm3dg7t4BEb0hTOcXk4eakiglsC\",\"idotorisasi\":\"AA001\",\"inserted_date\":\"2025-05-19 06:47:18\",\"updated_date\":\"2025-05-19 06:47:18\",\"statusaktif\":\"Aktif\",\"namaotorisasi\":\"Admin\",\"lastlogin\":null}','Budiman','2025-05-19 06:47:31','pengguna','hapusData'),(1089,'{\"lastlogin\":\"2025-05-20 00:57:34\"}','Budiman','2025-05-20 00:57:34','pengguna','updateData'),(1090,'{\"prefix\":\"default_piutang_konsumen\",\"values\":\"50000000\",\"inserted_date\":\"2025-05-20 02:06:07\",\"updated_date\":\"2025-05-20 02:06:07\",\"deskripsi\":\"Jumlah default piutang konsumen\"}','Budiman','2025-05-20 02:06:07','settings','simpanData'),(1091,'{\"lastlogin\":\"2025-05-20 02:06:55\"}','Budiman','2025-05-20 02:06:55','pengguna','updateData'),(1092,'{\"idkonsumen\":\"BWP001\",\"namakonsumen\":\"Budi Warsono\",\"notelpkonsumen\":\"08545002155\",\"alamatkonsumen\":\"Jl. Pendidikan\",\"emailkonsumen\":null,\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"idwilayah\":\"003\",\"npwp\":\"546545121215454\",\"limitkredit\":\"50000000\",\"inserted_date\":\"2025-05-20 03:47:15\",\"updated_date\":\"2025-05-20 03:47:15\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-20 03:47:15','konsumen','simpanData'),(1093,'{\"idkonsumen\":\"BWP001\",\"namakonsumen\":\"Budi Warsono\",\"notelpkonsumen\":\"08545002155\",\"alamatkonsumen\":\"Jl. Pendidikan\",\"emailkonsumen\":null,\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"idwilayah\":\"003\",\"npwp\":\"546545121215454\",\"limitkredit\":\"150000000\",\"updated_date\":\"2025-05-20 03:48:26\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-20 03:48:26','konsumen','updateData'),(1094,'{\"idkonsumen\":\"BWP001\",\"namakonsumen\":\"Budi Warsono\",\"alamatkonsumen\":\"Jl. Pendidikan\",\"notelpkonsumen\":\"08545002155\",\"emailkonsumen\":null,\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"saldo\":\"0\",\"idwilayah\":\"003\",\"saldopajak\":\"0\",\"inserted_date\":\"2025-05-20 03:47:15\",\"updated_date\":\"2025-05-20 03:48:26\",\"statusaktif\":\"Aktif\",\"npwp\":\"546545121215454\",\"limitkredit\":\"150000000\",\"jumlahpiutang\":\"0\",\"kdakunpiutang\":null,\"namawilayah\":\"Sanggau\",\"namaakunpiutang\":null}','Budiman','2025-05-20 04:04:33','konsumen','hapusData'),(1095,'{\"idkonsumen\":\"BWR001\",\"namakonsumen\":\"Budi Warsono\",\"notelpkonsumen\":\"0812000000\",\"alamatkonsumen\":\"Jl. Pemuda\",\"emailkonsumen\":null,\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"idwilayah\":\"003\",\"npwp\":\"546465456545454\",\"limitkredit\":\"150000000\",\"inserted_date\":\"2025-05-20 04:05:10\",\"updated_date\":\"2025-05-20 04:05:10\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-20 04:05:10','konsumen','simpanData'),(1096,'{\"idkonsumen\":\"BWR001\",\"namakonsumen\":\"Budi Warsono\",\"notelpkonsumen\":\"0812000000\",\"alamatkonsumen\":\"Jl. Pemuda\",\"emailkonsumen\":null,\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"idwilayah\":\"003\",\"npwp\":\"546465456545454\",\"limitkredit\":\"140000000\",\"updated_date\":\"2025-05-20 04:05:26\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-20 04:05:26','konsumen','updateData'),(1097,'{\"idkonsumen\":\"BWR001\",\"namakonsumen\":\"Budi Warsono\",\"notelpkonsumen\":\"0812000000\",\"alamatkonsumen\":\"Jl. Pemuda\",\"emailkonsumen\":null,\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"idwilayah\":\"003\",\"npwp\":\"546465456545454\",\"limitkredit\":\"130000000\",\"updated_date\":\"2025-05-20 04:05:56\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-20 04:05:56','konsumen','updateData'),(1098,'{\"idkonsumen\":\"BWR001\",\"namakonsumen\":\"CV. Berkat\",\"notelpkonsumen\":\"0812000000\",\"alamatkonsumen\":\"Jl. Pemuda\",\"emailkonsumen\":null,\"nikpemilik\":\"7898797989879798\",\"namapemilik\":\"Dadang\",\"notelppemilik\":\"081500000\",\"nowapemilik\":\"081500000\",\"idwilayah\":\"003\",\"npwp\":\"546465456545454\",\"limitkredit\":\"130000000\",\"updated_date\":\"2025-05-20 04:08:20\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-20 04:08:20','konsumen','updateData'),(1099,'{\"lastlogin\":\"2025-05-20 13:35:24\"}','Budiman','2025-05-20 13:35:24','pengguna','updateData'),(1100,'{\"prefix\":\"akun_piutang_konsumen\",\"values\":\"1.1.03\",\"inserted_date\":\"2025-05-20 13:45:19\",\"updated_date\":\"2025-05-20 13:45:19\",\"deskripsi\":\"Akun header piutang konsumen untuk filter di select 2\"}','Budiman','2025-05-20 13:45:19','settings','simpanData'),(1101,'{\"lastlogin\":\"2025-05-20 13:49:35\"}','Budiman','2025-05-20 13:49:35','pengguna','updateData'),(1102,'{\"idkonsumen\":\"ISO001\",\"namakonsumen\":\"PT. Indrapura\",\"notelpkonsumen\":\"081200010100\",\"alamatkonsumen\":\"Jl. Pendidikan\",\"emailkonsumen\":null,\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"idwilayah\":\"002\",\"npwp\":\"929283371781277\",\"limitkredit\":\"50000000\",\"kdakunpiutang\":\"1.1.03.01\",\"inserted_date\":\"2025-05-20 14:02:28\",\"updated_date\":\"2025-05-20 14:02:28\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-20 14:02:28','konsumen','simpanData'),(1103,'{\"idkonsumen\":\"ISO001\",\"namakonsumen\":\"PT. Indrapura\",\"notelpkonsumen\":\"081200010100\",\"alamatkonsumen\":\"Jl. Pendidikan 2\",\"emailkonsumen\":null,\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"idwilayah\":\"002\",\"npwp\":\"929283371781277\",\"limitkredit\":\"50000000\",\"kdakunpiutang\":\"1.1.03.01\",\"updated_date\":\"2025-05-20 14:04:43\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-20 14:04:43','konsumen','updateData'),(1104,'{\"idkonsumen\":\"ISO001\",\"namakonsumen\":\"PT. Indrapura\",\"notelpkonsumen\":\"081200010100\",\"alamatkonsumen\":\"Jl. Pendidikan 2\",\"emailkonsumen\":null,\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"idwilayah\":\"002\",\"npwp\":\"929283371781277\",\"limitkredit\":\"50000000\",\"kdakunpiutang\":\"1.1.03.01\",\"updated_date\":\"2025-05-20 14:04:51\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-20 14:04:51','konsumen','updateData'),(1105,'{\"prefix\":\"default_target_sales\",\"values\":\"100000000\",\"inserted_date\":\"2025-05-20 14:16:41\",\"updated_date\":\"2025-05-20 14:16:41\",\"deskripsi\":\"Default target penjualan sales\"}','Budiman','2025-05-20 14:16:41','settings','simpanData'),(1106,'{\"lastlogin\":\"2025-05-20 14:17:29\"}','Budiman','2025-05-20 14:17:29','pengguna','updateData'),(1107,'{\"idsales\":\"SLSJMQ0001\",\"namasales\":\"Jaja Miharga\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3243243243242342\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-01-01\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"0812000000\",\"email\":\"NULL\",\"npwp\":\"829182198291919\",\"tglkontrak\":\"2025-05-20\",\"filekontrak\":null,\"inserted_date\":\"2025-05-20 14:23:33\",\"updated_date\":\"2025-05-20 14:23:33\",\"statusaktif\":\"Aktif\",\"targetpenjualan\":\"120000000\"}','Budiman','2025-05-20 14:23:33','sales','simpanData'),(1108,'{\"idsales\":\"SLSJMQ0001\",\"namasales\":\"Jaja Miharga\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3243243243242342\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-01-01\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"0812000000\",\"email\":\"NULL\",\"npwp\":\"829182198291919\",\"tglkontrak\":\"2025-05-20\",\"filekontrak\":null,\"updated_date\":\"2025-05-20 14:23:45\",\"statusaktif\":\"Aktif\",\"targetpenjualan\":\"120000000\"}','Budiman','2025-05-20 14:23:45','sales','updateData'),(1109,'{\"idsales\":\"SLSKES0001\",\"namasales\":\"Khairuddin\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"1234444555566666\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-03-13\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Pemuda\",\"alamattinggal\":\"Jl. Pelangi\",\"statusperkawinan\":\"Tidak Kawin\",\"nowa\":\"08135553330000\",\"email\":\"khairuddin@gmail.com\",\"npwp\":\"123456789012345\",\"tglkontrak\":\"2025-03-13\",\"filekontrak\":null,\"updated_date\":\"2025-05-20 14:24:00\",\"statusaktif\":\"Aktif\",\"targetpenjualan\":\"100000000\"}','Budiman','2025-05-20 14:24:00','sales','updateData'),(1110,'{\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"jeniskelamin\":\"Perempuan\",\"nik\":\"1111111111111111\",\"tempatlahir\":\"Jakarta\",\"tgllahir\":\"2000-12-02\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"081302500000000\",\"email\":\"siti@gmail.com\",\"npwp\":\"456456456456456\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"mbarang.xls\",\"updated_date\":\"2025-05-20 14:24:08\",\"statusaktif\":\"Aktif\",\"targetpenjualan\":\"100000000\"}','Budiman','2025-05-20 14:24:08','sales','updateData'),(1111,'{\"prefix\":\"akun_utang_supplier\",\"values\":\"2.2.01\",\"inserted_date\":\"2025-05-20 14:32:56\",\"updated_date\":\"2025-05-20 14:32:56\",\"deskripsi\":\"Kode parent akun utang supplier\"}','Budiman','2025-05-20 14:32:57','settings','simpanData'),(1112,'{\"lastlogin\":\"2025-05-20 14:33:11\"}','Budiman','2025-05-20 14:33:11','pengguna','updateData'),(1113,'{\"idsupplier\":\"SUPHPV0001\",\"namasupplier\":\"PT. Husada Prima\",\"npwp\":\"829182918218299\",\"alamatsupplier\":\"Jl. Pahlawan\",\"kontakperson\":\"Jojon\",\"notelp\":\"081200000000\",\"email\":null,\"inserted_date\":\"2025-05-20 14:37:01\",\"updated_date\":\"2025-05-20 14:37:01\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-20 14:37:01','supplier','simpanData'),(1114,'{\"idsupplier\":\"SUPHPV0001\",\"namasupplier\":\"PT. Husada Prima\",\"alamatsupplier\":\"Jl. Pahlawan\",\"kontakperson\":\"Jojon\",\"notelp\":\"081200000000\",\"email\":null,\"saldo\":\"0\",\"saldopajak\":\"0\",\"inserted_date\":\"2025-05-20 14:37:01\",\"updated_date\":\"2025-05-20 14:37:01\",\"statusaktif\":\"Aktif\",\"npwp\":\"829182918218299\",\"kdakunutang\":null,\"namaakunutang\":null}','Budiman','2025-05-20 14:46:08','supplier','hapusData'),(1115,'{\"idsupplier\":\"SUPHPI0001\",\"namasupplier\":\"PT. Husada Prima\",\"npwp\":\"189812918291219\",\"alamatsupplier\":\"Jl. Pahlawan\",\"kontakperson\":\"Jojon\",\"notelp\":\"081200000000\",\"email\":null,\"inserted_date\":\"2025-05-20 14:46:40\",\"updated_date\":\"2025-05-20 14:46:40\",\"statusaktif\":\"Aktif\",\"kdakunutang\":\"2.2.01.01\"}','Budiman','2025-05-20 14:46:40','supplier','simpanData'),(1116,'{\"idsupplier\":\"SUPHPI0001\",\"namasupplier\":\"PT. Husada Prima\",\"npwp\":\"189812918291219\",\"alamatsupplier\":\"Jl. Pahlawan 2\",\"kontakperson\":\"Jojon\",\"notelp\":\"081200000000\",\"email\":null,\"updated_date\":\"2025-05-20 14:46:54\",\"statusaktif\":\"Aktif\",\"kdakunutang\":\"2.2.01.01\"}','Budiman','2025-05-20 14:46:54','supplier','updateData'),(1117,'{\"idsupplier\":\"SUPHPI0001\",\"namasupplier\":\"PT. Husada Prima\",\"npwp\":\"189812918291219\",\"alamatsupplier\":\"Jl. Pahlawan 2\",\"kontakperson\":\"Jojon\",\"notelp\":\"081200000000\",\"email\":null,\"updated_date\":\"2025-05-20 14:47:05\",\"statusaktif\":\"Aktif\",\"kdakunutang\":\"2.2.01.01\"}','Budiman','2025-05-20 14:47:05','supplier','updateData'),(1118,'{\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"npwp\":\"154865223157545\",\"alamatsupplier\":\"Jl. Kebangkitan\",\"kontakperson\":\"Rudi\",\"notelp\":\"081200000000000\",\"email\":\"rudi@gmail.com\",\"updated_date\":\"2025-05-20 14:47:21\",\"statusaktif\":\"Aktif\",\"kdakunutang\":\"2.2.01.01\"}','Budiman','2025-05-20 14:47:21','supplier','updateData'),(1119,'{\"idsupplier\":\"SUPIMN0001\",\"namasupplier\":\"PT. Intra Makmur\",\"npwp\":\"545215789625452\",\"alamatsupplier\":\"Jl. Pemuda\",\"kontakperson\":\"Bambang\",\"notelp\":\"081300000\",\"email\":\"bambang@gmail.com\",\"updated_date\":\"2025-05-20 14:47:30\",\"statusaktif\":\"Aktif\",\"kdakunutang\":\"2.2.01.01\"}','Budiman','2025-05-20 14:47:30','supplier','updateData'),(1120,'{\"idsupplier\":\"SUPMUF0001\",\"namasupplier\":\"PT. MILPO\",\"npwp\":\"829292888999988\",\"alamatsupplier\":\"Jakarta\",\"kontakperson\":\"Bpk. Tomi\",\"notelp\":\"081200000000\",\"email\":\"tomi@gmail.com\",\"updated_date\":\"2025-05-20 14:47:37\",\"statusaktif\":\"Aktif\",\"kdakunutang\":\"2.2.01.01\"}','Budiman','2025-05-20 14:47:37','supplier','updateData'),(1121,'{\"idsupplier\":\"SUPMUF0001\",\"namasupplier\":\"PT. MILPO\",\"npwp\":\"829292888999988\",\"alamatsupplier\":\"Jakarta\",\"kontakperson\":\"Bpk. Tomi\",\"notelp\":\"081200000000\",\"email\":\"tomi@gmail.com\",\"updated_date\":\"2025-05-20 14:47:53\",\"statusaktif\":\"Aktif\",\"kdakunutang\":\"2.2.01.01\"}','Budiman','2025-05-20 14:47:53','supplier','updateData'),(1122,'{\"kdakun\":\"2.1.01.01\",\"namaakun\":\"Utang Usaha (Ekspedisi)\",\"updated_date\":\"2025-05-20 14:53:48\"}','Budiman','2025-05-20 14:53:48','akun','updateData'),(1123,'{\"prefix\":\"akun_utang_ekspedisi\",\"values\":\"2.1.01\",\"inserted_date\":\"2025-05-20 15:00:09\",\"updated_date\":\"2025-05-20 15:00:09\",\"deskripsi\":\"Kode header akun utang ekspedisi\"}','Budiman','2025-05-20 15:00:09','settings','simpanData'),(1124,'{\"lastlogin\":\"2025-05-20 15:00:46\"}','Budiman','2025-05-20 15:00:46','pengguna','updateData'),(1125,'{\"idekspedisi\":\"EKSNXEX001\",\"namaekspedisi\":\"PT. Telex Intra\",\"notelpekspedisi\":\"08128990000000\",\"alamatekspedisi\":\"Jl. Kemayoran\",\"emailekspedisi\":null,\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"inserted_date\":\"2025-05-20 15:01:32\",\"updated_date\":\"2025-05-20 15:01:32\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-20 15:01:32','ekspedisi','simpanData'),(1126,'{\"idekspedisi\":\"EKSNXEX001\",\"namaekspedisi\":\"PT. Telex Intra\",\"alamatekspedisi\":\"Jl. Kemayoran\",\"notelpekspedisi\":\"08128990000000\",\"emailekspedisi\":null,\"nikpemilik\":null,\"namapemilik\":null,\"notelppemilik\":null,\"nowapemilik\":null,\"inserted_date\":\"2025-05-20 15:01:32\",\"updated_date\":\"2025-05-20 15:01:32\",\"statusaktif\":\"Aktif\",\"kdakunutang\":null,\"namaakunutang\":null}','Budiman','2025-05-20 15:04:30','ekspedisi','hapusData'),(1127,'{\"idekspedisi\":\"EKSKFSD001\",\"namaekspedisi\":\"PT. Telex Nusantara\",\"notelpekspedisi\":\"0651668888\",\"alamatekspedisi\":\"Jl. A yani\",\"emailekspedisi\":null,\"nikpemilik\":\"1829189289182918\",\"namapemilik\":\"Rudi\",\"notelppemilik\":\"081200000111\",\"nowapemilik\":\"081200000111\",\"inserted_date\":\"2025-05-20 15:05:19\",\"updated_date\":\"2025-05-20 15:05:19\",\"statusaktif\":\"Aktif\",\"kdakunutang\":\"2.1.01.01\"}','Budiman','2025-05-20 15:05:19','ekspedisi','simpanData'),(1128,'{\"idekspedisi\":\"EKSKFSD001\",\"namaekspedisi\":\"PT. Telex Nusantara\",\"notelpekspedisi\":\"0651668888\",\"alamatekspedisi\":\"Jl. A yani 2\",\"emailekspedisi\":null,\"nikpemilik\":\"1829189289182918\",\"namapemilik\":\"Rudi\",\"notelppemilik\":\"081200000111\",\"nowapemilik\":\"081200000111\",\"updated_date\":\"2025-05-20 15:06:34\",\"statusaktif\":\"Aktif\",\"kdakunutang\":\"2.1.01.01\"}','Budiman','2025-05-20 15:06:34','ekspedisi','updateData'),(1129,'{\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\",\"notelpekspedisi\":\"0812005522200\",\"alamatekspedisi\":\"Jl. Pemuda Gg.Pahlawan No.1 Kec.Pontianak Kota\",\"emailekspedisi\":\"jnt@gmail.com\",\"nikpemilik\":\"2365545121215855\",\"namapemilik\":\"Wawan Susanto\",\"notelppemilik\":\"081521202222\",\"nowapemilik\":\"081521202222\",\"updated_date\":\"2025-05-20 15:07:15\",\"statusaktif\":\"Aktif\",\"kdakunutang\":\"2.1.01.01\"}','Budiman','2025-05-20 15:07:16','ekspedisi','updateData'),(1130,'{\"idekspedisi\":\"EKSPWRU001\",\"namaekspedisi\":\"Pos Indonesia\",\"notelpekspedisi\":\"08125121212\",\"alamatekspedisi\":\"Jl. Karya Wisata No.22 Kec. Pontianak Timur\",\"emailekspedisi\":\"posindonesia@gmail.com\",\"nikpemilik\":\"1287485121212121\",\"namapemilik\":\"Susi\",\"notelppemilik\":\"0812005121552\",\"nowapemilik\":\"0812005121552\",\"updated_date\":\"2025-05-20 15:07:24\",\"statusaktif\":\"Aktif\",\"kdakunutang\":\"2.1.01.01\"}','Budiman','2025-05-20 15:07:24','ekspedisi','updateData'),(1131,'{\"idpembelian\":\"250513BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"04\\/2025\",\"tglfaktur\":\"2025-05-19\",\"tglditerima\":\"2025-05-19\",\"keterangan\":\"Test\",\"inserted_date\":\"2025-05-13 15:33:22\",\"updated_date\":\"2025-05-19 04:55:38\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"234829\",\"biayapengiriman\":\"0\",\"totalfaktur\":\"2370000\",\"totaldpp\":\"2135171\",\"nobilyetgiro\":null,\"totaldpp_po\":\"9009100\",\"totalppn_po\":\"990900\",\"totalfaktur_po\":\"10000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Pemesanan barang ke CV Maju\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-20 16:51:58','pembelian','hapusPenerimaan'),(1132,'[{\"id\":72,\"idpembelian\":\"250513BL0000002\",\"idbarang\":\"W001000001\",\"jumlahbeli\":16,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"1600000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":100,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"10000000\"},{\"id\":74,\"idpembelian\":\"250513BL0000002\",\"idbarang\":\"K001000001\",\"jumlahbeli\":55,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"770000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":0,\"hargasatuan_po\":0,\"hargadpp_po\":\"0\",\"jumlahppn_po\":\"0\",\"subtotalbeli_po\":\"0\"}]','Budiman','2025-05-20 16:51:58','pembeliandetail','hapusPenerimaan'),(1133,'{\"idpembelian\":\"250513BL0000002\",\"nofaktur\":\"112\\/FK\\/2025\",\"tglfaktur\":\"2025-05-20\",\"tglditerima\":\"2025-05-20\",\"idsupplier\":\"SUPMBD0001\",\"keterangan\":\"Tets\",\"totaldpp\":\"2297340\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"252660\",\"totalfaktur\":\"2550000\",\"updated_date\":\"2025-05-20 17:01:13\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":\"89283293920\",\"tglbilyetgiro\":\"2025-05-21\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-20 17:01:13','pembelian','penerimaanPembelian'),(1134,'[{\"idpembelian\":\"250513BL0000002\",\"iddetail\":\"72\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"15\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"1500000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000002\",\"iddetail\":null,\"idbarang\":\"K001000001\",\"jumlahbeli\":\"75\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"1050000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-20 17:01:13','pembeliandetail','penerimaanPembelian'),(1135,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"02\\/2025\",\"tglfaktur\":\"2025-05-16\",\"tglditerima\":\"2025-05-16\",\"keterangan\":\"Test\",\"inserted_date\":\"2025-05-13 15:27:01\",\"updated_date\":\"2025-05-16 02:53:23\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"53784\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"88409\",\"biayapengiriman\":\"0\",\"jumlahpotongan\":\"0\",\"totalfaktur\":\"892216\",\"totaldpp\":\"857591\",\"nobilyetgiro\":null,\"totaldpp_po\":\"693704\",\"totalppn_po\":\"76296\",\"totalfaktur_po\":\"770000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Test 2\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-20 17:05:18','pembelian','hapusPenerimaan'),(1136,'[{\"id\":70,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":15,\"hargasatuan\":\"14000\",\"hargadpp\":\"12633\",\"jumlahppn\":\"1367\",\"jumlahdiskon\":\"200\",\"subtotalbeli\":\"207000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":10,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"},{\"id\":71,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":16,\"hargasatuan\":\"46000\",\"hargadpp\":\"41756\",\"jumlahppn\":\"4244\",\"jumlahdiskon\":\"3174\",\"subtotalbeli\":\"685216\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":5,\"diskonpersen2\":2,\"diskonpersen3\":0,\"jumlahbeli_po\":14,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"}]','Budiman','2025-05-20 17:05:18','pembeliandetail','hapusPenerimaan'),(1137,'{\"idpembelian\":\"250513BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"112\\/FK\\/2025\",\"tglfaktur\":\"2025-05-20\",\"tglditerima\":\"2025-05-20\",\"keterangan\":\"Tets\",\"inserted_date\":\"2025-05-13 15:33:22\",\"updated_date\":\"2025-05-20 17:01:13\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"252660\",\"biayapengiriman\":\"0\",\"jumlahpotongan\":\"0\",\"totalfaktur\":\"2550000\",\"totaldpp\":\"2297340\",\"nobilyetgiro\":\"89283293920\",\"totaldpp_po\":\"9009100\",\"totalppn_po\":\"990900\",\"totalfaktur_po\":\"10000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Pemesanan barang ke CV Maju\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-20 17:05:28','pembelian','hapusPenerimaan'),(1138,'[{\"id\":72,\"idpembelian\":\"250513BL0000002\",\"idbarang\":\"W001000001\",\"jumlahbeli\":15,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"1500000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":100,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"10000000\"},{\"id\":75,\"idpembelian\":\"250513BL0000002\",\"idbarang\":\"K001000001\",\"jumlahbeli\":75,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"1050000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":0,\"hargasatuan_po\":0,\"hargadpp_po\":\"0\",\"jumlahppn_po\":\"0\",\"subtotalbeli_po\":\"0\"}]','Budiman','2025-05-20 17:05:28','pembeliandetail','hapusPenerimaan'),(1139,'{\"idpembelian\":\"250513BL0000001\",\"nofaktur\":\"565\\/FF\\/2025\",\"tglfaktur\":\"2025-05-20\",\"tglditerima\":\"2025-05-20\",\"idsupplier\":\"SUPMBD0001\",\"keterangan\":\"Penerimaan barang papan dan kayu\",\"totaldpp\":\"693704\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"76296\",\"totalpotongan\":\"70000\",\"totalfaktur\":\"700000\",\"biayapengiriman\":\"50000\",\"updated_date\":\"2025-05-20 17:18:14\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":\"ER323222\",\"tglbilyetgiro\":\"2025-05-20\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-20 17:18:14','pembelian','penerimaanPembelian'),(1140,'[{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"70\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"10\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"140000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"71\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"14\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-20 17:18:14','pembeliandetail','penerimaanPembelian'),(1141,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"565\\/FF\\/2025\",\"tglfaktur\":\"2025-05-20\",\"tglditerima\":\"2025-05-20\",\"keterangan\":\"Penerimaan barang papan dan kayu\",\"inserted_date\":\"2025-05-13 15:27:01\",\"updated_date\":\"2025-05-20 17:18:14\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"76296\",\"biayapengiriman\":\"50000\",\"totalpotongan\":\"70000\",\"totalfaktur\":\"700000\",\"totaldpp\":\"693704\",\"nobilyetgiro\":\"ER323222\",\"totaldpp_po\":\"693704\",\"totalppn_po\":\"76296\",\"totalfaktur_po\":\"770000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Test 2\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-20 17:53:56','pembelian','hapusPenerimaan'),(1142,'[{\"id\":70,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":10,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"140000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":10,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"},{\"id\":71,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":14,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":14,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"}]','Budiman','2025-05-20 17:53:56','pembeliandetail','hapusPenerimaan'),(1143,'{\"idhutangekspedisi\":\"250521HEX000001\",\"idtransaksi\":\"250513BL0000001\",\"tglhutang\":\"2025-05-20\",\"idsupplier\":\"SUPMBD0001\",\"debet\":0,\"kredit\":\"25000\",\"keterangan\":\"Hutang ekspedisi dengan No. Faktur 777\\/FF\\/2025\",\"jenissumber\":\"Pembelian\",\"jenis\":\"Hutang\"}','Budiman','2025-05-20 17:57:12','hutangekspedisi','penerimaanPembelian'),(1144,'{\"idpembelian\":\"250513BL0000001\",\"nofaktur\":\"777\\/FF\\/2025\",\"tglfaktur\":\"2025-05-20\",\"tglditerima\":\"2025-05-20\",\"idsupplier\":\"SUPMBD0001\",\"keterangan\":\"Penerimaan barang\",\"totaldpp\":\"693704\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"76296\",\"totalpotongan\":\"70000\",\"totalfaktur\":\"700000\",\"biayapengiriman\":\"25000\",\"updated_date\":\"2025-05-20 17:57:12\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":\"221212121\",\"tglbilyetgiro\":\"2025-05-20\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-20 17:57:12','pembelian','penerimaanPembelian'),(1145,'[{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"70\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"10\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"140000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"71\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"14\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-20 17:57:12','pembeliandetail','penerimaanPembelian'),(1146,'{\"idhutangekspedisi\":\"250521HEX000001\",\"idtransaksi\":\"250513BL0000001\",\"tglhutang\":\"2025-05-20\",\"idsupplier\":\"SUPMBD0001\",\"debet\":\"0\",\"kredit\":\"25000\",\"jenissumber\":\"Pembelian\",\"keterangan\":\"Hutang ekspedisi dengan No. Faktur 777\\/FF\\/2025\",\"carabayar\":null,\"idbank\":null,\"jenis\":\"Hutang\",\"nobilyetgiro\":null}','Budiman','2025-05-20 17:58:24','hutangekspedisi','hapusPenerimaan'),(1147,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"777\\/FF\\/2025\",\"tglfaktur\":\"2025-05-20\",\"tglditerima\":\"2025-05-20\",\"keterangan\":\"Penerimaan barang\",\"inserted_date\":\"2025-05-13 15:27:01\",\"updated_date\":\"2025-05-20 17:57:12\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"76296\",\"biayapengiriman\":\"25000\",\"totalpotongan\":\"70000\",\"totalfaktur\":\"700000\",\"totaldpp\":\"693704\",\"nobilyetgiro\":\"221212121\",\"totaldpp_po\":\"693704\",\"totalppn_po\":\"76296\",\"totalfaktur_po\":\"770000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Test 2\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-20 17:58:24','pembelian','hapusPenerimaan'),(1148,'[{\"id\":70,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":10,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"140000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":10,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"},{\"id\":71,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":14,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":14,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"}]','Budiman','2025-05-20 17:58:24','pembeliandetail','hapusPenerimaan'),(1149,'{\"idhutangekspedisi\":\"250521HEX000001\",\"idtransaksi\":\"250513BL0000001\",\"tglhutang\":\"2025-05-20\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":0,\"kredit\":\"50000\",\"keterangan\":\"Hutang ekspedisi dengan No. Faktur 2121\\/FF\\/2025\",\"jenissumber\":\"Pembelian\",\"jenis\":\"Hutang\"}','Budiman','2025-05-20 18:37:30','hutangekspedisi','penerimaanPembelian'),(1150,'{\"idpembelian\":\"250513BL0000001\",\"nofaktur\":\"2121\\/FF\\/2025\",\"tglfaktur\":\"2025-05-20\",\"tglditerima\":\"2025-05-20\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSOHRR001\",\"keterangan\":\"Penerimaan Barang\",\"totaldpp\":\"1828874\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"201126\",\"totalpotongan\":\"30000\",\"totalfaktur\":\"2000000\",\"biayapengiriman\":\"50000\",\"updated_date\":\"2025-05-20 18:37:30\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":\"2121111\",\"tglbilyetgiro\":\"2025-05-20\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-20 18:37:30','pembelian','penerimaanPembelian'),(1151,'[{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"70\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"100\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"1400000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"71\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"14\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-20 18:37:30','pembeliandetail','penerimaanPembelian'),(1152,'{\"idhutangekspedisi\":\"250521HEX000001\",\"idtransaksi\":\"250513BL0000001\",\"tglhutang\":\"2025-05-20\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"0\",\"kredit\":\"50000\",\"jenissumber\":\"Pembelian\",\"keterangan\":\"Hutang ekspedisi dengan No. Faktur 2121\\/FF\\/2025\",\"carabayar\":null,\"idbank\":null,\"jenis\":\"Hutang\",\"nobilyetgiro\":null}','Budiman','2025-05-20 18:38:40','hutangekspedisi','hapusPenerimaan'),(1153,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"2121\\/FF\\/2025\",\"tglfaktur\":\"2025-05-20\",\"tglditerima\":\"2025-05-20\",\"keterangan\":\"Penerimaan Barang\",\"inserted_date\":\"2025-05-13 15:27:01\",\"updated_date\":\"2025-05-20 18:37:30\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"201126\",\"biayapengiriman\":\"50000\",\"totalpotongan\":\"30000\",\"totalfaktur\":\"2000000\",\"totaldpp\":\"1828874\",\"nobilyetgiro\":\"2121111\",\"totaldpp_po\":\"693704\",\"totalppn_po\":\"76296\",\"totalfaktur_po\":\"770000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Test 2\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\"}','Budiman','2025-05-20 18:38:40','pembelian','hapusPenerimaan'),(1154,'[{\"id\":70,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":100,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"1400000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":10,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"},{\"id\":71,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":14,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":14,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"}]','Budiman','2025-05-20 18:38:40','pembeliandetail','hapusPenerimaan'),(1155,'{\"lastlogin\":\"2025-05-21 01:23:29\"}','Budiman','2025-05-21 01:23:29','pengguna','updateData'),(1156,'{\"idhutangekspedisi\":\"250521HEX000001\",\"idtransaksi\":\"250513BL0000001\",\"tglhutang\":\"2025-05-21\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":0,\"kredit\":\"75000\",\"keterangan\":\"Hutang ekspedisi dengan No. Faktur 455\\/FF\\/2025\",\"jenissumber\":\"Pembelian\",\"jenis\":\"Hutang\"}','Budiman','2025-05-21 01:41:23','hutangekspedisi','penerimaanPembelian'),(1157,'{\"idpembelian\":\"250513BL0000001\",\"nofaktur\":\"455\\/FF\\/2025\",\"tglfaktur\":\"2025-05-21\",\"tglditerima\":\"2025-05-21\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSOHRR001\",\"keterangan\":\"Penerimaan barang\",\"totaldpp\":\"845060\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"92940\",\"totalpotongan\":\"25000\",\"totalfaktur\":\"913000\",\"biayapengiriman\":\"75000\",\"updated_date\":\"2025-05-21 01:41:22\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":\"42343242343242\",\"tglbilyetgiro\":\"2025-05-21\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-21 01:41:23','pembelian','penerimaanPembelian'),(1158,'[{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"70\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"22\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"308000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250513BL0000001\",\"iddetail\":\"71\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"14\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-21 01:41:23','pembeliandetail','penerimaanPembelian'),(1159,'{\"idreturpembelian\":\"250521RB0000001\",\"idpembelian\":\"250513BL0000001\",\"tglpengajuan\":\"2025-05-21\",\"totalretur\":90000,\"keterangan\":\"Barang nya rusak\",\"inserted_date\":\"2025-05-21 01:50:27\",\"updated_date\":\"2025-05-21 01:50:27\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\"}','Budiman','2025-05-21 01:50:27','returpembelian','simpanData'),(1160,'[{\"idreturpembelian\":\"250521RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":\"2\",\"hargaretur\":\"45000\",\"subtotalretur\":\"90000\"}]','Budiman','2025-05-21 01:50:27','returpembeliandetail','simpanData'),(1161,'{\"idpembelian\":\"250513BL0000002\",\"nofaktur\":\"545\\/FF\",\"tglfaktur\":\"2025-05-21\",\"tglditerima\":\"2025-05-21\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSOHRR001\",\"keterangan\":\"Penerimaan barang\",\"totaldpp\":\"9009100\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"990900\",\"totalpotongan\":\"50000\",\"totalfaktur\":\"9950000\",\"biayapengiriman\":0,\"updated_date\":\"2025-05-21 02:55:29\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"nobilyetgiro\":null,\"tglbilyetgiro\":\"2025-05-21\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-21 02:55:29','pembelian','penerimaanPembelian'),(1162,'[{\"idpembelian\":\"250513BL0000002\",\"iddetail\":\"72\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"100\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"10000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-21 02:55:29','pembeliandetail','penerimaanPembelian'),(1163,'{\"lastlogin\":\"2025-05-21 12:27:37\"}','Budiman','2025-05-21 12:27:37','pengguna','updateData'),(1164,'{\"idsuratjalan\":\"250512SJ01\",\"tglsuratjalan\":\"2025-05-12\",\"idkonsumen\":\"KUE001\",\"namakonsumen\":\"CV. Karya Utama\",\"idjenisekspedisi\":\"001\",\"namajenisekspedisi\":\"Darat\",\"idekspedisi\":\"EKSPWRU001\",\"namaekspedisi\":\"Pos Indonesia\",\"identitasekspedisi\":\"KB2433FF\",\"biayapengiriman\":\"100000\",\"daftarnoinvoice\":\"SJA\\/2505\\/000003\"}','Budiman','2025-05-21 12:46:43','suratjalan','hapusData'),(1165,'[{\"iddetailsuratjalan\":34,\"idsuratjalan\":\"250512SJ01\",\"idpenjualan\":\"250505JL0000003\"}]','Budiman','2025-05-21 12:46:43','suratjalandetail','hapusData'),(1166,'[{\"idsuratjalanrincian\":11,\"idsuratjalan\":\"250512SJ01\",\"qty\":1,\"satuan\":\"KG\",\"keterangan\":\"KEterangan\"}]','Budiman','2025-05-21 12:46:43','suratjalanrincian','hapusData'),(1167,'{\"idsuratjalan\":\"250511SJ01\",\"tglsuratjalan\":\"2025-05-11\",\"idkonsumen\":\"IPJ001\",\"namakonsumen\":\"PT. Intrajaya\",\"idjenisekspedisi\":\"002\",\"namajenisekspedisi\":\"Laut\",\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\",\"identitasekspedisi\":\"Hati Hati Barang Pecah Belah\",\"biayapengiriman\":\"250000\",\"daftarnoinvoice\":\"SJA\\/2505\\/000002 & SJA\\/2505\\/000001\"}','Budiman','2025-05-21 12:46:48','suratjalan','hapusData'),(1168,'[{\"iddetailsuratjalan\":35,\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000002\"},{\"iddetailsuratjalan\":36,\"idsuratjalan\":\"250511SJ01\",\"idpenjualan\":\"250505JL0000001\"}]','Budiman','2025-05-21 12:46:48','suratjalandetail','hapusData'),(1169,'[{\"idsuratjalanrincian\":12,\"idsuratjalan\":\"250511SJ01\",\"qty\":2,\"satuan\":\"Kol\",\"keterangan\":\"Barang BLACKFOOT, HYPER, DAN AFTA\"}]','Budiman','2025-05-21 12:46:48','suratjalanrincian','hapusData'),(1170,'{\"idreturpenjualan\":\"250510RJ0000001\",\"idpenjualan\":\"250505JL0000002\",\"tglretur\":\"2025-05-10\",\"totalretur\":\"480000\",\"keterangan\":\"Pipa bocor\",\"inserted_date\":\"2025-05-10 05:55:55\",\"updated_date\":\"2025-05-10 05:55:55\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-05-05\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"namakonsumen\":\"PT. Intrajaya\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-05-21 12:46:55','returpenjualan','hapusData'),(1171,'[{\"idreturdetail\":8,\"idreturpenjualan\":\"250510RJ0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":10,\"hargaretur\":\"48000\",\"subtotalretur\":\"480000\"}]','Budiman','2025-05-21 12:46:55','returpenjualandetail','hapusData'),(1172,'{\"idpiutangdetail\":\"250510PI0001002\",\"idpiutang\":\"250510PI0001\",\"tglpiutang\":\"2025-05-10\",\"debet\":\"0\",\"kredit\":\"1245480\",\"inserted_date\":\"2025-05-10 05:50:55\",\"updated_date\":\"2025-05-10 05:50:55\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250510JL0000001\",\"idjenispiutang\":\"P02\",\"namapengguna\":\"Budiman\",\"namabank\":\"May Bank\",\"nokwitansi\":\"250510JL0000001#01\",\"nobilyetgiro\":null}','Budiman','2025-05-21 12:47:05','piutangdetail','hapusData'),(1173,'{\"idpiutangdetail\":\"250505PI0001002\",\"idpiutang\":\"250505PI0001\",\"tglpiutang\":\"2025-05-07\",\"debet\":\"0\",\"kredit\":\"612600\",\"inserted_date\":\"2025-05-07 17:25:34\",\"updated_date\":\"2025-05-07 17:25:34\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250505JL0000001\",\"idjenispiutang\":\"P02\",\"namapengguna\":\"Budiman\",\"namabank\":\"May Bank\",\"nokwitansi\":\"250505JL0000001#01\",\"nobilyetgiro\":\"645\\/BILYET\"}','Budiman','2025-05-21 12:47:13','piutangdetail','hapusData'),(1174,'{\"idpenjualan\":\"250505JL0000001\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-05-05\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"keterangan\":\"Test Penjualan\",\"totalpenjualan\":\"0\",\"totaldpp\":\"644300\",\"totaldiskon\":\"92400\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"60700\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"612600\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-05 13:12:36\",\"updated_date\":\"2025-05-05 13:24:45\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null,\"nobilyetgiro\":null,\"namakonsumen\":\"PT. Intrajaya\",\"idwilayah\":\"001\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Siti Khadizah\",\"namajenispiutang\":\"Middle\",\"jatuhtempo\":45,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Pontianak\"}','Budiman','2025-05-21 12:48:35','penjualan','hapusData'),(1175,'[{\"id\":67,\"idpenjualan\":\"250505JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":10,\"hargasatuan\":\"48000\",\"hargadpp\":\"44159\",\"jumlahppn\":\"3841\",\"jumlahdiskon\":\"9240\",\"subtotaljual\":\"387600\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":15,\"diskonpersen2\":5,\"diskonpersen3\":0},{\"id\":68,\"idpenjualan\":\"250505JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":15,\"hargasatuan\":\"15000\",\"hargadpp\":\"13514\",\"jumlahppn\":\"1486\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"225000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-21 12:48:35','penjualandetail','hapusData'),(1176,'{\"idpenjualan\":\"250505JL0000002\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-05-05\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"keterangan\":\"Penjualan tunai\",\"totalpenjualan\":\"0\",\"totaldpp\":\"433430\",\"totaldiskon\":\"10000\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"46570\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"470000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-05 13:29:26\",\"updated_date\":\"2025-05-05 13:29:26\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250505JL0000002#01\",\"nobilyetgiro\":null,\"namakonsumen\":\"PT. Intrajaya\",\"idwilayah\":\"001\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Siti Khadizah\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Pontianak\"}','Budiman','2025-05-21 12:48:40','penjualan','hapusData'),(1177,'[{\"id\":69,\"idpenjualan\":\"250505JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":10,\"hargasatuan\":\"48000\",\"hargadpp\":\"43343\",\"jumlahppn\":\"4657\",\"jumlahdiskon\":\"1000\",\"subtotaljual\":\"470000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-21 12:48:40','penjualandetail','hapusData'),(1178,'{\"idpenjualan\":\"250505JL0000003\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-05-05\",\"noinvoice\":\"SJA\\/2505\\/000003\",\"keterangan\":\"tests\",\"totalpenjualan\":\"0\",\"totaldpp\":\"874380\",\"totaldiskon\":\"96000\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"85620\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"864000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-05 14:28:03\",\"updated_date\":\"2025-05-05 14:57:39\",\"carabayar\":\"Giro\",\"idbank\":\"BN001\",\"idjenispiutang\":null,\"idsales\":\"SLSKES0001\",\"nokwitansi\":\"250505JL0000003#03\",\"nobilyetgiro\":\"1122334455\",\"namakonsumen\":\"CV. Karya Utama\",\"idwilayah\":\"002\",\"namabank\":\"May Bank\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"atasnama\":\"Budi Santoso\",\"namasales\":\"Khairuddin\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Singkawang\"}','Budiman','2025-05-21 12:48:45','penjualan','hapusData'),(1179,'[{\"id\":74,\"idpenjualan\":\"250505JL0000003\",\"idbarang\":\"K001000002\",\"jumlahjual\":20,\"hargasatuan\":\"48000\",\"hargadpp\":\"43719\",\"jumlahppn\":\"4281\",\"jumlahdiskon\":\"4800\",\"subtotaljual\":\"864000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":10,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-21 12:48:45','penjualandetail','hapusData'),(1180,'{\"idpenjualan\":\"250510JL0000001\",\"idkonsumen\":\"SKE001\",\"tglinvoice\":\"2025-05-10\",\"noinvoice\":\"SJA\\/2505\\/000004\",\"keterangan\":\"-\",\"totalpenjualan\":\"0\",\"totaldpp\":\"1316580\",\"totaldiskon\":\"194520\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"123420\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"1245480\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-10 05:38:51\",\"updated_date\":\"2025-05-10 05:38:51\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P02\",\"idsales\":\"SLSKES0001\",\"nokwitansi\":null,\"nobilyetgiro\":null,\"namakonsumen\":\"Sinar Kobar\",\"idwilayah\":\"003\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Khairuddin\",\"namajenispiutang\":\"Middle\",\"jatuhtempo\":45,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Sanggau\"}','Budiman','2025-05-21 12:48:50','penjualan','hapusData'),(1181,'[{\"id\":75,\"idpenjualan\":\"250510JL0000001\",\"idbarang\":\"W001000001\",\"jumlahjual\":10,\"hargasatuan\":\"120000\",\"hargadpp\":\"110036\",\"jumlahppn\":\"9964\",\"jumlahdiskon\":\"19452\",\"subtotaljual\":\"1005480\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":10,\"diskonpersen2\":5,\"diskonpersen3\":2},{\"id\":76,\"idpenjualan\":\"250510JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":5,\"hargasatuan\":\"48000\",\"hargadpp\":\"43244\",\"jumlahppn\":\"4756\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"240000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-21 12:48:50','penjualandetail','hapusData'),(1182,'{\"idpenjualan\":\"250521JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"tglinvoice\":\"2025-04-21\",\"keterangan\":\"Penjualan\",\"totaldpp\":\"4767120\",\"totaldiskon\":\"376800\",\"ppnpersen\":\"11\",\"totalppn\":\"482880\",\"totalinvoice\":\"4873200\",\"inserted_date\":\"2025-05-21 14:07:46\",\"updated_date\":\"2025-05-21 14:07:46\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":null,\"nobilyetgiro\":null}','Budiman','2025-05-21 14:07:46','penjualan','simpanData'),(1183,'[{\"idpenjualan\":\"250521JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"100\",\"hargasatuan\":\"48000\",\"hargadpp\":\"43617\",\"jumlahppn\":\"4383\",\"jumlahdiskon\":\"3768\",\"subtotaljual\":\"4423200\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"3\",\"diskonpersen3\":\"0\"},{\"idpenjualan\":\"250521JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"30\",\"hargasatuan\":\"15000\",\"hargadpp\":\"13514\",\"jumlahppn\":\"1486\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"450000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-21 14:07:46','penjualandetail','simpanData'),(1184,'{\"idpenjualan\":\"250521JL0000002\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"tglinvoice\":\"2025-05-21\",\"keterangan\":\"Penjujalan 2\",\"totaldpp\":\"432440\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"47560\",\"totalinvoice\":\"480000\",\"inserted_date\":\"2025-05-21 14:09:28\",\"updated_date\":\"2025-05-21 14:09:28\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":null,\"nobilyetgiro\":null}','Budiman','2025-05-21 14:09:28','penjualan','simpanData'),(1185,'[{\"idpenjualan\":\"250521JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"10\",\"hargasatuan\":\"48000\",\"hargadpp\":\"43244\",\"jumlahppn\":\"4756\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"480000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-21 14:09:28','penjualandetail','simpanData'),(1186,'{\"idpenjualan\":\"250521JL0000002\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-05-21\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"keterangan\":\"Penjujalan 2\",\"totalpenjualan\":\"0\",\"totaldpp\":\"432440\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"47560\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"480000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-21 14:09:28\",\"updated_date\":\"2025-05-21 14:09:28\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":null,\"nobilyetgiro\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idwilayah\":\"002\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Jaja Miharga\",\"namajenispiutang\":\"Fast\",\"jatuhtempo\":7,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Singkawang\"}','Budiman','2025-05-21 14:10:47','penjualan','hapusData'),(1187,'[{\"id\":79,\"idpenjualan\":\"250521JL0000002\",\"idbarang\":\"K001000002\",\"jumlahjual\":10,\"hargasatuan\":\"48000\",\"hargadpp\":\"43244\",\"jumlahppn\":\"4756\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"480000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-21 14:10:47','penjualandetail','hapusData'),(1188,'{\"idpiutangdetail\":\"250521PI0001002\",\"idpiutang\":\"250521PI0001\",\"tglpiutang\":\"2025-05-22\",\"debet\":0,\"kredit\":\"4873200\",\"inserted_date\":\"2025-05-22 02:32:23\",\"updated_date\":\"2025-05-22 02:32:23\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250521JL0000001#01\"}','Budiman','2025-05-22 02:32:23','piutangdetail','simpanData'),(1189,'{\"idpenjualan\":\"250522JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"tglinvoice\":\"2025-05-22\",\"keterangan\":\"Penjualan\",\"totaldpp\":\"30541180\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"3358820\",\"totalinvoice\":\"33900000\",\"inserted_date\":\"2025-05-22 02:35:24\",\"updated_date\":\"2025-05-22 02:35:24\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P01\",\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":null,\"nobilyetgiro\":null}','Budiman','2025-05-22 02:35:24','penjualan','simpanData'),(1190,'[{\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"500\",\"hargasatuan\":\"15000\",\"hargadpp\":\"13514\",\"jumlahppn\":\"1486\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"7500000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"500\",\"hargasatuan\":\"48000\",\"hargadpp\":\"43244\",\"jumlahppn\":\"4756\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"24000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"W001000001\",\"jumlahjual\":\"20\",\"hargasatuan\":\"120000\",\"hargadpp\":\"108109\",\"jumlahppn\":\"11891\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"2400000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 02:35:24','penjualandetail','simpanData'),(1191,'{\"idpenjualan\":\"250522JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-05-22\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"keterangan\":\"Penjualan\",\"totalpenjualan\":\"0\",\"totaldpp\":\"30541180\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"3358820\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"33900000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-22 02:35:24\",\"updated_date\":\"2025-05-22 02:35:24\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P01\",\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":null,\"nobilyetgiro\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idwilayah\":\"002\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Jaja Miharga\",\"namajenispiutang\":\"Slow\",\"jatuhtempo\":90,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Singkawang\"}','Budiman','2025-05-22 03:03:15','penjualan','hapusData'),(1192,'[{\"id\":80,\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":500,\"hargasatuan\":\"15000\",\"hargadpp\":\"13514\",\"jumlahppn\":\"1486\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"7500000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0},{\"id\":81,\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":500,\"hargasatuan\":\"48000\",\"hargadpp\":\"43244\",\"jumlahppn\":\"4756\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"24000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0},{\"id\":82,\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"W001000001\",\"jumlahjual\":20,\"hargasatuan\":\"120000\",\"hargadpp\":\"108109\",\"jumlahppn\":\"11891\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"2400000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-22 03:03:15','penjualandetail','hapusData'),(1193,'{\"idpiutangdetail\":\"250521PI0001002\",\"idpiutang\":\"250521PI0001\",\"tglpiutang\":\"2025-05-22\",\"debet\":\"0\",\"kredit\":\"4873200\",\"inserted_date\":\"2025-05-22 02:32:23\",\"updated_date\":\"2025-05-22 02:32:23\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250521JL0000001\",\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"nokwitansi\":\"250521JL0000001#01\",\"nobilyetgiro\":null}','Budiman','2025-05-22 03:04:06','piutangdetail','hapusData'),(1194,'{\"idpenjualan\":\"250521JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-04-21\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"keterangan\":\"Penjualan\",\"totalpenjualan\":\"0\",\"totaldpp\":\"4767120\",\"totaldiskon\":\"376800\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"482880\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"4873200\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-21 14:07:46\",\"updated_date\":\"2025-05-21 14:07:46\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":null,\"nobilyetgiro\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idwilayah\":\"002\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Jaja Miharga\",\"namajenispiutang\":\"Fast\",\"jatuhtempo\":7,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Singkawang\"}','Budiman','2025-05-22 03:04:56','penjualan','hapusData'),(1195,'[{\"id\":77,\"idpenjualan\":\"250521JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":100,\"hargasatuan\":\"48000\",\"hargadpp\":\"43617\",\"jumlahppn\":\"4383\",\"jumlahdiskon\":\"3768\",\"subtotaljual\":\"4423200\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":5,\"diskonpersen2\":3,\"diskonpersen3\":0},{\"id\":78,\"idpenjualan\":\"250521JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":30,\"hargasatuan\":\"15000\",\"hargadpp\":\"13514\",\"jumlahppn\":\"1486\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"450000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0}]','Budiman','2025-05-22 03:04:56','penjualandetail','hapusData'),(1196,'{\"idpenjualan\":\"250522JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"tglinvoice\":\"2025-05-22\",\"keterangan\":\"Penjualan piutang\",\"totaldpp\":\"10904200\",\"totaldiskon\":\"942000\",\"ppnpersen\":\"11\",\"totalppn\":\"1095800\",\"totalinvoice\":\"11058000\",\"inserted_date\":\"2025-05-22 03:06:20\",\"updated_date\":\"2025-05-22 03:06:20\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":null,\"nobilyetgiro\":null}','Budiman','2025-05-22 03:06:20','penjualan','simpanData'),(1197,'[{\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"W001000001\",\"jumlahjual\":\"100\",\"hargasatuan\":\"120000\",\"hargadpp\":\"109042\",\"jumlahppn\":\"10958\",\"jumlahdiskon\":\"9420\",\"subtotaljual\":\"11058000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"3\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 03:06:20','penjualandetail','simpanData'),(1198,'{\"idpenjualan\":\"250522JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"tglinvoice\":\"2025-05-22\",\"keterangan\":\"Penjualan piutang\",\"totaldpp\":\"10904200\",\"totaldiskon\":\"942000\",\"ppnpersen\":\"11\",\"totalppn\":\"1095800\",\"totalinvoice\":\"11058000\",\"updated_date\":\"2025-05-22 03:08:55\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":null,\"nobilyetgiro\":null}','Budiman','2025-05-22 03:08:55','penjualan','updateData'),(1199,'[{\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"W001000001\",\"jumlahjual\":\"100\",\"hargasatuan\":\"120000\",\"hargadpp\":\"109042\",\"jumlahppn\":\"10958\",\"jumlahdiskon\":\"9420\",\"subtotaljual\":\"11058000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"3\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 03:08:55','penjualandetail','updateData'),(1200,'{\"idpenjualan\":\"250522JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"tglinvoice\":\"2025-05-22\",\"keterangan\":\"Penjualan piutang\",\"totaldpp\":\"19627600\",\"totaldiskon\":\"1695600\",\"ppnpersen\":\"11\",\"totalppn\":\"1972400\",\"totalinvoice\":\"19904400\",\"updated_date\":\"2025-05-22 03:10:00\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":null,\"nobilyetgiro\":null}','Budiman','2025-05-22 03:10:00','penjualan','updateData'),(1201,'[{\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"W001000001\",\"jumlahjual\":\"100\",\"hargasatuan\":\"120000\",\"hargadpp\":\"109042\",\"jumlahppn\":\"10958\",\"jumlahdiskon\":\"9420\",\"subtotaljual\":\"11058000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"3\",\"diskonpersen3\":\"0\"},{\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":\"200\",\"hargasatuan\":\"48000\",\"hargadpp\":\"43617\",\"jumlahppn\":\"4383\",\"jumlahdiskon\":\"3768\",\"subtotaljual\":\"8846400\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"3\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 03:10:00','penjualandetail','updateData'),(1202,'{\"idpenjualan\":\"250522JL0000002\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"tglinvoice\":\"2025-05-22\",\"keterangan\":\"Penjualan\",\"totaldpp\":\"13631000\",\"totaldiskon\":\"1177000\",\"ppnpersen\":\"11\",\"totalppn\":\"1369000\",\"totalinvoice\":\"13823000\",\"inserted_date\":\"2025-05-22 03:20:34\",\"updated_date\":\"2025-05-22 03:20:34\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":\"250522JL0000002#01\",\"nobilyetgiro\":null}','Budiman','2025-05-22 03:20:34','penjualan','simpanData'),(1203,'[{\"idpenjualan\":\"250522JL0000002\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"1000\",\"hargasatuan\":\"15000\",\"hargadpp\":\"13631\",\"jumlahppn\":\"1369\",\"jumlahdiskon\":\"1177\",\"subtotaljual\":\"13823000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"5\",\"diskonpersen2\":\"3\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 03:20:34','penjualandetail','simpanData'),(1204,'{\"prefix\":\"stok_penjualan_dari_surat_jalan\",\"values\":\"1\",\"inserted_date\":\"2025-05-22 04:22:56\",\"updated_date\":\"2025-05-22 04:22:56\",\"deskripsi\":\"Stok barang akan berkurang ketika ada surat jalan (1= Ya, 0=Tidak)\"}','Budiman','2025-05-22 04:22:57','settings','simpanData'),(1205,'{\"lastlogin\":\"2025-05-22 05:28:19\"}','Budiman','2025-05-22 05:28:19','pengguna','updateData'),(1206,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"ppnpersen\":\"11\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Test\",\"totaldpp_po\":\"405410000\",\"totalppn_po\":\"44590000\",\"totalfaktur_po\":\"450000000\",\"inserted_date\":\"2025-05-22 06:00:54\",\"updated_date\":\"2025-05-22 06:00:54\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-22 06:00:54','pembelian','simpanData'),(1207,'[{\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli_po\":\"10000\",\"hargasatuan_po\":\"45000\",\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"450000000\"}]','Budiman','2025-05-22 06:00:54','pembeliandetail','simpanData'),(1208,'{\"idpembelian\":\"250522BL0000001\",\"nofaktur\":\"1212\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSPWRU001\",\"keterangan\":\"Test\",\"totaldpp\":\"405410000\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"44590000\",\"totalpotongan\":\"0\",\"totalfaktur\":\"450000000\",\"biayapengiriman\":0,\"updated_date\":\"2025-05-22 06:01:13\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"tglbilyetgiro\":\"2025-05-22\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-22 06:01:13','pembelian','penerimaanPembelian'),(1209,'[{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"76\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"10000\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"450000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 06:01:13','pembeliandetail','penerimaanPembelian'),(1210,'{\"idpenjualan\":\"250522JL0000001\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-05-22\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"keterangan\":\"Penjualan piutang\",\"totalpenjualan\":\"0\",\"totaldpp\":\"19627600\",\"totaldiskon\":\"1695600\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"1972400\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"19904400\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-22 03:06:20\",\"updated_date\":\"2025-05-22 03:10:00\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":null,\"nobilyetgiro\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idwilayah\":\"002\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Jaja Miharga\",\"namajenispiutang\":\"Fast\",\"jatuhtempo\":7,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Singkawang\"}','Budiman','2025-05-22 06:43:19','penjualan','hapusData'),(1211,'[{\"id\":85,\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"W001000001\",\"jumlahjual\":100,\"hargasatuan\":\"120000\",\"hargadpp\":\"109042\",\"jumlahppn\":\"10958\",\"jumlahdiskon\":\"9420\",\"subtotaljual\":\"11058000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":5,\"diskonpersen2\":3,\"diskonpersen3\":0},{\"id\":86,\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"K001000002\",\"jumlahjual\":200,\"hargasatuan\":\"48000\",\"hargadpp\":\"43617\",\"jumlahppn\":\"4383\",\"jumlahdiskon\":\"3768\",\"subtotaljual\":\"8846400\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":5,\"diskonpersen2\":3,\"diskonpersen3\":0}]','Budiman','2025-05-22 06:43:19','penjualandetail','hapusData'),(1212,'{\"idpenjualan\":\"250522JL0000002\",\"idkonsumen\":\"KUE001\",\"tglinvoice\":\"2025-05-22\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"keterangan\":\"Penjualan\",\"totalpenjualan\":\"0\",\"totaldpp\":\"13631000\",\"totaldiskon\":\"1177000\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"1369000\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"13823000\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-22 03:20:34\",\"updated_date\":\"2025-05-22 03:20:34\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":\"250522JL0000002#01\",\"nobilyetgiro\":null,\"namakonsumen\":\"CV. Karya Utama\",\"idwilayah\":\"002\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Jaja Miharga\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Singkawang\"}','Budiman','2025-05-22 06:43:24','penjualan','hapusData'),(1213,'[{\"id\":87,\"idpenjualan\":\"250522JL0000002\",\"idbarang\":\"K001000001\",\"jumlahjual\":1000,\"hargasatuan\":\"15000\",\"hargadpp\":\"13631\",\"jumlahppn\":\"1369\",\"jumlahdiskon\":\"1177\",\"subtotaljual\":\"13823000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":5,\"diskonpersen2\":3,\"diskonpersen3\":0}]','Budiman','2025-05-22 06:43:24','penjualandetail','hapusData'),(1214,'{\"idreturpembelian\":\"250521RB0000001\",\"idpembelian\":\"250513BL0000001\",\"tglretur\":null,\"totalretur\":\"90000\",\"keterangan\":\"Barang nya rusak\",\"inserted_date\":\"2025-05-21 01:50:27\",\"updated_date\":\"2025-05-21 01:50:27\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\",\"tglpengajuan\":\"2025-05-21\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"kdakunbank\":null,\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"tglfaktur\":\"2025-05-21\",\"nofaktur\":\"455\\/FF\\/2025\"}','Budiman','2025-05-22 06:43:33','returpembelian','hapusData'),(1215,'[{\"idreturdetail\":13,\"idreturpembelian\":\"250521RB0000001\",\"idbarang\":\"K001000002\",\"jumlahretur\":2,\"hargaretur\":\"45000\",\"subtotalretur\":\"90000\"}]','Budiman','2025-05-22 06:43:33','returpembeliandetail','hapusData'),(1216,'{\"idhutangekspedisi\":\"250521HEX000001\",\"idtransaksi\":\"250513BL0000001\",\"tglhutang\":\"2025-05-21\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"0\",\"kredit\":\"75000\",\"jenissumber\":\"Pembelian\",\"keterangan\":\"Hutang ekspedisi dengan No. Faktur 455\\/FF\\/2025\",\"carabayar\":null,\"idbank\":null,\"jenis\":\"Hutang\",\"nobilyetgiro\":null}','Budiman','2025-05-22 06:43:47','hutangekspedisi','hapusPenerimaan'),(1217,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"455\\/FF\\/2025\",\"tglfaktur\":\"2025-05-21\",\"tglditerima\":\"2025-05-21\",\"keterangan\":\"Penerimaan barang\",\"inserted_date\":\"2025-05-13 15:27:01\",\"updated_date\":\"2025-05-21 01:41:22\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"92940\",\"biayapengiriman\":\"75000\",\"totalpotongan\":\"25000\",\"totalfaktur\":\"913000\",\"totaldpp\":\"845060\",\"nobilyetgiro\":\"42343242343242\",\"totaldpp_po\":\"693704\",\"totalppn_po\":\"76296\",\"totalfaktur_po\":\"770000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Test 2\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\"}','Budiman','2025-05-22 06:43:47','pembelian','hapusPenerimaan'),(1218,'[{\"id\":70,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":22,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"308000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":10,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"},{\"id\":71,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":14,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"630000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":14,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"}]','Budiman','2025-05-22 06:43:47','pembeliandetail','hapusPenerimaan'),(1219,'{\"idpembelian\":\"250513BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"545\\/FF\",\"tglfaktur\":\"2025-05-21\",\"tglditerima\":\"2025-05-21\",\"keterangan\":\"Penerimaan barang\",\"inserted_date\":\"2025-05-13 15:33:22\",\"updated_date\":\"2025-05-21 02:55:29\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Transfer\",\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"atasnama\":\"Budi Santoso\",\"kdakunbank\":\"1.1.01.03\",\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"990900\",\"biayapengiriman\":\"0\",\"totalpotongan\":\"50000\",\"totalfaktur\":\"9950000\",\"totaldpp\":\"9009100\",\"nobilyetgiro\":null,\"totaldpp_po\":\"9009100\",\"totalppn_po\":\"990900\",\"totalfaktur_po\":\"10000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Pemesanan barang ke CV Maju\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\"}','Budiman','2025-05-22 06:43:51','pembelian','hapusPenerimaan'),(1220,'[{\"id\":72,\"idpembelian\":\"250513BL0000002\",\"idbarang\":\"W001000001\",\"jumlahbeli\":100,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"10000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":100,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"10000000\"}]','Budiman','2025-05-22 06:43:51','pembeliandetail','hapusPenerimaan'),(1221,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"1212\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"keterangan\":\"Test\",\"inserted_date\":\"2025-05-22 06:00:54\",\"updated_date\":\"2025-05-22 06:01:13\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Tunai\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"44590000\",\"biayapengiriman\":\"0\",\"totalpotongan\":\"0\",\"totalfaktur\":\"450000000\",\"totaldpp\":\"405410000\",\"nobilyetgiro\":null,\"totaldpp_po\":\"405410000\",\"totalppn_po\":\"44590000\",\"totalfaktur_po\":\"450000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Test\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSPWRU001\",\"namaekspedisi\":\"Pos Indonesia\"}','Budiman','2025-05-22 06:43:55','pembelian','hapusPenerimaan'),(1222,'[{\"id\":76,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":10000,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"450000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":10000,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"450000000\"}]','Budiman','2025-05-22 06:43:55','pembeliandetail','hapusPenerimaan'),(1223,'{\"idpembelian\":\"250513BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"inserted_date\":\"2025-05-13 15:27:01\",\"updated_date\":\"2025-05-21 01:41:22\",\"totaldpp_po\":\"693704\",\"totalppn_po\":\"76296\",\"totalfaktur_po\":\"770000\",\"statuspenerimaan\":\"Belum Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Test 2\",\"idpengguna_po\":\"USRBID0001\",\"nofaktur\":null,\"ppnpersen\":11,\"namasupplier\":\"CV. MAJU BERSAMA\"}','Budiman','2025-05-22 06:44:03','pembelian','hapusData'),(1224,'[{\"id\":70,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":0,\"hargasatuan\":\"0\",\"hargadpp\":\"0\",\"jumlahppn\":\"0\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"0\",\"jenisdiskon\":null,\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":10,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"140000\"},{\"id\":71,\"idpembelian\":\"250513BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":0,\"hargasatuan\":\"0\",\"hargadpp\":\"0\",\"jumlahppn\":\"0\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"0\",\"jenisdiskon\":null,\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":14,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"630000\"}]','Budiman','2025-05-22 06:44:03','pembeliandetail','hapusData'),(1225,'{\"idpembelian\":\"250513BL0000002\",\"idsupplier\":\"SUPMBD0001\",\"inserted_date\":\"2025-05-13 15:33:22\",\"updated_date\":\"2025-05-21 02:55:29\",\"totaldpp_po\":\"9009100\",\"totalppn_po\":\"990900\",\"totalfaktur_po\":\"10000000\",\"statuspenerimaan\":\"Belum Diterima\",\"tgl_po\":\"2025-05-13\",\"keterangan_po\":\"Pemesanan barang ke CV Maju\",\"idpengguna_po\":\"USRBID0001\",\"nofaktur\":null,\"ppnpersen\":11,\"namasupplier\":\"CV. MAJU BERSAMA\"}','Budiman','2025-05-22 06:44:07','pembelian','hapusData'),(1226,'[{\"id\":72,\"idpembelian\":\"250513BL0000002\",\"idbarang\":\"W001000001\",\"jumlahbeli\":0,\"hargasatuan\":\"0\",\"hargadpp\":\"0\",\"jumlahppn\":\"0\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"0\",\"jenisdiskon\":null,\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":100,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"10000000\"}]','Budiman','2025-05-22 06:44:07','pembeliandetail','hapusData'),(1227,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"inserted_date\":\"2025-05-22 06:00:54\",\"updated_date\":\"2025-05-22 06:01:13\",\"totaldpp_po\":\"405410000\",\"totalppn_po\":\"44590000\",\"totalfaktur_po\":\"450000000\",\"statuspenerimaan\":\"Belum Diterima\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Test\",\"idpengguna_po\":\"USRBID0001\",\"nofaktur\":null,\"ppnpersen\":11,\"namasupplier\":\"CV. MAJU BERSAMA\"}','Budiman','2025-05-22 06:44:10','pembelian','hapusData'),(1228,'[{\"id\":76,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":0,\"hargasatuan\":\"0\",\"hargadpp\":\"0\",\"jumlahppn\":\"0\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"0\",\"jenisdiskon\":null,\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":10000,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"450000000\"}]','Budiman','2025-05-22 06:44:10','pembeliandetail','hapusData'),(1229,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"ppnpersen\":\"11\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Pengadaan Awal\",\"totaldpp_po\":\"143245000\",\"totalppn_po\":\"15755000\",\"totalfaktur_po\":\"159000000\",\"inserted_date\":\"2025-05-22 06:47:11\",\"updated_date\":\"2025-05-22 06:47:11\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-05-22 06:47:11','pembelian','simpanData'),(1230,'[{\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli_po\":\"1000\",\"hargasatuan_po\":\"14000\",\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"14000000\"},{\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli_po\":\"1000\",\"hargasatuan_po\":\"45000\",\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"45000000\"},{\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli_po\":\"1000\",\"hargasatuan_po\":\"100000\",\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"100000000\"}]','Budiman','2025-05-22 06:47:11','pembeliandetail','simpanData'),(1231,'{\"idpembelian\":\"250522BL0000001\",\"nofaktur\":\"01\\/FF\",\"tglfaktur\":\"2025-01-01\",\"tglditerima\":\"2025-01-01\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSKFSD001\",\"keterangan\":\"Penerimaan Pengadaan\",\"totaldpp\":\"143245000\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"15755000\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"biayapengiriman\":0,\"updated_date\":\"2025-05-22 06:47:58\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"tglbilyetgiro\":\"2025-05-22\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-22 06:47:58','pembelian','penerimaanPembelian'),(1232,'[{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"77\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"78\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"79\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 06:47:58','pembeliandetail','penerimaanPembelian'),(1233,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"01\\/FF\",\"tglfaktur\":\"2025-01-01\",\"tglditerima\":\"2025-01-01\",\"keterangan\":\"Penerimaan Pengadaan\",\"inserted_date\":\"2025-05-22 06:47:11\",\"updated_date\":\"2025-05-22 06:47:58\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Tunai\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"15755000\",\"biayapengiriman\":\"0\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"totaldpp\":\"143245000\",\"nobilyetgiro\":null,\"totaldpp_po\":\"143245000\",\"totalppn_po\":\"15755000\",\"totalfaktur_po\":\"159000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Pengadaan Awal\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSKFSD001\",\"namaekspedisi\":\"PT. Telex Nusantara\"}','Budiman','2025-05-22 06:48:14','pembelian','hapusPenerimaan'),(1234,'[{\"id\":77,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"14000000\"},{\"id\":78,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":1000,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"45000000\"},{\"id\":79,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"100000000\"}]','Budiman','2025-05-22 06:48:14','pembeliandetail','hapusPenerimaan'),(1235,'{\"idpembelian\":\"250522BL0000001\",\"nofaktur\":\"455\\/FF\\/2025\",\"tglfaktur\":\"2025-01-01\",\"tglditerima\":\"2025-01-01\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSOHRR001\",\"keterangan\":\"Penerimaan barang\",\"totaldpp\":\"143245000\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"15755000\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"biayapengiriman\":0,\"updated_date\":\"2025-05-22 06:48:52\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"tglbilyetgiro\":\"2025-05-22\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-22 06:48:52','pembelian','penerimaanPembelian'),(1236,'[{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"77\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"78\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"79\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 06:48:52','pembeliandetail','penerimaanPembelian'),(1237,'{\"idreturpembelian\":\"250522RB0000001\",\"idpembelian\":\"250522BL0000001\",\"tglpengajuan\":\"2025-05-22\",\"totalretur\":140000,\"keterangan\":\"Barang rusak\",\"inserted_date\":\"2025-05-22 06:50:03\",\"updated_date\":\"2025-05-22 06:50:03\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\"}','Budiman','2025-05-22 06:50:03','returpembelian','simpanData'),(1238,'[{\"idreturpembelian\":\"250522RB0000001\",\"idbarang\":\"K001000001\",\"jumlahretur\":\"10\",\"hargaretur\":\"14000\",\"subtotalretur\":\"140000\"}]','Budiman','2025-05-22 06:50:03','returpembeliandetail','simpanData'),(1239,'{\"idreturpembelian\":\"250522RB0000001\",\"tglretur\":\"2025-05-22\",\"updated_date\":\"2025-05-22 06:51:01\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"statusretur\":\"Selesai\"}','Budiman','2025-05-22 06:51:01','returpembelian','updateData'),(1240,'[{\"idreturdetail\":14,\"idreturpembelian\":\"250522RB0000001\",\"idbarang\":\"K001000001\",\"jumlahretur\":10,\"hargaretur\":\"14000\",\"subtotalretur\":\"140000\"}]','Budiman','2025-05-22 06:51:01','returpembeliandetail','updateData'),(1241,'{\"idreturpembelian\":\"250522RB0000001\",\"idpembelian\":\"250522BL0000001\",\"tglretur\":\"2025-05-22\",\"totalretur\":\"140000\",\"keterangan\":\"Barang rusak\",\"inserted_date\":\"2025-05-22 06:50:03\",\"updated_date\":\"2025-05-22 06:51:01\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"statusretur\":\"Selesai\",\"tglpengajuan\":\"2025-05-22\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"kdakunbank\":null,\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"tglfaktur\":\"2025-01-01\",\"nofaktur\":\"455\\/FF\\/2025\"}','Budiman','2025-05-22 06:51:45','returpembelian','hapusData'),(1242,'[{\"idreturdetail\":14,\"idreturpembelian\":\"250522RB0000001\",\"idbarang\":\"K001000001\",\"jumlahretur\":10,\"hargaretur\":\"14000\",\"subtotalretur\":\"140000\"}]','Budiman','2025-05-22 06:51:45','returpembeliandetail','hapusData'),(1243,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"455\\/FF\\/2025\",\"tglfaktur\":\"2025-01-01\",\"tglditerima\":\"2025-01-01\",\"keterangan\":\"Penerimaan barang\",\"inserted_date\":\"2025-05-22 06:47:11\",\"updated_date\":\"2025-05-22 06:48:52\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Tunai\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"15755000\",\"biayapengiriman\":\"0\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"totaldpp\":\"143245000\",\"nobilyetgiro\":null,\"totaldpp_po\":\"143245000\",\"totalppn_po\":\"15755000\",\"totalfaktur_po\":\"159000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Pengadaan Awal\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\"}','Budiman','2025-05-22 06:53:14','pembelian','hapusPenerimaan'),(1244,'[{\"id\":77,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"14000000\"},{\"id\":78,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":1000,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"45000000\"},{\"id\":79,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"100000000\"}]','Budiman','2025-05-22 06:53:14','pembeliandetail','hapusPenerimaan'),(1245,'{\"idpembelian\":\"250522BL0000001\",\"nofaktur\":\"455\\/FF\\/2025\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSOHRR001\",\"keterangan\":\"Penerimaan barang\",\"totaldpp\":\"143245000\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"15755000\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"biayapengiriman\":0,\"updated_date\":\"2025-05-22 06:54:46\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null,\"nobilyetgiro\":null,\"tglbilyetgiro\":\"2025-05-22\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-22 06:54:46','pembelian','penerimaanPembelian'),(1246,'[{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"77\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"78\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"79\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 06:54:46','pembeliandetail','penerimaanPembelian'),(1247,'{\"idreturpembelian\":\"250522RB0000001\",\"idpembelian\":\"250522BL0000001\",\"tglpengajuan\":\"2025-05-22\",\"totalretur\":5000000,\"keterangan\":\"Barang rusak\",\"inserted_date\":\"2025-05-22 07:37:07\",\"updated_date\":\"2025-05-22 07:37:07\",\"idpengguna\":\"USRBID0001\",\"carabayar\":null,\"idbank\":null,\"statusretur\":\"Proses\"}','Budiman','2025-05-22 07:37:07','returpembelian','simpanData'),(1248,'[{\"idreturpembelian\":\"250522RB0000001\",\"idbarang\":\"W001000001\",\"jumlahretur\":\"50\",\"hargaretur\":\"100000\",\"subtotalretur\":\"5000000\"}]','Budiman','2025-05-22 07:37:07','returpembeliandetail','simpanData'),(1249,'{\"idreturpembelian\":\"250522RB0000001\",\"tglretur\":\"2025-05-22\",\"updated_date\":\"2025-05-22 07:37:26\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"statusretur\":\"Selesai\"}','Budiman','2025-05-22 07:37:26','returpembelian','updateData'),(1250,'[{\"idreturdetail\":16,\"idreturpembelian\":\"250522RB0000001\",\"idbarang\":\"W001000001\",\"jumlahretur\":50,\"hargaretur\":\"100000\",\"subtotalretur\":\"5000000\"}]','Budiman','2025-05-22 07:37:26','returpembeliandetail','updateData'),(1251,'{\"idreturpembelian\":\"250522RB0000001\",\"idpembelian\":\"250522BL0000001\",\"tglretur\":\"2025-05-22\",\"totalretur\":\"5000000\",\"keterangan\":\"Barang rusak\",\"inserted_date\":\"2025-05-22 07:37:07\",\"updated_date\":\"2025-05-22 07:37:26\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"statusretur\":\"Selesai\",\"tglpengajuan\":\"2025-05-22\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"kdakunbank\":null,\"namapengguna\":\"Budiman\",\"idsupplier\":\"SUPMBD0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"tglfaktur\":\"2025-05-22\",\"nofaktur\":\"455\\/FF\\/2025\"}','Budiman','2025-05-22 07:37:54','returpembelian','hapusData'),(1252,'[{\"idreturdetail\":16,\"idreturpembelian\":\"250522RB0000001\",\"idbarang\":\"W001000001\",\"jumlahretur\":50,\"hargaretur\":\"100000\",\"subtotalretur\":\"5000000\"}]','Budiman','2025-05-22 07:37:54','returpembeliandetail','hapusData'),(1253,'{\"idpenjualan\":\"250522JL0000001\",\"idkonsumen\":\"KUE001\",\"noinvoice\":\"SJA\\/2505\\/000001\",\"tglinvoice\":\"2025-05-22\",\"keterangan\":\"Pengadan Pipa\",\"totaldpp\":\"10860400\",\"totaldiskon\":\"500000\",\"ppnpersen\":\"11\",\"totalppn\":\"1139600\",\"totalinvoice\":\"11500000\",\"inserted_date\":\"2025-05-22 07:42:43\",\"updated_date\":\"2025-05-22 07:42:43\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSJMQ0001\",\"nokwitansi\":null,\"nobilyetgiro\":null}','Budiman','2025-05-22 07:42:43','penjualan','simpanData'),(1254,'[{\"idpenjualan\":\"250522JL0000001\",\"idbarang\":\"W001000001\",\"jumlahjual\":\"100\",\"hargasatuan\":\"120000\",\"hargadpp\":\"108604\",\"jumlahppn\":\"11396\",\"jumlahdiskon\":\"5000\",\"subtotaljual\":\"11500000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 07:42:43','penjualandetail','simpanData'),(1255,'{\"lastlogin\":\"2025-05-22 11:57:33\"}','Budiman','2025-05-22 11:57:33','pengguna','updateData'),(1256,'{\"idhutangdetail\":\"250522HU0001002\",\"idhutang\":\"250522HU0001\",\"tglhutang\":\"2025-05-22\",\"debet\":\"10000000\",\"kredit\":0,\"inserted_date\":\"2025-05-22 11:58:40\",\"updated_date\":\"2025-05-22 11:58:40\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"jenis\":\"Pembayaran Hutang\"}','Budiman','2025-05-22 11:58:40','hutangdetail','simpanData'),(1257,'{\"idsuratjalan\":\"250522SJ01\",\"tglsuratjalan\":\"2025-05-22\",\"idkonsumen\":\"KUE001\",\"idekspedisi\":\"EKSKFSD001\",\"idjenisekspedisi\":\"001\",\"biayapengiriman\":\"20000\",\"identitasekspedisi\":\"Pelat No. KB8999SS\",\"totaltagihan\":\"11500000\",\"inserted_date\":\"2025-05-22 12:22:46\",\"updated_date\":\"2025-05-22 12:22:46\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-22 12:22:46','suratjalan','simpanData'),(1258,'[{\"idsuratjalan\":\"250522SJ01\",\"idpenjualan\":\"250522JL0000001\"}]','Budiman','2025-05-22 12:22:46','suratjalandetail','simpanData'),(1259,'[{\"idsuratjalan\":\"250522SJ01\",\"qty\":\"1\",\"satuan\":\"Paket\",\"keterangan\":\"Kayu dan pipa\"}]','Budiman','2025-05-22 12:22:46','suratjalanrincian','simpanData'),(1260,'{\"idsuratjalan\":\"250522SJ01\",\"tglsuratjalan\":\"2025-05-22\",\"idekspedisi\":\"EKSKFSD001\",\"idjenisekspedisi\":\"001\",\"biayapengiriman\":\"20000\",\"identitasekspedisi\":\"Pelat No. KB8999SS Supir: Suyatno\",\"totaltagihan\":\"11500000\",\"updated_date\":\"2025-05-22 12:33:25\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-22 12:33:25','suratjalan','updateData'),(1261,'[{\"idsuratjalan\":\"250522SJ01\",\"idpenjualan\":\"250522JL0000001\"}]','Budiman','2025-05-22 12:33:25','suratjalandetail','updateData'),(1262,'[{\"idsuratjalan\":\"250522SJ01\",\"qty\":\"1\",\"satuan\":\"Paket\",\"keterangan\":\"Kayu dan pipa\"}]','Budiman','2025-05-22 12:33:25','suratjalanrincian','updateData'),(1263,'{\"idhutangdetail\":\"250522HU0001002\",\"idhutang\":\"250522HU0001\",\"tglhutang\":\"2025-05-22\",\"debet\":\"10000000\",\"kredit\":\"0\",\"inserted_date\":\"2025-05-22 11:58:40\",\"updated_date\":\"2025-05-22 11:58:40\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Hutang\",\"nobilyetgiro\":null,\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"namabank\":null,\"namapengguna\":\"Budiman\"}','Budiman','2025-05-22 12:47:16','hutangdetail','hapusDetail'),(1264,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"455\\/FF\\/2025\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"keterangan\":\"Penerimaan barang\",\"inserted_date\":\"2025-05-22 06:47:11\",\"updated_date\":\"2025-05-22 06:54:46\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Hutang\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"15755000\",\"biayapengiriman\":\"0\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"totaldpp\":\"143245000\",\"nobilyetgiro\":null,\"totaldpp_po\":\"143245000\",\"totalppn_po\":\"15755000\",\"totalfaktur_po\":\"159000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Pengadaan Awal\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\"}','Budiman','2025-05-22 12:50:43','pembelian','hapusPenerimaan'),(1265,'[{\"id\":77,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"14000000\"},{\"id\":78,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":1000,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"45000000\"},{\"id\":79,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"100000000\"}]','Budiman','2025-05-22 12:50:43','pembeliandetail','hapusPenerimaan'),(1266,'{\"idhutangekspedisi\":\"250522HEX000001\",\"idtransaksi\":\"250522BL0000001\",\"tglhutang\":\"2025-05-22\",\"idekspedisi\":\"EKSPWRU001\",\"debet\":0,\"kredit\":\"300000\",\"keterangan\":\"Hutang ekspedisi dengan No. Faktur 0012\\/FF\",\"jenissumber\":\"Pembelian\",\"jenis\":\"Hutang\"}','Budiman','2025-05-22 12:51:45','hutangekspedisi','penerimaanPembelian'),(1267,'{\"idpembelian\":\"250522BL0000001\",\"nofaktur\":\"0012\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSPWRU001\",\"keterangan\":\"Penerimaan barang\",\"totaldpp\":\"143245000\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"15755000\",\"totalpotongan\":\"200000\",\"totalfaktur\":\"158800000\",\"biayapengiriman\":\"300000\",\"updated_date\":\"2025-05-22 12:51:45\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":\"8282199999\",\"tglbilyetgiro\":\"2025-05-22\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-22 12:51:45','pembelian','penerimaanPembelian'),(1268,'[{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"77\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"78\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"79\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 12:51:45','pembeliandetail','penerimaanPembelian'),(1269,'{\"idhutangekspedisi\":\"250522HEX000001\",\"idtransaksi\":\"250522BL0000001\",\"tglhutang\":\"2025-05-22\",\"idekspedisi\":\"EKSPWRU001\",\"debet\":\"0\",\"kredit\":\"300000\",\"jenissumber\":\"Pembelian\",\"keterangan\":\"Hutang ekspedisi dengan No. Faktur 0012\\/FF\",\"carabayar\":null,\"idbank\":null,\"jenis\":\"Hutang\",\"nobilyetgiro\":null}','Budiman','2025-05-22 12:53:55','hutangekspedisi','hapusPenerimaan'),(1270,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"0012\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"keterangan\":\"Penerimaan barang\",\"inserted_date\":\"2025-05-22 06:47:11\",\"updated_date\":\"2025-05-22 12:51:45\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"15755000\",\"biayapengiriman\":\"300000\",\"totalpotongan\":\"200000\",\"totalfaktur\":\"158800000\",\"totaldpp\":\"143245000\",\"nobilyetgiro\":\"8282199999\",\"totaldpp_po\":\"143245000\",\"totalppn_po\":\"15755000\",\"totalfaktur_po\":\"159000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Pengadaan Awal\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSPWRU001\",\"namaekspedisi\":\"Pos Indonesia\"}','Budiman','2025-05-22 12:53:55','pembelian','hapusPenerimaan'),(1271,'[{\"id\":77,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"14000000\"},{\"id\":78,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":1000,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"45000000\"},{\"id\":79,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"100000000\"}]','Budiman','2025-05-22 12:53:55','pembeliandetail','hapusPenerimaan'),(1272,'{\"idpembelian\":\"250522BL0000001\",\"nofaktur\":\"0002\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSOHRR001\",\"keterangan\":\"test\",\"totaldpp\":\"143245000\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"15755000\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"biayapengiriman\":0,\"updated_date\":\"2025-05-22 12:54:21\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"nobilyetgiro\":null,\"tglbilyetgiro\":\"2025-05-22\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-22 12:54:21','pembelian','penerimaanPembelian'),(1273,'[{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"77\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"78\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"79\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 12:54:21','pembeliandetail','penerimaanPembelian'),(1274,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"0002\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"keterangan\":\"test\",\"inserted_date\":\"2025-05-22 06:47:11\",\"updated_date\":\"2025-05-22 12:54:21\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"namabank\":\"May Bank\",\"cabang\":\"Pontianak\",\"norekening\":\"7844555666\",\"atasnama\":\"Budi Santoso\",\"kdakunbank\":\"1.1.01.02\",\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"15755000\",\"biayapengiriman\":\"0\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"totaldpp\":\"143245000\",\"nobilyetgiro\":null,\"totaldpp_po\":\"143245000\",\"totalppn_po\":\"15755000\",\"totalfaktur_po\":\"159000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Pengadaan Awal\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\"}','Budiman','2025-05-22 12:54:40','pembelian','hapusPenerimaan'),(1275,'[{\"id\":77,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"14000000\"},{\"id\":78,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":1000,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"45000000\"},{\"id\":79,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"100000000\"}]','Budiman','2025-05-22 12:54:40','pembeliandetail','hapusPenerimaan'),(1276,'{\"idpembelian\":\"250522BL0000001\",\"nofaktur\":\"223\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSOHRR001\",\"keterangan\":\"test\",\"totaldpp\":\"143245000\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"15755000\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"biayapengiriman\":0,\"updated_date\":\"2025-05-22 12:55:16\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":null,\"nobilyetgiro\":\"182918291\",\"tglbilyetgiro\":\"2025-05-22\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-22 12:55:16','pembelian','penerimaanPembelian'),(1277,'[{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"77\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"78\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"79\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 12:55:16','pembeliandetail','penerimaanPembelian'),(1278,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"223\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"keterangan\":\"test\",\"inserted_date\":\"2025-05-22 06:47:11\",\"updated_date\":\"2025-05-22 12:55:16\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":null,\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"kdakunbank\":null,\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"15755000\",\"biayapengiriman\":\"0\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"totaldpp\":\"143245000\",\"nobilyetgiro\":\"182918291\",\"totaldpp_po\":\"143245000\",\"totalppn_po\":\"15755000\",\"totalfaktur_po\":\"159000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Pengadaan Awal\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\"}','Budiman','2025-05-22 13:01:04','pembelian','hapusPenerimaan'),(1279,'[{\"id\":77,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"14000000\"},{\"id\":78,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":1000,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"45000000\"},{\"id\":79,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"100000000\"}]','Budiman','2025-05-22 13:01:04','pembeliandetail','hapusPenerimaan'),(1280,'{\"idpembelian\":\"250522BL0000001\",\"nofaktur\":\"288\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSKFSD001\",\"keterangan\":\"test\",\"totaldpp\":\"143245000\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"15755000\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"biayapengiriman\":0,\"updated_date\":\"2025-05-22 13:01:45\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":\"21233\\/BY\",\"tglbilyetgiro\":\"2025-05-22\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-22 13:01:45','pembelian','penerimaanPembelian'),(1281,'[{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"77\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"78\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"79\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 13:01:45','pembeliandetail','penerimaanPembelian'),(1282,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"288\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"keterangan\":\"test\",\"inserted_date\":\"2025-05-22 06:47:11\",\"updated_date\":\"2025-05-22 13:01:45\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"atasnama\":\"Budi Santoso\",\"kdakunbank\":\"1.1.01.03\",\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"15755000\",\"biayapengiriman\":\"0\",\"totalpotongan\":\"0\",\"totalfaktur\":\"159000000\",\"totaldpp\":\"143245000\",\"nobilyetgiro\":\"21233\\/BY\",\"tglbilyetgiro\":\"2025-05-22\",\"totaldpp_po\":\"143245000\",\"totalppn_po\":\"15755000\",\"totalfaktur_po\":\"159000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Pengadaan Awal\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSKFSD001\",\"namaekspedisi\":\"PT. Telex Nusantara\"}','Budiman','2025-05-22 13:26:23','pembelian','hapusPenerimaan'),(1283,'[{\"id\":77,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"14000000\"},{\"id\":78,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":1000,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"45000000\"},{\"id\":79,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"100000000\"}]','Budiman','2025-05-22 13:26:23','pembeliandetail','hapusPenerimaan'),(1284,'{\"idhutangekspedisi\":\"250522HEX000001\",\"idtransaksi\":\"250522BL0000001\",\"tglhutang\":\"2025-05-22\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":0,\"kredit\":\"500000\",\"keterangan\":\"Hutang ekspedisi dengan No. Faktur 223\\/FF\",\"jenissumber\":\"Pembelian\",\"jenis\":\"Hutang\"}','Budiman','2025-05-22 14:22:36','hutangekspedisi','penerimaanPembelian'),(1285,'{\"idpembelian\":\"250522BL0000001\",\"nofaktur\":\"223\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSOHRR001\",\"keterangan\":\"Test\",\"totaldpp\":\"143245000\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"15755000\",\"totalpotongan\":\"200000\",\"totalfaktur\":\"158800000\",\"biayapengiriman\":\"500000\",\"updated_date\":\"2025-05-22 14:22:36\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":\"232323\",\"tglbilyetgiro\":\"2025-05-22\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-22 14:22:36','pembelian','penerimaanPembelian'),(1286,'[{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"77\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"78\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"79\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 14:22:36','pembeliandetail','penerimaanPembelian'),(1287,'{\"idhutangekspedisi\":\"250522HEX000001\",\"idtransaksi\":\"250522BL0000001\",\"tglhutang\":\"2025-05-22\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"0\",\"kredit\":\"500000\",\"jenissumber\":\"Pembelian\",\"keterangan\":\"Hutang ekspedisi dengan No. Faktur 223\\/FF\",\"carabayar\":null,\"idbank\":null,\"jenis\":\"Hutang\",\"nobilyetgiro\":null}','Budiman','2025-05-22 14:23:31','hutangekspedisi','hapusPenerimaan'),(1288,'{\"idpembelian\":\"250522BL0000001\",\"idsupplier\":\"SUPMBD0001\",\"nofaktur\":\"223\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"keterangan\":\"Test\",\"inserted_date\":\"2025-05-22 06:47:11\",\"updated_date\":\"2025-05-22 14:22:36\",\"idpengguna\":\"USRBID0001\",\"namasupplier\":\"CV. MAJU BERSAMA\",\"namapengguna\":\"Budiman\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"atasnama\":\"Budi Santoso\",\"kdakunbank\":\"1.1.01.03\",\"totalpembelian\":\"0\",\"totaldiskon\":\"0\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"15755000\",\"biayapengiriman\":\"500000\",\"totalpotongan\":\"200000\",\"totalfaktur\":\"158800000\",\"totaldpp\":\"143245000\",\"nobilyetgiro\":\"232323\",\"tglbilyetgiro\":\"2025-05-22\",\"totaldpp_po\":\"143245000\",\"totalppn_po\":\"15755000\",\"totalfaktur_po\":\"159000000\",\"statuspenerimaan\":\"Sudah Diterima\",\"tgl_po\":\"2025-05-22\",\"keterangan_po\":\"Pengadaan Awal\",\"idpengguna_po\":\"USRBID0001\",\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\"}','Budiman','2025-05-22 14:23:31','pembelian','hapusPenerimaan'),(1289,'[{\"id\":77,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":14000,\"hargadpp_po\":\"12613\",\"jumlahppn_po\":\"1387\",\"subtotalbeli_po\":\"14000000\"},{\"id\":78,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"K001000002\",\"jumlahbeli\":1000,\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":45000,\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"45000000\"},{\"id\":79,\"idpembelian\":\"250522BL0000001\",\"idbarang\":\"W001000001\",\"jumlahbeli\":1000,\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":0,\"diskonpersen2\":0,\"diskonpersen3\":0,\"jumlahbeli_po\":1000,\"hargasatuan_po\":100000,\"hargadpp_po\":\"90091\",\"jumlahppn_po\":\"9909\",\"subtotalbeli_po\":\"100000000\"}]','Budiman','2025-05-22 14:23:31','pembeliandetail','hapusPenerimaan'),(1290,'{\"idhutangekspedisi\":\"250522HEX000001\",\"idtransaksi\":\"250522BL0000001\",\"tglhutang\":\"2025-05-22\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":0,\"kredit\":\"5000000\",\"keterangan\":\"Hutang ekspedisi dengan No. Faktur 333\\/FF\",\"jenissumber\":\"Pembelian\",\"jenis\":\"Hutang\"}','Budiman','2025-05-22 14:24:24','hutangekspedisi','penerimaanPembelian'),(1291,'{\"idpembelian\":\"250522BL0000001\",\"nofaktur\":\"333\\/FF\",\"tglfaktur\":\"2025-05-22\",\"tglditerima\":\"2025-05-22\",\"idsupplier\":\"SUPMBD0001\",\"idekspedisi\":\"EKSOHRR001\",\"keterangan\":\"test\",\"totaldpp\":\"143245000\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"15755000\",\"totalpotongan\":\"200000\",\"totalfaktur\":\"158800000\",\"biayapengiriman\":\"5000000\",\"updated_date\":\"2025-05-22 14:24:24\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Giro\",\"idbank\":\"BN001\",\"nobilyetgiro\":\"212121\",\"tglbilyetgiro\":\"2025-05-22\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-05-22 14:24:24','pembelian','penerimaanPembelian'),(1292,'[{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"77\",\"idbarang\":\"K001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"14000\",\"hargadpp\":\"12613\",\"jumlahppn\":\"1387\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"14000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"78\",\"idbarang\":\"K001000002\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"45000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"},{\"idpembelian\":\"250522BL0000001\",\"iddetail\":\"79\",\"idbarang\":\"W001000001\",\"jumlahbeli\":\"1000\",\"hargasatuan\":\"100000\",\"hargadpp\":\"90091\",\"jumlahppn\":\"9909\",\"jumlahdiskon\":\"0\",\"subtotalbeli\":\"100000000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-22 14:24:24','pembeliandetail','penerimaanPembelian'),(1293,'{\"idhutangekspedisi\":\"250523HEX000001\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2000000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Tesst\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"inserted_date\":\"2025-05-23 04:18:54\",\"updated_date\":\"2025-05-23 04:18:54\"}','Budiman','2025-05-23 04:18:54','hutang','simpanData'),(1294,'{\"idhutangekspedisi\":\"250523HEX000001\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2000000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Tesst\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":null,\"updated_date\":\"2025-05-23 04:28:00\"}','Budiman','2025-05-23 04:28:00','hutang','updateData'),(1295,'{\"idhutangekspedisi\":\"250523HEX000001\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2000000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Tesst\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":null,\"updated_date\":\"2025-05-23 04:33:45\"}','Budiman','2025-05-23 04:33:45','hutang','updateData'),(1296,'{\"idhutangekspedisi\":\"250523HEX000001\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2000000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Tesst\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":null,\"updated_date\":\"2025-05-23 04:36:09\"}','Budiman','2025-05-23 04:36:09','hutang','updateData'),(1297,'{\"idhutangekspedisi\":\"250523HEX000001\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2000000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Tesst\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":null,\"updated_date\":\"2025-05-23 04:36:17\"}','Budiman','2025-05-23 04:36:17','hutang','updateData'),(1298,'{\"idhutangekspedisi\":\"250523HEX000001\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2000000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Tesst\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":null,\"updated_date\":\"2025-05-23 04:36:34\"}','Budiman','2025-05-23 04:36:34','hutang','updateData'),(1299,'{\"idhutangekspedisi\":\"250523HEX000001\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2000000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Tesst\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":\"21212121\",\"updated_date\":\"2025-05-23 04:38:04\"}','Budiman','2025-05-23 04:38:04','hutang','updateData'),(1300,'{\"idhutangekspedisi\":\"250523HEX000001\",\"idtransaksi\":null,\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2000000\",\"kredit\":\"0\",\"jenissumber\":\"Pembayaran\",\"keterangan\":\"Tesst\",\"carabayar\":\"Giro\",\"jenis\":\"Pembayaran\",\"idbank\":\"MD001\",\"nobilyetgiro\":\"21212121\",\"namaekspedisi\":\"JNT Ekspress\",\"namabank\":\"Bank Central Asia\",\"cabang\":\"Kota Pontianak\",\"norekening\":\"56889966\",\"kdakunbank\":\"1.1.01.03\"}','Budiman','2025-05-23 04:38:23','hutangekspedisi','hapusData'),(1301,'{\"idhutangekspedisi\":\"250523HEX000001\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"10000000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Pembayaran dengan cara giro\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":\"121312312\",\"inserted_date\":\"2025-05-23 04:42:23\",\"updated_date\":\"2025-05-23 04:42:23\"}','Budiman','2025-05-23 04:42:23','hutang','simpanData'),(1302,'{\"lastlogin\":\"2025-05-23 08:07:47\"}','Budiman','2025-05-23 08:07:47','pengguna','updateData'),(1303,'{\"idhutangekspedisi\":\"250523HEX000001\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"10000000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Pembayaran dengan cara giro\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":\"121312312\",\"updated_date\":\"2025-05-23 08:08:17\"}','Budiman','2025-05-23 08:08:17','hutang','updateData'),(1304,'{\"idsuratjalan\":\"250522SJ01\",\"tglsuratjalan\":\"2025-05-22\",\"idkonsumen\":\"KUE001\",\"namakonsumen\":\"CV. Karya Utama\",\"idjenisekspedisi\":\"001\",\"namajenisekspedisi\":\"Darat\",\"idekspedisi\":\"EKSKFSD001\",\"namaekspedisi\":\"PT. Telex Nusantara\",\"identitasekspedisi\":\"Pelat No. KB8999SS Supir: Suyatno\",\"biayapengiriman\":\"20000\",\"daftarnoinvoice\":\"SJA\\/2505\\/000001\"}','Budiman','2025-05-23 08:16:20','suratjalan','hapusData'),(1305,'[{\"iddetailsuratjalan\":42,\"idsuratjalan\":\"250522SJ01\",\"idpenjualan\":\"250522JL0000001\"}]','Budiman','2025-05-23 08:16:20','suratjalandetail','hapusData'),(1306,'[{\"idsuratjalanrincian\":18,\"idsuratjalan\":\"250522SJ01\",\"qty\":1,\"satuan\":\"Paket\",\"keterangan\":\"Kayu dan pipa\"}]','Budiman','2025-05-23 08:16:20','suratjalanrincian','hapusData'),(1307,'{\"idhutangekspedisi\":\"250523HEX000002\",\"idtransaksi\":\"250523SJ01\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":0,\"kredit\":\"250000\",\"keterangan\":\"Hutang ekspedisi dengan No. Surat Jalan 250523SJ01\",\"jenissumber\":\"Penjualan\",\"jenis\":\"Hutang\"}','Budiman','2025-05-23 08:17:09','hutangekspedisi','penerimaanPembelian'),(1308,'{\"idsuratjalan\":\"250523SJ01\",\"tglsuratjalan\":\"2025-05-23\",\"idkonsumen\":\"KUE001\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"biayapengiriman\":\"250000\",\"identitasekspedisi\":\"Pengiriman barang ke singkawang\",\"totaltagihan\":\"11500000\",\"inserted_date\":\"2025-05-23 08:17:09\",\"updated_date\":\"2025-05-23 08:17:09\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-23 08:17:09','suratjalan','simpanData'),(1309,'[{\"idsuratjalan\":\"250523SJ01\",\"idpenjualan\":\"250522JL0000001\"}]','Budiman','2025-05-23 08:17:09','suratjalandetail','simpanData'),(1310,'[{\"idsuratjalan\":\"250523SJ01\",\"qty\":\"1\",\"satuan\":\"Paket\",\"keterangan\":\"Kayu dan pipa\"}]','Budiman','2025-05-23 08:17:09','suratjalanrincian','simpanData'),(1311,'{\"idhutangekspedisi\":\"250523HEX000002\",\"idtransaksi\":\"250523SJ01\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"0\",\"kredit\":\"250000\",\"jenissumber\":\"Penjualan\",\"keterangan\":\"Hutang ekspedisi dengan No. Surat Jalan 250523SJ01\",\"carabayar\":null,\"idbank\":null,\"jenis\":\"Hutang\",\"nobilyetgiro\":null,\"inserted_date\":null,\"updated_date\":null}','Budiman','2025-05-23 08:20:41','hutangekspedisi','UpdateDataSuratJalan'),(1312,'{\"idhutangekspedisi\":\"250523HEX000002\",\"idtransaksi\":\"250523SJ01\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":0,\"kredit\":\"550000\",\"keterangan\":\"Hutang ekspedisi dengan No. Surat Jalan 250523SJ01\",\"jenissumber\":\"Penjualan\",\"jenis\":\"Hutang\"}','Budiman','2025-05-23 08:20:41','hutangekspedisi','penerimaanPembelian'),(1313,'{\"idsuratjalan\":\"250523SJ01\",\"tglsuratjalan\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"002\",\"biayapengiriman\":\"550000\",\"identitasekspedisi\":\"Pengiriman barang ke singkawang\",\"totaltagihan\":\"11500000\",\"updated_date\":\"2025-05-23 08:20:41\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-23 08:20:41','suratjalan','updateData'),(1314,'[{\"idsuratjalan\":\"250523SJ01\",\"idpenjualan\":\"250522JL0000001\"}]','Budiman','2025-05-23 08:20:41','suratjalandetail','updateData'),(1315,'[{\"idsuratjalan\":\"250523SJ01\",\"qty\":\"1\",\"satuan\":\"Paket\",\"keterangan\":\"Kayu dan pipa\"}]','Budiman','2025-05-23 08:20:41','suratjalanrincian','updateData'),(1316,'{\"idhutangekspedisi\":\"250523HEX000002\",\"idtransaksi\":\"250523SJ01\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"0\",\"kredit\":\"550000\",\"jenissumber\":\"Penjualan\",\"keterangan\":\"Hutang ekspedisi dengan No. Surat Jalan 250523SJ01\",\"carabayar\":null,\"idbank\":null,\"jenis\":\"Hutang\",\"nobilyetgiro\":null,\"inserted_date\":null,\"updated_date\":null}','Budiman','2025-05-23 08:22:01','hutangekspedisi','hapusDataSuratJalan'),(1317,'{\"idsuratjalan\":\"250523SJ01\",\"tglsuratjalan\":\"2025-05-23\",\"idkonsumen\":\"KUE001\",\"namakonsumen\":\"CV. Karya Utama\",\"idjenisekspedisi\":\"002\",\"namajenisekspedisi\":\"Laut\",\"idekspedisi\":\"EKSOHRR001\",\"namaekspedisi\":\"JNT Ekspress\",\"identitasekspedisi\":\"Pengiriman barang ke singkawang\",\"biayapengiriman\":\"550000\",\"daftarnoinvoice\":\"SJA\\/2505\\/000001\"}','Budiman','2025-05-23 08:22:01','suratjalan','hapusData'),(1318,'[{\"iddetailsuratjalan\":44,\"idsuratjalan\":\"250523SJ01\",\"idpenjualan\":\"250522JL0000001\"}]','Budiman','2025-05-23 08:22:01','suratjalandetail','hapusData'),(1319,'[{\"idsuratjalanrincian\":20,\"idsuratjalan\":\"250523SJ01\",\"qty\":1,\"satuan\":\"Paket\",\"keterangan\":\"Kayu dan pipa\"}]','Budiman','2025-05-23 08:22:01','suratjalanrincian','hapusData'),(1320,'{\"lastlogin\":\"2025-05-23 11:59:04\"}','Budiman','2025-05-23 11:59:04','pengguna','updateData'),(1321,'{\"idpiutang\":\"250502PI0005\",\"idpenjualan\":null,\"idjenispiutang\":\"P02\",\"tglpiutang\":\"2025-05-02\",\"tgljatuhtempo\":\"2025-06-16\",\"idkonsumen\":\"KUE001\",\"totaldebet\":\"25000000\",\"totalkredit\":\"0\",\"jenissumber\":\"Non Penjualan\",\"keterangan\":\"Saldo Awal Piutang CV. Karya Utama\",\"namakonsumen\":\"CV. Karya Utama\",\"namajenispiutang\":\"Middle\",\"jatuhtempo\":45,\"tglinvoice\":null,\"noinvoice\":null,\"statuslunas\":\"Belum Lunas\"}','Budiman','2025-05-23 12:23:48','piutang','hapusData'),(1322,'{\"idbarang\":\"B001000001\",\"namabarang\":\"Paku 1 Inc (1 Kg)\",\"idkategori\":\"B001\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"5.00\",\"inserted_date\":\"2025-05-23 13:51:11\",\"updated_date\":\"2025-05-23 13:51:11\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-23 13:51:11','barang','simpanData'),(1323,'{\"idbarang\":\"B001000001\",\"namabarang\":\"Paku 1 Inc (1 Kg)\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"jenisbonuspenjualan\":\"Nominal\",\"jumlahbonuspenjualan\":\"100.00\",\"persenbonuspenjualan\":0,\"updated_date\":\"2025-05-23 14:09:49\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-23 14:09:49','barang','updateData'),(1324,'{\"idbarang\":\"B001000001\",\"namabarang\":\"Paku 1 Inc (1 Kg)\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"jenisbonuspenjualan\":\"Nominal\",\"jumlahbonuspenjualan\":\"1000\",\"persenbonuspenjualan\":0,\"updated_date\":\"2025-05-23 14:10:50\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-23 14:10:50','barang','updateData'),(1325,'{\"idbarang\":\"K001000002\",\"namabarang\":\"Kayu 4x6 Pelang\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"45000\",\"hargajualasli\":\"48000\",\"hargajualdiskon\":\"48000\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.00\",\"updated_date\":\"2025-05-23 15:00:28\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-23 15:00:28','barang','updateData'),(1326,'{\"idbarang\":\"B001000001\",\"namabarang\":\"Paku 1 Inc (1 Kg)\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Nominal\",\"jumlahbonuspenjualan\":\"1\",\"persenbonuspenjualan\":0,\"updated_date\":\"2025-05-23 15:00:42\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-23 15:00:42','barang','updateData'),(1327,'{\"idbarang\":\"B001000001\",\"namabarang\":\"Paku 1 Inc (1 Kg)\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Nominal\",\"jumlahbonuspenjualan\":\"1000\",\"persenbonuspenjualan\":0,\"updated_date\":\"2025-05-23 15:01:03\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-23 15:01:03','barang','updateData'),(1328,'{\"idbarang\":\"B001000001\",\"namabarang\":\"Paku 1 Inc (1 Kg)\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"idjenisbarang\":\"002\",\"jenisbonuspenjualan\":\"Nominal\",\"jumlahbonuspenjualan\":\"1000\",\"persenbonuspenjualan\":0,\"updated_date\":\"2025-05-23 15:02:10\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-23 15:02:10','barang','updateData'),(1329,'{\"idbarang\":\"K001000001\",\"namabarang\":\"Papan Mal\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"14000\",\"hargajualasli\":\"15000\",\"hargajualdiskon\":\"15000\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.00\",\"updated_date\":\"2025-05-23 15:02:22\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-23 15:02:22','barang','updateData'),(1330,'{\"idbarang\":\"W001000001\",\"namabarang\":\"Pipa 5In\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"100000\",\"hargajualasli\":\"120000\",\"hargajualdiskon\":\"120000\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.00\",\"updated_date\":\"2025-05-23 15:02:36\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-23 15:02:36','barang','updateData'),(1331,'{\"idhutangekspedisi\":\"250523HEX000001\",\"tglhutang\":\"2025-05-23\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"5000000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Pembayaran dengan cara giro\",\"carabayar\":\"Giro\",\"idbank\":\"MD001\",\"nobilyetgiro\":\"121312312\",\"updated_date\":\"2025-05-23 15:16:07\"}','Budiman','2025-05-23 15:16:07','hutang','updateData'),(1332,'{\"lastlogin\":\"2025-05-26 11:39:13\"}','Budiman','2025-05-26 11:39:13','pengguna','updateData'),(1333,'{\"lastlogin\":\"2025-05-27 00:49:43\"}','Budiman','2025-05-27 00:49:43','pengguna','updateData'),(1334,'{\"lastlogin\":\"2025-05-27 07:05:23\"}','Budiman','2025-05-27 07:05:23','pengguna','updateData'),(1335,'{\"idpenagihan\":\"250527TAG000001\",\"tglpenagihan\":\"2025-05-27\",\"tgltagihanakhir\":\"2025-06-08\",\"idsales\":\"SLSJMQ0001\",\"totaltagihan\":\"11500000\",\"inserted_date\":\"2025-05-27 07:29:12\",\"updated_date\":\"2025-05-27 07:29:12\",\"idpengguna\":\"USRBID0001\",\"statuscetak\":\"Belum Cetak\"}','Budiman','2025-05-27 07:29:12','penagihan','simpanData'),(1336,'[{\"idpenagihan\":\"250527TAG000001\",\"idpiutang\":\"250522PI0001\",\"idsalesbonus\":\"SLSJMQ0001\",\"jumlahtagihan\":\"11500000\"}]','Budiman','2025-05-27 07:29:12','penagihandetail','simpanData'),(1337,'{\"idpenagihan\":\"250527TAG000001\",\"totaltagihan\":\"11500000\",\"updated_date\":\"2025-05-27 08:03:29\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-27 08:03:29','penagihan','updateDataPenagihan'),(1338,'[{\"idpenagihan\":\"250527TAG000001\",\"idpiutang\":\"250522PI0001\",\"idsalesbonus\":\"SLSJMQ0001\",\"jumlahtagihan\":\"11500000\"}]','Budiman','2025-05-27 08:03:29','penagihandetail','updateDataPenagihan'),(1339,'{\"idpenagihan\":\"250527TAG000001\",\"tglpenagihan\":\"2025-05-27\",\"idsales\":\"SLSJMQ0001\",\"totaltagihan\":\"11500000\",\"inserted_date\":\"2025-05-27 07:29:12\",\"updated_date\":\"2025-05-27 08:03:29\",\"idpengguna\":\"USRBID0001\",\"statuscetak\":\"Belum Cetak\",\"namasales\":\"Jaja Miharga\",\"npwpsales\":\"829182198291919\"}','Budiman','2025-05-27 08:10:02','penagihan','hapusDataPenagihan'),(1340,'[{\"id\":4,\"idpenagihan\":\"250527TAG000001\",\"idpiutang\":\"250522PI0001\",\"jumlahtagihan\":\"11500000\",\"idsalesbonus\":\"SLSJMQ0001\"}]','Budiman','2025-05-27 08:10:02','penagihandetail','hapusDataPenagihan'),(1341,'{\"idpenagihan\":\"250527TAG000001\",\"tglpenagihan\":\"2025-05-27\",\"tgltagihanakhir\":\"2025-06-08\",\"idsales\":\"SLSJMQ0001\",\"totaltagihan\":\"11500000\",\"inserted_date\":\"2025-05-27 08:10:13\",\"updated_date\":\"2025-05-27 08:10:13\",\"idpengguna\":\"USRBID0001\",\"statuscetak\":\"Belum Cetak\"}','Budiman','2025-05-27 08:10:13','penagihan','simpanDataPenagihan'),(1342,'[{\"idpenagihan\":\"250527TAG000001\",\"idpiutang\":\"250522PI0001\",\"idsalesbonus\":\"SLSJMQ0001\",\"jumlahtagihan\":\"11500000\"}]','Budiman','2025-05-27 08:10:13','penagihandetail','simpanDataPenagihan'),(1343,'{\"lastlogin\":\"2025-05-27 08:18:44\"}','Budiman','2025-05-27 08:18:44','pengguna','updateData'),(1344,'{\"idpenjualan\":\"250527JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"tglinvoice\":\"2025-05-27\",\"keterangan\":\"Test\",\"totaldpp\":\"137030\",\"totaldiskon\":\"19050\",\"ppnpersen\":\"11\",\"totalppn\":\"12970\",\"totalinvoice\":\"130950\",\"inserted_date\":\"2025-05-27 08:22:30\",\"updated_date\":\"2025-05-27 08:22:30\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250527JL0000001#01\",\"nobilyetgiro\":null}','Budiman','2025-05-27 08:22:30','penjualan','simpanData'),(1345,'[{\"idpenjualan\":\"250527JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"10\",\"hargasatuan\":\"15000\",\"hargadpp\":\"13703\",\"jumlahppn\":\"1297\",\"jumlahdiskon\":\"1905\",\"subtotaljual\":\"130950\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"3\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-27 08:22:30','penjualandetail','simpanData'),(1346,'{\"idpenjualan\":\"250527JL0000001\",\"idkonsumen\":\"IPJ001\",\"tglinvoice\":\"2025-05-27\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"keterangan\":\"Test\",\"totalpenjualan\":\"0\",\"totaldpp\":\"137030\",\"totaldiskon\":\"19050\",\"totalbersih\":\"0\",\"ppnpersen\":11,\"totalppn\":\"12970\",\"biayapengiriman\":\"0\",\"totalinvoice\":\"130950\",\"idpengguna\":\"USRBID0001\",\"inserted_date\":\"2025-05-27 08:22:30\",\"updated_date\":\"2025-05-27 08:22:30\",\"carabayar\":\"Tunai\",\"idbank\":null,\"idjenispiutang\":null,\"idsales\":\"SLSSKN0001\",\"nokwitansi\":\"250527JL0000001#01\",\"nobilyetgiro\":null,\"namakonsumen\":\"PT. Intrajaya\",\"idwilayah\":\"001\",\"namabank\":null,\"cabang\":null,\"norekening\":null,\"atasnama\":null,\"namasales\":\"Siti Khadizah\",\"namajenispiutang\":null,\"jatuhtempo\":null,\"namapengguna\":\"Budiman\",\"namawilayah\":\"Pontianak\"}','Budiman','2025-05-27 08:22:37','penjualan','hapusData'),(1347,'[{\"id\":89,\"idpenjualan\":\"250527JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":10,\"hargasatuan\":\"15000\",\"hargadpp\":\"13703\",\"jumlahppn\":\"1297\",\"jumlahdiskon\":\"1905\",\"subtotaljual\":\"130950\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":10,\"diskonpersen2\":3,\"diskonpersen3\":0}]','Budiman','2025-05-27 08:22:37','penjualandetail','hapusData'),(1348,'{\"lastlogin\":\"2025-05-27 13:02:44\"}','Budiman','2025-05-27 13:02:44','pengguna','updateData'),(1349,'{\"idpenjualan\":\"250527JL0000001\",\"idkonsumen\":\"IPJ001\",\"noinvoice\":\"SJA\\/2505\\/000002\",\"tglinvoice\":\"2025-05-27\",\"keterangan\":\"Ket\",\"totaldpp\":\"135140\",\"totaldiskon\":\"0\",\"ppnpersen\":\"11\",\"totalppn\":\"14860\",\"totalinvoice\":\"150000\",\"inserted_date\":\"2025-05-27 13:30:38\",\"updated_date\":\"2025-05-27 13:30:38\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Piutang\",\"idbank\":null,\"idjenispiutang\":\"P03\",\"idsales\":\"SLSSKN0001\",\"nokwitansi\":null,\"nobilyetgiro\":null}','Budiman','2025-05-27 13:30:39','penjualan','simpanData'),(1350,'[{\"idpenjualan\":\"250527JL0000001\",\"idbarang\":\"K001000001\",\"jumlahjual\":\"10\",\"hargasatuan\":\"15000\",\"hargadpp\":\"13514\",\"jumlahppn\":\"1486\",\"jumlahdiskon\":\"0\",\"subtotaljual\":\"150000\",\"jenisdiskon\":\"Nominal\",\"diskonpersen1\":\"0\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-05-27 13:30:39','penjualandetail','simpanData'),(1351,'{\"idpenagihan\":\"250527TAG000001\",\"tglpenagihan\":\"2025-05-27\",\"idsales\":\"SLSJMQ0001\",\"totaltagihan\":\"11500000\",\"inserted_date\":\"2025-05-27 08:10:13\",\"updated_date\":\"2025-05-27 08:10:13\",\"idpengguna\":\"USRBID0001\",\"statuscetak\":\"Belum Cetak\",\"namasales\":\"Jaja Miharga\",\"npwpsales\":\"829182198291919\"}','Budiman','2025-05-27 13:32:19','penagihan','hapusDataPenagihan'),(1352,'[{\"id\":5,\"idpenagihan\":\"250527TAG000001\",\"idpiutang\":\"250522PI0001\",\"jumlahtagihan\":\"11500000\",\"idsalesbonus\":\"SLSJMQ0001\"}]','Budiman','2025-05-27 13:32:19','penagihandetail','hapusDataPenagihan'),(1353,'{\"idhutangekspedisi\":\"250527HEX000001\",\"idtransaksi\":\"250527SJ01\",\"tglhutang\":\"2025-05-27\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":0,\"kredit\":\"100000\",\"keterangan\":\"Hutang ekspedisi dengan No. Surat Jalan 250527SJ01\",\"jenissumber\":\"Penjualan\",\"jenis\":\"Hutang\"}','Budiman','2025-05-27 13:37:53','hutangekspedisi','penerimaanPembelian'),(1354,'{\"idsuratjalan\":\"250527SJ01\",\"tglsuratjalan\":\"2025-05-27\",\"idkonsumen\":\"IPJ001\",\"idekspedisi\":\"EKSOHRR001\",\"idjenisekspedisi\":\"001\",\"biayapengiriman\":\"100000\",\"identitasekspedisi\":\"Nomor Plat: KB2244GG\",\"totaltagihan\":\"150000\",\"inserted_date\":\"2025-05-27 13:37:53\",\"updated_date\":\"2025-05-27 13:37:53\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-27 13:37:53','suratjalan','simpanData'),(1355,'[{\"idsuratjalan\":\"250527SJ01\",\"idpenjualan\":\"250527JL0000001\"}]','Budiman','2025-05-27 13:37:53','suratjalandetail','simpanData'),(1356,'[{\"idsuratjalan\":\"250527SJ01\",\"qty\":\"1\",\"satuan\":\"Paket\",\"keterangan\":\"Kayu\"}]','Budiman','2025-05-27 13:37:53','suratjalanrincian','simpanData'),(1357,'{\"idpenagihan\":\"250527TAG000001\",\"tglpenagihan\":\"2025-05-27\",\"tgltagihanakhir\":\"2025-06-08\",\"idsales\":\"SLSSKN0001\",\"totaltagihan\":\"150000\",\"inserted_date\":\"2025-05-27 14:00:29\",\"updated_date\":\"2025-05-27 14:00:29\",\"idpengguna\":\"USRBID0001\",\"statuscetak\":\"Belum Cetak\"}','Budiman','2025-05-27 14:00:29','penagihan','simpanDataPenagihan'),(1358,'[{\"idpenagihan\":\"250527TAG000001\",\"idpiutang\":\"250527PI0001\",\"idsalesbonus\":\"SLSSKN0001\",\"jumlahtagihan\":\"150000\"}]','Budiman','2025-05-27 14:00:29','penagihandetail','simpanDataPenagihan'),(1359,'{\"idpenagihan\":\"250527TAG000001\",\"tglpenagihan\":\"2025-05-27\",\"idsales\":\"SLSSKN0001\",\"totaltagihan\":\"150000\",\"inserted_date\":\"2025-05-27 14:00:29\",\"updated_date\":\"2025-05-27 14:00:29\",\"idpengguna\":\"USRBID0001\",\"statuscetak\":\"Belum Cetak\",\"namasales\":\"Siti Khadizah\",\"npwpsales\":\"456456456456456\"}','Budiman','2025-05-27 14:47:58','penagihan','hapusDataPenagihan'),(1360,'[{\"id\":6,\"idpenagihan\":\"250527TAG000001\",\"idpiutang\":\"250527PI0001\",\"jumlahtagihan\":\"150000\",\"idsalesbonus\":\"SLSSKN0001\"}]','Budiman','2025-05-27 14:47:58','penagihandetail','hapusDataPenagihan'),(1361,'{\"idhutangekspedisi\":\"250527HEX000002\",\"idtransaksi\":\"250527SJ02\",\"tglhutang\":\"2025-05-27\",\"idekspedisi\":\"EKSPWRU001\",\"debet\":0,\"kredit\":\"35000\",\"keterangan\":\"Hutang ekspedisi dengan No. Surat Jalan 250527SJ02\",\"jenissumber\":\"Penjualan\",\"jenis\":\"Hutang\"}','Budiman','2025-05-27 16:43:12','hutangekspedisi','penerimaanPembelian'),(1362,'{\"idsuratjalan\":\"250527SJ02\",\"tglsuratjalan\":\"2025-05-27\",\"idkonsumen\":\"KUE001\",\"idekspedisi\":\"EKSPWRU001\",\"idjenisekspedisi\":\"001\",\"biayapengiriman\":\"35000\",\"identitasekspedisi\":\"Nomor Plat. KB3434FF\",\"totaltagihan\":\"11500000\",\"inserted_date\":\"2025-05-27 16:43:12\",\"updated_date\":\"2025-05-27 16:43:12\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-27 16:43:12','suratjalan','simpanData'),(1363,'[{\"idsuratjalan\":\"250527SJ02\",\"idpenjualan\":\"250522JL0000001\"}]','Budiman','2025-05-27 16:43:12','suratjalandetail','simpanData'),(1364,'[{\"idsuratjalan\":\"250527SJ02\",\"qty\":\"1\",\"satuan\":\"Paket\",\"keterangan\":\"Kayu aja\"}]','Budiman','2025-05-27 16:43:12','suratjalanrincian','simpanData'),(1365,'{\"idpenagihan\":\"250527TAG000001\",\"tglpenagihan\":\"2025-05-27\",\"tgltagihanakhir\":\"2025-06-08\",\"idsales\":\"SLSJMQ0001\",\"totaltagihan\":\"11650000\",\"inserted_date\":\"2025-05-27 16:43:53\",\"updated_date\":\"2025-05-27 16:43:53\",\"idpengguna\":\"USRBID0001\",\"statuscetak\":\"Belum Cetak\"}','Budiman','2025-05-27 16:43:53','penagihan','simpanDataPenagihan'),(1366,'[{\"idpenagihan\":\"250527TAG000001\",\"idpiutang\":\"250522PI0001\",\"idsalesbonus\":\"SLSJMQ0001\",\"jumlahtagihan\":\"11500000\"},{\"idpenagihan\":\"250527TAG000001\",\"idpiutang\":\"250527PI0001\",\"idsalesbonus\":\"SLSSKN0001\",\"jumlahtagihan\":\"150000\"}]','Budiman','2025-05-27 16:43:53','penagihandetail','simpanDataPenagihan'),(1367,'{\"idbarang\":\"K001000003\",\"namabarang\":\"Papan 26Inc\",\"idkategori\":\"K001\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"45000\",\"hargajualasli\":\"54000\",\"hargajualdiskon\":\"54000\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.50\",\"inserted_date\":\"2025-05-27 17:41:54\",\"updated_date\":\"2025-05-27 17:41:54\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-27 17:41:54','barang','simpanData'),(1368,'{\"idbarang\":\"K001000003\",\"namabarang\":\"Papan 26Inc\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"45000\",\"hargajualasli\":\"54000\",\"hargajualdiskon\":\"54000\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Nominal\",\"jumlahbonustagihan\":\"200\",\"persenbonustagihan\":0,\"updated_date\":\"2025-05-27 17:47:10\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-27 17:47:10','barang','updateData'),(1369,'{\"idbarang\":\"K001000002\",\"namabarang\":\"Kayu 4x6 Pelang\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"45000\",\"hargajualasli\":\"48000\",\"hargajualdiskon\":\"48000\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.30\",\"updated_date\":\"2025-05-27 17:51:30\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-27 17:51:31','barang','updateData'),(1370,'{\"lastlogin\":\"2025-05-28 00:56:07\"}','Budiman','2025-05-28 00:56:07','pengguna','updateData'),(1371,'{\"lastlogin\":\"2025-05-28 08:06:49\"}','Budiman','2025-05-28 08:06:49','pengguna','updateData'),(1372,'{\"lastlogin\":\"2025-05-28 14:03:35\"}','Budiman','2025-05-28 14:03:35','pengguna','updateData'),(1373,'{\"idbarang\":\"K001000001\",\"namabarang\":\"Papan Mal\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"14000\",\"hargajualasli\":\"15000\",\"hargajualdiskon\":\"15000\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.30\",\"updated_date\":\"2025-05-28 15:44:12\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-28 15:44:12','barang','updateData'),(1374,'{\"idbarang\":\"W001000001\",\"namabarang\":\"Pipa 5In\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"100000\",\"hargajualasli\":\"120000\",\"hargajualdiskon\":\"120000\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.30\",\"updated_date\":\"2025-05-28 15:44:30\",\"statusaktif\":\"Aktif\"}','Budiman','2025-05-28 15:44:30','barang','updateData'),(1375,'{\"lastlogin\":\"2025-05-29 08:59:28\"}','Budiman','2025-05-29 08:59:28','pengguna','updateData'),(1379,'{\"idpiutangdetail\":\"250527PI0001002\",\"idpiutang\":\"250527PI0001\",\"tglpiutang\":\"2025-05-29\",\"debet\":0,\"kredit\":\"150000\",\"inserted_date\":\"2025-05-29 09:40:32\",\"updated_date\":\"2025-05-29 09:40:32\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250527JL0000001#01\"}','Budiman','2025-05-29 09:40:32','piutangdetail','simpanData'),(1380,'{\"idpiutangdetail\":\"250527PI0001002\",\"idpiutang\":\"250527PI0001\",\"tglpiutang\":\"2025-05-29\",\"debet\":\"0\",\"kredit\":\"150000\",\"inserted_date\":\"2025-05-29 09:40:32\",\"updated_date\":\"2025-05-29 09:40:32\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250527JL0000001\",\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"nokwitansi\":\"250527JL0000001#01\",\"nobilyetgiro\":null}','Budiman','2025-05-29 09:41:54','piutangdetail','hapusData'),(1382,'{\"idpiutangdetail\":\"250527PI0001002\",\"idpiutang\":\"250527PI0001\",\"tglpiutang\":\"2025-05-29\",\"debet\":0,\"kredit\":\"150000\",\"inserted_date\":\"2025-05-29 09:43:51\",\"updated_date\":\"2025-05-29 09:43:51\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250527JL0000001#01\"}','Budiman','2025-05-29 09:43:51','piutangdetail','simpanData'),(1383,'{\"idpiutangdetail\":\"250527PI0001002\",\"idpiutang\":\"250527PI0001\",\"tglpiutang\":\"2025-05-29\",\"debet\":\"0\",\"kredit\":\"150000\",\"inserted_date\":\"2025-05-29 09:43:51\",\"updated_date\":\"2025-05-29 09:43:51\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250527JL0000001\",\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"nokwitansi\":\"250527JL0000001#01\",\"nobilyetgiro\":null}','Budiman','2025-05-29 09:44:11','piutangdetail','hapusData'),(1384,'{\"idpiutangdetail\":\"250527PI0001002\",\"idpiutang\":\"250527PI0001\",\"tglpiutang\":\"2025-05-29\",\"debet\":0,\"kredit\":\"150000\",\"inserted_date\":\"2025-05-29 09:44:29\",\"updated_date\":\"2025-05-29 09:44:29\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"nobilyetgiro\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250527JL0000001#01\"}','Budiman','2025-05-29 09:44:29','piutangdetail','simpanData'),(1385,'{\"lastlogin\":\"2025-05-29 16:48:04\"}','Budiman','2025-05-29 16:48:04','pengguna','updateData'),(1386,'{\"lastlogin\":\"2025-05-30 01:02:26\"}','Budiman','2025-05-30 01:02:26','pengguna','updateData'),(1387,'{\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"jeniskelamin\":\"Perempuan\",\"nik\":\"1111111111111111\",\"tempatlahir\":\"Jakarta\",\"tgllahir\":\"2000-12-02\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"081302500000000\",\"email\":\"siti@gmail.com\",\"npwp\":\"456456456456456\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"mbarang.xls\",\"updated_date\":\"2025-05-30 02:26:34\",\"statusaktif\":\"Aktif\",\"targetpenjualan\":\"100000\"}','Budiman','2025-05-30 02:26:34','sales','updateData'),(1388,'{\"idsales\":\"SLSJMQ0001\",\"namasales\":\"Jaja Miharga\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3243243243242342\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-01-01\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"0812000000\",\"email\":\"NULL\",\"npwp\":\"829182198291919\",\"tglkontrak\":\"2025-05-20\",\"filekontrak\":null,\"updated_date\":\"2025-05-30 02:27:33\",\"statusaktif\":\"Aktif\",\"targetpenjualan\":\"100000\"}','Budiman','2025-05-30 02:27:33','sales','updateData'),(1389,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"targetpenjualan\":\"100000\",\"pencapaiantarget\":\"150000\",\"inserted_date\":\"2025-05-30 05:58:54\",\"updated_date\":\"2025-05-30 05:58:54\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 05:58:54','bonus','simpanData'),(1390,'[{\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"iddetailsuratjalan\":\"45\",\"totalinvoice\":\"150000\",\"totalbonus\":\"750\"}]','Budiman','2025-05-30 05:58:54','bonuspenjualan','simpanData'),(1391,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"targetpenjualan\":\"100000\",\"pencapaiantarget\":\"150000\",\"inserted_date\":\"2025-05-30 06:13:00\",\"updated_date\":\"2025-05-30 06:13:00\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 06:13:00','bonus','simpanData'),(1392,'[{\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"iddetailsuratjalan\":\"45\",\"totalinvoice\":\"150000\",\"totalbonus\":\"750\"}]','Budiman','2025-05-30 06:13:00','bonuspenjualan','simpanData'),(1393,'[{\"idpiutang\":\"250527PI0001\",\"idbonus\":\"250530BNS000001\",\"totaltagihan\":\"150000\",\"totalbonus\":\"450\"}]','Budiman','2025-05-30 06:13:00','bonuspenagihan','simpanData'),(1394,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"totalbonustargetmidle\":\"0\",\"totalbonustargetfast\":\"0\",\"totalbonustargetslow\":\"0\",\"inserted_date\":\"2025-05-30 06:13:00\",\"updated_date\":\"2025-05-30 06:13:00\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Siti Khadizah\",\"npwpsales\":\"456456456456456\"}','Budiman','2025-05-30 06:48:06','bonus','hapusDataBonus'),(1395,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"totalbonustargetmidle\":\"0\",\"totalbonustargetfast\":\"0\",\"totalbonustargetslow\":\"0\",\"inserted_date\":\"2025-05-30 06:13:00\",\"updated_date\":\"2025-05-30 06:13:00\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Siti Khadizah\",\"npwpsales\":\"456456456456456\"}','Budiman','2025-05-30 06:48:50','bonus','hapusDataBonus'),(1396,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"targetpenjualan\":\"100000\",\"pencapaiantarget\":\"150000\",\"inserted_date\":\"2025-05-30 07:14:13\",\"updated_date\":\"2025-05-30 07:14:13\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 07:14:13','bonus','simpanData'),(1397,'[{\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"iddetailsuratjalan\":\"45\",\"totalinvoice\":\"150000\",\"totalbonus\":\"750\"}]','Budiman','2025-05-30 07:14:13','bonuspenjualan','simpanData'),(1398,'[{\"idpiutang\":\"250527PI0001\",\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"totaltagihan\":\"150000\",\"totalbonus\":\"450\"}]','Budiman','2025-05-30 07:14:13','bonuspenagihan','simpanData'),(1399,'[{\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"totalinvoice\":\"150000\",\"totalbonus\":\"750\"}]','Budiman','2025-05-30 07:14:13','bonustarget','simpanData'),(1400,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"totalbonustargetmidle\":\"0\",\"totalbonustargetfast\":\"0\",\"totalbonustargetslow\":\"0\",\"inserted_date\":\"2025-05-30 07:14:13\",\"updated_date\":\"2025-05-30 07:14:13\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Siti Khadizah\",\"npwpsales\":\"456456456456456\"}','Budiman','2025-05-30 07:15:02','bonus','hapusDataBonus'),(1401,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"targetpenjualan\":\"100000\",\"pencapaiantarget\":\"150000\",\"inserted_date\":\"2025-05-30 07:15:57\",\"updated_date\":\"2025-05-30 07:15:57\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 07:15:57','bonus','simpanData'),(1402,'[{\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"iddetailsuratjalan\":\"45\",\"totalinvoice\":\"150000\",\"totalbonus\":\"750\"}]','Budiman','2025-05-30 07:15:57','bonuspenjualan','simpanData'),(1403,'[{\"idpiutang\":\"250527PI0001\",\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"totaltagihan\":\"150000\",\"totalbonus\":\"450\"}]','Budiman','2025-05-30 07:15:57','bonuspenagihan','simpanData'),(1404,'[{\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"totalinvoice\":\"150000\",\"totalbonus\":\"750\"}]','Budiman','2025-05-30 07:15:57','bonustarget','simpanData'),(1405,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"totalbonustarget\":\"0\",\"inserted_date\":\"2025-05-30 07:15:57\",\"updated_date\":\"2025-05-30 07:15:57\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Siti Khadizah\",\"npwpsales\":\"456456456456456\"}','Budiman','2025-05-30 07:27:33','bonus','hapusDataBonus'),(1406,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"targetpenjualan\":\"100000\",\"pencapaiantarget\":\"150000\",\"totalbonustarget\":\"750\",\"inserted_date\":\"2025-05-30 07:27:47\",\"updated_date\":\"2025-05-30 07:27:47\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 07:27:47','bonus','simpanData'),(1407,'[{\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"iddetailsuratjalan\":\"45\",\"totalinvoice\":\"150000\",\"totalbonus\":\"750\"}]','Budiman','2025-05-30 07:27:47','bonuspenjualan','simpanData'),(1408,'[{\"idpiutang\":\"250527PI0001\",\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"totaltagihan\":\"150000\",\"totalbonus\":\"450\"}]','Budiman','2025-05-30 07:27:47','bonuspenagihan','simpanData'),(1409,'[{\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"totalinvoice\":\"150000\",\"totalbonus\":\"750\"}]','Budiman','2025-05-30 07:27:47','bonustarget','simpanData'),(1410,'{\"lastlogin\":\"2025-05-30 10:49:39\"}','Budiman','2025-05-30 10:49:39','pengguna','updateData'),(1411,'{\"idbonus\":\"250530BNS000002\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"11500000\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"57500\",\"totalbonuspenagihan\":\"0\",\"targetpenjualan\":\"100000\",\"pencapaiantarget\":\"11500000\",\"totalbonustarget\":\"57500\",\"inserted_date\":\"2025-05-30 10:51:04\",\"updated_date\":\"2025-05-30 10:51:04\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 10:51:04','bonus','simpanData'),(1412,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250530BNS000002\",\"iddetailsuratjalan\":\"46\",\"totalinvoice\":\"11500000\",\"totalbonus\":\"57500\"}]','Budiman','2025-05-30 10:51:04','bonuspenjualan','simpanData'),(1413,'[]','Budiman','2025-05-30 10:51:04','bonuspenagihan','simpanData'),(1414,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250530BNS000002\",\"totalinvoice\":\"11500000\",\"totalbonus\":\"57500\"}]','Budiman','2025-05-30 10:51:04','bonustarget','simpanData'),(1415,'{\"idbonus\":\"250530BNS000003\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"0\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"0\",\"totalbonuspenagihan\":\"0\",\"targetpenjualan\":\"0\",\"pencapaiantarget\":\"0\",\"totalbonustarget\":\"0\",\"inserted_date\":\"2025-05-30 10:51:14\",\"updated_date\":\"2025-05-30 10:51:14\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 10:51:14','bonus','simpanData'),(1416,'[]','Budiman','2025-05-30 10:51:14','bonuspenjualan','simpanData'),(1417,'[]','Budiman','2025-05-30 10:51:14','bonuspenagihan','simpanData'),(1418,'[]','Budiman','2025-05-30 10:51:14','bonustarget','simpanData'),(1419,'{\"idbonus\":\"250530BNS000003\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"0\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"0\",\"totalbonuspenagihan\":\"0\",\"totalbonustarget\":\"0\",\"inserted_date\":\"2025-05-30 10:51:14\",\"updated_date\":\"2025-05-30 10:51:14\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Jaja Miharga\",\"npwpsales\":\"829182198291919\"}','Budiman','2025-05-30 10:51:22','bonus','hapusDataBonus'),(1420,'{\"idbonus\":\"250530BNS000002\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"11500000\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"57500\",\"totalbonuspenagihan\":\"0\",\"totalbonustarget\":\"57500\",\"inserted_date\":\"2025-05-30 10:51:04\",\"updated_date\":\"2025-05-30 10:51:04\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Jaja Miharga\",\"npwpsales\":\"829182198291919\"}','Budiman','2025-05-30 10:55:47','bonus','hapusDataBonus'),(1421,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"totalbonustarget\":\"750\",\"inserted_date\":\"2025-05-30 07:27:47\",\"updated_date\":\"2025-05-30 07:27:47\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Siti Khadizah\",\"npwpsales\":\"456456456456456\"}','Budiman','2025-05-30 10:55:52','bonus','hapusDataBonus'),(1422,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"targetpenjualan\":\"100000\",\"pencapaiantarget\":\"150000\",\"totalbonustarget\":\"750\",\"inserted_date\":\"2025-05-30 10:57:03\",\"updated_date\":\"2025-05-30 10:57:03\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 10:57:03','bonus','simpanData'),(1423,'[{\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"iddetailsuratjalan\":\"45\",\"totalinvoice\":\"150000\",\"totalbonus\":\"750\"}]','Budiman','2025-05-30 10:57:03','bonuspenjualan','simpanData'),(1424,'[{\"idpiutang\":\"250527PI0001\",\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"totaltagihan\":\"150000\",\"totalbonus\":\"450\"}]','Budiman','2025-05-30 10:57:03','bonuspenagihan','simpanData'),(1425,'[{\"idpenjualan\":\"250527JL0000001\",\"idbonus\":\"250530BNS000001\",\"totalinvoice\":\"150000\",\"totalbonus\":\"750\"}]','Budiman','2025-05-30 10:57:03','bonustarget','simpanData'),(1426,'{\"idbonus\":\"250530BNS000002\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"11500000\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"57500\",\"totalbonuspenagihan\":\"0\",\"targetpenjualan\":\"100000\",\"pencapaiantarget\":\"11500000\",\"totalbonustarget\":\"57500\",\"inserted_date\":\"2025-05-30 10:58:56\",\"updated_date\":\"2025-05-30 10:58:56\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 10:58:56','bonus','simpanData'),(1427,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250530BNS000002\",\"iddetailsuratjalan\":\"46\",\"totalinvoice\":\"11500000\",\"totalbonus\":\"57500\"}]','Budiman','2025-05-30 10:58:56','bonuspenjualan','simpanData'),(1428,'[]','Budiman','2025-05-30 10:58:56','bonuspenagihan','simpanData'),(1429,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250530BNS000002\",\"totalinvoice\":\"11500000\",\"totalbonus\":\"57500\"}]','Budiman','2025-05-30 10:58:56','bonustarget','simpanData'),(1430,'{\"idbonus\":\"250530BNS000002\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"11500000\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"57500\",\"totalbonuspenagihan\":\"0\",\"totalbonustarget\":\"57500\",\"inserted_date\":\"2025-05-30 10:58:56\",\"updated_date\":\"2025-05-30 10:58:56\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Jaja Miharga\",\"npwpsales\":\"829182198291919\"}','Budiman','2025-05-30 10:59:25','bonus','hapusDataBonus'),(1431,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSSKN0001\",\"keterangan\":null,\"totalpenjualan\":\"150000\",\"totalpenagihan\":\"150000\",\"totalbonuspenjualan\":\"750\",\"totalbonuspenagihan\":\"450\",\"totalbonustarget\":\"750\",\"inserted_date\":\"2025-05-30 10:57:03\",\"updated_date\":\"2025-05-30 10:57:03\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Siti Khadizah\",\"npwpsales\":\"456456456456456\"}','Budiman','2025-05-30 10:59:30','bonus','hapusDataBonus'),(1432,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"11500000\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"57500\",\"totalbonuspenagihan\":\"0\",\"targetpenjualan\":\"100000\",\"pencapaiantarget\":\"11500000\",\"totalbonustarget\":\"57500\",\"inserted_date\":\"2025-05-30 10:59:50\",\"updated_date\":\"2025-05-30 10:59:50\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 10:59:50','bonus','simpanData'),(1433,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250530BNS000001\",\"iddetailsuratjalan\":\"46\",\"totalinvoice\":\"11500000\",\"totalbonus\":\"57500\"}]','Budiman','2025-05-30 10:59:50','bonuspenjualan','simpanData'),(1434,'[]','Budiman','2025-05-30 10:59:50','bonuspenagihan','simpanData'),(1435,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250530BNS000001\",\"totalinvoice\":\"11500000\",\"totalbonus\":\"57500\"}]','Budiman','2025-05-30 10:59:50','bonustarget','simpanData'),(1436,'{\"lastlogin\":\"2025-05-30 14:26:15\"}','Budiman','2025-05-30 14:26:15','pengguna','updateData'),(1437,'{\"idsales\":\"SLSJMQ0001\",\"namasales\":\"Jaja Miharga\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3243243243242342\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-01-01\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"0812000000\",\"email\":\"NULL\",\"npwp\":\"829182198291919\",\"tglkontrak\":\"2025-05-20\",\"filekontrak\":null,\"updated_date\":\"2025-05-30 15:00:50\",\"statusaktif\":\"Aktif\",\"targetpenjualan\":\"1000000\"}','Budiman','2025-05-30 15:00:50','sales','updateData'),(1438,'{\"idsales\":\"SLSSKN0001\",\"namasales\":\"Siti Khadizah\",\"jeniskelamin\":\"Perempuan\",\"nik\":\"1111111111111111\",\"tempatlahir\":\"Jakarta\",\"tgllahir\":\"2000-12-02\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"081302500000000\",\"email\":\"siti@gmail.com\",\"npwp\":\"456456456456456\",\"tglkontrak\":\"2025-02-25\",\"filekontrak\":\"mbarang.xls\",\"updated_date\":\"2025-05-30 15:01:00\",\"statusaktif\":\"Aktif\",\"targetpenjualan\":\"1000000\"}','Budiman','2025-05-30 15:01:00','sales','updateData'),(1439,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"11500000\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"57500\",\"totalbonuspenagihan\":\"0\",\"totalbonustarget\":\"57500\",\"inserted_date\":\"2025-05-30 10:59:50\",\"updated_date\":\"2025-05-30 10:59:50\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Jaja Miharga\",\"npwpsales\":\"829182198291919\"}','Budiman','2025-05-30 15:01:07','bonus','hapusDataBonus'),(1440,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"11500000\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"57500\",\"totalbonuspenagihan\":\"0\",\"targetpenjualan\":\"1000000\",\"pencapaiantarget\":\"11500000\",\"totalbonustarget\":\"57500\",\"inserted_date\":\"2025-05-30 15:01:18\",\"updated_date\":\"2025-05-30 15:01:18\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 15:01:18','bonus','simpanData'),(1441,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250530BNS000001\",\"iddetailsuratjalan\":\"46\",\"totalinvoice\":\"11500000\",\"totalbonus\":\"57500\"}]','Budiman','2025-05-30 15:01:18','bonuspenjualan','simpanData'),(1442,'[]','Budiman','2025-05-30 15:01:18','bonuspenagihan','simpanData'),(1443,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250530BNS000001\",\"totalinvoice\":\"11500000\",\"totalbonus\":\"57500\"}]','Budiman','2025-05-30 15:01:18','bonustarget','simpanData'),(1444,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"11500000\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"57500\",\"totalbonuspenagihan\":\"0\",\"totalbonustarget\":\"57500\",\"inserted_date\":\"2025-05-30 15:01:18\",\"updated_date\":\"2025-05-30 15:01:18\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Jaja Miharga\",\"npwpsales\":\"829182198291919\"}','Budiman','2025-05-30 15:01:47','bonus','hapusDataBonus'),(1445,'{\"idsales\":\"SLSJMQ0001\",\"namasales\":\"Jaja Miharga\",\"jeniskelamin\":\"Laki-laki\",\"nik\":\"3243243243242342\",\"tempatlahir\":\"Pontianak\",\"tgllahir\":\"1990-01-01\",\"agama\":\"Islam\",\"alamatktp\":\"Jl. Patimura\",\"alamattinggal\":\"Jl. Patimura\",\"statusperkawinan\":\"Kawin\",\"nowa\":\"0812000000\",\"email\":\"NULL\",\"npwp\":\"829182198291919\",\"tglkontrak\":\"2025-05-20\",\"filekontrak\":null,\"updated_date\":\"2025-05-30 15:03:19\",\"statusaktif\":\"Aktif\",\"targetpenjualan\":\"10000000\"}','Budiman','2025-05-30 15:03:19','sales','updateData'),(1446,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"11500000\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"57500\",\"totalbonuspenagihan\":\"0\",\"targetpenjualan\":\"10000000\",\"pencapaiantarget\":\"11500000\",\"totalbonustarget\":\"57500\",\"inserted_date\":\"2025-05-30 15:03:33\",\"updated_date\":\"2025-05-30 15:03:33\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-05-30 15:03:33','bonus','simpanData'),(1447,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250530BNS000001\",\"iddetailsuratjalan\":\"46\",\"totalinvoice\":\"11500000\",\"totalbonus\":\"57500\"}]','Budiman','2025-05-30 15:03:33','bonuspenjualan','simpanData'),(1448,'[]','Budiman','2025-05-30 15:03:33','bonuspenagihan','simpanData'),(1449,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250530BNS000001\",\"totalinvoice\":\"11500000\",\"totalbonus\":\"57500\"}]','Budiman','2025-05-30 15:03:33','bonustarget','simpanData'),(1450,'{\"lastlogin\":\"2025-05-30 16:33:53\"}','Budiman','2025-05-30 16:33:53','pengguna','updateData'),(1451,'{\"lastlogin\":\"2025-05-30 16:34:19\"}','Budiman','2025-05-30 16:34:19','pengguna','updateData'),(1452,'{\"lastlogin\":\"2025-06-06 03:38:06\"}','Budiman','2025-06-06 03:38:06','pengguna','updateData'),(1453,'{\"prefix\":\"bonus_penjualan_default\",\"values\":\"0.50\",\"inserted_date\":\"2025-06-06 03:40:07\",\"updated_date\":\"2025-06-06 03:40:07\",\"deskripsi\":\"default bonus penjualan di master barang dalam persen. 2 digit decimal\"}','Budiman','2025-06-06 03:40:07','settings','simpanData'),(1454,'{\"lastlogin\":\"2025-06-06 03:40:15\"}','Budiman','2025-06-06 03:40:15','pengguna','updateData'),(1455,'{\"prefix\":\"bonus_penagihan_default\",\"values\":\"0.50\",\"inserted_date\":\"2025-06-06 03:44:54\",\"updated_date\":\"2025-06-06 03:44:54\",\"deskripsi\":\"Bonus penagihan default di master barang dalam persen. 2 digit decimal\"}','Budiman','2025-06-06 03:44:54','settings','simpanData'),(1456,'{\"lastlogin\":\"2025-06-06 03:45:12\"}','Budiman','2025-06-06 03:45:12','pengguna','updateData'),(1457,'{\"idpembelian\":\"250606BL0000001\",\"idsupplier\":\"SUPMUF0001\",\"ppnpersen\":\"11\",\"tgl_po\":\"2025-06-06\",\"keterangan_po\":\"Pembelian\",\"totaldpp_po\":\"4054100\",\"totalppn_po\":\"445900\",\"totalfaktur_po\":\"4500000\",\"inserted_date\":\"2025-06-06 04:06:35\",\"updated_date\":\"2025-06-06 04:06:35\",\"idpengguna_po\":\"USRBID0001\"}','Budiman','2025-06-06 04:06:35','pembelian','simpanData'),(1458,'[{\"idpembelian\":\"250606BL0000001\",\"idbarang\":\"K001000003\",\"jumlahbeli_po\":\"100\",\"hargasatuan_po\":\"45000\",\"hargadpp_po\":\"40541\",\"jumlahppn_po\":\"4459\",\"subtotalbeli_po\":\"4500000\"}]','Budiman','2025-06-06 04:06:35','pembeliandetail','simpanData'),(1459,'{\"idpembelian\":\"250606BL0000001\",\"nofaktur\":\"123EE\",\"tglfaktur\":\"2025-06-06\",\"tglditerima\":\"2025-06-06\",\"idsupplier\":\"SUPMUF0001\",\"idekspedisi\":\"EKSOHRR001\",\"keterangan\":\"Test\",\"totaldpp\":\"4054100\",\"totaldiskon\":\"450000\",\"ppnpersen\":\"11\",\"totalppn\":\"445900\",\"totalpotongan\":\"0\",\"totalfaktur\":\"4050000\",\"biayapengiriman\":0,\"updated_date\":\"2025-06-06 04:13:38\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Hutang\",\"idbank\":null,\"nobilyetgiro\":null,\"tglbilyetgiro\":\"2025-06-06\",\"statuspenerimaan\":\"Sudah Diterima\"}','Budiman','2025-06-06 04:13:38','pembelian','penerimaanPembelian'),(1460,'[{\"idpembelian\":\"250606BL0000001\",\"iddetail\":\"80\",\"idbarang\":\"K001000003\",\"jumlahbeli\":\"100\",\"hargasatuan\":\"45000\",\"hargadpp\":\"40541\",\"jumlahppn\":\"4459\",\"jumlahdiskon\":\"4500\",\"subtotalbeli\":\"4050000\",\"jenisdiskon\":\"Persen\",\"diskonpersen1\":\"10\",\"diskonpersen2\":\"0\",\"diskonpersen3\":\"0\"}]','Budiman','2025-06-06 04:13:38','pembeliandetail','penerimaanPembelian'),(1461,'{\"lastlogin\":\"2025-07-10 16:48:16\"}','Budiman','2025-07-10 16:48:16','pengguna','updateData'),(1462,'{\"idbarang\":\"B001000002\",\"kdbarang\":\"ASD3819111\",\"namabarang\":\"Besi Pagar\",\"idkategori\":\"B001\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"stokminimum\":\"100\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.50\",\"inserted_date\":\"2025-07-10 17:04:55\",\"updated_date\":\"2025-07-10 17:04:55\",\"statusaktif\":\"Aktif\"}','Budiman','2025-07-10 17:04:55','barang','simpanData'),(1463,'{\"idbarang\":\"B001000002\",\"kdbarang\":\"ASD3819111\",\"namabarang\":\"Besi Pagar\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"stokminimum\":null,\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.50\",\"updated_date\":\"2025-07-10 17:07:48\",\"statusaktif\":\"Aktif\"}','Budiman','2025-07-10 17:07:48','barang','updateData'),(1464,'{\"idbarang\":\"B001000002\",\"kdbarang\":\"ASD3819111\",\"namabarang\":\"Besi Pagar\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"stokminimum\":\"100\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.50\",\"updated_date\":\"2025-07-10 17:13:23\",\"statusaktif\":\"Aktif\"}','Budiman','2025-07-10 17:13:23','barang','updateData'),(1465,'{\"idbarang\":\"B001000002\",\"kdbarang\":\"ASD3819111\",\"namabarang\":\"Besi Pagar\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"stokminimum\":\"120\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.50\",\"updated_date\":\"2025-07-10 17:14:12\",\"statusaktif\":\"Aktif\"}','Budiman','2025-07-10 17:14:12','barang','updateData'),(1466,'{\"idbarang\":\"B001000002\",\"kdbarang\":\"ASD3819111\",\"namabarang\":\"Besi Pagar\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"stokminimum\":\"120\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.50\",\"updated_date\":\"2025-07-10 17:17:41\",\"statusaktif\":\"Aktif\"}','Budiman','2025-07-10 17:17:41','barang','updateData'),(1467,'{\"idbarang\":\"B001000002\",\"kdbarang\":\"ASD3819111\",\"namabarang\":\"Besi Pagar\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"stokminimum\":\"120\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.50\",\"updated_date\":\"2025-07-10 17:18:45\",\"statusaktif\":\"Aktif\"}','Budiman','2025-07-10 17:18:45','barang','updateData'),(1468,'{\"idbarang\":\"K001000002\",\"kdbarang\":\"266S8182AB\",\"namabarang\":\"Kayu 4x6 Pelang\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"45000\",\"hargajualasli\":\"48000\",\"hargajualdiskon\":\"48000\",\"stokminimum\":\"0\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.30\",\"updated_date\":\"2025-07-10 17:19:01\",\"statusaktif\":\"Aktif\"}','Budiman','2025-07-10 17:19:01','barang','updateData'),(1469,'{\"idbarang\":\"B001000002\",\"kdbarang\":\"ASD3819111\",\"namabarang\":\"Besi Pagar\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"stokminimum\":\"120\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.50\",\"jenisbonustagihan\":\"Nominal\",\"jumlahbonustagihan\":\"100\",\"persenbonustagihan\":0,\"updated_date\":\"2025-07-10 17:23:24\",\"statusaktif\":\"Aktif\"}','Budiman','2025-07-10 17:23:24','barang','updateDataBarang'),(1470,'{\"prefix\":\"bonus_penagihan_default\",\"values\":\"0.25\",\"updated_date\":\"2025-07-10 17:28:38\",\"deskripsi\":\"Bonus penagihan default di master barang dalam persen. 2 digit decimal\"}','Budiman','2025-07-10 17:28:38','settings','updateData'),(1471,'{\"prefix\":\"bonus_penjualan_default\",\"values\":\"0.25\",\"updated_date\":\"2025-07-10 17:28:54\",\"deskripsi\":\"default bonus penjualan di master barang dalam persen. 2 digit decimal\"}','Budiman','2025-07-10 17:28:54','settings','updateData'),(1472,'{\"idbarang\":\"B001000002\",\"kdbarang\":\"ASD3819111\",\"namabarang\":\"Besi Pagar\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"stokminimum\":\"120\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Nominal\",\"jumlahbonuspenjualan\":\"100\",\"persenbonuspenjualan\":0,\"jenisbonustagihan\":\"Nominal\",\"jumlahbonustagihan\":\"100\",\"persenbonustagihan\":0,\"updated_date\":\"2025-07-10 17:29:08\",\"statusaktif\":\"Aktif\"}','Budiman','2025-07-10 17:29:08','barang','updateDataBarang'),(1473,'{\"lastlogin\":\"2025-07-10 17:29:37\"}','Budiman','2025-07-10 17:29:37','pengguna','updateData'),(1474,'{\"idbarang\":\"B001000002\",\"kdbarang\":\"ASD3819111\",\"namabarang\":\"Besi Pagar\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"stokminimum\":\"120\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.25\",\"jenisbonustagihan\":\"Nominal\",\"jumlahbonustagihan\":\"100\",\"persenbonustagihan\":0,\"updated_date\":\"2025-07-10 17:31:06\",\"statusaktif\":\"Aktif\"}','Budiman','2025-07-10 17:31:06','barang','updateDataBarang'),(1475,'{\"idbarang\":\"B001000002\",\"kdbarang\":\"ASD3819111\",\"namabarang\":\"Besi Pagar\",\"kdakun\":\"1.1.02.01\",\"hargabeli\":\"20000\",\"hargajualasli\":\"22000\",\"hargajualdiskon\":\"22000\",\"stokminimum\":\"120\",\"idjenisbarang\":\"001\",\"jenisbonuspenjualan\":\"Persen\",\"jumlahbonuspenjualan\":0,\"persenbonuspenjualan\":\"0.25\",\"jenisbonustagihan\":\"Persen\",\"jumlahbonustagihan\":0,\"persenbonustagihan\":\"0.25\",\"updated_date\":\"2025-07-10 17:32:33\",\"statusaktif\":\"Aktif\"}','Budiman','2025-07-10 17:32:33','barang','updateDataBarang'),(1476,'{\"prefix\":\"ekspedisi_persen_ppn\",\"values\":\"1.1\",\"inserted_date\":\"2025-07-10 18:17:15\",\"updated_date\":\"2025-07-10 18:17:15\",\"deskripsi\":\"Jumlah persen ppn hutang ekspedisi\"}','Budiman','2025-07-10 18:17:15','settings','simpanData'),(1477,'{\"prefix\":\"ekspedisi_persen_pph23\",\"values\":\"2\",\"inserted_date\":\"2025-07-10 18:17:53\",\"updated_date\":\"2025-07-10 18:17:53\",\"deskripsi\":\"Jumlah persen pph23 hutang ekspedisi\"}','Budiman','2025-07-10 18:17:53','settings','simpanData'),(1478,'{\"lastlogin\":\"2025-07-10 18:28:40\"}','Budiman','2025-07-10 18:28:40','pengguna','updateData'),(1479,'{\"lastlogin\":\"2025-07-11 01:17:40\"}','Budiman','2025-07-11 01:17:40','pengguna','updateData'),(1480,'{\"idhutangekspedisi\":\"250711HEX000001\",\"tglhutang\":\"2025-07-11\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"25275000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Test\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"inserted_date\":\"2025-07-11 01:59:11\",\"updated_date\":\"2025-07-11 01:59:11\",\"hargadpp\":\"25000000\",\"persenppn\":\"1.1\",\"jumlahppn\":\"275000\",\"persenpph23\":null,\"jumlahpph23\":\"500000\"}','Budiman','2025-07-11 01:59:11','hutang','simpanData'),(1481,'{\"idhutangekspedisi\":\"250711HEX000002\",\"tglhutang\":\"2025-07-11\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2780250\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"test\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"inserted_date\":\"2025-07-11 02:01:04\",\"updated_date\":\"2025-07-11 02:01:04\",\"hargadpp\":\"2750000\",\"persenppn\":\"1.1\",\"jumlahppn\":\"30250\",\"persenpph23\":\"0.00\",\"jumlahpph23\":\"55000\"}','Budiman','2025-07-11 02:01:04','hutang','simpanData'),(1482,'{\"idhutangekspedisi\":\"250711HEX000003\",\"tglhutang\":\"2025-07-11\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"1263750\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Test\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"inserted_date\":\"2025-07-11 02:02:13\",\"updated_date\":\"2025-07-11 02:02:13\",\"hargadpp\":\"1250000\",\"persenppn\":\"1.1\",\"jumlahppn\":\"13750\",\"persenpph23\":\"2.00\",\"jumlahpph23\":\"25000\"}','Budiman','2025-07-11 02:02:13','hutang','simpanData'),(1483,'{\"idhutangekspedisi\":\"250711HEX000003\",\"tglhutang\":\"2025-07-11\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2022000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Test\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"updated_date\":\"2025-07-11 02:11:36\",\"hargadpp\":\"2000000\",\"persenppn\":\"1.10\",\"jumlahppn\":\"22000\",\"persenpph23\":\"2.00\",\"jumlahpph23\":\"40000\"}','Budiman','2025-07-11 02:11:36','hutang','updateData'),(1484,'{\"idhutangekspedisi\":\"250711HEX000003\",\"tglhutang\":\"2025-07-11\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2022000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Test\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"updated_date\":\"2025-07-11 02:11:55\",\"hargadpp\":\"2000000\",\"persenppn\":\"1.10\",\"jumlahppn\":\"22000\",\"persenpph23\":\"2.00\",\"jumlahpph23\":\"40000\"}','Budiman','2025-07-11 02:11:55','hutang','updateData'),(1485,'{\"idhutangekspedisi\":\"250711HEX000003\",\"tglhutang\":\"2025-07-11\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2022000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Test\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"updated_date\":\"2025-07-11 03:39:46\",\"hargadpp\":\"2000000\",\"persenppn\":\"1.10\",\"jumlahppn\":\"22000\",\"persenpph23\":\"2.00\",\"jumlahpph23\":\"40000\"}','Budiman','2025-07-11 03:39:46','hutang','updateData'),(1486,'{\"idhutangekspedisi\":\"250711HEX000003\",\"tglhutang\":\"2025-07-11\",\"idekspedisi\":\"EKSOHRR001\",\"debet\":\"2022000\",\"kredit\":0,\"jenissumber\":\"Pembayaran\",\"jenis\":\"Pembayaran\",\"keterangan\":\"Test\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"updated_date\":\"2025-07-11 03:39:53\",\"hargadpp\":\"2000000\",\"persenppn\":\"1.10\",\"jumlahppn\":\"22000\",\"persenpph23\":\"2.00\",\"jumlahpph23\":\"40000\"}','Budiman','2025-07-11 03:39:53','hutang','updateData'),(1487,'{\"idbonus\":\"250530BNS000001\",\"tglbonus\":\"2025-05-30\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"11500000\",\"totalpenagihan\":\"0\",\"totalbonuspenjualan\":\"57500\",\"totalbonuspenagihan\":\"0\",\"targetpenjualan\":\"10000000\",\"pencapaiantarget\":\"11500000\",\"totalbonustarget\":\"57500\",\"inserted_date\":\"2025-05-30 15:03:33\",\"updated_date\":\"2025-05-30 15:03:33\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Jaja Miharga\",\"npwpsales\":\"829182198291919\"}','Budiman','2025-07-11 03:41:04','bonus','hapusDataBonus'),(1488,'{\"idpiutangdetail\":\"250522PI0001002\",\"idpiutang\":\"250522PI0001\",\"tglpiutang\":\"2025-07-11\",\"debet\":0,\"kredit\":\"5000000\",\"inserted_date\":\"2025-07-11 03:56:26\",\"updated_date\":\"2025-07-11 03:56:26\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250522JL0000001#01\"}','Budiman','2025-07-11 03:56:26','piutangdetail','simpanData'),(1489,'{\"lastlogin\":\"2025-07-11 08:22:37\"}','Budiman','2025-07-11 08:22:37','pengguna','updateData'),(1490,'{\"idpiutangdetail\":\"250522PI0001002\",\"idpiutang\":\"250522PI0001\",\"tglpiutang\":\"2025-07-11\",\"debet\":\"0\",\"kredit\":\"5000000\",\"inserted_date\":\"2025-07-11 03:56:26\",\"updated_date\":\"2025-07-11 03:56:26\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250522JL0000001\",\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":null,\"nokwitansi\":\"250522JL0000001#01\",\"nobilyetgiro\":null}','Budiman','2025-07-11 09:25:42','piutangdetail','hapusData'),(1491,'{\"idpiutangdetail\":\"250522PI0001002\",\"idpiutang\":\"250522PI0001\",\"tglpiutang\":\"2025-05-29\",\"debet\":0,\"kredit\":\"5000000\",\"inserted_date\":\"2025-07-11 09:26:07\",\"updated_date\":\"2025-07-11 09:26:07\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250522JL0000001#01\"}','Budiman','2025-07-11 09:26:07','piutangdetail','simpanData'),(1492,'{\"idbonus\":\"250711BNS000001\",\"tglbonus\":\"2025-07-11\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"10360400\",\"totalpenagihan\":\"5000000\",\"totalbonuspenjualan\":\"51802\",\"totalbonuspenagihan\":\"14918\",\"targetpenjualan\":\"10000000\",\"pencapaiantarget\":\"11500000\",\"totalbonustarget\":\"25901\",\"inserted_date\":\"2025-07-11 10:03:57\",\"updated_date\":\"2025-07-11 10:03:57\",\"idpengguna\":\"USRBID0001\"}','Budiman','2025-07-11 10:03:57','bonus','simpanData'),(1493,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250711BNS000001\",\"iddetailsuratjalan\":\"46\",\"totalinvoice\":\"10360400\",\"totalbonus\":\"51802\"}]','Budiman','2025-07-11 10:03:57','bonuspenjualan','simpanData'),(1494,'[{\"idpiutang\":\"250522PI0001\",\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250711BNS000001\",\"totaltagihan\":\"11500000\",\"totalbonus\":\"14918\"}]','Budiman','2025-07-11 10:03:57','bonuspenagihan','simpanData'),(1495,'[{\"idpenjualan\":\"250522JL0000001\",\"idbonus\":\"250711BNS000001\",\"totalinvoice\":\"10360400\",\"totalbonus\":\"25901\"}]','Budiman','2025-07-11 10:03:57','bonustarget','simpanData'),(1496,'{\"idbonus\":\"250711BNS000001\",\"tglbonus\":\"2025-07-11\",\"idsales\":\"SLSJMQ0001\",\"keterangan\":null,\"totalpenjualan\":\"10360400\",\"totalpenagihan\":\"5000000\",\"totalbonuspenjualan\":\"51802\",\"totalbonuspenagihan\":\"14918\",\"targetpenjualan\":\"10000000\",\"pencapaiantarget\":\"11500000\",\"totalbonustarget\":\"25901\",\"inserted_date\":\"2025-07-11 10:03:57\",\"updated_date\":\"2025-07-11 10:03:57\",\"idpengguna\":\"USRBID0001\",\"namasales\":\"Jaja Miharga\",\"npwpsales\":\"829182198291919\"}','Budiman','2025-07-11 10:07:41','bonus','hapusDataBonus'),(1497,'{\"lastlogin\":\"2025-07-11 13:44:10\"}','Budiman','2025-07-11 13:44:10','pengguna','updateData'),(1498,'{\"idpiutangdetail\":\"250527PI0001002\",\"idpiutang\":\"250527PI0001\",\"tglpiutang\":\"2025-05-29\",\"debet\":\"0\",\"kredit\":\"150000\",\"inserted_date\":\"2025-05-29 09:44:29\",\"updated_date\":\"2025-05-29 09:44:29\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Transfer\",\"idbank\":\"BN001\",\"jenis\":\"Pembayaran Piutang\",\"idpenjualan\":\"250527JL0000001\",\"idjenispiutang\":\"P03\",\"namapengguna\":\"Budiman\",\"namabank\":\"May Bank\",\"nokwitansi\":\"250527JL0000001#01\",\"nobilyetgiro\":null}','Budiman','2025-07-11 13:59:22','piutangdetail','hapusData'),(1499,'{\"idpiutangdetail\":\"250522PI0001003\",\"idpiutang\":\"250522PI0001\",\"tglpiutang\":\"2025-07-11\",\"debet\":0,\"kredit\":\"6500000\",\"inserted_date\":\"2025-07-11 15:09:50\",\"updated_date\":\"2025-07-11 15:09:50\",\"idpengguna\":\"USRBID0001\",\"carabayar\":\"Tunai\",\"idbank\":null,\"nobilyetgiro\":null,\"jenis\":\"Pembayaran Piutang\",\"nokwitansi\":\"250522JL0000001#02\"}','Budiman','2025-07-11 15:09:50','piutangdetail','simpanData'),(1500,'{\"prefix\":\"usaha_nama\",\"values\":\"PT. SUKSES TAMA JAYA ABADI\",\"updated_date\":\"2025-07-11 18:12:52\",\"deskripsi\":null}','Budiman','2025-07-11 18:12:52','settings','updateData'),(1501,'{\"prefix\":\"usaha_nama_singkat\",\"values\":\"SJA\",\"updated_date\":\"2025-07-11 18:13:12\",\"deskripsi\":\"Singkatan Nama Usaha\"}','Budiman','2025-07-11 18:13:12','settings','updateData'),(1502,'{\"lastlogin\":\"2025-07-11 18:13:54\"}','Budiman','2025-07-11 18:13:54','pengguna','updateData');

/*Table structure for table `riwayathutangekspedisi` */

DROP TABLE IF EXISTS `riwayathutangekspedisi`;

CREATE TABLE `riwayathutangekspedisi` (
  `idriwayat` int NOT NULL,
  `tglriwayat` datetime DEFAULT NULL,
  `idtransaksi` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgltransaksi` date DEFAULT NULL,
  `idekspedisi` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `saldoawal` decimal(18,0) DEFAULT '0',
  `debet` decimal(18,0) DEFAULT '0',
  `kredit` decimal(18,0) DEFAULT '0',
  `saldoakhir` decimal(18,0) DEFAULT '0',
  `deskripsi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapengguna` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idtransaksi` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgltransaksi` date DEFAULT NULL,
  `idbarang` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stokawal` int DEFAULT NULL,
  `stokmasuk` int DEFAULT NULL,
  `stokkeluar` int DEFAULT NULL,
  `stokakhir` int DEFAULT NULL,
  `hargasebelumdiskon` decimal(18,0) DEFAULT NULL,
  `hargasetelahdiskon` decimal(18,0) DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namapengguna` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenistransaksi` enum('Pembelian','Penjualan','Retur Pembelian','Retur Penjualan','Stock Opname') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hargasatuan` decimal(18,0) DEFAULT NULL,
  `hargadpp` decimal(18,0) DEFAULT NULL,
  `jumlahppn` decimal(18,0) DEFAULT NULL,
  `jumlahdiskon` decimal(18,0) DEFAULT NULL,
  `subtotal` decimal(18,0) DEFAULT NULL,
  PRIMARY KEY (`idriwayat`),
  KEY `idbarang` (`idbarang`),
  CONSTRAINT `riwayatstok_ibfk_1` FOREIGN KEY (`idbarang`) REFERENCES `barang` (`idbarang`)
) ENGINE=InnoDB AUTO_INCREMENT=460 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `riwayatstok` */

insert  into `riwayatstok`(`idriwayat`,`tglriwayat`,`idtransaksi`,`tgltransaksi`,`idbarang`,`stokawal`,`stokmasuk`,`stokkeluar`,`stokakhir`,`hargasebelumdiskon`,`hargasetelahdiskon`,`deskripsi`,`idpengguna`,`namapengguna`,`jenistransaksi`,`hargasatuan`,`hargadpp`,`jumlahppn`,`jumlahdiskon`,`subtotal`) values (389,'2025-05-22 06:47:58','250522BL0000001','2025-01-01','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(390,'2025-05-22 06:47:58','250522BL0000001','2025-01-01','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(391,'2025-05-22 06:47:58','250522BL0000001','2025-01-01','W001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(392,'2025-05-22 06:48:14','250522BL0000001','2025-01-01','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(393,'2025-05-22 06:48:14','250522BL0000001','2025-01-01','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(394,'2025-05-22 06:48:14','250522BL0000001','2025-01-01','W001000001',1000,0,1000,0,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(395,'2025-05-22 06:48:52','250522BL0000001','2025-01-01','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(396,'2025-05-22 06:48:52','250522BL0000001','2025-01-01','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(397,'2025-05-22 06:48:52','250522BL0000001','2025-01-01','W001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(398,'2025-05-22 06:51:01','250522RB0000001','2025-05-22','K001000001',1000,0,10,990,NULL,14000,'Retur Pembelian','USRBID0001','Budiman','Retur Pembelian',NULL,NULL,NULL,NULL,NULL),(399,'2025-05-22 06:51:45','250522RB0000001','2025-05-22','K001000001',990,10,0,1000,NULL,14000,'Hapus data retur pembelian','USRBID0001','Budiman','Retur Pembelian',NULL,NULL,NULL,NULL,NULL),(400,'2025-05-22 06:53:14','250522BL0000001','2025-01-01','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(401,'2025-05-22 06:53:14','250522BL0000001','2025-01-01','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(402,'2025-05-22 06:53:14','250522BL0000001','2025-01-01','W001000001',1000,0,1000,0,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(403,'2025-05-22 06:54:46','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(404,'2025-05-22 06:54:46','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(405,'2025-05-22 06:54:46','250522BL0000001','2025-05-22','W001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(406,'2025-05-22 07:37:07','250522RB0000001','2025-05-22','W001000001',1000,0,50,950,NULL,100000,'Retur Pembelian','USRBID0001','Budiman','Retur Pembelian',NULL,NULL,NULL,NULL,NULL),(407,'2025-05-22 07:37:54','250522RB0000001','2025-05-22','W001000001',950,50,0,1000,NULL,100000,'Hapus data retur pembelian','USRBID0001','Budiman','Retur Pembelian',NULL,NULL,NULL,NULL,NULL),(412,'2025-05-22 12:22:46','250522SJ01','2025-05-22','W001000001',1000,0,100,900,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(413,'2025-05-22 12:33:25','250522SJ01','2025-05-22','W001000001',900,100,0,1000,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(414,'2025-05-22 12:33:25','250522SJ01','2025-05-22','W001000001',1000,0,100,900,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(415,'2025-05-22 12:50:43','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(416,'2025-05-22 12:50:43','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(417,'2025-05-22 12:50:43','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(418,'2025-05-22 12:51:45','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(419,'2025-05-22 12:51:45','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(420,'2025-05-22 12:51:45','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(421,'2025-05-22 12:53:55','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(422,'2025-05-22 12:53:55','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(423,'2025-05-22 12:53:55','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(424,'2025-05-22 12:54:21','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(425,'2025-05-22 12:54:21','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(426,'2025-05-22 12:54:21','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(427,'2025-05-22 12:54:40','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(428,'2025-05-22 12:54:40','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(429,'2025-05-22 12:54:40','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(430,'2025-05-22 12:55:16','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(431,'2025-05-22 12:55:16','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(432,'2025-05-22 12:55:16','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(433,'2025-05-22 13:01:04','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(434,'2025-05-22 13:01:04','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(435,'2025-05-22 13:01:04','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(436,'2025-05-22 13:01:45','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(437,'2025-05-22 13:01:45','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(438,'2025-05-22 13:01:45','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(439,'2025-05-22 13:26:23','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(440,'2025-05-22 13:26:23','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(441,'2025-05-22 13:26:23','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(442,'2025-05-22 14:22:36','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(443,'2025-05-22 14:22:36','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(444,'2025-05-22 14:22:36','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(445,'2025-05-22 14:23:31','250522BL0000001','2025-05-22','K001000001',1000,0,1000,0,14000,14000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(446,'2025-05-22 14:23:31','250522BL0000001','2025-05-22','K001000002',1000,0,1000,0,45000,45000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(447,'2025-05-22 14:23:31','250522BL0000001','2025-05-22','W001000001',900,0,1000,-100,100000,100000,'Hapus data pembelian','USRBID0001','Budiman','Pembelian',NULL,NULL,NULL,NULL,NULL),(448,'2025-05-22 14:24:24','250522BL0000001','2025-05-22','K001000001',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',14000,12613,1387,0,14000000),(449,'2025-05-22 14:24:24','250522BL0000001','2025-05-22','K001000002',0,1000,0,1000,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,0,45000000),(450,'2025-05-22 14:24:24','250522BL0000001','2025-05-22','W001000001',-100,1000,0,900,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',100000,90091,9909,0,100000000),(452,'2025-05-23 08:16:20','250522SJ01','2025-05-22','W001000001',900,100,0,1000,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(453,'2025-05-23 08:17:09','250523SJ01','2025-05-23','W001000001',1000,0,100,900,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(454,'2025-05-23 08:20:41','250523SJ01','2025-05-23','W001000001',900,100,0,1000,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(455,'2025-05-23 08:20:41','250523SJ01','2025-05-23','W001000001',1000,0,100,900,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(456,'2025-05-23 08:22:01','250523SJ01','2025-05-23','W001000001',900,100,0,1000,NULL,NULL,'Update data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(457,'2025-05-27 13:37:53','250527SJ01','2025-05-27','K001000001',1000,0,10,990,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',15000,13514,1486,0,150000),(458,'2025-05-27 16:43:12','250527SJ02','2025-05-27','W001000001',1000,0,100,900,NULL,NULL,'Tambah data surat jalan','USRBID0001','Budiman','Penjualan',120000,108604,11396,5000,11500000),(459,'2025-06-06 04:13:38','250606BL0000001','2025-06-06','K001000003',0,100,0,100,NULL,NULL,'Penerimaan faktur pembelian','USRBID0001','Budiman','Pembelian',45000,40541,4459,4500,4050000);

/*Table structure for table `saldoawal` */

DROP TABLE IF EXISTS `saldoawal`;

CREATE TABLE `saldoawal` (
  `idsaldoawal` char(4) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaldebet` decimal(18,0) DEFAULT NULL,
  `totalkredit` decimal(18,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idsaldoawal`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `saldoawal_ibfk_1` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `saldoawal` */

insert  into `saldoawal`(`idsaldoawal`,`tahun`,`totaldebet`,`totalkredit`,`inserted_date`,`updated_date`,`idpengguna`) values ('2025','2025',100000000,100000000,'2025-04-25 14:59:34','2025-04-25 14:59:34','USRBID0001');

/*Table structure for table `saldoawaldetail` */

DROP TABLE IF EXISTS `saldoawaldetail`;

CREATE TABLE `saldoawaldetail` (
  `idsaldoawal` char(4) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakun` char(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idsales` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `namasales` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jeniskelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nik` char(16) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tempatlahir` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgllahir` date DEFAULT NULL,
  `agama` enum('Islam','Katolik','Kristen Protestan','Hindu','Buddha','Konghucu') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamatktp` text COLLATE utf8mb4_general_ci,
  `alamattinggal` text COLLATE utf8mb4_general_ci,
  `statusperkawinan` enum('Kawin','Tidak Kawin','Janda/ Duda') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nowa` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglkontrak` date DEFAULT NULL,
  `filekontrak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `npwp` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `targetpenjualan` decimal(18,0) DEFAULT '0',
  PRIMARY KEY (`idsales`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `sales` */

insert  into `sales`(`idsales`,`namasales`,`jeniskelamin`,`nik`,`tempatlahir`,`tgllahir`,`agama`,`alamatktp`,`alamattinggal`,`statusperkawinan`,`nowa`,`email`,`tglkontrak`,`filekontrak`,`inserted_date`,`updated_date`,`statusaktif`,`npwp`,`targetpenjualan`) values ('SLSJMQ0001','Jaja Miharga','Laki-laki','3243243243242342','Pontianak','1990-01-01','Islam','Jl. Patimura','Jl. Patimura','Kawin','0812000000','NULL','2025-05-20',NULL,'2025-05-20 14:23:33','2025-05-30 15:03:19','Aktif','829182198291919',10000000),('SLSKES0001','Khairuddin','Laki-laki','1234444555566666','Pontianak','1990-03-13','Islam','Jl. Pemuda','Jl. Pelangi','Tidak Kawin','08135553330000','khairuddin@gmail.com','2025-03-13',NULL,'2025-03-13 06:40:22','2025-05-20 14:24:00','Aktif','123456789012345',100000000),('SLSSKN0001','Siti Khadizah','Perempuan','1111111111111111','Jakarta','2000-12-02','Islam','Jl. Patimura','Jl. Patimura','Kawin','081302500000000','siti@gmail.com','2025-02-25','mbarang.xls','2025-02-25 02:25:08','2025-05-30 15:01:00','Aktif','456456456456456',1000000);

/*Table structure for table `saleswilayah` */

DROP TABLE IF EXISTS `saleswilayah`;

CREATE TABLE `saleswilayah` (
  `idsaleswilayah` int NOT NULL AUTO_INCREMENT,
  `idsales` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idwilayah` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
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

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values ('9xhclz8xKt3GUsIslW4OVFg9f9iPeLeM833QdFT0',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTozNDp7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sYXBwZW5hZ2loYW5zYWxlcy9jZXRhay9wZGY/aWRzYWxlcz1TTFNKTVEwMDAxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6IktoRUV4SXZhRU9QZ1hBSE8zcmhLa3I5SFg0M05DWW9seFcwSlFpdTkiO3M6MTA6ImlkcGVuZ2d1bmEiO3M6MTA6IlVTUkJJRDAwMDEiO3M6MTI6Im5hbWFwZW5nZ3VuYSI7czo3OiJCdWRpbWFuIjtzOjExOiJpZG90b3Jpc2FzaSI7czo1OiJLTDAwMSI7czo4OiJ1c2VybmFtZSI7czo0OiJidWRpIjtzOjEyOiJmb3RvcGVuZ2d1bmEiO3M6ODE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91cGxvYWRzL3BlbmdndW5hL2thcnN0ZW5fd2luZWdlYXJ0XzFncm0ya2R3eWtjX3Vuc3BsYXNoLmpwZyI7czoxODoiYWt1bl9iYXJhbmdfZGFnYW5nIjtzOjY6IjEuMS4wMiI7czoyMzoiYWt1bl9iZWJhbl90cmFuc3BvcnRhc2kiO3M6OToiNS40LjAxLjAxIjtzOjg6ImFrdW5fa2FzIjtzOjY6IjEuMS4wMSI7czoxNDoiYWt1bl9rYXNfdHVuYWkiO3M6OToiMS4xLjAxLjAxIjtzOjE0OiJha3VuX3BlbWJlbGlhbiI7czo5OiI2LjEuMDEuMDEiO3M6MjU6ImFrdW5fcGVuZGFwYXRhbl9wZW5qdWFsYW4iO3M6OToiNC4xLjAxLjAxIjtzOjIxOiJha3VuX3BpdXRhbmdfa29uc3VtZW4iO3M6NjoiMS4xLjAzIjtzOjE4OiJha3VuX3BpdXRhbmdfdXNhaGEiO3M6OToiMS4xLjAzLjAxIjtzOjIwOiJha3VuX3V0YW5nX2Vrc3BlZGlzaSI7czo2OiIyLjEuMDEiO3M6MTQ6ImFrdW5fdXRhbmdfcHBuIjtzOjk6IjIuMi4wMS4wMiI7czoxOToiYWt1bl91dGFuZ19zdXBwbGllciI7czo2OiIyLjIuMDEiO3M6MTY6ImFrdW5fdXRhbmdfdXNhaGEiO3M6OToiMi4xLjAxLjAxIjtzOjIzOiJib251c19wZW5hZ2loYW5fZGVmYXVsdCI7czo0OiIwLjI1IjtzOjIzOiJib251c19wZW5qdWFsYW5fZGVmYXVsdCI7czo0OiIwLjI1IjtzOjI0OiJkZWZhdWx0X3BpdXRhbmdfa29uc3VtZW4iO3M6ODoiNTAwMDAwMDAiO3M6MjA6ImRlZmF1bHRfdGFyZ2V0X3NhbGVzIjtzOjk6IjEwMDAwMDAwMCI7czoyMjoiZWtzcGVkaXNpX3BlcnNlbl9wcGgyMyI7czoxOiIyIjtzOjIwOiJla3NwZWRpc2lfcGVyc2VuX3BwbiI7czozOiIxLjEiO3M6MTM6InBwbl9wZW1iZWxpYW4iO3M6MjoiMTEiO3M6MTM6InBwbl9wZW5qdWFsYW4iO3M6MjoiMTEiO3M6MzE6InN0b2tfcGVuanVhbGFuX2Rhcmlfc3VyYXRfamFsYW4iO3M6MToiMSI7czoxMjoidXNhaGFfYWxhbWF0IjtzOjM4OiJKbC4gUGVyanVhbmdhbiBOby4yMjIgDQpLb3RhIFBvbnRpYW5hayI7czoxMDoidXNhaGFfbG9nbyI7czo4OiJsb2dvLmpwZyI7czoxMDoidXNhaGFfbmFtYSI7czoyNjoiUFQuIFNVS1NFUyBUQU1BIEpBWUEgQUJBREkiO3M6MTg6InVzYWhhX25hbWFfc2luZ2thdCI7czozOiJTSkEiO3M6MTM6InVzYWhhX3RlbGVwb24iO3M6MTU6IigwNjg1KSAyMjMzNDQ1NSI7fQ==',1752257655);

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `prefix` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `values` text COLLATE utf8mb4_general_ci,
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
  `idstockopname` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `tglstockopname` datetime DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idstockopname` char(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idbarang` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stocksystem` int DEFAULT NULL,
  `stockopname` int DEFAULT NULL,
  `keterangandetail` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `idsupplier` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `namasupplier` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamatsupplier` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kontakperson` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelp` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `saldo` decimal(18,0) DEFAULT '0',
  `saldopajak` decimal(18,0) DEFAULT '0',
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `npwp` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kdakunutang` char(9) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idsupplier`),
  KEY `kdakunutang` (`kdakunutang`),
  CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`kdakunutang`) REFERENCES `akun` (`kdakun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `supplier` */

insert  into `supplier`(`idsupplier`,`namasupplier`,`alamatsupplier`,`kontakperson`,`notelp`,`email`,`saldo`,`saldopajak`,`inserted_date`,`updated_date`,`statusaktif`,`npwp`,`kdakunutang`) values ('SUPHPI0001','PT. Husada Prima','Jl. Pahlawan 2','Jojon','081200000000',NULL,0,0,'2025-05-20 14:46:40','2025-05-20 14:47:05','Aktif','189812918291219','2.2.01.01'),('SUPIMN0001','PT. Intra Makmur','Jl. Pemuda','Bambang','081300000','bambang@gmail.com',0,0,'2025-03-01 10:03:55','2025-05-20 14:47:30','Aktif','545215789625452','2.2.01.01'),('SUPMBD0001','CV. MAJU BERSAMA','Jl. Kebangkitan','Rudi','081200000000000','rudi@gmail.com',0,0,'2025-02-25 03:24:19','2025-05-20 14:47:21','Aktif','154865223157545','2.2.01.01'),('SUPMUF0001','PT. MILPO','Jakarta','Bpk. Tomi','081200000000','tomi@gmail.com',0,0,'2025-05-10 04:05:01','2025-05-20 14:47:53','Aktif','829292888999988','2.2.01.01');

/*Table structure for table `suratjalan` */

DROP TABLE IF EXISTS `suratjalan`;

CREATE TABLE `suratjalan` (
  `idsuratjalan` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `tglsuratjalan` date DEFAULT NULL,
  `idkonsumen` char(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tglcetak` datetime DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `totaltagihan` decimal(10,0) DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idekspedisi` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idjenisekspedisi` char(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `identitasekspedisi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `biayapengiriman` decimal(18,0) DEFAULT NULL,
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

insert  into `suratjalan`(`idsuratjalan`,`tglsuratjalan`,`idkonsumen`,`tglcetak`,`keterangan`,`totaltagihan`,`inserted_date`,`updated_date`,`idpengguna`,`idekspedisi`,`idjenisekspedisi`,`identitasekspedisi`,`biayapengiriman`) values ('250527SJ01','2025-05-27','IPJ001',NULL,NULL,150000,'2025-05-27 13:37:53','2025-05-27 13:37:53','USRBID0001','EKSOHRR001','001','Nomor Plat: KB2244GG',100000),('250527SJ02','2025-05-27','KUE001',NULL,NULL,11500000,'2025-05-27 16:43:12','2025-05-27 16:43:12','USRBID0001','EKSPWRU001','001','Nomor Plat. KB3434FF',35000);

/*Table structure for table `suratjalandetail` */

DROP TABLE IF EXISTS `suratjalandetail`;

CREATE TABLE `suratjalandetail` (
  `iddetailsuratjalan` int NOT NULL AUTO_INCREMENT,
  `idsuratjalan` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idpenjualan` char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`iddetailsuratjalan`),
  KEY `idsuratjalan` (`idsuratjalan`),
  KEY `idpenjualan` (`idpenjualan`),
  CONSTRAINT `suratjalandetail_ibfk_1` FOREIGN KEY (`idsuratjalan`) REFERENCES `suratjalan` (`idsuratjalan`),
  CONSTRAINT `suratjalandetail_ibfk_2` FOREIGN KEY (`idpenjualan`) REFERENCES `penjualan` (`idpenjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `suratjalandetail` */

insert  into `suratjalandetail`(`iddetailsuratjalan`,`idsuratjalan`,`idpenjualan`) values (45,'250527SJ01','250527JL0000001'),(46,'250527SJ02','250522JL0000001');

/*Table structure for table `suratjalanrincian` */

DROP TABLE IF EXISTS `suratjalanrincian`;

CREATE TABLE `suratjalanrincian` (
  `idsuratjalanrincian` int NOT NULL AUTO_INCREMENT,
  `idsuratjalan` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `satuan` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`idsuratjalanrincian`),
  KEY `idsuratjalan` (`idsuratjalan`),
  CONSTRAINT `suratjalanrincian_ibfk_1` FOREIGN KEY (`idsuratjalan`) REFERENCES `suratjalan` (`idsuratjalan`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `suratjalanrincian` */

insert  into `suratjalanrincian`(`idsuratjalanrincian`,`idsuratjalan`,`qty`,`satuan`,`keterangan`) values (21,'250527SJ01',1,'Paket','Kayu'),(22,'250527SJ02',1,'Paket','Kayu aja');

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
  `idwilayah` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `namawilayah` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inserted_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `statusaktif` enum('Aktif','Tidak Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  PRIMARY KEY (`idwilayah`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `wilayah` */

insert  into `wilayah`(`idwilayah`,`namawilayah`,`inserted_date`,`updated_date`,`statusaktif`) values ('001','Pontianak','2025-02-21 09:10:23','2025-02-21 09:10:26','Aktif'),('002','Singkawang','2025-02-21 03:12:27','2025-02-21 03:15:31','Aktif'),('003','Sanggau','2025-05-10 03:49:25','2025-05-10 03:49:25','Aktif');

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

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_suratjalan` AS select `suratjalan`.`idsuratjalan` AS `idsuratjalan`,`suratjalan`.`tglsuratjalan` AS `tglsuratjalan`,`suratjalan`.`idkonsumen` AS `idkonsumen`,`suratjalan`.`tglcetak` AS `tglcetak`,`suratjalan`.`keterangan` AS `keterangan`,`suratjalan`.`inserted_date` AS `inserted_date`,`suratjalan`.`updated_date` AS `updated_date`,`suratjalan`.`idpengguna` AS `idpengguna`,`pengguna`.`namapengguna` AS `namapengguna`,`suratjalan`.`totaltagihan` AS `totaltagihan`,`suratjalan`.`idekspedisi` AS `idekspedisi`,`suratjalan`.`idjenisekspedisi` AS `idjenisekspedisi`,`suratjalan`.`identitasekspedisi` AS `identitasekspedisi`,`suratjalan`.`biayapengiriman` AS `biayapengiriman`,`ekspedisi`.`namaekspedisi` AS `namaekspedisi`,`jenisekspedisi`.`namajenisekspedisi` AS `namajenisekspedisi`,`konsumen`.`namakonsumen` AS `namakonsumen`,`konsumen`.`alamatkonsumen` AS `alamatkonsumen`,`konsumen`.`notelpkonsumen` AS `notelpkonsumen`,`konsumen`.`emailkonsumen` AS `emailkonsumen`,`konsumen`.`nikpemilik` AS `nikpemilik`,`konsumen`.`namapemilik` AS `namapemilik`,`konsumen`.`notelppemilik` AS `notelppemilik`,`konsumen`.`nowapemilik` AS `nowapemilik`,`konsumen`.`npwp` AS `npwp`,`wilayah`.`namawilayah` AS `namawilayah` from (((((`suratjalan` join `pengguna` on((`suratjalan`.`idpengguna` = `pengguna`.`idpengguna`))) join `ekspedisi` on((`suratjalan`.`idekspedisi` = `ekspedisi`.`idekspedisi`))) join `jenisekspedisi` on((`suratjalan`.`idjenisekspedisi` = `jenisekspedisi`.`idjenisekspedisi`))) join `konsumen` on((`suratjalan`.`idkonsumen` = `konsumen`.`idkonsumen`))) left join `wilayah` on((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`))) */;

/*View structure for view v_suratjalan_groupconcat */

/*!50001 DROP TABLE IF EXISTS `v_suratjalan_groupconcat` */;
/*!50001 DROP VIEW IF EXISTS `v_suratjalan_groupconcat` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_suratjalan_groupconcat` AS select `v_suratjalan`.`idsuratjalan` AS `idsuratjalan`,`v_suratjalan`.`tglsuratjalan` AS `tglsuratjalan`,`v_suratjalan`.`idkonsumen` AS `idkonsumen`,`v_suratjalan`.`namakonsumen` AS `namakonsumen`,`v_suratjalan`.`idjenisekspedisi` AS `idjenisekspedisi`,`v_suratjalan`.`namajenisekspedisi` AS `namajenisekspedisi`,`v_suratjalan`.`idekspedisi` AS `idekspedisi`,`v_suratjalan`.`namaekspedisi` AS `namaekspedisi`,`v_suratjalan`.`identitasekspedisi` AS `identitasekspedisi`,`v_suratjalan`.`biayapengiriman` AS `biayapengiriman`,group_concat(`v_suratjalandetail`.`noinvoice` separator ' & ') AS `daftarnoinvoice` from (`v_suratjalan` join `v_suratjalandetail` on((`v_suratjalan`.`idsuratjalan` = `v_suratjalandetail`.`idsuratjalan`))) group by `v_suratjalan`.`idsuratjalan`,`v_suratjalan`.`tglsuratjalan`,`v_suratjalan`.`idkonsumen`,`v_suratjalan`.`namakonsumen`,`v_suratjalan`.`idjenisekspedisi`,`v_suratjalan`.`namajenisekspedisi`,`v_suratjalan`.`idekspedisi`,`v_suratjalan`.`namaekspedisi`,`v_suratjalan`.`identitasekspedisi`,`v_suratjalan`.`biayapengiriman` */;

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
