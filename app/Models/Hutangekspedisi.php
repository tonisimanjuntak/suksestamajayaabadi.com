<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;

class Hutangekspedisi extends Model
{
    use HasFactory;

    protected $table = 'v_hutangekspedisi';
    protected $primaryKey = 'idhutangekspedisi';
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
        return DB::table('v_hutangekspedisi')
            ->orderBy('idhutangekspedisi', 'desc')
            ->get();
    }

    public function simpanPembayaran($data, $idhutangekspedisi)
    {
        try {
            DB::beginTransaction();
            DB::table('hutangekspedisi')->insert($data);

            $this->App->riwayatAktifitas($data, 'hutang', 'simpanData');
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


    public function updatePembayaran($data, $idhutangekspedisi)
    {
        try {
            DB::beginTransaction();

            DB::table('hutangekspedisi')
                ->where('idhutangekspedisi', $idhutangekspedisi)
                ->update($data);

            $this->App->riwayatAktifitas($data, 'hutang', 'updateData');

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

    public function hapus($idhutangekspedisi, $rsHutang)
    {
        try {

            DB::beginTransaction();


            DB::table('hutangekspedisi')
                ->where('idhutangekspedisi', $idhutangekspedisi)
                ->delete();

            $this->App->riwayatAktifitas($rsHutang, 'hutangekspedisi', 'hapusData');
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
        return DB::select('SELECT create_idhutangekspedisi() AS id')[0]->id;
    }
}
