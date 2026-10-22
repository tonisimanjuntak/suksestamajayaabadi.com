-- 1. Matikan pemeriksaan Foreign Key sementara
SET FOREIGN_KEY_CHECKS = 0;

-- 2. Hapus seluruh isi tabel akun
TRUNCATE TABLE `akun`;

-- 3. Masukkan struktur akun baru Level 1 sampai Level 4
INSERT INTO `akun` (`kdakun`, `namaakun`, `kdparent`, `levels`, `statusaktif`, `inserted_date`, `updated_date`) VALUES
-- LEVEL 1: AKUN UTAMA
('1', 'Aset', NULL, 1, 'Aktif', NOW(), NOW()),
('2', 'Liabilitas', NULL, 1, 'Aktif', NOW(), NOW()),
('3', 'Modal', NULL, 1, 'Aktif', NOW(), NOW()),
('4', 'Pendapatan', NULL, 1, 'Aktif', NOW(), NOW()),
('5', 'Beban', NULL, 1, 'Aktif', NOW(), NOW()),
('6', 'Harga Pokok Penjualan (HPP) / Pembelian', NULL, 1, 'Aktif', NOW(), NOW()),

-- LEVEL 2: KELOMPOK AKUN
('1.1', 'Aset Lancar', '1', 2, 'Aktif', NOW(), NOW()),
('1.2', 'Aset Tidak Lancar', '1', 2, 'Aktif', NOW(), NOW()),
('2.1', 'Liabilitas Jangka Panjang', '2', 2, 'Aktif', NOW(), NOW()),
('2.2', 'Liabilitas Jangka Pendek', '2', 2, 'Aktif', NOW(), NOW()),
('3.1', 'Modal', '3', 2, 'Aktif', NOW(), NOW()),
('4.1', 'Pendapatan Usaha', '4', 2, 'Aktif', NOW(), NOW()),
('4.2', 'Pendapatan Diluar Usaha', '4', 2, 'Aktif', NOW(), NOW()),
('5.1', 'Beban Gaji', '5', 2, 'Aktif', NOW(), NOW()),
('5.2', 'Beban Jasa', '5', 2, 'Aktif', NOW(), NOW()),
('5.3', 'Beban Peralatan dan Perlengkapan Kantor', '5', 2, 'Aktif', NOW(), NOW()),
('5.4', 'Beban Operasional', '5', 2, 'Aktif', NOW(), NOW()),
('5.5', 'Beban Penyusutan', '5', 2, 'Aktif', NOW(), NOW()),
('6.1', 'Harga Pokok Penjualan', '6', 2, 'Aktif', NOW(), NOW()),

