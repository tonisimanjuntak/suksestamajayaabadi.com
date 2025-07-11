<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lappenagihansales extends Model
{
    use HasFactory;


    public function getPenagihan($idsales)
    {
        $tahun = date('Y');

        return DB::table("v_piutang_penagihan_laporan")
            ->where("idsales", $idsales)
            ->whereRaw("year(tglinvoice) = $tahun ")
            ->orderBy('namakonsumen', 'desc')
            ->get();
    }
}
