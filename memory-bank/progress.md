# Progress
Terakhir diperbarui: 2026-10-09

## Status Keseluruhan

Sistem ERP PT. Sukses Tama Jaya Abadi berada pada status **Production Maintenance & Active Evolution**. Seluruh fungsi utama (pembelian, penjualan, surat jalan, hutang, piutang, kas/bank, persediaan, dan akuntansi) telah selesai dibangun dan digunakan secara aktif dalam operasional distribusi. Pekerjaan terkini berfokus pada stabilisasi metode valuasi stok FIFO, perhitungan HPP otomatis di laporan laba rugi, serta penyusunan dokumentasi arsitektur sistem (Memory Bank).

---

## Fitur Selesai (Done)

Bukti implementasi terverifikasi dari routes di `routes/web.php` dan 60 controller di `app/Http/Controllers/`:

1. **Master Data & Konfigurasi**:
   - Master Pengguna & Otorisasi Menu Dinamis (`PenggunaController`, `CheckMenuAccess`).
   - Master Konsumen, Supplier, Sales, Ekspedisi, Jenis Ekspedisi, Wilayah, Bank.
   - Master Barang, Jenis Barang, Kategori Barang, Satuan Barang (`BarangController`, dll.).
   - Chart of Accounts 4 Level (`Akun1Controller` s.d. `Akun4Controller`).
   - Pengaturan Usaha & Parameter PPN (`PengaturanController`).
2. **Transaksi Pembelian**:
   - Purchase Order / Pembelian (`PembelianController`).
   - Penerimaan Barang Pembelian & Alokasi Ekspedisi (`PembelianpenerimaanController`).
   - Retur Pembelian (`ReturpembelianController`).
3. **Transaksi Penjualan**:
   - Input Penjualan, Kwitansi Kasir, & Cetak Invoice (`PenjualanController`).
   - PPN Proporsional per Item Barang (`PpnHelper::roundPPN`).
   - Surat Jalan Pengiriman Barang (`SuratjalanController`).
   - Retur Penjualan (`ReturpenjualanController`).
4. **Hutang & Piutang**:
   - Buku Hutang Supplier (`HutangController`).
   - Hutang Ekspedisi (dengan kalkulasi otomatis PPN 1,1% & PPh 23 2% di `HutangekspedisiController`).
   - Buku Piutang Konsumen (`PiutangController`).
   - Pembayaran & Pelunasan Piutang (`PembayaranpiutangController`).
   - Laporan Penagihan Sales (`PenagihanController`).
5. **Kas, Bank, & Akuntansi**:
   - Penerimaan & Pengeluaran Kas/Bank (`PenerimaanController`, `PengeluaranController`).
   - Jurnal Umum Manual (`JurnalController`).
   - Posting Jurnal Periode Bulanan (`PostingjurnalController`, `Postingjurnal`): Pembaruan arsitektur posting transaksi (Penjualan, Pembelian, Retur, Piutang, Hutang, Penerimaan, Pengeluaran) ke tabel `jurnal` dan `jurnaldetail` dengan mapping akun Level 4 standar dagang, chunk batch 500 baris, format 15 digit `idjurnal`, isolasi `idposting`, serta verifikasi balance Debet == Kredit.
   - Laporan Laba Rugi (`LaplabarugiController`, `Laplabarugi`): Mengambil data murni dari tabel `jurnal` dan `jurnaldetail` hasil posting akuntansi. Menghitung saldo normal Pendapatan (Kredit - Debet), HPP (Debet - Kredit), Beban Operasional (Debet - Kredit), Laba Kotor, dan Laba Bersih sebelum pajak. Dilengkapi cetak PDF (TCPDF layout tabel murni) & Excel.
   - Laporan Neraca Saldo (`LapneracasaldoController`, `Lapneracasaldo`): Mengambil data murni dari tabel `jurnal` dan `jurnaldetail` pada akun transaksi Level 4. Menghitung saldo awal kumulatif sebelum periode dan mutasi periode berjalan, penempatan saldo netto pada kolom Debet atau Kredit berdasarkan saldo normal akun (Aset/Beban/HPP di Debet, Kewajiban/Modal/Pendapatan di Kredit), penjaminan total Debet == total Kredit (Balance), indikator status balance, serta template cetak PDF (TCPDF) & Excel terstruktur dengan sub-header Level 1 dan Level 2.
   - Saldo Awal Akun & Saldo Piutang (`SaldoawalController`, `SaldopiutangController`).
