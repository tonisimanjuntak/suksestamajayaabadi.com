<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lapreturpembelian extends Model
{
    use HasFactory;

    public function getRetur($tglawal, $tglakhir, $idsupplier, $carabayar, $idpembelian, $statusretur)
    {
        $where = " where tglpengajuan between '$tglawal' and '$tglakhir' ";
        if (!empty($idsupplier) && $idsupplier != "-") {
            $where .= " and idsupplier = '$idsupplier' ";
        }
        if (!empty($carabayar) && $carabayar != "-") {
            $where .= " and carabayar = '$carabayar' ";
        }
        if (!empty($idpembelian) && $idpembelian != "-") {
            $where .= " and idpembelian = '$idpembelian' ";
        }
        if (!empty($statusretur) && $statusretur != "-") {
            $where .= " and statusretur = '$statusretur' ";
        }

        return DB::select("select * from v_returpembeliandetail_laporan" . $where . " order by tglpengajuan, idpembelian desc");
    }
}
