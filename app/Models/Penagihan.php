<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;


class Penagihan extends Model
{
    use HasFactory;

    protected $table = 'v_penagihan';
    protected $primaryKey = 'idpenagihan';
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
        return DB::table('v_penagihan')
            ->orderBy('idpenagihan', 'desc')
            ->get();
    }

    public function simpanData($data, $dataDetail, $idpenagihan)
    {
        try {
            DB::beginTransaction();
            DB::table('penagihan')->insert($data);
            DB::table('penagihandetail')->insert($dataDetail);

            $this->App->riwayatAktifitas($data, 'penagihan', 'simpanDataPenagihan');
            $this->App->riwayatAktifitas($dataDetail, 'penagihandetail', 'simpanDataPenagihan');
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

    public function updateData($data, $dataDetail, $idpenagihan)
    {

        try {

            DB::beginTransaction();

            DB::table('penagihandetail')
                ->where('idpenagihan', $idpenagihan)
                ->delete();

            DB::table('penagihan')
                ->where('idpenagihan', $idpenagihan)
                ->update($data);

            DB::table('penagihandetail')->insert($dataDetail);


            //riwayat aktifitas
            $this->App->riwayatAktifitas($data, 'penagihan', 'updateDataPenagihan');
            $this->App->riwayatAktifitas($dataDetail, 'penagihandetail', 'updateDataPenagihan');

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

    public function updatestatuscetak($idpenagihan)
    {
        return DB::table("penagihan")
            ->where('idpenagihan', $idpenagihan)
            ->update([
                'statuscetak' => 'Sudah Cetak',
            ]);
    }

    public function hapusData($idpenagihan, $rsPenagihan)
    {
        try {

            DB::beginTransaction();

            $detailOld = DB::table('penagihandetail')
                ->where('idpenagihan', $idpenagihan)
                ->get();

            DB::table('penagihandetail')
                ->where('idpenagihan', $idpenagihan)
                ->delete();

            DB::table('penagihan')
                ->where('idpenagihan', $idpenagihan)
                ->delete();

            $this->App->riwayatAktifitas($rsPenagihan, 'penagihan', 'hapusDataPenagihan');
            $this->App->riwayatAktifitas($detailOld, 'penagihandetail', 'hapusDataPenagihan');

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
        return DB::select('SELECT create_idpenagihan() AS id')[0]->id;
    }

    public function getDetail($idpenagihan)
    {
        return DB::table('v_penagihandetail')
            ->where('idpenagihan', $idpenagihan)
            ->get();
    }

    public function getPiutangBelumLunas($idsales, $tgljatuhtempo)
    {
        return DB::table('v_piutang_belum_ada_penagihan')
            ->where('idsales', $idsales)
            ->where('tgljatuhtempo', '<=', $tgljatuhtempo)
            ->get();
    }

    public function getPiutangID($idpiutang)
    {
        return DB::table('v_piutang')
            ->where('idpiutang', $idpiutang)
            ->first();
    }
}
