# Helpers Reference

Terakhir diperbarui: 2026-10-09  
Total fungsi: 26 (21 fungsi global + 5 fungsi/metode helper class)

## Ringkasan per File
| File | Jumlah Fungsi | Keterangan |
|------|---------------|------------|
| `app/Helpers/ConstantsHelper.php` | 0 | File pendefinisian 4 konstanta global (tanpa fungsi) |
| `app/Helpers/MenusHelper.php` | 1 | Fungsi helper perenderan navigasi sidebar AdminLTE |
| `app/Helpers/MyHelpers.php` | 20 | Fungsi utilitas global (tanggal, angka, teks, terbilang) |
| `app/Helpers/PpnHelper.php` | 1 | Helper class pembulatan PPN faktur pajak |
| `app/Helpers/StokFifoService.php` | 4 | Service helper mutasi stok FIFO & kalkulasi HPP |

---

## Daftar Fungsi

### app/Helpers/ConstantsHelper.php
Deskripsi file: Mendefinisikan konstanta-konstanta global sistem seperti nama usaha, icon aplikasi, dan identifier otorisasi pengguna legacy.

*Catatan: File ini tidak memiliki fungsi callable, melainkan 4 konstanta global PHP via `define()`.*

| Nama Konstanta | Nilai | Deskripsi | Dipakai Di | Status |
|----------------|-------|-----------|------------|--------|
| `NAMAUSAHA` | `'PT. Suksestama Jaya Abadi'` | Nama identitas usaha legacy untuk header/cetakan | - | [TIDAK DIPAKAI] (digantikan tabel `pengaturan` di session) |
| `APPICON` | `'logo.png'` | Nama file gambar ikon aplikasi | - | [TIDAK DIPAKAI] |
| `IDOTORISASIKASIR` | `'KL001'` | Kode level otorisasi kasir legacy | `app/Http/Controllers/PenggunaController.php:343` | Deprecated (otorisasi kini via `pengguna_menus`) |
| `IDOTORISASIADMIN` | `'AA001'` | Kode level otorisasi admin | - | [TIDAK DIPAKAI] |

---

### app/Helpers/MenusHelper.php
Deskripsi file: Berisi fungsi perenderan markup navigasi menu sidebar AdminLTE berdasarkan data otorisasi menu dan path URL controller aktif.

| Nama Fungsi | Parameter | Return | Deskripsi | Dipakai Di | Status |
|-------------|-----------|--------|-----------|------------|--------|
| `generateLink` | `$dataMenus: array, $controllerPath: string` | `void` | Menghasilkan elemen `<li>` link navigasi sidebar AdminLTE dengan penanda class `active`. | `resources/views/template/sidenavbar.blade.php:90, 94, 101` | Aktif |

#### Detail: `generateLink`
- **Signature**: `function generateLink($dataMenus, $controllerPath): void` (baris 2–24)
- **Tujuan**: Merender tag HTML navigasi sidebar secara dinamis dengan mencocokkan URL menu terhadap controller yang sedang diakses.
- **Parameter**:
  - `$dataMenus` (array) — Data baris menu dari database/sesi (memiliki atribut `urlmenus`, `iconmenus`, `menus`).
  - `$controllerPath` (string) — Segment path URL controller yang aktif untuk mengecek status link aktif.
- **Return**: `void` (melakukan output HTML langsung via `echo`).
- **Contoh Pemakaian**:
  ```php
  // resources/views/template/sidenavbar.blade.php:94
  {!! generateLink($menuLevel1, $controller) !!}
  ```

---

### app/Helpers/MyHelpers.php
Deskripsi file: Kumpulan fungsi pembantu global untuk konversi terbilang bahasa Indonesia, formatting tanggal lokal, sanitasi angka/mata uang, manipulasi string, dan kalkulasi umur piutang.

