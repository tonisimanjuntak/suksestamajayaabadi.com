---
description: Catat update aplikasi dari git log dan uncommitted changes ke public/logupdate.txt dengan format yang sudah ada
---

# addUpdateLog Skill

Skill ini mencatat perubahan/update aplikasi dari git log (committed) dan uncommitted changes ke file `public/logupdate.txt`.

## Cara Kerja (Hybrid Approach)

### Phase 1: Committed Changes
1. Baca file `public/logupdate.txt` untuk ambil tanggal terakhir yang dicatat
2. Ambil git log dari tanggal setelah tanggal terakhir sampai hari ini
3. Parse commit message dengan format: `[kategori] module - deskripsi`
4. Tulis ke `public/logupdate.txt` dengan format:
   ```
   [YYYY-MM-DD] [kategori] Module - Deskripsi
   ```

### Phase 2: Uncommitted Changes (Work in Progress)
1. Check git status untuk detect staged/unstaged changes
2. Jika ada perubahan uncommitted:
   - Ambil list file yang berubah dengan `git diff --name-only` dan `git diff --cached --name-only`
   - Analyze diff untuk file-file penting (Controller, Model, View, Service, Migration, Config)
   - Buat deskripsi ringkas perubahan berdasarkan diff analysis
   - **Tanya konfirmasi user** sebelum tambahkan ke log (karena bisa work-in-progress)
3. Jika user approve, tambahkan entry dengan tanggal hari ini

## Format Entry

Format yang digunakan di logupdate.txt:
```
[YYYY-MM-DD] [kategori] Module - Deskripsi perubahan
```

Kategori yang valid:
- `[feature]` - Fitur baru
- `[customize]` - Kustomisasi/perubahan fitur existing
- `[bugfix]` - Perbaikan bug
- `[update]` - Update umum

## Algoritma

```plaintext
=== PHASE 1: COMMITTED CHANGES ===
1. Baca public/logupdate.txt
2. Cari tanggal terakhir di file (format [YYYY-MM-DD])
3. Git log --since="tanggal_setelah_terakhir" --pretty=format:"%ad | %s" --date=short
4. Parse setiap commit:
   - Ambil tanggal dari %ad (format YYYY-MM-DD)
   - Parse commit message %s
   - Deteksi kategori dari commit message atau set default [update]
   - Format: [tanggal] [kategori] Commit message
5. Append ke public/logupdate.txt (dengan baris kosong sebelumnya jika perlu)

=== PHASE 2: UNCOMMITTED CHANGES ===
6. Check git status:
   - git diff --name-only (unstaged)
   - git diff --cached --name-only (staged)
7. Jika ada file berubah:
   a. Filter file penting: app/, resources/views/, database/, config/, routes/
   b. Untuk setiap file penting, ambil diff: git diff HEAD <file>
   c. Analyze diff dan buat deskripsi:
      - Controller: deteksi method baru, perubahan logic, route baru
      - Model/Service: perubahan business logic, query, function baru
      - View: perubahan UI, form baru
      - Migration: perubahan schema database
      - Config: perubahan setting
   d. Kelompokkan per module (misal: Pembelian, Penjualan, Laporan, etc)
   e. Buat summary: "[kategori] Module - deskripsi ringkas"
8. Tampilkan preview uncommitted changes yang terdeteksi
9. Tanya user: "Tambahkan perubahan uncommitted ini ke log update?"
10. Jika yes, append dengan tanggal hari ini

=== OUTPUT ===
11. Tampilkan semua entry yang ditambahkan (committed + uncommitted jika approved)
```

## Contoh Penggunaan

User: "Update log dari git"
User: "Catat update terbaru"
User: "Tambah log update"

## Contoh Output

### Committed Changes
```
[2026-09-23] [update] Update ppnproporsional
[2026-09-24] [update] Update Pembelian Penerimaan
[2026-10-07] [update] Update stokfifoservice untuk menghitung nilai hpp
[2026-10-08] [update] Update db.sql
[2026-10-09] [customize] Add agent copilot instruction
```

### Uncommitted Changes (After Analysis)
```
Uncommitted changes terdeteksi:

1. [feature] Laporan Stok FIFO - Tambah controller dan view laporan stok dengan metode FIFO
2. [bugfix] Stock Opname - Fix perhitungan selisih stok saat input stock opname
3. [update] Stok FIFO Service - Update logic perhitungan HPP per item

Tambahkan ke log update? (y/n)
```

## Deteksi Kategori Otomatis

Skill akan auto-detect kategori dari:

**Commit message keywords:**
- `fix`, `bugfix`, `bug`, `perbaikan` → `[bugfix]`
- `feat`, `feature`, `fitur`, `add` → `[feature]`
- `customize`, `custom`, `ubah`, `modif` → `[customize]`
- Default → `[update]`

**Uncommitted diff analysis:**
- Method baru, class baru, route baru → `[feature]`
- Fix kondisi, fix calculation, exception handling → `[bugfix]`
- Perubahan existing method/logic → `[update]`
- Perubahan UI/form berdasarkan requirement → `[customize]`

## File Priority untuk Analysis

Skill fokus analyze file penting:
1. **High priority:** `app/Http/Controllers/`, `app/Services/`, `app/Models/`
2. **Medium priority:** `resources/views/`, `routes/`, `database/migrations/`
3. **Low priority:** `config/`, `public/`
4. **Ignore:** `vendor/`, `node_modules/`, `storage/`, `.env`, `composer.lock`

## Catatan

- Entry committed langsung ditambahkan tanpa konfirmasi (sudah final)
- Entry uncommitted butuh konfirmasi (bisa work-in-progress)
- Entry diurutkan berdasarkan tanggal ascending
- Tambahkan baris kosong sebelum entry pertama jika file tidak kosong
- Maksimal 3-5 baris deskripsi per uncommitted change untuk tetap ringkas
