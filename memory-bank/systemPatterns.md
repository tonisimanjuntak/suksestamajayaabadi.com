# System Patterns: Sistem Informasi Akuntansi & Distribusi PT. Sukses Tama Jaya Abadi

## Gambaran Arsitektur

Aplikasi menggunakan arsitektur **Monolithic MVC (Model-View-Controller)** klasik berbasis Laravel 10. Karakteristik arsitektur ini meliputi:

1. **Fat Controller / Orchestrator Controller**:
   - Controller menangani sebagian besar alur aplikasi: autentikasi sesi, validasi input manual, perhitungan bisnis (seperti PPN proporsional per item, sisa limit kredit, dan status posting jurnal), pembentukan response JSON untuk DataTables/Select2, serta pembuatan dokumen PDF via TCPDF.
   - Bukti file: `app/Http/Controllers/PenjualanController.php`, `app/Http/Controllers/WilayahController.php`.

2. **Query Builder & Stored Procedure/View Centric (Hybrid Model)**:
   - Model meng-extend `Illuminate\Database\Eloquent\Model`, namun mayoritas data layer tidak mengandalkan ORM Eloquent relationship, melainkan query langsung menggunakan `Illuminate\Support\Facades\DB` (Query Builder dan Raw Queries).
   - Skema database sangat bergantung pada MySQL Views (`v_*`), Stored Functions (misal `create_idwilayah()`, `create_noinvoice()`), dan tabel audit `riwayataktifitas`.
   - Transaksi database dikendalikan secara manual menggunakan `DB::beginTransaction()`, `DB::commit()`, dan `DB::rollBack()`.
   - Bukti file: `app/Models/Wilayah.php`, `app/Models/Penjualan.php`, `db/db.sql`.

3. **Server-Side Rendered Blade dengan Dukungan Ajax / DataTables**:
   - Tampilan menggunakan Blade template yang mengadopsi tema AdminLTE 3.
   - Tabel data memanfaatkan jQuery DataTables dengan pemrosesan *server-side* (paging, filtering, sorting langsung via SQL di controller).
   - Bukti file: `resources/views/wilayah/index.blade.php`, `resources/views/penjualan/form.blade.php`.

---

## Pola yang Digunakan

### Service Layer (jika ada)
- **Status**: Sebagian (Bukan Service Layer Standar, Ditempatkan di Helpers).
- **Penjelasan**: Proyek tidak memiliki direktori arsitektur `app/Services/`. Namun, terdapat 1 implementasi logika bisnis stok yang diisolasi dalam class helper: `StokFifoService`. Class ini mengelola alokasi keluar-masuk stok barang menggunakan metode FIFO (First-In First-Out) di tabel `stokfifo`.
- **Bukti file**:
  - `app/Helpers/StokFifoService.php` (logika transaksi FIFO).
  - `app/Helpers/PpnHelper.php` (logika pembulatan PPN faktur pajak).
  - `app/Helpers/MyHelpers.php` (fungsi utilitas terbilang, format angka `untitik()`, format rupiah).

### Action Classes (jika ada)
- **Status**: Tidak digunakan.
- **Penjelasan**: Tidak terdapat direktori `app/Actions` maupun pemisahan proses single-action (invokable action classes). Seluruh mutasi data ditangani di dalam method Controller atau method Model.

### Repository Pattern (jika ada)
- **Status**: Tidak digunakan.
- **Penjelasan**: Tidak terdapat direktori `app/Repositories`, interfaces repository, maupun binding repository di Service Provider. Akses database dilakukan langsung dari Model atau Controller menggunakan facade `DB` atau model query statis.

### Event & Listener
- **Status**: Tidak digunakan.
- **Penjelasan**: Proyek tidak mendefinisikan custom Event maupun Listener untuk alur bisnis. File konfigurasi event `app/Providers/EventServiceProvider.php` hanya berisi mapping bawaan Laravel (`Registered => SendEmailVerificationNotification`) dengan `shouldDiscoverEvents()` bernilai `false`.
- **Bukti file**: `app/Providers/EventServiceProvider.php`.

### Job & Queue
- **Status**: Tidak digunakan.
- **Penjelasan**: Tidak ada direktori `app/Jobs`. Pengaturan antrean pada `.env.example` diset ke `QUEUE_CONNECTION=sync`. Seluruh proses (perhitungan FIFO, mutasi jurnal, pencatatan audit log, cetak PDF) dieksekusi secara sinkron dalam thread request yang sama.

