# Project Brief: Sukses Tama Jaya Abadi — Sistem ERP Distribusi

## Ringkasan

Sistem ERP (Enterprise Resource Planning) berbasis web untuk perusahaan distribusi barang. Aplikasi mencakup seluruh siklus bisnis mulai dari pembelian, penerimaan barang, penjualan, pengiriman (surat jalan), penagihan piutang, pembayaran hutang, hingga pelaporan keuangan lengkap (jurnal, neraca saldo, laba rugi). Dibangun menggunakan Laravel 10 dengan antarmuka AdminLTE 3.2 dan database MySQL.

## Latar Belakang / Masalah yang Diselesaikan

Perusahaan distribusi memerlukan sistem terpadu untuk mengelola:
- Siklus pembelian ke supplier dan penerimaan barang.
- Siklus penjualan ke konsumen melalui jaringan sales dan ekspedisi.
- Pencatatan hutang kepada supplier dan piutang dari konsumen.
- Pengelolaan stok barang termasuk stock opname, penyesuaian stok, dan konversi satuan stok.
- Pelaporan keuangan yang akurat dan tepat waktu (jurnal, buku besar, neraca saldo, laba rugi).
- Pelacakan aktivitas pengguna (audit trail) untuk akuntabilitas internal.

## Tujuan

1. Menyediakan sistem terintegrasi yang mencatat seluruh transaksi bisnis distribusi dari hulu ke hilir.
2. Mengotomatisasi pencatatan hutang-piutang dan pelacakan pembayaran.
3. Menyediakan laporan keuangan standar (jurnal, buku besar, neraca saldo, laba rugi) yang dapat dicetak (PDF via TCPDF).
4. Memberikan kontrol akses berbasis otorisasi menu per pengguna.
5. Meningkatkan akurasi stok melalui fitur stock opname dan penyesuaian stok.

## Target Pengguna

- **Admin / Back-office**: Mengelola data master, pengaturan sistem, dan otorisasi pengguna.
- **Bagian Pembelian**: Input pembelian, penerimaan barang, retur pembelian, pembayaran hutang.
- **Bagian Penjualan**: Input penjualan, cetak invoice/kwitansi, surat jalan.
- **Sales**: Melihat penagihan dan bonus sales.
- **Kasir**: Input penjulan, retur penjualan.
- **Bagian Keuangan / Akunting**: Jurnal, posting jurnal, laporan keuangan (buku besar, neraca saldo, laba rugi).
- **Bagian Gudang**: Stock opname, penyesuaian stok, konversi stok, kartu stok barang.
- **Manajemen**: Dashboard (grafik penjualan, info box), laporan rekap hutang/piutang/persediaan.

## Ruang Lingkup

### In Scope
- **Master Data**: Pengguna & otorisasi, konsumen, supplier, sales, ekspedisi, wilayah, bank, barang (kategori, jenis, satuan), chart of accounts (akun 1–4), pengaturan sistem.
- **Transaksi Pembelian**: Pembelian (purchase order), penerimaan barang, retur pembelian.
- **Transaksi Penjualan**: Penjualan, cetak invoice & kwitansi, retur penjualan.
- **Pengiriman**: Surat jalan.
- **Hutang & Piutang**: Pencatatan hutang (supplier & ekspedisi), piutang, pembayaran piutang, penagihan sales.
- **Kas / Bank**: Penerimaan kas, pengeluaran kas.
- **Persediaan**: Stock opname, penyesuaian stok, konversi stok, kartu stok barang, saldo awal.
- **Akuntansi**: Jurnal umum, posting jurnal, saldo awal akun.
- **Bonus Sales**: Perhitungan dan pencatatan bonus sales.
- **Laporan (PDF)**: Laporan pembelian, penjualan (ringkasan & detail), retur pembelian, retur penjualan, buku hutang, rekap hutang, hutang ekspedisi, buku piutang, rekap piutang, penagihan sales, bonus sales, persediaan, kartu stok, pengeluaran, penerimaan, buku besar, jurnal, neraca saldo, laba rugi, riwayat aktivitas.
- **Dashboard**: Grafik penjualan, info box ringkasan.
- **Otorisasi & Audit Trail**: Hak akses menu per pengguna, riwayat aktivitas pengguna.

### Out of Scope
- API publik untuk pihak ketiga (API route hanya berisi endpoint sanctum default).
- Modul HR / penggajian.
- E-commerce / portal pelanggan.
- Integrasi payment gateway.
- Multi-cabang / multi-gudang (belum teridentifikasi).
- Mobile app.

## Fitur Utama

