<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lappenjualandetail extends Model
{
    use HasFactory;

    public function allView()
    {
        return DB::table('v_penjualan')->get();
    }

    public function getPenjualan($tglawal, $tglakhir, $idkonsumen, $idkasir, $carabayar, $idsales, $idwilayah, $idpenjualan)
    {
        $where = " where v_penjualan.tglinvoice between '$tglawal' and '$tglakhir' ";
        if (!empty($idkonsumen) && $idkonsumen != "-") {
            $where .= " and v_penjualan.idkonsumen = '$idkonsumen' ";
        }
        if (!empty($idkasir) && $idkasir != "-") {
            $where .= " and v_penjualan.idpengguna = '$idkasir' ";
        }

        if (!empty($carabayar) && $carabayar != "-") {
            $where .= " and v_penjualan.carabayar = '$carabayar' ";
        }

        if (!empty($idsales) && $idsales != "-") {
            $where .= " and v_penjualan.idsales = '$idsales' ";
        }

        if (!empty($idwilayah) && $idwilayah != "-") {
            $where .= " and v_penjualan.idwilayah = '$idwilayah' ";
        }

        if (!empty($idpenjualan) && $idpenjualan != "-") {
            $where .= " and v_penjualan.idpenjualan = '$idpenjualan' ";
        }

        return DB::select("select v_penjualan.*, v_piutang.tglpiutang, v_piutang.tgljatuhtempo, v_piutang.totaldebet, v_piutang.totalkredit, v_piutang.tgllunas  from v_penjualan
                            LEFT JOIN v_piutang on v_penjualan.idpenjualan = v_piutang.idpenjualan
                        " . $where . " order by v_penjualan.tglinvoice, v_penjualan.noinvoice");
    }


    public function getPenjualanBySales($tglawal, $tglakhir, $idkonsumen, $idkasir, $carabayar, $idsales, $idwilayah, $idpenjualan)
    {
        $where = " where v_penjualandetail_laporan2.tglinvoice between '$tglawal' and '$tglakhir' ";
        if (!empty($idkonsumen) && $idkonsumen != "-") {
            $where .= " and v_penjualandetail_laporan2.idkonsumen = '$idkonsumen' ";
        }
        if (!empty($idkasir) && $idkasir != "-") {
            $where .= " and v_penjualandetail_laporan2.idpengguna = '$idkasir' ";
        }

        if (!empty($carabayar) && $carabayar != "-") {
            $where .= " and v_penjualandetail_laporan2.carabayar = '$carabayar' ";
        }

        if (!empty($idsales) && $idsales != "-") {
            $where .= " and v_penjualandetail_laporan2.idsales = '$idsales' ";
        }

        if (!empty($idwilayah) && $idwilayah != "-") {
            $where .= " and v_penjualandetail_laporan2.idwilayah = '$idwilayah' ";
        }

        if (!empty($idpenjualan) && $idpenjualan != "-") {
            $where .= " and v_penjualandetail_laporan2.idpenjualan = '$idpenjualan' ";
        }

        return DB::select("select v_penjualandetail_laporan2.* from v_penjualandetail_laporan2 " . $where . " order by v_penjualandetail_laporan2.namasales, v_penjualandetail_laporan2.tglinvoice, v_penjualandetail_laporan2.noinvoice");
    }
}