6. **Persediaan & Stok**:
   - Stock Opname Fisik (`StockopnameController`).
   - Penyesuaian Stok Cepat (`PenyesuaianstokController`).
   - Konversi Satuan Stok Besar ke Kecil (`KonversistokController`).
   - Kartu Riwayat Stok Barang (`KartustokbarangController`).
   - Penambahan field `nilaihpp` pada tabel `riwayatstok` & view `v_riwayatstok` (rata-rata `stokfifo` untuk tambah transaksi, HPP baris terakhir `riwayatstok` untuk hapus/rollback transaksi).
   - Laporan Layer Persediaan Stok FIFO (`LapstokfifoController`).
   - Fitur Reset & Replay Stok FIFO kronologis via `Lapstokfifo::resetStokFifo()` khusus admin `idpengguna = 9999999999` dengan perhitungan PPN proporsional per baris menggunakan `PpnHelper::roundPPN`, pricing dinamis layer sebelumnya, dan integrasi stok awal dari `barang_import2`.
7. **Pemeliharaan System (System Maintenance)**:
   - Modul khusus developer (`idpengguna = '9999999999'`) pada [PemeliharaansystemController.php](/e:/laragon/www/tonibackupfile/suksestamajayaabadi.com/app/Http/Controllers/PemeliharaansystemController.php) dan view [index.blade.php](/e:/laragon/www/tonibackupfile/suksestamajayaabadi.com/resources/views/pemeliharaansystem/index.blade.php).
   - Fitur Arsip Riwayat Aktifitas: memindahkan data dari tabel `riwayataktifitas` ke `riwayataktifitas_archive` berdasarkan pilihan periode relatif (`< 1 bulan`, `< 2 bulan`, `< 3 bulan`, `< 6 bulan`, `< 12 bulan`).
   - Pengecekan otomatis pra-arsip untuk mencegah duplikasi primary key `id`, penyalinan record yang belum diarsipkan, pembersihan data sumber yang telah terarsip dari tabel aktif, konfirmasi SweetAlert sebelum eksekusi, serta pencatatan audit log pemeliharaan.
8. **Bonus Sales**:
   - Perhitungan Bonus Penjualan & Bonus Penagihan (`BonussalesController`).
8. **Pelaporan & Cetak Dokumen (TCPDF)**:
   - 19+ modul laporan operasional dan keuangan (Buku Besar, Neraca Saldo, Laba Rugi, Rekap Hutang/Piutang, Persediaan, Pembelian, Penjualan).
   - Laporan HPP Barang (`LaphppbarangController`, `Laphppbarang`, menu `MB06`): Kolom Kode Barang, Nama Barang, Kuantitas (stok akhir), Nilai Total Biaya (stok akhir * nilaihpp), Biaya Rata-rata (nilaihpp) dari baris riwayatstok terakhir <= tanggal laporan, filter kategori, ekspor Excel dan cetak PDF via TCPDF.
9. **Audit Trail & Dashboard**:
   - Pencatatan seluruh operasi data pengguna ke tabel `riwayataktifitas` (`App::riwayatAktifitas`).
   - Dashboard Operasional Modern (`HomeController`, `Home`, `resources/views/home.blade.php`): KPI Cards (Penjualan, Pembelian, Piutang, Hutang), tren grafik tahunan & donat cara bayar (Chart.js 2.9.4), widget monitoring (stok mendekati batas minimum, piutang jatuh tempo, top konsumen omset tertinggi), dan live feed riwayat aktivitas asinkron.

---

## Sedang Dikerjakan (In Progress)

1. **Valuasi Persediaan FIFO & Kalkulasi HPP**:
   - Implementasi perhitungan HPP otomatis pada layer tabel `stokfifo` via `App\Helpers\StokFifoService` (commit `3d23966` dan `a81b099`).
   - Integrasi dan sinkronisasi layer FIFO di alur transaksi retur pembelian, retur penjualan, dan konversi barang.
2. **Penyusunan Memory Bank Dokumentasi**:
   - Dokumentasi inti arsitektur, teknis, dan progres di bawah folder `memory-bank/` untuk panduan pemeliharaan jangka panjang.

---

## Direncanakan (Planned)

1. **Automated Testing Suite**:
   - Pembuatan unit test dan feature test untuk formula krusial (metode FIFO di `StokFifoService`, pembulatan PPN di `PpnHelper`, dan perhitungan bonus sales).
2. **Sinkronisasi Skema Produksi**:
   - Deployment dan validasi berkas dump database `db/db.sql` terbaru ke server database live.
3. **Pembersihan File Legacy**:
   - Refactoring atau penghapusan file controller usang seperti `app/Http/Controllers/LappersediaanController_Old.php`.

---