### Observer
- **Status**: Tidak digunakan.
- **Penjelasan**: Tidak ditemukan model observer di dalam `app/Observers` maupun registrasi observer di `app/Providers/AppServiceProvider.php` atau `EventServiceProvider.php`. Triger aksi sesudah simpan/hapus dijalankan secara imperatif di dalam method Model (misal pencatatan audit log).

### Policy & Authorization
- **Status**: Sebagian (Tidak menggunakan Laravel Policy bawaan; Menggunakan Custom Session Middleware).
- **Penjelasan**: 
  - Laravel Policy (`app/Policies`) tidak digunakan. Array `$policies` pada `app/Providers/AuthServiceProvider.php` dibiarkan kosong.
  - Otorisasi hak akses dikelola secara kustom menggunakan tabel `pengguna_menus` yang disimpan ke sesi saat login (`session('user_menus')`).
  - Pengecekan otorisasi dilakukan oleh middleware kustom `CheckMenuAccess` yang memverifikasi URL controller dan parameter aksi (`tambah`, `edit`, `hapus`) terhadap string `hakaksi`.
  - Pengecekan status login dilakukan di base controller melalui method `isLogin()` yang memeriksa `session('idpengguna')`.
- **Bukti file**:
  - `app/Providers/AuthServiceProvider.php`
  - `app/Http/Middleware/CheckMenuAccess.php`
  - `app/Http/Controllers/Controller.php` (method `isLogin()`)

### Form Request & Validation
- **Status**: Tidak digunakan.
- **Penjelasan**: Tidak ada direktori `app/Http/Requests`. Validasi tidak menggunakan class Form Request terpisah, melainkan dilakukan secara manual/prosedural di dalam method Controller melalui fungsi sanitasi string (misal `untitik()`), pemeriksaan kondisi nilai `empty()`, atau pengecekan aturan bisnis langsung ke database (misal `App::isPosting()`, `Piutang::piutangSudahDibayar()`).
- **Bukti file**: `app/Http/Controllers/PenjualanController.php` (method `simpanData` dan `cekPiutang`).

### Resource / API Response
- **Status**: Tidak digunakan.
- **Penjelasan**: Tidak terdapat Eloquent API Resource di `app/Http/Resources`.
- Pola respon yang digunakan:
  1. **HTML Blade View**: Untuk perenderan halaman (`return view('modul.index', $data)`).
  2. **DataTables JSON**: Struktur JSON manual dengan format `{ draw, recordsTotal, recordsFiltered, data }` (`return response()->json(...)`).
  3. **Ajax Response**: Array JSON berformat `{ status: 'success'|'error', message: '...' }` atau `{ msg: '...' }`.
  4. **PDF Stream**: Menggunakan library TCPDF langsung di Controller (`$pdf->Output(...)`).
- **Bukti file**: `app/Http/Controllers/WilayahController.php`, `app/Http/Controllers/PenjualanController.php`.

---

## Konvensi Penamaan

1. **Controller**:
   - Menggunakan format PascalCase diakhiri akhiran `Controller`.
   - Contoh: `WilayahController`, `PenjualanController`, `LaplabarugiController`, `PembelianpenerimaanController`.
2. **Model**:
   - Menggunakan format PascalCase, sering kali berupa kata tunggal bahasa Indonesia tanpa pemisah spasi/underscore.
   - Contoh: `Wilayah`, `Penjualan`, `Kategoribarang`, `Bonussales`, `Hutangekspedisi`.
3. **Database Tables**:
   - Ditulis dalam huruf kecil (lowercase), umumnya bahasa Indonesia, sebagian menyambung tanpa underscore dan sebagian dengan underscore.
   - Contoh: `wilayah`, `penjualan`, `penjualandetail`, `riwayatstok`, `pengguna_menus`, `postingjurnal`.
4. **Primary Key**:
   - Menggunakan prefix `id` diikuti nama entitas tanpa underscore. Tipe data umumnya berupa string `char`/`varchar` hasil generate stored function.
   - Contoh: `idwilayah`, `idpenjualan`, `idkonsumen`, `idbarang`.
