DELIMITER $$

USE `pointofsales`$$

DROP VIEW IF EXISTS `v_piutang`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_piutang` AS 
SELECT
  `piutang`.`idpiutang`             AS `idpiutang`,
  `piutang`.`idpenjualan`           AS `idpenjualan`,
  `piutang`.`idjenispiutang`        AS `idjenispiutang`,
  `piutang`.`tglpiutang`            AS `tglpiutang`,
  `piutang`.`tgljatuhtempo`         AS `tgljatuhtempo`,
  `piutang`.`idkonsumen`            AS `idkonsumen`,
  `piutang`.`totaldebet`            AS `totaldebet`,
  `piutang`.`totalkredit`           AS `totalkredit`,
  `penjualan`.`tglinvoice`          AS `tglinvoice`,
  `penjualan`.`noinvoice`           AS `noinvoice`,
  `jenispiutang`.`namajenispiutang` AS `namajenispiutang`,
  `konsumen`.`namakonsumen`         AS `namakonsumen`,
  `jenispiutang`.`jatuhtempo`       AS `jatuhtempo`,
  CASE WHEN piutang.totaldebet<= piutang.totalkredit THEN 'Lunas' ELSE 'Belum Lunas' END AS statuslunas
FROM (((`piutang`
     JOIN `penjualan`
       ON ((`piutang`.`idpenjualan` = `penjualan`.`idpenjualan`)))
    JOIN `jenispiutang`
      ON ((`piutang`.`idjenispiutang` = `jenispiutang`.`idjenispiutang`)))
   JOIN `konsumen`
     ON ((`piutang`.`idkonsumen` = `konsumen`.`idkonsumen`)))$$

DELIMITER ;