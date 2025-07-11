<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laplabarugi extends Model
{
    use HasFactory;

    public function allView()
    {
        return DB::table('jurnal')->get();
    }

    public function getJurnal($tglawal, $tglakhir)
    {
        return DB::select("select * from jurnal where tgljurnal between '$tglawal' and '$tglakhir'");
    }

    public function getTotalPenjualan($tglawal, $tglakhir)
    {
        return DB::select("select sum(totalhargajual) as total from penjualan where tglpenjualan between '$tglawal' and '$tglakhir'")[0]->total;
    }

    public function getTotalPembelian($tglawal, $tglakhir)
    {
        return DB::select("SELECT SUM(jumlahjual*hargabeli) AS total FROM v_penjualandetail where tglpenjualan between '$tglawal' and '$tglakhir'")[0]->total;
    }

    public function getTotalStockAdjustment($tglawal, $tglakhir)
    {
        return DB::select("select sum((stoksebelumadjustment-jumlahadjustment)*nominaladjustment) as total from stockadjustment where tglstockadjustment between '$tglawal' and '$tglakhir' and jumlahadjustment < stoksebelumadjustment")[0]->total;
    }

    public function getJurnalPenjualanByNamaJurnal($tglawal, $tglakhir, $namajurnal)
    {
        return DB::select("SELECT sum(debet) as debet, sum(kredit) as kredit FROM jurnal 
            WHERE (tgljurnal between '$tglawal' and '$tglakhir') and jenis='Penjualan' and UPPER(namajurnal) LIKE '" . strtoupper($namajurnal) . "%'");
    }

    public function getJurnalAdjustmentByNamaJurnal($tglawal, $tglakhir, $namajurnal)
    {
        return DB::select("SELECT sum(debet) as debet, sum(kredit) as kredit FROM jurnal 
            WHERE (tgljurnal between '$tglawal' and '$tglakhir') and jenis='Stock Adjustment' and UPPER(namajurnal) LIKE '" . strtoupper($namajurnal) . "%'");
    }

    public function getJurnalPembelianByNamaJurnal($tglawal, $tglakhir, $namajurnal)
    {
        return DB::select("SELECT sum(debet) as debet, sum(kredit) as kredit FROM jurnal 
            WHERE (tgljurnal between '$tglawal' and '$tglakhir') and jenis='Pembelian' and UPPER(namajurnal) LIKE '" . strtoupper($namajurnal) . "%'");
    }
}
