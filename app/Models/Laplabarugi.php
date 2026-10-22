<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laplabarugi extends Model
{
    use HasFactory;

    /**
     * Ambil saldo per akun level 4 dari jurnaldetail untuk rentang tanggal.
     * Return: collection dengan kdakun, namaakun, levels, kdparent_l1, kdparent_l2, kdparent_l3, debet, kredit
     */
    public function getLaporanLabaRugi($tglawal, $tglakhir)
    {
        return DB::select("
            SELECT
                a4.kdakun,
                a4.namaakun,
                a4.levels,
                a1.kdakun  AS kdparent_l1,
                a1.namaakun AS namaparent_l1,
                a2.kdakun  AS kdparent_l2,
                a2.namaakun AS namaparent_l2,
                a3.kdakun  AS kdparent_l3,
                a3.namaakun AS namaparent_l3,
                COALESCE(trans.debet,  0) AS debet,
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
                WHERE j.tgljurnal BETWEEN '$tglawal' AND '$tglakhir'
                  AND (j.jenis IS NULL OR j.jenis <> 'Jurnal Penyesuaian')
                GROUP BY jd.kdakun
            ) trans ON trans.kdakun = a4.kdakun
            WHERE a4.levels = 4
              AND LEFT(a4.kdakun, 1) IN ('4','5','6')
            ORDER BY a4.kdakun
        ");
    }
}