| Nama Fungsi | Parameter | Return | Deskripsi | Dipakai Di | Status |
|-------------|-----------|--------|-----------|------------|--------|
| `kekata` | `$x: int\|float\|string` | `string` | Mengonversi angka menjadi ejaan kata bahasa Indonesia secara rekursif hingga level triliun. | Internal `app/Helpers/MyHelpers.php:19, 21, 23, 25, 27, 29, 31, 33, 49, 51` | Aktif (Internal Helper) |
| `terbilang` | `$x: int\|float\|string, $style: int = 0` | `string` | Menghasilkan kalimat terbilang dengan format huruf tertentu untuk cetakan faktur dan kwitansi. | `resources/views/penjualan/cetakInvoice.blade.php`, `resources/views/penjualan/cetakKwitansi.blade.php`, `resources/views/returpenjualan/cetak.blade.php`, `resources/views/suratjalan/cetaksuratjalan_temp.blade.php` | Aktif |
| `bulan` | `$id_bulan: string\|int` | `string` | Mengonversi indeks bulan (1–12) menjadi nama bulan lengkap bahasa Indonesia (Januari–Desember). | `app/Models/App.php:33`, `app/Models/Postingjurnal.php:38`, `app/Http/Controllers/PenjualanController.php`, 14+ controller lainnya | Aktif |
| `hari` | `$date: string` | `string` | Mengonversi tanggal ke nama hari bahasa Indonesia (Senin–Minggu). | - | [TIDAK DIPAKAI] |
| `tglindonesialengkap` | `$tanggal: string\|null` | `string` | Mengubah tanggal `Y-m-d` menjadi format teks Indonesia panjang (`d [BulanPenuh] Y`). | - | [TIDAK DIPAKAI] |
| `tglindonesia` | `$tanggal: string\|null` | `string` | Mengubah tanggal `Y-m-d` menjadi format teks Indonesia dengan singkatan bulan (`d [BlnSingkat] Y`). | `app/Http/Controllers/PenjualanController.php`, 28+ template cetak di `resources/views/` | Aktif |
| `tgldatetime` | `$tanggal: string\|null` | `string` | Memformat timestamp menjadi format tanggal dan jam `d-m-Y H:i:s`. | `app/Http/Controllers/KartustokbarangController.php`, `resources/views/stockopname/cetakSO.blade.php`, `resources/views/piutang/detail.blade.php` | Aktif |
| `tgldmy` | `$tanggal: string` | `string` | Mengubah tanggal ke format standar Indonesia `d-m-Y`. | 14 controller (`PembelianController.php`, `PenjualanController.php`, dll.) dan 21 file views | Aktif |
| `tglymd` | `$tanggal: string` | `string` | Mengubah tanggal ke format database `Y-m-d`. | `app/Http/Controllers/SalesController.php:333` | Aktif |
| `selisihHari` | `$date1: string, $date2: string` | `int` | Menghitung selisih jumlah hari antara dua tanggal. | - | [TIDAK DIPAKAI] |
| `numberformat_indonesia` | `$nNumber: float\|int\|string` | `string` | Memformat angka dengan pemisah ribuan koma tanpa desimal. | - | [TIDAK DIPAKAI] |
| `format_decimal` | `$nNumber: float\|int\|string, $nDecimal: int = 2` | `string` | Memformat angka desimal dengan precision tertentu dan pemisah ribuan koma. | `app/Http/Controllers/KartustokbarangController.php`, `app/Http/Controllers/HutangekspedisiController.php`, `resources/views/kartustokbarang/cetak.blade.php` | Aktif |
| `replwzero` | `$value: int\|string, $jumlahchar: int` | `string` | Menambahkan padding angka nol (`0`) di depan string angka hingga batas panjang tertentu. | - | [TIDAK DIPAKAI] |
| `get_saldo_normal` | `$kdakun: string` | `string` | Menentukan posisi saldo normal akun ('D' untuk awalan 1 & 5, 'K' untuk lainnya). | `app/Models/Lapbukubesar.php:79`, `app/Http/Controllers/LapbukubesarController.php:121` | Aktif |
| `format_rupiah` | `$jumlah: float\|int\|string` | `string` | Memformat nominal rupiah dengan pemisah ribuan koma. | 22 controller dan 50 file views | Aktif |
| `untitik` | `$jumlah: string\|int\|float` | `string` | Menghapus karakter pemisah koma (`,`) dari input angka yang diformat mask ribuan. | 20 controller dan 22 file views form input | Aktif |
| `cutstring` | `$string: string, $jumlah: int` | `string` | Memotong string dari awal sebanyak karakter yang ditentukan. | - | [TIDAK DIPAKAI] |
| `untitikakun` | `$akun: string` | `string` | Menghapus karakter titik (`.`) dari kode akun akuntansi. | - | [TIDAK DIPAKAI] |
| `since` | `$timestamp: string` | `string` | Mengonversi timestamp ke teks relatif rentang waktu bahasa Indonesia ("X menit yang lalu", dll.). | `app/Http/Controllers/PenggunaController.php:142` | Aktif |
| `hitungUmurPiutang` | `$tglPiutang: Carbon\|string, $tglHitung: Carbon\|string\|null = null` | `int` | Menghitung jumlah hari umur faktur piutang terhadap tanggal cut-off menggunakan Carbon. | `resources/views/lappenjualan/cetakbytgl.blade.php`, `resources/views/lappenjualan/cetakbysales.blade.php`, `resources/views/lappenjualandetail/cetakbytgl.blade.php` | Aktif |

