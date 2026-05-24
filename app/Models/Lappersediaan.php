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

    public function getPersediaanByTanggal($tglriwayat, $where, $orderby, $limit, $start, $searchValue = null)
    {
        /*
            KETERANGAN
            =================================

            DATE(tglriwayat) <= '2006-03-01'  -- Memfilter transaksi yang terjadi sebelum atau pada tanggal yang ditentukan.

            ROW_NUMBER() ... ORDER BY tglriwayat DESC  -- Memberi nomor urut untuk setiap barang, dimulai dari transaksi terbaru (nomor 1).

            COALESCE(..., 0) -- Jika barang belum pernah memiliki transaksi sampai tanggal tersebut, stok dianggap 0.

        */
        
        // Query dasar tanpa LIMIT & OFFSET
        $sql = "
            SELECT 
                b.idbarang,
                b.namabarang,
                b.hargabeli,
                b.hargajualdiskon,
                b.idkategori,
                k.namakategori,
                COALESCE(r.stokakhir, 0) AS stok
            FROM barang b
            LEFT JOIN kategoribarang k ON k.idkategori = b.idkategori
            LEFT JOIN (
                SELECT 
                    idbarang,
                    stokakhir,
                    ROW_NUMBER() OVER (PARTITION BY idbarang ORDER BY tglriwayat DESC, idriwayat DESC) AS rn
                FROM riwayatstok
                WHERE DATE(tglriwayat) <= :tglriwayat
            ) r ON b.idbarang = r.idbarang AND r.rn = 1
            $where
            $orderby
        ";

        // Tambahkan LIMIT dan OFFSET hanya jika $limit dan $start diberikan (tidak null)
        if ($limit !== null && $start !== null) {
            $sql .= " LIMIT :limit OFFSET :start";
        }

        // Parameter binding
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

    // Hitung total barang setelah filter pencarian (tanpa LIMIT)
    public function getTotalFiltered($tglriwayat, $where)
    {
        $query = "
            SELECT COUNT(*) as total
            FROM barang b
            LEFT JOIN kategoribarang k ON k.idkategori = b.idkategori
            LEFT JOIN (
                SELECT 
                    idbarang,
                    ROW_NUMBER() OVER (PARTITION BY idbarang ORDER BY tglriwayat DESC, idriwayat DESC) AS rn
                FROM riwayatstok
                WHERE DATE(tglriwayat) <= :tglriwayat
            ) r ON b.idbarang = r.idbarang AND r.rn = 1
            $where
        ";
        $result = DB::select($query, ['tglriwayat' => $tglriwayat]);
        return $result[0]->total;
    }
}
