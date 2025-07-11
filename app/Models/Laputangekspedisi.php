<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Laputangekspedisi extends Model
{
    use HasFactory;

    public function getLaporan($statusLunasOption, $idekspedisi)
    {

        if ($idekspedisi != "-") {
            $query = DB::table('v_hutangekspedisi')
                ->where('idekspedisi', $idekspedisi);
        } else {
            $query = DB::table('v_hutangekspedisi');
        }


        // Tambahkan kondisi berdasarkan status lunas
        if ($statusLunasOption == 'Belum') {
            $query->whereRaw('kredit > debet');
        } elseif ($statusLunasOption == 'Sudah') {
            $query->whereRaw('kredit <= debet');
        }

        $query->orderBy('tglhutang', 'ASC');
        $query->orderBy('idhutangekspedisi', 'ASC');
        return $query->get();
    }
}
