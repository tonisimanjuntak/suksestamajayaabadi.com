INSERT INTO piutang(idpiutang, idjenispiutang, tglpiutang, tgljatuhtempo, idkonsumen, totaldebet, totalkredit, jenissumber, keterangan)
	SELECT idpiutang, idjenispiutang, tglpiutang, tgljatuhtempo, idkonsumen, totaldebet, 0, 'Saldo', keterangan
		FROM piutang_import

INSERT INTO piutangdetail(idpiutangdetail, idpiutang, tglpiutang, debet, kredit, inserted_date, updated_date, idpengguna, jenis, bonuspenagihansudahdibayar)		
	SELECT CONCAT(idpiutang, '001'), idpiutang, tglpiutang, totaldebet, 0, NOW(), NOW(), '9999999999', 'Piutang', 0
		FROM piutang_import