---

#### Detail: `kekata`
- **Signature**: `function kekata($x): string` (baris 5–36)
- **Tujuan**: Mengeja angka nominal menjadi kata-kata bahasa Indonesia secara rekursif hingga satuan triliun.
- **Parameter**:
  - `$x` (int|float|string) — Angka bilangan yang akan dieja.
- **Return**: `string` — Teks ejaan bilangan diawali spasi.
- **Contoh Pemakaian**:
  ```php
  // Dipanggil secara rekursif dan oleh terbilang()
  $ejaan = kekata(150000); // " seratus lima puluh ribu"
  ```

#### Detail: `terbilang`
- **Signature**: `function terbilang($x, $style = 0): string` (baris 47–69)
- **Tujuan**: Mengonversi angka ke kalimat terbilang bahasa Indonesia lengkap dengan pilihan gaya huruf kapital/kecil.
- **Parameter**:
  - `$x` (int|float|string) — Angka bilangan yang akan dieja.
  - `$style` (int, opsional, default: 0) — Format casing huruf:
    - `0`: Format huruf awal kalimat kapital (`ucfirst`)
    - `1`: Format huruf besar semua (`strtoupper`)
    - `2`: Format huruf kecil semua (`strtolower`)
    - `3`: Format huruf kapital di setiap kata (`ucwords`)
- **Return**: `string` — Kalimat terbilang dengan format huruf yang dipilih.
- **Contoh Pemakaian**:
  ```php
  // resources/views/penjualan/cetakInvoice.blade.php:249
  echo terbilang($penjualan->totalnetto, 3) . " Rupiah";
  ```

#### Detail: `bulan`
- **Signature**: `function bulan($id_bulan): string` (baris 71–115)
- **Tujuan**: Menerjemahkan angka urut bulan (1–12) menjadi nama bulan resmi bahasa Indonesia.
- **Parameter**:
  - `$id_bulan` (string|int) — Nomor urut bulan ('1' s.d. '12' atau '01' s.d. '12').
- **Return**: `string` — Nama bulan bahasa Indonesia ('Januari' s.d. 'Desember') atau string kosong jika tidak valid.
- **Contoh Pemakaian**:
  ```php
  // app/Http/Controllers/PenjualanController.php:38
  $namabulan = bulan(date('m'));
  ```

