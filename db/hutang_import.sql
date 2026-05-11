INSERT INTO hutang(idhutang, tglhutang, idsupplier, totaldebet, totalkredit, jenissumber, keterangan)
	SELECT idhutang, tglhutang, idsupplier, 0, totalkredit, 'Saldo', keterangan
		FROM hutang_import;

INSERT INTO hutangdetail(idhutangdetail, idhutang, tglhutang, debet, kredit, inserted_date, updated_date, idpengguna, jenis)
	SELECT CONCAT(idhutang, '001'), idhutang, tglhutang, 0, totalkredit, NOW(), NOW(), '9999999999', 'Hutang'
		FROM hutang_import;
		