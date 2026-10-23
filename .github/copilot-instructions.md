# Copilot Instructions

Sebelum memulai tugas apapun, **SELALU** baca file-file di folder `memory-bank/` terlebih dahulu untuk memahami konteks proyek:
- Tujuan proyek (`projectbrief.md`)
- Kenapa produk ini ada (`productContext.md`)
- Stack teknis (`techContext.md`)
- Pola arsitektur (`systemPatterns.md`)
- Status terkini (`progress.md`, `activeContext.md`)
- Helper References (`helpers.md`)
- Template structure (`template-structure.md`)

Gunakan informasi di dalamnya sebagai pedoman utama.

### Pengecualian Khusus TCPDF (Hemat Token):
- File `memory-bank/tcpdf-context.md` (serta konteks pustaka `tecnickcom/tcpdf`) **HANYA** dimuat saat membuat atau mengedit/memperbaiki laporan PDF.
- Jika tugas atau perbaikan yang dikerjakan **BUKAN** membuat atau mengedit laporan PDF (misal: CRUD, auth, UI web, database, config, routing umum), maka `memory-bank/tcpdf-context.md` dan konteks `tecnickcom/tcpdf` **TIDAK PERLU DIMUAT** agar menghemat token.

---

## 1. Build, Test, and Lint Commands

### Testing (PHPUnit 10)
- **Run all tests**: `php artisan test` or `vendor/bin/phpunit`
- **Run a single test file**: `php artisan test tests/Unit/ExampleTest.php` or `vendor/bin/phpunit tests/Unit/ExampleTest.php`
- **Run a specific test method**: `php artisan test --filter test_method_name` or `vendor/bin/phpunit --filter test_method_name`

### Linting & Formatting (Laravel Pint)
- **Check code style (dry run)**: `vendor/bin/pint --test`
- **Auto-fix code style**: `vendor/bin/pint`
- **Format a single file or directory**: `vendor/bin/pint app/Http/Controllers/PenjualanController.php`

### Frontend & Assets (Vite)
- **Dev asset watcher**: `npm run dev`
- **Production asset build**: `npm run build`
*(Note: Core AdminLTE 3.2, jQuery, DataTables, and plugin assets are pre-bundled in `public/assets/` and loaded directly via `asset()`)*

### Application & Cache Operations
- **Clear application cache**: `php artisan cache:clear`
- **Clear route cache**: `php artisan route:clear`
- **Clear view/blade cache**: `php artisan view:clear`
- **Clear config cache**: `php artisan config:clear`

---

## 2. High-Level Architecture

### Architecture Overview
The application is a **Monolithic MVC** ERP distribution system built on **Laravel 10** with **AdminLTE 3.2** (Bootstrap 4, jQuery, DataTables). It handles the full distribution pipeline: purchasing, goods receipt, delivery orders (surat jalan), sales invoicing, accounts payable/receivable, cash/bank, inventory with FIFO valuation, and general ledger / financial reporting.

### Authentication & Authorization
- **Custom Session Authentication**: Does not use standard Laravel `auth:web` or `auth:sanctum` guards. Authentication is maintained via `session('idpengguna')`. Base controller `Controller::isLogin()` enforces session existence.
- **Granular RBAC (`CheckMenuAccess` Middleware)**: Access is dynamically validated against `session('user_menus')` mapped from the `pengguna_menus` table. Actions (`tambah`, `edit`, `hapus`) are validated against the `hakaksi` permission string. Developer bypass exists for `session('idpengguna') == '9999999999'`.
- **Company Configuration in Session**: General business parameters (company name, logo, default VAT) are loaded into the user session upon login from the `pengaturan` table (e.g. `session('usaha_nama_singkat')`, `session('usaha_logo')`).

### Database Layer & Data Access
- **No Laravel Migrations for Business Tables**: Business schema, views, and functions are managed via MySQL SQL dumps in `db/db.sql`. Never generate migrations for core business tables.
- **Hybrid Data Layer (Query Builder + MySQL Views & Stored Functions)**:
  - Models extend `Illuminate\Database\Eloquent\Model`, but data operations primarily use `Illuminate\Support\Facades\DB` (`DB::table(...)` and raw queries) instead of Eloquent ORM relationships.
  - Read queries and DataTables server-side feeds typically bind to MySQL Views (prefixed with `v_`, e.g., `v_penjualan`, `v_persediaan`, `v_suratjalan`).
  - Primary key IDs and sequential document numbers are generated via MySQL Stored Functions (e.g., `SELECT create_idkonsumen() AS id`, `create_noinvoice()`, `create_idpiutang()`, `create_idhutangekspedisi()`).