## Known Issues / Bug

1. **Race Condition pada Pembaruan Stok**:
   - Mutasi stok barang membaca saldo terakhir (`Barang::getRiwayatStokAkhir()`) lalu menambahkan/mengurangkan dan menyimpan kembali. Jika terjadi transaksi serentak pada barang yang sama, saldo stok berpotensi mengalami desinkronisasi jika tidak dilindungi locking row (`lockForUpdate`).
2. **Konstanta Kasir Usang (Deprecated Constant)**:
   - `IDOTORISASIKASIR` di `app/Helpers/ConstantsHelper.php` sudah tidak relevan karena hak akses kasir kini dikelola secara granular per menu di `pengguna_menus`.
3. **Kueri DataTables pada Data Skala Besar**:
   - Seluruh pencarian tabel menggunakan wildcard `LIKE '%...%'` tanpa indeks full-text. Berpotensi mengalami penurunan performa saat volume transaksi mencapai ratusan ribu baris.
4. **Pencegahan Mutasi Periode Jurnal Belum Menyeluruh**:
   - Validasi `App::isPosting($tanggal)` telah diterapkan pada controller transaksi utama (Penjualan, Pembelian), namun perlu dipastikan merata di seluruh mutasi kas dan pengeluaran manual.

---

## Technical Debt

1. **Zero Automated Test Coverage**:
   - Tidak ada pengujian otomatis untuk domain bisnis (hanya terdapat berkas default `tests/Feature/ExampleTest.php` dan `tests/Unit/ExampleTest.php`).
2. **Fat Controller & Procedural Models**:
   - Logika bisnis, formatting DataTables, dan sanitasi tersebar di dalam controller dan method model tanpa Service Layer atau Form Request terpisah.
3. **Tidak Menggunakan Database Migration**:
   - Skema database dikelola melalui file dump statis `db/db.sql` yang rentan desinkronisasi antar-lingkungan developer dan production.
4. **Keberadaan Controller Duplikat/Cadangan**:
   - Terdapat berkas `LappersediaanController_Old.php` di dalam folder production `app/Http/Controllers/`.

---

## Yang Sudah Diuji

Berdasarkan riwayat pemeliharaan pada `public/logupdate.txt` dan git log (pengujian manual / user acceptance test):
- Validasi penguncian invoice penjualan jika sudah dibuatkan surat jalan (`PenjualanController`).
- Kalkulasi PPN proporsional per item faktur pajak (`PpnHelper::roundPPN`).
- Alur penerimaan PO dengan diskon bertingkat (3 tingkat persen/nominal).
- Konversi satuan barang dengan nama satuan asal sama atau berbeda.
- Penyesuaian panjang NPWP 20 digit pada Konsumen dan Supplier.
- Pencetakan invoice dengan wordwrap dan penyesuaian ukuran font dinamis.

---

## Yang Belum Diuji

- Integritas layer `stokfifo` pada skenario pembatalan transaksi penjualan multi-layer yang stoknya sudah digunakan transaksi berikutnya.
- Valuasi layer `stokfifo` dan `stokfifodetail` via reset kronologis serta sinkronisasi harga `Retur Penjualan` dan `Stok Opname` ke layer sebelumnya / master barang (Selesai diuji 2026-10-09).
- Nilai HPP pada laporan laba rugi dari transaksi baru pasca-commit `3d23966`.
- Ketahanan transaksi konkuren multi-user di kasir/admin penjualan.
- Regresi endpoint jika PHP versi dinaikkan ke PHP 8.3+.

---

## Riwayat Milestone

| Periode | Milestone |
|---------|-----------|
| **2025-01** | Peluncuran sistem inti: Pembelian, Penjualan, Buku Utang/Piutang, Surat Jalan, dan Cetak Invoice. |
| **2025-04 s.d. 2025-05** | Penambahan Buku Utang Ekspedisi, Penerimaan PO, Modul Bonus Sales, dan Akuntansi Saldo Awal. |
| **2026-05** | Penambahan Satuan Barang, Penyesuaian Stok Cepat, Konversi Stok Satuan, dan Cetakan Buku Piutang. |
| **2026-07** | Modul Nota & Laporan Retur Penjualan, validasi penguncian Surat Jalan, dan log notifikasi update. |
| **2026-09** | Penerapan PPN Proporsional per baris dan pembuatan tabel layer persediaan `stokfifo`. |
| **2026-10** | Implementasi kalkulasi HPP otomatis pada `StokFifoService`, dokumentasi Memory Bank, Multi-Dashboard Pengguna, dan restrukturisasi COA akuntansi level 1-4. |
