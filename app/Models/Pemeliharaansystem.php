<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class Pemeliharaansystem extends Model
{
    use HasFactory;

    /**
     * Ambil statistik global tabel riwayataktifitas, arsip, dan sesi pengguna
     */
    public function getStatistikGlobal($currentSessionId = null)
    {
        $aktifCount = DB::table('riwayataktifitas')->count();
        $archiveCount = DB::table('riwayataktifitas_archive')->count();

        $aktifMinDate = DB::table('riwayataktifitas')->min('inserted_date');
        $aktifMaxDate = DB::table('riwayataktifitas')->max('inserted_date');

        $archiveMinDate = DB::table('riwayataktifitas_archive')->min('inserted_date');
        $archiveMaxDate = DB::table('riwayataktifitas_archive')->max('inserted_date');

        $totalSesi = 0;
        $sesiLain = 0;
        if (Schema::hasTable('sessions')) {
            $totalSesi = DB::table('sessions')->count();
            if (empty($currentSessionId)) {
                $currentSessionId = Session::getId();
            }
            $sesiLain = DB::table('sessions')->where('id', '!=', $currentSessionId)->count();
        }

        return [
            'aktif_count' => $aktifCount,
            'archive_count' => $archiveCount,
            'aktif_min_date' => $aktifMinDate ? date('d-m-Y H:i', strtotime($aktifMinDate)) : '-',
            'aktif_max_date' => $aktifMaxDate ? date('d-m-Y H:i', strtotime($aktifMaxDate)) : '-',
            'archive_min_date' => $archiveMinDate ? date('d-m-Y H:i', strtotime($archiveMinDate)) : '-',
            'archive_max_date' => $archiveMaxDate ? date('d-m-Y H:i', strtotime($archiveMaxDate)) : '-',
            'total_sesi' => $totalSesi,
            'sesi_lain' => $sesiLain,
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
        $bulan = (int) $periode;
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
                'message' => "Tidak ada data riwayat aktifitas pada periode $periodeLabel (sebelum ".date('d-m-Y H:i:s', strtotime($cutoffDate)).') yang perlu diproses.',
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
                DB::statement('
                    INSERT INTO riwayataktifitas_archive (id, deskripsi, namapengguna, inserted_date, namatabel, namafunction, idpengguna)
                    SELECT r.id, r.deskripsi, r.namapengguna, r.inserted_date, r.namatabel, r.namafunction, r.idpengguna
                    FROM riwayataktifitas r
                    LEFT JOIN riwayataktifitas_archive a ON r.id = a.id
                    WHERE a.id IS NULL
                      AND r.inserted_date < ?
                ', [$cutoffDate]);
            }

            // 3. Hitung data yang sekarang ada di riwayataktifitas dan sudah tersimpan di arsip
            $hapusCount = DB::table('riwayataktifitas as r')
                ->join('riwayataktifitas_archive as a', 'r.id', '=', 'a.id')
                ->where('r.inserted_date', '<', $cutoffDate)
                ->count();

            // 4. Hapus data yang sudah aman di arsip dari riwayataktifitas
            if ($hapusCount > 0) {
                DB::statement('
                    DELETE r FROM riwayataktifitas r
                    INNER JOIN riwayataktifitas_archive a ON r.id = a.id
                    WHERE r.inserted_date < ?
                ', [$cutoffDate]);
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
                'message' => "Proses arsip periode $periodeLabel berhasil. Sebanyak ".number_format($belumDiarsipkanCount, 0, ',', '.').' baris baru disalin ke arsip, dan '.number_format($hapusCount, 0, ',', '.').' baris dibersihkan dari tabel aktifitas.',
                'inserted' => $belumDiarsipkanCount,
                'deleted' => $hapusCount,
            ];
        } catch (Exception $e) {
            DB::rollBack();

            return [
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses arsip: '.$e->getMessage(),
                'inserted' => 0,
                'deleted' => 0,
            ];
        }
    }

    /**
     * Mengeluarkan (force logout) seluruh pengguna lain dari sistem.
     * Sesi developer saat ini ($currentSessionId) tetap dipertahankan.
     */
    public function logoutSemuaPengguna($currentSessionId = null)
    {
        try {
            if (empty($currentSessionId)) {
                $currentSessionId = Session::getId();
            }

            $countLain = 0;
            if (Schema::hasTable('sessions')) {
                $countLain = DB::table('sessions')
                    ->where('id', '!=', $currentSessionId)
                    ->count();

                DB::table('sessions')
                    ->where('id', '!=', $currentSessionId)
                    ->delete();
            }

            // Bersihkan file session lokal jika ada file selain sesi developer saat ini
            $sessionFiles = glob(storage_path('framework/sessions/*'));
            $fileDeleted = 0;
            if ($sessionFiles) {
                foreach ($sessionFiles as $file) {
                    $filename = basename($file);
                    if ($filename !== $currentSessionId && $filename !== '.gitignore') {
                        if (@unlink($file)) {
                            $fileDeleted++;
                        }
                    }
                }
            }

            // Catat riwayat aktifitas pemeliharaan sistem
            $appModel = new App();
            $appModel->riwayatAktifitas([
                'keterangan' => 'Force Logout Semua Pengguna Lain',
                'sesi_dikeluarkan' => $countLain,
                'file_sesi_dibersihkan' => $fileDeleted,
                'developer_session_id' => $currentSessionId,
            ], 'sessions', 'logoutSemuaPengguna');

            return [
                'status' => 'success',
                'message' => 'Berhasil mengeluarkan seluruh pengguna dari sistem. Sebanyak '.number_format($countLain, 0, ',', '.').' sesi pengguna lain telah dinonaktifkan. Pengguna harus login ulang.',
                'total_logout' => $countLain,
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Gagal memproses logout seluruh pengguna: '.$e->getMessage(),
                'total_logout' => 0,
            ];
        }
    }

    /**
     * Ambil informasi status pemeliharaan sistem
     */
    public function getMaintenanceInfo()
    {
        $status = DB::table('settings')->where('prefix', 'maintenance_status')->value('values') ?? '0';
        $estimatedFinished = DB::table('settings')->where('prefix', 'maintenance_estimated_finished')->value('values') ?? '';

        return [
            'status' => $status,
            'is_active' => ($status === '1'),
            'estimated_finished' => $estimatedFinished,
        ];
    }

    /**
     * Mengaktifkan mode pemeliharaan sistem
     */
    public function mulaiMaintenance($durasiMenit)
    {
        try {
            $durasiMenit = (int) $durasiMenit;
            if ($durasiMenit <= 0) {
                $durasiMenit = 60;
            }

            $estimatedFinished = date('Y-m-d H:i:s', strtotime("+{$durasiMenit} minutes"));

            DB::table('settings')->updateOrInsert(
                ['prefix' => 'maintenance_status'],
                ['values' => '1', 'updated_date' => now(), 'issystem' => 1]
            );

            DB::table('settings')->updateOrInsert(
                ['prefix' => 'maintenance_estimated_finished'],
                ['values' => $estimatedFinished, 'updated_date' => now(), 'issystem' => 1]
            );

            $appModel = new App();
            $appModel->riwayatAktifitas([
                'keterangan' => 'Mulai Maintenance Sistem',
                'durasi_menit' => $durasiMenit,
                'estimated_finished' => $estimatedFinished,
            ], 'settings', 'mulaiMaintenance');

            return [
                'status' => 'success',
                'message' => "Mode maintenance berhasil diaktifkan. Estimasi selesai: {$estimatedFinished} ({$durasiMenit} Menit).",
                'maintenance_status' => '1',
                'estimated_finished' => $estimatedFinished,
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Gagal mengaktifkan mode maintenance: '.$e->getMessage(),
            ];
        }
    }

    /**
     * Menonaktifkan mode pemeliharaan sistem
     */
    public function selesaiMaintenance()
    {
        try {
            DB::table('settings')->updateOrInsert(
                ['prefix' => 'maintenance_status'],
                ['values' => '0', 'updated_date' => now(), 'issystem' => 1]
            );

            $appModel = new App();
            $appModel->riwayatAktifitas([
                'keterangan' => 'Selesai Maintenance Sistem',
            ], 'settings', 'selesaiMaintenance');

            return [
                'status' => 'success',
                'message' => 'Mode maintenance berhasil dinonaktifkan. Sistem kembali normal.',
                'maintenance_status' => '0',
            ];
        } catch (Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Gagal menonaktifkan mode maintenance: '.$e->getMessage(),
            ];
        }
    }
}
