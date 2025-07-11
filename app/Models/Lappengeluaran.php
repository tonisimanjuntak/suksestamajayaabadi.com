<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lappengeluaran extends Model
{
    use HasFactory;


    public function getPengeluaran($tglawal, $tglakhir, $carabayar)
    {
        $where = " where tglpengeluaran between '$tglawal' and '$tglakhir' ";
        if (!empty($carabayar) && $carabayar != "-") {
            $where .= " and carabayar = '$carabayar' ";
        }

        return DB::select("select * from v_pengeluaran" . $where);
    }
}