-- LEVEL 3: SUB-KELOMPOK AKUN
('1.1.01', 'Kas & Bank', '1.1', 3, 'Aktif', NOW(), NOW()),
('1.1.02', 'Persediaan Barang Dagang', '1.1', 3, 'Aktif', NOW(), NOW()),
('1.1.03', 'Piutang', '1.1', 3, 'Aktif', NOW(), NOW()),
('1.1.04', 'Pajak Dibayar Dimuka', '1.1', 3, 'Aktif', NOW(), NOW()),
('1.1.05', 'Biaya Dibayar Dimuka', '1.1', 3, 'Aktif', NOW(), NOW()),
('1.2.01', 'Kendaraan Operasional', '1.2', 3, 'Aktif', NOW(), NOW()),
('1.2.02', 'Peralatan Kantor & Gudang', '1.2', 3, 'Aktif', NOW(), NOW()),
('2.1.01', 'Utang Jangka Panjang', '2.1', 3, 'Aktif', NOW(), NOW()),
('2.2.01', 'Utang Jangka Pendek', '2.2', 3, 'Aktif', NOW(), NOW()),
('3.1.01', 'Modal', '3.1', 3, 'Aktif', NOW(), NOW()),
('4.1.01', 'Penjualan Usaha Dagang', '4.1', 3, 'Aktif', NOW(), NOW()),
('4.1.02', 'Pengurang Penjualan', '4.1', 3, 'Aktif', NOW(), NOW()),
('4.2.01', 'Pendapatan Lain-lain', '4.2', 3, 'Aktif', NOW(), NOW()),
('4.2.02', 'Pendapatan Keuangan', '4.2', 3, 'Aktif', NOW(), NOW()),
('5.1.01', 'Gaji Pegawai', '5.1', 3, 'Aktif', NOW(), NOW()),
('5.1.02', 'Gaji Non Pegawai', '5.1', 3, 'Aktif', NOW(), NOW()),
('5.2.01', 'Jasa Pemeliharaan Barang Kantor', '5.2', 3, 'Aktif', NOW(), NOW()),
('5.2.02', 'Jasa Pemeliharaan Software', '5.2', 3, 'Aktif', NOW(), NOW()),
('5.3.01', 'Beban Barang Habis Pakai', '5.3', 3, 'Aktif', NOW(), NOW()),
('5.3.02', 'Beban Peralatan Kantor', '5.3', 3, 'Aktif', NOW(), NOW()),
('5.3.03', 'Beban Perlengkapan Kantor', '5.3', 3, 'Aktif', NOW(), NOW()),
('5.4.01', 'Beban Penjualan', '5.4', 3, 'Aktif', NOW(), NOW()),
('5.4.02', 'Beban Utilitas & Administrasi', '5.4', 3, 'Aktif', NOW(), NOW()),
('5.5.01', 'Beban Penyusutan', '5.5', 3, 'Aktif', NOW(), NOW()),
('6.1.01', 'Harga Pokok Penjualan', '6.1', 3, 'Aktif', NOW(), NOW()),

-- LEVEL 4: AKUN BUKU BESAR DETAIL
-- 1.1.01 Kas & Bank
('1.1.01.01', 'Kas Tunai', '1.1.01', 4, 'Aktif', NOW(), NOW()),
('1.1.01.02', 'Rekening Maybank', '1.1.01', 4, 'Aktif', NOW(), NOW()),
('1.1.01.03', 'Rekening BCA', '1.1.01', 4, 'Aktif', NOW(), NOW()),
('1.1.01.04', 'Rekening OCBC', '1.1.01', 4, 'Aktif', NOW(), NOW()),
('1.1.01.05', 'Kas Kecil (Petty Cash)', '1.1.01', 4, 'Aktif', NOW(), NOW()),

-- 1.1.02 Persediaan
('1.1.02.01', 'Persediaan Barang Dagang', '1.1.02', 4, 'Aktif', NOW(), NOW()),

-- 1.1.03 Piutang
('1.1.03.01', 'Piutang Usaha', '1.1.03', 4, 'Aktif', NOW(), NOW()),
('1.1.03.02', 'Piutang Karyawan / Sales', '1.1.03', 4, 'Aktif', NOW(), NOW()),
('1.1.03.03', 'Cadangan Kerugian Piutang', '1.1.03', 4, 'Aktif', NOW(), NOW()),

-- 1.1.04 Pajak Dibayar Dimuka
('1.1.04.01', 'PPN Masukan (Pembelian)', '1.1.04', 4, 'Aktif', NOW(), NOW()),
('1.1.04.02', 'PPh Pasal 22 / 23 Dibayar Dimuka', '1.1.04', 4, 'Aktif', NOW(), NOW()),

-- 1.1.05 Biaya Dibayar Dimuka
('1.1.05.01', 'Sewa Gudang / Kantor Dibayar Dimuka', '1.1.05', 4, 'Aktif', NOW(), NOW()),
('1.1.05.02', 'Asuransi Dibayar Dimuka', '1.1.05', 4, 'Aktif', NOW(), NOW()),

-- 1.2.01 Kendaraan Operasional
('1.2.01.01', 'Kendaraan Truk / Mobil Box', '1.2.01', 4, 'Aktif', NOW(), NOW()),
('1.2.01.02', 'Akumulasi Penyusutan Kendaraan', '1.2.01', 4, 'Aktif', NOW(), NOW()),

