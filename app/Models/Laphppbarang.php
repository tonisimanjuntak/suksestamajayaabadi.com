<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laphppbarang extends Model
{
    use HasFactory;

    public function getHppBarangByTanggal($tglriwayat, $where, $orderby, $limit, $start)
    {
        $sql = "
            SELECT 
                b.idbarang,
                COALESCE(NULLIF(b.kdbarang, ''), b.idbarang) AS kdbarang,
                b.namabarang,
                b.idkategori,
                k.namakategori,
                COALESCE(r.stokakhir, 0) AS kuantitas,
                COALESCE(r.nilaihpp, 0) AS biayaratarata,
                (COALESCE(r.stokakhir, 0) * COALESCE(r.nilaihpp, 0)) AS totalbiaya
            FROM barang b
            LEFT JOIN kategoribarang k ON k.idkategori = b.idkategori
            LEFT JOIN (
                SELECT 
                    idbarang,
                    stokakhir,
                    nilaihpp,
                    ROW_NUMBER() OVER (PARTITION BY idbarang ORDER BY tglriwayat DESC, idriwayat DESC) AS rn
                FROM riwayatstok
                WHERE DATE(tglriwayat) <= :tglriwayat
            ) r ON b.idbarang = r.idbarang AND r.rn = 1
            $where
            $orderby
        ";

        if ($limit !== null && $start !== null) {
            $sql .= " LIMIT :limit OFFSET :start";
        }

        $bindings = [
            'tglriwayat' => $tglriwayat,
        ];
        if ($limit !== null && $start !== null) {
            $bindings['limit'] = (int) $limit;
            $bindings['start'] = (int) $start;
        }

        return DB::select($sql, $bindings);
    }

    public function getTotalBarangAktif()
    {
        return DB::table('barang')->where('statusaktif', 'Aktif')->count();
    }

    public function getTotalFiltered($tglriwayat, $where)
    {
        $query = "
            SELECT COUNT(*) as total
            FROM barang b
            LEFT JOIN kategoribarang k ON k.idkategori = b.idkategori
            $where
        ";
        $result = DB::select($query);
        return $result[0]->total;
    }
}
