<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\App;

class Ekspedisi extends Model
{
    use HasFactory;

    protected $table = 'v_ekspedisi';
    protected $primaryKey = 'idekspedisi';
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

    public function simpanData($data)
    {
        try {
            DB::table('ekspedisi')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'ekspedisi', 'simpanData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idekspedisi)
    {
        try {

            DB::table('ekspedisi')
                ->where('idekspedisi', $idekspedisi)
                ->update($data);


            $this->App->riwayatAktifitas($data, 'ekspedisi', 'updateData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idekspedisi, $rsEkspedisi)
    {
        try {

            DB::table('ekspedisi')
                ->where('idekspedisi', $idekspedisi)
                ->delete();

            $this->App->riwayatAktifitas($rsEkspedisi, 'ekspedisi', 'hapusData');

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function createID()
    {
        return DB::select("SELECT create_idekspedisi() AS id")[0]->id;
    }
}