5. **Kolom Database**:
   - Huruf kecil menyambung atau snake_case.
   - Contoh: `namawilayah`, `tglinvoice`, `statusaktif`, `inserted_date`, `updated_date`.
6. **Views & Routing**:
   - Route URL menggunakan huruf kecil kebab/plain: `/wilayah`, `/penjualan`, `/laplabarugi`.
   - File Blade diorganisasi dalam folder sesuai nama modul: `resources/views/wilayah/index.blade.php`, `resources/views/wilayah/form.blade.php`.
7. **Helper Functions**:
   - Fungsi global prosedural menggunakan huruf kecil: `untitik()`, `titik()`, `format_rupiah()`, `terbilang()`, `bulan()`.

---

## Struktur Direktori Penting

```
suksestamajayaabadi.com/
├── app/
│   ├── Helpers/                 # Logika bisnis terisolasi & fungsi utilitas
│   │   ├── StokFifoService.php  # Manajemen FIFO mutasi stok barang
│   │   ├── PpnHelper.php        # Utilitas perhitungan PPN faktur pajak
│   │   ├── MyHelpers.php        # Utilitas konversi teks/angka/format rupiah
│   │   ├── MenusHelper.php      # Utilitas render sidebar menu
│   │   └── ConstantsHelper.php  # Konstanta global aplikasi
│   ├── Http/
│   │   ├── Controllers/         # 60 controller alur aplikasi, DataTables, & PDF
│   │   │   ├── Controller.php   # Base controller dengan middleware isLogin()
│   │   │   ├── LoginController.php
│   │   │   ├── PenjualanController.php
│   │   │   └── ...
│   │   └── Middleware/
│   │       └── CheckMenuAccess.php # Otorisasi dinamis rute berdasarkan menu sesi
│   └── Models/                  # Model pembungkus query DB dan audit log
│       ├── App.php              # Model utilitas (riwayat aktifitas, posting jurnal)
│       ├── Penjualan.php
│       ├── Wilayah.php
│       └── ...
├── config/                      # Konfigurasi bawaan Laravel
├── database/                    # Migrations & seeders default (tidak dipakai untuk skema bisnis)
├── db/
│   └── db.sql                   # Skema DDL/DML, MySQL Views, Stored Functions, & Triggers
├── public/                      # Asset statis, vendor AdminLTE, file unggahan
├── resources/
│   └── views/                   # Template Blade AdminLTE untuk setiap modul
├── routes/
│   ├── web.php                  # Seluruh route web & AJAX aplikasi
│   └── api.php                  # Route API bawaan (Sanctum boilerplate, tidak aktif)
└── memory-bank/                 # Dokumentasi sistem & arsitektur proyek
```

---

## Alur Request (Contoh 1 Endpoint End-to-End)

Sebagai contoh representatif alur transaksi mutasi data, berikut alur endpoint **`POST /penjualan/simpanData`**:

```
[Browser / Ajax Client]
         │ (HTTP POST + Form Data + JSON Detail Barang)
         ▼
[routes/web.php]
         │ Dilindungi Route::middleware(['check.menu.access'])
         ▼
[CheckMenuAccess Middleware] (app/Http/Middleware/CheckMenuAccess.php)
         │ 1. Mengecek segment URL ('penjualan') dan aksi ('simpanData').
         │ 2. Memvalidasi kecocokan dengan session('user_menus').
         ▼
[Base Controller isLogin()] (app/Http/Controllers/Controller.php)
         │ Memvalidasi keberadaan session('idpengguna').
         ▼
[PenjualanController@simpanData] (app/Http/Controllers/PenjualanController.php)
         │ 1. Mengambil parameter input: $request->get(...).
         │ 2. Sanitasi angka pemisah ribuan menggunakan helper untitik().
         │ 3. Pengecekan aturan posting jurnal: App::isPosting($tglinvoice).
         │ 4. Jika tambah data: Generate ID melalui $this->model->createID() (Stored Function).
         │ 5. Iterasi detail barang dan hitung alokasi PPN proporsional via PpnHelper::roundPPN().
         ▼
[Penjualan Model simpanData()] (app/Models/Penjualan.php)
         │ 1. Membuka transaksi database: DB::beginTransaction().
         │ 2. Menyimpan data header penjualan: DB::table('penjualan')->insert($data).
         │ 3. Menyimpan detail barang: DB::table('penjualandetail')->insert($dataDetail).
         │ 4. Menjalankan mutasi stok & alokasi lapisan FIFO:
         │    - StokFifoService->barangKeluar(...) (app/Helpers/StokFifoService.php)
         │    - Update saldo stok barang: DB::table('barang')->update(...).
         │    - Pencatatan riwayat stok: DB::table('riwayatstok')->insert(...).
         │ 5. Jika pembayaran bukan piutang: Terbitkan data kwitansi kasir.
         │ 6. Pencatatan audit trail aktifitas pengguna:
         │    - App::riwayatAktifitas(...) (app/Models/App.php -> DB::table('riwayataktifitas')).
         │ 7. Mengonfirmasi transaksi: DB::commit() (atau DB::rollBack() jika terjadi QueryException).
         ▼
[JSON Response]
         └── Mengembalikan array status: { status: 'success', message: 'Data berhasil disimpan' }
```

