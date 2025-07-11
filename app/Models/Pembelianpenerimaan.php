<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App;
use App\Models\Barang;

class Pembelianpenerimaan extends Model
{
    use HasFactory;

    protected $table = 'v_pembelian';
    protected $primaryKey = 'idpembelian';
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
        return DB::table('v_pembelian')
            ->orderBy('idpembelian', 'desc')
            ->get();
    }

    public function updateData($data, $dataDetail, $idpembelian)
    {

        try {

            DB::beginTransaction();


            DB::table('pembelian')
                ->where('idpembelian', $idpembelian)
                ->update($data);

            foreach ($dataDetail as $row) {

                if (!empty($row['iddetail'])) {

                    $arrDetail = array(
                        'jumlahbeli' => $row['jumlahbeli'],
                        'hargasatuan' => $row['hargasatuan'],
                        'hargadpp' => $row['hargadpp'],
                        'jumlahppn' => $row['jumlahppn'],
                        'jumlahdiskon' => $row['jumlahdiskon'],
                        'subtotalbeli' => $row['subtotalbeli'],
                        'jenisdiskon' => $row['jenisdiskon'],
                        'diskonpersen1' => $row['diskonpersen1'],
                        'diskonpersen2' => $row['diskonpersen2'],
                        'diskonpersen3' => $row['diskonpersen3'],
                    );

                    DB::table('pembeliandetail')
                        ->where('id', $row['iddetail'])
                        ->update($arrDetail);
                } else {
                    $arrDetail = array(
                        'idpembelian' => $row['idpembelian'],
                        'idbarang' => $row['idbarang'],
                        'jumlahbeli' => $row['jumlahbeli'],
                        'hargasatuan' => $row['hargasatuan'],
                        'hargadpp' => $row['hargadpp'],
                        'jumlahppn' => $row['jumlahppn'],
                        'jumlahdiskon' => $row['jumlahdiskon'],
                        'subtotalbeli' => $row['subtotalbeli'],
                        'jenisdiskon' => $row['jenisdiskon'],
                        'diskonpersen1' => $row['diskonpersen1'],
                        'diskonpersen2' => $row['diskonpersen2'],
                        'diskonpersen3' => $row['diskonpersen3'],
                    );

                    DB::table('pembeliandetail')
                        ->insert($arrDetail);
                }
            }

            /*
                Update Stok Barang
            */
            foreach ($dataDetail as $detail) {
                $stokawal = Barang::getRiwayatStokAkhir($detail['idbarang']);
                $stokmasuk = $detail['jumlahbeli'];
                $stokkeluar = 0;
                $stokakhir = $stokawal + $stokmasuk;

                //insert tabel riwayat stok
                $riwayatstok = array(
                    'tglriwayat' => date('Y-m-d H:i:s'),
                    'idtransaksi' => $idpembelian,
                    'tgltransaksi' => $data['tglfaktur'],
                    'idbarang' => $detail['idbarang'],
                    'stokawal' => $stokawal,
                    'stokmasuk' => $stokmasuk,
                    'stokkeluar' => $stokkeluar,
                    'stokakhir' => $stokakhir,
                    'hargasatuan' => $detail['hargasatuan'],
                    'hargadpp' => $detail['hargadpp'],
                    'jumlahppn' => $detail['jumlahppn'],
                    'jumlahdiskon' => $detail['jumlahdiskon'],
                    'subtotal' => $detail['subtotalbeli'],
                    'deskripsi' => 'Penerimaan faktur pembelian',
                    'idpengguna' => session()->get('idpengguna'),
                    'namapengguna' => session()->get('namapengguna'),
                    'jenistransaksi' => 'Pembelian',
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


            /*
            HUTANG
            */

            //hapus hutang jika ada
            $rsHutang = DB::table('hutang')
                ->where('idpembelian', $idpembelian)
                ->first();
            if (!empty($rsHutang)) {
                $idhutang = $rsHutang->idhutang;
                DB::table('hutangdetail')
                    ->where('idhutang', $idhutang)
                    ->delete();

                DB::table('hutang')
                    ->where('idhutang', $idhutang)
                    ->delete();
            }

            if ($data['carabayar'] == 'Hutang') {
                $idhutang = DB::select('SELECT create_idhutang() AS id')[0]->id;

                $dataHutang = array(
                    'idhutang' => $idhutang,
                    'idpembelian' => $idpembelian,
                    'tglhutang' => $data['tglfaktur'],
                    'idsupplier' => $data['idsupplier'],
                    'totaldebet' => 0,
                    'totalkredit' => $data['totalfaktur'],
                    'keterangan' => 'Hutang Pembelian dengan No. Faktur ' . $data['nofaktur'],
                );
                DB::table('hutang')->insert($dataHutang);



                $idhutangdetail = DB::select("SELECT create_idhutangdetail('$idhutang') AS id")[0]->id;
                $dataHutangDetail = array(
                    'idhutangdetail' => $idhutangdetail,
                    'idhutang' => $idhutang,
                    'tglhutang' => $data['tglfaktur'],
                    'debet' => 0,
                    'kredit' => $data['totalfaktur'],
                    'inserted_date' => date('Y-m-d H:i:s'),
                    'updated_date' => date('Y-m-d H:i:s'),
                    'idpengguna' => session('idpengguna'),
                    'jenis' => 'Hutang',
                );
                DB::table('hutangdetail')->insert($dataHutangDetail);
            }



            //hapus hutang ekspedisi jika ada
            $rsHutangEkspedisi = DB::table('hutangekspedisi')
                ->where('idtransaksi', $idpembelian)
                ->where('jenissumber', 'Pembelian')
                ->first();
            if (!empty($rsHutangEkspedisi)) {
                $idhutangekspedisi = $rsHutangEkspedisi->idhutangekspedisi;
                DB::table('hutangekspedisi')
                    ->where('idhutangekspedisi', $idhutangekspedisi)
                    ->delete();
                $this->App->riwayatAktifitas($rsHutangEkspedisi, 'hutangekspedisi', 'penerimaanPembelian');
            }

            if ($data['biayapengiriman'] > 0) {
                $idhutangekspedisi = DB::select('SELECT create_idhutangekspedisi() AS id')[0]->id;

                $dataHutangEkspedisi = array(
                    'idhutangekspedisi' => $idhutangekspedisi,
                    'idtransaksi' => $idpembelian,
                    'tglhutang' => $data['tglditerima'],
                    'idekspedisi' => $data['idekspedisi'],
                    'debet' => 0,
                    'kredit' => $data['biayapengiriman'],
                    'keterangan' => 'Hutang ekspedisi dengan No. Faktur ' . $data['nofaktur'],
                    'jenissumber' => 'Pembelian',
                    'jenis' => 'Hutang',
                );
                DB::table('hutangekspedisi')->insert($dataHutangEkspedisi);
                $this->App->riwayatAktifitas($dataHutangEkspedisi, 'hutangekspedisi', 'penerimaanPembelian');
            }


            //riwayat aktifitas
            $this->App->riwayatAktifitas($data, 'pembelian', 'penerimaanPembelian');
            $this->App->riwayatAktifitas($dataDetail, 'pembeliandetail', 'penerimaanPembelian');

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

    public function hapusData($idpembelian, $rsPembelian)
    {
        try {

            DB::beginTransaction();

            $detailOld = DB::table('pembeliandetail')
                ->where('idpembelian', $idpembelian)
                ->get();
            foreach ($detailOld as $rowDetail) {
                $stokawal = Barang::getRiwayatStokAkhir($rowDetail->idbarang);
                $stokmasuk = 0;
                $stokkeluar = $rowDetail->jumlahbeli;
                $stokakhir = $stokawal - $stokkeluar;

                //insert tabel riwayat stok
                $riwayatstok = array(
                    'tglriwayat' => date('Y-m-d H:i:s'),
                    'idtransaksi' => $idpembelian,
                    'tgltransaksi' => $rsPembelian->tglfaktur,
                    'idbarang' => $rowDetail->idbarang,
                    'stokawal' => $stokawal,
                    'stokmasuk' => $stokmasuk,
                    'stokkeluar' => $stokkeluar,
                    'stokakhir' => $stokakhir,
                    'hargasebelumdiskon' => $rowDetail->hargasatuan,
                    'hargasetelahdiskon' => $rowDetail->hargasatuan - $rowDetail->jumlahdiskon,
                    'deskripsi' => 'Hapus data pembelian',
                    'idpengguna' => session()->get('idpengguna'),
                    'namapengguna' => session()->get('namapengguna'),
                    'jenistransaksi' => 'Pembelian',
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


            //hapus hutang jika ada
            $rsHutang = DB::table('hutang')
                ->where('idpembelian', $idpembelian)
                ->first();
            if (!empty($rsHutang)) {
                $idhutang = $rsHutang->idhutang;
                DB::table('hutangdetail')
                    ->where('idhutang', $idhutang)
                    ->delete();

                DB::table('hutang')
                    ->where('idhutang', $idhutang)
                    ->delete();
            }

            //hapus hutang ekspedisi jika ada
            $rsHutangEkspedisi = DB::table('hutangekspedisi')
                ->where('idtransaksi', $idpembelian)
                ->where('jenissumber', 'Pembelian')
                ->first();
            if (!empty($rsHutangEkspedisi)) {
                $idhutangekspedisi = $rsHutangEkspedisi->idhutangekspedisi;
                DB::table('hutangekspedisi')
                    ->where('idhutangekspedisi', $idhutangekspedisi)
                    ->delete();
                $this->App->riwayatAktifitas($rsHutangEkspedisi, 'hutangekspedisi', 'hapusPenerimaan');
            }


            foreach ($detailOld as $rowDetail) {
                $dataDetail = array(
                    'jumlahbeli' => 0,
                    'hargasatuan' => 0,
                    'hargadpp' => 0,
                    'jumlahppn' => 0,
                    'jumlahdiskon' => 0,
                    'subtotalbeli' => 0,
                    'jenisdiskon' => null,
                    'diskonpersen1' => 0,
                    'diskonpersen2' => 0,
                    'diskonpersen3' => 0,
                );
                DB::table('pembeliandetail')
                    ->where('id', $rowDetail->id)
                    ->update($dataDetail);
            }

            $data = array(
                'nofaktur' => null,
                'tglfaktur' => null,
                'tglditerima' => null,
                'keterangan' => null,
                'totalpembelian' => 0,
                'totaldpp' => 0,
                'totaldiskon' => 0,
                'totalbersih' => 0,
                'totalppn' => 0,
                'biayapengiriman' => 0,
                'totalfaktur' => 0,
                'idpengguna' => null,
                'carabayar' => null,
                'idbank' => null,
                'nobilyetgiro' => null,
                'tglbilyetgiro' => null,
                'statuspenerimaan' => 'Belum Diterima',
            );

            DB::table('pembelian')
                ->where('idpembelian', $idpembelian)
                ->update($data);

            DB::table('pembeliandetail')
                ->where('idpembelian', $idpembelian)
                ->where('jumlahbeli_po', 0)
                ->delete(); //ini untuk yang tambah barang tidak melalui PO


            $this->App->riwayatAktifitas($rsPembelian, 'pembelian', 'hapusPenerimaan');
            $this->App->riwayatAktifitas($detailOld, 'pembeliandetail', 'hapusPenerimaan');

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
        return DB::select('SELECT create_idpembelian() AS id')[0]->id;
    }

    public function getDetail($idpembelian)
    {
        return DB::table('v_pembeliandetail')
            ->where('idpembelian', $idpembelian)
            ->get();
    }

    public function getDetailId($idpembelian, $idbarang)
    {
        return DB::table('v_pembeliandetail')
            ->where('idpembelian', $idpembelian)
            ->where('idbarang', $idbarang)
            ->first();
    }
}
