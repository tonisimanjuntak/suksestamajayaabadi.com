<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Laprekaphutang extends Model
{
    use HasFactory;

    public function getLaporan($statusLunasOption, $idsupplier, $idpembelian)
    {

        if ($idsupplier != "-") {
            $query = DB::table('v_hutang_laprekap')
                ->where('idsupplier', $idsupplier);
        } else {
            $query = DB::table('v_hutang_laprekap');
        }


        // Tambahkan kondisi berdasarkan status lunas
        if ($statusLunasOption == 'Belum') {
            $query->whereRaw('jumlahhutang > jumlahdibayar');
        } elseif ($statusLunasOption == 'Sudah') {
            $query->whereRaw('jumlahhutang <= jumlahdibayar');
        }

        // Tambahkan kondisi berdasarkan idpembelian
        if ($idpembelian != "-") {
            $query->where('idpembelian', $idpembelian);
        }

        $query->orderBy('tglhutang', 'ASC');
        $query->orderBy('idhutang', 'ASC');
        return $query->get();
    }
}
