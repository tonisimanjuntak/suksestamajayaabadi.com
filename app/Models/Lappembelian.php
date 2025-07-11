<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lappembelian extends Model
{
    use HasFactory;

    public function getPembelian($tglawal, $tglakhir, $idsupplier, $carabayar, $idpembelian)
    {
        $where = " where tglfaktur between '$tglawal' and '$tglakhir' ";
        if (!empty($idsupplier) && $idsupplier != "-") {
            $where .= " and idsupplier = '$idsupplier' ";
        }
        if (!empty($carabayar) && $carabayar != "-") {
            $where .= " and carabayar = '$carabayar' ";
        }
        if (!empty($idpembelian) && $idpembelian != "-") {
            $where .= " and idpembelian = '$idpembelian' ";
        }

        return DB::select("select * from v_pembeliandetail_laporan" . $where . " order by tglfaktur");
    }
}