-- 1.2.02 Peralatan Kantor & Gudang
('1.2.02.01', 'Komputer & Perlengkapan IT', '1.2.02', 4, 'Aktif', NOW(), NOW()),
('1.2.02.02', 'Peralatan Gudang', '1.2.02', 4, 'Aktif', NOW(), NOW()),
('1.2.02.03', 'Akumulasi Penyusutan Peralatan', '1.2.02', 4, 'Aktif', NOW(), NOW()),

-- 2.1.01 Utang Jangka Panjang
('2.1.01.01', 'Utang Bank Jangka Panjang', '2.1.01', 4, 'Aktif', NOW(), NOW()),
('2.1.01.02', 'Utang Leasing Kendaraan', '2.1.01', 4, 'Aktif', NOW(), NOW()),

-- 2.2.01 Utang Jangka Pendek
('2.2.01.01', 'Utang Usaha (Supplier)', '2.2.01', 4, 'Aktif', NOW(), NOW()),
('2.2.01.02', 'Utang Pajak (PPN Keluaran)', '2.2.01', 4, 'Aktif', NOW(), NOW()),
('2.2.01.03', 'Utang Gaji', '2.2.01', 4, 'Aktif', NOW(), NOW()),
('2.2.01.04', 'Utang Usaha (Ekspedisi)', '2.2.01', 4, 'Aktif', NOW(), NOW()),
('2.2.01.05', 'Utang Pajak (PPh Pasal 23)', '2.2.01', 4, 'Aktif', NOW(), NOW()),
('2.2.01.06', 'Utang Bonus Sales', '2.2.01', 4, 'Aktif', NOW(), NOW()),

-- 3.1.01 Modal
('3.1.01.01', 'Modal Pemilik', '3.1.01', 4, 'Aktif', NOW(), NOW()),
('3.1.01.02', 'Prive Pemilik', '3.1.01', 4, 'Aktif', NOW(), NOW()),
('3.1.01.03', 'Laba Ditahan', '3.1.01', 4, 'Aktif', NOW(), NOW()),
('3.1.01.04', 'Laba Periode Berjalan', '3.1.01', 4, 'Aktif', NOW(), NOW()),

-- 4.1.01 & 4.1.02 Penjualan & Pengurang
('4.1.01.01', 'Penjualan Barang Dagang', '4.1.01', 4, 'Aktif', NOW(), NOW()),
('4.1.02.01', 'Retur Penjualan', '4.1.02', 4, 'Aktif', NOW(), NOW()),
('4.1.02.02', 'Potongan / Diskon Penjualan', '4.1.02', 4, 'Aktif', NOW(), NOW()),

-- 4.2.01 & 4.2.02 Pendapatan Lain-lain & Keuangan
('4.2.01.01', 'Pendapatan Sewa Truk', '4.2.01', 4, 'Aktif', NOW(), NOW()),
('4.2.01.02', 'Pendapatan Selisih Stok (Surplus Opname)', '4.2.01', 4, 'Aktif', NOW(), NOW()),
('4.2.02.01', 'Pendapatan Bunga Bank', '4.2.02', 4, 'Aktif', NOW(), NOW()),

-- 5.1 Beban Gaji
('5.1.01.01', 'Gaji Pokok Pegawai', '5.1.01', 4, 'Aktif', NOW(), NOW()),
('5.1.01.02', 'Gaji Tunjangan Pegawai', '5.1.01', 4, 'Aktif', NOW(), NOW()),
('5.1.02.01', 'Upah Harian Non Pegawai', '5.1.02', 4, 'Aktif', NOW(), NOW()),
('5.1.02.02', 'Upah Bulanan Non Pegawai', '5.1.02', 4, 'Aktif', NOW(), NOW()),

