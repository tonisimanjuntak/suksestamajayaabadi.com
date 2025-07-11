<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Home extends Model
{
    use HasFactory;

    public function getTotalPembelian()
    {
        $total = DB::select("SELECT SUM(totalfaktur) AS total FROM pembelian WHERE tglfaktur = CAST( NOW() AS DATE)")[0]->total;
        if ($total == "" || $total == null) {
            $total = 0;
        }
        return $total;
    }

    public function getTotalPenjualan()
    {
        $total = DB::select("SELECT SUM(totalinvoice) AS total FROM penjualan WHERE tglinvoice = CAST( NOW() AS DATE)")[0]->total;
        if ($total == "" || $total == null) {
            $total = 0;
        }
        return $total;
    }

    public function getTotalUtang()
    {
        $total = DB::select("SELECT SUM(kredit) AS total FROM hutangdetail WHERE tglhutang = CAST( NOW() AS DATE)")[0]->total;
        if ($total == "" || $total == null) {
            $total = 0;
        }
        return $total;
    }

    public function getTotalPiutang()
    {
        $total = DB::select("SELECT SUM(debet) AS total FROM piutangdetail WHERE tglpiutang = CAST( NOW() AS DATE)")[0]->total;
        if ($total == "" || $total == null) {
            $total = 0;
        }
        return $total;
    }

    public function getInfoGrafikPenjualan()
    {
        $tahun = date('Y');

        return DB::select("
            SELECT SUM( CASE WHEN MONTH(tglinvoice)=1 THEN totalinvoice ELSE 0 END) AS bulan01,
                SUM( CASE WHEN MONTH(tglinvoice)=2 THEN totalinvoice ELSE 0 END) AS bulan02,
                SUM( CASE WHEN MONTH(tglinvoice)=3 THEN totalinvoice ELSE 0 END) AS bulan03,
                SUM( CASE WHEN MONTH(tglinvoice)=4 THEN totalinvoice ELSE 0 END) AS bulan04,
                SUM( CASE WHEN MONTH(tglinvoice)=5 THEN totalinvoice ELSE 0 END) AS bulan05,
                SUM( CASE WHEN MONTH(tglinvoice)=6 THEN totalinvoice ELSE 0 END) AS bulan06,
                SUM( CASE WHEN MONTH(tglinvoice)=7 THEN totalinvoice ELSE 0 END) AS bulan07,
                SUM( CASE WHEN MONTH(tglinvoice)=8 THEN totalinvoice ELSE 0 END) AS bulan08,
                SUM( CASE WHEN MONTH(tglinvoice)=9 THEN totalinvoice ELSE 0 END) AS bulan09,
                SUM( CASE WHEN MONTH(tglinvoice)=10 THEN totalinvoice ELSE 0 END) AS bulan10,
                SUM( CASE WHEN MONTH(tglinvoice)=11 THEN totalinvoice ELSE 0 END) AS bulan11,
                SUM( CASE WHEN MONTH(tglinvoice)=12 THEN totalinvoice ELSE 0 END) AS bulan12
                    FROM penjualan
                        WHERE YEAR(tglinvoice) = '$tahun'
            ");
    }

    public function getInfoGrafikPembelian()
    {
        $tahun = date('Y');

        return DB::select("
            SELECT SUM( CASE WHEN MONTH(tglfaktur)=1 THEN totalfaktur ELSE 0 END) AS bulan01,
                SUM( CASE WHEN MONTH(tglfaktur)=2 THEN totalfaktur ELSE 0 END) AS bulan02,
                SUM( CASE WHEN MONTH(tglfaktur)=3 THEN totalfaktur ELSE 0 END) AS bulan03,
                SUM( CASE WHEN MONTH(tglfaktur)=4 THEN totalfaktur ELSE 0 END) AS bulan04,
                SUM( CASE WHEN MONTH(tglfaktur)=5 THEN totalfaktur ELSE 0 END) AS bulan05,
                SUM( CASE WHEN MONTH(tglfaktur)=6 THEN totalfaktur ELSE 0 END) AS bulan06,
                SUM( CASE WHEN MONTH(tglfaktur)=7 THEN totalfaktur ELSE 0 END) AS bulan07,
                SUM( CASE WHEN MONTH(tglfaktur)=8 THEN totalfaktur ELSE 0 END) AS bulan08,
                SUM( CASE WHEN MONTH(tglfaktur)=9 THEN totalfaktur ELSE 0 END) AS bulan09,
                SUM( CASE WHEN MONTH(tglfaktur)=10 THEN totalfaktur ELSE 0 END) AS bulan10,
                SUM( CASE WHEN MONTH(tglfaktur)=11 THEN totalfaktur ELSE 0 END) AS bulan11,
                SUM( CASE WHEN MONTH(tglfaktur)=12 THEN totalfaktur ELSE 0 END) AS bulan12
                    FROM pembelian
                        WHERE YEAR(tglfaktur) = '$tahun'
            ");
    }
}
