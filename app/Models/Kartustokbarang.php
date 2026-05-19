<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Kartustokbarang extends Model
{
    use HasFactory;

    protected $table = 'v_riwayatstok';
    protected $primaryKey = 'idbarang';
    protected $keyType = 'char';

    public $timestamps = false; // Menonaktifkan timestamps
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [];
    protected $hidden = [];
    var $App;

    public function __construct()
    {
        parent::__construct();
    }
    

    public function getKartuStok($idbarang, $tglawal, $tglakhir)
    {

        $query = DB::table('v_riwayatstok')
                    ->where('idbarang', $idbarang)
                    ->whereRaw("CAST(tglriwayat AS DATE) BETWEEN ? AND ?", [$tglawal, $tglakhir])
                    ->orderBy('idriwayat', 'asc');
                    
        return $query->get();
    }

    public function getKartuStokLimit100($idbarang)
    {

        $query = DB::table('v_riwayatstok')
                    ->where('idbarang', $idbarang)
                    ->limit(100)
                    ->orderBy('idriwayat', 'desc');
                    
        return $query->get();
    }
}
