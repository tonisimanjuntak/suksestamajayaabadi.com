<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Laprekappiutang extends Model
{
    use HasFactory;

    public function getLaporan($statusLunasOption, $idkonsumen, $idsales, $idwilayah, $idpenjualan)
    {
        $query = DB::table('v_piutang_laprekap');

        // Tambahkan kondisi berdasarkan status lunas
        if ($statusLunasOption == 'Belum') {
            $query->whereRaw('jumlahpiutang > jumlahdibayar');
        } elseif ($statusLunasOption == 'Sudah') {
            $query->whereRaw('jumlahpiutang <= jumlahdibayar');
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

        $query->orderBy('tglpiutang', 'ASC');
        $query->orderBy('idpiutang', 'ASC');
        return $query->get();
    }
}
