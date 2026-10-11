<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;
use App\Models\Barang;
use App\Helpers\StokFifoService;

class Stockopname extends Model
{
    use HasFactory;

    protected $table = 'v_stockopname';
    protected $primaryKey = 'idstockopname';
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
        return DB::table('v_stockopname')
            ->orderBy('idstockopname', 'desc')
            ->get();
    }

    public function simpanData($data, $dataDetail, $idstockopname)
    {
        try {
            DB::beginTransaction();
            DB::table('stockopname')->insert($data);
            DB::table('stockopnamedetail')->insert($dataDetail);

            $stokFifo = new StokFifoService();

            foreach ($dataDetail as $detail) {
                $selisih = $detail['stockopname'] - $detail['stocksystem'];

                if ($selisih > 0) {
                    // Surplus: Masuk FIFO (ambil harga/HPP dari pembelian terakhir)
                    $lastLayer = DB::table('stokfifo')
                        ->where('idbarang', $detail['idbarang'])
                        ->where('jenistransaksi', 'Pembelian')
                        ->where('nilaihpp', '>', 0)
                        ->orderBy('tglmasuk', 'desc')
                        ->orderBy('idstokfifo', 'desc')
                        ->first();

                    if (!$lastLayer) {
                        $lastLayer = DB::table('stokfifo')
                            ->where('idbarang', $detail['idbarang'])
                            ->where('nilaihpp', '>', 0)
                            ->orderBy('tglmasuk', 'desc')
                            ->orderBy('idstokfifo', 'desc')
                            ->first();
                    }

                    $hargaBeli = $lastLayer ? (float) $lastLayer->hargasatuan : 0;
                    $nilaiHpp  = $lastLayer ? (float) $lastLayer->nilaihpp : 0;

                    // Fallback ke master barang jika belum ada riwayat pembelian di stokfifo
                    if ($nilaiHpp <= 0) {
                        $rowBarang = DB::table('barang')->where('idbarang', $detail['idbarang'])->first();
                        $hargaBeli = $rowBarang ? (float) $rowBarang->hargabeli : 0;
                        $nilaiHpp  = ($rowBarang && $rowBarang->hpp > 0) ? (float) $rowBarang->hpp : $hargaBeli;
                    }

                    $idstokfifo = DB::select('SELECT create_idstokfifo() AS id')[0]->id;
                    $stokFifo->barangMasuk(
                        $idstokfifo,
                        $detail['idbarang'],
                        $idstockopname,
                        $data['tglstockopname'],
                        'Stok Opname',
                        $selisih,
                        $hargaBeli,
                        $nilaiHpp,
                        0,
                        0,
                        'Stok Opname (Surplus)'
                    );
                } elseif ($selisih < 0) {
                    // Defisit: Keluar FIFO
                    $stokFifo->barangKeluar($detail['idbarang'], $idstockopname, 'Stok Opname', abs($selisih));
                }

                $stokawal = $detail['stocksystem'];
                $stokmasuk = ($detail['stockopname'] > $detail['stocksystem']) ? $detail['stockopname'] - $detail['stocksystem'] : 0;
                $stokkeluar = ($detail['stockopname'] < $detail['stocksystem']) ? $detail['stocksystem'] - $detail['stockopname'] : 0;
                $stokakhir = $detail['stockopname'];

                //insert tabel riwayat stok
                $riwayatstok = array(
                    'tglriwayat' => date('Y-m-d H:i:s'),
                    'idtransaksi' => $idstockopname,
                    'tgltransaksi' => $data['tglstockopname'],
                    'idbarang' => $detail['idbarang'],
                    'stokawal' => $stokawal,
                    'stokmasuk' => $stokmasuk,
                    'stokkeluar' => $stokkeluar,
                    'stokakhir' => $stokakhir,
                    'hargasebelumdiskon' => null,
                    'hargasetelahdiskon' => null,
                    'deskripsi' => 'Stock Opname',
                    'idpengguna' => session()->get('idpengguna'),
                    'namapengguna' => session()->get('namapengguna'),
                    'jenistransaksi' => 'Stock Opname',
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

            $this->App->riwayatAktifitas($data, 'stockopname', 'simpanData');
            // $this->App->riwayatAktifitas($dataDetail, 'stockopnamedetail', 'simpanData');

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


    public function createID()
    {
        return DB::select('SELECT create_idstockopname() AS id')[0]->id;
    }

    public function getDetail($idstockopname)
    {
        return DB::table('v_stockopnamedetail')
            ->where('idstockopname', $idstockopname)
            ->get();
    }
}