#### Detail: `hari`
- **Signature**: `function hari($date): string` (baris 117–156)
- **Tujuan**: Mengambil nama hari bahasa Indonesia berdasarkan tanggal input.
- **Parameter**:
  - `$date` (string) — Nilai tanggal string yang dapat diparsing `strtotime()`.
- **Return**: `string` — Nama hari ('Minggu' s.d. 'Sabtu') atau 'Tidak di ketahui'.
- **Contoh Pemakaian**:
  ```php
  $hariIni = hari('2026-10-09'); // "Jumat"
  ```

#### Detail: `tglindonesialengkap`
- **Signature**: `function tglindonesialengkap($tanggal): string` (baris 158–210)
- **Tujuan**: Mengubah tanggal `Y-m-d` menjadi format teks lengkap bahasa Indonesia dengan nama bulan penuh.
- **Parameter**:
  - `$tanggal` (string|null) — Tanggal dalam format `Y-m-d`.
- **Return**: `string` — Format `d [NamaBulanLengkap] Y` (misal: "09 Oktober 2026") atau string kosong jika input kosong/`0000-00-00`.
- **Contoh Pemakaian**:
  ```php
  echo tglindonesialengkap('2026-10-09'); // "09 Oktober 2026"
  ```

#### Detail: `tglindonesia`
- **Signature**: `function tglindonesia($tanggal): string` (baris 212–262)
- **Tujuan**: Mengubah tanggal `Y-m-d` ke format teks bahasa Indonesia dengan singkatan nama bulan 3 huruf (Jan, Feb, Mar, dll.).
- **Parameter**:
  - `$tanggal` (string|null) — Tanggal dalam format `Y-m-d`.
- **Return**: `string` — Format `d [BulanSingkat] Y` (misal: "09 Okt 2026") atau string kosong jika input kosong.
- **Contoh Pemakaian**:
  ```php
  // resources/views/penjualan/cetakInvoice.blade.php:48
  tglindonesia($penjualan->tglinvoice);
  ```

#### Detail: `tgldatetime`
- **Signature**: `function tgldatetime($tanggal): string` (baris 264–271)
- **Tujuan**: Memformat waktu database menjadi format `d-m-Y H:i:s`.
- **Parameter**:
  - `$tanggal` (string|null) — Timestamp atau datetime string.
- **Return**: `string` — Tanggal dan jam berformat `d-m-Y H:i:s` atau string kosong jika kosong/tidak diset.
- **Contoh Pemakaian**:
  ```php
  // resources/views/stockopname/cetakSO.blade.php:38
  tgldatetime($stockopname->inserted_date);
  ```

#### Detail: `tgldmy`
- **Signature**: `function tgldmy($tanggal): string` (baris 273–276)
- **Tujuan**: Memformat tanggal ke format `d-m-Y` (hari-bulan-tahun).
- **Parameter**:
  - `$tanggal` (string) — Tanggal string.
- **Return**: `string` — Tanggal berformat `d-m-Y`.
- **Contoh Pemakaian**:
  ```php
  // app/Http/Controllers/PenjualanController.php:189
  'tglinvoice' => tgldmy($row->tglinvoice),
  ```

#### Detail: `tglymd`
- **Signature**: `function tglymd($tanggal): string` (baris 278–281)
- **Tujuan**: Memformat tanggal ke format standar database MySQL `Y-m-d`.
- **Parameter**:
  - `$tanggal` (string) — Tanggal string (misal dari input date picker `d-m-Y`).
- **Return**: `string` — Tanggal berformat `Y-m-d`.
- **Contoh Pemakaian**:
  ```php
  // app/Http/Controllers/SalesController.php:333
  'tgllahir' => tglymd($request->tgllahir),
  ```

#### Detail: `selisihHari`
- **Signature**: `function selisihHari($date1, $date2): int` (baris 283–289)
- **Tujuan**: Menghitung selisih jumlah hari antara dua tanggal menggunakan objek DateTime bawaan PHP.
- **Parameter**:
  - `$date1` (string) — Tanggal pertama.
  - `$date2` (string) — Tanggal kedua.
