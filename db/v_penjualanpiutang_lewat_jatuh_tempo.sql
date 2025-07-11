DELIMITER $$

USE `pointofsales`$$

DROP VIEW IF EXISTS `v_penjualanpiutang_lewat_jatuh_tempo`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualanpiutang_lewat_jatuh_tempo` AS 
SELECT
  `v_penjualan`.`idpenjualan`      AS `idpenjualan`,
  `v_penjualan`.`idkonsumen`       AS `idkonsumen`,
  `v_penjualan`.`tglinvoice`       AS `tglinvoice`,
  `v_penjualan`.`noinvoice`        AS `noinvoice`,
  `v_penjualan`.`keterangan`       AS `keterangan`,
  `v_penjualan`.`totalpenjualan`   AS `totalpenjualan`,
  `v_penjualan`.`totaldpp`         AS `totaldpp`,
  `v_penjualan`.`totaldiskon`      AS `totaldiskon`,
  `v_penjualan`.`totalbersih`      AS `totalbersih`,
  `v_penjualan`.`ppnpersen`        AS `ppnpersen`,
  `v_penjualan`.`totalppn`         AS `totalppn`,
  `v_penjualan`.`biayapengiriman`  AS `biayapengiriman`,
  `v_penjualan`.`totalinvoice`     AS `totalinvoice`,
  `v_penjualan`.`idpengguna`       AS `idpengguna`,
  `v_penjualan`.`inserted_date`    AS `inserted_date`,
  `v_penjualan`.`updated_date`     AS `updated_date`,
  `v_penjualan`.`carabayar`        AS `carabayar`,
  `v_penjualan`.`idbank`           AS `idbank`,
  `v_penjualan`.`idjenispiutang`   AS `idjenispiutang`,
  `v_penjualan`.`idsales`          AS `idsales`,
  `v_penjualan`.`nokwitansi`       AS `nokwitansi`,
  `v_penjualan`.`nobilyetgiro`     AS `nobilyetgiro`,
  `v_penjualan`.`namakonsumen`     AS `namakonsumen`,
  `v_penjualan`.`idwilayah`        AS `idwilayah`,
  `v_penjualan`.`namabank`         AS `namabank`,
  `v_penjualan`.`cabang`           AS `cabang`,
  `v_penjualan`.`norekening`       AS `norekening`,
  `v_penjualan`.`atasnama`         AS `atasnama`,
  `v_penjualan`.`namasales`        AS `namasales`,
  `v_penjualan`.`namajenispiutang` AS `namajenispiutang`,
  `v_penjualan`.`jatuhtempo`       AS `jatuhtempo`,
  `v_penjualan`.`namapengguna`     AS `namapengguna`,
  `v_penjualan`.`namawilayah`      AS `namawilayah`,
  (`v_penjualan`.`tglinvoice` + INTERVAL `v_penjualan`.`jatuhtempo` DAY) AS `tgljatuhtempo`
FROM `v_penjualan`
WHERE ((`v_penjualan`.`carabayar` = 'Piutang')
       AND ((`v_penjualan`.`tglinvoice` + INTERVAL `v_penjualan`.`jatuhtempo` DAY) < CAST(NOW()AS DATE)))$$

DELIMITER ;