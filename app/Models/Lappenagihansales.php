<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lappenagihansales extends Model
{
    use HasFactory;


    public function getPenagihan($idsales, $statuslunas, $tglawal, $tglakhir)
    {
        $query = DB::table("v_piutang_penagihan_belumlunas")
            ->where("idsales", $idsales)
            ->whereRaw("tglinvoice BETWEEN '$tglawal' AND '$tglakhir'")
            ->orderBy('namakonsumen', 'desc');

        if (!empty($statuslunas) && $statuslunas != null) {
            if ($statuslunas == 'Lunas') {
                $query->whereRaw("tgllunas IS NOT NULL");
            }else{
                $query->whereRaw("tgllunas IS NULL");
            }
        }
        return $query->get();
    }

    
}