- **Return**: `int` — Jumlah selisih hari absolut.
- **Contoh Pemakaian**:
  ```php
  $hari = selisihHari('2026-10-01', '2026-10-09'); // 8
  ```

#### Detail: `numberformat_indonesia`
- **Signature**: `function numberformat_indonesia($nNumber): string` (baris 291–295)
- **Tujuan**: Memformat angka numerik dengan pemisah koma tanpa angka desimal.
- **Parameter**:
  - `$nNumber` (float|int|string) — Nilai angka numerik.
- **Return**: `string` — Angka dengan pemisah ribuan koma.
- **Contoh Pemakaian**:
  ```php
  echo numberformat_indonesia(1250000); // "1,250,000"
  ```

#### Detail: `format_decimal`
- **Signature**: `function format_decimal($nNumber, $nDecimal = 2): string` (baris 297–301)
- **Tujuan**: Memformat angka desimal dengan precision tertentu dan pemisah ribuan koma.
- **Parameter**:
  - `$nNumber` (float|int|string) — Nilai angka numerik.
  - `$nDecimal` (int, opsional, default: 2) — Jumlah angka desimal di belakang koma.
- **Return**: `string` — Angka dengan format desimal yang ditentukan.
- **Contoh Pemakaian**:
  ```php
  // resources/views/kartustokbarang/cetak.blade.php:87
  format_decimal($row->saldoakhir, 2);
  ```

#### Detail: `replwzero`
- **Signature**: `function replwzero($value, $jumlahchar): string` (baris 303–312)
- **Tujuan**: Menambahkan angka nol di depan (*leading zero*) hingga panjang karakter yang diinginkan.
- **Parameter**:
  - `$value` (int|string) — Angka atau string dasar.
  - `$jumlahchar` (int) — Target panjang string.
- **Return**: `string` — String angka berawalan nol.
- **Contoh Pemakaian**:
  ```php
  $no = replwzero(45, 5); // "00045"
  ```

#### Detail: `get_saldo_normal`
- **Signature**: `function get_saldo_normal($kdakun): string` (baris 314–321)
- **Tujuan**: Menentukan klasifikasi saldo normal akun akuntansi (Debet/Kredit) dari kode akun.
- **Parameter**:
  - `$kdakun` (string) — Kode akun (misal '1101', '2101', '5101').
- **Return**: `string` — `'D'` jika digit awal akun adalah '1' (Aset) atau '5' (Beban); `'K'` jika kelompok akun lainnya (Kewajiban, Ekuitas, Pendapatan).
- **Contoh Pemakaian**:
  ```php
  // app/Models/Lapbukubesar.php:79
  $saldonormal = get_saldo_normal($kdakun);
  ```

#### Detail: `format_rupiah`
- **Signature**: `function format_rupiah($jumlah): string` (baris 323–326)
- **Tujuan**: Memformat nilai nominal uang dengan pemisah ribuan koma bawaan PHP `number_format`.
- **Parameter**:
  - `$jumlah` (float|int|string) — Nilai nominal uang.
- **Return**: `string` — String nominal dengan pemisah ribuan.
- **Contoh Pemakaian**:
  ```php
  // app/Http/Controllers/PenjualanController.php:218
  'totalnetto' => format_rupiah($row->totalnetto),
  ```

#### Detail: `untitik`
- **Signature**: `function untitik($jumlah): string` (baris 328–331)
- **Tujuan**: Menghapus seluruh karakter koma (`,`) dari input form bertipe masking ribuan agar dapat dihitung atau disimpan ke kolom numerik basis data.
- **Parameter**:
  - `$jumlah` (string|int|float) — Nilai nominal berpemisah koma (contoh: "1,500,000").
- **Return**: `string` — String angka murni tanpa pemisah (contoh: "1500000").
- **Contoh Pemakaian**:
  ```php
  // app/Http/Controllers/PenjualanController.php:315
  'subtotal' => untitik($request->subtotal),
  ```
