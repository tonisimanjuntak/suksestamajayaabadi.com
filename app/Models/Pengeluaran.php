<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;
use App\Models\Akun;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'v_pengeluaran';
    protected $primaryKey = 'idpengeluaran';
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
        return DB::table('v_pengeluaran')
            ->orderBy('idpengeluaran', 'desc')
            ->get();
    }

    public function simpanData($data, $dataDetail, $idpengeluaran)
    {
        try {
            DB::beginTransaction();
            DB::table('pengeluaran')->insert($data);
            DB::table('pengeluarandetail')->insert($dataDetail);

            $this->App->riwayatAktifitas($data, 'pengeluaran', 'simpanData');
            $this->App->riwayatAktifitas($dataDetail, 'pengeluarandetail', 'simpanData');

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

    public function updateData($data, $dataDetail, $idpengeluaran)
    {

        try {

            DB::beginTransaction();


            DB::table('pengeluaran')
                ->where('idpengeluaran', $idpengeluaran)
                ->update($data);

            DB::table('pengeluarandetail')
                ->where('idpengeluaran', $idpengeluaran)
                ->delete();

            DB::table('pengeluarandetail')
                ->insert($dataDetail);

            //riwayat aktifitas
            $this->App->riwayatAktifitas($data, 'pengeluaran', 'updateData');
            $this->App->riwayatAktifitas($dataDetail, 'pengeluarandetail', 'updateData');

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

    public function hapusData($idpengeluaran, $rsPengeluaran)
    {
        try {

            DB::beginTransaction();

            $detailOld = DB::table('pengeluarandetail')
                ->where('idpengeluaran', $idpengeluaran)
                ->get();


            DB::table('pengeluarandetail')
                ->where('idpengeluaran', $idpengeluaran)
                ->delete();

            DB::table('pengeluaran')
                ->where('idpengeluaran', $idpengeluaran)
                ->delete();


            $this->App->riwayatAktifitas($rsPengeluaran, 'pengeluaran', 'hapusData');
            $this->App->riwayatAktifitas($detailOld, 'pengeluarandetail', 'hapusData');

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
        return DB::select('SELECT create_idpengeluaran() AS id')[0]->id;
    }

    public function getDetail($idpengeluaran)
    {
        return DB::table('v_pengeluarandetail')
            ->where('idpengeluaran', $idpengeluaran)
            ->get();
    }
}
