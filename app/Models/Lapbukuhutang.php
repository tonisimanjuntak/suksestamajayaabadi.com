<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lapbukuhutang extends Model
{
    use HasFactory;

    public function getHutangDetail($statusLunasOption, $idsupplier, $idpembelian)
    {

        if ($idsupplier != "-") {
            $query = DB::table('v_hutangdetail_laporan')
                ->where('idsupplier', $idsupplier);
        } else {
            $query = DB::table('v_hutangdetail_laporan');
        }


        // Tambahkan kondisi berdasarkan status lunas
        if ($statusLunasOption == 'Belum') {
            $query->whereRaw('totalkredit > totaldebet');
        } elseif ($statusLunasOption == 'Sudah') {
            $query->whereRaw('totalkredit <= totaldebet');
        }

        // Tambahkan kondisi berdasarkan idpembelian
        if ($idpembelian != "-") {
            $query->where('idpembelian', $idpembelian);
        }

        $query->orderBy('idpembelian', 'ASC');
        $query->orderBy('idhutang', 'ASC');
        return $query->get();
    }

    public function getTotal($statusLunasOption, $idsupplier, $idpembelian)
    {
        if ($idsupplier != "-") {
            $query = DB::table('v_hutang')
                ->where('idsupplier', $idsupplier)
                ->selectRaw('SUM(totaldebet) as totaldebet, SUM(totalkredit) as totalkredit');
        } else {
            $query = DB::table('v_hutang')
                ->selectRaw('SUM(totaldebet) as totaldebet, SUM(totalkredit) as totalkredit');
        }


        // Tambahkan kondisi berdasarkan status lunas
        if ($statusLunasOption == 'Belum') {
            $query->whereRaw('totalkredit > totaldebet');
        } elseif ($statusLunasOption == 'Sudah') {
            $query->whereRaw('totalkredit <= totaldebet');
        }

        // Tambahkan kondisi berdasarkan idpembelian
        if ($idpembelian != "-") {
            $query->where('idpembelian', $idpembelian);
        }

        // Eksekusi query dan kembalikan hasil pertama (1 row)
        return $query->first();
    }
}
