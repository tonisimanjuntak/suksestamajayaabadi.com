<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lapneraca extends Model
{
    use HasFactory;

    /**
     * Ambil saldo akumulatif per akun level 4 s/d $tglakhir dari jurnal & jurnaldetail.
     * Neraca menampilkan posisi keuangan pada tanggal tertentu.
     */
    public function getSaldoNeraca($tglakhir)
    {
        return DB::select("
            SELECT
                a4.kdakun,
                a4.namaakun,
                a4.levels,
                a1.kdakun   AS kdparent_l1,
                a1.namaakun AS namaparent_l1,
                a2.kdakun   AS kdparent_l2,
                a2.namaakun AS namaparent_l2,
                a3.kdakun   AS kdparent_l3,
                a3.namaakun AS namaparent_l3,
                COALESCE(trans.debet, 0)  AS debet,
                COALESCE(trans.kredit, 0) AS kredit
            FROM akun a4
            JOIN akun a3 ON a3.kdakun = a4.kdparent
            JOIN akun a2 ON a2.kdakun = a3.kdparent
            JOIN akun a1 ON a1.kdakun = a2.kdparent
            LEFT JOIN (
                SELECT
                    jd.kdakun,
                    SUM(jd.debet)  AS debet,
                    SUM(jd.kredit) AS kredit
                FROM jurnaldetail jd
                JOIN jurnal j ON j.idjurnal = jd.idjurnal
                WHERE j.tgljurnal <= ?
                GROUP BY jd.kdakun
            ) trans ON trans.kdakun = a4.kdakun
            WHERE a4.levels = 4
              AND LEFT(a4.kdakun, 1) IN ('1','2','3')
            ORDER BY a4.kdakun ASC
        ", [$tglakhir]);
    }

    /**
     * Ambil laba rugi sebelum tanggal tertentu (akumulasi s/d < $tglawal).
     */
    public function getLabaRugiSebelum($tglawal)
    {
        $result = DB::select("
            SELECT
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '4' THEN (jd.kredit - jd.debet) ELSE 0 END) AS pendapatan,
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '6' THEN (jd.debet - jd.kredit) ELSE 0 END) AS hpp,
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '5' THEN (jd.debet - jd.kredit) ELSE 0 END) AS beban
            FROM jurnaldetail jd
            JOIN jurnal j ON j.idjurnal = jd.idjurnal
            WHERE j.tgljurnal < ?
              AND (j.jenis IS NULL OR j.jenis <> 'Jurnal Penyesuaian')
        ", [$tglawal]);

        $pendapatan = (float) ($result[0]->pendapatan ?? 0);
        $hpp        = (float) ($result[0]->hpp ?? 0);
        $beban      = (float) ($result[0]->beban ?? 0);

        return $pendapatan - $hpp - $beban;
    }

    /**
     * Ambil laba rugi periode tertentu (BETWEEN $tglawal AND $tglakhir).
     */
    public function getLabaRugiPeriode($tglawal, $tglakhir)
    {
        $result = DB::select("
            SELECT
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '4' THEN (jd.kredit - jd.debet) ELSE 0 END) AS pendapatan,
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '6' THEN (jd.debet - jd.kredit) ELSE 0 END) AS hpp,
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '5' THEN (jd.debet - jd.kredit) ELSE 0 END) AS beban
            FROM jurnaldetail jd
            JOIN jurnal j ON j.idjurnal = jd.idjurnal
            WHERE j.tgljurnal BETWEEN ? AND ?
              AND (j.jenis IS NULL OR j.jenis <> 'Jurnal Penyesuaian')
        ", [$tglawal, $tglakhir]);

        $pendapatan = (float) ($result[0]->pendapatan ?? 0);
        $hpp        = (float) ($result[0]->hpp ?? 0);
        $beban      = (float) ($result[0]->beban ?? 0);

        return $pendapatan - $hpp - $beban;
    }

    /**
     * Ambil laba/rugi bersih s/d $tglakhir (akun pendapatan, beban, HPP).
     * Digunakan untuk menampilkan Laba/Rugi Berjalan di sisi Ekuitas neraca.
     */
    public function getLabaRugiSampaiDengan($tglakhir)
    {
        $result = DB::select("
            SELECT
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '4' THEN (jd.kredit - jd.debet) ELSE 0 END) AS pendapatan,
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '6' THEN (jd.debet - jd.kredit) ELSE 0 END) AS hpp,
                SUM(CASE WHEN LEFT(jd.kdakun, 1) = '5' THEN (jd.debet - jd.kredit) ELSE 0 END) AS beban
            FROM jurnaldetail jd
            JOIN jurnal j ON j.idjurnal = jd.idjurnal
            WHERE j.tgljurnal <= ?
              AND (j.jenis IS NULL OR j.jenis <> 'Jurnal Penyesuaian')
        ", [$tglakhir]);

        $pendapatan = (float) ($result[0]->pendapatan ?? 0);
        $hpp        = (float) ($result[0]->hpp ?? 0);
        $beban      = (float) ($result[0]->beban ?? 0);

        return $pendapatan - $hpp - $beban;
    }
}
