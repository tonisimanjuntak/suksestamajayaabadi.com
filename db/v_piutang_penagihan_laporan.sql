DELIMITER $$

USE `pointofsales`$$

DROP VIEW IF EXISTS `v_piutang_penagihan_laporan`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_piutang_penagihan_laporan` AS 
SELECT
  `piutang`.`idpiutang`             AS `idpiutang`,
  `piutang`.`idpenjualan`           AS `idpenjualan`,
  `piutang`.`idjenispiutang`        AS `idjenispiutang`,
  `piutang`.`tgljatuhtempo`         AS `tgljatuhtempo`,
  `piutang`.`idkonsumen`            AS `idkonsumen`,
  `piutang`.`tgllunas`              AS `tgllunas`,
  `konsumen`.`namakonsumen`         AS `namakonsumen`,
  `jenispiutang`.`namajenispiutang` AS `namajenispiutang`,
  `penjualan`.`tglinvoice`          AS `tglinvoice`,
  `penjualan`.`noinvoice`           AS `noinvoice`,
  `penjualan`.`totalinvoice`        AS `totalinvoice`,
  `penjualan`.`idsales`             AS `idsales`,
  `sales`.`namasales`               AS `namasales`,
  `wilayah`.`namawilayah`           AS `namawilayah`,
  SUM(CASE WHEN DATEDIFF(piutangdetail.tglpiutang, penjualan.tglinvoice) <= 90 THEN piutangdetail.kredit ELSE 0 END) AS jumlahlancar,
  SUM(CASE WHEN DATEDIFF(piutangdetail.tglpiutang, penjualan.tglinvoice) BETWEEN 91 AND 150 THEN piutangdetail.kredit ELSE 0 END) AS jumlahlebih90hari,
  SUM(CASE WHEN DATEDIFF(piutangdetail.tglpiutang, penjualan.tglinvoice) >= 151 THEN piutangdetail.kredit ELSE 0 END) AS jumlahlebih150hari,
  CASE WHEN piutang.tgllunas IS NULL THEN DATEDIFF(piutang.tgljatuhtempo, NOW()) ELSE DATEDIFF(piutang.tgljatuhtempo, piutang.tgllunas) END AS sisaumur
FROM ((((((`piutang`
        LEFT JOIN `penjualan`
          ON ((`piutang`.`idpenjualan` = `penjualan`.`idpenjualan`)))
       JOIN `jenispiutang`
         ON ((`piutang`.`idjenispiutang` = `jenispiutang`.`idjenispiutang`)))
      JOIN `konsumen`
        ON ((`piutang`.`idkonsumen` = `konsumen`.`idkonsumen`)))
     LEFT JOIN `sales`
       ON ((`penjualan`.`idsales` = `sales`.`idsales`)))
    LEFT JOIN `wilayah`
      ON ((`konsumen`.`idwilayah` = `wilayah`.`idwilayah`)))
   JOIN `piutangdetail`
     ON ((`piutangdetail`.`idpiutang` = `piutang`.`idpiutang`)))
	GROUP BY `piutang`.`idpiutang`, `piutang`.`idpenjualan`, `piutang`.`idjenispiutang`, `piutang`.`tgljatuhtempo`, `piutang`.`idkonsumen`, `piutang`.`tgllunas`, `konsumen`.`namakonsumen`, `jenispiutang`.`namajenispiutang`, `penjualan`.`tglinvoice`, `penjualan`.`noinvoice`, `penjualan`.`totalinvoice`, `penjualan`.`idsales`, `sales`.`namasales`, `wilayah`.`namawilayah`
     $$

DELIMITER ;