DELIMITER $$

USE `pointofsales`$$

DROP VIEW IF EXISTS `v_hutang`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_hutang` AS 
SELECT
  `hutang`.`idhutang`       AS `idhutang`,
  `hutang`.`idpembelian`    AS `idpembelian`,
  `hutang`.`tglhutang`      AS `tglhutang`,
  `hutang`.`idsupplier`     AS `idsupplier`,
  `hutang`.`totaldebet`     AS `totaldebet`,
  `hutang`.`totalkredit`    AS `totalkredit`,
  `supplier`.`namasupplier` AS `namasupplier`,
  `pembelian`.`nofaktur`    AS `nofaktur`,
  `pembelian`.`tglfaktur`   AS `tglfaktur`,
  (CASE WHEN (`hutang`.`totaldebet` < `hutang`.`totalkredit`) THEN 'Belum Lunas' ELSE 'Lunas' END) AS `statuslunas`
FROM ((`hutang`
    JOIN `pembelian`
      ON ((`hutang`.`idpembelian` = `pembelian`.`idpembelian`)))
   JOIN `supplier`
     ON ((`hutang`.`idsupplier` = `supplier`.`idsupplier`)))$$

DELIMITER ;