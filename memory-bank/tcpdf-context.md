# TCPDF Context

Terakhir diperbarui: 2026-10-09  
Versi TCPDF: 6.7.5 (`tecnickcom/tcpdf` via Composer)

> ⚠️ **ATURAN PEMUATAN KONTEKS:**  
> File/konteks TCPDF ini **HANYA** dimuat saat membuat laporan baru atau memperbaiki laporan/dokumen cetak PDF.  
> Jika perbaikan atau tugas yang dikerjakan **BUKAN** terkait laporan PDF, maka file/konteks TCPDF ini **TIDAK PERLU** dimuat.

## Kapan File Ini Relevan (Dimuat)
- Membuat laporan atau dokumen cetak PDF baru
- Memperbaiki laporan atau dokumen cetak PDF yang mengalami kendala/bug
- Memperbaiki tata letak, margin, atau batas halaman (*page break*) PDF
- Menambah atau memodifikasi kolom/field data pada dokumen cetak PDF
- Melakukan debugging error saat proses generate PDF (`TCPDF ERROR: Some data has already been output`, dsb.)
- Mengatur ukuran kertas kustom (*continuous form* / setengah folio) vs standar A4
- Menyelaraskan tampilan kop surat (*header*) dan logo instansi pada PDF

## Kapan File Ini TIDAK Boleh Dimuat (Diabaikan)
- Perbaikan bug, fitur, atau tugas yang **bukan** dokumen/laporan PDF
- Perbaikan fitur CRUD data, form input, dan validasi transaksi web
- Autentikasi, otentikasi login kasir/admin, dan hak akses
- Perbaikan tampilan web, layout Blade master, sidebar, navbar, atau modal UI
- Perubahan skema database, migrasi, model, atau query backend non-laporan
- Konfigurasi server, environment, atau penanganan routing non-cetak

---

## Ringkasan Penggunaan
Di dalam proyek ERP distribusi PT. Sukses Tama Jaya Abadi, pustaka **TCPDF (v6.7.5)** digunakan sebagai mesin utama pembuatan dokumen resmi dan laporan manajerial siap cetak (*print-ready*). Dokumen yang dihasilkan mencakup dua kategori besar: (1) **Dokumen Transaksional**, seperti Faktur/Invoice Penjualan dan Nota Retur Penjualan yang dirancang khusus untuk kertas *continuous form* printer dot-matrix (ukuran 218 mm x 140 mm), serta (2) **Laporan Manajerial & Akuntansi**, seperti Kartu Stok FIFO, Buku Hutang/Piutang, Jurnal Umum, Buku Besar, Neraca Saldo, Laba Rugi, dan Laporan Rekap Penjualan/Pembelian berukuran kertas A4.

PDF di-generate secara *real-time* (*on-the-fly*) saat pengguna (Admin, Kasir, Bagian Keuangan, atau Pimpinan) membuka menu cetak atau menekan tombol cetak dari antarmuka web. Seluruh PDF tidak disimpan sebagai berkas fisik di folder `storage/`, melainkan langsung dialirkan (*streamed*) ke peramban menggunakan mode inline (`'I'`). Sebagian besar modul laporan juga memiliki pola dual-ekspor terpadu: jika pengguna memilih format Excel, aplikasi mengirimkan berkas `.xls` via header HTTP murni, sedangkan jika memilih PDF, view HTML yang sama di-parse ke TCPDF melalui metode `writeHTML()`.

---

## Daftar Laporan PDF

Total terdapat **32 metode cetak** di 26 controller aktif yang memanfaatkan TCPDF:

