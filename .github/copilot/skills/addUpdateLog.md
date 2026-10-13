---
description: Catat update aplikasi dari git log ke public/logupdate.txt dengan format yang sudah ada
---

# addUpdateLog Skill

Skill ini mencatat perubahan/update aplikasi dari git log ke file `public/logupdate.txt`.

## Cara Kerja

1. Baca file `public/logupdate.txt` untuk ambil tanggal terakhir yang dicatat
2. Ambil git log dari tanggal setelah tanggal terakhir sampai hari ini
3. Parse commit message dengan format: `[kategori] module - deskripsi`
4. Tulis ke `public/logupdate.txt` dengan format:
   ```
   [YYYY-MM-DD] [kategori] Module - Deskripsi
   ```

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
1. Baca public/logupdate.txt
2. Cari tanggal terakhir di file (format [YYYY-MM-DD])
3. Git log --since="tanggal_setelah_terakhir" --pretty=format:"%ad | %s" --date=short
4. Parse setiap commit:
   - Ambil tanggal dari %ad (format YYYY-MM-DD)
   - Parse commit message %s
   - Deteksi kategori dari commit message atau set default [update]
   - Format: [tanggal] [kategori] Commit message
5. Append ke public/logupdate.txt (dengan baris kosong sebelumnya jika perlu)
6. Tampilkan entry yang ditambahkan
```

## Contoh Penggunaan

User: "Update log dari git"
User: "Catat update terbaru"
User: "Tambah log update"

## Contoh Output

```
[2026-09-23] [update] Update ppnproporsional
[2026-09-24] [update] Update Pembelian Penerimaan
[2026-10-07] [update] Update stokfifoservice untuk menghitung nilai hpp
[2026-10-08] [update] Update db.sql
[2026-10-09] [customize] Add agent copilot instruction
```

## Catatan

- Jika commit message sudah punya prefix kategori seperti "fix:", "feat:", otomatis map ke kategori yang sesuai
- Jika tidak ada prefix, default gunakan `[update]`
- Entry diurutkan berdasarkan tanggal ascending
- Tambahkan baris kosong sebelum entry pertama jika file tidak kosong
