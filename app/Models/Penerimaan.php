<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;
use App\Models\Akun;

class Penerimaan extends Model
{
    use HasFactory;

    protected $table = 'v_penerimaan';
    protected $primaryKey = 'idpenerimaan';
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
        return DB::table('v_penerimaan')
            ->orderBy('idpenerimaan', 'desc')
            ->get();
    }

    public function simpanData($data, $dataDetail, $idpenerimaan)
    {
        try {
            DB::beginTransaction();
            DB::table('penerimaan')->insert($data);
            DB::table('penerimaandetail')->insert($dataDetail);

            $this->App->riwayatAktifitas($data, 'penerimaan', 'simpanData');
            $this->App->riwayatAktifitas($dataDetail, 'penerimaandetail', 'simpanData');

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

    public function updateData($data, $dataDetail, $idpenerimaan)
    {

        try {

            DB::beginTransaction();


            DB::table('penerimaan')
                ->where('idpenerimaan', $idpenerimaan)
                ->update($data);

            DB::table('penerimaandetail')
                ->where('idpenerimaan', $idpenerimaan)
                ->delete();

            DB::table('penerimaandetail')
                ->insert($dataDetail);

            //riwayat aktifitas
            $this->App->riwayatAktifitas($data, 'penerimaan', 'updateData');
            $this->App->riwayatAktifitas($dataDetail, 'penerimaandetail', 'updateData');

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

    public function hapusData($idpenerimaan, $rsPenerimaan)
    {
        try {

            DB::beginTransaction();

            $detailOld = DB::table('penerimaandetail')
                ->where('idpenerimaan', $idpenerimaan)
                ->get();


            DB::table('penerimaandetail')
                ->where('idpenerimaan', $idpenerimaan)
                ->delete();

            DB::table('penerimaan')
                ->where('idpenerimaan', $idpenerimaan)
                ->delete();


            $this->App->riwayatAktifitas($rsPenerimaan, 'penerimaan', 'hapusData');
            $this->App->riwayatAktifitas($detailOld, 'penerimaandetail', 'hapusData');

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
        return DB::select('SELECT create_idpenerimaan() AS id')[0]->id;
    }

    public function getDetail($idpenerimaan)
    {
        return DB::table('v_penerimaandetail')
            ->where('idpenerimaan', $idpenerimaan)
            ->get();
    }
}