| Nama Laporan / Dokumen | Route | Controller & Method | View / Template | Format & Orientasi | Status |
|------------------------|-------|---------------------|-----------------|--------------------|--------|
| Faktur / Invoice Penjualan | `/penjualan/cetakInvoice/{id}` | `PenjualanController@cetakInvoice` | `resources/views/penjualan/cetakInvoice.blade.php` | Custom (218x140 mm) Landscape | Aktif |
| Nota Retur Penjualan | `/returpenjualan/cetak/{id}` | `ReturpenjualanController@cetak` | `resources/views/returpenjualan/cetak.blade.php` | Custom (218x140 mm) Landscape | Aktif |
| Laporan Bonus Sales | `/bonussales/cetak/{idbonus}` | `BonussalesController@cetak` | `resources/views/bonussales/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Riwayat Aktivitas | `/home/cetakriwayataktifitas/{tglawal}/{tglakhir}/{idpengguna}` | `HomeController@cetakriwayataktifitas` | `resources/views/cetakriwayataktifitas.blade.php` | A4 Portrait | Aktif |
| Buku Hutang Supplier (Detail) | `/hutang/cetakBukuHutang/{id}` | `HutangController@cetakBukuHutang` | `resources/views/hutang/cetakBukuHutang.blade.php` | A4 Portrait | Aktif |
| Kartu Stok Barang (Periode) | `/kartustokbarang/cetak/{jenisCetakan}/{idkategori}/{tglwal}/{tglakhir}` | `KartustokbarangController@cetak` | `resources/views/kartustokbarang/cetak.blade.php` | A4 Landscape | Aktif |
| Kartu Stok Barang (Kategori) | `/kartustokbarang/cetak2/{idkategori}` | `KartustokbarangController@cetak2` | `resources/views/kartustokbarang/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Rekap Bonus Sales | `/lapbonussales/cetak/{jenisCetakan}` | `LapbonussalesController@cetak` | `resources/views/lapbonussales/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Buku Besar Akuntansi | `/lapbukubesar/cetak/{jenisCetakan}/{tglawal}/{tglakhir}/{kdakun}` | `LapbukubesarController@cetak` | `resources/views/lapbukubesar/cetak.blade.php` | A4 Portrait | Aktif |
| Laporan Buku Hutang Supplier | `/lapbukuhutang/cetak/{jenisCetakan}` | `LapbukuhutangController@cetak` | `resources/views/lapbukuhutang/cetak.blade.php` | A4 Portrait | Aktif |
| Laporan Buku Piutang Konsumen | `/lapbukupiutang/cetak/{jenisCetakan}` | `LapbukupiutangController@cetak` | `resources/views/lapbukupiutang/cetak.blade.php` | A4 Portrait | Aktif |
| Laporan Jurnal Umum | `/lapjurnal/cetak/{jenisCetakan}/{tglawal}/{tglakhir}` | `LapjurnalController@cetak` | `resources/views/lapjurnal/cetak.blade.php` | A4 Portrait | Aktif |
| Laporan Laba Rugi | `/laplabarugi/cetak/{tglawal}/{tglakhir}` | `LaplabarugiController@cetak` | `resources/views/laplabarugi/cetak.blade.php` | A4 Portrait | Aktif |
| Laporan Neraca Saldo | `/lapneracasaldo/cetak/{jenisCetakan}/{tglawal}/{tglakhir}` | `LapneracasaldoController@cetak` | `resources/views/lapneracasaldo/cetak.blade.php` | A4 Portrait | Aktif |
| Laporan Pembelian Barang | `/lappembelian/cetak/{jenisCetakan}` | `LappembelianController@cetak` | `resources/views/lappembelian/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Penagihan Sales | `/lappenagihansales/cetak/{jenisCetakan}` | `LappenagihansalesController@cetak` | `resources/views/lappenagihansales/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Penerimaan Kas/Bank | `/lappenerimaan/cetak/{jenisCetakan}/{tglawal}/{tglakhir}/{carabayar}` | `LappenerimaanController@cetak` | `resources/views/lappenerimaan/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Pengeluaran Kas/Bank | `/lappengeluaran/cetak/{jenisCetakan}/{tglawal}/{tglakhir}/{carabayar}` | `LappengeluaranController@cetak` | `resources/views/lappengeluaran/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Penjualan Rekap | `/lappenjualan/cetak/{jenisCetakan}` | `LappenjualanController@cetak` | `resources/views/lappenjualan/cetakbysales.blade.php` / `cetakbytgl.blade.php` | A4 Landscape | Aktif |
| Laporan Penjualan Rincian | `/lappenjualandetail/cetak/{jenisCetakan}` | `LappenjualandetailController@cetak` | `resources/views/lappenjualandetail/cetakbysales.blade.php` / `cetakbytgl.blade.php` | A4 Landscape | Aktif |
| Laporan Persediaan Stok Barang | `/lappersediaan/cetak/{jenisCetakan}/{tglriwayat}/{idkategori}` | `LappersediaanController@cetak` | `resources/views/lappersediaan/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Persediaan Stok (Old) | *TBD (Tanpa Route)* | `LappersediaanController_Old@cetak` | `resources/views/lappersediaan/cetak.blade.php` | A4 Landscape | Legacy (Unrouted) |
| Laporan Rekap Saldo Hutang | `/laprekaphutang/cetak/{jenisCetakan}` | `LaprekaphutangController@cetak` | `resources/views/laprekaphutang/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Rekap Saldo Piutang | `/laprekappiutang/cetak/{jenisCetakan}` | `LaprekappiutangController@cetak` | `resources/views/laprekappiutang/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Retur Pembelian | `/lapreturpembelian/cetak/{jenisCetakan}` | `LapreturpembelianController@cetak` | `resources/views/lapreturpembelian/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Retur Penjualan Rekap | `/lapreturpenjualan/cetak/{jenisCetakan}` | `LapreturpenjualanController@cetak` | `resources/views/lapreturpenjualan/cetak.blade.php` | A4 Landscape | Aktif |
| Laporan Buku Hutang Ekspedisi | `/laputangekspedisi/cetak/{jenisCetakan}` | `LaputangekspedisiController@cetak` | `resources/views/laputangekspedisi/cetak.blade.php` | A4 Landscape | Aktif |
| Lembar Penagihan Invoice | `/penagihan/cetak/{idpenagihan}` | `PenagihanController@cetak` | `resources/views/penagihan/cetak.blade.php` | A4 Landscape | Aktif |
| Berita Acara Penyesuaian Stok | `/penyesuaianstok/cetak/{idpenyesuaianstok}` | `PenyesuaianstokController@cetak` | `resources/views/penyesuaianstok/cetak.blade.php` | A4 Portrait | Aktif |
| Buku Piutang Konsumen (Detail) | `/piutang/cetakBukuPiutang/{id}` | `PiutangController@cetakBukuPiutang` | `resources/views/piutang/cetakBukuPiutang.blade.php` | A4 Portrait | Aktif |
| Blanko Fisik Stock Opname | `/stockopname/cetakform` | `StockopnameController@cetakform` | `resources/views/stockopname/cetakform.blade.php` | A4 Portrait | Aktif |
| Laporan Realisasi Stock Opname | `/stockopname/cetakSO/{idstockopname}` | `StockopnameController@cetakSO` | `resources/views/stockopname/cetakSO.blade.php` | A4 Portrait | Aktif |

> **Catatan Controller dengan Import Tak Terpakai**: Controller `HutangekspedisiController`, `KonversistokController`, `PembayaranpiutangController`, `RiwayatupdateController`, dan `SuratjalanController` memiliki deklarasi `use TCPDF;` di baris atas, namun tidak menginisialisasi atau memanggil `new TCPDF` di metodenya (Surat Jalan mencetak via HTML browser langsung).

---

## Pola Implementasi

### 1. Pola A: Dokumen Kertas Khusus (Continuous Form / 218x140 mm)
Digunakan pada dokumen transaksi kasir/penjualan (`PenjualanController@cetakInvoice` dan `ReturpenjualanController@cetak`).

```php
// app/Http/Controllers/PenjualanController.php (baris 548 - 584)
use TCPDF;

