<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lapreturpenjualan extends Model
{
    use HasFactory;

    public function getRetur($tglawal, $tglakhir, $idkonsumen, $carabayar, $idsales, $idwilayah, $idpenjualan)
    {
        $where = " where tglretur between '$tglawal' and '$tglakhir' ";
        if (!empty($idkonsumen) && $idkonsumen != "-") {
            $where .= " and idkonsumen = '$idkonsumen' ";
        }
        if (!empty($carabayar) && $carabayar != "-") {
            $where .= " and carabayar = '$carabayar' ";
        }
        if (!empty($idsales) && $idsales != "-") {
            $where .= " and idsales = '$idsales' ";
        }
        if (!empty($idwilayah) && $idwilayah != "-") {
            $where .= " and idwilayah = '$idwilayah' ";
        }
        if (!empty($idpenjualan) && $idpenjualan != "-") {
            $where .= " and idpenjualan = '$idpenjualan' ";
        }

        return DB::select("select * from v_returpenjualandetail_laporan " . $where . " order by tglretur");
    }
}
