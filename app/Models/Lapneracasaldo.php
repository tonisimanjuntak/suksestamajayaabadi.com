<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lapneracasaldo extends Model
{
    use HasFactory;


    public function getSaldoJurnal($tglawal, $tglakhir)
    {
        return DB::select("SELECT akun.kdakun, akun.namaakun, 
                            (SELECT SUM(v_jurnaldetail.debet) FROM v_jurnaldetail 
                                WHERE v_jurnaldetail.kdparent = akun.kdakun AND v_jurnaldetail.tgljurnal BETWEEN '$tglawal' AND '$tglakhir') AS debet,
                            (SELECT SUM(v_jurnaldetail.kredit) FROM v_jurnaldetail 
                                WHERE v_jurnaldetail.kdparent = akun.kdakun AND v_jurnaldetail.tgljurnal BETWEEN '$tglawal' AND '$tglakhir') AS kredit
                            FROM akun 
                            WHERE akun.levels = 3 order by kdakun");
    }
}
