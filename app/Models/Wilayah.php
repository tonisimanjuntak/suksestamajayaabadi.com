<?php

namespace App\Models;



use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';
    protected $primaryKey = 'idwilayah';
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
            DB::table('wilayah')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'wilayah', 'simpanData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idwilayah)
    {
        try {

            DB::table('wilayah')
                ->where('idwilayah', $idwilayah)
                ->update($data);


            $this->App->riwayatAktifitas($data, 'wilayah', 'updateData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idwilayah, $rsKategori)
    {
        try {

            DB::table('wilayah')
                ->where('idwilayah', $idwilayah)
                ->delete();

            $this->App->riwayatAktifitas($rsKategori, 'wilayah', 'hapusData');

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function createID($namawilayah)
    {
        return DB::select("SELECT create_idwilayah() AS id")[0]->id;
    }
}
