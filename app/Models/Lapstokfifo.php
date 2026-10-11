<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lapstokfifo extends Model
{
    use HasFactory;

    protected $table = 'stokfifo';
    protected $primaryKey = 'idstokfifo';
    public $incrementing = false;
    protected $keyType = 'char';
    public $timestamps = false;

    /**
     * Query data stok FIFO dengan relasi barang dan satuan
     */
    public function getStokFifoQuery($tglawal = null, $tglakhir = null, $idbarang = null)
    {
        $query = DB::table('stokfifo as sf')
            ->leftJoin('barang as b', 'sf.idbarang', '=', 'b.idbarang')
            ->leftJoin('satuan as s', 'b.idsatuan', '=', 's.idsatuan')
            ->select([
                'sf.idstokfifo',
                'sf.idtransaksi',
                'sf.tglmasuk',
                'sf.idbarang',
                'sf.jumlahmasuk',
                'sf.jumlahsisa',
                DB::raw('(sf.jumlahmasuk - sf.jumlahsisa) as jumlahterpakai'),
                'sf.hargasatuan',
                'sf.hargadpp',
                'sf.jumlahppn',
                'sf.jumlahdiskon',
                'sf.nilaihpp',
                DB::raw('(sf.jumlahsisa * sf.nilaihpp) as totalsisa'),
                'sf.keterangan',
                'sf.jenistransaksi',
                'sf.inserted_date',
                'b.kdbarang',
                'b.namabarang',
                's.namasatuan',
            ]);

        if (!empty($tglawal) && !empty($tglakhir)) {
            $query->whereBetween('sf.tglmasuk', [$tglawal, $tglakhir]);
        } elseif (!empty($tglawal)) {
            $query->where('sf.tglmasuk', '>=', $tglawal);
        } elseif (!empty($tglakhir)) {
            $query->where('sf.tglmasuk', '<=', $tglakhir);
        }

        if (!empty($idbarang) && $idbarang != '-') {
            $query->where('sf.idbarang', $idbarang);
        }

        return $query;
    }
}