- *Catatan Duplikasi*: Terdapat fungsi JavaScript dengan nama dan tujuan yang sama (`untitik(nilai)`) di dalam file Blade form untuk manipulasi DOM sisi client.

#### Detail: `cutstring`
- **Signature**: `function cutstring($string, $jumlah): string` (baris 333–336)
- **Tujuan**: Memotong string dari karakter pertama sepanjang `$jumlah` karakter.
- **Parameter**:
  - `$string` (string) — Teks asli.
  - `$jumlah` (int) — Batas panjang karakter.
- **Return**: `string` — Substring hasil pemotongan.
- **Contoh Pemakaian**:
  ```php
  $potongan = cutstring('Distribusi Barang', 10); // "Distribusi"
  ```

#### Detail: `untitikakun`
- **Signature**: `function untitikakun($akun): string` (baris 338–341)
- **Tujuan**: Menghapus karakter tanda titik (`.`) dari string kode akun akuntansi.
- **Parameter**:
  - `$akun` (string) — Kode akun berpemisah titik (contoh: "1.1.01.01").
- **Return**: `string` — Kode akun tanpa titik (contoh: "110101").
- **Contoh Pemakaian**:
  ```php
  $kdAkunMurni = untitikakun('1.1.01.01'); // "110101"
  ```

#### Detail: `since`
- **Signature**: `function since($timestamp): string` (baris 343–380)
- **Tujuan**: Mengonversi nilai waktu lampau menjadi teks rentang waktu relatif bahasa Indonesia ("time ago").
- **Parameter**:
  - `$timestamp` (string) — Nilai waktu dalam format datetime/timestamp.
- **Return**: `string` — Teks relatif seperti "Baru saja", "X menit yang lalu", "X jam yang lalu", "X hari yang lalu", "X minggu yang lalu", "X bulan yang lalu", "X tahun yang lalu", atau pesan validasi jika waktu di masa depan.
- **Contoh Pemakaian**:
  ```php
  // app/Http/Controllers/PenggunaController.php:142
  'lastlogin' => since($row->lastlogin),
  ```

#### Detail: `hitungUmurPiutang`
- **Signature**: `function hitungUmurPiutang($tglPiutang, $tglHitung = null): int` (baris 382–402)
- **Tujuan**: Menghitung umur piutang dagang (dalam satuan hari) dari tanggal faktur hingga tanggal cut-off pelaporan menggunakan Carbon.
- **Parameter**:
  - `$tglPiutang` (Carbon|string) — Tanggal invoice/piutang.
  - `$tglHitung` (Carbon|string|null, opsional, default: null) — Tanggal acuan perhitungan. Jika null/kosong, menggunakan waktu hari ini (`Carbon::now()`).
- **Return**: `int` — Jumlah hari selisih umur piutang (mengembalikan 0 jika tanggal piutang lebih besar dari tanggal acuan).
- **Contoh Pemakaian**:
  ```php
  // resources/views/lappenjualan/cetakbytgl.blade.php:87
  $umur = hitungUmurPiutang($row->tglinvoice, $tglsampai);
  ```

---

### app/Helpers/PpnHelper.php
Deskripsi file: Helper class untuk memvalidasi dan membulatkan nilai PPN faktur pajak sesuai regulasi perpajakan yang berlaku.

| Nama Fungsi | Parameter | Return | Deskripsi | Dipakai Di | Status |
|-------------|-----------|--------|-----------|------------|--------|
| `roundPPN` | `$value: float\|int\|string` | `int` | Membulatkan nilai PPN ke bawah jika desimal < 0,50 dan ke atas jika desimal ≥ 0,50. | `app/Http/Controllers/PenjualanController.php:336`, `app/Http/Controllers/PembelianpenerimaanController.php:191`, `resources/views/pembelianpenerimaan/form.blade.php:346`, `resources/views/pembelianpenerimaan/modalTambahBarang.blade.php:80` | Aktif |

