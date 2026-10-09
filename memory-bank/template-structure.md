# Template Structure

Terakhir diperbarui: 2026-10-09  
Total file di resources/views/template/: 4 file

## Gambaran Umum
Folder `resources/views/template/` berfungsi sebagai fondasi utama (master layout dan komponen navigasi global) antarmuka aplikasi ERP distribusi PT. Sukses Tama Jaya Abadi. Template ini berbasis framework admin **AdminLTE v3.2** yang dipadukan dengan **Bootstrap 4**, **jQuery**, **Select2**, **DataTables**, **SweetAlert**, **NotifiT**, dan **jQuery Mask**.

Template ini digunakan oleh hampir seluruh halaman operasional modul aplikasi yang diakses oleh pengguna terautentikasi (Kasir, Sales, Admin, Akuntan, Gudang, Pimpinan/Owner), mencakup modul Master Data, Transaksi Pembelian/Penjualan, Manajemen Stok/FIFO, Keuangan/Akuntansi, hingga modul Laporan Manajerial. Halaman publik/otentikasi (`login.blade.php`) serta lembar cetak transaksi/laporan fisik (`cetak*.blade.php`) tidak menginduk ke folder template ini melainkan berdiri sendiri (*standalone*).

---

## Struktur Direktori

### Direktori `resources/views/template/`
```text
resources/views/template/
├── layout.blade.php            # [LAYOUT] Master layout kerangka utama HTML/AdminLTE
├── sidenavbar.blade.php         # [PARTIAL] Sidebar navigasi dinamis berbasis hak akses menu
├── sidenavbar.blade copy.php    # [LEGACY/BACKUP] Arsip sidebar statis lama sebelum menu dinamis
└── topnavbar.blade.php          # [PARTIAL] Navbar bagian atas (header bar)
```

### Konteks Direktori View Terkait
```text
resources/views/
├── template/                   # Master layout dan navigasi global (4 file)
├── [nama_modul]/               # 56 folder modul transaksi, referensi, dan laporan
│   ├── index.blade.php         # [PAGE] Tabel data listing / DataTables
│   ├── form.blade.php          # [PAGE] Form tambah / edit transaksi
│   ├── detail.blade.php        # [PAGE] Detail pembayaran / rincian data (opsional)
│   ├── modal*.php / .blade.php # [PARTIAL] Form modal popup (barang, akun, pembayaran)
│   └── cetak*.blade.php        # [PRINT/STANDALONE] Lembar faktur / kwitansi / laporan fisik
├── home.blade.php              # [PAGE] Dashboard utama sistem
├── login.blade.php             # [STANDALONE] Form otentikasi (tema Login_v18)
├── login.blade copy.php        # [LEGACY/BACKUP] Backup form login
├── riwayatupdate.blade.php     # [PAGE] Halaman log pembaruan aplikasi
├── lihatriwayataktifitas.blade.php # [PAGE] Halaman audit trail aktivitas
└── welcome.blade.php           # [STANDALONE] Halaman sambutan default Laravel (tidak terpakai)
```

---

## Master Layout (`resources/views/template/layout.blade.php`)

File `layout.blade.php` berukuran 1.125 baris dan memuat seluruh kerangka struktur aplikasi terautentikasi.

### 1. Arsitektur & Hierarki Dokumen
Dokumen HTML disusun dengan urutan:
1. `<!DOCTYPE html> <html lang="en">`
2. `<head>`: Metadata, title dinamis (`session('usaha_nama_singkat')`), favicon dinamis (`session('usaha_logo')`), dan pemuatan seluruh berkas CSS.
3. `<body class="hold-transition sidebar-mini layout-fixed">`
4. `<div class="wrapper">`:
   - Loading overlay (`<div id="divLoading"></div>`)
   - `@include('template/topnavbar')` (Header atas)
   - `@include('template/sidenavbar')` (Sidebar kiri)
   - `@yield('content')` (Area konten utama halaman modul)
   - `<footer class="main-footer">` (Footer hak cipta)
   - `<aside class="control-sidebar control-sidebar-dark">` (Sidebar konfigurasi)
   - `#modalRiwayatAktivitas` (Modal popup global audit trail)
