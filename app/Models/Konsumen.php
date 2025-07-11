<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\App;

class Konsumen extends Model
{
    use HasFactory;

    protected $table = 'v_konsumen';
    protected $primaryKey = 'idkonsumen';
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
            DB::table('konsumen')
                ->insert($data);

            $this->App->riwayatAktifitas($data, 'konsumen', 'simpanData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function updateData($data, $idkonsumen)
    {
        try {

            DB::table('konsumen')
                ->where('idkonsumen', $idkonsumen)
                ->update($data);


            $this->App->riwayatAktifitas($data, 'konsumen', 'updateData');

            return ['status' => 'success', 'message' => "Data berhasil disimpan"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function hapusData($idkonsumen, $rsKonsumen)
    {
        try {

            DB::table('konsumen')
                ->where('idkonsumen', $idkonsumen)
                ->delete();

            $this->App->riwayatAktifitas($rsKonsumen, 'konsumen', 'hapusData');

            return ['status' => 'success', 'message' => "Data berhasil dihapus"];
        } catch (QueryException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()];
        }
    }

    public function createID($namakonsumen)
    {
        return DB::select("SELECT create_idkonsumen('$namakonsumen') AS id")[0]->id;
    }
}