#### Detail: `roundPPN`
- **Signature**: `public static function roundPPN($value): int` (baris 15–18)
- **Tujuan**: Mencegah selisih desimal pembulatan antara akumulasi PPN per baris item dan total PPN faktur pajak.
- **Parameter**:
  - `$value` (float|int|string) — Nominal PPN hasil perkalian persentase sebelum dibulatkan.
- **Return**: `int` — Nilai PPN bulat (integer).
- **Contoh Pemakaian**:
  ```php
  // app/Http/Controllers/PenjualanController.php:336
  $ppnItem = PpnHelper::roundPPN($subtotalItem * ($persenPpn / 100));
  ```

---

### app/Helpers/StokFifoService.php
Deskripsi file: Service helper yang mengelola alur persediaan keluar-masuk menggunakan metode First-In First-Out (FIFO) dan mencatat valuasi HPP ke database.

| Nama Fungsi | Parameter | Return | Deskripsi | Dipakai Di | Status |
|-------------|-----------|--------|-----------|------------|--------|
| `barangMasuk` | `$idstokfifo, $idbarang, $idtransaksi, $tgltransaksi, $jenistransaksi, $jumlah, $hargasatuan, $hargadpp = 0, $jumlahppn = 0, $jumlahdiskon = 0, $keterangan = null` | `bool` | Mencatat layer persediaan baru pada tabel `stokfifo` dengan inisialisasi saldo sisa dan nilai HPP. | `app/Models/Pembelianpenerimaan.php:97`, `app/Models/Returpenjualan.php:120`, `app/Models/Konversistok.php:80`, `app/Models/Stockopname.php:105` | Aktif |
| `barangKeluar` | `$idbarang, $idtransaksi, $jenistransaksi, $jumlahKeluar` | `array` | Mengalokasikan pengeluaran barang dari layer tertua yang tersedia, memperbarui sisa layer, dan mencatat rincian ke `stokfifodetail`. | `app/Models/Penjualan.php:134`, `app/Models/Returpembelian.php:88`, `app/Models/Konversistok.php:62` | Aktif |
| `batalBarangKeluar` | `$idtransaksi, $jenistransaksi` | `void` | Memulihkan kuantitas sisa layer FIFO akibat pembatalan atau penghapusan transaksi pengeluaran. | `app/Models/Penjualan.php:195`, `app/Models/Returpembelian.php:140`, `app/Models/Konversistok.php:110` | Aktif |
| `hapusBarangMasuk` | `$idtransaksi, $jenistransaksi` | `void` | Menghapus layer FIFO barang masuk jika stok layer bersangkutan belum pernah dialokasikan ke transaksi keluar. | `app/Models/Pembelianpenerimaan.php:145`, `app/Models/Returpenjualan.php:165`, `app/Models/Stockopname.php:140` | Aktif |

#### Detail: `barangMasuk`
- **Signature**: `public function barangMasuk($idstokfifo, $idbarang, $idtransaksi, $tgltransaksi, $jenistransaksi, $jumlah, $hargasatuan, $hargadpp = 0, $jumlahppn = 0, $jumlahdiskon = 0, $keterangan = null): bool` (baris 12–37)
- **Tujuan**: Membuat entitas layer stok baru di tabel `stokfifo` saat transaksi pengadaan barang (pembelian, retur penjualan, koreksi stock opname, konversi stok).
- **Parameter**:
  - `$idstokfifo` (string) — Identifier unik record layer stok.
  - `$idbarang` (string) — ID barang yang bertambah.
  - `$idtransaksi` (string) — ID transaksi penerimaan/sumber data.
  - `$tgltransaksi` (string) — Tanggal transaksi masuk.
  - `$jenistransaksi` (string) — Label jenis transaksi ('PEMBELIAN', 'RETUR PENJUALAN', dll.).
  - `$jumlah` (float|int) — Kuantitas barang masuk (`jumlahmasuk` dan `jumlahsisa`).
  - `$hargasatuan` (float|int) — Harga perolehan per unit.
  - `$hargadpp` (float|int, opsional, default: 0) — Nilai DPP satuan setelah diskon dan PPN (menjadi `nilaihpp`).
  - `$jumlahppn` (float|int, opsional, default: 0) — Nilai nominal PPN per satuan.
  - `$jumlahdiskon` (float|int, opsional, default: 0) — Nilai nominal diskon per satuan.
  - `$keterangan` (string|null, opsional, default: null) — Catatan transaksi.
