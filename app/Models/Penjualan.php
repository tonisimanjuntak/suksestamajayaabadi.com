<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App;
use App\Models\Barang;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'v_penjualan';
    protected $primaryKey = 'idpenjualan';
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
        return DB::table('v_penjualan')
            ->orderBy('idpenjualan', 'desc')
            ->get();
    }

    public function simpanData($data, $dataDetail, $idpenjualan, $nokwitansi)
    {
        try {
            DB::beginTransaction();
            DB::table('penjualan')->insert($data);
            DB::table('penjualandetail')->insert($dataDetail);

            /*
            PIUTANG
            */
            if ($data['carabayar'] == 'Piutang') {
                $idpiutang = DB::select('SELECT create_idpiutang() AS id')[0]->id;

                $tgljatuhtempo = App::createTglJatuhTempo($data['idjenispiutang'], $data['tglinvoice']);

                $dataPiutang = array(
                    'idpiutang' => $idpiutang,
                    'idpenjualan' => $idpenjualan,
                    'idjenispiutang' => $data['idjenispiutang'],
                    'idkonsumen' => $data['idkonsumen'],
                    'tglpiutang' => $data['tglinvoice'],
                    'tgljatuhtempo' => $tgljatuhtempo,
                    'totaldebet' => $data['totalinvoice'],
                    'totalkredit' => 0,
                    'keterangan' => 'Piutang Penjualan dengan No Invoice ' . $data['noinvoice'],
                );
                DB::table('piutang')->insert($dataPiutang);



                $idpiutangdetail = DB::select("SELECT create_idpiutangdetail('$idpiutang') AS id")[0]->id;
                $dataPiutangDetail = array(
                    'idpiutangdetail' => $idpiutangdetail,
                    'idpiutang' => $idpiutang,
                    'tglpiutang' => $data['tglinvoice'],
                    'debet' => $data['totalinvoice'],
                    'kredit' => 0,
                    'inserted_date' => date('Y-m-d H:i:s'),
                    'updated_date' => date('Y-m-d H:i:s'),
                    'idpengguna' => session('idpengguna'),
                    'jenis' => 'Piutang',
                );
                DB::table('piutangdetail')->insert($dataPiutangDetail);

                // Panggil stored procedure sp_hitungulangpiutangkonsumen()
                $idkonsumen = $data['idkonsumen'];
                DB::statement("CALL sp_hitungulangpiutangkonsumen('$idkonsumen')");
            }

            // jika pengaturan stok dari penjualan
            if (session('stok_penjualan_dari_surat_jalan') != '1') {
                foreach ($dataDetail as $detail) {
                    $stokawal = Barang::getRiwayatStokAkhir($detail['idbarang']);
                    $stokmasuk = 0;
                    $stokkeluar = $detail['jumlahjual'];
                    $stokakhir = $stokawal - $stokkeluar;

                    //insert tabel riwayat stok
                    $riwayatstok = array(
                        'tglriwayat' => date('Y-m-d H:i:s'),
                        'idtransaksi' => $idpenjualan,
                        'tgltransaksi' => $data['tglinvoice'],
                        'idbarang' => $detail['idbarang'],
                        'stokawal' => $stokawal,
                        'stokmasuk' => $stokmasuk,
                        'stokkeluar' => $stokkeluar,
                        'stokakhir' => $stokakhir,
                        'hargasatuan' => $detail['hargasatuan'],
                        'hargadpp' => $detail['hargadpp'],
                        'jumlahppn' => $detail['jumlahppn'],
                        'jumlahdiskon' => $detail['jumlahdiskon'],
                        'subtotal' => $detail['subtotaljual'],
                        'deskripsi' => 'Tambah data penjualan',
                        'idpengguna' => session()->get('idpengguna'),
                        'namapengguna' => session()->get('namapengguna'),
                        'jenistransaksi' => 'Penjualan',
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
            }


            //create kwitansi
            if (!empty($nokwitansi)) {
                $dataKwitansi = array(
                    'nokwitansi' => $nokwitansi,
                    'tglkwitansi' => $data['tglinvoice'],
                    'idpenjualan' => $data['idpenjualan'],
                    'totalplusppn' => $data['totalinvoice'],
                    'jumlahsudahbayar' => 0,
                    'jumlahbayar' => $data['totalinvoice'],
                    'inserted_date' => $data['inserted_date'],
                    'updated_date' => $data['updated_date'],
                    'idpengguna' => $data['idpengguna'],
                    'carabayar' => $data['carabayar'],
                    'idbank' => $data['idbank'],
                );
                DB::table('penjualankwitansi')->insert($dataKwitansi);
            }

            //disini call sp_hitungulangpiutangkonsumen($idkonsumen)

            $this->App->riwayatAktifitas($data, 'penjualan', 'simpanData');
            $this->App->riwayatAktifitas($dataDetail, 'penjualandetail', 'simpanData');

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

    public function updateData($data, $dataDetail, $idpenjualan, $nokwitansi)
    {

        try {

            DB::beginTransaction();

            $nokwitansi_old = DB::table('penjualan')
                ->where('idpenjualan', $idpenjualan)
                ->first()->nokwitansi;

            DB::table('penjualan')
                ->where('idpenjualan', $idpenjualan)
                ->update($data);


            // jika pengaturan stok dari penjualan
            if (session('stok_penjualan_dari_surat_jalan') != '1') {
                /*
                    INFO : 
                    karena ini update data maka 
                    kurangi stok terlebih dahulu sebelum kita update data detail nya
                */
                $detailOld = DB::table('penjualandetail')
                    ->where('idpenjualan', $idpenjualan)
                    ->get();
                foreach ($detailOld as $rowDetail) {
                    $stokawal = Barang::getRiwayatStokAkhir($rowDetail->idbarang);
                    $stokmasuk = $rowDetail->jumlahjual;
                    $stokkeluar = 0;
                    $stokakhir = $stokawal + $stokmasuk;

                    //insert tabel riwayat stok
                    $riwayatstok = array(
                        'tglriwayat' => date('Y-m-d H:i:s'),
                        'idtransaksi' => $idpenjualan,
                        'tgltransaksi' => $data['tglinvoice'],
                        'idbarang' => $rowDetail->idbarang,
                        'stokawal' => $stokawal,
                        'stokmasuk' => $stokmasuk,
                        'stokkeluar' => $stokkeluar,
                        'stokakhir' => $stokakhir,
                        'hargasatuan' => $rowDetail->hargasatuan,
                        'hargadpp' => $rowDetail->hargadpp,
                        'jumlahppn' => $rowDetail->jumlahppn,
                        'jumlahdiskon' => $rowDetail->jumlahdiskon,
                        'subtotal' => $rowDetail->subtotaljual,
                        'deskripsi' => 'Update data penjualan',
                        'idpengguna' => session()->get('idpengguna'),
                        'namapengguna' => session()->get('namapengguna'),
                        'jenistransaksi' => 'Penjualan',
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


                foreach ($dataDetail as $detail) {
                    $stokawal = $stokakhir;
                    $stokmasuk = 0;
                    $stokkeluar = $detail['jumlahjual'];
                    $stokakhir = $stokawal - $stokkeluar;

                    //insert tabel riwayat stok
                    $riwayatstok = array(
                        'tglriwayat' => date('Y-m-d H:i:s'),
                        'idtransaksi' => $idpenjualan,
                        'tgltransaksi' => $data['tglinvoice'],
                        'idbarang' => $detail['idbarang'],
                        'stokawal' => $stokawal,
                        'stokmasuk' => $stokmasuk,
                        'stokkeluar' => $stokkeluar,
                        'stokakhir' => $stokakhir,
                        'hargasatuan' => $detail['hargasatuan'],
                        'hargadpp' => $detail['hargadpp'],
                        'jumlahppn' => $detail['jumlahppn'],
                        'jumlahdiskon' => $detail['jumlahdiskon'],
                        'subtotal' => $detail['subtotaljual'],
                        'deskripsi' => 'Update data penjualan',
                        'idpengguna' => session()->get('idpengguna'),
                        'namapengguna' => session()->get('namapengguna'),
                        'jenistransaksi' => 'Penjualan',
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
            }


            DB::table('penjualandetail')
                ->where('idpenjualan', $idpenjualan)
                ->delete();

            DB::table('penjualandetail')
                ->insert($dataDetail);

            /*
            PIUTANG
            */

            //hapus piutang jika ada
            $rsPiutang = DB::table('piutang')
                ->where('idpenjualan', $idpenjualan)
                ->first();
            if (!empty($rsPiutang)) {
                $idpiutang = $rsPiutang->idpiutang;
                DB::table('piutangdetail')
                    ->where('idpiutang', $idpiutang)
                    ->delete();

                DB::table('piutang')
                    ->where('idpiutang', $idpiutang)
                    ->delete();
            }

            if ($data['carabayar'] == 'Piutang') {
                $idpiutang = DB::select('SELECT create_idpiutang() AS id')[0]->id;

                $tgljatuhtempo = App::createTglJatuhTempo($data['idjenispiutang'], $data['tglinvoice']);

                $dataPiutang = array(
                    'idpiutang' => $idpiutang,
                    'idpenjualan' => $idpenjualan,
                    'idjenispiutang' => $data['idjenispiutang'],
                    'idkonsumen' => $data['idkonsumen'],
                    'tglpiutang' => $data['tglinvoice'],
                    'tgljatuhtempo' => $tgljatuhtempo,
                    'totaldebet' => $data['totalinvoice'],
                    'totalkredit' => 0,
                    'keterangan' => 'Piutang Penjualan dengan No Invoice ' . $data['noinvoice'],
                );
                DB::table('piutang')->insert($dataPiutang);



                $idpiutangdetail = DB::select("SELECT create_idpiutangdetail('$idpiutang') AS id")[0]->id;
                $dataPiutangDetail = array(
                    'idpiutangdetail' => $idpiutangdetail,
                    'idpiutang' => $idpiutang,
                    'tglpiutang' => $data['tglinvoice'],
                    'debet' => $data['totalinvoice'],
                    'kredit' => 0,
                    'inserted_date' => date('Y-m-d H:i:s'),
                    'updated_date' => date('Y-m-d H:i:s'),
                    'idpengguna' => session('idpengguna'),
                    'jenis' => 'Piutang',
                );
                DB::table('piutangdetail')->insert($dataPiutangDetail);

                // Panggil stored procedure sp_hitungulangpiutangkonsumen()
                $idkonsumen = $data['idkonsumen'];
                DB::statement("CALL sp_hitungulangpiutangkonsumen('$idkonsumen')");
            }


            //create kwitansi
            if (!empty($nokwitansi)) {

                if (!empty($nokwitansi_old)) {
                    DB::table('penjualankwitansi')
                        ->where('nokwitansi', $nokwitansi_old)
                        ->delete();
                }


                $dataKwitansi = array(
                    'nokwitansi' => $nokwitansi,
                    'tglkwitansi' => $data['tglinvoice'],
                    'idpenjualan' => $data['idpenjualan'],
                    'totalplusppn' => $data['totalinvoice'],
                    'jumlahsudahbayar' => 0,
                    'jumlahbayar' => $data['totalinvoice'],
                    'inserted_date' => $data['updated_date'],
                    'updated_date' => $data['updated_date'],
                    'idpengguna' => $data['idpengguna'],
                    'carabayar' => $data['carabayar'],
                    'idbank' => $data['idbank'],
                );
                DB::table('penjualankwitansi')->insert($dataKwitansi);
            }


            //riwayat aktifitas
            $this->App->riwayatAktifitas($data, 'penjualan', 'updateData');
            $this->App->riwayatAktifitas($dataDetail, 'penjualandetail', 'updateData');

            DB::commit();
            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idpenjualan, $rspenjualan)
    {
        try {

            DB::beginTransaction();

            $nokwitansi_old = $rspenjualan->nokwitansi;
            if (!empty($nokwitansi_old)) {
                DB::table('penjualankwitansi')
                    ->where('nokwitansi', $nokwitansi_old)
                    ->delete();
            }

            $detailOld = DB::table('penjualandetail')
                ->where('idpenjualan', $idpenjualan)
                ->get();


            // jika pengaturan stok dari penjualan
            if (session('stok_penjualan_dari_surat_jalan') != '1') {
                foreach ($detailOld as $rowDetail) {
                    $stokawal = Barang::getRiwayatStokAkhir($rowDetail->idbarang);
                    $stokmasuk = $rowDetail->jumlahjual;
                    $stokkeluar = 0;
                    $stokakhir = $stokawal + $stokmasuk;

                    //insert tabel riwayat stok
                    $riwayatstok = array(
                        'tglriwayat' => date('Y-m-d H:i:s'),
                        'idtransaksi' => $idpenjualan,
                        'tgltransaksi' => $rspenjualan->tglinvoice,
                        'idbarang' => $rowDetail->idbarang,
                        'stokawal' => $stokawal,
                        'stokmasuk' => $stokmasuk,
                        'stokkeluar' => $stokkeluar,
                        'stokakhir' => $stokakhir,
                        'hargasatuan' => $rowDetail->hargasatuan,
                        'hargadpp' => $rowDetail->hargadpp,
                        'jumlahppn' => $rowDetail->jumlahppn,
                        'jumlahdiskon' => $rowDetail->jumlahdiskon,
                        'subtotal' => $rowDetail->subtotaljual,
                        'deskripsi' => 'Hapus data penjualan',
                        'idpengguna' => session()->get('idpengguna'),
                        'namapengguna' => session()->get('namapengguna'),
                        'jenistransaksi' => 'Penjualan',
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
            }

            //hapus piutang jika ada
            $rsPiutang = DB::table('piutang')
                ->where('idpenjualan', $idpenjualan)
                ->first();
            if (!empty($rsPiutang)) {
                $idpiutang = $rsPiutang->idpiutang;
                DB::table('piutangdetail')
                    ->where('idpiutang', $idpiutang)
                    ->delete();

                DB::table('piutang')
                    ->where('idpiutang', $idpiutang)
                    ->delete();

                // Panggil stored procedure sp_hitungulangpiutangkonsumen()
                $idkonsumen = $rspenjualan->idkonsumen;
                DB::statement("CALL sp_hitungulangpiutangkonsumen('$idkonsumen')");
            }

            DB::table('penjualandetail')
                ->where('idpenjualan', $idpenjualan)
                ->delete();

            DB::table('penjualan')
                ->where('idpenjualan', $idpenjualan)
                ->delete();

            $this->App->riwayatAktifitas($rspenjualan, 'penjualan', 'hapusData');
            $this->App->riwayatAktifitas($detailOld, 'penjualandetail', 'hapusData');

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
        return DB::select('SELECT create_idpenjualan() AS id')[0]->id;
    }

    public function createInvoice()
    {
        return DB::select('SELECT create_noinvoice() AS id')[0]->id;
    }

    public static function createKwitansi($idpenjualan)
    {
        return DB::select("SELECT create_nokwitansi('$idpenjualan') AS id")[0]->id;
    }

    public static function getDetail($idpenjualan)
    {
        return DB::table('v_penjualandetail')
            ->where('idpenjualan', $idpenjualan)
            ->get();
    }

    public function cekNoInvoice($noinvoice)
    {
        $cekInvoice = DB::table('penjualan')
            ->where('noinvoice', $noinvoice)
            ->count();
        if ($cekInvoice > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getKwitansiTerakhir($idpenjualan)
    {
        return DB::table('penjualankwitansi')
            ->where('idpenjualan', $idpenjualan)
            ->orderBy('nokwitansi', 'DESC')
            ->first();
    }

    public function adaPiutangKadaluarsa($idkonsumen)
    {
        $rsPiutang = DB::table('v_piutang')
            ->where('tgljatuhtempo', '<=', date('Y-m-d'))
            ->whereRaw('totaldebet > totalkredit')
            ->get();
        if ($rsPiutang->isEmpty()) {
            return false;
        } else {
            return true;
        }
    }
}
