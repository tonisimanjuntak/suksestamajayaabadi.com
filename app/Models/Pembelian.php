<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App;
use App\Models\Barang;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'v_pembelian_po';
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
        return DB::table('v_pembelian_po')
            ->orderBy('idpembelian', 'desc')
            ->get();
    }

    public function simpanData($data, $dataDetail, $idpembelian)
    {
        try {
            DB::beginTransaction();
            DB::table('pembelian')->insert($data);
            DB::table('pembeliandetail')->insert($dataDetail);

            $this->App->riwayatAktifitas($data, 'pembelian', 'simpanData');
            $this->App->riwayatAktifitas($dataDetail, 'pembeliandetail', 'simpanData');

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

    public function updateData($data, $dataDetail, $idpembelian)
    {

        try {

            DB::beginTransaction();

            DB::table('pembelian')
                ->where('idpembelian', $idpembelian)
                ->update($data);

            DB::table('pembeliandetail')
                ->where('idpembelian', $idpembelian)
                ->delete();

            DB::table('pembeliandetail')
                ->insert($dataDetail);


            //riwayat aktifitas
            $this->App->riwayatAktifitas($data, 'pembelian', 'updateData');
            $this->App->riwayatAktifitas($dataDetail, 'pembeliandetail', 'updateData');

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

            DB::table('pembeliandetail')
                ->where('idpembelian', $idpembelian)
                ->delete();

            DB::table('pembelian')
                ->where('idpembelian', $idpembelian)
                ->delete();

            $this->App->riwayatAktifitas($rsPembelian, 'pembelian', 'hapusData');
            $this->App->riwayatAktifitas($detailOld, 'pembeliandetail', 'hapusData');

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

    public static function getDetail($idpembelian)
    {
        return DB::table('v_pembeliandetail_po')
            ->where('idpembelian', $idpembelian)
            ->get();
    }
}
