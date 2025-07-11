<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Lapbonussales extends Model
{
    use HasFactory;


    public function getBonusSales($tglawal, $tglakhir, $idsales)
    {
        $where = " where tglbonus between '$tglawal' and '$tglakhir' ";
        if (!empty($idsales) && $idsales != "-") {
            $where .= " and idsales = '$idsales' ";
        }
        return DB::select("select * from v_bonus" . $where);
    }
}
