# Product Context: Sukses Tama Jaya Abadi — Sistem ERP Distribusi

## Mengapa Proyek Ini Ada

PT. Sukses Tama Jaya Abadi beroperasi sebagai perusahaan distribusi barang fisik dengan volume perputaran barang dan transaksi yang tinggi. Aktivitas harian mencakup pengadaan barang dari berbagai supplier, penerimaan logistik melalui ekspedisi, penyimpanan barang dengan variasi satuan (karton, dos, pcs), penjualan partai/eceran ke ratusan konsumen melalui jaringan tenaga penjual (sales), hingga pengelolaan pembayaran tempo (kredit).

Tanpa sistem terpadu yang andal, operasional distribusi menghadapi tantangan krusial:
- Ketidaksesuaian pencatatan persediaan fisik gudang dengan catatan pembukuan.
- Risiko kredit macet (*bad debt*) akibat konsumen yang terus berbelanja melampaui limit kredit atau memiliki faktur yang sudah melewati jatuh tempo.
- Kerumitan perhitungan harga: kombinasi diskon bertingkat (level 1, 2, 3), PPN proporsional per item faktur pajak, dan perhitungan Harga Pokok Penjualan (HPP) yang akurat.
- Keterlambatan dan friksi dalam pembuatan laporan keuangan bulanan (jurnal, neraca saldo, laba rugi) yang memerlukan konsistensi data dari seluruh rantai operasional.

Sistem ERP ini dibangun sebagai platform sentral berbasis web yang menyatukan alur operasional fisik (gudang dan pengiriman) dengan alur akuntansi (kas, piutang, hutang, dan laporan laba rugi).

---

## Masalah yang Dipecahkan

1. **Pengendalian Piutang & Limit Kredit Konsumen**:
   - Sistem secara otomatis memblokir transaksi penjualan baru jika konsumen memiliki piutang yang sudah melewati tanggal jatuh tempo atau jika total nilai pembelian baru melampaui sisa limit kredit yang ditentukan.
2. **Akurasi Valuasi Stok & HPP (Metode FIFO)**:
   - Mengatasi distorsi nilai modal barang akibat fluktuasi harga beli supplier dengan menerapkan alokasi persediaan keluar-masuk berbasis FIFO (*First-In, First-Out*), sehingga nilai HPP pada laporan laba rugi mencerminkan biaya perolehan riil.
3. **Pemisahan Alur Invoice & Dokumen Pengiriman Fisik**:
   - Memastikan barang yang keluar dari gudang selalu terkontrol melalui penerbitan Surat Jalan yang dapat merangkum multi-invoice, sekaligus mencatat biaya pengiriman dan identitas ekspedisi (plat kendaraan/jenis armada).
   - Mencegah manipulasi atau salah ubah faktur penjualan yang barangnya sudah dalam proses pengiriman (invoice terkunci otomatis jika sudah ada surat jalan).
4. **Perhitungan Insentif Penjualan yang Adil & Transparan**:
   - Mengotomatisasi kalkulasi bonus sales berdasarkan target omzet (kategori barang fast/middle) dan bonus ketepatan penagihan piutang sebelum jatuh tempo.
5. **Integritas Penutupan Periode Akuntansi**:
   - Mencegah perubahan data transaksi historis di periode akuntansi yang telah ditutup melalui mekanisme *Posting Jurnal*, menjaga kepatuhan dan keandalan audit keuangan.

---

## Pengalaman Pengguna yang Diharapkan

- **Cepat & Terstruktur**: Antarmuka dashboard berbasis AdminLTE yang intuitif bagi staf administrasi, didukung DataTables *server-side* untuk pencarian dan pemfilteran cepat ribuan data transaksi tanpa membebani browser.
- **Pencegahan Kesalahan Input (*Error Prevention*)**: Form transaksi memvalidasi secara proaktif: pengecekan ketersediaan stok, penghitungan diskon/PPN otomatis, penyesuaian nominal jatuh tempo, serta konfirmasi modal dialog sebelum penghapusan data.
- **Dokumen Operasional Siap Cetak**: Menghasilkan dokumen siap cetak dalam format PDF (A4/landscape/portrait) untuk invoice resmi, kwitansi kasir, surat jalan ekspedisi, rekap penagihan sales, hingga buku besar dan laporan laba rugi.
- **Hak Akses Sesuai Tugas**: Setiap staf hanya melihat menu dan tombol aksi (tambah, ubah, hapus) yang diotorisasi khusus untuk akun mereka, menjaga keamanan dan kerahasiaan data perusahaan.

---

## Alur Utama Pengguna (User Journey)

### 1. Siklus Pembelian & Penerimaan Barang
`Input Purchase Order (Pembelian)` ➔ `Barang Tiba via Ekspedisi` ➔ `Penerimaan Barang (Input Qty Fisik & Cek Selisih)` ➔ `Pencatatan Hutang Dagang & Hutang Ekspedisi` ➔ `Layer Stok FIFO Masuk`.
*(Jika ada cacat/rusak: Alur Retur Pembelian mengurangi hutang supplier dan mengeluarkan layer stok).*

### 2. Siklus Penjualan, Kasir, & Pengiriman
`Input Penjualan oleh Sales/Kasir` ➔ `Sistem Validasi Jatuh Tempo & Limit Kredit Konsumen` ➔ `Cetak Invoice Penjualan & Kwitansi Kasir` ➔ `Terbitkan Surat Jalan Gudang` ➔ `Invoice Terkunci` ➔ `Mutasi Stok Keluar (FIFO) & Penambahan Buku Piutang`.
*(Jika ada pengembalian: Alur Retur Penjualan memulihkan stok dan mengurangi saldo piutang).*