5. Pustaka JavaScript vendor (`AdminLTE32`, `jQuery`, `DataTables`, `Select2`, `SweetAlert`, dll.)
6. Notifikasi Flash Session (`session('success')`, `session('fail')`, `session('error')`, `session('other')`) via SweetAlert & NotifiT.
7. `@yield('scripts')` (Tempat injeksi skrip JavaScript dan modal partial khusus per halaman)
8. Skrip Utilitas Global (Input Masking, Select2 AJAX bindings, auto-session checking, audit trail listener, update notification).

### 2. Slot & Direktif Injeksi Konten
Master layout hanya menyediakan **2 titik injeksi (@yield)**:
* `@yield('content')` (Baris 64): Merender seluruh wrapper halaman modul (`<div class="content-wrapper">`).
* `@yield('scripts')` (Baris 231): Merender skrip JavaScript halaman lokal serta partial modal popup transaksi.

### 3. Aset CSS & JS yang Dimuat
Seluruh aset dibaca langsung dari folder `public/assets/` menggunakan helper `asset()`:

| Kategori | Vendor / Pustaka | Lokasi Berkas | Keterangan |
|----------|------------------|---------------|------------|
| **CSS** | FontAwesome 5 Free | `assets/AdminLTE32/plugins/fontawesome-free/css/all.min.css` | Ikon antarmuka |
| **CSS** | AdminLTE v3.2 Core | `assets/AdminLTE32/dist/css/adminlte.min.css` | Styling UI utama |
| **CSS** | iCheck Bootstrap | `assets/AdminLTE32/plugins/icheck-bootstrap/icheck-bootstrap.min.css` | Kustomisasi checkbox/radio |
| **CSS** | DataTables | `assets/datatables/css/jquery.dataTables.min.css` | Styling tabel data |
| **CSS** | jQuery UI | `assets/jquery-ui/themes/base/jquery-ui.css` | Kalender datepicker & dialog |
| **CSS** | Select2 | `assets/select2/css/select2.min.css` | Dropdown pencarian interaktif |
| **CSS** | NotifiT | `assets/notifit/css/notifit.css` | Notifikasi toast banner |
| **CSS** | Kustom ERP | `assets/custom/custom.css` | Penyesuaian tata letak lokal |
| **JS** | jQuery 3.x | `assets/AdminLTE32/plugins/jquery/jquery.min.js` | Fondasi manipulasi DOM |
| **JS** | Bootstrap 4 Bundle | `assets/AdminLTE32/plugins/bootstrap/js/bootstrap.bundle.min.js` | Modal, tooltip, dropdown |
| **JS** | AdminLTE v3.2 JS | `assets/AdminLTE32/dist/js/adminlte.js` | Kontrol sidebar treeview & pushmenu |
| **JS** | DataTables JS | `assets/datatables/js/jquery.dataTables.min.js` | Pengurutan, filter, paging tabel |
| **JS** | jQuery Mask | `assets/jquery_mask/jquery.mask.js` | Format otomatis mata uang, NPWP, akun |
| **JS** | Bootstrap Validator | `assets/bootstrap-validator/js/bootstrapValidator.js` | Validasi formulir sisi klien |
| **JS** | jQuery UI JS | `assets/jquery-ui/jquery-ui-2.js` | Datepicker & komponen interaktif |
| **JS** | NotifiT JS | `assets/notifit/js/notifit.js` | Pemanggil toast notifikasi |
| **JS** | Select2 JS | `assets/select2/js/select2.min.js` | Search autocomplete AJAX |
| **JS** | SweetAlert | `assets/sweetalert/sweetalert.min.js` | Dialog konfirmasi & alert popup |
| **JS** | CKEditor | `assets/ckeditor/ckeditor.js` | Rich text editor (opsional modul tertentu) |
| **JS** | Kustom JS | `assets/custom/custom.js` | Helper klien lokal |

