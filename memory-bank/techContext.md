# Tech Context: Sukses Tama Jaya Abadi — Sistem ERP Distribusi

## Bahasa & Framework
- **Bahasa Pemrograman**: PHP (`^8.1`), JavaScript (ES Module)
- **Framework Backend**: Laravel Framework `v10.48.14`
- **Template Engine**: Blade Templating Engine
- **Frontend Assets**: AdminLTE 3.2 (disimpan di `public/assets/AdminLTE32`), Bootstrap 4, jQuery, DataTables, FontAwesome

## Versi Runtime (PHP, Node, Composer)
- **PHP**: `^8.1` (tercatat di `composer.json` & terkunci di `composer.lock`)
- **Node.js**: Opsional / hanya untuk build asset Vite (runtime utama aplikasi murni PHP + aset statis di `public/assets/`)
- **Composer**: 2.8.10
- **MySQL**: 8.0.30 (default laragon)

## PHP Extensions Wajib
Tidak ada deklarasi langsung `ext-*` di `composer.json` level root (mengandalkan ekstensi bawaan PHP dan dependensi paket Laravel/TCPDF seperti `ext-ctype`, `ext-curl`, `ext-dom`, `ext-fileinfo`, `ext-filter`, `ext-hash`, `ext-json`, `ext-libxml`, `ext-mbstring`, `ext-openssl`, `ext-pcre`, `ext-pdo`, `ext-session`, `ext-tokenizer`).

## Database & Storage
- **Database Engine**: MySQL
  - Koneksi default: `mysql` (`config/database.php`)
  - Charset & Collation: `utf8mb4` / `utf8mb4_unicode_ci`
  - Port default: `3306`
  - Fitur Native: Menggunakan MySQL Views (prefix `v_`) dan MySQL Stored Functions (misal `create_idbank`, `create_idkonsumen`)
  - Skema Bisnis: Dikelola via manual SQL dump di `db/db.sql` (bukan Laravel Migrations)
- **Session Storage**: Driver `file` (default lifetime 120 menit)
- **Cache Storage**: Driver `file`
- **Queue Connection**: Driver `sync`
- **Filesystem**: Disk `local` (`storage/app`)

## Paket Utama (Composer)
- `laravel/framework`: `v10.48.14` (core framework)
- `tecnickcom/tcpdf`: `6.7.5` (generator cetak laporan dokumen PDF)
- `guzzlehttp/guzzle`: `7.8.1` (HTTP client)
- `laravel/sanctum`: `v3.3.3` (token authentication guard)
- `laravel/tinker`: `v2.9.0` (REPL console)

## Paket Frontend (npm)
- *Catatan*: Dependensi UI utama (AdminLTE 3.2, jQuery, DataTables, Select2, SweetAlert2, CKEditor) disertakan secara manual di direktori `public/assets/`, tidak dikelola via npm.

## Testing Framework
- **Test Runner**: PHPUnit `10.5.24` (`phpunit.xml`)
- **Mocking Library**: Mockery `1.6.12`
- **Test Suites**:
  - `Unit` (`tests/Unit`)
  - `Feature` (`tests/Feature`)
- **Testing Environment**:
  - `APP_ENV=testing`
  - In-memory array cache, session, dan mail driver

## Tooling (lint, formatter, static analysis)
- **Code Formatter / Linter**: `laravel/pint` (`v1.16.1`)
- **Error Page & Debugging**: `spatie/laravel-ignition` (`2.8.0`), `nunomaduro/collision` (`v7.10.0`)
- **Static Analysis**: Tidak ada. Tidak dikonfigurasi dan tidak ada rencana.

## CI/CD
- Tidak ada. Deployment masih manual (upload via FTP / git pull di server / Laragon lokal).
- Tidak ada rencana untuk menambah CI/CD dalam waktu dekat.

## Environment Variables Penting (nama saja)
- **Aplikasi**:
  - `APP_NAME`
  - `APP_ENV`
  - `APP_KEY`
  - `APP_DEBUG`
  - `APP_URL`
- **Logging**:
  - `LOG_CHANNEL`
  - `LOG_DEPRECATIONS_CHANNEL`
  - `LOG_LEVEL`
- **Database**:
  - `DB_CONNECTION`S
  - `DB_HOST`
  - `DB_PORT`
  - `DB_DATABASE`
  - `DB_USERNAME`
  - `DB_PASSWORD`
- **Drivers & Services**:
  - `BROADCAST_DRIVER`
  - `CACHE_DRIVER`
  - `FILESYSTEM_DISK`
  - `QUEUE_CONNECTION`
  - `SESSION_DRIVER`
  - `SESSION_LIFETIME`
- **Email**:
  - `MAIL_MAILER`
  - `MAIL_HOST`
  - `MAIL_PORT`
  - `MAIL_USERNAME`
  - `MAIL_PASSWORD`
  - `MAIL_ENCRYPTION`
  - `MAIL_FROM_ADDRESS`
  - `MAIL_FROM_NAME`
- **Vite / Frontend**:
  - `VITE_APP_NAME`

## Cara Menjalankan Proyek (dev, test, build)
1. **Instalasi Dependensi**:
   - Backend: `composer install`
   - Frontend: `npm install`
2. **Setup Environment & Key**:
   - Salin env: `cp .env.example .env`
   - Generate key: `php artisan key:generate`
3. **Setup Database**:
   - Buat database MySQL
   - Import manual dump database dari `db/db.sql`
4. **Development Server**:
   - PHP/Laravel: `php artisan serve` (atau via virtual host Laragon)
   - Vite Asset Watcher: `npm run dev`
5. **Production Build Frontend**:
   - `npm run build`
6. **Menjalankan Testing**:
   - `php artisan test` atau `vendor/bin/phpunit`
7. **Format Kode**:
   - `vendor/bin/pint`

## Deployment
- proses deployment dilakukan manual ke server web hosting/VPS dengan stack PHP 8.1+ dan MySQL.

## Batasan Teknis / Known Constraints
1. **Skema Database Manual**: Skema bisnis tidak menggunakan Laravel Migrations; perubahan database harus diatur manual di MySQL dan dicatat di repositori.
2. **Keterikatan MySQL Views & Stored Functions**: Kode bergantung pada stored functions (`create_idbank`, dll.) dan view database MySQL, sehingga tidak kompatibel langsung dengan DB engine lain seperti PostgreSQL atau SQLite.
3. **Query Builder vs Eloquent**: Model didominasi pemanggilan query builder (`DB::table`) dan raw queries ketimbang relasi Eloquent murni.
4. **Custom Session Auth**: Autentikasi tidak memakai standar Laravel Auth guard, melainkan session manual (`session('idpengguna')`).
5. **Aset UI Terbundel Manual**: Sebagian besar pustaka CSS/JS frontend tidak dikelola oleh package manager, melainkan file statis di `public/assets/`.