- **Explicit Transactions & Audit Trail**:
  - All multi-table mutations must be wrapped in `DB::beginTransaction()`, `DB::commit()`, and `DB::rollBack()` inside `try-catch` blocks.
  - Every create/update/delete operation must record an audit entry using `$this->App->riwayatAktifitas($data, $namatabel, $namafunction)` into the `riwayataktifitas` table.
- **Accounting Closing Lock**: Transactions must check `App::isPosting($tanggal)`. If the period has been closed/posted in `postingjurnal`, updates or deletions must be rejected.

### Inventory & FIFO Stock Flow (`stok_penjualan_dari_surat_jalan = 1`)
- **Important Setting**: The application operates with `stok_penjualan_dari_surat_jalan = 1`.
  - **Sales Invoice (`penjualan`)**: Does **NOT** deduct physical stock or consume FIFO layers.
  - **Delivery Order (`suratjalan`)**: **DEDUCTS** physical stock (`riwayatstok`) and consumes FIFO layers (`stokfifodetail`) via `App\Helpers\StokFifoService::barangKeluar()`.
- **Stock Inflow**: Goods receipt (`pembelianpenerimaan`), sales return (`returpenjualan`), conversion output (`konversistok`), and surplus stock opname create new FIFO layers via `StokFifoService::barangMasuk()` into `stokfifo`.
- **Cancellations/Rollbacks**: Edits or deletions of outflow transactions must restore layer balances via `StokFifoService::batalBarangKeluar()`.

---

## 3. Key Conventions

### Database & Identifier Naming
- **Primary Keys**: Char/varchar format, lowercased without underscores (e.g., `idpenjualan`, `idkonsumen`, `idwilayah`, `idbarang`). Generated by stored functions, not auto-incrementing integers.
- **Table Names**: Lowercased Indonesian words, often concatenated without underscores (e.g., `penjualandetail`, `riwayatstok`, `postingjurnal`, `hutangdetail`).
- **Views**: Always prefixed with `v_` (e.g., `v_penjualan`, `v_riwayatstok`).

### Controller & View Conventions
- **Controllers**: Located in `app/Http/Controllers/`, named in PascalCase ending with `Controller` (e.g., `PenjualanController`, `LaphppbarangController`).
- **Encrypted URL Parameters**: Sensitive route parameters (such as IDs in edit/delete URLs) must be encrypted using `Crypt::encrypt()` and decrypted with `Crypt::decrypt()`.
- **Blade Layout Structure**:
  - All operational views inherit from `@extends('template/layout')` with `@section('content')` and `@section('scripts')`.
  - Do not use Blade component syntax (`<x-...>`) or `@push`/`@stack`.
  - Modal partials are included inside `@section('scripts')` (e.g., `@include('penjualan/modalTambahBarang')`). Note: Some modal files have `.php` or `.blade.php` extensions and may be reused across multiple modules.
  - Standalone Views: Print layouts (`cetak*.blade.php`) and authentication (`login.blade.php`) do not extend `template/layout`.

### Number, Currency & Data Sanitization Helpers
- **Input Sanitization**: User inputs formatted with thousand separators (e.g., `"1,500,000"`) **MUST** be sanitized using the global helper `untitik($value)` before arithmetic calculation or database storage.
- **VAT / PPN Rounding**: Proportional VAT calculation per item line must use `App\Helpers\PpnHelper::roundPPN($value)` to prevent penny discrepancies against invoice headers.
- **Date Formatting**: Use `tglymd($date)` for database input (`Y-m-d`), `tgldmy($date)` for display (`d-m-Y`), and `tglindonesia($date)` for formal Indonesian date formatting on print layouts.
- **Currency Display**: Use `format_rupiah($nominal)` for comma-separated display and `terbilang($nominal, $style)` for spelling out figures on invoices and receipts.

### Update Logging Convention
- Update records must be logged to `public/logupdate.txt` using the format:
  `[YYYY-MM-DD] [kategori] Module - Deskripsi`
  Valid categories: `[feature]`, `[customize]`, `[bugfix]`, `[update]`. See `.github/copilot/skills/addUpdateLog.md` for full details.


