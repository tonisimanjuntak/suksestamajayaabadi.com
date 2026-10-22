<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Pemeliharaansystem extends Model
{
    use HasFactory;

    /**
     * Ambil statistik global tabel riwayataktifitas dan arsip
     */
    public function getStatistikGlobal()
    {
        $aktifCount = DB::table('riwayataktifitas')->count();
        $archiveCount = DB::table('riwayataktifitas_archive')->count();

        $aktifMinDate = DB::table('riwayataktifitas')->min('inserted_date');
        $aktifMaxDate = DB::table('riwayataktifitas')->max('inserted_date');

        $archiveMinDate = DB::table('riwayataktifitas_archive')->min('inserted_date');
        $archiveMaxDate = DB::table('riwayataktifitas_archive')->max('inserted_date');

        return [
            'aktif_count' => $aktifCount,
            'archive_count' => $archiveCount,
            'aktif_min_date' => $aktifMinDate ? date('d-m-Y H:i', strtotime($aktifMinDate)) : '-',
            'aktif_max_date' => $aktifMaxDate ? date('d-m-Y H:i', strtotime($aktifMaxDate)) : '-',
            'archive_min_date' => $archiveMinDate ? date('d-m-Y H:i', strtotime($archiveMinDate)) : '-',
            'archive_max_date' => $archiveMaxDate ? date('d-m-Y H:i', strtotime($archiveMaxDate)) : '-',
        ];
    }

    /**
     * Daftar opsi periode arsip
     */
    public function getPeriodeList()
    {
        return [
            '1' => '< 1 bulan',
            '2' => '< 2 bulan',
            '3' => '< 3 bulan',
            '6' => '< 6 bulan',
            '12' => '< 12 bulan',
        ];
    }

    /**
     * Ambil label teks periode
     */
    public function getPeriodeLabel($periode)
    {
        $list = $this->getPeriodeList();
        return $list[$periode] ?? "< $periode bulan";
    }

    /**
     * Hitung tanggal batas (cutoff) berdasarkan periode bulan
     */
    public function hitungCutoffDate($periode)
    {
        $bulan = (int)$periode;
        if ($bulan <= 0) {
            $bulan = 1;
        }

        $dt = new \DateTime();
        $dt->modify("-{$bulan} months");
        return $dt->format('Y-m-d H:i:s');
    }

    /**
     * Cek rincian data riwayataktifitas pada periode tertentu (< N bulan)
     */
    public function cekStatusPeriode($periode)
    {
        $periodeLabel = $this->getPeriodeLabel($periode);
        $cutoffDate = $this->hitungCutoffDate($periode);

        $totalRiwayat = DB::table('riwayataktifitas')
            ->where('inserted_date', '<', $cutoffDate)
            ->count();

        $sudahDiarsipkan = DB::table('riwayataktifitas as r')
            ->join('riwayataktifitas_archive as a', 'r.id', '=', 'a.id')
            ->where('r.inserted_date', '<', $cutoffDate)
            ->count();

        $belumDiarsipkan = DB::table('riwayataktifitas as r')
            ->leftJoin('riwayataktifitas_archive as a', 'r.id', '=', 'a.id')
            ->whereNull('a.id')
            ->where('r.inserted_date', '<', $cutoffDate)
            ->count();

        $totalDiArchive = DB::table('riwayataktifitas_archive')
            ->where('inserted_date', '<', $cutoffDate)
            ->count();

        $sisaAktifTersimpan = DB::table('riwayataktifitas')
            ->where('inserted_date', '>=', $cutoffDate)
            ->count();

        return [
            'periode' => $periode,
            'periode_label' => $periodeLabel,
            'cutoff_date' => $cutoffDate,
            'cutoff_formatted' => date('d-m-Y H:i:s', strtotime($cutoffDate)),
            'total_riwayat' => $totalRiwayat,
            'sudah_diarsipkan' => $sudahDiarsipkan,
            'belum_diarsipkan' => $belumDiarsipkan,
            'total_di_archive' => $totalDiArchive,
            'sisa_aktif_tersimpan' => $sisaAktifTersimpan,
        ];
    }

    /**
     * Memindahkan data riwayataktifitas ke riwayataktifitas_archive:
     * 1. Cek data yang belum diarsipkan sebelum tanggal cutoff
     * 2. Insert data riwayat yang belum ada di arsip
     * 3. Hapus data yang telah berada di tabel arsip dari riwayataktifitas
     */
    public function archiveRiwayatAktifitas($periode)
    {
        $periodeLabel = $this->getPeriodeLabel($periode);
        $cutoffDate = $this->hitungCutoffDate($periode);

        // Cek apakah ada data di riwayataktifitas yang memenuhi syarat
        $totalRiwayat = DB::table('riwayataktifitas')
            ->where('inserted_date', '<', $cutoffDate)
            ->count();

        if ($totalRiwayat == 0) {
            return [
                'status' => 'warning',
                'message' => "Tidak ada data riwayat aktifitas pada periode $periodeLabel (sebelum " . date('d-m-Y H:i:s', strtotime($cutoffDate)) . ") yang perlu diproses.",
                'inserted' => 0,
                'deleted' => 0,
            ];
        }

        DB::beginTransaction();
        try {
            // 1. Cek data yang belum pernah diarsipkan
            $belumDiarsipkanCount = DB::table('riwayataktifitas as r')
                ->leftJoin('riwayataktifitas_archive as a', 'r.id', '=', 'a.id')
                ->whereNull('a.id')
                ->where('r.inserted_date', '<', $cutoffDate)
                ->count();

            // 2. Insert data riwayat yang belum diarsipkan ke riwayataktifitas_archive
            if ($belumDiarsipkanCount > 0) {
                DB::statement("
                    INSERT INTO riwayataktifitas_archive (id, deskripsi, namapengguna, inserted_date, namatabel, namafunction, idpengguna)
                    SELECT r.id, r.deskripsi, r.namapengguna, r.inserted_date, r.namatabel, r.namafunction, r.idpengguna
                    FROM riwayataktifitas r
                    LEFT JOIN riwayataktifitas_archive a ON r.id = a.id
                    WHERE a.id IS NULL
                      AND r.inserted_date < ?
                ", [$cutoffDate]);
            }

            // 3. Hitung data yang sekarang ada di riwayataktifitas dan sudah tersimpan di arsip
            $hapusCount = DB::table('riwayataktifitas as r')
                ->join('riwayataktifitas_archive as a', 'r.id', '=', 'a.id')
                ->where('r.inserted_date', '<', $cutoffDate)
                ->count();

            // 4. Hapus data yang sudah aman di arsip dari riwayataktifitas
            if ($hapusCount > 0) {
                DB::statement("
                    DELETE r FROM riwayataktifitas r
                    INNER JOIN riwayataktifitas_archive a ON r.id = a.id
                    WHERE r.inserted_date < ?
                ", [$cutoffDate]);
            }

            DB::commit();

            // Catat riwayat aktifitas pemeliharaan sistem
            $appModel = new App();
            $appModel->riwayatAktifitas([
                'keterangan' => 'Arsip Riwayat Aktifitas',
                'periode' => $periodeLabel,
                'cutoff_date' => $cutoffDate,
                'data_diinsert' => $belumDiarsipkanCount,
                'data_dibersihkan' => $hapusCount,
            ], 'riwayataktifitas_archive', 'archiveRiwayatAktifitas');

            return [
                'status' => 'success',
                'message' => "Proses arsip periode $periodeLabel berhasil. Sebanyak " . number_format($belumDiarsipkanCount, 0, ',', '.') . " baris baru disalin ke arsip, dan " . number_format($hapusCount, 0, ',', '.') . " baris dibersihkan dari tabel aktifitas.",
                'inserted' => $belumDiarsipkanCount,
                'deleted' => $hapusCount,
            ];
        } catch (Exception $e) {
            DB::rollBack();
            return [
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses arsip: ' . $e->getMessage(),
                'inserted' => 0,
                'deleted' => 0,
            ];
        }
    }
}
