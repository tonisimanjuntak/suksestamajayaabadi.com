# Active Context
Tanggal: 2026-10-15

## Fokus Saat Ini
1. **Laporan Arus Kas (Cash Flow Statement)**: Pembuatan modul Laporan Arus Kas dengan controller [LaparuskasController.php](E:/laragon/www/tonibackupfile/suksestamajayaabadi.com/app/Http/Controllers/LaparuskasController.php), model [Laparuskas.php](E:/laragon/www/tonibackupfile/suksestamajayaabadi.com/app/Models/Laparuskas.php), view filter [index.blade.php](E:/laragon/www/tonibackupfile/suksestamajayaabadi.com/resources/views/laparuskas/index.blade.php), dan template cetak PDF/Excel [cetak.blade.php](E:/laragon/www/tonibackupfile/suksestamajayaabadi.com/resources/views/laparuskas/cetak.blade.php). Sumber data berasal dari tabel `jurnal` dan `jurnaldetail` menggunakan metode langsung (Direct Method) mengelompokkan ke aktivitas Operasi, Investasi, Pendanaan, serta rekonsiliasi saldo awal dan saldo akhir kas & bank.
2. **Menu Pemeliharaan System**: Modul sentral untuk pemeliharaan sistem yang dikhususkan hanya untuk pengembang (`idpengguna = '9999999999'`). Menyediakan fungsi pengelolaan basis data berkala yang diawali dengan fitur **Archive Riwayat Aktifitas** (`riwayataktifitas` -> `riwayataktifitas_archive`) berbasis filter pilihan periode relatif (`< 1 bulan`, `< 2 bulan`, `< 3 bulan`, `< 6 bulan`, `< 12 bulan`), pengecekan pra-arsip untuk mencegah duplikasi key, konfirmasi interaktif SweetAlert, pembersihan data sumber terarsip, dan auto-update statistik tabel.
2. **Laporan Neraca Saldo (Trial Balance)**: Telah diperbaiki secara komprehensif (`LapneracasaldoController.php`, `Lapneracasaldo.php`, dan `cetak.blade.php`). Menggunakan hierarki akun Level 4 (Tingkat Transaksi), agregasi saldo awal kumulatif sebelum periode dan mutasi periode, kalkulasi saldo akhir netto (Debet vs Kredit sesuai saldo normal), penjaminan keseimbangan debet-kredit ($\sum Debet == \sum Kredit$), serta template cetak TCPDF & Excel dengan kop surat resmi dan indikator status balance.
2. **Laporan Laba Rugi**: Mengambil data laba rugi murni dari tabel `jurnal` dan `jurnaldetail` berdasarkan akun Level 4 (prefix 4 Pendapatan, 6 HPP, 5 Beban Operasional). Dilengkapi antarmuka pemilihan rentang tanggal dan fungsi export PDF (TCPDF standar murni tabel) serta file Excel.
3. **Posting Jurnal Bulanan & Akuntansi**: Perbaikan menyeluruh logika modul posting jurnal bulanan (`PostingjurnalController.php` dan `Postingjurnal.php`) yang memproses seluruh transaksi bulanan ke tabel `jurnal` dan `jurnaldetail` untuk bahan laporan akuntansi. Mengatasi session NULL dengan fallback ke tabel `settings` dan mapping akun Level 4 standar dagang, chunk insert 500 baris, format 15 digit `idjurnal`, penghapusan aman per `idposting`, serta verifikasi balance debet & kredit.
3. **Analisa & Penyesuaian Bagan Akun (COA)**: Standardisasi kode akun akuntansi 4 level untuk modul ERP (HPP, persediaan, kontra penjualan/pembelian, pajak, utang ekspedisi jangka pendek, dan beban operasional), serta perbaikan helper `get_saldo_normal`.
4. **Multi-Dashboard Pengguna**: Pengalihan otomatis halaman dashboard berdasarkan konfigurasi pengguna (`halamandashboard` = 'Dashboard Admin', 'Dashboard Sales', 'Dashboard Kosong').
5. **Dashboard Sales**: Halaman khusus sales (`homesales.blade.php`) dengan informasi Top Penjualan Sales (Bulan Ini, Bulan Kemarin, Tahun Ini) dan Top 5 Piutang Lewat Jatuh Tempo berbasis persentase, serta 5 transaksi penagihan terbaru tanpa kolom status dan link menu cepat.
6. **Dokumentasi & Log Update**: Pembaruan berkala riwayat update di `public/logupdate.txt` dan sinkronisasi berkas `memory-bank/`.

## Perubahan Terbaru (dari git log)
- `a81b099` (2026-10-08): *Update db.sql* — Pembaruan dump skema database MySQL terkait tabel dan fungsi transaksi.
- `3d23966` (2026-10-07): *update stokfifoservice untuk menghitung nilai hpp* — Implementasi kalkulasi HPP otomatis pada layer FIFO, integrasi `PpnHelper`, penyesuaian di `PenjualanController`, `PembelianpenerimaanController`, serta model `Konversistok`, `Returpembelian`, `Returpenjualan`, dan `Stockopname`.
- `898c53d` (2026-09-24): *Update Pembelian Penerimaan* — Penyesuaian alur penerimaan barang pembelian.
- `5ccd7ea` (2026-09-23): *update ppnproporsional* — Penerapan helper PPN proporsional per item barang.
- `e0e6504` (2026-09-20): *Update Master Barang* — Membuka akses pengubahan kategori barang oleh pengguna.
- `ffd3a80` (2026-09-17): *update stokfifo* — Penyempurnaan alur mutasi stok FIFO.
- `425410d` (2026-09-15): *add tabel stokfifo* — Pembuatan skema tabel layer FIFO.

