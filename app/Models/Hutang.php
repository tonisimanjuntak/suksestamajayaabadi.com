<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;

class Hutang extends Model
{
    use HasFactory;

    protected $table = 'v_hutang';
    protected $primaryKey = 'idhutang';
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
        return DB::table('v_hutang')
            ->orderBy('idhutang', 'desc')
            ->get();
    }

    public function simpanTambahPiutang($data, $dataDetail, $idhutang)
    {
        try {
            DB::beginTransaction();
            DB::table('hutang')->insert($data);
            DB::table('hutangdetail')->insert($dataDetail);

            $this->App->riwayatAktifitas($data, 'hutang', 'simpanData');
            $this->App->riwayatAktifitas($dataDetail, 'hutangdetail', 'simpanData');

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

    public function simpanPembayaran($dataDetail, $idhutang)
    {
        try {
            DB::beginTransaction();
            DB::table('hutangdetail')->insert($dataDetail);
            $this->App->riwayatAktifitas($dataDetail, 'hutangdetail', 'simpanData');

            $totaldebet = DB::table('hutangdetail')
                ->where('idhutang', $idhutang)
                ->sum('debet');

            if (!empty($totaldebet)) {
                DB::table('hutang')
                    ->where('idhutang', $idhutang)
                    ->update(['totaldebet' => $totaldebet]);
            }

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

    public function updateTambahPiutang($data, $dataDetail, $idhutang)
    {
        try {
            DB::beginTransaction();
            DB::table('hutangdetail')
                ->where('idhutang', $idhutang)
                ->delete();

            DB::table('hutang')
                ->where('idhutang', $idhutang)
                ->update($data);

            DB::table('hutangdetail')->insert($dataDetail);

            $this->App->riwayatAktifitas($data, 'hutang', 'updateData');
            $this->App->riwayatAktifitas($dataDetail, 'hutangdetail', 'updateData');

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

    public function hapus($idhutang, $rsHutang)
    {
        try {

            DB::beginTransaction();

            $detailOld = DB::table('hutangdetail')
                ->where('idhutang', $idhutang)
                ->get();

            DB::table('hutangdetail')
                ->where('idhutang', $idhutang)
                ->delete();
            DB::table('hutang')
                ->where('idhutang', $idhutang)
                ->delete();

            $this->App->riwayatAktifitas($rsHutang, 'hutang', 'hapusData');
            $this->App->riwayatAktifitas($detailOld, 'hutangdetail', 'hapusData');

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

    public function hapusDetail($idhutang, $idhutangdetail, $rsHutangDetail)
    {
        try {

            DB::beginTransaction();

            DB::table('hutangdetail')
                ->where('idhutangdetail', $idhutangdetail)
                ->delete();

            $this->App->riwayatAktifitas($rsHutangDetail, 'hutangdetail', 'hapusDetail');


            $totaldebet = DB::table('hutangdetail')
                ->where('idhutang', $idhutang)
                ->sum('debet');

            DB::table('hutang')
                ->where('idhutang', $idhutang)
                ->update(['totaldebet' => $totaldebet]);


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
        return DB::select('SELECT create_idhutang() AS id')[0]->id;
    }

    public function createIDDetail($idhutang)
    {
        return DB::select("SELECT create_idhutangdetail('$idhutang') AS id")[0]->id;
    }

    public function getDetail($idhutang)
    {
        return DB::table('v_hutangdetail')
            ->where('idhutang', $idhutang)
            ->get();
    }

    public function getDetailPembayaran($idhutang)
    {
        return DB::table('v_hutangdetail')
            ->where('idhutang', $idhutang)
            ->where('debet', '<>', 0)
            ->get();
    }

    public function getDetailID($idhutangdetail)
    {
        return DB::table('v_hutangdetail')
            ->where('idhutangdetail', $idhutangdetail)
            ->first();
    }

    public static function hutangSudahDibayar($idpembelian)
    {
        //row lebih dari 1 berarti sudah dibayar hutangnya
        $cekInvoice = DB::table('v_hutangdetail')
            ->where('idpembelian', $idpembelian)
            ->count();
        if ($cekInvoice > 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function hutangSudahDibayarByIdHutang($idhutang)
    {
        //row lebih dari 1 berarti sudah dibayar hutangnya
        $cekInvoice = DB::table('v_hutangdetail')
            ->where('idhutang', $idhutang)
            ->count();
        if ($cekInvoice > 1) {
            return true;
        } else {
            return false;
        }
    }
}
