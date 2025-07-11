<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;
use App\Models\Barang;

class Returpenjualan extends Model
{
    use HasFactory;

    protected $table = 'v_returpenjualan';
    protected $primaryKey = 'idreturpenjualan';
    protected $keyType = 'char';

    public $timestamps = false; // Menonaktifkan timestamps
    public $incrementing = false;
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [];
    protected $hidden = [];
    var $App;


    public function __construct()
    {
        $this->App = new App;
    }

    public function allView()
    {
        return DB::table('v_returpenjualan')
            ->orderBy('idreturpenjualan', 'desc')
            ->get();
    }

    public function simpanData($data, $dataDetail, $idreturpenjualan)
    {
        try {
            DB::beginTransaction();
            DB::table('returpenjualan')->insert($data);
            DB::table('returpenjualandetail')->insert($dataDetail);

            foreach ($dataDetail as $detail) {
                $stokawal = Barang::getRiwayatStokAkhir($detail['idbarang']);
                $stokmasuk = $detail['jumlahretur'];
                $stokkeluar = 0;
                $stokakhir = $stokawal + $stokmasuk;

                //insert tabel riwayat stok
                $riwayatstok = array(
                    'tglriwayat' => date('Y-m-d H:i:s'),
                    'idtransaksi' => $idreturpenjualan,
                    'tgltransaksi' => $data['tglretur'],
                    'idbarang' => $detail['idbarang'],
                    'stokawal' => $stokawal,
                    'stokmasuk' => $stokmasuk,
                    'stokkeluar' => $stokkeluar,
                    'stokakhir' => $stokakhir,
                    'hargasebelumdiskon' => null,
                    'hargasetelahdiskon' => $detail['hargaretur'],
                    'deskripsi' => 'Retur Penjualan',
                    'idpengguna' => session()->get('idpengguna'),
                    'namapengguna' => session()->get('namapengguna'),
                    'jenistransaksi' => 'Retur Penjualan',
                );
                DB::table('riwayatstok')->insert($riwayatstok);

                //update stok di tabel
                $dataStokBarang = array(
                    'stok' => $stokakhir
                );
                DB::table('barang')
                    ->where('idbarang', $detail['idbarang'])
                    ->update($dataStokBarang);
            }

            $this->App->riwayatAktifitas($data, 'returpenjualan', 'simpanData');
            $this->App->riwayatAktifitas($dataDetail, 'returpenjualandetail', 'simpanData');

            DB::commit();

            return ['status' => 'success', 'message' => 'Data berhasil disimpan'];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idreturpenjualan, $rsRetur)
    {
        try {

            DB::beginTransaction();

            $detailOld = DB::table('returpenjualandetail')
                ->where('idreturpenjualan', $idreturpenjualan)
                ->get();

            foreach ($detailOld as $rowDetail) {
                $stokawal = Barang::getRiwayatStokAkhir($rowDetail->idbarang);
                $stokmasuk = 0;
                $stokkeluar = $rowDetail->jumlahretur;
                $stokakhir = $stokawal - $stokkeluar;

                //insert tabel riwayat stok
                $riwayatstok = array(
                    'tglriwayat' => date('Y-m-d H:i:s'),
                    'idtransaksi' => $idreturpenjualan,
                    'tgltransaksi' => $rsRetur->tglretur,
                    'idbarang' => $rowDetail->idbarang,
                    'stokawal' => $stokawal,
                    'stokmasuk' => $stokmasuk,
                    'stokkeluar' => $stokkeluar,
                    'stokakhir' => $stokakhir,
                    'hargasebelumdiskon' => null,
                    'hargasetelahdiskon' => $rowDetail->hargaretur,
                    'deskripsi' => 'Hapus data retur penjualan',
                    'idpengguna' => session()->get('idpengguna'),
                    'namapengguna' => session()->get('namapengguna'),
                    'jenistransaksi' => 'Retur Penjualan',
                );
                DB::table('riwayatstok')->insert($riwayatstok);

                //update stok di tabel
                $dataStokBarang = array(
                    'stok' => $stokakhir
                );
                DB::table('barang')
                    ->where('idbarang', $rowDetail->idbarang)
                    ->update($dataStokBarang);
            }

            DB::table('returpenjualandetail')
                ->where('idreturpenjualan', $idreturpenjualan)
                ->delete();

            DB::table('returpenjualan')
                ->where('idreturpenjualan', $idreturpenjualan)
                ->delete();

            $this->App->riwayatAktifitas($rsRetur, 'returpenjualan', 'hapusData');
            $this->App->riwayatAktifitas($detailOld, 'returpenjualandetail', 'hapusData');

            DB::commit();
            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function createID()
    {
        return DB::select('SELECT create_idreturpenjualan() AS id')[0]->id;
    }

    public function getDetail($idreturpenjualan)
    {
        return DB::table('v_returpenjualandetail')
            ->where('idreturpenjualan', $idreturpenjualan)
            ->get();
    }

    public function searchBarangRetur($search, $idpenjualan)
    {
        $rsDetail = DB::table('v_penjualandetail')
            ->where('idpenjualan', 'LIKE', "%{$idpenjualan}%")
            ->where('namabarang', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();
        return $rsDetail;
    }

    public function getDetailPenjualan($idpenjualan, $idbarang)
    {
        $rowDetail = DB::table('v_penjualandetail_retur')
            ->where('idpenjualan', $idpenjualan)
            ->where('idbarang', $idbarang)
            ->first();
        return $rowDetail;
    }

    public static function penjualanSudahDiRetur($idpenjualan)
    {
        //row lebih dari 0 berarti sudah dibayar piutangnya
        $cekRetur = DB::table('returpenjualan')
            ->where('idpenjualan', $idpenjualan)
            ->count();
        if ($cekRetur > 0) {
            return true;
        } else {
            return false;
        }
    }
}
