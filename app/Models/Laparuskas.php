<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laparuskas extends Model
{
    use HasFactory;

    /**
     * Ambil saldo awal kas & bank (sebelum periode).
     * Kas & Bank = akun level 4 dengan parent L3 = 1.1.01
     */
    public function getSaldoAwalKas($tglawal)
    {
        return DB::select("
            SELECT
                COALESCE(SUM(jd.debet), 0)  AS total_debet,
                COALESCE(SUM(jd.kredit), 0) AS total_kredit
            FROM jurnaldetail jd
            JOIN jurnal j ON j.idjurnal = jd.idjurnal
            JOIN akun a  ON a.kdakun = jd.kdakun
            WHERE a.kdparent = '1.1.01'
              AND a.levels = 4
              AND j.tgljurnal < ?
        ", [$tglawal]);
    }

    /**
     * Ambil seluruh mutasi kas & bank pada periode, grouped by jenis jurnal dan akun lawan.
     * Mengembalikan setiap baris jurnaldetail yang melibatkan akun kas/bank (1.1.01.xx)
     * beserta detail akun lawan pada jurnal yang sama.
     */
    public function getArusKas($tglawal, $tglakhir)
    {
        return DB::select("
            SELECT
                j.idjurnal,
                j.tgljurnal,
                j.jenis,
                j.keterangan,
                kas.kdakun      AS kdakun_kas,
                kas_akun.namaakun AS namaakun_kas,
                kas.debet       AS kas_debet,
                kas.kredit      AS kas_kredit,
                lawan.kdakun    AS kdakun_lawan,
                lawan_akun.namaakun AS namaakun_lawan,
                lawan_akun.kdparent AS kdparent_lawan,
                lawan.debet     AS lawan_debet,
                lawan.kredit    AS lawan_kredit
            FROM jurnaldetail kas
            JOIN jurnal j ON j.idjurnal = kas.idjurnal
            JOIN akun kas_akun ON kas_akun.kdakun = kas.kdakun
            JOIN jurnaldetail lawan ON lawan.idjurnal = kas.idjurnal
                AND lawan.idjurnaldetail != kas.idjurnaldetail
            JOIN akun lawan_akun ON lawan_akun.kdakun = lawan.kdakun
            WHERE kas_akun.kdparent = '1.1.01'
              AND kas_akun.levels = 4
              AND lawan_akun.kdparent != '1.1.01'
              AND j.tgljurnal BETWEEN ? AND ?
            ORDER BY j.tgljurnal ASC, j.idjurnal ASC
        ", [$tglawal, $tglakhir]);
    }

    /**
     * Klasifikasi akun lawan ke kategori arus kas.
     * Return: 'operasi', 'investasi', 'pendanaan'
     */
    public static function klasifikasiAkun($kdakun)
    {
        $prefix1 = substr($kdakun, 0, 1);
        $prefix3 = substr($kdakun, 0, 3);

        // Aset Tidak Lancar (1.2.xx) = Investasi
        if ($prefix3 === '1.2') {
            return 'investasi';
        }

        // Modal (3.x) = Pendanaan
        if ($prefix1 === '3') {
            return 'pendanaan';
        }

        // Utang Jangka Panjang (2.1.xx) = Pendanaan
        if ($prefix3 === '2.1') {
            return 'pendanaan';
        }

        // Sisanya = Operasi (Piutang, Utang Dagang, Pendapatan, Beban, HPP, Persediaan, Pajak, dll)
        return 'operasi';
    }
}
