<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;
use App\Models\Barang;

class Konversistok extends Model
{
    use HasFactory;

    protected $table = 'v_konversistok';
    protected $primaryKey = 'idkonversi';
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
        return DB::table('v_konversistok')
            ->orderBy('idkonversi', 'desc')
            ->get();
    }

    public function simpanData($data)
    {
        try {
            DB::beginTransaction();
            DB::table('konversistok')->insert($data);

            /**
             * UPDATE BARANG ASAL
            **/
            $stokawal = Barang::getRiwayatStokAkhir($data['idbarangasal']);
            $stokmasuk = 0;
            $stokkeluar = $data['jlhbarangasal'];
            $stokakhir = $stokawal + $stokmasuk- $stokkeluar;

            //insert tabel riwayat stok
            $riwayatstok = array(
                'tglriwayat' => date('Y-m-d H:i:s'),
                'idtransaksi' => $data['idkonversi'],
                'tgltransaksi' => $data['tglkonversi'],
                'idbarang' => $data['idbarangasal'],
                'stokawal' => $stokawal,
                'stokmasuk' => $stokmasuk,
                'stokkeluar' => $stokkeluar,
                'stokakhir' => $stokakhir,
                'hargasebelumdiskon' => null,
                'hargasetelahdiskon' => null,
                'deskripsi' => 'Konversi Stok Barang',
                'idpengguna' => session()->get('idpengguna'),
                'namapengguna' => session()->get('namapengguna'),
                'jenistransaksi' => 'Konversi Stok',
            );
            DB::table('riwayatstok')->insert($riwayatstok);

            //update stok di tabel
            $dataStokBarang = array(
                'stok' => $stokakhir
            );
            DB::table('barang')
                ->where('idbarang', $data['idbarangasal'])
                ->update($dataStokBarang);


            /**
             * UPDATE BARANG TUJUAN
            **/
            $stokawal = Barang::getRiwayatStokAkhir($data['idbarangtujuan']);
            $stokmasuk = $data['jlhbarangtujuan'];
            $stokkeluar = 0;
            $stokakhir = $stokawal + $stokmasuk- $stokkeluar;

            //insert tabel riwayat stok
            $riwayatstok = array(
                'tglriwayat' => date('Y-m-d H:i:s'),
                'idtransaksi' => $data['idkonversi'],
                'tgltransaksi' => $data['tglkonversi'],
                'idbarang' => $data['idbarangtujuan'],
                'stokawal' => $stokawal,
                'stokmasuk' => $stokmasuk,
                'stokkeluar' => $stokkeluar,
                'stokakhir' => $stokakhir,
                'hargasebelumdiskon' => null,
                'hargasetelahdiskon' => null,
                'deskripsi' => 'Konversi Stok Barang',
                'idpengguna' => session()->get('idpengguna'),
                'namapengguna' => session()->get('namapengguna'),
                'jenistransaksi' => 'Konversi Stok',
            );
            DB::table('riwayatstok')->insert($riwayatstok);

            //update stok di tabel
            $dataStokBarang = array(
                'stok' => $stokakhir
            );
            DB::table('barang')
                ->where('idbarang', $data['idbarangtujuan'])
                ->update($dataStokBarang);
                    

            $this->App->riwayatAktifitas($data, 'konversistok', 'simpanData');
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

    public function hapusData($idkonversi, $rsKonversi)
    {
        try {

            DB::table('konversistok')
                ->where('idkonversi', $idkonversi)
                ->delete();

            /**
             * UPDATE BARANG ASAL
             * Kembalikan stok asal barang ke stok awal
            **/
            $stokawal = Barang::getRiwayatStokAkhir($rsKonversi->idbarangasal);
            $stokmasuk = $rsKonversi->jlhbarangasal;
            $stokkeluar = 0;
            $stokakhir = $stokawal + $stokmasuk- $stokkeluar;

            //insert tabel riwayat stok
            $riwayatstok = array(
                'tglriwayat' => date('Y-m-d H:i:s'),
                'idtransaksi' => $rsKonversi->idkonversi,
                'tgltransaksi' => $rsKonversi->tglkonversi,
                'idbarang' => $rsKonversi->idbarangasal,
                'stokawal' => $stokawal,
                'stokmasuk' => $stokmasuk,
                'stokkeluar' => $stokkeluar,
                'stokakhir' => $stokakhir,
                'hargasebelumdiskon' => null,
                'hargasetelahdiskon' => null,
                'deskripsi' => 'Hapus Konversi Stok Barang',
                'idpengguna' => session()->get('idpengguna'),
                'namapengguna' => session()->get('namapengguna'),
                'jenistransaksi' => 'Konversi Stok',
            );
            DB::table('riwayatstok')->insert($riwayatstok);

            //update stok di tabel
            $dataStokBarang = array(
                'stok' => $stokakhir
            );
            DB::table('barang')
                ->where('idbarang', $rsKonversi->idbarangasal)
                ->update($dataStokBarang);

            
            /**
             * UPDATE BARANG TUJUAN
             * Kembalikan stok tujuan barang ke stok awal
            **/
            $stokawal = Barang::getRiwayatStokAkhir($rsKonversi->idbarangtujuan);
            $stokmasuk = 0;
            $stokkeluar = $rsKonversi->jlhbarangtujuan;
            $stokakhir = $stokawal + $stokmasuk- $stokkeluar;

            //insert tabel riwayat stok
            $riwayatstok = array(
                'tglriwayat' => date('Y-m-d H:i:s'),
                'idtransaksi' => $rsKonversi->idkonversi,
                'tgltransaksi' => $rsKonversi->tglkonversi,
                'idbarang' => $rsKonversi->idbarangtujuan,
                'stokawal' => $stokawal,
                'stokmasuk' => $stokmasuk,
                'stokkeluar' => $stokkeluar,
                'stokakhir' => $stokakhir,
                'hargasebelumdiskon' => null,
                'hargasetelahdiskon' => null,
                'deskripsi' => 'Hapus Konversi Stok Barang',
                'idpengguna' => session()->get('idpengguna'),
                'namapengguna' => session()->get('namapengguna'),
                'jenistransaksi' => 'Konversi Stok',
            );
            DB::table('riwayatstok')->insert($riwayatstok);

            //update stok di tabel
            $dataStokBarang = array(
                'stok' => $stokakhir
            );
            DB::table('barang')
                ->where('idbarang', $rsKonversi->idbarangtujuan)
                ->update($dataStokBarang);

            $this->App->riwayatAktifitas($rsKonversi, 'konversistok', 'hapusData');

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }


    public function createID()
    {
        return DB::select('SELECT create_idkonversi() AS id')[0]->id;
    }

}