public function cetakInvoice($idpenjualan)
{
    $idpenjualan = Crypt::decrypt($idpenjualan);
    $rsPenjualan = Penjualan::findOrFail($idpenjualan);
    $rsDetail = $this->model->getDetail($idpenjualan);
    // ... pengambilan data konsumen, sales, bank, jatuh tempo ...

    $view = view('penjualan.cetakInvoice', $data);

    // Buat instance TCPDF
    $pdf = new TCPDF();

    // Set properti dokumen
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('TZ Developer');
    $pdf->SetTitle('Invoice');
    $pdf->SetSubject('Invoice');
    $pdf->SetKeywords('TCPDF, PDF, laporan, invoice');
    $pdf->SetFont('times', '', 10);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Atur ukuran kertas khusus (218 mm x 140 mm)
    $customPaperSize = array(218, 140); // Lebar: 218 mm, Tinggi: 140 mm
    $pdf->AddPage('L', $customPaperSize); // 'L' untuk landscape

    // Atur margin (1 cm = 10 mm)
    $marginKiri = 10;
    $marginAtas = 0;
    $marginKanan = 15;
    $margin = 0;
    $pdf->SetMargins($marginKiri, $marginAtas, $marginKanan);
    $pdf->SetAutoPageBreak(true, $margin);

    // Hilangkan padding internal cell
    $pdf->SetCellPadding(0);

    // Tulis konten HTML ke dalam PDF
    $pdf->writeHTML($view, true, false, true, false, '');

    // Output PDF inline ke browser
    $pdf->Output('invoice.pdf', 'I');
}
```

### 2. Pola B: Laporan Standar A4 & Dual Output (Excel vs PDF)
Digunakan di seluruh modul laporan manajerial (`Lap*`, `Kartustokbarang`, `Hutang`, `Piutang`, `Jurnal`, dll.).

```php
// app/Http/Controllers/LappenjualanController.php (baris 67 - 107)
use TCPDF;