## Branch Aktif
- `main`

## File yang Sedang Disentuh
- `app/Models/Laphppbarang.php`: Model query Laporan HPP Barang dengan window function `ROW_NUMBER()` pada `riwayatstok` per barang.
- `app/Http/Controllers/LaphppbarangController.php`: Controller Laporan HPP Barang dengan method `index()`, `listdata()`, dan `cetak()`.
- `resources/views/laphppbarang/index.blade.php`: View antarmuka DataTables Laporan HPP Barang.
- `resources/views/laphppbarang/cetak.blade.php`: Template cetak PDF (TCPDF) & Excel Laporan HPP Barang.
- `routes/web.php`: Pendaftaran routing `laphppbarang`.
- `app/Models/Returpenjualan.php`: Penentuan `hargasatuan`, `hargadpp`, dan `nilaihpp` saat barang masuk FIFO mengambil layer terakhir `stokfifo` (fallback `barang.hargabeli`).
- `app/Models/Stockopname.php`: Sinkronisasi penentuan `hargadpp` dan `nilaihpp` saat surplus barang masuk FIFO dari layer terakhir (fallback `barang.hargabeli`).
- `app/Models/Lapstokfifo.php`: Method `resetStokFifo()` untuk kalkulasi ulang layer FIFO kronologis dengan kalkulasi PPN proporsional, pricing dinamis untuk Retur Penjualan dan Stok Opname Surplus berbasis layer sebelumnya, serta penambahan stok awal dari tabel `barang_import2` sebelum transaksi diproses.
- `app/Http/Controllers/LapstokfifoController.php`: Method `reset()` dan `hppkartustok()`, proteksi session `idpengguna == '9999999999'`.
- `routes/web.php`: Route `POST lapstokfifo/reset` dan `POST lapstokfifo/hppkartustok`.
- `resources/views/lapstokfifo/index.blade.php`: Tombol Reset Stok FIFO & Tombol Hpp Kartu Stok di bawah datatable + konfirmasi SweetAlert & AJAX handler.
- `app/Models/Suratjalan.php`: Integrasi alur pengeluaran FIFO dari surat jalan.
- `memory-bank/` (`progress.md`, `activeContext.md`).
- `app/Models/Barang.php`: Helper method `getNilaiHppRataRataFifo($idbarang)` dan `getNilaiHppRiwayatTerakhir($idbarang)`.
- Model transaksi (`Penjualan.php`, `Pembelianpenerimaan.php`, `Returpembelian.php`, `Returpenjualan.php`, `Konversistok.php`, `Stockopname.php`, `Penyesuaianstok.php`, `Suratjalan.php`): Pencatatan field `nilaihpp` saat insert ke tabel `riwayatstok`.
- `db/db.sql`: Sinkronisasi definisi kolom `nilaihpp` di tabel `riwayatstok` dan view `v_riwayatstok`.

## Langkah Berikutnya
1. Melakukan pengujian end-to-end kalkulasi HPP FIFO pada transaksi penjualan dan retur di lingkungan pengujian/lokal.
2. Memastikan sinkronisasi skema `db/db.sql` ke database staging/server live.

## Blocker / Hal yang Menunggu
- **Pengujian Riil Transaksi FIFO**: Menunggu validasi hasil nilai HPP laporan laba rugi dari transaksi riil pasca-pembaruan `StokFifoService` dan skema `db/db.sql`.

## Catatan Sesi Sebelumnya
- Pengambilan keputusan terkait `IDOTORISASIKASIR`: Ditetapkan sebagai legacy/deprecated karena otorisasi kasir dan pengguna kini diatur granular per menu di `pengguna_menus`.
- Dokumentasi pola sistem diformalkan sebagai Monolithic MVC Fat Controller dengan hybrid data access (Query Builder + MySQL Stored Functions & Views).
- Tidak ditemukan penggunaan Service Layer formal, Action classes, Repository pattern, Event/Listener bisnis, Queues, maupun Form Request bawaan Laravel.

## Keputusan yang Baru Diambil
1. **Pengelolaan Stok Menggunakan FIFO**: Transaksi keluar-masuk barang wajib mencatat layer harga modal di tabel `stokfifo` melalui `App\Helpers\StokFifoService`.
2. **Kalkulasi PPN Proporsional**: Menggunakan `App\Helpers\PpnHelper::roundPPN` untuk menghindari selisih desimal antara total PPN invoice dan akumulasi PPN detail per baris.
3. **Dokumentasi Terisolasi**: Semua file kontekstual dan panduan pemeliharaan sistem dipusatkan di bawah direktori `memory-bank/` tanpa mengubah struktur kode sumber aplikasi.
