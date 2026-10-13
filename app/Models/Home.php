<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Home extends Model
{
    use HasFactory;

    public function getTotalPembelian()
    {
        $total = DB::select("SELECT SUM(totalfaktur) AS total FROM pembelian WHERE tglfaktur = CAST( NOW() AS DATE)")[0]->total;
        if ($total == "" || $total == null) {
            $total = 0;
        }
        return $total;
    }

    public function getTotalPenjualan()
    {
        $total = DB::select("SELECT SUM(totalinvoice) AS total FROM penjualan WHERE tglinvoice = CAST( NOW() AS DATE)")[0]->total;
        if ($total == "" || $total == null) {
            $total = 0;
        }
        return $total;
    }

    public function getTotalUtang()
    {
        $total = DB::select("SELECT SUM(kredit) AS total FROM hutangdetail WHERE tglhutang = CAST( NOW() AS DATE)")[0]->total;
        if ($total == "" || $total == null) {
            $total = 0;
        }
        return $total;
    }

    public function getTotalPiutang()
    {
        $total = DB::select("SELECT SUM(debet) AS total FROM piutangdetail WHERE tglpiutang = CAST( NOW() AS DATE)")[0]->total;
        if ($total == "" || $total == null) {
            $total = 0;
        }
        return $total;
    }

    public function getInfoGrafikPenjualan()
    {
        $tahun = date('Y');

        return DB::select("
            SELECT SUM( CASE WHEN MONTH(tglinvoice)=1 THEN totalinvoice ELSE 0 END) AS bulan01,
                SUM( CASE WHEN MONTH(tglinvoice)=2 THEN totalinvoice ELSE 0 END) AS bulan02,
                SUM( CASE WHEN MONTH(tglinvoice)=3 THEN totalinvoice ELSE 0 END) AS bulan03,
                SUM( CASE WHEN MONTH(tglinvoice)=4 THEN totalinvoice ELSE 0 END) AS bulan04,
                SUM( CASE WHEN MONTH(tglinvoice)=5 THEN totalinvoice ELSE 0 END) AS bulan05,
                SUM( CASE WHEN MONTH(tglinvoice)=6 THEN totalinvoice ELSE 0 END) AS bulan06,
                SUM( CASE WHEN MONTH(tglinvoice)=7 THEN totalinvoice ELSE 0 END) AS bulan07,
                SUM( CASE WHEN MONTH(tglinvoice)=8 THEN totalinvoice ELSE 0 END) AS bulan08,
                SUM( CASE WHEN MONTH(tglinvoice)=9 THEN totalinvoice ELSE 0 END) AS bulan09,
                SUM( CASE WHEN MONTH(tglinvoice)=10 THEN totalinvoice ELSE 0 END) AS bulan10,
                SUM( CASE WHEN MONTH(tglinvoice)=11 THEN totalinvoice ELSE 0 END) AS bulan11,
                SUM( CASE WHEN MONTH(tglinvoice)=12 THEN totalinvoice ELSE 0 END) AS bulan12
                    FROM penjualan
                        WHERE YEAR(tglinvoice) = '$tahun'
            ");
    }

    public function getInfoGrafikPembelian()
    {
        $tahun = date('Y');

        return DB::select("
            SELECT SUM( CASE WHEN MONTH(tglfaktur)=1 THEN totalfaktur ELSE 0 END) AS bulan01,
                SUM( CASE WHEN MONTH(tglfaktur)=2 THEN totalfaktur ELSE 0 END) AS bulan02,
                SUM( CASE WHEN MONTH(tglfaktur)=3 THEN totalfaktur ELSE 0 END) AS bulan03,
                SUM( CASE WHEN MONTH(tglfaktur)=4 THEN totalfaktur ELSE 0 END) AS bulan04,
                SUM( CASE WHEN MONTH(tglfaktur)=5 THEN totalfaktur ELSE 0 END) AS bulan05,
                SUM( CASE WHEN MONTH(tglfaktur)=6 THEN totalfaktur ELSE 0 END) AS bulan06,
                SUM( CASE WHEN MONTH(tglfaktur)=7 THEN totalfaktur ELSE 0 END) AS bulan07,
                SUM( CASE WHEN MONTH(tglfaktur)=8 THEN totalfaktur ELSE 0 END) AS bulan08,
                SUM( CASE WHEN MONTH(tglfaktur)=9 THEN totalfaktur ELSE 0 END) AS bulan09,
                SUM( CASE WHEN MONTH(tglfaktur)=10 THEN totalfaktur ELSE 0 END) AS bulan10,
                SUM( CASE WHEN MONTH(tglfaktur)=11 THEN totalfaktur ELSE 0 END) AS bulan11,
                SUM( CASE WHEN MONTH(tglfaktur)=12 THEN totalfaktur ELSE 0 END) AS bulan12
                    FROM pembelian
                        WHERE YEAR(tglfaktur) = '$tahun'
            ");
    }

    public function loadRiwayatAktifitasAwal()
    {
        return DB::table('riwayataktifitas')
                ->orderBy('inserted_date', 'desc')
                ->limit(12)
                ->get();
    }

    public function loadRiwayatAktifitas($tglLoadRiwayat)
    {
        return DB::table('riwayataktifitas')
                ->where('inserted_date', '>', $tglLoadRiwayat)
                ->orderBy('inserted_date', 'desc')
                ->get();
    }

    public function getRingkasanInfoBox()
    {
        $penjualan = DB::select("
            SELECT 
                COUNT(CASE WHEN tglinvoice = CURDATE() THEN 1 END) AS hari_ini_jml,
                COALESCE(SUM(CASE WHEN tglinvoice = CURDATE() THEN totalinvoice ELSE 0 END), 0) AS hari_ini_total,
                COUNT(CASE WHEN YEAR(tglinvoice) = YEAR(CURDATE()) AND MONTH(tglinvoice) = MONTH(CURDATE()) THEN 1 END) AS bulan_ini_jml,
                COALESCE(SUM(CASE WHEN YEAR(tglinvoice) = YEAR(CURDATE()) AND MONTH(tglinvoice) = MONTH(CURDATE()) THEN totalinvoice ELSE 0 END), 0) AS bulan_ini_total
            FROM penjualan
        ")[0];

        $pembelian = DB::select("
            SELECT 
                COUNT(CASE WHEN tglfaktur = CURDATE() THEN 1 END) AS hari_ini_jml,
                COALESCE(SUM(CASE WHEN tglfaktur = CURDATE() THEN totalfaktur ELSE 0 END), 0) AS hari_ini_total,
                COUNT(CASE WHEN YEAR(tglfaktur) = YEAR(CURDATE()) AND MONTH(tglfaktur) = MONTH(CURDATE()) THEN 1 END) AS bulan_ini_jml,
                COALESCE(SUM(CASE WHEN YEAR(tglfaktur) = YEAR(CURDATE()) AND MONTH(tglfaktur) = MONTH(CURDATE()) THEN totalfaktur ELSE 0 END), 0) AS bulan_ini_total
            FROM pembelian
        ")[0];

        $piutang = DB::select("
            SELECT 
                COALESCE(SUM(totaldebet - totalkredit), 0) AS sisa_piutang,
                COUNT(CASE WHEN tgljatuhtempo < CURDATE() AND tgllunas IS NULL THEN 1 END) AS jml_jatuhtempo,
                COALESCE(SUM(CASE WHEN tgljatuhtempo < CURDATE() AND tgllunas IS NULL THEN (totaldebet - totalkredit) ELSE 0 END), 0) AS total_jatuhtempo,
                COALESCE(SUM(CASE WHEN tglpiutang = CURDATE() THEN totaldebet ELSE 0 END), 0) AS hari_ini_total
            FROM piutang WHERE tgllunas IS NULL
        ")[0];

        $hutang = DB::select("
            SELECT 
                COALESCE(SUM(totalkredit - totaldebet), 0) AS sisa_hutang,
                COALESCE(SUM(CASE WHEN tglhutang = CURDATE() THEN totalkredit ELSE 0 END), 0) AS hari_ini_total
            FROM hutang WHERE (totalkredit - totaldebet) > 0
        ")[0];

        return [
            'penjualan_hari_ini_total'  => (float) $penjualan->hari_ini_total,
            'penjualan_hari_ini_jml'    => (int) $penjualan->hari_ini_jml,
            'penjualan_bulan_ini_total' => (float) $penjualan->bulan_ini_total,
            'penjualan_bulan_ini_jml'   => (int) $penjualan->bulan_ini_jml,

            'pembelian_hari_ini_total'  => (float) $pembelian->hari_ini_total,
            'pembelian_hari_ini_jml'    => (int) $pembelian->hari_ini_jml,
            'pembelian_bulan_ini_total' => (float) $pembelian->bulan_ini_total,
            'pembelian_bulan_ini_jml'   => (int) $pembelian->bulan_ini_jml,

            'piutang_sisa'              => (float) $piutang->sisa_piutang,
            'piutang_jml_jatuhtempo'    => (int) $piutang->jml_jatuhtempo,
            'piutang_total_jatuhtempo'  => (float) $piutang->total_jatuhtempo,
            'piutang_hari_ini_total'    => (float) $piutang->hari_ini_total,

            'hutang_sisa'               => (float) $hutang->sisa_hutang,
            'hutang_hari_ini_total'     => (float) $hutang->hari_ini_total,
        ];
    }

    public function getInfoCaraBayar($tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        return DB::select("
            SELECT COALESCE(carabayar, 'Lainnya') AS carabayar,
                   COUNT(*) AS jml,
                   COALESCE(SUM(totalinvoice), 0) AS total
            FROM penjualan
            WHERE YEAR(tglinvoice) = ?
            GROUP BY carabayar
            ORDER BY total DESC
        ", [$tahun]);
    }

    public function getStokKritis($limit = 5)
    {
        return DB::select("
            SELECT b.idbarang, b.kdbarang, b.namabarang, 
                   b.stok, b.stok AS totalstok, 
                   b.stokminimum, b.stokminimum AS minstok, 
                   COALESCE(s.namasatuan, '-') AS namasatuan,
                   COALESCE(s.namasatuan, '-') AS satuan
            FROM barang b
            LEFT JOIN satuan s ON b.idsatuan = s.idsatuan
            WHERE b.statusaktif = 'Aktif' AND b.stokminimum > 0 AND b.stok <= b.stokminimum
            ORDER BY b.stok ASC, (b.stokminimum - b.stok) DESC
            LIMIT ?
        ", [$limit]);
    }

    public function getPiutangJatuhTempo($limit = 5)
    {
        return DB::select("
            SELECT p.idpiutang, p.idpenjualan, p.tgljatuhtempo, (p.totaldebet - p.totalkredit) AS sisa_piutang,
                   COALESCE(k.namakonsumen, '-') AS namakonsumen,
                   COALESCE(pj.noinvoice, p.idpiutang) AS noinvoice,
                   DATEDIFF(CURDATE(), p.tgljatuhtempo) AS lewat_hari,
                   CASE 
                       WHEN DATEDIFF(CURDATE(), p.tgljatuhtempo) > 0 THEN 'Overdue'
                       WHEN DATEDIFF(CURDATE(), p.tgljatuhtempo) = 0 THEN 'Hari Ini'
                       ELSE 'Mendatang'
                   END AS status_tempo,
                   CASE 
                       WHEN DATEDIFF(CURDATE(), p.tgljatuhtempo) > 0 THEN CONCAT('Lewat ', DATEDIFF(CURDATE(), p.tgljatuhtempo), ' hari')
                       WHEN DATEDIFF(CURDATE(), p.tgljatuhtempo) = 0 THEN 'Jatuh tempo hari ini'
                       ELSE CONCAT('Sisa ', ABS(DATEDIFF(CURDATE(), p.tgljatuhtempo)), ' hari')
                   END AS keterangan_tempo
            FROM piutang p
            LEFT JOIN konsumen k ON p.idkonsumen = k.idkonsumen
            LEFT JOIN penjualan pj ON p.idpenjualan = pj.idpenjualan
            WHERE p.tgllunas IS NULL AND (p.totaldebet - p.totalkredit) > 0
            ORDER BY p.tgljatuhtempo ASC, sisa_piutang DESC
            LIMIT ?
        ", [$limit]);
    }

    public function getTopKonsumen($limit = 5, $tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        return DB::select("
            SELECT k.idkonsumen, k.namakonsumen, 
                   COUNT(p.idpenjualan) AS jml_transaksi,
                   COUNT(p.idpenjualan) AS total_transaksi,
                   COALESCE(SUM(p.totalinvoice), 0) AS total_nominal,
                   COALESCE(SUM(p.totalinvoice), 0) AS total_omset
            FROM penjualan p
            JOIN konsumen k ON p.idkonsumen = k.idkonsumen
            WHERE YEAR(p.tglinvoice) = ?
            GROUP BY k.idkonsumen, k.namakonsumen
            ORDER BY total_nominal DESC
            LIMIT ?
        ", [$tahun, $limit]);
    }
}
