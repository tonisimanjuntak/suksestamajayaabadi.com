<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lapjurnal extends Model
{
    use HasFactory;

    public function allView()
    {
        return DB::table('jurnal')->get();
    }

    public function getJurnal($tglawal, $tglakhir)
    {
        return DB::table('v_jurnaldetail')
            ->whereBetween("tgljurnal", [$tglawal, $tglakhir])
            ->orderBy('tgljurnal', 'ASC')
            ->orderBy('idjurnal', 'ASC')
            ->orderBy('urut', 'ASC')
            ->get();
    }
}