---

## Keputusan Arsitektur & Alasan

1. **Penggunaan Direct Query Builder (`DB::table`) dibanding Eloquent ORM Murni**:
   - *Alasan*: Aplikasi menangani transaksi distribusi bervolume tinggi dengan tabel-tabel transaksi multi-kolom yang memerlukan performa kueri optimal, join langsung ke MySQL Views, dan manipulasi data masif tanpa overhead hidrasi model Eloquent.
2. **Sentralisasi Skema di `db/db.sql` dibanding Laravel Migrations**:
   - *Alasan*: Database menggunakan puluhan MySQL Views (`v_penjualan`, `v_persediaan`, dll.) dan Stored Functions untuk auto-numbering/ID generator. Pendekatan ini mempertahankan integritas basis data legacy yang sudah teruji.
3. **Otorisasi Berbasis Menu Dinamis di Sesi**:
   - *Alasan*: Hak akses pengguna dikelola secara hierarkis (Menu -> Sub-menu -> Hak Aksi Tambah/Edit/Hapus) langsung dari database oleh administrator via menu pengaturan pengguna, tanpa perlu mengubah kode policy di aplikasi.
4. **Pencatatan Audit Trail Tersentralisasi (`App::riwayatAktifitas`)**:
   - *Alasan*: Setiap operasi perubahan data (simpan, update, hapus) di setiap modul ERP otomatis direkam ke tabel `riwayataktifitas` beserta snapshot data JSON, ID pengguna, dan nama fungsi untuk kebutuhan jejak audit akuntansi.
5. **Penggunaan Enkripsi ID pada URL (`Crypt::encrypt` / `Crypt::decrypt`)**:
   - *Alasan*: Parameter URL untuk edit/hapus dienkripsi untuk mencegah manipulasi ID secara sekuensial (pencegahan ID enumeration / IDOR primitif) pada interface browser.

---

## Anti-Pattern yang Dihindari

1. **Manipulasi Data Tanpa Transaksi (Non-Atomic Writes)**:
   - Dihindari dengan mewajibkan `DB::beginTransaction()`, `DB::commit()`, dan `DB::rollBack()` di dalam blok `try-catch` pada setiap operasi yang melibatkan multi-tabel (header transaksi, detail, kartu stok, dan riwayat mutasi).
2. **Perhitungan Bisnis di Dalam Blade Template**:
   - Dihindari dengan memastikan perhitungan nilai DPP, PPN proporsional, diskon, dan subtotal diselesaikan di Controller/Helper sebelum data dikirim ke view atau disimpan ke basis data.
3. **Hardcoding Tarif & Konfigurasi Usaha**:
   - Dihindari dengan menyimpan parameter usaha (nama toko, persentase PPN penjualan/pembelian, logo) ke tabel `pengaturan` yang dimuat ke dalam sesi pengguna saat login.
   - *Catatan Transisi*: Pada sebagian cetakan invoice lama, nilai legacy `NAMAUSAHA = 'PT. INTRAHUSADA'` di `app/Helpers/ConstantsHelper.php` masih dipanggil langsung sebelum migrasi penuh ke tabel `pengaturan`.
4. **Pembaruan Jurnal pada Periode Tertutup**:
   - Dihindari dengan pengecekan `App::isPosting($tanggal)`. Jika periode pembukuan bulan/tahun bersangkutan sudah ditutup (di-posting), Controller secara ketat menolak operasi edit maupun hapus transaksi.