### 4. Komponen Global & Modal Terpasang
* **Loading Overlay (`#divLoading`)**: Overlay transparan dengan gambar animasi `public/images/Loading.gif` untuk indikator tunggu.
* **AJAX Global Interceptor**:
  - `$(document).ajaxStart()`: Menampilkan `.loader` dan menonaktifkan seluruh `button[type="submit"]` untuk mencegah double click/submit ganda.
  - `$(document).ajaxStop()`: Menyembunyikan `.loader` dan mengaktifkan kembali tombol submit.
  - `$(document).ajaxError()`: Menangkap kegagalan AJAX dan memunculkan pesan SweetAlert otomatis.
* **Modal Riwayat Aktivitas (`#modalRiwayatAktivitas`)**:
  - Modal global untuk menampilkan audit trail per transaksi/data.
  - Dipicu secara otomatis saat elemen dengan class `.lihat-riwayat` diklik (`data-riwayat-table="namatabel"`).
  - Mengambil data melalui AJAX GET `ajax/getRiwayatAkivitas` dan memformat waktu selisih menggunakan fungsi `sinces()`.

### 5. Skrip & Utilitas Bawaan di Layout
* **Global Input Masking**:
  - `.rupiah`: Format ribuan `000,000,000,000` rata kanan.
  - `.rupiahDesimal`: Format ribuan dengan desimal `000,000,000,000.00` rata kanan.
  - `.persen`: Format persentase `000.00` rata kanan.
  - `.nik`: Masking 16 digit.
  - `.npwp`: Masking 20 karakter.
  - `.notelp`, `.nowa`: Masking nomor telepon/WhatsApp 20 digit.
  - `.kdakun1` s.d. `.kdakun4`: Format kode akun berjenjang (`X`, `X.X`, `X.X.XX`, `X.X.XX.XX`).
  - `#nobilyetgiro`, `#nofaktur`, `#noinvoice`, `#kdbarang`: Masking alfanumerik otomatis huruf kapital (*uppercase*).
* **Helper Konversi Angka Klien**:
  - `format_decimal(number, decPlaces, decSep, thouSep)`
  - `format_rupiah(number, decPlaces, decSep, thouSep)`
  - `hilangkanTitik(input)`
* **Pencarian Autocomplete Terpusat (Select2 AJAX)**:
  - `.searchBarang` & `.searchBarangModal` -> route `barang.searchBarang` (dilengkapi dropdown custom info stok & kategori)
  - `.searchJenisBarang` -> route `jenisbarang.searchJenisBarang`
  - `.searchKategori` -> route `kategoribarang.searchKategori`
  - `.searchPengguna` & `.searchKasir` -> route `pengguna.searchPengguna` / `pengguna.searchKasir`
  - `.searchSupplier` -> route `supplier.searchSupplier`
  - `.searchSales` -> route `sales.searchSales`
  - `.searchEkspedisi` & `.searchJenisEkspedisi` -> route `ekspedisi.searchEkspedisi`
  - `.searchWilayah` -> route `wilayah.searchWilayah`
  - `.searchKonsumen` -> route `konsumen.searchKonsumen`
  - `.searchBank` -> route `bank.searchBank`
  - `.searchJenisPiutang` -> route `jenispiutang.searchJenisPiutang`
  - `.searchAkunAll`, `.searchAkunKas`, `.searchAkunPengeluaran`, `.searchAkunPenerimaan`, `.searchAkunPiutangKonsumen`, `.searchAkunUtangSupplier`, `.searchAkunUtangEkspedisi` -> route `akun4.searchAkun*`
* **Pengecekan Sesi Aktif Otomatis**:
  - `runCheckAndSchedule()` mengecek status login ke `ajax/cekSessionLogin` setiap 5–10 menit dengan sinkronisasi `localStorage`. Jika sesi kedaluwarsa, muncul alert dan otomatis redirect ke `/login`.