### 3. Siklus Piutang, Penagihan, & Bonus Sales
`Monitoring Umur Piutang di Laporan Penagihan Sales` ➔ `Kolektor/Sales Melakukan Penagihan ke Konsumen` ➔ `Input Pembayaran Piutang (Kas/Transfer/Giro)` ➔ `Saldo Piutang Berkurang` ➔ `Sistem Menghitung Bonus Penjualan & Bonus Penagihan Sales Sesuai Kriteria`.

### 4. Siklus Pengelolaan Stok Gudang
`Pemeriksaan Fisik Gudang` ➔ `Input Stock Opname` ➔ `Penyesuaian Stok Cepat (Koreksi Selisih)` ➔ `Konversi Satuan Barang (Karton ke Pcs)` ➔ `Audit Pergerakan via Kartu Stok Barang`.

### 5. Siklus Kas, Bank, & Akuntansi
`Pencatatan Pengeluaran/Penerimaan Kas & Bank Operasional` ➔ `Input Jurnal Memorial/Umum` ➔ `Verifikasi Buku Besar & Neraca Saldo` ➔ `Eksekusi Tutup Buku (Posting Jurnal Bulanan)` ➔ `Analisis Laporan Laba Rugi Akhir Periode`.

---

## Peran / Role Pengguna

| Peran | Tanggung Jawab Utama dalam Produk |
|---|---|
| **Administrator / IT** | Konfigurasi master data, manajemen pengguna, pengaturan hak akses menu (`pengguna_menus`), parameter PPN dan identitas usaha. |
| **Bagian Pembelian** | Pengadaan barang, pembuatan order pembelian, verifikasi penerimaan barang dari supplier, input retur pembelian. |
| **Bagian Penjualan & Kasir** | Pembuatan faktur penjualan, verifikasi kelayakan kredit konsumen, pencetakan kwitansi penerimaan pembayaran tunai, penanganan retur penjualan. |
| **Bagian Gudang & Logistik** | Penerbitan surat jalan pengiriman, verifikasi fisik barang masuk, pelaksanaan stock opname fisik, konversi satuan stok, monitoring kartu stok. |
| **Sales & Kolektor** | Monitoring daftar tagihan konsumen per rute/wilayah, pelacakan target penjualan bulanan, pengecekan bonus kinerja. |
| **Bagian Keuangan (Finance)** | Pelunasan hutang supplier, pelunasan hutang ekspedisi, penerimaan setoran pelunasan piutang, rekonsiliasi kas dan mutasi bank. |
| **Bagian Akunting & Manajemen** | Pemeriksaan jurnal, eksekusi tutup buku bulanan (*posting jurnal*), analisis laporan laba rugi, pemantauan dashboard performa distribusi. |

---

## Nilai Bisnis

1. **Perlindungan Arus Kas (*Cash Flow Protection*)**: Mengurangi risiko piutang macet melalui pembatasan plafon kredit otomatis dan penagihan terstruktur berbasis umur faktur.
2. **Efisiensi Logistik & Transparansi Biaya Kirim**: Biaya ekspedisi terintegrasi langsung dengan faktur penerimaan, termasuk kewajiban pajak PPh 23 dan PPN ongkos angkut.
3. **Akurasi Finansial & Kepatuhan Pajak**: Perhitungan PPN proporsional per item barang menjamin keselarasan antara total invoice dan faktur pajak standar.
4. **Motivasi Tenaga Penjual**: Skema bonus bertingkat transparan memacu produktivitas sales untuk mencapai target produk *fast/middle moving* dan mempercepat siklus penagihan.
5. **Akuntabilitas Internal**: Setiap tindakan penambahan, pengubahan, dan penghapusan data tercatat secara permanen di tabel `riwayataktifitas`.

---

## Batasan Produk

- **Satu Entitas Usaha (Single-Company)**: Dirancang khusus untuk operasional terpusat PT. Sukses Tama Jaya Abadi (tidak mendukung multi-company atau konsolidasi holding).
- **Satu Lokasi Gudang Terpadu**: Tidak memiliki fitur transfer antar-gudang (*multi-warehouse transfer*) atau multi-cabang terpisah.
- **Aplikasi Web Internal (Back-Office Only)**: Tidak menyediakan aplikasi mobile khusus untuk sales di lapangan dan tidak ada portal mandiri (*self-service*) untuk konsumen.
- **Pencatatan Pembayaran Manual**: Transaksi bank, transfer, dan giro diinput manual oleh staf keuangan (tanpa integrasi langsung ke API bank/payment gateway).
- **Tanpa Modul HRD / Payroll**: Pengelolaan absensi, gaji, dan kepegawaian berada di luar cakupan produk.

---

## Catatan & Asumsi

- **Identitas Usaha**: Nilai konstanta `NAMAUSAHA = 'PT. INTRAHUSADA'` pada `ConstantsHelper.php` merupakan nilai legacy yang belum direfleksikan sepenuhnya pasca-rebranding menjadi PT. Sukses Tama Jaya Abadi; nama operasional aktif merujuk pada tabel `pengaturan`.
- **Skema Otorisasi**: Hak akses dikendalikan secara granular per menu dan aksi (`tambah`, `edit`, `hapus`) melalui tabel `pengguna_menus` di sesi pengguna.
- **Retensi Audit Trail**: Belum ada dan masih dalam proses penentuan waktu retensi.
- **Versi Database Engine Server**: 8.0.30.
