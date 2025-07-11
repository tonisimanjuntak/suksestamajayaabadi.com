<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;

class Suratjalan extends Model
{
    use HasFactory;

    protected $table = 'v_suratjalan_groupconcat';
    protected $primaryKey = 'idsuratjalan';
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
        return DB::table('v_suratjalan')
            ->orderBy('idsuratjalan', 'desc')
            ->get();
    }

    public function simpanData($data, $dataDetail, $dataDetailRincian, $idsuratjalan)
    {
        try {
            DB::beginTransaction();
            DB::table('suratjalan')->insert($data);
            DB::table('suratjalandetail')->insert($dataDetail);
            DB::table('suratjalanrincian')->insert($dataDetailRincian);


            if ($data['biayapengiriman'] > 0) {
                $idhutangekspedisi = DB::select('SELECT create_idhutangekspedisi() AS id')[0]->id;

                $dataHutangEkspedisi = array(
                    'idhutangekspedisi' => $idhutangekspedisi,
                    'idtransaksi' => $idsuratjalan,
                    'tglhutang' => $data['tglsuratjalan'],
                    'idekspedisi' => $data['idekspedisi'],
                    'debet' => 0,
                    'kredit' => $data['biayapengiriman'],
                    'keterangan' => 'Hutang ekspedisi dengan No. Surat Jalan ' . $data['idsuratjalan'],
                    'jenissumber' => 'Penjualan',
                    'jenis' => 'Hutang',
                );
                DB::table('hutangekspedisi')->insert($dataHutangEkspedisi);
                $this->App->riwayatAktifitas($dataHutangEkspedisi, 'hutangekspedisi', 'penerimaanPembelian');
            }

            // jika pengaturan stok dari penjualan
            if (session('stok_penjualan_dari_surat_jalan') == '1') {
                foreach ($dataDetail as $rowDetail) {
                    $idpenjualan = $rowDetail['idpenjualan'];

                    $rsPenjualan = DB::table('penjualan')
                        ->where('idpenjualan', $idpenjualan)
                        ->first();

                    $rsDetailPenjualan = DB::table('penjualandetail')
                        ->where('idpenjualan', $idpenjualan)
                        ->get();

                    foreach ($rsDetailPenjualan as $rowDetailPenjualan) {
                        $stokawal = Barang::getRiwayatStokAkhir($rowDetailPenjualan->idbarang);
                        $stokmasuk = 0;
                        $stokkeluar = $rowDetailPenjualan->jumlahjual;
                        $stokakhir = $stokawal - $stokkeluar;

                        //insert tabel riwayat stok
                        $riwayatstok = array(
                            'tglriwayat' => date('Y-m-d H:i:s'),
                            'idtransaksi' => $idsuratjalan,
                            'tgltransaksi' => $data['tglsuratjalan'],
                            'idbarang' => $rowDetailPenjualan->idbarang,
                            'stokawal' => $stokawal,
                            'stokmasuk' => $stokmasuk,
                            'stokkeluar' => $stokkeluar,
                            'stokakhir' => $stokakhir,
                            'hargasatuan' => $rowDetailPenjualan->hargasatuan,
                            'hargadpp' => $rowDetailPenjualan->hargadpp,
                            'jumlahppn' => $rowDetailPenjualan->jumlahppn,
                            'jumlahdiskon' => $rowDetailPenjualan->jumlahdiskon,
                            'subtotal' => $rowDetailPenjualan->subtotaljual,
                            'deskripsi' => 'Tambah data surat jalan',
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
                            ->where('idbarang', $rowDetailPenjualan->idbarang)
                            ->update($dataStokBarang);
                    }
                }
            }

            $this->App->riwayatAktifitas($data, 'suratjalan', 'simpanData');
            $this->App->riwayatAktifitas($dataDetail, 'suratjalandetail', 'simpanData');
            $this->App->riwayatAktifitas($dataDetailRincian, 'suratjalanrincian', 'simpanData');

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

    public function updateData($data, $dataDetail, $dataDetailRincian, $idsuratjalan)
    {

        try {

            DB::beginTransaction();


            //hapus hutang ekspedisi jika ada
            $rsHutangEkspedisi = DB::table('hutangekspedisi')
                ->where('idtransaksi', $idsuratjalan)
                ->where('jenissumber', 'Penjualan')
                ->first();
            if (!empty($rsHutangEkspedisi)) {
                $idhutangekspedisi = $rsHutangEkspedisi->idhutangekspedisi;
                DB::table('hutangekspedisi')
                    ->where('idhutangekspedisi', $idhutangekspedisi)
                    ->delete();
                $this->App->riwayatAktifitas($rsHutangEkspedisi, 'hutangekspedisi', 'UpdateDataSuratJalan');
            }

            if ($data['biayapengiriman'] > 0) {
                $idhutangekspedisi = DB::select('SELECT create_idhutangekspedisi() AS id')[0]->id;

                $dataHutangEkspedisi = array(
                    'idhutangekspedisi' => $idhutangekspedisi,
                    'idtransaksi' => $idsuratjalan,
                    'tglhutang' => $data['tglsuratjalan'],
                    'idekspedisi' => $data['idekspedisi'],
                    'debet' => 0,
                    'kredit' => $data['biayapengiriman'],
                    'keterangan' => 'Hutang ekspedisi dengan No. Surat Jalan ' . $data['idsuratjalan'],
                    'jenissumber' => 'Penjualan',
                    'jenis' => 'Hutang',
                );
                DB::table('hutangekspedisi')->insert($dataHutangEkspedisi);
                $this->App->riwayatAktifitas($dataHutangEkspedisi, 'hutangekspedisi', 'penerimaanPembelian');
            }

            // jika pengaturan stok dari penjualan
            if (session('stok_penjualan_dari_surat_jalan') == '1') {



                //karena update data kembalikan stok barang ke stok semula
                $rsDetailSuratJalanOld = DB::table('suratjalandetail')
                    ->where('idsuratjalan', $idsuratjalan)
                    ->get();

                foreach ($rsDetailSuratJalanOld as $rowDetailOld) {
                    $idpenjualan = $rowDetailOld->idpenjualan;

                    $rsDetailPenjualan = DB::table('penjualandetail')
                        ->where('idpenjualan', $idpenjualan)
                        ->get();

                    foreach ($rsDetailPenjualan as $rowDetailPenjualan) {
                        $stokawal = Barang::getRiwayatStokAkhir($rowDetailPenjualan->idbarang);
                        $stokmasuk = $rowDetailPenjualan->jumlahjual;
                        $stokkeluar = 0;
                        $stokakhir = $stokawal + $stokmasuk;


                        //insert tabel riwayat stok
                        $riwayatstok = array(
                            'tglriwayat' => date('Y-m-d H:i:s'),
                            'idtransaksi' => $idsuratjalan,
                            'tgltransaksi' => $data['tglsuratjalan'],
                            'idbarang' => $rowDetailPenjualan->idbarang,
                            'stokawal' => $stokawal,
                            'stokmasuk' => $stokmasuk,
                            'stokkeluar' => $stokkeluar,
                            'stokakhir' => $stokakhir,
                            'hargasatuan' => $rowDetailPenjualan->hargasatuan,
                            'hargadpp' => $rowDetailPenjualan->hargadpp,
                            'jumlahppn' => $rowDetailPenjualan->jumlahppn,
                            'jumlahdiskon' => $rowDetailPenjualan->jumlahdiskon,
                            'subtotal' => $rowDetailPenjualan->subtotaljual,
                            'deskripsi' => 'Update data surat jalan',
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
                            ->where('idbarang', $rowDetailPenjualan->idbarang)
                            ->update($dataStokBarang);
                    }
                }


                //update data stok barang
                foreach ($dataDetail as $rowDetail) {
                    $idpenjualan = $rowDetail['idpenjualan'];

                    $rsDetailPenjualan = DB::table('penjualandetail')
                        ->where('idpenjualan', $idpenjualan)
                        ->get();

                    foreach ($rsDetailPenjualan as $rowDetailPenjualan) {
                        $stokawal = Barang::getRiwayatStokAkhir($rowDetailPenjualan->idbarang);
                        $stokmasuk = 0;
                        $stokkeluar = $rowDetailPenjualan->jumlahjual;
                        $stokakhir = $stokawal - $stokkeluar;

                        //insert tabel riwayat stok
                        $riwayatstok = array(
                            'tglriwayat' => date('Y-m-d H:i:s'),
                            'idtransaksi' => $idsuratjalan,
                            'tgltransaksi' => $data['tglsuratjalan'],
                            'idbarang' => $rowDetailPenjualan->idbarang,
                            'stokawal' => $stokawal,
                            'stokmasuk' => $stokmasuk,
                            'stokkeluar' => $stokkeluar,
                            'stokakhir' => $stokakhir,
                            'hargasatuan' => $rowDetailPenjualan->hargasatuan,
                            'hargadpp' => $rowDetailPenjualan->hargadpp,
                            'jumlahppn' => $rowDetailPenjualan->jumlahppn,
                            'jumlahdiskon' => $rowDetailPenjualan->jumlahdiskon,
                            'subtotal' => $rowDetailPenjualan->subtotaljual,
                            'deskripsi' => 'Update data surat jalan',
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
                            ->where('idbarang', $rowDetailPenjualan->idbarang)
                            ->update($dataStokBarang);
                    }
                }
            }

            DB::table('suratjalandetail')
                ->where('idsuratjalan', $idsuratjalan)
                ->delete();

            DB::table('suratjalanrincian')
                ->where('idsuratjalan', $idsuratjalan)
                ->delete();

            DB::table('suratjalan')
                ->where('idsuratjalan', $idsuratjalan)
                ->update($data);

            DB::table('suratjalandetail')->insert($dataDetail);
            DB::table('suratjalanrincian')->insert($dataDetailRincian);


            //riwayat aktifitas
            $this->App->riwayatAktifitas($data, 'suratjalan', 'updateData');
            $this->App->riwayatAktifitas($dataDetail, 'suratjalandetail', 'updateData');
            $this->App->riwayatAktifitas($dataDetailRincian, 'suratjalanrincian', 'updateData');

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

    public function hapusData($idsuratjalan, $rsSuratJalan)
    {
        try {

            DB::beginTransaction();


            //hapus hutang ekspedisi jika ada
            $rsHutangEkspedisi = DB::table('hutangekspedisi')
                ->where('idtransaksi', $idsuratjalan)
                ->where('jenissumber', 'Penjualan')
                ->first();
            if (!empty($rsHutangEkspedisi)) {
                $idhutangekspedisi = $rsHutangEkspedisi->idhutangekspedisi;
                DB::table('hutangekspedisi')
                    ->where('idhutangekspedisi', $idhutangekspedisi)
                    ->delete();
                $this->App->riwayatAktifitas($rsHutangEkspedisi, 'hutangekspedisi', 'hapusDataSuratJalan');
            }

            $detailOld = DB::table('suratjalandetail')
                ->where('idsuratjalan', $idsuratjalan)
                ->get();
            $detailRincianOld = DB::table('suratjalanrincian')
                ->where('idsuratjalan', $idsuratjalan)
                ->get();


            // jika pengaturan stok dari penjualan
            if (session('stok_penjualan_dari_surat_jalan') == '1') {

                //kembalikan stok barang ke stok semula
                $rsDetailSuratJalanOld = DB::table('suratjalandetail')
                    ->where('idsuratjalan', $idsuratjalan)
                    ->get();

                foreach ($rsDetailSuratJalanOld as $rowDetailOld) {
                    $idpenjualan = $rowDetailOld->idpenjualan;

                    $rsDetailPenjualan = DB::table('penjualandetail')
                        ->where('idpenjualan', $idpenjualan)
                        ->get();

                    foreach ($rsDetailPenjualan as $rowDetailPenjualan) {
                        $stokawal = Barang::getRiwayatStokAkhir($rowDetailPenjualan->idbarang);
                        $stokmasuk = $rowDetailPenjualan->jumlahjual;
                        $stokkeluar = 0;
                        $stokakhir = $stokawal + $stokmasuk;

                        //insert tabel riwayat stok
                        $riwayatstok = array(
                            'tglriwayat' => date('Y-m-d H:i:s'),
                            'idtransaksi' => $idsuratjalan,
                            'tgltransaksi' => $rsSuratJalan->tglsuratjalan,
                            'idbarang' => $rowDetailPenjualan->idbarang,
                            'stokawal' => $stokawal,
                            'stokmasuk' => $stokmasuk,
                            'stokkeluar' => $stokkeluar,
                            'stokakhir' => $stokakhir,
                            'hargasatuan' => $rowDetailPenjualan->hargasatuan,
                            'hargadpp' => $rowDetailPenjualan->hargadpp,
                            'jumlahppn' => $rowDetailPenjualan->jumlahppn,
                            'jumlahdiskon' => $rowDetailPenjualan->jumlahdiskon,
                            'subtotal' => $rowDetailPenjualan->subtotaljual,
                            'deskripsi' => 'Update data surat jalan',
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
                            ->where('idbarang', $rowDetailPenjualan->idbarang)
                            ->update($dataStokBarang);
                    }
                }
            }

            DB::table('suratjalandetail')
                ->where('idsuratjalan', $idsuratjalan)
                ->delete();
            DB::table('suratjalanrincian')
                ->where('idsuratjalan', $idsuratjalan)
                ->delete();

            DB::table('suratjalan')
                ->where('idsuratjalan', $idsuratjalan)
                ->delete();

            $this->App->riwayatAktifitas($rsSuratJalan, 'suratjalan', 'hapusData');
            $this->App->riwayatAktifitas($detailOld, 'suratjalandetail', 'hapusData');
            $this->App->riwayatAktifitas($detailRincianOld, 'suratjalanrincian', 'hapusData');


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
        return DB::select('SELECT create_idsuratjalan() AS id')[0]->id;
    }

    public function createIDDetail($idsuratjalan)
    {
        return DB::select("SELECT create_idsuratjalandetail('$idsuratjalan') AS id")[0]->id;
    }

    public function getSuratJalanID($idsuratjalan)
    {
        return DB::table('v_suratjalan')
            ->where('idsuratjalan', $idsuratjalan)
            ->first();
    }

    public function getDetail($idsuratjalan)
    {
        return DB::table('v_suratjalandetail')
            ->where('idsuratjalan', $idsuratjalan)
            ->get();
    }

    public function getDetailRincian($idsuratjalan)
    {
        return DB::table('suratjalanrincian')
            ->where('idsuratjalan', $idsuratjalan)
            ->get();
    }

    public function getDetailID($idsuratjalandetail)
    {
        return DB::table('v_suratjalandetail')
            ->where('idsuratjalandetail', $idsuratjalandetail)
            ->first();
    }

    public function get_penjualan_belumada_suratjalan($search, $idkonsumen)
    {
        return DB::table('v_penjualan_belumada_suratjalan')
            ->where('noinvoice', 'LIKE', '%' . $search . '%')
            ->where('idkonsumen', $idkonsumen)
            ->get();
    }

    public function checkStokBarang($isidatatable)
    {
        $dataDetail = array();
        for ($i = 0; $i < count($isidatatable); $i++) {
            $dataDetail[] = array(
                'idpenjualan' => $isidatatable[$i]['idpenjualan'],
            );
        }

        // Tampung idpenjualan ke dalam satu variabel
        $idpenjualantext = '';
        foreach ($dataDetail as $detail) {
            $idpenjualantext .= "'" . $detail['idpenjualan'] . "', ";
        }
        $idpenjualantext = rtrim($idpenjualantext, ", "); // Menghapus tanda koma terakhir

        $rsStokTidakCukup = DB::select("
            SELECT v_penjualandetail.`idbarang`, barang.namabarang, barang.stok, SUM(jumlahjual) AS jumlahjual 
                FROM v_penjualandetail
                    JOIN barang ON barang.idbarang = v_penjualandetail.`idbarang`
                WHERE idpenjualan IN (" . $idpenjualantext . ")
                GROUP BY v_penjualandetail.`idbarang`, barang.namabarang, barang.stok;
                
        ");
        if (count($rsStokTidakCukup) > 0) {
            $namabarangtext = '';
            foreach ($rsStokTidakCukup as $row) {
                $stok = $row->stok;
                $jumlahjual = $row->jumlahjual;
                if ($stok < $jumlahjual) {
                    $namabarangtext .= $row->namabarang . ', ';
                }
            }
            $namabarangtext = rtrim($namabarangtext, ', '); // Menghapus tanda koma terakhir

            if (!empty($namabarangtext)) {
                return array('lanjut' => false, 'message' => 'Stok barang tidak mencukupi! Nama barang: ' . $namabarangtext);
            }
        }

        return array('lanjut' => true);
    }

    public function sudahAdaPenagihan($idsuratjalan)
    {
        $cekPenagihan = DB::table('v_suratjalan_sudah_ada_penagihan')
            ->where('idsuratjalan', $idsuratjalan)
            ->count();
        if ($cekPenagihan > 0) {
            return true;
        } else {
            return false;
        }
    }
}