* **Pengecekan Pembaruan Sistem**:
  - `cekRiwayatUpdate()` memanggil `ajax/cekRiwayatUpdate` dan mencocokkan respon dengan `localStorage('logupdate')`. Jika ada versi baru, memunculkan badge merah "New" pada menu riwayat update.

---

## Partials dalam Template (`resources/views/template/`)

### 1. Top Navbar (`resources/views/template/topnavbar.blade.php`)
- **Tipe**: PARTIAL (`@include('template/topnavbar')`).
- **Fungsi**: Header bar horizontal bagian atas.
- **Komponen Utama**:
  - Tombol burger toggle sidebar (`data-widget="pushmenu"`).
  - Tautan navigasi kiri (terdapat placeholder statis bawaan AdminLTE seperti link `Home` dan `Contact`).
  - Kontainer kanan (`navbar-nav ml-auto`) untuk ekstensi masa depan.

### 2. Side Navbar (`resources/views/template/sidenavbar.blade.php`)
- **Tipe**: PARTIAL (`@include('template/sidenavbar')`).
- **Fungsi**: Panel navigasi utama di sisi kiri aplikasi.
- **Logika & Perilaku**:
  - Menampilkan logo usaha (`session('usaha_logo')`) dan nama singkat (`session('usaha_nama_singkat')`).
  - Menampilkan foto pengguna (`session('fotopengguna')`) dan nama pengguna aktif (`session('namapengguna')`).
  - Link cepat Dashboard (`route('home')`).
  - **Pohon Menu Dinamis (Multi-level Treeview)**:
    - Membaca struktur hierarki menu yang disimpan di `session('user_menus')` saat pengguna login.
    - Mendukung hingga 3 tingkat hierarki (Level 0: Menu Utama / Folder, Level 1: Sub-Menu, Level 2: Item Transaksi).
    - Menghitung status aktif (*active*) dan folder terbuka (*menu-open*) secara otomatis dengan mencocokkan segmen URL pertama (`$controller = explode('/', request()->path())[0]`) terhadap daftar controller anak (`$controllerChildren`).
    - Merender elemen tautan HTML menggunakan fungsi helper global `generateLink()` dari `app/Helpers/MenusHelper.php`.
  - Link menu statis wajib di bagian bawah:
    - **Riwayat Update** (`route('riwayatupdate')`): Dilengkapi penanda `#pRiwayatUpdate` untuk notifikasi badge update baru.
    - **Logout** (`route('logout')`): Tautan langsung keluar sesi aplikasi.

### 3. File Legacy: `sidenavbar.blade copy.php`
- **Tipe**: LEGACY / BACKUP FILE (tidak aktif).
- **Keterangan**: Berkas arsip navigasi lama berukuran 671 baris sebelum implementasi sistem menu dinamis berbasis database/session. Berisi daftar menu yang ditulis secara *hardcoded* (seperti grup Referensi, Pembelian, Penjualan, dll.). File ini tidak di-load oleh `layout.blade.php` mana pun.

---

## Klasifikasi & Hubungan Antar View

Dari total **165 berkas view** di dalam proyek:

| Klasifikasi | Jumlah | Definisi & Karakteristik | Contoh Berkas |
|-------------|--------|--------------------------|---------------|
| **LAYOUT** | 1 | Master template kerangka utama dengan `@yield` | `resources/views/template/layout.blade.php` |
| **PARTIAL (Template)** | 2 | Potongan layout inti yang di-`@include` di master layout | `resources/views/template/topnavbar.blade.php`<br>`resources/views/template/sidenavbar.blade.php` |
| **PARTIAL (Modul/Modal)** | 18 | Fragmen modal popup atau rincian transaksi yang di-`@include` ke dalam halaman page | `resources/views/penjualan/modalTambahBarang.php`<br>`resources/views/hutang/modalTambahPembayaran.blade.php` |
| **PAGE** | 100 | Halaman utama modul yang menginduk (`@extends('template/layout')`) dan mengisi `@section('content')` | `resources/views/home.blade.php`<br>`resources/views/penjualan/index.blade.php`<br>`resources/views/penjualan/form.blade.php` |
| **STANDALONE (Otentikasi)** | 1 | Halaman mandiri lengkap tanpa layout admin | `resources/views/login.blade.php` |
| **PRINT / STANDALONE** | 39 | Lembar cetak HTML faktur/kwitansi/laporan fisik tanpa sidebar/navbar | `resources/views/penjualan/cetakInvoice.blade.php`<br>`resources/views/lapjurnal/cetak.blade.php` |
| **BACKUP / TIDAK AKTIF** | 4 | Berkas cadangan lokal atau template default Laravel yang tidak dipakai | `resources/views/template/sidenavbar.blade copy.php`<br>`resources/views/login.blade copy.php`<br>`resources/views/welcome.blade.php`<br>`resources/views/penjualan/cetakInvoice.blade-2026-03-11.php` |

