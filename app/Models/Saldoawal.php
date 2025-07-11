<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;
use App\Models\Akun;

class Saldoawal extends Model
{
    use HasFactory;

    protected $table = 'v_saldoawal';
    protected $primaryKey = 'idsaldoawal';
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
        return DB::table('v_saldoawal')
            ->orderBy('idsaldoawal', 'desc')
            ->get();
    }

    public function simpanData($dataSaldoAwal, $dataJurnal, $dataDetailSaldoAwal, $dataDetailJurnal, $idsaldoawal)
    {
        try {
            DB::beginTransaction();
            DB::table('saldoawal')->insert($dataSaldoAwal);
            DB::table('saldoawaldetail')->insert($dataDetailSaldoAwal);

            DB::table('jurnal')->insert($dataJurnal);
            DB::table('jurnaldetail')->insert($dataDetailJurnal);

            $this->App->riwayatAktifitas($dataSaldoAwal, 'saldoawal', 'simpanData');
            $this->App->riwayatAktifitas($dataDetailSaldoAwal, 'saldoawaldetail', 'simpanData');

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

    public function updateData($dataSaldoAwal, $dataJurnal, $dataDetailSaldoAwal, $dataDetailJurnal, $idsaldoawal, $idjurnal)
    {

        try {

            DB::beginTransaction();

            DB::table('saldoawaldetail')
                ->where('idsaldoawal', $idsaldoawal)
                ->delete();
            DB::table('jurnaldetail')
                ->where('idjurnal', $idjurnal)
                ->delete();
            DB::table('jurnal')
                ->where('idjurnal', $idjurnal)
                ->delete();


            DB::table('saldoawal')
                ->where('idsaldoawal', $idsaldoawal)
                ->update($dataSaldoAwal);
            DB::table('saldoawaldetail')->insert($dataDetailSaldoAwal);

            DB::table('jurnal')->insert($dataJurnal);
            DB::table('jurnaldetail')->insert($dataDetailJurnal);

            //riwayat aktifitas
            $this->App->riwayatAktifitas($dataSaldoAwal, 'saldoawal', 'updateData');
            $this->App->riwayatAktifitas($dataDetailSaldoAwal, 'saldoawaldetail', 'updateData');

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

    public function hapusData($idsaldoawal, $rsSaldoAwal)
    {
        try {

            DB::beginTransaction();

            $detailOld = DB::table('saldoawaldetail')
                ->where('idsaldoawal', $idsaldoawal)
                ->get();


            DB::table('saldoawaldetail')
                ->where('idsaldoawal', $idsaldoawal)
                ->delete();

            DB::table('saldoawal')
                ->where('idsaldoawal', $idsaldoawal)
                ->delete();


            $this->App->riwayatAktifitas($rsSaldoAwal, 'saldoawal', 'hapusData');
            $this->App->riwayatAktifitas($detailOld, 'saldoawaldetail', 'hapusData');

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

    public function createidsaldoawalPenyesuaian()
    {
        return DB::select('SELECT create_idsaldoawalpenyesuaian() AS id')[0]->id;
    }

    public function getDetail($idsaldoawal)
    {
        return DB::table('v_saldoawaldetail')
            ->where('idsaldoawal', $idsaldoawal)
            ->orderBy('kdakun', 'Asc')
            ->get();
    }
}
