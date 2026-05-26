DELETE FROM menus;

INSERT INTO menus (idmenus, menus, parent, urlmenus, iconmenus, urut, levels, statusaktif, event_exist) VALUES
-- Level 0: Root
('M001', 'Dashboard', NULL, 'home', 'fas fa-tachometer-alt', 10, 0, 'Aktif', ''),
('M002', 'Referensi', NULL, NULL, 'fas fa-database', 20, 0, 'Aktif', ''),
('M011', 'Pengguna', 'M002', 'pengguna', 'far fa-circle', 30, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M012', 'Wilayah', 'M002', 'wilayah', 'far fa-circle', 40, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M013', 'Konsumen', 'M002', 'konsumen', 'far fa-circle', 50, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M014', 'Supplier', 'M002', 'supplier', 'far fa-circle', 60, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M015', 'Bank', 'M002', 'bank', 'far fa-circle', 70, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M016', 'Akun', 'M002', NULL, 'fas fa-stream', 80, 1, 'Aktif', ''),
('M017', 'Akun Lv. 1', 'M016', 'akun1', 'far fa-circle', 90, 2, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M018', 'Akun Lv. 2', 'M016', 'akun2', 'far fa-circle', 100, 2, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M019', 'Akun Lv. 3', 'M016', 'akun3', 'far fa-circle', 110, 2, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M020', 'Akun Lv. 4', 'M016', 'akun4', 'far fa-circle', 120, 2, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M003', 'Barang', NULL, NULL, 'fas fa-shapes', 130, 0, 'Aktif', ''),
('M021', 'Kategori Barang', 'M003', 'kategoribarang', 'far fa-circle', 140, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M062', 'Satuan', 'M003', 'satuan', 'far fa-circle', 145, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M022', 'Barang', 'M003', 'barang', 'far fa-circle', 150, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('MB01', 'Kartu Stok Barang', 'M003', 'kartustokbarang', 'far fa-circle', 155, 1, 'Aktif', 'Lihat'),
('MB03', 'Konversi Barang', 'M003', 'konversistok', 'far fa-circle', 156, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M023', 'Stock Opname', 'M003', 'stockopname', 'far fa-circle', 160, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('MB02', 'Penyesuaian Stok', 'M003', 'penyesuaianstok', 'far fa-circle', 161, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M024', 'Laporan Persediaan', 'M003', 'lappersediaan', 'far fa-circle', 170, 1, 'Aktif', 'Lihat'),

('M004', 'Sales', NULL, NULL, 'fas fa-universal-access', 180, 0, 'Aktif', ''),
('M025', 'Data Sales', 'M004', 'sales', 'far fa-circle', 190, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M026', 'Penagihan Piutang', 'M004', 'penagihan', 'far fa-circle', 200, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M027', 'Bonus Sales', 'M004', 'bonussales', 'far fa-circle', 210, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M028', 'Laporan Penagihan', 'M004', 'lappenagihansales', 'fas fa-print', 220, 1, 'Aktif', 'Lihat'),
('M029', 'Laporan Bonus Sales', 'M004', 'lapbonussales', 'fas fa-print', 230, 1, 'Aktif', 'Lihat'),
('M005', 'Ekspedisi', NULL, NULL, 'fas fa-truck', 240, 0, 'Aktif', ''),
('M030', 'Data Ekspedisi', 'M005', 'ekspedisi', 'far fa-circle', 250, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M031', 'Surat Jalan', 'M005', 'suratjalan', 'far fa-circle', 260, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M032', 'Buku Utang Ekspedisi', 'M005', 'hutangekspedisi', 'far fa-circle', 270, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M033', 'Laporan Utang Ekspedisi', 'M005', 'laputangekspedisi', 'fas fa-print', 280, 1, 'Aktif', 'Lihat'),
('M006', 'Pembelian', NULL, NULL, 'fas fa-table', 290, 0, 'Aktif', ''),
('M034', 'Purchase Order (PO)', 'M006', 'pembelian', 'far fa-circle', 300, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M035', 'Penerimaan PO', 'M006', 'pembelianpenerimaan', 'far fa-circle', 310, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M036', 'Buku Utang', 'M006', 'hutang', 'far fa-circle', 320, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M037', 'Retur Pembelian', 'M006', 'returpembelian', 'far fa-circle', 330, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M038', 'Laporan', 'M006', NULL, 'fas fa-print', 340, 1, 'Aktif', ''),
('M039', 'Lap. Pembelian', 'M038', 'lappembelian', 'far fa-circle', 350, 2, 'Aktif', 'Lihat'),
('M040', 'Lap. Rincian Utang', 'M038', 'lapbukuhutang', 'far fa-circle', 360, 2, 'Aktif', 'Lihat'),
('M041', 'Lap. Rekap Utang', 'M038', 'laprekaphutang', 'far fa-circle', 370, 2, 'Aktif', 'Lihat'),
('M042', 'Lap. Retur Pembelian', 'M038', 'lapreturpembelian', 'far fa-circle', 380, 2, 'Aktif', 'Lihat'),
('M007', 'Penjualan', NULL, NULL, 'fas fa-stamp', 390, 0, 'Aktif', ''),
('M043', 'Penjualan', 'M007', 'penjualan', 'far fa-circle', 400, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),

('M045', 'Retur Penjualan', 'M007', 'returpenjualan', 'far fa-circle', 420, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M047', 'Lap. Penjualan', 'M007', 'lappenjualan', 'fas fa-print', 440, 2, 'Aktif', 'Lihat'),
('M050', 'Lap. Retur Penjualan', 'M007', 'lapreturpenjualan', 'fas fa-print', 470, 2, 'Aktif', 'Lihat'),

('PI01', 'Piutang', 'M007', NULL, 'fa fa-credit-card', 475, 1, 'Aktif', ''),
('PI02', 'Buku Piutang', 'PI01', 'piutang', 'far fa-circle', 476, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('PI03', 'Pembayaran Piutang', 'PI01', 'pembayaranpiutang', 'far fa-circle', 477, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('PI04', 'Lap. Rincian Piutang', 'PI01', 'lapbukupiutang', 'fas fa-print', 478, 2, 'Aktif', 'Lihat'),
('PI05', 'Lap. Rekap Piutang', 'PI01', 'laprekappiutang', 'fas fa-print', 479, 2, 'Aktif', 'Lihat'),

('M008', 'Transaksi Umum', NULL, NULL, 'fas fa-tv', 480, 0, 'Aktif', ''),
('M051', 'Pengeluaran', 'M008', 'pengeluaran', 'far fa-circle', 490, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M052', 'Penerimaan', 'M008', 'penerimaan', 'far fa-circle', 500, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M053', 'Lap. Pengeluaran', 'M008', 'lappengeluaran', 'fas fa-print', 510, 1, 'Aktif', 'Lihat'),
('M054', 'Lap. Penerimaan', 'M008', 'lappenerimaan', 'fas fa-print', 520, 1, 'Aktif', 'Lihat'),
('M009', 'Akuntansi', NULL, NULL, 'fas fa-newspaper', 530, 0, 'Aktif', ''),
('M055', 'Saldo Awal Akun', 'M009', 'saldoawal', 'far fa-circle', 540, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M056', 'Jurnal Penyesuaian', 'M009', 'jurnal', 'far fa-circle', 550, 1, 'Aktif', 'Lihat, Tambah, Edit, Hapus'),
('M057', 'Posting Jurnal', 'M009', 'postingjurnal', 'far fa-circle', 560, 1, 'Aktif', 'Lihat'),
('M058', 'Buku Besar', 'M009', 'lapbukubesar', 'far fa-circle', 570, 1, 'Aktif', 'Lihat'),
('M059', 'Laporan Jurnal', 'M009', 'lapjurnal', 'far fa-circle', 580, 1, 'Aktif', 'Lihat'),
('M060', 'Laporan Neraca Saldo', 'M009', 'lapneracasaldo', 'far fa-circle', 590, 1, 'Aktif', 'Lihat'),
('M061', 'Laporan Laba Rugi', 'M009', 'laplabarugi', 'far fa-circle', 600, 1, 'Aktif', 'Lihat'),

('RI01', 'Riwayat Update', NULL, 'riwayatupdate', 'fa fa-calendar', 609, 0, 'Aktif', ''),

('M010', 'Logout', NULL, 'logout', 'fas fa-sign-out-alt text-warning', 610, 0, 'Aktif', '');


/**
	UPDATE menus SET urlmenus = 'konversistok' WHERE idmenus = 'MB03'
	
	ALTER TABLE `pengguna_menus` DROP FOREIGN KEY `pengguna_menus_ibfk_1`;
**/
