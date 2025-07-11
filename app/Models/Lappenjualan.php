<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lappenjualan extends Model
{
    use HasFactory;

    public function allView()
    {
        return DB::table('v_penjualan')->get();
    }

    public function getPenjualan($tglawal, $tglakhir, $idkonsumen, $idkasir, $carabayar, $idsales, $idwilayah, $idpenjualan)
    {
        $where = " where tglinvoice between '$tglawal' and '$tglakhir' ";
        if (!empty($idkonsumen) && $idkonsumen != "-") {
            $where .= " and idkonsumen = '$idkonsumen' ";
        }
        if (!empty($idkasir) && $idkasir != "-") {
            $where .= " and idpengguna = '$idkasir' ";
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

        return DB::select("select * from v_penjualan" . $where);
    }
}
