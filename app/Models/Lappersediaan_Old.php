<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Lappersediaan extends Model
{
    use HasFactory;

    public function allView()
    {
        return DB::table('v_penjualan')->get();
    }

    public function getPersediaan($idkategori)
    {

        $query = DB::table('v_barang');
        $query->where('statusaktif', 'Aktif');

        if (!empty($idkategori) && $idkategori != "-") {
            $query->where('idkategori', $idkategori);
        }


        return $query->get();
    }
}
