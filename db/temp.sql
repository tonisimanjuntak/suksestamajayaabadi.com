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

/*Table structure for table `pengguna_menus` */

DROP TABLE IF EXISTS `pengguna_menus`;

CREATE TABLE `pengguna_menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idpengguna` char(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idmenus` char(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hakaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idmenus` (`idmenus`),
  KEY `idpengguna` (`idpengguna`),
  CONSTRAINT `pengguna_menus_ibfk_1` FOREIGN KEY (`idmenus`) REFERENCES `menus` (`idmenus`),
  CONSTRAINT `pengguna_menus_ibfk_2` FOREIGN KEY (`idpengguna`) REFERENCES `pengguna` (`idpengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pengguna_menus` */

insert  into `pengguna_menus`(`id`,`idpengguna`,`idmenus`,`hakaksi`) values (116,'USRBID0001','M011','Lihat'),(117,'USRBID0001','M012','Lihat'),(118,'USRBID0001','M013','Lihat'),(119,'USRBID0001','M014','Lihat'),(120,'USRBID0001','M015','Lihat'),(121,'USRBID0001','M025','Lihat,Tambah,Edit,Hapus'),(122,'USRBID0001','M026','Lihat'),(123,'USRBID0001','M030','Lihat,Tambah,Edit,Hapus'),(124,'USRBID0001','M031','Lihat,Tambah,Edit,Hapus'),(125,'USRBID0001','M032','Lihat,Tambah,Edit,Hapus'),(126,'USRBID0001','M033','Lihat');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