1. **Manajemen Pengguna & Otorisasi** — CRUD pengguna, pengaturan hak akses menu granular per pengguna.
2. **Manajemen Barang & Stok** — Master barang dengan kategori/jenis/satuan, stock opname, penyesuaian stok, konversi satuan stok.
3. **Siklus Pembelian** — Pembelian → penerimaan barang → retur pembelian → pencatatan hutang.
4. **Siklus Penjualan** — Penjualan → cetak invoice/kwitansi → surat jalan → pencatatan piutang → penagihan.
5. **Hutang-Piutang** — Pencatatan, pembayaran, dan pelacakan hutang (supplier & ekspedisi) serta piutang (konsumen).
6. **Bonus Sales** — Perhitungan dan cetak laporan bonus berdasarkan kinerja sales.
7. **Kas / Bank** — Pencatatan penerimaan dan pengeluaran kas.
8. **Akuntansi** — Chart of accounts 4 level, jurnal umum, posting jurnal, saldo awal.
9. **Laporan PDF** — 20+ jenis laporan yang dapat dicetak via TCPDF.
10. **Dashboard** — Grafik penjualan, info box ringkasan operasional.
11. **Audit Trail** — Riwayat aktivitas pengguna tercatat otomatis di setiap operasi data.

## Stakeholder

| Peran | Keterangan |
|-------|------------|
| Pemilik / Manajemen | PT. Sukses Tama Jaya Abadi |
| Developer | TZDEVELOPER |
| Pengguna Akhir | Staff admin, pembelian, penjualan, gudang, keuangan, sales |

## Kriteria Sukses

1. Seluruh transaksi pembelian, penjualan, dan keuangan tercatat akurat dalam sistem.
2. Laporan keuangan (neraca saldo, laba rugi) dapat dihasilkan sesuai periode yang diminta.
3. Stok barang di sistem sesuai dengan stok fisik setelah stock opname.
4. Setiap aktivitas pengguna terekam untuk keperluan audit.
5. Hak akses menu berfungsi dengan benar — pengguna hanya melihat menu yang diotorisasi.

## Asumsi & Batasan

### Asumsi
- Database menggunakan MySQL dengan view (prefix `v_`) dan stored function (contoh: `create_idbank`) yang sudah ada di database.
- Aplikasi berjalan di lingkungan Laragon (Windows) untuk development.
- Session berbasis file digunakan untuk autentikasi (bukan Laravel built-in auth, melainkan custom session).
- Model menggunakan query builder (DB facade) langsung, bukan Eloquent relationship.
- Menu dinamis dimuat dari database dan nama tabel nya `menus` dan disimpan di session.

### Batasan
- README.md masih default Laravel, tidak ada dokumentasi proyek khusus.
- Tidak ada test yang spesifik untuk bisnis (hanya ExampleTest default Laravel).
- Tidak ada folder `docs/`.
- Migrasi database hanya berisi tabel default Laravel (users, sessions, failed_jobs, personal_access_tokens) — skema bisnis kemungkinan dikelola langsung di MySQL di luar migrasi Laravel.

## Keputusan & Klarifikasi

1. **Siapa pemilik / stakeholder utama proyek ini?**
   Stakeholder pemilik produk: PT. Sukses Tama Jaya Abadi. Developer: TZDEVELOPER.

2. **Apa hubungan konstanta `NAMAUSAHA = 'PT. INTRAHUSADA'` di `ConstantsHelper.php` dengan nama domain `suksestamajayaabadi.com`?**
   `PT. INTRAHUSADA` adalah nilai lama yang masih digunakan di cetakan invoice, belum diperbarui sejak rebranding ke Sukses Tama Jaya Abadi. Bukan sistem multi-tenant.

3. **Bagaimana skema database bisnis dikelola?**
   Skema dikelola via SQL dump di `db/db.sql`. Laravel migration **tidak** digunakan untuk skema bisnis. Setiap perubahan struktur DB dilakukan manual dan wajib dicatat di dokumen ini.

4. **Apakah ada rencana menambah fitur multi-cabang atau multi-gudang?**
   Tidak ada rencana.

5. **Apa peran spesifik kasir (`IDOTORISASIKASIR`) dalam sistem?**
   Konstanta `IDOTORISASIKASIR` sudah tidak digunakan lagi (deprecated/legacy). Otorisasi akses pengguna kini dikelola secara granular per menu di tabel `pengguna_menus`.

6. **Apakah ada target migrasi ke versi Laravel yang lebih baru?**
   Tidak ada target migrasi. Proyek tetap di Laravel 10.

7. **Apakah ada kebutuhan API untuk integrasi dengan sistem lain?**
   Tidak ada kebutuhan integrasi API eksternal.

## Riwayat Perubahan

| Tanggal | Perubahan | Oleh |
|---------|-----------|------|
| 2026-10-09 | Dokumen awal dibuat berdasarkan analisis kode sumber | AI Assistant |
| 2026-10-09 | Jawaban pertanyaan terbuka diformat ulang menjadi "Keputusan & Klarifikasi" | AI Assistant |
| 2026-10-09 | Klarifikasi peran `IDOTORISASIKASIR` (deprecated, diganti `pengguna_menus`) dirapikan | AI Assistant |
