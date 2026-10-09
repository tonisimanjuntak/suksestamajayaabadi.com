# Active Context
Tanggal: 2026-10-09

## Fokus Saat Ini
1. **Penyusunan Dokumentasi Memory Bank**: Membangun dokumentasi arsitektur, teknis, dan bisnis sistem secara menyeluruh di dalam direktori `memory-bank/` (`projectbrief.md`, `techContext.md`, `systemPatterns.md`, dan `activeContext.md`) untuk mendukung pemeliharaan berkelanjutan.
2. **Stabilisasi Fitur FIFO & HPP**: Memastikan integrasi perhitungan HPP barang menggunakan metode FIFO (`StokFifoService`) dan skema database `stokfifo` berjalan selaras di seluruh modul transaksi (Penjualan, Pembelian/Penerimaan, Retur, Konversi Stok, dan Stock Opname).

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
- `memory-bank/` (`projectbrief.md`, `productContext.md`, `techContext.md`, `systemPatterns.md`, `progress.md`, `activeContext.md`).
- Tidak ada file kode aplikasi yang sedang mengalami uncommitted changes di working tree.

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