---

## Penggunaan Direktif Blade

Analisis seluruh berkas view menunjukkan pola pemakaian direktif Blade berikut:

### 1. Direktif yang Digunakan Aktif
* `@extends('template/layout')` (100 kali): Dipakai seragam oleh seluruh berkas halaman modul.
* `@section('content')` & `@section('scripts')` (200 pasang): Pasangan pembuka dan penutup blok konten serta skrip lokal.
* `@yield('content')` & `@yield('scripts')` (2 kali): Didefinisikan secara eksklusif hanya di `resources/views/template/layout.blade.php`.
* `@include(...)` (20 kali): Digunakan untuk memasukkan partial navigasi di template dan partial modal form di modul transaksi.
* `@php ... @endphp`: Digunakan intensif untuk komputasi lokal data tabel, format mata uang, serta logika penentuan status aktif menu.
* `@if ... @elseif ... @else ... @endif`: Logika percabangan tampilan kondisi data dan hak akses.
* `@foreach ... @endforeach` & `@for ... @endfor`: Pengulangan iterasi tabel transaksi dan struktur pohon menu.
* `@forelse ... @empty ... @endforelse`: Penanganan iterasi data dengan fallback saat kosong.
* `@csrf`: Token perlindungan CSRF untuk form otentikasi dan modal POST.

### 2. Direktif yang TIDAK Digunakan (Tidak Ditemukan)
* `@component` / `<x-...>`: **Tidak digunakan sama sekali**. Proyek ini tidak mengadopsi Blade View Components modern.
* `@push` & `@stack`: **Tidak digunakan**. Injeksi skrip per halaman seluruhnya dimasukkan langsung ke dalam `@section('scripts')`.
* `@includeIf`, `@includeWhen`, `@includeUnless`: **Tidak digunakan**. Pemanggilan potongan view selalu menggunakan `@include` langsung.
* `@each`: **Tidak digunakan**. Perulangan selalu menggunakan blok eksplisit `@foreach` atau `@for`.

---

## Modal Partial Lintas Modul (Reusability Pattern)

Sebanyak 18 berkas form modal ditempatkan langsung di folder modul masing-masing dan di-`@include` di bagian `@section('scripts')` halaman transaksi. Menariknya, sistem menerapkan **penggunaan kembali (*reuse*) modal antar folder modul yang berbeda**:

| Berkas Modal Partial | Di-include Oleh View Halaman | Catatan Keterhubungan |
|----------------------|------------------------------|-----------------------|
| `hutang/modalTambahPembayaran.blade.php` | `hutang/detail.blade.php`<br>`hutangekspedisi/detail.blade.php` | Modul Hutang Ekspedisi memanfaatkan ulang modal dari modul Hutang Supplier utama. |
| `piutang/modalTambahPembayaran.blade.php` | `piutang/detail.blade.php`<br>`pembayaranpiutang/detail.blade.php` | Modul Pembayaran Piutang memanfaatkan ulang form pembayaran dari modul Piutang Konsumen. |
| `jurnal/modalTambahAkun.php` | `jurnal/form.blade.php`<br>`postingjurnal/form.blade.php` | Modul Posting Jurnal memanfaatkan ulang modal input baris akun dari Jurnal Umum. |
| `penjualan/modalTambahBarang.php` | `penjualan/form.blade.php` | Modal input rincian barang, harga, diskon bertingkat, dan PPN transaksi penjualan. |
| `pembelian/modalTambahBarang.php` | `pembelian/form.blade.php` | Modal input barang pesanan pembelian. |
| `pembelianpenerimaan/modalTambahBarang.blade.php` | `pembelianpenerimaan/form.blade.php` | Modal input barang penerimaan real gudang beserta nomor batch. |
| `suratjalan/modalTambahInvoice.php` | `suratjalan/form.blade.php` | Modal pemilihan invoice penjualan untuk disertakan ke surat jalan pengiriman. |
| `suratjalan/modalTambahRincian.php` | `suratjalan/form.blade.php` | Modal penyesuaian rincian item pengiriman surat jalan. |

