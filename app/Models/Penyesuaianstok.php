<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;
use App\Models\Barang;

class Penyesuaianstok extends Model
{
    use HasFactory;

    protected $table = 'v_penyesuaianstok';
    protected $primaryKey = 'idpenyesuaianstok';
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
        return DB::table('v_penyesuaianstok')
            ->orderBy('idpenyesuaianstok', 'desc')
            ->get();
    }

    public function simpanData($data, $dataDetail, $idpenyesuaianstok)
    {
        try {
            DB::beginTransaction();
            DB::table('penyesuaianstok')->insert($data);
            DB::table('penyesuaianstokdetail')->insert($dataDetail);


            foreach ($dataDetail as $detail) {

                $stokawal = $detail['stocksystem'];
                $stokmasuk = ($detail['penyesuaianstok'] > $detail['stocksystem']) ? $detail['penyesuaianstok'] - $detail['stocksystem'] : 0;
                $stokkeluar = ($detail['penyesuaianstok'] < $detail['stocksystem']) ? $detail['stocksystem'] - $detail['penyesuaianstok'] : 0;
                $stokakhir = $detail['penyesuaianstok'];

                //insert tabel riwayat stok
                $riwayatstok = array(
                    'tglriwayat' => date('Y-m-d H:i:s'),
                    'idtransaksi' => $idpenyesuaianstok,
                    'tgltransaksi' => $data['tglpenyesuaianstok'],
                    'idbarang' => $detail['idbarang'],
                    'stokawal' => $stokawal,
                    'stokmasuk' => $stokmasuk,
                    'stokkeluar' => $stokkeluar,
                    'stokakhir' => $stokakhir,
                    'hargasebelumdiskon' => null,
                    'hargasetelahdiskon' => null,
                    'deskripsi' => 'Penyesuaian Stok',
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

            $this->App->riwayatAktifitas($data, 'penyesuaianstok', 'simpanData');
            // $this->App->riwayatAktifitas($dataDetail, 'penyesuaianstokdetail', 'simpanData');

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
        return DB::select('SELECT create_idpenyesuaianstok() AS id')[0]->id;
    }

    public function getDetail($idpenyesuaianstok)
    {
        return DB::table('v_penyesuaianstokdetail')
            ->where('idpenyesuaianstok', $idpenyesuaianstok)
            ->get();
    }
}