- **Return**: `bool` — Status keberhasilan penyimpanan data ke tabel `stokfifo`.
- **Contoh Pemakaian**:
  ```php
  // app/Models/Pembelianpenerimaan.php:97
  $fifoService = new \App\Helpers\StokFifoService();
  $fifoService->barangMasuk($idfifo, $idbarang, $idpenerimaan, $tglterima, 'PEMBELIAN', $qty, $harga, $dpp);
  ```

#### Detail: `barangKeluar`
- **Signature**: `public function barangKeluar($idbarang, $idtransaksi, $jenistransaksi, $jumlahKeluar): array` (baris 42–108)
- **Tujuan**: Mengurangi persediaan dari layer tertua yang memiliki sisa secara transaksional (`DB::transaction` + `lockForUpdate`) dan mencatat mutasi detail pengeluaran.
- **Parameter**:
  - `$idbarang` (string) — ID barang yang keluar.
  - `$idtransaksi` (string) — ID transaksi penjualan/retur pembelian/konversi.
  - `$jenistransaksi` (string) — Label jenis transaksi keluar.
  - `$jumlahKeluar` (float|int) — Total kuantitas barang yang dikeluarkan.
- **Return**: `array` — Rincian layer yang terpakai berformat `[{idstokfifo, jumlahkeluar, hargasatuan, subtotal}]`.
- **Contoh Pemakaian**:
  ```php
  // app/Models/Penjualan.php:134
  $fifoService = new \App\Helpers\StokFifoService();
  $detailHpp = $fifoService->barangKeluar($idbarang, $idpenjualan, 'PENJUALAN', $qty);
  ```

#### Detail: `batalBarangKeluar`
- **Signature**: `public function batalBarangKeluar($idtransaksi, $jenistransaksi): void` (baris 113–137)
- **Tujuan**: Mengembalikan kuantitas `jumlahsisa` pada layer `stokfifo` jika transaksi pengeluaran diedit atau dihapus.
- **Parameter**:
  - `$idtransaksi` (string) — ID transaksi yang dibatalkan.
  - `$jenistransaksi` (string) — Jenis transaksi yang dibatalkan.
- **Return**: `void`
- **Contoh Pemakaian**:
  ```php
  // app/Models/Penjualan.php:195
  $fifoService = new \App\Helpers\StokFifoService();
  $fifoService->batalBarangKeluar($idpenjualan, 'PENJUALAN');
  ```

#### Detail: `hapusBarangMasuk`
- **Signature**: `public function hapusBarangMasuk($idtransaksi, $jenistransaksi): void` (baris 142–165)
- **Tujuan**: Menghapus layer penerimaan barang jika layer tersebut belum pernah terpakai oleh transaksi pengeluaran.
- **Parameter**:
  - `$idtransaksi` (string) — ID transaksi masuk yang akan dihapus.
  - `$jenistransaksi` (string) — Jenis transaksi masuk.
- **Return**: `void` (melempar `\Exception` jika kuantitas layer sudah terpakai).
- **Contoh Pemakaian**:
  ```php
  // app/Models/Pembelianpenerimaan.php:145
  $fifoService = new \App\Helpers\StokFifoService();
  $fifoService->hapusBarangMasuk($idpenerimaan, 'PEMBELIAN');
  ```