-- 5.2 Beban Jasa & Pemeliharaan
('5.2.01.01', 'Jasa Pemeliharaan AC / Pendingin Ruangan', '5.2.01', 4, 'Aktif', NOW(), NOW()),
('5.2.01.03', 'Jasa Pemeliharaan Komputer/ Laptop', '5.2.01', 4, 'Aktif', NOW(), NOW()),
('5.2.02.01', 'Jasa Pemeliharaan Web Aplikasi POS', '5.2.02', 4, 'Aktif', NOW(), NOW()),

-- 5.3 Beban Perlengkapan & Kantor
('5.3.01.01', 'Beban Kertas F4', '5.3.01', 4, 'Aktif', NOW(), NOW()),
('5.3.01.02', 'Beban Kertas Blanko Kwitansi', '5.3.01', 4, 'Aktif', NOW(), NOW()),
('5.3.02.01', 'Beban Komputer/ PC', '5.3.02', 4, 'Aktif', NOW(), NOW()),
('5.3.02.02', 'Beban Laptop', '5.3.02', 4, 'Aktif', NOW(), NOW()),
('5.3.03.01', 'Beban Lemari Berkas', '5.3.03', 4, 'Aktif', NOW(), NOW()),

-- 5.4 Beban Operasional & Penjualan
('5.4.01.01', 'Beban Transportasi', '5.4.01', 4, 'Aktif', NOW(), NOW()),
('5.4.01.02', 'Beban Iklan', '5.4.01', 4, 'Aktif', NOW(), NOW()),
('5.4.01.03', 'Beban Bonus Sales', '5.4.01', 4, 'Aktif', NOW(), NOW()),
('5.4.01.04', 'Beban Selisih Stok (Defisit Opname / Rusak)', '5.4.01', 4, 'Aktif', NOW(), NOW()),
('5.4.02.01', 'Beban Listrik, Air & Telepon/Internet', '5.4.02', 4, 'Aktif', NOW(), NOW()),
('5.4.02.02', 'Beban Administrasi Bank', '5.4.02', 4, 'Aktif', NOW(), NOW()),

-- 5.5 Beban Penyusutan
('5.5.01.01', 'Beban Penyusutan Kendaraan', '5.5.01', 4, 'Aktif', NOW(), NOW()),
('5.5.01.02', 'Beban Penyusutan Peralatan', '5.5.01', 4, 'Aktif', NOW(), NOW()),

-- 6.1 HPP & Pembelian
('6.1.01.01', 'Pembelian Barang Dagang / HPP', '6.1.01', 4, 'Aktif', NOW(), NOW()),
('6.1.01.02', 'Retur Pembelian', '6.1.01', 4, 'Aktif', NOW(), NOW()),
('6.1.01.03', 'Potongan / Diskon Pembelian', '6.1.01', 4, 'Aktif', NOW(), NOW()),
('6.1.01.04', 'Ongkos Angkut Pembelian (Freight-In)', '6.1.01', 4, 'Aktif', NOW(), NOW());

-- 4. Sinkronkan mapping default setting aplikasi
UPDATE `settings` SET `values` = '2.2.01' WHERE `prefix` = 'akun_utang_ekspedisi';
UPDATE `settings` SET `values` = '1.1.04.01' WHERE `prefix` = 'akun_ppn_masukan';
UPDATE `settings` SET `values` = '2.2.01.05' WHERE `prefix` = 'akun_utang_pph23';
UPDATE `settings` SET `values` = '4.1.02.01' WHERE `prefix` = 'akun_retur_penjualan';
UPDATE `settings` SET `values` = '4.1.02.02' WHERE `prefix` = 'akun_diskon_penjualan';
UPDATE `settings` SET `values` = '6.1.01.02' WHERE `prefix` = 'akun_retur_pembelian';
UPDATE `settings` SET `values` = '6.1.01.03' WHERE `prefix` = 'akun_diskon_pembelian';

-- 5. Aktifkan kembali pemeriksaan Foreign Key
SET FOREIGN_KEY_CHECKS = 1;