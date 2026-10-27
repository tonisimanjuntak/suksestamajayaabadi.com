<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lapperubahanmodal extends Model
{
    use HasFactory;

    /**
     * Ambil data lengkap untuk Laporan Perubahan Modal dari tabel jurnal dan jurnaldetail.
     *
     * @param  string  $tglawal  Format Y-m-d
     * @param  string  $tglakhir  Format Y-m-d
     * @return array
     */
    public function getDataPerubahanModal($tglawal, $tglakhir)
    {
        // 1. Ambil seluruh akun Ekuitas / Modal (Level 4, awalan '3')
        $akunModal = DB::table('akun')
            ->where('kdakun', 'like', '3%')->where('levels', 4)
            ->orderBy('kdakun')
            ->get();

        // 2. Saldo awal akun modal sebelum $tglawal dari jurnaldetail & jurnal
        $rawSaldoAwal = DB::select("
            SELECT 
                jd.kdakun,
                COALESCE(SUM(jd.debet), 0)  AS debet,
                COALESCE(SUM(jd.kredit), 0) AS kredit
            FROM jurnaldetail jd
            JOIN jurnal j ON j.idjurnal = jd.idjurnal
            WHERE j.tgljurnal < ?
              AND jd.kdakun LIKE '3%'
            GROUP BY jd.kdakun
        ", [$tglawal]);

        $saldoAwalMap = [];
        foreach ($rawSaldoAwal as $sa) {
            $saldoAwalMap[$sa->kdakun] = [
                'debet' => (float) $sa->debet,
                'kredit' => (float) $sa->kredit,
            ];
        }

        // 3. Akumulasi Laba / Rugi sebelum $tglawal (Akun Pendapatan '4', Beban '5', HPP '6')
        $rawLrAwal = DB::select("
            SELECT 
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '4' THEN (jd.kredit - jd.debet) ELSE 0 END) AS pendapatan,
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '6' THEN (jd.debet - jd.kredit) ELSE 0 END) AS hpp,
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '5' THEN (jd.debet - jd.kredit) ELSE 0 END) AS beban
            FROM jurnaldetail jd
            JOIN jurnal j ON j.idjurnal = jd.idjurnal
            WHERE j.tgljurnal < ?
              AND (j.jenis IS NULL OR j.jenis <> 'Jurnal Penyesuaian')
        ", [$tglawal]);

        $pendapatanAwal = (float) ($rawLrAwal[0]->pendapatan ?? 0);
        $hppAwal = (float) ($rawLrAwal[0]->hpp ?? 0);
        $bebanAwal = (float) ($rawLrAwal[0]->beban ?? 0);
        $labaKumulatifAwal = $pendapatanAwal - $hppAwal - $bebanAwal;

        // 4. Mutasi transaksi akun modal selama periode ($tglawal s/d $tglakhir)
        $rawMutasiPeriode = DB::select("
            SELECT 
                jd.kdakun,
                COALESCE(SUM(jd.debet), 0)  AS debet,
                COALESCE(SUM(jd.kredit), 0) AS kredit
            FROM jurnaldetail jd
            JOIN jurnal j ON j.idjurnal = jd.idjurnal
            WHERE j.tgljurnal BETWEEN ? AND ?
              AND jd.kdakun LIKE '3%'
            GROUP BY jd.kdakun
        ", [$tglawal, $tglakhir]);

        $mutasiMap = [];
        foreach ($rawMutasiPeriode as $mp) {
            $mutasiMap[$mp->kdakun] = [
                'debet' => (float) $mp->debet,
                'kredit' => (float) $mp->kredit,
            ];
        }

        // 5. Laba Rugi periode berjalan ($tglawal s/d $tglakhir)
        $rawLrPeriode = DB::select("
            SELECT 
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '4' THEN (jd.kredit - jd.debet) ELSE 0 END) AS pendapatan,
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '6' THEN (jd.debet - jd.kredit) ELSE 0 END) AS hpp,
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '5' THEN (jd.debet - jd.kredit) ELSE 0 END) AS beban
            FROM jurnaldetail jd
            JOIN jurnal j ON j.idjurnal = jd.idjurnal
            WHERE j.tgljurnal BETWEEN ? AND ?
              AND (j.jenis IS NULL OR j.jenis <> 'Jurnal Penyesuaian')
        ", [$tglawal, $tglakhir]);

        $pendapatanPeriode = (float) ($rawLrPeriode[0]->pendapatan ?? 0);
        $hppPeriode = (float) ($rawLrPeriode[0]->hpp ?? 0);
        $bebanPeriode = (float) ($rawLrPeriode[0]->beban ?? 0);
        $labaBersihPeriode = $pendapatanPeriode - $hppPeriode - $bebanPeriode;

        // 6. Rincian pergerakan setiap akun modal
        $rincianAkunModal = [];
        $totalModalDisetorAwal = 0;
        $totalLabaDitahanAwal = 0;
        $totalPriveAwal = 0;

        $setoranModalPeriode = 0;
        $penarikanModalPeriode = 0;
        $privePeriode = 0;
        $mutasiModalLainnya = 0;

        foreach ($akunModal as $item) {
            $kd = $item->kdakun;
            $namaLower = strtolower($item->namaakun);

            $debetAwal = $saldoAwalMap[$kd]['debet'] ?? 0;
            $kreditAwal = $saldoAwalMap[$kd]['kredit'] ?? 0;

            $debetMutasi = $mutasiMap[$kd]['debet'] ?? 0;
            $kreditMutasi = $mutasiMap[$kd]['kredit'] ?? 0;

            $isPrive = str_contains($namaLower, 'prive');
            $isLabaDitahan = str_contains($namaLower, 'laba ditahan') || str_contains($namaLower, 'retained');
            $isLabaBerjalan = str_contains($namaLower, 'periode berjalan') || str_contains($namaLower, 'tahun berjalan');

            // Hitung saldo awal akun
            if ($isPrive) {
                // Prive bertambah di debet (kontra ekuitas)
                $saldoAwalAkun = $debetAwal - $kreditAwal;
                $totalPriveAwal += $saldoAwalAkun;
                $privePeriode += ($debetMutasi - $kreditMutasi);
            } elseif ($isLabaDitahan) {
                $saldoAwalAkun = $kreditAwal - $debetAwal;
                $totalLabaDitahanAwal += $saldoAwalAkun;
                $mutasiModalLainnya += ($kreditMutasi - $debetMutasi);
            } elseif ($isLabaBerjalan) {
                // Akun penampung jika ada, mutasi ditangani terpisah oleh laba rugi berjalan
                $saldoAwalAkun = $kreditAwal - $debetAwal;
            } else {
                // Modal saham / modal pemilik
                $saldoAwalAkun = $kreditAwal - $debetAwal;
                $totalModalDisetorAwal += $saldoAwalAkun;
                $setoranModalPeriode += $kreditMutasi;
                $penarikanModalPeriode += $debetMutasi;
            }

            $rincianAkunModal[] = [
                'kdakun' => $item->kdakun,
                'namaakun' => $item->namaakun,
                'isPrive' => $isPrive,
                'isLabaDitahan' => $isLabaDitahan,
                'saldoAwal' => $saldoAwalAkun,
                'debetMutasi' => $debetMutasi,
                'kreditMutasi' => $kreditMutasi,
            ];
        }

        // Kalkulasi Total Modal Awal
        // Jika belum ada jurnal tutup buku ke Laba Ditahan, akumulasi laba/rugi lalu digabungkan
        $modalAwal = $totalModalDisetorAwal + $totalLabaDitahanAwal + $labaKumulatifAwal - $totalPriveAwal;

        // Penambahan modal periode berjalan
        $penambahanLaba = ($labaBersihPeriode > 0) ? $labaBersihPeriode : 0;
        $totalPenambahan = $penambahanLaba + $setoranModalPeriode + ($mutasiModalLainnya > 0 ? $mutasiModalLainnya : 0);

        // Pengurangan modal periode berjalan
        $penguranganRugi = ($labaBersihPeriode < 0) ? abs($labaBersihPeriode) : 0;
        $totalPengurangan = $penguranganRugi + $privePeriode + $penarikanModalPeriode + ($mutasiModalLainnya < 0 ? abs($mutasiModalLainnya) : 0);

        // Kenaikan / Penurunan Modal Bersih
        $kenaikanBersihModal = $totalPenambahan - $totalPengurangan;

        // Modal Akhir per $tglakhir
        $modalAkhir = $modalAwal + $kenaikanBersihModal;

        // 7. Ambil daftar transaksi jurnal spesifik untuk akun modal pada periode ini (jika ada)
        $rincianJurnal = DB::select("
            SELECT 
                j.idjurnal,
                j.tgljurnal,
                j.keterangan,
                j.jenis,
                jd.kdakun,
                a.namaakun,
                jd.debet,
                jd.kredit
            FROM jurnaldetail jd
            JOIN jurnal j ON j.idjurnal = jd.idjurnal
            JOIN akun a ON a.kdakun = jd.kdakun
            WHERE j.tgljurnal BETWEEN ? AND ?
              AND jd.kdakun LIKE '3%'
            ORDER BY j.tgljurnal ASC, j.idjurnal ASC, jd.urut ASC
        ", [$tglawal, $tglakhir]);

        return [
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir,
            // Modal Awal
            'totalModalDisetorAwal' => $totalModalDisetorAwal,
            'totalLabaDitahanAwal' => $totalLabaDitahanAwal,
            'labaKumulatifAwal' => $labaKumulatifAwal,
            'totalPriveAwal' => $totalPriveAwal,
            'modalAwal' => $modalAwal,
            // Laba Rugi Periode
            'pendapatanPeriode' => $pendapatanPeriode,
            'hppPeriode' => $hppPeriode,
            'bebanPeriode' => $bebanPeriode,
            'labaBersihPeriode' => $labaBersihPeriode,
            // Mutasi Periode
            'setoranModalPeriode' => $setoranModalPeriode,
            'penarikanModalPeriode' => $penarikanModalPeriode,
            'privePeriode' => $privePeriode,
            'mutasiModalLainnya' => $mutasiModalLainnya,
            // Ringkasan Penambahan & Pengurangan
            'totalPenambahan' => $totalPenambahan,
            'totalPengurangan' => $totalPengurangan,
            'kenaikanBersihModal' => $kenaikanBersihModal,
            'modalAkhir' => $modalAkhir,
            // Rincian Akun & Jurnal
            'rincianAkunModal' => $rincianAkunModal,
            'rincianJurnal' => $rincianJurnal,
        ];
    }
}