public function cetak($jenisCetakan, Request $request)
{
    // ... filter tanggal, sales, konsumen, wilayah ...

    if ($orderBy == 'bysales') {
        $view = view('lappenjualan.cetakbysales', $data)->render();
    } else {
        $view = view('lappenjualan.cetakbytgl', $data)->render();
    }

    if ($jenisCetakan == 'excel') {
        // Ekspor langsung ke Excel via HTTP Header
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Laporan_Penjualan.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo $view;
    } else {
        // Generate PDF via TCPDF
        $pdf = new TCPDF();

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TZ Developer');
        $pdf->SetTitle('Laporan Penjualan');
        $pdf->SetSubject('Laporan Penjualan');
        $pdf->SetKeywords('TCPDF, PDF, laporan, penjualan');
        $pdf->SetFont('times', '', 10);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Margin default TCPDF dengan penyesuaian margin atas 5 mm
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetTopMargin(5);
        $pdf->AddPage('L'); // 'L' (Landscape) atau 'P' (Portrait)

        $pdf->writeHTML($view, true, false, true, false, '');

        $pdf->Output('laporan_penjualan.pdf', 'I');
    }
}
```

---

## Konfigurasi & Standar TCPDF Proyek

| Aspek | Standar Proyek | Catatan Teknis |
|-------|----------------|----------------|
| **Font Default** | `times`, reguler, 10pt | Diterapkan konsisten via `$pdf->SetFont('times', '', 10);`. Ukuran teks sub-elemen diatur kembali di dalam Blade template menggunakan CSS font size. |
| **Header & Footer Asli** | Selalu dinonaktifkan (`false`) | `$pdf->setPrintHeader(false);`<br>`$pdf->setPrintFooter(false);`<br>Garis horizontal dan nomor halaman default TCPDF dihilangkan karena kop surat instansi dibuat manual menggunakan tabel HTML. |
| **Kop Surat & Logo** | `public_path('images/' . session('usaha_logo'))` | **Sangat Penting:** Tag `<img>` di dalam view PDF **WAJIB** menggunakan `public_path(...)` (path filesystem absolut lokal Windows), **JANGAN** menggunakan `asset(...)` (URL HTTP), karena TCPDF akan gagal me-resolve URL atau memicu timeout jaringan. |
| **Metadata Dokumen** | `SetCreator(PDF_CREATOR)`, `SetAuthor('TZ Developer')` | Mayoritas controller menggunakan author `'TZ Developer'`. Lima controller (`Kartustokbarang`, `Laplabarugi`, `Lapneracasaldo`, `Lappersediaan`, `Lappersediaan_Old`) masih menyisakan author scaffold bawaan `'Your Name'`. |
| **Mode Output** | Inline (`'I'`) | Seluruh pemanggilan `$pdf->Output(filename, 'I')` membuka dokumen langsung pada tab baru peramban. Parameter `'D'` (download paksa) tidak digunakan. |
| **Auto Page Break** | Dokumen custom: aktif (`$margin = 0`); Laporan A4: default bawaan | Pada ukuran continuous form, margin bawah diatur 0 agar teks tabel tidak terpotong ke halaman baru secara prematur. |

---

## Aturan Penulisan Template HTML untuk TCPDF

TCPDF **TIDAK** menggunakan Chromium / WebKit engine, melainkan parser internal HTML 4 / CSS 2.0 yang sangat terbatas. Saat memodifikasi atau membuat template view PDF (`cetak*.blade.php`), patuhi aturan ketat berikut:

### 1. Struktur Layout yang Didukung
- Gunakan struktur tabel murni: `<table>`, `<thead>`, `<tbody>`, `<tr>`, `<th>`, `<td>`.
- Selalu set `border-collapse: collapse;` dan `width: 100%;` pada elemen `<table>`.
- Atur pembagian lebar kolom menggunakan persentase pada elemen `<th>` / `<td>`, contoh: `<th style="width: 15%;">`.
- Hindari nesting tabel yang terlalu dalam (> 3 tingkat) karena dapat memicu memory exhaustion atau layout kalkulasi salah.

### 2. Properti CSS yang HARUS DIHINDARI (Tidak Didukung)
- ❌ **Flexbox** (`display: flex`, `justify-content`, `align-items`)
- ❌ **CSS Grid** (`display: grid`, `grid-template-columns`)
- ❌ **Transform & Positioning Kompleks** (`position: absolute`, `transform: rotate`, `float`)
- ❌ **CSS Modern**: `calc()`, CSS variables (`var(--...)`), `@media print`
- ❌ **Border radius, box-shadow, linear-gradient**

### 3. Properti CSS yang Aman Digunakan
- ✅ `font-size` (disarankan satuan `px` atau `pt`, misal `8px`–`14px`)
- ✅ `font-weight: bold;`
- ✅ `text-align: left | center | right;`
- ✅ `border: 1px solid black;` (atau `border-top`, `border-bottom`)
- ✅ `color` & `background-color` sederhana (#hex)

---

## Troubleshooting & Debugging Error Umum

### 1. `TCPDF ERROR: Some data has already been output, can't send PDF file`
* **Penyebab**: Ada karakter spasi, *newline*, tanda kurung PHP, atau peringatan/notifikasi PHP (*warning/notice*) yang terkirim ke output buffer sebelum method `$pdf->Output()` dipanggil.
* **Solusi**:
  1. Pastikan tidak ada `echo`, `print_r`, atau `dd()` yang tertinggal di controller maupun service.
  2. Periksa apakah ada spasi/baris kosong sebelum tag pembuka `<?php` atau setelah penutup `?>` di file helper/controller.
  3. Pastikan template view tidak memicu error *undefined index* yang mencetak PHP Notice ke buffer.

### 2. Logo / Gambar Kop Surat Hilang atau Pecah
* **Penyebab**: Menggunakan helper `asset('images/...')` yang menghasilkan URL web (`http://...`), bukan path file fisik lokal.
* **Solusi**:
  Ganti pemanggilan logo menjadi:
  ```html
  <img src="{{ public_path('images/' . session('usaha_logo')) }}" style="width: 50px;">
  ```
  Dan pastikan file logo benar-benar ada di `public/images/`.

### 3. Teks Terpotong atau Halaman Kosong Bertambah (*Unwanted Blank Page*)
* **Penyebab**: Margin tabel terlalu mendekati batas halaman bawah atau terdapat tag `<br>` / `<div>` tak terlihat di ujung dokumen.
* **Solusi**:
  1. Pada form khusus, aktifkan `$pdf->SetCellPadding(0);` dan set `$pdf->SetAutoPageBreak(true, 0);`.
  2. Kurangi ukuran font tabel (misal dari `10px` ke `8px` atau `9px`).
  3. Hilangkan margin/padding pada elemen `<body>` di dalam berkas blade.
