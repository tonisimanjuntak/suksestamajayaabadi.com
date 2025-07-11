<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapbukubesar extends Model
{
    use HasFactory;

    public function allView()
    {
        return DB::table('jurnal')->get();
    }

    public function getJurnal($tglawal, $tglakhir, $kdakun)
    {
        return DB::table('v_jurnaldetail')
            ->whereBetween("tgljurnal", [$tglawal, $tglakhir])
            ->where("kdakun", $kdakun)
            ->orderBy('tgljurnal', 'ASC')
            ->orderBy('idjurnal', 'ASC')
            ->orderBy('urut', 'ASC')
            ->get();
    }

    public function getSaldoAwal($tglawal, $kdakun)
    {
        $saldoNormal = get_saldo_normal($kdakun);

        $totalDebet = DB::table('v_jurnaldetail')
            ->where("tgljurnal", "<", $tglawal)
            ->where("kdakun", $kdakun)
            ->whereRaw("year(tgljurnal) = ?", [$tglawal])
            ->sum('debet');

        $totalKredit = DB::table('v_jurnaldetail')
            ->where("tgljurnal", "<", $tglawal)
            ->where("kdakun", $kdakun)
            ->whereRaw("year(tgljurnal) = ?", [$tglawal])
            ->sum('kredit');
        if ($saldoNormal == 'D') {
            $total = $totalDebet - $totalKredit;
        } else {
            $total = $totalKredit - $totalDebet;
        }
        return $total;
    }


    public function getSaldoAkhir($tglakhir, $kdakun)
    {
        $saldoNormal = get_saldo_normal($kdakun);

        $totalDebet = DB::table('v_jurnaldetail')
            ->where("tgljurnal", "<=", $tglakhir)
            ->whereRaw("year(tgljurnal) = ?", [$tglakhir])
            ->where("kdakun", $kdakun)
            ->sum('debet');

        $totalKredit = DB::table('v_jurnaldetail')
            ->where("tgljurnal", "<=", $tglakhir)
            ->where("kdakun", $kdakun)
            ->whereRaw("year(tgljurnal) = ?", [$tglakhir])
            ->sum('kredit');
        if ($saldoNormal == 'D') {
            $total = $totalDebet - $totalKredit;
        } else {
            $total = $totalKredit - $totalDebet;
        }
        return $total;
    }
}
