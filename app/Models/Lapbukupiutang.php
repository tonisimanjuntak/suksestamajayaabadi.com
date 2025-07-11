<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lapbukupiutang extends Model
{
    use HasFactory;

    public function getHutangDetail($statusLunasOption, $idkonsumen, $idsales, $idwilayah, $idpenjualan)
    {
        $query = DB::table('v_piutangdetail_laporan');

        // Tambahkan kondisi berdasarkan status lunas
        if ($statusLunasOption == 'Belum') {
            $query->whereRaw('totaldebet > totalkredit');
        } elseif ($statusLunasOption == 'Sudah') {
            $query->whereRaw('totaldebet <= totalkredit');
        }

        if ($idkonsumen != "-") {
            $query->where('idkonsumen', $idkonsumen);
        }

        if ($idsales != "-") {
            $query->where('idsales', $idsales);
        }

        if ($idwilayah != "-") {
            $query->where('idwilayah', $idwilayah);
        }

        if ($idpenjualan != "-") {
            $query->where('idpenjualan', $idpenjualan);
        }

        $query->orderBy('idpenjualan', 'ASC');
        $query->orderBy('idpiutang', 'ASC');
        return $query->get();
    }
}
