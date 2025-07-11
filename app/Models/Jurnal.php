<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;
use App\Models\Akun;

class Jurnal extends Model
{
    use HasFactory;

    protected $table = 'v_jurnal';
    protected $primaryKey = 'idjurnal';
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
        return DB::table('v_jurnal')
            ->orderBy('idjurnal', 'desc')
            ->get();
    }

    public function simpanData($data, $dataDetail, $idjurnal)
    {
        try {
            DB::beginTransaction();
            DB::table('jurnal')->insert($data);
            DB::table('jurnaldetail')->insert($dataDetail);

            $this->App->riwayatAktifitas($data, 'jurnal', 'simpanData');
            $this->App->riwayatAktifitas($dataDetail, 'jurnaldetail', 'simpanData');

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

    public function updateData($data, $dataDetail, $idjurnal)
    {

        try {

            DB::beginTransaction();


            DB::table('jurnal')
                ->where('idjurnal', $idjurnal)
                ->update($data);

            DB::table('jurnaldetail')
                ->where('idjurnal', $idjurnal)
                ->delete();

            DB::table('jurnaldetail')
                ->insert($dataDetail);

            //riwayat aktifitas
            $this->App->riwayatAktifitas($data, 'jurnal', 'updateData');
            $this->App->riwayatAktifitas($dataDetail, 'jurnaldetail', 'updateData');

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

    public function hapusData($idjurnal, $rsJurnal)
    {
        try {

            DB::beginTransaction();

            $detailOld = DB::table('jurnaldetail')
                ->where('idjurnal', $idjurnal)
                ->get();


            DB::table('jurnaldetail')
                ->where('idjurnal', $idjurnal)
                ->delete();

            DB::table('jurnal')
                ->where('idjurnal', $idjurnal)
                ->delete();


            $this->App->riwayatAktifitas($rsJurnal, 'jurnal', 'hapusData');
            $this->App->riwayatAktifitas($detailOld, 'jurnaldetail', 'hapusData');

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

    public function createIDJurnalPenyesuaian()
    {
        return DB::select('SELECT create_idjurnalpenyesuaian() AS id')[0]->id;
    }

    public function getDetail($idjurnal)
    {
        return DB::table('v_jurnaldetail')
            ->where('idjurnal', $idjurnal)
            ->orderBy('idjurnaldetail', 'Asc')
            ->get();
    }
}