> **Catatan Teknis Ekstensi File**: Beberapa file modal berekstensi murni `.php` (misal `modalTambahBarang.php`), namun di dalamnya tetap dieksekusi oleh Blade engine dan menggunakan tag kurung kurawal `{{ url(...) }}` karena di-include dari dalam file `.blade.php`.

---

## View Non-Template (Standalone & Lembar Cetak)

### 1. Halaman Otentikasi (`resources/views/login.blade.php`)
* Tidak mewarisi `template/layout.blade.php`.
* Memuat struktur HTML mandiri dengan pustaka terisolasi di `public/assets/Login_v18/` (Bootstrap, Animsition, FontAwesome 4.7, Linearicons).
* Memproses login pengguna via AJAX POST ke `actionLogin` dengan penanganan pesan error alert.

### 2. Lembar Cetak Transaksi & Laporan Manajerial (`cetak*.blade.php`)
* Berjumlah 39 file yang tersebar di modul operasional dan laporan (contoh: `penjualan/cetakInvoice.blade.php`, `suratjalan/cetaksuratjalan.blade.php`, `kartustokbarang/cetak.blade.php`, `lapbukubesar/cetak.blade.php`).
* Seluruh berkas cetak berformat **HTML & CSS murni tanpa layout admin**.
* Didesain spesifik untuk:
  - Pencetakan langsung peramban (*browser print*) ke kertas *continuous form* / printer dot-matrix (menggunakan CSS *fixed compact layout*, *table collapse*, margin nol, dan ukuran teks `6px`–`10px`).
  - Render PDF menggunakan pustaka `TCPDF` (seperti konfigurasi cetak buku piutang dan invoice).

---

## Catatan Arsitektur & Rekomendasi Pemeliharaan

1. **Sentralisasi Aset di Master Layout**: Master layout `layout.blade.php` memuat hampir seluruh pustaka JS/CSS aplikasi secara global (termasuk mask dan Select2 endpoints untuk semua domain). Keuntungannya adalah halaman page modul menjadi sangat ringkas karena tidak perlu mendefinisikan pustaka ulang, namun payload awal halaman menjadi lebih berat.
2. **Ketergantungan Kuat pada Session**: Baik `layout.blade.php` maupun `sidenavbar.blade.php` sangat bergantung pada variabel session (`usaha_logo`, `usaha_nama_singkat`, `fotopengguna`, `namapengguna`, `user_menus`). Jika sesi hilang atau kosong sebelum redirect terjadi, beberapa bagian elemen visual akan kehilangan data nama/logo.
3. **Penyelarasan Ekstensi Berkas**: Disarankan untuk menstandarkan penamaan seluruh file modal partial dari ekstensi `.php` menjadi `.blade.php` (misal `modalTambahBarang.php` -> `modalTambahBarang.blade.php`) demi konsistensi *syntax highlighting* IDE dan penanganan blade template.
4. **Pembersihan Berkas Cadangan**: Terdapat berkas backup seperti `sidenavbar.blade copy.php`, `login.blade copy.php`, dan `cetakInvoice.blade-2026-03-11.php` di dalam repositori views yang dapat diarsipkan atau dibersihkan pada tahap pemeliharaan kode agar tidak membingungkan pengembang baru.
