<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App;
use App\Models\Barang;

class Returpembelian extends Model
{
    use HasFactory;

    protected $table = 'v_returpembelian';
    protected $primaryKey = 'idreturpembelian';
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
        return DB::table('v_returpembelian')
            ->orderBy('idreturpembelian', 'desc')
            ->get();
    }

    public function updateData($data, $idreturpembelian)
    {
        try {
            DB::beginTransaction();

            DB::table('returpembelian')
                ->where('idreturpembelian', $idreturpembelian)
                ->update($data);

            $dataDetail = DB::table('returpembeliandetail')
                ->where('idreturpembelian', $idreturpembelian)
                ->get();

            $this->App->riwayatAktifitas($data, 'returpembelian', 'updateData');
            $this->App->riwayatAktifitas($dataDetail, 'returpembeliandetail', 'updateData');

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

    public function simpanData($data, $dataDetail, $idreturpembelian)
    {
        try {
            DB::beginTransaction();
            DB::table('returpembelian')->insert($data);
            DB::table('returpembeliandetail')->insert($dataDetail);

            foreach ($dataDetail as $detail) {
                $stokawal = Barang::getRiwayatStokAkhir($detail['idbarang']);
                $stokmasuk = 0;
                $stokkeluar = $detail['jumlahretur'];
                $stokakhir = $stokawal - $stokkeluar;



                //insert tabel riwayat stok
                $riwayatstok = array(
                    'tglriwayat' => date('Y-m-d H:i:s'),
                    'idtransaksi' => $idreturpembelian,
                    'tgltransaksi' => $data['tglpengajuan'],
                    'idbarang' => $detail['idbarang'],
                    'stokawal' => $stokawal,
                    'stokmasuk' => $stokmasuk,
                    'stokkeluar' => $stokkeluar,
                    'stokakhir' => $stokakhir,
                    'hargasebelumdiskon' => null,
                    'hargasetelahdiskon' => $detail['hargaretur'],
                    'deskripsi' => 'Retur Pembelian',
                    'idpengguna' => session()->get('idpengguna'),
                    'namapengguna' => session()->get('namapengguna'),
                    'jenistransaksi' => 'Retur Pembelian',
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

            $this->App->riwayatAktifitas($data, 'returpembelian', 'simpanData');
            $this->App->riwayatAktifitas($dataDetail, 'returpembeliandetail', 'simpanData');
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

    public function hapusData($idreturpembelian, $rsPembelian)
    {
        try {

            DB::beginTransaction();

            $detailOld = DB::table('returpembeliandetail')
                ->where('idreturpembelian', $idreturpembelian)
                ->get();

            foreach ($detailOld as $rowDetail) {
                $stokawal = Barang::getRiwayatStokAkhir($rowDetail->idbarang);
                $stokmasuk = $rowDetail->jumlahretur;
                $stokkeluar = 0;
                $stokakhir = $stokawal + $stokmasuk;

                //insert tabel riwayat stok
                $riwayatstok = array(
                    'tglriwayat' => date('Y-m-d H:i:s'),
                    'idtransaksi' => $idreturpembelian,
                    'tgltransaksi' => $rsPembelian->tglretur,
                    'idbarang' => $rowDetail->idbarang,
                    'stokawal' => $stokawal,
                    'stokmasuk' => $stokmasuk,
                    'stokkeluar' => $stokkeluar,
                    'stokakhir' => $stokakhir,
                    'hargasebelumdiskon' => null,
                    'hargasetelahdiskon' => $rowDetail->hargaretur,
                    'deskripsi' => 'Hapus data retur pembelian',
                    'idpengguna' => session()->get('idpengguna'),
                    'namapengguna' => session()->get('namapengguna'),
                    'jenistransaksi' => 'Retur Pembelian',
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

            DB::table('returpembeliandetail')
                ->where('idreturpembelian', $idreturpembelian)
                ->delete();

            DB::table('returpembelian')
                ->where('idreturpembelian', $idreturpembelian)
                ->delete();

            $this->App->riwayatAktifitas($rsPembelian, 'returpembelian', 'hapusData');
            $this->App->riwayatAktifitas($detailOld, 'returpembeliandetail', 'hapusData');

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
        return DB::select('SELECT create_idreturpembelian() AS id')[0]->id;
    }

    public function getDetail($idreturpembelian)
    {
        return DB::table('v_returpembeliandetail')
            ->where('idreturpembelian', $idreturpembelian)
            ->get();
    }

    public function searchBarangRetur($search, $idpembelian)
    {
        $rsDetail = DB::table('v_pembeliandetail')
            ->where('idpembelian', 'LIKE', "%{$idpembelian}%")
            ->where('namabarang', 'LIKE', "%{$search}%")
            ->limit(50)
            ->get();
        return $rsDetail;
    }

    public function getDetailPembelian($idpembelian, $idbarang)
    {
        $rowDetail = DB::table('v_pembeliandetail_retur')
            ->where('idpembelian', $idpembelian)
            ->where('idbarang', $idbarang)
            ->first();
        return $rowDetail;
    }
}
